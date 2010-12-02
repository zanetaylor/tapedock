<?php
	class Tape_model extends Model
	{
		function Tape_model()
		{
			parent::Model();
		}
	
		function get_all()
		{
			$query = $this->db->get('tapes');
		
			if ($query->num_rows() == 0)
			{
				return "Nothing here!";
			} else
			{
				return $query->result();
			}
		}
		
		function get_latest()
		{
			$this->db->order_by('create_date DESC');
			$this->db->limit(20);
			$query = $this->db->get('tapes');
			
			if ($query->num_rows() == 0)
			{
				return false;
			} else
			{
				return $query->result();
			}
		}
		
		function get_user_tapes($user_id)
		{
			$this->db->where('creator', $user_id);
			$this->db->order_by('create_date DESC');
			$this->db->limit(20);
			$query = $this->db->get('tapes');
			
			if ($query->num_rows() == 0)
			{
				return false;
			} else
			{
				return $query->result();
			}
		}
	
		function get_tape($tape_id)
		{
			$query = $this->db->get_where('tapes', array('tape_id' => $tape_id));
		
			if ($query->num_rows() == 0)
			{
				return false;
			} else
			{
				return $query->row_array();
			}
		}
	
		function create($data)
		{
			$query = $this->db->insert('tapes', $data);
			
			if($query)
			{
				return $this->db->insert_id();
			} else return false;
		}
	
		function update($data)
		{
			$this->db->where('tape_id', $data['tape_id']);
			$query = $this->db->update('tapes', $data);
		}
	}
?>