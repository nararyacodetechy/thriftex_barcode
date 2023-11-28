<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Site{
	public $side;
	public $template;
	public $template_setting;
	public $website_setting;
	public $_isHome = FALSE;
	public $_isCategory = FALSE;
	public $_isSearch = FALSE;
	public $_isDetail = FALSE;


	public function view($page,$data = NULL,$return=FALSE){
		$_this =& get_instance();
		if($data){
			return $_this->load->view($this->side.'/'.$this->template.'/'.$page,$data,$return);
		}else{
			return $_this->load->view($this->side.'/'.$this->template.'/'.$page);
		}
	}



	public function is_logged_in(){
		$_this =& get_instance();
		$user_session = $_this->session->userdata;
		if($this->side == 'backend'){
			if($_this->uri->segment(2) == 'login'){
				if(isset($user_session['login']) && @$user_session['login'] == TRUE){
					redirect(base_url('admin'));
				}
			}else{
				if(!isset($user_session['login'])){
					$_this->session->sess_destroy();
					redirect(base_url('login'));
				}
			}
			if(isset($user_session['login']) && @$user_session['login'] == TRUE){
				// $_this->session->sess_destroy();
				// redirect(base_url(''));
			}
		}else{
			if(!isset($user_session['login'])){
				$_this->session->sess_destroy();
				redirect(base_url(''));
			}
		}

	}
}
