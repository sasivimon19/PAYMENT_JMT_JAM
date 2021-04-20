<?php
date_default_timezone_set("Asia/Bangkok"); //header("content-type: text/html; charset=tis-620");
defined('BASEPATH') or exit('No direct script access allowed');

class Call_Import extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Import_model');
        $this->load->model('EditData_model');
        $this->load->model('Payment_model', 'PM');
        $this->load->helper('url', 'form', 'html');
        $this->load->library('session', 'upload');
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

    public function Main()
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

            $data['username_menu'] = $this->PM->username_menu($T,$username);


            $data['Main_Homepayment'] = "EIR_Jmt_Finish/importdata";
            $this->load->view('Homepayment', $data);
        }
    }
    //----------------------------------------------------------------------------------------------------------------//

    public function check_import_data()
    {
        $this->load->library('PHPExcel');
       echo $username = $this->session->userdata('username');
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
            
            $this->Import_model->clear_data($T, $username);

            $path = $_FILES["file"]["tmp_name"];
            $object = PHPExcel_IOFactory::load($path);
            $i = 0;
            $j = 0;
            $P = array();
            $error_port = false;
            $column = $object->getActiveSheet()->getHighestDataColumn();
            $rowdata = $object->getActiveSheet()->getHighestDataRow();
            $colNumber = PHPExcel_Cell::columnIndexFromString($column);
            if ($colNumber != 11) {
                $data[] = array("error_status" => true, "error_msg" => "จำนวน Column ไม่ถูกต้อง", "error_type" => "column");
                echo json_encode($data);
            } else {
                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $p = trim($worksheet->getCellByColumnAndRow(1, $row)->getValue());
                        array_push($P, $p);
                    }
                }
                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();

                    for ($row = 2; $row <= $highestRow; $row++) {
                        $error = false;
                        $list_error[$i] = "";

                        //////////////////////////////////////////////////////////////////////////////////

                        $PortNameAccounting = str_replace(',', '', trim($worksheet->getCellByColumnAndRow(0, $row)->getValue()));
                        // if ($PortNameAccounting == "") {
                        //     $error = true;
                        //     $list_error[$i] = $list_error[$i] . " PortNameAccounting เป็นค่าว่าง ";
                        // }
                        //  else if (is_numeric($PortNameAccounting) == false) {
                        //     $error = true;
                        //     $list_error[$i] = $list_error[$i] . " PortNameAccounting ไม่เป็นตัวเลข ";
                        // }
                        /////////////////////////////////////////////////////////////////////////////////////

                        $port = trim($worksheet->getCellByColumnAndRow(1, $row)->getValue());
                        // if (array_count_values($P)[$port] > 1) {
                        //     $error_port = true;
                        //     $list_error[$i] = $list_error[$i] . " Portซ้ำ ";
                        // }
                        // if (array_count_values($P)[$port] > 1) {
                        //     $com = $this->Import_model->check_port_sum();

                        //     if ($com[0]->sumcash == 0) {
                        //         $error = true;
                        //         $list_error[$i] = $list_error[$i] . "sum port";
                        //     }
                        // }

                        if ($port == "") {
                            $error = true;
                            $list_error[$i] = $list_error[$i] . "Portเป็นค่าว่าง";
                        } else {
                            $com = $this->Import_model->check_port($T, $port);
                            if ($com[0]->count_port == 0) {
                                $error = true;
                                $list_error[$i] = $list_error[$i] . "ไม่มีPortในระบบ";
                            }
                        }
                        ///////////////////////////////////////////////////////////////////////////////////
                        $Mont_Year = str_replace(',', '', trim($worksheet->getCellByColumnAndRow(2, $row)->getValue()));
                        // if ($Mont_Year == "") {
                        //     $error = true;
                        //     $list_error[$i] = $list_error[$i] . "Mont_Year เป็นค่าว่าง ";
                        //     // }
                        // } else if (is_numeric($Mont_Year) == false) {
                        //     $error = true;
                        //     $list_error[$i] = $list_error[$i] . "Mont_Year ไม่เป็นตัวเลข ";
                        // }

                        /////////////////////////////////////////////////////////////////////////////////////
                        $revoke = trim($worksheet->getCellByColumnAndRow(3, $row)->getValue());
                        // if ($revoke == "") {
                        //     $error = true;
                        //     $list_error[$i] = $list_error[$i] . "Revoke เป็นค่าว่าง";
                        // } else if (is_numeric($revoke) == false) {
                        //     $error = true;
                        //     $list_error[$i] = $list_error[$i] . "Revoke ไม่เป็นตัวเลข";
                        // }
                        /////////////////////////////////////////////////////////////////////////////////////
                        $courtFee = trim($worksheet->getCellByColumnAndRow(4, $row)->getValue());
                        // if ($courtFee == "") {
                        //     $error = true;
                        //     $list_error[$i] = $list_error[$i] . "CourtFeeเป็นค่าว่าง ";
                        // } else if (is_numeric($courtFee) == false) {
                        //     $error = true;
                        //     $list_error[$i] = $list_error[$i] . "CourtFeeไม่เป็นตัวเลข ";
                        // }
                        /////////////////////////////////////////////////////////////////////////////////////
                        $transferFee = trim($worksheet->getCellByColumnAndRow(5, $row)->getValue());
                        // if ($transferFee == "") {
                        //     $error = true;
                        //     $list_error[$i] = $list_error[$i] . "TransferFeeเป็นค่าว่าง ";
                        // } else if (is_numeric($transferFee) == false) {
                        //     $error = true;
                        //     $list_error[$i] = $list_error[$i] . "TransferFeeไม่เป็นตัวเลข ";
                        // }
                        /////////////////////////////////////////////////////////////////////////////////////

                        ///////////////////////////////////////////////////////////////////////////////////
                        $cash = str_replace(',', '', trim($worksheet->getCellByColumnAndRow(6, $row)->getValue()));
                        if ($cash == "") {
                            $error = true;
                            $list_error[$i] = $list_error[$i] . "Cashเป็นค่าว่าง ";
                        } else if (is_numeric($cash) == false) {
                            $error = true;
                            $list_error[$i] = $list_error[$i] . "Cashไม่เป็นตัวเลข ";
                        }

                        /////////////////////////////////////////////////////////////////////////////////////
                        $Adjust = trim($worksheet->getCellByColumnAndRow(7, $row)->getValue());
                        // if ($Adjust == "") {
                        //     $error = true;
                        //     $list_error[$i] = $list_error[$i] . "TransferFeeเป็นค่าว่าง";
                        // } else if (is_numeric($Adjust) == false) {
                        //     $error = true;
                        //     $list_error[$i] = $list_error[$i] . "TransferFeeไม่เป็นตัวเลข";
                        // }
                        /////////////////////////////////////////////////////////////////////////////////////
                        $Commission = trim($worksheet->getCellByColumnAndRow(8, $row)->getValue());
                        // if ($Commission == "") {
                        //     $error = true;
                        //     $list_error[$i] = $list_error[$i] . "Commissionเป็นค่าว่าง";
                        // } else if (is_numeric($Commission) == false) {
                        //     $error = true;
                        //     $list_error[$i] = $list_error[$i] . "Commissionไม่เป็นตัวเลข ";
                        // }

                        /////////////////////////////////////////////////////////////////////////////////////
                        $NetCashReceive = trim($worksheet->getCellByColumnAndRow(9, $row)->getValue());
                        // if ($NetCashReceive == "") {
                        //     $error = true;
                        //     $list_error[$i] = $list_error[$i] . "NetCashReceiveเป็นค่าว่าง ";
                        // } else if (is_numeric($NetCashReceive) == false) {
                        //     $error = true;
                        //     $list_error[$i] = $list_error[$i] . "NetCashReceiveไม่เป็นตัวเลข ";
                        // }
                        /////////////////////////////////////////////////////////////////////////////////////
                        $StatusPort = trim($worksheet->getCellByColumnAndRow(10, $row)->getValue());
                        // if ($StatusPort == "") {
                        //     $error = true;
                        //     $list_error[$i] = $list_error[$i] . "StatusPorteเป็นค่าว่าง ";
                        // }
                        // } else if (is_numeric($StatusPort) == false) {
                        //     $error = true;
                        //     $list_error[$i] = $list_error[$i] . "StatusPortไม่เป็นตัวเลข ";
                        // }



                        $num = $i + 1;
                        $this->Import_model->insert_data(
                            iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $num),
                            iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $PortNameAccounting),
                            iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $port),
                            iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $Mont_Year),
                            iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $revoke),
                            iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $courtFee),
                            iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $transferFee),
                            iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $cash),
                            iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $Adjust),
                            iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $Commission),
                            iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $NetCashReceive),
                            iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $StatusPort),
                            iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $list_error[$i]),
                            iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $username),

                        );
                        $i++;
                    }
                }


                if ($error_port) {
                    $data[] = array("error_port" => true, "error_msg" => "มีพอร์ตซ้ำกัน");
                    echo json_encode($data);
                } else {
                    $data[] = array("error_status" => false);
                    echo json_encode($data);
                }
            }
        }
    }
    //----------------------------------------------------------------------------------------------------------------//

    public function select_data()
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



            $result = $this->Import_model->select_data($username);
            $error = $this->Import_model->select_data_false($username);
            $resultArr = array();

            foreach ($result as $r) {

                $resultArr[] = array(
                    "Number" => $r->Number,
                    "Port" => trim(iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->Port)),
                    "Cash" => iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->CashReceive),
                    "RevokeCustomer" => iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->RevokeCustomer),
                    "CourtFee" => iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->CourtFee),
                    "TransferFee" => iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->TransferFee),
                    "Adjust" => iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->Adjust),
                    "Commission" => iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->Commission),
                    "NetCashReceive" => iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->NetCashReceive),
                    "StatusPort" => iconv('TIS-620//IGNORE', 'UTF-8//IGNORE',  $r->StatusPort),
                    "Error" => iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->Error)
                );
            }

            if (count($error) <= 0) {
                $data = array("result" => $resultArr, "error_status" => false);
                echo json_encode($data);
            } else {
                $data = array("result" => $resultArr, "error_status" => true);
                echo json_encode($data);
            }
        }
    }
    //----------------------------------------------------------------------------------------------------------------//

    public function clear_data()
    {
        // $name = $this->session->userdata("NameEmp");
        $idemp = $this->session->userdata("IDEmp");
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
        if ($username == "") {
            $this->load->view('false');
       
        } else {

            $this->Import_model->clear_data($T,$username);
        }
    }
    //----------------------------------------------------------------------------------------------------------------//


    public function insert_data()
    {
        $idemp = $this->session->userdata("IDEmp");
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

            $portChecked = array();
            $dataTrue = array();
            $date_start = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $this->input->post('date_start'));
            $date_end =  iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $this->input->post('date_end'));
            $isCheckedAll =  iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $this->input->post('isCheckedAll'));
            $onlyTrue =  iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $this->input->post('onlyTrue'));
            $isChecked =  iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $this->input->post('isChecked'));
            $portChecked =  $this->input->post('portChecked');
            $dataTrue =  $this->input->post('dataTrue');
            // $result = $this->Import_model->select_data($username);
            $result = $this->Import_model->selectdatatrue($username);
            $this->Import_model->delete_import_false($username);
            $i = 0;
            $error = false;
            $error_add = false;
            $hadUpdate = false;
            $noPort = false;

            foreach ($result as $r) {
                $port = trim(iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $r->Port));
                $cash_add = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $r->CashReceive);
                $date = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $r->Date_Import);
                $list_error[$i] = "";

                //////////////////////////////////////////////////////////////////////////////////

                $data = $this->Import_model->check_port_in_cashflow($port, $date);
                if ($data[0]->count_data == 0) {
                    $error = true;
                    $error_add = true;
                    $noPort = true;
                    $list_error[$i] = $list_error[$i] . " ไม่พบพอร์ต " . $port . " ที่ต้องการอัพเดตจำนวนเงิน ";
                }

                /////////////////////////////////////////////////////////////////////////////////////

                if (!$error_add) {
                    $recently = $this->Import_model->check_recently_updated($date_start, $date_end, $port, $date);
                    if ($recently) {
                        foreach ($recently as $r) {
                            $this->Import_model->insert_recently_updated($port, $date, $username, $r->Cash_After, $r->Date_Update);
                        }
                        $error = true;
                        $hadUpdate = true;
                    }
                }

                /////////////////////////////////////////////////////////////////////////////////////

                if ($error_add) {
                    $this->Import_model->import_data_false(
                        $port,
                        $cash_add,
                        $date,
                        iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $list_error[$i]),
                        // $list_error[$i],
                        $username
                    );
                    $error_add = false;
                }

                $i++;
            }

            if ($error && !$isCheckedAll && !$isChecked && !$onlyTrue) {
                if ($noPort) {
                    $resultErr = $this->Import_model->select_import_false($username);
                    $portArr = array();
                    foreach ($resultErr as $r) {
                        $portArr[] = array(
                            "Port" => trim(iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->Port)),
                            "Number" => $r->Number
                        );
                    }
                    $data = array("result" => $list_error, "port" => $portArr, "error_status" => true);
                }
                if ($hadUpdate && $noPort) {
                    $resultRecent = $this->Import_model->select_recently_updated($username);
                    $RecentArr = array();
                    foreach ($resultRecent as $r) {
                        $RecentArr[] = array(
                            "Port" => trim(iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->Port)),
                            "Recently_Cash" => iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $r->Recently_Cash),
                            "Recently_Updated" => iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $r->Recently_Updated)
                        );
                    }
                    $data['hasUpdated'] = true;
                    $data['recent'] = $RecentArr;
                } else {
                    $resultRecent = $this->Import_model->select_recently_updated($username);
                    $RecentArr = array();
                    foreach ($resultRecent as $r) {
                        $RecentArr[] = array(
                            "Port" => trim(iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->Port)),
                            "Recently_Cash" => iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $r->Recently_Cash),
                            "Recently_Updated" => iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $r->Recently_Updated)
                        );
                    }
                    $data['hasUpdated'] = true;
                    $data['recent'] = $RecentArr;
                }

                echo json_encode($data);
            } else if ($isCheckedAll) {
                foreach ($result as $r) {
                    $port = trim(iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $r->Port));
                    $cash = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $r->CashReceive);
                    $date = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $r->Date_Import);
                    $revoke = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $r->RevokeCustomer);
                    $courtFee = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $r->CourtFee);
                    $transferFee = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $r->TransferFee);
                    $Adjust = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $r->Adjust);
                    $Commission = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $r->Commission);
                    $NetCashReceive  = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $r->NetCashReceive);
                    $CashFlow = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $r->NetCashReceive);
                    $StatusPort =  $r->StatusPort;

                    $count_port_error = $this->Import_model->count_port_error($port, $date);

                    if ($count_port_error[0]->CP == 0) {
                        $before = $this->Import_model->select_cash($port, $date);
                        foreach ($before as $c) {
                            $cash_before = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $c->CashFlow);
                            $revoke_before = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $c->RevokeCustomer);
                            $courtFee_before = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $c->CourtFee);
                            $transferFee_before =  iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $c->TransferFee);
                        }

                        $this->Import_model->import_data_true($port, $cash, $date, $revoke, $courtFee, $transferFee, $Adjust, $Commission, $NetCashReceive, $StatusPort, $CashFlow);

                        $after = $this->Import_model->select_cash($port, $date);
                        foreach ($after as $c) {
                            $cash_after = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $c->CashFlow);
                            $revoke_after = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $c->RevokeCustomer);
                            $courtFee_after = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $c->CourtFee);
                            $transferFee_after =  iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $c->TransferFee);
                        }
                        $this->EditData_model->Log_Update(
                            $port,
                            $date,
                            $cash_before,
                            $cash_after,
                            $revoke_before,
                            $revoke_after,
                            $courtFee_before,
                            $courtFee_after,
                            $transferFee_before,
                            $transferFee_after,
                            $idemp,
                            $username,
                            'Import'
                        );
                    }
                    // $data = $this->Import_model->check_port_in_cashflow($port, $date);
                    // if($data[0]->count_data == 0){
                    //     $d = explode("-",$date);
                    //     if($d[0] == 2020){
                    //         $M = str_split($d[1]);
                    //         if($M[0] != '0'){
                    //         $mob = $d[1];
                    //         }else {
                    //             $mob = $M[1];
                    //         }
                    //     }else {
                    //         $M = str_split($d[1]);
                    //         if($M[0] != '0'){
                    //             $m = $d[1];
                    //         }else {
                    //             $m = $M[1];
                    //         }
                    //         $mob = (((int)$d[0] - 2020)*12 + (int)$m);
                    //     }
                    //     $this->Import_model->insert_data_true($port, $mob, $cash, $date, $revoke, $courtFee, $transferFee);
                    //     $this->EditData_model->Log_Update($port, $date, '0', $cash, $idemp, $name, 'ADD'); 


                }
                $data = array("error_status" => false);
                // $data = array("error_status" => $insert);
                echo json_encode($data);
            } else if ($isChecked) {
                foreach ($result as $r) {
                    $port = trim(iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $r->Port));
                    $cash = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $r->CashReceive);
                    $date = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $r->Date_Import);
                    $revoke = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $r->RevokeCustomer);
                    $courtFee = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $r->CourtFee);
                    $transferFee = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $r->TransferFee);
                    $Adjust = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $r->Adjust);
                    $Commission = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $r->Commission);
                    $NetCashReceive = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $r->NetCashReceive);
                    $CashFlow = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $r->NetCashReceive);
                    $StatusPort = $r->StatusPort;

                    $CP = array();
                    foreach ($portChecked as $pc) {
                        array_push($CP, trim(iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $pc)));
                    }
                    if (array_count_values($CP)[$port] != 0) {
                        // $data = $this->Import_model->check_port_in_cashflow($port, $date);
                        // if($data[0]->count_data == 0){
                        //     $d = explode("-",$date);
                        //     if($d[0] == 2020){
                        //         $M = str_split($d[1]);
                        //         if($M[0] != '0'){
                        //         $mob = $d[1];
                        //         }else {
                        //             $mob = $M[1];
                        //         }
                        //     }else {
                        //         $M = str_split($d[1]);
                        //         if($M[0] != '0'){
                        //             $m = $d[1];
                        //         }else {
                        //             $m = $M[1];
                        //         }
                        //         $mob = (((int)$d[0] - 2020)*12 + (int)$m);
                        //     }
                        //     $this->Import_model->insert_data_true($port, $mob, $cash, $date, $revoke, $courtFee, $transferFee);
                        //     $this->EditData_model->Log_Update($port, $date, '0', $cash, $idemp, $name, 'ADD'); 

                        $before = $this->Import_model->select_cash($port, $date);
                        foreach ($before as $c) {
                            $cash_before = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $c->CashFlow);
                            $revoke_before = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $c->RevokeCustomer);
                            $courtFee_before = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $c->CourtFee);
                            $transferFee_before =  iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $c->TransferFee);
                        }

                        // $this->Import_model->import_data_true($port, $cash, $date, $revoke, $courtFee, $transferFee);
                        $this->Import_model->import_data_true($port, $cash, $date, $revoke, $courtFee, $transferFee, $Adjust, $Commission, $NetCashReceive, $StatusPort, $CashFlow);

                        $after = $this->Import_model->select_cash($port, $date);
                        foreach ($after as $c) {
                            $cash_after = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $c->CashFlow);
                            $revoke_after = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $c->RevokeCustomer);
                            $courtFee_after = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $c->CourtFee);
                            $transferFee_after =  iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $c->TransferFee);
                        }
                        $this->EditData_model->Log_Update(
                            $port,
                            $date,
                            $cash_before,
                            $cash_after,
                            $revoke_before,
                            $revoke_after,
                            $courtFee_before,
                            $courtFee_after,
                            $transferFee_before,
                            $transferFee_after,
                            $idemp,
                            $username,
                            'Import'
                        );
                    }
                }
                $data = array("error_status" => false);
                echo json_encode($data);
            } else if ($onlyTrue) {
                foreach ($result as $r) {
                    $port = trim(iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $r->Port));
                    $cash = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $r->CashReceive);
                    $date = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $r->Date_Import);
                    $revoke = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $r->RevokeCustomer);
                    $courtFee = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $r->CourtFee);
                    $transferFee = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $r->TransferFee);
                    $Adjust = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $r->Adjust);
                    $Commission = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $r->Commission);
                    $NetCashReceive = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $r->NetCashReceive);
                    $CashFlow = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $r->NetCashReceive);
                    $StatusPort = $r->StatusPort;


                    $CP = array();
                    foreach ($dataTrue as $pc) {
                        array_push($CP, trim(iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $pc)));
                    }
                    if (array_count_values($CP)[$port] != 0) {
                        $before = $this->Import_model->select_cash($port, $date);
                        foreach ($before as $c) {
                            $cash_before = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $c->CashFlow);
                            $revoke_before = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $c->RevokeCustomer);
                            $courtFee_before = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $c->CourtFee);
                            $transferFee_before =  iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $c->TransferFee);
                        }

                        // $this->Import_model->import_data_true($port, $cash, $date, $revoke, $courtFee, $transferFee);
                        $this->Import_model->import_data_true($port, $cash, $date, $revoke, $courtFee, $transferFee, $Adjust, $Commission, $NetCashReceive, $StatusPort, $CashFlow);



                        $after = $this->Import_model->select_cash($port, $date);
                        foreach ($after as $c) {
                            $cash_after = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $c->CashFlow);
                            $revoke_after = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $c->RevokeCustomer);
                            $courtFee_after = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $c->CourtFee);
                            $transferFee_after =  iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $c->TransferFee);
                        }
                        $this->EditData_model->Log_Update(
                            $port,
                            $date,
                            $cash_before,
                            $cash_after,
                            $revoke_before,
                            $revoke_after,
                            $courtFee_before,
                            $courtFee_after,
                            $transferFee_before,
                            $transferFee_after,
                            $idemp,
                            $username,
                            'Import'
                        );
                    }
                }
            } else {
                foreach ($result as $r) {
                    $port = trim(iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $r->Port));
                    $cash = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $r->CashReceive);
                    $date = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $r->Date_Import);
                    $revoke = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $r->RevokeCustomer);
                    $courtFee = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $r->CourtFee);
                    $transferFee = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $r->TransferFee);
                    $Adjust = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $r->Adjust);
                    $Commission = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $r->Commission);
                    $NetCashReceive = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $r->NetCashReceive);
                    $CashFlow = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $r->NetCashReceive);
                    $StatusPort = $r->StatusPort;

                    $before = $this->Import_model->select_cash($port, $date);
                    foreach ($before as $c) {
                        $cash_before = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $c->CashFlow);
                        $revoke_before = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $c->RevokeCustomer);
                        $courtFee_before = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $c->CourtFee);
                        $transferFee_before =  iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $c->TransferFee);
                    }

                    // $this->Import_model->import_data_true($port, $cash, $date, $revoke, $courtFee, $transferFee);
                    $this->Import_model->import_data_true($port, $cash, $date, $revoke, $courtFee, $transferFee, $Adjust, $Commission, $NetCashReceive, $StatusPort, $CashFlow);

                    $after = $this->Import_model->select_cash($port, $date);
                    foreach ($after as $c) {
                        $cash_after = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $c->CashFlow);
                        $revoke_after = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $c->RevokeCustomer);
                        $courtFee_after = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $c->CourtFee);
                        $transferFee_after =  iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $c->TransferFee);
                    }
                    $this->EditData_model->Log_Update(
                        $port,
                        $date,
                        $cash_before,
                        $cash_after,
                        $revoke_before,
                        $revoke_after,
                        $courtFee_before,
                        $courtFee_after,
                        $transferFee_before,
                        $transferFee_after,
                        $idemp,
                        $username,
                        'Import'
                    );
                }
                $data = array("error_status" => false);
                echo json_encode($data);
            }
        }
    }
    //----------------------------------------------------------------------------------------------------------------//

    public function select_import_data()
    {
        $idemp = $this->session->userdata("IDEmp");
        $username = $this->session->userdata('username');

        if ($username == "") {
            $this->load->view('false');
        } else {
            $date_start = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $this->input->post('date_start'));
            $date_end =  iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $this->input->post('date_end'));
            $result = $this->Import_model->select_data($username);

            $this->Import_model->delete_import_false($username);
            $i = 0;
            $error = false;
            $error_add = false;
            $hadUpdate = false;
            $noPort = false;

            foreach ($result as $r) {
                $port = trim(iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $r->Port));
                $cash_add = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $r->Cash);
                $date = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $r->Date_Import);
                $list_error[$i] = "";

                //////////////////////////////////////////////////////////////////////////////////

                $data = $this->Import_model->check_port_in_cashflow($port, $date);
                if ($data[0]->count_data == 0) {
                    $error = true;
                    $error_add = true;
                    $noPort = true;
                    $list_error[$i] = $list_error[$i] . " ไม่พบพอร์ต " . $port . " ที่ต้องการอัพเดตจำนวนเงิน ";
                }

                ///////////////////////////////////check ว่าข้อมูลถูก import ไปแล้วหรือยัง //////////////////////////////////////////////////

                if (!$error_add) {
                    $recently = $this->Import_model->check_recently_updated($date_start, $date_end, $port, $date);
                    if ($recently) {
                        foreach ($recently as $r) {
                            $this->Import_model->insert_recently_updated($port, $date, $username, $r->Cash_Add, $r->Date_Update);
                        }
                        $error = true;
                        $hadUpdate = true;
                    }
                }

                /////////////////////////////////////////////////////////////////////////////////////

                if ($error_add) {
                    $this->Import_model->import_data_false(
                        $port,
                        $cash_add,
                        $date,
                        iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $list_error[$i]),
                        $username
                    );
                    $error_add = false;
                }

                $i++;
            }


            if ($noPort) {
                $resultErr = $this->Import_model->select_import_false($username);
                $portArr = array();
                foreach ($resultErr as $r) {
                    $portArr[] = array("Port" => trim(iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->Port)));
                }
                $data = array("result" => $list_error, "port" => $portArr, "error_status" => true);
            }
            if ($hadUpdate && $noPort) {
                $resultRecent = $this->Import_model->select_recently_updated($username);
                $RecentArr = array();
                foreach ($resultRecent as $r) {
                    $RecentArr[] = array(
                        "Port" => trim(iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->Port)),
                        "Recently_Cash" => iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $r->Recently_Cash),
                        "Recently_Updated" => iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $r->Recently_Updated)
                    );
                }
                $data['hasUpdated'] = true;
                $data['recent'] = $RecentArr;
            } else {
                $resultRecent = $this->Import_model->select_recently_updated($username);
                $RecentArr = array();
                foreach ($resultRecent as $r) {
                    $RecentArr[] = array(
                        "Port" => trim(iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->Port)),
                        "Recently_Cash" => iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $r->Recently_Cash),
                        "Recently_Updated" => iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $r->Recently_Updated)
                    );
                }
                $data['hasUpdated'] = true;
                $data['recent'] = $RecentArr;
            }

            echo json_encode($data);
        }
    }
    //----------------------------------------------------------------------------------------------------------------//


    public function set_date()
    {
        $date = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $this->input->post('date'));
        $username = $this->session->userdata('username');



        $this->Import_model->set_date($date, $username);
    }

    //----------------------------------------------------------------------------------------------------------------//

    public function select_data_true()
    {
        $username = $this->session->userdata('username');
        $result = $this->Import_model->select_data_true($username);
        $error = $this->Import_model->select_data_false($username);

        if ($username == "") {
            $this->load->view('false');
        } else {
            $resultArr = array();
            $errorArr = array();

            foreach ($result as $r) {
                $resultArr[] = array(
                    "Number" => $r->Number,
                    "Port" => trim(iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->Port)),
                    "Cash" => $r->CashReceive,
                    "Error" => iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->Error),
                    "RevokeCustomer" => iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->RevokeCustomer),
                    "CourtFee" => iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->CourtFee),
                    "TransferFee" => iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->TransferFee),
                    "Adjust" => iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->Adjust),
                    "Commission" => iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->Commission),
                    "NetCashReceive" => iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->NetCashReceive),
                    "StatusPort" => iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->StatusPort)
                );
            }

            if (count($error) <= 0) {
                $data = array("result" => $resultArr, "error_status" => false);
                echo json_encode($data);
            } else {
                $data = array("result" => $resultArr, "error_status" => true);
                echo json_encode($data);
            }
        }
    }
    //----------------------------------------------------------------------------------------------------------------//

    public function select_data_false()
    {
        $username = $this->session->userdata('username');
        if ($username == "") {
            $this->load->view('false');
        } else {
            $result = $this->Import_model->select_data_false($username);
            $resultArr = array();


            if (count($result) <= 0) {
                $result = $this->Import_model->select_data($username);


                foreach ($result as $r) {

                    $resultArr[] = array(
                        "Number" => $r->Number,
                        "Port" => trim(iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->Port)),
                        "Cash" => iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->CashReceive),
                        "Error" => iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->Error),
                        "RevokeCustomer" => iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->RevokeCustomer),
                        "CourtFee" => iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->CourtFee),
                        "TransferFee" => iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->TransferFee),
                        "Adjust" => iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->Adjust),
                        "Commission" => iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->Commission),
                        "NetCashReceive" => iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->NetCashReceive),
                        "StatusPort" => iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->StatusPort)
                    );
                }

                $data = array("result" => $resultArr, "hasError" => false);
            } else {
                foreach ($result as $r) {
                    $resultArr[] = array(
                        "Number" => $r->Number,
                        "Port" => trim(iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->Port)),
                        "Cash" => iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->CashReceive),
                        "Error" => iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->Error),
                        "RevokeCustomer" => iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->RevokeCustomer),
                        "CourtFee" => iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->CourtFee),
                        "TransferFee" => iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->TransferFee),
                        "Adjust" => iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->Adjust),
                        "Commission" => iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->Commission),
                        "NetCashReceive" => iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->NetCashReceive),
                        "StatusPort" =>  iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->StatusPort)
                    );
                }
                $data = array("result" => $resultArr);
            }


            echo json_encode($data);
        }
    }
    //----------------------------------------------------------------------------------------------------------------//

    public function add_data()
    {
        $number = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $this->input->post('number'));
        $port = trim(iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $this->input->post('port_add')));
        $cash = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $this->input->post('cash_add'));
        $revoke = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $this->input->post('revoke_add'));
        $courtFee = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $this->input->post('court_add'));
        $transferFee = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $this->input->post('transfer_add'));
        $username = $this->session->userdata('username');
        $this->Import_model->insert_data($number, $port, $cash, $revoke, $courtFee, $transferFee, iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $error), $username);
    }

    //----------------------------------------------------------------------------------------------------------------//

    public function edit_data()
    {
        $number = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $this->input->post('number_edit'));
        $port = trim(iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $this->input->post('port_edit')));
        $cash = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $this->input->post('cash_edit'));
        $revoke = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $this->input->post('revoke_edit'));
        $courtFee = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $this->input->post('court_edit'));
        $transferFee = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $this->input->post('transfer_edit'));
        $Adjust = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $this->input->post('Adjust_edit'));
        $Commission = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $this->input->post('Commission_edit'));
        $NetCashReceive = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $this->input->post('NetCashReceive_edit'));

        $username = $this->session->userdata('username');
        $PORT = $this->Import_model->select_edit_remove_error($number, $username);
        foreach ($PORT as $p) {
            $PORT_EDIT = trim(iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $p->Port));
        }
        $count_port = $this->Import_model->count_port($username);
        $P = array();
        foreach ($count_port as $p) {
            array_push($P, trim(iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $p->Port)));
        }

        if (array_count_values($P)[$PORT_EDIT] > 1) {
            if (array_count_values($P)[$PORT_EDIT] <= 2) {

                $result = $this->Import_model->select_remove_error($PORT_EDIT, $number, $username);
                foreach ($result as $r) {
                    $Number = $r->Number;
                    $Port = trim(iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->Port));
                    $Error = iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->Error);
                }
                $data = explode(" ", $Error);
                if (count($data) == 3) {
                    $Error = "";
                } else if (count($data) == 5) {
                    $Error = " " . $data[3] . " ";
                } else if (count($data) == 7) {
                    $Error = " " . $data[3] . " " . $data[5] . " ";
                } else if (count($data) == 9) {
                    $Error = " " . $data[3] . " " . $data[5] . " " . $data[7] . " ";
                } else if (count($data) == 11) {
                    $Error = " " . $data[3] . " " . $data[5] . " " . $data[7] . " " . $data[9] . " ";
                }

                $this->Import_model->remove_error($Number, $Port, iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $Error), $username);
                //////////////////////////////////////////////////////////////////////////////////
                // if($port =="" ){
                //     $error = $error." Portเป็นค่าว่าง " ;
                // }else{
                //     $com = $this->Import_model->check_port($port);
                //     if($com[0]->count_port == 0){
                //         $error = $error." ไม่มีPortในระบบ " ;
                //     }
                // }
                // ///////////////////////////////////////////////////////////////////////////////////
                // if($cash =="" ){
                //     $error = $error." Cashเป็นค่าว่าง " ;
                // }else if(is_numeric($cash) == false){
                //     $error = $error." Cashไม่เป็นตัวเลข " ;
                // }
                // /////////////////////////////////////////////////////////////////////////////////////
                // if($revoke =="" ){
                //     $error = true;
                //     $error = $error." Revokeเป็นค่าว่าง " ;
                // }else if(is_numeric($revoke) == false){
                //     $error = true;
                //     $error = $error." Revokeไม่เป็นตัวเลข " ;
                // }
                // /////////////////////////////////////////////////////////////////////////////////////
                // if($courtFee =="" ){
                //     $error = true;
                //     $error = $error." CourtFeeเป็นค่าว่าง " ;
                // }else if(is_numeric($courtFee) == false){
                //     $error = true;
                //     $error = $error." CourtFeeไม่เป็นตัวเลข " ;
                // }
                // /////////////////////////////////////////////////////////////////////////////////////
                // if($transferFee =="" ){
                //     $error = true;
                //     $error = $error." TransferFeeเป็นค่าว่าง " ;
                // }else if(is_numeric($transferFee) == false){
                //     $error = true;
                //     $error = $error." TransferFeeไม่เป็นตัวเลข " ;
                // }
                // /////////////////////////////////////////////////////////////////////////////////////
                $this->Import_model->edit_data(
                    $number,
                    $port,
                    $cash,
                    $revoke,
                    $courtFee,
                    $transferFee,
                    $Adjust,
                    $Commission,
                    $NetCashReceive,
                    iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $error),
                    $username
                );
            } else {
                //////////////////////////////////////////////////////////////////////////////////
                // if($port =="" ){
                //     $error = $error." Portเป็นค่าว่าง " ;
                // }else{
                //     $com = $this->Import_model->check_port($port);
                //     if($com[0]->count_port == 0){
                //         $error = $error." ไม่มีPortในระบบ " ;
                //     }
                // }
                // ///////////////////////////////////////////////////////////////////////////////////
                // if($cash =="" ){
                //     $error = $error." Cashเป็นค่าว่าง " ;
                // }else if(is_numeric($cash) == false){
                //     $error = $error." Cashไม่เป็นตัวเลข " ;
                // }
                // /////////////////////////////////////////////////////////////////////////////////////
                // if($revoke =="" ){
                //     $error = true;
                //     $error = $error." Revokeเป็นค่าว่าง " ;
                // }else if(is_numeric($revoke) == false){
                //     $error = true;
                //     $error = $error." Revokeไม่เป็นตัวเลข " ;
                // }
                // /////////////////////////////////////////////////////////////////////////////////////
                // if($courtFee =="" ){
                //     $error = true;
                //     $error = $error." CourtFeeเป็นค่าว่าง " ;
                // }else if(is_numeric($courtFee) == false){
                //     $error = true;
                //     $error = $error." CourtFeeไม่เป็นตัวเลข " ;
                // }
                // /////////////////////////////////////////////////////////////////////////////////////
                // if($transferFee =="" ){
                //     $error = true;
                //     $error = $error." TransferFeeเป็นค่าว่าง " ;
                // }else if(is_numeric($transferFee) == false){
                //     $error = true;
                //     $error = $error." TransferFeeไม่เป็นตัวเลข " ;
                // }
                // /////////////////////////////////////////////////////////////////////////////////////
                $this->Import_model->edit_data(
                    $number,
                    $port,
                    $cash,
                    $revoke,
                    $courtFee,
                    $transferFee,
                    $Adjust,
                    $Commission,
                    $NetCashReceive,
                    iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $error),
                    $username
                );
            }
        } else {
            // //////////////////////////////////////////////////////////////////////////////////
            // if($port =="" ){
            //     $error = $error." Portเป็นค่าว่าง " ;
            // }else{
            //     $com = $this->Import_model->check_port($port);
            //     if($com[0]->count_port == 0){
            //         $error = $error." ไม่มีPortในระบบ " ;
            //     }
            // }
            // ///////////////////////////////////////////////////////////////////////////////////
            // if($cash =="" ){
            //     $error = $error." Cashเป็นค่าว่าง " ;
            // }else if(is_numeric($cash) == false){
            //     $error = $error." Cashไม่เป็นตัวเลข " ;
            // }
            // /////////////////////////////////////////////////////////////////////////////////////
            // if($revoke =="" ){
            //     $error = true;
            //     $error = $error." Revokeเป็นค่าว่าง " ;
            // }else if(is_numeric($revoke) == false){
            //     $error = true;
            //     $error = $error." Revokeไม่เป็นตัวเลข " ;
            // }
            // /////////////////////////////////////////////////////////////////////////////////////
            // if($courtFee =="" ){
            //     $error = true;
            //     $error = $error." CourtFeeเป็นค่าว่าง " ;
            // }else if(is_numeric($courtFee) == false){
            //     $error = true;
            //     $error = $error." CourtFeeไม่เป็นตัวเลข " ;
            // }
            // /////////////////////////////////////////////////////////////////////////////////////
            // if($transferFee =="" ){
            //     $error = true;
            //     $error = $error." TransferFeeเป็นค่าว่าง " ;
            // }else if(is_numeric($transferFee) == false){
            //     $error = true;
            //     $error = $error." TransferFeeไม่เป็นตัวเลข " ;
            // }
            // /////////////////////////////////////////////////////////////////////////////////////
            $this->Import_model->edit_data(
                $number,
                $port,
                $cash,
                $revoke,
                $courtFee,
                $transferFee,
                $Adjust,
                $Commission,
                $NetCashReceive,
                iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $error),
                $username
            );
        }

        //////////////////////////////////////////////////////////////////////////////////

    }

    //----------------------------------------------------------------------------------------------------------------//

    public function delete_data()
    {
        $number = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $this->input->post('number'));
        $port = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $this->input->post('port'));
        $isSelected =  iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $this->input->post('isSelected'));
        $deleteSelected = json_decode($this->input->post('DeleteSelected'));
        $username = $this->session->userdata('username');
        $count_port = $this->Import_model->count_port($username);
        $P = array();
        foreach ($count_port as $p) {
            array_push($P, trim(iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $p->Port)));
        }

        ////////////////////////////////////////////////////////////////////////////////
        if ($isSelected == "false") {
            if (array_count_values($P)[$port] > 1) {
                if (array_count_values($P)[$port] <= 2) {

                    $result = $this->Import_model->select_remove_error($port, $number, $username);
                    foreach ($result as $r) {
                        $Number = $r->Number;
                        $Port = trim(iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->Port));
                        $Error = iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->Error);
                    }
                    $data = explode(" ", $Error);
                    if (count($data) == 3) {
                        $Error = "";
                    } else if (count($data) == 5) {
                        $Error = " " . $data[3] . " ";
                    } else if (count($data) == 7) {
                        $Error = " " . $data[3] . " " . $data[5] . " ";
                    } else if (count($data) == 9) {
                        $Error = " " . $data[3] . " " . $data[5] . " " . $data[7] . " ";
                    } else if (count($data) == 11) {
                        $Error = " " . $data[3] . " " . $data[5] . " " . $data[7] . " " . $data[9] . " ";
                    }

                    $this->Import_model->remove_error($Number, $Port, iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $Error), $username);
                    // $this->Import_model->delete_data($number, $name);
                    $this->Import_model->delete_data($port, $username);
                } else {
                    // $this->Import_model->delete_data($number, $name);
                    $this->Import_model->delete_data($port, $username);
                }
            } else {
                $this->Import_model->delete_data($port, $username);
                // $this->Import_model->delete_data($number, $name);
            }
        } else if ($isSelected == "true") {
            foreach ($deleteSelected as $d) {
                $number = $d->Number;
                $port = trim($d->Port);
                if (array_count_values($P)[$port] > 1) {
                    if (array_count_values($P)[$port] <= 2) {

                        $result = $this->Import_model->select_remove_error($port, $number, $username);
                        foreach ($result as $r) {
                            $Number = $r->Number;
                            $Port = trim(iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->Port));
                            $Error = iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->Error);
                        }
                        $data = explode(" ", $Error);
                        if (count($data) == 3) {
                            $Error = "";
                        } else if (count($data) == 4) {
                            $Error = " " . $data[2] . " ";
                        } else if (count($data) == 5) {
                            $Error = " " . $data[2] . $data[3] . " ";
                        } else if (count($data) == 6) {
                            $Error = " " . $data[2] . $data[3] . $data[4] . " ";
                        } else if (count($data) == 7) {
                            $Error = " " . $data[2] . $data[3] . $data[4] . $data[5] . " ";
                        }

                        $this->Import_model->remove_error($Number, $Port, iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $Error), $username);
                        // $this->Import_model->delete_data($number, $name);
                        $this->Import_model->delete_data($port, $username);
                    } else {
                        // $this->Import_model->delete_data($number, $name);
                        $this->Import_model->delete_data($port, $username);
                    }
                } else {
                    // $this->Import_model->delete_data($number, $name);
                    $this->Import_model->delete_data($port, $username);
                }

                $count_port = $this->Import_model->count_port($username);
                $P = array();
                foreach ($count_port as $p) {
                    array_push($P, trim(iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $p->Port)));
                }
            }
        }
    }

    //----------------------------------------------------------------------------------------------------------------//

    public function delete_import_error()
    {

        $port = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $this->input->post('port'));
        $username = $this->session->userdata('username');
        $this->Import_model->delete_import_error($port, $username);
    }

    //----------------------------------------------------------------------------------------------------------------//

    public function deleteAll_import_error()
    {

        $username = $this->session->userdata('username');
        $result = $this->Import_model->select_import_false($username);
        foreach ($result as $r) {
            $port = trim(iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $r->Port));
            $this->Import_model->delete_import_error($port, $username);
        }
    }

    //----------------------------------------------------------------------------------------------------------------//

    public function delete_import_recently()
    {

        $port = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $this->input->post('port'));
        $username = $this->session->userdata('username');
        $this->Import_model->delete_import_recently($port, $username);
    }

    //----------------------------------------------------------------------------------------------------------------//

    public function deleteAll_import_recently()
    {

        $username = $this->session->userdata("username");
        $result = $this->Import_model->select_recently_updated($username);
        foreach ($result as $r) {
            $port = trim(iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $r->Port));
            $this->Import_model->delete_import_recently($port, $username);
        }
    }

    //----------------------------------------------------------------------------------------------------------------//

    public function select_data_import()
    {
        $username = $this->session->userdata("username");
        $result = $this->Import_model->select_data($username);
        $error = $this->Import_model->select_data_false($username);
        $resultArr = array();

        foreach ($result as $r) {

            $resultArr[] = array(
                "Number" => $r->Number,
                "Port" => trim(iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->Port)),
                "Cash" => iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->Cash)
            );
        }

        $data = array("result" => $resultArr);
        echo json_encode($data);
    }

    //----------------------------------------------------------------------------------------------------------------//

    public function export_data_csv()
    {

        $data['result'] = $this->Import_model->select_data($this->session->userdata("username"));
        $this->load->view('Eir_Jmt_Finish/export/export_ImportData', $data);
    }

    //----------------------------------------------------------------------------------------------------------------//

    public function select_port()
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
                $T = 'JAM_Restore';
            }
            if ($com == 'jmt') {
                $T = 'JMTLOAN_PROD-Restore';
            }

            $resultArr = array();
            $result = $this->Import_model->select_port($T);
            foreach ($result as $r) {
                $resultArr[] = array("Port" => trim(iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->Port)));
            }
        }
        $data = array("result" => $resultArr);
        echo json_encode($data);
    }

    //----------------------------------------------------------------------------------------------------------------//

    public function select_import_false()
    {
        $result = $this->Import_model->select_import_false();
    }

    //----------------------------------------------------------------------------------------------------------------//

}
