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
                    <div class="card-body">
                        <?php if($this->session->flashdata("messagePr")){ ?>
                        <div class="alert alert-info">      
                          <?= $this->session->flashdata("messagePr"); ?>
                        </div><br />
                        <?php } ?>
                        <div class="ui blue padded segment">
                            <h3><?= $path['title_path']; ?></h3>
                            <p><?= $path['description']; ?></p>

                            <a href="<?= site_url('admin/courses/path/lesson/add/'.$path['id_course_path']);?>" class="btn btn-primary"><i class="fas fa-plus"></i> Add New Lesson</a>
                            <br /><br />

                            <table class="table" id="tables">
                                <thead>
                                    <tr>
                                        <th>ID Lesson</th>
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
                                        <td><?= $lesson->name_lesson; ?></td>
                                        <td><?= $lesson->description; ?></td>
                                        <td><?= $lesson->course_lesson_url; ?></td>
                                        <td><?= $lesson->created_at; ?></td>
                                        <td>
                                            <div class="ui icon buttons">
                                                <a href="<?= site_url('admin/courses/path/lesson/edit/'.$lesson->id_course_lesson); ?>"><i class="fas fa-edit"></i></a>
                                                <a href="<?= base_url('admin/courses/remove_lesson/'.$lesson->id_course_lesson) ?>"><i class="fas fa-trash"></i></a>
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