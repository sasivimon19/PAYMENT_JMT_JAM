<head>
    <title>Payment</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


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
    </style>

</head>

<body>


    <div class="wrapper">
        <div class="content-wrapper">
            <section class="content" style=" padding-top:3%;">
                <div class="container-fluid">
                    <div class="card card-secondary">
                        <div class="card-header" style="background-color: #c3000d !important;">
                            <h3 class="card-title"> <b> ข้อมูลลูกค้า </b> </h3>
                        </div>

                        <div class="card-body">
                            <form name="search">
                                <?php foreach ($username as $row) : ?>
                                    <input style="display: none;" type="text" name="company" value="<?php echo iconv('TIS-620', 'UTF-8', $row->company); ?>">
                                <?php endforeach; ?>

                                <div class="col-md-6">
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <button type="button" class="btn btn-primary "><b>ค้นหาข้อมูลลูกค้า</b></button>
                                        </div>
                                        <input type="text" id="contract" name="contract" class="form-control userformcustomer" placeholder="Search">
                                        <div class="input-group-prepend">
                                            <button type="button" class="btn btn-success" onclick="searchcustomer()"><i class="fa fa-search" aria-hidden="true"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        
                        <div id="showcustomer">

                        </div>

                    </div>
            </section>
        </div>
    </div>

    <div id="loadding" class="modal" style="display: none">
        <img style="margin-top: 15%;width: 15%;" src="<?php echo base_url(); ?>assets/images/loader.gif">
    </div>

</body>

<script>
    function searchcustomer() { //แนบตัวแปร page ไปด้วย

        var contract = document.getElementById('contract').value;
        var datas = "contract=" + contract;

        checkvalcustomer = () => {
            $(".userformcustomer").each(function() {
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

        if (checkvalcustomer() == false) {
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
            document.getElementById("loadding").style.display = "block";

            $.ajax({
                type: "POST",
                url: "<?php echo site_url('Payment_controller/customer_index_from') ?>",
                data: datas,
            }).done(function(data) {
                document.getElementById("loadding").style.display = "none";
                $('#showcustomer').html(data); //Div ที่กลับมาแสดง
            })
        }
    }
</script>

</html>