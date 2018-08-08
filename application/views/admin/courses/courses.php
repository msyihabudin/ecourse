<div class="page-wrapper">
     <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title"><?= $title; ?></h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <?= $breadcrumbs; ?>
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
                        </div><br>
                    <?php } ?>
                    <a href="<?= site_url('admin/courses/add');?>" class="btn btn-primary"><i class="fas fa-plus"></i> Add New Course</a>
                    <br /><br />
                        
                        <div class="table-responsive">
                            <table class="table" id="tables">
                                <thead>
                                    <tr>
                                        <th class="one wide">ID</th>
                                        <th class="two wide">Course Badge</th>
                                        <th class="three wide">Name</th>
                                        <th class="four wide">Description</th>
                                        <th class="five wide">Enroll URL</th>
                                        <th class="six wide">Created At</th>
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
                                                <a href="<?= base_url('admin/courses/remove_course/'.$courses->id_course) ?>"><i class="fas fa-trash"></i></a>
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