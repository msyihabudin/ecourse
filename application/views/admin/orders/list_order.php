<div class="page-wrapper">
     <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title"><?= $title; ?></h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <?= $breadcrumbs; ?>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                    <?php if($this->session->flashdata("messagePr")){ ?>
                        <div class="alert alert-info">      
                          <?= $this->session->flashdata("messagePr"); ?>
                        </div><br>
                    <?php } ?>
                    
                        <div class="table-responsive">
                            <table class="table" id="tables">
                                <thead>
                                    <tr>
                                        <th class="one wide">ID</th>
                                        <th class="two wide">Student</th>
                                        <th class="three wide">Purchased</th>
                                        <th class="four wide">Date</th>
                                        <th class="five wide">Total</th>
                                        <th class="six wide">Status</th>
                                        <th style="width: 43px;">#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    foreach ($orders as $order) { 
                                        if ($order['is_edited'] == 0) {
                                            $bold = 'bold';    
                                        } else {
                                            $bold = '';
                                        }
                                    ?>
                                    <tr style="font-weight: <?= $bold;?>;">
                                        <td><?= $order['order_id']; ?></td>
                                        <td><?= $order['fullname']; ?></td>
                                        <td><?= $order['order_item_name']; ?></td>
                                        <td><?= $order['created_at']; ?></td>
                                        <td><?= $order['total']; ?></td>
                                        <td><?= $order['status']; ?></td>
                                        <td>
                                            <div class="ui icon buttons">
                                                <a href="<?= site_url('admin/orders/view/'.$order['order_id']); ?>" alt="View Order"><i class="fas fa-info-circle"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr></tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>                 
                </div>
            </div>
        </div>
    </div>
    <?php $this->load->view('admin/partials/footer.php'); ?>
</div>