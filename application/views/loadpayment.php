<!DOCTYPE html>
<html>
    <title>Payment</title>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

        <!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->


        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>css/1.css">
        <script type = 'text/javascript' src = "<?php echo base_url(); ?>js/js.js"></script>
        <!--<link href="<?php echo base_url(); ?>assets/DataTables/DataTables-1.10.18/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">--> 
        <!--<script src="<?php echo base_url(); ?>assets/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js"></script>-->
        <!--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">-->
        <!--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">-->

        <style type="text/css">

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
    </head>



    <div id="main">
        <div class="wrapper">
            <div class="content-wrapper">
                <br>
                <div class="alert alert-success alert-dismissible fade show" role="alert" id="passwordsNoMatchRegister" style=" display: none;">
                    <strong>Success!</strong> บันทึกข้อมูลสำเร็จ
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <section class="content" style=" padding-top: 8%;">
                    <div class="container-fluid">
                        <div class="divvv w3-animate-right" style="background-color:#FFFFFF;margin-top: 0px;">
                            <div class="row content" style=" margin-top: -5%;">
                                <div class="col-sm-12">
                                    <div class="card card-primary card-outline">
                                        <div class="card-header">
                                            <h3 class="card-title">
                                                <i class="fas fa-edit"></i>
                                                โหลดข้อมูลรับชำระ
                                            </h3>
                                        </div>

                                        <div class="card-body">
                                            <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                                                <li class="nav-item">
                                                    <a  class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill" href="#custom-content-below-home" role="tab" aria-controls="custom-content-below-home" aria-selected="true">รายการที่สามารถบันทึกได้ (<span style="color: green;"><?php $num = 0;
                                                    foreach ($search_view as $row) {
                                                        $num++;
                                                    } echo $num; ?></span>)</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a  class="nav-link" id="custom-content-below-profile-tab" data-toggle="pill" href="#custom-content-below-profile" role="tab" aria-controls="custom-content-below-profile" aria-selected="false">รายการที่ไม่สามารถบันทึกได้ (<span style="color: red;"><?php $num = 0;
                                                    foreach ($search_view_not as $row) {
                                                        $num++;
                                                    } echo $num; ?></span>)</a>
                                                </li>
                                                <li class="nav-item">
                                                   
                                                    <a class="nav-link" id="custom-content-below-messages-tab" data-toggle="pill" href="#custom-content-below-messages" role="tab" aria-controls="custom-content-below-messages" aria-selected="false">เพิ่มข้อมูล Payment</a>
                                                </li>


                                                <li class="nav-item">
                                                    <form action="<?php echo site_url('Payment_controller/loadpayment_from'); ?>" method="post" onSubmit="JavaScript:return loadSubmit();" enctype="multipart/form-data">
                                                        <div class="col-md-10">
                                                            <div class="input-group mb-4">
                                                                <input type="file" name="file"  id="contract" class="form-control">
                                                                <div class="input-group-prepend" >
                                                                    <button class="btn btn-success" type="submit" name="btnload" id="btnload" onclick="Upload_FileMiddle()"><i class="fas fa-file-import"></i> <b> UPLOAD </b> </button>
                                                                </div>   
                                                            </div>
                                                        </div>
                                                    </form>
                                                </li>
                                            </ul>

                                            <div class="tab-content" id="custom-content-below-tabContent">
                                                <div class="tab-pane fade show active" id="custom-content-below-home" role="tabpanel" aria-labelledby="custom-content-below-home-tab">
                                                    <div class="tab-pane active" id="1"  style="overflow: auto;">
                                                        <div align="center" style="width: 100%;">
                                                                        <?php $x = 0;
                                                                        foreach ($search_view as $row) {
                                                                            $n = $row->Amount;
                                                                            $x = $x + $n;
                                                                        } ?>
                                                            <div class="input-group" style="margin-top: 5px;margin-bottom: 5px;width: 30%;">
                                                                <span class="input-group-addon"> ยอดรวม Amount : </span>
                                                                <b><input style="text-align: right;background: #000000;color: #F0FF03;width: 100%;" id="msg" type="text" class="form-control" name="msg" value="<?php echo number_format($x, 2); ?>" readonly></b>
                                                            </div>
                                                        </div>


                                                        <div id="DataSave">
                                                            <?php $this->load->view('pagedatasave'); ?>
                                                        </div>

                                                        <div align="center" style="width: 100%;">
                                                            <form id="insert" action="<?php echo site_url('Payment_controller/loadpayment_insert'); ?>" method = "post" enctype = "multipart/form-data" >
                                                                <div style="display: none;">
                                                                <?php $num = 1;
                                                                foreach ($search_view as $row1) {
                                                                    ?>
                                                                        <input type="text" name="<?php echo "Date1-" . $num ?>" id="Date1" value="<?php echo $row1->Date1; ?>">
                                                                        <input type="text" name="<?php echo "Agreement-" . $num ?>" id="<?php echo "Agreement-" . $num ?>" value="<?php echo $row1->Agreement; ?>">
                                                                        <input type="text" name="<?php echo "IDCard-" . $num ?>" id="<?php echo "IDCard-" . $num ?>" value="<?php echo $row1->IDCard; ?>">
                                                                        <input type="text" name="<?php echo "Channel-" . $num ?>" id="<?php echo "Channel-" . $num ?>" value="<?php echo $row1->Channel; ?>">
                                                                        <input type="text" name="<?php echo "Ref1-" . $num ?>" id="<?php echo "Ref1-" . $num ?>" value="<?php echo $row1->Ref1; ?>">
                                                                        <input type="text" name="<?php echo "Ref2-" . $num ?>" id="<?php echo "Ref2-" . $num ?>" value="<?php echo $row1->Ref2; ?>">
                                                                        <input type="text" name="<?php echo "Amount-" . $num ?>" id="<?php echo "Amount-" . $num ?>" value="<?php echo $row1->Amount; ?>">
                                                                        <input type="text" name="<?php echo "Lot-" . $num ?>" id="<?php echo "Lot-" . $num ?>" value="<?php echo $row1->Lot; ?>">
                                                                        <input type="text" name="<?php echo "Remark-" . $num ?>" id="<?php echo "Remark-" . $num ?>" value="<?php echo $row1->Remark; ?>">
                                                                        <hr>
                                                                    <?php $num++;} ?>
                                                                </div>
                                                            <?php $count = count($search_view);
                                                            if ($count == '0') { ?>
                                                                    <a  onclick="$('#overlay').show();"href="<?php echo site_url('Payment_controller/delete_loadpayment_simulate'); ?>"><button type="button" class="btn btn-danger">ล้างข้อมูล</button></a>
                                                                    <button type="button" class="btn btn-success " onclick="save(num = <?php echo $num ?>)" disabled>บันทึก</button>
                                                                <?php } else { ?>
                                                                    <a  onclick="$('#overlay').show();" href="<?php echo site_url('Payment_controller/delete_loadpayment_simulate'); ?>"><button  type="button" class="btn btn-danger">ล้างข้อมูล</button></a>

                                                                    <button  type="button" class="btn btn-success " onclick="save(num = <?php echo $num ?>)">บันทึก</button>
                                                                <?php } ?> 
                                                            </form>
                                                        </div>
                                                        <hr/>
                                                    </div>
                                                </div>



                                                <div class="tab-pane fade" id="custom-content-below-profile" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
                                                    <div id="Nodatasave">
                                                        <?php $this->load->view('pagenodatasave'); ?>
                                                    </div>
                                                </div>
                                                
                                                <div class="tab-pane fade" id="custom-content-below-messages" role="tabpanel" aria-labelledby="custom-content-below-messages-tab">     
                                                    <div id="Adddatasave">
                                                        <?php $this->load->view('Add_datasave'); ?>
                                                    </div>
                                                </div>    


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


<div align="center" id="overlay" onclick="off()">
    <img style="margin-top: 15%;width: 15%;" src="<?php echo base_url(); ?>assets/images/loader.gif">
</div>
</body>




<script type="text/javascript">
function save(num) {
document.getElementById('overlay').style.display = "block";
alert('ข้อมูลที่สามารถบันทึกได้ <?php
    $num = 0;
    foreach ($search_view as $row) {
        $num++;
    } echo $num;
    ?> รายการ | ข้อมูลที่ไม่สามารถบันทึกได้ <?php
    $num = 0;
    foreach ($search_view_not as $row) {
        $num++;
    } echo $num;
    ?> รายการ');
$.ajax({
    type: "POST",
    url: "<?php echo site_url('Payment_controller/loadpayment_insert') ?>",
    data: $("#insert").serialize(),
}).done(function (data) {
    location.replace("loadpayment");
 //   $('#PPPPPPPP').html(data);
    document.getElementById('overlay').style.display = "none";

 $('#passwordsNoMatchRegister').fadeIn(500);
      setTimeout(function () {
       $('#passwordsNoMatchRegister').fadeOut(500);
  }, 8000);
})
}
</script>

<script type="text/javascript">
    function save_get() {

        var date = document.getElementById('date').value;
        var Agreement = document.getElementById('Agreement').value;
        var IDCard = document.getElementById('IDCard').value;
        var Channel = document.getElementById('Channel').value;
        var Ref2 = document.getElementById('Ref2').value;
        var Amount = document.getElementById('Amount').value;
        if (date == '' | Agreement == '' | IDCard == '' | Channel == '' | Ref2 == '' | Amount == '') {
            alert('กรุณา กรอกข้อมูลให้ครบทุกช่อง');
        } else {
            document.getElementById('overlay').style.display = "block";
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('Payment_controller/loadpayment_get_from') ?>",
                data: $("#insert1").serialize(),
            }).done(function (data) {
                location.replace("loadpayment");
                document.getElementById('overlay').style.display = "none";

                $('#passwordsNoMatchRegister').fadeIn(500);
                setTimeout(function () {
                    $('#passwordsNoMatchRegister').fadeOut(500);
                }, 3000);
            })
        }
    }
</script>
<script type="text/javascript">
    $(function () {
        $('#btnload').click(function () {
            $(this).html('<img src="http://www.bba-reman.com/images/fbloader.gif" />');
        })
    })
</script>

</html>



