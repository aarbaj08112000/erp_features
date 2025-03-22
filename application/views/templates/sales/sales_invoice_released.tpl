<div class="wrapper wrapper container-xxl flex-grow-1 container-p-y">
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
    <form action="<%base_url('sales_invoice_released')%>" method="post">
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
                <select required name="created_month" id="" class="form-control select2">
                <%foreach $month_data as $key => $val%>
                <option <%if $month_number[$key] eq $created_month%>selected<%/if%>
                    value="<%$month_number[$key]%>"><%$val%></option>
            <%/foreach%>
                </select>
                </div>
              </li>
            </div>
            <div class="filter-row">
              <li class="nav-small-cap">
                <span class="hide-menu">Select Year</span>
                <span class="search-show-hide float-right"><i class="ti ti-minus"></i></span>
              </li>
              <li class="sidebar-item">
              <div class="input-group">
              <select required name="created_year" id="" class="form-control select2">
              <%foreach from=range(2022, 2027) item=i%>
                  <option <%if $i == $created_year%>selected<%/if%> value="<%$i%>"><%$i%></option>
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
    </form>
</aside>

    <nav aria-label="breadcrumb">
      <div class="sub-header-left pull-left breadcrumb">
        <h1>
          Planning & Sales
          <a hijacked="yes" href="#stock/issue_request/index" class="backlisting-link" title="Back to Issue Request Listing" >
            <i class="ti ti-chevrons-right" ></i>
            <em >Sales Invoice</em></a>
        </h1>
        <br>
        <span >View Sales Invoice</span>
      </div>
    </nav>
    <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5">
        <%if checkGroupAccess("sales_invoice_released","export","No") %>
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

        <!-- Main content -->
        <section class="content">
            <div class="">
                <div class="row">
                    <div class="col-12">
                        <!-- /.card -->
                        <div class="card">
                            

                           
                            <!-- /.card-header -->
                            <div class="">
                            <div class="table-responsive text-nowrap">
                                <table id="example1" class="table  table-striped">
                                    <thead>
                                        <tr>
                                            <!--<th>Sr.No.</th>-->
                                            <th>Invoice Date</th>
                                            <th>Vehicle Number</th>
                                            <th>Sales Invoice Number</th>
                                            <th>Customer</th>
                                            <th>View Details</th>
                                            <th>PDI</th>
                                            <th>E-Invoice Details</th>
                                            <th>Status</th>
                                            <th>E-Invoice Status</th>
                                            <th>Is EWay-Bill Available</th>
                                            <th>Total Price (Rs.)</th>
                                            <th style="width: 10%;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <%assign var="srNo" value=1%>
                                        <%if $new_sales%>
                                            <%foreach from=$new_sales item=c%>
                                                
                                                <%if isset($c->status)%>
                                                    <tr>
                                                        <!-- <td><%$srNo%></td> -->
                                                        <td><%$c->created_date%></td>
                                                        <td><%$c->vehicle_number%></td>
                                                        <td><%$c->sales_number%></td>
                                                        <td><%$c->customer_name%></td>
                                                        <td>
                                                            <%if empty($c->customer_name)%>
                                                             <form action="<%base_url('new_sales') %>" method="POST">
                                                                    <input type="hidden" name="reused_sales_no" value="<%$c->sales_number %>">
                                                                    <button style="border: none;background: white;" class="" type="submit" title="Reuse Sales Invoice"><i class="ti ti-eye"></i></button>
                                                                </form>

                                                            <%else%>
                                                            <a title="View" class="" href="<%$base_url%>view_new_sales_by_id/<%$c->id%>"><i class="ti ti-eye"></i></i></a>
                                                            <%/if%>
                                                        </td>
                                                        <td>
                                                            <a class="" href="<%$base_url%>view_PDI_inspection_report/<%$c->id%>"><i class="ti ti-eye"></i></a>
                                                        </td>
                                                        <td>
                                                            <%if $c->status != "pending"%>
                                                            <a class="" href="<%$base_url%>view_e_invoice_by_id/<%$c->id%>"><i class="ti ti-eye"></i></a>
                                                            <%else%>
                                                                <%display_no_character("")%>
                                                            <%/if%>
                                                        </td>
                                                        <td><%$c->status%></td>
                                                       
                                                        <td><%$c->Status%></td>
                                                        <td><%if isset($c->Status)%><%$c->EwbStatus%><%/if%></td>
                                                        <%assign var="sales_id" value=$c->id%>
                                                        
                                                        <td><%number_format($c->sales_total, 2)%></td>
                                                        <td>
                                                            <%if checkGroupAccess("sales_invoice_released","update","No")%>
                                                                <%if $c->status != "Cancelled" && (empty($c->Status) || $c->Status == "CANCELLED")%>
                                                                <a type="button" class="" data-bs-toggle="modal" data-bs-target="#cancelInvoice<%$srNo%>"><i class="ti ti-circle-x"></i></a>&nbsp;
                                                                <%/if%>
                                                                <%if $c->status == "pending"%>
                                                                <a type="button" data-bs-toggle="modal" class="" data-bs-target="#deleteInvoice<%$srNo%>"><i class="ti ti-trash"></i></a>
                                                                <%/if%>
                                                            <%/if%>

                                                            <div class="modal fade" id="cancelInvoice<%$srNo%>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">Update Status</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="row">
                                                                                <form action="<%base_url('cancel_sale_invoice')%>"  id="cancel_sale_invoice<%$srNo%>" class="cancel_sale_invoice<%$srNo%> cancel_sale_invoice custom-form" method="POST">
                                                                                    <div class="col-lg-12">
                                                                                        <div class="form-group">
                                                                                            <label for=""><b>Are you sure want to Cancel this invoice?</b> </label>
                                                                                            <input type="hidden" name="sales_id" value="<%$c->id%>" required class="form-control">
                                                                                            <input type="hidden" name="sales_number" value="<%$c->sales_number%>" required class="form-control">
                                                                                            <input type="hidden" name="status" value="<%$c->status%>" required class="form-control">
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
                                                            
                                                            <!-- delete model -->
                                                            <div class="modal fade" id="deleteInvoice<%$srNo%>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">Delete Invoice</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="row">
                                                                                <form action="<%base_url('delete_sale_invoice')%>" method="POST" id="delete_sale_invoice<%$srNo%>" class="delete_sale_invoice<%$srNo%> delete_sale_invoice custom-form">
                                                                                    <div class="col-lg-12">
                                                                                        <div class="form-group">
                                                                                            <label for=""><b>Are you sure want to Delete this invoice?</b> </label>
                                                                                            <input type="hidden" name="sales_id" value="<%$c->id%>" required class="form-control">
                                                                                            <input type="hidden" name="status" value="<%$c->status%>" required class="form-control">
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
                                                            <%if checkGroupAccess("sales_invoice_released","update","No")%>
                                                            <%if ($c->rejection_invoice_id == '' && $c->status =='lock') %>
                                                                <a type="button" href="<%base_url("rejection_invoices/")%><%$c->id%>" class="" title="Generate Credit Note"><i class="ti ti-credit-card-refund"></i></a>
                                                            <%else if ($c->rejection_invoice_id > 0) %>
                                                                <a type="button" href="<%base_url("view_rejection_sales_invoice_by_id/")%><%$c->rejection_invoice_id%>" class="" title="View Credit Note"><i class="ti ti-eye"></i></a>
                                                            <%/if%>
                                                            <%else%>
                                                                <%display_no_character("")%>
                                                            <%/if%>
                                                        </td>
                                                    </tr>
                                                    <%assign var="srNo" value=$srNo + 1%>
                                                <%/if%>
                                            <%/foreach%>
                                        <%/if%>
                                    </tbody>

                                    <!-- Pagination code
                                    
                                    <p><%$links%></p>
                                    <div class="row"><div class="col-sm-12 col-md-5"><div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing 1 to 10 of 10 entries</div></div><div class="col-sm-12 col-md-7"><div class="dataTables_paginate paging_simple_numbers" id="example1_paginate"><ul class="pagination"><li class="paginate_button page-item previous disabled" id="example1_previous"><a href="#" aria-controls="example1" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li><li class="paginate_button page-item active"><a href="#" aria-controls="example1" data-dt-idx="1" tabindex="0" class="page-link">1</a></li><li class="paginate_button page-item next disabled" id="example1_next"><a href="#" aria-controls="example1" data-dt-idx="2" tabindex="0" class="page-link">Next</a></li></ul></div></div></div>
                                    
                                    -->
                                </table>
                                </div>
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

<script>
var file_name = "report_prod_rejection";
var pdf_title = "Rejection Report";
$('#serarch-filter-input').on('keyup', function() {
            table.search(this.value).draw();
        });
var table = new DataTable('#example1',{
   
      dom: "Bfrtilp",
      scrollX: true, 
      buttons: [
              {     
                    extend: 'csv',
                      text: '<i class="ti ti-file-type-csv"></i>',
                      init: function(api, node, config) {
                      $(node).attr('title', 'Download CSV');
                      },
                      customize: function (csv) {
                            var lines = csv.split('\n');
                            var modifiedLines = lines.map(function(line) {
                                var values = line.split(',');
                                values.splice(13, 1);
                                return values.join(',');
                            });
                            return modifiedLines.join('\n');
                        },
                        filename : file_name
                    },
                
                  {
                    extend: 'pdf',
                    text: '<i class="ti ti-file-type-pdf"></i>',
                    init: function(api, node, config) {
                        $(node).attr('title', 'Download Pdf');
                        
                    },
                    filename: file_name,
                   
                    
                },
            ],
            searching: true,
    scrollX: true,
    order: [[0,"desc"]],
    scrollY: true,
    bScrollCollapse: true,
    columnDefs: [{ sortable: false, targets: 7 }],
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

        $(".delete_sale_invoice,.cancel_sale_invoice").submit(function(e){
            e.preventDefault();
            var href = $(this).attr("action");
            var id = $(this).attr("id");
            
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

</script>
