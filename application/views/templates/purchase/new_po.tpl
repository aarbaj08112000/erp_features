<!-- Content wrapper -->
<%assign var="entitlements" value=$session_data['entitlements']%>
<div class="content-wrapper">
   <!-- Content -->
   <div class="container-xxl flex-grow-1 container-p-y">
      <nav aria-label="breadcrumb">
         <div class="sub-header-left pull-left breadcrumb">
            <h1>
               Purchase
               <a hijacked="yes" href="#stock/issue_request/index" class="backlisting-link" title="Back to Issue Request Listing" >
               <i class="ti ti-chevrons-right" ></i>
               <em >Regular PO</em></a>
            </h1>
            <br>
            <span >Generate PO</span>
         </div>
      </nav>
      <!-- Responsive Table -->
      <div class="card p-0 mt-4">
         <div class="card-header">
            <form  id="generateNewPo" class="mb-3" action="javascript:void(0)" method="POST" enctype='multipart/form-data'>
               <div class="row">
                  <div class="col-lg-4">
                     <div class="form-group mb-3">
                        <label for="" class="form-label">Supplier / Number / GST <span class="text-danger">*</span> </label>
                        <select name="supplier_id"  class="form-control select2-init">
                           <%if count($supplier) gt 0 %>
                           <%foreach from=$supplier item=s %>
                           <option value="<%$s->id %>">
                              <%$s->supplier_name %> / <%$s->gst_number %> / <%$s->supplier_number %>
                           </option>
                           <%/foreach%>
                           <%/if%>
                        </select>
                     </div>
                  </div>
                  <div class="col-lg-4">
                     <div class="form-group mb-3">
                        <label for="" class="form-label">Billing Address <span class="text-danger">*</span> </label>
                        <select name="billing_address"   class="form-control select2-init">
                           <option value="">Select Billing Address</option>
                           <%foreach from=$client item=cli %>
                           <option value="<%$cli->billing_address %>">
                              <%$cli->client_unit %>/ <%$cli->billing_address %>
                           </option>
                           <%/foreach%>
                        </select>
                     </div>
                  </div>
                  <div class="col-lg-4">
                     <div class="form-group mb-3">
                        <label for="" class="form-label">Shipping Address <span class="text-danger">*</span></label>
                        <select name="shipping_address"  class="form-control select2-init">
                           <option value="">Select Shipping Address</option>
                           <%foreach from=$client item=cli %>
                           <option value="<%$cli->shifting_address %>">
                              <%$cli->client_unit %>/<%$cli->shifting_address %>
                           </option>
                           <%/foreach%>
                           <%if count($supplier) gt 0 %>
                           <%foreach from=$supplier item=s %>
                           <option value="<%$s->location %>">
                              <%$s->supplier_name %>/<%$s->location %>
                           </option>
                           <%/foreach%>
                           <%/if%>
                        </select>
                     </div>
                  </div>   
                 
               
                  <div class="col-lg-4">
                     <div class="form-group mb-3">
                        <label for="" class="form-label">Loading Unloading Amount <span class="text-danger">*</span> </label>
                        <input type="text"  step="any" placeholder="Enter Loading Unloading" value="" name="loading_unloading" class="form-control onlyNumericInput">
                     </div>
                  </div>
                  <div class="col-lg-4">
                     <div class="form-group mb-3">
                        <label for="" class="form-label">Loading Unloading Tax Strucutre <span class="text-danger">*</span> </label>
                        <select name="loading_unloading_gst"   class="form-control select2-init">
                           <option value="0">NA</option>
                           <%if count($gst_structure) gt 0 %>
                           <%foreach from=$gst_structure item=s %>
                           <option value="<%$s->id %>"><%$s->code %>
                           </option>
                           <%/foreach%>
                           <%/if%>
                        </select>
                     </div>
                  </div>
                  <div class="col-lg-4">
                     <div class="form-group mb-3">
                        <label for="" class="form-label">Freight Amount <span class="text-danger">*</span> </label>
                        <input type="text" step="any"  placeholder="Enter Loading Unloading" value="" name="freight_amount" class="form-control onlyNumericInput">
                     </div>
                  </div>
                  <div class="col-lg-4">
                     <div class="form-group mb-3">
                        <label for="" class="form-label">Freight Tax Strucutre <span class="text-danger">*</span> </label>
                        <select name="freight_amount_gst"   class="form-control select2-init">
                           <option value="0">NA</option>
                           <%if count($gst_structure) gt 0 %>
                           <%foreach from=$gst_structure item=s %>                                                            
                           <option value="<%$s->id %>"><%$s->code %></option>
                           <%/foreach%>
                           <%/if%>
                        </select>
                     </div>
                  </div>
                  
                  <div class="col-lg-4">
                     <div class="form-group mb-3">
                        <label for="" class="form-label">Discount Type<span class="text-danger">*</span> </label>
                        <select name="discount_type" required id="" class="form-control select2">
                           <option value="N/A">N/A</option>
                           <option value="PO Level">PO Level</option>
                           <option value="Part Level">Part Level</option>
                        </select>
                     </div>
                  </div>
                   <div class="col-lg-4 hide">
                     <div class="form-group mb-3">
                        <label for="" class="form-label">PO Date</label>
                        <input type="date" readonly value="<%date('Y-m-d') %>"  name="po_date" class="form-control">
                     </div>
                  </div>
                  <div class="col-lg-4">
                     <div class="form-group mb-3">
                        <label for="" class="form-label">Expiry Date <span class="text-danger">*</span> </label>
                        <input type="date" min="<%date('Y-m-d', strtotime('+ 1 day')) %>"  name="expiry_po_date" class="form-control">
                     </div>
                  </div>
                  <div class="col-lg-4 hide">
                     <div class="form-group mb-3">
                        <label for="" class="form-label">Remark </label>
                        <input type="text" placeholder="Enter Remark" value="" name="remark" class="form-control">
                     </div>
                  </div>
                  <div class="col-lg-12">
                     <div class="form-group mb-3">
                        <label class="form-label" for="">Notes </label>
                        <textarea cols="50" rows="8" name="notes" class="form-control">1.PDIR & MTC Required with each lot. Pls mention PO No. on Invoice.<br>
2.Rejection if any will be debited to suppliers account<br>
3. Inspection & Testing Requirements as per Customer drawing/ standard/ quality plan will be done at your end and reports will share to us.<br>
<b>GST Extra.</b><br>
<b> Delivery :</b>   Door Delivery. <br>
<b> Validity :</b>  30 Days from date of purchase order
                        </textarea>
                     </div>
                  </div>
                  <div class="form-group">
                     <button type="submit" class="btn btn-danger mt-4">Generate PO</button>
                  </div>
               </div>
            </form>
         </div>
      </div>
      <!--/ Responsive Table -->
   </div>
</div>
<!-- Content wrapper -->
<style type="text/css">
   .table th {
   text-transform: none ; 
   font-size: .75rem;
   letter-spacing: 1px;
   }
</style>
<script>
   var base_url = <%$base_url|json_encode%>;
</script>
<script src="<%$base_url%>public/js/purchase/new_po_generate.js"></script>