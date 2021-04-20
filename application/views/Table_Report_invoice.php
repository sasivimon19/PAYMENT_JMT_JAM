<div align="center" style="overflow: auto;">
    <hr style="margin-top: 3px;">
    <?php
    $amount = 0;
    // $vatamount = 0;
    $nn = 0;
    foreach ($report as $key) {
        $amount = $amount + $key->amount;

        // $vatamount = $vatamount + $key->vatamount;
        $nn++;
    } ?>

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
            <!-- <div class="col-md-3">
                <div class="input-group mb-4">
                    <div class="input-group-prepend">
                        <button type="button" class="btn btn-default " style="background-color:#D3D3D3;"><b> Vatamount </b></button>
                    </div>
                    <input style="color: #F0FF03;background-color: black;text-align: right;" id="msg" type="text" class="form-control" name="msg" value="0">
                </div>
            </div> -->
            <!-- <div class="col-md-3">
                 <div class="input-group mb-4">
                    <div class="input-group-prepend">
                        <button type="button" class="btn btn-default " style="background-color: #D3D3D3;"><b> Total </b></button>
                    </div>
                    <input style="color: #F0FF03;background-color: black;text-align: right;" id="msg" type="text" class="form-control" name="msg" value="<?php echo number_format($amount, 2); ?>">
                </div>
            </div> -->
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header" style="background-color: #E5E7E9">
                            <div class="row">
                                <div class="col-md-4" style=" color: black;">
                                    <h5 class="card-title"><b> <i class="fas fa-edit"></i> Invoice </b></h5>
                                </div>
                                <div class="input-group-prepend" style=" margin-left:50%">
                                    <div class="input-group-prepend">
                                        <button type="button" class="btn btn-warning btn-sm" onclick="ShowExportInvoice()"><i class="fas fa-edit"></i> <b>Export Invoice</b></button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover" id="table-data">
                                <thead style="background-color: gray;">
                                    <tr>
                                        <th style="text-align: center;">#</th>
                                        <th style="text-align: center; white-space:nowrap;">วันที่ออกจดหมาย</th>
                                        <th style="text-align: center; white-space:nowrap;">number</th>
                                        <th style="text-align: center; white-space:nowrap;">เลขที่สัญญา</th>
                                        <th style="text-align: center; white-space:nowrap;">เลขที่บัตรประชาชน</th>
                                        <th style="text-align: center; white-space:nowrap;">ชื่อ-สกุล(ลูกค้า)</th>
                                        <th style="text-align: center; white-space:nowrap;">ที่อยู่1</th>
                                        <th style="text-align: center; white-space:nowrap;">ที่อยู่2</th>
                                        <th style="text-align: center; white-space:nowrap;">จังหวัด</th>
                                        <th style="text-align: center; white-space:nowrap;">รหัส</th>
                                        <th style="text-align: center; white-space:nowrap;">amount</th>
                                        <th style="text-align: center; white-space:nowrap;">ตัวอักษรจำนวนเงิน</th>
                                        <th style="text-align: center; white-space:nowrap;">ใบเสร็จรับเงิน</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($report as $key) {
                                    ?>
                                        <tr>
                                            <td><?php echo $no; ?></td>
                                            <td style="white-space: nowrap;"><?php echo date('m-d-Y', strtotime($key->rec_date)); ?></td>
                                            <td style='mso-number-format:"\@"'><?php echo $key->number; ?></td>
                                            <td style="white-space: nowrap;"><?php echo $key->AccNo; ?></td>
                                            <td style="white-space: nowrap;"><?php echo $key->id_no; ?></td>
                                            <td style="white-space: nowrap;"><?php echo iconv('tis-620', 'utf-8', $key->cus_name); ?></td>
                                            <td style="white-space: nowrap;"><?php echo iconv('tis-620', 'utf-8', $key->address1); ?></td>
                                            <td style="white-space: nowrap;"><?php echo iconv('tis-620', 'utf-8', $key->address2); ?></td>
                                            <td style="text-align: center;"><?php echo iconv('tis-620', 'utf-8',  $key->province); ?></td>
                                            <td style="text-align: center;"><?php echo $key->postal; ?></td>
                                            <td style="text-align: right;"><?php echo number_format($key->amount, 2); ?></td>
                                            <td style="text-align: left;white-space: nowrap;"><?php echo iconv('tis-620', 'utf-8', $key->bathtext); ?></td>
                                            <td style="text-align: center;"><?php echo $key->portname; ?></td>
                                        </tr>
                                    <?php $no++;
                                    }
                                    ?>

                                    <?php
                                    $num_amount = 0;
                                    $num_sum = 0;
                                    $x = 0;
                                    $y = 0;
                                    $z = 0;
                                    foreach ($report as $row) {
                                        $x = $row->amount;
                                        // $y = $row->vatamount;
                                        // $z = $row->amount + $row->vatamount;

                                        $num_amount = $x + $num_amount;
                                        // $num_vatamount = $y + $num_vatamount;
                                        // $num_sum = $z + $num_sum;
                                    } ?>

                                    <tr style="display: none;">
                                        <td style="text-align: center; font-weight: bold;"></td>
                                        <td style="text-align: center; font-weight: bold;"><b>Grand Total</b></td>
                                        <td style="text-align: center; font-weight: bold;"></td>
                                        <td style="text-align: center; font-weight: bold;"></td>
                                        <td style="text-align: center; font-weight: bold;"></td>
                                        <td style="text-align: center; font-weight: bold;"></td>
                                        <td style="text-align: center; font-weight: bold;"></td>
                                        <td style="text-align: center; font-weight: bold;"></td>
                                        <td style="text-align: center; font-weight: bold;"></td>
                                        <td style="text-align:  right; font-weight: bold;"><b><?php echo number_format($num_amount, 2); ?></b></td>
                                        <td style="text-align: center; font-weight: bold;"></td>
                                        <td style="text-align: center; font-weight: bold;"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>


                        <ul class="pagination justify-content-center">
                            <li class="page-item" data-page="prev"><a class="page-link" href="#">Previous</a></li>
                            <li class="page-item" data-page="next" id="prev"><a class="page-link" href="#">Next</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>


<script type="text/javascript">
    function ShowExportInvoice() {

        document.getElementById('overlay').style.display = "block";

        var datestart = document.getElementById('datestartinvoice').value;
        var dateend = document.getElementById('dateendinvoice').value;
        var lot = document.getElementById('lotinvoice').value;
        var Operator = document.getElementById('Operatorinvoice').value;

        window.location.href = '<?php echo site_url('Export_report/ExportInvoice?') ?>Operator=' + Operator + "&lot=" + lot + "&datestart=" + datestart + "&dateend=" + dateend;

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