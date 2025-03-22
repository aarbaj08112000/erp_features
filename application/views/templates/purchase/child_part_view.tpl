<!-- Content wrapper -->

<%assign var="entitlements" value=$session_data['entitlements']%>
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
                  <select name="child_part_id" class="form-control select2" id="part_number_search">
                    <option value="">Select Part Number</option>
                    <%foreach from=$supplier_part_list item=parts%>
                      <option value="<%$parts->id%>"><%$parts->part_number %></option>
                    <%/foreach%>
                  </select>
                </div>
              </li>
            </div>
            <div class="filter-row">
              <li class="nav-small-cap">
                <span class="hide-menu">Part Description</span>
                <span class="search-show-hide float-right"><i class="ti ti-minus"></i></span>
              </li>
              <li class="sidebar-item">
                <div class="input-group">
                  <input type="text" id="part_description_search" class="form-control" placeholder="Name">
                </div>
              </li>
            </div>  
            <div class="filter-row">
              <li class="nav-small-cap">
                <span class="hide-menu">Name</span>
                <span class="search-show-hide float-right"><i class="ti ti-minus"></i></span>
              </li>
              <li class="sidebar-item">
                <div class="input-group">
                  <input type="text" id="employee_name_search" class="form-control" placeholder="Name">
                </div>
              </li>
            </div>
            <div class="filter-row">
              <li class="nav-small-cap">
                <span class="hide-menu">Name</span>
                <span class="search-show-hide float-right"><i class="ti ti-minus"></i></span>
              </li>
              <li class="sidebar-item">
                <div class="input-group">
                  <input type="text" id="employee_name_search" class="form-control" placeholder="Name">
                </div>
              </li>
            </div>
            <div class="filter-row">
              <li class="nav-small-cap">
                <span class="hide-menu">Name</span>
                <span class="search-show-hide float-right"><i class="ti ti-minus"></i></span>
              </li>
              <li class="sidebar-item">
                <div class="input-group">
                  <input type="text" id="employee_name_search" class="form-control" placeholder="Name">
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
          Master
          <a hijacked="yes" href="#stock/issue_request/index" class="backlisting-link" title="Back to Issue Request Listing" >
            <i class="ti ti-chevrons-right" ></i>
            <em >Purchase</em></a>
        </h1>
        <br>
        <span >Item Master</span>
      </div>
    </nav>
    <!-- <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Basic Tables</h4> -->

    <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5 listing-btn">
      <%if checkGroupAccess("child_part_view","add",false)%>
      <div class="btn-group">
        <a type="button" class="btn btn-seconday" href="<%base_url('child_part')%>">Add Item</a>
      </div>
      <%/if%>
      <%if checkGroupAccess("child_part_view","export",false)%>
        <button class="btn btn-seconday" type="button" id="downloadCSVBtn" title="Download CSV"><i class="ti ti-file-type-csv"></i></button>
        <button class="btn btn-seconday" type="button" id="downloadPDFBtn" title="Download PDF"><i class="ti ti-file-type-pdf"></i></button>
      <%/if%>
      <button class="btn btn-seconday filter-icon" type="button"><i class="ti ti-filter" ></i></i></button>
      <button class="btn btn-seconday" type="button"><i class="ti ti-refresh reset-filter"></i></button>
    </div>
    <!-- Responsive Table -->
    <div class="w-100">
        <input type="text" name="reason" placeholder="Filter Search" class="form-control serarch-filter-input m-3 me-0" id="serarch-filter-input" fdprocessedid="bxkoib">
      </div>
    <div class="card p-0 mt-4 w-100">
      <div class="table-responsive text-nowrap">
      <table width="100%" border="1" cellspacing="0" cellpadding="0" class="table table-striped" style="border-collapse: collapse;" border-color="#e1e1e1" id="child_part_view">
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
  <!-- / Content -->

 <div class="modal fade" id="child_part_update" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0)" method="POST" enctype='multipart/form-data' id="updatechildpart">
                    <div class="row">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="part_number">Part Number</label><span class="text-danger">*</span>
                                    <input readonly type="text" value="" name="part_number"  class="form-control"  aria-describedby="emailHelp" placeholder="Part Number" id="part_number" />
                                    <input type="hidden" name="part_id" value="" id="part_id" />
                                    <input type="hidden" name="filter_child_part_id" value="" />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="Client_name">Part Description</label><span class="text-danger">*</span>
                                    <input type="text" value="" name="part_description" id="part_description" class="form-control"  aria-describedby="emailHelp" placeholder="Part Description" />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="safty_buffer_stk">Safety Buffer Stock</label><span class="text-danger">*</span>
                                    <input type="text" value="" name="saft__stk" id="saft__stk" class="form-control"  aria-describedby="emailHelp" placeholder="Part Specification" />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="hsn_code">HSN Code</label><span class="text-danger">*</span>
                                    <input type="text" value="" name="hsn_code" id="hsn_code" class="form-control"  aria-describedby="emailHelp" placeholder="Part Specification" />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Purchase Item Category</label><span class="text-danger">*</span>
                                    <select class="form-control select2-init parent-category" name="sub_type" id="sub_type" style="width: 100%;">
                                        <option value="">Selecte Purchase Item Category</option>
                                        <%foreach from=$category_list item=a %>
                                            <%if (!($a->parent_id > 0)) %>
                                                <option  value="<%$a->category_name %>"><%$a->category_name %></option>
                                            <%/if%>
                                        <%/foreach%>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                              <div class="form-group">
                                  <label> Sub Item Category </label>
                                      <select class="form-control select2 sub_category_type" id="sub_category_type" name="sub_category_type" style="width: 100%;" data-selected="">
                                          <option value="">Select Sub Item Category</option>
                                      </select>
                              </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="store_rack_location">Store Rack Location</label><span class="text-danger">*</span>
                                    <input type="text" value="" name="store_rack_location" id="store_rack_location" class="form-control"  aria-describedby="emailHelp" placeholder="Part Specification" />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="safty_buffer_stk">UOM Name</label><span class="text-danger">*</span>
                                    <!-- <input readonly type="text" value="" name="uom_name" id="uom_name" class="form-control"  aria-describedby="emailHelp" placeholder="Part Specification" /> -->
                                     <select class="form-control select2-init" name="uom_id" id="uom_id" style="width: 100%;">
                                        <%foreach from=$uom item=c%>
                                          <option <%if ($c->id == $po->uom_id)%>selected <%/if%> value="<%$c->id%>">
                                              <%$c->uom_name%>
                                          </option>
                                        <%/foreach%>
                                      </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="max_uom">Max UOM</label><span class="text-danger">*</span>
                                    <input type="text" value="" name="max_uom" id="max_uom" class="form-control"  aria-describedby="emailHelp" placeholder="Part Specification" />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="max_uom">Store Stock Rate</label><span class="text-danger">*</span>
                                    <input type="text" value="" name="store_stock_rate" id="store_stock_rate" class="form-control"  aria-describedby="emailHelp" placeholder="Part Specification" />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="max_uom">Weight</label><span class="text-danger">*</span>
                                    <input type="text" value="" name="weight" id="weight" class="form-control"  aria-describedby="emailHelp" />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="max_uom">Size</label><span class="text-danger">*</span>
                                    <input type="text" value="" name="size" id="size" class="form-control"  aria-describedby="emailHelp" />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="max_uom">Thickness</label><span class="text-danger">*</span>
                                    <input type="text" value="" name="thickness" id="thickness" class="form-control"  aria-describedby="emailHelp" />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="max_uom">Grade</label><span class="text-danger">*</span>
                                    <input type="text" value="" name="grade" id="grade" class="form-control"  aria-describedby="emailHelp" />
                                </div>
                            </div>
                        </div>
                    </div>

                    </div>
                    <div class="modal-footer ">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


  <div class="content-backdrop fade"></div>
</div>
<!-- Content wrapper -->
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
<script src="<%$base_url%>public/js/purchase/add_child_part.js"></script>
