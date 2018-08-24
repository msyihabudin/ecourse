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
                    <form action="<?= site_url('admin/courses/save'); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-md-3">Name</label>
                            <div class="col-sm-9">
                                <?= form_input('name', '', array('placeholder'=>'Name', 'required'=>'', 'class'=>'form-control')); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">Description</label>
                            <div class="col-sm-9">
                                <?= form_textarea('description', '', array('placeholder'=>'Description', 'required'=>'', 'class'=>'form-control')); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">Price<br><p>(Set 0 if course is <strong>free</strong>)</p></label>
                            <div class="col-sm-9">
                                <?= form_input('price', '', array('placeholder'=>'Price', 'required'=>'', 'class'=>'form-control')); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">Course Categories</label>
                            <div class="col-sm-9">
                                <select name="id_quest" class="form-control">
                                    <?php foreach($quest as $value) { ?>
                                    <option value="<?= $value->id;?>"><?= $value->quest_name;?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">Enroll URL</label>
                            <div class="col-sm-2">
                                courses/
                            </div>
                            <div class="col-sm-7">
                                <?= form_input('enroll_url', '', array('placeholder'=>'Enrol URL', 'class'=>'form-control')); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">Course Badge (type: png, jpg)</label>
                            <div class="col-sm-9">
                                <?= form_upload('course_badge', '', array('required' => '', 'class' => 'form-control')); ?>
                            </div>
                        </div>               
                    </div>
                    <div class="border-top">
                        <div class="card-body">
                            <?= form_submit('add_course', 'Save Courses', 'class="btn btn-primary"'); ?>
                        </div>
                    </div>
                    </form>                             
                </div>
            </div>
        </div>
    </div>
    <?php $this->load->view('admin/partials/footer.php'); ?>
</div>