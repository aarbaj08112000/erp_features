<div style="width:100%" class="wrapper">
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
                        <!-- <h1></h1> -->


                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
                            <li class="breadcrumb-item active"></li>
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

                                <div class="row">


                                    <div class="col-lg-2">
                                        <div class="form-group">

                                            <label for="">Sales Invoice Number <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" readonly
                                                value="<?php echo $new_sales[0]->sales_number ?>" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">PO Remark <span class="text-danger">*</span> </label>
                                            <input type="text" readonly value="<?php echo $new_sales[0]->remark ?>"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Current Status <span class="text-danger">*</span> </label>
                                            <input type="text" readonly value="<?php if ($new_sales[0]->status == "accpet") {
                                                                                    echo "Released";
                                                                                } else {
                                                                                    echo $new_sales[0]->status;
                                                                                } ?>" class="form-control">

                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Qty <span class="text-danger">*</span> </label>
                                            <input type="text" readonly value="<?php echo $new_sales[0]->qty ?>"
                                                class="form-control">


                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Price <span class="text-danger">*</span> </label>
                                            <input type="text" readonly value="<?php echo $new_sales[0]->price ?>"
                                                class="form-control">


                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">HSN Code <span class="text-danger">*</span> </label>
                                            <input type="text" readonly value="<?php echo $new_sales[0]->hsn_code ?>"
                                                class="form-control">


                                        </div>
                                    </div>
                                    <br>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Customer Name <span class="text-danger">*</span> </label>
                                            <input type="text" readonly
                                                value="<?php echo $customer[0]->customer_name ?>" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-header">
                                <?php if (true) {
                                    if ($new_sales[0]->status == "pending") {

                                        if ($this->session->userdata['type'] == 'admin' || $this->session->userdata['type'] == 'Admin') {
                                ?>
                                <button type="button" class="btn btn-danger ml-1" data-toggle="modal"
                                    data-target="#lock">
                                    Lock Invoice
                                </button>
                                <?php }
                                    }
                                } ?>
                                <?php if ($new_sales[0]->status == "lock") {
                                    if ($this->session->userdata['type'] == 'admin' || $this->session->userdata['type'] == 'Admin') {
                                ?>
                                <!-- <button type="button" class="btn btn-success ml-1" data-toggle="modal" data-target="#accpet">
                                            Accept (Released) Invoice
                                        </button>
                                        <button type="button" class="btn btn-danger ml-1" data-toggle="modal" data-target="#delete">
                                            Reject (delete) Invoice
                                        </button> -->
                                <?php
                                    }
                                } else {
                                    if ($new_sales[0]->status != "pending") {
                                    ?>

                                <button type="button" disabled class="btn btn-success ml-1" data-toggle="modal"
                                    data-target="#accpet">
                                    Invoice Already Released
                                </button>
                                <?php
                                    }
                                } ?>
                                <!-- Modal -->
                                <div class="modal fade" id="accpet" tabindex="-1" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Update</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                                <div class="row">
                                                    <form action="<?php echo base_url('accept_po'); ?>" method="POST">

                                                        <div class="col-lg-12">
                                                            <div class="form-group">

                                                                <label for=""><b>Are You Sure Want To Released This
                                                                        PO?</b> </label>
                                                                <input type="hidden" name="id"
                                                                    value="<?php echo $new_sales[0]->id ?>" required
                                                                    class="form-control">
                                                                <input type="hidden" name="status" value="accpet"
                                                                    required class="form-control">


                                                            </div>


                                                        </div>


                                                </div>






                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Update</button>

                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="modal fade" id="lock" tabindex="-1" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Update</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                                <div class="row">

                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <form
                                                                action="<?php echo base_url('lock_invoice_rejection_new'); ?>"
                                                                method="POST">

                                                                <label for=""><b>Are You Sure Want To Lock This
                                                                        Invoice?</b> </label>
                                                                <input type="hidden" name="id"
                                                                    value="<?php echo $new_sales[0]->id ?>" required
                                                                    class="form-control">
                                                                <input type="hidden" name="status" value="lock" required
                                                                    class="form-control">

                                                                <div class="col-lg-12">
                                                                    <div class="form-group">

                                                                        <input type="hidden" name="actual_qty" readonly
                                                                            value="<?php echo $new_sales[0]->qty ?>"
                                                                            class="form-control">
                                                                        <input type="hidden" name="part_number" readonly
                                                                            value="<?php echo $new_sales[0]->part_number ?>"
                                                                            class="form-control">


                                                                    </div>
                                                                </div>


                                                        </div>


                                                    </div>


                                                </div>






                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Update</button>

                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="modal fade" id="delete" tabindex="-1" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                                <div class="row">
                                                    <form action="<?php echo base_url('delete_po'); ?>" method="POST">

                                                        <div class="col-lg-12">
                                                            <div class="form-group">

                                                                <label for=""><b>Are You Sure Want To Delete This
                                                                        PO?</b> </label>
                                                                <input type="hidden" name="id"
                                                                    value="<?php echo $new_sales[0]->id ?>" required
                                                                    class="form-control">
                                                                <input type="hidden" name="status" value="reject"
                                                                    required class="form-control">
                                                                <input type="hidden" name="table_name" value="new_po"
                                                                    required class="form-control">


                                                            </div>


                                                        </div>


                                                </div>






                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Update</button>

                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>




                            </div>

                            <div class="card-header">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Select Part</label>

                                            <form action="<?php echo base_url('add_rejection_new') ?>" method="post">
                                                <select name="part_number" id="" class="form-control select2" required>
                                                    <?php
                                                    if ($new_sales[0]->type == "store_stock") {

                                                        if ($child_part_list) {
                                                            foreach ($child_part_list as $c) {
                                                    ?>
                                                    <option value="<?php echo $c->part_number ?>">
                                                        <?php echo $c->part_number ?></option>
                                                    <?php
                                                            }
                                                        }
                                                    } else {

                                                        if ($customer_part_list) {
                                                            foreach ($customer_part_list as $c) {
                                                            ?>
                                                    <option value="<?php echo $c->part_number ?>">
                                                        <?php echo $c->part_number ?></option>
                                                    <?php
                                                            }
                                                        }
                                                    }

                                                    ?>
                                                </select>


                                        </div>
                                    </div>

                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Enter Qty</label>
                                            <input type="number" step="any" max="<?php echo $new_sales[0]->qty ?>"
                                                name="qty" id="" placeholder="Enter Qty" class="form-control">
                                            <input type="hidden" value="<?php echo $new_sales[0]->type; ?>" name="type"
                                                id="" placeholder="Enter Qty" class="form-control">
                                            <input type="hidden" value="<?php echo $new_sales[0]->id; ?>"
                                                name="rejection_flow_new_id" id="" placeholder="Enter Qty"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <?php
                                            if ($new_sales[0]->status == "pending") {
                                            ?>
                                            <button type="submit" class="btn btn-danger mt-4">
                                                Add
                                            </button>
                                            <?php } ?>
                                            </form>
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sr No</th>
                                            <th>Part Number / Description</th>
                                            <th>Qty</th>


                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        if ($new_rejection_flow_parts) {
                                            $i = 1;
                                            foreach ($new_rejection_flow_parts as $u) {

                                                if ($u->type == "store_stock") {
                                                    $output_part_data = $this->Crud->get_data_by_id("child_part", $u->part_number, "part_number");
                                                } else {
                                                    $output_part_data = $this->Crud->get_data_by_id("customer_part", $u->part_number, "part_number");
                                                }




                                        ?>

                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $output_part_data[0]->part_number ?> /
                                                <?php echo $output_part_data[0]->part_description ?>/

                                            </td>
                                            <td><?php echo $u->qty ?></td>



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

                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
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