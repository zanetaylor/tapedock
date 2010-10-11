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
	
		function get_tape($tape_id)
		{
			$query = $this->db->get_where('tapes', array('tape_id' => $tape_id));
		
			if ($query->num_rows() == 0)
			{
				return "Nothing here!";
			} else
			{
				return $query->row_array();
			}
		}
	
		function create($data)
		{
			$query = $this->db->insert('tapes', $data);
		}
	
		function update($data)
		{
			$this->db->where('tape_id', $data['tape_id']);
			$query = $this->db->update('tapes', $data);
		}
	}
?>