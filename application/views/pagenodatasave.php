<!-- <div align="center" style="width: 100%;">
    <div class="input-group" style="margin-top: 5px;margin-bottom: 5px;width: 30%;">
        <//?php
        $x = 0;
       foreach ($search_view_count_TOTAL as $row) {
          $n = $row->Amount;
           $x = $x + $n;
        }
        ?> 
        <span class="input-group-addon"> ยอดรวม Amount : </span>
        <b><input style="text-align: right;background: #000000;color: #F0FF03;width: 100%;" id="msg" type="text" class="form-control" name="msg" value="<?php echo number_format($x, 2); ?>" readonly></b>

    </div>
</div> -->


<?php
$x = 0;

foreach ($search_view_count_TOTAL as $row) {
    $n = $row->Amount;
    $x = $x + $n;
} ?>

<?php
$xx = 0;
foreach ($search_view_count_TOTALFALSE as $row) {
    $nn = $row->Amount;
    $xx = $xx + $nn;
}
?>


<?php

$Sumtotal = $x + $xx;

?>
<div class="row" style="margin-top: 5px;">
    <div class="col-sm-3">ยอดรวม Amount รายการที่บันทึกได้ :</div>
    <div class="col-sm-2">
        <b> <input style="text-align: right;background: #000000 !important;color: #F0FF03 !important;width: 100%;" id="msg" type="text" class="form-control" name="msg" value="<?php echo number_format($xx, 2); ?>" readonly></b>
    </div>
    <div class="col-sm-3">ยอดรวม Amount :</div>
    <div class="col-sm-2">
        <b> <input style="text-align: right;background: #000000 !important;color: #F0FF03 !important;width: 100%;" id="msg" type="text" class="form-control" name="msg" value="<?php echo number_format($Sumtotal, 2); ?>" readonly></b>
    </div>
</div>
<br>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="background-color: #E5E7E9">
                        <div class="row">
                            <div class="col-md-4" style=" color: black;">
                                <h3 class="card-title"><b> <i class="fas fa-edit"></i> รายการข้อมูลที่ไม่สามารถบันทึกได้ </b></h3>
                            </div>
                            <div class="input-group-prepend" style=" margin-left: 40%">
                                <a href="<?php echo site_url('Export_report/Export_ReportNosavedata') ?>"><button type="button" class="btn btn-warning btn-sm"><i class="fas fa-cloud-download-alt"></i> <b> Export ข้อมูลที่ไม่สามารถบันทึกได้ </b></button></a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover" id="myTable">
                            <thead style="background-color: gray;">

                                <tr>
                                    <th style="text-align: center; white-space:nowrap;">No</th>
                                    <th style="text-align: center; white-space:nowrap;">Date</th>
                                    <th style="text-align: center; white-space:nowrap;">Contract No</th>
                                    <th style="text-align: center; white-space:nowrap;">IDCard</th>
                                    <th style="text-align: center; white-space:nowrap;">Channel</th>
                                    <th style="text-align: center; white-space:nowrap;">Ref No.1</th>
                                    <th style="text-align: center; white-space:nowrap;">Ref No.2</th>
                                    <th style="text-align: center; white-space:nowrap;">Amount</th>
                                    <th style="text-align: center; white-space:nowrap;">Lot</th>
                                    <th style="text-align: center; white-space:nowrap;">operator_name</th>
                                    <th style="text-align: center; white-space:nowrap;">Remark</th>
                                    <th style="text-align: center; white-space:nowrap;">Date Export</th>
                                    <th style="text-align: center; white-space:nowrap;">ข้อมูลที่ผิด</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $num = 1;
                                foreach ($search_view_not as $row) {
                                ?>
                                    <tr style="text-align: left;">
                                        <td style="text-align: center; white-space:nowrap;"><?php echo $row->row; ?></td>
                                        <td style="text-align: center; white-space:nowrap;"><?php echo date("m-d-Y", strtotime($row->Date1)); ?></td>
                                        <td style="text-align: center; white-space:nowrap;"><?php echo iconv('tis-620//ignore', 'utf-8//ignore', $row->Agreement); ?></td>
                                        <td style="text-align: center; white-space:nowrap;"><?php echo $row->IDCard; ?></td>
                                        <td style="text-align: center; white-space:nowrap;"><?php echo $row->Channel; ?></td>
                                        <td style="text-align: center; white-space:nowrap;"><?php echo iconv('tis-620//ignore', 'utf-8//ignore', $row->Ref1); ?></td>
                                        <td style="text-align: center; white-space:nowrap;"><?php echo date("m-d-Y", strtotime($row->Ref2)); ?></td>
                                        <td style="text-align : right;"><?php echo number_format($row->Amount, 2); ?></td>
                                        <td style="text-align: center; white-space:nowrap;"><?php echo $row->Lot; ?></td>
                                        <td style="text-align: center; white-space:nowrap;"><?php echo $row->operator_name; ?></td>
                                        <td style="text-align: center; white-space:nowrap;"><?php echo iconv('tis-620//ignore', 'utf-8//ignore', $row->Remark); ?></td>
                                        <td style="text-align: center; white-space:nowrap;"><?php
                                                                                            foreach ($get_date as $key) {
                                                                                                echo date("m-d-Y", strtotime($key->Currentdate));
                                                                                            }
                                                                                            ?></td>
                                        <td style="color: red;">
                                            <b>
                                                <?php
                                                if ($row->ContractNo_not == '0' AND $row->ContractNo_not2 == 'NULL') {
                                                    echo " ContractNo IDCard ";
                                                }
                                                if ($row->Channel_not == '0') {
                                                    echo " Channel";
                                                }
                                                if ($row->Discount_not == '0') {
                                                    echo " Discount ซ้ำ ";
                                                }
                                                if ($row->AdjustCN_not == '0') {
                                                    echo " Channel CN|ADJUST ไม่ตรง";
                                                }
                                                if ($row->Date_not == '0') {
                                                    foreach ($username as $row1) {
                                                        if ($row1->chkPeriod == 0) {
                                                            echo " สิทธิ์คุณไม่สามารถโหลดชำระ วันที่ย้อนหลัง หรือ ล่วงหน้าเกิน 1 เดือนได้ ";
                                                        } else {
                                                            echo " สิทธิ์คุณไม่สามารถโหลดชำระ ล่วงหน้าเกิน 1 เดือนได้ ";
                                                        }
                                                    }
                                                }
                                                ?>
                                            </b>
                                        </td>
                                    </tr>
                                <?php $num++;
                                } ?>
                            </tbody>
                        </table>
                    </div>

                    <?php foreach ($search_view_not_count as $row) { ?>
                        <?php $total_record = $row->FALSECOUNT; ?>
                    <?php } ?>
                    <?php $total_page = ceil($total_record / $pageend); ?>

                    <div class="card-footer clearfix">
                        <ul class="pagination">
                            <li class="page-item" style="margin-top: 5px;">ทั้งหมด <?php echo $total_page ?> รายการ&nbsp;</li>
                            <li class="page-item">
                                <select class="form-control form-control-sm" name="pageno" id="pageno" onchange="pagedatapayno()">
                                    <?php for ($i = 1; $i <= $total_page; $i++) { ?>
                                        <?php if ($i == $pagenum) { ?>
                                            <option value="<?php echo $i ?>" selected><?php echo $i ?></option>
                                        <?php } else { ?>
                                            <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>