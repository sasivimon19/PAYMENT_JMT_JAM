<?php

header("Content-type: application/csv");
header("Content-Disposition: attachment; filename=\"Export SumTax Report" . ".xls\"");
header("Pragma: no-cache");
header("Expires: 0");
?>

<meta charset="UTF-8">
<?php
$amount = 0;
$vatamount = 0;
$nn = 0;
foreach ($report as $key) {
    $amount = $amount + $key->SUM_AMOUNT;
    $vatamount = $vatamount + $key->SUM_VATAMOUNT;
    $nn++;
} ?>

<body>
    <table border="1" class="table" width=40%>
        <thead>
            <tr>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">NO</th>
                <th style="text-align: left; background-color:#040404;color: #FFFFFF;">LSIT_PRODUCT</th>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">SUM_BF_AMOUNT</th>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">SUM_VATAMOUNT</th>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">SUM_AMOUNT</th>
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
            $bf_amount = 0;
            $amount = 0;
            $vatamount = 0;
            $nn = 0;
            foreach ($report as $key) {
                $bf_amount = $bf_amount + $key->SUM_BF_AMOUNT;
                $amount = $amount + $key->SUM_AMOUNT;
                $vatamount = $vatamount + $key->SUM_VATAMOUNT;
                $nn++;
            } ?>
            <tr>
                <td style="text-align: center; background-color: #040404; color: #FFFFFF; font-weight:bold;"></td>
                <td style="text-align: center; background-color: #040404; color: #FFFFFF; font-weight:bold;"><b>Grand Total</b></td>
                <td style="text-align: right; background-color: #040404; color: #FFFFFF; font-weight:bold;"><b><?php echo number_format($bf_amount, 2); ?></b></td>
                <td style="text-align: right; background-color: #040404; color: #FFFFFF; font-weight:bold;"><b><?php echo number_format($vatamount, 2); ?></b></td>
                <td style="text-align: right; background-color: #040404; color: #FFFFFF; font-weight:bold;"><b><?php echo number_format($amount, 2); ?></b></td>
            </tr>
        </tbody>
    </table>

</body>