<?php if (COUNT($ShowApprae) == 0) { ?>

<?php } else { ?>
    <br><br>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover" id="table-data">
                                <thead style="background-color: gray;">
                                    <tr>
                                        <th style="white-space:nowrap;" width="1%">รายละเอียด</th>
                                        <th class="text-center" width="1%">No.</th>
                                        <th class="text-center" width="5%">Port</th>
                                        <th class="text-center" width="5%">Mob</th>
                                        <th class="text-center" width="5%">DateStart</th>
                                        <th class="text-center" width="1%">COST</th>
                                        <th class="text-center" width="1%">Typeport</th>
                                        <th class="text-center" width="1%">NOL</th>
                                        <th class="text-center" width="5%">OriginOS</th>
                                        <th class="text-center" width="5%">BCOST</th>
                                        <th class="text-center" width="5%">EIR</th>
                                        <th class="text-center" width="1%">NumAcct</th>
                                        <th class="text-center" width="1%">Namesave</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $num = 1;
                                    foreach ($ShowApprae as $value) { ?>
                                        <tr>
                                            <?php if ($value->Status_Log == "Request") { ?>
                                                <td style="white-space:nowrap;color:  #ff9900;">
                                                    <button type="button" class="btn btn-warning btn-flat btn-sm" style="pointer-events: none;"> <b><i class="fas fa-hourglass-half"></i> รออนุมัติ </b></button>
                                                    <a href="<?php echo site_url('/Call_Newport/check_ImportExcel_Newport?getport=') . $value->Port, "&Logapprae=" . $value->ID_Logapprae; ?>">
                                                        <button type="button" class="btn btn-info btn-flat btn-sm"> <b> ขออนุมัติ </b></button>
                                                    </a>
                                                </td>
                                            <?php } else if ($value->Status_Log == "Approve") { ?>
                                                <td style="white-space:nowrap;color: Green;">
                                                    <button type="button" class="btn btn-success btn-flat btn-sm" style="pointer-events: none;"><b><i class="fas fa-check"></i> </b></button>
                                                    <a href="<?php echo site_url('/Call_Newport/check_ImportExcel_Newport?getport=') . $value->Port, "&Logapprae=" . $value->ID_Logapprae; ?>">
                                                        <button type="button" class="btn btn-info btn-flat btn-sm"> <b> <i class="fas fa-search-plus"></i> </b></button>
                                                    </a>
                                                </td>
                                            <?php } else if ($value->Status_Log == "Reject") { ?>
                                                <td style="white-space:nowrap;color: #b30000;">
                                                    <button type="button" class="btn btn-danger btn-flat btn-sm" style="pointer-events: none;"> <b><i class="fas fa-times"></i></b></button>
                                                    <button type="button" class="btn btn-danger btn-flat btn-sm" onclick="Delete_Reject_All(getport = '<?php echo $value->Port; ?>',Logapprae = '<?php echo $value->ID_Logapprae; ?>')"> <b><i class="fas fa-trash"></i> </b></button>
                                                    <a href="<?php echo site_url('/Call_Newport/check_ImportExcel_Newport?getport=') . $value->Port, "&Logapprae=" . $value->ID_Logapprae; ?>">
                                                        <button type="button" class="btn btn-info btn-flat btn-sm"> <b> <i class="fas fa-search-plus"></i></b></button>
                                                    </a>
                                                </td>
                                            <?php } ?>
                                            <td style="white-space:nowrap;"><?php echo $num; ?></td>
                                            <td style="text-align: center; white-space:nowrap;"><?php echo $value->Port; ?> </td>
                                            <td style="text-align: center; white-space:nowrap;"><?php echo $value->Mob; ?></td>
                                            <td style="text-align: center; white-space:nowrap;"><?php echo date('Y-m-d', strtotime($value->DateStart)); ?></td>
                                            <td style="white-space:nowrap;"><?php echo number_format($value->Cost, 2); ?></td>
                                            <td style="text-align: center; white-space:nowrap;"><?php echo $value->Typeport; ?></td>
                                            <td style="white-space:nowrap;"><?php echo number_format($value->nol, 2); ?></td>
                                            <td style="white-space:nowrap;"><?php echo number_format($value->OriginOS, 2); ?></td>
                                            <td style="white-space:nowrap;"><?php echo number_format($value->Bcost, 2); ?></td>
                                            <td style="white-space:nowrap;"><?php echo number_format($value->EIR, 2); ?></td>
                                            <td style="text-align: center; white-space:nowrap;"><?php echo $value->NumAcct; ?></td>
                                            <td style="text-align: center; white-space:nowrap;"><?php echo $value->Namesave; ?></td>
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


<!-- <script>
    jQuery(document).ready(function($) {
        $(".clickable-row").click(function() {
            window.open($(this).data("href"), $(this).data("target"));
        });
    });
</script> -->

