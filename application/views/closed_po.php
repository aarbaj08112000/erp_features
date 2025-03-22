<div style="width: 100%" class="wrapper">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Closed PO</h1>
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
                        <div class="card">
                           <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>PO Number</th>
                                            <th>PO Date</th>
                                            <th>Created Date</th>
                                            <th>Remark</th>
                                            <th>Download PDF PO</th>
                                            <th>View PO Details</th>
                                        </tr>
                                    </thead>
                                     <tbody>

                                        <?php
                                        $i = 1;
                                        if ($new_po) {
                                            foreach ($new_po as $s) {
                                        ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $s->po_number; ?></td>
                                                    <td><?php echo $s->po_date; ?></td>
                                                    <td><?php echo $s->created_date; ?></td>
                                                    <td><?php echo $s->closed_remark; ?></td>
                                                    <td>
                                                       <a href="<?php echo base_url('download_my_pdf/') . $s->id ?>" class="btn btn-primary" href="">Download</a>
                                                    </td>
                                                    <td><a href="<?php echo base_url('view_new_po_by_id/') . $s->id ?>" class="btn btn-primary" href="">PO Details</a></td>
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