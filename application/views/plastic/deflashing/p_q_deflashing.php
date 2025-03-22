<div class="wrapper" style="width:100%">

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Deflashing Production</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
                            <li class="breadcrumb-item active">Deflashing Production</li>
                        </ol>
                    </div>

                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">

            <div>
                <!-- Small boxes (Stat box) -->
                <div class="row">


                    <br>
                    <div class="col-lg-12">

                        <!-- Modal -->
                        <div class="modal fade" id="addPromo" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <form action="<?php echo base_url('add_production_qty_deflashing') ?>"
                                                method="POST" enctype="multipart/form-data">

                                        </div>
                                        <div class="form-group">
                                            <label required for="on click url">Select Shift Type / Name / Start Time /
                                                End Time<span class="text-danger">*</span></label>
                                            <select name="shift_id" name="" id="" class="form-control select2">
                                                <?php
                                                if ($shifts) {
                                                    foreach ($shifts as $s) {
                                                ?>
                                                <option value="<?php echo $s->id ?>">
                                                    <?php echo $s->shift_type . " / " . $s->name . " / " . $s->start_time . " / " . $s->end_time; ?>
                                                </option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>


                                        </div>
                                        <div class="form-group">
                                            <label for="on click url">Select Operator<span
                                                    class="text-danger">*</span></label>
                                            <select required name="operator_id" id="" class="form-control select2">
                                                <?php
                                                if ($operator) {
                                                    foreach ($operator as $s) {
                                                ?>
                                                <option value="<?php echo $s->id ?>"><?php echo $s->name; ?></option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>


                                        </div>
                                        <div class="form-group">
                                            <label for="on click url">Select Deflashing Customer Part Number /
                                                Operation / Production Target
                                                Qty<span class="text-danger">*</span></label>
                                            <select required name="deflashing_operation_id" id=""
                                                class="form-control select2">
                                                <?php
                                                if ($deflashing_operation) {
                                                    foreach ($deflashing_operation as $s) {
                                                        $operations_data = $this->Crud->get_data_by_id("operations", $s->operation_id, "id");
                                                        $customer_part_data = $this->Crud->get_data_by_id("customer_parts_master", $s->customer_part_id, "id");
                                                        $customer_data = $this->Crud->get_data_by_id("customer", $customer_part_data[0]->customer_id, "id");

                                                ?>
                                                <option value="<?php echo $s->id ?>">
                                                    <?php echo $customer_part_data[0]->part_number ." / ". $operations_data[0]->name . " / " . $s->production_trg_qty; ?>
                                                </option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>


                                        </div>

                                        <!-- <div class="form-group">
                                            <label for="on click url">Select Customer Part<span
                                                    class="text-danger">*</span></label>
                                            <select required name="customer_part_id" id="" class="form-control select2">
                                                <?php
                                                if ($customer_part) {
                                                    foreach ($customer_part as $s) {
                                                        $customer_data = $this->Crud->get_data_by_id("customer", $s->customer_id, "id");

                                                ?>
                                                <option value="<?php echo $s->id ?>">
                                                    <?php echo $customer_data[0]->customer_name . "/" . $s->part_number . " / " . $s->part_description; ?>
                                                </option>
                                                <?php

                                                        // }
                                                    }
                                                }
                                                ?>
                                            </select>


                                        </div> -->

                                        <div class="form-group">
                                            <label for="on click url">Enter QTY<span
                                                    class="text-danger">*</span></label>
                                            <input type="number" min="1" value="1" name="qty" required
                                                class="form-control">


                                        </div>
                                        <div class="form-group">
                                            <label for="on click url">Enter Production Minutes<span
                                                    class="text-danger">*</span></label>
                                            <input type="number" step="any" min="1" value="1" name="production_hours"
                                                required class="form-control">


                                        </div>
                                        <div class="form-group">
                                            <label for="on click url">Enter Date
                                                <span class="text-danger">*</span></label>
                                            <input max="<?php echo date("Y-m-d"); ?>" type="date"
                                                value="<?php echo date('Y-m-d'); ?>" name="date" required
                                                class="form-control">


                                        </div>



                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">

                            <div class="card-header">
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#addPromo">
                                    Add Deflashing Production Qty
                                </button>
                            </div>


                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sr No</th>
                                            <th>Part Number / Descriptions </th>
                                            <th>Shift</th>
                                            <th>Date</th>
                                            <th>Operator</th>
                                            <th>Qty</th>
                                            <th>Production Minutes</th>
                                            <th>Accepted Qty</th>
                                            <th>Rejected Qty</th>
                                            <th>Onhold Qty</th>
                                            <th>Status</th>

                                            <th>Accept Reject</th>
                                            <!-- <th>Actions</th> -->

                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        if ($deflashing_production) {
                                            $i = 1;
                                            foreach ($deflashing_production as $u) {
                                                $shifts_data = $this->Crud->get_data_by_id("shifts", $u->shift_id, "id");
                                                $customer_part_data = $this->Crud->get_data_by_id("customer_part", $u->customer_part_id, "id");
                                                // $downtime_master = $this->Crud->get_data_by_id("downtime_master", $u->mold_id, "id");
                                                $operator_data = $this->Crud->get_data_by_id("operator", $u->operator_id, "id");




                                        ?>

                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $customer_part_data[0]->part_number ?> /
                                                <?php echo $customer_part_data[0]->part_description ?></td>
                                            <td><?php echo $shifts_data[0]->shift_type . "/" . $shifts_data[0]->name; ?>
                                            </td>
                                            <td><?php echo $u->date; ?></td>
                                            <td><?php echo $operator_data[0]->name; ?></td>
                                            <td><?php echo $u->qty ?></td>
                                            <td><?php echo $u->production_hours ?></td>
                                            <td><?php echo $u->accepted_qty ?></td>
                                            <td><?php echo $u->rejected_qty ?></td>
                                            <td><?php
                                                        if (false && !empty($u->onhold_qty)) {
                                                        ?>
                                                <button type="button" class="btn btn-warning float-left "
                                                    data-toggle="modal" data-target="#onhold<?php echo $i; ?>">
                                                    <?php echo $u->onhold_qty; ?> </button>
                                                <?php } else {
                                                            echo $u->onhold_qty;
                                                        } ?>



                                                <div class="modal fade" id="onhold<?php echo $i; ?>" tabindex="-1"
                                                    role="dialog" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">
                                                                    Onhold
                                                                    Update </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form
                                                                    action="<?php echo base_url('update_p_q_onhold_molding') ?>"
                                                                    method="POST" enctype='multipart/form-data' s>
                                                                    <div class="row">
                                                                        <div class="col-lg-12">
                                                                            <div class="form-group">
                                                                                <label for="">Qty</label>
                                                                                <input type="text"
                                                                                    value="<?php echo $u->onhold_qty ?>"
                                                                                    readonly class="form-control">

                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-12">
                                                                            <div class="form-group">
                                                                                <label for="">Accept Qty <span
                                                                                        class="text-danger">*</span>
                                                                                </label>
                                                                                <input type="number" step="any" value=""
                                                                                    max="<?php echo $u->onhold_qty ?>"
                                                                                    min="0" class="form-control"
                                                                                    name="accepted_qty"
                                                                                    placeholder="Enter Accepted Quantity"
                                                                                    required>

                                                                            </div>
                                                                        </div>

                                                                        <div class="col-lg-12">
                                                                            <div class="form-group">
                                                                                <label for="">Rejection
                                                                                    Reason</label>
                                                                                <select name="rejection_reason" id=""
                                                                                    class="form-control select2">
                                                                                    <option value="NA">NA</option>
                                                                                    <?php
                                                                                            if ($reject_remark) {

                                                                                                foreach ($reject_remark as $r) {
                                                                                            ?>
                                                                                    <option
                                                                                        value="<?Php echo $r->name ?>">
                                                                                        <?Php echo $r->name ?>
                                                                                    </option>
                                                                                    <?php
                                                                                                }
                                                                                            }
                                                                                            ?>
                                                                                </select>

                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-12">
                                                                            <div class="form-group">
                                                                                <label for="">Reject Remark</label>
                                                                                <input type="text"
                                                                                    placeholder="Enter Rejection Remark If any"
                                                                                    class="form-control"
                                                                                    name="rejection_remark">
                                                                                <input type="hidden"
                                                                                    placeholder="Enter Rejection Remark If any"
                                                                                    readonly class="form-control"
                                                                                    name="id"
                                                                                    value="<?php echo $u->id ?>">
                                                                                <input type="hidden"
                                                                                    placeholder="Enter Rejection Remark If any"
                                                                                    readonly class="form-control"
                                                                                    name="qty"
                                                                                    value="<?php echo $u->onhold_qty ?>">
                                                                                <input type="hidden"
                                                                                    placeholder="Enter Rejection Remark If any"
                                                                                    readonly class="form-control"
                                                                                    name="output_part_id"
                                                                                    value="<?php echo $u->output_part_id ?>">
                                                                                <input type="hidden"
                                                                                    placeholder="Enter Rejection Remark If any"
                                                                                    readonly class="form-control"
                                                                                    name="accepted_qty_old"
                                                                                    value="<?php echo $u->accepted_qty ?>">
                                                                                <input type="hidden"
                                                                                    placeholder="Enter Rejection Remark If any"
                                                                                    readonly class="form-control"
                                                                                    name="rejected_qty_old"
                                                                                    value="<?php echo $u->rejected_qty ?>">
                                                                                <input type="text"
                                                                                    placeholder="Enter Rejection Remark If any"
                                                                                    readonly class="form-control"
                                                                                    name="customer_part_id"
                                                                                    value="<?php echo $u->customer_part_id ?>">

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">Close</button>
                                                                        <button type="submit"
                                                                            class="btn btn-primary">Save
                                                                            changes</button>
                                                                    </div>
                                                            </div>
                                                            </form>

                                                        </div>

                                                    </div>
                                                </div>
                                            </td>
                                            <td><?php echo $u->status ?></td>


                                            <td>
                                                <?php
                                                        if ($u->status == "pending") {
                                                        ?>
                                                <button type="button" class="btn btn-danger float-left "
                                                    data-toggle="modal" data-target="#acceptReject<?php echo $i; ?>">
                                                    Accept/Reject .</button>

                                                <?php
                                                        } else {
                                                            echo "Completed";
                                                        }
                                                        ?>


                                                <div class="modal fade" id="acceptReject<?php echo $i; ?>" tabindex="-1"
                                                    role="dialog" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Add </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form
                                                                    action="<?php echo base_url('update_p_q_deflashing') ?>"
                                                                    method="POST" enctype='multipart/form-data' s>
                                                                    <div class="row">
                                                                        <div class="col-lg-12">
                                                                            <div class="form-group">
                                                                                <label for="">Qty</label>
                                                                                <input type="text"
                                                                                    value="<?php echo $u->qty ?>"
                                                                                    readonly class="form-control">

                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-12">
                                                                            <div class="form-group">
                                                                                <label for="">Accept Qty <span
                                                                                        class="text-danger">*</span>
                                                                                </label>
                                                                                <input type="number" step="any" value=""
                                                                                    max="<?php echo $u->qty ?>" min="0"
                                                                                    class="form-control"
                                                                                    name="accepted_qty"
                                                                                    placeholder="Enter Accepted Quantity"
                                                                                    required>

                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-12">
                                                                            <div class="form-group">
                                                                                <label for="">Onhold Qty <span
                                                                                        class="text-danger">*</span>
                                                                                </label>
                                                                                <input type="number" step="any" value=""
                                                                                    max="<?php echo $u->qty ?>" min="0"
                                                                                    class="form-control"
                                                                                    name="onhold_qty"
                                                                                    placeholder="Enter onhold" required>

                                                                            </div>
                                                                        </div>

                                                                        <div class="col-lg-12">
                                                                            <div class="form-group">
                                                                                <label for="">Rejection Reason</label>
                                                                                <select name="rejection_reason" id=""
                                                                                    class="form-control select2">
                                                                                    <option value="NA">NA</option>
                                                                                    <?php
                                                                                            if ($reject_remark) {

                                                                                                foreach ($reject_remark as $r) {
                                                                                            ?>
                                                                                    <option
                                                                                        value="<?Php echo $r->name ?>">
                                                                                        <?Php echo $r->name ?>
                                                                                    </option>
                                                                                    <?php
                                                                                                }
                                                                                            }
                                                                                            ?>
                                                                                </select>

                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-12">
                                                                            <div class="form-group">
                                                                                <label for="">Reject Remark</label>
                                                                                <input type="text"
                                                                                    placeholder="Enter Rejection Remark If any"
                                                                                    class="form-control"
                                                                                    name="rejection_remark">
                                                                                <input type="hidden"
                                                                                    placeholder="Enter Rejection Remark If any"
                                                                                    readonly class="form-control"
                                                                                    name="id"
                                                                                    value="<?php echo $u->id ?>">
                                                                                <input type="hidden"
                                                                                    placeholder="Enter Rejection Remark If any"
                                                                                    readonly class="form-control"
                                                                                    name="qty"
                                                                                    value="<?php echo $u->qty ?>">
                                                                                <input type="hidden"
                                                                                    placeholder="Enter Rejection Remark If any"
                                                                                    readonly class="form-control"
                                                                                    name="customer_part_id"
                                                                                    value="<?php echo $u->customer_part_id ?>">
                                                                                <input type="hidden"
                                                                                    placeholder="Enter Rejection Remark If any"
                                                                                    readonly class="form-control"
                                                                                    name="accepted_qty_old"
                                                                                    value="<?php echo $u->accepted_qty ?>">
                                                                                <input type="hidden"
                                                                                    placeholder="Enter Rejection Remark If any"
                                                                                    readonly class="form-control"
                                                                                    name="rejected_qty_old"
                                                                                    value="<?php echo $u->rejected_qty ?>">

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">Close</button>
                                                                        <button type="submit"
                                                                            class="btn btn-primary">Save
                                                                            changes</button>
                                                                    </div>
                                                            </div>
                                                            </form>

                                                        </div>

                                                    </div>
                                                </div>

                                            </td>

                                            <!-- <td></td> -->




                                        </tr>

                                        <?php
                                                $i++;
                                            }
                                        }
                                        ?>
                                    </tbody>

                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- ./col -->
                    </div>

                </div>
                <!-- /.row -->
                <!-- Main row -->

                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>