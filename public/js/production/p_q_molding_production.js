$(document).ready(function() {
    page.init();
});

var table = '';
var file_name = "molding_production";
var pdf_title = "Molding Production";

const page = {
    init: function() {
      this.filter();
        this.dataTable();
        this.initiateForm();
        
    },
    dataTable: function() {
        // table = $('#view_add_challan').DataTable();
        var data = {};
        table = $("#p_q_molding_production").DataTable({
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
                            values.splice(21, 3);
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
                    doc.content[1].table.widths = ["4.7%", "4.7%", "4.7%", "4.7%", "4.7%", "4.7%","4.7%", "4.7%", "4.7%", "4.7%", "4.7%", "4.7%","4.7%", "4.7%", "4.7%", "4.7%", "4.7%", "4.7%","4.7%", "4.7%", "4.7%", "4.7%", "4.7%", "4.7%"];
                    doc.content[1].table.body[0].forEach(function (cell) {
                        cell.fillColor = theme_color;
                    });
                    doc.content[1].table.body.forEach(function (row, index) {
                        row.splice(21, 3);
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
        fixedColumns: {
            leftColumns: 2,
            // end: 1
        },
        columnDefs: [{ sortable: false, targets: 21 },{ sortable: false, targets: 22 },{ sortable: false, targets: 23 }],
        pagingType: "full_numbers",
       
    });
        $('.dataTables_length').find('label').contents().filter(function() {
            return this.nodeType === 3; // Filter out text nodes
        }).remove();
        setTimeout(function(){
          $(".dataTables_length select").select2({
              minimumResultsForSearch: Infinity
          });
        },1000)
        // table = $('#example1').DataTable();
       
        this.serachParams();
        this.serachParams();
    },
    filter: function(){
        let that = this;
        $('#date_range_filter').daterangepicker({
            locale: {
            format: 'YYYY/MM/DD' // Example format, adjust as needed
        }
        });
        $('#date_range_filter').data('daterangepicker').setStartDate(start_date);
        $('#date_range_filter').data('daterangepicker').setEndDate(end_date);
        $(".search-filter").on("click",function(){
            that.serachParams();
            $(".close-filter-btn").trigger( "click" )
        })
        $(".reset-filter").on("click",function(){
            that.resetFilter();
        })
        $('#serarch-filter-input').on('keyup', function() {
            table.search(this.value).draw();
        });
    },
    serachParams: function(){
        table.draw(); // Trigger DataTables redraw
        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                var date_range_filter =  $("#date_range_filter").val();
                var dates = date_range_filter.split(' - ');
                var startDate = dates[0].replace(/\//g, '-');
                var endDate = dates[1].replace(/\//g, '-');
                var date = data[3]; // Assuming the date is in the 5th column (index 4)

                if (
                    (startDate === '' && endDate === '') ||
                    (startDate === '' && new Date(date) <= new Date(endDate)) ||
                    (new Date(startDate) <= new Date(date) && endDate === '') ||
                    (new Date(startDate) <= new Date(date) && new Date(date) <= new Date(endDate))
                ) {
                    return true;
                }
                return false;
            }
        );
    },
    resetFilter: function(){
        $('#date_range_filter').data('daterangepicker').setStartDate(start_date);
        $('#date_range_filter').data('daterangepicker').setEndDate(end_date);
        this.serachParams();
    },
     
    initiateForm: function(){
        let that = this;
        $(".add_production_qty_molding_production").submit(function(e){
          e.preventDefault();
         
          let flag = that.formValidate("add_production_qty_molding_production");
          if(flag){
            return;
          }
          var formData = new FormData($('.add_production_qty_molding_production')[0]);
    
          $.ajax({
            type: "POST",
            url: base_url+"add_production_qty_molding_production",
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
        $(document).on('submit', '.update_p_q_molding_production', function(e) {
            e.preventDefault();
            var data_id = $(this).attr("data-id");
            let flag = that.formValidate("update_p_q_molding_production_"+data_id);
            if(flag){
              return;
            }
            var formData = new FormData($('.update_p_q_molding_production_'+data_id)[0]);
      
            $.ajax({
              type: "POST",
              url: base_url+"update_p_q_molding_production",
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
          console.log($(this))
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
                label = (label.toLowerCase()).replace(/[^\w\s*]/gi, '');
                label = label.charAt(0).toUpperCase() + label.slice(1)
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
              label = (label.toLowerCase()).replace(/[^\w\s*]/gi, '');
              label = label.charAt(0).toUpperCase() + label.slice(1);
              var validation_message =label +end;
              var label_html = "<label class='error'>"+validation_message+"</label>";
              $(this).parents(".form-group").append(label_html)
            }
        }
        });
       
        return flag;
    }
};
