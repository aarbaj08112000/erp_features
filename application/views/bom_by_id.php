<div style="width:100%" class="wrapper">
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
                        <!-- <h1></h1> -->
                        <form action="<?php echo base_url('') ?>" method="POST">
                            <div class="row">
                                <div class="col-lg-6">
                                    <!-- <div class="form-group">
                                                                <label for="operation_number">Operation Number</label><span class="text-danger">*</span>
                                                                <input type="text" name="operationNumber" class="form-control" required id="exampleInputPassword1" placeholder="Operation Number">

                                                        </div>-->
                                    <div class="form-group">
                                        <label for="po_num">Part Number </label><span class="text-danger">*</span>
                                        <input type="text" readonly value="<?php echo $customer[0]->part_number ?>"
                                            name="part_number" required class="form-control" id="exampleInputEmail1"
                                            placeholder="Enter Part Number" aria-describedby="emailHelp">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <!-- <div class="form-group">
                                                                <label for="operation_number">Operation Number</label><span class="text-danger">*</span>
                                                                <input type="text" name="operationNumber" class="form-control" required id="exampleInputPassword1" placeholder="Operation Number">

                                                        </div>-->
                                    <div class="form-group">
                                        <label for="po_num">Part Description </label><span class="text-danger">*</span>
                                        <input type="text" readonly value="<?php echo $customer[0]->part_description ?>"
                                            name="part_desc" required class="form-control" id="exampleInputEmail1"
                                            placeholder="Enter Part Description" aria-describedby="emailHelp">
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Customer item part</li>
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
                                <!-- Button trigger modal -->
                                <a class="btn btn-dark"
                                    href="<?php echo base_url('bom/') . $customer[0]->customer_id; ?>">
                                    < Back </a>
                                <button type="button" class="btn btn-primary " data-toggle="modal"
                                    data-target="#exampleModal">
                                    Add </button>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog " role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="<?php echo base_url('addbom') ?>" method="POST">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <!-- <div class="form-group">
                                                                <label for="operation_number">Operation Number</label><span class="text-danger">*</span>
                                                                <input type="text" name="operationNumber" class="form-control" required id="exampleInputPassword1" placeholder="Operation Number">
                                                        </div>-->
                                                            <!-- <div class="form-group">
                                                                <label> Customer Part </label><span class="text-danger">*</span>
                                                                <select class="form-control select2" name="customer_part_id" style="width: 100%;">
                                                                    <?php
                                                                    foreach ($customer_part_list as $c) {
                                                                    ?>
                                                                        <option value="<?php echo $c->id; ?>"><?php echo $c->part_number; ?>/<?php echo $c->part_description; ?></option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div> -->
                                                            <div class="form-group">
                                                                <label> item part </label><span
                                                                    class="text-danger">*</span>
                                                                <select class="form-control select2"
                                                                    name="child_part_id" style="width: 100%;">
                                                                    <?php
                                                                    foreach ($child_part_list as $c1) {
                                                                    ?>
                                                                    <option value="<?php echo $c1->id; ?>">
                                                                        <?php echo $c1->part_number; ?>/<?php echo $c1->part_description; ?>
                                                                    </option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="po_num">Quantity</label><span
                                                                    class="text-danger">*</span>
                                                                <input type="number" step="any" name="quantity" required
                                                                    class="form-control" id="exampleInputEmail1"
                                                                    placeholder="Enter Quantity"
                                                                    aria-describedby="emailHelp">
                                                                <input type="hidden" name="customer_part_id"
                                                                    value="<?php echo $customer[0]->id; ?>" required
                                                                    class="form-control" id="exampleInputEmail1"
                                                                    placeholder="Enter Quantity"
                                                                    aria-describedby="emailHelp">
                                                            </div>
                                                        </div>


                                                        <!-- <div class="col-lg-6">

                                                            <div class="form-group">
                                                                <label for="operation_name">Operation Name</label><span class="text-danger">*</span>
                                                                <input type="text" name="operataionName" class="form-control" required id="exampleInputPassword1" placeholder="Operation Name ">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="fixture_number">Fixture Number</label><span class="text-danger">*</span>
                                                                <input type="text" name="fixtureNumber" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Fixture Number">
                                                            </div>
                                                        </div> -->

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save
                                                            changes</button>
                                                    </div>
                                                </form>

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
                                            <!-- <th>Customer Part Number</th> -->
                                            <th>Item part Number</th>
                                            <th>Item part Description</th>
                                            <th>Quantity</th>
                                            <th>UOM</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <!-- <th>Customer Part Number</th> -->
                                            <th>Item part Number</th>
                                            <th>Item part Description</th>
                                            <th>Quantity</th>
                                            <th>UOM</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        if ($bom_list) {
                                            foreach ($bom_list as $po) {
                                                $child_part_data = $this->Crud->get_data_by_id("child_part", $po->child_part_id, "id");
                                                $uom_data = $this->Crud->get_data_by_id("uom", $child_part_data[0]->uom_id, "id");
                                        ?>
                                        <tr>
                                            <td><?php echo $i ?></td>
                                            <td><?php echo $child_part_data[0]->part_number ?></td>
                                            <td><?php echo $child_part_data[0]->part_description ?></td>
                                            <td><?php echo $po->quantity ?></td>
                                            <td><?php echo $uom_data[0]->uom_name ?></td>
                                            <td>
                                                <button type="submit" data-toggle="modal" class="btn btn-sm btn-primary"
                                                    data-target="#exampleModaledit2<?php echo $i ?>"> <i
                                                        class="fas fa-edit"></i></button>
                                                <div class="modal fade"
                                                    id="exampleModaledit2<?php echo $i ?>"" tabindex=" -1" role="dialog"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog " role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Update
                                                                    Oeration</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="<?php echo base_url('updatebom') ?>"
                                                                    method="POST">
                                                                    <div class="row">
                                                                        <div class="col-lg-12">

                                                                            <div class="form-group">
                                                                                <input value="<?php echo $po->id ?>"
                                                                                    type="hidden" name="id" required
                                                                                    class="form-control"
                                                                                    id="exampleInputEmail1"
                                                                                    aria-describedby="emailHelp"
                                                                                    placeholder="Customer Name">
                                                                                <input
                                                                                    value="<?php echo $customer[0]->id ?>"
                                                                                    type="hidden" name="customer_id"
                                                                                    required class="form-control"
                                                                                    id="exampleInputEmail1"
                                                                                    aria-describedby="emailHelp"
                                                                                    placeholder="Customer Name">

                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label> item part </label><span
                                                                                    class="text-danger">*</span>
                                                                                <select class="form-control select2"
                                                                                    name="child_part_id"
                                                                                    style="width: 100%;">
                                                                                    <?php
                                                                                            foreach ($child_part_list as $c1) {
                                                                                            ?>
                                                                                    <option <?php
                                                                                                        if ($c1->id == $po->child_part_id) {
                                                                                                            echo " selected ";
                                                                                                        } else {
                                                                                                            echo " ";
                                                                                                        } ?>
                                                                                        value="<?php echo $c1->id; ?>">
                                                                                        <?php echo $c1->part_number; ?>/<?php echo $c1->part_description; ?>
                                                                                    </option>
                                                                                    <?php
                                                                                            }
                                                                                            ?>
                                                                                </select>
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label
                                                                                    for="po_num">Quantity</label><span
                                                                                    class="text-danger">*</span>
                                                                                <input type="number" step="any"
                                                                                    value="<?php echo $po->quantity; ?>"
                                                                                    name="quantity" required
                                                                                    class="form-control"
                                                                                    id="exampleInputEmail1"
                                                                                    placeholder="Enter Quantity"
                                                                                    aria-describedby="emailHelp">
                                                                            </div>
                                                                        </div>



                                                                    </div>




                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Save
                                                                    changes</button>
                                                            </div>
                                                            </form>
                                                        </div>

                                                    </div>
                                                </div>
                            </div>
                            <!-- <button type="submit" data-toggle="modal" class="btn btn-sm btn-danger ml-4" data-target="#exampleModal3"> <i class="far fa-trash-alt"></i></button> -->
                            <!-- Button trigger modal -->
                            <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                                    Launch demo modal
                                                </button> -->

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
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

                                                <input value="<?php echo $po->id; ?>" name="id" type="hidden" required
                                                    class="form-control" id="exampleInputEmail1"
                                                    aria-describedby="emailHelp" placeholder="Enter Machine Name">
                                                <input value="bom" name="table_name" type="hidden" required
                                                    class="form-control" id="exampleInputEmail1"
                                                    aria-describedby="emailHelp" placeholder="Enter Machine Name">

                                                Are you sure you want to delete
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-danger">Delete </button>
                                        </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                            <!-- <a href="<?php echo base_url("po/" . $po->id) ?>" id="add_so_hover" class="btn btn-sm btn-primary ml-4 remove_hoverr add_so_hover"> <i class="fa fa-eye"></i></a> -->

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