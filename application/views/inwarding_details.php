<?php
    $isMultiClient = $this->session->userdata['isMultipleClientUnits'];
?>
<div  class="wrapper">
    <!-- Navbar -->
    <!-- /.navbar -->
    <!-- Main Sidebar Container -->
    <?php
    $arr = array(
        'inwarding_id' => $inwarding_data[0]->id,
        'invoice_number' => $inwarding_data[0]->invoice_number,
    );

    $invoice_amount = $inwarding_data[0]->invoice_amount;
    $grn_details_data = $this->Crud->get_data_by_id_multiple("grn_details", $arr);
    pr($grn_details_data,1);
    $actual_price = 0;
    foreach ($grn_details_data as $g) {
        $actual_price = $actual_price + $g->inwarding_price;
    }
    $actual_price = $actual_price + $new_po[0]->final_amount;
    $minus_price = $actual_price - 1;
    $plus_price = $actual_price + 1;

    if ($actual_price != 0) {
        if ($invoice_amount >= $minus_price) {
            if ($invoice_amount <= $plus_price) {
                $status = "verifed";
            } else {
                $status = "not-verifed";
            }
        } else {
            $status = "not-verifed";
        }
    } else {
        $status = "not-verifed";
    }
    ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Inwarding Details</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('generate_po') ?>">Home</a></li>
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
                                            <label for="">GRN Number</label>
                                            <input type="text" readonly value="<?php
                                                                                if ($status == "verifed") {
                                                                                    echo $inwarding_data[0]->grn_number;
                                                                                } else {
                                                                                    echo "";
                                                                                }
                                                                                ?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">PO Number</label>
                                            <input type="text" readonly value="<?php echo $new_po[0]->po_number ?>"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">PO Date</label>
                                            <input type="text" readonly value="<?php echo $new_po[0]->po_date ?>"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">PO Status</label>
                                            <input type="text" readonly value="<?php if ($new_po[0]->status == "accpet") {
                                                                                    echo "Released";
                                                                                } else {
                                                                                    echo $new_po[0]->status;
                                                                                } ?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Supplier Name</label>
                                            <input type="text" readonly
                                                value="<?php echo $supplier[0]->supplier_name ?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Supplier Number</label>
                                            <input type="text" readonly
                                                value="<?php echo $supplier[0]->supplier_number ?>"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Supplier GST</label>
                                            <input type="text" readonly value="<?php echo $supplier[0]->gst_number ?>"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Inwarding Status</label>
                                            <input type="text" readonly
                                                value="<?php echo $inwarding_data[0]->status; ?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Invoice Number</label>
                                            <input type="text" readonly
                                                value="<?php echo $inwarding_data[0]->invoice_number; ?>"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Invoice Amount</label>
                                            <input type="text" readonly
                                                value="<?php echo $inwarding_data[0]->invoice_amount; ?>"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="">Software Calculated Amount</label>
                                            <input type="text" readonly value="<?php echo $actual_price; ?>"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="">Invoice Amount Validation Status</label>
                                            <input type="text" readonly value="<?php echo $status; ?>"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <?php if($isMultiClient == "true") { ?>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Delivery Location</label>
                                            <input type="label" readonly value="<?php echo $inwarding_data[0]->delivery_unit; ?>"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <?php } ?>
									<div class="col-lg-3">
										<div class="form-group">
											<a class="btn btn-dark mt-4"
                                                href="<?php echo base_url('inwarding_invoice/') . $new_po_id; ?>">
                                                < Back </a> &nbsp;
                                            <?php
                                            if ($status == "not-verifed") {
                                            ?>
                                            <button type="button" class="btn btn-primary mt-4" data-toggle="modal"
                                                data-target="#exampleModalmatch">
                                                Match Invoice Amount </button>
                                            <?php

                                            }

                                            if ($inwarding_data[0]->status == "accepted") {

                                                echo "<button class='btn btn-primary mt-4' disabled>Inwarding Already Accepted</button>";
                                            } else if ($status == "verifed") {
                                                if ($inwarding_data[0]->status == "pending" || $inwarding_data[0]->status == "") {
                                                ?>
                                            <button type="button" class="btn btn-danger mt-4" data-toggle="modal"
                                                data-target="#exampleModalgenerate">
                                                Generate GRN </button>
                                            <?php
                                                }  }
                                                ?>
                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModalmatch" tabindex="-1" role="dialog"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg " role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Match Price.
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form
                                                                action="<?php echo base_url('validate_invoice_amount') ?>"
                                                                method="POST">
                                                                <div class="row">
                                                                    <div class="col-lg-12">
                                                                        <div class="form-group">
                                                                            <label> Invoice Amount </label><span
                                                                                class="text-danger">*</span>
                                                                            <input type="number" step="any"
                                                                                name="invoice_amount"
                                                                                placeholder="Invoice Amount"
                                                                                value="" class="form-control">
                                                                            <input type="hidden" name="inwarding_id"
                                                                                value="<?php echo $inwarding_id; ?>"
                                                                                class="form-control">
                                                                            <input type="hidden" name="actual_price"
                                                                                value="<?php echo $actual_price; ?>"
                                                                                class="form-control">
                                                                            <input type="hidden" name="minus_price"
                                                                                value="<?php echo $minus_price; ?>"
                                                                                class="form-control">
                                                                            <input type="hidden" name="plus_price"
                                                                                value="<?php echo $plus_price; ?>"
                                                                                class="form-control">
                                                                            <input type="hidden" name="actual_price"
                                                                                value="<?php echo $status; ?>"
                                                                                class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Save
                                                                        Changes</button>
                                                                </div>
                                                            </form>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal fade" id="exampleModalgenerate" tabindex="-1"
                                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog " role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Generate GRN
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form
                                                                action="<?php echo base_url('generate_grn') ?>"
                                                                method="POST">
                                                                <div class="row">
                                                                    <div class="col-lg-12">
                                                                        <div class="form-group">
                                                                            <label> Are You Sure Want To Generate GRN ?
                                                                            </label>
                                                                            <input type="hidden" name="status"
                                                                                placeholder="" value="generate_grn"
                                                                                class="form-control">
                                                                            <input type="hidden" name="inwarding_id"
                                                                                value="<?php echo $inwarding_id; ?>"
                                                                                class="form-control">

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Save
                                                                        Changes</button>
                                                                </div>
                                                            </form>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
                                            <th>UOM</th>
                                            <th>PO QTY</th>
                                            <th>Balance QTY</th>
                                            <th>Price</th>
                                            <th>Inwarding Qty</th>
                                            <th>Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($po_parts) {
                                            $final_po_amount = 0;
                                            $i = 1;
                                            foreach ($po_parts as $p) {

                                                //It will  select all matching child part master as we have multiple child part master for single child part id
                                                $data = array(
                                                    "child_part_id" => $p->part_id,
                                                    "supplier_id" =>  $supplier[0]->id

                                                );
                                                $child_part_data = $this->Crud->get_data_by_id_multiple_condition("child_part_master", $data);
                                                pr($this->db->last_query(),1);
                                                $gst_structure_data = $this->Crud->get_data_by_id("gst_structure", $p->tax_id, "id");
                                                $uom_data = $this->Crud->get_data_by_id("uom", $p->uom_id, "id");

                                                $part_rate_new = 0;
                                                if (empty($p->rate)) {
                                                    $part_rate_new = $child_part_data[0]->part_rate;
                                                } else {
                                                    $part_rate_new = $p->rate;
                                                }

                                                //here we are only geting rate of only one from above list
                                                $total_rate = $part_rate_new * $p->qty;
                                                $final_po_amount = $final_po_amount + $total_rate;

                                                $arr = array(
                                                    'inwarding_id' => $inwarding_id,
                                                    'part_id' => $p->part_id,
                                                    'po_number' => $new_po_id,
                                                    'invoice_number' => $inwarding_data[0]->invoice_number,
                                                );
                                                $grn_details_data = $this->Crud->get_data_by_id_multiple("grn_details", $arr);

                                                if ($grn_details_data) {
                                                    $data_present = "yes";
                                                } else {
                                                    $data_present = "no";
                                                }

                                                $subcon_po_inwarding_data = array(
                                                    'po_id' => $p->po_id,
                                                    'main_sub_con_part_id' => $p->part_id,
                                                    "invoice_number" => $inwarding_data[0]->invoice_number

                                                );
                                                $subcon_po_inwarding_master = $this->Crud->get_data_by_id_multiple("subcon_po_inwarding", $subcon_po_inwarding_data);
                                                if (empty($new_po[0]->process_id)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $p->id; ?></td>
                                            <td><?php echo $child_part_data[0]->part_number; ?></td>
                                            <td><?php echo $child_part_data[0]->part_description; ?></td>
                                            <td><?php echo $uom_data[0]->uom_name; ?></td>
                                            <td><?php echo $p->qty; ?></td>
                                            <td><?php echo $p->pending_qty; ?></td>
                                            <td><?php echo $part_rate_new; ?></td>
                                            <td>
                                                <?php
                                                            if ($inwarding_data[0]->status == "accepted") {
                                                                echo $grn_details_data[0]->qty;
                                                            } else if ($data_present == "yes") {
                                                                echo $grn_details_data[0]->qty;
                                                            } else if($inwarding_data[0]->status == "generate_grn"){
                                                                echo "NA";
                                                            } else {
                                                            ?>
                                                <form action="<?php echo base_url('add_grn_qty') ?>" method="post">
                                                    <input type="number" required step="any"
                                                        max="<?php echo $p->pending_qty; ?>"
                                                        placeholder="Inwarding Qty"
                                                        name="qty"
                                                        class="form-control">
                                                    <input type="hidden" name="inwarding_id"
                                                        value="<?php echo $inwarding_id ?>" class="form-control">
                                                    <input type="hidden" 
                                                        name="new_po_id" value="<?php echo $new_po_id ?>"
                                                        class="form-control">
                                                    <input type="hidden" 
                                                        name="part_id" value="<?php echo $p->part_id ?>"
                                                        class="form-control">
                                                    <input type="hidden" 
                                                        name="invoice_number"
                                                        value="<?php echo $inwarding_data[0]->invoice_number ?>"
                                                        class="form-control">
                                                    <input type="hidden" 
                                                        name="grn_number"
                                                        value="<?php echo $inwarding_data[0]->grn_number ?>"
                                                        class="form-control">
                                                    <input type="hidden" 
                                                        name="po_part_id" value="<?php echo $p->id ?>"
                                                        class="form-control">
                                                    <input type="hidden" 
                                                        name="pending_qty" value="<?php echo $p->pending_qty ?>"
                                                        class="form-control">
                                                    <input type="hidden" 
                                                        name="part_rate" value="<?php echo $part_rate_new ?>"
                                                        class="form-control">
                                                    <input type="hidden"  name="tax_id"
                                                        value="<?php echo $p->tax_id ?>" class="form-control">
                                                    <input type="hidden" name="invoice_number"
                                                        value="<?php echo $invoice_number; ?>" class="form-control">
                                                    <?php
                                                            }
                                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                            if ($data_present == "yes" && $status != "verifed") {
                                                               ?>
                                                               <button type="button" class="btn btn-primary " title="Update" data-toggle="modal" data-target="#exampleModa<?php echo $i; ?>l">
                                                                <i class="fa fa-edit"></i>
                                                                </button>
                                                                <div class="modal fade" id="exampleModa<?php echo $i; ?>l" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog " role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">Update Details</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                        <form action="<?php echo base_url('edit_grn_qty') ?>" method="POST">
                                                                                <div class="row">
                                                                                    <div class="col-lg-12">
                                                                                        <div class="form-group">
                                                                                            <label> Inwarding Qty </label><span class="text-danger">*</span>
                                                                                            <input type="number" required step="any"
                                                                                                    max="<?php echo $p->pending_qty; ?>"
                                                                                                    name="qty"
                                                                                                    value="<?php echo $grn_details_data[0]->qty; ?>"
                                                                                                    class="form-control">
                                                                                                <input type="hidden" 
                                                                                                    name="inwarding_id"
                                                                                                    value="<?php echo $inwarding_id ?>" class="form-control">
                                                                                                <input type="hidden" 
                                                                                                    name="new_po_id" value="<?php echo $new_po_id ?>"
                                                                                                    class="form-control">
                                                                                                <input type="hidden" 
                                                                                                    name="part_id" value="<?php echo $p->part_id ?>"
                                                                                                    class="form-control">
                                                                                                <input type="hidden" 
                                                                                                    name="invoice_number"
                                                                                                    value="<?php echo $inwarding_data[0]->invoice_number ?>"
                                                                                                    class="form-control">
                                                                                                <input type="hidden" 
                                                                                                    name="grn_number"
                                                                                                    value="<?php echo $inwarding_data[0]->grn_number ?>"
                                                                                                    class="form-control">
                                                                                                <input type="hidden" 
                                                                                                    name="po_part_id" value="<?php echo $p->id ?>"
                                                                                                    class="form-control">
                                                                                                <input type="hidden" 
                                                                                                    name="part_rate" value="<?php echo $part_rate_new ?>"
                                                                                                    class="form-control">
                                                                                                <input type="hidden" 
                                                                                                    name="pending_qty" value="<?php echo $p->pending_qty ?>"
                                                                                                    class="form-control">
                                                                                                <input type="hidden"  
                                                                                                    name="tax_id"
                                                                                                    value="<?php echo $p->tax_id ?>" class="form-control">
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                                            <button type="submit" class="btn btn-primary">Save</button>
                                                                                        </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php 
                                                                } else if ($status == "not-verifed") {
                                                            ?>
                                                <button type="submit" class="btn btn-info">Submit</button>
                                                </form>
                                                <?php
                                                            }
                                                            ?>
                                            </td>
                                        </tr>
                                        <?php
                                                } else {
                                                ?>
                                        <tr>
                                            <td><?php echo $i;  ?></td>
                                            <td><?php echo $child_part_data[0]->part_number; ?></td>
                                            <td><?php echo $child_part_data[0]->part_description; ?></td>
                                            <td><?php echo $uom_data[0]->uom_name; ?></td>
                                            <td><?php echo $p->qty; ?></td>
                                            <td><?php echo $p->pending_qty; ?></td>
                                            <td><?php echo $part_rate_new; ?></td>
                                            <td>
                                                <?php
                                                            if ($inwarding_data[0]->status == "accepted") {
                                                                echo $grn_details_data[0]->qty;
                                                            } else if ($data_present == "yes") {
                                                                echo $grn_details_data[0]->qty;
                                                            } else {
                                                            ?>
                                                <?php
                                                    if (empty($subcon_po_inwarding_master[0]->inwarding_qty)) {
                                                ?>
                                                <form action="<?php echo base_url('add_grn_qty_subcon_view') ?>"
                                                    method="post">

                                                    <input type="number" required step="any" 
                                                        max="<?php echo $p->pending_qty; ?>"
                                                        placeholder="Inwarding Qty" name="qty"
                                                        class="form-control">
                                                    <input type="hidden" name="inwarding_id"
                                                        value="<?php echo $inwarding_id ?>" class="form-control">
                                                    <input type="hidden" placeholder="Inwarding Qty"
                                                        name="new_po_id" value="<?php echo $new_po_id ?>"
                                                        class="form-control">
                                                    <input type="hidden" placeholder="Inwarding Qty"
                                                        name="part_id_new"
                                                        value="<?php echo $child_part_data[0]->child_part_id ?>"
                                                        class="form-control">
                                                    <input type="hidden" placeholder="Inwarding Qty"
                                                        name="part_id" value="<?php echo $p->part_id ?>"
                                                        class="form-control">
                                                    <input type="hidden" placeholder="number invoice"
                                                        name="invoice_number"
                                                        value="<?php echo $inwarding_data[0]->invoice_number ?>"
                                                        class="form-control">
                                                    <input type="hidden" placeholder="Inwarding Qty"
                                                        name="grn_number"
                                                        value="<?php echo $inwarding_data[0]->grn_number ?>"
                                                        class="form-control">
                                                    <input type="hidden" placeholder="Inwarding Qty"
                                                        name="po_part_id" value="<?php echo $p->id ?>"
                                                        class="form-control">
                                                    <input type="hidden" placeholder="Inwarding Qty"
                                                        name="pending_qty" value="<?php echo $p->pending_qty ?>"
                                                        class="form-control">
                                                    <input type="hidden" placeholder="Inwarding Qty"
                                                        name="part_rate" value="<?php echo $part_rate_new ?>"
                                                        class="form-control">
                                                    <input type="hidden" placeholder="Inwarding Qty" name="tax_id"
                                                        value="<?php echo $p->tax_id ?>" class="form-control">
                                                    <?php
                                                                } else {
                                                                    echo $subcon_po_inwarding_master[0]->inwarding_qty;
                                                                }
                                                                    ?>
                                                    <?php
                                                            }
                                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                            if ($subcon_po_inwarding_master) {
                                                            ?>
                                                <a class="btn btn-info"
                                                    href="<?php echo base_url('grn_subcon_view/') . $p->part_id . "/" . $new_po_id . "/" . $inwarding_data[0]->id . "/" . $p->part_id; ?>"><i class="fas fa-eye"></i></a>
												<?php
                                                            } else if ($data_present == "yes") {
                                                                echo "";
                                                            } else if ($status == "not-verifed") {
                                                            ?>
                                                <button type="submit" class="btn btn-info">Submit</button>
                                                </form>
                                                <?php
                                                            }
                                                            ?>
                                            </td>
                                        </tr>
                                        <?php
                                                }

                                                ?>
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