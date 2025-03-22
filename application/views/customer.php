<div  class="wrapper">
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
                        <h1>Customer</h1>
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
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary float-left" data-toggle="modal" data-target="#exampleModal">
                                    Add Customer</button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content modal-lg">
                                            <div class="modal-header ">
                                                <h5 class="modal-title" id="exampleModalLabel">Add Customer</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="<?php echo base_url('addCustomer') ?>" method="POST">
                                                    <div class="row">
                                                        <div class="col-lg-12">

                                                            <div class="form-group">
                                                                <label for="customer_name">Customer Name</label><span class="text-danger">*</span>
                                                                <input type="text" name="customerName" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Customer Name">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="customer_name">Customer Code</label><span class="text-danger">*</span>
                                                                <input type="text" name="customerCode" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Customer Code">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="customer_location">Customer billing address</label><span class="text-danger">*</span>
                                                                <input type="text" name="customerLocation" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Customer Billing Address">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="customer_location">Customer Shipping address</label><span class="text-danger">*</span>
                                                                <input type="text" name="customerSaddress" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Customer Shipping Address">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="customer_location">Add State</label><span class="text-danger">*</span>
                                                                <input type="text" name="state" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Add State">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="customer_location">State No </label><span class="text-danger">*</span>
                                                                <input type="text" name="state_no" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Add State No">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="customer_location">Add GST Number</label><span class="text-danger">*</span>
                                                                <input type="text" name="gst_no" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Add GST Number">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="customer_location">Vendor code No</label><span class="text-danger">*</span>
                                                                <input type="text" name="vendor_code" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Add ">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="customer_location">PAN No</label><span class="text-danger">*</span>
                                                                <input type="text" name="pan_no" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Add ">
                                                            </div>
                                                            <!-- <div class="form-group">
                                                                <label for="customer_location">Bank Details </label><span class="text-danger">*</span>
                                                                <textarea type="text" name="bank_details" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Add "></textarea>
                                                            </div> -->


                                                            <!-- Example single danger button -->
                                                            <!-- <div class="form-group">
                                                                <label for="payment_terms">Payment Terms</label><span class="text-danger">*</span>
                                                                <input type="text" name="paymentTerms" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Payment Terms">
                                                            </div> -->

                                                            <div class="form-group">
                                                                <label for="payment_terms">Payment Terms</label><span class="text-danger">*</span>
                                                                <input type="number" min="0" name="paymentTerms" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Payment Terms">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="payment_terms">Pos</label><span class="text-danger">*</span>
                                                                <input type="text" name="pos" required class="form-control" aria-describedby="emailHelp" placeholder="Pos">
                                                            </div>
                                                            
                                                            <div class="form-group">
                                                                <label for="payment_terms">Address 1</label><span class="text-danger">*</span>
                                                                <input type="text" name="address1" required class="form-control" aria-describedby="emailHelp" placeholder="Address 1">
                                                            </div>
                                                            
                                                            <div class="form-group">
                                                                <label for="payment_terms">Location</label><span class="text-danger">*</span>
                                                                <input type="text" name="location" required class="form-control" aria-describedby="emailHelp" placeholder="Location">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="payment_terms">Pin</label><span class="text-danger">*</span>
                                                                <input type="text" name="pin" required class="form-control" aria-describedby="emailHelp" placeholder="Pin">
                                                            </div>
                                                        </div>


                                                        <!-- <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="max_reshaping_revision">Max Resharpening Revision</label><span class="text-danger">*</span>
                                                                <input type="text" class="form-control" name="maxResharpeningRevision" required id="exampleInputPassword1" placeholder="Max Resharpening Revision">
                                                            </div>


                                                            <div class="form-group">
                                                                <label for="fixture_number">
                                                                    Safety Stock
                                                                </label><span class="text-danger">*</span>
                                                                <input type="text" name="safetyStock" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Fixture Number">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="fixture_number">
                                                                    Defined Tool Life </label><span class="text-danger">*</span>
                                                                <input type="text" name="definedToolLife" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Fixture Number">
                                                                <input type="hidden" value="tool_without_insert" name="type" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Fixture Number">
                                                            </div>
                                                        </div> -->

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
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Customer Name</th>
                                            <th>Customer Code</th>
                                            <th>Customer Billing Address</th>
                                            <th>Customer Shipping Address</th>
                                            <th>GST Number</th>
                                            <th>State</th>
                                            <th>State No</th>
                                            <!-- <th>Bank Details </th> -->

                                            <th>Vendor Code </th>
                                            <th>Pan No</th>
                                            <th>Payment Terms</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Customer Name</th>
                                            <th>Customer Code</th>
                                            <th>Customer Billing Address</th>
                                            <th>Customer Shipping Address</th>
                                            <th>GST Number</th>
                                            <th>State</th>
                                            <th>State No</th>
                                            <!-- <th>Bank Details </th> -->
                                            <th>Vendor Code </th>
                                            <th>Pan No</th>
                                            <th>Payment Terms</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
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
                                                    <td><?php echo $t->state_no ?></td>

                                                    <!-- <td><?php echo $t->bank_details ?></td> -->
                                                    <td><?php echo $t->vendor_code ?></td>
                                                    <td><?php echo $t->pan_no ?></td>
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
                                                                                        <label for="customer_location">Customer Billing address</label><span class="text-danger">*</span>
                                                                                        <input type="text" name="ubillingaddress" value="<?php echo $t->billing_address ?>" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Customer Billing Address">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="customer_location">Customer Shipping address</label><span class="text-danger">*</span>
                                                                                        <input type="text" name="ushiftingAddress" value="<?php echo $t->shifting_address ?>" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Customer Shipping Address">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="customer_location">Add State</label><span class="text-danger">*</span>
                                                                                        <input type="text" name="ustate" required value="<?php echo $t->state ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Add State">
                                                                                    </div>
																					 <div class="form-group">
																						<label for="customer_location">State No</label><span class="text-danger">*</span>
																						<input type="text" name="state_no" required value="<?php echo $t->state_no ?>"class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Add State No">
																					</div>
                                                                                    <div class="form-group">
                                                                                        <label for="customer_location">Add GST Number</label><span class="text-danger">*</span>
                                                                                        <input type="text" name="ugst_no" required value="<?php echo $t->gst_number ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Add GST Number">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="payment_terms">Payment Terms</label><span class="text-danger">*</span>
                                                                                        <input type="text" value="<?php echo $t->payment_terms ?>" name="upaymentTerms" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Payment Terms">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="customer_location">Vendor code No</label><span class="text-danger">*</span>
                                                                                        <input type="text" value="<?php echo $t->vendor_code ?>" name="vendor_code" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Add ">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="customer_location">PAN No</label><span class="text-danger">*</span>
                                                                                        <input type="text" value="<?php echo $t->pan_no ?>" name="pan_no" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Add ">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="customer_location">Bank Details </label><span class="text-danger">*</span>
                                                                                        <textarea type="text" name="bank_details" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Add ">
                                                                                        <?php echo $t->bank_details ?>
                                                                                        </textarea>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="post">Pos</label><span class="text-danger">*</span>
                                                                                        <input type="text" value="<?php echo $t->pos ?>" name="pos" required class="form-control" aria-describedby="emailHelp" placeholder="Enter Pos">
                                                                                    </div>
                                                                                    
                                                                                    <div class="form-group">
                                                                                        <label for="address1">Address</label><span class="text-danger">*</span>
                                                                                        <input type="text" value="<?php echo $t->address1 ?>" name="address1" required class="form-control" aria-describedby="emailHelp" placeholder="Enter Address">
                                                                                    </div>
                                                                                    
                                                                                    <div class="form-group">
                                                                                        <label for="location">Location</label><span class="text-danger">*</span>
                                                                                        <input type="text" value="<?php echo $t->location ?>" name="location" required class="form-control" aria-describedby="emailHelp" placeholder="Enter Location ">
                                                                                    </div>
                                                                                    
                                                                                    <div class="form-group">
                                                                                        <label for="location">Pin</label><span class="text-danger">*</span>
                                                                                        <input type="text" value="<?php echo $t->pin ?>" name="pin" required class="form-control" aria-describedby="emailHelp" placeholder="Enter Pin ">
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