<div class="wrapper">

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Final Inspection Request</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
                            <li class="breadcrumb-item active">Final Inspection</li>
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
                                            <form
                                                action="<?php echo base_url('add_molding_final_inspection_location') ?>"
                                                method="POST" enctype="multipart/form-data">
                                        </div>
                                        <div class="form-group">
                                            <label for="on click url">Select Customer Part / Final Inspection Qty<span
                                                    class="text-danger">*</span></label>
                                            <select required name="customer_part_id" class="form-control select2">
                                                <?php
                                                if ($customer_parts_master) {
                                                    foreach ($customer_parts_master as $c) {

                                                ?>
                                                <option value="<?php echo $c->id ?>">
                                                    <?php echo $c->part_number . " / " . $c->part_description . ' / ' . $c->final_inspection_location; ?>
                                                </option>
                                               <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="on click url">Qty<span class="text-danger">*</span></label>
                                            <input type="number" min="1" value="1" max="" name="qty" required
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
                                    Add Request
                                </button>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sr No</th>
                                            <th>Part Number / Description</th>
                                            <th>Qty</th>
                                            <th>Status</th>
                                            <th>Transfer</th>
                                            <th>Date & Time</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        if ($final_inspection_request) {
                                            $i = 1;
                                            foreach ($final_inspection_request as $u) {
                                                $output_part_data = $this->Crud->get_data_by_id("customer_parts_master", $u->customer_part_id, "id");
                                        ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $u->part_number ?> /
                                                <?php echo $u->part_description ?>/
                                            </td>
                                            <td><?php echo $u->qty ?></td>
                                            <td><?php echo $u->status ?></td>
                                            <td><?php if ($u->status == "pending") {
                                                            if ($u->qty <= $u->final_inspection_location) {
                                                        ?>
                                                <a class="btn btn-warning"
                                                    href="<?php echo base_url('final_inspection_stock_transfer_click/') . $u->id ?>">Click
                                                    To
                                                    Transfer Stock</a>
                                                <?php
                                                            } else {
                                                                echo "please add final Inspection stock";
                                                            }
                                                        } else {
                                                            echo "Stock Transferred";
                                                        }
                                                        ?>
                                            </td>
                                            <td><?php echo $u->created_date . " / " . $u->created_time ?></td>
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