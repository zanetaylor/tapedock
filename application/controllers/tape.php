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
			/*
			$tape_data = array(
				'track' => $this->input->post('track')
			);
			*/
			
			$config['upload_path'] = 'uploads/';
			$config['allowed_types'] = 'mp3';
			$config['max_size']	= '0';

			$this->load->library('upload', $config);
			
			if ( ! $this->upload->do_upload('track'))
			{
				$data['page_title'] = "Create a Tape";
				$data['error'] = $this->upload->display_errors();

				$this->load->view('create_view', $data);
			}	
			else
			{
				$data = array('upload_data' => $this->upload->data());

				//$this->load->view('upload_success', $data);
				
				$this->save($data);
			}
		}
		
		function save($tape_data)
		{
			$this->load->library('form_validation');
			
			$this->form_validation->set_rules('title', 'Title', 'required|trim');
			$this->form_validation->set_rules('short_desc', 'Description', 'trim');
			
			// validated?
			if ($this->form_validation->run() == FALSE)
			{
				$data['page_title'] = "Save Your Tape";
				$data['tape_data'] = $tape_data;
				$this->load->view('save_view', $data);
			} else
			{	
				// validated
				$this->load->model('tape_model');
				
				$tape_data = array(
					'title' => $this->input->post('title'),
					'short_desc' => $this->input->post('short_desc')
				);
				
				// insert
				$query = $this->tape_model->create($tape_data);

				$data['page_title'] = "Save Your Tape";
				$data['tape_data'] = $query;
				
				$this->load->view('share_view', $data);
				
				// SUCCESS / SHARE PAGE
			}
		}
	}
?>