<link rel="stylesheet" type="text/css" href="<?= base_url("assets/frontend/styles/contact.css");?>">
<link rel="stylesheet" type="text/css" href="<?= base_url("assets/frontend/styles/contact_responsive.css");?>">
	
<!-- Home -->

<div class="home">
	<div class="breadcrumbs_container">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="breadcrumbs">
						<ul>
							<li><a href="<?= base_url();?>">Home</a></li>
							<li>Contact</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>			
</div>

<!-- Contact -->

<div class="contact">

	<!-- Contact Info -->

	<div class="contact_info_container">
		<div class="container">
			<?php if(!empty($this->session->flashdata('msg'))){ ?>
	            <div class="alert alert-success">
	                <?php echo $this->session->flashdata('msg'); ?>
	            </div>        
	        <?php } ?>
	        <?php if(validation_errors()) { ?>
	          <div class="alert alert-danger">
	            <?php echo validation_errors(); ?>
	          </div>
	        <?php } ?>
			<div class="row">				
				<!-- Contact Form -->
				<div class="col-lg-6">
					<div class="contact_form">
						<div class="contact_info_title">Contact Form</div>
						<form action="<?= base_url('main/send');?>" method="POST" class="comment_form">
							<div>
								<div class="form_title">Name</div>
								<input type="text" name="name" class="comment_input" required="required">
							</div>
							<div>
								<div class="form_title">Email</div>
								<input type="text" name="email" class="comment_input" required="required">
							</div>
							<div>
								<div class="form_title">Message</div>
								<textarea name="comment" class="comment_input comment_textarea" required="required"></textarea>
							</div>
							<div>
								<button type="submit" class="comment_button trans_200">submit now</button>
							</div>
						</form>
					</div>
				</div>

				<!-- Contact Info -->
				<div class="col-lg-6">
					<div class="contact_info">
						<div class="contact_info_title">Contact Info</div>
						<div class="contact_info_location">
							<div class="contact_info_location_title">Our Office</div>
							<ul class="location_list">
								<li>Jakarta, Indonesia</li>
								<li>021-12121212</li>
								<li>info@ecourse.com</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyCIwF204lFZg1y4kPSIhKaHEXMLYxxuMhA"></script>
<script src="<?= base_url("assets/frontend/plugins/marker_with_label/marker_with_label.js");?>"></script>
<script src="<?= base_url("assets/frontend/js/contact.js");?>"></script>
