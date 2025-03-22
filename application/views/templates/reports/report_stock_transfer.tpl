<div class="wrapper">
    <div class="wrapper container-xxl flex-grow-1 container-p-y">
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
                  <span class="hide-menu">Date</span>
                  <span class="search-show-hide float-right"><i class="ti ti-minus"></i></span>
               </li>
               <li class="sidebar-item">
                  <div class="input-group">
                     <input type="text" name="datetimes" class="dates form-control" id="date_range_filter" />
                  </div>
               </li>
            </div>
            <!-- <div class="filter-row">
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
            </div> -->
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
          <a hijacked="yes" href="#stock/issue_request/index" class="backlisting-link" title="Back to Issue Request Listing" >
            <i class="ti ti-chevrons-right" ></i>
            <em >Stock Transfer</em></a>
        </h1>
        <br>
        <span >Stock Transfer</span>
      </div>
    </nav>
    <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5">
        <%if checkGroupAccess("report_stock_transfer","export","No")%>
            <button class="btn btn-seconday" type="button" id="downloadCSVBtn" title="Download CSV"><i class="ti ti-file-type-csv"></i></button>
          <button class="btn btn-seconday" type="button" id="downloadPDFBtn" title="Download PDF"><i class="ti ti-file-type-pdf"></i></button>
        <%/if%>
        <button class="btn btn-seconday filter-icon" type="button"><i class="ti ti-filter" ></i></i></button>
      <button class="btn btn-seconday" type="button"><i class="ti ti-refresh reset-filter"></i></button>
    </div>
    <div class="w-100">
            <input type="text" name="reason" placeholder="Filter Search" class="form-control serarch-filter-input m-3 me-0" id="serarch-filter-input" fdprocessedid="bxkoib">
        </div>
        <section class="card p-0 mt-4 w-100">
            <div class>
                <div class="row">
                    <div class="col-12">
                        <table  class="table table-striped" id="report_stock_transfer">
                                    <thead>
                                        <tr>
                                            <!-- <th>Sr. No.</th> -->
                                            <th>Part Number From </th>
                                            <th>Part Number To </th>
                                            <th>From</th>
                                            <th>To</th>
                                            <th>Transferred Stock </th>
                                            <th>Date</th>
                                            <th>Time </th>      
                                            <th>Added By </th>                                         
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <%if $stock_report%>
                                            <%foreach from=$stock_report item=g name=report%>
                                                <tr>
                                                    <!-- <td><%$smarty.foreach.report.iteration%></td> -->
                                                    <td><%$g->part_number_from%></td>
                                                    <td><%$g->part_number_to%></td>
                                                    <td><%$g->from%></td>
                                                    <td><%$g->to%></td>
                                                    <td><%$g->actual_stock%></td>
                                                    <td><%defaultDateFormat($g->updated_time)%></td>
                                                    <td><%$g->updated_date%></td>
                                                    <td><%$g->user_name%></td>
                                                </tr>
                                            <%/foreach%>
                                        <%/if%>
                                    </tbody>
                                </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<script>
            var start_date = <%$start_date|json_encode%>;
    var end_date = <%$end_date|json_encode%>;
</script>
<script type="text/javascript">
    var table;
var file_name = "erp_users";
var pdf_title = "ERP Users";
// var accessGroupsModel = new bootstrap.Modal(document.getElementById('accessGroups'))
$(document).ready(function() {

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
    // Initialize the DataTable
    table = $("#report_stock_transfer").DataTable({
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
                            // values.splice(7, 1);
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
                        // row.splice(7, 1);
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
        lengthMenu: [[10,50,100,200,500,1000,2500], [10,50,100,200,500,1000,2500]],
        bScrollCollapse: true,
        // columnDefs: [{ sortable: false, targets: 7 }],
        pagingType: "full_numbers",
       
        
        });
        $('#serarch-filter-input').on('keyup', function() {
            table.search(this.value).draw();
        });
        $('.dataTables_length').find('label').contents().filter(function() {
                return this.nodeType === 3; // Filter out text nodes
        }).remove();
        setTimeout(function(){
            $(".dataTables_length select").select2({
                minimumResultsForSearch: Infinity
            });
        },1000)

    $(".page-access-btn").on("click",function(){
        // $(this).
    })

     $(".search-filter").on("click",function(){

            table.draw();
            $(".close-filter-btn").trigger( "click" )
        })
        $(".reset-filter").on("click",function(){
            dateRangePicker.setStartDate(start_date);
            dateRangePicker.setEndDate(end_date);
            table.draw();
        })

    
    // Custom search filter event
  
   setTimeout(function(){
    $(".select2-multiple").select2()
   },1000)
    


});
$.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {

        var date_range_filter = $("#date_range_filter").val();
        date_range_filter = date_range_filter.split(" - ");

        var search_status  = $("#search_Status").val();
        
        var startDate = (date_range_filter[0]);
        var endDate = (date_range_filter[1]);
        var date = data[5]; // Date is in the second column (index 1)
        // Convert date strings to date objects for comparison
        var start = startDate ? new Date(startDate) : null;
      
        var formattedDate = endDate.split('/').reverse().join('-'); // Converts to "2025-02-18"
        var end = new Date(formattedDate);

         var formattedDate = date.split('/').reverse().join('-');
        var rowDate = new Date((formattedDate));
        // // Check if the row's date is within the range
        
        if (
            (start && rowDate < start) ||
            (end && rowDate > end)
        ) {
            return false;
        }

       
        return true;
    });

</script>
