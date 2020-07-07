<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");
set_time_limit(0);
ini_set('memory_limit', '-1');

class port extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url', 'form', 'html');   //เรียกมาใช้ 
        $this->load->library('session', 'upload');
        $this->load->model('eir');
        $this->load->model('Payment_model','PM');
        $this->load->database();
    }


    public function main_eir() {
        $username = $this->session->userdata('username');
        $data['username'] = $this->PM->username($username);
        
        $start = 0;
        $pageend = 20;
        $data['numpage'] = 1;
        $data['pageend'] = $pageend;
        $search = "and convert(nvarchar(7),IR.MONTH_YEAR) = convert(nvarchar(7),convert(date,GETDATE()))";

        $count_all = $this->eir->count_all_eir($search);
        foreach ($count_all as $value) {
            $data['count_all'] = $value->Count;
        }

        $data['result'] = $this->eir->all_eir($start, $pageend, $search);
        $data['port'] = $this->eir->port();
        $data['company'] = $this->eir->company();
//        $data['view'] = "report_eir";
//        $data['search'] = "search";

//        $this->load->view('EIR_JMT/main_eir', $data);
        $data['Main_Homepayment'] = "EIR_JMT/main_eir";
        $this->load->view('Homepayment', $data);
    }

    public function pagingmain_eir()
    {
        $page = $this->input->get('num_page');
        $pageend1 = 20;
        if ($page != '') {
            $page = $page;
        } else {
            $page = 1;
        }
        $start = ($page - 1) * $pageend1;
        $pageend = $page * $pageend1;
        $data['numpage'] = $page;
        $data['pageend'] = $pageend1;

        $port = $this->input->post('port');
        $date = $this->input->post('date');
        $company=$this->input->post('company');
        
        
        if($port != ''){
            $port = "and PU.Port = '$port'";
        }else{
            $port = '';
        }if($date != ''){
            $date2 = "and convert(nvarchar(7),IR.MONTH_YEAR) = '$date'";
        }else{
            $date2 = "and convert(nvarchar(7),IR.MONTH_YEAR) = convert(nvarchar(7),convert(date,GETDATE()))";
        }
		
		
		if($company != ''){
            $company = "and PU.Company = '$company'";
        }else{
            $company = "";
        }
        $search = $port.' '.$date2.' '.$company;
        


        $count_all = $this->eir->count_all_eir($search);
        
        foreach ($count_all as $value) {
            $data['count_all'] = $value->Count;
        }


        
        $data['result'] = $this->eir->all_eir($start, $pageend, $search);
        
        $this->load->view('EIR_JMT/report_eir', $data);
    }
    
    public function com() {
        // onchange Ajax -> view_search
        echo $company = $this->input->post('company');

        if ($company != '') {
            $company = "and Company = '$company'";
        } else {
            $company = '';
        }
        $data['result'] = $this->eir->port_jmt($company);



        $this->load->view('EIR_JMT/com_port', $data);
    }

    public function pagingmain_cash(){

        // $page = $this->input->get('num_page');
        // $pageend1 = 20;
        // if ($page != '') {
        //     $page = $page;
        // } else {
        //     $page = 1;
        // }
        // $start = ($page - 1) * $pageend1;
        // $pageend = $page * $pageend1;
        // $data['numpage'] = $page;
        // $data['pageend'] = $pageend1;
        
         $username = $this->session->userdata('username');
        $data['username'] = $this->PM->username($username);
       
        $port = $this->input->post('port');
        $date = $this->input->post('date');
        $date1 = $this->input->post('date1');
        
        if($port != ''){
            $port = "and rtrim(ltrim(Port)) = rtrim(ltrim('$port'))";
        }else{
            $port = '';
        }if($date != '' || $date1 != ''){
            
            $date  =  $date.'-01';
            $date1 = date("Y-m-t", strtotime($date1)); //get last day of month

            $dates = "and CONVERT(VARCHAR, MONTH_YEAR , 120) between '$date' and '$date1'";
        }else{
            $dates = '';
        }
        
        $search = $port.' '.$dates;

        $count_all = $this->eir->count_cash_flow( $search);
        
        foreach ($count_all as $value) {
            $data['count_all'] = $value->Count;
        }
        

        $data['cals'] = $this->eir->cal_cash($search)[0]->CashFlow;

        $data['result'] = $this->eir->cash_flow($search);
    
         $this->load->view('EIR_JMT/cash_flow', $data);

    }

    public function port_cash(){

//         $page = $this->input->get('num_page');
//         $pageend1 = 20;
//         if ($page != '') {
//             $page = $page;
//         } else {
//             $page = 1;
//         }
//         $start = ($page - 1) * $pageend1;
//         $pageend = $page * $pageend1;
//         $data['numpage'] = $page;
//         $data['pageend'] = $pageend1;
        
        
        $username = $this->session->userdata('username');
        $data['username'] = $this->PM->username($username);
        $company = $this->PM->username($username);
        foreach ($company as $key) {
            $com = $key->company;
        }

//       $port = $this->input->get('Port');
        
        $port = $this->input->GET('Port');
        $url_paramPRO = rtrim($port, '=');
        $base_64PRO = $url_paramPRO . str_repeat('=', strlen($url_paramPRO) % 4);
        $port = base64_decode($base_64PRO);
        
        
        $date = $this->input->post('date');
        $date1 = $this->input->post('date1');
        $company = $this->input->post('company');


        if($port != ''){
            $port = "and rtrim(ltrim(Port)) = '$port'";
        }else{
            $port = '';
        }if($date != '' || $date1 != ''){
                                                         
            $date  =  $date.'-01';                      //fixed day 1
            $date1 = date("Y-m-t", strtotime($date1)); //get last day of month

            $dates = "and CONVERT(VARCHAR, MONTH_YEAR , 120) between '$date' and '$date1'";
        }else{
            $dates = '';
        }
        
        $search = $port.' '.$dates;

        $count_all = $this->eir->count_cash_flow( $search);
        

        foreach ($count_all as $value) {
            $data['count_all'] = $value->Count;
        }
        
        $data['cals'] = $this->eir->cal_cash($search)[0]->CashFlow;
        

        $data['selecport'] =  $this->input->get('Port');
//        $data['view']="cash_flow";
        $data['port'] = $this->eir->port_cash();
        
//        $data['search']="search_cash";
        


        $data['result'] = $this->eir->cash_flow($search);
    
//       $this->load->view('EIR_JMT/main_eir', $data);
         $data['Main_Homepayment'] = "EIR_JMT/search_cash";
         $this->load->view('Homepayment', $data);
         
    }

    public function cash(){

       
            $this->load->model('eir');
            $start = 0;
            $pageend = 20;
            $data['numpage'] = 1;
            $data['pageend'] = $pageend;
            $search = '';
            $count_all = $this->eir->count_cash_flow($search);
            foreach ($count_all as $value) {
                $data['count_all'] = $value->Count;
            }
            
            $data['result'] = $this->eir->cash_flow($start, $pageend,  $search );
            $data['search'] = $this->eir->port();
            $data['company']= $this->eir->company();
            $data['view']="cash_flow";
            $data['port'] = $this->eir->port_cash();
            $data['search']="search_cash";
            $this->load->view('EIR_JMT/main_eir', $data);
        
    }

    public function delete_eir() {

        $this->load->model('eir');
        $Number = $this->input->post('id');
        $this->eir->delete_eir($Number);

        echo "<script> alert('Record Deleted');
	window.location.href='main_eir';
	</script>";
    }

    public function excel_eir()
    {
        
            $this->load->model('eir');
        $username = $this->session->userdata('username');
        $data['username'] = $this->PM->username($username);
        
            $port = $this->input->get('port');
            $date = $this->input->get('date');
            $company=$this->input->get('company');

            if($port != ''){

                $t=time();
                 $t=(date("Y-m-d",$t));
                $data['datetime'] = $port.' '.$t; //date and port show in excel using var datetime
                $port = "and PU.Port = '$port'";
            }else{
                $port = '';
            }if($date != ''){
                $date = "and convert(nvarchar(7),IR.MONTH_YEAR) = '$date'";
            }else{
                $date = 'and convert(nvarchar(7),IR.MONTH_YEAR) = convert(nvarchar(7),convert(date,GETDATE()))';
            }if($company != ''){
                $company = "and Company = '$company'";
            }else{
                $company = "";
            }
            $search = $port.' '.$date.' '.$company;
            

            $data['result'] = $this->eir->all_eir(0,9999,$search);
            $this->load->view('EIR_JMT/excel_eir', $data);
         
    }

    public function excel_cash()
    {
        
            $this->load->model('eir');

            $port = $this->input->get('port');
            

            $date = $this->input->get('date');
            $date1 = $this->input->get('date1');
            

            if($port != ''){
                
                $t=time();
                 $t=(date("Y-m-d",$t));
                $data['datetime'] = $port.' '.$t;

                $port = "and rtrim(ltrim(Port)) = rtrim(ltrim('$port'))";
            }else{
                $port = '';
            }if($date != '' || $date1 != ''){

                $date  =  $date.'-01';
                $date1 = date("Y-m-t", strtotime($date1)); //get last day of month

                $dates = "and CONVERT(VARCHAR, MONTH_YEAR , 120) between '$date' and '$date1'";
            }else{
                $dates = '';
            }
            $search = $port.' '.$dates;
            $search1 = $port;
            
            

            $data['result1'] = $this->eir->exportbyid1_eir(0,999999,$search1);
            $data['result'] = $this->eir->cash_flow($search);
            $this->load->view('EIR_JMT/excel_cash', $data);
         
    }

    public function pdf_cash() {

        $username = $this->session->userdata('username');
        $data['username'] = $this->PM->username($username);
        $this->load->model('eir');

        $port = $this->input->get('port');


        $date = $this->input->get('date');
        $date1 = $this->input->get('date1');

        if ($port != '') {

            $t = time();
            $t = (date("Y-m-d", $t));
            $data['datetime'] = $port . ' ' . $t;

            $port = "and rtrim(ltrim(Port)) = rtrim(ltrim('$port'))";
        } else {
            $port = '';
        }if ($date != '' || $date1 != '') {

            $date = $date . '-01';
            $date1 = date("Y-m-t", strtotime($date1)); //get last day of month

            $dates = "and CONVERT(VARCHAR, MONTH_YEAR , 120) between '$date' and '$date1'";
        } else {
            $dates = '';
        }
        $search = $port . ' ' . $dates;
        $search1 = $port;

        $data['result1'] = $this->eir->exportbyid1_eir(0, 999999, $search1);
        $data['result'] = $this->eir->cash_flow($search);

//            $data['views'] = 'pdf_cash';
        $this->load->view('EIR_JMT/pdf', $data);
    }

    public function excel1_cash()
    {
        $this->load->model('eir');
        $Port = $this->input->GET('Port');
       
        $t=time();
        $t=(date("Y-m-d",$t));
        $data['datetime'] = $Port.' '.$t;

        $search = $Port;
            
        $data['result1'] = $this->eir->exportbyid2_eir(0,999999,$search);   
        $data['result'] = $this->eir->exportbyid_cash(0,999999,$Port);
        //   print count($data['result']);
        $this->load->view('EIR_JMT/excel_cash', $data);
    }

    public function pdf1_cash() {
        
        $username = $this->session->userdata('username');
        $data['username'] = $this->PM->username($username);
        
        $this->load->model('eir');
        $Port = $this->input->GET('Port');


        $t = time();
        $t = (date("Y-m-d", $t));
        $data['datetime'] = $Port . ' ' . $t;


        $search = $Port;

        $data['result1'] = $this->eir->exportbyid2_eir(0, 999999, $search);
        $data['result'] = $this->eir->exportbyid_cash(0, 9999999, $Port);
        $data['views'] = 'pdf_cash';
        
        
        $this->load->view('EIR_JMT/pdf', $data);
    }

    public function view_eir()
    {
        // $sessionid = $this->session->userdata('id');
        // if ($sessionid == '') {
        //     $this->load->view('index11');
        // } else {
        $this->load->model('eir');
        $Port = $this->input->post('Port');


        $data['result'] = $this->eir->exportbyid_eir(0,999999,$Port);
      
        $this->load->view('EIR_JMT/viewdetail', $data);
        // }

    }

    public function view_cash()
    {
        // $sessionid = $this->session->userdata('id');
        // if ($sessionid == '') {
        //     $this->load->view('index11');
        // } else {
        $this->load->model('eir');
        $row = $this->input->post('row');


        $data['result'] = $this->eir->exportbyid_cash(0,999999,$row);
      
        $this->load->view('EIR_JMT/viewcash', $data);
        // }

    }

    public function excel1_eir()
    {
        $this->load->model('eir');
        $Port = $this->input->GET('Port');
        $t=time();
                 $t=(date("Y-m-d",$t));
                $data['datetime'] = $Port.' '.$t;


        $data['result'] = $this->eir->exportbyid_eir(0,999999,$Port);
        //   print count($data['result']);
        $this->load->view('excel_eir', $data);
    }


    public function pdf_eir() {

        $username = $this->session->userdata('username');
        $data['username'] = $this->PM->username($username);
        $this->load->model('eir');

        $port = $this->input->get('port');
        $date = $this->input->get('date');
        $company = $this->input->get('company');

        if ($port != '') {

            $t = time();
            $t = (date("Y-m-d", $t));
            $data['datetime'] = $port . ' ' . $t; //date and port show in excel using var datetime
            $port = "and PU.Port = '$port'";
        } else {
            $port = '';
        }if ($date != '') {
            $date = "and convert(nvarchar(7),IR.MONTH_YEAR) = '$date'";
        } else {
            $date = 'and convert(nvarchar(7),IR.MONTH_YEAR) = convert(nvarchar(7),convert(date,GETDATE()))';
        }if ($company != '') {
            $company = "and Company = '$company'";
        } else {
            $company = "";
        }
        $search = $port . ' ' . $date . ' ' . $company;


        $data['result'] = $this->eir->all_eir(0, 999999, $search);

        $data['views'] = 'EIR_JMT/xpdf_eir';

        $this->load->view('EIR_JMT/pdf', $data);
    }

    public function pdf1_eir()
    {
        $this->load->model('eir');
        $Port = $this->input->GET('Port');

        $t=time();
                 $t=(date("Y-m-d",$t));
                $data['datetime'] = $Port.' '.$t;

        $data['result'] = $this->eir->exportbyid_eir(0,9999,$Port);
        $data['views'] = 'xpdf_eir';
        //   print count($data['result']);
        $this->load->view('pdf', $data);
    }
    
    
    //ข้อมูลในหน้า Sum per year
    public function year_sum()
    {
        
         $username = $this->session->userdata('username');
        $data['username'] = $this->PM->username($username);
        
        $data['port'] = $this->eir->port();

        $textva = '';
        foreach ($data['port'] as $p) {
            $textva .= "ROUND( sum((case when Port = '$p->Port' and convert(nvarchar(7),convert(date,MONTH_YEAR))<= convert(nvarchar(7),convert(date,GETDATE())) then CashFlow/1000000 else 0 end)) ,2)as '$p->Port',";
        }

        $textvaos = '';
        foreach ($data['port'] as $p) {
            $textvaos .= "ROUND( sum((case when Port = '$p->Port' then OS/1000000 else 0 end)) ,2)as '$p->Port',";
        }

        $textvaact = '';
        foreach ($data['port'] as $p) {
            $textvaact .= "ROUND( sum((case when Port = '$p->Port' then NumAcct else 0 end)) ,2)as '$p->Port',";
        }
         
        $data['port'] = $this->eir->port();
        $data['summonth'] = $this->eir->summonth($textva);
        $data['sumyear'] = $this->eir->sumyear($textva);
        $data['sumport'] = $this->eir->sumport($textva);

        $data['summonth1'] = $this->eir->summonth1($textva);
        $data['sumyear1'] = $this->eir->sumyear1($textva);
        $data['sumport1'] = $this->eir->sumport1($textva);

        $data['sumos'] = $this->eir->sumos($textvaos);
        $data['sumacct'] = $this->eir->sumacct($textvaact);

//        $this->load->view('EIR_JMT/year', $data);
         $data['Main_Homepayment'] = "EIR_JMT/year";
         $this->load->view('Homepayment', $data);
        
    }

    

    //Export ของ Sum year
    public function excel_year()
    {
        $this->load->model('eir');
        $data['port'] = $this->eir->port();

        $textva = '';
        foreach ($data['port'] as $p) {
            $textva .= "ROUND( sum((case when Port = '$p->Port' and convert(nvarchar(7),convert(date,MONTH_YEAR))<= convert(nvarchar(7),convert(date,GETDATE())) then CashFlow/1000000 else 0 end)) ,2)as '$p->Port',";
        }

        $textvaos = '';
        foreach ($data['port'] as $p) {
            $textvaos .= "ROUND( sum((case when Port = '$p->Port' then OS/1000000 else 0 end)) ,2)as '$p->Port',";
        }

        $textvaact = '';
        foreach ($data['port'] as $p) {
            $textvaact .= "ROUND( sum((case when Port = '$p->Port' then NumAcct else 0 end)) ,2)as '$p->Port',";
        }
         
        $data['port'] = $this->eir->port();
        $data['summonth'] = $this->eir->summonth($textva);
        $data['sumyear'] = $this->eir->sumyear($textva);
        $data['sumport'] = $this->eir->sumport($textva);

        $data['summonth1'] = $this->eir->summonth1($textva);
        $data['sumyear1'] = $this->eir->sumyear1($textva);
        $data['sumport1'] = $this->eir->sumport1($textva);

        $data['sumos'] = $this->eir->sumos($textvaos);
        $data['sumacct'] = $this->eir->sumacct($textvaact);
        
        
        $this->load->view('EIR_JMT/excel_year', $data);
        
        
//          $data['Main_Homepayment'] = "EIR_JMT/excel_year";
//         $this->load->view('Homepayment', $data);
        
    }

}
