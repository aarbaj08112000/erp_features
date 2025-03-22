<div class="wrapper">
    <!-- Navbar -->

    <!-- /.navbar -->

    <!-- Main Sidebar Container -->


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="width:2000px">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>item part Master</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">item part List</li>
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
                                <!-- <button type="button" class="btn btn-primary float-left" data-toggle="modal" data-target="#exampleModal">
                                    Add </button> -->

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
                                                <form action="<?php echo base_url('addchildpart') ?>" method="POST" enctype='multipart/form-data' s>
                                                    <div class="row">
                                                        <div class="col-lg-6">


                                                            <!-- <div class="form-group">
                                                                <label for="operation_number">Operation Number</label><span class="text-danger">*</span>
                                                                <input type="text" name="operationNumber" class="form-control" required id="exampleInputPassword1" placeholder="Operation Number">

                                                        </div>-->
                                                            <div class="form-group">
                                                                <label for="po_num">Part Number </label><span class="text-danger">*</span>
                                                                <input type="text" name="part_number" required class="form-control" id="exampleInputEmail1" placeholder="Enter Part Number" aria-describedby="emailHelp">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="po_num">Part Description </label><span class="text-danger">*</span>
                                                                <input type="text" name="part_desc" required class="form-control" id="exampleInputEmail1" placeholder="Enter Part Description" aria-describedby="emailHelp">
                                                            </div>
                                                            <!-- <div class="form-group">
                                                                <label for="po_num">Part Price </label><span class="text-danger">*</span>
                                                                <input type="text" name="part_rate" required class="form-control" id="exampleInputEmail1" placeholder="Enter Part Price" aria-describedby="emailHelp">
                                                            </div> -->
                                                            <div class="form-group">
                                                                <label for="po_num">Safety/buffer stock </label><span class="text-danger">*</span>
                                                                <input type="text" name="saft_stk" required class="form-control" id="exampleInputEmail1" placeholder="Enter Saftey/buffer stock" aria-describedby="emailHelp">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="po_num">HSN Code
                                                                    <input type="text" name="hsn_code" class="form-control" id="hsn_code" placeholder="Enter HSN Code" aria-describedby="emailHelp">
                                                            </div>


                                                            <div class="form-group">
                                                                <label> item part Type </label><span class="text-danger">*</span>
                                                                <select class="form-control select2" name="child_part_id" style="width: 100%;">
                                                                    <?php
                                                                    foreach ($cparttypelist as $c7) {
                                                                    ?>
                                                                        <option value="<?php echo $c7->id; ?>"><?php echo $c7->part_type_name; ?></option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <!-- <div class="form-group">
                                                                <label for="po_num">Revision Number</label><span class="text-danger">*</span>
                                                                <input type="text" name="revision_no" value="1" required class="form-control" id="exampleInputEmail1" placeholder="Enter Revision Number" aria-describedby="emailHelp">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="po_num">Revision Remark</label><span class="text-danger">*</span>
                                                                <input type="text" name="revision_remark" required class="form-control" id="exampleInputEmail1" placeholder="Enter Revision Remark" aria-describedby="emailHelp">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="po_num">Revision Date</label><span class="text-danger">*</span>
                                                                <input type="date" name="revision_date" required class="form-control" id="exampleInputEmail1" placeholder="Enter Revision Date" aria-describedby="emailHelp">
                                                            </div> -->


                                                            <!-- <div class="form-group">
                                                                <label> Supplier List </label><span class="text-danger">*</span>
                                                                <select class="form-control select2" name="supplier_id" style="width: 100%;">
                                                                    <?php
                                                                    foreach ($supplier_list as $c) {
                                                                    ?>
                                                                        <option value="<?php echo $c->id; ?>"><?php echo $c->supplier_name; ?></option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div> -->
                                                            <div class="form-group">
                                                                <label> UOM </label><span class="text-danger">*</span>
                                                                <select class="form-control select2" name="uom_id" style="width: 100%;">
                                                                    <?php
                                                                    foreach ($uom as $c1) {
                                                                    ?>
                                                                        <option value="<?php echo $c1->id; ?>"><?php echo $c1->uom_name; ?></option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="po_num">Part Drawing </label><span class="text-danger">*</span>
                                                                <input type="file" name="part_drawing" required class="form-control" id="hsn_code" placeholder="Enter HSN Code" aria-describedby="emailHelp">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="po_num">Modal </label>
                                                                <input type="file" name="modal" class="form-control" id="hsn_code" placeholder="Enter HSN Code" aria-describedby="emailHelp">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="po_num">Cad File </label>
                                                                <input type="file" name="cad_file" class="form-control" id="hsn_code" placeholder="Enter HSN Code" aria-describedby="emailHelp">
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
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                                    </div>
                                            </div>
                                            </form>

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
                                            <th>Action</th>
                                            <th>Revision Number</th>
                                            <th>Revision Remark</th>
                                            <th>Revision Date</th>
                                            <th>Part Number</th>
                                            <th>Part Description</th>
                                            <!-- <th>Supplier</th> -->
                                            <!-- <th>Part Price</th> -->
                                            <th>HSN Code</th>
                                            <th>UOM</th>
                                            <th>Safety/Buffer Stack</th>
                                            <th>item part Type</th>
                                            <th>Drawing</th>
                                            <th>CAD File</th>
                                            <th>Modal file</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>

                                            <th>Sr. No.</th>
                                            <th>Action</th>
                                            <th>Revision Number</th>
                                            <th>Revision Remark</th>
                                            <th>Revision Date</th>
                                            <th>Part Number</th>
                                            <th>Part Description</th>
                                            <!-- <th>Supplier</th>
                                            <th>Part Price</th> -->
                                            <th>HSN Code</th>
                                            <th>UOM</th>
                                            <th>Safety/Buffer Stack</th>
                                            <th>item part Type</th>
                                            <th>Drawing</th>
                                            <th>CAD File</th>
                                            <th>Modal file</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        if ($child_part_list) {
                                            foreach ($child_part_list as $poo) {

                                                $array = array(
                                                    "part_number" => $poo->part_number,

                                                );

                                                $po = $this->Crud->get_data_by_id_multiple_condition("child_part", $array);
                                                $supplier_data = $this->Crud->get_data_by_id("supplier", $poo->supplier_id, "id");
                                                $uom_data = $this->Crud->get_data_by_id("uom", $poo->uom_id, "id");
                                                $child_part_id = $this->Crud->get_data_by_id("part_type", $poo->child_part_id, "id");

                                                if(strtolower($poo->revision_no) != "na")
                                                {



                                                // print_r($supplier_data);
                                        ?>

                                                <tr>

                                                    <td><?php echo $i ?></td>
                                                    <td>
                                                        <!-- <button type="submit" data-toggle="modal" class="btn btn-sm btn-primary" data-target="#exampleModaledit2<?php echo $i ?>"> <i class="fas fa-edit"></i></button> -->
                                                        <!-- <a href="<?php echo base_url('drawing_history/') . $po->part_number; ?>" class="btn btn-sm btn-primary"> <i class="fas fa-history"></i></a> -->
                                                        <!-- <a href="<?php echo base_url(); ?>" class="btn btn-sm btn-primary">
                                                            <i class="fas fa-history"></i>

                                                        </a> -->

                                                        <div class="modal fade" id="exampleModaledit2<?php echo $i ?>" tabindex=" -1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog " role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Add Revision </h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form action="<?php echo base_url('updatechildpart') ?>" method="POST" enctype='multipart/form-data'>
                                                                            <div class="row">
                                                                                <div class="col-lg-6">

                                                                                    <input value="<?php echo $poo->id ?>" type="hidden" name="id" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Customer Name">

                                                                                    <div class="form-group">
                                                                                        <label for="po_num">Part Number </label><span class="text-danger">*</span>
                                                                                        <input type="text" value="<?php echo $poo->part_number  ?>" name="upart_number" readonly class="form-control" placeholder="Enter Part Number.">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="po_num">Part Description </label><span class="text-danger">*</span>
                                                                                        <input type="text" value="<?php echo $poo->part_description  ?>" name="upart_desc" readonly required class="form-control" id="exampleInputEmail1" placeholder="Enter Part Description">
                                                                                    </div>
                                                                                    <!-- <div class="form-group">
                                                                                        <label for="po_num">Part Price </label><span class="text-danger">*</span>
                                                                                        <input type="text" value="<?php echo $poo->part_rate  ?>" name="upart_rate" required class="form-control" id="exampleInputEmail1" placeholder="Enter Part Price">
                                                                                    </div> -->


                                                                                    <div class="form-group">
                                                                                        <label for="po_num">Safety/buffer stock </label><span class="text-danger">*</span>
                                                                                        <input type="text" value="<?php echo $poo->safty_buffer_stk  ?>" name="usaft_stk" readonly required class="form-control" id="exampleInputEmail1" placeholder="Enter Safety/buffer stock">
                                                                                        <input type="hidden" value="<?php echo $poo->hsn_code  ?>" name="hsn_code" readonly required class="form-control" id="exampleInputEmail1" placeholder="Enter Safety/buffer stock">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label> item part Type </label><span class="text-danger">*</span>
                                                                                        <select class="form-control select2" name="child_part_id" readonly style="width: 100%;">
                                                                                            <?php
                                                                                            foreach ($cparttypelist as $c7) {
                                                                                            ?>
                                                                                                <option <?php
                                                                                                        if ($c7->id == $poo->child_part_id) {
                                                                                                            echo " selected ";
                                                                                                        } else {
                                                                                                            echo " ";
                                                                                                        } ?> value="<?php echo $c7->id; ?>"><?php echo $c7->part_type_name; ?></option>
                                                                                            <?php
                                                                                            }
                                                                                            ?>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="po_num">Part Drawing </label><span class="text-danger">*</span>
                                                                                        <input type="file" name="part_drawing" required class="form-control" id="hsn_code" placeholder="Enter HSN Code" aria-describedby="emailHelp">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="po_num">Cad File </label>
                                                                                        <input type="file" name="cad_file" class="form-control" id="hsn_code" placeholder="Enter HSN Code" aria-describedby="emailHelp">
                                                                                    </div>

                                                                                </div>
                                                                                <div class="col-lg-6">
                                                                                    <div class="form-group">
                                                                                        <label for="po_num">Revision Date </label><span class="text-danger">*</span>
                                                                                        <input type="date" readonly value="<?php echo date('Y-m-d'); ?>" name="urevision_date" required class="form-control" id="exampleInputEmail1" placeholder="Enter Part Price">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="po_num">Revision Number </label><span class="text-danger">*</span>
                                                                                        <input type="text" value="<?php echo $poo->revision_no + 1 ?>" name="urevision_no" required class="form-control" id="exampleInputEmail1" placeholder="Enter Safty/buffer stock" aria-describedby="emailHelp">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="po_num">Revision Remark </label><span class="text-danger">*</span>
                                                                                        <input type="text" value="" name="revision_remark" required class="form-control" id="exampleInputEmail1" placeholder="Enter revision_remark" aria-describedby="emailHelp">
                                                                                    </div>
                                                                                    <!-- <div class="form-group">
                                                                                        <label> Supplier List </label><span class="text-danger">*</span>
                                                                                        <select class="form-control select2" readonly name="usupplier_id" style="width: 100%;">
                                                                                            <?php
                                                                                            foreach ($supplier_list as $c) {

                                                                                            ?>
                                                                                                <option <?php
                                                                                                        if ($c->id == $poo->supplier_id) {
                                                                                                            echo " selected ";
                                                                                                        } else {
                                                                                                            echo " ";
                                                                                                        } ?> value="<?php echo $c->id; ?>"><?php echo $c->supplier_name; ?></option>
                                                                                            <?php
                                                                                            }
                                                                                            ?>
                                                                                        </select>
                                                                                    </div> -->
                                                                                    <div class="form-group">
                                                                                        <label> UOM </label><span class="text-danger">*</span>
                                                                                        <select class="form-control select2" readonly name="uuom_id" style="width: 100%;">
                                                                                            <?php
                                                                                            foreach ($uom as $c1) {
                                                                                            ?>
                                                                                                <option <?php
                                                                                                        if ($c1->id == $poo->uom_id) {
                                                                                                            echo " selected ";
                                                                                                        } else {
                                                                                                            echo " ";
                                                                                                        } ?> value="<?php echo $c1->id; ?>"><?php echo $c1->uom_name; ?></option>
                                                                                            <?php
                                                                                            }
                                                                                            ?>
                                                                                        </select>
                                                                                    </div>

                                                                                    <div class="form-group">
                                                                                        <label for="po_num">Modal </label>
                                                                                        <input type="file" name="modal" class="form-control" id="hsn_code" placeholder="Enter HSN Code" aria-describedby="emailHelp">
                                                                                    </div>



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



                            </td>
                            <td><?php echo $poo->revision_no ?></td>
                            <td><?php echo $poo->revision_remark ?></td>
                            <td><?php echo $poo->revision_date ?></td>
                            <td><?php echo $poo->part_number ?></td>
                            <td><?php echo $poo->part_description ?></td>
                            <!-- <td><?php echo $supplier_data[0]->supplier_name ?></td> -->
                            <!-- <td><?php echo $poo->part_rate ?></td> -->
                            <td><?php echo $poo->hsn_code ?></td>

                            <td><?php echo $uom_data[0]->uom_name ?></td>

                            <td><?php echo $poo->safty_buffer_stk ?></td>

                            <td><?php echo $child_part_id[0]->part_type_name ?></td>
                            <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal13<?php echo $i; ?>">
                                    <i class="fas fa-upload"></i>

                                </button>
                                <?php

                                                if ($poo->part_drawing == "") {
                                                } else {
                                ?>
                                    <a class="btn btn-primary" download href="<?php echo base_url('documents/') . $poo->part_drawing ?>">
                                        <i class="fas fa-download"></i>

                                    </a>

                                <?php
                                                }
                                ?>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal13<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Upload file</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="<?php echo base_url('add_part') ?>" method="post" enctype='multipart/form-data'>

                                                    <div class="text-center">


                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Upload File<span class="text-danger">*</span>
                                                                <input required type="file" name="cad_file" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Asset Number">

                                                        </div>
                                                        <input value="<?php echo $poo->id ?>" type="hidden" name="uid" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Customer Name">
                                                        <input type="hidden" name="table_name" value="child_part">
                                                        <input type="hidden" name="column_name" value="diagram">


                                                    </div>




                                                    <div class="modal-footer ">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary ">save changes</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal14<?php echo $i; ?>">
                                    <i class="fas fa-upload"></i>

                                </button>
                                <?php

                                                if ($poo->cad_file == "") {
                                                } else {
                                ?>
                                    <a class="btn btn-primary" download href="<?php echo base_url('documents/') . $poo->cad_file ?>">
                                        <i class="fas fa-download"></i>

                                    </a>

                                <?php
                                                }
                                ?>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal14<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Quote</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="<?php echo base_url('add_part') ?>" method="post" enctype='multipart/form-data'>

                                                    <div class="text-center">


                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Upload File<span class="text-danger">*</span>
                                                                <input required type="file" name="cad_file" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Asset Number">

                                                        </div>
                                                        <input value="<?php echo $poo->id ?>" type="hidden" name="uid" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Customer Name">
                                                        <input type="hidden" name="table_name" value="child_part">
                                                        <input type="hidden" name="column_name" value="quote">


                                                    </div>




                                                    <div class="modal-footer ">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary ">save changes</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal14<?php echo $i; ?>">
                                    <i class="fas fa-upload"></i>

                                </button>
                                <?php

                                                if ($poo->modal_document == "") {
                                                } else {
                                ?>
                                    <a class="btn btn-primary" download href="<?php echo base_url('documents/') . $poo->modal_document ?>">
                                        <i class="fas fa-download"></i>

                                    </a>

                                <?php
                                                }
                                ?>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal14<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Modal</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="<?php echo base_url('add_part') ?>" method="post" enctype='multipart/form-data'>

                                                    <div class="text-center">


                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Upload File<span class="text-danger">*</span>
                                                                <input required type="file" name="cad_file" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Asset Number">

                                                        </div>
                                                        <input value="<?php echo $poo->id ?>" type="hidden" name="uid" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Customer Name">
                                                        <input type="hidden" name="table_name" value="child_part">
                                                        <input type="hidden" name="column_name" value="quote">


                                                    </div>




                                                    <div class="modal-footer ">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary ">save changes</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
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
<!-- /.content-wrapper -->