<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barcode extends Backend_Controller {

    public function __construct()
	{
		parent::__construct();
		$this->load->model(array(
			'User_model' => 'user',
			'Barcode_model' => 'barcode',
			'Barcode_img_model' => 'barcode_img'
		));
		date_default_timezone_set('Asia/Makassar');
	}
	public function index()
	{
		$token = get_cookie('ath');
        $data_user = $this->user->checkuser($token);
		$data_barcode = $this->barcode->get_by(array('status' => 'publish','user_id' => $data_user['data']['user_id']),null,null,false);
		$data = array(
			'data_barcode' => $data_barcode
		);
        $this->load->view('dashboard/barcode.php',$data);
	}
	public function barcode_new()
	{
        $token = get_cookie('ath');
        $data_user = $this->user->checkuser($token);
        $get_copy_id = $this->input->get('copy');
		$data_copy = '';
		if(isset($get_copy_id)){
			$data_copy = $this->barcode->get_by(array('barcode_uuid' => $get_copy_id,'user_id' => $data_user['data']['user_id']),null,null,true);
		}
        $data = array(
            'data_user' => $data_user,
			'data_copy' => $data_copy
        );
		$this->load->view('dashboard/barcode_add.php',$data);
	}

	public function barcode_create(){
		$response = array(
			'status' => false,
			'color'	=>'danger',
			'msg'   => 'Gagal, terjadi kesalahan'
		);
		$data = $this->input->post();
		$token = get_cookie('ath');
        $data_user = $this->user->checkuser($token);
		$data_barcode = array(
			'barcode_uuid'	=> generateRandomNumber(5),
			'user_id'		=> $data_user['data']['user_id'],
			'user_kode'		=> $data_user['data']['user_code'],
			'nama_brand'	=> $data['nama_brand'],
			'nama_produk'	=> $data['nama_produk'],
			'jenis'			=> $data['jenis'],
			'cerita'		=> $data['cerita'],
			'warna'			=> $data['warna'],
			'ukuran'		=> $data['ukuran'],
			'ukuran_kode'	=> $data['ukuran_kode'],
			'jumlah'		=> $data['jumlah'],
		);
		$insert = $this->barcode->insert($data_barcode);
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
	public function barcode_delete($id){
		$delete = $this->barcode->update(array('status' => 'deleted'),array('barcode_uuid' => $id));
		if($delete){
			redirect(base_url('barcode'));
		}else{
			redirect(base_url('barcode'));
		}
	}


	public function barcode_edit($id){
		$token = get_cookie('ath');
        $data_user = $this->user->checkuser($token);
		$data_edit = $this->barcode->get_by(array('barcode_uuid' => $id,'user_id' => $data_user['data']['user_id']),null,null,true);
        $data = array(
			'data_edit' => $data_edit,
			'id_edit' => $id
        );
		$this->load->view('dashboard/barcode_edit.php',$data);
	}

	public function barcode_edit_save($id){
		if(!empty($id)){

			$response = array(
				'status' => false,
				'color'	=>'danger',
				'msg'   => 'Gagal, terjadi kesalahan'
			);
			$data = $this->input->post();
			$token = get_cookie('ath');
			$data_user = $this->user->checkuser($token);
			$data_barcode = array(
				'barcode_uuid'	=> generateRandomNumber(5),
				'user_id'		=> $data_user['data']['user_id'],
				'user_kode'		=> $data_user['data']['user_code'],
				'nama_brand'	=> $data['nama_brand'],
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
		$token = get_cookie('ath');
        $data_user = $this->user->checkuser($token);
		$data_barcode = $this->barcode->get_by(array('barcode_uuid' => $id,'user_id' => $data_user['data']['user_id']),null,null,true);
		// cek sudah ada di database
		$cek_barcode = $this->barcode_img->get_by(array('id_barcode' => $data_barcode->id),null,null,false);
		if($data_barcode->payment_status == 'paid'){
			if(count($cek_barcode) < 1){
				for ($i=1; $i <= $data_barcode->jumlah; $i++) {
					$filenames = $data_barcode->user_kode.'-'.$data_barcode->ukuran_kode.'-'.$i.'-'.$data_barcode->jumlah.'x.png';
					$url_data_qr = 'https://thriftex.id/'.slugify($data_barcode->nama_brand).'/'.$data_barcode->user_kode.'-'.$data_barcode->ukuran_kode.'-'.$i.'-'.$data_barcode->jumlah.'x';
					if(file_exists(FCPATH.'qr/'.$filenames)){
						unlink(FCPATH.'qr/'.$filenames);
					}
					$data_insert = array(
						'id_barcode'	=> $data_barcode->id,
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

	public function barcode_download($id){
		$this->load->library('zip');
		$token = get_cookie('ath');
        $data_user = $this->user->checkuser($token);
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
