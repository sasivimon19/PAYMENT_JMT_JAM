<!DOCTYPE html>
<html>
<title>Payment</title>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>css/1.css">
    <script type = 'text/javascript' src = "<?php echo base_url(); ?>js/js.js"></script>

</head>
<body style="background-color:#a6a6a6;">

    <div class="w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:none" id="mySidebar">
        <button style="text-align: right;" class="w3-bar-item w3-button w3-large"
        onclick="w3_close()"> &times;</button>
        <h5 style="text-align: center;">Menu</h5>
        <?php foreach ($username_menu as $row){ ?>
            <?php if ($row->group_num == '1') { ?>
                <a href="<?php echo site_url('Payment_controller/' . $row->link); ?>" class="w3-bar-item w3-button w3-padding "><i class="<?php echo $row->icon; ?>" style="color:#c10404;font-size: 1.3em;"></i>  <?php echo iconv('tis-620', 'utf-8', $row->Subject); ?></a>
            <?php } ?>
        <?php } ?> 
        <div class="w3-dropdown-hover">
            <button class="w3-button">Report
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="w3-dropdown-content w3-bar-block">
                <?php foreach ($username_menu as $row){ ?>
                    <?php if ($row->group_num == '2') { ?>
                        <a class="w3-bar-item w3-button" href="<?php echo site_url('Payment_controller/' . $row->link); ?>" class="w3-bar-item w3-button w3-padding "><i class="<?php echo $row->icon; ?>" style="color:#c10404;font-size: 1.3em;"></i>  <?php echo iconv('tis-620', 'utf-8', $row->Subject); ?></a>
                    <?php } ?>
                <?php } ?> 
                <br><br>
            </div>
        </div>      

    </div>

    <div id="main">
        <div class="form-group">
            <div style="background: linear-gradient(to left, #cc0000 50%, #ffffff 100%);">
                <ul class="nav navbar-nav navbar-right">
                    <li style="margin-top: 15px;color: #ffffff;margin-right: 5px;">
                        <span class="glyphicon glyphicon-user"></span> 
                        <?php foreach ($username as $row):
                          echo  $row->Subject_Right."&nbsp;&nbsp;";
                          echo iconv('TIS-620','UTF-8', $row->name);
                      endforeach;?>
                  </li>
                  <?php foreach ($username as $row): ?>
                    <?php if ($row->Subject_Right == 'SuperAdmin') { ?>
                        <li style="color: #ffffff;">
                            <a href="<?php echo site_url('/Payment_controller/Setting_index?id=').$row->ID; ?>"><span class="glyphicon glyphicon-cog"></span> Setting</a>
                        </li>
                    <?php } ?>
                <?php endforeach;?>                    
                <li style="margin-right: 10px;color: #ffffff;">
                    <a href="<?php echo site_url(); ?>/Payment_controller/logout"><span class="glyphicon glyphicon-log-in"></span> Logout</a>
                </li>
            </ul>
            <button id="openNav" class="w3-button w3-xlarge" onclick="w3_open()">&#9776;</button>
            <label for="text">
                <?php foreach ($company as $data) { ?>
                    <img style="width: 40px;" src="<?php echo base_url('/image/' . $data->pic); ?>"> 
                    <?php echo iconv('tis-620', 'utf-8', $data->name); }?>
                </label>
            </div>
        </div>

        <div class="divvv w3-animate-right" style="background-color:#FFFFFF;"  >
            <div class="row" style="width: 100%;">
                <div class="col-sm-4" style="width: 100%;">
                    <h3 align="center" style="color: #040404;margin-bottom: 0px;margin-top: 0px;">Export ใบกำกับภาษี</h3>
                </div>
                <div class="col-sm-4">
                </div>
            </div>
            <hr>
            
            <hr>
        </div>

    </body>
    </html>

