<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Warehouse_li
{

    protected $CI;
    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->model("ADMIN_MODELS");

    }

    


}
