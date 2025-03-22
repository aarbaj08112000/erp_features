<div style="width:100%" class="wrapper">
   <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
         <div class="container-fluid">
            <div class="row mb-2">
               <div class="col-sm-6">
                  <?php
                     $expired = "no";
                     if ($new_po[0]->expiry_po_date > date('Y-m-d')) {
                         $expired =  "yes";
                     } else {
                     }
                     if (empty($new_po[0]->process_id)) {
                         $type = "normal";
                     } else {
                         $type = "Subcon grn";
                     }
                     ?>
               </div>
               <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="<?php echo base_url('generate_po') ?>">Home </a></li>
                     <li class="breadcrumb-item active"></li>
                  </ol>
               </div>
            </div>
         </div>
      </section>
      <section class="content">
         <div class="container-fluid">
            <div class="row">
               <div class="col-12">
                  <div class="card">
                     <div class="card-header">
                        <form action="<?php echo base_url('update_po'); ?>" method="post">
                           <div class="row">
                              <div class="col-lg-2">
                                 <div class="form-group">
                                    <label for="">PO Number <span class="text-danger">*</span> </label>
                                    <input type="text" readonly value="<?php echo $new_po[0]->po_number ?>" class="form-control">
                                 </div>
                              </div>
                              <div class="col-lg-2">
                                 <div class="form-group">
                                    <label for="">PO Date <span class="text-danger">*</span> </label>
                                    <input type="text" readonly value="<?php echo $new_po[0]->po_date ?>" class="form-control">
                                 </div>
                              </div>
                              <div class="col-lg-2">
                                 <div class="form-group">
                                    <label for="">PO Expiry Date <span class="text-danger">*</span> </label>
                                    <input type="text" readonly value="<?php echo $new_po[0]->expiry_po_date ?>" class="form-control">
                                 </div>
                              </div>
                              <div class="col-lg-2">
                                 <div class="form-group">
                                    <label for="">PO Remark <span class="text-danger">*</span> </label>
                                    <input type="text" readonly value="<?php echo $new_po[0]->remark ?>" class="form-control">
                                 </div>
                              </div>
                              <div class="col-lg-2">
                                 <div class="form-group">
                                    <label for="">Current Status <span class="text-danger">*</span> </label>
                                    <input type="text" readonly value="<?php
                                       if ($expired == "no") {
                                           echo $statusNew  = "Expired";
                                       } else if ($new_po[0]->status == "accept") {
                                           echo $statusNew  = "Released";
                                       } else {
                                           echo $new_po[0]->status;
                                       } ?>" class="form-control">
                                 </div>
                              </div>
                              <div class="col-lg-2">
                                 <div class="form-group">
                                    <label for="">Supplier Name <span class="text-danger">*</span> </label>
                                    <input type="text" readonly value="<?php echo $supplier[0]->supplier_name ?>" class="form-control">
                                 </div>
                              </div>
                              <div class="col-lg-3">
                                 <div class="form-group">
                                    <label for="">Supplier Number <span class="text-danger">*</span> </label>
                                    <input type="text" readonly value="<?php echo $supplier[0]->supplier_number ?>" class="form-control">
                                 </div>
                              </div>
                              <div class="col-lg-3">
                                 <div class="form-group">
                                    <label for="">Supplier GST <span class="text-danger">*</span> </label>
                                    <input type="text" readonly value="<?php echo $supplier[0]->gst_number ?>" class="form-control">
                                 </div>
                              </div>
                              <?php if($new_po[0]->po_discount_type == "PO Level"){ ?>
                              <div class="col-lg-3">
                                 <div class="form-group">
                                    <label for="">Discount Type<span class="text-danger">*</span> </label>
                                    <input type="text" readonly value="<?php echo $new_po[0]->discount_type ?>" class="form-control">
                                 </div>
                              </div>
                              <div class="col-lg-3">
                                 <div class="form-group">
                                    <label for="">Discount <span class="text-danger">*</span> </label>
                                    <input type="number" required value="<?php echo $new_po[0]->discount ?>" class="form-control"  <?php if(count($grn_part_arr) > 0) {?>readonly<?php } ?> name="discount_value" >
                                 </div>
                              </div>
                              <?php } ?>
                              <?php if(!$isSubPO){ ?>
                                  <div class="col-lg-3">
                                     <div class="form-group">
                                        <label for="">Loading Unloading Amount <span class="text-danger">*</span> </label>
                                        <input type="number" required value="<?php echo $new_po[0]->loading_unloading ?>" step="any" placeholder="Enter Loading Unloading" value="" name="loading_unloading" class="form-control"  <?php if(count($grn_part_arr) > 0) {?>readonly<?php } ?>>
                                     </div>
                                  </div>
                                  <div class="col-lg-3">
                                     <div class="form-group">
                                        <label for="">Supplier GST <span class="text-danger">*</span> </label>
                                        <input type="text" readonly value="<?php echo $supplier[0]->gst_number ?>" class="form-control">
                                     </div>
                                  </div>
                                  <div class="col-lg-3">
                                     <div class="form-group">
                                        <label for="">Loading Unloading Tax Strucutre <span class="text-danger">*</span> </label>
                                        <select name="loading_unloading_gst" required id="" class="form-control select2" <?php if(count($grn_part_arr) > 0) {?>readonly<?php } ?>>
                                           <option value="0">NA</option>
                                           <?php
                                              if ($gst_structure) {
                                                  foreach ($gst_structure as $s) {
                                                      ?>
                                                   <option value="<?php echo $s->id; ?>" <?php if($s->id == $new_po[0]->loading_unloading_gst){echo "selected";} ?>><?php echo $s->code; ?>
                                                   </option>
                                                   <?php
                                                      }
                                              }
                                              
                                              ?>
                                        </select>
                                     </div>
                                  </div>
                                  <div class="col-lg-3">
                                     <div class="form-group">
                                        <label for="">Freight Amount <span class="text-danger">*</span> </label>
                                        <input type="number" required value="<?php echo $new_po[0]->freight_amount ?>" class="form-control" name="freight_amount" <?php if(count($grn_part_arr) > 0) {?>readonly<?php } ?>>
                                        <input type="hidden" required value="<?php echo $new_po[0]->id ?>" class="form-control" name="po_id">
                                     </div>
                                  </div>
                                  <div class="col-lg-3">
                                     <div class="form-group">
                                        <label for="">Freight Tax Strucutre <span class="text-danger">*</span> </label>
                                        <select name="freight_amount_gst" required id="" class="form-control select2" <?php if(count($grn_part_arr) > 0) {?>readonly<?php } ?>>
                                           <option value="0">NA</option>
                                           <?php
                                              if ($gst_structure) {
                                                  foreach ($gst_structure as $s) {
                                                    ?>
                                                 <option value="<?php echo $s->id; ?>" <?php if($s->id == $new_po[0]->freight_amount_gst){echo "selected";} ?>><?php echo $s->code; ?>
                                                 </option>
                                                 <?php
                                                    }
                                              }
                                              
                                              ?>
                                        </select>
                                     </div>
                                  </div>
                                  <?php if(count($grn_part_arr) == 0) {?>
                                  <div class="col-lg-2">
                                     <button type="submit" class="btn btn-info btn mt-4">Update</button>
                                  </div>
                                  <?php } ?>
                              <?php } ?>
                           </div>
                        </form>
                     </div>
                     <?php
                        if ($new_po[0]->status == "pending") { ?>
                     <div class="card-header">
                        <?php
                           if ($new_po[0]->expiry_po_date <=  date('Y-m-d') || true) {
                           ?>
                              <div class="row">
                                 <div class="col-lg-6">
                                    <div class="form-group">
                                       <form action="<?php echo base_url('add_po_parts'); ?>" method="post">
                                          <label for="">Select Part Number // Description // Supplier // Rate //
                                          Tax Structure // Max Qty<span class="text-danger">*</span> </label>
                                          <?php
                                             ?>
                                          <select name="part_id" id="" required class="form-control select2">
                                             <?php
                                                if ($child_part) {
                                                   echo $po_parts_opt;
                                                }
                                                ?>
                                          </select>
                                    </div>
                                 </div>
                                 <?php if($new_po[0]->po_discount_type == "Part Level"){ ?>
                                       <div class="col-lg-2">
                                       <div class="form-group">
                                       <label for="">Discount(%) <span class="text-danger">*</span> </label>
                                       <input type="number"  value="" min="0" max="100" class="form-control"  name="discount_value" >
                                       </div>
                                       </div>
                                 <?php } ?>
                                 <?php
                                    if ($type != "normal") {
                                    ?>
                                       <div class="col-lg-2">
                                       <div class="form-group">
                                       <label for="">Select Process <span class="text-danger">*</span> </label>
                                       <select name="process" id="" class="form-control select2">
                                       <?php
                                          if ($process) {
                                              foreach ($process as $s) {
                                                ?>
                                             <option value="<?php echo $s->name; ?>"><?php echo $s->name; ?></option>
                                             <?php
                                                }
                                          }
                                          ?>
                                       </select>
                                       </div>
                                       </div>
                                       <?php
                                    }
                                    ?>
                                 <div class="col-lg-2">
                                 <div class="form-group">
                                 <label for="">Enter Qty <span class="text-danger">*</span> </label>
                                 <input type="number" step="any" name="qty" placeholder="Enter QTY " required class="form-control">
                                 <input type="hidden" name="po_number" value="<?php echo $new_po[0]->po_number ?>" required class="form-control">
                                 <input type="hidden" name="po_id" value="<?php echo $new_po[0]->id ?>" required class="form-control">
                                 <input type="hidden" name="supplier_id" value="<?php echo $supplier[0]->id ?>" placeholder=" " required class="form-control">
                                 <input type="hidden" name="type" value="<?php echo $type; ?>" placeholder="" required class="form-control">
                                 </div>
                                 </div>
                                 <input type="hidden" name="po_discount_type"  required class="form-control" value="<?php echo $new_po[0]->po_discount_type; ?>">
                                 <div class="col-lg-2">
                                 <div class="form-group">
                                 <?php
                                    if ($new_po[0]->status == "pending") {
                                        if ($expired == "yes") {
                                    
                                          ?>
                                       <button type="submit" class="btn btn-info btn mt-4">Add Child Part</button>
                                       <?php
                                          } else {
                                              echo "PO expired";
                                          }
                                    } ?>
                                 </div>
                                 </div>
                                 </form>
                              </div>
                           <?php } else {
                              echo "Po  Expired!!";
                           } 
                           ?>
                     </div>
                     <?php
                        }
                        ?>
                     <div class="card-header">
                        <?php if ($po_parts) {
                              if ($new_po[0]->status == "accept") {
                              ?>
                                 <button type="button" class="btn btn-danger ml-1" data-toggle="modal" data-target="#lock">
                                 UnLock PO
                                 </button>
                                 <?php 
                              }
                           } ?>
                        <?php if ($new_po[0]->status == "pending") {
                              if ($user_type == 'admin' || $user_type == 'Admin') {
                                 ?>
                                 <button type="button" class="btn btn-success ml-1" data-toggle="modal" data-target="#accept">
                                 Approve & Release PO
                                 </button>
                              <?php
                                 }
                           } else {
                                 if ($new_po[0]->status != "pending") {
                                 ?>
                              <a href="<?php echo base_url('download_my_pdf/') . $new_po[0]->id ?>" class="btn btn-primary" href="">Download</a>
                              <?php
                                 }
                           } ?>
                        <!-- Modal -->
                        <div class="modal fade" id="accept" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                       <form action="<?php echo base_url('accept_po'); ?>" method="POST">
                                          <div class="col-lg-12">
                                             <div class="form-group">
                                                <label for=""><b>Are You Sure Want To Released This
                                                PO?</b> </label>
                                                <input type="hidden" name="id" value="<?php echo $new_po[0]->id ?>" required class="form-control">
                                                <input type="hidden" name="status" value="accept" required class="form-control">
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
                                       <form action="<?php echo base_url('unlock_po'); ?>" method="POST">
                                          <div class="col-lg-12">
                                             <div class="form-group">
                                                <label for=""><b>Are You Sure Want To Unlock This PO?</b>
                                                </label>
                                                <input type="hidden" name="id" value="<?php echo $new_po[0]->id ?>" required class="form-control">
                                                <input type="hidden" name="status" value="pending" required class="form-control">
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
                                                <input type="hidden" name="id" value="<?php echo $new_po[0]->id ?>" required class="form-control">
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
                                 <?php if($new_po[0]->po_discount_type == "Part Level"){ ?>
                                 <th>Discount(%)</th>
                                 <?php } ?>
                                 <?php
                                    if ($type != "normal") {
                                    ?>
                                 <th>Process</th>
                                 <?php } ?>
                                 <th>Price</th>
                                 <!-- <th>Created Date</th> -->
                                 <th>Actions</th>
                                 <th>Sub Total</th>
                                 <th>GST</th>
                                 <th>Total Price</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php
                                 if ($po_parts) {
                                     $i = 1;
                                     foreach ($po_parts as $p) {
                                         $child_part_data = $p->child_part_data;
                                         $uom_data = $p->uom_data;
                                         $total_rate_old = $p->total_rate_old;
                                         $gst_structure = $p->gst_structure;
                                         $cgst_amount = $p->cgst_amount;
                                         $sgst_amount =  $p->sgst_amount;
                                         $igst_amount =  $p->igst_amount;
                                         $gst_amount =  $p->gst_amount;
                                         $total_rate =  $p->total_rate;
                                         $part_rate_new = $p->part_rate_new;
                                 
                                       ?>
                                    <tr>
                                       <td><?php echo $i; ?></td>
                                       <td><?php echo $child_part_data[0]->part_number; ?></td>
                                       <td><?php echo $child_part_data[0]->part_description; ?></td>
                                       <td><?php echo $gst_structure[0]->code; ?></td>
                                       <td><?php echo $uom_data[0]->uom_name; ?></td>
                                       <td><?php echo $p->qty; ?></td>
                                       <?php if($new_po[0]->po_discount_type == "Part Level"){  ?>
                                       <td> <?php echo $p->discount;  } ?> </td>
                                       <?php
                                          if ($type != "normal") {
                                          ?>
                                       <td><?php echo $p->process; ?></td>
                                       <?php } ?>
                                       <td><?php echo $part_rate_new; ?></td>
                                       <!-- <td><?php echo $p->created_date; ?></td> -->
                                       <td>
                                          <?php
                                             if ($new_po[0]->status == "pending") {
                                             ?>
                                          <!-- Button trigger modal -->
                                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal<?php echo $i; ?>">
                                          Edit
                                          </button>
                                          <?php if($new_po[0]->is_unlock != "Yes"){ ?>
                                          <button type="button" class="btn btn-danger ml-1" data-toggle="modal" data-target="#exampleModaldelete<?php echo $i; ?>">
                                          Delete
                                          </button>
                                          <?php }else if(!in_array($p->id, $grn_part_arr)){ ?>
                                          <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#ammendQty<?php echo $i; ?>">
                                          Amend Price/tax
                                          </button>
                                          <div class="modal fade" id="ammendQty<?php echo $i; ?>" tabindex="-1" aria-labelledby="" aria-hidden="true">
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
                                                         <form action="<?php echo base_url('AmendQty'); ?>" method="POST">
                                                            <div class="col-lg-12">
                                                               <div class="form-group">
                                                                  <label for=""> <b>Are You Sure Want To
                                                                  Amend Price/tax for This part? </b> </label>
                                                                  <input type="hidden" name="id" value="<?php echo $p->id ?>" required class="form-control">
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
                                          <?php }?>
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
                                                      <div class="row" style="    display: block;">
                                                         <form action="<?php echo base_url('update_po_parts'); ?>" method="POST">
                                                            <div class="col-lg-12">
                                                               <div class="form-group">
                                                                  <label for="">Enter Qty <span class="text-danger">*</span>
                                                                  </label>
                                                                  <input type="number" name="qty" value="<?php echo $p->qty ?>" placeholder="Enter QTY " required class="form-control">
                                                                  <input type="hidden" name="part_number" value="<?php echo $child_part_data[0]->part_number; ?>" placeholder="Enter part_number " required class="form-control">
                                                                  <input type="hidden" name="id" value="<?php echo $p->id ?>" required class="form-control">
                                                               </div>
                                                            </div>
                                                            <?php if($new_po[0]->po_discount_type == "Part Level"){ ?>
                                                            <div class="col-lg-12">
                                                               <div class="form-group">
                                                                  <label for="">Discount(%) <span class="text-danger">*</span> </label>
                                                                  <input type="number"  value="<?php echo $p->discount ?>" min="0" max="100" class="form-control"  name="discount_value" >
                                                               </div>
                                                            </div>
                                                            <?php } ?>
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
                                                                  <input type="hidden" name="table_name" value="po_parts" required class="form-control">
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
                                                   if ($user_type == 'admin' || $user_type == 'Admin') {
                                                       if ($statusNew) {
                                                   
                                                         ?>
                                                                     <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal123123123<?php echo $i; ?>">
                                                                     Amend QTY
                                                                     </button>
                                                                     <div class="modal fade" id="exampleModal123123123<?php echo $i; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                        <div class="modal-dialog">
                                                                           <div class="modal-content">
                                                                              <div class="modal-header">
                                                                                 <h5 class="modal-title" id="exampleModalLabel">PO
                                                                                    Amendment
                                                                                 </h5>
                                                                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                 <span aria-hidden="true">&times;</span>
                                                                                 </button>
                                                                              </div>
                                                                              <div class="modal-body">
                                                                                 <div class="row">
                                                                                    <div class="col-lg-12">
                                                                                       <div class="form-group">
                                                                                          <?php
                                                                                             ?>
                                                                                          <form action="<?php echo base_url('update_po_parts_amendment'); ?>" method="POST">
                                                                                             <label for="">Enter Qty <span class="text-danger">*</span>
                                                                                             </label>
                                                                                             <input type="number" name="qty" value="<?php echo $p->new_po_qty ?>" placeholder="Enter QTY " required class="form-control">
                                                                                             <input type="hidden" name="id" value="<?php echo $p->id ?>" required class="form-control">
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
                                                                  <?php
                                                                     if ($p->po_approved_updated == "pending") {
                                                                     ?>
                                                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalapproved<?php echo $i; ?>">
                                                                        Approve Amendment
                                                                        </button>
                                                                        <div class="modal fade" id="exampleModalapproved<?php echo $i; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                           <div class="modal-dialog">
                                                                              <div class="modal-content">
                                                                                 <div class="modal-header">
                                                                                    <h5 class="modal-title" id="exampleModalLabel">PO
                                                                                       Amendment Approval 
                                                                                    </h5>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                 </div>
                                                                                 <div class="modal-body">
                                                                                    <div class="row">
                                                                                       <div class="col-lg-12">
                                                                                          <div class="form-group">
                                                                                             <form action="<?php echo base_url('update_po_parts_amendment_approve'); ?>" method="POST">
                                                                                                <label for="">Are You Sure Want To
                                                                                                Approve this Amendment ? <span class="text-danger">*</span>
                                                                                                </label>
                                                                                                <input type="number" name="qty" value="<?php echo $p->new_po_qty ?>" placeholder="Enter QTY " required class="form-control">
                                                                                                <input type="hidden" name="id" value="<?php echo $p->id ?>" required class="form-control">
                                                                                                <input type="hidden" name="new_po_id" value="<?php echo $new_po[0]->id; ?>" required class="form-control">
                                                                                          </div>
                                                                                          <div class="form-group">
                                                                                          <label for="">Enter PO Amendment Number
                                                                                          <span class="text-danger">*</span>
                                                                                          </label>
                                                                                          <input type="text" name="po_a_number" placeholder="Enter Po Amendment Number " required class="form-control">
                                                                                          </div>
                                                                                          <div class="form-group">
                                                                                          <label for="">Privious Qty <span class="text-danger">*</span>
                                                                                          </label>
                                                                                          <input type="number" name="qty" readonly value="<?php echo $p->qty ?>" placeholder="Enter QTY " required class="form-control">
                                                                                          </div>
                                                                                          <div class="form-group">
                                                                                          <label for="">New Qty <span class="text-danger">*</span>
                                                                                          </label>
                                                                                          <input type="number" name="new_qty" readonly value="<?php echo $p->new_po_qty ?>" placeholder="Enter QTY " required class="form-control">
                                                                                          <input type="hidden" name="id" value="<?php echo $p->id ?>" required class="form-control">
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
                                                                  <?php
                                                                     }
                                                                     if ($p->po_a_number != "") {
                                                                         echo "<br>";
                                                                         echo "Amendment No :" . $p->po_a_number;
                                                                         echo "<br>";
                                                                         echo "Amendment Date" . $p->date;
                                                                     }
                                                                     ?>
                                                      <?php
                                                      }
                                                   }
                                             }
                                             ?>
                                       </td>
                                       <td><?php echo $total_rate_old; ?></td>
                                       <td><?php echo $gst_amount; ?></td>
                                       <td><?php echo $total_rate; ?></td>
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
                                 <th colspan="10">Total</th>
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