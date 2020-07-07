
    
    <head>
        <title>Payment</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <script>
            function fncSubmit()
            {
                if (document.search.contract.value == "")
                {
                    alert('กรุณากรอกข้อมูล Search');
                    document.search.contract.focus();
                    return false;
                }

                document.search.submit();
            }
        </script>
    </head>
    <body >
        <div class="wrapper">
            <div class="content-wrapper">
                <section class="content" style=" padding-top:2%;">
                    <div class="container-fluid">
                        <div class="card card-secondary">
                            <div class="card-header" style="background-color: #c3000d;">
                                <h3 class="card-title"> <b> ข้อมูลลูกค้า </b> </h3>
                            </div>
                            <div class="card-body">
                                <form name="search">  
                                    <div class="input-group">
                                        <?php foreach ($username as $row): ?>									
                                            <input style="display: none;"type="text" name="company" value="<?php echo iconv('TIS-620', 'UTF-8', $row->company); ?>">
                                        <?php endforeach; ?>
                                        <div class="row" style=" margin-top: 2%;"> 
                                            <div class="input-group mb-5">
                                                <div class="input-group-prepend">
                                                    <button type="button" class="btn btn-default "  style="background-color: #44CEF6;"><b>วันที่</b></button>
                                                </div>
                                                <input type="text" id="contract" name="contract" class="form-control" placeholder="Search">
                                                <div class="input-group-prepend" >
                                                    <button type="button" class="btn btn-default " style="background-color: #16A951;" onclick="searchcustomer()"><i class="fa fa-search" aria-hidden="true"></i></button>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <hr>

                                <div align="center" id="showcustomer">

                                </div>

                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </body>





    <script>
        function searchcustomer() {	 //แนบตัวแปร page ไปด้วย

            var contract = document.getElementById('contract').value;

            var datas = "contract=" + contract;

            $.ajax({
                type: "POST",
                url: "<?php echo site_url('Payment_controller/customer_index_from') ?>",
                data: datas,
            }).done(function (data) {
                $('#showcustomer').html(data);  //Div ที่กลับมาแสดง
            })
        }
    </script>

</html>



