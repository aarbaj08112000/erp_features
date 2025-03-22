<div class="wrapper">

<div class="content-wrapper" >
<section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Operation Number</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
                            <li class="breadcrumb-item active">Operation Number</li>
                        </ol>
                    </div>

                </div>
            </div><!-- /.container-fluid -->
        </section>
    <!-- Content Header (Page header) -->
   
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">

        <div>
            <!-- Small boxes (Stat box) -->
            <div class="row">


                <br>
                <div class="col-lg-12">

                    <!-- Modal -->
                    <div class="modal fade" id="addPromo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="<?php echo base_url('add_operations') ?>" method="POST" enctype="multipart/form-data">


                                        <div class="form-group">
                                            <label for="on click url">Operation Number <span class="text-danger">*</span></label> <br>
                                            <input required type="text" name="name" placeholder="Enter Operation Number" class="form-control" value="" id="">


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
                        <?php

                        ?>
                        <div class="card-header">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addPromo">
                                Add Operations
                            </button>
                        </div>


                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Sr No</th>
                                        <th> Operation Number</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Sr No</th>
                                        <th>Operation Number</th>
                                        <th>Actions</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php

                                    $i = 1;
                                    foreach ($operations as $u) {
                                        //$product_into = $this->Ojwebsitemodel->get_product_info_new($u->product_id);
                                        //    $segments = $this->Common_admin_model->delete_user_by_id("segments","id",$u->segment_id);
                                        // $segments = $this->Common_admin_model->get_data_by_id("segments",$u->segment_id,"id");
                                    ?>


                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $u->name ?></td>

                                            <td>

                                                <!-- Button trigger modal -->

                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit<?php echo $i; ?>">
                                                    <i class='far fa-edit'></i>

                                                </button>




                                                <!-- edit Modal -->
                                                <div class="modal fade" id="edit<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Update</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="<?php echo base_url('update_operations') ?>" method="POST" enctype="multipart/form-data">
                                                                    <div class="form-group">

                                                                        <label for="">Operation Number <span class="text-danger">*</span></label>
                                                                        <input required value="<?php echo $u->name ?>" type="text" class="form-control" name="name">
                                                                        <input required value="<?php echo $u->id ?>" type="hidden" class="form-control" name="id">
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
                                                <!-- edit Modal -->
                                                <!-- delete Modal -->
                                                <div class="modal fade" id="delete<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="<?php echo base_url('delete_customer') ?>" method="POST" enctype="multipart/form-data">

                                                                    Are You Sure Want To Delete This?
                                                                    <input required value="<?php echo $u->id ?>" type="hidden" class="form-control" name="id">

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- delete Modal -->

                                            </td>


                                        </tr>

                                    <?php
                                        $i++;
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