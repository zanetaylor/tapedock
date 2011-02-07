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
					'page_title'=> "Welcome to the MTP!",
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
					'page_title'	=> "DASHBOARD",
					'user_tapes'	=> $user_tapes
				);
			
				$template['content'] = $this->load->view('dashboard_view', $data, true);
				$this->load->view('template_view', $template);
			}
		}
		
		function about()
		{
			$data = array(
				'page_title'	=> "What is This?",
				'content'		=> "<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eget lorem leo, a tempor nisi. Phasellus non lacinia nulla. Donec sit amet arcu mi. Etiam non quam imperdiet nibh auctor tempor sed non turpis. Fusce nunc elit, interdum a viverra non, convallis quis augue. Vestibulum venenatis malesuada arcu, eget tincidunt purus luctus a. Sed sagittis leo et velit volutpat faucibus. Maecenas dapibus commodo ante, eget varius odio sagittis vel. Sed sodales, nibh id aliquet elementum, mi ante tempus ipsum, et viverra enim elit sit amet lectus. In massa erat, convallis at varius non, faucibus in nulla. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec convallis dui vel mauris molestie auctor feugiat nulla consectetur. Curabitur ut metus ac velit adipiscing ultricies. Etiam et viverra eros.</p>"
			);
		
			$template['content'] = $this->load->view('page_view', $data, true);
			$this->load->view('template_view', $template);
		}
	}
?>