<div class="wrapper container-xxl flex-grow-1 container-p-y">
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
                <span class="hide-menu">Select Supplier</span>
                <span class="search-show-hide float-right"><i class="ti ti-minus"></i></span>
              </li>
              <li class="sidebar-item">
                <div class="input-group">
                <select name="supplier_id" class="form-control select2" id="supplier_id">
                <option <%if $filter_supplier_id === "All"%> selected <%/if%> value="All">All</option>
                <%foreach from=$supplier_list item=s%>
                    <option <%if $filter_supplier_id === $s->id%> selected <%/if%> value="<%$s->id%>"><%$s->supplier_name%></option>
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
          Reports
          <a hijacked="yes" href="#stock/issue_request/index" class="backlisting-link" title="Back to Issue Request Listing" >
            <i class="ti ti-chevrons-right" ></i>
            <em >Supplier Part Price</em></a>
        </h1>
        <br>
        <span >item part List</span>
      </div>
    </nav>
    <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5">
        <%if checkGroupAccess("child_part_supplier_report","export","No") %>
        <button class="btn btn-seconday" type="button" id="downloadCSVBtn" title="Download CSV"><i class="ti ti-file-type-csv"></i></button>
        <button class="btn btn-seconday" type="button" id="downloadPDFBtn" title="Download PDF"><i class="ti ti-file-type-pdf"></i></button>
        <%/if%>
      <button class="btn btn-seconday filter-icon" type="button"><i class="ti ti-filter" ></i></i></button>
      <button class="btn btn-seconday" type="button"><i class="ti ti-refresh reset-filter"></i></button>
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
                <div class="row">
                    <div class="col-12">

                        <!-- /.card -->

                        <div class="card">
                            <div class="">
                                
                                <div class="table-responsive text-nowrap">
                                <table id="child_part_supplier" class="table  table-striped">
                                    <thead>
                                        <tr>
                                          
                                        <%foreach from=$data key=key item=val%>
                                        <th><b>Search <%$val['title']%></b></th>
                                        <%/foreach%>
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
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<div class="modal fade" id="add_revison" tabindex=" -1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Revision </h5>
                <button type="button" class="close btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form id="updateChildPartForm" method="POST" enctype='multipart/form-data'>
                    <div class="row">
                        <div class="col-lg-12">

                            <input value="<%$po[0]->id%>" type="hidden" name="id" required class="form-control" id="part_id" aria-describedby="emailHelp" placeholder="Customer Name">

                            <div class="form-group">
                                <label for="po_num">Part Number </label><span class="text-danger">*</span>
                                <input type="text" value="<%$po[0]->part_number%>" name="upart_number" readonly id = "part_number" class="form-control" placeholder="Enter Part Number.">
                            </div>
                            <div class="form-group">
                                <label for="po_num">Part Description </label><span class="text-danger">*</span>
                                <input type="text" value="<%$po[0]->part_description%>" name="upart_desc" readonly id= 'part_des' required class="form-control" id="exampleInputEmail1" placeholder="Enter Part Description">
                            </div>
                            <div class="form-group">
                                <label for="po_num">Revision Date </label><span class="text-danger">*</span>
                                <input type="date" value="<%date('Y-m-d')%>" name="urevision_date" required id = 'revision_date' class="form-control" id="exampleInputEmail1" placeholder="Enter Part Price">
                            </div>
                            <div class="form-group">
                                <label for="po_num">Revision Number </label><span class="text-danger">*</span>
                                <input type="text" value="" name="urevision_no" required class="form-control" id="revision_numer" placeholder="Enter Safty/buffer stock" aria-describedby="emailHelp">
                                <input type="hidden" readonly value="<%$po[0]->supplier_id%>" name="supplier_id" required id='supplier_id' class="form-control" id="exampleInputEmail1" placeholder="Enter Safty/buffer stock" aria-describedby="emailHelp">
                            </div>
                            <div class="form-group">
                                <label for="po_num">Revision Remark </label><span class="text-danger">*</span>
                                <input type="text" value="" name="revision_remark" required class="form-control" id="revision_remark" placeholder="Enter revision_remark" aria-describedby="emailHelp">
                            </div>
                            <div class="form-group">
                                <label for="po_num">Part Price </label><span class="text-danger">*</span>
                                <input type="text" value="" name="upart_rate" required class="form-control" id="part_rate" placeholder="Enter Part Price">
                            </div>
                            <div class="form-group">
                                <label for="po_num">Quotation Document</label>
                                <input type="file" name="quotation_document" class="form-control" id="exampleInputEmail1" placeholder="Enter Revision Date" aria-describedby="emailHelp">
                            </div>
                            <div class="form-group">
                                <label> Select Tax Structure </label><span class="text-danger">*</span>
                                <select class="form-control select2" name="gst_id" style="width: 100%;">
                                    <%foreach from=$gst_structure item=c%>
                                        <option <%if $c->id == $gst_structure2[0]->id%>selected<%/if%> value="<%$c->id%>"><%$c->code%></option>
                                    <%/foreach%>
                                </select>
                            </div>

                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>

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
<script src="<%$base_url%>/public/js/reports/child_part_supplier_report.js"></script>