$( document ).ready(function() {
    page.init();
  });
  var table = '';
  var file_name = "grn_qty_validation_part";
  var pdf_title = "GRN QTY Validation Parts";
  const page = {
    init: function(){
      this.initiateForm();
    //   this.dataTable();
    },
    initiateForm: function(){
      let that = this;
  
      $(".add_challan_parts_subcon").submit(function(e){
        e.preventDefault();
        let flag = that.formValidate("add_challan_parts_subcon");
        if(flag){
          return;
        }
        var formData = new FormData($('.add_challan_parts_subcon')[0]);
  
        $.ajax({
          type: "POST",
          url: base_url+"add_challan_parts_subcon",
          // url: "add_rejection_flow",
          data: formData,
          processData: false,
          contentType: false,
          success: function (response) {
            var responseObject = JSON.parse(response);
            var msg = responseObject.message;
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
      $(".update_challan_parts_subcon").submit(function(e){
        e.preventDefault();
        var data_id =  $(this).attr("data-id");
        let flag = that.formValidate("update_challan_parts_subcon_"+data_id);
        if(flag){
          return;
        }
        var formData = new FormData($('.update_challan_parts_subcon_'+data_id)[0]);
        $.ajax({
          type: "POST",
          url: base_url+"update_challan_parts_subcon",
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
      $(".delete_item").submit(function(e){
        e.preventDefault();
        var formData = new FormData($('.delete_item')[0]);
        $.ajax({
          type: "POST",
          url: base_url+"delete",
          data: formData,
          processData: false,
          contentType: false,
          success: function (response) {
            var responseObject = JSON.parse(response);
            var msg = responseObject.message;
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
      $(".change_challan_status_subcon_form").submit(function(e){
        e.preventDefault();
        var formData = new FormData($('.change_challan_status_subcon_form')[0]);
        $.ajax({
          type: "POST",
          url: base_url+"change_challan_status_subcon",
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
        $(".custom-form."+form_class+" input.required-input").each(function( index ) {
          var value = $(this).val();
          var dataMax = $(this).attr('data-max');
          var dataMin = $(this).attr('data-min');
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
          }else if(dataMax !== undefined && dataMax < value){
              flag = true;
              var label = $(this).parents(".form-group").find("label").contents().filter(function() {
                return this.nodeType === 3; // Filter out non-text nodes (nodeType 3 is Text node)
              }).text().trim();
              var exit_ele = $(this).parents(".form-group").find("label.error");
              if(exit_ele.length == 0){
                var end =" must be less than or equal "+dataMax;
                label = ((label.toLowerCase()).replace("enter", "")).replace("select", "");
                label = (label.toLowerCase()).replace(/[^\w\s*]/gi, '').toUpperCase();
                var validation_message =label +end;
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
              label = (label.toLowerCase()).replace(/[^\w\s*]/gi, '').toUpperCase();
              var validation_message =label +end;
              var label_html = "<label class='error'>"+validation_message+"</label>";
              $(this).parents(".form-group").append(label_html)
            }
        }
        });
        return flag;
      }
  }
  