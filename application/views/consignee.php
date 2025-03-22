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
                        <h1>Consignee</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Consignee</li>
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
                                    Add Consignee</button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content modal-lg">
                                            <div class="modal-header ">
                                                <h5 class="modal-title" id="exampleModalLabel">Add Consignee</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="<?php echo base_url('add_consignee') ?>" method="POST">
                                                    <div class="row">
                                                        <div class="col-lg-12">

                                                            <div class="form-group">
                                                                <label for="customer_name">Consignee Name</label><span class="text-danger">*</span>
                                                                <input type="text" name="cconsignee_name" required class="form-control" id="name" aria-describedby="emailHelp" placeholder="Consignee Name">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="customer_name">Location</label><span class="text-danger">*</span>
                                                                <input type="text" name="clocation" required class="form-control" id="location" aria-describedby="emailHelp" placeholder="Location">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="customer_location">Address</label><span class="text-danger">*</span>
                                                                <input type="text" name="caddress" required class="form-control" id="address" aria-describedby="emailHelp" placeholder="Address">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="customer_location">State</label><span class="text-danger">*</span>
                                                                <input type="text" name="cstate" required class="form-control" id="state" aria-describedby="emailHelp" placeholder="State">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="customer_location">State No </label><span class="text-danger">*</span>
                                                                <input type="text" name="cstate_no" required class="form-control" id="state_num" aria-describedby="emailHelp" placeholder="State No">
                                                            </div>
                                                              <div class="form-group">
                                                                <label for="customer_location">PIN</label><span class="text-danger">*</span>
                                                                <input type="text" name="cpin_code" required class="form-control" id="PIN" aria-describedby="emailHelp" placeholder="PIN ">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="customer_location">GST Number</label><span class="text-danger">*</span>
                                                                <input type="text" name="gst_number" required class="form-control" id="gst_no" aria-describedby="emailHelp" placeholder="GST Number">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="customer_location">PAN No</label><span class="text-danger">*</span>
                                                                <input type="text" name="cpan_no" required class="form-control" id="pan" aria-describedby="emailHelp" placeholder="PAN No">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="customer_name">Phone No</label><span class="text-danger">*</span>
                                                                <input type="text" name="cphone_no" required class="form-control" id="phone" aria-describedby="phone" placeholder="Phone No">
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
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Consignee Name</th>
                                            <th>Location</th>
                                            <th>Phone No</th>
                                            <th>Address</th>
                                            <th>State</th>
                                            <th>PIN Code</th>
                                            <th>GST No</th>
                                            <th>PAN No</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Consignee Name</th>
                                            <th>Location</th>
                                            <th>Phone No</th>
                                            <th>Address</th>
                                            <th>State</th>
                                            <th>PIN Code</th>
                                            <th>GST No</th>
                                            <th>PAN No</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        if ($consignee_list) {
                                            foreach ($consignee_list as $t) {
                                        ?>

                                                <tr>
                                                    <td><?php echo $i ?></td>
                                                    <td><?php echo $t->consignee_name ?></td>
                                                    <td><?php echo $t->location ?></td>
                                                    <td><?php echo $t->phone_no ?></td>
                                                    <td><?php echo $t->address ?></td>
                                                    <td><?php echo $t->state ?></td>
                                                    <td><?php echo $t->pin_code ?></td>
                                                    <td><?php echo $t->gst_number ?></td>
                                                    <td><?php echo $t->pan_no ?></td>
                                                    <td>
                                                        <button type="submit" data-toggle="modal" class="btn btn-sm btn-primary" data-target="#exampleModal2<?php echo $i ?>"> <i class="fas fa-edit"></i></button>

                                                        <div class="modal fade" id="exampleModal2<?php echo $i ?>" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Update Consignee</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form action="<?php echo base_url('update_consignee') ?>" method="POST">
                                                                            <div class="row">
                                                                                <div class="col-lg-12">

                                                                                    <div class="form-group">
                                                                                        <label for="customer_name">Consignee Name</label><span class="text-danger">*</span>
                                                                                        <input value="<?php echo $t->consignee_name ?>" type="text" name="uconsignee_name" required class="form-control" id="uconsignee_name" aria-describedby="emailHelp" placeholder="Consignee Name">
                                                                                        <input value="<?php echo $t->c_id ?>" type="hidden" name="consignee_id" required class="form-control" id="consignee_ref">
                                                                                        <input value="<?php echo $t->address_id ?>" type="hidden" name="address_id" required class="form-control" id="addressRef">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="customer_name">Location</label><span class="text-danger">*</span>
                                                                                        <input value="<?php echo $t->location ?>" type="text" name="ulocation" required class="form-control" id="location" aria-describedby="location" placeholder="Location">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="customer_location">Address</label><span class="text-danger">*</span>
                                                                                        <input type="text" name="uaddress" value="<?php echo $t->address ?>" required class="form-control" id="address" aria-describedby="emailHelp" placeholder="Address">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="customer_location">State</label><span class="text-danger">*</span>
                                                                                        <input type="text" name="ustate" value="<?php echo $t->state ?>" required class="form-control" id="state" aria-describedby="emailHelp" placeholder="State">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="customer_location">State No </label><span class="text-danger">*</span>
                                                                                        <input type="text" name="ustate_no" value="<?php echo $t->state_no ?>" required class="form-control" id="state_num" aria-describedby="emailHelp" placeholder="State No">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="customer_location">PIN</label><span class="text-danger">*</span>
                                                                                        <input type="text" name="upin_code" value="<?php echo $t->pin_code ?>" required class="form-control" id="PIN" aria-describedby="emailHelp" placeholder="PIN ">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="customer_location">GST Number</label><span class="text-danger">*</span>
                                                                                        <input type="text" name="ugst_number" value="<?php echo $t->gst_number ?>" required class="form-control" id="gst_no" aria-describedby="emailHelp" placeholder="GST Number">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="customer_location">PAN No</label><span class="text-danger">*</span>
                                                                                        <input type="text" name="upan_no" value="<?php echo $t->pan_no ?>" required class="form-control" id="pan" aria-describedby="emailHelp" placeholder="PAN No">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="customer_name">Phone No</label><span class="text-danger">*</span>
                                                                                        <input type="text" name="uphone_no" value="<?php echo $t->phone_no ?>" required class="form-control" id="phone" aria-describedby="phone" placeholder="Phone No">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                                                <button type="submit" class="btn btn-primary">Update</button>
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
                                                                            <input value="<?php echo $t->id; ?>" name="id" type="hidden" required class="form-control" id="delete_id" aria-describedby="emailHelp">
                                                                            <input value="consignee" name="table_name" type="hidden" required class="form-control" id="delete" aria-describedby="emailHelp">
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