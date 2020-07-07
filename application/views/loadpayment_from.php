<!DOCTYPE html>
<html>
<title>Payment</title>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="viewport" content="width=device-width, initial-scale=1">

<!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">-->
    
    
     <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"> 
     <script src="<?php echo base_url(); ?>assets/css/jquery.min.js"></script>
     <script src="<?php echo base_url(); ?>assets/css/bootstrap.min.js"></script> 
     <link href="<?php echo base_url(); ?>assets/css/w3.css" rel="stylesheet" type="text/css"> 
     <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"> 
     <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"> 
     <link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>css/1.css">
     <script type = 'text/javascript' src = "<?php echo base_url(); ?>js/js.js"></script>
     <link href="<?php echo base_url(); ?>assets/DataTables/DataTables-1.10.18/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"> 
     <script src="<?php echo base_url(); ?>assets/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js"></script>
    
    
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

            <div align="center" style="width: 100%;">
                <div class="alert alert-success alert-dismissable" id="passwordsNoMatchRegister" style="width: 50%;color: red;font-size: 1.3em;display: none;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>บันทึกสำเร็จ ! </strong>
                </div>
            </div>
            <div class="divvv w3-animate-right" style="background-color:#FFFFFF;"  >
                <div class="row" style="width: 100%;">
                    <div class="col-sm-4" style="width: 100%;">
                        <h3 align="center" style="color: #040404;margin-bottom: 0px;margin-top: 0px;">โหลดข้อมูลรับชำระ</h3>
                    </div>
                    <div class="col-sm-4">
                    </div>
                </div>
                <hr>

                <div class="row content">
                    <div class="col-sm-12">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#1">รายการที่สามารถบันทึกได้ (<span style="color: green;"><?php $num = 0; foreach ($search_view as $row) 
                            { $num++; } echo $num; ?></span>)</a></li>
                            <li><a data-toggle="tab" href="#2">รายการที่ไม่สามารถบันทึกได้ (<span style="color: red;"><?php $num = 0; foreach ($search_view_not as $row) 
                            { $num++; } echo $num; ?></span>)</a></li>
                            <li><a data-toggle="tab" href="#3">เพิ่มข้อมูล Payment</a></li>
                            <form name="load" action="<?php echo site_url('Payment_controller/loadpayment_from'); ?>" method="post" onSubmit="JavaScript:return loadSubmit();" enctype="multipart/form-data">
                                <div class="input-group">
                                    <input type="file" id="contract" name="file" class="form-control" required style="padding: 3px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-default" type="submit" name="submit" id="btnload">Open</button>
                                    </div>
                                </div>
                            </form>
                        </ul>
                        
                      

                        <!-- <form > -->

                            <div class="tab-content">
                                <div class="tab-pane active" id="1"  style="overflow: auto;">
                                    <div align="center" style="width: 100%;">
                                        <div class="input-group" style="margin-top: 5px;margin-bottom: 5px;width: 30%;">
                                            <span class="input-group-addon">ยอดรวม Amount :</span>
                                            <b><input style="text-align: right;background: #000000;color: #F0FF03;width: 100%;" id="msg" type="text" class="form-control" name="msg" value="<?php foreach ($sumamount as $key) { echo number_format($key->sumAmount,2); }; ?>" readonly></b>
                                        </div>
                                    </div>
                                    <table id="myTable" class="table" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);overflow: auto;font-size: 0.9em;width: 99.9%;">
                                        <thead>
                                            <tr style="background-color:#040404;color: #FFFFFF;">
                                                <th>No</th>
                                                <th>Date</th>
                                                <th>Contract No</th>
                                                <th>IDCard</th>
                                                <th>Channel</th>
                                                <th>Ref No.1</th>
                                                <th>Ref No.2</th>
                                                <th>Amount</th>
                                                <th>Lot</th>
                                                <th>Remark</th>
                                                <th>OSBalance</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $num = 1; foreach ($search_view as $row) { ?>
                                                <tr>
                                                    <td><?php echo $num; ?></td>
                                                    <td><?php echo date("m-d-Y",strtotime($row->Date1)); ?></td>
                                                    <td><?php echo $row->Agreement; ?></td>
                                                    <td><?php echo $row->IDCard; ?></td>
                                                    <td><?php echo $row->Channel; ?></td>
                                                    <td><?php echo $row->Ref1; ?></td>
                                                    <td><?php echo date("m-d-Y",strtotime($row->Ref2)); ?></td>
                                                    <td style="text-align : right;"><?php echo number_format($row->Amount,2); ?></td>
                                                    <td><?php echo $row->lot_no; ?></td>
                                                    <td><?php echo iconv('tis-620', 'utf-8', $row->Remark); ?></td>
                                                    <td style="text-align : right;<?php if (($row->OSbalance - $row->Amount) < 0) { ?>
                                                        color: red;
                                                        <?php } ?>"><b><?php echo number_format(($row->OSbalance - $row->Amount),2); ?></b></td>
                                                    </tr>
                                                    <?php $num++; }?>
                                                </tbody>
                                            </table>
                                            <hr>
                                            <div align="center" style="width: 100%;">
                                                <!-- <form action="<?php echo site_url('Payment_controller/loadpayment_insert'); ?>" method = "post" enctype = "multipart/form-data" > -->
                                                    <form id="insert" action="<?php echo site_url('Payment_controller/loadpayment_insert'); ?>" method = "post" enctype = "multipart/form-data" >
                                                        <div style="display: none;">
                                                            <?php $num = 1; foreach ($search_view as $row1) 
                                                            { ?>
                                                                <input type="text" name="<?php echo "Date1-".$num ?>" id="Date1" value="<?php echo $row1->Date1; ?>">
                                                                <input type="text" name="<?php echo "Agreement-".$num ?>" id="<?php echo "Agreement-".$num ?>" value="<?php echo $row1->Agreement; ?>">
                                                                <input type="text" name="<?php echo "IDCard-".$num ?>" id="<?php echo "IDCard-".$num ?>" value="<?php echo $row1->IDCard; ?>">
                                                                <input type="text" name="<?php echo "Channel-".$num ?>" id="<?php echo "Channel-".$num ?>" value="<?php echo $row1->Channel; ?>">
                                                                <input type="text" name="<?php echo "Ref1-".$num ?>" id="<?php echo "Ref1-".$num ?>" value="<?php echo $row1->Ref1; ?>">
                                                                <input type="text" name="<?php echo "Ref2-".$num ?>" id="<?php echo "Ref2-".$num ?>" value="<?php echo $row1->Ref2; ?>">
                                                                <input type="text" name="<?php echo "Amount-".$num ?>" id="<?php echo "Amount-".$num ?>" value="<?php echo $row1->Amount; ?>">
                                                                <input type="text" name="<?php echo "Lot-".$num ?>" id="<?php echo "Lot-".$num ?>" value="<?php echo $row1->lot_no; ?>">
                                                                <input type="text" name="<?php echo "Remark-".$num ?>" id="<?php echo "Remark-".$num ?>" value="<?php echo $row1->Remark; ?>">
                                                                <hr>
                                                                <?php $num++; } ?>
                                                            </div>


<!--  <a href="<?php echo site_url('Payment_controller/delete_loadpayment_simulate'); ?>"><button style="width: 15%;margin: 15px;" type="button" class="btn btn-danger">ล้างข้อมูล</button></a>


    <button style="width: 15%;margin: 15px;" type="button" class="btn btn-success" onclick="save(num = <?php echo $num ?>)">บันทึก</button> -->
    <?php $count = count($search_view); if ($count == '0'){ ?>
        <a href="<?php echo site_url('Payment_controller/delete_loadpayment_simulate'); ?>"><button style="width: 15%;margin: 15px;" type="button" class="btn btn-danger">ล้างข้อมูล</button></a>

        <button style="width: 15%;margin: 15px;" type="button" class="btn btn-success" onclick="save(num = <?php echo $num ?>)" disabled>บันทึก</button>
    <?php }else{ ?>
        <a href="<?php echo site_url('Payment_controller/delete_loadpayment_simulate'); ?>"><button style="width: 15%;margin: 15px;" type="button" class="btn btn-danger">ล้างข้อมูล</button></a>

        <button style="width: 15%;margin: 15px;" type="button" class="btn btn-success" onclick="save(num = <?php echo $num ?>)">บันทึก</button>
    <?php } ?> 

</form>
</div>
<hr>
</div>

<div class="tab-pane" id="2" style="overflow: auto;">
    <div align="center" style="width: 100%;">
        <div class="input-group" style="margin-top: 5px;margin-bottom: 5px;width: 30%;">
            <span class="input-group-addon">ยอดรวม Amount :</span>
            <b><input style="text-align: right;background: #000000;color: #F0FF03;width: 100%;" id="msg" type="text" class="form-control" name="msg" value="<?php foreach ($sumamount_not as $key) { echo number_format($key->sumAmount,2); }; ?>" readonly></b>
        </div>
    </div>
    <table id="myTable1" class="table" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);overflow: auto;font-size: 0.9em;width: 99.9%;">
        <thead>
            <tr style="background-color:#040404;color: #FFFFFF;">
                <th>No</th>
                <th>Date</th>
                <th>Contract No</th>
                <th>IDCard</th>
                <th>Channel</th>
                <th>Ref No.1</th>
                <th>Ref No.2</th>
                <th>Amount</th>
                <th>Lot</th>
                <th>Date Export</th>
                <th>Remark</th>
                <!-- <th>OSBalance</th> -->
            </tr>
        </thead>
        <tbody>
            <?php $num = 1; foreach ($search_view_not as $row) 
            { ?>
                <tr style="text-align: left;">
                    <td><?php echo $num; ?></td>
                    <td><?php echo date("m-d-Y",strtotime($row->Date1)); ?></td>
                    <td><?php echo $row->Agreement; ?></td>
                    <td><?php echo $row->IDCard; ?></td>
                    <td><?php echo $row->Channel; ?></td>
                    <td><?php echo $row->Ref1; ?></td>
                    <td><?php echo date("m-d-Y",strtotime($row->Ref2)); ?></td>
                    <td style="text-align : right;"><?php echo number_format($row->Amount,2); ?></td>
                    <td><?php echo $row->Lot; ?></td>
                    <td><?php foreach ($get_date as $key) {
                        echo date("m-d-Y",strtotime($key->Currentdate));
                    } ?></td>
                    <td style="color: red;"><b>
<!-- <?php 
foreach ($get_IDCard as $key) { 
if ($key->ID  == $row->ID) {
echo " IDCard ";
}
}
foreach ($get_ContractNo as $key) { 
if ($key->ID  == $row->ID) {
echo " ContractNo ";
}
}
foreach ($get_Channel as $key) { 
if ($key->ID  == $row->ID) {
echo " Channel ";
}
}
foreach ($date_not as $key) { 
if ($key->ID  == $row->ID) {
foreach ($username as $row1):
if ($row1->user_level == 0) {
echo " สิทธิ์คุณไม่สามารถโหลดชำระ วันที่ย้อนหลังได้ ";
}else{
echo " ไม่สามารถโหลดข้อมูล ล่วงหน้าได้ ";
}
endforeach;
}
}
?>  -->    

</b>
</td>
</tr>
<?php $num++; 
}?>
</tbody>
</table>
<hr>
</div>
<div class="tab-pane" id="3"  style="overflow: auto;">
    <br/>
    <div style="width: 100%;text-align: center;">
        <form id="insert1" action="<?php echo site_url('Payment_controller/loadpayment_get_from'); ?>" method = "post" enctype = "multipart/form-data" >

            <table style="width: 100%;">
                <tr>
                    <td style="padding: 10px;">
                        <div class="input-group">
                            <span class="input-group-addon">Date</span>
                            <input id="date" type="date" class="form-control" name="date" required>
                        </div>
                    </td>
                    <td style="padding: 10px;">
                        <div class="input-group">
                            <span class="input-group-addon">Contract No</span>
                            <input id="Agreement" type="text" class="form-control" name="Agreement" required>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 10px;">
                        <div class="input-group">
                            <span class="input-group-addon">IDCard</span>
                            <input id="IDCard" type="text" class="form-control" name="IDCard" required>
                        </div>
                    </td>
                    <td style="padding: 10px;">
                        <div class="input-group">
                            <span class="input-group-addon">Channel</span>
                            <input id="Channel" type="text" class="form-control" name="Channel" required>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 10px;">
                        <div class="input-group">
                            <span class="input-group-addon">Ref1</span>
                            <input id="Ref1" type="text" class="form-control" name="Ref1">
                        </div>
                    </td>
                    <td style="padding: 10px;">
                        <div class="input-group">
                            <span class="input-group-addon">Ref2</span>
                            <input id="Ref2" type="date" class="form-control" name="Ref2" required>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 10px;">
                        <div class="input-group">
                            <span class="input-group-addon">Amount</span>
                            <input id="Amount" type="text" class="form-control" name="Amount" required>
                        </div>
                    </td>
                    <td style="padding: 10px;">
                        <div class="input-group">
                            <span class="input-group-addon">Remark</span>
                            <input id="Remark" type="text" class="form-control" name="Remark">
                        </div>
                    </td>
                </tr>
            </table>
            <hr>
            <button style="width: 15%;margin: 15px;" type="button" onclick="save_get()" class="btn btn-success">บันทึก</button>
        </form>
    </div>
    <hr>
</div>
</div>
<!-- </form> -->
</div>
</div>

</div>
</div>

<div align="center" id="overlay" onclick="off()">
    <img style="margin-top: 15%;width: 15%;" src="<?php echo base_url();?>assets/img/loader4.gif">
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
            "lengthMenu": [[10, 20, 50, 100, -1], [10, 20, 50, 100, "All"]]
        });
    });
</script>

<script>
    $(document).ready(function () {
        $('#myTable1').DataTable({
            "pageLength": 20,
            dom: 'Bfrtip',
            buttons: [
            'excel'
            ]
        });
    });
</script>

<script type="text/javascript">
    function save(num){
        document.getElementById('overlay').style.display ="block";
        alert('ข้อมูลที่สามารถบันทึกได้ <?php $num = 0; foreach ($search_view as $row) 
            { $num++; } echo $num; ?> รายการ | ข้อมูลที่ไม่สามารถบันทึกได้ <?php $num = 0; foreach ($search_view_not as $row) 
            { $num++; } echo $num; ?> รายการ');
        $.ajax({
            type:"POST",
            url:"<?php echo site_url('Payment_controller/loadpayment_insert')?>",
            data:$("#insert").serialize(),
        }).done(function(data){
            location.replace("loadpayment");
            document.getElementById('overlay').style.display ="none";

            $('#passwordsNoMatchRegister').fadeIn(500);
            setTimeout(function () {
                $('#passwordsNoMatchRegister').fadeOut(500);
            }, 3000);
        })
    }
</script>
<script type="text/javascript">
    $(function() {
        $('#btnload').click(function() {
            $(this).html('<img src="http://www.bba-reman.com/images/fbloader.gif" />');
        }) 
    })
</script>

<script type="text/javascript">
    function save_get(){
        document.getElementById('overlay').style.display ="block";
        $.ajax({
            type:"POST",
            url:"<?php echo site_url('Payment_controller/loadpayment_get_from')?>",
            data:$("#insert1").serialize(),
        }).done(function(data){ 
            location.replace("loadpayment");
            document.getElementById('overlay').style.display ="none";

            $('#passwordsNoMatchRegister').fadeIn(500);
            setTimeout(function () {
                $('#passwordsNoMatchRegister').fadeOut(500);
            }, 3000);
        })
    }
</script>

</html>



