<div class="wrapper">
<!-- Navbar -->
<!-- /.navbar -->
<!-- Main Sidebar Container -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <!-- Main content -->
   <section class="content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-12">
               <!-- /.card -->
               <div class="card">
                  <div class="card-header">
                     <h3 class="card-title">
                     </h3>
                     <!-- Button trigger modal -->
                     <!-- <button type="button" class="btn btn-primary float-left" data-toggle="modal" data-target="#exampleModal">
                        Add </button> -->
                  </div>
                  <!-- Modal -->
                  <!-- 
                     <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                         <div class="modal-dialog modal-lg" role="document">
                             <div class="modal-content">
                                 <div class="modal-header">
                                     <h5 class="modal-title" id="exampleModalLabel">Add </h5>
                                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                         <span aria-hidden="true">&times;</span>
                                     </button>
                                 </div>
                                 <div class="modal-body">
                                     <form action="<php echo base_url('add_job_card') ?>" method="POST" enctype='multipart/form-data'>
                                         <div class="row">
                                             <div class="col-lg-12">
                                                 <div class="form-group">
                                                     <label for="po_num">Select Customer Name / Customer Code / Part Number / Description </label><span class="text-danger">*</span>
                                                     <select name="customer_part_id" id="" class="from-control select2">
                                                         <php
                                                         if ($customer_part) {
                                                             foreach ($customer_part as $c) {
                                                                 if (true) {                                                                        // $data['toolList'] = $this->Crud->get_data_by_id("tools", "insert", "type");
                                                                     $customer = $this->Crud->get_data_by_id("customer", $c->customer_id, "id");
                     
                                                         ?>
                                                                     <option value="<php echo $c->id ?>"><php echo $customer[0]->customer_name . "/" . $customer[0]->customer_code . "/" . $c->part_number . "/" . $c->part_description ?></option>
                                                         <php
                                                                 }
                                                             }
                                                         }
                                                         ?>
                                                     </select>
                     
                                                 </div>
                                                 <div class="form-group">
                                                     <label for="po_num">Required Quantity </label><span class="text-danger">*</span>
                                                     <input type="number" name="req_qty" placeholder="Enter Quantity" min="1" value="" class="form-control">
                     
                                                 </div>
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
                     </div> -->
                  <div class="card">
                     <div class="card-header">
                        <div class="row">
                           <div class="col-lg-2">
                              <form action="<?php echo base_url('sales_invoice_released'); ?>" method="post">
                                 <div class="form-group">
                                    <label for="">Select Month  <span class="text-danger">*</span></label>
                                    <select required name="created_month" id="" class="form-control select2">
                                       <?php
                                          for ($i = 1; $i <= 12; $i++) {
                                             $month_data = $this->Common_admin_model->get_month($i);
                                             $month_number = $this->Common_admin_model->get_month_number($month_data);
                                             ?>
                                       <option <?php  if($month_number == $created_month){echo "selected";} ?>
                                          value="<?php echo $month_number;?>"><?php echo $month_data?></option>
                                       <?php } ?>
                                    </select>
                                 </div>
                           </div>
                           <div class="col-lg-2">
                           <div class="form-group">
                           <label for="">Select Year  <span class="text-danger">*</span></label>
                           <select required name="created_year" id="" class="form-control select2">
                           <?php
                              for ($i = 2022; $i <= 2027; $i++) {
                                 ?>
                           <option  <?php  if($i == $created_year){echo "selected";} ?>
                              value="<?php echo $i;?>"><?php echo $i?></option>
                           <?php } ?>
                           </select>
                           </div>
                           </div>
                           <div class="col-lg-2">
                           <br><input type="submit" class="btn btn-primary mt-2"value="Search">
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
                              <th>Sr.No.</th>
                              <th>Invoice Date</th>
                              <th>Vehicle Number</th>
                              <th>Sales Invoice Number</th>
                              <th>Customer</th>
                              <th>View Details</th>
                              <th>PDI</th>
                              <th>E-Invoice Details</th>
                              <th>Status</th>
                              <th>E-Invoice Status</th>
                              <th>Is EWay-Bill Available</th>
                              <th>Total Price (Rs.)</th>
                              <th>Actions</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php
                              $srNo = 1;
                              if ($new_sales) {
                                  foreach ($new_sales as $c) {
                                      if (isset($c->status)) {
                              ?>
                           <tr>
                              <td><?php echo $srNo ?></td>
                              <td><?php echo $c->created_date ?></td>
                              <td><?php echo $c->vehicle_number ?></td>
                              <td><?php
                                 echo $c->sales_number;
                                 ?></td>
                              <td><?php echo $c->customer_name ?></td>
                              <td>
                                 <a class="btn btn-primary btn-sm" href="<?php echo base_url('view_new_sales_by_id/') . $c->id; ?>"><i class="fas fa-eye"></i></a>
                              </td>
                              <td>
                                 <a class="btn btn-primary btn-sm" href="<?php echo base_url('view_PDI_inspection_report/') . $c->id; ?>"><i class="fas fa-eye"></i></a>
                              </td>
                              <td>
                                 <?php 
                                    if($c->status != "pending"){ ?>
                                 <a class="btn btn-primary btn-sm" href="<?php echo base_url('view_e_invoice_by_id/') . $c->id; ?>"><i class="fas fa-eye"></i></a>
                                 <?php } ?>
                              </td>
                              <td>
                                 <?php echo $c->status; ?>
                              </td>
                              <?php
                                 $e_invoice_status = $this->Crud->get_data_by_id("einvoice_res", $c->id, "new_sales_id");
                                 ?>
                              <td>
                                 <?php echo $e_invoice_status[0]->Status; ?>
                              </td>
                              <td>
                                 <?php if(isset($e_invoice_status[0])){
                                    echo $e_invoice_status[0]->EwbStatus;
                                    }
                                    ?>
                              </td>
                              <?php
                                 $sales_id = $c->id;
                                 $po_parts = $this->Crud->get_data_by_id("sales_parts", $sales_id, "sales_id");
                                 $final_po_amount = 0;
                                 if ($po_parts) {
                                     $i = 1;
                                     foreach ($po_parts as $p) {
                                     $subtotal =  $p->total_rate - $p->gst_amount;
                                     $row_total =(float) $p->total_rate+(float)$p->tcs_amount;
                                     $final_po_amount = (float)$final_po_amount + (float)$row_total;
                                 ?>
                              <?php
                                 $i++;
                                 }
                                 }
                                 ?>
                              <td>
                                 <?php echo number_format($final_po_amount,2); ?>
                              </td>
                              <td>
                                 <?php 
                                    $e_invoice_status = $this->Crud->get_data_by_id("einvoice_res", $c->id, "new_sales_id");
                                    if($c->status != "Cancelled" && 
                                    (empty($e_invoice_status) || $e_invoice_status[0]->Status == "CANCELLED")){ 
                                    ?>
                                 <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#cancelInvoice<?php echo $srNo; ?>">Cancel</button>&nbsp;
                                 <?php } ?>
                                 <?php if($c->status == "pending"){ ?>
                                 <button type="button" data-toggle="modal" class="btn btn-danger btn-sm" data-target="#deleteInvoice<?php echo $srNo; ?>"><i class="fas fa-trash"></i></button>
                                 <?php } ?>
                                 <div class="modal fade" id="cancelInvoice<?php echo $srNo; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                       <div class="modal-content">
                                          <div class="modal-header">
                                             <h5 class="modal-title" id="exampleModalLabel">Update Status</h5>
                                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                             <span aria-hidden="true">&times;</span>
                                             </button>
                                          </div>
                                          <div class="modal-body">
                                             <div class="row">
                                                <form action="<?php echo base_url('cancel_sale_invoice'); ?>" method="POST">
                                                   <div class="col-lg-12">
                                                      <div class="form-group">
                                                         <label for=""><b>Are you sure want to Cancel this invoice?</b> </label>
                                                         <input type="hidden" name="sales_id" value="<?php echo $c->id ?>" required class="form-control">
                                                         <input type="hidden" name="sales_number" value="<?php echo $c->sales_number?>" required class="form-control">
                                                         <input type="hidden" name="status" value="<?php echo $c->status ?>" required class="form-control">
                                                      </div>
                                                   </div>
                                             </div>
                                          </div>
                                          <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                          <button type="submit" class="btn btn-primary">Update</button>
                                          </div>
                                       </div>
                                       </form>
                                    </div>
                                 </div>
                                 <!-- delete model -->
                                 <div class="modal fade" id="deleteInvoice<?php echo $srNo; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                       <div class="modal-content">
                                          <div class="modal-header">
                                             <h5 class="modal-title" id="exampleModalLabel">Delete Invoice</h5>
                                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                             <span aria-hidden="true">&times;</span>
                                             </button>
                                          </div>
                                          <div class="modal-body">
                                             <div class="row">
                                                <form action="<?php echo base_url('delete_sale_invoice'); ?>" method="POST">
                                                   <div class="col-lg-12">
                                                      <div class="form-group">
                                                         <label for=""><b>Are you sure want to Delete this invoice?</b> </label>
                                                         <input type="hidden" name="sales_id" value="<?php echo $c->id ?>" required class="form-control">
                                                         <input type="hidden" name="status" value="<?php echo $c->status ?>" required class="form-control">
                                                      </div>
                                                   </div>
                                             </div>
                                          </div>
                                          <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                          <button type="submit" class="btn btn-primary">Delete</button>
                                          </div>
                                       </div>
                                       </form>
                                    </div>
                                 </div>
                              </td>
                           </tr>
                           <?php
                              $srNo++;
                              }
                              }
                              }
                              ?>
                        </tbody>
                        <!-- Pagination code
                           <p><php echo $links; ?></p>
                           <div class="row"><div class="col-sm-12 col-md-5"><div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing 1 to 10 of 10 entries</div></div><div class="col-sm-12 col-md-7"><div class="dataTables_paginate paging_simple_numbers" id="example1_paginate"><ul class="pagination"><li class="paginate_button page-item previous disabled" id="example1_previous"><a href="#" aria-controls="example1" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li><li class="paginate_button page-item active"><a href="#" aria-controls="example1" data-dt-idx="1" tabindex="0" class="page-link">1</a></li><li class="paginate_button page-item next disabled" id="example1_next"><a href="#" aria-controls="example1" data-dt-idx="2" tabindex="0" class="page-link">Next</a></li></ul></div></div></div>
                           
                           -->
                     </table>
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