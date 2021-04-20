<?php
date_default_timezone_set("Asia/Bangkok");
defined('BASEPATH') or exit('No direct script access allowed');

class Call_LoadNewport extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Import_model');
        $this->load->model('Newport_data');
        $this->load->model('Loadportmodels');
        $this->load->model('Payment_model', 'PM');
        $this->load->helper('url', 'form', 'html', 'file');
        $this->load->library(array('session', 'form_validation', 'upload'));
        $this->load->database();
        $this->load->library('excel');
        ini_set('memory_limit', '-1');
    }


    public function index()
    {
        if ($this->session->userdata('IDEmp') == '') {
            redirect('Call_Login/');
        } else {
            $this->load->view('inc_page/header');
            $this->load->view('importdata');
        }
    }

    public function Load_Newport()
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

        $data['get_Tmp_customer_True'] = $this->Loadportmodels->Select_Tmp_customer_True($T,$username);
        $data['get_Tmp_customer_FALSE'] = $this->Loadportmodels->Select_Tmp_customer_FALSE($T,$username);

        $data['Showoperaton'] = $this->Loadportmodels->Get_operaton();


        $data['Main_Homepayment'] = "EIR_Jmt_Finish/Load_Newport";
        $this->load->view('Homepayment', $data);
    }
 }

    public function ImportExcel_Loadport()
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

        $data['username_menu'] = $this->PM->username_menu($username, $T);

        $this->Loadportmodels->Delete_Tmp_Customer($username);

        $this->PM->delete_simulate($username, $T);
        $data['company'] = $this->PM->company($com);

        $this->load->library('Excel');
        if (isset($_FILES["Fileload"]["name"])) {

            $path = $_FILES["Fileload"]["tmp_name"];
            $object = PHPExcel_IOFactory::load($path);


            $column = $object->getActiveSheet()->getHighestDataColumn();
            $colNumber = PHPExcel_Cell::columnIndexFromString($column);



            if ($colNumber != 18) {
                echo "false";
            } else {

                foreach ($object->getWorksheetIterator() as $worksheet) {

                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();

                    for ($row = 2; $row <= $highestRow; $row++) {
                        $insertloadport = array(
                            'contract_no' => $worksheet->getCellByColumnAndRow(0, $row)->getValue(),
                            'id_no' => $worksheet->getCellByColumnAndRow(1, $row)->getValue(),
                            'product' => $worksheet->getCellByColumnAndRow(2, $row)->getValue(),
                            'portname' => $worksheet->getCellByColumnAndRow(3, $row)->getValue(),
                            'cus_name' => trim(iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $worksheet->getCellByColumnAndRow(4, $row)->getValue())),
                            'address1' => trim(iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $worksheet->getCellByColumnAndRow(5, $row)->getValue())),
                            'address2' => trim(iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $worksheet->getCellByColumnAndRow(6, $row)->getValue())),
                            'province' => trim(iconv('UTF-8//IGNORE', 'TIS-620//IGNORE', $worksheet->getCellByColumnAndRow(7, $row)->getValue())),
                            'postal' => $worksheet->getCellByColumnAndRow(8, $row)->getValue(),
                            'b_balance' => $worksheet->getCellByColumnAndRow(9, $row)->getValue(),
                            'e_balance' => $worksheet->getCellByColumnAndRow(10, $row)->getValue(),
                            'lot_no' => $worksheet->getCellByColumnAndRow(11, $row)->getValue(),
                            'operator_id' => $worksheet->getCellByColumnAndRow(12, $row)->getValue(),
                            'contract_no2' => $worksheet->getCellByColumnAndRow(13, $row)->getValue(),
                            'id_no2' => $worksheet->getCellByColumnAndRow(14, $row)->getValue(),
                            'status' => $worksheet->getCellByColumnAndRow(15, $row)->getValue(),
                            'DateUpload' => date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($worksheet->getCellByColumnAndRow(16, $row)->getValue())),
                            'company' => $worksheet->getCellByColumnAndRow(17, $row)->getValue(),
                        );
                        $this->Loadportmodels->Tmp_customer_insert($T,$insertloadport, $username);
                    }
                }
                $data['get_Tmp_customer_True'] = $this->Loadportmodels->Select_Tmp_customer_True($T,$username);
                $data['get_Tmp_customer_FALSE'] = $this->Loadportmodels->Select_Tmp_customer_FALSE($T,$username);


                $this->load->view('Eir_Jmt_Finish/Loadprotdatasave', $data);
            }
        }
    }
 }
    public function Update_Customer()
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
        $data['username_menu'] = $this->PM->username_menu($username, $T);

        $ALLproduct = trim(iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $this->input->POST('Product')));
        $product = (explode(",",   $ALLproduct));
        $portname = trim(iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $this->input->POST('portname')));
        $lot_no = trim(iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $this->input->POST('lot_no')));
        $operator_id = trim(iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $this->input->POST('operatorid')));
        $company = trim(iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $this->input->POST('company')));
        $DateUpload = date('Y-m-d', strtotime($this->input->POST('DateUpload')));


        $data['get_Tmp_customer_True'] = $this->Loadportmodels->Select_Tmp_customer_True($T,$username);
        foreach ($data['get_Tmp_customer_True'] as $r) {
            $Updatecustomer = array(
                'contract_no' => trim(iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->contract_no)),
                'id_no' => trim(iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->id_no)),
                'product' => $product[0],
                'portname' =>  $portname,
                'lot_no' => $lot_no,
                'operator_id' =>  $operator_id,
                'company' => $company,
                'DateUpload' => $DateUpload,
            );

            $this->Loadportmodels->UpdateCustomer($Updatecustomer, $username);
        }

        $data['get_Tmp_customer_True'] = $this->Loadportmodels->Select_Tmp_customer_True($T,$username);
        $data['get_Tmp_customer_FALSE'] = $this->Loadportmodels->Select_Tmp_customer_FALSE($T,$username);

        $this->load->view('Eir_Jmt_Finish/Loadprotdatasave', $data);
    }
 }


    public function Insert_Customer()
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
            $data['username_menu'] = $this->PM->username_menu($username, $T);


            // $data['get_Tmp_customer_True'] = $this->Loadportmodels->Select_Tmp_customer_True($username);
            // foreach ($data['get_Tmp_customer_True'] as $r) {
            //     $rescustomer = array(
            //         'contract_no' => trim(iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->contract_no)),
            //         'id_no' => trim(iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->id_no)),
            //         'product' => trim(iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->product)),
            //         'cus_name' => trim($r->cus_name),
            //         'address1' =>  trim($r->address1),
            //         'address2' =>   trim(iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->address2)),
            //         'province' =>   trim(iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->province)),
            //         'postal' =>  trim(iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->postal)),
            //         'b_balance' =>   trim(iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->b_balance)),
            //         'e_balance' =>  trim(iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->e_balance)),
            //         'lot_no' => trim(iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->lot_no)),
            //         'operator_id' =>  trim(iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->operator_id)),
            //         'contract_no2' =>  trim(iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->contract_no2)),
            //         'id_no2' => trim(iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->id_no2)),
            //         'status' =>  trim(iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->status)),
            //         'company' => trim(iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->company)),
            //         'DateUpload' => trim(iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r->DateUpload)),
            //     );



            $this->Loadportmodels->InsertCustomer($username);
            $this->Loadportmodels->Delete_Tmp_Customer($username);
            // }


            $this->load->view('Eir_Jmt_Finish/Loadprotdatasave', $data);
        }
    }

    public function Delete_Tmp_Customer()
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
        $data['username_menu'] = $this->PM->username_menu($username, $T);

        $this->Loadportmodels->Delete_operator($username);
    }
}

    public function Select_operator_value()
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
        $data['username_menu'] = $this->PM->username_menu($username, $T);
        $operatorname = $this->input->get('portname');
        $Allport = $this->input->get('portname2');
        $allcut = (explode(",", $Allport));
        // $operatorname = $allcut[0];
        $id =   $this->input->get('id');

        // product
        if ($id == '1') {
            $checkoperatorvalue = $this->Loadportmodels->Get_operator_value($operatorname);
            $result = array();
            foreach ($checkoperatorvalue as $r) {
                $result[] = array(
                    'operator_value' => iconv('TIS-620//ignore', 'UTF-8//ignore', $r->operator_value),
                    'operator_name' => iconv('TIS-620//ignore', 'UTF-8//ignore', $r->operator_name),

                );
            }
            // echo json_encode($result);
        }
        if ($id == '2') {
            $checkoperatorvalue = $this->Loadportmodels->Get_operator_id($allcut[1], $allcut[0]);
            $result = array();
            foreach ($checkoperatorvalue as $r) {
                $result[] = array(
                    'operator_id' => iconv('TIS-620//ignore', 'UTF-8//ignore', $r->operator_id),

                );
            }
        }
        echo json_encode($result);
    }
}


    public function Export_Loadnewport_True()
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
        $data['username_menu'] = $this->PM->username_menu($username, $T);

        $data['get_Tmp_customer_True'] = $this->Loadportmodels->Select_Tmp_customer_True($T,$username);

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getActiveSheet()->setTitle('ข้อมูลที่บันทึกไม่ได้'); //ชื่อหัว
        $objPHPExcel->setActiveSheetIndex(0) //หัวข้อ
            ->setCellValue('A1', 'No')
            ->setCellValue('B1', 'contract_no')
            ->setCellValue('C1', 'id_no')
            ->setCellValue('D1', 'product')
            ->setCellValue('E1', 'cus_name')
            ->setCellValue('F1', 'address1')
            ->setCellValue('G1', 'address2')
            ->setCellValue('H1', 'province')
            ->setCellValue('I1', 'postal')
            ->setCellValue('J1', 'b_balance')
            ->setCellValue('K1', 'e_balance')
            ->setCellValue('L1', 'lot_no')
            ->setCellValue('M1', 'operator_id')
            ->setCellValue('N1', 'contract_no2')
            ->setCellValue('O1', 'id_no2')
            ->setCellValue('P1', 'status')
            ->setCellValue('Q1', 'DateUpload')
            ->setCellValue('R1', 'company');


        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);  //ปรับความกว่างของช่อง
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(120);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(120);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(30);


        //ใส่สีหัวข้อ
        $objPHPExcel->getActiveSheet()->getStyle('A1:R1')->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'B8DBD9')
                )
            )
        );

        $start2 = 2;


        foreach ($data['get_Tmp_customer_True'] as $row) {

            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A' . $start2, $row->row)
                ->setCellValueExplicit('B' . $start2, $row->contract_no, PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValueExplicit('C' . $start2, $row->id_no, PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValue('D' . $start2, iconv('tis-620//IGNORE', 'utf-8//IGNORE', $row->product))
                ->setCellValue('E' . $start2, iconv('tis-620//IGNORE', 'utf-8//IGNORE', $row->cus_name))
                ->setCellValue('F' . $start2, iconv('tis-620//IGNORE', 'utf-8//IGNORE', $row->address1))
                ->setCellValue('G' . $start2, iconv('tis-620//IGNORE', 'utf-8//IGNORE', $row->address2))
                ->setCellValue('H' . $start2, $row->province)
                ->setCellValue('I' . $start2, $row->postal)
                ->setCellValue('J' . $start2, $row->b_balance)
                ->setCellValue('K' . $start2, $row->e_balance)
                ->setCellValue('L' . $start2, $row->lot_no)
                ->setCellValue('M' . $start2, $row->operator_id)
                ->setCellValueExplicit('N' . $start2, $row->contract_no2, PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValueExplicit('O' . $start2, $row->id_no2, PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValue('P' . $start2, $row->status)
                ->setCellValue('Q' . $start2, $row->DateUpload)
                ->setCellValue('R' . $start2, $row->company);

            // เพิ่มแถวข้อมูล
            $start2++;
        }


        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');  // Excel2007 (xlsx) หรือ Excel5 (xls)         
        $filename = 'รายการที่สามารถบันทึกข้อมูลได้-' . date("dmY") . '.xlsx'; //  กำหนดชือ่ไฟล์ นามสกุล xls หรือ xlsx

        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        ob_end_clean();
        $objWriter->save('php://output'); // ดาวน์โหลดไฟล์รายงาน

        exit;
    }
}
    public function Export_Loadnewport_FALSE()
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
        $data['username_menu'] = $this->PM->username_menu($username, $T);

        $data['get_Tmp_customer_FALSE'] = $this->Loadportmodels->Select_Tmp_customer_FALSE($T,$username);

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getActiveSheet()->setTitle('ข้อมูลที่บันทึกไม่ได้'); //ชื่อหัว
        $objPHPExcel->setActiveSheetIndex(0) //หัวข้อ
            ->setCellValue('A1', 'No')
            ->setCellValue('B1', 'contract_no')
            ->setCellValue('C1', 'id_no')
            ->setCellValue('D1', 'product')
            ->setCellValue('E1', 'cus_name')
            ->setCellValue('F1', 'address1')
            ->setCellValue('G1', 'address2')
            ->setCellValue('H1', 'province')
            ->setCellValue('I1', 'postal')
            ->setCellValue('J1', 'b_balance')
            ->setCellValue('K1', 'e_balance')
            ->setCellValue('L1', 'lot_no')
            ->setCellValue('M1', 'operator_id')
            ->setCellValue('N1', 'contract_no2')
            ->setCellValue('O1', 'id_no2')
            ->setCellValue('P1', 'status')
            ->setCellValue('Q1', 'DateUpload')
            ->setCellValue('R1', 'company')
            ->setCellValue('S1', 'ContractNonot');


        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);  //ปรับความกว่างของช่อง
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(120);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(120);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(30);

        //ใส่สีหัวข้อ
        $objPHPExcel->getActiveSheet()->getStyle('A1:S1')->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'B8DBD9')
                )
            )
        );


        $start2 = 2;

        foreach ($data['get_Tmp_customer_FALSE'] as $row) {


            if ($row->ContractNonot == "") {
                $A = "เลขที่สัญญาซ้ำในระบบ";
            } else {
                $A = $row->ContractNonot;
            }

            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A' . $start2, $row->row)
                ->setCellValueExplicit('B' . $start2, $row->contract_no, PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValueExplicit('C' . $start2, $row->id_no, PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValue('D' . $start2, iconv('tis-620//IGNORE', 'utf-8//IGNORE', $row->product))
                ->setCellValue('E' . $start2, iconv('tis-620//IGNORE', 'utf-8//IGNORE', $row->cus_name))
                ->setCellValue('F' . $start2, iconv('tis-620//IGNORE', 'utf-8//IGNORE', $row->address1))
                ->setCellValue('G' . $start2, iconv('tis-620//IGNORE', 'utf-8//IGNORE', $row->address2))
                ->setCellValue('H' . $start2, $row->province)
                ->setCellValue('I' . $start2, $row->postal)
                ->setCellValue('J' . $start2, $row->b_balance)
                ->setCellValue('K' . $start2, $row->e_balance)
                ->setCellValue('L' . $start2, $row->lot_no)
                ->setCellValue('M' . $start2, $row->operator_id)
                ->setCellValueExplicit('N' . $start2, $row->contract_no2, PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValueExplicit('O' . $start2, $row->id_no2, PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValue('P' . $start2, $row->status)
                ->setCellValue('Q' . $start2, $row->DateUpload)
                ->setCellValue('R' . $start2, $row->company)
                ->setCellValue('S' . $start2, $A);

            // เพิ่มแถวข้อมูล
            $start2++;
        }




        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');  // Excel2007 (xlsx) หรือ Excel5 (xls)         
        $filename = 'รายการที่ไม่สามารถบันทึกข้อมูลได้-' . date("dmY") . '.xlsx'; //  กำหนดชือ่ไฟล์ นามสกุล xls หรือ xlsx

        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        ob_end_clean();
        $objWriter->save('php://output'); // ดาวน์โหลดไฟล์รายงาน

        exit;
    }
}

}