<!DOCTYPE html>
<html>
    <title>Payment</title>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
        <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>css/1.css">
        <script type = 'text/javascript' src = "<?php echo base_url(); ?>js/js.js"></script>
      <!--  <link href="<?php echo base_url(); ?>assets/DataTables/DataTables-1.10.18/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"> 
        <script src="<?php echo base_url(); ?>assets/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">-->

    <body>
        <div id="main" style=" margin-top: 5%;">
            <div class="wrapper">
                <div class="content-wrapper">
                    <section class="content" style=" padding-top:2%;">
                        <div class="container-fluid">
                            <div class="card card-secondary">
                                <div class="card-header" style="background-color: #c3000d;">
                                    <h3 class="card-title"> <b> ช่องทางการชำระเงิน </b> </h3>
                                </div>
                                <div class="card-body">
                                    <form id ="brand" method = "post" action ="<?php echo site_url('Payment_controller/insert_channel'); ?>" enctype = "multipart/form-data">
                                        <div class="col-md-12">     
                                            <div class="row" style=" margin-top: 2%;"> 
                                                <div class="col-md-2">
                                                    <div class="input-group mb-4">
                                                        <div class="input-group-prepend">
                                                            <button type="button" class="btn btn-default "  style="background-color:#D3D3D3;"><b> รหัส </b></button>
                                                        </div>
                                                        <input id="code" name="code" type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="input-group mb-4">
                                                        <div class="input-group-prepend">
                                                            <button type="button" class="btn btn-default "  style="background-color: #D3D3D3;"><b> รายละเอียด </b></button>
                                                        </div>
                                                        <input  id="detail" name="detail" type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="input-group mb-4">
                                                        <button type="summit"  class="btn btn-default "  style="background-color: #D3D3D3;"><b> เพิ่ม </b></button>
                                                    </div>
                                                </div>
                                                
<!--                                                <div class="input-group col-md-2" >
                                                    <div class="input-group-prepend">
                                                        <select class ="form-control" id="maxRows"> 
                                                            <option value="5000" >Show ALL Rows</option>
                                                            <option value="5">5</option>
                                                            <option value="10">10</option>
                                                            <option value="15" >15</option>
                                                            <option value="20">20</option>
                                                            <option value="50">50</option>
                                                            <option value="70">70</option>
                                                            <option value="100">100</option>
                                                        </select>
                                                    </div>   
                                                </div>-->
                                                
                                            </div>
                                        </div>
                                        <br>
                                    </form>


                                    <div class="card-body table-responsive p-0">
                                        <table class="table table-hover"  id="table-data">
                                            <thead  style="background-color: gray;">
                                                <tr>
                                                    <th style="text-align: center; white-space:nowrap;">No</th>
                                                    <th style="text-align: center; white-space:nowrap;">รหัส</th>
                                                    <th style="text-align: center; white-space:nowrap;">รายละเอียด</th>
                                                    <th style="text-align: center; white-space:nowrap;">วันที่</th>
                                                    <th style="text-align: center; white-space:nowrap;">Status</th>
                                                    <th style="text-align: center; white-space:nowrap;">Option</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $num = 1;
                                                foreach ($bank as $data) {
                                                    ?>
                                                    <tr>
                                                        <td style="text-align: center; white-space:nowrap;"><?php echo $num ?></td>
                                                        <td style=" white-space:nowrap;"><?php echo iconv('tis-620', 'utf-8', $data->code) ?></td>
                                                        <td style=" white-space:nowrap;"><?php echo iconv('tis-620', 'utf-8', $data->chennel) ?></td>
                                                        <?php if($data->date_insert != ''){ ?>
                                                         <td style=" white-space:nowrap;">
                                                            <?php echo date('d-m-Y', strtotime($data->date_insert)); ?>
                                                        </td>
                                                        <?php }else{ ?>
                                                        <td style="text-align: center; white-space:nowrap;">  <?php echo"--ไม่มีข้อมูลวันที่--" ;?></td>
                                                        <?php } ?>                                                       
                                                        <td style="text-align: center; white-space:nowrap;">
                                                            <?php foreach ($username as $row): ?>
                                                                <?php if ($row->user_level == 1) { ?>
                                                                    <?php if ($data->status == 0) { ?>
                                                                        <a href="<?php echo site_url('Payment_controller/status_channel?ID=' . $data->IDChennel); ?>"><button type="button" class="btn btn-danger" >ปิดใช้งาน</button></a>
                                                                    <?php } if ($data->status == 1) { ?>
                                                                        <a href="<?php echo site_url('Payment_controller/status_channel?ID=' . $data->IDChennel); ?>"><button type="button" class="btn btn-success" >เปิดใช้งาน</button></b></a>
                                                                    <?php } ?>
                                                                <?php } else { ?>
                                                                    <?php if ($data->status == 0) { ?>
                                                                        <a href="<?php echo site_url('Payment_controller/status_channel?ID=' . $data->IDChennel); ?>"><button type="button" class="btn btn-danger"  disabled>ปิดใช้งาน</button></a>
                                                                    <?php } if ($data->status == 1) { ?>
                                                                        <a href="<?php echo site_url('Payment_controller/status_channel?ID=' . $data->IDChennel); ?>"><button type="button" class="btn btn-success" disabled>เปิดใช้งาน</button></b></a>
                                                                    <?php } ?>
                                                                <?php } ?>
                                                        <?php endforeach; ?>                              
                                                        </td>
                                                        <td style="text-align: center; white-space:nowrap;">
                                                            <?php foreach ($username as $row): ?>
                                                                <?php if ($row->user_level == 1) { ?>
                                                                    <a href="<?php echo site_url('Payment_controller/delete_channel?ID=' . $data->IDChennel); ?>"><button type="button" class="btn btn-danger">Delete</button></a>
                                                                <?php } else { ?>
                                                                    <a href="<?php echo site_url('Payment_controller/delete_channel?ID=' . $data->IDChennel); ?>"><button type="button" class="btn btn-danger" disabled>Delete</button></a>
                                                                <?php
                                                                }
                                                            endforeach;
                                                            ?>
                                                        </td>
                                                    </tr>
                                            <?php $num++;} ?>
                                            </tbody>
                                        </table>                
                                    </div>

                                    <ul class="pagination justify-content-center">
                                        <li class="page-item" data-page="prev"><a class="page-link" href="#">Previous</a></li>
                                        <!-- Here the JS Function Will Add the Rows -->
                                        <li class="page-item" data-page="next" id="prev"><a class="page-link" href="#">Next</a></li>
                                    </ul>         

                                </div>
                                </section> 
                            </div>    

                        </div>
                </div>
                </body>


                <script>
                    getPagination('#table-data');
                   function getPagination(table) {

        var lastPage = 1;
        
        $('.pagination')
            .find('li')
            .slice(1, -1)
            .remove();
        var trnum = 0; 
        maxRows = 10; 
            
        $('.pagination').show();
        var totalRows = $(table + ' tbody tr').length;     
        $(table + ' tr:gt(0)').each(function() {
            trnum++;   
            if (trnum > maxRows) {
                $(this).hide(); 
            }
            if (trnum <= maxRows) {
                $(this).show();
            }
        }); 
            
        if (totalRows > maxRows) {
            var pagenum = Math.ceil(totalRows / maxRows);
            for (var i = 1; i <= pagenum; ) {
                $('.pagination #prev')
                    .before(
                    '<li class="page-item"data-page="' +
                        i +
                    '">\
                        <a class="page-link" href="#">' +
                            i++ +
                        '</a>\
                    </li>')
                    .show();
                } 
        } else{
            $('.pagination').hide();
        } 
            
        $('.pagination [data-page="1"]').addClass('active'); 
        $('.pagination li').on('click', function(evt) {
            evt.stopImmediatePropagation();
            evt.preventDefault();
            var pageNum = $(this).attr('data-page'); 
            var maxRows = 10; 
            if (pageNum == 'prev') {
                if (lastPage == 1) {
                    return;
                }
                pageNum = --lastPage;
            }
            if (pageNum == 'next') {
                if (lastPage == $('.pagination li').length - 2) {
                    return;
                }
                pageNum = ++lastPage;
            }
            lastPage = pageNum;
            var trIndex = 0; 
            $('.pagination li').removeClass('active'); 
            $('.pagination [data-page="' + lastPage + '"]').addClass('active'); 
                                    
            limitPagging();
            $(table + ' tr:gt(0)').each(function() {
                
                trIndex++; 
                if (
                    trIndex > maxRows * pageNum ||
                    trIndex <= maxRows * pageNum - maxRows
                    ) {
                    $(this).hide();
                } else {
                    $(this).show();
                } 
            }); 
        }); 
    
        limitPagging();
        

    }
    
function limitPagging(){

        if($('.pagination li').length > 7 ){
                if( $('.pagination li.active').attr('data-page') <= 3 ){
                $('.pagination li:gt(5)').hide();
                $('.pagination li:lt(5)').show();
                $('.pagination [data-page="next"]').show();
            }if ($('.pagination li.active').attr('data-page') > 3){
                $('.pagination li:gt(0)').hide();
                $('.pagination [data-page="next"]').show();
                for( let i = ( parseInt($('.pagination li.active').attr('data-page'))  -2 )  ; i <= ( parseInt($('.pagination li.active').attr('data-page'))  + 2 ) ; i++ ){
                    $('.pagination [data-page="'+i+'"]').show();

                }

            }
        }
    }
</script>











                <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
                <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
                <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
                <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
                <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
                <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
                <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
                <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
                <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>

<!--      <script>
        $(document).ready(function () {
          $('#myTable').DataTable({
            "pageLength": 5,
            "lengthMenu": [[5,10, 20, 50, 100, -1], [5,10, 20, 50, 100, "All"]]
          });
        });
      </script>-->

<!--   <script>

    var table = document.getElementById('myTable');

    for(var i = 1; i < table.rows.length; i++)
    {
      table.rows[i].onclick = function()
      {
       document.getElementById("code").value = this.cells[1].innerHTML;
       document.getElementById("des").value = this.cells[2].innerHTML;
       document.getElementById("cancel").disabled = false;
       document.getElementById("edit").disabled = false;
       document.getElementById("delete").disabled = false;


     };
   }

 </script> -->

                </html>



