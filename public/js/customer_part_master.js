var table = '';
var file_name = "customer_part_master";
var pdf_title = "Sales customer_part_master";
var myModal = new bootstrap.Modal(document.getElementById('editpart'))
const page = {
    init: function(){
        this.dataTable();
        this.filter();
        this.formValidation();
        $(document).on("click",".edit-part",function(){
            var data = $(this).attr("data-value");
            data = JSON.parse(atob(data)); 
            console.log(data);
           $('#edit-part-des').val(data['part_description']);
           $('#part-rate').val(data['stock_rate']);
           $('#part_id').val(data['id']);
           var scrap_category_id = data['scrap_category_id'] > 0 ? data['scrap_category_id'] : "";
           $("#scrap_category_id").val(scrap_category_id).trigger("change");
            // myModal.show();
        })
        // $(document).on('click','[type="submit"]',function(){
        //     let parent_form = $(this).closest('form').attr('id');
        //     console.log(parent_form);
        //     let valid_ = $(`#${parent_form}`).valid();
        //     $(this).parents('.modal-footer').find('[data-bs-dismiss="modal"]').trigger('click');
        // })
        this.validationFunc();
    },
    validationFunc:function(){

        // adding new part.

        $('#addCustomerPartsForm').validate({
            rules: {
               part_number: {
                  required: true
               },
               part_description: {
                  required: true,
                  maxlength:75
               },
               fg_rate: {
                  required: true,
                  number: true
               }
            },
            messages: {
               part_number: {
                  required: "Please enter part number"
               },
               part_description: {
                  required: "Please enter part description",
                  maxlength:"Enter part description is less than 75 characters.",
               },
               fg_rate: {
                  required: "Please enter a rate",
                  number: "Please enter a valid number"
               }
            },
            submitHandler: function(form) {
               $.ajax({
                  url: form.action,
                  type: form.method,
                  data: $(form).serialize(),
                  success: function(response) {
                     var responseObject = JSON.parse(response);
                      var msg = responseObject.message;
                      var success = responseObject.success;
                      if(success == 1){
                          toastr.success(msg)
                           setTimeout(() => {
                              window.location.reload();
                           }, 1000);
                      }else{
                          toastr.error(msg)
                      }
                  },
                  error: function(xhr, status, error) {
                     // handle error response
                     toastr.error('An error occurred. Please try again!');
                  }
               });
            }
         });

         // Updating the part
        $('#updateCustomerPartsForm').validate({
            rules: {
               part_description: {
                  required: true,
                   maxlength:75
               },
               fg_rate: {
                  required: true,
                  number: true
               }
            },
            messages: {
               part_description: {
                  required: "Please enter the part description",
                   maxlength:"Enter part description is less than 75 characters.",
               },
               fg_rate: {
                  required: "Please enter a rate",
                  number: "Please enter a valid number"
               }
            },
            submitHandler: function(form) {
               $.ajax({
                  url: form.action,
                  type: form.method,
                  data: $(form).serialize(),
                  success: function(response) {
                     // handle success response
                     var responseObject = JSON.parse(response);
                      var msg = responseObject.message;
                      var success = responseObject.success;
                      if(success == 1){
                          toastr.success(msg)
                           setTimeout(() => {
                              window.location.reload();
                           }, 1000);
                      }else{
                          toastr.error(msg)
                      }
                     
                  },
                  error: function(xhr, status, error) {
                     // handle error response
                     toastr.error('An error occurred. Please try again!');
                  }
               });
            }
         });
    },
    dataTable: function(){
        var data = this.serachParams();
        table = new DataTable("#customer_part_table", {
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
                                values.splice(14, 1);
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
                            row.splice(15, 1);
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
            // scrollX: true,
            scrollY: true,
            paging: is_paging_enable,
            // fixedHeader: false,
            info: true,
            autoWidth: true,
            lengthChange: true,
            // fixedColumns: {
            //     leftColumns: 2,
            //     // end: 1
            // },
            order: sorting_column,
            ajax: {
                data: {'search':data},    
                url: "welcome/getCustomerpartsAjax",
                type: "POST",
            },
        });
        $('.dataTables_length').find('label').contents().filter(function() {
            return this.nodeType === 3; // Filter out text nodes
        }).remove();
        $('#serarch-filter-input').on('keyup', function() {
            table.search(this.value).draw();
        });
        
        table.on('init.dt', function() {
            $(".dataTables_length select").select2({
                minimumResultsForSearch: Infinity
            });
        });
    },
    formValidation: function(){
        let that = this;
    },
    filter: function(){
        let that = this;
        $('#part_drop').select2();
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
        var part_drop = $("#part_drop").val();
        var params = {part:part_drop};
        return params;
    },
    resetFilter: function(){
        $("#part_drop").val('').trigger('change');
        table.destroy(); 
        this.dataTable();
    }
}

$( document ).ready(function() {
    page.init();
});