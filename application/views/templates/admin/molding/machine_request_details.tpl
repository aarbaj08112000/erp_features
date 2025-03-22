
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
                <span class="hide-menu">Part Number</span>
                <span class="search-show-hide float-right"><i class="ti ti-minus"></i></span>
              </li>
              <li class="sidebar-item">
                <div class="input-group">
                  <select name="child_part_id" class="form-control select2" id="part_number_search">
                    <option value="">Select Part Number</option>
                    <%foreach from=$supplier_part_list item=parts%>
                    <option value="<%$parts->id%>"><%$parts->part_number %></option>
                    <%/foreach%>
                  </select>
                </div>
              </li>
            </div>
            <div class="filter-row">
              <li class="nav-small-cap">
                <span class="hide-menu">Part Description</span>
                <span class="search-show-hide float-right"><i class="ti ti-minus"></i></span>
              </li>
              <li class="sidebar-item">
                <div class="input-group">
                  <input type="text" id="part_description_search" class="form-control" placeholder="Name">
                </div>
              </li>
            </div>
            <div class="filter-row">
              <li class="nav-small-cap">
                <span class="hide-menu">Name</span>
                <span class="search-show-hide float-right"><i class="ti ti-minus"></i></span>
              </li>
              <li class="sidebar-item">
                <div class="input-group">
                  <input type="text" id="employee_name_search" class="form-control" placeholder="Name">
                </div>
              </li>
            </div>
            <div class="filter-row">
              <li class="nav-small-cap">
                <span class="hide-menu">Name</span>
                <span class="search-show-hide float-right"><i class="ti ti-minus"></i></span>
              </li>
              <li class="sidebar-item">
                <div class="input-group">
                  <input type="text" id="employee_name_search" class="form-control" placeholder="Name">
                </div>
              </li>
            </div>
            <div class="filter-row">
              <li class="nav-small-cap">
                <span class="hide-menu">Name</span>
                <span class="search-show-hide float-right"><i class="ti ti-minus"></i></span>
              </li>
              <li class="sidebar-item">
                <div class="input-group">
                  <input type="text" id="employee_name_search" class="form-control" placeholder="Name">
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
          Production
          <a hijacked="yes" href="javascript:void(0)" class="backlisting-link" title="Back to Issue Request Listing" >
            <i class="ti ti-chevrons-right" ></i>
            <em >View Material Request
               </em></a>
          </h1>
          <br>
          <span >View Material Request MR-<%$machine_request_id %></span>
        </div>
      </nav>

      <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5">
        <button class="btn btn-seconday" type="button" id="downloadCSVBtn" title="Download CSV"><i class="ti ti-file-type-csv"></i></button>
        <button class="btn btn-seconday" type="button" id="downloadPDFBtn" title="Download PDF"><i class="ti ti-file-type-pdf"></i></button>
        <button class="btn btn-seconday filter-icon" type="button"><i class="ti ti-filter" ></i></i></button>
        <button class="btn btn-seconday" type="button"><i class="ti ti-refresh reset-filter"></i></button>


        <!-- <%if ($machine_request_parts==null || $machine_request_parts[0]->request_status == 'pending')  %> -->

             <button type="button" class="btn btn-seconday" data-bs-toggle="modal"
                data-bs-target="#addChildPart">
             <i class="ti ti-plus"></i>
             </button>

        <!-- <%/if%> -->
        <a class="btn btn-seconday" href="<%base_url('machine_request') %>"><i class="ti ti-arrow-left"></i></a>


      </div>

      <div class="modal fade" id="addChildPart" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Add Child Part</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                  </button>
               </div>
               <form action="<%base_url('add_machine_request_details') %>"
               method="POST" enctype="multipart/form-data" id="add_machine_request_details" class="add_machine_request_details custom-form">
               <div class="modal-body">
                  <div class="form-group">
                    
                  </div>
                  <div class="form-group">
                  <label for="on click url">Select Child Part<span
                     class="text-danger">*</span></label>
                  <select name="child_part_id"  id="" class="form-control select2 required-input">
                  <option value="">Select</option>
                  <%if ($child_part) %>
                       <%foreach from=$child_part item=c %>
                      <option value="<%$c->id %>">
                      <%$c->part_number %>/<%$c->part_description %>
                      </option>
                    <%/foreach%>
                   <%/if%>
                  </select>
                  </div>
                  <div class="form-group">
                  <label for="on click url">Enter Qty <span
                     class="text-danger">*</span></label>
                  <input type="text" step="any"  placeholder="Enter Qty"
                     class="form-control onlyNumericInput  required-input" name="qty">
                  <input type="hidden" value="<%$machine_request_id %>"
                     step="any" name="machine_request_id" required placeholder="Enter Qty"
                     class="form-control">
                  </div>
                  <div class="form-group">
                  <label for="on click url">Enter Remark</label>
                  <input type="text" step="any" placeholder="Enter Remark"
                     class="form-control" name="remark">
                  </div>
               </div>
               <div class="modal-footer">
               <button type="button" class="btn btn-secondary"
                  data-bs-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary">Save changes</button>
               </form>
               </div>
            </div>
         </div>
      </div>
        <!-- Main content -->
      <div class="card p-0 mt-4">
        <div class="col-sm-2">
           <%if ($showDocRequestDetails=="true") %>
           Format No: STR-F-02 <br>
           Rev.Date : 3/3/2017 <br>
           Rev.No.  : 00
           <%/if%>
        </div>
        <div class="table-responsive text-nowrap">
          <table width="100%" border="1" cellspacing="0" cellpadding="0" class="table table-striped" style="border-collapse: collapse;" border-color="#e1e1e1" id="machine_request_details">
            <thead>
               <tr>
                  <th>Sr No</th>
                  <th>Child Part </th>
                  <th>UOM</th>
                  <th>Requsted Qty</th>
                  <th>Issued Qty</th>
                  <th>Status</th>
                  <th>Remark</th>
               </tr>
            </thead>
            <tbody>
               <%if ($machine_request_parts) %>
                    <%assign var='i' value= 1 %>
                    <%foreach from=$machine_request_parts item=req %>
                   <tr>
                      <td><%$i %></td>
                      <td><%$req->part_number %>/<%$req->part_description %></td>
                      <td><%$req->uom_name %></td>
                      <td><%$req->qty %></td>
                      <td>
                         <%if ($req->status == "pending") %>
                         <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#addPromo<%$i %>">
                         Issue Qty
                         </button>
                         <%else %>
                            <%$req->accepted_qty %>
                         <%/if%>
                         <div class="modal fade" id="addPromo<%$i %>" tabindex="-1"
                            role="dialog" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                               <div class="modal-content">
                                  <div class="modal-header">
                                     <h5 class="modal-title" id="exampleModalLabel">Issue Qty</h5>
                                     <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close">
                                    
                                     </button>
                                  </div>
                                  <form
                                           action="<%base_url('issue_material_request_qty') %>"
                                           method="POST" enctype="multipart/form-data" id="issue_material_request_qty<%$i %>" class="issue_material_request_qty<%$i %> issue_material_request_qty custom-form">
                                  <div class="modal-body">
                                     <div class="form-group">
                                        
                                     </div>
                                     <div class="form-group">
                                     <label for="on click url">Accept Qty</label>
                                     (Current Stock:<%$req->stock %>)<span
                                        class="text-danger">*</span>
                                     <br>
                                     <%if ($req->stock > 0 && $req->qty <= $req->stock) || true%>
                                       <input  type="text" name="accepted_qty"
                                          placeholder="Accept Qty"
                                          class="form-control required-input onlyNumericInput" data-min="1"
                                          data-max="<%$req->qty %>" data-req="<%$req->stock %>" value="" id="">
                                       <input type="hidden" value="<%$machine_request_id %>"
                                          name="machine_request_id" required
                                          class="form-control">
                                       <input required type="hidden" name="qty"
                                          placeholder="Enter Accept Qty"
                                          class="form-control" min="1"
                                          value="<%$req->qty %>">
                                       <input required type="hidden" name="id"
                                          placeholder="Enter Accept Qty"
                                          class="form-control"
                                          value="<%$req->id %>" id="">
                                       <input required type="hidden" name="part_number"
                                        placeholder="Enter Accept Qty"
                                        class="form-control"
                                        value="<%$req->part_number %>"
                                        id="">
                                     <%assign var='disableSave' value="" %>
                                     <%else %>
                                      Please Add Store Stock
                                        <%assign var='disableSave' value="disabled" %>
                                     <%/if %>
                                     </div>
                                  </div>
                                  <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary"
                                     data-bs-dismiss="modal">Close</button>
                                  <button type="submit" <%$disableSave %> class="btn btn-primary">Save</button>
                                  </form>
                                  </div>
                               </div>
                            </div>
                         </div>
                      </td>
                      <td><%$req->status %></td>
                      <td><%$req->remark %></td>
                   </tr>
                <%assign var='i' value=$i+1 %>
                 <%/foreach%>
                <%/if%>
            </tbody>
         </table>
        </div>
      </div>
      <!--/ Responsive Table -->
    </div>
    <!-- /.col -->


    <div class="content-backdrop fade"></div>
  </div>




  <script src="<%base_url()%>public/js/production/machine_request_details.js"></script>
