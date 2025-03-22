<div style="width: 1500px;" class="wrapper">
    <div class="content-wrapper">
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
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-lg-1">
                                        <a readonly href="<?php echo base_url('new_po_list_supplier'); ?>" type="text" class="btn btn-dark mt-3" required>
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
                                            <th>Type</th>
                                            <th>PO Number</th>
                                            <th>PO Date</th>
                                            <th>Created Date</th>
                                            <th>Download PDF PO</th>
                                            <th>View PO Details</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Type</th>

                                            <th>PO Number</th>
                                            <th>PO Date</th>
                                            <th>Created Date</th>
                                            <th>Download PDF PO</th>
                                            <th>View PO Details</th>
                                            <th>Status</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>

                                        <?php
                                        $i = 1;
                                        if ($new_po) {
                                            foreach ($new_po as $s) {
                                        ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php  if(empty($s->process_id))
                                                    {   echo "Normal PO";
                                                    }
                                                    else
                                                    {   echo "Subcon PO";
                                                    }; ?></td>
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
                                                    <td><a href="<?php echo base_url('view_new_po_by_id/') . $s->id ?>" class="btn btn-primary" href="">PO Details</a></td>
                                                    <td>
                                                        <?php 
                                                       
                                                       if ($s->expiry_po_date > date('Y-m-d')) {
                                                               $expired =  "yes";
                                                       } else {
                                                               // echo "no";
                                                       }
                                                        
                                                        if ($expired == "no") {
                                                            echo $statusNew  = "Expired";
                                                    } else if ($s->status == "accpet") {
                                                            echo $statusNew  = "Released";
                                                    } else {
                                                            echo $s->status;
                                                    }
                                                        ?>
                                                    </td>
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