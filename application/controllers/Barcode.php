<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barcode extends Backend_Controller {

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
	}
	public function barcode_new()
	{
        $token = get_cookie('_ath');
        $data_user = $this->user->checkuser($token);
		if($data_user['status'] == true){
			$get_copy_id = $this->input->get('copy');
			$data_copy = '';
			if(isset($get_copy_id)){
				$data_copy = $this->barcode->get_by(array('barcode_uuid' => $get_copy_id,'user_id' => $data_user['data']['user_id']),null,null,true);
			}
	
			$data = array(
				'data_user' => $data_user,
				'data_copy' => $data_copy,
				'data_profile' => $this->barcode_profile->get_by(array('id_user' => $data_user['data']['user_id']),null,null,true)
			);
			$this->load->view('dashboard/barcode_add.php',$data);
		}
	}

	public function set_upload_options_kategori()
	{   
		$config = array();
		$config['upload_path'] = './upload/produk/';
		$config['allowed_types'] = 'png|jpeg|jpg|webp';
		$config['overwrite']     = FALSE;
		$config['encrypt_name'] = TRUE;
	
		return $config;
	}
	public function barcode_create(){
		$this->load->library('upload');
		$response = array(
			'status' => false,
			'color'	=>'danger',
			'msg'   => 'Gagal, terjadi kesalahan'
		);
		$data = $this->input->post();
		$token = get_cookie('_ath');
        $data_user = $this->user->checkuser($token);
		if($data_user['status'] == true){
			if(isset($_FILES) && count(array_filter($_FILES['produkimage']['name'])) > 0) {
				$data_profile = $this->barcode_profile->get_by(array('id_user' => $data_user['data']['user_id']),null,null,true);
				$data_barcode = array(
					'barcode_uuid'	=> generateRandomNumber(5),
					'user_id'		=> $data_user['data']['user_id'],
					'user_kode'		=> $data_user['data']['user_code'],
					'id_profile_barcode' => $data_profile->id,
					'nama_produk'	=> $data['nama_produk'],
					'jenis'			=> $data['jenis'],
					'cerita'		=> $data['cerita'],
					'warna'			=> $data['warna'],
					'ukuran'		=> $data['ukuran'],
					'ukuran_kode'	=> $data['ukuran_kode'],
					'jumlah'		=> $data['jumlah'],
				);
				$insert = $this->barcode->insert($data_barcode);
				for ($i = 0; $i < count(array_filter($_FILES['produkimage']['name'])); $i++) {
					if(isset($_FILES) && is_array($_FILES) && count($_FILES)) {
						$files = $_FILES;
						$_FILES['file']['type']= $files['produkimage']['type'][$i];
						$_FILES['file']['name']= $files['produkimage']['name'][$i];
						$_FILES['file']['tmp_name'] = $files['produkimage']['tmp_name'][$i];
						$_FILES['file']['error']= $files['produkimage']['error'][$i];
						$_FILES['file']['size'] = $files['produkimage']['size'][$i];
						$this->upload->initialize($this->set_upload_options_kategori());
						if($this->upload->do_upload('file')){
							$dataimg = array('upload_data' => $this->upload->data());
							$data_insert = array(
								'id_barcode' => $insert,
								'img_url'  => base_url('upload/produk/'.$dataimg['upload_data']['file_name'])
							);
							$this->barcode_img_produk->insert($data_insert);
						}else{
							$response = array(
								'status'    => false,
								'color'     => 'danger',
								'msg'       => '<svg fill="#fff" width="20" height="20" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg"><title>warning</title><path d="M30.555 25.219l-12.519-21.436c-1.044-1.044-2.738-1.044-3.782 0l-12.52 21.436c-1.044 1.043-1.044 2.736 0 3.781h28.82c1.046-1.045 1.046-2.738 0.001-3.781zM14.992 11.478c0-0.829 0.672-1.5 1.5-1.5s1.5 0.671 1.5 1.5v7c0 0.828-0.672 1.5-1.5 1.5s-1.5-0.672-1.5-1.5v-7zM16.501 24.986c-0.828 0-1.5-0.67-1.5-1.5 0-0.828 0.672-1.5 1.5-1.5s1.5 0.672 1.5 1.5c0 0.83-0.672 1.5-1.5 1.5z"></path></svg> Gagal, terjadi kesalahan',
								'error_upload' => $this->upload->display_errors()
							);
						}
					}
				}
				if($insert){
					$response = array(
						'status' => true,
						'color'	=>'success',
						'msg'   => 'Barcode Berhasil dibuat',
						'redirect_url' => base_url('barcode')
					);
				}else{
					$response = array(
						'status' => false,
						'color'	=>'danger',
						'msg'   => 'Gagal, terjadi kesalahan'
					);
				}
			}else{
				$response = array(
					'status'    => false,
					'color'     => 'danger',
					'msg'       => '<svg fill="#fff" width="20" height="20" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg"><title>warning</title><path d="M30.555 25.219l-12.519-21.436c-1.044-1.044-2.738-1.044-3.782 0l-12.52 21.436c-1.044 1.043-1.044 2.736 0 3.781h28.82c1.046-1.045 1.046-2.738 0.001-3.781zM14.992 11.478c0-0.829 0.672-1.5 1.5-1.5s1.5 0.671 1.5 1.5v7c0 0.828-0.672 1.5-1.5 1.5s-1.5-0.672-1.5-1.5v-7zM16.501 24.986c-0.828 0-1.5-0.67-1.5-1.5 0-0.828 0.672-1.5 1.5-1.5s1.5 0.672 1.5 1.5c0 0.83-0.672 1.5-1.5 1.5z"></path></svg> Gambar Katalog Kosong!'
				);
			}
			echo json_encode($response);
		}
	}
	public function barcode_delete($id){
		$token = get_cookie('_ath');
        $data_user = $this->user->checkuser($token);
		if($data_user['status'] == true){
			$delete = $this->barcode->update(array('status' => 'deleted'),array('barcode_uuid' => $id));
			if($delete){
				redirect(base_url('barcode'));
			}else{
				redirect(base_url('barcode'));
			}
		}
	}


	public function barcode_edit($id){
		$token = get_cookie('_ath');
        $data_user = $this->user->checkuser($token);
		if($data_user['status'] == true){
			$data_edit = $this->barcode->get_by(array('barcode_uuid' => $id,'user_id' => $data_user['data']['user_id']),null,null,true);
			$data = array(
				'data_edit' => $data_edit,
				'id_edit' => $id,
				'data_profile' => $this->barcode_profile->get_by(array('id_user' => $data_user['data']['user_id']),null,null,true)
			);
			$this->load->view('dashboard/barcode_edit.php',$data);
		}
	}

	public function barcode_edit_save($id){
		if(!empty($id)){
			$response = array(
				'status' => false,
				'color'	=>'danger',
				'msg'   => 'Gagal, terjadi kesalahan'
			);
			$data = $this->input->post();
			$token = get_cookie('_ath');
			$data_user = $this->user->checkuser($token);
			if($data_user['status'] == true){
				$data_barcode = array(
					'barcode_uuid'	=> generateRandomNumber(5),
					'user_id'		=> $data_user['data']['user_id'],
					'user_kode'		=> $data_user['data']['user_code'],
					'nama_produk'	=> $data['nama_produk'],
					'jenis'			=> $data['jenis'],
					'cerita'		=> $data['cerita'],
					'warna'			=> $data['warna'],
					'ukuran'		=> $data['ukuran'],
					'jumlah'		=> $data['jumlah'],
				);
				$insert = $this->barcode->update($data_barcode,array('barcode_uuid' => $id));
				if($insert){
					$response = array(
						'status' => true,
						'color'	=>'success',
						'msg'   => 'Barcode Berhasil dibuat',
						'redirect_url' => base_url('barcode')
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
	public function generate_qr($url_data_qr,$file_name){
		$kodeqr = $url_data_qr;

		$this->load->library('ciqrcode');
		$params['data'] = $kodeqr;
		$params['level'] = 'H';
		$params['size'] = 20;
		$params['savename'] = FCPATH.'qr/'.$file_name;
		return $this->ciqrcode->generate($params);
	}
	public function barcode_cetak($id){
		$token = get_cookie('_ath');
        $data_user = $this->user->checkuser($token);
		if($data_user['status'] == true){
			$data_barcode = $this->barcode->barcode_single(array('tbl_barcode.barcode_uuid' => $id,'tbl_barcode.user_id' => $data_user['data']['user_id']));
			// cek sudah ada di database
			$cek_barcode = $this->barcode_img->get_by(array('id_barcode' => $data_barcode->id),null,null,false);
			if($data_barcode->payment_status == 'paid'){
				if(count($cek_barcode) < 1){
					for ($i=1; $i <= $data_barcode->jumlah; $i++) {
						$filenames = $data_barcode->user_kode.'-'.$data_barcode->ukuran_kode.'-'.$i.'-'.$data_barcode->jumlah.'x.png';
						$url_data_qr = 'https://thriftex.id/'.$data_barcode->url_toko.'/'.$data_barcode->user_kode.'-'.$data_barcode->ukuran_kode.'-'.$i.'-'.$data_barcode->jumlah.'x';
						if(file_exists(FCPATH.'qr/'.$filenames)){
							unlink(FCPATH.'qr/'.$filenames);
						}
						$data_insert = array(
							'id_barcode'	=> $data_barcode->id,
							'barcode_kode'	=> $data_barcode->user_kode.'-'.$data_barcode->ukuran_kode.'-'.$i.'-'.$data_barcode->jumlah.'x',
							'file_name'	=> $filenames
						);
						$this->barcode_img->insert($data_insert);
						$this->generate_qr($url_data_qr,$filenames);
					}
					$data_qr = $this->barcode_img->get_by(array('id_barcode' => $data_barcode->id),null,null,false);
				}else{
					$data_qr = $cek_barcode;
				}
				$status_barcode = '';
			}else if($data_barcode->payment_status == 'cencel'){
				$data_qr = array();
				$status_barcode = '<div class="alert alert-danger" role="alert">Permintaan QR Code Ditolak</div>';
			}else{
				$data_qr = array();
				$status_barcode = '<div class="alert alert-warning" role="alert">Menunggu Pembayaran</div>';
			}
			$data = array(
				'id_barcode'	=> $id,
				'data_barcode' =>$data_qr,
				'status_barcode' => $status_barcode
			);
			$this->load->view('dashboard/barcode_cetak.php',$data);
		}
	}

	public function barcode_download($id){
		$this->load->library('zip');
		$token = get_cookie('_ath');
        $data_user = $this->user->checkuser($token);
		if($data_user['status'] == true){
			$data_barcode = $this->barcode->get_by(array('barcode_uuid' => $id,'user_id' => $data_user['data']['user_id']),null,null,true);
			$cek_barcode = $this->barcode_img->get_by(array('id_barcode' => $data_barcode->id),null,null,false);
			if(count($cek_barcode) > 1){
				foreach ($cek_barcode as $key => $value) {
					$this->zip->read_file('qr/'.$value->file_name);
				}
				$this->zip->download(''.time().'.zip');
			}else{
				echo 'Belum ada qrcode!';
			}
		}
	}



}
