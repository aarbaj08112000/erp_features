<%assign var='isMultiClient' value=$session_data['isMultipleClientUnits']%>
<div class="wrapper container-xxl flex-grow-1 container-p-y">
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
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
                  <span class="hide-menu">Created Date</span>
                  <span class="search-show-hide float-right"><i class="ti ti-minus"></i></span>
               </li>
               <li class="sidebar-item">
                  <div class="input-group">
                     <input type="text" name="datetimes" class="dates form-control" id="date_range_filter" />
                  </div>
               </li>
            </div>
            <div class="filter-row">
               <li class="nav-small-cap">
                  <span class="hide-menu">Status</span>
                  <span class="search-show-hide float-right"><i class="ti ti-minus"></i></span>
               </li>
               <li class="sidebar-item">
                  <select name="clientUnitFrom" id="search_Status"   class="form-control select2 required-input" >
                    <option value="">Select Status</option>
                    <option value="Pending">Pending</option>
                    <option value="Completed">Completed</option>
                  </select>
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
          <a hijacked="yes" href="#stock/issue_request/index" class="backlisting-link" title="Back to Issue Request Listing">
            <i class="ti ti-chevrons-right"></i>
            <em>Material Requisition</em></a>
        </h1>
        <br>
        <span>Material Transfer Requests</span>
      </div>
    </nav>
    <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5">
       <%if (checkGroupAccess("stock_down","add","No")) %> 
         <button type="button" class="btn btn-seconday float-left" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">
                  New Request</button>
       <%/if%>
       <%if (checkGroupAccess("stock_down","export","No")) %> 
         <button class="btn btn-seconday" type="button" id="downloadCSVBtn" title="Download CSV"><i class="ti ti-file-type-csv"></i></button>
          <button class="btn btn-seconday" type="button" id="downloadPDFBtn" title="Download PDF"><i class="ti ti-file-type-pdf"></i></button>
        <%/if%>
        <button class="btn btn-seconday filter-icon" type="button"><i class="ti ti-filter" ></i></i></button>
      <button class="btn btn-seconday" type="button"><i class="ti ti-refresh reset-filter"></i></button>
    </div>
  <!-- Main content -->
  <section class="content">
    <div class="">
      <div class="row">
        <div class="col-12">
          <!-- /.card -->
          <div class="card">
            
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
              aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Material Transfer Request</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        </button>
                  </div>
                  <div class="modal-body">
                    <form action="<%base_url('add_stock_up') %>" method="POST"
                      enctype='multipart/form-data' id="add_stock_up" class="custom-form">
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="form-group">
                            <label for="po_num">Select Part Number / Description
                            <%if ($isMultiClient == "true") %>
                              / Stock 
                            <%/if%>
                            </label><span class="text-danger">*</span>
                            <select name="part_id"  class="from-control select2 required-input" style="width: 100%;" id="material_request_part_id">
                              <option value="">Select</option>
                              <%if ($child_part) %>
                                    <%foreach from=$child_part item=c %>
                                        <%if ($c->stock > 0 ) %>
                                    <option value="<%$c->id %>">
                                      <%$c->part_number %>/ <%$c->part_description %>/<%$c->stock %>
                                    </option>
                                    <%/if%>
                                <%/foreach%>
                                <%/if%>
                            </select>
                          </div>
                          <%if ($isMultiClient == "true") %>
                            <div class="form-group">
                              <label>Transfer From Unit</label><span class="text-danger">*</span><br>
                              <select name="clientUnitFrom" id="clientIdFrom"  disabled class="form-control select2 required-input" style="width: 100%;">
                                <option value="">Select</option>
                                <%foreach from=$client_list item=cl %>
                                  <option value="<%$cl->id %>/<%$cl->client_unit %>"
                                    <%if ($clintUnitId == $cl->id ) %>selected <%/if%>
                                    ><%$cl->client_unit %>
                                  </option>
                                <%/foreach%>
                              </select>
                            </div>
                            <div class="form-group">
                              <label for="po_num">Transfer To Unit<span
                                class="text-danger">*</span></label>
                              <select name="clientUnitTo" id="clientIdTo" class="form-control select2 required-input" style="width: 100%;">
                              </select>
                            </div>
                          <%else %>
                            <input type="hidden" name="type" value="stock" placeholder="Unit from" name="clientUnitFrom" required
                              class="form-control">
                            <input type="hidden" name="type" value="production_qty" placeholder="Unit to" name="clientUnitTo" required
                            class="form-control">
                          <%/if%>
                          <div class="form-group">
                            <label for="po_num">Enter Reason <span
                              class="text-danger">*</span></label>
                            <input type="text" name="reason" 
                              placeholder="Enter Reason" class="form-control required-input">
                          </div>
                          <div class="form-group">
                            <label for="po_num">Upload document</label>
                            <input type="file" name="uploading_document"
                              class="form-control">
                          </div>
                          <div class="form-group" >
                            <label for="po_num" style="    float: left;">Enter Qty <span
                              class="text-danger">*</span></label>
                              <p id="material_transfer_request_qty"></p>
                            <input type="text" name="qty" step="any"
                              placeholder="Enter Qty" name="qty" 
                              class="form-control required-input onlyNumericInput" data-min='1'  >
                            <input type="hidden" name="type" value="minus" step="any"
                              placeholder="Enter Qty" name="qty" required
                              class="form-control">
                          </div>
                        </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                  <button type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Save</button>
                  </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="">
              <table id="example1" class="table table-striped">
                <thead>
                  <tr>
                    <th>Sr. No.</th>
                    <th>Request Number</th>
                    <th>Part Number / Description</th>
                    <th width="15%">Request Qty</th>
                    <th  width="15%">Accept Qty</th>
                    <th>Submit</th>
                    <th>UOM</th>
                    <th>Reason</th>
                    <th>Document</th>
                    <th>Request Date</th>
                    <th>Action</th>
                    <th >status</th>
                  </tr>
                </thead>
                <tbody>
                  <%assign var='i' value=1 %>
                    <%if ($stock_changes) %>
                        <%foreach from=$stock_changes item=c %>
                              <%if ($c->type == "minus") %>
                            <tr>
                                <td><%$i %></td>
                                <td><%$c->id %></td>
                                <td><%$c->part_number %>/<%$c->part_description %></td>
                                <td><%$c->qty %></td>
                                <td>
                                  <%if checkGroupAccess("stock_down","update","No") %>
                                  <%if ($c->status == "pending") %>
                                    <form action="<%base_url('accept_material_request_qty')%>" class="accept_material_request_qty accept_material_request_qty<%$i %> custom-form" method="post" id="accept_material_request_qty<%$i %>">
                                              <div class="form-group">
                                                <label style="display: none;">Accept Qty</label>
                                                <input name="accepted_qty" data-max="<%$c->stock%>" data-req-max="<%$c->qty%>" data-min="1"  type="text" step="any" class="form-control onlyNumericInput required-input">
                                            </div>
                                                <input name="id_val" value="<%$c->id %>" type="hidden" required="" class="form-control">
                                  <%else if ($c->status != "pending") %>
                                    <%$c->accepted_qty %> 
                                  <%/if%>
                                  <%else%>
                                      <%display_no_character()%> 
                                  <%/if%>
                                </td>
                                <td>

                                  <%if ($c->status == "pending") && checkGroupAccess("stock_down","update","No") %>
                                      <button type="submit" class="btn btn-danger">Submit</button>
                                    </form>
                                  <%else if ($c->status != "pending") %>
                                    <%display_no_character()%> 
                                  <%/if%>
                                </td>
                                <td><%$c->uom_name %></td>
                                <td><%$c->reason %></td>
                                <td>
                                  <%if (empty($c->uploading_document)) %>
                                    
                                  <%else %>
                                    <a class="btn btn-dark" download
                                      href="<%base_url('documents/') %><%$c->uploading_document %>">Download</a>
                                <%/if%>
                                </td>
                                <td><%$c->created_date %></td>
                                <td>
                                  <%if (checkGroupAccess("stock_down","update","No")) %> 
                                    <%if ($c->status == "pending") %>

                                       <button type="button" data-bs-toggle="modal" class="btn btn-danger " data-bs-target="#deleteInvoice<%$srNo%>">Delete</button>
                                          <div class="modal fade" id="deleteInvoice<%$srNo%>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                  <div class="modal-dialog modal-dialog-centered">
                                                                      <div class="modal-content">
                                                                          <div class="modal-header">
                                                                              <h5 class="modal-title" id="exampleModalLabel">Delete Material Transfer Requests</h5>
                                                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                                  <span aria-hidden="true">&times;</span>
                                                                              </button>
                                                                          </div>
                                                                          <div class="modal-body">
                                                                              <div class="row">
                                                                                  <form action="<%base_url('delete_material_request')%>" method="POST" class="custom-form delete_material_request<%$srNo%> delete_material_request" id="delete_material_request<%$srNo%>">
                                                                                      <div class="col-lg-12">
                                                                                          <div class="form-group">
                                                                                              <label for=""><b>Are you sure want to Delete this Material Transfer Requests?</b> </label>
                                                                                              <input name="id_val" value="<%$c->id %>" type="hidden" required="" class="form-control">
                                                                                          </div>
                                                                                      </div>
                                                                              </div>
                                                                          </div>
                                                                          <div class="modal-footer">
                                                                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                              <button type="submit" class="btn btn-primary">Delete</button>
                                                                          </div>
                                                                      </div>
                                                                      </form>
                                                                  </div>
                                                              </div>
                                    <%/if%>
                                    <%if ($c->status == "accepted") && false%>
                                         <a class="btn btn-warning transfer-stock-value"
                                          href="javascript:void(0)" data-href="<%base_url('remove_stock/') %><%$c->id %>">Click To Transfer Stock</a>
                                    <%else if ($c->status == "stock_transfered")%>
                                        stock transferred
                                    <%/if%>
                                  <%else if ($c->status == "stock_transfered")%>
                                   stock transferred
                                  <%else %>
                                      <%display_no_character("")%>
                                  <%/if%>
                                </td>
                                <td>
                                  <%if $c->status == "stock_transfered"%>
                                      Completed
                                  <%else%>
                                      Pending
                                  <%/if%>
                                </td>
                            </tr>
                          <%assign var='i' value=$i+1 %>
                          <%/if%>
                      <%/foreach%>
                    <%/if%>
                </tbody>
              </table>
            </div>
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
<script>
            var base_url = <%base_url()|json_encode%> ;
            var start_date = <%$start_date|json_encode%>;
    var end_date = <%$end_date|json_encode%>;
</script>
<!-- /.content-wrapper -->
<script>
  var table;
  var url = <%site_url("P_Molding/get_filtered_clientUnit")|@json_encode%>;
  let that = this;
        $('#date_range_filter').daterangepicker({
            singleDatePicker: false,
            showDropdowns: true,
            autoApply: true,
            locale: {
                format: 'DD/MM/YYYY' // Change this format as per your requirement
            }
        });
        dateRangePicker = $('#date_range_filter').data('daterangepicker');
        dateRangePicker.setStartDate(start_date);
        dateRangePicker.setEndDate(end_date);
  $(document).ready(function() {
     // $("#clientIdFrom").change(function() {
      var client_id = $("#clientIdFrom").val();
      $.ajax({
          url: url,
          type: "POST",
          data: {
              clientUnitFrom: client_id
          },
          cache: false,
          beforeSend: function() {},
          success: function(response) {
              if (response) {
                  $('#clientIdTo').html(response);
              } else {
                  $('#clientIdTo').html(response);
              }
  
          }
      });
      var file_name = "material_transfer_request";
      var pdf_title = "Material Transfer Requests";
      table = $("#example1").DataTable({
        dom: "Bfrtilp",
        buttons: [
            {
                extend: "csv",
                text: '<i class="ti ti-file-type-csv"></i>',
                init: function (api, node, config) {
                    $(node).attr("title", "Download CSV");
                },
                customize: function (csv) {
                        var lines = csv.split('\n');
                        var modifiedLines = lines.map(function(line) {
                            var values = line.split(',');
                            values.splice(10, 1);
                            values.splice(5, 1);
                            return values.join(',');
                        });
                        return modifiedLines.join('\n');
                    },
                    filename : file_name
                },
          
            {
                extend: "pdf",
                text: '<i class="ti ti-file-type-pdf"></i>',
                init: function (api, node, config) {
                    $(node).attr("title", "Download Pdf");
                },
                filename: file_name,
                customize: function (doc) {
                    doc.pageMargins = [15, 15, 15, 15];
                    doc.content[0].text = pdf_title;
                    doc.content[0].color = theme_color;
                    // doc.content[1].table.widths = ["19%", "19%", "13%", "13%", "15%", "15%"];
                    doc.content[1].table.body[0].forEach(function (cell) {
                        cell.fillColor = theme_color;
                    });
                    doc.content[1].table.body.forEach(function (row, index) {
                        row.splice(10, 1);
                        row.splice(5, 1);
                        row.forEach(function (cell) {
                            // Set alignment for each cell
                            cell.alignment = "center"; // Change to 'left' or 'right' as needed
                        });
                    });
                },
            },
        ],
        searching: true,
        // scrollX: true,
        scrollY: true,
        bScrollCollapse: true,
        columnDefs: [{ sortable: false, targets: 6 },{ sortable: false, targets: 4 }],
        pagingType: "full_numbers",
       
        
        });
        $('.dataTables_length').find('label').contents().filter(function() {
                return this.nodeType === 3; // Filter out text nodes
        }).remove();
        setTimeout(function(){
            $(".dataTables_length select").select2({
                minimumResultsForSearch: Infinity
            });
        },1000)
  
        $(".search-filter").on("click",function(){

            var date_range_filter = $("#date_range_filter").val();
            date_range_filter = date_range_filter.split(" - ");  // Split into start and end dates

             var startDate = $('#start-date').val();
            var endDate = $('#end-date').val();

            table.draw();

            
            
            $(".close-filter-btn").trigger( "click" )
        })
        $(".reset-filter").on("click",function(){
            dateRangePicker.setStartDate(start_date);
            dateRangePicker.setEndDate(end_date);
            table.draw();
        })
  });
  $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {

        var date_range_filter = $("#date_range_filter").val();
        date_range_filter = date_range_filter.split(" - ");

        var search_status  = $("#search_Status").val();
        
        var startDate = ((date_range_filter[0]).replaceAll("/","-")).split("-");
        startDate = startDate[1]+"-"+startDate[0]+"-"+startDate[2];
        var endDate = (date_range_filter[1]).replaceAll("/","-");
        var date = data[9]; // Date is in the second column (index 1)
        // Convert date strings to date objects for comparison
        var start = startDate ? new Date(startDate) : null;
        var end = endDate ? new Date(formatDate(endDate)) : null;
        var rowDate = new Date(formatDate(date));
        // Check if the row's date is within the range

        if (
            (start && rowDate < start) ||
            (end && rowDate > end)
        ) {
            return false;
        }

        if (search_status != "") {
            if(data[11] != search_status){
                return false;
            }
            
        }
        return true;
    });
    function formatDate(dateString) {
      var parts = dateString.split('-'); // Split the string into parts
      return parts[2] + '-' + parts[1] + '-' + parts[0]; // Reorder to YYYY-MM-DD
  }

  $("#add_stock_up").submit(function(e){
      e.preventDefault();
      let flag = formValidate("add_stock_up");
      if(flag){
        return;
      }
      var formData = new FormData($('#add_stock_up')[0]);

      $.ajax({
        type: "POST",
        url: base_url+"add_stock_up",
        // url: "add_invoice_number",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
          var responseObject = JSON.parse(response);
          var msg = responseObject.messages;
          var success = responseObject.success;
          if (success == 1) {
            toastr.success(msg);
            $(this).parents(".modal").modal("hide")
            setTimeout(function(){
              window.location.reload();
            },1000);

          } else {
            toastr.error(msg);
          }
        },
        error: function (error) {
          console.error("Error:", error);
        },
      });
    });
  $(document).on("click",".transfer-stock-value",function(e){
      e.preventDefault();
      var href = $(this).attr("data-href");
      $.ajax({
        type: "GET",
        url: href,
        // url: "add_invoice_number",,
        success: function (response) {
          var responseObject = JSON.parse(response);
          var msg = responseObject.messages;
          var success = responseObject.success;
          if (success == 1) {
            toastr.success(msg);
            $(this).parents(".modal").modal("hide")
            setTimeout(function(){
              window.location.reload();
            },1000);

          } else {
            toastr.error(msg);
          }
        },
        error: function (error) {
          console.error("Error:", error);
        },
      });
    });
  function formValidate(form_class = ''){
    let flag = false;
    $(".custom-form#"+form_class+" .required-input").each(function( index ) {
     var value = $(this).val();
          var dataMax = parseFloat($(this).attr('data-max'));
          var dataMin = parseFloat($(this).attr('data-min'));
          if(value == ''){
            flag = true;
            var label = $(this).parents(".form-group").find("label").contents().filter(function() {
              return this.nodeType === 3; // Filter out non-text nodes (nodeType 3 is Text node)
            }).text().trim();
            var exit_ele = $(this).parents(".form-group").find("label.error");
            if(exit_ele.length == 0){
              var start ="Please enter ";
              if($(this).prop("localName") == "select"){
                var start ="Please select ";
              }
              label = ((label.toLowerCase()).replace("enter", "")).replace("select", "");
              var validation_message = start+(label.toLowerCase()).replace(/[^\w\s*]/gi, '');
              var label_html = "<label class='error'>"+validation_message+"</label>";
              $(this).parents(".form-group").append(label_html)
            }
          }
          else if(dataMin !== undefined && dataMin > value){
            flag = true;
            var label = $(this).parents(".form-group").find("label").contents().filter(function() {
              return this.nodeType === 3; // Filter out non-text nodes (nodeType 3 is Text node)
            }).text().trim();
            var exit_ele = $(this).parents(".form-group").find("label.error");
            if(exit_ele.length == 0){
              var end =" must be greater than or equal to "+dataMin;
              label = ((label.toLowerCase()).replace("enter", "")).replace("select", "");
              label = (label.toLowerCase()).replace(/[^\w\s*]/gi, '');
              label = label.charAt(0).toUpperCase() + label.slice(1);
              var validation_message =label +end;
              var label_html = "<label class='error'>"+validation_message+"</label>";
              $(this).parents(".form-group").append(label_html)
            }
            }else if(dataMax !== undefined && dataMax < value){
              flag = true;
              var label = $(this).parents(".form-group").find("label").contents().filter(function() {
                return this.nodeType === 3; // Filter out non-text nodes (nodeType 3 is Text node)
              }).text().trim();
              var exit_ele = $(this).parents(".form-group").find("label.error");
              if(exit_ele.length == 0){
                var end =" must be less than or equal to "+dataMax;
                if(label == 'Accept qty'){
                    var end =" must be less than or equal to store stock "+dataMax;
                }
                
                label = ((label.toLowerCase()).replace("enter", "")).replace("select", "");
                label = (label.toLowerCase()).replace(/[^\w\s*]/gi, '');
                label = label.charAt(0).toUpperCase() + label.slice(1)
                var validation_message =label +end;
                var label_html = "<label class='error'>"+validation_message+"</label>";
                $(this).parents(".form-group").append(label_html)
              }
          }
        });
       
        return flag;
  }

  $(document).on("submit",".accept_material_request_qty,.delete_material_request",function(e){
            e.preventDefault();
           
            var href = $(this).attr("action");
            var id = $(this).attr("id");
            let flag = that.formValidate1(id);

            if(flag){
              return;
            }
            // return;
            var formData = new FormData($('.'+id)[0]);

            $.ajax({
              type: "POST",
              url: href,
              data: formData,
              processData: false,
              contentType: false,
              success: function (response) {
                var responseObject = JSON.parse(response);
                var msg = responseObject.messages;
                var success = responseObject.success;
                if (success == 1) {
                  toastr.success(msg);
                  $(this).parents(".modal").modal("hide")
                  setTimeout(function(){
                    window.location.reload();
                  },1000);

                } else {
                  toastr.error(msg);
                }
              },
              error: function (error) {
                console.error("Error:", error);
              },
            });
          });

  function formValidate1(form_class = ''){
        let flag = false;
        $(".custom-form."+form_class+" .required-input").each(function( index ) {
          var value = $(this).val();
          var dataMax = parseFloat($(this).attr('data-max'));
          var dataReqMax = parseFloat($(this).attr('data-req-max'));
          var dataMin = parseFloat($(this).attr('data-min'));
          if(value == ''){
            flag = true;
            var label = $(this).parents(".form-group").find("label").contents().filter(function() {
              return this.nodeType === 3; // Filter out non-text nodes (nodeType 3 is Text node)
            }).text().trim();
            var exit_ele = $(this).parents(".form-group").find("label.error");
            if(exit_ele.length == 0){
              var start ="Please enter ";
              if($(this).prop("localName") == "select"){
                var start ="Please select ";
              }
              label = ((label.toLowerCase()).replace("enter", "")).replace("select", "");
              var validation_message = start+(label.toLowerCase()).replace(/[^\w\s*]/gi, '');
              var label_html = "<label class='error'>"+validation_message+"</label>";
              $(this).parents(".form-group").append(label_html)
            }
          }
          else if(dataMin !== undefined && dataMin > value){
            flag = true;
            var label = $(this).parents(".form-group").find("label").contents().filter(function() {
              return this.nodeType === 3; // Filter out non-text nodes (nodeType 3 is Text node)
            }).text().trim();
            var exit_ele = $(this).parents(".form-group").find("label.error");
            if(exit_ele.length == 0){
              var end =" must be greater than or equal to "+dataMin;
              label = ((label.toLowerCase()).replace("enter", "")).replace("select", "");
              label = (label.toLowerCase()).replace(/[^\w\s*]/gi, '');
              label = label.charAt(0).toUpperCase() + label.slice(1);
              var validation_message =label +end;
              var label_html = "<label class='error'>"+validation_message+"</label>";
              $(this).parents(".form-group").append(label_html)
            }
            }else if(dataMax !== undefined && dataMax < value){
              flag = true;
              var label = $(this).parents(".form-group").find("label").contents().filter(function() {
                return this.nodeType === 3; // Filter out non-text nodes (nodeType 3 is Text node)
              }).text().trim();
              var exit_ele = $(this).parents(".form-group").find("label.error");
              if(exit_ele.length == 0){
                var end =" must be less than or equal to "+dataMax;
                var end =" must be less than or equal to "+dataMax;
                if(label == 'Accept Qty'){
                    var end =" must be less than or equal to store stock "+dataMax;
                }
                label = ((label.toLowerCase()).replace("enter", "")).replace("select", "");
                label = (label.toLowerCase()).replace(/[^\w\s*]/gi, '');
                label = label.charAt(0).toUpperCase() + label.slice(1)
                var validation_message =label +end;
                var label_html = "<label class='error'>"+validation_message+"</label>";
                $(this).parents(".form-group").append(label_html)
              }
          }else if(dataReqMax !== undefined && dataReqMax < value){
              flag = true;
              var label = $(this).parents(".form-group").find("label").contents().filter(function() {
                return this.nodeType === 3; // Filter out non-text nodes (nodeType 3 is Text node)
              }).text().trim();
              var exit_ele = $(this).parents(".form-group").find("label.error");
              if(exit_ele.length == 0){
                var end =" must be less than or equal to "+dataReqMax;
                var end =" must be less than or equal to "+dataReqMax;
                if(label == 'Accept Qty'){
                    var end =" must be less than or equal to request qty "+dataReqMax;
                }
                label = ((label.toLowerCase()).replace("enter", "")).replace("select", "");
                label = (label.toLowerCase()).replace(/[^\w\s*]/gi, '');
                label = label.charAt(0).toUpperCase() + label.slice(1)
                var validation_message =label +end;
                var label_html = "<label class='error'>"+validation_message+"</label>";
                $(this).parents(".form-group").append(label_html)
              }
          }
        });
       
        return flag;
    }


    $(document).on("change","#material_request_part_id",function(e){
      e.preventDefault();
      var part_id = $(this).val();
      $.ajax({
        type: "POST",
        url: base_url+"get_store_stock_material_request",
        data : {part_id:part_id},
        success: function (response) {
          var responseObject = JSON.parse(response);
          $("#add_stock_up #material_transfer_request_qty").html("(Stock : "+responseObject.stock+")");
        },
        error: function (error) {
          console.error("Error:", error);
        },
      });
    });


</script>
