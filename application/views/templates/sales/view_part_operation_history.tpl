<div  class="wrapper container-xxl flex-grow-1 container-p-y ">
    <!-- Navbar -->

    <!-- /.navbar -->

    <!-- Main Sidebar Container -->


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        
        <div class="sub-header-left pull-left breadcrumb">
                <h1>
                    Planning &amp; Sales 
                    <a hijacked="yes" href="javascript:void(0)" class="backlisting-link" title="Back to Issue Request Listing">
                        <i class="ti ti-chevrons-right"></i>
                        <em>Customer Part</em></a>
                </h1>
                <br>
                <span>Customer Part Operation History </span>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="">
                <div class="row">
                    <div class="col-12">

                        <!-- /.card -->

                        <div class="card">
                            


                            <!-- /.card-header -->
                            <div class="">
                                <table id="view_part_operation_history" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <!-- <th>Sr. No.</th> -->
                                            <th>Revision Number</th>
                                            <th>Revision Date</th>
                                            <th>Revision Remark</th>
                                            <th>Customer Name</th>
                                            <th>Part Number</th>
                                            <th>Part Description</th>
                                            <th>Opration Number </th>
                                            <th>Opration Name </th>
                                            <th> Details</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <%assign var=i value=1 %>
                                        <%if ($customer_part_rate) %>
                                           
                                            <%foreach from=$customer_part_rate item=poo %>
                                              
                                                    <tr>
                                                        <!--<td><%$i %></td> -->
                                                        <td><%$poo->revision_no %></td>
                                                        <td><%$poo->revision_date %></td>
                                                        <td><%$poo->revision_remark %></td>

                                                        <td><%$poo->customer_name %></td>
                                                        <td><%$poo->part_number %></td>
                                                        <td><%$poo->part_description %></td>
                                                        <td><%$poo->operation_name_val %></td>
                                                        <td><%$poo->name %></td>
                                                        <td>
                                                            <a class="btn btn-info" href="<%base_url('add_operation_details/')%><%$poo->id %>">Add Details</a>
                                                        </td>



                                                    </tr>
                                        
                                               <%assign var=i value=$i+1 %>
                                            <%/foreach%>
                                        <%/if%>
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
    	 var data = {};
        table = $("#view_part_operation_history").DataTable({
        dom: "Bfrtilp",
       
        searching: true,
        // scrollX: true,
        scrollY: true,
        bScrollCollapse: true,
        columnDefs: [{ sortable: false, targets: 7 }],
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
    </script>