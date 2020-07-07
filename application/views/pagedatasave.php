

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="background-color: #E5E7E9">
                        <div class="row">
                            <div class="col-md-4" style=" color: black;">
                                <h3 class="card-title"><b> <i class="fas fa-edit"></i> ข้อมูลที่สามารถบันทึกได้ </b></h3>
                            </div>
                            <div class="input-group-prepend" style=" margin-left: 40%">
                               <a href="<?php echo site_url('Payment_controller/Export_Reportsavedata')  ?>"><button type="button" class="btn btn-success btn-sm"><i class="fas fa-cloud-download-alt"></i> <b> Export ข้อมูลที่สามารถบันทึกได้ </b></button></a>
                                <!--<button type="button" class="btn btn-success btn-sm" onclick="ExportMiddle()"><i class="fas fa-edit"></i> <b> Export ข้อมูลที่สามารถบันทึกได้ </b></button>-->
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
                                    <th style="text-align: center; white-space:nowrap;">Remark</th>
                                    <th style="text-align: center; white-space:nowrap;">OSBalance</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $num = 1;
                                foreach ($search_view as $row) {
                                    ?>
                                    <tr>
                                        <td style="text-align: center; white-space:nowrap;"><?php echo $num; ?></td>
                                        <td style="text-align: center; white-space:nowrap;"><?php echo date("m-d-Y", strtotime($row->Date1)); ?></td>
                                        <td style="text-align: center; white-space:nowrap;"><?php echo $row->Agreement; ?></td>
                                        <td style="text-align: center; white-space:nowrap;"><?php echo $row->IDCard; ?></td>
                                        <td style="text-align: center; white-space:nowrap;"><?php echo $row->Channel; ?></td>
                                        <td style="text-align: center; white-space:nowrap;"><?php echo $row->Ref1; ?></td>
                                        <td style="text-align: center; white-space:nowrap;"><?php echo date("m-d-Y", strtotime($row->Ref2)); ?></td>
                                        <td style="text-align : right;"><?php echo number_format($row->Amount, 2); ?></td>
                                        <td style="text-align: center; white-space:nowrap;"><?php echo $row->Lot; ?></td>
                                        <td style="text-align: center; white-space:nowrap;"><?php echo iconv('tis-620', 'utf-8', $row->Remark); ?></td>
                                        <td style="text-align : right;<?php if (($row->OSbalance - $row->Amount) < 0) { ?>
                                                color: red;
                                    <?php } ?>"><b><?php echo number_format(($row->OSbalance - $row->Amount), 2); ?></b></td>
                                    </tr>
                                    <?php
                                    $num++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
</section>