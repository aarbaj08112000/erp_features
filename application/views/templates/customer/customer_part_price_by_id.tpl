<div class="wrapper container-xxl flex-grow-1 container-p-y">
    <!-- Navbar -->

    <!-- /.navbar -->

    <!-- Main Sidebar Container -->

 

    <nav aria-label="breadcrumb">
      <div class="sub-header-left pull-left breadcrumb">
        <h1>
          Planning & Sales
          <a hijacked="yes" href="<%$base_url%>customer_master" class="backlisting-link" title="Back to Issue Request Listing" >
            <i class="ti ti-chevrons-right" ></i>
            <em >Customer Master</em></a>
        </h1>
        <br>
        <span >Customer Part Price</span>
      </div>
    </nav>
    <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5">
        <button type="button" class="btn btn-seconday float-left" data-bs-toggle="modal" data-bs-target="#add_customer_part">
                                    Add </button>
      <button class="btn btn-seconday" type="button" id="downloadCSVBtn" title="Download CSV"><i class="ti ti-file-type-csv"></i></button>
      <button class="btn btn-seconday" type="button" id="downloadPDFBtn" title="Download PDF"><i class="ti ti-file-type-pdf"></i></button>
      <a class="btn btn-seconday" href="<%base_url('customer_master')%>" id="downloadPDFBtn" title="Back To 
Customer Master"><i class="ti ti-arrow-left"></i></a>
      
    </div>

    <div class="w-100">
<input type="text" name="reason" placeholder="Filter Search" class="form-control serarch-filter-input m-3 me-0" id="serarch-filter-input" fdprocessedid="bxkoib">
</div>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper w-100">
        <!-- Content Header (Page header) -->
       
        <!-- Main content -->
        <section class="content">
            <div class="">
                <div class="row">
                    <div class="col-12">

                        <!-- /.card -->

                        <div class="card">
                            <div class="">
                                
                                <!-- Button trigger modal -->
                               <%* <a href="<%$base_url%>customer_master" class="btn btn-danger ">
                                    Back </a>
                                <br>
                                <br> *%>
                                
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="add_customer_part" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add </h5>
                                            <button type="button" class="close btn-close" data-bs-dismiss="modal" aria-label="Close">
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="<%$base_url%>add_customer_price" method="POST" enctype='multipart/form-data' id="add_customer_price" class="add_customer_price custom-form">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label for="po_num">Select Customer Name / Customer Code / Part Number / Description  </label><span class="text-danger">*</span>
                                                            <select name="customer_master_id" id="" class="from-control select2 required-input">
                                                                <%if $customer_part%>
                                                                    <%foreach from=$customer_part item=c%>
                                                                        <%if $customer_id == $c->customer_id%>
                                                                            <option value="<%$c->id%>"><%$customer[$c->customer_id][0]->customer_name%>/<%$customer[$c->customer_id][0]->customer_code%>/<%$c->part_number%>/<%$c->part_description%></option>
                                                                        <%/if%>
                                                                    <%/foreach%>
                                                                <%/if%>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="po_num">Part Rate </label><span class="text-danger">*</span>
                                                            <input type="text" step="any" name="rate"  class="required-input form-control onlyNumericInput" id="exampleInputEmail1" placeholder="Enter Part Rate" aria-describedby="emailHelp">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="po_num">Revision Number </label><span class="text-danger">*</span>
                                                            <input type="text" name="revision_no"  class="form-control required-input onlyNumericInput" id="exampleInputEmail1" placeholder="Enter Revision Number" aria-describedby="emailHelp">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="po_num">Revision Date</label><span class="text-danger">*</span>
                                                            <input type="date" name="revision_date"  class="form-control required-input" id="exampleInputEmail1" placeholder="Enter Revision Date" aria-describedby="emailHelp">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="po_num">Revision Remark</label><span class="text-danger">*</span>
                                                            <input type="text" name="revision_remark"  class="required-input form-control" id="exampleInputEmail1" placeholder="Enter Revision Remark" aria-describedby="emailHelp">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label for="po_num">Price Uploading Document</label>
                                                            <input type="file" name="uploading_document" class="form-control" id="exampleInputEmail1" placeholder="Enter Price Uploading Document" aria-describedby="emailHelp">
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>


                            <!-- /.card-header -->
                            <div class="w-100">
                                <table id="example1" class="table  table-striped">
                                    <thead>
                                        <tr>
                                            <!--<th>Sr. No.</th> -->
                                            <th style="display: none">Id</th>
                                            <th>Add Revision</th>
                                            <th>Revision Number</th>
                                            <th>Revision Date</th>
                                            <th>Revision Remark</th>
                                            <th>Customer Name</th>
                                            <th>Part Number</th>
                                            <th>Part Description</th>
                                            <th>Part Rate</th>
                                            <th>Price Supporting Document </th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                        <%assign var="i" value=1%>

                                        <%if $customer_part_rate%>
                                            <%foreach from=$customer_part_rate item=poo%>
                                                <%if $customer_data[$po[$poo->customer_master_id][0]->customer_id][0]->id == $customer_id%>
                                                
                                                    <tr>
                                                        <!-- <td><%$i%></td> -->
                                                        <td style="display: none"><%defaultDateFormat($customer_part_rate_data[$poo->customer_master_id][0]->revision_date)%></td>
                                                        <td>
                                                            <a type="submit" data-bs-toggle="modal" class=" add-revision" data-value="<%base64_encode(json_encode($customer_part_rate_data[$poo->customer_master_id][0]))%>" data-bs-target="#revision_part" title="Add Revision"><i class="ti ti-square-rounded-plus"></i></a>
                                                            <a href="<%$base_url%>view_part_rate_history/<%$poo->customer_master_id%>" class=" btn-sm" title="history"><i class="ti ti-history"></i></a>
                                                        
                                                        </td>
                                                        <td><%$customer_part_rate_data[$poo->customer_master_id][0]->revision_no%></td>
                                                        <td><%defaultDateFormat($customer_part_rate_data[$poo->customer_master_id][0]->revision_date)%></td>
                                                        <td><%$customer_part_rate_data[$poo->customer_master_id][0]->revision_remark%></td>
                                                       
                                                        <td><%$customer_data[$po[$poo->customer_master_id][0]->customer_id][0]->customer_name%></td>
                                                        <td><%$po[$poo->customer_master_id][0]->part_number%></td>
                                                        <td><%$po[$poo->customer_master_id][0]->part_description%></td>
                                                        <td><%$customer_part_rate_data[$poo->customer_master_id][0]->rate%></td>
                                                        <td>
                                                            <%if $customer_part_rate_data[$poo->customer_master_id][0]->uploading_document%>
                                                                <a download href="<%$base_url%>documents/<%$customer_part_rate_data[0]->uploading_document%>" class="btn btn-sm btn-primary">Download</a>
                                                            <%/if%>
                                                        </td>
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
</div>

<div class="modal fade" id="revision_part" tabindex=" -1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update Operation</h5>
            <button type="button" class="close btn-close" data-bs-dismiss="modal" aria-label="Close">
            </button>
        </div>
        <div class="modal-body">
            <form action="<%$base_url%>updatecustomerpartprice" method="POST" enctype='multipart/form-data' id="updatecustomerpartprice" class="updatecustomerpartprice custom-form">
                <div class="row">
                    <div class="col-lg-6">
                        <input value="<%$po[$poo->customer_master_id][0]->id%>" type="hidden" name="id" required class="form-control" id="customer_master_id_1" aria-describedby="emailHelp" placeholder="Customer Name">
                        <div class="form-group">
                            <label for="po_num">Part Number </label><span class="text-danger">*</span>
                            <input type="text" readonly value="" name="upart_number"  class="form-control required-input" id="part_number" placeholder="Enter Part Number" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="po_num">Part Description </label><span class="text-danger">*</span>
                            <input type="text" readonly value="" name="upart_desc"  class="form-control required-input" id="part_description" placeholder="Enter Part Description" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="po_num">Part Rate </label><span class="text-danger">*</span>
                            <input type="text" name="rate" step="any"  class="form-control required-input onlyNumericInput" id="rate" placeholder="Enter Part Rate" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="po_num">Revision Date </label><span class="text-danger">*</span>
                            <input type="date" value="<%$po[0]->revision_date%>" name="revision_date"  class="form-control required-input" id="revision_date" placeholder="Enter Revision Date" aria-describedby="emailHelp">
                            <input type="hidden" value="<%$customer_part_rate_data[$poo->customer_master_id][0]->customer_master_id%>" name="customer_master_id" required class="form-control" id="customer_master_id_2" placeholder="Enter Part Rate" aria-describedby="emailHelp">
                            <input type="hidden" value="<%$customer_part_rate_data[$poo->customer_master_id][0]->uploading_document%>" name="uploading_document" required class="form-control" id="uploading_document" placeholder="Enter Part Rate" aria-describedby="emailHelp">
                            <input type="hidden" value="<%$customer_part_rate_data[$poo->customer_master_id][0]->customer_part_id%>" name="customer_part_id" required class="form-control" id="customer_part_id" placeholder="Enter Part Rate" aria-describedby="emailHelp">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="po_num">Revision Number </label><span class="text-danger">*</span>
                            <input type="text" value="<%$po[$poo->customer_master_id][0]->revision_no%>" name="revision_no"  class="form-control required-input onlyNumericInput" id="revision_no" placeholder="Enter Revision Number" aria-describedby="emailHelp">
                            <input type="hidden" value="<%$po[$poo->customer_master_id][0]->customer_id%>" name="customer_id" required class="form-control" id="customer_id" aria-describedby="emailHelp">
                            <input type="hidden" value="<%$po[$poo->customer_master_id][0]->customer_part_id%>" name="customer_part_id" required class="form-control" id="customer_part_id_2" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="po_num">Revision Remark </label><span class="text-danger">*</span>
                            <input type="text" name="revision_remark"  class="form-control required-input" id="revision_remark" placeholder="Enter Revision Remark" aria-describedby="emailHelp">
                        </div>
                    </div>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
        </form>
    </div>
</div>
</div>

<script src="<%$base_url%>/public/js/planning_and_sales/customer_part_price.js"></script>
