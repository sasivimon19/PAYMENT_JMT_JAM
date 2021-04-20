<?php
date_default_timezone_set("Asia/Bangkok");
class Export_report extends CI_Controller
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

    // public function Export_DailyReceiveReport()
    // {
    //     $username = $this->session->userdata('username');
    //     $companyses = $this->session->userdata('company');
    //     $data['username'] = $this->PM->username($username, $companyses);

    //     foreach ($data['username'] as $key) {
    //         $com = $key->company;
    //     }

    //     if ($com == 'jam') {
    //         $T = 'JAM';
    //     }
    //     if ($com == 'jmt') {
    //         $T = 'JMTLOAN_PROD';
    //     }

    //     $datestart = trim($this->input->get('datestart'));
    //     $lot = trim($this->input->get('lot'));
    //     $Operator = trim($this->input->get('Operator'));

    //     $op = $Operator;

    //     if ($Operator == '') {
    //         $Operator = "";
    //         $Type = "Many";
    //     } else {
    //         $Operator;
    //         $Type = "One";
    //     }

    //     if ($lot == '') {
    //         $lot = "";
    //     } else {
    //         $lot;
    //     }

    //     $data['daily'] = $this->PM->daily($com, $lot, $Operator, $Type, $datestart);

    //     $objPHPExcel = new PHPExcel();
    //     $objPHPExcel->getActiveSheet()->setTitle('Daily Receive Report'); //ชื่อหัว
    //     $objPHPExcel->setActiveSheetIndex(0) //หัวข้อ
    //         ->setCellValue('A1', 'row')
    //         ->setCellValue('B1', 'rec_date')
    //         ->setCellValue('C1', 'contract_no')
    //         ->setCellValue('D1', 'cus_name')
    //         ->setCellValue('E1', 'id_no')
    //         ->setCellValue('F1', 'amount')
    //         ->setCellValue('G1', 'vatamount')
    //         ->setCellValue('H1', 'Total')
    //         ->setCellValue('I1', 'Chennel')
    //         ->setCellValue('J1', 'lot')
    //         ->setCellValue('K1', 'Opertor');


    //     $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(6);  //ปรับความกว่างของช่อง
    //     $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(23);
    //     $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
    //     $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
    //     $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
    //     $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
    //     $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
    //     $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
    //     $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(18);
    //     $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(13);
    //     $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(13);

    //     //ใส่สีหัวข้อ
    //     $objPHPExcel->getActiveSheet()->getStyle('A1:K1')->applyFromArray(
    //         array(
    //             'fill' => array(
    //                 'type' => PHPExcel_Style_Fill::FILL_SOLID,
    //                 'color' => array('rgb' => 'B8DBD9')
    //             )
    //         )
    //     );

    //     $start2 = 2;

    //     foreach ($data['daily'] as $row) {

    //         // $sumbefore = $row->amount - $row->vatamount;

    //         $objPHPExcel->setActiveSheetIndex(0)
    //             ->setCellValue('A' . $start2, $start2 - 1)
    //             ->setCellValue('B' . $start2, date('d/m/Y', strtotime($row->rec_date)))
    //             ->setCellValueExplicit('C' . $start2, $row->contract_no, PHPExcel_Cell_DataType::TYPE_STRING)
    //             ->setCellValue('D' . $start2, iconv('tis-620//IGNORE', 'utf-8//IGNORE', $row->cus_name))
    //             ->setCellValueExplicit('E' . $start2, $row->id_no, PHPExcel_Cell_DataType::TYPE_STRING)
    //             ->setCellValue('F' . $start2, $row->amount)
    //             ->setCellValue('G' . $start2, $row->vatamount)
    //             ->setCellValue('H' . $start2, $row->amount + $row->vatamount)
    //             ->setCellValue('I' . $start2, $row->chennel)
    //             ->setCellValue('J' . $start2, $row->lot_no)
    //             ->setCellValue('K' . $start2, $row->operator_name);

    //         // เพิ่มแถวข้อมูล
    //         $start2++;
    //     }

    //     $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');  // Excel2007 (xlsx) หรือ Excel5 (xls)         
    //     $filename = 'Daily Receive Report-' . date("dmYHi") . '.xlsx'; //  กำหนดชือ่ไฟล์ นามสกุล xls หรือ xlsx

    //     header('Content-Type: application/vnd.ms-excel'); //mime type
    //     header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
    //     header('Cache-Control: max-age=0'); //no cache
    //     ob_end_clean();
    //     $objWriter->save('php://output'); // ดาวน์โหลดไฟล์รายงาน

    //     exit;
    // }


    public function Export_DailyReceiveReport()
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
            $data['company'] = $this->PM->company($com);
            foreach ($data['company']  as $item) {
                $data['companyname'] = $item->name;
            }


            // $Currentdate = $this->PM->dateserver();
            // foreach ($Currentdate as $value) {
            //     $data['show_date'] = date('d-m-Y', strtotime($value->Currentdate));
            // }


            $datestart = trim($this->input->get('datestart'));
            $data['datestart'] = $this->input->get('datestart');
            $lot = trim($this->input->get('lot'));
            $Operator = trim($this->input->get('Operator'));

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

            $data['daily'] = $this->PM->daily($com, $lot, $Operator, $Type, $datestart);
            foreach ($data['daily'] as $show) {
                $data['rec_date_view'] = $show->rec_date;
            }


            $this->load->view('Export_Report/Excel_Daily_View', $data);
        }
    }


    // public function Export_Summary_Operator_Mounth()
    // {
    //     $username = $this->session->userdata('username');
    //     $companyses = $this->session->userdata('company');
    //     $data['username'] = $this->PM->username($username, $companyses);

    //     foreach ($data['username'] as $key) {
    //         $com = $key->company;
    //     }

    //     if ($com == 'jam') {
    //         $T = 'JAM';
    //     }
    //     if ($com == 'jmt') {
    //         $T = 'JMTLOAN_PROD';
    //     }

    //     $datestartoperator = $this->input->GET('datestartoperatorMonth');
    //     $datestartoperator2 = $this->input->GET('datestartoperatorMonth2');
    //     $lot = $this->input->GET('lotoperatorMonth');
    //     $Operator = $this->input->GET('OperatorMonth');


    //     if ($Operator == '') {
    //         $Operator = "";
    //         $Type = "Many";
    //     } else {
    //         $Operator;
    //         $Type = "One";
    //     }

    //     if ($lot == '') {
    //         $lot = "";
    //     } else {
    //         $lot;
    //     }

    //     $data['receive'] = $this->PM->Summary_receive_OperatorMonth('ReceiveMonth', $com, $lot, $Operator, $Type, $datestartoperator, $datestartoperator2);


    //     $objPHPExcel = new PHPExcel();
    //     $objPHPExcel->getActiveSheet()->setTitle('Summary_Operator_Mounth'); //ชื่อหัว
    //     $objPHPExcel->setActiveSheetIndex(0) //หัวข้อ
    //         ->setCellValue('A1', 'row')
    //         ->setCellValue('B1', 'rec_date')
    //         ->setCellValue('C1', 'contract_no')
    //         ->setCellValue('D1', 'cus_name')
    //         ->setCellValue('E1', 'id_no')
    //         ->setCellValue('F1', 'amount')
    //         ->setCellValue('G1', 'vatamount')
    //         ->setCellValue('H1', 'Total')
    //         ->setCellValue('I1', 'E Balance')
    //         ->setCellValue('J1', 'Chennel')
    //         ->setCellValue('K1', 'Refno2');


    //     $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(6);  //ปรับความกว่างของช่อง
    //     $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(23);
    //     $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
    //     $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
    //     $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
    //     $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
    //     $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
    //     $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
    //     $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(18);
    //     $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(13);
    //     $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(13);

    //     //ใส่สีหัวข้อ
    //     $objPHPExcel->getActiveSheet()->getStyle('A1:K1')->applyFromArray(
    //         array(
    //             'fill' => array(
    //                 'type' => PHPExcel_Style_Fill::FILL_SOLID,
    //                 'color' => array('rgb' => 'B8DBD9')
    //             )
    //         )
    //     );

    //     $start2 = 2;

    //     foreach ($data['receive'] as $row) {

    //         $objPHPExcel->setActiveSheetIndex(0)
    //             ->setCellValue('A' . $start2, $start2 - 1)
    //             ->setCellValue('B' . $start2, date('d/m/Y', strtotime($row->rec_date)))
    //             ->setCellValueExplicit('C' . $start2, $row->contract_no, PHPExcel_Cell_DataType::TYPE_STRING)
    //             ->setCellValue('D' . $start2, iconv('tis-620//IGNORE', 'utf-8//IGNORE', $row->cus_name))
    //             ->setCellValueExplicit('E' . $start2, $row->id_no, PHPExcel_Cell_DataType::TYPE_STRING)
    //             ->setCellValue('F' . $start2,  $row->amount)
    //             ->setCellValue('G' . $start2, $row->vatamount)
    //             ->setCellValue('H' . $start2, $row->amount + $row->vatamount)
    //             ->setCellValue('I' . $start2, $row->e_balance)
    //             ->setCellValue('J' . $start2, $row->chennel)
    //             ->setCellValue('K' . $start2, $row->refno2);

    //         // เพิ่มแถวข้อมูล
    //         $start2++;
    //     }

    //     $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');  // Excel2007 (xlsx) หรือ Excel5 (xls)         
    //     $filename = 'Summary_Operator_Mounth-' . date("dmYHi") . '.xlsx'; //  กำหนดชือ่ไฟล์ นามสกุล xls หรือ xlsx

    //     header('Content-Type: application/vnd.ms-excel'); //mime type
    //     header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
    //     header('Cache-Control: max-age=0'); //no cache
    //     ob_end_clean();
    //     $objWriter->save('php://output'); // ดาวน์โหลดไฟล์รายงาน

    //     exit;
    // }


    public function Export_Summary_Operator_Mounth()
    {
        $username = $this->session->userdata('username');
        $companyses = $this->session->userdata('company');
        $data['username'] = $this->PM->username($username, $companyses);

        foreach ($data['username'] as $key) {
            $com = $key->company;
        }


        $data['company'] = $this->PM->company($com);
        foreach ($data['company']  as $item) {
            $data['companyname'] = $item->name;
        }

        if ($com == 'jam') {
            $T = 'JAM';
        }
        if ($com == 'jmt') {
            $T = 'JMTLOAN_PROD';
        }

        $datestartoperator = $this->input->GET('datestartoperatorMonth');
        $datestartoperator2 = $this->input->GET('datestartoperatorMonth2');
        $lot = $this->input->GET('lotoperatorMonth');
        $Operator = $this->input->GET('OperatorMonth');

        $data['datestartoperator'] = $this->input->GET('datestartoperatorMonth');
        $data['datestartoperator2'] = $this->input->GET('datestartoperatorMonth2');


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

        $data['receive'] = $this->PM->Summary_receive_OperatorMonth('ReceiveMonth', $com, $lot, $Operator, $Type, $datestartoperator, $datestartoperator2);
        foreach ($data['receive'] as $show) {
            $data['rec_date_view'] = $show->rec_date;
        }


        $this->load->view('Export_Report/Export_Receive_operator_month', $data);
    }






    public function Export_Summary_Channel_Daily()
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

        $data['company'] = $this->PM->company($com);
        foreach ($data['company']  as $item) {
            $data['companyname'] = $item->name;
        }

        $datestart = $this->input->get('datestart');
        $data['datestart'] = $this->input->get('datestart');
        $Operator = $this->input->get('Operator');

        if ($Operator == '') {
            $Operator = "";
            $Type = "Many";
        } else {
            $Operator;
            $Type = "One";
        }

        $data['receive'] = $this->PM->SUM_REPROT_BY_CHENNEL('ReceiveChanelDaily', $com, $Operator, $Type, $datestart);

        $this->load->view('Export_Report/Excel_report_Channel', $data);
    }




    public function Export_Summary_Operator_Daily()
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
            $data['company'] = $this->PM->company($com);
            foreach ($data['company']  as $item) {
                $data['companyname'] = $item->name;
            }

            $datestartoperator =  $this->input->get('datestart');
            $data['datestartoperator'] =  $this->input->get('datestart');
            $Operator = $this->input->get('Operatordaily');

            if ($Operator == '') {
                $Operator = "";
                $Type = "Many";
            } else {
                $Operator;
                $Type = "One";
            }

            $data['receive'] = $this->PM->SUM_REPROT_BY_PROCUCT('ReceiveProductDaily', $com, $Operator, $Type, $datestartoperator);


            $this->load->view('Export_Report/Excel_PROCUCT_Daily', $data);
        }
    }



    public function Excel_Summary_Discount_Report()
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
            $data['company'] = $this->PM->company($com);
            foreach ($data['company']  as $item) {
                $data['companyname'] = $item->name;
            }

            $status = $this->input->get('status');
            $Operator = $this->input->get('Operator');
            $lot = $this->input->get('lot');
            $date = date('Y/m/d', strtotime($this->input->get('date')));
            $data['datestartoperator'] = date('Y/m/d', strtotime($this->input->get('date')));

            if (
                $lot == ''
            ) {
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


            $this->load->view('Export_Report/Excel_SummaryDiscount_Report', $data);
        }
    }

    public function Export_Excel()
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
            $data['company'] = $this->PM->company($com);

            $Operator = $this->input->get('Operator');
            $lot = $this->input->get('lot');
            $datestart = date('Y/m/d', strtotime($this->input->get('datestart')));
            $dateend = date('Y/m/d', strtotime($this->input->get('dateend')));

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

            $this->load->view('Export_Report/Export_Excelt_Ex', $data);
        }
    }



    public function ExportTaxReport()
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
            $data['company'] = $this->PM->company($com);

            $Operator = $this->input->get('Operator');
            $lot = $this->input->get('lot');
            $date = date('Y/m/d', strtotime($this->input->get('date')));
            $dateend2 = date('Y/m/d', strtotime($this->input->get('dateend2')));

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


            $this->load->view('Export_Report/Export_TaxReport', $data);
        }
    }


    public function ExportSumTaxReport()
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
            $data['company'] = $this->PM->company($com);


            $Operator = $this->input->get('Operator');
            $lot = $this->input->get('lot');
            $date = date('Y-m-d', strtotime($this->input->get('date')));
            $dateendsumtex = date('Y-m-d', strtotime($this->input->get('dateendsumtex')));

            if ($Operator == '') {
                $Operator = "";
                $Type = "Many";
            } else {
                $Operator;
                $Type = "One";
            }
            if (
                $lot == ''
            ) {
                $lot = "";
            } else {
                $lot;
            }

            $data['report'] = $this->PM->SumTax_report($com, $lot, $Operator, $Type, $date, $dateendsumtex);

            $this->load->view('Export_Report/Excel_SumTaxreport', $data);
        }
    }


    public function Export_Excel_Daily_updated()
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
            $data['company'] = $this->PM->company($com);

         echo"<br>".   $status = $this->input->get('status');
            echo "<br>" .     $Operator = $this->input->get('Operator');
            echo "<br>" .     $datestart = date('Y-m-d', strtotime($this->input->get('datestart')));
            echo "<br>" .     $dateend = date('Y-m-d', strtotime($this->input->get('dateend')));

            if ($Operator == '') {
                $Operator = "";
                $Type = "Many";
            } else {
                $Operator;
                $Type = "One";
            }

            $data['report'] = $this->PM->Daily_updated($com, $Operator, $Type, $datestart, $dateend, $status);

               echo "<br>". "EXEC [dbo].[SP_REPORT_PAYMENT_SYSTEM] 'EditDaily','$com',NULL,'$Operator','$Type','$datestart','$dateend','$status',0,0";

            // $this->load->view('Export_Report/Excel_Daily_updated', $data);
        }
    }


    public function Export_Outstanding_Report_Detail()
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
            $data['company'] = $this->PM->company($com);

            $Operator = $this->input->get('Operator');
            $lot = $this->input->get('lot');
            $date = date('Y/m/d', strtotime($this->input->get('datedetail')));

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

            $data['report'] = $this->PM->Total_Outstanding_Detail($com, $lot, $Operator, $Type, $date);
            // echo "EXEC [dbo].[SP_REPORT_PAYMENT_SYSTEM_TEST] 'TotalOutstanding','$com','$lot','$Operator','$Type','$date',NULL,'NULL',0,0";
            $this->load->view('Export_Report/Outstanding_Detail', $data);
        }
    }



    public function ExportTaxInvoice()
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
            $data['company'] = $this->PM->company($com);

            $Operator = $this->input->get('Operator');
            $lot = $this->input->get('lot');
            $datestart = date('Y-m-d', strtotime($this->input->get('datestart')));
            $dateend = date('Y-m-d', strtotime($this->input->get('dateend')));

            if (
                $lot == ''
            ) {
                $lot = "";
            } else {
                $lot;
            }
            $data['report'] = $this->PM->EXPORT_TAX_INVOICE('TAX_INVOICE', $lot, $Operator, $datestart, $dateend, $T);
            $this->load->view('Export_Report/Export_TaxInvoiec', $data);
        }
    }



    public function ExportInvoice()
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
            $data['company'] = $this->PM->company($com);


            $Operator = $this->input->get('Operator');
            $lot = $this->input->get('lot');
            $datestart = date('Y-m-d', strtotime($this->input->get('datestart')));
            $dateend = date('Y-m-d', strtotime($this->input->get('dateend')));

            if (
                $lot == ''
            ) {
                $lot = "";
            } else {
                $lot;
            }
            $data['report'] = $this->PM->EXPORT_TAX_INVOICE('INVOICE', $lot, $Operator, $datestart, $dateend, $T);

            $this->load->view('Export_Report/Export_Invoice_view', $data);
        }
    }




    public function Export_Summary_Outstanding()
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
            $data['company'] = $this->PM->company($com);

            $Operator = $this->input->get('Operator');
            $lot = $this->input->get('lot');
            $date = date('Y/m/d', strtotime($this->input->get('date')));

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

            $this->load->view('Export_Report/Excel_SumOutstanding', $data);
        }
    }



    public function Export_Reportsavedata()
    {

        $username = $this->session->userdata('username');
        $companyses = $this->session->userdata('company');

        $Subject_Right = $this->session->userdata('Subject_Right');
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

        $Currentdate = $this->PM->dateserver();
        foreach ($Currentdate as $value) {
            $dateSv = date('m', strtotime($value->Currentdate));
        }

        $start = 0;
        $pageend = 150;

        $data['username_menu'] = $this->PM->username_menu($T, $username);
        $data['channel'] = $this->PM->payment_channel($T);


        // $data['search_view_true'] = $this->PM->search_loadpayment_not_F($username_ST, $username, $T, $start, $pageend, 'TOTALTRUE');
        $data['search_view_count_TOTALTRUE'] = $this->PM->search_loadpayment_not_F($username_ST, $username, $T, 0, 0, 'TOTALTRUE');
        //  $data['search_view_count'] = $this->PM->search_loadpayment_not_F($username_ST, $username, $T, 0, 0, 'TRUE_COUNT');


        // echo"EXEC [dbo].[SP_TBL_Check_Date] '$username_ST','$username','$T',0,0,'TOTALTRUE'";


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
            ->setCellValue('J1', 'operator_name')
            ->setCellValue('K1', 'Remark')
            ->setCellValue('L1', 'e_balance');

        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);  //ปรับความกว่างของช่อง
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(13);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(18);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(16);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(13);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(18);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(18);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(13);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(13);
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(13);

        //ใส่สีหัวข้อ
        $objPHPExcel->getActiveSheet()->getStyle('A1:L1')->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'B8DBD9')
                )
            )
        );

        $objPHPExcel->getDefaultStyle()
            ->getAlignment()
            ->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP)
            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);


        $start2 = 2;
        foreach ($data['search_view_count_TOTALTRUE'] as $row) {
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A' . $start2, $row->row)
                ->setCellValue('B' . $start2, date('d/m/Y', strtotime($row->Date1)))
                ->setCellValueExplicit('C' . $start2, $row->Agreement, PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValueExplicit('D' . $start2, $row->IDCard, PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValue('E' . $start2, iconv('tis-620//IGNORE', 'utf-8//IGNORE', $row->Channel))
                ->setCellValue('F' . $start2, iconv('tis-620//IGNORE', 'utf-8//IGNORE', $row->Ref1))
                ->setCellValue('G' . $start2, $row->Ref2)
                ->setCellValue('H' . $start2, $row->Amount)
                ->setCellValue('I' . $start2, $row->Lot)
                ->setCellValue('J' . $start2, $row->operator_name)
                ->setCellValue('K' . $start2, $row->Remark)
                ->setCellValue('L' . $start2, $row->e_balance);

            $objPHPExcel->getActiveSheet()
                ->getStyle('H' . $start2, number_format($row->Amount, 02))
                ->getAlignment()
                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

            $objPHPExcel->getActiveSheet()
                ->getStyle('K' . $start2, $row->e_balance)
                ->getAlignment()
                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);


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


    public function Export_ReportNosavedata()
    {

        $username = $this->session->userdata('username');
        $companyses = $this->session->userdata('company');

        $Subject_Right = $this->session->userdata('Subject_Right');
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

        $Currentdate = $this->PM->dateserver();
        foreach ($Currentdate as $value) {
            $dateSv = date('m', strtotime($value->Currentdate));
        }

        $start = 0;
        $pageend = 100;

        $data['username_menu'] = $this->PM->username_menu($T, $username);
        $data['Channel'] = $this->PM->payment_channel($T);

        $data['company'] = $this->PM->company($com);
        $data['get_date'] = $this->PM->dateserver();

        // $data['search_view_not'] = $this->PM->search_loadpayment_not_F($username_ST, $username, $T, $start, $pageend, 'TOTALFALSE');
        // $data['search_view_not'] = $this->PM->search_loadpayment_not_F($username_ST, $username, $T, 0, 0, 'TOTALFALSE');
        $data['search_view_count_TOTALFALSE'] = $this->PM->search_loadpayment_not_F($username_ST, $username, $T, 0, 0, 'TOTALFALSE');


        echo "";

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
            ->setCellValue('J1', 'operator_name')
            ->setCellValue('K1', 'Remark')
            ->setCellValue('L1', 'ไม่มี ContractNo IDCard')
            ->setCellValue('M1', 'ไม่มี Channel')
            ->setCellValue('N1', 'Discount ซ้ำ')
            ->setCellValue('O1', 'Date_not');

        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);  //ปรับความกว่างของช่อง
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(13);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(16);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(13);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(18);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(18);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(23);
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(15);
        //ใส่สีหัวข้อ
        $objPHPExcel->getActiveSheet()->getStyle('A1:O1')->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'B8DBD9')
                )
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle('K1:N1')->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'ff0000')
                )
            )
        );

        $start2 = 2;


        foreach ($data['search_view_count_TOTALFALSE'] as $row) {

            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A' . $start2, $row->row)
                ->setCellValue('B' . $start2, date('d/m/Y', strtotime($row->Date1)))
                ->setCellValueExplicit('C' . $start2, $row->Agreement, PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValueExplicit('D' . $start2, $row->IDCard, PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValue('E' . $start2, iconv('tis-620//IGNORE', 'utf-8//IGNORE', $row->Channel))
                ->setCellValue('F' . $start2, iconv('tis-620//IGNORE', 'utf-8//IGNORE', $row->Ref1))
                ->setCellValue('G' . $start2, $row->Ref2)
                ->setCellValue('H' . $start2, $row->Amount)
                ->setCellValue('I' . $start2, $row->Lot)
                ->setCellValue('J' . $start2, $row->operator_name)
                ->setCellValue('K' . $start2, $row->Remark)
                ->setCellValue('L' . $start2, $row->ContractNo_not)
                ->setCellValue('M' . $start2, $row->Channel_not)
                ->setCellValue('N' . $start2, $row->Discount_not)
                ->setCellValue('O' . $start2, $row->Date_not);

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

    public function Export_ALLReport()
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
            $data['company'] = $this->PM->company($com);
            foreach ($data['company']  as $item) {
                $data['companyname'] = $item->name;
            }


            $Currentdate = $this->PM->dateserver();
            foreach ($Currentdate as $value) {
                $data['show_date'] = date('d-m-Y', strtotime($value->Currentdate));
            }


            // $datestart = trim($this->input->get('datestart'));
            // $lot = trim($this->input->get('lot'));
            // $Operator = trim($this->input->get('Operator'));

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

                $status = $this->input->get("statusview");
                $data['statusview'] = $this->input->get("statusview");
                // $count = $this->input->get("count");
                // $Sum = $this->input->get("Sum");
            } else {

                $status = $this->input->get("status");
                $data['statusview'] = $this->input->get("status");
                // $count = "count" . $status;
                // $Sum =  $status . "Sum";
            }


            $data['search_view'] = $this->PM->Export_Select_Approve($status, $username, $datestart, $dateend, $contract_no, $Operatorname, $T);
            // echo "<br>" . "EXEC [dbo].[SP_EXPORT_PAYMENT] '$status', '$username','$datestart', '$dateend', '$contract_no','$Operatorname','$T'";
            $this->load->view('Export_Report/Export_ReportAll', $data);
        }
    }


    public function Export_Report_One()
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
            $data['company'] = $this->PM->company($com);
            foreach ($data['company']  as $item) {
                $data['companyname'] = $item->name;
            }


            $Currentdate = $this->PM->dateserver();
            foreach ($Currentdate as $value) {
                $data['show_date'] = date('d-m-Y', strtotime($value->Currentdate));
            }


            $datestart = trim($this->input->get('datestart'));
            $lot = trim($this->input->get('lot'));
            $Operator = trim($this->input->get('Operator'));

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


            $Operatorname = $this->input->get("Operator");

            if ($Operatorname == "") {
                $Operatorname = "";
            } else {
                $Operatorname;
            }

            $contract_no = $this->input->get("idcustomer");
            $datestart = $this->input->get("datestart");
            $dateend = $this->input->get("dateend");
            $status = $this->input->get("statusview");


            if ($status == "") {
                $status = $this->input->get("statusview");
                $data['statusview'] = $this->input->get("statusview");
                // $count = $this->input->get("count");
                // $Sum = $this->input->get("Sum");
            } else {
                $status = $this->input->get("status");
                $statusview = $this->input->get("statusview");
                $data['statusview'] = $this->input->get("statusview");
                // $count = "count" . $status;
                // $Sum =  $status . "Sum";
            }

            $data['search_view'] = $this->PM->Export_Select_Approve($statusview, $username, $datestart, $dateend, $contract_no, $Operatorname, $T);

         

            // echo "<br>" . "EXEC [dbo].[SP_EXPORT_PAYMENT] '$statusview', '$username','$datestart', '$dateend', '$contract_no','$Operatorname','$T'";

            $this->load->view('Export_Report/Export_Receive', $data);
        }
    }
}
