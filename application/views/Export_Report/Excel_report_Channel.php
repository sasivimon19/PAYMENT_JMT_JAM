<?php

header("Content-type: application/csv");
header("Content-Disposition: attachment; filename=\"Summary Receive Report By Channel Of Daily" . ".xls\"");
header("Pragma: no-cache");
header("Expires: 0");
?>

<meta charset="UTF-8">
<?php
$amount = 0;
$vatamount = 0;
$sum = 0;
$nn = 0;
foreach ($receive as $key) {
  $amount = $amount + $key->SUM_BF_AMOUNT;
  $vatamount = $vatamount + $key->SUM_VATAMOUNT;
  $sum =    $sum + $key->SUM_AMOUNT;
  $nn++;
} ?>

<body>

  <table border="0" class="table" width=100%>
    <tr>
      <td colspan="5"></td>
    </tr>
    <tr>
      <td colspan="5" style="font-weight:bold; text-align: center;"> <?php echo  iconv('tis-620', 'utf-8', $companyname); ?></td>
    </tr>
    <tr>
      <td colspan="5" style="font-weight:bold; text-align: center;"> รายงานรับชำระรายวัน </td>
    </tr>
    <tr>
      <td colspan="5" style="font-weight:bold; text-align: center;"> By Channel Of Daily </td>
    </tr>
    <tr>
      <td colspan="5" style="font-weight:bold; text-align: center;"> สำหรับ วันที่-เดือน-ปี(rec_date): <?php echo  date('d-m-Y', strtotime($datestart)); ?></td>
    </tr>
    <tr>
      <td colspan="5"></td>
    </tr>
  </table>

  <table border="1" class="table" width=60%>
    <thead>
      <tr>
        <th style="text-align: center; background-color:#040404;color: #FFFFFF;">ลำดับ</th>
        <th style="text-align: center; background-color:#040404;color: #FFFFFF;">รายการ</th>
        <th style="text-align: center; background-color:#040404;color: #FFFFFF;">มูลค่าบริการ</th>
        <th style="text-align: center; background-color:#040404;color: #FFFFFF;">จำนวนภาษีมูลค่าเพิ่ม</th>
        <th style="text-align: center; background-color:#040404;color: #FFFFFF;">จำนวนเงินรวม</th>
      </tr>
    </thead>
    <tbody>
      <?php $num = 1;
      foreach ($receive as $key) { ?>
        <tr>
          <td style="text-align: center; width=15%"><?php echo $num; ?></td>
          <td><?php echo $key->LSIT_PRODUCT; ?></td>
          <td style="text-align: right;  width=30% "><?php echo number_format($key->SUM_BF_AMOUNT, 2); ?></td>
          <td style="text-align: right;"><?php echo number_format($key->SUM_VATAMOUNT, 2); ?></td>
          <td style="text-align: right;"><?php echo number_format($key->SUM_AMOUNT, 2); ?></td>
        </tr>
      <?php $num++;
      } ?>

      <tr>
        <td colspan='2' style="text-align: center; background-color: #040404; color: #FFFFFF; font-weight:bold;">รวมรายได้สุทธิ</td>
        <td style="text-align: right; font-weight:bold;"><?php echo number_format($amount, 2); ?></td>
        <td style="text-align: right; font-weight:bold;"><?php echo number_format($vatamount, 2); ?></td>
        <td style="text-align: right; font-weight:bold;"><?php echo number_format($sum, 2); ?></td>
      </tr>
    </tbody>
  </table>

</body>