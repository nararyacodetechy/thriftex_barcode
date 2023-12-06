<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends Backend_Controller {

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
        $this->load->library('upload');
		date_default_timezone_set('Asia/Makassar');
	}

	public function index()
	{
        $token = get_cookie('_ath');
        $data_user = $this->user->checkuser($token);
        if($data_user['status'] == true){
            $data = array(
                'data_profile' => $this->barcode_profile->get_by(array('id_user' => $data_user['data']['user_id']),null,null,true)
            );
            $this->load->view('dashboard/profile.php',$data);
        }
	}
    public function save_profile(){
        $data = $this->input->post();
        $token = get_cookie('_ath');
        $data_user = $this->user->checkuser($token);
        if($data_user['status'] == true){

            // $upload = $this->process_upload('files');
            // var_dump($upload);
            $cek_profile = $this->barcode_profile->count(array('id_user' => $data_user['data']['user_id']));
            if($cek_profile > 0){
                $data_insert = array(
                    // 'logo'          =>'',
                    'nama_brand'    => $data['nama_brand'],
                    // 'url_toko'      => $data['url_toko'],
                    'deskripsi_toko' => $data['deskripsi_profile'],
                    'updated_at'    => date('y-m-d H:i:s')
                );
                $insert = $this->barcode_profile->update($data_insert,array('id_user' => $data_user['data']['user_id']));
            }else{
                $data_insert = array(
                    'id_user'       => $data_user['data']['user_id'],
                    // 'logo'          =>'',
                    'nama_brand'    => $data['nama_brand'],
                    'url_toko'      => $data['url_toko'],
                    'deskripsi_toko' => $data['deskripsi_profile']
                );
                $insert = $this->barcode_profile->insert($data_insert);
            }
            if($insert){
                $response = array(
                    'status' => true,
                    'color'	=>'success',
                    'msg'   => 'Profile Berhasil disimpan'
                );
            }else{
                $response = array(
                    'status' => false,
                    'color'	=>'danger',
                    'msg'   => 'Gagal, terjadi kesalahan'
                );
            }
            echo json_encode($response);
        }
    }


}
