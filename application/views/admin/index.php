<?php
if (isset($this->session->userdata['admin_signed_in'])) {
    header("location: ".base_url()."/admin/dashboard");
}
?>

<div class="auth-wrapper d-flex no-block justify-content-center align-items-center bg-dark">
    <div class="auth-box bg-dark border-top border-secondary">
        <div id="loginform">
            <div class="text-center p-t-20 p-b-20">
                <span class="db"><h1 style="color: #fff;">Sign in to your Administrator</h1></span>
            </div>
            <?php if($this->session->flashdata("messagePr")){?>
            <div class="alert alert-info">      
                <?php echo $this->session->flashdata("messagePr")?>
            </div>
            <?php } ?>
            <!-- Form -->
            <?= form_open('admin/auth_user', 'class="form-horizontal m-t-20" id="loginform"'); ?>
                <div class="row p-b-30">
                    <div class="col-12">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-success text-white" id="basic-addon1"><i class="ti-user"></i></span>
                            </div>
                            <?= form_input(array('type'=> 'text', 'name'=>'email'), '', 'class="form-control form-control-lg" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" required=""'); ?>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-warning text-white" id="basic-addon2"><i class="ti-pencil"></i></span>
                            </div>
                            <?= form_password('password', '', 'class="form-control form-control-lg" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1" required=""'); ?>
                        </div>
                    </div>
                </div>
                <div class="row border-top border-secondary">
                    <div class="col-12">
                        <div class="form-group">
                            <div class="p-t-20">
                                <button class="btn btn-info" id="to-recover" type="button"><i class="fa fa-lock m-r-5"></i> Lost password?</button>
                                <?= form_submit('signin', 'Sign In', 'class="btn btn-success float-right"'); ?>
                                <!--button class="btn btn-success float-right" type="submit">Login</button-->
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div id="recoverform">
            <div class="text-center">
                <span class="text-white">Enter your e-mail address below and we will send you instructions how to recover a password.</span>
                <div class="callout callout-success">
                    <h5 style='color:red;' class="fa fa-close">  <?php echo $this->session->flashdata('forgotpassword'); ?></h5>
                </div>
            </div>
            <div class="row m-t-20">
                <!-- Form -->
                <?= form_open('admin/forgetpassword', 'class="col-12"'); ?>
                    <!-- email -->
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-danger text-white" id="basic-addon1"><i class="ti-email"></i></span>
                        </div>
                        <input type="text" class="form-control form-control-lg" placeholder="Email Address" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                    <!-- pwd -->
                    <div class="row m-t-20 p-t-20 border-top border-secondary">
                        <div class="col-12">
                            <a class="btn btn-success" href="#" id="to-login" name="action">Back To Login</a>
                            <button class="btn btn-info float-right" type="button" name="action">Recover</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>