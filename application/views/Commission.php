<!--<link rel="stylesheet" href="<?php echo base_url() . "assets/"; ?>datetimepicker/build/jquery.datetimepicker.min.css">
<script src="<?php echo base_url() . "assets/"; ?>datetimepicker/jquery.js"></script>
<script src="<?php echo base_url() . "assets/"; ?>datetimepicker/build/jquery.datetimepicker.full.js"></script>-->


<!--<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }
    th, td {
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even){background-color: #f2f2f2}

    th {
        background-color: #66ccff;
        color: black;
    }
</style>-->

<style>
    #loaddingearch{
        position: fixed;
        left: 0px;
        width: 100%;
        height: 100%;
        padding-left:45%;
        padding-top: 15%;

    }.modal {
        display: none; 
        position: fixed;  
        height:100%; 
        background-color: rgb(0,0,0); /* Fallback color */ 
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        padding-top: 0px;

    }
</style>

<div id="loaddingearch" class="modal" style="display: none">
    <img src="<?php echo base_url(); ?>assets/images/loader.gif">
</div>

<div class="wrapper">
    <div class="content-wrapper">
        <section class="content" style=" padding-top: 2%;">
            <div class="container-fluid">
                <div class="card card-secondary">
                    <div class="card-header" style="background-color: #c3000d;">
                        <h3 class="card-title"> <b>ข้อมูลลูกค้า</b> </h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <!--start SearchPolicy -->
                        <div class="col-md-12">  
                            <div id="Div_Main_SearchCommission" name="Div_Main_SearchCommission">  
                                <div class="row" style=" margin-top: 2%;"> 
                                    <?php foreach ($username as $row): ?>									
                                    <input type="hidden" name="company" id="company" value="<?php echo iconv('TIS-620', 'UTF-8', $row->company); ?>">
                                    <?php endforeach; ?>

                                    <div class="col-md-6">
                                        <div class="input-group mb-4">
                                            <div class="input-group-prepend">
                                                <button type="button" class="btn btn-default "  style="background-color: #44CEF6;"><b>ค้นหาข้อมูลลูกค้า</b></button>
                                            </div>
                                            <input type="text" class="form-control" id="contract" name="contract">
                                            <div class="input-group-prepend">
                                                <button type="button" class="btn btn-warning "onclick="Searchcontractcustomer()"><i class="fa fa-search" aria-hidden="true"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                

                <!--End SearchCommission -->

                <div class="row" id="TableCustomer" name="TableCustomer">
                    <div class="col-md-12">
                        <?php //$this->load->view('TableCustomer'); ?>
                    </div>
                </div>

            </div>
    </div>
</div>
</section>
</div>
</div>


<script type="text/javascript">
    function Searchcontractcustomer() {
        alert('000000');
        var company = document.getElementById('company').value;
        var contract = document.getElementById('contract').value;


       var datas = "company="+company+"&contract="+contract; 

       alert(datas);

//        if (datepaystart == 0) {
//            alert("กรุณาเลือกการค้นหา");
//            $('#datepaystart').focus();
//            document.getElementById("datepaystart").style = "border: 1px red solid;";
//        }else if(datepayend == ''){
//            alert("กรุณากรอกข้อความ");
//            $('#datepayend').focus();
//            document.getElementById("datepayend").style = "border: 1px red solid;";
//        }else{
//        $('#loaddingearch').show();
        $.ajax({
                type: "POST",
                url: "<?php echo site_url('Payment_controller/customer_index_from') ?>",
                data: datas,
            }).done(function (data) {
                $('#TableCustomer').html(data);
            })
    }
//    }
</script>  


<script>
    function pagedatapay(page) {	 //แนบตัวแปร page ไปด้วย

        alert('0000');
           var company = document.getElementById('company').value;
        var contract = document.getElementById('custome_contract').value;


       var datas = "company=" + company+"&contract="+contract + "&page=" + page; 
       
        alert(datas);
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Payment_controller/customer_index_from') ?>",
            data: datas
        }).done(function (data) {
            $('#TableCommission').html(data);  //Div ที่กลับมาแสดง

        })
    }
</script>




<script type="text/javascript">
    jQuery('#datepaystart').datetimepicker({
        timepicker: false,
        format: 'Y-m-d'
    });
</script>



<script type="text/javascript">
    jQuery('#datepayend').datetimepicker({
        timepicker: false,
        format: 'Y-m-d'
    });
</script>







