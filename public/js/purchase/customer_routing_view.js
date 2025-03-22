$( document ).ready(function() {
    page.init();
});
var table = '';
var file_name = "customer_routing";
var pdf_title = "Customer Routing";
const page = {
    init: function(){
        this.dataTable();
        // this.filter();
    },
    dataTable: function(){
        var data = {};
        table = $("#customer_routing_view").DataTable({
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
                            values.splice(2, 1);
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
                    doc.content[0].color = "#5d87ff";
                    // doc.content[1].table.widths = ["19%", "19%", "13%", "13%", "15%", "15%"];
                    doc.content[1].table.body[0].forEach(function (cell) {
                        cell.fillColor = "#5d87ff";
                    });
                    doc.content[1].table.body.forEach(function (row, index) {
                        row.splice(2, 1);
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
        columnDefs: [{ sortable: false, targets: 2 }],
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
        $('#serarch-filter-input').on('keyup', function() {
            table.search(this.value).draw();
        });
        
    },
    filter: function(){
        let that = this;
        $('#supplier_search,#admin_approve_search').select2();
        $(".search-filter").on("click",function(){
            that.serachParams();
            $(".close-filter-btn").trigger( "click" )
        })
        $(".reset-filter").on("click",function(){
            that.resetFilter();
        })
    },
    serachParams: function(){
        var supplier_search = $("#supplier_search").val();
        table.column(0).search(supplier_search).draw();
        // var admin_approve_search = $("#admin_approve_search").val();
        // table.column(0).search(supplier_search).draw(); 
    },
    resetFilter: function(){
        $("#supplier_search").val('').trigger('change');
        // $("#admin_approve_search").val('').trigger('change');
        this.serachParams();
    }
}
// function serachParams() {
//     var department_name = $("#department_name_search").val();
//     table.column(0).search(department_name).draw();
//     var department_code = $("#department_code_search").val();
//     table.column(1).search(department_code).draw();
//     var added_by = $("#added_by_search").val();
//     table.column(2).search(added_by).draw();
//     var added_date = $("#added_date_search").val();
//     table.column(3).search(added_date).draw();
//     var updated_by = $("#updated_by_search").val();
//     table.column(4).search(updated_by).draw();
//     var updated_date = $("#updated_date_search").val();
//     table.column(5).search(updated_date).draw();
// }
// function resetFilter() {
//     $("#department_name_search").val("");
//     $("#department_code_search").val("");
//     $("#added_by_search").val("");
//     $("#added_date_search").val("").trigger("change");
//     $("#updated_date_search").val("").trigger("change");
//     $("#updated_by_search").val("");
//     serachParams();
// }