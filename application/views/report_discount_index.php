<!DOCTYPE html>
<html>
<title>Summary Discount Report </title>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->

    <!--<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">-->
    <!--<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">-->
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/1.css">
    <script type='text/javascript' src="<?php echo base_url(); ?>js/js.js"></script>
    <!--<link href="<?php echo base_url(); ?>assets/DataTables/DataTables-1.10.18/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">-->
    <!--<script src="<?php echo base_url(); ?>assets/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js"></script>-->
    <!--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">-->
    <!--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/font-awesome-4.7.0/css/font-awesome.min.css">
    <style>
        .b {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            overflow: auto;
            font-size: 0.9em;
            width: 99.9%;
        }
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
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 2;
            cursor: pointer;
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
                                <h3 class="card-title"> <b>Summary Discount Report</b> </h3>
                            </div>
                            <div class="card-body">
                                <form id="scan" method="post" action="<?php echo site_url('Payment_controller/daily_PDF') ?>" enctype="multipart/form-data" target="_blank">
                                    <div class="row" style=" margin-top: 1%;">
                                        <div class="col-md-3">
                                            <div class="input-group mb-4">
                                                <div class="input-group-prepend">
                                                    <button type="button" class="btn btn-default " style="background-color: #44CEF6;"><b>ประเภทการรับชำระ</b></button>
                                                </div>
                                                <select class="form-control userformdiscount" id="status" name="status">
                                                    <option value=""></option>
                                                    <option value="DISCOUNT">DISCOUNT</option>
                                                    <!-- <option value="REVOKE">REVOKE</option>
                                                    <option value="REFUND">REFUND</option>
                                                    <option value="ADJUST">ADJUST</option> -->
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="input-group mb-3">
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
                                        <div class="col-md-2">
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <button type="button" class="btn btn-default " style="background-color: #44CEF6;"><b>LOT</b></button>
                                                </div>
                                                <input id="lot" type="text" class="form-control" name="lot">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group mb-4">
                                                <div class="input-group-prepend">
                                                    <button type="button" class="btn btn-default " style="background-color: #44CEF6;"><b>วันที่</b></button>
                                                </div>
                                                <input id="date" type="date" class="form-control userformdiscount" name="date">
                                                <div class="input-group-prepend">
                                                    <button type="button" class="btn btn-default " style="background-color: #16A951;" onclick="scan()"><i class="fa fa-search" aria-hidden="true"></i> ค้นหา </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div align="center" id="show" name="show">

                                </div>
                            </div>

                            <!-- <div class="card-body">
                                <form id="scan" method="post" action="<?php echo site_url('Payment_controller/daily_PDF') ?>" enctype="multipart/form-data" target="_blank">
                                    <table style="width: 100%;text-align: center;">
                                        <tr>
                                            <td class="td" style="width: 30%;">
                                                <div class="input-group">
                                                    <span class="input-group-addon">ประเภทการรับชำระ</span>
                                                    <select class="form-control userformdiscount" id="status" name="status">
                                                        <option value=""></option>
                                                        <option value="DISCOUNT">DISCOUNT</option>
                                                        <option value="REVOKE">REVOKE</option>
                                                        <option value="REFUND">REFUND</option>
                                                        <option value="ADJUST">ADJUST</option>
                                                    </select>
                                                </div>
                                            </td>

                                            <td class="td" style="width: 25%;">
                                                <div class="input-group">
                                                    <span class="input-group-addon">Operator</span>
                                                    <select class="form-control userformdiscount" id="Operator" name="Operator">
                                                        <option value=""></option>
                                                        <?php foreach ($op as $row) { ?>
                                                            <option value="<?php echo $row->operator_name; ?>"><?php echo $row->operator_name; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </td>

                                            <td class="td" style="width: 15;">
                                                <div class="input-group">
                                                    <span class="input-group-addon">LOT</span>
                                                    <input id="lot" type="text" class="form-control userformdiscount" name="lot">
                                                </div>
                                            </td>

                                            <td class="td" style="width: 20%;">
                                                <div class="input-group">
                                                    <span class="input-group-addon">วันที่</span>
                                                    <input id="date" type="date" class="form-control userformdiscount" name="date">
                                                </div>
                                            </td>

                                            <td class="td" style="width: 10%;">
                                                <button onclick="scan()" type="button" class="btn btn-info" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);padding: 5px;width: 100%;">ค้นหาdis</button>
                                            </td>
                                        </tr>
                                    </table>
                                </form>


                                <div align="center" id="show">

                                </div> -->
                            <!-- 
                            <div align="center" id="show" style="overflow: auto;">
                                <hr style="margin-top: 3px;">
                                <div style="width: 99%;">
                                    <div style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);width: 99%;margin-bottom: 5px;border-radius: 5px;padding: 5px;">
                                        <p style="width: 100%;background-color: red;border-radius: 5px;"><b>Grand Total</b></p>
                                        <table style="width: 100%;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);border-radius: 5px;">
                                            <tr>
                                                <td style="padding: 3px;">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">จำนวนรายการ</span>
                                                        <input style="color: #F0FF03;background-color: black;text-align: right;" id="msg" type="text" class="form-control" name="msg" value="<?php echo number_format(0); ?>">
                                                    </div>
                                                </td>
                                                <td style="padding: 3px;">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">Amount</span>
                                                        <input style="color: #F0FF03;background-color: black;text-align: right;" id="msg" type="text" class="form-control" name="msg" value="<?php echo number_format(0, 2); ?>">
                                                    </div>
                                                </td>
                                                <td style="padding: 3px;">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">Vatamount</span>
                                                        <input style="color: #F0FF03;background-color: black;text-align: right;" id="msg" type="text" class="form-control" name="msg" value="<?php echo number_format(0, 2); ?>">
                                                    </div>
                                                </td>
                                                <td style="padding: 3px;">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">E Balance</span>
                                                        <input style="color: #F0FF03;background-color: black;text-align: right;" id="msg" type="text" class="form-control" name="msg" value="<?php echo number_format(0, 2); ?>">
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <br>
                                    <table id="myTable" class="table" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);overflow: auto;font-size: 0.9em;width: 99%;">
                                        <thead>
                                            <tr style="background-color:#040404;color: #FFFFFF;">
                                                <th>Rec Date</th>
                                                <th>Contract No</th>
                                                <th>Cus Name</th>
                                                <th>Amount</th>
                                                <th>Vatamount</th>
                                                <th>E Balance</th>
                                                <th>Product</th>
                                                <th>Lot No</th>
                                                <th>Chennel</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                                <hr>
                            </div> -->
                        </div>
                    </div>
            </div>
            </section>
        </div>
    </div>
</body>

<div align="center" id="overlay" onclick="off()">
    <img style="margin-top: 15%;width: 10%;" src="<?php echo base_url(); ?>assets/images/loader.gif">
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


<!-- <script>
    $(document).ready(function() {
        $('#myTable').DataTable({});
    });
</script> -->



<script type="text/javascript">
    function scan() {

        checkvaldiscount = () => {

            $(".userformdiscount").each(function() {
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

        var date = document.getElementById('date').value;
        var lot = document.getElementById('lot').value;
        var status = document.getElementById('status').value;
        var Operator = document.getElementById('Operator').value;

        if (checkvaldiscount() == false) {
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

            document.getElementById("overlay").style.display = "block";

            $.ajax({
                type: "POST",
                url: "<?php echo site_url('Payment_controller/report_discount_view') ?>",
                data: $("#scan").serialize(),
            }).done(function(data) {
                $('#show').html(data);
                document.getElementById('overlay').style.display = "none";
            })
        }
    }
</script>

</html>