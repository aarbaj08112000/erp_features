<div class="wrapper">
  <div class="container-xxl flex-grow-1 container-p-y">

    <nav aria-label="breadcrumb">
      <div class="sub-header-left pull-left breadcrumb">
        <h1>
          Store
          <a hijacked="yes" href="javascript:void(0)" class="backlisting-link" title="">
            <i class="ti ti-chevrons-right"></i>
            <em>Report</em></a>
          </h1>
          <br>
          <span>CUSTOMER PART WIP STOCK REPORT </span>
        </div>
      </nav>
      <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5">
      <%if (checkGroupAccess("customer_part_wip_stock_report","export","No"))%>
        <button class="btn btn-seconday" type="button" id="downloadCSVBtn" title="Download CSV"><i class="ti ti-file-type-csv"></i></button>
        <button class="btn btn-seconday" type="button" id="downloadPDFBtn" title="Download PDF"><i class="ti ti-file-type-pdf"></i></button>
      <%/if%>
  <%*<button class="btn btn-seconday filter-icon" type="button"><i class="ti ti-filter" ></i></i></button>
  <button class="btn btn-seconday" type="button"><i class="ti ti-refresh reset-filter"></i></button> *%>
</div>
    <section class="content">
      <div class="">
        <div class="row">
          <div class="col-12">
            <div class="card mt-4">
              <div class="card-header">
                <form action="<%$smarty.const.BASE_URL%>customer_part_wip_stock_report" method="POST">
                  <div class="row">
                    <div class="col-lg-7">
                      <label for="">Select Part Number / Description / Customer</label>
                      <select name="selected_customer_part_number" required id="" class="form-control select2">
                        <option <%if $selected_customer_part_number eq 0%>selected <%/if%> value="0">NA</option>
                        <%if $customer_parts_data%>
                        <%foreach from=$customer_parts_data item=c%>
                        <option <%if $selected_customer_part_number eq $c->part_number%>selected <%/if%> value="<%$c->part_number%>">
                          <%$c->part_number%> /
                          <%$c->part_description%> /
                          <%$c->customer_name%>
                        </option>
                        <%/foreach%>
                        <%/if%>
                      </select>
                    </div>
                    <div class="col-lg-2">
                      <div class="form-group">
                        <button class="btn btn-danger mt-4">
                          Search
                        </button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              </div>
            <!--   <div class="w-100 mt-4">
            <input type="text" name="reason" placeholder="Filter Search" class="form-control serarch-filter-input m-3 me-0" id="serarch-filter-input" fdprocessedid="bxkoib">
      </div> -->
              <div class="card mt-4 w-100">
              <div class="">
                <table id="customer_part_wip_stock_report" class="table  table-striped">
                  <thead>
                    <tr>
                      <!-- <th>Sr. No.</th> -->
                      <th>Customer Name</th>
                      <th>Customer Part Number</th>
                      <th>item part Number</th>
                      <th>item part Description</th>
                      <th>Inhouse Stock</th>
                      <th>FG Stock</th>
                    </tr>
                  </thead>
                  <tbody>
                    <%assign var="i" value=1%>
                    <%if $operations_bom%>
                     <%foreach from=$operations_bom item=po%>
                    
                    <tr>
                      <!-- <td>
                        <%$i%>
                      </td> -->
                      <td>
                        <%$customer_data[$po->id][0]->customer_name%>
                      </td>
                      <td>
                        <%$po->customer_part_number%>
                      </td>
                      <td>
                        <%$output_part_data[$po->id][0]->part_number%>
                      </td>
                      <td>
                        <%$output_part_data[$po->id][0]->part_description%>
                      </td>
                      <td>
                        <%if $po->output_part_table_name eq "inhouse_parts"%>
                        <%$current_stock[$po->id]%>
                        <%else%>
                          <%display_no_character()%>
                        <%/if%>
                      </td>
                      <td>
                        <%if $po->output_part_table_name eq "customer_part"%>
                        <%$current_stock[$po->id]%>
                        <%else%>
                          <%display_no_character()%>
                        <%/if%>
                      </td>
                    </tr>
                    <%assign var="i" value=$i+1%>
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
</div>
<script type="text/javascript">
        var table = '';
var file_name = "customer_part_wip_stock_report";
var pdf_title = "CUSTOMER PART WIP STOCK REPORT";
        var data = {};
        table = $("#customer_part_wip_stock_report").DataTable({
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
        searching: true,
        // scrollX: true,
        scrollY: true,
        bScrollCollapse: true,
        // columnDefs: [{ sortable: false, targets: 7 }],
        pagingType: "full_numbers",
       
        
        });
        $('#serarch-filter-input').on('keyup', function() {
            table.search(this.value).draw();
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
</script>