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
                    <form action="<?= site_url('admin/quest/save_edit_quest'); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">

                    <?= form_hidden('id_quest', $quest['id']); ?>

                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-md-3">Name</label>
                            <div class="col-sm-9">
                                <?= form_input('name', $quest['quest_name'], array('placeholder'=>'Name', 'required'=>'', 'class'=>'form-control')); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">Description</label>
                            <div class="col-sm-9">
                                <?= form_textarea('description', $quest['description'], array('placeholder'=>'Description', 'required'=>'', 'class'=>'form-control')); ?>
                            </div>
                        </div>
                    </div>
                    <div class="border-top">
                        <div class="card-body">
                            <?= form_submit('save_edit', 'Save Quest', 'class="btn btn-primary"'); ?>
                        </div>
                    </div>
                    </form>                             
                </div>
            </div>
        </div>
    </div>
    <?php $this->load->view('admin/partials/footer.php'); ?>
</div>