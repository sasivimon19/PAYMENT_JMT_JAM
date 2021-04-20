<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>PAYMENT SYSTEM</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo base_url(); ?>assets/images/JMT-JAM.jpg" type="image/gif">
    <link href="<?php echo base_url(); ?>AdminLTE/plugins/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <link href="<?php echo base_url(); ?>AdminLTE/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>AdminLTE/dist/css/adminlte.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>AdminLTE/dist/css/adminlte.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>AdminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>AdminLTE/plugins/daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>AdminLTE/plugins/summernote/summernote-bs4.css" rel="stylesheet" type="text/css">

    <style>
        #fontp {
            font-size: 13px;
        }
    </style>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="" href="<?php echo site_url('Payment_controller/logout') ?>" style="color: red;"><i class="fas fa-sign-out-alt"></i> <b>LOGOUT</b></a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="<?php echo site_url('Payment_controller/loadpayment') ?>" class="brand-link">
                <img class="brand-image img-circle elevation-4" src="<?php echo base_url(); ?>assets/images/JMT-JAM.jpg">
                <span class="brand-text font-weight-light" style=" font-size: 16px;"><b>PAYMENT SESTEM</b></span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <?php foreach ($username as $row) { ?>
                            <?php $Subject_Right = $row->Subject_Right; ?>
                            <?php $name = iconv('TIS-620', 'UTF-8', $row->name); ?>
                        <?php } ?>
                        <img class="brand-image img-circle elevation-4" src="<?php echo base_url(); ?>assets/images/person-icon.png">
                        <span class="brand-text font-weight-light" style=" font-size: 16px; color: white;"><b><?php echo $name; ?></b></span>
                    </div>
                    <!--                        <div class="nav-item has-treeview">
                        <?php //foreach ($username as $row): 
                        ?>
                            <?php //if ($row->Subject_Right == 'SuperAdmin') { 
                            ?>
                           
                            <a class="d-block" href="<?php //echo site_url('/Payment_controller/Setting_index?id=') . $row->ID; 
                                                        ?>" class="nav-link"><i class="fas fa-users-cog"></i>  <b> Setting </b> </a>

                            <?php //} 
                            ?>
                        <?php //endforeach; 
                        ?>   
                         </div>-->
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item has-treeview">
                            <a href="<?php echo site_url('Payment_controller/loadpayment'); ?>" class="nav-link">
                                <i class="nav-icon fas fa-upload"></i>
                                <p><b>โหลดข้อมูล Payment</b></p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="<?php echo site_url('Payment_controller/approve'); ?>" class="nav-link">
                                <i class="nav-icon fas fa-book"></i>
                                <p><b>ตัดยอดรับชำระ Approve</b></p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="<?php echo site_url('Payment_controller/bank'); ?>" class="nav-link">
                                <i class="nav-icon fas fa-shopping-cart"></i>
                                <p><b>ช่องทางการชำระเงิน</b></p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="<?php echo site_url('Payment_controller/invoice'); ?>" class="nav-link">
                                <i class="nav-icon fas fa-file-invoice-dollar"></i>
                                <p><b>Run Invoice</b></p>
                            </a>
                        </li>

                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-copy"></i>
                                <p>
                                    REPORT
                                    <i class="fas fa-angle-left right"></i>
                                    <!--<span class="badge badge-info right">7</span>-->
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo site_url('Payment_controller/daily'); ?>" class="nav-link">
                                        <i class="nav-icon far fa-circle text-danger"></i>
                                        <p id="fontp"><b>Daily Receive Report</b></p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo site_url('Payment_controller/model2'); ?>" class="nav-link">
                                        <i class="nav-icon far fa-circle text-danger"></i>
                                        <p id="fontp"><b>Summary Receive Report</b></p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo site_url('Payment_controller/model3'); ?>" class="nav-link">
                                        <i class="nav-icon far fa-circle text-danger"></i>
                                        <p id="fontp"><b>Summary Discount Report</b></p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo site_url('Payment_controller/model4'); ?>" class="nav-link">
                                        <i class="nav-icon far fa-circle text-danger"></i>
                                        <p id="fontp"><b>Tax Report</b></p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo site_url('Payment_controller/model5'); ?>" class="nav-link">
                                        <i class="nav-icon far fa-circle text-danger"></i>
                                        <p id="fontp"><b>Outstanding Report(Detail)</b></p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo site_url('Payment_controller/model6'); ?>" class="nav-link">
                                        <i class="nav-icon far fa-circle text-danger"></i>
                                        <p style="font-size: 12px;"><b>Outstanding Report(Summary)</b></p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo site_url('Payment_controller/model7'); ?>" class="nav-link">
                                        <i class="nav-icon far fa-circle text-danger"></i>
                                        <p style="font-size: 12px;"><b>Export to Excel</b></p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo site_url('Payment_controller/model8'); ?>" class="nav-link">
                                        <i class="nav-icon far fa-circle text-danger"></i>
                                        <p id="fontp"><b>รายงานปรับปรุงรายวัน</b></p>
                                    </a>
                                </li>

                            </ul>
                        </li>

                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-database"></i>
                                <p>
                                    Report ข้อมูลรับรู้รายได้
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo site_url('Call_Import/Main'); ?>" class="nav-link">
                                        <i class="nav-icon fas fa-upload"></i>
                                        <p> Impoer Data </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo site_url('Call_EditData/MainEdit'); ?>" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p> Edit CashFlow </p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="<?php echo site_url('port/main_eir'); ?>" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p> Summary รับรู้รายได้ </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo site_url('port/year_sum'); ?>" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p> Report Per Year </p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="<?php echo site_url('Call_ShowLog/MainShow'); ?>" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p> Show Log </p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-database"></i>
                                <p>
                                    ข้อมูลและการตั้งค่า
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <?php foreach ($username as $row) : ?>
                                        <?php if ($row->Subject_Right == 'SuperAdmin') { ?>
                                            <a href="<?php echo site_url('/Payment_controller/Setting_index?id=') . $row->ID; ?>" class="nav-link">
                                                <i class="nav-icon fas fa-users-cog"></i>
                                                <p><b> Setting </b></p>
                                            </a>
                                        <?php } ?>
                                    <?php endforeach; ?>

                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo site_url('Payment_controller/customer_index'); ?>" class="nav-link">
                                        <i class="nav-icon fas fa-database"></i>
                                        <p><b>ข้อมูลลูกค้า</b></p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo site_url('Payment_controller/company'); ?>" class="nav-link">
                                        <i class="nav-icon fas fa-database"></i>
                                        <p><b>ข้อมูลบริษัท</b></p>
                                    </a>
                                </li>
                            </ul>
                        </li>


                    </ul>
                </nav>
            </div>
        </aside>


        <div class="col-md-12" id="Form_loadpayment" name="Form_loadpayment">
            <?php $this->load->view($Main_Homepayment); ?>
        </div>



        <script src="<?php echo base_url(); ?>AdminLTE/plugins/jquery/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>AdminLTE/plugins/jquery-ui/jquery-ui.min.js"></script>
        <script>
            $.widget.bridge('uibutton', $.ui.button)
        </script>
        <script src="<?php echo base_url(); ?>AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="<?php echo base_url(); ?>AdminLTE/plugins/chart.js/Chart.min.js"></script>
        <script src="<?php echo base_url(); ?>AdminLTE/plugins/sparklines/sparkline.js"></script>
        <script src="<?php echo base_url(); ?>AdminLTE/plugins/jqvmap/jquery.vmap.min.js"></script>
        <script src="<?php echo base_url(); ?>AdminLTE/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
        <script src="<?php echo base_url(); ?>AdminLTE/plugins/jquery-knob/jquery.knob.min.js"></script>
        <script src="<?php echo base_url(); ?>AdminLTE/plugins/moment/moment.min.js"></script>
        <script src="<?php echo base_url(); ?>AdminLTE/plugins/daterangepicker/daterangepicker.js"></script>
        <script src="<?php echo base_url(); ?>AdminLTE/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
        <script src="<?php echo base_url(); ?>AdminLTE/plugins/summernote/summernote-bs4.min.js"></script>
        <script src="<?php echo base_url(); ?>AdminLTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
        <script src="<?php echo base_url(); ?>AdminLTE/dist/js/adminlte.js"></script>
        <script src="<?php echo base_url(); ?>AdminLTE/dist/js/demo.js"></script>