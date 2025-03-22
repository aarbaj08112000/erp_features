<div class="content-wrapper">
   <div class="container-xxl flex-grow-1 container-p-y">
      <nav aria-label="breadcrumb">
         <div class="sub-header-left pull-left breadcrumb">
            <h1>
               Store
               <a hijacked="yes" href="javascript:void(0)" class="backlisting-link" title="">
               <i class="ti ti-chevrons-right"></i>
               <em>Customer Parts Return</em></a>
            </h1>
            <br>
            <span>View Customer Parts Return</span>
         </div>
        </nav>
        <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5 listing-btn">
            <a title="Back To Customer Parts Return" class="btn btn-seconday" href="<%base_url('challan_part_return')%>" type="button"><i class="ti ti-arrow-left"></i></a>
        </div>
      <!-- Main content -->
      <section class="content">
         <div class="">
            <div class="row">
               <div class="col-12">
                  <!-- /.card -->
                  <div class="card">
                     <div class="card-header">
                        <div class="row">
                            <div class="tgdp-rgt-tp-sect">
                              <p class="tgdp-rgt-tp-ttl">CR No</p>
                              <p class="tgdp-rgt-tp-txt">
                                 <%$challan_part_return_details['grn_code'] %>
                              </p>
                           </div>
                           <div class="tgdp-rgt-tp-sect">
                              <p class="tgdp-rgt-tp-ttl">Customer Name</p>
                              <p class="tgdp-rgt-tp-txt">
                                 <%$challan_part_return_details['customer_name'] %>
                              </p>
                           </div>
                           <div class="tgdp-rgt-tp-sect">
                              <p class="tgdp-rgt-tp-ttl">Customer Challan No</p>
                              <p class="tgdp-rgt-tp-txt">
                                 <%display_no_character($challan_part_return_details['customer_challan_no']) %>
                              </p>
                           </div>
                           <div class="tgdp-rgt-tp-sect">
                              <p class="tgdp-rgt-tp-ttl">Transporter</p>
                              <p class="tgdp-rgt-tp-txt">
                                 <%$challan_part_return_details['transporter_name']%>-<%$challan_part_return_details['transporter_id']%>
                              </p>
                           </div>
                           <div class="tgdp-rgt-tp-sect">
                              <p class="tgdp-rgt-tp-ttl">Vehicle No.</p>
                              <p class="tgdp-rgt-tp-txt">
                                 <%display_no_character($challan_part_return_details['vehicle_number'])%>
                              </p>
                           </div>
                           <div class="tgdp-rgt-tp-sect">
                              <p class="tgdp-rgt-tp-ttl">Customer Challan No</p>
                              <p class="tgdp-rgt-tp-txt">
                                 <%display_no_character($challan_part_return_details['customer_challan_no'])%>
                              </p>
                           </div>
                           <div class="tgdp-rgt-tp-sect">
                              <p class="tgdp-rgt-tp-ttl">Created Date</p>
                              <p class="tgdp-rgt-tp-txt">
                                 <%defaultDateFormat($challan_part_return_details['created_date'])%>
                              </p>
                           </div>
                           <div class="tgdp-rgt-tp-sect">
                              <p class="tgdp-rgt-tp-ttl">Created Date</p>
                              <p class="tgdp-rgt-tp-txt">
                                 <%$challan_part_return_details['status'] %>
                              </p>
                           </div>

                           
                        </div>
                     </div>


                    </div>
                     <div class="card mt-4">
                        <div class="card-header pdf-btn-block">
                     <%if ($challan_part_return_details['status'] == "Lock")%>
                            
                                <!-- Modal -->
                                <div class="row">
                                    <div class="col-lg-1 original">
                                        <div class="form-group">
                                            <a class="btn btn-success" href="<%base_url('generate_customer_challan_part_return_pdf/')%><%$challan_part_return_details['customer_challan_part_return_id'] %>/ORIGINAL_FOR_RECIPIENT">Original </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-1 duplicate">
                                        <div class="form-group">
                                            <a class="btn btn-success" href="<%base_url('generate_customer_challan_part_return_pdf/')%><%$challan_part_return_details['customer_challan_part_return_id']%>/DUPLICATE_FOR_TRANSPORTER">Duplicate </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-1 triplicate">
                                        <div class="form-group">
                                            <a class="btn btn-success" href="<%base_url('generate_customer_challan_part_return_pdf/')%><%$challan_part_return_details['customer_challan_part_return_id']%>/TRIPLICATE_FOR_SUPPLIER">Triplicate  </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-1 acknowledge">
                                        <div class="form-group">
                                            <a class="btn btn-success" href="<%base_url('generate_customer_challan_part_return_pdf/')%><%$challan_part_return_details['customer_challan_part_return_id']%>/ACKNOWLEDGEMENT_COPY">Acknowledge  </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-1  extra-copy">
                                        <div class="form-group">
                                            <a class="btn btn-success" href="<%base_url('generate_customer_challan_part_return_pdf/')%><%$challan_part_return_details['customer_challan_part_return_id']%>/EXTRA_COPY">Extra Invoice </a>
                                        </div>
                                    </div>

                                </div>
                                <form action="<%base_url('generate_customer_challan_part_return_multiple_pdf/')%><%$challan_part_return_details['customer_challan_part_return_id']%>" method="post" style="padding-top: 23px;">
                                        <div class="row">
                                            <div class="col-lg-1 original-check mt-2">
                                                <div class="form-group">    
                                                    <input type="checkbox" id="original" name="interests[]" value="ORIGINAL_FOR_RECIPIENT">
                                                    <label for="original">Original</label><br>
                                                </div>
                                            </div>
                                            <div class="col-lg-1 duplicate-check mt-2">
                                                <div class="form-group">    
                                                    <input type="checkbox" id="duplicate" name="interests[]" value="DUPLICATE_FOR_TRANSPORTER">
                                                    <label for="duplicate">Duplicate</label><br>
                                                </div>
                                            </div>
                                            <div class="col-lg-1 triplicate-check mt-2">
                                                <div class="form-group ">   
                                                <!-- <div style="display: inline-block;"> -->
                                                    <input type="checkbox" id="triplicate" name="interests[]" value="TRIPLICATE_FOR_SUPPLIER">
                                                    <label for="triplicate">Triplicate</label><br>
                                                </div>
                                            </div>
                                            <div class="col-lg-1 acknowledge-check mt-2">
                                                <div class="form-group">   
                                                <!-- <div style="display: inline-block;"> -->
                                                    <input type="checkbox" id="acknowledge" name="interests[]" value="ACKNOWLEDGEMENT_COPY">
                                                    <label for="acknowledge">Acknowledge</label><br>
                                                </div>
                                            </div>
                                            <div class="col-lg-1 extra-copy-check mt-2">
                                                <div class="form-group">   
                                                <!-- <div style="display: inline-block;"> -->
                                                    <input type="checkbox" id="extraCopy" name="interests[]" value="EXTRA_COPY">
                                                    <label for="extraCopy">EXTRA COPY</label><br>
                                                </div>
                                            </div>
                                            <div class="col-lg-1 print-btn">
                                                <div class="form-group">   
                                                <!-- <div style="display: inline-block;"> -->
                                                    <button type="submit" onclick="this.form.target='_blank';return true;" class="btn btn-info btn"> Print </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                
                           
                    <%/if%>
                     
                        <%if ($challan_part_return_details) %>

                            <%if ($challan_part_return_details['status'] == "Pending") %>
                                <%if ($user_type == 'admin' || $user_type == 'Admin' || checkGroupAccess("challan_part_return","update","No")) %>
                                    <button type="button" class="btn btn-danger ml-1" data-bs-toggle="modal" data-bs-target="#lock" <%if     (!$challan_part_return_part_details)%>disabled <%/if%>>
                                    Lock Customer Parts Return
                                    </button>
                                <%/if%>
                            <%/if%>
                        <%/if%>
                        <%if ($new_sales[0]->status == "lock") %>
                            <%if ($this->session->userdata['type'] == 'admin' || $this->session->userdata['type'] == 'Admin') %>
                            <!-- <button type="button" class="btn btn-success ml-1" data-toggle="modal" data-target="#accpet">
                               Accept (Released) Invoice
                               </button>
                               <button type="button" class="btn btn-danger ml-1" data-toggle="modal" data-target="#delete">
                               Reject (delete) Invoice
                               </button> -->
                            <%/if%>
                        <%else %>
                            <%if ($challan_part_return_details['status'] != "Pending") %>
                            <button type="button" disabled class="btn btn-success ml-1 mt-3" data-toggle="modal" data-target="#accpet">
                            Customer Parts Return Locked
                            </button>
                        <%/if%>
                        <%/if%>
                        <!-- Modal -->
                        <div class="modal fade" id="lock" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                           <div class="modal-dialog">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Lock</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    </button>
                                 </div>
                                 <div class="modal-body">
                                    <div class="row">
                                       <form action="<%base_url('lock_customer_challan_return_part') %>" method="POST" id="lock_customer_challan_return_part" class="lock_customer_challan_return_part">
                                          <div class="col-lg-12">
                                             <div class="form-group">
                                                <label for=""><b>Are You Sure Want To Lock This
                                                Challan Part Return?</b> </label>
                                                <input type="hidden" name="id" value="<%$challan_part_return_details['customer_challan_part_return_id'] %>" required class="form-control">
                                                <input type="hidden" name="status" value="Lock" required class="form-control">
                                             </div>
                                          </div>
                                    </div>
                                 </div>
                                 <div class="modal-footer">
                                 <button type="button" class="btn btn-secondary" data-bd-dismiss="modal">Close</button>
                                 <button type="submit" class="btn btn-primary">Lock</button>
                                 </div>
                              </div>
                              </form>
                           </div>
                        </div>
                     </div>
                     </div>


                     <div class="card mt-4">
                     <div class="">
                        <table class="table table-striped scrollable" id="challan_part_return">
                           <thead>
                              <tr>
                                 <th>Sr No</th>
                                 <th>Part Number</th>
                                 <th>Part Description</th>
                                 <th>Tax Strucutre</th>
                                 <th>UOM</th>
                                 <th>QTY</th>
                                 <th>Price</th>
                                 <th>CGST</th>
                                 <th>SGST</th>
                                 <th>IGST</th>
                                 <th>TCS</th>
                                 <th>Sub Total</th>
                                 <th>GST</th>
                                 <th>Total Price</th>
                                 <th>Actions</th>
                                 <!-- <th>Accept/Reject</th> -->
                              </tr>
                           </thead>
                           <tbody>
                                <%assign var='total_final_amount' value=0 %>
                                <%if ($challan_part_return_part_details) %>
                                    <%assign var='i' value=1 %>
                                     
                                    <%foreach from=$challan_part_return_part_details item=p %>
                                        <%assign var='total_final_amount' value=$total_final_amount + $p['total_rate'] %>                                
                                      <tr>
                                         <td><%$i%></td>
                                         <td><%$p['part_number']%></td>
                                         <td><%$p['part_description']%></td>
                                         <td><%$p['gst_structure']%></td>
                                         <td><%$p['uom']%></td>
                                         <td><%$p['qty']%></td>
                                         <td><%number_format($p['part_price'],2)%></td>
                                         <td><%number_format($p['cgst_amount'],2)%></td>
                                         <td><%number_format($p['sgst_amount'],2)%></td>
                                         <td><%number_format($p['igst_amount'],2)%></td>
                                         <td><%number_format($p['tcs_amount'],2)%></td>
                                         <td><%number_format($p['basic_total'],2)%></td>
                                         <td><%number_format($p['gst_amount'],2)%></td>
                                         <td><%number_format($p['total_rate'],2)%></td>
                                         <td>
                                            <%if ($challan_part_return_details['status'] == "Pending") %>
                                            <!-- Button trigger modal -->
                                            <a type="button" class="" data-bs-toggle="modal" data-bs-target="#exampleModal<%$i%>">
                                            <i class="ti ti-edit"></i>
                                            </a>
                                            <!-- <button type="button" class="btn btn-danger ml-1" data-toggle="modal" data-target="#exampleModaldelete<%$i%>">
                                            Delete
                                            </button> -->
                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal<%$i%>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                               <div class="modal-dialog modal-dialog-centered">
                                                  <div class="modal-content">
                                                     <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Update
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bd-dismiss="modal" aria-label="Close">
                                                        
                                                        </button>
                                                     </div>
                                                     <div class="modal-body">
                                                        <div class="row">
                                                           <div class="col-lg-12">
                                                              <div class="form-group">
                                                                 <form action="<%base_url('update_customer_challan_part_return')%>" method="POST" class="update_customer_challan_part_return update_customer_challan_part_return<%$i%> custom-form" id="update_customer_challan_part_return<%$i%>">
                                                                    <label for="">Enter Qty <span class="text-danger">*</span>
                                                                    </label>
                                                                    <input type="text" name="qty" value="<%$p['qty'] %>" placeholder="Enter QTY "  class="form-control onlyNumericInput required-input" data-min='1'>
                                                                    <input type="hidden" name="customer_challan_part_return_part_id" value="<%$p['customer_challan_part_return_part_id'] %>" 
                                                                       placeholder="Enter QTY " required class="form-control">
                                                                    <input type="hidden" name="part_id" value="<%$p['part_id'] %>" 
                                                                       placeholder="Enter QTY " required class="form-control">
                                                                    <input type="hidden" name="customer_id" value="<%$p['customer_id'] %>" 
                                                                       placeholder="Enter QTY " required class="form-control">
                                                              </div>
                                                           </div>
                                                        </div>
                                                     </div>
                                                     <div class="modal-footer">
                                                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                     <button type="submit" class="btn btn-primary">Update</button>
                                                     </div>
                                                  </div>
                                                  </form>
                                               </div>
                                            </div>
                                            <!-- Modal -->
                                            <!-- <div class="modal fade" id="exampleModaldelete<?php echo $i; ?>" tabindex="-1" aria-labelledby="" aria-hidden="true">
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
                                                                    <input type="hidden" name="table_name" value="parts_rejection_sales_invoice" required class="form-control">
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
                                            </div> -->
                                            <%else %>
                                               <%display_no_character()%>
                                            <%/if%>
                                         </td>
                                         
                                      </tr>
                                    <%assign var='i' value=$i+1 %>
                                    <%/foreach%>
                                <%/if%>
                           </tbody>
                           <tfoot>
                              <tr>
                                 <th
                                    >Total</th>
                                 <th></th>
                                 <th></th>
                                 <th></th>
                                 <th></th>
                                 <th></th>
                                 <th></th>
                                 <th></th>
                                 <th></th>
                                 <th></th>
                                 <th></th>
                                 <th></th>
                                 <th></th>
                                 <th><%number_format($total_final_amount,2)%></th>
                                 <th></th>
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
<style type="text/css">
   .hide {
   display: none;
   }
</style>
<script src="<%$base_url%>/public/js/store/challan_part_return_details.js"></script>