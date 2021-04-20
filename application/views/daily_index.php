<!DOCTYPE html>
<html>
<title>Daily Receive Report</title>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/1.css">
    <script type='text/javascript' src="<?php echo base_url(); ?>js/js.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/sweetalert.min.js"></script>

    <link href="<?php echo base_url(); ?>assets/DataTables/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
    <script src="<?php echo base_url(); ?>assets/DataTables/js/jquery.dataTables.min.js"></script>

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
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 2;
            cursor: pointer;
        }
    </style>

</head>

<div id="main">
    <div class="wrapper">
        <div class="content-wrapper">
            <section class="content" style=" padding-top:1%;">
                <div class="container-fluid">
                    <div class="card card-secondary">
                        <div class="card-header" style="background-color: #c3000d;">
                            <h3 class="card-title"> <b>Daily Receive Report</b> </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="col-md-12">
                                <form id="scan" method="post" action="<?php echo site_url('Payment_controller/daily_PDF') ?>" enctype="multipart/form-data" target="_blank">
                                    <div class="row" style=" margin-top: 2%;">
                                        <div class="col-md-3">
                                            <div class="input-group mb-4">
                                                <div class="input-group-prepend">
                                                    <button type="button" class="btn btn-default btn-sm" style="background-color: #44CEF6;"><b>Operator</b></button>
                                                </div>
                                                <select class="form-control" id="Operator" name="Operator">
                                                    <option value="">All Operator</option>
                                                    <?php foreach ($op as $row) { ?>
                                                        <option value="<?php echo $row->operator_name; ?>"><?php echo $row->operator_name; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="input-group mb-4">
                                                <div class="input-group-prepend">
                                                    <button type="button" class="btn btn-default btn-sm" style="background-color: #44CEF6;"><b>LOT</b></button>
                                                </div>
                                                <input id="lot" type="text" class="form-control" name="lot">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group mb-5">
                                                <div class="input-group-prepend">
                                                    <button type="button" class="btn btn-default btn-sm" style="background-color: #44CEF6;"><b>วัน-เดือน-ปีที่เริ่ม</b></button>
                                                </div>
                                                <input id="datestart" type="date" class="form-control  userformDaily" name="datestart">
                                                <div class="input-group-prepend">
                                                    <button type="button" class="btn btn-default " style="background-color: #16A951;" onclick="scan()"><i class="fa fa-search" aria-hidden="true"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div align="center" id="show">

                            </div>

                            <div align="center" id="overlay" onclick="off()">
                                <img style="margin-top: 20%;width: 10%;" src="<?php echo base_url(); ?>assets/images/loader.gif">
                            </div>

                        </div>
                    </div>
            </section>
        </div>
    </div>



    <script type='text/javascript'>
        function check_password() {

            var elm = document.getElementById('Password');

            var len = elm.value.length;

            var regex1 = /^[A-Z]*$/;
            var val = elm.value;
            if (len == 6) {
                var num = val[1] + val[2] + val[3] + val[4] + val[5];
                if (val[0].match(regex1) && !isNaN(num)) {

                } else {
                    alert("กรูณากรอกรหัสให้ตรงตามรูปแบบ ตัวใหญ่ ตามด้วยตัวเลข ไม่เกิน 6 ตัว เช่น A123456 ");
                    elm.value = "";
                }
            }
        }
    </script>

    </body>

    <script>
        function pagedatapay(page) { //แนบตัวแปร page ไปด้วย

            var Operator = document.getElementById('Operator').value;
            var lot = document.getElementById('lot').value;
            var datestart = document.getElementById('datestart').value;

            var datas = "Operator=" + Operator + "&lot=" + lot + "&datestart=" + datestart + "&page=" + page;
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('Payment_controller/daily_view') ?>",
                data: datas,
            }).done(function(data) {
                $('#show').html(data); //Div ที่กลับมาแสดง
            })
        }
    </script>

    <script type="text/javascript">
        function scan() {

            checkvallDaily = () => {
                $(".userformDaily").each(function() {
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

            if (checkvallDaily() == false) {
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

                var datestart = document.getElementById('datestart').value;
                var lot = document.getElementById('lot').value;
                var Operator = document.getElementById('Operator').value;

                document.getElementById('overlay').style.display = "block";
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('Payment_controller/daily_view') ?>",
                    data: $("#scan").serialize(),
                }).done(function(data) {
                    $('#show').html(data);
                    document.getElementById('overlay').style.display = "none";
                })
            }
        }
    </script>

</html>