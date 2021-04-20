<!--<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/util.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/main.css">-->
 

<!--<style>
    /* Removes the clear button from date inputs */
input[type="month"]::-webkit-clear-button {
    display: block;
}

/* Removes the spin button */
input[type="month"]::-webkit-inner-spin-button { 
    display: none;
}

/* Always display the drop down caret */
input[type="month"]::-webkit-calendar-picker-indicator {
    color: #2c3e50;
}


/* A few custom styles for month inputs */
input[type="month"] {
    appearance: block;
    -webkit-appearance: none;
    color: #95a5a6;
    font-family: "Helvetica", arial, sans-serif;
    font-size: 16px;
    border:1px solid black;
    background:#ecf0f1;
 
    
    display: inline-block !important;
    visibility: visible !important;
}

input[type="month"], focus {
    color: black;
    box-shadow: none;
    -webkit-box-shadow: none;
    -moz-box-shadow: none;
    border:1px solid black;
}

.custom-select {
    appearance: block;
    -webkit-appearance: none;
    color: #95a5a6;
    font-family: "Helvetica", arial, sans-serif;
    font-size: 16px;
    
    background:#ecf0f1;
    color: black;
    box-shadow: none;
    -webkit-box-shadow: none;
    -moz-box-shadow: none;
    
 
    
    display: inline-block !important;
    visibility: visible !important;
}
</style>-->
    <link href="<?php echo base_url(); ?>assets/sweetalert/dist/sweetalert.css" rel="stylesheet" type="text/css"> 
    <script src="<?php echo base_url(); ?>assets/sweetalert/dist/sweetalert.min.js"></script> 
    <script src="<?php echo base_url(); ?>AdminLTE/plugins/jquery/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/font-awesome-4.7.0/css/font-awesome.min.css">
        
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
        @media only screen and (max-width: 600px) {
            #buttonexcel_cash{
                margin-left: -100%;
            }
            #buttonpdf_cash{
                margin-left: 0%;
            }
        }
</style>

<div id="main">
    <div class="wrapper">
        <div class="content-wrapper">
            <section class="content" style=" padding-top:2%;">
                <div class="container-fluid">
                    <div class="card card-secondary">
                        <div class="card-header" style="background-color: #c3000d;">
                            <h3 class="card-title"> <b> Report </b> </h3>
<!--                            <div class="card-tools">
                                <button type="button"  class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            </div>-->
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
                                                    <select class=" form-control" id="port" name= "port">
                                                        <option style="display: none;" value=" <?php echo $selecport ?>"><?php echo $selecport ?></option>

                                                        <?php foreach ($port as $s) { ?>
                                                            <option value="<?php echo $s->Port ?>"><?php echo $s->Port ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
            
                
                                            <div class="col-md-3">
                                                <div class="input-group mb-4">
                                                    <div class="input-group-prepend">
                                                        <button type="button" class="btn btn-default "  style="background-color: #44CEF6;"><b>DateEnd</b></button>
                                                    </div>
                                                    <input class=" form-control" type="month" id="date" name="date" > 
                                                </div>
                                            </div> 
                                            
                                            <div class="col-md-4">
                                                <div class="input-group mb-4">
                                                    <div class="input-group-prepend">
                                                        <button type="button" class="btn btn-default "  style="background-color: #44CEF6;"><b>DateEnd</b></button>
                                                    </div>
                                                    <input class=" form-control" type="month" id="date1" name="date1" >

                                                    <div class="input-group-prepend" >
                                                       <button type="button" onclick="search_cash()"class="btn btn-info btn-sm">ค้นหา</button>
                                                        <button type="button" class="btn btn-danger btn-sm" onclick="refresh_cash()">Refresh</button>
                                                    </div>   
                                                </div>
                                            </div> 

                                        </div>

                                        <div class="col-md-12">
                                            <div class="input-group mb-4" id="buttonexport">
                                                <div class="input-group-prepend"  style=" margin-left: 81%">
                                                    <button type="button" id="buttonexcel_cash" onclick="excel_cash()" class="btn btn-success btn-sm" ><i class="fas fa-file-excel"> </i> ExportExcel </button> 
                                                    <button type="button" id="buttonpdf_cash" onclick="pdf_cash()" class="btn btn-danger btn-sm"><i class="fa fa-file-pdf"></i> ExportPDF </button>  
                                                </div> 
                                            </div> 
                                        </div> 

                                        <div id="all_eir">
                                            <?php $this->load->view('EIR_JMT/cash_flow') ?>
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


<!--<div class="container">
    <div class="row">
    <div class="custom-select">
    <select id="port" name= "port" style="height: 26px; font-size:15px;">
    <option style="display: none;" value=" <?php// echo $selecport?>"><?php //echo $selecport?></option>
        
            <?php //foreach($port as $s){?>
                <option value="<?php// echo $s->Port?>"><?php //echo $s->Port?></option>
                <?php //}?>
        </select>
        </div>

        DateStart:<input type="month" id="date" name="date">

        DateEnd:<input type="month" id="date1" name="date1">

        <button type="button" onclick="search_cash()"class="btn btn-info btn-sm">ค้นหา</button>
        <button type="button" onclick="refresh_cash()"class="btn btn-success btn-sm">Refresh</button>
        <button type="button"  style="margin-left: 10px;" onclick="excel_cash()" class="btn btn-success btn-sm"><i class="fa fa-file-excel-o"></i> ExportExcel</button>
        <button type="button" onclick="pdf_cash()" class="btn btn-danger btn-sm"><i class="fa fa-file-pdf-o"></i> ExportPDF</button>
    </div>
</div>
<br>-->

<script>
function search_cash() {
    
       document.getElementById('loadding').style.display = "block"; 
        
        var datas = "port=" + document.getElementById('port').value 
                + "&date=" + document.getElementById('date').value 
                + "&date1=" + document.getElementById('date1').value;
        
       
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('port/pagingmain_cash') ?>",
            data: datas,
        }).done(function(data) {
             $('#all_eir').html(data); 
             document.getElementById('loadding').style.display = "none"; 
        });
        
        
    }
    
    function refresh_cash() {
     
        location.reload();
    }

    function excel_cash() {
        var datas = '';
        $.ajax({
            type: "POST",
            url: window.open("<?php echo site_url('port/excel_cash?') ?>" + $("#search_form").serialize()) ,
            data: datas,
        }).done(function(data) {

        });
    }


    function pdf_cash() {
    
        var datas = '';
        
        $.ajax({
            type: "POST",
            url: window.open("<?php echo site_url('port/pdf_cash?') ?>" + $("#search_form").serialize()),
            data: datas,
        }).done(function(data) {
        

        });
    }

</script>
