<?php
	class User extends Controller
	{
		function index()
		{
			$this->load->model('user_model');
			
			$data = array(
				'page_title'=> "USER"
			);
			
			$template['content'] = $this->load->view('login_view', $data, true);
			$this->load->view('template_view', $template);
		}
		
		function signup()
		{
			$data = array(
				'page_title'=> "SIGNUP"
			);
			
			$template['content'] = $this->load->view('signup_view', $data, true);
			$this->load->view('template_view', $template);
		}
		
		function login()
		{
			$this->load->model('user_model');
			
			$data = array(
				'page_title'=> "Login"
			);
			
			$template['content'] = $this->load->view('login_view', $data, true);
			$this->load->view('template_view', $template);
		}
		
		function validate()
		{
			$this->load->model('user_model');
			
			$query = $this->user_model->validate();
			
			if($query) // if validated
			{
				$data = array(
					'username' => $this->input->post('username'),
					'is_logged_in' => true
				);
				
				$this->session->set_userdata($data);
				redirect('site/dashboard');
			} else
			{
				$this->index();
			}
		}
		
		function create()
		{
			$this->load->library('form_validation');
			
			$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]');
			$this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[32]');
			$this->form_validation->set_rules('password2', 'Password Confirmation', 'trim|required|matches[password]');
			
			if($this->form_validation->run() == FALSE)
			{
				$this->signup();
			} else
			{
				$this->load->model('user_model');
				
				if($query = $this->user_model->create())
				{
					$data = array(
						'page_title' => 'SIGNED UP!'
					);
				
					$template['content'] = $this->load->view('signup_success_view', $data, true);
					$this->load->view('template_view', $template);
				} else
				{
					$this->signup();
				}
				
			}
		}
	}
?>