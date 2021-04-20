<!DOCTYPE html>
<html>
    <head>
    <title>Payment</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/font-awesome-4.7.0/css/font-awesome.min.css">
        <link href="<?php echo base_url(); ?>assets/sweetalert/dist/sweetalert.css" rel="stylesheet" type="text/css"> 
        <script src="<?php echo base_url(); ?>assets/sweetalert/dist/sweetalert.min.js"></script> 
        <script src="<?php echo base_url(); ?>AdminLTE/plugins/jquery/jquery.min.js"></script>
   </head>
   
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
    /*position: absolute;*/
    top: 50%;
    transform: rotate(45deg);
    width: 25px;
}
#pswd_info {
    display:none;
}
   </style>
    <body>

        <div id="main" style=" margin-top: 5%;">
            <div class="wrapper">
                <div class="content-wrapper">
                    <section class="content" >
                        <div class="container-fluid">
                            <div class="card card-secondary">
                                <div class="card-header" style="background-color: #c3000d;">
                                    <h3 class="card-title"> <b>จัดการข้อมูลผู้ใช้งาน</b> </h3>
                                </div>
                                <div class="card-body">
                                    <?php foreach ($user as $row) { ?>
                                        <form id ="brand" method = "post" action ="<?php echo site_url('Payment_controller/setting_update?id=' . $row->id_run); ?>"enctype = "multipart/form-data">
                                            <div class="row" style=" margin-top: 2%;"> 
                                                    <div class="col-md-12">    
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="input-group mb-4">
                                                                    <div class="input-group-prepend">
                                                                        <button type="button" class="btn btn-default "  style="background-color: #44CEF6;"><b>Username</b></button>
                                                                    </div>
                                                                    <input id="Username" type="text" class="form-control" name="Username" value="<?php echo $row->username; ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="input-group mb-4">
                                                                    <div class="input-group-prepend">
                                                                        <button type="button" class="btn btn-default "  style="background-color: #44CEF6;"><b>Password</b></button>
                                                                    </div>
                                                                    <input id="Password" type="Password" class="form-control" name="Password" maxlength="8" onchange="check_password()" value="<?php echo $row->password; ?>">
                                                                    <span style="position: absolute;right:15px;top:7px;" onclick="hideshow()" >
                                                                            <i id="slash" class="fa fa-eye-slash" style=" display: none"></i>
                                                                            <i id="eye" class="fa fa-eye"></i>
                                                                    </span>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-5"></div>                                                
                                                                <div class="col-md-7" >
                                                                    <div class="aro-pswd_info">
                                                                        <div id="pswd_info" style=" margin-top: -10%;  margin-left: 50%; width: 48%;">
                                                                            <h4>Password must be requirements</h4>
                                                                            <ul>
                                                                                <li id="letter" class="invalid">At least <strong>one letter</strong></li>
                                                                                <li id="capital" class="invalid">At least <strong>one capital letter</strong></li>
                                                                                <li id="number" class="invalid">At least <strong>one number</strong></li>
                                                                                <li id="length" class="invalid">Be at least <strong>8 characters</strong></li>
    <!--                                                                       <li id="space" class="invalid">be<strong> use [~,!,@,#,$,%,^,&,*,-,=,.,;,']</strong></li>-->
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
            
                                                
                                                    <div class="col-md-6">
                                                        <div class="input-group mb-4">
                                                            <div class="input-group-prepend">
                                                                <button type="button" class="btn btn-default "  style="background-color: #44CEF6;"><b>ชื่อ-นามสกุล</b></button>
                                                            </div>
                                                            <input id="name" type="text" class="form-control" name="name" value="<?php echo iconv('tis-620', 'utf-8', $row->name) ?>">
                                                        </div>
                                                    </div>

                                                     <div class="col-md-6">
                                                             <div class="input-group mb-4">
                                                                 <div class="input-group-prepend">
                                                                     <button type="button" class="btn btn-default "  style="background-color: #44CEF6;"><b>บริษัท</b></button>
                                                                 </div>
                                                                 <select class="form-control" id="company" name="company">
                                                                     <option value="<?php echo $row->company; ?>">
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
                                                                     </option>
                                                                     <option value="jmt">JMT</option>
                                                                     <option value="jam">JAM</option>
                                                                 </select>
                                                             </div>
                                                         </div>
                                                
                                                    <div class="col-md-6">    
                                                        <div class="input-group mb-4">
                                                            <div class="input-group-prepend">
                                                                <button type="button" class="btn btn-default "  style="background-color: #44CEF6;"><b>User Level</b></button>&nbsp; &nbsp;
                                                            </div>
                                                            <?php
                                                            foreach ($rights as $key) {
                                                                if ($row->user_level == $key->Right_Level) {
                                                                    ?>
                                                                    <label class="radio-inline">&nbsp;&nbsp;&nbsp;<input type="radio" name="Rights" value="<?php echo $key->Right_Level; ?>" checked>  <?php echo" &nbsp;&nbsp;" . $key->Subject_Right; ?></label>
                                                                <?php } else { ?>
                                                                    <label class="radio-inline">&nbsp;&nbsp;&nbsp;<input type="radio" name="Rights" value="<?php echo $key->Right_Level; ?>">  <?php echo" &nbsp;&nbsp;" . $key->Subject_Right; ?></label>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>


                                                <table class="" style="width: 100%;text-align: left;">
                                                    <tr>
                                                        <td style="width: 49.5%;"><b style="font-size: 1.2em;">เมนู</b></td>
                                                        <td style="width: 49.5%;"><b style="font-size: 1.2em;">Modul</b></td>
                                                    </tr>
                                                </table>
                                                <table class="" style="width: 100%;text-align: left;">
                                      
                                                        <?php $num = 1;
                                                        foreach ($username_menu_ID as $rw) { ?> 
                                                            <tr>
                                                                <td style="width: 49.5%;">
                                                                    <div class="form-check">
                                                                        <label class="form-check-label">
                                                                            <input type="checkbox" class="form-check-input" name="num[]" value="<?php echo $rw->ID ?>" 
                                                                                <?php foreach ($menu_view as $mn) {
                                                                                       if ($mn->id_menu == $rw->ID) {
                                                                                           echo "checked";
                                                                                       }
                                                                                   } ?>  
                                                                                <?php echo"<br>" ." &nbsp; &nbsp; &nbsp; ". iconv('tis-620', 'utf-8', $rw->Subject); ?>  
                                                                        </label>
                                                                    </div>

                                                                </td>
                                                            <td style="width: 0.2%;background: black;"></td>
                                                                <?php if (iconv('tis-620', 'utf-8', $rw->Subject) == "โหลดข้อมูล Payment") { ?>
                                                                <td style="width: 49.5%;padding-left: 15px;">
                                                                    <div class="radio">
                                                                        <span><b> โหล Payment ข้ามเดือน : </b></span>
                                                                        <label><input type="radio" name="chkPeriod" value="1" <?php if ($row->chkPeriod == '1') { echo "checked";} ?>> ได้</label>
                                                                        <label><input type="radio" name="chkPeriod" value="0" <?php if ($row->chkPeriod == '0') {echo "checked";} ?>> ไม่ได้</label>
                                                                    </div>
                                                                </td>
                                                            <?php } ?>
                                                        </tr>
                                                <?php $num++;  } ?>
  
                                                </table>
                                            </div>
                                            <hr>
                                            <footer style="text-align: right;" class="w3-container">
                                                <button type="submit" class="btn btn-success">Save</button>
                                                <a href="<?php echo site_url('Payment_controller/setting_index'); ?>"><button type="button" class="btn btn-danger">Black</button></a>
                                            </footer>
                                        </form>
                                        <?php } ?>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>             
            </div>
        </div>    
        
        


    </body>

<!--    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>-->

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
</html>

<!--<script type='text/javascript'>
    function check_password() {

        var elm = document.getElementById('Password');

        var len = elm.value.length;

        var regex1 = /^[A-Z]*$/;

        var val = elm.value;
        if (len == 8) {
            var num = val[1] + val[2] + val[3] + val[4] + val[5]+ val[6]+ val[7];
            if (val[0].match(regex1) && !isNaN(num)) {

            } else {
                alert("กรูณากรอกรหัสให้ตรงตามรูปแบบ ตัวใหญ่ ตามด้วยตัวเลข ไม่เกิน 8 ตัว เช่น A123456 ");
                elm.value = "";
            }
        }
    }
</script>-->



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

