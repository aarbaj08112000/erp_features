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
                        <h1>Single Request Reasons </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Single Request Reasons </li>
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
                                <h3 class="card-title">Single Request Reasons </h3>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal">
                                    Add New</button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog " role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add New</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="<?php echo base_url('addSingleRequest') ?>" method="POST">
                                                    <div class="form-group">
                                                        <label for="machine_name">
                                                            Single Request Reason
                                                        </label><span class="text-danger">*</span>
                                                        <input type="text" name="singleRequest" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Request Reason">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="machine_number">Description</label><span class="text-danger">*</span>
                                                        <textarea name="description" id="description" class="form-control" cols="30" placeholder="Description" rows="3"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>
                                                            Is it damaged type reason ?
                                                        </label>
                                                        <select required class="form-control select2" name="checkbox" style="width: 100%;">
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>

                                                        </select>
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
                                            <th>Single Request Reasons</th>
                                            <th>Description</th>
                                            <th>Reason Type</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        if ($requestList) {
                                            foreach ($requestList as $r) {
                                        ?>

                                                <tr>
                                                    <td><?php echo $i ?></td>
                                                    <td><?php echo $r->request_reason ?></td>
                                                    <td><?php echo $r->description ?></td>
                                                    <td><?php echo $r->checkbox ?></td>
                                                    <td>
                                                        <button type="submit" data-toggle="modal" class="btn btn-sm btn-primary" data-target="#exampleModal2<?php echo $i ?>"> <i class="fas fa-edit"></i></button>

                                                        <div class="modal fade" id="exampleModal2<?php echo $i ?>" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog " role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Add Machine</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form action="<?php echo base_url('updateSingleRequest') ?>" method="POST">
                                                                            <div class="form-group">
                                                                                <label for="machine_name">
                                                                                    Single Request Reason
                                                                                </label><span class="text-danger">*</span>
                                                                                <input value="<?php echo $r->id; ?>" name="id" type="hidden" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Machine Name">

                                                                                <input type="text" value="<?php echo $r->request_reason ?>" name="usingleRequest" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Request Reason">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="machine_number">Description</label><span class="text-danger">*</span>
                                                                                <textarea name="udescription" id="description" class="form-control" cols="30" placeholder="Description" rows="3"> <?php echo $r->description ?></textarea>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label>
                                                                                    Is it damaged type reason ?
                                                                                </label>
                                                                                <select required class="form-control select2" name="ucheckbox" style="width: 100%;">
                                                                                    <option value="<?php echo $r->checkbox ?>" selected="selected"><?php echo $r->checkbox ?></option>
                                                                                    <option value="Yes">Yes</option>
                                                                                    <option value="No">No</option>

                                                                                </select>
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
                                                        <button type="submit" data-toggle="modal" class="btn btn-sm btn-danger ml-4" data-target="#exampleModal3<?php echo $i ?>"> <i class="far fa-trash-alt"></i></button>
                                                        <!-- Button trigger modal -->


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

                                                                            <input value="<?php echo $r->id; ?>" name="id" type="hidden" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Machine Name">
                                                                            <input value="single_r_r" name="table_name" type="hidden" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Machine Name">

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
                                            <th>Single Request Reasons</th>
                                            <th>Description</th>
                                            <th>Reason Type</th>
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