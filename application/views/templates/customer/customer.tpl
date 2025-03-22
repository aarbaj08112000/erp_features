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
                <span class="hide-menu">Customer</span>
                <span class="search-show-hide float-right"><i class="ti ti-minus"></i></span>
              </li>
              <li class="sidebar-item">
                <div class="input-group">
                  <select name="customer_name" class="form-control select2" id="customer_name">
                    <option value="">Select Customer</option>
                  <%foreach from=$customers item=t%>
                  <option
                      value="<%$t->customer_name%>"><%$t->customer_name%></option>
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
          Planning & sales
          <a hijacked="yes" href="#stock/issue_request/index" class="backlisting-link" title="Back to Issue Request Listing" >
            <i class="ti ti-chevrons-right" ></i>
            <em >Customer</em></a>
        </h1>
        <br>
        <span >Customer</span>
      </div>
    </nav>
    <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5">
      <%if checkGroupAccess("customer","add","No") %>
      <button type="button" class="btn btn-seconday float-left" data-bs-toggle="modal" data-bs-target="#exampleModal" id="addCustomer">
                                    <i class="ti ti-plus "></i>
                                </button>
      <%/if%>
      <%if checkGroupAccess("customer","export","No") %>
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
                              
                                <!-- Button trigger modal -->
                                

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                                   <div class="modal-content ">
                                      <div class="modal-header">
                                         <h5 class="modal-title" id="exampleModalLabel">Add Customer</h5>
                                         <button type="button" class="close btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <form id="addCustomerForm" action="<%$base_url%>addCustomer" method="POST">
                                         <div class="modal-body">
                                            <div class="row">
                                               <div class="col-lg-6">
                                                  <div class="form-group">
                                                     <label for="customer_name">Customer Name</label><span class="text-danger">*</span>
                                                     <input type="text" name="customerName" class="form-control" id="customer_name" placeholder="Customer Name">
                                                  </div>
                                                </div>
                                                <div class="col-lg-6">
                                                  <div class="form-group">
                                                     <label for="customer_code">Customer Code</label><span class="text-danger">*</span>
                                                     <input type="text" name="customerCode" class="form-control" id="customer_code" placeholder="Customer Code">
                                                  </div>
                                                </div>
                                                <div class="col-lg-6">
                                                  <div class="form-group">
                                                     <label for="customer_location">Customer Billing Address</label><span class="text-danger">*</span>
                                                     <input type="text" name="customerLocation" class="form-control" id="customer_billing_address" placeholder="Customer Billing Address">
                                                  </div>
                                                </div>
                                                <div class="col-lg-6">
                                                  <div class="form-group">
                                                     <label for="customer_shipping_address">Customer Shipping Address</label><span class="text-danger">*</span>
                                                     <input type="text" name="customerSaddress" class="form-control" id="customer_shipping_address" placeholder="Customer Shipping Address">
                                                  </div>
                                                </div>
                                                <div class="col-lg-6">
                                                  <div class="form-group">
                                                     <label for="customer_location">Customer Type</label><span class="text-danger">*</span>
                                                     <select class="select2" name="customerType">
                                                       <option value="Domestic">Domestic</option>
                                                       <option value="Expoter">Expoter</option>
                                                     </select>
                                                  </div>
                                                </div>
                                                <div class="col-lg-6">
                                                  <div class="form-group">
                                                     <label for="vendor_code">Vendor Code No</label><span class="text-danger">*</span>
                                                     <input type="text" name="vendor_code" class="form-control" id="vendor_code" placeholder="Add Vendor Code">
                                                  </div>
                                                </div>
                                                <div class="col-lg-6">
                                                  <div class="form-group">
                                                     <label for="state">Add State</label><span class="text-danger">*</span>
                                                     <input type="text" name="state" class="form-control" id="state" placeholder="Add State">
                                                  </div>
                                                </div>
                                                <div class="col-lg-6">
                                                  <div class="form-group">
                                                     <label for="state_no">State No</label><span class="text-danger">*</span>
                                                     <input type="text" name="state_no" class="form-control onlyNumericInput" id="state_no" placeholder="Add State No">
                                                  </div>
                                                </div>
                                                <div class="col-lg-6">
                                                  <div class="form-group">
                                                     <label for="gst_no">Add GST Number</label><span class="text-danger">*</span>
                                                     <input type="text" name="gst_no" class="form-control" id="gst_no" placeholder="Add GST Number">
                                                  </div>
                                                </div>
                                                <div class="col-lg-6">
                                                  <div class="form-group">
                                                     <label for="pan_no">PAN No</label><span class="text-danger">*</span>
                                                     <input type="text" name="pan_no" class="form-control" id="pan_no" placeholder="Add PAN No">
                                                  </div>
                                                </div>
                                                <div class="col-lg-6">
                                                  <div class="form-group">
                                                     <label for="payment_terms">Payment Terms</label><span class="text-danger">*</span>
                                                     <input type="text" min="0" name="paymentTerms" class="form-control onlyNumericInput" id="payment_terms" placeholder="Payment Terms">
                                                  </div>
                                                </div>
                                                <div class="col-lg-6">
                                                  <div class="form-group">
                                                     <label for="pos">Pos</label><span class="text-danger">*</span>
                                                     <input type="text" name="pos" class="form-control onlyNumericInput" id="pos" placeholder="Pos">
                                                  </div>
                                                </div>
                                                <div class="col-lg-6">
                                                  <div class="form-group">
                                                     <label for="address1">Address 1</label><span class="text-danger">*</span>
                                                     <input type="text" name="address1" class="form-control" id="address1" placeholder="Address 1">
                                                  </div>
                                                </div>
                                                <div class="col-lg-6">
                                                  <div class="form-group">
                                                     <label for="location">Location</label><span class="text-danger">*</span>
                                                     <input type="text" name="location" class="form-control" id="location" placeholder="Location">
                                                  </div>
                                                </div>
                                                <div class="col-lg-6">
                                                  <div class="form-group">
                                                     <label for="pin">Pin</label><span class="text-danger">*</span>
                                                     <input type="text" name="pin" class="form-control" id="pin" placeholder="Pin">
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
                                              <div class="col-lg-6">
                                                <div class="form-group">
                                                   <label for="email">Email ID (For multiple address use Comma seperated list)</label><span class="text-danger"></span>
                                                   <input type="text" name="emailId" class="form-control" aria-describedby="emailHelp" placeholder="e.g. user1@example.com,user2@example.com">
                                                </div>
                                              </div>
                                              <div class="col-lg-6">
                                                <div class="form-group">
                                                  <label>Discount</label><span class="text-danger"></span>
                                                    <input type="text" step="any" value="0" name="discount" class="form-control onlyNumericInput" aria-describedby="emailHelp" placeholder="Discount">
                                                </div>
                                              </div>
                                              <div class="col-lg-6">
                                                <div class="form-group">
                                                <label >Discount Type</label>
                                                 <br>
                                                 <div class="form-check form-check-inline mt-2">
                                                  <input  class="form-check-input" type="radio" name="discountType" checked value="NA" label="NA">
                                                  <label class="form-check-label" for="discountType">NA</label>
                                                </div>
                                                <div class="form-check form-check-inline mt-2">
                                                   <input  class="form-check-input" type="radio" name="discountType" value="Percentage">
                                                  <label class="form-check-label" for="discountType">Percentage</label>
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
                                <table id="example1" class="table  table-striped">
                                    <thead>
                                        <tr>
                                            <!-- <th>Sr. No.</th> -->
                                            <th style="display: none;">Customer Id</th>
                                            <th>Customer Name</th>
                                            <th>Customer Code</th>
                                            <th>Customer Billing Address</th>
                                            <th>Customer Shipping Address</th>
                                            <th>GST Number</th>
                                            <th>State</th>
                                            <th>State No</th>
                                            <th>Vendor Code</th>
                                            <th>Pan No</th>
                                            <th>Payment Terms</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                        <%assign var="i" value=1%>
                                        
                                        <%if $customers%>
                                            <%foreach from=$customers item=t%>
                                                <tr>
                                                    <!-- <td><%$i%></td> -->
                                                    <td style="display: none;"><%$t->id%></td>
                                                    <td><%$t->customer_name%></td>
                                                    <td><%$t->customer_code%></td>
                                                    <td><%$t->billing_address%></td>
                                                    <td><%$t->shifting_address%></td>
                                                    <td><%$t->gst_number%></td>
                                                    <td><%$t->state%></td>
                                                    <td><%$t->state_no%></td>
                                                    <td><%$t->vendor_code%></td>
                                                    <td><%$t->pan_no%></td>
                                                    <td><%$t->payment_terms%></td>
                                                    <td>
                                                      <%if checkGroupAccess("customer","update","No") %>
                                                        <a type="button" data-bs-toggle="modal" class=" edit-part" data-bs-target="#edit_modal" data-value = "<%$t->encode_data%>">
                                                            <i class="ti ti-edit"></i>
                                                        </a>
                                                      <%else%>
                                                        <%display_no_character("")%>
                                                      <%/if%>

                                                       
                                                    
                                                    </td>
                                                </tr>
                                                <%assign var="i" value=$i + 1%>
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
    <!-- /.content-wrapper -->
</div>
<div class="modal fade" id="edit_modal" role="dialog" aria-labelledby="edit_modal" aria-hidden="true">
<div class="modal-dialog modal-xl modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Customer</h5>
            <button type="button" class="close btn-close" data-bs-dismiss="modal" aria-label="Close">
               
            </button>
        </div>
        <form action="<%$base_url%>updateCustomer" id="updateCustomerForm" method="POST">
        <div class="modal-body" style="">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="customer_name">Customer Name</label><span class="text-danger">*</span>
                            <input value="<%$t->customer_name%>" readonly type="text" name="ucustomerName"  class="form-control" id="ucustomer_name" aria-describedby="emailHelp" placeholder="Customer Name">
                            <input value="<%$t->id%>" type="hidden" name="id"  class="form-control" id="customer_id" aria-describedby="emailHelp" placeholder="Customer Name">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="customer_name">Customer Code</label><span class="text-danger">*</span>
                            <input value="<%$t->customer_code%>" readonly type="text" name="ucustomerCode"  class="form-control" id="ucustomer_code" aria-describedby="emailHelp" placeholder="Customer Code">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="customer_location">Customer Billing address</label><span class="text-danger">*</span>
                            <input type="text" name="ubillingaddress" value="<%$t->billing_address%>"  class="form-control" id="ucustomer_address" aria-describedby="emailHelp" placeholder="Customer Billing Address">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="customer_location">Customer Shipping address</label><span class="text-danger">*</span>
                            <input type="text" name="ushiftingAddress" value="<%$t->shifting_address%>"  class="form-control" id="ucustomer_shifting_address" aria-describedby="emailHelp" placeholder="Customer Shipping Address">
                        </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for="customer_location">Customer Type</label><span class="text-danger">*</span>
                        <select class="select2" name="ucustomerType" id="ucustomerType">
                          <option value="Domestic">Domestic</option>
                          <option value="Expoter">Expoter</option>
                        </select>
                      </div>
                    </div>
                     <div class="col-lg-6">
                        <div class="form-group">
                            <label for="customer_location">Vendor code No</label><span class="text-danger">*</span>
                            <input type="text" value="<%$t->vendor_code%>" name="vendor_code"  class="form-control" id="uvendor_code" aria-describedby="emailHelp" placeholder="Add Vendor Code">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="customer_location">Add State</label><span class="text-danger">*</span>
                            <input type="text" name="ustate"  value="<%$t->state%>" class="form-control" id="ucustomer_state" aria-describedby="emailHelp" placeholder="Add State">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="customer_location">State No</label><span class="text-danger">*</span>
                            <input type="text" name="state_no"  value="<%$t->state_no%>" class="form-control onlyNumericInput" id="ucustomer_state_no" aria-describedby="emailHelp" placeholder="Add State No">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="customer_location">Add GST Number</label><span class="text-danger">*</span>
                            <input type="text" name="ugst_no"  value="<%$t->gst_number%>" class="form-control" id="ucustomer_gst_number" aria-describedby="emailHelp" placeholder="Add GST Number">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="payment_terms">Payment Terms</label><span class="text-danger">*</span>
                            <input type="text" value="<%$t->payment_terms%>" name="upaymentTerms"  class="form-control onlyNumericInput" id="upayment_terms" aria-describedby="emailHelp" placeholder="Payment Terms">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="customer_location">PAN No</label><span class="text-danger">*</span>
                            <input type="text" value="<%$t->pan_no%>" name="pan_no"  class="form-control" id="upan_no" aria-describedby="emailHelp" placeholder="Add PAN No">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="customer_location">Bank Details</label><span class="text-danger">*</span>
                            <textarea type="text" name="bank_details"  class="form-control" id="ubank_details" aria-describedby="emailHelp" placeholder="Add Bank Details"><%$t->bank_details%></textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="post">Pos</label><span class="text-danger">*</span>
                            <input type="text" value="<%$t->pos%>" name="pos" id ="upos" class="form-control onlyNumericInput" aria-describedby="emailHelp" placeholder="Enter Pos">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="address1">Address</label><span class="text-danger">*</span>
                            <input type="text" value="<%$t->address1%>" name="address1"  id="uaddress1" class="form-control" aria-describedby="emailHelp" placeholder="Enter Address">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="location">Location</label><span class="text-danger">*</span>
                            <input type="text" value="<%$t->location%>" name="location" id="ulocation"  class="form-control" aria-describedby="emailHelp" placeholder="Enter Location">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="location">Pin</label><span class="text-danger">*</span>
                            <input type="text" value="<%$t->pin%>" name="pin"  class="form-control" aria-describedby="emailHelp" placeholder="Enter Pin" id = "pin">
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
                                <input type="text" step="any" required min="1"  name="<%$distanceCol%>" class="form-control onlyNumericInput" aria-describedby="distanceHelp" placeholder="Distance from Client PIN" id="<%$distanceCol%>">
                             </div>
                             <%assign var='unitNo' value=$unitNo+1%>
                             <%/while%>
                          </div>
                       </div>
                    </div>
                    <div class="col-lg-6">
                       <div class="form-group">
                          <label for="email">Email ID (For multiple address use Comma seperated list)</label><span class="text-danger"></span>
                          <input type="text" name="emailId" class="form-control" aria-describedby="emailHelp" placeholder="e.g. user1@example.com,user2@example.com" id="updateEmailId">
                       </div>
                    </div>
                    <div class="col-lg-6">
                                                <div class="form-group">
                                                  <label>Discount</label><span class="text-danger"></span>
                                                    <input type="text" step="any" id="discount_val" value="0" name="discount" class="form-control onlyNumericInput" aria-describedby="emailHelp" placeholder="Discount">
                                                </div>
                                              </div>
                                              <div class="col-lg-6">
                                                <div class="form-group">
                                                <label >Discount Type</label>
                                                 <br>
                                                 <div class="form-check form-check-inline mt-2">
                                                  <input  class="form-check-input" type="radio" name="discountType"  value="NA" label="NA" id="NA">
                                                  <label class="form-check-label" for="discountType">NA</label>
                                                </div>
                                                <div class="form-check form-check-inline mt-2">
                                                   <input  id="PercentageOpt" class="form-check-input" type="radio" name="discountType" value="Percentage">
                                                  <label  class="form-check-label" for="discountType">Percentage</label>
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
<style type="text/css">
  .form-check-input{
    border: 1px solid #e1d5d5 !important;
    border-radius: 50%;
    border: 0px solid #d9dee3;
  }

</style>
<script>
    var currentUnit = <%json_encode($currentUnit)%>
</script>




<script src="<%$base_url%>/public/js/customer.js"></script>