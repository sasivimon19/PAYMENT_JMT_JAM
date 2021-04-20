<div align="center" style="overflow: auto;">
    <?php
    $amount = 0;
    $vatamount = 0;
    $nn = 0;
    foreach ($report as $key) {
        $amount = $amount + $key->SUM_AMOUNT;
        $vatamount = $vatamount + $key->SUM_VATAMOUNT;
        $nn++;
    } ?>


    <div class="col-md-12">
        <div class="row" style=" margin-top: 0%;">
            <div class="col-md-3">
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <button type="button" class="btn btn-default " style="background-color: #D3D3D3;"><b> จำนวนรายการ </b></button>
                    </div>
                    <input style="color: #F0FF03;background-color: black;text-align: right;" id="msg" type="text" class="form-control" name="msg" value="<?php echo number_format($nn); ?>">
                </div>
            </div>
            <div class="col-md-3">
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <button type="button" class="btn btn-default " style="background-color: #D3D3D3;"><b> Amount </b></button>
                    </div>
                    <input style="color: #F0FF03;background-color: black;text-align: right;" id="msg" type="text" class="form-control" name="msg" value="<?php echo number_format($amount, 2); ?>">
                </div>
            </div>
            <div class="col-md-3">
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <button type="button" class="btn btn-default " style="background-color:#D3D3D3;"><b> Vatamount </b></button>
                    </div>
                    <input style="color: #F0FF03;background-color: black;text-align: right;" id="msg" type="text" class="form-control" name="msg" value="<?php echo number_format($vatamount, 2); ?>">
                </div>
            </div>
            <div class="col-md-3">
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <button type="button" class="btn btn-default " style="background-color: #D3D3D3;"><b> Total </b></button>
                    </div>
                    <input style="color: #F0FF03;background-color: black;text-align: right;" id="msg" type="text" class="form-control" name="msg" value="<?php echo number_format($amount + $vatamount, 2); ?>">
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header" style="background-color: #E5E7E9">
                            <div class="row">
                                <div class="col-md-7" style=" color: black;">
                                    <h3 class="card-title"><b> <i class="fas fa-edit"></i>Export Tax Report</b></h3>
                                </div>
                                <div class="input-group-prepend" style=" margin-left:25%">
                                    <div class="input-group-prepend">
                                        <button type="button" class="btn btn-warning btn-sm" onclick="Export_SumTax_Report()"><i class="fas fa-edit"></i> <b>Export SumTax Report</b></button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover" id="table-data">
                                <thead style="background-color: gray;">
                                    <tr style="background-color:#040404;color: #FFFFFF;">
                                        <th style="text-align: center;">NO</th>
                                        <th style="text-align: left;">LSIT_PRODUCT</th>
                                        <th style="text-align: right;">SUM_BF_AMOUNT</th>
                                        <th style="text-align: right;">SUM_VATAMOUNT</th>
                                        <th style="text-align: right;">SUM_AMOUNT</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($report as $key) {
                                    ?>
                                        <tr>
                                            <td><?php echo $no; ?></td>
                                            <td style="text-align: left;"><?php echo $key->LSIT_PRODUCT; ?></td>
                                            <td style="text-align: right;"><?php echo number_format($key->SUM_BF_AMOUNT, 2); ?></td>
                                            <td style="text-align: right;"><?php echo number_format($key->SUM_VATAMOUNT, 2); ?></td>
                                            <td style="text-align: right;"><?php echo number_format($key->SUM_AMOUNT, 2); ?></td>
                                        </tr>
                                    <?php $no++;
                                    } ?>

                                    <?php
                                    $amount = 0;
                                    $vatamount = 0;
                                    $nn = 0;
                                    foreach ($report as $key) {
                                        $amount = $amount + $key->SUM_AMOUNT;
                                        $vatamount = $vatamount + $key->SUM_VATAMOUNT;
                                        $nn++;
                                    } ?>
                                    <tr style="display: none; background-color: #E5E7E9">
                                        <td></td>
                                        <td style="font-size: 1.2em;"><b>Grand Total</b></td>
                                        <td style="text-align: right;font-size: 1.2em;"><b><?php echo number_format($amount, 2); ?></b></td>
                                        <td style="text-align: right;font-size: 1.2em;"><b><?php echo number_format($vatamount, 2); ?></b></td>
                                        <td style="text-align: right;font-size: 1.2em;"><b><?php echo number_format($amount + $vatamount, 2); ?></b></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <ul class="pagination justify-content-center">
        <li class="page-item" data-page="prev"><a class="page-link" href="#">Previous</a></li>
        <li class="page-item" data-page="next" id="prev"><a class="page-link" href="#">Next</a></li>
    </ul>



    <script type="text/javascript">
        function Export_SumTax_Report() {

            document.getElementById('overlay').style.display = "block";

            var date = document.getElementById('date').value;
            var dateendsumtex = document.getElementById('dateendsumtex').value;
            var lot = document.getElementById('lot').value;
            var Operator = document.getElementById('Operator').value;

            window.location.href = '<?php echo site_url('Export_report/ExportSumTaxReport?') ?>date=' + date + "&dateendsumtex=" + dateendsumtex + "&lot=" + lot + "&Operator=" + Operator;

            $('#overlay').fadeOut(3000);
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