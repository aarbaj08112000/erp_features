<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Part Operation Single </h1>

                </div><!-- /.col -->

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">

        <div>
            <!-- Small boxes (Stat box) -->
            <div class="row">


                <br>
                <div class="col-lg-12">
                    <?php
                    $user_id =  $this->session->userdata('user_id');
                    $user_info = $this->Common_admin_model->get_data_by_id("userinfo", $user_id, "id");

                    $drawing_download =  $user_info[0]->drawing_download;
                    $drawing_upload =  $user_info[0]->drawing_upload;

                    if ($drawing_download == "yes") {
                    }

                    ?>
                    <!-- Modal -->
                    <div class="modal fade" id="addPromo" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="<?php echo base_url('add_part_operations') ?>" method="POST" enctype="multipart/form-data">


                                        <div class="form-group">
                                            <label for="on click url">Select Part <span class="text-danger">*</span></label>
                                            <input type="text" readonly name="part_number" value="<?php echo $part_info[0]->part_number ?>" class="form-control">
                                            <input type="hidden" readonly name="part_id" value="<?php echo $part_info[0]->id ?>" class="form-control">
                                            <!-- <select readonly required name="part_id" class="form-control select2" id="">
                                  <option selected value="<?php echo $part_info[0]->id ?>"><?php echo $part_info[0]->part_number ?></option>
                                </select>
                                -->

                                        </div>
                                        <div class="form-group">
                                            <label for="on click url">Select Operation Number <span class="text-danger">*</span></label> <br>
                                            <select required name="operation_id" class="form-control select2" id="">
                                                <?php
                                                foreach ($operations as $g) {
                                                ?>
                                                    <option value="<?php echo $g->id ?>"><?php echo $g->name; ?></option>
                                                <?php
                                                }
                                                ?>
                                                <option value="" c></option>
                                            </select>


                                        </div>
                                        <div class="form-group">
                                            <label for="on click url">Operation Description <span class="text-danger">*</span></label> <br>
                                            <input required type="text" name="operation_description" placeholder="Enter operation_description" class="form-control" value="" id="">


                                        </div>
                                        <div class="form-group">
                                            <label for="on click url">Revision Number <span class="text-danger">*</span></label> <br>
                                            <input required type="text" readonly name="revision_number" placeholder="Enter Revision Number" class="form-control" value="0" id="">


                                        </div>
                                        <div class="form-group">
                                            <label for="on click url">Revision Date <span class="text-danger">*</span></label> <br>
                                            <input required type="date" name="revision_date" placeholder="Enter Revision Date" class="form-control" value="" id="">


                                        </div>

                                        <div class="form-group">
                                            <label for="on click url">Revision Remark <span class="text-danger">*</span></label> <br>
                                            <input required type="text" name="revision_remark" placeholder="Enter Revision Remark" class="form-control" value="" id="">


                                        </div>


                                        <div class="form-group">
                                            <label for="on click url">Upload Operation Drawing<span class="text-danger">*</span></label> <br>
                                            <input required type="file" name="drawing" placeholder="Enter Sub Group Name" class="form-control" value="" id="">


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
                            <div class="row">
                                <div class="col-lg-1">
                                    <div class="form-group">
                                        <label for="part_name">Part Number <span class="text-danger">*</span></label>
                                        <input type="text" readonly name="part_number" value="<?php echo $part_info[0]->part_number ?>" class="form-control" id="">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="part_name">Part Description <span class="text-danger">*</span></label>
                                        <input type="text" readonly name="part_description" value="<?php echo $part_info[0]->part_description ?>" class="form-control" id="">
                                    </div>
                                </div>
                                <div class="col-lg-1">
                                    <div class="form-group">
                                        <label for="part_name">Part Type <span class="text-danger">*</span></label>
                                        <input type="text" readonly name="part_type" value="<?php if ($type == 1) {
                                                                                                echo "Single";
                                                                                            } else {
                                                                                                echo "Assebmly";
                                                                                            } ?>" class="form-control" id="">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="part_name">Part Drawing <span class="text-danger">*</span></label>
                                        <br>
                                        <?php if ($part_info[0]->part_drawing) {

                                            if ($drawing_download == "yes") {


                                        ?>

                                                <a class="btn btn-primary" href="<?php echo base_url('documents/') . $part_info[0]->part_drawing ?>"><i class="fa fa-download" aria-hidden="true"></i></a>
                                        <?php }
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="part_name">Cad File <span class="text-danger">*</span></label>
                                        <br>
                                        <?php if ($part_info[0]->cad_file) {
                                            if ($drawing_download == "yes") {

                                        ?>
                                                <a download class="btn btn-primary" href="<?php echo base_url('documents/') . $part_info[0]->cad_file ?>"><i class="fa fa-download" aria-hidden="true"></i></a>
                                        <?php }
                                        } else {
                                            echo "Not Uploaded";
                                        } ?>
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="part_name">3D Model <span class="text-danger">*</span></label>
                                        <br>
                                        <?php if ($part_info[0]->modal_document) {
                                            if ($drawing_download == "yes") {

                                        ?>
                                                <a download class="btn btn-primary" href="<?php echo base_url('documents/') . $part_info[0]->modal_document ?>"><i class="fa fa-download" aria-hidden="true"></i></a>
                                        <?php }
                                        } else {
                                            echo "Not Uploaded";
                                        } ?>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="part_name">PPAP Document <span class="text-danger">*</span></label>
                                        <br>
                                        <?php if ($part_info[0]->ppap_document) {
                                            if ($drawing_download == "yes") {

                                        ?>
                                                <a download class="btn btn-primary" href="<?php echo base_url('documents/') . $part_info[0]->ppap_document ?>"><i class="fa fa-download" aria-hidden="true"></i></a>
                                        <?php }
                                        } else {
                                            echo "Not Uploaded";
                                        } ?>
                                    </div>
                                </div>

                            </div>
                            <?php
                            $user_id =  $this->session->userdata('user_id');

                            $user_info = $this->Common_admin_model->get_data_by_id("userinfo", $user_id, "id");

                            $drawing_download =  $user_info[0]->drawing_download;
                            $drawing_upload =  $user_info[0]->drawing_upload;
                            if ($drawing_upload == "yes") { ?>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addPromo">
                                    Add <?php if ($type == 1) {
                                            echo "Single";
                                        } else {
                                            echo "Assebmly";
                                        } ?> Operation
                                </button>
                            <?php } ?>


                        </div>


                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Actions</th>
                                        <th>Sr No</th>
                                        <th>Operation Number </th>
                                        <th>Operation Description </th>
                                        <th>Revision Number</th>
                                        <th>Revision Date</th>
                                        <th>Revision Remark</th>
                                        <th> Operation Drawing</th>

                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Actions</th>

                                        <th>Sr No</th>
                                        <th>Operation Number </th>
                                        <th>Operation Description </th>
                                        <th>Revision Number</th>
                                        <th>Revision Date</th>
                                        <th>Revision Remark</th>
                                        <th> Operation Drawing</th>

                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php

                                    $i = 1;
                                    $s = 0;
                                    foreach ($part_operations_revision as $p) {

                                        // $u = $this->Common_admin_model->get_data_by_id("part_operations", $p->part_id, "part_id");
                                        $operations_data = $this->Common_admin_model->get_data_by_id("operations", $p->operation_id, "id");

                                        $data_old = array(
                                            'part_id' => $p->part_id,
                                            'operation_id' => $p->operation_id,

                                        );

                                        $u  = $this->Common_admin_model->get_data_by_id_multiple_condition("part_operations", $data_old);
                                        // $data_old = array(
                                        //   'operation_id' => $p->operation_id,
                                        //   'part_id' => $part_id,

                                        // );
                                        // // $uo = $this->Common_admin_model->get_data_by_id_multiple_condition("part_operations",$data_old);
                                        // $uo = $this->Common_admin_model->get_data_by_id("part_operations", $p->operation_id, "id");

                                        // $groups = $this->Common_admin_model->get_data_by_id("groups", $uo[0]->group_id, "id");
                                        // $sub_group = $this->Common_admin_model->get_data_by_id("sub_group", $uo[0]->sub_group_id, "id");
                                        // $operations = $this->Common_admin_model->get_data_by_id("operations", $uo[0]->group_id, "id");
                                        // $parts_type = $this->Common_admin_model->get_data_by_id("parts_type", $uo[0]->type_id, "id");
                                        // $part_creation = $this->Common_admin_model->get_data_by_id("part_creation", $p->part_id, "id");
                                        // $operations = $this->Common_admin_model->get_data_by_id("operations", $p->operation_id, "id");
                                    ?>


                                        <tr>
                                            <td>

                                                <!-- Button trigger modal -->

                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit<?php echo $i; ?>">
                                                    <i class='far fa-edit'></i>

                                                </button>

                                                <a href="<?php echo base_url('view_history_operation_parts/') . $p->part_id . '/' . $p->operation_id ?>" class="btn btn-primary">History</a>



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
                                                                <form action="<?php echo base_url('add_part_operations') ?>" method="POST" enctype="multipart/form-data">
                                                                    <div class="form-group">
                                                                        <label for="on click url">Upload Operation Process Drawing<span class="text-danger">*</span></label> <br>
                                                                        <input required type="file" name="drawing" class="form-control" value="" id="">
                                                                        <input required type="hidden" value="<?php echo $u[0]->part_id ?>" name="part_id" placeholder="Enter Sub Group Name" class="form-control" value="" id="">
                                                                        <input required type="hidden" value="<?php echo $u[0]->operation_id ?>" name="operation_id" placeholder="Enter Sub Group Name" class="form-control" value="" id="">
                                                                        <input required type="hidden" value="<?php echo $u[0]->operation_description ?>" name="operation_description" placeholder="Enter Sub Group Name" class="form-control" value="" id="">


                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="on click url">Revision Number<span class="text-danger">*</span></label> <br>
                                                                        <input required type="text" readonly name="revision_number" placeholder="Enter Sub Group Name" class="form-control" value="<?php echo $u[0]->revision_number + 1 ?>" id="">



                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="on click url">Revision Remark<span class="text-danger">*</span></label> <br>
                                                                        <input required placeholder="<?php echo $u[0]->revision_remark ?>" type="text" name="revision_remark" class="form-control" value="" id="">



                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="on click url">Revision Date<span class="text-danger">*</span></label> <br>
                                                                        <input required type="date" name="revision_date" class="form-control" value="" id="">



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


                                            </td>

                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $operations_data[0]->name; ?></td>
                                            <td><?php echo $u[0]->operation_description; ?></td>
                                            <td><?php echo $u[0]->revision_number; ?></td>
                                            <td><?php echo $u[0]->revision_date; ?></td>
                                            <td><?php echo $u[0]->revision_remark; ?></td>
                                            <td>
                                                <a class="btn btn-primary" download href="<?php echo base_url('documents/') . $u[0]->drawing ?>">Download </a>
                                            </td>


                                        </tr>

                                    <?php
                                        $i++;
                                        $s++;
                                    }

                                    ?>
                                </tbody>

                            </table>
                        </div>


                    </div>
                    <?php if ($type == 2) { ?>
                        <div class="card">
                            <br>
                            <div style="padding: 20px;" class="card-head">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addPromonewxzy">
                                    Add <?php if ($type == 1) {
                                            echo "Single";
                                        } else {
                                            echo "Assembly";
                                        } ?> item parts
                                </button>
                                <a type="button" href="<?php echo base_url('export_assebly_parts/') . $part_info[0]->id ?>" class="btn btn-success float-right">
                                    Export Data
                                </a>
                            </div>
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <!-- <th>Actions</th> -->

                                            <th>Sr No</th>
                                            <th>Part Number </th>
                                            <th>Part Description</th>
                                            <th>Revision Number</th>
                                            <th>Revision Date</th>
                                            <th>Revision Remark</th>
                                            <th>Quantity</th>

                                            <th>item part Drawing</th>
                                            <th>item part Details</th>


                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <!-- <th>Actions</th> -->

                                            <th>Sr No</th>
                                            <th>Part Number </th>
                                            <th>Part Description</th>
                                            <th>Revision Number</th>
                                            <th>Revision Date</th>
                                            <th>Revision Remark</th>
                                            <th>Quantity</th>
                                            <th>item part Drawing</th>
                                            <th>item part Details</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php

                                        $assebmly_parts =  $this->Common_admin_model->get_data_by_id("assembly_parts", $part_info[0]->id, "assembly_part_id");

                                        if ($assebmly_parts) {



                                            $i = 1;
                                            foreach ($assebmly_parts as $p) {

                                                $u = $this->Common_admin_model->get_data_by_id("part_creation", $p->part_id, "id");

                                                // $part_creation = $this->Common_admin_model->get_data_by_id("part_creation",$p->part_id,"id");
                                                // $operations = $this->Common_admin_model->get_data_by_id("operations",$p->operation_id,"id");
                                        ?>


                                                <tr>
                                                    <!-- <td> -->

                                                    <!-- Button trigger modal -->

                                                    <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit<?php echo $i; ?>">
                                        <i class='far fa-edit'></i>

                                        </button>
                                         -->
                                                    <!-- <a href="<?php echo base_url('view_history_operation_parts/') . $p->part_id . '/' . $p->operation_id ?>" class="btn btn-primary">History</a> -->



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
                                                                    <form action="<?php echo base_url('add_part_operations') ?>" method="POST" enctype="multipart/form-data">
                                                                        <div class="form-group">
                                                                            <label for="on click url">Upload Operation Part Drawing<span class="text-danger">*</span></label> <br>
                                                                            <input required type="file" name="drawing" class="form-control" value="" id="">
                                                                            <input required type="hidden" value="<?php echo $u[0]->part_id ?>" name="part_id" placeholder="Enter Sub Group Name" class="form-control" value="" id="">
                                                                            <input required type="hidden" value="<?php echo $u[0]->operation_id ?>" name="operation_id" placeholder="Enter Sub Group Name" class="form-control" value="" id="">
                                                                            <input required type="hidden" value="<?php echo $u[0]->operation_description ?>" name="operation_description" placeholder="Enter Sub Group Name" class="form-control" value="" id="">


                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="on click url">Revision Number<span class="text-danger">*</span></label> <br>
                                                                            <input required type="text" name="revision_number" placeholder="Enter Sub Group Name" class="form-control" value="" id="">



                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="on click url">Revision Remark<span class="text-danger">*</span></label> <br>
                                                                            <input required placeholder="<?php echo $u[0]->revision_remark ?>" type="text" name="revision_remark" class="form-control" value="" id="">



                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="on click url">Revision Date<span class="text-danger">*</span></label> <br>
                                                                            <input required type="date" name="revision_date" class="form-control" value="" id="">



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


                                                    <!-- </td> -->

                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $u[0]->part_number; ?></td>
                                                    <td><?php echo $u[0]->part_description; ?></td>
                                                    <td><?php echo $u[0]->revision_number; ?></td>
                                                    <td><?php echo $u[0]->revision_date; ?></td>

                                                    <td><?php echo $u[0]->revision_remark; ?></td>
                                                    <td><?php echo $p->quantity; ?></td>

                                                    <td>
                                                        <?php


                                                        if ($drawing_download == "yes") {


                                                        ?>
                                                            <a class="btn btn-primary" download href="<?php echo base_url('documents/') . $part_creation[0]->part_drawing ?>"><i class="fa fa-download" aria-hidden="true"></i> </a>
                                                        <?php } ?>
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-primary" href="<?php echo base_url('part_operations/1/') . $part_creation[0]->id ?>">Part Details </a>
                                                    </td>


                                                </tr>

                                            <?php
                                                $i++;
                                            }

                                            ?>
                                    </tbody>

                                </table>
                            </div>
                        </div>


                        <div class="card-body">

                        </div>
                </div>

        <?php
                                        }
                                    } ?>

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
<div class="modal fade" id="addPromonewxzy" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add item part</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url('add_child_part') ?>" method="POST" enctype="multipart/form-data">



                    <div class="form-group">
                        <label for="on click url">Select Part Number <span class="text-danger">*</span></label> <br>
                        <select required name="part_id" class="form-control select2" id="">
                            <?php
                            foreach ($new_part as $p) {
                                $u = $this->Common_admin_model->get_data_by_id("part_creation", $p->part_number, "part_number");
                                if ($u[0]->type_id == 1) {
                                    //   $groups = $this->Common_admin_model->get_data_by_id("groups",$u[0]->group_id,"id");
                                    //   $sub_group = $this->Common_admin_model->get_data_by_id("sub_group",$u[0]->sub_group_id,"id");
                                    //   $operations = $this->Common_admin_model->get_data_by_id("operations",$u[0]->group_id,"id");
                                    //   $parts_type = $this->Common_admin_model->get_data_by_id("parts_type",$u[0]->type_id,"id");
                                    // $part_creation = $this->Common_admin_model->get_data_by_id("part_creation",$p->part_id,"id");
                                    // $operations = $this->Common_admin_model->get_data_by_id("operations",$p->operation_id,"id");

                            ?>
                                    <option value="<?php echo $u[0]->id ?>"><?php echo $u[0]->part_number; ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                        <input type="hidden" name="assembly_part_id" id="" value="<?php echo $part_info[0]->id; ?>">


                    </div>
                    <div class="form-group">
                        <label for="on click url">Add Quantity <span class="text-danger">*</span></label> <br>

                        <input type="number" required class="form-control" placeholder="Add Quantity" name="quantity" id="" value="">


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