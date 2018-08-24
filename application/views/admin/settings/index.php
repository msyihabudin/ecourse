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
                        <p>Settings allow you to change how your website performs certain actions and basic information like your site's name.</p>
                        <!-- Nav tabs -->

                        <div>
                            <?= validation_errors() ?>
                        </div>
                        <?php if (isset($message)): ?>
                        <div class="alert alert-danger" role="alert">
                            <?= $message ?>
                        </div>
                        <?php endif ?>
                        <ul class="nav nav-tabs" role="tablist">
                            <?php $count = 0 ?>
                            <?php foreach ($settings as $tab): ?>
                            <li class="nav-item"> <a class="nav-link <?php if ($count == 0) echo 'active'; ?>" data-toggle="tab" href="#<?= $tab->tab ?>" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down"><?= ucfirst($tab->tab) ?></span></a> </li>
                            <?php $count++ ?>
                            <?php endforeach ?>
                        </ul>

                        <!-- Tab panes -->
                        <?= form_open() ?>
                        <!-- Tab panes -->
                        <div class="tab-content tabcontent-border">
                            <?php $count = 0 ?>
                            <?php foreach ($settings as $tab): ?>
                            <div class="tab-pane <?php echo ($count == 0) ? 'in active': ''; ?>" id="<?= $tab->tab ?>" role="tabpanel">
                                <div class="col-md-8">
                                    <div class="card">
                                        <div class="card-body">
                                            <?php foreach ($tab->list as $item): ?>
                                            <div class="form-group">
                                                <label for="<?= $item->name ?>" class="col-md-3 control-label"><?= $item->name; ?></label>
                                                <div class="col-sm-9">
                                                    <?= $item->input ?>
                                                    <hr>
                                                </div>
                                            </div>
                                            <?php endforeach ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php $count++ ?>
                            <?php endforeach ?>
                            <div class="border-top">
                                <div class="card-body">
                                    <input class="btn btn-default" type="submit" value="Save">
                                </div>
                            </div>
                        </div>
                        <?= form_close() ?>
                    </div>                 
                </div>
            </div>
        </div>
    </div>
    <?php $this->load->view('admin/partials/footer.php'); ?>
</div>
