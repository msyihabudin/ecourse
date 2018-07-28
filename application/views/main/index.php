<section class="hero-main">
    <div class="ui center aligned container" id="hero-main-content">
        <h1 class="ui inverted header">Role. Playing. Code.</h1>
        <h2 class="ui inverted header">The Interactive learning and playfull like a game</h2>
        <br>
        <a class="ui large inverted button" href="<?= site_url('courses'); ?>">Explore Our Course</a>
    </div>
</section>

<main class="learn-realm">
    <div class="ui text center aligned container main-title">
        <h1>Learning</h1>
        <p>ECourse mission courses are organized into Skills Path based on technology. Learn to upgrade your skills now.
        </p>
    </div>
    <div class="ui container">
        <div class="ui three stackable centered cards">
            
            <?php foreach ($courses as $course){ ?>
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

<section id="how-coderealm-works">
    <div class="ui text center aligned container main-title">
        <h1>How ECourse Works</h1>
    </div>
    <div class="ui container">
        <div class="ui stackable two column grid">
            <div class="column" id="works">
                <img class="ui small centered image" src="<?= base_url("assets/image/Works/works-learn.svg"); ?>">
            </div>
            <div class="column" id="works">
                <div class="ui container">
                    <h2>Register</h2>
                    <p>Experienced, engaging instructors take you through course material, step by step, in our high-quality video lessons.</p>
                </div>
            </div>
            <div class="column" id="works">
                <img class="ui small centered image" src="<?= base_url("assets/image/Works/works-win.svg"); ?>">
            </div>
            <div class="column" id="works">
                <div class="ui container">
                    <h2>Learn</h2>
                    <p>Rack up points in the challenges and earn badges as you complete each course level, leading up to the coveted course completion badge.</p>
                </div>
            </div>
            <div class="column" id="works">
                <img class="ui small centered image" src="<?= base_url("assets/image/Works/works-track.svg"); ?>">
            </div>
            <div class="column" id="works">
                <div class="ui container">
                    <h2>Track</h2>
                    <p>Keep track of all your activity — points and badges earned, courses completed, screencasts watched, and more — with your Report Card.</p>
                </div>
            </div>
        </div>
    </div>
</section>