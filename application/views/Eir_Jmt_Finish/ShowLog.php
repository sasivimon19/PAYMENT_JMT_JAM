<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SHOW LOG</title>
    <!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="<?php echo base_url();?>assets/ShowLog/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	 <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/ShowLog/vendor/bootstrap/css/bootstrap.min.css"> 
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
     <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script
            src="https://code.jquery.com/ui/1.9.2/jquery-ui.js"
            integrity="sha256-PsB+5ZEsBlDx9Fi/GXc1bZmC7wEQzZK4bM/VwNm1L6c="
            crossorigin="anonymous">
    </script>
    
    <script 
        src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" 
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" 
        crossorigin="anonymous">
    </script>
    <link 
        rel="stylesheet" 
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" 
        crossorigin="anonymous"
    >
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.9.1/themes/smoothness/jquery-ui.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!--<link rel="stylesheet" href="<?php echo base_url();?>css/navbar.css">-->
    <!--<link rel="stylesheet" href="<?echo base_url()?>css/styles.css">-->
    <style>
        .loading {
            position: fixed;
            z-index: 999;
            overflow: show;
            margin: auto;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            width: 50px;
            height: 50px;
            display:none;
        }

        /* Transparent Overlay */
        .loading:before {
            content: '';
            display: block;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        /* :not(:required) hides these rules from IE9 and below */
        .loading:not(:required) {
        /* hide "loading..." text */
            font: 0/0 a;
            color: transparent;
            text-shadow: none;
            background-color: transparent;
            border: 0;
        }

        .loading:not(:required):after {
            content: '';
            display: block;
            font-size: 10px;
            width: 150px;
            height: 150px;
            margin-top: -0.5em;

            border: 15px solid black;
            border-radius: 100%;
            border-bottom-color: transparent;
            -webkit-animation: spinner 1s linear 0s infinite;
            animation: spinner 1s linear 0s infinite;


        }

        /* Animation */

        @-webkit-keyframes spinner {
        0% {
            -webkit-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -ms-transform: rotate(0deg);
            -o-transform: rotate(0deg);
            transform: rotate(0deg);
        }
        100% {
            -webkit-transform: rotate(360deg);
            -moz-transform: rotate(360deg);
            -ms-transform: rotate(360deg);
            -o-transform: rotate(360deg);
            transform: rotate(360deg);
        }
        }
        @-moz-keyframes spinner {
        0% {
            -webkit-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -ms-transform: rotate(0deg);
            -o-transform: rotate(0deg);
            transform: rotate(0deg);
        }
        100% {
            -webkit-transform: rotate(360deg);
            -moz-transform: rotate(360deg);
            -ms-transform: rotate(360deg);
            -o-transform: rotate(360deg);
            transform: rotate(360deg);
        }
        }
        @-o-keyframes spinner {
        0% {
            -webkit-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -ms-transform: rotate(0deg);
            -o-transform: rotate(0deg);
            transform: rotate(0deg);
        }
        100% {
            -webkit-transform: rotate(360deg);
            -moz-transform: rotate(360deg);
            -ms-transform: rotate(360deg);
            -o-transform: rotate(360deg);
            transform: rotate(360deg);
        }
        }
        @keyframes spinner {
        0% {
            -webkit-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -ms-transform: rotate(0deg);
            -o-transform: rotate(0deg);
            transform: rotate(0deg);
        }
        100% {
            -webkit-transform: rotate(360deg);
            -moz-transform: rotate(360deg);
            -ms-transform: rotate(360deg);
            -o-transform: rotate(360deg);
            transform: rotate(360deg);
        }
        }
    </style>

</head>
<body>
    
    <div class="loading" id="spinner"></div>
    
    
    <div class="limiter" style="margin-top:30px">

        <div id="main">
            <div class="wrapper">
                <div class="content-wrapper">
                    <section class="content" style=" padding-top:2%;">
                        <div class="container-fluid">
                            <div class="card card-secondary">
                                <div class="card-header" style="background-color: #c3000d;">
                                    <h3 class="card-title"> <b>LOG IMPOST</b> </h3>
                                </div>
                                
                                <div class="card-body">  
                                    
                                    <div class="box-ShowLog">
                                        <div class="d-flex flex-row">
                                            <div class="col-4 d-flex flex-row justify-content-center" >
                                                <select id="portSelect" style="width:100%">
                                                    <option value="allPort">กรุณาเลือกพอร์ตที่ต้องการค้นหา</option>
                                                </select>
                                            </div>
                                            <div class="col-3 d-flex flex-row justify-content-center">
                                                <input 
                                                    autocomplete="off" 
                                                    type="text"  
                                                    class="form-control" 
                                                    id="datepicker_start" 
                                                    placeholder="กรุณาเลือกวันเริ่มต้น"
                                                    />
                                            </div>
                                            <div class="col-3 d-flex flex-row justify-content-center">
                                                <input 
                                                    autocomplete="off" 
                                                    type="text"  
                                                    class="form-control" 
                                                    id="datepicker_end" 
                                                    placeholder="กรุณาเลือกวันสิ้นสุด"
                                                    />
                                            </div>
                                            <div class="col-1 d-flex flex-row justify-content-start">
                                                <button class="btn btn-success" onclick="searchLog()">Search</button>
                                            </div>
                                            <div class="col-1 d-flex flex-row justify-content-center">
                                                <button class="btn btn-success" id="BtnExcel" onclick="export_data_csv()" disabled>Excel</button>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="container-table100"  style=" margin-top: -10%;">
                                        <div class="wrap-table100">
                                            <div class="table100 ver3 m-b-110">

                                                <div class="table100-head">
                                                    <div class="card-body table-responsive p-0" >
                                                        <table class="table table-hover" id="myTable">
                                                            <thead  style="background-color: gray;">
                                                                <tr class="row100 head">
                                                                    <th class="cell100 column1">Port</th>
                                                                    <th class="cell100 column2">MONTH_YEAR</th>
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

                                </div>
                            </div>

                    </section>
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
    var dateStart_Log;
    var dateEnd_Log;
    var Port_Log;
    select_port();
    //getLog();

    function getLog() {
        document.getElementById("spinner").style.display = "block";
            $.ajax({
                type:"POST",
                url:"<?php echo site_url('Call_ShowLog/getShowLog');?>",
                })
            .done(function(json){
                var myObj = JSON.parse(json);
                var result = myObj.result;
                t = result.length;
                makeTable(result);
                $.ajax({
                    type:"POST",
                    url:"<?php echo site_url('Call_Import/select_port');?>",
                })
                .done(function(json){
                    var myObj = JSON.parse(json);
                    var result = myObj.result;
                    for (var i in result) {
                        $('#portSelect').append('<option value="'+ result[i].Port +'">'+ result[i].Port + '</option>');
                    }
                });
                
                document.getElementById("spinner").style.display = "none";
            });   
        
    }

    function select_port(){
        document.getElementById("spinner").style.display = "block";
        $.ajax({
            type:"POST",
            url:"<?php echo site_url('Call_Import/select_port');?>",
        })
        .done(function(json){
            var myObj = JSON.parse(json);
            var result = myObj.result;
            for (var i in result) {
                $('#portSelect').append('<option value="'+ result[i].Port +'">'+ result[i].Port + '</option>');
            }
        }); 
        document.getElementById("spinner").style.display = "none";
        
    }

    function convert_Date(typeDate) {
        if(typeDate == 'dateStart'){
            var str = document.getElementById("datepicker_start").value;
            var res = str.split("/");
            var date = res[2]+"-"+res[1]+"-"+res[0];
            return date;
        }else if(typeDate == 'dateEnd'){
            var str = document.getElementById("datepicker_end").value;
            var res = str.split("/");
            var date = res[2]+"-"+res[1]+"-"+res[0];
            return date;
        }
        
    }

    function searchLog(){
        var port = document.getElementById("portSelect").value;
        var date_start = document.getElementById("datepicker_start").value;
        var date_end = document.getElementById("datepicker_end").value;
       
        Port_Log = port != 'allPort' ? Port_Log = port : Port_Log = "";
        dateStart_Log = date_start != '' ? dateStart_Log = convert_Date('dateStart') : dateStart_Log = '';
        dateEnd_Log = date_end != '' ? dateEnd_Log = convert_Date('dateEnd') : dateEnd_Log = '';

        if(date_start > date_end){
            swal("กรุณาวันที่สิ้นสุดใหม่", "", "warning");
        }
        
        document.getElementById("spinner").style.display = "block";
        if(port == 'allPort'){
            if(date_start != '' && date_end != '' ) {
                $.ajax({
                    type:"POST",
                    url:"<?php echo site_url('Call_ShowLog/search_ShowLog');?>",
                    data:{date_start:dateStart_Log, date_end:dateEnd_Log}
                    })
                    .done(function(json){
                        var myObj = JSON.parse(json);
                        var result = myObj.result;
                        t = result.length;
                        makeTable(result);
                        document.getElementById("BtnExcel").disabled = false;
                        document.getElementById("spinner").style.display = "none";

                });   
            } else {
                swal("กรุณาวันที่หรือพอร์ตที่ต้องการค้นหา", "", "warning");
                document.getElementById("spinner").style.display = "none";

            }
        }else {
            if(date_start != '' && date_end != '') {
                $.ajax({
                    type:"POST",
                    url:"<?php echo site_url('Call_ShowLog/search_ShowLog');?>",
                    data:{date_start:dateStart_Log, date_end:dateEnd_Log,port:port}
                    })
                    .done(function(json){
                        var myObj = JSON.parse(json);
                        var result = myObj.result;
                        t = result.length;
                        makeTable(result);
                        document.getElementById("BtnExcel").disabled = false;
                        document.getElementById("spinner").style.display = "none";
                });   
            } else {
                $.ajax({
                    type:"POST",
                    url:"<?php echo site_url('Call_ShowLog/search_ShowLog');?>",
                    data:{port:port}
                    })
                    .done(function(json){
                        var myObj = JSON.parse(json);
                        var result = myObj.result;
                        t = result.length;
                        makeTable(result);
                        document.getElementById("BtnExcel").disabled = false;
                        document.getElementById("spinner").style.display = "none";

                });   

            }

        }
    }
    
    function makeTable(result){
        $('#table-body').find('tr').remove();
        for (var i in result) {
            $('#table-body').append(
                '<tr class="row100 body">\
                    <td class="cell100 column1">' + result[i].Port + '</td>\
                    <td class="cell100 column2">' + result[i].MONTH_YEAR + '</td>\
                    <td class="cell100 column4">' + numberTwoDecPoint(result[i].Cash_Before,true) + '</td>\
                    <td class="cell100 column5">' + numberTwoDecPoint(result[i].Cash_After,true) + '</td>\
                    <td class="cell100 column6">' + result[i].Date_Update + '</td>\
                    <td class="cell100 column7">' + result[i].IDEmp + '</td>\
                    <td class="cell100 column8">' + result[i].NameEmp + '</td>\
                    <td class="cell100 column9">' + result[i].Log_Event + '</td>\
                </tr>');
        }
    }

    function export_data_csv(){    
        window.location.href = "export_data_csv"+"?date_start="+ dateStart_Log + "&date_end="+ dateEnd_Log +"&port=" + Port_Log;
    }

    $(function() {
        $('#datepicker_start').datepicker({
            changeYear: true,
            changeMonth: true,
            monthNames: [ "01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12" ],
            monthNamesShort: [ "01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12" ],
            dateFormat: 'dd/MM/yy'
           
        });
        
    });
    
    $(function() {
        $('#datepicker_end').datepicker({
            changeYear: true,
            changeMonth: true,
            monthNames: [ "01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12" ],
            monthNamesShort: [ "01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12" ],
            dateFormat: 'dd/MM/yy'
           
        });
        
    });

    $(function(){
        var location = window.location.href;
        $(".navbar .nav-item .nav-link").removeClass('active');
        $(".navbar .nav-item a[href='"+location+"']").addClass('active');
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