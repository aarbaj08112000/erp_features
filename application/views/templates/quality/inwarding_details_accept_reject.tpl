
<div class="content-wrapper">
   <!-- Content -->
   <div class="container-xxl flex-grow-1 container-p-y">
      <nav aria-label="breadcrumb">
         <div class="sub-header-left pull-left breadcrumb">
            <h1>
               Quality
               <a hijacked="yes" href="javascript:void(0)" class="backlisting-link" title="Back to Issue Request Listing" >
               <i class="ti ti-chevrons-right" ></i>
               <em >Accept / Reject Validation</em></a>
            </h1>
            <br>
            <span >Accept / Reject Validation</span>
         </div>
      </nav>
      <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5">
         <a class="btn  btn-seconday"
            href="<%base_url('accept_reject_validation') %>">
         <i class="ti ti-arrow-left" title="Back"></i></a>
      </div>
      <!-- Main content -->
      <div class="card p-0 mt-4">
         <div class="card-header">
            <div class="row">
               <div class="tgdp-rgt-tp-sect">
                  <p class="tgdp-rgt-tp-ttl">GRN Number</p>
                  <p class="tgdp-rgt-tp-txt"><%$inwarding_data[0]->grn_number %></p>
               </div>
               <div class="tgdp-rgt-tp-sect">
                  <p class="tgdp-rgt-tp-ttl">PO Number</p>
                  <p class="tgdp-rgt-tp-txt"><%$new_po[0]->po_number %></p>
               </div>
               <div class="tgdp-rgt-tp-sect">
                  <p class="tgdp-rgt-tp-ttl">PO Date</p>
                  <p class="tgdp-rgt-tp-txt"><%$new_po[0]->po_date %></p>
               </div>
               <div class="tgdp-rgt-tp-sect">
                  <p class="tgdp-rgt-tp-ttl">PO Status</p>
                  <p class="tgdp-rgt-tp-txt"><%if ($new_po[0]->status == "accpet") %>Released
                     <%else %><%$new_po[0]->status %><%/if%>
                  </p>
               </div>
               <div class="tgdp-rgt-tp-sect">
                  <p class="tgdp-rgt-tp-ttl">Supplier Name</p>
                  <p class="tgdp-rgt-tp-txt"><%$supplier[0]->supplier_name %></p>
               </div>
               <div class="tgdp-rgt-tp-sect hide">
                  <p class="tgdp-rgt-tp-ttl">Supplier No</p>
                  <p class="tgdp-rgt-tp-txt"><%$supplier[0]->supplier_number %></p>
               </div>
               <div class="tgdp-rgt-tp-sect">
                  <p class="tgdp-rgt-tp-ttl">Supplier GST</p>
                  <p class="tgdp-rgt-tp-txt"><%$supplier[0]->gst_number %></p>
               </div>
               <div class="tgdp-rgt-tp-sect">
                  <p class="tgdp-rgt-tp-ttl">Inwarding Status</p>
                  <p class="tgdp-rgt-tp-txt"><%$inwarding_data[0]->status %></p>
               </div>
               <%if ($isMultiClient == "true")  %>
               <div class="tgdp-rgt-tp-sect">
                  <p class="tgdp-rgt-tp-ttl">Delivery Location</p>
                  <p class="tgdp-rgt-tp-txt"><%$inwarding_data[0]->delivery_unit %></p>
               </div>
               <%/if%>
               <div class="tgdp-rgt-tp-sect hide">
                  <p class="tgdp-rgt-tp-ttl">Invoice Amount</p>
                  <p class="tgdp-rgt-tp-txt"><%$inwarding_data[0]->invoice_amount %></p>
               </div>
               <div class="tgdp-rgt-tp-sect hide">
                  <p class="tgdp-rgt-tp-ttl">Software Calculated Amount</p>
                  <p class="tgdp-rgt-tp-txt"><%$inwarding_data[0]->invoice_amount %></p>
               </div>
               <div class="tgdp-rgt-tp-sect hide">
                  <p class="tgdp-rgt-tp-ttl">Invoice Amount Validate Status</p>
                  <p class="tgdp-rgt-tp-txt"><%$status %></p>
               </div>
               <div class="col-lg-12">
                  <div >
               <%if ($inwarding_data[0]->status == "accept") %>
               <button type="button" disabled class="btn btn-success mt-4" data-bs-toggle="modal"
                  data-bs-target="#exampleModalgenerate">
               Inwarding Already Accepted </button>
             
               <%else if ($is_accept_inwarding eq 'Yes') %>
               <button type="button" class="btn btn-primary mt-4 " data-bs-toggle="modal"
                  data-bs-target="#exampleModal" id="accept_inwarding_btn">
               Accept Inwarding </button>
               <%/if%>
            </div>
               </div>
               <div class="col-lg-4">
                  <div class="form-group">
                     <!-- Modal -->
                     <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered " role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title" id="exampleModalLabel">Accept </h5>
                                 <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close">
                                 </button>
                              </div>
                              <form
                                    action="<%base_url('accept_inwarding_data') %>"
                                    method="POST" id="accept_inwarding_data">
                              <div class="modal-body">
                                 
                                    <div class="row">
                                       <div class="form-group">
                                          <label> Are You Sure Want To Accept This
                                          Inwarding ?</label><span
                                             class="text-danger">*</span>
                                          <input type="hidden" name="inwarding_id"
                                             value="<%$inwarding_id %>"
                                             class="form-control">
                                          <input type="hidden" name="invoice_number"
                                             value="<%$invoice_number %>"
                                             class="form-control">
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
                     <div class="modal fade" id="exampleModalmatch" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg " role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title" id="exampleModalLabel">Match Price
                                 </h5>
                                 <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close">
                                 </button>
                              </div>
                              <div class="modal-body">
                                 <form
                                    action="<%base_url('validate_invoice_amount') %>"
                                    method="POST">
                                    <div class="row">
                                       <div class="col-lg-12">
                                          <div class="form-group">
                                             <label> Invoice Amount </label><span
                                                class="text-danger">*</span>
                                             <input type="number" step="any" name="invoice_amount"
                                                placeholder="Invoice Amount"
                                                value="" class="form-control">
                                             <input type="hidden" name="inwarding_id"
                                                value="<%$inwarding_id %>"
                                                class="form-control">
                                             <input type="hidden" name="actual_price"
                                                value="<%$actual_price %>"
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
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title" id="exampleModalLabel">Change Status
                                 </h5>
                                 <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close">
                                 </button>
                              </div>
                              <div class="modal-body">
                                 <form
                                    action="<%base_url('update_status_grn_inwarding') %>"
                                    method="POST">
                                    <div class="row">
                                       <div class="col-lg-12">
                                          <div class="form-group">
                                             <label> Are You Sure Want To Validate GRN ?
                                             </label>
                                             <input type="hidden" name="status"
                                                placeholder="" value="validate_grn"
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
      <div class="card p-0 mt-4 ">
         <div class="tabTitle">
          <h2 id="cc_sh_sys_static_field_3">
                    <span>Parts</span>
                    <span style="display:none;position:absolute;left:0;right:0;text-align:center;top: 19px;"
                        id="ajax_loader_childModule_stock_intward_details">
                        <i class="fa fa-refresh fa-spin-light fa-1x fa-fw"></i>
                    </span>

                </h2>
                <input type="text" name="reason" placeholder="Filter Search" class="form-control parts-global-seacrh" id="serarch-filter-input" fdprocessedid="bxkoib">
               
                
            </div>   
         <div class="table-responsive text-nowrap ">
            <table width="100%" border="1" cellspacing="0" cellpadding="0" class="table table-striped scrollable scrollable-seachable" style="border-collapse: collapse;" border-color="#e1e1e1" id="inwarding_details_accept_reject">
               <thead>
                  <tr>
                     <!--<th>Sr No</th>-->
                     <th style="width: 9%;">Part Number</th>
                     <th style="width: 9%;">Part Description</th>
                     <!-- <th>Tax Strucutre Code</th> -->
                     <th style="width: 6%;">UOM</th>
                     <!-- <th>Delivery Date</th> -->
                     <!-- <th>Expiry Date</th> -->
                     <!-- <th>PO QTY</th> -->
                     <!-- <th>Balance QTY</th> -->
                     <th style="width: 6%;">Price</th>
                     <th style="width: 6%;">Inwarding Qty</th>
                     <th style="width: 8%;">GRN Validation Qty</th>
                     <th style="width: 6%;">Accept Qty</th>
                     <th style="width: 6%;">Reject Qty</th>
                     <th style="width: 6%;">Remark</th>
                     <th style="width: 6%;">Submit </th>
                     <th style="width: 6%;">GRN Rejection</th>
                     <th style="width: 6%;">RM Batch No</th>
                     <th style="width: 6%;" class='text-center'>Supplier Report</th>
                     <!-- MTC Report -->
                     <th style="width: 8%;" class='text-center'>Incoming Inspection Report </th>
                     <th style="width: 6%;">Action</th>
                  </tr>
               </thead>
               <tbody>
                  <%assign var='accept_inwarding_btn' value=true%>
                  <%if ($po_parts) %>
                  <%assign var='final_po_amount' value=0 %>
                  <%assign var='i' value=1 %>
                  <%foreach from=$po_parts item=p %>
                  <%assign var='part_rate_new' value=0 %>
                  <%if (empty($p->rate)) %>
                  <%assign var='part_rate_new' value=$p->child_part_data->part_rate %>
                  <%else %>
                  <%assign var='part_rate_new' value=$p->rate %>
                  <%/if%>
                  <%assign var='total_rate' value=$part_rate_new * $p->qty %>
                  <%assign var='final_po_amount' value=$final_po_amount + $total_rate %>
                  <%if ($p->grn_details_id > 0) %>
                  <%if ($p->grn_details_id > 0) %>
                  <%assign var='data_present' value="yes" %>
                  <%else %>
                  <%assign var='data_present' value="no" %>
                  <%/if%>
                  <%if $p->grn_qty > 0%>
                  
                  <tr>
                     
                     <!--<td><%$i %></td>-->
                     <td style="width: 9%;"><%$p->child_part_data->part_number %></td>
                     <td style="width: 9%;"><%$p->child_part_data->part_description %></td>
                     <td style="width: 6%;"><%$p->uom_name %></td>
                     <td style="width: 6%;"><%$part_rate_new %></td>
                     <td style="width: 8%;"><%$p->grn_qty %></td>
                     <td style="width: 6%;"><%$p->verified_qty %></td>
                     <%if ((empty($p->accept_qty) && $p->accept_qty != 0 && ($p->reject_qty) > 0) || ($p->accept_qty == 0 && $p->reject_qty == 0)) %>

                     <td style="width: 6%;">
                        <form action="<%base_url('update_grn_qty_accept_reject') %>"
                           method="post" class="update_grn_qty_accept_reject update_grn_qty_accept_reject<%$p->part_id %> custom-form" id="update_grn_qty_accept_reject<%$p->part_id %>">
                           <div class="form-group">
                            <label class="form-label" style="display: none;">Accept Qty</label>
                           <input type="text"  data-min="0" value="" id="searchTxt"
                              step="any"  data-max="<%$p->verified_qty %>"
                              placeholder="Accept Qty" name="accept_qty" class="form-control onlyNumericInput required-input">
                           <input type="hidden"
                              value="<%$p->qty %>"
                              placeholder="GRN Validation Qty4" name="privious_qty"
                              class="form-control">
                           <input type="hidden" name="grn_details_id"
                              value="<%$p->grn_details_id %>"
                              class="form-control">
                           <input type="hidden" placeholder="Inwarding Qty"
                              name="part_rate" value="<%$part_rate_new %>"
                              class="form-control">
                           <input type="hidden" placeholder="Inwarding Qty" name="tax_id"
                              value="<%$p->tax_id %>" class="form-control">
                           <input type="hidden" placeholder="Inwarding Qty"
                              name="verified_qty"
                              value="<%$p->verified_qty %>"
                              class="form-control">
                           <input type="hidden" placeholder="Inwarding Qty"
                              name="part_id" value="<%$p->part_id %>"
                              class="form-control">
                           <input type="hidden" name="invoice_number"
                              value="<%$invoice_number %>" class="form-control">
                           <input type="hidden" name="deliveryUnit"
                              value="<%$inwarding_data[0]->delivery_unit %>" class="form-control">
                              </div>
                           <%assign var='accept_inwarding_btn' value=false%>
                           <%else %>
                     <td style="width: 6%;">
                     <%$p->accept_qty %>
                     <%/if%>
                     </td>
                     <td style="width: 6%;">
                     <%if (empty($p->reject_qty) && empty($p->accept_qty)) %>
                     <%assign var='accept_inwarding_btn' value=false%>
                     <div class="form-group">
                     <label class="form-label" style="display: none;">Required Qty</label>
                     <input type="text"  data-min="0" value="" 
                                                        step="any"  
                                                        placeholder="Reject Qty" name="reject_qty" class=" required-input form-control onlyNumericInput">
                     </div>
                     <%else %>
                     <%$p->reject_qty %>
                     <%/if%>
                     </td>
                     <td style="width: 6%;">
                     <%if ((empty($p->accept_qty) && $p->accept_qty != 0 && ($p->reject_qty) > 0) || ($p->accept_qty == 0 && $p->reject_qty == 0)) %>
                     <input type="text" name="remark" placeholder="Remark"
                        class="form-control">
                     <%else %>
                     <%display_no_character($p->remark)%>
                     <%/if%>
                     </td>
                     <td style="width: 6%;">
                     <%if (empty($p->accept_qty) && $p->accept_qty != 0 && ($p->reject_qty) > 0) || ($p->accept_qty == 0 && $p->reject_qty == 0) %>
                     <button type="submit" class="btn btn-info">Submit</button>
                     </form>
                     <%else%>
                        <%display_no_character()%>
                     <%/if%>
                     </td>
                     <td style="width: 6%;">
                        <%if ($p->rejection_flow_data) %>
                        <a class=""
                           href="<%base_url('create_debit_note/') %><%$p->rejection_flow_data->id %>" title="Download
                        Debit Note">
                      <i class="ti ti-book-download"></i></a>
                        
                        <a class=""
                           href="<%base_url('documents/') %><%$p->rejection_flow_data->debit_note %>" title="Download Document"
                           download><i class="ti ti-file-download"></i> </a>
                        <%else %>
                        <%if ($p) %>
                        <%if ($p->reject_qty != 0) %>
                        <a type="button" class=" float-left"
                           data-bs-toggle="modal" data-bs-target="#exampleModal123<%$i %>" title="Add Rejection Debit Note">
                        
                        <i class="ti ti-clipboard-plus"></i>
                        </a>
                        <%/if%>
                        <%/if%>
                        <%/if%>
                        <div class="modal fade" id="exampleModal123<%$i %>"
                           tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                           aria-hidden="true">
                           <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                       aria-label="Close">
                                    </button>
                                 </div>
                                  <form
                                       action="<%base_url('add_rejection_flow') %>"
                                       method="POST" enctype='multipart/form-data' class="add_rejection_flow add_rejection_flow<%$i %> custom-form" id="add_rejection_flow<%$i %>">
                                 <div class="modal-body">
                                   
                                       <div class="row">
                                          <div class="col-lg-12">
                                             <div class="form-group">
                                                <label for="po_num">Selected Part Number
                                                / Description / Stock </label><span
                                                   class="text-danger">*</span>
                                                <input type="text" class="form-control required-input"
                                                   value="<%$p->child_part_data->part_number %>"
                                                   name="" readonly >
                                                <input type="hidden"
                                                   value="<%$p->part_id %>"
                                                   name="part_id" readonly
                                                   required="required" id="">
                                             </div>
                                             <div class="form-group">
                                                <label for="po_num">Selected
                                                Supplier</label><span
                                                   class="text-danger">*</span>
                                                <input type="text" readonly
                                                   value="<%$supplier[0]->supplier_name %>"
                                                   class="form-control">
                                                <input type="hidden" readonly
                                                   value="<%$supplier[0]->id %>"
                                                   name="supplier_id"
                                                   class="form-control">
                                             </div>
                                             <div class="form-group">
                                                <label for="po_num">Reason <span
                                                   class="text-danger">*</span></label>
                                                <input type="text" name="reason"
                                                    placeholder="Reason"
                                                   class="form-control required-input">
                                                <input type="hidden" name="type"
                                                   value="grn_rejection" required
                                                   placeholder="Reason"
                                                   class="form-control">
                                             </div>
                                             <div class="form-group">
                                                <label for="po_num">Upload Rejection
                                                Document <span
                                                   class="text-danger">*</span></label>
                                                <input type="file"
                                                   name="uploading_document" 
                                                   class="form-control required-input" >
                                             </div>
                                             <div class="form-group">
                                                <label for="po_num">Rejection Qty <span
                                                   class="text-danger">*</span></label>
                                                <input type="number" readonly name="qty"
                                                   value="<%$p->reject_qty %>"
                                                   step="any" placeholder="Qty"
                                                   name="qty" required
                                                   class="form-control">
                                                <input type="hidden" name="po_number"
                                                   readonly
                                                   value="<%$new_po[0]->id %>"
                                                   class="form-control">
                                             </div>
                                             <div class="form-group">
                                                <label for="po_num">Remark
                                                </label>
                                                <input type="text" name="remark"
                                                    placeholder="Remark"
                                                   class="form-control ">
                                             </div>
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
                     </td>
                     <td style="width: 6%;"><%$p->rm_batch_no %></td>
                     <!-- Supplier/MTC Report -->
                     <td style="width: 8%;" class='text-center'>

                        <%if ($p->mtc_report != "") %>
                        <a download href="<%base_url('documents/mtc/') %><%$p->mtc_report %>" id="" class=" remove_hoverr "><i class="ti ti-download"></i></a>
                        <%else%>
                           <%display_no_character()%>
                        <%/if%>
                     </td>
                     <td class='text-center' style="width: 6%;" class='text-center'>
                        <a class="" title="Raw Material Inspection"
                           href="<%base_url('raw_material_inspection_inwarding/') %><%$p->child_part_data->id %>/<%$new_po[0]->id %>/<%$supplier[0]->id %>/<%$inwarding_data[0]->id %>/<%$p->accept_qty %>/<%$p->reject_qty %>/<%$p->part_id %>">
                        <i class="ti ti-file-analytics"></i>
                        </a>
                     </td>
                     <td style="width: 6%;">
                        <button type="button" class='text-center no-btn' data-bs-toggle="modal"
                           data-bs-target="#editRM<%$i %>">
                        <i class="ti ti-edit"></i>
                        </button>
                        <div class="modal fade" id="editRM<%$i %>" tabindex="-1"
                           role="dialog" aria-labelledby="exampleModalLabel"
                           aria-hidden="true">
                           <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Update
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                       aria-label="Close">
                                    </button>
                                 </div>
                                 <div class="modal-body">
                                    <form
                                       action="<%base_url('update_rm_batch_mtc_report') %>"
                                       method="POST" class="update_rm_batch_mtc_report custom-form update_rm_batch_mtc_report<%$i %>" enctype="multipart/form-data" id="update_rm_batch_mtc_report<%$i %>">
                                       <div class="form-group">
                                          <label for="">RM Batch No<span
                                             class="text-danger">*</span></label>
                                          <input  value="<%$p->rm_batch_no %>"
                                             type="text" class="form-control required-input"
                                             name="rm_batch_no">
                                          <input type="hidden" name="grn_details_id"
                                             value="<%$p->grn_details_id %>"
                                             class="form-control ">
                                       </div>
                                       <div class="form-group">
                                          <label for="mtcReportFile">MTC Report<span
                                             class="text-danger">*</span></label>
                                          <input  type="file" name="mtc_report" class="form-control required-input" id="mtcReportFile" aria-describedby="mtcReportFileHelp" placeholder="Select File">
                                       </div>
                                 </div>
                                 <div class="modal-footer">
                                 <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Close</button>
                                 <button type="submit" class="btn btn-primary">Save
                                 Changes</button>
                                 </form>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </td>
                  </tr>
                  <%/if%>
                  <%assign var='i' value=$i+1 %>
                  <%/if%>
                  <%/foreach%>
                  <%/if%>
               </tbody>
            </table>
            </div>
         </div>
      </div>
      <!--/ Responsive Table -->
   </div>
   <!-- /.col -->
   <div class="content-backdrop fade"></div>
</div>
</div>
<style type="text/css">



</style>
<script type="text/javascript">
   var base_url = <%$base_url|@json_encode%>;
   var accept_inwarding_btn = <%$accept_inwarding_btn|@json_encode%>;
</script>

<script src="<%$base_url%>public/js/quality/inwarding_details_accept_reject.js"></script>
