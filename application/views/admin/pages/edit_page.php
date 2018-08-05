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
												<label for="title">Page Title</label>
												<p class="help-block">Enter the title of your page.</p>
												<?= form_input(['name' => 'title', 'class' => 'form-control', 'value' => $page['title'], 'placeholder' => 'Page Title' ]) ?>
									  		</div>

									  		<div class="form-group">
												<label for="status">Status</label>
												<p class="help-block">Choose if you want the page to be Publish or Draft.</p>
												<?= form_dropdown('status',['active' => 'Publish', 'inactive' => 'Draft'] , $page['status'], ['class' => 'form-control', 'placeholder' => 'Status']) ?>
									  		</div>

									  		<div class="form-group">
												<label for="content">Page Content</label>
												<p class="help-block">Enter the content of your page below. Use the editor to help you format with Markdown.</p>
												<?= form_textarea(['name' => 'content', 'class' => 'form-control', 'value' => $page['content'], 'placeholder' => 'Page Content']) ?>
									  		</div>

									  		<h4>Optional</h4>
											<p class="help-block">While the options below are optional, they are highly recommended and greatly help with Search Engine Optimization (SEO). We also generate meta tags for facebook and twitter with these values.</p>
											<div class="form-group">
												<label for="meta_title">META Title</label>
												<p class="help-block">Usually the same as your page title, but you can enter a different one here.</p>
												<?= form_input(['name' => 'meta_title', 'class' => 'form-control', 'value' => $page['meta_title'], 'placeholder' => 'META Title']) ?>
									  		</div>

									  		<div class="form-group">
												<label for="meta_keywords">META Keywords</label>
												<p class="help-block">Enter the keywords for this page separated by commas.</p>
												<?= form_input(['name' => 'meta_keywords', 'class' => 'form-control', 'value' => $page['meta_keywords'], 'placeholder' => 'META Keywords' ]) ?>
									  		</div>

									  		<div class="form-group">
												<label for="meta_description">META Description</label>
												<p class="help-block">Enter the description for this page.  It's best to keep it between 50 and 100 characters.</p>
												<?= form_input(['name' => 'meta_description', 'class' => 'form-control', 'value' => $page['meta_description'], 'placeholder' => 'META Description']) ?>
									  		</div>

									  		<div class="checkbox">
									    		<input type="checkbox" name="is_home"<?php echo ($page['is_home'] == '1') ? ' checked' : ''; ?>> Homepage
									      		<p class="help-block">Check the box if this page is the homepage. You must choose Pages to be the default controller in Settings.  Any other page currently marked as the homepage will be removed as the homepage.</p>
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
												<p class="help-block">This is the 'slug' shown in the URL of your page. If you change this value, there must be NO spaces between words, instead, used dashes. <br>IE: new-url-title</p>
												<?= form_input(['name' => 'url_title', 'class' => 'form-control', 'value' => $page['url_title'], 'placeholder' => 'URL Title']) ?>
									  		</div>

									  		<div class="form-group">
												<label for="status">Redirection</label>
												<p class="help-block">If you change the URL Title above we automatically set up an HTTP 301 (permanent) redirect for you so the old url_title points to the new page url_title. Here, you can override the default settings.</p>
												<?= form_dropdown('redirection',['none' => 'Do Not Redirect Old URL Title', '301' => 'Permanently Redirect to new URL Title', '302' => 'Temporarily Redirect to new URL Title'] , '301', ['class' => 'form-control', 'placeholder' => 'Redirection']) ?>
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
var simplemde = new SimpleMDE();
</script>
