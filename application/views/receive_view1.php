<div align="center" style="overflow: auto;">
    <hr style="margin-top: 3px;">
    <?php
    $amount = 0;
    $vatamount = 0;
    $nn = 0;
    foreach ($receive as $key) {
        $amount = $amount + $key->amount;
        $vatamount = $vatamount + $key->vatamount;
        $nn++;
    } ?>
    <!--    <div style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);width: 99%;margin-bottom: 5px;border-radius: 5px;padding: 5px;">
        <p style="width: 100%;background-color: red;border-radius: 5px;"><b>Grand Total</b></p>
        <table style="width: 100%;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);border-radius: 5px;">
            <tr style="">
                <td style="padding: 3px;">
                    <div class="input-group">
                        <span class="input-group-addon">จำนวนรายการ</span>
                        <input style="color: #F0FF03;background-color: black;text-align: right;" id="msg" type="text" class="form-control" name="msg" value="<?php echo number_format($nn); ?>">
                    </div>
                </td>
                <td style="padding: 3px;">
                    <div class="input-group">
                        <span class="input-group-addon">Amount</span>
                        <input style="color: #F0FF03;background-color: black;text-align: right;" id="msg" type="text" class="form-control" name="msg" value="<?php echo number_format($amount, 2); ?>">
                    </div>
                </td>
                <td style="padding: 3px;">
                    <div class="input-group">
                        <span class="input-group-addon">Vatamount</span>
                        <input style="color: #F0FF03;background-color: black;text-align: right;" id="msg" type="text" class="form-control" name="msg" value="<?php echo number_format($vatamount, 2); ?>">
                    </div>
                </td>
                <td style="padding: 3px;">
                    <div class="input-group">
                        <span class="input-group-addon">Total</span>
                        <input style="color: #F0FF03;background-color: black;text-align: right;" id="msg" type="text" class="form-control" name="msg" value="<?php echo number_format($amount + $vatamount, 2); ?>">
                    </div>
                </td>
            </tr>
        </table>
    </div>-->

    <div class="col-md-12">
        <div class="row" style=" margin-top: 2%;">
            <div class="col-md-3">
                <div class="input-group mb-4">
                    <div class="input-group-prepend">
                        <button type="button" class="btn btn-default " style="background-color: #D3D3D3;"><b> จำนวนรายการ </b></button>
                    </div>
                    <input style="color: #F0FF03;background-color: black;text-align: right;" id="msg" type="text" class="form-control" name="msg" value="<?php echo number_format($nn); ?>">
                </div>
            </div>
            <div class="col-md-3">
                <div class="input-group mb-4">
                    <div class="input-group-prepend">
                        <button type="button" class="btn btn-default " style="background-color: #D3D3D3;"><b> Amount </b></button>
                    </div>
                    <input style="color: #F0FF03;background-color: black;text-align: right;" id="msg" type="text" class="form-control" name="msg" value="<?php echo number_format($amount, 2); ?>">
                </div>
            </div>
            <div class="col-md-3">
                <div class="input-group mb-4">
                    <div class="input-group-prepend">
                        <button type="button" class="btn btn-default " style="background-color:#D3D3D3;"><b> Vatamount </b></button>
                    </div>
                    <input style="color: #F0FF03;background-color: black;text-align: right;" id="msg" type="text" class="form-control" name="msg" value="<?php echo number_format($vatamount, 2); ?>">
                </div>
            </div>
            <div class="col-md-3">
                <div class="input-group mb-4">
                    <div class="input-group-prepend">
                        <button type="button" class="btn btn-default " style="background-color: #D3D3D3;"><b> Total </b></button>
                    </div>
                    <input style="color: #F0FF03;background-color: black;text-align: right;" id="msg" type="text" class="form-control" name="msg" value="<?php echo number_format($amount + $vatamount, 2); ?>">
                </div>
            </div>
        </div>
    </div>
    <!-- <br> -->

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header" style="background-color: #E5E7E9">
                            <div class="row">
                                <div class="col-md-4" style=" color: black;">
                                    <h5 class="card-title"><b> <i class="fas fa-edit"></i>Summary Report Operator of Mounth</b></h5>
                                </div>
                                <div class="input-group-prepend" style=" margin-left:38%">
                                    <div class="input-group-prepend">
                                        <button type="button" class="btn btn-warning btn-sm" onclick="ExportSummaryOperatorMounth()"><i class="fas fa-edit"></i> <b>Summary Report By Operator of Mounth</b></button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover" id="table-data">
                                <thead style="background-color: gray;">
                                    <tr>
                                        <th style="text-align: center;">#</th>
                                        <th style="text-align: center; white-space:nowrap;">Rec Date</th>
                                        <th style="text-align: center; white-space:nowrap;">Contract No</th>
                                        <th style="text-align: center; white-space:nowrap;">Cus Name</th>
                                        <th style="text-align: center; white-space:nowrap;">ID No</th>
                                        <th style="text-align: center; white-space:nowrap;">Amount</th>
                                        <th style="text-align: center; white-space:nowrap;">Vatamount</th>
                                        <th style="text-align: center; white-space:nowrap;">Total</th>
                                        <th style="text-align: center; white-space:nowrap;">E Balance</th>
                                        <th style="text-align: center; white-space:nowrap;">Chennel</th>
                                        <th style="text-align: center; white-space:nowrap;">Refno2</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($receive as $key) {
                                    ?>
                                        <tr>
                                            <td><?php echo $no; ?></td>
                                            <td style="white-space: nowrap;"><?php echo date('m-d-Y', strtotime($key->rec_date)); ?></td>
                                            <td style="white-space: nowrap;"><?php echo $key->contract_no; ?></td>
                                            <td style="white-space: nowrap;"><?php echo $key->id_no; ?></td>
                                            <td style="white-space: nowrap;"><?php echo iconv('tis-620', 'utf-8', $key->cus_name); ?></td>
                                            <td style="text-align: right;"><?php echo number_format($key->amount, 2); ?></td>
                                            <td style="text-align: right;"><?php echo number_format($key->vatamount, 2); ?></td>
                                            <td style="text-align: right;"><?php echo number_format($key->amount + $key->vatamount, 2); ?></td>
                                            <td style="text-align: right;"><?php echo number_format($key->e_balance, 2); ?></td>
                                            <td style="white-space: nowrap;"><?php echo $key->chennel; ?></td>
                                            <td style="white-space: nowrap;"><?php echo date('m-d-Y', strtotime($key->refno2)); ?></td>
                                        </tr>
                                    <?php $no++;
                                    }
                                    ?>

                                    <?php
                                    $num_amount = 0;
                                    $num_vatamount = 0;
                                    $num_sum = 0;
                                    $x = 0;
                                    $y = 0;
                                    $z = 0;
                                    foreach ($receive as $row) {
                                        $x = $row->amount;
                                        $y = $row->vatamount;
                                        $z = $row->amount + $row->vatamount;

                                        $num_amount = $x + $num_amount;
                                        $num_vatamount = $y + $num_vatamount;
                                        $num_sum = $z + $num_sum;
                                    }
                                    ?>
                                    <tr style="display: none;">
                                        <td style="font-size: 1.2em;"><b>Grand Total</b></td>
                                        <!-- <td></td> -->
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td style="text-align: right;font-size: 1.2em;"><b><?php echo number_format($num_amount, 2); ?></b></td>
                                        <td style="text-align: right;font-size: 1.2em;"><b><?php echo number_format($num_vatamount, 2); ?></b></td>
                                        <td style="text-align: right;font-size: 1.2em;"><b><?php echo number_format($num_sum, 2); ?></b></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <br>
                        <ul class="pagination justify-content-center">
                            <li class="page-item" data-page="prev"><a class="page-link" href="#">Previous</a></li>
                            <li class="page-item" data-page="next" id="prev"><a class="page-link" href="#">Next</a></li>
                        </ul>

                        <!-- <//?php foreach ($Countreceiveoperatormounth as $row) { ?>
                            <//?php  $total_record = $row->Count; ?>
                        <//?php } ?>  -->


                        <!-- <//?php $total_page = ceil($total_record / $pageend); ?>  -->
                        <!-- <div class="card-footer clearfix">
                            <center>
                                <ul class="pagination pagination-sm m-0">
                                    <li class="page-item" style="margin-top: 5px;">ทั้งหมด <//?php echo $total_page ?> รายการ </li>&nbsp;
                                    <li class="page-item">
                                        <select class="form-control form-control-sm" name="page" id="page" onchange="pagedatapay()">
                                            <//?php for ($i = 1; $i <= $total_page; $i++) {
                                                if ($i == $numpage) {
                                                    ?>
                                                    <option value="<//?php echo $i ?>" selected><//?php echo $i ?></option>
                                                <//?php } else { ?>
                                                    <option value="<//?php echo $i ?>" ><//?php echo $i ?></option>
                                                <//?php } ?>
                                            <//?php } ?>
                                        </select>
                                    </li>
                                </ul>
                            </center>
                        </div> -->

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- <hr> -->
    <!-- <a href="<//?php //echo site_url('Payment_controller/daily_PDF')
    /?>"><button type="submit" class="btn btn-primary">PDF</button></a> -->
</div>

<!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script> -->




<!--<script>
    $(document).ready(function () {
        $('#myTable1').DataTable({
            "pageLength": 50,
            dom: 'Bfrtip',
            buttons: [
            {
                extend: 'excel',
                messageTop: '<//?php echo $lot . $OPP . " " . "For the daily" . " " . $date ?>'
            }
            ]
        });
    });
</script>-->


<script type="text/javascript">
    function ExportSummaryOperatorMounth() {

        document.getElementById('overlay').style.display = "block";

        var lotoperatorMonth = document.getElementById('lotoperatorMonth').value;
        var OperatorMonth = document.getElementById('OperatorMonth').value;
        var datestartoperatorMonth = document.getElementById('datestartoperatorMonth').value;
        var datestartoperatorMonth2 = document.getElementById('datestartoperatorMonth2').value;;

        window.location.href = '<?php echo site_url('Export_report/Export_Summary_Operator_Mounth?') ?>OperatorMonth=' + OperatorMonth + "&lotoperatorMonth=" + lotoperatorMonth + "&datestartoperatorMonth=" + datestartoperatorMonth + "&datestartoperatorMonth2=" + datestartoperatorMonth2;

         $('#overlay').fadeOut(3000);
    }
</script>




<script type="text/javascript">
    function PDF() {
        var datestart = document.getElementById('datestart').value;
        var lot = document.getElementById('lot').value;
        var Operator = document.getElementById('Operator').value;

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Payment_controller/daily_PDF') ?>",
            data: $("#scan").serialize(),
        }).done(function(data) {
            // alert(data); 
        })
    }
</script>

<script type="text/javascript">
    function Excel() {
        var datestart = document.getElementById('datestart').value;
        var lot = document.getElementById('lot').value;
        var Operator = document.getElementById('Operator').value;

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Payment_controller/daily_Excel') ?>",
            data: $("#scan").serialize(),
        }).done(function(data) {
            // alert(data);
        })
    }
</script>



<script>
    getPagination('#table-data');

    function getPagination(table) {

        var lastPage = 1;

        $('.pagination')
            .find('li')
            .slice(1, -1)
            .remove();
        var trnum = 0;
        maxRows = 10;

        $('.pagination').show();

        var totalRows = $(table + ' tbody tr').length;
        $(table + ' tr:gt(0)').each(function() {
            trnum++;
            if (trnum > maxRows) {
                $(this).hide();
            }
            if (trnum <= maxRows) {
                $(this).show();
            }
        });

        if (totalRows > maxRows) {
            var pagenum = Math.ceil(totalRows / maxRows);
            for (var i = 1; i <= pagenum;) {
                $('.pagination #prev')
                    .before(
                        '<li class="page-item"data-page="' +
                        i +
                        '">\
                        <a class="page-link" href="#">' +
                        i++ +
                        '</a>\
                    </li>')
                    .show();
            }
        } else {
            $('.pagination').hide();
        }

        $('.pagination [data-page="1"]').addClass('active');
        $('.pagination li').on('click', function(evt) {
            evt.stopImmediatePropagation();
            evt.preventDefault();
            var pageNum = $(this).attr('data-page');
            var maxRows = 10;
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
            var trIndex = 0;
            $('.pagination li').removeClass('active');
            $('.pagination [data-page="' + lastPage + '"]').addClass('active');

            limitPagging();
            $(table + ' tr:gt(0)').each(function() {

                trIndex++;
                if (
                    trIndex > maxRows * pageNum ||
                    trIndex <= maxRows * pageNum - maxRows
                ) {
                    $(this).hide();
                } else {
                    $(this).show();
                }
            });
        });

        limitPagging();


    }

    function limitPagging() {


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
</script>