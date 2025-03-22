<div class="wrapper container-xxl flex-grow-1 container-p-y ">
   <!-- Navbar -->
   <!-- /.navbar -->
   <!-- Main Sidebar Container -->
   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="sub-header-left pull-left breadcrumb">
                <h1>
                    Planning &amp; Sales 
                    <a hijacked="yes" href="javascript:void(0)" class="backlisting-link" title="Back to Issue Request Listing">
                        <i class="ti ti-chevrons-right"></i>
                        <em>Customer Part</em></a>
                </h1>
                <br>
                <span>Customer Part Operation Details </span>
            </div>
            <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5 listing-btn">
            <button type="button" class="btn btn-seconday " data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Add </button>
            <a title="Back To Customer Part Operation" class="btn btn-seconday" href="<%base_url('customer_part_main/')%><%$customer_id %>" type="button"><i class="ti ti-arrow-left"></i></a>
        </div>
      <!-- Main content -->
      <section class="content">
         <div class="">
            <div class="row">
               <div class="col-12">
                  <!-- /.card -->

                  <div class="card">
                  	<div class="card-header">
					      <div class="row">
					         <div class="tgdp-rgt-tp-sect">
					            <p class="tgdp-rgt-tp-ttl">Part Name</p>
					            <p class="tgdp-rgt-tp-txt">
					               <%$customer[0]->part_number %>
					            </p>
					         </div>
					         <div class="tgdp-rgt-tp-sect">
					            <p class="tgdp-rgt-tp-ttl">Part Description</p>
					            <p class="tgdp-rgt-tp-txt">
					               <%$customer[0]->part_description %>
					            </p>
					         </div>
					         <div class="col-lg-1">
					            <br>
					         </div>
					         <!-- Button trigger modal -->
					      </div>
					      <!-- Modal -->
					   </div>
                     
                        <!-- Button trigger modal -->
                        
                     </div>
                     <!-- Modal -->
                     <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title" id="exampleModalLabel">Add </h5>
                                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                 </button>
                              </div>
                              <div class="modal-body">
                                 <form action="<%base_url('add_customer_operation') %>" method="POST" enctype='multipart/form-data' id="add_customer_operation" class="add_customer_operation custom-form">
                                    <div class="row">
                                       <div class="col-lg-6">
                                          <div class="form-group">
                                             <label for="operation_number">Part Number</label><span class="text-danger">*</span>
                                             <input type="text" name="" readonly value="<%$customer[0]->part_number %>" class="form-control required-input"  id="exampleInputPassword1" placeholder="Operation Number">
                                          </div>
                                        </div>
                                        <div class="col-lg-6">
                                          <div class="form-group">
                                             <label for="po_num">Select Operations </label><span class="text-danger">*</span>
                                             <select name="operation_id" id="" class="form-control required-input">
                                                <%if ($operations) %>
                                                    <%foreach from=$operations item=o %>
                                                <option value="<%$o->id %>"><%$o->name %></option>
                                                <%/foreach%>
                                                   <%/if%>
                                             </select>
                                          </div>
                                         </div>
                                        <div class="col-lg-6">
                                          <div class="form-group">
                                             <label for="po_num">Process / Operation Name </label><span class="text-danger">*</span>
                                             <input type="text" name="name"  class="form-control required-input" id="exampleInputEmail1" placeholder="Enter name" aria-describedby="emailHelp">
                                          </div>
                                         </div>
                                        <div class="col-lg-6">
                                          <div class="form-group">
                                             <label for="po_num">M/C Device Jigs, Tools for Mfg </label><span class="text-danger">*</span>
                                             <input type="text" name="mfg"  class="form-control required-input" id="exampleInputEmail1" aria-describedby="emailHelp">
                                          </div>
                                        </div>
                                        <div class="col-lg-6">
                                          <div class="form-group">
                                             <label for="po_num">Revision Number </label><span class="text-danger">*</span>
                                             <input type="text" name="revision_no"  class="form-control onlyNumericInput required-input" id="exampleInputEmail1" placeholder="Enter " aria-describedby="emailHelp">
                                          </div>
                                        </div>
                                        <div class="col-lg-6">
                                          <div class="form-group">
                                             <label for="po_num">Revision Date</label><span class="text-danger">*</span>
                                             <input type="date" name="revision_date"  class="form-control required-input" id="exampleInputEmail1" placeholder="Enter " aria-describedby="emailHelp">
                                          </div>
                                        </div>
                                        <div class="col-lg-6">
                                          <div class="form-group">
                                             <label for="po_num">Revision Remark</label><span class="text-danger">*</span>
                                             <input type="text" name="revision_remark"  class="form-control required-input" id="exampleInputEmail1" placeholder="Enter " aria-describedby="emailHelp">
                                             <input hidden type="text" name="customer_master_id" value="<%$part_id %>" required class="form-control" id="exampleInputEmail1" placeholder="Enter " aria-describedby="emailHelp">
                                          </div>
                                       </div>
                                       <div class="col-lg-12">
                                       </div>
                                    </div>
                              </div>
                              <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-primary">Save changes</button>
                              </div>
                              </form>
                           </div>
                        </div>
                     </div>
                    <div class="card p-0 mt-4">
                     <!-- /.card-header -->
                     <div class="">
                        <table id="customer_part_operation_view" class="table w-100 table-striped">
                           <thead>
                              <tr>
                                 <!--<th>Sr. No.</th> -->
                                 <th>Add Revision</th>
                                 <th>Revision Number</th>
                                 <th>Revision Date</th>
                                 <th>Revision Remark</th>
                                 <th>Customer Name</th>
                                 <th>Part Number</th>
                                 <th>Part Description</th>
                                 <th>Opration Number </th>
                                 <th>Opration Name </th>
                                 <th>M/C Device Jigs, Tools for Mfg </th>
                                 <!--<th>Add Details</th>-->
                              </tr>
                           </thead>
                           <tbody>
                              <%assign var=i value=1%>
                                <%if ($customer_part_rate) %>
                                    <%foreach from=$customer_part_rate item=poo %>
                                        <%if ($poo->customer_id == $customer_id) %>
                                            <%if ($part_id == $poo->customer_master_id) %>
                              <tr>
                                 <!--<td><%$i %></td>-->
                                 <td>
                                    <a type="submit" data-bs-toggle="modal" class="" data-bs-target="#exampleModaledit2<%$i %>" title="Add Revision"><i class="ti ti-square-rounded-plus"></i></a>
                                    <a href="<%base_url('view_part_operation_history/') %><%$poo->customer_master_id %>/<%$poo->operation_id %>" class="" title="history"><i class="ti ti-history"></i></a>
                                    <div class="modal fade" id="exampleModaledit2<%$i %>" tabindex=" -1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                       <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                          <div class="modal-content">
                                             <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Update Oeration</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                </button>
                                             </div>
                                             <form action="<%base_url('add_customer_operation') %>" method="POST" enctype='multipart/form-data' id="add_customer_operation_rev<%$i %>" class="add_customer_operation_rev<%$i %> add_customer_operation_rev custom-form">
                                             <div class="modal-body">
                                                
                                                   <div class="row">
                                                      <div class="col-lg-6">
                                                         <input value="<%$poo->customer_part_id %>" type="hidden" name="id" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Customer Name">
                                                         <div class="form-group">
                                                            <label for="po_num">Part Number </label><span class="text-danger">*</span>
                                                            <input type="text" readonly value="<%$poo->part_number  %>" name="upart_number" required class="form-control" id="exampleInputEmail1" placeholder="Enter Part Number" aria-describedby="emailHelp">
                                                         </div>
                                                         <div class="form-group">
                                                            <label for="po_num">Part Description </label><span class="text-danger">*</span>
                                                            <input type="text" readonly value="<%$poo->part_description  %>" name="upart_desc" required class="form-control" id="exampleInputEmail1" placeholder="Enter Part Description" aria-describedby="emailHelp">
                                                         </div>
                                                         <div class="form-group">
                                                            <label for="po_num">Operation Name </label><span class="text-danger">*</span>
                                                            <input type="text" name="name"  class="form-control required-input" id="exampleInputEmail1" placeholder="Enter name" aria-describedby="emailHelp">
                                                         </div>
                                                         <div class="form-group">
                                                            <label for="po_num">Revision Date </label><span class="text-danger">*</span>
                                                            <input type="date" value="<%$poo->revision_date %>" name="revision_date"  class="form-control required-input" id="exampleInputEmail1" placeholder="Enter Part Rate" aria-describedby="emailHelp">
                                                            <input type="hidden" value="<%$poo->customer_master_id %>" name="customer_master_id" required class="form-control" id="exampleInputEmail1" placeholder="Enter Part Rate" aria-describedby="emailHelp">
                                                            <input type="hidden" value="<%$poo->operation_id %>" name="operation_id" required class="form-control" id="exampleInputEmail1" placeholder="Enter Part Rate" aria-describedby="emailHelp">
                                                         </div>
                                                      </div>
                                                      <div class="col-lg-6">
                                                         <div class="form-group">
                                                            <label for="po_num">Revision Number </label><span class="text-danger">*</span>
                                                            <input type="text" value="<%$poo->revision_no  %>" name="revision_no"  class="form-control required-input onlyNumericInput"  id="exampleInputEmail1" placeholder="Enter Safty/buffer stock" aria-describedby="emailHelp">
                                                            <input type="hidden" value="<%$poo->customer_id  %>" name="customer_id" required class="form-control" id="exampleInputEmail1" placeholder="Enter Safty/buffer stock" aria-describedby="emailHelp">
                                                         </div>
                                                         <div class="form-group">
                                                            <label for="po_num">Revision Remark </label><span class="text-danger">*</span>
                                                            <input type="text" value="" name="revision_remark"  class="form-control required-input" id="exampleInputEmail1" placeholder="Enter Safty/buffer stock" aria-describedby="emailHelp">
                                                         </div>
                                                      </div>
                                                   </div>
                                             </div>
                                             <div class="modal-footer">
                                             <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                             <button type="submit" class="btn btn-primary">Save changes</button>
                                             </div>
                                             </form>
                                          </div>
                                       </div>
                                    </div>
			                     	</div>
			                     </td>
			                     <td><%$poo->revision_no %></td>
			                     <td><%$poo->revision_date %></td>
			                     <td><%$poo->revision_remark %></td>
			                     <td><%$poo->customer_name %></td>
			                     <td><%$poo->part_number %></td>
			                     <td><%$poo->part_description %></td>
			                     <td><%$poo->name %></td>
			                     <td><%$poo->name_val %></td>
			                     <td><%$poo->mfg %></td>
			                     <!--<td>
			                     <a class="btn btn-info" href="<%base_url('add_operation_details/') %><%$poo->id %>/<%$customer_id %>/<%$customer_id %>/<%$part_id %>">Add Details</a>
			                     </td>-->
			                     </tr>
			                   
                       <%assign var=i value=$i+1%>
                        <%/if%>
                        <%/if%>
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
<script src="<%$base_url%>/public/js/planning_and_sales/customer_part_operation_by_id.js"></script>