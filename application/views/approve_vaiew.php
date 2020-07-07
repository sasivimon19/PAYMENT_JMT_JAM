 <hr>
 <div style="width: 99%;">
   <div style="padding: 10px;border-radius: 10px;text-align: center;">
   <!--  <div style="width: 100%;text-align: left;">
      <span style="font-size: 1.3em;">ผลการค้นหา :</span>
    </div> -->

    <!-- <hr style="margin: 10px;"> -->
    <div align="center" style="width: 100%;">
      <table style="width: 30%;">
        <tr>
          <!-- <td style="padding: 5px;">

            <div style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);padding: 5px;border-radius: 5px;">
              <?php foreach ($sum_view as $row) { ?>  
                <div class="input-group" style="width: 100%;text-align: center;">
                  <span class="input-group-addon" style="background: red;color: #ffffff;"><b>ผลการค้นหา</b></span>
                </div>
                <hr style="margin: 10px;">
                <div class="input-group" style="margin-bottom: 5px;">
                  <span class="input-group-addon" style="width: 120px;">จำนวนรายการ:</span>
                  <b><input style="text-align: right;background: #000000;color: #F0FF03;" type="text" class="form-control" id="usr" name="username" value="<?php echo number_format($row->countsum); ?>" readonly></b>
                </div>
                <div class="input-group" style="margin-bottom: 5px;">
                  <span class="input-group-addon" style="width: 120px;">ยอดชำระรวม:</span>
                  <b><input style="text-align: right;background: #000000;color: #F0FF03;" type="text" class="form-control" id="usr" name="username" value="<?php echo number_format($row->amount,2); ?>" readonly></b>
                </div>  
              <?php } ?>
              <?php foreach ($search_sum_view as $row) { ?>   
                <div class="input-group">
                  <span class="input-group-addon" style="width: 120px;">ยอดรวม VAT:</span>
                  <b><input style="text-align: right;background: #000000;color: #F0FF03;" type="text" class="form-control" id="usr" name="username" value="<?php echo number_format($row->vat,2); ?>" readonly></b>
                </div>
              </div>
            <?php } ?>
          </td> -->
        <!-- <td style="padding: 5px;">
          <?php foreach ($sum_view1 as $row) { ?>  
            <div style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);padding: 5px;border-radius: 5px;">
              <div class="input-group" style="width: 100%;text-align: center;">
                <span class="input-group-addon" style="background: red;color: #ffffff;"><b>รายการที่ตัดยอดจากระบบแล้ว (Approved)</b></span>
              </div>
              <hr style="margin: 10px;">
              <div class="input-group" style="margin-bottom: 5px;">
                <span class="input-group-addon">จำนวนรายการ (Approved):</span>
                <input style="text-align: right;" type="text" class="form-control" id="usr" name="username" value="<?php echo number_format($row->countsum); ?>" readonly>
              </div>
              <div class="input-group" style="margin-bottom: 0px;">
                <span class="input-group-addon">ยอดชำระรวม:</span>
                <input style="text-align: right;" type="text" class="form-control" id="usr" name="username" value="<?php echo number_format($row->amount,2); ?>" readonly>
              </div>  
            </div>
          <?php } ?>
        </td> -->
        <td style="padding: 5px;">
          <?php foreach ($search_sum_view as $row) { ?>          
            <div style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);padding: 5px;border-radius: 5px;">
              <div class="input-group" style="width: 100%;text-align: center;">
                <span class="input-group-addon" style="background: red;color: #ffffff;"><b>ผลการค้นหา</b></span>
              </div>
              <hr style="margin: 10px;">
              <div class="input-group" style="margin-bottom: 5px;width: 100%;">
                <span class="input-group-addon" style="width: 150px;text-align: right;">จำนวนรายการ:</span>
                <b><input style="text-align: right;background: #000000;color: #F0FF03;width: 100%;" type="text" class="form-control" id="usr" name="username" value="<?php echo  number_format(count($search_view)); ?>" readonly></b>
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
    </tr>
  </thead>
  <?php $no = 1; foreach ($search_view as $key) { ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo date('d-m-Y', strtotime($key->DateSave)); ?></td>
      <td><?php echo iconv('tis-620', 'utf-8', $key->chennel); ?></td>
      <td><?php echo $key->contract_no; ?></td>
      <td><?php echo iconv('tis-620', 'utf-8', $key->refno1); ?></td>
      <td><?php echo date('d-m-Y', strtotime($key->refno2)); ?></td>
      <td style="text-align: right;"><?php echo number_format($key->amount,2); ?></td>
      <td style="text-align: right;"><?php echo number_format($key->vatamount,2); ?></td>
      <td style="text-align: center;"><?php echo $key->state; ?></td>
      <td style="text-align: center;"><?php echo $key->keytype; ?></td>
      <td><?php echo $key->lot_no; ?></td>
      <td><?php echo $key->id_no; ?></td>
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
      <?php $no = 1; foreach ($search_view as $key) { ?>
        <input type="text" name="<?php echo "contract_no-".$no; ?>" id="<?php echo "contract_no-".$no; ?>" value="<?php echo $key->contract_no; ?>">
        <input type="text" name="<?php echo "state-".$no; ?>" id="<?php echo "state-".$no; ?>" value="<?php echo $key->state; ?>">
        <input type="text" name="<?php echo "IDCard-".$no; ?>" id="<?php echo "IDCard-".$no; ?>" value="<?php echo $key->id_no; ?>">
        <input type="text" name="<?php echo "amount-".$no; ?>" id="<?php echo "amount-".$no; ?>" value="<?php echo $key->amount; ?>">
        <input type="text" name="<?php echo "channel-".$no; ?>" id="<?php echo "channel-".$no; ?>" value="<?php echo $key->chennel; ?>">
        <?php $no++; } ?>          
        <input type="text" name="sum" id="sum" value="<?php echo count($search_view); ?>">
      </div>
      <?php if (count($search_view) == 0) { ?>
       <button type="button" class="btn btn-success" onclick="save()" disabled>Approve</button>
     <?php }else{ ?>
       <?php if ($key->state == 0) { ?>
        <button type="button" class="btn btn-success" onclick="save()">Approve</button>
      <?php } if ($key->state != 0) { ?>
        <button type="button" class="btn btn-success" onclick="save()" disabled>Approve</button>
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
        
        alert('5555');
        
      document.getElementById('overlay').style.display ="block";
      var num = document.getElementById('sum').value;
      alert(num);
      for ($k=1; $k <= num ; $k++) { 
        var contract_no = document.getElementById('contract_no-'+$k).value;
        var state = document.getElementById('state-'+$k).value;
        var IDCard = document.getElementById('IDCard-'+$k).value;
        var amount = document.getElementById('amount-'+$k).value;
        var channel = document.getElementById('channel-'+$k).value;


        var data = "contract_no="+contract_no+"&state="+state+"&IDCard="+IDCard+"&amount="+amount+"&channel="+channel;
        
        alert(data);
        $.ajax({
          type:"POST",          
//          url:"<?php //echo site_url('Payment_controller/approve_updatet')?>",
          data: data,
        }).done(function(data) {
          
          location.replace("approve");
          $('#passwordsNoMatchRegister').fadeIn(500);
          setTimeout(function () {
            $('#passwordsNoMatchRegister').fadeOut(500);
          }, 3000);
          // document.getElementById('overlay').style.display ="none";
          // alert(data);
        });  
      }
    }
  </script>