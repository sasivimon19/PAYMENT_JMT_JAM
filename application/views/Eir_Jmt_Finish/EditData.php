<html>

<head>
    <meta http-equiv="content-type" charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SELECT DATA</title>
    <script src="<?php echo base_url(); ?>assets/js/sweetalert.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/js/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/styles.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/navbar.css">
    <style>
        a:hover {
            text-decoration: none;
            color: firebrick;
        }
    </style>
    <style>
        #loadding {
            position: fixed;
            left: 0px;
            width: 100%;
            height: 100%;
            padding-left: 45%;
            padding-top: 15%;

        }

        .modal {
            display: none;
            position: fixed;
            height: 100%;
            background-color: rgb(0, 0, 0);
            /* Fallback color */
            background-color: rgba(0, 0, 0, 0.4);
            /* Black w/ opacity */
            padding-top: 0px;

        }
    </style>

</head>

<body>


    <div class="loading" id="spinner"></div>

    <div id="main">
        <div class="wrapper">
            <div class="content-wrapper">
                <section class="content" style=" padding-top:2%;">
                    <div class="container-fluid">
                        <div class="card card-secondary">
                            <div class="card-header" style="background-color: #c3000d;">
                                <h3 class="card-title"> <b> EditData11 </b> </h3>
                            </div>
                            <div class="card-body">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-4">
                                            <div style="background-color: lightgrey;
                                                width: 800px;
                                                height:100px;
                                                border: 5px solid black;
                                                padding:20px;
                                                margin-bottom:-90px;">
                                                <div class="row" style="padding:10px;width:800px;">
                                                    <div class="col-md-5" style="margin-top:0;margin-bottom:-100px;margin-left:0px">
                                                        <select name="port_search" id="port_search" class="form-control">
                                                            <option selected value="allPort">กรุณาเลือกพอร์ตที่ต้องการค้นหา</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-5" style="margin-top:0;margin-bottom:-100px;margin-left:320px">
                                                        <input autocomplete="off" type="text" class="form-control" id="datepicker" placeholder="กรุณาเลือกเดือนเเละปีที่ต้องการค้นหา" />
                                                    </div>
                                                    <div class="col-md-2" style="margin-top:0;margin-bottom:-100px;margin-left:630px">
                                                        <button class="btn btn-success" onclick="search_data()">Search</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="row" style="margin-bottom:-70px;margin-top:150px" id="att_table">
                                    <div style="margin-top:0;margin-bottom:-100px; margin-left:50px">
                                        <button class="btn btn-success" onclick="export_data_csv()">Excel</button>
                                    </div>

                                    <div class="col-md-2" style="margin-top:0;margin-bottom:-100px;">
                                        <div class="total-col" id="total-col"></div>
                                    </div>

                                    <div class="form-group col-md-2" style="margin-top:0;margin-bottom:-100px;margin-left:950px">
                                        <select class="form-control" id="maxRows" disabled>
                                            <option value="5000" selected>Show ALL Rows</option>
                                            <option value="5">5</option>
                                            <option value="10">10</option>
                                            <option value="15">15</option>
                                            <option value="20">20</option>
                                            <option value="50">50</option>
                                            <option value="70">70</option>
                                            <option value="100">100</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="table-space tableFixHead" id="table" style=" margin-top: 10%; ">
                                        <table class="table table-striped table-bordered " id="table-data">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" width="1%">Number</th>
                                                    <th class="text-center" width="5%">Port</th>
                                                    <th class="text-center" width="5%">Cash</th>
                                                    <!-- -----------------------ADD--------------------------- -->
                                                    <th class="text-center" width="1%">Revoke</th>
                                                    <th class="text-center" width="1%">CourtFee</th>
                                                    <th class="text-center" width="1%">TransferFee</th>
                                                    <!-- -------------------------------------------------- -->
                                                    <th class="text-center" width="5%">Date</th>
                                                    <th class="text-center" width="2%">Edit</th>
                                                    <th class="text-center" width="2%">Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody id="table-body">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>


                                <!-- ////////////////////////////////////////////////////////////////// -->
                                <div id="userModal_Edit" class="modal">
                                    <div class="modal-dialog">
                                        <form method="post" id="user_form_edit">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title"><b>Edit</b></h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                                                </div>

                                                <div class="modal-body">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-8"></div>
                                                            <div class="col-md-4">
                                                                Date : <span id="date_edit"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </br>
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <label>Enter Port</label>
                                                            <input type="text" name="port_edit" id="port_edit" class="form-control" readonly />
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <label>Enter Cash</label>
                                                            <input type="text" name="cash_edit" id="cash_edit" class="form-control" onkeypress="javascript:return isNumber(event)" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <label>Enter Revoke</label>
                                                            <input type="text" name="revoke_edit" id="revoke_edit" class="form-control" onkeypress="javascript:return isNumber(event)" />
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <label>Enter CourtFee</label>
                                                            <input type="text" name="court_edit" id="court_edit" class="form-control" onkeypress="javascript:return isNumber(event)" />
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <label>Enter TransferFee</label>
                                                            <input type="text" name="transfer_edit" id="transfer_edit" class="form-control" onkeypress="javascript:return isNumber(event)" />
                                                        </div>
                                                    </div>
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
                                <div class="col-md-10">
                                    <ul class="pagination justify-content-center">
                                        <li class="page-item" data-page="prev"><a class="page-link" href="#">Previous</a></li>
                                        <li class="page-item" data-page="next" id="prev"><a class="page-link" href="#">Next</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            </section>
        </div>
    </div>
    </div>
    <div id="spinner" class="modal" style="display: none; text-align: center;">
        <img style="margin-top: 15%;width: 15%;" src="<?php echo base_url(); ?>assets/images/loader.gif">
    </div>

</body>

</html>




<script>
    var t = 0;
    var text, Number, numlog = 1;;
    var check = false;
    var PORT_EDIT;
    var port_search;
    var Date_Search;
    // var tableShow = document.getElementById("table");
    // tableShow.style.display = 'none';
    // var attrTable = document.getElementById("att_table");
    // attrTable.style.display = 'none';
    select_port("", "port_search");
    getPagination('#table-data');


    function search_data() {
        var port_search = document.getElementById("port_search").value;
        var date = document.getElementById("datepicker").value;

        Port_Search = port_search != 'allPort' ? Port_Search = port_search : Port_Search = "";
        Date_Search = date != '' ? Date_search = convert_Date() : Date_search = '';


        document.getElementById("spinner").style.display = "block";
        if (port_search == 'allPort') {
            if (date != '') {
                var date_search = convert_Date();
                $.ajax({
                        type: "POST",
                        url: "<?php echo site_url('Call_EditData/search_data'); ?>",
                        data: {
                            date: date_search
                        }
                    })
                    .done(function(json) {
                        var myObj = JSON.parse(json);
                        var result = myObj.result;
                        t = result.length;
                        select_port();
                        makeTable(result);
                        document.getElementById("maxRows").disabled = false;
                        document.getElementById("spinner").style.display = "none";
                    });
            } else {
                swal("กรุณาเลือกเดือนเเละปีหรือพอร์ตที่ต้องการค้นหา", "", "warning");
                document.getElementById("spinner").style.display = "none";

            }
        } else {
            if (date != '') {
                var date_search = convert_Date();
                $.ajax({
                        type: "POST",
                        url: "<?php echo site_url('Call_EditData/search_data'); ?>",
                        data: {
                            date: date_search,
                            port: port_search
                        }
                    })
                    .done(function(json) {
                        // console.log(json);
                        var myObj = JSON.parse(json);
                        var result = myObj.result;
                        t = result.length;
                        select_port();
                        makeTable(result);
                        document.getElementById("maxRows").disabled = false;
                        document.getElementById("spinner").style.display = "none";
                    });
            } else {
                $.ajax({
                        type: "POST",
                        url: "<?php echo site_url('Call_EditData/search_data'); ?>",
                        data: {
                            port: port_search
                        }
                    })
                    .done(function(json) {
                        // console.log(json);
                        var myObj = JSON.parse(json);
                        var result = myObj.result;
                        t = result.length;
                        select_port();
                        makeTable(result);
                        document.getElementById("maxRows").disabled = false;
                        document.getElementById("spinner").style.display = "none";
                    });

            }

        }

    }

    //excel viee editdata
    function export_data_csv() {
        window.location.href = "export_data_csv" + "?date=" + Date_Search + "&port=" + Port_Search;

    }

    function select_port(btn = "", port = "") {
        document.getElementById("spinner").style.display = "block";
        $.ajax({
                type: "POST",
                url: "<?php echo site_url('Call_Import/select_port'); ?>",
            })
            .done(function(json) {
                var myObj = JSON.parse(json);
                var result = myObj.result;
                makePort(result, btn, port);
                document.getElementById("spinner").style.display = "none";


            });
    }

    function makePort(result, btn = "", port = "") {
        if (btn == "" && port == "") {
            for (var i in result) {
                $('#port').append('<option value="' + result[i].Port + '">' + result[i].Port + '</option>');
            }

        } else if (btn == "" && port == "port_search") {
            for (var i in result) {
                $('#port_search').append('<option value="' + result[i].Port + '">' + result[i].Port + '</option>');
            }
        } else {
            if (btn == 'add') {
                for (var i in result) {
                    $('#port_add').append('<option value="' + result[i].Port + '">' + result[i].Port + '</option>');

                }
            } else {
                for (var i in result) {
                    if (port == result[i].Port) {
                        $('#port_edit').append('<option value="' + result[i].Port + '" selected>' + result[i].Port + '</option>');
                    } else {
                        $('#port_edit').append('<option value="' + result[i].Port + '">' + result[i].Port + '</option>');
                    }
                }
            }
        }

    }

    function makeTable(result) {
        var num = 1;
        // tableShow.style.display = 'block';
        // attrTable.style.display = 'block';        
        $('#table-body').find('tr').remove();
        for (var i in result) {
            $('#table-body').append(
                '<tr id="' + result[i].Number + '">\
                    <td style="padding:2px;text-align:right;vertical-align:middle;height:30px;" width="1%">' + num + '</td>\
                    <td style="padding:2px;text-align:center;vertical-align:middle;height:30px;" width="5%">' + result[i].Port + '</td>\
                    <td style="padding:2px;text-align:right;vertical-align:middle;height:30px;" width="5%">' +
                numberTwoDecPoint(result[i].CashFlow, true) +
                '</td>\
                    <td style="padding:2px;text-align:center;vertical-align:middle;height:30px;" width="5%">' + splitPoint(result[i].RevokeCustomer) + '</td>\
                    <td style="padding:2px;text-align:center;vertical-align:middle;height:30px;" width="5%">' + splitPoint(result[i].CourtFee) + '</td>\
                    <td style="padding:2px;text-align:center;vertical-align:middle;height:30px;" width="5%">' + splitPoint(result[i].TransferFee) + '</td>\
                    <td style="padding:2px;text-align:center;vertical-align:middle;height:30px;" width="5%">' +
                set_Date(result[i].MONTH_YEAR.substring(0, 10)) +
                '</td>\
                    <td width="1%" style="padding:2px;text-align:center;vertical-align:middle;height:30px;">\
                        <button\
                            class="btn btn-info"\
                            id="' + num + '"\ onclick="select_edit(' + "'" + num + "',\
                                '" + result[i].Port + "',\
                                '" + result[i].CashFlow + "',\
                                '" + splitPoint(result[i].RevokeCustomer) + "',\
                                '" + splitPoint(result[i].CourtFee) + "',\
                                '" + splitPoint(result[i].TransferFee) + "',\
                                '" + set_Date(result[i].MONTH_YEAR.substring(0, 10)) + "'" + ')"\
                        >Edit</button>\
                    <td width="1%" style="padding:2px;text-align:center;vertical-align:middle;height:30px;">\
                        <button\
                            class="btn btn-danger"\
                            id="' + num + '"\
                            onclick="delete_data(' + "'" + result[i].Port + "','" + set_Date(result[i].MONTH_YEAR.substring(0, 10)) + "'" + ')"\
                        >Delete</button>\
                </tr>');
            num++;
        }

        document.getElementById("total-col").innerHTML = (check ? (text + " " + result.length) : "ข้อมูลทั้งหมด: " + t);
        // var date = document.getElementById("datepicker").value;
        // if(date!=""){  
        //     set_Date();
        // }


    }

    function splitPoint(num) {
        number = num.split(".");
        return number[0];

    }

    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    function select_edit(numRows, port, cash, revoke, court, transfer, date) {

        Number = number;
        document.getElementById('date_edit').innerHTML = date;
        document.getElementById('port_edit').value = port;
        document.getElementById('cash_edit').value = numberTwoDecPoint(cash, false);
        document.getElementById('revoke_edit').value = revoke;
        document.getElementById('court_edit').value = court;
        document.getElementById('transfer_edit').value = transfer;
        $('#userModal_Edit').modal('show');


    }

    $(document).on('submit', '#user_form_edit', function(event) {
        event.preventDefault();
        var date = document.getElementById("datepicker").value;
        var date_edit = convert_Date();
        var cash = document.getElementById('cash_edit').value;
        var revoke = document.getElementById('revoke_edit').value;
        var court = document.getElementById('court_edit').value;
        var transfer = document.getElementById('transfer_edit').value;
        if (cash == '') {
            swal("กรุณากรอกจำนวนเงิน", "", "warning");
        } else if (isNaN(cash)) {
            swal("กรุณากรอกจำนวนเงินเป็นตัวเลข", "", "warning");
        } else if (revoke == '') {
            swal("กรุณากรอก Revoke", "", "warning");
        } else if (isNaN(revoke)) {
            swal("กรุณากรอก Revoke เป็นตัวเลข", "", "warning");
        } else if (court == '') {
            swal("กรุณากรอก CourtFee", "", "warning");
        } else if (isNaN(court)) {
            swal("กรุณากรอก CourtFee เป็นตัวเลข", "", "warning");
        } else if (transfer == '') {
            swal("กรุณากรอก TransferFee", "", "warning");
        } else if (isNaN(transfer)) {
            swal("กรุณากรอก TransferFee เป็นตัวเลข", "", "warning");
        } else {
            swal({
                    title: "ต้องการเเก้ไขข้อมูลนี้หรือไม่",
                    icon: "warning",
                    buttons: true,
                    dangerMode: false,
                })
                .then((willEdit) => {
                    if (willEdit) {
                        $.ajax({
                            type: "POST",
                            url: "<?php echo site_url('Call_EditData/edit_data'); ?>",
                            data: $("#user_form_edit").serialize() + "&date=" + date_edit,
                        }).done(function(data) {
                            $('#user_form_edit')[0].reset();
                            $('#userModal_Edit').modal('hide');
                            document.getElementById("spinner").style.display = "block";
                            $.ajax({
                                    type: "POST",
                                    url: "<?php echo site_url('Call_EditData/search_data'); ?>",
                                    data: {
                                        date: date_edit
                                    }
                                })
                                .done(function(json) {
                                    var myObj = JSON.parse(json);
                                    var result = myObj.result;
                                    t = result.length;
                                    makeTable(result);
                                    swal("เเก้ไขข้อมูลสำเร็จ", "", "success");
                                    document.getElementById("spinner").style.display = "none";
                                });
                        });
                    }
                });
        }

    });


    $(function() {
        $('#datepicker').datepicker({
            changeYear: true,
            changeMonth: true,
            showButtonPanel: true,
            monthNames: ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12"],
            monthNamesShort: ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12"],
            dateFormat: 'dd/MM/yy',

        });


        $("#datepicker").focus(function() {
            document.getElementById("ui-datepicker-div").style.zIndex = "99";
            $(".ui-datepicker-calendar").hide();
            $(".ui-datepicker-close").click(function(dateText, inst) {
                var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                var m = parseInt(month) + 1;
                month = m.toString();
                $('#datepicker').datepicker('setDate', new Date(year, month, 0));

            });

        });

    });

    function set_Date(date_import) {
        var res = date_import.split("-");
        var date = res[2] + "/" + res[1] + "/" + res[0];
        return date;

    }

    function convert_Date(Da = "") {
        if (Da == "") {
            var str = document.getElementById("datepicker").value;
        } else {
            str = Da;
        }
        var res = str.split("/");

        var date = res[2] + "-" + res[1] + "-" + res[0];
        return date;
    }

    function numberTwoDecPoint(text, isCommas) {
        var hadChanged = false;
        number = text.split('.');
        if (isCommas) {
            number[0] = numberWithCommas(number[0]);
        }
        number[1] = number[1].substring(0, 3);

        if ((number[1].charAt(1) == '9') && (number[1].charAt(2) == '9')) {
            number[1] = number[1].replace(number[1].charAt(0), (parseInt(number[1].charAt(0)) + 1).toString());
            hadChanged = true;
        }


        number[1] = (number[1].charAt(2) == '9') && (number[1].charAt(1) == '9') && !(number[1].charAt(0) == '9') && hadChanged ?
            number[1].replace(number[1].charAt(1), '0') :
            number[1];

        number[1] = (number[1].charAt(2) == '9') && (number[1].charAt(1) == '9') && (number[1].charAt(0) == '9') && hadChanged ?
            number[1].charAt(0) + '0' + number[1].charAt(2) :
            number[1];

        number[1] = (number[1].charAt(2) == '9') && !(number[1].charAt(1) == '0') && !(number[1].charAt(1) == '9') ?
            (number[1].charAt(0) == number[1].charAt(1) ? number[1].charAt(0) + (parseInt(number[1].charAt(1)) + 1).toString() + number[1].charAt(2) :
                number[1].replace(number[1].charAt(1), (parseInt(number[1].charAt(1)) + 1).toString())) :
            number[1];

        number[1] = number[1].charAt(1) == '' ?
            number[1] + '0' :
            number[1];

        number[1] = (number[1].charAt(1) == '0') && (number[1].charAt(2) == '9') && (number[1].charAt(1) != '0') ?
            number[1].replace(number[1].charAt(1), (parseInt(number[1].charAt(1)) + 1).toString()) :
            number[1];

        number[1] = (number[1].charAt(1) == '0') && (number[1].charAt(2) == '9') && (number[1].charAt(0) == '0') ?
            '01' :
            number[1];
        if (!hadChanged) {
            number[1] = (number[1].charAt(1) == '0') && (number[1].charAt(2) == '9') && (number[1].charAt(0) != '0') ?
                number[1].replace(number[1].charAt(1), '1') :
                number[1];
        }



        numlog++;
        number[1] = number[1].substring(0, 2);
        if (number[1] != "0") {
            return number[0] + "." + number[1];
        } else {
            return number[0] + "." + number[1] + "0";
        }
    }

    function delete_data(port_delete, date_delete) {
        var date = convert_Date(date_delete);
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
                            type: "POST",
                            url: "<?php echo site_url('Call_EditData/delete_data'); ?>",
                            data: {
                                port: port_delete,
                                date: date
                            }
                        })
                        .done(function(data) {
                            $.ajax({
                                    type: "POST",
                                    url: "<?php echo site_url('Call_EditData/search_data'); ?>",
                                    data: {
                                        date: date
                                    }
                                })
                                .done(function(json) {
                                    var myObj = JSON.parse(json);
                                    var result = myObj.result;
                                    t = result.length;
                                    makeTable(result);
                                    swal("ลบข้อมูลสำเร็จ", "", "success");
                                    document.getElementById("spinner").style.display = "none";
                                });
                        });
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
                maxRows == 5 ? document.getElementById("table").style.height = "253px" : document.getElementById("table").style.height = "365px";
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
                    for (var i = 1; i <= pagenum;) {
                        // for each page append pagination li
                        $('.pagination #prev')
                            .before(
                                '<li class="page-item"data-page="' +
                                i +
                                '">\
                        <a class="page-link" href="#">' +
                                i++ +
                                '</a>\
                                     </li>'
                            )
                            .show();
                    } // end for i
                } // end if row count > max rows
                else {
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


    }

    function limitPagging() {
        //alert($('.pagination li').length)

        if ($('.pagination li').length > 7) {
            if ($('.pagination li.active').attr('data-page') <= 3) {
                $('.pagination li:gt(5)').hide();
                $('.pagination li:lt(5)').show();
                $('.pagination [data-page="next"]').show();
            }
            if ($('.pagination li.active').attr('data-page') > 3) {
                $('.pagination li:gt(0)').hide();
                $('.pagination [data-page="next"]').show();
                for (let i = (parseInt($('.pagination li.active').attr('data-page')) - 2); i <= (parseInt($('.pagination li.active').attr('data-page')) + 2); i++) {
                    $('.pagination [data-page="' + i + '"]').show();

                }

            }
        }
    }

    $(function() {
        // this will get the full URL at the address bar
        var url = window.location.href;
        // passes on every "a" tag 
        $("#header a").each(function() {
            // checks if its the same on the address bar
            if (url == (this.href)) {
                $(this).closest("li").addClass("active");
            }
        });
    });

    function isNumber(evt) {
        var iKeyCode = (evt.which) ? evt.which : evt.keyCode
        if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57)) {
            swal("กรุณากรอกตัวเลข", "", "warning");
            return false;
        }
        return true;
    }
</script>





