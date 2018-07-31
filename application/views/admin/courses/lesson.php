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

                        <div class="ui blue padded segment">
                            <h3><?= $path['title_path']; ?></h3>
                            <p><?= $path['description']; ?></p>

                            <button class="btn btn-primary" id="add"><i class="fas fa-plus"></i> Add New Lesson</button>
                            <br /><br />

                            <table class="table" id="tables">
                                <thead>
                                    <tr>
                                        <th>ID Lesson</th>
                                        <th>Lesson Badge</th>
                                        <th>Name Lesson</th>
                                        <th>Description</th>
                                        <th>Lesson URL</th>
                                        <th>Created At</th>
                                        <th style="width: 43px;">Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data_lesson as $lesson) { ?>
                                    <tr>
                                        <td><?= $lesson->id_course_lesson; ?></td>
                                        <td><img width="100px" height="100px" src="<?= $lesson->course_lesson_badge; ?>" /></td>
                                        <td><?= $lesson->name_lesson; ?></td>
                                        <td><?= $lesson->description; ?></td>
                                        <td><?= $lesson->course_lesson_url; ?></td>
                                        <td><?= $lesson->created_at; ?></td>
                                        <td>
                                            <div class="ui icon buttons">
                                                <a href="<?= site_url('admin/courses/path/lesson/edit/'.$lesson->id_course_lesson); ?>"><i class="fas fa-edit"></i></a>
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
        Add New Lesson
    </div>
    <div class="content">
        <?= form_open_multipart('admin/courses/add_lesson', 'class="ui form"'); ?>
            <?= form_hidden('id_course_path', $path['id_course_path']); ?>
            <div class="required field">
                <label>Name lesson</label>
                <?= form_input('name', '', array('placeholder'=>'Name lesson', 'required'=>'')); ?>
            </div>
            <div class="required field">
                <label>Description</label>
                <?= form_input('description', '', array('placeholder'=>'Description', 'required'=>'')); ?>
            </div>
            <div class="required field">
                <label>Lesson URL</label>
                <?= form_input('course_lesson_url', '', array('placeholder'=>'lesson URL', 'required'=>'')); ?>
            </div>
            <div class="required field">
                <label>Lesson Badge (type: png, jpg)</label>
                <?= form_upload('course_lesson_badge', ''); ?>
            </div>
            <?= form_submit('add_lesson', 'Save Lesson', 'class="ui fluid primary button"'); ?>
        <?= form_close(); ?>
    </div>
</div>