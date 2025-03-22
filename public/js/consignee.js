var file_name = "Consignee";
var pdf_title = "Consignee";
var table = '';
var myModal = new bootstrap.Modal(document.getElementById('edit_modal'))
const datatable = {
    init:function(){
        let that = this;
        $('#consignee_name').select2();
        that.dataTable();
        $(document).on('click','.search-filter',function(e){
            let consignee_name = $("#consignee_name").val();
            table.column(1).search(consignee_name).draw();
        })
        $(document).on('click','.reset-filter',function(e){
           that.resetFilter();
        })
        $(document).on("click",".edit-part",function(){
            var data = $(this).attr("data-value");
          
            data = JSON.parse(atob(data)); 
            // console.log(data)
           
            $("#uconsignee_name").val(data['consignee_name']);
            $("#uconsignee_ref").val(data.c_id);
            $("#uaddressRef").val(data.address_id);
            $("#ustate_num").val(data.state_no);
            $("#ustate").val(data.state);
            $("#ugst_no").val(data.gst_number);
            $("#uphone").val(data.phone_no);
            $("#upan").val(data.pan_no);
            $("#uaddress").val(data.address);
            $("#ulocation").val(data.location);
            $("#uPIN").val(data.pin_code);
            for (var i = 1; i <= currentUnit; i++) {
                var customer_unit = "distncFrmClnt"+i;
                $('#distncFrmClnt'+i).val(data[customer_unit])
            }
            myModal.show();
        })
    },
    dataTable:function(){
       table =  new DataTable('#example1',{
        dom: "Bfrtilp",
        // scrollX: true, 
        columnDefs: [
            { orderable: false, targets: [3,4,5,6,7,8] } // Disable ordering for the first and third columns
        ],
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
                                values.splice(1, 1);
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
      scrollX: true,
      order: [[0, 'desc']],
      scrollY: true,
      bScrollCollapse: true,
      columnDefs: [{ sortable: false, targets: 8 }],
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
    }

}

const validationFunc = () => {
    $.extend($.validator.messages, {
        required: "Please enter a distance.", // Customize required message
    });
    $("#update_form").validate({
        rules: {
            uconsignee_name: "required",
            ulocation: "required",
            uaddress: "required",
            ustate: "required",
            ustate_no: {
                required: true,
                maxlength: 2
                // pattern: /^\d{2}$/
            },
            upin_code: "required",
            ugst_number: "required",
            upan_no: "required",
            uphone_no: "required",
            "[name^='distncFrmClnt']": { // Select all inputs where the name attribute starts with 'distncFrmClnt'
                required: true,
            }
        },
        messages: {
            uconsignee_name: "Please enter the consignee name",
            ulocation: "Please enter the location",
            uaddress: "Please enter the address",
            ustate: "Please enter the state",
            ustate_no: {
                required: "Please enter the state number",
                maxlength: "State number length should be less than or equal to 2",
                // pattern: "Please enter exactly two digits"
            },
            upin_code: "Please enter the PIN code",
            ugst_number: "Please enter the GST number",
            upan_no: "Please enter the PAN number",
            uphone_no: "Please enter the phone number",
            "[name^='distncFrmClnt']": {
                required: "Please enter a distance.",
            }
        },
        submitHandler: function(form) {
            // Custom submit handler
           
            $.ajax({
                url: form.action,
                type: form.method,
                data: $(form).serialize(),
                success: function(response) {
                    // Handle the success response here
                    if(response != '' && response != null && typeof response != 'undefined'){
                        let res = JSON.parse(response);
                        if(res['sucess'] == 1){
                            toastr.success(res['msg'])
                            setTimeout(() => {
                                window.location.reload();
                            }, 1000);
                        }else{
                            toastr.error(res['msg']);
                        }
                       
                    }
                    

                },
                error: function(xhr, status, error) {
                    // Handle the error response here
                    toastr.error('Unable to Update consignee..')
                }
            });
        }
    });

    $("#add_consnee").validate({
        rules: {
            cconsignee_name: "required",
            clocation: "required",
            caddress: "required",
            cstate: "required",
            cstate_no: {
                required: true,
                maxlength: 2
                // pattern: /^\d{2}$/
            },
            cpin_code: "required",
            gst_number: "required",
            cpan_no: "required",
            cphone_no: "required",
            "[name^='distncFrmClnt']": { // Select all inputs where the name attribute starts with 'distncFrmClnt'
                required: true,
            }
        },
        messages: {
            cconsignee_name: "Please enter the consignee name",
            clocation: "Please enter the location",
            caddress: "Please enter the address",
            cstate: "Please enter the state",
            cstate_no: {
                required: "Please enter the state number",
                maxlength: "State number length should be less than or equal to 2",
                // pattern: "Please enter exactly two digits"
            },
            cpin_code: "Please enter the PIN code",
            gst_number: "Please enter the GST number",
            cpan_no: "Please enter the PAN number",
            cphone_no: "Please enter the phone number",
            "[name^='distncFrmClnt']": {
               required: "Please enter distance.",
            }
        },
        submitHandler: function(form) {
            // Custom submit handler
            $.ajax({
                url: form.action,
                type: form.method,
                data: $(form).serialize(),
                success: function(response) {
                    // Handle the success response here
                    if(response != '' && response != null && typeof response != 'undefined'){
                        let res = JSON.parse(response);
                        if(res['sucess'] == 1){
                            toastr.success(res['msg'])
                            setTimeout(() => {
                                window.location.reload();
                            }, 1000);
                        }else{
                            toastr.error(res['msg']);
                        }
                       
                    }
                },
                error: function(xhr, status, error) {
                    // Handle the error response here
                    console.error('Form submission failed:', error);
                }
            });
        }
    });
}

$(document).ready(function () {
    datatable.init();    
    validationFunc();
})