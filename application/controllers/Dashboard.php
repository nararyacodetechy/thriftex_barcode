<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Backend_Controller {

	public function index()
	{
		$this->load->view('dashboard/index.php');
	}
	
}
