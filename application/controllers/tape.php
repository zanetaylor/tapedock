<?php
	class Tape extends Controller
	{
		function index()
		{
			$this->load->model('tape_model');
			
			$data = array(
				'page_title'=> "All the Tapes!",
				'tapes'		=> $this->tape_model->get_all()
			);
			
			//$template['menu'] = $this->load->view('menu_view', $data, true);
			$template['content'] = $this->load->view('list_view', $data, true);
			$this->load->view('template_view', $template);
		}
		
		function play($tape_id=0)
		{
			$this->load->model('tape_model');
			
			if (!empty($tape_id))
			{
				$tape_data = $this->tape_model->get_tape($tape_id);
				$data = array(
					'page_title'=> $tape_data['title'],
					'tape'	=> $tape_data,
					'js_file'	=> "jwplayer.js"
				);
				
				//$template['menu'] = $this->load->view('menu_view', $data, true);
				$template['content'] = $this->load->view('play_view', $data, true);
			} else
			{
				$data = array(
					'tapes'		=> $this->tape_model->get_all(),
					'page_title'=> "All the Tapes!"
				);

				//$template['menu'] = $this->load->view('menu_view', $data, true);
				$template['content'] = $this->load->view('list_view', $data, true);
			}
			
			$this->load->view('template_view', $template);
		}
		
		function create()
		{
			$data = array(
				'page_title'=> "Create a Tape!",
				'error'		=> ""
			);
			
			//$template['menu'] = $this->load->view('menu_view', $data, true);
			$template['content'] = $this->load->view('create_view', $data, true);
			$this->load->view('template_view', $template);
		}
		
		function upload()
		{
			// set temp directory for tracks...
			$temp_track_dir = rand();
			$temp_track_final_dir = "uploads/".$temp_track_dir."/";
			
			if (mkdir($temp_track_final_dir))
			{
				$config['upload_path'] = $temp_track_final_dir;
			}
			
			//$config['upload_path'] = $temp_track_dir;
			$config['allowed_types'] = 'mp3';
			$config['max_size']	= '0';

			$this->load->library('upload', $config);
			
			// upload the track(s)
			if ( ! $this->upload->do_upload('track'))
			{
				$data['page_title'] = "Create a Tape";
				$data['error'] = $this->upload->display_errors();

				//$template['menu'] = $this->load->view('menu_view', $data, true);
				$template['content'] = $this->load->view('create_view', $data, true);
				$this->load->view('template_view', $template);
			}	
			else
			{
				// upload success
				$upload_data = array('upload_data' => $this->upload->data());

				$this->load->model('tape_model');
				
				$tape_data = array(
					'title'		=> "temp",
					'upload_dir'=> $temp_track_dir
				);
				
				// insert
				$query = $this->tape_model->create($tape_data);
				
				$id = $this->db->insert_id();
				
				$data = array(
					'page_title' => "Save Your Tape",
					'id' => $id,
					'upload_data' => $upload_data
				);
				
				//$template['menu'] = $this->load->view('menu_view', $data, true);
				$template['content'] = $this->load->view('save_view', $data, true);
				$this->load->view('template_view', $template);
			}
		}
		
		function save()
		{
			$this->load->library('form_validation');
			
			$this->form_validation->set_rules('title', 'Title', 'required|trim');
			$this->form_validation->set_rules('short_desc', 'Description', 'trim');
			
			// grab tape_id from POST data
			$tape_id = $this->input->post('tape_id');
			
			// validated?
			if ($this->form_validation->run() == FALSE)
			{
				// load hidden tape_id field back into view
				$tape_data = array(
					'id'	=> $tape_id
				);
				
				$data = array(
					'page_title'=> "Save Your Tape",
					'tape_data'	=> $tape_data
				);
				
				//$template['menu'] = $this->load->view('menu_view', $data, true);
				$template['content'] = $this->load->view('save_view', $data, true);
				$this->load->view('template_view', $template);
			} else
			{	
				// validated
				$this->load->model('tape_model');
				
				$tape_id = $this->input->post('tape_id');
				
				$tape_data = array(
					'tape_id'	=> $tape_id,
					'title'		=> $this->input->post('title'),
					'short_desc'=> $this->input->post('short_desc')
				);
				
				// update
				$query = $this->tape_model->update($tape_data);
				
				$tape = $this->tape_model->get_tape($tape_id);
				$temp_track_dir = $tape['upload_dir'];
				//SPLICE TRACKS HERE
				
				// write tape file (fully spliced tracks) to tapes directory
				$final_tape_path = "tapes/".$tape_id.".mp3";
				$file_data = "SPLICED TRACKS";
				
				if(!write_file($final_tape_path, $file_data))
				{
					
				} else
				{
					// delete temporary track files and directory
					delete_files('uploads/'.$temp_track_dir.'/');
					rmdir('uploads/'.$temp_track_dir.'/');
					
					$data = array(
						'page_title'=> "Share Your Tape",
						'tape_data'	=> $tape
					);

					//$template['menu'] = $this->load->view('menu_view', $data, true);
					$template['content'] = $this->load->view('share_view', $data, true);
					$this->load->view('template_view', $template);
				}
			}
		}
		
		function share()
		{
			
		}
	}
?>