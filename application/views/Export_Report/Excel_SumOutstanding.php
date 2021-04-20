<?php

header("Content-type: application/csv");
header("Content-Disposition: attachment; filename=\"Outstanding Report(Summary)" . ".xls\"");
header("Pragma: no-cache");
header("Expires: 0");
?>

<meta charset="UTF-8">
<?php
$amount = 0;
$vatamount = 0;
$beinmonth = 0;
$nn = 0;
foreach ($report as $key) {
    $amount = $amount + $key->Balance;
    $vatamount = $vatamount + $key->Before_amt;
    $beinmonth = $beinmonth + $key->beinmonth;
    $nn++;
} ?>

<body>
    <table border="1" class="table" width=50%>
        <thead>
            <tr>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">No</th>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">Product</th>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">Lot No</th>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">Beginning Balance</th>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">Receive in this month</th>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">Endingmonth</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($report as $key) {
            ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $key->product; ?></td>
                    <td><?php echo $key->lot_no; ?></td>
                    <td style="text-align: right;"><?php echo number_format($key->Balance, 2); ?></td>
                    <td style="text-align: right;"><?php echo number_format($key->Before_amt, 2); ?></td>
                    <td style="text-align: right;"><?php echo number_format($key->beinmonth, 2); ?></td>
                </tr>
            <?php $no++;
            } ?>

            <?php
            $amount = 0;
            $vatamount = 0;
            $beinmonth = 0;
            $nn = 0;
            foreach ($report as $key) {
                $amount = $amount + $key->Balance;
                $vatamount = $vatamount + $key->Before_amt;
                $beinmonth = $beinmonth + $key->beinmonth;
                $nn++;
            } ?>
            <tr>
                <td style="text-align: center; background-color: #040404; color: #FFFFFF; font-weight:bold;"></td>
                <td style="text-align: center; background-color: #040404; color: #FFFFFF; font-weight:bold;"><b>Grand Total</b></td>
                <td style="text-align: center; background-color: #040404; color: #FFFFFF; font-weight:bold;"></td>
                <td style=" text-align: right; font-weight:bold;"><b><?php echo number_format($amount, 2); ?></b></td>
                <td style=" text-align: right; font-weight:bold;"><b><?php echo number_format($vatamount, 2); ?></b></td>
                <td style=" text-align: right; font-weight:bold;"><b><?php echo number_format($beinmonth, 2); ?></b></td>
            </tr>
        </tbody>
    </table>
</body>