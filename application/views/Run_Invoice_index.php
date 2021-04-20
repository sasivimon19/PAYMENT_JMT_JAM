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
                                <h3 class="card-title"> <b>Run Invoice Report</b> </h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="card card-primary card-outline">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            <i class="fas fa-edit"></i>
                                            Run Invoice Report
                                        </h3>
                                    </div>
                                    <div class="card-body">
                                        <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill" href="#custom-content-below-home" role="tab" aria-controls="custom-content-below-home" aria-selected="true" style=" font-size: 12px;"><b> ออกใบเสร็จรับเงิน </b></a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="custom-content-below-profile-tab" data-toggle="pill" href="#custom-content-below-profile" role="tab" aria-controls="custom-content-below-profile" aria-selected="false" style=" font-size: 12px;"><b> ใบกำกับภาษี </b></a>
                                            </li>
                                        </ul>

                                        <div class="tab-content" id="custom-content-below-tabContent">
                                            <div class="tab-pane fade show active" id="custom-content-below-home" role="tabpanel" aria-labelledby="custom-content-below-home-tab" style=" margin-top: 1%">
                                                <form id="showRunInvoiceReport" method="post" action="<?php echo site_url('Payment_controller/daily_PDF') ?>" enctype="multipart/form-data" target="_blank">
                                                    <div class="row" style=" margin-top: 2%;">
                                                        <div class="col-md-3">
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <button type="button" class="btn btn-default " style="background-color: #44CEF6;"><b>Operator</b></button>
                                                                </div>
                                                                <select class="form-control userformtaxinvoice" id="Operatortaxinvoice" name="Operatortaxinvoice">
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
                                                                    <button type="button" class="btn btn-default" style="background-color: #44CEF6;"><b>LOT</b></button>
                                                                </div>
                                                                <input type="text" class="form-control" id="lottaxinvoice" name="lottaxinvoice">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <div class="input-group mb-4">
                                                                <div class="input-group-prepend">
                                                                    <button type="button" class="btn btn-default " style="background-color: #44CEF6;"><b>วันที่เริ่ม</b></button>
                                                                </div>
                                                                <input id="datestarttaxinvoice" type="date" class="form-control userformtaxinvoice" name="datestarttaxinvoice">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <div class="input-group mb-4">
                                                                <div class="input-group-prepend">
                                                                    <button type="button" class="btn btn-default " style="background-color: #44CEF6;"><b>วันที่</b></button>
                                                                </div>
                                                                <input type="date" class="form-control userformtaxinvoice" id="dateendtaxinvoice" name="dateendtaxinvoice">
                                                                <div class="input-group-prepend">
                                                                    <button type="button" class="btn btn-default " style="background-color: #16A951;" onclick="scanreportinvoice(Tabinvoice='Taxreportinvoice')"><i class="fa fa-search" aria-hidden="true"></i></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>

                                                <div align="center" id="TableshowRunInvoiceReport" name="TableshowRunInvoiceReport">

                                                </div>

                                            </div>


                                            <div class="tab-pane fade" id="custom-content-below-profile" role="tabpanel" aria-labelledby="custom-content-below-profile-tab" style=" margin-top: 1%">
                                                <form id="invoice" method="post" action="<?php echo site_url('Payment_controller/daily_PDF') ?>" enctype="multipart/form-data" target="_blank">
                                                    <div class="row" style=" margin-top: 2%;">
                                                        <div class="col-md-3">
                                                            <div class="input-group mb-4">
                                                                <div class="input-group-prepend">
                                                                    <button type="button" class="btn btn-default " style="background-color: #44CEF6;"><b>Operator</b></button>
                                                                </div>
                                                                <select class="form-control userforminvoice" id="Operatorinvoice" name="Operatorinvoice">
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
                                                                <input type="text" class="form-control" id="lotinvoice" name="lotoinvoice">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <div class="input-group mb-4">
                                                                <div class="input-group-prepend">
                                                                    <button type="button" class="btn btn-default " style="background-color: #44CEF6;"><b>วันที่เริ่ม</b></button>
                                                                </div>
                                                                <input id="datestartinvoice" type="date" class="form-control userforminvoice" name="datestartinvoice">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="input-group mb-4">
                                                                <div class="input-group-prepend">
                                                                    <button type="button" class="btn btn-default " style="background-color: #44CEF6;"><b>ถึง</b></button>
                                                                </div>
                                                                <input type="date" class="form-control userforminvoice" id="dateendinvoice" name="dateendinvoice">
                                                                <div class="input-group-prepend">
                                                                    <button type="button" class="btn btn-default " style="background-color: #16A951;" onclick="scaninvoice(Tabinvoice='invoice')"><i class="fa fa-search" aria-hidden="true"></i></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                <div align="center" id="Tableshowinvoice" name="Tableshowinvoice">

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


    <script type="text/javascript">
        function scanreportinvoice(Tabinvoice) {

            checkvaltexinvoice = () => {
                $(".userformtaxinvoice").each(function() {
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

            if (checkvaltexinvoice() == false) {
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

                var datestart = document.getElementById('datestarttaxinvoice').value;
                var dateend = document.getElementById('dateendtaxinvoice').value;
                var lot = document.getElementById('lottaxinvoice').value;
                var Operator = document.getElementById('Operatortaxinvoice').value;

                document.getElementById('overlay').style.display = "block";
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('Payment_controller/Taxinvoice') ?>",
                    data: $("#showRunInvoiceReport").serialize() + "&Tabinvoice=" + Tabinvoice,
                }).done(function(data) {
                    $('#TableshowRunInvoiceReport').html(data);
                    document.getElementById('overlay').style.display = "none";
                })
            }
        }
    </script>



    <script type="text/javascript">
        function scaninvoice(Tabinvoice) {

            checkvalinvoice = () => {
                $(".userforminvoice").each(function() {
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

            if (checkvalinvoice() == false) {
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

                var datestart = document.getElementById('datestartinvoice').value;
                var dateend = document.getElementById('dateendinvoice').value;
                var lot = document.getElementById('lottaxinvoice').value;
                var Operator = document.getElementById('Operatorinvoice').value;

                document.getElementById('overlay').style.display = "block";

                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('Payment_controller/Report_invoice') ?>",
                    data: $("#invoice").serialize(),
                }).done(function(data) {
                    $('#Tableshowinvoice').html(data);
                    document.getElementById('overlay').style.display = "none";
                })
            }
        }
    </script>


</html>