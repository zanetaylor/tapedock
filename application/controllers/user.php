<?php
	class User extends Controller
	{
		function index()
		{
			$is_logged_in = $this->session->userdata('is_logged_in');
			if (!$is_logged_in)
			{
				redirect('user/login');
			} else
			{
				$data = array(
					'page_title'=> "USER PROFILE"
				);
				
				$template['content'] = $this->load->view('user/profile_view', $data, true);
				$this->load->view('template_view', $template);
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
		
		function login()
		{
			$is_logged_in = $this->session->userdata('is_logged_in');
			if (!$is_logged_in)
			{
				$data = array(
					'page_title'=> "Login"
				);
				
				$template['content'] = $this->load->view('user/login_view', $data, true);
				$this->load->view('template_view', $template);
			} else
			{
				redirect('/');
			}
		}
		
		function logout()
		{
			$this->session->sess_destroy();      
      		$this->login();
		}
		
		function validate()
		{
			$this->load->model('user_model');
			
			$query = $this->user_model->validate();
			
			if($query) // if validated
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