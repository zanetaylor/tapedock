<?php
	class Launch extends Controller
	{
		function index()
		{
			//$this->load->model('helloworld_model');
			
			//$data['result'] = $this->helloworld_model->getData();
			$data['page_title'] = "Welcome to BTD";
			
			$this->load->view('launch_view', $data);
		}
	}
?>