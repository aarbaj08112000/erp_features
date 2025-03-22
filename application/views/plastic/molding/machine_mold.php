<div class="wrapper">

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <!-- <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Process Master</h1>
        </div>

        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
          </ol>
        </div>
      </div>
    </div>
  </div> -->
        <!-- /.content-header -->

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Machine Mold</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
                            <li class="breadcrumb-item active">Machine Mold</li>
                        </ol>
                    </div>

                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <div>
                <!-- Small boxes (Stat box) -->
                <div class="row">


                    <br>
                    <div class="col-lg-12">

                        <!-- Modal -->
                        <div class="modal fade" id="addPromo" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <form action="<?php echo base_url('add_machine_mold') ?>" method="POST"
                                                enctype="multipart/form-data">

                                        </div>

                                        <div class="form-group">
                                            <label for="on click url">Select Machine<span
                                                    class="text-danger">*</span></label>
                                            <select name="machine_id" required id="" class="form-control select2">
                                                <?php
                                                if ($machine) {
                                                    foreach ($machine as $c) {
                                                ?>
                                                <option value="<?php echo $c->id; ?>"><?php echo $c->name; ?>
                                                </option>
                                                <?php
                                                    }
                                                }
                                                ?>

                                            </select>


                                        </div>
                                        <div class="form-group">
                                            <label for="on click url">Select Mold Maintenance No Of Cavity / Customer /
                                                Target Life<span class="text-danger">*</span></label>
                                            <select name="mold_maintenance_id" required id=""
                                                class="form-control select2">
                                                <?php
                                                if ($mold_maintenance) {
                                                    foreach ($mold_maintenance as $c) {
                                                        $customer_data = $this->Crud->get_data_by_id("customer", $c->customer_id, "id");

                                                ?>
                                                <option value="<?php echo $c->id; ?>">
                                                    <?php echo $c->no_of_cavity . " / " . $customer_data[0]->customer_name . "/" . $c->target_life ?>
                                                </option>
                                                <?php
                                                    }
                                                }
                                                ?>

                                            </select>


                                        </div>



                                    </div>








                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">

                            <div class="card-header">
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#addPromo">
                                    Add
                                </button>
                            </div>


                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sr No</th>
                                            <th>Mold maintenance No Of Cavity / Customer / Target Life
                                            <th>
                                            <th>Machine</th>

                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Sr No</th>
                                            <th>Mold maintenance No Of Cavity / Customer / Target Life
                                            <th>
                                            <th>Machine</th>

                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        if ($machine_mold) {
                                            $i = 1;
                                            foreach ($machine_mold as $c) {
                                                $mold_maintenance_data = $this->Crud->get_data_by_id("mold_maintenance", $c->mold_maintenance_id, "id");
                                                $customer_data = $this->Crud->get_data_by_id("customer", $mold_maintenance_data[0]->customer_id, "id");

                                        ?>

                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $c->no_of_cavity ?></td>
                                            <td><?php echo $mold_maintenance_data[0]->no_of_cavity . "/" . $customer_data[0]->customer_name . "/" . $mold_maintenance_data[0]->target_life ?>
                                            </td>
                                            <td><?php echo $c->target_life ?></td>

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
                        <!-- ./col -->
                    </div>

                </div>
                <!-- /.row -->
                <!-- Main row -->

                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>