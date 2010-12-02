<?php
	class User_model extends Model
	{
		function User_model()
		{
			parent::Model();
		}
		
		function validate()
		{
			$this->db->where('username', $this->input->post('username'));
			$this->db->where('password', md5($this->input->post('password')));
			
			$query = $this->db->get('users');
			
			if($query->num_rows == 1)
			{
				return $query->row_array();
			} else return false;
		}
		
		function create()
		{
			$new_user_insert_data = array(
				'username' => $this->input->post('username'),
				'password' => md5($this->input->post('password')),
				'email' => $this->input->post('email')
			);
			
			$insert = $this->db->insert('users', $new_user_insert_data);
			
			return $insert;
		}
	}
?>