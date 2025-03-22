var table = '';
var file_name = "erp_users";
var pdf_title = "ERP Users";
var accessGroupsModel = new bootstrap.Modal(document.getElementById('accessGroups'))
$(document).ready(function() {
    $(".edit-role").on("click",function(){
        $(".select2-multiple").select2()
    })

    
    $("#addTransporterForm").validate({
        rules: {
            user_name: {
                required: true,
                minlength: 3
            },
            user_email: {
                required: true,
                email: true
            },
            user_password: {
                required: true,
                minlength: 6
            },
            user_role: {
                required: true
            },
            'client[]':{
                 required: true
            },
            'groups[]':{
                 required: true
            }
        },
        messages: {
            user_name: {
                required: "Please enter the user full name",
                minlength: "The name must be at least 3 characters long"
            },
            user_email: {
                required: "Please enter the user email",
                email: "Please enter a valid email address"
            },
            user_password: {
                required: "Please enter the password",
                minlength: "The password must be at least 6 characters long"
            },
            user_role: {
                required: "Please select a role"
            },
            'client[]': {
                required: "Please select unit"
            },
            'groups[]': {
                required: "Please select groups"
            }
        },
        errorPlacement: function(error, element){
            if(element.context.type == 'checkbox'){
                $(element).parents(".form-group").find(".row").after(error)
            }else{
                error.insertAfter(element); 
            }
        },
        submitHandler: function(form) {
            // Perform AJAX form submission
            $.ajax({
                url: $(form).attr('action'),
                type: 'POST',
                data: $(form).serialize(),
                success: function(response) {
                    // Handle successful response
                    if(response != '' && response != null && typeof response != 'undefined'){
                        let res = JSON.parse(response);
                        if(res['success'] == 1){
                            toastr.success(res['msg']);
                            setTimeout(() => {
                                $('#addPromo').modal('hide');
                                // Optionally, refresh the table or perform other actions
                                window.location.reload();
                            }, 1000);
                        }else{
                            toastr.error(res['msg']);
                        }
                    }
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.error('Form submission failed:', error);
                }
            });
        }
    });

    $(".update_users_data").submit(function(e){
        e.preventDefault();
        var href = $(this).attr("action");
        var id = $(this).attr("id");
        let flag = formValidate(id);

        if(flag){
          return;
        }
        
        var formData = new FormData($('.'+id)[0]);

        $.ajax({
          type: "POST",
          url: href,
          data: formData,
          processData: false,
          contentType: false,
          success: function (response) {
            var responseObject = JSON.parse(response);
            var msg = responseObject.messages;
            var success = responseObject.success;
            if (success == 1) {
              toastr.success(msg);
              $(this).parents(".modal").modal("hide")
              setTimeout(function(){
                window.location.reload();
              },1000);

            } else {
              toastr.error(msg);
            }
          },
          error: function (error) {
            console.error("Error:", error);
          },
        });
      });
    function formValidate(form_class = ''){
        let flag = false;
        $(".custom-form."+form_class+" .required-input").each(function( index ) {
          var value = $(this).val();
          var dataMax = parseFloat($(this).attr('data-max'));
          var dataMin = parseFloat($(this).attr('data-min'));
          if(value == '' || value == null ){
            flag = true;
            var label = $(this).parents(".form-group").find("label").contents().filter(function() {
              return this.nodeType === 3; // Filter out non-text nodes (nodeType 3 is Text node)
            }).text().trim();
            var exit_ele = $(this).parents(".form-group").find("label.error");
            if(exit_ele.length == 0){
              var start ="Please enter ";
              if($(this).prop("localName") == "select"){
                var start ="Please select ";
              }
              label = ((label.toLowerCase()).replace("enter", "")).replace("select", "");
              var validation_message = start+(label.toLowerCase()).replace(/[^\w\s*]/gi, '');
              var label_html = "<label class='error'>"+validation_message+"</label>";
              $(this).parents(".form-group").append(label_html)
            }
          }
          else if(dataMin !== undefined && dataMin > value){
            flag = true;
            var label = $(this).parents(".form-group").find("label").contents().filter(function() {
              return this.nodeType === 3; // Filter out non-text nodes (nodeType 3 is Text node)
            }).text().trim();
            var exit_ele = $(this).parents(".form-group").find("label.error");
            if(exit_ele.length == 0){
              var end =" must be greater than or equal to "+dataMin;
              label = ((label.toLowerCase()).replace("enter", "")).replace("select", "");
              label = (label.toLowerCase()).replace(/[^\w\s*]/gi, '');
              label = label.charAt(0).toUpperCase() + label.slice(1);
              var validation_message =label +end;
              var label_html = "<label class='error'>"+validation_message+"</label>";
              $(this).parents(".form-group").append(label_html)
            }
            }else if(dataMax !== undefined && dataMax < value){
              flag = true;
              var label = $(this).parents(".form-group").find("label").contents().filter(function() {
                return this.nodeType === 3; // Filter out non-text nodes (nodeType 3 is Text node)
              }).text().trim();
              var exit_ele = $(this).parents(".form-group").find("label.error");
              if(exit_ele.length == 0){
                var end =" must be less than or equal to "+dataMax;
                label = ((label.toLowerCase()).replace("enter", "")).replace("select", "");
                label = (label.toLowerCase()).replace(/[^\w\s*]/gi, '');
                label = label.charAt(0).toUpperCase() + label.slice(1)
                var validation_message =label +end;
                var label_html = "<label class='error'>"+validation_message+"</label>";
                $(this).parents(".form-group").append(label_html)
              }
          }
        });
       

        
         const clients = $('.custom-form.'+form_class+' input[name="client[]"]:checked').map(function() {
                    return $(this).val();
                }).get();
        if(clients.length == 0){
            flag = true;
            var exit_ele = $(".custom-form."+form_class+" .unit-box label.error");
            if(exit_ele.length == 0){
                $(".custom-form."+form_class+" .unit-box .row").after("<label class='error'>Please select unit</label>");
            }
        }else{
            $(".custom-form."+form_class+" .unit-box label.error").remove();
        }

        return flag;
    }

    
    $(".page-access-btn").on("click",function(){
        var groups = $(this).parents("form").find(".select2-multiple").val();
        groups = groups != null && groups != undefined ? groups : [];
        
        if(groups.length > 0){
            accessGroupsModel.show();
            $(".modal-backdrop").eq(1).css("z-index",'1090');
            $("#accessGroups").css("z-index",'1091');
            $.ajax({
                url: base_url+'welcome/get_access_page',
                type: 'POST',
                data: {groups:groups},
                success: function(response) {
                    if (response) {
                        let res = JSON.parse(response);
                        $("#accessGroups .modal-body .row").html(res.access_html)
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('An error occurred: ' + errorThrown);
                }
            });
        }else{
             toastr.error("Please select groups");
        }
    })


    // Initialize the DataTable
    table = $("#erp_users").DataTable({
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
        // columnDefs: [{ sortable: false, targets: 7 }],
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

    $(".page-access-btn").on("click",function(){
        // $(this).
    })
    // Custom search filter event
  
   setTimeout(function(){
    $(".select2-multiple").select2()
   },1000)
    


});
