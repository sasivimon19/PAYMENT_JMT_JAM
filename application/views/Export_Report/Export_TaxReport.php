<?php

header("Content-type: application/csv");
header("Content-Disposition: attachment; filename=\"Export Tax Report" . ".xls\"");
header("Pragma: no-cache");
header("Expires: 0");
?>

<meta charset="UTF-8">
<?php
$amount = 0;
$vatamount = 0;
$nn = 0;
foreach ($report as $key) {
    $amount = $amount + $key->amount;
    $vatamount = $vatamount + $key->vatamount;
    $nn++;
} ?>

<body>
    <table border="1" class="table" width=40%>
        <thead>
            <tr>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">No</th>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">วันที่</th>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">เลขที่</th>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">เลชที่สัญญาลูกค้า</th>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">ชื่อลูกค้า</th>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">จำนวนเงิน</th>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">ภาษี</th>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">จำนวนรวม</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($report as $key) {
            ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo date('Y-d-m', strtotime($key->rec_date)); ?></td>
                    <td style='mso-number-format:"\@"'><?php echo $key->invoiceno; ?></td>
                    <td style='mso-number-format:"\@"'><?php echo $key->contract_no; ?></td>
                    <td style="white-space: nowrap;"><?php echo iconv('tis-620', 'utf-8', $key->cus_name); ?></td>
                    <td style="text-align: right;"><?php echo number_format($key->amount, 2); ?></td>
                    <td style="text-align: right;"><?php echo number_format($key->vatamount, 2); ?></td>
                    <td style="text-align: right;"><?php echo number_format($key->amount + $key->vatamount, 2); ?></td>
                </tr>
            <?php $no++;
            } ?>

            <?php
            $amount = 0;
            $vatamount = 0;
            $nn = 0;
            foreach ($report as $key) {
                $amount = $amount + $key->amount;
                $vatamount = $vatamount + $key->vatamount;
                $nn++;
            } ?>
            <tr>
                <td style="text-align: center; background-color: #040404; color: #FFFFFF; font-weight:bold;"></td>
                <td style="text-align: center; background-color: #040404; color: #FFFFFF; font-weight:bold;"></td>
                <td style="text-align: center; background-color: #040404; color: #FFFFFF; font-weight:bold;"><b>Grand Total</b></td>
                <td style="text-align: center; background-color: #040404; color: #FFFFFF; font-weight:bold;"></td>
                <td style="text-align: center; background-color: #040404; color: #FFFFFF; font-weight:bold;"></td>
                <td style="text-align: center; font-weight:bold;"><b><?php echo number_format($amount, 2); ?></b></td>
                <td style="text-align: center; font-weight:bold;"><b><?php echo number_format($vatamount, 2); ?></b></td>
                <td style="text-align: center; font-weight:bold;"><b><?php echo number_format($amount + $vatamount, 2); ?></b></td>
            </tr>
        </tbody>
    </table>

</body>