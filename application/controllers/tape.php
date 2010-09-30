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
			
			if ($this->form_validation->run() == FALSE)
			{
				$data['page_title'] = "Create a Mix";
				$this->load->view('create_view', $data);
			} else
			{
				// validated
				$title = $this->input->post('title');
				$short_desc = $this->input->post('short_desc');
			}
		}
	}
?>