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
                        Add Inhouse Input Part </button>
   	  <button type="button" class="btn btn-seconday " data-bs-toggle="modal" data-bs-target="#exampleModalCustomerPart">
                        Add Input Part From Child Parts Parts </button>
      
      
      <a type="button" class="btn btn-seconday" href="<%base_url('operations_bom/')%><%$output_part_id_new %>" title="Back to customer item part">
      <i class="ti ti-arrow-left"></i>
      </a>
   </div>
   <div class="card p-0 mt-4">
            <div class="card-header">
                <div class="row">
                    <div class="tgdp-rgt-tp-sect">
                        <p class="tgdp-rgt-tp-ttl">Part Number</p>
                        <p class="tgdp-rgt-tp-txt">
                            <%$operations_bom[0]->customer_part_number %>
                        </p>
                    </div>
                    <%if (int)$output_part_id_new != (int)$output_part_id %>
                    <div class="tgdp-rgt-tp-sect">
                        <p class="tgdp-rgt-tp-ttl">Inhouse Part Number / Description</p>
                        <p class="tgdp-rgt-tp-txt">
                            <%$output_part_data[0]->part_number%>/<%$output_part_data[0]->part_description%>
                        </p>
                    </div>
                     <%/if%>
                   
                </div>
            </div>
        </div>
 
   <!-- Main content -->
   <div class="card mt-4">
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                           aria-labelledby="exampleModalLabel" aria-hidden="true">
                           <div class="modal-dialog modal-dialog-centered" role="document">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Inhouse Output Part </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                       aria-label="Close">
                                    </button>
                                 </div>
                                 <div class="modal-body">
                                    <form action="<%base_url('add_operations_bom_inputs') %>"
                                       method="POST" id="add_operations_bom_inputs" class="add_operations_bom_inputs custom-form">
                                       <div class="row">
                                          <div class="col-lg-12">
                                             <div class="form-group">
                                                <label> item part </label><span
                                                   class="text-danger">*</span>
                                                <select class="form-control select2 required-input"
                                                   name="input_part_id" style="width: 100%;">
                                                   <%foreach from=$child_part_list item=c1 %>
                                                   <option value="<%$c1->id %>">
                                                      <%$c1->part_number %>/<%$c1->part_description %>
                                                   </option>
                                                   <%/foreach%>
                                                </select>
                                                <input type="hidden" name="operations_bom_id"
                                                   value="<%$operations_bom_id%>"
                                                   required class="form-control"
                                                   id="exampleInputEmail1" placeholder="Enter Quantity"
                                                   aria-describedby="emailHelp">
                                                <input type="hidden" name="input_part_table_name"
                                                   value="inhouse_parts" required class="form-control"
                                                   id="exampleInputEmail1" placeholder="Enter Quantity"
                                                   aria-describedby="emailHelp">
                                             </div>
                                             <div class="col-lg-12">
                                                <div class="form-group">
                                                   <label for="operation_name">Qty</label><span
                                                      class="text-danger">*</span>
                                                   <input type="text" step="any" name="qty"
                                                      class="form-control onlyNumericInput required-input"  value="0"
                                                      placeholder="">
                                                </div>
                                             </div>
                                             <div class="col-lg-12">
                                                <div class="form-group">
                                                   <label for="operation_name">Operation
                                                   Number</label>
                                                   <input type="text" step="any"
                                                      name="operation_number" class="form-control"
                                                       placeholder="Operation Number">
                                                </div>
                                             </div>
                                             <div class="col-lg-12">
                                                <div class="form-group">
                                                   <label for="operation_name">Operation
                                                   Description</label><span
                                                      class="text-danger">*</span>
                                                   <input type="text" name="operation_description"
                                                      class="form-control required-input"  
                                                      placeholder="Operation Description">
                                                </div>
                                             </div>
                                          </div>
                                          <div class="modal-footer">
                                             <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                             <button type="submit" class="btn btn-primary">Save
                                             changes</button>
                                          </div>
                                       </div>
                                    </form>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="modal fade" id="exampleModalCustomerPart" tabindex="-1" role="dialog"
                           aria-labelledby="exampleModalLabel" aria-hidden="true">
                           <div class="modal-dialog modal-dialog-centered" role="document">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Child Part</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                       aria-label="Close">
                                    </button>
                                 </div>
                                 <div class="modal-body">
                                    <form action="<%base_url('add_operations_bom_inputs') %>"
                                       method="POST" class="add_operations_bom_inputs_1 custom-form" id="add_operations_bom_inputs_1">
                                       <div class="row">
                                          <div class="col-lg-12">
                                             <div class="form-group">
                                                <label> Select Child Part </label><span
                                                   class="text-danger">*</span>
                                                <select class="form-control select2 required-input"
                                                   name="input_part_id" style="width: 100%;">
                                                   <%foreach from=$child_parts_data item=c1 %>
                                                   <option value="<%$c1->id %>">
                                                      <%$c1->part_number %>/<%$c1->part_description%>
                                                   </option>
                                                   <%/foreach%>
                                                </select>
                                                <input type="hidden" name="operations_bom_id"
                                                   value="<%$operations_bom_id%>"
                                                   required class="form-control"
                                                   id="exampleInputEmail1" placeholder="Enter Quantity"
                                                   aria-describedby="emailHelp">
                                                <input type="hidden" name="input_part_table_name"
                                                   value="child_part" required class="form-control"
                                                   id="exampleInputEmail1" placeholder="Enter Quantity"
                                                   aria-describedby="emailHelp">
                                             </div>
                                             <div class="col-lg-12">
                                                <div class="form-group">
                                                   <label for="operation_name">Qty</label><span
                                                      class="text-danger">*</span>
                                                   <input type="text" step="any" name="qty"
                                                      class="form-control onlyNumericInput  required-input"  id="" value="0"
                                                      placeholder="">
                                                </div>
                                             </div>
                                             <div class="col-lg-12">
                                                <div class="form-group">
                                                   <label for="operation_name">Operation
                                                   Number</label>
                                                   <input type="text" step="any"
                                                      name="operation_number" class="form-control"
                                                      id="" placeholder="Operation Number">
                                                </div>
                                             </div>
                                             <div class="col-lg-12">
                                                <div class="form-group">
                                                   <label for="operation_name">Operation
                                                   Description</label><span
                                                      class="text-danger">*</span>
                                                   <input type="text" name="operation_description"
                                                      class="form-control  required-input" 
                                                      placeholder="Operation Description">
                                                </div>
                                             </div>
                                          </div>
                                          <div class="modal-footer">
                                             <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                             <button type="submit" class="btn btn-primary">Save
                                             changes</button>
                                          </div>
                                       </div>
                                    </form>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- </div> -->
                     
                     <!-- /.card-header -->
                     <div class="">
                        <table id="operations_bom_inputs" class="table table-striped">
                           <thead>
                              <tr>
                                 <!-- <th>Sr. No.</th> -->
                                 <!-- <th>Customer Part Number</th> -->
                                 <th>Item part Number</th>
                                 <th>Item part Description</th>
                                 <th>Qty</th>
                                 <th>UOM</th>
                                 <th>Operation Number</th>
                                 <th>Operation Description</th>
                                 <th>Actions</th>
                              </tr>
                           </thead>
                           <tbody>
                                <%assign var='i' value=1%>
                                <%if $is_data %>
                                <%foreach from=$operations_bom_inputs item='po' %>                                 
                              <tr>
                                 <!-- <td><%$i%></td> -->
                                 <td><%$po->output_part_data[0]->part_number %></td>
                                 <td><%$po->output_part_data[0]->part_description %></td>
                                 <td><%$po->qty %></td>
                                 <td><%$po->uom%></td>
                                 <td><%$po->operation_number%></td>
                                 <td><%$po->operation_description%></td>
                                 <td>
                                    <a type="button" data-bs-toggle="modal" class="" data-bs-target="#exampleModal2<%$i %>"> <i class="ti ti-edit"></i></a>
                                    <div class="modal fade" id="exampleModal2<%$i %>" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                       <div class="modal-dialog modal-dialog-centered" role="document">
                                          <div class="modal-content">
                                             <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Update</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                             </div>
                                             <div class="modal-body">
                                                <form action="<%base_url('update_operations_bom_inputs') %>"
                                                   method="POST" id="update_operations_bom_inputs<%$i %>" class="update_operations_bom_inputs<%$i %> update_operations_bom_inputs custom-form">
                                                   <div class="row">
                                                      <div class="col-lg-12">
                                                         <div class="col-lg-12">
                                                            <div class="form-group">
                                                               <label for="operation_name">Qty</label><span
                                                                  class="text-danger">*</span>
                                                               <input value="<%$po->qty %>" type="text" step="any" name="qty"
                                                                  class="form-control required-input onlyNumericInput"  id="" value="0"
                                                                  placeholder="">
                                                            </div>
                                                         </div>
                                                         <div class="col-lg-12">
                                                            <div class="form-group">
                                                               <label for="operation_name">Operation
                                                               Number</label>
                                                               <input value="<%$po->operation_number%>" type="text" step="any"
                                                                  name="operation_number" class="form-control"
                                                                  id="" placeholder="Operation Number">
                                                            </div>
                                                         </div>
                                                         <div class="col-lg-12">
                                                            <div class="form-group">
                                                               <label for="operation_name">Operation
                                                               Description</label><span
                                                                  class="text-danger">*</span>
                                                               <input value="<%$po->operation_description%>" type="text" name="operation_description"
                                                                  class="form-control required-input"  id=""
                                                                  placeholder="Operation Description">
                                                               <input value="<%$po->id%>" type="hidden" name="id"
                                                                  class="form-control" required id=""
                                                                  placeholder="Operation Description">
                                                            </div>
                                                         </div>
                                                      </div>
                                                      <div class="modal-footer">
                                                         <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                         <button type="submit" class="btn btn-primary">Save
                                                         changes</button>
                                                      </div>
                                                   </div>
                                                </form>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <a type="button" class="" data-bs-toggle="modal" data-bs-target="#addPromo<%$i%>">
                                    <i class="ti ti-trash"></i>
                                    </a>
                                    <div class="modal fade" id="addPromo<%$i%>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                       <div class="modal-dialog modal-dialog-centered" role="document">
                                          <div class="modal-content">
                                             <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                
                                                </button>
                                             </div>
                                             <div class="modal-body">
                                                <form action="<%base_url('delete') %>" method="POST" enctype="multipart/form-data" class="delete_item delete<%$i%>" id="delete<%$i%>">
                                                   <label for="">Are You Sure Want To Delete This ?</label>
                                                   <input type="hidden" value="<%$po->id %>" name="id" class="form-control">
                                                   <input type="hidden" value="operations_bom_inputs" name="table_name" class="form-control">
                                             </div>
                                             <div class="modal-footer">
                                             <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                             <button type="submit" class="btn btn-danger">Delete </button>
                                             </form>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
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
               </div>   <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script src="<%$base_url%>public/js/production/operations_bom_inputs.js"></script>