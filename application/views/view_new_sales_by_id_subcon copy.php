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
                        <!-- <h1></h1> -->


                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('generate_po') ?>">Home hh</a></li>
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
                                            <button onclick="functionTest()" class="btn btn-danger mt-4">Download All
                                                Invoice </button>
                                        </div>

                                        <script>
                                            function functionTest() {
                                                setTimeout(function() {
                                                    document.getElementById("orignalInvoice").click();
                                                }, 1000);
                                                setTimeout(function() {
                                                    document.getElementById("duplicateInvoice").click();
                                                }, 2000);
                                                setTimeout(function() {
                                                    document.getElementById("triplicateInvoice").click();
                                                }, 3000);
                                                setTimeout(function() {
                                                    document.getElementById("ackInvoice").click();
                                                }, 4000);
                                                setTimeout(function() {
                                                    document.getElementById("extraaInvoice").click();
                                                }, 5000);

                                                // document.getElementById("triplicateInvoice").click();
                                                // document.getElementById("ackInvoice").click();
                                                // document.getElementById("extraaInvoice").click();
                                            }
                                        </script>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <a id="orignalInvoice" class="btn btn-success mt-4" href="<?php echo base_url('generate_sales_invoice/') . $this->uri->segment('2') . "/ORIGINAL_FOR_RECIPIENT"; ?>">Original
                                                Invoice </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <a id="duplicateInvoice" class="btn btn-success mt-4" href="<?php echo base_url('generate_sales_invoice/') . $this->uri->segment('2') . '/DUPLICATE_FOR_TRANSPORTER'; ?>">Duplicate
                                                Invoice </a>
                                        </div>
                                    </div>

                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <a id="triplicateInvoice" class="btn btn-success mt-4" href="<?php echo base_url('generate_sales_invoice/') . $this->uri->segment('2') . "/TRIPLICATE_FOR_SUPPLIER"; ?>">Triplicate
                                                Invoice </a>
                                        </div>
                                    </div>

                                    <script>

                                    </script>

                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <a id="ackInvoice" class="btn btn-success mt-4" href="<?php echo base_url('generate_sales_invoice/') . $this->uri->segment('2') . "/ACKNOWLEDGEMENT_COPY"; ?>">Acknowledge.
                                                Invoice </a>
                                        </div>
                                    </div>

                                    <div>
                                        &nbsp;
                                    </div>

                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <a id="extraaInvoice" class="btn btn-success mt-4" href="<?php echo base_url('generate_sales_invoice/') . $this->uri->segment('2') . "/EXTRA_COPY"; ?>">Extra
                                                Invoice </a>
                                        </div>
                                    </div>

                                    <div class="col-lg-2">
                                        <div class="form-group">

                                            <label for="">Sales Invoice Number <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" readonly value="<?php echo $new_sales[0]->sales_number ?>" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">PO Remark <span class="text-danger">*</span> </label>
                                            <input type="text" readonly value="<?php echo $new_sales[0]->remark ?>" class="form-control">
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
                                            <label for="">Customer Name <span class="text-danger">*</span> </label>
                                            <input type="text" readonly value="<?php echo $customer[0]->customer_name ?>" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-header">

                                <div class="row">
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <form action="<?php echo base_url('add_sales_parts_subcon'); ?>" method="post">

                                                <label for="">Select Part Number // Description // FG Stock // Rate //
                                                    Tax Structure. <span class="text-danger">*</span> </label>

                                                <select name="part_id" id="" required class="form-control select2">
                                                    <?php

                                                    if ($child_part) {
                                                        foreach ($child_part as $c) {
                                                            $array2 = array(
                                                                "id" => $c->gst_id
                                                            );
                                                            $gst_structure = $this->Crud->get_data_by_id_multiple_condition("gst_structure", $array2);
                                                           
                                                            $array3 = array(
                                                                "customer_master_id" => $c->id
                                                            );
                                                            $customer_part_rate = $this->Crud->get_data_by_id_multiple_condition("customer_part_rate", $array3);
                                                            if ($customer_part_rate) {
                                                    ?>
                                                                <option value="<?php echo $c->id ?>">
                                                                    <?php echo $c->part_number . " // " . $c->part_description . "//" . $c->fg_stock . "//" . $customer_part_rate[0]->rate . "//" . $gst_structure[0]->code ?>
                                                                </option>
                                                    <?php
                                                            }
                                                        }
                                                    }

                                                    ?>
                                                </select>
                                        </div>
                                    </div>
                                    <!-- <div class="col-lg-4">
                                        <div class="form-group">

                                            <label for="">Select Tax Strucutre Code / S-GST (%) / C-GST (%) / I-GST (%) <span class="text-danger">*</span> </label>

                                            <select name="tax_id" id="" required class="form-control select2">
                                                <?php

                                                if ($gst_structure) {
                                                    foreach ($gst_structure as $c) {
                                                ?>
                                                        <option value="<?php echo $c->id ?>"><?php echo $c->code . " / " . $c->sgst . " / " . $c->cgst . " / " . $c->igst ?></option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>


                                    </div> -->
                                    <!-- <div class="col-lg-2">
                                                                                <div class="form-group">

                                                                                        <label for="">Select UOM<span class="text-danger">*</span> </label>

                                                                                        <select name="uom_id" id="" required class="form-control select2">
                                                                                                <?php

                                                                                                if ($uom) {
                                                                                                    foreach ($uom as $c) {
                                                                                                ?>
                                                                                                                <option value="<?php echo $c->id ?>"><?php echo $c->uom_name ?></option>
                                                                                                <?php
                                                                                                    }
                                                                                                }


                                                                                                ?>
                                                                                        </select>


                                                                                </div>


                                                                        </div> -->


                                    <div class="col-lg-2">
                                        <div class="form-group">

                                            <label for="">Enter Qty <span class="text-danger">*</span> </label>
                                            <input type="number" name="qty" placeholder="Enter QTY " required class="form-control">
                                            <input type="hidden" name="sales_number" value="<?php echo $new_sales[0]->sales_number; ?>" placeholder="Enter QTY " required class="form-control">
                                            <input type="hidden" name="sales_id" value="<?php echo $new_sales[0]->id; ?>" placeholder="Enter QTY " required class="form-control">
                                            <input type="hidden" name="customer_id" value="<?php echo $customer[0]->id; ?>" placeholder="Enter QTY " required class="form-control">


                                        </div>


                                    </div>

                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <?php
                                            if ($new_sales[0]->status == "pending") {

                                            ?>


                                                <button type="submit" class="btn btn-info btn-lg mt-4">Add</button>
                                            <?php } ?>
                                        </div>


                                    </div>

                                    </form>

                                </div>

                            </div>
                            <div class="card-header">
                                <?php if ($po_parts) {
                                    if ($new_sales[0]->status == "pending") {

                                        if ($this->session->userdata['type'] == 'admin' || $this->session->userdata['type'] == 'Admin') {
                                ?>
                                            <button type="button" class="btn btn-danger ml-1" data-toggle="modal" data-target="#lock">
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

                                        <button type="button" disabled class="btn btn-success ml-1" data-toggle="modal" data-target="#accpet">
                                            Invoice Already Released
                                        </button>
                                <?php
                                    }
                                } ?>
                                <!-- Modal -->
                                <div class="modal fade" id="accpet" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Update</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                                <div class="row">
                                                    <form action="<?php echo base_url('accept_po_subcon'); ?>" method="POST">

                                                        <div class="col-lg-12">
                                                            <div class="form-group">

                                                                <label for=""><b>Are You Sure Want To Released This
                                                                        PO?</b> </label>
                                                                <input type="hidden" name="id" value="<?php echo $new_sales[0]->id ?>" required class="form-control">
                                                                <input type="hidden" name="status" value="accpet" required class="form-control">


                                                            </div>


                                                        </div>


                                                </div>






                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Update</button>

                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="modal fade" id="lock" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Update</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                                <div class="row">
                                                    <form action="<?php echo base_url('lock_invoice_subcon'); ?>" method="POST">

                                                        <div class="col-lg-12">
                                                            <div class="form-group">

                                                                <label for=""><b>Are You Sure Want To Lock This
                                                                        Invoice?</b> </label>
                                                                <input type="hidden" name="id" value="<?php echo $new_sales[0]->id ?>" required class="form-control">
                                                                <input type="hidden" name="status" value="lock" required class="form-control">


                                                            </div>


                                                        </div>


                                                </div>






                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Update</button>

                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="modal fade" id="delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                                                                <input type="hidden" name="id" value="<?php echo $new_sales[0]->id ?>" required class="form-control">
                                                                <input type="hidden" name="status" value="reject" required class="form-control">
                                                                <input type="hidden" name="table_name" value="new_po" required class="form-control">


                                                            </div>


                                                        </div>


                                                </div>






                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Update</button>

                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>




                            </div>








                            <div class="card-body">
                                <table class="table table-bordered table-striped" id="example1">
                                    <thead>

                                        <tr>
                                            <th>Sr No</th>
                                            <th>Part Number</th>
                                            <th>Part Description</th>
                                            <th>GST Strucutre Code</th>
                                            <th>UOM</th>

                                            <th>QTY</th>
                                            <th>Price</th>
                                            <th>Created Date</th>
                                            <th>Actions</th>
                                            <th>Price</th>
                                            <th>GST</th>
                                            <th>Total Price</th>
                                            <th>Challan Details</th>



                                        </tr>

                                    </thead>
                                    <tfoot>

                                        <tr>
                                            <th>Sr No</th>
                                            <th>Part Number</th>
                                            <th>Part Description</th>
                                            <th>GST Strucutre Code</th>
                                            <th>UOM</th>

                                            <th>QTY</th>
                                            <th>Price</th>
                                            <th>Created Date</th>
                                            <th>Actions</th>
                                            <th>Price</th>
                                            <th>GST</th>
                                            <th>Total Price</th>
                                            <th>Challan Details</th>


                                        </tr>

                                    </tfoot>



                                    <tbody>

                                        <?php
                                        if ($po_parts) {
                                            $final_po_amount = 0;
                                            $i = 1;
                                            foreach ($po_parts as $p) {
                                                $child_part_data = $this->Crud->get_data_by_id("customer_part", $p->part_id, "id");
                                                $gst_structure_data = $this->Crud->get_data_by_id("gst_structure", $p->tax_id, "id");

                                                $rate = 0;
                                                if (!empty($p->qty)) {
                                                    $rate  = (($p->total_rate) - ($p->cgst_amount + $p->sgst_amount + $p->igst_amount + $p->tcs_amount)) / (int)$p->qty;
                                                } else {
                                                    $rate = 0;
                                                }

                                                $total_rate_old = $rate * $p->qty;



                                                $gst_structure2 = $this->Crud->get_data_by_id("gst_structure", $p->tax_id, "id");

                                                // $cgst_amount = ($total_rate_old * $gst_structure2[0]->cgst) / 100;
                                                // $sgst_amount = ($total_rate_old * $gst_structure2[0]->sgst) / 100;
                                                // $igst_amount = ($total_rate_old * $gst_structure2[0]->igst) / 100;

                                                // if ($gst_structure2[0]->tcs_on_tax == "no") {
                                                //     $tcs_amount =   (($total_rate_old * $gst_structure2[0]->tcs) / 100);
                                                // } else {
                                                //     $tcs_amount =  ((($cgst_amount + $sgst_amount + $igst_amount + $total_rate_old) * $gst_structure2[0]->tcs) / 100);
                                                // }


                                                // $gst_amount = $cgst_amount + $sgst_amount + $igst_amount;

                                                // $total_rate = $total_rate_old + $cgst_amount + $sgst_amount + $igst_amount;
                                                $final_po_amount = $p->total_rate;


                                        ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $child_part_data[0]->part_number; ?></td>
                                                    <td><?php echo $child_part_data[0]->part_description; ?></td>
                                                    <td><?php echo $gst_structure2[0]->code; ?></td>
                                                    <td><?php echo $p->uom_id; ?></td>

                                                    <td><?php echo $p->qty; ?></td>
                                                    <td><?php
                                                        echo $rate;
                                                        ?></td>
                                                    <td><?php echo $p->created_date; ?></td>

                                                    <td>
                                                        <?php
                                                        if ($new_sales[0]->status == "pending") {
                                                        ?>
                                                            <!-- Button trigger modal -->
                                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal<?php echo $i; ?>">
                                                                Edit
                                                            </button>

                                                            <button type="button" class="btn btn-danger ml-1" data-toggle="modal" data-target="#exampleModaldelete<?php echo $i; ?>">
                                                                Delete
                                                            </button>

                                                            <!-- Modal -->
                                                            <div class="modal fade" id="exampleModal<?php echo $i; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">Update
                                                                            </h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">

                                                                            <div class="row">
                                                                                <form action="<?php echo base_url('update_sales_parts_subcon'); ?>" method="POST">
                                                                                    <!-- <div class="col-lg-12">
                                                                                        <div class="form-group">

                                                                                            <label for="">Select Tax Strucutre Code / S-GST (%) / C-GST (%) / I-GST (%) <span class="text-danger">*</span> </label>

                                                                                            <select name="tax_id" id="" required class="form-control select2">
                                                                                                <?php

                                                                                                if ($gst_structure) {
                                                                                                    foreach ($gst_structure as $c) {
                                                                                                ?>
                                                                                                        <option <?php if ($c->id == $p->tax_id) {
                                                                                                                    echo "selected";
                                                                                                                } ?> value="<?php echo $c->id ?>"><?php echo $c->code . " / " . $c->sgst . " / " . $c->cgst . " / " . $c->igst ?></option>
                                                                                                <?php
                                                                                                    }
                                                                                                }


                                                                                                ?>
                                                                                            </select>


                                                                                        </div>


                                                                                    </div> -->
                                                                                    <div class="col-lg-12">
                                                                                        <div class="form-group">

                                                                                            <label for="">Select UOM<span class="text-danger">*</span>
                                                                                            </label>

                                                                                            <select name="uom_id" id="" required class="form-control select2">
                                                                                                <?php

                                                                                                if ($uom) {
                                                                                                    foreach ($uom as $c) {
                                                                                                ?>
                                                                                                        <option <?php if ($c->id == $p->uom_id) {
                                                                                                                    echo "selected";
                                                                                                                } ?> value="<?php echo $c->uom_name; ?>">
                                                                                                            <?php echo $c->uom_name ?>
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

                                                                                            <label for="">Enter Qty <span class="text-danger">*</span>
                                                                                            </label>
                                                                                            <input type="number" name="qty" value="<?php echo $p->qty ?>" placeholder="Enter QTY " required class="form-control">
                                                                                            <input type="hidden" name="id" value="<?php echo $p->id ?>" placeholder="Enter QTY " required class="form-control">


                                                                                        </div>


                                                                                    </div>

                                                                            </div>






                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                            <button type="submit" class="btn btn-primary">Update</button>

                                                                        </div>
                                                                    </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                            <!-- Modal -->
                                                            <div class="modal fade" id="exampleModaldelete<?php echo $i; ?>" tabindex="-1" aria-labelledby="" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">Update
                                                                            </h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">

                                                                            <div class="row">
                                                                                <form action="<?php echo base_url('delete'); ?>" method="POST">

                                                                                    <div class="col-lg-12">
                                                                                        <div class="form-group">

                                                                                            <label for=""> <b>Are You Sure Want To
                                                                                                    Delete This ? </b> </label>
                                                                                            <input type="hidden" name="id" value="<?php echo $p->id ?>" required class="form-control">
                                                                                            <input type="hidden" name="table_name" value="sales_parts_subcon" required class="form-control">


                                                                                        </div>


                                                                                    </div>


                                                                            </div>






                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                            <button type="submit" class="btn btn-primary">Update</button>

                                                                        </div>
                                                                    </div>
                                                                    </form>
                                                                </div>
                                                            </div>


                                                        <?php } else {
                                                            echo "Can't Update , This  is " . $new_sales[0]->status;
                                                        }
                                                        ?>


                                                    </td>
                                                    <td><?php echo $total_rate_old; ?></td>
                                                    <td><?php echo $p->gst_amount; ?></td>
                                                    <td><?php echo $p->total_rate; ?></td>
                                                    <td>
                                                        <a class="btn btn-success" href="<?php echo base_url('add_grn_qty_subcon_view_customer_challan/').$p->id."/".$new_sales[0]->id ?>">
                                                            Challan Details
                                                        </a>
                                                    </td>

                                                </tr>
                                        <?php
                                                $i++;
                                            }
                                        }

                                        ?>



                                    </tbody>

                                    <tfoot>
                                        <?php
                                        if ($po_parts) {
                                        ?>
                                            <tr>
                                                <th colspan="11">Total</th>
                                                <th><?php echo $final_po_amount; ?></th>

                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tfoot>

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