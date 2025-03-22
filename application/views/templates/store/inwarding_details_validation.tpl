
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
            <em >GRN QTY Validation</em></a>
            
              </h1>
              <br>
              <span >GRN QTY Validation Details</span>
            </div>
          </nav>
          <!-- <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Basic Tables</h4> -->

          <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5">
           

            <a class="btn btn-seconday" href="<%base_url('grn_validation') %>">
              <i class="ti ti-arrow-left" title="Back"></i></a>

            </div>



            <!-- Main content -->
            <div class="card p-0 mt-4">
              <div class="">
                <div class="row">
                  <div class="col-12">

                    <div class="">
                      <div class="card-header">
                        <div class="row">
                          <div class="tgdp-rgt-tp-sect">
                              <p class="tgdp-rgt-tp-ttl">GRN Number</p>
                              <p class="tgdp-rgt-tp-txt">
                              <%$inwarding_data[0]->grn_number %>
                              </p>
                          </div>
                          <div class="tgdp-rgt-tp-sect">
                              <p class="tgdp-rgt-tp-ttl">PO Number</p>
                              <p class="tgdp-rgt-tp-txt">
                              <%$new_po[0]->po_number %>
                              </p>
                          </div>
                          <div class="tgdp-rgt-tp-sect">
                              <p class="tgdp-rgt-tp-ttl">PO Date</p>
                              <p class="tgdp-rgt-tp-txt">
                              <%defaultDateFormat($new_po[0]->po_date) %>
                              </p>
                          </div>
                          <div class="tgdp-rgt-tp-sect">
                              <p class="tgdp-rgt-tp-ttl">PO Status</p>
                              <p class="tgdp-rgt-tp-txt">
                              <%if ($new_po[0]->status == 'accpet') %>Released <%else %><%$new_po[0]->status %><%/if%>
                              </p>
                          </div>
                          <div class="tgdp-rgt-tp-sect">
                              <p class="tgdp-rgt-tp-ttl">Supplier Name</p>
                              <p class="tgdp-rgt-tp-txt">
                              <%$supplier[0]->supplier_name %>
                              </p>
                          </div>
                          <div class="tgdp-rgt-tp-sect">
                              <p class="tgdp-rgt-tp-ttl">Supplier No</p>
                              <p class="tgdp-rgt-tp-txt">
                              <%$supplier[0]->supplier_number %>
                              </p>
                          </div>
                          <div class="tgdp-rgt-tp-sect">
                              <p class="tgdp-rgt-tp-ttl">Supplier GST</p>
                              <p class="tgdp-rgt-tp-txt">
                              <%$supplier[0]->gst_number %>
                              </p>
                          </div>
                          <div class="tgdp-rgt-tp-sect">
                              <p class="tgdp-rgt-tp-ttl">Inwarding Status</p>
                              <p class="tgdp-rgt-tp-txt">
                              <%$inwarding_data[0]->status %>
                              </p>
                          </div>
                          <%if ($isMultiClient == "true") %>
                          <div class="tgdp-rgt-tp-sect">
                              <p class="tgdp-rgt-tp-ttl">Inwarding StatusT</p>
                              <p class="tgdp-rgt-tp-txt">
                              <%$inwarding_data[0]->delivery_unit %>
                              </p>
                          </div>
                          <%/if%>
                          <div class="tgdp-rgt-tp-sect">
                              <p class="tgdp-rgt-tp-ttl">Inwarding Amount</p>
                              <p class="tgdp-rgt-tp-txt">
                              <%$inwarding_data[0]->invoice_amount %>
                              </p>
                          </div>
                          <div class="tgdp-rgt-tp-sect">
                              <p class="tgdp-rgt-tp-ttl">Invoice Amount Validation Status</p>
                              <p class="tgdp-rgt-tp-txt">
                              <%$status %>
                              </p>
                          </div>
                          <div class="col-lg-12">
                          <%if ($inwarding_data[0]->status == "validate_grn") %>
                      <button type="button" disabled class="btn btn-success mt-4"
                      data-bs-toggle="modal">
                      GRN Already Validated</button>
                      <%else %>
                      <%if ($j === $i) %>
                      <button type="button" class="btn btn-primary mt-4" data-bs-toggle="modal"
                      data-bs-target="#exampleModalgenerate">
                      Validate GRN </button>
                      <%/if%>
                      <%/if%>
                       </div>
                      
                     

                        <div class="col-lg-4">
                          <div class="form-group">
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg " role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Accept This
                                    Inwarding
                                  </h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal"
                                  aria-label="Close">

                                </button>
                              </div>
                              <div class="modal-body">
                                <form
                                action="<%base_url('accept_inwarding_data') %>"
                                method="POST">
                                <div class="row">
                                  <div class="col-lg-12">
                                    <div class="form-group">
                                      <label> Are You Sure Want To Accept This
                                        Inwarding ? This Data can't be changed
                                        once it's Submit</label><span
                                        class="text-danger">*</span>
                                        <input type="hidden" name="inwarding_id"
                                        value="<%$inwarding_id %>"
                                        class="form-control">
                                        <input type="hidden" name="invoice_number"
                                        value="<%$invoice_number %>"
                                        class="form-control">
                                      </div>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save
                                      changes</button>
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
                                    <input type="number" name="invoice_amount"
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
                                  changes</button>
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
                            <h5 class="modal-title" id="exampleModalLabel">Validate GRN
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close">

                          </button>
                        </div>
                        <div class="modal-body">
                          <form
                          action="<%base_url('update_status_grn_inwarding') %>"
                          method="POST" id="update_status_grn_inwarding">
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
                              changes</button>
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
          <!-- /.row -->
        </div>
        <div class="card p-0 mt-4 ">
        <div class="tabTitle position-relative">
        <h2 id="cc_sh_sys_static_field_3" style="    width: 98%;
">
            <span class="d-inline-block mt-3">
             Parts
            
            </span>
            <div class="  d-grid gap-2 d-md-flex justify-content-md-end " style="    float: inline-end;">

        <button class="btn btn-seconday" type="button" id="downloadCSVBtn" title="Download CSV"><i class="ti ti-file-type-csv"></i></button>
        <button class="btn btn-seconday" type="button" id="downloadPDFBtn" title="Download PDF"><i class="ti ti-file-type-pdf"></i></button>
        
         
      </div>
            
        </h2>
        
    </div>
        <table class="table table-striped w-100" id="inwarding_details_tbl">
        <thead>
          <tr>
             <!--<th>Sr No</th> -->
            <th>Part Number</th>
            <th>Part Description</th>
            <!-- <th>Tax Strucutre Code</th> -->
            <th>UOM</th>
            <!-- <th>Delivery Date</th> -->
            <!-- <th>Expiry Date</th> -->
            <th>PO QTY</th>
            <th>Balance QTY</th>
            <th>Price</th>
            <th>Inwarding Qty</th>
            <th>GRN Validation Qty</th>
            <th>Submit </th>
            <th>MDR</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <%assign var="i" value=1%>
          <%assign var="j" value=1%>
          <%if ($po_parts) %>
          <%assign var="final_po_amount" value=0%>
          <%foreach from=$po_parts item=p %>
          <%assign var="child_part" value=$p->child_part%>
          <%assign var="child_part_data" value=$p->child_part_data%>
          <%assign var="uom_data" value=$p->uom_data%>
          <%assign var="part_rate_new" value=0%>
          <%if (empty($p->rate)) %>
          <%assign var="part_rate_new" value=$child_part_data[0]->part_rate%>
          <%else %>
          <%assign var="part_rate_new" value=$p->rate%>
          <%/if%>
          <%assign var="total_rate" value=$part_rate_new * $p->qty%>
          <%assign var="final_po_amount" value=$final_po_amount + $total_rate%>
          <%assign var="grn_details_data" value=$p->grn_details_data%>
          <%assign var="rejection_flow_data" value=$p->rejection_flow_data%>
          <%if ($grn_details_data) %>
          <%if ($grn_details_data) %>
          <%assign var="data_present" value='yes'%>
          <%else %>
          <%assign var="data_present" value='no'%>
          <%/if%>
          <tr>
             <!-- <td><%$i %></td> -->
            <td><%$child_part[0]->part_number %></td>
            <td><%$child_part[0]->part_description %></td>
            <td><%$uom_data[0]->uom_name %></td>
            <td><%$p->qty %></td>
            <td><%$p->pending_qty %></td>
            <td><%$part_rate_new %></td>
            <td>
              <%if ($inwarding_data[0]->status == "accepted") %>
              <%$grn_details_data[0]->qty %>
              <%else if ($data_present == "yes") %>
              <%$grn_details_data[0]->qty %>
              <%else %>
              <form action="javascript:void(0);"  method="post" class="add_grn_qty_form add_grn_qty_form_<%$p->part_id %> custom-form" data-id="<%$p->part_id %>">
                <input type="text" data-max="<%$p->pending_qty %>"
                placeholder="Inwarding Qty2" name="qty" step="any"
                class="form-control required-input onlyNumericInput">
                <input type="hidden" name="inwarding_id"
                value="<%$inwarding_id %>" class="form-control">
                <input type="text" placeholder="Inwarding Qty"
                name="new_po_id" value="<%$new_po_id %>"
                class="form-control">
                <input type="hidden" placeholder="Inwarding Qty"
                name="part_id" value="<%$p->part_id %>"
                class="form-control">
                <input type="hidden" placeholder="Inwarding Qty"
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
                name="part_rate" value="<%$part_rate_new %>"
                class="form-control">
                <input type="hidden" placeholder="Inwarding Qty" name="tax_id"
                value="<%$p->tax_id %>" class="form-control">
                <input type="hidden" placeholder="Inwarding Qty"
                name="loading_unloading"
                value="<%$new_po[0]->loading_unloading %>"
                class="form-control">
                <input type="hidden" placeholder="Inwarding Qty"
                name="loading_unloading_gst"
                value="<%$new_po[0]->loading_unloading_gst %>"
                class="form-control">
                <input type="hidden" placeholder="Inwarding Qty"
                name="freight_amount"
                value="<%$new_po[0]->freight_amount %>"
                class="form-control">
                <input type="hidden" placeholder="Inwarding Qty"
                name="freight_amount_gst"
                value="<%$new_po[0]->freight_amount_gst %>"
                class="form-control">
                <%/if%>
              </td>
              <td>
                <%if (empty($grn_details_data[0]->verified_qty)) %>
                <form action="javascript:void(0);"  method="post"  class=" update_grn_qty_form_<%$p->part_id %> custom-form"  >
                <div class="form-group">
                <label for="tool_number" style="display:none ;">GRN Validation Qty </label>
                <input style="width: 200px ;" type="text"
                data-max="<%$grn_details_data[0]->qty %>"
                step="any" placeholder="Qty" name="verified_qty"
                class="form-control input-group-sm required-input onlyNumericInput">
              </div>
                 
                  <input type="hidden"
                  value="<%$grn_details_data[0]->qty %>"
                  placeholder="GRN Validation Qty" name="privious_qty"
                  class="form-control">
                  <input type="hidden" name="grn_details_id"
                  value="<%$grn_details_data[0]->id %>"
                  class="form-control">
                  <input type="hidden" placeholder="Inwarding Qty"
                  name="part_rate" value="<%$part_rate_new %>"
                  class="form-control">
                  <input type="hidden" placeholder="Inwarding Qty" name="tax_id"
                  value="<%$p->tax_id %>" class="form-control">
                  <%else %>
                  <%$grn_details_data[0]->verified_qty %>
                  <%/if%>
                </td>
                <td>
                  <%assign var='diff' value= (float)$grn_details_data[0]->qty - (float)$grn_details_data[0]->verified_qty%>
                  <%if (empty($grn_details_data[0]->verified_qty) || $grn_details_data[0]->verified_qty == 0) %>
                  <button type="submit" class="btn btn-info update_grn_qty_form" data-id="<%$p->part_id %>">Submit</button>
                </form>
                <%else if ($diff > 0) %>
                <%display_no_character()%>
                <%if ($rejection_flow_data) %>
                <%assign var='j' value=$j+1%>
                <%/if%>
                <%else %>
                <%assign var='j' value=$j+1%>
                <%display_no_character()%>
                <%/if%>
              </td>
              <td>
                <%if ($rejection_flow_data) %>
                <a class=""
                href="<%base_url('create_debit_note/') %><%$rejection_flow_data[0]->id %>" title="Download Debit Note"><i class="ti ti-book-download"></i></a>
                <a class=""
                href="<%base_url('documents/') %><%$rejection_flow_data[0]->debit_note %>" title="Download Uploaded Ack"
                download> <i class="ti ti-file-download"></i></a>
                <%else %>
                <%if ($grn_details_data) %>
                <%if ($grn_details_data[0]->qty != $grn_details_data[0]->verified_qty) %>
                <button type="button" class="btn btn-danger float-left"
                data-bs-toggle="modal" data-bs-target="#exampleModal123<%$i %>">
                Add MDR
              </button>
              <%else %>
              Qty Matched
              <%/if%>
              <%/if%>
              <%/if%>
              <div class="modal fade" id="exampleModal123<%$i %>"
                tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Add MDR </h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal"
                      aria-label="Close">
                    </button>
                  </div>
                  <div class="modal-body">
                    <form class="inwarding_details_validation inwarding_details_validation_<%$child_part[0]->id %> custom-form"
                    action="javascript:void(0)"
                    data-id="<%$child_part[0]->id %>"
                    method="POST" enctype='multipart/form-data'>
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="form-group">
                          <label for="po_num">Selected Part Number
                            / Description / Stock </label><span
                            class="text-danger">*</span>
                            <input type="text" class="form-control required-input"
                            value="<%$child_part_data[0]->part_number %>"
                            name="" readonly
                            id="">
                            <input type="hidden"
                            value="<%$child_part[0]->id %>"
                            name="part_id" readonly
                            required="required" id="">
                          </div>
                          <div class="form-group">
                            <label for="po_num">Selected
                              Supplier</label><span
                              class="text-danger">*</span>
                              <input type="text" readonly
                              value="<%$supplier[0]->supplier_name %>"
                              class="form-control required-input">
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
                                value="MDR" required
                                placeholder="Reason"
                                class="form-control">
                              </div>
                              <div class="form-group">
                                <label for="po_num">Upload MDR TPT ACK
                                  <span
                                  class="text-danger">*</span></label>
                                  <input type="file"
                                  name="uploading_document"
                                  class="form-control required-input">
                                </div>
                                <div class="form-group">
                                  <label for="po_num">MDR Qty <span
                                    class="text-danger">*</span></label>
                                    <input type="number" readonly name="qty"
                                    value="<%$grn_details_data[0]->qty - $grn_details_data[0]->verified_qty %>"
                                    step="any" placeholder="Qty"
                                    name="qty"
                                    class="form-control required-input">
                                    <input type="hidden" name="po_number"
                                    readonly
                                    value="<%$new_po[0]->po_number %>"
                                    class="form-control">
                                    <input type="hidden"
                                    placeholder="Inwarding Qty"
                                    name="grn_number"
                                    value="<%$inwarding_data[0]->grn_number %>"
                                    class="form-control">
                                  </div>
                                  <div class="form-group">
                                    <label for="po_num">Remark <span
                                      class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="remark"
                                    placeholder="Remark"
                                    class="form-control required-input">
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary"
                              data-bs-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-primary">Save
                                changes</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </td>
                    <td>
                       <%if ( !$rejection_flow_data && $grn_details_data[0]->verified_qty > 0 && $inwarding_data[0]->status == 'generate_grn') %>
                       <a type="button" class=""
                          data-bs-toggle="modal" data-bs-target="#exampleModaledit<%$i %>" title="Edit">
                       <i class="ti ti-edit"></i>
                       </a>
                       <div class="modal fade" id="exampleModaledit<%$i %>"
                          tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                          aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered" role="document">
                             <div class="modal-content">
                                <div class="modal-header">
                                   <h5 class="modal-title" id="exampleModalLabel">Update </h5>
                                   <button type="button" class="btn-close" data-bs-dismiss="modal"
                                      aria-label="Close">
                                   </button>
                                </div>
                                <div class="modal-body">
                                   <form
                                      action="<%base_url('edit_grn_qty_val') %>"
                                      method="POST" enctype='multipart/form-data' class="edit_grn_qty_val<%$i %> edit_grn_qty_val custom-form" id="edit_grn_qty_val<%$i %>">
                                      <input type="hidden" value="<%$grn_details_data[0]->id %>" name="grn_details_id" readonly required="required" >
                                      <div class="row">
                                         <div class="col-lg-12">
                                            <div class="form-group">
                                               <label for="po_num">Part Number </label>
                                               <input type="text" class="form-control"
                                                  value="<%$child_part[0]->part_number%>"
                                                  readonly name="part_number"  
                                                  >
                                            </div>
                                         </div>
                                         <div class="col-lg-12">
                                            <div class="form-group">
                                               <label for="po_num">GRN Validation Qty </label><span
                                                  class="text-danger">*</span>
                                               <input type="text" class="form-control onlyNumericInput required-input"
                                                  value="<%$grn_details_data[0]->verified_qty%>"
                                                  name="grn_details_validate_qty" data-min='1'
                                                  >
                                            </div>
                                         </div>
                                      </div>
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                   data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                                </form>
                             </div>
                          </div>
                       </div>
                       <%/if%>
                    </td>
                  </tr>
                  <%assign var='i' value=$i+1%>
                  <%/if%>
                  <%/foreach%>
                  <%/if%>
                
              </table>
        </div>

      </div>
    </div>

    <!-- /.col -->


    <div class="content-backdrop fade"></div>
  </div>



  <script type="text/javascript">
    var base_url = <%$base_url|@json_encode%>
  </script>
  <script src="<%$base_url%>public/js/store/inwarding_details_validation.js"></script>
