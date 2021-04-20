<!DOCTYPE html>
<html>
<title>Payment</title>

<head>


    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link href="<?php echo base_url(); ?>assets/sweetalert/dist/sweetalert.css" rel="stylesheet" type="text/css">
    <script src="<?php echo base_url(); ?>assets/sweetalert/dist/sweetalert.min.js"></script>
    <script src="<?php echo base_url(); ?>AdminLTE/plugins/jquery/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/1.css">
    <script type='text/javascript' src="<?php echo base_url(); ?>js/js.js"></script>


</head>

<style>
    #loadding {
        position: fixed;
        left: 0px;
        width: 100%;
        height: 100%;
        padding-left: 45%;
        padding-top: 15%;

    }

    .modal {
        display: none;
        position: fixed;
        height: 100%;
        background-color: rgb(0, 0, 0) !important;
        /* Fallback color */
        background-color: rgba(0, 0, 0, 0.4) !important;
        /* Black w/ opacity */
        padding-top: 0px;

    }

    @media only screen and (max-width: 600px) {
        .input-group-prepend {
            margin-left: 20px;
        }
    }
</style>

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

            <section class="content" style=" padding-top: 5%;">
                <div class="container-fluid">
                    <div class="divvv w3-animate-right" style="background-color:#FFFFFF !important;margin-top: 0px;">
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
                                                <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill" href="#custom-content-below-home" role="tab" aria-controls="custom-content-below-home" aria-selected="true">รายการที่สามารถบันทึกได้ (<span style="color: green !important;">
                                                        <?php $num = 0;
                                                        foreach ($search_view_count as $row) {
                                                            $num++;
                                                        }
                                                        echo $row->TRUECOUNT; ?></span>)</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="custom-content-below-profile-tab" data-toggle="pill" href="#custom-content-below-profile" role="tab" aria-controls="custom-content-below-profile" aria-selected="false">รายการที่ไม่สามารถบันทึกได้ (<span style="color: red !important;"><?php $num = 0;
                                                                                                                                                                                                                                                                                                                    foreach ($search_view_not_count as $row) {
                                                                                                                                                                                                                                                                                                                        $num++;
                                                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                                                    echo $row->FALSECOUNT; ?></span>)</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="custom-content-below-messages-tab" data-toggle="pill" href="#custom-content-below-messages" role="tab" aria-controls="custom-content-below-messages" aria-selected="false">เพิ่มข้อมูล Payment</a>
                                            </li>


                                            <li class="nav-item">
                                                <form id="submituploadfile" name="submituploadfile" method="post" onSubmit="JavaScript:return loadSubmit();" enctype="multipart/form-data">
                                                    <div class="col-md-10">
                                                        <div class="input-group mb-4">
                                                            <input type="file" name="file" id="contract" class="form-control">
                                                            <div class="input-group-prepend">
                                                                <button class="btn btn-success" type="button" name="btnload" id="btnload" onclick="Upload_FilePayment()"><i class="fas fa-file-import"></i> <b> UPLOAD </b> </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </li>
                                        </ul>



                                        <div class="tab-content" id="custom-content-below-tabContent">
                                            <div class="tab-pane fade show active" id="custom-content-below-home" role="tabpanel" aria-labelledby="custom-content-below-home-tab">
                                                <div class="tab-pane active" id="1">
                                                    <div align="center" style="width: 100%;">
                                                        <!-- <//?php $x = 0;
                                                                foreach ($search_view as $row) {
                                                                    $n = $row->Amount;
                                                                    $x = $x + $n;
                                                                } ?>
                                                        <div class="input-group" style="margin-top: 5px;margin-bottom: 5px;width: 30%;">
                                                            <span class="input-group-addon"> ยอดรวม Amount : </span>
                                                            <b><input style="text-align: right;background: #000000 !important;color: #F0FF03 !important;width: 100%;" id="msg" type="text" class="form-control" name="msg" value="<?php echo number_format($x, 2); ?>" readonly></b>
                                                        </div> -->
                                                        <?php
                                                        $x = 0;

                                                        foreach ($search_view_count_TOTAL as $row) {
                                                            $n = $row->Amount;
                                                            $x = $x + $n;
                                                        } ?>

                                                        <?php
                                                        $xx = 0;
                                                        foreach ($search_view_count_TOTALFALSE as $row) {
                                                            $nn = $row->Amount;
                                                            $xx = $xx + $nn;
                                                        }
                                                        ?>

                                                        <?php

                                                        $Sumtotal = $x + $xx;

                                                        ?>
                                                        <div class="row" style="margin-top: 5px;">
                                                            <div class="col-sm-3">ยอดรวม Amount รายการที่บันทึกได้ :</div>
                                                            <div class="col-sm-2">
                                                                <b> <input style="text-align: right;background: #000000 !important;color: #F0FF03 !important;width: 100%;" id="msg" type="text" class="form-control" name="msg" value="<?php echo number_format($x, 2); ?>" readonly></b>
                                                            </div>
                                                            <div class="col-sm-3">ยอดรวม Amount :</div>
                                                            <div class="col-sm-2">
                                                                <b> <input style="text-align: right;background: #000000 !important;color: #F0FF03 !important;width: 100%;" id="msg" type="text" class="form-control" name="msg" value="<?php echo number_format($Sumtotal, 2); ?>" readonly></b>
                                                            </div>
                                                        </div>
                                                        <br>

                                                    </div>

                                                    <input type="hidden" name="id_run" value="<?php echo $id_run ?>">

                                                    <div id="DataSave">
                                                        <?php $this->load->view('pagedatasave'); ?>
                                                    </div>

                                                    <div align="center" style="width: 100%;" id="DataSave1111">
                                                        <form id="insert" action="<?php echo site_url('Payment_controller/loadpayment_insert'); ?>" method="post" enctype="multipart/form-data">
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
                                                                <?php $num++;
                                                                } ?>
                                                            </div>
                                                            <?php $count = count($search_view);
                                                            if ($count == '0') { ?>
                                                                <button type="button" class="btn btn-danger " onclick="Deletesave()">ล้างข้อมูล</button>
                                                                <button type="button" class="btn btn-success " onclick="save(num = <?php echo $num ?>)" disabled>บันทึก</button>
                                                            <?php } else { ?>
                                                                <button type="button" class="btn btn-danger " onclick="Deletesave()">ล้างข้อมูล</button>
                                                                <button type="button" class="btn btn-success " onclick="save(num = <?php echo $num ?>)">บันทึก</button>
                                                            <?php } ?>
                                                        </form>
                                                    </div>
                                                    <hr />
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

<div id="loadding" class="modal" style="display: none">
    <img style="margin-top: 15%;width: 15%;" src="<?php echo base_url(); ?>assets/images/loader.gif">
</div>

</body>

<script>
    function Upload_FilePayment() {

        var submituploadfile = document.getElementById('contract').value;
        var form_data = new FormData();

        form_data.append('contract', $('#contract')[0].files[0]);

        if (submituploadfile == '') {
            swal("กรุณาเลือกไฟล์ข้อมูล", "", "warning");
        } else {
            document.getElementById("loadding").style.display = "block";
            document.submituploadfile.action = "<?php echo site_url('Payment_controller/loadpayment_from'); ?>"
            document.submituploadfile.submit();
        }
    }
</script>



<script type="text/javascript">
    function Deletesave() {

        // swal({
        //     title: "",
        //     text: "ข้อมูลที่สามารถบันทึกได้  <//?php $num = 0;
        //     foreach ($search_view as $row) {
        //     $num++;
        //  }
        //  echo $num; 
        //?> รายการ <//?php echo '\n' ?> ข้อมูลที่ไม่สามารถบันทึกได้ <//?php $num = 0;
        ///     foreach ($search_view_not as $row) {$num++;} echo $num; 
        ///?> รายการ",
        //             type: "warning",
        //             showCancelButton: true,
        //             confirmButtonClass: "btn-primary",
        //             confirmButtonText: "ลบข้อมูล!",
        //             cancelButtonText: "ไม่ลบข้อมูล!",
        //             closeOnConfirm: false,
        //             closeOnCancel: false

        //         },

        swal({
                title: "คุณแน่ใจหรือไม่",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "ลบข้อมูล!",
                cancelButtonText: "ไม่ลบข้อมูล!",
                closeOnConfirm: false,
                closeOnCancel: false,
                showLoaderOnConfirm: true,
            },
            function(isConfirm) {
                document.getElementById("loadding").style.display = "block";
                if (isConfirm) {
                    $.ajax({
                        type: "POST",
                        url: "<?php echo site_url('Payment_controller/delete_loadpayment_simulate') ?>",
                        data: $("#insert").serialize(),
                    }).done(function(data) {
                        setTimeout(function() {
                            swal({
                                    title: "ลบข้อมูลสำเร็จ",
                                    type: "success"
                                },
                                function() {
                                    location.replace("loadpayment");
                                });
                        }, 2000);
                    })
                } else {
                    swal("ไม่ลบข้อมูล", "", "error");
                }
                document.getElementById("loadding").style.display = "none";
            });
    }
</script>


<script type="text/javascript">
    function save(num) {

        swal({
                title: "คุณแน่ใจหรือไม่",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "ใช่บันทึกข้อมูล!",
                cancelButtonText: "ไม่บันทึกข้อมูล!",
                closeOnConfirm: false,
                closeOnCancel: false,
                showLoaderOnConfirm: true,
            },
            function(isConfirm) {
                document.getElementById("loadding").style.display = "block";
                if (isConfirm) {

                    $.ajax({
                        type: "POST",
                        url: "<?php echo site_url('Payment_controller/loadpayment_insert') ?>",
                        data: $("#insert").serialize(),
                    }).done(function(data) {

                        setTimeout(function() {
                            swal({
                                    title: "บันทึกข้อมูลสำเร็จ",
                                    type: "success"
                                },
                                function() {
                                    location.replace("loadpayment");
                                });
                        }, 2000);
                    })
                } else {
                    swal("ไม่บันทึกข้อมูล", "", "error");
                }
                document.getElementById("loadding").style.display = "none";
            });
    }
</script>

<script type="text/javascript">
    function save_get() {

        document.getElementById("loadding").style.display = "block";

        var date = document.getElementById('date').value;
        var Agreement = document.getElementById('Agreement').value;
        var IDCard = document.getElementById('IDCard').value;
        var Channel = document.getElementById('Channel').value;
        var Ref1 = document.getElementById('Ref1').value;
        var Ref2 = document.getElementById('Ref2').value;
        var Amount = document.getElementById('Amount').value;


        if (date == '') {
            swal("กรุณากรอกวันที่", "", "warning");
        } else if (Agreement == '') {
            swal("กรุณากรอก Contract No", "", "warning");
        } else if (IDCard == '') {
            swal("กรุณากรอก IDCard", "", "warning");
        } else if (Channel == '') {
            swal("กรุณากรอก Channel", "", "warning");
        } else if (Ref1 == '') {
            swal("กรุณากรอก Ref1", "", "warning");
        } else if (Ref2 == '') {
            swal("กรุณากรอก Ref2", "", "warning");
        } else if (Amount == '') {
            swal("กรุณากรอก Amount", "", "warning");
        } else {
            swal({
                    title: "คุณแน่ใจหรือไม่",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "ใช่บันทึกข้อมูล!",
                    cancelButtonText: "ไม่บันทึกข้อมูล!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            type: "POST",
                            url: "<?php echo site_url('Payment_controller/loadpayment_get_from') ?>",
                            data: $("#insert1").serialize(),
                        }).done(function(data) {
                            swal({
                                    title: "บันทึกข้อมูลสำเร็จ",
                                    type: "success"
                                },
                                function() {
                                    location.replace("loadpayment");
                                });
                        })
                    } else {
                        swal("ไม่บันทึกข้อมูล", "", "error");
                    }
                });
        }
        document.getElementById("loadding").style.display = "none";
    }
</script>

<!--<script type="text/javascript">
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
            document.getElementById('loadding').style.display = "block";
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('Payment_controller/loadpayment_get_from') ?>",
                data: $("#insert1").serialize(),
            }).done(function (data) {
                location.replace("loadpayment");
                document.getElementById('loadding').style.display = "none";

                $('#passwordsNoMatchRegister').fadeIn(500);
                setTimeout(function () {
                    $('#passwordsNoMatchRegister').fadeOut(500);
                }, 3000);
            })
        }
    }
</script>-->
<script type="text/javascript">
    $(function() {
        $('#btnload').click(function() {
            $(this).html('<img src="http://www.bba-reman.com/images/fbloader.gif" />');
        })
    })
</script>




<script>
    function pagedatapayno() { //แนบตัวแปร page ไปด้วย

        document.getElementById('loadding').style.display = "block";
        var page = document.getElementById('pageno').value;
        var datas = "page=" + page + "&pagesub=" + "N";

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Payment_controller/loadpayment') ?>",
            data: datas
        }).done(function(data) {
            document.getElementById('loadding').style.display = "none";
            $('#Nodatasave').html(data); //Div ที่กลับมาแสดง
        })
    }
</script>



<script>
    function pagedatapay() { //แนบตัวแปร page ไปด้วย    
        document.getElementById('loadding').style.display = "block";
        var page = document.getElementById('page').value;
        var datas = "page=" + page + "&pagesub=" + "Y";
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Payment_controller/loadpayment') ?>",
            data: datas
        }).done(function(data) {
            document.getElementById('loadding').style.display = "none";
            $('#DataSave').html(data); //Div ที่กลับมาแสดง
        })
    }
</script>



<!--<script language="JavaScript">
       window.onload = function () {
           document.addEventListener("contextmenu", function (e) {
               e.preventDefault();
           }, false);
           document.addEventListener("keydown", function (e) {
               //document.onkeydown = function(e) {
               // "I" key
               if (e.ctrlKey && e.shiftKey && e.keyCode == 73) {
                   disabledEvent(e);
               }
               // "J" key
               if (e.ctrlKey && e.shiftKey && e.keyCode == 74) {
                   disabledEvent(e);
               }
               // "S" key + macOS
               if (e.keyCode == 83 && (navigator.platform.match("Mac") ? e.metaKey : e.ctrlKey)) {
                   disabledEvent(e);
               }
               // "U" key
               if (e.ctrlKey && e.keyCode == 85) {
                   disabledEvent(e);
               }
               // "F12" key
               if (event.keyCode == 123) {
                   disabledEvent(e);
               }
           }, false);
           function disabledEvent(e) {
               if (e.stopPropagation) {
                   e.stopPropagation();
               } else if (window.event) {
                   window.event.cancelBubble = true;
               }
               e.preventDefault();
               return false;
           }
       }
</script>-->

</html>