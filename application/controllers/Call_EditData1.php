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
        $date = iconv('UTF-8//IGNORE','TIS-620//IGNORE',$this->input->post('date'));
        $port = iconv('UTF-8//IGNORE','TIS-620//IGNORE',$this->input->post('port'));
        if($port == ''){
            $result = $this->EditData_model->select_data_withDate($date);
            $resultArr = array();
        
            foreach($result as $r){
                $resultArr[]= array("Port"=>trim(iconv('TIS-620//IGNORE','UTF-8//IGNORE',$r->Port)),
                                    "CashFlow"=>iconv('TIS-620//IGNORE','UTF-8//IGNORE',$r->CashFlow),
                                    "MONTH_YEAR"=>iconv('TIS-620//IGNORE','UTF-8//IGNORE',$r->MONTH_YEAR)
                                    );
            }
            $data = array("result"=>$resultArr);
            echo json_encode($data);
        }else if($date == '') {
            $result = $this->EditData_model->select_data_withPort($port);
            $resultArr = array();
        
            foreach($result as $r){
                $resultArr[]= array("Port"=>trim(iconv('TIS-620//IGNORE','UTF-8//IGNORE',$r->Port)),
                                    "CashFlow"=>iconv('TIS-620//IGNORE','UTF-8//IGNORE',$r->CashFlow),
                                    "MONTH_YEAR"=>iconv('TIS-620//IGNORE','UTF-8//IGNORE',$r->MONTH_YEAR)
                                    );
            }
            $data = array("result"=>$resultArr);
            echo json_encode($data);
        }
        else {
            $result = $this->EditData_model->select_data_WithDateAndPort($date,$port);
            $resultArr = array();
        
            foreach($result as $r){
                $resultArr[]= array("Port"=>trim(iconv('TIS-620//IGNORE','UTF-8//IGNORE',$r->Port)),
                                    "CashFlow"=>iconv('TIS-620//IGNORE','UTF-8//IGNORE',$r->CashFlow),
                                    "MONTH_YEAR"=>iconv('TIS-620//IGNORE','UTF-8//IGNORE',$r->MONTH_YEAR)
                                    );
            }
            $data = array("result"=>$resultArr);
            echo json_encode($data);
        }
        
        
    }

//----------------------------------------------------------------------------------------------------------------//

    public function edit_data(){
        $port = trim(iconv('UTF-8//IGNORE','TIS-620//IGNORE',$this->input->post('port_edit')));
        $cash = iconv('UTF-8//IGNORE','TIS-620//IGNORE',$this->input->post('cash_edit'));
        $date = iconv('UTF-8//IGNORE','TIS-620//IGNORE',$this->input->post('date'));
        $name = $this->session->userdata("NameEmp");
        $idemp = $this->session->userdata("IDEmp");
        
        $before = $this->Import_model->select_cash($port, $date);
        foreach ($before as $c){
            $cash_before = iconv('UTF-8//IGNORE','TIS-620//IGNORE',$c->CashFlow);
        }

        $this->EditData_model->edit_data($port, $cash, $date);

        $after = $this->Import_model->select_cash($port, $date);
        foreach ($after as $c){
            $cash_after = iconv('UTF-8//IGNORE','TIS-620//IGNORE',$c->CashFlow);
        }

        
        $this->EditData_model->Log_Update($port, $date, $cash_before, $cash_after, $idemp, $name, 'Edit');

        //$this->EditDate_model->Log_Update();
    
    }
//----------------------------------------------------------------------------------------------------------------//

    // public function add_data() {
    //     $number = iconv('UTF-8//IGNORE','TIS-620//IGNORE',$this->input->post('number'));
    //     $port = trim(iconv('UTF-8//IGNORE','TIS-620//IGNORE',$this->input->post('port_add')));
    //     $cash = iconv('UTF-8//IGNORE','TIS-620//IGNORE',$this->input->post('cash_add'));
    //     $name = $this->session->userdata("NameEmp");

    //     //////////////////////////////////////////////////////////////////////////////////
    //     if($port =="" ){
    //     $error = $error." Portเป็นค่าว่าง " ;
    //     }else{
    //         $com = $this->Import_model->check_port($port);
    //         if($com[0]->count_port == 0){
    //         $error = $error." ไม่มีPortในระบบ " ;
    //         }
    //     }
        
    //     ///////////////////////////////////////////////////////////////////////////////////
    //     if($cash =="" ){
    //     $error = $error." Cashเป็นค่าว่าง " ;
    //     }else if(is_numeric($cash) == false){
    //     $error = $error." Cashไม่เป็นตัวเลข " ;
            
    //     }
    //     /////////////////////////////////////////////////////////////////////////////////////

    //     $this->Import_model->insert_data($number,$port,$cash, iconv('UTF-8//IGNORE','TIS-620//IGNORE',$error),$name);   

    // }

//----------------------------------------------------------------------------------------------------------------//
    public function delete_data() {
        $port = trim(iconv('UTF-8//IGNORE','TIS-620//IGNORE',$this->input->post('port')));
        $date = iconv('UTF-8//IGNORE','TIS-620//IGNORE',$this->input->post('date'));
        $name = $this->session->userdata("NameEmp");
        $idemp = $this->session->userdata("IDEmp");
    
        $before = $this->Import_model->select_cash($port, $date);
        foreach ($before as $c){
            $cash_before = iconv('UTF-8//IGNORE','TIS-620//IGNORE',$c->CashFlow);
        }

        $this->EditData_model->delete_data($port, $date);
        
        $after = $this->Import_model->select_cash($port, $date);
        if($after != 0){
            foreach ($after as $c){
                $cash_after = iconv('UTF-8//IGNORE','TIS-620//IGNORE',$c->CashFlow);
            }
        }
        $cash_after = '0';
        

        $this->EditData_model->Log_Update($port, $date, $cash_before, $cash_after, $idemp, $name, 'Delete');

    }

}
?>