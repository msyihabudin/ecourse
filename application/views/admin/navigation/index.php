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
                        <p><a class="btn btn-primary" href="<?= site_url('admin/navigation/add_nav') ?>">Add Navigation Item</a></p>

                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#basics" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">All Navigation Items</span></a> </li>
                            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#advanced" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Redirects</span></a> </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content tabcontent-border">
                            <div class="tab-pane active" id="basics" role="tabpanel">
                                <!--p class="m-t-l">Drag and Drop items to reorder the links shown on the front navigation of your site.</p-->
                                <ul class="list-group m-t-l" id="sortable">
                                    <?php foreach ($navs as $nav): ?>
                                        <li class="list-group-item" id="item-<?= $nav->id ?>">
                                            <?= $nav->title ?> 
                                            <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                                            <a href="<?= base_url($nav->url) ?>" target="_blank" class="btn btn-default btn-xs">View</a> 
                                            <a href="<?= base_url('admin/navigation/edit_nav/' . $nav->id) ?>" class="btn btn-default btn-xs">Edit</a> 
                                            <a href="<?= base_url('admin/navigation/remove_nav/' . $nav->id) ?>" class="btn btn-danger btn-xs">Delete</a> 

                                            <!--i class="fa fa-bars pull-right" aria-hidden="true"></i-->
                                        </li>
                                    <?php endforeach ?>
                                </ul>

                                <script>
                                    $('#sortable').sortable({
                                        axis: 'y',
                                        update: function (event, ui) {
                                            var data = $(this).sortable('serialize');
                                            $.ajax({
                                                data: data,
                                                type: 'POST',
                                                url: '<?= base_url("admin/navigation/update_nav_order") ?>'
                                            });
                                        }
                                    });
                                </script>
                            </div>
                            <div class="tab-pane  p-20" id="advanced" role="tabpanel">
                                <p class="m-t-l">The table below shows any redirects for posts &amp; pages on your site. It also includes the type (page or post) and the type of redirect (301 - Permanent or 302 - Temporary). <b>Editing and Removing Redirects should be performed by experienced users</b>.</p>

                                <?php if ( ! $redirects ): ?>
                                <h4 class="text-center">No Redirects Found</h4>
                                <?php else: ?>
                                <table class="table" id="tables">
                                    <thead>
                                        <tr>
                                            <th>From</th>
                                            <th>To</th>
                                            <th>Type</th>
                                            <th>HTTP Redirect Type</th>
                                            <th></th>
                                        </tr>    
                                    </thead>
                                    <tbody>
                                        <?php foreach ($redirects as $redir): ?>
                                        <tr>
                                            <td><?= $redir->old_slug ?></td>
                                            <td><?= $redir->new_slug ?></td>
                                            <td><?= $redir->type ?></td>
                                            <td><?= $redir->code ?></td>
                                            <td class="text-right">
                                                <a href="<?= site_url('admin/navigation/edit_redirect/' . $redir->id) ?>"><i class="fas fa-edit"></i></a>
                                                <a href="<?= site_url('admin/navigation/remove_redirect/' . $redir->id) ?>"><i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        <?php endforeach ?>
                                    </tbody>                                    
                                </table>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $this->load->view('admin/partials/footer.php'); ?>
</div>