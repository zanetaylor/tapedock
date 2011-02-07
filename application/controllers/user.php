<?php
	class User extends Controller
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
	
		function index($error_msg=0)
		{
			$is_logged_in = $this->session->userdata('is_logged_in');
			if (!$is_logged_in)
			{
				$this->login($error_msg);
				//redirect('user/login');
			} else
			{
				$username = $this->session->userdata('username');
				$this->show($username);
			}
		}
		
		function show($username=0)
		{
			$is_logged_in = $this->session->userdata('is_logged_in');
			if (!$is_logged_in)
			{
				redirect('user/login');
			} else
			{
				$this->load->model('user_model');
				
				if (!$username)
				{
					$username = $this->session->userdata('username');
				}
				
				$user = $this->user_model->get_user($username);
				
				if ($user)
				{
					$data = array(
						'page_title'=> "USER PROFILE",
						'user'		=> $user
					);
					
					$template['content'] = $this->load->view('user/profile_view', $data, true);
					$this->load->view('template_view', $template);
				} else $this->index();
			}
		}
		
		function signup()
		{
			$data = array(
				'page_title'=> "SIGNUP"
			);
			
			$template['content'] = $this->load->view('user/signup_view', $data, true);
			$this->load->view('template_view', $template);
		}
		
		function login($error_msg=0)
		{
			$is_logged_in = $this->session->userdata('is_logged_in');
			if (!$is_logged_in)
			{
				$data = array(
					'page_title'=> "Login"
				);
				$template['content'] = $this->load->view('user/login_view', $data, true);
				
				if ($error_msg)
				{
					$error_data['error_msg'] = $error_msg;
					$template['error'] = $this->load->view('error_view', $error_data, true);
				}

				$this->load->view('template_view', $template);
			} else
			{
				redirect('/');
			}
		}
		
		function logout()
		{
			$this->session->sess_destroy();      
      		redirect('/');
		}
		
		function validate()
		{
			$this->load->model('user_model');
			
			$query = $this->user_model->validate();
			
			if ($query) // if validated
			{
				//$upload_dir_num = rand();
				//$upload_dir = "uploads/".$upload_dir_num."/";
				
				$user_id = $query['user_id'];
				$username = $query['username'];
				
				do
				{
					$upload_dir_num = rand();
					$upload_dir = $user_id."_".$upload_dir_num;
					$upload_path = "uploads/".$user_id."_".$upload_dir_num."/";
				} while(file_exists($upload_path));				
			
				$data = array(
					'user_id'		=> $user_id,
					'username'		=> $username,
					'is_logged_in'	=> true,
					'upload_dir'	=> $upload_dir
				);
				
				$this->session->set_userdata($data);
				redirect('/');
			} else
			{
				$error_msg = "Login failed. Double-check your username and password.";
				$this->index($error_msg);
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
				
					$template['content'] = $this->load->view('user/signup_success_view', $data, true);
					$this->load->view('template_view', $template);
				} else
				{
					$this->signup();
				}
				
			}
		}
	}
?>