<style>
table tr td{
    text-align: center;
}
</style>
<div class="wrapper container-xxl flex-grow-1 container-p-y">
    <!-- Navbar -->

    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <nav aria-label="breadcrumb">
    <div class="sub-header-left pull-left breadcrumb">
      <h1>
        Planning & Sales
        <a hijacked="yes" href="#stock/issue_request/index" class="backlisting-link" title="Back to Issue Request Listing" >
          <i class="ti ti-chevrons-right" ></i>
          <em >Customer Scheduling</em></a>
      </h1>
      <br>
      <span >Planing Month      </span>
    </div>
  </nav>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        
        <!-- Main content -->
        <section class="content">
            <div class="">
                <div class="row">
                    <div class="col-12">

                        <!-- /.card -->

                        <div class="card">
                           
                            <!-- /.card-header -->
                            <div class="">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead style="text-align: center;">
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Month</th>
                                            <th>View Details</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>APR</td>
                                            <td>
                                                <a class="btn btn-info" href="<%$base_url%>planing_data/<%$financial_year%>/APR/0">View Details</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>MAY</td>
                                            <td>
                                                <a class="btn btn-info" href="<%$base_url%>planing_data/<%$financial_year%>/MAY/0">View Details</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>JUN</td>
                                            <td>
                                                <a class="btn btn-info" href="<%$base_url%>planing_data/<%$financial_year%>/JUN/0">View Details</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>JUL</td>
                                            <td>
                                                <a class="btn btn-info" href="<%$base_url%>planing_data/<%$financial_year%>/JUL/0">View Details</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>AUG</td>
                                            <td>
                                                <a class="btn btn-info" href="<%$base_url%>planing_data/<%$financial_year%>/AUG/0">View Details</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>6</td>
                                            <td>SEP</td>
                                            <td>
                                                <a class="btn btn-info" href="<%$base_url%>planing_data/<%$financial_year%>/SEP/0">View Details</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>7</td>
                                            <td>OCT</td>
                                            <td>
                                                <a class="btn btn-info" href="<%$base_url%>planing_data/<%$financial_year%>/OCT/0">View Details</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>8</td>
                                            <td>NOV</td>
                                            <td>
                                                <a class="btn btn-info" href="<%$base_url%>planing_data/<%$financial_year%>/NOV/0">View Details</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>9</td>
                                            <td>DEC</td>
                                            <td>
                                                <a class="btn btn-info" href="<%$base_url%>planing_data/<%$financial_year%>/DEC/0">View Details</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>10</td>
                                            <td>JAN</td>
                                            <td>
                                                <a class="btn btn-info" href="<%$base_url%>planing_data/<%$financial_year%>/JAN/0">View Details</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>11</td>
                                            <td>FEB</td>
                                            <td>
                                                <a class="btn btn-info" href="<%$base_url%>planing_data/<%$financial_year%>/FEB/0">View Details</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>12</td>
                                            <td>MAR</td>
                                            <td>
                                                <a class="btn btn-info" href="<%$base_url%>planing_data/<%$financial_year%>/MAR/0">View Details</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
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
    <script type="text/javascript">
        table =  new DataTable('#example1',{
        dom: "Bfrtilp",
        scrollX: false, 
        
            searching: true,
      // scrollX: true,
      scrollY: true,
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
    </script>
