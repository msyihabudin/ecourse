<section class="hero-skills">
    <div class="ui center aligned container" id="hero-content">
        <div class="ui container">
            <h1 class="ui inverted header">Courses Path</h1>
            <p class="ui inverted header">Curated skill paths to help you develop the right skills in the right order</p>
            <a class="ui large black button" href="<?= site_url('users/signup'); ?>">Enroll Now</a>
        </div>
    </div>
</section>

<main class="learn-realm">
    <div class="ui container">
        <div class="ui secondary blue pointing menu">
            <a class="active item" href="<?= site_url('courses'); ?>"><i class="block layout icon"></i>Courses Path</a>
            <a class="item" href="<?= site_url('quest'); ?>"><i class="list layout icon"></i>Quest Courses</a>
        </div>
        <br>
        <div class="ui three stackable link centered cards">

            <?php foreach ($courses as $course) { ?>
                <div class="raised card">
                    <a class="image" href="<?= $course->enrollUrl; ?>">
                        <img src="<?= $course->courseBadge; ?>">
                    </a>
                    <div class="content">
                        <a class="header" href="<?= $course->enrollUrl; ?>"><?= $course->name; ?></a>
                        <div class="meta">
                            <a><?= $course->NumOfLesson; ?> Lessons</a>
                        </div>
                        <div class="description">
                            <?= $course->description; ?>
                        </div>
                    </div>
                </div>
            <?php } ?>

        </div>
    </div>
</main>