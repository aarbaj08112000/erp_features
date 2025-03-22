$(document).ready(function() {
    page.init();
});

var table = '';
var file_name = "machine_request";
var pdf_title = "Machine Request";

const page = {
    init: function() {
        $('#date_range_filter').daterangepicker({
            locale: {
            format: 'DD/MM/YYYY' // Example format, adjust as needed
        }
        });
        $('#date_range_filter').data('daterangepicker').setStartDate(start_date);
        $('#date_range_filter').data('daterangepicker').setEndDate(end_date);
        this.dataTable();
        this.filter();
        this.initiateForm();
    },
    dataTable: function(){
        var data = this.serachParams();
        table = new DataTable("#machine_request", {
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
                    customize: function (doc) {
                      doc.pageMargins = [15, 15, 15, 15];
                      doc.content[0].text = pdf_title;
                      doc.content[0].color = theme_color;
                        // doc.content[1].table.widths = ['21%', '36%', '13%', '15%','15%'];
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
                            row.splice(6, 1);
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
            // fixedColumns: {
            //     leftColumns: 2,
            //     // end: 1
            // },
            ajax: {
                data: {'search':data},    
                url: "P_Molding/get_machine_request_view",
                type: "POST",
            },
             columnDefs: [{ sortable: false, targets: 6 }],
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
        var date_range_filter = $("#date_range_filter").val();
        console.log(date_range_filter)
        var params = {date_range_filter:date_range_filter};
        return params;
    },
    resetFilter: function(){
        $("#date_range_filter").val('').trigger('change');
        table.destroy(); 
        this.dataTable();
       
    },
    initiateForm: function(){
        let that = this;

        $(".add_machine_request").submit(function(e){
          e.preventDefault();
          let flag = that.formValidate("add_machine_request");
          if(flag){
            return;
          }
          var formData = new FormData($('.add_machine_request')[0]);
    
          $.ajax({
            type: "POST",
            url: base_url+"add_machine_request",
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
        $(document).on('click', '.delete-request', function(e) {
            var request_id =  $(this).attr("data-id");
            var request_code = $(this).attr("data-request-code");
		    swal({
				title: "Delete Material Request", 
				text: "Are You Sure Want To Delete "+request_code+" Material Request ?", 
				type: "warning",
				confirmButtonText: "Yes",
				showCancelButton: true
		    })
		    .then((result) => {
					if (result.value) {
                       $.ajax({
                        url: base_url+"delete",
                        data:{id:request_id,table_name:"machine_request"},
                        type:"post",
                        success: function(result){
                          var data = JSON.parse(result);
                          if (data.success == 1) {
                              toastr.success(data.message);
                              table.destroy(); 
                              that.dataTable(); 
                          }else{
                            toastr.error(data.message);
                          }
        
                        }
                      });
					}
			})
		});
        
    
      },
      formValidate: function(form_class = ''){
        let flag = false;
        $(".custom-form."+form_class+" .required-input").each(function( index ) {
          var value = $(this).val();
          var dataMax = $(this).attr('data-max');
          var dataMin = $(this).attr('data-min');
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
          }else if(dataMax !== undefined && dataMax < value){
              flag = true;
              var label = $(this).parents(".form-group").find("label").contents().filter(function() {
                return this.nodeType === 3; // Filter out non-text nodes (nodeType 3 is Text node)
              }).text().trim();
              var exit_ele = $(this).parents(".form-group").find("label.error");
              if(exit_ele.length == 0){
                var end =" must be less than or equal "+dataMax;
                label = ((label.toLowerCase()).replace("enter", "")).replace("select", "");
                label = (label.toLowerCase()).replace(/[^\w\s*]/gi, '').toUpperCase();
                var validation_message =label +end;
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
              var end =" must be greater than or equal "+dataMin;
              label = ((label.toLowerCase()).replace("enter", "")).replace("select", "");
              label = (label.toLowerCase()).replace(/[^\w\s*]/gi, '').toUpperCase();
              var validation_message =label +end;
              var label_html = "<label class='error'>"+validation_message+"</label>";
              $(this).parents(".form-group").append(label_html)
            }
        }
        });
        return flag;
      }
};
