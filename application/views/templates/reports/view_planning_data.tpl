<div class="wrapper container-xxl flex-grow-1 container-p-y">
<nav aria-label="breadcrumb">
<div class="sub-header-left pull-left breadcrumb">
  <h1>
    Reports
    <a hijacked="yes" href="#stock/issue_request/index" class="backlisting-link" title="Back to Issue Request Listing" >
      <i class="ti ti-chevrons-right" ></i>
      <em >View Planning Data</em></a>
  </h1>
  <br>
  <span >View Planning Data</span>
</div>
</nav>
<div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5">
<button class="btn btn-seconday" type="button" id="downloadCSVBtn" title="Download CSV"><i class="ti ti-file-type-csv"></i></button>
<button class="btn btn-seconday" type="button" id="downloadPDFBtn" title="Download PDF"><i class="ti ti-file-type-pdf"></i></button>

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
                                <table id="view-planning-data" class="table  table-striped">
                                    <thead>
                                    
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Item part Number</th>
                                            <th>Item part Description</th>
                                            <th>BOM Qty</th>
                                            <th>Schedule Qty</th>
                                            <!-- <th>Schedule 2 Qty</th>
                                            <th>Change In Schedule Qty</th> -->
                                            <th>Required Qty</th>
                                            <th>Actual Stock</th>
                                            <th>Shortage Stock</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                  
                                        <%foreach from=$planing_data item=t key=index%>
                                        
                                            <%assign var="i" value=$index+1%>
                                            <%assign var="net_schedule" value=0%>
                                            <%assign var="req_qty" value=$t->schedule_qty * $t->bom_qty%>
                                            <%if isset($t->schedule_qty_2) && $t->schedule_qty_2 != 0%>
                                                <%assign var="net_schedule" value=$t->schedule_qty_2 - $t->schedule_qty%>
                                                <%assign var="req_qty" value=$t->required_qty + ($t->schedule_qty * $t->bom_qty) + ($net_schedule * $t->bom_qty)%>
                                            <%/if%>
                                            <%assign var="shortage_qty" value=$req_qty - $t->stock%>
                                            
                                            <tr>
                                                <td><%$i%></td>
                                                <td><%$t->part_number%></td>
                                                <td><%$t->part_description%></td>
                                                <td><%$t->bom_qty%></td>
                                                <td><%$t->schedule_qty%></td>
                                                <!-- <td><%$t->schedule_qty_2%></td>
                                                <td><%$net_schedule%></td> -->
                                                <td><%$req_qty%></td>
                                                <td><%$t->stock%></td>
                                                <td><%$shortage_qty%></td>
                                            </tr>
                                        <%/foreach%>
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
</div>
<script>
// $('#view-planning-data').DataTable({
//     $('.dataTables_length').find('label').contents().filter(function() {
//             return this.nodeType === 3; // Filter out text nodes
//         }).remove();
// });

$(document).ready(function() {
    var table = $('#view-planning-data').DataTable({
        dom: "Bfrtilp",
    });

    // Move the length dropdown to the footer
    $('.dataTables_length').appendTo('#table-footer');
    $('.dataTables_length').appendTo('#pagination');
    // Remove text nodes from length dropdown
    $('.dataTables_length').find('label').contents().filter(function() {
        return this.nodeType === 3; // Filter out text nodes
    }).remove();
    setTimeout(function(){
          $(".dataTables_length select").select2({
              minimumResultsForSearch: Infinity
          });
        },1000)

});
</script>
