

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
            <?php
            $num = 1;
            foreach ($bank as $data) {
                ?>
                <tr>
                    <td style="text-align: center; white-space:nowrap;"><?php echo $num ?></td>
                    <td style=" white-space:nowrap;"><?php echo iconv('tis-620', 'utf-8', $data->code) ?></td>
                    <td style=" white-space:nowrap;"><?php echo iconv('tis-620', 'utf-8', $data->chennel) ?></td>
                        <?php if ($data->date_insert != '') { ?>
                        <td style=" white-space:nowrap;">
                        <?php echo date('d-m-Y', strtotime($data->date_insert)); ?>
                        </td>
                    <?php } else { ?>
                        <td style="text-align: center; white-space:nowrap;">  <?php echo"--ไม่มีข้อมูลวันที่--"; ?></td>
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

    <ul class="pagination justify-content-center">
        <li class="page-item" data-page="prev"><a class="page-link" href="#">Previous</a></li>
        <li class="page-item" data-page="next" id="prev"><a class="page-link" href="#">Next</a></li>
    </ul> 
</div>


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

