$( document ).ready(function() {
    page.init();
});
const page = {
    init: function(){
        this.formValidation();
        $("#form_type").on("change",function(){
            var value = $(this).val();
            if(value != "CreditNote"){
                $("#mode").parents(".form-group").find("label span").remove();
                $("#mode").prop('required',false);
                $("#transporter").parents(".form-group").find("label span").remove();
                $("#transporter").prop('required',false);
                $("#vehicle_number").parents(".form-group").find("label span").remove();
                $("#vehicle_number").prop('required',false);
                $("#vehicle_number").removeAttr("oninvalid");
                $("#vehicle_number").removeAttr("onchange");
                
            }else{
                $("#mode").parents(".form-group").find("label").append("<span class='text-danger'>*</span>");
                $("#mode").prop('required',true);
                $("#transporter").parents(".form-group").find("label").append("<span class='text-danger'>*</span>");
                $("#transporter").prop('required',true)
                $("#vehicle_number").parents(".form-group").find("label").append("<span class='text-danger'>*</span>");
                $("#vehicle_number").prop('required',true) 
                $("#vehicle_number").attr("oninvalid","this.setCustomValidity('Please enter a valid vehicle number in the format XX00XX0000')");
                $("#vehicle_number").attr("onchange","this.setCustomValidity('')");
            }
        })

        this.initiateDataTable();

    },
    formValidation: function(){
        let that = this;
        $("#creditNoteForm").validate({
            rules: {
                customer_id: {
                    required: true
                },
                // customer_debit_note_no: {
                //     required: true
                // },
                // customer_debit_note_date: {
                //     required: true
                // },
                form_type: {
                    required: true
                },
                mode: {
                    required: function(element) {
                    	let form_type = $("#form_type").val();
                    	let validate = false;
                    	if(form_type == "CreditNote" ){
                    		validate = true;
                    	}
				        return validate;
				    }
                },
                transporter: {
                    required: function(element) {
                    	let form_type = $("#form_type").val();
                    	let validate = false;
                    	if(form_type == "CreditNote"){
                    		validate = true;
                    	}
				        return validate;
				    }
                },
                vehicle_number: {
                    required: function(element) {
                    	let form_type = $("#form_type").val();
                    	let validate = false;
                    	if(form_type == "CreditNote"){
                    		validate = true;
                    	}
				        return validate;
				    }
				    
                }
            },
            messages: {
                supplier_id: "Please select Customer",
                customer_debit_note_no: "Please enter Customer Debit Note No",
                customer_debit_note_date: "Please select Customer Debit Note Date",
                form_type: "Please select Invoice Type",
                mode: "Please select Mode Of Transport",
                transporter: {
                    required: "Please select Transporter"
                },
                vehicle_number: {
                    required: "Please enter Vehicle No.",
                }
            },
            errorPlacement: function(error, element)
            {
              	if(element.prop('tagName') == 'SELECT'){
                    $(element).parents(".form-group").find(".select2-container").after(error)
                }else{
                    error.insertAfter(element); 
                }
            },
            submitHandler: function(form,e) {
            	e.preventDefault();
              var formdata = new FormData(form);
              $.ajax({
                url: base_url+"generate_rejection_sales_invoice",
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
                        window.location.href = data.redirect_url;
                    }, 2000);
                  }else{
                    toastr.error(data.messages);
                  }

                }
              });
            }
        }); 
    },
    initiateDataTable: function() {
        var data = {};
        table = $("#rejection_invoices_table").DataTable({
        dom: "Bfrtilp",
       
        searching: true,
        // scrollX: true,
        scrollY: true,
        bScrollCollapse: true,
        columnDefs: [{ sortable: false, targets: 13 }],
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

        // global searching for datable 
        $('#serarch-filter-input').on('keyup', function() {
            table.search(this.value).draw();
        });
            // table = $('#example1').DataTable();
      }
}

