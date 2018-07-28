<section class="hero-skills">
<div class="ui center aligned container" id="hero-content">
    <div class="ui container">
        <h1 class="ui inverted header"><?= $content[0]->name; ?></h1>
        <p class="ui inverted header"><?= $content[0]->description; ?></p>
        <?php if (isset($this->session->userdata['user_signed_in'])) { ?>            
            <?php if ($enroll['enroll_status']) { ?>
                <a class="ui large black button" href="<?= site_url('quest/unenroll/'.$enroll['id'].'/'.$user['id_course'].'/'.$enroll['enroll_status']); ?>">Enrolled</a>    
            <?php } else { ?>
                <a class="ui large black button" href="<?= site_url('quest/enroll/'.$user['id_user'].'/'.$user['id_course']); ?>">Enroll Now</a>    
            <?php } ?>
        <?php } else { ?>
            <a class="ui large black button" href="<?= site_url('signin'); ?>">Enroll Now</a>    
        <?php } ?>
    </div>
</div>
</section>

<main class="learn-realm">
    <div class="ui container">
        <div class="ui stackable grid">
            <div class="ten wide column">
                <div class="ui container">
                    <?php foreach ($content[0]->courses as $quest) { ?>
                        <div class="ui segments">
                            <div class="ui segment">
                                <div class="ui stackable middle aligned grid">
                                    <div class="three wide column">
                                        <a href="<?= $quest->img; ?>">
                                            <img class="ui small circular image" src="<?= $quest->img; ?>" alt="<?= $quest->nameCourse; ?>" />
                                        </a>
                                    </div>
                                    <div class="ten wide column">
                                        <a href="#"><h2><?= $quest->nameCourse; ?></h2></a>
                                        <p><?= $quest->description; ?></p>
                                        <p>Point : <?= $quest->point; ?></p>
                                    </div>
                                    <div class="three wide column">
                                        <div class="ui small label">Not Complete</div>
                                    </div>
                                </div>
                            </div>
                            <div class="ui segment">
                                <h3>Materi : <span><a href="<?= $quest->file; ?>"><?= $quest->nameCourse ?></a></span></h3>
                                <?= form_open_multipart('quest/'.$quest->nameCourse.'/upload/', 'class="ui form"'); ?>
                                    <?= form_hidden('url', current_url()); ?>
                                    <div class="field">
                                        <?= form_upload('file', ''); ?>
                                    </div>
                                    <div class="field">
                                        <?= form_submit('upload_file', 'Upload File', 'class="ui fluid primary button"'); ?>
                                    </div>
                                <?= form_close(); ?>
                            </div>
                        </div>
                        <br />
                    <?php } ?>
                </div>
            </div>
            <div class="two wide column"></div>
            <div class="four wide column">
                <div class="ui center aligned container">
                    <div class="ui card">
                        <div class="image">
                            <img src="<?= $content[0]->img; ?>" alt="<?= $content[0]->name; ?>" />
                        </div>
                        <div class="content">
                            <div class="header">
                                Courses
                            </div>
                            <div class="meta">
                                <?= $content[0]->NumOfLesson; ?> Lessons
                            </div>
                        </div>
                        <?php if (isset($this->session->userdata['user_signed_in'])) { ?>
                            <div class="extra content">
                                <a href="<?= site_url('account'); ?>">My Account</a>
                            </div>
                        <?php } ?>
                    </div>
                    
                </div>  
            </div>
        </div>
    </div>
</main >