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
                    <div class="course_title">Confirm Payment</div>
                    <div class="course_info" style="margin-bottom: 20px;">
                        <form method="post" enctype="multipart/form-data" action="<?= site_url('confirm/save'); ?>" class="form-label-left">
                            <div class="box-body box-profile">
                              
                              <div class="col-md-6">                                                         

                                <div class="form-group has-feedback clear-both">
                                  <label for="exampleInputname">Nomor Rekening:</label>
                                  <input type="text" id="norek" name="norek" required="required" class="form-control" placeholder="Nomor Rekening">
                                  <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                </div>

                                <div class="form-group has-feedback clear-both">
                                  <label for="exampleInputname">Atas Nama:</label>
                                  <input type="text" id="atasnama" name="atasnama" required="required" class="form-control" placeholder="Atas Nama">
                                  <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                </div>                      

                                <div class="form-group has-feedback clear-both">
                                  <label for="exampleInputemail">Jumlah Pembayaran:</label>
                                  <input type="text" id="jumlah" name="jumlah" required="required" class="form-control" placeholder="Jumlah Pembayaran">
                                  <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                </div>
                                <div class="form-group has-feedback clear-both">
                                  <label for="exampleInputname">Bukti Pembayaran:</label>
                                  <input type="file" id="image" name="image" required="required" class="form-control" placeholder="Bukti Pembayaran">
                                  <span class="glyphicon glyphicon-user form-control-feedback">*Lampirkan foto/scan bukti pembayaran</span>
                                </div>
                                <br>
                                <div class="form-group has-feedback sub-btn-wdt">
                                  <input type="hidden" name="order_id" value="<?= $orders['order_id'];?>">
                                  <input type="submit" name="submit1" value="Save" class="btn btn-primary btn-md wdt-bg">
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