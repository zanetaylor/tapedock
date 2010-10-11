<?php
	class User extends Controller
	{
		function index()
		{
			$this->load->model('user_model');
			
			$data = array(
				'page_title'=> "All the Tapes!",
				'tapes'		=> $this->tape_model->get_all()
			);
			
			$template['menu'] = $this->load->view('menu_view', $data, true);
			$template['content'] = $this->load->view('list_view', $data, true);
			$this->load->view('template_view', $template);
		}
	}
?>