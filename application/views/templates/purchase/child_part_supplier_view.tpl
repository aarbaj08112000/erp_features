<!-- Content wrapper -->
<%assign var="entitlements" value=$session_data['entitlements']%>
<div class="content-wrapper">
   <!-- Content -->
   <div class="container-xxl flex-grow-1 container-p-y">
      <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme filter-popup-block" style="width: 0px;">
         <div class="app-brand demo justify-content-between">
            <a href="javascript:void(0)" class="app-brand-link">
            <span class="app-brand-text demo menu-text fw-bolder ms-2">Filter</span>
            </a>
            <div class="close-filter-btn d-block filter-popup cursor-pointer">
               <i class="ti ti-x fs-8"></i>
            </div>
         </div>
         <nav class="sidebar-nav scroll-sidebar filter-block" data-simplebar="init">
            <div class="simplebar-content" >
               <ul class="menu-inner py-1">
                  <!-- Dashboard -->
                  <div class="filter-row">
                     <li class="nav-small-cap">
                        <span class="hide-menu">Part Number / Description</span>
                        <span class="search-show-hide float-right"><i class="ti ti-minus"></i></span>
                     </li>
                     <li class="sidebar-item">
                        <div class="input-group">
                           <select name="child_part_id" class="form-control select2" id="part_number_search">
                              <option value="">Part Number / Description</option>
                              <%foreach from=$child_part_list_filter item=$c%>
                              <option <%if ($filter_child_part_id == $c->child_part_id) %>selected <%/if%> value="
                                 <%$c->child_part_id %>"><%$c->part_number%> / <%$c->part_description %>
                              </option>
                              <%/foreach%>
                           </select>
                        </div>
                     </li>
                  </div>
                  <div class="filter-row">
                     <li class="nav-small-cap">
                        <span class="hide-menu">Supplier</span>
                        <span class="search-show-hide float-right"><i class="ti ti-minus"></i></span>
                     </li>
                     <li class="sidebar-item">
                        <div class="input-group">
                           
                           <select name="supplier_id" class="form-control select2" id="supplier_search">
                              <option value="">Supplier</option>
                              <%foreach from=$supplier_list item=$s%>
                              <option value="
                                 <%$s->id %>"><%$s->supplier_name%>
                              </option>
                              <%/foreach%>
                           </select>
                        </div>
                     </li>
                  </div>
               </ul>
            </div>
         </nav>
         <div class="filter-popup-btn">
            <button class="btn btn-outline-danger reset-filter">Reset</button>
            <button class="btn btn-primary search-filter">Search</button>
         </div>
      </aside>
      <nav aria-label="breadcrumb">
         <div class="sub-header-left pull-left breadcrumb">
            <h1>
               Purchase
               <a hijacked="yes" href="#stock/issue_request/index" class="backlisting-link" title="Back to Issue Request Listing" >
               <i class="ti ti-chevrons-right" ></i>
               <em >Supplier Parts</em></a>
            </h1>
            <br>
            <span >Purchase Part Price</span>
         </div>
      </nav>
      <!-- <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Basic Tables</h4> -->
      <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5 listing-btn">
         <%if checkGroupAccess("child_part_supplier_view","add","No")%>
         <a class="btn btn-seconday action-button-box" type="button"  title="Add Supplier Part Price" href="child_part_supplier">
         <span>Add Supplier Part Price</span>
         </a>
         <%/if%>
         <%if checkGroupAccess("child_part_supplier_view","export","No")%>
         <button class="btn btn-seconday" type="button" id="downloadCSVBtn" title="Download CSV"><i class="ti ti-file-type-csv"></i></button>
         <button class="btn btn-seconday" type="button" id="downloadPDFBtn" title="Download PDF"><i class="ti ti-file-type-pdf"></i></button>
         <%/if%>
         <button class="btn btn-seconday filter-icon" type="button"><i class="ti ti-filter" ></i></i></button>
         <button class="btn btn-seconday" type="button"><i class="ti ti-refresh reset-filter"></i></button>
      </div>
      <div class="w-100">
        <input type="text" name="reason" placeholder="Filter Search" class="form-control serarch-filter-input m-3 me-0" id="serarch-filter-input" fdprocessedid="bxkoib">
    </div>
      <!-- Responsive Table -->
      <div class="card p-0 mt-4 w-100">
         <div class="table-responsive text-nowrap">
            <table width="100%" border="1" cellspacing="0" cellpadding="0" class="table table-striped" style="border-collapse: collapse;" border-color="#e1e1e1" id="supplier_part_price">
               <thead>
                  <tr>
                     <%foreach from=$data key=key item=val%>
                     <th><b>Search <%$val['title']%></b></th>
                     <%/foreach%>
                  </tr>
               </thead>
               <tbody></tbody>
            </table>
         </div>
      </div>
      <!--/ Responsive Table -->
   </div>
   <!-- / Content -->
   <div class="modal fade" id="addRevision" tabindex=" -1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
         <div class="modal-content ">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Add Revision </h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <!-- updatechildpart_supplier -->
               <form id="addRevPart" class="mb-3" action="javascript:void(0)" method="POST" enctype='multipart/form-data'>
                  <input value="=" type="hidden" name="id" id="id" required class="form-control" aria-describedby="emailHelp" placeholder="Customer Name">
                  <div class="row">
                     <div class="col-lg-6">
                        <div class="form-group">
                           <label for="po_num">Part Number </label><span class="text-danger">*</span>
                           <input type="text" value="" name="upart_number" id="upart_number" readonly class="form-control" placeholder="Enter Part Number">
                        </div>
                     </div>
                     <div class="col-lg-6">
                        <div class="form-group">
                           <label for="po_num">Part Description </label><span class="text-danger">*</span>
                           <input type="text" value="" name="upart_desc" id="upart_desc" readonly required class="form-control" placeholder="Enter Part Description">
                        </div>
                     </div>
                     <div class="col-lg-6">
                        <div class="form-group">
                           <label for="po_num">Revision Date </label><span class="text-danger">*</span>
                           <input type="date" value="" name="urevision_date" id="urevision_date" required class="form-control"  placeholder="Enter Part Price">
                        </div>
                     </div>
                     <div class="col-lg-6">
                        <div class="form-group">
                           <label for="po_num">Revision Number </label><span class="text-danger">*</span>
                           <input type="text" value="" name="urevision_no" id="urevision_no" required class="form-control"  placeholder="Enter Safty/buffer stock" aria-describedby="emailHelp">
                           <input type="hidden" readonly value="" name="supplier_id" id="supplier_id" required class="form-control"  placeholder="Enter Safty/buffer stock" aria-describedby="emailHelp">
                        </div>
                     </div>
                     <div class="col-lg-6">
                        <div class="form-group">
                           <label for="po_num">Revision Remark </label><span class="text-danger">*</span>
                           <input type="text" value="" name="revision_remark" id="revision_remark" required class="form-control"  placeholder="Enter revision_remark" aria-describedby="emailHelp">
                        </div>
                     </div>
                     <div class="col-lg-6">
                        <div class="form-group">
                           <label for="po_num">Part Price </label><span class="text-danger">*</span>
                           <input type="text" value="" name="upart_rate" id="upart_rate" required class="form-control" placeholder="Enter Part Price">
                        </div>
                     </div>
                     <div class="col-lg-6">
                        <div class="form-group">
                           <label for="po_num">Quotation Document</label>
                           <input type="file" name="quotation_document" id="quotation_document" class="form-control" placeholder="Enter Revision Date" aria-describedby="emailHelp">
                        </div>
                     </div>
                     <div class="col-lg-6">
                        <div class="form-group">
                           <label> Select Tax Structure </label><span class="text-danger">*</span>
                           <select class="form-control select2-init" name="gst_id" id="gst_id" style="width: 100%;">
                              <%foreach from=$gst_structure item='c' %>
                              <option 
                                 value="<%$c->id %>"><%$c->code %></option>
                              <%/foreach%>
                           </select>
                        </div>
                     </div>
                  </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
         </div>
      </div>
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
   var column_details =  <%$data|json_encode%>;
   var page_length_arr = <%$page_length_arr|json_encode%>;
   var is_searching_enable = <%$is_searching_enable|json_encode%>;
   var is_top_searching_enable =  <%$is_top_searching_enable|json_encode%>;
   var is_paging_enable =  <%$is_paging_enable|json_encode%>;
   var is_serverSide =  <%$is_serverSide|json_encode%>;
   var no_data_message =  <%$no_data_message|json_encode%>;
   var is_ordering =  <%$is_ordering|json_encode%>;
   var sorting_column = <%$sorting_column%>;
   var api_name =  <%$api_name|json_encode%>;
   var base_url = <%$base_url|json_encode%>;
</script>
<script src="<%$base_url%>public/js/purchase/child_part_supplier_view.js"></script>