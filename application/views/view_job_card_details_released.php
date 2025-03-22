<?php
 // Get the CodeIgniter super object
$CI =& get_instance();
        
// Load the model
$CI->load->model('SupplierParts');
?>

<div style="width:2000px" class="wrapper">
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
                        <h1>JOB CARD Details</h1>
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
                                            <label for="">Lot Qty <span class="text-danger">*</span></label>
                                            <input type="text" readonly value="<?php echo $job_card[0]->req_qty; ?>" class="form-control">
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
                                            <th>Store Location</th>
                                            <th>BOM Qty</th>
                                            <th>REQ Qty</th>
                                            <th>Stock</th>

                                            <th>UOM</th>
                                            <th>GRN NO </th>
                                            <th>HOSE Make/Mfg.Date </th>


                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Item Number</th>
                                            <th>Item Description</th>
                                            <th>Store Location</th>
                                            <th>BOM Qty</th>
                                            <th>REQ Qty</th>
                                            <th>Stock</th>

                                            <th>UOM</th>
                                            <th>GRN NO </th>
                                            <th>HOSE Make/Mfg.Date </th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        $relese_po = 1;
                                        $jj = 1;

                                        if ($bom_data) {
                                            foreach ($bom_data as $b) {
                                                if (true) {
                                                    $child_part_data = $this->SupplierParts->getSupplierPartById($b->child_part_id);
                                                    $child_part_master = $this->Crud->get_data_by_id("child_part_master", $child_part_data[0]->part_number, "part_number");
                                                    $req_qty = 0;
                                                    $stock = 0;
                                                    $req_qty = (int)$job_card[0]->req_qty * $b->quantity;
                                                   
                                                    if ($req_qty <= $stock) {
                                                        $relese_po++;
                                                    }
                                                    $uom_data = $this->Crud->get_data_by_id("uom", $child_part_master[0]->uom_id, "id");

                                        ?>
                                                    <tr>
                                                        <td><?php echo $b->child_part_id ?></td>
                                                        <td><?php echo $child_part_data[0]->part_number ?></td>
                                                        <td><?php echo $child_part_data[0]->part_description ?></td>
                                                        <td><?php echo "" ?></td>

                                                        <td><?php echo $b->quantity ?></td>
                                                        <td><?php echo $req_qty ?></td>
                                                        <td><?php echo $child_part_data[0]->stock ?></td>
                                                        <td><?php echo $uom_data[0]->uom_name ?></td>
                                                        <td></td>
                                                        <td></td>






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
                                            <th colspan="9"><?php echo $jj . " /" . $relese_po ?></th>
                                            <th>
                                                <?php
                                                if (false && $jj != $relese_po) {
                                                    echo "Please Add All Stock To Relese JOB CARD";
                                                } else {
                                                ?>

                                                    <?php
                                                    if (false) {
                                                        echo "Please Add All Reject Qty To Close JOB CARD";
                                                    } else {

                                                        if ($job_card[0]->status == "close") {
                                                            echo "Job Card Already Close";
                                                        }else if($job_card[0]->status == "released"){


                                                            ?>
            
                                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#issueJobCard">
                                                                       Issue Job Card
                                                                    </button>
                                                                    <div class="modal fade" id="issueJobCard" tabindex="-1" role="dialog" aria-labelledby="issueJobCard" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">Issue Job Card </h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">

                                                                            <label for="">Are You Sure Want To Issue Job Card ? <span class="text-danger">*</span> </label>
                                                                            <form action="<?php echo base_url('issueJobCard'); ?>" method="post">
                                                                                <input type="hidden" required name="id" value="<?php echo $job_card[0]->id; ?>" class="form-control">
                                                                                <input type="hidden" required name="customer_part_id" value="<?php echo $job_card[0]->customer_part_id; ?>" class="form-control">
                                                                                <input type="hidden" required name="req_qty" value="<?php echo $job_card[0]->req_qty; ?>" class="form-control">
                                                                                
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php
                                                                } 
                                                        else {


                                                    ?>

                                                            <button type="button" class="btn btn-danger mt-4" data-toggle="modal" data-target="#releaseJobCardclose">
                                                                Enter Production & Close Job Card
                                                            </button>
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
                                                                                <input type="hidden" required name="customer_part_id" value="<?php echo $job_card[0]->customer_part_id; ?>" class="form-control">
                                                                                <div class="form-group">
                                                                                    <label for="">Enter Prod Quantity <span class="text-danger">*</span></label>
                                                                                    <input type="number" max="<?php echo $job_card[0]->req_qty; ?>" name="req_qty" placeholder="Prod Quantity" required class="form-control">
                                                                                </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                    <?php
                                                        }
                                                    }



                                                    ?>

                                                <?php

                                                }



                                                ?>


                                                <div class="modal fade" id="releaseJobCard" tabindex="-1" role="dialog" aria-labelledby="releaseJobCard" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Update </h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">

                                                                <label for="">Are You Sure Want To Issued Job Card ? <span class="text-danger">*</span> </label>
                                                                <form action="<?php echo base_url('update_job_card_status_lock'); ?>" method="post">
                                                                    <input type="hidden" required name="id" value="<?php echo $job_card[0]->id; ?>" class="form-control">

                                                                    <!-- <div class="row">
                                                                        <div class="col-lg-12">
                                                                            <div class="form-group">
                                                                                <label for="po_num">Store Location </label><span class="text-danger">*</span>
                                                                                <input type="text" name="location" required placeholder="Enter Location" min="1" value="" class="form-control">

                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="po_num">GRN No</label><span class="text-danger">*</span>
                                                                                <input type="text" name="grn" required placeholder="Enter GRN NO" min="1" value="" class="form-control">

                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="po_num">HOSE Make/Mfg.Date </label><span class="text-danger">*</span>
                                                                                <input type="text" name="house_make" required placeholder="Enter Hose Make" min="1" value="" class="form-control">

                                                                            </div>
                                                                        </div>
                                                                    </div> -->
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
                                    Operation Details
                                </h3>



                            </div>

                            <div class="card-body">
                                <table id="" class="table table-bordered table-striped">
                                    <thead>

                                        <tr class="text-center align-middle">
                                            <th rowspan="2" class="align-middle">Date</th>
                                            <th rowspan="2" class="align-middle">Operator No.</th>
                                            <th rowspan="2" class="align-middle">Process/Operation Name</th>
                                            <th rowspan="2" class="align-middle">M/c Device, Jigs,Tools For Mfg</th>
                                            <th colspan="3">Characteristics</th>
                                            <th rowspan="2" class="align-middle">Product Specification / Tolerance</th>
                                            <th rowspan="2" class="align-middle">Evaluation / Measurement Techn</th>
                                            <th rowspan="2" class="align-middle">Size</th>
                                            <th rowspan="2" class="align-middle">Frequency</th>
                                            <th colspan="2" class="align-middle">Set Up Approval</th>
                                            <th colspan="4" class="align-middle">In Process Observation</th>
                                            <th class="align-middle">Last Price</th>
                                            <th class="align-middle">Qty</th>
                                            <th class="align-middle">Qty</th>
                                            <th rowspan="2" class="align-middle" class="align-middle">Remark</th>
                                        </tr>
                                        <tr class="text-center align-middle">

                                            <th>No</th>
                                            <th>Product</th>
                                            <th>Process</th>
                                            <th>1</th>
                                            <th>2</th>
                                            <th>3</th>
                                            <th>4</th>
                                            <th>5</th>
                                            <th>6</th>
                                            <th>7</th>
                                            <th>Prod</th>
                                            <th>Acc</th>



                                        </tr>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        if ($customer_part_operation) {
                                            $i = 1;

                                            // foreach ($customer_part_operation as $bb) {


                                            if ($customer_part_operation) {

                                                // $customer_part_operation = $this->Crud->get_data_by_id("customer_part_operation", $customer_part_operation_data[0]->customer_part_operation_id, "id");
                                                // $operations = $this->Crud->get_data_by_id("operations", $customer_part_operation_data[0]->operation_id, "id");
                                                // $data['toolList'] = $this->Crud->get_data_by_id("tools", "insert", "type");
                                                foreach ($customer_part_operation as $b) {

                                                    $customer_part_operation_view = $this->Crud->get_data_by_id("customer_part_operation", $b->id, "id");
                                                    $operations = $this->Crud->get_data_by_id("operations", $b->operation_id, "id");

                                                    $customer_part_operation_data = $this->Crud->get_data_by_id("customer_part_operation_data", $customer_part_operation_view[0]->id, "customer_part_operation_id");
                                                    if ($customer_part_operation_data) {
                                                        foreach ($customer_part_operation_data as $cd) {
                                                            // $data['toolList'] = $this->Crud->get_data_by_id("tools", "insert", "type");

                                        ?>
                                                            <tr>
                                                                <td></td>
                                                                <td></td>
                                                                <td><?php echo $customer_part_operation_view[0]->name ?></td>
                                                                <td><?php echo $customer_part_operation_view[0]->mfg ?></td>
                                                                <td><?php echo $i ?></td>
                                                                <td><?php echo $cd->product ?></td>
                                                                <td><?php echo $cd->process ?></td>
                                                                <td><?php echo $cd->specification_tolerance ?></td>
                                                                <td><?php echo $cd->evalution ?></td>
                                                                <td><?php echo $cd->size ?></td>
                                                                <td><?php echo $cd->frequency ?></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>

                                                            </tr>

                                        <?php

                                                            $i++;
                                                        }
                                                    }
                                                }
                                            }
                                            // }
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