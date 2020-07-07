<!--<div align="center" style="overflow: auto;">-->
    <!--<hr style="margin-top: 3px;">-->
    <?php 
    $amount = 0;
    $vatamount = 0; 
    $sum = 0; 
    $nn = 0;
    foreach ($receive as $key) { 
       echo $amount = $amount + $key->SUM_BF_AMOUNT;
        $vatamount = $vatamount + $key->SUM_VATAMOUNT;
        $sum = $sum + $key->SUM_AMOUNT;
        $nn++; 
    } ?>
<!--    <div style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);width: 99%;margin-bottom: 5px;border-radius: 5px;padding: 5px;">
        <p style="width: 100%;background-color: red;border-radius: 5px;"><b>Grand Total</b></p>
        <table style="width: 100%;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);border-radius: 5px;">
            <tr style="">
                <td style="padding: 3px;">
                    <div class="input-group">
                        <span class="input-group-addon">จำนวนรายการ</span>
                        <input style="color: #F0FF03;background-color: black;text-align: right;" id="msg" type="text" class="form-control" name="msg" value="<?php echo number_format($nn); ?>">
                    </div>
                </td>
                <td style="padding: 3px;">
                    <div class="input-group">
                        <span class="input-group-addon">มูลค่าบริการ</span>
                        <input style="color: #F0FF03;background-color: black;text-align: right;" id="msg" type="text" class="form-control" name="msg" value="<?php echo number_format($amount,2); ?>">
                    </div>
                </td>
                <td style="padding: 3px;">
                    <div class="input-group">
                        <span class="input-group-addon">จำนวนภาษีมูลค่าเพิ่ม</span>
                        <input style="color: #F0FF03;background-color: black;text-align: right;" id="msg" type="text" class="form-control" name="msg" value="<?php echo number_format($vatamount,2); ?>">
                    </div>
                </td>
                <td style="padding: 3px;">
                    <div class="input-group">
                        <span class="input-group-addon">จำนวนเงินรวม</span>
                        <input style="color: #F0FF03;background-color: black;text-align: right;" id="msg" type="text" class="form-control" name="msg" value="<?php echo number_format($sum,2); ?>">
                    </div>
                </td>
            </tr>
        </table>
    </div>-->
        <div class="col-md-12">     
        <div class="row" style=" margin-top: 2%;"> 
            <div class="col-md-3">
                <div class="input-group mb-4">
                    <div class="input-group-prepend">
                        <button type="button" class="btn btn-default "  style="background-color: #D3D3D3;"><b> จำนวนรายการ </b></button>
                    </div>
                    <input style="color: #F0FF03;background-color: black;text-align: right;" id="msg" type="text" class="form-control" name="msg" value="<?php echo number_format($nn); ?>">
                </div>
            </div>
            <div class="col-md-3">
                <div class="input-group mb-4">
                    <div class="input-group-prepend">
                        <button type="button" class="btn btn-default "  style="background-color: #D3D3D3;"><b> มูลค่าบริการ </b></button>
                    </div>
                   <input style="color: #F0FF03;background-color: black;text-align: right;" id="msg" type="text" class="form-control" name="msg" value="<?php echo number_format($amount,2); ?>">
                </div>
            </div>
            <div class="col-md-3">
                <div class="input-group mb-4">
                    <div class="input-group-prepend">
                        <button type="button" class="btn btn-default "  style="background-color:#D3D3D3;"><b> จำนวนภาษีมูลค่าเพิ่ม </b></button>
                    </div>
                    <input style="color: #F0FF03;background-color: black;text-align: right;" id="msg" type="text" class="form-control" name="msg" value="<?php echo number_format($vatamount,2); ?>">
                </div>
            </div>
            <div class="col-md-3">
                <div class="input-group mb-4">
                    <div class="input-group-prepend">
                        <button type="button" class="btn btn-default "  style="background-color: #D3D3D3;"><b> จำนวนเงินรวม </b></button>
                    </div>
                   <input style="color: #F0FF03;background-color: black;text-align: right;" id="msg" type="text" class="form-control" name="msg" value="<?php echo number_format($sum,2); ?>">
                </div>
            </div>
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
                                <div class="col-md-7" style=" color: black;">
                                    <h3 class="card-title"><b> <i class="fas fa-edit"></i>Summary Receive Report By Operator Of Month</b></h3>
                                </div>
<!--                                 <div class="input-group-prepend" style=" margin-left: 43%">
                                    <a href="<?php //echo site_url('Payment_controller/Export_DailyReceiveReport') ?>"><button type="button" class="btn btn-warning btn-sm"><i class="fas fa-cloud-download-alt"></i> <b>Export Daily Receive Report</b></button></a>
                                    <button type="button" class="btn btn-warning btn-sm" onclick="ExportDailyReceive()"><i class="fas fa-edit"></i> <b> Export Daily Receive Report </b></button>
                                 </div>  -->
                            </div>
                        </div>
                        
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover" id="myTable">
                                <thead  style="background-color: gray;">
                                    <tr>
                                        <th style="text-align: center;">No</th> 
                                        <th style="text-align: center; white-space:nowrap;">รายการ</th>
                                        <th style="text-align: center; white-space:nowrap;">มูลค่าบริการ</th>
                                        <th style="text-align: center; white-space:nowrap;">จำนวนภาษีมูลค่าเพิ่ม</th>
                                        <th style="text-align: center; white-space:nowrap;">จำนวนเงินรวม</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $num = 1;
                                    foreach ($receive as $key) {?>  
                                    <tr>
                                            <td><?php echo $key->LSIT_PRODUCT; ?></td>
                                            <td style="text-align: right;"><?php echo number_format($key->SUM_BF_AMOUNT, 2); ?></td>
                                            <td style="text-align: right;"><?php echo number_format($key->SUM_VATAMOUNT, 2); ?></td>
                                            <td style="text-align: right;"><?php echo number_format($key->SUM_AMOUNT, 2); ?></td>
                                    </tr>
                                        <?php $num++; }?>
                                        
                                    <tr style="display: none;">
                                        <td style="text-align: center;">รวมรายได้สุทธิ</td>
                                        <td style="text-align: right;"><?php echo number_format($amount, 2); ?></td>
                                        <td style="text-align: right;"><?php echo number_format($vatamount, 2); ?></td>
                                        <td style="text-align: right;"><?php echo number_format($sum, 2); ?></td>
                                    </tr>
                                </tbody>
                            </table>

                             </div>
                         </div>
                     </div>
                 </div>
             </div>
       </section>
    <hr>
<!--</div>-->

<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>


<script>
    $(document).ready(function () {
        $('#myTableCN').DataTable({
            "pageLength": 50,
            dom: 'Bfrtip',
            buttons: [
            {
                extend: 'excel',
                messageTop: 'รายการชำระรายวัน สำหรับ วันที่ <?php echo $date; ?>'
            }
            ]
        });
    });
</script>