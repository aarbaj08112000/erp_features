var table = '';
var file_name = "receivable_reports";
var pdf_title = "Receivable Reports";
// var myModal = new bootstrap.Modal(document.getElementById('update_report_data'))
const page = {
    init: function(){
        this.dataTable();
        this.filter();

    },
    dataTable: function(){
        var data = {};
        table = $("#down_time_report").DataTable({
        dom: "Bfrtilp",
        // buttons: [
        //     {
        //         extend: "csv",
        //         text: '<i class="ti ti-file-type-csv"></i>',
        //         init: function (api, node, config) {
        //             $(node).attr("title", "Download CSV");
        //         },
        //         customize: function (csv) {
        //                 var lines = csv.split('\n');
        //                 var modifiedLines = lines.map(function(line) {
        //                     var values = line.split(',');
        //                     values.splice(7, 1);
        //                     return values.join(',');
        //                 });
        //                 return modifiedLines.join('\n');
        //             },
        //             filename : file_name
        //         },
          
        //     {
        //         extend: "pdf",
        //         text: '<i class="ti ti-file-type-pdf"></i>',
        //         init: function (api, node, config) {
        //             $(node).attr("title", "Download Pdf");
        //         },
        //         filename: file_name,
        //         customize: function (doc) {
        //             doc.pageMargins = [15, 15, 15, 15];
        //             doc.content[0].text = pdf_title;
        //             doc.content[0].color = theme_color;
        //             // doc.content[1].table.widths = ["19%", "19%", "13%", "13%", "15%", "15%"];
        //             doc.content[1].table.body[0].forEach(function (cell) {
        //                 cell.fillColor = theme_color;
        //             });
        //             doc.content[1].table.body.forEach(function (row, index) {
        //                 row.splice(7, 1);
        //                 row.forEach(function (cell) {
        //                     // Set alignment for each cell
        //                     cell.alignment = "center"; // Change to 'left' or 'right' as needed
        //                 });
        //             });
        //         },
        //     },
        // ],
        searching: true,
        // scrollX: true,
        scrollY: true,
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

        // global searching for datable 
        $('#serarch-filter-input').on('keyup', function() {
            table.search(this.value).draw();
        });
    },
    filter: function(){
    	let that = this;
        $('#date_range_filter').daterangepicker({
            locale: {
            format: 'DD/MM/YYYY' // Example format, adjust as needed
        }
        });
        $('#date_range_filter').data('daterangepicker').setStartDate(start_date);
        $('#date_range_filter').data('daterangepicker').setEndDate(end_date);
        $(".search-filter").on("click",function(){
            that.serachParams();
            $(".close-filter-btn").trigger( "click" )
        })
        $(".reset-filter").on("click",function(){
            that.resetFilter();
        })
    },
    serachParams: function(){
    	let that = this;
       var date = $("#date_range_filter").val();
            $.ajax({
                  type: "POST",
                  url: "P_Molding/filter_downtime_report",
                  data: {
                      date_range: date,
                  },
                  success: function (response) {
                      var response = JSON.parse(response);
                      $("#total_down_time").html(response.total_down_time);
                      $("#max_down_time_machine").html(response.max_down_time_machine);
                      $("#max_down_time_reason").html(response.max_down_time_reason);
                      $("#down_time_table_compair tbody").html(response.top_5_down_time_html);
                      
                      $('#down_time_report').DataTable().destroy();
                      $("#down_time_report tbody").html(response.down_time_data_html);
                      that.dataTable();
                      
                  },
                  error: function (error) {}
            });
    },
    resetFilter: function(){
        $('#date_range_filter').data('daterangepicker').setStartDate(start_date);
        $('#date_range_filter').data('daterangepicker').setEndDate(end_date);
        this.serachParams();
    }
}

$( document ).ready(function() {
    page.init();
    // alert();
});