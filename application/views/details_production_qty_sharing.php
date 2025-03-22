<div class="wrapper">
<div class="content-wrapper">
   <section class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1>Production Details - Sharing</h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
                  <li class="breadcrumb-item active">Assets</li>
               </ol>
            </div>
         </div>
      </div>
      <!-- /.container-fluid -->
   </section>
   <section class="content">
      <div>
         <div class="row">
            <br>
            <div class="col-lg-12">
               <div class="card">
                  <div class="card-header">
                     <a class="btn btn-dark" href="<?php echo base_url('sharing_p_q')  ?>">
                     < Back </a>
                     <hr>
                     <div class="row">
                        <div class="col-lg-2">
                           <label for="">Status</label>
                           <input type="text" readonly value="<?php echo $sharing_p_q[0]->status; ?>"
                              class="form-control">
                        </div>
                        <div class="col-lg-2">
                           <label for="">Shifts Data</label>
                           <input type="text" readonly value="<?php echo $sharing_p_q[0]->shift_name; ?>"
                              class="form-control">
                        </div>
                        <div class="col-lg-2">
                           <label for="">Machine Data</label>
                           <input type="text" readonly value="<?php echo $sharing_p_q[0]->machine_name; ?>" 
                              class="form-control">
                        </div>
                        <div class="col-lg-2">
                           <label for="">Operator Data</label>
                           <input type="text" readonly value="<?php echo $sharing_p_q[0]->op_name;?>" 
                              class="form-control">
                        </div>
                     </div>
                  </div>
                  <div class="card-header">
                     <form action="<?php echo base_url('add_sharing_p_q_history') ?>" method="POST">
                        <div class="row">
                           <div class="col-lg-4">
                              <div class="form-group">
                                 <label> Select Output Part
                                 </label><span class="text-danger">*</span>
                                 <select class="form-control select2" name="output_part_id"
                                    style="width: 100%;">
                                    <?php
                                       foreach ($child_part_list as $c1) {
                                           if ($c1->sub_type != "RM") {
                                       ?>
                                    <option value="<?php echo $c1->id; ?>">
                                       <?php echo $c1->part_number; ?>/<?php echo $c1->part_description; ?>
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
                                 <label for="operation_name">Enter Qty</label><span class="text-danger">*</span>
                                 <input type="number" step="any" min="1" value="1" name="qty"
                                    class="form-control" required id="exampleInputPassword1"
                                    placeholder="Enter Qty ">
                              </div>
                           </div>
                           <div class="col-lg-2">
                              <div class="form-group">
                                 <label for="operation_name">Scrap
                                 Quantity (kg)
                                 </label><span class="text-danger">*</span>
                                 <input type="number" step="any" min="0" value="0" name="scrap_factor"
                                    class="form-control" required id="exampleInputPassword1"
                                    placeholder="Operation Name ">
                                 <input type="hidden" name="sharing_p_q_id"
                                    value="<?php echo $sharing_p_q_id; ?>" class="form-control" required
                                    id="exampleInputPassword1" placeholder="Operation Name ">
                              </div>
                           </div>
                           <div class="col-lg-4">
                              <div class="form-group">
                                 <label> Select Input Part / sharing qty
                                 </label><span class="text-danger">*</span>
                                 <select class="form-control select2" name="input_part_id"
                                    style="width: 100%;">
                                    <?php
                                       $sharingQtyColName = $this->Unit->getSharingQtyColNmForClientUnit();
                                       foreach ($child_part_list as $c1) {
                                           if ($c1->sub_type == "RM") {
                                       ?>
                                    <option value="<?php echo $c1->id; ?>">
                                       <?php echo $c1->part_number; ?>/<?php echo $c1->part_description." / ".$c1->$sharingQtyColName; ?>
                                    </option>
                                    <?php
                                       }
                                       }
                                       ?>
                                 </select>
                              </div>
                           </div>
                           <div class="col-lg-2">
                              <div class="form-group ml-2 mt-4">
                                 <button type="submit" class="btn btn-info" data-dismiss="modal">Add
                                 </button>
                     </form>
                     </div>
                     </div>
                     </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                     <table id="example1" class="table table-bordered table-striped">
                        <thead>
                           <tr>
                              <th>Sr No</th>
                              <th>Output Part Number / Description</th>
                              <th>Input Part Number / Description</th>
                              <th>Scrap</th>
                              <th>Qty</th>
                              <th>Qty In Kg</th>
                              <th>Accepted Qty</th>
                              <th>Rejected Qty</th>
                              <th>Onhold Qty</th>
                              <th>Status</th>
                              <th>Actions</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php
                              if ($sharing_p_q_history) {
                                  $i = 1;
                                  foreach ($sharing_p_q_history as $u) {
                              ?>
                           <tr>
                              <td><?php echo $i; ?></td>
                              <td><?php echo $u->output_part_no ?> /
                                 <?php echo $u->output_part_desc ?>
                              </td>
                              <td><?php echo $u->input_part_no ?> /
                                 <?php echo $u->input_part_desc ?>
                              </td>
                              <td><?php echo $u->scrap_factor ?></td>
                              <td><?php echo $u->qty ?></td>
                              <td><?php echo $u->qty_in_kg ?></td>
                              <td><?php echo $u->accepted_qty ?></td>
                              <td><?php echo $u->rejected_qty ?></td>
                              <td>
                                 <?php
                                    if (!empty($u->onhold_qty)) {
                                    ?>
                                 <button type="button" class="btn btn-warning float-left " data-toggle="modal"
                                    data-target="#onhold<?php echo $i; ?>">
                                 <?php echo $u->onhold_qty; ?> </button>
                                 <?php } else {
                                    echo 0;
                                    } ?>
                                 <div class="modal fade" id="onhold<?php echo $i; ?>" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                       <div class="modal-content">
                                          <div class="modal-header">
                                             <h5 class="modal-title" id="exampleModalLabel">
                                                Onhold
                                                Update 
                                             </h5>
                                             <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                             <span aria-hidden="true">&times;</span>
                                             </button>
                                          </div>
                                          <div class="modal-body">
                                             <form action="<?php echo base_url('update_p_q_onhold_sharing') ?>"
                                                method="POST" enctype='multipart/form-data' s>
                                                <div class="row">
                                                   <div class="col-lg-12">
                                                      <div class="form-group">
                                                         <label for="">Qty</label>
                                                         <input type="number" step="any"
                                                            value="<?php echo $u->onhold_qty ?>" readonly
                                                            class="form-control">
                                                      </div>
                                                   </div>
                                                   <div class="col-lg-12">
                                                      <div class="form-group">
                                                         <label for="">Accept Qty <span
                                                            class="text-danger">*</span>
                                                         </label>
                                                         <input type="number" step="any" value=""
                                                            max="<?php echo $u->onhold_qty ?>" min="0"
                                                            class="form-control" name="accepted_qty"
                                                            placeholder="Enter Accepted Quantity" required>
                                                      </div>
                                                   </div>
                                                   <div class="col-lg-12">
                                                      <div class="form-group">
                                                         <label for="">Rejection
                                                         Reason</label>
                                                         <select name="rejection_reason" id=""
                                                            class="form-control select2">
                                                            <option value="NA">NA</option>
                                                            <?php
                                                               if ($reject_remark) {
                                                               
                                                                   foreach ($reject_remark as $r) {
                                                               ?>
                                                            <option value="<?Php echo $r->name ?>">
                                                               <?Php echo $r->name ?>
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
                                                         <label for="">Reject Remark</label>
                                                         <input type="text"
                                                            placeholder="Enter Rejection Remark If any"
                                                            class="form-control" name="rejection_remark">
                                                         <input type="hidden"
                                                            placeholder="Enter Rejection Remark If any"
                                                            readonly class="form-control" name="id"
                                                            value="<?php echo $u->id ?>">
                                                         <input type="hidden"
                                                            placeholder="Enter Rejection Remark If any"
                                                            readonly class="form-control" name="qty"
                                                            value="<?php echo $u->onhold_qty ?>">
                                                         <input type="hidden"
                                                            placeholder="Enter Rejection Remark If any"
                                                            readonly class="form-control"
                                                            name="output_part_id"
                                                            value="<?php echo $u->output_part_id ?>">
                                                         <input type="hidden"
                                                            placeholder="Enter Rejection Remark If any"
                                                            readonly class="form-control"
                                                            name="accepted_qty_old"
                                                            value="<?php echo $u->accepted_qty ?>">
                                                         <input type="hidden"
                                                            placeholder="Enter Rejection Remark If any"
                                                            readonly class="form-control"
                                                            name="rejected_qty_old"
                                                            value="<?php echo $u->rejected_qty ?>">
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="modal-footer">
                                                   <button type="button" class="btn btn-secondary"
                                                      data-dismiss="modal">Close</button>
                                                   <button type="submit" class="btn btn-primary">Save
                                                   changes</button>
                                                </div>
                                          </div>
                                          </form>
                                       </div>
                                    </div>
                                 </div>
                              </td>
                              <td><?php echo $u->status ?></td>
                              <td>
                                 <?php
                                    if ($u->status == "pending") {
                                    ?>
                                 <button type="button" class="btn btn-danger float-left" data-toggle="modal"
                                    data-target="#acceptReject<?php echo $i; ?>">
                                 Accept/Reject </button>
                                 <?php
                                    } else {
                                        echo "Completed";
                                    }
                                    ?>
                                 <div class="modal fade" id="acceptReject<?php echo $i; ?>" tabindex="-1"
                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                       <div class="modal-content">
                                          <div class="modal-header">
                                             <h5 class="modal-title" id="exampleModalLabel">Accept/Reject</h5>
                                             <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                             <span aria-hidden="true">&times;</span>
                                             </button>
                                          </div>
                                          <div class="modal-body">
                                             <form action="<?php echo base_url('update_p_q_sharing') ?>"
                                                method="POST" enctype='multipart/form-data' s>
                                                <div class="row">
                                                   <div class="col-lg-12">
                                                      <div class="form-group">
                                                         <label for="">Qty</label>
                                                         <input type="text" value="<?php echo $u->qty ?>"
                                                            readonly class="form-control">
                                                      </div>
                                                   </div>
                                                   <div class="col-lg-12">
                                                      <div class="form-group">
                                                         <label for="">Accept Qty <span
                                                            class="text-danger">*</span>
                                                         </label>
                                                         <input type="number" value=""
                                                            max=" <?php echo $u->qty ?>" min="0"
                                                            class="form-control" name="accepted_qty"
                                                            placeholder="Enter Accepted Quantity" required>
                                                      </div>
                                                   </div>
                                                   <div class="col-lg-12">
                                                      <div class="form-group">
                                                         <label for="">Onhold Qty <span
                                                            class="text-danger">*</span>
                                                         </label>
                                                         <input type="number" value=""
                                                            max=" <?php echo $u->qty ?>" min="0"
                                                            class="form-control" name="onhold_qty"
                                                            placeholder="Enter onhold" required>
                                                      </div>
                                                   </div>
                                                   <div class="col-lg-12">
                                                      <div class="form-group">
                                                         <label for="">Rejection Reason</label>
                                                         <select name="rejection_reason" id=""
                                                            class="form-control select2">
                                                            <option value="NA">NA</option>
                                                            <?php
                                                               if ($reject_remark) {
                                                               
                                                                   foreach ($reject_remark as $r) {
                                                               ?>
                                                            <option value="<?Php echo $r->name ?>">
                                                               <?Php echo $r->name ?>
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
                                                         <label for="">Reject Remark</label>
                                                         <input type="text"
                                                            placeholder="Enter Rejection Remark If any"
                                                            class="form-control" name="rejection_remark">
                                                         <input type="hidden"
                                                            placeholder="Enter Rejection Remark If any"
                                                            readonly class="form-control" name="id"
                                                            value="<?php echo $u->id ?>">
                                                         <input type="hidden"
                                                            placeholder="Enter Rejection Remark If any"
                                                            readonly class="form-control" name="qty"
                                                            value="<?php echo $u->qty ?>">
                                                         <input type="hidden"
                                                            placeholder="Enter Rejection Remark If any"
                                                            readonly class="form-control"
                                                            name="output_part_id"
                                                            value="<?php echo $u->output_part_id ?>">
                                                         <input type="hidden"
                                                            placeholder="Enter Rejection Remark If any"
                                                            readonly class="form-control"
                                                            name="input_part_id"
                                                            value="<?php echo $u->input_part_id ?>">
                                                         <input type="hidden"
                                                            placeholder="Enter Rejection Remark If any"
                                                            readonly class="form-control" name="    "
                                                            value="<?php echo $u->qty_in_kg ?>">
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="modal-footer">
                                                   <button type="button" class="btn btn-secondary"
                                                      data-dismiss="modal">Close</button>
                                                   <button type="submit" class="btn btn-primary">Save
                                                   changes</button>
                                                </div>
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