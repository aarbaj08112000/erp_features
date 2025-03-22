$( document ).ready(function() {
    page.init();
});
var table = '';
var file_name = "customer_challan_report";
var pdf_title = "Customer Challan Report";
const page = {
    init: function(){
    	this.dataTable();
        this.filter();
    },
    dataTable: function(){
        var data = {};
        table = $("#customer_challan_report").DataTable({
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
                    doc.content[1].table.widths = ["25%", "20%", "17%", "17%", "17%", "20%"];
                    doc.content[1].table.body[0].forEach(function (cell) {
                        cell.fillColor = theme_color;
                    });
                    doc.content[1].table.body.forEach(function (row, index) {
                        // row.splice(5, 1);
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
         lengthMenu: [[10,50,100,200,500,1000,2500], [10,50,100,200,500,1000,2500]],
        scrollY: true,
        bScrollCollapse: true,
        // columnDefs: [{ sortable: false, targets: 5 }],
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
    	console.log("ok")
        var customer_name = $("#selected_customer_name").val();
        table.column(0).search(customer_name).draw();
        // var admin_approve_search = $("#admin_approve_search").val();
        // table.column(0).search(supplier_search).draw(); 
    },
    resetFilter: function(){
        $("#selected_customer_name").val('').trigger('change');
        // $("#admin_approve_search").val('').trigger('change');
        this.serachParams();
    }
}
