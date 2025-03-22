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
                        <h1>Loading User</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Loading User</li>
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
                                    <form class="form-inline">
                                        <div class="form-group mb-2">
                                            <label for="" class="p-2">PO-Number</label>
                                            <input type="text" readonly name="PO" value="<?php echo $po_details[0]->po_number ?>" class="form-control" required id="exampleInputPassword1" placeholder="Operation Number">
                                        </div>
                                        <div class="form-group mx-sm-3 mb-2">
                                            <label for="inputPassword2" class="p-2">Customer Name</label>
                                            <input type="text" readonly name="custname" value="<?php echo $cust[0]->customer_name ?>" class="form-control" id="exampleInputEmail1" placeholder="Fixture Name" aria-describedby="emailHelp">
                                        </div>
                                    </form>

                                </h3>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary float-right" onclick="wbsfunc()" data-toggle="modal" data-target="#exampleModal">
                                    Assign Contractor To Project </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog  " role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Assign Contractor To Project </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="<?php echo base_url('addLoadingUser') ?>" method="POST">
                                                    <div class="row">
                                                        <div class="col-lg-6">


                                                            <div class="form-group">
                                                                <label> So Number/Description </label><span class="text-danger">*</span>
                                                                <input type="hidden" readonly name="PO" value="<?php echo $po_details[0]->id ?>" class="form-control" required id="exampleInputPassword1" placeholder="Operation Number">

                                                                <select class="form-control select2" required name="so_number" style="width: 100%;">
                                                                    <?php
                                                                    foreach ($loading_details as $c) {
                                                                    ?>
                                                                        <option value="<?php echo $c->id; ?>"><?php echo $c->so_number . " / " . $c->so_desc; ?></option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label> Project Number </label><span class="text-danger">*</span>
                                                                <input type="text" name="project_number" required class="form-control" id="exampleInputEmail1" placeholder="Enter Project Number" aria-describedby="emailHelp">

                                                            </div>
                                                            <div class="form-group">
                                                                <label> Project Start Date </label><span class="text-danger">*</span>
                                                                <input type="date" name="start_date" required class="form-control" id="exampleInputEmail1" placeholder="Enter Project Start Date" aria-describedby="emailHelp">

                                                            </div>




                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label> Contractor Name/Code </label><span class="text-danger">*</span>
                                                                <select class="form-control select2" required name="contractor" style="width: 100%;">
                                                                    <?php
                                                                    foreach ($contractor as $c) {
                                                                    ?>
                                                                        <option value="<?php echo $c->id; ?>"><?php echo $c->contractor_name . " / " . $c->contractor_code ?></option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>

                                                            <div class="form-group aass">
                                                                <label> WBS Number</label><span class="text-danger">*</span>

                                                                <select class="form-control select2 " id="wbs_number" name="wbs_number" style="width: 100%;">
                                                                    <?php

                                                                    foreach ($wbs_num as $c) {
                                                                    ?>


                                                                        <option value="<?php echo $c->id; ?>"><?php echo $c->number; ?></option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>


                                                            <div class="form-group">
                                                                <label> Target Date </label><span class="text-danger">*</span>
                                                                <input type="date" name="target_date" required class="form-control" id="exampleInputEmail1" placeholder="Enter Project Target Date" aria-describedby="emailHelp">

                                                            </div>

                                                        </div>


                                                        <script>

                                                        function wbsfunc(){
                                                            // alert("a");
                                                            var test = <?php echo $wbs_num ?>;
                                                            // alert(test);
                                                            if(test == 0){
                                                                document.getElementById("wbs_unavailable").setAttribute("disabled", "true"); 
                                                            }
                                                        }
                                                 
                                                        </script>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" id="wbs_unavailable" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                </form>
                                                <script>
                                                    //    var i = $('#wbs_number').val();

                                                    //    alert(i);
                                                </script>
                                            </div>

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
                                            <th>SO Number/ Description</th>
                                            <th>Contractor Name/ Contractor Code </th>
                                            <th>Project Number </th>
                                            <th>Start Date </th>
                                            <th>Target Date </th>
                                            <th>WBS Number </th>
                                            <th style="width: 200px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        if ($details) {
                                            foreach ($details as $l) {
                                                $wbs = $this->Crud->get_data_by_id('other_data', $l->wbs_id, 'id');
                                                $so = $this->Crud->get_data_by_id('c_po_so', $l->so_number, 'id');
                                                $detail_contractor = $this->Crud->get_data_by_id("contractor", $l->contractor, "id");
                                                // $detail_contractor1 = $this->Crud->get_data_by_id("contractor", $details[0]->contractor, "contractor_name");
                                                // print_r($detail_contractor);
                                        ?>

                                                <tr>
                                                    <td><?php echo $i ?></td>
                                                    <td><?php echo $so[0]->so_number . " / " . $so[0]->so_desc  ?></td>
                                                    <td><?php echo $detail_contractor[0]->contractor_name . " / " . $detail_contractor[0]->contractor_code  ?></td>
                                                    <td><?php echo $l->project_number ?></td>
                                                    <td><?php echo $l->start_date ?></td>
                                                    <td><?php echo $l->target_date ?></td>
                                                    <td><?php echo $wbs[0]->number ?></td>



                                                    <td>
                                                        <button type="submit" data-toggle="modal" class="btn btn-sm btn-primary" data-target="#exampleModaledit2<?php echo $i ?>"> <i class="fas fa-edit"></i></button>
                                                        <div class="modal fade" id="exampleModaledit2<?php echo $i ?>"" tabindex=" -1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog " role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Update Oeration</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">

                                                                        <form action="<?php echo base_url('updateloading_user') ?>" method="POST">
                                                                            <div class="row">
                                                                                <div class="col-lg-6">


                                                                                    <div class="form-group">
                                                                                        <label> So Number/Description </label><span class="text-danger">*</span>
                                                                                        <input type="hidden" readonly name="PO" value="<?php echo $po_details[0]->id ?>" class="form-control" required id="exampleInputPassword1" placeholder="Operation Number">

                                                                                        <select class="form-control select2" name="uso_num" style="width: 100%;">
                                                                                            <?php
                                                                                            foreach ($loading_details as $c) {
                                                                                            ?>
                                                                                                <option <?php
                                                                                                        if ($c->id == $l->so_number) {
                                                                                                            echo "selected";
                                                                                                        } else {
                                                                                                            echo " ";
                                                                                                        }

                                                                                                        ?> value="<?php echo $c->id; ?>"><?php echo $c->so_number . " / " . $c->so_desc; ?></option>
                                                                                            <?php
                                                                                            }
                                                                                            ?>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label> Project Number </label><span class="text-danger">*</span>
                                                                                        <input type="text" value="<?php echo $l->project_number; ?>" name="uproject_number" required class="form-control" id="exampleInputEmail1" placeholder="Enter Project Number" aria-describedby="emailHelp">
                                                                                        <input type="hidden" value="<?php echo $l->id; ?>" name="id" required class="form-control" id="exampleInputEmail1" placeholder="Enter Project Number" aria-describedby="emailHelp">

                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label> Project Start Date </label><span class="text-danger">*</span>
                                                                                        <input type="date" value="<?php echo $l->start_date; ?>" name="ustart_date" required class="form-control" id="exampleInputEmail1" placeholder="Enter Project Start Date" aria-describedby="emailHelp">

                                                                                    </div>




                                                                                </div>
                                                                                <div class="col-lg-6">
                                                                                    <div class="form-group">
                                                                                        <label> Contractor Name/Code </label><span class="text-danger">*</span>
                                                                                        <select class="form-control select2" name="ucontractor" style="width: 100%;">
                                                                                            <?php
                                                                                            foreach ($contractor as $c) {
                                                                                            ?>
                                                                                                <option <?php
                                                                                                        if ($c->id == $l->contractor) {
                                                                                                            echo "selected";
                                                                                                        } else {
                                                                                                            echo " ";
                                                                                                        }

                                                                                                        ?> value="<?php echo $c->id; ?>"><?php echo $c->contractor_name . " / " . $c->contractor_code ?></option>
                                                                                            <?php
                                                                                            }
                                                                                            ?>
                                                                                        </select>
                                                                                    </div>

                                                                                    <div class="form-group">
                                                                                        <label> WBS Number</label><span class="text-danger">*</span>

                                                                                        <select class="form-control select2" name="uwbs_number" style="width: 100%;">
                                                                                            <?php

                                                                                            foreach ($wbs_num as $c) {
                                                                                            ?>
                                                                                                <option <?php
                                                                                                        if ($c->id == $l->wbs_id) {
                                                                                                            echo "selected";
                                                                                                        } else {
                                                                                                            echo " ";
                                                                                                        }

                                                                                                        ?> value="<?php echo $c->id; ?>"><?php echo $c->number; ?></option>
                                                                                            <?php
                                                                                            }
                                                                                            ?>
                                                                                        </select>
                                                                                    </div>

                                                                                    <div class="form-group">
                                                                                        <label> Target Date </label><span class="text-danger">*</span>
                                                                                        <input type="date" name="utarget_date" value="<?php echo $l->target_date; ?>" required class="form-control" id="exampleInputEmail1" placeholder="Enter Project Target Date" aria-describedby="emailHelp">

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
                                                        <button type="submit" data-toggle="modal" class="btn btn-sm btn-danger ml-4" data-target="#exampleModal3"> <i class="far fa-trash-alt"></i></button>
                                                        <!-- Button trigger modal -->
                                                        <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                                    Launch demo modal
                                                </button> -->

                                                        <!-- Modal -->
                                                        <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

                                                                            <input value="<?php echo $l->id; ?>" name="id" type="hidden" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Machine Name">
                                                                            <input value="loading_user" name="table_name" type="hidden" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Machine Name">

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
                                                        <!-- <a href="<?php echo base_url("po/" . $customer[0]->id) ?>" class="btn btn-sm btn-primary ml-4"> <i class="fa fa-eye"></i></a> -->

                                                    </td>
                                                </tr>
                                        <?php
                                                $i++;
                                            }
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>SO Number</th>
                                            <th>Contractor Name/ Contractor Code </th>
                                            <th>Project Number </th>
                                            <th>Start Date </th>
                                            <th>Target Date </th>
                                            <th>WBS Number </th>
                                            <th>Action</th>
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