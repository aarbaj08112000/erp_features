<%assign var='isMultiClient' value=$session_data['isMultipleClientUnits'] %>

<div class="content-wrapper">
  <!-- Content -->

  <div class="container-xxl flex-grow-1 container-p-y">
    

    <nav aria-label="breadcrumb">
      <div class="sub-header-left pull-left breadcrumb">
        <h1>
          Store
          <a hijacked="yes" href="javascript:void(0)" class="backlisting-link" >
            <i class="ti ti-chevrons-right" ></i>
            <em >Inwarding</em></a>
          </h1>
          <br>
          <span >GRN Qty Validation</span>
        </div>
      </nav>
      <!-- <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Basic Tables</h4> -->

      <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5">
        <%if checkGroupAccess("grn_validation","export","No")%>
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
        <table width="100%" border="1" cellspacing="0" cellpadding="0" class="table table-striped" style="border-collapse: collapse;" border-color="#e1e1e1" id="grn_validation">
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
      <!--/ Responsive Table -->
    </div>
    <!-- /.col -->


    <div class="content-backdrop fade"></div>
  </div>
  <style type="text/css">
     .dataTables_scrollHeadInner table,.dataTables_scrollBody table{
        width: 100% !important;
     }
     .dataTables_scrollHeadInner{
            width: 99.1%;
     }
  </style>
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
</script>
  <script src="<%$base_url%>public/js/store/grn_validation.js"></script>
