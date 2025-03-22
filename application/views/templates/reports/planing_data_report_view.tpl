<div class="wrapper container-xxl flex-grow-1 container-p-y">

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
                <span class="hide-menu">Select Customer</span>
                <span class="search-show-hide float-right"><i class="ti ti-minus"></i></span>
              </li>
              <li class="sidebar-item">
                <div class="input-group">
                <select name="customer_id" id="customers" class="form-control select2">
                <option value="0">All</option>
               
                <%foreach $customer as $c%>
                <option <%if $c->id eq $customer_id%>selected<%/if%> value="<%$c->id%>"><%$c->customer_name%></option>
                <%/foreach%>
            </select>
                </div>
              </li>
            </div>
            <div class="filter-row">
              <li class="nav-small-cap">
                <span class="hide-menu">Select Financial Year</span>
                <span class="search-show-hide float-right"><i class="ti ti-minus"></i></span>
              </li>
              <li class="sidebar-item">
              <div class="input-group">
              <select name="financial_year" id="year" class="form-control select2">
              <%for $i=2020 to $current_year%>
              <%$year="FY-$i"%>
              <option value="<%$year%>" <%if $i eq $current_year %>selected<%/if%>><%$year%></option>
              <%/for%>
          </select>
              </div>
            </li>
            </div>  

            <div class="filter-row">
            <li class="nav-small-cap">
              <span class="hide-menu">Select Month</span>
              <span class="search-show-hide float-right"><i class="ti ti-minus"></i></span>
            </li>
            <li class="sidebar-item">
            <div class="input-group">
            <select name="month_id" id="months" class="form-control select2">
                <option value="MAR">MAR</option>
                <option value="APR">APR</option>
                <option value="MAY">MAY</option>
                <option value="JUN">JUN</option>
                <option value="JUL">JUL</option>
                <option value="AUG">AUG</option>
                <option value="SEP">SEP</option>
                <option value="OCT">OCT</option>
                <option value="NOV">NOV</option>
                <option value="DEC">DEC</option>
                <option value="JAN">JAN</option>
                <option value="FEB">FEB</option>
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
          Reports
          <a hijacked="yes" href="#stock/issue_request/index" class="backlisting-link" title="Back to Issue Request Listing" >
            <i class="ti ti-chevrons-right" ></i>
            <em >Planning Data</em></a>
        </h1>
        <br>
        <span >Planning Data</span>
      </div>
    </nav>
    <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5">
        <%if checkGroupAccess("planing_data_report","export","No") %>
          <button class="btn btn-seconday" type="button" id="downloadCSVBtn" title="Download CSV"><i class="ti ti-file-type-csv"></i></button>
          <button class="btn btn-seconday" type="button" id="downloadPDFBtn" title="Download PDF"><i class="ti ti-file-type-pdf"></i></button>
        <%/if%>
      <button class="btn btn-seconday filter-icon" type="button"><i class="ti ti-filter" ></i></i></button>
      <button class="btn btn-seconday" type="button"><i class="ti ti-refresh reset-filter"></i></button>
    </div>


    <div class="content-wrapper">
        
        <section class="content">
            <div class="">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            
                            <div class="c">
                            <div class="table-responsive text-nowrap">
                                <table id="planning_data" class="table  table-striped">
                                    <thead>
                                        <tr>
                                          <%*  <th>Sr. No.</th> *%>
                                            <th>Customer Part Number</th>
                                            <th>Customer Part Description</th>
                                            <th>Customer Name</th>
                                            <th>Month</th>
                                            <th>Schedule Qty 1</th>
                                            <th>Schedule Qty 2</th>
                                            <th>Job Card Qumulative Qty</th>
                                            <th>Job Card Balance Qty</th>
                                            <th>Job Card Issued</th>
                                            <th>Job Card Closed</th>
                                            <th>Customer Part Price</th>
                                            <th>Dispatch (sales qty)</th>
                                            <th>Balance Schedule qty</th>
                                            <th>Subtotal Schedule</th>
                                            <th>View Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <%assign var=i value = 1%>
                                        <%foreach $planing_data as $t%>

                                        <tr>
                                            <td><%$i%></td>
                                            <td><%$customer_part_data[$t->id][0]->part_number%></td>
                                            <td><%$customer_part_data[$t->id][0]->part_description%></td>
                                            <td><%$customers_data[$t->id][0]->customer_name%></td>
                                            <td><%$t->month%></td>
                                            <td><%$planing_data_new[$t->id][0]->schedule_qty%></td>
                                            <td><%$planing_data_new[$t->id][0]->schedule_qty_2%></td>
                                            <td><%$job_card_qty[$t->id]%></td>
                                            <td>
                                            <%if empty($planing_data_new[$t->id][0]->schedule_qty_2)%>
                                            <%$planing_data_new[$t->id][0]->schedule_qty-$job_card_qty[$t->id]%>
                                            <%else%>
                                            <%$planing_data_new[$t->id][0]->schedule_qty_2-$job_card_qty[$t->id]%>
                                            <%/if%>
                                            </td>
                                            <td><%$issued[$t->id]%></td>
                                            <td><%$closed[$t->id]%></td>
                                            <td><%$rate[$t->id]%></td>
                                            <td><%$dispatch_sales_qty[$t->id]%></td>
                                            <td><%$balance_s_qty[$t->id]%></td>
                                            <td>
                                            <%if empty($planing_data_new[$t->id][0]->schedule_qty_2)%>
                                                <%$subtotal1[$t->id]%>
                                                <%else%>   
                                                <%$subtotal2[$t->id]%>
                                            <%/if%>
                                            </td>
                                            <td>
                                            
                                                <a class="btn btn-info" href="<%$base_url%>view_planing_data/<%$t->id%>">View Details</a>
                                            </td>
                                        </tr>
                                        <%if $customers_data[$t->id][0]->id eq $customer_id%>
                                        <tr>
                                            <td><%$i%></td>
                                            <td><%$customer_part_data[$t->id][0]->part_number%></td>
                                            <td><%$customer_part_data[$t->id][0]->part_description%></td>
                                            <td><%$customers_data[$t->id][0]->customer_name%></td>
                                            <td><%$t->month%></td>
                                            <td>
                                                <a class="btn btn-info" href="<%$base_url%>view_planing_data/<%$t->id%>">View Details</a>
                                            </td>
                                        </tr>
                                       <%/if%>
                                       <%assign var=i value = $i+1%>
                                        <%/foreach%>
                                    </tbody>
                                    <tfoot>
                                        <tr style="text-align:right;">
                                            <th colspan="11">Total Sales Value</th>
                                            <th><%$total1%></th>
                                            <th><%$total2%></th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
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
</script>
<script src="<%$base_url%>/public/js/reports/planning_data_report.js"></script>
