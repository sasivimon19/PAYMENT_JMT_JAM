<!DOCTYPE html>
<html>
     <head>
      <title>Payment</title>
   
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/font-awesome-4.7.0/css/font-awesome.min.css">
      <link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>css/3.css">
      <script type = 'text/javascript' src = "<?php echo base_url(); ?>js/company.js"></script>
      <link href="<?php echo base_url(); ?>assets/sweetalert/dist/sweetalert.css" rel="stylesheet" type="text/css"> 
      <script src="<?php echo base_url(); ?>assets/sweetalert/dist/sweetalert.min.js"></script> 
      <script src="<?php echo base_url(); ?>AdminLTE/plugins/jquery/jquery.min.js"></script>

    </head>
    <body>

        <div id="main">
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
                                                <h4 align="center" style="color: #040404;margin-bottom: 0px;margin-top: 0px;">
                                                    <!--<img style="width: 50px;" src="<?php //echo base_url('/image/' . $data->pic); ?>">-->
                                                    <?php foreach ($company as $data) {
                                                      echo iconv('tis-620', 'utf-8', $data->name);
                                                     } ?></h4>
                                            </div>
                                            <div class="col-sm-6"></div>
                                        </div>
                                        
                                          <?php foreach ($username as $row){ ?>
                                                <?php $user_level = $row->user_level;?>
                                           <?php } ?>
                                        
                                        <div class="container" style=" margin-top: 2%;">
                                            <div class="row">
                                                <div class="col-sm-8">
                                                    <div id="myCarousel" class="well">
                                                        <?php foreach ($company as $data) { ?>
                                                            <form id ="brand" method = "post" action ="<?php echo site_url('Payment_controller/edit_company?id=' . $data->comid); ?>"enctype = "multipart/form-data">
                                                                <div class="form-group">
                                                                    <label for="text">ชื่อผู้ประกอบการ:</label>
                                                                    <input type="text" class="form-control" id="name" name="name" value="<?php echo iconv('tis-620', 'utf-8', $data->name) ?>" disabled="true">
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
                                                                <?php if ($user_level == 0) { ?>        
                                                                <button type="summit" onclick="save()" name="edit" value="Edit" id="save" class="btn btn-success btn pull-right margin glyphicon glyphicon glyphicon-floppy-saved" disabled> Save</button>
                                                               <?php } else { ?>
                                                                 <button type="summit" onclick="save()" name="edit" value="Edit" id="save" class="btn btn-success btn pull-right margin glyphicon glyphicon glyphicon-floppy-saved" > Save</button>
                                                                <?php } ?>
                                                            </form>
                                                        <?php } ?>
                                                        <br>
                                                      
                                                        <?php if ($user_level == 0) { ?>
                                                            <button type="button"  onclick="edit()" id="edit" name="" class="btn btn-light " style=" background-color: gray;" disabled> Edit</button>   
                                                        <?php } else { ?>
                                                            <button type="button"  onclick="edit()" id="edit" name="" class="btn btn-light" style=" background-color: gray;"> Edit</button>
                                                        <?php } ?>
                                                         <button type="button" onclick="cancel()" id="cancel" name="cancel" class="btn btn-danger"  disabled > Cancel</button>
                                                    </div>
                                                </div>

                                                <div class="col-sm-4">
                                                    <div class="well"> 
                                                    <?php foreach ($company as $data) { ?>
                                                            <form id ="brand" method = "post" action ="<?php echo site_url('Payment_controller/pic_company?id=' . $data->comid); ?>"enctype = "multipart/form-data">
                                                                <div class="form-group">
                                                                    <label for="picture">รูปภาพ:</label><br/>
                                                                    <div align="center" style="width: 100%;margin-bottom: 10px;">
                                                                        <img style="width: 50%;" src="<?php echo base_url('/assets/Uploadimages/' . $data->pic); ?>">
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


<script>
    function edit() {
       document.getElementById("name").disabled = false;  
       document.getElementById("address").disabled = false;
       document.getElementById("taxno").disabled = false;
       document.getElementById("taxrate").disabled = false;
       document.getElementById("CODE").disabled = false;

    }
</script>

