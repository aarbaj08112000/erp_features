<div  class="wrapper container-xxl flex-grow-1 container-p-y">
    <!-- Navbar -->
    <!-- /.navbar -->
    <!-- Main Sidebar Container -->
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
            <div class="filter-row">
              <li class="nav-small-cap">
                <span class="hide-menu">Select Month</span>
                <span class="search-show-hide float-right"><i class="ti ti-minus"></i></span>
              </li>
              <li class="sidebar-item">
                <div class="input-group">
                  <select name="consignee_name" class="form-control select2" id="consignee_name">
                  <%foreach $consignee_list as $t %>
                  <option 
                      value="<%$t->consignee_name%>"><%$t->consignee_name%></option>
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
        <span >Consignee</span>
      </div>
    </nav>
    <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5">
        <%if checkGroupAccess("consignee","export","No") %>
          <button class="btn btn-seconday" type="button" id="downloadCSVBtn" title="Download CSV"><i class="ti ti-file-type-csv"></i></button>
          <button class="btn btn-seconday" type="button" id="downloadPDFBtn" title="Download PDF"><i class="ti ti-file-type-pdf"></i></button>
        <%/if%>
      <button class="btn btn-seconday filter-icon" type="button"><i class="ti ti-filter" ></i></i></button>
      <button class="btn btn-seconday" type="button"><i class="ti ti-refresh reset-filter"></i></button>
        <%if checkGroupAccess("consignee","add","No") %>
            <button type="button" class="btn btn-seconday float-left" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <i class="ti ti-plus "></i></button>
        <%/if%>
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
                       <!-- /.card -->
                        <div class="card">
                            <div class="">
                               

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header ">
                                                <h5 class="modal-title" id="exampleModalLabel">Add Consignee</h5>
                                                <button type="button" class="close btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                </button>
                                            </div>
                                            <form action="<%$base_url%>add_consignee" method="POST" id="add_consnee">
                                            <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-lg-6">

                                                            <div class="form-group">
                                                                <label for="customer_name">Consignee Name</label><span class="text-danger">*</span>
                                                                <input type="text" name="cconsignee_name" required class="form-control" id="name" aria-describedby="emailHelp" placeholder="Consignee Name">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="customer_name">Location</label><span class="text-danger">*</span>
                                                                <input type="text" name="clocation" required class="form-control" id="location" aria-describedby="emailHelp" placeholder="Location">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="customer_location">Address</label><span class="text-danger">*</span>
                                                                <input type="text" name="caddress" required class="form-control" id="address" aria-describedby="emailHelp" placeholder="Address">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="customer_location">State</label><span class="text-danger">*</span>
                                                                <input type="text" name="cstate" required class="form-control" id="state" aria-describedby="emailHelp" placeholder="State">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="customer_location">State No </label><span class="text-danger">*</span>
                                                                <input type="text" name="cstate_no" required class="form-control onlyNumericInput" id="state_num" aria-describedby="emailHelp" placeholder="State No">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                             <div class="form-group">
                                                                <label for="customer_location">PIN</label><span class="text-danger">*</span>
                                                                <input type="text" name="cpin_code" required class="form-control" id="PIN" aria-describedby="emailHelp" placeholder="PIN ">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="customer_location">GST Number</label><span class="text-danger">*</span>
                                                                <input type="text" name="gst_number" required class="form-control" id="gst_no" aria-describedby="emailHelp" placeholder="GST Number">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="customer_location">PAN No</label><span class="text-danger">*</span>
                                                                <input type="text" name="cpan_no" required class="form-control" id="pan" aria-describedby="emailHelp" placeholder="PAN No">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="customer_name">Phone No</label><span class="text-danger">*</span>
                                                                <input type="text" name="cphone_no" required class="form-control" id="phone" aria-describedby="phone" placeholder="Phone No">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                           <div class="form-group">
                                                               <label for="DistanceFromClient">Distance from Client (in KM)</label><span class="text-danger">*</span>
                                                               <div class="row">
                                                                <%assign var='unitNo' value=1%>
                                                                <%while $unitNo <= $currentUnit %>
                                                                  <%assign var='distanceCol' value="distncFrmClnt$unitNo"%>
                                                                  <div class="col-lg-4 mb-3">
                                                                     <label for="DistanceFromClient">From Client <%$unitNo %></label><span class="text-danger">*</span>
                                                                     <input type="text" step="any" required min="1"  name="<%$distanceCol%>" class="form-control onlyNumericInput" aria-describedby="distanceHelp" placeholder="Distance from Client PIN">
                                                                  </div>
                                                                  <%assign var='unitNo' value=$unitNo+1%>
                                                                   <%/while%>
                                                                                                 
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
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="">
                                <table id="example1" class="table  table-striped w-100">
                                    <thead>
                                        <tr>
                                            <th  style="display: none;">Id</th>
                                            <!-- <th>Sr. No.</th> -->
                                            <th>Consignee Name</th>
                                            <th>Location</th>
                                            <th>Phone No</th>
                                            <th>Address</th>
                                            <th>State</th>
                                            <th>PIN Code</th>
                                            <th>GST No</th>
                                            <th>PAN No</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                  
                                    <tbody>
                                        <%if $consignee_list%>
                                            <%assign var="i" value=1%>
                                            <%foreach from=$consignee_list item=t%>
                                                <tr>
                                                    <td style="display: none;"><%$t->id%></td>
                                                    <!-- <td><%$i%></td> -->
                                                    <td><%$t->consignee_name%></td>
                                                    <td><%$t->location%></td>
                                                    <td><%$t->phone_no%></td>
                                                    <td><%$t->address%></td>
                                                    <td><%$t->state%></td>
                                                    <td><%$t->pin_code%></td>
                                                    <td><%$t->gst_number%></td>
                                                    <td><%$t->pan_no%></td>
                                                    <td>
                                                        <%if checkGroupAccess("consignee","update","No") %>
                                                        <a type="button" data-bs-toggle="modal" class=" edit-part" data-bs-target="#edit_modal" data-value ='<%$t->encode_data%>'> <i class="ti ti-edit"></i></a>

                                                     
                                                        <div class="modal fade" id="exampleModal3<%$i%>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <form action="<%$base_url%>delete" method="POST">
                                                                        <div class="modal-body">
                                                                            <input value="<%$t->id%>" name="id" type="hidden" required class="form-control" id="delete_id" aria-describedby="emailHelp">
                                                                            <input value="consignee" name="table_name" type="hidden" required class="form-control" id="delete" aria-describedby="emailHelp">
                                                                            Are you sure you want to delete
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                            <button type="submit" class="btn btn-danger">Delete </button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <%else%>
                                                            <%display_no_character("")%>
                                                        <%/if%>

                                                    </td>
                                                </tr>
                                                <%assign var="i" value=$i+1%>
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

    <div class="modal fade" id="edit_modal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Consignee</h5>
                <button type="button" class="close btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <form action="<%$base_url%>update_consignee" id="update_form" method="POST">
            <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">

                            <div class="form-group">
                                <label for="customer_name">Consignee Name</label><span class="text-danger">*</span>
                                <input value="<%$t->consignee_name%>" type="text" name="uconsignee_name"  class="form-control" id="uconsignee_name" aria-describedby="emailHelp" placeholder="Consignee Name" readonly>
                                <input value="<%$t->c_id%>" type="hidden" name="consignee_id"  class="form-control" id="uconsignee_ref">
                                <input value="<%$t->address_id%>" type="hidden" name="address_id"  class="form-control" id="uaddressRef">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="customer_name">Location</label><span class="text-danger">*</span>
                                <input value="<%$t->location%>" type="text" name="ulocation"  class="form-control" id="ulocation" aria-describedby="location" placeholder="Location">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="customer_location">Address</label><span class="text-danger">*</span>
                                <input type="text" name="uaddress" value="<%$t->address%>"  class="form-control" id="uaddress" aria-describedby="emailHelp" placeholder="Address">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="customer_location">State</label><span class="text-danger">*</span>
                                <input type="text" name="ustate" value="<%$t->state%>"  class="form-control" id="ustate" aria-describedby="emailHelp" placeholder="State">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="customer_location">State No </label><span class="text-danger">*</span>
                                <input type="text" name="ustate_no" value="<%$t->state_no%>"  class="form-control onlyNumericInput" id="ustate_num" aria-describedby="emailHelp" placeholder="State No">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="customer_location">PIN</label><span class="text-danger">*</span>
                                <input type="text" name="upin_code" value="<%$t->pin_code%>"  class="form-control" id="uPIN" aria-describedby="emailHelp" placeholder="PIN ">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="customer_location">GST Number</label><span class="text-danger">*</span>
                                <input type="text" name="ugst_number" value="<%$t->gst_number%>"  class="form-control" id="ugst_no" aria-describedby="emailHelp" placeholder="GST Number" readonly>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="customer_location">PAN No</label><span class="text-danger">*</span>
                                <input type="text" name="upan_no" value="<%$t->pan_no%>"  class="form-control" id="upan" aria-describedby="emailHelp" placeholder="PAN No">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="customer_name">Phone No</label><span class="text-danger">*</span>
                                <input type="text" name="uphone_no" value="<%$t->phone_no%>"  class="form-control" id="uphone" aria-describedby="phone" placeholder="Phone No">
                            </div>
                        </div>
                        <div class="col-lg-6">
                                                           <div class="form-group">
                                                               <label for="DistanceFromClient">Distance from Client (in KM)</label><span class="text-danger">*</span>
                                                               <div class="row">
                                                                <%assign var='unitNo' value=1%>
                                                                <%while $unitNo <= $currentUnit %>
                                                                  <%assign var='distanceCol' value="distncFrmClnt$unitNo"%>
                                                                  <div class="col-lg-4 mb-3">
                                                                     <label for="DistanceFromClient">From Client <%$unitNo %></label><span class="text-danger">*</span>
                                                                     <input type="text" step="any" required min="1"  name="<%$distanceCol%>" id="<%$distanceCol%>" class="form-control onlyNumericInput" aria-describedby="distanceHelp" placeholder="Distance from Client PIN">
                                                                  </div>
                                                                  <%assign var='unitNo' value=$unitNo+1%>
                                                                   <%/while%>
                                                                                                 
                                                               </div>
                                                            </div>
                                                          </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                    </div>
                    </form>
        </div>
    </div>
</div>
<script>
    var currentUnit = <%json_encode($currentUnit)%>
</script>
<script src="<%$base_url%>/public/js/consignee.js"></script>
    <!-- /.content-wrapper -->
