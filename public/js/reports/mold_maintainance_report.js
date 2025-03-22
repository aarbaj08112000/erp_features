var file_name = "customer_part";
var pdf_title = "Customer Part";
var table = '';
const datatable = {
    init:function(){
        let that = this;
        that.dataTable();
        $(document).on('click','.search-filter',function(e){
            let customer_name = $("#customer_name").val();
            table.column(1).search(customer_name).draw();
        })
        $(document).on('click','.reset-filter',function(e){
           that.resetFilter();
        })
        $(document).on("click",".doc_upload",function(){
            let data = $(this).attr("data-value");
            data = JSON.parse(atob(data)); 4
            console.log(data);
            $('#no_of_cavity').val(data.no_of_cavity);
            $('#mold_name').val(data.mold_name);
            $('#customer_part_id').val(data.customer_part_id);
            $('#target_life').val(data.target_life);
            $('#target_over_life').val(data.target_over_life);
            $('#current_molding_prod_qty').val(data.tot);
            $('#mold_id').val(data.id);
        })
        $("#form111").on('submit', function (e) {
            e.preventDefault();
    
            $.ajax({
                url: base_url+'upload_mold_maintenance_doc', // Change this to your actual URL
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function (response) {
                    if (response) {
                        alert('Uploaded Successfully');
                        location.reload(); // Reload the page or redirect as needed
                    } else {
                        alert('Not Uploaded');
                    }
                },
                error: function (response) {
                    alert('Error occurred while uploading');
                }
            });
        });
    },
    dataTable:function(){
      table =  new DataTable('#example1',{
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
                                values.splice(8, 1);
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
                    
                    customize: function (doc) {
                        doc.pageMargins = [15, 15, 15, 15];
                        doc.content[0].text = pdf_title;
                        doc.content[0].color = theme_color;
                        // doc.content[1].table.widths = ['15%', '19%', '13%', '13%','15%', '15%', '10%'];
                        doc.content[1].table.body[0].forEach(function(cell) {
                            cell.fillColor = theme_color;
                        });
                        doc.content[1].table.body.forEach(function(row, rowIndex) {
                            row.forEach(function(cell, cellIndex) {
                                var alignmentClass = $('#example1 tbody tr:eq(' + rowIndex + ') td:eq(' + cellIndex + ')').attr('class');
                                var alignment = '';
                                if (alignmentClass && alignmentClass.includes('dt-left')) {
                                    alignment = 'left';
                                } else if (alignmentClass && alignmentClass.includes('dt-center')) {
                                    alignment = 'center';
                                } else if (alignmentClass && alignmentClass.includes('dt-right')) {
                                    alignment = 'right';
                                } else {
                                    alignment = 'left';
                                }
                                cell.alignment = alignment;
                            });
                            row.splice(8, 1);
                        });
                    }
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
    },
    resetFilter:function(){
        table.column(1).search('').draw();
    }

}

$(document).ready(function () {
    datatable.init();    
    $('#serarch-filter-input').on('keyup', function() {
        table.search(this.value).draw();
    });
})