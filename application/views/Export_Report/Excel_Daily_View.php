<?php

header("Content-type: application/csv");
header("Content-Disposition: attachment; filename=\"Daily Receive Report" . ".xls\"");
header("Pragma: no-cache");
header("Expires: 0");
?>

<meta charset="UTF-8">
<?php
$amount = 0;
$vatamount = 0;
$nn = 0;
foreach ($daily as $key) {
    $amount = $amount + $key->amount;
    $vatamount = $vatamount + $key->vatamount;
    $sumBefore = $amount - $vatamount;
    $nn++;
} ?>

<body>
    <table border="0" class="table" width=100%>
        <tr>
            <td colspan="11"></td>
        </tr>
        <tr>
            <td colspan="11" style="font-weight:bold; text-align: center;"> <?php echo  iconv('tis-620', 'utf-8', $companyname); ?></td>
        </tr>
        <tr>
            <td colspan="11" style="font-weight:bold; text-align: center;"> Daily Receive Report </td>
        </tr>
        <tr>
            <td colspan="11" style="font-weight:bold; text-align: center;"> สำหรับ วันที่-เดือน-ปี(rec_date): <?php echo  date('d-m-Y', strtotime($datestart)); ?></td>
        </tr>
        <tr>
            <td colspan="11"></td>
        </tr>
    </table>

    <table border="1" class="table" width=60%>
        <thead>
            <tr>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">No</th>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">Rec Date</th>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">Contract No</th>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">Cus Name</th>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">ID No</th>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">Amount</th>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">Vatamount</th>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">Total</th>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">Chennel</th>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">Lot</th>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">Opertor</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($daily as $key) {
            ?>
                <tr>
                    <td style="text-align: center; white-space:nowrap;"><?php echo $no; ?></td>
                    <td style="text-align: center; white-space:nowrap;"><?php echo date('d-m-Y', strtotime($key->rec_date)); ?></td>
                    <td style='mso-number-format:"\@"'><?php echo $key->contract_no; ?></td>
                    <td style="text-align: left; white-space:nowrap;"><?php echo iconv('tis-620', 'utf-8', $key->cus_name); ?></td>
                    <td style='mso-number-format:"\@"'><?php echo $key->id_no; ?></td>
                    <td style="text-align: right;"><?php echo number_format($key->amount, 2); ?></td>
                    <td style="text-align: right;"><?php echo number_format($key->vatamount, 2); ?></td>
                    <td style="text-align: right;"><?php echo number_format($key->amount + $key->vatamount, 2); ?></td>
                    <td style="text-align: left; white-space:nowrap;"><?php echo $key->chennel; ?></td>
                    <td style="text-align: left; white-space:nowrap;"><?php echo $key->lot_no; ?></td>
                    <td style="text-align: left; white-space:nowrap;"><?php echo $key->operator_name; ?></td>
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
            foreach ($daily as $row) {
                $x = $row->amount;
                $y = $row->vatamount;
                $z = $row->amount + $row->vatamount;

                $num_amount = $x + $num_amount;
                $num_vatamount = $y + $num_vatamount;
                $num_sum = $z + $num_sum;
            }
            ?>
            <tr>
                <td colspan="5" style="text-align: center; background-color: #040404; color: #FFFFFF; font-weight:bold;"><b>Grand Total</b></td>
                <td style="text-align: right; font-weight:bold;"><b><?php echo number_format($num_amount, 2); ?></b></td>
                <td style="text-align: right; font-weight:bold;"><b><?php echo number_format($num_vatamount, 2); ?></b></td>
                <td style="text-align: right; font-weight:bold;"><b><?php echo number_format($num_sum, 2); ?></b></td>
                <td colspan="3" style="text-align: center; background-color: #040404; color: #FFFFFF; font-weight:bold;"></td>

            </tr>
        </tbody>
    </table>
</body>