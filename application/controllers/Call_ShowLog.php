<?php
date_default_timezone_set("Asia/Bangkok"); //header("content-type: text/html; charset=tis-620");
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Call_ShowLog extends CI_Controller {
    
    public function __construct() {
        parent:: __construct();   
        $this->load->model('ShowLog_model'); 
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
            $this->load->view('showlog');
        } 
    }
	
	
	public function MainShow() {

        $username = $this->session->userdata('username');
        $companyses = $this->session->userdata('company');

        if ($username == "") {
            $this->load->view('false');
        } else {
        $data['username'] = $this->PM->username($username,$companyses);
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
        
        $name = $this->session->userdata("NameEmp");
        
        $data['username_menu'] = $this->PM->username_menu($T,$username);

        

        $data['Main_Homepayment'] = "EIR_Jmt_Finish/showLog";
        $this->load->view('Homepayment', $data);
    }
    }
//----------------------------------------------------------------------------------------------------------------//

    public function getShowLog(){
        $result = $this->ShowLog_model->select_log();
        $resultArr = array();
        
        foreach($result as $r){
            $resultArr[]= array("Port"=>trim($r->Port),
                                "MONTH_YEAR"=>iconv('TIS-620//IGNORE','UTF-8//IGNORE',$r->MONTH_YEAR),
                                "Cash_Before"=>iconv('TIS-620//IGNORE','UTF-8//IGNORE',$r->Cash_Before),
                                "Cash_After"=>iconv('TIS-620//IGNORE','UTF-8//IGNORE',$r->Cash_After),
                                "Date_Update"=>iconv('TIS-620//IGNORE','UTF-8//IGNORE',$r->Date_Update),
                                "IDEmp"=>iconv('TIS-620//IGNORE','UTF-8//IGNORE',$r->IDEmp),
                                "NameEmp"=>iconv('TIS-620//IGNORE','UTF-8//IGNORE',$r->NameEmp),
                                "Log_Event"=>iconv('TIS-620//IGNORE','UTF-8//IGNORE',$r->Log_Event)
                                );
        }
        $data = array("result"=>$resultArr);
        echo json_encode($data);
    }
    
    
    public function search_ShowLog(){
        $date_start = iconv('UTF-8//IGNORE','TIS-620//IGNORE',$this->input->post('date_start'));
        $date_end = iconv('UTF-8//IGNORE','TIS-620//IGNORE',$this->input->post('date_end'));
        $port = iconv('UTF-8//IGNORE','TIS-620//IGNORE',$this->input->post('port'));
        $date_start = $date_start.'T00:00:00.000';
        $date_end = $date_end.'T23:59:59.999';
        if($port == ''){
            $result = $this->ShowLog_model->select_Log_withDate($date_start,$date_end);
            $resultArr = array();
        
            foreach($result as $r){
                $resultArr[]= array("Port"=>trim($r->Port),
                                "MONTH_YEAR"=>iconv('TIS-620//IGNORE','UTF-8//IGNORE',$r->MONTH_YEAR),
                                "Cash_Before"=>iconv('TIS-620//IGNORE','UTF-8//IGNORE',$r->Cash_Before),
                                "Cash_After"=>iconv('TIS-620//IGNORE','UTF-8//IGNORE',$r->Cash_After),
                                "Date_Update"=>iconv('TIS-620//IGNORE','UTF-8//IGNORE',$r->Date_Update),
                                "IDEmp"=>iconv('TIS-620//IGNORE','UTF-8//IGNORE',$r->IDEmp),
                                "NameEmp"=>iconv('TIS-620//IGNORE','UTF-8//IGNORE',$r->NameEmp),
                                "Log_Event"=>iconv('TIS-620//IGNORE','UTF-8//IGNORE',$r->Log_Event)
                );
            }
            $data = array("result"=>$resultArr);
            echo json_encode($data);
        }else if($date_start == '' &&  $date_end == '' ) {
            $result = $this->ShowLog_model->select_Log_withPort($port);
            $resultArr = array();
        
            foreach($result as $r){
                $resultArr[]= array("Port"=>trim($r->Port),
                                "MONTH_YEAR"=>iconv('TIS-620//IGNORE','UTF-8//IGNORE',$r->MONTH_YEAR),
                                "Cash_Before"=>iconv('TIS-620//IGNORE','UTF-8//IGNORE',$r->Cash_Before),
                                "Cash_After"=>iconv('TIS-620//IGNORE','UTF-8//IGNORE',$r->Cash_After),
                                "Date_Update"=>iconv('TIS-620//IGNORE','UTF-8//IGNORE',$r->Date_Update),
                                "IDEmp"=>iconv('TIS-620//IGNORE','UTF-8//IGNORE',$r->IDEmp),
                                "NameEmp"=>iconv('TIS-620//IGNORE','UTF-8//IGNORE',$r->NameEmp),
                                "Log_Event"=>iconv('TIS-620//IGNORE','UTF-8//IGNORE',$r->Log_Event)
                );
            }
            $data = array("result"=>$resultArr);
            echo json_encode($data);
        }
        else {
            $result = $this->ShowLog_model->select_Log_WithDateAndPort($date_start,$date_end,$port);
            $resultArr = array();
        
            foreach($result as $r){
                $resultArr[]= array("Port"=>trim($r->Port),
                                "MONTH_YEAR"=>iconv('TIS-620//IGNORE','UTF-8//IGNORE',$r->MONTH_YEAR),
                                "Cash_Before"=>iconv('TIS-620//IGNORE','UTF-8//IGNORE',$r->Cash_Before),
                                "Cash_After"=>iconv('TIS-620//IGNORE','UTF-8//IGNORE',$r->Cash_After),
                                "Date_Update"=>iconv('TIS-620//IGNORE','UTF-8//IGNORE',$r->Date_Update),
                                "IDEmp"=>iconv('TIS-620//IGNORE','UTF-8//IGNORE',$r->IDEmp),
                                "NameEmp"=>iconv('TIS-620//IGNORE','UTF-8//IGNORE',$r->NameEmp),
                                "Log_Event"=>iconv('TIS-620//IGNORE','UTF-8//IGNORE',$r->Log_Event)
                );
            }
            $data = array("result"=>$resultArr);
            echo json_encode($data);
        }
    }
    
   
    
     public function export_data_csv() {
        
        $date_start = iconv('UTF-8//IGNORE','TIS-620//IGNORE',$this->input->get('date_start'));
        $date_end = iconv('UTF-8//IGNORE','TIS-620//IGNORE',$this->input->get('date_end'));
        $port = iconv('UTF-8//IGNORE','TIS-620//IGNORE',$this->input->get('port'));
        $date_start = $date_start.'T00:00:00.000';
        $date_end = $date_end.'T23:59:59.999';
        if($port == ''){
            $data['result'] = $this->ShowLog_model->select_Log_withDate($date_start,$date_end);
            $this->load->view('Eir_Jmt_Finish/export/export_ShowLog',$data);

        }else if($date_start == '' &&  $date_end == '' ) {
            $data['result'] = $this->ShowLog_model->select_Log_withPort($port);
            $this->load->view('Eir_Jmt_Finish/export/export_ShowLog',$data);

        }
        else {
            $data['result'] = $this->ShowLog_model->select_Log_WithDateAndPort($date_start,$date_end,$port);
            $this->load->view('Eir_Jmt_Finish/export/export_ShowLog',$data);
        }

        
    }


}
