$( document ).ready(function() {
    page.init();
});
var table = '';
var file_name = "item_par_list";
var pdf_title = "Item part List";
var myModal = new bootstrap.Modal(document.getElementById('child_part_update'))
const page = {
    init: function(){
        let that = this;
        this.dataTable();
        this.filter();
        this.formValidation();
        $(document).on("click",".edit-part",function(){
            var data = $(this).attr("data-value");
            data = JSON.parse(atob(data)); 
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
            $("#sub_category_type").attr("data-selected",data.sub_category)
            var target = $("#child_part_update");
            that.getSubCategory(target)
            myModal.show();
        })
        $(".parent-category").on("change",function(){
                var parent_category = $(this).val();
                 $.ajax({
                  type: "POST",
                  url: base_url+"welcome/getSubCategory",
                  data: {parent_category:parent_category},
                  success: function (response) {
                    var responseObject = JSON.parse(response);
                    $(".sub_category_type").html(responseObject.html)
                  },
                  error: function (error) {
                    console.error("Error:", error);
                  },
                });
            })

    },
    dataTable: function(){
        var data = this.serachParams();
        table = new DataTable("#child_part_view", {
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
            fixedColumns: {
                leftColumns: 2,
                // end: 1
            },
            order: sorting_column,
            ajax: {
                data: {'search':data},    
                url: "supplierPartsController/get_child_part_view",
                type: "POST",
            },
             columnDefs: [{ sortable: false, targets: 10 }],
        });
        $('.dataTables_length').find('label').contents().filter(function() {
            return this.nodeType === 3; // Filter out text nodes
        }).remove();
        table.on('init.dt', function() {
            $(".dataTables_length select").select2({
                minimumResultsForSearch: Infinity
            });
        });
         // global searching for datable 
        $('#serarch-filter-input').on('keyup', function() {
            table.search(this.value).draw();
        });
       
    },
    formValidation: function(){
        let that = this;
        $("#updatechildpart").validate({
            rules: {
                part_number: {
                    required: true
                },
                part_description: {
                    required: true
                },
                saft__stk: {
                    required: true
                },
                hsn_code: {
                    required: true
                },
                sub_type: {
                    required: true
                },
                store_rack_location: {
                    required: true
                },
                store_stock_rate: {
                    required: true,
                    number: true
                },
                weight: {
                    required: true,
                    number: true
                },
                size: {
                    required: true
                },
                thickness: {
                    required: true
                },
                uom_name: {
                    required: true
                },
                max_uom: {
                    required: true,
                    number: true
                },
                grade: {
                    required: true
                }
            },
            messages: {
                part_number: "Please enter Part Number",
                part_description: "Please enter Part Description",
                saft__stk: "Please enter Safety/Buffer Stock",
                hsn_code: "Please enter HSN Code",
                sub_type: "Please select Purchase Item Category",
                store_rack_location: "Please enter Store Rack Location",
                store_stock_rate: {
                    required: "Please enter Store Stock Rate",
                    number: "Please enter a valid number"
                },
                weight: {
                    required: "Please enter Weight",
                    number: "Please enter a valid number"
                },
                size: "Please enter Size",
                thickness: "Please enter Thickness",
                uom_name: "Please select UOM",
                max_uom: {
                    required: "Please enter Max PO Quantity",
                    number: "Please enter a valid number"
                },
                grade: "Please enter Grade"
            },
            errorPlacement: function(error, element)
            {
              error.insertAfter(element);
            },
            submitHandler: function(form) {
              var formdata = new FormData(form);
              $.ajax({
                url: "update_child_part_view",
                data:formdata,
                processData:false,
                contentType:false,
                cache:false,
                type:"post",
                success: function(result){
                  var data = JSON.parse(result);
                  if (data.success == 1) {
                      toastr.success(data.message);
                    //   setTimeout(function () {
                    //     window.location.href = "dashboard";
                    // }, 2000);
                    table.destroy(); 
                    that.dataTable(); 
                    myModal.hide();  
                  }else{ 
                    toastr.error(data.message);
                    // toastr.error("Invalid data");
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
        var part_description = $("#part_description_search").val();
        var params = {part_number:part_number,part_description:part_description};
        return params;
    },
    resetFilter: function(){
        $("#part_number_search").val('').trigger('change');
        $("#part_description_search").val('');
        table.destroy(); 
        this.dataTable();
    },
    getSubCategory: function(target){
        var parent_category = $(target).find(".parent-category").val();
        var sub_category = $(target).find(".sub_category_type").attr("data-selected");
        $.ajax({
            type: "POST",
            url: base_url+"welcome/getSubCategory",
            data: {parent_category:parent_category,sub_category:sub_category},
            success: function (response) {
                var responseObject = JSON.parse(response);
                $(target).find(".sub_category_type").html(responseObject.html)
            },
            error: function (error) {
                console.error("Error:", error);
            },
        });
    }
}
