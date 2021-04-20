<!DOCTYPE html>
<html>
    <title>PAYMENT</title>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="<?php echo base_url(); ?>assets/sweetalert/dist/sweetalert.css" rel="stylesheet" type="text/css"> 
        <script src="<?php echo base_url(); ?>assets/sweetalert/dist/sweetalert.min.js"></script> 
        <script src="<?php echo base_url(); ?>AdminLTE/plugins/jquery/jquery.min.js"></script>
    <body>
        
      <style>
       /* Base CSS */
.alignleft {
    float: left;
    margin-right: 15px;
}
.alignright {
    float: right;
    margin-left: 15px;
}
.aligncenter {
    display: block;
    margin: 0 auto 15px;
}
a:focus { outline: 0 solid }
img {
    max-width: 100%;
    height: auto;
}
.fix { overflow: hidden }
h1,
h2,
h3,
h4,
h5,
h6 {
    margin: 0 0 15px;
    font-weight: 700;
}
html,
body { height: 100% }

a {
    -moz-transition: 0.3s;
    -o-transition: 0.3s;
    -webkit-transition: 0.3s;
    transition: 0.3s;
    color: #333;
}
a:hover { text-decoration: none }



.search-box{margin:80px auto;position:absolute;}
.caption{margin-bottom:50px;}
.loginForm input[type=text], .loginForm input[type=password]{
	margin-bottom:10px;
}
.loginForm input[type=submit]{
	background:#fb044a;
	color:#fff;
	font-weight:700;
	
}


#pswd_info {
	background: #dfdfdf none repeat scroll 0 0;
	color: #fff;
	left: 20px;
	position: absolute;
	top: 115px;
}
#pswd_info h4{
    background: black none repeat scroll 0 0;
    display: block;
    font-size: 14px;
    letter-spacing: 0;
    padding: 17px 0;
    text-align: center;
    text-transform: uppercase;
}
#pswd_info ul {
    list-style: outside none none;
}
#pswd_info ul li {
   padding: 10px 45px;
}



.valid {
	/*background: rgba(0, 0, 0, 0) url("https://s19.postimg.org/vq43s2wib/valid.png") no-repeat scroll 2px 6px;*/
	color: green;
	line-height: 21px;
	padding-left: 22px;
}

.invalid {
	/*background: rgba(0, 0, 0, 0) url("https://s19.postimg.org/olmaj1p8z/invalid.png") no-repeat scroll 2px 6px;*/
	color: red;
	line-height: 21px;
	padding-left: 22px;
}


#pswd_info::before {
    background: #dfdfdf none repeat scroll 0 0;
    content: "";
    height: 25px;
    left: -13px;
    margin-top: -12.5px;
    position: absolute;
    top: 50%;
    transform: rotate(45deg);
    width: 25px;
}
#pswd_info {
    display:none;
}
   </style>  
       
   <!--modal-->
        <div class="modal fade" id="modal-lg">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"> <b>ADD USER</b> </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form id ="brand" method = "post" action ="<?php echo site_url('Payment_controller/setting_insert'); ?>"enctype = "multipart/form-data">
                            <div class="col-md-6">
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <button type="button" class="btn btn-default "  style="background-color: #44CEF6;"><b>ชื่อ-นามสกุล</b></button>
                                    </div>
                                    <input id="name" type="text" class="form-control" name="name" placeholder="กรอก ชื่อ-นามสกุล">
                                </div>
                            </div>

                            <div class="col-md-12">    
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <button type="button" class="btn btn-default "  style="background-color: #44CEF6;"><b>User Level</b></button>
                                    </div>
                                    <!--<span class="input-group-addon" style="background-color: #44CEF6;"> <b>User Level</b></span>-->
            <!--                        <select class="form-control" id="Rights" name="Rights">
                                         <option>กรุณาเลือก Level </option>
                                    <?php //foreach ($rights as $key) { ?>
                                            <option value="<?php //echo $key->Right_Level;   ?>"><?php //echo $key->Subject_Right;   ?></option>
                                    <?php //} ?>
                                    </select> -->

                                    <span class="form-control" style="text-align: left;">
                                        <?php foreach ($rights as $key) { ?>
                                            <label class="radio-inline">&nbsp; &nbsp; <input type="radio" name="Rights" value="<?php echo $key->Right_Level; ?>"><?php echo"&nbsp; &nbsp;" . $key->Subject_Right; ?></label>
                                        <?php } ?>
                                    </span>
                                </div>
                            </div>  

                            <div class="col-md-12">    
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <button type="button" class="btn btn-default "  style="background-color: #44CEF6;"><b>บริษัท</b></button>
                                    </div>
                                    <select class="form-control" id="company" name="company">
                                        <option value="">กรุณาเลือก บริษัท</option>
                                        <option value="jmt">JMT</option>
                                        <option value="jam">JAM</option>
                                    </select>
                                </div>
                            </div> 

                            <div class="col-md-12">    
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group mb-4">
                                            <div class="input-group-prepend">
                                                <button type="button" class="btn btn-default "  style="background-color: #44CEF6;"><b>Username</b></button>
                                            </div>
                                            <input id="Username" type="text" class="form-control" name="Username" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group mb-4">
                                            <div class="input-group-prepend">
                                                <button type="button" class="btn btn-default "  style="background-color: #44CEF6;"><b>Password</b></button>
                                            </div> 
                                            <input  type="Password" class="form-control" name="Password" id="Password" maxlength="8" onchange="check_password()">
                                            <span style="position: absolute;right:15px;top:7px;" onclick="hideshow()" >
                                                <i id="slash" class="fa fa-eye-slash" style=" display: none"></i>
                                                <i id="eye" class="fa fa-eye"></i>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="col-md-5"></div>                                                
                                    <div class="col-md-7" >
                                        <div class="aro-pswd_info">
                                            <div id="pswd_info" style=" margin-top: -61%;  margin-left: 100%; width: 80%;">
                                                <h4>Password must be requirements</h4>
                                                <ul>
                                                    <li id="letter" class="invalid">At least <strong>one letter</strong></li>
                                                    <li id="capital" class="invalid">At least <strong>one capital letter</strong></li>
                                                    <li id="number" class="invalid">At least <strong>one number</strong></li>
                                                    <li id="length" class="invalid">Be at least <strong>8 characters</strong></li>
<!--                                               <li id="space" class="invalid">be<strong> use [~,!,@,#,$,%,^,&,*,-,=,.,;,']</strong></li>-->
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">    
                                <div class="modal-footer justify-content-between ">
                                    <button type="submit" class="btn btn-primary"> Save </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
<!--End modal-->


<div id="main">
    <div class="wrapper">
        <div class="content-wrapper">
            <section class="content" style=" padding-top:2%;">
                <div class="container-fluid">
                    <div class="card card-secondary">
                        <div class="card-header" style="background-color: #c3000d;">
                            <h3 class="card-title"> <b>จัดการข้อมูลผู้ใช้งาน</b> </h3>
                            <div class="card-tools">
                                <!--<button type="button" class="btn btn-info" onclick="document.getElementById('id01').style.display = 'block'">Add User</button>-->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-lg">
                                    Add User
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover" id="myTable">
                                    <thead  style="background-color: gray;">
                                        <tr>
                                            <th>No</th>
                                            <th>Username</th>
                                            <th style="text-align: center;">Company</th>
                                            <th style="text-align: center;">Status</th>
                                            <th style="text-align: center;">Rights</th>
                                            <th style="text-align: center;">Option</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $num = 1;
                                        foreach ($user as $row) {
                                            ?>
                                            <tr>
                                                <td><?php echo $num; ?></td>
                                                <td><?php echo iconv('tis-620', 'utf-8', $row->remark); ?></td>
                                                <td style="text-align: center;">
                                                    <?php
                                                    if ($row->company == 'jmt') {
                                                        echo "JMT";
                                                    }
                                                    ?> 
                                                    <?php
                                                    if ($row->company == 'jam') {
                                                        echo "JAM";
                                                    }
                                                    ?>  
                                                </td>
                                                <td style="text-align: center;">
                                                        <?php if ($row->user_status == 1) { ?>
                                                        <a onclick="Status()" href="<?php echo site_url('Payment_controller/setting_status?id=') . $row->id_run; ?>"><span style="color: green;"><i style="font-size: 1.3em;" class="glyphicon glyphicon-ok"> </i> เปิดใช้งาน</span></b>
                                                        <?php } else { ?>
                                                            <a onclick="Status()" href="<?php echo site_url('Payment_controller/setting_status?id=') . $row->id_run; ?>"><span style="color: red;"><i style="font-size: 1.3em;" class="glyphicon glyphicon-remove"> </i> ปิดใช้งาน</span></a>
                                                        <?php } ?>                                        
                                                </td>
                                                <td style="text-align: center;">
                                                    <?php if ($row->user_level == 0) { ?>
                                                        <span>User</span>
                                                    <?php } ?>
                                                    <?php if ($row->user_level == 1) { ?>
                                                        <span style="color: DodgerBlue;">Manager</span>
                                                    <?php } ?> 
                                                    <?php if ($row->user_level == 2) { ?>
                                                        <span style="color: Orange;">SuperAdmin</span>
                                                    <?php } ?> 
                                                </td>
                                                <td style="text-align: center;"><a href="<?php echo site_url('Payment_controller/setting_detail?id=') . $row->id_run; ?>"><button type="button" class="btn btn-success"><i class="glyphicon glyphicon-pencil"> </i> <b>UPDATE</b> </button></a></td> 
                                            </tr>                               
                                         <?php $num++;} ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
            </section> 
        </div>
    </div>
</div>  


<div class="row content">
</div>                        
<hr>

</body>

 <script>
        $(document).ready(function(){
	
	$('input[type=password]').keyup(function() {
		var pswd = $(this).val();
		
		//validate the length
		if ( pswd.length < 8 ) {
			$('#length').removeClass('valid').addClass('invalid');
		} else {
			$('#length').removeClass('invalid').addClass('valid');
		}
		
		//validate letter
		if ( pswd.match(/[A-z]/) ) {
			$('#letter').removeClass('invalid').addClass('valid');
		} else {
			$('#letter').removeClass('valid').addClass('invalid');
		}

		//validate capital letter
		if ( pswd.match(/[A-Z]/) ) {
			$('#capital').removeClass('invalid').addClass('valid');
		} else {
			$('#capital').removeClass('valid').addClass('invalid');
		}

		//validate number
		if ( pswd.match(/\d/) ) {
			$('#number').removeClass('invalid').addClass('valid');
		} else {
			$('#number').removeClass('valid').addClass('invalid');
		}
		
		//validate space
//		if ( pswd.match(/[^a-zA-Z0-9\-\/]/) ) {
//			$('#space').removeClass('invalid').addClass('valid');
//		} else {
//			$('#space').removeClass('valid').addClass('invalid');
//		}
		
	}).focus(function() {
		$('#pswd_info').show();
	}).blur(function() {
		$('#pswd_info').hide();
	});
	
});
        
   </script>
<!--<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>-->


</html>

<script>
     function check_password() {

         var password = document.getElementById('Password');

         if (password.value.match(/[a-z]/g)&& password.value.match(/[A-Z]/g) 
            && password.value.match(/[0-9]/g) && password.value.length == 8) {                    
          }else{
              swal("กรุณากรอก password ตัวใหญ่ตัวเล็กและตัวเลขให้ครบ 8 ตัว", "", "error");
              password.value = "";
          }
      }
</script>


<script>
        function hideshow(){

            
          var password = document.getElementById("Password");
          var slash = document.getElementById("slash");
          var eye = document.getElementById("eye");
          
          if(password.type === 'password'){
            password.type = "text";
            slash.style.display = "block";
            eye.style.display = "none";
          }
          else{
            password.type = "password";
            slash.style.display = "none";
            eye.style.display = "block";
          }

        }
</script>

<!--    <script type='text/javascript'>
        function check_password() {

            var elm = document.getElementById('Password');

            var len = elm.value.length;

            var regex1 = /^[A-Z]*$/;
            var val = elm.value;
            if (len == 6) {
                var num = val[1] + val[2] + val[3] + val[4] + val[5];
                if (val[0].match(regex1) && !isNaN(num)) {

                } else {
                    alert("กรูณากรอกรหัสให้ตรงตามรูปแบบ ตัวใหญ่ ตามด้วยตัวเลข ไม่เกิน 6 ตัว เช่น A123456 ");
                    elm.value = "";
                }
            }
        }
    </script>-->



