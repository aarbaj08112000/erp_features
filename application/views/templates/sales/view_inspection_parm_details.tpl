<div  class="wrapper container-xxl flex-grow-1 container-p-y">
<!-- Navbar -->
<!-- /.navbar -->
<!-- Main Sidebar Container -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<nav aria-label="breadcrumb">
<div class="sub-header-left pull-left breadcrumb">
  <h1>
    Planning &amp; Sales
    <a hijacked="yes" href="javascript:void(0)" class="backlisting-link" title="Back to Issue Request Listing">
      <i class="ti ti-chevrons-right"></i>
      <em>Customer Master</em></a>
  </h1>
  <br>
  <span>Drawing Parameters</span>
</div>
</nav>
<div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5">
	
            <button type="button" class="btn btn-seconday " data-bs-toggle="modal" data-bs-target="#exampleModal">
            Add </button>
            <a class="btn btn-seconday" title="Back To Customer Part" href="<%base_url("customer_part/")%><%$customer_id%>"><i class="ti ti-arrow-left"></i></a>
   
</div>

 <div class="card p-0 mt-4">
         <div class="card-header">
            <div class="row">
               <div class="tgdp-rgt-tp-sect">
                  <p class="tgdp-rgt-tp-ttl">Part Number</p>
                  <p class="tgdp-rgt-tp-txt"><%$customer_part[0]->part_number%></p>
               </div>
                <div class="tgdp-rgt-tp-sect">
                  <p class="tgdp-rgt-tp-ttl">Part Description</p>
                  <p class="tgdp-rgt-tp-txt"><%$customer_part[0]->part_description%></p>
               </div>
               
            </div>
         </div>
      </div>
     
  
   <!-- /.container-fluid -->


<!-- Main content -->
<section class="content">
   <div class="">
      <div class="row">
         <div class="col-12">
            <!-- /.card -->
            <div class="card p-0 mt-4">
               <div class="">
                  <!-- Modal -->
                  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                     <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content">
                           <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Add</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cancel">
                              
                              </button>
                           </div>
                           <div class="modal-body">
                              <form action="<%base_url('add_inspection_parm_details') %>" method="POST" id="add_inspection_parm_details" class="add_inspection_parm_details custom-form">
                                 <div class="col-lg-12">
                                    <div class="row">
                                       <div class="col-lg-6">
                                          <div class="form-group">
                                             <label> Parameter </label><span class="text-danger">*</span>
                                             <input type="text"  name="parameter" placeholder="Enter Parameter" class="form-control required-input">
                                          </div>
                                       </div>
                                       <div class="col-lg-6">
                                          <div class="form-group">
                                             <label> Evalution Mesaurement Technique </label><span class="text-danger">*</span>
                                             <input type="text"  name="evalution_mesaurement_technique" placeholder="Enter Specification" class="form-control required-input">
                                             <input type="hidden" value="<%$customer_part_id %>" required name="customer_part_id">
                                          </div>
                                       </div>
                                    </div>
                                    <div class="row">
                                       <div class="col-6">
                                          <div class="form-group">
                                             <label> Specification </label><span class="text-danger">*</span>
                                             <input type="text"  name="specification" placeholder="Enter Specification" class="form-control required-input">
                                          </div>
                                       </div>
                                       <div class="col-lg-6">
                                          <div class="form-group">
                                             <label>Critical</label>
                                             <input type="text" name="critical_parm" placeholder="Enter Upper Spec Limit" class="form-control">
                                          </div>
                                       </div>
                                    </div>
                                    <div class="row">
                                       <div class="col-lg-6">
                                          <div class="form-group">
                                             <label>Lower Spec Limit</label>
                                             <input type="text" name="lower_spec_limit" placeholder="Enter Lower Spec Limit" class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-lg-6">
                                          <div class="form-group">
                                             <label>Upper Spec Limit </label>
                                             <input type="text" name="upper_spec_limit" placeholder="Enter Upper Spec Limit" class="form-control">
                                          </div>
                                       </div>
                                    </div>
                                    <div class="row">
                                    </div>
                                    <div class="row">
                                       <div class="col-2">
                                          <div class="form-group">
                                             <label>PDI &nbsp;</label>
                                             <input type="checkbox" name="is_PDI" id="is_PDI">
                                          </div>
                                       </div>
                                       <!-- <div class="col-2">
                                          <div class="form-group">
                                              <label>Setup &nbsp;</label>
                                              <input type="checkbox" name="is_setup" id="is_setup">
                                          </div>
                                          </div>
                                          <div class="col-2">
                                          <div class="form-group">
                                              <label>Layout &nbsp;</label>
                                              <input type="checkbox" name="is_layout" id="is_layout">
                                          </div>
                                          </div>
                                          <div class="col-6">
                                          <div class="form-group">
                                              <label>In Process Inspection &nbsp;</label>
                                              <input type="checkbox" name="is_inprocess_inspection" id="is_inprocess_inspection">
                                          </div>
                                          </div> -->
                                    </div>
                                    <div class="modal-footer">
                                       <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                       <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                              </form>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="">
                     <table id="example1" class="table  table-striped w-100">
                        <thead>
                           <tr>
                              <!-- <th>Sr. No.</th> -->
                              <th>Parameter</th>
                              <th>Specification</th>
                              <th>Evalution Mesaurement Technique</th>
                              <th>Lower Spec Limit</th>
                              <th>Upper Spec Limit</th>
                              <th>Critical</th>
                              <th>PDI</th>
                              <th>Setup</th>
                              <th>Layout</th>
                              <th>In Process Inspection</th>
                              <th class="text-center">Actions</th>
                           </tr>
                        </thead>
                        <tbody>
                           <%assign var="i" value=1%>
                            <%if ($cust_part_inspection_master) %>
                                <%foreach from=$cust_part_inspection_master item=u %>
		                           <tr>
		                              <!--<td><%$i %></td> -->
		                              <td><%$u->parameter %></td>
		                              <td><%$u->specification %></td>
		                              <td><%$u->evalution_mesaurement_technique %></td>
		                              <td><%$u->lower_spec_limit %></td>
		                              <td><%$u->upper_spec_limit  %></td>
		                              <td><%$u->critical_parm %></td>
		                              <td><%if ($u->is_PDI === "1") %>Yes <%else%>No<%/if%></td>
		                              <td> <%if ($u->is_setup === "1") %>Yes <%else%>No<%/if%></td>
		                              <td><%if ($u->is_layout === "1") %>Yes <%else%>No<%/if%></td>
		                              <td><%if ($u->is_inprocess_inspection === "1") %>Yes <%else%>No<%/if%></td>
		                              <td class="text-center">
		                                
		                                    <a type="button" data-bs-toggle="modal" class="" data-bs-target="#exampleModal2<%$i %>"><i class="ti ti-edit"></i></a>
		                                
		                                 <!-- edit modal -->
		                                 <div class="modal fade" id="exampleModal2<%$i %>" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		                                    <div class="modal-dialog modal-lg modal-dialog-centered" style="text-align: left;" role="document">
		                                       <div class="modal-content">
		                                          <div class="modal-header">
		                                             <h5 class="modal-title" id="exampleModalLabel">Update</h5>
		                                             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
		                                             </button>
		                                          </div>
		                                          <div class="modal-body">
		                                             <form action="<%base_url('update_inspection_parm_details') %>" method="POST" id="update_inspection_parm_details" class="update_inspection_parm_details<%$i %> update_inspection_parm_details custom-form">
		                                                <div class="col-lg-12">
		                                                   <div class="row">
		                                                      <div class="col-lg-6">
		                                                         <div class="form-group">
		                                                            <label> Parameter </label><span class="text-danger">*</span>
		                                                            <input type="text"  name="parameter" value="<%$u->parameter %>" class="form-control required-input">
		                                                            <input type="hidden" value="<%$u->customer_partKy %>" required name="customer_part_id">
		                                                            <input type="hidden" value="<%$u->id %>" required name="id">
		                                                         </div>
		                                                      </div>
		                                                      <div class="col-lg-6">
		                                                         <div class="form-group">
		                                                            <label> Evalution Mesaurement Technique </label><span class="text-danger">*</span>
		                                                            <input type="text" = name="evalution_mesaurement_technique" value="<%$u->evalution_mesaurement_technique %>" class="form-control required-input">
		                                                         </div>
		                                                      </div>
		                                                   </div>
		                                                   <div class="row">
		                                                      <div class="col-6">
		                                                         <div class="form-group">
		                                                            <label> Specification </label><span class="text-danger">*</span>
		                                                            <input type="text"  name="specification" value="<%$u->specification %>" placeholder="Enter Specification" class="form-control required-input">
		                                                         </div>
		                                                      </div>
		                                                      <div class="col-lg-6">
		                                                         <div class="form-group">
		                                                            <label>Critical</label>
		                                                            <input type="text" name="critical_parm" value="<%$u->critical_parm %>" placeholder="Enter Upper Spec Limit" class="form-control">
		                                                         </div>
		                                                      </div>
		                                                   </div>
		                                                   <div class="row">
		                                                      <div class="col-lg-6">
		                                                         <div class="form-group">
		                                                            <label>Lower Spec Limit</label>
		                                                            <input type="text" name="lower_spec_limit" value="<%$u->lower_spec_limit %>" placeholder="Enter Lower Spec Limit" class="form-control">
		                                                         </div>
		                                                      </div>
		                                                      <div class="col-lg-6">
		                                                         <div class="form-group">
		                                                            <label>Upper Spec Limit </label>
		                                                            <input type="text" name="upper_spec_limit" value="<%$u->upper_spec_limit %>" placeholder="Enter Upper Spec Limit" class="form-control">
		                                                         </div>
		                                                      </div>
		                                                   </div>
		                                                   <div class="row">
		                                                   </div>
		                                                   <div class="row">
		                                                      <div class="col-2">
		                                                         <div class="form-group">
		                                                            <label>PDI &nbsp;</label>
		                                                            <input type="checkbox" name="is_PDI" <%if ($u->is_PDI == 1) %>
		                                                               checked
		                                                               <%/if%> id="is_PDI">
		                                                         </div>
		                                                      </div>
		                                                      <div class="col-2">
		                                                         <div class="form-group">
		                                                            <label>Setup &nbsp;</label>
		                                                            <input type="checkbox" name="is_setup" <%if ($u->is_setup == 1) %>
		                                                               checked
		                                                               <%/if%> id="is_setup">
		                                                         </div>
		                                                      </div>
		                                                      <div class="col-2">
		                                                         <div class="form-group">
		                                                            <label>Layout &nbsp;</label>
		                                                            <input type="checkbox" name="is_layout" <%if ($u->is_layout == 1) %>
		                                                               checked
		                                                               <%/if%> id="is_layout1">
		                                                         </div>
		                                                      </div>
		                                                      <div class="col-6">
		                                                         <div class="form-group">
		                                                            <label>In Process Inspection &nbsp;</label>
		                                                            <input type="checkbox" name="is_inprocess_inspection" <%if ($u->is_inprocess_inspection == 1) %>
		                                                               checked
		                                                               <%/if%> id="is_inprocess_inspection">
		                                                         </div>
		                                                      </div>
		                                                   </div>
		                                                   <div class="modal-footer">
		                                                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
		                                                      <button type="submit" class="btn btn-primary">Save Changes</button>
		                                                   </div>
		                                                </div>
		                                             </form>
		                                          </div>
		                                       </div>
		                                    </div>
		                                 </div>
		                              
		                             
		                                 
		                                    <a type="button" data-bs-toggle="modal" class="" data-bs-target="#exampleModal3<%$i %>"><i class="ti ti-trash"></i></a>
		                                 
		                                 <!-- delete Modal -->
		                                 <div class="modal fade" id="exampleModal3<%$i %>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="text-align: left;">
		                                    <div class="modal-dialog modal-dialog-centered" role="document">
		                                       <div class="modal-content">
		                                          <div class="modal-header">
		                                             <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
		                                             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cancel">
		                                             </button>
		                                          </div>
		                                          <form action="<%base_url('delete') %>" method="POST" class="delete_row delete_row<%$i%>" id="delete_row<%$i%>">
		                                             <div class="modal-body">
		                                                <input value="<%$u->id %>" name="id" type="hidden" required class="form-control">
		                                                <input value="cust_part_inspection_master" name="table_name" type="hidden" required class="form-control">
		                                                Are you sure you want to delete
		                                             </div>
		                                             <div class="modal-footer">
		                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
		                                                <button type="submit" class="btn btn-danger">Delete </button>
		                                             </div>
		                                          </form>
		                                       </div>
		                                    </div>
		                                 </div>
		                              </td>
		                           </tr>
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
<script src="<%$base_url%>/public/js/planning_and_sales/view_inspection_parm_details.js"></script>