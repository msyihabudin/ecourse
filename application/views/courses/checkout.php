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
            <div class="col-lg-8">
                <?php if($this->session->flashdata("messagePr")){?>
                <div class="alert alert-info">      
                    <?php echo $this->session->flashdata("messagePr")?>
                </div>
                <?php } ?>
                <div class="course_container">
                    <div class="course_title">Checkout</div>
                    <div class="course_info" style="margin-bottom: 20px;">
                    <?php
                    if (!empty($courses)) {
                    ?>
                        <table class="table">
                              <thead>
                                <tr>
                                  <th scope="col">Course Name</th>
                                  <th scope="col">Price</th>
                                  <th scope="col">#</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                foreach ($courses as $value) {
                                ?>
                                <tr>
                                  <td scope="row"><?= $value['course_name']; ?></td>
                                  <td>Rp. <?= $value['price']; ?>,-</td>
                                  <td><a href="<?= base_url('checkout/delete/'.$value['user_item_id'].'/'.$value['user_id']);?>"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
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
                    <?php } else {
                        echo "<div class='alert alert-info'>Still no items in your cart..</div>";
                    } ?>
                    </div>                       
                </div>

            </div>

            <!-- Course Sidebar -->
            <div class="col-lg-4">
                <div class="sidebar">

                    <!-- Feature -->
                    <div class="sidebar_section">
                        <div class="sidebar_section_title">Payment Method</div>
                        <div class="sidebar_feature">
                            <?php
                            if (!empty($courses)) {
                            ?>
                            <!-- Accordions -->
                            <div class="accordions">
                                
                                <div class="elements_accordions">

                                    <div class="accordion_container">
                                        <div class="accordion d-flex flex-row align-items-center"><div>Transfer ATM</div></div>
                                        <div class="accordion_panel">
                                            <p>Transfer ke No. Rekening: <?= $bank['value'];?></p>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <br><br>
                            <form method="post" action="<?= base_url('checkout/proccess/'.$courses[0]['user_id']);?>">
                                <input type="hidden" name="total" value="<?= $total;?>">
                                <button class="btn btn-md btn-primary">Place Order</button>
                            </form>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>