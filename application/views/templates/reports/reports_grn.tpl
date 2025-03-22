<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<div class="wrapper container-xxl flex-grow-1 container-p-y">
    <!-- Content Wrapper. Contains page content -->

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
            <div class="filter-row ">
              <li class="nav-small-cap">
                <span class="hide-menu">Supplier</span>
                <span class="search-show-hide float-right"><i class="ti ti-minus"></i></span>
              </li>
              <li class="sidebar-item">
                <div class="input-group">
                <select required name="created_month" id="supplier_search" class="form-control select2">
                    <option value="">Selecte Supplier</option>
                <%foreach $supplier as $key => $val%>
                    <option value="<%$val->id%>"><%$val->supplier_name%></option>
                <%/foreach%>
                </select>
                </div>
              </li>
            </div>
            <div class="filter-row hide">
              <li class="nav-small-cap">
                <span class="hide-menu">Select Year</span>
                <span class="search-show-hide float-right"><i class="ti ti-minus"></i></span>
              </li>
              <li class="sidebar-item">
              <div class="input-group">
              <select required name="created_year" id="year" class="form-control select2">
              <%for $i = 2022 to 2027%>
                  <option <%if $i eq $created_year%>selected<%/if%> value="<%$i%>"><%$i%></option>
              <%/for%>
          </select>
              </div>
            </li>
            </div> 
            <div class="filter-row">
          <li class="nav-small-cap">
            <span class="hide-menu">GRN Date</span>
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
            <em >GRN Report</em></a>
        </h1>
        <br>
        <span >GRN Report</span>
      </div>
    </nav>
    <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5">
        <%if checkGroupAccess("reports_grn","export","No") %>
        <button class="btn btn-seconday" type="button" id="downloadOustandingReport"  data-bs-toggle="modal"
           data-bs-target="#addPromo" title="Download GRN Report"><i class="ti ti-download"></i></button>
        <button type="button" class="btn btn-seconday " data-bs-toggle="modal" data-bs-target="#exportForTally">Export For Tally</button>
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
       <div class="modal fade global-export" id="addPromo" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Download GRN Report</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                  </button>
               </div>
               <div class="modal-body">
                  <div class="form-group ps-2">
                     <form action="javascript:void(0)" method="POST"
                        enctype="multipart/form-data" id="export_oustanding_report" class="global-export">
                            
                            <div class="form-group mb-4 hide">
                              <label for="on click url " class="float-start mt-2 me-2">Export To :</label>
                               <div class="row w-50 " style="    overflow-y: unset;">
                                    <div class="form-check " style="width:36%">
                                      <div class="ms-2 mt-2">
                                          <input class="form-check-input me-2" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="csv" checked>
                                      </div>
                                      <label class="form-check-label " for="inlineRadio1">
                                        <i class="ti ti-file-type-csv"></i>
                                      </label>
                                    </div>
                                    <div class="form-check "style="width:36%">
                                      <div class="ms-2 mt-2">
                                            <input class="form-check-input me-2" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="pdf" >
                                         </div>
                                        <label class="form-check-label " for="inlineRadio2">
                                            <i class="ti ti-file-type-pdf"></i>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <%if $all_unit_export eq 'Yes'%>
                               <div class="form-group mt-2" >
                                <label for="on click url" class="float-start me-3" style="width: 17%;">Client Unit <span class="text-danger">*</span>:</label>
                                <select name="client" class="form-control select2 w-50" id="client_name">
                                  <option value="">All</option>
                                 <%foreach $client_data as $key => $val%>
                                    <option <%if $selected_unit eq $val->id%>selected<%/if%>
                                        value="<%$val->id%>"><%$val->client_unit%></option>
                                <%/foreach%>
                                  </select>
                                </div>
                            <%else%>
                               <input  type="hidden" name="client" placeholder="Enter Name"
                             class="form-control w-75" value="<%$selected_unit%>" id="client_name">
                            <%/if%>
                          <div class="form-group mt-2" >
                          <label for="on click url" class="float-start me-3" style="width: 17%;">Date <span class="text-danger">*</span>:</label>
                          <input  type="text" name="report_date" placeholder="Enter Name"
                             class="form-control w-75" id="report_date">
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
      </div>
        <!-- Content Header (Page header) -->
        <!-- 
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Reports : GRN Reports</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
                            <li class="breadcrumb-item active">GRN Reports</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section> 
        -->

        <!-- Main content -->
        <section class="content">
            <div class="">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header1">
                                <div class="row">
                                    
                                    <div class="col-lg-1"></div>
                                    <div class="col-sm-2">
                                        <%if $showDocRequestDetails == "true"%>
                                            Format No: STR-F-03 <br>
                                            Rev.Date : 11/10/2017 <br>
                                            Rev.No.  : 00
                                        <%/if%>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="exportForTally" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Export Criteria</h5>
                                        <button type="button" class="close btn-close" data-bs-dismiss="modal" aria-label="Close">
                                            <%* <span aria-hidden="true">&times;</span> *%>
                                        </button>
                                    </div>
                                    <form action="<%$base_url%>grn_excel_export" method="POST" id="grn_excel_export" class="m-2">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="">Only Accepted Status GRN will be exported.</label>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Year:</label>
                                                <select required name="search_year" id="" class="form-control select2" style="width:100%;">
                                                    <%foreach $fincYears as $fyear%>
                                                        <option <%if $fyear->startYear == $created_year%>selected<%/if%> value="<%$fyear->startYear%>"><%$fyear->displayName%></option>
                                                    <%/foreach%>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Month:</label>
                                                <span class="small"><br>Month will be ignored if GRN Number field is provided.</span>
                                                <select required name="search_month" id="" class="form-control select2"  style="width:100%;">
                                                    <%foreach $month_data as $key => $val%>
                                                        <option <%if $month_number[$key] eq $created_month%>selected<%/if%> value="<%$month_number[$key]%>"><%$val%></option>
                                                    <%/foreach%>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>GRN Number/Range:</label>
                                                <span class="small">
                                                    <br>For Individual GRN: Use only <b>number</b>, example: <b>21</b>
                                                    <br>For GRN number range: Use <b>hyphen</b>, example: <b>23-27</b>
                                                    <br>For Specific GRN: Use <b>comma</b>, example: <b>11,15,17,18</b>
                                                    <br>&nbsp;
                                                </span>&nbsp;<br>
                                                <input type="text" value="" name="grn_numbers" class="form-control" id="grn_id" aria-describedby="emailHelp">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" name="export" class="btn btn-primary" value="XML Export">Export</button>
                                        </div>
                                        </div>
                                        </form>
                            </div>
                        </div>
                        

                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="<%$base_url%>add_job_card" method="POST" enctype='multipart/form-data'>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label for="po_num">Select Customer Name / Customer Code / Part Number / Description </label><span class="text-danger">*</span>
                                                            <select name="customer_part_id" id="customer_part_id" class="from-control select2">
                                                                <%if $customer_part%>
                                                                    <%foreach $customer_part as $c%>
                                                                        <%assign var="customer" value=$Crud->get_data_by_id("customer", $c->customer_id, "id")%>
                                                                        <option value="<%$c->id%>"><%$customer[0]->customer_name%>/<%$customer[0]->customer_code%>/<%$c->part_number%>/<%$c->part_description%></option>
                                                                    <%/foreach%>
                                                                <%/if%>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="po_num">Required Quantity </label><span class="text-danger">*</span>
                                                            <input type="number" name="req_qty" placeholder="Enter Quantity" min="1" value="" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="">
                            <div class="table-responsive text-nowrap">
                                <table id="gn_report" class="table  table-striped">
                                    <thead>
                                        <tr>
                                            
                                            <th>Supplier name</th>
                                            <th>Part No</th>
                                            <th>Part Description</th>
                                            <th>Part Rate</th>
                                            <th>HSN</th>
                                            <th>UOM</th>
                                            <th>PO No</th>
                                            <th>PO Date</th>
                                            <th>GRN No</th>
                                            <th>GRN Date</th>
                                            <th>Invoice Number</th>
                                            <th>Invoice Date</th>
                                            <th>PO Qty</th>
                                            <th>Accepted QTY</th>
                                            <th>Basic Amount</th>
                                            <th>SGST</th>
                                            <th>CGST</th>
                                            <th>IGST</th>
                                            <th>TCS</th>
                                            <th>GST Total</th>
                                            <th>Total Amount With GST</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                    </tbody>
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
     var start_date = <%$start_date|json_encode%>;
    var end_date = <%$end_date|json_encode%>;
    var error_message = <%$error_message|json_encode%>;
     var export_start_date = <%$export_start_date|json_encode%>;
    var export_end_date = <%$export_end_date|json_encode%>;
</script>
<script src="<%$base_url%>/public/js/reports/gn_report.js"></script>
