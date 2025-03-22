

$(document).ready(function() {
    page.init();
});

var table = '';
var file_name = "accept_reject_validation";
var pdf_title = "accept_reject_validation";

const page = {
    init: function() {
      
        this.dataTable();
        this.filter();
        this.formValidation();
        $("#AddProdButton").click(function() {
          $.ajax({
              url: url,
              type: "POST",
              data: {},
              cache: false,
              beforeSend: function() {},
              success: function(response) {
                 if (response) {
                          $('#addPromo .modal-content').html(response);
                          $('#addPromo').modal('show');
                      } else {
                          $('#addPromo .modal-content').html('<p>No data found.</p>');
                          $('#addPromo').modal('show');
                      }
              }
          });
      });
      $('#date_range_filter').daterangepicker({
            singleDatePicker: false,
            showDropdowns: true,
            autoApply: true,
            locale: {
                format: 'YYYY/MM/DD' // Change this format as per your requirement
            }
        });

        dateRangePicker = $('#date_range_filter').data('daterangepicker');
        dateRangePicker.setStartDate(start_date);
        dateRangePicker.setEndDate(end_date);


        $(".accepted_qty").on("keyup",function(){
          var parent_el = $(this).parents(".update_p_q");
          var required_qty = parseFloat($(parent_el).find(".qty_required").val());
          var accepted_qty = parseFloat($(this).val());
          var onhold_qty = required_qty - accepted_qty;
          $(parent_el).find(".onhold_qty").attr("data-max",onhold_qty);
          console.log(required_qty,accepted_qty);
        })
    },
    dataTable: function() {
        var data = {};
        table = $("#molding_production").DataTable({
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
                            values.splice(8, 1);
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
                        row.splice(8, 1);
                        row.forEach(function (cell) {
                            // Set alignment for each cell
                            cell.alignment = "center"; // Change to 'left' or 'right' as needed
                        });
                    });
                },
            },
        ],
        searching: true,
        scrollX: true,
        scrollY: true,
        bScrollCollapse: true,
        columnDefs: [{ sortable: false, targets: 8 }],
        pagingType: "full_numbers",
        order: [[0, 'desc']]
        
        });
        $('.dataTables_length').find('label').contents().filter(function() {
                return this.nodeType === 3; // Filter out text nodes
        }).remove();
        setTimeout(function(){
            $(".dataTables_length select").select2({
                minimumResultsForSearch: Infinity
            });
        },1000)
        this.serachParams();
        // global searching for datable 
        $('#serarch-filter-input').on('keyup', function() {
            table.search(this.value).draw();
        });
            // table = $('#example1').DataTable();
    },
    filter: function(){
        let that = this;
        // $(".search-filter").on("click",function(){
        //     that.serachParams();
        //     $(".close-filter-btn").trigger( "click" )
        // })
        $("#reset-filter,#reset-filter-top").on("click",function(){

            that.resetFilter();
        })
    },
    serachParams: function(){
        // let inhouse_part_name= $('#search_inhouse_part_name').val();
        //  let machine_name= $('#search_machine_name').val();
        // // Ensure that the table and column exist before applying the search
        // if (table && inhouse_part_name) {
        //     table.column(0).search(inhouse_part_name).draw();
        // }
        // if (table && machine_name) {
        //     table.column(3).search(machine_name).draw();
        // }
    },
    resetFilter: function(){
        $('#search_inhouse_part_name').val('').trigger("change");
        $('#search_machine_name').val('').trigger("change");
        $('#search_status').val('').trigger("change");
        dateRangePicker.setStartDate(start_date);
        dateRangePicker.setEndDate(end_date);
        $('#seacrh-filter-block').trigger('submit');
    },
    formValidation: function(){
      let that = this;
      $(document).submit(".add_molding_production,.update_p_q,update_p_q_onhold",function(e){
        var element_dat = $(this);
        // console.log(e.target.id)
        if(e.target.id == "seacrh-filter-block"){
          return;
        }
        e.preventDefault();
        var href = $(e.target).attr("action");
        var id = $(e.target).attr("id");
        let flag = that.formValidate(id);

        if(flag){
          // console.log("uesu",$(e.target).attr("data-form"))
          return;
        }

        var accepted_qty = $('.'+id+" .accepted_qty").val();
        var onhold_qty = $('.'+id+" .onhold_qty").val();
        if($(e.target).attr("data-form") == "update_p_q" && accepted_qty == 0 && onhold_qty == 0){
          swal({
          title: "Are you sure?", 
          text: "You are rejecting production quantity", 
          type: "warning",
          confirmButtonText: "Yes",
          showCancelButton: true
          })
            .then((result) => {
            if (result.value) {
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
            }
          })
        }else{
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
        }
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
};
