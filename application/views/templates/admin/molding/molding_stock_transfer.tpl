
<div class="content-wrapper">
  <!-- Content -->

  <div class="container-xxl flex-grow-1 container-p-y">
    

    <nav aria-label="breadcrumb">
      <div class="sub-header-left pull-left breadcrumb">
        <h1>
          Production
          <a hijacked="yes" href="javascript:void(0)" class="backlisting-link" title="Back to Issue Request Listing" >
            <i class="ti ti-chevrons-right" ></i>
            <em >Molding Stock Transfer</em></a>
          </h1>
          <br>
          <span >Molding Stock Transfer</span>
        </div>
      </nav>

      <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5">
      <%if checkGroupAccess("molding_stock_transfer","export","No")%>
        <button class="btn btn-seconday" type="button" id="downloadCSVBtn" title="Download CSV"><i class="ti ti-file-type-csv"></i></button>
        <button class="btn btn-seconday" type="button" id="downloadPDFBtn" title="Download PDF"><i class="ti ti-file-type-pdf"></i></button>
        <%/if%>
       
        <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal"
           data-bs-target="#addPromo">
           Add Request
           </button> -->
      </div>

      <div class="modal fade" id="addPromo" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Add</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                  </button>
               </div>
               <div class="modal-body">
                  <div class="form-group">
                     <form action="<%base_url('add_molding_stock_transfer') %>"
                        method="POST" enctype="multipart/form-data">
                  </div>
                  <div class="form-group">
                  <label for="on click url">Select Customer Part / Molding Production Qty<span
                     class="text-danger">*</span></label>
                  <select required name="customer_part_id" class="form-control select2">
                  <%if ($customer_part) %>
                       <%foreach from=$customer_part item=c %>
                    <option value="<%$c->id %>">
                    <%$c->part_number %> / <%$c->part_description %>/<%$c->molding_production_qty %>
                    </option>
                    <%/foreach%>
                   <%/if%>
                  </select>
                  </div>
                  <div class="form-group">
                  <label for="on click url">Enter Final Inspection Qty<span
                     class="text-danger">*</span></label>
                  <input type="number" min="0" value="0" max=""
                     name="final_inspection_location" required class="form-control">
                  </div>
               </div>
               <div class="modal-footer">
               <button type="button" class="btn btn-secondary"
                  data-bs-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary">Save changes</button>
               </form>
               </div>
            </div>
         </div>
      </div>
        <!-- Main content -->
        <div class="w-100">
        <input type="text" name="reason" placeholder="Filter Search" class="form-control serarch-filter-input m-3 me-0" id="serarch-filter-input" fdprocessedid="bxkoib">
      </div>
      <div class="card p-0 mt-4  w-100">
        <div class="table-responsive text-nowrap">
          <table width="100%" border="1" cellspacing="0" cellpadding="0" class="table table-striped" style="border-collapse: collapse;" border-color="#e1e1e1" id="molding_stock_transfer">
          <thead>
          <tr>
              <%foreach from=$data key=key item=val%>
              <th><b>Search <%$val['title']%></b></th>
              <%/foreach%>
          </tr>
      </thead>
      <tbody></tbody>
         </table>
        </div>
      </div>
    <!-- /.col -->


    <div class="content-backdrop fade"></div>
  </div>
  <script>
  var column_details =  <%$data|json_encode%>;
  var page_length_arr = <%$page_length_arr|json_encode%>;
  var is_searching_enable = <%$is_searching_enable|json_encode%>;
  var is_top_searching_enable =  <%$is_top_searching_enable|json_encode%>;
  var is_paging_enable =  <%$is_paging_enable|json_encode%>;
  var is_serverSide =  <%$is_serverSide|json_encode%>;
  var no_data_message =  <%$no_data_message|json_encode%>;
  var is_ordering =  <%$is_ordering|json_encode%>;
  var sorting_column = <%$sorting_column%>;
  var api_name =  <%$api_name|json_encode%>;
  var base_url = <%$base_url|json_encode%>;
  var start_date = <%$start_date|json_encode%>;
  var end_date = <%$end_date|json_encode%>;
  var filter_by_status = <%$filter_by_status|json_encode%>
</script>



  <script src="<%$base_url%>public/js/production/molding_stock_transfer.js"></script>
