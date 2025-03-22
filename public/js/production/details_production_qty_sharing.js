$(document).ready(function() {
    page.init();
});

var table = '';
var file_name = "sharing_issue_request";
var pdf_title = "Sharing Issue Request";

const page = {
    init: function() {
        this.inititateForm();
    },
    inititateForm: function(){
    	let that = this;
        $("#add_sharing_p_q_history").submit(function(e){
	      e.preventDefault();
	      let flag = that.formValidate("add_sharing_p_q_history");
	      let href = $(this).attr("action");
	      // console.log(flag);
	      if(flag){
	        return;
	      }
	    	
	    	// return;
	      var formData = new FormData($('.add_sharing_p_q_history')[0]);

	      $.ajax({
	        type: "POST",
	        url: href,
	        // url: "add_invoice_number",
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
	    $(".update_p_q_sharing").submit(function(e){
	      e.preventDefault();
	      let id = $(this).attr("id");
	      let flag = that.formValidate(id);
	      let href = $(this).attr("action");
	      
	      if(flag){
	        return;
	      }
	    console.log(id)
	    	
	      var formData = new FormData($("#"+id)[0]);

	      $.ajax({
	        type: "POST",
	        url: href,
	        // url: "add_invoice_number",
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
	    $(".update_p_q_onhold_sharing").submit(function(e){
	      e.preventDefault();
	      let id = $(this).attr("id");
	      let flag = that.formValidate(id);
	      let href = $(this).attr("action");
	      
	      if(flag){
	        return;
	      }
	      var formData = new FormData($("#"+id)[0]);

	      $.ajax({
	        type: "POST",
	        url: href,
	        // url: "add_invoice_number",
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
    },
    formValidate: function(form_class = ''){
        let flag = false;
        $(".custom-form."+form_class+" .required-input").each(function( index ) {
          var value = $(this).val();
          var dataMax = parseInt($(this).attr('data-max'));
          var dataMin = parseInt($(this).attr('data-min'));
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
          else if(dataMin !== undefined && dataMin > value){
            flag = true;
            var label = $(this).parents(".form-group").find("label").contents().filter(function() {
              return this.nodeType === 3; // Filter out non-text nodes (nodeType 3 is Text node)
            }).text().trim();
            var exit_ele = $(this).parents(".form-group").find("label.error");
            if(exit_ele.length == 0){
              var end =" must be greater than or equal "+dataMin;
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
                var end =" must be less than or equal "+dataMax;
                label = ((label.toLowerCase()).replace("enter", "")).replace("select", "");
                label = (label.toLowerCase()).replace(/[^\w\s*]/gi, '');
                label = label.charAt(0).toUpperCase() + label.slice(1)
                var validation_message =label +end;
                var label_html = "<label class='error'>"+validation_message+"</label>";
                $(this).parents(".form-group").append(label_html)
              }
          }
        });
       
        return flag;
    }
};
