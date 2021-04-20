<?php

header("Content-type: application/csv");
header("Content-Disposition: attachment; filename=\"รายการปรับปรุงข้อมูลรายวัน" . ".xls\"");
header("Pragma: no-cache");
header("Expires: 0");
?>

<meta charset="UTF-8">

<body>
    <table border="1" class="table" width=60%>
        <thead>
            <tr>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">No</th>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">Rec Date</th>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">Contract No</th>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">Cus Name</th>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">Amount</th>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">Vatamount</th>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;"> E Balance</th>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">Product</th>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">Lot No</th>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">Chennel</th>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">Operator</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($report as $key) {
            ?>
                <tr>
                    <td style="text-align: center;"><?php echo $no; ?></td>
                    <td style="text-align: center;"><?php echo date('Y-d-d', strtotime($key->rec_date)); ?></td>
                    <td style='mso-number-format:"\@"'><?php echo $key->contract_no; ?></td>
                    <td style="white-space: nowrap;"><?php echo iconv('tis-620', 'utf-8', $key->cus_name); ?></td>
                    <td style="text-align: right;"><?php echo number_format($key->amount, 2); ?></td>
                    <td style="text-align: right;"><?php echo number_format($key->vatamount, 2); ?></td>
                    <td style="text-align: right;"><?php echo number_format($key->e_balance, 2); ?></td>
                    <td style="text-align: right;"><?php $key->product; ?></td>
                    <td style="white-space: nowrap;"><?php echo $key->lot_no; ?></td>
                    <td style="white-space: nowrap;"><?php echo $key->chennel; ?></td>
                    <td style="white-space: nowrap;"><?php echo $key->operator_name; ?></td>
                </tr>
            <?php $no++;
            } ?>

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
            <tr>
                <td style="text-align: center; background-color: #040404; color: #FFFFFF; font-weight:bold;"></td>
                <td style="text-align: center; background-color: #040404; color: #FFFFFF; font-weight:bold;"></td>
                <td style="text-align: center; background-color: #040404; color: #FFFFFF; font-weight:bold;"><b>Grand Total</b></td>
                <td style="text-align: center; background-color: #040404; color: #FFFFFF; font-weight:bold;"></td>
                <td style="text-align: right; font-weight:bold;"><b><?php echo number_format($amount, 2); ?></b></td>
                <td style="text-align: right; font-weight:bold;"><b><?php echo number_format($vatamount, 2); ?></b></td>
                <td style="text-align: right; font-weight:bold;"><b><?php echo number_format($e_balance, 2); ?></b></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>

</body>