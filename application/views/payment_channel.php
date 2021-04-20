<!DOCTYPE html>
<html>
    <title>Payment</title>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
    <body>
        <div id="main" style=" margin-top: 5%;">
            <div class="wrapper">
                <div class="content-wrapper">
                    <section class="content" style=" padding-top:2%;">
                        <div class="container-fluid">
                            <div class="card card-secondary">
                                <div class="card-header" style="background-color: #c3000d;">
                                    <h3 class="card-title"> <b> ช่องทางการชำระเงิน </b> </h3>
                                </div>
                                
                                <div class="card-body">
                                    <form id ="brand" method = "post" action ="<?php //echo site_url('Payment_controller/insert_channel'); ?>" enctype = "multipart/form-data">
                                        <div class="col-md-12">     
                                            <div class="row" style=" margin-top: 2%;"> 
                                                <div class="col-md-2">
                                                    <div class="input-group mb-4">
                                                        <div class="input-group-prepend">
                                                            <button type="button" class="btn btn-primary "><b> รหัส </b></button>
                                                        </div>
                                                        <input id="code" name="code" type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="input-group mb-4">
                                                        <div class="input-group-prepend">
                                                            <button type="button" class="btn btn-primary "><b> รายละเอียด </b></button>
                                                        </div>
                                                        <input  id="detail" name="detail" type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="input-group mb-4">
                                                        <!--<button type="summit"  class="btn btn-default "  style="background-color: #D3D3D3;"><b> เพิ่ม </b></button>-->
                                                        <button type="button"  class="btn btn-success" onclick="Channel_Add()"><b> เพิ่ม </b></button>
                                                    </div>
                                                </div> 
                                            </div>
                                        </div>
                                        <br>
                                    </form>

                                    <div id="TableChannel">
                                        <?php $this->load->view('TableChannel')?>
                                    </div>

                                    </section> 
                                </div>    
                            </div>
                        </div>
                        
                        <div id="loadding" class="modal" style="display: none">
                            <img style="margin-top: 15%;width: 15%;" src="<?php echo base_url(); ?>assets/images/loader.gif">
                        </div>    

                    </body>

                    <script>
                        function Channel_Add() {	 //แนบตัวแปร page ไปด้วย
   
                                var code = document.getElementById('code').value;
                                var detail = document.getElementById('detail').value;
                                var datas = "code=" + code+"&detail="+detail;
 
                            if (code == "") {
                                    alert('กรุณากรอกข้อมูล รหัส');
                                    $('#code').focus();
                                   document.getElementById("code").style = "border: 1px red solid;";
                            }if(detail == ""){
                                alert('กรุณากรอกข้อมูล รายละเอียด');
                                    $('#detail').focus();
                                   document.getElementById("detail").style = "border: 1px red solid;"; 
                        }else {
                                document.getElementById("loadding").style.display = "block";
                                $.ajax({
                                    type: "POST",
                                    url: "<?php echo site_url('Payment_controller/insert_channel') ?>",
                                    data: datas,
                                }).done(function (data) {
                                    document.getElementById("loadding").style.display = "none";
                                    $('#TableChannel').html(data);  //Div ที่กลับมาแสดง
                

                                })
                            }
                        }
                    </script>

      
                </html>



