<html>

<head>
      <link href="<?php echo base_url(); ?>AdminLTE/plugins/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<!--    <meta http-equiv="content-type" content="text/html; charset=utf-8" />

    <title>Show All EIR</title>



    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/util.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/main.css">-->
    <!--<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">-->

<!--    <style>
        #header .active a {
            background-color: #9c9cb2;
            font-weight: bold;
        }

        .navbar {
            overflow: hidden;
            background-color: #333;
            position: fixed;
            top: 0;
            width: 100%;
        }

        .navbar a {
            float: right;
            display: block;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 17px;
            position: fixed;
        }

        .navbar a:hover {
            background: #ddd;
            color: black;
        }

        .main {
            padding: 16px;
            margin-top: 30px;
            height: 1500px;
        }

        .p {

            font-size: 14px;
            line-height: 2.0;
            color: #666666;
            margin: 0px;
        }
    </style>-->
    
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
<!--    <div id="main">-->
    

<!--        <div class="w3-sidebar w3-black w3-bar-block w3-animate-left" style="display:none;z-index:4" id="mySidebar">

            <button class="w3-bar-item w3-button w3-xlarge" onclick="w3_close()">Close &times;</button>           
            <button class="w3-bar-item w3-button w3-xlarge" onclick="eir()">EIR</button>
             <button class="w3-bar-item w3-button w3-xlarge" onclick="cash()">CashFlow</button> 

             <a href="<?php //echo site_url('Welcome/main') ?>" class="w3-bar-item w3-button w3-xlarge">Employee</a> 
            <a href="<?php //echo site_url('Call_Excel/index') ?>" class="w3-bar-item w3-button w3-xlarge">Import data</a>
             <a href="<?php //echo site_url('Welcome/logout') ?>" class="w3-bar-item w3-button w3-xlarge" style="color:red">Logout</a> 
        </div>-->
<!--        <div class="navbar">
            <div class="w3-overlay w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" id="myOverlay"></div>
            
             <a href="#" class="w3-bar-item w3-button w3-xlarge">Home</a> 
            <ul class="nav navbar-nav">
                <li><button class="w3-button  w3-xlarge w3-white" onclick="w3_open()">&#9776;</button></li>
                 <li><a href="<?echo site_url('Call_Excel');?>">IMPORT FILE</a></li>
                 <li><a href="<?echo site_url('Call_EditData')?>">EDIT DATA</a></li>
                  <li><a href="<?echo site_url('Call_ShowLog')?>">SHOW LOG</a></li> 
      
            </ul>

        </div>-->

<div id="main">
    <div class="wrapper">
        <div class="content-wrapper">
            <section class="content" style=" padding-top:2%;">
                <div class="container-fluid">
                    <div class="card card-secondary">
                        <div class="card-header" style="background-color: #c3000d;">
                            <h3 class="card-title"> <b> Report </b> </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="main_eir" >
                                <form id="search_form">
                                    <div id="search">
                        <?php //$this->load->view($search) ?>
                      
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
                        <!--<div class="row" >-->
                             <div class="col-md-12">
                                 <div class="input-group mb-4" id="buttonexport">
                                       <div class="input-group-prepend" style=" margin-left: 81%">
                                           <button type="button" onclick="excel()" class="btn btn-success btn-sm" ><i class="fas fa-file-excel"> </i> ExportExcel</button> 
                                         <button type="button" onclick="pdf()" class="btn btn-danger btn-sm"><i class="fa fa-file-pdf"></i> ExportPDF  </button>  
                                     </div> 
                                 </div> 
                             </div> 
                         <!--</div>-->

<!--                            <div class="row">
                                <div class="custom-select">
                                    <select id="company" name="company" style="height: 26px; font-size:15px;"onchange = "com()">
                                        <option value="">Select Company</option>
                                        <?php foreach ($company as $c) { ?>
                                            <option value="<?php echo $c->Company ?>"><?php echo $c->Company ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="custom-select" id ="com_port">
                                        <select id="port" name= "port" style="height: 26px; font-size:15px;">
                                            <option value="">Select Port</option>
                                            <?php foreach ($port as $s) { ?>
                                                <option value="<?php echo $s->Port ?>"><?php echo $s->Port ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    Date :<input type="month" id="date" name="date" >&nbsp;
                                    <button type="button" onclick="search()"class="btn btn-info btn-sm">ค้นหา</button>
                                    <button type="button" onclick="refresh()"class="btn btn-success btn-sm">Refresh</button>
                                    <button type="button" style="margin-left: 10px;" onclick="excel()" class="btn btn-success btn-sm"><i class="fa fa-file-excel-o "></i> ExportExcel</button> 
                                    <button type="button" onclick="pdf()" class="btn btn-danger btn-sm"><i class="fa fa-file-pdf-o"></i> ExportPDF</button>

                                </div>
                            </div>-->
              
                    
                    
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
</body>


<!--<div id="id01" class="w3-modal">
    <div class="w3-modal-content w3-animate-top w3-card-4">
        <header class="w3-container" style="background-color: #000000;">
            <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-darkgray w3-display-topright w3-lg">&times;</span>
            <h2 style="color: #fff">View</h2>
        </header>
        <div class="w3-container" id="viewmodal">

        </div>
        <footer class="w3-container" style="background-color: #000000; height:34px">
            <p style="color: #fff">
                <button type="button" onclick="document.getElementById('id01').style.display='none'" class=" w3-display-bottomright  btn btn-danger" style="margin-right: 1px">Close</button>
            </p>
        </footer>
    </div>
</div>-->

<script>
function search() {
        
        var datas = "port=" + document.getElementById('port').value + "&date=" + document.getElementById('date').value
        + "&company=" + document.getElementById('company').value;

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('port/pagingmain_eir') ?>",
            data: datas,
        }).done(function(data) {
             $('#all_eir').html(data);        
        });
        

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
        var num_page = document.getElementById('pageing_eir').value;
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('port/pagingmain_eir?num_page=') ?>" + num_page,
            data: $("#search_form").serialize(),
        }).done(function(data) {

            $('#all_eir').html(data);

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

        var datas = "Port=" + Port;

        $.ajax({
            type: "POST",
            url: window.open("<?php echo site_url('port/port_cash?') ?>"+datas),
            data: datas,
        }).done(function(data) {
//            $('#all_eir').html(data);
            // $('#viewmodal').html(data);
            // // console.log(data);
            // document.getElementById('id01').style.display = 'block'
        });
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