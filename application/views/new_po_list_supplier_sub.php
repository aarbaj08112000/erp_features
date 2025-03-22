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
                        <h1>Select Supplier For Subcon PO</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('') ?>">Home</a></li>
                            <li class="breadcrumb-item active">Supplier List</li>
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
                                <h3 class="card-title"></h3>
                                <!-- Button trigger modal -->
                                <!-- <button type="button" class="btn btn-primary float-left" data-toggle="modal" data-target="#exampleModal">
                                    Add Supplier</button> -->

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog " role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add Supplier</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <form action="<?php echo base_url('addSupplier') ?>" method="POST">
                                                            <div class="form-group">
                                                                <label for="machine_name">Supplier Name</label><span class="text-danger">*</span>
                                                                <input type="text" name="supplierName" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Supplier Name">

                                                            </div>
                                                            <div class="form-group">
                                                                <label for="machine_name">Supplier Code</label><span class="text-danger">*</span>
                                                                <input type="text" name="supplierNumber" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Supplier Number">

                                                            </div>
                                                            <div class="form-group">
                                                                <label for="machine_name">Supplier Location</label><span class="text-danger">*</span>
                                                                <input type="text" name="supplierlocation" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Supplier Location">

                                                            </div>
                                                            <div class="form-group">
                                                                <label for="machine_name">Supplier Mobile Number</label><span class="text-danger">*</span>
                                                                <input type="number" name="supplierMnumber" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Supplier Mobile Number">

                                                            </div>
                                                    </div>
                                                    <div class="col-lg-6">

                                                        <div class="form-group">
                                                            <label for="machine_name">Supplier Email</label><span class="text-danger">*</span>
                                                            <input type="email" name="supplierEmail" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Supplier Email">

                                                        </div>

                                                        <div class="form-group">
                                                            <label for="customer_location">Add State</label><span class="text-danger">*</span>
                                                            <input type="text" name="state" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Add State">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="customer_location">Add GST Number</label><span class="text-danger">*</span>
                                                            <input type="text" name="gst_no" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Add GST Number">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="payment_terms">Payment Terms</label><span class="text-danger">*</span>
                                                            <input type="number" min="0" name="paymentTerms" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Payment Terms">
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
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Supplier Name</th>
                                            <th>Supplier Number</th>
                                            <th>Supplier Location</th>

                                            <th>View PO</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Supplier Name</th>
                                            <th>Supplier Number</th>
                                            <th>Supplier Location</th>

                                            <th>View PO</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>

                                        <?php
                                        $i = 1;
                                        if ($supplier_list) {
                                            foreach ($supplier_list as $s) {

                                        ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $s->supplier_name; ?></td>
                                                    <td><?php echo $s->supplier_number; ?></td>
                                                    <td><?php echo $s->location; ?></td>


                                                    <td><a href="<?php echo base_url('view_po_by_supplier_id_sub/') . $s->id ?>" class="btn btn-primary" href="">View PO</a></td>

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