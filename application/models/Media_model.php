<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Media_model extends MY_Model
{

    protected $_table_name = 'media';
	protected $_primary_key = 'id';
	protected $_order_by = 'id';
	protected $_order_by_type = 'desc';
    
}
