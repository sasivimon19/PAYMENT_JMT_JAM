<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <title>Login</title>
</head>
<body>
    
<div class="container">
    <input type="text" name="id" id="id"><br>
    <input type="password" name="pass" id="pass"><br>
    <button type="button" onclick="login()">Login</button>

</div>
    
</body>
</html>

<script>
 function login() {
        var datas = "id="+document.getElementById('id').value+"&pass="+document.getElementById('pass').value;

        $.ajax({
            type: "POST",
            url: window.open("<?php echo site_url('Welcome/loginauth') ?>"),
            data: datas,
        }).done(function(data) {

        });
    }
</script>