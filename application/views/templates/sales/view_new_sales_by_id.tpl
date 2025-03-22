<div  class="wrapper container-xxl flex-grow-1 container-p-y">
<!-- Navbar -->
<!-- /.navbar -->
<!-- Main Sidebar Container -->
<nav aria-label="breadcrumb">
   <div class="sub-header-left pull-left breadcrumb">
      <h1>
         Planning & Sales
         <a hijacked="yes" href="#stock/issue_request/index" class="backlisting-link" title="Back to Issue Request Listing" >
         <i class="ti ti-chevrons-right" ></i>
         <em >Sales Invoice</em></a>
      </h1>
      <br>
      <span >View Sales Invoice</span>
   </div>
</nav>
<div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5 listing-btn">
            <a title="Back To Supplier Po List" class="btn btn-seconday" href="<%$base_url%>sales_invoice_released" type="button"><i class="ti ti-arrow-left"></i></a>
        </div>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<!-- Main content -->
<section class="content">
   <div class="">
      <div class="row">
         <div class="col-12">
          <input type="hidden" value="<%$new_sales[0]->id %>" id="sales_primary_id" class="form-control">
          <input type="hidden" value="<%$new_sales[0]->created_date %>" id="invoice_date" class="form-control">
          <input type="hidden" value="<%$new_sales[0]->sales_number %>" id="invoice_no" class="form-control">
          <input type="hidden" value="<%$new_sales[0]->sales_number %>" id="sales_number" class="form-control">
            <!-- /.card -->
            <%if (empty($e_invoice_status) && ($einvoice_res_data[0]->EwbStatus) ||  ($new_sales[0]->status == "pending" ) || $new_sales[0]->status == "unlocked")%>
            <div class="card p-0 mt-4">
               <div class="card-header">
                  <form action="<%$base_url%>generate_new_sales_update" method="POST">
                     <div class="row">
                     </div>
                     <div id="loading-overlay">
                        <div id="loading-spinner"></div>
                     </div>
                     <div class="row">
                        <div class="col-lg-4">
                           <div class="form-group mb-3">
                              <label for="" class="form-label">Transport Mode<span class="text-danger">*</span></label>
                              <select name="mode" class="form-control" required>
                                 <option value="">Select</option>
                                 <option value="1" <%if $new_sales[0]->mode == '1'%>selected<%/if%>>Road</option>
                                 <option value="2" <%if $new_sales[0]->mode == '2'%>selected<%/if%>>Rail</option>
                                 <option value="3" <%if $new_sales[0]->mode == '3'%>selected<%/if%>>Air</option>
                                 <option value="4" <%if $new_sales[0]->mode == '4'%>selected<%/if%>>Ship</option>
                              </select>
                           </div>
                        </div>
                        <div class="col-lg-4">
                           <div class="form-group mb-3">
                              <label for=""  class="form-label">Transporter<span class="text-danger">*</span></label>
                              <select name="transporter" required id="transporter" class="form-control select2">
                                 <option value="">Select</option>
                                 <%foreach from=$transporter item=tr%>
                                 <option value="<%$tr->id%>" <%if $new_sales[0]->transporter_id == $tr->id%>selected<%/if%>><%$tr->name%> - <%$tr->transporter_id%></option>
                                 <%/foreach%>
                              </select>
                           </div>
                        </div>
                        <div class="col-lg-4">
                           <div class="form-group mb-3">
                              <label for=""  class="form-label">Vehicle No.<span class="text-danger">*</span></label>
                              <input type="text" placeholder="Enter Vehicle No" name="vehicle_number" value="<%$new_sales[0]->vehicle_number%>" class="form-control"/>
                           </div>
                        </div>
                        <div class="col-lg-4">
                           <div class="form-group mb-3">
                              <label for=""  class="form-label">Distance<span class="text-danger">*</span></label>
                              <input type="text" placeholder="Enter Distance of Transportation" value="<%$new_sales[0]->distance%>" required name="distance" class="form-control">
                           </div>
                        </div>
                        <div class="col-lg-4">
                           <div class="form-group mb-3">
                              <label for=""  class="form-label">L.R No</label>
                              <input type="text" placeholder="Enter L.R No" name="lr_number" value="<%$new_sales[0]->lr_number%>" class="form-control">
                           </div>
                        </div>
                        <div class="col-lg-4">
                           <div class="form-group mb-3">
                              <label for=""  class="form-label">PO Remark </label>
                              <input type="text" placeholder="Enter Remark" value="<%$new_sales[0]->remark%>" name="remark" class="form-control">
                              <input type="hidden" value="<%$uri_segment_2%>" name="id" class="form-control">
                           </div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <div class="form-group mb-3 ">
                               <label class="form-label">Apply Discount</label>
                               <br>
                               <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="isDiscount" <%if ($new_sales[0]->discountType !='NA')%>checked<%/if%> value="Yes" onchange="toggleDiscountSelection()" class="form-check-input">
                                <label class="form-check-label" for="isDiscount">Yes</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="isDiscount" <%if ($new_sales[0]->discountType === 'NA') %>checked<%/if%> value="No" onchange="toggleDiscountSelection()">
                                <label class="form-check-label" for="isDiscount">No</label>
                              </div>
                                
                            </div>
                        </div>
                        <div class="col-lg-4" id="discountTypeSection">
                          <div class="form-group mb-3">
                             <label class="form-label">Discount Type</label><span class="text-danger"><br></span>
                             <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="discountType" id="discountType2" <%if ($new_sales[0]->discountType === 'Percentage') %>checked<%/if%> value="Percentage">
                                <label class="form-check-label" for="discountType">Percentage</label>
                              </div>
                          </div>
                        </div>
                        <div class="col-lg-4" id="discountValueSection">
                           <div class="form-group mb-3">
                              <label class="form-label">Discount</label>
                              <input type="text" step="any" name="discount" id="discountId" value="<%$new_sales[0]->discount %>" class="form-control onlyNumericInput" placeholder="Discount" >
                              <input type="hidden" name="discount_amount" id="discountValueInput1" value="<%$discount_amount %>" />
                              <input type="hidden" name="final_basic_total" id="final_basic_total" value="<%$final_basic_total %>" />
                           </div>
                        </div>
                        <div class="col-lg-12">
                           <div class="form-group mb-3">
                              <button type="submit" class="btn btn-danger mt-4">Update</button>
                           </div>
                        </div>
                     </div>
                  </form>
                  
               </div>
            </div>
            <%/if%>
            
            <%if $new_sales[0]->status == "Cancelled" || $new_sales[0]->status == "unlocked" || (empty($e_invoice_status) &&  $new_sales[0]->status == "pending")%>
            <div class="card p-0 mt-4">
               <div class="card-header">
                    <div class="row">
                    <div class="tgdp-rgt-tp-sect">
                        <p class="tgdp-rgt-tp-ttl">Customer Name - Part Number</p>
                        <p class="tgdp-rgt-tp-txt" title="<%$customer[0]->customer_name%> - <%$customer_part_details[0]->part_number%>">
                        <%$customer[0]->customer_name%> - <%$customer_part_details[0]->part_number%>
                        </p>
                    </div>
                    <div class="tgdp-rgt-tp-sect">
                        <p class="tgdp-rgt-tp-ttl">Sales Invoice Number</p>
                        <p class="tgdp-rgt-tp-txt" title="<%$new_sales[0]->sales_number%>">
                        <%$new_sales[0]->sales_number%>
                        </p>
                    </div>
                    <div class="tgdp-rgt-tp-sect">
                        <p class="tgdp-rgt-tp-ttl">Current Status</p>
                        <p class="tgdp-rgt-tp-txt" title="<%if $new_sales[0]->status == "accpet"%>Released<%else%><%$new_sales[0]->status%><%/if%>">
                        <%if $new_sales[0]->status == "accpet"%>Released<%else%><%$new_sales[0]->status%><%/if%>
                        </p>
                       
                    </div>
                    <div class="tgdp-rgt-tp-sect">
                        <p class="tgdp-rgt-tp-ttl">E Invoice Status</p>
                        <p class="tgdp-rgt-tp-txt" title="<%$e_invoice_status[0]->Status%>">
                        <%display_no_character($e_invoice_status[0]->Status)%>
                        </p>
                    </div>
                    <div class="tgdp-rgt-tp-sect">
                        <p class="tgdp-rgt-tp-ttl">PO Remark</p>
                        <p class="tgdp-rgt-tp-txt" title="<%$new_sales[0]->remark%>">
                        <%display_no_character($new_sales[0]->remark)%>
                        </p>
                    </div>
                    
                   
                    </div>
               </div>
            </div>
            <%/if%>
            <%if $new_sales[0]->status =="lock" %>
            <div class="card p-0 mt-4">
               <div class="card-header">
                  <div class="row">
                     <div class="tgdp-rgt-tp-sect">
                        <p class="tgdp-rgt-tp-ttl">Transport Mode</p>
                        <p class="tgdp-rgt-tp-txt">
                           <%if $new_sales[0]->mode == '1'%>Road<%/if%>
                           <%if $new_sales[0]->mode == '2'%>Rail<%/if%>
                           <%if $new_sales[0]->mode == '3'%>Air<%/if%>
                           <%if $new_sales[0]->mode == '4'%>Ship<%/if%>
                        </p>
                     </div>
                     <div class="tgdp-rgt-tp-sect">
                        <p class="tgdp-rgt-tp-ttl">Transporter</p>
                        <p class="tgdp-rgt-tp-txt">
                           <%foreach from=$transporter item=tr%>
                           <%if $new_sales[0]->transporter_id == $tr->id%><%$tr->name%> - <%$tr->transporter_id%><%/if%>
                           <%/foreach%>
                        </p>
                     </div>
                     <div class="tgdp-rgt-tp-sect">
                        <p class="tgdp-rgt-tp-ttl">Vehicle No.</p>
                        <p class="tgdp-rgt-tp-txt"><%$new_sales[0]->vehicle_number%></p>
                     </div>
                     <div class="tgdp-rgt-tp-sect">
                        <p class="tgdp-rgt-tp-ttl">Distance</p>
                        <p class="tgdp-rgt-tp-txt"><%$new_sales[0]->distance%> </p>
                     </div>
                     <div class="tgdp-rgt-tp-sect">
                        <p class="tgdp-rgt-tp-ttl">L.R No</p>
                        <p class="tgdp-rgt-tp-txt"><%display_no_character($new_sales[0]->lr_number)%></p>
                     </div>
                     <div class="tgdp-rgt-tp-sect">
                        <p class="tgdp-rgt-tp-ttl">PO Remark</p>
                        <p class="tgdp-rgt-tp-txt"><%display_no_character($new_sales[0]->remark)%></p>
                     </div>
                     <div class="tgdp-rgt-tp-sect">
                        <p class="tgdp-rgt-tp-ttl">Customer Name - Part Number</p>
                        <p class="tgdp-rgt-tp-txt"><%$customer[0]->customer_name%> - <%$customer_part_details[0]->part_number%></p>
                     </div>
                     <div class="tgdp-rgt-tp-sect">
                        <p class="tgdp-rgt-tp-ttl">Sales Invoice Number</p>
                        <p class="tgdp-rgt-tp-txt"><%$new_sales[0]->sales_number%></p>

                     </div>
                     <div class="tgdp-rgt-tp-sect">
                        <p class="tgdp-rgt-tp-ttl">Current Status</p>
                        <p class="tgdp-rgt-tp-txt"><%if $new_sales[0]->status == "accpet"%>Released<%else%><%$new_sales[0]->status%><%/if%></p>
                     </div>
                     <div class="tgdp-rgt-tp-sect">
                        <p class="tgdp-rgt-tp-ttl">E Invoice Status</p>
                        <p class="tgdp-rgt-tp-txt"><%display_no_character($e_invoice_status[0]->Status)%></p>
                     </div>
                     <div class="tgdp-rgt-tp-sect">
                        <p class="tgdp-rgt-tp-ttl">PO Remark</p>
                        <p class="tgdp-rgt-tp-txt"><%display_no_character($new_sales[0]->remark)%></p>
                     </div>
                     
                     <div class="tgdp-rgt-tp-sect">
                        <p class="tgdp-rgt-tp-ttl">Apply Discount</p>
                        <p class="tgdp-rgt-tp-txt">
                          <%if ($new_sales[0]->discountType !='NA')%>
                          Yes
                          <%else%>
                          No
                          <%/if%>
                        </p>
                     </div>
                     <%if ($new_sales[0]->discountType !='NA')%>
                     <div class="tgdp-rgt-tp-sect">
                        <p class="tgdp-rgt-tp-ttl">Discount Type</p>
                        <p class="tgdp-rgt-tp-txt"><%display_no_character($new_sales[0]->discountType)%></p>
                     </div>
                     <div class="tgdp-rgt-tp-sect">
                        <p class="tgdp-rgt-tp-ttl">Discount</p>
                        <p class="tgdp-rgt-tp-txt"><%display_no_character($new_sales[0]->discount)%></p>
                     </div>
                     <%/if%>
                  </div>
               </div>
            </div>
            <%/if%>
            <%if ($new_sales[0]->status == "lock" || $new_sales[0]->status == "pending" || $new_sales[0]->status == "unlocked" )%>
            <div class="card mt-3">
               <div class="card-header pdf-btn-block">
                    <div class="row">
                      <div class="col-lg-1 packaging-sticker" >
                        <div class="form-group">
                            <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                data-bs-target="#printForTally" id="printSticker">
                            Packaging Sticker
                            </button>

                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="printForTally" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Packaging Stickers</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <section class="content" id="observationTableData">
                                </section>
                                </div>
                            </div>
                        </div>
                    </div>
                    <%if $new_sales[0]->status == "lock" || $new_sales[0]->status == "pending" || $new_sales[0]->status == "unlocked"%>
                    <div class="col-lg-1 view-original" >
                        <div class="form-group ">
                            <a class="btn btn-success" href="<%$base_url%>view_original_sales_invoice/<%$uri_segment_2%>" target="_blank">View Original</a>
                        </div>
                    </div>
                    <%/if%>
                    <%if ($new_sales[0]->status == "pending" || $new_sales[0]->status == "unlocked" )  && checkGroupAccess("sales_invoice_released","list","No")%>
                      <%if $po_parts%>
                            <%if $session_type == 'admin' || $session_type == 'Admin' || $session_type == 'Sales' || checkGroupAccess("sales_invoice_released","update","No")%>
                                    <%assign var="flag" value=0%>
                                    <%assign var="final_po_amount" value=0%>
                                    <%assign var="i" value=1%>
                                    <%foreach from=$po_parts item=p%>
                                    <%if empty($p->tax_id)%>
                                    <%assign var="flag" value=1%>
                                    <%/if%>
                                    <%/foreach%>
                                    <%if $flag == 0%>
                                    <div class="col-lg-1 view-original" >
                                    <button type="button" class="btn btn-info ml-1 " data-bs-toggle="modal" data-bs-target="#lock">
                                    Lock Invoice
                                    </button>
                                    </div>
                                        <%if $new_sales[0]->status == "pending" %>
                                        <div class="col-lg-1 view-original" >
                                        <button type="button" class="btn btn-danger ml-1" data-bs-toggle="modal" data-bs-target="#deleteInvoice">
                                        Delete Invoice
                                        </button>
                                      </div>
                                        <%/if%>
                                    <!-- delete model -->
                                    <div class="modal fade" id="deleteInvoice" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Delete Invoice</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <form action="<%$base_url%>delete_sale_invoice" method="POST" id="delete_sale_invoice" class="delete_sale_invoice">
                                                        <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label for=""><b>Are you sure want to Delete this invoice ?</b> </label>
                                                            <input type="hidden" name="sales_id" value="<%$new_sales[0]->id%>" required class="form-control">
                                                            <input type="hidden" name="status" value="<%$new_sales[0]->status%>" required class="form-control">
                                                        </div>
                                                        </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Delete</button>
                                            </div>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                    <%else%>
                                    <div class='alert alert-danger' style='width:400px'>Error : Check GST Of All Parts, to lock this invoice</div>
                                    <%/if%>
                            <%/if%>
                      <%/if%>
                    <%/if%>
                  
                    <%if $new_sales[0]->status == "lock" %>
                    <div class="col-lg-1 original hide" >
                        <div class="form-group">
                            <a class="btn btn-success" href="<%$base_url%>generate_sales_invoice/<%$uri_segment_2%>/ORIGINAL_FOR_RECIPIENT">Original</a>
                        </div>
                    </div>
                    <div class="col-lg-1 duplicate hide" >
                        <div class="form-group">
                            <a class="btn btn-success" href="<%$base_url%>generate_sales_invoice/<%$uri_segment_2%>/DUPLICATE_FOR_TRANSPORTER">Duplicate</a>
                        </div>
                    </div>
                    <div class="col-lg-1 triplicate hide" >
                        <div class="form-group">
                            <a class="btn btn-success" href="<%$base_url%>generate_sales_invoice/<%$uri_segment_2%>/TRIPLICATE_FOR_SUPPLIER">Triplicate</a>
                        </div>
                    </div>
                    <div class="col-lg-1 acknowledge hide" >
                        <div class="form-group" >
                            <a class="btn btn-success" href="<%$base_url%>generate_sales_invoice/<%$uri_segment_2%>/ACKNOWLEDGEMENT_COPY">Acknowledge</a>
                        </div>
                    </div>
                    <div class="col-lg-1 extra-copy hide" >
                        <div class="form-group">
                            <a class="btn btn-success" href="<%$base_url%>generate_sales_invoice/<%$uri_segment_2%>/EXTRA_COPY">Extra Invoice</a>
                        </div>
                    </div>
                    <%if empty($einvoice_res_data[0]->Status) || true%>

                        <%if empty($einvoice_res_data[0]->Irn) && empty($einvoice_res_data[0]->Status)%>
                          <div class="col-lg-1 extra-copy" >
                              <div class="form-group">
                                   <a class="btn btn-info "  href="<%base_url('generate_E_invoice/')%><%$uri_segment_2%>/EINVOICE" target="_blank">E-Invoice </a>
                              </div>
                          </div>
                        <%else%>
                          <!-- <div class="col-lg-1 extra-copy" >
                              <div class="form-group">
                                   <a class="btn btn-info"  href="<%base_url('view_E_invoice/')%><%$uri_segment_2%>">Get E-Invoice Details</a>
                              </div>
                          </div> -->
                        <%/if%>
                         <%if empty($einvoice_res_data[0]->EwbStatus) || $einvoice_res_data[0]->EwbStatus=="CANCELLED" %>
                              <div class="col-lg-1 extra-copy">
                                 <div class="form-group ">
                                    <button type="button" style="width: 90%;" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#createEBill<%$uri_segment_2%>" target="_blank">Eway Bill</button>
                                 </div>
                              </div>

                              <!-- Modal for create way bill -->
                                 <div class="modal fade" id="createEBill<%$uri_segment_2%>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                       <div class="modal-content">
                                          <div class="modal-header">
                                             <h5 class="modal-title" id="exampleModalLabel">Create Eway Bill</h5>
                                             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                             </button>
                                          </div>
                                           <form action="<%$base_url%>generate_EwayBill" method="post" id="generate_EwayBill">
                                          <div class="modal-body">
                                             
                                                <input type="hidden" name="page_type" value="sales_invoice">
                                                <input value="<%$uri_segment_2%>" type="hidden" name="new_sales_id" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Customer Name">
                                                <div class="form-group">
                                                   <label for="">Mode Of Transport<span class="text-danger">*</label>
                                                   <select name="transMode" class="form-control select2" >
                                                      <!--<option value="">Select</option>-->
                                                      <option value="1" <%if $new_sales[0]->mode == '1'%>selected<%/if%>>Road</option>
                                                     <option value="2" <%if $new_sales[0]->mode == '2'%>selected<%/if%>>Rail</option>
                                                     <option value="3" <%if $new_sales[0]->mode == '3'%>selected<%/if%>>Air</option>
                                                     <option value="4" <%if $new_sales[0]->mode == '4'%>selected<%/if%>>Ship</option>
                                                   </select>
                                                </div>
                                                <div class="form-group">
                                                   <label for="">Transporter<span class="text-danger">*</label>
                                                   <select name="transporterId"  id="transporter" class="form-control select2">
                                                      <option value="">Select Transporter</option>
                                                      
                                                         <%foreach from=$transporter item=tr%>
                                                         <option value="<%$tr->id%>" <%if $new_sales[0]->transporter_id == $tr->id%>selected<%/if%>><%$tr->name%> - <%$tr->transporter_id%></option>
                                                         <%/foreach%>
                                                   </select>
                                                </div>
                                                <div class="form-group">
                                                   <label for="">Enter Vehicle No. <span class="text-danger">*</label>
                                                   <input type="text" placeholder="Enter Vehicle No" name="vehicleNo" value="<%$new_sales[0]->vehicle_number %>"   class="form-control">
                                                </div>
                                                <div class="form-group">
                                                   <label for="">Distance of Transportation<span class="text-danger">*</label>
                                                   <input type="text" placeholder="Enter Distance of Transportation" name="distance" value="<%$new_sales[0]->distance %>"   class="form-control">
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
                                 <%else%>
                        <div class="col-lg-1 packaging-sticker" >
                              <div class="form-group">
                                   <a class="btn btn-info" target="_blank"  href="<%base_url('view_EwayBill/')%><%$uri_segment_2%>"> Eway Bill Details</a>
                              </div>
                          </div>
                        <%/if%>
                    <%/if%>

                  
                    
               <div>
            </div>
            <!-- Print selection -->
            <form action="<%$base_url%>print_sales_invoice/<%$uri_segment_2%>" method="post" class="mt-4">
               <div class="row">
                  <div class="col-lg-1 mt-2 original-check">
                     <div class="form-group">    
                        <input type="checkbox" id="original" name="interests[]" value="ORIGINAL_FOR_RECIPIENT">
                        <label for="original">Original</label><br>
                     </div>
                  </div>
                  <div class="col-lg-1  mt-2 duplicate-check">
                     <div class="form-group">    
                        <input type="checkbox" id="duplicate" name="interests[]" value="DUPLICATE_FOR_TRANSPORTER">
                        <label for="duplicate">Duplicate</label><br>
                     </div>
                  </div>
                  <div class="col-lg-1 mt-2 triplicate-check">
                     <div class="form-group">
                        <input type="checkbox" id="triplicate" name="interests[]" value="TRIPLICATE_FOR_SUPPLIER">
                        <label for="triplicate">Triplicate</label><br>
                     </div>
                  </div>
                  <div class="col-lg-1 mt-2 acknowledge-check">
                     <div class="form-group" >   
                        <input type="checkbox" id="acknowledge" name="interests[]" value="ACKNOWLEDGEMENT_COPY">
                        <label for="acknowledge">Acknowledge</label><br>
                     </div>
                  </div>
                  <div class="col-lg-1 mt-2 extra-copy-check">
                     <div class="form-group">   
                        <input type="checkbox" id="extraCopy" name="interests[]" value="EXTRA_COPY">
                        <label for="extraCopy">Extra Copy</label><br>
                     </div>
                  </div>        
                  <div class="col-lg-1 print-btn">
                     <div class="form-group">
                        <button type="submit" onclick="this.form.target='_blank';return true;" class="btn btn-info btn"> Print </button>
                     </div>
                  </div>
                  <%if $configuration['enable_email_notification'] eq 'Yes'%>
                  <div class="col-lg-1 print-btn">
                     <div class="form-group">
                        <button type="submit" name="action" value="email" onclick="this.form.target='_blank';return true;" class="btn btn-info btn"> Send Email </button>
                     </div>
                  </div>
                  <%/if%>
                  <div class="col-lg-1 print-btn">
                     <div class="form-group">
                        <button type="submit" name="action" value="download" class="btn btn-info btn"> Download </button>
                     </div>
                  </div>
               </div>
            </form>
            <%/if%>
               </div>
            </div>
            </div>
            <%/if%>
          
            <div class="card mt-3">
               <div class="card-header">

               <%if $new_sales[0]->status == "pending" || $new_sales[0]->status == "unlocked"%>
                     <form action="<%$base_url%>add_sales_parts" method="post" id="salesForm">
                        <div class="row">
                           <div class="col-lg-4">
                              <div class="form-group">
                                 <label for="">Select PO no/ PO start date/ PO end date/ PO amendment no<span class="text-danger">*</span> </label>
                                 <select name="po_id" id="customer_tracking"  class="form-control select2">
                                    <%if $po_parts%>
                                    <%foreach from=$customer_tracking item=c%>
                                    <%if $po_parts[0]->po_number == $c->po_number%>
                                    <option value="<%$c->id%>"><%$c->po_number%> // <%$c->po_start_date%> // <%$c->po_end_date%> //<%$c->po_amendment_number%></option>
                                    <%/if%>
                                    <%/foreach%>
                                    <%else%>
                                    <%foreach from=$customer_tracking item=c%>
                                    <option <%if $po_parts && $po_parts[0]->po_id == $c->id%>selected<%/if%> value="<%$c->id%>"><%$c->po_number%> // <%$c->po_start_date%> // <%$c->po_end_date%> // <%$c->po_amendment_number%></option>
                                    <%/foreach%>
                                    <%/if%>
                                 </select>
                              </div>
                           </div>
                           <div class="col-lg-4">
                              <div class="form-group">
                                 <label for="">Select Part NO // Description // SO QTY // FG Stock // Rate // Packing QTY <span class="text-danger">*</span> </label>
                                 <input type="hidden" readonly id="customer_tracking_id" name="customer_tracking_id" class="form-control">
                                 <select name="part_id" id="part_id"  class="form-control select2">
                                    <option value=''>Please select</option>
                                 </select>
                              </div>
                           </div>
                           <div class="col-lg-2">
                              <div class="form-group">
                                 <label for="">Enter Qty<span class="text-danger">*</span> </label>
                                 <input type="text" step="any" name="qty" placeholder="Enter QTY"  class="form-control onlyNumericInput">
                                 <input type="hidden" name="sales_number" value="<%$new_sales[0]->sales_number%>" placeholder="Enter QTY " required class="form-control">
                                 <input type="hidden" name="sales_id" value="<%$new_sales[0]->id%>" placeholder="Enter QTY " required class="form-control">
                                 <input type="hidden" name="customer_id" value="<%$customer[0]->id%>" placeholder="Enter QTY " required class="form-control">
                                 <input type="hidden" name="discountType" value="<%$new_sales[0]->discountType %>" />
                           <input type="hidden" name="discount" value="<%$new_sales[0]->discount %>" />
                              </div>
                           </div>
                           <div class="col-lg-2">
                              <div class="form-group mt-2">
                                 <%if $new_sales[0]->status == "pending" || $new_sales[0]->status == "unlocked"%>
                                 <button type="submit" class="btn btn-info btn mt-3">Add</button>
                                 <%/if%>
                              </div>
                           </div>
                        </div>
                     </form>
                <%/if%>
                 <div class="row pdf-btn-block">
                 
                <%if ((empty($new_sales[0]->Status)) && empty($e_invoice_status)) %>
                        <%if ( $new_sales[0]->status == "lock")  %>
                                    <div class="col-lg-1 extra-copy">
                                          <button type="button" class="btn btn-danger " data-bs-toggle="modal" data-bs-target="#unlock">Unlock</button>
                                    </div>
                        <%else if ( $new_sales[0]->status == "unlocked") %>
                                    <div class="col-lg-2  packaging-sticker">
                                          <button type="button" title="Remove Sales Details for Reuse" class="btn btn-danger mt-4" data-bs-toggle="modal" data-bs-target="#reuseInvoice">Reuse Sales Invoice</button>
                                      
                                    </div>
                        <%/if%>
                <%/if%>
                <%if $new_sales[0]->status == "lock"%>
                    <%if $session_type == 'admin' || $session_type == 'Admin'%>
                    <div class="col-lg-2 packaging-sticker">
                    <button type="button" disabled class="btn btn-success ml-1" data-bs-toggle="modal">
                    Invoice already released
                    </button>
                  </div>
                    <%/if%>
                  <%else%>
                    <%if ($new_sales[0]->status != "pending" && $new_sales[0]->status != "Cancelled") && $new_sales[0]->status != "unlocked"%>
                    <button type="button" disabled class="btn btn-success ml-1 col-lg-2 " data-bs-toggle="modal">
                    Invoice already released
                    </button>
                    <%elseif $new_sales[0]->status == "Cancelled"%>
                    <button type="button" disabled class="btn btn-success ml-1 col-lg-2 " data-bs-toggle="modal">
                    Invoice already Cancelled
                    </button>
                    <div class="col-lg-1 view-original" >
                        <div class="form-group ">
                            <a class="btn btn-success" href="<%$base_url%>view_original_sales_invoice/<%$uri_segment_2%>" target="_blank">View Original</a>
                        </div>
                    </div>
                    <%/if%>
                  <%/if%>
                  
                  <!-- Modal -->
                  <div class="modal fade" id="accpet" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                     <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                           <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Update</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                              </button>
                           </div>
                           <div class="modal-body">
                              <div class="row">
                                 <form action="<%$base_url%>accept_po" method="POST">
                                    <div class="col-lg-12">
                                       <div class="form-group">
                                          <label for=""><b>Are you sure want to release this invoice?</b> </label>
                                          <input type="hidden" name="id" value="<%$new_sales[0]->id%>" required class="form-control">
                                          <input type="hidden" name="status" value="accpet" required class="form-control">
                                       </div>
                                    </div>
                              </div>
                           </div>
                           <div class="modal-footer">
                           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                           <button type="submit" class="btn btn-primary">Update</button>
                           </div>
                        </div>
                        </form>
                     </div>
                  </div>
                  <!-- Lock Model -->
                  <div class="modal fade" id="lock" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                     <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                           <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Update</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                              </button>
                           </div>
                           <div class="modal-body">
                              <div class="row">
                                 <form action="<%$base_url%>lock_invoice" method="POST" id="lock_invoice" class="lock_invoice">
                                    <div class="col-lg-12">
                                       <div class="form-group">
                                          <label for=""><b>Are you sure you want to Lock this invoice?</b> </label>
                                          <input type="hidden" name="new_po_id" id="new_po_id" value="" required class="form-control">
                                          <input type="hidden" name="id" value="<%$new_sales[0]->id%>" required class="form-control">
                                          <input type="hidden" name="status" value="lock" required class="form-control">
                                          <input type="hidden" name="discount_amount" id="discountValueInput" value="<%$discount_amount %>" />
                                             <input type="hidden" name="sales_amount" id="sales_amount" value="<%$final_po_amount %>" />
                                             <input type="hidden" name="sales_gst_amount" id="sales_gst_amount" value="<%$sales_gst_amount %>" />
                                       </div>
                                    </div>
                              </div>
                           </div>
                           <div class="modal-footer">
                           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                           <button type="submit" class="btn btn-primary">Update</button>
                           </div>
                        </div>
                        </form>
                     </div>
                  </div>
                  <!-- Lock Model -->
                     <div class="modal fade" id="unlock" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title" id="exampleModalLabel">Unlock</h5>
                                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                 </button>
                              </div>
                              <div class="modal-body">
                                 <div class="row">
                                    <form action="<%base_url('invoice_unlock') %>" method="POST" id="invoice_unlock" class="invoice_unlock">
                                       <div class="col-lg-12">
                                          <div class="form-group">
                                             <label for=""><b>Are you sure want to unlock this invoice?</b> </label>
                                             <input type="hidden" name="sales_id" value="<%$new_sales[0]->id %>" required class="form-control"/>
                                             <input type="hidden" name="sales_number" value="<%$new_sales[0]->sales_number%>" required class="form-control">
                                             <input type="hidden" name="status" value="unlocked" required class="form-control"/>
                                          </div>
                                       </div>
                                 </div>
                              </div>
                              <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                              <button type="submit" class="btn btn-primary">Unlock</button>
                              </div>
                           </div>
                           </form>
                        </div>
                     </div>
                     <!-- Reuse Model -->
                     <div class="modal fade" id="reuseInvoice" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title" id="exampleModalLabel">Remove Sales Details</h5>
                                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">                                 </button>
                              </div>
                              <div class="modal-body">
                                 <div class="row">
                                    <form action="<%base_url('reuse_invoice')%>" method="POST" class="reuse_invoice" id="reuse_invoice">
                                       <div class="col-lg-12">
                                          <div class="form-group">
                                             <label for=""><b>Are you sure to remove all the sales details and reuse this invoice ? 
                                                <br><br>NOTE: This will remove all the sales details including customer, parts, address and other details from "<%$new_sales[0]->sales_number%>".
                                             </b> </label>
                                             <input type="hidden" name="sales_id" value="<%$new_sales[0]->id %>" required class="form-control"/>
                                             <input type="hidden" name="sales_number" value="<%$new_sales[0]->sales_number%>" required class="form-control">
                                             <input type="hidden" name="status" value="reuseInvoice" required class="form-control"/>
                                          </div>
                                       </div>
                                 </div>
                              </div>
                              <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                              <button type="submit" class="btn btn-primary">Reuse Invoice</button>
                              </div>
                           </div>
                           </form>
                        </div>
                     </div>
                  <div class="modal fade" id="delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                     <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                           <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                              <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                              </button>
                           </div>
                           <div class="modal-body">
                              <div class="row">
                                 <form action="<%$base_url%>delete_po" method="POST">
                                    <div class="col-lg-12">
                                       <div class="form-group">
                                          <label for=""><b>Are you sure you want to delete this invoice?</b> </label>
                                          <input type="hidden" name="id" value="<%$new_sales[0]->id%>" required class="form-control">
                                          <input type="hidden" name="status" value="reject" required class="form-control">
                                          <input type="hidden" name="table_name" value="new_po" required class="form-control">
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
                  </div>
               </div>
            </div>
         </div>
      </div>
            <div class="card mt-3">
            
                  <div class="table-responsive text-nowrap ">
                     <table  width="100%" border="1" cellspacing="0" cellpadding="0" class="table table-striped scrollable w-100" style="border-collapse: collapse;" border-color="#e1e1e1" id="part_data">
                        <thead>
                           <tr>
                              <!-- <th>Sr No</th> -->
                              <th>Part Number</th>
                              <th>Part Description</th>
                              <th>Tax Structure</th>
                              <th>UOM</th>
                              <th>QTY</th>
                              <th>Price</th>
                              <%if $new_sales[0]->status == "pending" || $new_sales[0]->status == "unlocked"%>
                              <th>Actions</th>
                              <%/if%>
                              <%if $new_sales[0]->discountType != "NA"%>
                              <th>Discount</th>
                              <%/if%>
                              <th>CGST</th>
                              <th>SGST</th>
                              <th>IGST</th>
                              <th>TCS</th>
                              <th>Sub Total</th>
                              <th>GST</th>
                              <th>Total Price</th>
                           </tr>
                        </thead>
                        <tbody>
                           <%if $po_parts%>
                           <%assign var="sales_gst_amount" value=0%>
                           <%assign var="discount_amount" value=0%>
                           <%assign var="discountValue" value=0%>
                           <%foreach from=$po_parts item=p key=srNo%>
                           <%assign var="subtotal" value=$p->total_rate - $p->gst_amount%>
                           <%assign var="row_total" value=$p->total_rate + $p->tcs_amount%>
                           <%assign var="final_po_amount" value=$final_po_amount + $row_total%>
                           <%assign var="sales_gst_amount" value=$sales_gst_amount + $p->gst_amount%>
                           <%assign var="discountValue" value=$discountValue + $p->discounted_amount%>
                           <%assign var="discount_amount" value=$discount_amount + $p->discounted_amount%>
                           <%assign var="rate" value=$subtotal / $p->qty%>
                           <%if $p->part_price > 0%>
                           <%assign var="rate" value=$p->part_price%>
                           <%/if%>
                           <tr>
                              <!-- <td><%$srNo + 1%></td> -->
                              <td><%$child_part_data[$p->part_id][0]->part_number%></td>
                              <td><%$child_part_data[$p->part_id][0]->part_description%></td>
                              <td><%$gst_structure2[$p->part_id][0]->code%></td>
                              <td><%$p->uom_id%></td>
                              <td><%$p->qty%></td>
                              <td><%number_format($rate, 2)%></td>
                              <%if $new_sales[0]->status == "pending" || $new_sales[0]->status == "unlocked"%>
                              <td>
                                 <button type="button" class="btn btn-danger ml-1" data-bs-toggle="modal" data-bs-target="#exampleModaldelete<%$srNo%>">
                                 Delete
                                 </button>
                                 <!-- Modal -->
                                 <div class="modal fade" id="exampleModaldelete<%$srNo%>" tabindex="-1" aria-labelledby="" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                       <div class="modal-content">
                                          <div class="modal-header">
                                             <h5 class="modal-title" id="exampleModalLabel">Update</h5>
                                             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                             <span aria-hidden="true">&times;</span>
                                             </button>
                                          </div>
                                          <div class="modal-body">
                                             <form action="<%$base_url%>delete" method="POST" class="delete_form">
                                                <div class="row">
                                                   <div class="col-lg-12">
                                                      <div class="form-group">
                                                         <label for=""><b>Are You Sure Want To Delete This?</b> </label>
                                                         <input type="hidden" name="id" value="<%$p->id%>" required class="form-control">
                                                         <input type="hidden" name="table_name" value="sales_parts" required class="form-control">
                                                      </div>
                                                   </div>
                                                </div>
                                          </div>
                                          <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                          <button type="submit" class="btn btn-primary">Update</button>
                                          </div>
                                       </div>
                                    </div>
                                    </form>
                                 </div>
                              </td>
                              <%/if%>
                              <%if $new_sales[0]->discountType != "NA"%>
                              <td><%number_format($new_sales[0]->discount,2) %> 
                                       <%if ($new_sales[0]->discountType === 'Percentage')%> % <%/if%> 
                                 </td>
                              <%/if%>
                              <td><%number_format($p->cgst_amount, 2)%></td>
                              <td><%number_format($p->sgst_amount, 2)%></td>
                              <td><%number_format($p->igst_amount, 2)%></td>
                              <td><%number_format($p->tcs_amount, 2)%></td>
                              <td><%number_format($subtotal, 2)%></td>
                              <td><%$p->gst_amount%></td>
                              <td><%number_format($row_total, 2)%></td>
                           </tr>
                           <%/foreach%>
                           <%/if%>
                        </tbody>
                        <tfoot>
                          <%if ($new_sales[0]->discountType != 'NA') %>
                           <%assign var="noOfColumns" value=13%>
                           <%if $new_sales[0]->status == "pending" || $new_sales[0]->status == "unlocked"%>
                           <%assign var="noOfColumns" value=14%>
                           <%/if%>
                          <%else%>
                            <%assign var="noOfColumns" value=12%>
                             <%if $new_sales[0]->status == "pending" || $new_sales[0]->status == "unlocked"%>
                             <%assign var="noOfColumns" value=13%>
                             <%/if%>
                          <%/if%>
                           <%if $po_parts%>
                           <tr >
                              <th colspan='<%$noOfColumns%>' style="width: 100%;" class="text-right ">Total
                              <%if ($new_sales[0]->discountType != 'NA') %>
                                  After Discount of 
                                  <%if ($new_sales[0]->discountType === 'Amount') %> 
                                    In Rs.<%$new_sales[0]->discount%> <%else%><%$new_sales[0]->discount %>%<%/if%></th>
                                    <%/if%>
                              </th>
                              <th style="width: 7.5%;"><%number_format($final_po_amount, 2)%></th>
                           </tr>
                           <%/if%>
                        </tfoot>
                     </table>
                  </div>
                  <!-- /.card-body -->
              
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
  .form-check-input{
    border: 1px solid #e1d5d5 !important;
    border-radius: 50%;
    border: 0px solid #d9dee3;
  }
</style>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script>
   $(document).ready(function() {
       var id = $("#customer_tracking").val();
       $('#new_po_id').val(id);
       var salesno = $('#sales_number').val();
       $.ajax({
           url: '<%$base_url%>Newcontroller/get_po_sales_parts',
           type: "POST",
           data: {
               id: id,
               salesno: salesno
           },
           cache: false,
           beforeSend: function() {
               // Show the loading icon
               $("#loading-overlay").show();
           },
           success: function(response) {
               if (response) {
                   $('#part_id').html(response);
               } else {
                   $('#part_id').html(response);
               }
           },
           complete: function() {
               // Hide the loading overlay
               $("#loading-overlay").hide();
           }
       });
   
       $("#customer_tracking").change(function() {
           var id = $("#customer_tracking").val();
           var salesno = $('#sales_number').val();
           $.ajax({
               url: '<%$base_url%>Newcontroller/get_po_sales_parts',
               type: "POST",
               data: {
                   id: id,
                   salesno: salesno
               },
               cache: false,
               beforeSend: function() {
                   // Show the loading icon
                   $("#loading-overlay").show();
               },
               success: function(response) {
                   if (response) {
                       $('#part_id').html(response).trigger("change");
                   } else {
                       $('#part_id').html(response).trigger("change");
                   }
               },
               complete: function() {
                   // Hide the loading overlay
                   $("#loading-overlay").hide();
               }
           });
       });
   
       $("#printSticker").click(function() {
           var salesId = $('#sales_primary_id').val();
           var invoice_no = $('#invoice_no').val();
           var invoice_date = $('#invoice_date').val();
           $.ajax({
               url: '<%$base_url%>SalesController/getSalesPartPackaging_details',
               type: "POST",
               data: {
                   salesId: salesId,
                   invoice_no: invoice_no,
                   invoice_date: invoice_date
               },
               cache: false,
               beforeSend: function() {},
               success: function(response) {
                let res = JSON.parse(response);
                   if (res.html) {
                       $('#observationTableData').html(res.html);
                   } else {
                      $('#observationTableData').html(res.html);
                   }
               }
           });
       });
   
       $("#salesForm").validate({
           ignore: [],
           rules: {
               po_id: {
                   required: true
               },
               part_id: {
                   required: true
               },
               qty: {
                   required: true,
                   number: true
               }
           },
           messages: {
               po_id: {
                   required: "Please select a PO."
               },
               part_id: {
                   required: "Please select a part."
               },
               qty: {
                   required: "Please enter quantity.",
                   number: "Please enter a valid quantity."
               }
           },
           errorPlacement: function(error, element) {
               error.addClass('error');
               element.closest('.form-group').append(error);
           },
           onkeyup: function(element) {
               $(element).valid();
           },
           onchange: function(element) {
               $(element).valid();
           },
           submitHandler: function(form) {
               event.preventDefault(); // Prevent default form submission
   
               $.ajax({
                   url: form.action,
                   type: form.method,
                   data: $(form).serialize(),
                   success: function(response) {
                       // Handle the successful response here
                      if(response != '' && response != null && typeof response != 'undefined'){
                           let res = JSON.parse(response);
                           console.log(res);
                           if(res['sucess'] == 1){
                               toastr.success(res['msg']);
                               setTimeout(() => {
                                   window.location.reload();
                               }, 1000);
                           }else{
                               toastr.error(res['msg']);
                           }
                      }
                   },
                   error: function(xhr, status, error) {
                       // Handle the error response here
                       alert("An error occurred: " + xhr.responseText);
                   }
               });
           }
       });
        $("#generate_EwayBill").validate({
           ignore: [],
           rules: {
               transMode: {
                   required: true
               },
               transporterId: {
                   required: true
               },
               vehicleNo: {
                   required: true,
                   // pattern: /^[A-Za-z0-9]{4,20}$/,
               },
               distance:{
                  required: true,
               }
           },
           messages: {
               transMode: {
                   required: "Please enter mode of transporter."
               },
               transporterId: {
                   required: "Please enter Transporter."
               },
               vehicleNo: {
                   required: "Please enter vehicle no.",
                   pattern: "Please enter a valid vehicle number in the format XX00XX0000"
               },
               distance:{
                  required: "Please enter distance of transportation",
               }
           },
           errorPlacement: function(error, element) {
               error.addClass('error');
               element.closest('.form-group').append(error);
           },
           submitHandler: function(form) {
               event.preventDefault(); // Prevent default form submission
                
               $.ajax({
                   url: form.action,
                   type: form.method,
                   data: $(form).serialize(),
                   success: function(response) {
                       // Handle the successful response here
                      if(response != '' && response != null && typeof response != 'undefined'){
                           let res = JSON.parse(response);
                           if(res['success'] == 1){
                               toastr.success(res['messages']);
                               setTimeout(() => {
                                   window.location.reload();
                               }, 1000);
                           }else{
                               toastr.error(res['messages']);
                           }
                      }
                   },
                   error: function(xhr, status, error) {
                       // Handle the error response here
                       alert("An error occurred: " + xhr.responseText);
                   }
               });
           }
       });
   
       // Manually trigger validation on select2 elements change
       $('.select2').on('change', function() {
           $(this).valid();
       });
   
       $('.delete_form').on('submit', function(event) {
       event.preventDefault(); // Prevent the form from submitting via the browser
       var form = $(this);
       var formData = form.serialize();
   
       $.ajax({
           type: 'POST',
           url: form.attr('action'),
           data: formData,
           success: function(response) {
               // Handle success
               toastr.success('part deleted sucessfully.')
               // Optionally, you can close the modal or refresh the page or element
               setTimeout(() => {
                   window.location.reload();
               }, 1000);
           },
           error: function(xhr, status, error) {
               // Handle error
               toastr.success('unable to delete part.')
           }
       });
   });
       $(".lock_invoice,.delete_sale_invoice,.invoice_unlock,.reuse_invoice").submit(function(e){
        e.preventDefault();
       
        var href = $(this).attr("action");
        var id = $(this).attr("id");
        var formData = new FormData($('.'+id)[0]);
        $.ajax({
          type: "POST",
          url: href,
          data: formData,
          processData: false,
          contentType: false,
          success: function (response) {
            var responseObject = JSON.parse(response);
            var msg = responseObject.messages;
            var success = responseObject.success;
            if (success == 1) {
              toastr.success(msg);
              $(this).parents(".modal").modal("hide")
              setTimeout(function(){
                if(responseObject.redirect_url != undefined){
                  window.location.href = responseObject.redirect_url;
                }else{
                  window.location.reload();
                }
              },1000);

            } else {
              toastr.error(msg);
            }
          },
          error: function (error) {
            console.error("Error:", error);
          },
        });
      });


   
   });
function toggleDiscountSelection() {
         var isDiscountChecked = document.querySelector('input[name="isDiscount"]:checked').value;
         //var defaultDiscount = $('#discountId').val();
         // Show/Hide discount type and value based on the selection
         if (isDiscountChecked === "Yes") {
            document.getElementById('discountTypeSection').style.display = 'block';
            document.getElementById('discountValueSection').style.display = 'block';
         } else {
            document.getElementById('discountTypeSection').style.display = 'none';
            document.getElementById('discountValueSection').style.display = 'none';
         }
      }

      // Initial check to show or hide on page load (if Yes/No is pre-selected)
      document.addEventListener('DOMContentLoaded', function() {
         toggleDiscountSelection();
      });
      // assign calcualted or provided discount value
     document.getElementById('discountValueInput').value = "<%$discountValue%>";
     document.getElementById('discountValueInput1').value = "<%$discountValue %>";
     document.getElementById('final_basic_total').value = "<%$final_basic_total%>";
     document.getElementById('sales_amount').value = "<%$final_po_amount%>";
     document.getElementById('sales_gst_amount').value = "<%$sales_gst_amount%>";
</script>