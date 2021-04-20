<!DOCTYPE html>
<html lang="en">

<head>
    <title>All Report</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/font-awesome-4.7.0/css/font-awesome.min.css">
<!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />-->
    <!--<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>-->
    <link rel="stylesheet" href="<?php echo base_url() ?>dist/css/bootstrap.min.css?v=<?php echo date('Y-m-d H:i:s'); ?>">
<!--    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/util.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/main.css">-->

    <style>
/*        body {
            margin: 0;
            padding: 0;
            background-color: #f1f1f1;
        }*/

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
         tbody>tr>td:nth-child(3)
        {
            background-color: #f1f1f1;
            color: black;
            position: sticky;
            left: 82px;
        }
        th:nth-child(3){
            background-color: #5bc0de;
            color: black;
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
                                <h4 class="card-title"><b> <i class="fas fa-edit"></i> Sammary Report By Product Of Month </b></h3>
                            </div>
                            <div class="input-group-prepend" style=" margin-left: 52%">
                                <button type="button" class="btn btn-warning btn-sm" id="buttondata"><i class="fas fa-database"></i>  <b>ข้อมูลทั้งหมด : <?php //echo $count_all; ?> </b></button>
                            </div>  
                        </div>
                    </div>
                        
              <div class="card-body table-responsive p-0 " style="height:600px">
                  <table class="table table-hover" id="myTable">
                      <thead  style="background-color: gray;">
                          <tr>
<!--                          <th>Excel</th>
                              <th>PDF</th>-->
                              <th style=" white-space: nowrap;">Num</th>
                              <th style=" white-space: nowrap;">Port</th>
                              <th style=" white-space: nowrap;">Type</th>
                              <th style=" white-space: nowrap;">Date</th>
                              <th style=" white-space: nowrap;">รายการ</th>
                              <th style=" white-space: nowrap;">มูลค่าบริการ</th>
                              <th style=" white-space: nowrap;">จำนวนเงินภาษีมูลเพิ่ม</th>
                              <th style=" white-space: nowrap;">จำนวนเงินรวม</th>
                          </tr>
                      </thead>
                <tbody>

                   <tr>
<!--                    <td nowrap style="text-align:center; vertical-align: middle;">
                            <?php //echo $r->row; ?>
                        </td>
                        <td nowrap style="text-align:center; vertical-align: middle;">
                            <?php //echo iconv('tis-620//ignore', 'utf-8//ignore', $r->Port); ?>
                        </td>-->
                        <td nowrap style="text-align:center; vertical-align: middle;">
                     
                        </td>
                        <td nowrap style="text-align:center; vertical-align: middle;">
                            <?php  //echo (new DateTime($r->DateStart))->format("d/m/Y");?>&nbsp;
                        </td>
                        <td nowrap style="text-align:right; vertical-align: middle; padding-left: 20px;">
                            <?php //echo number_format($r->Bcost,2) ?>
                        </td>
                        <td nowrap style="text-align:right; vertical-align: middle; padding-left: 10px;">
                            <?php //echo number_format($r->EIR,5) ?>
                        </td>
                                <td nowrap style="text-align:center; vertical-align: middle;"> <?php //echo  (new DateTime($r->MONTH_YEAR))->format("d/m/Y");?>&nbsp;</td>   
                                <td nowrap style="text-align:right; vertical-align: middle;"> <?php //echo number_format($r->TransferFee,2) ?></td>
                                <td nowrap style="text-align:right; vertical-align: middle;"> <?php //echo number_format($r->CourtFee,2) ?></td>
                                <td nowrap style="text-align:right; vertical-align: middle;"> <?php //echo number_format($r->RevokeCustomer,2) ?></td>

                                </tr>

                                </tbody>
                            </table>
                       </div>
                    </div> 
                </div> 
            </div> 
        </div> 
</section>


       
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