$(document).ready(function() {
    page.init();
});

var table = '';
var file_name = "sharing_issue_request_store";
var pdf_title = "Sharing Issue Request - Pending";

const page = {
    init: function() {
        this.dataTable();
        this.initiateValidate();
        this.filter();
    },
    dataTable: function() {
        var data = {};
        table = $("#inwarding").DataTable({
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
         fixedHeader: false,
        searching: true,
        scrollX: true,
        scrollY: true,
        bScrollCollapse: true,
        // columnDefs: [{ sortable: false, targets: 7 }],
        pagingType: "full_numbers",
        fixedColumns: {
                leftColumns: 2,
                // end: 1
            },
       
        
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
        $(document).on("click","[data-bs-toggle='modal']",function(){
          var id = $(this).attr("data-bs-target");
          $(`${id}`).find("select").chosen({
            width: "auto",
            // disable_search_threshold: 10, // You can adjust this threshold for no search bar
            dropdownAutoWidth: true
        });
          $.extend($.fn.chosen.amd.require, {
            'chosen/search': function () {
                return function (query, options) {
                    var matchedOptions = [];
                    var queryLower = query.toLowerCase(); // Convert search query to lowercase

                    // Use a regular expression to search for the query anywhere in the text
                    var searchRegex = new RegExp(queryLower, "i"); // 'i' for case-insensitive matching

                    // Iterate over all options and check if the query matches any part of the option's text
                    options.each(function() {
                        var text = $(this).text().toLowerCase(); // Convert option text to lowercase

                        // If the query is found anywhere in the option text, add it to the matches
                        if (searchRegex.test(text)) {
                            matchedOptions.push(this);
                        }
                    });

                    return matchedOptions; // Return all matched options
                };
            }
        });
        })

            // table = $('#example1').DataTable();
      },
      initiateValidate: function(){
        let that = this;
        $(document).on("submit",".update_production_qty",function(e){
        e.preventDefault();
        let id = $(this).attr("id");
        let flag = that.formValidate(id);
        let href = $(this).attr("action");
       
        if(flag){
          return;
        }
        var formData = new FormData($('#'+id)[0]);
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
      $(document).on("submit",".transfer_child_part_to_fg_stock_inhouse",function(e){
        e.preventDefault();
        let id = $(this).attr("id");
        let flag = that.formValidate(id);
        let href = $(this).attr("action");
        console.log(flag)
        if(flag){
          return;
        }
        var formData = new FormData($('#'+id)[0]);
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
    },
    filter: function(){
          let that = this;
          $(".search-filter").on("click",function(){
              that.serachParams();
              $(".close-filter-btn").trigger( "click" )
          })
          $(".reset-filter").on("click",function(){
              that.resetFilter();
          })
      },
      serachParams: function(){
          var search_part_name = $("#search_part_name").val();
          table.column(0).search(search_part_name).draw();
          // var admin_approve_search = $("#admin_approve_search").val();
          // table.column(0).search(supplier_search).draw(); 
      },
      resetFilter: function(){
          $("#search_part_name").val('').trigger('change');
          // $("#admin_approve_search").val('').trigger('change');
          this.serachParams();
      }
};



