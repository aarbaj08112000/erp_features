$( document ).ready(function() {
    page.init();
});
const page = {
    init: function(){
        this.formValidation();
        this.initiateForm();
        let action_btn = $(".action-block").find("button[data-bs-toggle='modal']");
        console.log(action_btn)
        if(action_btn.length == 0){
            $(".action-block").remove()
            let action_card = $(".action-block-main").find(".card-header");
            if(action_card.length == 0){
                $(".action-block-main").remove()
            }
        }
    },
    formValidation: function(){
        let that = this;
        $("#add_po_parts").validate({
            rules: {
                part_id: {
                    required: true
                },
                qty: {
                    required: true
                },
                // expiry_po_date: {
                //     required: true
                // },
            },
            messages: {
                part_id: "Please select Part Number",
                qty: "Please enter Qty",
                // expiry_po_date: "Please select Expiry Date",
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
                url: base_url+"add_po_parts",
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
                        window.location.reload();
                    }, 2000);
                  }else{
                    toastr.error(data.message);
                  }

                }
              });
            }
        }); 
    },
    initiateForm: function(){
    	let that = this;
        $("#accept_po_form").submit(function(e){
            e.preventDefault(); // Prevent form submission
                // var formData = $(this).serialize();
                var formData = new FormData($('#accept_po_form')[0]);
                $("#accept").modal("hide")
                $.ajax({
                    type: "POST",
                    url: base_url+"accept_po",
                    data: formData,
                     processData: false, // Important: Don't process the data
                    contentType: false, // Important: Set contentType to false
                    success: function (response) {
                        var responseObject = JSON.parse(response);
                        var msg = responseObject.message;
                        var success = responseObject.success;
                        if (success == 1) {
                            toastr.success(msg);
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
        $("#lock_po_form").submit(function(e){
            e.preventDefault(); // Prevent form submission
                // var formData = $(this).serialize();
                var formData = new FormData($('#lock_po_form')[0]);
                $("#lock").modal("hide")
                $.ajax({
                    type: "POST",
                    url: base_url+"accept_po",
                    data: formData,
                     processData: false, // Important: Don't process the data
                    contentType: false, // Important: Set contentType to false
                    success: function (response) {
                        var responseObject = JSON.parse(response);
                        var msg = responseObject.message;
                        var success = responseObject.success;
                        if (success == 1) {
                            toastr.success(msg);
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
        $(".update_po_parts").submit(function(e){
            e.preventDefault(); // Prevent form submission
                // var formData = $(this).serialize();
                var id = $(this).attr("data-id");
                let flag = that.formValidate("update_po_parts"+id);
                if(flag){
                	return;
                }

                var formData = new FormData($('.update_po_parts'+id)[0]);
                $(this).parents(".modal").modal("hide")
                $.ajax({
                    type: "POST",
                    url: base_url+"update_po_parts",
                    data: formData,
                     processData: false, // Important: Don't process the data
                    contentType: false, // Important: Set contentType to false
                    success: function (response) {
                        var responseObject = JSON.parse(response);
                        var msg = responseObject.message;
                        var success = responseObject.success;
                        if (success == 1) {
                            toastr.success(msg);
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
        $(".delete_po_parts").submit(function(e){
            e.preventDefault(); // Prevent form submission
                // var formData = $(this).serialize();
                var formData = new FormData($('.delete_po_parts')[0]);
                $(this).parents(".modal").modal("hide")
                $.ajax({
                    type: "POST",
                    url: base_url+"delete",
                    data: formData,
                     processData: false, // Important: Don't process the data
                    contentType: false, // Important: Set contentType to false
                    success: function (response) {
                        var responseObject = JSON.parse(response);
                        var msg = responseObject.message;
                        var success = responseObject.success;
                        if (success == 1) {
                            toastr.success(msg);
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
        $(".update_po_parts_amendment").submit(function(e){
            e.preventDefault(); // Prevent form submission
                // var formData = $(this).serialize();
                var id = $(this).attr("data-id");
                let flag = that.formValidate("update_po_parts_amendment"+id);
                if(flag){
                	return;
                }
                var formData = new FormData($('.update_po_parts_amendment'+id)[0]);
                $(this).parents(".modal").modal("hide")
                $.ajax({
                    type: "POST",
                    url: base_url+"update_po_parts_amendment",
                    data: formData,
                     processData: false, // Important: Don't process the data
                    contentType: false, // Important: Set contentType to false
                    success: function (response) {
                        var responseObject = JSON.parse(response);
                        var msg = responseObject.message;
                        var success = responseObject.success;
                        if (success == 1) {
                            toastr.success(msg);
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
        $(".update_po_parts_amendment_approve").submit(function(e){
            e.preventDefault(); // Prevent form submission
                // var formData = $(this).serialize();
                var id = $(this).attr("data-id")
                let flag = that.formValidate("update_po_parts_amendment_approve"+id);
                if(flag){
                	return;
                }
                var formData = new FormData($('.update_po_parts_amendment_approve'+id)[0]);
                $(this).parents(".modal").modal("hide")
                $.ajax({
                    type: "POST",
                    url: base_url+"update_po_parts_amendment_approve",
                    data: formData,
                     processData: false, // Important: Don't process the data
                    contentType: false, // Important: Set contentType to false
                    success: function (response) {
                        var responseObject = JSON.parse(response);
                        var msg = responseObject.message;
                        var success = responseObject.success;
                        if (success == 1) {
                            toastr.success(msg);
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
    },
    formValidate: function(form_class = ''){
    	let flag = false;
    	$(".custom-form."+form_class+" .required-input").each(function( index ) {
		  var value = $(this).val();
		  if(value == ''){
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
		});
		return flag;
    }
}

