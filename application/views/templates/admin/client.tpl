<style>
.modal-body {
    max-height: 600px; /* Adjust the height as needed */
    overflow-y: auto;
}
</style>
<div class="content-wrapper">
  <!-- Content -->

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
                <span class="hide-menu">Part Number</span>
                <span class="search-show-hide float-right"><i class="ti ti-minus"></i></span>
              </li>
              <li class="sidebar-item">
                <div class="input-group">
                <select name="clientUnit" id="clientId" class="form-control select2" id="">
                <%foreach from=$client_list item=cl %>
                <option <%if ($filter_client === $cl->id) %>selected<%/if%>
                  value="<%$cl->client_unit %>"><%$cl->client_unit %>
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
          Admin
          <a hijacked="yes" href="javascript:void(0)" class="backlisting-link" title="Back to Issue Request Listing" >
            <i class="ti ti-chevrons-right" ></i>
            <em >Master</em></a>
          </h1>
          <br>
          <span >Client</span>
        </div>
      </nav>

      <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5">
        <%if ( $noOfClients == 0 || ($isMultiClient == "true")) %>
          <%if (checkGroupAccess("client","add","No")) %>
          <button type="button" class="btn btn-seconday float-left" title="Add Client" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="ti ti-plus"></i></button>
         
          <%/if%>
        <%/if%>
        <%if (checkGroupAccess("client","export","No")) %>
        <button class="btn btn-seconday" type="button" id="downloadCSVBtn" title="Download CSV"><i class="ti ti-file-type-csv"></i></button>
        <button class="btn btn-seconday" type="button" id="downloadPDFBtn" title="Download PDF"><i class="ti ti-file-type-pdf"></i></button>
        <%/if%>
        <button class="btn btn-seconday filter-icon" type="button"><i class="ti ti-filter" ></i></i></button>
        <button class="btn btn-seconday" type="button"><i class="ti ti-refresh reset-filter"></i></button>

      </div>

      <div class="modal fade" id="exampleModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered"  role=" document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add Client</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

              </button>
            </div>
            <div class="modal-body">
              <form action="<%base_url('addClient') %>" method="POST" id="addClient">
                <div class="row">
                 <!-- <div class="col-lg-12"> -->
                    <div class="form-group col-6">
                      <label for="Client_name">Client Unit</label><span class="text-danger">*</span>
                      <input type="text" maxlength="30" name="clientUnit"  class="form-control" id="exampleInputUnit" aria-describedby="unitHelp" placeholder="Client Unit">
                    </div>
                    <div class="form-group col-6">
                      <label for="Client_name">Client Name</label><span class="text-danger">*</span>
                      <input type="text" name="clientName"  class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Client Name">
                    </div>
                    <div class="form-group col-6">
                      <label for="contactPerson">Contact Person</label><span class="text-danger">*</span>
                      <input type="text" name="contactPerson"  class="form-control"  aria-describedby="emailHelp" placeholder="Contact Person">
                    </div>
                    <div class="form-group col-6">
                      <label for="Client_location">Client billing address</label><span class="text-danger">*</span>
                      <input type="text" name="clientBaddress"  class="form-control"  aria-describedby="emailHelp" placeholder="Client Billing Address">
                    </div>
                    <div class="form-group col-6">
                      <label for="Client_location">Client Shipping address</label><span class="text-danger">*</span>
                      <input type="text" name="clientSaddress"  class="form-control"  aria-describedby="emailHelp" placeholder="Client Shipping Address">
                    </div>
                    <div class="form-group col-6">
                      <label for="Client_location">Add GST Number</label><span class="text-danger">*</span>
                      <input type="text" name="gst_no"  class="form-control"  aria-describedby="emailHelp" placeholder="Add GST Number">
                    </div>
                    <div class="form-group col-6">
                      <label for="Client_location">Add PAN</label><span class="text-danger">*</span>
                      <input type="text" name="pan_no"  class="form-control"  aria-describedby="emailHelp" placeholder="Add GST Number">
                    </div>
                    <div class="form-group col-6">
                      <label for="Client_location">State</label><span class="text-danger">*</span>
                      <input type="text" name="state"  class="form-control"  aria-describedby="emailHelp" placeholder="State">
                    </div>
                    <div class="form-group col-6">
                      <label for="Client_location">State Code</label><span class="text-danger">*</span>
                      <input type="text" name="state_no"  class="form-control"  aria-describedby="emailHelp" placeholder="State Code">
                    </div>
                    <!-- Example single danger button -->
                    <!-- <div class="form-group">
                    <label for="payment_terms">Payment Terms</label><span class="text-danger">*</span>
                    <input type="text" name="paymentTerms" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Payment Terms">
                  </div> -->
                  <div class="form-group col-6">
                    <label for="payment_terms">Phone Number</label><span class="text-danger">*</span>
                    <input type="text"  name="phone_no"  class="form-control onlyNumericInput"  aria-describedby="emailHelp" placeholder="Phone Number">
                  </div>
                  <!-- <div class="form-group">
                    <label for="payment_terms">Bank Details</label><span class="text-danger">*</span>
                    <input type="text" name="bank_details"  class="form-control"  aria-describedby="emailHelp" placeholder="Bank Details">
                  </div> -->
                  <div class="form-group col-6">
                      <label for="payment_terms">Bank Name</label><span class="text-danger">*</span>
                      <input type="text"  name="bank_name" required class="form-control" id="bank_name" aria-describedby="emailHelp" placeholder="Bank Name">
                  </div>
                  <div class="form-group col-6">
                      <label for="payment_terms">Bank Account No</label><span class="text-danger">*</span>
                      <input type="text"  name="bank_account_no" required class="form-control" id="bank_account_no" aria-describedby="emailHelp" placeholder="Bank Account No">
                  </div>
                  <div class="form-group col-6">
                      <label for="payment_terms">Account Name</label><span class="text-danger">*</span>
                      <input type="text"  name="account_name" required class="form-control" id="account_name" aria-describedby="emailHelp" placeholder="Account Name">
                  </div>
                  <div class="form-group col-6">
                      <label for="payment_terms">IFSC Code</label><span class="text-danger">*</span>
                      <input type="text"  name="ifsc_code" required class="form-control" id="ifsc_code" aria-describedby="emailHelp" placeholder="IFSC Code">
                  </div>
                  <div class="form-group col-6">
                      <label for="payment_terms">Swift Code</label><span class="text-danger">*</span>
                      <input type="text"  name="swift_code" required class="form-control" id="swift_code" aria-describedby="emailHelp" placeholder="Swift Code">
                  </div>
                  <div class="form-group col-6">
                      <label for="payment_terms">MICR Code</label><span class="text-danger">*</span>
                      <input type="text"  name="micr_code" required class="form-control" id="micr_code" aria-describedby="emailHelp" placeholder="MICR Code">
                  </div>
                  <div class="form-group col-6">
                      <label for="payment_terms">LUT No</label><span class="text-danger">*</span>
                      <input type="text"  name="lut_no" required class="form-control" id="lut_no" aria-describedby="emailHelp" placeholder="LUT No">
                  </div>
                  <div class="form-group col-6">
                      <label for="payment_terms">LUT Date</label><span class="text-danger">*</span>
                      <input type="date"  name="lut_date" required class="form-control" id="lut_date" aria-describedby="emailHelp" placeholder="LUT Date">
                  </div>
                  <div class="form-group col-6">
                      <label for="payment_terms">AD Number</label><span class="text-danger">*</span>
                      <input type="text"  name="ad_no" required class="form-control" id="ad_no" aria-describedby="emailHelp" placeholder="AD Number">
                  </div>
                  
                  <div class="form-group col-6">
                    <label for="payment_terms">Address 1</label><span class="text-danger">*</span>
                    <input type="text" name="address1"  class="form-control" aria-describedby="emailHelp" placeholder="Address 1">
                  </div>
                  <div class="form-group col-6">
                    <label for="payment_terms">Location</label><span class="text-danger">*</span>
                    <input type="text" name="location"  class="form-control" aria-describedby="emailHelp" placeholder="Location">
                  </div>
                  <div class="form-group col-6">
                    <label for="payment_terms">Pin</label><span class="text-danger">*</span>
                    <input type="text" name="pin"  class="form-control" aria-describedby="emailHelp" placeholder="Pin">
                  </div>
                  <div class="form-group col-6">
                      <label for="email">Email ID (For multiple address use Comma seperated list)</label><span class="text-danger"></span>
                      <input type="text" name="emailId" class="form-control" aria-describedby="emailHelp" placeholder="e.g. user1@example.com,user2@example.com">
                  </div>

               <!-- </div> -->
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="w-100">
            <input type="text" name="reason" placeholder="Filter Search" class="form-control serarch-filter-input m-3 me-0" id="serarch-filter-input" fdprocessedid="bxkoib">
    </div>
    <!-- Main content -->
    <div class="card p-0 mt-4 w-100">
 

      <div class="table-responsive text-nowrap">
        <table width="100%" border="1" cellspacing="0" cellpadding="0" class="table table-striped" style="border-collapse: collapse;" border-color="#e1e1e1" id="client">
          <thead>
            <tr>
              <!-- <th>Sr. No.</th> -->
              <th>Client Unit</th>
              <th>Client Name</th>
              <th>Contact Person</th>
              <th>Client Billing Address</th>
              <th>Client Shipping Address</th>
              <th>GST Number</th>
              <th>Phone Number</th>
              <th>PAN NO</th>
              <th>State</th>
              <th>State Code</th>
              <th>Bank Details</th>
              <th>Address 1</th>
              <th>Location</th>
              <th>Pin</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <%assign var='i' value=1 %>
            <%if ($client_list) %>
            <%foreach from=$client_list item=t %>
            <tr>
              <!-- <td><%$i %></td>-->
              <td><%$t->client_unit %></td>
              <td><%$t->client_name %></td>
              <td><%$t->contact_person %></td>
              <td><%$t->billing_address %></td>
              <td><%$t->shifting_address %></td>
              <td><%$t->gst_number %></td>
              <td><%$t->phone_no %></td>
              <td><%$t->pan_no %></td>
              <td><%$t->state %></td>
              <td><%$t->state_no %></td>
              <td><%$t->bank_name %></td>
              <td><%$t->address1 %></td>
              <td><%$t->location %></td>
              <td><%$t->pin %></td>
              <td>
                <%if (checkGroupAccess("client","update","No")) %>
                <button type="submit" data-bs-toggle="modal" class="btn no-btn btn-primary edit-part" data-bs-target="#exampleModal2" data-value="<%base64_encode(json_encode($t))%>"> <i class="ti ti-edit"></i></button>
                <%else%>
                  <%display_no_character("")%>
                <%/if%>
              </td>
            </tr>
            <%assign var='i' value=$i+1 %>
            <%/foreach%>
            <%/if%>
          </tbody>
        </table>
      </div>
    </div>
    <!--/ Responsive Table -->
  </div>
  <!-- /.col -->

  <div class="modal fade" id="exampleModal2" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Client</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                        </button>
                      </div>
                      <form action="<%base_url('updateClient') %>" method="POST" id="update_client_form">
                      <div class="modal-body">
                          <div class="row">
                            
                              <div class="form-group col-6">
                                <label>Contact Unit</label><span class="text-danger">*</span>
                                <input type="label" readonly value="<%$t->client_unit %>" name="uclientUnit" required class="form-control" id="client_unit" aria-describedby="unitHelp" placeholder="Client Unit">
                              </div>
                              <div class="form-group col-6">
                                <label for="Client_name">Client Name</label><span class="text-danger">*</span>
                                <input type="text" value="<%$t->client_name  %>" name="uclientName" required class="form-control" id="client_name" aria-describedby="emailHelp" placeholder="Client Name">
                              </div>
                              <div class="form-group col-6">
                                <label for="contact_person">Contact Person</label><span class="text-danger">*</span>
                                <input type="text" value="<%$t->contact_person  %>" name="ucontactPerson" required class="form-control" id="contact_person" aria-describedby="emailHelp" placeholder="Client Code">
                              </div>
                              <div class="form-group col-6">
                                <label for="Client_location">Client billing address</label><span class="text-danger">*</span>
                                <input type="text" value="<%$t->billing_address  %>" name="uclientBaddress" required class="form-control" id="billing_address" aria-describedby="emailHelp" placeholder="Client Billing Address">
                              </div>
                              <div class="form-group col-6">
                                <label for="Client_location">Client Shipping address</label><span class="text-danger">*</span>
                                <input type="text" value="<%$t->shifting_address %>" name="uclientSaddress" required class="form-control" id="shifting_address" aria-describedby="emailHelp" placeholder="Client Shipping Address">
                              </div>
                              <div class="form-group col-6">
                                <label for="Client_location">Add GST Number</label><span class="text-danger">*</span>
                                <input type="text" value="<%$t->gst_number  %>" name="ugst_no" required class="form-control" id="gst_number" aria-describedby="emailHelp" placeholder="Add GST Number">
                              </div>
                              <div class="form-group col-6">
                                <label for="Client_location">Add PAN No</label><span class="text-danger">*</span>
                                <input type="text" value="<%$t->pan_no  %>" name="pan_no" required class="form-control" id="pan_no" aria-describedby="emailHelp" placeholder="Add GST Number">
                              </div>
                              <div class="form-group col-6">
                                <label for="Client_location">State</label><span class="text-danger">*</span>
                                <input type="text" value="<%$t->state  %>" name="state" required class="form-control" id="state" aria-describedby="emailHelp" placeholder="State">
                              </div>
                              <div class="form-group col-6">
                                <label for="Client_location">State Code</label><span class="text-danger">*</span>
                                <input type="text" value="<%$t->state_no  %>" name="state_no" required class="form-control" id="state_no" aria-describedby="emailHelp" placeholder="State Cod">
                              </div>
                              <div class="form-group col-6">
                                <label for="payment_terms">Phone Number</label><span class="text-danger">*</span>
                                <input type="text" value="<%$t->phone_no  %>" min="0" name="uphone_no" required class="form-control onlyNumericInput" id="phone_no" aria-describedby="emailHelp" placeholder="Phone Number">
                                <input type="hidden" name="id" value="<%$t->id %>" id="t-id">
                              </div>
                               <!-- <div class="form-group col-6">
                                <label for="payment_terms">Bank Details</label><span class="text-danger">*</span>
                                <input type="text" value="<%$t->bank_details  %>" name="bank_details" required class="form-control" id="bank_details" aria-describedby="emailHelp" placeholder="Bank Details">
                              </div> -->

                              <div class="form-group col-6">
                                <label for="payment_terms">Bank Name</label><span class="text-danger">*</span>
                                <input type="text" value="<%$t->bank_name  %>" name="bank_name" required class="form-control" id="u_bank_name" aria-describedby="emailHelp" placeholder="Bank Name">
                            </div>
                            <div class="form-group col-6">
                                <label for="payment_terms">Bank Account No</label><span class="text-danger">*</span>
                                <input type="text" value="<%$t->bank_account_no  %>"  name="bank_account_no" required class="form-control" id="u_bank_account_no" aria-describedby="emailHelp" placeholder="Bank Account No">
                            </div>
                            <div class="form-group col-6">
                                <label for="payment_terms">Account Name</label><span class="text-danger">*</span>
                                <input type="text" value="<%$t->account_name  %>" name="account_name" required class="form-control" id="u_account_name" aria-describedby="emailHelp" placeholder="Account Name">
                            </div>
                            <div class="form-group col-6">
                                <label for="payment_terms">IFSC Code</label><span class="text-danger">*</span>
                                <input type="text" value="<%$t->ifsc_code  %>" name="ifsc_code" required class="form-control" id="u_ifsc_code" aria-describedby="emailHelp" placeholder="IFSC Code">
                            </div>
                            <div class="form-group col-6">
                                <label for="payment_terms">Swift Code</label><span class="text-danger">*</span>
                                <input type="text" value="<%$t->swift_code  %>" name="swift_code" required class="form-control" id="u_swift_code" aria-describedby="emailHelp" placeholder="Swift Code">
                            </div>
                            <div class="form-group col-6">
                                <label for="payment_terms">MICR Code</label><span class="text-danger">*</span>
                                <input type="text" value="<%$t->micr_code  %>" name="micr_code" required class="form-control" id="u_micr_code" aria-describedby="emailHelp" placeholder="MICR Code">
                            </div>
                            <div class="form-group col-6">
                                <label for="payment_terms">LUT No</label><span class="text-danger">*</span>
                                <input type="text" value="<%$t->lut_no %>" name="lut_no" required class="form-control" id="u_lut_no" aria-describedby="emailHelp" placeholder="LUT No">
                            </div>
                            <div class="form-group col-6">
                                <label for="payment_terms">LUT Date</label><span class="text-danger">*</span>
                                <input type="date" value="<%$t->lut_date  %>" name="lut_date" required class="form-control" id="u_lut_date" aria-describedby="emailHelp" placeholder="LUT Date">
                            </div>
                            <div class="form-group col-6">
                                <label for="payment_terms">AD Number</label><span class="text-danger">*</span>
                                <input type="text" value="<%$t->ad_no  %>" name="ad_no" required class="form-control" id="u_ad_no" aria-describedby="emailHelp" placeholder="AD Number">
                            </div>
                              <div class="form-group col-6">
                                <label for="payment_terms">Address 1</label><span class="text-danger">*</span>
                                <input type="text" value="<%$t->address1  %>" name="address1" required class="form-control" id="address1" aria-describedby="emailHelp" placeholder="Address 1">
                              </div>
                              <div class="form-group col-6">
                                <label for="payment_terms">Location</label><span class="text-danger">*</span>
                                <input type="text" value="<%$t->location  %>" name="location" required class="form-control" id="location" aria-describedby="emailHelp" placeholder="Location">
                              </div>
                              <div class="form-group col-6">
                                <label for="payment_terms">Pin</label><span class="text-danger">*</span>
                                <input type="text" value="<%$t->pin %>" name="pin" required class="form-control" id="pin" aria-describedby="emailHelp" placeholder="Pin">
                              </div>
                              <div class="form-group col-6">
                                                                                        <label for="email">Email ID (For multiple address use Comma seperated list)</label><span class="text-danger"></span>
                                                                                        <input type="text" value="<%$t->emailId  %>" name="email" class="form-control" aria-describedby="emailHelp" placeholder="e.g. user1@example.com,user2@example.com"  id="emailId">
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
                </div>


  <div class="content-backdrop fade"></div>
</div>


<script type="text/javascript">
var base_url = <%$base_url|@json_encode%>
</script>

<script src="<%$base_url%>public/js/admin/client.js"></script>
