<?php
 // Get the CodeIgniter super object
$CI =& get_instance();
        
// Load the model
$CI->load->model('SupplierParts');
?>

<div class="wrapper">
    <!-- Navbar -->

    <!-- /.navbar -->

    <!-- Main Sidebar Container -->


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>JOB CARD Details Closed</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                            <li class="breadcrumb-item active">Job Card Details</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <!-- /.card -->

                        <div class="card">
                            <div class="card-header">
                                <!-- <h3 class="card-title">
                                </h3> -->

                                <br>
                                <div class="row">
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <a class="btn btn-danger" href="<?php echo base_url('generate_job_card/') . $this->uri->segment('2'); ?>">Download JOB CARD</a>

                                        </div>
                                    </div>
                                    <?Php
                                    if ($job_card[0]->status == "pending") {


                                    ?>
                                        <div class="col-lg-2">
                                            <div class="form-group">

                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                                    Update Lot Qty
                                                </button>


                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Update </h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <label for="">Update Lot Qty <span class="text-danger">*</span> </label>
                                                                <form action="<?php echo base_url('update_job_card'); ?>" method="post">
                                                                    <input type="text" required name="req_qty" value="<?php echo $job_card[0]->req_qty; ?>" class="form-control">
                                                                    <input type="hidden" required name="id" value="<?php echo $job_card[0]->id; ?>" class="form-control">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <!-- <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal2">
                                                Update Production Qty
                                            </button> -->
                                            <a class="btn btn-dark" href="<?php echo base_url('view_job_card_prod_qty_by_id/') . $job_card[0]->id; ?>">
                                                <i class="fa fa-eye"></i>
                                            </a>



                                            <!-- Modal -->

                                            <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Update Prod Qty </h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <label for="">Update Production Qty <span class="text-danger">*</span> </label>
                                                            <?php
                                                            $production_qty = 0;
                                                            if ($job_card_prod_qty) {

                                                                foreach ($job_card_prod_qty as $p) {
                                                                    $production_qty = $production_qty + $p->production_qty;
                                                                }
                                                                $production_qty = $job_card_prod_qty[0]->production_qty;
                                                            }
                                                            ?>
                                                            <form action="<?php echo base_url('update_job_card_prod'); ?>" method="post">
                                                                <input type="text" required name="req_qty" min="<?php echo $production_qty; ?>" value="<?php echo $production_qty; ?>" class="form-control">
                                                                <input type="hidden" required name="id" value="<?php echo $job_card[0]->id; ?>" class="form-control">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Job Card Number <span class="text-danger">*</span></label>
                                            <input type="text" readonly value="<?php echo "TH/" . $customer_part_data[0]->part_family . "/0000" . $job_card[0]->id; ?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Customer <span class="text-danger">*</span></label>
                                            <input type="text" readonly value="<?php echo $customer_data[0]->customer_name; ?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Part No <span class="text-danger">*</span></label>
                                            <input type="text" readonly value="<?php echo $customer_part_data[0]->part_number; ?>" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Part Description <span class="text-danger">*</span></label>
                                            <input type="text" readonly value="<?php echo $customer_part_data[0]->part_description; ?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Job Card /Lot Qty <span class="text-danger">*</span></label>
                                            <input type="text" readonly value="<?php echo $job_card[0]->req_qty; ?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Production Qty<span class="text-danger">*</span></label>
                                            <input type="text" readonly value="<?php echo $customer_data[0]->fg_stock; ?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Job Card Status <span class="text-danger">*</span></label>
                                            <input type="text" readonly value="<?php echo $job_card[0]->status; ?>" class="form-control">
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <div class="card-header">
                                <h3 class="card-title">
                                    Bill Of Material
                                </h3>



                            </div>

                            <div class="card-body">
                                <table id="" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Item Number</th>
                                            <th>Item Description</th>
                                            <!-- <th>Store Location</th> -->
                                            <!-- <th>BOM Qty</th> -->
                                            <!-- <th>REQ Qty</th> -->
                                            <th>Accept</th>
                                            <th>Reject</th>
                                            <th>Return </th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Item Number</th>
                                            <th>Item Description</th>
                                            <!-- <th>Store Location</th>
                                            <th>BOM Qty</th>
                                            <th>REQ Qty</th> -->
                                            <th>Accept</th>
                                            <th>Reject</th>
                                            <th>Return </th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        $relese_po = 1;
                                        $jj = 1;

                                        if ($job_card_details_data) {
                                            foreach ($job_card_details_data as $b) {
                                                if (true) {
                                                    $job_card_details_operations = $this->Crud->get_data_by_id("job_card_details_operations", $b->id, "job_card_details_id");
                                                    $accept_qty = 0;
                                                    $return_qty = 0;
                                                    $reject_qty = 0;

                                                    if ($job_card_details_operations) {
                                                        foreach ($job_card_details_operations as $jcd) {
                                                            $accept_qty = $accept_qty + $jcd->accept_qty;
                                                            $return_qty = $return_qty + $jcd->return_qty;
                                                            $reject_qty = $reject_qty + $jcd->reject_qty;
                                                        }
                                                    }
                                                    $child_part_master = $this->SupplierParts->getSupplierPartById($b->child_part_id);
                                                    $req_qty = 0;
                                                    $stock =  (int)$child_part_master[0]->stock;
                                                    $req_qty = (int)$job_card[0]->req_qty * $b->bom_qty;
                                                    $production_qty1 = $production_qty * $b->bom_qty;
                                                    // $stock = 3;
                                                    // $req_qty = 1;

                                        ?>
                                                    <tr>
                                                        <td><?php echo $jj ?></td>
                                                        <td><?php echo $b->item_number ?></td>
                                                        <td><?php echo $b->item_description ?></td>

                                                        <td>
                                                            <?php
                                                            if ($b->store_reject_qty == "") {

                                                            ?>
                                                                <form action="<?php echo base_url('update_job_card_details_closed'); ?>" method="post">
                                                                    <input type="text" name="accept_qty" readonly min="0" value="<?php echo $accept_qty ?>" max="<?php echo $b->accept_qty ?>" class="form-control" placeholder="Enter Accept Qty">
                                                                    <input type="hidden" readonly value="<?php echo $b->id ?>" name="id" class="form-control" placeholder="Enter Accept Qty">
                                                                    <input type="hidden" readonly value="<?php echo $b->item_number ?>" name="item_number" class="form-control" placeholder="Enter Accept Qty">

                                                                <?php
                                                            } else {
                                                                echo $b->accept_qty;
                                                            }
                                                                ?>


                                                        </td>
                                                        <td>
                                                            <?php
                                                            if ($b->store_reject_qty == "") {

                                                            ?>
                                                                <input type="text" min="0" value="<?php echo $reject_qty ?>" name="reject_qty" required max="<?php echo $production_qty1 ?>" class="form-control" placeholder="Enter Return Qty">

                                                            <?php
                                                            } else {
                                                                echo $b->store_reject_qty;
                                                            }
                                                            ?>

                                                        </td>
                                                        <td>
                                                            <?php
                                                            if ($b->store_reject_qty == "") {
                                                            ?>
                                                                <input type="text" min="0" value="<?php echo $return_qty ?>" name="return_qty" required max="<?php echo $production_qty1 ?>" class="form-control" placeholder="Enter Return Qty">

                                                                <?php
                                                                ?>
                                                                <!-- <input type="text" min="0" max="<?php echo $production_qty1 ?>" class="form-control" placeholder="Enter Return Qty"> -->

                                                            <?php
                                                            } else {
                                                                echo $b->store_return_qty;
                                                            }
                                                            ?>

                                                        </td>
                                                        <td>
                                                            <?php
                                                            if ($b->store_reject_qty == "") {

                                                            ?>
                                                                <button type="submit" class="btn btn-danger">Submit</button>
                                                                </form>
                                                                <!-- <input type="text" min="0" max="<?php echo $production_qty1 ?>" class="form-control" placeholder="Enter Return Qty"> -->

                                                            <?php
                                                            } else {
                                                                $relese_po++;
                                                                echo "Submitted";
                                                                // echo $b->return_qty;
                                                            }
                                                            ?>


                                                        </td>






                                                    </tr>

                                        <?php
                                                    $jj++;
                                                }
                                            }
                                        }
                                        ?>
                                    </tbody>

                                    <tfoot>
                                        <tr>
                                            <th colspan="6"></th>
                                            <th>
                                                <?php
                                                if ($relese_po != $jj) {
                                                    echo "Please Add All Reject Qty To Update Stock";
                                                } else {

                                                    if ($job_card[0]->status == "close") {
                                                        //   echo "Job Card Already Close";
                                                    } else {


                                                ?>

                                                        <!-- <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#releaseJobCardclose">
                                                            Close Job Card
                                                        </button> -->
                                                <?php
                                                    }
                                                }



                                                ?>


                                                <div class="modal fade" id="releaseJobCardclose" tabindex="-1" role="dialog" aria-labelledby="releaseJobCard" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Close </h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">

                                                                <label for="">Are You Sure Want To Close Job Card ? <span class="text-danger">*</span> </label>
                                                                <form action="<?php echo base_url('update_job_card_status_close'); ?>" method="post">
                                                                    <input type="hidden" required name="id" value="<?php echo $job_card[0]->id; ?>" class="form-control">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </th>
                                        </tr>
                                    </tfoot>





                                </table>
                            </div>

                        </div>

                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->