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
                        <p><a class="btn btn-primary" href="<?php echo site_url('admin/pages/add_page') ?>">Add New Page</a></p>

                        <table class="table" id="tables">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Date Created</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>    
                            </thead>
                            <tbody>
                                <?php foreach ($pages as $page): ?>
                                <tr>
                                    <td><?= $page->title ?></td>
                                    <td><?= $page->date ?></td>
                                    <td><?= $page->status ?></td>
                                    <td class="text-right">
                                        <a href="<?= site_url('admin/pages/edit_page/' . $page->id) ?>"><i class="fas fa-edit"></i></a>
                                        <a href="<?= site_url('admin/pages/remove_page/' . $page->id) ?>"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                                <?php endforeach ?>
                            </tbody>                            
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $this->load->view('admin/partials/footer.php'); ?>
</div>