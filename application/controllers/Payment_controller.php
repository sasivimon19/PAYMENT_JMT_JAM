<?php
date_default_timezone_set("Asia/Bangkok");
class Payment_controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('session', 'form_validation'));
        set_time_limit(0);
        ini_set('memory_limit', '-1');
        $this->load->model('Payment_model', 'PM');
        $this->load->model('eir');
    }

    public function index()
    {

        $this->load->view('login');
    }

    public function login_validation()
    {

        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run()) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $data['canlogin'] = $this->PM->can_login($username, $password);

            if (COUNT($data['canlogin']) > 0) {

                foreach ($data['canlogin'] as $v) {

                    $session_data = array(
                        'username' => $v->username,
                        'company' => $v->company,
                        'Subject_Right' => $v->Subject_Right
                    );
                }

                // setcookie("login", true, time() + (6000), "/");
                $this->session->set_userdata($session_data);

                // if ($session_data['Subject_Right'] == "User") {
                // redirect(site_url('Payment_controller/loadpayment'));

                redirect(site_url('Payment_controller/company'));

                // } else {
                //     redirect(site_url('port/main_eir'));
                // }
            } else {
                $this->session->set_flashdata('error', 'Username หรือ Password ไม่ถูกต้อง <br> หรือ สถานะ ปิดใช้งาน');
                redirect(site_url('Payment_controller/index'));
            }
        } else {

            redirect(site_url('Payment_controller/index'));
        }
    }



    public function loadpayment_get_from()
    {

        $username = $this->session->userdata('username');
        $companyses = $this->session->userdata('company');
        $Subject_Right = $this->session->userdata('Subject_Right');

        if ($username == "") {
            $this->load->view('false');
        } else {

            $data['username'] = $this->PM->username($username, $companyses);
            foreach ($data['username'] as $key) {
                $com = $key->company;
            }

            if ($com == 'jam') {
                $T = 'JAM';
                $tb = 'jamdata';
            }
            if ($com == 'JMT') {
                $T = 'JMTLOAN_PROD';
                $tb = 'jmtdata';
            }
            $this->PM->delete_simulate($T, $username);
            $data['username_menu'] = $this->PM->username_menu($T, $username);
            $data['company'] = $this->PM->company($com);

            $Date = $this->input->post("date");
            $Agreement = $this->input->post("Agreement");
            $IDCard = $this->input->post("IDCard");
            $Channel = $this->input->post("Channel");
            $Ref1 = iconv("UTF-8", "TIS-620//IGNORE", $this->input->post("Ref1"));
            $Ref2 = $this->input->post("Ref2");
            $Amount = $this->input->post("Amount");
            $Remark = $this->input->post("Remark");
            $Lot = '';

            $this->PM->loadpayment_insert($Date, $Agreement, $IDCard, $Channel, $Ref1, $Ref2, $Amount, $Lot, $Remark, $username, $T);
            // redirect("Payment_controller/loadpayment_from_view");
            $this->session->set_flashdata('error', 'บันทึกข้อมูลสำเร็จ');
        }
    }


    public function loadpayment_from()
    {

        $username = $this->session->userdata('username');
        $companyses = $this->session->userdata('company');

        if ($username == "") {
            $this->load->view('false');
        } else {

            $data['username'] = $this->PM->username($username, $companyses);
            foreach ($data['username'] as $key) {
                $com = $key->company;
            }

            if ($com == 'jam') {
                $T = 'JAM';
            }
            if ($com == 'jmt') {
                $T = 'JMTLOAN_PROD';
            }

            $data['username_menu'] = $this->PM->username_menu($T, $username);

            $this->PM->delete_simulate($T, $username);
            $data['company'] = $this->PM->company($com);


            $nof  = $_FILES['file']['name'];
            $file = $_FILES["file"]["tmp_name"];
            $filename = $_FILES["file"]["tmp_name"];

            list($file, $ext) = explode('.', $_FILES['file']['name']);

            $exp = explode('.', $nof);
            $destination_file = substr($nof, 0, - (strlen($exp[count($exp) - 1]) + 1));

            if ($ext == 'txt') {

                $file = fopen($_FILES['file']['tmp_name'], "r");
                $rowstr = 1;
                $rowEnd = 0;

                $j = 1;

                $rowstr = $j;
                while (!feof($file)) {
                    $item = fgets($file);
                    $A = substr($item, 0, 1);

                    if ($A != 'H' && $A != 'T' && $A != ' ' && $A != '') {

                        $Datefor = substr($item, 24, 4) . "-" . substr($item, 22, 2) . "-" . substr($item, 20, 2);
                        $Date = date("Y-m-d", strtotime($Datefor));
                        $Agreement = substr($item, 84, 19);
                        $IDCard = substr($item, 104, 20);
                        $Amount = substr($item, 163, 11) . "." . substr($item, 174, 2);
                        $Channel = $destination_file;
                        $Ref1 = "";
                        $Ref2 = $Date;
                        $Lot = "";
                        $Remark = "";


                        $this->PM->loadpayment_insert($Date, $Agreement, $IDCard, $Channel, $Ref1, $Ref2, $Amount, $Lot, $Remark, $username, $T);

                        $j++;
                    }
                }
            }

            if ($ext == 'xlsx') {
                $this->load->library('Excel');
                if (isset($_FILES["file"]["name"])) {

                    $path = $_FILES["file"]["tmp_name"];
                    $object = PHPExcel_IOFactory::load($path);

                    foreach ($object->getWorksheetIterator() as $worksheet) {
                        $highestRow = $worksheet->getHighestRow();
                        $highestColumn = $worksheet->getHighestColumn();

                        for ($row = 2; $row <= $highestRow; $row++) {

                            $Date = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                            $Agreement = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                            $IDCard = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                            $Channel = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                            $Ref1 = iconv("UTF-8//ignore", "TIS-620//ignore", $worksheet->getCellByColumnAndRow(4, $row)->getValue());
                            $Ref2 = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                            $Amount = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                            $Lot = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                            $Remark = iconv("UTF-8//ignore", "TIS-620//ignore", $worksheet->getCellByColumnAndRow(7, $row)->getValue());

                            $this->PM->loadpayment_insert($Date, $Agreement, $IDCard, $Channel, $Ref1, $Ref2, $Amount, $Lot, $Remark, $username, $T);
                        }
                    }
                }
            }
            redirect("Payment_controller/loadpayment");
        }
    }
    public function loadpayment()
    {

        $username = $this->session->userdata('username');
        $companyses = $this->session->userdata('company');

        if ($username == "") {
            $this->load->view('false');
        } else {

            $data['username'] = $this->PM->username($username, $companyses);
            foreach ($data['username'] as $key) {
                $com = $key->company;
            }
            foreach ($data['username'] as $key) {
                $username_ST = $key->chkPeriod;
                $data['id_run'] = $key->id_run;
                $id = $key->id_run;
            }

            if ($com == 'jam') {
                $T = 'JAM';
                $DC = 'JAM';
            }
            if ($com == 'jmt') {
                $T = 'JMTLOAN_PROD';
                $DC = 'JMT';
            }
            $data['ID'] =  '';
            $data['username_menu_ID'] = $this->PM->username_menu_ID($T, $id);
            foreach ($data['username_menu_ID'] as $value) {
                $data['IDRUN'] = $value->ID;
            }


            $data['id_menu'] = '';
            $data['menu_view'] = $this->PM->setting_menu_view($T, $id);
            foreach ($data['menu_view'] as $item) {
                $data['id_menu'] = $item->id_menu;
            }

            $page = $this->input->post('page');

            if ($page != '') {
                $page = $page;
            } else {
                $page = 1;
            }

            $pageend1 = 150;


            $start = ($page - 1) * $pageend1;
            $pageend = $page * 150;

            $data['pageend'] = $pageend1;
            $data['pagenum'] = $page;


            $Currentdate = $this->PM->dateserver();
            foreach ($Currentdate as $value) {
                $dateSv = date('m', strtotime($value->Currentdate));
            }

            $data['username_menu'] = $this->PM->username_menu($T, $username);
            $data['Channel'] = $this->PM->payment_channel($T);
            $data['company'] = $this->PM->company($com);
            $data['get_date'] = $this->PM->dateserver();



            $data['search_view_not'] = $this->PM->search_loadpayment_not_F($username_ST, $username, $T, $start, $pageend, 'FALSE');
            $data['search_view_not_count'] = $this->PM->search_loadpayment_not_F($username_ST, $username, $T, 0, 0, 'FALSE_COUNT');
            $data['search_view'] = $this->PM->search_loadpayment_not_F($username_ST, $username, $T, $start, $pageend, 'TRUE');
            $data['search_view_count'] = $this->PM->search_loadpayment_not_F($username_ST, $username, $T, 0, 0, 'TRUE_COUNT');
            $data['search_view_count_TOTAL'] = $this->PM->search_loadpayment_not_F($username_ST, $username, $T, 0, 0, 'TOTALTRUE');
            $data['search_view_count_TOTALFALSE'] = $this->PM->search_loadpayment_not_F($username_ST, $username, $T, 0, 0, 'TOTALFALSE');

            $pagesub = "";
            $pagesub = $this->input->post("pagesub");

            if ($pagesub == "") {
                $data['Main_Homepayment'] = "loadpayment";
                $this->load->view('Homepayment', $data);
            } else if ($pagesub == "Y") {
                $this->load->view('pagedatasave', $data);
            } else if ($pagesub == "N") {
                $this->load->view('pagenodatasave', $data);
            }
        }
    }
    public function loadpayment_from_view()
    {

        $this->load->model('Payment_model');
        $username = $this->session->userdata('username');
        $companyses = $this->session->userdata('company');



        if ($username == "") {
            $this->load->view('false');
        } else {

            $data['username'] = $this->PM->username($username, $companyses);
            foreach ($data['username']  as $key) {
                $com = $key->company;
            }

            foreach ($data['username'] as $key) {
                $username_ST = $key->chkPeriod;
            }

            if ($com == 'jam') {
                $T = 'JAM';
                $DC = 'JAM';
            }
            if ($com == 'jmt') {
                $T = 'JMTLOAN_PROD';
                $DC = 'JMT';
            }


            $data['username_menu'] = $this->Payment_model->username_menu($T, $username);
            $data['get_date'] = $this->Payment_model->dateserver();



            $data['Channel'] = $this->Payment_model->payment_channel($T);

            $start = 0;
            $pageend = 150;

            $data['company'] = $this->Payment_model->company($com);

            // stored load pay ข้อมูลที่ผิดและข้อมูลที่ถูกต้อง
            $data['search_view_not'] = $this->PM->search_loadpayment_not_F($username_ST, $username, $T, $start, $pageend, 'FALSE');
            $data['search_view_not_count'] = $this->PM->search_loadpayment_not_F($username_ST, $username, $T, 0, 0, 'FALSE_COUNT');
            $data['search_view'] = $this->PM->search_loadpayment_not_F($username_ST, $username, $T, $start, $pageend, 'TRUE');
            $data['search_view_count'] = $this->PM->search_loadpayment_not_F($username_ST, $username, $T, 0, 0, 'TRUE_COUNT');
            $data['search_view_count_TOTALTRUE'] = $this->PM->search_loadpayment_not_F($username_ST, $username, $T, 0, 0, 'TOTALTRUE');
            $data['search_view_count_TOTALFALSE'] = $this->PM->search_loadpayment_not_F($username_ST, $username, $T, 0, 0, 'TOTALFALSE');

            $data['Main_Homepayment'] = "loadpayment";
            $this->load->view('Homepayment', $data);
        }
    }


    public function loadpayment_from_view1()
    {
        $this->load->model('Payment_model');
        $username = $this->session->userdata('username');
        $companyses = $this->session->userdata('company');

        if ($username == "") {
            $this->load->view('false');
        } else {

            $data['username'] = $this->PM->username($username, $companyses);
            foreach ($data['username'] as $key) {
                $com = $key->company;
            }

            if ($com == 'jam') {
                $T = 'JAM';
            }
            if ($com == 'jmt') {
                $T = 'JMTLOAN_PROD';
            }

            $data['company'] = $this->Payment_model->company($com);

            $data['search_view_not'] = $this->Payment_model->search_loadpayment_not();
            $data['search_view'] = $this->Payment_model->search_loadpayment();
            $data['get_ContractNo'] = $this->Payment_model->get_ContractNo($username);
            $data['get_IDCard'] = $this->Payment_model->get_IDCard($username);
            $data['get_Channel'] = $this->Payment_model->get_Channel($username);

            $this->load->view('test', $data);
        }
    }


    public function loadpayment_insert()
    {
        $username = $this->session->userdata('username');
        $companyses = $this->session->userdata('company');


        if ($username == "") {
            $this->load->view('false');
        } else {
            $data['username'] = $this->PM->username($username, $companyses);
            foreach ($data['username'] as $key) {
                $username_ST = $key->chkPeriod;
                $company = $key->company;
            }
            $start = 0;
            $pageend = 100;

            if ($company == 'jam') {
                $T = 'JAM';
                $DC = 'JAM';
            }
            if ($company == 'jmt') {
                $T = 'JMTLOAN_PROD';
                $DC = 'JMT';
            }



            $Currentdate = $this->PM->dateserver();
            foreach ($Currentdate as $value) {
                $DATE  = $value->Currentdate;
            }
            $dateSv = date('Y-m-d', strtotime($DATE));

            // $f_holddate  =  date('Y-m-d', strtotime($DATE));
            // $f_holdtime  =  date('H:i:s', strtotime($DATE));

            // $dateSv = $f_holddate . " " . $f_holdtime . ':00.000';


            // $numcount = $this->PM->search_loadpayment_not_F($username_ST, $username, $T, $start, $pageend, 'TRUESAVE');

            // echo "<br>" . $num = count($numcount);

            // for ($k = 1; $k <= $num; $k++) {

            //     $Date1 = $this->input->post("Date1-" . $k);
            //     $Agreement = $this->input->post("Agreement-" . $k);
            //     $IDCard = $this->input->post("IDCard-" . $k);
            //     $Channel = $this->input->post("Channel-" . $k);
            //     $Ref1 = iconv("UTF-8//ignore", "TIS-620//ignore", $this->input->post("Ref1-" . $k));
            //     $Ref2 = $this->input->post("Ref2-" . $k);
            //     $Amount = $this->input->post("Amount-" . $k);
            //     $Lot = $this->input->post("Lot-" . $k);
            //     $Remark = $this->input->post("Remark-" . $k);
            // }

            if ($username_ST == 0) {

                $search_view = $this->PM->search_loadpayment_not_F($username_ST, $username, $T, $start, $pageend, 'TRUESAVE');

                foreach ($search_view as $key) {

                    $Date1 = $key->Date1;
                    $Agreement = $key->Agreement;
                    $IDCard = $key->IDCard;
                    $Channel = $key->Channel;
                    $Ref1 = $key->Ref1;
                    $Ref2 = $key->Ref2;
                    $Amount = $key->Amount;
                    $Lot = $key->Lot;
                    $Remark = $key->Remark;
                    $Contract_No = trim($key->Contract_No);
                    $id_no = trim($key->id_no);


                    $setidno = $this->PM->id_customer($id_no, $Contract_No, $T);
                    foreach ($setidno as $row) {
                        $operator_name = $row->operator_name;
                        $operator_value = $row->operator_value;

                        if ($Channel == 'DISCOUNT' || $Channel == 'ADJUST') {

                            $VAT = '0';
                        } else {

                            if ($operator_value == 'hp' || $operator_value == 'HP') {

                                $VATshow = (($Amount * 7));
                                $total = $VATshow / 107;
                                $VATRR =  number_format($total, 02);
                                $VAT =  str_replace(",", "", $VATRR);
                            } else {
                                $VAT = '0';
                            }
                        }

                        $this->PM->loadpayment_insert_FN($T, $Date1, $Contract_No, $Channel, $Ref1, $Ref2, $Amount, $username, $VAT, $dateSv, $id_no, $Remark, $company);
                    }
                }
            }

            if ($username_ST == 1) {

                // stored ค้นหาข้อมูล load ที่ถูกต้องเพื่อจะนำข้อมูลนี้ไปบันทึกต่อ
                $search_view = $this->PM->search_loadpayment_not_F($username_ST, $username, $T, $start, $pageend, 'TRUESAVE');



                foreach ($search_view as $key) {

                    $Date1 = $key->Date1;
                    $Agreement = $key->Agreement;
                    $IDCard = $key->IDCard;
                    $Channel = $key->Channel;
                    $Ref1 = $key->Ref1;
                    $Ref2 = $key->Ref2;
                    $Amount = $key->Amount;
                    $Lot = $key->Lot;
                    $Remark = $key->Remark;
                    $Contract_No = trim($key->Contract_No);
                    $id_no = trim($key->id_no);

                    $setidno = $this->PM->id_customer($id_no, $Contract_No, $T);

                    foreach ($setidno as $row) {

                        $operator_name = $row->operator_name;
                        $operator_value = $row->operator_value;

                        if ($operator_value == 'hp' || $operator_value == 'HP') {

                            $VATshow = (($Amount * 7));
                            $total = $VATshow / 107;
                            $VATRR =  number_format($total, 02);
                            $VAT =  str_replace(",", "", $VATRR);
                        } else {

                            $VAT = '0';
                        }


                        $this->PM->loadpayment_insert_FN($T, $Date1, $Contract_No, $Channel, $Ref1, $Ref2, $Amount, $username, $VAT, $dateSv, $id_no, $company, $Remark);
                    }
                }
            }
            $this->session->set_flashdata('error', 'บันทึกข้อมูลสำเร็จ');
            $this->PM->delete_simulate($T, $username);
        }
    }

    public function delete_loadpayment_simulate()
    {

        $username = $this->session->userdata('username');
        $companyses = $this->session->userdata('company');

        if ($username == "") {
            $this->load->view('false');
        } else {

            $data['username'] = $this->PM->username($username, $companyses);
            foreach ($data['username'] as $key) {
                $com = $key->company;
            }

            if ($com == 'jam') {
                $T = 'JAM';
            }
            if ($com == 'jmt') {
                $T = 'JMTLOAN_PROD';
            }

            $this->PM->delete_simulate($T, $username);


            redirect("Payment_controller/loadpayment");
        }
    }


    public function customer()
    {

        $username = $this->session->userdata('username');
        $companyses = $this->session->userdata('company');


        if ($username == "") {
            $this->load->view('false');
        } else {

            $contract = $this->input->GET('id');
            $url_paramPRO = rtrim($contract, '=');
            $base_64PRO = $url_paramPRO . str_repeat('=', strlen($url_paramPRO) % 4);
            $contract = base64_decode($base_64PRO);
            $company = iconv('UTF-8', 'TIS-620', $this->input->post('company'));

            $data['username'] = $this->PM->username($username, $companyses);
            foreach ($data['username'] as $key) {
                $com = $key->company;
            }

            if ($com == 'jam') {
                $T = 'JAM';
            }
            if ($com == 'jmt') {
                $T = 'JMTLOAN_PROD';
            }

            $data['receive'] = $this->PM->receive($T, $contract, $com);
            $data['Showreceive'] = $this->PM->receiveTB($T, $contract, $com);


            $data['username_menu'] = $this->PM->username_menu($T, $username);
            $data['company'] = $this->PM->company($com);
            $data['Cm'] = $this->PM->getall_customer($T, $contract, $com);


            $data['Main_Homepayment'] = "customer";
            $this->load->view('Homepayment', $data);
        }
    }

    public function customer_index1()
    {


        $username = $this->session->userdata('username');
        $companyses = $this->session->userdata('company');

        if ($username == "") {
            $this->load->view('false');
        } else {

            $data['username'] = $this->PM->username($username, $companyses);
            foreach ($data['username'] as $key) {
                $com = $key->company;
            }

            if ($com == 'jam') {
                $T = 'JAM';
            }
            if ($com == 'jmt') {
                $T = 'JMTLOAN_PROD';
            }

            $contract = iconv('UTF-8', 'TIS-620', $this->input->post('contract'));
            $company = iconv('UTF-8', 'TIS-620', $this->input->post('company'));

            $data['receive'] = $this->PM->receive($T, $contract, $com);
            $data['Showreceive'] = $this->PM->receiveTB($T, $contract, $com);

            $data['username_menu'] = $this->PM->username_menu($T, $username);
            $data['company'] = $this->PM->company($com);
            $data['customer'] = $this->PM->get_customer($T, $contract, $com);

            $this->load->view('customer_index', $data);
        }
    }
    public function customer_index()
    {
        $username = $this->session->userdata('username');
        $companyses = $this->session->userdata('company');

        if ($username == "") {
            $this->load->view('false');
        } else {

            $data['username'] = $this->PM->username($username, $companyses);
            foreach ($data['username'] as $key) {
                $com = $key->company;
            }

            if ($com == 'jam') {
                $T = 'JAM';
            }
            if ($com == 'jmt') {
                $T = 'JMTLOAN_PROD';
            }

            $start = 0;
            $pageend = 10;
            $wherecustomer = 0;
            $Countcustomerall = 0;
            $data['customerall'] = "";

            $contract = iconv('UTF-8', 'TIS-620', $this->input->post('contract'));
            $company = iconv('UTF-8', 'TIS-620', $this->input->post('company'));

            $data['receive'] = $this->PM->receive($T, $contract, $com);
            $data['Showreceive'] = $this->PM->receiveTB($T, $contract, $com);

            $data['username_menu'] = $this->PM->username_menu($T, $username);

            $data['company'] = $this->PM->company($com);


            $data['Main_Homepayment'] = "customer_index";
            $this->load->view('Homepayment', $data);
        }
    }

    public function customer_index_from()
    {

        $username = $this->session->userdata('username');
        $companyses = $this->session->userdata('company');


        if ($username == "") {
            $this->load->view('false');
        } else {

            $data['username'] = $this->PM->username($username, $companyses);
            foreach ($data['username'] as $key) {
                $com = $key->company;
            }

            if ($com == 'jam') {
                $T = 'JAM';
            }
            if ($com == 'jmt') {
                $T = 'JMTLOAN_PROD';
            }
            $data['username_menu'] = $this->PM->username_menu($T, $username);

            $contract = iconv('UTF-8', 'TIS-620', $this->input->post('contract'));
            $company = iconv('UTF-8', 'TIS-620', $this->input->post('company'));

            $data['receive'] = $this->PM->receive($T, $contract, $com);
            $data['Showreceive'] = $this->PM->receiveTB($T, $contract, $com);

            $data['company'] = $this->PM->company($com);

            $Searchmore = $this->input->get('Searchmore');

            $wherecustomer = "WHERE (A.contract_no  = '" . $contract . "' OR A.id_no = '" . $contract . "') AND A.company = '" . $com . "'";

            $data['customerall'] = $this->PM->get_customer($T, $wherecustomer);
            $data['Countcustomerall'] = $this->PM->get_Countcustomer($T, $wherecustomer);

            $data['Main_Homepayment'] = "TableCustomer";
            $this->load->view('Homepayment', $data);
        }
    }
    public function export()
    {
        $username = $this->session->userdata('username');
        $companyses = $this->session->userdata('company');
        if ($username == "") {
            $this->load->view('false');
        } else {

            $data['username'] = $this->PM->username($username, $companyses);

            $this->load->model('Payment_model');

            foreach ($data['username'] as $key) {
                $com = $key->company;
            }

            if ($com == 'jam') {
                $T = 'JAM';
            }
            if ($com == 'jmt') {
                $T = 'JMTLOAN_PROD';
            }

            $data['company'] = $this->Payment_model->company($com);
            $data['username_menu'] = $this->Payment_model->username_menu($T, $username);


            $data['Main_Homepayment'] = "export";
            $this->load->view('Homepayment', $data);
        }
    }
    public function company()
    {

        $username = $this->session->userdata('username');
        $companyses = $this->session->userdata('company');

        if ($username == "") {
            $this->load->view('false');
        } else {

            $data['username'] = $this->PM->username($username, $companyses);
            foreach ($data['username'] as $key) {
                $com = $key->company;
            }

            if ($com == 'jam') {
                $T = 'JAM';
            }
            if ($com == 'jmt') {
                $T = 'JMTLOAN_PROD';
            }
            $data['username_menu'] = $this->PM->username_menu($T, $username);
            $data['company'] = $this->PM->company($com);


            $data['Main_Homepayment'] = "company";
            $this->load->view('Homepayment', $data);
        }
    }


    public function Personal_history()
    {

        $username = $this->session->userdata('username');
        $companyses = $this->session->userdata('company');

        if ($username == "") {
            $this->load->view('false');
        } else {

            $data['username'] = $this->PM->username($username, $companyses);
            foreach ($data['username'] as $key) {
                $com = $key->company;
            }

            if ($com == 'jam') {
                $T = 'JAM';
            }
            if ($com == 'jmt') {
                $T = 'JMTLOAN_PROD';
            }
            $data['username_menu'] = $this->PM->username_menu($T, $username);
            $data['company'] = $this->PM->company($com);


            $data['Main_Homepayment'] = "Personalhistory";
            $this->load->view('Homepayment', $data);
        }
    }



    public function edit_company()
    {

        $username = $this->session->userdata('username');
        $companyses = $this->session->userdata('company');
        if ($username == "") {
            $this->load->view('false');
        } else {

            $data['username'] = $this->PM->username($username, $companyses);
            foreach ($data['username'] as $key) {
                $com = $key->company;
            }

            if ($com == 'jam') {
                $T = 'JAM';
                $tb = 'jamdata';
            }
            if ($com == 'jmt') {
                $T = 'JMTLOAN_PROD';
                $tb = 'jmtdata';
            }
            $id = $this->input->get("id");
            $name = iconv('UTF-8', 'TIS-620', $this->input->post("name"));
            $address = iconv('UTF-8', 'TIS-620', $this->input->post("address"));
            $taxno = iconv('UTF-8', 'TIS-620', $this->input->post("taxno"));
            $taxrate = iconv('UTF-8', 'TIS-620', $this->input->post("taxrate"));


            $this->PM->update_company($id, $name, $address, $taxno, $taxrate, $T, $tb);

            redirect("Payment_controller/company");
        }
    }
    public function pic_company()
    {

        $username = $this->session->userdata('username');
        $companyses = $this->session->userdata('company');
        if ($username == "") {
            $this->load->view('false');
        } else {

            $data['username'] = $this->PM->username($username, $companyses);
            foreach ($data['username'] as $key) {
                $com = $key->company;
            }

            if ($com == 'jam') {
                $T = 'JAM';
                $tb = 'jamdata';
            }
            if ($com == 'jmt') {
                $T = 'JMTLOAN_PROD';
                $tb = 'jmtdata';
            }
            $id = $this->input->get("id");
            $this->load->model('Payment_model');
            $Currentdate = $this->Payment_model->dateserver();
            foreach ($Currentdate as $value) {
                $dateSv = $value->Currentdate;
            }

            $datacompany = $this->Payment_model->company($com);
            foreach ($datacompany as $value) {
                echo $pic = $value->pic;
            }

            $path = getcwd();
            $filepath = $path . "./assets/Uploadimages";

            if (empty($_FILES['picname']['name'])) {
                $namefile = '';
            } else {

                list($namefile, $ext) = explode('.', $_FILES['picname']['name']);
            }

            if ($namefile == '') {
                $pic;
            } else {
                @unlink("" . $filepath . "/" . $pic);
                $newnamefile = rand(0, 999999);
            }


            $_FILES['file']['name'] = date("d-m-Y", strtotime($dateSv)) . '-' . $newnamefile . '.' . $ext;
            $_FILES['file']['type'] = $_FILES['picname']['type'];
            $_FILES['file']['tmp_name'] = $_FILES['picname']['tmp_name'];
            $_FILES['file']['error'] = $_FILES['picname']['error'];
            $_FILES['file']['size'] = $_FILES['picname']['size'];

            $config['upload_path'] = './assets/Uploadimages';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['remove_spaces'] = 'FALSE';

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('file')) {
                $filename = $_FILES['file']['name'];
                $this->Payment_model->Pic_update($filename, $id, $T);
            }

            redirect("Payment_controller/company");
        }
    }

    public function pic_company_delete()
    {
        $username = $this->session->userdata('username');
        $companyses = $this->session->userdata('company');
        if ($username == "") {
            $this->load->view('false');
        } else {

            $data['username'] = $this->PM->username($username, $companyses);
            foreach ($data['username'] as $key) {
                $com = $key->company;
            }

            if ($com == 'jam') {
                $T = 'JAM';
                $tb = 'jamdata';
            }
            if ($com == 'JMT') {
                $T = 'JMTLOAN_PROD';
                $tb = 'jmtdata';
            }
            $id = $this->input->get("id");
            $this->PM->Pic_delete($id, $T);
            redirect("Payment_controller/company");
        }
    }
    public function approve()
    {

        $username = $this->session->userdata('username');
        $companyses = $this->session->userdata('company');

        if ($username == "") {
            $this->load->view('false');
        } else {

            $data['username'] = $this->PM->username($username, $companyses);
            foreach ($data['username'] as $key) {
                $com = $key->company;
            }
            if ($com == 'jam') {
                $T = 'JAM';
            }
            if ($com == 'jmt') {
                $T = 'JMTLOAN_PROD';
            }

            $data['username_menu'] = $this->PM->username_menu($T, $username);
            $data['op'] = $this->PM->operator($T);
            $data['company'] = $this->PM->company($com);

            $page = $this->input->post('page');
            if ($page != '') {
                $page = $page;
            } else {
                $page = 1;
            }

            $pageend1 = 50;

            $start = ($page - 1) * $pageend1;
            $pageend = $page * 50;

            $data['pageend'] = $pageend1;
            $data['pagenum'] = $page;
            $data['page'] = $page;

            $Operatorname = "";
            $contract_no = $this->input->post("idcustomer");
            $datestart = $this->input->post("datestart");
            $dateend = $this->input->post("dateend");


            $data['search_count'] = $this->PM->Select_Approve($T, $username, 'Count_New_Receive_All', $contract_no, $Operatorname, $datestart, $dateend, 0, 0);
            $data['New_Receive'] = $data['search_count'][0]->NUMCOUNT;

            $data['search_count'] = $this->PM->Select_Approve($T, $username, 'CountCNALL', $contract_no, $Operatorname, $datestart, $dateend, 0, 0);
            $data['CN'] = $data['search_count'][0]->NUMCOUNT;

            $data['search_count'] = $this->PM->Select_Approve($T, $username, 'CountDISCOUNTALL', $contract_no, $Operatorname, $datestart, $dateend, 0, 0);
            $data['DISCOUNT'] = $data['search_count'][0]->NUMCOUNT;


            $data['search_count'] = $this->PM->Select_Approve($T, $username, 'CountADJUSTALL', $contract_no, $Operatorname, $datestart, $dateend, 0, 0);
            $data['ADJUST'] = $data['search_count'][0]->NUMCOUNT;

            $data['search_count'] = $this->PM->Select_Approve($T, $username, 'CountREVOKEALL', $contract_no, $Operatorname, $datestart, $dateend, 0, 0);
            $data['REVOKE'] = $data['search_count'][0]->NUMCOUNT;

            $data['search_count'] = $this->PM->Select_Approve($T, $username, 'CountREFUNDALL', $contract_no, $Operatorname, $datestart, $dateend, 0, 0);
            $data['REFUND'] = $data['search_count'][0]->NUMCOUNT;


            $data['Main_Homepayment'] = "approve_index";
            $this->load->view('Homepayment', $data);
        }
    }

    public function approvescan()
    {

        $username = $this->session->userdata('username');
        $companyses = $this->session->userdata('company');

        if ($username == "") {
            $this->load->view('false');
        } else {

            $data['username'] = $this->PM->username($username, $companyses);
            foreach ($data['username'] as $key) {
                $com = $key->company;
            }

            if ($com == 'jam') {
                $T = 'JAM';
            }
            if ($com == 'jmt') {
                $T = 'JMTLOAN_PROD';
            }

            $page = $this->input->post('page');


            if ($page != '') {
                $page = $page;
            } else {
                $page = 1;
            }

            $pageend1 = 50;

            $start = ($page - 1) * $pageend1;
            $pageend = $page * 50;

            $data['pageend'] = $pageend1;
            $data['pagenum'] = $page;
            $data['page'] = $page;


            $Operatorname = $this->input->post("Operator");

            if ($Operatorname == "") {
                $Operatorname = "";
            } else {
                $Operatorname;
            }

            $contract_no = $this->input->post("idcustomer");
            $datestart = $this->input->post("datestart");
            $dateend = $this->input->post("dateend");
            $status = $this->input->post("status");


            if ($status == "") {

                $status = $this->input->post("statusview");
                $data['statusview'] = $this->input->post("statusview");
                $count = $this->input->post("count");
                $Sum = $this->input->post("Sum");
            } else {

                $status = $this->input->post("status");
                $data['statusview'] = $this->input->post("status");
                $count = "count" . $status;
                $Sum =  $status . "Sum";
            }

            $data['search_view'] = $this->PM->Select_Approve($T, $username, $status, $contract_no, $Operatorname, $datestart, $dateend, $start, $pageend);
            $data['search_count'] = $this->PM->Select_Approve($T, $username, $count, $contract_no, $Operatorname, $datestart, $dateend, 0, 0);
            $data['search_sum'] = $this->PM->Select_Approve_Sum($T, $username, $Sum, $contract_no, $Operatorname, $datestart, $dateend, 0, 0);

            // echo"<br>"."EXEC [dbo].[SP_Select_Approve_Count]'$T','$username','$Sum','$contract_no','$Operatorname','$datestart','$dateend',0, 0";
            // echo "<br>" . "EXEC [dbo].[SP_Select_Approve]'$T','$username','$status','$contract_no','$Operatorname','$datestart','$dateend', $start, $pageend";
            // echo "<br>" . "EXEC [dbo].[SP_Select_Approve]'$T','$username','$count','$contract_no','$Operatorname','$datestart','$dateend',0, 0";


            foreach ($data['search_sum'] as $row) {
                $data['sumamount'] = $row->amount;
                $data['sumvat'] =  $row->vat;
            }

            foreach ($data['search_count'] as $value) {
                $data['COUNTNUMCOUNT'] = $value->NUMCOUNT;
            }

            $this->load->view('approve_vaiew', $data);
        }
    }


    public function Delete_approve_scan_one()
    {

        $username = $this->session->userdata('username');
        $companyses = $this->session->userdata('company');

        if ($username == "") {
            $this->load->view('false');
        } else {

            $data['username'] = $this->PM->username($username, $companyses);
            foreach ($data['username'] as $key) {
                $com = $key->company;
            }
            if ($com == 'jam') {
                $T = 'JAM';
            }
            if ($com == 'jmt') {
                $T = 'JMTLOAN_PROD';
            }

            $data['username_menu'] = $this->PM->username_menu($T, $username);
            $data['op'] = $this->PM->operator($T);
            $data['company'] = $this->PM->company($com);
            $page = $this->input->post('page');

            if (
                $page != ''
            ) {
                $page = $page;
            } else {
                $page = 1;
            }

            $pageend1 = 50;

            $start = ($page - 1) * $pageend1;
            $pageend = $page * 50;

            $data['pageend'] = $pageend1;
            $data['pagenum'] = $page;

            $Length = $this->input->post('Length');
            $wherechk = "";

            if ($Length != "") {

                $I = 1;
                foreach ($Length as $b) {
                    $Check_Length[$I] = $b;

                    if ($I <= 1) {
                        $wherechk = "'" . $Check_Length[$I] . "'";
                    } else {
                        $wherechk = "" . $wherechk . ",'" . $Check_Length[$I] . "' ";
                    }
                    $I++;
                }

                $whereLength = "contract_no in ( " . $wherechk . " )";
            }

            // print_r($whereLength);
            $this->PM->Delete_scan_one($T, $whereLength, $username);


            $Operatorname = $this->input->post("Operator");

            if ($Operatorname == "") {
                $Operatorname = "";
            } else {
                $Operatorname;
            }


            $contract_no = $this->input->post("idcustomer");
            $datestart = $this->input->post("datestart");
            $dateend = $this->input->post("dateend");
            $status = $this->input->post("status");


            if ($status == "") {
                $status = $this->input->post("statusview");
                $data['statusview'] = $this->input->post("statusview");
                $count = $this->input->post("count");
                $Sum = $this->input->post("Sum");
            } else {

                $status = $this->input->post("status");
                $data['statusview'] = $this->input->post("status");
                $count = "count" . $status;
                $Sum =  $status . "Sum";
            }

            $data['search_view'] = $this->PM->Select_Approve($T, $username, $status, $contract_no, $Operatorname, $datestart, $dateend, $start, $pageend);
            $data['search_count'] = $this->PM->Select_Approve($T, $username, $count, $contract_no, $Operatorname, $datestart, $dateend, 0, 0);
            $data['search_sum'] = $this->PM->Select_Approve_Sum($T, $username, $Sum, $contract_no, $Operatorname, $datestart, $dateend, 0, 0);

            foreach ($data['search_sum'] as $row) {
                $data['sumamount'] = $row->amount;
                $data['sumvat'] =  $row->vat;
            }


            foreach ($data['search_count'] as $value) {
                $data['COUNTNUMCOUNT'] = $value->NUMCOUNT;
            }



            $this->load->view('approve_vaiew', $data);
        }
    }



    public function Delete_approve_scan_ALL()
    {

        $username = $this->session->userdata('username');
        $companyses = $this->session->userdata('company');

        if ($username == "") {
            $this->load->view('false');
        } else {

            $data['username'] = $this->PM->username($username, $companyses);
            foreach ($data['username'] as $key) {
                $com = $key->company;
            }
            if ($com == 'jam') {
                $T = 'JAM';
            }
            if ($com == 'jmt') {
                $T = 'JMTLOAN_PROD';
            }

            $data['username_menu'] = $this->PM->username_menu($T, $username);
            $data['op'] = $this->PM->operator($T);
            $data['company'] = $this->PM->company($com);

            // $page = $this->input->post('page');
            // if ($page != '') {
            //     $page = $page;
            // } else {
            //     $page = 1;
            // }

            // $pageend1 = 50;

            // $start = ($page - 1) * $pageend1;
            // $pageend = $page * 50;

            // $data['pageend'] = $pageend1;
            // $data['pagenum'] = $page;
            // $data['page'] = $page;


            $Length = $this->input->post('Length');
            // $whereLength = ''; //ประเภทประกัน

            // if ($Length != "") {
            //     $I = 1;
            //     foreach ($Length as $b) {
            //         $Check_Length[$I] = $b;

            //         if ($I <= 1) {
            //             $wherechk = "'" . $Check_Length[$I] . "'";
            //         } else {
            //             $wherechk = "" . $wherechk . ",'" . $Check_Length[$I] . "' ";
            //         }
            //         $I++;
            //     }
            //     $whereLength = "AND L.ID_Type_Auto in ( " . $wherechk . " )";
            // }

            $data['Main_Homepayment'] = "approve_index";
            $this->load->view('Homepayment', $data);
        }
    }



    public function approvecut()
    {

        $username = $this->session->userdata('username');
        $companyses = $this->session->userdata('company');

        if ($username == "") {
            $this->load->view('false');
        } else {


            $data['username'] = $this->PM->username($username, $companyses);
            foreach ($data['username'] as $key) {
                $com = $key->company;
            }

            if ($com == 'jam') {
                $T = 'JAM';
            }
            if ($com == 'JMT') {
                $T = 'JMTLOAN_PROD';
            }

            $this->load->model('Payment_model');

            $data['username_menu'] = $this->Payment_model->username_menu($T, $username);

            $this->load->view('approvecut', $data);
        }
    }
    public function approve_updatet()
    {

        $username = $this->session->userdata('username');
        $companyses = $this->session->userdata('company');

        if ($username == "") {
            $this->load->view('false');
        } else {

            $data['username'] = $this->PM->username($username, $companyses);
            foreach ($data['username'] as $key) {
                $com = $key->company;
            }

            if ($com == 'jam') {
                $T = 'JAM';
            }
            if ($com == 'jmt') {
                $T = 'JMTLOAN_PROD';
            }

            $Currentdate = $this->PM->dateserver();
            foreach ($Currentdate as $value) {
                $dateSv = $value->Currentdate;
            }

            $numcount = $this->input->post('num');

            for ($k = 1; $k <= $numcount; $k++) {

                $r_index =   $this->input->post("r_index-" . $k);

                $this->PM->Approve_Pay($T, $r_index, $username);
            }
        }
    }

    public function bank()
    {

        $username = $this->session->userdata('username');
        $companyses = $this->session->userdata('company');

        if ($username == "") {
            $this->load->view('false');
        } else {

            $data['username'] = $this->PM->username($username, $companyses);
            foreach ($data['username'] as $key) {
                $com = $key->company;
            }

            if ($com == 'jam') {
                $T = 'JAM';
            }
            if ($com == 'jmt') {
                $T = 'JMTLOAN_PROD';
            }

            $data['bank'] = $this->PM->payment_channel($T);

            $data['company'] = $this->PM->company($com);
            $data['username_menu'] = $this->PM->username_menu($T, $username);



            $data['Main_Homepayment'] = "payment_channel";
            $this->load->view('Homepayment', $data);
        }
    }
    public function insert_channel()
    {

        $username = $this->session->userdata('username');
        $companyses = $this->session->userdata('company');

        if ($username == "") {
            $this->load->view('false');
        } else {

            $data['username'] = $this->PM->username($username, $companyses);
            foreach ($data['username'] as $key) {
                $com = $key->company;
            }

            if ($com == 'jam') {
                $T = 'JAM';
            }
            if ($com == 'jmt') {
                $T = 'JMTLOAN_PROD';
            }
            $code = trim($this->input->post("code"));
            $detail = iconv('UTF-8', 'TIS-620', trim($this->input->post("detail")));
            $status = '1';




            $Currentdate = $this->PM->dateserver();
            foreach ($Currentdate as $value) {
                $dateSv = $value->Currentdate;
            }

            $data['company'] = $this->PM->company($com);
            $data['username'] = $this->PM->username($username);
            $data['username_menu'] = $this->PM->username_menu($T, $username);
            $this->PM->insert_channel($code, $detail, $dateSv, $T, $status);
            $data['bank'] = $this->PM->payment_channel($T);


            $data['Main_Homepayment'] = "TableChannel";
            $this->load->view('Homepayment', $data);
            //redirect("Payment_controller/bank");
        }
    }

    public function delete_channel()
    {
        $username = $this->session->userdata('username');
        $companyses = $this->session->userdata('company');

        if ($username == "") {
            $this->load->view('false');
        } else {

            $data['username'] = $this->PM->username($username, $companyses);
            foreach ($data['username']  as $key) {
                $com = $key->company;
            }

            if ($com == 'jam') {
                $T = 'JAM';
            }
            if ($com == 'JMT') {
                $T = 'JMTLOAN_PROD';
            }
            $ID = $this->input->get("ID");

            $this->PM->delete_channel($ID, $T);
            redirect("Payment_controller/bank");
        }
    }

    public function status_channel()
    {

        $username = $this->session->userdata('username');
        $companyses = $this->session->userdata('company');

        if ($username == "") {
            $this->load->view('false');
        } else {

            $data['username'] = $this->PM->username($username, $companyses);
            foreach ($data['username']  as $key) {
                $com = $key->company;
            }

            if ($com == 'jam') {
                $T = 'JAM';
            }
            if ($com == 'JMT') {
                $T = 'JMTLOAN_PROD';
            }
            $id = $this->input->get("ID");
            $row = $this->PM->status_channel($id, $T);

            foreach ($row as $ss) {
                if ($ss->status == '1') {
                    echo $new_status = '0';
                }

                if ($ss->status == '0' | $ss->status == '') {
                    echo $new_status = '1';
                }
            }

            $affected = $this->PM->status_update_channel($id, $new_status, $T);

            if ($affected) {
                redirect("Payment_controller/bank");
            }
        }
    }

    public function paymonth()
    {
        $username = $this->session->userdata('username');
        $companyses = $this->session->userdata('company');

        if ($username == "") {
            $this->load->view('false');
        } else {
            $this->load->model('Payment_model');

            $data['username'] = $this->PM->username($username, $companyses);
            foreach ($data['username'] as $key) {
                $com = $key->company;
            }

            if ($com == 'jam') {
                $T = 'JAM';
            }
            if ($com == 'jmt') {
                $T = 'JMTLOAN_PROD';
            }
            $data['username_menu'] = $this->Payment_model->username_menu($T, $username);
            $this->load->view('paymonth', $data);
        }
    }

    public function keyin()
    {
        $username = $this->session->userdata('username');
        $companyses = $this->session->userdata('company');

        if ($username == "") {
            $this->load->view('false');
        } else {

            $data['username'] = $this->PM->username($username, $companyses);
            foreach ($data['username']  as $key) {
                $com = $key->company;
            }

            if ($com == 'jam') {
                $T = 'JAM';
            }
            if ($com == 'JMT') {
                $T = 'JMTLOAN_PROD';
            }
            $data['username'] = $this->Payment_model->username($username);
            $data['username_menu'] = $this->Payment_model->username_menu($T, $username);

            $this->load->view('keyin', $data);
        }
    }

    public function balancedb()
    {
        $this->load->model('Payment_model');
        $username = $this->session->userdata('username');
        $companyses = $this->session->userdata('company');

        if ($username == "") {
            $this->load->view('false');
        } else {

            $data['username'] = $this->PM->username($username, $companyses);
            foreach ($data['username']  as $key) {
                $com = $key->company;
            }


            if ($com == 'jam') {
                $T = 'JAM';
            }
            if ($com == 'jmt') {
                $T = 'JMTLOAN_PROD';
            }

            //        $this->load->view('balancedb', $data);
            $data['username_menu'] = $this->Payment_model->username_menu($T, $username);



            $data['Main_Homepayment'] = "balancedb";
            $this->load->view('Homepayment', $data);
        }
    }

    public function balanceadmin()
    {
        $username = $this->session->userdata('username');
        $companyses = $this->session->userdata('company');

        $this->load->model('Payment_model');
        if ($username == "") {
            $this->load->view('false');
        } else {


            $data['username'] = $this->PM->username($username, $companyses);
            foreach ($data['username']  as $key) {
                $com = $key->company;
            }


            if ($com == 'jam') {
                $T = 'JAM';
            }
            if ($com == 'JMT') {
                $T = 'JMTLOAN_PROD';
            }


            $data['username_menu'] = $this->Payment_model->username_menu($T, $username);
            $this->load->view('balanceadmin', $data);
        }
    }

    public function invoice()
    {

        $this->load->model('Payment_model');
        $username = $this->session->userdata('username');
        $companyses = $this->session->userdata('company');

        $data['username'] = $this->PM->username($username, $companyses);
        foreach ($data['username']  as $key) {
            $com = $key->company;
        }

        if ($com == 'jam') {
            $T = 'JAM';
        }
        if ($com == 'jmt') {
            $T = 'JMTLOAN_PROD';
        }


        $data['company'] = $this->Payment_model->company($com);

        $data['username_menu'] = $this->Payment_model->username_menu($T, $username);


        $data['op'] = $this->PM->operator($T);
        foreach ($data['op'] as $value) {
            $value->operator_name;
        }



        $data['Main_Homepayment'] = "invoice_index";
        $this->load->view('Homepayment', $data);
    }



    public function invoice_view()
    {

        $username = $this->session->userdata('username');
        $companyses = $this->session->userdata('company');

        if ($username == "") {

            $this->load->view('false');
        } else {

            $Lot = $this->input->post("lot");
            $Operator = $this->input->post("Operator");
            $contract_no = $this->input->post("idcustomer");
            $datestart = $this->input->post("datestart");
            $dateend = $this->input->post("dateend");
            $stat = $this->input->post("status");
            $Invoiced = $this->input->post("Invoice");

            $data['username'] = $this->PM->username($username, $companyses);
            foreach ($data['username']  as $key) {
                $com = $key->company;
            }

            if ($com == 'jam') {
                $T = 'JAM';
            }
            if ($com == 'jmt') {
                $T = 'JMTLOAN_PROD';
            }

            if ($contract_no == "") {
                $contract_no = "";
            } else {
                $contract_no;
            }

            if ($stat == '') {
                $status = "";
            }

            if ($stat == 0) {
                $status = "0";
            }

            if ($stat == 1) {

                $status = "1";
            }

            if ($Invoiced == 'hp') {
                $Invoice = "hp";
            }

            if ($Invoiced == '0') { // ไม่ใช่ HP 
                $Invoice = "hhp";
            }


            if ($Invoiced == 'hp') {
                $desc_item = 'Tax invoice';
                $codenum = '2';
            } else {
                $desc_item = 'invoice';
                $codenum = '1';
            }

            function extract_int($str)
            {
                $str = str_replace(",", "", $str);
                preg_match('/[[:digit:]]+\.?[[:digit:]]*/', $str, $regs);
                return (doubleval($regs[0]));
            }

            $w = $Lot;
            $get_Lot = extract_int($w);

            $get_Operator = $this->PM->get_operator($Operator, $T);
            foreach ($get_Operator as $key) {
                $Op = $key->operator_name . $get_Lot;
                $Op = $key->operator_name . $Lot;
            }

            $Currentdate = $this->PM->dateserver();
            foreach ($Currentdate as $value) {
                $dateSv = $value->Currentdate;
            }
            $Y = date('Y', strtotime($dateSv));
            $M = date('m', strtotime($dateSv));
            $YearMonth = $Y . $M;


            $get_invoice = $this->PM->get_invoice($T, $Lot, $contract_no, $Operator,  $datestart, $dateend, $status, $Invoice);

            // echo "<br>" . "EXEC [dbo].[SP_Select_Invoice_New] '$T','$Lot','$contract_no','$Operator','$datestart','$dateend','$status', '$Invoice'";

            $runinvoice = $this->PM->runinvoice($Lot, $YearMonth, $Op, $desc_item, $T);

            //     echo "SELECT TOP 1 * FROM [$T].[dbo].[runinvoice]
            // WHERE Lot = '$get_Lot' AND desc_item = '$desc_item' AND operator = '$Op' ORDER BY YearMonth DESC";

            foreach ($runinvoice as $value) {
                $RunNo = $value->RunNo;
                $YM = $value->YearMonth;
            }

            $count_runinvoice = count($runinvoice);
            $count_get_invoice = count($get_invoice);

            $operator_id = '';
            foreach ($get_invoice as $row) {
                $amount = $row->amount;
                $r_index = $row->r_index;
                $operator_id = $row->operator_id;
            }
            for ($i = 0; $i <= $count_get_invoice; $i++) { //ถ้ายังไม่เคยมีข้อมูล operator จะเริ่มนับจำนวน 1 ใหม่
                if ($count_runinvoice == 0) {
                    $data['num_Invoice' . $i] = $YearMonth . '00' + $Lot . '000000' + $i;
                } elseif ($stat == 1) {

                    $Runnumber = $RunNo + $i;
                    $numberRunNo = substr("000000" . $Runnumber, -6, 6);
                    $numberoperator = substr("00" . $operator_id, -2, 2);
                    $numberLot = substr("00" . $Lot, -2, 2);
                    $data['num_Invoice' . $i] = 'CN' . $YearMonth . $numberoperator . $numberLot . $numberRunNo;
                } else {  //ถ้ายังไม่เคยมีข้อมูล operator จะเริ่มนับจำนวนต่อจากเดิม

                    $Runnumber = $RunNo + $i;
                    $numberRunNo = substr("000000" . $Runnumber, -6, 6);
                    $numberoperator = substr("00" . $operator_id, -2, 2);
                    $numberLot = substr("00" . $Lot, -2, 2);
                    $data['num_Invoice' . $i] =  $YearMonth . $numberoperator . $numberLot . $numberRunNo;
                }
            }

            $data['invoice'] = $this->PM->get_invoice($T, $Lot, $contract_no, $Operator, $datestart, $dateend, $status, $Invoice);

            $this->load->view('invoice_view', $data);
        }
    }

    public function Invoice_updatet()
    {

        $username = $this->session->userdata('username');
        $companyses = $this->session->userdata('company');

        if ($username == "") {

            $this->load->view('false');
        } else {


            $data['username'] = $this->PM->username($username, $companyses);
            foreach ($data['username']  as $key) {
                $com = $key->company;
            }

            if ($com == 'jam') {
                $T = 'JAM';
            }
            if ($com == 'jmt') {
                $T = 'JMTLOAN_PROD';
            }

            $numcount = $this->input->post('num');
            $op = $this->input->post('Operator');
            $datestart = $this->input->post('datestart');
            $dateend = $this->input->post('dateend');
            $lot = $this->input->post('lot');
            $status = $this->input->post('status');
            //$Invoicer = $this->input->post('Invoice');
            $Invoiced = $this->input->post("Invoice");



            for ($k = 1; $k <= $numcount; $k++) {

                // echo "<br>" . $i = $this->input->post('i' . $k);
                $r_index = $this->input->post('r_index-' . $k);
                $contract_no = $this->input->post('contract_no-' . $k);
                $refno2 = $this->input->post('refno2-' . $k);
                $state = $this->input->post('state-' . $k);
                $IDCard = $this->input->post('IDCard-' . $k);
                $amount = $this->input->post('amount-' . $k);
                $Lot = $this->input->post('Lot-' . $k);
                $num = $this->input->post('num-' . $k);
                $desc = $this->input->post('Invoice' . $k);

                if ($Invoiced == 'hp') {
                    $desc_item = 'Tax invoice';
                    $codenum = '2';
                } else {
                    $desc_item = 'invoice';
                    $codenum = '1';
                }


                // function extract_int($str)
                // {
                //     $str = str_replace(",", "", $str);
                //     preg_match('/[[:digit:]]+\.?[[:digit:]]*/', $str, $regs);
                //     return (doubleval($regs[0]));
                // }

                // $w = $Lot_No;
                // $Lot = extract_int($w);


                $get_Operator = $this->PM->get_operator($op, $T);
                foreach ($get_Operator as $key) {
                    $Operator = $key->operator_name . $Lot;
                    $operator_id = $key->operator_id;
                }

                $Currentdate = $this->PM->dateserver();
                foreach ($Currentdate as $value) {
                    $dateSv = $value->Currentdate;
                }
                $Y = date('Y', strtotime($dateSv));
                $M = date('m', strtotime($dateSv));
                $YearMonth = $Y . $M;

                $Text = $this->PM->Textbath($T, $amount);
                foreach ($Text as $key) {
                    $Textbath = "-=" . $key->Textbath . "=-";
                }

                //select ตรวจสอบข้อมูล [runinvoice] ว่ามี lot นี้หรือไม่และ RunNo มีค่าเท่าไหร่
                $runinvoice = $this->PM->runinvoice($Lot, $YearMonth, $Operator, $desc_item, $T);
                foreach ($runinvoice as $value) {
                    $RunNo = $value->RunNo;
                    $YM = $value->YearMonth; // ปีและเดือน 202102
                }

                //count data ว่ามีข้อมูลมั้ย เพื่อ update ตามเงื่อนไข
                $count_runinvoice = count($runinvoice);
                if (
                    $count_runinvoice == 0
                ) {
                    $numberoperator = substr("00" . $operator_id, -2, 2);
                    $numberLot = substr("00" . $Lot, -2, 2);
                    $num_Invoice  = $YearMonth . $numberoperator . $numberLot . $k;
                    $get_RunNo = $k;

                    $this->PM->update_runinvoice($contract_no, $state, $IDCard, $num_Invoice, $Textbath, $refno2, $amount, $r_index, $T);
                    // if ($num == $k) {
                    $this->PM->runinvoice_insert($codenum, $Lot, $desc_item, $Operator, $YearMonth, $get_RunNo, $T);
                    // }
                } else if ($state == 1) {

                    $Runnumber = $RunNo + $k;
                    $numberRunNo = substr("000000" . $Runnumber, -6, 6);
                    $numberoperator = substr("00" . $operator_id, -2, 2);
                    $numberLot = substr("00" . $Lot, -2, 2);

                    // echo "<br>" .   $num_Invoice = $YearMonth . $numberoperator . $numberLot . $numberRunNo;
                    echo "<br>" . $num_Invoice = 'CN' . $YearMonth . $numberoperator . $numberLot . $numberRunNo;
                    $get_RunNo = $RunNo + $k;

                    $this->PM->update_runinvoice($contract_no, $state, $IDCard, $num_Invoice, $Textbath, $refno2, $amount, $r_index, $T);

                    echo "UPDATE [$T].[dbo].[receive]
                        SET invoiceno = '$num_Invoice',bathtext = '$Textbath',state = '2' 
                        WHERE id_no = '$IDCard' AND contract_no = '$contract_no' AND state = '$state'
                        AND refno2 = '$refno2' AND amount = '$amount' AND r_index = '$r_index'";

                    echo "<br>" . $k . $YM . "==>" . $YearMonth;

                    // if ($num == $k) {

                    if ($YM == $YearMonth) {
                        $this->PM->runinvoice_update($codenum, $Lot, $desc_item, $Operator, $YearMonth, $get_RunNo, $T);

                        echo "UPDATE [$T].[dbo].[runinvoice] SET 
                        RunNo='$get_RunNo' 
                        WHERE Lot = '$Lot' AND desc_item = '$desc_item' AND operator = '$Operator' AND YearMonth = '$YearMonth'";
                    } else {
                        $this->PM->runinvoice_insert($codenum, $Lot, $desc_item, $Operator, $YearMonth, $get_RunNo, $T);
                    }
                    // }

                } else if ($state == 0) { // CN runinvoice ต้องมี CN นำหน้า

                    echo "!CN";

                    $Runnumber = $RunNo + $k;
                    $numberRunNo = substr("000000" . $Runnumber, -6, 6);
                    $numberoperator = substr("00" . $operator_id, -2, 2);

                    $numberLot = substr(
                        "00" . $Lot,
                        -2,
                        2
                    );
                    $num_Invoice = $YearMonth . $numberoperator . $numberLot . $numberRunNo;
                    // echo "<br>" . $num_Invoice = 'CN' . $YearMonth . $numberoperator . $numberLot . $numberRunNo;
                    $get_RunNo = $RunNo + $k;

                    $this->PM->update_runinvoice($contract_no, $state, $IDCard, $num_Invoice, $Textbath, $refno2, $amount, $r_index, $T);


                    echo "UPDATE [$T].[dbo].[receive]
                        SET invoiceno = '$num_Invoice',bathtext = '$Textbath',state = '2' 
                        WHERE id_no = '$IDCard' AND contract_no = '$contract_no' AND state = '$state'
                        AND refno2 = '$refno2' AND amount = '$amount' AND r_index = '$r_index'";

                    // if ($num == $k) {
                    if ($YM == $YearMonth) {

                        $this->PM->runinvoice_update($codenum, $Lot, $desc_item, $Operator, $YearMonth, $get_RunNo, $T);

                        echo "UPDATE [$T].[dbo].[runinvoice] SET 
                        RunNo='$get_RunNo' 
                        WHERE Lot = '$Lot' AND desc_item = '$desc_item' AND operator = '$Operator' AND YearMonth = '$YearMonth'";
                    } else {
                        $this->PM->runinvoice_insert($codenum, $Lot, $desc_item, $Operator, $YearMonth, $get_RunNo, $T);

                        echo "INSERT INTO [$T].[dbo].[runinvoice] 
                        (codenum,Lot,invoice,desc_item,operator,YearMonth,RunNo)
                        VALUES ('$codenum','$Lot','0','$desc_item','$Operator','$YearMonth','$get_RunNo')";
                    }
                }
            } //End Loop
        }
    }

    public function receive()
    {

        $username = $this->session->userdata('username');
        $company = $this->PM->username($username);

        if ($username == "") {
            $this->load->view('false');
        } else {

            foreach ($company as $key) {
                $com = $key->company;
            }
            if ($com == 'jam') {
                $T = 'JAM';
            }
            if ($com == 'jmt') {
                $T = 'JMTLOAN_PROD';
            }
            $data['username'] = $this->PM->username($username);
            $data['username_menu'] = $this->PM->username_menu($T, $username);

            $data['Main_Homepayment'] = "receive";
            $this->load->view('Homepayment', $data);
        }
    }


    public function daily()
    {

        $username = $this->session->userdata('username');
        $companyses = $this->session->userdata('company');

        if ($username == "") {
            $this->load->view('false');
        } else {
            $data['username'] = $this->PM->username($username, $companyses);
            foreach ($data['username'] as $key) {
                $com = $key->company;
            }

            if ($com == 'jam') {
                $T = 'JAM';
            }
            if ($com == 'jmt') {
                $T = 'JMTLOAN_PROD';
            }

            $data['op'] = $this->PM->operator($T);
            $data['username_menu'] = $this->PM->username_menu($T, $username);
            $data['company'] = $this->PM->company($com);


            $data['Main_Homepayment'] = "daily_index";
            $this->load->view('Homepayment', $data);
        }
    }


    //  Daily Receive Report
    public function daily_view()
    {

        $username = $this->session->userdata('username');
        $companyses = $this->session->userdata('company');

        if ($username == "") {
            $this->load->view('false');
        } else {

            $data['username'] = $this->PM->username($username, $companyses);
            foreach ($data['username'] as $key) {
                $com = $key->company;
            }


            if ($com == 'jam') {
                $T = 'JAM';
            }
            if ($com == 'jmt') {
                $T = 'JMTLOAN_PROD';
            }

            $datestart = $this->input->post('datestart');
            $lot = $this->input->post('lot');
            $Operator = $this->input->post('Operator');
            $op = $Operator;


            if ($lot == '') {
                $lot = "";
            } else {
                $lot;
            }

            if ($Operator == '') {
                $Operator = "";
                $Type = "Many";
            } else {
                $Operator;
                $Type = "One";
            }

            $data['daily'] = $this->PM->daily($com, $lot, $Operator, $Type, $datestart);

            //  echo"EXEC [dbo].[SP_REPORT_PAYMENT_SYSTEM] 'Daily','$com','$lot','$Operator','$Type','$datestart',NULL,NULL,'0','0'";


            $data['company'] = $this->PM->company($com);
            $Opn = $this->PM->get_operator($op, $T);
            foreach ($Opn as $key) {
                $data['OPP'] = $key->operator_name;
            }
            $data['date'] = $datestart;

            $this->load->view('daily_view', $data);
        }
    }

    public function daily_PDF()
    {

        $username = $this->session->userdata('username');
        $companyses = $this->session->userdata('company');

        foreach ($companyses as $key) {
            $com = $key->company;
        }

        if ($com == 'jam') {
            $T = 'JAM';
        }
        if ($com == 'JMT') {
            $T = 'JMTLOAN_PROD';
        }

        $datestart = $this->input->post('datestart');
        $lot = $this->input->post('lot');
        $Operator = $this->input->post('Operator');
        $op = $this->input->post('Operator');

        if ($lot == '') {
            $lot = "";
        } else {
            $lot = " AND c.lot_no = '" . $lot . "' ";
        }

        if ($Operator == '') {
            $Operator = "";
            $Type = "Many";
        } else {
            $Operator;
            $Type = "One";
        }


        $data['date'] = $datestart;
        $data['op'] = $this->PM->get_operator($op, $T);
        $data['company'] = $this->PM->company($com);

        $data['daily'] = $this->PM->daily($com, $lot, $Operator, $Type, $datestart);

        $data['CN'] = $this->PM->get_chennel($T);

        // $data['daily_group'] = $this->PM->daily_group($datestart,$lot,$Operator,$TT);
        // $CN = $this->PM->get_chennel($T);
        // foreach ($CN as $key) {
        // 	$chennel = $key->code;
        // 	$daily = $this->PM->daily_group($datestart,$lot,$Operator,$TT,$chennel);
        // 	foreach ($daily as $k) {
        // 		echo $k->chennel."<br>";
        // 	}
        // 	if (count($daily) != 0) {
        // 		$daily_group_sum = $this->PM->daily_group_sum($datestart,$lot,$Operator,$TT,$chennel);
        // 		foreach ($daily_group_sum as $r) {
        // 			echo $nn = $r->amount."|";
        // 			echo $r->vatamount."|";
        // 			echo $r->sumAV."<br>";
        // 		}
        // 		echo "------------------------------"."<br>";
        // 	}
        // }



        $this->load->view('daily_pdf', $data);
    }

    public function daily_Excel()
    {

        $username = $this->session->userdata('username');
        $companyses = $this->session->userdata('company');

        if ($username == "") {
            $this->load->view('false');
        } else {
            $data['username'] = $this->PM->username($username, $companyses);
            foreach ($data['username'] as $key) {
                $com = $key->company;
            }

            if ($com == 'jam') {
                $T = 'JAM';
            }
            if ($com == 'jmt') {
                $T = 'JMTLOAN_PROD';
            }

            $datestart = $this->input->post('datestart');
            $l = $this->input->post('lot');
            $Operator = $this->input->post('Operator');

            if ($Operator == '') {
                $Operator = "";
                $Type = "Many";
            } else {
                $Operator;
                $Type = "One";
            }

            $data['company'] = $this->PM->company($com);
            $data['daily'] = $this->PM->daily($com, $l, $Operator, $Type, $datestart);

            $this->load->view('daily_pdf', $data);
        }
    }

    public function summary()
    {
        $username = $this->session->userdata('username');
        $companyses = $this->session->userdata('company');
        if ($username == "") {
            $this->load->view('false');
        } else {
            $data['username'] = $this->PM->username($username, $companyses);
            foreach ($data['username'] as $key) {
                $com = $key->company;
            }

            if ($com == 'jam') {
                $T = 'JAM';
            }
            if ($com == 'JMT') {
                $T = 'JMTLOAN_PROD';
            }

            $data['username_menu'] = $this->PM->username_menu($T, $username);
            $this->load->view('summary', $data);
        }
    }

    public function discount()
    {
        $username = $this->session->userdata('username');
        $companyses = $this->session->userdata('company');
        if ($username == "") {
            $this->load->view('false');
        } else {
            $data['username'] = $this->PM->username($username, $companyses);
            foreach ($data['username'] as $key) {
                $com = $key->company;
            }

            if ($com == 'jam') {
                $T = 'JAM';
            }
            if ($com == 'JMT') {
                $T = 'JMTLOAN_PROD';
            }

            $this->load->model('Payment_model');
            $data['username_menu'] = $this->Payment_model->username_menu($T, $username);
            $this->load->view('discount', $data);
        }
    }

    public function tax()
    {
        $username = $this->session->userdata('username');
        $companyses = $this->session->userdata('company');

        if ($username == "") {
            $this->load->view('false');
        } else {

            $data['username'] = $this->PM->username($username, $companyses);
            foreach ($data['username'] as $key) {
                $com = $key->company;
            }

            if ($com == 'jam') {
                $T = 'JAM';
            }
            if ($com == 'JMT') {
                $T = 'JMTLOAN_PROD';
            }
            $this->load->model('Payment_model');
            $data['username_menu'] = $this->Payment_model->username_menu($T, $username);
            $this->load->view('tax', $data);
        }
    }


    public function ord()
    {
        $username = $this->session->userdata('username');
        $companyses = $this->session->userdata('company');

        if ($username == "") {
            $this->load->view('false');
        } else {
            $data['username'] = $this->PM->username($username, $companyses);
            foreach ($data['username'] as $key) {
                $com = $key->company;
            }

            if ($com == 'jam') {
                $T = 'JAM';
            }
            if ($com == 'JMT') {
                $T = 'JMTLOAN_PROD';
            }
            $this->load->model('Payment_model');
            $data['username_menu'] = $this->Payment_model->username_menu($T, $username);
            $this->load->view('ord', $data);
        }
    }


    public function ors()
    {
        $username = $this->session->userdata('username');
        $companyses = $this->session->userdata('company');

        if ($username == "") {
            $this->load->view('false');
        } else {
            $data['username'] = $this->PM->username($username, $companyses);
            foreach ($data['username'] as $key) {
                $com = $key->company;
            }

            if ($com == 'jam') {
                $T = 'JAM';
            }
            if ($com == 'jmt') {
                $T = 'JMTLOAN_PROD';
            }
            $this->load->model('Payment_model');
            $data['username_menu'] = $this->Payment_model->username_menu($T, $username);
            $this->load->view('ors', $data);
        }
    }
    public function exportreport()
    {
        $username = $this->session->userdata('username');
        $companyses = $this->session->userdata('company');

        if ($username == "") {
            $this->load->view('false');
        } else {
            $data['username'] = $this->PM->username($username, $companyses);
            foreach ($data['username'] as $key) {
                $com = $key->company;
            }

            if ($com == 'jam') {
                $T = 'JAM';
            }
            if ($com == 'jmt') {
                $T = 'JMTLOAN_PROD';
            }
            $this->load->model('Payment_model');
            $data['username_menu'] = $this->Payment_model->username_menu($T, $username);

            $this->load->view('exportreport', $data);
        }
    }

    public function updatedreport()
    {
        $username = $this->session->userdata('username');
        $companyses = $this->session->userdata('company');
        if ($username == "") {
            $this->load->view('false');
        } else {
            $data['username'] = $this->PM->username($username, $companyses);
            foreach ($data['username'] as $key) {
                $com = $key->company;
            }

            if ($com == 'jam') {
                $T = 'JAM';
            }
            if ($com == 'JMT') {
                $T = 'JMTLOAN_PROD';
            }

            $this->load->model('Payment_model');
            $data['username_menu'] = $this->Payment_model->username_menu($T, $username);
            //		$this->load->view('updatedreport',$data);

            $data['Main_Homepayment'] = "updatedreport";
            $this->load->view('Homepayment', $data);
        }
    }


    // public function setting_index()
    // {

    //     $username = $this->session->userdata('username');
    //     $companyses = $this->session->userdata('company');

    //     if ($username == "") {
    //         $this->load->view('false');
    //     } else {
    //         $data['username'] = $this->PM->username($username, $companyses);
    //         foreach ($data['username'] as $key) {
    //             $com = $key->company;
    //         }
    //         if ($com == 'jam') {
    //             $T = 'JAM';
    //         }
    //         if ($com == 'JMT') {
    //             $T = 'JMTLOAN_PROD';
    //         }

    //         $data['username_menu'] = $this->PM->username_menu($username, $T);
    //         $data['rights'] = $this->PM->rights($T);

    //         $data['company'] = $this->PM->company($com);
    //         $data['user'] = $this->PM->user_setting($T);



    //         $data['Main_Homepayment'] = "setting_index";
    //         $this->load->view('Homepayment', $data);
    //     }
    // }

    public function setting_index()
    {

        $username = $this->session->userdata('username');
        $companyses = $this->session->userdata('company');

        if ($username == "") {
            $this->load->view('false');
        } else {
            $data['username'] = $this->PM->username($username, $companyses);
            foreach ($data['username'] as $key) {
                $com = $key->company;
            }
            if ($com == 'jam') {
                $T = 'JAM';
            }
            if ($com == 'jmt') {
                $T = 'JMTLOAN_PROD';
            }

            $data['username_menu'] = $this->PM->username_menu($T, $username);
            $data['rights'] = $this->PM->rights($T);

            $data['company'] = $this->PM->company($com);
            $data['user'] = $this->PM->user_setting($T);



            $data['Main_Homepayment'] = "setting_index";
            $this->load->view('Homepayment', $data);
        }
    }
    public function setting_detail()
    {


        $username = $this->session->userdata('username');
        $companyses = $this->session->userdata('company');


        if ($username == "") {
            $this->load->view('false');
        } else {

            $id = $this->input->get("id");
            $data['username'] = $this->PM->username($username, $companyses);
            foreach ($data['username'] as $key) {
                $com = $key->company;
            }
            if ($com == 'jam') {
                $T = 'JAM';
            }
            if ($com == 'jmt') {
                $T = 'JMTLOAN_PROD';
            }

            $data['username_menu'] = $this->PM->username_menu($T, $username);
            $data['username_menu_ID'] = $this->PM->username_menu_ID($T, $id);
            $data['rights'] = $this->PM->rights($T);
            $data['menu_view'] = $this->PM->setting_menu_view($T, $id);


            $data['company'] = $this->PM->company($com);
            $data['user'] = $this->PM->get_user_setting($T, $id);
            foreach ($data['user'] as $key) {
                $num = $key->user_level;
            }
            $data['rights_ID'] = $this->PM->rights_ID($T, $num);


            $data['Main_Homepayment'] = "setting_detail";
            $this->load->view('Homepayment', $data);
        }
    }
    public function setting_insert()
    {

        $username = $this->session->userdata('username');
        $companyses = $this->session->userdata('company');

        if ($username == "") {
            $this->load->view('false');
        } else {
            $data['username'] = $this->PM->username($username, $companyses);
            foreach ($data['username'] as $key) {
                $com = $key->company;
            }
            if ($com == 'jam') {
                $T = 'JAM';
            }
            if ($com == 'jmt') {
                $T = 'JMTLOAN_PROD';
            }
            $name = iconv('UTF-8', 'TIS-620', $this->input->post("name"));
            $Username = $this->input->post("Username");
            $Password = $this->input->post("Password");
            $user_status = 0;
            $company = $this->input->post("company");
            $Rights = $this->input->post("Rights");

            $this->PM->setting_insert($T, $name, $Username, $Password, $user_status, $company, $Rights);


            $data['Main_Homepayment'] = "setting_index";
            $this->load->view('Homepayment', $data);
            //  redirect("Payment_controller/setting_index");
        }
    }

    public function setting_update()
    {

        $username = $this->session->userdata('username');
        $companyses = $this->session->userdata('company');

        if ($username == "") {
            $this->load->view('false');
        } else {
            $data['username'] = $this->PM->username($username, $companyses);
            foreach ($data['username'] as $key) {
                $com = $key->company;
            }
            if ($com == 'jam') {
                $T = 'JAM';
            }
            if ($com == 'jmt') {
                $T = 'JMTLOAN_PROD';
            }
            $id = $this->input->get("id");
            $name = iconv('UTF-8', 'TIS-620', $this->input->post("name"));
            $Username = $this->input->post("Username");
            $Password = $this->input->post("Password");
            $company = $this->input->post("company");
            $Rights = $this->input->post("Rights");
            $chkPeriod = $this->input->post("chkPeriod");
            $this->PM->setting_delete($T, $id);
            $num = $this->input->post("num");

            $i = 1;
            foreach ($num as $key) {
                $key = $key;
                $this->PM->setting_menu($T, $id, $key);

                $this->PM->setting_update($T, $id, $name, $Username, $Password, $company, $Rights, $key, $chkPeriod);

                $i++;
            }

            redirect("Payment_controller/setting_index");
        }
    }


    public function setting_status()
    {
        $username = $this->session->userdata('username');
        $companyses = $this->session->userdata('company');

        if ($username == "") {
            $this->load->view('false');
        } else {
            $data['username'] = $this->PM->username($username, $companyses);
            foreach ($data['username'] as $key) {
                $com = $key->company;
            }
            if ($com == 'jam') {
                $T = 'JAM';
            }
            if ($com == 'jmt') {
                $T = 'JMTLOAN_PROD';
            }
            $id = $this->input->get("id");
            $row = $this->PM->setting_status($T, $id);

            foreach ($row as $ss) {
                if ($ss->user_status == '0') {
                    $new_status = '1';
                }

                if ($ss->user_status == '1') {
                    $new_status = '0';
                }
            }

            $affected = $this->PM->setting_status_update($T, $id, $new_status);

            if ($affected) {
                redirect("Payment_controller/setting_index");
            }
        }
    }
    public function model2()
    {

        $username = $this->session->userdata('username');
        $companyses = $this->session->userdata('company');

        if ($username == "") {
            $this->load->view('false');
        } else {

            $data['username'] = $this->PM->username($username, $companyses);
            foreach ($data['username'] as $key) {
                $com = $key->company;
            }

            if ($com == 'jam') {
                $T = 'JAM';
            }
            if ($com == 'jmt') {
                $T = 'JMTLOAN_PROD';
            }

            $data['op'] = $this->PM->operator($T);
            $data['username_menu'] = $this->PM->username_menu($T, $username);
            $data['company'] = $this->PM->company($com);


            $data['Main_Homepayment'] = "receive_index";
            $this->load->view('Homepayment', $data);
        }
    }


    public function Receive_PROCUCT()
    {
        $username = $this->session->userdata('username');
        $companyses = $this->session->userdata('company');

        if ($username == "") {
            $this->load->view('false');
        } else {


            $data['username'] = $this->PM->username($username, $companyses);
            foreach ($data['username'] as $key) {
                $com = $key->company;
            }

            if ($com == 'jam') {
                $T = 'JAM';
            }
            if ($com == 'jmt') {
                $T = 'JMTLOAN_PROD';
            }

            $datestartoperator =  $this->input->post('datestartdaily');
            $Operator = $this->input->post('Operatordaily');

            if ($Operator == '') {
                $Operator = "";
                $Type = "Many";
            } else {
                $Operator;
                $Type = "One";
            }

            $data['company'] = $this->PM->company($com);
            $data['receive'] = $this->PM->SUM_REPROT_BY_PROCUCT('ReceiveProductDaily', $com, $Operator, $Type, $datestartoperator);

            // foreach ($data['receive'] as $value) {
            //         $value->contract_no;
            //         $value->amount;
            // }
            // if ($com == 'jam') {
            //     $TT = 'JAM';
            //     $data['receive'] = $this->PM->Summary_receive_CN($datestartoperator, $datestartoperator2, $Operator, $lot, $T, $start, $pageend, $Countcondition);
            // }
            // if ($com == 'jmt') {

            //     $TT = 'JMTLOAN_PROD';

            //     $data['receive'] = $this->PM->Summary_receive_CN($datestartoperator, $datestartoperator2, $Operator, $lot, $T, $start, $pageend, $Countcondition);
            //     foreach ($data['receive'] as $value) {
            //         $value->contract_no;
            //         $value->amount;
            //     }
            // }

            $data['date'] = date('d/m/Y', strtotime($datestartoperator));

            $this->load->view('receive_view_CN', $data);
        }
    }


    public function receive_view1()
    {
        $username = $this->session->userdata('username');
        $companyses = $this->session->userdata('company');

        if ($username == "") {
            $this->load->view('false');
        } else {

            $datestartoperator = $this->input->post('datestartoperatorMonth');
            $datestartoperator2 = $this->input->post('datestartoperatorMonth2');
            $lot = $this->input->post('lotoperatorMonth');
            $Operator = $this->input->post('OperatorMonth');
            $op = $Operator;

            if ($lot == '') {
                $lot = "";
            } else {
                $lot;
                //$lot = " AND c.lot_no = '" . $l . "' ";
            }

            if ($Operator == '') {
                // $get_Operator = "";
                $Operator = "";
                $Type = "Many";
            } else {
                $Operator;
                $Type = "One";
                // $get_Operator = " AND o.operator_name = '" . $Operator . "' ";
            }

            $data['username'] = $this->PM->username($username, $companyses);

            foreach ($data['username'] as $key) {
                $com = $key->company;
            }

            if ($com == 'jam') {
                $T = 'JAM';
            }
            if ($com == 'jmt') {
                $T = 'JMTLOAN_PROD';
            }

            $text = 'แสดงทุก Operator';

            $Countcondition = "SELECT";

            $page = $this->input->post('page');

            $pageend1 = 50;
            if ($page != '') {
                $page = $page;
            } else {
                $page = 1;
            }

            $start = ($page - 1) * $pageend1;
            $pageend = $page * 50;

            $data['pageend'] = $pageend1;
            $data['numpage'] = $page;
            $data['company'] = $this->PM->company($com);

            $data['receive'] = $this->PM->Summary_receive_OperatorMonth('ReceiveMonth', $com, $lot, $Operator, $Type, $datestartoperator, $datestartoperator2);
            // $data['receive'] = $this->PM->Summary_receive_OperatorMonth($datestartoperator, $datestartoperator2, $Operator, $lot, $T, $start, $pageend, $Countcondition);


            // $Countcondition = 'COUNT';
            // $data['Countreceiveoperatormounth'] = $this->PM->Summary_receive_OperatorMonth($datestartoperator, $datestartoperator2, $Operator, $lot, $T, $start, $pageend, $Countcondition);
            // $data['sumoperatormounth'] = $data['Countreceiveoperatormounth'][0]->Count;


            if ($Operator == '') {
                $data['OPP'] = $text;
            } else {
                $Opn = $this->PM->get_operator($op, $T);
                foreach ($Opn as $key) {

                    $data['OPP'] = $key->operator_name;
                }
            }

            $data['date'] = date('d/m/Y', strtotime($datestartoperator)) . "-" . date('d/m/Y', strtotime($datestartoperator2));
            if ($lot == '') {
                $data['lot'] = '';
            } else {
                $data['lot'] = 'Lot ' . $lot . ' ';
            }

            $this->load->view('receive_view1', $data);
        }
    }


    public function receive_view_chennel()
    {
        $username = $this->session->userdata('username');
        $companyses = $this->session->userdata('company');

        if ($username == "") {
            $this->load->view('false');
        } else {

            $data['username'] = $this->PM->username($username, $companyses);
            foreach ($data['username'] as $key) {
                $com = $key->company;
            }
            $data['company'] = $this->PM->company($com);


            if ($com == 'jam') {
                $T = 'JAM';
            }
            if ($com == 'jmt') {
                $T = 'JMTLOAN_PROD';
            }

            $datestart = $this->input->post('datestartchannel');
            $Operator = $this->input->post('Operatorchannel');
            // $dateend = $this->input->post('dateendchannel');
            // $lot = $this->input->post('lotchannel');


            if ($Operator == '') {
                $Operator = "";
                $Type = "Many";
            } else {
                $Operator;
                $Type = "One";
            }


            $data['receive'] = $this->PM->SUM_REPROT_BY_CHENNEL('ReceiveChanelDaily', $com, $Operator, $Type, $datestart);
            $this->load->view('receive_view_OP', $data);
        }
    }

    public function model3()
    {

        $username = $this->session->userdata('username');
        $companyses = $this->session->userdata('company');

        if ($username == "") {
            $this->load->view('false');
        } else {
            $data['username'] = $this->PM->username($username, $companyses);
            foreach ($data['username'] as $key) {
                $com = $key->company;
            }

            if ($com == 'jam') {
                $T = 'JAM';
            }
            if ($com == 'jmt') {
                $T = 'JMTLOAN_PROD';
            }

            $data['op'] = $this->PM->operator($T);
            $data['username_menu'] = $this->PM->username_menu($T, $username);
            $data['company'] = $this->PM->company($com);



            $data['Main_Homepayment'] = "report_discount_index";
            $this->load->view('Homepayment', $data);
        }
    }

    public function report_discount_view()
    {
        $username = $this->session->userdata('username');
        $companyses = $this->session->userdata('company');

        if ($username == "") {
            $this->load->view('false');
        } else {

            $data['username'] = $this->PM->username($username, $companyses);
            foreach ($data['username'] as $key) {
                $com = $key->company;
            }
            $data['company'] = $this->PM->company($com);

            if ($com == 'jam') {
                $T = 'JAM';
            }
            if ($com == 'jmt') {
                $T = 'JMTLOAN_PROD';
            }

            $status = $this->input->post('status');
            $Operator = $this->input->post('Operator');
            $lot = $this->input->post('lot');
            $date = date('Y/m/d', strtotime($this->input->post('date')));


            if ($lot == '') {
                $lot = "";
            } else {
                $lot;
            }

            if ($Operator == '') {
                $Operator = "";
                $Type = "Many";
            } else {
                $Operator;
                $Type = "One";
            }

            $data['report'] = $this->PM->report_discount($com, $lot, $Operator, $Type, $date, $status);

            $data['company'] = $this->PM->company($com);
            $data['Operator'] = $Operator;
            $data['status'] = $status;
            $data['date'] = date('m/Y', strtotime($date));

            $this->load->view('report_discount_view', $data);
        }
    }
    public function model4()
    {
        $username = $this->session->userdata('username');
        $companyses = $this->session->userdata('company');

        $data['username'] = $this->PM->username($username, $companyses);
        foreach ($data['username'] as $key) {
            $com = $key->company;
        }

        if ($com == 'jam') {
            $T = 'JAM';
        }
        if ($com == 'jmt') {
            $T = 'JMTLOAN_PROD';
        }

        $data['op'] = $this->PM->operator($T);
        $data['username_menu'] = $this->PM->username_menu($T, $username);
        $data['company'] = $this->PM->company($com);


        $data['Main_Homepayment'] = "Tax_report_index";
        $this->load->view('Homepayment', $data);
    }

    public function Tax_report_view()
    {
        $username = $this->session->userdata('username');
        $companyses = $this->session->userdata('company');

        $data['username'] = $this->PM->username($username, $companyses);
        foreach ($data['username'] as $key) {
            $com = $key->company;
        }

        if ($com == 'jam') {
            $T = 'JAM';
        }
        if ($com == 'jmt') {
            $T = 'JMTLOAN_PROD';
        }

        $Operator = $this->input->post('Operator');
        $lot = $this->input->post('lot');
        $date = date('Y/m/d', strtotime($this->input->post('date')));
        $dateend2 = date('Y/m/d', strtotime($this->input->post('dateend2')));

        if ($Operator == '') {
            $Operator = "";
            $Type = "Many";
        } else {
            $Operator;
            $Type = "One";
        }

        if ($lot == '') {
            $lot = "";
        } else {
            $lot;
        }

        $data['report'] = $this->PM->Tax_report($com, $lot, $Operator, $Type, $date, $dateend2);

        $data['company'] = $this->PM->company($com);
        foreach ($data['company'] as $key) {
            $data['nameC'] = iconv('tis-620', 'utf-8', $key->name);
            $data['taxno'] = iconv('tis-620', 'utf-8', $key->taxno);
            $data['address'] = iconv('tis-620', 'utf-8', $key->address);
        }
        $data['Operator'] = $Operator;
        $data['date'] = date('m/Y', strtotime($date));

        $this->load->view('Tax_report_view', $data);
    }


    public function SumTax()
    {
        $username = $this->session->userdata('username');
        $companyses = $this->session->userdata('company');

        $data['username'] = $this->PM->username($username, $companyses);
        foreach ($data['username'] as $key) {
            $com = $key->company;
        }

        if ($com == 'jam') {
            $T = 'JAM';
        }
        if ($com == 'jmt') {
            $T = 'JMTLOAN_PROD';
        }

        $data['op'] = $this->PM->operator($T);
        $data['username_menu'] = $this->PM->username_menu($T, $username);
        $data['company'] = $this->PM->company($com);


        $data['Main_Homepayment'] = "SumTaxreport_index";
        $this->load->view('Homepayment', $data);
    }

    public function Sumtax_report()
    {
        $username = $this->session->userdata('username');
        $companyses = $this->session->userdata('company');

        $data['username'] = $this->PM->username($username, $companyses);
        foreach ($data['username'] as $key) {
            $com = $key->company;
        }

        if ($com == 'jam') {
            $T = 'JAM';
        }
        if ($com == 'jmt') {
            $T = 'JMTLOAN_PROD';
        }

        $Operator = $this->input->post('Operator');
        $lot = $this->input->post('lot');
        $date = date('Y-m-d', strtotime($this->input->post('date')));
        $dateendsumtex = $this->input->post('dateendsumtex');

        if ($Operator == '') {
            $Operator = "";
            $Type = "Many";
        } else {
            $Operator;
            $Type = "One";
        }
        if ($lot == '') {
            $lot = "";
        } else {
            $lot;
        }

        $data['report'] = $this->PM->SumTax_report($com, $lot, $Operator, $Type, $date, $dateendsumtex);

        $this->load->view('SumTaxreport_view', $data);
    }





    public function model5()
    {

        $username = $this->session->userdata('username');
        $companyses = $this->session->userdata('company');

        if ($username == "") {
            $this->load->view('false');
        } else {
            $data['username'] = $this->PM->username($username, $companyses);
            foreach ($data['username'] as $key) {
                $com = $key->company;
            }

            if ($com == 'jam') {
                $T = 'JAM';
            }
            if ($com == 'jmt') {
                $T = 'JMTLOAN_PROD';
            }


            $data['op'] = $this->PM->operator($T);
            $data['username_menu'] = $this->PM->username_menu($T, $username);
            $data['company'] = $this->PM->company($com);


            $data['Main_Homepayment'] = "Outstanding_Report_detail_index";
            $this->load->view('Homepayment', $data);
        }
    }

    public function OutstandingReportdetailview()
    {
        $username = $this->session->userdata('username');
        $companyses = $this->session->userdata('company');
        $data['username'] = $this->PM->username($username, $companyses);
        foreach ($data['username'] as $key) {
            $com = $key->company;
        }

        if ($com == 'jam') {
            $T = 'JAM';
        }
        if ($com == 'jmt') {
            $T = 'JMTLOAN_PROD';
        }

        $data['op'] = $this->PM->operator($T);
        $data['username_menu'] = $this->PM->username_menu($T, $username);
        $data['company'] = $this->PM->company($com);

        $page = $this->input->post('page');

        if ($page != '') {
            $page = $page;
        } else {
            $page = 1;
        }

        $pageend1 = 100;

        $start = ($page - 1) * $pageend1;
        $pageend = $page * 100;

        $data['pageend'] = $pageend1;
        $data['pagenum'] = $page;

        $Operator = $this->input->post('Operator');
        $lot = $this->input->post('lot');
        $date = date('Y/m/d', strtotime($this->input->post('datedetail')));

        if ($Operator == '') {
            $Operator = "";
            $Type = "Many";
        } else {
            $Operator;
            $Type = "One";
        }

        if ($lot == '') {
            $lot = "";
        } else {
            $lot;
        }

        $data['report'] = $this->PM->Outstanding_Detail($com, $lot, $Operator, $Type, $date, $start, $pageend);
        $data['search_count'] = $this->PM->Count_Outstanding_Detail($com, $lot, $Operator, $Type, $date);


        // echo "EXEC [dbo].[SP_REPORT_PAYMENT_SYSTEM_TEST] 'Outstanding','$com','$lot','$Operator','$Type','$date',NULL,NULL,$start,$pageend";

        $data['Operator'] = $Operator;
        $data['date'] = date('m/Y', strtotime($date));

        $this->load->view('Outstanding_Report_detail_view', $data);
    }

    public function model6()
    {
        $username = $this->session->userdata('username');
        $companyses = $this->session->userdata('company');

        $data['username'] = $this->PM->username($username, $companyses);
        foreach ($data['username'] as $key) {
            $com = $key->company;
        }

        if ($com == 'jam') {
            $T = 'JAM';
        }
        if ($com == 'jmt') {
            $T = 'JMTLOAN_PROD';
        }

        $data['op'] = $this->PM->operator($T);
        $data['username_menu'] = $this->PM->username_menu($T, $username);
        $data['company'] = $this->PM->company($com);

        $data['Main_Homepayment'] = "Outstanding_Report_index";
        $this->load->view('Homepayment', $data);
    }

    public function OutstandingReportview()
    {

        $username = $this->session->userdata('username');
        $companyses = $this->session->userdata('company');
        $data['username'] = $this->PM->username($username, $companyses);
        foreach ($data['username'] as $key) {
            $com = $key->company;
        }

        if ($com == 'jam') {
            $T = 'JAM';
        }
        if ($com == 'jmt') {
            $T = 'JMTLOAN_PROD';
        }

        $Operator = $this->input->post('Operator');
        $lot = $this->input->post('lot');
        $date = date('Y/m/d', strtotime($this->input->post('date')));

        if ($Operator == '') {
            $Operator = "";
            $Type = "Many";
        } else {
            $Operator;
            $Type = "One";
        }

        if ($lot == '') {
            $lot = "";
        } else {
            $lot;
        }

        $data['report'] = $this->PM->Outstanding_SumOutstanding($com,  $lot, $Operator, $Type, $date);


        $data['username_menu'] = $this->PM->username_menu($T, $username);
        $data['company'] = $this->PM->company($com);
        $data['Operator'] = $Operator;
        $data['date'] = date('m/Y', strtotime($date));

        $this->load->view('Outstanding_Report_view', $data);
    }

    public function model7()
    {
        $username = $this->session->userdata('username');
        $companyses = $this->session->userdata('company');
        $data['username'] = $this->PM->username($username, $companyses);

        foreach ($data['username'] as $key) {
            $com = $key->company;
        }

        if ($com == 'jam') {
            $T = 'JAM';
        }
        if ($com == 'jmt') {
            $T = 'JMTLOAN_PROD';
        }

        $data['op'] = $this->PM->operator($T);
        $data['username_menu'] = $this->PM->username_menu($T, $username);
        $data['company'] = $this->PM->company($com);

        $data['Main_Homepayment'] = "Export_Excelt_index";
        $this->load->view('Homepayment', $data);
    }

    public function Export_Excelt_view()
    {

        $username = $this->session->userdata('username');
        $companyses = $this->session->userdata('company');
        $data['username'] = $this->PM->username($username, $companyses);

        foreach ($data['username'] as $key) {
            $com = $key->company;
        }

        if ($com == 'jam') {
            $T = 'JAM';
        }
        if ($com == 'jmt') {
            $T = 'JMTLOAN_PROD';
        }


        $Operator = $this->input->post('Operator');
        $lot = $this->input->post('lot');
        $datestart = date('Y/m/d', strtotime($this->input->post('datestart')));
        $dateend = date('Y/m/d', strtotime($this->input->post('dateend')));

        if ($Operator == '') {
            $Operator = "";
            $Type = "Many";
        } else {
            $Operator;
            $Type = "One";
        }

        if ($lot == '') {
            $lot = "";
        } else {
            $lot;
        }

        $data['report'] = $this->PM->Export_Excelt($com, $lot, $Operator, $Type, $datestart, $dateend);

        $data['username_menu'] = $this->PM->username_menu($T, $username);
        $data['company'] = $this->PM->company($com);
        $data['Operator'] = $Operator;

        $this->load->view('Export_Excelt_view', $data);
    }

    public function model8()
    {

        $username = $this->session->userdata('username');
        $companyses = $this->session->userdata('company');
        $data['username'] = $this->PM->username($username, $companyses);

        foreach ($data['username'] as $key) {
            $com = $key->company;
        }

        if ($com == 'jam') {
            $T = 'JAM';
        }
        if ($com == 'jmt') {
            $T = 'JMTLOAN_PROD';
        }

        $data['op'] = $this->PM->operator($T);
        $data['username_menu'] = $this->PM->username_menu($T, $username);
        $data['company'] = $this->PM->company($com);

        $data['Main_Homepayment'] = "Daily_updated_index";
        $this->load->view('Homepayment', $data);
    }


    public function Daily_updated_view()
    {

        $username = $this->session->userdata('username');
        $companyses = $this->session->userdata('company');
        $data['username'] = $this->PM->username($username, $companyses);

        foreach ($data['username'] as $key) {
            $com = $key->company;
        }
        if ($com == 'jam') {
            $T = 'JAM';
        }
        if ($com == 'jmt') {
            $T = 'JMTLOAN_PROD';
        }
        $data['username_menu'] = $this->PM->username_menu($T, $username);


        $status = $this->input->post('status');
        $Operator = $this->input->post('Operator');
        $datestart = date('Y-m-d', strtotime($this->input->post('datestart')));
        $dateend = date('Y-m-d', strtotime($this->input->post('dateend')));

        if ($Operator == '') {
            $Operator = "";
            $Type = "Many";
        } else {
            $Operator;
            $Type = "One";
        }

        $data['report'] = $this->PM->Daily_updated('EditDaily', $com, $Operator, $Type, $datestart, $dateend, $status);


        //  echo "<br>". "EXEC [dbo].[SP_REPORT_PAYMENT_SYSTEM] 'EditDaily','$com',NULL,'$Operator','$Type','$datestart','$dateend','$status',0,0";

 
        $data['company'] = $this->PM->company($com);
        $data['Operator'] = $Operator;
        $data['status'] = $status;
        $data['datestart'] = date('d/m/Y', strtotime($datestart));
        $data['dateend'] = date('d/m/Y', strtotime($dateend));

        $this->load->view('Daily_updated_view', $data);
    }



    public function model9()
    {

        $username = $this->session->userdata('username');
        $companyses = $this->session->userdata('company');
        $data['username'] = $this->PM->username($username, $companyses);

        foreach ($data['username'] as $key) {
            $com = $key->company;
        }

        if ($com == 'jam') {
            $T = 'JAM';
        }
        if ($com == 'jmt') {
            $T = 'JMTLOAN_PROD';
        }


        $data['op'] = $this->PM->operator($T);
        $data['username_menu'] = $this->PM->username_menu($T, $username);
        $data['search'] = $this->eir->port();
        $data['company'] = $this->eir->company($com);

        $start = 0;
        $pageend = 20;
        $data['numpage'] = 1;
        $data['pageend'] = $pageend;
        //$search = "and convert(nvarchar(7),IR.MONTH_YEAR) = convert(nvarchar(7),convert(date,GETDATE()))";
        //        
        // $data['result'] = $this->eir->all_eir($start, $pageend, $search);


        $data['Main_Homepayment'] = "Sammary_ProductMonth";
        $this->load->view('Homepayment', $data);
    }


    public function RunInvoiceReport()
    {

        $username = $this->session->userdata('username');
        $companyses = $this->session->userdata('company');

        if ($username == "") {
            $this->load->view('false');
        } else {
            $data['username'] = $this->PM->username($username, $companyses);
            foreach ($data['username'] as $key) {
                $com = $key->company;
            }

            if ($com == 'jam') {
                $T = 'JAM';
            }
            if ($com == 'jmt') {
                $T = 'JMTLOAN_PROD';
            }

            $data['op'] = $this->PM->operator($T);
            $data['username_menu'] = $this->PM->username_menu($T, $username);
            $data['company'] = $this->PM->company($com);


            $data['Main_Homepayment'] = "Run_Invoice_index";
            $this->load->view('Homepayment', $data);
        }
    }


    public function Taxinvoice()
    {

        $username = $this->session->userdata('username');
        $companyses = $this->session->userdata('company');
        $data['username'] = $this->PM->username($username, $companyses);

        foreach ($data['username'] as $key) {
            $com = $key->company;
        }

        if ($com == 'jam') {
            $T = 'JAM';
        }
        if ($com == 'jmt') {
            $T = 'JMTLOAN_PROD';
        }

        $Operator = $this->input->post('Operatortaxinvoice');
        $lot = $this->input->post('lottaxinvoice');
        $datestart = date('Y-m-d', strtotime($this->input->post('datestarttaxinvoice')));
        $dateend = date('Y-m-d', strtotime($this->input->post('dateendtaxinvoice')));

        if ($lot == '') {
            $lot = "";
        } else {
            $lot;
        }

        $data['report'] = $this->PM->EXPORT_TAX_INVOICE('TAX_INVOICE', $lot, $Operator, $datestart, $dateend, $T);

        // echo"EXEC [dbo].[SP_REPORT_TAX_INVOICE] 'TAX_INVOICE','$lot','$Operator','$datestart','$dateend','$T'";


        $data['username_menu'] = $this->PM->username_menu($T, $username);

        $data['company'] = $this->PM->company($com);

        $this->load->view('Table_Report_Taxinvoice', $data);
    }


    public function Report_invoice()
    {

        $username = $this->session->userdata('username');
        $companyses = $this->session->userdata('company');
        $data['username'] = $this->PM->username($username, $companyses);

        foreach ($data['username'] as $key) {
            $com = $key->company;
        }

        if ($com == 'jam') {
            $T = 'JAM';
        }
        if ($com == 'jmt') {
            $T = 'JMTLOAN_PROD';
        }

        $Operator = $this->input->post('Operatorinvoice');
        $lot = $this->input->post('lotinvoice');
        $datestart = date('Y-m-d', strtotime($this->input->post('datestartinvoice')));
        $dateend = date('Y-m-d', strtotime($this->input->post('dateendinvoice')));


        if ($lot == '') {
            $lot = "";
        } else {
            $lot;
        }

        $data['report'] = $this->PM->EXPORT_TAX_INVOICE('INVOICE', $lot, $Operator, $datestart, $dateend, $T);
        // echo "EXEC [dbo].[SP_REPORT_TAX_INVOICE] 'INVOICE','$lot','$Operator','$datestart','$dateend','$T'";

        foreach ($data['report']  as $AA) {
            echo "<br>" .    $AA->number;
        }


        $data['username_menu'] = $this->PM->username_menu($T, $username);
        $data['company'] = $this->PM->company($com);

        // $this->load->view('Table_Report_invoice', $data);
    }


    // public function logout()
    // {

    //     $Username = $this->session->unset_userdata('Username');
    //     $Password = $this->session->unset_userdata('Password');
    //     $Subject_Right = $this->session->unset_userdata('Subject_Right');

    //     $this->load->view('login');

    //     // redirect(site_url('Payment_controller/index'));
    // }

    public function logout()
    {
        $this->session->unset_userdata('username');
        $this->load->view('login');
    }
}
