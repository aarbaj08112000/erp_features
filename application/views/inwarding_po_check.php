<div style="width: 100%;" class="wrapper">
    <!-- Navbar -->

    <!-- /.navbar -->

    <!-- Main Sidebar Container -->


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" >
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>In Warding</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Customer</li>
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
                                <div class="row">
                                    <div class="col-lg-2">
                                            <div class="form-group">
                                                <form action="<?php echo base_url('inwarding_po_check'); ?>" method="POST">
                                                <label for="">Enter PO Number <span class="text-danger">*</span> </label>
                                                <input type="text" value="<?php echo $po_number;?>" name="po_number" class="form-control" required placeholder="Enter Valid PO Number : ">
                                            </div>

                                    </div>
                                    <div class="col-lg-2">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-success mt-4">Search</button>
                                            </div>
                                            </form>

                                    </div>
                                </div>
                               
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Customer Name</th>
                                            <th>Customer Code</th>
                                            <th>Customer Billing Address</th>
                                            <th>Customer Shifting Address</th>
                                            <th>GST Number</th>
                                            <th>State</th>
                                            <th>Payment Terms</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        if ($customers) {
                                            foreach ($customers as $t) {


                                        ?>

                                                <tr>
                                                    <td><?php echo $i ?></td>
                                                    <td><?php echo $t->customer_name ?></td>
                                                    <td><?php echo $t->customer_code ?></td>
                                                    <td><?php echo $t->billing_address ?></td>
                                                    <td><?php echo $t->shifting_address ?></td>
                                                    <td><?php echo $t->gst_number ?></td>
                                                    <td><?php echo $t->state ?></td>
                                                    <td><?php echo $t->payment_terms ?></td>

                                                    <td>
                                                        <button type="submit" data-toggle="modal" class="btn btn-sm btn-primary" data-target="#exampleModal2<?php echo $i ?>"> <i class="fas fa-edit"></i></button>

                                                        <div class="modal fade" id="exampleModal2<?php echo $i ?>" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Add Tool</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">



                                                                        <form action="<?php echo base_url('updateCustomer') ?>" method="POST">
                                                                            <div class="row">
                                                                                <div class="col-lg-12">

                                                                                    <div class="form-group">
                                                                                        <label for="customer_name">Customer Name</label><span class="text-danger">*</span>
                                                                                        <input value="<?php echo $t->customer_name ?>" readonly type="text" name="ucustomerName" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Customer Name">
                                                                                        <input value="<?php echo $t->id ?>" type="hidden" name="id" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Customer Name">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="customer_name">Customer Code</label><span class="text-danger">*</span>
                                                                                        <input value="<?php echo $t->customer_code ?>" readonly type="text" name="ucustomerCode" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Customer Code">
                                                                                    </div>
                                                                                    <!-- <div class="form-group">
                                                                                        <label for="customer_location">Customer Location</label><span class="text-danger">*</span>
                                                                                        <input type="text" value="<?php echo $t->billing_address ?>" name="ucustomerLocation" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Customer Location">
                                                                                    </div> -->


                                                                                    <div class="form-group">
                                                                                        <label for="customer_location">Customer billing address</label><span class="text-danger">*</span>
                                                                                        <input type="text" name="ubillingaddress" value="<?php echo $t->billing_address ?>" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Customer Billing Address">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="customer_location">Customer shifting address</label><span class="text-danger">*</span>
                                                                                        <input type="text" name="ushiftingAddress" value="<?php echo $t->shifting_address ?>" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Customer Shifting Address">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="customer_location">Add State</label><span class="text-danger">*</span>
                                                                                        <input type="text" name="ustate" required value="<?php echo $t->state ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Add State">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="customer_location">Add GST Number</label><span class="text-danger">*</span>
                                                                                        <input type="text" name="ugst_no" required value="<?php echo $t->gst_number ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Add GST Number">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="payment_terms">Payment Terms</label><span class="text-danger">*</span>
                                                                                        <input type="text" value="<?php echo $t->payment_terms ?>" name="upaymentTerms" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Payment Terms">
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
                                                        <!-- <button type="submit" data-toggle="modal" class="btn btn-sm btn-danger ml-4" data-target="#exampleModal3<?php echo $i ?>"> <i class="far fa-trash-alt"></i></button> -->
                                                        <!-- Button trigger modal -->
                                                        <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                                    Launch demo modal
                                                </button> -->

                                                        <!-- Modal -->
                                                        <div class="modal fade" id="exampleModal3<?php echo $i ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <form action="<?php echo base_url('delete') ?>" method="POST">

                                                                        <div class="modal-body">

                                                                            <input value="<?php echo $t->id; ?>" name="id" type="hidden" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Machine Name">
                                                                            <input value="customer" name="table_name" type="hidden" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Machine Name">

                                                                            Are you sure you want to delete
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                            <button type="submit" class="btn btn-danger">Delete </button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </td>
                                                </tr>
                                        <?php
                                                $i++;
                                            }
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Customer Name</th>
                                            <th>Customer Code</th>
                                            <th>Customer Billing Address</th>
                                            <th>Customer Shifting Address</th>
                                            <th>GST Number</th>
                                            <th>State</th>
                                            <th>Payment Terms</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
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