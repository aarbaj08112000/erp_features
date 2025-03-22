var file_name = "customer_part";
var pdf_title = "Customer Part";
var table = '';
const datatable = {
    init:function(){
        let that = this;
        this.inititeForm();
        that.dataTable();
        $(document).on('click','.search-filter',function(e){
            let customer_name = $("#customer_name").val();
            table.column(2).search(customer_name).draw();
        })
        $(document).on('click','.reset-filter',function(e){
           that.resetFilter();
        })
        $(document).on("click",".edit-part",function(){
            var data = $(this).attr("data-value");
            data = JSON.parse(atob(data)); 
        })
    },
    dataTable:function(){
      table =  new DataTable('#example1',{
        dom: 'Bfrtip',
        scrollX: true, 
        
        buttons: [
                {     
                    extend: 'csv',
                        text: '<i class="ti ti-file-type-csv"></i>',
                        init: function(api, node, config) {
                        $(node).attr('title', 'Download CSV');
                        },
                        customize: function (csv) {
                            var lines = csv.split('\n');
                            var modifiedLines = lines.map(function(line) {
                                var values = line.split(',');
                                values.splice(13, 2);
                                values.splice(0, 1);
                                return values.join(',');
                            });
                            return modifiedLines.join('\n');
                        },
                        filename : file_name
                    },
                
                    {
                    extend: 'pdf',
                    text: '<i class="ti ti-file-type-pdf"></i>',
                    init: function(api, node, config) {
                        $(node).attr('title', 'Download Pdf');
                        
                    },
                    filename: file_name,
                    
                    customize: function (doc) {
                        doc.pageMargins = [15, 15, 15, 15];
                        doc.content[0].text = pdf_title;
                        doc.content[0].color = theme_color;
                        doc.content[1].table.widths = ['12%', '8%', '8%', '8%','8%', '8%', '8%','8%', '8%', '8%','8%', '8%', '8%'];
                        doc.content[1].table.body[0].forEach(function(cell) {
                            cell.fillColor = theme_color;
                        });
                        doc.content[1].table.body.forEach(function(row, rowIndex) {
                            row.forEach(function(cell, cellIndex) {
                                var alignmentClass = $('#example1 tbody tr:eq(' + rowIndex + ') td:eq(' + cellIndex + ')').attr('class');
                                var alignment = '';
                                if (alignmentClass && alignmentClass.includes('dt-left')) {
                                    alignment = 'left';
                                } else if (alignmentClass && alignmentClass.includes('dt-center')) {
                                    alignment = 'center';
                                } else if (alignmentClass && alignmentClass.includes('dt-right')) {
                                    alignment = 'right';
                                } else {
                                    alignment = 'left';
                                }
                                cell.alignment = alignment;
                            });
                            row.splice(13, 2);
                                row.splice(0, 1);
                        });
                    }
                },
            ],
    });
    },
    inititeForm: function(){
        let that = this;
        $(".add_inspection_parm_details,.update_inspection_parm_details").submit(function(e){
            e.preventDefault();
            var href = $(this).attr("action");
            var id = $(this).attr("id");
            let flag = that.formValidate(id);
            console.log(flag,id)
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
        $(".delete_row").submit(function(e){
            e.preventDefault();
            var href = $(this).attr("action");
            var id = $(this).attr("id");
            
            var formData = new FormData($('.'+id)[0]);

            $.ajax({
              type: "POST",
              url: href,
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
    },
    formValidate: function(form_class = ''){
        let flag = false;
        $(".custom-form."+form_class+" .required-input").each(function( index ) {
          var value = $(this).val();
          var dataMax = parseFloat($(this).attr('data-max'));
          var dataMin = parseFloat($(this).attr('data-min'));
          if(value == '' || value == null){
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
    },
    resetFilter:function(){
        table.column(2).search('').draw();
    }

}

$(document).ready(function () {
    datatable.init();    
})