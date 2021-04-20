<div align="center" style="overflow: auto;">
    <hr style="margin-top: 3px;">
    <?php
    $amount = 0;
    $vatamount = 0;
    $beinmonth = 0;
    $nn = 0;
    foreach ($report as $key) {

        $amount = $amount + $key->beinmonth;
        $vatamount = $vatamount + $key->rpinmonth;
        $beinmonth = $beinmonth + $key->endingmonth;
        $nn++;
    } ?>

    <?php foreach ($search_count as $keycount) {

        $numrow  = $keycount->NUMCOUNT;
    } ?>

    <div class="col-md-12">
        <div class="row" style=" margin-top: 0%;">
            <div class="col-md-3">
                <div class="input-group mb-4">
                    <div class="input-group-prepend">
                        <button type="button" class="btn btn-default " style="background-color: #D3D3D3;"><b> จำนวนรายการ </b></button>
                    </div>
                    <input style="color: #F0FF03;background-color: black;text-align: right;" id="msg" type="text" class="form-control" name="msg" value="<?php echo number_format($numrow); ?>">
                </div>
            </div>
            <div class="col-md-3">
                <div class="input-group mb-4">
                    <div class="input-group-prepend">
                        <button type="button" class="btn btn-default " style="background-color: #D3D3D3;"><b> Beginning Balance </b></button>
                    </div>
                    <input style="color: #F0FF03;background-color: black;text-align: right;" id="msg" type="text" class="form-control" name="msg" value="<?php echo number_format($amount, 2); ?>">
                </div>
            </div>
            <div class="col-md-3">
                <div class="input-group mb-4">
                    <div class="input-group-prepend">
                        <button type="button" class="btn btn-default " style="background-color:#D3D3D3;"><b> Receive in this month </b></button>
                    </div>
                    <input style="color: #F0FF03;background-color: black;text-align: right;" id="msg" type="text" class="form-control" name="msg" value="<?php echo number_format($vatamount, 2); ?>">
                </div>
            </div>
            <div class="col-md-3">
                <div class="input-group mb-4">
                    <div class="input-group-prepend">
                        <button type="button" class="btn btn-default " style="background-color: #D3D3D3;"><b> Endingmonth </b></button>
                    </div>
                    <input style="color: #F0FF03;background-color: black;text-align: right;" id="msg" type="text" class="form-control" name="msg" value="<?php echo number_format($beinmonth, 2); ?>">
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
                                    <h3 class="card-title"><b> <i class="fas fa-edit"></i>Outstanding Report(Detail)</b></h3>
                                </div>
                                <div class="input-group-prepend" style=" margin-left:15%">
                                    <div class="input-group-prepend">
                                        <button type="button" class="btn btn-warning btn-sm" onclick="Export_OutstandingReportDetai()"><i class="fas fa-edit"></i> <b>Outstanding Report(Detail)</b></button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover" id="table-data">
                                <thead style="background-color: gray;">
                                    <tr style="background-color:#040404;color: #FFFFFF;">
                                        <th>No</th>
                                        <th>Product</th>
                                        <th>Lot No</th>
                                        <th>contract_no</th>
                                        <th style="text-align: right;">Before_amt</th>
                                        <th style="text-align: right;">amount</th>
                                        <th style="text-align: right;">Endingmonth</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($report as $key) {
                                    ?>
                                        <tr>
                                            <td><?php echo $key->row; ?></td>
                                            <td><?php echo $key->product; ?></td>
                                            <td><?php echo $key->lot_no; ?></td>
                                            <td><?php echo $key->contract_no; ?></td>
                                            <td style="text-align: right;"><?php echo number_format($key->beinmonth, 2); ?></td>
                                            <td style="text-align: right;"><?php echo number_format($key->rpinmonth, 2); ?></td>
                                            <td style="text-align: right;"><?php echo number_format($key->endingmonth, 2); ?></td>
                                        </tr>
                                    <?php $no++;
                                    } ?>

                                    <?php
                                    $amount = 0;
                                    $vatamount = 0;
                                    $beinmonth = 0;
                                    $nn = 0;
                                    foreach ($report as $key) {
                                        $amount = $amount + $key->beinmonth;
                                        $vatamount = $vatamount + $key->rpinmonth;
                                        $beinmonth = $beinmonth + $key->endingmonth;
                                        $nn++;
                                    } ?>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td style="font-size: 1.2em;"><b>Grand Total</b></td>
                                        <td></td>
                                        <td style="text-align: right;font-size: 1.2em;"><b><?php echo number_format($amount, 2); ?></b></td>
                                        <td style="text-align: right;font-size: 1.2em;"><b><?php echo number_format($vatamount, 2); ?></b></td>
                                        <td style="text-align: right;font-size: 1.2em;"><b><?php echo number_format($beinmonth, 2); ?></b></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php foreach ($search_count as $row) { ?>
        <?php $total_record = $row->NUMCOUNT; ?>

    <?php } ?>

    <?php $total_page = ceil($total_record / $pageend); ?>
    <div class="card-footer clearfix">
        <ul class="pagination">
            <li class="page-item" style="margin-top: 5px;">ทั้งหมด <?php echo $total_page ?> รายการ&nbsp;</li>
            <li class="page-item">
                <select class="form-control form-control-sm" name="page" id="page" onchange="pagedatapay()">
                    <?php for ($i = 1; $i <= $total_page; $i++) { ?>
                        <?php if ($i == $pagenum) { ?>
                            <option value="<?php echo $i ?>" selected><?php echo $i ?></option>
                        <?php } else { ?>
                            <option value="<?php echo $i ?>"><?php echo $i ?></option>
                        <?php } ?>
                    <?php } ?>
                </select>
            </li>
        </ul>
    </div>




    <script>
        function pagedatapay() { //แนบตัวแปร page ไปด้วย

            var datedetail = document.getElementById('datedetail').value;
            var lot = document.getElementById('lot').value;
            var Operator = document.getElementById('Operator').value;
            var page = document.getElementById('page').value;

            var datas = "datedetail=" + datedetail + "&lot=" + lot + "&Operator=" + Operator + "&page=" + page;

            document.getElementById('overlay').style.display = "block";

            $.ajax({
                type: "POST",
                url: "<?php echo site_url('Payment_controller/OutstandingReportdetailview') ?>",
                data: datas,
            }).done(function(data) {
                $('#show').html(data); //Div ที่กลับมาแสดง
                document.getElementById('overlay').style.display = "none";
            })
        }
    </script>


    <script type="text/javascript">
        function Export_OutstandingReportDetai() {

            document.getElementById('overlay').style.display = "block";

            var datedetail = document.getElementById('datedetail').value;
            var lot = document.getElementById('lot').value;
            var Operator = document.getElementById('Operator').value;
            
            window.location.href = '<?php echo site_url('Export_report/Export_Outstanding_Report_Detail?') ?>datedetail=' + datedetail + "&lot=" + lot + "&Operator=" + Operator;
            $('#overlay').fadeOut(4000);
        }
    </script>