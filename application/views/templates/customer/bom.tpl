<div style="width:100%" class="wrapper">
    <!-- Navbar -->

    <!-- /.navbar -->

    <!-- Main Sidebar Container -->


    <!-- Content Wrapper. Contains page content -->
    <div class="wrapper container-xxl flex-grow-1 container-p-y ">
        <!-- Content Header (Page header) -->
        <div class="sub-header-left pull-left breadcrumb">
                <h1>
                    Planning & Sales 
                    <a hijacked="yes" href="#stock/issue_request/index" class="backlisting-link" title="Back to Issue Request Listing">
                        <i class="ti ti-chevrons-right"></i>
                        <em>Customer Part</em></a>
                </h1>
                <br>
                <span>Customer item part </span>
            </div>
        <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5 listing-btn">
            
            <a title="Back To Customer Part" class="btn btn-seconday" href="<%$base_url%>customer_master" type="button"><i class="ti ti-arrow-left"></i></a>
        </div>
        <!-- Main content -->
        <section class="content">
            <div class="">
                <div class="row">
                    <div class="col-12">

                        <!-- /.card -->
 <div class="w-100">
<input type="text" name="reason" placeholder="Filter Search" class="form-control serarch-filter-input m-3 me-0" id="serarch-filter-input" fdprocessedid="bxkoib">
</div>
                        <div class="card w-100">
                            <div class="">

                                <!-- Button trigger modal -->
                                

                                <!-- <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#exampleModal">
                                    Add </button> -->

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog " role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="<%$base_url%>addbom" method="POST">
                                                    <div class="row">
                                                        <div class="col-lg-12">

                                                            <div class="form-group">
                                                                <label> item part </label><span class="text-danger">*</span>
                                                                <select class="form-control select2" name="child_part_id" style="width: 100%;">
                                                                    <%foreach from=$child_part_list item=c1%>
                                                                        <option value="<%$c1->id%>">
                                                                            <%$c1->part_number%>/<%$c1->part_description%>
                                                                        </option>
                                                                    <%/foreach%>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="po_num">Quantity</label><span class="text-danger">*</span>
                                                                <input type="number" name="quantity" required class="form-control" id="exampleInputEmail1" placeholder="Enter Quantity" aria-describedby="emailHelp">
                                                                <input type="hidden" name="customer_part_id" value="<%$customer[0]->id%>" required class="form-control" id="exampleInputEmail1" placeholder="Enter Quantity" aria-describedby="emailHelp">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                           
                            <div class="">
                                <table id="bom_part" class="table table-striped w-100">
                                    <thead>
                                        <tr>
                                            <!-- <th>Sr. No.</th>
                                            <th>Customer Part Number</th> -->
                                            <th> Part Number</th>
                                            <th>Part Description</th>
                                            <th>Details</th>
                                            <%if $entitlements.isSheetMetal neq null%>
                                             <th>Operations BOM</th>
                                             <%/if%> 
                                             <%if $entitlements.isPlastic neq null%>
                                            <th>Deflashing BOM</th>
                                            <%/if%>
                                            <th>Customer Subcon bom </th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        <%if $customer_part%>
                                            <%assign var="i" value=1%>
                                            <%foreach from=$customer_part item=c%>
                                                <%if $customer_id == $c->customer_id%>
                                                    <tr>
                                                        <!-- <td><%$i%></td> -->
                                                        <td><%$c->part_number%></td>
                                                        <td><%$c->part_description%></td>
                                                        <td><a href="<%$base_url%>bom_by_id/<%$c->id%>" class="btn btn-info">RM BOM</a></td>
                                                        <%if $entitlements.isSheetMetal neq null%>
                                                            <td><a href="<%$base_url%>operations_bom/<%$c->id%>" class="btn btn-danger">Operations BOM</a></td>
                                                        <%/if%> 
                                                        <%if $entitlements.isPlastic neq null%>
                                                        <td><a href="<%$base_url%>deflashing_bom/<%$c->id%>" class="btn btn-success">Operations BOM</a></td>
                                                        <%/if%>
                                                        <td><a href="<%$base_url%>subcon_bom/<%$c->id%>" class="btn btn-warning">Subcon BOM</a></td>
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
    <script src="<%$base_url%>/public/js/planning_and_sales/bom_parts.js"></script>
