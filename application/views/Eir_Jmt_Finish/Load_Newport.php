<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>IMPOER LOAD NEW PORT</title>

    <meta http-equiv="content-type" charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SELECT DATA</title>
    <script src="<?php echo base_url(); ?>assets/js/sweetalert.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/font-awesome-4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/styles.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/navbar.css">
    <link rel="stylesheet" href="<?php echo base_url() . "assets/"; ?>datetimepicker/build/jquery.datetimepicker.min.css">
    <script src="<?php echo base_url() . "assets/"; ?>datetimepicker/jquery.js"></script>
    <script src="<?php echo base_url() . "assets/"; ?>datetimepicker/build/jquery.datetimepicker.full.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        axios.defaults.baseURL = '<?php echo site_url(); ?>';
    </script>
</head>

<div class="loading" id="spinner"></div>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">

                </div>
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-edit"></i>
                                <b> IMPOER LOAD NEW PORT </b>
                            </h3>
                        </div>
                        <div class="card-body">
                            <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="custom-content-below-profile-tab" data-toggle="pill" href="#custom-content-below-profile" role="tab" aria-controls="custom-content-below-profile" aria-selected="false" style="color: #009900;">รายการที่สามารถบันทึกได้
                                        <?php foreach ($get_Tmp_customer_True as $item) ?>
                                        (<?php
                                            if (COUNT($get_Tmp_customer_True) == 0) {
                                                echo 0;
                                            } else {
                                                echo $item->row;
                                            } ?>)
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-content-below-messages-tab" data-toggle="pill" href="#custom-content-below-messages" role="tab" aria-controls="custom-content-below-messages" aria-selected="false" style="color: red;">รายการที่สามารถบันทึกไม่ได้
                                        <?php foreach ($get_Tmp_customer_FALSE as $va) ?>
                                        (<?php
                                            if (COUNT($get_Tmp_customer_FALSE) == 0) {
                                                echo 0;
                                            } else {
                                                echo $va->row;
                                            } ?>)
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <div class="col-md-12">
                                        <div class="input-group mb-4">
                                            <input type="file" id="Fileload" name="Fileload" class="custom-file form-control form-control-sm">
                                            <div class="input-group-prepend">
                                                <button type="button" class="input-group-text btn btn-success btn-sm" style="background-color: #0CA234; color:  white;" onclick="Upload_FileLoadport()"><i class="fas fa-file-import"></i> <b> Import </b> </button>
                                            </div>
                                            &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <?php if (COUNT($get_Tmp_customer_True) <= '0')  { ?>
                                                <div class="input-group-prepend">
                                                    <button type="button" class="btn btn-warning btn-sm" style="background-color: #F39C12;" id="idCheckLoadnewport" onclick="Check_Loadnewport()" disabled><b> <i class="fas fa-list"></i> ตรวจสอบข้อมูล </b> </button> 
                                                </div>
                                            <?php } else  if (COUNT($get_Tmp_customer_True) != '0') { ?>
                                                <div class="input-group-prepend">
                                                    <button type="button" class="btn btn-warning btn-sm" style="background-color: #F39C12;" id="idCheckLoadnewport" onclick="Check_Loadnewport()"><b> <i class="fas fa-list"></i> ตรวจสอบข้อมูล </b> </button> 
                                                </div>
                                            <?php } ?>
                                            &nbsp;&nbsp;&nbsp;
                                            <div class="input-group-prepend">
                                                <button type="button" class="btn btn-danger btn-sm" style="color: #000000;" onclick="Delete_loadportfiletmp()"> <b><i class="fas fa-trash"></i> ล้างข้อมูล </b> </button>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>


                            <div class="tab-content" id="custom-content-below-tabContent">
                                <div class="tab-pane fade show active" id="custom-content-below-profile" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
                                    <form id="formLoadprotdatasave">
                                        <?php $this->load->view('Eir_Jmt_Finish/Loadprotdatasave'); ?>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="custom-content-below-messages" role="tabpanel" aria-labelledby="custom-content-below-messages-tab">
                                    <?php $this->load->view('Eir_Jmt_Finish/NoLoadprotdatasave'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</body>

</html>




<script>
    function Upload_FileLoadport() {

        var Fileload = document.getElementById('Fileload').value;
        var form_data = new FormData();

        form_data.append('Fileload', $('#Fileload')[0].files[0]);

        if (Fileload == '') {
            swal("กรุณาเลือกไฟล์ก่อน", "", "warning");

        } else {
            if ($('#Fileload').val().split(".").pop() != "xlsx") {
                swal("ชนิดไฟลไม่ถูกต้อง กรุณาใช้ .xlsx", "", "warning");
                return false;
            }

            document.getElementById("spinner").style.display = "block";

            $.ajax({
                cache: false,
                type: 'POST',
                url: '<?php echo site_url('Call_LoadNewport/ImportExcel_Loadport'); ?>', //Import
                contentType: false,
                processData: false,
                data: form_data,
            }).done(function(data) {
                if (data == 'false') {
                    swal({
                        title: "Column ไม่ตรงกรุณาตรวจสอบไฟล์",
                        icon: "error",
                    }).then((willEdit) => {
                        if (willEdit) {
                            document.getElementById('spinner').style.display = "none";
                            location.href = '';
                        }
                    });
                } else {
                    document.getElementById('spinner').style.display = "none";
                    location.href = '';
                }
            })
        };
    }
</script>



<script>
    function Delete_loadportfiletmp() {

        swal({
                title: "ลบข้อมูลนี้หรือไม่",
                icon: "warning",
                buttons: true,
                dangerMode: false,
            })
            .then((willEdit) => {
                if (willEdit) {
                    document.getElementById("spinner").style.display = "block";
                    $.ajax({
                            type: "POST",
                            url: "<?php echo site_url('Call_LoadNewport/Delete_Tmp_Customer'); ?>",
                            data: $("#portscan").serialize(),
                        })
                        .done(function(data) {
                            $('#idLoadprotdatasave').html(data);
                            swal({
                                title: "ลบข้อมูลสำเร็จ",
                                icon: "success",
                            }).then((willEdit) => {
                                if (willEdit) {
                                    document.getElementById('spinner').style.display = "none";
                                    location.href = '';
                                }
                            });
                        });
                }
            });
    }
</script>



<script>
    function Check_Loadnewport() {

        checkvalloadport = () => {
            $(".userformload").each(function() {
                if ($(this).val() === "" && $(this).val() === "") {
                    $(this).addClass("thisnull");
                    $(this).css("border", "2px solid red");
                } else {
                    $(this).removeClass("thisnull");
                    $(this).css("border", "");
                    $(".bootstrap-select").css("border", "");
                }
                $(".bootstrap-select").removeClass("thisnull");
            });
            return $(".thisnull").length === 0 ? true : false;
        };

        if (checkvalloadport() == false) {
            swal({
                title: "กรุณากรอกข้อมูลให้ครบ",
                icon: "warning",
                dangerMode: true,
                button: "ปิด",

            }).then((willEdit) => {
                if (willEdit) {

                }
            });
        } else {
            swal({
                    title: "ต้องการตรวจสอบข้อมูลนี้หรือไม่",
                    icon: "warning",
                    buttons: true,
                    dangerMode: false,
                })
                .then((willEdit) => {
                    if (willEdit) {
                        document.getElementById("spinner").style.display = "block";
                        $.ajax({
                                type: "POST",
                                url: "<?php echo site_url('Call_LoadNewport/Update_Customer'); ?>",
                                data: $("#formLoadprotdatasave").serialize(),
                            })
                            .done(function(data) {
                                $('#idLoadprotdatasave').html(data);
                                swal({
                                    title: "ตรวจสอบข้อมูลสำเร็จ",
                                    icon: "success",
                                }).then((willEdit) => {
                                    if (willEdit) {
                                        document.getElementById('spinner').style.display = "none";
                                        location.href = '';
                                    }
                                });
                            });
                    }
                });
        }
    }
</script>