<?php
class Helloworld_model extends Model
{
	function Helloworld_model()
	{
		parent::Model();
	}
	
	function getData()
	{
		$query = $this->db->get('data');
		
		if ($query->num_rows() == 0)
		{
			
		} else
		{
			return $query->result();
		}
	}
}
?>