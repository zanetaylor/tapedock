<?php
	class Site extends Controller
	{
		function __construct()
		{
			parent::__construct();
			
			$is_logged_in = $this->session->userdata('is_logged_in');
			
			if ($is_logged_in)
			{
				$user = array(
					'user_id'	=> $this->session->userdata('user_id'),
					'username'	=> $this->session->userdata('username')
				);
				$this->load->vars($user);
			}
		}
	
		function index()
		{
			$is_logged_in = $this->session->userdata('is_logged_in');
			
			if(!$is_logged_in)
			{
				$this->load->model('tape_model');
			
				$data = array(
					'page_title'=> "Home",
					'tapes'		=> $this->tape_model->get_latest()
				);
				
				$template['menu'] = $this->load->view('menu_view', $data, true);
				$template['content'] = $this->load->view('launch_view', $data, true);
				
				$this->load->view('template_view', $template);
			} else
			{
				$this->dashboard();
			}
		}
		
		function dashboard()
		{
			$is_logged_in = $this->session->userdata('is_logged_in');
			
			if(!$is_logged_in)
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
				$this->load->model('tape_model');
				$user_id = $this->session->userdata('user_id');
				$username = $this->session->userdata('username');
				
				$user_tapes = $this->tape_model->get_user_tapes($user_id);
				
				$data = array(
					'page_title'	=> "Dashboard",
					'user_tapes'	=> $user_tapes
				);
			
				$template['content'] = $this->load->view('dashboard_view', $data, true);
				$this->load->view('template_view', $template);
			}
		}
		
		function page($url_title)
		{
			$this->load->model('page_model');
			
			$page = $this->page_model->get_page($url_title);
			
			$data = array(
				'page_title'	=> $page['title'],
				'content'		=> $page['content']
			);
			
			$template['content'] = $this->load->view('page_view', $data, true);
			$this->load->view('template_view', $template);
		}
	}
?>