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
                    	<?= form_open_multipart('admin/posts/add_post');?>
                        <div class="form-group">
							<label for="title">Post Title</label>
							<p class="help-block">Enter the title of your post.</p>
							<?= form_input(['name' => 'title', 'class' => 'form-control', 'placeholder' => 'Post Title' ]) ?>
				  		</div>

				  		<div class="form-group">
							<label for="status">Status</label>
							<p class="help-block">Choose if you want the post to be Live or Draft.</p>
							<?= form_dropdown('status',['published' => 'Publish', 'draft' => 'Draft'] , 'draft', ['class' => 'form-control', 'placeholder' => 'Status']) ?>
				  		</div>

				  		<div class="form-group">
							<label for="content">Post Content</label>
							<p class="help-block">Enter the content of your post below. Use the editor to help you format with Markdown.</p>
							<?= form_textarea(['name' => 'content', 'id' => 'content', 'value' => set_value('content'), 'class' => 'form-control', 'placeholder' => 'Post Content']) ?>
				  		</div>


				  		<div class="form-group">
							<label for="excerpt">Post Excerpt</label>
							<p class="help-block">Enter a short ~200 character excerpt (teaser) of your post below.</p>
							<?= form_textarea(['name' => 'excerpt', 'class' => 'form-control', 'placeholder' => 'Post Excerpt']) ?>
				  		</div>
                    </div>
                    <div class="border-top">
                        <div class="card-body">
                            <input class="btn btn-default" type="submit" value="Save Post">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
							<label for="excerpt">Categories</label>
							<p class="help-block">Choose any categories.  To choose multiple categories press CMD/CTRL + Click your choices.</p>
							<?= form_multiselect('cats[]', $cats, null, ['class' => 'form-control']) ?>
				  		</div>

						<h4>Optional</h4>

						<div class="form-group">
							<label for="feature_image">Feature Image</label>
							<?= form_upload(['name' => 'feature_image', 'class' => 'form-control', 'placeholder' => 'Feature Image' ]) ?>
				  		</div>

						<div class="form-group">
							<label for="url_title">URL Title</label>
							<?= form_input(['name' => 'url_title', 'class' => 'form-control', 'placeholder' => 'URL Title' ]) ?>
				  		</div>

						<p class="help-block">Optional</p>
						<div class="form-group">
							<label for="meta_title">META Title</label>
							<?= form_input(['name' => 'meta_title', 'class' => 'form-control', 'placeholder' => 'META Title']) ?>
				  		</div>

				  		<div class="form-group">
							<label for="meta_keywords">META Keywords</label>
							<?= form_input(['name' => 'meta_keywords', 'class' => 'form-control', 'placeholder' => 'META Keywords']) ?>
				  		</div>

				  		<div class="form-group">
							<label for="meta_description">META Description</label>
							<?= form_input(['name' => 'meta_description', 'class' => 'form-control', 'placeholder' => 'META Description']) ?>
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
var simplemde = new SimpleMDE({
	forceSync: true,
    element: document.getElementById("content")
});
</script>

		
