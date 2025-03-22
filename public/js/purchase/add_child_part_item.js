
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
                part_number: {
                    required: true
                },
                part_desc: {
                    required: true
                },
                safty_buffer_stk: {
                    required: true
                },
                hsn_code: {
                    required: false
                },
                sub_type: {
                    required: true
                },
                asset: {
                    required: false
                },
                store_rack_location: {
                    required: false
                },
                store_stock_rate: {
                    required: false,
                    number: true
                },
                weight: {
                    required: false,
                    number: true
                },
                size: {
                    required: false
                },
                thickness: {
                    required: false
                },
                uom_id: {
                    required: true
                },
                max_uom: {
                    required: true,
                    number: true
                },
                grade: {
                    required: true
                }
            },
            messages: {
                part_number: "Please enter Part Number",
                part_desc: "Please enter Part Description",
                safty_buffer_stk: "Please enter Safety/Buffer Stock",
                hsn_code: "Please enter HSN Code",
                sub_type: "Please select Purchase Item Category",
                asset: "Please select Asset",
                store_rack_location: "Please enter Store Rack Location",
                store_stock_rate: {
                    required: "Please enter Store Stock Rate",
                    number: "Please enter a valid number"
                },
                weight: {
                    required: "Please enter Weight",
                    number: "Please enter a valid number"
                },
                size: "Please enter Size",
                thickness: "Please enter Thickness",
                uom_id: "Please select UOM",
                max_uom: {
                    required: "Please enter Max PO Quantity",
                    number: "Please enter a valid number"
                },
                grade: "Please enter Grade"
            },
            errorPlacement: function(error, element)
            {
              error.insertAfter(element);
            },
            submitHandler: function(form) {
              var formdata = new FormData(form);
              $.ajax({
                url: base_url+"addchildpart",
                data:formdata,
                processData:false,
                contentType:false,
                cache:false,
                type:"post",
                success: function(result){
                  var data = JSON.parse(result);
                  if (data.success == 1) {
                      toastr.success(data.messages);
                      setTimeout(function () {
                        window.location.href = base_url+"child_part_view";
                    }, 2000);
                  }else{
                    toastr.error(data.messages);
                  }

                }
              });
            }
        }); 
    },
    initPlugin: function(){
        $(".item-category,.assets,.item-uom").select2();
        $(".parent-category").on("change",function(){
                // sub_category_type
                var parent_category = $(this).val();
                 $.ajax({
                  type: "POST",
                  url: base_url+"welcome/getSubCategory",
                  data: {parent_category:parent_category},
                  success: function (response) {
                    var responseObject = JSON.parse(response);
                    $(".sub_category_type").html(responseObject.html)
                  },
                  error: function (error) {
                    console.error("Error:", error);
                  },
                });
        })
    }
    
}
