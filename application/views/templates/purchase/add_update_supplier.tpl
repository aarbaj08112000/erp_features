<%assign var="entitlements" value=$session_data['entitlements']%>
<!-- Content wrapper -->
<div class="container-xxl flex-grow-1 container-p-y">
   <nav aria-label="breadcrumb">
      <div class="sub-header-left pull-left breadcrumb">
         <h1>
            Purchase
            <a hijacked="yes" href="#stock/issue_request/index" class="backlisting-link" title="Back to Issue Request Listing" >
            <i class="ti ti-chevrons-right" ></i>
            <em >Supplier</em></a>
         </h1>
         <br>
         <span >Add Supplier</span>
      </div>
   </nav>
   <div class="dt-top-btn d-grid gap-2 d-md-flex  mb-5 listing-btn">
      <a class="btn btn-seconday" type="button" href="<%base_url('approved_supplier')%>" title="Back To Supplier List"><i class="ti ti-arrow-left" ></i></a>
   </div>
   <!-- <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms/</span> Vertical Layouts</h4> -->
   <div class="row">
      <div class="col-xl-12">
      </div>
   </div>
   <!-- Basic Layout -->
   <div class="row">
      <div class="col-xl">
         <div class="card mb-4 px-3">
            <div class="card-body">
               <form id="addsupplier" class="mb-3" action="javascript:void(0)" method="POST" enctype='multipart/form-data'>
                  <input type="hidden" value="<%$mode%>" name="mode">
                  <input type="hidden" value="<%$id%>" name="supplier_id">
                  <div class="row">
                     <div class="col-lg-6 ">
                        <div class="form-group mb-3">
                           <label for="machine_name" class="form-label">Supplier Name</label><span
                              class="text-danger">*</span>
                           <input type="text" name="supplierName" value="<%$supplier_name%>" 
                              class="form-control" 
                              placeholder="Enter Supplier Name">
                        </div>
                     </div>
                     <div class="col-lg-6 ">
                        <div class="form-group mb-3">
                           <label for="machine_name" class="form-label">Supplier Email</label>
                           <input type="text" name="supplierEmail" value="<%$email%>"
                              class="form-control" 
                              placeholder="Enter Supplier Email">
                        </div>
                     </div>
                     <%if $mode eq 'Update'%>
                     <div class="col-lg-6 ">
                        <div class="form-group mb-3">
                           <label for="machine_name" class="form-label">Approve Supplier</label>
                            <select class="form-control select2" name="admin_approve"
                              style="width: 100%;">
                              <option value="yes" <%if $admin_approve eq 'pending'%>selected<%/if%>>Pending</option>
                              <option value="no" <%if $admin_approve eq 'accept'%>selected<%/if%>>Accept</option>
                           </select>
                        </div>
                     </div>
                     <%/if%>
                     <div class="col-lg-6 ">
                        <div class="form-group mb-3">
                           <label for="machine_name" class="form-label">Supplier Code</label><span
                              class="text-danger">*</span>
                           <input type="text" name="supplierNumber" value="<%$supplier_number%>"
                              class="form-control" <%if $mode eq 'Update'%>readonly<%/if%> 
                              placeholder="Enter Supplier Number">
                        </div>
                     </div>
                     <div class="col-lg-6 ">
                        <div class="form-group mb-3">
                           <label class="form-label">With in State </label><span
                              class="text-danger">*</span>
                           <select class="form-control select2" name="with_in_state"
                              style="width: 100%;">
                              <option value="yes" <%if $with_in_state eq 'yes'%>selected<%/if%>>Yes</option>
                              <option value="no" <%if $with_in_state eq 'no'%>selected<%/if%>>No</option>
                           </select>
                        </div>
                     </div>
                     <div class="col-lg-6 ">
                        <div class="form-group mb-3">
                           <label for="machine_name" class="form-label">Supplier Address</label><span
                              class="text-danger">*</span>
                           <input type="text" name="supplierlocation" value="<%$location%>"
                              class="form-control"
                              placeholder="Enter Supplier Location">
                        </div>
                     </div>
                     <div class="col-lg-6 ">
                        <div class="form-group mb-3">
                           <label for="customer_location" class="form-label">State</label><span
                              class="text-danger">*</span>
                           <input type="text" name="state" value="<%$state%>"
                              class="form-control"  placeholder="Enter State">
                        </div>
                     </div>
                     <div class="col-lg-6 ">
                        <div class="form-group mb-3">
                           <label for="machine_name" class="form-label">Supplier Mobile Number</label>
                           <input type="text" name="supplierMnumber" value="<%$mobile_no%>"
                              class="form-control onlyNumericInput" 
                              placeholder="Enter Supplier Mobile Number">
                        </div>
                     </div>
                     <div class="col-lg-6 ">
                        <div class="form-group mb-3">
                           <label for="customer_location" class="form-label">GST Number</label><span
                              class="text-danger">*</span>
                           <input type="text" name="gst_no" value="<%$gst_number%>"
                              class="form-control" 
                              placeholder="Enter GST Number">
                        </div>
                     </div>
                     <div class="col-lg-6 ">
                        <div class="form-group mb-3">
                           <label for="machine_name" class="form-label">Supplier Pan</label>
                           <input type="text" name="pan_card" class="form-control" value="<%$pan_card%>"
                              placeholder="Enter Supplier pan card">
                        </div>
                     </div>
                     <div class="col-lg-6 ">
                     <div class="form-group mb-3">
                        <label for="payment_terms" class="form-label">Payment Days</label>
                        <span class="text-danger">*</span>
                        <input type="text" step="any" min="0" name="paymentDays" 
                                                                class="form-control onlyNumericInput" id="exampleInputEmail1"
                                                                aria-describedby="emailHelp"
                                                                placeholder="Payment Days" value="<%$payment_days%>">
                     </div>
                     </div>
                     <div class="col-lg-6 ">
                        <div class="form-group mb-3">
                           <label for="payment_terms" class="form-label">Payment Terms</label><span
                              class="text-danger">*</span>
                           <input type="text" step="any"  name="paymentTerms" value="<%$payment_terms%>"
                              class="form-control onlyNumericInput" 
                              placeholder="Payment Terms">
                        </div>
                     </div>
                     <div class="col-lg-6 ">
                        <div class="form-group mb-3">
                           <label class="form-label">Discount Type </label><span class="text-danger">*</span>
                           <select class="form-control select2 discount_type" name="discount_type" style="width: 100%;" id="discount_type">
                              <option value="">Select Discount Type</option>
                              <option value="Percentage" <%if $discount_type == 'Percentage'%>selected<%/if%>>Percentage</option>
                              <option value="Number" <%if $discount_type == 'Number'%>selected<%/if%>>Number</option>
                           </select>
                        </div>
                     </div>
                     <div class="col-lg-6 ">
                        <div class="form-group">
                           <label class="form-label" >Discount</label><span class="text-danger">*</span>
                           <input type="text" step="any"  name="discount" class="form-control  onlyNumericInput" aria-describedby="emailHelp" placeholder="Payment Days" id="discount_val" value="<%$discount%>">
                        </div>
                     </div>
                     <div class="col-lg-6 ">
                        <div class="form-group mb-3">
                           <label for="machine_name" class="form-label">Upload NDA Document</label>
                           <input type="file" name="nda_document" 
                              class="form-control"
                              placeholder="Enter Upload NDA Document">
                        </div>
                     </div>
                     <div class="col-lg-6 ">
                        <div class="form-group mb-3">
                           <label for="machine_name" class="form-label">Other Document 2</label>
                           <input type="file" name="other_document_2"
                              class="form-control" 
                              placeholder="Enter Supplier Mobile Number">
                        </div>
                     </div>
                     <div class="col-lg-6 ">
                        <div class="form-group mb-3">
                           <label for="machine_name" class="form-label">Upload Registration
                           Document</label>
                           <input type="file" name="registration_document"
                              class="form-control" 
                              placeholder="Enter Supplier Mobile Number">
                        </div>
                     </div>
                     <div class="col-lg-6 ">
                        <div class="form-group mb-3">
                           <label for="machine_name" class="form-label">Other Document 3</label>
                           <input type="file" name="other_document_3"
                              class="form-control" 
                              placeholder="Enter Supplier Mobile Number">
                        </div>
                     </div>
                     <div class="col-lg-6 ">
                        <div class="form-group mb-3">
                           <label for="machine_name" class="form-label">Other Document 1</label>
                           <input type="file" name="other_document_1"
                              class="form-control" 
                              placeholder="Enter Supplier Mobile Number">
                        </div>
                     </div>
                     
                  </div>
            <button type="submit" class="btn btn-primary">Submit</button>
         </div>

         </div>
         

         </form>
         </div>
      </div>
   </div>
</div>
</div>
</div>
<!-- / Content -->
<div class="content-backdrop fade"></div>
<script type="text/javascript">
   var base_url = <%$base_url|@json_encode%>;
   var id = <%$id|@json_encode%>;
</script>
<script src="<%$base_url%>public/js/purchase/add_supplier.js"></script>
<!-- Content wrapper -->																											mode