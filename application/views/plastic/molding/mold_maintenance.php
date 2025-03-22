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
                        <h1>Mold Master</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
                            <li class="breadcrumb-item active">Mold Master</li>
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
                        <div class="modal fade" id="addPromo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                            <form action="<?php echo base_url('add_mold_maintenance') ?>" method="POST" enctype="multipart/form-data">
                                        </div>
                                        <div class="form-group">
                                            <label for="on click url">Select Customer Part<span class="text-danger">*</span></label>
                                            <select name="customer_part_id" required id="" class="form-control select2">
                                                <?php
                                                if ($new_part_selection) {
                                                    foreach ($new_part_selection as $part) {
                                                ?>
                                                        <option value="<?php echo $part->id; ?>">
                                                            <?php echo $part->customer_name . "/" . $part->part_number . "/" . $part->part_description; ?>
                                                        </option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="on click url">Mold Name<span class="text-danger">*</span></label>
                                            <br>
                                            <input required type="text" name="mold_name" placeholder="Enter Mold Name" class="form-control" value="" id="">
                                        </div>
                                        <div class="form-group">
                                            <label for="on click url">Ownership<span class="text-danger">*</span></label>
                                            <select name="ownership" required id="" class="form-control">
                                                        <option value="Customer">Customer</option>
                                                        <option value="Client">Client</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="on click url">No Of Cavity<span class="text-danger">*</span></label>
                                            <br>
                                            <input required type="number" name="no_of_cavity" placeholder="Enter No Of Cavity" class="form-control" value="" id="">
                                        </div>
                                        <div class="form-group">
                                            <label for="on click url">Mold PM Frequency<span class="text-danger">*</span></label>
                                            <br>
                                            <input required type="number" name="target_life" placeholder="Enter Mold PM Frequency" class="form-control" value="" id="">
                                        </div>
                                        <div class="form-group">
                                            <label for="on click url">Mold Life Over Frequency<span class="text-danger">*</span></label>
                                            <br>
                                            <input required type="number" name="target_over_life" placeholder="Enter Mold Life Over Frequency" class="form-control" value="" id="">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">

                            <div class="card-header">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addPromo">
                                    Add Mold Master
                                </button>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form action="<?php echo base_url('view_mold_by_filter') ?>" method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div style="width: 400px;">
                                                <div class="form-group">
                                                    <label for="on click url">Select Part Number <span class="text-danger">*</span></label> <br>
                                                    <select name="child_part_id" required class="form-control select2" id="">
                                                        <option value="">Select</option>
                                                        <option <?php if ($filter_child_part_id === "All") echo 'selected' ?> value="All">All</option>
                                                        <?php
                                                        if ($part_selection) {
                                                            foreach ($part_selection as $part) {
                                                        ?>
                                                                <option <?php 
                                                                if ($filter_child_part_id === $part->id) echo 'selected' ?> value="<?php echo $part->id ?>">
                                                                        <?php echo $part->customer_name . "/" . $part->part_number . "/" . $part->part_description; ?>
                                                                </option>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <label for="">&nbsp;</label> <br>
                                            <button class="btn btn-secondary">Search </button>
                                        </div>
                                    </div>
                                </form>
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sr No</th>
                                            <th>Customer Part</th>
                                            <th>Mold Name</th>
                                            <th>Ownership</th>
                                            <th>No Of Cavity</th>
                                            <th>Mold Life Over Frequency</th>
                                            <th>Mold PM Frequency</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                         $totalQuantity = 0;
                                        if ($mold_maintenance_results) {
                                            $i = 1;
                                            foreach ($mold_maintenance_results as $u) {
                                        ?>

                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $u->customer_name . "/" . $u->part_number . "/" . $u->part_description; ?>
                                                    </td>
                                                    <td><?php echo $u->mold_name ?></td>
                                                    <td><?php echo $u->ownership ?></td>
                                                    <td><?php echo $u->no_of_cavity ?></td>
                                                    <td><?php echo $u->target_over_life ?></td>
                                                    <td><?php echo $u->target_life ?></td>
                                                    <td>
                                                        <button type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#addProm<?php echo $i; ?>">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <div class="modal fade" id="addProm<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Update Mold Master</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="form-group">
                                                                            <form action="<?php echo base_url('update_mold_maintenance') ?>" method="POST" enctype="multipart/form-data">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="on click url">Select Customer Part<span class="text-danger">*</span></label>
                                                                            <select name="customer_part_id" class="form-control select2" disabled>
                                                                                <?php
                                                                                if ($part_selection) {
                                                                                    foreach ($part_selection as $part) {
                                                                               ?>
                                                                                        <option <?php
                                                                                                if ($u->customer_part_id == $part->id) {
                                                                                                    echo "selected";
                                                                                                }
                                                                                                ?> value="<?php echo $part->id; ?>">
                                                                                            <?php echo $part->customer_name . "/" . $part->part_number . "/" . $part->part_description; ?>
                                                                                        </option>
                                                                                <?php
                                                                                    }
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="on click url">Mold Name<span class="text-danger">*</span></label>
                                                                            <br>
                                                                            <input type="text" value="<?php echo $u->mold_name ?>" name="mold_name" placeholder="Enter Mold Name" class="form-control">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="on click url">Select Ownership<span class="text-danger">*</span></label>
                                                                            <select name="ownership" required id="" class="form-control">
                                                                                        <option value="Customer" <?php if ($u->ownership == 'Customer') { echo "selected"; } ?>>Customer</option>
                                                                                        <option value="Client" <?php if ($u->ownership == 'Client') { echo "selected"; } ?>>Client</option>
                                                                             </select>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="on click url">No Of Cavity<span class="text-danger">*</span></label>
                                                                            <br>
                                                                            <input required type="number" value="<?php echo $u->no_of_cavity ?>" name="no_of_cavity" placeholder="Enter No Of Cavity" class="form-control" value="" id="">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="on click url">Mold PM Frequency<span class="text-danger">*</span></label>
                                                                            <br>
                                                                            <input required type="number" value="<?php echo $u->target_life ?>" name="target_life" placeholder="Enter Mold PM Frequency" class="form-control" value="" id="">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="on click url">Mold Life Over Frequency<span class="text-danger">*</span></label>
                                                                            <br>
                                                                            <input required type="number" value="<?php echo $u->target_over_life ?>"  name="target_over_life" placeholder="Enter Mold Life Over Frequency" class="form-control" value="" id="">
                                                                            <input required type="hidden" value="<?php echo $u->id ?>"  name="id" placeholder="Enter Mold Life Over Frequency" class="form-control" value="" id="">
                                                                            <input required type="hidden" value="<?php echo $filter_child_part_id ?>" name="filter_child_part_id" class="form-control">
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