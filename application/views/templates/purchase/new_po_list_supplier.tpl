<!-- Content wrapper -->
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
        <div class="simplebar-content">
          <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <div class="filter-row">
              <li class="nav-small-cap">
                <span class="hide-menu">Supplier Name</span>
                <span class="search-show-hide float-right"><i class="ti ti-minus"></i></span>
              </li>
              <li class="sidebar-item">
                <div class="input-group">
                  <select name="child_part_id" class="form-control select2" id="supplier_search">
                    <option value="">Select Supplier</option>
                    <%foreach from=$supplier_list item=s%>
                      <option value="<%$s->supplier_name%>">
                        <%$s->supplier_name%>
                      </option>
                      <%/foreach%>
                  </select>
                </div>
              </li>
            </div>
            <!--<div class="filter-row">
              <li class="nav-small-cap">
                <span class="hide-menu">Admin Approval</span>
                <span class="search-show-hide float-right"><i class="ti ti-minus"></i></span>
              </li>
              <li class="sidebar-item">
                <div class="input-group">
                  <select name="child_part_id" class="form-control select2" id="admin_approve_search">
                    <option value="">Select Admin Approve</option>
                    <option value="accept">Accept</option>
                    <option value="pending">Pending</option>
                  </select>
                </div>
              </li>
            </div> -->




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
          Purchase
          <a hijacked="yes" href="#stock/issue_request/index" class="backlisting-link"
            title="Back to Issue Request Listing">
            <i class="ti ti-chevrons-right"></i>
            <em>Supplier</em></a>
        </h1>
        <br>
        <span>Supplier PO List</span>
      </div>
    </nav>
    <!-- <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Basic Tables</h4> -->

    <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5 listing-btn">
      <button class="btn btn-seconday" type="button" id="downloadCSVBtn" title="Download CSV"><i
          class="ti ti-file-type-csv"></i></button>
      <button class="btn btn-seconday" type="button" id="downloadPDFBtn" title="Download PDF"><i
          class="ti ti-file-type-pdf"></i></button>
      <button class="btn btn-seconday filter-icon" type="button"><i class="ti ti-filter"></i></i></button>
      <button class="btn btn-seconday" type="button"><i class="ti ti-refresh reset-filter"></i></button>
    </div>
    <!-- Responsive Table -->
    <div class="w-100">
        <input type="text" name="reason" placeholder="Filter Search" class="form-control serarch-filter-input m-3 me-0" id="serarch-filter-input" fdprocessedid="bxkoib">
    </div>
    <div class="card p-0 mt-4 w-100">
      <div class="table-responsive text-nowrap">

        <table class="table table-striped" id="supplier_po_wise_view">
          <thead>
            <tr>
              <!-- <th>Sr. No.</th> -->
              <th style="display: none;">ID</th>
              <th>Supplier Name</th>
              <th>Supplier Number</th>
              <th>Supplier Location</th>
              <th class="text-center">View PO</th>
            </tr>
          </thead>
          <tbody>
            <%assign var='i' value=1%>
              <%if count($supplier_list)> 0 %>
                <%foreach from=$supplier_list item=s %>
                  <tr>
                    <!-- <td width="5%"> <%$i %></td> -->
                    <td width="0%" style="display: none;">
                      <%$s->id %>
                    </td>
                    <td width="30%">
                      <%$s->supplier_name %>
                    </td>
                    <td width="15%">
                      <%$s->supplier_number %>
                    </td>
                    <td width="35%">
                      <%$s->location %>
                    </td>
                    <td width="10%" class="text-center"><a href="<%base_url('view_po_by_supplier_id/') %><%$s->id %>"
                        class="btn btn-primary" href="">View PO</a></td>
                  </tr>
                  <%assign var='i' value=$i+1%>
                <%/foreach%>
              <%/if%>
          </tbody>
        </table>

      </div>
    </div>
    <!--/ Responsive Table -->
  </div>
  <!-- / Content -->

  <div class="content-backdrop fade"></div>
</div>
<!-- Content wrapper -->
<script>
  var base_url = <%$base_url|json_encode %> ;
</script>
<script src="<%$base_url%>public/js/purchase/supplier_po_wise_view.js"></script>