<div class="wrapper">

<div class="content-wrapper" >
<section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Operation Data Master</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
                            <li class="breadcrumb-item active">Operation Data Master</li>
                        </ol>
                    </div>

                </div>
            </div><!-- /.container-fluid -->
        </section>
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
                                    <form action="<?php echo base_url('add_operations_data') ?>" method="POST" enctype="multipart/form-data">


                                        <!-- <div class="form-group">
                                            <label for="on click url">Operation Name <span class="text-danger">*</span></label> <br>
                                            <input required type="text" name="operation_name" placeholder="Enter Oproduct" class="form-control" value="" id="">


                                        </div> -->
                                        <div class="form-group">
                                            <label for="on click url">Product <span class="text-danger">*</span></label> <br>
                                            <input required type="text" name="product" placeholder="Enter Oproduct" class="form-control" value="" id="">


                                        </div>

                                        <div class="form-group">
                                            <label for="on click url">Process <span class="text-danger">*</span></label> <br>
                                            <input required type="text" name="process" placeholder="Enter Process" class="form-control" value="" id="">


                                        </div>
                                        <div class="form-group">
                                            <label for="on click url">Specification Tolerance <span class="text-danger">*</span></label> <br>
                                            <input required type="text" name="specification_tolerance" placeholder="Enter" class="form-control" value="" id="">


                                        </div>
                                        <div class="form-group">
                                            <label for="on click url">Evalution <span class="text-danger">*</span></label> <br>
                                            <input required type="text" name="evalution" placeholder="Enter" class="form-control" value="" id="">


                                        </div>
                                        <div class="form-group">
                                            <label for="on click url">Size <span class="text-danger">*</span></label> <br>
                                            <input required type="text" name="size" placeholder="Enter" class="form-control" value="" id="">


                                        </div>
                                        <div class="form-group">
                                            <label for="on click url">Frequency <span class="text-danger">*</span></label> <br>
                                            <input required type="text" name="frequency" placeholder="Enter" class="form-control" value="" id="">


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
                                Add Data
                            </button>
                        </div>


                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Sr No</th>
                                        <!-- <th>Operation Name</th> -->
                                        <th>Product</th>
                                        <th>Process</th>
                                        <th>Specification Tolerance</th>
                                        <th>Evalution</th>
                                        <th>Size</th>
                                        <th>Frequency</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Sr No</th>
                                        <!-- <th>Operation Name</th> -->

                                        <th>Product</th>
                                        <th>Process</th>
                                        <th>Specification Tolerance</th>
                                        <th>Evalution</th>
                                        <th>Size</th>
                                        <th>Frequency</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php

                                    $i = 1;
                                    foreach ($operation_data as $u) {
                                        //$product_into = $this->Ojwebsitemodel->get_product_info_new($u->product_id);
                                        //    $segments = $this->Common_admin_model->delete_user_by_id("segments","id",$u->segment_id);
                                        // $segments = $this->Common_admin_model->get_data_by_id("segments",$u->segment_id,"id");
                                    ?>


                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <!-- <td><?php echo $u->operation_name ?></td> -->
                                            <td><?php echo $u->product ?></td>
                                            <td><?php echo $u->process ?></td>
                                            <td><?php echo $u->specification_tolerance ?></td>
                                            <td><?php echo $u->evalution ?></td>
                                            <td><?php echo $u->size ?></td>
                                            <td><?php echo $u->frequency ?></td>



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