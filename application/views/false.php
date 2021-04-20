<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="tis-620">
    <title>LOGIN USERNAME</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="<?php echo base_url(); ?>assets/js/sweetalert.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>

</head>

<body class="align" onload="myFunction()">
    <script>
        swal({
            title: "ผู้ใช้งาน ไม่ถูกต้อง",
            icon: "error",
        }).then((willEdit) => {
            if (willEdit) {
                window.location = "<?php echo site_url('Payment_controller/index/') ?>";
            }
        });
    </script>
</body>

</html>