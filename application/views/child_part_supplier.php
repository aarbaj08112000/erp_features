<div class="wrapper">
    <div class="content-wrapper" >
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Supplier Part Price</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Ttem part List</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <!-- /.card -->

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">

                                </h3>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary float-left" data-toggle="modal" data-target="#exampleModal">
                                    Add </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add Details</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="<?php echo base_url('addchildpart_supplier') ?>" method="POST" enctype='multipart/form-data' s>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label> Supplier List </label><span class="text-danger">*</span>
                                                                <select required class="form-control select2" name="supplier_id" style="width: 100%;">
                                                                    <option value="">Select</option>
                                                                    <?php
                                                                    foreach ($supplier_list as $c) {
                                                                    ?>
                                                                        <option value="<?php echo $c->id; ?>"><?php echo $c->supplier_name; ?></option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label> Item Part </label><span class="text-danger">*</span>
                                                                <select required class="form-control select2" name="child_part_id" style="width: 100%;">
                                                                    <option value="">Select</option>
                                                                    <?php
                                                                    if ($child_part_list) {
                                                                        foreach ($child_part_list as $c) {
                                                                    ?>
                                                                            <option value="<?php echo $c->id; ?>"><?php echo $c->part_number.' / '.$c->part_description.'/'.$c->uom_name; ?></option>
                                                                    <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Tax Structure </label><span class="text-danger">*</span>
                                                                <select required class="form-control select2" name="gst_id" style="width: 100%;">
                                                                    <option value="">Select</option>
                                                                    <?php
                                                                    foreach ($gst_structure as $c) {
                                                                    ?>
                                                                        <option value="<?php echo $c->id; ?>"><?php echo $c->code; ?></option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="po_num">Part Price </label><span class="text-danger">*</span>
                                                                <input type="text" value="" name="upart_rate" required class="form-control" id="exampleInputEmail1" placeholder="Enter Part Price">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="po_num">Revision Number</label><span class="text-danger">*</span>
                                                                <input type="text" name="revision_no" value="1" required class="form-control" id="exampleInputEmail1" placeholder="Enter Revision Number" aria-describedby="emailHelp">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="po_num">Revision Remark</label><span class="text-danger">*</span>
                                                                <input type="text" name="revision_remark" required class="form-control" id="exampleInputEmail1" placeholder="Enter Revision Remark" aria-describedby="emailHelp">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="po_num">Revision Date</label><span class="text-danger">*</span>
                                                                <input type="date" name="revision_date" required class="form-control" id="exampleInputEmail1" placeholder="Enter Revision Date" aria-describedby="emailHelp">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="po_num">Quotation Document</label>
                                                                <input type="file" name="quotation_document" class="form-control" id="exampleInputEmail1" placeholder="Enter Revision Date" aria-describedby="emailHelp">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                                    </div>
                                            </div>
                                            </form>

                                        </div>

                                    </div>
                                </div>
                            </div>
                    </div>
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