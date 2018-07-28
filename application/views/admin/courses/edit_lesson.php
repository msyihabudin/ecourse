<div class="page-wrapper">
     <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title"><?= $title; ?></h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <form action="<?= site_url('admin/courses/save_edit_lesson'); ?>" class="form-horizontal">
                        <div class="card-body">
                            <h4 class="card-title"><a class="btn btn-primary" href="<?= site_url('admin/courses/path/lesson/'.$this->uri->segment(6)); ?>"><i class="fas fa-angle-left"></i> Back</a> Edit Lesson</h4>
                            
                            <?= form_hidden('id_course_lesson', $lesson['id_course_lesson']); ?>
                            <?= form_hidden('id_course_path', $lesson['id_course_path']); ?>

                            <div class="form-group row">
                                <label class="col-md-3">Lesson Name</label>
                                <div class="col-sm-9">
                                    <?= form_input('name', $lesson['name_lesson'], array('placeholder'=>'Lesson Name', 'required'=>'', 'class'=>'form-control')); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3">Descripton</label>
                                <div class="col-sm-9">
                                    <?= form_textarea('description', $lesson['description'], array('placeholder'=>'Description', 'required'=>'', 'class'=>'form-control')); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3">Lesson URL</label>
                                <div class="col-sm-9">
                                    <?= form_input('course_lesson_url', $lesson['course_lesson_url'], array('placeholder'=>'Lesson URL', 'required'=>'', 'class'=>'form-control')); ?>
                                </div>
                            </div>                            
                        </div>
                        <div class="border-top">
                            <div class="card-body">
                                <?= form_submit('save_edit_lesson', 'Save Lesson', 'class="btn btn-primary"'); ?>
                            </div>
                        </div>
                    </form>                             
                </div>
            </div>
        </div>
    </div>
    <?php $this->load->view('admin/partials/footer.php'); ?>
</div>