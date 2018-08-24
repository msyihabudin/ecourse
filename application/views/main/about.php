<link rel="stylesheet" type="text/css" href="<?= base_url("assets/frontend/styles/about.css");?>">
<link rel="stylesheet" type="text/css" href="<?= base_url("assets/frontend/styles/about_responsive.css");?>">

<!-- Home -->

<div class="home">
    <div class="breadcrumbs_container">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="breadcrumbs">
                        <ul>
                            <li><a href="<?= base_url();?>">Home</a></li>
                            <li>About</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>          
</div>

<!-- About -->

<div class="about">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="section_title_container text-center">
                    <h2 class="section_title">Welcome To <?= $site_name['value']; ?></h2>
                    <div class="section_subtitle"><p><?= $site_description['value']; ?></p></div>
                </div>
            </div>
        </div>
        <div class="row about_row">
            
            <!-- About Item -->
            <div class="col-lg-4 about_col about_col_left">
                <div class="about_item">
                    <div class="about_item_image"><img src="<?= base_url("assets/frontend/images/about_1.jpg");?>" alt=""></div>
                    <div class="about_item_title"><a href="#">Our Stories</a></div>
                    <div class="about_item_text">
                        <p><?= $our_stories['value']; ?></p>
                    </div>
                </div>
            </div>

            <!-- About Item -->
            <div class="col-lg-4 about_col about_col_middle">
                <div class="about_item">
                    <div class="about_item_image"><img src="<?= base_url("assets/frontend/images/about_2.jpg");?>" alt=""></div>
                    <div class="about_item_title"><a href="#">Our Mission</a></div>
                    <div class="about_item_text">
                        <p><?= $our_mision['value']; ?></p>
                    </div>
                </div>
            </div>

            <!-- About Item -->
            <div class="col-lg-4 about_col about_col_right">
                <div class="about_item">
                    <div class="about_item_image"><img src="<?= base_url("assets/frontend/images/about_3.jpg");?>" alt=""></div>
                    <div class="about_item_title"><a href="#">Our Vision</a></div>
                    <div class="about_item_text">
                        <p><?= $our_vision['value']; ?></p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>