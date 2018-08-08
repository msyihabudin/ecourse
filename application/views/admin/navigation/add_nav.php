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
							<label for="title">Title</label>
							<p class="help-block">This is the text shown in the navigation bar that visitors see and click.</p>
							<?= form_input(['name' => 'title', 'class' => 'form-control', 'value' => set_value('title'), 'placeholder' => 'Title' ]) ?>
				  		</div>

				  		<div class="form-group">
							<label for="description">Description</label>
							<p class="help-block">This is the description of this link and it used for the title field. Visitors see this when hovering the mouse over the link text.</p>
							<?= form_input(['name' => 'description', 'class' => 'form-control', 'value' => set_value('description'), 'placeholder' => 'Description' ]) ?>
				  		</div>
            		</div>
            		<div class="border-top">
                        <div class="card-body">
                            <input class="btn btn-default" type="submit" value="Save Navigation Item">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                    	<h4>Navigation Link</h4>
						<p>Below you can link to a specific page or post. Leave all options blank to point to your homepage.</p>

						<div class="form-group">
							<label for="page">Choose A Page</label>
							<p class="help-block">Choose from existing pages.</p>
							<?= form_dropdown('page', $page_slugs, '', 'class="form-control"'); ?>
				  		</div>	

				  		<div class="form-group">
							<label for="post">Choose A Blog Post</label>
							<p class="help-block">Choose from existing blog posts.</p>
							<?= form_dropdown('post', $post_slugs, '', 'class="form-control"'); ?>
						</div>
						<?= form_close();?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $this->load->view('admin/partials/footer.php'); ?>
</div>