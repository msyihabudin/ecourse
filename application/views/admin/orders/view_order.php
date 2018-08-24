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
    		<?php if($this->session->flashdata("messagePr")){ ?>
                <div class="alert alert-info">      
                  <?= $this->session->flashdata("messagePr"); ?>
                </div><br>
            <?php } ?>

			<div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                    	<h4>Order #<?= $orders['order_id'];?></h4>
                    	<?= form_open_multipart('admin/orders/update');?>
                    	<input type="hidden" name="order_id" value="<?= $orders['order_id']?>">
                    	<input type="hidden" name="user_id" value="<?= $orders['user_id'];?>">
                    	<input type="hidden" name="course_id" value="<?= $orders['id_course'];?>">
                        <div class="form-group">
							<label for="title">Order Details</label>
							<p class="help-block">Date</p>
							<?= $orders['created_at']; ?>
				  		</div>

				  		<div class="form-group">
							<p class="help-block">Status</p>
							<?= form_dropdown('status', ['Pending Payment' => 'Pending Payment', 'Processing' => 'Processing', 'Completed' => 'Completed', 'Cancelled' => 'Cancelled', 'Failed' => 'Failed'], $orders['status'], ['class' => 'form-control', 'placeholder' => 'Status']) ?>
				  		</div>

				  		<div class="form-group">
							<p class="help-block">Customer</p>
							<?= $orders['fullname']; ?> (<?= $orders['email']; ?>)
				  		</div>

				  		<div class="form-group">
							<label for="excerpt">Order Items</label>
							<table class="table">
                              <thead>
                                <tr>
                                  <th scope="col">Course Name</th>
                                  <th scope="col">Price</th>
                                  <th scope="col">Amount</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td scope="row"><?= $orders['order_item_name']; ?></td>
                                  <td>Rp. <?= $orders['price']; ?>,-</td>
                                  <td>Rp. <?= $orders['price']; ?>,-</td>
                                </tr>
                                <tr>
                                  <th colspan="2" scope="row" style="text-align: right;"><strong>Total</strong></th>
                                  <td>Rp. <?= $orders['total']; ?>,-</td>
                                </tr>
                              </tbody>
                        	</table>
				  		</div>

				  		<div class="form-group">
							<label for="excerpt">Payment Info</label>
							<?php
							if (!empty($payment)) {
							?>
							<table class="table">
                              <thead>
                                <tr>
                                  <th scope="col">Image</th>
                                  <th scope="col">Account Number</th>
                                  <th scope="col">Account Name</th>
                                  <th scope="col">Ammount Paid</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td scope="row"><img src="<?= $payment['image']; ?>" width="300px"></td>
                                  <td><?= $payment['no_rekening']; ?></td>
                                  <td><?= $payment['atas_nama']; ?></td>
                                  <td>Rp. <?= $payment['jumlah'];?>,-</td>
                                </tr>
                              </tbody>
                        	</table>
                        	<?php } else { ?>
                        		<div class="alert alert-info">      
				                  Pending payment..
				                </div>
                        	<?php }?>
				  		</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h4>Order Actions</h4>

						<div class="form-group">
							<label for="feature_image">Additional Info</label>
							<?= form_textarea(['name' => 'info', 'id' => 'info', 'class' => 'form-control', 'value' => '', 'placeholder' => 'Additional Info']) ?>
				  		</div>

				  		<div class="border-top">
	                        <div class="card-body">
	                            <input class="btn btn-default" type="submit" name="submit" value="Update">
	                        </div>
	                    </div>
				  		<?= form_close();?>
                    </div>
                </div>
            </div>			
		</div>
    </div>
    <?php $this->load->view('admin/partials/footer.php'); ?>
</div>

		
