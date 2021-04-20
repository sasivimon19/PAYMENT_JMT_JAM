<html>
<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8" / >
    <title>SHOW ALL EIR</title>
<!--    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/util.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/main.css">
    <link href="<?php echo base_url(); ?>assets/sweetalert/dist/sweetalert.css" rel="stylesheet" type="text/css"> 
    <script src="<?php echo base_url(); ?>assets/sweetalert/dist/sweetalert.min.js"></script> 
    <script src="<?php echo base_url(); ?>AdminLTE/plugins/jquery/jquery.min.js"></script>-->
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"> -->
    <link href="<?php echo base_url(); ?>assets/sweetalert/dist/sweetalert.css" rel="stylesheet" type="text/css"> 
    <script src="<?php echo base_url(); ?>assets/sweetalert/dist/sweetalert.min.js"></script> 
    <script src="<?php echo base_url(); ?>AdminLTE/plugins/jquery/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>css/1.css">
    <script type = 'text/javascript' src = "<?php echo base_url(); ?>js/js.js"></script> 
        
    <style>
              #loadding{
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
<style>
        /* For desktop: */
        .col-1 {width: 8.33%;}
        .col-2 {width: 16.66%;}
        .col-3 {width: 25%;}
        .col-4 {width: 33.33%;}
        .col-5 {width: 41.66%;}
        .col-6 {width: 50%;}
        .col-7 {width: 58.33%;}
        .col-8 {width: 66.66%;}
        .col-9 {width: 75%;}
        .col-10 {width: 83.33%;}
        .col-11 {width: 91.66%;}
        .col-12 {width: 100%;}

    @media only screen and (max-width: 768px) {
    /* For mobile phones: */
    [class*="col-"] {
        width: 100%;
    }
    @media only screen and (max-width: 600px) {
        #buttonexport{
            margin-left: -60%;
        }
    } 
}
</style>

</head>

<body>
    
<div id="main">
    <div class="wrapper">
        <div class="content-wrapper">
            <section class="content" style=" padding-top:2%;">
                <div class="container-fluid">
                    <div class="card card-secondary">
                        <div class="card-header" style="background-color: #c3000d;">
                            <h3 class="card-title"> <b> Report </b> </h3>
                        </div>
                        <div class="card-body">
                            <div id="main_eir" >
                                <form id="search_form">
                                    <div id="search">
                                        <div class="row" style=" margin-top: 2%;"> 
                                            <div class="col-md-3">
                                                <div class="input-group mb-4">
                                                    <div class="input-group-prepend">
                                                        <button type="button" class="btn btn-default "  style="background-color: #44CEF6;"><b>Company</b></button>
                                                    </div>
                                                    <select  class="form-control"  id="company" name="company" onchange = "com()">
                                                        <option value=""> - เลือก -</option>
                                                        <?php foreach ($company as $c) { ?>
                                                            <option value="<?php echo $c->Company ?>"><?php echo $c->Company ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3" id="com_port">    
                                                <div class="input-group mb-4">
                                                    <div class="input-group-prepend">
                                                        <button type="button" class="btn btn-default "  style="background-color: #44CEF6;"><b>Port</b></button>
                                                    </div>
                                                    <select  class="form-control"  id="port" name= "port">
                                                        <option value="">-- เลือก Port --</option>
                                                        <?php foreach ($port as $s) { ?>
                                                            <option value="<?php echo $s->Port ?>"><?php echo $s->Port ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="input-group mb-4">
                                                    <div class="input-group-prepend">
                                                        <button type="button" class="btn btn-default "  style="background-color: #44CEF6;"><b>Date</b></button>
                                                    </div>
                                                    <input class=" form-control" type="month" id="date" name="date" >
                                                    <div class="input-group-prepend" >
                                                        <button type="button" class="btn btn-info btn-sm"  onclick="search()"><i class="fa fa-search" aria-hidden="true"></i>ค้นหา</button>
                                                        <button type="button" class="btn btn-danger btn-sm" onclick="refresh()">Refresh</button>
                                                    </div>   
                                                </div>
                                            </div>  

                                        </div>
                       
                                        <div class="col-md-12">
                                            <div class="input-group mb-4" id="buttonexport">
                                                <div class="input-group-prepend" style=" margin-left: 81%">
                                                    <button type="button" onclick="excel()" class="btn btn-success btn-sm" ><i class="fas fa-file-excel"> </i> ExportExcel</button> 
                                                    <button type="button" onclick="pdf()" class="btn btn-danger btn-sm"><i class="fa fa-file-pdf"></i> ExportPDF  </button>  
                                                </div> 
                                            </div> 
                                        </div> 
                                        <div id="all_eir">
                                            <?php $this->load->view('EIR_JMT/report_eir') ?>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
    
    <div id="loadding" class="modal" style="display: none" >
        <img style="margin-top: 15%;width: 15%;" src="<?php echo base_url(); ?>assets/images/loader.gif">
    </div>

</body>


<script>
function search() {
    
        document.getElementById('loadding').style.display = "block"; 

        var port = document.getElementById('port').value;
        var date = document.getElementById('date').value;
        var company = document.getElementById('company').value;
        
        var datas = "port="+port+"&date="+date+"&company="+company;
  
        if(company == ''){
            swal("กรุณากรอกบริษัท", "", "warning");
        }
//        else if(port == ''){
//            swal("กรุณากรอก PORT", "", "warning");
//        }
        else if(date == ''){
            swal("กรุณากรอกวันที่", "", "warning");
        }else {
            swal({
                title: "",
                icon: "warning",
                buttons: true,
                dangerMode: false,
            }),    
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('port/pagingmain_eir') ?>",
            data: datas,
        }).done(function(data) {
            $('#all_eir').html(data);  
            swal("ค้นหาข้อมูลสำเร็จ", "", "success");
           
        });
         
    }
    document.getElementById('loadding').style.display = "none";
} 
    
    
    function refresh() {
     
        location.reload();
    }

    function com() {
        
        var datas =  "company=" + document.getElementById('company').value;

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('port/com') ?>",
            data: datas,
        }).done(function(data) {
             $('#port').html(data);        
        });
    }

</script>


<script>
    function pageing123_eir() {
        
        document.getElementById('loadding').style.display = "block"; 
        var num_page = document.getElementById('pageing_eir').value;
        
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('port/pagingmain_eir?num_page=') ?>" + num_page,
            data: $("#search_form").serialize(),
        }).done(function(data) {

            $('#all_eir').html(data);
            document.getElementById('loadding').style.display = "none"; 
        });

    }

    function cash() {
        var datas = "";
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('port/cash') ?>",
            data: datas,
        }).done(function(data) {
            $('#main').html(data);


        });
    }

    function eir() {
        var datas = "";
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('port/main_eir') ?>",
            data: datas,
        }).done(function(data) {
            $('#main').html(data);


        });
    }

    function delete1(id) {
        var datas = "id=" + id;
        //    alert(datas);
        if (confirm("คุณต้องการลบข้อมูลนี้ หรือไม่")) {
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('port/delete_eir') ?>",
                data: datas,
            }).done(function(data) {
                $('#all_eir').html(data);

            });
        }

    }

    function view(Port) {

        var datas = "?Port=" + Port;
        window.open("<?php echo site_url('port/port_cash') ?>"+datas)
//        $.ajax({
//            type: "POST",
//            url: window.open("<?php echo site_url('port/port_cash?') ?>"+datas),
//            data: datas,
//        }).done(function(data) {
////            $('#all_eir').html(data);
//            // $('#viewmodal').html(data);
//            // // console.log(data);
//            // document.getElementById('id01').style.display = 'block'
//        });
    }

    // function view1(row) {

    //     var datas = "row=" + row;

    //     $.ajax({
    //         type: "POST",
    //         url: "<?php //echo site_url('port/view_cash') ?>",
    //         data: datas,
    //     }).done(function(data) {
    //         $('#viewmodal').html(data);
    //         // console.log(data);
    //         document.getElementById('id01').style.display = 'block'
    //     });
    // }

    function excel() {
        var datas = '';
        $.ajax({
            type: "POST",
            url: window.open("<?php echo site_url('port/excel_eir?') ?>" + $("#search_form").serialize()),
            data: datas,
        }).done(function(data) {

        });
    }


    function pdf() {

        var datas = '';
        $.ajax({
            type: "POST",
            url: window.open("<?php echo site_url('port/pdf_eir?') ?>" + $("#search_form").serialize()),
            data: datas,
        }).done(function(data) {

        });
    }

    function w3_open() {
        document.getElementById("mySidebar").style.display = "block";
        document.getElementById("myOverlay").style.display = "block";
    }

    function w3_close() {
        document.getElementById("mySidebar").style.display = "none";
        document.getElementById("myOverlay").style.display = "none";
    }
</script>


<!-- 15 นาที ออกจากระบบ--> 
<script>
    var timeout;
    document.onmousemove = function () {
        clearTimeout(timeout);
        timeout = setTimeout(function () {
            window.location.href = "<?php echo site_url('Payment_controller/index'); ?>";
        }, 600000); //1นาที = 60000 หน่วย = 60000 x 15นาที = 900000 หน่วย
    }
</script>
<!-- END 15 นาที ออกจากระบบ-->