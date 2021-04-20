<div class="col-md-12">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="input-group mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon3" style="background: #4dc3ff; color:#000000; font-weight: 90%;"><b>จำนวนรายการ : </b></span>
                        </div>
                        <input style="text-align: center;background: #000000;color: #F0FF03; font-weight: 90%;" type="text" class="form-control" id="usr" name="username" value="<?php echo number_format($COUNTNUMCOUNT); ?>" readonly>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="input-group mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon3" style="background: #4dc3ff; color:#000000; font-weight: 90%;"><b> ยอดชำระรวม : </b></span>
                        </div>
                        <input style="text-align: right;background: #000000; color: #F0FF03; font-weight: 90%;" type="text" class="form-control" id="usr" name="username" value="<?php echo number_format($sumamount, 2);  ?>" readonly>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon3" style="background:#4dc3ff; color:#000000; font-weight: 90%;"><b>ยอดรวม VAT : </b></span>
                        </div>
                        <input style="text-align: right;background: #000000;color: #F0FF03; font-weight: 90%;" type="text" class="form-control" id="usr" name="username" value="<?php echo number_format($sumvat, 2); ?>" readonly>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="input-group mb-3">
                        <div>
                            <?php if ($statusview == 'New_Receive_ALL') { ?>

                                <button type="button" class="btn btn-warning btn-sm" onclick="ExportReceiveALL(statusview='New_Receive_ALL_Export',count='Count_New_Receive_All',Sum='New_Receive_All_Sum',page='<?php echo $page ?>')"><i class="fas fa-edit"></i> <b> EXPORT EXCEL NEW RECEIVE ALL</b></button>

                            <?php } else if ($statusview == 'ADJUST_ALL') { ?>

                                <button type="button" class="btn btn-warning btn-sm" onclick="ExportReceiveALL(statusview='ADJUST_ALL_Export',count='CountADJUSTALL',Sum='ADJUST_ALL_Sum',page='<?php echo $page ?>')"><i class="fas fa-edit"></i> <b> EXPORT EXCEL ADJUST ALL</b></button>

                            <?php } else if ($statusview == 'CN_ALL') { ?>

                                <button type="button" class="btn btn-warning btn-sm" onclick="ExportReceiveALL(statusview='CN_ALL_Export',count='CountCNALL',Sum='CN_ALL_Sum',page='<?php echo $page ?>')"><i class="fas fa-edit"></i> <b> EXPORT EXCEL CN ALL</b></button>

                            <?php } else if ($statusview == 'DISCOUNT_ALL') { ?>

                                <button type="button" class="btn btn-warning btn-sm" onclick="ExportReceiveALL(statusview='DISCOUNT_ALL_Export',count='CountDISCOUNTALL',Sum='DISCOUNT_ALL_Sum',page='<?php echo $page ?>')"><i class="fas fa-edit"></i> <b> EXPORT EXCEL DISCOUNT ALL</b></button>

                            <?php } else if ($statusview == 'REVOKE_ALL') { ?>

                                <button type="button" class="btn btn-warning btn-sm" onclick="ExportReceiveALL(statusview='REVOKE_ALL_Export',count='CountREVOKEALL',Sum='REVOKE_ALL_Sum',page='<?php echo $page ?>')"><i class="fas fa-edit"></i> <b> EXPORT EXCEL ADJUST ALL</b></button>

                            <?php } else if ($statusview == 'REFUND_ALL') { ?>

                                <button type="button" class="btn btn-warning btn-sm" onclick="ExportReceiveALL(statusview='REFUND_ALL_Export',count='CountREFUNDALL',Sum='REFUND_ALL_Sum',page='<?php echo $page ?>')"><i class="fas fa-edit"></i> <b> EXPORT EXCEL REFUND ALL</b></button>

                            <?php } else if ($statusview == 'NewReceive') { ?>

                                <button type="button" class="btn btn-warning btn-sm" onclick="ExportReceive(statusview='ExportNewReceive',count='countNewReceive',Sum='NewReceiveSum',page='<?php echo $page ?>')"><i class="fas fa-edit"></i> <b> EXPORT EXCEL NEW RECEIVE</b></button>

                            <?php } else if ($statusview == 'CN') { ?>

                                <button type="button" class="btn btn-warning btn-sm" onclick="ExportReceive(statusview='ExportCN',count='countCN',Sum='CNSum',page='<?php echo $page ?>')"><i class="fas fa-edit"></i> <b> EXPORT EXCEL CN</b></button>

                            <?php } else if ($statusview == 'Approved') { ?>

                                <button type="button" class="btn btn-warning btn-sm" onclick="ExportReceive(statusview='ExportApproved',count='countApproved',Sum='ApprovedSum',page='<?php echo $page ?>')"><i class="fas fa-edit"></i> <b> EXPORT EXCEL APPROVE</b></button>

                            <?php } else if ($statusview == 'DISCOUNT') { ?>

                                <button type="button" class="btn btn-warning btn-sm" onclick="ExportReceive(statusview='ExportDISCOUNT',count='countDISCOUNT',Sum='DISCOUNTSum',page='<?php echo $page ?>')"><i class="fas fa-edit"></i> <b> EXPORT EXCEL DISCOUNT</b></button>

                            <?php } else if ($statusview == 'ADJUST') { ?>

                                <button type="button" class="btn btn-warning btn-sm" onclick="ExportReceive(statusview='ExportADJUST',count='countADJUST',Sum='ADJUSTSum',page='<?php echo $page ?>')"><i class="fas fa-edit"></i> <b> EXPORT EXCEL ADJUST</b></button>

                            <?php } else if ($statusview == 'REVOKE') { ?>

                                <button type="button" class="btn btn-warning btn-sm" onclick="ExportReceive(statusview='ExportREVOKE',count='countREVOKE',Sum='REVOKESum',page='<?php echo $page ?>')"><i class="fas fa-edit"></i> <b> EXPORT EXCEL REVOKE</b></button>

                            <?php } else if ($statusview == 'REFUND') { ?>

                                <button type="button" class="btn btn-warning btn-sm" onclick="ExportReceive(statusview='ExportREFUND',count='countREFUND',Sum='REFUNDSum',page='<?php echo $page ?>')"><i class="fas fa-edit"></i> <b> EXPORT EXCEL REFUND</b></button>

                            <?php } else if ($statusview == 'AUCTION') { ?>

                                <button type="button" class="btn btn-warning btn-sm" onclick="ExportReceive(statusview='ExportAUCTION',count='countAUCTION',Sum='AUCTIONSum',page='<?php echo $page ?>')"><i class="fas fa-edit"></i> <b> EXPORT EXCEL AUCTION</b></button>

                            <?php  } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


<form id="UUUUUUU" name="UUUUUUU" method="post" enctype="multipart/form-data">
    <div class="card-body table-responsive p-0">
        <table class="table table-hover" id="table-data">
            <thead style="background-color: gray;">
                <tr>
                    <th style="text-align: center;">
                        <input class="checkboxLength" type="checkbox" id="Length_ALL" name="Length_ALL[]">
                    </th>
                    <th style="text-align: center;">No</th>
                    <th style="text-align: center; white-space:nowrap;">Rec_date</th>
                    <th style="text-align: center; white-space:nowrap;">Channel</th>
                    <th style="text-align: center; white-space:nowrap;">Contract No</th>
                    <th style="text-align: center; white-space:nowrap;">Ref no1.</th>
                    <th style="text-align: center; white-space:nowrap;">Ref no2.</th>
                    <th style="text-align: center; white-space:nowrap;">Amount</th>
                    <th style="text-align: center; white-space:nowrap;">VAT</th>
                    <th style="text-align: center; white-space:nowrap;">State</th>
                    <th style="text-align: center; white-space:nowrap;">Type</th>
                    <th style="text-align: center; white-space:nowrap;">Lot</th>
                    <th style="text-align: center; white-space:nowrap;">IDCard</th>
                    <th style="text-align: center; white-space:nowrap;">operator_name</th>
                </tr>
            </thead>
            <?php $no = 1;
            foreach ($search_view as $key) { ?>
                <tr>
                    <td>
                        <input class="checkboxLength" type="checkbox" id="Length_1" name="Length[]" value="<?php echo $key->contract_no; ?>">
                    </td>
                    <td><?php echo $key->row; ?></td>
                    <td style=" white-space:nowrap;"><?php echo date('d-m-Y', strtotime($key->rec_date)); ?></td>
                    <td style=" white-space:nowrap;"><?php echo iconv('tis-620//ignore', 'utf-8//ignore', $key->chennel); ?></td>
                    <td style="white-space:nowrap;"><?php echo $key->contract_no; ?></td>
                    <td style="white-space:nowrap;"><?php echo iconv('tis-620//ignore', 'utf-8//ignore',  $key->refno1); ?></td>
                    <td style="white-space:nowrap;"><?php echo date('d-m-Y', strtotime($key->refno2)); ?></td>
                    <td style="text-align: right;"><?php echo number_format($key->amount, 2); ?></td>
                    <td style="text-align: right;"><?php echo number_format($key->vatamount, 2); ?></td>
                    <td style="text-align: center;"><?php echo $key->state; ?></td>
                    <td style="text-align: center;"><?php echo $key->keytype; ?></td>
                    <td style="white-space:nowrap;"><?php echo $key->lot_no; ?></td>
                    <td style="white-space:nowrap;"><?php echo $key->id_no; ?></td>
                    <td style="white-space:nowrap;"><?php echo $key->operator_name; ?></td>
                </tr>
            <?php $no++;
            } ?>
            <tbody>
            </tbody>
        </table>
        <br>

        <?php foreach ($search_count as $row) { ?>

            <?php $total_record = $row->NUMCOUNT; ?>

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

</form>
<br>

<div style="text-align: right;">
    <form id='approve_updatet' name='approve_updatet' action="<?php echo site_url('Payment_controller/approve_updatet'); ?>" method="post" enctype="multipart/form-data">
        <div style="display: none;">
            <?php $no = 1;
            foreach ($search_view as $key) { ?>
                <input type="text" name="<?php echo "contract_no-" . $no; ?>" id="<?php echo "contract_no-" . $no; ?>" value="<?php echo $key->contract_no; ?>">
                <input type="text" name="<?php echo "state-" . $no; ?>" id="<?php echo "state-" . $no; ?>" value="<?php echo $key->state; ?>">
                <input type="text" name="<?php echo "IDCard-" . $no; ?>" id="<?php echo "IDCard-" . $no; ?>" value="<?php echo $key->id_no; ?>">
                <input type="text" name="<?php echo "amount-" . $no; ?>" id="<?php echo "amount-" . $no; ?>" value="<?php echo $key->amount; ?>">
                <input type="text" name="<?php echo "channel-" . $no; ?>" id="<?php echo "channel-" . $no; ?>" value="<?php echo $key->chennel; ?>">
                <input type="text" name="<?php echo "operator_name-" . $no; ?>" id="<?php echo "operator_name-" . $no; ?>" value="<?php echo $key->operator_name; ?>">
                <input type="text" name="<?php echo "r_index-" . $no; ?>" id="<?php echo "r_index-" . $no; ?>" value="<?php echo $key->r_index; ?>">
            <?php $no++;
            } ?>

            <input type="text" name="sum" id="sum" value="<?php echo count($search_view); ?>">


        </div>
        <?php if (count($search_view) == 0) { ?>
            <button type="button" class="btn btn-success" onclick="save()" disabled>Approve</button>
        <?php } else { ?>
            <?php if ($key->state == 0) { ?>
                <button type="button" class="btn btn-success" onclick="save()"> <i class="fas fa-save"></i> Approve</button>
                <button type="button" class="btn btn-warning" onclick="Search_More_One()"><i class="fas fa-trash-alt"></i> ลบตามรายการ </button>
                <!-- <button type="button" class="btn btn-danger" onclick="Search_More_ALL()" disabled> <i class="fas fa-trash-alt"></i> ลบข้อมูลที่ค้นหา </button> -->
            <?php }
            if ($key->state != 0) { ?>
                <button type="button" class="btn btn-success" onclick="save()" disabled> Approve </button>
        <?php }
        } ?>
        <br><br>
    </form>
</div>


<script type="text/javascript">
    function ExportReceiveALL(statusview, count, Sum, page) {


        document.getElementById('overlay').style.display = "block";

        var datas = "&statusview=" + statusview + "&count=" + count + "&Sum=" + Sum + "&page=" + page;

        window.location.href = '<?php echo site_url('Export_report/Export_ALLReport?') ?>datas=' + datas;
        $('#overlay').fadeOut(3000);
    }
</script>



<script type="text/javascript">
    function ExportReceive(statusview, count, Sum, page) {

        document.getElementById('overlay').style.display = "block";

        var datestart = document.getElementById('datestart').value;
        var dateend = document.getElementById('dateend').value;
        var status = document.getElementById('status').value;
        var Operator = document.getElementById('Operator').value;
        var idcustomer = document.getElementById('idcustomer').value;




        window.location.href = '<?php echo site_url('Export_report/Export_Report_One?') ?>statusview=' + statusview +
            "&count=" + count + "&Sum=" + Sum + "&page=" + page + "&datestart=" + datestart + "&dateend=" + dateend +
            "&status=" + status + "&Operator=" + Operator + "&idcustomer=" + idcustomer;

        $('#overlay').fadeOut(3000);
    }
</script>





<script>
    function pagedatapay() { //แนบตัวแปร page ไปด้วย

        var page = document.getElementById('page').value;
        var datestart = document.getElementById('datestart').value;
        var dateend = document.getElementById('dateend').value;
        var status = document.getElementById('status').value;
        var Operator = document.getElementById('Operator').value;
        var idcustomer = document.getElementById('idcustomer').value;

        // alert(page);

        var datas = "statusview=" + statusview + "&count=" + count + "&page=" + page + "&datestart=" + datestart +
            "&dateend=" + dateend + "&status=" + status + "&Operator=" + Operator + "&idcustomer=" + idcustomer + "&Sum=" + Sum;

        document.getElementById('overlay').style.display = "block";

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Payment_controller/approvescan') ?>",
            data: datas,
        }).done(function(data) {
            $('#show').html(data); //Div ที่กลับมาแสดง
            document.getElementById('overlay').style.display = "none";
        })
    }
</script>



<!--script check all-->
<script type="text/javascript">
    $(document).ready(function() {
        $('#Length_ALL').click(function(event) {
            if (this.checked) {
                $('.checkboxLength').each(function() { //loop through each checkbox
                    $(this).prop('checked', true); //check 
                });
            } else {
                $('.checkboxLength').each(function() { //loop through each checkbox
                    $(this).prop('checked', false); //uncheck              
                });
            }
        });
    });
</script>




<script type="text/javascript">
    function Search_More_One() {

        var page = document.getElementById('page').value;
        var datestart = document.getElementById('datestart').value;
        var dateend = document.getElementById('dateend').value;
        var status = document.getElementById('status').value;
        var Operator = document.getElementById('Operator').value;
        var idcustomer = document.getElementById('idcustomer').value;



        var numChecked = $("input:checkbox:checked").length;

        if (numChecked < 1) {
            alert("กรูณาเลือกรายการ");

        } else {

            document.getElementById('overlay').style.display = "block";

            $.ajax({
                type: "POST",
                url: "<?php echo site_url('Payment_controller/Delete_approve_scan_one') ?>",
                data: $("#UUUUUUU").serialize() + "&statusview=" + statusview + "&count=" + count +
                    "&page=" + page + "&datestart=" + datestart +
                    "&dateend=" + dateend + "&status=" + status +
                    "&Operator=" + Operator + "&idcustomer=" + idcustomer + "&Sum=" + Sum,
            }).done(function(data) {
                document.getElementById('overlay').style.display = "none";
                $('#show').html(data);
            })
        }
    }
</script>



<script type="text/javascript">
    function Search_More_ALL() {


        var page = document.getElementById('page').value;
        var datestart = document.getElementById('datestart').value;
        var dateend = document.getElementById('dateend').value;
        var status = document.getElementById('status').value;
        var Operator = document.getElementById('Operator').value;
        var idcustomer = document.getElementById('idcustomer').value;
        var idcustomer = document.getElementById('idcustomer').value;


        document.getElementById('overlay').style.display = "block";

        $.ajax({
            type: "POST",
            // url: "<//?php echo site_url('HomeInsurance/Check_Search_More') ?>",
            url: "<?php echo site_url('Payment_controller/Delete_approve_scan_ALL') ?>",
            data: $("#approve_updatet").serialize(),
        }).done(function(data) {
            document.getElementById('overlay').style.display = "none";
            $('#show').html(data);
        })
    }
</script>