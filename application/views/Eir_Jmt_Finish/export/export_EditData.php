<html>
	<head>
		<meta http-equiv="content-type"  charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>ImportData</title>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script
                src="https://code.jquery.com/ui/1.9.2/jquery-ui.js"
                integrity="sha256-PsB+5ZEsBlDx9Fi/GXc1bZmC7wEQzZK4bM/VwNm1L6c="
                crossorigin="anonymous">
        </script>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.9.1/themes/smoothness/jquery-ui.css">
        <!--<link rel="stylesheet" href="<?echo base_url()?>/css/styles.css">-->
        <style>
        </style>
        
	</head>
    <body>
            <div class="container text-center">
                <div class="table-space tableFixHead">
                    <table class="table table-striped table-bordered " id="table-data">
                        <thead>
                            <tr>
                            <th class="text-center" width="5%">Port</th>
                            <th class="text-center" width="5%">Cash</th>
                            <th class="text-center" width="5%">Date</th>        
                            <th class="text-center" width="1%">Revoke</th>
                            <th class="text-center" width="1%">CourtFee</th>
                            <th class="text-center" width="1%">TransferFee</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?foreach ($result as $r){?>
                                <tr>
                                    <td style="border: 1px solid black;">
                                        <?  echo iconv('tis-620//ignore','utf-8//ignore',$r->Port);?> 
                                    </td>
                                    <td style="border: 1px solid black">
                                        <?  echo iconv('tis-620//ignore','utf-8//ignore',$r->CashFlow);?> 
                                    </td>
                                    <td style="border: 1px solid black;">
                                        <?  echo iconv("tis-620//ignore","utf-8//ignore",$r->MONTH_YEAR);?> 
                                    </td> 
                                    <td style="border: 1px solid black;">
                                        <?  echo iconv("tis-620//ignore","utf-8//ignore",$r->RevokeCustomer);?> 
                                    </td> 
                                    <td style="border: 1px solid black;">
                                        <?  echo iconv("tis-620//ignore","utf-8//ignore",$r->CourtFee);?> 
                                    </td> 
                                    <td style="border: 1px solid black;">
                                        <?  echo iconv("tis-620//ignore","utf-8//ignore",$r->TransferFee);?> 
                                    </td> 
                                </tr>
        
                            <?}?>
                        </tbody>
                    </table>
                </div>
        </div>          
	</body>
</html>

<?
 header("Content-Type: application/xls");
 header("Content-Disposition: attachment; filename=editdata.xls");
 header("Pragma: no-cache");
 header("Expires: 0");    
?>
