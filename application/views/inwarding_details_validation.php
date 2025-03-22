<?php
    $isMultiClient = $this->session->userdata['isMultipleClientUnits'];
?>
<div style='width:1600px' class="wrapper">
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
                        <h1>Validation Details </h1>
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
                                    <div class="col-lg-1">
                                        <div class="form-group">
                                                <a class="btn btn-dark" href="<?php echo base_url('grn_validation'); ?>">
                                                    < Back</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">GRN Number <span class="text-danger">*</span> </label>
                                            <input type="text" readonly
                                                value="<?php echo $inwarding_data[0]->grn_number ?>"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">PO Number</label>
                                            <input type="text" readonly value="<?php echo $new_po[0]->po_number ?>"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-1">
                                        <div class="form-group">
                                            <label for="">PO Date</label>
                                            <input type="text" readonly value="<?php echo $new_po[0]->po_date ?>"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-1">
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
                                    <div class="col-lg-1">
                                       <div class="form-group">
                                            <label for="">Supplier No</label>
                                            <input type="text" readonly
                                                value="<?php echo $supplier[0]->supplier_number ?>"
                                                class="form-control">
                                        </div>
                                   </div>
                                   <div>
                                    <div class="row">
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
                                    <?php if($isMultiClient == "true") { ?>
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <label for="">Delivery Location</label>
                                                <input type="text" readonly
                                                    value="<?php echo $inwarding_data[0]->delivery_unit; ?>"
                                                    class="form-control">
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Invoice Amount</label>
                                            <input type="text" readonly
                                                value="<?php echo $inwarding_data[0]->invoice_amount; ?>"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <?php
                                            $arr = array(
                                                'inwarding_id' => $inwarding_data[0]->id,
                                                'invoice_number' => $inwarding_data[0]->invoice_number,

                                            );
                                            $invoice_amount = $inwarding_data[0]->invoice_amount;
                                            // $inwarding_data = $this->Crud->get_data_by_id_multiple("inwarding", $arr);
                                            $grn_details_data = $this->Crud->get_data_by_id_multiple("grn_details", $arr);
                                            $actual_price = 0;
                                            foreach ($grn_details_data as $g) {
                                                $actual_price = $actual_price + $g->inwarding_price;
                                            }
                                            // $cgst_amount = ($actual_price*$gst_structure[0]->cgst)/100;
                                            // $sgst_amount = ($actual_price*$gst_structure[0]->sgst)/100;
                                            // $igst_amount = ($actual_price*$gst_structure[0]->igst)/100;
                                            // $actual_price = $actual_price + $cgst_amount +$sgst_amount+$igst_amount;
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
                                    <!-- <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="">Software Calculated Amount</label>
                                            This code block is moved above.
                                            <input type="text" readonly value="<?php echo $actual_price; ?>"
                                                class="form-control">
                                        </div>
                                    </div> -->
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="">Invoice Amount Validation Status <span
                                                    class="text-danger">*</span> </label>
                                            <input type="text" readonly value="<?php echo $status; ?>"
                                                class="form-control">
                                       </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <!-- <button type="button" class="btn btn-primary mt-4" data-toggle="modal" data-target="#exampleModalgenerate">
                                                                               Validate  GRN </button> -->
                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg " role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Accept This
                                                                Inwarding </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form
                                                                action="<?php echo base_url('accept_inwarding_data') ?>"
                                                                method="POST">
                                                                <div class="row">
                                                                    <div class="col-lg-12">
                                                                        <div class="form-group">
                                                                            <label> Are You Sure Want To Accept This
                                                                                Inwarding ? This Data can't be changed
                                                                                once it's Submit</label><span
                                                                                class="text-danger">*</span>
                                                                            <input type="hidden" name="inwarding_id"
                                                                                value="<?php echo $inwarding_id; ?>"
                                                                                class="form-control">
                                                                            <input type="hidden" name="invoice_number"
                                                                                value="<?php echo $invoice_number; ?>"
                                                                                class="form-control">
                                                                        </div>
                                                                </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Save
                                                                        changes</button>
                                                                </div>
                                                            </form>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal fade" id="exampleModalmatch" tabindex="-1" role="dialog"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg " role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Match Price
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
                                                                            <input type="number" name="invoice_amount"
                                                                                placeholder="Invoice Amount"
                                                                                value="" class="form-control">
                                                                            <input type="hidden" name="inwarding_id"
                                                                                value="<?php echo $inwarding_id; ?>"
                                                                                class="form-control">
                                                                            <input type="hidden" name="actual_price"
                                                                                value="<?php echo $actual_price; ?>"
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
                                                                        changes</button>
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
                                                            <h5 class="modal-title" id="exampleModalLabel">Validate GRN
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form
                                                                action="<?php echo base_url('update_status_grn_inwarding') ?>"
                                                                method="POST">
                                                                <div class="row">
                                                                    <div class="col-lg-12">
                                                                        <div class="form-group">
                                                                            <label> Are You Sure Want To Validate GRN ?
                                                                            </label>
                                                                            <input type="hidden" name="status"
                                                                                placeholder="" value="validate_grn"
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
                                                                        changes</button>
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
                                            <!-- <th>Tax Strucutre Code</th> -->
                                            <th>UOM</th>
                                            <!-- <th>Delivery Date</th> -->
                                            <!-- <th>Expiry Date</th> -->
                                            <th>PO QTY</th>
                                            <th>Balance QTY</th>
                                            <th>Price</th>
                                            <th>Inwarding Qty</th>
                                            <th>GRN Validation Qty</th>
                                            <th>Submit </th>
                                            <th>MDR</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $i = 1;
                                        $j = 1;
                                        if ($po_parts) {
                                            $final_po_amount = 0;

                                            foreach ($po_parts as $p) {
                                                $child_part = $this->Crud->get_data_by_id("child_part", $p->part_id, "id");
                                                $child_part_data = $this->Crud->get_data_by_id("child_part_master", $p->part_id, "child_part_id");
                                                $gst_structure_data = $this->Crud->get_data_by_id("gst_structure", $p->tax_id, "id");
                                                $uom_data = $this->Crud->get_data_by_id("uom", $p->uom_id, "id");

                                                $part_rate_new = 0;
                                                if (empty($p->rate)) {
                                                    $part_rate_new = $child_part_data[0]->part_rate;
                                                } else {
                                                    $part_rate_new = $p->rate;
                                                }
                                                $total_rate = $part_rate_new * $p->qty;
                                                $final_po_amount = $final_po_amount + $total_rate;


                                                $arr1 = array(
                                                    'inwarding_id' => $inwarding_id,
                                                    'part_id' => $p->part_id,
                                                    'po_number' => $new_po_id,
                                                    'invoice_number' => $inwarding_data[0]->invoice_number,
                                           //         'grn_number' => $inwarding_data[0]->grn_number,
                                                );
                                                $grn_details_data = $this->Crud->get_data_by_id_multiple("grn_details", $arr1);

                                                //var_dump($grn_details_data);
                                                $arr2 = array(
                                                    'supplier_id' => $supplier[0]->id,
                                                    'part_id' => $p->part_id,
                                                    'po_number' => $new_po[0]->po_number,
                                                    'type' => "MDR",
                                                    'grn_number' => $inwarding_data[0]->grn_number,
                                                );
                                                // print_r($arr2);
                                                $rejection_flow_data = $this->Crud->get_data_by_id_multiple("rejection_flow", $arr2);
                                                // print_r($rejection_flow_data);
                                                // print_r($rejection_flow_data);
                                                if ($grn_details_data) {
                                                    if ($grn_details_data) {
                                                        $data_present = "yes";
                                                    } else {
                                                        $data_present = "no";
                                                    }
                                        ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $child_part[0]->part_number; ?></td>
                                            <td><?php echo $child_part[0]->part_description; ?></td>
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

                                                <form action="<?php echo base_url('add_grn_qty') ?>" method="post">

                                                    <input type="number" data-max="<?php echo $p->pending_qty; ?>"
                                                        placeholder="Inwarding Qty2" name="qty" step="any"
                                                        class="form-control">
                                                    <input type="hidden" name="inwarding_id"
                                                        value="<?php echo $inwarding_id ?>" class="form-control">
                                                    <input type="text" placeholder="Inwarding Qty"
                                                        name="new_po_id" value="<?php echo $new_po_id ?>"
                                                        class="form-control">
                                                    <input type="hidden" placeholder="Inwarding Qty"
                                                        name="part_id" value="<?php echo $p->part_id ?>"
                                                        class="form-control">
                                                    <input type="hidden" placeholder="Inwarding Qty"
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
                                                        name="part_rate" value="<?php echo $part_rate_new ?>"
                                                        class="form-control">
                                                    <input type="hidden" placeholder="Inwarding Qty" name="tax_id"
                                                        value="<?php echo $p->tax_id ?>" class="form-control">
                                                    <input type="hidden" placeholder="Inwarding Qty"
                                                        name="loading_unloading"
                                                        value="<?php echo $new_po[0]->loading_unloading ?>"
                                                        class="form-control">
                                                    <input type="hidden" placeholder="Inwarding Qty"
                                                        name="loading_unloading_gst"
                                                        value="<?php echo $new_po[0]->loading_unloading_gst ?>"
                                                        class="form-control">
                                                    <input type="hidden" placeholder="Inwarding Qty"
                                                        name="freight_amount"
                                                        value="<?php echo $new_po[0]->freight_amount ?>"
                                                        class="form-control">
                                                    <input type="hidden" placeholder="Inwarding Qty"
                                                        name="freight_amount_gst"
                                                        value="<?php echo $new_po[0]->freight_amount_gst ?>"
                                                        class="form-control">
                                                    <?php
                                                            }
                                                                ?>
                                            </td>

                                            <td>
                                                <?php
                                                           if (empty($grn_details_data[0]->verified_qty)) {
                                                            //echo "hello : ".$grn_details_data[0]->verified_qty;
                                                            ?>

                                                <form action="<?php echo base_url('update_grn_qty') ?>" method="post">
                                                    <input style="width: 200px ;" type="number"
                                                        data-max="<?php echo $grn_details_data[0]->qty; ?>"
                                                        step="any" placeholder="Qty" name="verified_qty"
                                                        class="form-control input-group-sm">
                                                    <input type="hidden"
                                                        value="<?php echo $grn_details_data[0]->qty; ?>"
                                                        placeholder="GRN Validation Qty" name="privious_qty"
                                                        class="form-control">
                                                    <input type="hidden" name="grn_details_id"
                                                        value="<?php echo $grn_details_data[0]->id; ?>"
                                                        class="form-control">
                                                    <input type="hidden" placeholder="Inwarding Qty"
                                                        name="part_rate" value="<?php echo $part_rate_new ?>"
                                                        class="form-control">
                                                    <input type="hidden" placeholder="Inwarding Qty" name="tax_id"
                                                        value="<?php echo $p->tax_id ?>" class="form-control">
                                                    <?php

                                                            } else {
                                                                echo $grn_details_data[0]->verified_qty;
                                                            }
                                                                ?>
                                            </td>
                                            <td>
                                                <?php

                                                            $diff = (float)$grn_details_data[0]->qty - (float)$grn_details_data[0]->verified_qty;
                                                            if (empty($grn_details_data[0]->verified_qty) || $grn_details_data[0]->verified_qty == 0) {
                                                            ?>
                                                <button type="submit" class="btn btn-info">Submit</button>
                                                </form>

                                                <?php


                                                            } else if ($diff > 0) {
                                                                //  echo $grn_details_data[0]->verified_qty;
                                                                if ($rejection_flow_data) {
                                                                    $j++;
                                                                }
                                                            } else {
                                                                $j++;
                                                            }




                                                            ?>
                                            </td>
                                            <td>
                                                
                                                <?php
                                                            if ($rejection_flow_data) {
                                                            ?>
                                                <a class="btn btn-success"
                                                    href="<?php echo base_url('create_debit_note/') . $rejection_flow_data[0]->id ?>">Download
                                                    Debit Note</a>
                                                <br>
                                                <br>
                                                <a class="btn btn-danger"
                                                    href="<?php echo base_url('documents/') . $rejection_flow_data[0]->debit_note ?>"
                                                    download>Download Uploaded Ack </a>

                                                <?php
                                                            } else {

                                                                if ($grn_details_data) {
                                                                    if ($grn_details_data[0]->qty != $grn_details_data[0]->verified_qty) {
                                                                ?>
                                                <button type="button" class="btn btn-warning float-left"
                                                    data-toggle="modal" data-target="#exampleModal123<?Php echo $i; ?>">
                                                    Add MDR
                                                </button>
                                                <?php } else {
                                                                        echo "Qty Matched";
                                                                    }
                                                                }
                                                            } ?>

                                                <div class="modal fade" id="exampleModal123<?Php echo $i; ?>"
                                                    tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                                                                    action="<?php echo base_url('add_rejection_flow') ?>"
                                                                    method="POST" enctype='multipart/form-data'>
                                                                    <div class="row">
                                                                        <div class="col-lg-12">
                                                                            <div class="form-group">
                                                                                <label for="po_num">Selected Part Number
                                                                                    / Description / Stock </label><span
                                                                                    class="text-danger">*</span>
                                                                                <input type="text" class="form-control"
                                                                                    value="<?php echo $child_part_data[0]->part_number ?>"
                                                                                    name="" readonly required="required"
                                                                                    id="">
                                                                                <input type="hidden"
                                                                                    value="<?php echo $child_part[0]->id ?>"
                                                                                    name="part_id" readonly
                                                                                    required="required" id="">

                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="po_num">Selected
                                                                                    Supplier</label><span
                                                                                    class="text-danger">*</span>
                                                                                <input type="text" readonly
                                                                                    value="<?php echo $supplier[0]->supplier_name ?>"
                                                                                    class="form-control">
                                                                                <input type="hidden" readonly
                                                                                    value="<?php echo $supplier[0]->id ?>"
                                                                                    name="supplier_id"
                                                                                    class="form-control">

                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="po_num">Reason <span
                                                                                        class="text-danger">*</span></label>
                                                                                <input type="text" name="reason"
                                                                                    required placeholder="Reason"
                                                                                    class="form-control">
                                                                                <input type="hidden" name="type"
                                                                                    value="MDR" required
                                                                                    placeholder="Reason"
                                                                                    class="form-control">

                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label for="po_num">Upload MDR TPT ACK
                                                                                    <span
                                                                                        class="text-danger">*</span></label>
                                                                                <input type="file"
                                                                                    name="uploading_document" required
                                                                                    class="form-control">

                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="po_num">MDR Qty <span
                                                                                        class="text-danger">*</span></label>
                                                                                <input type="number" readonly name="qty"
                                                                                    value="<?php echo $grn_details_data[0]->qty - $grn_details_data[0]->verified_qty ?>"
                                                                                    step="any" placeholder="Qty"
                                                                                    name="qty" required
                                                                                    class="form-control">
                                                                                <input type="hidden" name="po_number"
                                                                                    readonly
                                                                                    value="<?php echo $new_po[0]->po_number ?>"
                                                                                    class="form-control">
                                                                                <input type="hidden"
                                                                                    placeholder="Inwarding Qty"
                                                                                    name="grn_number"
                                                                                    value="<?php echo $inwarding_data[0]->grn_number ?>"
                                                                                    class="form-control">


                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="po_num">Remark
                                                                                </label>
                                                                                <input type="text" name="remark"
                                                                                    required placeholder="Remark"
                                                                                    class="form-control">

                                                                            </div>

                                                                        </div>


                                                                    </div>

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Save
                                                                    changes</button>
                                                            </div>
                                                            </form>

                                                        </div>

                                                    </div>
                                                </div>
                                            </td>


                                        </tr>
                                        <?php
                                                    $i++;
                                                }
                                            }
                                        }

                                        ?>



                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="10"></td>
                                            <td>
                                                <?php

                                                if ($inwarding_data[0]->status == "validate_grn") {
                                                ?>
                                                <button type="button" disabled class="btn btn-primary mt-4"
                                                    data-toggle="modal">
                                                    GRN Already Validated</button>
                                                <?php

                                                } else {
                                                    if ($j === $i) {
                                                    ?>
                                                <button type="button" class="btn btn-primary mt-4" data-toggle="modal"
                                                    data-target="#exampleModalgenerate">
                                                    Validate GRN </button>
                                                <?php
                                                    }
                                                }
                                                ?>

                                            </td>
                                        </tr>
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