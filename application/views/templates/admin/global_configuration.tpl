<div class="wrapper container-xxl flex-grow-1 container-p-y">
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
                <select name="config_category" class="form-control select2" id="config_category">
                  <option value="">Select Config Category</option>
                <%foreach from=$config_category item=c %>
                <option
                   value="<%$c%>"><%$c%>
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
    Admin
    <a hijacked="yes" href="#stock/issue_request/index" class="backlisting-link" title="Back to Issue Request Listing" >
      <i class="ti ti-chevrons-right" ></i>
      <em >Global Configurations</em></a>
  </h1>
  <br>
  <span >Configuration</span>
</div>
</nav>
<div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5">
   <%if ($isAromAdmin!='true' && checkGroupAccess("configs","add","No")) %>
                 
                     <button type="button" class="btn btn-seconday" data-bs-toggle="modal" data-bs-target="#addConfig">
                     Add New Config
                     </button>
                 
                  <%/if%>
                  <%if (checkGroupAccess("configs","export","No")) %>
<button class="btn btn-seconday" type="button" id="downloadCSVBtn" title="Download CSV"><i class="ti ti-file-type-csv"></i></button>
<button class="btn btn-seconday" type="button" id="downloadPDFBtn" title="Download PDF"><i class="ti ti-file-type-pdf"></i></button>
<%/if%>
<button class="btn btn-seconday filter-icon" type="button"><i class="ti ti-filter" ></i></i></button>
<button class="btn btn-seconday" type="button"><i class="ti ti-refresh reset-filter"></i></button> 

</div>
<div class="content-wrapper" >

   <!-- Main content -->
   <section class="content">
      <div>
         <!-- Small boxes (Stat box) -->
         <div class="row">
            <br>
            <div class="col-lg">
               <!-- Modal -->
               <div class="modal fade" id="addConfig" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-lg  modal-dialog-centered" role="document">
                     <div class="modal-content">
                        <div class="modal-header">
                           <h5 class="modal-title" id="exampleModalLabel">Add Configuation</h5>
                           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                           </button>
                        </div>
                        <form action="<%base_url('add_new_config') %>" method="POST" id="add_new_config" class="add_new_config custom-form">
                        <div class="modal-body">
                           <div class="row">
                           <div class="form-group col-6">
                           <label for="on click url">Display Name<span class="text-danger">*</span></label> <br>
                           <input  type="text" name="display_label"  data-max="100" placeholder="Display Name" class="form-control required-input" value="">
                           </div>
                           <div class="form-group col-6">
                           <label for="on click url">Config Name<span class="text-danger">*</span></label> <br>
                           <input  type="text" name="config_name"  data-max="100" placeholder="Config Name" class="form-control required-input" value="">
                           </div>
                           <div class="form-group col-6">
                           <label for="on click url">Config Value<span class="text-danger">*</span></label> <br>
                           <input  type="text" name="config_value"  placeholder="Config Value" class="form-control required-input" value="">
                           </div>
                           <div class="form-group col-6">
                           <label for="on click url">Config Category<span class="text-danger">*</span></label> <br>
                           <select name="config_category" class="form-control select2 required-input" >
                                 <option value="">Select Config Category</option>
                               <%foreach from=$config_category item=c %>
                               <option
                                  value="<%$c%>"><%$c%>
                               </option>
                               <%/foreach%>
                            </select>
                           </div>
                           <div class="form-group col-6">
                           <label for="on click url">Note<span class="text-danger">*</span></label> <br>
                           <textarea  type="text" name="note"  data-max="255" placeholder="Note" class="form-control required-input"></textarea>
                           </div>
                           <div class="col-6">
                              <div class="form-group mt-4">
                              <input type="checkbox" name="forAromOnly" checked>
                              <label for="original">For AROM ONLY ?</label><br>
                              </div>
                              <div class="form-group">    
                              <input type="checkbox" name="canCustomerModify">
                              <label for="original">Can User Modify ?</label><br>
                              </div>
                              </div>
                           </div>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="w-100">
            <input type="text" name="reason" placeholder="Filter Search" class="form-control serarch-filter-input m-3 me-0" id="serarch-filter-input" fdprocessedid="bxkoib">
        </div>
               <div class="card w-100">
                  
                  <!-- /.card-header -->
                  <div class="">
                     <table id="example1" class="table table-striped w-100">
                        <thead>
                           <tr>
                              <th>Config Name</th>
                              <%if ($isAromAdmin=='true') %>
                              <th>AROM Config Name</th>
                              <%/if%>
                              <th>Config Value</th>
                              <th>Note/Comment</th>
                              <th>Category</th>
                              <th>Updated time</th>
                              <th>Updated User</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           <%if (true) %>
                                <%assign var='i' value=1 %>
                                <%foreach from=$configurations item=config %>
			                           <tr>
			                              <td><%$config->displayLabel %></td>
			                              <%if ($isAromAdmin=='true') %>
			                              <td><%$config->config_name %></td>
			                              <%/if%>
			                              <td><%$config->config_value %></td>
			                              <td><%$config->note %></td>
                                       <td><%$config->category %></td>
			                              <td><%getDefaultDateTime($config->updatedttm) %></td>
			                              <td><%$config->updated_user %></td>
			                              <td>
			                                 <%if ($config->canModify && checkGroupAccess("configs","update","No")) %>

			                                 <button type="button" class="btn edit-part" title="Update" data-bs-toggle="modal" data-bs-target="#exampleModal<%$i%>" data-value='<%base64_encode(json_encode($config))%>'>
			                                 <i class="ti ti-edit"></i>
			                                 </button>
                                          <div class="modal fade" id="exampleModal<%$i%>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
                                             <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                   <div class="modal-header">
                                                      <h5 class="modal-title" id="exampleModalLabel">Update Details</h5>
                                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                      </button>
                                                   </div>
                                                   <form action="<%base_url('edit_config') %>" method="POST" enctype="multipart/form-data" id="updateConfigForm<%$i%>" class="updateConfigForm<%$i%> updateConfigForm custom-form">
                                                   <div class="modal-body">
                                                         <input type="hidden" name="old_val" value="<%$config->config_value %>">
                                                         <div class="">
                                                            <div class="row">
                                                               <div class="form-group col-lg-6">
                                                                  <label for="on click url">Name<span class="text-danger">*</span></label> <br>
                                                                  <input  type="text" name="display_label" maxlength="100" placeholder="Display Name" class="form-control required-input" value="<%$config->displayLabel %>">
                                                               </div>
                                                               <div class="form-group col-lg-6">
                                                                  <label for="on click url">Config Name<span class="text-danger">*</span></label> <br>
                                                                  <input required type="text" disabled name="config_name" maxlength="100" placeholder="Config Name" class="form-control" value="<%$config->config_name %>">
                                                                  <input type="hidden" name="config_name" value="<%$config->config_name %>" class="form-control">
                                                                  <input type="hidden" name="configID" value="<%$config->id %>" class="form-control">
                                                               </div>
                                                               <div class="form-group col-lg-6">
                                                                  <label for="on click url">Config Value<span class="text-danger">*</span></label> <br>
                                                                  <%if $config->config_name eq 'companyLogo'%>
                                                                  <div class="companyLogo">
                                                                     <input  type="file" name="companyLogo" placeholder="Config Value" class="form-control required-input" value="<%$config->config_value %>">
                                                                  </div>
                                                                  <%else if $config->config_name eq 'SignatureImage'%>
                                                                  <div class="signatureLogo ">
                                                                      <input  type="file" name="SignatureImage" placeholder="Config Value" class="form-control required-input" value="<%$config->config_value%>">
                                                                  </div>
                                                                  <%else if $config->config_name eq 'enableStockUpdate' || $config->config_name eq 'isMultipleClientUnits'%>
                                                                        <div class="form-check form-check-inline mt-2">
                                                                             <input class="form-check-input " type="radio" name="config_value"  value="true" <%if $config->config_value eq 'true'%>checked<%/if%>>
                                                                             <label class="form-check-label" for="inlineRadio1">true</label>
                                                                           </div>
                                                                           <div class="form-check form-check-inline">
                                                                             <input class="form-check-input" type="radio" name="config_value" value="false" <%if $config->config_value eq 'false'%>checked<%/if%>>
                                                                             <label class="form-check-label" for="inlineRadio2">false</label>
                                                                           </div>
                                                                        
                                                                  <%else %>
                                                                     <%if $config->type eq 'input'%>
                                                                        <div class="regularValue">
                                                                           <input  type="text" name="config_value" placeholder="Config Value" class="form-control required-input" value="<%$config->config_value %>">
                                                                        </div>
                                                                     <%else if $config->type eq 'radio'%>
                                                                           <div class="form-check form-check-inline mt-2">
                                                                             <input class="form-check-input " type="radio" name="config_value"  value="Yes" <%if $config->config_value eq 'Yes'%>checked<%/if%>>
                                                                             <label class="form-check-label" for="inlineRadio1">Yes</label>
                                                                           </div>
                                                                           <div class="form-check form-check-inline">
                                                                             <input class="form-check-input" type="radio" name="config_value" value="No" <%if $config->config_value eq 'No'%>checked<%/if%>>
                                                                             <label class="form-check-label" for="inlineRadio2">No</label>
                                                                           </div>
                                                                     <%else%>
                                                                        <div class="">
                                                                           <input  type="file" name="config_value" placeholder="Config Value" class="form-control required-input" value="<%$config->config_value %>">
                                                                        </div>
                                                                     <%/if%>
                                                                     <input  type="hidden" name="config_type"  value="<%$config->type %>">
                                                                  <%/if%>
                                                               </div>
                                                               
                                                                <div class="form-group col-6">
                                                                        <label for="on click url">Config Category<span class="text-danger">*</span></label> <br>
                                                                        <select name="config_category" class="form-control select2 required-input" >
                                                                              <option value="">Select Config Category</option>
                                                                            <%foreach from=$config_category item=c %>
                                                                            <option
                                                                               value="<%$c%>" <%if $c == $config->category%>selected<%/if%>><%$c%> 
                                                                            </option>
                                                                            <%/foreach%>
                                                                         </select>
                                                                        </div>
                                                               <div class="form-group col-lg-6">
                                                                  <label for="on click url">Note<span class="text-danger ">*</span></label> <br>
                                                                  <textarea  name="note" maxlength="255" placeholder="Note" class="form-control required-input"><%$config->note %></textarea>
                                                               </div>
                                                               <div class="col-lg-6 mt-4">
                                                               <%if ($isAromAdmin=='true') %>
                                                               <div class="form-group">
                                                                  <input type="checkbox" name="forAromOnly" <%if ($config->ARMUserOnly == '1') %>checked<%/if%> >
                                                                  <label for="original">For AROM ONLY ?</label><br>
                                                               </div>
                                                               <div class="form-group">    
                                                                  <input type="checkbox" name="canCustomerModify" <%if ($config->canModify == '1') %>checked<%/if%> >
                                                                  <label for="original">Can User Modify ?</label><br>
                                                               </div>
                                                               <%else %>
                                                               <input type="hidden" name="canCustomerModify" value="<%$config->canModify %>" class="form-control">
                                                               <input type="hidden" name="forAromOnly" value="<%$config->ARMUserOnly %>" class="form-control">
                                                            </div>
                                                            <%/if%>
                                                            </div>
                                                         </div>
                                                         <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save</button>
                                                         </div>
                                                         </div>
                                                         </form>
                                                </div>
                                             </div>
                                             </div>
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



<script src="<%$base_url%>public/js/admin/config.js"></script>
