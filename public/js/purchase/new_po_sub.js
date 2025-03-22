$(document).ready(function() {
    $("#new_po_sub").validate({
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

            billing_address: {
                required: true
            },
            shipping_address: {
                required: true
            }
        },
        messages: {
            supplier_id: "Please enter Supplier ID.",
            po_date: "Please enter PO Date.",
            expiry_po_date: "Please enter Expiry PO Date.",
            billing_address: "Please enter Billing Address.",
            shipping_address: "Please enter Shipping Address."
        },
        errorPlacement: function(error, element) {
            error.insertAfter(element);
        },
        submitHandler: function(form) {
            var formdata = new FormData(form);
            $.ajax({
                url: "generate_new_po",
                data: formdata,
                processData: false,
                contentType: false,
                cache: false,
                type: "post",
                success: function(result) {
                    var data = JSON.parse(result);
                    if (data.success == 1) {
                        toastr.success(data.messages);
                        setTimeout(function() {
                            window.location.href = "new_po_list_supplier";
                        }, 2000);
                    } else {
                        toastr.error(data.messages);
                    }
                },
                error: function(xhr, status, error) {
                    toastr.error("An error occurred: " + error);
                }
            });
        }
    });
});
