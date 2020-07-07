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

    <body>



        <div id="id01" class="modal" style=" margin-top: 10%;">
            <form id ="brand" method = "post" action ="<?php echo site_url('Payment_controller/setting_insert'); ?>"enctype = "multipart/form-data">
                <div align="center" class="modal-content">
                    <header class="container"> 
                        <span onclick="document.getElementById('id01').style.display = 'none'" 
                              class="button large display-topright">&times;</span>
                        <h2>เพิ่มผู้ใช้งาน</h2>
                    </header><hr>
                    <div class="container">
                        <div class="input-group">
                            <span class="input-group-addon">ชื่อ-นามสกุล</span>
                            <input id="name" type="text" class="form-control" name="name" placeholder="กรอก ชื่อ-นามสกุล">
                        </div><br/>
                        <div class="input-group">
                            <span class="input-group-addon">User Level</span>
                            <!-- <select class="form-control" id="Rights" name="Rights">
                            <?php foreach ($rights as $key) { ?>
                                        <option value="<?php echo $key->Right_Level; ?>"><?php echo $key->Subject_Right; ?></option>
                            <?php } ?>
                            </select> -->

                            <span class="form-control" style="text-align: left;">
                                <?php foreach ($rights as $key) { ?>
                                    <label class="radio-inline"><input type="radio" name="Rights" value="<?php echo $key->Right_Level; ?>"><?php echo $key->Subject_Right; ?></label>
                                <?php } ?>
                            </span>
                        </div><br/>
                        <div class="input-group">
                            <span class="input-group-addon">บริษัท</span>
                            <select class="form-control" id="company" name="company">
                                <option value="">กรุณาเลือก บริษัท</option>
                                <option value="jmt">JMT</option>
                                <option value="jam">JAM</option>
                            </select>
                        </div><br/>
                        <div class="input-group">
                            <span class="input-group-addon">Username</span>
                            <input id="Username" type="text" class="form-control" name="Username" placeholder="">
                        </div><br/>
                        <div class="input-group">
                            <span class="input-group-addon">Password</span>
                            <input id="Password" type="Password" class="form-control" name="Password" placeholder="">
                        </div>
                    </div><hr>
                    <footer style="text-align: right;" class="w3-container">
                        <button type="submit" class="btn btn-success">Save</button>
                        <!-- <a href=""><button type="button" class="btn btn-danger">Close</button></a> -->
                    </footer><br/>
                </div>
            </form>
        </div>

    </div>
</div>                
<hr>

<div id="main">
    <div class="wrapper">
        <div class="content-wrapper">
            <section class="content" style=" padding-top:2%;">
                <div class="container-fluid">
                    <div class="card card-secondary">
                        <div class="card-header" style="background-color: #c3000d;">
                            <h3 class="card-title"> <b>จัดการข้อมูลผู้ใช้งาน</b> </h3>
                            <div class="card-tools">
                             
                                <button type="button" class="btn btn-info" onclick="document.getElementById('id01').style.display = 'block'">Add User</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover" id="myTable">
                                    <thead  style="background-color: gray;">
                                        <tr>
                                            <th>No</th>
                                            <th>Username</th>
                                            <th style="text-align: center;">Company</th>
                                            <th style="text-align: center;">Status</th>
                                            <th style="text-align: center;">Rights</th>
                                            <th style="text-align: center;">Option</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $num = 1;
                                        foreach ($user as $row) {
                                            ?>
                                            <tr>
                                                <td><?php echo $num; ?></td>
                                                <td><?php echo iconv('tis-620', 'utf-8', $row->name); ?></td>
                                                <td style="text-align: center;">
                                                    <?php
                                                    if ($row->company == 'jmt') {
                                                        echo "JMT";
                                                    }
                                                    ?> 
                                                    <?php
                                                    if ($row->company == 'jam') {
                                                        echo "JAM";
                                                    }
                                                    ?>  
                                                </td>
                                                <td style="text-align: center;">
                                                        <?php if ($row->user_status == 1) { ?>
                                                        <a onclick="Status()" href="<?php echo site_url('/Payment_controller/setting_status?id=') . $row->id_run; ?>"><span style="color: green;"><i style="font-size: 1.3em;" class="glyphicon glyphicon-ok"> </i> เปิดใช้งาน</span></b>
                                                        <?php } else { ?>
                                                            <a onclick="Status()" href="<?php echo site_url('/Payment_controller/setting_status?id=') . $row->id_run; ?>"><span style="color: red;"><i style="font-size: 1.3em;" class="glyphicon glyphicon-remove"> </i> ปิดใช้งาน</span></a>
                                                        <?php } ?>                                        
                                                </td>
                                                <td style="text-align: center;">
                                                    <?php if ($row->user_level == 0) { ?>
                                                        <span style="">User</span>
                                                    <?php } ?>
                                                    <?php if ($row->user_level == 1) { ?>
                                                        <span style="color: DodgerBlue;">Manager</span>
                                                    <?php } ?> 
                                                    <?php if ($row->user_level == 2) { ?>
                                                        <span style="color: Orange;">SuperAdmin</span>
                                                    <?php } ?> 
                                                </td>
                                                <td style="text-align: center;"><a href="<?php echo site_url('/Payment_controller/setting_detail?id=') . $row->id_run; ?>"  target="_blank"><button style="color: black;" type="button" class="btn btn-success"><i class="glyphicon glyphicon-pencil"> </i> Update</button></a></td> 
                                            </tr>                               
                                                   <?php $num++;} ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
            </section> 
        </div>
    </div>
</div>  


<div class="row content">
</div>                        
<hr>
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


</html>



