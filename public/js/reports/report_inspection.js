var table = '';
var file_name = "part_under_inspection_report";
var pdf_title = "Parts Under Inspection Reports";
// var myModal = new bootstrap.Modal(document.getElementById('child_part_update'))
const page = {
    init: function(){
        this.dataTable();
        this.filter();
        this.formValidation();
        $(document).on("click",".edit-part",function(){
            var data = $(this).attr("data-value");
            data = JSON.parse(atob(data)); 
            console.log(data)
            var option = '';
            if(data.sub_type == 'Regular grn' || data.sub_type == 'RM' ){
                option = '<option  value="Regular grn">Regular GRN</option><option  value="RM">RM</option>';
            }else if(data.sub_type == 'Subcon grn' || data.sub_type == 'Subcon Regular'){
                option = '<option  value="Subcon grn">Subcon GRN</option> <option value="Subcon Regular">Subcon Regular</option>';
            }else if(data.sub_type == 'consumable'){
                option = '<option sub_type value="consumable" >Consumable</option>';
            }else if(data.sub_type == 'customer_bom'){
                option = '<option sub_type value="customer_bom">Customer BOM</option>';
            }else if(data.sub_type == 'asset'){
                option = '<option sub_type value="asset" >Asset</option>';
            }
            $("#sub_type").html(option).select2();
            $("label.error").remove();
            $("input.error").removeClass('error');
            $("#part_id").val(data.part_id);
            $("#part_number").val(data.part_number);
            $("#part_description").val(data.part_description);
            $("#saft__stk").val(data.buffer_stock);
            $("#hsn_code").val(data.hsn_code);
            $("#sub_type").val(data.sub_type).trigger("change");
            $("#store_rack_location").val(data.store_rack_location);
            $("#store_stock_rate").val(data.store_stock_rate);
            $("#weight").val(data.weight);
            $("#size").val(data.size);
            $("#thickness").val(data.thickness);
            $("#uom_id").val(data.uom_id).trigger("change");
            $("#max_uom").val(data.max_uom);
            $("#grade").val(data.grade);
            // myModal.show();
        })

    },
    dataTable: function(){
        var data = this.serachParams();
        table = new DataTable("#example1", {
            dom: "Bfrtilp",
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
                            row.splice(14, 1);
                        });
                    }
                },
            ],
            orderCellsTop: true,
            fixedHeader: true,
            lengthMenu: page_length_arr,
            // "sDom":is_top_searching_enable,
            columns: column_details,
            processing: false,
            serverSide: is_serverSide,
            sordering: true,
            searching: is_searching_enable,
            ordering: is_ordering,
            bSort: true,
            orderMulti: false,
            pagingType: "full_numbers",
            scrollCollapse: true,
            scrollX: true,
            scrollY: true,
            paging: is_paging_enable,
            fixedHeader: false,
            info: true,
            autoWidth: true,
            lengthChange: true,
            fixedColumns: {
                leftColumns: 2,
                // end: 1
            },
            ajax: {
                data: {'search':data},    
                url: "Welcome/getInspectionReportData",
                type: "POST",
            },
        });
        $('.dataTables_length').find('label').contents().filter(function() {
            return this.nodeType === 3; // Filter out text nodes
        }).remove();
        $(".dataTables_length select").select2({
            minimumResultsForSearch: Infinity
        });
        $('#serarch-filter-input').on('keyup', function() {
            table.search(this.value).draw();
        });
    },
    formValidation: function(){
        let that = this;
    },
    filter: function(){
        let that = this;
        $('#year').select2();
        $('#month_number').select2();
        $(".search-filter").on("click",function(){
            table.destroy(); 
            that.dataTable();
            $(".close-filter-btn").trigger( "click" )
        })
        $(".reset-filter").on("click",function(){
            that.resetFilter();
        })
    },
    serachParams: function(){
        var month_number = $("#month_number").val();
        var year = $("#year").val();
        var params = {month_number:month_number,year:year};
        return params;
    },
    resetFilter: function(){
        $("#month_number").val('').trigger('change');
        $("#year").val('');
        table.destroy(); 
        this.dataTable();
    }
}

$( document ).ready(function() {
    page.init();
});
