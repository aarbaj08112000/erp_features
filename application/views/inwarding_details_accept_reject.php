<?php
    $isMultiClient = $this->session->userdata['isMultipleClientUnits'];
?>
<div  class="wrapper">
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
                        <h1>Accept / Reject Validation </h1>
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
                                            <a class="btn btn-dark"
                                                href="<?php echo base_url('accept_reject_validation'); ?>">
                                                < Back</a>
                                       </div>
                                    </div>
                                    <div class="col-lg-2">
                                    <div class="form-group">
                                            <label for="">GRN Number</label>
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
                                            <label for="">Supplier Name  </label>
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
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Supplier GST </label>
                                            <input type="text" readonly value="<?php echo $supplier[0]->gst_number ?>"
                                                class="form-control">
                                        </div>
                                    </div>
                                    </div>
                                    <div class="row">
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
                                            <label for="">Invoice Amount  </label>
                                            <input type="text" readonly
                                                value="<?php echo $inwarding_data[0]->invoice_amount; ?>"
                                                class="form-control">
                                        </div>
                                    </div>
                                   
                                    <div class="col-lg-2">
                                        <div class="form-group">

                                            <label for="">Software Calculated Amount
                                            </label>
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
                                            <input type="text" readonly value="<?php echo $actual_price; ?>"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Invoice Amount Validate Status</label>
                                            <input type="text" readonly value="<?php echo $status; ?>"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Accept </h5>
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
                                                                        <div class="form-group">
                                                                            <label> Are You Sure Want To Accept This
                                                                                Inwarding ?</label><span
                                                                                class="text-danger">*</span>
                                                                            <input type="hidden" name="inwarding_id"
                                                                                value="<?php echo $inwarding_id; ?>"
                                                                                class="form-control">
                                                                            <input type="hidden" name="invoice_number"
                                                                                value="<?php echo $invoice_number; ?>"
                                                                                class="form-control">
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
                                                                            <input type="number" step="any" name="invoice_amount"
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
                                                            <h5 class="modal-title" id="exampleModalLabel">Change Status
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
                                            <!-- <th>Tax Strucutre Code</th> -->
                                            <th>UOM</th>
                                            <!-- <th>Delivery Date</th> -->
                                            <!-- <th>Expiry Date</th> -->
                                            <!-- <th>PO QTY</th> -->
                                            <!-- <th>Balance QTY</th> -->
                                            <th>Price</th>
                                            <th>Inwarding Qty</th>
                                            <th>GRN Validation Qty</th>
                                            <th>Accept Qty.</th>
                                            <th>Reject Qty</th>
                                            <th>Remark</th>
                                            <th>Submit </th>
                                            <th>GRN Rejection</th>
                                            <th>RM Batch No</th>
                                            <th>Supplier Report</th> <!-- MTC Report -->
                                            <th>Incoming Inspection Report </th>
                                            <th>Action</th>
                                       </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        if ($po_parts) {
                                            $final_po_amount = 0;
                                            $i = 1;
                                            foreach ($po_parts as $p) {

                                                $data = array(
                                                    'supplier_id' => $supplier[0]->id,
                                                    "child_part_id" => $p->part_id,
                                                );
                                                $child_part_data = $this->Crud->get_data_by_id_multiple_condition("child_part_master", $data);

                                                $uom_data = $this->Crud->get_data_by_id("uom", $p->uom_id, "id");

                                                $part_rate_new = 0;
                                                if (empty($p->rate)) {
                                                    $part_rate_new = $child_part_data[0]->part_rate;
                                                } else {
                                                    $part_rate_new = $p->rate;
                                                }
                                                $total_rate = $part_rate_new * $p->qty;
                                                // $total_rate = $part_rate_new * $p->qty;
                                                $final_po_amount = $final_po_amount + $total_rate;

                                                $arr = array(
                                                    'inwarding_id' => $inwarding_id,
                                                    'part_id' => $p->part_id,
                                                    'po_number' => $new_po_id,
                                                    'invoice_number' => $inwarding_data[0]->invoice_number,
                                                //    'grn_number' => $inwarding_data[0]->grn_number,
                                                );
                                                $grn_details_data = $this->Crud->get_data_by_id_multiple("grn_details", $arr);

                                                $arr2 = array(
                                                    'supplier_id' => $supplier[0]->id,
                                                    'part_id' => $p->part_id,
                                                    'po_number' => $new_po[0]->id,
                                                    'type' => "grn_rejection",

                                                );
                                                // print_r($arr2);
                                                $rejection_flow_data = $this->Crud->get_data_by_id_multiple("rejection_flow", $arr2);

                                                // print_r($arr2);
                                                if ($grn_details_data) {

                                                    if ($grn_details_data) {
                                                        $data_present = "yes";
                                                    } else {
                                                        $data_present = "no";
                                                    }


                                        ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $child_part_data[0]->part_number; ?></td>
                                            <td class="col-lg-2"><?php echo $child_part_data[0]->part_description; ?></td>
                                            <td><?php echo $uom_data[0]->uom_name; ?></td>

                                            <td><?php echo $part_rate_new; ?></td>
                                            <td><?php echo $grn_details_data[0]->qty; ?></td>
                                            <td><?php echo $grn_details_data[0]->verified_qty; ?></td>
                                            
                                                <?php
                                                            if (empty($grn_details_data[0]->accept_qty)) {
                                                            ?>
                                                <td class="col-lg-2">
                                                <form action="<?php echo base_url('update_grn_qty_accept_reject') ?>"
                                                    method="post">
                                                    <input type="number" required min="0" value="" id="searchTxt"
                                                        step="any" required max="<?php echo $grn_details_data[0]->verified_qty; ?>"
                                                        placeholder="Accept Qty" name="accept_qty" class="form-control">
                                                    <input type="hidden"
                                                        value="<?php echo $grn_details_data[0]->qty; ?>"
                                                        placeholder="GRN Validation Qty4" name="privious_qty"
                                                        class="form-control">
                                                    <input type="hidden" name="grn_details_id"
                                                        value="<?php echo $grn_details_data[0]->id; ?>"
                                                        class="form-control">
                                                    <input type="hidden" placeholder="Inwarding Qty"
                                                        name="part_rate" value="<?php echo $part_rate_new ?>"
                                                        class="form-control">
                                                    <input type="hidden" placeholder="Inwarding Qty" name="tax_id"
                                                        value="<?php echo $p->tax_id ?>" class="form-control">
                                                    <input type="hidden" placeholder="Inwarding Qty"
                                                        name="verified_qty"
                                                        value="<?php echo $grn_details_data[0]->verified_qty ?>"
                                                        class="form-control">
                                                    <input type="hidden" placeholder="Inwarding Qty"
                                                        name="part_id" value="<?php echo $p->part_id ?>"
                                                        class="form-control">
                                                    <input type="hidden" name="invoice_number"
                                                        value="<?php echo $invoice_number; ?>" class="form-control">
                                                    <input type="hidden" name="deliveryUnit"
                                                        value="<?php echo $inwarding_data[0]->delivery_unit; ?>" class="form-control">
                                                    <?php
                                                        } else {
                                                    ?>
                                                    <td>
                                                     <?php
                                                          echo $grn_details_data[0]->accept_qty;
                                                          }
                                                        ?>
                                                    </td>
                                            <td>
                                                <?php

                                                            if (empty($grn_details_data[0]->reject_qty)) {
                                                                echo $grn_details_data[0]->reject_qty;
                                                            ?>
                                                <!-- <input required type="number" max="<?php echo "<script>document.getElementById('searchTxt').value</script>"; ?>" min="0" placeholder="Reject Qty" name="reject_qty" class="form-control"> -->
                                                <?php
                                                            } else {
                                                                echo $grn_details_data[0]->reject_qty;
                                                            }
                                                            ?>
                                            </td>
                                            <td class="col-lg-1">
                                                <?php
                                                            if (empty($grn_details_data[0]->accept_qty)) {
                                                            ?>
                                                <input type="text" name="remark" placeholder="Remark"
                                                    class="form-control">
                                                <!-- <input required type="number" max="<?php echo "<script>document.getElementById('searchTxt').value</script>"; ?>" min="0" placeholder="Reject Qty" name="reject_qty" class="form-control"> -->
                                                <?php
                                                            } else {
                                                                echo $grn_details_data[0]->remark;
                                                            }
                                                            ?>
                                            </td>
                                            <td>
                                                <?php
                                                            if (empty($grn_details_data[0]->accept_qty)) {
                                                            ?>
                                                <button type="submit" class="btn btn-info">Submit</button>
                                                </form>
                                                <?php
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
                                                    download>Download Document </a>

                                                <?php
                                                            } else {
                                                                if ($grn_details_data) {
                                                                    if ($grn_details_data[0]->reject_qty != 0) {
                                                                        // if($new_po[0]->status == "accpet")
                                                                        // {}
                                                                ?>
                                                <button type="button" class="btn btn-warning float-left"
                                                    data-toggle="modal" data-target="#exampleModal123<?Php echo $i; ?>">
                                                    Add Rejection Debit Note
                                                </button>
                                                <?php
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
                                                                                    value="<?php echo $p->part_id ?>"
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
                                                                                    value="grn_rejection" required
                                                                                    placeholder="Reason"
                                                                                    class="form-control">

                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label for="po_num">Upload Rejection
                                                                                    Document <span
                                                                                        class="text-danger">*</span></label>
                                                                                <input type="file"
                                                                                    name="uploading_document" required
                                                                                    class="form-control">

                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="po_num">Rejection Qty <span
                                                                                        class="text-danger">*</span></label>
                                                                                <input type="number" readonly name="qty"
                                                                                    value="<?php echo $grn_details_data[0]->reject_qty; ?>"
                                                                                    step="any" placeholder="Qty"
                                                                                    name="qty" required
                                                                                    class="form-control">
                                                                                <input type="hidden" name="po_number"
                                                                                    readonly
                                                                                    value="<?php echo $new_po[0]->id ?>"
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
                                                                    Changes</button>
                                                            </div>
                                                            </form>

                                                        </div>

                                                    </div>
                                                </div>
                                            </td>
                                            <td><?php echo $grn_details_data[0]->rm_batch_no; ?></td>
                                            <!-- Supplier/MTC Report -->
                                            <td>
												<?php
												if ($grn_details_data[0]->mtc_report != "") 
													{ ?>
													<a download href="<?php echo base_url('documents/mtc/') . $grn_details_data[0]->mtc_report ?>" id="" class="btn btn-sm btn-primary remove_hoverr "><i class="fas fa-download"></i></a>
												<?php } ?>
											</td>
                                            <td>
                                                <a class="btn btn-info" title="Raw Material Inspection"
                                                    href="<?php echo base_url('raw_material_inspection_inwarding/') . $child_part_data[0]->id . "/" . $new_po[0]->id . "/" . $supplier[0]->id . "/" . $inwarding_data[0]->id . "/" . $grn_details_data[0]->accept_qty . "/" . $grn_details_data[0]->reject_qty."/".$p->part_id ?>">
                                                    <i class="fa fa-clipboard"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#editRM<?php echo $i; ?>">
                                                  <i class="fa fa-edit"></i>
                                                </button>
                                                <div class="modal fade" id="editRM<?php echo $i; ?>" tabindex="-1"
                                                    role="dialog" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Update
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form
                                                                    action="<?php echo base_url('update_rm_batch_mtc_report') ?>"
                                                                    method="POST" enctype="multipart/form-data">
                                                                    <div class="form-group">
                                                                        <label for="">RM Batch No<span
                                                                                class="text-danger">*</span></label>
                                                                        <input required value="<?php echo $grn_details_data[0]->rm_batch_no; ?>"
                                                                            type="text" class="form-control"
                                                                            name="rm_batch_no">
                                                                        <input type="hidden" name="grn_details_id"
                                                                            value="<?php echo $grn_details_data[0]->id; ?>"
                                                                            class="form-control">
                                                                        <!-- <input required value="<?php echo $inwarding_data[0]->id; ?>"
                                                                            type="hidden" class="form-control"
                                                                            name="inwarding_id">
                                                                        <input required value="<?php echo $inwarding_data[0]->invoice_number; ?>"
                                                                            type="hidden" class="form-control"
                                                                            name="invoice_number">
                                                                        <input required value="<?php echo $new_po_id; ?>"
                                                                            type="hidden" class="form-control"
                                                                            name="po_number"> -->
                                                                    </div>
                                                                   <div class="form-group">
																	    <label for="mtcReportFile">MTC Report</span>
																		<input required type="file" name="mtc_report" class="form-control" id="mtcReportFile" aria-describedby="mtcReportFileHelp" placeholder="Select File">
																	</div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Save
                                                                    Changes</button>
                                                                </form>
                                                            </div>
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


                                </table>

                                <div style="margin-left: 1200px ;">
                                    <?php

                                    if ($inwarding_data[0]->status == "accept") {
                                    ?>
                                    <button type="button" disabled class="btn btn-primary mt-4" data-toggle="modal"
                                        data-target="#exampleModalgenerate">
                                        Inwarding Already Accepted </button>
                                    <?php

                                    } else {
                                    ?>
                                    <button type="button" class="btn btn-primary mt-4" data-toggle="modal"
                                        data-target="#exampleModal">
                                        Accept Inwarding </button>
                                    <?php

                                    }
                                    ?>
                                </div>

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