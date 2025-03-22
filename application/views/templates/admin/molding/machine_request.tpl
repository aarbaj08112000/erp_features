
<div class="content-wrapper">
  <!-- Content -->

  <div class="container-xxl flex-grow-1 container-p-y">
    <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme filter-popup-block" style="width: 0px;">
      <div class="app-brand demo justify-content-between">
        <a href="javascript:void(0)" class="app-brand-link">
          <span class="app-brand-text demo menu-text fw-bolder ms-2">Filter</span>
        </a>
        <div class="close-filter-btn d-block filter-popup cursor-pointer">
          <i class="ti ti-x fs-8"></i>
        </div>
      </div>
      <nav class="sidebar-nav scroll-sidebar filter-block" data-simplebar="init">
        <div class="simplebar-content" >
          <ul class="menu-inner py-1">
            <!-- Dashboard -->
            
            <div class="filter-row">
              <li class="nav-small-cap">
                <span class="hide-menu">Date</span>
                <span class="search-show-hide float-right"><i class="ti ti-minus"></i></span>
              </li>
              <li class="sidebar-item">
                <div class="input-group">
                <input type="text" name="datetimes" class="form-control" id="date_range_filter" fdprocessedid="49vxsk">
                </div>
              </li>
            </div>
            

          </ul>
        </div>
      </nav>
      <div class="filter-popup-btn">
        <button class="btn btn-outline-danger reset-filter">Reset</button>
        <button class="btn btn-primary search-filter">Search</button>
      </div>
    </aside>

    <nav aria-label="breadcrumb">
      <div class="sub-header-left pull-left breadcrumb">
        <h1>
          Production
          <a hijacked="yes" href="javascript:void(0)" class="backlisting-link" title="Back to Issue Request Listing" >
            <i class="ti ti-chevrons-right" ></i>
            <em >Material Request</em></a>
          </h1>
          <br>
          <span >Material Request</span>
        </div>
      </nav>

      <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5">
        <%if checkGroupAccess("machine_request","add","No")%>
        <button type="button" class="btn btn-seconday" data-bs-toggle="modal"
           data-bs-target="#addPromo">
        <i class="ti ti-plus"></i>
        </button>
        <%/if%>
        <%if checkGroupAccess("machine_request","export","No")%>
          <button class="btn btn-seconday" type="button" id="downloadCSVBtn" title="Download CSV"><i class="ti ti-file-type-csv"></i></button>
          <button class="btn btn-seconday" type="button" id="downloadPDFBtn" title="Download PDF"><i class="ti ti-file-type-pdf"></i></button>
        <%/if%>
        <button class="btn btn-seconday filter-icon" type="button"><i class="ti ti-filter" ></i></i></button>
        <button class="btn btn-seconday" type="button"><i class="ti ti-refresh reset-filter"></i></button>
      </div>

      <div class="modal fade" id="addPromo" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Add Machine Request
                     <span style="font-style:normal;color:blue;">
                     <%if ($isMultiClient == "true") %> - <%$this->session->userdata['clientUnitName'] %><%/if%></span>
                  </h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                  </button>
               </div>
               <form action="javascript:void(0)" class="custom-form add_machine_request" method="POST"
               enctype="multipart/form-data">
               <div class="modal-body">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group">
                          <label for="on click url">Select Operator<span
                            class="text-danger">*</span></label>
                          <select name="operator_id"   class="form-control select2 required-input"  style="width: 100%;">
                            <%if ($operator) %>
                            <%foreach from=$operator item=c %>
                            <option value="<%$c->id %>"><%$c->name %>
                            </option>
                            <%/foreach%>
                            <%/if%>
                          </select>
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="form-group">
                          <label for="on click url">Select Machine<span
                            class="text-danger">*</span></label>
                          <select name="machine_id"  class="form-control select2 required-input"  style="width: 100%;">
                            <%if ($machine) %>
                            <%foreach from=$machine item=c %>
                            <option value="<%$c->id %>">
                                <%$c->name %>
                            </option>
                            <%/foreach%>
                            <%/if%>
                          </select>
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="form-group">
                          <label for="on click url">Select Customer/Part Number/Part Description<span
                            class="text-danger">*</span></label>
                          <br><span style="font-style:italic;color:blue;">Note: This is list of parts which are defined in BOM</span>
                          <select name="customer_part_id"  class="form-control select2 required-input"  style="width: 100%;">
                            <option value="">Select</option>
                            <%if ($customer_part) %>
                            <%foreach from=$customer_part item=c %>
                            <option value="<%$c->id %>">
                                <%$c->customer_name %>/<%$c->part_number %>/<%$c->part_description %>
                            </option>
                            <%/foreach%>
                            <%/if%>
                          </select>
                      </div>
                    </div>
                  </div>
                </div>
               <div class="modal-footer">
               <button type="button" class="btn btn-secondary"
                  data-bs-dismiss="modal">Close</button>
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
      <div class="card p-0 mt-4  w-100">
        <div class="col-sm-2">
           <%if ($showDocRequestDetails=="true") %>
           Format No: STR-F-02 <br>
           Rev.Date : 3/3/2017 <br>
           Rev.No.  : 00
           <%/if%>
        </div>
        <div class="table-responsive text-nowrap">
          <table width="100%" border="1" cellspacing="0" cellpadding="0" class="table table-striped" style="border-collapse: collapse;" border-color="#e1e1e1" id="machine_request">
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
</script>

  <script src="<%$base_url%>public/js/production/machine_request.js"></script>
