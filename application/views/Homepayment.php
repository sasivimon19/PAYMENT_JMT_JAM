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
    <!--        <link href="<?php echo base_url(); ?>AdminLTE/dist/css/adminlte.min.css" rel="stylesheet" type="text/css">-->
    <link href="<?php echo base_url(); ?>AdminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>AdminLTE/plugins/daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>AdminLTE/plugins/summernote/summernote-bs4.css" rel="stylesheet" type="text/css">
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <!-- <script>
        axios.defaults.baseURL = '<//?php echo site_url(); ?>';
    </script> -->

    <style>
        #loadding {
            position: fixed;
            left: 0px;
            width: 100%;
            height: 100%;
            padding-left: 45%;
            padding-top: 15%;

        }

        .modal {
            display: none;
            position: fixed;
            height: 100%;
            background-color: rgb(0, 0, 0);
            /* Fallback color */
            background-color: rgba(0, 0, 0, 0.4);
            /* Black w/ opacity */
            padding-top: 0px;

        }
    </style>

    <style>
        #fontp {
            font-size: 10px;
        }

        #fontp2 {
            font-size: 16px;
        }

        @media only screen and (max-width: 800px) {
            #cantact_info {
                padding-right: 16rem;
            }
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
            <!-- <ul class="navbar-nav ml-auto"> -->
            <ul class="navbar-nav" id="cantact_info">
                <li class="nav-item">
                    <a class="nav-link " href="<?php echo site_url('Payment_controller/logout') ?>" style="color: red;"><i class="fas fa-sign-out-alt"></i> <b>LOGOUT</b></a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a onclick="$('#loadding').show();" href="<?php echo site_url('Payment_controller/loadpayment') ?>" class="brand-link">
                <img class="brand-image img-circle elevation-4" src="<?php echo base_url(); ?>assets/images/JMT-JAM.jpg">
                <span class="brand-text font-weight-light" style=" font-size: 16px;"><b>PAYMENT SYSTEM</b></span>
            </a>
            <!-- Sidebar -->
            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <?php foreach ($username as $row) { ?>
                            <?php $Subject_Right = $row->Subject_Right; ?>
                            <?php $name = iconv('TIS-620', 'UTF-8', $row->username); ?>
                        <?php } ?>
                        <img class="brand-image img-circle elevation-4" src="<?php echo base_url(); ?>assets/images/person-icon.png">
                        <span class="brand-text font-weight-light" style=" font-size: 16px; color: white;"><b><?php echo $name; ?></b></span>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <?php foreach ($username_menu as $row) { ?>

                            <?php if ($row->group_num == '1') { ?>

                                <!-- <//?php echo "<br>" . $row->link ?> -->
                                <li class="nav-item">
                                    <a onclick="$('#loadding').show();" href="<?php echo site_url('Payment_controller/' . $row->link); ?>" class="nav-link">
                                        <i class="<?php echo $row->icon; ?>"></i>
                                        <p id="fontp2"><b><?php echo iconv('tis-620', 'utf-8', $row->Subject); ?></b></p>
                                    </a>
                                </li>
                            <?php } else { ?>

                            <?php } ?>

                        <?php } ?>


                        <?php foreach ($username_menu as $row1) {
                            echo '';
                        } {
                            $group_num = $row1->group_num;
                        } ?>

                        <?php if ($group_num == '') {
                        } else if ($group_num == '2' ||  $group_num == '1' ||  $group_num == '0') { ?>
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-copy"></i>
                                    <p>
                                        REPORT
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">

                                    <?php foreach ($username_menu as $row) { ?>

                                        <?php if ($row->group_num == '2' && $row->Status_report == 'R' || $group_num == '1' && $row->Status_report == 'R' || $group_num == '0' && $row->Status_report == 'R') { ?>

                                            <li class="nav-item">
                                                <a onclick="$('#loadding').show();" href="<?php echo site_url('Payment_controller/' . $row->link); ?>" class="nav-link">
                                                    <i class="<?php echo $row->icon; ?>"></i>
                                                    <p id="fontp"><b><?php echo iconv('tis-620', 'utf-8', $row->Subject); ?></b></p>
                                                </a>
                                            </li>
                                        <?php } else { ?>

                                        <?php } ?>

                                    <?php } ?>
                                </ul>
                            <?php } ?>
                            </li>


                            <?php if ($group_num == '2') { ?>
                                <li class="nav-item has-treeview">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fas fa-copy"></i>
                                        <p>
                                            Report ข้อมูลรับรู้รายได้
                                            <i class="fas fa-angle-left right"></i>
                                        </p>
                                    </a>

                                    <?php foreach ($username_menu as $row) { ?>

                                        <?php if ($row->group_num == '2' && $row->Status_report == 'RS' || $row->group_num == '1' && $row->Status_report == 'RS') { ?>
                                            <ul class="nav nav-treeview">
                                                <li class="nav-item">
                                                    <a onclick="$('#loadding').show();" href="<?php echo site_url('port/' . $row->link); ?>" class="nav-link">
                                                        <i class="<?php echo $row->icon; ?>"></i>
                                                        <p id="fontp"><b><?php echo iconv('tis-620', 'utf-8', $row->Subject); ?></b></p>
                                                    </a>
                                                </li>
                                            </ul>
                                        <?php } else if ($row->group_num == '2' && $row->Status_report == 'RE' || $row->group_num == '1' && $row->Status_report == 'RE') { ?>
                                            <ul class="nav nav-treeview">
                                                <li class="nav-item">
                                                    <a onclick="$('#loadding').show();" href="<?php echo site_url('Call_EditData/' . $row->link); ?>" class="nav-link">
                                                        <i class="<?php echo $row->icon; ?>"></i>
                                                        <p id="fontp"><b><?php echo iconv('tis-620', 'utf-8', $row->Subject); ?></b></p>
                                                    </a>
                                                </li>
                                            </ul>
                                        <?php } else if ($row->group_num == '2' && $row->Status_report == 'NE' || $row->group_num == '1' && $row->Status_report == 'NE') { ?>
                                            <ul class="nav nav-treeview">
                                                <li class="nav-item">
                                                    <a onclick="$('#loadding').show();" href="<?php echo site_url('Call_Newport/' . $row->link); ?>" class="nav-link">
                                                        <i class="<?php echo $row->icon; ?>"></i>
                                                        <p id="fontp"><b><?php echo iconv('tis-620', 'utf-8', $row->Subject); ?></b></p>
                                                    </a>
                                                </li>
                                            </ul>
                                        <?php } else if ($row->group_num == '2' && $row->Status_report == 'LNE' || $row->group_num == '1' && $row->Status_report == 'LNE') { ?>
                                            <ul class="nav nav-treeview">
                                                <li class="nav-item">
                                                    <a onclick="$('#loadding').show();" href="<?php echo site_url('Call_LoadNewport/' . $row->link); ?>" class="nav-link">
                                                        <i class="<?php echo $row->icon; ?>"></i>
                                                        <p id="fontp"><b><?php echo iconv('tis-620', 'utf-8', $row->Subject); ?></b></p>
                                                    </a>
                                                </li>
                                            </ul>
                                        <?php } else if ($row->group_num == '2' && $row->Status_report == 'RM' || $row->group_num == '1' && $row->Status_report == 'RM') { ?>
                                            <ul class="nav nav-treeview">
                                                <li class="nav-item">
                                                    <a onclick="$('#loadding').show();" href="<?php echo site_url('Call_Import/' . $row->link); ?>" class="nav-link">
                                                        <i class="<?php echo $row->icon; ?>"></i>
                                                        <p id="fontp"><b><?php echo iconv('tis-620', 'utf-8', $row->Subject); ?></b></p>
                                                    </a>
                                                </li>
                                            </ul>
                                        <?php } else if ($row->group_num == '2' && $row->Status_report == 'L') { ?>
                                            <ul class="nav nav-treeview">
                                                <li class="nav-item">
                                                    <a onclick="$('#loadding').show();" href="<?php echo site_url('Call_ShowLog/' . $row->link); ?>" class="nav-link">
                                                        <i class="<?php echo $row->icon; ?>"></i>
                                                        <p id="fontp"><b><?php echo iconv('tis-620', 'utf-8', $row->Subject); ?></b></p>
                                                    </a>
                                                </li>
                                            </ul>
                                        <?php } ?>
                                    <?php } ?>
                                </li>
                            <?php } ?>


                            <?php foreach ($username as $row) : ?>
                                <?php if ($row->Subject_Right == 'SuperManager' && $row->Subject_Right != 'Manager' && $row->Subject_Right != 'User') { ?>
                                    <li class="nav-item has-treeview">
                                        <a href="#" class="nav-link ">
                                            <i class="nav-icon fas fa-database"></i>
                                            <p>
                                                ข้อมูลและการตั้งค่า
                                                <i class="fas fa-angle-left right"></i>
                                            </p>
                                        </a>
                                        <ul class="nav nav-treeview">
                                            <li class="nav-item">
                                                <a onclick="$('#loadding').show();" href="<?php echo site_url('/Payment_controller/Setting_index?id=') . $row->ID; ?>" class="nav-link">
                                                    <i class="nav-icon fas fa-users-cog"></i>
                                                    <p><b> Setting </b></p>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                <?php } ?>
                            <?php endforeach; ?>
                    </ul>
                </nav>
            </div>
        </aside>
    </div>



    <div class="col-md-12" id="Form_loadpayment" name="Form_loadpayment">
        <?php $this->load->view($Main_Homepayment); ?>
    </div>

    <div id="loadding" class="modal" style="display: none">
        <img style="margin-top: 15%;width: 15%;" src="<?php echo base_url(); ?>assets/images/loader.gif">
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