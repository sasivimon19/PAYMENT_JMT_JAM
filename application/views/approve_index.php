<!DOCTYPE html>
<html>
<title>Payment</title>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <meta name="viewport" content="width=device-width, initial-scale=1">

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
  </style>
  <style>
    #overlay {
      position: fixed;
      display: none;
      width: 100%;
      height: 100%;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: rgba(0,0,0,0.6);
      z-index: 2;
      cursor: pointer;
    }
  </style>

  <body >


    <div id="main">
        <div align="center" style="width: 100%;height: 70px;">
          <div class="alert alert-success alert-dismissable" id="passwordsNoMatchRegister" style="width: 50%;color: red;font-size: 1.3em;display: none;">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>บันทึกสำเร็จ ! </strong>
          </div>
        </div>

        <div id="main" style=" margin-top: -3%;">
            <div class="wrapper">
                <div class="content-wrapper">
                    <section class="content" style=" padding-top:2%;">
                        <div class="container-fluid">
                            <div class="card card-secondary">
                                <div class="card-header" style="background-color: #c3000d;">
                                    <h3 class="card-title"> <b>ตัดยอดรับชำระ Approve</b> </h3>

                                </div>
                                <div class="card-body">
                                    <div align="center" class="row content">
                                        <div style="width: 98%;">
                                            <div style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);padding: 5px;border-radius: 5px;">
                                                <div class="input-group" style="width: 100%;text-align: center;">
                                                    <span ><b>รายการที่ไม่ได้ Approve</b></span>
                                                </div>              
                                                <table>
                                                    <tr>
                                                        <td class="td">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><button type="button" onclick="New_Receive()" >New Receive :</button></span>
                                                                <input style="text-align: right;background: #333;color: #ffffff;" type="text" class="form-control" id="usr" name="username" value="<?php echo count($New_Receive); ?>" readonly>
                                                            </div>
                                                        </td>
                                                        <td class="td">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><button type="button" onclick="CN()" >CN :</button></span>
                                                                <input style="text-align: right;background: #333;color: #ffffff;" type="text" class="form-control" id="usr" name="username" value="<?php echo count($CN); ?>" readonly>
                                                            </div> 
                                                        </td>
                                                        <td class="td">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><button type="button" onclick="DISCOUNT()" >DISCOUNT :</button></span>
                                                                <input style="text-align: right;background: #333;color: #ffffff;" type="text" class="form-control" id="usr" name="username" value="<?php echo count($DISCOUNT); ?>" readonly>
                                                            </div>
                                                        </td>
                                                        <td class="td">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><button type="button" onclick="ADJUST()" >ADJUST :</button></span>
                                                                <input style="text-align: right;background: #333;color: #ffffff;" type="text" class="form-control" id="usr" name="username" value="<?php echo count($ADJUST); ?>" readonly>
                                                            </div>
                                                        </td>
                                                        <td class="td">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><button type="button" onclick="REVOKE()" >REVOKE :</button></span>
                                                                <input style="text-align: right;background: #333;color: #ffffff;" type="text" class="form-control" id="usr" name="username" value="<?php echo count($REVOKE); ?>" readonly>
                                                            </div>
                                                        </td>
                                                        <td class="td">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><button type="button" onclick="REFUND()" >REFUND :</button></span>
                                                                <input style="text-align: right;background: #333;color: #ffffff;" type="text" class="form-control" id="usr" name="username" value="<?php echo count($REFUND); ?>" readonly>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                  
                  
                  
                  
                                                <hr style="margin: 10px;">
                                                <form id="scan" method = "post" enctype = "multipart/form-data" >
                                                    <div style="width: 100%;text-align: left;">
                                                        <span style="font-size: 1.3em;">ค้นหา :</span>
                                                    </div>
                                                    <div>

                                                        <table style="width: 100%;text-align: center;">
                                                            <tr>
                                                                <td class="td">
                                                                    <select class="form-control" id="status" name="status">
                                                                        <option value="">เลือกสถานะการรับชำระ</option>
                                                                        <option value="0">New Receive</option>
                                                                        <option value="1">Approved</option>
                                                                        <option value="2">CN</option>
                                                                        <option value="3">DISCOUNT</option>
                                                                        <option value="4">ADJUST</option>
                                                                        <option value="5">REVOKE</option>
                                                                        <option value="6">REFUND</option>
                                                                    </select>
                                                                </td>

                                                                <td class="td">
                                                                    <select class="form-control" id="Operator" name="Operator">
                                                                        <option value="">เลือก Operator</option>
                                                                        <?php foreach ($op as $row) { ?>
                                                                            <option value="<?php echo $row->operator_name; ?>"><?php echo $row->operator_name; ?></option>
                                                                        <?php } ?>                    
                                                                    </select>
                                                                </td>

                                                                <td class="td">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon">รหัสลูกค้า</span>
                                                                        <input id="idcustomer" type="text" class="form-control" name="idcustomer">
                                                                    </div>
                                                                </td>

                                                                <td class="td">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon">วันที่รับชำระ</span>
                                                                        <input id="datestart" type="date" class="form-control" name="datestart">
                                                                    </div>
                                                                </td>

                                                                <td class="td">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon">ถึง</span>
                                                                        <input id="dateend" type="date" class="form-control" name="dateend">
                                                                    </div>
                                                                </td>

                                                                <td class="td">
                                                                    <button onclick="scan()" type="button" class="btn btn-info" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);padding: 5px;">ค้นหา</button>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </form>
                                            </div>          
                                            <div id="show" style="overflow: auto;">
                                                <hr>
                                                <div style="width: 99%;">
                                                    <div style="text-align: center;">
                                                        <div style="width: 100%;text-align: left;">
                                                            <span style="font-size: 1.3em;">ผลการค้นหา :</span>
                                                        </div>
                                                        <div align="center" style="width: 100%;">
                                                            <table style="width: 30%;">
                                                                <tr>
                                                                    <td style="padding: 5px;">         
                                                                        <div style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);padding: 5px;border-radius: 5px;">
                                                                            <div class="input-group" style="width: 100%;text-align: center;">
                                                                                <span class="input-group-addon" style="background: red;color: #ffffff;"><b>ผลการค้นหา</b></span>
                                                                            </div>
                                                                            <hr style="margin: 10px;">
                                                                            <div class="input-group" style="margin-bottom: 5px;width: 100%;">
                                                                                <span class="input-group-addon" style="width: 150px;text-align: right;">จำนวนรายการ:</span>
                                                                                <b><input style="text-align: right;background: #000000;color: #F0FF03;width: 100%;" type="text" class="form-control" id="usr" name="username" value="0" readonly></b>
                                                                            </div>
                                                                            <div class="input-group" style="margin-bottom: 5px;width: 100%;">
                                                                                <span class="input-group-addon" style="width: 150px;text-align: right;">ยอดชำระรวม:</span>
                                                                                <b><input style="text-align: right;background: #000000;color: #F0FF03;width: 100%;" type="text" class="form-control" id="usr" name="username" value="0" readonly></b>
                                                                            </div>   
                                                                            <div class="input-group" style="width: 100%;">
                                                                                <span class="input-group-addon" style="width: 150px;text-align: right;">ยอดรวม VAT:</span>
                                                                                <b><input style="text-align: right;background: #000000;color: #F0FF03;width: 100%;" type="text" class="form-control" id="usr" name="username" value="0" readonly></b>
                                                                            </div>
                                                                        </div>
                                                                    </td>
<!-- <td style="padding: 5px;">
<div style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);padding: 5px;border-radius: 5px;">
<div class="input-group" style="width: 100%;text-align: center;">
<span class="input-group-addon" style="background: red;color: #ffffff;"><b>รายการที่ยังไม่ได้ตัดยอดระบบ</b></span>
</div>
<hr style="margin: 10px;">
<div class="input-group" style="margin-bottom: 5px;">
<span class="input-group-addon">จำนวนรายการ:</span>
<input style="text-align: right;background: #000000;color: #ffffff;" type="text" class="form-control" id="usr" name="username" value="0" readonly>
</div>
<div class="input-group" style="margin-bottom: 0px;">
<span class="input-group-addon">ยอดชำระรวม:</span>
<input style="text-align: right;background: #000000;color: #ffffff;" type="text" class="form-control" id="usr" name="username" value="0.00" readonly>
</div>  
</div>
</td> -->
<!-- <td style="padding: 5px;">
<div style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);padding: 5px;border-radius: 5px;">
<div class="input-group" style="width: 100%;text-align: center;">
<span class="input-group-addon" style="background: red;color: #ffffff;"><b>รายการที่ตัดยอดจากระบบแล้ว (Approved)</b></span>
</div>
<hr style="margin: 10px;">
<div class="input-group" style="margin-bottom: 5px;">
<span class="input-group-addon">จำนวนรายการ (Approved):</span>
<input style="text-align: right;" type="text" class="form-control" id="usr" name="username" value="0" readonly>
</div>
<div class="input-group" style="margin-bottom: 0px;">
<span class="input-group-addon">ยอดชำระรวม:</span>
<input style="text-align: right;" type="text" class="form-control" id="usr" name="username" value="0.00" readonly>
</div>  
</div>
</td> -->
<!-- <td style="padding: 5px;">
<div style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);padding: 5px;border-radius: 5px;">
<div class="input-group">
<span class="input-group-addon">ยอดรวม VAT:</span>
<input style="text-align: right;background: #000000;color: #ffffff;" type="text" class="form-control" id="usr" name="username" value="0.00" readonly>
</div>
<hr style="margin: 10px;">
<div class="input-group" style="margin-bottom: 5px;">
<span class="input-group-addon">จำนวนรายการทั้งหมด:</span>
<input style="text-align: right;" type="text" class="form-control" id="usr" name="username" value="0" readonly>
</div>
<div class="input-group" style="margin-bottom: 0px;">
<span class="input-group-addon">จำนวนเงินรวม:</span>
<input style="text-align: right;" type="text" class="form-control" id="usr" name="username" value="0.00" readonly>
</div>  
</div>
</td> -->
</tr>
</table>

</div>
<br/>




                                    <table id="myTable" class="table table-striped" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);overflow: auto;font-size: 0.9em;">
                                        <thead>
                                            <tr style="background-color:#040404;color: #FFFFFF;">
                                                <th style="text-align: center;">No</th>
                                                <th>DateReceive</th>
                                                <th>Channel</th>
                                                <th>Contract No</th>
                                                <th>Ref no1.</th>
                                                <th>Ref no2.</th>
                                                <th>Amount</th>
                                                <th>VAT</th>
                                                <th>State</th>
                                                <th>Type</th>
                                                <th>Lot</th>
                                                <th>IDCard</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                        </tbody>
                                    </table> 
                                                    </div>           
                                                </div>
                                            </div>
                                        </div>  
                                    </div>

                                </div>           
                            </div>
                    </section>
                </div>
            </div>  
        </div>
    </div>
    <div align="center" id="overlay" onclick="off()">
        <img style="margin-top: 15%;width: 15%;" src="<?php echo base_url(); ?>assets/images/loader.gif">
    </div>
    </body>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>

<!--
<script>
  $(document).ready(function () {
    $('#myTable').DataTable({
      "pageLength": 20,
      "lengthMenu": [[20, 50, 100, -1], [20, 50, 100, "All"]]
    });
  });
</script>-->

<script type="text/javascript">
  function scan() {
      
      alert('123');

    var datestart = document.getElementById('datestart').value;
    var dateend = document.getElementById('dateend').value;
    var status = document.getElementById('status').value;

        
    if (datestart == '' | dateend == '' | status == '') {
      alert("กรุณากรอกข้อมูล สถานะการรับชำระ | วันที่รับชำระ");
    }else{
      document.getElementById('overlay').style.display ="block";
      $.ajax({
        type:"POST",
        url:"<?php echo site_url('Payment_controller/approvescan')?>",
        data:$("#scan").serialize(),
      }).done(function(data){  
        $('#show').html(data);
        document.getElementById('overlay').style.display ="none";
      })
    }    
  }
</script>

<script type="text/javascript">
  function New_Receive() {
    var data = '';
    document.getElementById('overlay').style.display ="block";
    $.ajax({
      type:"POST",
      url:"<?php echo site_url('Payment_controller/approve_New_Receive')?>",
      data:data,
    }).done(function(data){  
      $('#show').html(data);
      document.getElementById('overlay').style.display ="none";
    })
  }
</script>

<script type="text/javascript">
  function CN() {
    var data = '';
    document.getElementById('overlay').style.display ="block";
    $.ajax({
      type:"POST",
      url:"<?php echo site_url('Payment_controller/approve_CN')?>",
      data:data,
    }).done(function(data){  
      $('#show').html(data);
      document.getElementById('overlay').style.display ="none";
    })
  }
</script>

<script type="text/javascript">
  function DISCOUNT() {
    var data = '';
    document.getElementById('overlay').style.display ="block";
    $.ajax({
      type:"POST",
      url:"<?php echo site_url('Payment_controller/approve_DISCOUNT')?>",
      data:data,
    }).done(function(data){  
      $('#show').html(data);
      document.getElementById('overlay').style.display ="none";
    })
  }
</script>

<script type="text/javascript">
  function ADJUST() {
    var data = '';
    document.getElementById('overlay').style.display ="block";
    $.ajax({
      type:"POST",
      url:"<?php echo site_url('Payment_controller/approve_ADJUST')?>",
      data:data,
    }).done(function(data){  
      $('#show').html(data);
      document.getElementById('overlay').style.display ="none";
    })
  }
</script>

<script type="text/javascript">
  function REVOKE() {
    var data = '';
    document.getElementById('overlay').style.display ="block";
    $.ajax({
      type:"POST",
      url:"<?php echo site_url('Payment_controller/approve_REVOKE')?>",
      data:data,
    }).done(function(data){  
      $('#show').html(data);
      document.getElementById('overlay').style.display ="none";
    })
  }
</script>

<script type="text/javascript">
  function REFUND() {
    var data = '';
    document.getElementById('overlay').style.display ="block";
    $.ajax({
      type:"POST",
      url:"<?php echo site_url('Payment_controller/approve_REFUND')?>",
      data:data,
    }).done(function(data){  
      $('#show').html(data);
      document.getElementById('overlay').style.display ="none";
    })
  }
</script>


<script type="text/javascript">
  function save(){
      
    document.getElementById('overlay').style.display ="block";
    var num = document.getElementById('sum').value;
    for ($k=1; $k <= num ; $k++) { 
      var contract_no = document.getElementById('contract_no-'+$k).value;
      var state = document.getElementById('state-'+$k).value;
      var IDCard = document.getElementById('IDCard-'+$k).value;
      var amount = document.getElementById('amount-'+$k).value;


      var data = "contract_no="+contract_no+"&state="+state+"&IDCard="+IDCard+"&amount="+amount;
      $.ajax({
        type:"POST",          
        url:"<?php echo site_url('Payment_controller/approve_updatet')?>",
        data: data,
      }).done(function(data) {
        location.replace("approve");
        document.getElementById('overlay').style.display ="none";

        $('#passwordsNoMatchRegister').fadeIn(500);
        setTimeout(function () {
          $('#passwordsNoMatchRegister').fadeOut(500);
        }, 3000);
      });  
    }
  }
</script>

</html>



