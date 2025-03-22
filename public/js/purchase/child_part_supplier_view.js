var table = '';
var file_name = "item_par_list";
var pdf_title = "Item part List";
var myModal = new bootstrap.Modal(document.getElementById('addRevision'))
const page = {
    init: function(){
        this.dataTable();
       
        this.filter();
        this.formValidation();
        $(document).on("click",".edit-supplier-part-price",function(){
            $("label.error").remove();
            var data = $(this).attr("data-value");
            data = JSON.parse(atob(data)); 
            console.log(data);
            var option = '';
            $("#id").val(data.id);
            $("#upart_number").val(data.part_number);
            $("#upart_desc").val(data.part_description);
            $("#supplier_id").val(data.supplier_id);
            $("#urevision_date").val("");
            $("#urevision_no").val("");
            $("#revision_remark").val("");
            $("#upart_rate").val("");
            $("#quotation_document").val("");
            $("#gst_id").val(data.gs_id).trigger("change");
            myModal.show();
        })

    },
    dataTable: function(){
        var data = this.serachParams();
        table = new DataTable("#supplier_part_price", {
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
                                var alignmentClass = $('#child_part_view tbody tr:eq(' + rowIndex + ') td:eq(' + cellIndex + ')').attr('class');
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
            order: sorting_column,
            // fixedColumns: {
            //     leftColumns: 2,
            //     // end: 1
            // },
            ajax: {
                data: {'search':data},    
                url: "welcome/view_child_part_supplier",
                type: "POST",
            },
            columnDefs: [{ sortable: false, targets: 1 },{ sortable: false, targets: 12 }],
        });
        $('.dataTables_length').find('label').contents().filter(function() {
            return this.nodeType === 3; // Filter out text nodes
        }).remove();
        table.on('init.dt', function() {
            $(".dataTables_length select").select2({
                minimumResultsForSearch: Infinity
            });
        });


        $('#serarch-filter-input').on('keyup', function() {
            table.search(this.value).draw();
        });
    },
    formValidation: function(){
        let that = this;
        $("#addRevPart").validate({
            rules: {
                upart_number: {
                    required: true
                },
                upart_desc: {
                    required: true
                },
                urevision_date: {
                    required: true
                },
                urevision_no: {
                    required: true
                },
                revision_remark: {
                    required: true
                },
                upart_rate: {
                    required: true
                },
                // quotation_document: {
                //     required: true,
                //     number: true
                // },
                gst_id: {
                    required: true,
                },
            },
            messages: {
                upart_number: "Please enter Part Number",
                upart_desc: "Please enter Part Description",
                urevision_date: "Please enter Revision Date",
                urevision_no: "Please enter Revision Number",
                revision_remark: "Please enter Revision Remark",
                upart_rate: "Please enter Part Price",
                // quotation_document: {
                //     required: "Please enter Store Stock Rate",
                //     number: "Please enter a valid number"
                // },
                gst_id: {
                    required: "Please enter Tax Structure",
                }
            },
            errorPlacement: function(error, element)
            {
              error.insertAfter(element);
            },
            submitHandler: function(form) {
              var formdata = new FormData(form);
              $.ajax({
                url: "updatechildpart_supplier",
                data:formdata,
                processData:false,
                contentType:false,
                cache:false,
                type:"post",
                success: function(result){
                    var data = JSON.parse(result);
                    if (data.success == 1) {
                        toastr.success(data.message);
                        setTimeout(function() {
                            myModal.hide();
                            table.destroy(); 
                            that.dataTable();
                        }, 2000);
                    } else {
                        toastr.error(data.message);
                    }

                }
              });
            }
        }); 
    },
    filter: function(){
        let that = this;
        $('#part_number_search').select2();
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
        var part_number = $("#part_number_search").val();
        // var part_description = $("#part_description_search").val();
        var params = {part_number:part_number};
        return params;
    },
    resetFilter: function(){
        $("#part_number_search").val('').trigger('change');
        // $("#part_description_search").val('');
        table.destroy(); 
        this.dataTable();
    }
}
$( document ).ready(function() {
    page.init();
});

