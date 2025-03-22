<div class="wrapper">

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Molding Stock Transfer</h1>
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
                                            <form action="<?php echo base_url('add_molding_stock_transfer') ?>"
                                                method="POST" enctype="multipart/form-data">
                                        </div>
                                        <div class="form-group">
                                            <label for="on click url">Select Customer Part / Molding Production Qty<span
                                                    class="text-danger">*</span></label>
                                            <select required name="customer_part_id" class="form-control select2">
                                                <?php
                                                if ($customer_part) {
                                                    foreach ($customer_part as $c) {
                                                ?>
                                                <option value="<?php echo $c->id ?>">
                                                    <?php echo $c->part_number . " / " . $c->part_description . '/' . $c->molding_production_qty; ?>
                                                </option>
                                                <?php

                                                    }
                                                }
                                                ?>


                                            </select>


                                        </div>
                                        <!-- <div class="form-group">
                                            <label for="on click url">Enter Semi Finished location QTY<span
                                                    class="text-danger">*</span></label>
                                            <input type="number" min="0" value="0" max="" name="semi_finished_location"
                                                required class="form-control">


                                        </div>
                                        <div class="form-group">
                                            <label for="on click url">Enter Deflashing / Assembly location<span
                                                    class="text-danger">*</span></label>
                                            <input type="number" min="0" value="0" max=""
                                                name="deflashing_assembly_location" required class="form-control">
                                        </div> -->
                                        <div class="form-group">
                                            <label for="on click url">Enter Final Inspection Qty<span
                                                    class="text-danger">*</span></label>
                                            <input type="number" min="0" value="0" max=""
                                                name="final_inspection_location" required class="form-control">
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
                                <!-- <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#addPromo">
                                    Add Request
                                </button> -->

                            </div>


                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sr No</th>
                                            <th>Part Number / Description</th>
                                            <!-- <th>Semi Finished Qty</th>
                                            <th>Deflashing / Assembly Qty</th> -->
                                            <th>Final Inspection Qty</th>
                                            <th>Status</th>
                                            <th>Transfer</th>
                                            <th>Date & Time</th>


                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        if ($molding_stock_transfer) {
                                            $i = 1;
                                            foreach ($molding_stock_transfer as $u) {
                                        ?>

                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $u->part_number ?> /
                                                <?php echo $u->part_description ?>/

                                            </td>
                                            <!-- <td><?php echo $u->semi_finished_location ?></td>
                                            <td><?php echo $u->deflashing_assembly_location ?></td> -->
                                            <td><?php echo $u->final_inspection_location ?></td>
                                            <td><?php echo $u->status ?></td>
                                            <td><?php if ($u->status == "pending") {
                                                        ?>
                                                <a class="btn btn-warning"
                                                    href="<?php echo base_url('molding_stock_transfer_click/') . $u->id ?>">Click
                                                    To
                                                    Transfer Stock</a>
                                                <?php
                                                        } else {
                                                            echo "Stock Transferred";
                                                        } ?>
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