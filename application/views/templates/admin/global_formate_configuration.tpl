<div class="wrapper">
<div class="container-xxl flex-grow-1 container-p-y" >
   <nav aria-label="breadcrumb">
      <div class="sub-header-left pull-left breadcrumb">
        <h1>
          Admin
          <a hijacked="yes" href="javascript:void(0)" class="backlisting-link" title="">
            <i class="ti ti-chevrons-right"></i>
            <em>Configurations</em></a>
          </h1>
          <br>
          <span>Global Configurations</span>
        </div>
      </nav>
      <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5">
         <%if (checkGroupAccess("global_formate_config","add","No")) %>
       <button type="button" class="btn btn-seconday" data-bs-toggle="modal" data-bs-target="#addConfig">
                     Add New Config
                     </button>
         <%/if%>
      </div>
   <!-- Main content -->
   <section class="content">
      <div>
         <!-- Small boxes (Stat box) -->
         <div class="row">
            <br>
            <div class="col-lg">
               <div class="modal fade" id="addConfig" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                     <div class="modal-content">
                        <div class="modal-header">
                           <h5 class="modal-title" id="exampleModalLabel">Add Configuation</h5>
                           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                           
                           </button>
                        </div>
                        <div class="modal-body">
                                             <form action="<%base_url('add_formate_config') %>" method="POST" enctype="multipart/form-data" class="add_formate_config custom-form" id="add_formate_config">
                                                <input type="hidden" name="configID" value="<%$config->id %>" class="form-control">
                                                <div class="row">
                                                   <div class="col-lg-6">
                                                      <div class="form-group">
                                                         <label for="on click url">Dispaly Name<span class="text-danger">*</span></label> <br>
                                                         <input  type="text" name="display_label"  placeholder="Display Name" class="form-control required-input" value="">
                                                      </div>
                                                   </div>
                                                   <div class="col-lg-6">
                                                      <div class="form-group">
                                                         <label for="on click url">Config Name<span class="text-danger">*</span></label> <br>
                                                         <input  type="text"  name="config_name"  placeholder="Config Name" class="form-control required-input" value="">
                                                        
                                                      </div>
                                                   </div>
                                                   <div class="col-lg-6">
                                                      <div class="form-group">
                                                         <label for="on click url">Is Year Enable<span class="text-danger">*</span></label> <br>
                                                         <select name="is_year_enable" class="form-control select2 required-input" >
	                                                        <option value="">Select</option>
	                                                         <option value="Yes">Yes</option>
	                                                         <option value="No" >No</option>
	                                                    </select>
                                                      </div>
                                                   </div>
                                                   <div class="col-lg-6">
                                                       <div class="form-group">
                                                         <label for="on click url">Count Start From<span class="text-danger">*</span></label> <br>
                                                         <input  type="text" name="count_start_from"  placeholder="Count Strat From" class="form-control required-input" value="">
                                                      </div>
                                                   </div>
                                                   <div class="col-lg-6">
                                                      <div class="form-group">
                                                         <label for="on click url">Prefix<span class="text-danger">*</span></label> <br>
                                                         <input  type="text" name="formate" maxlength="10" placeholder="Format" class="form-control required-input" value="">
                                                      </div>
                                                   </div>
                                                   <div class="col-lg-6">
                                                      
                                                      <div class="form-group">
                                                         <label for="on click url">Status<span class="text-danger">*</span></label> <br>
                                                         <select name="status" class="form-control select2 required-input" >
	                                                        <option value="">Select</option>
	                                                         <option value="Active" >Active</option>
	                                                         <option value="Inactive" >Inactive</option>
	                                                    </select>
                                                      </div>
                                                   </div>
                                                   <div class="col-lg-6">
                                                      <div class="form-group">
                                                         <label for="on click url">Format Structure<span class="text-danger">*</span></label> <br>
                                                         <input  type="text" name="formate_structure"  placeholder="Format Structure" class="form-control required-input" value="">
                                                      </div>
                                                   </div>
                                                   <div class="col-lg-12">
                                                      <div class="form-group">
                                                         <label for="on click url">Note*<span class="text-danger">*</span></label> <br>
                                                         <span>
                                                            <b>FY</b> : Finatial Year<br>
                                                            <b>PREFIX</b> : Format <br>
                                                            <b>NUM</b> : number count <br>
                                                            <b>Format Structure Example</b> : {FY}/{PREFIX}/{NUM}
                                                         </span>
                                                      </div>
                                                   </div>
                                                   <div class="col-lg-6">
                                                      <div class="form-group " style="display: none;">
							                           <input type="checkbox" name="forAromOnly" checked>
							                           <label for="original">For AROM ONLY ?</label><br>
							                           </div>
							                           <div class="form-group" style="display: none;">    
							                           <input type="checkbox" name="canCustomerModify" checked>
							                           <label for="original">Can User Modify ?</label><br>
							                           </div>
                                                      
                                                </div>
                                                <div class="modal-footer">
                                                   <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                   <button type="submit" class="btn btn-primary">Save</button>
                                                </div>
                                             </form>
                                          </div>
                                      </form>
                                  </div>
                     </div>
                  </div>
               </div>
               <div class="w-100">
        <input type="text" name="reason" placeholder="Filter Search" class="form-control serarch-filter-input m-3 me-0" id="serarch-filter-input" fdprocessedid="bxkoib">
      </div>
               <div class="card mt-4 w-100">
                  
                  <!-- /.card-header -->
                  <div class="">
                     <table id="globalFormat" class="table  table-striped">
                        <thead>
                           <tr>
                              <th>Dispaly Name</th>
                              <%if ($isAromAdmin=='true') %>
                              <th>AROM Config Name</th>
                              <%/if%>
                              <th>Is Year Enable</th>
                              <th>Count Start From</th>
                              <th>Prefix</th>
                              <th>Format Structure</th>
                              <th>Updated Date</th>
                              <th>Updated User</th>
                              <%if ($isAromAdmin=='true') %>
                              <th>Status</th>
                              <%/if%>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                            <%assign var ='i' value=0%>
                            <%foreach from=$configurations item=config%>
                           <tr>
                              <td><%$config->display_label %></td>
                              <%if ($isAromAdmin=='true') %>
                              <td><%$config->config_name %></td>
                              <%/if%>
                              <td><%$config->is_year_enable %></td>
                              <td><%$config->count_start_from %></td>
                              <td><%$config->formate %></td>
                              <td><%$config->formate_structure %></td>
                              <td><%$config->updated_date %></td>
                              <td><%$config->updated_by %></td>
                              <%if ($isAromAdmin=='true') %>
                              <td><%$config->status %></td>
                               <%/if%>
                              <td>

                              	<%if ($config->acces_to_modify && checkGroupAccess("global_formate_config","update","No")) %>
                                 <a type="button" class=" " title="Update" data-bs-toggle="modal" data-bs-target="#exampleModa<%$i%>l">
                                 <i class="ti ti-edit"></i>
                                 </a>
                                 <%else%>
                                    <%display_no_character("")%>
                                 <%/if%>
                                 <div class="modal fade" id="exampleModa<%$i%>l" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                       <div class="modal-content">
                                          <div class="modal-header">
                                             <h5 class="modal-title" id="exampleModalLabel">Update Details</h5>
                                             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                             </button>
                                          </div>
                                          <div class="modal-body">
                                             <form action="<%base_url('edit_formate_config') %>" method="POST" enctype="multipart/form-data" class="edit_formate_config<%$i%> edit_formate_config custom-form" id="edit_formate_config<%$i%>">
                                                <input type="hidden" name="configID" value="<%$config->id %>" class="form-control">
                                                <div class="row">
                                                   <div class="col-lg-6">
                                                      <div class="form-group">
                                                         <label for="on click url">Dispaly Name<span class="text-danger">*</span></label> <br>
                                                         <input  type="text" name="display_label" placeholder="Display Name" class="form-control required-input" value="<%$config->display_label %>">
                                                      </div>
                                                   </div>
                                                   <div class="col-lg-6">
                                                      <div class="form-group">
                                                         <label for="on click url">Config Name<span class="text-danger">*</span></label> <br>
                                                         <input  type="text" disabled name="config_name"  placeholder="Config Name" class="form-control required-input" value="<%$config->config_name %>">
                                                         <input type="hidden" name="config_name" value="<%$config->config_name %>" class="form-control">
                                                         
                                                      </div>
                                                   </div>
                                                   <div class="col-lg-6">
                                                      <div class="form-group">
                                                         <label for="on click url">Is Year Enable<span class="text-danger">*</span></label> <br>
                                                         <select name="is_year_enable" class="form-control select2 required-input" >
	                                                        <option value="">Select</option>
	                                                         <option value="Yes" <%if ($config->is_year_enable == "Yes")%>selected<%/if%>>Yes</option>
	                                                         <option value="No" <%if ($config->is_year_enable == "No")%>selected<%/if%>>No</option>
	                                                    </select>
                                                      </div>
                                                   </div>
                                                   <div class="col-lg-6">
                                                       <div class="form-group">
                                                         <label for="on click url">Count Start From<span class="text-danger">*</span></label> <br>
                                                         <input  type="text" name="count_start_from"  placeholder="Count Strat From" class="form-control required-input" value="<%$config->count_start_from %>">
                                                      </div>
                                                   </div>
                                                   <div class="col-lg-6">
                                                      <div class="form-group">
                                                         <label for="on click url">Prefix<span class="text-danger">*</span></label> <br>
                                                         <input  type="text" name="formate"  placeholder="Format" class="form-control required-input" value="<%$config->formate %>">
                                                      </div>
                                                   </div>
                                                    <div class="col-lg-6">
                                                      
                                                      <div class="form-group">
                                                         <label for="on click url">Status<span class="text-danger">*</span></label> <br>
                                                         <select name="status" class="form-control select2 required-input" >
                                                           <option value="">Select</option>
                                                            <option value="Active" <%if ($config->status == "Active")%>selected<%/if%>>Active</option>
                                                            <option value="Inactive" <%if ($config->status == "Inactive")%>selected<%/if%>>Inactive</option>
                                                       </select>
                                                      </div>
                                                   </div>
                                                   <div class="col-lg-6">
                                                      <div class="form-group">
                                                         <label for="on click url">Format Structure<span class="text-danger">*</span></label> <br>
                                                         <input  type="text" name="formate_structure"  placeholder="Format Structure" class="form-control required-input" value="<%$config->formate_structure %>">
                                                      </div>
                                                   </div>
                                                  
                                                   <div class="col-lg-12">
                                                      <div class="form-group">
                                                         <label for="on click url">Note*<span class="text-danger">*</span></label> <br>
                                                         <span>
                                                            <b>FY</b> : Finatial Year<br>
                                                            <b>PREFIX</b> : Format <br>
                                                            <b>NUM</b> : number count <br>
                                                            <b>Format Structure Example</b> : {FY}/{PREFIX}/{NUM}
                                                         </span>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="modal-footer">
                                                   <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                   <button type="submit" class="btn btn-primary">Save</button>
                                                </div>
                                             </form>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                             </td>
                              
                           </tr>
                           <%assign var ='i' value=$i+1%>
                            <%/foreach%>
                              
                        </tbody>
                     </table>
                  </div>
                  <!-- /.card-body -->
               </div>
               <!-- ./col -->
            </div>
         </div>
         <!-- /.row -->
         <!-- Main row -->
         <!-- /.row (main row) -->
      </div>
      <!-- /.container-fluid -->
   </section>
   <!-- /.content -->
</div>
<script type="text/javascript">
   var base_url = <%base_url()|@json_encode%>;
</script>

<script src="<%$base_url%>public/js/admin/global_format.js"></script>