
<div class="wrapper">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
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
                <span class="hide-menu">Customer</span>
                <span class="search-show-hide float-right"><i class="ti ti-minus"></i></span>
              </li>
              <li class="sidebar-item">
                <div class="input-group">
                <select name="customer_name" class="form-control select2" id="selected_customer_name">
                  <option value="">Select Customer</option>
                <%foreach from=$customer_name_arr item=r %>
                <option><%$r%>
                </option>
                <%/foreach%>
               
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
                    Report
                    <a hijacked="yes" href="#stock/issue_request/index" class="backlisting-link"
                        title="Back to Issue Request Listing">
                        <i class="ti ti-chevrons-right"></i>
                        <em>Customer Challan Report</em></a>
                </h1>
                <br>
                <span>Customer Challan Report</span>
            </div>
        </nav>
        <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5 listing-btn">
      <%if checkGroupAccess("customer_challan_report","export","No")%>
      <button class="btn btn-seconday" type="button" id="downloadCSVBtn" title="Download CSV"><i class="ti ti-file-type-csv"></i></button>
      <button class="btn btn-seconday" type="button" id="downloadPDFBtn" title="Download PDF"><i class="ti ti-file-type-pdf"></i></button>
      <%/if%>
      <button class="btn btn-seconday filter-icon" type="button"><i class="ti ti-filter" ></i></i></button>
        <button class="btn btn-seconday" type="button"><i class="ti ti-refresh reset-filter"></i></button>
      
      
    </div>
        <div class="w-100">
            <input type="text" name="reason" placeholder="Filter Search" class="form-control serarch-filter-input m-3 me-0" id="serarch-filter-input" fdprocessedid="bxkoib">
        </div>
        <div class="card p-0 mt-4 w-100">

            <!-- /.card-header -->
            <div class="">
                <table class="table table-striped" style="border-collapse: collapse;" id="customer_challan_report">
                <thead>
                           <tr>
                              <!-- <th>Sr. No.</th> -->
                              <th>Customer Name</th>
                              <th>Part Details</th>
                              <th>UOM</th>
                              <th>Balance Qty</th>
                              <th>Total Price</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php
                              $i = 1;
                              <%if ($customer_wise_qty) %>
                                <%foreach from=$customer_wise_qty item=r %>

                           <tr>
                              
                              <td><%$r['customer_name'] %></td>
                              <td><%$r['part_number']%>/<%$r['part_description']%></td>
                              <td><%$r['uom'] %></td>
                              <td><%number_format($r['qty']) %></td>
                              <td><%number_format($r['total_rate']) %></td>
                             
                           </tr>
                           <%/foreach%>
                              <%/if%>
                        </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>


    <!-- Main content -->

</div>
<script>
    var base_url = <%$base_url|json_encode %> ;
</script>
<script src="<%$base_url%>public/js/reports/customer_challan_report.js"></script>