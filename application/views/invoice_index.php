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
        .b {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);overflow: auto;font-size: 0.9em;width: 99.9%;
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
            background-color: rgba(0,0,0,0.5);
            z-index: 2;
            cursor: pointer;
        }
    </style>
    <style>
        .td {
            padding: 5px; 
        }
    </style>

    <body >

<!--        <div class="w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:none" id="mySidebar">
        <button style="text-align: right;" class="w3-bar-item w3-button w3-large"
        onclick="w3_close()"> &times;</button>
        <h5 style="text-align: center;">Menu</h5>
        <?php foreach ($username_menu as $row){ ?>
            <?php if ($row->group_num == '1') { ?>
                <a href="<?php echo site_url('Payment_controller/' . $row->link); ?>" class="w3-bar-item w3-button w3-padding "><i class="<?php echo $row->icon; ?>" style="color:#c10404;font-size: 1.3em;"></i>  <?php echo iconv('tis-620', 'utf-8', $row->Subject); ?></a>
            <?php } ?>
        <?php } ?> 
        <div class="w3-dropdown-hover">
            <button class="w3-button">Report
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="w3-dropdown-content w3-bar-block">
                <?php foreach ($username_menu as $row){ ?>
                    <?php if ($row->group_num == '2') { ?>
                        <a class="w3-bar-item w3-button" href="<?php echo site_url('Payment_controller/' . $row->link); ?>" class="w3-bar-item w3-button w3-padding "><i class="<?php echo $row->icon; ?>" style="color:#c10404;font-size: 1.3em;"></i>  <?php echo iconv('tis-620', 'utf-8', $row->Subject); ?></a>
                    <?php } ?>
                <?php } ?> 
                <br><br>
            </div>
        </div>      -->

    </div>

<!--        <div id="main">
            <div class="form-group">
                <div style="background: linear-gradient(to left, #cc0000 50%, #ffffff 100%);">
                    <ul class="nav navbar-nav navbar-right">
                        <li style="margin-top: 15px;color: #ffffff;margin-right: 5px;">
                            <span class="glyphicon glyphicon-user"></span> 
                            <?php foreach ($username as $row):
                                echo  $row->Subject_Right."&nbsp;&nbsp;";
                                echo iconv('TIS-620','UTF-8', $row->name);
                            endforeach;?>
                        </li>
                        <?php foreach ($username as $row): ?>
                            <?php if ($row->Subject_Right == 'SuperAdmin') { ?>
                                <li style="color: #ffffff;">
                                    <a href="<?php echo site_url('/Payment_controller/Setting_index?id=').$row->ID; ?>"><span class="glyphicon glyphicon-cog"></span> Setting</a>
                                </li>
                            <?php } ?>
                        <?php endforeach;?>                    
                        <li style="margin-right: 10px;color: #ffffff;">
                            <a href="<?php echo site_url(); ?>/Payment_controller/logout"><span class="glyphicon glyphicon-log-in"></span> Logout</a>
                        </li>
                    </ul>
                    <button id="openNav" class="w3-button w3-xlarge" onclick="w3_open()">&#9776;</button>
                    <label for="text">
                        <?php foreach ($company as $data) { ?>
                            <img style="width: 40px;" src="<?php echo base_url('/image/' . $data->pic); ?>"> 
                            <?php echo iconv('tis-620', 'utf-8', $data->name); }?>
                        </label>
                    </div>
                </div>-->
                <p align="center" style="color: red;font-size: 1.3em;">
                    <?php echo '<br/><label>'.$this->session->flashdata("error").'</label>'; ?>                    
                </p>
                
                
<!--                <div class="divvv w3-animate-right" style="background-color:#FFFFFF;margin-top: 0px;">
                    <div class="row" style="width: 100%;">
                        <div class="col-sm-4" style="width: 100%;">
                            <h3 align="center" style="color: #040404;margin-bottom: 0px;margin-top: 0px;">Run Invoice</h3>
                        </div>
                    </div>
                    <hr style="margin-bottom: 10px;margin-top: 10px;">-->


<div id="main" style=" margin-top: -3%;">
        <div class="wrapper">
            <div class="content-wrapper">
                <section class="content" style=" padding-top:2%;">
                    <div class="container-fluid">
                        <div class="card card-secondary">
                            <div class="card-header" style="background-color: #c3000d;">
                                <h3 class="card-title"> <b>Run Invoice</b> </h3>
<!--                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                </div>-->
                            </div>
                            <div class="card-body">


                    <form id="scan" method = "post" enctype = "multipart/form-data" >
                        <table style="width: 100%;text-align: center;">
                            <tr>
                                <td class="td" style="width: 14%;">
                                    <select class="form-control" id="status" name="status">
                                        <option value="">เลือกสถานะการรับชำระ</option>
                                        <option value="0">Pay Approved</option>
                                        <option value="1">CN</option>
                                    </select>
                                </td>

                                <td class="td" style="width: 10%;">
                                    <select class="form-control" id="Invoice" name="Invoice">
                                        <option value="">เลือก ประเภท</option>
                                        <option value="hp">Tax Invoice</option>
                                        <option value="0">Invoice</option>                  
                                    </select>
                                </td>

                                <td class="td" style="width: 10%;">
                                    <select class="form-control" id="Operator" name="Operator">
                                        <option value="">เลือก Operator</option>
                                        <?php foreach ($op as $row) { ?>
                                            <option value="<?php echo $row->operator_name; ?>"><?php echo $row->operator_name; ?></option>
                                        <?php } ?>                    
                                    </select>
                                </td>

                                <td class="td" style="width: 16;">
                                    <div class="input-group">
                                        <span class="input-group-addon">LOT</span>
                                        <input id="lot" type="text" class="form-control" name="lot">
                                    </div>
                                </td>

                                <td class="td" style="width: 15%;">
                                    <div class="input-group">
                                        <span class="input-group-addon">รหัสลูกค้า</span>
                                        <input id="idcustomer" name="idcustomer" type="text" class="form-control">
                                    </div>
                                </td>

                                <td class="td" style="width: 15%;">
                                    <div class="input-group">
                                        <span class="input-group-addon">วันที่รับชำระ</span>
                                        <input id="datestart" name="datestart" type="date" class="form-control" >
                                    </div>
                                </td>

                                <td class="td" style="width: 15%;">
                                    <div class="input-group">
                                        <span class="input-group-addon">ถึง</span>
                                        <input class="form-control" type="date" id="dateend" name="dateend" >
                                    </div>
                                </td>

                                <td class="td" style="width: 5%;">
                                    <button onclick="scan()" type="button" class="btn btn-info" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);padding: 5px;">ค้นหา</button>
                                </td>
                            </tr>
                        </table>
                    </form>
                    <div align="center" id="show" style="overflow: auto;">
                        <hr style="margin-bottom: 0px;margin-top: 10px;">
                        <div style="width: 99%;">
                            <div style="padding: 10px;border-radius: 10px;text-align: center;">
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
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <br/>
                            <table id="myTable" class="table" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);overflow: auto;font-size: 0.9em;width: 99.9%;">
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
                                        <th>Invoice No</th>
                                        <th>Textbath</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>    
            </section> 
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


            <script>
                $(document).ready(function () {
                    $('#myTable').DataTable({
                        "pageLength": 20,
                        dom: 'Bfrtip',
                        buttons: [
                        'excel'
                        ]
                    });
                });
            </script>

            <script type="text/javascript">
                function scan() {
                    
                    alert('1111');
                    
                    var datestart = document.getElementById('datestart').value;
                    var dateend = document.getElementById('dateend').value;
                    var lot = document.getElementById('lot').value;
                    var Operator = document.getElementById('Operator').value;
                    var idcustomer = document.getElementById('idcustomer').value;
                    var status = document.getElementById('status').value;
                    var Invoice = document.getElementById('Invoice').value;

                    alert(datestart);
                    alert(dateend);
                    alert(lot);
                    alert(Operator);
                    alert(idcustomer);
                    alert(status);
                    alert(Invoice);
                    
                    if (datestart == '' | dateend == '' | lot == '' | Operator == '' | status == '' | Invoice == '') {
                        alert("กรุณากรอกข้อมูล สถานะการชำระ | ประเภท | Operator | Lot | วันที่รับชำระ");
                          
                    }else{
                        alert('222');
                        document.getElementById('overlay').style.display ="block";
                        $.ajax({
                            type:"POST",
                            url:"<?php echo site_url('Payment_controller/invoice_view')?>",
                            data:$("#scan").serialize(),
                        }).done(function(data){  
                            alert('3333');
                            $('#show').html(data);
                            document.getElementById('overlay').style.display ="none";
                        })
                    }    
                }
            </script>

            </html>



