<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public $MYSQL = null;
    public function __construct()
    {
        parent::__construct();

        $this->load->model("ADMIN_MODELS");
        $this->load->model("EMPLOYEE_MODELS");
        $this->MYSQL = $this->load->database('MYSQL', TRUE);

    }

    public function index()
    {
        $this->loginEm();
    }
    public function loginEm()
    {
        $this->load->view("auth/login");
    }
    public function loginAdmin()
    {
        $this->load->view("auth/loginAdmin");
    }

    public function submitLogin()
    {

        $Inpost = (object) $this->input->post();
        $Account = new stdClass();

        switch ($Inpost->type) {
            case '1':
                // เข้าสู่ระบบพนักงาน
                $EM_USERNAME = $Inpost->EM_USERNAME;
                $EM_PASSWORD = $Inpost->EM_PASSWORD;

                $query = $this->db->query("SELECT *  FROM employee WHERE EM_USERNAME = '$EM_USERNAME' AND EM_PASSWORD = '$EM_PASSWORD' LIMIT 1  ");
                $result = $query->result('object');

                foreach ($result as $key => $item):

                    
                    if ($EM_USERNAME == $item->EM_USERNAME && $EM_PASSWORD == $item->EM_PASSWORD) {

                        $Account->ID = $item->EM_ID;
                        $Account->TYPE = '1';
                        $Account->CODE = $item->EM_CODE;
                        $Account->NAME = $item->EM_NAME . " " . $item->EM_LASTNAME;
                        $_SESSION["account"] = $Account;

                        redirect(base_url("Warehouse"));
                    }
                endforeach;

                redirect(base_url("auth/login"));
                break;
            case '0':

                // เข้าสู่ระบบ Admin
                $AD_USERNAME = $Inpost->AD_USERNAME;
                $AD_PASSWORD = $Inpost->AD_PASSWORD;

                $query = $this->db->query("SELECT *  FROM admin WHERE AD_USERNAME = '$AD_USERNAME' AND AD_PASSWORD = '$AD_PASSWORD' LIMIT 1  ");
                $result = $query->result('object');

                foreach ($result as $key => $item):
                    if ($AD_USERNAME == $item->AD_USERNAME && $AD_PASSWORD == $item->AD_PASSWORD) {
                        $Account->ID = $item->AD_ID;
                        $Account->TYPE = '0';
                        $Account->CODE = $item->AD_CODE;
                        $Account->NAME = $item->AD_NAME;
                        $_SESSION["account"] = $Account;
                        redirect(base_url("Warehouse/employees"));
                    }
                endforeach;

                redirect(base_url("auth/loginAdmin"));


                break;
        }
    }

    public function checkLogin()
    {

        try {
            if (isset($_SESSION["account"])) {
                return true;
            } else {
                $this->logout();
            }
        } catch (Exception $e) {
            $this->logout();
        }
    }

    public function logout()
    {
        // unset_user_session();
        session_start();
        session_unset();
        unset($_SESSION["account"]);
        session_destroy();

        redirect(base_url());
    }
}


?>