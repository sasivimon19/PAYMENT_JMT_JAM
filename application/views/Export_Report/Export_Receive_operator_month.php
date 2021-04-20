<?php

header("Content-type: application/csv");
header("Content-Disposition: attachment; filename=\"Summary Receive Report By Operator Of Month" . ".xls\"");
header("Pragma: no-cache");
header("Expires: 0");
?>

<meta charset="UTF-8">
<?php
$amount = 0;
$vatamount = 0;
$nn = 0;
foreach ($receive as $key) {
    $amount = $amount + $key->amount;
    $vatamount = $vatamount + $key->vatamount;
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
            <td colspan="11" style="font-weight:bold; text-align: center;"> Summary Report Operator of Mounth </td>
        </tr>
        <tr>
            <td colspan="11" style="font-weight:bold; text-align: center;"> สำหรับ วันที่-เดือน-ปี(rec_date): <?php echo date('d-m-Y', strtotime($datestartoperator)) . ' ถึง ' . date('d-m-Y', strtotime($datestartoperator2)); ?>
            </td>
        </tr>
        <tr>
            <td colspan="11"></td>
        </tr>
    </table>

    <table border="1" class="table" width=60%>
        <thead style="background-color: gray;">
            <tr>
                <th style="text-align: center;">#</th>
                <th style="text-align: center; white-space:nowrap;">Rec Date</th>
                <th style="text-align: center; white-space:nowrap;">Contract No</th>
                <th style="text-align: center; white-space:nowrap;">Cus Name</th>
                <th style="text-align: center; white-space:nowrap;">ID No</th>
                <th style="text-align: center; white-space:nowrap;">Amount</th>
                <th style="text-align: center; white-space:nowrap;">Vatamount</th>
                <th style="text-align: center; white-space:nowrap;">Total</th>
                <th style="text-align: center; white-space:nowrap;">E Balance</th>
                <th style="text-align: center; white-space:nowrap;">Chennel</th>
                <th style="text-align: center; white-space:nowrap;">Refno2</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($receive as $key) {
            ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td style="white-space: nowrap;"><?php echo date('d-m-Y', strtotime($key->rec_date)); ?></td>
                    <td style='mso-number-format:"\@"'><?php echo $key->contract_no; ?></td>
                    <td style='mso-number-format:"\@"'><?php echo $key->id_no; ?></td>
                    <td style="white-space: nowrap;"><?php echo iconv('tis-620', 'utf-8', $key->cus_name); ?></td>
                    <td style="text-align: right;"><?php echo number_format($key->amount, 2); ?></td>
                    <td style="text-align: right;"><?php echo number_format($key->vatamount, 2); ?></td>
                    <td style="text-align: right;"><?php echo number_format($key->amount + $key->vatamount, 2); ?></td>
                    <td style="text-align: right;"><?php echo number_format($key->e_balance, 2); ?></td>
                    <td style="white-space: nowrap;"><?php echo $key->chennel; ?></td>
                    <td style="white-space: nowrap;"><?php echo date('d-m-Y', strtotime($key->refno2)); ?></td>
                </tr>
            <?php $no++;
            }
            ?>

            <?php
            $num_amount = 0;
            $num_vatamount = 0;
            $num_sum = 0;
            $sum_e_balance = 0;
            $x = 0;
            $y = 0;
            $z = 0;
            $E = 0;
            foreach ($receive as $row) {
                $x = $row->amount;
                $y = $row->vatamount;
                $z = $row->amount + $row->vatamount;
                $E = $row->e_balance;

                $num_amount = $x + $num_amount;
                $num_vatamount = $y + $num_vatamount;
                $num_sum = $z + $num_sum;
                $sum_e_balance = $E + $sum_e_balance;
            }
            ?>
            <tr>
                <td style="text-align: center;" colspan='5'><b> Grand Total</b></td>
                <td style="text-align: right;font-size: 1.2em;"><b><?php echo number_format($num_amount, 2); ?></b></td>
                <td style="text-align: right;font-size: 1.2em;"><b><?php echo number_format($num_vatamount, 2); ?></b></td>
                <td style="text-align: right;font-size: 1.2em;"><b><?php echo number_format($num_sum, 2); ?></b></td>
                <td style="text-align: right;font-size: 1.2em;"><b><?php echo number_format($sum_e_balance, 2); ?></b></td>
                <td colspan='2'></td>
            </tr>
        </tbody>
    </table>
</body>