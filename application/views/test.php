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
    <body style="background-color:#a6a6a6;">

        <div class="w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:none" id="mySidebar">
            <button style="text-align: right;" class="w3-bar-item w3-button w3-large"
            onclick="w3_close()"> &times;</button>
            <h5 style="text-align: center;">Menu</h5>
            <a href="<?php echo site_url('Payment_controller/loadpayment'); ?>" class="w3-bar-item w3-button w3-padding w3-blue"><i class="fa fa-upload fa-fw" style="color:#088A08;"></i>  โหลดข้อมูล Payment</a>
            <a href="<?php echo site_url('Payment_controller/customer'); ?>" class="w3-bar-item w3-button w3-padding"><i class="fa fa-eye fa-fw" style="color:#045FB4;"></i>  ข้อมูลลูกค้า</a>
            <a href="<?php echo site_url('Payment_controller/company'); ?>" class="w3-bar-item w3-button w3-padding"><i class="fa fa-building fa-fw" style="color:#B40404;"></i>  ข้อมูลบริษัท</a>
            <a href="<?php echo site_url('Payment_controller/export'); ?>" class="w3-bar-item w3-button w3-padding"><i class="fa fa-file-pdf-o fa-fw" style="color:#FF8000;"></i>  Export ใบกำกับภาษี</a>
            <a href="<?php echo site_url('Payment_controller/approve'); ?>" class="w3-bar-item w3-button w3-padding"><i class="fa fa-credit-card fa-fw" style="color:#FF0000;"></i>  ตัดยอดรับชำระ Approve</a>
            <a href="<?php echo site_url('Payment_controller/approve2'); ?>" class="w3-bar-item w3-button w3-padding"><i class="fa fa-credit-card fa-fw" style="color:#FF0000;"></i>  ตัดยอดรับชำระ (เฉพาะฝั่งบัญชี)</a>
            <a href="<?php echo site_url('Payment_controller/bank'); ?>" onclick="return bank();" class="w3-bar-item w3-button w3-padding"><i class="fa fa-bank fa-fw" style="color:#088A08;"></i>  ช่องทางการชำระ</a>
            <a href="<?php echo site_url('Payment_controller/paymonth'); ?>" class="w3-bar-item w3-button w3-padding"><i class="fa fa-tasks fa-fw" style="color:#5F04B4;"></i>  ยอดชำระรายเดือน</a>
            <a href="<?php echo site_url('Payment_controller/keyin'); ?>" class="w3-bar-item w3-button w3-padding"><i class="fa fa-history fa-fw" style="color:#610B38;"></i>  บันทึกรับชำระ (Key IN)</a>
            <a href="<?php echo site_url('Payment_controller/balancedb'); ?>" class="w3-bar-item w3-button w3-padding"><i class="fa fa-database fa-fw" style="color:#D7DF01;"></i>  ตรวจสอบ E-Balance(DB)</a>
            <a href="<?php echo site_url('Payment_controller/balanceadmin'); ?>" class="w3-bar-item w3-button w3-padding"><i class="fa fa-database fa-fw" style="color:#D7DF01;"></i>  กระทบยอด E-Balance(Admin)</a>
            <a href="<?php echo site_url('Payment_controller/invoice'); ?>" class="w3-bar-item w3-button w3-padding"><i class="fa fa-table fa-fw" style="color:#01A9DB;"></i>  โหลดข้อมูลที่ invoice แล้ว</a>
            <a href="<?php echo site_url('Payment_controller/receive'); ?>" class="w3-bar-item w3-button w3-padding"><i class="fa fa-plus-square fa-fw" style="color:#1cd607;"></i>  กำหนดเลขที่ใบเสร็จ</a>
            <h5 style="text-align: center;">Report</h5>
            <a href="<?php echo site_url('Payment_controller/model'); ?>" class="w3-bar-item w3-button w3-padding"><i class="fa fa-file fa-fw" style="color:#1C1C1C;"></i>  Daily Receive Report</a>
            <a href="<?php echo site_url('Payment_controller/model2'); ?>" class="w3-bar-item w3-button w3-padding"><i class="fa fa-file fa-fw" style="color:#1C1C1C;"></i>  Summary Receive Report</a>
            <a href="<?php echo site_url('Payment_controller/model3'); ?>" class="w3-bar-item w3-button w3-padding"><i class="fa fa-file fa-fw" style="color:#1C1C1C;"></i>  Summary Discount Report</a>
            <a href="<?php echo site_url('Payment_controller/model4'); ?>" class="w3-bar-item w3-button w3-padding"><i class="fa fa-file fa-fw" style="color:#1C1C1C;"></i>  Tax Report</a>
            <a href="<?php echo site_url('Payment_controller/model5'); ?>" class="w3-bar-item w3-button w3-padding"><i class="fa fa-file fa-fw" style="color:#1C1C1C;"></i>  Outstanding Report(Detail)</a>
            <a href="<?php echo site_url('Payment_controller/model6'); ?>" class="w3-bar-item w3-button w3-padding"><i class="fa fa-file fa-fw" style="color:#1C1C1C;"></i>  Outstanding Report(Summary)</a>
            <a href="<?php echo site_url('Payment_controller/model7'); ?>" class="w3-bar-item w3-button w3-padding"><i class="fa fa-file fa-fw" style="color:#1C1C1C;"></i>  Export to Excel</a>
            <a href="<?php echo site_url('Payment_controller/model8'); ?>" class="w3-bar-item w3-button w3-padding"><i class="fa fa-file fa-fw" style="color:#1C1C1C;"></i>  รายงานปรับปรุงรายวัน</a><br><br>
        </div>

        <div id="main">
            <div class="form-group">
                <div class="w3-teal container-fluid">
                    <ul class="nav navbar-nav navbar-right">
                        <li style="margin-top: 15px;">
                            <span class="glyphicon glyphicon-user"></span> 
                            <?php foreach ($username as $row):?>
                                <?php echo iconv('TIS-620','UTF-8', $row->name); ?>
                            <?php endforeach;?>
                        </li>
                        <li><a href="<?php echo site_url(); ?>/Payment_controller/logout"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
                    </ul>
                    <button id="openNav" class="w3-button w3-teal w3-xlarge container-fluid" onclick="w3_open()">&#9776;</button>
                    <label for="text"><?php foreach ($company as $data) { echo iconv('tis-620', 'utf-8', $data->name); }?></label>

                    <div class="w3-container">
                    </div>
                </div>
            </div>
<!-- <?php if ($Agreement > 0) {
    echo $Agreement;
} ?> -->
<div class="divvv w3-animate-right" style="background-color:#FFFFFF;"  >
    <div class="row" style="width: 100%;">
        <div class="col-sm-4" style="width: 100%;">
            <h3 align="center" style="color: #040404;margin-bottom: 0px;margin-top: 0px;">โหลดข้อมูลรับชำระ</h3>
        </div>
        <div class="col-sm-4">
        </div>
    </div>
    <hr>
    <form name="load" action="<?php echo site_url('Payment_controller/loadpayment_from'); ?>" method="post" onSubmit="JavaScript:return loadSubmit();" enctype="multipart/form-data">
        <table style="width: 50%;">
            <tr>
                <td>
                    <input class="form-control" type="file" name="file" style="padding-right: 0px;padding-top: 1px;padding-bottom: 35px;padding-left: 1px;width: 98%;padding-right: 1px;margin-bottom: 10px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);" required>
                </td>
                <td>
                    <button style="width: 100%;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);margin-bottom: 10px;" type="submit" name="submit" class="btn btn-primary">Open</button> 
                </td>
            </tr>
        </table>
    </form>
    <div>
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
                <?php $num = 1; foreach ($search_view as $row) 
                { ?>
                    <tr>
                        <td><?php echo $num; ?></td>
                        <td><?php echo date("m-d-Y",strtotime($row->Date1)); ?></td>
                        <td><?php echo $row->Agreement; ?></td>
                        <td><?php echo $row->IDCard; ?></td>
                        <td><?php echo $row->Channel; ?></td>
                        <td><?php echo $row->Ref1; ?></td>
                        <td><?php echo date("m-d-Y",strtotime($row->Ref2)); ?></td>
                        <td style="text-align : right;"><?php echo $row->Amount; ?></td>
                        <td><?php echo $row->Lot; ?></td>
                        <td><?php echo $row->Remark; ?></td>
                        <td style="text-align : right;<?php if (($row->OSbalance - $row->Amount) < 0) { ?>
                            color: red;
                            <?php } ?>"><b><?php echo ($row->OSbalance - $row->Amount); ?></b></td>
                        </tr>
                        <?php $num++; 
                    }?>
                </tbody>
            </table>
            <div>
                <form action="<?php echo site_url('Payment_controller/loadpayment_insert'); ?>" method = "post" enctype = "multipart/form-data" >
                    <div style="display: none;">
                        <?php $num = 1; foreach ($search_view as $row) 
                        { ?>
                            <input type="text" name="Date1[]" value="<?php echo $row->Date1; ?>">
                            <input type="text" name="Agreement[]" value="<?php echo $row->Agreement; ?>">
                            <input type="text" name="IDCard[]" value="<?php echo $row->IDCard; ?>">
                            <input type="text" name="Channel[]" value="<?php echo $row->Channel; ?>">
                            <input type="text" name="Ref1[]" value="<?php echo $row->Ref1; ?>">
                            <input type="text" name="Ref2[]" value="<?php echo $row->Ref2; ?>">
                            <input type="text" name="Amount[]" value="<?php echo $row->Amount; ?>">
                            <input type="text" name="Lot[]" value="<?php echo $row->Lot; ?>">
                            <input type="text" name="Remark[]" value="<?php echo $row->Remark; ?>">
                            <input type="text" name="OSbalance[]" value="<?php echo $row->OSbalance; ?>"><br/>
                        <?php } ?>
                    </div>
                    <a href="<?php echo site_url('Payment_controller/delete_loadpayment_simulate'); ?>"><button style="width: 15%;margin: 15px;" type="button" class="btn btn-danger">ล้างข้อมูล</button></a>
                    <button style="width: 15%;margin: 15px;" type="submit" class="btn btn-success">บันทึก</button>
                </form>
            </div>
        </div>
        <hr>
        <div align="right" style="width: 100%;">
            <div style="width: 100%;text-align: left;overflow: auto;">
                <h4>รายการที่ไม่สามารถบันทึกได้</h4>
                <hr>
                <table id="myTable1" class="table" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);overflow: auto;font-size: 0.9em;width: 99.9%;">
                    <thead>
                        <tr style="background-color:#040404;color: #FFFFFF;">
                            <th>No</th>
                            <th>IDCard</th>
                            <th>Contract No</th>
                            <th>Channel</th>
                            <th>ID</th>
                            <th>Remark</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $num = 1; foreach ($search_view_not as $row) 
                        { ?>
                            <tr>
                                <td><?php echo $num; ?></td>
                                <td><?php echo $row->IDCard; ?></td>
                                <td><?php echo $row->Agreement; ?></td>
                                <td><?php echo $row->Channel; ?></td>
                                <td><?php echo $row->ID; ?></td>
                                <td style="color: red;"><b>
                                    ข้อมูล 
                                    <?php 
                                    foreach ($get_IDCard as $key) { 
                                        if ($key->ID  == $row->ID) {
                                            echo "IDCard ";
                                        }
                                    }
                                    foreach ($get_ContractNo as $key) { 
                                        if ($key->ID  == $row->ID) {
                                            echo "ContractNo ";
                                        }
                                    }
                                    foreach ($get_Channel as $key) { 
                                        if ($key->ID  == $row->ID) {
                                            echo "Channel ";
                                        }
                                    }
                                    ?>    
                                    ไม่ถกต้อง                                    
                                </b></td>
                            </tr>
                            <?php $num++; 
                        }?>
                    </tbody>
                </table>
            </div>
        </div>
        <hr>
    </div>
</div>
</body>

<script>
    $(document).ready(function () {
        $('#myTable').DataTable();
    });
</script>
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
        $('#myTable1').DataTable({
            dom: 'Bfrtip',
            buttons: [
            'excel'
            ]
        });
    });
</script>

</html>



