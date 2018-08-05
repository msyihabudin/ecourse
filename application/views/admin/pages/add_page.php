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
    		<?= validation_errors() ?>

			<?php if (isset($message)): ?>
				<div class="alert alert-danger" role="alert">
					<?= $message ?>
				</div>
			<?php endif ?>

			<div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                    	<?= form_open(current_url());?>
                    	<div class="form-group">
							<label for="title">Page Title</label>
							<p class="help-block">Enter the title of your page.</p>
							<?= form_input(['name' => 'title', 'class' => 'form-control', 'placeholder' => 'Page Title' ]) ?>
				  		</div>

				  		<div class="form-group">
							<label for="status">Status</label>
							<p class="help-block">Choose if you want the page to be Publish or Draft.</p>
							<?= form_dropdown('status',['active' => 'Publish', 'inactive' => 'Draft'] , 'inactive', ['class' => 'form-control', 'placeholder' => 'Status']) ?>
				  		</div>

				  		<div class="form-group">
							<label for="content">Page Content</label>
							<p class="help-block">Enter the content of your page below. Use the editor to help you format with Markdown.</p>
							<?= form_textarea(['name' => 'content', 'class' => 'form-control', 'placeholder' => 'Page Content']) ?>
				  		</div>

				  		<div class="border-top">
	                        <div class="card-body">
	                            <input class="btn btn-default" type="submit" value="Save Pages">
	                        </div>
	                    </div>
                    </div>
                 </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                    	<h4>Optional</h4>
						<p class="help-block">While the options below are optional, they are highly recommended and greatly help with Search Engine Optimization (SEO). We also generate meta tags for facebook and twitter with these values.</p>
						<div class="form-group">
							<label for="meta_title">META Title</label>
							<p class="help-block">Usually the same as your page title, but you can enter a different one here.</p>
							<?= form_input(['name' => 'meta_title', 'class' => 'form-control', 'placeholder' => 'META Title']) ?>
				  		</div>

				  		<div class="form-group">
							<label for="meta_keywords">META Keywords</label>
							<p class="help-block">Enter the keywords for this page separated by commas.</p>
							<?= form_input(['name' => 'meta_keywords', 'class' => 'form-control', 'placeholder' => 'META Keywords' ]) ?>
				  		</div>

				  		<div class="form-group">
							<label for="meta_description">META Description</label>
							<p class="help-block">Enter the description for this page.  It's best to keep it between 50 and 100 characters.</p>
							<?= form_input(['name' => 'meta_description', 'class' => 'form-control', 'placeholder' => 'META Description']) ?>
				  		</div>

				  		<div class="checkbox">
				    		<input type="checkbox" name="is_home"> Homepage
				      			<p class="help-block">Check the box if this page is the homepage. You must choose Pages to be the default controller in Settings.  Any other page currently marked as the homepage will be removed as the homepage.</p>
				  		</div>
                    	<?= form_close();?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $this->load->view('admin/partials/footer.php'); ?>
</div>

<script>
var simplemde = new SimpleMDE();
</script>