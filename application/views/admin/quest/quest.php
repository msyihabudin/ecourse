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
                            </div><br>
                        <?php } ?>
                        <a href="<?= site_url('admin/quest/add');?>" class="btn btn-primary"><i class="fas fa-plus"></i> Add New Quest</a>
                        <br /><br />
                        <div class="table-responsive">
                            <table class="table" id="tables">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($quests as $quest) { ?>
                                    <tr>
                                        <td><?= $quest->id; ?></td>
                                        <td>
                                            <img width="100px" height="100px" src="<?= $quest->img; ?>" alt="<?= $quest->quest_name; ?>"/>
                                        </td>
                                        <td><?= $quest->quest_name; ?></td>
                                        <td><?= $quest->description; ?></td>
                                        <td>
                                            <div class="ui icon buttons">
                                                <a href="<?= site_url('admin/quest/edit/'.$quest->id); ?>"><i class="fas fa-edit"></i></a>
                                                <a href="<?= base_url('admin/quest/remove_quest/'.$quest->id) ?>"><i class="fas fa-trash"></i></a>
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