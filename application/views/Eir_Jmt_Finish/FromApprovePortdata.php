<!DOCTYPE html>
<html>
<title></title>

<head>
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/1.css">
    <script type='text/javascript' src="<?php echo base_url(); ?>js/js.js"></script> -->

    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/js/jquery-ui.css">

    <!-- <link href="<?php echo base_url(); ?>assets/DataTables/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"> -->
    <!-- <script src="<?php echo base_url(); ?>assets/DataTables/js/jquery.dataTables.min.js"></script> --> -->
    <style>
        #overlay {
            position: fixed;
            display: none;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 2;
            cursor: pointer;
        }
    </style>

    <style>
        legend {
            display: block;
            padding-left: 2px;
            padding-right: 2px;
            border: none;
        }
    </style>
    <meta http-equiv="content-type" charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SELECT DATA</title>
    <script src="<?php echo base_url(); ?>assets/js/sweetalert.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/js/bootstrap.min.css"> -->
    <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/js/jquery-ui.css"> -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/font-awesome-4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/styles.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/navbar.css">

</head>

<div class="loading" id="spinner"></div>

<div id="main">
    <!-- <div class="wrapper"> -->
    <div class="content-wrapper">
        <section class="content" style=" padding-top:2%;">
            <div class="card-body">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-edit"></i>
                            <b> Check Approve </b>
                            <button type="button" class="btn btn-light btn-sm" style="background-color:#cc0000; color: #ffffff;" onclick="goBack()"><b><i class="fas fa-angle-double-left"></i> Go Back </b></button>
                    </div>
                    </h3>

                    <div class="card-body">

                        <div class="row" style=" margin-top: 1%;">
                            <div class="col-md-12">
                                <?php $this->load->view('Eir_Jmt_Finish/Table_Newport'); ?>
                            </div>
                        </div>


                        <div align="center" id="showdatanewporadd">

                        </div>
                    </div>

                </div>
            </div>
        </section>


        <div align="center" id="overlay" onclick="off()">
            <img style="margin-top: 20%;width: 20%;" src="<?php echo base_url(); ?>assets/images/loader4.gif">
        </div>
    </div>
</div>

</body>