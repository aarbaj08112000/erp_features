<div style="width:1700px" class="wrapper">
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
                        <h1>Operation Wise Data</h1>
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
                                            <a class="btn btn-danger" href="<?php echo base_url('view_job_card_details_issued/') . $this->uri->segment('2'); ?>">
                                                < Back</a>

                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <a class="btn btn-success" href="<?php echo base_url('generate_job_card/') . $this->uri->segment('2'); ?>">Download JOB CARD</a>

                                        </div>
                                    </div>
                                    <?Php
                                    // echo $$operations_data_new[0]->id;
                                    $opration_id = $operations_data_new[0]->id;
                                    $opration_data = $this->Crud->get_data_by_id("operations", $opration_id, "id");
                                    $operation_name = $opration_data[0]->name;


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
                                                        // $production_qty = $job_card_prod_qty[0]->production_qty;
                                                    }
                                                    ?>
                                                    <form action="<?php echo base_url('update_job_card_prod'); ?>" method="post">
                                                        <input type="text" required name="req_qty" min="<?php echo $production_qty; ?>" value="<?php echo $production_qty; ?>" class="form-control">
                                                        <input type="hidden" required name="lot_qty" value="<?php echo $job_card[0]->req_qty; ?>" class="form-control">
                                                        <input type="hidden" required name="production_qty_calculated" value="<?php echo $production_qty; ?>" class="form-control">
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
                                    <!-- <div class="col-lg-2">
                                        <div class="form-group">
                                            <?php
                                            if ($job_card[0]->status == "close") {
                                                echo "Job Card Already Close";
                                            } else {

                                            ?>
                                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#changeop">
                                                    Change Operation
                                                </button>
                                            <?php
                                            }
                                            ?>
                                            <br>
                                            <a class="btn btn-dark">
                                                Operation Number : <?php echo $operation_name ?>
                                            </a>





                                        </div>
                                    </div> -->
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
                                            <input type="text" readonly value="<?php echo $main_prod_qty; ?>" class="form-control">
                                        </div>
                                    </div>
                                    <!-- <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Production Qty<span class="text-danger">*</span></label>
                                            <input type="text" readonly value="<?php echo $production_qty; ?>" class="form-control">
                                        </div>
                                    </div> -->
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Job Card Status <span class="text-danger">*</span></label>
                                            <input type="text" readonly value="<?php echo $job_card[0]->status; ?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Operation Number <span class="text-danger">*</span></label>
                                            <input type="text" readonly value="<?php echo $operations_data_new[0]->name; ?>" class="form-control">
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
                                            <th>BOM Qty</th>
                                            <th>REQ Qty</th>
                                            <th>Operaion Number</th>
                                            <th>Accept</th>
                                            <th>Reject</th>
                                            <th>Return </th>
                                            <th>Rejection Remark</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $relese_po = 1;
                                        $jj = 1;

                                        if ($job_card_details_data) {
                                            foreach ($job_card_details_data as $b) {
                                                if (true) {
                                                    $child_part_data = $this->Crud->get_data_by_id("child_part", $b->child_part_id, "id");
                                                    $child_part_master = $this->Crud->get_data_by_id("child_part_master", $child_part_data[0]->part_number, "part_number");
                                                    $array = array(
                                                        "job_card_details_id" => $b->id,
                                                        "operation_id" => $operations_data_new[0]->id,

                                                    );

                                                    $job_card_details_operations_data = $this->Crud->get_data_by_id_multiple_condition("job_card_details_operations", $array);
                                                    // $job_card_details_operations_data = $this->Crud->get_data_by_id("job_card_details_operations", $b->id, "job_card_details_id");
                                                    $status = false;
                                                    $accept_qty;
                                                    $reject_qty;
                                                    $return_qty;
                                                    if ($job_card_details_operations_data) {
                                                        $accept_qty = $job_card_details_operations_data[0]->accept_qty;
                                                        $reject_qty = $job_card_details_operations_data[0]->reject_qty;
                                                        $return_qty = $job_card_details_operations_data[0]->return_qty;
                                                        $status = true;
                                                    }
                                                    // $data['toolList'] = $this->Crud->get_data_by_id("tools", "insert", "type");
                                                    $req_qty = 0;
                                                    $stock =  (int)$child_part_master[0]->stock;
                                                    $req_qty = (int)$job_card[0]->req_qty * $b->bom_qty;
                                                    $production_qty1 = $main_prod_qty * $b->bom_qty;
                                                    // $stock = 3;
                                                    // $req_qty = 1;
                                                    $uom_data = $this->Crud->get_data_by_id("uom", $child_part_master[0]->uom_id, "id");


                                        ?>
                                                    <tr>
                                                        <td><?php echo $jj ?></td>
                                                        <td><?php echo $b->item_number ?></td>
                                                        <td><?php echo $b->item_description ?></td>

                                                        <td><?php echo $b->bom_qty ?></td>
                                                        <td><?php echo $req_qty ?></td>
                                                        <td>
                                                            <?php echo $operation_name ?>

                                                        </td>
                                                        <td>
                                                            <?php
                                                            if ($status == false) {

                                                            ?>
                                                                <form action="<?php echo base_url('update_job_card_details'); ?>" method="post">
                                                                    <input type="text" name="accept_qty" <?php if ($production_qty1 == $req_qty) {
                                                                                                                echo "readonly";
                                                                                                            } ?> min="0" value="<?php echo $production_qty1 ?>" max="<?php echo $production_qty1 ?>" class="form-control" placeholder="Enter Accept Qty">
                                                                    <input type="hidden" name="operation_id" readonly value="<?php echo $operations_data_new[0]->id; ?>" class="form-control">
                                                                    <input type="hidden" name="job_card_details_id" value="<?php echo $b->id; ?>" class="form-control">
                                                                    <input type="hidden" name="req_qty" readonly min="0" value="<?php echo $req_qty ?>" max="<?php echo $production_qty1 ?>" class="form-control" placeholder="Enter Accept Qty">
                                                                    <input type="hidden" readonly value="<?php echo $job_card[0]->id ?>" name="id" class="form-control" placeholder="Enter Accept Qty">

                                                                <?php
                                                            } else {
                                                                echo $accept_qty;
                                                            }
                                                                ?>


                                                        </td>
                                                        <td>
                                                            <?php
                                                            if ($status == false) {

                                                            ?>
                                                                <input type="text" min="0" <?php if ($production_qty1 == $req_qty) {
                                                                                                echo "readonly";
                                                                                            } ?> value="0" name="reject_qty" required max="<?php echo $production_qty1 ?>" class="form-control" placeholder="Enter Return Qty">

                                                            <?php
                                                            } else {
                                                                echo $reject_qty;
                                                            }
                                                            ?>

                                                        </td>
                                                        <td>
                                                            <?php
                                                            if ($status == false) {
                                                                echo "Enter Reject Qty First";
                                                            ?>
                                                                <!-- <input type="text" min="0" max="<?php echo $production_qty1 ?>" class="form-control" placeholder="Enter Return Qty"> -->

                                                            <?php
                                                            } else {
                                                                echo $return_qty;
                                                            }
                                                            ?>

                                                        </td>
                                                        <td>
                                                            <?php
                                                            if ($status == false) {
                                                                // echo "Enter Reject Qty First";
                                                            ?>
                                                                <select multiple name="rejection_remark[]" required id="" class="form-control select2">
                                                                    <option value="na">NA</option>
                                                                    <?php
                                                                    if ($reject_remark) {
                                                                        foreach ($reject_remark as $r) {
                                                                    ?>
                                                                            <option value="<?php echo $r->name ?>"><?php echo $r->name ?></option>
                                                                    <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                </select>

                                                            <?php
                                                            } else {
                                                                // echo $return_qty;
                                                            }
                                                            ?>

                                                        </td>
                                                        <td>
                                                            <?php
                                                            if ($status == false) {

                                                            ?>
                                                                <button type="submit" class="btn btn-info">Submit</button>
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
                                            <th colspan="10"></th>
                                            <th>
                                                <?php
                                                if ($relese_po != $jj) {
                                                    echo "Please Add All Reject Qty To Close JOB CARD";
                                                } else {

                                                    if ($job_card[0]->status == "close") {
                                                        echo "Job Card Already Close";
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
                            <div class="card-header">
                                <h3 class="card-title">
                                    All Data
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
                                            <th>BOM Qty</th>
                                            <th>REQ Qty</th>
                                            <th>Operaion Number</th>
                                            <th>Accept</th>
                                            <th>Reject</th>
                                            <th>Return </th>
                                            <!-- <th>Action</th> -->

                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $relese_po = 1;
                                        $jj = 1;

                                        if ($job_card_details_operations) {
                                            foreach ($job_card_details_operations as $b) {
                                                if (true) {
                                                    $job_card_details = $this->Crud->get_data_by_id("job_card_details", $b->job_card_details_id, "id");
                                                    $child_part_data = $this->Crud->get_data_by_id("child_part", $job_card_details[0]->child_part_id, "id");
                                                    $child_part_master = $this->Crud->get_data_by_id("child_part_master", $child_part_data[0]->part_number, "part_number");
                                                    $operations = $this->Crud->get_data_by_id("operations", $b->operation_id, "id");
                                                    // $array = array(
                                                    //     "job_card_details_id" => $b->id,
                                                    //     "operation_id" => $job_card[0]->operation_id,

                                                    // );

                                                    // $job_card_details_operations_data = $this->Crud->get_data_by_id_multiple_condition("job_card_details_operations", $array);
                                                    // $job_card_details_operations_data = $this->Crud->get_data_by_id("job_card_details_operations", $b->id, "job_card_details_id");
                                                    // $status = false;
                                                    // $accept_qty;
                                                    // $reject_qty;
                                                    // $return_qty;
                                                    // if ($job_card_details_operations_data) {
                                                    //     $accept_qty = $job_card_details_operations_data[0]->accept_qty;
                                                    //     $reject_qty = $job_card_details_operations_data[0]->reject_qty;
                                                    //     $return_qty = $job_card_details_operations_data[0]->return_qty;
                                                    //     $status = true;
                                                    // }
                                                    // $data['toolList'] = $this->Crud->get_data_by_id("tools", "insert", "type");
                                                    $req_qty = 0;
                                                    $stock =  (int)$child_part_master[0]->stock;
                                                    $req_qty = (int)$job_card[0]->req_qty * $job_card_details[0]->bom_qty;
                                                    $production_qty1 = $main_prod_qty * $job_card_details[0]->bom_qty;
                                                    $accept_qty = $b->accept_qty;
                                                    $reject_qty = $b->reject_qty;
                                                    $return_qty = $b->return_qty;
                                                    // $stock = 3;
                                                    // $req_qty = 1;
                                                    if ($b->operation_id != $operations_data_new[0]->id) {

                                        ?>
                                                        <tr>
                                                            <td><?php echo $jj ?></td>
                                                            <td><?php echo $job_card_details[0]->item_number ?></td>
                                                            <td><?php echo $job_card_details[0]->item_description ?></td>

                                                            <td><?php echo $job_card_details[0]->bom_qty ?></td>
                                                            <td><?php echo $req_qty ?></td>
                                                            <td>
                                                                <?php echo $operations[0]->name ?>

                                                            </td>
                                                            <td>

                                                                <?php

                                                                echo $accept_qty;

                                                                ?>


                                                            </td>
                                                            <td>
                                                                <?php

                                                                echo $reject_qty;

                                                                ?>

                                                            </td>
                                                            <td>
                                                                <?php

                                                                echo $return_qty;

                                                                ?>


                                                            </td>







                                                        </tr>

                                        <?php
                                                        $jj++;
                                                    }
                                                }
                                            }
                                        }
                                        ?>
                                    </tbody>






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

    <div class="modal fade" id="changeop" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Operation Number </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="">Update Operation <span class="text-danger">*</span> </label>

                    <form action="<?php echo base_url('update_job_card_operation'); ?>" method="post">
                        <select class="form-control" name="operation_id" required id="">
                            <?php
                            if ($operations_new) {
                                foreach ($operations_new as $o) {
                                    if ($o->operation_id != $operations_data_new[0]->id) {
                                        $opration_data = $this->Crud->get_data_by_id("operations", $o->operation_id, "id");

                            ?>
                                        <option value="<?php echo $o->operation_id; ?>"><?php echo $opration_data[0]->name; ?></option>
                            <?php
                                    }
                                }
                            }
                            ?>

                        </select>
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