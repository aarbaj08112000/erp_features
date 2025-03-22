<div class="wrapper">
    <div class="content-wrapper" >
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Supplier Part Price </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('Dashboard'); ?>">Home</a></li>
                            <li class="breadcrumb-item active">item part List</li>
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
                        <div class="card">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Action</th>
                                            <th>Revision Number</th>
                                            <th>Revision Remark</th>
                                            <th>Revision Date</th>
                                            <th>Part Number</th>
                                            <th>Part Description</th>
                                            <th>Tax Structure</th>
                                            <th>With In State</th>
                                            <th>Supplier</th>
                                            <th>Part Price</th>
                                            <th>Quotation Document </th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $i = 1;
                                        if ($child_part_list) {
                                            foreach ($child_part_list as $poo) {

                                                $po = $poo->po;
                                                if ($po[0]->admin_approve == "no") {
                                                    $supplier_data = $poo->supplier_data;
                                                    $uom_data = $poo->uom_data;
                                                    $gst_structure2 = $poo->gst_structure2;
                                        ?>

                                                    <tr>

                                                        <td><?php echo $i ?></td>
                                                        <td>
                                                            <button type="submit" data-toggle="modal" class="btn btn-sm btn-primary" data-target="#exampleModaledit2<?php echo $i ?>"> <i class="fas fa-edit"></i></button>
                                                            <div class="modal fade" id="exampleModaledit2<?php echo $i ?>" tabindex=" -1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog " role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">Approve Price </h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form action="<?php echo base_url('updatechildpart_supplier_admin') ?>" method="POST" enctype='multipart/form-data'>
                                                                                <div class="row">
                                                                                    <div class="col-lg-12">

                                                                                        <input value="<?php echo $po[0]->id ?>" type="hidden" name="id" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Customer Name">

                                                                                        <div class="form-group">
                                                                                            <label for="po_num">Are You Sure Want to Approve this Price ? </label><span class="text-danger">*</span>
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label for="po_num">Part Number </label><span class="text-danger">*</span>
                                                                                            <input type="text" value="<?php echo $po[0]->part_number  ?>" name="upart_number" readonly class="form-control" placeholder="Enter Part Number.">
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label for="po_num">Part Price </label><span class="text-danger">*</span>
                                                                                            <input type="text" value="<?php echo $po[0]->part_rate  ?>" name="upart_desc"  required class="form-control" id="exampleInputEmail1">
                                                                                            <input type="hidden" value="<?php echo $po[0]->id  ?>" name="id"  required class="form-control" id="exampleInputEmail1" >
                                                                                        </div>


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



                            </td>
                            <td><?php echo $po[0]->revision_no ?></td>
                            <td><?php echo $po[0]->revision_remark ?></td>
                            <td><?php echo $po[0]->revision_date ?></td>
                            <td><?php echo $po[0]->part_number ?></td>
                            <td><?php echo $po[0]->part_description ?></td>
                            <td><?php echo $gst_structure2[0]->code ?></td>
                            <td><?php echo $supplier_data[0]->with_in_state ?></td>
                            <td><?php echo $supplier_data[0]->supplier_name ?></td>
                            <td><?php echo $po[0]->part_rate ?></td>
                            <td>
                                <?php
                                if (!empty($po[0]->quotation_document)) 
                                { ?>
                                    <a href="<?php echo base_url('documents/') . $po[0]->quotation_document; ?>" download>Download </a>
                                <?php
                                }
                                ?>
                            </td>



                            </tr>
                <?php
                                                    $i++;
                                                }
                                            }
                                        }
                ?>
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