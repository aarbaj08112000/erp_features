
<div class="content-wrapper">
  <!-- Content -->

  <div class="container-xxl flex-grow-1 container-p-y">
    

    <nav aria-label="breadcrumb">
      <div class="sub-header-left pull-left breadcrumb">
        <h1>
          Report
          <a hijacked="yes" href="javascript:void(0)" class="backlisting-link" title="Back to Issue Request Listing" >
            <i class="ti ti-chevrons-right" ></i>
            <em >Scarp Report</em></a>
          </h1>
          <br>
          <span >Scarp Report</span>
        </div>
      </nav>

      <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5">
      <%if (checkGroupAccess("scrap_report","export","No")) %>
        <button class="btn btn-seconday" type="button" id="downloadCSVBtn" title="Download CSV"><i class="ti ti-file-type-csv"></i></button>
        <button class="btn btn-seconday" type="button" id="downloadPDFBtn" title="Download PDF"><i class="ti ti-file-type-pdf"></i></button>
      <%/if%>
      <%*  <button class="btn btn-seconday filter-icon" type="button"><i class="ti ti-filter" ></i></i></button>
        <button class="btn btn-seconday" type="button"><i class="ti ti-refresh reset-filter"></i></button> *%>
      
      </div>

     
        <div class="w-100">
            <input type="text" name="reason" placeholder="Filter Search" class="form-control serarch-filter-input m-3 me-0" id="serarch-filter-input" fdprocessedid="bxkoib">
        </div>        
      <!-- Main content -->
      <div class="card p-0 mt-4 w-100">


          <div class="table-responsive text-nowrap">
        <table width="100%" border="1" cellspacing="0" cellpadding="0" class="table table-striped" style="border-collapse: collapse;" border-color="#e1e1e1" id="scrap_report">
              <thead>
                 <tr>
                    <th>Scrap Category</th>
                    <th>Scrap stock</th>
                    <th class="text-center">Action</th>
                 </tr>
              </thead>
              <tbody>
                  <%assign var='i' value=1 %>
                  <%if ($scrap_report_data)  %>
                      <%foreach from=$scrap_report_data item=t %>
                     <tr>
                        <td><%$t['scrap_category'] %></td>
                        <td><%roundUpNumber($t['scrap_stock']) %></td>
                        <td class="text-center">
                        <%if (checkGroupAccess("scrap_report","update","No")) %>
                           <button type="submit" data-bs-toggle="modal" class="btn no-btn btn-primary edit-part" data-value="<%base64_encode(json_encode($t))%>" data-bs-target="#exampleModal3<%$i %>" title="Transfer FG Stock"> <i class="ti ti-transfer"></i></button>

                           <div class="modal fade" id="exampleModal3<%$i %>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered" role="document">
                                 <div class="modal-content">
                                    <div class="modal-header">
                                       <h5 class="modal-title" id="exampleModalLabel">Transfer Stock</h5>
                                       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                       </button>
                                    </div>
                                    <form action="<%base_url('transfer_scrap_stock') %>" method="POST" id="transfer_scrap_stock<%$i %>" class="transfer_scrap_stock transfer_scrap_stock<%$i %> custom-form">
                                       <div class="modal-body">
                                          <input value="<%$t['scrap_category_master_id'] %>" name="scrap_category_id" type="hidden" required class="form-control" aria-describedby="emailHelp" placeholder="">
                                            <div class="form-group">
                        <label>Transfer To Scrap Part<span class="text-danger">*</span></label> <br>
                                                <select name="customer_part_id" class="form-control select2 required-input" >
                                                      <option value="" >Please select Part</option>
                                                      <%foreach $scrap_product as $key => $val%>
                                                      <option 
                                                          value="<%$val->id%>"><%$val->part_number%>/<%$val->part_description%></option>
                                                     <%/foreach%>
                                                    </select>
                                            </div>
                                            <div class="form-group">
                        <label>Transfer Qty<span class="text-danger">*</span></label> <br>
                                                <input  type="text" step="any" name="scrap_stock" placeholder="Enter transfer qtys" class="form-control onlyNumericInput required-input" value="" id="part-rate" data-max="<%roundUpNumber($t['scrap_stock']) %>" data-min="1">
                                            </div>
                                            <div class="form-group">
                        <label>Remark<span class="text-danger">*</span></label> <br>
                                                <input  type="text" step="any" name="remark" placeholder="Enter remark" class="form-control  required-input" value="" >
                                            </div>
                                       </div>
                                       <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                          <button type="submit" class="btn btn-danger">Transfer </button>
                                       </div>
                                    </form>
                                 </div>
                              </div>
                           </div>
                           <%else%>
                            <%display_no_character("")%>
                           <%/if%>
                        </td>
                     </tr>
                    <%assign var='i' value=$i+1 %>
                    <%/foreach%>
                  <%/if%>
              </tbody>
           </table>
          </div>
        </div>
        <!--/ Responsive Table -->
      </div>
      <!-- /.col -->
   </div>

      <div class="content-backdrop fade"></div>
    </div>


    <script type="text/javascript">
    var base_url = <%$base_url|@json_encode%>
    </script>

    <script src="<%$base_url%>public/js/reports/scrap_report.js"></script>
