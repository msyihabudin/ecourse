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
                    	<?= validation_errors() ?>

						<?php if (isset($message)): ?>
							<div class="alert alert-danger" role="alert">
								<?= $message ?>
							</div>
						<?php endif ?>

						<ul class="nav nav-tabs" role="tablist">
						    <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#basics" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Basics</span></a> </li>
						    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#advanced" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Advanced</span></a> </li>
						</ul>
						<!-- Tab panes -->
						<div class="tab-content tabcontent-border">
						    <div class="tab-pane active" id="basics" role="tabpanel">
						        <div class="col-md-8">
					                <div class="card">
					                    <div class="card-body">
					                    	<?= form_open_multipart(current_url());?>
					                        <div class="form-group">
												<label for="title">Post Title</label>
												<p class="help-block">Enter the title of your post.</p>
												<?= form_input(['name' => 'title', 'value' => $post['title'], 'class' => 'form-control', 'placeholder' => 'Post Title' ]) ?>
									  		</div>

									  		<div class="form-group">
												<label for="status">Status</label>
												<p class="help-block">Choose if you want the post to be Live or Draft.</p>
												<?= form_dropdown('status',['published' => 'Publish', 'draft' => 'Draft'] , $post['status'], ['class' => 'form-control', 'placeholder' => 'Status']) ?>
									  		</div>

									  		<div class="form-group">
												<label for="content">Post Content</label>
												<p class="help-block">Enter the content of your post below. Use the editor to help you format with Markdown.</p>
												<?= form_textarea(['name' => 'content', 'id' => 'content', 'class' => 'form-control', 'value' => $post['content'], 'placeholder' => 'Post Content']) ?>
									  		</div>

									  		<div class="form-group">
												<label for="excerpt">Post Excerpt</label>
												<p class="help-block">Enter a short ~200 character excerpt (teaser) of your post below.</p>
												<?= form_textarea(['name' => 'excerpt', 'class' => 'form-control', 'value' => $post['excerpt'], 'placeholder' => 'Post Excerpt']) ?>
									  		</div>

									  		<div class="form-group">
												<label for="excerpt">Categories</label>
												<p class="help-block">Choose any categories.  To choose multiple categories press CMD/CTRL + Click your choices.</p>
												<?= form_multiselect('cats[]', $post['cats'], $post['selected_cats'], ['class' => 'form-control']) ?>
									  		</div>

											<h4>Optional</h4>

											<div class="form-group">
												<label for="feature_image">Feature Image</label>
												<?php if($post['feature_image']): ?>
										          <img src="<?= base_url('assets/image/posts/' . $post['feature_image']) ?>" class="img-responsive" alt="<?php echo $post['title'] ?>">
										        <?php endif ?>
												
												<p class="help-block">Upload a feature image to replace current or leave blank to keep the same.</p>
												<?= form_upload(['name' => 'feature_image', 'class' => 'form-control', 'placeholder' => 'Feature Image' ]) ?>
									  		</div>
											
											<div class="form-group">
												<label for="meta_title">META Title</label>
												<?= form_input(['name' => 'meta_title', 'class' => 'form-control', 'value' => $post['meta_title'], 'placeholder' => 'META Title']) ?>
									  		</div>

									  		<div class="form-group">
												<label for="meta_keywords">META Keywords</label>
												<?= form_input(['name' => 'meta_keywords', 'class' => 'form-control', 'value' => $post['meta_keywords'], 'placeholder' => 'META Keywords']) ?>
									  		</div>

									  		<div class="form-group">
												<label for="meta_description">META Description</label>
												<?= form_input(['name' => 'meta_description', 'class' => 'form-control', 'value' => $post['meta_description'], 'placeholder' => 'META Description']) ?>
									  		</div>
					                    </div>
					                    <div class="border-top">
					                        <div class="card-body">
					                            <input class="btn btn-default" type="submit" value="Save Post">
					                        </div>
					                    </div>
					                </div>
					            </div>
						    </div>
						    <div class="tab-pane  p-20" id="advanced" role="tabpanel">
						        <div class="col-md-8">
					                <div class="card">
					                    <div class="card-body">
					                    	
					                        <div class="form-group">
												<label for="url_title">URL Title</label>
												<p class="help-block">This is the 'slug' shown in the URL of your post. If you change this value, there must be NO spaces between words, instead, used dashes. <br>IE: new-url-title</p>
												<?= form_input(['name' => 'url_title', 'class' => 'form-control', 'value' => $post['url_title'], 'placeholder' => 'URL Title' ]) ?>
									  		</div>

									  		<div class="form-group">
												<label for="status">Redirection</label>
												<p class="help-block">If you change the URL Title above we automatically set up an HTTP 301 (permanent) redirect for you so the old url_title points to the new post url_title. Here, you can override the default settings.</p>
												<?= form_dropdown('redirection',['none' => 'Do Not Redirect Old URL Title', '301' => 'Perminently Redirect to new URL Title', '302' => 'Temporarily Redirect to new URL Title'] , '301', ['class' => 'form-control', 'placeholder' => 'Redirection']) ?>
									  		</div>
					                    </div>
					                    <div class="border-top">
					                        <div class="card-body">
					                            <input class="btn btn-default" type="submit" value="Save Post">
					                        </div>
					                    </div>
					                    <?= form_close();?>
					                </div>
					            </div>
						    </div>
						</div>
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