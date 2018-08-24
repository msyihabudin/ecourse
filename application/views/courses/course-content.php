<link rel="stylesheet" type="text/css" href="<?= base_url("assets/frontend/styles/course.css");?>">
<link rel="stylesheet" type="text/css" href="<?= base_url("assets/frontend/styles/course_responsive.css");?>">

<!-- Home -->

<div class="home">
    <div class="breadcrumbs_container">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="breadcrumbs">
                        <ul>
                            <li><a href="<?= base_url();?>">Home</a></li>
                            <li><a href="<?= base_url('courses');?>">Courses</a></li>
                            <li>Course Details</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>          
</div>

<!-- Course -->

<div class="course">
    <div class="container">
        <div class="row">

            <!-- Course -->
            <div class="col-lg-8">
                
                <div class="course_container">
                    <div class="course_title"><?= $content[0]->name; ?></div>
                    <div class="course_info d-flex flex-lg-row flex-column align-items-lg-center align-items-start justify-content-start">

                        <!-- Course Info Item -->
                        <div class="course_info_item">
                            <div class="course_info_title">Teacher:</div>
                            <div class="course_info_text"><a href="#">Jacke Masito</a></div>
                        </div>

                        <!-- Course Info Item -->
                        <!--div class="course_info_item">
                            <div class="course_info_title">Reviews:</div>
                            <div class="rating_r rating_r_4"><i></i><i></i><i></i><i></i><i></i></div>
                        </div-->

                        <!-- Course Info Item -->
                        <div class="course_info_item">
                            <div class="course_info_title">Categories:</div>
                            <div class="course_info_text"><a href="#"><?= $content[0]->category;?></a></div>
                        </div>

                    </div>

                    <!-- Course Image -->
                    <div class="course_image"><img src="<?= $content[0]->courseBadge; ?>" alt=""></div>

                    <!-- Course Tabs -->
                    <div class="course_tabs_container">
                        <div class="tabs d-flex flex-row align-items-center justify-content-start">
                            <div class="tab active">description</div>
                            <div class="tab">curriculum</div>
                        </div>
                        <div class="tab_panels">

                            <!-- Description -->
                            <div class="tab_panel active">
                                <div class="tab_panel_title"><?= $content[0]->name; ?></div>
                                <div class="tab_panel_content">
                                    <div class="tab_panel_text">
                                        <p><?= $content[0]->description; ?></p>
                                    </div>
                                </div>
                            </div>

                            <!-- Curriculum -->
                            <div class="tab_panel tab_panel_2">
                                <div class="tab_panel_content">
                                    <div class="tab_panel_content">
                                        <!-- Dropdowns -->
                                        <ul class="dropdowns">
                                            <?php
                                            //if (!empty($content[0]->path)) {
                                            
                                            foreach ($content[0]->path as $path) { ?>
                                            
                                            <li class="has_children">
                                                <div class="dropdown_item">
                                                    <div class="dropdown_item_title"><span><?= $path->titlePath; ?></span></div>
                                                    <div class="dropdown_item_text">
                                                        <p><?= $path->description; ?></p>
                                                    </div>
                                                </div>
                                                <ul>
                                                <?php 
                                                if ($this->session->userdata('user_details') && $this->session->userdata('user_details')[0]->user_type == "student") {
                                                    if ($this->session->userdata('user_details')[0]->users_id == $enroll['id_user']) {

                                                    foreach ($path->courses as $course) { ?>
                                                    <li>
                                                        <div class="dropdown_item">
                                                            <div class="dropdown_item_title"><span><?= $course->courseName; ?></span> <a href="<?= site_url('courses/download/'.$content[0]->courseFile); ?>"> Download</a></div>
                                                            <div class="dropdown_item_text">
                                                                <p><?= $course->description; ?></p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                <?php 
                                                    } 
                                                    } else {
                                                ?>
                                                    <div class="alert alert-info">      
                                                        Enroll course to view this content!
                                                    </div>
                                                <?php
                                                    }
                                                } else {

                                                ?>
                                                    <div class="alert alert-info">      
                                                        This content is protected, please <a href="<?= base_url('signin');?>">login</a> and enroll course to view this content!
                                                    </div>
                                                <?php } ?>
                                                </ul>
                                            </li>
                                            <?php } //} ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Course Sidebar -->
            <div class="col-lg-4">
                <div class="sidebar">

                    <!-- Feature -->
                    <div class="sidebar_section">
                        <div class="sidebar_section_title">Course Feature</div>
                        <div class="sidebar_feature">
                            <div class="course_price"><?= $content[0]->price;?> | 
                            <?php if ($this->session->userdata('user_details') && $this->session->userdata('user_details')[0]->user_type == "student") { ?>            
                                <?php if ($enroll['enroll_status']) { ?>
                                    <a href="<?= site_url('courses/unenroll/'.$enroll['id_enroll_course'].'/'.$user['id_course'].'/'.$enroll['enroll_status']); ?>" class="btn btn-sm btn-primary">Enrolled</a>
                                <?php } else { ?>
                                    <a href="<?= site_url('courses/enroll/'.$user['users_id'].'/'.$user['id_course']); ?>" class="btn btn-sm btn-primary">Enroll Now</a>   
                                <?php } ?>
                            <?php } else { ?>
                                <a href="<?= site_url('signin'); ?>" class="btn btn-sm btn-primary">Enroll Now</a> 
                            <?php } ?>
                            </div>

                            <!-- Features -->
                            <div class="feature_list">

                                <!-- Feature -->
                                <div class="feature d-flex flex-row align-items-center justify-content-start">
                                    <div class="feature_title"><i class="fa fa-file-text-o" aria-hidden="true"></i><span>Lessons:</span></div>
                                    <div class="feature_text ml-auto"><?= $content[0]->NumOfLesson;?></div>
                                </div>

                                <!-- Feature -->
                                <div class="feature d-flex flex-row align-items-center justify-content-start">
                                    <div class="feature_title"><i class="fa fa-users" aria-hidden="true"></i><span>Students:</span></div>
                                    <div class="feature_text ml-auto"><?= $content[0]->student;?></div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Newsletter -->

<div class="newsletter">
    <div class="newsletter_background" style="background-image:url(<?= base_url("assets/frontend/images/newsletter_background.jpg");?>)"></div>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="newsletter_container d-flex flex-lg-row flex-column align-items-center justify-content-start">

                    <!-- Newsletter Content -->
                    <div class="newsletter_content text-lg-left text-center">
                        <div class="newsletter_title">sign up for news and offers</div>
                        <div class="newsletter_subtitle">Subcribe to lastest smartphones news & great deals we offer</div>
                    </div>

                    <!-- Newsletter Form -->
                    <div class="newsletter_form_container ml-lg-auto">
                        <form action="#" id="newsletter_form" class="newsletter_form d-flex flex-row align-items-center justify-content-center">
                            <input type="email" class="newsletter_input" placeholder="Your Email" required="required">
                            <button type="submit" class="newsletter_button">subscribe</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

