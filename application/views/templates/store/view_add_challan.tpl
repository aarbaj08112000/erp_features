
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
                <span class="hide-menu">Challan</span>
                <span class="search-show-hide float-right"><i class="ti ti-minus"></i></span>
              </li>
              <li class="sidebar-item">
                <div class="input-group">
                  <select name="child_part_id" class="form-control select2" id="challan_search">
                    <option value="">Select Challan</option>
                    <%foreach from=$challanNo_list item=challan%>
                    
                    <option value="<%$challan->id%>" <%if $challan_id == $challan->id %>selected<%/if%>><%$challan->challan_number %></option>
                    <%/foreach%>
                  </select>
                </div>
              </li>
            </div>
            <div class="filter-row">
              <li class="nav-small-cap">
                <span class="hide-menu">Supplier</span>
                <span class="search-show-hide float-right"><i class="ti ti-minus"></i></span>
              </li>
              <li class="sidebar-item">
                <div class="input-group">
                  <select name="child_part_id" class="form-control select2" id="supplier_search">
                    <option value="">Select Supplier</option>
                    <%foreach from=$supplier item=supplier_val%>
                    <option value="<%$supplier_val->id%>" <%if  $supplier_id == $supplier_val->id %>selected<%/if%>><%$supplier_val->supplier_name %></option>
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
          Store
          <a hijacked="yes" href="javascript:void(0)" class="backlisting-link"  >
            <i class="ti ti-chevrons-right" ></i>
            <em >Challan</em></a>
          </h1>
          <br>
          <span >View Challan</span>
        </div>
      </nav>
      <!-- <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Basic Tables</h4> -->

      <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5">
        <%if checkGroupAccess("view_add_challan","export","No")%>
          <button class="btn btn-seconday" type="button" id="downloadCSVBtn" title="Download CSV"><i class="ti ti-file-type-csv"></i></button>
          <button class="btn btn-seconday" type="button" id="downloadPDFBtn" title="Download PDF"><i class="ti ti-file-type-pdf"></i></button>
        <%/if%>
        <button class="btn btn-seconday filter-icon" type="button"><i class="ti ti-filter" ></i></i></button>
        <button class="btn btn-seconday" type="button"><i class="ti ti-refresh reset-filter"></i></button>
        <%if checkGroupAccess("view_add_challan","add","No")%>
        <button type="button" class="btn btn-seconday" title="Add Challan" data-bs-toggle="modal" data-bs-target="#exampleModal">
        <i class="ti ti-plus"></i> </button>
         <%/if%>
        <!-- <button class="btn btn-seconday" type="button"><i class="ti ti-refresh reset-filter"></i></button> -->
      </div>

      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Add Challan</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                  </button>
               </div>
               <div class="modal-body">
                  <form action="javascript:void(0)" method="post" class="add_challan custom-form">
                     <div class="row">
                        <div class="col-lg-12">
                           <div class="form-group">
                              <label for="Enter Challan Number">Select Supplier <span class="text-danger">*</span> </label>
                              <select class="form-control select2 required-input" name="supplier_id" style="width: 100%;" >
                                 <option value="">Select</option>
                                 <%foreach from=$supplier item=c %>
                                   <option value="<%$c->id %>">
                                      <%$c->supplier_name %>
                                   </option>
                               <%/foreach%>
                              </select>
                           </div>
                        </div>
                        <div class="col-lg-12 ship_addressType_row">
                           <div class="form-group">
                              <label>Shipping Address <span class="text-danger">*</span></label>
                              <div class="row">
                                 <div class="col-lg-4">
                                    <input type="radio" name="ship_addressType" checked value="supplier" onchange="toggleConsigneeSelection()">
                                    <label>Same as Supplier</label><br>
                                 </div>
                                 <div class="col-lg-4 ship_addressType_consignee" >
                                    <input type="radio" name="ship_addressType" value="consignee" onchange="toggleConsigneeSelection()">
                                    <label>Select Consignee Address</label><br>
                                    <div style="display: none" class="select_box">
                                    <select name="consignee" id="consigneeSelect"  disabled  class="form-control select2">
                                       <option value="">Select</option>
                                       <%foreach from=$consignee_list item=c %>
                                         <option value="<%$c->id %>">
                                            <%$c->consignee_name %> - <%$c->location %>
                                         </option>
                                       <%/foreach%>
                                    </select>
                                     </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-lg-12">
                           <div class="form-group">
                              <label for="">Enter Remark <span class="text-danger">*</span></label>
                              <input type="text" placeholder="Enter Remark" value="" name="remark" class="form-control required-input">
                           </div>
                        </div>
                        <div class="col-lg-12">
                           <div class="form-group">
                              <label for="">Enter Mode Of Transport <span class="text-danger">*</span></label>
                              <input type="text" placeholder="Enter Mode Of Transport" value="" name="mode" class="form-control required-input">
                           </div>
                        </div>
                        <div class="col-lg-12">
                           <div class="form-group">
                              <label for="">Enter Transporter <span class="text-danger">*</span></label>
                              <input type="text" placeholder="Enter Transporter" value="" name="transpoter" class="form-control required-input">
                           </div>
                        </div>
                        <div class="col-lg-12">
                           <div class="form-group">
                              <label for="">Enter Vehicle No. <span class="text-danger">*</span></label>
                              <input type="text" placeholder="Enter Vehicle No" value="" name="vechical_number" class="form-control required-input">
                           </div>
                        </div>
                        <div class="col-lg-12">
                           <div class="form-group">
                              <label for="">Enter L.R No <span class="text-danger">*</span></label>
                              <input type="text" placeholder="Enter L.R No" value="" name="l_r_number" class="form-control required-input">
                           </div>
                        </div>
                     </div>
               </div>
               <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary">Save
               changes</button>
               </div>
            </div>
            </form>
         </div>
      </div>

       <!-- Responsive Table -->
    <div class="w-100">
        <input type="text" name="reason" placeholder="Filter Search" class="form-control serarch-filter-input m-3 me-0" id="serarch-filter-input" fdprocessedid="bxkoib">
    </div>
      <!-- Main content -->
      <div class="card p-0 mt-4 w-100">
        <div class="table-responsive text-nowrap">
        <table width="100%" border="1" cellspacing="0" cellpadding="0" class="table table-striped" style="border-collapse: collapse;" border-color="#e1e1e1" id="view_add_challan">
            <thead>
                <tr>
                    <%foreach from=$data key=key item=val%>
                    <th><b>Search <%$val['title']%></b></th>
                    <%/foreach%>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
        </div>
      </div>
      <!--/ Responsive Table -->
    </div>
    <!-- /.col -->


    <div class="content-backdrop fade"></div>
  </div>
  <!-- <style type="text/css">
     .dataTables_scrollHeadInner table,.dataTables_scrollBody table{
        width: 100% !important;
     }
     .dataTables_scrollHeadInner{
            width: 99.1%;
     }
  </style> -->
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> -->
  <!-- script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script -->
  <!-- <script>
     function toggleConsigneeSelection() {
        var consigneeSelect = document.getElementById("consigneeSelect");
        var shipAddressType = document.querySelector('input[name="ship_addressType"]:checked').value;

        if (shipAddressType === "supplier") {
             consigneeSelect.disabled = true;
             consigneeSelect.style.display = "none";
            // consigneeSelect.value = ''; //change to default value as select.
        } else if (shipAddressType === "consignee") {
            consigneeSelect.disabled = false;
            consigneeSelect.style.display = "block";
        }
     }


     $(document).ready(function() {
        var consigneeSelect = document.getElementById("consigneeSelect");
        consigneeSelect.style.display = "none";
        var customer_id = $("#customer_tracking").val();
     });
  </script> -->
  <script>
      function toggleConsigneeSelection() {
          var shipAddressType = $('input[name="ship_addressType"]:checked').val();
          var consigneeSelect = $('#consigneeSelect');
          $("#consigneeSelect").removeClass("required-input");
          if (shipAddressType === "supplier") {
            $(".ship_addressType_consignee .select_box").hide();
             $(".ship_addressType_row .error").remove();
              consigneeSelect.prop('disabled', true);
              consigneeSelect.hide();
              $("#consigneeSelect").val("").trigger("change");
              // consigneeSelect.val(''); //change to default value as select.
          } else if (shipAddressType === "consignee") {
              $(".ship_addressType_consignee .select_box").show();
              consigneeSelect.prop('disabled', false);
              $("#consigneeSelect").addClass("required-input");
              consigneeSelect.show();
          }
      }

      $(document).ready(function() {
          var consigneeSelect = $('#consigneeSelect');
          consigneeSelect.hide();
          var customer_id = $("#customer_tracking").val();
      });
  </script>
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
 var challan_id =  <%$challan_id|json_encode%>;
 var supplier_id = <%$supplier_id|json_encode%>;
</script>

  <script src="<%$base_url%>public/js/store/view_add_challan.js"></script>
