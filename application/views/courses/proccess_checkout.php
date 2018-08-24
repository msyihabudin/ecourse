<link rel="stylesheet" type="text/css" href="<?= base_url("assets/frontend/styles/course.css");?>">
<link rel="stylesheet" type="text/css" href="<?= base_url("assets/frontend/styles/course_responsive.css");?>">

<!-- Home -->

<div class="home">
    <div class="breadcrumbs_container">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="breadcrumbs">
                        <ul>
                            <li><a href="<?= base_url();?>">Home</a></li>
                            <li>Checkout</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>          
</div>

<!-- Course -->

<div class="course">
    <div class="container">
        <div class="row">

            <!-- Course -->
            <div class="col-lg-6 center">
                <div class="course_container">
                    <div class="course_title">Invoice</div>
                    <div class="course_info" style="margin-bottom: 20px;">
                    <?php
                    if (!empty($orders)) {
                    ?>
                        <table class="table">
                          <thead>
                            <tr>
                              <th scope="col">Course Name</th>
                              <th scope="col">Price</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            foreach ($orders as $value) {
                            ?>
                            <tr>
                              <th scope="row"><?= $value['course_name']; ?></th>
                              <td>Rp. <?= $value['price']; ?>,-</td>
                            </tr>
                            <?php 
                            $total += $value['price'];
                            } ?>
                            <tr>
                              <th scope="row" style="text-align: right;"><strong>Total</strong></th>
                              <td>Rp. <?= $total; ?>,-</td>
                            </tr>
                          </tbody>
                        </table>

                        <div class="accordion_container">
                            <div class="accordion d-flex flex-row align-items-center"><div>Transfer ATM</div></div>
                            <div class="accordion_panel">
                                <p><?= $bank['value'];?></p>
                            </div>
                        </div>
                    <?php } else {
                        echo "<div class='alert alert-info'>Your session has expired. Please go to <strong><a href='".base_url('account')."'>your account</a></strong></div>";
                    } ?>

                    </div>                       
                </div>

            </div>
        </div>
    </div>
</div>