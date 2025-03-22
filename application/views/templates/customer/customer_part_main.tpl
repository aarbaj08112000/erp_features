<div class="wrapper container-xxl flex-grow-1 container-p-y">
    <!-- Navbar -->

    <!-- /.navbar -->

    <!-- Main Sidebar Container -->


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
         <div class="sub-header-left pull-left breadcrumb">
            <h1>
            Planning &amp; Sales 
            <a hijacked="yes" href="#stock/issue_request/index" class="backlisting-link" title="Back to Issue Request Listing">
            <i class="ti ti-chevrons-right"></i>
            <em>Customer item part</em></a>
            </h1>
            <br>
            <span> Customer Part Operation</span>
        </div>
        
        <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5 listing-btn">
            <a title="Back To Customer Part" class="btn btn-seconday" href="<%$base_url%>customer_master" type="button"><i class="ti ti-arrow-left"></i></a>
        </div>
        <!-- Main content -->
        <section class="content">
            <div class="">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <!-- /.card-header -->
                            <div class=" ">
                                <table id="customer_part_main_view" class="table table-striped w-100">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <!-- <th>Customer Part Number</th> -->
                                            <th> Part Number</th>
                                            <th>Part Description</th>
                                            <th>Details</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        <%if $customer_part%>
                                            <%assign var="i" value=1%>
                                            <%foreach from=$customer_part item=c%>
                                                <%if $customer_id == $c->customer_id%>
                                                   
                                                    <tr>
                                                        <td><%$i%></td>
                                                        <td><%$c->part_number%></td>
                                                        <td><%$c->part_description%></td>
                                                        <td><a href="<%$base_url%>customer_part_operation/<%$c->customer_id%>/<%$c->id%>" class="btn btn-info">View</a></td>
                                                    </tr>
                                                    <%assign var="i" value=$i+1%>
                                                <%/if%>
                                            <%/foreach%>
                                        <%/if%>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
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

<script type="text/javascript">
    
$( document ).ready(function() {
    
  page.init();
});
var file_name = "customer_drawing";
var pdf_title = "Customer Part Drawing";
var table = '';
const page = {
    init:function(){
        let that = this;
        that.dataTable();
    },
    dataTable: function() {
        var data = {};
        table = $("#customer_part_main_view").DataTable({
        dom: "Bfrtilp",
        searching: true,
        scrollX: true,
        scrollY: true,
        bScrollCollapse: true,
        columnDefs: [{ sortable: false, targets: 3 }],
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

   

}


</script>