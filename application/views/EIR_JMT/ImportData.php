<html>
	<head>
		<meta http-equiv="content-type"  charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>IMPORT DATA</title>

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
        <link rel="stylesheet" href="<?echo base_url()?>/css/styles.css">
        <link rel="stylesheet" href="<?php echo base_url();?>/css/navbar-bar.css">
        <style>
            a:hover{
                text-decoration: none;
                color:firebrick;
            }
            a.disabled {
                pointer-events: none;
                cursor: default;
            }
        </style>

	</head>
    <body>
        <div class="loading" id="spinner"></div>
            <div class="container text-center" style="margin-top:90px;margin-left:300px;">
                <div style="display:inline-flex;margin-left:-200px;">
                    <div style="margin-top:7px">เลือกไฟล์ที่ต้องการ Import :&nbsp; </div>
                    <input type="file" name="" id="fileUpload" class="form-control" style="width:250px;" onchange="check_valid_data(this)">
                </div>
                <div class="row" style="margin-bottom:-90px;" id="att_table">
                    <div id="error" class="error-text"></div>
                    <!-- <div class="col-md-2">
                        <div style="margin-top:15px;margin-bottom:-20px;margin-left: 190px;width: max-content;">
                            วันที่รับเงิน
                        </div>
                    </div> -->
                    <div class="col-md-2">
                       <input 
                            autocomplete="off" 
                            type="text"  
                            class="form-control" 
                            id="datepicker" 
                            placeholder="เดือน/ปี" 
                            style="margin-top:15px;margin-bottom:-20px;margin-left: 190px;" 
                        />
                    </div>
                    <div class="col-md-1">
                        <button 
                            class="btn btn-primary" 
                            id="BtnImport" 
                            onclick="import_data()" 
                            style="margin-top:15px;margin-bottom:-20px;margin-left:185px;" 
                            disabled
                        >Import</button>
                    </div>
                    <!-- <div class="col-md-1">
                        <button class="btn btn-danger" id="BtnDelete" onclick="clear_data()" disabled>Delete All</button>
                    </div> -->
                    <div class="col-md-1">
                        <a 
                            href="<?echo site_url('Call_Excel/export_data_csv')?>" 
                            class="btn btn-success disabled" 
                            id="BtnExcel" 
                            style="margin-top:15px;margin-bottom:-20px;margin-left:250px;"
                        >Excel</a>
                    </div>
                    <div class="col-md-1">
                        <button 
                            class="btn btn-success" 
                            id="BtnAdd"
                            onclick="select_port('add')"
                            style="margin-top: 15px;margin-bottom:-20px;margin-left:79px;"
                            disabled
                        >Add</button>
                    </div>
                    <div class="col-md-2" >
                        <select name="data_select" 
                            style="margin-top:20px;margin-bottom:-100px;margin-left:335px" 
                            id="data_select" 
                            class="form-control" 
                            onchange="select_Data_Show()"
                        >
                            <option value="data_all">ข้อมูลทั้งหมด</option>
                            <option value="data_true">ข้อมูลถูกต้อง</option>
                            <option value="data_false">ข้อมูลไม่ถูกต้อง</option>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <select class ="form-control" id="maxRows" style="margin-top:20px;margin-bottom:-100px;margin-left:-35px">
                            <option value="5000" >Show ALL Rows</option>
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="15" >15</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                            <option value="70">70</option>
                            <option value="100">100</option>
                        </select>
			 		</div>
                     <div class="col-md-2">
                        <div class="total-col" id="total-col" style="margin-top:20px;margin-bottom:-100px;margin-left:-1033px"></div>
                    </div>
                </div>

                <div class="table-space tableFixHead" id="table">
                    <table class="table table-striped table-bordered " id="table-data">
                        <thead>
                            <tr>
                                <th class="text-center" width="1%">Number</th>
                                <th class="text-center" width="5%">Port</th>
                                <th class="text-center" width="5%">Cash</th>
                                <th class="text-center" width="5%">Date</th>
                                <th class="text-center" width="2%">State</th>
                                <th class="text-center" width="2%">Edit</th>
                                <th class="text-center" width="2%">Delete</th>
                            </tr>
                        </thead>
                        <tbody id="table-body" >
                        </tbody>
                    </table>
                </div>

            <!-- ////////////////////////////////////////////////////////////////// -->
                <div id="userModal_Edit" class="modal fade">
                    <div class="modal-dialog">
                        <form method="post" id="user_form_edit">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Edit</h4>
                                    <br />
                                    <div id="error_edit" style="color:red;"></div>
                                </div>
                                <div class="modal-body">
                                    <label>Number</label>
                                    <input type="text" name="number_edit" id="number_edit" class="form-control" readonly/>
                                    <br />
                                    <label>Enter Port</label>
                                    <select name="port_edit" id="port_edit" class="form-control">
                                        <option></option>
                                    </select>
                                    <br />
                                    <label>Enter Cash</label>
                                    <input type="text" name="cash_edit" id="cash_edit" class="form-control" onkeypress="javascript:return isNumber(event)" />
                                    <br />
                                </div>
                                <div class="modal-footer">
                                    <input type="submit" id="btn_edit" class="btn btn-success" value="Edit" />
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            <!-- ////////////////////////////////////////////////////////////////// -->
            <!-- ////////////////////////////////////////////////////////////////// -->
            <div id="userModal_Add" class="modal fade">
                    <div class="modal-dialog">
                        <form method="post" id="user_form_add">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Add</h4>
                                    <br />
                                </div>
                                <div class="modal-body">
                                    <label>Enter Port</label>
                                    <select name="port_add" id="port_add" class="form-control">
                                        <option selected> -- select port -- </option>
                                    </select>
                                    <br />
                                    <label>Enter Cash</label>
                                    <input type="text" name="cash_add" id="cash_add" class="form-control" onkeypress="javascript:return isNumber(event)" />
                                    <br />
                                </div>
                                <div class="modal-footer">
                                    <input type="submit" id="btn_add" class="btn btn-success" value="Add" />
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            <!-- ////////////////////////////////////////////////////////////////// -->
            <div class='pagination-container' >
				<nav style="margin-top: -45px;margin-right: 300px;">
				    <ul class="pagination">
                        <li data-page="prev" >
						    <span> < <span class="sr-only">(current)</span></span>
						</li>
				    <!--	Here the JS Function Will Add the Rows -->
                        <li data-page="next" id="prev">
						    <span> > <span class="sr-only">(current)</span></span>
						</li>
				    </ul>
				</nav>
            </div>
             <!-- ////////////////////////////////////////////////////////////////// -->
        </div>
	</body>
</html>


<script>
    var t = 0;
    var text;
    var check = false; 
    // var tableShow = document.getElementById("table");
    // tableShow.style.display = 'none';        
    // var attrTable = document.getElementById("att_table");
    // attrTable.style.display = 'none';
    // var attrImport = document.getElementById("att_import");
    // attrImport.style.display = 'none';

    function check_valid_data(fileinput) {
        var form_data = new FormData();
        form_data.append('file',$('#fileUpload')[0].files[0]);
        var file_upload = fileinput.value;
        if(file_upload == ''){
            alert('กรุณาเลือกไฟล์ก่อน');
        }else{
            document.getElementById("spinner").style.display = "block";
            $.ajax({
                cache: false,
                type:"POST",
                url:"<?php echo site_url('Call_Excel/check_import_data');?>",
                contentType: false,
                processData:false,
                data:form_data,
                }).done(function(json){
                    var myObj = JSON.parse(json);
                    var errorStatus = myObj[0].error_status;
                    if(errorStatus){
                        alert(myObj[0].error_msg);
                        clear_data();
                        document.getElementById("spinner").style.display = "none";
                        // document.getElementById("BtnDelete").disabled = true;
                    }else {
                        $.ajax({
                            type:"POST",
                            url:"<?php echo site_url('Call_Excel/select_data');?>"
                        })
                        .done(function(json){
                            var myObj1 = JSON.parse(json);
                            var result = myObj1.result;
                            t = result.length;
                            var errorStatus = myObj1.error_status;
                            if(errorStatus) {
                                document.getElementById("BtnImport").disabled = true;
                                document.getElementById("error").style.color = "red";
                                document.getElementById("error").innerHTML = "ข้อมูลทั้งหมดไม่ถูกต้อง";
                            }else{
                                document.getElementById("BtnImport").disabled = false;
                                document.getElementById("error").innerHTML = "ข้อมูลทั้งหมดถูกต้อง";
                                document.getElementById("error").style.color = "green";
                            }
                            document.getElementById("BtnAdd").disabled = false;
                            document.getElementById("BtnExcel").classList.remove("disabled");
                            document.getElementById("spinner").style.display = "none";
                            $('.pagination').hide();
                            makeTable(result);
                        });
                    }
            });
        }

    }

    function makeTable(result){
        // tableShow.style.display = 'block';
        // attrTable.style.display = 'block'; 
        // attrImport.style.display = 'block';
        var total_error = [];
        $('#table-body').find('tr').remove();
        for (var i in result) {
            if(result[i].Error != ""){
                total_error.push(result[i].Error);
            }
            $('#table-body').append(
                '<tr id="' + result[i].Number + '">\
                    <td style="padding:2px;text-align:right;vertical-align:middle;height:30px;" width="1%">' + result[i].Number + '</td>\
                    <td style="padding:2px;text-align:center;vertical-align:middle;height:30px;" width="5%">' + result[i].Port + '</td>\
                    <td style="padding:2px;text-align:right;vertical-align:middle;height:30px;" width="5%">' + numberWithCommas(result[i].Cash) + '</td>\
                    <td style="padding:2px;text-align:center;vertical-align:middle;height:30px;" class="setdate" width="5%"></td>\
                    <td style="padding:2px;text-align:center;vertical-align:middle;height:30px;" width="2%">\
                    ' + (result[i].Error != "" ?
                    ( '<a class="glyphicon glyphicon-remove icon-danger" id="error_title" data-toggle="tooltip" data-placement="top" title="'+ result[i].Error +'"></a>')
                    : ( '<div class="glyphicon glyphicon-ok icon-success"></div>' )) + '\
                    </td>\
                    <td width="1%" style="padding:2px;text-align:center;vertical-align:middle;height:30px;">\
                        <button\
                            class="btn btn-info"\
                            id="'+ result[i].Number +'"\ onclick="select_edit('+"'"+ result[i].Number  +"',\
                                '"+ result[i].Port  +"',\
                                '"+ result[i].Cash  +"',\
                                '"+ result[i].Error  +"'" +')"\
                        >Edit</button>\
                    <td width="1%" style="padding:2px;text-align:center;vertical-align:middle;height:30px;">\
                        <button\
                            class="btn btn-danger"\
                            id="'+ result[i].Number +'"\
                            onclick="delete_data('+"'"+ result[i].Number +"'" +')"\
                        >Delete</button>\
                </tr>');
        }

        document.getElementById("total-col").innerHTML = (check ? (text  + " "  + result.length) : "ข้อมูลทั้งหมด: " + t ) ;
        var date = document.getElementById("datepicker").value;
        if(date!=""){
            set_Date();
        }


    }

    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });

    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    function select_edit(num, port, cash,error){
        select_port('edit', port);
        document.getElementById('number_edit').value = num;
        document.getElementById('cash_edit').value = cash;
        document.getElementById('error_edit').innerHTML = error;

    }

    function select_port(btn, port=""){
        document.getElementById("spinner").style.display = "block";
        $.ajax({
        type:"POST",
        url:"<?php echo site_url('Call_Excel/select_port');?>",
        })
        .done(function(json){
            var myObj = JSON.parse(json);
            var result = myObj.result;
            makePort(result, btn ,port);
            if(btn == 'add' ){
                document.getElementById("spinner").style.display = "none";
                $('#userModal_Add').modal('show');
            }else {
                
                document.getElementById("spinner").style.display = "none";
                $('#userModal_Edit').modal('show');
               
            }

        });
    }

    function makePort(result, btn, port){
        var p = document.getElementById('port_edit');
        var check_selected = false;
        if(btn == 'add'){
            for (var i in result) {
                $('#port_add').append('<option value="'+ result[i].Port +'">'+ result[i].Port + '</option>');
            }
        }else {
            for (var i in result) {
                if(port == result[i].Port){
                    $('#port_edit').append('<option value="'+ result[i].Port +'" selected>'+ result[i].Port + '</option>');
                    check_selected = true;
                }else {
                    $('#port_edit').append('<option value="'+ result[i].Port +'">'+ result[i].Port + '</option>');
                }
            }
            if(!check_selected){
                p.firstElementChild.selected = true;
            } 
            
        }     
    }

    function clear_data() {
        document.getElementById("spinner").style.display = "block";
        $.ajax({
            type:"POST",
            url:"<?php echo site_url('Call_Excel/clear_data');?>"
        })
        .done(function(data){
            $.ajax({
                type:"POST",
                url:"<?php echo site_url('Call_Excel/');?>"
            })
            .done(function(data){
                document.getElementById('fileUpload').value = '';
                document.getElementById("error").innerHTML = '';
                document.getElementById("total-col").innerHTML = '';
                document.getElementById("table-body").innerHTML = '';
                document.getElementById("datepicker").value = '';
                document.getElementById("spinner").style.display = "none";
                document.getElementById("BtnImport").disabled = true;
                // document.getElementById("BtnDelete").disabled = true;
            });
        });
    }

    $(document).on('submit', '#user_form_edit', function(event){
        event.preventDefault();
        var data_select = document.getElementById("data_select").value;
        swal({
            title: "ต้องการเเก้ไขข้อมูลนี้หรือไม่",
            icon: "warning",
            buttons: true,
            dangerMode: false,
        })
        .then((willEdit) => {
            if (willEdit) {
                if(data_select == 'data_all') {
                    $.ajax({
                        type:"POST",
                        url:"<?php echo site_url('Call_Excel/edit_data');?>",
                        data:$("#user_form_edit").serialize(),
                    }).done(function(data){
                        $('#user_form_edit')[0].reset();
                        $('#userModal_Edit').modal('hide');
                        document.getElementById("spinner").style.display = "block";

                        $.ajax({
                        type:"POST",
                        url:"<?php echo site_url('Call_Excel/select_data');?>"
                        })
                        .done(function(json){
                            myObj = JSON.parse(json);
                            var result = myObj.result;
                            var errorStatus = myObj.error_status;
                            if(errorStatus) {
                                document.getElementById("BtnImport").disabled = true;
                                document.getElementById("error").style.color = "red";
                                document.getElementById("error").innerHTML = "ข้อมูลทั้งหมดไม่ถูกต้อง";
                            }else{
                                document.getElementById("BtnImport").disabled = false;
                                document.getElementById("error").innerHTML = "ข้อมูลทั้งหมดถูกต้อง";
                                document.getElementById("error").style.color = "green";
                            }
                            makeTable(result);
                            swal("เเก้ไขข้อมูลสำเร็จ", "", "success");
                            document.getElementById("spinner").style.display = "none";
                        });
                    });
                } else if(data_select == 'data_true') {
                    $.ajax({
                        type:"POST",
                        url:"<?php echo site_url('Call_Excel/edit_data');?>",
                        data:$("#user_form_edit").serialize(),
                    }).done(function(data){
                        $('#user_form_edit')[0].reset();
                        $('#userModal_Edit').modal('hide');
                        document.getElementById("spinner").style.display = "block";

                        $.ajax({
                        type:"POST",
                        url:"<?php echo site_url('Call_Excel/select_data_true');?>"
                        })
                        .done(function(json){
                            myObj = JSON.parse(json);
                            var result = myObj.result;
                            var errorStatus = myObj.error_status;
                            if(errorStatus) {
                                document.getElementById("BtnImport").disabled = true;
                                document.getElementById("error").style.color = "red";
                                document.getElementById("error").innerHTML = "ข้อมูลทั้งหมดไม่ถูกต้อง";
                            }else{
                                document.getElementById("BtnImport").disabled = false;
                                document.getElementById("error").innerHTML = "ข้อมูลทั้งหมดถูกต้อง";
                                document.getElementById("error").style.color = "green";
                            }
                            makeTable(result);
                            swal("เเก้ไขข้อมูลสำเร็จ", "", "success");
                            document.getElementById("spinner").style.display = "none";
                        });
                    });
                }
                else {
                    $.ajax({
                        type:"POST",
                        url:"<?php echo site_url('Call_Excel/edit_data');?>",
                        data:$("#user_form_edit").serialize(),
                    }).done(function(data){
                        $('#user_form_edit')[0].reset();
                        $('#userModal_Edit').modal('hide');
                        document.getElementById("spinner").style.display = "block";

                        $.ajax({
                        type:"POST",
                        url:"<?php echo site_url('Call_Excel/select_data_false');?>"
                        })
                        .done(function(json){
                            myObj = JSON.parse(json);
                            var result = myObj.result;
                            if(result != "") {
                                document.getElementById("BtnImport").disabled = true;
                                document.getElementById("error").style.color = "red";
                                document.getElementById("error").innerHTML = "ข้อมูลทั้งหมดไม่ถูกต้อง";
                            }else{
                                document.getElementById("BtnImport").disabled = false;
                                document.getElementById("error").innerHTML = "ข้อมูลทั้งหมดถูกต้อง";
                                document.getElementById("error").style.color = "green";
                            }
                            makeTable(result);
                            swal("เเก้ไขข้อมูลสำเร็จ", "", "success");
                            document.getElementById("spinner").style.display = "none";
                        });
                    });
                }
            }
        });
        
    });

    $(document).on('submit', '#user_form_add', function(event){
        event.preventDefault();
        var data_select = document.getElementById("data_select").value;
        var data = document.getElementById("table-body");
        var tr = data.getElementsByTagName("tr");
        var number = parseInt(tr[tr.length-1].id) + 1;
        console.log(number);
        if(confirm("ต้องการเพิ่มข้อมูลนี้หรือไม่")) {
            if(data_select == 'data_all') {
                $.ajax({
                    type:"POST",
                    url:"<?php echo site_url('Call_Excel/add_data');?>",
                    data:$("#user_form_add").serialize() +"&number="+ number,
                }).done(function(data){
                    $('#user_form_add')[0].reset();
                    $('#userModal_Add').modal('hide');
                    document.getElementById("spinner").style.display = "block";
                    $.ajax({
                    type:"POST",
                    url:"<?php echo site_url('Call_Excel/select_data');?>"
                    })
                    .done(function(json){
                        myObj = JSON.parse(json);
                        var result = myObj.result;
                        var errorStatus = myObj.error_status;
                        if(errorStatus) {
                            document.getElementById("BtnImport").disabled = true;
                            document.getElementById("error").style.color = "red";
                            document.getElementById("error").innerHTML = "ข้อมูลทั้งหมดไม่ถูกต้อง";
                        }else{
                            document.getElementById("BtnImport").disabled = false;
                            document.getElementById("error").innerHTML = "ข้อมูลทั้งหมดถูกต้อง";
                            document.getElementById("error").style.color = "green";
                        }
                        t++;
                        makeTable(result);
                        alert("เพิ่มข้อมูลสำเร็จ");
                        document.getElementById("spinner").style.display = "none";
                    });
                });
            }else if(data_select == 'data_true') {
                $.ajax({
                    type:"POST",
                    url:"<?php echo site_url('Call_Excel/add_data');?>",
                    data:$("#user_form_add").serialize() +"&number="+ (t+1),
                }).done(function(data){
                    $('#user_form_add')[0].reset();
                    $('#userModal_Add').modal('hide');
                    document.getElementById("spinner").style.display = "block";
                    $.ajax({
                    type:"POST",
                    url:"<?php echo site_url('Call_Excel/select_data_true');?>"
                    })
                    .done(function(json){
                        myObj = JSON.parse(json);
                        var result = myObj.result;
                        var errorStatus = myObj.error_status;
                        if(errorStatus) {
                            document.getElementById("BtnImport").disabled = true;
                            document.getElementById("error").style.color = "red";
                            document.getElementById("error").innerHTML = "ข้อมูลทั้งหมดไม่ถูกต้อง";
                        }else{
                            document.getElementById("BtnImport").disabled = false;
                            document.getElementById("error").innerHTML = "ข้อมูลทั้งหมดถูกต้อง";
                            document.getElementById("error").style.color = "green";
                        }
                        t++;
                        makeTable(result);
                        alert("เพิ่มข้อมูลสำเร็จ");
                        document.getElementById("spinner").style.display = "none";
                    });
                });
            } else {
                $.ajax({
                    type:"POST",
                    url:"<?php echo site_url('Call_Excel/add_data');?>",
                    data:$("#user_form_add").serialize() +"&number="+ (t+1),
                }).done(function(data){
                    $('#user_form_add')[0].reset();
                    $('#userModal_Add').modal('hide');
                    document.getElementById("spinner").style.display = "block";
                    $.ajax({
                    type:"POST",
                    url:"<?php echo site_url('Call_Excel/select_data_false');?>"
                    })
                    .done(function(json){
                        myObj = JSON.parse(json);
                        var result = myObj.result;
                        if(result != "") {
                            document.getElementById("BtnImport").disabled = true;
                            document.getElementById("error").style.color = "red";
                            document.getElementById("error").innerHTML = "ข้อมูลทั้งหมดไม่ถูกต้อง";
                        }else{
                            document.getElementById("BtnImport").disabled = false;
                            document.getElementById("error").innerHTML = "ข้อมูลทั้งหมดถูกต้อง";
                            document.getElementById("error").style.color = "green";
                        }
                        t++;
                        makeTable(result);
                        alert("เพิ่มข้อมูลสำเร็จ");
                        document.getElementById("spinner").style.display = "none";
                    });
                });
            }

        }else {
            alert("Bother Fields are Required");
        }
    });

   function import_data() {

        var date = document.getElementById("datepicker").value;
        if(date!=""){
            document.getElementById("spinner").style.display = "block";
            $.ajax({
            type:"POST",
            url:"<?php echo site_url('Call_Excel/insert_data');?>",
            })
            .done(function(data){
               clear_data();
               alert("Import Done!");
               document.getElementById("spinner").style.display = "none";

            });
        }else {
            swal("กรุณาเลือกวันที่รับเงิน", "", "warning");
        }


}

    $(function() {
        $('#datepicker').datepicker({
            changeYear: true,
            changeMonth: true,
            showButtonPanel: true,
            monthNames: [ "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม" ],
            monthNamesShort: [ "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค." ],
            dateFormat: 'dd/MM/yy',
            onClose: function(dateText, inst) {
                var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                var m = parseInt(month) + 1;
                month = m.toString();
                $(this).datepicker('setDate', new Date(year,month,0));
                set_Date();
            }
        });

        $("#datepicker").focus(function () {
            document.getElementById("ui-datepicker-div").style.zIndex="99";
            $(".ui-datepicker-calendar").hide();
        });

    });

    function set_Date(){

        var date = document.getElementById("datepicker").value;
        console.log(date);
        var res = date.split("/")
        switch(res[1]) {
            case "มกราคม":
                res[1] = "01";
                break;
            case "กุมภาพันธ์":
                res[1] = "02";
                break;
            case "มีนาคม":
                res[1] = "03";
                break;
            case "เมษายน":
                res[1] = "04";
                break;
            case "พฤษภาคม":
                res[1] = "05";
                break;
            case "มิถุนายน":
                res[1] = "06";
                break;
            case "กรกฎาคม":
                res[1] = "07";
                break;
            case "สิงหาคม":
                res[1] = "08";
                break;
            case "กันยายน":
                res[1] = "09";
                break;
            case "ตุลาคม":
                res[1] = "10";
                break;
            case "พฤศจิกายน":
                res[1] = "11";
                break;
            case "ธันวาคม":
                res[1] = "12";
                break;
        }
        var elements = document.getElementsByClassName("setdate");
        for(var i=0; i<elements.length; i++) {
            elements[i].innerHTML = res[0]+"/"+res[1]+"/"+res[2];
        }

        if(elements.length!=0){
            var date_import = convert_Date();
            document.getElementById("spinner").style.display = "block";
            $.ajax({
                type:"POST",
                url:"<?php echo site_url('Call_Excel/set_date');?>",
                data:{date:date_import},
                })
                .done(function(data){
                    document.getElementById("spinner").style.display = "none";
             });
        }


    }

    function convert_Date() {
        var str = document.getElementsByClassName("setdate")[0].innerHTML;
        var res = str.split("/");

        switch(res[1]) {
            case "มกราคม":
                res[1] = "01";
                break;
            case "กุมภาพันธ์":
                res[1] = "02";
                break;
            case "มีนาคม":
                res[1] = "03";
                break;
            case "เมษายน":
                res[1] = "04";
                break;
            case "พฤษภาคม":
                res[1] = "05";
                break;
            case "มิถุนายน":
                res[1] = "06";
                break;
            case "กรกฎาคม":
                res[1] = "07";
                break;
            case "สิงหาคม":
                res[1] = "08";
                break;
            case "กันยายน":
                res[1] = "09";
                break;
            case "ตุลาคม":
                res[1] = "10";
                break;
            case "พฤศจิกายน":
                res[1] = "11";
                break;
            case "ธันวาคม":
                res[1] = "12";
                break;
        }

        var date = res[2]+"-"+res[1]+"-"+res[0];
        return date;
    }

    function select_Data_Show() {
        var option_data = document.getElementById("data_select").value;
        document.getElementById("spinner").style.display = "block";
        if(option_data == 'data_all'){
            check = false;
            $.ajax({
                type:"POST",
                url:"<?php echo site_url('Call_Excel/select_data');?>",
                })
                .done(function(json){
                    var myObj = JSON.parse(json);
                    var result = myObj.result;
                    var errorStatus = myObj.error_status;
                    if(errorStatus) {
                            document.getElementById("BtnImport").disabled = true;
                            document.getElementById("error").style.color = "red";
                            document.getElementById("error").innerHTML = "ข้อมูลทั้งหมดไม่ถูกต้อง";
                    }else{
                            document.getElementById("BtnImport").disabled = false;
                            document.getElementById("error").innerHTML = "ข้อมูลทั้งหมดถูกต้อง";
                            document.getElementById("error").style.color = "green";
                    }
                    // document.getElementById("BtnDelete").disabled = false;
                    document.getElementById("spinner").style.display = "none";
                    document.getElementById("total-col").style.color = "black";
                    makeTable(result);
             });
        }else if(option_data == 'data_true') {
            text='ข้อมูลที่ถูกต้อง: ';
            check = true;
            $.ajax({
                type:"POST",
                url:"<?php echo site_url('Call_Excel/select_data_true');?>",
                })
                .done(function(json){
                    var myObj_true = JSON.parse(json);
                        var result = myObj_true.result;
                        var errorStatus = myObj_true.error_status;
                        if(errorStatus) {
                            document.getElementById("BtnImport").disabled = true;
                            document.getElementById("error").style.color = "red";
                            document.getElementById("error").innerHTML = "ข้อมูลทั้งหมดไม่ถูกต้อง";
                        }else{
                            document.getElementById("BtnImport").disabled = false;
                            document.getElementById("error").innerHTML = "ข้อมูลทั้งหมดถูกต้อง";
                            document.getElementById("error").style.color = "green";
                        }
                        // document.getElementById("BtnDelete").disabled = false;
                        document.getElementById("spinner").style.display = "none";
                        document.getElementById("total-col").style.color = "green";
                        makeTable(result);
             });
        }else if(option_data == 'data_false') {
            text='ข้อมูลที่ไม่ถูกต้อง: ';
            check = true;
            $.ajax({
                type:"POST",
                url:"<?php echo site_url('Call_Excel/select_data_false');?>",
                })
                .done(function(json){
                    var myObj_false = JSON.parse(json);
                        var result = myObj_false.result;
                        if(result != "") {
                            document.getElementById("BtnImport").disabled = true;
                            document.getElementById("error").style.color = "red";
                            document.getElementById("error").innerHTML = "ข้อมูลทั้งหมดไม่ถูกต้อง";
                        }else{
                            document.getElementById("BtnImport").disabled = false;
                            document.getElementById("error").innerHTML = "ข้อมูลทั้งหมดถูกต้อง";
                            document.getElementById("error").style.color = "green";
                        }
                        // document.getElementById("BtnDelete").disabled = false;
                        document.getElementById("spinner").style.display = "none";
                        document.getElementById("total-col").style.color = "red";
                        makeTable(result);
             });

        }
    }


    function delete_data(number) {
        var data_select = document.getElementById("data_select").value;
        swal({
            title: "ต้องการลบข้อมูลนี้หรือไม่",
            icon: "warning",
            buttons: true,
            dangerMode: false,
        })
        .then((willEdit) => {
            if (willEdit) {
                document.getElementById("spinner").style.display = "block";
                if(data_select == 'data_all'){
                    $.ajax({
                    type:"POST",
                    url:"<?php echo site_url('Call_Excel/delete_data');?>",
                    data:{number:number}
                    })
                    .done(function(data){
                        $.ajax({
                            type:"POST",
                            url:"<?php echo site_url('Call_Excel/select_data');?>"
                        })
                        .done(function(json){
                            myObj = JSON.parse(json);
                            var result = myObj.result;
                            var errorStatus = myObj.error_status;
                            if(errorStatus) {
                                document.getElementById("BtnImport").disabled = true;
                                document.getElementById("error").style.color = "red";
                                document.getElementById("error").innerHTML = "ข้อมูลทั้งหมดไม่ถูกต้อง";
                            }else{
                                document.getElementById("BtnImport").disabled = false;
                                document.getElementById("error").innerHTML = "ข้อมูลทั้งหมดถูกต้อง";
                                document.getElementById("error").style.color = "green";
                            }
                            t--;
                            makeTable(result);
                            swal("ลบข้อมูลสำเร็จ", "", "success");
                            document.getElementById("spinner").style.display = "none";
                        });
                    });
                }else if (data_select == 'data_true') {
                    $.ajax({
                    type:"POST",
                    url:"<?php echo site_url('Call_Excel/delete_data');?>",
                    data:{number:number}
                    })
                    .done(function(data){
                        $.ajax({
                            type:"POST",
                            url:"<?php echo site_url('Call_Excel/select_data_true');?>"
                        })
                        .done(function(json){
                            myObj = JSON.parse(json);
                            var result = myObj.result;
                            var errorStatus = myObj.error_status;
                            if(errorStatus) {
                                document.getElementById("BtnImport").disabled = true;
                                document.getElementById("error").style.color = "red";
                                document.getElementById("error").innerHTML = "ข้อมูลทั้งหมดไม่ถูกต้อง";
                            }else{
                                document.getElementById("BtnImport").disabled = false;
                                document.getElementById("error").innerHTML = "ข้อมูลทั้งหมดถูกต้อง";
                                document.getElementById("error").style.color = "green";
                            }
                            t--;
                            makeTable(result);
                            swal("ลบข้อมูลสำเร็จ", "", "success");
                            document.getElementById("spinner").style.display = "none";
                        });
                    });
                }else if(data_select == 'data_false') {
                    $.ajax({
                    type:"POST",
                    url:"<?php echo site_url('Call_Excel/delete_data');?>",
                    data:{number:number}
                    })
                    .done(function(data){
                        $.ajax({
                            type:"POST",
                            url:"<?php echo site_url('Call_Excel/select_data_false');?>"
                        })
                        .done(function(json){
                            myObj = JSON.parse(json);
                            var result = myObj.result;
                            if(result != "") {
                                document.getElementById("BtnImport").disabled = true;
                                document.getElementById("error").style.color = "red";
                                document.getElementById("error").innerHTML = "ข้อมูลทั้งหมดไม่ถูกต้อง";
                            }else{
                                document.getElementById("BtnImport").disabled = false;
                                document.getElementById("error").innerHTML = "ข้อมูลทั้งหมดถูกต้อง";
                                document.getElementById("error").style.color = "green";
                            }
                            t--;
                            makeTable(result);
                            swal("ลบข้อมูลสำเร็จ", "", "success");
                            document.getElementById("spinner").style.display = "none";
                        });
                    });
                }
            }
        });
    }

    getPagination('#table-data');


    function getPagination(table) {
        var lastPage = 1;
        $('#maxRows')
        .on('change', function(evt) {
        //$('.paginationprev').html('');						// reset pagination
            lastPage = 1;
            $('.pagination')
                .find('li')
                .slice(1, -1)
                .remove();
            var trnum = 0; // reset tr counter
            maxRows = parseInt($(this).val()); // get Max Rows from select option
            maxRows == 5 ?  document.getElementById("table").style.height = "253px" :  document.getElementById("table").style.height = "365px";
            if (maxRows == 5000) {
                $('.pagination').hide();
            } else {
                $('.pagination').show();
            }

            var totalRows = $(table + ' tbody tr').length; // numbers of rows

            $(table + ' tr:gt(0)').each(function() {
                // each TR in  table and not the header
                trnum++; // Start Counter
                if (trnum > maxRows) {
                // if tr number gt maxRows
                    $(this).hide(); // fade it out
                }
                if (trnum <= maxRows) {
                    $(this).show();

                } // else fade in Important in case if it ..
            }); //  was fade out to fade it in

            if (totalRows > maxRows) {
                // if tr total rows gt max rows option
                var pagenum = Math.ceil(totalRows / maxRows); // ceil total(rows/maxrows) to get ..
                //	numbers of pages
                for (var i = 1; i <= pagenum; ) {
                // for each page append pagination li
                $('.pagination #prev')
                    .before(
                    '<li data-page="' +
                        i +
                        '">\
                        <span>' +
                        i++ +
                        '<span class="sr-only">(current)</span></span>\
                                     </li>'
                    )
                    .show();
                } // end for i
            } // end if row count > max rows
            else{
                $('.pagination').hide();
            } // end if row count < max rows

            $('.pagination [data-page="1"]').addClass('active'); // add active class to the first li
            $('.pagination li').on('click', function(evt) {
                // on click each page
                evt.stopImmediatePropagation();
                evt.preventDefault();
                var pageNum = $(this).attr('data-page'); // get it's number

                var maxRows = parseInt($('#maxRows').val()); // get Max Rows from select option

                if (pageNum == 'prev') {
                    if (lastPage == 1) {
                        return;
                    }
                    pageNum = --lastPage;
                }
                if (pageNum == 'next') {
                    if (lastPage == $('.pagination li').length - 2) {
                        return;
                    }
                    pageNum = ++lastPage;
                }

                lastPage = pageNum;
                var trIndex = 0; // reset tr counter
                $('.pagination li').removeClass('active'); // remove active class from all li
                $('.pagination [data-page="' + lastPage + '"]').addClass('active'); // add active class to the clicked
                // $(this).addClass('active');					// add active class to the clicked
                limitPagging();
                $(table + ' tr:gt(0)').each(function() {
                // each tr in table not the header
                trIndex++; // tr index counter
                // if tr index gt maxRows*pageNum or lt maxRows*pageNum-maxRows fade if out
                if (
                    trIndex > maxRows * pageNum ||
                    trIndex <= maxRows * pageNum - maxRows
                    ) {
                    $(this).hide();
                } else {
                    $(this).show();
                } //else fade in
            }); // end of for each tr in table
        }); // end of on click pagination list
        limitPagging();
        })
        .val(5000)
        .change();

    // end of on select change

    // END OF PAGINATION
    }

    function limitPagging(){
        //alert($('.pagination li').length)

        if($('.pagination li').length > 7 ){
                if( $('.pagination li.active').attr('data-page') <= 3 ){
                $('.pagination li:gt(5)').hide();
                $('.pagination li:lt(5)').show();
                $('.pagination [data-page="next"]').show();
            }if ($('.pagination li.active').attr('data-page') > 3){
                $('.pagination li:gt(0)').hide();
                $('.pagination [data-page="next"]').show();
                for( let i = ( parseInt($('.pagination li.active').attr('data-page'))  -2 )  ; i <= ( parseInt($('.pagination li.active').attr('data-page'))  + 2 ) ; i++ ){
                    $('.pagination [data-page="'+i+'"]').show();

                }

            }
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

    function isNumber(evt) {
        var iKeyCode = (evt.which) ? evt.which : evt.keyCode
        if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57)){
            alert("กรุณากรอกตัวเลข");
            return false;
		}
        return true;
    }    

</script>





