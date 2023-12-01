<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Backend_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array(
			'User_model' => 'user',
			'Barcode_model' => 'barcode',
			'Barcode_img_model' => 'barcode_img',
			'Barcode_img_produk_model' => 'barcode_img_produk',
			'Barcode_profile_model'       => 'barcode_profile'
		));
		date_default_timezone_set('Asia/Makassar');
	}
	
	public function index()
	{
		$token = get_cookie('_ath');
        $data_user = $this->user->checkuser($token);
		$data_barcode = $this->barcode->list_barcode($data_user['data']['user_id']);
		$data = array(
			'data_barcode' => $data_barcode
		);
        $this->load->view('dashboard/barcode.php',$data);
		// $this->load->view('dashboard/index.php');
	}
	
}
