<div  class="wrapper">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Rejected PO</h1>
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
                                            <th>Download PDF PO</th>
                                            <th>Status</th>
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
                                            <th>Status</th>
                                            <th>View PO Details</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>

                                        <?php
                                        $i = 1;
                                        if ($new_po) {
                                            foreach ($new_po as $s) {
                                                if ($new_po[0]->expiry_po_date < date('Y-m-d')) {
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
                                                    <td><?php echo $s->status; ?></td>

                                                    <td><a href="<?php echo base_url('view_new_po_by_id/') . $s->id ?>" class="btn btn-primary" href="">PO Details</a></td>

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