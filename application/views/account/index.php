<main class="account">
    <div class="ui container">
        <div class="ui secondary blue pointing menu">
            <a class="active item" href="<?= site_url('account'); ?>">My Dashboard</a>
            <a class="item" href="<?= site_url('account/history'); ?>">History</a>
            <a class="item" href="<?= site_url('account/rewards'); ?>">Rewards</a>
        </div>
        <br/>
        <div class="ui stackable grid">

            <div class="ten wide column">
                <!-- Keep Playing Courses -->
                <div class="ui container" id="content-account">
                    <h2>Your Courses</h2>
                    <br />
                    
                    <?php foreach($enroll_course as $course) { 
                        if ($course->enroll_status == TRUE) { ?>
                            <div class="ui stackable middle aligned grid">
                                <div class="four wide column">
                                    <div>
                                        <img class="ui circular image" src="<?= $course->course_badge; ?>" alt="Courses Course" />
                                    </div>
                                </div>
                                <div class="eight wide column">
                                    <div>
                                        <h3><?= $course->course_name; ?></h3>
                                    </div>
                                    <br />
                                </div>
                                <div class="wide column"></div>
                                <div class="three wide column">
                                    <div class="ui stackable middle aligned grid">
                                        <a href="<?= $course->enroll_url; ?>" class="ui fluid primary button">Resume</a>
                                    </div>
                                </div>
                            </div>
                        <?php } 
                    } ?>

                </div>

            </div>
            <div class="wide column"></div>

            <div class="five wide column">
                <!-- Recent Badges -->
                <div class="ui container">
                    <div class="ui card">
                        <div class="content">
                            <div class="header">
                                <h3>Recent Badges</h3>
                            </div>
                        </div>

                        <div class="extra content">
                            <div class="ui tiny circular images">
                                <?php foreach ($badges as $b) { ?>
                                    <img class="ui circular image" src="<?= $b->img; ?>" alt="Badges" />
                                <?php } ?>
                            </div>
                            <br />
                            <div class="ui center aligned container">
                                <a class="ui basic primary button" href="<?= site_url('account/rewards'); ?>">View All Badges</a>
                            </div>
                            <br />
                        </div>
                    </div>
                </div>
                <br/>

            </div>
        </div>
    </div>
</main>