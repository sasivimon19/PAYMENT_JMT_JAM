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
        <link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>css/2.css">
        <script type = 'text/javascript' src = "<?php echo base_url(); ?>js/js.js"></script>
        <script>
            function fncSubmit()
            {
                if (document.search.contract.value == "")
                {
                    alert('กรุณากรอกข้อมูล Search');
                    document.search.contract.focus();
                    return false;
                }

                document.search.submit();
            }
        </script>

    </head>
    <!--<body style="background-color:#a6a6a6;">-->
    <body>
        <!--  <div class="w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:none" id="mySidebar">
                <button style="text-align: right;" class="w3-bar-item w3-button w3-large"
                onclick="w3_close()"> &times;</button>
                <h5 style="text-align: center;">Menu</h5>
        <?php foreach ($username_menu as $row) { ?>
            <?php if ($row->group_num == '1') { ?>
                                <a href="<?php echo site_url('Payment_controller/' . $row->link); ?>" class="w3-bar-item w3-button w3-padding "><i class="<?php echo $row->icon; ?>" style="color:#c10404;font-size: 1.3em;"></i>  <?php echo iconv('tis-620', 'utf-8', $row->Subject); ?></a>
            <?php } ?>
        <?php } ?> 
                <div class="w3-dropdown-hover">
                    <button class="w3-button">Report
                        <i class="fa fa-caret-down"></i>
                    </button>
                    <div class="w3-dropdown-content w3-bar-block">
        <?php foreach ($username_menu as $row) { ?>
            <?php if ($row->group_num == '2') { ?>
                                        <a class="w3-bar-item w3-button" href="<?php echo site_url('Payment_controller/' . $row->link); ?>" class="w3-bar-item w3-button w3-padding "><i class="<?php echo $row->icon; ?>" style="color:#c10404;font-size: 1.3em;"></i>  <?php echo iconv('tis-620', 'utf-8', $row->Subject); ?></a>
            <?php } ?>
        <?php } ?> 
                        <br><br>
                    </div>
                </div>      
        
            </div>-->

        <!--  <div id="main">
            <div class="form-group">
              <div style="background: linear-gradient(to left, #cc0000 50%, #ffffff 100%);">
                <ul class="nav navbar-nav navbar-right">
                  <li style="margin-top: 15px;color: #ffffff;margin-right: 5px;">
                    <span class="glyphicon glyphicon-user"></span> 
        <?php
        foreach ($username as $row):
            echo $row->Subject_Right . "&nbsp;&nbsp;";
            echo iconv('TIS-620', 'UTF-8', $row->name);
        endforeach;
        ?>
                  </li>
<?php foreach ($username as $row): ?>
    <?php if ($row->Subject_Right == 'SuperAdmin') { ?>
                              <li style="color: #ffffff;">
                                <a href="<?php echo site_url('/Payment_controller/Setting_index?id=') . $row->ID; ?>"><span class="glyphicon glyphicon-cog"></span> Setting</a>
                              </li>
    <?php } ?>
<?php endforeach; ?>                    
                  <li style="margin-right: 10px;color: #ffffff;">
                    <a href="<?php echo site_url(); ?>/Payment_controller/logout"><span class="glyphicon glyphicon-log-in"></span> Logout</a>
                  </li>
                </ul>
                <button id="openNav" class="w3-button w3-xlarge" onclick="w3_open()">&#9776;</button>
                <label for="text">
        <?php foreach ($company as $data) { ?>
                        <img style="width: 40px;" src="<?php echo base_url('/image/' . $data->pic); ?>"> 
    <?php echo iconv('tis-620', 'utf-8', $data->name);
} ?>
                  </label>
                </div>
              </div>-->

        <div class="wrapper">
            <div class="content-wrapper">
                <section class="content" style=" padding-top:2%;">
                    <div class="container-fluid">
                        <div class="card card-secondary">
                            <div class="card-header" style="background-color: #c3000d;">
                                <h3 class="card-title"> <b> ข้อมูลลูกค้า </b> </h3>
                                <!-- <div class="card-tools">
                                     <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                </div>-->
                            </div>
                            <div class="card-body">
                                <div class="divvv w3-animate-right" style="background-color:#FFFFFF;">
                                    <div class="row" style="width: 100%;">
                                        <table style="width: 100%;">
                                            <tr>
                                                <td style="width: 20%;">

                                                </td>
                                                <td style="width: 60%;">
                                                    <div class="grid-container">
                                                        <div class="col-sm-4" style="width: 100%;">
                                                            <h3 align="center" style="color: #040404;margin-bottom: 0px;margin-top: 0px;">ข้อมูลลูกค้า</h3>
                                                        </div>
                                                        <div class="col-sm-4">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td style="width: 20%;text-align: right;">
                                                    <button onclick="document.getElementById('id01').style.display = 'block'" class="btn btn-default w3-large">ค้นหา</button>
                                                </td>
                                            </tr>
                                        </table>				
                                    </div>

                                    <div id="id01" class="w3-modal">
                                        <div align="center" class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width: 80%;padding-bottom: 10px;padding-top: 10px;">

                                            <div class="w3-center">
                                                <span onclick="document.getElementById('id01').style.display = 'none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
                                                <span style="font-size: 1.3em;">ค้นหาข้อมูลลูกค้า</span>
                                            </div>

                                            <form name="search" action="<?php echo site_url('Payment_controller/customer_index_from?'), 'Searchmore'; ?>" method="post" onSubmit="JavaScript:return fncSubmit();">
                                                <div class="input-group">
                                                    <?php foreach ($username as $row): ?>									
                                                        <input style="display: none;"type="text" name="company" value="<?php echo iconv('TIS-620', 'UTF-8', $row->company); ?>">
                                                    <?php endforeach; ?>
                                                    <input type="text" id="contract" name="contract" class="form-control" placeholder="Search">
                                                    <div class="input-group-btn">
                                                        <button class="btn btn-default" type="submit" id="search" name="search" onclick="searchcustomer()">
                                                            <i class="glyphicon glyphicon-search"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>

                                        </div>
                                    </div>


                                    <!--          <div id="showcustomer">55555555555</div>
                                            <hr>
                                                <script>
                                            function searchcustomer() {	 //แนบตัวแปร page ไปด้วย
                                     
                                                alert('55555');
                                                var contract = document.getElementById('contract').value;
                                               
                                                var datas = "contract=" + contract;
                                                alert(datas);
                                                $.ajax({
                                                    type: "POST",
                                                    url: "<?php //echo site_url('Payment_controller/customer_index_from')  ?>",
                                                    data: datas,
                                                }).done(function (data) {
                                                    alert(datas);
                                                    $('#showcustomer').html(data);  //Div ที่กลับมาแสดง
                                                })
                                            }
                                        </script>-->

                                    <div align="center" class="row content">
                                        <?php foreach ($Cm as $data) { ?>
                                            <table style="width: 97%;" class="">
                                                <tr>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="col-xs-6" style="width: 100%;">
                                                                <label for="first_name">IDCard:</label>
                                                                <input type="text" class="form-control" name="first_name" id="first_name" value="<?= $data->id_no ?>"  readonly>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="col-xs-6" style="width: 100%;">
                                                                <label for="last_name">Name:</label>
                                                                <input type="text" class="form-control" name="last_name" id="last_name" value="<?php echo iconv('tis-620', 'utf-8', $data->cus_name) ?>"  readonly>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="col-xs-6" style="width: 100%;">
                                                                <label for="phone">Product:</label>
                                                                <input type="text" class="form-control" name="phone" id="phone" value="<?php echo iconv('tis-620', 'utf-8', $data->product) ?>"  readonly>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="col-xs-6" style="width: 100%;">
                                                                <label for="mobile">Lot:</label>
                                                                <input type="text" class="form-control" name="mobile" id="mobile" value="<?php echo $data->lot_no ?>"  readonly>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="col-xs-6" style="width: 100%;">
                                                                <label for="email">Address1:</label>
                                                                <input type="" rows = "5" cols = "40" class="form-control" name="email" id="email" value="<?php echo iconv('tis-620', 'utf-8', $data->address1) ?>" readonly>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="col-xs-6" style="width: 100%;">
                                                                <label for="email">Address2:</label>
                                                                <input type="" rows = "5" cols = "40" class="form-control" id="location" value="<?php echo iconv('tis-620', 'utf-8', $data->address2) ?>"  readonly>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="col-xs-6" style="width: 100%;">
                                                                <label for="password">Province:</label>
                                                                <input type="" class="form-control" name="password" id="password" value="<?php echo iconv('tis-620', 'utf-8', $data->province) ?>" readonly>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="col-xs-6" style="width: 100%;">
                                                                <label for="password2">Postal:</label>
                                                                <input type="" class="form-control" name="password2" id="password2" value="<?php echo iconv('tis-620', 'utf-8', $data->postal) ?>"  readonly>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="col-xs-6" style="width: 100%;">
                                                                <label for="first_name">Beginning Balance:</label>
                                                                <input type="text" style="background-color:#000000; color:red; font-size:20px;"  class="form-control" name="first_name" id="first_name" value="<?php echo number_format($data->b_balance, 2) ?>" readonly>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="col-xs-6" style="width: 100%;">
                                                                <label for="last_name">Ending Balance:</label>
                                                                <input type="text" style="background-color:#000000; color:red; font-size:20px;" class="form-control text2" name="last_name" id="last_name" value="<?php echo number_format($data->e_balance, 2) ?>"  readonly>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="col-xs-6" style="width: 100%;">
                                                                <label for="mobile">Operator:</label>
                                                                <input type="text" style="color:red; font-size:20px;" class="form-control" name="mobile" id="mobile" value="<?php echo iconv('tis-620', 'utf-8', $data->operator_name) ?>" readonly>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="col-xs-6" style="width: 100%;">
                                                                <label for="mobile">สถานะ:</label>
                                                                <input type="text" style="color:red; font-size:20px;" class="form-control" name="mobile" id="mobile" value="<?php echo iconv('tis-620', 'utf-8', $data->status) ?>"  readonly>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                             <?php } ?>
                                            <?php foreach ($receive as $data) { ?>
                                                <tr>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="col-xs-6" style="width: 100%;">
                                                                <label for="phone">จำนวนเงินเกินภาษี:</label>
                                                                <input type="text" class="form-control" name="phone" id="phone" value="<?php echo number_format($data->amount, 2) ?>" readonly>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="col-xs-6" style="width: 100%;">
                                                                <label for="mobile">ภาษี:</label>
                                                                <input type="text" class="form-control" name="mobile" id="mobile" value="<?php echo number_format($data->vatamount, 2) ?>"  readonly>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="col-xs-6" style="width: 100%;">
                                                                <label for="mobile">จำนวนเงินรับชำระภาษีรวม:</label>
                                                                <input type="text" class="form-control" name="mobile" id="mobile" value="<?php echo number_format($data->amount, 2) ?>"  readonly>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="col-xs-6" style="width: 100%;">
                                                                <label for="table">รายการรับชำระ</label>
                                                                <input type="text" class="form-control" name="mobile" id="mobile" value=""  readonly>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </table>
                                    </div>
                                    <br/>
                                    <div align="center" class="row content">
                                        <div style="width: 97%;overflow: auto;">
                                            <table class="table table-dark table-striped table-bordered" style="white-space: nowrap;font-size: 0.8em;">
                                                <thead>
                                                    <tr style="background-color:#040404;">
                                                        <th style="color: #FFFFFF;">No</th>
                                                        <th style="color: #FFFFFF;">r_index</th>
                                                        <th style="color: #FFFFFF;">DateReceive</th>
                                                        <th style="color: #FFFFFF;">Chennel</th>
                                                        <th style="color: #FFFFFF;">Ref No.1</th>
                                                        <th style="color: #FFFFFF;">Ref No.2</th>
                                                        <th style="color: #FFFFFF;">Amount</th>
                                                        <th style="color: #FFFFFF;">VateAmount</th>
                                                        <th style="color: #FFFFFF;">Invoicone</th>
                                                        <th style="color: #FFFFFF;">State</th>
                                                        <th style="color: #FFFFFF;">Keytype</th>
                                                        <th style="color: #FFFFFF;">SaveEmpBy</th>
                                                        <th style="color: #FFFFFF;">DateSave</th>
                                                        <th style="color: #FFFFFF;">Approve</th>
                                                        <th style="color: #FFFFFF;">DateApprove</th>
                                                        <th style="color: #FFFFFF;">Remark</th>
                                                    </tr>
                                                </thead>
                                                <?php $count_most = 1;
                                                foreach ($receiveTB as $row) { ?>
                                                    <tbody>
                                                        <tr style="background-color:#FFFFFF;">
                                                            <td><?php echo iconv('tis-620', 'utf-8', $count_most); ?></td>
                                                            <td><?php echo iconv('tis-620', 'utf-8', $row->r_index); ?></td>
                                                            <td><?php echo $row->DateReceive; ?></td>
                                                            <td><?php echo iconv('tis-620', 'utf-8', $row->Chennel); ?></td>
                                                            <td><?php echo iconv('tis-620', 'utf-8', $row->Refno1); ?></td>
                                                            <td><?php echo $row->Refno2; ?></td>
                                                            <td style="text-align: right;"><?php echo number_format($row->Amount, 2) ?></td>
                                                            <td style="text-align: right;"><?php echo number_format($row->Vatamount, 2); ?></td>
                                                            <td><?php echo iconv('tis-620', 'utf-8', $row->Invoiceno); ?></td>
                                                            <td style="color:red;"><?php echo iconv('tis-620', 'utf-8', $row->State) ?></td>
                                                            <td><?php echo iconv('tis-620', 'utf-8', $row->Keytype); ?></td>
                                                            <td><?php echo $row->SaveEmpBy; ?></td>
                                                            <td><?php echo $row->DateSave; ?></td>
                                                            <td><?php echo iconv('tis-620', 'utf-8', $row->ApproveEmpBy); ?></td>
                                                            <td><?php echo iconv('tis-620', 'utf-8', $row->DateApprove); ?></td>
                                                            <td><?php echo iconv('tis-620', 'utf-8', $row->Remark); ?></td>
                                                        </tr>

                                                    </tbody>
                                                <?php $count_most += 1;} ?>

                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </section>
            </div>
        </div>
    </div>

</body>
</html>



