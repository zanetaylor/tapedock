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
			$this->load->library('form_validation');
			
			$this->form_validation->set_rules('title', 'Title', 'required|trim');
			$this->form_validation->set_rules('short_desc', 'Description', 'trim');
			
			// validated?
			if ($this->form_validation->run() == FALSE)
			{
				$data['page_title'] = "Create a Tape";
				$this->load->view('create_view', $data);
			} else
			{	
				// validated
				$tape_data = array(
					'title' => $this->input->post('title'),
					'short_desc' => $this->input->post('short_desc')
				);
				
				save($tape_data);
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
				
				// SUCCESS / SHARE PAGE
			}
		}
	}
?>