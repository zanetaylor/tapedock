<?php
	class Page_model extends Model
	{
		function Page_model()
		{
			parent::Model();
		}
	
		function get_page($url_title)
		{
			$query = $this->db->get_where('pages', array('url_title' => $url_title));
		
			if ($query->num_rows() == 0)
			{
				return false;
			} else
			{
				return $query->row_array();
			}
		}
	}
?>