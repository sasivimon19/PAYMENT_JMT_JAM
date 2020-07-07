<?php
date_default_timezone_set("Asia/Bangkok");
class Payment_controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('session', 'form_validation'));
		set_time_limit(0);
		ini_set('memory_limit', '-1');
		$this->load->model('Payment_model','PM');
	}

	public function index()
	{
		$this->load->view('login');
	}

	public function login_validation()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username','Username','requirde');
		$this->form_validation->set_rules('password','Password','requirde');
		if ($this->form_validation->run()) {
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$this->load->model('Payment_model');
			if($this->Payment_model->can_login($username, $password))  
			{  
				$session_data = array(  
					'username' => $username

				);  
				$this->session->set_userdata($session_data);  
				redirect(site_url('Payment_controller/loadpayment'));  
			}  
			else  
			{  
				$this->session->set_flashdata('error', 'Username หรือ Password ไม่ถูกต้อง <br> หรือ สถานะ ปิดใช้งาน');  
				redirect(site_url('Payment_controller/index'));  
			}  
		}else{
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$this->load->model('Payment_model');
			if($this->Payment_model->can_login($username, $password))  
			{  
				$session_data = array(  
					'username' => $username
                                        
				);  
				$this->session->set_userdata($session_data);  
				
				redirect(site_url('Payment_controller/loadpayment'));  
			}  
			else  
			{  
				$this->session->set_flashdata('error', 'Username หรือ Password ไม่ถูกต้อง <br> หรือ สถานะ ปิดใช้งาน');  
				redirect(site_url('Payment_controller/index'));  
			}
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('username');
		$this->load->view('login');
	}

	public function loadpayment_get_from()
	{	
		$username = $this->session->userdata('username');
                $Subject_Right = $this->session->userdata('Subject_Right');
		$data['username'] = $this->PM->username($username);		
		$company = $this->PM->username($username);
		foreach ($company as $key) {
			$com = $key->company;
		}

		if ($com == 'jam') {
			$T = 'JAM_Restore';
			$tb = 'jamdata';
		}
		if ($com == 'jmt') {
			$T = 'JMTLOAN_PROD-Restore';
			$tb = 'jmtdata';
		}
		$this->PM->delete_simulate($username,$T);

		
		$data['username_menu'] = $this->PM->username_menu($username,$T);

		$data['company'] = $this->PM->company($com);

		$Date = $this->input->post("date");
		$Agreement = $this->input->post("Agreement");
		$IDCard = $this->input->post("IDCard");
		$Channel = $this->input->post("Channel");
		$Ref1 = $this->input->post("Ref1");
		$Ref2 = $this->input->post("Ref2");
		$Amount = $this->input->post("Amount");
		$Remark = $this->input->post("Remark");
		$Lot = '';

		$this->PM->loadpayment_insert($Date,$Agreement,$IDCard,$Channel,$Ref1,$Ref2,$Amount,$Lot,$Remark,$username,$T);
		// redirect("Payment_controller/loadpayment_from_view");
		$this->session->set_flashdata('error','บันทึกข้อมูลสำเร็จ');
	}

        
	public function loadpayment_from() {

        $username = $this->session->userdata('username');
        $company = $this->PM->username($username);

        foreach ($company as $key) {
            $com = $key->company;
        }

        if ($com == 'jam') {
            $T = 'JAM_Restore';
        }
        if ($com == 'jmt') {
            $T = 'JMTLOAN_PROD-Restore';
        }
        $data['username'] = $this->PM->username($username);
        $data['username_menu'] = $this->PM->username_menu($username, $T);


        $FileBank = $this->input->post('FileBank');

        $this->PM->delete_simulate($username, $T);
        $data['company'] = $this->PM->company($com);

        $nof  = $_FILES['file']['name'];
        $file = $_FILES["file"]["tmp_name"];
        $filename = $_FILES["file"]["tmp_name"];

        list($file, $ext) = explode('.', $_FILES['file']['name']);
        
        
        $exp = explode('.' , $nof);
        $destination_file = substr($nof , 0 , -(strlen($exp[count($exp)-1])+1));



        if ($ext == 'txt') {

            $file = fopen($_FILES['file']['tmp_name'], "r");
            $rowstr = 1;
            $rowEnd = 0;

            $j = 1;

            $C1 = 20;
            $C2 = 8;
            $C3 = 56;
            $C4 = 20;
            $C5 = 48;
            $C6 = 11;
            $C7 = 93;


            $rowstr = $j;
            while (!feof($file)) {
                $item = fgets($file);
                $A = substr($item, 0, 1);

                if ($A != 'H' && $A != 'T' && $A != ' ' && $A != '') {

                    $Datefor = substr($item, 24, 4) . "-" . substr($item, 24, 4) . "-" . substr($item, 21, 2);
                    $Datefor = substr($item, 24, 4);
                    $Date = date("Y-m-d", strtotime($Datefor));
                    $Agreement = substr($item, 84, 19);
                    $IDCard = substr($item, 104, 20);
                    $Amount = substr($item, 163, 11) . "." . substr($item, 173, 2);
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
                        $Ref1 = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $Ref2 = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                        $Amount = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                        $Lot = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                        $Remark = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                        
                        $this->PM->loadpayment_insert($Date, $Agreement, $IDCard, $Channel, $Ref1, $Ref2, $Amount, $Lot, $Remark, $username, $T);
                    }
                }
            }
        }
        redirect("Payment_controller/loadpayment");
    }

    public function loadpayment() {
        
        $username = $this->session->userdata('username');
        $data['username'] = $this->PM->username($username);

        $company = $this->PM->username($username);
        foreach ($company as $key) {
            $com = $key->company;
        }
        foreach ($data['username'] as $key) {
            $username_ST = $key->chkPeriod;
        }

        if ($com == 'jam') {
            $T = 'JAM_Restore';
            $DC = 'JAM';
        }
        if ($com == 'jmt') {
            $T = 'JMTLOAN_PROD-Restore';
            $DC = 'JMT';
        }
        $Currentdate = $this->PM->dateserver();
        foreach ($Currentdate as $value) {
            $dateSv = date('m', strtotime($value->Currentdate));
        }

        $data['username_menu'] = $this->PM->username_menu($username, $T);
        $data['Channel'] = $this->PM->payment_channel($T);
        if ($username_ST == 0) {
            $data['company'] = $this->PM->company($com);
            $data['search_view_not'] = $this->PM->search_loadpayment_not_F($username, $T, $DC, $dateSv);
            $data['search_view'] = $this->PM->search_loadpayment_F($username, $T, $DC, $dateSv);
            $data['get_date'] = $this->PM->dateserver();
        }

        if ($username_ST == 1) {
            $data['company'] = $this->PM->company($com);
            $data['search_view_not'] = $this->PM->search_loadpayment_not($username, $T, $DC);
            $data['search_view'] = $this->PM->search_loadpayment($username, $T, $DC);
            $data['get_date'] = $this->PM->dateserver();
        }

        $data['Main_Homepayment'] = "loadpayment";
        $this->load->view('Homepayment', $data);
    }

    public function loadpayment_from_view()
	{
		$this->load->model('Payment_model');
		$username = $this->session->userdata('username');
		$data['username'] = $this->Payment_model->username($username);
		$data['username_menu'] = $this->Payment_model->username_menu($username);
		
		$company = $this->Payment_model->username($username);
		$dateserver = $this->Payment_model->dateserver();

		foreach ($company as $key) {
			$com = $key->company;
		}	

		foreach ($data['username'] as $key) {
			$username_ST = $key->chkPeriod;
		}

		if ($com == 'jam') {
			$T = 'JAM_Restore';
			$DC = 'JAM';
		}
		if ($com == 'jmt') {
			$T = 'JMTLOAN_PROD-Restore';
			$DC = 'JMT';
		}
		$data['Channel'] = $this->Payment_model->payment_channel($T);
		// foreach ($dateserver as $key) {
		// 	$dateSV = $key->Currentdate;
		// }

		if ($username_ST == 0) {
			$data['company'] = $this->Payment_model->company($com);		
			$data['search_view_not'] = $this->Payment_model->search_loadpayment_not_F($username);
			$data['search_view'] = $this->Payment_model->search_loadpayment_F($username);
			// $data['get_ContractNo'] = $this->Payment_model->get_ContractNo($username);
			// $data['get_IDCard'] = $this->Payment_model->get_IDCard($username);
			// $data['get_Channel'] = $this->Payment_model->get_Channel($username);
			$data['get_date'] = $this->Payment_model->dateserver();
			// $data['date_not'] = $this->Payment_model->get_Date_F($username);
		}

		if ($username_ST == 1) {
			$data['company'] = $this->Payment_model->company($com);		
			$data['search_view_not'] = $this->Payment_model->search_loadpayment_not($username);
			$data['search_view'] = $this->Payment_model->search_loadpayment($username);
			$data['sumamount'] = $this->Payment_model->sumamount_loadpayment($username);
			$data['sumamount'] = $this->Payment_model->sumamount_loadpayment($username);
			$data['sumamount_not'] = $this->Payment_model->sumamount_loadpayment_not($username);
			// $data['get_ContractNo'] = $this->Payment_model->get_ContractNo($username);
			// $data['get_IDCard'] = $this->Payment_model->get_IDCard($username);
			// $data['get_Channel'] = $this->Payment_model->get_Channel($username);
			$data['get_date'] = $this->Payment_model->dateserver();
			// $data['date_not'] = $this->Payment_model->get_Date($username);

		}		

//		$this->load->view('Homepayment',$data);
                 $data['Main_Homepayment'] = "loadpayment";
        $this->load->view('Homepayment', $data);
	}

	public function loadpayment_from_view1()
	{
		$this->load->model('Payment_model');
		$username = $this->session->userdata('username');
		$data['username'] = $this->Payment_model->username($username);
		$data['username_menu'] = $this->Payment_model->username_menu($username);
		$company = $this->Payment_model->username($username);
		foreach ($company as $key) {
			$com = $key->company;
		}		
		$data['company'] = $this->Payment_model->company($com);

		$data['search_view_not'] = $this->Payment_model->search_loadpayment_not();
		$data['search_view'] = $this->Payment_model->search_loadpayment();
		$data['get_ContractNo'] = $this->Payment_model->get_ContractNo($username);
		$data['get_IDCard'] = $this->Payment_model->get_IDCard($username);
		$data['get_Channel'] = $this->Payment_model->get_Channel($username);

		$this->load->view('test',$data);

	}

	public function loadpayment_insert()
	{
           
		$username = $this->session->userdata('username');
		$data['username'] = $this->PM->username($username);
		foreach ($data['username'] as $key) {
			$username_ST = $key->chkPeriod;
			$company = $key->company;
		}

		if ($company == 'jam') {
			$T = 'JAM_Restore';
			$DC = 'JAM';
		}
		if ($company == 'jmt') {
			$T = 'JMTLOAN_PROD-Restore';
			$DC = 'JMT';
		}

		$Currentdate = $this->PM->dateserver();
		foreach ($Currentdate as $value) {
                    	$dateSv = date('Y-m-d', strtotime($value->Currentdate));
		}

		$numcount = $this->PM->search_loadpayment($username,$T,$DC);
		$num = count($numcount);		

		for ($k=1; $k <= $num ; $k++) { 

		 	$Date1 = $this->input->post("Date1-".$k);
		 	$Agreement = $this->input->post("Agreement-".$k);
		 	$IDCard = $this->input->post("IDCard-".$k);
			$Channel = $this->input->post("Channel-".$k);
		 	$Ref1 = $this->input->post("Ref1-".$k);
                        $Ref2 = $this->input->post("Ref2-".$k);
		  	$Amount = $this->input->post("Amount-".$k);
		 	$Lot = $this->input->post("Lot-".$k);
		  	$Remark = $this->input->post("Remark-".$k);

		}
		if ($username_ST == 0) {
                    echo "<script>alert('status_0')</script>";
			$search_view = $this->PM->search_loadpayment_F($username,$T);
			foreach ($search_view as $key) {

				$Date1 = $key->Date1;
				$Agreement = $key->Agreement;
				$IDCard = $key->IDCard;
				$Channel = $key->Channel;
				$Ref1 = $key->Ref1;
				$Ref2 = $key->Ref2;
				$Amount = $key->Amount;
				$Lot = $key->lot_no;
				$Remark = $key->Remark;

				$ID_Card = $this->PM->id_customer($IDCard,$Agreement,$T);
				foreach ($ID_Card as $row) {
					$operator_name = $row->operator_name;
					$operator_value = $row->operator_value;

					if ($Channel == 'DISCOUNT' | $Channel == 'ADJUST') {
						$VAT = '0';
					}else {
						if ($operator_value == 'hp' | $operator_value == 'HP') {
							$VAT = (($Amount*7)/107);					
						}else{
							$VAT = '0';
						}
					}


				}
				//$this->PM->loadpayment_insert_FN($Date1,$Agreement,$IDCard,$Channel,$operator_name,$Ref2,$Amount,$Lot,$Remark,$username,$dateSv,$operator_name,$VAT,$company,$T);
			}
		}

		if ($username_ST == 1) {
                    echo "<script>alert('status_1')</script>";
			$search_view = $this->PM->search_loadpayment($username,$T,$DC);
			foreach ($search_view as $key) { 

				echo'<br>'. $Date1 = $key->Date1;
				$Agreement = $key->Agreement;
				$IDCard = $key->IDCard;
				$Channel = $key->Channel;
				$Ref1 = $key->Ref1;
				$Ref2 = $key->Ref2;
				$Amount = $key->Amount;
				$Lot = $key->Lot;
				$Remark = $key->Remark;

				$ID_Card = $this->PM->id_customer($IDCard,$Agreement,$T);
				foreach ($ID_Card as $row) {
                                        $operator_name = $row->operator_name;
					$operator_value = $row->operator_value;

					if ($operator_value == 'hp' | $operator_value == 'HP') {
						$VAT = (($Amount*7)/107);					
					}else{
						$VAT = '0';
					}

				}
                          
				$this->PM->loadpayment_insert_FN($Date1,$Agreement,$IDCard,$Channel,$operator_name,$Ref2,$Amount,$Lot,$Remark,$username,$dateSv,$operator_name,$VAT,$company,$T);
//				 echo $Agreement."|".$VAT."<br>";
			}

		}	

		$this->session->set_flashdata('error','บันทึกข้อมูลสำเร็จ');
                $this->PM->delete_simulate($username,$T);
                
//                $data['search_view'] = $this->PM->search_loadpayment($username,$T,$DC);
//                $this->load->view('pagedatasave', $data);
                
		
//          $data['Main_Homepayment'] = "customer";
//        $this->load->view('Homepayment', $data);
	}

	public function delete_loadpayment_simulate()
	{
		$username = $this->session->userdata('username');
		$company = $this->PM->username($username);
		foreach ($company as $key) {
			$com = $key->company;
		}	

		if ($com == 'jam') {
			$T = 'JAM_Restore';
		}
		if ($com == 'jmt') {
			$T = 'JMTLOAN_PROD-Restore';
		}

		$this->PM->delete_simulate($username,$T);
		redirect("Payment_controller/Homepayment");
	}

	public function customer() {
            
            
        $contract = $this->input->GET('id');
        $url_paramPRO = rtrim($contract, '=');
        $base_64PRO = $url_paramPRO . str_repeat('=', strlen($url_paramPRO) % 4);
        $contract = base64_decode($base_64PRO);

        $company = iconv('UTF-8', 'TIS-620', $this->input->post('company'));
        $username = $this->session->userdata('username');
        $cp = $this->PM->username($username);
        foreach ($cp as $key) {
            $com = $key->company;
        }

        if ($com == 'jam') {
            $T = 'JAM_Restore';
        }
        if ($com == 'jmt') {
            $T = 'JMTLOAN_PROD-Restore';
        }

        $data['receive'] = $this->PM->receive($contract, $company, $T);
        $data['receiveTB'] = $this->PM->receiveTB($contract, $company, $T);
        $data['username'] = $this->PM->username($username);
        $data['username_menu'] = $this->PM->username_menu($username, $T);
        $company = $this->PM->username($username);
        foreach ($company as $key) {
            $com = $key->company;
        }
        $data['company'] = $this->PM->company($com);
        $data['Cm'] = $this->PM->getall_customer($contract, $com, $T);
        
//        $this->load->view('customer', $data);
          $data['Main_Homepayment'] = "customer";
        $this->load->view('Homepayment', $data);
    }

    public function customer_index1()
	{
		$contract =iconv('UTF-8','TIS-620', $this->input->post('contract'));
		$company =iconv('UTF-8','TIS-620', $this->input->post('company'));
		$username = $this->session->userdata('username');
		$cp = $this->PM->username($username);
		foreach ($cp as $key) {
			$com = $key->company;
		}

		if ($com == 'jam') {
			$T = 'JAM_Restore';
		}
		if ($com == 'jmt') {
			$T = 'JMTLOAN_PROD-Restore';
		}

		$data['receive'] = $this->PM->receive($contract,$company,$T);
		$data['receiveTB'] = $this->PM->receiveTB($contract,$company,$T);
		$data['username'] = $this->PM->username($username);
		$data['username_menu'] = $this->PM->username_menu($username,$T);

		$data['company'] = $this->PM->company($com);
		$data['customer'] = $this->PM->get_customer($contract,$com,$T);

		$this->load->view('customer_index',$data);
	}
        
        public function customer_index() {
            
                $contract = iconv('UTF-8', 'TIS-620', $this->input->post('contract'));
                $company = iconv('UTF-8', 'TIS-620', $this->input->post('company'));
                $username = $this->session->userdata('username');
                $cp = $this->PM->username($username);
                foreach ($cp as $key) {
                    $com = $key->company;
                }

                if ($com == 'jam') {
                    $T = 'JAM_Restore';
                }
                if ($com == 'jmt') {
                    $T = 'JMTLOAN_PROD-Restore';
                }
                
                $start = 0;
                $pageend = 10;
                $wherecustomer = 0; 
                $Countcustomerall = 0;
                $data['customerall'] = "";

                $data['receive'] = $this->PM->receive($contract, $company, $T);
                $data['receiveTB'] = $this->PM->receiveTB($contract, $company, $T);
                $data['username'] = $this->PM->username($username);
                $data['username_menu'] = $this->PM->username_menu($username, $T);

                $data['company'] = $this->PM->company($com);
//                $data['customer'] = $this->PM->get_customer($contract, $com, $T);


        $data['Main_Homepayment'] = "customer_index";
        $this->load->view('Homepayment', $data);
    }

//        public function Searchcustomerindex() {
//
//        echo "<script>alert('5555')</script>";
//
//        echo'<br>' . $contract = iconv('UTF-8', 'TIS-620', $this->input->post('contract'));
//        echo'<br>' . $company = iconv('UTF-8', 'TIS-620', $this->input->post('company'));
//
//        echo'<br>' . $username = $this->session->userdata('username');
//        $cp = $this->PM->username($username);
//        foreach ($cp as $key) {
//            $com = $key->company;
//        }
//
//        if ($com == 'jam') {
//            echo'<br>' . $T = 'JAM_Restore';
//        }
//        if ($com == 'jmt') {
//            echo'<br>' . $T = 'JMTLOAN_PROD-Restore';
//        }
//
//        $data['receive'] = $this->PM->receive($contract, $company, $T);
//        $data['receiveTB'] = $this->PM->receiveTB($contract, $company, $T);
//        $data['username'] = $this->PM->username($username);
//        $data['username_menu'] = $this->PM->username_menu($username, $T);
//        $data['company'] = $this->PM->company($com);
//    }
    
    public function customer_index_from() {


        $contract = iconv('UTF-8', 'TIS-620', $this->input->post('contract'));
        $company = iconv('UTF-8', 'TIS-620', $this->input->post('company'));

        $username = $this->session->userdata('username');
        $cp = $this->PM->username($username);
        foreach ($cp as $key) {
            $com = $key->company;
        }

        if ($com == 'jam') {
            $T = 'JAM_Restore';
        }
        if ($com == 'jmt') {
            $T = 'JMTLOAN_PROD-Restore';
        }

        $data['receive'] = $this->PM->receive($contract, $company, $T);
        $data['receiveTB'] = $this->PM->receiveTB($contract, $company, $T);
        $data['username'] = $this->PM->username($username);
        $data['username_menu'] = $this->PM->username_menu($username, $T);
        $data['company'] = $this->PM->company($com);

        $Searchmore = $this->input->get('Searchmore');

        $page = $this->input->post('page');
        $pageend1 = 10;
        if ($page != '') {
            $page = $page;
        } else {
            $page = 1;
        }

        $start = ($page - 1) * $pageend1;
        $pageend = $page * 10;

        $data['pageend'] = $pageend1;

        $wherecustomer = "WHERE (A.contract_no  = '" . $contract . "' OR A.id_no = '" . $contract . "') AND A.company = '" . $com . "'";

            $data['customerall'] = $this->PM->get_customer($T, $wherecustomer, $start, $pageend);
            $data['Countcustomerall'] = $this->PM->get_Countcustomer($T, $wherecustomer);
  
  
        $data['Main_Homepayment'] = "TableCustomer";
        $this->load->view('Homepayment', $data);
    }

    public function export() {
        $username = $this->session->userdata('username');
        $this->load->model('Payment_model');
        $data['username'] = $this->Payment_model->username($username);
        $data['username_menu'] = $this->Payment_model->username_menu($username);
        $company = $this->Payment_model->username($username);
        foreach ($company as $key) {
            $com = $key->company;
        }
        $data['company'] = $this->Payment_model->company($com);
        $this->load->view('export', $data);
    }

    public function company() {
            
        $username = $this->session->userdata('username');
        $cp = $this->PM->username($username);
        foreach ($cp as $key) {
            $com = $key->company;
        }

        if ($com == 'jam') {
            $T = 'JAM_Restore';
        }
        if ($com == 'jmt') {
            $T = 'JMTLOAN_PROD-Restore';
        }
        $data['username'] = $this->PM->username($username);
        $data['username_menu'] = $this->PM->username_menu($username, $T);
        $company = $this->PM->username($username);
        foreach ($company as $key) {
            $com = $key->company;
        }
        $data['company'] = $this->PM->company($com);
        
        
        $data['Main_Homepayment'] = "company";
        $this->load->view('Homepayment', $data);
        
    }

    public function edit_company()
	{
		$username = $this->session->userdata('username');
		$company = $this->PM->username($username);
		foreach ($company as $key) {
			$com = $key->company;
		}	

		if ($com == 'jam') {
			$T = 'JAM_Restore';
			$tb = 'jamdata';
		}
		if ($com == 'jmt') {
			$T = 'JMTLOAN_PROD-Restore';
			$tb = 'jmtdata';
		}
		$id = $this->input->get("id");
		$name = iconv('UTF-8','TIS-620',$this->input->post("name"));
		$address = iconv('UTF-8','TIS-620',$this->input->post("address"));
		$taxno = iconv('UTF-8','TIS-620',$this->input->post("taxno"));
		$taxrate = iconv('UTF-8','TIS-620',$this->input->post("taxrate"));
		$code = iconv('UTF-8','TIS-620',$this->input->post("code"));

		$this->PM->update_company($id,$name,$address,$taxno,$taxrate,$code,$T,$tb);		
		redirect("Payment_controller/company");
	}

	public function pic_company(){
            
             echo"<script>alert('000000')</script>";
            
		$username = $this->session->userdata('username');
		$company = $this->PM->username($username);
		foreach ($company as $key) {
			$com = $key->company;
		}	

		if ($com == 'jam') {
			$T = 'JAM_Restore';
			$tb = 'jamdata';
		}
		if ($com == 'jmt') {
			$T = 'JMTLOAN_PROD-Restore';
			$tb = 'jmtdata';
		}
		$id = $this->input->get("id");
		$this->load->model('Payment_model');
		$Currentdate = $this->Payment_model->dateserver();
		foreach ($Currentdate as $value) {
			$dateSv = $value->Currentdate;
		}

		$username = $this->session->userdata('username');
		$company = $this->Payment_model->username($username);
		foreach ($company as $key) {
			$com = $key->company;
		}	

		$datacompany = $this->Payment_model->company($com);
		foreach ($datacompany as $value) {
			$pic = $value->pic;
		}

		$path = getcwd();
		$filepath = $path . "/images";

		if (empty($_FILES['picname']['name'])) {
			$namefile = '';
		} else {

			list($namefile, $ext) = explode('.', $_FILES['picname']['name']);
		}

		if ($namefile == '') {

			$AW_Photo = $pic;
		} else {

			@unlink("" . $filepath . "/" . $pic);
			$newnamefile = rand(0, 999999);
			$AW_Photo = date("d-m-Y", strtotime($dateSv)) . '-' . $newnamefile . '.' . $ext;
			move_uploaded_file($_FILES["picname"]["tmp_name"], $filepath . '/' . date("d-m-Y", strtotime($dateSv)) . '-' . $newnamefile . '.' . $ext);
		}

		$Photo = $AW_Photo;
		$this->Payment_model->Pic_update($Photo,$id,$T);
		redirect("Payment_controller/company");
	}

	public function pic_company_delete(){
		$username = $this->session->userdata('username');
		$company = $this->PM->username($username);
		foreach ($company as $key) {
			$com = $key->company;
		}	

		if ($com == 'jam') {
			$T = 'JAM_Restore';
			$tb = 'jamdata';
		}
		if ($com == 'jmt') {
			$T = 'JMTLOAN_PROD-Restore';
			$tb = 'jmtdata';
		}
		$id = $this->input->get("id");
		$this->PM->Pic_delete($id,$T);
		redirect("Payment_controller/company");
	}

	public function approve() {
            
        $username = $this->session->userdata('username');
        $data['username'] = $this->PM->username($username);

        $company = $this->PM->username($username);
        foreach ($company as $key) {
            $com = $key->company;
        }
        if ($com == 'jam') {
            $T = 'JAM_Restore';
        }
        if ($com == 'jmt') {
            $T = 'JMTLOAN_PROD-Restore';
        }
        $data['username_menu'] = $this->PM->username_menu($username, $T);
        $data['op'] = $this->PM->operator($T);
        $company = $this->PM->username($username);
        foreach ($company as $key) {
            $com = $key->company;
        }

        $New_Receive = "AND chennel != 'CN' AND chennel != 'DISCOUNT' AND chennel != 'ADJUST' AND chennel != 'REVOKE' AND chennel != 'REFUND' AND company = '" . $com . "'";
        $CN = "AND chennel = 'CN'";
        $DISCOUNT = "AND chennel = 'DISCOUNT' AND company = '" . $com . "'";
        $ADJUST = "AND chennel = 'ADJUST' AND company = '" . $com . "'";
        $REVOKE = "AND chennel = 'REVOKE' AND company = '" . $com . "'";
        $REFUND = "AND chennel = 'REFUND' AND company = '" . $com . "'";

        $data['company'] = $this->PM->company($com);
        $data['New_Receive'] = $this->PM->approve_New_Receive($T,$New_Receive);
        
        
        $data['CN'] = $this->PM->approve_CN($T,$CN);
        $data['DISCOUNT'] = $this->PM->approve_DISCOUNT($T,$DISCOUNT);
        $data['ADJUST'] = $this->PM->approve_ADJUST($T,$ADJUST);
        $data['REVOKE'] = $this->PM->approve_REVOKE($T,$REVOKE);
        $data['REFUND'] = $this->PM->approve_REFUND($T,$REFUND);

//	$this->load->view('approve_index', $data);
        $data['Main_Homepayment'] = "approve_index";
        $this->load->view('Homepayment', $data);
    }

    public function approve_New_Receive() {
        
		$username = $this->session->userdata('username');
		$company = $this->PM->username($username);
		foreach ($company as $key) {
			$com = $key->company;
			$level = $key->user_level;
		}
                if ($com == 'jam') {
                     $T = 'JAM_Restore';
                }
                if ($com == 'jmt') {
                    $T = 'JMTLOAN_PROD-Restore';
                }

                if ($level == '1') {
			$New_Receive = "A.state = '0' AND A.chennel != 'CN' AND A.chennel != 'DISCOUNT' AND A.chennel != 'ADJUST' AND A.chennel != 'REVOKE' AND A.chennel != 'REFUND'";
			$status = "A.state = '0' AND A.chennel != 'CN' AND A.chennel != 'DISCOUNT' AND A.chennel != 'ADJUST' AND A.chennel != 'REVOKE' AND A.chennel != 'REFUND'";
		}else{
			$New_Receive = "A.SaveEmpBy = '".$username."' AND A.state = '0' AND A.chennel != 'CN' AND A.chennel != 'DISCOUNT' AND A.chennel != 'ADJUST' AND A.chennel != 'REVOKE' AND A.chennel != 'REFUND'";
			$status = "A.SaveEmpBy = '".$username."' AND A.state = '0' AND A.chennel != 'CN' AND A.chennel != 'DISCOUNT' AND A.chennel != 'ADJUST' AND A.chennel != 'REVOKE' AND A.chennel != 'REFUND'";
		}
		$status_0 = "state = '0' AND chennel != 'CN' AND chennel != 'DISCOUNT' AND chennel != 'ADJUST' AND chennel != 'REVOKE' AND chennel != 'REFUND'";
		$status_1 = "state = '1' AND chennel != 'CN' AND chennel != 'DISCOUNT' AND chennel != 'ADJUST' AND chennel != 'REVOKE' AND chennel != 'REFUND'";
		
		$data['sum_view'] = $this->PM->sum_appvrove_1($status_0);
		$data['sum_view1'] = $this->PM->sum_appvrove_2($status_1);
		$data['search_sum_view'] = $this->PM->search_sum_appvrove1($status,$com);
		$data['search_view'] = $this->PM->approve_New_Receive_view($T,$New_Receive,$com);
                
		$this->load->view('approve_vaiew',$data);
	}

	public function approve_CN() {
		$username = $this->session->userdata('username');
		$company = $this->PM->username($username);
		foreach ($company as $key) {
			$com = $key->company;
			$level = $key->user_level;
		}
                
                if ($com == 'jam') {
                     $T = 'JAM_Restore';
                }
                if ($com == 'jmt') {
                    $T = 'JMTLOAN_PROD-Restore';
                }
                
		if ($level == '1') {
			$New_Receive = "A.state = '0' AND A.chennel = 'CN'";
			$status = "A.state = '0' AND A.chennel = 'CN'";
		}else{
			$New_Receive = "A.SaveEmpBy = '".$username."' AND A.state = '0' AND A.chennel = 'CN'";
			$status = "A.SaveEmpBy = '".$username."' AND A.state = '0' AND A.chennel = 'CN'";
		}		
		$status_0 = "state = '0' AND chennel = 'CN'";
		$status_1 = "state = '1' AND chennel = 'CN'";

		$data['sum_view'] = $this->PM->sum_appvrove_1($status_0);
		$data['sum_view1'] = $this->PM->sum_appvrove_2($status_1);
		$data['search_sum_view'] = $this->PM->search_sum_appvrove1($status,$com);
		$data['search_view'] = $this->PM->approve_New_Receive_view($T,$New_Receive,$com);
		$this->load->view('approve_vaiew',$data);
	}

	public function approve_DISCOUNT() {
		$username = $this->session->userdata('username');
		$company = $this->PM->username($username);
		foreach ($company as $key) {
			$com = $key->company;
			$level = $key->user_level;
		}
                if ($com == 'jam') {
                     $T = 'JAM_Restore';
                }
                if ($com == 'jmt') {
                    $T = 'JMTLOAN_PROD-Restore';
                }
		if ($level == '1') {
			$New_Receive = "A.state = '0' AND A.chennel = 'DISCOUNT'";
			$status = "A.state = '0' AND A.chennel = 'DISCOUNT'";
		}else{
			$New_Receive = "A.SaveEmpBy = '".$username."' AND A.state = '0' AND A.chennel = 'DISCOUNT'";
			$status = "A.SaveEmpBy = '".$username."' AND A.state = '0' AND A.chennel = 'DISCOUNT'";
		}
		$status_0 = "state = '0' AND chennel = 'DISCOUNT'";
		$status_1 = "state = '1' AND chennel = 'DISCOUNT'";

		$data['sum_view'] = $this->PM->sum_appvrove_1($status_0);
		$data['sum_view1'] = $this->PM->sum_appvrove_2($status_1);
		$data['search_sum_view'] = $this->PM->search_sum_appvrove1($status,$com);
		$data['search_view'] = $this->PM->approve_New_Receive_view($T,$New_Receive,$com);
		$this->load->view('approve_vaiew',$data);
	}

	public function approve_ADJUST() {
		$username = $this->session->userdata('username');
		$company = $this->PM->username($username);
		foreach ($company as $key) {
			$com = $key->company;
			$level = $key->user_level;
		}
                
                if ($com == 'jam') {
                     $T = 'JAM_Restore';
                }
                if ($com == 'jmt') {
                    $T = 'JMTLOAN_PROD-Restore';
                }
                
		if ($level == '1') {
			$New_Receive = "A.state = '0' AND A.chennel = 'ADJUST'";
			$status = "A.state = '0' AND A.chennel = 'ADJUST'";
		}else{
			$New_Receive = "A.SaveEmpBy = '".$username."' AND A.state = '0' AND A.chennel = 'ADJUST'";
			$status = "A.SaveEmpBy = '".$username."' AND A.state = '0' AND A.chennel = 'ADJUST'";
		}
		$status_0 = "state = '0' AND chennel = 'ADJUST'";
		$status_1 = "state = '1' AND chennel = 'ADJUST'";

		$data['sum_view'] = $this->PM->sum_appvrove_1($status_0);
		$data['sum_view1'] = $this->PM->sum_appvrove_2($status_1);
		$data['search_sum_view'] = $this->PM->search_sum_appvrove1($status,$com);
		$data['search_view'] = $this->PM->approve_New_Receive_view($T,$New_Receive,$com);
		$this->load->view('approve_vaiew',$data);
	}

	public function approve_REVOKE() {
		$username = $this->session->userdata('username');
		$company = $this->PM->username($username);
		foreach ($company as $key) {
			$com = $key->company;
			$level = $key->user_level;
		}
                if ($com == 'jam') {
                     $T = 'JAM_Restore';
                }
                if ($com == 'jmt') {
                    $T = 'JMTLOAN_PROD-Restore';
                }
		if ($level == '1') {
			$New_Receive = "A.state = '0' AND A.chennel = 'REVOKE'";
			$status = "A.state = '0' AND A.chennel = 'REVOKE'";
		}else{
			$New_Receive = "A.SaveEmpBy = '".$username."' AND A.state = '0' AND A.chennel = 'REVOKE'";
			$status = "A.SaveEmpBy = '".$username."' AND A.state = '0' AND A.chennel = 'REVOKE'";
		}
		$status_0 = "state = '0' AND chennel = 'REVOKE'";
		$status_1 = "state = '1' AND chennel = 'REVOKE'";

		$data['sum_view'] = $this->PM->sum_appvrove_1($status_0);
		$data['sum_view1'] = $this->PM->sum_appvrove_2($status_1);
		$data['search_sum_view'] = $this->PM->search_sum_appvrove1($status,$com);
		$data['search_view'] = $this->PM->approve_New_Receive_view($T,$New_Receive,$com);
		$this->load->view('approve_vaiew',$data);
	}

	public function approve_REFUND() {
		$username = $this->session->userdata('username');
		$company = $this->PM->username($username);
		foreach ($company as $key) {
			$com = $key->company;
			$level = $key->user_level;
		}
                if ($com == 'jam') {
                     $T = 'JAM_Restore';
                }
                if ($com == 'jmt') {
                    $T = 'JMTLOAN_PROD-Restore';
                }
		if ($level == '1') {
			$New_Receive = "A.state = '0' AND A.chennel = 'REFUND'";
			$status = "A.state = '0' AND A.chennel = 'REFUND'";
		}else{
			$New_Receive = "A.SaveEmpBy = '".$username."' AND A.state = '0' AND A.chennel = 'REFUND'";
			$status = "A.SaveEmpBy = '".$username."' AND A.state = '0' AND A.chennel = 'REFUND'";
		}
		$status_0 = "state = '0' AND chennel = 'REFUND'";
		$status_1 = "state = '1' AND chennel = 'REFUND'";

		$data['sum_view'] = $this->PM->sum_appvrove_1($status_0);
		$data['sum_view1'] = $this->PM->sum_appvrove_2($status_1);
		$data['search_sum_view'] = $this->PM->search_sum_appvrove1($status,$com);
		$data['search_view'] = $this->PM->approve_New_Receive_view($T,$New_Receive,$com,$T);
		$this->load->view('approve_vaiew',$data);
	}

	public function approvescan() {
            
                echo"<script>alert('111111111');</script>";

		$username = $this->session->userdata('username');
		$company = $this->PM->username($username);
		foreach ($company as $key) {
			$com = $key->company;
		}

                if ($com == 'jam') {
                    $T = 'JAM_Restore';
                }
                if ($com == 'jmt') {
                    $T = 'JMTLOAN_PROD-Restore';
                }
                
		$stat = $this->input->post("status");
		$Operator = $this->input->post("Operator");
		$idcustomer = $this->input->post("idcustomer");
		$datestart = $this->input->post("datestart");
		$dateend = $this->input->post("dateend");
		$status_0 = 0;
		$status_1 = 1;

		if ($stat == 0 ) {			
			$status = "A.state = '0' AND A.chennel != 'CN' AND A.chennel != 'DISCOUNT' AND A.chennel != 'ADJUST' AND A.chennel != 'REVOKE' AND A.chennel != 'REFUND'";
		}

		if ($stat == 1 ) {			
			$status = "A.state = '1'";
		}

		if ($stat == 2 ) {			
			$status = "A.state = '0' AND A.chennel = 'CN'";
		}

		if ($stat == 3 ) {			
			$status = "A.state = '0' AND A.chennel = 'DISCOUNT'";
		}

		if ($stat == 4 ) {			
			$status = "A.state = '0' AND A.chennel = 'ADJUST'";
		}

		if ($stat == 5 ) {			
			$status = "A.state = '0' AND A.chennel = 'REVOKE'";
		}

		if ($stat == 6 ) {			
			$status = "A.state = '0' AND A.chennel = 'REFUND'";
		}

		$data['sum_view'] = $this->PM->sum_appvrove($status_0,$Operator,$idcustomer,$datestart,$dateend);
		$data['sum_view1'] = $this->PM->sum_appvrove1($status_1,$Operator,$idcustomer,$datestart,$dateend);
                
		$data['search_view'] = $this->PM->search_appvrove($username,$status,$Operator,$idcustomer,$datestart,$dateend,$T);
		$data['search_sum_view'] = $this->PM->search_sum_appvrove($username,$status,$Operator,$idcustomer,$datestart,$dateend,$T);
		
                $this->load->view('approve_vaiew',$data);

	}

	public function approvecut()
	{
		$username = $this->session->userdata('username');
		$this->load->model('Payment_model');
		$data['username'] = $this->Payment_model->username($username);
		$data['username_menu'] = $this->Payment_model->username_menu($username);
		$this->load->view('approvecut',$data);
	}

	public function approve_updatet() {
            
        $username = $this->session->userdata('username');
        $company = $this->PM->username($username);
        foreach ($company as $key) {
            $com = $key->company;
        }

        if ($com == 'jam') {
            $T = 'JAM_Restore';
        }
        if ($com == 'jmt') {
            $T = 'JMTLOAN_PROD-Restore';
        }

        echo $contract_no = $this->input->post('contract_no');
        echo $state = $this->input->post('state');
        echo $IDCard = $this->input->post('IDCard');
        echo $amount = $this->input->post('amount');
        echo $channel = $this->input->post('channel');
        echo $Currentdate = $this->PM->dateserver();
        foreach ($Currentdate as $value) {
            echo $dateSv = $value->Currentdate;
        }

        if ($channel == 'ADJUST') {
            $Chan_nel = $this->PM->get_receive($contract_no, $IDCard);
            foreach ($Chan_nel as $row) {
                $r_index = $row->r_index;
                $c = $row->contract_no;
                $IC = $row->id_no;
                $this->PM->update_r_index($T,$c, $IC, $r_index, $dateSv);
            }
            $receive = $this->PM->get_current($contract_no, $IDCard);
            foreach ($receive as $key) {
                $OS = $key->OSbalance;
                $OSbalance = $OS - $amount;
                $this->PM->update_current($OSbalance, $contract_no, $IDCard);
            }
            $this->PM->update_receive_discount($T,$contract_no, $IDCard, $dateSv, $r_index);
        } else {
            $receive = $this->PM->get_current($contract_no, $IDCard);
            foreach ($receive as $key) {
                $OS = $key->OSbalance;
                $OSbalance = $OS - abs($amount);
               $this->PM->update_current($OSbalance, $contract_no, $IDCard);
            }

            $this->PM->update_receive($contract_no, $IDCard, $dateSv, $T);
        }
    }

    public function bank() {
                
            $username = $this->session->userdata('username');
            $company = $this->PM->username($username);
            foreach ($company as $key) {
                $com = $key->company;
            }

            if ($com == 'jam') {
                $T = 'JAM_Restore';
            }
            if ($com == 'jmt') {
                $T = 'JMTLOAN_PROD-Restore';
            }

            $data['bank'] = $this->PM->payment_channel($T);
            
            $data['company'] = $this->PM->company($com);
            $data['username'] = $this->PM->username($username);
            $data['username_menu'] = $this->PM->username_menu($username, $T);


    //	$this->load->view('payment_channel', $data);
            $data['Main_Homepayment'] = "payment_channel";
            $this->load->view('Homepayment', $data);
        }

    public function insert_channel()
	{
		$username = $this->session->userdata('username');
		$company = $this->PM->username($username);
		foreach ($company as $key) {
			$com = $key->company;
		}

		if ($com == 'jam') {
			$T = 'JAM_Restore';
		}
		if ($com == 'jmt') {
			$T = 'JMTLOAN_PROD-Restore';
		}
		$code = $this->input->post("code");
		$detail = iconv('UTF-8','TIS-620',$this->input->post("detail"));
		$status = '1';
		$Currentdate = $this->PM->dateserver();
		foreach ($Currentdate as $value) {
			$dateSv = $value->Currentdate;
		}

		$this->PM->insert_channel($code,$detail,$dateSv,$T,$status);
		redirect("Payment_controller/bank");
	}

	public function delete_channel()
	{
		$username = $this->session->userdata('username');
		$company = $this->PM->username($username);
		foreach ($company as $key) {
			$com = $key->company;
		}

		if ($com == 'jam') {
			$T = 'JAM_Restore';
		}
		if ($com == 'jmt') {
			$T = 'JMTLOAN_PROD-Restore';
		}
		$ID = $this->input->get("ID");

		$this->PM->delete_channel($ID,$T);
		redirect("Payment_controller/bank");
	}

	public function status_channel()
	{
		$username = $this->session->userdata('username');
		$company = $this->PM->username($username);
		foreach ($company as $key) {
			$com = $key->company;
		}

		if ($com == 'jam') {
			$T = 'JAM_Restore';
		}
		if ($com == 'jmt') {
			$T = 'JMTLOAN_PROD-Restore';
		}
		$id = $this->input->get("ID");
		$row = $this->PM->status_channel($id,$T);

		foreach ($row as $ss) {
			if ($ss->status == '1') {
				echo $new_status = '0';
			}

			if ($ss->status == '0' | $ss->status == '') {
				echo $new_status = '1';
			}
		}

		$affected = $this->PM->status_update_channel($id,$new_status,$T);

		if ($affected) {
			redirect("Payment_controller/bank");
		}
	}

	public function paymonth()
	{
		$username = $this->session->userdata('username');
		$this->load->model('Payment_model');
		$data['username'] = $this->Payment_model->username($username);
		$data['username_menu'] = $this->Payment_model->username_menu($username);
		$this->load->view('paymonth',$data);
	}

	public function keyin()
	{
		$username = $this->session->userdata('username');
		$this->load->model('Payment_model');
		$data['username'] = $this->Payment_model->username($username);
		$data['username_menu'] = $this->Payment_model->username_menu($username);
		$this->load->view('keyin',$data);
	}

	public function balancedb()
	{
		$username = $this->session->userdata('username');
		$this->load->model('Payment_model');
		$data['username'] = $this->Payment_model->username($username);
		$data['username_menu'] = $this->Payment_model->username_menu($username);
		$this->load->view('balancedb',$data);
	}

	public function balanceadmin()
	{
		$username = $this->session->userdata('username');
		$this->load->model('Payment_model');
		$data['username'] = $this->Payment_model->username($username);
		$data['username_menu'] = $this->Payment_model->username_menu($username);
		$this->load->view('balanceadmin',$data);
	}

	public function invoice() {
            
        $this->load->model('Payment_model');
        $username = $this->session->userdata('username');
        $data['username'] = $this->Payment_model->username($username);
        $company = $this->Payment_model->username($username);
        foreach ($company as $key) {
            $com = $key->company;
        }

        if ($com == 'jam') {
            $T = 'JAM_Restore';
        }
        if ($com == 'jmt') {
            $T = 'JMTLOAN_PROD-Restore';
        }
        $data['company'] = $this->Payment_model->company($com);
        $data['username_menu'] = $this->Payment_model->username_menu($username, $T);
        $data['op'] = $this->PM->operator($T);
        foreach ($data['op'] as $value) {
           $value->operator_name;
        }


//	$this->load->view('invoice_index',$data);
        $data['Main_Homepayment'] = "invoice_index";
        $this->load->view('Homepayment', $data);
    }

    public function invoice_view() {
        
        $username = $this->session->userdata('username');
        $Lot = $this->input->post("lot");
        $Operator = $this->input->post("Operator");
        $idcustomer = $this->input->post("idcustomer");
        $datestart = $this->input->post("datestart");
        $dateend = $this->input->post("dateend");
        $stat = $this->input->post("status");
        $Invoiced = $this->input->post("Invoice");
        
        $company = $this->PM->username($username);
        
        foreach ($company as $key) {
            $com = $key->company;
        }

        if ($com == 'jam') {
            $T = 'JAM_Restore';
        }
        if ($com == 'jmt') {
            $T = 'JMTLOAN_PROD-Restore';
        }

        if ($Invoiced == 'hp') {
            $Invoice = " D.operator_value = 'hp' AND";
        }

        if ($Invoiced == '0') {
            $Invoice = " D.operator_value != 'hp' AND";
        }

        if ($stat == '') {
            $status = "";
        }

        if ($stat == 0) {
            $status = " A.chennel != 'CN' AND A.chennel != 'DISCOUNT' AND A.chennel != 'ADJUST' AND A.chennel != 'REVOKE' AND A.chennel != 'REFUND' AND ";
        }

        if ($stat == 1) {
            $status = " AND A.chennel = 'CN' AND ";
        }

        if ($Invoiced == 'hp') {
            $desc_item = 'Tax invoice';
            $codenum = '2';
        } else {
            $desc_item = 'invoice';
            $codenum = '1';
        }

        function extract_int($str) {
            $str = str_replace(",", "", $str);
            preg_match('/[[:digit:]]+\.?[[:digit:]]*/', $str, $regs);
            return (doubleval($regs[0]));
        }

        $w = $Lot;
        $get_Lot = extract_int($w);

        $get_Operator = $this->PM->get_operator($Operator, $T);
        foreach ($get_Operator as $key) {
            $Op = $key->operator_name . $get_Lot;
        }

        $Currentdate = $this->PM->dateserver();
        foreach ($Currentdate as $value) {
            $dateSv = $value->Currentdate;
        }
        $Y = date('Y', strtotime($dateSv));
        $M = date('m', strtotime($dateSv));
        $YearMonth = $Y . $M;

        $get_invoice = $this->PM->get_invoice($Lot, $Operator, $idcustomer, $datestart, $dateend, $username, $status, $Invoice, $T);

        $runinvoice = $this->PM->runinvoice($get_Lot, $YearMonth, $Op, $desc_item, $T);
        foreach ($runinvoice as $value) {
            $RunNo = $value->RunNo;
            $YM = $value->YearMonth;
        }

        $count_runinvoice = count($runinvoice);
        $count_get_invoice = count($get_invoice);

        for ($i = 0; $i <= $count_get_invoice; $i++) {
            if ($count_runinvoice == 0) {
                $data['num_Invoice' . $i] = $YearMonth . '00' + $Lot . '000000' + $i;
            } else {
                $data['num_Invoice' . $i] = $YearMonth . '00' + $Lot . '000000' + $RunNo + $i;
            }
        }

        foreach ($get_invoice as $row) {
            $amount = $row->amount;
            $r_index = $row->r_index;
            $Text = $this->PM->Textbath($amount);
            foreach ($Text as $key) {
                $data['Textbath' . $r_index] = "-=" . $key->Textbath . "=-";
            }
        }

    


        $data['sum_invoice'] = $this->PM->get_sum_invoice($Lot, $Operator, $idcustomer, $datestart, $dateend, $username, $status, $Invoice, $T);
        $data['invoice'] = $this->PM->get_invoice($Lot, $Operator, $idcustomer, $datestart, $dateend, $username, $status, $Invoice, $T);
       
        $this->load->view('invoice_view', $data);
    }

    public function Invoice_updatet()
	{
		$i = $this->input->post('i');
		$r_index = $this->input->post('r_index');
		$contract_no = $this->input->post('contract_no');
		$refno = $this->input->post('refno2');
		$refno2 = date('Y-m-d', strtotime($refno));
		$state = $this->input->post('state');
		$IDCard = $this->input->post('IDCard');
		$amount = $this->input->post('amount');
		$Lot_No = $this->input->post('Lot');
		$num = $this->input->post('num');
		$op = $this->input->post('Operator');
		$desc = $this->input->post('Invoice');
		if ($desc == 'hp') {
			$desc_item = 'Tax invoice';
			$codenum = '2';
		}else{
			$desc_item = 'invoice';
			$codenum = '1';
		}
		$username = $this->session->userdata('username');
		$company = $this->PM->username($username);
		foreach ($company as $key) {
			$com = $key->company;
		}

		if ($com == 'jam') {
			$T = 'JAM_Restore';
		}
		if ($com == 'jmt') {
			$T = 'JMTLOAN_PROD-Restore';
		}

		function extract_int($str){  
			$str=str_replace(",","",$str);
			preg_match('/[[:digit:]]+\.?[[:digit:]]*/', $str, $regs);  
			return (doubleval($regs[0]));  
		}	

		$w = $Lot_No;
		$Lot = extract_int($w);
		
		$get_Operator = $this->PM->get_operator($op,$T);
		foreach ($get_Operator as $key) {
			$Operator = $key->operator_name.$Lot;
		}

		$Currentdate = $this->PM->dateserver();
		foreach ($Currentdate as $value) {
			$dateSv = $value->Currentdate;
		}
		$Y = date('Y', strtotime($dateSv));
		$M = date('m', strtotime($dateSv));
		$YearMonth = $Y.$M;

		$Text = $this->PM->Textbath($amount);
		foreach ($Text as $key) {
			$Textbath = "-=".$key->Textbath."=-";
		}

		$runinvoice = $this->PM->runinvoice($Lot,$YearMonth,$Operator,$desc_item,$T);
		foreach ($runinvoice as $value) {
			$RunNo = $value->RunNo;
			$YM = $value->YearMonth;
		}

		$count_runinvoice = count($runinvoice);
		if ($count_runinvoice == 0) {
			$num_Invoice = $YearMonth.'00'+$Lot.'000000'+$i;
			$get_RunNo = $i;

			$this->PM->update_runinvoice($contract_no,$state,$IDCard,$num_Invoice,$Textbath,$refno2,$amount,$r_index,$T);	
			if ($num == $i) {	
				$this->PM->runinvoice_insert($codenum,$Lot,$desc_item,$Operator,$YearMonth,$get_RunNo,$T);
			}
		}else{
			$num_Invoice = $YearMonth.'00'+$Lot.'000000'+$RunNo+$i;
			$get_RunNo = $RunNo+$i;

			$this->PM->update_runinvoice($contract_no,$state,$IDCard,$num_Invoice,$Textbath,$refno2,$amount,$r_index,$T);			
			if ($num == $i) {	
				if ($YM == $YearMonth) {
					$this->PM->runinvoice_update($codenum,$Lot,$desc_item,$Operator,$YearMonth,$get_RunNo,$T);
				}else{
					$this->PM->runinvoice_insert($codenum,$Lot,$desc_item,$Operator,$YearMonth,$get_RunNo,$T);		
				}
			}
		}

	}

	public function receive() {

        $username = $this->session->userdata('username');
        $this->load->model('Payment_model');
        $data['username'] = $this->Payment_model->username($username);
        $data['username_menu'] = $this->Payment_model->username_menu($username);

        if ($com == 'jam') {
            $T = 'JAM_Restore';
        }
        if ($com == 'jmt') {
            $T = 'JMTLOAN_PROD-Restore';
        }
//        $this->load->view('receive', $data);
        $data['Main_Homepayment'] = "receive";
        $this->load->view('Homepayment', $data);
    }

    public function daily() {

        $username = $this->session->userdata('username');
        $company = $this->PM->username($username);
        foreach ($company as $key) {
            $com = $key->company;
        }

        if ($com == 'jam') {
            $T = 'JAM_Restore';
        }
        if ($com == 'jmt') {
            $T = 'JMTLOAN_PROD-Restore';
        }
        $data['username'] = $this->PM->username($username);
        $data['op'] = $this->PM->operator($T);
        $data['username_menu'] = $this->PM->username_menu($username, $T);
        $data['company'] = $this->PM->company($com);


        $data['Main_Homepayment'] = "daily_index";
        $this->load->view('Homepayment', $data);
    }

    public function daily_view() {
        
        $datestart = $this->input->post('datestart');
        $l = $this->input->post('lot');
        $Operator = $this->input->post('Operator');
        $op = $Operator;

        if ($l == '') {
            $l = "";
        } else {
            $l;
        }

        $username = $this->session->userdata('username');
        $company = $this->PM->username($username);
        foreach ($company as $key) {
         $com = $key->company;
        }

        if ($com == 'jam') {
          $T = 'JAM_Restore';
            
        }
        if ($com == 'jmt') {
             $T = 'JMTLOAN_PROD-Restore';
        }
       
        if ($com == 'jam') {
            $TT = 'JAM';
        }
        if ($com == 'jmt') {
             $TT = 'JMTLOAN_PROD';
        }

        $Countcondition = 'SELECT';
        
        $page = $this->input->post('page');
        $pageend1 = 20;
        if ($page != '') {
           $page = $page;
        } else {
            $page = 1;
        }

        $start = ($page - 1) * $pageend1;
        $pageend = $page * 20;

        $data['pageend'] = $pageend1;


        $data['daily'] = $this->PM->daily($datestart, $Operator, $l, $T, $start, $pageend,$Countcondition);
    
        $Countcondition = 'COUNT';
        $data['Countdaily'] = $this->PM->daily($datestart, $Operator, $l, $T, $start, $pageend,$Countcondition);
        $data['sumItemnumber'] = $data['Countdaily'][0]->Count;

        $data['company'] = $this->PM->company($com);
        $Opn = $this->PM->get_operator($op, $T);
        foreach ($Opn as $key) {
            $data['OPP'] = $key->operator_name;
        }
        $data['date'] = $datestart;

        $this->load->view('daily_view', $data);
    }
    
    
   

    public function daily_PDF()
	{
		$datestart = $this->input->post('datestart');
		$l = $this->input->post('lot');
		$Operator = $this->input->post('Operator');
		$op = $this->input->post('Operator');

		if ($l == '') {
			$lot = "";
		}else{
			$lot = " AND c.lot_no = '".$l."' ";
		}

		$username = $this->session->userdata('username');
		$company = $this->PM->username($username);
		foreach ($company as $key) {
			$com = $key->company;
		}

		if ($com == 'jam') {
			$T = 'JAM_Restore';
		}
		if ($com == 'jmt') {
			$T = 'JMTLOAN_PROD-Restore';
		}

		if ($com == 'jam') {
			$TT = 'JAM';
		}
		if ($com == 'jmt') {
			$TT = 'JMTLOAN_PROD';
		}

		$data['date'] = $datestart;
		$data['op'] = $this->PM->get_operator($op,$T);
		$data['company'] = $this->PM->company($com);

		$data['daily'] = $this->PM->daily($datestart,$lot,$Operator,$TT);
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

		

		$this->load->view('daily_pdf',$data);

	}

	public function daily_Excel()
	{
		$datestart = $this->input->post('datestart');
		$lot = $this->input->post('lot');
		$Operator = $this->input->post('Operator');

		$username = $this->session->userdata('username');
		$company = $this->PM->username($username);
		foreach ($company as $key) {
			$com = $key->company;
		}

		if ($com == 'jam') {
			$T = 'JAM_Restore';
		}
		if ($com == 'jmt') {
			$T = 'JMTLOAN_PROD-Restore';
		}

		if ($com == 'jam') {
			$TT = 'JAM';
		}
		if ($com == 'jmt') {
			$TT = 'JMTLOAN_PROD';
		}

		$data['company'] = $this->PM->company($com);
		$data['daily'] = $this->PM->daily($datestart,$lot,$Operator,$TT);
		$this->load->view('daily_pdf',$data);

	}

	public function summary()
	{
		$username = $this->session->userdata('username');
		$data['username'] = $this->PM->username($username);
		$data['username_menu'] = $this->PM->username_menu($username);
		$this->load->view('summary',$data);
	}

	public function discount()
	{
		$username = $this->session->userdata('username');
		$this->load->model('Payment_model');
		$data['username'] = $this->Payment_model->username($username);
		$data['username_menu'] = $this->Payment_model->username_menu($username);
		$this->load->view('discount',$data);
	}

	public function tax()
	{
		$username = $this->session->userdata('username');
		$this->load->model('Payment_model');
		$data['username'] = $this->Payment_model->username($username);
		$data['username_menu'] = $this->Payment_model->username_menu($username);
		$this->load->view('tax',$data);
	}

	public function ord()
	{
		$username = $this->session->userdata('username');
		$this->load->model('Payment_model');
		$data['username'] = $this->Payment_model->username($username);
		$data['username_menu'] = $this->Payment_model->username_menu($username);
		$this->load->view('ord',$data);
	}

	public function ors()
	{
		$username = $this->session->userdata('username');
		$this->load->model('Payment_model');
		$data['username'] = $this->Payment_model->username($username);
		$data['username_menu'] = $this->Payment_model->username_menu($username);
		$this->load->view('ors',$data);
	}

	public function exportreport()
	{
		$username = $this->session->userdata('username');
		$this->load->model('Payment_model');
		$data['username'] = $this->Payment_model->username($username);
		$data['username_menu'] = $this->Payment_model->username_menu($username);
		$this->load->view('exportreport',$data);
	}

	public function updatedreport()
	{
		$username = $this->session->userdata('username');
		$this->load->model('Payment_model');
		$data['username'] = $this->Payment_model->username($username);
		$data['username_menu'] = $this->Payment_model->username_menu($username);
		$this->load->view('updatedreport',$data);
	}

	public function setting_index()
	{
		$username = $this->session->userdata('username');
		$company = $this->PM->username($username);
		foreach ($company as $key) {
			$com = $key->company;
		}	
		if ($com == 'jam') {
			$T = 'JAM_Restore';
		}
		if ($com == 'jmt') {
			$T = 'JMTLOAN_PROD-Restore';
		}
		$data['username'] = $this->PM->username($username);
		$data['username_menu'] = $this->PM->username_menu($username,$T);
		$data['rights'] = $this->PM->rights($T);

		$data['company'] = $this->PM->company($com);
		$data['user'] = $this->PM->user_setting($T);	
                
//		$this->load->view('setting_index',$data);
                
        $data['Main_Homepayment'] = "setting_index";
        $this->load->view('Homepayment', $data);
	}

	public function setting_detail() {
            
        $id = $this->input->get("id");
        $username = $this->session->userdata('username');
        $company = $this->PM->username($username);
        foreach ($company as $key) {
            $com = $key->company;
        }
        if ($com == 'jam') {
            $T = 'JAM_Restore';
        }
        if ($com == 'jmt') {
            $T = 'JMTLOAN_PROD-Restore';
        }
        $data['username'] = $this->PM->username($username);
        $data['username_menu'] = $this->PM->username_menu($username, $T);
        $data['username_menu_ID'] = $this->PM->username_menu_ID($id, $T);
        $data['rights'] = $this->PM->rights($T);
        $data['menu_view'] = $this->PM->setting_menu_view($id, $T);

     

        $data['company'] = $this->PM->company($com);
        $data['user'] = $this->PM->get_user_setting($id, $T);
        foreach ($data['user'] as $key) {
            $num = $key->user_level;
        }
        $data['rights_ID'] = $this->PM->rights_ID($num, $T);
        
        
//        $this->load->view('setting_detail', $data);
        
        $data['Main_Homepayment'] = "setting_detail";
        $this->load->view('Homepayment', $data);
    }

    public function setting_insert() {
        $username = $this->session->userdata('username');
        $company = $this->PM->username($username);
        foreach ($company as $key) {
            $com = $key->company;
        }
        if ($com == 'jam') {
            $T = 'JAM_Restore';
        }
        if ($com == 'jmt') {
            $T = 'JMTLOAN_PROD-Restore';
        }
        $name = iconv('UTF-8', 'TIS-620', $this->input->post("name"));
        $Username = $this->input->post("Username");
        $Password = $this->input->post("Password");
        $user_status = 0;
        $company = $this->input->post("company");
        $Rights = $this->input->post("Rights");

        $this->PM->setting_insert($name, $Username, $Password, $user_status, $company, $Rights, $T);
        
//        $data['Main_Homepayment'] = "setting_index";
//        $this->load->view('Homepayment', $data);
        
//      redirect("Payment_controller/setting_index");
    }

    public function setting_update()
	{
		$uname = $this->session->userdata('username');
		$company = $this->PM->username($uname);
		foreach ($company as $key) {
			$com = $key->company;
		}	
		if ($com == 'jam') {
			$T = 'JAM_Restore';
		}
		if ($com == 'jmt') {
			$T = 'JMTLOAN_PROD-Restore';
		}
		$id = $this->input->get("id");
		$name = iconv('UTF-8','TIS-620',$this->input->post("name"));
		$Username = $this->input->post("Username");
		$Password = $this->input->post("Password");
		$company = $this->input->post("company");
		$Rights = $this->input->post("Rights");
		$chkPeriod = $this->input->post("chkPeriod");
		$this->PM->setting_delete($id,$T);
		$num = $this->input->post("num");
		foreach ($num as $key) {
			$this->PM->setting_menu($id,$key,$T);	
		}
		$this->PM->setting_update($id,$name,$Username,$Password,$company,$Rights,$num,$chkPeriod,$T);		
		redirect("Payment_controller/setting_index");
	}

	public function setting_status()
	{
		$username = $this->session->userdata('username');
		$company = $this->PM->username($username);
		foreach ($company as $key) {
			$com = $key->company;
		}	
		if ($com == 'jam') {
			$T = 'JAM_Restore';
		}
		if ($com == 'jmt') {
			$T = 'JMTLOAN_PROD-Restore';
		}
		$id = $this->input->get("id");
		$row = $this->PM->setting_status($id,$T);

		foreach ($row as $ss) {
			if ($ss->user_status == '0') {
				$new_status = '1';
			}

			if ($ss->user_status == '1') {
				$new_status = '0';
			}
		}

		$affected = $this->PM->setting_status_update($id, $new_status,$T);

		if ($affected) {
			redirect("Payment_controller/setting_index");
		}
	}

	public function model2() {
            
        $username = $this->session->userdata('username');
        $company = $this->PM->username($username);
        foreach ($company as $key) {
            $com = $key->company;
        }

        if ($com == 'jam') {
            $T = 'JAM_Restore';
        }
        if ($com == 'jmt') {
            $T = 'JMTLOAN_PROD-Restore';
        }
        $data['username'] = $this->PM->username($username);
        $data['op'] = $this->PM->operator($T);
        $data['username_menu'] = $this->PM->username_menu($username, $T);
        $data['company'] = $this->PM->company($com);

//        $this->load->view('receive_index', $data);
        
        $data['Main_Homepayment'] = "receive_index";
        $this->load->view('Homepayment', $data);
    }

    public function receive_view() {
        
        $datestartoperator =  $this->input->post('datestartoperatorMonth');
        $datestartoperator2 = $this->input->post('datestartoperatorMonth2');
        $lot = $this->input->post('lotoperatorMonth');
        $Operator = $this->input->post('OperatorMonth');

        $username = $this->session->userdata('username');
        $company = $this->PM->username($username);
        foreach ($company as $key) {
           echo $com = $key->company;
        }
        
          $Countcondition = 'SELECT';
          $start = 0;
          $pageend = 50;

        if ($com == 'jam') {
            $T = 'JAM_Restore';
        }
        if ($com == 'jmt') {
            $T = 'JMTLOAN_PROD-Restore';
        }

        if ($com == 'jam') {
            echo"1";
            $TT = 'JAM';
            $data['receive'] = $this->PM->Summary_receive_CN($datestartoperator,$datestartoperator2,$Operator,$lot,$T, $start, $pageend,$Countcondition);
                 
        }
        if ($com == 'jmt') {
            echo"2";
            $TT = 'JMTLOAN_PROD';
            $data['receive'] = $this->PM->Summary_receive_CN($datestartoperator, $datestartoperator2, $Operator, $lot, $T, $start, $pageend, $Countcondition);
            foreach ($data['receive'] as $value) {
                echo'<br>' . $value->contract_no;
                echo'<br>' . $value->amount;
            }
        }

        $data['company'] = $this->PM->company($com);

        $data['date'] = date('d/m/Y', strtotime($datestartoperator));

        $this->load->view('receive_view_CN', $data);
    }

        public function receive_view1() {
            
        $datestartoperator = $this->input->post('datestartoperatorMonth');
        $datestartoperator2 = $this->input->post('datestartoperatorMonth2');
        $lot = $this->input->post('lotoperatorMonth');
        $Operator = $this->input->post('OperatorMonth');
        $op = $Operator;

        if ($lot == '') {
                $lot = "";
            } else {
                $lot;
//                $lot = " AND c.lot_no = '" . $l . "' ";
            }

        if ($Operator == '') {
//                $get_Operator = "";
            $Operator = "";
        } else {
            $Operator;
//               $get_Operator = " AND o.operator_name = '" . $Operator . "' ";
        }
        
  
                
         $username = $this->session->userdata('username');
            $company = $this->PM->username($username);
            foreach ($company as $key) {
                $com = $key->company;
            }

            if ($com == 'jam') {
                $T = 'JAM_Restore';
            }
            if ($com == 'jmt') {
                $T = 'JMTLOAN_PROD-Restore';
            }

            if ($com == 'jam') {
                $TT = 'JAM';
            }
            if ($com == 'jmt') {
                $TT = 'JMTLOAN_PROD';
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
      

        $data['receive'] = $this->PM->Summary_receive_OperatorMonth($datestartoperator, $datestartoperator2, $Operator, $lot, $T, $start, $pageend, $Countcondition);
        $data['company'] = $this->PM->company($com);
        
        $Countcondition = 'COUNT';
        $data['Countreceiveoperatormounth'] = $this->PM->Summary_receive_OperatorMonth($datestartoperator, $datestartoperator2, $Operator, $lot, $T, $start, $pageend, $Countcondition);
        $data['sumoperatormounth'] = $data['Countreceiveoperatormounth'][0]->Count;
            
         
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

        public function receive_view2()
	{
		$M = date('Y/m/d', strtotime($this->input->post('datestartOp')));
		$lot = $this->input->post('lotOp');
		$Operator = $this->input->post('OperatorOp');


		$username = $this->session->userdata('username');
		$company = $this->PM->username($username);
		foreach ($company as $key) {
			$com = $key->company;
		}

		if ($com == 'jam') {
			$T = 'JAM_Restore';
		}
		if ($com == 'jmt') {
			$T = 'JMTLOAN_PROD-Restore';
		}

		if ($com == 'jam') {
			$TT = 'JAM';
			$data['receive'] = $this->PM->Summary_receive_OP_jam($M,$lot,$Operator);
		}
		if ($com == 'jmt') {
			$TT = 'JMTLOAN_PROD';
			$data['receive'] = $this->PM->Summary_receive_OP_jmt($M,$lot,$Operator);
		}
		$text = 'แสดงทุก Operator';

		$data['company'] = $this->PM->company($com);

		$data['date'] = date('d/m/Y', strtotime($M));	
		
		$this->load->view('receive_view_OP',$data);
	}

	public function model3()
	{
		$username = $this->session->userdata('username');
		$company = $this->PM->username($username);
		foreach ($company as $key) {
			$com = $key->company;
		}

		if ($com == 'jam') {
			$T = 'JAM_Restore';
		}
		if ($com == 'jmt') {
			$T = 'JMTLOAN_PROD-Restore';
		}
		$data['username'] = $this->PM->username($username);
		$data['op'] = $this->PM->operator($T);
		$data['username_menu'] = $this->PM->username_menu($username,$T);
		$data['company'] = $this->PM->company($com);

		$this->load->view('report_discount_index',$data);
	}

	public function report_discount_view()
	{
		$status = $this->input->post('status');
		$Operator = $this->input->post('Operator');
		$lot = $this->input->post('lot');
		$date = date('Y/m/d', strtotime($this->input->post('date')));

		$username = $this->session->userdata('username');
		$company = $this->PM->username($username);
		foreach ($company as $key) {
			$com = $key->company;
		}

		if ($com == 'jam') {
			$T = 'JAM_Restore';
		}
		if ($com == 'jmt') {
			$T = 'JMTLOAN_PROD-Restore';
		}

		if ($com == 'jam') {
			$data['report'] = $this->PM->report_discount_jam($status,$Operator,$lot,$date);
		}
		if ($com == 'jmt') {
			$data['report'] = $this->PM->report_discount_jmt($status,$Operator,$lot,$date);
		}
		// $text = 'แสดงทุก Operator';
		// print_r($data['report']);

		$data['company'] = $this->PM->company($com);
		$data['Operator'] = $Operator;
		$data['status'] = $status;
		$data['date'] = date('m/Y', strtotime($date));	
		
		$this->load->view('report_discount_view',$data);
	}

	public function model4()
	{
		$username = $this->session->userdata('username');
		$company = $this->PM->username($username);
		foreach ($company as $key) {
			$com = $key->company;
		}

		if ($com == 'jam') {
			$T = 'JAM_Restore';
		}
		if ($com == 'jmt') {
			$T = 'JMTLOAN_PROD-Restore';
		}
		$data['username'] = $this->PM->username($username);
		$data['op'] = $this->PM->operator($T);
		$data['username_menu'] = $this->PM->username_menu($username,$T);
		$data['company'] = $this->PM->company($com);

		$this->load->view('Tax_report_index',$data);
	}

	public function Tax_report_view()
	{
		$Operator = $this->input->post('Operator');
		$lot = $this->input->post('lot');
		$date = date('Y/m/d', strtotime($this->input->post('date')));

		$username = $this->session->userdata('username');
		$company = $this->PM->username($username);
		foreach ($company as $key) {
			$com = $key->company;
		}

		if ($com == 'jam') {
			$T = 'JAM_Restore';
		}
		if ($com == 'jmt') {
			$T = 'JMTLOAN_PROD-Restore';
		}

		if ($com == 'jam') {
			$data['report'] = $this->PM->Tax_jam($Operator,$lot,$date);
		}
		if ($com == 'jmt') {
			$data['report'] = $this->PM->Tax_jmt($Operator,$lot,$date);
		}
		// $text = 'แสดงทุก Operator';
		// print_r($data['report']);

		$data['company'] = $this->PM->company($com);
		foreach ($data['company'] as $key) {
			$data['nameC'] = iconv('tis-620', 'utf-8', $key->name);
			$data['taxno'] = iconv('tis-620', 'utf-8', $key->taxno);
			$data['address'] = iconv('tis-620', 'utf-8', $key->address);
		}
		$data['Operator'] = $Operator;
		$data['date'] = date('m/Y', strtotime($date));	
		
		$this->load->view('Tax_report_view',$data);
	}

	public function model5()
	{
		$username = $this->session->userdata('username');
		$company = $this->PM->username($username);
		foreach ($company as $key) {
			$com = $key->company;
		}

		if ($com == 'jam') {
			$T = 'JAM_Restore';
		}
		if ($com == 'jmt') {
			$T = 'JMTLOAN_PROD-Restore';
		}
		$data['username'] = $this->PM->username($username);
		$data['op'] = $this->PM->operator($T);
		$data['username_menu'] = $this->PM->username_menu($username,$T);
		$data['company'] = $this->PM->company($com);

		$this->load->view('Outstanding_Report_detail_index',$data);
	}

	public function Outstanding_Report_detail_view()
	{
		$Operator = $this->input->post('Operator');
		$lot = $this->input->post('lot');
		$date = date('Y/m/d', strtotime($this->input->post('date')));

		$username = $this->session->userdata('username');
		$company = $this->PM->username($username);
		foreach ($company as $key) {
			$com = $key->company;
		}

		if ($com == 'jam') {
			$T = 'JAM_Restore';
		}
		if ($com == 'jmt') {
			$T = 'JMTLOAN_PROD-Restore';
		}

		if ($com == 'jam') {
			$data['report'] = $this->PM->Outstanding_jam($Operator,$lot,$date);
		}
		if ($com == 'jmt') {
			$data['report'] = $this->PM->Outstanding_jmt($Operator,$lot,$date);
		}
		// $text = 'แสดงทุก Operator';
		// print_r($data['report']);

		$data['company'] = $this->PM->company($com);
		$data['Operator'] = $Operator;
		$data['date'] = date('m/Y', strtotime($date));	
		
		$this->load->view('Outstanding_Report_detail_view',$data);
	}

	public function model6()
	{
		$username = $this->session->userdata('username');
		$company = $this->PM->username($username);
		foreach ($company as $key) {
			$com = $key->company;
		}

		if ($com == 'jam') {
			$T = 'JAM_Restore';
		}
		if ($com == 'jmt') {
			$T = 'JMTLOAN_PROD-Restore';
		}
		$data['username'] = $this->PM->username($username);
		$data['op'] = $this->PM->operator($T);
		$data['username_menu'] = $this->PM->username_menu($username,$T);
		$data['company'] = $this->PM->company($com);

		$this->load->view('Outstanding_Report_index',$data);
	}

	public function Outstanding_Report_view()
	{
		$Operator = $this->input->post('Operator');
		$lot = $this->input->post('lot');
		$date = date('Y/m/d', strtotime($this->input->post('date')));

		$username = $this->session->userdata('username');
		$company = $this->PM->username($username);
		foreach ($company as $key) {
			$com = $key->company;
		}

		if ($com == 'jam') {
			$T = 'JAM_Restore';
		}
		if ($com == 'jmt') {
			$T = 'JMTLOAN_PROD-Restore';
		}

		if ($com == 'jam') {
			$data['report'] = $this->PM->Outstanding_jam($Operator,$lot,$date);
		}
		if ($com == 'jmt') {
			$data['report'] = $this->PM->Outstanding_jmt($Operator,$lot,$date);
		}
		// $text = 'แสดงทุก Operator';
		// print_r($data['report']);

		$data['company'] = $this->PM->company($com);
		$data['Operator'] = $Operator;
		$data['date'] = date('m/Y', strtotime($date));	
		
		$this->load->view('Outstanding_Report_view',$data);
	}

	public function model7()
	{
		$username = $this->session->userdata('username');
		$company = $this->PM->username($username);
		foreach ($company as $key) {
			$com = $key->company;
		}

		if ($com == 'jam') {
			$T = 'JAM_Restore';
		}
		if ($com == 'jmt') {
			$T = 'JMTLOAN_PROD-Restore';
		}
		$data['username'] = $this->PM->username($username);
		$data['op'] = $this->PM->operator($T);
		$data['username_menu'] = $this->PM->username_menu($username,$T);
		$data['company'] = $this->PM->company($com);

		$this->load->view('Export_Excelt_index',$data);
	}

	public function Export_Excelt_view()
	{
		$Operator = $this->input->post('Operator');
		$lot = $this->input->post('lot');
		$datestart = date('Y/m/d', strtotime($this->input->post('datestart')));
		$dateend = date('Y/m/d', strtotime($this->input->post('dateend')));

		$username = $this->session->userdata('username');
		$company = $this->PM->username($username);
		foreach ($company as $key) {
			$com = $key->company;
		}

		if ($com == 'jam') {
			$T = 'JAM_Restore';
		}
		if ($com == 'jmt') {
			$T = 'JMTLOAN_PROD-Restore';
		}

		if ($com == 'jam') {
			$data['report'] = $this->PM->Export_Excelt_jam($Operator,$lot,$datestart,$dateend);
		}
		if ($com == 'jmt') {
			$data['report'] = $this->PM->Export_Excelt_jmt($Operator,$lot,$datestart,$dateend);
		}
		// $text = 'แสดงทุก Operator';
		// print_r($data['report']);

		$data['company'] = $this->PM->company($com);
		$data['Operator'] = $Operator;
		// $data['date'] = date('m/Y', strtotime($date));	
		
		$this->load->view('Export_Excelt_view',$data);
	}

	public function model8()
	{
		$username = $this->session->userdata('username');
		$company = $this->PM->username($username);
		foreach ($company as $key) {
			$com = $key->company;
		}

		if ($com == 'jam') {
			$T = 'JAM_Restore';
		}
		if ($com == 'jmt') {
			$T = 'JMTLOAN_PROD-Restore';
		}
		$data['username'] = $this->PM->username($username);
		$data['op'] = $this->PM->operator($T);
		$data['username_menu'] = $this->PM->username_menu($username,$T);
		$data['company'] = $this->PM->company($com);

		$this->load->view('Daily_updated_index',$data);
	}

	public function Daily_updated_view()
	{
		$status = $this->input->post('status');
		$Operator = $this->input->post('Operator');
		$lot = $this->input->post('lot');
		$datestart = date('Y-m-d', strtotime($this->input->post('datestart')));
		$dateend = date('Y-m-d', strtotime($this->input->post('dateend')));

		$username = $this->session->userdata('username');
		$company = $this->PM->username($username);
		foreach ($company as $key) {
			$com = $key->company;
		}

		if ($com == 'jam') {
			$T = 'JAM_Restore';
		}
		
		if ($com == 'jmt') {
			$T = 'JMTLOAN_PROD-Restore';
		}

		if ($com == 'jam') {
			$data['report'] = $this->PM->Daily_updated_jam($status,$Operator,$lot,$datestart,$dateend);
		}
		if ($com == 'jmt') {
			$data['report'] = $this->PM->Daily_updated_jmt($status,$Operator,$lot,$datestart,$dateend);
		}
		// $text = 'แสดงทุก Operator';
		// print_r($data['report']);

		$data['company'] = $this->PM->company($com);
		$data['Operator'] = $Operator;
		$data['status'] = $status;
		$data['datestart'] = date('d/m/Y', strtotime($datestart));	
		$data['dateend'] = date('d/m/Y', strtotime($dateend));	
		
		$this->load->view('Daily_updated_view',$data);
	}
        
        
      public function Export_Reportsavedata() {
 
        $username = $this->session->userdata('username');
        $data['username'] = $this->PM->username($username);

        $company = $this->PM->username($username);
        foreach ($company as $key) {
            $com = $key->company;
        }
        foreach ($data['username'] as $key) {
            $username_ST = $key->chkPeriod;
        }

        if ($com == 'jam') {
            $T = 'JAM_Restore';
            $DC = 'JAM';
        }
        if ($com == 'jmt') {
            $T = 'JMTLOAN_PROD-Restore';
            $DC = 'JMT';
        }
        $Currentdate = $this->PM->dateserver();
        foreach ($Currentdate as $value) {
            $dateSv = date('m', strtotime($value->Currentdate));
        }

        $data['username_menu'] = $this->PM->username_menu($username, $T);
        $data['Channel'] = $this->PM->payment_channel($T);
        if ($username_ST == 0) {
            $data['company'] = $this->PM->company($com);
            $data['search_view_not'] = $this->PM->search_loadpayment_not_F($username, $T, $DC, $dateSv);
            $data['search_view'] = $this->PM->search_loadpayment_F($username, $T, $DC, $dateSv);
            $data['get_date'] = $this->PM->dateserver();
        }

        if ($username_ST == 1) {
            $data['company'] = $this->PM->company($com);
            $data['search_view_not'] = $this->PM->search_loadpayment_not($username, $T, $DC);
            $data['search_view'] = $this->PM->search_loadpayment($username, $T, $DC);
            $data['get_date'] = $this->PM->dateserver();
        }

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getActiveSheet()->setTitle('ข้อมูลที่บันทึกได้'); //ชื่อหัว
        $objPHPExcel->setActiveSheetIndex(0) //หัวข้อ
                ->setCellValue('A1', 'No')
                ->setCellValue('B1', 'Date')
                ->setCellValue('C1', 'Contract No')
                ->setCellValue('D1', 'IDCard')
                ->setCellValue('E1', 'Channel')
                ->setCellValue('F1', 'Ref No.1')
                ->setCellValue('G1', 'Ref No.2')
                ->setCellValue('H1', 'Amount')
                ->setCellValue('I1', 'Lot')
                ->setCellValue('J1', 'Remark')
                ->setCellValue('K1', 'OSbalance');

        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);  //ปรับความกว่างของช่อง
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(13);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(16);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(13);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(18);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(18);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(13);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(13);

        //ใส่สีหัวข้อ
        $objPHPExcel->getActiveSheet()->getStyle('A1:K1')->applyFromArray(
                array(
                    'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb' => 'B8DBD9')
                    )
                )
        );

        $start2 = 2;


        foreach ($data['search_view'] as $row) {



            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A' . $start2, $row->row)
                    ->setCellValue('B' . $start2, $row->Date1)
                    ->setCellValue('C' . $start2, $row->Agreement)
                    ->setCellValue('D' . $start2, $row->IDCard)
                    ->setCellValue('E' . $start2, iconv('tis-620//IGNORE', 'utf-8//IGNORE', $row->Channel))
                    ->setCellValue('F' . $start2, iconv('tis-620//IGNORE', 'utf-8//IGNORE', $row->Ref1))
                    ->setCellValue('G' . $start2, $row->Ref2)
                    ->setCellValue('H' . $start2, number_format($row->Amount, 02))
                    ->setCellValue('I' . $start2, $row->Lot)
                    ->setCellValue('J' . $start2, $row->Remark)
                    ->setCellValue('K' . $start2, $row->OSbalance);


            // เพิ่มแถวข้อมูล
            $start2++;
        }


        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');  // Excel2007 (xlsx) หรือ Excel5 (xls)         
        $filename = 'ข้อมูลที่บันทึกได้-' . date("dmY") . '.xlsx'; //  กำหนดชือ่ไฟล์ นามสกุล xls หรือ xlsx

        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        ob_end_clean();
        $objWriter->save('php://output'); // ดาวน์โหลดไฟล์รายงาน

        exit;
    }
    
    
        public function Export_ReportNosavedata() {
          
        $username = $this->session->userdata('username');
        $data['username'] = $this->PM->username($username);

        $company = $this->PM->username($username);
        foreach ($company as $key) {
            $com = $key->company;
        }
        foreach ($data['username'] as $key) {
            $username_ST = $key->chkPeriod;
        }

        if ($com == 'jam') {
            $T = 'JAM_Restore';
            $DC = 'JAM';
        }
        if ($com == 'jmt') {
            $T = 'JMTLOAN_PROD-Restore';
            $DC = 'JMT';
        }
        $Currentdate = $this->PM->dateserver();
        foreach ($Currentdate as $value) {
            $dateSv = date('m', strtotime($value->Currentdate));
        }

        $data['username_menu'] = $this->PM->username_menu($username, $T);
        $data['Channel'] = $this->PM->payment_channel($T);
        if ($username_ST == 0) {
            $data['company'] = $this->PM->company($com);
            $data['search_view_not'] = $this->PM->search_loadpayment_not_F($username, $T, $DC, $dateSv);
            $data['search_view'] = $this->PM->search_loadpayment_F($username, $T, $DC, $dateSv);
            $data['get_date'] = $this->PM->dateserver();
        }

        if ($username_ST == 1) {
            $data['company'] = $this->PM->company($com);
            $data['search_view_not'] = $this->PM->search_loadpayment_not($username, $T, $DC);
            $data['search_view'] = $this->PM->search_loadpayment($username, $T, $DC);
            $data['get_date'] = $this->PM->dateserver();
        }

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getActiveSheet()->setTitle('ข้อมูลที่บันทึกไม่ได้'); //ชื่อหัว
        $objPHPExcel->setActiveSheetIndex(0) //หัวข้อ
                ->setCellValue('A1', 'No')
                ->setCellValue('B1', 'Date')
                ->setCellValue('C1', 'Contract No')
                ->setCellValue('D1', 'IDCard')
                ->setCellValue('E1', 'Channel')
                ->setCellValue('F1', 'Ref No.1')
                ->setCellValue('G1', 'Ref No.2')
                ->setCellValue('H1', 'Amount')
                ->setCellValue('I1', 'Lot')
                ->setCellValue('J1', 'Remark')
                ->setCellValue('K1', 'ไม่มี ContractNo IDCard')
                ->setCellValue('L1', 'ไม่มี Channel')
                ->setCellValue('M1', 'Discount ซ้ำ')
                ->setCellValue('N1', 'Date_not');

        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);  //ปรับความกว่างของช่อง
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(13);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(16);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(13);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(18);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(18);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(13);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(15);

        //ใส่สีหัวข้อ
        $objPHPExcel->getActiveSheet()->getStyle('A1:N1')->applyFromArray(
                array(
                    'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb' => 'B8DBD9')
                    )
                )
        );

        $start2 = 2;


        foreach ($data['search_view_not'] as $row) {

            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A' . $start2, $row->row)
                    ->setCellValue('B' . $start2, $row->Date1)
                    ->setCellValue('C' . $start2, $row->Agreement)
                    ->setCellValue('D' . $start2, $row->IDCard)
                    ->setCellValue('E' . $start2, iconv('tis-620//IGNORE', 'utf-8//IGNORE', $row->Channel))
                    ->setCellValue('F' . $start2, iconv('tis-620//IGNORE', 'utf-8//IGNORE', $row->Ref1))
                    ->setCellValue('G' . $start2, $row->Ref2)
                    ->setCellValue('H' . $start2, number_format($row->Amount, 02))
                    ->setCellValue('I' . $start2, $row->Lot)
                    ->setCellValue('J' . $start2, $row->Remark)
                    ->setCellValue('K' . $start2, $row->ContractNo_not)
                    ->setCellValue('L' . $start2, $row->Channel_not)
                    ->setCellValue('M' . $start2, $row->Discount_not)
                    ->setCellValue('N' . $start2, $row->Date_not);
                  

            // เพิ่มแถวข้อมูล
            $start2++;
        }


        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');  // Excel2007 (xlsx) หรือ Excel5 (xls)         
        $filename = 'ข้อมูลที่บันทึกไม่ได้-' . date("dmY") . '.xlsx'; //  กำหนดชือ่ไฟล์ นามสกุล xls หรือ xlsx

        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        ob_end_clean();
        $objWriter->save('php://output'); // ดาวน์โหลดไฟล์รายงาน

        exit;
    }


}
