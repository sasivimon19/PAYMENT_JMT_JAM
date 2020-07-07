<!DOCTYPE html>
<html>
    <title>Summary Receive Report <?php foreach ($company as $data) { ?>
            <?php echo iconv('tis-620', 'utf-8', $data->name);
        } ?></title>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta name="viewport" content="width=device-width, initial-scale=1">

<!--        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->

<!--        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>css/1.css">
        <script type = 'text/javascript' src = "<?php echo base_url(); ?>js/js.js"></script>
        <link href="<?php echo base_url(); ?>assets/DataTables/DataTables-1.10.18/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"> 
        <script src="<?php echo base_url(); ?>assets/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js"></script>
<!--        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">-->
<!--        <style>
            .b {
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);overflow: auto;font-size: 0.9em;width: 99.9%;
            }
        </style>-->
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
                background-color: rgba(0,0,0,0.5);
                z-index: 2;
                cursor: pointer;
            }
        </style>
<!--        <style>
            .td {
                padding: 5px; 
            }

            .nav-tabs>li.active>a,.nav-tabs>li.active>a:focus,.nav-tabs>li.active>a:hover{
                color:#fff;
                cursor:default;
                background-color:#d94040;
                border:1px solid #ddd;
                border-bottom-color:transparent;
            }
        </style>-->
    </head>


        <!--        <div class="w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:none" id="mySidebar">
                <button style="text-align: right;" class="w3-bar-item w3-button w3-large"
                onclick="w3_close()"> &times;</button>
                <h5 style="text-align: center;">Menu</h5>
        <?php //foreach ($username_menu as $row){ ?>
        <?php //if ($row->group_num == '1') {  ?>
                        <a href="<?php //echo site_url('Payment_controller/' . $row->link); ?>" class="w3-bar-item w3-button w3-padding "><i class="<?php echo $row->icon; ?>" style="color:#c10404;font-size: 1.3em;"></i>  <?php echo iconv('tis-620', 'utf-8', $row->Subject); ?></a>
        <?php //} ?>
            <?php //}  ?> 
                <div class="w3-dropdown-hover">
                    <button class="w3-button">Report
                        <i class="fa fa-caret-down"></i>
                    </button>
                    <div class="w3-dropdown-content w3-bar-block">
        <?php foreach ($username_menu as $row) { ?>
            <?php if ($row->group_num == '2') { ?>
                                        <a class="w3-bar-item w3-button" href="<?php //echo site_url('Payment_controller/' . $row->link); ?>" class="w3-bar-item w3-button w3-padding "><i class="<?php echo $row->icon; ?>" style="color:#c10404;font-size: 1.3em;"></i>  <?php echo iconv('tis-620', 'utf-8', $row->Subject); ?></a>
                    <?php } ?>
        <?php } ?> 
                        <br><br>
                    </div>
                </div>      
        
            </div>-->

        <div id="main">
            <div class="wrapper">
                <div class="content-wrapper">
                    <section class="content" style=" padding-top:2%;">
                        <div class="container-fluid">
                            <div class="card card-secondary">
                                <div class="card-header" style="background-color: #c3000d;">
                                    <h3 class="card-title"> <b>Summary Receive Report</b> </h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <!--            <div class="form-group">
                                                    <div style="background: linear-gradient(to left, #cc0000 50%, #ffffff 100%);">
                                                        <ul class="nav navbar-nav navbar-right">
                                                            <li style="margin-top: 15px;color: #ffffff;margin-right: 5px;">
                                                                <span class="glyphicon glyphicon-user"></span> 
                                    <?php
                                    foreach ($username as $row):
                                        echo $row->Subject_Right . "&nbsp;&nbsp;";
                                        echo iconv('TIS-620', 'UTF-8', $row->name);
                                    endforeach;
                                    ?>
                                                            </li>
                                    <?php foreach ($username as $row): ?>
                                        <?php if ($row->Subject_Right == 'SuperAdmin') { ?>
                                                                            <li style="color: #ffffff;">
                                                                                <a href="<?php echo site_url('/Payment_controller/Setting_index?id=') . $row->ID; ?>"><span class="glyphicon glyphicon-cog"></span> Setting</a>
                                                                            </li>
                                        <?php } ?>
                                    <?php endforeach; ?>                    
                                                            <li style="margin-right: 10px;color: #ffffff;">
                                                                <a href="<?php echo site_url(); ?>/Payment_controller/logout"><span class="glyphicon glyphicon-log-in"></span> Logout</a>
                                                            </li>
                                                        </ul>
                                                        <button id="openNav" class="w3-button w3-xlarge" onclick="w3_open()">&#9776;</button>
                                                        <label for="text">
                                                    <?php foreach ($company as $data) { ?>
                                                        <img style="width: 40px;" src="<?php echo base_url('/image/' . $data->pic); ?>"> 
                                                        <?php echo iconv('tis-620', 'utf-8', $data->name);
                                                    } ?>
                                                            </label>
                                                        </div>
                                                    </div>-->
                                    <!--                <p align="center" style="color: red;font-size: 1.3em;">
                                    <?php //echo '<br/><label>' . $this->session->flashdata("error") . '</label>'; ?>                    
                                                    </p>-->
                                    

                                    <div class="card card-primary card-outline">
                                        <div class="card-header">
                                            <h3 class="card-title">
                                                <i class="fas fa-edit"></i>
                                                Export Summary Receive Report
                                            </h3>
                                        </div>
                                        <div class="card-body">
                                            <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill" href="#custom-content-below-home" role="tab" aria-controls="custom-content-below-home" aria-selected="true" style=" font-size: 12px;"><b>Summary Receive Report By Operator Of Month</b></a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="custom-content-below-profile-tab" data-toggle="pill" href="#custom-content-below-profile" role="tab" aria-controls="custom-content-below-profile" aria-selected="false" style=" font-size: 12px;"><b>Summary Receive Report By Channel Of Daily</b></a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="custom-content-below-messages-tab" data-toggle="pill" href="#custom-content-below-messages" role="tab" aria-controls="custom-content-below-messages" aria-selected="false" style=" font-size: 12px;"><b>Summary Receive Report By Operator Of Daily</b></a>
                                                </li>
                                            </ul>
                                            
                                            <div class="tab-content" id="custom-content-below-tabContent">
                                                <div class="tab-pane fade show active" id="custom-content-below-home" role="tabpanel" aria-labelledby="custom-content-below-home-tab" style=" margin-top: 1%">
                                                  <form id="scan" method = "post"  action="<?php echo site_url('Payment_controller/daily_PDF') ?>" enctype = "multipart/form-data" target="_blank">
<!--                                                    <table style="width: 100%;text-align: center;">
                                                        <tr>
                                                            <td class="td" style="width: 35%;">
                                                                <select class="form-control" id="Operator1" name="Operator1">
                                                                    <option value="">All Operator</option>
                                                                    <?php foreach ($op as $row) { ?>
                                                                        <option value="<?php echo $row->operator_name; ?>"><?php echo $row->operator_name; ?></option>
                                                                    <?php } ?>                    
                                                                </select>
                                                            </td>

                                                            <td class="td" style="width: 15;">
                                                                <div class="input-group">
                                                                    <span class="input-group-addon">LOT</span>
                                                                    <input id="lot1" type="text" class="form-control" name="lot1">
                                                                </div>
                                                            </td>

                                                            <td class="td" style="width: 20%;">
                                                                <div class="input-group">
                                                                    <span class="input-group-addon">วันที่</span>
                                                                    <input id="datestart1" type="date" class="form-control" name="datestart1">
                                                                </div>
                                                            </td>

                                                            <td class="td" style="width: 20%;">
                                                                <div class="input-group">
                                                                    <span class="input-group-addon">ถึง</span>
                                                                    <input id="datestart2" type="date" class="form-control" name="datestart2">
                                                                </div>
                                                            </td>

                                                            <td class="td" style="width: 10%;">
                                                                <button onclick="scan1()" type="button" class="btn btn-info" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);padding: 5px;width: 100%;">ค้นหา</button>
                                                            </td>
                                                        </tr>
                                                    </table>-->
                                                      <div class="row" style=" margin-top: 2%;"> 
                                                          <div class="col-md-3">
                                                              <div class="input-group mb-3">
                                                                  <div class="input-group-prepend">
                                                                      <button type="button" class="btn btn-default "  style="background-color: #44CEF6;"><b>Operator</b></button>
                                                                  </div>
                                                                  <select class="form-control" id="OperatorMonth" name="OperatorMonth">
                                                                      <option value="">All Operator</option>
                                                                      <?php foreach ($op as $row) { ?>
                                                                          <option value="<?php echo $row->operator_name; ?>"><?php echo $row->operator_name; ?></option>
                                                                      <?php } ?>                    
                                                                  </select>
                                                              </div>
                                                          </div>
                                                          <div class="col-md-2">
                                                              <div class="input-group mb-4">
                                                                  <div class="input-group-prepend">
                                                                      <button type="button" class="btn btn-default "  style="background-color: #44CEF6;"><b>LOT</b></button>
                                                                  </div>
                                                                  <input  type="text" class="form-control" id="lotoperatorMonth" name="lotoperatorMonth">
                                                              </div>
                                                          </div>

                                                          <div class="col-md-3">
                                                              <div class="input-group mb-4">
                                                                  <div class="input-group-prepend">
                                                                      <button type="button" class="btn btn-default "  style="background-color: #44CEF6;"><b>LOT</b></button>
                                                                  </div>
                                                                  <input id="datestartoperatorMonth" type="date" class="form-control" name="datestartoperatorMonth">
                                                              </div>
                                                          </div>



                                                          <div class="col-md-3">
                                                              <div class="input-group mb-4">
                                                                  <div class="input-group-prepend">
                                                                      <button type="button" class="btn btn-default "  style="background-color: #44CEF6;"><b>วันที่</b></button>
                                                                  </div>
                                                                  <input  type="date" class="form-control" id="datestartoperatorMonth2" name="datestartoperatorMonth2">
                                                                  <div class="input-group-prepend" >
                                                                      <button type="button" class="btn btn-default " style="background-color: #16A951;" onclick="scanoperatormonth()"><i class="fa fa-search" aria-hidden="true"></i></button>
                                                                  </div>   
                                                              </div>
                                                          </div>

                                                      </div>
                                               
                                                      
                                                  </form>
                                                    
                                 
                                              
                                                </div>
                                                
                                                
                                                <div class="tab-pane fade" id="custom-content-below-profile" role="tabpanel" aria-labelledby="custom-content-below-profile-tab" style=" margin-top: 1%">
                                                    <form id="scan1" method = "post"  action="<?php echo site_url('Payment_controller/daily_PDF') ?>" enctype = "multipart/form-data" target="_blank">
<!--                                                        <table style="width: 100%;text-align: center;">
                                                            <tr>
                                                                <td class="td" style="width: 35%;">
                                                                    <select class="form-control" id="Operator" name="Operator">
                                                                        <option value="">All Operator</option>
                                                                        <?php foreach ($op as $row) { ?>
                                                                            <option value="<?php echo $row->operator_name; ?>"><?php echo $row->operator_name; ?></option>
                                                                        <?php } ?>                    
                                                                    </select>
                                                                </td>

                                                                <td class="td" style="width: 15;">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon">LOT</span>
                                                                        <input id="lot" type="text" class="form-control" name="lot">
                                                                    </div>
                                                                </td>

                                                                <td class="td" style="">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon">วันที่</span>
                                                                        <input id="datestart" type="date" class="form-control" name="datestart">
                                                                    </div>
                                                                </td>

                                                                <td class="td" style="width: 10%;">
                                                                    <button onclick="scan()" type="button" class="btn btn-info" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);padding: 5px;width: 100%;">ค้นหา</button>
                                                                </td>
                                                            </tr>
                                                        </table>-->
                                                        
                                                        <div class="row" style=" margin-top: 2%;"> 
                                                            <div class="col-md-5">
                                                                <div class="input-group mb-4">
                                                                    <div class="input-group-prepend">
                                                                        <button type="button" class="btn btn-default "  style="background-color: #44CEF6;"><b>Operator</b></button>
                                                                    </div>
                                                                    <select class="form-control" id="Operatorchannel" name="Operatorchannel">
                                                                        <option value="">All Operator</option>
                                                                        <?php foreach ($op as $row) { ?>
                                                                            <option value="<?php echo $row->operator_name; ?>"><?php echo $row->operator_name; ?></option>
                                                                        <?php } ?>                    
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">    
                                                                <div class="input-group mb-4">
                                                                    <div class="input-group-prepend">
                                                                        <button type="button" class="btn btn-default "  style="background-color: #44CEF6;"><b>LOT</b></button>
                                                                    </div>
                                                                    <input  type="text" class="form-control" id="lotchannel" name="lotchannel">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="input-group mb-4">
                                                                    <div class="input-group-prepend">
                                                                        <button type="button" class="btn btn-default "  style="background-color: #44CEF6;"><b>วันที่</b></button>
                                                                    </div>
                                                                    <input  type="date" class="form-control" id="datestartchannel" name="datestartchannel">
                                                                    <div class="input-group-prepend" >
                                                                        <button type="button" class="btn btn-default " style="background-color: #16A951;" onclick="scanchanneldaily()"><i class="fa fa-search" aria-hidden="true"></i></button>
                                                                    </div>   
                                                                </div>
                                                            </div>  
                                                        </div>
                                                        
                                                    </form>
                                                </div>
                                                
                                                
                                                <div class="tab-pane fade" id="custom-content-below-messages" role="tabpanel" aria-labelledby="custom-content-below-messages-tab" style=" margin-top: 1%">
                                                    <form id="scan2" method = "post"  action="<?php echo site_url('Payment_controller/daily_PDF') ?>" enctype = "multipart/form-data" target="_blank">
<!--                                                        <table style="width: 100%;text-align: center;">
                                                            <tr>
                                                                <td class="td" style="width: 35%;">
                                                                    <select class="form-control" id="OperatorOp" name="OperatorOp">
                                                                        <option value="">All Operator</option>
                                                                        <?php foreach ($op as $row) { ?>
                                                                            <option value="<?php echo $row->operator_name; ?>"><?php echo $row->operator_name; ?></option>
                                                                        <?php } ?>                    
                                                                    </select>
                                                                </td>

                                                                <td class="td" style="width: 15;">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon">LOT</span>
                                                                        <input id="lotOp" type="text" class="form-control" name="lotOp">
                                                                    </div>
                                                                </td>

                                                                <td class="td" style="width: 40%;">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon">วันที่</span>
                                                                        <input id="datestartOp" type="date" class="form-control" name="datestartOp">
                                                                    </div>
                                                                </td>

                                                                <td class="td" style="width: 10%;">
                                                                    <button onclick="scan2()" type="button" class="btn btn-info" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);padding: 5px;width: 100%;">ค้นหา</button>
                                                                </td>
                                                            </tr>
                                                        </table>-->
                                                        
                                                        <div class="row" style=" margin-top: 2%;"> 
                                                            <div class="col-md-5">
                                                                <div class="input-group mb-4">
                                                                    <div class="input-group-prepend">
                                                                        <button type="button" class="btn btn-default "  style="background-color: #44CEF6;"><b>Operator</b></button>
                                                                    </div>
                                                                    <select class="form-control" id="Operatordaily" name="Operatordaily">
                                                                        <option value="">All Operator</option>
                                                                        <?php foreach ($op as $row) { ?>
                                                                            <option value="<?php echo $row->operator_name; ?>"><?php echo $row->operator_name; ?></option>
                                                                        <?php } ?>                    
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">    
                                                                <div class="input-group mb-4">
                                                                    <div class="input-group-prepend">
                                                                        <button type="button" class="btn btn-default "  style="background-color: #44CEF6;"><b>LOT</b></button>
                                                                    </div>
                                                                    <input type="text" class="form-control" id="lotdaily"  name="lotdaily">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="input-group mb-4">
                                                                    <div class="input-group-prepend">
                                                                        <button type="button" class="btn btn-default "  style="background-color: #44CEF6;"><b>วันที่</b></button>
                                                                    </div>
                                                                    <input  type="date" class="form-control" id="datestartdaily" name="datestartdaily">
                                                                    <div class="input-group-prepend" >
                                                                        <button type="button" class="btn btn-default " style="background-color: #16A951;" onclick="scanoperatordaily()"><i class="fa fa-search" aria-hidden="true"></i></button>
                                                                    </div>   
                                                                </div>
                                                            </div>  
                                                        </div>
                                                        
                                                        
                                                    </form>
                                                    
                                                    
                                   
                                                    
                                                </div>

                                            </div>

                                        </div>
                                                <div align="center" id="Tableshowsummary" name="Tableshowsummary">
                                                    
                                                </div>  
                                         </div>
                                     </div>
                                </section>   
                            </div>
                        </div>
                </div>
              
    
<!--                                    <div class="divvv w3-animate-right" style="background-color:#FFFFFF;margin-top: 0px;">
                                        <div class="row" style="width: 100%;">
                                            <div class="col-sm-4" style="width: 100%;">
                                                <h3 align="center" style="color: #040404;margin-bottom: 0px;margin-top: 0px;">Summary Receive Report</h3>
                                            </div>
                                        </div>
                                        <hr style="margin-bottom: 10px;margin-top: 10px;">

                                        <ul class="nav nav-tabs">
                                            <li class="active"><a data-toggle="tab" href="#menu1">Summary Receive Report By Operator Of Month</a></li>
                                            <li><a data-toggle="tab" href="#menu2">Summary Receive Report By Channel Of Daily</a></li>
                                            <li><a data-toggle="tab" href="#menu3">Summary Receive Report By Operator Of Daily</a></li>
                                        </ul>
                                        
                                        
                                        
                                        <div class="tab-content">
                                            <div id="menu1" class="tab-pane fade in active">
                                                <form id="scan1" method = "post"  action="<?php echo site_url('Payment_controller/daily_PDF') ?>" enctype = "multipart/form-data" target="_blank">
                                                    <table style="width: 100%;text-align: center;">
                                                        <tr>
                                                            <td class="td" style="width: 35%;">
                                                                <select class="form-control" id="Operator1" name="Operator1">
                                                                    <option value="">All Operator</option>
                                                                    <?php foreach ($op as $row) { ?>
                                                                        <option value="<?php echo $row->operator_name; ?>"><?php echo $row->operator_name; ?></option>
                                                                    <?php } ?>                    
                                                                </select>
                                                            </td>

                                                            <td class="td" style="width: 15;">
                                                                <div class="input-group">
                                                                    <span class="input-group-addon">LOT</span>
                                                                    <input id="lot1" type="text" class="form-control" name="lot1">
                                                                </div>
                                                            </td>

                                                            <td class="td" style="width: 20%;">
                                                                <div class="input-group">
                                                                    <span class="input-group-addon">วันที่</span>
                                                                    <input id="datestart1" type="date" class="form-control" name="datestart1">
                                                                </div>
                                                            </td>

                                                            <td class="td" style="width: 20%;">
                                                                <div class="input-group">
                                                                    <span class="input-group-addon">ถึง</span>
                                                                    <input id="datestart2" type="date" class="form-control" name="datestart2">
                                                                </div>
                                                            </td>

                                                            <td class="td" style="width: 10%;">
                                                                <button onclick="scan1()" type="button" class="btn btn-info" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);padding: 5px;width: 100%;">ค้นหา</button>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </form>-->

<!--                                                <div align="center" id="show1" style="overflow: auto;">
                                                    <hr style="margin-top: 3px;">
                                                    <div style="width: 99%;">
                                                        <div style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);width: 99%;margin-bottom: 5px;border-radius: 5px;padding: 5px;">
                                                            <p style="width: 100%;background-color: red;border-radius: 5px;"><b>Grand Total</b></p>
                                                            <table style="width: 100%;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);border-radius: 5px;">
                                                                <tr style="">
                                                                    <td style="padding: 3px;">
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon">จำนวนรายการ</span>
                                                                            <input style="color: #F0FF03;background-color: black;text-align: right;" id="msg" type="text" class="form-control" name="msg" value="<?php echo number_format(0); ?>">
                                                                        </div>
                                                                    </td>
                                                                    <td style="padding: 3px;">
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon">Amount</span>
                                                                            <input style="color: #F0FF03;background-color: black;text-align: right;" id="msg" type="text" class="form-control" name="msg" value="<?php echo number_format(0, 2); ?>">
                                                                        </div>
                                                                    </td>
                                                                    <td style="padding: 3px;">
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon">Vatamount</span>
                                                                            <input style="color: #F0FF03;background-color: black;text-align: right;" id="msg" type="text" class="form-control" name="msg" value="<?php echo number_format(0, 2); ?>">
                                                                        </div>
                                                                    </td>
                                                                    <td style="padding: 3px;">
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon">Total</span>
                                                                            <input style="color: #F0FF03;background-color: black;text-align: right;" id="msg" type="text" class="form-control" name="msg" value="<?php echo number_format(0, 2); ?>">
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                        <table id="myTable1" class="table" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);overflow: auto;font-size: 0.9em;width: 99.9%;">
                                                            <thead>
                                                                <tr style="background-color:#040404;color: #FFFFFF;">
                                                                    <th style="text-align: center;">No</th>
                                                                    <th>Rec Date (ด/ว/ป)</th>
                                                                    <th>Contract No</th>
                                                                    <th>ID No</th>
                                                                    <th>Cus Name</th>
                                                                    <th>Amount</th>
                                                                    <th>Vatamount</th>
                                                                    <th>Total</th>                                    
                                                                    <th>E Balance</th>
                                                                    <th>Chennel</th>
                                                                    <th>Refno2</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <hr>
                                                </div>-->
<!--                                            </div>
                                            <div id="menu2" class="tab-pane fade">
                                                <form id="scan" method = "post"  action="<?php echo site_url('Payment_controller/daily_PDF') ?>" enctype = "multipart/form-data" target="_blank">
                                                    <table style="width: 100%;text-align: center;">
                                                        <tr>
                                                            <td class="td" style="width: 35%;">
                                                                <select class="form-control" id="Operator" name="Operator">
                                                                    <option value="">All Operator</option>
                                                                        <?php foreach ($op as $row) { ?>
                                                                        <option value="<?php echo $row->operator_name; ?>"><?php echo $row->operator_name; ?></option>
                                                                            <?php } ?>                    
                                                                </select>
                                                            </td>

                                                            <td class="td" style="width: 15;">
                                                                <div class="input-group">
                                                                    <span class="input-group-addon">LOT</span>
                                                                    <input id="lot" type="text" class="form-control" name="lot">
                                                                </div>
                                                            </td>

                                                            <td class="td" style="">
                                                                <div class="input-group">
                                                                    <span class="input-group-addon">วันที่</span>
                                                                    <input id="datestart" type="date" class="form-control" name="datestart">
                                                                </div>
                                                            </td>

                                                            <td class="td" style="width: 10%;">
                                                                <button onclick="scan()" type="button" class="btn btn-info" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);padding: 5px;width: 100%;">ค้นหา</button>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </form>-->

<!--                                                <div align="center" id="show" style="overflow: auto;">
                                                    <hr style="margin-top: 3px;">
                                                    <div style="width: 99%;">
                                                        <div style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);width: 99%;margin-bottom: 5px;border-radius: 5px;padding: 5px;">
                                                            <p style="width: 100%;background-color: red;border-radius: 5px;"><b>Grand Total</b></p>
                                                            <table style="width: 100%;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);border-radius: 5px;">
                                                                <tr style="">
                                                                    <td style="padding: 3px;">
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon">จำนวนรายการ</span>
                                                                            <input style="color: #F0FF03;background-color: black;text-align: right;" id="msg" type="text" class="form-control" name="msg" value="<?php echo number_format(0); ?>">
                                                                        </div>
                                                                    </td>
                                                                    <td style="padding: 3px;">
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon">มูลค่าบริการ</span>
                                                                            <input style="color: #F0FF03;background-color: black;text-align: right;" id="msg" type="text" class="form-control" name="msg" value="<?php echo number_format(0, 2); ?>">
                                                                        </div>
                                                                    </td>
                                                                    <td style="padding: 3px;">
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon">จำนวนภาษีมูลค่าเพิ่ม</span>
                                                                            <input style="color: #F0FF03;background-color: black;text-align: right;" id="msg" type="text" class="form-control" name="msg" value="<?php echo number_format(0, 2); ?>">
                                                                        </div>
                                                                    </td>
                                                                    <td style="padding: 3px;">
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon">จำนวนเงินรวม</span>
                                                                            <input style="color: #F0FF03;background-color: black;text-align: right;" id="msg" type="text" class="form-control" name="msg" value="<?php echo number_format(0, 2); ?>">
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                        <table id="myTable" class="table" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);overflow: auto;font-size: 0.9em;width: 99.9%;">
                                                            <thead>
                                                                <tr style="background-color:#040404;color: #FFFFFF;">
                                                                    <th style="text-align: center;">No</th>
                                                                    <th>รายการ</th>
                                                                    <th>มูลค่าบริการ</th>
                                                                    <th>จำนวนภาษีมูลค่าเพิ่ม</th>
                                                                    <th>จำนวนเงินรวม</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <hr>
                                                </div>-->
<!--                                            </div>
                                            <div id="menu3" class="tab-pane fade">
                                                <form id="scan2" method = "post"  action="<?php echo site_url('Payment_controller/daily_PDF') ?>" enctype = "multipart/form-data" target="_blank">
                                                    <table style="width: 100%;text-align: center;">
                                                        <tr>
                                                            <td class="td" style="width: 35%;">
                                                                <select class="form-control" id="OperatorOp" name="OperatorOp">
                                                                    <option value="">All Operator</option>
                                                                        <?php foreach ($op as $row) { ?>
                                                                        <option value="<?php echo $row->operator_name; ?>"><?php echo $row->operator_name; ?></option>
                                                                    <?php } ?>                    
                                                                </select>
                                                            </td>

                                                            <td class="td" style="width: 15;">
                                                                <div class="input-group">
                                                                    <span class="input-group-addon">LOT</span>
                                                                    <input id="lotOp" type="text" class="form-control" name="lotOp">
                                                                </div>
                                                            </td>

                                                            <td class="td" style="width: 40%;">
                                                                <div class="input-group">
                                                                    <span class="input-group-addon">วันที่</span>
                                                                    <input id="datestartOp" type="date" class="form-control" name="datestartOp">
                                                                </div>
                                                            </td>

                                                            <td class="td" style="width: 10%;">
                                                                <button onclick="scan2()" type="button" class="btn btn-info" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);padding: 5px;width: 100%;">ค้นหา</button>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </form>-->

<!--                                                <div align="center" id="show2" style="overflow: auto;">
                                                    <hr style="margin-top: 3px;">
                                                    <div style="width: 99%;">
                                                        <div style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);width: 99%;margin-bottom: 5px;border-radius: 5px;padding: 5px;">
                                                            <p style="width: 100%;background-color: red;border-radius: 5px;"><b>Grand Total</b></p>
                                                            <table style="width: 100%;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);border-radius: 5px;">
                                                                <tr style="">
                                                                    <td style="padding: 3px;">
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon">จำนวนรายการ</span>
                                                                            <input style="color: #F0FF03;background-color: black;text-align: right;" id="msg" type="text" class="form-control" name="msg" value="<?php echo number_format(0); ?>">
                                                                        </div>
                                                                    </td>
                                                                    <td style="padding: 3px;">
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon">มูลค่าบริการ</span>
                                                                            <input style="color: #F0FF03;background-color: black;text-align: right;" id="msg" type="text" class="form-control" name="msg" value="<?php echo number_format(0, 2); ?>">
                                                                        </div>
                                                                    </td>
                                                                    <td style="padding: 3px;">
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon">จำนวนภาษีมูลค่าเพิ่ม</span>
                                                                            <input style="color: #F0FF03;background-color: black;text-align: right;" id="msg" type="text" class="form-control" name="msg" value="<?php echo number_format(0, 2); ?>">
                                                                        </div>
                                                                    </td>
                                                                    <td style="padding: 3px;">
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon">จำนวนเงินรวม</span>
                                                                            <input style="color: #F0FF03;background-color: black;text-align: right;" id="msg" type="text" class="form-control" name="msg" value="<?php echo number_format(0, 2); ?>">
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                        <table id="myTable2" class="table" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);overflow: auto;font-size: 0.9em;width: 99.9%;">
                                                            <thead>
                                                                <tr style="background-color:#040404;color: #FFFFFF;">
                                                                    <th style="text-align: center;">รายการ</th>
                                                                    <th style="text-align: center;">มูลค่าบริการ</th>
                                                                    <th style="text-align: center;">จำนวนภาษีมูลค่าเพิ่ม</th>
                                                                    <th style="text-align: center;">จำนวนเงินรวม</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <hr>
                                                </div>-->
<!--                                            </div>
                                        </div>                -->

                                         
                                 
                                    <div align="center" id="overlay" onclick="off()">
                                        <img style="margin-top: 20%;width: 20%;" src="<?php echo base_url(); ?>assets/images/loader4.gif">
                                    </div>

                                </div>
                                </form>
                            </div>
                    </section> 
                </div>
            </div>
        </div>
    </body>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>


<!--    <script>
                                        $(document).ready(function () {
                                            $('#myTable').DataTable({
                                            });
                                        });
    </script>

    <script>
        $(document).ready(function () {
            $('#myTable1').DataTable({
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            $('#myTable2').DataTable({
            });
        });
    </script>-->
    
    <script>
    function pagedatapay(){	 //แนบตัวแปร page ไปด้วย
        
        var datestartoperatorMonth = document.getElementById('datestartoperatorMonth').value;
        var datestartoperatorMonth2 = document.getElementById('datestartoperatorMonth2').value;
        var lotoperatorMonth = document.getElementById('lotoperatorMonth').value;
        var OperatorMonth = document.getElementById('OperatorMonth').value;
        var page  = document.getElementById('page').value;
        

       var datas = "datestartoperatorMonth="+datestartoperatorMonth+"&datestartoperatorMonth2="+datestartoperatorMonth2+
       "&lotoperatorMonth="+lotoperatorMonth+"&OperatorMonth="+OperatorMonth+"&page="+page; 
            document.getElementById('overlay').style.display = "block";
             $.ajax({
                type:"POST",
                url:"<?php echo site_url('Payment_controller/receive_view1') ?>",
                data:datas,
              }).done(function(data){	
                 $('#Tableshowsummary').html(data);  //Div ที่กลับมาแสดง
                 document.getElementById('overlay').style.display = "none";
             }) 	
}
</script>


    <script type="text/javascript">
        function scanoperatormonth() {

            var datestart1 = document.getElementById('datestartoperatorMonth').value;
            var datestart2 = document.getElementById('datestartoperatorMonth2').value;
            
            if (datestart1 == '' | datestart2 == '') {
                alert("กรุณากรอกข้อมูล วันที่");
            } else {
                document.getElementById('overlay').style.display = "block";
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('Payment_controller/receive_view1') ?>",
                    data: $("#scan").serialize(),
                }).done(function (data) {
                    $('#Tableshowsummary').html(data);
                    document.getElementById('overlay').style.display = "none";
                })
            }
        }
    </script>



    <script type="text/javascript">
        function scanoperatordaily() {
            alert('000000');
            var datestart = document.getElementById('datestartoperatorMonth').value;
            var lot = document.getElementById('lotoperatorMonth').value;

            if (datestart == '' | lot == '') {
                alert("กรุณากรอกข้อมูล วันที่ Lot");
            } else {
                 alert('1');
                document.getElementById('overlay').style.display = "block";
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('Payment_controller/receive_view') ?>",
                    data: $("#scan").serialize(),
                }).done(function (data) {
                     alert('3');
                    $('#Tableshowsummary').html(data);
                    document.getElementById('overlay').style.display = "none";
                })
            }
        }
    </script>

    <script type="text/javascript">
        function scanchanneldaily() {
            
            alert('1111111');
            
            var datestart = document.getElementById('datestartchannel').value;
            var lot = document.getElementById('lotchannel').value;


            if (datestart == '' | lot == '') {
                alert("กรุณากรอกข้อมูล วันที่ Lot");
            } else {
                document.getElementById('overlay').style.display = "block";
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('Payment_controller/receive_view2') ?>",
                    data: $("#scan1").serialize(),
                }).done(function (data) {
                    $('#show2').html(data);
                    document.getElementById('overlay').style.display = "none";
                })
            }
        }
    </script>




</html>



