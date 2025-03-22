<%if $entitlements.isPLMEnabled%>
<div class="wrapper container-xxl flex-grow-1 container-p-y ">
    <!-- Navbar -->
    <!-- /.navbar -->
    <!-- Main Sidebar Container -->
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
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
                <span class="hide-menu">Select Parts</span>
                <span class="search-show-hide float-right"><i class="ti ti-minus"></i></span>
              </li>
              <li class="sidebar-item">
                <div class="input-group">
                <select class="form-control select2" name="customer_name" style="width: 100%;" id="customer_name">
                <option value="">Select</option>
            <%foreach from=$customer_part item=part%>
                <option 
                    value="<%$part->part_number%>"><%$part->part_number%></option>
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
                    Purchase
                    <a hijacked="yes" href="#stock/issue_request/index" class="backlisting-link" title="Back to Issue Request Listing">
                        <i class="ti ti-chevrons-right"></i>
                        <em>Customer Part</em></a>
                </h1>
                <br>
                <span>Customer Part Documents</span>
            </div>
        </nav>
        <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5 listing-btn">
            <button type="button" class="btn btn-seconday float-left" data-bs-toggle="modal" data-bs-target="#exampleModal" title="Add">
                                    Add </button> 
            
            <button class="btn btn-seconday filter-icon" type="button"><i class="ti ti-filter" ></i></i></button>
      <button class="btn btn-seconday" type="button"><i class="ti ti-refresh reset-filter"></i></button>
      <a title="Back To Customer Part" class="btn btn-seconday" href="<%$base_url%>customer_master" type="button"><i class="ti ti-arrow-left"></i></a>
        </div>
        <!-- Main content -->
        <section class="content">
            <div class="">
                <div class="row">
                    <div class="col-12">

                        <!-- /.card -->

                        <div class="card">
                            <div class="">
                            
                            <!-- search by part number -->
                            <div class="">
                            
                            <!-- /.card-header -->
                            
                            <!-- Add Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="<%$base_url%>add_customer_document" method="POST" enctype='multipart/form-data' id="add_customer_document" class="add_customer_document custom-form">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label for="po_num">Select Customer Name / Customer Code / Part Number / Description </label><span class="text-danger">*</span>
                                                            <select name="customer_master_id" id="" class="from-control select2 required-input" style="width: 100%" >
                                                                <%foreach from=$customer_part item=c%>
                                                                    <%if $customer_id == $c->customer_id%>
                                                                        <option value="<%$c->id%>"><%$customer[$c->customer_id][0]->customer_name%>/<%$customer[$c->customer_id][0]->customer_code%>/<%$c->part_number%>/<%$c->part_description%></option>
                                                                    <%/if%>
                                                                <%/foreach%>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="po_num">Document Type </label><span class="text-danger">*</span>
                                                            <select name="type" id="" class="form-control required-input">
                                                                <option value="APQP">APQP</option>
                                                                <option value="PPAP">PPAP</option>
                                                                <option value="QUALITY">QUALITY</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="po_num">Document Name</label>
                                                            <input type="text" name="document_name" class="form-control" id="exampleInputEmail1" placeholder="Enter Document Name" aria-describedby="emailHelp">
                                                            <input type="hidden" name="customer_id" value="<%$customer_id%>" class="form-control" id="exampleInputEmail1" placeholder="Enter Document Name" aria-describedby="emailHelp">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="po_num">Document <span class="text-danger">*</span></label>
                                                            <input type="file" name="document"  class="form-control required-input" id="exampleInputEmail1" placeholder="Enter Part Description" aria-describedby="emailHelp">
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
                            <!-- End of Add modal -->

                            <!-- /.card-header -->
                            <div class="">
                                <table id="customer_part_documents" class="table table-striped w-100">
                                    <thead>
                                        <tr>
                                            <!-- <th>Sr. No.</th> -->
                                            <th>Part Number</th>
                                            <th>Part Description</th>
                                            <th>APQP</th>
                                            <th>PPAP</th>
                                            <th>QUALITY </th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        <%if $search_customer_part%>
                                            <%assign var="i" value=1%>
                                            <%foreach from=$search_customer_part item=c%>
                                                <%if $customer_id == $c->customer_id%>
                                                    <tr>
                                                        <!--<td><%$i%></td>-->
                                                        <td><%$c->part_number%></td>
                                                        <td><%$c->part_description%></td>
                                                        <td><a href="<%$base_url%>part_document/<%$c->customer_id%>/<%$c->id%>/APQP" class="btn btn-info">APQP</a></td>
                                                        <td><a href="<%$base_url%>part_document/<%$c->customer_id%>/<%$c->id%>/PPAP" class="btn btn-primary">PPAP</a></td>
                                                        <td><a href="<%$base_url%>part_document/<%$c->customer_id%>/<%$c->id%>/QUALITY" class="btn btn-danger">QUALITY</a></td>
                                                    </tr>
                                                    <%assign var="i" value=$i+1%>
                                                <%/if%>
                                            <%/foreach%>
                                        <%/if%>
                                    </tbody>
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
<%/if%>
<!-- /.content-wrapper -->
    <script src="<%$base_url%>/public/js/planning_and_sales/customer_part_documents.js"></script>

