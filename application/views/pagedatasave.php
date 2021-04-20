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
                                <a href="<?php echo site_url('Export_report/Export_Reportsavedata') ?>"><button type="button" class="btn btn-success btn-sm"><i class="fas fa-cloud-download-alt"></i> <b> Export ข้อมูลที่สามารถบันทึกได้ </b></button></a>
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
                                    <th style="text-align: center; white-space:nowrap;">e_balance</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $num = 1;
                                foreach ($search_view as $row) { ?>
                                    <tr>
                                        <td style="text-align: center; white-space:nowrap; "><?php echo $row->row; ?></td>
                                        <td style="text-align: center; white-space:nowrap;"><?php echo date("d-m-Y", strtotime($row->Date1)); ?></td>
                                        <td style="text-align: center; white-space:nowrap;"><?php echo $row->Contract_No; ?></td>
                                        <td style="text-align: center; white-space:nowrap;"><?php echo $row->id_no; ?></td>
                                        <td style="text-align: center; white-space:nowrap;"><?php echo $row->Channel; ?></td>
                                        <td style="text-align: center; white-space:nowrap;"><?php echo iconv('tis-620//ignore', 'utf-8//ignore', $row->Ref1); ?></td>
                                        <td style="text-align: center; white-space:nowrap;"><?php echo date("d-m-Y", strtotime($row->Ref2)); ?></td>
                                        <td style="text-align : right;"><?php echo number_format($row->Amount, 2); ?></td>
                                        <td style="text-align: center; white-space:nowrap;"><?php echo $row->Lot; ?></td>
                                        <td style="text-align: center; white-space:nowrap;"><?php echo $row->operator_name; ?></td>
                                        <td style="text-align: center; white-space:nowrap;"><?php echo iconv('tis-620//ignore', 'utf-8//ignore', $row->Remark); ?></td>
                                        <td style="text-align : right;<?php if (($row->e_balance - $row->Amount) < 0) { ?>
                                                color: red;
                                    <?php } ?>"><b><?php echo number_format(($row->e_balance - $row->Amount), 2); ?></b></td>

                                    <?php } ?>


                            </tbody>
                        </table>



                        <?php foreach ($search_view_count as $row) { ?>
                            <?php $total_record = $row->TRUECOUNT; ?>
                        <?php } ?>

                        <?php $total_page = ceil($total_record / $pageend); ?>
                        <div class="card-footer clearfix">
                            <ul class="pagination">
                                <li class="page-item" style="margin-top: 5px;">ทั้งหมด <?php echo $total_page ?> รายการ&nbsp;</li>
                                <li class="page-item">
                                    <select class="form-control form-control-sm" name="page" id="page" onchange="pagedatapay()">
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
    </div>
</section>