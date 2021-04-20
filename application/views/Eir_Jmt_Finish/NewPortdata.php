<!DOCTYPE html>
<html>
<title></title>

<head>
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/1.css">
   <!-- <script type='text/javascript' src="<?php echo base_url(); ?>js/js.js"></script> -->

    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/js/jquery-ui.css">

    <!-- <link href="<?php echo base_url(); ?>assets/DataTables/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"> -->
    <!-- <script src="<?php echo base_url(); ?>assets/DataTables/js/jquery.dataTables.min.js"></script> --> -->
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
        legend {
            display: block;
            padding-left: 2px;
            padding-right: 2px;
            border: none;
        }
    </style>
    <meta http-equiv="content-type" charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SELECT DATA</title>
    <script src="<?php echo base_url(); ?>assets/js/sweetalert.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/font-awesome-4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/styles.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/navbar.css">

</head>

<div class="loading" id="spinner"></div>

<div id="main">

    <div class="content-wrapper">
        <section class="content" style=" padding-top:2%;">
            <div class="card-body">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-edit"></i>
                            <b> NEWPORT </b>
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row" style=" margin-top: 1%;">
                            <div class="col-md-12">
                                <?php $this->load->view('Eir_Jmt_Finish/Import_Newport'); ?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>


        <div align="center" id="overlay" onclick="off()">
            <img style="margin-top: 20%;width: 20%;" src="<?php echo base_url(); ?>assets/images/loader4.gif">
        </div>

    </div>
</div>


</body>





<script>
    function scanadd() {

        checkval2 = () => {
            $(".userformActionresults").each(function() {
                if ($(this).val() === "" && $(this).val() === "") {
                    $(this).addClass("thisnull");
                    $(this).css("border", "1px solid red");
                } else {
                    $(this).removeClass("thisnull");
                    $(this).css("border", "");
                    $(".bootstrap-select").css("border", "");
                }
                $(".bootstrap-select").removeClass("thisnull");
            });
            return $(".thisnull").length === 0 ? true : false;
        };

        if (checkval2() == false) {
            // alert("กรุณากรอกข้อมูลให้ครบ");
            swal({
                title: "กรุณากรอกข้อมูลให้ครบ",
                icon: "warning",
                dangerMode: true,
                button: "ปิด",

            }).then((willEdit) => {
                if (willEdit) {
                    // location.href = '';
                }
            });
        } else {

            $(document).ready(function() {
                <?php if ($this->session->flashdata('Check_numport')) : ?>
                    swal({
                        title: "Port ซ้ำ กรุณาตรวจสอบ",
                        icon: "warning",
                        button: "ปิด",
                    }).then((willEdit) => {
                        if (willEdit) {
                            location.href = '';
                        }
                    });
                <?php endif; ?>
            });

            swal({
                    title: "ต้องการบันทึกข้อมูลนี้หรือไม่",
                    icon: "warning",
                    buttons: true,
                    dangerMode: false,
                })
                .then((willEdit) => {
                    if (willEdit) {
                        document.getElementById("spinner").style.display = "block";
                        $.ajax({
                                type: "POST",
                                url: "<?php echo site_url('Call_Newport/InsertNewport_Add'); ?>",
                                data: $("#portscan").serialize(),
                            })
                            .done(function(data) {
                                $('#showdatanewporadd').html(data);
                                swal("กรุณาตรวจสอบความถูกต้อง", "", "success");
                                document.getElementById('spinner').style.display = "none";
                            });
                    }
                });
        }
    }
</script>




<script>
    var port_search;

    select_port("", "port_search");

    function select_port(btn = "", port = "") {
        $.ajax({
                type: "POST",
                url: "<?php echo site_url('Call_Import/select_port'); ?>",
            })
            .done(function(json) {
                var myObj = JSON.parse(json);
                var result = myObj.result;
                console.log(result);
                makePort(result, btn, port);

            });
    }

    function makePort(result, btn = "", port = "") {
        if (btn == "" && port == "") {
            for (var i in result) {
                $('#port').append('<option value="' + result[i].Port + '">' + result[i].Port + '</option>');
            }

        } else if (btn == "" && port == "port_search") {
            for (var i in result) {
                $('#port_search').append('<option value="' + result[i].Port + '">' + result[i].Port + '</option>');
            }
        }
    }
</script>


<script>
    $(function() {
        $('#datepicker').datepicker({
            changeYear: true,
            changeMonth: true,
            showButtonPanel: true,
            monthNames: ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12"],
            monthNamesShort: ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12"],
            dateFormat: 'dd/MM/yy',

        });


        $("#datepicker").focus(function() {
            document.getElementById("ui-datepicker-div").style.zIndex = "99";
            $(".ui-datepicker-calendar").hide();
            $(".ui-datepicker-close").click(function(dateText, inst) {
                var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                var m = parseInt(month) + 1;
                month = m.toString();
                $('#datepicker').datepicker('setDate', new Date(year, month, 0));

            });
        });
    });
</script>


</html>