<?php
header("Content-type: application/csv");

if ($statusview == "ExportNewReceive") {
    header("Content-Disposition: attachment; filename=\"Newreceive" . ".xls\"");
} elseif ($statusview == "ExportCN") {
    header("Content-Disposition: attachment; filename=\"CN" . ".xls\"");
} elseif ($statusview == "ExportDISCOUNT") {
    header("Content-Disposition: attachment; filename=\"DISCOUNT" . ".xls\"");
} elseif ($statusview == "ExportREVOKE") {
    header("Content-Disposition: attachment; filename=\"REVOKE" . ".xls\"");
} elseif ($statusview == "ExportADJUST") {
    header("Content-Disposition: attachment; filename=\"ADJUST" . ".xls\"");
} elseif ($statusview == "ExportREFUND") {
    header("Content-Disposition: attachment; filename=\"REFUND" . ".xls\"");
} elseif ($statusview == "ExportAUCTION") {
    header("Content-Disposition: attachment; filename=\"AUCTION" . ".xls\"");
} elseif ($statusview == "ExportApproved") {
    header("Content-Disposition: attachment; filename=\"Approved" . ".xls\"");
}
header("Pragma: no-cache");
header("Expires: 0");
?>

<meta charset="UTF-8">

<body>
    <table border="1" class="table" width=60%>
        <thead>
            <tr>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">No</th>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">r_index</th>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">Rec_date</th>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">Channel</th>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">Contract No</th>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">IDCard</th>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">Ref no1.</th>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">Ref no2.</th>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">Amount</th>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">VAT</th>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">State</th>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">Type</th>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">Lot</th>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">operator_name</th>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">Endind Balance</th>
            </tr>

        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($search_view as $key) { ?>
                <tr>
                    <td><?php echo $key->row; ?></td>
                    <td><?php echo $key->r_index; ?></td>
                    <td><?php echo date('d-m-Y', strtotime($key->rec_date)); ?></td>
                    <td><?php echo iconv('tis-620//ignore', 'utf-8//ignore', $key->chennel); ?></td>
                    <td style='mso-number-format:"\@"'><?php echo $key->contract_no; ?></td>
                    <td style='mso-number-format:"\@"'><?php echo $key->id_no; ?></td>
                    <td><?php echo iconv('tis-620', 'utf-8', $key->refno1); ?></td>
                    <td><?php echo date('d-m-Y', strtotime($key->refno2)); ?></td>
                    <td style="text-align: right;"><?php echo number_format($key->amount, 2); ?></td>
                    <td style="text-align: right;"><?php echo number_format($key->vatamount, 2); ?></td>
                    <td style="text-align: center;"><?php echo $key->state; ?></td>
                    <td style="text-align: center;"><?php echo $key->keytype; ?></td>
                    <td><?php echo $key->lot_no; ?></td>
                    <td><?php echo $key->operator_name; ?></td>
                    <td><?php echo $key->e_balance; ?></td>
                </tr>
            <?php $no++;
            } ?>

            <?php
            $amount = 0;
            $vatamount = 0;
            $sumebalance = 0;
            $nn = 0;

            foreach ($search_view as $key) {
                $amount = $amount + $key->amount;
                $vatamount = $vatamount + $key->vatamount;
                $sumebalance = $sumebalance + $key->e_balance;
                $nn++;
            } ?>

            <tr>
                <td colspan='7' style="text-align: center; background-color: #040404; color: #FFFFFF; font-weight:bold;"><b>Grand Total</b></td>
                <td style="text-align: center; background-color: #040404; color: #FFFFFF; font-weight:bold;"></td>
                <td style="text-align: right; font-weight:bold;"><b><?php echo number_format($amount, 2); ?></b></td>
                <td style="text-align: right; font-weight:bold;"><b><?php echo number_format($vatamount, 2); ?></b></td>
                <td colspan='4'></td>
                <td style="text-align: right; font-weight:bold;"><b><?php echo number_format($sumebalance, 2); ?></b></td>
            </tr>
        </tbody>
    </table>
</body>