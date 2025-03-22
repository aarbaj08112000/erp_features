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
                        <h1>Insert List</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Insert List</li>
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
                                <h3 class="card-title">Insert List</h3>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal">
                                    Add Tool</button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add Insert</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="<?php echo base_url('addTool') ?>" method="POST">
                                                    <div class="row">
                                                        <div class="col-lg-6">

                                                            <div class="form-group">
                                                                <label for="tool_number">Insert Number</label><span class="text-danger">*</span>
                                                                <input type="text" name="toolNumber" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Insert Name">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="tool_name">Insert Name</label><span class="text-danger">*</span>
                                                                <input type="text" name="toolName" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Insert Number">
                                                            </div>

                                                            <!-- Example single danger button -->
                                                            <div class="form-group">
                                                                <label> Tool Type </label>
                                                                <select required class="form-control select2" name="toolType" style="width: 100%;">
                                                                    <option value="Insert" selected="selected">Insert</option>
                                                                    <option value="General">General</option>
                                                                    <option value="Special">Special</option>
                                                                    <option value="Bulk Insert">Bulk Insert</option>

                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label> Tool Life Monitoring Unit </label>
                                                                <select required class="form-control select2" name="toolLifeMonitoringUnit" style="width: 100%;">
                                                                    <option value="Meter" selected="selected">Meter</option>
                                                                    <option value="Number of Parts">Number of Parts</option>

                                                                </select>
                                                            </div>

                                                        </div>


                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="max_reshaping_revision">Max Resharpening Revision</label><span class="text-danger">*</span>
                                                                <input type="number" class="form-control" name="maxResharpeningRevision" required id="exampleInputPassword1" placeholder="Max Resharpening Revision">
                                                            </div>


                                                            <div class="form-group">
                                                                <label for="fixture_number">
                                                                    Safety Stock
                                                                </label><span class="text-danger">*</span>
                                                                <input type="number" name="safetyStock" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Fixture Number">
                                                                <input type="hidden" value="insert" name="type" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Fixture Number">

                                                            </div>
                                                            <div class="form-group">
                                                                <label for="fixture_number">
                                                                    Defined Tool Life </label><span class="text-danger">*</span>
                                                                <input type="number" name="definedToolLife" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Fixture Number">
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
                                            <th>Insert Name</th>
                                            <th>Insert Number</th>
                                            <th>Tool Type</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        if ($toolList) {
                                            foreach ($toolList as $t) {


                                        ?>

                                                <tr>
                                                    <td><?php echo $i ?></td>
                                                    <td><?php echo $t->tool_name ?></td>
                                                    <td><?php echo $t->tool_number ?></td>
                                                    <td><?php echo $t->tool_type ?></td>
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
                                                                        <form action="<?php echo base_url('updateTool') ?>" method="POST">
                                                                            <div class="row">
                                                                                <div class="col-lg-6">

                                                                                    <div class="form-group">
                                                                                        <label for="tool_number">Tool Number</label><span class="text-danger">*</span>
                                                                                        <input type="hidden" value="<?php echo $t->id ?>" name="id" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Tool Name">

                                                                                        <input type="text" value="<?php echo $t->tool_number ?>" name="utoolNumber" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Tool Name">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="tool_name">Tool Name</label><span class="text-danger">*</span>
                                                                                        <input type="text" value="<?php echo $t->tool_name ?>" name="utoolName" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Tool Number">
                                                                                    </div>

                                                                                    <!-- Example single danger button -->
                                                                                    <div class="form-group">
                                                                                        <label> Tool Type </label>
                                                                                        <select required class="form-control select2" name="utoolType" style="width: 100%;">

                                                                                            <option value="<?php echo $t->tool_type ?>" selected="selected"><?php echo $t->tool_type ?></option>
                                                                                            <option value="Insert">Insert</option>
                                                                                            <option value="General">General</option>
                                                                                            <option value="Special">Special</option>
                                                                                            <option value="Bulk Insert">Bulk Insert</option>

                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label> Tool Life Monitoring Unit </label>
                                                                                        <select required class="form-control select2" name="utoolLifeMonitoringUnit" style="width: 100%;">
                                                                                            <option value="<?php echo $t->tool_life_monitoring_unit ?>" selected="selected"><?php echo $t->tool_life_monitoring_unit ?></option>
                                                                                            <option value="Meter">Meter</option>
                                                                                            <option value="Number of Parts">Number of Parts</option>

                                                                                        </select>
                                                                                    </div>
                                                                                </div>


                                                                                <div class="col-lg-6">
                                                                                    <div class="form-group">
                                                                                        <label for="max_reshaping_revision">Max Resharpening Revision</label><span class="text-danger">*</span>
                                                                                        <input type="text" name="umaxResharpeningRevision" value="<?php echo $t->max_resharpning_revision ?>" class="form-control" required id="exampleInputPassword1" placeholder="Max Resharpening Revision">
                                                                                    </div>


                                                                                    <div class="form-group">
                                                                                        <label for="fixture_number">
                                                                                            Safety Stock
                                                                                        </label><span class="text-danger">*</span>
                                                                                        <input type="text" value="<?php echo $t->safety_stock ?>" name="usafetyStock" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder=" Safety Stock ">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="fixture_number">
                                                                                            Defined Tool Life </label><span class="text-danger">*</span>
                                                                                        <input type="text" value="<?php echo $t->defined_tool_life ?>" name="udefinedToolLife" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder=" Defined Tool Life ">
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
                                                        <button type="submit" data-toggle="modal" class="btn btn-sm btn-danger ml-4" data-target="#exampleModal3<?php echo $i ?>"> <i class="far fa-trash-alt"></i></button>
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
                                                                            <input value="tools" name="table_name" type="hidden" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Machine Name">

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
                                            <th>Insert Name</th>
                                            <th>Insert Number</th>
                                            <th>Tool Type</th>
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