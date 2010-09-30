<?php
	class Helloworld extends Controller
	{
		function index()
		{
			$this->load->model('helloworld_model');
			
			$data['result'] = $this->helloworld_model->getData();
			$data['page_title'] = "HELLO WORLD!";
			
			$this->load->view('helloworld_view',$data);
		}
	}
?>