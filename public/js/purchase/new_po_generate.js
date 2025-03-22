$( document ).ready(function() {
    page.init();
});
const page = {
    init: function(){
        this.formValidation();

    },
    formValidation: function(){
        let that = this;
        $("#generateNewPo").validate({
            rules: {
                supplier_id: {
                    required: true
                },
                po_date: {
                    required: true
                },
                expiry_po_date: {
                    required: true
                },
                loading_unloading: {
                    required: true
                },
                loading_unloading_gst: {
                    required: true
                },
                freight_amount: {
                    required: true,
                },
                freight_amount_gst: {
                    required: true,
                },
                billing_address: {
                    required: true
                },
                shipping_address: {
                    required: true
                },
                discount_type: {
                    required:true
                }
            },
            messages: {
                supplier_id: "Please select Supplier / Number / GST",
                po_date: "Please enter PO Date",
                expiry_po_date: "Please select Expiry Date",
                loading_unloading: "Please enter Loading Unloading Amount",
                loading_unloading_gst: "Please select Loading Unloading Tax Strucutre",
                freight_amount: {
                    required: "Please enter Freight Amount "
                },
                freight_amount_gst: {
                    required: "Please enter Freight Tax Strucutre",
                },
                billing_address: "Please enter Billing Address",
                shipping_address: "Please enter Shipping Address ",
                discount_type: "Please select Discount Type",
            },
            errorPlacement: function(error, element)
            {
              	if(element.prop('tagName') == 'SELECT'){
                    $(element).parents(".form-group").find(".select2-container").after(error)
                }else{
                    error.insertAfter(element); 
                }
            },
            submitHandler: function(form) {
              var formdata = new FormData(form);
              $.ajax({
                url: base_url+"generate_new_po",
                data:formdata,
                processData:false,
                contentType:false,
                cache:false,
                type:"post",
                success: function(result){
                  var data = JSON.parse(result);
                  if (data.success == 1) {
                     toastr.success(data.message);
                      setTimeout(function () {
                        window.location.href = data.redirect_url;
                    }, 2000);
                  }else{
                    toastr.error(data.message);
                  }

                }
              });
            }
        }); 
    },
}

