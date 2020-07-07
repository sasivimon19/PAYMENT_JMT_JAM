
<div id="main">
    <div class="wrapper">
        <div class="content-wrapper">
            <section class="content" style=" padding-top:2%;">
                <div class="container-fluid">
                    <div class="card card-secondary">
                        <div class="card-header" style="background-color: #c3000d;">
                            <h3 class="card-title"> <b>LOG IMPORT</b> </h3>
                            <!--                            <div class="card-tools">
                                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                                        </div>-->
                        </div>
                        <div class="card-body">

                            <section class="content">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-header" style="background-color: #E5E7E9">
                                                    <div class="row">
                                                        <div class="col-md-4" style=" color: black;">
                                                            <h3 class="card-title"><b> <i class="fas fa-edit"></i> แสดงข้อมูลประวัติการ Import</b></h3>
                                                        </div>
                                                        <div class="input-group-prepend" style=" margin-left: 43%">
                                                           <!--<a href="<?php //echo site_url('Payment_controller/Export_DailyReceiveReport')   ?>"><button type="button" class="btn btn-warning btn-sm"><i class="fas fa-cloud-download-alt"></i> <b>Export Daily Receive Report</b></button></a>-->
                                                            <!--<button type="button" class="btn btn-warning btn-sm" onclick="ExportDailyReceive()"><i class="fas fa-edit"></i> <b> Export Daily Receive Report </b></button>-->
                                                        </div>  
                                                    </div>
                                                </div>

                                                <div class="card-body table-responsive p-0">
                                                    <table class="table table-hover" id="myTable">
                                                        <thead  style="background-color: gray;">
                                                            <tr>
                                                                <th style="text-align: center;">No</th> 
                                                                <th style="text-align: center; white-space:nowrap;">MONTH_YEAR</th>
                                                                <th style="text-align: center; white-space:nowrap;">Cash_Before</th>
                                                                <th style="text-align: center; white-space:nowrap;">Cash_After</th>
                                                                <th style="text-align: center; white-space:nowrap;">Date_Update</th>
                                                                <th style="text-align: center; white-space:nowrap;">IDEmp</th>
                                                                <th style="text-align: center; white-space:nowrap;">NameEmp</th>
                                                                <th style="text-align: center; white-space:nowrap;">Log_Event</th>

                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            <?php
                                                            $no = 1;
                                                            foreach ($result as $key) {
                                                                ?>
                                                                <tr>
                                                                    <td style="text-align: center; white-space:nowrap;"><?php echo $key->row; ?></td> 
                                                                    <td style="text-align: center; white-space:nowrap;"><?php echo iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $key->MONTH_YEAR); ?></td>
                                                                    <td style="text-align: right; white-space:nowrap;"><?php echo number_format($key->Cash_Before); ?></td>
                                                                    <td style="text-align: right;"><?php echo iconv('tis-620', 'utf-8', number_format($key->Cash_After)); ?></td>
                                                                    <td style="text-align: center; white-space:nowrap;"><?php iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $key->Date_Update); ?></td>
                                                                    <td style="white-space:nowrap;"><?php echo $key->IDEmp; ?></td>
                                                                    <td style="text-align: center; white-space:nowrap;"><?php iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $key->NameEmp); ?></td>
                                                                    <td style="text-align: center; white-space:nowrap;"><?php echo $key->Log_Event; ?></td>
                                                                </tr>
                                                                <?php
                                                                $no++;
                                                            }
                                                            ?>

                                                        </tbody>
                                                    </table>
                                                </div>

                                                <?php foreach ($Countresult as $row) { ?>
                                                    <?php  $total_record = $row->Count; ?>
                                                <?php } ?> 


                                                <?php  $total_page = ceil($total_record / $pageend); ?> 
                                                <div class="card-footer clearfix">
                                                    <ul class="pagination pagination-sm m-0 float-right">
                                                        <li class="page-item"><a class="page-link" onclick="pagedatapay(page = '')">&laquo;</a></li>
                                                        <?php for ($i = 1; $i <= $total_page; $i++) { ?>  
                                                            <li class="page-item"><a class="page-link" onclick="pagedatapay(page = '<?php echo $i   ?>')"><?php echo $i   ?></a></li>
                                                        <?php } ?>
                                                        <li class="page-item"><a class="page-link" onclick="pagedatapay(page = '<?php echo $total_page    ?>')">&raquo;</a></li>
                                                    </ul>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </section>    
    </div>
</div>         

<div id="show"></div>

<script>
        function pagedatapay(page){	 //แนบตัวแปร page ไปด้วย
alert('00000');
       var datas = "page="+page; 
       
       alert(datas);
       
             $.ajax({
                type:"POST",
                url:"<?php echo site_url('Call_ShowLog/getShowLog') ?>",
                data:datas,
              }).done(function(data){	
                 $('#show').html(data);  //Div ที่กลับมาแสดง
             }) 	
}
</script>