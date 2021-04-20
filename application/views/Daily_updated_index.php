<!DOCTYPE html>
<html>
<title>รายการปรับปรุงข้อมูลรายวัน</title>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/1.css">
    <script type='text/javascript' src="<?php echo base_url(); ?>js/js.js"></script>

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
    <style>
        .td {
            padding: 5px;
        }

        .nav-tabs>li.active>a,
        .nav-tabs>li.active>a:focus,
        .nav-tabs>li.active>a:hover {
            color: #fff;
            cursor: default;
            background-color: #d94040;
            border: 1px solid #ddd;
            border-bottom-color: transparent;
        }
    </style>
</head>

<body>

    <div id="main">
        <div class="wrapper">
            <div class="content-wrapper">
                <section class="content" style=" padding-top:1%;">
                    <div class="container-fluid">
                        <div class="card card-secondary">
                            <div class="card-header" style="background-color: #c3000d;">
                                <h3 class="card-title"> <b>รายการปรับปรุงข้อมูลรายวัน</b> </h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <form id="scan" method="post" action="<?php echo site_url('Payment_controller/daily_PDF') ?>" enctype="multipart/form-data" target="_blank">
                                    <div class="row" style=" margin-top: 1%;">
                                        <div class="col-md-3">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <button type="button" class="btn btn-default " style="background-color: #44CEF6;"><b>การรับชำระ</b></button>
                                                </div>
                                                <select class="form-control userformEditDaily" id="status" name="status">
                                                    <option value="">--เลือก--</option>
                                                    <option value="DISCOUNT">DISCOUNT</option>
                                                    <option value="REVOKE">REVOKE</option>
                                                    <option value="REFUND">REFUND</option>
                                                    <option value="ADJUST">ADJUST</option>
                                                    <option value="CN">CN</option>
                                                    <option value="AUCTION">AUCTION</option>
                                                    <option value="SALARY DEDUCTION">SALARY DEDUCTION</option>
                                                    <option value="CUT THE BACK">CUT THE BACK</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <button type="button" class="btn btn-default " style="background-color: #44CEF6;"><b>Operator</b></button>
                                                </div>
                                                <select class="form-control" id="Operator" name="Operator">
                                                    <option value="">All Operator</option>
                                                    <?php foreach ($op as $row) { ?>
                                                        <option value="<?php echo $row->operator_name; ?>"><?php echo $row->operator_name; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <button type="button" class="btn btn-default " style="background-color: #44CEF6;"><b>วันที่</b></button>
                                                </div>
                                                <input id="datestart" type="date" class="form-control userformEditDaily" name="datestart">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <button type="button" class="btn btn-default " style="background-color: #44CEF6;"><b>ถึง</b></button>
                                                </div>
                                                <input id="dateend" type="date" class="form-control userformEditDaily" name="dateend">
                                                <div class="input-group-prepend">
                                                    <button type="button" class="btn btn-default " style="background-color: #16A951;" onclick="scan()"><i class="fa fa-search" aria-hidden="true"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <div align="center" id="show" style="overflow: auto;">
                                  
                                </div>
                            </div>
                        </div>
                </section>
            </div>
        </div>
    </div>
</body>


<div align="center" id="overlay" onclick="off()">
    <img style="margin-top: 20%;width: 10%;" src="<?php echo base_url(); ?>assets/images/loader.gif">
</div>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>




<script type="text/javascript">
    function scan() {
        checkvallEditDaily = () => {
            $(".userformEditDaily").each(function() {
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

        if (checkvallEditDaily() == false) {
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
            var dateend = document.getElementById('dateend').value;
            var status = document.getElementById('status').value;
            var Operator = document.getElementById('Operator').value;


            document.getElementById('overlay').style.display = "block";
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('Payment_controller/Daily_updated_view') ?>",
                data: $("#scan").serialize(),
            }).done(function(data) {

                $('#show').html(data);
                document.getElementById('overlay').style.display = "none";
            })
        }
    }
</script>


</html>