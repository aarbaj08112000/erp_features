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
                        <span class="hide-menu">Date</span>
                        <span class="search-show-hide float-right"><i class="ti ti-minus"></i></span>
                     </li>
                     <li class="sidebar-item">
                        <div class="input-group">
                           <input type="text" id="date_range_filter" class="form-control" placeholder="Name">
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
               <em >Molding Production
               </em></a>
            </h1>
            <br>
            <span >Molding Production</span>
         </div>
      </nav>
      <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5">
         <%if checkGroupAccess("p_q_molding_production","add","No")%>
            <button type="button" class="btn btn-seconday" data-bs-toggle="modal"
               data-bs-target="#addPromo" title="Add Molding Production Qty">
            <i class="ti ti-plus"></i>
            </button>
         <%/if%>
         <%if checkGroupAccess("p_q_molding_production","export","No")%>
            <button class="btn btn-seconday" type="button" id="downloadCSVBtn" title="Download CSV"><i class="ti ti-file-type-csv"></i></button>
            <button class="btn btn-seconday" type="button" id="downloadPDFBtn" title="Download PDF"><i class="ti ti-file-type-pdf"></i></button>
         <%/if%>
         <button class="btn btn-seconday filter-icon" type="button"><i class="ti ti-filter" ></i></i></button>
         <button class="btn btn-seconday" type="button"><i class="ti ti-refresh reset-filter"></i></button>
      </div>
      <div class="modal fade" id="addPromo" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Add Molding Production Quantity</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                  </button>
               </div>
               <form
               action="javascript:void(0);"
               method="POST" enctype="multipart/form-data" class="add_production_qty_molding_production custom-form">
               <div class="modal-body">
               
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="on click url">Customer Name / Part Number / Part Description<span
                    class="text-danger">*</span></label>
                  <select  name="customer_part_id" id="" class="form-control select2 required-input" style="width: 100%;">
                    <option value="">Select</option>
                    <%if ($customer_part_new) %>
                    <%foreach from=$customer_part_new item=s %>
                    <option value="<%$s->id %>">
                        <%$s->customer_name %> / <%$s->part_number %> / <%$s->part_description %>
                    </option>
                    <%/foreach%>
                    <%/if%>
                  </select>
              </div>
              </div>
               <div class="col-lg-6">
                  <div class="form-group">
                     <label for="on click url">Machine<span
                        class="text-danger">*</span></label>
                     <select  name="machine_id" id="" class="form-control select2 required-input" style="width: 100%;">
                        <option value="">Select</option>
                        <%if ($machine) %>
                        <%foreach from=$machine item=s %>
                        <option value="<%$s->id %>"><%$s->name %></option>
                        <%/foreach%>
                        <%/if%>
                     </select>
                  </div>
               </div>
               <div class="col-lg-6">
                  <div class="form-group">
                     <label for="on click url">Select Customer Part / Mold Name / Cavity<span class="text-danger">*</span></label>
                     <select  name="mold_id" id="" class="form-control select2 required-input" style="width: 100%;">
                        <%if ($mold_maintenance) %>
                        <%foreach from=$mold_maintenance item=s %>
                        <option value="<%$s->id %>">
                           <%$s->part_number %>/<%$s->part_description %>/<%$s->mold_name %>/<%$s->no_of_cavity %>
                        </option>
                        <%/foreach%>
                        <%/if%>
                     </select>
                  </div>
               </div>

            
               <div class="col-lg-6">
                  <div class="form-group">
                     <label for="on click url">Date
                     <span class="text-danger">*</span></label>
                     <input max="<%date('Y-m-d') %>" type="date"
                        value="<%date('Y-m-d') %>" name="date" required
                        class="form-control required-input">
                  </div>
               </div>
               <div class="col-lg-6">
                  <div class="form-group">
                     <label  for="on click url">Shift Type / Name / Start Time /
                     End Time<span class="text-danger">*</span></label>
                     <select name="shift_id" name="" id="" class="form-control select2 required-input" style="width: 100%;">
                        <option value="">Select</option>
                        <%if ($shifts) %>
                        <%foreach from=$shifts item=s %>
                        <option value="<%$s->id %>">
                           <%$s->shift_type %> / <%$s->name %> / <%$s->start_time %> / <%$s->end_time %>
                        </option>
                        <%/foreach%>
                        <%/if%>
                     </select>
                  </div>
               </div>
            
               <div class="col-lg-6">
                  <div class="form-group">
                     <label for="on click url">Production OK Quantity<span
                        class="text-danger">*</span></label>
                     <input type="text" data-min="1" value="0" name="qty" 
                        class="form-control required-input onlyNumericInput">
                  </div>
               </div>
               <div class="col-lg-6">
                  <div class="form-group">
                     <label for="on click url">Production Rejection<span
                        class="text-danger">*</span></label>
                     <input type="text" value="0" name="rejection_qty" 
                        class="form-control required-input onlyNumericInput">
                  </div>
               </div>

               <div class="col-lg-6">
                  <div class="form-group">
                     <label for="on click url">Production Minutes<span
                        class="text-danger">*</span></label>
                     <input type="text" value="" name="production_hours" 
                        class="form-control  required-input onlyNumericInput">
                  </div>
               </div>
               <div class="col-lg-6">
                  <div class="form-group">
                     <label for="on click url">Downtime in min <span
                        class="text-danger">*</span></label>
                     <input type="text" step="any" name="downtime_in_min" 
                        class="form-control  required-input onlyNumericInput">
                  </div>
               </div>
               <div class="col-lg-6">
                  <div class="form-group">
                     <label for="on click url">Setup in min <span
                        class="text-danger">*</span></label>
                     <input type="text" step="any" name="setup_time_in_min" 
                        class="form-control  required-input onlyNumericInput">
                  </div>
               </div>
               <div class="col-lg-6">
                  <div class="form-group">
                     <label for="on click url">Finish Part Weight </label>
                     <input type="text" step="any" name="finish_part_weight" 
                        class="form-control onlyNumericInput">
                  </div>
               </div>
               <div class="col-lg-6">
                  <div class="form-group">
                     <label for="on click url">Runner Weight</label>
                     <input type="text" step="any" name="runner_weight" 
                        class="form-control onlyNumericInput">
                  </div>
               </div>
               <div class="col-lg-6">
                  <div class="form-group">
                     <label for="on click url">Wastage / Gattha / Lumps (Kg)</label>
                     <input type="text" step="any" name="wastage" 
                        class="form-control onlyNumericInput">
                  </div>
               </div>
               <div class="col-lg-6">
                  <div class="form-group">
                     <label for="on click url">Cycle Time Per Shot (sec) </label>
                     <input type="text" step="any" name="cycle_time" 
                        class="form-control onlyNumericInput">
                  </div>
               </div>
               <div class="col-lg-6">
                  <div class="form-group">
                     <label for="on click url">Operator</label>
                     <select  name="operator_id" id="" class="form-control select2" style="width: 100%;">
                        <option value="">Select</option>
                        <%if ($operator) %>
                        <%foreach from=$operator item=s %>
                        <option value="<%$s->id %>"><%$s->name %></option>
                        <%/foreach%>
                        <%/if%>
                     </select>
                  </div>
               </div>
               <div class="col-lg-6">
               <div class="form-group">
                  <label for="on click url">Remark</label>
                  <input type="text" name="remark" class="form-control">
               </div>
               </div>
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
      <div class="w-100">
        <input type="text" name="reason" placeholder="Filter Search" class="form-control serarch-filter-input m-3 me-0" id="serarch-filter-input" fdprocessedid="bxkoib">
      </div>
      <div class="card p-0 mt-4 w-100">
         <div class="table-responsive text-nowrap">
            <table width="100%" border="1" cellspacing="0" cellpadding="0" class="table table-striped" style="border-collapse: collapse;" border-color="#e1e1e1" id="p_q_molding_production">
            <thead>
               <tr>
                  <th>Job Order No</th>
                  <th>Part Number / Descriptions </th>
                  <th>Mold Name</th>
                  <th>Date</th>
                  <th>Shift</th>
                  <th>Machine</th>
                  <th>Operator</th>
                  <th>Production OK Qty</th>
                  <th>Production Rejection Qty</th>
                  <th>Accepted Qty by Quality</th>
                  <th>Rejected Qty by Quality</th>
                  <th>Onhold Qty</th>
                  <th style="word-wrap: break-word;">Wastage / Gattha / Lumps (Kg)</th>
                  <th>Status</th>
                  <th>Production Minutes</th>
                  <th>Downtime In Min</th>
                  <!-- <th>Downtime Reason</th> -->
                  <th>Setup Time In Min</th>
                  <th>Cycle Time In Sec</th>
                  <th>Finish Part Weight (gram)</th>
                  <th>Runner Weight (gram)</th>
                  <th>Shift Target Qty</th>
                  <!-- <th>Remark</th> -->
                  <!-- <th>Accept Reject</th> -->
                  <th>Rejection Details</th>
                  <th>Downtime Details</th>
                  <th>Actions</th>
               </tr>
            </thead>
            <tbody> 
               <%if ($molding_production) %>
               <%assign var='i' value=1 %>
               <%foreach from=$molding_production item=u %>
               <tr>
                  <td>JO-<%$u->id %></td>
                  <td><%$u->part_number %> /
                     <%$u->part_description %>
                  </td>
                  <td><%$u->mold_name %></td>
                  <td><%$u->date %></td>
                  <td><%$u->shift_type %>/<%$u->name %>
                  </td>
                  <td><%$u->machine_name %></td>
                  <td><%$u->operator_name %></td>
                  <td><%$u->qty %></td>
                  <td><%$u->rejection_qty %></td>
                  <td><%$u->accepted_qty %></td>
                  <td><%$u->rejected_qty %></td>
                  <td>
                     <%if (!empty($u->onhold_qty)) %>
                        <%if checkGroupAccess("p_q_molding_production","update","No")%>
                           <button type="button" class="btn btn-warning float-left "
                              data-bs-toggle="modal" data-bs-target="#onhold<%$i %>">
                           <%$u->onhold_qty %> </button>
                        <%else%>
                           <%$u->onhold_qty %>
                        <%/if%>
                     <%else  %>
                     0
                     <%/if%>
                     <div class="modal fade" id="onhold<%$i %>" tabindex="-1"
                        role="dialog" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
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
                                    action="<%base_url('update_p_q_onhold_molding') %>"
                                    method="POST" enctype='multipart/form-data' s>
                                    <div class="row">
                                       <div class="col-lg-12">
                                          <div class="form-group">
                                             <label for="">Qty</label>
                                             <input type="text"
                                                value="<%$u->onhold_qty %>"
                                                readonly class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-lg-12">
                                          <div class="form-group">
                                             <label for="">Accept Qty <span
                                                class="text-danger">*</span>
                                             </label>
                                             <input type="number" step="any" value=""
                                                max="<%$u->onhold_qty %>"
                                                min="0" class="form-control"
                                                name="accepted_qty"
                                                placeholder="Enter Accepted Quantity"
                                                required>
                                          </div>
                                       </div>
                                       <div class="col-lg-12">
                                          <div class="form-group">
                                             <label for="">Rejection
                                             Reason</label>
                                             <select name="rejection_reason" id=""
                                                class="form-control select2">
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
                                                class="form-control"
                                                name="rejection_remark">
                                             <input type="hidden"
                                                readonly class="form-control"
                                                name="id"
                                                value="<%$u->id %>">
                                             <input type="hidden"
                                                readonly class="form-control"
                                                name="rejection_qty"
                                                value="<%$u->rejection_qty %>">
                                             <input type="hidden"
                                                readonly class="form-control"
                                                name="qty"
                                                value="<%$u->onhold_qty %>">
                                             <input type="hidden"
                                                readonly class="form-control"
                                                name="output_part_id"
                                                value="<%$u->output_part_id %>">
                                             <input type="hidden"
                                                readonly class="form-control"
                                                name="accepted_qty_old"
                                                value="<%$u->accepted_qty %>">
                                             <input type="hidden"
                                                readonly class="form-control"
                                                name="rejected_qty_old"
                                                value="<%$u->rejected_qty %>">
                                             <input type="text"
                                                readonly class="form-control"
                                                name="customer_part_id"
                                                value="<%$u->customer_part_id %>">
                                          </div>
                                       </div>
                                    </div>
                                    <div class="modal-footer">
                                       <button type="button" class="btn btn-secondary"
                                          data-bs-dismiss="modal">Close</button>
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
                  <td><%$u->wastage %></td>
                  <td><%$u->status %></td>
                  <td><%$u->production_hours %></td>
                  <td><%$u->downtime_in_min %></td>
                  <td><%$u->setup_time_in_min %></td>
                  <td><%$u->cycle_time %></td>
                  <td><%$u->finish_part_weight %></td>
                  <td><%$u->runner_weight %></td>
                  <td><%$u->production_target_per_shift %></td>
                  <td class="text-center">
                     <%if checkGroupAccess("p_q_molding_production","update","No")%>
                        <a  href="<%base_url('view_rejection_details/') %><%$u->id %>/<%$u->customer_part_id %>/add">
                        <i class="ti ti-edit"></i>
                        </a>
                     <%else%>
                        <%display_no_character()%>
                     <%/if%>
                  </td>
                  <td class="text-center">
                     <%if checkGroupAccess("p_q_molding_production","update","No")%>
                        <a  href="<%base_url('view_downtime_details/') %><%$u->id %>/<%$u->customer_part_id %>/add">
                        <i class="ti ti-edit"></i>
                        </a>
                     <%else%>
                        <%display_no_character()%>
                     <%/if%>
                  </td>
                  <td>
                     <%if ($u->status == "pending") %>
                        <%if checkGroupAccess("p_q_molding_production","update","No")%>
                           <button type="button" class="btn btn-danger float-left "
                              data-bs-toggle="modal" data-bs-target="#acceptReject<%$i %>">
                           Accept/Reject </button>
                        <%else%>
                           <%display_no_character()%>
                        <%/if%>
                     <%else %>
                     Completed
                     <%/if%>
                     <div class="modal fade" id="acceptReject<%$i %>" tabindex="-1"
                        role="dialog" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title" id="exampleModalLabel">Add </h5>
                                 <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close">
                                 </button>
                              </div>
                              <div class="modal-body">
                                 <form
                                    action="javascript:void(0);"
                                    method="POST" enctype='multipart/form-data' class="update_p_q_molding_production update_p_q_molding_production_<%$u->id %> custom-form" data-id="<%$u->id %>">
                                    <div class="row">
                                       <div class="col-lg-6">
                                          <div class="form-group">
                                             <label for="">Date</label>
                                             <input type="text"
                                                value="<%$u->date %>"
                                                readonly class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-lg-6">
                                          <div class="form-group">
                                             <label for="">Shift</label>
                                             <br>
                                             <span><%$u->shift_type %>/<%$u->name %></span>
                                          </div>
                                       </div>
                                       <div class="col-lg-6">
                                          <div class="form-group">
                                             <label for="">Qty</label>
                                             <input type="text"
                                                value="<%$u->qty %>"
                                                readonly class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-lg-6">
                                          <div class="form-group">
                                             <label for="on click url">Enter Final
                                             Inspection Qty<span
                                                class="text-danger">*</span></label>
                                             <input type="text"  value="0"
                                                max="" name="final_inspection_location"
                                                 class="form-control required-input onlyNumericInput">
                                          </div>
                                       </div>
                                       <div class="col-lg-6">
                                          <div class="form-group">
                                             <label for="">Reject Remark</label>
                                             <input type="text"
                                                class="form-control"
                                                name="rejection_remark">
                                             <input type="hidden"
                                                readonly class="form-control"
                                                name="id"
                                                value="<%$u->id %>">
                                             <input type="hidden"
                                                readonly class="form-control"
                                                name="qty"
                                                value="<%$u->qty %>">
                                             <input type="hidden"
                                                readonly class="form-control"
                                                name="customer_part_id"
                                                value="<%$u->customer_part_id %>">
                                             <input type="hidden"
                                                readonly class="form-control"
                                                name="accepted_qty_old"
                                                value="<%$u->accepted_qty %>">
                                             <input type="hidden"
                                                readonly class="form-control"
                                                name="rejected_qty_old"
                                                value="<%$u->rejected_qty %>">
                                          </div>
                                       </div>
                                    </div>
                                    <div class="modal-footer">
                                       <button type="button" class="btn btn-secondary"
                                          data-bs-dismiss="modal">Close</button>
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
                  <!-- <td></td> -->
               </tr>
               <%assign var='i' value=$i+1 %>
               <%/foreach%>
               <%/if%>
            </tbody>
         </div>
      </div>
      <!--/ Responsive Table -->
   </div>
   <!-- /.col -->
   <div class="content-backdrop fade"></div>
</div>
<script type="text/javascript">
    var base_url = <%$base_url|@json_encode%>;
    var start_date = <%$start_date|@json_encode%>;
    var end_date = <%$end_date|@json_encode%>;
  </script>
<script src="<%$base_url%>public/js/production/p_q_molding_production.js"></script>