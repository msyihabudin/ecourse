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
                    <form action="<?= site_url('admin/courses/save_edit_course'); ?>" class="form-horizontal">
                    <div class="card-body">
                        <h4 class="card-title"><a class="btn btn-primary" href="<?= site_url('admin/courses'); ?>"><i class="fas fa-angle-left"></i> Back</a> Edit Course</h4>

                        <?= form_hidden('id_course', $course['id_course']); ?>

                        <div class="form-group row">
                            <label class="col-md-3">Name</label>
                            <div class="col-sm-9">
                                <?= form_input('name', $course['course_name'], array('placeholder'=>'Name', 'required'=>'', 'class'=>'form-control')); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">Description</label>
                            <div class="col-sm-9">
                                <?= form_textarea('description', $course['description'], array('placeholder'=>'Description', 'required'=>'', 'class'=>'form-control')); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">Enroll URL</label>
                            <div class="col-sm-9">
                                <?= form_input('enroll_url', $course['enroll_url'], array('placeholder'=>'Enrol URL', 'class'=>'form-control')); ?>
                            </div>
                        </div>                
                    </div>
                    <div class="border-top">
                        <div class="card-body">
                            <?= form_submit('save_edit', 'Save Courses', 'class="btn btn-primary"'); ?>
                        </div>
                    </div>
                    </form>                             
                </div>
            </div>
        </div>
    </div>
    <?php $this->load->view('admin/partials/footer.php'); ?>
</div>