<meta charset="UTF-8">
<?php
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=ReportEmp.pdf"); //ชื่อfile
header("Pragma: no-cache");
header("Expires: 0");
?>
<style>
    table {
  border-collapse: collapse;
}

table, td, th {
  border: 1px solid black;
}
</style>

<body>
  <table border="1" class="table">
    <thead>


      <tr style="padding-right: 1px;padding-left: 1px; text-align: center; color: #FFFFFF">
        <th style="color:black">AutoIDEmp</th>
        <th style="color:black">IDEmp</th>
        <th style="color:black">Code</th>
        <th style="color:black">NameEmp</th>
        <th style="color:black">Tel.</th>
        <th style="color:black">CompanyCode</th>
        <th style="color:black">LevelEmp</th>
        <th style="color:black">DateStart</th>
        <th style="color:black">DateEnd</th>

      </tr>
    </thead>

    <tbody>
      <?php $num = 1;
      foreach ($result as $r) { ?>

        <tr align="center" style="background: #FFFFFF;">

          <td nowrap><?php echo iconv('TIS-620//ignore', 'UTF-8//ignore', $r->AutoIDEmp) ?></td>
          <td nowrap><?php echo iconv('TIS-620//ignore', 'UTF-8//ignore', $r->IDEmp) ?></td>
          <td nowrap><?php echo iconv('TIS-620//ignore', 'UTF-8//ignore', $r->Code) ?></td>
          <td nowrap><?php echo iconv('TIS-620//ignore', 'UTF-8//ignore', $r->NameEmp) ?></td>
          <td nowrap><?php echo iconv('TIS-620//ignore', 'UTF-8//ignore', $r->telePhone) ?></td>
          <td nowrap><?php echo iconv('TIS-620//ignore', 'UTF-8//ignore', $r->CODE_COMPANY) ?></td>
          <td nowrap><?php echo iconv('TIS-620//ignore', 'UTF-8//ignore', $r->LevelEmp) ?></td>
          <td nowrap><?php echo iconv('TIS-620//ignore', 'UTF-8//ignore', $r->DateStart) ?></td>
          <td nowrap><?php echo iconv('TIS-620//ignore', 'UTF-8//ignore', $r->DateEnd) ?></td>

        </tr>

      <?php $num++;
      } ?>
    </tbody>
  </table>
</body>

.