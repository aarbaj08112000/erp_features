var table = '';
var file_name = "hsn_summary_report";
var pdf_title = "HSN Summary ";
// var myModal = new bootstrap.Modal(document.getElementById('child_part_update'))
const page = {
    init: function(){
        this.filter("first_time");
        this.dataTable();
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
        this.initiateExport();

    },
    dataTable: function(){
        let that = this;
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
                            var total_qty = 0;
                            var total_rate = 0;
                            var total_balance_amount = 0;
                            var total_sgst = 0;
                            var total_cgst = 0;
                            var total_igst = 0;
                            var total_tcs = 0;
                            var total_gst = 0;
                            var modifiedLines = lines.map(function(line) {
                                var values = line.split(',');
                                total_qty += parseFloat((values[2].replaceAll('"',"")).replaceAll(',',"")) > 0 ? parseFloat((values[2].replaceAll('"',"")).replaceAll(',',"")) : 0;
                                total_rate += parseFloat((values[9].replaceAll('"',"")).replaceAll(',',"")) > 0 ? parseFloat((values[9].replaceAll('"',"")).replaceAll(',',"")) : 0;
                                total_balance_amount += parseFloat((values[3].replaceAll('"',"")).replaceAll(',',"")) > 0 ? parseFloat((values[3].replaceAll('"',"")).replaceAll(',',"")) : 0;
                                total_sgst += parseFloat((values[4].replaceAll('"',"")).replaceAll(',',"")) > 0 ? parseFloat((values[4].replaceAll('"',"")).replaceAll(',',"")) : 0;
                                total_cgst += parseFloat((values[5].replaceAll('"',"")).replaceAll(',',"")) > 0 ? parseFloat((values[5].replaceAll('"',"")).replaceAll(',',"")) : 0;
                                total_igst += parseFloat((values[6].replaceAll('"',"")).replaceAll(',',"")) > 0 ? parseFloat((values[6].replaceAll('"',"")).replaceAll(',',"")) : 0;
                                total_tcs += parseFloat((values[7].replaceAll('"',"")).replaceAll(',',"")) > 0 ? parseFloat((values[7].replaceAll('"',"")).replaceAll(',',"")) : 0;
                                total_gst += parseFloat((values[8].replaceAll('"',"")).replaceAll(',',"")) > 0 ? parseFloat((values[8].replaceAll('"',"")).replaceAll(',',"")) : 0;
                                var customer_column_show = $("[name='inlineRadioOptions']:checked").val();
                                if(table != undefined && table != ""){
                                    if(customer_column_show != "Yes"){
                                        values.splice(1, 1);
                                    }
                                }
                                return values.join(',');
                            });
                            
                            var customer_column_show = $("[name='inlineRadioOptions']:checked").val();
                                if(table != undefined && table != ""){
                                    if(customer_column_show != "Yes"){
                                        modifiedLines.push(`Total,${total_qty.toFixed(2)},${total_balance_amount.toFixed(2)},${total_sgst.toFixed(2)},${total_cgst.toFixed(2)},${total_igst.toFixed(2)},${total_tcs.toFixed(2)},${total_gst.toFixed(2)},${total_rate.toFixed(2)}`);
                                    }else{
                                        modifiedLines.push(`Total,,${total_qty.toFixed(2)},${total_balance_amount.toFixed(2)},${total_sgst.toFixed(2)},${total_cgst.toFixed(2)},${total_igst.toFixed(2)},${total_tcs.toFixed(2)},${total_gst.toFixed(2)},${total_rate.toFixed(2)}`);
                                    }
                                }

                            
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
                      var current_date = $("#date_range_filter").val()
                      var dateParts = current_date.split(' - ');
                      var start_date = dateParts[0];
                      start_date = start_date.split('/');
                      start_date = start_date[2] + '/' + start_date[1] + '/' + start_date[0];
                      var end_date = dateParts[1];
                      end_date = end_date.split('/');
                      end_date = end_date[2] + '/' + end_date[1] + '/' + end_date[0];
                      doc.pageMargins = [15, 15, 15, 15];
                      doc.content[0].text = pdf_title+" ("+start_date+" -" +end_date+")";
                      doc.content[0].color = theme_color;
                      doc.content[1].table.widths = ['10%', '10%', '10%','10%', '10%', '10%','10%', '10%','10%', '10%'];
                      var customer_column_show = $("[name='inlineRadioOptions']:checked").val();
                        if(table != undefined && table != ""){
                            if(customer_column_show != "Yes"){
                                doc.content[1].table.widths = ['11.11%', '11.11%', '11.11%','11.11%', '11.11%', '11.11%','11.11%', '11.11%','11.11%', '11.11%'];
                            }
                        }
                      
                        doc.content[1].table.body[0].forEach(function(cell) {
                            cell.fillColor = theme_color;
                        });
                        var total_qty = 0;
                        var total_rate = 0;
                        var total_balance_amount = 0;
                        var total_sgst = 0;
                        var total_cgst = 0;
                        var total_igst = 0;
                        var total_tcs = 0;
                        var total_gst = 0;
                        doc.content[1].table.body.forEach(function(row, rowIndex) {
                            if(rowIndex > 0){
                                total_qty += parseFloat((row[2]['text'].replaceAll('"',"")).replaceAll(',',"")) > 0 ? parseFloat((row[2]['text'].replaceAll('"',"")).replaceAll(',',"")) : 0;
                                total_rate += parseFloat((row[9]['text'].replaceAll('"',"")).replaceAll(',',"")) > 0 ? parseFloat((row[9]['text'].replaceAll('"',"")).replaceAll(',',"")) : 0;
                                total_balance_amount += parseFloat((row[3]['text'].replaceAll('"',"")).replaceAll(',',"")) > 0 ? parseFloat((row[3]['text'].replaceAll('"',"")).replaceAll(',',"")) : 0;
                                total_sgst += parseFloat((row[4]['text'].replaceAll('"',"")).replaceAll(',',"")) > 0 ? parseFloat((row[4]['text'].replaceAll('"',"")).replaceAll(',',"")) : 0;
                                total_cgst += parseFloat((row[5]['text'].replaceAll('"',"")).replaceAll(',',"")) > 0 ? parseFloat((row[5]['text'].replaceAll('"',"")).replaceAll(',',"")) : 0;
                                total_igst += parseFloat((row[6]['text'].replaceAll('"',"")).replaceAll(',',"")) > 0 ? parseFloat((row[6]['text'].replaceAll('"',"")).replaceAll(',',"")) : 0;
                                total_tcs += parseFloat((row[7]['text'].replaceAll('"',"")).replaceAll(',',"")) > 0 ? parseFloat((row[7]['text'].replaceAll('"',"")).replaceAll(',',"")) : 0;
                                total_gst += parseFloat((row[8]['text'].replaceAll('"',"")).replaceAll(',',"")) > 0 ? parseFloat((row[8]['text'].replaceAll('"',"")).replaceAll(',',"")) : 0;
                            }
                            row.forEach(function(cell, cellIndex) {
                                var alignmentClass = $('#example1 tbody tr:eq(' + rowIndex + ') td:eq(' + cellIndex + ')').attr('class');

                            });
                            var customer_column_show = $("[name='inlineRadioOptions']:checked").val();
                            if(table != undefined && table != ""){
                                if(customer_column_show != "Yes"){
                                    row.splice(1, 1);
                                }
                            }

                            // row.splice(14, 1);
                        });
                        // Add a new row to the table (For example: Add an empty row or custom values)
                        var newRow = [
                            { text: 'Total', style: 'tableCell',fillColor:"#f0f0f0" , bold: true},
                            { text: '', style: 'tableCell' ,fillColor:"#f0f0f0", bold: true},
                            { text: total_qty.toFixed(2), style: 'tableCell',fillColor:"#f0f0f0" , bold: true},
                            { text: total_balance_amount.toFixed(2), style:'tableCell',fillColor:"#f0f0f0" , bold: true},
                            { text: total_sgst.toFixed(2), style: 'tableCell',fillColor:"#f0f0f0" , bold: true},
                            { text: total_cgst.toFixed(2), style: 'tableCell',fillColor:"#f0f0f0" , bold: true},
                            { text: total_igst.toFixed(2), style: 'tableCell',fillColor:"#f0f0f0" , bold: true},
                            { text: total_tcs.toFixed(2), style: 'tableCell',fillColor:"#f0f0f0" , bold: true},
                            { text: total_gst.toFixed(2), style: 'tableCell',fillColor:"#f0f0f0" , bold: true},
                            { text: total_rate.toFixed(2), style: 'tableCell',fillColor:"#f0f0f0" , bold: true}
                        ];
                        var customer_column_show = $("[name='inlineRadioOptions']:checked").val();
                            if(table != undefined && table != ""){
                                if(customer_column_show != "Yes"){
                                    var newRow = [
                                            { text: 'Total', style: 'tableCell',fillColor:"#f0f0f0" , bold: true},
                                            { text: total_qty.toFixed(2), style: 'tableCell',fillColor:"#f0f0f0" , bold: true},
                                            { text: total_balance_amount.toFixed(2), style:'tableCell',fillColor:"#f0f0f0" , bold: true},
                                            { text: total_sgst.toFixed(2), style: 'tableCell',fillColor:"#f0f0f0" , bold: true},
                                            { text: total_cgst.toFixed(2), style: 'tableCell',fillColor:"#f0f0f0", bold: true },
                                            { text: total_igst.toFixed(2), style: 'tableCell',fillColor:"#f0f0f0", bold: true },
                                            { text: total_tcs.toFixed(2), style: 'tableCell',fillColor:"#f0f0f0" , bold: true},
                                            { text: total_gst.toFixed(2), style: 'tableCell',fillColor:"#f0f0f0" , bold: true},
                                            { text: total_rate.toFixed(2), style: 'tableCell',fillColor:"#f0f0f0" , bold: true}
                                        ];
                                }
                            }
                        

                        // Add the row to the table body
                        doc.content[1].table.body.push(newRow);  // Add it to the end, or you can insert at any position

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
            fixedColumns: {
                leftColumns: 2,
                // end: 1
            },
            ajax: {
                data: {'search':that.serachParams()},    
                url: "SalesController/hsnReportsAjax",
                type: "POST",
                dataSrc: function(json) {
                    // Log the entire response to see what extra data is included
                    $(".total_qty_block").html(json.total_qty)
                    $(".total_rate_block").html(json.total_rate)
                    $(".total_amount_paid").html(json.total_paid_amount)
                    $(".total_balance_amount_to_pay").html(json.total_balance_amount_to_pay)
                    return json.data; // This is what populates the DataTable
                }
            },
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
        var customer_column_show = $("[name='inlineRadioOptions']:checked").val();
        if(table != undefined && table != ""){
            if(customer_column_show == "Yes"){
                table.column(1).visible(true);
            }else{
                table.column(1).visible(false);
            }
        }
    },
    formValidation: function(){
        let that = this;
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
        $('#date_range_filter').daterangepicker({
            singleDatePicker: false,
            showDropdowns: true,
            autoApply: true,
            locale: {
                format: 'YYYY/MM/DD' // Change this format as per your requirement
            }
        });
        dateRangePicker = $('#date_range_filter').data('daterangepicker');
        dateRangePicker.setStartDate(start_date);
        dateRangePicker.setEndDate(end_date);
    },
    serachParams: function(){
        var customer_search = $("#customer_search").val();
        var hsn_search = $("#hsn_search").val();
        var date_range = $("#date_range_filter").val();
        var params = {customer:customer_search,hsn_code:hsn_search,date_range:date_range};
        return params;
    },
    resetFilter: function(){
        $("#customer_search").val('').trigger('change');
        $("#hsn_search").val('');
        dateRangePicker.setStartDate(start_date);
        dateRangePicker.setEndDate(end_date);
        table.destroy(); 
        this.dataTable();
    },
    initiateExport: function(){
        $('#sales_report_export').on('submit', function(event) {
            // Prevent the form from submitting via the browser
           
               event.preventDefault(); // Prevent the form from submitting via the browser
               var form = $(this);
               var formData = form.serialize();
           
               $.ajax({
                   type: 'POST',
                   url: form.attr('action'),
                   data: formData,
                   success: function(response) {
                       var responseObject = JSON.parse(response);
                        var msg = responseObject.message;
                        var success = responseObject.success;
                        if (success == 1) {
                            toastr.success(msg);
                            setTimeout(function(){
                                 window.open(responseObject.pdf_utl, "_blank");
                            },1000);

                        } else {
                            toastr.error(msg);
                        }
                   },
                   error: function(xhr, status, error) {
                       // Handle error
                       toastr.success('unable to delete part.')
                   }
               });
            
        });
    }
}

$( document ).ready(function() {
    page.init();
});