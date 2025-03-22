$( document ).ready(function() {
  page.init();
  
});
var table = '';
var file_name = "inwarding_invoice";
var pdf_title = "inwarding_invoice";
const page = {
  init: function(){
    this.initiateForm();
    this.dataTable();
    $("#customer_id_box").on("change",function(){
    		var customer_id = $(this).val();
    		if(customer_id > 0){
	    		$.ajax({
	                url: base_url+'ChallanController/get_customer_challan_part',
	                type: "POST",
	                data: {customer_id:customer_id},
	                cache: false,
	                beforeSend: function() {},
	                success: function(response) {
	                	response =  JSON.parse(response)
	                	
	                	$("#part_data tbody").html(response.html)
	                	// console.log(response)
	                   
	                }
	            })
	    	}
    	})
    	$(document).on("input",".part_qty_input",function(){
    		var max_val = $(this).attr("data-value");
    		var value = $(this).val();
    		console.log(value,max_val)
    		if(parseFloat(value) > parseFloat(max_val)){
    			value = max_val;
    			$(this).val(value);
    		}
    	})
    	$(document).on('keypress,change','.onlyNumericInput', function(event) {
        alert("ok")
	        var charCode = (event.which) ? event.which : event.keyCode;
	        // Allow only digits (0-9) and some specific control keys
	        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
	            event.preventDefault();
	        }
	    });
  },
  dataTable: function() {
      // table = $('#view_add_challan').DataTable();
      var data = {};
      table = $("#challan_inward").DataTable({
      dom: "Bfrtilp",
	      searching: true,
	      // scrollX: true,
	      scrollY: '200px',
	      bScrollCollapse: true,
	      columnDefs: [{ sortable: false, targets: 6 }],
	      pagingType: "full_numbers",
	      order: [[0, 'desc']],
	      
	  });
      $('.dataTables_length').find('label').contents().filter(function() {
          return this.nodeType === 3; // Filter out text nodes
      }).remove();
      setTimeout(function(){
        $(".dataTables_length select").select2({
            minimumResultsForSearch: Infinity
        });
      },1000)
      $('#serarch-filter-input').on('keyup', function() {
            table.search(this.value).draw();
        });
      // table = $('#example1').DataTable();

  },
  initiateForm: function(){
    let that = this;
    $(".generate_customer_challan_return_part").submit(function(e){
        e.preventDefault();
        var href = $(this).attr("action");
        var id = $(this).attr("id");
        let flag = that.formValidate(id);

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
