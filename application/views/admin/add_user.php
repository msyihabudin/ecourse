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
                                  <select name="status" class="form-control" required>
                                    <option value="active">Active</option>            
                                    <option value="inactive">Inactive</option>
                                  </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3">Fullname</label>
                                <div class="col-sm-9">
                                    <input type="text" name="fullname" class="form-control" placeholder="Fullname" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3">Username</label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" class="form-control" placeholder="Username" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3">Email</label>
                                <div class="col-sm-9">
                                    <input type="text" name="email" class="form-control" placeholder="Email" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3">User Type</label>
                                <div class="col-sm-9">
                                    <select name="user_type" class="form-control" required>  
                                        <option value="admin">Administrator</option>
                                        <option value="instructor">Instructor</option>
                                        <option value="author">Author</option>
                                        <option value="editor">Editor</option>
                                        <option value="student">Student</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3">Password</label>
                                <div class="col-sm-9">
                                    <input type="Password" name="password" class="form-control" value="" placeholder="Password" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3">Confirm Password</label>
                                <div class="col-sm-9">
                                    <input type="Password" name="confirmpassword" class="form-control" value="" placeholder="Confirm Password" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3">Image Upload</label>
                                <div class="col-sm-9">
                                    <?= form_upload('profile_pic', '', array('class' => 'form-control')); ?>                                  
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