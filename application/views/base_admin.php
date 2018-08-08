<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*if (isset($this->session->userdata['admin_signed_in'])) {
    $email = $this->session->userdata['admin_signed_in']['email'];
} 
else {
    header("location: http://ecourse.work/admin/");
}*/
?>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title><?= $title ?> | Admin ECourse</title>
    <!-- Custom CSS -->
    <link href="<?= base_url("assets/backend/assets/libs/flot/css/float-chart.css"); ?>" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?= base_url("assets/backend/dist/css/style.min.css"); ?>" rel="stylesheet">
    <link href="<?= base_url("assets/css/admin.css"); ?>" rel="stylesheet">
    <link href="<?= base_url("assets/backend/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css"); ?>" rel="stylesheet">

</head>

<body>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <div id="main-wrapper">

        <?php include 'admin/partials/header.php'; ?>

        <?= $body; ?>

    </div>
    <script src="<?= base_url("assets/js/jquery.min.js"); ?>"></script>
    <script src="<?= base_url("assets/js/jquery-ui.min.js"); ?>"></script>
    <!--script src="<?= base_url('assets/js/jquery.validate.min.js');?>"></script-->
    <script src="<?= base_url("assets/backend/assets/libs/jquery/dist/jquery.min.js"); ?>"></script>
    <script src="<?= base_url('assets/js/jquery.form-validator.min.js');?>"></script>
    
    <script src="<?= base_url("assets/js/semantic.min.js"); ?>"></script>
    <script src="<?= base_url("assets/js/Chart.min.js"); ?>"></script>
    <script src="<?= base_url("assets/js/moment.js"); ?>"></script>
    <script src="<?= base_url("assets/js/admin.js"); ?>"></script>

    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?= base_url("assets/backend/assets/libs/popper.js/dist/umd/popper.min.js"); ?>"></script>
    <script src="<?= base_url("assets/backend/assets/libs/bootstrap/dist/js/bootstrap.min.js"); ?>"></script>
    <script src="<?= base_url("assets/backend/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"); ?>"></script>
    <script src="<?= base_url("assets/backend/assets/extra-libs/sparkline/sparkline.js"); ?>"></script>
    <!--Wave Effects -->
    <script src="<?= base_url("assets/backend/dist/js/waves.js"); ?>"></script>
    <!--Menu sidebar -->
    <script src="<?= base_url("assets/backend/dist/js/sidebarmenu.js"); ?>"></script>
    <!--Custom JavaScript -->
    <script src="<?= base_url("assets/backend/dist/js/custom.min.js"); ?>"></script>
    <script src="<?= base_url("assets/backend/assets/libs/flot/jquery.flot.js"); ?>"></script>
    <script src="<?= base_url("assets/backend/assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js"); ?>"></script>
    <script src="<?= base_url("assets/backend/dist/js/pages/chart/chart-page-init.js"); ?>"></script>
    <script src="<?= base_url("assets/backend/assets/extra-libs/DataTables/datatables.min.js"); ?>"></script>
    <script src="<?= base_url('assets/js/custom.js');?>"></script>
    <script>
        $('#zero_config').DataTable();

        function validate_fileType(fileName,Nameid,arrayValu)
        {
            var string = arrayValu;
            var tempArray = new Array();
            var tempArray = string.split(',');                  
            var allowed_extensions =tempArray;
            var file_extension = fileName.split(".").pop(); 
            for(var i = 0; i <= allowed_extensions.length; i++)
            {
                if(allowed_extensions[i]==file_extension)
                {   
                    $("#error_"+Nameid).html("");
                    return true; // valid file extension
                }
            }
            $("#"+Nameid).val("");
            $("#error_"+Nameid).css("color","red").html("File formate not suport To uploade");
            return false;
        }
    </script>

</body>

</html>