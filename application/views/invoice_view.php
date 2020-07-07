<style type="text/css">
  th,td{
    white-space: nowrap;
  }
</style>
<hr style="margin-bottom: 0px;margin-top: 10px;">
<div style="width: 99%;">
 <div style="padding: 10px;border-radius: 10px;text-align: center;">
  <div align="center" style="width: 100%;">
    <table style="width: 30%;">
      <tr>
        <td style="padding: 5px;">
          <?php foreach ($sum_invoice as $row) { ?>          
            <div style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);padding: 5px;border-radius: 5px;">
              <div class="input-group" style="width: 100%;text-align: center;">
                <span class="input-group-addon" style="background: red;color: #ffffff;"><b>ผลการค้นหา</b></span>
              </div>
              <hr style="margin: 10px;">
              <div class="input-group" style="margin-bottom: 5px;width: 100%;">
                <span class="input-group-addon" style="width: 150px;text-align: right;">จำนวนรายการ:</span>
                <b><input style="text-align: right;background: #000000;color: #F0FF03;width: 100%;" type="text" class="form-control" id="usr" name="username" value="<?php echo  number_format(count($invoice)); ?>" readonly></b>
              </div>
              <div class="input-group" style="margin-bottom: 5px;width: 100%;">
                <span class="input-group-addon" style="width: 150px;text-align: right;">ยอดชำระรวม:</span>
                <b><input style="text-align: right;background: #000000;color: #F0FF03;width: 100%;" type="text" class="form-control" id="usr" name="username" value="<?php echo number_format($row->amount,2); ?>" readonly></b>
              </div>   
              <div class="input-group" style="width: 100%;">
                <span class="input-group-addon" style="width: 150px;text-align: right;">ยอดรวม VAT:</span>
                <b><input style="text-align: right;background: #000000;color: #F0FF03;width: 100%;" type="text" class="form-control" id="usr" name="username" value="<?php echo number_format($row->vat,2); ?>" readonly></b>
              </div>
            </div>
          <?php } ?>
        </td>
      </tr>
    </table>
  </div>
</div>
<br/>
<table id="myTable" class="table table-striped" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);overflow: auto;font-size: 0.9em;">
  <thead>
    <tr style="background-color:#040404;color: #FFFFFF;">
      <th style="text-align: center;">No</th>
      <th>DateReceive</th>
      <th>Channel</th>
      <th>Contract No</th>
      <th>Ref no1.</th>
      <th>Ref no2.</th>
      <th>Amount</th>
      <th>VAT</th>
      <th>State</th>
      <th>Type</th>
      <th>Lot</th>
      <th>IDCard</th>
      <th>Invoice No</th>
      <th>Textbath</th>
    </tr>
  </thead>
  <?php $no = 1; foreach ($invoice as $key) { 
    $num_Invoice = 'num_Invoice'.$no;
    $Textbath = 'Textbath'.$key->r_index;
    ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td style="white-space: nowrap;"><?php echo date('m-d-Y', strtotime($key->DateSave)); ?></td>
      <td><?php echo iconv('tis-620', 'utf-8', $key->chennel); ?></td>
      <td><?php echo $key->contract_no; ?></td>
      <td><?php echo iconv('tis-620', 'utf-8', $key->refno1); ?></td>
      <td style="white-space: nowrap;"><?php echo date('m-d-Y', strtotime($key->refno2)); ?></td>
      <td style="text-align: right;"><?php echo number_format($key->amount,2); ?></td>
      <td style="text-align: right;"><?php echo number_format($key->vatamount,2); ?></td>
      <td style="text-align: center;"><?php echo $key->state; ?></td>
      <td style="text-align: center;"><?php echo $key->keytype; ?></td>
      <td><?php echo $key->Lot; ?></td>
      <td><?php echo $key->id_no; ?></td>
      <td style="color: red;"><?php echo $$num_Invoice; ?></td>
      <td style="white-space: nowrap;">
        <?php 
        // foreach ($Textbath as $row) {
          echo iconv('tis-620', 'utf-8',$Textbath); 
        // }
        ?>
      </td>
    </tr>
    <?php $no++; } ?>
    <tbody>
    </tbody>
  </table>
</div>
<hr>
<div style="text-align: right;">
  <form action="<?php echo site_url('Payment_controller/approve_updatet'); ?>" method = "post" enctype = "multipart/form-data" >
    <div style="display: none;">
      <?php $no = 1; foreach ($invoice as $key) { ?>
        <input type="text" name="<?php echo "contract_no-".$no; ?>" id="<?php echo "contract_no-".$no; ?>" value="<?php echo $key->contract_no; ?>">
        <input type="text" name="<?php echo "state-".$no; ?>" id="<?php echo "state-".$no; ?>" value="<?php echo $key->state; ?>">
        <input type="text" name="<?php echo "IDCard-".$no; ?>" id="<?php echo "IDCard-".$no; ?>" value="<?php echo $key->id_no; ?>">
        <input type="text" name="<?php echo "amount-".$no; ?>" id="<?php echo "amount-".$no; ?>" value="<?php echo $key->amount; ?>">
        <input type="text" name="<?php echo "channel-".$no; ?>" id="<?php echo "channel-".$no; ?>" value="<?php echo $key->chennel; ?>">
        <input type="text" name="<?php echo "Lot-".$no; ?>" id="<?php echo "Lot-".$no; ?>" value="<?php echo $key->Lot; ?>">
        <input type="text" name="<?php echo "refno2-".$no; ?>" id="<?php echo "refno2-".$no; ?>" value="<?php echo $key->refno2; ?>">
        <input type="text" name="<?php echo "r_index-".$no; ?>" id="<?php echo "r_index-".$no; ?>" value="<?php echo $key->r_index; ?>">
        <?php $no++; } ?>        
        <input type="text" name="sum" id="sum" value="<?php echo count($invoice); ?>">
      </div>
      <?php if (count($invoice) == 0) { ?>
       <button type="button" class="btn btn-success" onclick="save()" disabled>Save Invoice</button>
     <?php }else{ ?>
       <?php if ($key->state == 1) { ?>
        <button type="button" class="btn btn-success" onclick="save()">Save Invoice</button>
      <?php } if ($key->state != 1) { ?>
        <button type="button" class="btn btn-success" onclick="save()" disabled>Save Invoice</button>
      <?php } }?>
    </form>
  </div>

  <script>
    $(document).ready(function () {
      $('#myTable').DataTable({
        "pageLength": 20,
        "lengthMenu": [[20, 50, 100, -1], [20, 50, 100, "All"]]
      });
    });
  </script>

  <script type="text/javascript">
    function save(){
      document.getElementById('overlay').style.display ="block";
      var num = document.getElementById('sum').value;
      for ($k=1; $k <= num ; $k++) { 
        var contract_no = document.getElementById('contract_no-'+$k).value;
        var state = document.getElementById('state-'+$k).value;
        var IDCard = document.getElementById('IDCard-'+$k).value;
        var amount = document.getElementById('amount-'+$k).value;
        var channel = document.getElementById('channel-'+$k).value;
        var Lot = document.getElementById('Lot-'+$k).value;
        var Operator = document.getElementById('Operator').value;
        var Invoice = document.getElementById('Invoice').value;
        var refno2 = document.getElementById('refno2-'+$k).value;
        var r_index = document.getElementById('r_index-'+$k).value;
        var i = $k;

        var data = "contract_no="+contract_no+"&state="+state+"&IDCard="+IDCard+"&amount="+amount+"&channel="+channel+"&Lot="+Lot+"&num="+num+"&Operator="+Operator+"&Invoice="+Invoice+"&refno2="+refno2+"&r_index="+r_index+"&i="+i;
        $.ajax({
          type:"POST",          
          url:"<?php echo site_url('Payment_controller/Invoice_updatet')?>",
          data: data,
        }).done(function(data) {

          location.replace("invoice");
            // $('#passwordsNoMatchRegister').fadeIn(500);
            // setTimeout(function () {
            //   $('#passwordsNoMatchRegister').fadeOut(500);
            // }, 3000);
            // alert(data);
          });  
      }
    }
  </script>