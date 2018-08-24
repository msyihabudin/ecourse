<?php
if (isset($this->session->userdata['admin_signed_in'])) {
    header("location: ".base_url()."/admin/dashboard");
}
?>

<div class="login-page">
  <div class="form">
    <div class="logo_container">
        <a href="<?= base_url(); ?>">
            <div class="logo_text">E<span>Course</span></div>
        </a>
    </div><br>
    <?php if($this->session->flashdata("messagePr")){?>
    <div class="alert alert-info">      
        <?php echo $this->session->flashdata("messagePr")?>
    </div>
    <?php } ?>
    <br>
    <?= form_open('admin/auth_user', 'class="login-form"'); ?>
      <?= form_input(array('type'=> 'text', 'name'=>'email'), '', 'placeholder="Username or Email" required=""'); ?>
      <?= form_password('password', '', 'placeholder="Password"'); ?>
      <button name="signin">Login</button>
    <?= form_close(); ?>
  </div>
</div>