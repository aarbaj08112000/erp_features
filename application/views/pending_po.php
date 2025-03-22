<div class="wrapper">
    <!-- Navbar -->

    <!-- /.navbar -->

    <!-- Main Sidebar Container -->


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Pending PO</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('') ?>">Home</a></li>
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
                                <div class="row">
                                    
                                </div>
                                <h3 class="card-title"></h3>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Supplier Name</th>
                                            <th>PO Number</th>
                                            <th>PO Expiry Date</th>
                                            <th>PO Date</th>
                                            <th>Created Date</th>
                                            <th>Download PDF PO</th>
                                            <th>Status</th>
                                            <th>View PO Details</th>
                                            <th>Close PO</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>

                                        <?php
                                        $i = 1;
                                        if ($new_po) {
                                            // echo count($new_po);
                                            foreach ($new_po as $s) {

                                                // $child_part_data_new = $this->Crud->get_data_by_id("supplier", $s->supplier_id, "id");

                                                $child_part_data = $this->Crud->get_data_by_id("new_po", $s->po_number, "supplier_id");
                                                $supplier = $this->Crud->get_data_by_id("supplier", $s->supplier_id, "id");
                                                $s->expiry_po_date;
                                                // echo "<br>";
                                                // // print_r($m);
                                                $expired = "no";
                                                if ($s->expiry_po_date < date('Y-m-d')) {
                                                    // $expired =  "yes";
                                                    // echo $new_po[0]->expiry_po_date;
                                                    // echo "<br>";
                                                    // echo date('Y-m-d');
                                                } else {
                                                    // echo "no";

                                        ?>
                                                    <tr>
                                                        <td><?php echo $i; ?></td>
                                                        <!-- <td><?php echo $child_part_data_new->supplier_name; ?></td> -->
                                                        <td><?php echo $supplier[0]->supplier_name ?></td>
                                                        <td><?php echo $s->po_number; ?></td>
                                                        <td><?php echo $s->expiry_po_date; ?></td>
                                                        <td><?php echo $s->po_date; ?></td>
                                                        <td><?php echo $s->created_date; ?></td>
                                                        <td>
                                                            <?php
                                                            if ($s->status == "accept") {
                                                            ?>
                                                                <a href="<?php echo base_url('download_my_pdf/') . $s->id ?>" class="btn btn-primary" href="">Download</a>

                                                            <?php
                                                            }
                                                            ?>
                                                        </td>
                                                        <td><?php echo $s->status; ?></td>

                                                        <td><a href="<?php echo base_url('view_new_po_by_id/') . $s->id ?>" class="btn btn-primary" href="">PO Details</a></td>
                                                        <td>
                                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#edit<?php echo $i; ?>">
                                                                Close PO
                                                            </button>
                                                            <div class="modal fade" id="edit<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">Close PO</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form action="<?php echo base_url('close_po') ?>" method="POST" enctype="multipart/form-data">
                                                                                <div class="form-group">

                                                                                    <label for="">Are You Sure Want To Close <?php echo $s->po_number; ?> This PO? <span class="text-danger">*</span></label>
                                                                                    <input required value="<?php echo $s->id ?>" type="hidden" class="form-control" name="id">
                                                                                    <input required value="<?php echo $s->po_number ?>" type="hidden" class="form-control" name="po_number">
                                                                                </div>
                                                                                <div class="form-group">

                                                                                    <label for="">Remark<span class="text-danger">*</span></label>
                                                                                    <input required value="" placeholder="Enter Remark" type="text" class="form-control" class="form-control" name="remark">
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