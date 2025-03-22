<div class="wrapper">
<div class="content-wrapper container-xxl flex-grow-1 container-p-y">
   
   <nav aria-label="breadcrumb">
      <div class="sub-header-left pull-left breadcrumb">
        <h1>
          Store
          <a hijacked="yes" href="javascript:void(0)" class="backlisting-link" title="Back to Issue Request Listing">
            <i class="ti ti-chevrons-right"></i>
            <em>Prodcution</em></a>
          </h1>
          <br>
          <span>Final Inspection </span>
        </div>
   </nav>
   <!-- /.content-header -->
   <!-- Main content -->
   <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5">
        <%if checkGroupAccess("final_inspection","add","No")%>
           <button type="button" class="btn btn-seconday" data-bs-toggle="modal"
                            data-bs-target="#addPromo">
                         Add Request
             </button>
        <%/if%>
        <%if checkGroupAccess("final_inspection","export","No")%>
          <button class="btn btn-seconday" type="button" id="downloadPDFBtn" title="Download PDF"><i class="ti ti-file-type-pdf"></i></button>
          <button class="btn btn-seconday" type="button" id="downloadCSVBtn" title="Download CSV"><i class="ti ti-file-type-csv"></i></button>
        <%/if%>
        
   </div>
   <section class="content">
      <div>
         <!-- Small boxes (Stat box) -->
         <div class="row">
            <br>
            <div class="col-lg-12">
               <!-- Modal -->
               <div class="modal fade" id="addPromo" tabindex="-1" role="dialog"
                  aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog  modal-dialog-centered" role="document">
                     <div class="modal-content">
                        <div class="modal-header">
                           <h5 class="modal-title" id="exampleModalLabel">Add</h5>
                           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                           
                           </button>
                        </div>
                        <form
                                 action="<%base_url('add_molding_final_inspection_location') %>"
                                 method="POST" enctype="multipart/form-data" id="add_molding_final_inspection_location" class="add_molding_final_inspection_location custom-form">
                        <div class="modal-body">
                           <div class="form-group">
                              
                           </div>
                           <div class="form-group">
                           <label for="on click url">Select Customer Part / Final Inspection Qty<span
                              class="text-danger">*</span></label>
                           <select  name="customer_part_id" class="form-control select2 required-input" style="width: 100%;">
                           <%if ($customer_parts_master) %>
                                <%foreach from=$customer_parts_master item=c %>
	                           <option value="<%$c->id %>">
	                           <%$c->part_number %> / <%$c->part_description %> / <%$c->final_inspection_location %>
	                           </option>
	                           <%/foreach%>
                            <%/if%>
                           </select>
                           </div>
                           <div class="form-group">
                           <label for="on click url">Qty<span class="text-danger">*</span></label>
                           <input type="text" data-min="1" value="1" max="" name="qty" 
                              class="form-control required-input onlyNumericInput">
                           </div>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                           data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                        </form>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="w-100">
            <input type="text" name="reason" placeholder="Filter Search" class="form-control serarch-filter-input m-3 me-0" id="serarch-filter-input" fdprocessedid="bxkoib">
        </div>
               <div class="card w-100">
                 
                  <!-- /.card-header -->
                  <div class="">
                     <table id="example1" class="table  table-striped">
                        <thead>
                           <tr>
                              <!--<th>Sr No</th> -->
                              <th>Part Number / Description</th>
                              <th>Qty</th>
                              <th>Status</th>
                              <th>Transfer</th>
                              <th>Date & Time</th>
                           </tr>
                        </thead>
                        <tbody>
                           <%if ($final_inspection_request) %>
                                <%assign var='i' value=1 %>
                                <%foreach from=$final_inspection_request item=u %>
		                           <tr>
		                              <!--<td><%$i %></td> -->
		                              <td><%$u->part_number %> /
		                                 <%$u->part_description %>
		                              </td>
		                              <td><%$u->qty %></td>
		                              <td><%$u->status %></td>
		                              <td>
		                              	<%if ($u->status == "pending") %>
			                                <%if ($u->qty <= $u->final_inspection_location) %>
                                        <%if checkGroupAccess("final_inspection","update","No")%>
    			                                 <a class="btn btn-warning"
    			                                    href="<%base_url('final_inspection_stock_transfer_click/') %><%$u->id %>">Click
    			                                 To
    			                                 Transfer Stock</a>
                                        <%else%>
                                          <%display_no_character("")%>
                                        <%/if%>
			                                <%else %>
			                                    please add final Inspection stock
			                                <%/if%>
		                                <%else %>
		                                    Stock Transferred
		                                <%/if%>
		                              </td>
		                              <td><%defaultDateFormat($u->created_date) %> / <%$u->created_time %></td>
		                           </tr>
		                        <%assign var='i' value=$i+1 %>
		                        <%/foreach%>
                            <%/if%>
                        </tbody>
                     </table>
                  </div>
                  <!-- /.card-body -->
               </div>
               <!-- ./col -->
            </div>
         </div>
         <!-- /.row -->
         <!-- Main row -->
         <!-- /.row (main row) -->
      </div>
      <!-- /.container-fluid -->
   </section>
   <!-- /.content -->
</div>

<script type="text/javascript">
var file_name = "final_inspection";
var pdf_title = "Final Inspection";
var table = '';
const datatable = {
    init:function(){
        let that = this;
        that.dataTable();
        this.initFormValidate();
    },
    dataTable: function() {
        var data = {};
        table = $("#example1").DataTable({
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

        // global searching for datable 
        $('#serarch-filter-input').on('keyup', function() {
            table.search(this.value).draw();
        });
            // table = $('#example1').DataTable();
      }, 
      initFormValidate: function(){
        let that = this;
        $(".add_molding_final_inspection_location").submit(function(e){
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
          if(value == '' || value == null || value == undefined){
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
    }
    

}


$(document).ready(function () {
    datatable.init();    
})
</script>