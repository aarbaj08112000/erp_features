<div  class="wrapper container-xxl flex-grow-1 container-p-y">
    <!-- Navbar -->

    <!-- /.navbar -->

    <!-- Main Sidebar Container -->


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
                <span class="hide-menu">Select Month</span>
                <span class="search-show-hide float-right"><i class="ti ti-minus"></i></span>
              </li>
              <li class="sidebar-item">
                <div class="input-group">
                  <select name="customer_name" class="form-control select2" id="customer_name">
                  <%foreach $customer_data as $val%>
                  <option value="<%$val->customer_name%>"><%$val->customer_name%></option>
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
          Planning & Sales
          <a hijacked="yes" href="#stock/issue_request/index" class="backlisting-link" title="Back to Issue Request Listing" >
            <i class="ti ti-chevrons-right" ></i>
            <em >Customer PO Tracking</em></a>
        </h1>
        <br>
        <span >Closed Customer PO</span>
      </div>
    </nav>
    <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5">
      <button class="btn btn-seconday" type="button" id="downloadCSVBtn" title="Download CSV"><i class="ti ti-file-type-csv"></i></button>
      <button class="btn btn-seconday" type="button" id="downloadPDFBtn" title="Download PDF"><i class="ti ti-file-type-pdf"></i></button>
      <button class="btn btn-seconday filter-icon" type="button"><i class="ti ti-filter" ></i></i></button>
      <button class="btn btn-seconday" type="button"><i class="ti ti-refresh reset-filter"></i></button>
      <a class="btn btn-seconday" href="<%base_url('customer_po_tracking_all')%>" title="Back To Sales Order"><i class="ti ti-arrow-left"></i></a>
    </div>
    <div class="w-100">
    <input type="text" name="reason" placeholder="Filter Search" class="form-control serarch-filter-input m-3 me-0" id="serarch-filter-input" fdprocessedid="bxkoib">
  </div>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        

        <!-- Main content -->
        <section class="content">
            <div class="">
                <div class="card">
                <div class="row">
                   

                        <!-- /.card -->

                        <!-- <div class="card-header">
                                <h3 class="card-title">Serch PO Number</h3>
                                <div class="row">
                                    <div class="col-lg-2">
                                            <div class="form-group">
                                                <form action="<%$base_url%>inwarding_by_po" method="POST">
                                                <label for="">Enter PO Number <span class="text-danger">*</span> </label>
                                                <input type="text" name="po_number" class="form-control" required placeholder="Enter Valid PO Number : ">
                                            </div>

                                    </div>
                                    <div class="col-lg-2">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-success mt-4">Search</button>
                                            </div>
                                            </form>
                                    </div> 
                                </div>
                            </div>-->

                            <div class="">
                                <table id="example1" class="table  table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Customer</th>
                                            <th>PO Number</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Amendment No</th>
                                            <th>Reason</th>
                                            <th>Remark</th>
                                            <th>View Details</th>
                                        </tr>
                                    </thead>
                                
                                    <tbody>
                                        <%if $customer_po_tracking%>
                                            <%foreach from=$customer_po_tracking item=s key=i%>
                                                
                                                <tr>
                                                    <td><%$i+1%></td>
                                                    <td><%$customer_data[$s->customer_id][0]->customer_name%></td>
                                                    <td><%$s->po_number%></td>
                                                    <td><%defaultDateFormat($s->po_start_date)%></td>
                                                    <td><%defaultDateFormat($s->po_end_date)%></td>
                                                    <td><%$s->po_amedment_number%></td>
                                                    <td><%$s->reason%></td>
                                                    <td><%$s->remark%></td>
                                                    <td><a href="<%$base_url%>view_customer_tracking_id/<%$s->id%>" class="btn btn-primary">PO Details</a></td>
                                                </tr>
                                            <%/foreach%>
                                        <%/if%>
                                    </tbody>

                                </table>
                            </div>
                            <!-- /.card-header -->

                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                 
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <script src="<%$base_url%>/public/js/planning_and_sales/po_tracking_closed.js"></script>