$(document).ready(function() {
  $('#child_part_view').DataTable();
  $('#child_part_supplier').DataTable();
  $('#new_po_list_supplier').DataTable();
  $('#closed_po').DataTable();
  $('#pending_po').DataTable();
  $('#rejected_po').DataTable();
  $('#expired_po').DataTable();
  $('#routing').DataTable();
  $('#routing_customer').DataTable();
  $('#approved_supplier').DataTable();
  $('#supplier').DataTable();


  $("#child_part_supplier").validate({
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
        // quotation_document: {
        //     required: true
        // }
    },
    messages: {
        supplier_id: "Please enter Supplier ID.",
        child_part_id: "Please enter Child Part ID.",
        gst_id: "Please enter GST ID.",
        upart_rate: "Please enter Unit Part Rate.",
        revision_no: "Please enter Revision Number.",
        revision_remark: "Please enter Revision Remark.",
        revision_date: "Please enter Revision Date.",
        // quotation_document: "Please upload Quotation Document."
    },
    errorPlacement: function(error, element) {
        error.insertAfter(element);
    },
    submitHandler: function(form) {
        var formdata = new FormData(form);
        $.ajax({
            url: "addchildpart_supplier",
            data: formdata,
            processData: false,
            contentType: false,
            cache: false,
            type: "post",
            success: function(result) {
                var data = JSON.parse(result);
                if (data.success == 1) {
                    toastr.success(data.message);
                    setTimeout(function() {
                        window.location.href = "child_part_supplier_view";
                    }, 2000);
                } else {
                    toastr.error(data.message);
                }
            },
            error: function(xhr, status, error) {
                toastr.error("An error occurred: " + xhr.status + " " + error);
            }
        });
    }
});



  });
