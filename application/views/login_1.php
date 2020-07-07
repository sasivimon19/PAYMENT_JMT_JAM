<!DOCTYPE html>
<html>
<head>
	<title>Payment</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<style>
	body {
		font-family: Arial, Helvetica, sans-serif;
		background: url("<?php echo base_url('image/bg/sdfds.jpg'); ?>");
		background-size: 100%;
		/*background: #ffffff;*/
	}

	* {
		box-sizing: border-box;
	}

	.container {
		position: relative;
	} 


	input,
	.btn {
		width: 100%;
		padding: 12px;
		border: none;
		border-radius: 4px;
		margin: 5px 0;
		opacity: 0.85;
		display: inline-block;
		font-size: 17px;
		line-height: 20px;
		text-decoration: none; 
		box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
	}

	input:hover,
	.btn:hover {
		opacity: 1;
	}

	input[type=submit] {
		background-color: black;
		color: white;
		cursor: pointer;
		box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
	}

	input[type=submit]:hover {
		background-color: #333;
	}


	.col {
		/*background: #fff;*/
		padding: 10px;
		border: none;
		border-radius: 4px;
		width: 400px;
		margin: auto;
		padding-top: 20%;
		padding-bottom: 20%;
		box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
	}

</style>
</head>
<body>
	<div class="container" style="">
		<table class="table" style="width: 100%;margin-top: 7%;"> 
			<tr>
                        <a href="<?php echo site_url(); ?>/Payment_controller/model_loginTest">TEST</a>
				<td style="width: 30%;">
					<form method="post" action="<?php echo site_url(); ?>/Payment_controller/login_validation">
						<div class="col">
							<p style="text-align: center;font-size: 2em;"><b>ลงชื่อเข้าสู่ระบบ</b></p>
							<p style="text-align: center;font-size: 3em;"><b>Payment</b></p>
							<input type="text" name="username" placeholder="Username" required>
							<input type="password" name="password" placeholder="Password" required>
							<input type="submit" value="Login" name="insert">
							<?php 
							echo '<br/><b><center><label style="color:red;">'.$this->session->flashdata("error").'</center></label></b>';
							?>
						</div>				
					</form>
				</td>
				<td>
					<div align="center" style="">
						<img style="width: 70%;" src="<?php echo base_url(); ?>image/bg/logo4.png">
					</div>
				</td>
			</tr>
		</table>
		
	</div>
</body>
</html>