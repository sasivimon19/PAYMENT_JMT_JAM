
<div align="center" style="width: 100%;">
    <div class="input-group" style="margin-top: 5px;margin-bottom: 5px;width: 30%;">
        <?php
        $x = 0;
        foreach ($search_view_not as $row) {
            $n = $row->Amount;
            $x = $x + $n;
        }
        ?>
        <span class="input-group-addon"> ยอดรวม Amount : </span>
        <b><input style="text-align: right;background: #000000;color: #F0FF03;width: 100%;" id="msg" type="text" class="form-control" name="msg" value="<?php echo number_format($x, 2); ?>" readonly></b>
    </div>
</div>


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
                               <a href="<?php echo site_url('Payment_controller/Export_ReportNosavedata')    ?>"><button type="button" class="btn btn-warning btn-sm"><i class="fas fa-cloud-download-alt"></i> <b> Export ข้อมูลที่ไม่สามารถบันทึกได้ </b></button></a>
                               <!--<button type="button" class="btn btn-danger btn-sm" onclick="ExportDailyReceive()"><i class="fas fa-edit"></i> <b> Export ข้อมูลที่ไม่สามารถบันทึกได้ </b></button>-->
                            </div>  
                        </div>
                    </div>

                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover" id="myTable">
                            <thead  style="background-color: gray;">

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
                                    <th style="text-align: center; white-space:nowrap;">Date Export</th>
                                    <th style="text-align: center; white-space:nowrap;">Remark</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $num = 1;
                                foreach ($search_view_not as $row) {
                                    ?>
                                    <tr style="text-align: left;">
                                        <td style="text-align: center; white-space:nowrap;"><?php echo $num; ?></td>
                                        <td style="text-align: center; white-space:nowrap;"><?php echo date("m-d-Y", strtotime($row->Date1)); ?></td>
                                        <td style="text-align: center; white-space:nowrap;"><?php echo $row->Agreement; ?></td>
                                        <td style="text-align: center; white-space:nowrap;"><?php echo $row->IDCard; ?></td>
                                        <td style="text-align: center; white-space:nowrap;"><?php echo $row->Channel; ?></td>
                                        <td style="text-align: center; white-space:nowrap;"><?php echo $row->Ref1; ?></td>
                                        <td style="text-align: center; white-space:nowrap;"><?php echo date("m-d-Y", strtotime($row->Ref2)); ?></td>
                                        <td style="text-align : right;"><?php echo number_format($row->Amount, 2); ?></td>
                                        <td style="text-align: center; white-space:nowrap;"><?php echo $row->Lot; ?></td>
                                        <td style="text-align: center; white-space:nowrap;"><?php
                                            foreach ($get_date as $key) {
                                                echo date("m-d-Y", strtotime($key->Currentdate));
                                            }
                                            ?></td>
                                        <td style="color: red; text-align: center; white-space:nowrap;">
                                            <b>
                                                <?php
                                                if ($row->ContractNo_not == '0') {
                                                    echo " ContractNo IDCard ";
                                                }
                                                if ($row->Channel_not == '0') {
                                                    echo " Channel ";
                                                }
                                                if ($row->Discount_not == '0') {
                                                    echo " Discount ซ้ำ ";
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
                                <?php $num++;} ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
</section>
