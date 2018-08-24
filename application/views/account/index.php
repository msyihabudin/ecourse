<link rel="stylesheet" type="text/css" href="<?= base_url("assets/frontend/styles/course.css");?>">
<link rel="stylesheet" type="text/css" href="<?= base_url("assets/frontend/styles/course_responsive.css");?>">

<div class="home">
    <div class="breadcrumbs_container">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="breadcrumbs">
                        <ul>
                            <li><a href="<?= base_url();?>">Home</a></li>
                            <li><a href="<?= base_url('account');?>">Account</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>          
</div>

<div class="course">
    <div class="container">
        <div class="row">

            <!-- Course -->
            <div class="col-lg-8">
                
                <div class="course_container">
                    <?php if($this->session->flashdata("messagePr")){?>
                        <div class="alert alert-info">      
                            <?php echo $this->session->flashdata("messagePr")?>
                        </div>
                    <?php } ?>
                        
                    <div class="course_title">Account</div>

                    <!-- Course Tabs -->
                    <div class="course_tabs_container">
                        <div class="tabs d-flex flex-row align-items-center justify-content-start">
                            <div class="tab active">my dashboard</div>
                            <div class="tab">order</div>
                            <div class="tab">rewards</div>
                            <div class="tab">profile</div>
                        </div>
                        <div class="tab_panels">

                            <!-- Description -->
                            <div class="tab_panel active">
                                <div class="tab_panel_title">Keep Playing Skills</div>
                                <div class="tab_panel_content">
                                    
                                    <?php foreach($enroll_course as $course) { 
                                    if ($course->enroll_status == TRUE) { ?>
                                    <ul class="dropdowns">
                                        <li class="has_children">
                                            <div class="dropdown_item">
                                                <div class="dropdown_item_title"><a href="<?= $course->enroll_url; ?>"><span>Resume</span> <?= $course->course_name; ?></a></div>
                                                <div class="dropdown_item_text">
                                                    <p><?= $course->description; ?></p>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    <?php } 
                                    } ?>
                                </div>
                                
                                <div class="tab_panel_title">Keep Playing Quest</div>
                                <div class="tab_panel_content">
                                    
                                    <?php foreach($enroll_lesson as $lesson) { 
                                    if ($lesson->enroll_status == TRUE) { ?>
                                    <ul class="dropdowns">
                                        <li class="has_children">
                                            <div class="dropdown_item">
                                                <div class="dropdown_item_title"><a href="<?= $lesson->enroll_url; ?>"><span>Resume</span> <?= $lesson->name; ?></a></div>
                                                <div class="dropdown_item_text">
                                                    <p><?= $course->description; ?></p>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    <?php } 
                                    } ?>
                                </div>

                            </div>

                            <!-- Order -->
                            <div class="tab_panel tab_panel_2">
                                <div class="tab_panel_content">
                                    <div class="tab_panel_title">Your Order</div>
                                    <div class="tab_panel_content">
                                        <?php
                                        if (!empty($orders)) {
                                        ?>
                                            <table class="table">
                                                  <thead>
                                                    <tr>
                                                      <th scope="col">Course Name</th>
                                                      <th scope="col">Price</th>
                                                      <th scope="col">Status</th>
                                                      <th scope="col">Transfer Info</th>
                                                      <th scope="col">#</th>
                                                    </tr>
                                                  </thead>
                                                  <tbody>
                                                    <?php
                                                    foreach ($orders as $value) {
                                                    ?>
                                                    <tr>
                                                      <td scope="row"><?= $value['order_item_name']; ?></td>
                                                      <td>Rp. <?= $value['price']; ?>,-</td>
                                                      <td><?= $value['status']; ?></td>
                                                      <td><?= $bank['value'];?></td>
                                                      <td>
                                                        <?php
                                                        if ($value['status'] == "Pending Payment") {
                                                            $value['price'] = $value['price'];
                                                            echo "<a href='".base_url('confirm/'.$value['order_id'])."''>Confirm Payment</a>";
                                                        }else{
                                                            $value['price'] = 0;
                                                            echo "-";
                                                        }
                                                        ?>                                                        
                                                      </td>
                                                    </tr>
                                                    <?php 
                                                    $total += $value['price'];
                                                    } ?>
                                                    <tr>
                                                      <th colspan="4" scope="row" style="text-align: right;"><strong>Total</strong></th>
                                                      <td>Rp. <?= $total; ?>,-</td>
                                                    </tr>
                                                  </tbody>
                                            </table>
                                        <?php } else {
                                            echo "<div class='alert alert-info'>Still no items in your order..</div>";
                                        } ?>
                                    </div>
                                </div>
                            </div>

                            <!-- Curriculum -->
                            <div class="tab_panel tab_panel_3">
                                <div class="tab_panel_content">
                                    <div class="tab_panel_title">My Badges</div>
                                    <div class="tab_panel_content">
                                        <!-- Recent Badges -->
                                        <div class="ui center aligned container">
                                            <div class="ui three stackable centered cards">
                                                <?php foreach ($badges as $b) { ?>
                                                <div class="raised card">
                                                    <div class="image" style="background: #fff;">
                                                        <img class="ui circular image" src="<?= $b->img; ?>" alt="Badges" />
                                                    </div>
                                                    <div class="content">
                                                        <div class="header"><?= $b->nama_badge; ?></div>
                                                    </div>
                                                </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- My Profile -->
                            <div class="tab_panel tab_panel_4">
                                <div class="tab_panel_content">
                                    <div class="tab_panel_title">My Profile</div>
                                    <div class="tab_panel_content">
                                        
                                        <form method="post" enctype="multipart/form-data" action="<?= base_url().'account/add_edit' ?>" class="form-label-left">
                                            <div class="box-body box-profile">
                                              
                                              <div class="col-md-6">
                                                <h5>Personal Information:</h5>                                                           

                                                <div class="form-group has-feedback clear-both">
                                                  <label for="exampleInputname">Fullname:</label>
                                                  <input type="text" id="fullname" name="fullname" value="<?php echo (isset($account['fullname'])?$account['fullname']:'');?>" required="required" class="form-control" placeholder="Fullname">
                                                  <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                                </div>

                                                <div class="form-group has-feedback clear-both">
                                                  <label for="exampleInputname">Username:</label>
                                                  <input type="text" id="name" name="name" value="<?php echo (isset($account['name'])?$account['name']:'');?>" required="required" class="form-control" placeholder="Name">
                                                  <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                                </div>                      

                                                <div class="form-group has-feedback clear-both">
                                                  <label for="exampleInputemail">Email:</label>
                                                  <input type="text" id="email" name="email" value="<?php echo (isset($account['email'])?$account['email']:'');?>" required="required" class="form-control" placeholder="Email">
                                                  <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                                </div>                                        
                                                <br>
                                                <h5>Change Password:</h5>
                                                <div class="form-group has-feedback">
                                                  <label for="exampleInputEmail1">Current Password:</label>
                                                  <input id="pass11" class="form-control" pattern=".{6,}" type="password" placeholder="********" name="currentpassword" title="6-14 characters">
                                                  <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                                </div>                       
                                                <div class="form-group has-feedback">
                                                  <label for="exampleInputEmail1">New Password:</label>
                                                  <input type="password" class="form-control" placeholder="New Password" name="password">
                                                  <span class="glyphicon glyphicon-pencil form-control-feedback"></span>
                                                </div>                       
                                                <div class="form-group has-feedback">
                                                  <label for="exampleInputEmail1">Confirm New Password:</label>
                                                  <input type="password" class="form-control" placeholder="Confirm New Password" name="confirmPassword">
                                                  <span class="glyphicon glyphicon-pencil form-control-feedback"></span>
                                                </div>  
                                                <br>
                                                <div class="form-group has-feedback sub-btn-wdt" >
                                                  <input type="hidden" name="users_id" value="<?php echo isset($account['users_id'])?$account['users_id']:''; ?>">
                                                  <input type="hidden" name="user_type" value="<?php echo isset($account['user_type'])?$account['user_type']:''; ?>">
                                                  <button name="submit1" type="button" id="profileSubmit" class="btn btn-primary btn-md wdt-bg">Save</button>  
                                                  <!-- <div class=" pull-right">
                                                  </div> -->
                                                </div>
                                              </div>
                                             <!-- /.box-body -->
                                            </div>
                                          </form>


                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Course Sidebar -->
            <div class="col-lg-4">
                <div class="sidebar">

                    <!-- Latest Course -->
                    <div class="sidebar_section">
                        <div class="sidebar_section_title">Recent Badges</div>
                        <div class="sidebar_latest">
                            <?php foreach ($badges as $b) { ?>
                                        
                            <!-- Latest Course -->
                            <div class="latest d-flex flex-row align-items-start justify-content-start">
                                <div class="latest_image"><div><img src="<?= $b->img; ?>" alt=""></div></div>
                            </div>

                            <?php } ?>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>