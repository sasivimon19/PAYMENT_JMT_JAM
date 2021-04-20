<!DOCTYPE html>
<html>
<title>Payment</title>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <link href="<?php echo base_url(); ?>assets/sweetalert/dist/sweetalert.css" rel="stylesheet" type="text/css">
  <script src="<?php echo base_url(); ?>assets/sweetalert/dist/sweetalert.min.js"></script>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/font-awesome-4.7.0/css/font-awesome.min.css">
  <script src="<?php echo base_url(); ?>AdminLTE/plugins/jquery/jquery.min.js"></script>
  <script type='text/javascript' src="<?php echo base_url(); ?>assets/jquery.min"></script>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/1.css">
  <script type='text/javascript' src="<?php echo base_url(); ?>js/js.js"></script>

  <style>
    .td {
      padding: 5px;
    }
  </style>
  <style>
    #overlay {
      position: fixed;
      display: none;
      width: 100%;
      height: 100%;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: rgba(0, 0, 0, 0.6);
      z-index: 2;
      cursor: pointer;
    }
  </style>
</head>

<body>
  <div id="main" style=" margin-top: 1%;">
    <div class="wrapper">
      <div class="content-wrapper">
        <section class="content" style=" padding-top:1%;">
          <div class="container-fluid">
            <div class="card card-secondary">
              <div class="card-header" style="background-color: #c3000d;">
                <h3 class="card-title"> <b>ตัดยอดรับชำระ Approve</b> </h3>
              </div>
              <div class="card-body">
                <div align="center" class="row content">
                  <div style="width: 98%;">
                    <div style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);padding: 5px;border-radius: 5px;">
                      <div class="input-group" style="width: 100%;text-align: center;">
                        <span><b>รายการที่ไม่ได้ Approve</b></span>
                      </div>
                      <div class="col-md-12">
                        <div class="row" style=" margin-top: 2%;">
                          <div class="col-md-2">
                            <div class="input-group mb-4">
                              <div class="input-group-prepend">
                                <button type="button" class="btn btn-primary btn-sm" onclick="New_Receive(statusview='New_Receive_ALL',count='Count_New_Receive_All',Sum='New_Receive_All_Sum',page='<?php echo $page ?>')"><b>New Receive : </b></button>
                              </div>
                              <input style="text-align: right;background: #333;color: #ffffff;  font-weight: bold;" type="text" class="form-control form-control-sm" id="usr" name="username" value="<?php echo number_format($New_Receive); ?>" readonly>
                            </div>
                          </div>
                          <div class="col-md-2">
                            <div class="input-group mb-4">
                              <div class="input-group-prepend">
                                <button type="button" class="btn btn-primary btn-sm" onclick="CN(statusview='CN_ALL',count='CountCNALL',Sum='CN_ALL_Sum',page='<?php echo $page ?>')"><b> CN : </b></button>
                              </div>
                              <input style="text-align: right;background: #333;color: #ffffff;  font-weight: bold;" type="text" class="form-control form-control-sm" id="usr" name="username" value="<?php echo number_format($CN); ?>" readonly>
                            </div>
                          </div>
                          <div class="col-md-2">
                            <div class="input-group mb-4">
                              <div class="input-group-prepend">
                                <button type="button" class="btn btn-primary btn-sm" onclick="DISCOUNT(statusview='DISCOUNT_ALL',count='CountDISCOUNTALL',Sum='DISCOUNT_ALL_Sum',page='<?php echo $page ?>')"><b> DISCOUNT : </b></button>
                              </div>
                              <input style="text-align: right;background: #333;color: #ffffff;  font-weight: bold;" type="text" class="form-control form-control-sm" id="usr" name="username" value="<?php echo number_format($DISCOUNT); ?>" readonly>
                            </div>
                          </div>
                          <div class="col-md-2">
                            <div class="input-group mb-4">
                              <div class="input-group-prepend">
                                <button type="button" class="btn btn-primary btn-sm" onclick="ADJUST(statusview='ADJUST_ALL',count='CountADJUSTALL',Sum='ADJUST_ALL_Sum',page='<?php echo $page ?>')"><b> ADJUST : </b></button>
                              </div>
                              <input style="text-align: right;background: #333;color: #ffffff;  font-weight: bold;" type="text" class="form-control form-control-sm" id="usr" name="username" value="<?php echo number_format($ADJUST); ?>" readonly>
                            </div>
                          </div>
                          <div class="col-md-2">
                            <div class="input-group mb-4">
                              <div class="input-group-prepend">
                                <button type="button" class="btn btn-primary btn-sm" onclick="REVOKE(statusview='REVOKE_ALL',count='CountREVOKEALL',Sum='REVOKE_ALL_Sum',page='<?php echo $page ?>')"><b> REVOKE : </b></button>
                              </div>
                              <input style="text-align: right;background: #333;color: #ffffff;  font-weight: bold;" type="text" class="form-control form-control-sm" id="usr" name="username" value="<?php echo number_format($REVOKE); ?>" readonly>
                            </div>
                          </div>
                          <div class="col-md-2">
                            <div class="input-group mb-4">
                              <div class="input-group-prepend">
                                <button type="button" class="btn btn-primary btn-sm" onclick="REFUND(statusview='REFUND_ALL',count='CountREFUNDALL',Sum='REFUND_ALL_Sum',page='<?php echo $page ?>')"><b> REFUND : </b></button>
                              </div>
                              <input style="text-align: right;background: #333;color: #ffffff;  font-weight: bold;" type="text" class="form-control form-control-sm" id="usr" name="username" value="<?php echo number_format($REFUND); ?>" readonly>
                            </div>
                          </div>
                        </div>
                      </div>

                      <form id="scan" method="post" enctype="multipart/form-data">
                        <div>
                          <div class="row">
                            <div class="col-md-3">
                              <div class="form-group">
                                <label>การรับชำระ</label>
                                <select class="form-control form-control-sm userformscan" id="status" name="status">
                                  <option value="">เลือกสถานะการรับชำระ</option>
                                  <option value="NewReceive">NewReceive</option>
                                  <option value="Approved">Approved</option>
                                  <option value="CN">CN</option>
                                  <option value="DISCOUNT">DISCOUNT</option>
                                  <option value="ADJUST">ADJUST</option>
                                  <option value="REVOKE">REVOKE</option>
                                  <option value="REFUND">REFUND</option>
                                  <option value="AUCTION">AUCTION</option>
                                </select>
                              </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-group">
                                <label>Operator</label>
                                <select class="form-control form-control-sm" id="Operator" name="Operator">
                                  <option value="">All Operator</option>
                                  <?php foreach ($op as $row) { ?>
                                    <option value="<?php echo $row->operator_name; ?>"><?php echo $row->operator_name; ?></option>
                                  <?php } ?>
                                </select>
                              </div>
                            </div>
                            <div class="col-md-2">
                              <label>รหัสลูกค้า</label>
                              <input id="idcustomer" type="text" class="form-control form-control-sm " name="idcustomer">
                            </div>
                            <div class="col-md-2">
                              <label>วันที่รับรู้รายได้</label>
                              <input id="datestart" type="date" class="form-control form-control-sm userformscan" name="datestart">
                            </div>
                            <div class="col-md-2">
                              <label>ถึง</label>
                              <input id="dateend" type="date" class="form-control form-control-sm userformscan" name="dateend">
                            </div>
                            <div class="col-md-1" style=" margin-top: 2.5%;">
                              <button type="button" onclick="scan(page='<?php echo $page ?>')" class="btn btn-success btn-sm">ค้นหา</button>
                            </div>
                          </div>

                        </div>
                        <input type="hidden" class="form-control" name="oncheckstatusview" id="oncheckstatusview" value="">
                      </form>
                    </div>

                    </br>
                    <div align="center" id="show" style="overflow: auto;">
                      <section class="content">
                        <div class="container-fluid">
                          <div class="row">
                            <div class="col-md-4">
                              <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon3" style="background: #4dc3ff; color:#000000; font-weight: 90%;"><b>จำนวนรายการ : </b></span>
                                </div>
                                <input style="text-align: center;background: #000000;color: #F0FF03; font-weight: 90%;" type="text" class="form-control" id="usr" name="username" value="0.00" readonly>
                              </div>
                            </div>

                            <div class="col-md-4">
                              <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon3" style="background: #4dc3ff; color:#000000; font-weight: 90%;"><b> ยอดชำระรวม : </b></span>
                                </div>
                                <input style="text-align: right;background: #000000; color: #F0FF03; font-weight: 90%;" type="text" class="form-control" id="usr" name="username" value="0.00" readonly>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon3" style="background:#4dc3ff; color:#000000; font-weight: 90%;"><b>ยอดรวม VAT : </b></span>
                                </div>
                                <input style="text-align: right;background: #000000;color: #F0FF03; font-weight: 90%;" type="text" class="form-control" id="usr" name="username" value="0.00" readonly>
                              </div>
                            </div>
                          </div>
                        </div>
                      </section>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>



  <div align="center" id="overlay" onclick="off()">
    <img style="margin-top: 15%;width: 10%;" src="<?php echo base_url(); ?>assets/images/loader.gif">
  </div>

</body>




<script type="text/javascript">
  function scan(page) {

    var oncheckstatusview = document.getElementById('oncheckstatusview').value;
    document.getElementById("oncheckstatusview").value = "";

    checkvalscan = () => {
      $(".userformscan").each(function() {
        if ($(this).val() === "" && $(this).val() === "") {
          $(this).addClass("thisnull");
          $(this).css("border", "2px solid red");
        } else {
          $(this).removeClass("thisnull");
          $(this).css("border", "");
          $(".bootstrap-select").css("border", "");
        }
        $(".bootstrap-select").removeClass("thisnull");
      });
      return $(".thisnull").length === 0 ? true : false;
    };

    var datestart = document.getElementById('datestart').value;
    var dateend = document.getElementById('dateend').value;
    var status = document.getElementById('status').value;

    if (checkvalscan() == false) {
      swal({
        title: "กรุณากรอกข้อมูลให้ครบ",
        type: "warning",
        dangerMode: true,
        button: "ปิด",

      }).then((willEdit) => {
        if (willEdit) {

        }
      });
    } else {
      document.getElementById('overlay').style.display = "block";
      $.ajax({
        type: "POST",
        url: "<?php echo site_url('Payment_controller/approvescan') ?>",
        data: $("#scan").serialize() + "&page=" + page,
      }).done(function(data) {
        $('#show').html(data);
        document.getElementById('overlay').style.display = "none";
      });
    }
  }
</script>


<script type="text/javascript">
  function New_Receive(statusview, count, Sum, page) {

    document.getElementById("oncheckstatusview").setAttribute("value", statusview);

    document.getElementById("scan").reset();

    var datas = "&statusview=" + statusview + "&count=" + count + "&Sum=" + Sum + "&page=" + page;

    document.getElementById('overlay').style.display = "block";

    $.ajax({
      type: "POST",
      url: "<?php echo site_url('Payment_controller/approvescan') ?>",
      data: $("#scan").serialize() + datas,
    }).done(function(data) {
      $('#show').html(data);
      document.getElementById('overlay').style.display = "none";
    })
  }
</script>


<script type="text/javascript">
  function CN(statusview, count, Sum, page) {


    document.getElementById("oncheckstatusview").setAttribute("value", statusview);

    document.getElementById("scan").reset();

    var datas = "&statusview=" + statusview + "&count=" + count + "&Sum=" + Sum + "&page=" + page;

    document.getElementById('overlay').style.display = "block";
    $.ajax({
      type: "POST",
      url: "<?php echo site_url('Payment_controller/approvescan') ?>",
      // data: datas,
      data: $("#scan").serialize() + datas,
    }).done(function(data) {

      $('#show').html(data);
      document.getElementById('overlay').style.display = "none";
    })
  }
</script>




<script type="text/javascript">
  function DISCOUNT(statusview, count, Sum, page) {
    document.getElementById("oncheckstatusview").setAttribute("value", statusview);

    document.getElementById("scan").reset();

    var datas = "&statusview=" + statusview + "&count=" + count + "&Sum=" + Sum + "&page=" + page;


    document.getElementById('overlay').style.display = "block";
    $.ajax({
      type: "POST",
      url: "<?php echo site_url('Payment_controller/approvescan') ?>",
      data: datas,
    }).done(function(data) {
      $('#show').html(data);
      document.getElementById('overlay').style.display = "none";
    })
  }
</script>

<script type="text/javascript">
  function ADJUST(statusview, count, Sum, page) {
    document.getElementById("oncheckstatusview").setAttribute("value", statusview);

    document.getElementById("scan").reset();
    var datas = "&statusview=" + statusview + "&count=" + count + "&Sum=" + Sum + "&page=" + page;
    document.getElementById('overlay').style.display = "block";
    $.ajax({
      type: "POST",
      url: "<?php echo site_url('Payment_controller/approvescan') ?>",
      data: datas,
    }).done(function(data) {
      $('#show').html(data);
      document.getElementById('overlay').style.display = "none";
    })
  }
</script>

<script type="text/javascript">
  function REVOKE(statusview, count, Sum, page) {
    document.getElementById("oncheckstatusview").setAttribute("value", statusview);
    document.getElementById("scan").reset();
    var datas = "&statusview=" + statusview + "&count=" + count + "&Sum=" + Sum + "&page=" + page;
    document.getElementById('overlay').style.display = "block";
    $.ajax({
      type: "POST",
      url: "<?php echo site_url('Payment_controller/approvescan') ?>",
      data: datas,
    }).done(function(data) {
      $('#show').html(data);
      document.getElementById('overlay').style.display = "none";
    })
  }
</script>

<script type="text/javascript">
  function REFUND(statusview, count, Sum, page) {
    document.getElementById("oncheckstatusview").setAttribute("value", statusview);

    document.getElementById("scan").reset();
    var datas = "&statusview=" + statusview + "&count=" + count + "&Sum=" + Sum + "&page=" + page;

    document.getElementById('overlay').style.display = "block";

    $.ajax({
      type: "POST",
      url: "<?php echo site_url('Payment_controller/approvescan') ?>",
      data: datas,
    }).done(function(data) {
      $('#show').html(data);
      document.getElementById('overlay').style.display = "none";
    })
  }
</script>


<script type="text/javascript">
  function save() {

    var num = document.getElementById('sum').value;
    var datestart = document.getElementById('datestart').value;
    var dateend = document.getElementById('dateend').value;
    var status = document.getElementById('status').value;
    var Operator = document.getElementById('Operator').value;
    var idcustomer = document.getElementById('idcustomer').value;
    var oncheckstatusview = document.getElementById('oncheckstatusview').value;

    document.getElementById('overlay').style.display = "block";

    swal({
        title: "คุณแน่ใจหรือไม่ที่จะ APPROVE",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-primary",
        confirmButtonText: "APPROVE!",
        cancelButtonText: "ไม่ APPROVE!",
        closeOnConfirm: false,
        closeOnCancel: false,
        showLoaderOnConfirm: true,
      },

      function(isConfirm) {
        if (isConfirm) {
          $.ajax({
            type: "POST",
            url: "<?php echo site_url('Payment_controller/approve_updatet') ?>",
            data: $("#approve_updatet").serialize() + "&num=" + num + "&datestart=" + datestart + "&dateend=" + dateend + "&status=" + status + "&Operator=" + Operator + "&idcustomer=" +
              idcustomer + "&oncheckstatusview=" + oncheckstatusview,
          }).done(function(data) {

            setTimeout(function() {
              swal({
                  title: "APPROVE ข้อมูลสำเร็จ",
                  type: "success"
                },
                function() {
                  location.replace("approve");
                });
            }, 2000);
          })
          document.getElementById('overlay').style.display = "none";

        } else {

          swal("ไม่ APPROVE ข้อมูล", "", "error");
          document.getElementById('overlay').style.display = "none";

        }
      });
  }
</script>

</html>