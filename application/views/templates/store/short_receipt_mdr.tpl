
<div class="content-wrapper">
  <!-- Content -->

  <div class="container-xxl flex-grow-1 container-p-y">
   
    <nav aria-label="breadcrumb">
      <div class="sub-header-left pull-left breadcrumb">
        <h1>
          Store
          <a hijacked="yes" href="javascript:void(0)" class="backlisting-link" title="Back to Issue Request Listing" >
            <i class="ti ti-chevrons-right" ></i>
            <em >MDR Short Rejection</em></a>
          </h1>
          <br>
          <span >MDR Short Rejection</span>
        </div>
      </nav>
      <!-- <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Basic Tables</h4> -->

      <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5">
        <%if checkGroupAccess("short_receipt","export","No")%>
          <button class="btn btn-seconday" type="button" id="downloadCSVBtn" title="Download CSV"><i class="ti ti-file-type-csv"></i></button>
          <button class="btn btn-seconday" type="button" id="downloadPDFBtn" title="Download PDF"><i class="ti ti-file-type-pdf"></i></button>
        <%/if%>
       
      </div>


      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add </h5>
              <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="<%base_url('add_rejection_flow') %>" method="POST" enctype='multipart/form-data'>
                <div class="row">
                  <div class="col-lg-12">
                    <div class="form-group">
                      <label for="po_num">Select Part Number / Description / Stock </label><span class="text-danger">*</span>
                      <select name="part_id" id="" class="from-control select2">
                        <%if ($child_part) %>
                        <%foreach from=$child_part item=c %>

                        <%if ($c->stock > 0) %>
                        <option value="<%$c->clientId %>"><%$c->part_number %>/<%$c->part_description %>/<%$c->stock %></option>
                        <%/if%>
                        <%/foreach%>
                        <%/if%>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="po_num">Select Supplier</label><span class="text-danger">*</span>
                      <select name="supplier_id" id="" class="from-control select2">
                        <%if ($supplier) %>
                        <%foreach from=$supplier item=c %>
                        <option value="<%$c->id %>"><%$c->supplier_name %></option>
                        <%/foreach%>
                        <%/if%>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="po_num">Enter Reason <span class="text-danger">*</span></label>
                      <input type="text" name="reason" required placeholder="Enter Reason" class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="po_num">Upload debit note (approved document) <span class="text-danger">*</span></label>
                      <input type="file" name="uploading_document" required class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="po_num">Enter Qty <span class="text-danger">*</span></label>
                      <input type="number" name="qty" step="any" placeholder="Enter Qty" name="qty" required class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="po_num">Enter Remark </label>
                      <input type="text" name="remark" required placeholder="Enter Remark" class="form-control">
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- Main content -->
      <div class="w-100">
        <input type="text" name="reason" placeholder="Filter Search" class="form-control serarch-filter-input m-3 me-0" id="serarch-filter-input" fdprocessedid="bxkoib">
      </div>
      <div class="card p-0 mt-4 w-100">
        <div class="table-responsive text-nowrap">
          <table width="100%" border="1" cellspacing="0" cellpadding="0" class="table table-striped" style="border-collapse: collapse;" border-color="#e1e1e1" id="short_receipt_mdr">
            <thead>
              <tr>
                <!-- <th>Sr. No.</th> -->
                <th>Part Number / Description</th>
                <th>Rejection Reason</th>
                <th>Supplier</th>
                <th>Remark</th>
                <th>Uploaded Debit Note</th>
                <th>Qty</th>
                <th>Download Debit Note</th>
              </tr>
            </thead>
            <tbody>
              <%assign var='i' value=1 %>
              <%if ($rejection_flow) %>
              <%foreach from=$rejection_flow item=c %>
              <%if ($c->type == "MDR") %>
              <tr>
                <!-- <td><%$i %></td> -->
                <td><%$c->part_number %>/<%$c->part_description %></td>
                <td><%$c->reason %></td>
                <td><%$c->supplier_name %></td>
                <td><%$c->remark %></td>
                <td class="text-center">
                  <a download href="<% base_url('documents/') %><% $c->debit_note %>" data-toggle="tooltip" data-placement="bottom" title="Download Uploaded Document">
                    <i class="ti ti-file-download"></i>
                  </a>

                  <!-- <a  download href="<%base_url('documents/') %><%$c->debit_note %>" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Download Uploaded Document"><i class="ti ti-file-download"></i></a> -->
                </td>
                <td><%$c->qty %></td>
                <td class="text-center">
                  <%if ($c->status == "approved" || true) %>
                  <a href="<%base_url('create_debit_note/') %><%$c->id %>" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Download"><i class="ti ti-download"></i></a>
                  <%else if ($c->status == "stock_transfered") %>

                  <%else %>
                  
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
      <!--/ Responsive Table -->
    </div>
    <!-- /.col -->


    <div class="content-backdrop fade"></div>
  </div>




  <script src="<%$base_url%>public/js/store/short_receipt_mdr.js"></script>
