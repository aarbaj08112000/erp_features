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
                        <h1>Part Master</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
                            <li class="breadcrumb-item active">Process</li>
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
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-12 ml-3">
                                <?php if ($this->session->flashdata('errors')) {
                                ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Error : </strong> <?php echo $this->session->flashdata('errors');  ?>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                <?php }
                                ?>
                                <?php if ($this->session->flashdata('success')) {
                                ?>

                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>Success :</strong> <?php echo $this->session->flashdata('success');  ?>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                <?php }
                                ?>


                            </div>
                        </div>

                    </div>


                    <br>
                    <div class="col-lg-12">

                        <!-- Modal -->
                        <div class="modal fade" id="addPromo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add Part</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <form action="<?php echo base_url('add_customer_parts_master') ?>" method="POST" enctype="multipart/form-data">
                                        </div>
                                        <div class="form-group">
                                            <label for="on click url">Part Number<span class="text-danger">*</span></label> <br>
                                            <input required type="text" name="part_number" placeholder="Enter Part Number" class="form-control" value="">
                                        </div>
                                        <div class="form-group">
                                            <label for="on click url">Part Description<span class="text-danger">*</span></label> <br>
                                            <input required type="text" name="part_description" placeholder="Enter Part Description" class="form-control" value="">
                                        </div>
                                        <div class="form-group">
                                            <label for="on click url">Rate<span class="text-danger">*</span></label> <br>
                                            <input required type="number" step="any"  name="fg_rate" placeholder="Enter Rate" class="form-control" value="0" required>
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
                                    Add
                                </button>
                            </div>


                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sr No</th>
                                            <th>Part Number</th>
                                            <th>Part Description</th>
                                            <th>FG Stock</th>
                                            <th>Rate</th>
                                            <?php if($entitlements['isPlastic']!=null){ ?>
                                                <th>Grade</th>
                                            <?php } ?>
                                            <th>Action</th>

                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        if ($customer_parts_master) {
                                            $i = 1;
                                            foreach ($customer_parts_master as $u) {

                                                if($entitlements['isPlastic']!=null){
                                                    //$product_into = $this->Ojwebsitemodel->get_product_info_new($u->product_id);
                                                    $grades_data  = $this->Crud->get_data_by_id("grades", $u->grade_id, "id");
                                                    $grade_name = "";
                                                    if($grades_data)
                                                    {
                                                        $grade_name = $grades_data[0]->name;
                                                    }             
                                             }                                    
                                        ?>

                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $u->part_number ?></td>
                                                    <td><?php echo $u->part_description ?></td>
                                                    <td><?php echo $u->fg_stock ?></td>
                                                    <td><?php echo $u->fg_rate ?></td>
                                                    <?php if($entitlements['isPlastic']!=null){ ?>
                                                        <td><?php echo $grade_name ?></td>
                                                    <?php } ?>
                                                    <td>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#edit<?php echo $i; ?>">
                                                    <i class='far fa-edit'></i>
                                                </button>
                                                <!-- edit Modal -->
                                                <div class="modal fade" id="edit<?php echo $i; ?>" tabindex="-1"
                                                    role="dialog" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Update
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>

                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-lg-12">

                                                                        <form
                                                                            action="<?php echo base_url('update_customer_parts_master') ?>"
                                                                            method="POST" enctype="multipart/form-data">

                                                                            <div class="form-group">
                                                                                <label> Part Description</label><span
                                                                                    class="text-danger">*</span>
                                                                                <input type="hidden" readonly
                                                                                    value="<?php echo $u->id ?>"
                                                                                    name="id" required
                                                                                    class="form-control"
                                                                                    id="exampleInputEmail1"
                                                                                    placeholder="Enter Safty/buffer stock"
                                                                                    aria-describedby="emailHelp">
                                                                                    <input required type="text" name="part_description" placeholder="Enter Part Description" class="form-control" value="<?php echo $u->part_description; ?>" id="">
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label>Rate<span class="text-danger">*</span></label> <br>
                                                                                <input required type="number" step="any" name="fg_rate" placeholder="Enter Rate" class="form-control" value="<?php echo $u->fg_rate ?>" required>
                                                                            </div>

                                                                    </div>

                                                                </div>

                                                            </div>


                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Save
                                                                    changes</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- edit Modal -->


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