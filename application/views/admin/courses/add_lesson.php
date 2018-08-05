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
                    <form action="<?= site_url('admin/courses/save_lesson'); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
                    <?= form_hidden('id_course_path', $path['id_course_path']); ?>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-md-3">Title</label>
                            <div class="col-sm-9">
                                <?= form_input('name', '', array('placeholder'=>'Title', 'required'=>'', 'class'=>'form-control')); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">Description</label>
                            <div class="col-sm-9">
                                <?= form_textarea('description', '', array('placeholder'=>'Description', 'required'=>'', 'class'=>'form-control')); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">URL</label>
                            <div class="col-sm-9">
                                <?= form_input('course_lesson_url', '', array('placeholder'=>'URL', 'required'=>'', 'class'=>'form-control')); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">Lesson Badge (type: png, jpg)</label>
                            <div class="col-sm-9">
                                <?= form_upload('course_lesson_badge', '', array('required'=>'', 'class'=>'form-control')); ?>
                            </div>
                        </div>
                    <div class="border-top">
                        <div class="card-body">
                            <?= form_submit('add_lesson', 'Save Lesson', 'class="btn btn-primary"'); ?>
                        </div>
                    </div>
                    </form>                             
                </div>
            </div>
        </div>
    </div>
    <?php $this->load->view('admin/partials/footer.php'); ?>
</div>