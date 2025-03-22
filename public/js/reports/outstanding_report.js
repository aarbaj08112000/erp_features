var table = '';
var file_name = "outstanding_report";
var pdf_title = "Outstanding Report";
var myModal = new bootstrap.Modal(document.getElementById('update_report_data'));
var dateRangePicker;
const page = {
    init: function(){
        this.filter();
        this.dataTable();
        this.formValidation();
        let that = this;
        $(document).on("click",".edit-part",function(){
            var data = $(this).attr("data-value");
            data = JSON.parse(atob(data)); 
            $('#sales_number').val(data.sales_number);
            $("#payment_date_modal").val(data.payment_receipt_date);
            $("#receivable_amount_modal").val(data.amount_received);
            $("#transection_detail_modal").val(data.transaction_details);
            $("#tds_val").val(data.tds_amount);
            $("#remark").val(data.remark_val);
            myModal.show();
        })
        $('#updateReceivableForm').on('submit', function(e){
            e.preventDefault(); // Prevent the default form submission
            var form = $(this);
            var formData = form.serialize();
            let flag = that.formValidate("updateReceivableForm");
            if(flag){
                event.preventDefault();
                    return;
            }
            $.ajax({
                url: base_url+'update_receivable_report',
                type: 'POST',
                data: $(this).serialize(), // Serialize form data
                success: function(response){
                    var responseObject = JSON.parse(response);
                        var msg = responseObject.message;
                        var success = responseObject.success;
                        if (success == 1) {
                            toastr.success(msg);
                            setTimeout(function(){
                                // window.location.reload();
                                 table.destroy(); 
                                that.dataTable();
                                 myModal.hide();
                            },1000);

                        } else {
                            toastr.error(msg);
                        }
                },
                error: function(xhr, status, error){
                    console.log('Error:', error);
                    alert('An error occurred. Please try again.');
                }
            });
        });

        $('#report_date').daterangepicker({
            singleDatePicker: false,
            showDropdowns: true,
            autoApply: true,
            locale: {
                format: 'YYYY/MM/DD' // Change this format as per your requirement
            }
        });
        var dateRangePicker1 = $('#report_date').data('daterangepicker');
        dateRangePicker1.setStartDate(start_date);
        dateRangePicker1.setEndDate(end_date);

        $('#export_oustanding_report').on('submit', function(e){
            var report_date = $("#report_date").val();
            window.location.href = base_url+'generate_outsanding_pdf?date='+report_date;
            
        });

    },
    formValidate: function(form_class){
        let flag = false;
        $(".custom-form."+form_class+" .required-input").each(function( index ) {
          var value = $(this).val();

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
        });
        return flag;
    },
    dataTable: function(){
        var data = this.serachParams();
        table = new DataTable("#receivable_report", {
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
                            var total_receive = 0;
                            var total_payable = 0;
                            var i = 0
                            
                            var modifiedLines = lines.map(function(line) {
                                var values = line.split(',');
                                values.splice(13, 1);
                                if( i > 0){
                                    
                                    if (!Number.isNaN(parseFloat((values[1].replaceAll('"', "")).replaceAll(',', "")))) {
                                       total_receive += parseFloat((values[1].replaceAll('"',"")).replaceAll(',',""));
                                    }
                                    if (!Number.isNaN(parseFloat((values[2].replaceAll('"', "")).replaceAll(',', "")))) {
                                       total_payable += parseFloat((values[2].replaceAll('"',"")).replaceAll(',',""));
                                    }
                                }
                                i++;
                                return values.join(',');
                            });
                            modifiedLines.unshift(`Date : ${start_date} - ${end_date}`);
                            total_receive = total_receive == 0 ? "" : total_receive.toFixed(2);
                            total_payable = total_payable == 0 ? "" : total_payable.toFixed(2);
                            modifiedLines.push(`Total,${total_receive},${total_payable}`);
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
                      doc.content[0].text = pdf_title+"\n("+start_date+"-"+end_date+")";
                      doc.content[0].color = theme_color;
                        // doc.content[1].table.widths = ['15%', '19%', '13%', '13%','15%', '15%', '10%'];
                        doc.content[1].table.body[0].forEach(function(cell) {
                            cell.fillColor = theme_color;
                        });
                        var total_receive = 0;
                        var total_payable = 0;
                        doc.content[1].table.body.forEach(function(row, rowIndex) {
                            if(rowIndex > 0){
                                if (!Number.isNaN(parseFloat((row[1]['text'].replaceAll('"', "")).replaceAll(',', "")))) {
                                       total_receive +=  parseFloat((row[1]['text'].replaceAll('"',"")).replaceAll(',',""));
                                }
                                if (!Number.isNaN(parseFloat((row[2]['text'].replaceAll('"', "")).replaceAll(',', "")))) {
                                     total_payable += parseFloat((row[2]['text'].replaceAll('"',"")).replaceAll(',',""));
                                }
                                
                                
                            }
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
                        total_receive = total_receive == 0 ? "" : total_receive.toFixed(2);
                        total_payable = total_payable == 0 ? "" : total_payable.toFixed(2);
                        var newRow = [
                            { text: 'Total', style: 'tableCell',fillColor:"#f0f0f0" , bold: true},
                            { text: total_receive, style: 'tableCell' ,fillColor:"#f0f0f0", bold: true},
                            { text: total_payable, style: 'tableCell',fillColor:"#f0f0f0" , bold: true}
                        ];

                        // Add the row to the table body
                        doc.content[1].table.body.push(newRow);
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
             columnDefs: [{ sortable: false, targets: 1 },{ sortable: false, targets: 2 }],
            ajax: {
                data: {'search':data},    
                url: "SalesController/getOutstandingReportData",
                type: "POST",
                dataSrc: function(json) {
                    // Log the entire response to see what extra data is included
                    
                    for (var i = 0; i < json.data.length; i++) {
                        var value_t = json.data[i]['receivable_amount'] != "" ? parseFloat(json.data[i]['receivable_amount']) : "";
                        json.data[i]['receivable_amount'] = value_t != "" ? (value_t).toFixed(2) : "";
                        var value_p = json.data[i]['payable_amount'] != "" ? parseFloat(json.data[i]['payable_amount']) : "";
                        json.data[i]['payable_amount'] = value_p != "" ?(value_p).toFixed(2)  : ""
                    }
                    $(".total_paid_amount").html(json.total_paid_amount)
                    $(".total_pay_amount").html(json.total_pay_amount)
                    $(".total_diffence").html(json.total_diff)
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
    },
    formValidation: function(){
        let that = this;
    },
    filter: function(){
        let that = this;
        $('#part_number_search,#status_search').select2();
        // $('#date_range_filter').daterangepicker({
        //     singleDatePicker: false,
        //     showDropdowns: true,
        //     autoApply: true,
        //     locale: {
        //         format: 'YYYY/MM/DD' // Change this format as per your requirement
        //     }
        // });
        // dateRangePicker = $('#date_range_filter').data('daterangepicker');
        // dateRangePicker.setStartDate(start_date);
        // dateRangePicker.setEndDate(end_date);
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
        var customer_id = $("#customer_id").val();
        var date_range = $("#date_range_filter").val();
        var supplier_id = $("#supplier_id").val();
        var params = {customer_id:customer_id,date_range:date_range,supplier_id:supplier_id};
        return params;
    },
    resetFilter: function(){
        $("#customer_id").val('').trigger('change');
        $("#supplier_id").val('').trigger('change');
        dateRangePicker.setStartDate(start_date);
        dateRangePicker.setEndDate(end_date);
        table.destroy(); 
        this.dataTable();
    }
}

$( document ).ready(function() {
    page.init();



});