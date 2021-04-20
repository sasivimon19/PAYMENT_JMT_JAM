<!DOCTYPE html>
<html>
<title>Payment</title>
<head>
<!--	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>css/2.css">
	<script type = 'text/javascript' src = "<?php echo base_url(); ?>js/js.js"></script>
	<link href="<?php echo base_url(); ?>assets/DataTables/DataTables-1.10.18/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"> 
	<script src="<?php echo base_url(); ?>assets/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">-->
<!--	<script>
		function fncSubmit()
		{
			if(document.search.contract.value == "")
			{
				alert('กรุณากรอกข้อมูล Search');
				document.search.contract.focus();
				return false;
			}   

			document.search.submit();
		}
	</script>-->

</head>
<body>

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

    <div align="center" class="divvv w3-animate-right" style="background-color:#FFFFFF;">
      <p style="font-size: 1.3em;">ข้อมูลลูกค้า</p>
      <div style="width: 95%;">
       <form name="search" action="<?php echo site_url('Payment_controller/customer_index_from'); ?>" method="post" onSubmit="JavaScript:return fncSubmit();">
        <div class="input-group">
         <?php foreach ($username as $row):?>									
          <input style="display: none;"type="text" name="company" value="<?php echo iconv('TIS-620','UTF-8', $row->company); ?>">
        <?php endforeach;?>
        <input type="text" id="contract" name="contract" class="form-control" placeholder="Search">
        <div class="input-group-btn">
          <button class="btn btn-default" type="submit" id="search" name="search">
           <i class="glyphicon glyphicon-search"></i>
         </button>
       </div>
     </div>
   </form>
   <hr>
   <div style="width: 100%;">
    
    <table id="myTable" class="table" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);overflow: auto;font-size: 0.9em;width: 99.9%;">
           <thead>
               <tr style="background-color:#040404;color: #FFFFFF;">
                   <th>No</th>
                   <th>Contract No</th>
                   <th>IDCard</th>
                   <th>Name</th>
                   <th>Product</th>
                   <th>Operator</th>
                   <th>Lot</th>

                   <th style="text-align: center;">Option</th>
               </tr>
           </thead>
           <tbody>
               <?php $num = 1;
               foreach ($customerall as $row) { ?>								
                   <tr>
                       <td><?php echo $num; ?></td>
                       <td><?php echo iconv('tis-620', 'utf-8', $row->contract_no); ?></td>
                       <td><?php echo iconv('tis-620', 'utf-8', $row->id_no); ?></td>
                       <td><?php echo iconv('tis-620', 'utf-8', $row->cus_name); ?></td>
                       <td><?php echo iconv('tis-620', 'utf-8', $row->product); ?></td>
                       <td><?php echo iconv('tis-620', 'utf-8', $row->operator_name); ?></td>
                       <td><?php echo iconv('tis-620', 'utf-8', $row->lot_no); ?></td>
                       <td style="text-align: center;"><a href="<?php echo site_url('Payment_controller/customer?id=');
                   echo $row->contract_no; ?>"><button type="button" class="btn btn-info">Detail</button></a></td>
                   </tr>
                <?php $num++;} ?>
           </tbody>
       </table>

</div>
</div>


</div>
</div>
<!--</div>-->


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

</html>



