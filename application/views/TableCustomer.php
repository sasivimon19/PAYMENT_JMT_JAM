

<?php if ($Countcustomerall == 0) { ?>

<?php } else { ?>

    <div class="wrapper" style=" padding-top:3%;">   
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header" style="background-color: #E5E7E9">
                                <div class="row">
                                    <div class="col-md-4" style=" color: black;">
                                        <h3 class="card-title"><b> <i class="fas fa-edit"></i> ข้อมูลลูกค้า </b></h3>
                                    </div>

                                </div>
                            </div>
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover">
                                    <thead  style="background-color: gray;">
                                        <tr>
                                            <th style="text-align: center; white-space:nowrap;">#</th>
                                            <th style="text-align: center; white-space:nowrap;">Contract No</th>
                                            <th style="text-align: center; white-space:nowrap;">IDCard</th>
                                            <th style="text-align: center; white-space:nowrap;">Name</th>
                                            <th style="text-align: center; white-space:nowrap;">Product</th>
                                            <th style="text-align: center; white-space:nowrap;">Operator</th>
                                            <th style="text-align: center; white-space:nowrap;">Lot</th>

                                            <th style="text-align: center;">Option</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $num = 1;
                                        foreach ($customerall as $value) {
                                            ?>
                                            <tr>
                                                <td style="white-space:nowrap;"><?php echo $value->row; ?></td>
                                                <td style="text-align: center; white-space:nowrap;"><?php echo $value->contract_no; ?> </td>
                                                <td style="text-align: center; white-space:nowrap;"><?php echo $value->id_no; ?></td>
                                                <td style="white-space:nowrap;"><?php echo iconv('tis-620', 'utf-8', $value->cus_name); ?></td>
                                                <td style="white-space:nowrap;"><?php echo $value->product; ?></td>
                                                <td style="white-space:nowrap;"><?php echo $value->operator_name; ?></td>
                                                <td style="white-space:nowrap;"><?php echo $value->lot_no; ?></td>
                                                <td style="text-align: center;">
                                                <a href="<?php echo site_url('Payment_controller/customer?id=');
                                                echo base64_encode($value->contract_no);  ?>">
                                                <button type="button" class="btn btn-info">Detail</button></a>
                                                </td>
                                            </tr>
                                        <?php $num ++;  } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

<?php } ?>


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
        $(table + ' tr:gt(0)').each(function () {
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
            for (var i = 1; i <= pagenum; ) {
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
        $('.pagination li').on('click', function (evt) {
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
            $(table + ' tr:gt(0)').each(function () {

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








