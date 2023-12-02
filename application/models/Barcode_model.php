<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barcode_model extends MY_Model
{

    protected $_table_name = 'barcode';
	protected $_primary_key = 'id';
	protected $_order_by = 'id';
	protected $_order_by_type = 'desc';
    
	public function list_barcode($id_user){
		$this->db->select('tbl_barcode.*,tbl_barcode_profile.nama_brand');
		$this->db->join('tbl_barcode_profile','tbl_barcode.id_profile_barcode = tbl_barcode_profile.id','join');
		$this->db->where('tbl_barcode.user_id',$id_user);
		$this->db->where('tbl_barcode.status','publish');
		return $this->db->get($this->_table_name)->result();
	}

	public function barcode_single($condition=null){
		$this->db->select('tbl_barcode.*,tbl_barcode_profile.nama_brand,tbl_barcode_profile.url_toko');
		$this->db->join('tbl_barcode_profile','tbl_barcode.id_profile_barcode = tbl_barcode_profile.id','join');
		if(!empty($condition)){
			$this->db->where($condition);
		}
		return $this->db->get($this->_table_name)->row();
	}
}
