<?php
if (isset($this->session->userdata['user_signed_in'])) {
    header(base_url()."account");
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
    <?= form_open('users/auth_signin', 'class="login-form"'); ?>
      <?= form_input(array('type'=> 'text', 'name'=>'email'), '', 'placeholder="Username or Email Address"'); ?>
      <?= form_password('password', '', 'placeholder="Password"'); ?>
      <button name="auth_signin">Login</button>
      <p class="message">Not registered? <?= anchor('signup', 'Create an account'); ?></p>
    <?= form_close(); ?>
  </div>
</div>