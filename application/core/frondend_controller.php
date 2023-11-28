<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Frondend_Controller extends MY_Controller{
	public $public = array();
	function __construct()
	{
		parent::__construct();

		// $this->load->helper(array('form'));
		// $this->load->library(array('form_validation'));
		
		$this->site->side = 'frondend';
		$this->site->template = '';

		// $this->public = array( 
		// 	// 'kategori_list' => $this->kategori->list_kategori_used(),
		// 	// 'kategori_list' => $data_kategori_woo['data'],
		// );

	}
}
