$( document ).ready(function() {
  page.init();
});
var table = '';
var file_name = "fg_stock";
var pdf_title = "FG Stocks";
var myModal = new bootstrap.Modal(document.getElementById('fgtransfer'))
var myFgModal = new bootstrap.Modal(document.getElementById('fgtofgtransfer'))
const page = {
  init: function(){
    this.initiateForm();
    this.dataTable();
    this.filter();
  },
  dataTable: function() {
      var data =this.serachParams();;
        table = new DataTable("#fw_stock_view", {
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
                                values.splice(0, 1);
                                if(isSheetMetal == "Yes"){
                                  values.splice(3, 1);
                                }
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
                        doc.content[1].table.widths = ['16.6%', '16.6%', '16.6%', '16.6%','16.6%','16.6%'];
                        if(isSheetMetal == "Yes"){
                           doc.content[1].table.widths = ['20%', '20%', '20%', '20%','20%'];
                        }
                        doc.content[1].table.body[0].forEach(function(cell) {
                            cell.fillColor = theme_color;
                        });

                         // Remove the 4th and 5th columns from each row
                        doc.content[1].table.body.forEach(function(row) {
                            row.splice(7, 1); // Remove the 4th and 5th columns from each row
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
                            if(isSheetMetal == "Yes"){
                                  row.splice(3, 1);
                            }
                            row.splice(0, 1);
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
                url: "FGStockController/get_fg_stock_view",
                type: "POST",
            },
             // columnDefs: [{ sortable: false, targets: 7 }],
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
  filter: function(){
        let that = this;
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
        var part_id_search = $("#part_id_search").val();
        var params = {part_id:part_id_search};
        console.log(params)
        return params;
    },
    resetFilter: function(){
        $("#part_id_search").val('').trigger('change');
        table.destroy(); 
        this.dataTable();
    },
  initiateForm: function(){
    let that = this;

    $(".fg_stock_form").submit(function(e){
      e.preventDefault();
      let flag = that.formValidate("fg_stock_form");
    
      if(flag){
        return;
      }
      
    
      var formData = new FormData($('.fg_stock_form')[0]);

      $.ajax({
        type: "POST",
        url: base_url+"transfer_fg_stock_to_inhouse_stock",
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

    $(".fg_to_fg_stock_form").submit(function(e){
      e.preventDefault();
      let flag = that.formValidate("fg_to_fg_stock_form");
    
      if(flag){
        return;
      }
      
    
      var formData = new FormData($('.fg_to_fg_stock_form')[0]);

      $.ajax({
        type: "POST",
        url: base_url+"transfer_fg_stock_to_fg_stock",
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

    $(document).on("click",".fg-transfer",function(){
      var stock = $(this).attr("data-stock");
      var part_number = $(this).attr("data-part-number");
      var customer_part_id = $(this).attr("data-customer-part-id");
      $("#customer_parts_master_id_fomr").val(customer_part_id);
      $("#part_number_form").val(part_number);
      $("#stock_form").attr("data-max",stock);
      myModal.show()
    })
    $(document).on("click",".fg-to-fg-transfer",function(){
      var stock = $(this).attr("data-stock");
      var part_number = $(this).attr("data-part-number");
      var customer_part_id = $(this).attr("data-customer-part-id");
      var custom_opt = '<option value="">Select Transfer Part Number</option>';
      for (var i = 0; i < customer_parts.length; i++) {
          custom_opt += `<option value="${customer_parts[i]['customer_parts_master_id']}">${customer_parts[i]['part_number']}/${customer_parts[i]['part_description']}</option>`;
      }
      $("#fg_part_data").html(custom_opt).trigger("change");
      console.log(customer_parts,customer_part_id)
      $("#fg_customer_parts_master_id_fomr").val(customer_part_id);
      $("#fg_part_number_form").val(part_number);
      $("#fg_stock_form").attr("data-max",stock);
      myFgModal.show()
    })

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
              var end =" must be greater than or equal "+dataMin;
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
                var end =" must be less than or equal "+dataMax;
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
