<!DOCTYPE html>
<html>
     <head>
      <title>Payment</title>
   
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta name="viewport" content="width=device-width, initial-scale=1">
<!--        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->

        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>css/3.css">
        <script type = 'text/javascript' src = "<?php echo base_url(); ?>js/company.js"></script>

    </head>
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

        <div id="main">

            <!--    <div class="form-group">
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

            <!--<div class="divvv w3-animate-right" style="background-color:#FFFFFF; overflow:auto">-->
            <!--         <div id="main">-->
            <div class="wrapper">
                <div class="content-wrapper">
                    <section class="content" style=" padding-top:2%;">
                        <div class="container-fluid">
                            <div class="card card-secondary">
                                <div class="card-header" style="background-color: #c3000d;">
                                    <h3 class="card-title"> <b> ข้อมูลบริษัท </b> </h3>
<!--                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                    </div>-->
                                </div>
                                <div class="card-body"> 

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-sm-6" style="width: 100%;">
                                                <h3 align="center" style="color: #040404;margin-bottom: 0px;margin-top: 0px;">
                                                    <!--<img style="width: 50px;" src="<?php //echo base_url('/image/' . $data->pic); ?>">-->
                                                    <?php foreach ($company as $data) {
                                                echo iconv('tis-620', 'utf-8', $data->name);
                                                } ?></h3>
                                            </div>
                                            <div class="col-sm-6"></div>
                                        </div>
                                        
                                        <div class="container" style=" margin-top: 2%;">
                                            <div class="row">
                                                <div class="col-sm-8">
                                                    <div id="myCarousel" class="well">
                                                        <?php foreach ($company as $data) { ?>
                                                            <form id ="brand" method = "post" action ="<?php echo site_url('Payment_controller/edit_company?id=' . $data->comid); ?>"enctype = "multipart/form-data">
                                                                <div class="form-group">
                                                                    <label for="text">ชื่อผู้ประกอบการ:</label>
                                                                    <input type="text" class="form-control" id="name" name="name" value="<?php echo iconv('tis-620', 'utf-8', $data->name) ?>"   disabled>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="text">สถานประกอบการ:</label>
                                                                    <input type="text" class="form-control" id="address" name="address" value="<?php echo iconv('tis-620', 'utf-8', $data->address) ?>"  disabled>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="text">เลขประจำตัวผู้เสียภาษี:</label>
                                                                    <input type="text" class="form-control" id="taxno" name="taxno" value="<?php echo iconv('tis-620', 'utf-8', $data->taxno) ?>"  disabled>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="text">อัตราภาษี:</label>
                                                                    <input type="text" class="form-control" id="taxrate" name="taxrate" value="<?php echo iconv('tis-620', 'utf-8', $data->taxrate) ?>"  disabled>
                                                                </div>

                                                                <div style="display: none;" class="form-group">
                                                                    <label for="code">CODE:</label>
                                                                    <input type="text" class="form-control" id="code" name="code" value="<?php foreach ($username as $row): echo iconv('TIS-620', 'UTF-8', $row->company);
                                                                    endforeach; ?>"  disabled>
                                                                </div>

                                                                <button type="summit" onclick="save()" name="edit" value="Edit" id="save" class="btn btn-success btn pull-right margin glyphicon glyphicon glyphicon-floppy-saved" disabled> Save</button>
                                                                </tr>
                                                            </form>
                                                        <?php } ?>
                                                        <br>
                                                        <?php foreach ($username as $row): ?>
                                                            <?php if ($row->user_level == 0) { ?>
                                                                <button type="button"  onclick="edit()" id="edit" name="" class="btn btn-light btn pull-center margin glyphicon glyphicon glyphicon-edit" disabled> Edit</button>   
                                                            <?php } else { ?>
                                                                <button type="button"  onclick="edit()" id="edit" name="" class="btn btn-light btn pull-center margin glyphicon glyphicon glyphicon-edit" > Edit</button>

                                                        <?php } endforeach; ?>
                                                        <button type="button" onclick="cancel()" id="cancel" name="cancel" class="btn btn-danger btn pull-center margin glyphicon glyphicon glyphicon-remove" disabled > Cancel</button>
                                                    </div>
                                                </div>

                                                <div class="col-sm-4">
                                                    <div class="well"> 
                                                    <?php foreach ($company as $data) { ?>
                                                            <form id ="brand" method = "post" action ="<?php echo site_url('Payment_controller/pic_company?id=' . $data->comid); ?>"enctype = "multipart/form-data">
                                                                <div class="form-group">
                                                                    <label for="picture">รูปภาพ:</label><br/>
                                                                    <div align="center" style="width: 100%;margin-bottom: 10px;">
                                                                        <img style="width: 50%;" src="<?php echo base_url('/image/' . $data->pic); ?>">
                                                                    </div>
                                                                    <?php foreach ($username as $row):
                                                                        if ($row->user_level == 0) {
                                                                            ?>
                                                                            <input type="file" name="picname" class="form-control" style="padding: 3px;display: none;">
                                                                    <?php } else { ?>
                                                                            <input type="file" name="picname" class="form-control" style="padding: 3px">
                                                                    <?php } endforeach; ?>

                                                                </div>
                                                                <?php foreach ($username as $row):
                                                                    if ($row->user_level == 0) {
                                                                        ?>
                                                                        <button type="summit" class="btn btn-success btn pull-center btn " disabled>Save</button>
                                                                        <button type="button" class="btn btn-danger btn pull-center btn " disabled>Delete</button> 
                                                                <?php } else { ?>
                                                                        <button type="summit" class="btn btn-success btn pull-center btn ">Save</button>  
                                                                        <a href="<?php echo site_url('Payment_controller/pic_company_delete?id=' . $data->comid); ?>"><button type="button" class="btn btn-danger btn pull-center btn ">Delete</button></a>
                                                                <?php } endforeach; ?>
                                                                <?php } ?>
                                                        </form>
                                                    </div>
                                                </div>

                                            </div>
                                            <hr>
                                        </div>

                                        <br>
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

