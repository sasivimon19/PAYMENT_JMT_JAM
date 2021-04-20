<?php if (COUNT($select_logapprae) == 0) { ?>

<?php } else { ?>
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
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $num = 1;
                                    foreach ($select_logapprae as $value) { ?>
                                        <!-- <tr class='clickable-row' style="cursor:pointer;" data-href='<//?php echo site_url('Call_Newport/check_ImportExcel_Newport?getport=') . $value->Port, "&Logapprae=" . $value->ID_Logapprae; ?>' data-target="_blank"> -->
                                        <tr>
                                            <?php if ($value->Status_Log == "Request") { ?>
                                                <td style="white-space:nowrap;color:  #ff9900;">
                                                    <button type="button" class="btn btn-warning btn-flat btn-sm" style="pointer-events: none;"> <b><i class="fas fa-hourglass-half"></i> รออนุมัติ </b></button>
                                                    <button type="button" class="btn btn-danger btn-flat btn-sm" onclick="Delete_Reject_All(getport = '<?php echo $value->Port; ?>',Logapprae = '<?php echo $value->ID_Logapprae; ?>')"> <b><i class="fas fa-trash"></i> </b></button>
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


<script>
    function Delete_Reject_All(getport, Logapprae) {

        swal({
                title: "คุณต้องการลบข้อมูลนี้หรือไม่",
                icon: "warning",
                buttons: true,
                dangerMode: false,
            })
            .then((willEdit) => {
                if (willEdit) {
                    document.getElementById("spinner").style.display = "block";
                    $.ajax({
                            type: "POST",
                            url: "<?php echo site_url('Call_Newport/DeleteReject'); ?>",
                            data: $("#portscan").serialize() + "&getportS=" + getport + "&Logapprae=" + Logapprae,
                        })
                        .done(function(data) {
                            $('#showdatanewporadd').html(data);
                            swal({
                                title: "ลบข้อมูลสำเร็จ",
                                icon: "success",
                            }).then((willEdit) => {
                                if (willEdit) {
                                    document.getElementById('spinner').style.display = "none";
                                    location.href = '';
                                }
                            });
                        });
                }
            });
    }
</script>