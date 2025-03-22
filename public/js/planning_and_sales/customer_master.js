var file_name = "customer_master";
var pdf_title = "Customer Master";
var table = '';
const datatable = {
    init:function(){

        if(export_message != "" && export_message != null){
              toastr.options = {
                  'closeButton': true,
                  'debug': false,
                  'newestOnTop': false,
                  'progressBar': false,
                  'positionClass': 'toast-top-right',
                  'preventDuplicates': false,
                  'showDuration': '1000',
                  'hideDuration': '1000',
                  'timeOut': '15000',
                  'extendedTimeOut': '1000',
                  'showEasing': 'swing',
                  'hideEasing': 'linear',
                  'showMethod': 'fadeIn',
                  'hideMethod': 'fadeOut',
              }
          toastr.error(export_message);
        }


        $('#importCustomerPartsPriceOnly').on('hide.bs.modal', function () {
           $('#global_import')[0].reset();
                $("#customer_name_import").val("").trigger("change");
        });

        let that = this;
        that.dataTable();
        $(document).on('click','.search-filter',function(e){
            let customer_name = $("#customer_name").val();
            table.column(1).search(customer_name).draw();
        })
        $(document).on('click','.reset-filter',function(e){
           that.resetFilter();
        })
        $(document).on("click",".add-revision",function(){
            var data = $(this).attr("data-value");
            data = JSON.parse(atob(data)); 
            
            $('#part_number').val(data[1]['part_number']);
            $('#revision_no').val(data[0].revision_no);
            $('#part_description').val(data[1].part_description);
            $('#revision_remark').val(data[0].revision_remark);
            
            $('#revision_date').val(data[0]['revision_date']);
        })
       
        $(".import_operation_bom").submit(function(e){
            e.preventDefault();
           
            var href = $(this).attr("action");
            var id = $(this).attr("id");
            let flag = that.formValidate(id);

            if(flag){
              return;
            }

            var formData = new FormData($('.'+id)[0]);

            $.ajax({
              type: "POST",
              url: href,
              data: formData,
              processData: false,
              contentType: false,
              success: function (response) {
                var responseObject = JSON.parse(response);
                var msg = responseObject.messages;
                var success = responseObject.success;
                if (success == 1) {
                  toastr.success(msg);
                  $(this).parents(".modal").modal("hide")
                  setTimeout(function(){
                    window.location.reload();
                  },1000);

                } else {
                  toastr.error(msg);
                }
              },
              error: function (error) {
                console.error("Error:", error);
              },
            });
          });
        $(".global_import").submit(function(e){
            e.preventDefault();
           
            var href = $(this).attr("action");
            var id = $(this).attr("id");
            let flag = that.formValidate(id);

            if(flag){
              return;
            }

            var formData = new FormData($('.'+id)[0]);

            $.ajax({
              type: "POST",
              url: href,
              data: formData,
              processData: false,
              contentType: false,
              success: function (response) {
                var responseObject = JSON.parse(response);
                var msg = responseObject.messages;
                var success = responseObject.success;
                $('#importCustomerPartsPriceOnly').modal('hide');
                $('#global_import')[0].reset();
                $("#customer_name_import").val("").trigger("change");
                toastr.options = {
                    'closeButton': true,
                    'debug': false,
                    'newestOnTop': false,
                    'progressBar': false,
                    'positionClass': 'toast-top-right',
                    'preventDuplicates': false,
                    'showDuration': '1000',
                    'hideDuration': '1000',
                    'timeOut': '15000',
                    'extendedTimeOut': '1000',
                    'showEasing': 'swing',
                    'hideEasing': 'linear',
                    'showMethod': 'fadeIn',
                    'hideMethod': 'fadeOut',
                }
                if (success == 1) {
                  toastr.success(msg);
                  $(this).parents(".modal").modal("hide")

                } else {
                  toastr.error(msg);
                }

              },
              error: function (error) {
                console.error("Error:", error);
              },
            });
          });
        $(".global_export").submit(function(e){
           
            var href = $(this).attr("action");
            var id = $(this).attr("id");
            let flag = that.formValidate(id);

            if(flag){
              e.preventDefault();
              return;
            }

          });

    },
    dataTable:function(){
        let order_disable = [{ sortable: false, targets: 2 },{ sortable: false, targets: 3 },{ sortable: false, targets: 4 },{ sortable: false, targets: 5 }];
        if(isPLMEnabled){
            order_disable = [{ sortable: false, targets: 3 },{ sortable: false, targets: 4 },{ sortable: false, targets: 5 },{ sortable: false, targets: 6},{ sortable: false, targets: 7 },{ sortable: false, targets: 2}];
        }
      table =  new DataTable('#example1',{
        dom: "Bfrtilp",
        // scrollX: true, 
        columnDefs: order_disable,
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
                                values.splice(2, 1);
                                values.splice(9, 1);
                                values.splice(8, 1);
                                values.splice(7, 1);
                                values.splice(6, 1);
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
                    
                    

                },
            ],
        searching: true,
        order: [[0, 'desc']],
      // scrollX: true,
      scrollY: true,
      bScrollCollapse: true,
      columnDefs: order_disable,
      pagingType: "full_numbers",
    });
      $('.dataTables_length').find('label').contents().filter(function() {
          return this.nodeType === 3; // Filter out text nodes
      }).remove();
      
        $('#serarch-filter-input').on('keyup', function() {
            table.search(this.value).draw();
        });
      setTimeout(function(){
        $(".dataTables_length select").select2({
            minimumResultsForSearch: Infinity
        });
      },1000)

    },
    resetFilter:function(){
        table.column(1).search('').draw();
    },
    formValidate: function(form_class = ''){
        let flag = false;
        $(".custom-form."+form_class+" .required-input").each(function( index ) {
          var value = $(this).val();
          var dataMax = parseFloat($(this).attr('data-max'));
          var dataMin = parseFloat($(this).attr('data-min'));
          if(value == ''){
            flag = true;
            var label = $(this).parents(".form-group").find("label").contents().filter(function() {
              return this.nodeType === 3; // Filter out non-text nodes (nodeType 3 is Text node)
            }).text().trim();
            var exit_ele = $(this).parents(".form-group").find("label.error");
            if(exit_ele.length == 0){
              var start ="Please enter ";
              if($(this).prop("localName") == "select"){
                var start ="Please select ";
              }
              label = ((label.toLowerCase()).replace("enter", "")).replace("select", "");
              var validation_message = start+(label.toLowerCase()).replace(/[^\w\s*]/gi, '');
              var label_html = "<label class='error'>"+validation_message+"</label>";
              $(this).parents(".form-group").append(label_html)
            }
          }
          else if(dataMin !== undefined && dataMin > value){
            flag = true;
            var label = $(this).parents(".form-group").find("label").contents().filter(function() {
              return this.nodeType === 3; // Filter out non-text nodes (nodeType 3 is Text node)
            }).text().trim();
            var exit_ele = $(this).parents(".form-group").find("label.error");
            if(exit_ele.length == 0){
              var end =" must be greater than or equal to "+dataMin;
              label = ((label.toLowerCase()).replace("enter", "")).replace("select", "");
              label = (label.toLowerCase()).replace(/[^\w\s*]/gi, '');
              label = label.charAt(0).toUpperCase() + label.slice(1);
              var validation_message =label +end;
              var label_html = "<label class='error'>"+validation_message+"</label>";
              $(this).parents(".form-group").append(label_html)
            }
            }else if(dataMax !== undefined && dataMax < value){
              flag = true;
              var label = $(this).parents(".form-group").find("label").contents().filter(function() {
                return this.nodeType === 3; // Filter out non-text nodes (nodeType 3 is Text node)
              }).text().trim();
              var exit_ele = $(this).parents(".form-group").find("label.error");
              if(exit_ele.length == 0){
                var end =" must be less than or equal to "+dataMax;
                label = ((label.toLowerCase()).replace("enter", "")).replace("select", "");
                label = (label.toLowerCase()).replace(/[^\w\s*]/gi, '');
                label = label.charAt(0).toUpperCase() + label.slice(1)
                var validation_message =label +end;
                var label_html = "<label class='error'>"+validation_message+"</label>";
                $(this).parents(".form-group").append(label_html)
              }
          }
        });
       
        return flag;
    }


}

$(document).ready(function () {
    datatable.init();    
})
