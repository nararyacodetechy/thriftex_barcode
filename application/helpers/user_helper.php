<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

function bCrypt($pass,$cost){
      $chars='./ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
      $salt=sprintf('$2a$%02d$',$cost);
      mt_srand();
      for($i=0;$i<22;$i++) $salt.=$chars[mt_rand(0,63)];
    return crypt($pass,$salt);
}
function generateRandomToken($length = 32) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $token = '';
    
    for ($i = 0; $i < $length; $i++) {
        $token .= $characters[random_int(0, strlen($characters) - 1)];
    }
    
    return $token;
}
function generateRandomNumber($digitCount) {
    if ($digitCount <= 0) {
        return ''; // Jika digitCount kurang dari atau sama dengan 0, kembalikan string kosong.
    }

    $min = pow(10, $digitCount - 1);
    $max = pow(10, $digitCount) - 1;

    return strval(mt_rand($min, $max));
}

function randomStrings($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $randomString;
}
function getExtensionFromMimeType($mime) {
	$mimeTypes = [
		"image/jpeg" => "jpg",
		"image/png" => "png",
		"image/gif" => "gif",
	];
	return $mimeTypes[$mime] ?? null;
}
function guidv4($data = null) {
    // Generate 16 bytes (128 bits) of random data or use the data passed into the function.
    $data = $data ?? random_bytes(16);
    assert(strlen($data) == 16);

    // Set version to 0100
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
    // Set bits 6-7 to 10
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

    // Output the 36 character UUID.
    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}
function generateRandomString() {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $length = rand(5, 8);
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $randomString;
}
function generateVerificationToken($email) {
    $salt = bin2hex(random_bytes(16));
    $token = hash('sha256', $email . $salt);
    // $encodedEmail = base64_encode($email);
    // $encodedSalt = base64_encode($salt);
    $verificationToken = base64_encode($token);
    
    return $verificationToken;
}
function slugify($string) {
	$string = utf8_encode($string);
	$string = iconv('UTF-8', 'ASCII//TRANSLIT', $string);   
	$string = preg_replace('/[^a-z0-9- ]/i', '', $string);
	$string = str_replace(' ', '-', $string);
	$string = trim($string, '-');
	$string = strtolower($string);
	if (empty($string)) {
		return 'n-a';
	}
	return $string;
}

function clearformat($nilai){
	return str_replace(',', '',$nilai);
}
function status_bayar_badge($string){
	$status_name = '';
	switch ($string) {
		case 'authorize':
			$status_name = '<span class="badge badge-success">Paid</span>';
		break;
		case 'capture':
			$status_name = '<span class="badge badge-success">Paid </span>';
		break;
		case 'settlement':
			$status_name = '<span class="badge badge-success">Paid </span>';
		break;
		case 'deny':
			$status_name = '<span class="badge badge-danger">Terjadi Kesalahan </span>';
		break;
		case 'pending':
			$status_name = '<span class="badge badge-warning">Pending </span>';
		break;
		case 'cancel':
			$status_name = '<span class="badge badge-danger">Cenceled </span>';
		break;
		case 'refund':
			$status_name = '<span class="badge badge-danger">Refund </span>';
		break;
		case 'cancel':
			$status_name = '<span class="badge badge-danger">Cenceled </span>';
		break;
		case 'expire':
			$status_name = '<span class="badge badge-danger">Expire </span>';
		break;
		case 'process':
			$status_name = '<span class="badge badge-success">Process </span>';
		break;
		case 'shipping':
			$status_name = '<span class="badge badge-success">Shipping </span>';
		break;
		case 'finish':
			$status_name = '<span class="badge badge-success">Finish </span>';
		break;
		case 'pending_payment':
			$status_name = '<span class="badge badge-warning">Pending Payment </span>';
		break;
		case 'expired_time_payment':
			$status_name = '<span class="badge badge-danger">Cencel </span>';
		break;
		case 'paid':
			$status_name = '<span class="badge badge-success">Paid </span>';
		break;
		case 'failure':
			$status_name = '<span class="badge badge-warning">Filure </span>';
			break;
		default:
			$status_name = '<span class="badge badge-info">Undefined </span>';
			break;
	}
	return $status_name;
}
function status_bayar($string){
	$status_name = '';
	switch ($string) {
		case 'authorize':
			$status_name = 'Paid';
		break;
		case 'capture':
			$status_name = 'Paid';
		break;
		case 'settlement':
			$status_name = 'Paid';
		break;
		case 'deny':
			$status_name = 'Terjadi Kesalahan';
		break;
		case 'pending':
			$status_name = 'Pending';
		break;
		case 'cancel':
			$status_name = 'Cenceled';
		break;
		case 'refund':
			$status_name = 'Refund';
		break;
		case 'cancel':
			$status_name = 'Cenceled';
		break;
		case 'expire':
			$status_name = 'Expire';
		break;
		case 'failure':
			$status_name = 'Filure';
			break;
		default:
			$status_name = 'Undefined';
			break;
	}
	return $status_name;
}
function rupiah($angka)
{
    if(!empty($angka)){
        $hasil_rupiah = number_format($angka,0,",",".");
        return $hasil_rupiah;
    }else{
        return 0;
    }
}
function kg_to_gram($berat_kg) {
    $berat_gram = $berat_kg * 1000;
    return $berat_gram;
}
function rupiah_koma($angka)
{
    if(!empty($angka)){
        $hasil_rupiah = number_format($angka,0,".",",");
        return $hasil_rupiah;
    }else{
        return 0;
    }
}
function formatTanggal($tanggal) {
    $bulan = array(
        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    );

    $timestamp = strtotime($tanggal);
    $tanggalFormatted = date('j', $timestamp) . ' ' . $bulan[date('n', $timestamp) - 1] . ' ' . date('Y', $timestamp);
    
    $dateTime = new DateTime($tanggal);
    $dateTime->setTimezone(new DateTimeZone('Asia/Jakarta'));
    $waktuFormatted = $dateTime->format('H:i T');

    return $tanggalFormatted . ', ' . $waktuFormatted;
}

function tgl_indo($tanggal){
	$bulan = array (
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
	$pecahkan = explode('-', $tanggal);
	
	// variabel pecahkan 0 = tanggal
	// variabel pecahkan 1 = bulan
	// variabel pecahkan 2 = tahun
 
	return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}
function tgl_waktu_indo($tanggal){
	$bulan = array (
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
	$pecahkan = explode(' ', $tanggal);
	$tgl = explode('-',$pecahkan[0]);
	
	// variabel pecahkan 0 = tanggal
	// variabel pecahkan 1 = bulan
	// variabel pecahkan 2 = tahun
 
	return $tgl[2] . ' ' . $bulan[ (int)$tgl[1] ] . ' ' . $tgl[0].' '.$pecahkan[1];
}
function tgl_waktu_eng($tanggal){
	if(!empty($tanggal)){
		$bulan = array (
			1 =>   'Jan',
			'Feb',
			'Mar',
			'Apr',
			'May',
			'Jun',
			'Jul',
			'Aug',
			'Sep',
			'Oct',
			'Nov',
			'Dec'
		);
		$pecahkan = explode(' ', $tanggal);
		$tgl = explode('-',$pecahkan[0]);
		
		// variabel pecahkan 0 = tanggal
		// variabel pecahkan 1 = bulan
		// variabel pecahkan 2 = tahun
	 
		return $tgl[2] . ' ' . $bulan[ (int)$tgl[1] ] . ' ' . $tgl[0].' '.$pecahkan[1];
	}
}

function createNotif($session){
	$notif = $session; 
	if(isset($notif) && !empty($notif)){
		if(@$notif['status'] == true || @$notif['status'] == 200){
			?>
			<div class="alert alert-success" role="alert"><?= @$notif['msg'] ?></div>
			<?php 
		}else{
			?>
			<div class="alert alert-danger" role="alert"><?= @$notif['msg'] ?></div>
			<?php 
		}
	}
}

 function trim_special_char($text)
    {
        $str = str_replace("(", '_:', $text);
        $str = str_replace(")", ':_', $str);
        $str = str_replace("/", '_slash', $str);
        $str = str_replace("+", '_plus', $str);
        $str = str_replace("&", '_and', $str);
        $str = str_replace("'", '_ss', $str);
        $str = str_replace("x", '_X', $str);
        $str = str_replace('"', '_cot', $str);
        $str = str_replace('!', '_cit', $str);

        return $str;
    }
	 function set_special_char($text)
    {
        $str = str_replace('_:',  "(", $text);
        $str = str_replace(':_', ")", $str);
        $str = str_replace('_slash', "/", $str);
        $str = str_replace('_plus', "+", $str);
        $str = str_replace('_and', "&", $str);
        $str = str_replace('_ss', "'", $str);
        $str = str_replace('_X', "x", $str);
        $str = str_replace('_cot', '"', $str);
        $str = str_replace('_cit', '!', $str);

        return $str;
    }

	if (!function_exists('_harga_produk')) {
		function _harga_produk($price) {
			$CI = &get_instance();
			$CI->load->library('session');
			// $CI->load->model('Product_model');
			$CI->load->model('Dealer_kategori_model','seller_harga');
			$harga = '<span class="item-price">Rp <span class="haga_produk">'.rupiah($price).'</span></span>';
			if(isset($CI->session->userdata['logged_in']) && $CI->session->userdata['level'] == 'user'){
				if($CI->session->userdata['is_member'] == true && $CI->session->userdata['member_type'] > 0){
					$harga_seller = $CI->seller_harga->get_by(array('id' => $CI->session->userdata['member_type']),'','',true,array('minimum_pembelian','potongan'));
					$diskon = $harga_seller->potongan / 100;
					$kalkulasi_diskon = $price*$diskon;
					$hp_diskon = $price - $kalkulasi_diskon;
					// $harga_produk = (100% - )
					$harga = '<p>Rp <s class="haga_produk">'.rupiah($price).'</s></p><div class="item-price">Rp <span class="haga_produk_promo">'.rupiah($hp_diskon).'</span></div>';
					$harga .= '<div class="alert alert-warning">Untuk Member : Min. '.$harga_seller->minimum_pembelian.' mendapakatn potongan '.$harga_seller->potongan.'% / item</div>';
				}
			}
			
			return $harga;
		}
	}

	// Enkripsi data tanggal dan waktu
	function encryptData($data) {
		$encryptedData = base64_encode($data);
		return str_replace('+', '', $encryptedData); // Menghilangkan karakter '+'
	}

	// Mendekripsi data tanggal dan waktu
	function decryptData($encryptedData) {
		$paddedData = str_pad($encryptedData, strlen($encryptedData) + (4 - strlen($encryptedData) % 4) % 4, '=');
		return base64_decode($paddedData);
	}
	// $encryptionKey = 'KunciRahasiaAnda';
	// $data = 'Data rahasia yang akan dienkripsi';
	
	// $encryptedData = encryptData($data, $encryptionKey);
	// echo 'Data Terenkripsi: ' . $encryptedData . '<br>';
	
	// $decryptedData = decryptData($encryptedData, $encryptionKey);
	// echo 'Data Terdekripsi: ' . $decryptedData;


	function countdowntime($timetarget){
		$batasWaktuBayar = new DateTime($timetarget);
		$sekarang = new DateTime();
		$selisih = $batasWaktuBayar->getTimestamp() - $sekarang->getTimestamp();
		if ($selisih <= 0) {
			$response = array(
				'is_expired'	=> true,
				'color'			=> 'danger',
				'msg'		 	=>'Payment time has expired'
			);
		}else{
			$hari = floor($selisih / (60 * 60 * 24));
			$jam = floor(($selisih % (60 * 60 * 24)) / (60 * 60));
			$menit = floor(($selisih % (60 * 60)) / 60);
			$detik = $selisih % 60;
			$response = array(
				'is_expired'	=> false,
				'color'			=> 'warning',
				'msg'		 	=> $jam.":".$menit.":".$detik
			);
		}
		return $response;
	}

?>
