<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Backend_Controller extends MY_Controller{
	public $menu_nav_link = array();
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->helper(array('form'));
		$this->load->library(array('form_validation','encryption'));
		$this->load->model(array());

		$this->site->side = 'backend';
		$this->site->template = 'default';

		$this->site->is_logged_in();

	}
}
