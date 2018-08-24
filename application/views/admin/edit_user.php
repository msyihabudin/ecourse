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
                    <form action="<?= site_url('admin/user/add_edit/'.$userData->users_id); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
                        <div class="card-body">                        
                            <div class="form-group row">
                                <label class="col-md-3">Status</label>
                                <div class="col-sm-9">
                                  <select name="status" id="" class="form-control">
                                    <option value="active" <?= (isset($userData->status) && $userData->status == 'active')?'selected':''; ?> >Active</option>            
                                    <option value="inactive" <?= (isset($userData->status) && $userData->status == 'inactive')?'selected':''; ?> >Inactive</option>
                                  </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3">Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" value="<?= isset($userData->name)?$userData->name:'';?>" class="form-control" placeholder="Name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3">Email</label>
                                <div class="col-sm-9">
                                    <input type="text" name="email" value="<?= isset($userData->email)?$userData->email:'';?>" class="form-control" placeholder="Email">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3">User Type</label>
                                <div class="col-sm-9">
                                    <select name="user_type" class="form-control" required>  
                                        <option value="admin" <?= (isset($userData->user_type) && $userData->user_type == 'admin')?'selected':''; ?>>Administrator</option>
                                        <option value="instructor" <?= (isset($userData->user_type) && $userData->user_type == 'instructor')?'selected':''; ?>>Instructor</option>
                                        <option value="author" <?= (isset($userData->user_type) && $userData->user_type == 'author')?'selected':''; ?>>Author</option>
                                        <option value="editor" <?= (isset($userData->user_type) && $userData->user_type == 'editor')?'selected':''; ?>>Editor</option>
                                        <option value="student" <?= (isset($userData->user_type) && $userData->user_type == 'student')?'selected':''; ?>>Student</option>
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
                                    <?= form_upload('profile_pic', '', array('class' => 'form-control')); ?>
                                    <br /><br />
                                    <?php if(isset($userData->profile_pic) && file_exists('assets/image/user/'.$userData->profile_pic)){ 
                                      $profile_pic = $userData->profile_pic;
                                    }else{ 
                                      $profile_pic = 'user.png'; 
                                    } ?>
                                    <left> <img class="thumb-image setpropileam" src="<?php echo base_url();?>/assets/image/user/<?php echo isset($profile_pic)?$profile_pic:'user.png';?>" alt="User profile picture" width="650px;"></left>
                                </div>
                            </div>
                        </div>
                        <input type="hidden"  name="users_id" value="<?php echo isset($userData->users_id)?$userData->users_id:'';?>">
                        <div class="border-top">
                            <div class="card-body">
                              <button type="submit" name="edit" value="edit" class="btn btn-success">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>