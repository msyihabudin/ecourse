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
                            <div class="ui stackable grid">
                                <div class="three wide column">
                                    <img class="ui medium image" src="<?= $course['course_badge']; ?>">
                                </div>
                                <div class="thirteen wide column">
                                    <h3><?= $course['course_name']; ?></h3>
                                    <p><?= $course['description']; ?></p>
                                    <a><?= $course['enroll_url']; ?></a>
                                </div>
                            </div>
                            <br />

                            <a href="<?= site_url('admin/courses/path/add/'.$course['id_course']);?>" class="btn btn-primary"><i class="fas fa-plus"></i> Add New Path</a>
                            <br /><br />

                            <table class="table" id="tables">
                                <thead>
                                    <tr>
                                        <th>ID Path</th>
                                        <th>Title Path</th>
                                        <th>Description</th>
                                        <th>Created At</th>
                                        <th style="width: 43px;">Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data_path as $path) { ?>
                                    <tr>
                                        <td><?= $path->id_course_path; ?></td>
                                        <td><?= $path->title_path; ?></td>
                                        <td><?= $path->description; ?></td>
                                        <td><?= $path->created_at; ?></td>
                                        <td>
                                            <div class="ui icon buttons">
                                                <a href="<?= site_url('admin/courses/path/lesson/'.$path->id_course_path); ?>"><i class="fas fa-info-circle"></i></a>
                                                <a href="<?= site_url('admin/courses/path/edit/'.$path->id_course_path); ?>"><i class="fas fa-edit"></i></a>
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