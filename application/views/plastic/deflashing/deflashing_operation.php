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
                        <h1>Deflashing Operation</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
                            <li class="breadcrumb-item active">Deflashing Operation</li>
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
                                            <form action="<?php echo base_url('add_deflashing_operation') ?>"
                                                method="POST" enctype="multipart/form-data">

                                        </div>

                                        <div class="form-group">
                                            <label for="on click url">Select Operation<span
                                                    class="text-danger">*</span></label>
                                            <select name="operation_id" required id="" class="form-control select2">
                                                <?php
                                                if ($operations) {
                                                    foreach ($operations as $c) {
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
                                            <label for="on click url">Select Customer Part<span
                                                    class="text-danger">*</span></label>
                                            <select name="customer_part_id" required id="" class="form-control select2">
                                                <?php
                                                if ($customer_parts_master) {
                                                    foreach ($customer_parts_master as $c) {
                                                ?>
                                                <option value="<?php echo $c->id; ?>">
                                                    <?php echo $c->part_number . "/" . $c->part_description; ?>
                                                </option>
                                                <?php
                                                    }
                                                }
                                                ?>

                                            </select>


                                        </div>
                                        <div class="form-group">
                                            <label for="on click url">Production TRG_qty ( per hour) <span
                                                    class="text-danger">*</span></label>
                                            <input type="number" step="any" required name="production_trg_qty"
                                                placeholder="Production TRG_qty ( per hour)" class="form-control">

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
                                            <th>Operation</th>
                                            <th>Customer Part</th>
                                            <th>Production TRG qty ( per hour) </th>

                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        if ($deflashing_operation) {
                                            $i = 1;
                                            foreach ($deflashing_operation as $c) {
                                                $operations_data = $this->Crud->get_data_by_id("operations", $c->operation_id, "id");
                                                $customer_part_data = $this->Crud->get_data_by_id("customer_part", $c->customer_part_id, "id");

                                        ?>

                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $operations_data[0]->name ?></td>
                                            <td><?php echo $customer_part_data[0]->part_number . "/" . $customer_part_data[0]->part_description ?>
                                            </td>
                                            <td><?php echo $c->production_trg_qty ?></td>


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