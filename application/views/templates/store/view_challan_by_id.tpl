<div class="content-wrapper">
   <!-- Content -->
   <div class="container-xxl flex-grow-1 container-p-y">
      <nav aria-label="breadcrumb">
         <div class="sub-header-left pull-left breadcrumb">
            <h1>
               Store
               <a hijacked="yes" href="javascript:void(0)" class="backlisting-link" >
               <i class="ti ti-chevrons-right" ></i>
               <em >Challan</em></a>
              
            </h1>
            <br>
            <span >View Challan</span>
         </div>
      </nav>
      <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5">
         <a href="<%base_url('view_add_challan') %>" class="btn btn-seconday"><i class="ti ti-arrow-left" title="Back"></i></a>
      </div>
      <!-- Main content -->
      <div class="container p-0">
        
            
               <!-- /.card -->
               <div class="card p-0 mt-4">
                  <div class="card-header">
                     <div class="row">
                     <div class="tgdp-rgt-tp-sect">
                        <p class="tgdp-rgt-tp-ttl">Challan Number</p>
                        <p class="tgdp-rgt-tp-txt"><%$challan_data[0]->challan_number %></p>
                      </div>
                      <div class="tgdp-rgt-tp-sect">
                        <p class="tgdp-rgt-tp-ttl">Supplier Name</p>
                        <p class="tgdp-rgt-tp-txt"><%$supplier[0]->supplier_name %></p>
                      </div>
                      <div class="tgdp-rgt-tp-sect">
                        <p class="tgdp-rgt-tp-ttl">Challan Date & Time</p>
                        <p class="tgdp-rgt-tp-txt"><%$challan_data[0]->created_date %> / <%$challan_data[0]->created_time %>  </p>
                      </div>
                      <div class="tgdp-rgt-tp-sect">
                        <p class="tgdp-rgt-tp-ttl">Status</p>
                        <p class="tgdp-rgt-tp-txt"><%$challan_data[0]->status %> </p>
                      </div>
                       
                        <!-- <div class="col-lg-1">
                           <div class="form-group">
                             <a id="viewOriginal" class="btn btn-success mt-4" href="<%base_url('view_challan_invoice/') %><%$challan_id %>" target="_blank">View</a>
                           </div>
                           </div> -->
                     </div>
                  </div>
               </div>
               <div class="card p-0 mt-4">
                  <div class="card-header">
                     <div class="row">
                        <div class="col-lg-1">
                           <div class="form-group">
                              <a id="viewOriginal" class="btn btn-success mt-4" href="<%base_url('view_challan_invoice/') %><%$challan_id %>" target="_blank">View</a>
                           </div>
                        </div>
                        <%if ($challan_data[0]->status == "completed") %>
                        <div class="col-lg-1">
                           <div class="form-group">
                              <a id="orignalInvoice" class="btn btn-success mt-4" href="<%base_url('view_challan_pdf/') %><%$challan_id %>/ORIGINAL_FOR_RECIPIENT">Original</a>
                           </div>
                        </div>
                        <div class="col-lg-1">
                           <div class="form-group">
                              <a id="duplicateInvoice" class="btn btn-success mt-4" href="<%base_url('view_challan_pdf/') %><%$challan_id %> /DUPLICATE_FOR_TRANSPORTER">Duplicate</a>
                           </div>
                        </div>
                        <div class="col-lg-1">
                           <div class="form-group">
                              <a id="triplicateInvoice" class="btn btn-success mt-4" href="<%base_url('view_challan_pdf/') %><%$challan_id %>/TRIPLICATE_FOR_SUPPLIER">Triplicate</a>
                           </div>
                        </div>
                        <div class="col-lg-1" style="width: 10%;">
                           <div class="form-group">
                              <a id="ackInvoice" class="btn btn-success mt-4" href="<%base_url('view_challan_pdf/') %><%$challan_id %>/ACKNOWLEDGEMENT_COPY">Acknowledge</a>
                           </div>
                        </div>
                        <div class="col-lg-1">
                           <div class="form-group">
                              <a id="extraaInvoice" class="btn btn-success mt-4" href="<%base_url('view_challan_pdf/') %><%$challan_id %>/EXTRA_COPY">Extra</a>
                           </div>
                        </div>
                        <!-- Print selection -->
                     <form action="<%base_url('print_challan_invoice/')%><%$challan_id %>" method="post" class="mt-5">
                     <div class="row" >
                        <div class="col-lg-1">
                           <div class="form-group" style="margin-right: 2em;">
                              <input type="checkbox" id="original" name="interests[]" value="ORIGINAL_FOR_RECIPIENT">
                              <label for="original">Original</label><br>
                           </div>
                        </div>
                        <div class="col-lg-1">
                           <div class="form-group" style="margin-right: 0em;">
                              <input type="checkbox" id="duplicate" name="interests[]" value="DUPLICATE_FOR_TRANSPORTER">
                              <label for="duplicate">Duplicate</label><br>
                           </div>
                        </div>
                        <div class="col-lg-1">
                           <div class="form-group" style="margin-right: 0em;">
                              <input type="checkbox" id="triplicate" name="interests[]" value="TRIPLICATE_FOR_SUPPLIER">
                              <label for="triplicate">Triplicate</label><br>
                           </div>
                        </div>
                        <div class="col-lg-2" style="width: 10%;">
                           <div class="form-group" style="margin-right: 2em;">
                              <input type="checkbox" id="acknowledge" name="interests[]" value="ACKNOWLEDGEMENT_COPY">
                              <label for="acknowledge">Acknowledge</label><br>
                           </div>
                        </div>
                        <div class="col-lg-1">
                           <div class="form-group" style="margin-right: 0em;">
                              <input type="checkbox" id="extraCopy" name="interests[]" value="EXTRA_COPY">
                              <label for="extraCopy">EXTRA COPY</label><br>
                           </div>
                        </div>
                        <div class="col-lg-1" style="    margin-top: -10px;">
                           <div class="form-group">
                              <button type="submit" onclick="this.form.target='_blank';return true;" class="btn btn-info btn"> Print </button>
                           </div>
                        </div>
                     </div>
                  </form>
                  <%/if%>
                     </div>
                  </div>
               </div>
              

               <%if ($new_po[0]->status == "pending" || $challan_data[0]->status != "completed") %>
              
               <div class="card p-0 mt-4">
               <div class="card-header">
                  <!-- part add flow -->
                  <%if ($challan_data[0]->status != "completed") %>
                  <div class="card-header px-0">
                  <form action="<%base_url('add_challan_parts') %>" method="post" class="add_challan_parts custom-form">
                     <div class="row">
                        <div class="col-lg-5">
                           <div class="form-group">
                                 <label for="">Select Part Number / Description / Current Stock<span class="text-danger">*</span> </label>
                                 <select name="part_id" id=""  class="form-control select2 required-input">
                                 
                                    <%if ($child_part) %>
                                    <%foreach from=$child_part item=c %>
                                    <%assign var='part_stock' value="0.00" %>
                                    <%if !empty($c->stock) %>
                                    <%assign var='part_stock' value=$c->stock %>
                                    <%/if%>
                                    <option value="<%$c->id %>">
                                       <%$c->part_number %> // <%$c->part_description %>/<%$part_stock %>
                                    </option>
                                    <%/foreach%>
                                    <%/if%>
                                 </select>
                           </div>
                        </div>
                        <div class="col-lg-3">
                        <div class="form-group">
                        <label for="">Enter Qty <span class="text-danger">*</span> </label>
                        <input type="text" step="any" name="qty" placeholder="Enter Qty " class="form-control required-input onlyNumericInput">
                        <input type="hidden" name="challan_id" value="<%$challan_data[0]->id %>" required class="form-control">
                        </div>
                        </div>
                        <div class="col-lg-3">
                        <div class="form-group">
                        <label for="">Select Process <span class="text-danger">*</span> </label>
                        <select name="process"  id="" class="form-control select2 required-input">
                       
                        <%if ($process) %>
                        <%foreach from=$process item=s %>
                        <option value="<%$s->name %>"><%$s->name %></option>
                        <%/foreach%>
                        <%/if%>
                        </select>
                        </div>
                        </div>
                        <div class="col-lg-1">
                        <div class="form-group">
                        <%if ($challan_data[0]->status != "completed") %>
                        <button type="submit" class="btn btn-info mt-4">Add Part</button>
                        <%/if%>
                        </div>
                        </div>
                       
                     </div>
                     </form>
                     <%/if%> <!-- end of part add flow -->
                     <div class="row">
                        <div class="col-lg-3">
                           <div class="form-group">
                              <%if ($challan_data[0]->status != "completed"
                                 && !empty($challan_parts)) %>
                              <button type="submit" data-bs-toggle="modal" class="btn btn-danger mt-4" data-bs-target="#challanCOmplete">
                              Complete Challan
                              </button>
                              <div class="modal fade" id="challanCOmplete" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                 <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                       <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLabel">Change Status Of
                                             Challan 
                                          </h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                          </button>
                                       </div>
                                       <div class="modal-body">
                                          <form action="javascript:void(0)" method="POST" class="change_challan_status">
                                             <div class="row">
                                                <div class="col-lg-12">
                                                   <div class="form-group">
                                                      <label for="payment_terms">Are You Sure Want To
                                                      Complete This Challan ? </label><span class="text-danger">*</span>
                                                      <input type="hidden" value="<%$challan_id %>" name="challan_id" required class="form-control" placeholder="Bank Details">
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary">Update</button>
                                             </div>
                                          </form>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <%/if%>
                           </div>
                        </div>
                     </div>
                  
                 
                     <%if ($po_parts) %>
                        <%if ($new_po[0]->status == "pending") %>
                            <%if ($this->session->userdata['type'] == 'admin' || $this->session->userdata['type'] == 'Admin') %>
                            <button type="button" class="btn btn-danger ml-1" data-bs-toggle="modal" data-bs-target="#lock">
                            Lock PO
                            </button>
                            <%/if%>
                        <%/if%>
                     <%/if%>
                     <%if ($new_po[0]->status == "lock") %>
                        <%if ($this->session->userdata['type'] == 'admin' || $this->session->userdata['type'] == 'Admin') %>
                        <button type="button" class="btn btn-success ml-1" data-bs-toggle="modal" data-bs-target="#accpet">
                        Accept (Released) PO
                        </button>
                        <button type="button" class="btn btn-danger ml-1" data-bs-toggle="modal" data-bs-target="#delete">
                        Reject (delete) PO
                        </button>
                        <%/if%>
                     <%else %>
                       
                     <%/if%>
                     <!-- Modal -->
                     <div class="modal fade" id="accpet" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title" id="exampleModalLabel">Update</h5>
                                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                 </button>
                              </div>
                              <div class="modal-body">
                                 <div class="row">
                                    <form action="<%base_url('accept_po_sub') %>" method="POST">
                                       <div class="col-lg-12">
                                          <div class="form-group">
                                             <label for=""><b>Are You Sure Want To Released This
                                             PO?</b> </label>
                                             <input type="hidden" name="id" value="<%$new_po[0]->id %>" required class="form-control">
                                             <input type="hidden" name="status" value="accpet" required class="form-control">
                                          </div>
                                       </div>
                                 </div>
                              </div>
                              <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-primary">Update</button>
                              </div>
                           </div>
                           </form>
                        </div>
                     </div>
                     <div class="modal fade" id="lock" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title" id="exampleModalLabel">Update</h5>
                                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                 </button>
                              </div>
                              <div class="modal-body">
                                 <div class="row">
                                    <form action="<%base_url('accept_po_sub') %>" method="POST">
                                       <div class="col-lg-12">
                                          <div class="form-group">
                                             <label for=""><b>Are You Sure Want To Lock This PO?</b>
                                             </label>
                                             <input type="hidden" name="id" value="<%$new_po[0]->id %>" required class="form-control">
                                             <input type="hidden" name="status" value="lock" required class="form-control">
                                          </div>
                                       </div>
                                 </div>
                              </div>
                              <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-primary">Update</button>
                              </div>
                           </div>
                           </form>
                        </div>
                     </div>
                     <div class="modal fade" id="delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                 </button>
                              </div>
                              <div class="modal-body">
                                 <div class="row">
                                    <form action="<%base_url('delete_po') %>" method="POST">
                                       <div class="col-lg-12">
                                          <div class="form-group">
                                             <label for=""><b>Are You Sure Want To Delete This
                                             PO?</b> </label>
                                             <input type="hidden" name="id" value="<%$new_po[0]->id %>" required class="form-control">
                                             <input type="hidden" name="status" value="reject" required class="form-control">
                                             <input type="hidden" name="table_name" value="new_po_sub" required class="form-control">
                                          </div>
                                       </div>
                                 </div>
                              </div>
                              <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-primary">Update</button>
                              </div>
                           </div>
                           </form>
                        </div>
                     </div>
                  </div>
                  </div>
                  </div>
                     <%/if%>
                  <div class="card p-0 mt-4">
               <div class="">
                  <div class="table-responsive-border">
                  <table  width="100%" border="1" cellspacing="0" cellpadding="0" class="table table-striped scrollable" style="border-collapse: collapse;" border-color="#e1e1e1" id="chanllan_tbl_by_id">
                        <thead>
                           <tr>
                              <th>Sr No</th>
                              <th>Part Number</th>
                              <th>Part Description</th>
                              <th>Part Rate</th>
                              <th>Qty </th>
                              <th>Process</th>
                              <th>HSN</th>
                              <th>Value</th>
                              <th>Remaining Qty </th>
                              <th>Delete</th>
                              <th>Action</th>
                              <th>History</th>
                           </tr>
                        </thead>
                        <tbody  style="max-height: 20em;">
                           <%if ($challan_parts) %>
                           <%assign var='i' value=1%>
                           <%assign var='final_po_amount' value=0%>
                           <%foreach from=$challan_parts item=p %>
                           <%assign var='child_part_data' value=$p->child_part_data%>
                           <%assign var='challan_parts_history_data' value=$p->challan_parts_history_data%>
                           <tr>
                              <td><%$i %></td>
                              <td><%$child_part_data[0]->part_number %></td>
                              <td><%$child_part_data[0]->part_description %></td>
                              <td><%$child_part_data[0]->store_stock_rate %></td>
                              <td><%$p->qty %></td>
                              <td><%$p->process %></td>
                              <td><%$p->hsn %></td>
                              <td><%$p->value %></td>
                              <td><%$p->remaning_qty %></td>
                              <td>
                                 <%if ($challan_data[0]->status != "completed") %>
                                 <!-- Button trigger modal -->
                                 <button type="button" class="btn btn-danger ml-1" data-bs-toggle="modal" data-bs-target="#deletePart<%$i %>">
                                 Delete
                                 </button>
                                 <!-- Delete Modal -->
                                 <div class="modal fade" id="deletePart<%$i %>" tabindex="-1" aria-labelledby="" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                       <div class="modal-content">
                                          <div class="modal-header">
                                             <h5 class="modal-title" id="exampleModalLabel">Delete Part
                                             </h5>
                                             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                             </button>
                                          </div>
                                          <form  method="POST" class="delete_challan_part delete_challan_part_<%$p->part_id %> custom-form" data-id="<%$p->part_id %>">
                                          <div class="modal-body">
                                         
                                             <div class="row">
                                                   <div class="col-lg-12">
                                                      <div class="form-group">
                                                         <label for=""> <b>Are you sure want to
                                                         delete this ? </b> </label>
                                                         <input type="hidden" name="id" value="<%$p->id %>" required class="form-control">
                                                         <input type="hidden" name="table_name" value="challan_parts" required class="form-control">
                                                         <input type="hidden" name="part_id" value="<%$p->part_id %>" required class="form-control">
                                                         <input type="hidden" name="partQty" value="<%$p->qty %>" required class="form-control">
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
                                 <%else %>
                                 NA <%$new_sales[0]->status %>
                                 <%/if%>
                              </td>
                              <td>
                                 <%if ($challan_parts_history_data) %>
                                 <%if ($challan_parts_history_data[0]->status == "completed") %>
                                 Stock updated
                                 <%else %>
                                 <button type="submit" data-bs-toggle="modal" class="btn btn-sm btn-danger" data-bs-target="#exampleModal2123<%$i %>">
                                 Accept Challan Qty
                                 </button>
                                 <%/if%>
                                 <%else %>
                                 <%if ($p->remaning_qty > 1) %>
                                 <button type="submit" data-bs-toggle="modal" class="btn btn-primary" data-bs-target="#exampleModal2<%$i %>">
                                 Challan Return Qty
                                 </button>
                                 <%/if%>
                                 <%/if%>
                                 <div class="modal fade" id="exampleModal2123<%$i %>" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                       <div class="modal-content">
                                          <div class="modal-header">
                                             <h5 class="modal-title" id="exampleModalLabel">Accept
                                                Qty 
                                             </h5>
                                             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                             </button>
                                          </div>
                                          <div class="modal-body">
                                             <form action="javascript:void(0)" method="POST" class="challan_qty challan_qty_<%$p->part_id %> custom-form" data-id="<%$p->part_id %>">
                                                <div class="row">
                                                   <div class="col-lg-12">
                                                      <div class="form-group">
                                                         <label for="payment_terms">Qty</label><span class="text-danger">*</span>
                                                         <input type="text" disabled value="<%$challan_parts_history_data[0]->qty  %>" name="123"  class="form-control required-input" placeholder="Supplier Challan Number">
                                                         <input type="hidden" value="<%$challan_parts_history_data[0]->qty  %>" name="qty_main" required class="form-control" placeholder="Supplier Challan Number">
                                                         <input type="hidden" value="<%$challan_parts_history_data[0]->id  %>" name="challan_parts_history_id" required class="form-control" placeholder="Bank Details">
                                                         <input type="hidden" value="<%$p->part_id %>" name="part_id" required class="form-control" placeholder="Bank Details">
                                                         <input type="hidden" value="<%$p->challan_id %>" name="challan_id" required class="form-control" placeholder="Bank Details">
                                                      </div>
                                                   </div>
                                                   <div class="col-lg-12">
                                                      <div class="form-group">
                                                         <label for="payment_terms">Enter Accept Qty</label><span class="text-danger">*</span>
                                                         <input type="text" max="<%$challan_parts_history_data[0]->accepeted_qty %>" name="accepeted_qty"  class="form-control required-input onlyNumericInput" placeholder="Enter Qty">
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
                                 <div class="modal fade" id="exampleModal2<%$i %>" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                       <div class="modal-content">
                                          <div class="modal-header">
                                             <h5 class="modal-title" id="exampleModalLabel">Return Qty </h5>
                                             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                             </button>
                                          </div>
                                          <div class="modal-body">
                                             <form action="javascript:void(0)" method="POST" class="challan_return_qty custom-form challan_return_qty_<%$p->part_id  %>" data-id="<%$p->part_id  %>">
                                                <div class="row">
                                                   <div class="col-lg-12">
                                                      <div class="form-group">
                                                         <label for="payment_terms">Supplier Challan Number</label><span class="text-danger">*</span>
                                                         <input type="text" name="supplier_challan_number"  class="form-control required-input" placeholder="Supplier Challan Number">
                                                         <input type="hidden" value="<%$challan_id %>" name="challan_id" required class="form-control" placeholder="Bank Details">
                                                         <input type="hidden" value="<%$p->part_id  %>" name="part_id" required class="form-control" placeholder="Bank Details">
                                                      </div>
                                                   </div>
                                                   <div class="col-lg-12">
                                                      <div class="form-group">
                                                         <label for="payment_terms">Enter Qty</label><span class="text-danger">*</span>
                                                         <input type="text" data-max="<%$p->remaning_qty %>" data-min="1" name="qty"  class="form-control required-input onlyNumericInput" placeholder="Enter Qty">
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
                              <td>
                                 <a class="btn btn-info" href="<%base_url('view_challan_parts_history/') %><%$p->challan_id %>/<%$p->part_id %>">History</a>
                              </td>
                           </tr>
                           <%assign var='i' value=$i+1%>
                           <%/foreach%>
                           <%/if%>
                        </tbody>
                        <tfoot>
                           <%if ($po_parts) %>
                           <tr>
                              <th colspan="11">Total</th>
                              <th><%$final_po_amount %></th>
                           </tr>
                           <%/if%>
                        </tfoot>
                     </table>
                  </div>
               </div>
               </div>
               <!-- /.card-body -->
            </div>
            <!-- /.card -->
         </div>
         <!-- /.col -->
      </div>
      <!-- /.row -->
   </div>
   <!--/ Responsive Table -->
</div>
<!-- /.col -->
<div class="content-backdrop fade"></div>
</div>

<script type="text/javascript">
var base_url = <%$base_url|@json_encode%>
</script>
<script src="<%$base_url%>public/js/store/view_challan_by_id.js"></script>