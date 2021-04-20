<?php if (COUNT($get_Tmp_customer_FALSE) == 0) { ?>

<?php } else { ?>
    <!-- <section class="content" style="margin-top: 2%;">
        <div class="container-fluid"> -->
    <!-- <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header" style="background-color: #E5E7E9">
                            <div class="row">
                                <div class="col-md-4" style=" color: black;">
                                    <h4 class="card-title"><b> <i class="fas fa-edit"></i> <b> รายการที่ไม่สามารถบันทึกข้อมูลได้ </b> </b></h3>
                                </div>
                                <div class="input-group-prepend" style="margin-left: 38%;">
                                    <a href="<?php echo site_url('Call_LoadNewport/Export_Loadnewport_FALSE') ?>"><button type="button" style="background-color: #D02008; color: #FFFFFF;" class="btn btn-warning btn-sm"> <b><i class="fas fa-file-download"></i> <b> Export รายการที่ไม่สามารถบันทึกข้อมูลได้</b> </button></a>
                                </div>
                            </div>
                        </div> -->

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header" style="background-color: #E5E7E9">
                            <div class="row">
                                <div class="col-md-4" style=" color: black;">
                                    <h4 class="card-title"><b> <i class="fas fa-edit"></i> <b> รายการที่ไม่สามารถบันทึกข้อมูลได้ </b> </b></h3>
                                </div>
                                <div class="input-group-prepend" style="margin-left: 38%;">
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href="<?php echo site_url('Call_LoadNewport/Export_Loadnewport_FALSE') ?>"><button type="button" style="background-color: #D02008; color: #FFFFFF;" class="btn btn-warning btn-sm"> <b><i class="fas fa-file-download"></i> Export รายการที่ไม่สามารถบันทึกข้อมูลได้ </b> </button></a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body table-responsive p-0" style="height: 400px;">
                            <table class="table table-head-fixed">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>contract_no</th>
                                        <th>id_no</th>
                                        <th>product </th>
                                        <th>cus_name</th>
                                        <th>address1</th>
                                        <th>address2</th>
                                        <th>province</th>
                                        <th>postal</th>
                                        <th>b_balance</th>
                                        <th>e_balance </th>
                                        <th>lot_no</th>
                                        <th>operator_id</th>
                                        <th>contract_no2</th>
                                        <th>id_no2</th>
                                        <th>status</th>
                                        <th>DateUpload</th>
                                        <th>company </th>
                                        <th>สาเหตุ </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $num = 1;
                                    foreach ($get_Tmp_customer_FALSE as $item) { ?>
                                        <tr>
                                            <td style="white-space:nowrap;"><?php echo $num; ?></td>
                                            <td style="white-space:nowrap;"><?php echo $item->contract_no; ?></td>
                                            <td style="white-space:nowrap;"><?php echo $item->id_no; ?></td>
                                            <td style="white-space:nowrap;"><?php echo iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $item->product); ?></td>
                                            <td style="white-space:nowrap;"><?php echo iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $item->cus_name); ?></td>
                                            <td style="white-space:nowrap;"><?php echo iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $item->address1); ?></td>
                                            <td style="white-space:nowrap;"><?php echo iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $item->address2); ?></td>
                                            <td style="white-space:nowrap;"><?php echo iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $item->province); ?></td>
                                            <td style="white-space:nowrap;"><?php echo $item->postal; ?></td>
                                            <td style="white-space:nowrap;"><?php echo $item->b_balance; ?></td>
                                            <td style="white-space:nowrap;"><?php echo $item->e_balance; ?></td>
                                            <td style="white-space:nowrap;"><?php echo $item->lot_no; ?></td>
                                            <td style="white-space:nowrap;"><?php
                                                                            if ($item->operator_id == 0 || $item->operator_id == "") {
                                                                                echo "";
                                                                            } else {
                                                                                echo $item->operator_id;
                                                                            } ?> </td>
                                            <td style="white-space:nowrap;"><?php echo $item->contract_no2; ?></td>
                                            <td style="white-space:nowrap;"><?php echo $item->id_no2; ?></td>
                                            <td style="white-space:nowrap;"><?php echo $item->status; ?></td>
                                            <td style="white-space:nowrap;"><?php echo $item->DateUpload; ?></td>
                                            <td style="white-space:nowrap;"><?php echo $item->company; ?></td>
                                            <td style="white-space:nowrap; color:red;">
                                                <?php if ($item->ContractNonot == '') {
                                                    echo "เลขที่สัญญาซ้ำในระบบ";
                                                } ?>
                                            </td>
                                        </tr>
                                    <?php $num++;
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } ?>