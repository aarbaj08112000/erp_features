$( document ).ready(function() {
  page.init();
  if(flag == 0){
      toastr.options = {
        'closeButton': true,
        'debug': false,
        'newestOnTop': false,
        'progressBar': false,
        'positionClass': 'toast-top-right',
        'preventDuplicates': false,
        'showDuration': '1000',
        'hideDuration': '1000',
        'timeOut': '7000',
        'extendedTimeOut': '1000',
        'showEasing': 'swing',
        'hideEasing': 'linear',
        'showMethod': 'fadeIn',
        'hideMethod': 'fadeOut',
      }
      toastr.warning('Can not add invoice number as all parts balance qty is zero.');
  }
});
var table = '';
var file_name = "inwarding_invoice";
var pdf_title = "inwarding_invoice";
const page = {
  init: function(){
    this.initiateForm();
    this.dataTable();
  },
  dataTable: function() {
      // table = $('#view_add_challan').DataTable();
      var data = {};
      table = $("#inwardin_product").DataTable({
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
                          values.splice(4, 1);
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
                  doc.content[0].color = "#5d87ff";
                  doc.content[1].table.widths = ["19%", "19%", "13%", "13%", "15%", "15%"];
                  doc.content[1].table.body[0].forEach(function (cell) {
                      cell.fillColor = "#5d87ff";
                  });
                  doc.content[1].table.body.forEach(function (row, index) {
                      row.splice(4, 1);
                      row.forEach(function (cell) {
                          // Set alignment for each cell
                          cell.alignment = "center"; // Change to 'left' or 'right' as needed
                      });
                  });
              },
          },
      ],
      searching: true,
      // scrollX: true,
      scrollY: '200px',
      bScrollCollapse: true,
      // columnDefs: [{ sortable: false, targets: 9 }],
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

  },
  initiateForm: function(){
    let that = this;

    $(".add_invoice_number").submit(function(e){
      e.preventDefault();
      let flag = that.formValidate("add_invoice_number");
      if(flag){
        return;
      }
      var formData = new FormData($('.add_invoice_number')[0]);

      $.ajax({
        type: "POST",
        url: base_url+"add_invoice_number",
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
    $(".update_inwarding_details,.delete_invoice").submit(function(e){
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
    $(".custom-form."+form_class+" input.required-input").each(function( index ) {
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
