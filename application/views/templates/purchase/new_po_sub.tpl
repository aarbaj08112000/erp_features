<div class="content-wrapper">
   <!-- Content -->
   <div class="container-xxl flex-grow-1 container-p-y">
      <nav aria-label="breadcrumb">
         <div class="sub-header-left pull-left breadcrumb">
            <h1>
               Purchase
               <a hijacked="yes" href="#stock/issue_request/index" class="backlisting-link" title="Back to Issue Request Listing" >
               <i class="ti ti-chevrons-right" ></i>
               <em >Subcon</em></a>
            </h1>
            <br>
            <span >Generate Subcon PO</span>
         </div>
      </nav>
      <div class="card p-0 mt-4">
         <div class="card-header">
         <form  id="generateNewPo" class="mb-3" action="javascript:void(0)" method="POST" enctype='multipart/form-data'>
            <div class="row">
            <div class="col-lg-4">
                <div class="form-group mb-3">
                        <label for=""  class="form-label">Supplier / Number / GST <span class="text-danger">*</span> </label>
                        <select name="supplier_id" required id="" class="form-control select2">
                            <%if count($supplier) gt 0 %>
                                <%foreach from=$supplier item=s %>
                                    <option value="<%$s->id %>"><%$s->supplier_name %> / <%$s->gst_number %> / <%$s->supplier_number %></option>
                                <%/foreach%>
                            <%/if%>
                        </select>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group mb-3">
                    <label for=""  class="form-label">PO Date <span class="text-danger">*</span> </label>
                    <input type="date" readonly value="<%date('Y-m-d') %>" required name="po_date" class="form-control">
                    <input type="hidden" readonly value="1" required name="process_id" class="form-control">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group mb-3">
                    <label for=""  class="form-label">Expiry Date </label>
                    <input type="date" min="<%date('Y-m-d', strtotime('+ 1 day')) %>" required name="expiry_po_date" class="form-control">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group mb-3">
                    <label for=""  class="form-label">Remark </label>
                    <input type="text" placeholder="Enter Remark" value="" name="remark" class="form-control">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group mb-3">
                    <label for=""  class="form-label">Billing Address <span class="text-danger">*</span> </label>
                    <select name="billing_address" required id="" class="form-control select2">
                    <option value="">Select</option>
                        <%foreach from=$client item=cli %>
                            <option value="<%$cli->billing_address %>">
                                <%$cli->client_unit %> / <%$cli->billing_address %></option>
                        <%/foreach%>
                    </select>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group mb-3">
                    <label for=""  class="form-label">Shipping Address <span class="text-danger">*</span></label>
                    <select name="shipping_address" required class="form-control select2">
                    <option value="">Select</option>
                        <%foreach from=$client item=cli %>
                            <option value="<%$cli->shifting_address %>">
                                <%$cli->client_unit %> / <%$cli->shifting_address %>
                            </option>
                        <%/foreach%>
                            <%if count($supplier) > 0 %>
                                <%foreach from=$supplier item=s %>
                                <option value="<%$s->location %>">
                                    <%$s->supplier_name%> / <%$s->location %>
                                </option>
                                <%/foreach%>
                            <%/if%>
                    </select>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <button type="submit" class="btn btn-danger mt-4">Generate PO</button>
                </div>
            </div>
         </form>
     </div>
         </div>
      </div>

   </div>
</div>
<script>
   var base_url = <%$base_url|json_encode%>;
</script>
<script src="<%$base_url%>public/js/purchase/new_po_sub_generate.js"></script>
<!-- /.content-wrapper -->