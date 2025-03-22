<div class="wrapper">
   <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Challan</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo base_url(''); ?>">Home</a></li>
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

                                </h3>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary float-left" data-toggle="modal" data-target="#exampleModal">
                                    Add Challan </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="<?php echo base_url('generate_challan_subcon'); ?>" method="post">


                                                    <!-- <div class="form-group">
                                                        <label for="Enter Challan Number">Challan Number <span class="text-danger">*</span> </label>
                                                        <input type="text" name="challan_number" placeholder="Challan Number " required class="form-control">
                                                    </div> -->

                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label for="Enter Challan Number">Select Customer <span class="text-danger">*</span> </label>

                                                                <select class="form-control select2" name="customer_id" style="width: 100%;">

                                                                    <?php
                                                                    if ($customer) {
                                                                        foreach ($customer as $c) {
                                                                    ?>
                                                                            <option value="<?php echo $c->id; ?>">
                                                                                <?php echo $c->customer_name; ?></option>
                                                                    <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label for="">Enter Customer Challan Number </label>
                                                                <input type="text" placeholder="Enter Remark" value="" name="customer_challan_number" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label for="">Enter Remark </label>
                                                                <input type="text" placeholder="Enter Remark" value="" name="remark" class="form-control">
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label for="">Enter Mode Of Transport </label>
                                                                <input type="text" placeholder="Enter Mode Of Transport" value="" name="mode" class="form-control">
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label for="">Enter Transporter </label>
                                                                <input type="text" placeholder="Enter Transporter" value="" name="transpoter" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label for="">Enter Vehicle No. </label>
                                                                <input type="text" placeholder="Enter Vehicle No" value="" name="vechical_number" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label for="">Enter L.R No </label>
                                                                <input type="text" placeholder="Enter L.R No" value="" name="l_r_number" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>






                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save
                                                    changes</button>
                                            </div>
                                        </div>
                                        </form>



                                    </div>
                                </div>
                            </div>

                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <!-- <th>Action</th> -->

                                            <th>Challan Number</th>
                                            <th>Remark</th>
                                            <th>Vehicle Number</th>
                                            <th>Mode Of Transport</th>
                                            <th>Transporter</th>
                                            <th>L.R number</th>
                                            <th>View Details</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $i = 1;
                                        if ($challan) {
                                            foreach ($challan as $c) {


                                        ?>

                                                <tr>

                                                    <td><?php echo $i ?></td>


                                                    <td><?php echo $c->challan_number ?></td>
                                                    <td><?php echo $c->remark ?></td>
                                                    <td><?php echo $c->vechical_number ?></td>
                                                    <td><?php echo $c->mode ?></td>
                                                    <td><?php echo $c->transpoter ?></td>
                                                    <td><?php echo $c->l_r_number ?></td>

                                                    <td>
                                                        <a class="btn btn-primary" href="<?php echo base_url('view_challan_by_id_subcon/') . $c->id; ?>">View
                                                            Details</a>
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