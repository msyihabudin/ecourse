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
                        <?php if($this->session->flashdata("messagePr")){?>
                            <div class="alert alert-info">      
                              <?php echo $this->session->flashdata("messagePr")?>
                            </div><br>
                        <?php } ?>
                        
                        <?php if(CheckPermission("users", "own_create")){ ?>
                        <a href="<?= site_url('admin/user/add');?>" class="btn btn-primary"><i class="fas fa-plus"></i> Add User</a>
                        <?php } ?>
                        <br /><br />

                        <div class="ui blue padded segment">
                            <table class="table" id="tables">
                                <thead>
                                    <tr>
                                        <th>Status</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data_users as $user) { ?>
                                    <tr>
                                        <td><?= $user->status; ?></td>
                                        <td><?= $user->name; ?></td>
                                        <td><?= $user->email; ?></td>
                                        <td><?= $user->user_type; ?></td>
                                        <td>
                                            <a href="<?= site_url('admin/user/edit/'.$user->users_id); ?>"><i class="fas fa-edit"></i></a>
                                            <a href="<?= site_url('admin/user/delete/'.$user->users_id); ?>"><i class="fas fa-trash"></i></a>
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