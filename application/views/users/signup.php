<?php
if (isset($this->session->userdata['user_signed_in'])) {
    header("location: ".base_url()."/account");
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
    <?= form_open('users/auth_signup', 'class="login-form"'); ?>
      <?= form_input('fullname', '', 'placeholder="Full Name"'); ?>
      <?= form_input(array('type'=> 'email', 'name'=>'email'), '', 'placeholder="Email Address"'); ?>
      <?= form_input('name', '', 'placeholder="Username"'); ?>
      <?= form_password('password', '', 'placeholder="Password"'); ?>
      <p style="width: 50px; height: 20px; margin-left: -15px;"><?= form_checkbox('terms', '1', FALSE); ?></p><p class="message" style="float: left; width: 250px; height: 20px; margin: -33px 0 0;">I agree to the ECourse <a href="#">Terms of Use</a></p>

      <button name="submit">create</button>
      <p class="message">Already registered? <?= anchor('signin', 'Sign In'); ?></p>
    <?= form_close(); ?>
  </div>
</div>