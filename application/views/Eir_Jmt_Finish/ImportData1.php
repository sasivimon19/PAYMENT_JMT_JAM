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
        <link rel="stylesheet" href="<?php echo base_url();?>/css/navbar.css">
        <style>
            a:hover{
                text-decoration: none;
                color:firebrick;
            }
            a.disabled {
                pointer-events: none;
                cursor: not-allowed;
            }
            
            
            
        </style>

	</head>
    <body>
        <div class="loading" id="spinner"></div>
        <!-- <div style="margin-top:100px;text-align:center">Import รายได้</div> -->
        <div class="container text-center" style="margin-top:70px;margin-left:300px;">
            <div style="background-color: lightgrey;
                        width: 600px;
                        height:100px;
                        border: 5px solid black;
                        padding:30px;
                        margin-left:120px">
                <div style="display:inline-flex;">
                    <div style="margin-top:7px">เลือกไฟล์ที่ต้องการ Import :&nbsp; </div>
                    <input type="file" name="" id="fileUpload" class="form-control" style="width:250px;" onchange="check_valid_data(this)">
                </div>
            </div>
            <div class="row" style="margin-bottom:-90px;" id="att_table">
                <div id="error" class="error-text"></div>
                <div class="col-md-2">
                    <div class="total-col" id="total-col" style="margin-top:20px;margin-bottom:-100px;margin-left:-175px;"></div>
                </div>
                <div class="col-md-1">
                    <div style="margin-top:25px;margin-bottom:-20px;width:max-content;font-size:17px;margin-left: -198px;" >
									วันที่รับเงิน:
                    </div>
                </div>
                <div class="col-md-2">
                   <input
                        autocomplete="off"
                        type="text"
                        class="form-control"
                        id="datepicker"
                        placeholder="วันที่รับเงิน"
                        style="margin-top:20px;margin-bottom:-20px;margin-left:-215px;"
                        disabled
                    />
                </div>
                <div class="col-md-1" style="z-index:99">
                    <button
                        class="btn btn-primary"
                        id="BtnImport"
                        onclick="import_data()"
                        style="margin-top:20px;margin-bottom:-20px;margin-left: -400px;"
                        disabled
                    >Import</button>
                </div>
                <div class="col-md-1">
                    <button
                        class="btn btn-success"
                        id="BtnAdd"
                        onclick="add()"
                        style="margin-top:20px;margin-bottom:-20px;margin-left: -470px;"
                        disabled
                    >Add</button>
                </div>
                <div class="col-md-1">
                    <a
                        href="<?echo site_url('Call_Import/export_data_csv')?>"
                        class="btn btn-success disabled"
                        id="BtnExcel"
                        style="margin-top:20px;margin-bottom:-20px;margin-left: -545px;"
                    >Excel</a>
                </div>
                <div class="col-md-1">
                    <button
                        class="btn btn-danger"
                        id="BtnDeleteSelected"
                        onclick="delete_selected_data()"
                        style="margin-top:20px;margin-bottom:-20px;margin-left:-546px;"
                        disabled
                    >Delete Selected</button>
                </div>
                <div class="col-md-2" id="import_false">
                    <input type="checkbox" class="form-check-input" id="CheckAll" style="margin-top: 28px;margin-bottom:-20px;margin-left: -30px;">
                    <label class="form-check-label" for="CheckAll" style="margin-top: 4px;margin-bottom:-20px;margin-left: 80px;width: max-content;">&nbsp;&nbsp;อัพเดตทั้งหมด</label>
                </div>
                <div class="col-md-1" id="deleteAllPortError">
                    <button
                        class="btn btn-danger"
                        id="DeleteAllPE"
                        onclick="deleteAll_import_error()"
                        style="margin-top:20px;margin-bottom:-20px;margin-left: 35px;"
                    >Delete All</button>
                </div>
                <div class="col-md-1" id="deleteAllPortRecently">
                    <button
                        class="btn btn-warning"
                        id="DeleteAllPR"
                        onclick="deleteAll_import_recently()"
                        style="margin-top:20px;margin-bottom:-20px;margin-left: 35px;"
                    >Delete All</button>
                </div>
                <div class="form-group col-md-2">
                    <select class ="form-control" id="maxRows" style="margin-top:20px;margin-bottom:-100px;margin-left:-250px;" disabled> 
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
                    <select name="data_select"
                        style="margin-top:-15px;margin-bottom:-100px;margin-left: 770px;"
                        id="data_select"
                        class="form-control"
                        onchange="select_Data_Show()"
                        disabled
                    >
                        <option value="data_all">ข้อมูลทั้งหมด</option>
                        <option value="data_true">ข้อมูลถูกต้อง</option>
                        <option value="data_false">ข้อมูลไม่ถูกต้อง</option>
                    </select>
                </div>
            </div>
            <div class="table-space tableFixHead" id="table" style=" margin-top: 15%;">
                <table class="table table-bordered " id="table-data">
                    <thead>
                        <tr id="table-head">
                            <th class="text-center" width="1%" >#</th>
                            <th class="text-center" width="1%" >Number</th>
                            <th class="text-center" width="5%">Port</th>
                            <th class="text-center" width="5%">Cash</th>
                            <!-- -----------------------ADD--------------------------- -->
                            <th class="text-center" width="1%">Revoke</th>
                            <th class="text-center" width="1%">CourtFee</th>
                            <th class="text-center" width="1%">TransferFee</th>
                            <!-- -------------------------------------------------- -->
                            <th class="text-center" width="5%">Date</th>
                            <th class="text-center" width="1%">State</th>
                            <th class="text-center" width="1%">Edit</th>
                            <th class="text-center" width="1%">Delete</th>
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
                                </select>
                                <br />
                                <label>Enter Cash</label>
                                <input type="text" name="cash_edit" id="cash_edit" class="form-control" onkeypress="javascript:return isNumber(event)" />
                                <br />
                                <!-- ----------------------------------ADD------------------------------------------- -->
                                <label>Enter Revoke</label>
                                <input type="text" name="revoke_edit" id="revoke_edit" class="form-control" onkeypress="javascript:return isNumber(event)" />
                                <br />
                                <label>Enter CourtFee</label>
                                <input type="text" name="court_edit" id="court_edit" class="form-control" onkeypress="javascript:return isNumber(event)" />
                                <br />
                                <label>Enter TransferFee</label>
                                <input type="text" name="transfer_edit" id="transfer_edit" class="form-control" onkeypress="javascript:return isNumber(event)" />
                                <br />
                                <!-- ---------------------------------------------------------------------------------- -->
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
                                    </select>
                                    <br />
                                    <label>Enter Cash</label>
                                    <input type="text" name="cash_add" id="cash_add" class="form-control" onkeypress="javascript:return isNumber(event)" />
                                    <br />
                                    <!-- ----------------------------------ADD------------------------------------------- -->
                                    <label>Enter Revoke</label>
                                    <input type="text" name="revoke_add" id="revoke_add" class="form-control" onkeypress="javascript:return isNumber(event)" />
                                    <br />
                                    <label>Enter CourtFee</label>
                                    <input type="text" name="court_add" id="court_add" class="form-control" onkeypress="javascript:return isNumber(event)" />
                                    <br />
                                    <label>Enter TransferFee</label>
                                    <input type="text" name="transfer_add" id="transfer_add" class="form-control" onkeypress="javascript:return isNumber(event)" />
                                    <br />
                                    <!-- ---------------------------------------------------------------------------------- -->
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
    var t,countCheckedCheckboxes = 0;
    var text;
    var Imported = false;
    var check = false;
    var error_import = false;
    var tr_port_error = [];
    var loadPortEdit = false;
    var hasImported = false;
    var checkedAll = true;
    var CheckedArr = [];
    var DataTrue = [];
    var PortErr = [];
    var PortRecent = [];
    var TotalErr = [];
    var DeleteArr = [];
    const PortArr = [];
    var PORT_EDIT ;
    var loadAddPort = false;
    var loadEditPort = false;
    //----------------------------------------------------------------------------------//
    const options = {  year: 'numeric', month: 'numeric', day: 'numeric' };
    Month = new Date().getMonth()+1;
    Year = new Date().getFullYear();
    var date_start = new Date(Year,Month-1,1).toLocaleDateString('en-GB', options);
    
    var Res = date_start.split("/");
    date_start = Res[2]+"-"+Res[1]+"-"+Res[0];
   

    var date_end = new Date(Year,Month,0).toLocaleDateString('en-GB', options);
    
    var Res = date_end.split("/");
    date_end = Res[2]+"-"+Res[1]+"-"+Res[0];
    
    //----------------------------------------------------------------------------------//

    var att_table = document.getElementById("att_table");
    var importFalse = document.getElementById("import_false");
    var deleteAllPortError = document.getElementById("deleteAllPortError");
    var deleteAllPortRecently = document.getElementById("deleteAllPortRecently");
    att_table.style.marginBottom = '-90px';
    importFalse.style.display = 'none';
    deleteAllPortError.style.display = 'none';
    deleteAllPortRecently.style.display = 'none';

    getPagination('#table-data');



    function check_valid_data(fileinput) {
        var form_data = new FormData();
        form_data.append('file',$('#fileUpload')[0].files[0]);
        var file_upload = fileinput.value;
        if(file_upload == ''){
            swal("กรุณาเลือกไฟล์ก่อน", "", "warning");
        }else{
            document.getElementById("spinner").style.display = "block";
            $.ajax({
                cache: false,
                type:"POST",
                url:"<?php echo site_url('Call_Import/check_import_data');?>",
                contentType: false,
                processData:false,
                data:form_data,
                }).done(function(json){
                    var myObj = JSON.parse(json);
                    var errorStatus = myObj[0].error_status;
                    if(errorStatus){
                        swal(myObj[0].error_msg, "", "error");
                        clear_data();
                        document.getElementById("spinner").style.display = "none";
                    }else {
                        if(myObj[0].error_port){
                            swal(myObj[0].error_msg, "", "error");
                        }
                        $.ajax({
                            type:"POST",
                            url:"<?php echo site_url('Call_Import/select_data');?>",
                            data:{date_start:date_start,date_end:date_end}
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
                            document.getElementById("datepicker").disabled = false;
                            document.getElementById("BtnDeleteSelected").disabled = false;
                            document.getElementById("data_select").disabled = false;
                            document.getElementById("maxRows").disabled = false;
                            document.getElementById("BtnExcel").classList.remove("disabled");
                            document.getElementById("spinner").style.display = "none";
                            $('.pagination').hide();
                            select_port();
                            makeTable(result);
                        });
                    }
            });
        }

    }

    function makeTable(result,isImport=false){
            num = 1;
            $('#table-body').find('tr').remove();
            for (var i in result) {
                $('#table-body').append(
                    '<tr id="' + result[i].Number + '">\
                        <td style="padding:2px;text-align:center;vertical-align:middle;height:30px;" width="1%">\
                            <input type="checkbox" id="'+result[i].Number+'" onchange="SelectedTr('+"'"+ result[i].Number +"','"+ result[i].Port  +"'" +')">\
                        </td>\
                        <td style="padding:2px;text-align:right;vertical-align:middle;height:30px;" width="1%">' + num + '</td>\
                        <td style="padding:2px;text-align:center;vertical-align:middle;height:30px;" width="5%">' + result[i].Port + '</td>\
                        <td style="padding:2px;text-align:right;vertical-align:middle;height:30px;" width="5%">' +numberTwoDecPoint(result[i].Cash, true) + '</td>\
                        <td style="padding:2px;text-align:right;vertical-align:middle;height:30px;" width="1%">' + result[i].RevokeCustomer + '</td>\
                        <td style="padding:2px;text-align:right;vertical-align:middle;height:30px;" width="1%">' + result[i].CourtFee + '</td>\
                        <td style="padding:2px;text-align:right;vertical-align:middle;height:30px;" width="1%">' + result[i].TransferFee + '</td>\
                        <td style="padding:2px;text-align:center;vertical-align:middle;height:30px;" class="setdate" width="5%"></td>\
                        <td style="padding:2px;text-align:center;vertical-align:middle;height:30px;" width="1%">\
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
                                    '"+ result[i].RevokeCustomer  +"',\
                                    '"+ result[i].CourtFee  +"',\
                                    '"+ result[i].TransferFee  +"',\
                                    '"+ result[i].Error  +"'" +')"\
                            >Edit</button>\
                        <td width="1%" style="padding:2px;text-align:center;vertical-align:middle;height:30px;">\
                            <button\
                                class="btn btn-danger"\
                                id="'+ result[i].Number +'"\
                                onclick="delete_data('+"'"+ result[i].Number +"','"+ result[i].Port  +"'" +')"\
                            >Delete</button>\
                    </tr>');
                if(result[i].Error != ""){
                    TotalErr.push(result[i].Number);
                    TotalErr.sort();
                    var error = result[i].Error.split(" ");
                    if(error[1] == 'Portซ้ำ'){
                        document.getElementById(result[i].Number).bgColor = 'PeachPuff';    
                    }
                }
                num++;
            }
            document.getElementById("total-col").innerHTML = (check ? (text  + " "  + result.length) : "ข้อมูลทั้งหมด: " + t ) ;
            var date = document.getElementById("datepicker").value;
            if(date!=""){
                set_Date(isImport);
            }
        
    }

    function makeTableImportFalse(result){
        num = 1;
        $('#table-body').find('tr').remove();
        for (var i in result) {
            $('#table-body').append(
                '<tr id="' + result[i].Number + '">\
                    <td style="padding:2px;text-align:right;vertical-align:middle;height:30px;" width="1%">' + num + '</td>\
                    <td style="padding:2px;text-align:center;vertical-align:middle;height:30px;" width="5%">' + result[i].Port + '</td>\
                    <td style="padding:2px;text-align:right;vertical-align:middle;height:30px;" width="5%">' + numberWithCommas(result[i].Cash) + '</td>\
                    <td style="padding:2px;text-align:center;vertical-align:middle;height:30px;" class="setdate" width="5%"></td>\
                </tr>'); 
            num++;
        }
        document.getElementById("total-col").innerHTML = (check ? (text  + " "  + result.length) : "ข้อมูลทั้งหมด: " + t ) ;
        var date = document.getElementById("datepicker").value;
        $('#table-body').hide();
        if(date!=""){
            set_Date();
        }
    }

    function import_false() {
        document.getElementById("error").innerText = "อิมพอร์ตข้อมูลไม่สำเร็จ";
        document.getElementById("error").style.color = "red";
        document.getElementById("fileUpload").disabled = true;
        var x = document.getElementById("att_table");
        x.children[1].firstElementChild.style.marginLeft = "-155px";
        x.children[2].style.display = 'none';
        x.children[3].style.display = 'none';
        x.children[4].firstElementChild.style.marginLeft = "28px";
        x.children[5].style.display = 'none';
        x.children[6].style.display = 'none';
        x.children[7].style.display = 'none';
        document.getElementById("import_false").style.display = 'block';
        document.getElementById("deleteAllPortError").style.display = 'block';
        document.getElementById("deleteAllPortRecently").style.display = 'block';
        x.children[11].firstElementChild.style.marginLeft = "142px";
        x.children[12].style.display = 'none';
        
    }
    
    function SelectedTr(num,port) {
        const result = DeleteArr.filter(checked => checked.Number == num);
        const obj = {Number:num,Port:port}
        if(result.length == 0){
            DeleteArr.push(obj);
        }else {
            DeleteArr = DeleteArr.filter(function(value) { return value.Number != num });
        }
    
    }
    
    function updated_detail(cash_updated, date_updated) {
        swal({
            title:"ข้อมูลมีการอัพเดตไปเเล้วในเดือนนี้",
            text: "จำนวนเงินที่อัพเดตล่าสุด: " + cash_updated + "\n วันที่อัพเดต: " + date_updated.substring(0, 16) ,
        });
    }

    $("#CheckAll").change(function () {
        var table = document.getElementById("table-body");
        var tr = table.querySelectorAll("tr");
        if(this.checked){
            if(CheckedArr != []){
                CheckedArr = [];
            }
            for(x = 0; x <  tr.length; x++){
                if(!PortErr.includes(tr[x].childNodes[4].innerText)){
                    CheckedArr.push(tr[x].childNodes[4].innerText);   
                }
            }
        }else if(!this.checked){
            CheckedArr = [];
        }
        $('#table-body tr td:last-child input').not(this).prop('checked', this.checked);
        countCheckedCheckboxes =  $('#table-body tr td:last-child input[type="checkbox"]').filter(':checked').length;
        
    });

    function numberTwoDecPoint(text, isCommas){
        var hadChanged = false;
        if(isNaN(text)){
            return text;
        }else {
            number = text.split('.');
            if(isCommas){
                number[0] = numberWithCommas(number[0]);
            }
            if(number[1] == null){
                return number[0]+".00";
            }else {
                number[1] = number[1].substring(0,3);
            
                if((number[1].charAt(1) == '9') && (number[1].charAt(2) == '9')  ){
                    number[1] = number[1].replace(number[1].charAt(0), (parseInt(number[1].charAt(0)) + 1).toString());
                    hadChanged = true;
                }

            
                number[1] = (number[1].charAt(2) == '9') && (number[1].charAt(1) == '9') && !(number[1].charAt(0) == '9') && hadChanged ? 
                    number[1].replace(number[1].charAt(1),'0') : 
                    number[1] ;
                

                number[1] = (number[1].charAt(2) == '9') && (number[1].charAt(1) == '9') && (number[1].charAt(0) == '9') && hadChanged ? 
                number[1].charAt(0) + '0' + number[1].charAt(2) : 
                    number[1] ;
                

                number[1] = (number[1].charAt(2) == '9') && !(number[1].charAt(1) == '0') && !(number[1].charAt(1) == '9')  ? 
                    (number[1].charAt(0) == number[1].charAt(1) ? number[1].charAt(0) + (parseInt(number[1].charAt(1)) + 1).toString() + number[1].charAt(2) : 
                                                                number[1].replace(number[1].charAt(1), (parseInt(number[1].charAt(1)) + 1).toString()))      : 
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
                
                
                if(!hadChanged){
                    number[1] = (number[1].charAt(1) == '0') && (number[1].charAt(2) == '9') && (number[1].charAt(0) != '0')  ? 
                    number[1].replace(number[1].charAt(1),'1') : 
                    number[1] ;
                    
                }
            
                number[1] = number[1].substring(0,2);
                if(number[1] != "0"){
                    return number[0]+"."+number[1];
                }else {
                    return number[0]+"."+number[1]+"0";
                }
            }
            
        }
        
    }

    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });

    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    function select_edit(num, port, cash, revoke, court, transfer,error){
        var table = document.getElementById("table-body");
        var tr = table.querySelectorAll("tr");
        for(x = 0; x <  tr.length; x++){
            if(tr[x].childNodes[5].innerText == port){
                PORT_EDIT = tr[x];
            }  
        }
        makePort('edit' ,port);
        document.getElementById('number_edit').value = num;
        document.getElementById('cash_edit').value = cash;
        document.getElementById('revoke_edit').value = revoke;
        document.getElementById('court_edit').value = court;
        document.getElementById('transfer_edit').value = transfer;
        document.getElementById('error_edit').innerHTML = error;
        $('#userModal_Edit').modal('show');

    }

    function add(){
        makePort('add');
        $('#userModal_Add').modal('show');

    }

    function select_port(){
        $.ajax({
        type:"POST",
        url:"<?php echo site_url('Call_Import/select_port');?>",
        })
        .done(function(json){
            var myObj = JSON.parse(json);
            var result = myObj.result;
            for (var i in result) {
                PortArr.push(result[i].Port);
            }
        });
    }

    function makePort(btn, port=''){
        var p_edit = document.getElementById('port_edit');
        var p_add = document.getElementById('port_add');
        var check_selected = false;
        
        if(btn == 'add'){
            $('#port_add').find('option').remove();
            $('#port_add').append('<option value="selectPort" selected> -- select port -- </option>');
            for (var i = 0; i < PortArr.length; i++) {
                $('#port_add').append('<option value="'+ PortArr[i] +'">'+ PortArr[i] + '</option>');
            }
            p_add.firstElementChild.selected = true;
            
        }else {
            $('#port_edit').find('option').remove();
            $('#port_edit').append('<option disabled></option>');
            for (var i = 0; i < PortArr.length; i++) {
                if(port == PortArr[i]){
                    $('#port_edit').append('<option value="'+ PortArr[i] +'" selected>'+ PortArr[i] + '</option>');
                    check_selected = true;
                }else {
                    $('#port_edit').append('<option value="'+ PortArr[i] +'">'+ PortArr[i] + '</option>');
                }
                
            }
            if(!check_selected){
                p_edit.firstElementChild.selected = true;
            }
            

        }
    }

    function clear_data() {
        document.getElementById("spinner").style.display = "block";
        $.ajax({
            type:"POST",
            url:"<?php echo site_url('Call_Import/clear_data');?>"
        })
        .done(function(data){
            $.ajax({
                type:"POST",
                url:"<?php echo site_url('Call_Import/');?>"
            })
            .done(function(data){
                // var x = document.getElementById("att_table");
                // x.children[1].firstElementChild.style.display = 'block';
                // x.children[2].firstElementChild.style.display = 'block';
                // x.children[3].firstElementChild.style.marginLeft = "125px";
                // x.children[4].firstElementChild.style.display = 'block';
                // x.children[5].firstElementChild.style.display = 'block';
                // x.children[6].firstElementChild.style.display = 'block';
                // x.children[6].children[1].style.display = 'none';
                // x.children[6].children[2].style.display = 'none';
                // x.children[7].firstElementChild.style.marginLeft = "-130px"
                document.getElementById('fileUpload').value = '';
                document.getElementById("error").innerHTML = '';
                document.getElementById("total-col").innerHTML = '';
                document.getElementById("table-body").innerHTML = '';
                document.getElementById("datepicker").value = '';
                document.getElementById("spinner").style.display = "none";
                document.getElementById("BtnImport").disabled = true;
                hasImported = false;

                // document.getElementById("BtnDelete").disabled = true;
            });
        });
    }

    $(document).on('submit', '#user_form_edit', function(event){
        event.preventDefault();
        var cash = document.getElementById('cash_edit').value;
        var revoke = document.getElementById('revoke_edit').value;
        var court = document.getElementById('court_edit').value;
        var transfer = document.getElementById('transfer_edit').value;
        if(cash == ''){
            swal("กรุณากรอกจำนวนเงิน", "", "warning");
        }else if(isNaN(cash)){
            swal("กรุณากรอกจำนวนเงินเป็นตัวเลข", "", "warning");
        }else if(revoke == ''){
            swal("กรุณากรอก Revoke", "", "warning");
        }else if(isNaN(revoke)){
            swal("กรุณากรอก Revoke เป็นตัวเลข", "", "warning");
        }else if(court == ''){
            swal("กรุณากรอก CourtFee", "", "warning");
        }else if(isNaN(court)){
            swal("กรุณากรอก CourtFee เป็นตัวเลข", "", "warning");
        }else if(transfer == ''){
            swal("กรุณากรอก TransferFee", "", "warning");
        }else if(isNaN(transfer)){
            swal("กรุณากรอก TransferFee เป็นตัวเลข", "", "warning");
        }
        else {
            var hasPort = false;
            var countPort = 0;
            var port_edit = document.getElementById("port_edit");
            var table = document.getElementById("table-body");
            var tr = table.querySelectorAll("tr");
            
            for(x = 0; x <  tr.length; x++){
                if(tr[x].childNodes[5].innerText == port_edit.value && tr[x].id != PORT_EDIT.id ){
                   countPort++;
                }  
            }

            if(countPort >= 1){
                hasPort = true;
            }
            var data_select = document.getElementById("data_select").value;
            swal({
                title: "ต้องการเเก้ไขข้อมูลนี้หรือไม่",
                icon: "warning",
                buttons: true,
                dangerMode: false,
            })
            .then((willEdit) => {
                if (willEdit && !hasImported ) {
                    if(!hasPort){
                        if(data_select == 'data_all') {
                            $('#userModal_Edit').modal('hide');
                            document.getElementById("spinner").style.display = "block";
                            $.ajax({
                                type:"POST",
                                url:"<?php echo site_url('Call_Import/edit_data');?>",
                                data:$("#user_form_edit").serialize(),
                            }).done(function(data){
                                $('#user_form_edit')[0].reset();
                                $.ajax({
                                type:"POST",
                                url:"<?php echo site_url('Call_Import/select_data');?>",
                                data:{date_start:date_start,date_end:date_end}
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
                                    swal("เเก้ไขข้อมูลสำเร็จ", "", "success")
                                    document.getElementById("spinner").style.display = "none";
                                });
                            });
                        } else if(data_select == 'data_true') {
                            $('#userModal_Edit').modal('hide');
                            document.getElementById("spinner").style.display = "block";
                            $.ajax({
                                type:"POST",
                                url:"<?php echo site_url('Call_Import/edit_data');?>",
                                data:$("#user_form_edit").serialize(),
                            }).done(function(data){
                                $('#user_form_edit')[0].reset();
                                $.ajax({
                                type:"POST",
                                url:"<?php echo site_url('Call_Import/select_data_true');?>"

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
                            $('#userModal_Edit').modal('hide');
                            document.getElementById("spinner").style.display = "block";
                            $.ajax({
                                type:"POST",
                                url:"<?php echo site_url('Call_Import/edit_data');?>",
                                data:$("#user_form_edit").serialize(),
                            }).done(function(data){
                                $('#user_form_edit')[0].reset();
                                $.ajax({
                                type:"POST",
                                url:"<?php echo site_url('Call_Import/select_data_false');?>"
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
                    }else {
                        swal("ไม่สามารถเเก้ไขข้อมูลได้", "เนื่องจากมีพอร์ตนี้อยู่เเล้ว", "error");
                    }
                }
            });
        }
        

    });

    $(document).on('submit', '#user_form_add', function(event){
        event.preventDefault();
        var port = document.getElementById('port_add').value;
        var cash = document.getElementById('cash_add').value;
        var revoke = document.getElementById('revoke_add').value;
        var court = document.getElementById('court_add').value;
        var transfer = document.getElementById('transfer_add').value;
        if(port == 'selectPort' && cash == ''){
            swal("กรุณาเลือกพอร์ตเเละกรอกจำนวนเงิน", "", "warning");
        }else if(port == 'selectPort'){
            swal("กรุณาเลือกพอร์ต", "", "warning");
        }else if(cash == ''){
            swal("กรุณากรอกจำนวนเงิน", "", "warning");
        }else if(isNaN(cash)){
            swal("กรุณากรอกจำนวนเงินเป็นตัวเลข", "", "warning");
        }else if(revoke == ''){
            swal("กรุณากรอก Revoke", "", "warning");
        }else if(isNaN(revoke)){
            swal("กรุณากรอก Revoke เป็นตัวเลข", "", "warning");
        }else if(court == ''){
            swal("กรุณากรอก CourtFee", "", "warning");
        }else if(isNaN(court)){
            swal("กรุณากรอก CourtFee เป็นตัวเลข", "", "warning");
        }else if(transfer == ''){
            swal("กรุณากรอก TransferFee", "", "warning");
        }else if(isNaN(transfer)){
            swal("กรุณากรอก TransferFee เป็นตัวเลข", "", "warning");
        }
        else{
            var hasPort = false;
            var port_add = document.getElementById("port_add");
            var table = document.getElementById("table-body");
            var tr = table.querySelectorAll("tr");
            for(x = 0; x <  tr.length; x++){
                if(tr[x].childNodes[5].innerText == port_add.value){
                    hasPort = true;
                }
            }
            var data_select = document.getElementById("data_select").value;
            var number = parseInt(tr[tr.length-1].id) + 1;
            swal({
                title: "ต้องการเพิ่มข้อมูลนี้หรือไม่",
                buttons: true,
                dangerMode: false,
            })
            .then((willEdit) => {
                if (willEdit && !hasImported) {
                    if(!hasPort){
                        if(data_select == 'data_all') {
                            $.ajax({
                                type:"POST",
                                url:"<?php echo site_url('Call_Import/add_data');?>",
                                data:$("#user_form_add").serialize() +"&number="+ number,
                            }).done(function(data){
                                $('#user_form_add')[0].reset();
                                $('#userModal_Add').modal('hide');
                                document.getElementById("spinner").style.display = "block";
                                $.ajax({
                                type:"POST",
                                url:"<?php echo site_url('Call_Import/select_data');?>"
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
                                    swal("เพิ่มข้อมูลสำเร็จ", "", "success");
                                    document.getElementById("spinner").style.display = "none";
                                });
                            });
                        }else if(data_select == 'data_true') {
                            $.ajax({
                                type:"POST",
                                url:"<?php echo site_url('Call_Import/add_data');?>",
                                data:$("#user_form_add").serialize() +"&number="+ (t+1),
                            }).done(function(data){
                                $('#user_form_add')[0].reset();
                                $('#userModal_Add').modal('hide');
                                document.getElementById("spinner").style.display = "block";
                                $.ajax({
                                type:"POST",
                                url:"<?php echo site_url('Call_Import/select_data_true');?>"
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
                                    swal("เพิ่มข้อมูลสำเร็จ", "", "success");
                                    document.getElementById("spinner").style.display = "none";
                                });
                            });
                        } else {
                            $.ajax({
                                type:"POST",
                                url:"<?php echo site_url('Call_Import/add_data');?>",
                                data:$("#user_form_add").serialize() +"&number="+ (t+1),
                            }).done(function(data){
                                $('#user_form_add')[0].reset();
                                $('#userModal_Add').modal('hide');
                                document.getElementById("spinner").style.display = "block";
                                $.ajax({
                                type:"POST",
                                url:"<?php echo site_url('Call_Import/select_data_false');?>"
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
                                    swal("เพิ่มข้อมูลสำเร็จ", "", "success");
                                    document.getElementById("spinner").style.display = "none";
                                });
                            });
                        }
                    }else {
                        swal("ไม่สามารถเพิ่มข้อมูลได้", "เนื่องจากมีพอร์ตนี้อยู่เเล้ว", "error");
                    }

                }

            });
        }
        
    });

    function makeRecentlyUpdated(recent) {
        if(!hasImported){
            $('#table-head :first-child').remove();
            $('#table-head :last-child').remove();
            $('#table-head :last-child').remove();
            $('#table-head :last-child').remove();
            $('#table-head').append('<th class="text-center" width="20%">#</th>');
            $('#table-body tr td:first-child').remove();
            $('#table-body tr td:last-child').remove();
            $('#table-body tr td:last-child').remove();
            $('#table-body tr td:last-child').remove();
            $('#table-body').find('tr').append('<td></td>');
        }else{
            $('#table-body').find('tr').append('<td></td>');
        }
        
        var table = document.getElementById("table-body");
        var tr = table.querySelectorAll("tr");
        for (var i in recent) {
            for(x = 0; x <  tr.length; x++){
                if(recent[i].Port == tr[x].childNodes[4].innerText){
                    tr[x].bgColor = 'PeachPuff';
                    tr[x].lastElementChild.innerHTML = '<td>\
                                                            <button class="btn btn-warning"\ onclick="updated_detail('+"'"+ 
                                                            numberTwoDecPoint(recent[i].Recently_Cash, true)  +"',\
                                                                '"+ recent[i].Recently_Updated  +"'" +')"\
                                                            >View</button>\
                                                            <button class="btn btn-warning"\ onclick="delete_import_recently('+"'"+ 
                                                                recent[i].Port +"'" +')"\
                                                            >Delete</button>\
                                                            <input type="checkbox" class="form-check-input" id="C'+i+'" onclick="chekedImport('+"'"+ recent[i].Port +"'" +')"\
                                                            style="margin-left:20px;">\
                                                            <label class="form-check-label" for="C'+i+'"> ยืนยันที่จะทำการอัพเดต</label>\
                                                        </td>';
                    tr[x].lastElementChild.style.padding = "2px";                                    
                    tr[x].lastElementChild.style.textAlign = "left";                                    
                    tr[x].lastElementChild.style.verticalAlign = "middle";                                    
                    tr[x].lastElementChild.style.height = "30px";
                    PortRecent.push(recent[i].Port);
                                                   

                
                }
            }    
        }

    }

    function port_error(port) {
        var table = document.getElementById("table-body");
        var tr = table.querySelectorAll("tr");
        for (var i in port) {
            for(x = 0; x <  tr.length; x++)
            if(port[i].Port == tr[x].childNodes[4].innerText){
                tr[x].style.color = "red" ;
                tr[x].lastElementChild.innerHTML = '<td>\
                                                        <button class="btn btn-danger "\ onclick="delete_import_error('+"'"+ 
                                                            port[i].Port +"'" +')"\
                                                        >Delete</button>\
                                                        &nbsp;&nbsp;ไม่พบพอร์ต '+ port[i].Port +' ในระบบ\
                                                    </td>';    
                tr[x].lastElementChild.style.padding = "2px";                                                         
                tr[x].lastElementChild.style.textAlign = "left";                                    
                tr[x].lastElementChild.style.verticalAlign = "middle";                                    
                tr[x].lastElementChild.style.height = "30px";
                PortErr.push(port[i].Port);
                
            }
        }
        error_import = true;
    }

    function chekedImport(port) {
        const result = CheckedArr.filter(checked => checked == port);
        if(result.length == 0){
            CheckedArr.push(port);
        }else {
            CheckedArr = CheckedArr.filter(function(value) { return value != port });
        }
        CheckedArr.sort();
        countCheckedCheckboxes =  $('#table-body tr td:last-child input[type="checkbox"]').filter(':checked').length;
        var checkedall = document.getElementById("CheckAll").checked;
        if((CheckedArr.length == countCheckedCheckboxes) && CheckedArr.length == 5 && countCheckedCheckboxes == 5){ 
            $('#CheckAll').prop('checked', true);   
        }else {
            $('#CheckAll').prop('checked', false);
        }

        
    }

    function delete_import_error(port){
        swal({
            title: "ต้องการลบข้อมูลนี้หรือไม่",
            icon: "warning",
            buttons: true,
            dangerMode: false,
        })
        .then((willEdit) => {
            if (willEdit) {
                document.getElementById("spinner").style.display = "block";
                $.ajax({
                    type:"POST",
                    url:"<?php echo site_url('Call_Import/delete_import_error');?>",
                    data:{port:port}
                })
                .done(function(data){
                    deleteTrError(port);
                    var table = document.getElementById("table-body");
                    var tr = table.querySelectorAll("tr");
                    if(tr.length == 0) {
                        swal("ไม่มีข้อมูล", "", "warning").then(function() {
                                            document.getElementById("spinner").style.display = "block";
                                            setInterval(location.reload(), 1500);
                                        });
                        document.getElementById("spinner").style.display = "none";
                    }else {
                        for(z = 0; z <  tr.length; z++){
                            tr[z].childNodes[2].innerText = z+1;
                        }
                        document.getElementById("total-col").innerHTML = "ข้อมูลทั้งหมด: " + tr.length;
                        swal("ลบข้อมูลสำเร็จ", "", "success");
                        document.getElementById("spinner").style.display = "none";
                    }         
                });
            }
        });
    }

    function delete_import_recently(port){
        swal({
            title: "ต้องการลบข้อมูลนี้หรือไม่",
            icon: "warning",
            buttons: true,
            dangerMode: false,
        })
        .then((willEdit) => {
            if (willEdit) {
                document.getElementById("spinner").style.display = "block";
                $.ajax({
                    type:"POST",
                    url:"<?php echo site_url('Call_Import/delete_import_recently');?>",
                    data:{port:port}
                })
                .done(function(data){
                    deleteTrRecently(port);
                    var table = document.getElementById("table-body");
                    var tr = table.querySelectorAll("tr");
                    if(tr.length == 0) {
                        swal("ไม่มีข้อมูล", "", "warning").then(function() {
                                            document.getElementById("spinner").style.display = "block";
                                            setInterval(location.reload(), 1500);
                                        });
                        document.getElementById("spinner").style.display = "none";
                    }else {
                        for(z = 0; z <  tr.length; z++){
                            tr[z].childNodes[2].innerText = z+1;
                        }
                        document.getElementById("total-col").innerHTML = "ข้อมูลทั้งหมด: " + tr.length;
                        swal("ลบข้อมูลสำเร็จ", "", "success");
                        document.getElementById("spinner").style.display = "none";
                    }
                    
                            
                });
            }
        });
    }

    function deleteTrError(port){
        var table = document.getElementById("table-body");
        var tr = table.querySelectorAll("tr");
        for(x = 0; x <  tr.length; x++){
            if(port == tr[x].childNodes[4].innerText){
                tr[x].remove();    
            }
        }
        PortErr = PortErr.filter(function(value) { return value != port });
    }

    function deleteTrRecently(port){
        var table = document.getElementById("table-body");
        var tr = table.querySelectorAll("tr");
        for(x = 0; x <  tr.length; x++){
            if(port == tr[x].childNodes[4].innerText){
                tr[x].remove();    
            }
        }
        PortRecent = PortRecent.filter(function(value) { return value != port });
    }

    function deleteAllTrError(){
        var table = document.getElementById("table-body");
        var tr = table.querySelectorAll("tr");
        for(i = 0; i < PortErr.length; i++ ){
            for(x = 0; x <  tr.length; x++){
                if(PortErr[i] == tr[x].childNodes[4].innerText){
                    tr[x].remove();
                    PortErr = PortErr.filter(function(value) { return value != PortErr[i] });
                    
    
                }
            }
        }
    }
    
    function deleteAllTrRecent(){
        var table = document.getElementById("table-body");
        var tr = table.querySelectorAll("tr");
        for(i = 0; i < PortRecent.length; i++ ){
            for(x = 0; x <  tr.length; x++){
                if(PortRecent[i] == tr[x].childNodes[4].innerText){
                    tr[x].remove();
                    PortRecent = PortRecent.filter(function(value) { return value != PortRecent[i] });
                   
                }
            }
        }
        
    }

    function deleteAll_import_error() {
        swal({
            title: "ต้องการลบข้อมูลที่ไม่สามารถอิมพอร์ตได้ ออกทั้งหมดหรือไม่",
            icon: "warning",
            buttons: true,
            dangerMode: false,
        })
        .then((willEdit) => {
            if (willEdit) {
                    document.getElementById("spinner").style.display = "block";
                    $.ajax({
                        type:"POST",
                        url:"<?php echo site_url('Call_Import/deleteAll_import_error');?>",
                    })
                    .done(function(data){
                        deleteAllTrError();
                        var table = document.getElementById("table-body");
                        var tr = table.querySelectorAll("tr");
                        if(tr.length == 0) {
                            swal("ไม่มีข้อมูล", "", "warning").then(function() {
                                                document.getElementById("spinner").style.display = "block";
                                                setInterval(location.reload(), 1500);
                                            });
                            document.getElementById("spinner").style.display = "none";
                        }else {
                            for(z = 0; z <  tr.length; z++){
                                tr[z].childNodes[2].innerText = z+1;
                            }
                            document.getElementById("total-col").innerHTML = "ข้อมูลทั้งหมด: " + tr.length;
                            swal("ลบข้อมูลสำเร็จ", "", "success");
                            document.getElementById("DeleteAllPE").disabled = true;
                            document.getElementById("spinner").style.display = "none";
                        }
                    });    
                    
            }
        });
        
    }

    function deleteAll_import_recently() {
        swal({
            title: "ต้องการลบข้อมูลที่มีการอิมพอร์ตไปเเล้ว ออกทั้งหมดหรือไม่",
            icon: "warning",
            buttons: true,
            dangerMode: false,
        })
        .then((willEdit) => {
            if (willEdit) {
                document.getElementById("spinner").style.display = "block";
                $.ajax({
                    type:"POST",
                    url:"<?php echo site_url('Call_Import/deleteAll_import_recently');?>",
                })
                .done(function(data){
                    deleteAllTrRecent();
                    var table = document.getElementById("table-body");
                    var tr = table.querySelectorAll("tr");
                    if(tr.length == 0) {
                        swal("ไม่มีข้อมูล", "", "warning").then(function() {
                                            document.getElementById("spinner").style.display = "block";
                                            setInterval(location.reload(), 1500);
                                        });
                        document.getElementById("spinner").style.display = "none";
                    }else {
                        for(z = 0; z <  tr.length; z++){
                            tr[z].childNodes[2].innerText = z+1;
                        }
                        document.getElementById("total-col").innerHTML = "ข้อมูลทั้งหมด: " + tr.length;
                        swal("ลบข้อมูลสำเร็จ", "", "success");
                        document.getElementById("DeleteAllPR").disabled = true;
                        document.getElementById("spinner").style.display = "none";
                    }       
                });    
                    
            }
        });
        
    }

    function import_data(){
	   	var date = document.getElementById("datepicker").value;
        var checkedall = document.getElementById("CheckAll").checked;
        var count_checkbox = $('#table-body tr td:last-child input[type="checkbox"]').length
            if(hasImported){
                swal({
                        title: "ต้องการอิมพอร์ตข้อมูลนี้หรือไม่",
                        buttons: true,
                        dangerMode: false,
                })
                .then((willEdit) => {
                    if (willEdit) {
                        document.getElementById("spinner").style.display = "block";
                        var table = document.getElementById("table-body");
                        var tr = table.querySelectorAll("tr");
                        if(( checkedall ||  (count_checkbox == countCheckedCheckboxes) ) && (count_checkbox != 0 )  ){
                            $.ajax({
                                type:"POST",
                                url:"<?php echo site_url('Call_Import/insert_data');?>",
                                data:{date_start:date_start,date_end:date_end,isCheckedAll:(checkedall)}
                            })
                            .done(function(json){
                                swal("อิมพอร์ตข้อมูลสำเร็จ", "", "success").then(function() {
                                    document.getElementById("spinner").style.display = "block";
                                    setInterval(location.reload(), 1500);
                                });
                                document.getElementById("spinner").style.display = "none";
                            });
                        }else if(countCheckedCheckboxes != 0){
                            var table = document.getElementById("table-body");
                            var tr = table.querySelectorAll("tr");
                            for(x = 0; x <  tr.length; x++){
                                if(tr[x].lastElementChild.innerHTML=='') {
                                    CheckedArr.push(tr[x].childNodes[4].innerText);
                                }
                            }
                            console.log("Import: " + CheckedArr);
                            $.ajax({
                                type:"POST",
                                url:"<?php echo site_url('Call_Import/insert_data');?>",
                                data:{date_start:date_start,date_end:date_end,isChecked:(countCheckedCheckboxes != 0),portChecked:CheckedArr}
                            })
                            .done(function(json){
                                swal("อิมพอร์ตข้อมูลสำเร็จ", "", "success").then(function() {
                                    document.getElementById("spinner").style.display = "block";
                                    setInterval(location.reload(), 1500);
                                });
                                document.getElementById("spinner").style.display = "none";
                            });
                        }else if((PortRecent.length != tr.length) && (countCheckedCheckboxes == 0) && (PortErr.length == 0) && (PortRecent.length != 0) ) {
                            swal({
                                title: "จะทำการอิมพอร์ตเฉพาะข้อมูลที่ไม่ได้มีการอัพเดตภายในเดือนนี้เท่านั้น",
                                buttons: true,
                                dangerMode: false,
                                icon: "warning"
                            })
                            .then((willEdit) => {
                                if (willEdit) {
                                    for(x = 0; x <  tr.length; x++){
                                        if(tr[x].lastElementChild.innerHTML=='') {
                                            DataTrue.push(tr[x].childNodes[4].innerText);
                                        }
                                    }
                                    $.ajax({
                                        type:"POST",
                                        url:"<?php echo site_url('Call_Import/insert_data');?>",
                                        data:{date_start:date_start,date_end:date_end,dataTrue:DataTrue,onlyTrue:true},
                                    })
                                    .done(function(data){
                                        swal("อิมพอร์ตข้อมูลสำเร็จ", "", "success").then(function() {
                                            document.getElementById("spinner").style.display = "block";
                                            setInterval(location.reload(), 1500);
                                        });
                                        document.getElementById("spinner").style.display = "none";
                                    });
                                }
                            });   
                        }else if((PortRecent.length == 0) && (PortErr.length == 0)){
                            $.ajax({
                                type:"POST",
                                url:"<?php echo site_url('Call_Import/insert_data');?>",
                                data:{date_start:date_start,date_end:date_end}
                            })
                            .done(function(json){
                                var myObj = JSON.parse(json);
                                var errorStatus = myObj.error_status;
                                if(errorStatus){
                                    swal("อิมพอร์ตข้อมูลไม่สำเร็จ", "", "danger");
                                }else {
                                    swal("อิมพอร์ตข้อมูลสำเร็จ", "", "success").then(function() {
                                        document.getElementById("spinner").style.display = "block";
                                        setInterval(location.reload(), 1500);
                                    });
                                    document.getElementById("spinner").style.display = "none";
                                }
                                
                            });     
                        }else if((PortRecent.length != 0) && (PortErr.length == 0) && (PortRecent.length == tr.length) ) {
                            swal("ไม่สามารถอิมพอร์ตข้อมูลได้", "กรุณาเลือกข้อมูลที่ต้องการอิมพอร์ต", "warning");
                            document.getElementById("spinner").style.display = "none";
                        }
                        else {
                            swal("ไม่สามารถอิมพอร์ตข้อมูลได้", "กรุณาลบข้อมูลที่ไม่ถูกต้อง", "error");
                            document.getElementById("spinner").style.display = "none";
                        }
                    }
                });
            }else {
                if(date!=""){
                    swal({
                        title: "ต้องการอิมพอร์ตข้อมูลนี้หรือไม่",
                        buttons: true,
                        dangerMode: false,
                    })
                    .then((willEdit) => {
                        if (willEdit) {
                            document.getElementById("spinner").style.display = "block";
                            check = false;
                            $.ajax({
                                type:"POST",
                                url:"<?php echo site_url('Call_Import/select_data');?>",
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
                                document.getElementById("total-col").style.color = "black";
                                makeTable(result,true);
                                $.ajax({
                                    type:"POST",
                                    url:"<?php echo site_url('Call_Import/insert_data');?>",
                                    data:{date_start:date_start,date_end:date_end}
                                })
                                .done(function(json){
                                    var myObj = JSON.parse(json);
                                    var result = myObj.result;
                                    var port = myObj.port;
                                    var errorStatus = myObj.error_status;
                                    var hasUpdated = myObj.hasUpdated;
                                    var recent = myObj.recent;
                                    var text_error = '';
                                    if(errorStatus && hasUpdated ){
                                        for(i = 0 ; i < result.length ; i++){
                                            if(result[i] != '' ){
                                                if(i==0){
                                                    text_error = text_error + result[i];
                                                }else {
                                                    text_error = text_error + "\n" + result[i];
                                                }
                                            } 
                                        }
                                        makeRecentlyUpdated(recent);
                                        port_error(port, "ไม่พบพอร์ตที่ต้องการอัพเดตจำนวนเงิน" );
                                        swal("อิมพอร์ตข้อมูลไม่สำเร็จ",text_error, "error");
                                        import_false();
                                        document.getElementById("spinner").style.display = "none";
                                    }else if (hasUpdated) {
                                        makeRecentlyUpdated(recent);
                                        swal("อิมพอร์ตข้อมูลไม่สำเร็จ",'เนื่องจากมีการอัพเดตไปเเล้ว', "warning");
                                        import_false();
                                        document.getElementById("spinner").style.display = "none";
                                    }
                                    else{
                                        swal("อิมพอร์ตข้อมูลสำเร็จ", "", "success").then(function() {
                                            document.getElementById("spinner").style.display = "block";
                                            setInterval(location.reload(), 1500);
                                        });
                                        document.getElementById("spinner").style.display = "none";
                                    }
                                    hasImported = true;
                                
                                });
                            });
                        }
                    });
                }else {
                    swal("กรุณาเลือกวันที่รับเงิน", "", "warning");
                }
        }
        
    }

    $(function() {
        $('#datepicker').datepicker({
            changeYear: true,
            changeMonth: true,
            showButtonPanel: true,
            monthNames: [ "01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12" ],
            monthNamesShort: [ "01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12" ],
            dateFormat: 'dd/MM/yy',
           
        });
        
        
        $("#datepicker").focus(function () {
            document.getElementById("ui-datepicker-div").style.zIndex="99";
            $(".ui-datepicker-calendar").hide();
            $(".ui-datepicker-close").click(function(dateText, inst) {
                var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                var m = parseInt(month) + 1;
                month = m.toString();
                $('#datepicker').datepicker('setDate', new Date(year,month,0));
                set_Date();

            
            });
            
        });

    });

    function set_Date(isImport=false){
        var date = document.getElementById("datepicker").value;
        var res = date.split("/")
        var elements = document.getElementsByClassName("setdate");
        for(var i=0; i<elements.length; i++) {
            elements[i].innerHTML = res[0]+"/"+res[1]+"/"+res[2];
        }

        if(elements.length!=0){
            var date_import = convert_Date();
            document.getElementById("spinner").style.display = "block";
            $.ajax({
                type:"POST",
                url:"<?php echo site_url('Call_Import/set_date');?>",
                data:{date:date_import},
                })
                .done(function(data){
                    if(!isImport){
                        document.getElementById("spinner").style.display = "none";
                    }
             });
        }


    }

    function convert_Date() {
        var str = document.getElementsByClassName("setdate")[0].innerHTML;
        var res = str.split("/");

        var date = res[2]+"-"+res[1]+"-"+res[0];
        return date;
    }

    function select_Data_Show() {
        var option_data = document.getElementById("data_select").value;
        document.getElementById("spinner").style.display = "block";
        if(option_data == 'data_all'){
            check = false;
            DeleteArr = [];
            $.ajax({
                type:"POST",
                url:"<?php echo site_url('Call_Import/select_data');?>",
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
            DeleteArr = [];
            $.ajax({
                type:"POST",
                url:"<?php echo site_url('Call_Import/select_data_true');?>",
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
            DeleteArr = [];
            $.ajax({
                type:"POST",
                url:"<?php echo site_url('Call_Import/select_data_false');?>",
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

    function delete_selected_data() {
        var data_select = document.getElementById("data_select").value;
        var table = document.getElementById("table-body");
        var tr = table.querySelectorAll("tr");
        var DeleteSelected = JSON.stringify(DeleteArr);
        swal({
            title: "ต้องการลบข้อมูลนี้หรือไม่",
            icon: "warning",
            buttons: true,
            dangerMode: false,
        })
        .then((willEdit) => {
            if (willEdit && !hasImported) {
                if(DeleteArr.length != 0){
                    document.getElementById("spinner").style.display = "block";
                    if(data_select == 'data_all'){
                        $.ajax({
                        type:"POST",
                        url:"<?php echo site_url('Call_Import/delete_data');?>",
                        data:{DeleteSelected:DeleteSelected,isSelected:("true")}
                        })
                        .done(function(data){
                            $.ajax({
                                type:"POST",
                                url:"<?php echo site_url('Call_Import/select_data');?>"
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
                                t = t - DeleteArr.length;
                                if(t == 0){
                                    swal("ลบข้อมูลสำเร็จ", "", "success").then(function() {
                                        swal("ไม่มีข้อมูล", "", "warning").then(function() {
                                                document.getElementById("spinner").style.display = "block";
                                                setInterval(location.reload(), 1500);
                                            });
                                    document.getElementById("spinner").style.display = "none";
                                    });    
                                }else {
                                    makeTable(result);
                                    swal("ลบข้อมูลสำเร็จ", "", "success");
                                    DeleteArr = [];
                                    document.getElementById("spinner").style.display = "none";
                                }
                                
                            });
                        });
                    }else if (data_select == 'data_true') {
                        $.ajax({
                        type:"POST",
                        url:"<?php echo site_url('Call_Import/delete_data');?>",
                        data:{DeleteSelected:DeleteSelected,isSelected:("true")}
                        })
                        .done(function(data){
                            $.ajax({
                                type:"POST",
                                url:"<?php echo site_url('Call_Import/select_data_true');?>"
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
                                t = t - DeleteArr.length;
                                if(t == 0){
                                    swal("ลบข้อมูลสำเร็จ", "", "success").then(function() {
                                        swal("ไม่มีข้อมูล", "", "warning").then(function() {
                                                document.getElementById("spinner").style.display = "block";
                                                setInterval(location.reload(), 1500);
                                            });
                                    document.getElementById("spinner").style.display = "none";
                                    });    
                                }else {
                                    makeTable(result);
                                    swal("ลบข้อมูลสำเร็จ", "", "success");
                                    DeleteArr = [];
                                    document.getElementById("spinner").style.display = "none";
                                }
                            });
                        });
                    }else if(data_select == 'data_false') {
                        $.ajax({
                        type:"POST",
                        url:"<?php echo site_url('Call_Import/delete_data');?>",
                        data:{DeleteSelected:DeleteSelected,isSelected:("true")}
                        })
                        .done(function(data){
                            $.ajax({
                                type:"POST",
                                url:"<?php echo site_url('Call_Import/select_data_false');?>"
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
                                t = t - DeleteArr.length;
                                if(t == 0){
                                    swal("ลบข้อมูลสำเร็จ", "", "success").then(function() {
                                        swal("ไม่มีข้อมูล", "", "warning").then(function() {
                                                document.getElementById("spinner").style.display = "block";
                                                setInterval(location.reload(), 1500);
                                            });
                                    document.getElementById("spinner").style.display = "none";
                                    });    
                                }else {
                                    makeTable(result);
                                    swal("ลบข้อมูลสำเร็จ", "", "success");
                                    DeleteArr = [];
                                    document.getElementById("spinner").style.display = "none";
                                }
                               
                            });
                        });
                    }
                }else {
                    swal("กรุณาเลือกข้อมูลที่ต้องการลบ", "", "warning");
                }
            }
        });
    }

    function delete_data(number, port) {
        var data_select = document.getElementById("data_select").value;
        var table = document.getElementById("table-body");
        var tr = table.querySelectorAll("tr");

        swal({
            title: "ต้องการลบข้อมูลนี้หรือไม่",
            icon: "warning",
            buttons: true,
            dangerMode: false,
        })
        .then((willEdit) => {
            if (willEdit && !hasImported) {
                document.getElementById("spinner").style.display = "block";
                if(data_select == 'data_all'){
                    $.ajax({
                    type:"POST",
                    url:"<?php echo site_url('Call_Import/delete_data');?>",
                    data:{number:number,port:port,isSelected:("false")}
                    })
                    .done(function(data){
                        $.ajax({
                            type:"POST",
                            url:"<?php echo site_url('Call_Import/select_data');?>"
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
                            if(t == 0){
                                swal("ลบข้อมูลสำเร็จ", "", "success").then(function() {
                                        swal("ไม่มีข้อมูล", "", "warning").then(function() {
                                                document.getElementById("spinner").style.display = "block";
                                                setInterval(location.reload(), 1500);
                                        });
                                    document.getElementById("spinner").style.display = "none";
                                });    
                            }else {
                                    makeTable(result);
                                    swal("ลบข้อมูลสำเร็จ", "", "success");
                                    document.getElementById("spinner").style.display = "none";
                            }
                        });
                    });
                }else if (data_select == 'data_true') {
                    $.ajax({
                    type:"POST",
                    url:"<?php echo site_url('Call_Import/delete_data');?>",
                    data:{number:number,port:port,isSelected:("false")}
                    })
                    .done(function(data){
                        $.ajax({
                            type:"POST",
                            url:"<?php echo site_url('Call_Import/select_data_true');?>"
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
                            if(t == 0){
                                swal("ลบข้อมูลสำเร็จ", "", "success").then(function() {
                                        swal("ไม่มีข้อมูล", "", "warning").then(function() {
                                                document.getElementById("spinner").style.display = "block";
                                                setInterval(location.reload(), 1500);
                                        });
                                    document.getElementById("spinner").style.display = "none";
                                });    
                            }else {
                                    makeTable(result);
                                    swal("ลบข้อมูลสำเร็จ", "", "success");
                                    document.getElementById("spinner").style.display = "none";
                            }
                        });
                    });
                }else if(data_select == 'data_false') {
                    $.ajax({
                    type:"POST",
                    url:"<?php echo site_url('Call_Import/delete_data');?>",
                    data:{number:number,port:port,isSelected:("false")}
                    })
                    .done(function(data){
                        $.ajax({
                            type:"POST",
                            url:"<?php echo site_url('Call_Import/select_data_false');?>"
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
                            if(t == 0){
                                    swal("ลบข้อมูลสำเร็จ", "", "success").then(function() {
                                        swal("ไม่มีข้อมูล", "", "warning").then(function() {
                                                document.getElementById("spinner").style.display = "block";
                                                setInterval(location.reload(), 1500);
                                        });
                                    document.getElementById("spinner").style.display = "none";
                                    });    
                            }else {
                                    makeTable(result);
                                    swal("ลบข้อมูลสำเร็จ", "", "success");
                                    document.getElementById("spinner").style.display = "none";
                            }
                        });
                    });
                }
            }
        });
    }

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
            swal("กรุณากรอกตัวเลข", "", "warning");
            return false;
		}
        return true;
    }

</script>

