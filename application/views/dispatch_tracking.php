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
                        <h1>Dispatch Tracking</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dispatch Tracking</li>
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
                                    Dispatch Tracking

                                </h3>
                                <!-- Button trigger modal -->

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>SO Line</th>
                                            <th>PO-SO Number</th>
                                            <th>Customer Name</th>
                                            <th>Contractor Name</th>
                                            <th>Project no</th>
                                            <th>Start Date</th>
                                            <th>Target Date</th>
                                            <th>WBS no</th>
                                            <th>Transport Details</th>
                                            <th>Completed Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        $s = $i + 1000;
                                        if ($c_po_so) {
                                            foreach ($c_po_so as $l) {
                                                $customer_i = $this->Crud->get_data_by_id("po_details", $l->po_id, "id");
                                                $customer_name = $this->Crud->get_data_by_id("customer", $customer_i[0]->customer_id, "id");
                                                $contractor_i = $this->Crud->get_data_by_id("loading_user", $l->po_id, "po_number");
                                                $trackingg = $this->Crud->get_data_by_id("dispatch_tracking", $l->id, "c_po_so_id");

                                                // $transport = $trackingg[0]->transporter_name;

                                                if ($contractor_i) {
                                                    $contractor_name = $this->Crud->get_data_by_id("contractor", $contractor_i[0]->contractor, "id");
                                                    $project_number = $contractor_i[0]->project_number;
                                                    $start_date = $contractor_i[0]->start_date;
                                                    $target_date = $contractor_i[0]->target_date;
                                                    $wbs_id = $contractor_i[0]->wbs_id;
                                                    $wbs_num = $this->Crud->get_data_by_id("other_data", $wbs_id, "id");
                                                    $wbs_numm = $wbs_num[0]->number;
                                                    $s =  $contractor_name[0]->contractor_name;
                                                } else {
                                                    $s = "No Data";
                                                    $project_number = "No Data";
                                                    $start_date = "No Data";
                                                    $target_date = "No Data";
                                                    $wbs_numm = "No Data";
                                                }

                                        ?>
                                                <?php if ($wbs_numm != 'No Data') { ?>
                                                    <tr>
                                                        <td><?php echo $i ?></td>
                                                        <td><?php echo $customer_name[0]->customer_name ?></td>
                                                        <td style="width: 130px;"><?php echo $customer_i[0]->po_number . " / " . $l->so_number ?></td>
                                                        <td><?php echo  $customer_name[0]->customer_name ?></td>
                                                        <td><?php echo $s ?></td>
                                                        <td><?php echo $project_number; ?></td>
                                                        <td><?php echo $start_date; ?></td>
                                                        <td><?php echo $target_date; ?></td>
                                                        <td style="width: 120px;"><?php echo $wbs_numm; ?></td>
                                                        <td style="width: 150px;">
                                                            <?php
                                                            if ($contractor_i &&  !$trackingg) {
                                                            ?>
                                                                <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#add<?php echo $i  ?>">
                                                                    Add </button>
                                                            <?php }

                                                            ?>
                                                            <!-- Modal -->
                                                            <div class="modal fade" id="add<?php echo $i  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog  " role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">Add Transporter </h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form action="<?php echo base_url('addTransport') ?>" method="POST">
                                                                                <div class="row">
                                                                                    <div class="col-lg-12">




                                                                                        <div class="form-group">
                                                                                            <label for="so_number">Weight </label><span class="text-danger">*</span>
                                                                                            <input type="number" name="weight" required class="form-control" id="exampleInputEmail1" placeholder="Enter Weight" aria-describedby="emailHelp">

                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label for="so_amt">Enter Transporter Name </label><span class="text-danger">*</span>
                                                                                            <input type="text" name="transporter_name" required class="form-control" id="exampleInputEmail1" placeholder="Enter Transporter Name" aria-describedby="emailHelp">
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label for="so_amt">Enter Vehicle Number </label><span class="text-danger">*</span>
                                                                                            <input type="text" name="vehicle_number" required class="form-control" id="exampleInputEmail1" placeholder="Enter Vehicle Number" aria-describedby="emailHelp">
                                                                                        </div>



                                                                                        <div class="form-group ">
                                                                                            <label for="bank_name">LR Number </label><span class="text-danger">*</span>
                                                                                            <input type="text" name="lr_number" class="form-control adv_amt" id="bank_name" placeholder="Enter LR Number" aria-describedby="emailHelp">
                                                                                        </div>

                                                                                        <div class="form-group ">
                                                                                            <label for="so_line">Date </label>
                                                                                            <input type="date" name="dispatch_date" class="form-control adv_amt" id="cheque_date" placeholder="Enter SO-Line" aria-describedby="emailHelp">
                                                                                            <input type="hidden" name="id" value="<?php echo $l->id ?>" class="form-control adv_amt" id="cheque_date" placeholder="Enter SO-Line" aria-describedby="emailHelp">
                                                                                        </div>




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
                                                            </div>
                                                            <?php if ($trackingg) { ?>
                                                                <button type="submit" data-toggle="modal" data-dismiss="modal" class="btn btn-sm btn-primary view_transport_details  " data-target="#exampleModaledit2<?php echo $i ?>"> <i class="fa fa-eye"></i></button>
                                                            <?php } ?>
                                                            <div class="modal fade" id="exampleModaledit2<?php echo $i ?>"" tabindex=" -1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-lg" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">Transport Details</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <table id="example1" class="table table-bordered table-striped">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>Sr. No.</th>
                                                                                        <th>Weight</th>
                                                                                        <th>Transporter Name</th>
                                                                                        <th>Vehicle Number</th>
                                                                                        <th>LR Number</th>
                                                                                        <th>Dispatch Date</th>

                                                                                        <th style="width: 150px;">Action</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <?php
                                                                                    $transporter = 1;
                                                                                    if ($trackingg) {
                                                                                        foreach ($trackingg as $tda) {


                                                                                    ?>
                                                                                            <tr>
                                                                                                <td><?php echo $transporter ?></td>
                                                                                                <td><?php echo $tda->weight ?></td>
                                                                                                <td><?php echo $tda->transporter_name ?></td>
                                                                                                <td><?php echo $tda->vehicle_number ?></td>
                                                                                                <td><?php echo $tda->lr_number ?></td>
                                                                                                <td><?php echo $tda->dispatch_date ?></td>
                                                                                                <td>
                                                                                                    <button type="submit" data-toggle="modal" class="btn btn-sm btn-primary" data-target="#updatee<?php echo $transporter ?>"> <i class="fas fa-edit"></i></button>
                                                                                                    <div class="modal fade" id="updatee<?php echo $transporter ?>" tabindex=" -1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                                                        <div class="modal-dialog modal-lg" role="document">
                                                                                                            <div class="modal-content">
                                                                                                                <div class="modal-header">
                                                                                                                    <h5 class="modal-title" id="exampleModalLabel">Update </h5>
                                                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                                        <span aria-hidden="true">&times;</span>
                                                                                                                    </button>
                                                                                                                </div>
                                                                                                                <div class="modal-body">

                                                                                                                    <form action="<?php echo base_url('updateTransport') ?>" method="POST">
                                                                                                                        <div class="row">
                                                                                                                            <div class="col-lg-12">
                                                                                                                                <div class="form-group">
                                                                                                                                    <label for="so_number">Weight </label><span class="text-danger">*</span>
                                                                                                                                    <input type="number" value="<?php echo $tda->weight ?>" name="uweight" required class="form-control" id="exampleInputEmail1" placeholder="Enter Weight" aria-describedby="emailHelp">

                                                                                                                                </div>
                                                                                                                                <div class="form-group">
                                                                                                                                    <label for="so_amt">Enter Transporter Name </label><span class="text-danger">*</span>
                                                                                                                                    <input type="text" value="<?php echo $tda->transporter_name ?>" name="utransporter_name" required class="form-control" id="exampleInputEmail1" placeholder="Enter Transporter Name" aria-describedby="emailHelp">
                                                                                                                                </div>
                                                                                                                                <div class="form-group">
                                                                                                                                    <label for="so_amt">Enter Vehicle Number </label><span class="text-danger">*</span>
                                                                                                                                    <input type="text" value="<?php echo $tda->vehicle_number ?>" name="uvehicle_number" required class="form-control" id="exampleInputEmail1" placeholder="Enter Vehicle Number" aria-describedby="emailHelp">
                                                                                                                                </div>



                                                                                                                                <div class="form-group ">
                                                                                                                                    <label for="bank_name">LR Number </label><span class="text-danger">*</span>
                                                                                                                                    <input type="text" value="<?php echo $tda->lr_number ?>" name="ulr_number" class="form-control adv_amt" id="bank_name" placeholder="Enter LR Number" aria-describedby="emailHelp">
                                                                                                                                </div>

                                                                                                                                <div class="form-group ">
                                                                                                                                    <label for="so_line">Date </label>
                                                                                                                                    <input type="date" value="<?php echo $tda->dispatch_date ?>" name="udispatch_date" class="form-control adv_amt" id="cheque_date" placeholder="Enter SO-Line" aria-describedby="emailHelp">
                                                                                                                                    <input type="hidden" name="uid" value="<?php echo $tda->id ?>" class="form-control adv_amt" id="cheque_date" placeholder="Enter SO-Line" aria-describedby="emailHelp">
                                                                                                                                </div>
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
                                                                                                    </div>
                                                                                                    <!-- <button type="submit" data-toggle="modal" class="btn btn-sm btn-danger ml-4" data-target="#deleteee"> <i class="far fa-trash-alt"></i></button> -->

                                                                                                    <div class="modal fade" id="deleteee" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                                                        <div class="modal-dialog" role="document">
                                                                                                            <div class="modal-content">
                                                                                                                <div class="modal-header">
                                                                                                                    <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                                                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                                        <span aria-hidden="true">&times;</span>
                                                                                                                    </button>
                                                                                                                </div>
                                                                                                                <div class="modal-body">
                                                                                                                    <form action="<?php echo base_url('delete') ?>" method="POST">

                                                                                                                        <input value="<?php echo $tda->id; ?>" name="id" type="hidden" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Machine Name">
                                                                                                                        <input value="dispatch_tracking" name="table_name" type="hidden" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Machine Name">

                                                                                                                        Are you sure you want to delete
                                                                                                                </div>
                                                                                                                <div class="modal-footer">
                                                                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                                                                    <button type="submit" class="btn btn-danger">Delete </button>
                                                                                                                </div>
                                                                                                                </form>

                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>

                                                                                                </td>

                                                                                            </tr>
                                                                                    <?php
                                                                                            $transporter++;
                                                                                        }
                                                                                    }
                                                                                    ?>
                                                                                </tbody>
                                                                                <tfoot>
                                                                                    <tr>
                                                                                        <th>Sr. No.</th>
                                                                                        <th>Weight</th>
                                                                                        <th>Transporter Name</th>
                                                                                        <th>Vehicle Number</th>
                                                                                        <th>LR Number</th>
                                                                                        <th>Dispatch Date</th>
                                                                                        <th>Action</th>
                                                                                    </tr>
                                                                                </tfoot>
                                                                            </table>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                                <!-- <button type="submit" class="btn btn-primary">Save changes</button> -->
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <?php if ($contractor_i && $trackingg) { ?>
                                                                <?php echo $trackingg[0]->completed_date ?>
                                                            <?php } else {
                                                            ?>
                                                                <span>Add Date</span>

                                                            <?php

                                                            }
                                                            ?>


                                                            <button type="submit" data-toggle="modal" id="disable_completed" data-dismiss="modal" class="btn btn-sm btn-primary ml-3" data-target="#completedd<?php echo $i ?>"> <i class="fa fa-eye"></i></button>
                                                            <!-- Modal -->
                                                            <div class="modal fade" id="completedd<?php echo $i  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog  " role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <?php
                                                                            if ($trackingg) {
                                                                            ?>
                                                                                <h5 class="modal-title" id="exampleModalLabel">Add Date </h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                                <?php } else {?>
                                                                                    <h5 class="modal-title" id="exampleModalLabel">Add Transport Details First </h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                                <?php }?>

                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form action="<?php echo base_url('updateCompletedDate') ?>" method="POST">
                                                                                <div class="row">
                                                                                    <div class="col-lg-12">
                                                                                    <?php
                                                                            if ($trackingg) {
                                                                            ?>

                                                                                        <div class="form-group ">
                                                                                            <?php if ($contractor_i) { ?>
                                                                                                <label for="so_line">Date </label>
                                                                                                <input type="date" value="<?php echo $trackingg[0]->completed_date ?>" name="completed_date" class="form-control adv_amt" id="completed_date" placeholder="Enter SO-Line" aria-describedby="emailHelp">

                                                                                                <input type="hidden" name="comoleted_id" value="<?php echo $trackingg[0]->id ?>" class="form-control adv_amt" id="cheque_date" placeholder="Enter SO-Line" aria-describedby="emailHelp">
                                                                                            <?php } else {
                                                                                            ?>
                                                                                                <label for="so_line">Not Loaded </label>

                                                                                            <?php

                                                                                            }
                                                                                            ?>
                                                                                        </div>
                                                                                    
                                                                                        <?php } ?>



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
                                                            </div>
                                                            <script>
                                                                $(function() {
                                                                    var dtToday = new Date();

                                                                    var month = dtToday.getMonth() + 1;
                                                                    var day = dtToday.getDate();
                                                                    var year = dtToday.getFullYear();
                                                                    if (month < 10)
                                                                        month = '0' + month.toString();
                                                                    if (day < 10)
                                                                        day = '0' + day.toString();

                                                                    var maxDate = year + '-' + month + '-' + day;
                                                                    //alert(maxDate);
                                                                    $('#completed_date').attr('max', maxDate);
                                                                });
                                                            </script>
                                                        </td>

                                                    </tr>
                                                <?php } ?>
                                        <?php
                                                $i++;
                                                $s++;
                                            }
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>SO Line</th>
                                            <th>PO-SO Number</th>
                                            <th>Customer Name</th>
                                            <th>Contractor Name</th>
                                            <th>Project no</th>
                                            <th>Start Date</th>
                                            <th>Target Date</th>
                                            <th>WBS no</th>
                                            <th>Transport Details</th>
                                            <th>Completed Date</th>

                                        </tr>
                                    </tfoot>
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