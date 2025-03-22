$(document).ready(function() {
    page.init();
});

var table = '';
var file_name = "view_supplier_challan_list";
var pdf_title = "Supplier Challan List";

const page = {
    init: function() {
        this.dataTable();
        this.initiateForm();
    },
    dataTable: function() {
        // table = $('#view_supplier_challan').DataTable();
    },
    initiateForm: function(){
        let that = this;
        $(".add_grn_qty_subcon_view").submit(function(e){
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
        $(".add_grn_qty_form").submit(function(e){
          e.preventDefault();
          var data_id = $(this).attr("data-id");
          let flag = that.formValidate("add_grn_qty_form_"+data_id);
          if(flag){
            return;
          }
          var formData = new FormData($('.add_grn_qty_form_'+data_id)[0]);
    
          $.ajax({
            type: "POST",
            url: base_url+"add_grn_qty",
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
        $(".edit_grn_qty_form").submit(function(e){
            e.preventDefault();
            var data_id = $(this).attr("data-id");
            let flag = that.formValidate("edit_grn_qty_form_"+data_id);
            if(flag){
              return;
            }
            var formData = new FormData($('.edit_grn_qty_form_'+data_id)[0]);
      
            $.ajax({
              type: "POST",
              url: base_url+"edit_grn_qty",
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
          $(".validate_invoice_amount").submit(function(e){
            e.preventDefault();
            var data_id = $(this).attr("data-id");
            let flag = that.formValidate("validate_invoice_amount");
            if(flag){
              return;
            }
            var formData = new FormData($('.validate_invoice_amount')[0]);
      
            $.ajax({
              type: "POST",
              url: base_url+"validate_invoice_amount",
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
          $(".generate_grn").submit(function(e){
            e.preventDefault();
            var formData = new FormData($('.generate_grn')[0]);
      
            $.ajax({
              type: "POST",
              url: base_url+"generate_grn",
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
          console.log(dataMin)
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
};
