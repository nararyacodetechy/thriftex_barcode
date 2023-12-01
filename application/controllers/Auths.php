<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auths extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model','user');
		date_default_timezone_set('Asia/Makassar');
	}

	public function index()
	{
		$this->load->view('dashboard/login.php');
	}


	public function login_proses(){
        $response = array(
            'status' => false,
            'msg'   => 'Server Error'
        );
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_message('required', '{field} tidak boleh kosong!');
        $this->form_validation->set_error_delimiters('<p>', '</p>');
        if ($this->form_validation->run() == FALSE){
            $response = array(
                'status'   => false,
                'msg' => form_error('email').' '.form_error('password')
            );
        }else{
            $data_login = [
                'email' => $email,
                'password'  => $password
            ];
            $cek_login = $this->user->cek_login($data_login);
            $cek_user = $this->user->checkuser($cek_login['token']);
            if(!empty($cek_user) && $cek_user['data']['role'] == 'toko'){
                if($cek_user['status'] == true){
                    $data_login = array(
                        'login' => true,
                        'uid'   => $cek_login['uid'],
                        'token' => $cek_login['token']
                    );
                    $this->session->set_userdata($data_login);
                    // $cookie = array(
                    //     'name'   => 'ath',
                    //     'value'  => $cek_login['token'],
                    //     'expire' =>  92000,
                    //     'secure' => false
                    // );
                    // $this->input->set_cookie($cookie); 
                    $response = array(
                        'status' => true,
                        'redirect_url'  => base_url()
                    );
                }else{
                    $response = array(
                        'status' => $cek_login['status'],
                        'msg'   => $cek_login['message']
                    );
                }
            }else{
                $response = array(
                    'status' => false,
                    'msg'   => 'Gagal login'
                );
            }
        }
        echo json_encode($response);
	}
	public function logout(){
        $this->session->sess_destroy();
		delete_cookie('ath');
		redirect(base_url());
    }


}
