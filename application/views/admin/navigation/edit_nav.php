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
				<?= form_open(current_url());?>
                <div class="card">
                    <div class="card-body">
                    	<div class="form-group">
							<label for="title">Title</label>
							<p class="help-block">This is the text shown in the navigation bar that visitors see and click.</p>
							<?= form_input(['name' => 'title', 'class' => 'form-control', 'value' => (set_value('title')) ? set_value('title') : $nav['title'], 'placeholder' => 'Title' ]) ?>
				  		</div>

				  		<div class="form-group">
							<label for="description">Description</label>
							<p class="help-block">This is the description of this link and it used for the title field. Visitors see this when hovering the mouse over the link text.</p>
							<?= form_input(['name' => 'description', 'class' => 'form-control', 'value' => (set_value('description')) ? set_value('description') : $nav['description'], 'placeholder' => 'Description' ]) ?>
				  		</div>                    	
                    </div>
                </div>
        		<div class="border-top">
                    <div class="card-body">
                        <input class="btn btn-default" type="submit" value="Save Navigation Item">
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
							<?= form_dropdown('page', $page_slugs, $nav['url'], 'class="form-control"'); ?>
				  		</div>	

				  		<div class="form-group">
							<label for="post">Choose A Blog Post</label>
							<p class="help-block">Choose from existing blog posts.</p>
							<?= form_dropdown('post', $post_slugs, $nav['url'], 'class="form-control"'); ?>
				  		</div>	
						<!-- Developers, uncomment to use manual uri entry-->	
						<div class="form-group">
							<label for="url">URI</label>
							<p class="help-block">This is the URI portion of your link. We automatically add your site's URL for you when generating links.</p>
							<?= form_input(['name' => 'url', 'class' => 'form-control', 'value' => set_value('url'), 'placeholder' => 'about   <-- example usage' ]) ?>
				  		</div>
				  		
				  		<h4>Optional</h4>
							
				  		<div class="form-group">
							<label for="status">Redirection</label>
							<p class="help-block">If you changed the 'Choose A Page' or 'Choose A Post' field we automatically set up an HTTP 301 (perminent) redirect for you so the old URI points to the new page URI. Here, you can override the default settings.</p>
							<?= form_dropdown('redirection',['none' => 'Do Not Redirect Old URL Title', '301' => 'Permanently Redirect to new URL Title', '302' => 'Temporarily Redirect to new URL Title'] , '301', ['class' => 'form-control', 'placeholder' => 'Redirection']) ?>
				  		</div>

				  		<div class="form-group">
							<label for="status">Type</label>
							<p class="help-block">If you changed the 'Choose A Page' or 'Choose A Post', please choose if this navigation item points to a page or a post. We need this to correctly point the redirection.</p>
							<?= form_dropdown('type',['page' => 'This is a Page', 'post' => 'This is a Blog Post'] , 'page', ['class' => 'form-control', 'placeholder' => 'Type']) ?>
				  		</div>
                    </div>
            	</div>
            	<?= form_close();?>
            </div>
        </div>
    </div>
    <?php $this->load->view('admin/partials/footer.php'); ?>
</div>