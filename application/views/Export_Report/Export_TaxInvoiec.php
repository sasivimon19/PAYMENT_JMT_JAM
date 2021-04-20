<?php

header("Content-type: application/csv");
header("Content-Disposition: attachment; filename=\" ออกใบเสร็จรับเงิน (Tax Invoice)" . ".xls\"");
header("Pragma: no-cache");
header("Expires: 0");
?>

<meta charset="UTF-8">
<?php
$amount = 0;
$nn = 0;
foreach ($report as $key) {
    $amount = $amount + $key->amount;

    $nn++;
} ?>

<body>
    <table border="1" class="table" width=40%>
        <thead>
            <tr>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">#</th>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">วันที่ออกจดหมาย</th>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">number</th>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">เลขที่สัญญา</th>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">เลขที่บัตรประชาชน</th>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">ชื่อ-สกุล(ลูกค้า)</th>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">ที่อยู่1</th>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">ที่อยู่2</th>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">จังหวัด</th>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">รหัส</th>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">จำนวนเงิน</th>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">vatamount</th>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">จำนวนเงินก่อน vat</th>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">ตัวอักษรจำนวนเงิน</th>
                <th style="text-align: center; background-color:#040404;color: #FFFFFF;">ใบเสร็จรับเงิน</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($report as $key) {
            ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td style="white-space: nowrap;"><?php echo date('m-d-Y', strtotime($key->rec_date)); ?></td>
                    <td style='mso-number-format:"\@"'><?php echo $key->number; ?></td>
                    <td style='mso-number-format:"\@"'><?php echo $key->AccNo; ?></td>
                    <td style='mso-number-format:"\@"'><?php echo $key->id_no; ?></td>
                    <td style="white-space: nowrap;"><?php echo iconv('tis-620', 'utf-8', $key->cus_name); ?></td>
                    <td style="white-space: nowrap;"><?php echo iconv('tis-620', 'utf-8', $key->address1); ?></td>
                    <td style="white-space: nowrap;"><?php echo iconv('tis-620', 'utf-8', $key->address2); ?></td>
                    <td style="text-align: center;"><?php echo iconv('tis-620', 'utf-8',  $key->province); ?></td>
                    <td style="text-align: center;"><?php echo $key->postal; ?></td>
                    <td style="text-align: right;"><?php echo number_format($key->Amountfirstvat, 2); ?></td>
                    <td style="text-align: right;"><?php echo number_format($key->vatamount, 2); ?></td>
                    <td style="text-align: right;"><?php echo number_format($key->amount, 2); ?></td>
                    <td style="text-align: left;white-space: nowrap;"><?php echo iconv('tis-620', 'utf-8', $key->bathtext); ?></td>
                    <td style="text-align: center;"><?php echo $key->portname; ?></td>
                </tr>
            <?php $no++;
            } ?>

            <!-- <//?php
                   // $num_amount = 0;
                  //  $num_sum = 0;
                   // $x = 0;

                  //  foreach ($report as $row) {
                      //  $x = $row->amount;
                      //  $num_amount = $x + $num_amount;
                    } //?//> -->

            <?php
            $num_amount = 0;
            $num_vatamount = 0;
            $num_Amountfirstvat = 0;
            $x = 0;
            $y = 0;
            $z = 0;
            foreach ($report as $row) {

                $x = $row->amount;
                $z = $row->vatamount;
                $y = $row->Amountfirstvat;

                $num_amount = $x + $num_amount;
                $num_vatamount = $z + $num_vatamount;
                $num_Amountfirstvat = $y + $num_Amountfirstvat;
            } ?>

            <tr>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center; background-color: #040404; color: #FFFFFF; font-weight:bold;"><b>Grand Total</b></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center; background-color: #040404; color: #FFFFFF; font-weight:bold;"><?php echo number_format($num_Amountfirstvat, 2); ?></td>
                <td style="text-align: center; background-color: #040404; color: #FFFFFF; font-weight:bold;"><?php echo number_format($num_vatamount, 2); ?></td>
                <td style="text-align: center; background-color: #040404; color: #FFFFFF; font-weight:bold;"><b><?php echo number_format($num_amount, 2); ?></b></td>
                <td style="text-align: center; "></td>
                <td style="text-align: center;  "></td>
            </tr>
        </tbody>
    </table>

</body>