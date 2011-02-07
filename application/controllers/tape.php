<?php
	class Tape extends Controller
	{
		function __construct()
		{
			parent::__construct();
			
			$is_logged_in = $this->session->userdata('is_logged_in');
			
			if ($is_logged_in)
			{
				$user = array(
					'user_id'	=> $this->session->userdata('user_id'),
					'username'	=> $this->session->userdata('username')
				);
				$this->load->vars($user);
			}
		}
		
		function index() { redirect('/'); }
		
		/* this plays an individual tape or shows a list of tapes */
		function play($tape_id=0)
		{
			$this->load->model('tape_model');
			
			if (!empty($tape_id))
			{
				$tape_data = $this->tape_model->get_tape($tape_id);
				$data = array(
					'page_title'=> $tape_data['title'],
					'tape'	=> $tape_data
				);
				
				$template['content'] = $this->load->view('tape/play_view', $data, true);
				$this->load->view('template_view', $template);
			} else redirect('/');
		}
		
		/* this loads initial track file upload form */
		function create()
		{
			if (!$this->session->userdata('is_logged_in')) redirect('user/login');
			else
			{
				$data = array(
					'page_title'=> "Create a Tape!",
					'error'		=> ""
				);
				
				$template['content'] = $this->load->view('tape/create_view', $data, true);
				$this->load->view('template_view', $template);
			}
		}
		
		/* this handles the asynchronous upload of individual track files */
		function upload()
		{
			// set temp directory for tracks...
			$upload_dir = $this->session->userdata('upload_dir');
			$temp_track_path = "././uploads/".$upload_dir."/";
			
			if(!file_exists($temp_track_path)) { mkdir($temp_track_path); }
			
			$this->load->library('qqFileUploader');
			
			$allowedExtensions = array("mp3");
			$sizeLimit = 10 * 1024 * 1024;
			
			$uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
			$result = $uploader->handleUpload($temp_track_path);
			
			echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
		}
		
		/* this creates the DB record for the tape after all tracks are uploaded */
		function make()
		{
			$tape_data = array(
				'title'		=> "temp",
				'creator'	=> $this->session->userdata('user_id'),
				'upload_dir'=> $this->session->userdata('upload_dir')
			);
			
			// insert
			$query = $this->tape_model->create($tape_data);
			
			$id = $this->db->insert_id();
			
			$data = array(
				'page_title' => "Save Your Tape",
				'id' => $id
			);
			
			$template['content'] = $this->load->view('tape/save_view', $data, true);
			$this->load->view('template_view', $template);
		}
		
		/* this splices tracks together and saves metadata into DB */
		function save()
		{
			$this->load->library('form_validation');
			
			$this->form_validation->set_rules('title', 'Title', 'required|trim');
			$this->form_validation->set_rules('short_desc', 'Description', 'trim');
			
			// validated?
			if ($this->form_validation->run() == FALSE)
			{				
				$data = array(
					'page_title'=> "validation failed"
				);
				
				$template['content'] = $this->load->view('tape/create_view', $data, true);
				$this->load->view('template_view', $template);
			} else
			{	
				// validated
				$this->load->model('tape_model');
				
				$tape_data = array(
					'title'		=> $this->input->post('title'),
					'short_desc'=> $this->input->post('short_desc'),
					'creator'	=> $this->session->userdata('user_id'),
					'upload_dir'=> $this->session->userdata('upload_dir')
				);
				
				// insert
				$tape_id = $this->tape_model->create($tape_data);
				
				$tape = $this->tape_model->get_tape($tape_id);
				
				/* begin track file manipulation */
				
				$this->load->library('mp3');
				
				$temp_track_dir = "././uploads/".$tape['upload_dir'];
				// load all temp track files into array for splicing
				$tracks = get_filenames($temp_track_dir, TRUE);
				//SPLICE TRACKS HERE
				
				// create empty base tape file w/ tapeID as filename
				$final_tape_path = "tapes/".$tape_id.".mp3";
				
				if(!write_file($final_tape_path, ''))
				{
					echo 'Creating the mixtape file failed.';
					die();
				}
				
				// instantiate mp3 class for splicing
				$tape_mp3 = new mp3($final_tape_path);
				$tape_mp3->striptags();
				
				$tape_mp3->multiJoin($final_tape_path, $tracks);
				
				// delete temporary track files (leave directory intact for the rest of the session)
				delete_files($temp_track_dir);
				
				$data = array(
					'page_title'=> "Share Your Tape",
					'tape_data'	=> $tape
				);

				$template['content'] = $this->load->view('tape/share_view', $data, true);
				$this->load->view('template_view', $template);
			}
		}
		
		function share()
		{
			$this->load->model('friend_model');
		}
	}
?>