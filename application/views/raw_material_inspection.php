<div style="width:100%" class="wrapper">
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
                        <!-- <h1></h1> -->
                        <form action="<?php echo base_url('') ?>" method="POST">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="po_num">Part Number </label><span class="text-danger">*</span>
                                        <input type="text" readonly value="<?php echo $child_part[0]->part_number ?>" name="part_number" required class="form-control" id="exampleInputEmail1" placeholder="Enter Part Number" aria-describedby="emailHelp">
                                    </div>

                                </div>
                                <div class="col-lg-6">

                                    <div class="form-group">
                                        <label for="po_num">Part Description </label><span class="text-danger">*</span>
                                        <input type="text" readonly value="<?php echo $child_part[0]->part_description ?>" name="part_desc" required class="form-control" id="exampleInputEmail1" placeholder="Enter Part Description" aria-describedby="emailHelp">
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
                            <li class="breadcrumb-item active">Inward Inspection</li>
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

                                <!-- Button trigger modal -->
                                <a class="btn btn-danger" href="<?php echo base_url('child_part_view') ?>">
                                    Back </a>
                                <hr>
                                <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#exampleModal">
                                    Add </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog " role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="<?php echo base_url('add_raw_material_inspection_master') ?>" method="POST">
                                                    <div class="row">
                                                        <div class="col-lg-12">



                                                            <div class="form-group">
                                                                <label> Parameter </label><span class="text-danger">*</span>
                                                                <input type="text" required name="parameter" placeholder="Enter Parameter" class="form-control">
                                                            </div>
                                                            <div class="form-group">
                                                                <label> Specification </label><span class="text-danger">*</span>
                                                                <input type="text" required name="specification" placeholder="Enter Specification" class="form-control">
                                                            </div>
                                                            <div class="form-group">
                                                                <label> Evalution Mesaurement Technique </label><span class="text-danger">*</span>
                                                                <input type="text" required name="evalution_mesaurement_technique" placeholder="Enter Specification" class="form-control">
                                                                <input type="hidden" value="<?php echo $child_part_id; ?>" required name="child_part_id" placeholder="Enter Specification" class="form-control">
                                                            </div>
                                                        </div>


                                                        <!-- <div class="col-lg-6">

                                                            <div class="form-group">
                                                                <label for="operation_name">Operation Name</label><span class="text-danger">*</span>
                                                                <input type="text" name="operataionName" class="form-control" required id="exampleInputPassword1" placeholder="Operation Name ">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="fixture_number">Fixture Number</label><span class="text-danger">*</span>
                                                                <input type="text" name="fixtureNumber" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Fixture Number">
                                                            </div>
                                                        </div> -->

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save
                                                            changes</button>
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

                                            <th>Parameter</th>
                                            <th>Specification</th>
                                            <th>Evalution Mesaurement Technique</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $i = 1;
                                        if ($raw_material_inspection_master) {
                                            foreach ($raw_material_inspection_master as $u) {
                                        ?>

                                                <tr>
                                                    <td><?php echo $i ?></td>

                                                    <td><?php echo $u->parameter ?></td>
                                                    <td><?php echo $u->specification ?></td>
                                                    <td><?php echo $u->evalution_mesaurement_technique ?></td>
                                                    <td>
                                                        <button type="submit" data-toggle="modal" class="btn btn-sm btn-primary" data-target="#exampleModal2<?php echo $i ?>"> <i class="fas fa-edit"></i></button>

                                                        <div class="modal fade" id="exampleModal2<?php echo $i ?>" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Update</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form action="<?php echo base_url('update_raw_material_inspection_master') ?>" method="POST">
                                                                            <div class="row">
                                                                                <div class="col-lg-12">



                                                                                    <div class="form-group">
                                                                                        <label> Parameter </label><span class="text-danger">*</span>
                                                                                        <input type="text" value="<?php echo $u->parameter; ?>" required name="parameter" placeholder="Enter Parameter" class="form-control">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label> Specification </label><span class="text-danger">*</span>
                                                                                        <input type="text" value="<?php echo $u->specification; ?>" required name="specification" placeholder="Enter Specification" class="form-control">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label> Evalution Mesaurement Technique </label><span class="text-danger">*</span>
                                                                                        <input type="text" required value="<?php echo $u->evalution_mesaurement_technique; ?>" name="evalution_mesaurement_technique" placeholder="Enter Specification" class="form-control">
                                                                                        <input type="hidden" value="<?php echo $child_part_id; ?>" required name="child_part_id" placeholder="Enter Specification" class="form-control">
                                                                                        <input type="hidden" value="<?php echo $u->id; ?>" required name="id" placeholder="Enter Specification" class="form-control">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                                <button type="submit" class="btn btn-primary">Save
                                                                                    changes</button>
                                                                            </div>
                                                                        </form>

                                                                    </div>


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