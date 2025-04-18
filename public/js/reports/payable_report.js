var table = '';
var file_name = "payable_reports";
var pdf_title = "Payable Reports";
var myModal = new bootstrap.Modal(document.getElementById('update_report_data'))
var dateRangePicker;
const page = {
    init: function(){
        this.filter();
        this.dataTable();
        this.formValidation();
        let that = this;
        $(document).on("click",".add-payable-report",function(){
            var grn_number = $(this).attr("data-grn-number");
            var amount_paid = $(this).attr("data-amount-paid") > 0 ? $(this).attr("data-amount-paid") : 0 ;
            var bal_amnt = $(this).attr("data-bal-amnt") > 0 ? $(this).attr("data-bal-amnt") : 0 ;
            var tds = $(this).attr("data-tds") > 0 ? $(this).attr("data-tds") : 0;
            var payment_receipt_date = $(this).attr("data-payment-receipt-date");
            var transaction_details = $(this).attr("data-transaction-details");
            $("#grn_number").val(grn_number)
            $("#amount_paid").val(amount_paid)
            $("#bal_amnt").val(bal_amnt)
            $("#tds").val(tds)
            $("#payment_receipt_date").val(payment_receipt_date)
            $("#transaction_details").val(transaction_details)
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
                url: base_url+'ReportsController/update_payable_report',
                type: 'POST',
                data: $(this).serialize(), // Serialize form data
                success: function(response){
                    var responseObject = JSON.parse(response);
                        var msg = responseObject.messages;
                        var success = responseObject.success;
                        if (success == 1) {
                            toastr.success(msg);
                            table.destroy(); 
                            that.dataTable();
                            myModal.hide();

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
        dateRangePicker1.setStartDate(export_start_date);
        dateRangePicker1.setEndDate(export_end_date);

        $('#export_oustanding_report').on('submit', function(e){
            var report_date = $("#report_date").val();
            var type = $("[name='inlineRadioOptions']:checked").val();
            var client = $("#client_name").val();
            window.location.href = base_url+'sales_report_export?date='+report_date+"&type="+type+"&report_type=payable"+"&client="+client;
            
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
                            var modifiedLines = lines.map(function(line) {
                                var values = line.split(',');
                                values.splice(21, 1);
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
                            row.splice(21, 1);
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
                url: "ReportsController/getPayableReportData",
                type: "POST",
                dataSrc: function(json) {
                    // Log the entire response to see what extra data is included
                    console.log('Full Response:', json);
                    $(".total_amount_with_gst").html(json.total_with_gst_val)
                    $(".total_tds_amount").html(json.total_tds_amount)
                    $(".total_amount_paid").html(json.total_paid_amount)
                    $(".total_balance_amount_to_pay").html(json.total_balance_amount_to_pay)
                    return json.data; // This is what populates the DataTable
                }
            },
            "createdRow": function(row, data, dataIndex) {
                if (data.due_days_status === "danger") {
                    $(row).addClass('danger-row'); // Add class for active rows
                } 
            },
            columnDefs: [{ sortable: false, targets: 17 }],
            
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
        $('#supplier_part_id,#status_search').select2();
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
        var supplier_part_id = $("#supplier_part_id").val();
        var status = $("#status_search").val();
        var date_range = $("#date_range_filter").val();
        var params = {
            supplier_part_id:supplier_part_id,
            status:status,
            date_range:date_range
        };
        return params;
    },
    resetFilter: function(){
        $("#supplier_part_id").val('').trigger('change');
        $("#status_search").val('').trigger('change');
        dateRangePicker.setStartDate(start_date);
        dateRangePicker.setEndDate(end_date);
        table.destroy(); 
        this.dataTable();
    }
}

$( document ).ready(function() {
    page.init();



});