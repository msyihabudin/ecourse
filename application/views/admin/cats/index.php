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
                        <p><a class="btn btn-primary" href="<?php echo site_url('admin/cats/add_cat') ?>">Add New Category</a></p>

                        <table class="table" id="tables">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>URL (slug)</th>
                                    <th>Description</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($cats as $cat): ?>
                                    <tr>
                                    <td><?= $cat->name ?></td>
                                    <td><a href="<?= site_url('blog/category/' . $cat->url_name) ?>" target="_blank"><?= $cat->url_name ?></a></td>
                                    <td><?= $cat->description ?></td>
                                    <td>
                                        <a href="<?= site_url('admin/cats/edit_cat/' . $cat->id) ?>"><i class="fas fa-edit"></i></a>
                                        <a href="<?= site_url('admin/cats/remove_cat/' . $cat->id) ?>"><i class="fas fa-trash"></i></a>
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
