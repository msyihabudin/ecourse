<link rel="stylesheet" type="text/css" href="<?= base_url("assets/frontend/styles/blog.css");?>">
<link rel="stylesheet" type="text/css" href="<?= base_url("assets/frontend/styles/blog_responsive.css");?>">

<!-- Home -->

<div class="home">
    <div class="breadcrumbs_container">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="breadcrumbs">
                        <ul>
                            <li><a href="<?= base_url();?>">Home</a></li>
                            <li>News</li>
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
            <div class="col">
                <div class="blog_post_container">
                    <?php if ($news): ?>
                    <?php foreach ($news as $blog): ?>
                    <!-- Blog Post -->
                    <div class="blog_post trans_200">
                        <div class="blog_post_image"><img src="<?= base_url('/assets/image/posts/' . $blog->feature_image); ?>" alt=""></div>
                        <div class="blog_post_body">
                            <div class="blog_post_title"><a href="<?= $blog->url; ?>"><?= $blog->title; ?></a></div>
                            <div class="blog_post_meta">
                                <ul>
                                    <li><a href="#"><?= $blog->display_name; ?></a></li>
                                    <li><a href="#"><?= $blog->date_posted; ?></a></li>
                                </ul>
                            </div>
                            <div class="blog_post_text">
                                <p><?= substr($blog->excerpt, 0, 90); ?>...</p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach ?>
                    <?php else: ?>
                    <div class="alert alert-info">      
                        No posts found
                    </div>
                    <?php endif ?>

                </div>
            </div>
        </div>
        <!--div class="row">
            <div class="col text-center">
                <div class="load_more trans_200"><a href="#">load more</a></div>
            </div>
        </div-->
    </div>
</div>