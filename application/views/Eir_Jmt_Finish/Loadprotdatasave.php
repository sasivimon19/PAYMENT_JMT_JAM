      <?php if (COUNT($get_Tmp_customer_True) == 0) { ?>

      <?php } else { ?>
          <div class="row" style="margin-top: 1%;">
              <div class="col-md-2">
                  <div class="input-group mb-3">
                      <div class="input-group-prepend">
                          <span class="input-group-text form-control form-control-sm"><b> COMPANY </b> </span>
                      </div>
                      <select class="form-control form-control-sm userformload" name="company" id="company" onchange="operator(this.value)">
                          <option value="">เลือก</option>
                          <option value="JMT">JMT</option>
                          <option value="JAM">JAM</option>
                      </select>
                  </div>
              </div>
              <div class="col-md-2">
                  <div class="input-group mb-3">
                      <div class="input-group-prepend">
                          <span class="input-group-text form-control form-control-sm"><b> PORTNAME </b> </span>
                      </div>
                      <select class="form-control form-control-sm userformload" name="portname" id="portname" onchange="getoproduct(this.value)">
                          <option value="">เลือก</option>
                          <?php foreach ($Showoperaton as $value) { ?>
                              <option value="<?php echo $value->operator_name; ?>">
                                  <?php echo $value->operator_name; ?></option>
                          <?php } ?>
                      </select>
                  </div>
              </div>
              <div class="col-md-2">
                  <div class="input-group mb-3">
                      <div class="input-group-prepend">
                          <span class="input-group-text form-control form-control-sm"><b> PRODUCT </b> </span>
                      </div>
                      <select class="form-control form-control-sm userformload" name="Product" id="Product" onchange="operator(this.value)">
                          <option value="">เลือก</option>
                      </select>
                  </div>
              </div>
              <div class="col-md-2">
                  <div class="input-group mb-3">
                      <div class="input-group-prepend">
                          <span class="input-group-text form-control form-control-sm"><b> OPERATORID </b> </span>
                      </div>

                      <select class="form-control form-control-sm userformload" name="operatorid" id="operatorid" readonly>
                          <option value=""></option>
                      </select>
                  </div>
              </div>
              <div class="col-md-2">
                  <div class="input-group mb-3">
                      <div class="input-group-prepend">
                          <span class="input-group-text form-control form-control-sm"><b> LOT_NO </b> </span>
                      </div>
                      <input type="text" class="form-control form-control-sm userformload" id="lot_no" name="lot_no">
                  </div>
              </div>
              <div class="col-md-2">
                  <div class="input-group mb-3">
                      <div class="input-group-prepend">
                          <span class="input-group-text form-control form-control-sm"><b> DateUpload </b> </span>
                      </div>
                      <input autocomplete="off" type="text" class="form-control form-control-sm userformload" id="DateUpload" name="DateUpload" placeholder="วันที่รับเงิน">
                  </div>
              </div>
          </div>
          <section class="content">
              <div class="container-fluid">
                  <div class="row">
                      <div class="col-md-12">
                          <div class="card">
                              <div class="card-header" style="background-color: #E5E7E9">
                                  <div class="row">
                                      <div class="col-md-4" style=" color: black;">
                                          <h4 class="card-title"><b> <i class="fas fa-edit"></i> <b> รายการที่สามารถบันทึกข้อมูลได้ </b> </b></h3>
                                      </div>
                                      <?php foreach ($get_Tmp_customer_True as $val) { ?>
                                          <?php $Showproduct = $val->product; ?>
                                      <?php } ?>
                                      <div class="input-group-prepend" style="margin-left: 25%;">
                                          <?php if ($Showproduct != "") { ?>
                                              <button type="button" class="btn btn-primary btn-sm" style="background-color: #0080ff; color: black;" id="InsertLoadnewport" onclick="Insert_Loadnewport()"> <b><i class="fas fa-file-import"></i> บันทึกข้อมูล </b></button>
                                          <?php  } else { ?>

                                          <?php  } ?>
                                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                          <a href="<?php echo site_url('Call_LoadNewport/Export_Loadnewport_True') ?>"><button type="button" class="btn btn-warning btn-sm"> <b><i class="fas fa-file-download"></i> Export รายการที่สามารถบันทึกข้อมูลได้ </b> </button></a>
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
                                              <th>product</th>
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
                                              <th>company</th>
                                          </tr>
                                      </thead>
                                      <tbody id="table_data_222222">
                                          <?php $num = 1;
                                            foreach ($get_Tmp_customer_True as $item) { ?>
                                              <tr>
                                                  <td style="white-space:nowrap;mso-number-format:\@;"><?php echo $item->row; ?></td>
                                                  <td style="white-space:nowrap;mso-number-format:\@;"><?php echo $item->contract_no; ?></td>
                                                  <td style="white-space:nowrap;mso-number-format:\@;"><?php echo $item->id_no; ?></td>
                                                  <td style="white-space:nowrap; color:red;" id="tblproduct"><?php echo iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $item->product); ?></td>
                                                  <td style="white-space:nowrap;"><?php echo iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $item->cus_name); ?></td>
                                                  <td style="white-space:nowrap;"><?php echo iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $item->address1); ?></td>
                                                  <td style="white-space:nowrap;"><?php echo iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $item->address2); ?></td>
                                                  <td style="white-space:nowrap;"><?php echo iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $item->province); ?></td>
                                                  <td style="white-space:nowrap;"><?php echo $item->postal; ?></td>
                                                  <td style="white-space:nowrap;"><?php echo $item->b_balance; ?></td>
                                                  <td style="white-space:nowrap;"><?php echo $item->e_balance; ?></td>
                                                  <td style="white-space:nowrap;  color:red;"><?php echo $item->lot_no; ?></td>
                                                  <td style="white-space:nowrap;  color:red;"><?php
                                                                                                if ($item->operator_id == 0 || $item->operator_id == "") {
                                                                                                    echo "";
                                                                                                } else {
                                                                                                    echo $item->operator_id;
                                                                                                } ?></td>
                                                  <td style="white-space:nowrap;"><?php echo $item->contract_no2; ?></td>
                                                  <td style="white-space:nowrap;"><?php echo $item->id_no2; ?></td>
                                                  <td style="white-space:nowrap;"><?php echo $item->status; ?></td>
                                                  <td style="white-space:nowrap;  color:red;" id="tableDateUpload" name="tableDateUpload"><?php echo $item->DateUpload; ?></td>
                                                  <td style="white-space:nowrap;  color:red;" id="tablecompany" name="tablecompany"><?php echo $item->company; ?></td>
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



          <script>
              $('#DateUpload').datetimepicker({
                  timepicker: false,
                  format: 'd-m-Y'
              });
          </script>


          <script>
              function getoproduct(v) {
                  $.getJSON('<?php echo site_url('Call_LoadNewport/Select_operator_value?id=1&portname=') ?>' + v, function(res) {
                      $('#Product').find('option').remove();
                      $('#Product').append('<option value="">เลือก</option>');
                      for (const i in res) {
                          $('#Product').append('<option value="' + res[i].operator_value + ',' + res[i].operator_name + '">' + res[i].operator_value + '</option>')

                      }

                  });
              }

              function operator(v) {
                  $.getJSON('<?php echo site_url('Call_LoadNewport/Select_operator_value?id=2&portname2=') ?>' + v, function(res) {
                      console.log(res);
                      $('#operatorid').find('option').remove();
                      //   $('#operatorid').append('<option value="">เลือก</option>');
                      for (const i in res) {
                          $('#operatorid').append('<option value="' + res[i].operator_id + '">' + res[i].operator_id + '</option>')
                      }
                  });
              }
          </script>


          <script>
              function Insert_Loadnewport() {
                  swal({
                          title: "ต้องการบันทึกข้อมูลนี้หรือไม่",
                          icon: "warning",
                          buttons: true,
                          dangerMode: false,
                      })
                      .then((willEdit) => {
                          if (willEdit) {
                              document.getElementById("spinner").style.display = "block";
                              let data = $("#formLoadprotdatasave").serialize()
                              axios.post("Call_LoadNewport/Insert_Customer", data).then(result => {
                                  $('#idLoadprotdatasave').html(result.data);
                                  swal({
                                      title: "บันทึกข้อมูลสำเร็จ",
                                      icon: "success",
                                  }).then((willEdit) => {
                                      if (willEdit) {
                                          document.getElementById('spinner').style.display = "none";
                                          location.href = '';
                                      }
                                  });
                              }).catch(err => alert(err))
                          }
                      });
              }
          </script>


          <!-- <script>
          function Insert_Loadnewport() {

              swal({
                      title: "ต้องการบันทึกข้อมูลนี้หรือไม่",
                      icon: "warning",
                      buttons: true,
                      dangerMode: false,
                  })
                  .then((willEdit) => {
                      if (willEdit) {
                          document.getElementById("spinner").style.display = "block";
                          $.ajax({
                                  type: "POST",
                                  url: "<//?php echo site_url('Call_LoadNewport/Insert_Customer'); ?>",
                                  data: $("#formLoadprotdatasave").serialize(),
                              })
                              .done(function(data) {
                                  $('#idLoadprotdatasave').html(data);
                                  swal({
                                      title: "บันทึกข้อมูลสำเร็จ",
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
      </script> -->
      <?php } ?>