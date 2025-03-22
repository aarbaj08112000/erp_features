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
                        <h1>Sharing BOM</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?Php echo base_url('dashboard') ?>">Home</a></li>
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


                                <button type="button" class="btn btn-primary " data-toggle="modal"
                                    data-target="#exampleModal">
                                    Add Sharing Bom </button>




                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog " role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">
                                                    Add </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="<?php echo base_url('add_sharing_bom') ?>" method="POST">
                                                    <div class="row">
                                                        <div class="col-lg-12">

                                                            <div class="form-group">
                                                                <label for="operation_name">Enter
                                                                    Name
                                                                </label><span class="text-danger">*</span>
                                                                <input type="text" name="name" class="form-control"
                                                                    required id="exampleInputPassword1"
                                                                    placeholder="Enter Name">
                                                            </div>

                                                        </div>

                                                        <div class="col-lg-12">


                                                            <div class="form-group">
                                                                <label> Select Output
                                                                    Part
                                                                </label><span class="text-danger">*</span>
                                                                <select class="form-control select2"
                                                                    name="output_part_id" style="width: 100%;">
                                                                    <?php
                                                                    foreach ($child_part_list as $c1) {
                                                                    ?>
                                                                    <option value="<?php echo $c1->id; ?>">
                                                                        <?php echo $c1->part_number; ?>/<?php echo $c1->part_description; ?>
                                                                    </option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>


                                                            </div>


                                                        </div>


                                                        <div class="col-lg-12">

                                                            <div class="form-group">
                                                                <label for="operation_name">Enter
                                                                    Qty
                                                                </label><span class="text-danger">*</span>
                                                                <input type="number" step="any" min="1" value="1"
                                                                    name="qty" class="form-control" required
                                                                    id="exampleInputPassword1" placeholder="Enter Qty ">
                                                            </div>

                                                        </div>
                                                        <div class="col-lg-12">

                                                            <div class="form-group">
                                                                <label for="operation_name">Scrap
                                                                    Quantity (kg)
                                                                </label><span class="text-danger">*</span>
                                                                <input type="number" step="any" min="0" value="0.1"
                                                                    name="scrap_factor" class="form-control" required
                                                                    id="exampleInputPassword1"
                                                                    placeholder="Operation Name ">
                                                            </div>

                                                        </div>

                                                        <div class="col-lg-12">


                                                            <div class="form-group">
                                                                <label> Select Input
                                                                    Part
                                                                </label><span class="text-danger">*</span>
                                                                <select class="form-control select2"
                                                                    name="input_part_id" style="width: 100%;">
                                                                    <?php
                                                                    foreach ($child_part_list as $c1) {
                                                                    ?>
                                                                    <option value="<?php echo $c1->id; ?>">
                                                                        <?php echo $c1->part_number; ?>/<?php echo $c1->part_description; ?>
                                                                    </option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>


                                                            </div>


                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
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
                                            <th>Name</th>
                                            <th>Output part Number / Description</th>
                                            <th>Qty</th>
                                            <th>Input part Number / Description</th>
                                            <th>Scrap(kg) </th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $i = 1;
                                        if ($sharing_bom) {
                                            foreach ($sharing_bom as $s) {

                                                $output_part_data = $this->Crud->get_data_by_id("child_part", $s->output_part_id, "id");
                                                $input_part_data = $this->Crud->get_data_by_id("child_part", $s->input_part_id, "id");


                                        ?>

                                        <tr>
                                            <td><?php echo $i ?></td>
                                            <td>
                                                <?php echo $s->name ?>
                                            </td>

                                            <td>
                                                <?php echo $output_part_data[0]->part_number ?>
                                                /
                                                <?php echo $output_part_data[0]->part_description ?>
                                            </td>
                                            <td>
                                                <?php echo $s->qty ?>
                                            </td>
                                            <td>
                                                <?php echo $input_part_data[0]->part_number ?>
                                                /
                                                <?php echo $input_part_data[0]->part_description ?>
                                            </td>
                                            <td>
                                                <?php
                                                        echo $s->scrap_factor;
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