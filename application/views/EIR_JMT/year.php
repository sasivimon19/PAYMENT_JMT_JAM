<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Year</title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/util.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/main.css">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />-->
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <link rel="stylesheet" href="<?php echo base_url() ?>dist/css/bootstrap.min.css?v=<?php echo date('Y-m-d H:i:s'); ?>">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/util.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/main.css">

    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        <style>
            /*        #header .active a {
                        background-color: #9c9cb2;
                        font-weight: bold;
                    }
            
                    .navbar {
                        overflow: hidden;
                        background-color: #333;
                        position: fixed;
                        top: 0;
                        width: 100%;
                    }*/

            /*        .navbar a {
                        float: right;
                        display: block;
                        color: #f2f2f2;
                        text-align: center;
                        padding: 14px 16px;
                        text-decoration: none;
                        font-size: 17px;
                        position: fixed;
                    }
            
                    .navbar a:hover {
                        background: #ddd;
                        color: black;
                    }
            
                    .main {
                        padding: 16px;
                        margin-top: 30px;
                        height: 1500px;
                    }

                   .p {
            
                        font-size: 14px;
                        line-height: 2.0;
                        color: #666666;
                        margin: 0px;
                    }
            
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

            */      
            td,
            tr,
            th {
                border: 1px solid #ddd;
                text-align: right;
                vertical-align: middle;
                padding: 1px;
            }

            th {
                background-color: #5bc0de;
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

            /*////////////////////////////////////////////////////////////////////////////////////*/
            /* Style the button that is used to open and close the collapsible content */
            /*        .collapsible {
                        background-color: #eee;
                        color: #444;
                        cursor: pointer;
            
                        width: 100%;
                        border: none;
                        text-align: center;
                        outline: none;
                        font-size: 15px;
                    }*/

            /* Add a background color to the button if it is clicked on (add the .active class with JS), and when you move the mouse over it (hover) */
/*                    .active,
                    .collapsible:hover {
                        background-color: #ccc;
                    }
            
                     Style the collapsible content. Note: hidden by default 
                    .content {
                        padding: 0 18px;
                        display: none;
                        overflow: hidden;
                        background-color: #f1f1f1;
                    }
            */
                    .openMonth {
                        cursor: pointer;
                    }
            
                    .openMonth:hover {
                        background-color: black;
                    }
            
/*                    thead>tr>th {
                        position: sticky;
                        top: 0px;
                        background-color: #5bc0de;
            
                    }*/
            
/*                    tbody>tr>td:nth-child(1) {
                        background-color: #f1f1f1;
                        color: black;
                        position: sticky;
                        left: 0;
                    }
            
                    th:nth-child(1) {
                        background-color: #5bc0de;
                        color: black;
                        position: sticky;
                        left: 0;
                        z-index: 1;
                    }*/
        </style>
    </head>

    <!--<h2 style="margin-top: 3%; text-align: center;margin-bottom: 14px;">Summary Per Year</h2>-->
    <button type="button" style="margin-left: 79.6%;" onclick="excel_year()" class="btn btn-success btn-sm"><i class="fa fa-file-excel-o"></i> ExportExcel</button>
    <!-- <button type="button" onclick="pdf_year()" class="btn btn-danger btn-sm"><i class="fa fa-file-pdf-o"></i> ExportPDF</button> -->
    <!--<div class="container">-->
    <!--<div class="col-md-12" style="margin-top: 1%;">-->
    <div class="table-responsive" style="margin-top: 1%;">

        <div id="main">
            <div class="wrapper">
                <div class="content-wrapper">
                    <section class="content" style=" padding-top:2%;">
                        <div class="container-fluid">
                            <div class="card card-secondary">
                                <div class="card-header" style="background-color: #c3000d;">
                                    <h3 class="card-title"> <b>REPORT PER YEAR</b> </h3>
<!--                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                    </div>-->
                                </div>
                                <div class="card-body">
                <!--<table id="user_data" border="1" style="background-color: white;" class="table table-striped table  table-hover">-->
             <!--<section class="content">-->
                                    <!--<div class="container-fluid">-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card">
                                               <div class="card-header" style="background-color: #E5E7E9">
                                                    <div class="row">
                                                        <div class="col-md-4" style=" color: black;">
                                                            <h3 class="card-title"><b> <i class="fas fa-edit"></i> แสดงข้อมูลตาราง REPORT PER YEAR </b></h3>
                                                        </div>
                                                        <div class="input-group-prepend" style=" margin-left: 50%">
                                                           <!--<a href="<?php //echo site_url('Payment_controller/Export_DailyReceiveReport')  ?>"><button type="button" class="btn btn-warning btn-sm"><i class="fas fa-cloud-download-alt"></i> <b>Export Daily Receive Report</b></button></a>-->
                                                            <button type="button" class="btn btn-warning btn-sm" onclick="excel_year()"><i class="fas fa-edit"></i> <b> Export Excel PER YEAR</b></button>
<!--                                                            <button type="button" style="margin-left: 79.6%;" onclick="excel_year()" class="btn btn-success btn-sm"><i class="fa fa-file-excel-o"></i> ExportExcel</button>-->
                                                        </div>  
                                                    </div>
                                                </div>   

                                                <div class="card-body table-responsive p-0">
                                                    <table class="table table-hover" id="myTable">
                                                        <thead  style="background-color: gray;">
                                                            <?php foreach ($sumyear as $index => $tableData) { ?>
                                                                       <?php if ($index === 0) { ?>
                                                                <thead>
                                                                    <tr>  
                                                                <?php foreach ($tableData as $key => $data) { ?>
                                                                            <th nowrap style="text-align:center;">
                                                                    <?php echo $key; ?>
                                                                            </th>
                                                                    <?php } ?>
                                                                    </tr>
                                                                </thead>
                                                                    <?php } ?>
                                                                  <?php } ?>
                                                            <?php foreach ($sumos as $index => $tbos) { ?>
                                                                <?php if ($index === 0) { ?>
                                                                <tbody id="tbodyid">
                                                                    <tr>
                                                                        <td style="background-color: #F0F8FF; color: black;">OS:</td>
                                                                        <?php foreach ($tbos as $rows) { ?>
                                                                            <td style="background-color: #F0F8FF; color: black;" <?php
                                                                            if (is_numeric($rows)) {
                                                                                echo "right";
                                                                            } else {
                                                                                echo "center";
                                                                            }
                                                                            ?>>
                                                                                    <?php
                                                                                    if (is_numeric($rows)) {
                                                                                        echo iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', number_format($rows, 2));
                                                                                    } else {
                                                                                        echo iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $rows);
                                                                                    }
                                                                                    ?>
                                                                            </td>
                                                                <?php } ?>
                                                                    </tr>
                                                                </tbody>
                                                            <?php } ?>
                                                        <?php } ?>

                                                            <?php foreach ($sumacct as $index => $tbacct) { ?>
                                                                <?php if ($index === 0) { ?>
                                                                <tbody id="tbodyid">
                                                                    
                                                                    <tr>
                                                                        <td style="background-color: #F0F8FF; color: black;">Account:</td>
                                                                        <?php foreach ($tbacct as $rows) { ?>
                                                                            <td style="background-color: #F0F8FF; color: black;" <?php
                                                                            if (is_numeric($rows)) {
                                                                                echo "right";
                                                                            } else {
                                                                                echo "center";
                                                                            }
                                                                            ?>>
                                                                                    <?php
                                                                                    if (is_numeric($rows)) {
                                                                                        echo iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', number_format($rows, 2));
                                                                                    } else {
                                                                                        echo iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $rows);
                                                                                    }
                                                                                    ?>
                                                                            </td>
                                                                <?php } ?>
                                                                    </tr>
                                                                </tbody>
                                                                <?php } ?>
                                                                
                                                                <?php } ?>

                                                        <?php foreach ($sumyear as $index => $tableData) { ?>
                                                             
                                                                
                                                            <tbody id="tbodyid">
                                                                <tr class="openMonth" onclick="openDetail('<?php echo 'tr-year' . $tableData->Year ?>');">

                                                                        <?php foreach ($tableData as $rows) { ?>
                                                                        <td <?php
                                                                                if (is_numeric($rows)) {
                                                                                    echo "right";
                                                                                } else {
                                                                                    echo "center";
                                                                                }
                                                                                ?>>
                                                                    <?php
                                                                    if (is_numeric($rows)) {
                                                                        echo iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', number_format($rows, 2));
                                                                    } else {
                                                                        echo iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $rows);
                                                                    }
                                                                    ?>
                                                                        </td>
                                                                    <?php } ?>
                                                                </tr>
                                                                        <?php
                                                                            foreach ($summonth as $ind => $tbmonth) {
                                                                                if ($tableData->Year == $tbmonth->Year) {
                                                                                    ?>
                                                                        <tr class="tr-year<?php echo $tableData->Year ?>" style="display: none;background-color: #F0F8FF;">
                                                                                    <?php foreach ($tbmonth as $r) { ?>
                                                                                <td style="background-color: #F0F8FF;"<?php
                                                                                if (is_numeric($r)) {
                                                                                    echo "right";
                                                                                } else {
                                                                                    echo "center";
                                                                                }
                                                                                ?>>
                                                                        <?php
                                                                        if (is_numeric($r)) {
                                                                            echo iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', number_format($r, 2));
                                                                        } else {
                                                                            echo iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r);
                                                                        }
                                                                        ?>
                                                                                </td>
                                                                            <?php } ?>
                                                                        </tr>
                                                                        <?php
                                                                        }
                                                                    }
                                                                    ?> 
                                                            </tbody>
                                                           <?php } ?>
                                                                        <?php foreach ($sumport as $index => $tbsum) { ?>
                                                                            <?php if ($index === 0) { ?>
                                                                <tbody id="tbodyid">
                                                                    <tr>
                                                                        <td style="background-color: black; color: white;">GrandTotal:</td>
                                                                <?php foreach ($tbsum as $rows) { ?>
                                                                            <td style="background-color: black; color: white;" <?php
                                                                    if (is_numeric($rows)) {
                                                                        echo "right";
                                                                    } else {
                                                                        echo "center";
                                                                    }
                                                                    ?>>
                                                                    <?php
                                                                    if (is_numeric($rows)) {
                                                                        echo iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', number_format($rows, 2));
                                                                    } else {
                                                                        echo iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $rows);
                                                                    }
                                                                    ?>
                                                                            </td>
                                                                   <?php } ?>
                                                                    </tr>
                                                                </tbody>
                                                                    <?php } ?>
                                                                <?php } ?>


                                                                    <?php foreach ($sumyear1 as $index => $tableData) { ?>
                                                                            <?php if ($index === 0) { ?>
                                                                <thead>
                                                                    <tr>  
                                                                                <?php foreach ($tableData as $key => $data) { ?>

                                                                        <?php } ?>
                                                                    </tr>
                                                                </thead>
                                                                <?php } ?>
                                                            <tbody id="tbodyid">
                                                                <tr class="openMonth" onclick="openDetail1('<?php echo 'tr-year1' . $tableData->Year ?>');">
                                                                    <?php foreach ($tableData as $rows) { ?>
                                                                        <td <?php
                                                                        if (is_numeric($rows)) {
                                                                            echo "right";
                                                                        } else {
                                                                            echo "center";
                                                                        }
                                                                        ?>>
                                                                                <?php
                                                                                if (is_numeric($rows)) {
                                                                                    echo iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', number_format($rows, 2));
                                                                                } else {
                                                                                    echo iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $rows);
                                                                                }
                                                                                ?>
                                                                        </td>
                                                                <?php } ?>
                                                                </tr>
                                                            <?php
                                                            foreach ($summonth1 as $ind => $tbmonth) {
                                                                if ($tableData->Year == $tbmonth->Year) {
                                                                    ?>
                                                                        <tr class="tr-year1<?php echo $tableData->Year ?>" style="display: none;background-color: #F0F8FF;">
                                                                            <?php foreach ($tbmonth as $r) { ?>
                                                                                <td style="background-color: #F0F8FF;"<?php
                                                                                if (is_numeric($r)) {
                                                                                    echo "right";
                                                                                } else {
                                                                                    echo "center";
                                                                                }
                                                                                ?>>
                                                                                    <?php
                                                                                        if (is_numeric($r)) {
                                                                                            echo iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', number_format($r, 2));
                                                                                        } else {
                                                                                            echo iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r);
                                                                                        }
                                                                                        ?>
                                                                                </td>
                                                                                <?php } ?>
                                                                        </tr>
                                                                <?php
                                                                }
                                                            }
                                                            ?> 
                                                            </tbody>
                                                <?php } ?>
                                                <?php foreach ($sumport1 as $index => $tbsum) { ?>
                                                    <?php if ($index === 0) { ?>
                                                                <tbody id="tbodyid">
                                                                    <tr>
                                                                        <td style="background-color: black; color: white;">GrandTotal:</td>
                                                                                <?php foreach ($tbsum as $rows) { ?>
                                                                                         <td style="background-color: black; color: white;" <?php
                                                                                    if (is_numeric($rows)) {
                                                                                        echo "right";
                                                                                    } else {
                                                                                        echo "center";
                                                                                    }
                                                                                    ?>>
                                                                                    <?php
                                                                                    if (is_numeric($rows)) {
                                                                                        echo iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', number_format($rows, 2));
                                                                                    } else {
                                                                                        echo iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $rows);
                                                                                    }
                                                                                    ?>
                                                                                     </td>
                                                                                <?php } ?>
                                                                    </tr>
                                                                </tbody>
                                                                    <?php } ?>
                                                                <?php } ?>
                                                    </table>
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

            </html>

            <script>

                function w3_open() {
                    document.getElementById("mySidebar").style.display = "block";
                    document.getElementById("myOverlay").style.display = "block";
                }

                function w3_close() {
                    document.getElementById("mySidebar").style.display = "none";
                    document.getElementById("myOverlay").style.display = "none";
                }

                function openDetail(year_id) {
                    $("." + year_id).toggle();
                }

                function openDetail1(year_id1) {
                    $("." + year_id1).toggle();
                }

                function excel_year() {
                    var datas = '';
                    $.ajax({
                        type: "POST",
                        url: window.open("<?php echo site_url('port/excel_year') ?>"),
                        data: datas,
                    }).done(function (data) {

                    });
                }

                function pdf_year() {
                    var datas = '';
                    $.ajax({
                        type: "POST",
                        url: window.open("<?php echo site_url('port/pdf_year') ?>"),
                        data: datas,
                    }).done(function (data) {

                    });
                }

            </script>