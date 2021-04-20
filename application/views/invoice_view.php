<link href="<?php echo base_url(); ?>assets/sweetalert/dist/sweetalert.css" rel="stylesheet" type="text/css">
<script src="<?php echo base_url(); ?>assets/sweetalert/dist/sweetalert.min.js"></script>
<script src="<?php echo base_url(); ?>AdminLTE/plugins/jquery/jquery.min.js"></script>

<style type="text/css">
    th,
    td {
        white-space: nowrap;
    }
</style>


<!-- <hr style="margin-bottom: 0px;margin-top: px;"> -->

<!-- <br> -->
<div class="col-md-12">
    <?php
    $vat = 0;
    $amount = 0;
    foreach ($invoice as $row) {
        $sumamount = $row->amount;
        $amount = $amount + $sumamount;

        $Sumvat = $row->vatamount;
        $vat = $vat + $Sumvat;
    ?>
    <?php } ?>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-3">
            <div class="info-box mb-3 bg-warning">
                <span class="info-box-icon"><i class="fas fa-tag"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text"><b>จำนวนรายการ : </b></span>
                    <input style="text-align: center;background: #000000;color: #F0FF03;width: 100%;  font-weight: 900;" type="text" class="form-control form-control-sm" id="usr" name="username" value="<?php echo number_format(count($invoice)); ?>" readonly>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-box mb-3 bg-success">
                <span class="info-box-icon"><i class="fas fa-tag"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text"><b>ยอดชำระรวม : </b></span>
                    <input style="text-align: right;background: #000000;color: #F0FF03;width: 100%;  font-weight: 900;" type="text" class="form-control form-control-sm" id="usr" name="username" value="<?php echo number_format($amount, 2); ?>" readonly>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-box mb-3 bg-info">
                <span class="info-box-icon"><i class="fas fa-tag"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text"><b>ยอดรวม VAT : </b></span>
                    <b><input style="text-align: right;background: #000000;color: #F0FF03; width: 100%;  font-weight: 900;" type="text" class="form-control form-control-sm" id="usr" name="username" value="<?php echo number_format($vat, 2); ?>" readonly></b>
                </div>

            </div>
        </div>
        <div class="col-md-1"></div>
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
                                <h3 class="card-title"><b> <i class="fas fa-edit"></i> แสดงข้อมูลค้นหา</b></h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover" id="table-data">
                            <thead style="background-color: gray;">
                                <tr style="background-color:#040404;color: #FFFFFF;">
                                    <th style="text-align: center;">No</th>
                                    <th>Rec_date</th>
                                    <th>Channel</th>
                                    <th>Contract No</th>
                                    <th>Ref no1.</th>
                                    <th>Ref no2.</th>
                                    <th>Amount</th>
                                    <th>VAT</th>
                                    <th>State</th>
                                    <th>Type</th>
                                    <th>Lot</th>
                                    <th>IDCard</th>
                                    <th>Invoice No</th>
                                    <th>Textbath</th>
                                </tr>
                            </thead>
                            <?php $no = 1;
                            foreach ($invoice as $key) {
                                $num_Invoice = 'num_Invoice' . $no;
                                $r_index = $key->r_index;
                            ?>

                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td style="white-space: nowrap;"><?php echo date('d-m-Y', strtotime($key->rec_date)); ?></td>
                                    <td><?php echo iconv('tis-620', 'utf-8', $key->chennel); ?></td>
                                    <td><?php echo $key->contract_no; ?></td>
                                    <td><?php echo iconv('tis-620//ignore', 'utf-8//ignore', $key->refno1); ?></td>
                                    <td style="white-space: nowrap;"><?php echo date('d-m-Y', strtotime($key->refno2)); ?></td>
                                    <td style="text-align: right;"><?php echo number_format($key->amount, 2); ?></td>
                                    <td style="text-align: right;"><?php echo number_format($key->vatamount, 2); ?></td>
                                    <td style="text-align: center;"><?php echo $key->state; ?></td>
                                    <td style="text-align: center;"><?php echo $key->keytype; ?></td>
                                    <td><?php echo $key->lot; ?></td>
                                    <td><?php echo $key->id_no; ?></td>
                                    <td style="color: red;"><?php echo $$num_Invoice; ?></td>

                                    <td style="white-space: nowrap;">
                                        <?php
                                        echo $r_index . ' -= ' . iconv('tis-620', 'utf-8', $key->Textbath) . ' =- ';
                                        ?>
                                    </td>
                                </tr>
                            <?php $no++;
                            } ?>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<div style="text-align: right;">
    <form id="Invoiceupdatet" name="Invoiceupdatet" action="<?php echo site_url('Payment_controller/Invoice_updatet'); ?>" method="post" enctype="multipart/form-data">
        <div style="display: none;">
            <?php $no = 1;
            foreach ($invoice as $key) { ?>
                <input type="text" name="<?php echo "contract_no-" . $no; ?>" id="<?php echo "contract_no-" . $no; ?>" value="<?php echo $key->contract_no; ?>">
                <input type="text" name="<?php echo "state-" . $no; ?>" id="<?php echo "state-" . $no; ?>" value="<?php echo $key->state; ?>">
                <input type="text" name="<?php echo "IDCard-" . $no; ?>" id="<?php echo "IDCard-" . $no; ?>" value="<?php echo $key->id_no; ?>">
                <input type="text" name="<?php echo "amount-" . $no; ?>" id="<?php echo "amount-" . $no; ?>" value="<?php echo $key->amount; ?>">
                <input type="text" name="<?php echo "channel-" . $no; ?>" id="<?php echo "channel-" . $no; ?>" value="<?php echo $key->chennel; ?>">
                <input type="text" name="<?php echo "Lot-" . $no; ?>" id="<?php echo "Lot-" . $no; ?>" value="<?php echo $key->lot; ?>">
                <input type="text" name="<?php echo "refno2-" . $no; ?>" id="<?php echo "refno2-" . $no; ?>" value="<?php echo $key->refno2; ?>">
                <input type="text" name="<?php echo "r_index-" . $no; ?>" id="<?php echo "r_index-" . $no; ?>" value="<?php echo $key->r_index; ?>">
            <?php $no++;
            } ?>
            <input type="text" name="sum" id="sum" value="<?php echo count($invoice); ?>">
        </div>

        <div class="card-footer">
            <?php if (count($invoice) == 0) { ?>
                <button type="button" class="btn btn-success " onclick="save()" disabled>Save Invoice</button>
            <?php } else { ?>
                <?php if ($key->state == 1) { ?>
                    <button type="button" class="btn btn-success" onclick="save()">Save Invoice</button>
                <?php }
                if ($key->state != 1) { ?>
                    <button type="button" class="btn btn-success" onclick="save()" disabled>Save Invoice</button>
            <?php }
            } ?>
        </div>
    </form>
</div>

<script type="text/javascript">
    function save() {

        var num = document.getElementById('sum').value;
        var datestart = document.getElementById('datestart').value;
        var dateend = document.getElementById('dateend').value;
        var lot = document.getElementById('lot').value;
        var Operator = document.getElementById('Operator').value;
        var idcustomer = document.getElementById('idcustomer').value;
        var status = document.getElementById('status').value;
        var Invoice = document.getElementById('Invoice').value;


        // var contract_no = document.getElementById('contract_no-').value;
        // var state = document.getElementById('state').value;
        // var IDCard = document.getElementById('IDCard').value;
        // var amount = document.getElementById('amount').value;
        // var channel = document.getElementById('channel').value;
        // var Lot = document.getElementById('Lot').value;
        // var Operator = document.getElementById('Operator').value;
        // var Invoice = document.getElementById('Invoice').value;
        // var viewrefno2 = document.getElementById('refno2').value;
        // var r_index = document.getElementById('r_index').value;
        // var i = $k;

        swal({
                title: "คุณแน่ใจหรือไม่ที่จะ SAVE invoice",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-primary",
                confirmButtonText: "APPROVE!",
                cancelButtonText: "ไม่ APPROVE!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        type: "POST",
                        url: "<?php echo site_url('Payment_controller/Invoice_updatet') ?>",
                        data: $("#Invoiceupdatet").serialize() + "&num=" + num + "&datestart=" + datestart +
                            "&dateend=" + dateend + "&status=" + status + "&Operator=" + Operator +
                            "&idcustomer=" + idcustomer + "&lot=" + lot + "&Invoice=" + Invoice,
                    }).done(function(data) {
                        swal({
                                title: "APPROVE ข้อมูลสำเร็จ",
                                type: "success"
                            },
                            function() {
                                location.replace("invoice");
                            });
                    })
                } else {
                    swal("ไม่ APPROVE ข้อมูล", "", "error");
                }
            });
    }
</script>

<!-- <script type="text/javascript">
    function save() {

        var num = document.getElementById('sum').value;

        for ($k = 1; $k <= num; $k++) {

            var contract_no = document.getElementById('contract_no-' + $k).value;
            var state = document.getElementById('state-' + $k).value;
            var IDCard = document.getElementById('IDCard-' + $k).value;
            var amount = document.getElementById('amount-' + $k).value;
            var channel = document.getElementById('channel-' + $k).value;
            var Lot = document.getElementById('Lot-' + $k).value;
            var Operator = document.getElementById('Operator').value;
            var Invoice = document.getElementById('Invoice').value;
            var viewrefno2 = document.getElementById('refno2-' + $k).value;
            var r_index = document.getElementById('r_index-' + $k).value;
            var i = $k;

            var data = "contract_no=" + contract_no + "&state=" + state + "&IDCard=" + IDCard + 
            "&amount=" + amount + "&channel=" + channel + "&Lot=" + Lot + "&num=" + num +
             "&Operator=" + Operator + "&Invoice=" + Invoice + "&viewrefno2=" + viewrefno2 
             + "&r_index=" + r_index + "&i=" + i;

            alert(state);

            swal({
                    title: "Run Invoice!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-primary",
                    confirmButtonText: "Run Invoice!",
                    cancelButtonText: "ไม่ Run Invoice!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            type: "POST",
                            url: "<?php echo site_url('Payment_controller/Invoice_updatet') ?>",
                            data: data,
                        }).done(function(data) {
                            swal({
                                    title: "Run Invoice สำเร็จ",
                                    type: "success"
                                },
                                function() {
                                    location.replace("invoice");
                                });
                        })
                    } else {
                        swal("ไม่ Run Invoice ", "", "error");

                    }
                });
        }
    }
</script> -->