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
                    <form action="<?= site_url('admin/user/add_edit'); ?>" enctype="multipart/form-data" method="post" class="form-horizontal">
                        <div class="card-body">                        
                            <div class="form-group row">
                                <label class="col-md-3">Status</label>
                                <div class="col-sm-9">
                                  <select name="status" id="" class="form-control">
                                    <option value="active">Active</option>            
                                    <option value="deleted">Deleted</option>
                                  </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3">Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" class="form-control" placeholder="Name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3">Email</label>
                                <div class="col-sm-9">
                                    <input type="text" name="email" class="form-control" placeholder="Email">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3">User Type</label>
                                <div class="col-sm-9">
                                    <?php $u_type = isset($userData->user_type)?$userData->user_type:'';
                                      $user_type = getAllDataByTable('permission');
                                    ?>
                                    <select name="user_type" class="form-control" required>  
                                    <?php foreach($user_type as $option){  $sel='';if(strtolower($option->user_type)==strtolower($u_type)){$sel="selected";}  
                                      if(strtolower($option->user_type) != 'admin'){
                                    ?>
                                      <option  value="<?php echo $option->user_type;?>" <?php echo $sel; ?> ><?php echo ucfirst($option->user_type);?> </option>

                                    <?php } }?>                   
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3">Password</label>
                                <div class="col-sm-9">
                                    <input type="Password" name="password" class="form-control" value="" placeholder="Password" readonly onfocus="this.removeAttribute('readonly')">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3">Image Upload</label>
                                <div class="col-sm-9 pic_size" id="image-holder">
                                    <div class="custom-file">
                                        <input id="fileUpload" class="upload custom-file-input" name="profile_pic" type="file" accept="image/*" /><br />
                                        <input type="hidden" name="fileOld" value="<?php echo isset($user_data[0]->profile_pic)?$user_data[0]->profile_pic:'';?>" />
                                        <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                                        <div class="invalid-feedback">Example invalid custom file feedback</div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>                    
                        <div class="border-top">
                            <div class="card-body">
                                <button type="submit" name="submit" value="add" class="btn btn-primary">Add</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>