<?php
date_default_timezone_set("Asia/Bangkok"); //header("content-type: text/html; charset=tis-620");
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Call_EditData extends CI_Controller {
    
    public function __construct() {
        parent:: __construct();
        $this->load->model('EditData_model');     
        $this->load->model('Import_model');  
		$this->load->model('Payment_model','PM');		
        $this->load->helper('url','form','html');   
        $this->load->library('session','upload');
        $this->load->database();

    }    
     
//----------------------------------------------------------------------------------------------------------------//
    
    public function index() {
        if($this->session->userdata('IDEmp') == ''){
            redirect('Call_Login/');
        }
        else {
            $this->load->view('inc_page/header');
            $this->load->view('editdata');
        } 
    }
	
	
	public function MainEdit() {

        $username = $this->session->userdata('username');
        $data['username'] = $this->PM->username($username);
        $name = $this->session->userdata("NameEmp");


        $data['Main_Homepayment'] = "EIR_Jmt_Finish/EditData";
        $this->load->view('Homepayment', $data);
    }

//----------------------------------------------------------------------------------------------------------------//
    
    public function search_data() {
        $date = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $this->input->post('date'));
        $port = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $this->input->post('port'));
        if ($port == '') {
            $result = $this->EditData_model->select_data_withDate($date);
            $resultArr = array();

            foreach ($result as $r) {
                $resultArr[] = array("Port" => trim(iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->Port)),
                    "CashFlow" => iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->CashFlow),
                    "MONTH_YEAR" => iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->MONTH_YEAR),
                    "RevokeCustomer" => iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->RevokeCustomer),
                    "CourtFee" => iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->CourtFee),
                    "TransferFee" => iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->TransferFee)
                );
            }
            $data = array("result" => $resultArr);
            echo json_encode($data);
        } else if ($date == '') {
            $result = $this->EditData_model->select_data_withPort($port);
            $resultArr = array();

            foreach ($result as $r) {
                $resultArr[] = array("Port" => trim(iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->Port)),
                    "CashFlow" => iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->CashFlow),
                    "MONTH_YEAR" => iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->MONTH_YEAR),
                    "RevokeCustomer" => iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->RevokeCustomer),
                    "CourtFee" => iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->CourtFee),
                    "TransferFee" => iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->TransferFee)
                );
            }
            $data = array("result" => $resultArr);
            echo json_encode($data);
        } else {
            $result = $this->EditData_model->select_data_withDateAndPort($date, $port);
            $resultArr = array();

            foreach ($result as $r) {
                $resultArr[] = array("Port" => trim(iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->Port)),
                    "CashFlow" => iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->CashFlow),
                    "MONTH_YEAR" => iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->MONTH_YEAR),
                    "RevokeCustomer" => iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->RevokeCustomer),
                    "CourtFee" => iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->CourtFee),
                    "TransferFee" => iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->TransferFee)
                );
            }
            $data = array("result" => $resultArr);
            echo json_encode($data);
        }
    }
    
    

//----------------------------------------------------------------------------------------------------------------//

    public function edit_data(){
        $port = trim(iconv('UTF-8//IGNORE','TIS-620//IGNORE',$this->input->post('port_edit')));
        $cash = iconv('UTF-8//IGNORE','TIS-620//IGNORE',$this->input->post('cash_edit'));
        $revoke = iconv('UTF-8//IGNORE','TIS-620//IGNORE',$this->input->post('revoke_edit'));
        $courtFee = iconv('UTF-8//IGNORE','TIS-620//IGNORE',$this->input->post('court_edit'));
        $transferFee = iconv('UTF-8//IGNORE','TIS-620//IGNORE',$this->input->post('transfer_edit'));
        $date = iconv('UTF-8//IGNORE','TIS-620//IGNORE',$this->input->post('date'));
        $name = $this->session->userdata("NameEmp");
        $idemp = $this->session->userdata("IDEmp");
        
        $before = $this->Import_model->select_cash($port, $date);
        foreach ($before as $c){
            $cash_before = iconv('UTF-8//IGNORE','TIS-620//IGNORE',$c->CashFlow);
            $revoke_before = iconv('UTF-8//IGNORE','TIS-620//IGNORE',$c->RevokeCustomer);
            $courtFee_before = iconv('UTF-8//IGNORE','TIS-620//IGNORE',$c->CourtFee);
            $transferFee_before =  iconv('UTF-8//IGNORE','TIS-620//IGNORE',$c->TransferFee);
        }

        $this->EditData_model->edit_data($port, $cash, $date, $transferFee, $courtFee, $revoke);

        $after = $this->Import_model->select_cash($port, $date);
        foreach ($after as $c){
            $cash_after = iconv('UTF-8//IGNORE','TIS-620//IGNORE',$c->CashFlow);
            $revoke_after = iconv('UTF-8//IGNORE','TIS-620//IGNORE',$c->RevokeCustomer);
            $courtFee_after = iconv('UTF-8//IGNORE','TIS-620//IGNORE',$c->CourtFee);
            $transferFee_after =  iconv('UTF-8//IGNORE','TIS-620//IGNORE',$c->TransferFee);
        }

        
        $this->EditData_model->Log_Update($port, 
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
                                          $name, 
                                          'Edit');

    
    }
//----------------------------------------------------------------------------------------------------------------//

//----------------------------------------------------------------------------------------------------------------//
    public function delete_data() {
        $port = trim(iconv('UTF-8//IGNORE','TIS-620//IGNORE',$this->input->post('port')));
        $date = iconv('UTF-8//IGNORE','TIS-620//IGNORE',$this->input->post('date'));
        $name = $this->session->userdata("NameEmp");
        $idemp = $this->session->userdata("IDEmp");
    
        $before = $this->Import_model->select_cash($port, $date);
        foreach ($before as $c){
            $cash_before = iconv('UTF-8//IGNORE','TIS-620//IGNORE',$c->CashFlow);
            $revoke_before = iconv('UTF-8//IGNORE','TIS-620//IGNORE',$c->RevokeCustomer);
            $courtFee_before = iconv('UTF-8//IGNORE','TIS-620//IGNORE',$c->CourtFee);
            $transferFee_before =  iconv('UTF-8//IGNORE','TIS-620//IGNORE',$c->TransferFee);
        }

        $this->EditData_model->delete_data($port, $date);
        
        $after = $this->Import_model->select_cash($port, $date);
        if($after != 0){
            foreach ($after as $c){
                $cash_after = iconv('UTF-8//IGNORE','TIS-620//IGNORE',$c->CashFlow);
                $revoke_after = iconv('UTF-8//IGNORE','TIS-620//IGNORE',$c->RevokeCustomer);
                $courtFee_before = iconv('UTF-8//IGNORE','TIS-620//IGNORE',$c->CourtFee);
                $transferFee_after =  iconv('UTF-8//IGNORE','TIS-620//IGNORE',$c->TransferFee);
            }
        }
        $cash_after = '0';
        

        $this->EditData_model->Log_Update($port, 
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
                                          $name, 
                                          'Delete');

    }
    
    public function export_data_csv() {

        $date = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $this->input->get('date'));
        $port = iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $this->input->get('port'));
        if ($port == '') {
            $data['result'] = $this->EditData_model->select_data_withDate($date);
            $this->load->view('Eir_Jmt_Finish/export/export_EditData', $data);
        } else if ($date == '') {
            $data['result'] = $this->EditData_model->select_data_withPort($port);
            $this->load->view('Eir_Jmt_Finish/export/export_EditData', $data);
        } else {
            $data['result'] = $this->EditData_model->select_data_WithDateAndPort($date, $port);
            $this->load->view('Eir_Jmt_Finish/export/export_EditData', $data);
        }
    }
    
    public function getDataCanEdit() {
        $date_start = iconv('UTF-8//IGNORE','TIS-620//IGNORE',$this->input->post('date_start'));
        $date_end = iconv('UTF-8//IGNORE','TIS-620//IGNORE',$this->input->post('date_end'));
        $result = $this->EditData_model->getDataCanEdit($date_start,$date_end);
        $resultArr = array();
        foreach($result as $r){
            $resultArr[]= array("Port"=>trim(iconv('TIS-620//IGNORE','UTF-8//IGNORE',$r->Port)),
                                "MONTH_YEAR"=>iconv('TIS-620//IGNORE','UTF-8//IGNORE',$r->MONTH_YEAR)
            );
        }
        $data = array("result"=>$resultArr);
        echo json_encode($data);

    }

}
?>