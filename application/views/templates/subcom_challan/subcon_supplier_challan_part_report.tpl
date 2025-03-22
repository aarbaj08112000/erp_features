<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<div  class="wrapper container-xxl flex-grow-1 container-p-y">

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
            <span class="hide-menu">Part Number / Description</span>
            <span class="search-show-hide float-right"><i class="ti ti-minus"></i></span>
          </li>
          <li class="sidebar-item">
            <div class="input-group">
            <select name="selected_customer_part_number"  id="part_number" class="form-control select2">
                <option  value="">NA</option>
                <%if $customer_parts_data%>
                    <%foreach from=$customer_parts_data item=c%>
                        <option  value="<%$c->part_number%>"><%$c->part_number%> / <%$c->part_description%></option>
                    <%/foreach%>
                <%/if%>
            </select>
            </div>
          </li>
        </div>
        <div class="filter-row">
          <li class="nav-small-cap">
            <span class="hide-menu">Supplier</span>
            <span class="search-show-hide float-right"><i class="ti ti-minus"></i></span>
          </li>
          <li class="sidebar-item">
          <div class="input-group">
          <select name="selected_supplier_id"  class="form-control select2" id="suppler">
          <option value="">NA</option>
          <%if $supplier%>
              <%foreach from=$supplier item=c%>
                  <option value="<%$c->id%>"><%$c->supplier_name%></option>
              <%/foreach%>
          <%/if%>
      </select>
          </div>
        </li>
        </div>  
        <div class="filter-row">
          <li class="nav-small-cap">
            <span class="hide-menu">Challan Date</span>
            <span class="search-show-hide float-right"><i class="ti ti-minus"></i></span>
          </li>
          <li class="sidebar-item">
            <div class="input-group">
            <input type="text" name="datetimes" class="dates form-control" id="date_range_filter" />
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
      Reports
      <a hijacked="yes" href="#stock/issue_request/index" class="backlisting-link" title="Back to Issue Request Listing" >
        <i class="ti ti-chevrons-right" ></i>
        <em >subcon supplier-challan part stock report</em></a>
    </h1>
    <br>
    <span >subcon supplier-challan part stock report</span>
  </div>
</nav>
<div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5">
<%if checkGroupAccess("subcon_supplier_challan_part_report","export","No") %>
  <button class="btn btn-seconday" type="button" id="downloadCSVBtn" title="Download CSV"><i class="ti ti-file-type-csv"></i></button>
  <button class="btn btn-seconday" type="button" id="downloadPDFBtn" title="Download PDF"><i class="ti ti-file-type-pdf"></i></button>
<%/if%>
  <button class="btn btn-seconday filter-icon" type="button"><i class="ti ti-filter" ></i></i></button>
  <button class="btn btn-seconday" type="button"><i class="ti ti-refresh reset-filter"></i></button>
</div>

<div class="w-100">
<input type="text" name="reason" placeholder="Filter Search" class="form-control serarch-filter-input m-3 me-0" id="serarch-filter-input" fdprocessedid="bxkoib">
</div>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        
<!-- Main content -->
<section class="content">
<div class="">
    <div class="row">
        <div class="col-12">
           <div class="card">
                
                <!-- /.card-header -->
                <div class="">
                    <table id="example1" class="table  table-striped">
                        <thead>
                            <tr>
                                <%*<th>Sr.No.</th>*%>
                                <th>Supplier</th>
                                <th>Child Part</th>
                                <th>Challan No</th>
                                <th>Challan Date</th>   
                        
                                <th>Aging Date</th>
                                <th>Challan Qty</th>
                                <th>Remaning qty</th>
                                <th>Part Rate</th>
                                <th>Process</th>
                                <th>Value (Challan Qty)</th>
                                <th>Value (Remaining Qty)</th>
                            </tr>
                        </thead>
                        <tbody>
                        <%assign var="i" value=1%>
                             <%if $challan_parts%>
                                <%foreach from=$challan_parts item=c%>
                                    <%if $display_arr[$c->id]['show'] eq "yes"%>
                                        <tr>
                                           <%* <td><%$i%></td> *%>
                                            <td><%$supplier_data[$c->id][0]->supplier_name%></td>
                                            <td><%$child_part_data[$c->id][0]->part_number%> <%$child_part_data[0]->part_description%></td>
                                            <td><%$challan_data[$c->id][0]->challan_number%></td>
                                            <td><%$challan_data[$c->id][0]->created_date%></td>
                                            <td><%$aging[$c->id]%></td>
                                            <td><%$c->qty%></td>
                                            <td><%$c->remaning_qty%></td>
                                            <td><%$c->process%></td>
                                            <td><%$value_qty[$c->id]%></td>
                                            <td><%$value_qty_remaning[$c->id]%></td>
                                        </tr>
                                        <%assign var="i" value=$i+1%>
                                    <%/if%>
                                <%/foreach%>
                            <%/if%>
                        </tbody>
                      <%*  <tfoot>
                            <tr>
                                <td colspan="9">Total</td>
                                <td colspan=""><%$main_total%></td>
                                <td colspan=""><%$main_total_2%></td>
                            </tr>
                        </tfoot> *%>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
</div>
<!-- /.content-wrapper -->

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
<script src="<%$base_url%>/public/js/reports/subcom_report.js"></script>
