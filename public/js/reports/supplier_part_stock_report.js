var table = '';
var file_name = "part_stocks";
var pdf_title = "Supplier Parts (Item) Stock";
var filter_id = '';
// var myModal = new bootstrap.Modal(document.getElementById('child_part_update'))
const page = {
    init: function(){
        this.dataTable();
        this.filter();
        this.formValidation();
        $(document).on("click",".edit-fg",function(){
            $("label.error").remove();
            var data = $(this).attr("data-value");
            data = JSON.parse(atob(data)); 
            console.log(data);
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
           
            $("#storeToStore #part_id").val(data.childPartId);
            $("#storeToStore #part_number").val(data.part_number);
            $("#storeToStore [name='stock']").attr("data-max",data[stock_column_name]);
            
            // myModal.show();
        })
        $(document).on("click",".fg_data_edit",function(){
            $("label.error").remove();
            var data = $(this).attr("data-value");
            data = JSON.parse(atob(data)); 
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
           
            $("#fgtransfer [name='child_part_id']").val(data.childPartId);
            $("#fgtransfer [name='part_number']").val(data.part_number);
            $("#fgtransfer [name='stock']").attr("data-max",data[stock_column_name]);
            
            // myModal.show();
        })
        $(document).on("click",".product-store",function(){
            $("label.error").remove();
            var data = $(this).attr("data-value");
            data = JSON.parse(atob(data)); 
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
           
            $("#update_production_qty_child_part_production_qty [name='child_part_id']").val(data.childPartId);
            $("#update_production_qty_child_part_production_qty [name='part_number']").val(data.part_number);
            $("#update_production_qty_child_part_production_qty [name='production_qty']").attr("data-max",data[sheet_prod_column_name]);
            // sheet_prod_column_name
            // myModal.show();
        })
        $(document).on("click",".product-store-plas",function(){
            $("label.error").remove();
            var data = $(this).attr("data-value");
            data = JSON.parse(atob(data)); 
           
            $("#prodToStorePlastic [name='child_part_id']").val(data.childPartId);
            $("#prodToStorePlastic [name='part_number']").val(data.part_number);
            $("#prodToStorePlastic [name='machine_mold_issue_stock']").attr("data-max",data[plastic_prod_column_name]);
            // sheet_prod_column_name
            // myModal.show();
        })

    },
    dataTable: function(){
       
        var data = this.serachParams();
        table = new DataTable("#part_stocks", {
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
            fixedColumns:false,
            // fixedColumns: {
            //     leftColumns: 2,
            //     // end: 1
            // },
            ajax: {
                data: {'search':data},    
                url: "StockController/getPartStockReportData",
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
        // $('#transfer_child_store_to_store_stock').on('submit', function(event) {
        //        event.preventDefault(); // Prevent the form from submitting via the browser
        //        var form = $(this);
        //        var formData = form.serialize();
        //         let flag = that.formValidate("transfer_child_store_to_store_stock");
        //         if(flag){
        //             return;
        //         }

        //         console.log(flag);
        //        $.ajax({
        //            type: 'POST',
        //            url: form.attr('action'),
        //            data: formData,
        //            success: function(response) {
        //                var responseObject = JSON.parse(response);
        //                 var msg = responseObject.message;
        //                 var success = responseObject.success;
        //                 if (success == 1) {
        //                     toastr.success(msg);
        //                     setTimeout(function(){
        //                         window.location.reload();
        //                     },1000);

        //                 } else {
        //                     toastr.error(msg);
        //                 }
        //            },
        //            error: function(xhr, status, error) {
        //                // Handle error
        //                toastr.success('unable to delete part.')
        //            }
        //        });
            
        // });
        $(".transfer_child_store_to_store_stock,.transfer_child_part_to_fg_stock,.update_rm_batch_mtc_report,.update_production_qty_child_part_production_qty,.update_production_qty_child_part").submit(function(e){
            e.preventDefault();
           
            var href = $(this).attr("action");
            var id = $(this).attr("id");
            let flag = that.formValidate(id);

            if(flag){
              return;
            }
            // console.log(flag);
            // return;
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
    },
    filter: function(){
        let that = this;
        $('#selectPart').select2();
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
        var part_id = $("#selectPart").val();
        var params = {part_id:part_id};
        return params;
    },
    resetFilter: function(){
        $("#selectPart").val('').trigger('change');
        table.destroy(); 
        this.dataTable();
    }
}

$( document ).ready(function() {
    page.init();
    
});
