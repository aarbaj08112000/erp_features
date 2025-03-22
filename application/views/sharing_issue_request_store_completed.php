<?php
// Get the CodeIgniter super object
$CI = &get_instance();

// Load the model
$CI->load->model('SupplierParts');
?>
<div class="wrapper">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Sharing Issue Request - Completed</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
                            <li class="breadcrumb-item active">Assets</li>
                        </ol>
                    </div>

                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div>
                <div class="row">
                    <br>
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <a class="btn btn-info"
                                    href="<?php echo base_url('sharing_issue_request_store') ?>">View Pending Requests</a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sr No</th>
                                            <th>Part Number / Description / Thickness / Weight</th>
                                            <th>Status</th>
                                            <th>Date & Time</th>
                                            <th>Actual Store Stock</th>
                                            <th>Required Qty</th>
                                            <th>Accept Qty</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($sharing_issue_request) {
                                            $i = 1;
                                            foreach ($sharing_issue_request as $u) {
                                                $output_part_data = $this->SupplierParts->getSupplierPartById($u->child_part_id);
                                        ?>

                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $output_part_data[0]->part_number ?> /
                                                <?php echo $output_part_data[0]->part_description ?>/
                                                <?php echo $output_part_data[0]->thickness ?>/
                                                <?php echo $output_part_data[0]->weight ?>
                                            </td>
                                            <td><?php echo $u->status ?></td>
                                            <td><?php echo $u->created_date . " / " . $u->created_time ?></td>
                                            <td>
                                                <?php
                                                            echo $output_part_data[0]->stock;
                                                            ?>
                                            </td>
                                            <td><?php echo $u->qty ?></td>
                                            <td>
                                                <?php
                                                            echo $u->accepted_qty;
                                                            ?>
                                            </td>
                                        </tr>
                                        <?php
                                                    $i++;
                                               
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
               </div><!-- /.container-fluid -->
        </section>
 </div>