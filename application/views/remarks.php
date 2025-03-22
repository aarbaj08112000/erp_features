<div class="wrapper">

<div class="content-wrapper" >
  

  <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Rejection Remark</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
                            <li class="breadcrumb-item active">Rejection Remark</li>
                        </ol>
                    </div>

                </div>
            </div><!-- /.container-fluid -->
        </section>
    <section class="content">
        <div>
            <div class="row"><br>
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
                                    <form action="<?php echo base_url('add_rejection_remark') ?>" method="POST" enctype="multipart/form-data">
                                       <div class="form-group">
                                            <label for="on click url">Rejection Remark <span class="text-danger">*</span></label> <br>
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
                                Add Rejection Remark
                            </button>
                        </div>


                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Sr No</th>
                                        <th> Name</th>
                                        <!-- <th>Actions</th> -->
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php

                                    $i = 1;
                                    foreach ($operations as $u) {
                                    ?>


                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $u->name ?></td>
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