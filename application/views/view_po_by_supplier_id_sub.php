<div style="width: 1500px;" class="wrapper">
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
                        <h1>Purchase Orders</h1>
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
                                    <div class="col-lg-1">
                                        <a readonly href="<?php echo base_url('new_po_list_supplier_sub'); ?>" type="text" class="btn btn-danger mt-4" required>
                                            < Back </a>
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="">Supplier Name</label>
                                        <input readonly value="<?php echo $supplier_data[0]->supplier_name; ?>" type="text" class="form-control" required>
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="">Supplier Number</label>
                                        <input readonly value="<?php echo $supplier_data[0]->supplier_number; ?>" type="text" class="form-control" required>
                                    </div>
                                </div>
                                <h3 class="card-title"></h3>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>PO Number</th>
                                            <th>PO Date</th>
                                            <th>Created Date</th>
                                            <th>Download PDF PO</th>
                                            <th>View PO Details</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>PO Number</th>
                                            <th>PO Date</th>
                                            <th>Created Date</th>
                                            <th>Download PDF PO</th>
                                            <th>View PO Details</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>

                                        <?php
                                        $i = 1;
                                        if ($new_po_sub) {
                                            foreach ($new_po_sub as $s) {
                                                // print_r($m);
                                        ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $s->po_number; ?></td>
                                                    <td><?php echo $s->po_date; ?></td>
                                                    <td><?php echo $s->created_date; ?></td>


                                                    <td>
                                                        <?php
                                                        if ($s->status == "accpet") {
                                                        ?>
                                                            <a href="<?php echo base_url('download_my_pdf/') . $s->id ?>" class="btn btn-primary" href="">Download</a>

                                                        <?php
                                                        }
                                                        ?>
                                                    </td>
                                                    <td><a href="<?php echo base_url('view_new_po_by_id_sub/') . $s->id ?>" class="btn btn-primary" href="">PO Details</a></td>

                                                </tr>

                                        <?php
                                                $i++;
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