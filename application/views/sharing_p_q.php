<div class="wrapper">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Sharing Production Qty</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
                            <li class="breadcrumb-item active">Production Qty</li>
                        </ol>
                    </div>

                </div>
            </div>
        </section>
        <section class="content">
            <div>
                <div class="row"><br>
                    <div class="col-lg-12">
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
                                            <form action="<?php echo base_url('add_production_qty_sharing') ?>"
                                                method="POST" enctype="multipart/form-data">
                                        </div>
                                        <div class="form-group">
                                            <label for="on click url">Select Shift Type / Name / Start Time / End Time<span class="text-danger">*</span></label>
                                            <select required name="shift_id" id="shift" class="form-control select2">
                                                <option value="">Select</option>
                                                <?php
                                                if ($shifts) {
                                                    foreach ($shifts as $s) {
                                                ?>
                                                <option value="<?php echo $s->id ?>">
                                                    <?php echo $s->shift_type . " / " . $s->name . " / " . $s->start_time . " / " . $s->end_time; ?>
                                                </option>
                                                <?php }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="on click url">Select Operator <span class="text-danger">*</span></label>
                                            <select name="operator_id" id="operator" class="form-control select2" required>
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
                                        <div class="form-group">
                                            <label for="on click url">Select Machine<span
                                                    class="text-danger">*</span></label>
                                            <select required name="machine_id" id="machine" class="form-control select2">
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
                                        <div class="form-group">
                                            <label for="on click url">Enter Date<span
                                                    class="text-danger">*</span></label>
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
                                    Add Sharing Production Qty
                                </button>
                            </div>
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sr No</th>
                                            <th>Date</th>
                                            <th>Shift</th>
                                            <th>Machine</th>
                                            <th>Operator</th>
                                            <th>View Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($sharing_p_q) {
                                            $i = 1;
                                            foreach ($sharing_p_q as $u) {
                                        ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $u->date ?></td>
                                            <td><?php echo $u->shift_type; ?></td>
                                            <td><?php echo $u->machine_name; ?></td>
                                            <td><?php echo $u->op_name; ?></td>
                                            <td>
                                                <a class="btn btn-info"
                                                    href="<?php echo base_url('details_production_qty_sharing/') . $u->id ?>">
                                                    Add Output Parts</a>
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
            </div>
        </section>
   </div>