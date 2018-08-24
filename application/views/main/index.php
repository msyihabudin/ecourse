<!-- Home -->

<div class="home">
    <div class="home_slider_container">
        
        <!-- Home Slider -->
        <div class="owl-carousel owl-theme home_slider">
            
            <!-- Home Slider Item -->
            <div class="owl-item">
                <div class="home_slider_background" style="background-image:url(<?= base_url("assets/frontend/images/home_slider_1.jpg");?>"></div>
                <div class="home_slider_content">
                    <div class="container">
                        <div class="row">
                            <div class="col text-center">
                                <div class="home_slider_title">The Premium System Education</div>
                                <div class="home_slider_subtitle">Future Of Education Technology</div>
                                <div class="home_slider_form_container">
                                    <form action="<?= site_url('courses/search'); ?>" method="post" enctype="multipart/form-data" id="home_search_form_1" class="home_search_form d-flex flex-lg-row flex-column align-items-center justify-content-between">
                                        <div class="d-flex flex-row align-items-center justify-content-start">
                                            <input type="search" name="keyword" class="home_search_input" placeholder="Keyword Search">
                                            <select name="id_quest" class="dropdown_item_select home_search_input">
                                                <option value="All">All Categories</option>
                                                <?php foreach($quest as $value){?>
                                                <option value="<?= $value->id;?>"><?= $value->quest_name;?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <?= form_submit('search', 'search', 'class="home_search_button"'); ?>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Home Slider Nav -->

    <!--div class="home_slider_nav home_slider_prev"><i class="fa fa-angle-left" aria-hidden="true"></i></div>
    <div class="home_slider_nav home_slider_next"><i class="fa fa-angle-right" aria-hidden="true"></i></div-->
</div>

<!-- Features -->

<div class="features">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="section_title_container text-center">
                    <h2 class="section_title">Welcome To <?= $site_name['value']; ?></h2>
                    <div class="section_subtitle"><p><?= $site_description['value']; ?></p></div>
                </div>
            </div>
        </div>
        <div class="row features_row">
            
            <!-- Features Item -->
            <div class="col-lg-3 feature_col">
                <div class="feature text-center trans_400">
                    <div class="feature_icon"><img src="<?= base_url("assets/frontend/images/icon_1.png");?>" alt=""></div>
                    <h3 class="feature_title">The Experts</h3>
                    <div class="feature_text"><p><?= $site_info1['value']; ?></p></div>
                </div>
            </div>

            <!-- Features Item -->
            <div class="col-lg-3 feature_col">
                <div class="feature text-center trans_400">
                    <div class="feature_icon"><img src="<?= base_url("assets/frontend/images/icon_2.png");?>" alt=""></div>
                    <h3 class="feature_title">Book & Library</h3>
                    <div class="feature_text"><p><?= $site_info2['value']; ?></p></div>
                </div>
            </div>

            <!-- Features Item -->
            <div class="col-lg-3 feature_col">
                <div class="feature text-center trans_400">
                    <div class="feature_icon"><img src="<?= base_url("assets/frontend/images/icon_3.png");?>" alt=""></div>
                    <h3 class="feature_title">Best Courses</h3>
                    <div class="feature_text"><p><?= $site_info3['value']; ?></p></div>
                </div>
            </div>

            <!-- Features Item -->
            <div class="col-lg-3 feature_col">
                <div class="feature text-center trans_400">
                    <div class="feature_icon"><img src="<?= base_url("assets/frontend/images/icon_4.png");?>" alt=""></div>
                    <h3 class="feature_title">Award & Reward</h3>
                    <div class="feature_text"><p><?= $site_info4['value']; ?></p></div>
                </div>
            </div>

        </div>
    </div>
</div>

<div style="margin-top: -100px;"></div>
<!-- Popular Courses -->

<div class="courses">
    <div class="section_background parallax-window" data-parallax="scroll" data-image-src="<?= base_url("assets/frontend/images/courses_background.jpg");?>" data-speed="0.8"></div>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="section_title_container text-center">
                    <h2 class="section_title">Popular Online Courses</h2>
                    <div class="section_subtitle"><p><?= $popular_course['value']; ?></p></div>
                </div>
            </div>
        </div>
        <div class="row courses_row">
            
            <!-- Course -->
            <?php foreach ($courses as $course){ ?>
            <div class="col-lg-4 course_col">
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
        <div class="row">
            <div class="col">
                <div class="courses_button trans_200"><a href="<?= base_url('courses');?>">view all courses</a></div>
            </div>
        </div>
    </div>
</div>

<!-- Counter -->

<div class="counter">
    <div class="counter_background" style="background-image:url(<?= base_url("assets/frontend/images/counter_background.jpg");?>"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="counter_content">
                    <h2 class="counter_title">Register Now</h2>
                    <div class="counter_text"><p><?= $register_now['value']; ?></p></div>

                    <!-- Milestones -->

                    <div class="milestones d-flex flex-md-row flex-column align-items-center justify-content-between">
                        
                        <!-- Milestone -->
                        <div class="milestone">
                            <div class="milestone_counter" data-end-value="<?= count($courses);?>">0</div>
                            <div class="milestone_text">courses</div>
                        </div>

                        <!-- Milestone -->
                        <div class="milestone">
                            <div class="milestone_counter" data-end-value="<?= count($lessons);?>">0</div>
                            <div class="milestone_text">lessons</div>
                        </div>

                        <!-- Milestone -->
                        <div class="milestone">
                            <div class="milestone_counter" data-end-value="<?= count($students);?>">0</div>
                            <div class="milestone_text">students</div>
                        </div>

                        <!-- Milestone -->
                        <div class="milestone">
                            <div class="milestone_counter" data-end-value="<?= count($curr);?>">0</div>
                            <div class="milestone_text">curriculum</div>
                        </div>

                    </div>
                </div>

            </div>
        </div>

        <div class="counter_form">
            <div class="row fill_height">
                <div class="col fill_height">
                    
                    <?= form_open('users/auth_signup', 'class="counter_form_content d-flex flex-column align-items-center justify-content-center"'); ?>
                        <div class="counter_form_title">courses now</div>
                        <?= form_input('name', '', 'placeholder="Full Name", class="counter_input"'); ?>
                        <?= form_input(array('type'=> 'email', 'name'=>'email'), '', 'placeholder="Email Address", class="counter_input"'); ?>
                        <?= form_input('username', '', 'placeholder="Username", class="counter_input"'); ?>
                        <?= form_password('password', '', 'placeholder="Password", class="counter_input"'); ?>
                        
                        <!--input type="text" class="counter_input" placeholder="Your Name:" required="required">
                        <input type="tel" class="counter_input" placeholder="Phone:" required="required">
                        <select name="counter_select" id="counter_select" class="counter_input counter_options">
                            <option>Choose Subject</option>
                            <option>Subject</option>
                            <option>Subject</option>
                            <option>Subject</option>
                        </select>
                        <textarea class="counter_input counter_text_input" placeholder="Message:" required="required"></textarea-->

                        <?= form_submit('auth_signup', 'register now', 'class="counter_form_button"'); ?>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Events -->

<div class="events">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="section_title_container text-center">
                    <h2 class="section_title">Upcoming events</h2>
                    <div class="section_subtitle"><p><?= $upcoming_events['value']; ?></p></div>
                </div>
            </div>
        </div>
        <div class="row events_row">
            <?php if ($events): ?>
            <?php foreach ($events as $event): ?>

            <!-- Event -->
            <div class="col-lg-4 event_col">
                <div class="event event_left">
                    <div class="event_image"><img src="<?= base_url('/assets/image/posts/' . $event->feature_image); ?>" alt=""></div>
                    <div class="event_body d-flex flex-row align-items-start justify-content-start">
                        <div class="event_date">
                            <div class="d-flex flex-column align-items-center justify-content-center trans_200">
                                <div class="event_day trans_200"><?= $event->date_posted; ?></div>
                                <div class="event_month trans_200"></div>
                            </div>
                        </div>
                        <div class="event_content">
                            <div class="event_title"><a href="<?= $event->url; ?>"><?= $event->title; ?></a></div>
                            <div class="event_info_container">
                                <div class="event_info"><i class="fa fa-user-circle-o" aria-hidden="true"></i><span>Posted by <?= $event->display_name; ?></span></div>
                                <div class="event_text">
                                    <p><?= substr($event->excerpt, 0, 90); ?>...</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php endforeach ?>
            <?php endif ?>

        </div>
    </div>
</div>

<div style="margin-top: -100px;"></div>

<!-- Latest News -->

<div class="news">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="section_title_container text-center">
                    <h2 class="section_title">Latest News</h2>
                    <div class="section_subtitle"><p><?= $latest_news['value']; ?></p></div>
                </div>
            </div>
        </div>
        <div class="row news_row">
            <div class="col-lg-7 news_col">
                <?php if ($bignews): ?>
                <?php foreach ($bignews as $post): ?>
                <!-- News Post Large -->
                <div class="news_post_large_container">
                    <div class="news_post_large">
                        <div class="news_post_image"><img src="<?= base_url('/assets/image/posts/' . $post->feature_image); ?>" alt=""></div>
                        <div class="news_post_large_title"><a href="<?= $post->url; ?>"><?= $post->title; ?></a></div>
                        <div class="news_post_meta">
                            <ul>
                                <li><a href="#">Posted by <?= $post->display_name; ?></a></li>
                                <li><a href="#"><?= $post->date_posted; ?></a></li>
                            </ul>
                        </div>
                        <div class="news_post_text">
                            <p><?= substr($post->excerpt, 0, 250); ?>...</p>
                        </div>
                        <div class="news_post_link"><a href="<?= $post->url; ?>">read more</a></div>
                    </div>
                </div>
                <?php endforeach ?>
                <?php endif ?>
            </div>

            <div class="col-lg-5 news_col">
                <div class="news_posts_small">

                    <?php if ($news): ?>
                    <?php foreach ($news as $post): ?>

                    <!-- News Posts Small -->
                    <div class="news_post_small">
                        <div class="news_post_small_title"><a href="<?= $post->url; ?>"><?= $post->title; ?></a></div>
                        <div class="news_post_meta">
                            <ul>
                                <li><a href="#">Posted by <?= $post->display_name; ?></a></li>
                                <li><a href="#"><?= $post->date_posted; ?></a></li>
                            </ul>
                        </div>
                    </div>

                    <?php endforeach ?>
                    <?php endif ?>

                </div>
            </div>
        </div>
    </div>
</div>
