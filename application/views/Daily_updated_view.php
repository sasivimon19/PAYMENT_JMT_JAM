<div align="center" style="overflow: auto;">
    <hr style="margin-top: 3px;">
    <?php 
    $amount = 0;
    $vatamount = 0; 
    $e_balance = 0; 
    $nn = 0;
    foreach ($report as $key) { 
        $amount = $amount + $key->amount;
        $vatamount = $vatamount + $key->vatamount;
        $e_balance = $e_balance + $key->e_balance;
        $nn++; 
    } ?>
    <div style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);width: 99%;margin-bottom: 5px;border-radius: 5px;padding: 5px;">
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
                        <span class="input-group-addon">Amount</span>
                        <input style="color: #F0FF03;background-color: black;text-align: right;" id="msg" type="text" class="form-control" name="msg" value="<?php echo number_format($amount,2); ?>">
                    </div>
                </td>
                <td style="padding: 3px;">
                    <div class="input-group">
                        <span class="input-group-addon">Vatamount</span>
                        <input style="color: #F0FF03;background-color: black;text-align: right;" id="msg" type="text" class="form-control" name="msg" value="<?php echo number_format($vatamount,2); ?>">
                    </div>
                </td>
                <td style="padding: 3px;">
                    <div class="input-group">
                        <span class="input-group-addon">E Balance</span>
                        <input style="color: #F0FF03;background-color: black;text-align: right;" id="msg" type="text" class="form-control" name="msg" value="<?php echo number_format($e_balance,2); ?>">
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <div style="width: 99%;">
        <table id="myTable1" class="table" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);overflow: auto;font-size: 0.9em;width: 99.9%;">
            <thead>
                <tr style="background-color:#040404;color: #FFFFFF;">
                  <th>Rec Date</th>
                  <th>Contract No</th>
                  <th>Cus Name</th>
                  <th>Amount</th>
                  <th>Vatamount</th>                                    
                  <th>E Balance</th>
                  <th>Product</th> 
                  <th>Lot No</th>
                  <th>Chennel</th>
                  <th>Operator</th>
              </tr>
          </thead>
          <tbody>
            <?php 
            $no = 1; foreach ($report as $key) { 
                ?>
                <tr>
                    <td><?php echo date('m-d-Y', strtotime($key->rec_date)); ?></td>
                    <td><?php echo $key->contract_no; ?></td>
                    <td style="white-space: nowrap;"><?php echo iconv('tis-620', 'utf-8', $key->cus_name); ?></td>
                    <td style="text-align: right;"><?php echo number_format($key->amount,2); ?></td>
                    <td style="text-align: right;"><?php echo number_format($key->vatamount,2); ?></td>
                    <td style="text-align: right;"><?php echo number_format($key->e_balance,2); ?></td>
                    <td style="text-align: right;"><?php $key->product; ?></td>
                    <td style="white-space: nowrap;"><?php echo $key->lot_no; ?></td>
                    <td style="white-space: nowrap;"><?php echo $key->chennel; ?></td>
                    <td style="white-space: nowrap;"><?php echo $key->operator_name; ?></td>
                </tr>
                <?php $no++;
            } ?>

            <?php 
            $amount = 0;
            $vatamount = 0; 
            $e_balance = 0; 
            $nn = 0;
            foreach ($report as $key) { 
                $amount = $amount + $key->amount;
                $vatamount = $vatamount + $key->vatamount;
                $e_balance = $e_balance + $key->e_balance;
                $nn++; 
            } ?>
            <tr style="display: none;">
                <td style="font-size: 1.2em;"><b>Grand Total</b></td>
                <td></td>
                <td></td>                  
                <td style="text-align: right;font-size: 1.2em;"><b><?php echo number_format($amount,2); ?></b></td>
                <td style="text-align: right;font-size: 1.2em;"><b><?php echo number_format($vatamount,2); ?></b></td>
                <td style="text-align: right;font-size: 1.2em;"><b><?php echo number_format($e_balance,2); ?></b></td>
                <td></td>  
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>
</div>
<hr>
</div>

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
        $('#myTable1').DataTable({
            "pageLength": 50,
            dom: 'Bfrtip',
            buttons: [
            {
                extend: 'excel',
                messageTop: '<?php echo $Operator." "."Summary ".$status." "."For the Daily"." ".$datestart." - ".$dateend ?>'
            }
            ]
        });
    });
</script>