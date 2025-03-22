
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
                <span class="hide-menu">Status</span>
                <span class="search-show-hide float-right"><i class="ti ti-minus"></i></span>
              </li>
              <li class="sidebar-item">
                <div class="input-group">
                  <select name="child_part_id" class="form-control select2" id="status_search">
                    <option value="">Select Status</option>
                    <option value="validate_grn" selected>validate_grn</option>
                    <option value="accept">accept</option>
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
          Quality
          <a hijacked="yes" href="javascript:void(0)" class="backlisting-link" title="Back to Issue Request Listing" >
            <i class="ti ti-chevrons-right" ></i>
            <em >Inward Inspection</em></a>
          </h1>
          <br>
          <span >Inward Inspection</span>
        </div>
      </nav>

      <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5">
        <%if checkGroupAccess("accept_reject_validation","export","No")%>
          <button class="btn btn-seconday" type="button" id="downloadCSVBtn" title="Download CSV"><i class="ti ti-file-type-csv"></i></button>
          <button class="btn btn-seconday" type="button" id="downloadPDFBtn" title="Download PDF"><i class="ti ti-file-type-pdf"></i></button>
        <%/if%>
        <button class="btn btn-seconday filter-icon" type="button"><i class="ti ti-filter" ></i></i></button>
        <button class="btn btn-seconday" type="button"><i class="ti ti-refresh reset-filter"></i></button>
      </div>

      <div class="w-100">
        <input type="text" name="reason" placeholder="Filter Search" class="form-control serarch-filter-input m-3 me-0" id="serarch-filter-input" fdprocessedid="bxkoib">
      </div>
        <!-- Main content -->
      <div class="card p-0 mt-4 w-100">
        <div class="table-responsive text-nowrap">
          <table width="100%" border="1" cellspacing="0" cellpadding="0" class="table table-striped" style="border-collapse: collapse;" border-color="#e1e1e1" id="accept_reject_validation">
            <thead>
               <tr>
                  <!-- <th>Sr No</th> -->
                  <th>GRN Number </th>
                  <th>GRN Date</th>
                  <th>PO Number</th>
                  <th>Supplier Name </th>
                  <th>Invoice Number</th>
                  <th>Date</th>
                  <th>Status</th>
                  <%if ($isMultiClient == "true") %>
                  <th>Delivery Unit</th>
                  <%/if%>
                  <th>View Details</th>
                  <th style="display: none">id</th>
               </tr>
            </thead>

            <tbody>
                  <%assign var='i' value=1%>
                  <%if ($inwarding_data) %>
                      <%foreach from=$inwarding_data item=t %>
                          <%if ($t->status == "validate_grn" || $t->status == "accept") %>
                       <tr>
                          <!-- <td><%$i %></td> -->
                          <td><%$t->grn_number %></td>
                          <td><%defaultDateFormat($t->invoice_date) %></td>
                          <td><%$t->po_number %></td>
                          <td><%$t->supplier_name %></td>
                          <td><%$t->invoice_number %></td>
                          <td><%defaultDateFormat($t->invoice_date) %></td>
                          <td><%$t->status %></td>
                          <%if ($isMultiClient == "true") %>
                          <td><%$t->delivery_unit %></td>
                          <%/if%>
                          <td>
                            <%if checkGroupAccess("accept_reject_validation","update","No")%>
                              <a href="<%base_url('inwarding_details_accept_reject/') %><%$t->id %>/<%$t->po_id %>"
                             class="btn btn-<%if ($t->status == "accept") %>success<%else%>danger <%/if%>" href="">Accept / Reject Details</a>
                             <%else%>
                              <%display_no_character()%>
                            <%/if%>
                          </td>
                          <td  style="display: none"w><%$t->id %></td>
                            
                       </tr>
                      <%assign var='i' value=$i+1%>
                      <%/if%>
                      <%/foreach%>
                  <%/if%>
            </tbody>
         </table>
        </div>
      </div>
      <!--/ Responsive Table -->
    </div>
    <!-- /.col -->


    <div class="content-backdrop fade"></div>
  </div>


<script type="text/javascript">
  var isMultiClient = <%$isMultiClient|@json_encode%>
</script>

  <script src="<%$base_url%>public/js/quality/accept_reject_validation.js"></script>
