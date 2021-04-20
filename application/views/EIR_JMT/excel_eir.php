<meta charset="UTF-8">
<?php
$t = time();
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=All Port.xls"); //ชื่อfile
header("Pragma: no-cache");
header("Expires: 0");
?>
<body>
  <table border="1" class="table" width=60%>
    <thead>


        <tr style="padding-right: 1px;padding-left: 1px; text-align: center; color: #FFFFFF">

          <th style="color:black; background-color: #5bc0de;">Num</th>
          <th style="color:black; background-color: #5bc0de;">Port</th>
          <th style="color:black; background-color: #5bc0de;">Type</th>
          <th style="color:black; background-color: #5bc0de;">Date</th>
          <th style="color:black; background-color: #5bc0de;">Bcost</th>
          <th style="color:black; background-color: #5bc0de;">EIR</th>
          <th style="color:black; background-color: #5bc0de;">MONTH_YEAR</th>
          <th style="color:black; background-color: #5bc0de;">TransferFee</th>
          <th style="color:black; background-color: #5bc0de;">CourtFee</th>
          <th style="color:black; background-color: #5bc0de;">RevokeCustomer</th>
          <th style="color:black; background-color: #5bc0de;">ลูกหนี้ต้นงวดบวกดอกเบี้ยสะสมคงค้างก่อน Provision</th>
          <th style="color:black; background-color: #5bc0de;">Provision</th>
          <th style="color:black; background-color: #5bc0de;">ลูกหนี้ต้นงวด Net Provision</th>
          <th style="color:black; background-color: #FFD700;">ประมาณการรายได้</th>
          <th style="color:black; background-color: #5bc0de;">กระแสเงินสดเข้า</th>
          <th style="color:black; background-color: #5bc0de;">รับรู้รายได้</th>
          <th style="color:black; background-color: #5bc0de;">กระแสเงินสดคงเหลือ</th>
          <th style="color:black; background-color: #5bc0de;">ดอกเบียภายในเดือน</th>
          <th style="color:black; background-color: #5bc0de;">ดอกเบี้ยสะสม</th>
          <th style="color:black; background-color: #5bc0de;">ตัดดอกเบี้ย</th>
          <th style="color:black; background-color: #5bc0de;">ดอกเบี้ยคงเหลือสะสม</th>
          <th style="color:black; background-color: #5bc0de;">ตัดลูกหนี้</th>
          <th style="color:black; background-color: #5bc0de;">ลูกหนี้ลดลง Provision ปัจจุบัน</th>
          <th style="color:black; background-color: #5bc0de;">ลูกหนี้ลดลง Provision สิ้นปี2019</th>
          <th style="color:black; background-color: #5bc0de;">รับรู้ร้อย</th>
          <th style="color:black; background-color: #5bc0de;">ต้นเงินลงทุนคงเหลือ NetProvision</th>
          <th style="color:black; background-color: #5bc0de;">ลูกหนี้ปลายงวด + ดอกเบี้ยสะสมคงค้าง</th>
          <th style="color:black; background-color: #5bc0de;">NPV</th>
          <th style="color:black; background-color: #5bc0de;">ผลต่าง ลูกหนี้ปลายงวดบวกดอกเบี้ยสะสมคงค้างกับ NPV</th>
          <th style="color:black; background-color: #5bc0de;">Provision ที่เกิดขึ้นภายในเดือน</th>
          <th style="color:black; background-color: #5bc0de;">Provision เก่าภายในเดือน</th>
          <th style="color:black; background-color: #5bc0de;">Provision สะสมคงเหลือ</th>
          <th style="color:black; background-color: #5bc0de;">Provision สะสมคงเหลือปี 2019</th>
          <th style="color:black; background-color: #5bc0de;">Provision สะสมคงเหลือทั้งหมด</th>
       
      </tr>
    </thead>

    <tbody>
      <?php $num = 1;
      $sumnumber= 0;
      $sumnumber1=0;
      $sumnumber2=0;$sumnumber3=0;

      foreach ($result as $r) { 
            $Bcost = $r->Bcost;
            $sumnumber = $sumnumber + $Bcost;

            $EIR = $r->EIR;
            $sumnumber1 = $sumnumber1 + $EIR;

            $CashReceive = $r->CashReceive;
             $sumnumber2 = $sumnumber2 + $CashReceive;

             $Receive = $r->Receive;
              $sumnumber3 = $sumnumber3 + $Receive;
        
        ?>

        <tr  style="background: #FFFFFF;">

         <td nowrap style="text-align:center;"><?php echo iconv('TIS-620//ignore', 'UTF-8//ignore', $r->row) ?></td>
                <td nowrap style="text-align:center;"><?php echo iconv('TIS-620//ignore', 'UTF-8//ignore', $r->Port) ?></td>
                <td nowrap style="text-align:center;"><?php echo iconv('TIS-620//ignore', 'UTF-8//ignore', $r->TypePort) ?></td>
                <td nowrap style="text-align:center;"><?php echo (new DateTime($r->DateStart))->format("d/m/Y"); ?>&nbsp;</td>
                <td nowrap style="text-align:rigth;"><?php echo number_format($r->Bcost, 2) ?></td>
                <td nowrap style="text-align:rigth;"><?php echo number_format($r->EIR, 5) ?></td>
                <td nowrap style="text-align:center;"> <?php echo $r->MONTH_YEAR; ?></td>
                <td nowrap style="text-align:rigth;"> <?php echo number_format($r->TransferFee,2) ?></td>
                <td nowrap style="text-align:rigth;"> <?php echo number_format($r->CourtFee,2) ?></td>
                <td nowrap style="text-align:rigth;"> <?php echo number_format($r->RevokeCustomer,2) ?></td>
                <td nowrap style="text-align:rigth;"> <?php echo number_format($r->OS_Before_Provision,2) ?></td>
                <td nowrap style="text-align:rigth;"> <?php echo number_format($r->ProvisonOnMonth,2) ?></td>
                <td nowrap style="text-align:rigth;"> <?php echo number_format($r->OS_NetProvision,2) ?></td>
                <td nowrap style="text-align:rigth;"> <?php echo number_format($r->CashFlowIFRS,2) ?></td>
                <td nowrap style="text-align:rigth;"> <?php echo number_format($r->CashReceive,2) ?></td>
                <td nowrap style="text-align:rigth;"> <?php echo number_format($r->Receive,2) ?></td>
                <td nowrap style="text-align:rigth;"> <?php echo number_format($r->Cash_Balance,2) ?></td>
                <td nowrap style="text-align:rigth;"> <?php echo number_format($r->Interest,2) ?></td>
                <td nowrap style="text-align:rigth;"> <?php echo number_format($r->Cumulative_Interest,2) ?></td>
                <td nowrap style="text-align:rigth;"> <?php echo number_format($r->Cut_InterestOnMonth,2) ?></td>
                <td nowrap style="text-align:rigth;"> <?php echo number_format($r->Interest_BalanceOnMonth,2) ?></td>
                <td nowrap style="text-align:rigth;"> <?php echo number_format($r->Cut_OSDebt,2) ?></td>
                <td nowrap style="text-align:rigth;"> <?php echo number_format($r->Revert_ProvisionOnMonth,2) ?></td>
                <td nowrap style="text-align:rigth;"> <?php echo number_format($r->Revert_ProvisionOld,2) ?></td>
                <td nowrap style="text-align:rigth;"> <?php echo number_format($r->Rec100,2) ?></td>
                <td nowrap style="text-align:rigth;"> <?php echo number_format($r->OS_BalanceNPV,2) ?></td>
                <td nowrap style="text-align:rigth;"> <?php echo number_format($r->OS_BalanceInterestLast,2) ?></td>
                <td nowrap style="text-align:rigth;"> <?php echo number_format($r->NPV,2) ?></td>
                <td nowrap style="text-align:rigth;"> <?php echo number_format($r->PV_BalanceOnMonth,2) ?></td>
                <td nowrap style="text-align:rigth;"> <?php echo number_format($r->PV_NetMonth,2) ?></td>
                <td nowrap style="text-align:rigth;"> <?php echo number_format($r->PV_Old,2) ?></td>
                <td nowrap style="text-align:rigth;"> <?php echo number_format($r->ProvisionCumulative,2) ?></td>
                <td nowrap style="text-align:rigth;"> <?php echo number_format($r->ProvisionOld_Balance,2) ?></td>
                <td nowrap style="text-align:rigth;"> <?php echo number_format($r->Total_Provision_Balance,2) ?></td>
            </tr>
        </tr>

      <?php $num++;
      } ?>
      <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="color:black; background-color: lightseagreen; text-align:right;">
          รวม Bcost:
      <?php echo number_format($sumnumber,2) ?>
      </td>
      <td style="color:black; background-color: lightseagreen; text-align:right;">
          รวม EIR:
      <?php echo number_format($sumnumber1,5) ?>
      </td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td style="color:black; background-color: lightseagreen;">
          รวม กระแสเงินสดเข้า:
      <?php echo number_format($sumnumber2,2) ?>
      </td>
      <td style="color:black; background-color: lightseagreen;">
          รวม รับรู้รายได้:
      <?php echo number_format($sumnumber3,2) ?>
      </td>
      </tr>
      
    </tbody>
  </table>
</body>


