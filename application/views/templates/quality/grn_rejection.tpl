

<div class="content-wrapper">
  <!-- Content -->

  <div class="container-xxl flex-grow-1 container-p-y">
    
    <nav aria-label="breadcrumb">
      <div class="sub-header-left pull-left breadcrumb">
        <h1>
          Quality
          <a hijacked="yes" href="javascript:void(0)" class="backlisting-link" title="Back to Issue Request Listing" >
            <i class="ti ti-chevrons-right" ></i>
            <em >Inward Inspection</em></a>
          </h1>
          <br>
          <span >GRN Rejection</span>
        </div>
      </nav>

      <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5">
       <%if checkGroupAccess("grn_rejection","export","No") %>
        <button class="btn btn-seconday" type="button" id="downloadCSVBtn" title="Download CSV"><i class="ti ti-file-type-csv"></i></button>
        <button class="btn btn-seconday" type="button" id="downloadPDFBtn" title="Download PDF"><i class="ti ti-file-type-pdf"></i></button>
       <%/if%>
       
      </div>
      <div class="w-100">
            <input type="text" name="reason" placeholder="Filter Search" class="form-control serarch-filter-input m-3 me-0" id="serarch-filter-input" fdprocessedid="bxkoib">
        </div>


        <!-- Main content -->
      <div class="card p-0 mt-4 w-100">
        <div class="table-responsive text-nowrap">
          <table width="100%" border="1" cellspacing="0" cellpadding="0" class="table table-striped" style="border-collapse: collapse;" border-color="#e1e1e1" id="grn_rejection">
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
                     <tr>
                        <!-- <td><%$i %></td> -->
                        <td><%$c->part_number %>/<%$c->part_description %></td>
                        <td><%$c->reason %></td>
                        <td><%$c->supplier_name %></td>
                        <td><%$c->remark %></td>
                        <td>
                           <a class="btn btn-dark" download href="<%base_url('documents/') %><%$c->debit_note %>">Download Uploaded Document</a>
                        </td>
                        <td><%$c->qty %></td>
                        <td>
                           <%if ($c->status == "approved" || true) %>
                             <a class="btn btn-success" href="<%base_url('create_debit_note/') %><%$c->id %>">Download</a>

                          <%else if ($c->status == "stock_transfered") %>
                          <% else %>

                          <%/if%>
                        </td>
                     </tr>
                    <%assign var='i' value=$i+1 %>
                    <%/foreach %>
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




  <script src="<%$base_url%>public/js/quality/grn_rejection.js"></script>
