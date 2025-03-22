$( document ).ready(function() {
    page.init();
});
var table = '';
var file_name = "item_par_list";
var pdf_title = "Item part List";
const page = {
    init: function(){
        this.formValidation();
        this.initiatePlugin();

    },
    formValidation: function(){
        let that = this;
        $.validator.addMethod("lessThan100", function(value, element) {
            
            let discount_type = $("#discount_type").val();
            let discount_val = parseFloat($("#discount_val").val());
            let validate = true;
            if(discount_type == "Percentage" && discount_val > 100){
                validate = false;
            }
        return validate;
        }, "Discount should be less than 100.");
        $("#addsupplier").validate({
            rules: {
                supplierName: {
                    required: true
                },
                supplierEmail: {
                    required: false,
                    email:true
                },
                supplierNumber: {
                    required: true
                },
                with_in_state: {
                    required: true
                },
                supplierlocation: {
                    required: true
                },
                state: {
                    required: true
                },
                supplierMnumber: {
                    required: false,
                    minlength:10,
                    maxlength:10
                },
                gst_no: {
                    required: true,
                    remote: base_url+"welcome/checkDublicateGstNumber?id="+id
                },
                pan_card: {
                    required: false
                },
                paymentTerms: {
                    required: true
                },
                // nda_document: {
                //     required: true
                // },
                paymentDays: {
                    required:true,
                    minlength:0
                },
                // discount_type:{
                //     required:true
                // },
                discount:{
                    'required': function(element) {
                        let form_type = $("#discount_type").val();
                        let validate = false;
                        if(form_type != "" ){
                            validate = true;
                        }
                        return validate;
                    },
                    lessThan100: true
                }
                
            },
            messages: {
                supplierName: "Please enter Supplier Name",
                supplierEmail:  {
	                required:  "Please enter Supplier Email",
	                email: "Please enter valid email.",
	            },
                supplierNumber: "Please enter Supplier Number",
                with_in_state: "Please enter With In State",
                supplierlocation: "Please enter Supplier Location",
                state: "Please enter State",
                supplierMnumber: {
                    required: "Please enter Supplier Mobile Number",
                    minlength: "Please enter valid Supplier Mobile Number",
                    maxlength:"Please enter valid Supplier Mobile Number"
                },
                gst_no: {
                    required: "Please enter GST Number",
                    remote: "GST Number aleady exist"
                },
                pan_card: "Please enter Supplier Pan",
                paymentTerms: "Please enter Payment Terms",
                paymentDays: {
                    required: "Please enter Payment Days",
                    minlength: "Payment Days must be greater than 0"
                },
                discount_type:{
                    required: "Please select Discount Type",
                },
                discount: {
                    required: "Please enter Discount",
                    maxlength:"Discount should be less than or equal to 100"
                },
                // nda_document: "Please upload Upload NDA Document"
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
                url: base_url+"addSupplier",
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
                        window.location.href = base_url+"approved_supplier";
                    }, 2000);
                  }else{
                    toastr.error(data.message);
                  }

                }
              });
            }
        }); 
    },
    initiatePlugin: function(){
    	$(".select2").select2();
    }
}
