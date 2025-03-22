<div class="wrapper container-xxl flex-grow-1 container-p-y">
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme filter-popup-block" style="width: 0px;">
    <div class="app-brand demo justify-content-between">
        <a href="javascript:void(0)" class="app-brand-link">
            <span class="app-brand-text demo menu-text fw-bolder ms-2">Filter</span>
        </a>
        <div class="close-filter-btn d-block filter-popup cursor-pointer">
                <i class="ti ti-x fs-8"></i>
            </div>
    </div>
</aside>

    <nav aria-label="breadcrumb">
      <div class="sub-header-left pull-left breadcrumb">
        <h1>
          Reports
          <a hijacked="yes" href="#stock/issue_request/index" class="backlisting-link" title="Back to Issue Request Listing" >
            <i class="ti ti-chevrons-right" ></i>
            <em >Rejection report</em></a>
        </h1>
        <br>
        <span >Rejection report</span>
      </div>
    </nav>
<!-- Navbar -->
<div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5">
    <%if checkGroupAccess("report_prod_rejection","export","No") %>
      <button class="btn btn-seconday" type="button" id="downloadCSVBtn" title="Download CSV"><i class="ti ti-file-type-csv"></i></button>
      <button class="btn btn-seconday" type="button" id="downloadPDFBtn" title="Download PDF"><i class="ti ti-file-type-pdf"></i></button>
      <%/if%>
    </div>
    <div class="w-100">
    <input type="text" name="reason" placeholder="Filter Search" class="form-control serarch-filter-input m-3 me-0" id="serarch-filter-input" fdprocessedid="bxkoib">
  </div>
<div class="content-wrapper">
   <!-- Content Header (Page header) -->

   <!-- Main content -->
   <section class="content">
      <div class="">
         <div class="row">
            <div class="col-12">
               <!-- /.card -->
               <div class="card p-0 ">
                  <div class="card-header">
                     <div class="row">
                        <div class="col-lg-6">
                           <div class="form-group">
                              <label for="">
                                 <span class="text-danger">Data Analysis </span>
                                 <div style="padding-left: 10px;padding-top:10px">
                                    <li>Total rejection across all the customers : <span class="text-danger"><%$total_rejection[0]->total_rejection_qty %></span></li>
                                    <li>Maximum rejections are for reason <span class="text-danger"><%$max_rejection_reason[0]->name %></span> with Quantity: <span class="text-danger"><%$max_rejection_reason[0]->total_rejection_qty %></span></li>
                                    <li>Maximum rejection on machine : <span class="text-danger"><%$machine_analysis[0]->machine_name %></span> for reason <span class="text-danger"><%$machine_analysis[0]->name %></span> with Quantity: <span class="text-danger"><%$machine_analysis[0]->total_rejection_qty %></span></li>
                                 </div>
                              </label>
                           </div>
                        </div>
                     </div>
                     <span class="text-info"> Display more details</span>
                     <i id="showIcon" class="ti ti-eye fs-4" style="cursor: pointer; display: none;"></i>
                     <i id="hideIcon" class="ti ti-eye-off fs-4" style="cursor: pointer; display: inline;"></i>
                     <div id="dataAnalysis" style="display: none;">
                        <div class="row">
                           <div class="col-lg-4 mt-3">
                              <div class="table-bordered-box" style="text-wrap:nowrap;">
                                 <table id="exa" class="table  border-primary table-striped me-4" >
                                    <thead>
                                       <tr>
                                          <th>Top Rejection Reason</th>
                                          <th>Total Rejection QTY</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       	<%assign var='i' value=1 %>
                                        <%if ($max_rejection_reason) %>
                                            <%foreach from=$max_rejection_reason item=r %>
		                                       <tr>
		                                          <td><%$r->name %></td>
		                                          <td><%$r->total_rejection_qty %></td>
		                                       </tr>
		                                    <%assign var='i' value=$i+1 %>
		                                    <%/foreach%>
                                        <%/if%>
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                           <div class="col-lg-7 mt-3">
                              <div class=" table-bordered-box mt-3" style="text-wrap:nowrap;">
                                 <table id="exa" class="table  table-striped">
                                    <thead>
                                       <tr>
                                          <th>Machine Name</th>
                                          <th>Rejection Reason</th>
                                          <th>Total Rejection QTY</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <%assign var='i' value=1 %>
                                        <%if ($machine_analysis) %>
                                            <%foreach from=$machine_analysis item=r %>
		                                       <tr>
		                                          <td><%$r->machine_name %></td>
		                                          <td><%$r->name %></td>
		                                          <td><%$r->total_rejection_qty %></td>
		                                       </tr>
		                                    <%assign var='i' value=$i+1 %>
		                                    <%/foreach%>
                                        <%/if%>
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                </div>
                <div class="card p-0 mt-4">
                  <div class="">
                

                  <div class="">
                  <div class="table-responsive text-nowrap">
                     <table id="example1" class="table  table-striped">
                        <thead>
                           <tr>
                              <!-- <th>Sr. No.</th> -->
                              <th>Rejection Reason</th>
                              <th>Rejection QTY</th>
                              <th>Customer</th>
                              <th>Part Details</th>
                              <th>Date/Shift</th>
                              <th>Machine</th>
                              <th>Operator</th>
                           </tr>
                        </thead>
                        <tbody>
                           <%assign var='i' value=1 %>
                            <%if ($report_prod_rejection) %>
                                <%foreach from=$report_prod_rejection item=r %>
		                           <tr>
		                              <!-- <td><%$i %></td> -->
		                              <td><%$r->rejection_reason %></td>
		                              <td><%$r->rejection_qty %></td>
		                              <td><%$r->customer_name %></td>
		                              <td><%$r->part_number %></td>
		                              <td><%defaultDateFormat($r->prod_date) %>/ <%$r->shift_type %></td>
		                              <td><%$r->machine_name %></td>
		                              <td><%$r->operator_name %></td>
		                           </tr>
		                        <%assign var='i' value=$i+1 %>
		                        <%/foreach%>
                            <%/if%>
                        </tbody>
                     </table>
                     </div>
                  </div>
                  <!-- /.card-body -->
               </div>
               <!-- /.card -->
            </div>
            <!-- /.col -->
         </div>
         <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
   </section>
   <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<style >
  .table-bordered-box {
    margin: .25rem !important;
    border: 1px solid var(--bs-theme-color);
  }
</style>
<script>
var file_name = "report_prod_rejection";
var pdf_title = "Rejection Report";
   document.getElementById("showIcon").addEventListener("click", function() {
       document.getElementById("dataAnalysis").style.display = "none";
       document.getElementById("showIcon").style.display = "none";
       document.getElementById("hideIcon").style.display = "inline";
   });
   
   document.getElementById("hideIcon").addEventListener("click", function() {
       document.getElementById("dataAnalysis").style.display = "block";
       document.getElementById("showIcon").style.display = "inline";
       document.getElementById("hideIcon").style.display = "none";
   });
   // datatable initilization.
  
 
      table =  new DataTable('#example1',{
        dom: 'Bfrtilp',
        scrollX: false, 
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
                                values.splice(8, 1);
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
                    
                    
                },
            ],
            searching: true,
    // scrollX: true,
    scrollY: true,
     lengthMenu: [[10,50,100,200,500,1000,2500], [10,50,100,200,500,1000,2500]],
    bScrollCollapse: true,
    pagingType: "full_numbers",
    });
      $('.dataTables_length').find('label').contents().filter(function() {
            return this.nodeType === 3; // Filter out text nodes
        }).remove();
        $('#serarch-filter-input').on('keyup', function() {
            table.search(this.value).draw();
        });
        setTimeout(function(){
          $(".dataTables_length select").select2({
              minimumResultsForSearch: Infinity
          });
        },1000)
    
</script>
</body>
</html>
