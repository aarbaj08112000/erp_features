var table = '';
var file_name = "port";
var pdf_title = "Port";

$(document).ready(function() {

   

    $(document).on("click",".edit-part",function(){
        var data = $(this).attr("data-value");
        data = JSON.parse(atob(data)); 
        console.log(data);
        $("#u_name").val(data.name);
        $("#u_id").val(data.id);
        // myModal.show();
    })

    var table = $("#client").DataTable({
        dom: "Bfrtilp",
        buttons: [
            {
                extend: "csv",
                text: '<i class="ti ti-file-type-csv"></i>',
                init: function (api, node, config) {
                    $(node).attr("title", "Download CSV");
                },
                // Removed CSV customization that splices column 14 since your table only has 3 columns.
                filename: file_name
            },
            {
                extend: "pdf",
                text: '<i class="ti ti-file-type-pdf"></i>',
                init: function (api, node, config) {
                    $(node).attr("title", "Download Pdf");
                },
                filename: file_name,
                customize: function (doc) {
                    doc.pageMargins = [15, 15, 15, 15];
                    doc.content[0].text = pdf_title;
                    doc.content[0].color = theme_color;
                    // Adjust widths based on the three columns in your table
                    doc.content[1].table.widths = ["10%", "70%", "20%"];
                    // Set header row fill color
                    doc.content[1].table.body[0].forEach(function (cell) {
                        cell.fillColor = theme_color;
                    });
                    // Align all cells in each row
                    doc.content[1].table.body.forEach(function (row, index) {
                        row.forEach(function (cell) {
                            cell.alignment = "center";
                        });
                    });
                }
            }
        ],
        searching: true,
        scrollX: true,
        scrollY: true,
        bScrollCollapse: true,
        // Adjust columnDefs to target the correct column indices.
        // If you want to disable sorting on the Action column (index 2), use:
        columnDefs: [{ orderable: false, targets: 2 }],
        pagingType: "full_numbers"
    });
    
        $('#serarch-filter-input').on('keyup', function() {
            table.search(this.value).draw();
        });
        $('.dataTables_length').find('label').contents().filter(function() {
                return this.nodeType === 3; // Filter out text nodes
        }).remove();
        setTimeout(function(){
            $(".dataTables_length select").select2({
                minimumResultsForSearch: Infinity
            });
        },1000)

     // Initialize form validation
     $('#updateCountry').validate({
        rules: {
            name: {
                required: true
            },
        },
        messages: {
            name: {
                required: "Please enter the port name."
            },
        },
        submitHandler: function (form) {
            $.ajax({
                url: $(form).attr('action'),
                type: 'POST',
                data: $(form).serialize(),
                success: function (response) {
                    // Handle success response
                    if(response != '' && response != null && typeof response != 'undefined'){
                        let res = JSON.parse(response);
                        if(res['success'] == 1){
                            toastr.success(res['msg']);
                            setTimeout(() => {
                                window.location.reload();
                            }, 1000);
                        }else{
                            toastr.error(res['msg']);
                        }
                    }
                    $('#exampleModal2').modal('hide'); // Hide the modal
                    form.reset(); // Reset form fields after submission
                },
                error: function (response) {
                    // Handle error response
                    toastr.error("There was an error updating the Port information. Please try again.");
                }
            });
            return false; // Prevent default form submission
        }
    });

    $('#addCountry').validate({
        rules: {
            name: {
                required: true
            },
           
        },
        messages: {
            name: {
                required: "Please enter port name."
            },
            
        },
        submitHandler: function (form) {
            $.ajax({
                url: $(form).attr('action'),
                type: 'POST',
                data: new FormData(form),
                processData: false,
                contentType: false,
                success: function (response) {
                    // Handle success response
                    if(response != '' && response != null && typeof response != 'undefined'){
                        let res = JSON.parse(response);
                        if(res['success'] == 1){
                            toastr.success(res['msg']);
                            setTimeout(() => {
                                window.location.reload();
                            }, 1000);
                        }else{
                            toastr.error(res['msg']);
                        }
                    }
                    $('#addPromo1').modal('hide'); // Hide the modal
                    form.reset(); // Reset form fields after submission
                },
                error: function (response) {
                    // Handle error response
                    alert("There was an error updating the Port information. Please try again.");
                }
            });
            return false; // Prevent default form submission
        }
    });



    // Custom search filter event
  
   



});
