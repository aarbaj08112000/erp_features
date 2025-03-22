
<div class="wrapper container-xxl flex-grow-1 container-p-y" >
<div class="content-wrapper">
   
   <nav aria-label="breadcrumb">
      <div class="sub-header-left pull-left breadcrumb">
        <h1>
          Reports
          <a hijacked="yes" href="javascript:void(0)" class="backlisting-link" title="Back to Issue Request Listing">
            <i class="ti ti-chevrons-right"></i>
            <em>Material Requisition</em></a>
        </h1>
        <br>
        <span>Stock Up/Return</span>
      </div>
    </nav>
    <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5">
        <%if checkGroupAccess("stock_up","add","No")%>
          <button type="button" class="btn btn-seconday float-left" data-bs-toggle="modal" data-bs-target="#exampleModal">
                     Add Stock </button>
        <%/if%>
        <%if checkGroupAccess("stock_up","export","No")%>
            <button class="btn btn-seconday" type="button" id="downloadCSVBtn" title="Download CSV"><i class="ti ti-file-type-csv"></i></button>
          <button class="btn btn-seconday" type="button" id="downloadPDFBtn" title="Download PDF"><i class="ti ti-file-type-pdf"></i></button>
        <%/if%>
    </div>
   <!-- Main content -->
   <section class="content">
      <div class="">
         <div class="row">
            <div class="col-12">
               <div class="card">
                  
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
                              <form action="<%base_url('add_stock_up') %>" method="POST" enctype='multipart/form-data' id="add_stock_up" class="custom-form">
                                 <div class="row">
                                    <div class="col-lg-12">
                                      <div class="form-group">
                                          <label for="po_num">Stock Up/Return Type</label><span class="text-danger">*</span>
                                          <select name="stock_up_type"   class="from-control select2 required-input" style="width:100%;" id="stock_up_type">
                                            <option value="production_qty">Child Part</option>
                                            <option value="inhouse_qty">Inhouse Part</option>
                                            <option value="customer_part">Customer Part</option>
                                          </select>
                                       </div>
                                       <div class="form-group">
                                          <label for="po_num">Select Part Number / Description / Stock </label><span class="text-danger">*</span>
                                          <select name="part_id"  id="part_row" class="from-control select2 required-input" style="width:100%;">
                                            <option value=''>Select Part Number / Description / Stock</option>
                                             <%if ($child_part) %>
                                                    <%foreach from=$child_part item=c %>
                                                        <%assign var='stock' value=$c->stock%>
                                                        <%if (empty($stock)) %>
                                                            $stock = "0.00";
                                                        <%/if%>
                                                        <%if ($c->childPartId > 0) %>
                                                   <option value="<%$c->childPartId %>" data-qty='<%$stock %>'><%$c->part_number %>/<%$c->part_description %>/<%$stock %></option>
                                                      <%/if%>
                                                <%/foreach%>
                                             <%/if%>
                                          </select>
                                       </div>
                                       <div class="form-group">
                                          <label for="po_num">Enter Reason <span class="text-danger">*</span></label>
                                          <input type="text" name="reason"  placeholder="Enter Reason" class="form-control required-input">
                                       </div>
                                       <div class="form-group">
                                          <label for="po_num">Upload document</label>
                                          <input type="file" name="uploading_document"  class="form-control">
                                       </div>
                                       <div class="form-group">
                                          <label for="po_num">Enter Qty <span class="text-danger">*</span></label>
                                          <input type="text" name="qty" step="any" placeholder="Enter Qty"  class="form-control required-input onlyNumericInput" data-min="1">
                                          <input type="hidden" name="old_qty" id="old_qty_stock">
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
                  <div class="">
                     <table id="stock_up" class="table table-striped">
                        <thead>
                           <tr>
                              <!-- <th>Sr. No.</th> -->
                              <th>Part Number / Description</th>
                              <th>Old Stock Qty</th>
                              <th>New Qty</th>
                              <!-- <th>After Stock Qty</th> -->
                              <th>UOM</th>
                              <th>Reason</th>
                              <th>Document</th>
                              <th>Request Date</th>
                              <th>Type</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                              <%assign var='i' value=1 %>
                              <%if ($stock_changes) %>
                                    <%foreach from=$stock_changes item=c  %>
                                       <%if ($c->type == "addition") %>
                                     <tr>
                                        <!-- <td><%$i %></td>-->
                                        <td><%$c->part_number %>/<%$c->part_description %></td>
                                         <td><%$c->old_qty %></td>
                                        <td><%$c->qty %></td>
                                        <!-- <td><%$c->qty+$c->old_qty%></td> -->
                                        <td><%$c->uom_name %></td>
                                        <td><%$c->reason %></td>
                                        <td>
                                           <%if (!empty($c->uploading_document)) %>
                                           <a class="btn btn-dark" download href="<%base_url('documents/') %> <%$c->uploading_document %>">Download</a>
                                          <%/if%>
                                        </td>
                                        <td><%$c->created_date %></td>
                                        <td>
                                          <%if ($c->toStockType == "production_qty" )%>
                                            Child Part
                                          <%else if ($c->toStockType == "inhouse_qty" )%>
                                            Inhouse Part
                                          <%else if ($c->toStockType == "customer_part" )%>
                                            Customer Part
                                          <%/if%>
                                            
                                          </td>
                                        <td>
                                           <%if ($c->status == "pending") %>
                                            <%if checkGroupAccess("stock_up","update","No")%>
                                               <a class="btn btn-warning transfer-stock-value" href="javascript:void(0)" data-href="<%base_url('add_stock/') %><%$c->id %>">Click To Transfer Stock</a>
                                               <a class="btn btn-danger " href="javascript:void(0)" type="button" data-bs-toggle="modal"  data-bs-target="#deleteInvoice<%$srNo%>" data-href="<%base_url('delete_stock_up') %>">Delete</a>

                                              <div class="modal fade" id="deleteInvoice<%$srNo%>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">Delete Stock Up/Return</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="row">
                                                                                <form action="<%base_url('delete_stock_up')%>" method="POST" id="delete_stock_up<%$srNo%>" class="delete_stock_up<%$srNo%> delete_stock_up custom-form">
                                                                                    <div class="col-lg-12">
                                                                                        <div class="form-group">
                                                                                            <label for=""><b>Are you sure want to Delete this Stock Up/Return?</b> </label>
                                                                                            <input type="hidden" name="stock_up_id" value="<%$c->id%>" required class="form-control">
                                                                                        </div>
                                                                                    </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                            <button type="submit" class="btn btn-primary">Delete</button>
                                                                        </div>
                                                                    </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                            <%else%>
                                              <%display_no_character("")%>
                                            <%/if%>
                                           <%else %>
                                              stock transferred
                                            <%/if%>
                                        </td>
                                     </tr>
                                 <%assign var='i' value=$i+1 %>
                                 <%/if%>
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
<script type="text/javascript">
  var base_url = <%base_url()|@json_encode%>
</script>
    <script src="<%$base_url%>public/js/store/stock_up.js"></script>
