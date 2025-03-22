<div class="wrapper container-xxl flex-grow-1 container-p-y">
    <!-- Navbar -->

    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <nav aria-label="breadcrumb">
    <div class="sub-header-left pull-left breadcrumb">
      <h1>
        Planning & Sales
        <a hijacked="yes" class="backlisting-link" title="Back to Issue Request Listing" >
          <i class="ti ti-chevrons-right" ></i>
          <em >Customer Scheduling</em></a>
      </h1>
      <br>
      <span >Financial Year</span>
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
                                <table id="example1" class="table  table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Finanical Year</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>FY-2021</td>
                                            <td>
                                                <a class="btn btn-info" href="<%$base_url%>planing_data_month/FY-2021">View Details</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>FY-2022</td>
                                            <td>
                                                <a class="btn btn-info" href="<%$base_url%>planing_data_month/FY-2022">View Details</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>FY-2023</td>
                                            <td>
                                                <a class="btn btn-info" href="<%$base_url%>planing_data_month/FY-2023">View Details</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>FY-2024</td>
                                            <td>
                                                <a class="btn btn-info" href="<%$base_url%>planing_data_month/FY-2024">View Details</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>FY-2025</td>
                                            <td>
                                                <a class="btn btn-info" href="<%$base_url%>planing_data_month/FY-2025">View Details</a>
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
    <!-- /.content-wrapper -->
