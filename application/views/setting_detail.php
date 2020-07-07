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



        <div id="main" style=" margin-top: -2%;">
            <div class="wrapper">
                <div class="content-wrapper">
                    <section class="content" >
                        <div class="container-fluid">
                            <div class="card card-secondary">
                                <div class="card-header" style="background-color: #c3000d;">
                                    <h3 class="card-title"> <b>จัดการข้อมูลผู้ใช้งาน</b> </h3>
                                </div>
                                <div class="card-body">
                                    <?php foreach ($user as $row) { ?>
                                        <form id ="brand" method = "post" action ="<?php echo site_url('Payment_controller/setting_update?id=' . $row->id_run); ?>"enctype = "multipart/form-data">
                                            <div class="w3-container">
                                                <div class="input-group">
                                                    <span class="input-group-addon">ชื่อ-นามสกุล</span>
                                                    <input id="name" type="text" class="form-control" name="name" value="<?php echo iconv('tis-620', 'utf-8', $row->name) ?>">
                                                </div><br/>
                                                <div class="input-group">
                                                    <span class="input-group-addon">User Level</span>
                                                    <span class="form-control">
                                                        <?php
                                                        foreach ($rights as $key) {
                                                            if ($row->user_level == $key->Right_Level) {
                                                                ?>
                                                                <label class="radio-inline"><input type="radio" name="Rights" value=" <?php echo $key->Right_Level; ?>" checked>  <?php echo $key->Subject_Right; ?></label>
                                                            <?php } else { ?>
                                                                <label class="radio-inline"><input type="radio" name="Rights" value="<?php echo $key->Right_Level; ?>">  <?php echo $key->Subject_Right; ?></label>
                                                                    <?php }
                                                            } ?>
                                                    </span>

                                                </div><br/>
                                                <div class="input-group">
                                                    <span class="input-group-addon">บริษัท</span>
                                                    <select class="form-control" id="company" name="company">
                                                        <option value="<?php echo $row->company; ?>">
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
                                                        </option>
                                                        <option value="jmt">JMT</option>
                                                        <option value="jam">JAM</option>
                                                    </select>
                                                </div><br/>
                                                <div class="input-group">
                                                    <span class="input-group-addon">Username</span>
                                                    <input id="Username" type="text" class="form-control" name="Username" value="<?php echo $row->username; ?>">
                                                </div><br/>
                                                <div class="input-group">
                                                    <span class="input-group-addon">Password</span>
                                                    <input id="Password" type="Password" class="form-control" name="Password" value="<?php echo $row->password; ?>">
                                                </div><hr>                  
                                                <table class="" style="width: 100%;text-align: left;">
                                                    <tr>
                                                        <td style="width: 49.5%;"><b style="font-size: 1.2em;">เมนู</b></td>
                                                        <td style="width: 49.5%;"><b style="font-size: 1.2em;">Modul</b></td>
                                                    </tr>
                                                </table>
                                                <table class="" style="width: 100%;text-align: left;">
                                                                    <?php $num = 1;
                                                                    foreach ($username_menu_ID as $rw) { ?>
                                                        <tr>
                                                            <td style="width: 49.5%;">

                                                                <div class="form-check">
                                                                    <label class="form-check-label">
                                                                        <input type="checkbox" class="form-check-input" name="num[]" value="<?php echo $rw->ID ?>" <?php foreach ($menu_view as $mn) {
                                                        if ($mn->id_menu == $rw->ID) {
                                                            echo "checked";
                                                        }
                                                    } ?>
                                                        <?php echo iconv('tis-620', 'utf-8', $rw->Subject); ?>
                                                                    </label>
                                                                </div>

                                                            </td>
                                                            <td style="width: 0.2%;background: black;"></td>
                                                                <?php if (iconv('tis-620', 'utf-8', $rw->Subject) == "โหลดข้อมูล Payment") { ?>
                                                                <td style="width: 49.5%;padding-left: 15px;">
                                                                    <div class="radio">
                                                                        <span><b> โหล Payment ข้ามเดือน : </b></span>
                                                                        <label><input type="radio" name="chkPeriod" value="1" <?php if ($row->chkPeriod == '1') { echo "checked";} ?>> ได้</label>
                                                                        <label><input type="radio" name="chkPeriod" value="0" <?php if ($row->chkPeriod == '0') {echo "checked";} ?>> ไม่ได้</label>
                                                                    </div>
                                                                </td>
                                                            <?php } ?>
                                                        </tr>
                                                <?php $num++;  } ?>
  
                                                </table>
                                            </div><hr>
                                            <footer style="text-align: right;" class="w3-container">
                                                <button type="submit" class="btn btn-success">Save</button>
                                                <a href="<?php echo site_url('Payment_controller/setting_index'); ?>"><button type="button" class="btn btn-danger">Black</button></a>
                                            </footer>
                                        </form>
                                        <?php } ?>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>             
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



