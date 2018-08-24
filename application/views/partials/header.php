<header class="header">
            
        <!-- Top Bar -->
        <div class="top_bar">
            <div class="top_bar_container">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="top_bar_content d-flex flex-row align-items-center justify-content-start">
                                <ul class="top_bar_contact_list">
                                    <li><div class="question">Have any questions?</div></li>
                                    <li>
                                        <i class="fa fa-phone" aria-hidden="true"></i>
                                        <div>021-12121212</div>
                                    </li>
                                    <li>
                                        <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                        <div>info@ecourse.com</div>
                                    </li>
                                </ul>
                                <div class="top_bar_login ml-auto">
                                    <div class="login_button">
                                <?php if ($this->session->userdata('user_details') && $this->session->userdata('user_details')[0]->user_type == "student"){ ?>
                                    <a href="<?= site_url('account'); ?>"><?= $this->session->userdata('user_details')[0]->fullname; ?>, </a>
                                    <a href="<?= site_url('Users/signout'); ?>">&nbsp;Logout</a>
                                <?php } else { ?>                                
                                    <a href="<?= base_url('signin');?>">Register or Login</a>
                                <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>              
        </div>

        <!-- Header Content -->
        <div class="header_container">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="header_content d-flex flex-row align-items-center justify-content-start">
                            <div class="logo_container">
                                <a href="<?= base_url(); ?>">
                                    <div class="logo_text">E<span>Course</span></div>
                                </a>
                            </div>
                            <nav class="main_nav_contaner ml-auto">
                                <ul class="main_nav">
                                    <li class=""><a href="<?= base_url(); ?>">Home</a></li>
                                    <li class=""><a href="<?= base_url('about'); ?>">About</a></li>
                                    <li class=""><a href="<?= base_url('courses'); ?>">Courses</a></li>
                                    <li class=""><a href="<?= base_url('blogs'); ?>">Blogs</a></li>
                                    <li class=""><a href="<?= base_url('news'); ?>">News</a></li>
                                    <li class=""><a href="<?= base_url('contact'); ?>">Contact</a></li>
                                </ul>

                                <?php
                                if ($this->session->userdata('user_details')) {
                                ?>
                                <!-- Hamburger -->                                
                                <div class="shopping_cart"><a href="<?= base_url('checkout/'.$this->session->userdata('user_details')[0]->users_id);?>"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></div>
                                <?php } ?>
                                <div class="hamburger menu_mm">
                                    <i class="fa fa-bars menu_mm" aria-hidden="true"></i>
                                </div>
                            </nav>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Header Search Panel -->
        <div class="header_search_container">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="header_search_content d-flex flex-row align-items-center justify-content-end">
                            <form action="#" class="header_search_form">
                                <input type="search" class="search_input" placeholder="Search" required="required">
                                <button class="header_search_button d-flex flex-column align-items-center justify-content-center">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>          
        </div>          
    </header>