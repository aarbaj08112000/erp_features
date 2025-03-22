var table = '';
var file_name = "mold_maintance";
var pdf_title = "Mold Mantance";

$(document).ready(function() {

    $('.search-filter').on('click', function(e) {
        let part_val = $('#part_id_selected').val();
        console.log(part_val);
        // Ensure that the table and column exist before applying the search
        if (table && part_val) {
            table.column(1).search(part_val).draw();
        }
        $('.close-filter-btn').trigger('click');
    });

    $('.reset-filter').on('click',function(e){
        table.column(1).search('').draw();
        $('.close-filter-btn').trigger('click');    
    })

    $(document).on("click",".edit-part",function(){
        var data = $(this).attr("data-value");
        data = JSON.parse(atob(data)); 
        
        $("#mod_name").val(data.mold_name);
        $("#no_of_cavity").val(data.no_of_cavity);
        $("#part_description").val(data.part_description);
        $("#ownership").val(data.ownership);
        $("#selected_customer_part").val(data.customer_part_id).trigger('change');
        $("#target_life").val(data.target_life)
        $("#target_over_life").val(data.target_over_life);
        $("#id").val(data.id);
       
        // myModal.show();
    })

    // Initialize the DataTable
    table = $("#mold_maintenance").DataTable({
        dom: "Bfrtilp",
        buttons: [
            {
                extend: "csv",
                text: '<i class="ti ti-file-type-csv"></i>',
                init: function (api, node, config) {
                    $(node).attr("title", "Download CSV");
                },
                customize: function (csv) {
                        var lines = csv.split('\n');
                        var modifiedLines = lines.map(function(line) {
                            var values = line.split(',');
                            values.splice(7, 1);
                            return values.join(',');
                        });
                        return modifiedLines.join('\n');
                    },
                    filename : file_name
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
                    // doc.content[1].table.widths = ["19%", "19%", "13%", "13%", "15%", "15%"];
                    doc.content[1].table.body[0].forEach(function (cell) {
                        cell.fillColor = theme_color;
                    });
                    doc.content[1].table.body.forEach(function (row, index) {
                        row.splice(7, 1);
                        row.forEach(function (cell) {
                            // Set alignment for each cell
                            cell.alignment = "center"; // Change to 'left' or 'right' as needed
                        });
                    });
                },
            },
        ],
        searching: true,
        // scrollX: true,
        scrollY: true,
        bScrollCollapse: true,
        columnDefs: [{ sortable: false, targets: 7 }],
        pagingType: "full_numbers",
       
        
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

    $('#update_mold_form').validate({
        rules: {
            mold_name: {
                required: true
            },
            ownership: {
                required: true
            },
            no_of_cavity: {
                required: true,
                number: true
            },
            target_life: {
                required: true,
                number: true
            },
            target_over_life: {
                required: true,
                number: true
            }
        },
        messages: {
            mold_name: {
                required: "Please enter the mold name."
            },
            ownership: {
                required: "Please select ownership."
            },
            no_of_cavity: {
                required: "Please enter the number of cavities.",
                number: "Please enter a valid number."
            },
            target_life: {
                required: "Please enter the mold PM frequency.",
                number: "Please enter a valid number."
            },
            target_over_life: {
                required: "Please enter the mold life over frequency.",
                number: "Please enter a valid number."
            }
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
                    $('#addProm').modal('hide'); // Hide the modal
                    form.reset(); // Reset form fields after submission
                },
                error: function (response) {
                    // Handle error response
                    alert("There was an error updating the Mold Master. Please try again.");
                }
            });
            return false; // Prevent default form submission
        }
    });

    $('#add_mold_maintenance_form').validate({
        rules: {
            customer_part_id: {
                required: true
            },
            mold_name: {
                required: true
            },
            ownership: {
                required: true
            },
            no_of_cavity: {
                required: true,
                number: true
            },
            target_life: {
                required: true,
                number: true
            },
            target_over_life: {
                required: true,
                number: true
            }
        },
        messages: {
            customer_part_id: {
                required: "Please select a customer part."
            },
            mold_name: {
                required: "Please enter the mold name."
            },
            ownership: {
                required: "Please select ownership."
            },
            no_of_cavity: {
                required: "Please enter the number of cavities.",
                number: "Please enter a valid number."
            },
            target_life: {
                required: "Please enter the mold PM frequency.",
                number: "Please enter a valid number."
            },
            target_over_life: {
                required: "Please enter the mold life over frequency.",
                number: "Please enter a valid number."
            }
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
                    alert("There was an error adding the Mold Maintenance. Please try again.");
                }
            });
            return false; // Prevent default form submission
        }
    });



    // Custom search filter event
  
   



});
