<div class="wrapper container-xxl flex-grow-1 container-p-y">
<div class="content-wrapper">
   
   <div class="sub-header-left pull-left breadcrumb">
        <h1>
          Production
          <a hijacked="yes" href="javascript:void(0)" class="backlisting-link" title="Back to Issue Request Listing">
            <i class="ti ti-chevrons-right"></i>
            <em>Sharing Production Qty</em></a>
        </h1>
        <br>
        <span>Sharing Production Qty
</span>
      </div>
      <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5">
        <%if checkGroupAccess("sharing_p_q","add","No")%>
          <button type="button" class="btn btn-seconday" data-bs-toggle="modal"
                        data-bs-target="#addPromo">Add Sharing Production Qty
          </button>
        <%/if%>
        <%if checkGroupAccess("sharing_p_q","export","No")%>
          <button class="btn btn-seconday" type="button" id="downloadCSVBtn" title="Download CSV"><i class="ti ti-file-type-csv"></i></button>
          <button class="btn btn-seconday" type="button" id="downloadPDFBtn" title="Download PDF"><i class="ti ti-file-type-pdf"></i></button>
        <%/if%>
      
    </div>
   <section class="content">
      <div>
         <div class="row">
            <br>
            <div class="col-lg-12">
               <div class="modal fade" id="addPromo" tabindex="-1" role="dialog"
                  aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog  modal-dialog-centered" role="document">
                     <div class="modal-content">
                        <div class="modal-header">
                           <h5 class="modal-title" id="exampleModalLabel">Add</h5>
                           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                          
                           </button>
                        </div>
                        <form action="<%base_url('add_production_qty_sharing') %>"
                                 method="POST" enctype="multipart/form-data" id="add_production_qty_sharing" class="custom-form">
                        <div class="modal-body">
                           <div class="form-group">
                              
                           </div>
                           <div class="form-group">
                           <label for="on click url">Shift Type / Name / Start Time / End Time<span class="text-danger">*</span></label>
                           <select  name="shift_id" id="shift" class="form-control select2 required-input" style="width:100%;">
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
                           <div class="form-group">
                           <label for="on click url">Operator <span class="text-danger">*</span></label>
                           <select name="operator_id" id="operator" class="form-control select2 required-input" style="width:100%;" >
                           <option value="">Select</option>
                           <%if ($operator) %>
                                <%foreach from=$operator item=s %>
	                           		<option value="<%$s->id %>"><%$s->name %></option>
	                           	<%/foreach%>
                            <%/if%>
                           </select>
                           </div>
                           <div class="form-group">
                           <label for="on click url">Machine<span
                              class="text-danger">*</span></label>
                           <select  name="machine_id" id="machine" class="form-control select2 required-input" style="width:100%;">
                           <option value="">Select</option>
                           <%if ($machine) %>
                                <%foreach from=$machine item=s %>
		                           <option value="<%$s->id %>"><%$s->name %></option>
		                        <%/foreach%>
                            <%/if%>
                           </select>
                           </div>
                           <div class="form-group">
                           <label for="on click url">Enter Date<span
                              class="text-danger">*</span></label>
                           <input max="<%date('Y-m-d') %>" type="date"
                              value="<%date('Y-m-d') %>" name="date" required
                              class="form-control">
                           </div>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                           data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                        </form>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="card">
                  
                  <div class="">
                     <table id="sharing_p_q" class="table  table-striped">
                        <thead>
                           <tr>
                              <th style="display: none;">id</th>
                              <th width="21%">Date</th>
                              <th width="21%">Shift</th>
                              <th width="21%">Machine</th>
                              <th width="21%">Operator</th>
                              <th width="16%">View Details</th>
                           </tr>
                        </thead>
                        <tbody>

                           <%if ($sharing_p_q) %>
                                <%assign var='i' value=1 %>
                                <%foreach from=$sharing_p_q item=u %>
			                           <tr>
			                              <td  style="display: none;"><%$u->id %></td>
			                              <td><%defaultDateFormat($u->date) %></td>
			                              <td><%$u->shift_type %></td>
			                              <td><%$u->machine_name %></td>
			                              <td><%$u->op_name %></td>
			                              <td>
                                      <%if checkGroupAccess("sharing_p_q","update","No")%>
			                                 <a class="btn btn-info"
			                                    href="<%base_url('details_production_qty_sharing/') %><%$u->id %>">
			                                 Add Output Parts</a>
                                      <%else%>
                                        <%display_no_character("")%>
                                      <%/if%>
			                              </td>
			                           </tr>
	                            <%assign var='i' value=$i+1 %>
	                            <%/foreach%>
                           <%/if%>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
</div>

<script src="<%$base_url%>public/js/production/sharing_p_q.js"></script>
