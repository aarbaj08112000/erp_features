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
                        <h1>JOB CARD Details Issued</h1>
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
                                    // $opration_id = $job_card[0]->operation_id;
                                    // $opration_data = $this->Crud->get_data_by_id("operations", $opration_id, "id");
                                    // $operation_name = $opration_data[0]->name;


                                    if ($job_card[0]->status == "pending") {


                                    ?>
                                        <div class="col-lg-2">
                                            <div class="form-group">

                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                                    Update Lot Qty
                                                </button>


                                                <!-- Modal -->

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

                                                        <label for="">Select Operation</label>
                                                        <select class="form-control" name="operation_id" required id="">
                                                            <?php
                                                            if ($operations_new) {
                                                                foreach ($operations_new as $o) {
                                                                    // if ($o->operation_id != $job_card[0]->operation_id) {
                                                                    $opration_data = $this->Crud->get_data_by_id("operations", $o->operation_id, "id");

                                                            ?>
                                                                    <option value="<?php echo $o->operation_id; ?>"><?php echo $opration_data[0]->name; ?></option>
                                                            <?php
                                                                    // }
                                                                }
                                                            }
                                                            ?>

                                                        </select>
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
                                            <input type="text" readonly value="<?php echo $job_card[0]->req_qty; ?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Production Qty<span class="text-danger">*</span></label>
                                            <?php
                                            // echo $production_qty;
                                            $job_card_prod_qty_ = $this->db->query('SELECT DISTINCT operation_id FROM `job_card_prod_qty` where job_card_id = ' . $job_card[0]->id . ' ORDER BY operation_id ASC ');
                                            $job_card_prod_qty_data = $job_card_prod_qty_->result();
                                            if ($job_card_prod_qty_data) {
                                                $array_count = count($job_card_prod_qty_data);

                                                $operation_id_prod = $job_card_prod_qty_data[$array_count - 1]->operation_id;
                                                $array_main = array(
                                                    "operation_id" => $operation_id_prod,
                                                    "job_card_id" => $job_card[0]->id,

                                                );

                                                $job_card_prod_qty_prod = $this->Crud->get_data_by_id_multiple_condition("job_card_prod_qty", $array_main);
                                                $prod_qty_new = 0;
                                                if ($job_card_prod_qty_prod) {
                                                    foreach ($job_card_prod_qty_prod as $jcp) {
                                                        $prod_qty_new = $prod_qty_new + $jcp->production_qty;
                                                    }
                                                }
                                                echo $prod_qty_new;
                                            } else
                                                [10]
                                                // print_r($job_card_prod_qty_data);
                                                // echo current($job_card_prod_qty_data);
                                                // if ($job_card_prod_qty_data) {
                                                //     if ($i == 1) {
                                                //         $max_qty = $job_card[0]->req_qty;
                                                //     } else {

                                                //         $max_array = array(
                                                //             "operation_id" => $i - 1,
                                                //             "job_card_id" => $job_card[0]->id,

                                                //         );
                                                //         $max_array_qty_data = $this->Crud->get_data_by_id_multiple_condition("job_card_prod_qty", $max_array);
                                                //         if ($max_array_qty_data) {
                                                //             $max_qty = 0;
                                                //             foreach ($max_array_qty_data as $max_array) {
                                                //                 echo "yes";
                                                //                 echo "<br>";
                                                //                 $max_qty = $max_qty + $max_array->production_qty;
                                                //             }
                                                //         } else {
                                                //             $max_qty = $job_card[0]->req_qty;
                                                //         }
                                                //     }
                                                // } else {
                                                //     $max_qty = $job_card[0]->req_qty;
                                                // }



                                            ?>
                                            <input type="text" readonly value="" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Job Card Status <span class="text-danger">*</span></label>
                                            <input type="text" readonly value="<?php echo $job_card[0]->status; ?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Stauts</label>
                                            <br>
                                                <?php
                                                if (false) {
                                                    echo "Please Add All Reject Qty To Close JOB CARD";
                                                } else {

                                                    if ($job_card[0]->status == "close") {
                                                        echo "Job Card Already Close";
                                                    } else {


                                                ?>

                                                        <button type="button" class="btn btn-danger mt-4" data-toggle="modal" data-target="#releaseJobCardclose">
                                                            Close Job Card
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
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <div class="card-header">
                                <h3 class="card-title">
                                    Operations
                                </h3>



                            </div>

                            <div class="card-body">
                                <table id="" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Operation Number</th>
                                            <th>Operation Name</th>
                                            <th>Prod Qty</th>
                                            <th>Cummulative production qty</th>
                                            <th>Production Qty history</th>
                                            <th>BOM /item part entry</th>

                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php

                                        $i = 1;

                                        if ($operations_new) {
                                            $lastArrayId = (end($operations_new)->operation_id);
                                            foreach ($operations_new as $b) {
                                                if (true) {
                                                    $customer_part_operation = $this->Crud->get_data_by_id("customer_part_operation", $b->id, "id");
                                                    $operations_data = $this->Crud->get_data_by_id("operations", $b->operation_id, "id");

                                                    $job_card_prod_qty_ = $this->db->query('SELECT DISTINCT operation_id FROM `job_card_prod_qty` where job_card_id = ' . $job_card[0]->id . ' ORDER BY operation_id ASC ');
                                                    $job_card_prod_qty_data = $job_card_prod_qty_->result();
                                                    if ($job_card_prod_qty_data) {
                                                        if ($i == 1) {
                                                            $max_qty = $job_card[0]->req_qty;
                                                        } else {

                                                            $max_array = array(
                                                                "operation_id" => $i - 1,
                                                                "job_card_id" => $job_card[0]->id,

                                                            );
                                                            $max_array_qty_data = $this->Crud->get_data_by_id_multiple_condition("job_card_prod_qty", $max_array);
                                                            if ($max_array_qty_data) {
                                                                $max_qty = 0;
                                                                foreach ($max_array_qty_data as $max_array) {
                                                                    // echo "yes";
                                                                    // echo "<br>";
                                                                    $max_qty = $max_qty + $max_array->production_qty;
                                                                }
                                                            } else {
                                                                $max_qty = $job_card[0]->req_qty;
                                                            }
                                                        }
                                                    } else {
                                                        $max_qty = $job_card[0]->req_qty;
                                                    }


                                                    // echo $b->operation_id;
                                                    // print_r($operations_data);
                                                    $array = array(
                                                        "operation_id" => $b->operation_id,
                                                        "job_card_id" => $job_card[0]->id,

                                                    );
                                                    $array2 = array(
                                                        // "operation_id" => $b->operation_id,
                                                        "job_card_id" => $job_card[0]->id,

                                                    );

                                                    // $array = array(
                                                    //     "job_card_id" => $job_card[0]->id,
                                                    //     "operation_id" => $b->operation_id,

                                                    // );

                                                    // $job_card_details_operations_data = $this->Crud->get_data_by_id_multiple_condition("job_card_prod_qty", $array);

                                                    $job_card_prod_qty = $this->Crud->get_data_by_id_multiple_condition("job_card_prod_qty", $array);
                                                    $job_card_prod_qty22 = $this->Crud->get_data_by_id_multiple_condition("job_card_prod_qty", $array2);
                                                    $q_qty = 0;
                                                    if ($job_card_prod_qty) {
                                                        foreach ($job_card_prod_qty as $jcp) {
                                                            $q_qty = $q_qty + $jcp->production_qty;
                                                        }
                                                    }
                                                    $qfinal_qty = 0;
                                                    if ($job_card_prod_qty22) {
                                                        foreach ($job_card_prod_qty22 as $jcpp) {
                                                            $qfinal_qty = $qfinal_qty + $jcpp->production_qty;
                                                        }
                                                    }
                                                    // // $job_card_details_operations_data = $this->Crud->get_data_by_id("job_card_details_operations", $b->id, "job_card_details_id");
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
                                                    // // $data['toolList'] = $this->Crud->get_data_by_id("tools", "insert", "type");
                                                    // $req_qty = 0;
                                                    // $stock =  (int)$child_part_master[0]->stock;
                                                    // $req_qty = (int)$job_card[0]->req_qty * $b->bom_qty;
                                                    // $production_qty1 = $production_qty * $b->bom_qty;
                                                    // $stock = 3;
                                                    // $req_qty = 1;


                                        ?>
                                                    <tr>
                                                        <td><?php  ?></td>
                                                        <td><?php echo $operations_data[0]->name ?></td>
                                                        <td><?php echo $customer_part_operation[0]->name ?></td>
                                                        <td>

                                                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal2<?php echo $i ?>">
                                                                Add Prod Qty
                                                            </button>

                                                            <div class="modal fade" id="exampleModal2<?php echo $i ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                                            $production_qty_new = 0;
                                                                            if ($job_card_prod_qty) {

                                                                                foreach ($job_card_prod_qty as $p) {
                                                                                    $production_qty_new = $production_qty_new + $p->production_qty;
                                                                                }
                                                                                // $production_qty = $job_card_prod_qty[0]->production_qty;
                                                                            }
                                                                            ?>
                                                                            <form action="<?php echo base_url('update_job_card_prod'); ?>" method="post">
                                                                                <input type="number" required name="req_qty" value="<?php echo $production_qty_new; ?>" class="form-control">
                                                                                <input type="hidden" required name="lot_qty" value="<?php echo $job_card[0]->req_qty; ?>" class="form-control">
                                                                                <input type="hidden" required name="production_qty_calculated" value="<?php echo $production_qty; ?>" class="form-control">
                                                                                <input type="hidden" required name="id" value="<?php echo $job_card[0]->id; ?>" class="form-control">
                                                                                <input type="hidden" required name="qfinal_qty" value="<?php echo $q_qty; ?>" class="form-control">

                                                                                <label for="">Select Operation</label>
                                                                                <input type="text" readonly value="<?php echo $operations_data[0]->name; ?>" class="form-control">
                                                                                <input type="hidden" readonly name="operation_id" value="<?php echo $operations_data[0]->id; ?>" class="form-control">
                                                                                <input type="hidden" readonly name="max_qty" value="<?php echo $max_qty; ?>" class="form-control">
                                                                                <input type="hidden" readonly name="customer_part_id" value="<?php echo $customer_part_data[0]->id; ?>" class="form-control">
                                                                                <input type="hidden" readonly name="last" value="<?php if ($lastArrayId == $b->operation_id) {
                                                                                                                                        echo "yes";
                                                                                                                                    } else {
                                                                                                                                        echo "no";
                                                                                                                                    }; ?>" class="form-control">

                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>



                                                        </td>

                                                        <td class="<?php if ((int)$production_qty === (int)$job_card[0]->req_qty) {
                                                                        echo "text-success";
                                                                    } else {
                                                                        echo "text-danger";
                                                                    } ?>"><?php echo $q_qty ?></td>
                                                        <td>
                                                            <a class="btn btn-info" href="<?php echo base_url('view_job_card_prod_qty_by_id/') . $job_card[0]->id; ?>">
                                                                <i class="fa fa-eye"></i>
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <a class="btn btn-primary" href="<?php echo base_url('view_job_card_details_issued_new/') . $job_card[0]->id . "/" . $b->operation_id . "/" . $q_qty; ?>">
                                                                BOM
                                                            </a>

                                                        </td>





                                                    </tr>

                                        <?php

                                                }
                                                $i++;
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