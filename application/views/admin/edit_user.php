<div class="page-wrapper">
     <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title"><?= $title; ?></h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form action="<?= site_url('admin/user/add_edit/'.$userData->users_id); ?>" method="post" class="form-horizontal">
                        <div class="card-body">                        
                            <div class="form-group row">
                                <label class="col-md-3">Status</label>
                                <div class="col-sm-9">
                                  <select name="status" id="" class="form-control">
                                    <option value="active" <?php echo (isset($userData->status) && $userData->status == 'active')?'selected':''; ?> >Active</option>            
                                    <option value="deleted" <?php echo (isset($userData->status) && $userData->status == 'deleted')?'selected':''; ?> >Deleted</option>
                                  </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3">Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" value="<?php echo isset($userData->name)?$userData->name:'';?>" class="form-control" placeholder="Name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3">Email</label>
                                <div class="col-sm-9">
                                    <input type="text" name="email" value="<?php echo isset($userData->email)?$userData->email:'';?>" class="form-control" placeholder="Email">
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

                            <?php if(isset($userData)){ ?>
                            <div class="form-group row">
                                <label class="col-md-3">Current Password</label>
                                <div class="col-sm-9">
                                    <input type="text" style="display: none">
                                    <input type="Password" name="currentpassword" class="form-control" value="" placeholder="Password">
                                </div>
                            </div>
                            <?php }
                            else { ?>
                            <div class="form-group row">
                                <label class="col-md-3">Password</label>
                                <div class="col-sm-9">
                                    <input type="Password" name="password" class="form-control" value="" placeholder="Password" readonly onfocus="this.removeAttribute('readonly')">
                                </div>
                            </div>
                            <?php } if(isset($userData)){ ?>
                            <div class="form-group row">
                                <label class="col-md-3">New Password</label>
                                <div class="col-sm-9">
                                    <input type="Password" name="password" class="form-control" value="" placeholder="Password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3">Confirm Password</label>
                                <div class="col-sm-9">
                                    <input type="Password" name="confirmPassword" class="form-control" value="" placeholder="Password">
                                </div>
                            </div>
                            <?php } ?>
                            <div class="form-group row">
                                <label class="col-md-3">Image Upload</label>
                                <div class="col-sm-9 pic_size" id="image-holder">
                                    <div class="fileUpload btn btn-success wdt-bg">
                                        <span>Change Picture</span>
                                        <input id="fileUpload" class="upload" name="profile_pic" type="file" accept="image/*" /><br />
                                        <input type="hidden" name="fileOld" value="<?php echo isset($user_data[0]->profile_pic)?$user_data[0]->profile_pic:'';?>" />
                                    </div><br /><br />
                                    <?php if(isset($userData->profile_pic) && file_exists('assets/image/user/'.$userData->profile_pic)){ 
                                      $profile_pic = $userData->profile_pic;
                                    }else{ 
                                      $profile_pic = 'user.png'; 
                                    } ?>
                                    <left> <img class="thumb-image setpropileam" src="<?php echo base_url();?>/assets/image/user/<?php echo isset($profile_pic)?$profile_pic:'user.png';?>" alt="User profile picture"></left>
                                </div>
                            </div>
                        </div>
                        <?php if(!empty($userData->users_id)){?>
                        <input type="hidden"  name="users_id" value="<?php echo isset($userData->users_id)?$userData->users_id:'';?>">
                        <input type="hidden" name="fileOld" value="<?php echo isset($userData->profile_pic)?$userData->profile_pic:'';?>">
                        <div class="border-top">
                            <div class="card-body">
                              <button type="submit" name="edit" value="edit" class="btn btn-success">Update</button>
                            </div>
                        </div>
                                  <!-- /.box-body -->
                        <?php }else{ ?>                        
                        <div class="border-top">
                            <div class="card-body">
                                <button type="submit" name="submit" value="add" class="btn btn-primary">Add</button>
                            </div>
                        </div>
                        <?php }?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>