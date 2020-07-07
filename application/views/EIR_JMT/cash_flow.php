<!DOCTYPE html>
<html lang="en">

    <head>
        <title>All Report</title>
    <!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>-->


    <!--<link rel="stylesheet" href="<?php echo base_url() ?>dist/css/boostraps.min.css?v=<?php echo date('Y-m-d H:i:s'); ?>">-->

    <!--<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/util.css">-->
    <!--<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/main.css">-->

        <!--<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">--> 
       <!--<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>-->
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <style>
            /*        body {
                        margin: 0;
                        padding: 0;
                        background-color: #f1f1f1;
                    }
            
                    .box {
                        width: 900px;
                        padding: 20px;
                        background-color: #fff;
                        border: 1px solid #ccc;
                        border-radius: 5px;
                        margin-top: 10px;
                    }*/

            td,
            tr,
            th {
                border: 1px solid #ddd;
                text-align: right;
                vertical-align: middle;
                padding: 1px;


            }

            /*        th {
                        background-color: red;
                    }*/


            /* width */
            ::-webkit-scrollbar {
                width: 10px;
            }

            /* Track */
            ::-webkit-scrollbar-track {
                background: #f1f1f1;
            }

            /* Handle */
            ::-webkit-scrollbar-thumb {
                background: #888;
            }

            /* Handle on hover */
            ::-webkit-scrollbar-thumb:hover {
                background: #555;
            }
            th {
                position:sticky;
                top: 0px;
                background-color: #888;

            }


            tbody>tr>td:nth-child(1)
            {
                background-color: #f1f1f1;
                color: black;
                position: sticky;
                left: 0;
            }
            th:nth-child(1){
                background-color: #5bc0de;
                color: black;
                position: sticky;
                left: 0;
                z-index: 1;
            }
            tbody>tr>td:nth-child(2)
            {
                background-color: #f1f1f1;
                color: black;
                position: sticky;
                left: 41px;
            }
            th:nth-child(2){
                background-color: #5bc0de;
                color: black;
                position: sticky;
                left: 41px;
                z-index: 1;
            }


        </style>
    </head>

    <body>
    <center>

        <!--      <div style="width:100% ; display:flex; ">
                  <span style="align-self: flex-start; font-size:16px">ข้อมูลทั้งหมด <? echo $count_all; ?></span>
                  <span style=" font-size:17px; margin-left:36.8%;"><h3>Detail</h3></span>
                  <span style="align-self: flex-start; margin-left:auto; font-size:17px" >กระแสเงินสดเข้า: <?php //echo number_format($cals, 2) . ' ' . "บาท"  ?></span>
              </div>
        -->

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header" style="background-color: #E5E7E9">
                                <div class="row">
                                    <div class="col-md-4" style=" color: black; text-align: left;">
                                        <button type="button" class="btn btn-info btn-sm" id="buttondata"><i class="fas fa-database"></i>  <b>กระแสเงินสดเข้า: <?php echo number_format($cals, 2) . ' ' . "บาท" ?></b></button>
                                    </div>
                                    <div class="input-group-prepend" style=" margin-left: 52%">
        <!--                                     <p style="text-align: left">
                                        <?php //echo $count_all; ?>
                                        </p>-->
                                        <button type="button" class="btn btn-warning btn-sm" id="buttondata"><i class="fas fa-database"></i>  <b>ข้อมูลทั้งหมด : <?php echo $count_all; ?> </b></button>
                                       <!--<a href="<?php //echo site_url('Payment_controller/Export_DailyReceiveReport')   ?>"><button type="button" class="btn btn-warning btn-sm"><i class="fas fa-cloud-download-alt"></i> <b>Export Daily Receive Report</b></button></a>-->
                                       <!--<button type="button" class="btn btn-warning btn-sm" onclick="ExportDailyReceive()"><i class="fas fa-edit"></i> <b> Export Daily Receive Report </b></button>-->
                                    </div>  
                                </div>
                            </div>


                            <!--                    <div class="table-responsive " style="height:600px;width: 1166px;">
                                                    <table id="user_data" border="1" style="background-color: white;" class="table table-striped table  table-hover">
                                                        <thead>-->
                            <div class="card-body table-responsive p-0" style="height:600px;">
                                <table class="table table-hover" id="myTable">
                                    <thead  style="background-color: gray;">
                                        <tr>
                                            <th style=" white-space: nowrap;  text-align:center; vertical-align: middle;">Mob</th>
                                            <th style=" white-space: nowrap; text-align: center; vertical-align: middle;">Port</th>
                                            <th style=" white-space: nowrap;">MONTH_YEAR</th>
                                            <th style=" white-space: nowrap;">TransferFee</th>
                                            <th style=" white-space: nowrap;">CourtFee</th>
                                            <th style=" white-space: nowrap;">RevokeCustomer</th>
                                            <th style=" white-space: nowrap;">ลูกหนี้ต้นงวดบวกดอกเบี้ยสะสมคงค้างก่อน Provision</th>
                                            <th style=" white-space: nowrap;">Provision</th>
                                            <th style=" white-space: nowrap;">ลูกหนี้ต้นงวด Net Provision</th>
                                            <th style=" white-space: nowrap;">กระแสเงินสดเข้า</th>
                                            <th style=" white-space: nowrap;">รับรู้รายได้</th>
                                            <th style=" white-space: nowrap;">กระแสเงินสดคงเหลือ</th>
                                            <th style=" white-space: nowrap;">ดอกเบี้ยภายในเดือน</th>
                                            <th style=" white-space: nowrap;">ดอกเบี้ยสะสม</th>
                                            <th style=" white-space: nowrap;">ตัดดอกเบี้ย</th>
                                            <th style=" white-space: nowrap;">ดอกเบี้ยคงเหลือสะสม</th>
                                            <th style=" white-space: nowrap;">ตัดลูกหนี้</th>
                                            <th style=" white-space: nowrap;">รับรู้ร้อย</th>
                                            <th style=" white-space: nowrap;">ต้นเงินลงทุนคงเหลือ NetProvision</th>
                                            <th style=" white-space: nowrap;">ลูกหนี้ปลายงวด + ดอกเบี้ยสะสมคงค้าง</th>
                                            <th style=" white-space: nowrap;">NPV</th>
                                            <th style=" white-space: nowrap;">Provision ที่เกิดขึ้นภายในเดือน</th>
                                            <th style=" white-space: nowrap;">Provision เดือนถนัดไป</th>
                                            <th style=" white-space: nowrap;">Provision สะสมคงเหลือ</th>


                                        </tr>
                                    </thead>

                                    <tbody>

                                        <? if($count_all >0){?>
                                        <? $sumnumber= 0;

                                        foreach ($result as $r) {

                                        $CashReceive = $r->CashReceive;
                                        $sumnumber = $sumnumber + $CashReceive;
                                        ?>
                                        <tr nowrap>
                                            <td nowrap style="text-align:center; vertical-align: middle;" class="long"> <? echo $r->Mob; ?></td>
                                            <td nowrap style="text-align:center; vertical-align: middle;"> <? echo iconv('tis-620//ignore', 'utf-8//ignore', $r->Port); ?> </td>
                                            <? if($r->Today == 1){?>
                                            <td nowrap style="text-align:center; vertical-align: middle; background-color: red; color: yellow;"> <? echo  (new DateTime($r->MONTH_YEAR))->format("d/m/Y");?>&nbsp;</td> 
                                            <?}else{?>
                                            <td nowrap style="text-align:center; vertical-align: middle;"> <? echo  (new DateTime($r->MONTH_YEAR))->format("d/m/Y");?>&nbsp;</td>   
                                            <?}?>

                                            <td nowrap style="text-align:right; vertical-align: middle;"> <? echo number_format($r->TransferFee,2) ?></td>
                                            <td nowrap style="text-align:right; vertical-align: middle;"> <? echo number_format($r->CourtFee,2) ?></td>
                                            <td nowrap style="text-align:right; vertical-align: middle;"> <? echo number_format($r->RevokeCustomer,2) ?></td>
                                            <td nowrap style="text-align:right; vertical-align: middle;"> <? echo number_format($r->OS_Before_Provision,2) ?></td>
                                            <td nowrap style="text-align:right; vertical-align: middle;"> <? echo number_format($r->ProvisonOnMonth,2) ?></td>
                                            <td nowrap style="text-align:right; vertical-align: middle;"> <? echo number_format($r->OS_NetProvision,2) ?></td>
                                            <td nowrap style="text-align:right; vertical-align: middle;"> <? echo number_format($r->CashReceive,2) ?></td>
                                            <td nowrap style="text-align:right; vertical-align: middle;"> <? echo number_format($r->Receive,2) ?></td>
                                            <td nowrap style="text-align:right; vertical-align: middle;"> <? echo number_format($r->Cash_Balance,2) ?></td>
                                            <td nowrap style="text-align:right; vertical-align: middle;"> <? echo number_format($r->Interest,2) ?></td>
                                            <td nowrap style="text-align:right; vertical-align: middle;"> <? echo number_format($r->Cumulative_Interest,2) ?></td>
                                            <td nowrap style="text-align:right; vertical-align: middle;"> <? echo number_format($r->Cut_InterestOnMonth,2) ?></td>
                                            <td nowrap style="text-align:right; vertical-align: middle;"> <? echo number_format($r->Interest_BalanceOnMonth,2) ?></td>
                                            <td nowrap style="text-align:right; vertical-align: middle;"> <? echo number_format($r->Cut_OSDebt,2) ?></td>
                                            <td nowrap style="text-align:right; vertical-align: middle;"> <? echo number_format($r->Rec100,2) ?></td>
                                            <td nowrap style="text-align:right; vertical-align: middle;"> <? echo number_format($r->OS_BalanceNPV,2) ?></td>
                                            <td nowrap style="text-align:right; vertical-align: middle;"> <? echo number_format($r->OS_BalanceInterestLast,2) ?></td>
                                            <td nowrap style="text-align:right; vertical-align: middle;"> <? echo number_format($r->NPV,2) ?></td>
                                            <td nowrap style="text-align:right; vertical-align: middle;"> <? echo number_format($r->PV_BalanceOnMonth,2) ?></td>
                                            <td nowrap style="text-align:right; vertical-align: middle;"> <? echo number_format($r->PV_NetMonth,2) ?></td>
                                            <td nowrap style="text-align:right; vertical-align: middle;"> <? echo number_format($r->ProvisionCumulative,2) ?></td>
                                        </tr>
                                        <? } ?>
                                        <tr>
                                        </tr>
                                        <?}else{?>
                                        <tr>
                                            <td colspan="10" style="text-align:center; vertical-align: middle;">ไม่พบรายการข้อมูล</td>
                                        </tr>
                                        <?}?>
                                    </tbody>
                                </table>
                            </div>
                        </div> 
                    </div> 
                </div> 
            </div> 
        </section>
        <!--                      สูตรคำนวนหาจำนวนหน้า 
                   <div style="width: 100%;" class="text-center">
        <?php
        $total_record = $count_all;
        $total_page = ceil($total_record / $pageend);
        ?>
                       
        
                        <p class="card-description"> เลือกหน้า
                            <select id="pageing_cash" oninput="pageing123_cash()">
                                <option style="display: none;" value="<?php echo $numpage; ?>"><?php echo $numpage; ?></option>
                                        <?php for ($i = 1; $i <= $total_page; $i++) { ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php } ?>
                            </select>
                            ทั้งหมด <?php echo $i - 1; ?> หน้า </p>
                    </div>
        -->


    </body>

<script>
    function pageing123_cash() {
        var num_page = document.getElementById('pageing_cash').value;

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('port/pagingmain_cash?num_page=') ?>" + num_page,
            data: $("#search_form").serialize(),
        }).done(function (data) {
            $('#all_eir').html(data);

        });

    }
</script>