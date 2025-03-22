<div class="wrapper">

    <!-- /.content-wrapper -->

    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                <nav aria-label="breadcrumb">
                    <div class="sub-header-left pull-left breadcrumb">
                        <h1>
                            Purchase
                            <a hijacked="yes" href="#stock/issue_request/index" class="backlisting-link"
                                title="Back to Issue Request Listing">
                                <i class="ti ti-chevrons-right"></i>
                                <em>Customer Routing </em></a>
                        </h1>
                        <br>
                        <span>All Item Parts</span>
                    </div>
                </nav>
                <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5 listing-btn">
                    <button title="Add Routing" class="btn btn-seconday" type="button" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">Add Routing</button>
                    <a title="Back To Customer Routing" class="btn btn-seconday"
                        href="http://localhost/extra_work/erp_converted/child_part_supplier_view" type="button"><i
                            class="ti ti-arrow-left"></i></a>
                </div>
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="javascript:void(0)" method="POST" class="addrouting_customer_subcon_form custom-form" 
                                    enctype='multipart/form-data' >
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label> Select Input item part </label><span
                                                    class="text-danger">*</span>
                                                <select class="form-control select2 required-input" name="routing_part_id"
                                                    style="width: 100%;">
                                                    <%if ($item_arr) %>
                                                        <%foreach from=$item_arr item='c' %>
                                                            <option value="<%$c['id'] %>">
                                                                <%$c['part_number'] %>
                                                            </option>
                                                        <%/foreach%>
                                                    <%/if%>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="po_num">Qty</label><span class="text-danger">*</span>
                                                <input type="text" step="any" value="" name="qty" 
                                                    class="form-control required-input onlyNumericInput" id="exampleInputEmail1"
                                                    placeholder="Enter Qty">
                                                <input type="hidden" value="<%$part_id %>" name="part_id"
                                                    required class="form-control" id="exampleInputEmail1"
                                                    placeholder="Enter Part Price">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card p-0 mt-4">

                    <!-- /.card-header -->
                    <div class="">
                        <table class="table table-striped" style="border-collapse: collapse;"
                            id="add_routing_customer_view">
                            <thead>
                                <tr>
                                    <!-- <th>Sr. No.</th> -->
                                    <th>Output Part Number</th>
                                    <th>Output Part Description</th>
                                    <th>Input Part Number</th>
                                    <th>Input Part Description</th>
                                    <th>Input Part Qty</th>
                                </tr>
                            </thead>
                            <tbody>
                                <%assign var='i' value=1%>
                                    <%if ($routing) %>
                                        <%foreach from=$routing item='poo' %>
                                            <tr>
                                                <!-- <td>
                                                    <%$i %>
                                                </td> -->
                                                <td>
                                                    <%$poo->out_partNumber %>
                                                </td>
                                                <td>
                                                    <%$poo->out_partDesc %>
                                                </td>
                                                <td>
                                                    <%$poo->in_partNumber %>
                                                </td>
                                                <td>
                                                    <%$poo->in_partDesc %>
                                                </td>
                                                <td>
                                                    <%$poo->qty %>
                                                </td>
                                            </tr>
                                        <%assign var='i' value=$i+1%>
                                        <%/foreach%>
                                    <%/if%>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>


            <!-- Main content -->

        </div>
        <script>
            var base_url = <%$base_url|json_encode %> ;
        </script>
        <script src="<%$base_url%>public/js/purchase/add_routing_customer_view.js"></script>
<!-- /.content-wrapper -->