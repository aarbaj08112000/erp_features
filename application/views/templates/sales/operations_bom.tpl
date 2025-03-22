<div class="content-wrapper">
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
	 <nav aria-label="breadcrumb">
      <div class="sub-header-left pull-left breadcrumb">
         <h1>
            
            Planning & Sales
            
            <a hijacked="yes" href="javascript:void(0)" class="backlisting-link" title="Back to Issue Request Listing" >
            <i class="ti ti-chevrons-right" ></i>
            <em >Customer Part Master</em></a>
         </h1>
         <br>
         <span >Customer item part</span>
      </div>
   </nav>
   <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5">
   	  <button type="button" class="btn btn-seconday " data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Add Inhouse Output Part </button>
   	  <button type="button" class="btn btn-seconday " data-bs-toggle="modal" data-bs-target="#exampleModalCustomerPart">
                        Add Customer Output Part </button>
      
      
      <a type="button" class="btn btn-seconday" href="<%base_url('bom/')%><%$customer[0]->customer_id%>" title="Back to customer item part">
      <i class="ti ti-arrow-left"></i>
      </a>
   </div>
   <div class="card p-0 mt-4">
            <div class="card-header">
                <div class="row">
                    <div class="tgdp-rgt-tp-sect">
                        <p class="tgdp-rgt-tp-ttl">Part Number</p>
                        <p class="tgdp-rgt-tp-txt">
                            <%$customer[0]->part_number %>
                        </p>
                    </div>
                    <div class="tgdp-rgt-tp-sect">
                        <p class="tgdp-rgt-tp-ttl">Part Description</p>
                        <p class="tgdp-rgt-tp-txt">
                            <%$customer[0]->part_description%>
                        </p>
                    </div>
                   
                </div>
            </div>
        </div>
<!-- Content Header (Page header) -->

<!-- Main content -->
<section class="mt-4">
   <div class="">
      <div class="">
         <div class="">
            <!-- /.card -->
            <div class="card">
               <div class="">
                  <div class="">
                     <!-- Modal -->
                     <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title" id="exampleModalLabel">Add </h5>
                                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                 </button>
                              </div>
                              <div class="modal-body">
                                 <form action="<%base_url('add_operations_bom') %>" method="POST" class="add_operations_bom custom-form" id="add_operations_bom">
                                    <div class="row">
                                       <div class="col-lg-12">
                                          <div class="form-group">
                                             <label> Item part </label><span class="text-danger">*</span>
                                             <select class="form-control select2 required-input" name="output_part_id" style="width: 100%;">
                                                <%foreach from=$child_part_list item=c1 %>
                                                <option value="<%$c1->id %>">
                                                   <%$c1->part_number%>/<%$c1->part_description%>
                                                </option>
                                                <%/foreach%>
                                             </select>
                                             <input type="hidden" name="customer_id" value="<%$customer[0]->customer_id %>" required class="form-control" id="exampleInputEmail1" placeholder="Enter Quantity" aria-describedby="emailHelp">
                                             <input type="hidden" name="customer_part_number" value="<%$customer[0]->part_number %>" required class="form-control" id="exampleInputEmail1" placeholder="Enter Quantity" aria-describedby="emailHelp">
                                             <input type="hidden" name="output_part_table_name" value="inhouse_parts" required class="form-control" id="exampleInputEmail1" placeholder="Enter Quantity" aria-describedby="emailHelp">
                                          </div>
                                       </div>
                                       <div class="col-lg-12">
                                          <div class="form-group">
                                             <label for="operation_name">Scrap Quantity (kg)
                                             </label><span class="text-danger">*</span>
                                             <input type="text" step="any" data-min="0" value="0" name="scrap_factor" class="form-control required-input onlyNumericInput"   placeholder="Scrap Quantity">
                                          </div>
                                       </div>
                                    </div>
                                    <div class="modal-footer">
                                       <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                       <button type="submit" class="btn btn-primary">Save
                                       changes</button>
                                    </div>
                                 </form>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="modal fade" id="exampleModalCustomerPart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title" id="exampleModalLabel">Add Customer part</h5>
                                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                 </button>
                              </div>
                              <div class="modal-body">
                                 <form action="<%base_url('add_operations_bom') %>" method="POST" id="add_customer_bom" class="add_customer_bom custom-form">
                                    <div class="row">
                                       <div class="col-lg-12">
                                          <div class="form-group">
                                             <label> Select Customer Part </label><span class="text-danger">*</span>
                                             <select class="form-control select2 required-input" name="output_part_id" style="width: 100%;">
                                                <%foreach from=$customer_part_list item=c1 %>
                                                <option value="<%$c1->id%>">
                                                   <%$c1->part_number%>/<%$c1->part_description%>
                                                </option>
                                                <%/foreach%>
                                             </select>
                                             <input type="hidden" name="customer_id" value="<%$customer[0]->customer_id %>" required class="form-control" id="exampleInputEmail1" placeholder="Enter Quantity" aria-describedby="emailHelp">
                                             <input type="hidden" name="customer_part_number" value="<%$customer[0]->part_number %>" required class="form-control" id="exampleInputEmail1" placeholder="Enter Quantity" aria-describedby="emailHelp">
                                             <input type="hidden" name="output_part_table_name" value="customer_part" required class="form-control" id="exampleInputEmail1" placeholder="Enter Quantity" aria-describedby="emailHelp">
                                          </div>
                                       </div>
                                       <div class="col-lg-12">
                                          <div class="form-group">
                                             <label for="operation_name">Scrap Quantity (kg)
                                             </label><span class="text-danger">*</span>
                                             <input type="text" step="any" data-min="0" value="0" name="scrap_factor" class="form-control onlyNumericInput required-input"   placeholder="Scrap Quantity ">
                                          </div>
                                       </div>
                                    </div>
                                    <div class="modal-footer">
                                       <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                       <button type="submit" class="btn btn-primary">Save
                                       changes</button>
                                    </div>
                                 </form>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="">
                     <table id="operations_bom" class="table table table-striped ">
                        <thead>
                           <tr>
                              <!-- <th>Sr. No.</th> -->
                              <th>Item part Number</th>
                              <th>Item part Description</th>
                              <th>Current Stock</th>
                              <th>UOM</th>
                              <th>Scrap(kg) </th>
                              <th>Part Type</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           
                              <%assign var='i' value=1%>
                              <%if $operations_bom%>
                                <%foreach from=$operations_bom item='po' %>
                               
                           <tr>
                              <!-- <td><%$po->output_part_data[0]->id %></td> -->
                              <td><%$po->output_part_data[0]->part_number %></td>
                              <td><%$po->output_part_data[0]->part_description %></td>
                              <td><%$po->current_stock %></td>
                              <td><%$po->uom %></td>
                              <td><%$po->scrap_factor %></td>
                              <td><%$po->part_type %></td>
                              <td>
                                 <a class="" href="<%base_url('operations_bom_inputs/')%><%$po->id %>/<%$po->output_part_id%>/<%$customer_part_id%>" title="Add Input Parts">
                                  <i class="ti ti-square-rounded-plus"></i></a>
                                 <%if ($po->part_type == "Inhouse Part") %>
                                 <a type="button" data-bs-toggle="modal" class="" data-bs-target="#editModal<%$i %>"> <i class="ti ti-edit"></i></a>
                                 <!-- modal starts -->
                                 <div class="modal fade" id="editModal<%$i %>" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                       <div class="modal-content">
                                          <div class="modal-header">
                                             <h5 class="modal-title" id="exampleModalLabel">Update Operation Bom</h5>
                                             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                             </button>
                                          </div>
                                          <div class="modal-body">
                                             <form action="<%base_url('update_operations_bom_output') %>" method="POST" id="update_operations_bom_output<%$i %>" class="update_operations_bom_output<%$i %> update_operations_bom_output custom-form">
                                                <div class="row">
                                                   <div class="col-lg-12">
                                                      <div class="form-group">
                                                         <label> Item part
                                                         </label><span class="text-danger">*</span>
                                                         <select class="form-control select2 required-input" name="output_part_id" style="width: 100%;">
                                                            <%foreach from=$child_part_list item='c1' %>
                                                            <option value="<%$c1->id %>"
                                                               <%if ($c1->id == $po->output_part_data[0]->id)%>selected <%/if%>  >
                                                               <%$c1->part_number %>/<%$c1->part_description %>
                                                            </option>
                                                            <%/foreach%>
                                                         </select>
                                                         <input type="hidden" name="record_id" value="<%$po->id %>" required class="form-control">
                                                         <input type="hidden" name="orig_output_part_id" value="<%$po->output_part_data[0]->id %>" required class="form-control">
                                                         <input type="hidden" name="customer_id" value="<%$customer[0]->customer_id %>" required class="form-control">
                                                         <input type="hidden" name="customer_part_number" value="<%$customer[0]->part_number %>" required class="form-control">
                                                         <input type="hidden" name="output_part_table_name" value="inhouse_parts" required class="form-control">
                                                      </div>
                                                   </div>
                                                   <div class="col-lg-12">
                                                      <div class="form-group">
                                                         <label for="operation_name">Scrap Quantity (kg)
                                                         </label><span class="text-danger">*</span>
                                                         <input type="text" step="any" data-min="0" value="<%$po->scrap_factor %>" name="scrap_factor" class="form-control required-input onlyNumericInput"  id="exampleInputPassword1">
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="modal-footer">
                                                   <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                   <button type="submit" class="btn btn-primary">Update</button>
                                                </div>
                                             </form>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <!-- modal ends -->
                                 <%/if%>
                              </td>
                           </tr>
                         
                              
                               <%assign var='i' value=$i+1%>
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
<script src="<%$base_url%>public/js/production/operation_bom.js"></script>