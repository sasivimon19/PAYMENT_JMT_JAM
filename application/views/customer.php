<!DOCTYPE html>
<html>

<head>
    <title>ข้อมูลลูกค้า</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/font-awesome-4.7.0/css/font-awesome.min.css">
    <link href="<?php echo base_url(); ?>assets/sweetalert/dist/sweetalert.css" rel="stylesheet" type="text/css">
    <script src="<?php echo base_url(); ?>assets/sweetalert/dist/sweetalert.min.js"></script>
    <script src="<?php echo base_url(); ?>AdminLTE/plugins/jquery/jquery.min.js"></script>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/2.css">
    <script type='text/javascript' src="<?php echo base_url(); ?>js/js.js"></script>
</head>

<body>
    <div class="wrapper">
        <div class="content-wrapper">
            <section class="content" style=" padding-top:2%;">
                <div class="container-fluid">
                    <div class="card card-secondary">
                        <div class="card-header" style="background-color: #c3000d;">
                            <h3 class="card-title"> <b> ข้อมูลลูกค้า </b> </h3>
                        </div>
                        <div class="card-body">
                            <div class="divvv w3-animate-right" style="background-color:#FFFFFF;">
                                <div class="row" style="width: 100%;">
                                    <table style="width: 100%;">
                                        <tr>
                                            <td style="width: 20%;">
                                            </td>
                                            <td style="width: 60%;">
                                                <div class="grid-container">
                                                    <div class="col-sm-4">
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="width: 20%;text-align: right;">
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div align="center" class="row content">
                                    <?php foreach ($Cm as $data) { ?>

                                        <table style="width: 97%;" class="">
                                            <tr>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="col-xs-4">
                                                            <label for="first_name">IDCard:</label>
                                                            <input type="text" class="form-control" name="first_name" id="first_name" value="<?= $data->id_no ?>" readonly>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="col-xs-4">
                                                            <label for="last_name">Contract No:</label>
                                                            <input type="text" class="form-control" name="last_name" id="last_name" value="<?php echo iconv('tis-620', 'utf-8', $data->contract_no) ?>" readonly>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="col-xs-4" style="width: 100%;">
                                                            <label for="last_name">Name:</label>
                                                            <input type="text" class="form-control" name="last_name" id="last_name" value="<?php echo iconv('tis-620', 'utf-8', $data->cus_name) ?>" readonly>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>

                                                <td>
                                                    <div class="form-group">
                                                        <div class="col-xs-4">
                                                            <label for="phone">Product:</label>
                                                            <input type="text" class="form-control" name="product" id="product" value="<?php echo iconv('tis-620', 'utf-8', $data->product) ?>" readonly>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="col-xs-4">
                                                            <label for="mobile">Lot: </label>
                                                            <input type="text" class="form-control" name="lot_no" id="lot_no" value="<?php echo $data->lot_no ?>" readonly>
                                                        </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="col-xs-4">
                                                            <label for="email">Address1:</label>
                                                            <input type="" rows="5" cols="40" class="form-control" name="email" id="email" value="<?php echo iconv('tis-620', 'utf-8', $data->address1) ?>" readonly>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="col-xs-4">
                                                            <label for="email">Address2:</label>
                                                            <input type="" rows="5" cols="40" class="form-control" id="location" value="<?php echo iconv('tis-620', 'utf-8', $data->address2) ?>" readonly>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="col-xs-4">
                                                            <label for="password">Province:</label>
                                                            <input type="" class="form-control" name="password" id="password" value="<?php echo iconv('tis-620', 'utf-8', $data->province) ?>" readonly>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="col-xs-4">
                                                            <label for="password2">Postal:</label>
                                                            <input type="" class="form-control" name="password2" id="password2" value="<?php echo iconv('tis-620', 'utf-8', $data->postal) ?>" readonly>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="col-xs-4" style="width: 100%;">
                                                            <label for="mobile">Operator:</label>
                                                            <input type="text" style="color:red; font-size:20px;" class="form-control" name="mobile" id="mobile" value="<?php echo iconv('tis-620', 'utf-8', $data->operator_name) ?>" readonly>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="col-xs-4" style="width: 100%;">
                                                            <label for="mobile">สถานะ:</label>
                                                            <input type="text" style="color:red; font-size:20px;" class="form-control" name="mobile" id="mobile" value="<?php echo iconv('tis-620', 'utf-8', $data->status) ?>" readonly>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="col-xs-4" style="width: 100%;">
                                                            <label for="first_name">Beginning Balance:</label>
                                                            <input type="text" style="background-color:#000000; color:red; font-size:20px;" class="form-control" name="first_name" id="first_name" value="<?php echo number_format($data->b_balance, 2) ?>" readonly>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="col-xs-4" style="width: 100%;">
                                                            <label for="last_name">Ending Balance:</label>
                                                            <input type="text" style="background-color:#000000; color:red; font-size:20px;" class="form-control text2" name="last_name" id="last_name" value="<?php echo number_format($data->e_balance, 2) ?>" readonly>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>


                                        <?php } ?>
                                        <?php foreach ($receive as $data) { ?>

                                            <tr>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="col-xs-4" style="width: 100%;">
                                                            <label for="phone">จำนวนเงินเกินภาษี:</label>
                                                            <input type="text" class="form-control" name="phone" id="phone" value="<?php echo number_format($data->amount, 2) ?>" readonly>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="col-xs-4" style="width: 100%;">
                                                            <label for="mobile">ภาษี:</label>
                                                            <input type="text" class="form-control" name="mobile" id="mobile" value="<?php echo number_format($data->vatamount, 2) ?>" readonly>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="col-xs-4" style="width: 100%;">
                                                            <label for="mobile">จำนวนเงินรับชำระภาษีรวม:</label>
                                                            <input type="text" class="form-control" name="mobile" id="mobile" value="<?php echo number_format($data->amount, 2) ?>" readonly>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        </table>
                                </div>
                                <br />
                                <div align="center" class="row content">
                                    <div style="width: 97%;overflow: auto;">
                                        <table class="table table-dark table-striped table-bordered" style="white-space: nowrap;font-size: 0.8em;">
                                            <thead>
                                                <tr style="background-color:#040404;">
                                                    <th style="color: #FFFFFF;">No</th>
                                                    <th style="color: #FFFFFF;">r_index</th>
                                                    <th style="color: #FFFFFF;">DateReceive</th>
                                                    <th style="color: #FFFFFF;">Chennel</th>
                                                    <th style="color: #FFFFFF;">Ref No.1</th>
                                                    <th style="color: #FFFFFF;">Ref No.2</th>
                                                    <th style="color: #FFFFFF;">Amount</th>
                                                    <th style="color: #FFFFFF;">VateAmount</th>
                                                    <th style="color: #FFFFFF;">Invoicone</th>
                                                    <th style="color: #FFFFFF;">State</th>
                                                    <th style="color: #FFFFFF;">Keytype</th>
                                                    <th style="color: #FFFFFF;">SaveEmpBy</th>
                                                    <th style="color: #FFFFFF;">DateSave</th>
                                                    <th style="color: #FFFFFF;">Approve</th>
                                                    <th style="color: #FFFFFF;">DateApprove</th>
                                                    <th style="color: #FFFFFF;">Remark</th>
                                                </tr>
                                            </thead>
                                            <?php $no = 1;
                                            foreach ($Showreceive as $row) { ?>
                                                <tbody>
                                                    <tr>
                                                        <td><?php echo $no; ?></td>
                                                        <td><?php echo $row->r_index; ?></td>
                                                        <td><?php echo date('m-d-Y', strtotime($row->DateReceive)); ?></td>
                                                        <td><?php echo iconv('tis-620', 'utf-8', $row->Chennel); ?></td>
                                                        <td><?php echo iconv('tis-620//ignore', 'UTF-8//ignore', $row->Refno1); ?></td>
                                                        <td><?php echo iconv('tis-620', 'utf-8', $row->Refno2); ?></td>
                                                        <td style="text-align: right;"><?php echo number_format($row->Amount, 2) ?></td>
                                                        <td style="text-align: right;"><?php echo number_format($row->Vatamount, 2); ?></td>
                                                        <td><?php echo iconv('tis-620', 'utf-8', $row->Invoiceno); ?></td>
                                                        <td style="color:red;"><?php echo iconv('tis-620', 'utf-8', $row->State) ?></td>
                                                        <td><?php echo iconv('tis-620', 'utf-8', $row->Keytype); ?></td>
                                                        <td><?php echo $row->SaveEmpBy; ?></td>
                                                        <td><?php echo $row->DateSave; ?></td>
                                                        <td><?php echo iconv('tis-620', 'utf-8', $row->ApproveEmpBy); ?></td>
                                                        <td><?php echo  date('m-d-Y', strtotime($row->DateApprove)); ?></td>
                                                        <td><?php echo iconv('tis-620', 'utf-8', $row->Remark); ?></td>
                                                    </tr>
                                                </tbody>
                                            <?php $no++;
                                            } ?>

                                        </table>
                                    </div>
                                </div>
                                <br>
                                <a href="<?php echo site_url('Payment_controller/customer_index'); ?>"><button type="button" class="btn btn-danger">Black</button></a>
                            </div>
                        </div>
                    </div>
            </section>
        </div>
    </div>
    </div>

</body>

</html>