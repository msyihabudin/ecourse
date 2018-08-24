<div class="page-wrapper">
     <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title"><?= $title; ?></h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <?= $breadcrumbs;?>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form action="<?= site_url('admin/courses/save_edit_lesson'); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
                        <div class="card-body">
                                                        
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
                            <div class="form-group row">
                            <label class="col-md-3">Lesson File (type: doc, pdf, ppt)</label>
                            <div class="col-sm-9">
                                <?= form_upload('course_lesson_file', $lesson['course_lesson_file'], array('class'=>'form-control')); ?>
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