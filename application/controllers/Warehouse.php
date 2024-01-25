<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Warehouse extends CI_Controller
{
    public $account = null;
    public function __construct()
    {
        parent::__construct();

        if (!isset($_SESSION["account"])) {
            redirect(base_url());
        }
        $account = $_SESSION["account"];

        $this->load->model('ADMIN_MODELS');
        $this->load->model('EMPLOYEE_MODELS');
        $this->load->model('PRODUCTS_MODELS');
        $this->load->model('TRANSCTION_MODELS');


    }
    public function index()
    {
        $this->load->tview("page/dashboard");
    }
    public function qrcode()
    {
        $this->load->tview("page/qrcode");
    }

    public function getBarcode()
    {
        if (empty($_POST)) {
            $_POST = json_decode(file_get_contents('php://input'), true);
        }

        $inPuts = $this->input->post();
        $PD_BARCODE = $inPuts['barcode'];

        $query = $this->db->query("SELECT * FROM `products` WHERE `PD_BARCODE` = '$PD_BARCODE' AND PD_DELETE IS NULL ");
        $temp = new stdClass();

        if (!empty($query->row())) {
            $temp->statusCode = true;
            $temp->data = $query->row();
            echo json_encode($temp);
        } else {
            $temp->statusCode = false;
            $temp->data = $query->row();
            echo json_encode($temp);
        }

    }

    public function formSubmitRemoveItemProduct()
    {
        $temp = new stdClass();

        $PRODUCTS_MODELS = new PRODUCTS_MODELS();
        $TRANSCTION_MODELST = new TRANSCTION_MODELS();

        if (empty($_POST)) {
            $_POST = json_decode(file_get_contents('php://input'), true);
        }

        $inPuts = $this->input->post();

        $PD = $inPuts['PD'];


        $check = false;
        $error = [];
        foreach ($PD as $item):
            $X = explode(',', $item);
            $PD_BARCODE = $X[0];
            $TS_ITEM = $X[1];

            $query = $this->db->query("SELECT * FROM `products` WHERE `PD_BARCODE` = '$PD_BARCODE'");
            $products = $query->row();

            $newItem = (int) $products->PD_ITEM - (int) $TS_ITEM;

            if ($newItem < 0) {
                $check = true;
                array_push($error, $products);
            }
        endforeach;


        if (!$check) {
            foreach ($PD as $item):
                $X = explode(',', $item);
                $PD_BARCODE = $X[0];
                $TS_ITEM = $X[1];

                $query = $this->db->query("SELECT * FROM `products` WHERE `PD_BARCODE` = '$PD_BARCODE'");
                $products = $query->row();
                
                $newItem = (int) $products->PD_ITEM - (int) $TS_ITEM;

                $temp->statusCode = $PRODUCTS_MODELS::UpdateResources([
                    "WHERE" => [
                        "PD_BARCODE" => $PD_BARCODE
                    ],
                    "DATA" => [
                        "PD_ITEM" => $newItem,
                    ],
                ]);

                $TRANSCTION_MODELST::InsertResources([
                    "PD_BARCODE" => $PD_BARCODE,
                    "TS_TYPE" => "2",
                    "TS_ITEM" => $TS_ITEM,
                    "TS_STAMP" => date("Y-m-d H:i:s"),
                    "TS_CANCEL" => NULL,
                    "EM_CODE" => $_SESSION["account"]->CODE,
                    "TS_COST" => $products->PD_COST,
                    "TS_SELL" => $products->PD_SELL,
                    "TS_PROFIT" => $products->PD_SELL - $products->PD_COST,
                ]);

            endforeach;
        } else {
            $temp->statusCode = false;
        }

        $temp->error = $error;
        echo json_encode($temp);
    }


    public function products()
    {
        $this->load->tview("page/products");
    }

    public function getOneProduct()
    {
        if (empty($_POST)) {
            $_POST = json_decode(file_get_contents('php://input'), true);
        }

        $inPuts = $this->input->post();
        $PD_ID = $inPuts['PD_ID'];
        $query = $this->db->query("SELECT * FROM `products` WHERE `PD_ID` = '$PD_ID'");
        echo json_encode($query->row());
    }
    public function getAllProduct()
    {
        if (empty($_POST)) {
            $_POST = json_decode(file_get_contents('php://input'), true);
        }

        $inPuts = $this->input->post();
        $string = $inPuts['key'];
        $query = $this->db->query("SELECT * FROM `products` WHERE (  PD_NAME LIKE '%$string%' 
                                    OR PD_BARCODE LIKE '%$string%' 
                                    OR PD_DETAILS LIKE '%$string%' ) AND PD_DELETE  IS NULL
                                    ");

        echo json_encode($query->result());
    }



    public function formSubmitAddProduct()
    {
        if (empty($_POST)) {
            $_POST = json_decode(file_get_contents('php://input'), true);
        }

        $PD_IMAG = 'product-item.png';

        $temp = new stdClass();
        $input = $this->input->post();

        $PRODUCTS_MODELS = new PRODUCTS_MODELS();
        $TRANSCTION_MODELST = new TRANSCTION_MODELS();

        $LastID = $PRODUCTS_MODELS::LastID();

        $PD_BARCODE = sprintf('PD%05d', $LastID);
        if ($_FILES['PD_IMAG']['error'] == '0') {

            $config['upload_path'] = './static/images/products/';
            $config['allowed_types'] = 'jpg|png';
            $config['file_name'] = date("Ymd_") . $PD_BARCODE . '_' . $_FILES['PD_IMAG']['name'];

            $this->load->library('upload', $config);
            if ($this->upload->do_upload("PD_IMAG")) {
                $PD_IMAG = $this->upload->data('file_name');
            }
        }

        $DInsert = [
            "PD_NAME" => $input['PD_NAME'],
            "PD_BARCODE " => $PD_BARCODE,
            "PD_STAMP" => date("Y-m-d H:i:s"),
            "PD_COST" => $input['PD_COST'],
            "PD_SELL" => $input['PD_SELL'],
            "PD_ITEM" => $input['PD_ITEM'],
            "PD_IMAG" => $PD_IMAG,
            "PD_PROFIT" => $input['PD_SELL'] - $input['PD_COST'],
            "PD_DELETE" => NULL,
            "PD_STATUS" => NULL,
            "EM_CODE" => $_SESSION["account"]->CODE,
            "PD_DETAILS" => $input['PD_DETAILS'],
        ];

        $temp->statusCode = $PRODUCTS_MODELS::InsertResources($DInsert);

        $TRANSCTION_MODELST::InsertResources([
            "PD_BARCODE" => $PD_BARCODE,
            "TS_TYPE" => "1",
            "TS_ITEM" => $input['PD_ITEM'],
            "TS_STAMP" => date("Y-m-d H:i:s"),
            "TS_CANCEL" => NULL,
            "EM_CODE" => $_SESSION["account"]->CODE,
            "TS_COST" => $input['PD_COST'],
            "TS_SELL" => $input['PD_SELL'],
            "TS_PROFIT" => $input['PD_SELL'] - $input['PD_COST'],
        ]);
        echo json_encode($temp);
    }
    public function formSubmitEditProduct()
    {
        if (empty($_POST)) {
            $_POST = json_decode(file_get_contents('php://input'), true);
        }
        $input = $this->input->post();

        $PD_IMAG = 'product-item.png';

        $temp = new stdClass();
        $PRODUCTS_MODELS = new PRODUCTS_MODELS();

        $query = $this->db->query("SELECT * from products where PD_ID = '{$input['PD_ID']}'");
        $resp = $query->row();

        if ($_FILES['PD_IMAG']['error'] == '0') {
            $config['upload_path'] = './static/images/products/';
            $config['allowed_types'] = 'jpg|png';
            $config['file_name'] = date("YmdHis") . $resp->PD_BARCODE . '_' . $_FILES['PD_IMAG']['name'];
            $this->load->library('upload', $config);
            if ($this->upload->do_upload("PD_IMAG")) {
                $PD_IMAG = $this->upload->data('file_name');
            }
            if ($resp->PD_IMAG != $PD_IMAG) {
                if (file_exists('./static/images/products/' . $resp->PD_IMAG)) {
                    unlink('./static/images/products/' . $resp->PD_IMAG);
                }
            }
        } else {
            $PD_IMAG = $resp->PD_IMAG;
        }

        $DInsert = [
            "PD_NAME" => $input['PD_NAME'],
            "PD_STAMP" => date("Y-m-d H:i:s"),
            "PD_COST" => $input['PD_COST'],
            "PD_SELL" => $input['PD_SELL'],
            // "PD_ITEM" => $input['PD_ITEM'],
            "PD_IMAG" => $PD_IMAG,
            "PD_PROFIT" => $input['PD_SELL'] - $input['PD_COST'],
            "PD_DELETE" => NULL,
            "PD_STATUS" => NULL,
            "EM_CODE" => $_SESSION["account"]->CODE,
            "PD_DETAILS" => $input['PD_DETAILS'],
        ];

        $temp->statusCode = $PRODUCTS_MODELS::UpdateResources([
            "WHERE" => [
                "PD_ID" => $input['PD_ID']
            ],
            "DATA" => $DInsert,
        ]);

        echo json_encode($temp);
    }


    public function formSubmitAddItemProduct()
    {

        $TRANSCTION_MODELST = new TRANSCTION_MODELS();
        $PRODUCTS_MODELS = new PRODUCTS_MODELS();

        if (empty($_POST)) {
            $_POST = json_decode(file_get_contents('php://input'), true);
        }
        $input = $this->input->post();
        $temp = new stdClass();

        $query = $this->db->query("SELECT * from products where PD_ID = '{$input['PD_ID']}'");
        $resp = $query->row();

        $TRANSCTION_MODELST::InsertResources([
            "PD_BARCODE" => $resp->PD_BARCODE,
            "TS_TYPE" => "1",
            "TS_ITEM" => $input['TS_ITEM'],
            "TS_STAMP" => date("Y-m-d H:i:s"),
            "TS_CANCEL" => NULL,
            "EM_CODE" => $_SESSION["account"]->CODE,
            "TS_COST" => $resp->PD_COST,
            "TS_SELL" => $resp->PD_SELL,
            "TS_PROFIT" => $resp->PD_SELL - $resp->PD_COST,
        ]);

        $newItem = $input['TS_ITEM'] + $resp->PD_ITEM;
        $temp->statusCode = $PRODUCTS_MODELS::UpdateResources([
            "WHERE" => [
                "PD_ID" => $input['PD_ID']
            ],
            "DATA" => [
                "PD_ITEM" => $newItem,
            ],
        ]);

        echo json_encode($temp);

    }



    public function getAllTransction()
    {
        if (empty($_POST)) {
            $_POST = json_decode(file_get_contents('php://input'), true);
        }
        $input = $this->input->post();

        $PD_BARCODE = $input['PD_BARCODE'];
        $query = $this->db->query("SELECT * from transction as A INNER JOIN products as B ON A.PD_BARCODE = B.PD_BARCODE where B.PD_BARCODE = '$PD_BARCODE' AND A.TS_CANCEL IS NULL;");
        echo json_encode($query->result());
    }

    public function formSubmitDeleteProduct()
    {
        if (empty($_POST)) {
            $_POST = json_decode(file_get_contents('php://input'), true);
        }

        $temp = new stdClass();
        $input = $this->input->post();

        $PRODUCTS_MODELS = new PRODUCTS_MODELS();

        $DInsert = [
            "PD_STAMP" => date("Y-m-d H:i:s"),
            "PD_DELETE" => "0",
            "EM_CODE" => $_SESSION["account"]->CODE
        ];

        $temp->statusCode = $PRODUCTS_MODELS::UpdateResources([
            "WHERE" => [
                "PD_ID" => $input['PD_ID']
            ],
            "DATA" => $DInsert,
        ]);

        echo json_encode($temp);
    }



    // Employee
    public function employees()
    {
        $this->load->tview("page/employees");
    }

    public function emInfoEdit()
    {
        if (empty($_POST)) {
            $_POST = json_decode(file_get_contents('php://input'), true);
        }

        $inPuts = $this->input->post();
        $this->db->from('employee');
        $this->db->where("EM_ID", $inPuts['EM_ID']);
        $query = $this->db->get();
        echo json_encode($query->row());
    }
    public function getAllEmployee()
    {
        $query = $this->db->query("SELECT * from employee where EM_RESIGN = '1'");
        if (empty($_POST)) {
            $_POST = json_decode(file_get_contents('php://input'), true);
        }
        echo json_encode($query->result());
    }

    public function emResign()
    {
        if (empty($_POST)) {
            $_POST = json_decode(file_get_contents('php://input'), true);
        }
        $EMPLOYEE_MODELS = new EMPLOYEE_MODELS();

        $inPuts = $this->input->post();

        $EM_ID = $inPuts['EM_ID'];

        $upDate = $EMPLOYEE_MODELS::UpdateResources([
            "WHERE" => [
                "EM_ID" => $EM_ID
            ],
            "DATA" => [
                "EM_RESIGN" => "0",
            ],
        ]);


        $temp = new stdClass();
        $temp->statusCode = $upDate;
        echo json_encode($temp);
    }

    public function formSubmitAddEmployee()
    {
        $temp = new stdClass();
        $input = $this->input->post();

        $EMPLOYEE_MODELS = new EMPLOYEE_MODELS();

        $LastID = $EMPLOYEE_MODELS::LastID();

        $EM_CODE = sprintf('EM%05d', $LastID);

        $input['EM_CODE'] = $EM_CODE;

        $temp->statusCode = $EMPLOYEE_MODELS::InsertResources($input);
        echo json_encode($temp);
    }

    public function formSubmitEditEmployee()
    {
        $temp = new stdClass();
        $input = $this->input->post();

        $EMPLOYEE_MODELS = new EMPLOYEE_MODELS();

        $temp->statusCode = $EMPLOYEE_MODELS::UpdateResources([
            "WHERE" => [
                "EM_ID" => $input['EM_ID']
            ],
            "DATA" => $input,
        ]);

        echo json_encode($temp);
    }
}
