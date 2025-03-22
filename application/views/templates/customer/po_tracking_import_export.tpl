<div class="wrapper">
<!-- Navbar -->
<!-- /.navbar -->
<!-- Main Sidebar Container -->
<!-- Content Wrapper. Contains page content -->
<div class="wrapper container-xxl flex-grow-1 container-p-y">
   <!-- Content Header (Page header) -->
    <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme filter-popup-block" style="width: 0px;">
       <form action="<%base_url('customer_po_tracking_importExport')%>" method="post">
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
                  <select name="customer_id" class="form-control select2" >
                    <option value="">Select Customer</option>
                                       <option value="ALL">ALL</option>
                                       <%if ($customer_data) %>
                                           <%foreach from=$customer_data item=c %>
                                       <option 
                                          <%if ($customer_id == $c->id)%>selected<%/if%>
                                          value="<%$c->id%>">
                                          <%$c->customer_name%>
                                       </option>
                                       <%/foreach%>
                                        <%/if%>
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
  </form>
    </aside>
     <div class="sub-header-left pull-left breadcrumb">
        <h1>
        Sales Order
          <a hijacked="yes" href="#stock/issue_request/index" class="backlisting-link" title="Back to Issue Request Listing" >
            <i class="ti ti-chevrons-right" ></i>
            <em >Import/Export Customer PO</em></a>
        </h1>
        <br>
        <span >Import/Export Customer PO</span>
      </div>
    </nav>
    <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5">
      <button type="button" class="btn btn-seconday " data-bs-toggle="modal"
                        data-bs-target="#exportNoteOnly">
                     Import Note</button>
  <button type="button" class="btn btn-seconday " data-bs-toggle="modal"
                        data-bs-target="#exportCustomerPartsOnly">
                     Export Customer Parts</button>
                     <button type="button" class="btn btn-seconday " data-bs-toggle="modal"
                        data-bs-target="#importCustomerPartsOnly">
                     Import PO Data</button>
                     <button class="btn btn-seconday filter-icon" type="button"><i class="ti ti-filter" ></i></i></button>
 <%* <button class="btn btn-seconday" type="button"><i class="ti ti-refresh reset-filter"></i></button> *%>
</div>
   <!-- Main content -->
   <section class="content">
      <div class="">
         <div class="row">
            <div class="col-12">
              <div class="w-100">
        <input type="text" name="reason" placeholder="Filter Search" class="form-control serarch-filter-input m-3 me-0" id="serarch-filter-input" fdprocessedid="bxkoib">
      </div>
               <!-- /.card -->
               <div class="card w-100">
                  <div class="">
                     <!-- Button trigger modal -->
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
            <form action="<%base_url('import_operation_bom') %>" 
               method="POST" enctype='multipart/form-data' id="import_operation_bom" class="import_operation_bom custom-form">
               <div class="row">
                  <div class="col-lg-10">
                    <div class="form-group">
                     <div class="bd-example fs-5">
                      <ul>
                      <li >
                         Customer name, SO no, start date, end date, Part no, part description, QTY are mandatory fields
                      </li>
                      <li >
                          Item code, warehouse & remark are optional fields
                      </li>
                      <li >
                          If part no is defined in customer part price, then only It can be imported to SO tracking
                      </li>
                      <li >
                          Date format for Start date & end date should be dd/mm/yyyy
                      </li>
                      <li >
                          For 1 SO there should be single start date & end date
                      </li>
                      <li >
                          Duplicate entry of SO no is not allowed
                      </li>
                      <li >
                          Duplicate entry of part no is not allowed
                      </li>
                      <li >
                          SO QTY should be greater than zero
                      </li>
                      <ul>
                     
                      

                      </div>
                  </div>
               </div>
         </div>
         </form>
      </div>
   </div>
</div>
</div>
<!-- import note  -->
                     <!-- Export Modal -->
                     <div class="modal fade" id="exportCustomerPartsOnly" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title" id="exampleModalLabel">Export Customer Parts </h5>
                                 <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close">
                                 </button>
                              </div>
                              <div class="modal-body">
                                 <form action="<%base_url('po_export_customer_part') %>"
                                    method="POST">
                                    <div class="row">
                                       <div class="col-lg-10">
                                        <div class="form-group">
                                          <label for="contractorName">Customer</label><span
                                             class="text-danger">*</span>
                                          <select name="customer_id" id=""
                                             class="form-control select2" required>
                                             <option value="">Select Customer</option>
                                             <%if ($customer_data) %>
                                                <%foreach from=$customer_data item=c%>
                                             <option value="<%$c->id%>">
                                                <%$c->customer_name%>
                                             </option>
                                             <%/foreach%>
                                               <%/if%>
                                          </select>
                                          </div>
                                       </div>
                                    </div>
                              </div>
                              <div class="modal-footer">
                              <input type="hidden" value="<?php echo $this->uri->segment('2') ?>"
                                 class="hidden">
                              <input type="hidden" value="<?php echo $this->uri->segment('3') ?>"
                                 class="hidden">
                              <button type="button" class="btn btn-secondary"
                                 data-dismiss="modal">Cancel</button>
                              <button type="submit" class="btn btn-primary">Export</button>
                              </div>
                              </form>
                           </div>
                        </div>
                     </div>
                     <!-- Import Modal -->
                     <div class="modal fade" id="importCustomerPartsOnly" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title" id="exampleModalLabel">Import PO Data</h5>
                                 <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close">
                                 </button>
                              </div>
                              <div class="modal-body">
                                 <form action="<%base_url('import_customer_po_tracking') %>" 
                                    method="POST" enctype='multipart/form-data'>
                                    <div class="row">
                                       <div class="col-lg-10">
                                        <div class="form-group">
                                          <label for="contractorName">Customer</label><span
                                             class="text-danger">*</span>
                                          <select name="customer_id" id=""
                                             class="form-control select2" required>
                                              <option value="">Select Customer</option>
                                               <%if ($customer_data) %>
                                                  <%foreach from=$customer_data item=c%>
                                               <option value="<%$c->id%>">
                                                  <%$c->customer_name%>
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
                                             <label for="po_num">Upload PO</label><span
                                                class="text-danger">*</span>
                                             <input type="file" name="uploadedDoc" required class="form-control" id="exampleuploadedDoc" placeholder="Upload PO" aria-describedby="uploadDocHelp">
                                          </div>
                                       </div>
                                    </div>
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
                     <!-- Import end -->
                  </div>
                 
                 
                  <!-- Grid --->
                  <div class="table-responsive text-nowrap">
                     <table id="customer_po_tracking_importExport" class="table table-striped w-100">
                        <thead>
                           <tr>
                              <!-- <th>Sr.No.</th> -->
                              <th>Item</th>
                              <th>Item description</th>
                              <th>PO Number</th>
                              <th>PO Quantity</th>
                              <!-- <th>UOM</th> -->
                              <th>Passivation</th>
                              <th>Thickness</th>
                              <th>Grade</th>
                              <th>Warehouse</th>
                              <th>Due date</th>
                              <th>Status</th>
                              <th>Remark</th>
                              <!-- <th>PO Unit Price</th> -->
                              <th>Part Rate</th>
                              <!-- <th>Price Change</th> -->
                           </tr>
                        </thead>
                        <tbody>
                              <%assign var='srNo' value=0%>
                              <%if ($export_data) %>
                                  <%foreach from=$export_data item=exp %>
                           <tr>
                              <!-- <td><%$srNo%></td> -->
                              <td><%$exp->part_number %></td>
                              <td><%$exp->part_description%></td>
                              <td><%$exp->po_number%></td>
                              <td><%$exp->qty%></td>
                              <!-- <td><php echo $exp->uom; ?></td> -->
                              <td><%$exp->passivationType%></td>
                              <td><%$exp->thickness%></td>
                              <td><%$exp->rm_grade%></td>
                              <td><%$exp->warehouse%></td>
                              <td ><%$exp->due_date%></td>
                              <td><%$exp->status%></td>
                              <td><%$exp->remark%></td
                                 <%assign var='isMatchstyle' value="color:black;"%>
                                 <%if ($exp->imported_price != $exp->rate) %>
                                     <%assign var='isMatchstyle' value="color: red; font-weight: bold;"%>
                                     <%assign var='priceDifferent' value="Yes"%>
                                 <%else %>
                                 <%assign var='priceDifferent' value=null%>
                                 <%/if%>
                              </td>
                              <!-- <td style="<%$isMatchstyle%>"><%$exp->imported_price%></td> -->
                              <td><%$exp->rate%></td>
                              <!-- <td style="<%$isMatchstyle%>"><%$priceDifferent%></td> -->
                           </tr>
                              <%assign var='srNo' value=$srNo+1%>
                              <%/foreach%>
                            <%/if%>
                        </tbody>
                     </table>
                  </div>
                  <!-- /.card-header -->
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
 <script>
    var po_message =  <%$po_message|json_encode%>;
    var po_message_su =  <%$po_message_su|json_encode%>;
</script>
<script src="<%$base_url%>public/js/planning_and_sales/po_tracking_import_export.js"></script>
<!-- /.content-wrapper -->
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