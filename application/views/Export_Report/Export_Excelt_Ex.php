<?php

header("Content-type: application/csv");
header("Content-Disposition: attachment; filename=\"Export to Excel" . ".xls\"");
header("Pragma: no-cache");
header("Expires: 0");
?>

<meta charset="UTF-8">

<body>
    <table border="1" class="table" width=30%>
        <thead>
            <tr>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">No</th>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">Contract No</th>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">Rec Date</th>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($report as $key) {
            ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td style='mso-number-format:"\@"'><?php echo $key->contract_no; ?></td>
                    <td><?php echo date('Y-m-d', strtotime($key->rec_date)); ?></td>
                    <td style="text-align: right;"><?php echo number_format($key->amount, 2); ?></td>
                </tr>
            <?php $no++;
            } ?>

            <?php
            $amount = 0;
            $nn = 0;
            foreach ($report as $key) {
                $amount = $amount + $key->amount;
                $nn++;
            } ?>
            <tr>
                <td style="text-align: center; background-color: #040404; color: #FFFFFF; font-weight:bold;"><b>Grand Total</b></td>
                <td style="text-align: right; background-color: #040404; color: #FFFFFF; font-weight:bold;"></td>
                <td style="text-align: right; background-color: #040404; color: #FFFFFF; font-weight:bold;"></td>
                <td style="text-align: right; font-size: 1.2em;"><b><?php echo number_format($amount, 2); ?></b></td>
            </tr>
        </tbody>
    </table>
</body>