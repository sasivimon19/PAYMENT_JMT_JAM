<!DOCTYPE html>
<html>

<head>
    <title>Payment</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link href="<?php echo base_url(); ?>assets/sweetalert/dist/sweetalert.css" rel="stylesheet" type="text/css">
    <script src="<?php echo base_url(); ?>assets/sweetalert/dist/sweetalert.min.js"></script>
    <script src="<?php echo base_url(); ?>AdminLTE/plugins/jquery/jquery.min.js"></script>
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
            background-color: rgba(0, 0, 0, 0.5) !important;
            z-index: 2;
            cursor: pointer;
        }
    </style>
    <style>
        .td {
            padding: 5px;
        }
    </style>

<body>
    <div id="main" style=" margin-top: 1%;">
        <div class="wrapper">
            <div class="content-wrapper">
                <section class="content" style=" padding-top:1%;">
                    <div class="container-fluid">
                        <div class="card card-secondary">
                            <div class="card-header" style="background-color: #c3000d !important;">
                                <h3 class="card-title"> <b>Run Invoice</b> </h3>

                            </div>

                            <div class="card-body">
                                <form id="scan" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="input-group mb-4">
                                                <select class="form-control form-control-sm checkval" id="status" name="status">
                                                    <option value="">เลือกสถานะการรับชำระ</option>
                                                    <option value="0">Pay Approved</option>
                                                    <option value="1">CN</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="input-group mb-4">
                                                <select class="form-control form-control-sm checkval" id="Invoice" name="Invoice">
                                                    <option value="">เลือก ประเภท</option>
                                                    <option value="hp">Tax Invoice</option>
                                                    <option value="0">Invoice</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="input-group mb-4">
                                                <select class="form-control form-control-sm checkval" id="Operator" name="Operator">
                                                    <option value="">เลือก Operator</option>
                                                    <?php foreach ($op as $row) { ?>
                                                        <option value="<?php echo $row->operator_name; ?>"><?php echo $row->operator_name; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="input-group mb-4">
                                                <div class="input-group-prepend">
                                                    <button type="button" class="btn btn-primary btn-sm"><b> LOT </b></button>
                                                </div>
                                                <input id="lot" type="text" class="form-control form-control-sm checkval" name="lot">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="input-group mb-4">
                                                <div class="input-group-prepend">
                                                    <button type="button" class="btn btn-primary btn-sm"><b> รหัสลูกค้า </b></button>
                                                </div>
                                                <input id="idcustomer" name="idcustomer" type="text" class="form-control form-control-sm">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="input-group mb-5">
                                                <div class="input-group-prepend">
                                                    <button type="button" class="btn btn-primary btn-sm"><b> วันที่รับรับรู้รายได้</b></button>
                                                </div>
                                                <input id="datestart" name="datestart" type="date" class="form-control form-control-sm checkval">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="input-group mb-5">
                                                <div class="input-group-prepend">
                                                    <button type="button" class="btn btn-primary btn-sm"><b> ถึง </b></button>
                                                </div>
                                                <input class="form-control form-control-sm checkval" type="date" id="dateend" name="dateend">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <button onclick="scan()" type="button" class="btn btn-info btn-sm"> ค้นหา </button>
                                        </div>
                                        <div class="col-md-2"></div>
                                    </div>
                            </div>
                            </form>

                            <div align="center" id="show" style="overflow: auto;">
                                <!-- <hr style="margin-bottom: 0px;margin-top: -5px;"> -->
                                <!-- <br> -->
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-3">
                                            <div class="info-box mb-3 bg-warning">
                                                <span class="info-box-icon"><i class="fas fa-tag"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text"><b>จำนวนรายการ : </b></span>
                                                    <input style="text-align: right;background: #000000 !important;color: #F0FF03 !important;width: 100%;font-weight: 900;" type="text" class="form-control form-control-sm" id="usr" name="username" value="0.0" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="info-box mb-3 bg-success">
                                                <span class="info-box-icon"><i class="fas fa-tag"></i></span>

                                                <div class="info-box-content">
                                                    <span class="info-box-text"><b>ยอดชำระรวม : </b></span>
                                                    <input style="text-align: right;background: #000000 !important ;color: #F0FF03 !important;width: 100%;font-weight: 900;" type="text" class="form-control form-control-sm" id="usr" name="username" value="0.0" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="info-box mb-3 bg-info">
                                                <span class="info-box-icon"><i class="fas fa-tag"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text"><b>ยอดรวม VAT : </b></span>
                                                    <b><input style="text-align: right;background: #000000 !important; color: #F0FF03 !important; width: 100%; font-weight: 900;" type="text" class="form-control form-control-sm" id="usr" name="username" value="0.0" readonly></b>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-1"></div>
                                    </div>
                                </div>
                                <br />
                                <section class="content">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card">
                                                    <div class="card-header" style="background-color: #E5E7E9 !important;">
                                                        <div class="row">
                                                            <div class="col-md-4" style=" color: black;">
                                                                <h3 class="card-title"><b> <i class="fas fa-edit"></i> แสดงข้อมูลค้นหา</b></h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-body table-responsive p-0">
                                                        <table class="table table-hover" id="table-data">
                                                            <thead style="background-color: gray !important;">
                                                                <tr style="background-color:#040404 !important;color: #FFFFFF !important;">
                                                                    <th style="text-align: center;">No</th>
                                                                    <th>Rec_date</th>
                                                                    <th>Channel</th>
                                                                    <th>Contract No</th>
                                                                    <th>Ref no1.</th>
                                                                    <th>Ref no2.</th>
                                                                    <th>Amount</th>
                                                                    <th>VAT</th>
                                                                    <th>State</th>
                                                                    <th>Type</th>
                                                                    <th>Lot</th>
                                                                    <th>IDCard</th>
                                                                    <th>Invoice No</th>
                                                                    <th>Textbath</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <hr>
                                                </div>
                                            </div>
                                        </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>


    <div align="center" id="overlay" onclick="off()">
        <img style="margin-top: 15%;width: 10%;" src="<?php echo base_url(); ?>assets/images/loader.gif">
    </div>
</body>


<script type="text/javascript">
    function scan() {

        checkvalfrom = () => {
            $(".checkval").each(function() {
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



        var datestart = document.getElementById('datestart').value;
        var dateend = document.getElementById('dateend').value;
        var lot = document.getElementById('lot').value;
        var Operator = document.getElementById('Operator').value;
        var idcustomer = document.getElementById('idcustomer').value;
        var status = document.getElementById('status').value;
        var Invoice = document.getElementById('Invoice').value;


        if (checkvalfrom() == false) {
            swal({
                title: "กรุณากรอกข้อมูลให้ครบ",
                type: "warning",
                dangerMode: true,
                button: "ปิด",

            }).then((willEdit) => {
                if (willEdit) {

                }
            });
        } else {
            document.getElementById('overlay').style.display = "block";
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('Payment_controller/invoice_view') ?>",
                data: $("#scan").serialize(),
            }).done(function(data) {
                $('#show').html(data);
                document.getElementById('overlay').style.display = "none";
            })
        }
    }
</script>

</html>