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
    $("#customer_id").select2()
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
	      columnDefs: [{ sortable: false, targets: 5 }],
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
      $('#serarch-filter-input').on('keyup', function() {
            table.search(this.value).draw();
        });
      // table = $('#example1').DataTable();

  },
  initiateForm: function(){
    let that = this;
    $(".generate_customer_challan_return").submit(function(e){
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
