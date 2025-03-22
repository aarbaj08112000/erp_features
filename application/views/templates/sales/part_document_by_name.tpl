<%if ($entitlements['isPLMEnabled']) %>
    <div class="wrapper container-xxl flex-grow-1 container-p-y ">
   
    <!-- Main Sidebar Container -->


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <nav aria-label="breadcrumb">
            <div class="sub-header-left pull-left breadcrumb">
                <h1>
                    Purchase
                    <a hijacked="yes" href="#stock/issue_request/index" class="backlisting-link" title="Back to Issue Request Listing">
                        <i class="ti ti-chevrons-right"></i>
                        <em>Customer Part</em></a>
                </h1>
                <br>
                <span>Customer Part Documents Details </span>
            </div>
        </nav>
        <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5 listing-btn">
        	<button type="button" class="btn btn-seconday float-left" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                Add </button>
            <a title="Back To 
			Customer Part Documents" class="btn btn-seconday" href="<%base_url('customer_part_documents/')%><%$customer_id%>" type="button"><i class="ti ti-arrow-left"></i></a>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="">
                <div class="row">
                    <div class="col-12">
                        <!-- /.card -->
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                            	<div class="tgdp-rgt-tp-sect">
                                        <p class="tgdp-rgt-tp-ttl">Part Name</p>
                                        <p class="tgdp-rgt-tp-txt">
                                            <%$customer_part[0]->part_number %>
                                        </p>
                                </div>
                                <div class="tgdp-rgt-tp-sect">
                                        <p class="tgdp-rgt-tp-ttl">Part Description</p>
                                        <p class="tgdp-rgt-tp-txt">
                                            <%$customer_part[0]->part_description %>	
                                        </p>
                                </div>

                                <div class="col-lg-1">
                                <br>
                                </div>
                               
                                <!-- Button trigger modal -->
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="<%base_url('add_customer_document') %>" method="POST" enctype='multipart/form-data'id="add_customer_document" class="add_customer_document custom-form">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label for="po_num">Select Customer Name / Customer Code / Part Number / Description </label><span class="text-danger">*</span>
                                                            <select name="customer_id" id="" class="from-control select2 required-input" style="width: 100%">
                                                            	<%foreach from=$customer_arr item=c%>
                                                                        <option value="<%$c->id%>"><%$c->customer_name%>/<%$c->customer_code%>/<%$c->part_number%>/<%$c->part_description%></option>
                                                                <%/foreach%>
                                                            </select>

                                                        </div>
                                                        <div class="form-group">
                                                            <label for="po_num">Document Type </label><span class="text-danger">*</span>
                                                            <select name="type" id="" class="form-control required-input">
                                                                <option value="<%$type %>"><%$type %></option>
                                                                <!-- <option value="PPAP">PPAP</option>
                                                                <option value="QUALITY">QUALITY</option> -->
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="po_num">Document Name</label>
                                                            <input type="text" name="document_name" class="form-control" id="exampleInputEmail1" placeholder="Enter Document Name" aria-describedby="emailHelp">
                                                            <input type="hidden" name="customer_master_id" value="<%$part_id %>" class="form-control" id="exampleInputEmail1" placeholder="Enter Document Name" aria-describedby="emailHelp">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="po_num">Document <span class="text-danger">*</span></label>
                                                            <input type="file" name="document"  class="form-control required-input" id="exampleInputEmail1" placeholder="Enter Part Description" aria-describedby="emailHelp">
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
                        </div>
                    </div>

                        <div class="card p-0 mt-4">

                            <!-- /.card-header -->
                            <div class="">
                                <table id="example1" class="table scrollable table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Document Type</th>
                                            <th>Document Name</th>
                                            <th>Download</th>
                                            <th>Update</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       	<%assign var="i" value=0 %>
                                        <%if ($customer_part_doc) %>
                                            <%foreach from=$customer_part_doc item=poo %>
                                                <%if ($customer_data[0]->id == $customer_id) %>

                                                        <tr>
                                                            <td><%$i+1 %></td>
                                                            <td><%$type %></td>
                                                            <td><%$poo->document_name %></td>
                                                            <td><%if ($poo->document != "") %>
                                                                    <a download href="<%base_url('documents/')%><%$poo->document %>" id="" class=" remove_hoverr " title="Download"><i class="ti ti-download"></i></a>
                                                               <%/if%>
                                                            </td>
                                                            <td>
                                                                <a type="button" class="" data-bs-toggle="modal" data-bs-target="#edit<%$i%>">
                                                                    <i class='ti ti-edit'></i>
                                                                </a>

                                                                <!-- edit Modal -->
                                                                <div class="modal fade" id="edit<%$i%>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="exampleModalLabel">Update</h5>
                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <form action="<%base_url('update_part_document_individual') %>" method="POST" enctype="multipart/form-data" id="update_part_document_individual<%$i%>" class="update_part_document_individual<%$i%> update_part_document_individual custom-form">
                                                                                    <div class="form-group">
                                                                                        <label for="po_num">Document <span class="text-danger">*</span></label>
                                                                                        <input type="file" name="document"  class="form-control required-input" id="exampleInputEmail1" placeholder="Enter Part Description" aria-describedby="emailHelp">
                                                                                        <input type="hidden" name="id" value="<%$poo->id %>">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="po_num">Document Name</label>
                                                                                        <input type="text" name="document_name" value="<%$poo->document_name %>" class="form-control" id="exampleInputEmail1" placeholder="Enter Document Name" aria-describedby="emailHelp">
                                                                                        <input type="hidden" name="customer_id" value="<%$customer_id %>" class="form-control" id="exampleInputEmail1" placeholder="Enter Document Name" aria-describedby="emailHelp">
                                                                                    </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
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
    <%/if%>
    <!-- /.content-wrapper -->
    <script src="<%$base_url%>/public/js/planning_and_sales/part_document_by_name.js"></script>