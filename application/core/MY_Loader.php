<?php

class MY_Loader extends CI_Loader
{
	public function __construct()
	{
		parent::__construct();
	}
	public function tview($template_name, $vars = array(), $return = FALSE)
	{
		$vars['account'] = $_SESSION['account'] ?? null ;

		$vars['titel'] = isset($vars['titel']) ? $vars['titel'] : 'คลังสินค้า';
		
		$vars['template_name'] = $template_name;

		if ($return):
			$content = $this->view('templates/header', $vars, $return);
			$content .= $this->view($template_name, $vars, $return);
			$content .= $this->view('templates/footer', $vars, $return);
			return $content;
		else:
			$this->view('templates/header', $vars);
			$this->view($template_name, $vars);
			$this->view('templates/footer', $vars);
		endif;
	}

}
