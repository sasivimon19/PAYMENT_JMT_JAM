<!DOCTYPE html>
<html>
    <title>Daily Receive Report</title>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->

        <!--    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
            <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>css/1.css">
        <script type = 'text/javascript' src = "<?php echo base_url(); ?>js/js.js"></script>
        
        <link href="<?php echo base_url(); ?>assets/DataTables/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"> 
        <script src="<?php echo base_url(); ?>assets/DataTables/js/jquery.dataTables.min.js"></script>
        
        <!--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">-->
        <!--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">-->
<!--        <style>
            .b {
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);overflow: auto;font-size: 0.9em;width: 99.9%;
            }
        </style>-->
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
                background-color: rgba(0,0,0,0.5);
                z-index: 2;
                cursor: pointer;
            }
        </style>
<!--        <style>
            .td {
                padding: 5px; 
            }
        </style>-->
    </head>
    <!--<body >-->
    <div id="main">
        <div class="wrapper">
            <div class="content-wrapper">
                <section class="content" style=" padding-top:2%;">
                    <div class="container-fluid">
                        <div class="card card-secondary">
                            <div class="card-header" style="background-color: #c3000d;">
                                <h3 class="card-title"> <b>Daily Receive Report</b> </h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <!--start SearchPolicy -->
                                <!--<div class="col-md-12">-->  
                                <!--<div class="row" style=" margin-top: 1%;">--> 
                           <!--           <p align="center" style="color: red;font-size: 1.3em;">
                                <?php //echo '<br/><label>'.$this->session->flashdata("error").'</label>'; ?>                    
</p>-->
                                <!--<div class="divvv w3-animate-right" style="background-color:#FFFFFF;margin-top: 0px;">-->
                                <!--                <div class="row" style="width: 100%;">
                                                    <div class="col-sm-4" style="width: 100%;">
                                                        <h3 align="center" style="color: #040404;margin-bottom: 0px;margin-top: 0px;">Daily Receive Report</h3>
                                                    </div>
                                                </div>-->
                                <!--<hr style="margin-bottom: 10px;margin-top: 10px;">-->
                                <form id="scan" method = "post"  action="<?php echo site_url('Payment_controller/daily_PDF') ?>" enctype = "multipart/form-data" target="_blank">
                                    <!--                    <table style="width: 100%;text-align: center;">
                                                            <tr>
                                                                <td class="td" style="width: 35%;">
                                                                    <select class="form-control" id="Operator" name="Operator">
                                                                        <option value="">เลือก Operator</option>
                                    <?php //foreach ($op as $row) { ?>
                                                             <option value="<?php echo $row->operator_name; ?>"><?php echo $row->operator_name; ?></option>
                                    <?php //} ?>                    
                                                                    </select>
                                                                </td>
                                    
                                                                <td class="td" style="width: 15;">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon">LOT</span>
                                                                        <input id="lot" type="text" class="form-control" name="lot">
                                                                    </div>
                                                                </td>
                                    
                                                                <td class="td" style="width: 40%;">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon">วันที่</span>
                                                                        <input id="datestart" type="date" class="form-control" name="datestart">
                                                                    </div>
                                                                </td>
                                    
                                                                <td class="td" style="width: 10%;">
                                                                    <button onclick="scan()" type="button" class="btn btn-info" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);padding: 5px;width: 100%;">ค้นหา</button>
                                                                </td>
                                                            </tr>
                                                        </table>-->
                                    <!--<div class="col-md-12">-->     
                                    <div class="row" style=" margin-top: 2%;"> 
                                        <div class="col-md-5">
                                            <div class="input-group mb-4">
                                                <div class="input-group-prepend">
                                                    <button type="button" class="btn btn-default "  style="background-color: #44CEF6;"><b>Operator</b></button>
                                                </div>
                                                <select class="form-control" id="Operator" name="Operator">
                                                    <option value="">เลือก Operator</option>
                                                    <?php foreach ($op as $row) { ?>
                                                        <option value="<?php echo $row->operator_name; ?>"><?php echo $row->operator_name; ?></option>
                                                    <?php } ?>                    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">    
                                            <div class="input-group mb-4">
                                                <div class="input-group-prepend">
                                                    <button type="button" class="btn btn-default "  style="background-color: #44CEF6;"><b>LOT</b></button>
                                                </div>
                                                <input id="lot" type="text" class="form-control" name="lot">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group mb-4">
                                                <div class="input-group-prepend">
                                                    <button type="button" class="btn btn-default "  style="background-color: #44CEF6;"><b>วันที่</b></button>
                                                </div>
                                                <input id="datestart" type="date" class="form-control" name="datestart">
                                                <div class="input-group-prepend" >
                                                    <button type="button" class="btn btn-default " style="background-color: #16A951;" onclick="scan()"><i class="fa fa-search" aria-hidden="true"></i></button>
                                                </div>   
                                            </div>
                                        </div>  
                                    </div>
                                    </form>
                            </div>

                            <div align="center" id="show">

                            </div>

                            <div align="center" id="overlay" onclick="off()">
                                <img style="margin-top: 20%;width: 20%;" src="<?php echo base_url(); ?>assets/images/loader4.gif">
                            </div>
                            
                             </div>
                            
                        </div>
                    </section> 
                   </div>
               </div>
           </div>



<!--                </div>

                
            </div>-->

<!--</div>-->
<!--</div>-->
<!--</body>-->

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>

    
<script>
        function pagedatapay(page){	 //แนบตัวแปร page ไปด้วย

       var Operator = document.getElementById('Operator').value;
       var lot = document.getElementById('lot').value;
       var datestart = document.getElementById('datestart').value; 
       
       var datas = "Operator=" + Operator+"&lot="+lot+"&datestart="+datestart+"&page="+page; 
             $.ajax({
                type:"POST",
                url:"<?php echo site_url('Payment_controller/daily_view') ?>",
                data:datas,
              }).done(function(data){	
                 $('#show').html(data);  //Div ที่กลับมาแสดง
             }) 	
}
</script>

<script>
    $(document).ready(function () {
        $('#myTable').DataTable({
            "pageLength": 20,
            dom: 'Bfrtip',
            buttons: [
                'excel'
            ]
        });
    });
</script>

<script type="text/javascript">
    function scan() {
        var datestart = document.getElementById('datestart').value;
        // var dateend = document.getElementById('dateend').value;
        var lot = document.getElementById('lot').value;
        var Operator = document.getElementById('Operator').value;
        // var idcustomer = document.getElementById('idcustomer').value;


        if (datestart == '' | Operator == '') {
            alert("กรุณากรอกข้อมูล Operator | วันที่รับชำระ");
        } else {
            document.getElementById('overlay').style.display = "block";
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('Payment_controller/daily_view') ?>",
                data: $("#scan").serialize(),
            }).done(function (data) {
                // alert(data);
                $('#show').html(data);
                document.getElementById('overlay').style.display = "none";
            })
        }
    }
</script>

</html>



