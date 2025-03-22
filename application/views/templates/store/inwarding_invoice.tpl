<%assign var="isMultiClient" value=$session_data['isMultipleClientUnits']%>
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
          <span >Inwarding PO Invoice Numbers</span>
        </div>
      </nav>
      <!-- <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Basic Tables</h4> -->

      <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5">
       
        <%if $flag != 0%>
        <button type="button" class="btn btn-seconday" title="Add Invoice Number" data-bs-toggle="modal" data-bs-target="#exampleModal">
          <i class="ti ti-plus"></i></button>
        <%/if%>
          <a class="btn btn-seconday" type="button" href="<%base_url('inwarding') %>"><i class="ti ti-arrow-left" title="Back To Item Part List"></i></a>
          <!-- <a class="btn btn-dark" href="<%base_url('inwarding') %>">Back</a> -->
        <!-- <button class="btn btn-seconday" type="button"><i class="ti ti-refresh reset-filter"></i></button> -->
      </div>

      <!-- Modal -->
      <div class="modal fade" id="exampleModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add Invoice Number</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

              </button>
            </div>
            <div class="modal-body">
              <form action="javascript:void(0)" method="POST" class="add_invoice_number custom-form">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="form-group">
                      <label for="tool_number">Invoice Number </label><span class="text-danger">*</span>
                      <input type="text" name="invoice_number"  class="form-control required-input"  placeholder="Enter Invoice Number">
                      <input type="hidden" name="new_po_id" value="<%$new_po_id %>"  class="form-control"  placeholder="Enter Invoice Number">
                    </div>
                    <div class="form-group">
                      <label for="tool_number">Invoice Date </label><span class="text-danger">*</span>
                      <input type="date" name="invoice_date" max="<%date('Y-m-d') %>"  class="form-control required-input"  placeholder="Enter Invoice Number">
                    </div>
                    <div class="form-group">
                      <label for="tool_number">GRN Date </label><span class="text-danger">*</span>
                      <input type="date" name="grn_date" readonly value="<%date('Y-m-d') %>"  class="form-control required-input"  placeholder="Enter Invoice Number">
                    </div>
                    <div class="form-group">
                      <label for="">Vehicle No.</label>
                      <input type="text"
                      placeholder="Enter Vehicle No"
                      value=""
                      name="vehicle_number"
                      pattern="^([A-Z|a-z|0-9]{4,20})"
                      oninvalid="this.setCustomValidity('Please enter a valid vehicle number in the format XX00XX0000')"
                      onchange="this.setCustomValidity('')"
                      class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="tool_number">Transporter ID </label>
                      <input type="text" name="transporter" value="" class="form-control "  placeholder="Enter transporter">
                    </div>
                    <!-- <php if($isMultiClient == "true") { ?>
                    <div class="form-group">
                    <label>Delivery Location</label><span class="text-danger">*</span><br>
                    <select name="deliveryUnit" required class="form-control select2" id="">
                    <option value="">Select</option>
                    <?php
                    foreach ($client_list as $cl) {
                    ?>
                    <option value="<?php echo $cl->client_unit ?>">
                    <?php echo $cl->client_unit; ?>
                  </option>
                  <?php
                }
                ?>
              </select>
            </div>
            <php } ?> -->
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

      <!-- Main content -->
      <div class="card p-0 mt-4">
      
        <div class="table-responsive text-nowrap">
          <table width="100%" border="1" cellspacing="0" cellpadding="0" class="table table-striped scrollable" style="border-collapse: collapse;" border-color="#e1e1e1" id="view_add_challan">

              <thead>
                <tr>
                  <!-- <th>Sr No</th> -->
                  <th>Invoice Number</th>
                  <th>Invoice Date</th>
                  <th>GRN Date</th>
                  <th>GRN Time</th>
                  <th>GRN Number </th>
                  <th>Vehicle No</th>
                  <th>Transporter</th>
                  <%if ($isMultiClient == "true") %>
                    <th>Delivery Location</th>
                  <%/if%>
                  <th class="text-center">View Details</th>
                  <th class="text-center">Action</th>

                </tr>
              </thead>
              <tbody >
                <%assign var='i' value=1%>
                <%if ($inwarding_data) %>
                <%foreach from=$inwarding_data item=t %>
                <%assign var='grn_number' value=$t->grn_number %>
                <tr>
                  <!-- <td><%$i %></td> -->
                  <td><%$t->invoice_number %></td>
                  <td><%$t->invoice_date %></td>
                  <td><%$t->grn_date %></td>

                  <%if ($t->created_dttm !=null) %>
                  <%assign var='dateTime' value= convertDateTime($t->created_dttm) %>
                  <%assign var='time' value= $dateTime->format('H:i:s') %>
                  <%else %>
                  <%assign var='time' value='Not available' %>
                  <%/if%>
                  <td><%$time %></td>
                  <td><%$grn_number %></td>
                  <td><%$t->vehicle_number %></td>
                  <td><%$t->transporter %></td>
                  <%if ($isMultiClient == "true") %>
                  <td><%$t->delivery_unit %></td>
                  <%/if%>
                  <td class="text-center">
                    <a href="<%base_url('inwarding_details/') %><%$t->id %>/<%$new_po_id %>" class="btn btn-primary" href="">Inwarding Details</a>
                  </td>
                  <td class="text-center">
                    <%if ($t->grn_number == '') %>
                          <a
                              type="button"
                              class=""
                              data-bs-toggle="modal"
                              data-bs-target="#exampleModal123<%$t->id %>"
                              title="Edit">
                              <i class="ti ti-edit"></i>
                          </a>
                          <a
                              type="button"
                              class=""
                              data-bs-toggle="modal"
                              data-bs-target="#exampleModaldelete<%$t->id %>"
                              title="Delete">
                              <i class="ti ti-trash"></i>
                          </a>
                    <%/if%>
                          <div
                              class="modal fade"
                              id="exampleModal123<%$t->id %>"
                              tabindex="-1"
                              role="dialog"
                              aria-labelledby="exampleModalLabel"
                              aria-hidden="true">
                              <div class="modal-dialog  modal-dialog-centered" role="document">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLabel">Update
                                          </h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                          </button>
                                      </div>
                                      <form
                                              action="<%base_url('update_inwarding_details') %>"
                                              method="POST"
                                              enctype='multipart/form-data' class="update_inwarding_details update_inwarding_details<%$t->id %> custom-form" id="update_inwarding_details<%$t->id %>">
                                      <div class="modal-body">
                                          
                                              <input
                                                  type="hidden"
                                                  value="<%$t->id %>"
                                                  name="invoice_id"
                                                  readonly="readonly"
                                                  required="required">
                                              <input
                                                  type="hidden"
                                                  value="<%$new_po_id %>"
                                                  name="new_po_id"
                                                  readonly="readonly"
                                                  required="required">

                                              <div class="row">
                                                  <div class="col-lg-12">
                                                      <div class="form-group">
                                                          <label for="po_num">Invoice Number
                                                          </label>
                                                          <span class="text-danger">*</span>
                                                          <input
                                                              type="text"
                                                              class="form-control required-input"
                                                              value="<%$t->invoice_number %>"
                                                              name="invoice_number"
                                                              >

                                                      </div>
                                                  </div>
                                                  <div class="col-lg-12">
                                                      <div class="form-group">
                                                          <label for="po_num">Invoice Date</label>
                                                          <span class="text-danger">*</span>
                                                          <input
                                                              type="date"
                                                              class="form-control required-input"
                                                              value="<%$t->invoice_date %>"
                                                              name="invoice_date"
                                                              required="required">
                                                      </div>
                                                  </div>
                                              </div>

                                          </div>
                                          <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                              <button type="submit" class="btn btn-primary">Save Changes</button>
                                          </div>
                                      </form>

                                  </div>

                              </div>
                          </div>
                          <div
                              class="modal fade"
                              id="exampleModaldelete<%$t->id %>"
                              tabindex="-1"
                              role="dialog"
                              aria-labelledby="exampleModalLabel"
                              aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered" role="document">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLabel">Update
                                          </h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                          
                                          </button>
                                      </div>
                                      <div class="modal-body">
                                          <form
                                              action="<%base_url('delete_invoice') %>"
                                              method="POST"
                                              enctype='multipart/form-data' class="delete_invoice delete_invoice<%$t->id %> custom-form" id="delete_invoice<%$t->id %>">
                                              <input
                                                  type="hidden"
                                                  value="<%$t->id %>"
                                                  name="invoice_id"
                                                  readonly="readonly"
                                                  required="required">
                                              <input
                                                  type="hidden"
                                                  value="<%$new_po_id %>"
                                                  name="new_po_id"
                                                  readonly="readonly"
                                                  required="required">
                                              <input
                                                  type="hidden"
                                                  value="<%$t->invoice_number %>"
                                                  name="invoice_number"
                                                  readonly="readonly"
                                                  required="required">
                                              <strong>Are you sure want to delete this invoice?</strong>
                                          </div>
                                          <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                              <button type="submit" class="btn btn-primary">Yes</button>
                                          </div>
                                      </form>

                                  </div>

                              </div>
                          </div>

                  </td>
                </tr>
                <%assign var='i' value=$i+1%>
                <%/foreach%>
                <%else%>
                <td colspan="9" class="text-center">No Data Found</td>
                <%/if%>
              </tbody>
            </table>


          
        </div>
        
      </div>
      <div class="card p-0 mt-4">
      <div class="tabTitle position-relative">
                <h2 id="cc_sh_sys_static_field_3" style="    width: 98%;
">
                    <span class="d-inline-block mt-3">
                    PO Parts
                    
                    </span>
                    <div class="  d-grid gap-2 d-md-flex justify-content-md-end " style="    float: inline-end;">

                <button class="btn btn-seconday" type="button" id="downloadCSVBtn" title="Download CSV"><i class="ti ti-file-type-csv"></i></button>
                <button class="btn btn-seconday" type="button" id="downloadPDFBtn" title="Download PDF"><i class="ti ti-file-type-pdf"></i></button>
                
                 
              </div>
                    
                </h2>
                
            </div>
    
      <table id="inwardin_product" class="table table-striped">
      <thead>
        <tr>
          <!--<th>Sr No</th> -->
          <th>Part Number</th>
          <th>Part Description</th>
          <th>Balance QTY </th>
        </tr>
      </thead>

      <tbody>
        <%assign var='flag' value=0%>
        <%if ($po_parts) %>
        <%assign var='final_po_amount' value=0%>
        <%assign var='i' value=1%>
        <%foreach from=$po_parts item=p %>
        <%assign var='qty' value=0%>
        <%assign var='qty' value=$p->pending_qty%>
        <%assign var='flag' value=$flag + $qty%>
        <tr>
          <!--<td><%$i %></td>-->
          <td><%$p->child_part_data->part_number %></td>
          <td><%$p->child_part_data->part_description %></td>
          <td><%$qty %></td>
        </tr>
        <%assign var='i' value=$i+1%>
        <%/foreach%>
        <%/if%>
      </tbody>
    </table>
      </div>
      <!--/ Responsive Table -->
    </div>
    <!-- /.col -->


    <div class="content-backdrop fade"></div>
  </div>


  <script type="text/javascript">
    var base_url = <%$base_url|@json_encode%>;
    var flag = <%$flag|@json_encode%>
  </script>
  <script src="<%$base_url%>public/js/store/inwarding_invoice.js"></script>
