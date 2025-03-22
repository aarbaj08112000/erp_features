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
      <span ><%if $mode eq 'Update'%>Updae<%else%>Add<%/if%> Supplier Part Price</span>
   </div>
</nav>
<div class="dt-top-btn d-grid gap-2 d-md-flex  mb-5 listing-btn">
   <a class="btn btn-seconday" type="button" href="<%base_url('child_part_supplier_view')%>"><i class="ti ti-arrow-left" title="Back To Supplier Part List"></i></a>
</div>
<!-- <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms/</span> Vertical Layouts</h4> -->
<!-- Basic Layout -->
<div class="row">
   <div class="col-xl">
      <div class="card mb-4 px-3">
         <div class="card-body">
            <form id="addchildpart" class="mb-3" action="javascript:void(0)" method="POST" enctype='multipart/form-data'>
              <input type="hidden" name="supplier_child_part_id" value="<%$child_part_data['id']%>">
              <input type="hidden" name="mode" value="<%$mode%>">
               <div class="row">
                 <div class="col-lg-6 ">
                  <div class="form-group mb-3">
                     <label class="form-label"> Supplier </label><span class="text-danger">*</span>
                     <select  class="form-control select2" name="supplier_id" style="width: 100%;" <%if $mode eq 'Update'%> disabled<%/if%>>
                        <option value="">Select Supplier</option>
                        <%foreach from=$supplier_list item=$c%>
                        <option value="<%$c->id %>" <%if $child_part_data['supplier_id'] eq $c->id%>selected<%/if%>><%$c->supplier_name %></option>
                        <%/foreach%>
                     </select>
                  </div>
                 </div>
                 <div class="col-lg-6 ">
                  <div class="form-group mb-3">
                     <label class="form-label"> Item Part </label><span class="text-danger">*</span>
                     <select  class="form-control select2" name="child_part_id" style="width: 100%;" <%if $mode eq 'Update'%> disabled<%/if%>>
                        <option value="">Select</option>
                        <%if ($child_part_list) %>
                        <%foreach from=$child_part_list item=$c%>
                        <option value="<%$c->id %>" <%if $child_part_data['child_part_id'] eq $c->id%>selected<%/if%>><%$c->part_number %>/<%$c->part_description %>/<%$c->uom_name %></option>
                        <%/foreach%>
                        <%/if%>
                     </select>
                  </div>
                 </div>
                 <div class="col-lg-6 ">
                  <div class="form-group mb-3">
                     <label class="form-label">Tax Structure </label><span class="text-danger">*</span>
                     <select  class="form-control select2" name="gst_id" style="width: 100%;">
                        <option value="">Select</option>
                        <%foreach from=$gst_structure item=$c%>
                        <option value="<%$c->id %>" <%if $child_part_data['gst_id'] eq $c->id%>selected<%/if%>><%$c->code %></option>
                        <%/foreach%>
                     </select>
                  </div>
                 </div>
                 <div class="col-lg-6 ">
                  <div class="form-group mb-3">
                     <label for="po_num" class="form-label">Part Price </label><span class="text-danger">*</span>
                     <input type="text"  name="upart_rate"  class="form-control onlyNumericInput" placeholder="Enter Part Price" value="<%$child_part_data['part_rate']%>">
                  </div>
                 </div>
                 <div class="col-lg-6 ">
                  <div class="form-group mb-3">
                     <label for="po_num" class="form-label">Revision Number</label><span class="text-danger">*</span>
                     <input type="text" name="revision_no" <%if $mode eq 'Update'%> readonly<%/if%> value="<%$child_part_data['revision_no']%>"  class="form-control" placeholder="Enter Revision Number" aria-describedby="emailHelp">
                  </div>
                 </div>
                 <div class="col-lg-6 ">
                  <div class="form-group mb-3">
                     <label for="po_num" class="form-label">Revision Remark</label><span class="text-danger">*</span>
                     <input type="text" name="revision_remark"   value="<%$child_part_data['revision_remark']%>"  class="form-control"  placeholder="Enter Revision Remark" aria-describedby="emailHelp">
                  </div>
                 </div>
                 <div class="col-lg-6 ">
                  <div class="form-group mb-3">
                     <label for="po_num" class="form-label">Revision Date</label><span class="text-danger">*</span>
                     <input type="date" name="revision_date"  value="<%$child_part_data['revision_date']%>" class="form-control" <%if $mode eq 'Update'%> readonly<%/if%> placeholder="Enter Revision Date" aria-describedby="emailHelp">
                  </div>
                 </div>
                 <div class="col-lg-6 ">
                  <div class="form-group mb-3">
                     <label for="po_num" class="form-label">Quotation Document</label>
                     <input type="file" name="quotation_document" class="form-control" placeholder="Enter Revision Date" aria-describedby="emailHelp">
                  </div>
                 </div>
                </div>
                  <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- / Content -->
<div class="content-backdrop fade"></div>
<style type="text/css">
   .select2-container--default .select2-selection.select2-selection--single {
   height: 37px !important;
   border: var(--bs-border-width) solid #d9dee3;
   }
</style>
<script type="text/javascript">
   var base_url = <%$base_url|@json_encode%>
</script>
<script src="<%$base_url%>public/js/purchase/add_child_part_supplier.js"></script>
<!-- Content wrapper -->