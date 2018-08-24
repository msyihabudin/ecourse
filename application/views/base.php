<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Course</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Course Project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="<?= base_url("assets/frontend/styles/bootstrap4/bootstrap.min.css"); ?>">
<link href="<?= base_url("assets/frontend/plugins/font-awesome-4.7.0/css/font-awesome.min.css"); ?>" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="<?= base_url("assets/frontend/plugins/OwlCarousel2-2.2.1/owl.carousel.css"); ?>">
<link rel="stylesheet" type="text/css" href="<?= base_url("assets/frontend/plugins/OwlCarousel2-2.2.1/owl.theme.default.css"); ?>">
<link rel="stylesheet" type="text/css" href="<?= base_url("assets/frontend/plugins/OwlCarousel2-2.2.1/animate.css"); ?>">
<link rel="stylesheet" type="text/css" href="<?= base_url("assets/frontend/styles/main_styles.css"); ?>">
<link rel="stylesheet" type="text/css" href="<?= base_url("assets/frontend/styles/responsive.css"); ?>">

</head>
<body>

<div class="super_container">

    <!-- Header -->

    <?php include 'partials/header.php'; ?>    
    
    <!-- Menu -->
    <div class="menu d-flex flex-column align-items-end justify-content-start text-right menu_mm trans_400">
        <div class="menu_close_container"><div class="menu_close"><div></div><div></div></div></div>
        <div class="search">
            <form action="#" class="header_search_form menu_mm">
                <input type="search" class="search_input menu_mm" placeholder="Search" required="required">
                <button class="header_search_button d-flex flex-column align-items-center justify-content-center menu_mm">
                    <i class="fa fa-search menu_mm" aria-hidden="true"></i>
                </button>
            </form>
        </div>
        <nav class="menu_nav">
            <ul class="menu_mm">
                <li class="menu_mm"><a href="<?= base_url(); ?>">Home</a></li>
                <li class="menu_mm"><a href="<?= base_url('about'); ?>">About</a></li>
                <li class="menu_mm"><a href="<?= base_url('courses'); ?>">Courses</a></li>
                <li class="menu_mm"><a href="<?= base_url('courses'); ?>">Blogs</a></li>
                <li class="menu_mm"><a href="<?= base_url('courses'); ?>">News</a></li>
                <li class="menu_mm"><a href="<?= base_url('contact'); ?>">Contact</a></li>
        </nav>
    </div>

    </div>
    
    <?= $body; ?>

    <!-- Footer -->

    <?php include 'partials/footer.php'; ?>

</div>

<script src="<?= base_url("assets/frontend/js/jquery-3.2.1.min.js"); ?>"></script>
<script src="<?= base_url("assets/frontend/styles/bootstrap4/popper.js"); ?>"></script>
<script src="<?= base_url("assets/frontend/styles/bootstrap4/bootstrap.min.js"); ?>"></script>
<script src="<?= base_url("assets/frontend/plugins/greensock/TweenMax.min.js"); ?>"></script>
<script src="<?= base_url("assets/frontend/plugins/greensock/TimelineMax.min.js"); ?>"></script>
<script src="<?= base_url("assets/frontend/plugins/scrollmagic/ScrollMagic.min.js"); ?>"></script>
<script src="<?= base_url("assets/frontend/plugins/greensock/animation.gsap.min.js"); ?>"></script>
<script src="<?= base_url("assets/frontend/plugins/greensock/ScrollToPlugin.min.js"); ?>"></script>
<script src="<?= base_url("assets/frontend/plugins/OwlCarousel2-2.2.1/owl.carousel.js"); ?>"></script>
<script src="<?= base_url("assets/frontend/plugins/easing/easing.js"); ?>"></script>
<script src="<?= base_url("assets/frontend/plugins/parallax-js-master/parallax.min.js");?>"></script>
<script src="<?= base_url("assets/frontend/js/custom.js"); ?>"></script>
<script src="<?= base_url("assets/frontend/plugins/colorbox/jquery.colorbox-min.js");?>"></script>
<script src="<?= base_url("assets/frontend/js/course.js"); ?>"></script>
<script src="<?= base_url('assets/js/jquery.form-validator.min.js');?>"></script>
<script src="<?= base_url('assets/js/custom.js');?>"></script>

</body>
</html>