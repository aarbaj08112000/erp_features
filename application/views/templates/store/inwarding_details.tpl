<%assign var='isMultiClient' value=$session_data['isMultipleClientUnits']%>

<div class="content-wrapper">
  <!-- Content -->

  <div class="container-xxl flex-grow-1 container-p-y">

    <nav aria-label="breadcrumb">
      <div class="sub-header-left pull-left breadcrumb">
        <h1>
        Inwarding
          <a hijacked="yes" href="javascript:void(0)" class="backlisting-link"  >
            <i class="ti ti-chevrons-right" ></i>
            <em >Part GRN</em></a>
           
          </h1>
          <br>
          <span >Inwarding PO Invoice Details</span>
        </div>
      </nav>
      <!-- <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Basic Tables</h4> -->

      <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5">
       
        <a class="btn btn-seconday"
           href="<%base_url('inwarding_invoice/') %><%$new_po_id %>" title="Back">
        <i class="ti ti-arrow-left"></i> </a>
      </div>



      <!-- Main content -->
      <div class="card p-0 mt-4"> 
           <div class="">
              <div class="row">
                 <div class="col-12">
                    <!-- /.card -->
                       <div class="card-header">
                          <div class="row">
                              <div class="tgdp-rgt-tp-sect">
                                 <p class="tgdp-rgt-tp-ttl">GRN Number</p>
                                 <p class="tgdp-rgt-tp-txt">
                                 <%if ($status == 'verifed') %><%$inwarding_data[0]->grn_number %><%else %><%display_no_character()%><%/if%>
                                 </p>
                              </div>
                            
                              <div class="tgdp-rgt-tp-sect">
                                 <p class="tgdp-rgt-tp-ttl">PO Number</p>
                                 <p class="tgdp-rgt-tp-txt">
                                 <%display_no_character($new_po[0]->po_number) %>
                                 </p>
                              </div>
                              <div class="tgdp-rgt-tp-sect">
                                 <p class="tgdp-rgt-tp-ttl">PO Date</p>
                                 <p class="tgdp-rgt-tp-txt">
                                 <%display_no_character($new_po[0]->po_date) %>
                                 </p>
                              </div>
                            
                              <div class="tgdp-rgt-tp-sect">
                                 <p class="tgdp-rgt-tp-ttl">PO Status</p>
                                 <p class="tgdp-rgt-tp-txt">
                                 <%if ($new_po[0]->status == 'accpet') %>Released
                                 <%else %><%$new_po[0]->status%><%/if%>
                                 </p>
                              </div>
                              <div class="tgdp-rgt-tp-sect">
                                 <p class="tgdp-rgt-tp-ttl">Supplier Name</p>
                                 <p class="tgdp-rgt-tp-txt">
                                 <%display_no_character($supplier[0]->supplier_name) %>
                                 </p>
                              </div>
                              <div class="tgdp-rgt-tp-sect">
                                 <p class="tgdp-rgt-tp-ttl">Supplier Number</p>
                                 <p class="tgdp-rgt-tp-txt">
                                 <%display_no_character($supplier[0]->supplier_number) %>
                                 </p>
                              </div>
                              <div class="tgdp-rgt-tp-sect">
                                 <p class="tgdp-rgt-tp-ttl">Supplier GST</p>
                                 <p class="tgdp-rgt-tp-txt">
                                 <%display_no_character($supplier[0]->gst_number) %>
                                 </p>
                              </div>
                              <div class="tgdp-rgt-tp-sect">
                                 <p class="tgdp-rgt-tp-ttl">Inwarding Status</p>
                                 <p class="tgdp-rgt-tp-txt">
                                 <%display_no_character($inwarding_data[0]->status) %>
                                 </p>
                              </div>
                              <div class="tgdp-rgt-tp-sect">
                                 <p class="tgdp-rgt-tp-ttl">Invoice Number</p>
                                 <p class="tgdp-rgt-tp-txt">
                                 <%display_no_character($inwarding_data[0]->invoice_number) %>
                                 </p>
                              </div>
                              <div class="tgdp-rgt-tp-sect">
                                 <p class="tgdp-rgt-tp-ttl">Invoice Amount</p>
                                 <p class="tgdp-rgt-tp-txt">
                                 <%display_no_character($inwarding_data[0]->invoice_amount) %>
                                 </p>
                              </div>
                              <div class="tgdp-rgt-tp-sect">
                                 <p class="tgdp-rgt-tp-ttl">Software Calculated Amount</p>
                                 <p class="tgdp-rgt-tp-txt">
                                 <%$actual_price %>
                                 </p>
                              </div>
                              <div class="tgdp-rgt-tp-sect">
                                 <p class="tgdp-rgt-tp-ttl">Invoice Amount Validation Status</p>
                                 <p class="tgdp-rgt-tp-txt">
                                 <%display_no_character($status) %>
                                 </p>
                              </div>
                             
                             <%if ($isMultiClient == "true") %>
                             <div class="tgdp-rgt-tp-sect">
                                 <p class="tgdp-rgt-tp-ttl">Delivery Location</p>
                                 <p class="tgdp-rgt-tp-txt">
                                 <%display_no_character($inwarding_data[0]->delivery_unit) %>
                                 </p>
                              </div>
                             <%/if%>
                             <div class="col-lg-12">
                                <div class="">
                                   <!-- <a class="btn btn-dark mt-4"
                                      href="<%base_url('inwarding_invoice/') %><%$new_po_id %>">
                                   < Back </a> &nbsp; -->
                                   <%if ($status == "not-verifed") %>
        	                           <button type="button" class="btn btn-primary mt-4" data-bs-toggle="modal"
        	                              data-bs-target="#exampleModalmatch">
        	                           Match Invoice Amount </button>
                                   <%/if%>

                                    <%if ($inwarding_data[0]->status == "accepted") %>
                                      	<button class='btn btn-primary mt-4' disabled>Inwarding Already Accepted</button>
                                    <%else if ($status == "verifed") %>
                                          <%if ($inwarding_data[0]->status == "pending" || $inwarding_data[0]->status == "") %>
        			                           <button type="button" class="btn btn-danger mt-4" data-bs-toggle="modal"
        			                              data-bs-target="#exampleModalgenerate">
        			                           Generate GRN </button>
        			                       <%/if%>
                                   <%/if%>
                                   <!-- Modal -->
                                   <div class="modal fade" id="exampleModalmatch" tabindex="-1" role="dialog"
                                      aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog modal-dialog-centered " role="document">
                                         <div class="modal-content">
                                            <div class="modal-header">
                                               <h5 class="modal-title" id="exampleModalLabel">Match Invoice Amount
                                               </h5>
                                               <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                  aria-label="Close">

                                               </button>
                                            </div>
                                            <div class="modal-body">
                                               <form
                                                  action="javascript:void(0);" class="validate_invoice_amount custom-form " method="post">
                                                  <div class="row">
                                                     <div class="col-lg-12">
                                                        <div class="form-group">
                                                           <label> Invoice Amount </label><span
                                                              class="text-danger">*</span>
                                                           <input type="text" step="any"
                                                              name="invoice_amount"
                                                              placeholder="Invoice Amount"
                                                              value="" class="form-control required-input onlyNumericInput">
                                                           <input type="hidden" name="inwarding_id"
                                                              value="<%$inwarding_id %>"
                                                              class="form-control">
                                                           <input type="hidden" name="actual_price"
                                                              value="<%$actual_price %>"
                                                              class="form-control">
                                                           <input type="hidden" name="minus_price"
                                                              value="<%$minus_price %>"
                                                              class="form-control">
                                                           <input type="hidden" name="plus_price"
                                                              value="<%$plus_price %>"
                                                              class="form-control">
                                                           <input type="hidden" name="actual_price"
                                                              value="<%$status %>"
                                                              class="form-control">
                                                        </div>
                                                     </div>
                                                  </div>
                                                  <div class="modal-footer">
                                                     <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                     <button type="submit" class="btn btn-primary">Save
                                                     Changes</button>
                                                  </div>
                                               </form>
                                            </div>
                                        
                                      </div>
                                      </div>
                                   </div>
                                   <div class="modal fade" id="exampleModalgenerate" tabindex="-1"
                                      role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog modal-dialog-centered " role="document">
                                         <div class="modal-content">
                                            <div class="modal-header">
                                               <h5 class="modal-title" id="exampleModalLabel">Generate GRN
                                               </h5>
                                               <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                  aria-label="Close">
                                               <span aria-hidden="true">&times;</span>
                                               </button>
                                            </div>
                                            <div class="modal-body">
                                               <form
                                                  action="javascript:void(0);"
                                                  method="POST" class="generate_grn">
                                                  <div class="row">
                                                     <div class="col-lg-12">
                                                        <div class="form-group">
                                                           <label> Are You Sure Want To Generate GRN ?
                                                           </label>
                                                           <input type="hidden" name="status"
                                                              placeholder="" value="generate_grn"
                                                              class="form-control">
                                                           <input type="hidden" name="inwarding_id"
                                                              value="<%$inwarding_id %>"
                                                              class="form-control">
                                                        </div>
                                                     </div>
                                                  </div>
                                                  <div class="modal-footer">
                                                     <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                     <button type="submit" class="btn btn-primary">Save
                                                     Changes</button>
                                                  </div>
                                               </form>
                                            </div>
                                         </div>
                                      </div>
                                   </div>
                                </div>
                             </div>
                          </div>
                       </div>
                       
                          </div>
                          <!-- /.card-body -->
                       </div>
                       <!-- /.card -->
                    </div>
                    <!-- /.col -->
                 </div>
      <div class="card p-0 mt-4">
        <div class="tabTitle position-relative">
                <h2 id="cc_sh_sys_static_field_3">
                    <span>PO Parts</span>
                    <span style="display:none;position:absolute;left:0;right:0;text-align:center;top: 19px;"
                        id="ajax_loader_childModule_stock_intward_details">
                        <i class="fa fa-refresh fa-spin-light fa-1x fa-fw"></i>
                    </span>

                </h2>
                <input type="text" name="reason" placeholder="Filter Search" class="form-control parts-global-seacrh" id="serarch-filter-input" fdprocessedid="bxkoib">
               
                
            </div>
                 <div class="table-responsive-border">
                 <table  width="100%" border="1" cellspacing="0" cellpadding="0" class="table table-striped scrollable scrollable-seachable" style="border-collapse: collapse;" border-color="#e1e1e1" id="view_add_challan">
                 <thead>
                    <tr>
                       <!-- <th>Sr No</th> -->
                       <th>Part Number</th>
                       <th>Part Description</th>
                       <th>UOM</th>
                       <th>Tax Structure</th>
                       <th>PO QTY</th>
                       <th>Balance QTY</th>
                       <th>Price</th>
                       <th>Inwarding Qty</th>
                       <th class="text-center">Action </th>
                    </tr>
                 </thead>
                 <tbody  >
                      <%if ($po_parts) %>
                           <%assign var="i" value=1%>
                          <%assign var="final_po_amount" value=0%>
                           <%foreach from=$po_parts item=p %>

                               <%* //It will  select all matching child part master as we have multiple child part master for single child part id *%>
                               <%assign var="child_part_data" value=$p->child_part_data%>
                               <%*// $gst_structure_data = $this->Crud->get_data_by_id("gst_structure", $p->tax_id, "id"); *%>
                                <%assign var="uom_data" value=$p->uom_data%>
                                <%assign var="part_rate_new" value=0%>
                               <%if (empty($p->rate)) %>
                                     <%assign var="part_rate_new" value=$child_part_data[0]->part_rate%>
                               <%else %>
                                     <%assign var="part_rate_new" value=$p->rate%>
                               <%/if%>

                               <%*//here we are only geting rate of only one from above list *%>
                               <%assign var="total_rate" value=$part_rate_new * $p->qty%>
                               <%assign var="final_po_amount" value=$final_po_amount + $total_rate%>
                                <%assign var="grn_details_data" value=$p->grn_details_data%>
                                <%assign var="data_present" value='no'%>
                               <%if ($grn_details_data) %>
                                     <%assign var="data_present" value='yes'%>
                               <%else %>
                                     <%assign var="data_present" value='no'%>
                               <%/if%>
                               <%assign var="subcon_po_inwarding_master" value=$p->subcon_po_inwarding_master%>

                               <%if (empty($new_po[0]->process_id)) %>
                    <tr>

                      <!-- <td><%$p->id %></td> -->
                       <td><%$child_part_data[0]->part_number %></td>
                       <td><%$child_part_data[0]->part_description %></td>
                       <td><%$uom_data[0]->uom_name %></td>
                       <td><%$p->gst_structure_data[0]->code %></td>
                       <td><%$p->qty %></td>
                       <td><%$p->pending_qty %></td>
                       <td><%$part_rate_new %></td>
                       <td>
                          <%if ($inwarding_data[0]->status == "accepted") %>
                                <%$grn_details_data[0]->qty %>
                           <%else if ($data_present == "yes") %>
                                <%$grn_details_data[0]->qty %>
                           <%else if ($inwarding_data[0]->status == "generate_grn") %>
                                NA
                           <%else%>
                          <form action="javascript:void(0);" class="add_grn_qty_form custom-form add_grn_qty_form_<%$p->id %>" method="post" data-id="<%$p->id %>">
                          <div class="form-group">
                          <label for="tool_number" style="display:none ;">Inwarding Qty </label>
                          <input type="text"  step="any"
                                data-max="<%$p->pending_qty %>"
                                placeholder="Inwarding Qty"
                                name="qty"
                                class="form-control required-input onlyNumericInput">
                        </div>
                             
                             <input type="hidden" name="inwarding_id"
                                value="<%$inwarding_id  %>" class="form-control">
                             <input type="hidden"
                                name="new_po_id" value="<%$new_po_id %>"
                                class="form-control">
                             <input type="hidden"
                                name="part_id" value="<%$p->part_id %>"
                                class="form-control">
                             <input type="hidden"
                                name="invoice_number"
                                value="<%$inwarding_data[0]->invoice_number %>"
                                class="form-control">
                             <input type="hidden"
                                name="grn_number"
                                value="<%$inwarding_data[0]->grn_number %>"
                                class="form-control">
                             <input type="hidden"
                                name="po_part_id" value="<%$p->id %>"
                                class="form-control">
                             <input type="hidden"
                                name="pending_qty" value="<%$p->pending_qty %>"
                                class="form-control">
                             <input type="hidden"
                                name="part_rate" value="<%$part_rate_new %>"
                                class="form-control">
                             <input type="hidden"  name="tax_id"
                                value="<%$p->tax_id %>" class="form-control">
                             <input type="hidden" name="invoice_number"
                                value="<%$invoice_number %>" class="form-control">
                            <%/if%>
                       </td>
                       <td  class="text-center">
                       <%if ($data_present == "yes" && $status != "verifed") %>
                       <a type="button" class=" " title="Update" data-bs-toggle="modal" data-bs-target="#exampleModa<%$i %>l">
                       <i class="ti ti-edit"></i>
                       </a>
                       <div class="modal fade" id="exampleModa<%$i %>l" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                       <div class="modal-dialog modal-dialog-centered" role="document">
                       <div class="modal-content">
                       <div class="modal-header">
                       <h5 class="modal-title" id="exampleModalLabel">Update Details</h5>
                       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                       </button>
                       </div>
                       <div class="modal-body ">
                       <form  action="javascript:void(0);" class="edit_grn_qty_form custom-form edit_grn_qty_form_<%$p->id %>" method="post" data-id="<%$p->id %>">
                       <div class="row">
                       <div class="col-lg-12">
                       <div class="form-group">
                       <label> Inwarding Qty </label><span class="text-danger">*</span>
                       <input type="text"  step="any"
                       data-max="<%$p->pending_qty+$grn_details_data[0]->qty %>"
                          name="qty"
                          value="<%$grn_details_data[0]->qty %>"
                          class="form-control required-input onlyNumericInput">
                       <input type="hidden"
                          name="inwarding_id"
                          value="<%$inwarding_id %>" class="form-control">
                       <input type="hidden"
                          name="new_po_id" value="<%$new_po_id %>"
                          class="form-control">
                       <input type="hidden"
                          name="part_id" value="<%$p->part_id %>"
                          class="form-control">
                       <input type="hidden"
                          name="invoice_number"
                          value="<%$inwarding_data[0]->invoice_number %>"
                          class="form-control">
                       <input type="hidden"
                          name="grn_number"
                          value="<%$inwarding_data[0]->grn_number %>"
                          class="form-control">
                       <input type="hidden"
                          name="po_part_id" value="<%$p->id %>"
                          class="form-control">
                       <input type="hidden"
                          name="part_rate" value="<%$part_rate_new %>"
                          class="form-control">
                       <input type="hidden"
                          name="pending_qty" value="<%$p->pending_qty %>"
                          class="form-control">
                       <input type="hidden"
                          name="tax_id"
                          value="<%$p->tax_id %>" class="form-control">
                       </div>
                       <div class="modal-footer">
                       <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                       <button type="submit" class="btn btn-primary">Save</button>
                       </div>
                       </form>
                       </div>
                       </div>
                       </div>
                       </div>
                       <%else if ($status == "not-verifed") %>
                       <button type="submit" class="btn btn-info">Submit</button>
                       </form>
                       <%else%>
                       <%display_no_character()%>
                       <%/if%>
                       </td>
                    </tr>
                    <%else if ($p->pending_qty > 0)%>
                     
                    <tr>
                       <!-- <td><%$i %></td> -->
                       <td><%$child_part_data[0]->part_number %></td>
                       <td><%$child_part_data[0]->part_description %></td>
                       <td><%$uom_data[0]->uom_name %></td>
                       <td><%$p->gst_structure_data[0]->code %></td>
                       <td><%$p->qty %></td>
                       <td><%$p->pending_qty %></td>
                       <td><%$part_rate_new %></td>
                       <td >
                       <%if ($inwarding_data[0]->status == "accepted") %>
                              <%$grn_details_data[0]->qty %>234
                       <%else if ($data_present == "yes") %>
                              <%$grn_details_data[0]->qty %>
                       <%else %>
                       <%if (empty($subcon_po_inwarding_master[0]->inwarding_qty)) %>
                       <form action="<%base_url('add_grn_qty_subcon_view') %>"
                          method="post" id="add_grn_qty_subcon_view<%$i %>" class="add_grn_qty_subcon_view<%$i %> add_grn_qty_subcon_view custom-form">
                        <div class="form-group">
                       <input type="text"  step="any"
                       data-max="<%$p->pending_qty %>"  data-min="1"
                          placeholder="Inwarding Qty" name="qty"
                          class="form-control onlyNumericInput required-input">
                        </div>
                       <input type="hidden" name="inwarding_id"
                          value="<%$inwarding_id %>" class="form-control">
                       <input type="hidden" placeholder="Inwarding Qty"
                          name="new_po_id" value="<%$new_po_id %>"
                          class="form-control">
                       <input type="hidden" placeholder="Inwarding Qty"
                          name="part_id_new"
                          value="<%$child_part_data[0]->child_part_id %>"
                          class="form-control">
                       <input type="hidden" placeholder="Inwarding Qty"
                          name="part_id" value="<%$p->part_id %>"
                          class="form-control">
                       <input type="hidden" placeholder="number invoice"
                          name="invoice_number"
                          value="<%$inwarding_data[0]->invoice_number %>"
                          class="form-control">
                       <input type="hidden" placeholder="Inwarding Qty"
                          name="grn_number"
                          value="<%$inwarding_data[0]->grn_number %>"
                          class="form-control">
                       <input type="hidden" placeholder="Inwarding Qty"
                          name="po_part_id" value="<%$p->id %>"
                          class="form-control">
                       <input type="hidden" placeholder="Inwarding Qty"
                          name="pending_qty" value="<%$p->pending_qty %>"
                          class="form-control">
                       <input type="hidden" placeholder="Inwarding Qty"
                          name="part_rate" value="<%$part_rate_new %>"
                          class="form-control">
                       <input type="hidden" placeholder="Inwarding Qty" name="tax_id"
                          value="<%$p->tax_id %>" class="form-control">
                       <%else %>
                              <%$subcon_po_inwarding_master[0]->inwarding_qty %>
                       <%/if%>
                       <%/if%>
                       </td>
                       <td class="text-center">
                       <%if ($subcon_po_inwarding_master) %>
                       <a class="" type="button"
                          href="<%base_url('grn_subcon_view/') %><%$p->part_id %>/<%$new_po_id %>/<%$inwarding_data[0]->id %>/<%$p->part_id %>"><i class="ti ti-eye"></i></a>
                       <%else if ($data_present == "yes") %>
                           
                       <%else if ($status == "not-verifed") %>
                          <button type="submit" class="btn btn-info">Submit</button>
                          </form>
                          <%else%>
                          <%display_no_character()%>
                       <%/if%>
                       </td>
                    </tr>
                    <%/if%>
                    <%assign var='i' value=$i+1%>
                       <%/foreach%>
                    <%/if%>

                 </tbody>
              </table>
                 </div>

      </div>
                 <!-- /.row -->
              </div>
              <!-- /.container-fluid -->
      <!--/ Responsive Table -->
    </div>
    </div>

    <!-- /.col -->


    <div class="content-backdrop fade"></div>
  </div>


  <script type="text/javascript">
  var base_url = <%$base_url|@json_encode%>
</script>

  <script src="<%$base_url%>public/js/store/view_supplier_challan.js"></script>
