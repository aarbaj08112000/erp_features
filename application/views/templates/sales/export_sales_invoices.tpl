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
    <form action="<%base_url('export_invoice_released')%>" method="post">
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
            <em >Export Invoice</em></a>
        </h1>
        <br>
        <span >View Export Invoice</span>
      </div>
    </nav>
    <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5">
        <%if checkGroupAccess("export_invoice_released","add","No") %>
        <a class="btn btn-seconday" type="button"  title="Add Export Invoice" href="<%base_url('new_export_sales')%>"><i class="ti ti-plus"></i></a>
        <%/if%>
        <%if checkGroupAccess("export_invoice_released","export","No") %>
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
                            <div class="table-responsive text-nowrap w-100">
                                <table id="example1" class="table  table-striped w-100">
                                    <thead>
                                        <tr>
                                            <!--<th>Sr.No.</th>-->
                                            <th>Invoice Date</th>
                                            <th>Sales Invoice Number</th>
                                            <th>Customer</th>
                                            <th>View Details</th>
                                            <th>Status</th>
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
                                                        <td><%defaultDateFormat($c->created_date)%></td>
                                                        <td><%$c->sales_number%></td>
                                                        <td><%$c->customer_name%></td>
                                                        <td>
                                                            <a title="View" class="" href="<%$base_url%>view_export_sales_by_id/<%$c->id%>"><i class="ti ti-eye"></i></i></a>
                                                        </td>
                                                        <td><%$c->status%></td>
                                                        <td><%number_format($c->sales_total, 2)%></td>
                                                        <td>
                                                            <%if checkGroupAccess("export_invoice_released","update","No")%>
                                                                <%if $c->status != "Cancelled" && (empty($c->Status) || $c->Status == "CANCELLED")%>
                                                                <a type="button" class="" data-bs-toggle="modal" data-bs-target="#cancelInvoice<%$srNo%>"><i class="ti ti-circle-x"></i></a>&nbsp;
                                                                <%/if%>
                                                                <%if $c->status == "Pending"%>
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
                                                                                <form action="<%base_url('cancel_export_sale_invoice')%>"  id="cancel_sale_invoice<%$srNo%>" class="cancel_sale_invoice<%$srNo%> cancel_sale_invoice custom-form" method="POST">
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
                                                                                <form action="<%base_url('delete_export_sale_invoice')%>" method="POST" id="delete_sale_invoice<%$srNo%>" class="delete_sale_invoice<%$srNo%> delete_sale_invoice custom-form">
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
                                                            
                                                        </td>
                                                    </tr>
                                                    <%assign var="srNo" value=$srNo + 1%>
                                                <%/if%>
                                            <%/foreach%>
                                        <%/if%>
                                    </tbody>
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
var file_name = "export_invoice";
var pdf_title = "Export Invoice";
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
    // columnDefs: [{ sortable: false, targets: 7 }]	,
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
