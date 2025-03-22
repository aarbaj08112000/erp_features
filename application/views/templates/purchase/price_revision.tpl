
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
                            <em>Supplier Part</em></a>
                    </h1>
                    <br>
                    <span>Part Revision</span>
                </div>
            </nav>
            <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5 listing-btn">
                <a title="Back To Supplier Part Price" class="btn btn-seconday" href="<%base_url('child_part_supplier_view')%>" type="button"><i class="ti ti-arrow-left"></i></a>
            </div>
            <div class="card p-0 mt-4">

                <!-- /.card-header -->
                <div class="">
                    <table class="table table-striped" style="border-collapse: collapse;" id="part_revision_view">
                    <thead>
                    <tr>
                        <!-- <th>Sr. No.</th> 
                        <th>Action</th>-->
                        <th>Revision Number</th>
                        <th>Revision Remark</th>
                        <th>Revision Date</th>
                        <th>Part Number</th>
                        <th>Part Description</th>
                        <th>Supplier</th>
                        <th>Part Price</th>
                        <th>Quotation Document </th>
                        <!-- <th>HSN Code</th>
                        <th>UOM</th>
                        <th>Safety/Buffer Stack</th>
                        <th>item part Type</th>
                        <th>Drawing</th>
                        <th>CAD File</th>
                        <th>Modal file</th> -->
                    </tr>
                </thead>
                <tbody>
                    <%assign var='i' value=0%>
                    <%if $child_part_list %>
                   
                        <%foreach from=$child_part_list item='poo'  %>

                    <tr>

                        <!-- <td>
                            <%$i %>
                        </td> 
                        <td>
                             <button type="submit" data-toggle="modal" class="btn btn-sm btn-primary" data-target="#exampleModaledit2<?php echo $i ?>"> <i class="fas fa-edit"></i></button> 
                             <a href="<?php echo base_url('price_revision/') . $poo->part_number; ?>" class="btn btn-primary btn-sm"> <i class="fas fa-history"></i></a>
                            <a href="<?php echo base_url(); ?>" class="btn btn-sm btn-primary">
                                        <i class="fas fa-history"></i>

                                    </a> 

                            <div class="modal fade" id="exampleModaledit2<%$i %>"
                                tabindex=" -1" role="dialog" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog " role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add
                                                Revision </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form
                                                action="<%base_url('updatechildpart_supplier') %>"
                                                method="POST" enctype='multipart/form-data'>
                                                <div class="row">
                                                    <div class="col-lg-12">

                                                        <input value="<%$poo->id %>"
                                                            type="hidden" name="id" required
                                                            class="form-control"
                                                            id="exampleInputEmail1"
                                                            aria-describedby="emailHelp"
                                                            placeholder="Customer Name">

                                                        <div class="form-group">
                                                            <label for="po_num">Part Number
                                                            </label><span
                                                                class="text-danger">*</span>
                                                            <input type="text"
                                                                value="<%$poo->part_number  %>"
                                                                name="upart_number" readonly
                                                                class="form-control"
                                                                placeholder="Enter Part Number.">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="po_num">Part Description
                                                            </label><span
                                                                class="text-danger">*</span>
                                                            <input type="text"
                                                                value="<%$poo->part_description %>"
                                                                name="upart_desc" readonly required
                                                                class="form-control"
                                                                id="exampleInputEmail1"
                                                                placeholder="Enter Part Description">
                                                        </div>
                                                       

                                                        <div class="form-group">
                                                            <label for="po_num">Revision Date
                                                            </label><span
                                                                class="text-danger">*</span>
                                                            <input type="date" readonly
                                                                value="<%date('Y-m-d') %>"
                                                                name="urevision_date" required
                                                                class="form-control"
                                                                id="exampleInputEmail1"
                                                                placeholder="Enter Part Price">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="po_num">Revision Number
                                                            </label><span
                                                                class="text-danger">*</span>
                                                            <input type="text" readonly
                                                                value="<%$poo->revision_no + 1 %>"
                                                                name="urevision_no" required
                                                                class="form-control"
                                                                id="exampleInputEmail1"
                                                                placeholder="Enter Safty/buffer stock"
                                                                aria-describedby="emailHelp">
                                                            <input type="hidden" readonly
                                                                value="<%$poo->supplier_id %>"
                                                                name="supplier_id" required
                                                                class="form-control"
                                                                id="exampleInputEmail1"
                                                                placeholder="Enter Safty/buffer stock"
                                                                aria-describedby="emailHelp">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="po_num">Revision Remark
                                                            </label><span
                                                                class="text-danger">*</span>
                                                            <input type="text" value=""
                                                                name="revision_remark" required
                                                                class="form-control"
                                                                id="exampleInputEmail1"
                                                                placeholder="Enter revision_remark"
                                                                aria-describedby="emailHelp">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="po_num">Part Price
                                                            </label><span
                                                                class="text-danger">*</span>
                                                            <input type="text" value=""
                                                                name="upart_rate" required
                                                                class="form-control"
                                                                id="exampleInputEmail1"
                                                                placeholder="Enter Part Price">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="po_num">Quotation
                                                                Document</label>
                                                            <input type="file"
                                                                name="quotation_document"
                                                                class="form-control"
                                                                id="exampleInputEmail1"
                                                                placeholder="Enter Revision Date"
                                                                aria-describedby="emailHelp">
                                                        </div>



                                                    </div>
                                                </div>



                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save
                                                changes</button>
                                        </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                            </div>



                            </td> -->
                            <td>
                                <%$poo->revision_no %>
                            </td>
                            <td>
                                <%$poo->revision_remark %>
                            </td>
                            <td>
                                <%defaultDateFormat($poo->revision_date) %>
                            </td>
                            <td>
                                <%$poo->part_number %>
                            </td>
                            <td>
                                <%$poo->part_description %>
                            </td>
                            <td>
                                <%$poo->supplier_name %>
                            </td>
                            <td>
                                <%$poo->part_rate %>
                            </td>
                            <td>
                                <%if (!empty($poo->quotation_document)) %>
                                <a href="<%base_url('documents/')%><%$poo->quotation_document %>"
                                    download>Download </a>
                                <%else%>
                                    --
                                <%/if%>
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
    <script src="<%$base_url%>public/js/purchase/part_revision_view.js"></script>
<!-- /.content-wrapper -->