<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<html>

<?php
if (isset($this->session->userdata['user_signed_in'])) {
    $email = $this->session->userdata['user_signed_in']['email'];
    $photo_url = $this->session->userdata['user_signed_in']['photo_url'];
}
?>

<head>
    <!-- Standard Meta -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="theme-color" content="#3993bf">
    <title><?= $title ?> | ECourse</title>
    <link rel="stylesheet" type="text/css" href="<?= base_url("assets/css/semantic.min.css"); ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url("assets/css/app.css"); ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url("assets/css/anim.css"); ?>">
    <script src="<?= base_url("assets/js/jquery.min.js"); ?>"></script>
    <script src="<?= base_url("assets/js/semantic.min.js"); ?>"></script>
</head>

<body>
    <?php 
    include 'partials/sidebar.php';
    ?>
    <div class="pusher">
        <?php include 'partials/header.php'; ?>

        <?= $body; ?>

        <?php include 'partials/footer.php'; ?>
    </div>

    <script src="<?= base_url("assets/js/app.js"); ?>"></script>
    <script src="<?= base_url("assets/js/form-validation.js"); ?>"></script>
</body>

</html>