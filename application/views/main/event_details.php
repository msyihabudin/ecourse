<link rel="stylesheet" type="text/css" href="<?= base_url("assets/frontend/styles/blog_single.css");?>">
<link rel="stylesheet" type="text/css" href="<?= base_url("assets/frontend/styles/blog_single_responsive.css");?>">

<!-- Home -->

<div class="home">
    <div class="breadcrumbs_container">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="breadcrumbs">
                        <ul>
                            <li><a href="<?= base_url();?>">Home</a></li>
                            <li>Event Details</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>          
</div>

<!-- Blog -->

<div class="blog">
	<div class="container">
		<div class="row">
			<?php if ($event): ?>
			<!-- Blog Content -->
			<div class="col-lg-8">
				<div class="blog_content">
					<div class="blog_title"><?= $event['title'] ?></div>
					<div class="blog_meta">
						<ul>
							<li>Post on <a href="#"><?= $event['date_posted'] ?></a></li>
							<li>By <a href="#"><?= $event['display_name'] ?></a></li>
						</ul>
					</div>
					<div class="blog_image"><img src="<?= base_url('/assets/image/posts/' . $event['feature_image']); ?>" alt=""></div>
					<p><?= $event['content'] ?></p>
				</div>
				<div class="blog_extra d-flex flex-lg-row flex-column align-items-lg-center align-items-start justify-content-start">
					<div class="blog_tags">
						<span>Tags: </span>
						<ul>
							<?php foreach ($event['categories'] as $cat): ?>
							<li><?php echo $cat->name ?>, </li>
							<?php endforeach ?>
						</ul>
					</div>
					<div class="blog_social ml-lg-auto">
						<span>Share: </span>
						<ul>
							<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
							<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
							<li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
							<li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
							<li><a href="#"><i class="fa fa-envelope" aria-hidden="true"></i></a></li>
						</ul>
					</div>
				</div>
			</div>

			<!-- Blog Sidebar -->
			<div class="col-lg-4">
				<div class="sidebar">

					<!-- Latest event -->
					<div class="sidebar_section">
						<div class="sidebar_section_title">Latest Courses</div>
						<div class="sidebar_latest">
							<?php foreach ($courses as $course){ ?>
							<!-- Latest Course -->
							<div class="latest d-flex flex-row align-items-start justify-content-start">
								<div class="latest_image"><div><img src="<?= $course->courseBadge; ?>" alt=""></div></div>
								<div class="latest_content">
									<div class="latest_title"><a href="<?= $course->enrollUrl; ?>"><?= $course->name; ?></a></div>
									<div class="latest_date"><?= $course->NumOfLesson; ?> <span>Lessons</span></div>
								</div>
							</div>
							<?php } ?>

						</div>
					</div>

					<!-- Banner -->
					<div class="sidebar_section">
						<div class="sidebar_banner d-flex flex-column align-items-center justify-content-center text-center">
							<div class="sidebar_banner_background" style="background-image:url(images/banner_1.jpg)"></div>
							<div class="sidebar_banner_overlay"></div>
							<div class="sidebar_banner_content">
								<div class="banner_title">Free Book</div>
								<div class="banner_button"><a href="#">download now</a></div>
							</div>
						</div>
					</div>

				</div>
			</div>
			<?php else: ?>
				<h2>Ooops!</h2>
				<p>There was an error. Please check the URL and try again.</p>
			<?php endif ?>
		</div>
	</div>
</div>