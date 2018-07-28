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
                            <table class="table" id="tables">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>ID Lecture</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Enroll URL</th>
                                        <th>Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($quests as $quest) { ?>
                                    <tr>
                                        <td><?= $quest->id; ?></td>
                                        <td><?= $quest->id_lecture; ?></td>
                                        <td>
                                            <img width="100px" height="100px" src="<?= $quest->img; ?>" alt="<?= $quest->lesson_name; ?>"/>
                                        </td>
                                        <td><?= $quest->lesson_name; ?></td>
                                        <td><?= $quest->description; ?></td>
                                        <td><?= $quest->enroll_url; ?></td>
                                        <td>
                                            <div class="ui icon buttons">
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