$( document ).ready(function() {
    page.init();
});
const page = {
    init: function(){
        this.formValidation();
        this.initPlugin()
    },
    formValidation: function(){
        $("#addchildpart").validate({
            rules: {
                supplier_id: {
                    required: true
                },
                child_part_id: {
                    required: true
                },
                gst_id: {
                    required: true
                },
                upart_rate: {
                    required: true
                },
                revision_no: {
                    required: true
                },
                revision_remark: {
                    required: true
                },
                revision_date: {
                    required: true
                },
            },
            messages: {
                supplier_id: "Please select Supplier",
                child_part_id: "Please select Item Part",
                gst_id: "Please select Tax Structure",
                upart_rate: "Please enter Part Price",
                revision_no: "Please enter Revision Number",
                revision_remark: "Please enter Revision Remark",
                revision_date: "Please enter Revision Date",
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
                url: base_url+"addchildpart_supplier",
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
                        window.location.href = base_url+"child_part_supplier_view";
                    }, 2000);
                  }else{
                    toastr.error(data.message);
                  }

                }
              });
            }
        }); 
    },
    initPlugin: function(){
        $(".select2").select2()
    }
    
}

