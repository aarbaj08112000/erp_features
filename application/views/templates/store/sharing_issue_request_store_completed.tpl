<div class="wrapper container-xxl flex-grow-1 container-p-y">
    <div class="content-wrapper">
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
          <a hijacked="yes" href="javascript:void(0)" class="backlisting-link" title="Back to Issue Request Listing">
            <i class="ti ti-chevrons-right"></i>
            <em>Material Requisition</em></a>
        </h1>
        <br>
        <span>Sharing Issue Request - Completed</span>
      </div>
    </nav>
     <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5">
        <a class="btn btn-seconday" href="<%base_url('sharing_issue_request_store') %>">View Pending Requests</a>
        <%if checkGroupAccess("sharing_issue_request_store_completed","export","No")%>
            <button class="btn btn-seconday" type="button" id="downloadCSVBtn" title="Download CSV"><i class="ti ti-file-type-csv"></i></button>
            <button class="btn btn-seconday" type="button" id="downloadPDFBtn" title="Download PDF"><i class="ti ti-file-type-pdf"></i></button>
        <%/if%>
        <button class="btn btn-seconday filter-icon" type="button"><i class="ti ti-filter" ></i></i></button>
      <button class="btn btn-seconday" type="button"><i class="ti ti-refresh reset-filter"></i></button>
    </div>
        <section class="content">
            <div>
                <div class="row">
                    <br>
                    <div class="col-lg-12">
                        <div class="w-100">
<input type="text" name="reason" placeholder="Filter Search" class="form-control serarch-filter-input m-3 me-0" id="serarch-filter-input" fdprocessedid="bxkoib">
</div>
                        <div class="card w-100">
                            
                            <!-- /.card-header -->
                            <div class="">
                                <table id="sharing_issue_request_store_completed" class="table  table-striped">
                                    <thead>
                                        <tr>
                                            <!-- <th>Sr No</th> -->
                                            <th>Part Number / Description / Thickness / Weight</th>
                                            <th>Status</th>
                                            <th>Date & Time</th>
                                            <th>Actual Store Stock</th>
                                            <th>Required Qty</th>
                                            <th>Accept Qty</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <%if ($sharing_issue_request) %>
                                            <%assign var='i' value=1 %>
                                            <%foreach from=$sharing_issue_request item=u %>
                                                <tr>
                                                    <!-- <td><%$i %></td> -->
                                                    <td><%$u->part_number %> /
                                                        <%$u->part_description %>/
                                                        <%$u->thickness %>/
                                                        <%$u->weight %>
                                                    </td>
                                                    <td><%$u->status %></td>
                                                    <td><%defaultDateFormat($u->created_date) %> / <%$u->created_time %></td>
                                                    <td>
                                                        <%$u->stock %>
                                                    </td>
                                                    <td><%$u->qty %></td>
                                                    <td>
                                                        <%$u->accepted_qty %>
                                                    </td>
                                                </tr>
                                            <%assign var='i' value=$i+1 %>  
                                            <%/foreach%>
                                        <%/if%>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
               </div><!-- /.container-fluid -->
        </section>
 </div>
 <script>
    var base_url = <%base_url()|json_encode%>;
    var start_date = <%$start_date|json_encode%>;
    var end_date = <%$end_date|json_encode%>;
</script>
 <script >
     
     

        $(document).ready(function() {
    page.init();
});

var table = '';
var file_name = "sharing_issue_request_store";
var pdf_title = "Sharing Issue Request - Completed";
const page = {
    init: function() {
        this.dataTable();
        this.filter();

    },
    dataTable: function() {
       var data = {};
        table = $("#sharing_issue_request_store_completed").DataTable({
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
                            values.splice(7, 1);
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
                        row.splice(7, 1);
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
        // columnDefs: [{ sortable: false, targets: 7 }],
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

        // global searching for datable 
        $('#serarch-filter-input').on('keyup', function() {
            table.search(this.value).draw();
        });
            // table = $('#example1').DataTable();
      },
    filter: function(){
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
        that.serachParams();
        $(".search-filter").on("click",function(){
            that.serachParams();
            $(".close-filter-btn").trigger( "click" )
        })
        $(".reset-filter").on("click",function(){
            that.resetFilter();
        })
    },
    serachParams: function(){
        var that = this;
        $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
            var date = $("#date_range_filter").val();
            date = date.split(" - ");
            var fromDate = date[0];
            var toDate = date[1];
            
            var dateColumn = data[2].split(" / "); // Assuming the date is in the 3rd column (index 2)
            dateColumn = dateColumn[0];
           
            // Convert dateColumn into a Date object (assuming date is in 'YYYY-MM-DD' format)
            var rowDate = that.convertToDate(dateColumn);
            // If no "From Date" or "To Date" is selected, don't filter
            if (!fromDate && !toDate) {
                return true;
            }

            // If the "From Date" is set, compare it with the row's date
            if (fromDate &&  that.convertToDate(fromDate) > rowDate) {
                return false;
            }

            // If the "To Date" is set, compare it with the row's date
            if (toDate &&  that.convertToDate(toDate) < rowDate) {
                return false;
            }

            // If the row's date is within the range, show it
            return true;
        });
        table.draw();
    },
    resetFilter: function(){
        dateRangePicker.setStartDate(start_date);
        dateRangePicker.setEndDate(end_date);
        this.serachParams();
    },
    convertToDate: function(dateString) {
        var parts = dateString.split('/');
        return new Date(parts[2], parts[1] - 1, parts[0]); // Convert to Date object: YYYY, MM-1, DD
    }
};

 </script>
