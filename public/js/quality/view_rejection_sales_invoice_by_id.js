$(document).ready(function() {
    page.init();
});

var table = '';
var file_name = "view_rejection_sales_invoice_by_id";
var pdf_title = "view_rejection_sales_invoice_by_id";

const page = {
    init: function() {
        this.dataTable();
    },
    dataTable: function() {
    	let that = this;
    	$('.edit_part').on('submit', function(event) {
		       event.preventDefault(); // Prevent the form from submitting via the browser
		       var form = $(this);
		       var formData = form.serialize();
		   
		       $.ajax({
		           type: 'POST',
		           url: form.attr('action'),
		           data: formData,
		           success: function(response) {
		               // Handle success
		               let res = JSON.parse(response);
	                   if (res.success == 1) {
	                       toastr.success(res.messages)
	                       setTimeout(() => {
			                   window.location.reload();
			               }, 1000);
	                   } else {
	                       toastr.error(res.messages);
	                       
	                   }
		               
		           },
		           error: function(xhr, status, error) {
		               // Handle error
		               toastr.success('unable to delete part.')
		           }
		       });
	    });
	    $('.delete_part').on('submit', function(event) {
		       event.preventDefault(); // Prevent the form from submitting via the browser
		       var form = $(this);
		       var formData = form.serialize();
		   
		       $.ajax({
		           type: 'POST',
		           url: form.attr('action'),
		           data: formData,
		           success: function(response) {
		               // Handle success
		               let res = JSON.parse(response);
	                   if (res.success == 1) {
	                       toastr.success(res.message)
	                       setTimeout(() => {
			                   window.location.reload();
			               }, 1000);
	                   } else {
	                       toastr.error(res.message);
	                       
	                   }
		               
		           },
		           error: function(xhr, status, error) {
		               // Handle error
		               toastr.success('unable to delete part.')
		           }
		       });
	    });
	    $('.update_accept_parts_rejection_sales_invoice').on('submit', function(event) {
		       event.preventDefault(); // Prevent the form from submitting via the browser
		       var form = $(this);
		       var formData = form.serialize();
		   
		       $.ajax({
		           type: 'POST',
		           url: form.attr('action'),
		           data: formData,
		           success: function(response) {
		               // Handle success
		               let res = JSON.parse(response);
	                   if (res.success == 1) {
	                       toastr.success(res.messages)
	                       setTimeout(() => {
			                   window.location.reload();
			               }, 1000);
	                   } else {
	                       toastr.error(res.messages);
	                       
	                   }
		               
		           },
		           error: function(xhr, status, error) {
		               // Handle error
		               toastr.success('unable to delete part.')
		           }
		       });
	    });
	    $('.update_rejection_sales_invoice,.lock_parts_rejection_sales_invoice').on('submit', function(event) {
		       event.preventDefault(); // Prevent the form from submitting via the browser
		       var form = $(this);
		       var form_class = $(this).attr("id");
		       var formData = form.serialize();
		       let flag = that.formValidate(form_class);
		     
  		       if(flag){
                 return;
  			   };
		   
		       $.ajax({
		           type: 'POST',
		           url: form.attr('action'),
		           data: formData,
		           success: function(response) {
		               // Handle success
		               let res = JSON.parse(response);
	                   if (res.success == 1) {
	                       toastr.success(res.messages)
	                       setTimeout(() => {
			                   window.location.reload();
			               }, 1000);
	                   } else {
	                       toastr.error(res.messages);
	                       
	                   }
		               
		           },
		           error: function(xhr, status, error) {
		               // Handle error
		               toastr.success('unable to delete part.')
		           }
		       });
	    });
	    $('.add_parts_rejection_sales_invoice').on('submit', function(event) {
		       event.preventDefault(); // Prevent the form from submitting via the browser
		       var form = $(this);
		       var formData = form.serialize();
		   
		       $.ajax({
		           type: 'POST',
		           url: form.attr('action'),
		           data: formData,
		           success: function(response) {
		               // Handle success
		               let res = JSON.parse(response);
	                   if (res.success == 1) {
	                       toastr.success(res.messages)
	                       setTimeout(() => {
			                   window.location.reload();
			               }, 1000);
	                   } else {
	                       toastr.error(res.messages);
	                       
	                   }
		               
		           },
		           error: function(xhr, status, error) {
		               // Handle error
		               toastr.success('unable to delete part.')
		           }
		       });
	    });
	},
	formValidate: function(form_class = ''){
        let flag = false;
        $(".custom-form."+form_class+" .required-input").each(function( index ) {
          var value = $(this).val();
          var dataMax = parseFloat($(this).attr('data-max'));
          var dataMin = parseFloat($(this).attr('data-min'));
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
       
        return flag;
    }
}
