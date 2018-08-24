<link rel="stylesheet" type="text/css" href="<?= base_url("assets/frontend/styles/courses.css"); ?>">
<link rel="stylesheet" type="text/css" href="<?= base_url("assets/frontend/styles/courses_responsive.css"); ?>">

<!-- Home -->

<div class="home">
    <div class="breadcrumbs_container">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="breadcrumbs">
                        <ul>
                            <li><a href="<?= base_url();?>">Home</a></li>
                            <li>Courses</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>          
</div>

<!-- Courses -->

<div class="courses">
    <div class="container">
        <div class="row">
            <!-- Courses Main Content -->
            <div class="col-lg-8">

                <?php if($this->session->flashdata("messagePr")){ ?>
                    <div class="alert alert-info">      
                      <?= $this->session->flashdata("messagePr"); ?>
                    </div><br>
                <?php } ?>

                <div class="courses_search_container">
                    <form action="<?= site_url('courses/search'); ?>" method="post" enctype="multipart/form-data" id="courses_search_form" class="courses_search_form d-flex flex-row align-items-center justify-content-start">
                        <input type="search" name="keyword" class="courses_search_input" placeholder="Search Courses">
                        <select name="id_quest" id="courses_search_select" class="courses_search_select courses_search_input">
                            <option value="All">All Categories</option>
                            <?php foreach($quest as $value){?>
                            <option value="<?= $value->id;?>"><?= $value->quest_name;?></option>
                            <?php } ?>
                        </select>
                        <?= form_submit('search', 'search now', 'class="courses_search_button ml-auto"'); ?>
                    </form>
                </div>
                <div class="courses_container">
                    <div class="row courses_row">
                        
                        <!-- Course -->
                        <?php foreach ($courses as $course){ ?>
                        <div class="col-lg-6 course_col">
                            <div class="course">
                                <div class="course_image"><img src="<?= $course->courseBadge; ?>" alt=""></div>
                                <div class="course_body">
                                    <h3 class="course_title"><a href="<?= $course->enrollUrl; ?>"><?= $course->name; ?></a></h3>
                                    <div class="course_teacher"><?= $course->NumOfLesson; ?> <span>Lessons</span></div>
                                    <div class="course_text">
                                        <p><?= $course->description; ?></p>
                                    </div>
                                </div>
                                <div class="course_footer">
                                    <div class="course_footer_content d-flex flex-row align-items-center justify-content-start">
                                        <div class="course_info">
                                            <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                                            <span><?= $course->student; ?> Student(s)</span>
                                        </div>
                                        <!--div class="course_info">
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <span>5 Ratings</span>
                                        </div-->
                                        <div class="course_price ml-auto"><?= $course->price; ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>

                    </div>
                    <!--div class="row pagination_row">
                        <div class="col">
                            <div class="pagination_container d-flex flex-row align-items-center justify-content-start">
                                <ul class="pagination_list">
                                    <li class="active"><a href="#">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
                                </ul>
                                <div class="courses_show_container ml-auto clearfix">
                                    <div class="courses_show_text">Showing <span class="courses_showing">1-6</span> of <span class="courses_total">26</span> results:</div>
                                    <div class="courses_show_content">
                                        <span>Show: </span>
                                        <select id="courses_show_select" class="courses_show_select">
                                            <option>06</option>
                                            <option>12</option>
                                            <option>24</option>
                                            <option>36</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div-->
                </div>
            </div>

            <!-- Courses Sidebar -->
            <div class="col-lg-4">
                <div class="sidebar">

                    <!-- Categories -->
                    <div class="sidebar_section">
                        <div class="sidebar_section_title">Categories</div>
                        <div class="sidebar_categories">
                            <ul>
                                <?php foreach($quest as $value){?>
                                <li><a href="#"><?= $value->quest_name;?></a></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>

                    <!-- Banner -->
                    <div class="sidebar_section">
                        <div class="sidebar_banner d-flex flex-column align-items-center justify-content-center text-center">
                            <div class="sidebar_banner_background" style="background-image:url(<?= base_url("assets/frontend/images/banner_1.jpg");?>)"></div>
                            <div class="sidebar_banner_overlay"></div>
                            <div class="sidebar_banner_content">
                                <div class="banner_title">Free Book</div>
                                <div class="banner_button"><a href="#">download now</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url("assets/frontend/js/courses.js");?>"></script>
