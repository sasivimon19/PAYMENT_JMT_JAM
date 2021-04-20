<!DOCTYPE html>
<html lang="en">

<head>
    <title>All Report</title>
<!--    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/font-awesome-4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/bootstrap.minn.css">
    <script src="<?php echo base_url(); ?>AdminLTE/plugins/jquery/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/util.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/mainn.css">-->
    
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link href="<?php echo base_url(); ?>assets/sweetalert/dist/sweetalert.css" rel="stylesheet" type="text/css"> 
    <script src="<?php echo base_url(); ?>assets/sweetalert/dist/sweetalert.min.js"></script> 
    <script src="<?php echo base_url(); ?>AdminLTE/plugins/jquery/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>css/1.css">
    <script type = 'text/javascript' src = "<?php echo base_url(); ?>js/js.js"></script> 

    <style>
        body {
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
        }

        td,
        tr,
        th {
            border: 1px solid #ddd;
            text-align: center;
            vertical-align: middle;
            padding: 1px;
        }

        th {
            background-color: #5bc0de;
            /*background-color: darkblue;*/
        }

        thead>tr>th
            {
                position:sticky;
                top: 0px;
                background-color: #5bc0de;
                
            }
            
        
        tbody>tr>td:nth-child(1)
        {
            background-color: #f1f1f1;
            color: black;
            position: sticky;
            left: 0;
        }
        th:nth-child(1){
            background-color: darkblue;
            color: white;
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
            background-color: darkblue;
            color: white;
            position: sticky;
            left: 41px;
            z-index: 1;
        }
         tbody>tr>td:nth-child(3)
        {
            background-color: #f1f1f1;
            color: black;
            position: sticky;
            left: 82px;
        }
        th:nth-child(3){
            background-color: darkblue;
            color: white;
            position: sticky;
            left: 82px;
            z-index: 1;
        }
        tbody>tr>td:nth-child(4)
        {
            background-color: #f1f1f1;
            color: black;
            position: sticky;
            left: 143px;
        }
        th:nth-child(4){
            background-color: #5bc0de;
            color: black;
            position: sticky;
            left: 143px;
            z-index: 1;
        }
        tbody>tr>td:nth-child(5)
        {
            background-color: #f1f1f1;
            color: black;
            position: sticky;
            left: 181px;
        }
        th:nth-child(5){
            background-color: #5bc0de;
            color: black;
            position: sticky;
            left: 181px;
            z-index: 1;
        } 
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
    </style>
    
    
    <style>
        @media only screen and (max-width: 600px) {
            #buttondata{
                margin-left: -80%;
            }
        }

    </style>

</head>

<body>
    
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="background-color: #E5E7E9">
                        <div class="row">
                            <div class="col-md-4" style=" color: black;">
                                <h3 class="card-title"><b> <i class="fas fa-edit"></i> แสดงข้อมูล Report</b></h3>
                            </div>
                            <div class="input-group-prepend" style=" margin-left: 52%">
                                <button type="button" class="btn btn-warning btn-sm" id="buttondata"><i class="fas fa-database"></i>  <b>ข้อมูลทั้งหมด : <?php echo $count_all; ?> </b></button>
                            </div>  
                        </div>
                    </div>
                        
              <div class="card-body table-responsive p-0 " style="height:600px">
                <table class="table table-hover" id="myTable">
                    <thead  style="background-color: gray;">
                     <tr>
                        <th style=" white-space: nowrap;">Excel</th>
                        <th style=" white-space: nowrap;">PDF</th>
                        <th style=" white-space: nowrap;">Detail</th>
                        <th style=" white-space: nowrap;">Num</th>
                        <th style=" white-space: nowrap;">Port</th>
                        <th style=" white-space: nowrap;">Type</th>
                        <th style=" white-space: nowrap;">Date</th>
                        <th style=" white-space: nowrap;">Bcost</th>
                        <th style=" white-space: nowrap;">EIR</th>
                        <!-- <th>Delete</th> -->
                        <th style=" white-space: nowrap;">MONTH_YEAR</th>
                        <th style=" white-space: nowrap;">TransferFee</th>
                        <th style=" white-space: nowrap;">CourtFee</th>
                        <th style=" white-space: nowrap;">RevokeCustomer</th>
                        <th style=" white-space: nowrap;">ลูกหนี้ต้นงวดบวกดอกเบี้ยสะสมคงค้างก่อน Provision</th>
                        <th style=" white-space: nowrap;">Provision</th>
                        <th style=" white-space: nowrap;">ลูกหนี้ต้นงวด Net Provision</th>
                        <th style=" white-space: nowrap;">ประมาณการรายได้</th>
                        <th style=" white-space: nowrap;">กระแสเงินสดเข้า</th>
                        <th style=" white-space: nowrap;">รับรู้รายได้</th>
                        <th style=" white-space: nowrap;">กระแสเงินสดคงเหลือ</th>
                        <th style=" white-space: nowrap;">ดอกเบี้ยภายในเดือน</th>
                        <th style=" white-space: nowrap;">ดอกเบี้ยสะสม</th>
                        <th style=" white-space: nowrap;">ตัดดอกเบี้ย</th>
                        <th style=" white-space: nowrap;">ดอกเบี้ยคงเหลือสะสม</th>
                        <th style=" white-space: nowrap;">ตัดลูกหนี้</th>
                        <th style=" white-space: nowrap;">ลูกหนี้ลดลง Provision ปัจจุบัน</th>
                        <th style=" white-space: nowrap;">ลูกหนี้ลดลง Provision สิ้นปี2019</th>
                        <th style=" white-space: nowrap;">รับรู้ร้อย</th>
                        <th style=" white-space: nowrap;">ต้นเงินลงทุนคงเหลือ NetProvision</th>
                        <th style=" white-space: nowrap;">ลูกหนี้ปลายงวด + ดอกเบี้ยสะสมคงค้าง</th>
                        <th style=" white-space: nowrap;">NPV</th>
                        <th style=" white-space: nowrap;">ผลต่าง ลูกหนี้ปลายงวดบวกดอกเบี้ยสะสมคงค้างกับ NPV</th>
                        <th style=" white-space: nowrap;">Provision ที่เกิดขึ้นภายในเดือน</th>
                        <th style=" white-space: nowrap;">Provision เก่าภายในเดือน</th>
                        <th style=" white-space: nowrap;">Provision สะสมคงเหลือ</th>
                        <th style=" white-space: nowrap;">Provision สะสมคงเหลือปี 2019</th>
                        <th style=" white-space: nowrap;">Provision สะสมคงเหลือทั้งหมด</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($count_all > 0){?>
                    <?php foreach ($result as $r) { ?>

                   <tr>
                       <td nowrap style="text-align:center; vertical-align: middle;">
                               <a type="submit" target="_blank" href="<?php echo site_url('port/excel1_cash?Port=') . iconv('TIS-620', 'UTF-8', $r->Port); ?>"><button type="button" class="btn btn-success btn-xs" name="excel1"><i class="fas fa-file-excel"></i></button></a>
                       </td>
                        <td nowrap style="text-align:center; vertical-align: middle;">
                               <a type="submit" target="_blank" href="<?php echo site_url('port/pdf1_cash?Port=') . iconv('TIS-620', 'UTF-8', $r->Port); ?>"><button type="button" class="btn btn-danger btn-xs" name="pdf1"><i class="fas fa-file-pdf"></i></button></a>
                        </td>
                        <td style="text-align:center; vertical-align: middle;">
                               <button type="button" class="btn btn-outline-danger btn-xs" name="Port" onclick="view(id='<?php echo $r->Port ?>')">
                                   <font color=#1aa3ff>View</font>
                               </button>
                        </td>
                        <td nowrap style="text-align:center; vertical-align: middle;">
                            <?php echo $r->row; ?>
                        </td>
                        <td nowrap style="text-align:center; vertical-align: middle;">
                            <?php echo iconv('tis-620//ignore', 'utf-8//ignore', $r->Port); ?>
                        </td>
                        <td nowrap style="text-align:center; vertical-align: middle;">
                            <?php echo $r->TypePort; ?>
                        </td>
                        <td nowrap style="text-align:center; vertical-align: middle;">
                            <?php  echo (new DateTime($r->DateStart))->format("d/m/Y");?>&nbsp;
                        </td>
                        <td nowrap style="text-align:right; vertical-align: middle; padding-left: 20px;">
                            <?php echo number_format($r->Bcost,2) ?>
                        </td>
                        <td nowrap style="text-align:right; vertical-align: middle; padding-left: 10px;">
                            <?php echo number_format($r->EIR,5) ?>
                        </td>
                                <td nowrap style="text-align:center; vertical-align: middle;"> <?php echo  (new DateTime($r->MONTH_YEAR))->format("d/m/Y");?>&nbsp;</td>   
                                <td nowrap style="text-align:right; vertical-align: middle;"> <?php echo number_format($r->TransferFee,2) ?></td>
                                <td nowrap style="text-align:right; vertical-align: middle;"> <?php echo number_format($r->CourtFee,2) ?></td>
                                <td nowrap style="text-align:right; vertical-align: middle;"> <?php echo number_format($r->RevokeCustomer,2) ?></td>
                                <td nowrap style="text-align:right; vertical-align: middle;"> <?php echo number_format($r->OS_Before_Provision,2) ?></td>
                                <td nowrap style="text-align:right; vertical-align: middle;"> <?php echo number_format($r->ProvisonOnMonth,2) ?></td>
                                <td nowrap style="text-align:right; vertical-align: middle;"> <?php echo number_format($r->OS_NetProvision,2) ?></td>
                                <td nowrap style="text-align:right; vertical-align: middle;"> <?php echo number_format($r->CashFlowIFRS,2) ?></td>
                                <td nowrap style="text-align:right; vertical-align: middle;"> <?php echo number_format($r->CashReceive,2) ?></td>
                                <td nowrap style="text-align:right; vertical-align: middle; padding-left: 20px;"> <?php echo number_format($r->Receive,2) ?></td>
                                <td nowrap style="text-align:right; vertical-align: middle;"> <?php echo number_format($r->Cash_Balance,2) ?></td>
                                <td nowrap style="text-align:right; vertical-align: middle;"> <?php echo number_format($r->Interest,2) ?></td>
                                <td nowrap style="text-align:right; vertical-align: middle;"> <?php echo number_format($r->Cumulative_Interest,2) ?></td>
                                <td nowrap style="text-align:right; vertical-align: middle;"> <?php echo number_format($r->Cut_InterestOnMonth,2) ?></td>
                                <td nowrap style="text-align:right; vertical-align: middle;"> <?php echo number_format($r->Interest_BalanceOnMonth,2) ?></td>
                                <td nowrap style="text-align:right; vertical-align: middle; padding-left: 80px;"> <?php echo number_format($r->Cut_OSDebt,2) ?></td>
                                <td nowrap style="text-align:right; vertical-align: middle;"> <?php echo number_format($r->Revert_ProvisionOnMonth,2) ?></td>
                                <td nowrap style="text-align:right; vertical-align: middle;"> <?php echo number_format($r->Revert_ProvisionOld,2) ?></td>
                                <td nowrap style="text-align:right; vertical-align: middle; padding-left: 20px;"> <?php echo number_format($r->Rec100,2) ?></td>
                                <td nowrap style="text-align:right; vertical-align: middle;"> <?php echo number_format($r->OS_BalanceNPV,2) ?></td>
                                <td nowrap style="text-align:right; vertical-align: middle;"> <?php echo number_format($r->OS_BalanceInterestLast,2) ?></td>
                                <td nowrap style="text-align:right; vertical-align: middle; padding-left: 20px;"> <?php echo number_format($r->NPV,2) ?></td>
                                <td nowrap style="text-align:right; vertical-align: middle;"> <?php echo number_format($r->PV_BalanceOnMonth,2) ?></td>
                                <td nowrap style="text-align:right; vertical-align: middle;"> <?php echo number_format($r->PV_NetMonth,2) ?></td>
                                <td nowrap style="text-align:right; vertical-align: middle;"> <?php echo number_format($r->PV_Old,2) ?></td>
                                <td nowrap style="text-align:right; vertical-align: middle;"> <?php echo number_format($r->ProvisionCumulative,2) ?></td>
                                <td nowrap style="text-align:right; vertical-align: middle;"> <?php echo number_format($r->ProvisionOld_Balance,2) ?></td>
                                <td nowrap style="text-align:right; vertical-align: middle;"> <?php echo number_format($r->Total_Provision_Balance,2) ?></td>
                                </tr>
                                <?php } ?>
                                <tr>  </tr>
                                <?php }else{?>
                                <tr>
                                    <td colspan="15" style=" text-align: center;">ไม่พบรายการข้อมูล</td>
                                </tr>
                                <?php }?>
                                </tbody>
                            </table>
                       </div>
                    </div> 
                </div> 
            </div> 
        </div> 
</section>


        <div style="width: 100%;" class="text-center">
            <?php
            $total_record = $count_all;
            $total_page = ceil($total_record / $pageend);
            ?>
            <!-- สูตรคำนวนหาจำนวนหน้า -->

            <p class="card-description"> เลือกหน้า
                <select id="pageing_eir" oninput="pageing123_eir()">
                    <option style="display: none;" value="<?php echo $numpage; ?>"><?php echo $numpage; ?></option>
                    <?php for ($i = 1; $i <= $total_page; $i++) { ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php } ?>
                </select>
                ทั้งหมด <?php echo $i - 1; ?> หน้า </p>
        </div>
        
</body>

<script>
    function excel_cash() {
        var datas = '';
        $.ajax({
            type: "POST",
            url: window.open("<?php echo site_url('port/excel_cash?') ?>" + $("#search_form").serialize()),
            data: datas,
        }).done(function(data) {

        });
    }
</script>