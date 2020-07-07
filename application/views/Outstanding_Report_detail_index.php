<!DOCTYPE html>
<html>
<title>Outstanding Report(Detail) <?php foreach ($company as $data) { ?>
    <?php echo iconv('tis-620', 'utf-8', $data->name); }?></title>
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

            .nav-tabs>li.active>a,.nav-tabs>li.active>a:focus,.nav-tabs>li.active>a:hover{
                color:#fff;
                cursor:default;
                background-color:#d94040;
                border:1px solid #ddd;
                border-bottom-color:transparent;
            }
        </style>
    </head>
    <body style="background-color:#a6a6a6;">

        <div class="w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:none" id="mySidebar">
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
        </div>      

    </div>

        <div id="main">
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
                </div>
                <p align="center" style="color: red;font-size: 1.3em;">
                    <?php echo '<br/><label>'.$this->session->flashdata("error").'</label>'; ?>                    
                </p>
                <div class="divvv w3-animate-right" style="background-color:#FFFFFF;margin-top: 0px;">
                    <div class="row" style="width: 100%;">
                        <div class="col-sm-4" style="width: 100%;">
                            <h3 align="center" style="color: #040404;margin-bottom: 0px;margin-top: 0px;">Outstanding Report(Detail)</h3>
                        </div>
                    </div>
                    <hr>

                    <form id="scan" method = "post"  action="<?php echo site_url('Payment_controller/daily_PDF')?>" enctype = "multipart/form-data" target="_blank">
                        <table style="width: 100%;text-align: center;">
                            <tr>
                                <td class="td" style="width: 30%;">
                                    <div class="input-group">
                                        <span class="input-group-addon">Operator</span>
                                        <select class="form-control" id="Operator" name="Operator">
                                            <option value="">เลือก Operator</option>
                                            <?php foreach ($op as $row) { ?>
                                                <option value="<?php echo $row->operator_name; ?>"><?php echo $row->operator_name; ?></option>
                                            <?php } ?>                    
                                        </select>
                                    </div>
                                </td>

                                <td class="td" style="width: 30;">
                                    <div class="input-group">
                                        <span class="input-group-addon">LOT</span>
                                        <input id="lot" type="text" class="form-control" name="lot">
                                    </div>
                                </td>

                                <td class="td" style="width: 30%;">
                                    <div class="input-group">
                                        <span class="input-group-addon">วันที่</span>
                                        <input id="date" type="date" class="form-control" name="date">
                                    </div>
                                </td>

                                <td class="td" style="width: 10%;">
                                    <button onclick="scan()" type="button" class="btn btn-info" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);padding: 5px;width: 100%;">ค้นหา</button>
                                </td>
                            </tr>
                        </table>
                    </form>

                    <div align="center" id="show" style="overflow: auto;">
                        <hr style="margin-top: 3px;">
                        <div style="width: 99%;">
                            <div style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);width: 99%;margin-bottom: 5px;border-radius: 5px;padding: 5px;">
                                <p style="width: 100%;background-color: red;border-radius: 5px;"><b>Grand Total</b></p>
                                <table style="width: 100%;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);border-radius: 5px;">
                                    <tr style="">
                                        <td style="padding: 3px;">
                                            <div class="input-group">
                                                <span class="input-group-addon">จำนวนรายการ</span>
                                                <input style="color: #F0FF03;background-color: black;text-align: right;" id="msg" type="text" class="form-control" name="msg" value="<?php echo number_format(0); ?>">
                                            </div>
                                        </td>
                                        <td style="padding: 3px;">
                                            <div class="input-group">
                                                <span class="input-group-addon">Beginning Balance</span>
                                                <input style="color: #F0FF03;background-color: black;text-align: right;" id="msg" type="text" class="form-control" name="msg" value="<?php echo number_format(0,2); ?>">
                                            </div>
                                        </td>
                                        <td style="padding: 3px;">
                                            <div class="input-group">
                                                <span class="input-group-addon">Receive in this month</span>
                                                <input style="color: #F0FF03;background-color: black;text-align: right;" id="msg" type="text" class="form-control" name="msg" value="<?php echo number_format(0,2); ?>">
                                            </div>
                                        </td>
                                        <td style="padding: 3px;">
                                            <div class="input-group">
                                                <span class="input-group-addon">Endingmonth</span>
                                                <input style="color: #F0FF03;background-color: black;text-align: right;" id="msg" type="text" class="form-control" name="msg" value="<?php echo number_format(0,2); ?>">
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <br>
                            <table id="myTable" class="table" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);overflow: auto;font-size: 0.9em;width: 99%;">
                                <thead>
                                    <tr style="background-color:#040404;color: #FFFFFF;">
                                        <th>No</th>
                                        <th>Contract No</th>
                                        <th>Cus Name</th>
                                        <th>Beinmouth</th>
                                        <th>Date</th>
                                        <th>Rpinmonth</th>
                                        <th>Endingmonth</th> 
                                        <th>Pay</th> 
                                        <th>Lot No</th> 
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                        <hr>
                    </div>

                </div>
                <div align="center" id="overlay" onclick="off()">
                    <img style="margin-top: 20%;width: 20%;" src="<?php echo base_url();?>assets/img/loader4.gif">
                </div>
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
                });
            });
        </script>



        <script type="text/javascript">
            function scan() {
                var date = document.getElementById('date').value;
                var lot = document.getElementById('lot').value;
                var Operator = document.getElementById('Operator').value;

                if (date == '' | lot == '' | Operator == '') {
                    alert("กรุณากรอกข้อมูล Operator | Lot | วันที่");
                }else{
                    document.getElementById('overlay').style.display ="block";
                    $.ajax({
                        type:"POST",
                        url:"<?php echo site_url('Payment_controller/Outstanding_Report_view')?>",
                        data:$("#scan").serialize(),
                    }).done(function(data){
                        // alert(data); 
                        $('#show').html(data);
                        document.getElementById('overlay').style.display ="none";
                    })
                }    
            }
        </script>


        </html>



