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
                        <h1>Operations BOM</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('index'); ?>">Home</a></li>
                            <li class="breadcrumb-item active">Operations BOM</li>
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
                                <h3 class="card-title">

                                    Add Operation BOM
                                </h3>

                            </div>

                            <!-- /.card-header -->
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <form action="<?php echo base_url('add_operation_bom_data'); ?>" method="post">
                                                    <div class="form-group">
                                                        <label for="">Select Customer Part Number / Description <span class="text-danger">*</span> </label>
                                                        <select name="output_part_id" required id="" class="form-control select2">
                                                            <?php
                                                            if ($customer_part) {
                                                                foreach ($customer_part as $c) {

                                                            ?>
                                                                    <option value="<?php echo $c->id; ?>"><?php echo $c->part_number . " / " . $c->part_description; ?></option>

                                                            <?php
                                                                }
                                                            }
                                                            ?>
                                                        </select>

                                                    </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="">Enter Qty<span class="text-danger">*</span> </label>

                                                    <input type="number" step="any" name="qty" required min="1" placeholder="Enter Qty" class="form-control">

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-lg-12 border border-secondary p-2">
                                        <div class="row">
                                            <div class="col-lg-5">
                                                <div class="form-group">
                                                    <label for="">Select Output Part From Inhouse Parts </label>
                                                    <select name="input_part_id_1" required id="" class="form-control select2">
                                                        <option value="NA">NA</option>
                                                        <?php
                                                        if ($inhouse_parts) {
                                                            foreach ($inhouse_parts as $c) {

                                                        ?>
                                                                <option value="<?php echo $c->id; ?>"><?php echo $c->part_number . " / " . $c->part_description; ?></option>

                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>

                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="form-group text-center">
                                                    <label for="" class="mt-4">OR </label>


                                                </div>
                                            </div>
                                            <div class="col-lg-5">
                                                <div class="form-group">
                                                    <label for="">Select Output Part From Customer Parts </label>
                                                    <select name="input_part_id_2" required id="" class="form-control select2">
                                                        <option value="NA">NA</option>
                                                        <?php
                                                        if ($customer_part) {
                                                            foreach ($customer_part as $c) {

                                                        ?>
                                                                <option value="<?php echo $c->id; ?>"><?php echo $c->part_number . " / " . $c->part_description; ?></option>

                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3 col-lg-12 border border-secondary p-2">
                                        <div class="row">
                                            <div class="col-lg-5">
                                                <div class="form-group">
                                                    <label for="">Select Input Part From Inhouse Parts </label>
                                                    <select name="" id="" class="form-control select2">
                                                        <option value="NA">NA</option>
                                                        <?php
                                                        if ($inhouse_parts) {
                                                            foreach ($inhouse_parts as $c) {

                                                        ?>
                                                                <option value="<?php echo $c->id; ?>"><?php echo $c->part_number . " / " . $c->part_description; ?></option>

                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>

                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="form-group text-center">
                                                    <label for="" class="mt-4">OR </label>


                                                </div>
                                            </div>
                                            <div class="col-lg-5">
                                                <div class="form-group">
                                                    <label for="">Select Input Part From Child Parts </label>
                                                    <select name="" id="" class="form-control select2">
                                                        <option value="NA">NA</option>
                                                        <?php
                                                        if ($child_parts_data) {
                                                            foreach ($child_parts_data as $c) {

                                                        ?>
                                                                <option value="<?php echo $c->id; ?>"><?php echo $c->part_number . " / " . $c->part_description; ?></option>

                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3 col-lg-12 ">
                                        <div class="row">
                                            <div class="col-lg-12 mx-auto d-block">
                                                <button type="submit" class="btn btn-lg btn-primary mx-auto d-block"> Submit</button>
                                                </form>
                                            </div>

                                        </div>
                                    </div>

                                </div>



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