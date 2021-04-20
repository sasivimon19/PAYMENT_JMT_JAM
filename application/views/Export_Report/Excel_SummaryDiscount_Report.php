<?php

header("Content-type: application/csv");
header("Content-Disposition: attachment; filename=\"Summary Discount Report" . ".xls\"");
header("Pragma: no-cache");
header("Expires: 0");
?>

<meta charset="UTF-8">
<?php
$amount = 0;
$vatamount = 0;
$e_balance = 0;
$nn = 0;
foreach ($report as $key) {
    $amount = $amount + $key->amount;
    $vatamount = $vatamount + $key->vatamount;
    $e_balance = $e_balance + $key->e_balance;
    $nn++;
} ?>

<body>
    <table border="0" class="table" width=100%>
        <tr>
            <td colspan="10"></td>
        </tr>
        <tr>
            <td colspan="10" style="font-weight:bold; text-align: center;"> <?php echo  iconv('tis-620', 'utf-8', $companyname); ?></td>
        </tr>
        <tr>
            <td colspan="10" style="font-weight:bold; text-align: center;"> Summary Discount Report </td>
        </tr>
        <tr>
            <td colspan="10" style="font-weight:bold; text-align: center;"> สำหรับ วันที่-เดือน-ปี(rec_date): <?php echo date('d-m-Y', strtotime($datestartoperator)) ; ?>
            </td>
        </tr>
        <tr>
            <td colspan="10"></td>
        </tr>
    </table>

    <table border="1" class="table" width=60%>
        <thead>
            <tr>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">No</th>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">Rec Date</th>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">Contract No</th>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">Cus Name</th>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">Amount</th>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">Vatamount</th>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">E Balance</th>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">Product</th>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">Lot No</th>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">Chennel</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $num = 1;
            foreach ($report as $key) {
            ?>
                <tr>
                    <td style="text-align: left;"><?php echo $num; ?></td>
                    <td><?php echo date('d-m-Y', strtotime($key->rec_date)); ?></td>
                    <td style='mso-number-format:"\@"'><?php echo $key->contract_no; ?></td>
                    <td style="white-space: nowrap;"><?php echo iconv('tis-620', 'utf-8', $key->cus_name); ?></td>
                    <td style="text-align: right;"><?php echo number_format($key->amount, 2); ?></td>
                    <td style="text-align: right;"><?php echo number_format($key->vatamount, 2); ?></td>
                    <td style="text-align: right;"><?php echo number_format($key->e_balance, 2); ?></td>
                    <td style="text-align: right;"><?php $key->product; ?></td>
                    <td style="white-space: nowrap;"><?php echo $key->lot_no; ?></td>
                    <td style="white-space: nowrap;"><?php echo $key->chennel; ?></td>
                </tr>
            <?php $num++;
            } ?>

            <tr>
                <td style="text-align: center; background-color: #040404; color: #FFFFFF; font-weight:bold;"></td>
                <td style="text-align: right; background-color: #040404; color: #FFFFFF; font-weight:bold;"></td>
                <td style="text-align: center; background-color: #040404; color: #FFFFFF; font-weight:bold;"><b>Grand Total</b></td>
                <td style="text-align: right; background-color: #040404; color: #FFFFFF; font-weight:bold;"></td>
                <td style="text-align: right;font-size: 1.2em;"><b><?php echo number_format($amount, 2); ?></b></td>
                <td style="text-align: right;font-size: 1.2em;"><b><?php echo number_format($vatamount, 2); ?></b></td>
                <td style="text-align: right;font-size: 1.2em;"><b><?php echo number_format($e_balance, 2); ?></b></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
            </tr>
        </tbody>
    </table>

</body>