<?php if($entitlements['isPLMEnabled']) { ?>
<div style="width:2000px" class="wrapper">
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
                        <h1>Customer Part Drawing</h1>
                    </div>
                    <!-- <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                            <li class="breadcrumb-item active">Customer Part</li>
                        </ol>
                    </div>-->
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-9">
                        <!-- /.card -->
                        <div class="card">
                            <div class="card-header">
                            <div class="row">
                            <div class="col-lg-1">
                                <h3 class="card-title"></h3>
                                <br><a href="<?php echo base_url('customer_part_drawing/'.$customerid); ?>" class="btn btn-danger ">< Back </a>
                            </div>
                             <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="">Customer Name</label>
                                            <input type="text" readonly value="<?php echo $customer_data[0]->customer_name; ?>" name="customer_name" class="form-control">
                                        </div>

                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="">Part Name</label>
                                            <input type="text" readonly value="<?php echo $customer_part[0]->part_number; ?>" name="part_name" class="form-control">
                                        </div>

                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="">Part Description</label>
                                            <input type="text" readonly value="<?php echo $customer_part[0]->part_description; ?>" name="part_desc" class="form-control">
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
                                            <th>Revision Number</th>
                                            <th>Revision Date</th>
                                            <th>Revision Remark</th>
                                            <th>Drawing</th>
                                            <th>Cad File</th>
                                            <th>3D Model</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Revision Number</th>
                                            <th>Revision Date</th>
                                            <th>Revision Remark</th>
                                            <th>Drawing</th>
                                            <th>Cad File</th>
                                            <th>3D Model</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        if ($customer_part_rate) {
                                            foreach ($customer_part_rate as $poo) {
                                                if (true) {
                                        ?>

                                                    <tr>
                                                        <td><?php echo $i ?></td>
                                                        <td><?php echo $poo->revision_no ?></td>
                                                        <td><?php echo $poo->revision_date ?></td>
                                                        <td><?php echo $poo->revision_remark ?></td>
                                                        <td><?php
                                                            if ($poo->drawing != "") {
                                                            ?>
                                                                <a download href="<?php echo base_url('documents/') . $poo->drawing ?>" id="" class="btn btn-sm btn-primary remove_hoverr "><i class="fas fa-download"></i></a>

                                                            <?php
                                                            }
                                                            ?>
                                                        </td>
                                                        <td><?php
                                                            if ($poo->cad != "") {
                                                            ?>
                                                                <a download href="<?php echo base_url('documents/') . $poo->cad ?>" id="" class="btn btn-sm btn-primary remove_hoverr "><i class="fas fa-download"></i></a>

                                                            <?php
                                                            }
                                                            ?>
                                                        </td>
                                                        <td><?php
                                                            if ($poo->model != "") {
                                                            ?>
                                                                <a download href="<?php echo base_url('documents/') . $poo->model ?>" id="" class="btn btn-sm btn-primary remove_hoverr "><i class="fas fa-download"></i></a>

                                                            <?php
                                                            }
                                                            ?>
                                                        </td>



                                                    </tr>
                                        <?php
                                                    $i++;
                                                }
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
    <?php } ?>
    <!-- /.content-wrapper -->