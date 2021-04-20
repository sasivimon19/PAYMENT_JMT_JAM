<!DOCTYPE html>
<html>
<title>Summary Receive Report <?php foreach ($company as $data) { ?>
    <?php echo iconv('tis-620', 'utf-8', $data->name);
                                } ?></title>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <script src="<?php echo base_url(); ?>assets/js/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/1.css">
    <script type='text/javascript' src="<?php echo base_url(); ?>js/js.js"></script>

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

    <div id="main">
        <div class="wrapper">
            <div class="content-wrapper">
                <section class="content" style=" padding-top:1%;">
                    <div class="container-fluid">
                        <div class="card card-secondary">
                            <div class="card-header" style="background-color: #c3000d;">
                                <h3 class="card-title"> <b>Summary Receive Report</b> </h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="card card-primary card-outline">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            <i class="fas fa-edit"></i>
                                            Export Summary Receive Report
                                        </h3>
                                    </div>
                                    <div class="card-body">
                                        <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill" href="#custom-content-below-home" role="tab" aria-controls="custom-content-below-home" aria-selected="true" style=" font-size: 12px;"><b>Summary Receive Report By Operator Of Month</b></a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="custom-content-below-profile-tab" data-toggle="pill" href="#custom-content-below-profile" role="tab" aria-controls="custom-content-below-profile" aria-selected="false" style=" font-size: 12px;"><b>Summary Receive Report By Channel Of Daily</b></a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="custom-content-below-messages-tab" data-toggle="pill" href="#custom-content-below-messages" role="tab" aria-controls="custom-content-below-messages" aria-selected="false" style=" font-size: 12px;"><b>Summary Receive Report By Operator Of Daily</b></a>
                                            </li>
                                        </ul>

                                        <div class="tab-content" id="custom-content-below-tabContent">
                                            <div class="tab-pane fade show active" id="custom-content-below-home" role="tabpanel" aria-labelledby="custom-content-below-home-tab" style=" margin-top: 1%">
                                                <form id="scan" method="post" action="<?php echo site_url('Payment_controller/daily_PDF') ?>" enctype="multipart/form-data" target="_blank">
                                                    <div class="row" style=" margin-top: 2%;">
                                                        <div class="col-md-3">
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <button type="button" class="btn btn-default " style="background-color: #44CEF6;"><b>Operator</b></button>
                                                                </div>
                                                                <select class="form-control " id="OperatorMonth" name="OperatorMonth">
                                                                    <option value="">All Operator</option>
                                                                    <?php foreach ($op as $row) { ?>
                                                                        <option value="<?php echo $row->operator_name; ?>"><?php echo $row->operator_name; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="input-group mb-4">
                                                                <div class="input-group-prepend">
                                                                    <button type="button" class="btn btn-default " style="background-color: #44CEF6;"><b>LOT</b></button>
                                                                </div>
                                                                <input type="text" class="form-control" id="lotoperatorMonth" name="lotoperatorMonth">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <div class="input-group mb-4">
                                                                <div class="input-group-prepend">
                                                                    <button type="button" class="btn btn-default " style="background-color: #44CEF6;"><b>วันที่เริ่ม</b></button>
                                                                </div>
                                                                <input id="datestartoperatorMonth" type="date" class="form-control userformoperatormonth" name="datestartoperatorMonth">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <div class="input-group mb-4">
                                                                <div class="input-group-prepend">
                                                                    <button type="button" class="btn btn-default " style="background-color: #44CEF6;"><b>วันที่</b></button>
                                                                </div>
                                                                <input type="date" class="form-control userformoperatormonth" id="datestartoperatorMonth2" name="datestartoperatorMonth2">
                                                                <div class="input-group-prepend">
                                                                    <button type="button" class="btn btn-default " style="background-color: #16A951;" onclick="scanoperatormonth()"><i class="fa fa-search" aria-hidden="true"></i></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>

                                                <div align="center" id="TableshowsummaryOperatorOfMonth" name="TableshowsummaryOperatorOfMonth">

                                                </div>

                                            </div>


                                            <div class="tab-pane fade" id="custom-content-below-profile" role="tabpanel" aria-labelledby="custom-content-below-profile-tab" style=" margin-top: 1%">
                                                <form id="scan1" method="post" action="<?php echo site_url('Payment_controller/daily_PDF') ?>" enctype="multipart/form-data" target="_blank">
                                                    <div class="row" style=" margin-top: 2%;">
                                                        <div class="col-md-3">
                                                            <div class="input-group mb-4">
                                                                <div class="input-group-prepend">
                                                                    <button type="button" class="btn btn-default " style="background-color: #44CEF6;"><b>Operator</b></button>
                                                                </div>
                                                                <select class="form-control" id="Operatorchannel" name="Operatorchannel">
                                                                    <option value="">All Operator</option>
                                                                    <?php foreach ($op as $row) { ?>
                                                                        <option value="<?php echo $row->operator_name; ?>"><?php echo $row->operator_name; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="input-group mb-4">
                                                                <div class="input-group-prepend">
                                                                    <button type="button" class="btn btn-default " style="background-color: #44CEF6;"><b>วันที่เริ่ม</b></button>
                                                                </div>
                                                                <input type="date" class="form-control userformchanneldaily" id="datestartchannel" name="datestartchannel">
                                                                <div class="input-group-prepend">
                                                                    <button type="button" class="btn btn-default " style="background-color: #16A951;" onclick="scanchanneldaily()"><i class="fa fa-search" aria-hidden="true"></i></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                <div align="center" id="Tableshowsummarychennel" name="Tableshowsummarychennel">

                                                </div>
                                            </div>


                                            <div class="tab-pane fade" id="custom-content-below-messages" role="tabpanel" aria-labelledby="custom-content-below-messages-tab" style=" margin-top: 1%">
                                                <form id="scan2" method="post" action="<?php echo site_url('Payment_controller/daily_PDF') ?>" enctype="multipart/form-data" target="_blank">
                                                    <div class="row" style=" margin-top: 2%;">
                                                        <div class="col-md-3">
                                                            <div class="input-group mb-4">
                                                                <div class="input-group-prepend">
                                                                    <button type="button" class="btn btn-default " style="background-color: #44CEF6;"><b>Operator</b></button>
                                                                </div>
                                                                <select class="form-control" id="Operatordaily" name="Operatordaily">
                                                                    <option value="">All Operator</option>
                                                                    <?php foreach ($op as $row) { ?>
                                                                        <option value="<?php echo $row->operator_name; ?>"><?php echo $row->operator_name; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="input-group mb-4">
                                                                <div class="input-group-prepend">
                                                                    <button type="button" class="btn btn-default " style="background-color: #44CEF6;"><b>วันที่เริ่ม</b></button>
                                                                </div>
                                                                <input type="date" class="form-control userformoperatordaily" id="datestartdaily" name="datestartdaily">
                                                                <div class="input-group-prepend">
                                                                    <button type="button" class="btn btn-default " style="background-color: #16A951;" onclick="scanoperatordaily()"><i class="fa fa-search" aria-hidden="true"></i></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                <div align="center" id="Tableshowsummaryprocuct" name="Tableshowsummaryprocuct">

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
        <img style="margin-top: 20%;width: 10%;" src="<?php echo base_url(); ?>assets/images/loader.gif">
    </div>

    </body>

    <!-- <script>
        function pagedatapay() { //แนบตัวแปร page ไปด้วย

            // var datestartoperatorMonth = document.getElementById('datestartoperatorMonth').value;
            // var datestartoperatorMonth2 = document.getElementById('datestartoperatorMonth2').value;
            // var lotoperatorMonth = document.getElementById('lotoperatorMonth').value;
            // var OperatorMonth = document.getElementById('OperatorMonth').value;
            var page = document.getElementById('page').value;


            var datas = "datestartoperatorMonth=" + datestartoperatorMonth + "&datestartoperatorMonth2=" + datestartoperatorMonth2 +
                "&lotoperatorMonth=" + lotoperatorMonth + "&OperatorMonth=" + OperatorMonth + "&page=" + page;
            document.getElementById('overlay').style.display = "block";
            $.ajax({
                type: "POST",
                url: "<//?php echo site_url('Payment_controller/receive_view1') ?>",
                data: datas,
            }).done(function(data) {
                $('#Tableshowsummary').html(data); //Div ที่กลับมาแสดง
                document.getElementById('overlay').style.display = "none";
            })
        }
    </script> -->


    <!-- Summary Receive By Operator Month -->
    <script type="text/javascript">
        function scanoperatormonth() {

            checkvalloperatormonth = () => {
                $(".userformoperatormonth").each(function() {
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

            if (checkvalloperatormonth() == false) {
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

                var datestart1 = document.getElementById('datestartoperatorMonth').value;
                var datestart2 = document.getElementById('datestartoperatorMonth2').value;

                document.getElementById('overlay').style.display = "block";
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('Payment_controller/receive_view1') ?>",
                    data: $("#scan").serialize(),
                }).done(function(data) {
                    $('#TableshowsummaryOperatorOfMonth').html(data);
                    document.getElementById('overlay').style.display = "none";
                })
            }
        }
    </script>



    <script type="text/javascript">
        function scanchanneldaily() {

            checkvallchanneldaily = () => {
                $(".userformchanneldaily").each(function() {
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

            if (checkvallchanneldaily() == false) {
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

                var datestart = document.getElementById('datestartchannel').value;
                var Operator = document.getElementById('Operatorchannel').value;
                // var dateend = document.getElementById('dateendchannel').value;
                // var Lot = document.getElementById('lotchannel').value;

                document.getElementById('overlay').style.display = "block";

                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('Payment_controller/receive_view_chennel') ?>",
                    data: $("#scan1").serialize(),
                }).done(function(data) {
                    $('#Tableshowsummarychennel').html(data);
                    document.getElementById('overlay').style.display = "none";
                })
            }
        }
    </script>


    <script type="text/javascript">
        function scanoperatordaily() {

            checkvalloperatordaily = () => {
                $(".userformoperatordaily").each(function() {
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

            if (checkvalloperatordaily() == false) {
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

                var datestartdaily = document.getElementById('datestartdaily').value;
                var Operatordaily = document.getElementById('Operatordaily').value;


                document.getElementById('overlay').style.display = "block";
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('Payment_controller/Receive_PROCUCT') ?>",
                    data: $("#scan2").serialize(),
                }).done(function(data) {
                    $('#Tableshowsummaryprocuct').html(data);
                    document.getElementById('overlay').style.display = "none";
                })
            }
        }
    </script>



</html>