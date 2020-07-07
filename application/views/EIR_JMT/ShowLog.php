<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SHOW LOG</title>
    <!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="<?php echo base_url();?>assets/ShowLog/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/ShowLog/vendor/bootstrap/css/bootstrap.min.css"> -->
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/ShowLog/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/ShowLog/vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/ShowLog/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/ShowLog/vendor/perfect-scrollbar/perfect-scrollbar.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/ShowLog/css/util.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/ShowLog/css/mainn.css">
    
<!--===============================================================================================-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script
            src="https://code.jquery.com/ui/1.9.2/jquery-ui.js"
            integrity="sha256-PsB+5ZEsBlDx9Fi/GXc1bZmC7wEQzZK4bM/VwNm1L6c="
            crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.9.1/themes/smoothness/jquery-ui.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url();?>/css/navbar-bar.css">
    <!-- <link rel="stylesheet" href="<?echo base_url()?>/css/styles.css"> -->

</head>
<body>
    <div class="loading" id="spinner"></div>
    <div class="limiter" style="margin-top:30px">
		<div class="container-table100">
			<div class="wrap-table100">
				
				<div class="table100 ver3 m-b-110">
					<div class="table100-head">
						<table>
							<thead>
								<tr class="row100 head">
									<th class="cell100 column1">Port</th>
									<th class="cell100 column2">MONTH_YEAR</th>
									<th class="cell100 column3">Cash_Add</th>
									<th class="cell100 column4">Cash_Before</th>
									<th class="cell100 column5">Cash_After</th>
									<th class="cell100 column6">Date_Update</th>
									<th class="cell100 column7">IDEmp</th>
									<th class="cell100 column8">NameEmp</th>
									<th class="cell100 column9">Log_Event</th>
								</tr>
							</thead>
						</table>
					</div>

					<div class="table100-body js-pscroll">
						<table>
							<tbody id="table-body">
								<tr class="row100 body">
									
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
<!--===============================================================================================-->	
<!-- <script src="<?php echo base_url();?>/ShowLog/vendor/jquery/jquery-3.2.1.min.js"></script> -->
<!--===============================================================================================-->
	<script src="<?php echo base_url();?>assets/ShowLog/vendor/bootstrap/js/popper.js"></script>
	<!-- <script src="<?php echo base_url();?>/ShowLog/vendor/bootstrap/js/bootstrap.min.js"></script> -->
<!--===============================================================================================-->
	<script src="<?php echo base_url();?>assets/ShowLog/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
    <script src="<?php echo base_url();?>assets/ShowLog/vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    
<script>
    getLog();
    function getLog() {
        document.getElementById("spinner").style.display = "block";
            $.ajax({
                type:"POST",
                url:"<?php echo site_url('Call_ShowLog/getShowLog');?>",
                })
                .done(function(json){
                    console.log(json);
                    var myObj = JSON.parse(json);
                    var result = myObj.result;
                    t = result.length;
                    makeTable(result);
                    document.getElementById("spinner").style.display = "none";
            });   
        
    }

    function makeTable(result){
        $('#table-body').find('tr').remove();
        for (var i in result) {
            $('#table-body').append(
                '<tr class="row100 body">\
                    <td class="cell100 column1">' + result[i].Port + '</td>\
                    <td class="cell100 column2">' + result[i].MONTH_YEAR + '</td>\
                    <td class="cell100 column3">' + numberTwoDecPoint(result[i].Cash_Add,true) + '</td>\
                    <td class="cell100 column4">' + numberTwoDecPoint(result[i].Cash_Before,true) + '</td>\
                    <td class="cell100 column5">' + numberTwoDecPoint(result[i].Cash_After,true) + '</td>\
                    <td class="cell100 column6">' + result[i].Date_Update + '</td>\
                    <td class="cell100 column7">' + result[i].IDEmp + '</td>\
                    <td class="cell100 column8">' + result[i].NameEmp + '</td>\
                    <td class="cell100 column9">' + result[i].Log_Event + '</td>\
                </tr>');
        }
    }

    $(function(){
                // this will get the full URL at the address bar
        var url = window.location.href;
        // passes on every "a" tag
        $("#header a").each(function() {
        // checks if its the same on the address bar
            if(url == (this.href)) {
                $(this).closest("li").addClass("active");
            }
        });
    });

    function numberTwoDecPoint(text, isCommas){
        
        
        number = text.split('.');
        if(isCommas){
            number[0] = numberWithCommas(number[0]);
        }
        number[1] = number[1].substring(0,3);


        
        number[1] = (number[1].charAt(1) == '9') && (number[1].charAt(2) == '9') ? 
            number[1].replace(number[1].charAt(0), (parseInt(number[1].charAt(0)) + 1).toString()) : 
            number[1] ;
        
        number[1] = (number[1].charAt(2) == '9') && (number[1].charAt(1) == '9') ? 
            number[1].replace(number[1].charAt(1),'0') : 
            number[1] ;
        

        number[1] = (number[1].charAt(2) == '9') && !(number[1].charAt(1) == '0') ? 
            number[1].replace(number[1].charAt(1), (parseInt(number[1].charAt(1)) + 1).toString()) : 
            number[1] ;
        

        number[1] = number[1].charAt(1) == '' ? 
            number[1]+'0' : 
            number[1] ;
        
        number[1] = (number[1].charAt(1) == '0') && (number[1].charAt(2) == '9') && (number[1].charAt(1) != '0')  ? 
            number[1].replace(number[1].charAt(1), (parseInt(number[1].charAt(1)) + 1).toString()) : 
            number[1] ;
        

        number[1] = (number[1].charAt(1) == '0') && (number[1].charAt(2) == '9') && (number[1].charAt(0) == '0')  ? 
            '01' : 
            number[1] ;
        

        // number[1] = (number[1].charAt(1) == '0') && (number[1].charAt(2) == '9') && (number[1].charAt(0) != '0')  ? 
        //     number[1].replace(number[1].charAt(1),'1') : 
        //     number[1] ;
        // 

        
       
        number[1] = number[1].substring(0,2);
        if(number[1] != "0"){
            return number[0]+"."+number[1];
        }else {
            return number[0]+"."+number[1]+"0";
        }
    }

    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    $('.js-pscroll').each(function(){
			var ps = new PerfectScrollbar(this);

			$(window).on('resize', function(){
				ps.update();
			})
	});

</script>