<div class="content-wrapper">
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
   <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme filter-popup-block" style="width: 0px;">
    <form class="search-" action="<%base_url('view_p_q')%>" id="seacrh-filter-block" method="post">
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
                <span class="hide-menu">Output Part/Description</span>
                <span class="search-show-hide float-right"><i class="ti ti-minus"></i></span>
              </li>
              <li class="sidebar-item">
                <div class="input-group">
                  <select name="part_id" class="form-control select2" id="search_inhouse_part_name">
                          <option value="">Select Inhouse Part Number / Description</option>
                         <%foreach from=$inhouse_parts item=i %>
                                          <option 
                                             
                                             value="<%$i->id%>" <%if $i->id eq $selected_part_id%>selected<%/if%>><%$i->part_number%>/<%$i->part_description%></option>
                                          <%/foreach%>
                       </select>
                </div>
              </li>
            </div>
            <div class="filter-row">
              <li class="nav-small-cap">
                <span class="hide-menu">Machine</span>
                <span class="search-show-hide float-right"><i class="ti ti-minus"></i></span>
              </li>
              <li class="sidebar-item">
                <div class="input-group">
                  <select name="search_machine_name" class="form-control select2" id="search_machine_name">
                          <option value="">Select Machine</option>
                        <%foreach from=$machine_data item=i %>
                              <option 
                                 value="<%$i->id %>"  <%if $i->id eq $selected_machin_name%>selected<%/if%>><%$i->name %></option>
                             <%/foreach%>
                       </select>
                </div>
              </li>
            </div>
            <div class="filter-row">
              <li class="nav-small-cap">
                <span class="hide-menu">Status</span>
                <span class="search-show-hide float-right"><i class="ti ti-minus"></i></span>
              </li>
              <li class="sidebar-item">
                <div class="input-group">
                  <select name="status" class="form-control select2" id="search_status">
                        <option value="">Select Status</option>
                        <option value="pending" <%if $status eq 'pending'%>selected<%/if%>>pending</option>
                        <option value="completed" <%if $status eq 'completed'%>selected<%/if%>>completed</option>
                       </select>
                </div>
              </li>
            </div>
            <div class="filter-row">
              <li class="nav-small-cap">
                <span class="hide-menu"> Date</span>
                <span class="search-show-hide float-right"><i class="ti ti-minus"></i></span>
              </li>
              <li class="sidebar-item">
                <div class="input-group">
                <input type="text" name="datetimes" class="dates form-control" id="date_range_filter" />
                </div>
              </li>
            </div>
            

          </ul>
        </div>
      </nav>
      <div class="filter-popup-btn">
        <button class="btn btn-outline-danger reset-filter" id="reset-filter">Reset</button>
        <button class="btn btn-primary search-filter" type="submit">Search</button>
      </div>
      </form>
    </aside>
    <nav aria-label="breadcrumb">
      <div class="sub-header-left pull-left breadcrumb">
         <h1>
            Production
            <a hijacked="yes" href="javascript:void(0)" class="backlisting-link" title="Back to Issue Request Listing" >
            <i class="ti ti-chevrons-right" ></i>
            <em >Production Qty</em></a>
         </h1>
         <br>
         <span >Production Qty</span>
      </div>
   </nav>
   <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5">
    <%if checkGroupAccess("view_p_q","add","No")%>
        <button id="AddProdButton" type="button" class="btn btn-seconday" data-bs-toggle="modal" data-bs-target="#addPromo" title=" Add Production Qty">
        <i class="ti ti-plus"></i>
        </button>
      <%/if%>
      <%if checkGroupAccess("view_p_q","export","No")%>
        <button class="btn btn-seconday" type="button" id="downloadCSVBtn" title="Download CSV"><i class="ti ti-file-type-csv"></i></button>
        <button class="btn btn-seconday" type="button" id="downloadPDFBtn" title="Download PDF"><i class="ti ti-file-type-pdf"></i></button>
      <%/if%>
      <button class="btn btn-seconday filter-icon" type="button"><i class="ti ti-filter" ></i></i></button>
        <button class="btn btn-seconday" type="button"><i class="ti ti-refresh reset-filter" id="reset-filter-top"></i></button>
   </div>
   <div class="w-100">
              <input type="text" name="reason" placeholder="Filter Search" class="form-control serarch-filter-input m-3 me-0" id="serarch-filter-input" fdprocessedid="bxkoib">
           </div>
   <section class="content">
      <div class="card w-100">
                  <div class="">
                     
                     <table id="molding_production" class="table table-striped">
                        <thead>
                           <tr>
                              <th style="display: none">Sr No</th>
                              <th>Output Part Number / Descriptions </th>
                              <th>Date</th>
                              <th>Shift</th>
                              <th>Machine</th>
                              <th>Operator</th>
                              <th>Qty</th>
                              <th>Scrap</th>
                              <th>Accepted Qty</th>
                              <th>Rejected Qty</th>
                              <th>Onhold Qty</th>
                              <th>Status</th>
                              <th>Actions</th>
                              <th>View Details</th>
                           </tr>
                        </thead>
                        <tbody>
                           <%if ($p_q) %>
                           <%assign var='i' value=1%>
                           <%foreach from=$p_q item=u %>
                           <tr>
                              <td style="display: none"><%$u->id %></td>
                              <td><%$u->output_part_data[0]->part_number %>/<%$u->output_part_data[0]->part_description %>
                              </td>
                              <td><%defaultDateFormat($u->date) %></td>
                              <td><%$u->shift_type %>/<%$u->shift_name %>
                              </td>
                              <td><%$u->machine_name %></td>
                              <td><%$u->op_name %></td>
                              <td><%$u->qty %></td>
                              <td><%$u->scrap_factor %></td>
                              <td><%$u->accepted_qty %></td>
                              <td><%$u->rejected_qty %></td>
                              <td>
                                 <%if (!empty($u->onhold_qty)) %>
                                  <%if checkGroupAccess("view_p_q","update","No")%>
                                     <button type="button" class="btn btn-warning float-left "
                                        data-bs-toggle="modal" data-bs-target="#onhold<%$i %>">
                                     <%$u->onhold_qty %> </button>
                                  <%else%>
                                      <%$u->onhold_qty %>
                                  <%/if%>
                                 <%else %>
                                 0
                                 <%/if%>
                                 <div class="modal fade" id="onhold<%$i %>" tabindex="-1"
                                    role="dialog" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                       <div class="modal-content">
                                          <div class="modal-header">
                                             <h5 class="modal-title" id="exampleModalLabel">
                                                Onhold
                                                Update 
                                             </h5>
                                             <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                             </button>
                                          </div>
                                          <div class="modal-body">
                                             <form
                                                action="<%base_url('update_p_q_onhold') %>"
                                                method="POST" enctype='multipart/form-data' class="update_p_q_onhold update_p_q_onhold<%$i %> custom-form" id="update_p_q_onhold<%$i %>">
                                                <div class="row">
                                                   <div class="col-lg-12">
                                                      <div class="form-group">
                                                         <label for="">Qty</label>
                                                         <input type="number" step="any"
                                                            value="<%$u->onhold_qty %>"
                                                            readonly class="form-control">
                                                      </div>
                                                   </div>
                                                   <div class="col-lg-12">
                                                      <div class="form-group">
                                                         <label for="">Accept Qty <span
                                                            class="text-danger">*</span>
                                                         </label>
                                                         <input type="text" step="any" value=""
                                                            data-max="<%$u->onhold_qty %>"
                                                            data-min="0" class="form-control required-input"
                                                            name="accepted_qty"
                                                            placeholder="Enter Accepted Quantity"
                                                            >
                                                      </div>
                                                   </div>
                                                   <div class="col-lg-12">
                                                      <div class="form-group">
                                                         <label for="">Rejection
                                                         Reason</label>
                                                         <select name="rejection_reason" 
                                                            class="form-control select2 required-input">
                                                            <option value="NA">NA</option>
                                                            <%if ($reject_remark) %>
                                                            <%foreach from=$reject_remark item=r %>
                                                            <option
                                                               value="<%$r->name %>">
                                                               <%$r->name %>
                                                            </option>
                                                            <%/foreach%>
                                                            <%/if%>
                                                         </select>
                                                      </div>
                                                   </div>
                                                   <div class="col-lg-12">
                                                      <div class="form-group">
                                                         <label for="">Reject Remark</label>
                                                         <input type="text"
                                                            placeholder="Enter Rejection Remark If any"
                                                            class="form-control"
                                                            name="rejection_remark">
                                                         <input type="hidden"
                                                            placeholder="Enter Rejection Remark If any"
                                                            readonly class="form-control"
                                                            name="id"
                                                            value="<%$u->id %>">
                                                         <input type="hidden"
                                                            placeholder="Enter Rejection Remark If any"
                                                            readonly class="form-control"
                                                            name="qty"
                                                            value="<%$u->onhold_qty %>">
                                                         <input type="hidden"
                                                            placeholder="Enter Rejection Remark If any"
                                                            readonly class="form-control"
                                                            name="output_part_id"
                                                            value="<%$u->output_part_id %>">
                                                         <input type="hidden"
                                                            placeholder="Enter Rejection Remark If any"
                                                            readonly class="form-control"
                                                            name="accepted_qty_old"
                                                            value="<%$u->accepted_qty %>">
                                                         <input type="hidden"
                                                            placeholder="Enter Rejection Remark If any"
                                                            readonly class="form-control"
                                                            name="rejected_qty_old"
                                                            value="<%$u->rejected_qty %>">
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="modal-footer">
                                                   <button type="button" class="btn btn-secondary"
                                                      data-dismiss="modal">Close</button>
                                                   <button type="submit"
                                                      class="btn btn-primary">Save
                                                   changes</button>
                                                </div>
                                          </div>
                                          </form>
                                       </div>
                                    </div>
                                 </div>
                              </td>
                              <td><%$u->status %></td>
                              <td style="text-align: center;">
                                 <%if ($u->status == "pending") %>
                                   <%if checkGroupAccess("view_p_q","update","No")%>
                                        <button type="button" class="btn btn-danger float-left "
                                          data-bs-toggle="modal" data-bs-target="#acceptReject<%$i %>">
                                       Accept/Reject </button>
                                    <%else%>
                                      <%display_no_character("")%>
                                    <%/if%>
                                 <%else %>
                                 --
                                 <%/if%>
                                 <div class="modal fade" id="acceptReject<%$i %>" tabindex="-1"
                                    role="dialog" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog  modal-dialog-centered" role="document">
                                       <div class="modal-content">
                                          <div class="modal-header">
                                             <h5 class="modal-title" id="exampleModalLabel">Add </h5>
                                             <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                             </button>
                                          </div>
                                          <div class="modal-body">
                                             <form action="<%base_url('update_p_q') %>"
                                                method="POST" enctype='multipart/form-data' id="update_p_q<%$i %>" class="update_p_q update_p_q<%$i %> custom-form" data-form="update_p_q">
                                                <div class="row">
                                                   <div class="col-lg-12">
                                                      <div class="form-group">
                                                         <label for="">Qty</label>
                                                         <input type="text"
                                                            value="<%$u->qty %>"
                                                            readonly class="form-control qty_required">
                                                      </div>
                                                   </div>
                                                   <div class="col-lg-12">
                                                      <div class="form-group">
                                                         <label for="">Accept Qty <span
                                                            class="text-danger">*</span>
                                                         </label>
                                                         <input type="text" step="any" value=""
                                                            data-max="<%$u->qty %>" dat-min="0"
                                                            class="form-control required-input accepted_qty onlyNumericInput"
                                                            name="accepted_qty"
                                                            placeholder="Enter Accepted Quantity"
                                                            >
                                                      </div>
                                                   </div>
                                                   <div class="col-lg-12">
                                                      <div class="form-group">
                                                         <label for="">Onhold Qty <span
                                                            class="text-danger">*</span>
                                                         </label>
                                                         <input type="text" step="any" value=""
                                                            data-max="<%$u->qty %>" data-min="0"
                                                            class="form-control required-input onlyNumericInput onhold_qty"
                                                            name="onhold_qty"
                                                            placeholder="Enter onhold" >
                                                      </div>
                                                   </div>
                                                   <div class="col-lg-12">
                                                      <div class="form-group">
                                                         <label for="">Rejection Reason</label>
                                                         <select name="rejection_reason" 
                                                            class="form-control select2 required-input">
                                                            <option value="NA">NA</option>
                                                            <%if ($reject_remark) %>
                                                            <%foreach from=$reject_remark item=r %>
                                                            <option
                                                               value="<%$r->name %>">
                                                               <%$r->name %>
                                                            </option>
                                                            <%/foreach%>
                                                            <%/if%>
                                                         </select>
                                                      </div>
                                                   </div>
                                                   <div class="col-lg-12">
                                                      <div class="form-group">
                                                         <label for="">Reject Remark</label>
                                                         <input type="text"
                                                            placeholder="Enter Rejection Remark If any"
                                                            class="form-control"
                                                            name="rejection_remark">
                                                         <input type="hidden"
                                                            placeholder="Enter Rejection Remark If any"
                                                            readonly class="form-control"
                                                            name="id"
                                                            value="<%$u->id %>">
                                                         <input type="hidden"
                                                            placeholder="Enter Rejection Remark If any"
                                                            readonly class="form-control"
                                                            name="qty"
                                                            value="<%$u->qty %>">
                                                         <input type="hidden"
                                                            placeholder="Enter Rejection Remark If any"
                                                            readonly class="form-control"
                                                            name="output_part_id"
                                                            value="<%$u->output_part_id %>">
                                                         <input type="hidden"
                                                            placeholder="Enter Rejection Remark If any"
                                                            readonly class="form-control"
                                                            name="scrap_factor"
                                                            value="<%$u->scrap_factor %>">
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="modal-footer">
                                                   <button type="button" class="btn btn-secondary"
                                                      data-dismiss="modal">Close</button>
                                                   <button type="submit"
                                                      class="btn btn-primary">Save
                                                   changes</button>
                                                </div>
                                          </div>
                                          </form>
                                       </div>
                                    </div>
                                 </div>
                              </td>
                              <td>
                                <%if ($u->status != "pending") %>
                                 <a class="btn btn-info"
                                    href="<%base_url('details_production_qty/') %><%$u->id %>">
                                 View Details</a>
                                <%else%>
                                  <%display_no_character("")%>
                                <%/if%>
                              </td>
                           </tr>
                           <%assign var='i' value=$i+1%>
                           <%/foreach%>
                           <%/if%>
                        </tbody>
                     </table>
                  </div>
               </div>
      <div class="modal fade" id="addPromo" tabindex="-1" role="dialog"
                  aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                     <div class="modal-content">
                        <!-- Modal content will be populated here by AJAX -->
                     </div>
                  </div>
               </div>
   </section>
</div>
<style type="text/css">
  .swal2-container.swal2-shown {
    background-color: rgba(0, 0, 0, 0.4);
    z-index: 100000;
}
</style>
<script type="text/javascript">
   var url = <%site_url("SheetProdController/production_qty_add")|@json_encode%>
</script>
<script type="text/javascript">
   var base_url = <%$base_url|@json_encode%>;
   var start_date = <%$start_date|json_encode%>;
    var end_date = <%$end_date|json_encode%>;
</script>
<script src="<%$base_url%>public/js/production/p_q.js"></script>
