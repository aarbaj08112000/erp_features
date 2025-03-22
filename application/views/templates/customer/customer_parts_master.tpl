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
            <span class="hide-menu">Select Part Number</span>
            <span class="search-show-hide float-right"><i class="ti ti-minus"></i></span>
          </li>
          <li class="sidebar-item">
            <div class="input-group">
              <select name="part_drop" class="form-control select2" id="part_drop">
              <option value="" selected disabled>Please select part</option>
              <%foreach $part_drop_data as $key => $val%>
              <option 
                  value="<%$val['id']%>"><%$val['part']%></option>
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
        <em >Customer</em></a>
    </h1>
    <br>
    <span >Part Master</span>
  </div>
</nav>
<div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5">
    <%if checkGroupAccess("customer_parts_master","add","No") %>
        <button  type="button" class="modal-title btn btn-seconday" data-bs-toggle="modal" data-bs-target="#addPromo"><i class="ti ti-plus "></i></button>
    <%/if%>
    <%if checkGroupAccess("customer_parts_master","export","No") %>
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
        <!-- <div class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h1 class="m-0 text-dark">Process Master</h1>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<%$base_url%>dashboard">Home</a></li>
                  </ol>
                </div>
              </div>
            </div>
          </div> -->
        <!-- /.content-header -->

       

        <!-- Main content -->
        <section class="content">

            <div>
                <!-- Small boxes (Stat box) -->
                <div class="row">
                   
                    <div class="col-lg-12">

                        <!-- Modal -->
                        <div class="modal fade" id="addPromo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add Part</h5>
                                        <button type="button" class="close btn-close" data-bs-dismiss="modal" aria-label="Close">
                                           
                                        </button>
                                    </div>
                                    <form action="<%$base_url%>add_customer_parts_master" method="POST" id="addCustomerPartsForm" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <div class="form-group">
                                        </div>
                                        <div class="form-group">
                                            <label for="on click url">Part Number<span class="text-danger">*</span></label> <br>
                                            <input required type="text" name="part_number" placeholder="Enter Part Number" class="form-control" value="">
                                        </div>
                                        <div class="form-group">
                                            <label for="on click url">Part Description<span class="text-danger">*</span></label> <br>
                                            <input required type="text" name="part_description" placeholder="Enter Part Description" class="form-control" value="">
                                        </div>
                                        <div class="form-group">
                                            <label for="on click url">Part Type<span class="text-danger">*</span></label> <br>
                                           <select name="part_type" class="form-control select2" >
                                              <option value="non_scrap" >Non Scrap</option>
                                              <option value="scrap" >Scrap</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="on click url">Rate<span class="text-danger">*</span></label> <br>
                                            <input required type="text" step="any" name="fg_rate" placeholder="Enter Rate" class="form-control onlyNumericInput" value="0" required>
                                        </div>
                                         <div class="form-group">
                                            <label for="on click url">Scrap Category<span class="text-danger"></span></label> <br>
                                           <select name="scrap_category" class="form-control select2" >
                                              <option value="" >Please select scrap category</option>
                                              <%foreach $scrap_category as $key => $val%>
                                              <option 
                                                  value="<%$val->scrap_category_master_id%>"><%$val->scrap_category%></option>
                                             <%/foreach%>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                        </div>
                                        </form>
                            </div>
                        </div>
                        <div class="card">

                           

                            <!-- /.card-header -->
                            <div class="">
                                <table id="customer_part_table" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>Part Number</th>
                                            <th>Part Description</th>
                                            <th>FG Stock</th>
                                            <th>Rate</th>
                                       <%*     <%if $entitlements.isPlastic != null%>
                                                <th>Grade</th>
                                            <%/if%> *%>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <%if $customer_parts_master%>
                                            <%assign var="i" value=1%>
                                            <%foreach from=$customer_parts_master item=u%>
                                                <%if $entitlements.isPlastic != null%>
                                                    
                                                    <%assign var="grade_name" value=""%>
                                                    <%if $grades_data%>
                                                        <%assign var="grade_name" value=$grades_data[$u->grade_id][0]->name%>
                                                    <%/if%>
                                                <%/if%>

                                                <tr>
                                                   
                                                    <td><%$u->part_number%></td>
                                                    <td><%$u->part_description%></td>
                                                    <td><%$u->fg_stock%></td>
                                                    <td><%$u->fg_rate%></td>
                                                 <%*   <%if $entitlements.isPlastic != null%>
                                                        <td><%$grade_name%></td>
                                                    <%/if%> *%>
                                                    <td>
                                                        <!-- Button trigger modal -->
                                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit<%$i%>">
                                                            <i class='far fa-edit'></i>
                                                        </button>
                                                        <!-- edit Modal -->
                                                       
                                                        <!-- edit Modal -->

                                                    </td>
                                                </tr>
                                                <%assign var="i" value=$i + 1%>
                                            <%/foreach%>
                                        <%/if%>
                                    </tbody>

                                </table>
                            </div>
                            <div class="modal fade" id="editpart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Update</h5>
                                        <button type="button" class="close btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        </button>
                                    </div>

                                    <div class="modal-body">
                                    <form action="<%$base_url%>update_customer_parts_master" id="updateCustomerPartsForm" method="POST" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label> Part Description</label><span class="text-danger">*</span>
                                                        <input type="hidden" readonly value="<%$id%>" name="id" required class="form-control" id="part_id" placeholder="Enter Safety/buffer stock" aria-describedby="emailHelp">
                                                        <input  type="text" name="part_description" placeholder="Enter Part Description" class="form-control" value="<%$u->part_description%>" id="edit-part-des">
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Rate<span class="text-danger">*</span></label> <br>
                                                        <input  type="text" step="any" name="fg_rate" placeholder="Enter Rate" class="form-control onlyNumericInput" value="<%$u->fg_rate%>" id="part-rate" required>
                                                    </div>
                                                    <div class="form-group">
                                                    <label for="on click url">Scrap Category<span class="text-danger"></span></label>
                                                   <select name="scrap_category" class="form-control select2" id="scrap_category_id">
                                                      <option value="" >Please select scrap category</option>
                                                      <%foreach $scrap_category as $key => $val%>
                                                      <option 
                                                          value="<%$val->scrap_category_master_id%>"><%$val->scrap_category%></option>
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
                                        </div>
                                        </form> 
                            </div>
                        </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- ./col -->
                    </div>

                </div>
                <!-- /.row -->
                <!-- Main row -->

                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
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
<script src="<%$base_url%>/public/js/customer_part_master.js"></script>