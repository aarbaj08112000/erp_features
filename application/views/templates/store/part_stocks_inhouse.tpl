
<div class="content-wrapper">
  <!-- Content -->
<%assign var='role' value=trim($session_data['type']) %>
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
                  <select name="part_id" class="form-control select2" id="search_part_name">
                          <option value="">Select Part</option>
                          <%if $customer_part_list%>
                          <%foreach from=$customer_part_list item=c %>
                            <option <%if ($filter_part_id == $c->id) %>selected <%/if%>
                               value="<%$c->part_number %>"><%$c->part_number %>
                            </option>
                          <%/foreach%>
                          <%/if%>
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
          Store
          <a hijacked="yes" href="javascript:void(0)" class="backlisting-link" >
            <i class="ti ti-chevrons-right" ></i>
            <em >Stock</em></a>
          </h1>
          <br>
          <span >Inhouse Parts Stock Transfer</span>
        </div>
      </nav>
      <!-- <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Basic Tables</h4> -->

      <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5">
        <a href="<%base_url('download_stock_variance') %>"
           class="btn btn-seconday" title="Download Stock Variance"> <i class="ti ti-download"></i> </a>
        <%if checkGroupAccess("part_stocks_inhouse","export","No")%>
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
          <table  border="1" cellspacing="0" cellpadding="0" class="table table-striped" style="border-collapse: collapse;" border-color="#e1e1e1" id="inwarding">
            <thead>
               <tr>
                  <!-- <th>Sr. No.</th> -->
                  <th>Part Number</th>
                  <th>Part Description</th>
                  <th>UOM</th>
                  <th>INHOUSE PARTS PRODUCTION STOCK</th>
                  <th>Transfer to Fg</th>
                  <th>Store Stock</th>
                  <th>Subcon Stock</th>
                  <th>Under Inspection Stock</th>
                  <th>INHOUSE PARTS STOCK RATE</th>
                  <th>Store Stock Value</th>



                  <!-- <th>Safety Buffer Stock</th> -->
                  <!-- <th>Stock Reserve against Job order</th> -->
                  <!-- <th>store_scrap</th> -->
                  <th>Store Rejection Stock</th>
                  <th>Production Rejection Stock</th>
                  <th>GRN Rejection Stock</th>
                  <th>Store Rack Location</th>
                  <th>Production Scrap</th>
                  <th>Production Rejection</th>
               </tr>
            </thead>
            <%* <tfoot>
               <th colspan="8"></th>
               <th colspan="2">Total Store Stock Value</th>
               <th colspan="2"> <input type="number" readonly name="total_value"
                  id="total_value_id" class="form-control">
               </th>
            </tfoot> *%>

            <tbody>
               <%assign var='i' value=1 %>

                  <%if ($filtered_cust_part) %>
                      <%if ($filtered_cust_part) %>
                          <%foreach from=$filtered_cust_part item=po %>
                              <%assign var='stock' value=$po->stock %>
                              <%assign var='prodQtyColName' value=$po->prodQtyColName %>
                              <%assign var='uom_data' value=$po->uom_data %>
                              <%assign var='underinspection_stock' value=$po->underinspection_stock %>
                              <%assign var='scrap_stock' value=$po->scrap_stock %>
                              <%assign var='child_part_present' value=$po->child_part_present %>
                      <tr>
                          <!--<td><%$po->id %></td>-->
                          <td><%$po->part_number %></td>
                          <td><%$po->part_description %></td>
                          <td><%$uom_data[0]->uom_name %></td>
                           <td>
                             <%if ($child_part_present == "yes") && checkGroupAccess("part_stocks_inhouse","update","No") %>
                                    <%if ($po->$prodQtyColName > 0) %>
                                           <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                              data-bs-target="#edit<%$i %>">
                                           <%$po->$prodQtyColName %>
                                           </button>
                                           <div class="modal fade" id="edit<%$i %>" tabindex="-1"
                                              role="dialog" aria-labelledby="exampleModalLabel">
                                              <div class="modal-dialog modal-dialog-centered" role="document">
                                                 <div class="modal-content">
                                                    <div class="modal-header">
                                                       <h5 class="modal-title" id="exampleModalLabel">Transfer
                                                          Production stock to store stock
                                                       </h5>
                                                       <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                          aria-label="Close">
                                                       </button>
                                                    </div>
                                                    <form
                                                                action="<%base_url('update_production_qty') %>"
                                                                method="POST" enctype="multipart/form-data" id="update_production_qty<%$po->id %>" class="update_production_qty update_production_qty<%$po->id %> custom-form">
                                                    <div class="modal-body">
                                                       <div class="row">
                                                          <div class="col-lg-12">
                                                              <div class="form-group">
                                                                <label for="">Production Qty <span
                                                                   class="text-danger">*</span>
                                                                </label>
                                                                <input type="text" step="any" class="form-control onlyNumericInput required-input"
                                                                   value=""
                                                                   data-max=" <%$po->$prodQtyColName %>"
                                                                   name="production_qty" data-min="1" 
                                                                   placeholder="Enter Transfer Qty">
                                                                <input type="hidden" class="form-control"
                                                                   value="<%$po->part_number %>"
                                                                   name="part_number" required
                                                                   placeholder="Enter Transfer Qty">
                                                              </div>
                                                          </div>
                                                       </div>
                                                       <div class="modal-footer">
                                                       <button type="button" class="btn btn-secondary"
                                                          data-bs-dismiss="modal">Close</button>
                                                       <button type="submit" class="btn btn-primary">Save
                                                       changes</button>
                                                       </form>
                                                       </div>
                                                    </div>
                                                 </div>
                                              </div>
                                    <%else %>
                                      <%$po->$prodQtyColName %>
                                    <%/if%>
                              <%else %>
                                  <%$po->$prodQtyColName %>
                              <%/if%>

                          </td>

                          <td>
                            <%if ($po->$prodQtyColName > 0) && checkGroupAccess("part_stocks_inhouse","update","No")%>
                                    <%*if ($role == "Admin" || $role == "production") *%>
                                  <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                     data-bs-target="#fgtransfer<%$i %>">
                                  Transfer to FG
                                  </button>
                                  <div class="modal fade" id="fgtransfer<%$i %>" tabindex="-1"
                                     role="dialog" aria-labelledby="exampleModalLabel">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Transfer
                                    Production QTY to FG
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                       aria-label="Close">

                                    </button>
                                    </div>
                                     <form
                                       action="<%base_url('transfer_child_part_to_fg_stock_inhouse') %>" id="transfer_child_part_to_fg_stock_inhouse<%$po->id %>"
                                       method="POST" enctype="multipart/form-data" class="transfer_child_part_to_fg_stock_inhouse transfer_child_part_to_fg_stock_inhouse<%$po->id %> custom-form">
                                    <div class="modal-body">
                                    <div class="row">
                                    <div class="col-lg-12">
                                      <div class="form-group">
                                    <label for="">Enter Stock Qty <span
                                       class="text-danger">*</span>
                                    </label>
                                    <input type="text" step="any"
                                       class="form-control onlyNumericInput required-input" value=""
                                       data-max="<%$po->$prodQtyColName %>"
                                       name="stock" 
                                       placeholder="Enter Transfer Qty">
                                    <input type="hidden" class="form-control"
                                       value="<%$po->part_number %>"
                                       name="part_number" required
                                       placeholder="Enter Transfer Qty">
                                    <input type="hidden" class="form-control"
                                       value="<%$po->id %>"
                                       name="child_part_id" required
                                       placeholder="Enter Transfer Qty">
                                    </div>
                                    </div>
                                    <div class="col-lg-12">
                                      <div class="form-group" inerts>
                                    <label for=""><br>Select Customer Part Number /
                                    Customer Name </label>
                                    <div class="w-100">
                                    <select name="customer_part_number" 
                                       class="form-control w-100   required-input" style="width: 100%;">
                                    <option value="">Select Part</option>
                                    <%if ($transfer_part_list) %>
                                           <%foreach from=$transfer_part_list item=t %>
                                        <option value="<%$t->part_number %>">
                                          <%$t->part_number %>
                                        </option>
                                        <%/foreach%>
                                    <%/if%>
                                    </select>
                                  </div>  
                                  </div>
                                    </div>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button"  class="btn btn-secondary" data-dismiss="modal"
                                       aria-label="Close">Close</button>
                                    <button type="submit" class="btn btn-primary">Save
                                    changes</button>
                                    </form>
                                    </div>
                                    </div>
                                    </div>
                                  </div>
                                <%*/if*%>
                            <%else %>
                               <%$po->$prodQtyColName %>
                            <%/if%>
                          </td>                                                                   
                          <!-- <td><%$po->safty_buffer_stk %></td> -->
                          <td class="<%if ($po->safty_buffer_stk <= $stock) %>text-success<%else %>text-danger <%/if%>"><%$stock %></td>
                          <td><%$po->sub_con_stock %></td>
                          <td><%$po->onhold_stock %></td>
                          <td><%$underinspection_stock %></td>
                           <td><%$po->store_stock_rate %></td>
                          <!-- <td><%($stock) * ($po->store_stock_rate)  %></td> -->


                          <td><%$po->rejection_stock %></td>
                          <td><%$po->rejection_prodcution_qty %></td>
                          
                          <td><%$scrap_stock %></td>
                          <td><%$po->store_rack_location %></td>
                         
                          <td><%$po->production_rejection %></td>
                          <td><%$po->production_scrap %></td>
                          
                      </tr>
                      <%assign var='i' value=$i+1 %>
                      <%/foreach%>
                    <%/if%>
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
  <style type="text/css">
    .chosen-container {
    width: 100% !important;
}
.modal-body .row {
    overflow-y: unset !important; 
    
}
.chosen-container-single .chosen-single{
    display: block !important;
    padding-left: 8px !important;
    padding-right: 20px !important;
    overflow: hidden !important;
    text-overflow: ellipsis !important;
    white-space: nowrap !important;
    height: 32px !important;
    padding-top: 2px !important;
    background: white !important;
    font-size: 15px !important;
}
.chosen-container .chosen-results li.highlighted {
    background-color: var(--bs-theme-color) !important;
    background-image: -webkit-gradient(linear, left top, left bottom, color-stop(20%, var(--bs-theme-color)), color-stop(90%, var(--bs-theme-color)));
    background-image: linear-gradient(var(--bs-theme-color) 20%, var(--bs-theme-color) 90%) !important;
    color: #fff !important;
}

        /* Adjust Chosen Dropdown z-index for visibility */
        .chosen-container {
            z-index: 9999 !important; /* Make sure dropdown appears on top */
        }
  </style>
  <script>
     $(function() {
         $("#total_value_id").val(<%$total_value %>);
     });
  </script>
   <script src="<%$base_url%>public/js/store/view_part_stocks_inhouse.js"></script>

