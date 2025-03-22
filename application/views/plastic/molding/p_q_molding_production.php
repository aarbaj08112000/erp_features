<div class="wrapper" style="width:3000px">

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Molding Production</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
                            <li class="breadcrumb-item active">Molding Production</li>
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
                                        <h5 class="modal-title" id="exampleModalLabel">Add Molding Production Quantity</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                        <form
                                                action="<?php echo base_url('add_production_qty_molding_production') ?>"
                                                method="POST" enctype="multipart/form-data">
                                        </div>
                                        <div class="form-group">
                                            <label for="on click url">Customer Name / Part Number / Part Description<span
                                                    class="text-danger">*</span></label>
                                            <select required name="customer_part_id" id="" class="form-control select2">
                                                <option value="">Select</option>
                                                <?php
                                                if ($customer_part_new) {
                                                    foreach ($customer_part_new as $s) {
		                                        ?>
                                                <option value="<?php echo $s->id ?>">
                                                    <?php echo $s->customer_name." / ".$s->part_number . " / " . $s->part_description; ?>
                                                </option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="row">
                                        <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="on click url">Machine<span
                                                    class="text-danger">*</span></label>
                                            <select required name="machine_id" id="" class="form-control select2">
                                                <option value="">Select</option>
                                                <?php
                                                if ($machine) {
                                                    foreach ($machine as $s) {
                                                ?>
                                                <option value="<?php echo $s->id ?>"><?php echo $s->name; ?></option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                            </div>
                                            <div class="col-lg-6">
                                        <div class="form-group">
                                        <label for="on click url">Select Customer Part / Mold Name / Cavity<span class="text-danger">*</span></label>
                                            <select required name="mold_id" id="" class="form-control select2">
                                                <?php
                                                if ($mold_maintenance) {
                                                    foreach ($mold_maintenance as $s) {
                                                ?>
                                                <option value="<?php echo $s->id ?>">
                                                    <?php echo $s->part_number . "/" . $s->part_description . "/" . $s->mold_name . "/" . $s->no_of_cavity ?>
                                                </option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                            </div>
                                            </div>
                                        <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="on click url">Date
                                                    <span class="text-danger">*</span></label>
                                                <input max="<?php echo date("Y-m-d"); ?>" type="date"
                                                    value="<?php echo date('Y-m-d'); ?>" name="date" required
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                        <div class="form-group">
                                            <label required for="on click url">Shift Type / Name / Start Time /
                                                End Time<span class="text-danger">*</span></label>
                                            <select name="shift_id" name="" id="" class="form-control select2">
                                                 <option value="">Select</option>
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
                                        </div>
                                        </div>
                                        
                                        <div class="row">
                                        <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="on click url">Production OK Quantity<span
                                                    class="text-danger">*</span></label>
                                            <input type="number" min="1" value="0" name="qty" required
                                                class="form-control">
                                        </div>
                                        </div>
                                        <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="on click url">Production Rejection<span
                                                            class="text-danger">*</span></label>
                                                    <input type="number" min="0" value="0" name="rejection_qty" required
                                                        class="form-control">
                                                </div>
                                        </div>
                                        </div>
                                        
                                        <div class="row">
                                        <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="on click url">Production Minutes<span
                                                    class="text-danger">*</span></label>
                                            <input type="number" step="any" name="production_hours" required
                                                class="form-control">
                                        </div>
                                            </div>
                                         <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="on click url">Downtime in min <span
                                                        class="text-danger">*</span></label>
                                                <input type="number" step="any" name="downtime_in_min" required
                                                    class="form-control">
                                            </div>
                                        </div>
                                         <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="on click url">Setup in min <span
                                                        class="text-danger">*</span></label>
                                                <input type="number" step="any" name="setup_time_in_min" required
                                                    class="form-control">
                                            </div>
                                        </div>
                                        </div>
                                        <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="on click url">Finish Part Weight <span
                                                        class="text-danger">*</span></label>
                                                <input type="number" step="any" name="finish_part_weight" required
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="on click url">Runner Weight <span
                                                        class="text-danger">*</span></label>
                                                <input type="number" step="any" name="runner_weight" required
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="on click url">Wastage / Gattha / Lumps (Kg)<span
                                                        class="text-danger">*</span></label>
                                                <input type="number" step="any" name="wastage" required
                                                    class="form-control">
                                            </div>
                                        </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="on click url">Cycle Time Per Shot (sec) <span
                                                            class="text-danger">*</span></label>
                                                    <input type="number" step="any" name="cycle_time" required
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="on click url">Operator<span
                                                        class="text-danger">*</span></label>
                                                <select required name="operator_id" id="" class="form-control select2">
                                                    <option value="">Select</option>
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
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="on click url">Remark</label>
                                            <input type="text" name="remark" class="form-control">
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
                                    Add Molding Production Qty
                                </button>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Job Order No</th>
                                            <th>Part Number / Descriptions </th>
                                            <th>Mold Name</th>
                                            <th>Date</th>
                                            <th>Shift</th>
                                            <th>Machine</th>
                                            <th>Operator</th>
                                            <th>Production OK Qty</th>
                                            <th>Production Rejection Qty</th>
                                            <th>Accepted Qty by Quality</th>
                                            <th>Rejected Qty by Quality</th>
                                            <th>Onhold Qty</th>
                                            <th style="word-wrap: break-word;">Wastage / Gattha / Lumps (Kg)</th>
                                            <th>Status</th>
                                            <th>Production Minutes</th>
                                            <th>Downtime In Min</th>
                                            <!-- <th>Downtime Reason</th> -->
                                            <th>Setup Time In Min</th>
                                            <th>Cycle Time In Sec</th>
                                            <th>Finish Part Weight (gram)</th>
                                            <th>Runner Weight (gram)</th>
                                            <th>Shift Target Qty</th>
                                            <!-- <th>Remark</th> -->
                                            <!-- <th>Accept Reject</th> -->
                                            <th>Rejection Details</th>
                                            <th>Downtime Details</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        if ($molding_production) {
                                            $i = 1;
                                            foreach ($molding_production as $u) {
                                        ?>

                                        <tr>
                                            <td><?php echo "JO-".$u->id; ?></td>
                                            <td><?php echo $u->part_number ?> /
                                                <?php echo $u->part_description ?></td>
                                            <td><?php echo $u->mold_name; ?></td>
                                            <td><?php echo $u->date ?></td>
                                            <td><?php echo $u->shift_type . "/" . $u->name; ?>
                                            </td>
                                            <td><?php echo $u->machine_name; ?></td>
                                            <td><?php echo $u->operator_name; ?></td>
                                            <td><?php echo $u->qty ?></td>
                                            <td><?php echo $u->rejection_qty ?></td>
                                            <td><?php echo $u->accepted_qty ?></td>
                                            <td><?php echo $u->rejected_qty ?></td>
                                            <td><?php
                                                        if (!empty($u->onhold_qty)) {
                                                        ?>
                                                <button type="button" class="btn btn-warning float-left "
                                                    data-toggle="modal" data-target="#onhold<?php echo $i; ?>">
                                                    <?php echo $u->onhold_qty; ?> </button>
                                                <?php } else {
                                                            echo 0;
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
                                                                                    class="form-control"
                                                                                    name="rejection_remark">
                                                                                <input type="hidden"
                                                                                    readonly class="form-control"
                                                                                    name="id"
                                                                                    value="<?php echo $u->id ?>">
                                                                                <input type="hidden"
                                                                                    readonly class="form-control"
                                                                                    name="rejection_qty"
                                                                                    value="<?php echo $u->rejection_qty ?>">
                                                                                <input type="hidden"
                                                                                    readonly class="form-control"
                                                                                    name="qty"
                                                                                    value="<?php echo $u->onhold_qty ?>">
                                                                                <input type="hidden"
                                                                                    readonly class="form-control"
                                                                                    name="output_part_id"
                                                                                    value="<?php echo $u->output_part_id ?>">
                                                                                <input type="hidden"
                                                                                    readonly class="form-control"
                                                                                    name="accepted_qty_old"
                                                                                    value="<?php echo $u->accepted_qty ?>">
                                                                                <input type="hidden"
                                                                                    readonly class="form-control"
                                                                                    name="rejected_qty_old"
                                                                                    value="<?php echo $u->rejected_qty ?>">
                                                                                <input type="text"
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
                                            <td><?php echo $u->wastage ?></td>
                                            <td><?php echo $u->status ?></td>
                                            <td><?php echo $u->production_hours ?></td>

                                            <td><?php echo $u->downtime_in_min ?></td>
                                            <!-- <td><?php echo $u->downtime_reason ?></td> -->
                                            <td><?php echo $u->setup_time_in_min ?></td>
                                            <td><?php echo $u->cycle_time ?></td>
                                            <td><?php echo $u->finish_part_weight ?></td>
                                            <td><?php echo $u->runner_weight ?></td>
                                            <td><?php echo $u->production_target_per_shift ?></td>
                                            <td>
                                                <a class="btn btn-primary" href="<?php echo base_url('view_rejection_details/') . $u->id.'/'.$u->customer_part_id .'/add'?>">
                                                    <i class='far fa-edit'></i>
                                                </a>
                                            </td>
                                            <td>
                                                <a class="btn btn-primary" href="<?php echo base_url('view_downtime_details/') . $u->id.'/'.$u->customer_part_id .'/add'?>">
                                                    <i class='far fa-edit'></i>
                                                </a>
                                            </td>
                                            <td>
                                                <?php
                                                        if ($u->status == "pending") {
                                                        ?>
                                                <button type="button" class="btn btn-danger float-left "
                                                    data-toggle="modal" data-target="#acceptReject<?php echo $i; ?>">
                                                    Accept/Reject </button>

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
                                                                    action="<?php echo base_url('update_p_q_molding_production') ?>"
                                                                    method="POST" enctype='multipart/form-data' s>
                                                                    <div class="row">
                                                                        <div class="col-lg-12">
                                                                            <div class="form-group">
                                                                                <label for="">Date</label>
                                                                                <input type="text"
                                                                                    value="<?php echo $u->date ?>"
                                                                                    readonly class="form-control">

                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-12">
                                                                            <div class="form-group">
                                                                                <label for="">Shift</label>
                                                                                <br>
                                                                                <span><?php echo $u->shift_type . "/" . $u->name; ?></span>


                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-12">
                                                                            <div class="form-group">
                                                                                <label for="">Qty</label>
                                                                                <input type="text"
                                                                                    value="<?php echo $u->qty ?>"
                                                                                    readonly class="form-control">

                                                                            </div>
                                                                        </div>
                                                                        <!-- <div class="col-lg-12">
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
                                                                        </div> -->
                                                                        <!-- <div class="col-lg-12">

                                                                        <div class="form-group">
                                                                            <label for="on click url">Enter Semi
                                                                                Finished location QTY<span
                                                                                    class="text-danger">*</span></label>
                                                                            <input type="number" min="0" value="0"
                                                                                max="" name="semi_finished_location"
                                                                                required class="form-control">
                                                                        </div>-->
                                                    </div>
                                                    <!-- <div class="col-lg-12">

                                                                        <div class="form-group">
                                                                            <label for="on click url">Enter Deflashing /
                                                                                Assembly location<span
                                                                                    class="text-danger">*</span></label>
                                                                            <input type="number" min="0" value="0"
                                                                                max=""
                                                                                name="deflashing_assembly_location"
                                                                                required class="form-control">


                                                                        </div>
                                                    </div>-->
                                                    <div class="col-lg-12">

                                                                        <div class="form-group">
                                                                            <label for="on click url">Enter Final
                                                                                Inspection Qty<span
                                                                                    class="text-danger">*</span></label>
                                                                            <input type="number" min="0" value="0"
                                                                                max="" name="final_inspection_location"
                                                                                required class="form-control">


                                                                        </div>
                                                    </div>
                                                                        <!-- 
                                                                        Removed this baseed on discussion on 1st Aug until we have strategy 
                                                                        of having hold transfer    
                                                                        
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
                                                                        </div> -->

                                                                        <!-- <div class="col-lg-12">
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
                                                                        </div> -->
                                                                        <div class="col-lg-12">
                                                                            <div class="form-group">
                                                                                <label for="">Reject Remark</label>
                                                                                <input type="text"
                                                                                    class="form-control"
                                                                                    name="rejection_remark">
                                                                                <input type="hidden"
                                                                                    readonly class="form-control"
                                                                                    name="id"
                                                                                    value="<?php echo $u->id ?>">
                                                                                <input type="hidden"
                                                                                    readonly class="form-control"
                                                                                    name="qty"
                                                                                    value="<?php echo $u->qty ?>">
                                                                                <input type="hidden"
                                                                                    readonly class="form-control"
                                                                                    name="customer_part_id"
                                                                                    value="<?php echo $u->customer_part_id ?>">
                                                                                <input type="hidden"
                                                                                    readonly class="form-control"
                                                                                    name="accepted_qty_old"
                                                                                    value="<?php echo $u->accepted_qty ?>">
                                                                                <input type="hidden"
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