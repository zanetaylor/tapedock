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
			$data['page_title'] = "Create a Mix";
			
			$this->load->view('create_view', $data);
		}
	}
?>