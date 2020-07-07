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
        $data['username'] = $this->PM->username($username);
        $name = $this->session->userdata("NameEmp");

        

        $data['Main_Homepayment'] = "EIR_Jmt_Finish/show_Log";
        $this->load->view('Homepayment', $data);
    }

//----------------------------------------------------------------------------------------------------------------//

    public function getShowLog() {

        $username = $this->session->userdata('username');
        $data['username'] = $this->PM->username($username);
        $name = $this->session->userdata("NameEmp");

//      $result = $this->ShowLog_model->select_log();
        
        $page = $this->input->post('page');
        $pageend1 = 100;
        if ($page != '') {
            $page = $page;
        } else {
            $page = 1;
        }

        $start = ($page - 1) * $pageend1;
        $pageend = $page * 100;

        $data['pageend'] = $pageend1;
        
        
        $data['result'] = $this->ShowLog_model->select_log($start,$pageend);
        
        $data['Countresult'] = $this->ShowLog_model->select_log_Count();
//      $resultArr = array();


        $data['Main_Homepayment'] = "EIR_Jmt_Finish/show_Log";
        $this->load->view('Homepayment', $data);

//        foreach($result as $r){
//            $resultArr[]= array("Port"=>trim($r->Port),
//                                "MONTH_YEAR"=>iconv('TIS-620//IGNORE','UTF-8//IGNORE',$r->MONTH_YEAR),
//                                "Cash_Before"=>iconv('TIS-620//IGNORE','UTF-8//IGNORE',$r->Cash_Before),
//                                "Cash_After"=>iconv('TIS-620//IGNORE','UTF-8//IGNORE',$r->Cash_After),
//                                "Date_Update"=>iconv('TIS-620//IGNORE','UTF-8//IGNORE',$r->Date_Update),
//                                "IDEmp"=>iconv('TIS-620//IGNORE','UTF-8//IGNORE',$r->IDEmp),
//                                "NameEmp"=>iconv('TIS-620//IGNORE','UTF-8//IGNORE',$r->NameEmp),
//                                "Log_Event"=>iconv('TIS-620//IGNORE','UTF-8//IGNORE',$r->Log_Event)
//                                );
//        }
//        $data = array("result"=>$resultArr);
//        echo json_encode($data);
    }

}
?>