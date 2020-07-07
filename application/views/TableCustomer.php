

<?php if($Countcustomerall == 0){ ?>

<?php }else{ ?>

<section class="content" style=" margin-top: 4%;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="background-color: #E5E7E9; color: black;">
                        <div class="row">
                            <div class="col-md-4">
                                <h3 class="card-title"><b> <i class="fas fa-edit"></i> แสดงข้อมูลลูกค้า</b></h3>
                            </div>
                        </div>

                    </div>

                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <thead  style="background-color: gray;">
                                <tr>
                                    <th style="text-align: center; white-space:nowrap;">#</th>
                                    <th style="text-align: center; white-space:nowrap;">Contract No</th>
                                    <th style="text-align: center; white-space:nowrap;">IDCard</th>
                                    <th style="text-align: center; white-space:nowrap;">Name</th>
                                    <th style="text-align: center; white-space:nowrap;">Product</th>
                                    <th style="text-align: center; white-space:nowrap;">Operator</th>
                                    <th style="text-align: center; white-space:nowrap;">Lot</th>
                                    
                                    <th style="text-align: center;">Option</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $num = 1;
                                foreach ($customerall as $value) { 
                                ?>
                                <tr>
                                    <td style="white-space:nowrap;"><?php echo $value->row; ?></td>
                                    <td style="text-align: center; white-space:nowrap;"><?php echo $value->contract_no;  ?> </td>
                                    <td style="text-align: center; white-space:nowrap;"><?php echo $value->id_no;  ?></td>
                                    <td style="white-space:nowrap;"><?php echo iconv('tis-620', 'utf-8', $value->cus_name);  ?></td>
                                    <td style="white-space:nowrap;"><?php echo $value->product;  ?></td>
                                    <td style="white-space:nowrap;"><?php echo $value->operator_name;  ?></td>
                                    <td style="white-space:nowrap;"><?php echo $value->lot_no;  ?></td>
                                    <td style="text-align: center;"><a href="<?php echo site_url('Payment_controller/customer?id='); echo  base64_encode($value->contract_no); ?>" target="_blank"><button type="button" class="btn btn-info">Detail</button></a></td>
                                </tr>

                                <?php $num ++;}  ?>
                            </tbody>
                        </table>
                    </div>


                    <?php foreach ($Countcustomerall as $row) { ?>
                    <?php $total_record = $row->Count; ?>
                    <?php }  ?> 

                    <?php $total_page = ceil($total_record / $pageend);  ?> 
                    <div class="card-footer clearfix">
                        <ul class="pagination pagination-sm m-0 float-right">
                            <li class="page-item"><a class="page-link" onclick="pagedatapay(page = '')">&laquo;</a></li>
                            <?php for ($i = 1; $i <= $total_page; $i++) {  ?>  
                            <li class="page-item"><a class="page-link" onclick="pagedatapay(page = '<?php echo $i ?>')"><?php echo $i ?></a></li>
                        <?php }  ?>
                            <li class="page-item"><a class="page-link" onclick="pagedatapay(page = '<?php echo $total_page  ?>')">&raquo;</a></li>
                        </ul>
                    </div>



                </div>
            </div>
        </div>
    </div>
</section>

<?php } ?>






