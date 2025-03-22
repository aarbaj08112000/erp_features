<div class="wrapper">
   <!-- Navbar -->
   <!-- /.navbar -->
   <!-- Main Sidebar Container -->
   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
         <div class="container-fluid">
            <div class="row mb-2">
               <div class="col-sm-4">
                  <!-- <h1></h1> -->
               </div>
               <div class="col-sm-5">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="<%base_url('generate_po') %>">Home</a></li>
                     <li class="breadcrumb-item active"></li>
                  </ol>
               </div>
            </div>
         </div>
         <!-- /.container-fluid -->
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
                                 <a class="btn btn-dark" href="<%base_url('sales_invoice_released') %>">< Back </a>
                              </div>
                           </div>
                           <div class="col-lg-2">
                              <div class="form-group">
                                 <a class="btn btn-dark" href="<%base_url('view_new_sales_by_id/') %><%$sales_id; %>">View Invoice </a>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-lg-2">
                              <div class="form-group">
                                 <label for="">Customer Name <span class="text-danger"></span></label>
                                 <br><span class="text-info"><label><?php echo $customer[0]->customer_name ?></label></span>
                              </div>
                           </div>
                           <div class="col-lg-2">
                              <div class="form-group">
                                 <label>Sales Invoice Number <span class="text-danger"></span></label>
                                 <br><span class="text-info"><label><?php echo $new_sales[0]->sales_number ?></label></span>
                              </div>
                           </div>
                           <div class="col-lg-2">
                              <div class="form-group">
                                 <label for="">Invoice Date <span class="text-danger"></span> </label>
                                 <br><span class="text-info"><label><?php echo $new_sales[0]->created_date ?></label></span>
                              </div>
                           </div>
                           <div class="col-lg-2">
                              <div class="form-group">
                                 <label for="">E Invoice Status <span class="text-danger"></span> </label>
                                 <br><span class="text-info"><label><?php echo $einvoice_res_data[0]->Status; ?></label></span>
                              </div>
                           </div>
                           <div class="col-lg-2">
                              <div class="form-group">
                                 <label for="">EWay-Bill Status <span class="text-danger"></span> </label>
                                 <br><span class="text-info"><label><?php echo $einvoice_res_data[0]->EwbStatus; ?></label></span>
                              </div>
                           </div>
                        </div>
                        <hr>
                        <div class="row">
                           <?php 
                              $new_sales_id = $sales_id;
                                                      $status = $einvoice_res_data[0]->Status;
                              $irnNo = $einvoice_res_data[0]->Irn;
                              
                              if (empty($status)) {
                                    if (empty($irnNo)) { ?>
                           <div class="col-lg-2">
                              <div class="form-group">
                                 <a class="btn btn-success mt-4" href="<?php echo base_url('generate_E_invoice/') . $sales_id . "/EINVOICE"; ?>" target="_blank">Create E-Invoice </a>
                              </div>
                           </div>
                           <?php
                              }else { 
                              ?>
                           <div class="col-lg-2">
                              <div class="form-group">
                                 <a class="btn btn-success mt-4" href="<?php echo base_url('get_E_invoice/') . $sales_id; ?>">Get E-Invoice Details</a>
                              </div>
                           </div>
                           <?php
                              }
                              }
                              
                              if(isset($status) && ($status=="ACT")) {
                                                       ?>
                           <div class="col-lg-2">
                              <div class="form-group">
                                 <a class="btn btn-success mt-4" href="<?php echo base_url('view_E_invoice/') . $sales_id; ?>" target="_blank">View E-Invoice </a>
                              </div>
                           </div>
                           <div class="col-lg-2">
                              <div class="form-group">
                                 <button data-toggle="modal" class="btn btn-success mt-4" data-target="#cancelEInvoiceModel<?php echo $sales_id; ?>">Cancel E-Invoice</i></button>
                              </div>
                           </div>
                           <!-- Cancel E-Invoice Model -->
                           <div class="modal fade" id="cancelEInvoiceModel<?php echo $sales_id; ?>" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog modal-lg" role="document">
                                 <div class="modal-content">
                                    <div class="modal-header">
                                       <h5 class="modal-title" id="exampleModalLabel">Cancel E - Invoice</h5>
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                       <span aria-hidden="true">&times;</span>
                                       </button>
                                    </div>
                                    <div class="modal-body">
                                       <form action="<?php echo base_url('cancel_E_invoice_update') ?>" method="POST">
                                          <div class="row">
                                             <div class="col-lg-12">
                                                <div class="form-group">
                                                   <label for="customer_name">Reason</label><span class="text-danger">*</span>
                                                   <select name="CancelReason" required class="form-control">
                                                      <option value="">Select Reason</option>
                                                      <option value="1">Duplicate</option>
                                                      <option value="2">Data Entry Mistake</option>
                                                      <option value="3">Order Cancelled</option>
                                                      <option value="4">Others</option>
                                                   </select>
                                                   <input value="<?php echo $sales_id ?>" type="hidden" name="new_sales_id" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Customer Name">
                                                </div>
                                             </div>
                                             <div class="col-lg-12">
                                                <div class="form-group">
                                                   <label for="customer_name">Remark</label><span class="text-danger">*</span>
                                                   <input type="text" name="CancelRemark" required class="form-control" aria-describedby="emailHelp" placeholder="Remark">
                                                </div>
                                             </div>
                                          </div>
                                          <div class="modal-footer">
                                             <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                             <button type="submit" class="btn btn-primary">Save changes</button>
                                          </div>
                                       </form>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           
                           <?php } ?>
                        </div>
                        <div class="row">
                           <?php
                              $new_sales_id = $sales_id;
                                                         $ewbStatus = $einvoice_res_data[0]->EwbStatus;
                              if((empty($ewbStatus) || ($ewbStatus=="CANCELLED"))){?>
                           <div class="col-lg-2">
                              <div class="form-group">
                                 <button type="button" class="btn btn-success mt-4" data-toggle="modal" data-target="#createEBill<?php echo $sales_id; ?>" target="_blank">Create Eway Bill</button>
                              </div>
                           </div>
                           <?php 
                              } if(isset($ewbStatus) && ($ewbStatus=="ACTIVE")) {
                                                     ?>
                           <div class="col-lg-2">
                              <div class="form-group">
                                 <a class="btn btn-success mt-4" href="<?php echo base_url('view_EwayBill/') . $sales_id; ?>" target="_blank">View EWay-Bill</a>
                              </div>
                           </div>
                           <div class="col-lg-2">
                              <div class="form-group">
                                 <button type="button" class="btn btn-success mt-4" data-toggle="modal" data-target="#updateEBill<?php echo $sales_id; ?>">Update Eway Bill</button>
                              </div>
                           </div>
                           <div class="col-lg-2">
                              <div class="form-group">
                                 <button type="button" class="btn btn-success mt-4" data-toggle="modal" data-target="#updateTrans<?php echo $sales_id; ?>">Update Transporter</button>
                              </div>
                           </div>
                           <div class="col-lg-2">
                              <div class="form-group">
                                 <button type="button" class="btn btn-success mt-4" data-toggle="modal" data-target="#cancelEBill<?php echo $sales_id; ?>">Cancel Eway-Bill</button>
                              </div>
                           </div>
                           <?php 
                              }
                                                     ?>
                           <!-- edit Modal -->
                           <div class="modal fade" id="createEBill<?php echo $sales_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                 <div class="modal-content">
                                    <div class="modal-header">
                                       <h5 class="modal-title" id="exampleModalLabel">Create Eway Bill</h5>
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                       <span aria-hidden="true">&times;</span>
                                       </button>
                                    </div>
                                    <div class="modal-body">
                                       <form action="<?php echo base_url('generate_EwayBill') ?>" method="POST" enctype="multipart/form-data">
                                          <input value="<?php echo $sales_id ?>" type="hidden" name="new_sales_id" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Customer Name">
                                          <div class="form-group">
                                             <label for="">Mode Of Transport<span class="text-danger">*</label>
                                             <select name="transMode" class="form-control" required>
                                                <!--<option value="">Select</option>-->
                                                <option value="1" <?php if($new_sales[0]->mode == '1') { echo "selected"; } ?>>Road</option>
                                                <option value="2" <?php if($new_sales[0]->mode == '2') { echo "selected"; } ?>>Rail</option>
                                                <option value="3" <?php if($new_sales[0]->mode == '3') { echo "selected"; } ?>>Air</option>
                                                <option value="4" <?php if($new_sales[0]->mode == '4') { echo "selected"; } ?>>Ship</option>
                                             </select>
                                          </div>
                                          <div class="form-group">
                                             <label for="">Transporter<span class="text-danger">*</label>
                                             <select name="transporterId" required id="transporter" class="form-control select2">
                                                <option value="">Select Transporter</option>
                                                <?php
                                                   if ($transporter) {
                                                    foreach ($transporter as $tr) {
                                                   ?>
                                                <option value="<?php echo $tr->id; ?>" <?php if($new_sales[0]->transporter_id == $tr->id) { echo "selected"; } ?>><?php echo $tr->name; ?> - <?php echo $tr->transporter_id; ?></option>
                                                <?php
                                                   }
                                                   }
                                                   ?>
                                             </select>
                                          </div>
                                          <div class="form-group">
                                             <label for="">Enter Vehicle No. <span class="text-danger">*</label>
                                             <input type="text" placeholder="Enter Vehicle No" name="vehicleNo" value="<?php echo $new_sales[0]->vehicle_number ?>" 
                                                pattern="^([A-Z|a-z|0-9]{4,20})$"
                                                oninvalid="this.setCustomValidity('Please enter a valid vehicle number in the format XX00XX0000')" 
                                                onchange="this.setCustomValidity('')" required class="form-control">
                                          </div>
                                          <div class="form-group">
                                             <label for="">Distance of Transportation<span class="text-danger">*</label>
                                             <input type="text" placeholder="Enter Distance of Transportation" name="distance" value="<?php echo $new_sales[0]->distance ?>" required  class="form-control">
                                          </div>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Create Eway-Bill</button>
                                    </form>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- Update Modal -->
                        <div class="modal fade" id="updateEBill<?php echo $sales_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                           <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Update Eway Bill</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                 </div>
                                 <div class="modal-body">
                                    <form action="<?php echo base_url('update_e_way_bill') ?>" method="POST" enctype="multipart/form-data">
                                       <input value="<?php echo $sales_id ?>" type="hidden" name="new_sales_id" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Customer Name">
                                       <div class="form-group">
                                          <label for="on click url">e-Way Bill No</label>
                                          <input readonly type="text" name="eWayBillNo" class="form-control" value="<?php echo $einvoice_res_data[0]->EwbNo; ?>" id="">
                                       </div>
                                       <!--<div class="form-group">
                                          <label for="on click url">From Place</label>
                                          <input type="text" name="fromPlace" class="form-control" value="<?php echo $einvoice_res_data[0]->EwbDt; ?>" id="">
                                          </div>
                                          <div class="form-group">
                                          <label for="on click url">From State<span class="text-danger">*</span></label>
                                          <input type="text" name="fromState" placeholder="State code" class="form-control" value="<?php echo $einvoice_res_data[0]->e_way_bill_remark; ?>" id="">
                                          </div> -->
                                       <div class="form-group">
                                          <label for="customer_name">Reason</label><span class="text-danger">*</span>
                                          <select name="reasonCode" required class="form-control">
                                             <option value="">Select Reason</option>
                                             <option value="1">Due to Break Down</option>
                                             <option value="2">Due to Transhipment</option>
                                             <option value="3">Others (Pls. Specify)</option>
                                             <option value="4">First Time</option>
                                          </select>
                                       </div>
                                       <div class="form-group">
                                          <label for="on click url">Reason Remark</label><span class="text-danger">*</span>
                                          <input type="text" id="reasonRem" required maxlength="50" name="reasonRem" placeholder="Reason Remark" 
                                             class="form-control"  value="">
                                       </div>
                                       <div class="form-group">
                                          <label for="">Mode Of Transport<span class="text-danger">*</label>
                                          <select name="transMode" class="form-control" required>
                                             <!-- <option value="">Select</option> -->
                                             <option value="1" <?php if($new_sales[0]->mode == '1') { echo "selected"; } ?>>Road</option>
                                             <option value="2" <?php if($new_sales[0]->mode == '2') { echo "selected"; } ?>>Rail</option>
                                             <option value="3" <?php if($new_sales[0]->mode == '3') { echo "selected"; } ?>>Air</option>
                                             <option value="4" <?php if($new_sales[0]->mode == '4') { echo "selected"; } ?>>Ship</option>
                                          </select>
                                       </div>
                                       <div class="form-group">
                                          <label for="on click url">Vehicle No<span class="text-danger">*</span></label>
                                          <input type="text" id="vehicleNo" placeholder="Enter Vehicle No" name="vehicleNo" value="<?php echo $new_sales[0]->vehicle_number; ?>" 
                                             pattern="^([A-Z|a-z|0-9]{4,20})$"
                                             oninvalid="this.setCustomValidity('Please enter a valid vehicle number in the format XX00XX0000')" 
                                             onchange="this.setCustomValidity('')" required class="form-control">
                                       </div>
                                       <!-- <div class="form-group">
                                          <label for="on click url">Transaction Doc No<span class="text-danger"></span></label>
                                          <input type="text" id="transDocNo" name="transDocNo" maxLength="15" placeholder="Document No" class="form-control" value="">
                                          </div>
                                          <div class="form-group">
                                          <label for="on click url">Transaction Doc Date<span class="text-danger"></span></label>
                                          <input type="text" id="transDocDate" name="transDocDate" placeholder="Document Date" class="form-control" value="" 
                                          pattern="[0-3][0-9]/[0-1][0-9]/[2][0][1-2][0-9]"
                                          oninvalid="this.setCustomValidity('Transaction Document Date')" 
                                          onchange="this.setCustomValidity('')">
                                          </div> -->
                                 </div>
                                 <div class="modal-footer">
                                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                 <button type="submit" class="btn btn-primary">Update</button>
                                 </form>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- DONE:  Update Transporter Modal  -->
                        <div class="modal fade" id="updateTrans<?php echo $sales_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                           <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Update Transporter ID</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                 </div>
                                 <div class="modal-body">
                                    <form action="<?php echo base_url('update_EWayBill_transporter') ?>" method="POST" enctype="multipart/form-data">
                                       <input type="hidden" name="new_sales_id" value="<?php echo $new_sales[0]->id ?>" required class="form-control">
                                       <div class="form-group">
                                          <label for="on click url">e-Way Bill No </label> <br>
                                          <input readonly type="text" name="eWayBillNo" class="form-control" value="<?php echo $einvoice_res_data[0]->EwbNo; ?>" id="">
                                       </div>
                                       <div class="form-group">
                                          <label for="">Transporter<span class="text-danger">*</label>
                                          <select name="transporterId" required id="transporterId" class="form-control select2">
                                             <option value="">Select Transporter</option>
                                             <?php
                                                if ($transporter) {
                                                    foreach ($transporter as $tr) {?>
                                             <option value="<?php echo $tr->id; ?>" 
                                                <?php if($new_sales[0]->transporter_id == $tr->id) { echo "selected"; } ?>><?php echo $tr->name; ?> - <?php echo $tr->transporter_id; ?></option>
                                             <?php }        
                                                }?>
                                          </select>
                                       </div>
                                 </div>
                                 <div class="modal-footer">
                                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                 <button type="submit" class="btn btn-primary">Save changes</button>
                                 </form>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- cancel eway bill -->
                        <div class="modal fade" id="cancelEBill<?php echo $sales_id; ?>" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                           <div class="modal-dialog modal-lg" role="document">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Cancel EWay-Bill</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                 </div>
                                 <div class="modal-body">
                                    <form action="<?php echo base_url('cancel_eWayBill') ?>" method="POST">
                                       <input type="hidden" name="new_sales_id" value="<?php echo $sales_id ?>"   required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Customer Name">
                                       <input type="hidden" name="eWayBillNo" value="<?php echo $einvoice_res_data[0]->EwbNo; ?>" class="form-control" id="ewayBillNo1">
                                       <div class="form-group">
                                          <label for="customer_name">Reason</label><span class="text-danger">*</span>
                                          <select name="cancelReason" required class="form-control">
                                             <option value="">Select Reason</option>
                                             <option value="1">Duplicate</option>
                                             <option value="2">Data Entry Mistake</option>
                                             <option value="3">Order Cancelled</option>
                                             <option value="4">Others</option>
                                          </select>
                                       </div>
                                       <div class="form-group">
                                          <label for="customer_name">Remark</label><span class="text-danger">*</span>
                                          <input type="text" name="cancelRemark" required class="form-control" aria-describedby="emailHelp" placeholder="Remark">
                                       </div>
                                       <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                          <button type="submit" class="btn btn-primary">Cancel E-Way Bill</button>
                                       </div>
                                    </form>
                                 </div>
                              </div>
                           </div>
                        </div>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script>
   $(document).ready(function() {
   
       var id = $("#customer_tracking").val();
       $('#new_po_id').val(id);
       var salesno = $('#sales_number').val();
       $.ajax({
           url: '<?php echo site_url("Newcontroller/get_po_sales_parts"); ?>',
           type: "POST",
           data: {
               id: id,
               salesno: salesno
           },
           cache: false,
           beforeSend: function() {},
           success: function(response) {
               if (response) {
                   $('#part_id').html(response);
               } else {
   
                   $('#part_id').html(response);
               }
   
           }
       });
       $("#customer_tracking").change(function() {
   
           var id = $("#customer_tracking").val();
           var salesno = $('#sales_number').val();
           $.ajax({
               url: '<?php echo site_url("Newcontroller/get_po_sales_parts"); ?>',
               type: "POST",
               data: {
                   id: id,
                   salesno: salesno
               },
               cache: false,
               beforeSend: function() {},
               success: function(response) {
                   if (response) {
                       $('#part_id').html(response);
                   } else {
   
                       $('#part_id').html(response);
                   }
   
               }
           });
   
       })
   });
</script>