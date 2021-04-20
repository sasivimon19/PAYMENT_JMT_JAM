<?php
date_default_timezone_set("Asia/Bangkok"); //header("content-type: text/html; charset=tis-620");
defined('BASEPATH') or exit('No direct script access allowed');

class Call_Newport extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Import_model');
        $this->load->model('Newport_data');
        $this->load->model('Payment_model', 'PM');
        $this->load->helper('url', 'form', 'html', 'file');
        $this->load->library(array('session', 'form_validation', 'upload'));
        $this->load->database();
        $this->load->library('excel');
        ini_set('memory_limit', '-1');
    }

    //----------------------------------------------------------------------------------------------------------------//

    public function index()
    {
        if ($this->session->userdata('IDEmp') == '') {
            redirect('Call_Login/');
        } else {
            $this->load->view('inc_page/header');
            $this->load->view('importdata');
        }
    }

    public function Newport()
    {

        $username = $this->session->userdata('username');
        $companyses = $this->session->userdata('company');
        $data['Subject_Right'] = $this->session->userdata('Subject_Right');

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


        $data['select_logapprae'] = $this->Newport_data->select_logapprae($T,$username);
        $data['ShowApprae'] = $this->Newport_data->select_Apprae($T);

        $data['Main_Homepayment'] = "EIR_Jmt_Finish/NewPortdata";
        $this->load->view('Homepayment', $data);
    }
}
    //------------------------------------import Excel ---------------------------------//

    public function check_ImportExcel_Newport()
    {
        $username = $this->session->userdata('username');
        $data['Subject_Right'] = $this->session->userdata('Subject_Right');
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

        $data['TypePort'] = $this->Newport_data->select_data_TypePort();
        $resultCost = $this->Newport_data->select_data_Cost();
        $resultCost = $resultCost[0]->Cost;
        $Cost =  $resultCost / 100;

        $this->load->library('excel');
        if (isset($_FILES["FileNewport"]["name"])) {

            $path = $_FILES["FileNewport"]["tmp_name"];
            $object = PHPExcel_IOFactory::load($path);

            $StatusPort = "0";
            $this->Newport_data->Delete_newport($username, $StatusPort); //ลบข้อมูลเวลา portrepeat port ซ้ำ
            $data['getport'] = trim($this->input->get('getport'));

            $column = $object->getActiveSheet()->getHighestDataColumn();
            $colNumber = PHPExcel_Cell::columnIndexFromString($column);

            if ($colNumber != 4) {

                $this->session->set_flashdata('Check_Column', TRUE);
                $datanewport['Port'] = '';
            } else {

                foreach ($object->getWorksheetIterator() as $worksheet) {

                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();

                    unset($_SESSION['Check_Column']);

                    for ($row = 2; $row <= $highestRow; $row++) {
                        $datanewport = array(
                            'Port' => $worksheet->getCellByColumnAndRow(0, $row)->getValue(),
                            'Mob' => $worksheet->getCellByColumnAndRow(1, $row)->getValue(),
                            'MONTH_YEAR' => date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($worksheet->getCellByColumnAndRow(2, $row)->getValue())),
                            'CashFlow' => $worksheet->getCellByColumnAndRow(3, $row)->getValue(),

                        );
                        //คำนวน $NetCost = ((1 - 0.032) * $datanewport['CashFlow']);
                        $NetCost = ((1 - $Cost) * $datanewport['CashFlow']);

                        $this->Newport_data->insert_data_newport($T,$datanewport, $username, $NetCost);
                    }
                }
            }

            $data['sum_newport'] = $this->Newport_data->select_sum_newport($datanewport['Port']);
            $data['select_TypePort'] = $this->Newport_data->select_data_TypePort();

            if ($data['getport'] == "") {
                $StatusPort = "0";
                $data['checknewport'] = $this->Newport_data->check_newport($datanewport['Port'], $StatusPort);
            } else {
                $StatusPort = "Request";
                $data['checknewport'] = $this->Newport_data->check_newport($datanewport['Port'], $StatusPort);
            }

            $data['selectlogapprae'] = $this->Newport_data->Get_LogApprae($datanewport['Port']);

            $this->load->view('Eir_Jmt_Finish/Table_Newport', $data);
        } else {

            $data['Subject_Right'] = $this->session->userdata('Subject_Right');
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

            $data['getport'] = trim($this->input->get('getport'));
            $data['Logapprae'] = trim($this->input->get('Logapprae'));

            if ($data['getport'] == "") {
                $data['checknewport'] = $this->Newport_data->check_newportAll($data['getport'], $username);
            }
            // if ($data['getport'] == "") {
            //     $StatusPort = "0";
            //     $data['checknewport'] = $this->Newport_data->check_newportAll($data['getport']);
            // } 
            // $StatusPort = "Request";
            // $StatusPort = 'Approve';
            // $data['checknewport'] = $this->Newport_data->check_newportAll($data['getport'], $username);
            $data['select_logapprae'] = $this->Newport_data->select_logappraeclick($username, $data['Logapprae']);
            $data['sum_newport'] = $this->Newport_data->select_sum_newport($data['getport']);
            $data['select_TypePort'] = $this->Newport_data->select_data_TypePort();
            $data['selectlogapprae'] = $this->Newport_data->Get_LogAppraeclick($data['getport'], $data['Logapprae']);

            $data['Main_Homepayment'] = "EIR_Jmt_Finish/FromApprovePortdata";
            $this->load->view('Homepayment', $data);
        }
    }

    }

    //insent ขออนุมัติ
    public function Insert_Log_Apprae()
    {

        $username = $this->session->userdata('username');
        $companyses = $this->session->userdata('company');
        $data['Subject_Right'] = $this->session->userdata('Subject_Right');

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

        $data['getport'] = trim($this->input->get('getport'));

        // import เข้าระบบมาจะเป็นสถานะ 0 เมื่อ กดขออนุมัติถึงจะเป็นสถานะ Request
        if ($data['getport'] == "") {
            $StatusPort = "0";
            $result = $this->Newport_data->select_data_newport($username, $StatusPort);
            $port = $result[0]->Port;
        }

        $Checkport = $this->Newport_data->CountTmp_logapprae($port);
        $Checknumport = $Checkport[0]->Portapprae;

        $data['selectlogapprae'] = $this->Newport_data->Get_LogApprae($port);

        if ($Checknumport > 0) {

            $this->session->set_flashdata('Check_log', TRUE);
            $StatusPort = "0";
            $this->Newport_data->Delete_newport($username, $StatusPort); //ลบข้อมูลเวลา portrepeat port ซ้ำ

        } else {
            $Logapprae_get = array(
                'NEWPORT' => trim($this->input->post('NEWPORT')),
                'Mob' => trim($this->input->post('MOB')),
                'DateStart' => trim($this->input->post('datepicker')),
                'COST' =>  str_replace(',', '', trim($this->input->post('COST'))),
                'TypePort' => trim($this->input->post('TypePort')),
                // 'nol' =>  trim($this->input->post('NOT')),
                'Bcost' => str_replace(',', '', trim($this->input->post('Bcost'))),
                'OriginOS' => str_replace(',', '', trim($this->input->post('OriginOS'))),
                'EIR' => str_replace(',', '', trim($this->input->post('EIR'))),
                'NumAcct' => trim($this->input->post('NUMACC')),
                'Company' => trim($this->input->post('company')),
            );

            $this->Newport_data->Insert_LogApprae($Logapprae_get, $username); //insert ลงตาราง logLogApprae
            $StatusPort = "Request";
            $this->Newport_data->Update_Tmp_CashFlowUn($Logapprae_get['NEWPORT'], $username, $StatusPort); // update การขออนุมัติจาก 0 เป็น Request
        }

        $StatusPort = '0';
        $data['checknewport'] = $this->Newport_data->check_newport($port, $StatusPort);
        $data['select_logapprae'] = $this->Newport_data->select_logapprae($port);
        $data['sum_newport'] = $this->Newport_data->select_sum_newport($port);
        $data['select_TypePort'] = $this->Newport_data->select_data_TypePort();

        $this->load->view('Eir_Jmt_Finish/Table_Newport', $data);
    }
    }

    // insert ข้อมูลลงฐานจริง
    public function Insert_Newport_True()
    {

        $username = $this->session->userdata('username');
        $data['Subject_Right'] = $this->session->userdata('Subject_Right');
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

        $data['getport'] = trim($this->input->get('getport'));
        $data['getportS'] = trim($this->input->post('getportS'));
        $data['Logapprae'] = trim($this->input->post('Logapprae'));


        $StatusPort = "Request";
        $result = $this->Newport_data->select_data_newpor_getport($StatusPort, $data['getportS']);
        // $port = $result[0]->Port;

        if (COUNT($result) == 0) {

            $port = '';
        } else {

            $Checkport = $this->Newport_data->CountTrue_newport($data['getportS']);  //count ตาราง CashFlow
            $Checknumport = $Checkport[0]->Countport;

            $Check_port_tbIRR = $this->Newport_data->CountTrue_newport_tbIRR($data['getportS']); //count ตาราง tbIRR
            $CheckporttbIRR = $Check_port_tbIRR[0]->Countport_tbIRR_2;

            $Check_port_tbporun = $this->Newport_data->CountTrue_newport_tbl_PortUn($data['getportS']); //count ตาราง tbl_PortUn
            $Checkporttbporun = $Check_port_tbporun[0]->Countport_tbporun;

            //ตรวจสอบค่าซ้ำของตาราง CashFlow
            if ($Checknumport > 0) {
                $this->session->set_flashdata('Check_numport', TRUE);
            } else {

                if ($CheckporttbIRR > 0 || $Checkporttbporun > 0) {

                    $this->session->set_flashdata('Countport_tbIRR_2', TRUE);
                } else {
                    foreach ($result as $item) {
                        $selectnewport = array(
                            'Port' => trim(iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $item->Port)),
                            'Mob' =>  iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $item->Mob),
                            'MONTH_YEAR' => $item->MONTH_YEAR,
                            'CashFlow' => $item->NetCost,
                            'CashFlowIFRS' => $item->NetCost,
                        );
                        $this->Newport_data->insertnewporttrue($selectnewport);
                        $this->Newport_data->insert_newport_true_tbIRR_2($selectnewport);
                    } //end loop 


                    $Postun_get = array(
                        'NEWPORT' => trim($this->input->post('NEWPORT')),
                        'DateStart' => trim($this->input->post('datepicker')),
                        'TypePort' => trim($this->input->post('TypePort')),
                        // 'nol' =>  trim($this->input->post('NOT')),
                        'Bcost' => str_replace(',', '', trim($this->input->post('Bcost'))),
                        'OriginOS' => str_replace(',', '', trim($this->input->post('OriginOS'))),
                        'EIR' => str_replace(',', '', trim($this->input->post('EIR'))),
                        'NumAcct' => trim($this->input->post('NUMACC')),
                        'Company' => trim($this->input->post('company')),
                    );

                    $checknol = $this->Newport_data->Select_maxnol($Postun_get['TypePort']);
                    foreach ($checknol as $item) {
                        $MAXNOT = $item->MAXNOT;
                    }
                    // if ($MAXNOT  != '') {
                    echo $nol =  $MAXNOT + 1;
                    // } else {
                    //     echo "";
                    // }

                    $this->Newport_data->insert_Postun_get($Postun_get, $nol);
                    $remark = '';
                    $StatusPort = "Approve";
                    // $this->Newport_data->Update_LogApprae_true($StatusPort, $username, $data['Logapprae'], $Postun_get['NEWPORT']);
                    $this->Newport_data->Update_LogApprae($StatusPort, $username, $data['Logapprae'], $Postun_get['NEWPORT'], $remark);
                    $this->Newport_data->UpdateTmpCashFlowUnApp($StatusPort, $Postun_get['NEWPORT'], $username); 
                }
            }
        }

        $StatusPort = 'Approve';
        // $data['checknewport'] = $this->Newport_data->check_newport($data['getport'], $StatusPort);
        $data['checknewport'] = $this->Newport_data->check_newport($data['getport']);
        $data['sum_newport'] = $this->Newport_data->select_sum_newport($data['getport']);
        $data['select_TypePort'] = $this->Newport_data->select_data_TypePort();


        $this->load->view('Eir_Jmt_Finish/Table_Newport', $data);
    }
    }

    // ฟังชั่น import มือ แบบคีย์ // ปิดไว้ก่อนเผื่อกลับมาใช้ใหม่
    // public function InsertNewport_Add()
    // {

    //     $username = $this->session->userdata('username');
    //     $companyses = $this->session->userdata('company');


    //     $this->Newport_data->Delete_newport($username);

    //     $port = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $this->input->post('port_search'));
    //     $Mod = $this->input->post('MOD');
    //     $MONTH_YEAR = date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('datepicker'))));

    //     $Checkport = $this->Newport_data->CountTrue_newport($port);
    //     $Checknumport = $Checkport[0]->Countport;



    //     if ($Checknumport > 0) {
    //         $this->session->set_flashdata('Check_numport', TRUE);
    //     } else {
    //         $sMount = substr($MONTH_YEAR, 0, 7);
    //         $amount = $Mod;
    //         for ($i = 0; $i < $amount; $i++) {
    //             $date = new DateTime($sMount);
    //             $interval = new DateInterval('P' . ($i) . 'M');

    //             $date->add($interval);
    //             $m = $date->format('Y-m-t');
    //             // echo ($i + 1) . " : " . $port . " ->" . $m . "<br>";

    //             $arr['Port'] = $port;
    //             $arr['MONTH'] = $m;
    //             $arr['MOB'] = $i + 1;

    //             $this->Newport_data->insert_newport_Add($arr, $username);
    //         }
    //     }
    //     $StatusPort = '0';
    //     $data['checknewport'] = $this->Newport_data->check_newport($port, $StatusPort);

    //     $this->load->view('Eir_Jmt_Finish/Table_Newport', $data);
    // }



    public function SearchTypeport()
    {

        $username = $this->session->userdata('username');
        $companyses = $this->session->userdata('company');
        $data['Subject_Right'] = $this->session->userdata('Subject_Right');
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
        $data['username_menu'] = $this->PM->username_menu($T,$username);

        $TypePort = $this->input->post('TypePort');

        if ($TypePort != '') {
            $checknol = $this->Newport_data->Select_maxnol($TypePort);
            foreach ($checknol as $item) {
                $MAXNOT = $item->MAXNOT;
            }
            echo $MAXNOT + 1;
        } else {
            echo "";
        }
    }

    }
    // Reject Port
    public function RejectPort()
    {

        $username = $this->session->userdata('username');
        $companyses = $this->session->userdata('company');
        $data['Subject_Right'] = $this->session->userdata('Subject_Right');
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

        $data['getport'] = trim($this->input->post('getportS'));
        $data['Logapprae'] = trim($this->input->post('Logapprae'));
        $data['remark'] = trim(iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $this->input->post('remark'))); // หมายเหตุของการไม่อนุมัติ port

        $StatusPort = "Reject";
        $this->Newport_data->Update_LogApprae($StatusPort, $username, $data['Logapprae'], $data['getport'], $data['remark']);
        $this->Newport_data->UpdateTmpCashFlowUnApp($data['getport'], $username, $StatusPort);
    }
    }
    //Delete เมื่อ Reject 
    public function DeleteReject()
    {

        $username = $this->session->userdata('username');
        $companyses = $this->session->userdata('company');
        $data['Subject_Right'] = $this->session->userdata('Subject_Right');
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

        $data['getport'] = trim($this->input->post('getportS'));
        $data['Logapprae'] = trim($this->input->post('Logapprae'));


        $this->Newport_data->Delete_logapprae($data['Logapprae'], $data['getport'], $username);
        $this->Newport_data->Delete_Tmp_CashFlowUn($data['getport'], $username);

        $data['select_logapprae'] = $this->Newport_data->select_logapprae($username);
    }

    }

    public function Calculate_EIR()
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
        }
        if ($com == 'jmt') {
            $T = 'JMTLOAN_PROD';
        }
        $data['username_menu'] = $this->PM->username_menu($T, $username);

        $Port = $this->input->post('Port');
        $Bcost = str_replace(',', '', $this->input->post('Bcost'));


        if ($Bcost != '') {
            $checknol = $this->Newport_data->Cal_Eir($Port, $Bcost);
            foreach ($checknol as $item) {
                $Cal_IRR = $item->Cal_IRR;
            }

            echo number_format($Cal_IRR / 100, 06);

        } else {
            echo "";
        }
    }
}
}