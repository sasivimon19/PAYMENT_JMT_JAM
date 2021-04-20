<html>

<head>
    <meta http-equiv="content-type" charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SELECT DATA</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/ui/1.9.2/jquery-ui.js" integrity="sha256-PsB+5ZEsBlDx9Fi/GXc1bZmC7wEQzZK4bM/VwNm1L6c=" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.9.1/themes/smoothness/jquery-ui.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="<?echo base_url()?>/css/styles.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/css/navbar-bar.css">

    <style>
        a:hover {
            text-decoration: none;
            color: firebrick;
        }
    </style>

</head>

<div class="loading" id="spinner"></div>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <div class="container text-center" style="margin-top:100px;margin-left:300px;">
            <div class="row" style="margin-bottom:-90px;">
                <div class="col-md-3" style="margin-top:0;margin-bottom:-100px;margin-left:250px">
                    <input autocomplete="off" type="text" class="form-control" id="datepicker" placeholder="กรุณากรอกเดือนเเละปีที่ต้องการค้นหา" />
                </div>
                <div class="col-md-2" style="margin-top:0;margin-bottom:-100px;margin-left:450px">
                    <button class="btn btn-success" onclick="search_data()">Search</button>
                </div>
            </div>
            <div class="row" style="margin-bottom:-70px;margin-top:150px" id="att_table">
                <div class="col-md-2" style="margin-top:0;margin-bottom:-100px;margin-left:-150px">
                    <div class="total-col" id="total-col"></div>
                </div>
                <div class="col-md-2" style="margin-top:0;margin-bottom:-100px;margin-left:425px">
                    <input type="text" class="form-control" id="myInput" onkeyup="search_table()" placeholder="Search data in table...">
                </div>
                <div class="col-md-2" style="margin-top:0;margin-bottom:-100px;margin-left:250px">
                    <select name="port" id="port" class="form-control" onchange="search_port()">
                        <option selected value="allPort">ALL Port</option>
                    </select>
                </div>
                <div class="form-group col-md-2" style="margin-top:0;margin-bottom:-100px;margin-left:825px">
                    <select class="form-control" id="maxRows">
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

            <div class="table-space tableFixHead" id="table">
                <table class="table table-striped table-bordered " id="table-data">
                    <thead>
                        <tr>
                            <th class="text-center" width="1%">Number</th>
                            <th class="text-center" width="5%">Port</th>
                            <th class="text-center" width="5%">Cash</th>
                            <th class="text-center" width="5%">Date</th>
                            <th class="text-center" width="2%">Edit</th>
                            <th class="text-center" width="2%">Delete</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
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
                                <div style="font-weight:700;font-size:16px">Date : <span id="date_edit"></span></div>
                                <br />
                            </div>
                            <div class="modal-body">
                                <br />
                                <label>Enter Port</label>
                                <select name="port_edit" id="port_edit" class="form-control">

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
            <div class='pagination-container'>
                <nav style="margin-top: -45px;margin-right: 300px;">
                    <ul class="pagination">
                        <li data-page="prev">
                            <span>
                                < <span class="sr-only">(current)
                            </span></span>
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
    </div>
</body>

</html>


<script>
    var t = 0;
    var text, Number, numlog = 1;;
    var check = false;
    // var tableShow = document.getElementById("table");
    // tableShow.style.display = 'none';
    // var attrTable = document.getElementById("att_table");
    // attrTable.style.display = 'none'; 

    function search_table() {
        var input, filter, table, tr, td, i, j, txtValue, select;
        input = document.getElementById("myInput");
        select = document.getElementById("port");
        filter = input.value.toUpperCase();
        filter_select = select.value.toUpperCase();
        table = document.getElementById("table-data");
        tr = table.getElementsByTagName("tr");
        loop1:
            for (i = 1; i < tr.length; i++) {
                loop2: for (j = 0; j < 4; j++) {
                    td = tr[i].getElementsByTagName("td")[j];
                    if (td) {
                        txtValue = td.textContent || td.innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                            continue loop1;
                        } else {
                            tr[i].style.display = "none";
                        }
                    }
                }
            }
    }

    function search_port() {
        var input, filter, table, tr, td, i, j, txtValue, select;
        input = document.getElementById("myInput");
        select = document.getElementById("port");
        filter = select.value.toUpperCase();
        table = document.getElementById("table-data");
        tr = table.getElementsByTagName("tr");
        if (select.value != 'allPort') {
            loop1: for (i = 1; i < tr.length; i++) {
                loop2: for (j = 0; j < 4; j++) {
                    td = tr[i].getElementsByTagName("td")[j];
                    if (td) {
                        txtValue = td.textContent || td.innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                            continue loop1;
                        } else {
                            tr[i].style.display = "none";
                        }
                    }
                }
            }
        }
        else {
            for (i = 1; i < tr.length; i++) {
                tr[i].style.display = "";
            }
        }

    }

    function search_data() {
        document.getElementById("spinner").style.display = "block";
        var date = document.getElementById("datepicker").value;
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
                    document.getElementById("spinner").style.display = "none";
                });
        } else {
            swal("กรุณาเลือกเดือนเเละปีที่ต้องการค้นหา", "", "warning");
            document.getElementById("spinner").style.display = "none";

        }
    }

    function select_port(btn = "", port = "") {
        document.getElementById("spinner").style.display = "block";
        $.ajax({
                type: "POST",
                url: "<?php echo site_url('Call_Excel/select_port'); ?>",
            })
            .done(function(json) {
                var myObj = JSON.parse(json);
                var result = myObj.result;
                makePort(result, btn, port);
                document.getElementById("spinner").style.display = "none";
                if (btn == 'edit') {
                    $('#userModal_Edit').modal('show');

                }

            });
    }

    function makePort(result, btn = "", port = "") {
        if (btn == "" && port == "") {
            for (var i in result) {
                $('#port').append('<option value="' + result[i].Port + '">' + result[i].Port + '</option>');
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
                    <td style="padding:2px;text-align:center;vertical-align:middle;height:30px;" width="5%">' +
                set_Date(result[i].MONTH_YEAR.substring(0, 10)) +
                '</td>\
                    <td width="1%" style="padding:2px;text-align:center;vertical-align:middle;height:30px;">\
                        <button\
                            class="btn btn-info"\
                            id="' + num + '"\ onclick="select_edit(' + "'" + num + "',\
                                '" + result[i].Port + "',\
                                '" + result[i].CashFlow + "',\
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

    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    function select_edit(numRows, port, cash, date) {
        select_port('edit', port);
        Number = number;
        document.getElementById('date_edit').innerHTML = date;
        document.getElementById('cash_edit').value = numberTwoDecPoint(cash, false);

    }

    $(document).on('submit', '#user_form_edit', function(event) {
        event.preventDefault();
        var date = document.getElementById("datepicker").value;
        var date_edit = convert_Date();
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



    });

    $(document).on('submit', '#user_form_add', function(event) {
        event.preventDefault();
        var data_select = document.getElementById("data_select").value;
        var data = document.getElementById("table-body");
        var tr = data.getElementsByTagName("tr");
        var number = parseInt(tr[tr.length - 1].id) + 1;
        if (confirm("ต้องการเพิ่มข้อมูลนี้หรือไม่")) {
            document.getElementById("spinner").style.display = "block";
            if (data_select == 'data_all') {
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('Call_Excel/add_data'); ?>",
                    data: $("#user_form_add").serialize() + "&number=" + number,
                }).done(function(data) {
                    $('#user_form_add')[0].reset();
                    $('#userModal_Add').modal('hide');
                    $.ajax({
                            type: "POST",
                            url: "<?php echo site_url('Call_Excel/select_data'); ?>"
                        })
                        .done(function(json) {
                            myObj = JSON.parse(json);
                            var result = myObj.result;
                            var errorStatus = myObj.error_status;
                            if (errorStatus) {
                                document.getElementById("BtnImport").disabled = true;
                                document.getElementById("error").style.color = "red";
                                document.getElementById("error").innerHTML = "ข้อมูลทั้งหมดไม่ถูกต้อง";
                            } else {
                                document.getElementById("BtnImport").disabled = false;
                                document.getElementById("error").innerHTML = "ข้อมูลทั้งหมดถูกต้อง";
                                document.getElementById("error").style.color = "green";
                            }
                            t++;
                            makeTable(result);
                            document.getElementById("spinner").style.display = "none";
                        });
                });
            } else if (data_select == 'data_true') {
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('Call_Excel/add_data'); ?>",
                    data: $("#user_form_add").serialize() + "&number=" + (t + 1),
                }).done(function(data) {
                    $('#user_form_add')[0].reset();
                    $('#userModal_Add').modal('hide');
                    $.ajax({
                            type: "POST",
                            url: "<?php echo site_url('Call_Excel/select_data_true'); ?>"
                        })
                        .done(function(json) {
                            myObj = JSON.parse(json);
                            var result = myObj.result;
                            var errorStatus = myObj.error_status;
                            if (errorStatus) {
                                document.getElementById("BtnImport").disabled = true;
                                document.getElementById("error").style.color = "red";
                                document.getElementById("error").innerHTML = "ข้อมูลทั้งหมดไม่ถูกต้อง";
                            } else {
                                document.getElementById("BtnImport").disabled = false;
                                document.getElementById("error").innerHTML = "ข้อมูลทั้งหมดถูกต้อง";
                                document.getElementById("error").style.color = "green";
                            }
                            t++;
                            makeTable(result);
                            document.getElementById("spinner").style.display = "none";
                        });
                });
            } else {
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('Call_Excel/add_data'); ?>",
                    data: $("#user_form_add").serialize() + "&number=" + (t + 1),
                }).done(function(data) {
                    $('#user_form_add')[0].reset();
                    $('#userModal_Add').modal('hide');
                    $.ajax({
                            type: "POST",
                            url: "<?php echo site_url('Call_Excel/select_data_false'); ?>"
                        })
                        .done(function(json) {
                            myObj = JSON.parse(json);
                            var result = myObj.result;
                            if (result != "") {
                                document.getElementById("BtnImport").disabled = true;
                                document.getElementById("error").style.color = "red";
                                document.getElementById("error").innerHTML = "ข้อมูลทั้งหมดไม่ถูกต้อง";
                            } else {
                                document.getElementById("BtnImport").disabled = false;
                                document.getElementById("error").innerHTML = "ข้อมูลทั้งหมดถูกต้อง";
                                document.getElementById("error").style.color = "green";
                            }
                            t++;
                            makeTable(result);
                            document.getElementById("spinner").style.display = "none";
                        });
                });
            }

        } else {
            alert("Bother Fields are Required");
        }
    });

    $(function() {
        $('#datepicker').datepicker({
            changeYear: true,
            changeMonth: true,
            showButtonPanel: true,
            monthNames: ["มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"],
            monthNamesShort: ["ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค."],
            dateFormat: 'dd/MM/yy',
            onClose: function(dateText, inst) {
                var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                var m = parseInt(month) + 1;
                month = m.toString();
                $(this).datepicker('setDate', new Date(year, month, 0));
            }
        });

        $("#datepicker").focus(function() {
            document.getElementById("ui-datepicker-div").style.zIndex = "99";
            $(".ui-datepicker-calendar").hide();

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

        switch (res[1]) {
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

        var date = res[2] + "-" + res[1] + "-" + res[0];
        return date;
    }


    function numberTwoDecPoint(text, isCommas) {
        console.log(numlog + ":" + text);

        number = text.split('.');
        if (isCommas) {
            number[0] = numberWithCommas(number[0]);
        }
        number[1] = number[1].substring(0, 3);


        console.log("0: " + number[1]);
        number[1] = (number[1].charAt(1) == '9') && (number[1].charAt(2) == '9') ?
            number[1].replace(number[1].charAt(0), (parseInt(number[1].charAt(0)) + 1).toString()) :
            number[1];
        console.log("1: " + number[1]);

        number[1] = (number[1].charAt(2) == '9') && (number[1].charAt(1) == '9') ?
            number[1].replace(number[1].charAt(1), '0') :
            number[1];
        console.log("2: " + number[1]);

        number[1] = (number[1].charAt(2) == '9') && !(number[1].charAt(1) == '0') ?
            number[1].replace(number[1].charAt(1), (parseInt(number[1].charAt(1)) + 1).toString()) :
            number[1];
        console.log("3: " + number[1]);

        number[1] = number[1].charAt(1) == '' ?
            number[1] + '0' :
            number[1];
        console.log("4: " + number[1]);

        number[1] = (number[1].charAt(1) == '0') && (number[1].charAt(2) == '9') && (number[1].charAt(1) != '0') ?
            number[1].replace(number[1].charAt(1), (parseInt(number[1].charAt(1)) + 1).toString()) :
            number[1];
        console.log("5: " + number[1]);

        number[1] = (number[1].charAt(1) == '0') && (number[1].charAt(2) == '9') && (number[1].charAt(0) == '0') ?
            '01' :
            number[1];
        console.log("6: " + number[1]);

        // number[1] = (number[1].charAt(1) == '0') && (number[1].charAt(2) == '9') && (number[1].charAt(0) != '0')  ? 
        //     number[1].replace(number[1].charAt(1),'1') : 
        //     number[1] ;
        // console.log("7: " + number[1]);


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

        // end of on select change

        // END OF PAGINATION
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
            alert("กรุณากรอกตัวเลข");
            return false;
        }
        return true;
    }
</script>