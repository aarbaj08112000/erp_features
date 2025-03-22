<div class="wrapper" style="width:200%">

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>View Molding Production</h1>
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
                        <div class="card">
                            <div class="card-header">
                            <div class="row">
                                    <div class="col-lg-1">
                                        <form action="<?php echo base_url('view_p_q_molding_production'); ?>" method="post">
                                        <div class="form-group">
                                            <label for="">Select Month  <span class="text-danger">*</span></label>
                                            <select required name="created_month" id="" class="form-control select2">
                                                <?php
                                                 for ($i = 1; $i <= 12; $i++) {
                                                    $month_data = $this->Common_admin_model->get_month($i);
                                                    $month_number = $this->Common_admin_model->get_month_number($month_data);
                                                    ?>
                                                    <option <?php  if($month_number == $created_month){echo "selected";} ?>
															value="<?php echo $month_number;?>"><?php echo $month_data?></option>
                                                    <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-1">
										<div class="form-group">
                                            <label for="">Select Year  <span class="text-danger">*</span></label>
                                            <select required name="created_year" id="" class="form-control select2">
                                                <?php
                                                 for ($i = 2022; $i <= 2027; $i++) {
                                                    ?>
                                                    <option  <?php  if($i == $created_year){echo "selected";} ?>
															value="<?php echo $i;?>"><?php echo $i?></option>
                                                    <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <br><input type="submit" class="btn btn-primary mt-2"value="Search">
                                     </form>
                                    </div>
                                </div>
								</div>
								</div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Job Order No</th>
                                            <th>Part Number / Descriptions </th>
                                            <th>Date</th>
                                            <th>Shift</th>
                                            <th>Machine</th>
                                            <th>Operator</th>
                                            <th>Target Production Qty</th>
                                            <th>Production Ok Qty</th>
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
                                            <th>Target Prod WT</th>
                                            <th>Target Runner WT</th>
                                            <th>Finish Part Weight (gram)</th>
                                            <th>Runner Weight (gram)</th>
                                            <!-- <th>Shift Target Qty</th> AROM-105 -->
                                            <th>Production Efficiency</th>
                                            <th>Quality Efficiency</th>
                                            <th>PPM</th>
                                            <th>OEE</th>
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
                                                $total_pde = (
                                                    ($u->accepted_qty / $u->production_hours * $u->name) 
                                                    / $production_target_per_shift * 100) * 100;
                                                $total_qe = ($u->accepted_qty / $u->qty) * 100;
                                                $total_ppm = (($u->rejection_qty+$u->rejected_qty)/ $u->qty) * 1000000;
                                                
                                                $planned_pt  = ($u->production_hours - $u->ppt);
                                                $runtime = $planned_pt - ($downtime_in_min  + $setup_time_in_min);
                                                $availbility = $runtime / $planned_pt;
                                                $total_prod_qty = $u->rejection_qty + $u->qty;
                                                $performance = ($u->cycle_time * $total_prod_qty ) / ($runtime * 60);
                                                $quality = $u->accepted_qty / $total_prod_qty;

                                                $total_oee = $availbility * $performance * $quality * 100;
                                                $target_production_qty =  ($u->production_hours * 60)/$u->cycle_time ;
                                                $target_prod_wt = $u->finish_part_weight  * $u->qty;
                                                $target_runner_wt = $u->runner_weight * $u->qty;
 
                                        ?>

                                        <tr>
                                            <td><?php echo "JO-".$u->id; ?></td>
                                            <td><?php echo $u->part_number ?> /
                                                <?php echo $u->part_description ?></td>
                                            <td><?php echo $u->date ?></td>
                                            <td><?php echo $u->shift_type . "/" . $u->name; ?></td>
                                            <td><?php echo $u->machine_name; ?></td>
                                            <td><?php echo $u->operator_name; ?></td>
                                            <td><?php echo round($target_production_qty,2) ?></td>         
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
                                            <td><?php echo $u->wastage ?></td>
                                            <td><?php echo $u->status ?></td>
                                            <td><?php echo $u->production_hours ?></td>

                                            <td><?php echo $u->downtime_in_min ?></td>
                                            <!-- <td><?php echo $u->downtime_reason ?></td> -->
                                            <td><?php echo $u->setup_time_in_min ?></td>
                                            <td><?php echo $u->cycle_time ?></td>
                                            <td><?php echo $target_prod_wt ?></td>
                                            <td><?php echo $target_runner_wt ?></td>
                                            <td><?php echo $u->finish_part_weight ?></td>
                                            <td><?php echo $u->runner_weight ?></td>
                                                                          
                                            <!-- <td><?php echo $customer_part_data[0]->production_target_per_shift ?></td> AROM -105 -->
                                            <td><?php echo round($total_pde,2) ?></td>
                                            <td><?php echo round($total_qe,2) ?></td>
                                            <td><?php echo round($total_ppm,2) ?></td>
                                            <td><?php echo round($total_oee,2) ?></td>
                                            <td>
                                                <a class="btn btn-primary" href="<?php echo base_url('view_rejection_details/') . $u->id.'/'.$u->customer_part_id .'/view'?>">
                                                    <i class='far fa-edit'></i>
                                                </a>
                                            </td>
                                            <td>
                                                <a class="btn btn-primary" href="<?php echo base_url('view_downtime_details/') . $u->id.'/'.$u->customer_part_id.'/view' ?>">
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
                                                                        </div>-->
                                                                        <div class="col-lg-12">

                                                                            <div class="form-group">
                                                                                <label for="on click url">Enter Semi
                                                                                    Finished location QTY<span
                                                                                        class="text-danger">*</span></label>
                                                                                <input type="number" min="0" value="0"
                                                                                    max="" name="semi_finished_location"
                                                                                    required class="form-control">


                                                                            </div>
                                                                        </div>
                                                                        <!-- <div class="col-lg-12">

                                                                            <div class="form-group">
                                                                                <label for="on click url">Enter
                                                                                    Deflashing /
                                                                                    Assembly location<span
                                                                                        class="text-danger">*</span></label>
                                                                                <input type="number" min="0" value="0"
                                                                                    max=""
                                                                                    name="deflashing_assembly_location"
                                                                                    required class="form-control">


                                                                            </div>
                                                                        </div> -->
                                                                        <div class="col-lg-12">

                                                                            <div class="form-group">
                                                                                <label for="on click url">Enter Final
                                                                                    Inspection Qty<span
                                                                                        class="text-danger">*</span></label>
                                                                                <input type="number" min="0" value="0"
                                                                                    max=""
                                                                                    name="final_inspection_location"
                                                                                    required class="form-control">


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