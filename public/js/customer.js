var file_name = "Customer";
var pdf_title = "Customers";
var table = '';
var myModal = new bootstrap.Modal(document.getElementById('edit_modal'))
const datatable = {
    init:function(){
        let that = this;
        $('#customer_name').select2();
        that.dataTable();
        $(document).on('click','.search-filter',function(e){
            let customer_name = $("#customer_name").val();
            table.column(1).search(customer_name).draw();
            $(".close-filter-btn").trigger( "click" )
        })
        $(document).on('click','.reset-filter',function(e){
           that.resetFilter();
        })
        $(document).on("click",".edit-part",function(){
            var data = $(this).attr("data-value");
          
            data = JSON.parse(atob(data)); 
            console.log(data.gst_number)
            $("#updateCustomerForm #ucustomer_id").val(data['id']);
            $("#updateCustomerForm #ucustomer_name").val(data.customer_name);
            $("#updateCustomerForm #ucustomer_code").val(data.customer_code);
            $("#updateCustomerForm #ucustomer_address").val(data.billing_address);
            $("#updateCustomerForm #ucustomer_shifting_address").val(data.shifting_address);
            $("#updateCustomerForm #ucustomer_state").val(data.state);
            $("#updateCustomerForm #ucustomer_state_no").val(data.state_no);
            $("#updateCustomerForm #upayment_terms").val(data.payment_terms);
            $("#updateCustomerForm #uvendor_code").val(data.vendor_code);
            $("#updateCustomerForm #upan_no").val(data.pan_no);
            $("#updateCustomerForm #ubank_details").val(data.bank_details);
            $("#updateCustomerForm #upos").val(data.pos);
            $("#updateCustomerForm #uaddress1").val(data.address1);
            $("#updateCustomerForm #ulocation").val(data.location);
            $("#updateCustomerForm #pin").val(data.pin);
            $('#updateCustomerForm #customer_id').val(data.id)
            $('#updateCustomerForm #discount_val').val(data.discount);
            $('#updateCustomerForm #ucustomer_gst_number').val(data.gst_number);
            $("#updateCustomerForm #NA").prop('checked', false);
            $("#updateCustomerForm #Percentage").prop('checked', false);
            $("#updateCustomerForm #ucustomerType").val(data.customerType).trigger("change");
            if(data.discountType == "Percentage"){
              $("#updateCustomerForm #PercentageOpt").prop('checked', true);
            }else{
              $("#updateCustomerForm #NA").prop('checked', true);
            }
            for (var i = 1; i <= currentUnit; i++) {
                var customer_unit = "distncFrmClnt"+i;
                $('#updateCustomerForm #distncFrmClnt'+i).val(data[customer_unit])
            }
            $("#updateCustomerForm #updateEmailId").val(data['emailId']);
            myModal.show();
        })
    },
    dataTable:function(){
      table =  new DataTable('#example1',{
        dom: "Bfrtilp",
        scrollX: false, 
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
                    
                    
                },
            ],
            searching: true,
      // scrollX: true,
      scrollY: true,
      order: [[0,"desc"]],
      bScrollCollapse: true,
      // columnDefs: [{ sortable: false, targets: 9 }],
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
        $("#customer_name").val("").trigger("change");
        table.column(1).search('').draw();
    }

}

const validationFunc = () => {
  $.extend($.validator.messages, {
        required: "Please enter distance.", // Customize required message
    });
    $('#addCustomerForm').validate({
        rules: {
           customerName: {
              required: true
           },
           customerCode: {
              required: true
           },
           customerLocation: {
              required: true
           },
           customerSaddress: {
              required: true
           },
           state: {
              required: true
           },
           state_no: {
              required: true
           },
           gst_no: {
              required: true
           },
           vendor_code: {
              required: true
           },
           pan_no: {
              required: true
           },
           paymentTerms: {
              required: true,
              number: true,
              min: 0
           },
           pos: {
              required: true,
              min: 1
           },
           address1: {
              required: true
           },
           location: {
              required: true
           },
           pin: {
              required: true
           },
           "[name^='distncFrmClnt']": { // Select all inputs where the name attribute starts with 'distncFrmClnt'
                required: true,
            }
        },
        messages: {
           customerName: {
              required: "Please enter the customer name"
           },
           customerCode: {
              required: "Please enter the customer code"
           },
           customerLocation: {
              required: "Please enter the customer billing address"
           },
           customerSaddress: {
              required: "Please enter the customer shipping address"
           },
           state: {
              required: "Please enter the state"
           },
           state_no: {
              required: "Please enter the state number"
           },
           gst_no: {
              required: "Please enter the GST number"
           },
           vendor_code: {
              required: "Please enter the vendor code"
           },
           pan_no: {
              required: "Please enter the PAN number"
           },
           paymentTerms: {
              required: "Please enter the payment terms",
              number: "Please enter a valid number",
              min: "Value must be greater than or equal to 0"
           },
           pos: {
              required: "Please enter the pos",
              min: "Value must be greater than or equal to 0"
           },
           address1: {
              required: "Please enter the address"
           },
           location: {
              required: "Please enter the location"
           },
           pin: {
              required: "Please enter the pin"
           },
           "[name^='distncFrmClnt']": { // Select all inputs where the name attribute starts with 'distncFrmClnt'
                required: "Please enter distance.",
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

     $('#updateCustomerForm').validate({
        rules: {
           ucustomerName: {
              required: true
           },
           ucustomerCode: {
              required: true
           },
           ubillingaddress: {
              required: true
           },
           ushiftingAddress: {
              required: true
           },
           ustate: {
              required: true
           },
           state_no: {
              required: true
           },
           ugst_no: {
              required: true
           },
           upaymentTerms: {
              required: true
           },
           vendor_code: {
              required: true
           },
           pan_no: {
              required: true
           },
           // bank_details: {
           //    required: true
           // },
           pos: {
              required: true,
              min: 1
           },
           address1: {
              required: true
           },
           location: {
              required: true
           },
           pin: {
              required: true
           },
           "[name^='distncFrmClnt']": { // Select all inputs where the name attribute starts with 'distncFrmClnt'
                required: true,
            }
        },
        messages: {
           ucustomerName: {
              required: "Please enter the customer name"
           },
           ucustomerCode: {
              required: "Please enter the customer code"
           },
           ubillingaddress: {
              required: "Please enter the customer billing address"
           },
           ushiftingAddress: {
              required: "Please enter the customer shipping address"
           },
           ustate: {
              required: "Please enter the state"
           },
           state_no: {
              required: "Please enter the state number"
           },
           ugst_no: {
              required: "Please enter the GST number"
           },
           upaymentTerms: {
              required: "Please enter the payment terms"
           },
           vendor_code: {
              required: "Please enter the vendor code"
           },
           pan_no: {
              required: "Please enter the PAN number"
           },
           bank_details: {
              required: "Please enter the bank details"
           },
           pos: {
              required: "Please enter the pos",
              min: "Value must be greater than or equal to 0"
           },
           address1: {
              required: "Please enter the address"
           },
           location: {
              required: "Please enter the location"
           },
           pin: {
              required: "Please enter the pin"
           },
           "[name^='distncFrmClnt']": { // Select all inputs where the name attribute starts with 'distncFrmClnt'
                required: "Please enter distance.",
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
}

$(document).ready(function () {
    datatable.init();    
    validationFunc();
})