<div  class="wrapper container-xxl flex-grow-1 container-p-y">

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
            <span class="hide-menu">Customer</span>
            <span class="search-show-hide float-right"><i class="ti ti-minus"></i></span>
          </li>
          <li class="sidebar-item">
            <div class="input-group">
              <select name="customer_name" class="form-control select2" id="customer_name">
                <option value="">Select Customer</option>
              <%foreach $customers as $val%>
              <option value="<%$val->customer_name%>"><%$val->customer_name%></option>
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
    Planning & Sales
    <a hijacked="yes" href="#stock/issue_request/index" class="backlisting-link" title="Back to Issue Request Listing" >
      <i class="ti ti-chevrons-right" ></i>
      <em >Customer Master</em></a>
  </h1>
  <br>
  <span >Customer Master</span>
</div>
</nav>
<div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5">
    <%if checkGroupAccess("customer_master","import","No")%>
    <button type="button" class="btn btn-seconday " data-bs-toggle="modal"
                        data-bs-target="#exportNoteOnly">
                     Import Note</button>
    <button type="button" class="btn btn-seconday " data-bs-toggle="modal"
                        data-bs-target="#exportCustomerPartsPriceOnly">
                     Export Part Price</button>
     <button type="button" class="btn btn-seconday " data-bs-toggle="modal"
                        data-bs-target="#importCustomerPartsPriceOnly">
                     Import Part Price</button>
    <a class="btn btn-seconday " title="BOM Operation Template export" href="<%base_url('operation_bom_template_excel_export')%>" ><i class="ti ti-download" ></i></a>
    <button type="button" class="btn btn-seconday" data-bs-toggle="modal" data-bs-target="#importCustomerPartsOnly" title="BOM Operation  Import"><i class="ti ti-upload" ></i>
    </button>
    <%/if%>
    
    <button class="btn btn-seconday filter-icon" type="button"><i class="ti ti-filter" ></i></i></button>
    <button class="btn btn-seconday" type="button"><i class="ti ti-refresh reset-filter"></i></button>
    
</div>
<div class="w-100">
<input type="text" name="reason" placeholder="Filter Search" class="form-control serarch-filter-input m-3 me-0" id="serarch-filter-input" fdprocessedid="bxkoib">
</div>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->

<!-- import note  -->
<div class="modal fade" id="exportNoteOnly" tabindex="-1" role="dialog"
   aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg  modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Import Note</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"
               aria-label="Close">
            
            </button>
         </div>
         <div class="modal-body">
            
               <div class="row">
                  <div class="col-lg-10">
                    <div class="form-group">
                     <div class="bd-example fs-5">
                      <ul>
                      <li >
                         Customer name, part no, part description, part rate, rev no, rev date are mandatory fields
                      </li>
                      <li >
                          Revision remark is optional fields
                      </li>
                      <li >
                          Old part rate and old revision no are informative fields
                      </li>
                      <li >
                          Part price should be greater than zero
                      </li>
                      <li >
                          Revision date format should be dd/mm/yyyy
                      </li>
                      <li >
                          Duplicate entry of part no is not allowed
                      </li>
                      <ul>
                     
                      

                      </div>
                  </div>
               </div>
         </div>
        
      </div>
   </div>
</div>
</div>
<!-- import note  -->
        <!-- Import Modal -->
<div class="modal fade" id="importCustomerPartsOnly" tabindex="-1" role="dialog"
   aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Import BOM Data</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"
               aria-label="Close">
            
            </button>
         </div>
         <div class="modal-body">
            <form action="<%base_url('import_operation_bom') %>" 
               method="POST" enctype='multipart/form-data' id="import_operation_bom" class="import_operation_bom custom-form">
               <div class="row">
                  <div class="col-lg-10">
                    <div class="form-group">
                     <label for="contractorName">Customer</label><span
                        class="text-danger">*</span>
                     <select name="customer_id" 
                        class="form-control select2 required-input">
                        <option value="">Select</option>
                        <%if ($customers) %>
                            <%foreach from=$customers item='c' %>
                        <option value="<%$c->id %>">
                           <%$c->customer_name %>
                        </option>
                        <%/foreach%>
                        <%/if%>
                     </select>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-lg-10">
                     <div class="form-group">
                        <label for="po_num">Upload File</label><span
                           class="text-danger">*</span>
                        <input type="file" name="uploadedDoc"  class="form-control required-input" id="exampleuploadedDoc" placeholder="Upload File" aria-describedby="uploadDocHelp">
                     </div>
                  </div>
               </div>
         </div>
         <div class="modal-footer">
         <button type="button" class="btn btn-secondary"
            data-dismiss="modal">Cancel</button>
         <button type="submit" class="btn btn-primary">Import</button>
         </div>
         </form>
      </div>
   </div>
</div>
<!-- Import end -->
<!-- Import Part Price Modal -->
<div class="modal fade" id="exportCustomerPartsPriceOnly" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title w-100" id="exampleModalLabel">
                                 Export Part Price
                               </h5>
                                 <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close">
                                 </button>
                              </div>
                              <div class="modal-body">
                                 <form action="<%base_url('global_export') %>" 
                                    method="POST" enctype='multipart/form-data' class="global_export custom-form" id="global_export">
                                    <div class="row">
                                       <div class="col-lg-12">
                                        <div class="form-group">
                                          <label for="contractorName">Customer</label><span
                                             class="text-danger">*</span>
                                          <select name="customer_id_export" class="form-control select2 required-input" id="customer_id_export">
                                              <option value="">Select Customer</option>
                                            <%foreach $customers as $val%>
                                                <option value="<%$val->id%>"><%$val->customer_name%></option>
                                            <%/foreach%>
                                            </select>
                                       </div>
                                       <input type="hidden" name="export_type" value="customer_part_price">
                                   </div>
                                    </div>
                              </div>
                              <div class="modal-footer">
                              <button type="button" class="btn btn-secondary"
                                 data-bs-dismiss="modal">Cancel</button>
                              <button type="submit" class="btn btn-primary">Import</button>
                              </div>
                              </form>
                           </div>
                        </div>
                     </div>
<div class="modal fade" id="importCustomerPartsPriceOnly" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title w-100" id="exampleModalLabel">
                                 Import Part Price
                               </h5>
                                 <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close">
                                 </button>
                              </div>
                              <div class="modal-body">
                                 <form action="<%base_url('global_import') %>" 
                                    method="POST" enctype='multipart/form-data' id="global_import" class="global_import custom-form">
                                    
                                    <div class="row">
                                       <div class="col-lg-12">
                                        <div class="form-group">
                                          <label for="contractorName">Customer</label><span
                                             class="text-danger">*</span>
                                          
                                          <select name="customer_id" class="form-control select2 required-input" id="customer_name_import">
                                              <option value="">Select Customer</option>
                                            <%foreach $customers as $val%>
                                                <option value="<%$val->id%>"><%$val->customer_name%></option>
                                            <%/foreach%>
                                            </select>
                                       </div>
                                   </div>
                                    </div>
                                    <div class="row">
                                       <div class="col-lg-12">
                                          <div class="form-group">
                                             <label for="po_num">Upload PO</label><span
                                                class="text-danger">*</span>
                                             <input type="file" name="uploadedDoc"  class="form-control required-input" id="exampleuploadedDocImport" placeholder="Upload PO" aria-describedby="uploadDocHelp">
                                          </div>
                                       </div>
                                    </div>
                                    <input type="hidden" name="export_type" value="customer_part_price">
                              </div>
                              <div class="modal-footer">
                              <input type="hidden" value="<%$segment_2%>"
                                 class="hidden">
                              <input type="hidden" value="<%$segment_3%>"
                                 class="hidden">
                              <button type="button" class="btn btn-secondary"
                                 data-bs-dismiss="modal">Cancel</button>
                              <button type="submit" class="btn btn-primary">Import</button>
                              </div>
                              </form>
                           </div>
                        </div>
                     </div>
<!-- Import Part Price Modal -->
        <!-- Main content -->
        <section class="content">
            <div class="">
                <div class="row">
                    <div class="col-12">

                        <!-- /.card -->

                        <div class="card">
                            <div class="">
                                
                                <!-- Button trigger modal -->
                                <!-- <button type="button" class="btn btn-primary float-left" data-toggle="modal" data-target="#exampleModal">
                                    Add Customer</button> -->

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content modal-lg">
                                            <div class="modal-header ">
                                                <!-- <h5 class="modal-title" id="exampleModalLabel">Add Customer</h5> -->
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="<%$base_url%>addCustomer" method="POST">
                                                    <div class="row">
                                                        <div class="col-lg-12">

                                                            <div class="form-group">
                                                                <label for="customer_name">Customer Name</label><span class="text-danger">*</span>
                                                                <input type="text" name="customerName" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Customer Name">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="customer_code">Customer Code</label><span class="text-danger">*</span>
                                                                <input type="text" name="customerCode" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Customer Code">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="customer_location">Customer billing address</label><span class="text-danger">*</span>
                                                                <input type="text" name="customerLocation" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Customer Billing Address">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="customer_saddress">Customer shifting address</label><span class="text-danger">*</span>
                                                                <input type="text" name="customerSaddress" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Customer Shifting Address">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="state">Add State</label><span class="text-danger">*</span>
                                                                <input type="text" name="state" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Add State">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="state_no">State No</label><span class="text-danger">*</span>
                                                                <input type="text" name="state_no" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Add ">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="gst_no">Add GST Number</label><span class="text-danger">*</span>
                                                                <input type="text" name="gst_no" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Add GST Number">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="vendor_code">Vendor code No</label><span class="text-danger">*</span>
                                                                <input type="text" name="vendor_code" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Add ">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="pan_no">PAN No</label><span class="text-danger">*</span>
                                                                <input type="text" name="pan_no" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Add ">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="payment_terms">Payment Terms</label><span class="text-danger">*</span>
                                                                <input type="number" min="0" name="paymentTerms" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Payment Terms">
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
                            </div>
                            <!-- /.card-header -->
                            <div class="">
                                <table id="example1" class="table  table-striped">
                                    <thead>
                                        <tr>
                                            <!-- <th>Sr. No.</th> -->  
                                            <th style="display:none">Id</th> 
                                            <th>Name</th>
                                            <th>Code</th>
                                            <th>Part</th>
                                            <th>Part price</th>
                                            <!-- show PLM if enabled -->
                                            <%if $entitlements.isPLMEnabled == 1%>
                                                <th>Part Drawing </th>
                                                <th>Documents </th>
                                            <%/if%>
                                            <th>Part BOM </th>
                                            <th>Part Operation </th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                        <%assign var="i" value=1%>
                                        <%if $customers%>
                                            <%foreach $customers as $t%>
                                                <tr>
                                                    <!-- <td><%$i%></td> -->
                                                    <td style="display:none"><%$t->id%></td>
                                                    <td><%$t->customer_name%></td>
                                                    <td><%$t->customer_code%></td>
                                                    <td>
                                                        <a class="btn btn-info" href="<%$base_url%>customer_part/<%$t->id%>">
                                                            Parts</a>
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-primary" href="<%$base_url%>customer_part_price/<%$t->id%>">
                                                            Part Price</a>
                                                    </td>
                                                    <%if $entitlements.isPLMEnabled == 1%>
                                                        <td>
                                                            <a class="btn btn-secondary" href="<%$base_url%>customer_part_drawing/<%$t->id%>">
                                                                Part Drawing</a>
                                                        </td>
                                                        <td>
                                                            <a class="btn btn-success" href="<%$base_url%>customer_part_documents/<%$t->id%>">
                                                                Documents</a>
                                                        </td>
                                                    <%/if%>
                                                    <td>
                                                        <a class="btn btn-warning" href="<%$base_url%>bom/<%$t->id%>">
                                                            Part BOM</a>
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-danger" href="<%$base_url%>customer_part_main/<%$t->id%>">
                                                            Part Operations</a>
                                                    </td>
                                                </tr>
                                                <%assign var="i" value=$i+1%>
                                            <%/foreach%>
                                        <%/if%>
                                    </tbody>

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
</div>
<script type="text/javascript">
    var isPLMEnabled = <%$entitlements.isPLMEnabled|@json_encode%>;
    var export_message = <%$export_message|@json_encode%>;
</script>
<script src="<%$base_url%>/public/js/planning_and_sales/customer_master.js"></script>
<style type="text/css">
  .toast-top-right {
    top: 12px;
    right: 12px;
    width: 98% !important;
    height: 1px !important;
}
.toast {
    width: 100% !important;
}
</style>