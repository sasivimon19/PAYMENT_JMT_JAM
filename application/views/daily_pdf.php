<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once APPPATH."libraries/mpdf/mpdf.php";

?>
<html>
<head> 
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>css/1.css">
  <script type = 'text/javascript' src = "<?php echo base_url(); ?>js/js.js"></script>
  <link href="<?php echo base_url(); ?>assets/DataTables/DataTables-1.10.18/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"> 
  <script src="<?php echo base_url(); ?>assets/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">

  <style>
    .td {
      padding: 5px; 
    }
    th{
      font-size: 1.2em;
    }
  </style>
</head>
<body>
  <div style="width: 100%;">

    <p style="text-align: center;font-size: 1.3em;">
      <?php foreach ($op as $data) { 
        echo iconv('tis-620', 'utf-8', $data->operator_name); 
      }?>   
    </p>
    <p style="text-align: center;font-size: 1.3em;">
      <?php foreach ($company as $data) { 
        echo iconv('tis-620', 'utf-8', $data->name); 
      }?>   
    </p>
    <p style="text-align: center;font-size: 1.5em;">
      <span>Daily Receive Report</span><br/>
      <span>For the month <?php echo date('d-m-Y', strtotime($date)); ?></span>
    </p>

  </div>
  <table class="table" style="font-size: 1.1em;width: 100%;">
    <thead>
      <tr>
        <th style="text-align: left;"><u>Rec Date</u></th>
        <th style="text-align: left;"><u>Contract No</u></th>
        <th style="text-align: left;"><u>Cus Name</u></th>
        <th style="text-align: right;"><u>Amount</u></th>
        <th style="text-align: right;"><u>Vatamount</u></th>
        <th style="text-align: right;"><u>Total</u></th>
        <th style="text-align: right"><u>Chennel</u></th>
        <th style="text-align: center;"><u>Lot no</u></th>
        <th style="text-align: center;"><u>Opertor</u></th>
      </tr>
    </thead>
    <tbody>
      <?php $ss = 0; ?>
      <?php $num = 1; foreach ($CN as $row) { ?>
        <?php $num_amount = 0; ?> 
        <?php $num_vatamount = 0; ?> 

        <?php $no = 1; foreach ($daily as $key) { ?>          
          <?php if ($key->chennel == $row->code) { ?>

            <tr>
              <td class="td"><?php echo date('d-m-Y', strtotime($key->rec_date)); ?></td>
              <td class="td"><?php echo $key->contract_no; ?></td>
              <td class="td"><?php echo iconv('tis-620', 'utf-8', $key->cus_name); ?></td>
              <td class="td" style="text-align: right;"><?php echo number_format($key->amount,2); ?></td>
              <td class="td" style="text-align: right;"><?php echo number_format($key->vatamount,2); ?></td>
              <td class="td" style="text-align: right;"><?php echo number_format($key->amount+$key->vatamount,2); ?></td>
              <td class="td" style="text-align: right;"><?php echo $key->chennel; ?></td>
              <td class="td" style="text-align: center;"><?php echo $key->lot_no; ?></td>
              <td class="td" style="text-align: center;"><?php echo $key->operator_name; ?></td>
            </tr> 
            <?php $num_amount = $num_amount + $key->amount; ?>
            <?php $num_vatamount = $num_vatamount + $key->vatamount; ?>
            <?php $ss = 1; ?>
          <?php } ?>          
          <?php $no++; } ?>  


          <?php $no = 1; foreach ($daily as $key) { ?>   

            <?php if($key->chennel != $row->code & $ss == 1){ ?>
              <tr>
                <td class="td"></td>
                <td class="td" style="text-align: right;">Total</td>
                <td class="td" style="text-align: left;"><?php echo $row->code; ?></td>
                <td class="td" style="text-align: right;"><?php echo number_format($num_amount,2); ?></td>
                <td class="td" style="text-align: right;"><?php echo number_format($num_vatamount,2); ?></td>
                <td class="td" style="text-align: right;"><?php echo number_format($num_amount+$num_vatamount,2); ?></td>
                <td class="td"></td>
                <td class="td"></td>
                <td class="td"></td>
              </tr>
              <?php $ss = 0; ?>
            <?php } ?>

            <?php $no++; } ?>
            <?php $num++; } ?>    






            <tr>
              <?php 
              $x = 0; foreach ($daily as $row) { 
                $x = $row->amount;
                $y = $row->vatamount;
                $z = $row->amount+$row->vatamount;

                $amount = $x+$amount;
                $vatamount = $y+$vatamount;
                $sum = $z+$sum; 
              } 
              ?>
              <td class="td"></td>
              <td class="td"></td>
              <td class="td" style="font-size: 1.2em;"><b>Grand Total</b></td>
              <td class="td" style="text-align: right;font-size: 1.2em;"><b><?php echo number_format($amount,2); ?></b></td>
              <td class="td" style="text-align: right;font-size: 1.2em;"><b><?php echo number_format($vatamount,2); ?></b></td>
              <td class="td" style="text-align: right;font-size: 1.2em;"><b><?php echo number_format($sum,2); ?></b></td>
              <td class="td" style="text-align: right;"></td>
              <td class="td" style="text-align: center;"></td>
              <td class="td" style="text-align: center;"></td>
            </tr>
          </tbody>
        </table>
      </body>
      </html>
      <?php 

      $mpdf = new mPDF('th','A4',0,'angsab');

      $mpdf->setAutoFont(AUTOFONT_THAIVIET);
      $mpdf->SetDisplayMode('fullpage');
      $html = ob_get_contents();
      ob_end_clean();

      $mpdf->writeHTML($html);
// I คือการแสดงข้อมูลบน Browser
      $mpdf->Output("CloseDiscount.pdf","I");

//Barcode

      $mpdf = new mPDF('utf-8','A4','','' , 0 , 0 , 0 , 0 , 0 , 0); 
      $mpdf->SetDisplayMode('fullpage');
$mpdf->list_indent_first_level = 0;  // 1 or 0 - whether to indent the first level of a list
$mpdf->WriteHTML($html);
//render the pdf on the browser
$mpdf->Output();

?>