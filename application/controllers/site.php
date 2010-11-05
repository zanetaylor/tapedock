<?php
	class Site extends Controller
	{
		function __construct()
		{
			parent::Controller();
		}
	
		function index()
		{
			$this->load->model('tape_model');
			
			$data = array(
				'page_title'=> "Welcome to the MTP!",
				'tapes'		=> $this->tape_model->get_all()
			);
			
			$template['menu'] = $this->load->view('menu_view', $data, true);
			$template['content'] = $this->load->view('launch_view', $data, true);
			
			$this->load->view('template_view', $template);
		}
		
		function is_logged_in()
		{
			$is_logged_in = $this->session->userdata('is_logged_in');
			
			return $is_logged_in;
		}
		
		function dashboard()
		{
			$is_logged_in = $this->is_logged_in();
			
			if(!isset($is_logged_in) || $is_logged_in != true)
			{
				$data = array(
					'page_title' => "ACCESS DENIED",
					'error' => "You don't have permission! <a href=\"../user/login\">Login</a>, damn you!"
				);
			
				$template['menu'] = $this->load->view('menu_view', $data, true);
				$template['content'] = $this->load->view('error_view', $data, true);
				$this->load->view('template_view', $template);
				
			} else
			{
				$data = array(
					'page_title'=> "DASHBOARD"
				);
			
				$template['content'] = $this->load->view('dashboard_view', $data, true);
				$this->load->view('template_view', $template);
			}
		}
	}
?>