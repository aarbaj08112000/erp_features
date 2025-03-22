<div style="width:1200px" class="wrapper">
    <!-- Navbar -->
    
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-lg-12">
                        <h1>Subcon View</h1>
                    </div>
                    
                </div>
            </div> <!-- /.container-fluid -->
        </section> <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <!-- /.card -->
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    
                                    <div class="col-lg-2">
                                        <div class="form-group"> <label for="">PO Number</label> <input type="text" readonly value="<?php echo $new_po[0]->po_number ?>" class="form-control"> </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group"> <label for="">PO Date </label> <input type="text" readonly value="<?php echo $new_po[0]->po_date ?>" class="form-control"> </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group"> <label for="">Status </label> <input type="text" readonly value="<?php if ($new_po[0]->status == "accpet") {
                                    echo "Released";
                                    } else {
                                    echo $new_po[0]->status;
                                    } ?>" class="form-control"> </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group"> <label for="">Supplier Name </label> <input type="text" readonly value="<?php echo $supplier[0]->supplier_name ?>" class="form-control"> </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group"> <label for="">Supplier Number </label> <input type="text" readonly value="<?php echo $supplier[0]->supplier_number ?>" class="form-control"> </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group"> <label for="">Supplier GST </label> <input type="text" readonly value="<?php echo $supplier[0]->gst_number ?>" class="form-control"> </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group"> <label for="">Software Calculated Amount </label> <input type="text" readonly value="<?php echo $actual_price; ?>" class="form-control"> </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group"> <label for="">Invoice Amount Validation Status </label> <input type="text" readonly value="<?php echo $status; ?>" class="form-control"> </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group"> <?php
                                    if ($status == "not-verifed") {
                                    ?> <?php
                                    }
                                    if ($inwarding_data[0]->status == "accepted") {
                                    
                                        echo "<button class='btn btn-primary mt-4' disabled>Inwarding Already Accepted</button>";
                                    } else if ($status == "verifed") {
                                    
                                    
                                        if ($inwarding_data[0]->status == "pending" || $inwarding_data[0]->status == "") {
                                        ?>
                                            <!-- <button type="button" class="btn btn-danger mt-4" data-toggle="modal" data-target="#exampleModalgenerate">
                                    Generate GRN </button> --> <?php
                                    } else if ($inwarding_data[0]->status == "generate_grn") {
                                    ?>
                                            <!-- <button type="button" class="btn btn-primary mt-4" data-toggle="modal" data-target="#exampleModal">
                                    Receipt Quantity Inwarding </button> --> <?php
                                    }
                                    }
                                    ?>
                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg " role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Add Billing Data </h5> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                                        </div>
                                                        <div class="modal-body"> <?php
                                                if ($challan) {
                                                ?> <form action="<?php echo base_url('accept_inwarding_data') ?>" method="POST"> <?php
                                                   } else {
                                                       ?> <form action="<?php echo base_url('accept_inwarding_data') ?>" method="POST"> <?php
                                                   }
                                                       ?> <div class="row">
                                                                        <div class="col-lg-12">
                                                                            <div class="form-group"> <label> Are You Sure Want To Accept This Inwarding ? This Data can't be changed once it's Submit</label><span class="text-danger">*</span> <input type="hidden" name="inwarding_id" value="<?php echo $inwarding_id; ?>" class="form-control"> <input type="hidden" name="invoice_number" value="<?php echo $invoice_number; ?>" class="form-control"> </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer"> <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> <button type="submit" class="btn btn-primary">Save changes</button> </div>
                                                                </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal fade" id="exampleModalgenerate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog " role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Change Status </h5> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="<?php echo base_url('update_status_grn_inwarding') ?>" method="POST">
                                                                <div class="row">
                                                                    <div class="col-lg-12">
                                                                        <div class="form-group"> <label> Are You Sure Want To Generate GRN ? </label> <input type="hidden" name="status" placeholder="" value="generate_grn" class="form-control"> <input type="hidden" name="inwarding_id" value="<?php echo $inwarding_id; ?>" class="form-control"> </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer"> <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> <button type="submit" class="btn btn-primary">Save changes</button> </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group"> <a class="btn btn-dark" href="<?php echo base_url('inwarding_details/') . $this->uri->segment('4')."/". $this->uri->segment('3'); ?>">
                                            < Back</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-striped" id="example1">
                                    <thead>
                                        <tr>
                                            <th>Part Number</th>
                                            <th>Part Description</th>
                                            <th>UOM</th>
                                            <th>PO QTY</th>
                                            <th>Balance QTY</th>
                                        </tr>
                                    </thead>
                                    <tbody> <?php
                                 $inwardCompleted = false;
                                if ($po_parts) {
                                    $i = 1;
                                    foreach ($po_parts as $p) {
                                    ?> <tr>
                                            <td><?php echo $p->child_part_data[0]->part_number; ?></td>
                                            <td><?php echo $p->child_part_data[0]->part_description; ?></td>
                                            <td><?php echo $p->uom_data[0]->uom_name; ?></td>
                                            <td><?php echo $p->qty; ?></td>
                                            <td><?php echo $p->pending_qty; ?></td>
                                        </tr>
                                        <tr>
                                            <table class="table table-bordered table-striped" id="example1">
                                                <tr>
                                                    <th>Name / Description</th>
                                                    <th>Inwarding Qty</th>
                                                    <th>Required Qty</th>
                                                    <th>Received Qty</th>
                                                    <th>Select Challan / Available Qty / Date</th>
                                                    <th>Submit</th>
                                                    <th>History</th>
                                                </tr> <?php
                                       $ro = 1;
                                       $completed = 0;
                                       
                                       if ($subcon_po_inwarding_master) {
                                          echo "<br>
                                          <b><u>Input / Challan Part Details</u></b>
                                          <br>";
                                           foreach ($p->subcon_po_inwarding_parts as $r) {
                                               if ($r->child_part_new_new) {
                                                        ?> <tr>
                                                            <form method="post" action="<?php echo base_url('add_challan_parts_history'); ?>">
                                                                <td><?php echo $r->child_part_new_new[0]->part_number . " / " . $r->child_part_new_new[0]->part_description; ?></td>
                                                                <td><?php echo $r->inwarding_qty; ?></td>
                                                                <td><?php echo $r->input_part_req_qty; ?> <input type="hidden" name="required_qty" value="<?php echo $qty * $r->qty; ?>"> </td>
                                                                <td><?php echo $r->recevied_req_qty; ?></td> <?php 
                                                     if ($r->recevied_req_qty == $r->input_part_req_qty) {
                                                         $completed++;
                                                         $inwardCompleted = true;
                                                         $disabled = true; 
                                                     } ?> 
                                                     <td> <select name="challan_id" style="width:400px" class="select2 form-control" <?php if($inwardCompleted == true) echo "disabled"; ?>>
                                                                        <option value="0">NA</option> <?php
                                                           if ($r->challan_parts_data) {
                                                               foreach ($r->challan_parts_data as $ch_parts) {
                                                                   if ($ch_parts->challan_data) {
                                                                       if($ch_parts->challan_data[0]->supplier_id == $supplier[0]->id)
                                                                       {
                                                                           if($ch_parts->challan_data[0]->status == "completed")
                                                                           {
                                                                                           foreach ($ch_parts->challan_data as $c_d) {
                                                                                           ?> <option value="<?php echo $c_d->id ?>"><?php echo $c_d->challan_number . " / " . $ch_parts->remaning_qty." / ".$ch_parts->created_date; ?></option> <?php
                                                                                           }
                                                                           }
                                                                        }
                                                                    }
                                                                }
                                                           }
                                                           ?>
                                                                    </select> </td>
                                                            <td> <input type="hidden" name="part_id" value="<?php echo $r->child_part_new_new[0]->id; ?>"> <input type="hidden" name="subcon_po_inwarding_parts_id" value="<?php echo $r->id; ?>"> <input type="hidden" name="req_qty" value="<?php echo $r->input_part_req_qty ?>"> <input type="hidden" name="rec_qty" value="<?php echo $r->recevied_req_qty ?>"> <input type="hidden" name="grn_number" value="<?php echo $inwarding_data[0]->grn_number; ?>"> <input type="hidden" name="invoice_number" value="<?php echo $inwarding_data[0]->invoice_number ?>"> <input type="hidden" name="po_id" value="<?php echo $new_po[0]->id ; ?>"> <input type="hidden" name="inwarding_id" value="<?php echo $inwarding_id; ?>" class="form-control"> <input type="hidden" name="new_po_id" value="<?php echo $new_po_id ?>" class="form-control"> <input type="hidden" name="child_part_id" value="<?php echo $p->part_id; ?>" class="form-control"> <input type="hidden" name="invoice_number" placeholder="invoice_number" value="<?php echo $inwarding_data[0]->invoice_number; ?>" class="form-control"> 
                                                        <?php if($inwardCompleted == true) {
                                                            echo "inwarding added";
                                                            } else { ?> <button type="submit" class="btn btn-info">Submit</button>
                                                             <?php } ?> 
                                                            </td>
                                                                <th> <a class="btn btn-danger" href="<?php echo base_url('subcon_po_inwarding_history/') . $r->id ?>">History</a> </th>
                                                            </form>
                                                        </tr> <?php
                                               $ro++;
                                               } else {
                                               echo "Part Not Found";
                                               }
                                            }
                                       }
                                       ?> 
                                       <tr class="text-right">
                                                    <td colspan="7">
                                                        <!-- <form action="<?php echo base_url('') ?>"> -->
                                                        <form action="<?php echo base_url('grn_complete_challan_process') ?>" method="post"> <?php
                                                // print_r($inwarding_data);
                                                $part_rate_new = 0;
                                                if (empty($po_parts[0]->rate)) {
                                                    $part_rate_new = $child_part_data[0]->part_rate;
                                                } else {
                                                    $part_rate_new = $p->rate;
                                                }
                                                ?> <input type="hidden" required step="any" value="<?php echo $subcon_po_inwarding_master[0]->inwarding_qty ?>" placeholder="$po_parts[0]->qty;" name="qty" class="form-control"> <input type="hidden" name="inwarding_id" value="<?php echo $inwarding_data[0]->id ?>" placeholder="98771231236" class="form-control"> <input type="hidden" name="new_po_id" value="<?php echo $new_po_id ?>" class="form-control"> <input type="hidden" name="part_id" value="<?php echo $po_parts[0]->part_id ?>" class="form-control"> <input type="hidden" name="invoice_number" value="<?php echo $inwarding_data[0]->invoice_number ?>" class="form-control"> <input type="hidden" name="grn_number" value="<?php echo $inwarding_data[0]->grn_number ?>" class="form-control"> <input type="hidden" name="po_part_id" value="<?php echo $po_parts[0]->id ?>" class="form-control"> <input type="hidden" name="pending_qty" value="<?php echo $po_parts[0]->pending_qty ?>" class="form-control"> <input type="hidden" name="part_rate" value="<?php echo $part_rate_new ?>" class="form-control"> <input type="hidden" name="tax_id" value="<?php echo $po_parts[0]->tax_id ?>" class="form-control"> <?php 
                                                //Old Logic : changed per discussion with Raghunath.
                                                                                                            if ($p->data_present =='no') { ?> <button type="submit" class="btn btn-primary"> Complete Challan Process </button> <?php } ?> </form>
                                                    </td>
                                        </tr>
                                            </table>
                                        </tr> <?php
                                     ?> <?php
                                     $i++;
                                     }
                                }
                                 ?>
                                    </tbody>
                                    <tfoot> </tfoot>
                                </table>
                            </div>
                        </div> <!-- /.card-body -->
                    </div> <!-- /.card -->
                </div> <!-- /.col -->
            </div> <!-- /.row -->
    </div> <!-- /.container-fluid -->
    </section> <!-- /.content -->
</div> <!-- /.content-wrapper -->