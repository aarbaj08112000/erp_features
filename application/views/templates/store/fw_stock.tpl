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
                <span class="hide-menu">Part Number</span>
                <span class="search-show-hide float-right"><i class="ti ti-minus"></i></span>
              </li>
              <li class="sidebar-item">
                <div class="input-group">
                  <select class="form-control select2" name="part_id_search" id="part_id_search">
                    <option value="">Select Part Number</option>
                    <%if ($customer_parts) %>
                    <%foreach from=$customer_parts item=c %>
                    <option <%if $part_id ==$c->id %>selected<%/if%> value="<%$c->id %>"><%$c->part_number %></option>
                    <%/foreach%>
                    <%/if%>
                  </select>
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
          <a hijacked="yes" href="javascript:void(0)" class="backlisting-link"  >
            <i class="ti ti-chevrons-right" ></i>
            <em >Stock</em></a>
          </h1>
          <br>
          <span >FG Stock Transfer</span>
        </div>
      </nav>
      <!-- <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Basic Tables</h4> -->

      <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5">
        <%if checkGroupAccess("fw_stock","export","No")%>
        <button class="btn btn-seconday" type="button" id="downloadCSVBtn" title="Download CSV"><i class="ti ti-file-type-csv"></i></button>
        <button class="btn btn-seconday" type="button" id="downloadPDFBtn" title="Download PDF"><i class="ti ti-file-type-pdf"></i></button>
        <%/if%>
        <button class="btn btn-seconday filter-icon" type="button"><i class="ti ti-filter" ></i></i></button>
        <button class="btn btn-seconday" type="button"><i class="ti ti-refresh reset-filter"></i></button>
      </div>
      <div class="w-100">
            <input type="text" name="reason" placeholder="Filter Search" class="form-control serarch-filter-input m-3 me-0" id="serarch-filter-input" fdprocessedid="bxkoib">
        </div>
      <!-- Main content -->
      <div class="card p-0 mt-4 w-100">
        <div class="table-responsive text-nowrap">
          <table width="100%" border="1" cellspacing="0" cellpadding="0" class="table table-striped" style="border-collapse: collapse;" border-color="#e1e1e1" id="fw_stock_view">
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
        <div class="modal fade" id="fgtransfer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">
                            Transfer FG Stock to Inhouse Production Stock
                          </h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                          </button>
                        </div>
                        <form action="javascript:void(0)" class="custom-form fg_stock_form" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">
                          <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                <label for="">Stock Qty <span class="text-danger">*</span>
                                </label>
                                <input type="text" step="any" class="form-control required-input onlyNumericInput" value="" data-min="1" data-max="" name="stock" placeholder="Enter Transfer Qty"  id="stock_form">
                                <input type="hidden" class="form-control" value="" name="part_number" required placeholder="Enter Transfer Qty" id="part_number_form">
                                <input type="hidden" class="form-control" value="" name="customer_parts_master_id" required placeholder="Enter Transfer Qty" id="customer_parts_master_id_fomr">
                                </div>
                              </div>
                              <div class="col-lg-12 mb-3">
                                <div class="form-group">
                                <label for="">Inhouse Part Number <span class="text-danger">*</span>
                                </label>
                                <select name="inhouse_part_number"  class="form-control required-input select2" style="width: 100%;">
                                  <option value="">Select Inhouse Part Number</option>
                                  <%if ($inhouse_parts) %>
                                  <%foreach from=$inhouse_parts item=tt %>
                                  <option value="<%$tt->part_number %>">
                                    <%$tt->part_number %></option>
                                    <%/foreach%>
                                    <%/if%>
                                  </select>
                                </div>
                              </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss=" modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

        <div class="modal fade" id="fgtofgtransfer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">
                            Transfer FG Stock to FG Stock
                          </h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                          </button>
                        </div>
                        <form action="javascript:void(0)" class="custom-form fg_to_fg_stock_form" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">
                          <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                <label for="">Stock Qty <span class="text-danger">*</span>
                                </label>
                                <input type="text" step="any" class="form-control required-input onlyNumericInput" value="" data-max="" data-min="1" name="stock" placeholder="Enter Transfer Qty"  id="fg_stock_form">
                                <input type="hidden" class="form-control" value="" name="part_number" required placeholder="Enter Transfer Qty" id="fg_part_number_form">
                                <input type="hidden" class="form-control" value="" name="customer_parts_master_id" required placeholder="Enter Transfer Qty" id="fg_customer_parts_master_id_fomr">
                                </div>
                              </div>
                              <div class="col-lg-12 mb-3">
                                <div class="form-group">
                                <label for="">Transfer Part Number <span class="text-danger">*</span>
                                </label>
                                <select name="fg_part_id"  class="form-control required-input select2" style="width: 100%;" id="fg_part_data">
                                  <option value="">Select Transfer Part Number</option>
                                  </select>
                                </div>
                              </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss=" modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

        <div class="content-backdrop fade"></div>
      </div>
      <script type="text/javascript">
      var base_url = <%$base_url|@json_encode%>
      </script>
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
    var customer_parts = <%$customer_parts|json_encode%>;
    var isSheetMetal = <%$isSheetMetal|json_encode%>;
</script>
      <script src="<%$base_url%>public/js/store/fw_stock.js"></script>
