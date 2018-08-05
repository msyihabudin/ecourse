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
                	<?= validation_errors() ?>

					<?php if (isset($message)): ?>
						<div class="alert alert-danger" role="alert">
							<?= $message ?>
						</div>
					<?php endif ?>
					<br>
                	<?= form_open(current_url());?>
                	<div class="card-body">
                		<div class="form-group row">
                            <label class="col-md-3">Category Name</label>
                            <div class="col-sm-9">
                                <?= form_input( [ 'name'=> 'name', 'id' => 'name', 'class' => "form-control", 'placeholder' => 'Category Name', 'value' => ($this->input->post('name'))?$this->input->post('name'):$cat['name'] ] ) ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">URL Name</label>
                            <div class="col-sm-9">
                                <?= form_input(['name'=> 'url_name', 'id' => 'url_name', 'class' => "form-control", 'placeholder' => 'URL Name', 'value' => ($this->input->post('url_name'))?$this->input->post('url_name'):$cat['url_name'] ] ) ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">Description</label>
                            <div class="col-sm-9">
                                <?= form_input(['name'=> 'description', 'id' => 'description', 'class' => "form-control", 'placeholder' => 'Description', 'value' => ($this->input->post('description'))?$this->input->post('description'):$cat['description']]); ?>
                            </div>
                        </div>
                        <div class="border-top">
	                        <div class="card-body">
	                            <input class="btn btn-primary" type="submit" value="Save Category">
	                        </div>
	                    </div>
			    		
                	</div>
                	<?= form_close();?>
                </div>
            </div>
        </div>
    </div>
    <?php $this->load->view('admin/partials/footer.php'); ?>
</div>