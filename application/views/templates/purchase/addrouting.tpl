<div class="container-xxl flex-grow-1 container-p-y">
    <div class="content-wrapper" >
        <!-- Content Header (Page header) -->
        
        <nav aria-label="breadcrumb">
          <div class="sub-header-left pull-left breadcrumb">
            <h1>
              Purchase
              <a hijacked="yes" href="javascript:void(0)" class="backlisting-link">
                <i class="ti ti-chevrons-right"></i>
                <em>Sub Con</em></a>
              </h1>
              <br>
              <span>Routing</span>
            </div>
          </nav>
          <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5 listing-btn">
             <button type="button" class="btn btn-seconday float-left" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    Add Routing</button>
                                    <button class="btn btn-seconday" type="button" id="downloadCSVBtn" title="Download CSV"><i class="ti ti-file-type-csv"></i></button>
        <button class="btn btn-seconday" type="button" id="downloadPDFBtn" title="Download PDF"><i class="ti ti-file-type-pdf"></i></button>
            <a title="Back To Subcon Routing" class="btn btn-seconday" href="<%base_url('routing')%>" type="button"><i class="ti ti-arrow-left"></i></a>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="">
                                <!-- Button trigger modal -->
                               
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="<%base_url('addRoutingParts') %>" id="addRoutingParts" class="addRoutingParts custom-form" method="POST" enctype='multipart/form-data' >
                                            <div class="modal-body">
                                                
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label> Select Input item part </label><span class="text-danger">*</span>
                                                                <select class="form-control select2 required-input" name="routing_part_id" style="width: 100%;">
                                                                    <%if count($child_part_master) gt 0 %>
                                                                        <%foreach from=$child_part_master item=c %>
                                                                            <option value="<%$c->id %>"><%$c->part_number %></option>
	                                                                    <%/foreach%>
                                                                    <%/if%>
                                                                </select>
                                                            </div>
                                                                                                                        
                                                            <div class="form-group">
                                                                <label for="po_num">Qty</label><span class="text-danger">*</span>
                                                                <input type="text" step="any" value="" name="qty"  class="form-control onlyNumericInput required-input" id="exampleInputEmail1" placeholder="Enter Qty">
                                                                <input type="hidden" value="<%$part_id %>" name="part_id" required class="form-control" id="exampleInputEmail1" placeholder="Enter Part Price">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                                    </div>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="">
                                <table id="routing_view" class="table  table-striped">
                                    <thead>
                                        <tr>
                                            <!-- <th>Sr. No.</th> -->
                                            <th>Output Part Number</th>
                                            <th>Output Part Description</th>
                                            <th>Input Part Number</th>
                                            <th>Input Part Description</th>
                                            <th>Input Part Qty</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<%assign var="i" value=1 %>
                                    	<%if $routing != '' %>
	                                        <%foreach from=$routing item=poo %>
	                                                <tr>
	                                                    <!--<td><%$i %></td> -->
	                                                    <td><%$poo->out_partNumber %></td>
	                                                    <td><%$poo->out_partDesc %></td>
	                                                    <td><%$poo->in_partNumber %></td>
	                                                    <td><%$poo->in_partDesc  %></td>
	                                                    <td><%$poo->qty %></td>
                                                      <td class="text-center">
                                                        
                                                         <a type="button" class="float-left" data-bs-toggle="modal" data-bs-target="#editModal<%$i %>"><i class="ti ti-edit"></i></a>
                                                         <div class="modal fade" id="editModal<%$i %>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Edit </h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <form action="<%base_url('editRoutingParts') %>" id="editRoutingParts<%$i %>" class="editRoutingParts<%$i %> editRoutingParts custom-form" method="POST" enctype='multipart/form-data' >
                                                                    <div class="modal-body">
                                                                        
                                                                            <div class="row">
                                                                                <div class="col-lg-12">
                                                                                    <div class="form-group">
                                                                                        <label for="po_num">Qty</label><span class="text-danger">*</span>
                                                                                        <input type="text" step="any" value="<%$poo->qty %>" name="qty"  class="form-control onlyNumericInput required-input"  placeholder="Enter Qty">
                                                                                        <input type="hidden" value="<%$poo->id_val %>" name="id" required class="form-control" id="exampleInputEmail1" placeholder="Enter Part Price">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                                                            </div>
                                                                    </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                      </td>
	                                                </tr>
                                                  <%assign var='i' value=$i+1%>
	                                        <%/foreach%>
                                        <%/if%>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script type="text/javascript">
            $(document).ready(function() {
    page.init();
});

var table = '';
var file_name = "routing";
var pdf_title = "Routing";

const page = {
    init: function() {
        // inwarding_grn
        this.dataTable();
        this.formValidation();
        let that = this;
        $(".editRoutingParts").submit(function(e){
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
    },
    dataTable: function(){
        var data ={};
        table = $("#routing_view").DataTable({
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
        scrollY: true,
        bScrollCollapse: true,
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
    },
    formValidation: function(){
        let that = this;
        $(".addRoutingParts").submit(function(e){
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
                table.destroy(); 
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
    
};

    </script>
