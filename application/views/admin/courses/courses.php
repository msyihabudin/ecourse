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
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                    <button class="btn btn-primary" id="add">Add New Course</button>
                    <br /><br />
                        
                        <div class="table-responsive">
                            <table class="table" id="tables">
                                <thead>
                                    <tr>
                                        <th class="one wide">ID</th>
                                        <th class="two wide">Course Badge</th>
                                        <th class="two wide">Name</th>
                                        <th class="five wide">Description</th>
                                        <th class="one wide">Enroll URL</th>
                                        <th class="three wide">Created At</th>
                                        <th style="width: 43px;">Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data_courses as $courses) { ?>
                                    <tr>
                                        <td><?= $courses->id_course; ?></td>
                                        <td><img src="<?= $courses->course_badge; ?>" width="100px" height="50px"></td>
                                        <td><?= $courses->course_name; ?></td>
                                        <td><?= $courses->description; ?></td>
                                        <td><?= $courses->enroll_url; ?></td>
                                        <td><?= $courses->created_at; ?></td>
                                        <td>
                                            <div class="ui icon buttons">
                                                <a href="<?= site_url('admin/courses/path/'.$courses->id_course); ?>"><i class="fas fa-info-circle"></i></a>
                                                <a href="<?= site_url('admin/courses/edit/'.$courses->id_course); ?>"><i class="fas fa-edit"></i></a>
                                                <a href="#"><i class="fas fa-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr></tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>                 
                </div>
            </div>
        </div>
    </div>
    <?php $this->load->view('admin/partials/footer.php'); ?>
</div>

<div class="ui modal add">
    <i class="close icon"></i>
    <div class="header">
        Add New Course
    </div>
    <div class="content">
        <?= form_open_multipart('admin/courses/add_course', 'class="ui form"'); ?>
            <div class="required field">
                <label>Name</label>
                <?= form_input('name', '', array('placeholder'=>'Name', 'required'=>'')); ?>
            </div>
            <div class="required field">
                <label>Description</label>
                <?= form_textarea('description', '', array('placeholder'=>'Description', 'required'=>'')); ?>
            </div>
            <div class="required field">
                <label>Enroll URL</label>
                <?= form_input('enroll_url', '', array('placeholder'=>'Enrol URL')); ?>
            </div>
            <div class="required field">
                <label>Course Badge (type: png, jpg)</label>
                <?= form_upload('course_badge', ''); ?>
            </div>
            <?= form_submit('add_course', 'Save courses', 'class="ui fluid primary button"'); ?>
        <?= form_close(); ?>
    </div>
</div>