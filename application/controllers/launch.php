<?php
	class Launch extends Controller
	{
		function index()
		{
			$data['page_title'] = "Welcome to BTD";
			
			$template['menu'] = $this->load->view('menu_view', $data, true);
			$template['content'] = $this->load->view('launch_view', $data, true);
			
			$this->load->view('template_view', $template);
		}
	}
?>