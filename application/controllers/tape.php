<?php
	class Tape extends Controller
	{
		function index()
		{
			$this->load->model('tape_model');
			
			$data['tapes'] = $this->tape_model->get();
			$data['page_title'] = "All the Tapes";
			
			$this->load->view('list_view', $data);
		}
		
		function create()
		{
			$data['page_title'] = "Create a Tape";
			$data['error'] = "";
			$this->load->view('create_view', $data);
		}
		
		function upload()
		{
			// set temp directory for tracks...will be dependent on logged-in USER ID
			$temp_track_dir = "uploads/1/temp/";
			
			$config['upload_path'] = $temp_track_dir;
			$config['allowed_types'] = 'mp3';
			$config['max_size']	= '0';

			$this->load->library('upload', $config);
			
			// upload the track(s)
			if ( ! $this->upload->do_upload('track'))
			{
				$data['page_title'] = "Create a Tape";
				$data['error'] = $this->upload->display_errors();

				$this->load->view('create_view', $data);
			}	
			else
			{
				// upload success
				$upload_data = array('upload_data' => $this->upload->data());

				$this->load->model('tape_model');
				
				$tape_data = array(
					'title' => "temp"
				);
				
				// insert
				$query = $this->tape_model->create($tape_data);
				
				$id = $this->db->insert_id();
				
				$data = array(
					'page_title' => "Save Your Tape",
					'id' => $id,
					'upload_data' => $upload_data
				);
				
				$this->load->view('save_view', $data);
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
				
				$this->load->view('save_view', $data);
			} else
			{	
				// validated
				$this->load->model('tape_model');
				
				$tape_data = array(
					'tape_id'	=> $this->input->post('tape_id'),
					'title'		=> $this->input->post('title'),
					'short_desc'=> $this->input->post('short_desc')
				);
				
				// update
				$query = $this->tape_model->update($tape_data);
				
				// write tape file (fully spliced tracks) to user's directory
				$final_tape_path = "uploads/1/".$tape_id.".mp3";
				$file_data = "SPLICED TRACKS";
				
				if(!write_file($final_tape_path, $file_data))
				{
					
				} else
				{
					delete_files('uploads/1/temp/');
					
					$data = array(
						'page_title'=> "Share Your Tape",
						'tape_data'	=> $query
					);

					$this->load->view('share_view', $data);
				}
			}
		}
		
		function share()
		{
			
		}
	}
?>