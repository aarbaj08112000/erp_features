<div style="width:2500px" width="3500px" class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Part History </h1>

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
                                    <form action="<?php echo base_url('add_part_creation') ?>" method="POST" enctype="multipart/form-data">


                                        <div class="form-group">
                                            <label for="on click url">Select Group <span class="text-danger">*</span></label> <br>
                                            <select required name="group_id" class="form-control select2" id="">
                                                <?php
                                                foreach ($groups as $g) {
                                                ?>
                                                    <option value="<?php echo $g->id ?>"><?php echo $g->name; ?></option>
                                                <?php
                                                }
                                                ?>
                                                <option value="" c></option>
                                            </select>


                                        </div>
                                        <div class="form-group">
                                            <label for="on click url">Part Number <span class="text-danger">*</span></label> <br>
                                            <input required type="text" name="part_number" placeholder="Enter part_number" class="form-control" value="" id="">


                                        </div>
                                        <div class="form-group">
                                            <label for="on click url">Part Ddescription <span class="text-danger">*</span></label> <br>
                                            <input required type="text" name="part_description" placeholder="Enter Part Description" class="form-control" value="" id="">


                                        </div>

                                        <div class="form-group">
                                            <label for="on click url">Internal Part Ddescription <span class="text-danger">*</span></label> <br>
                                            <input type="text" name="internal_part_number" placeholder="Enter Internal part number" class="form-control" value="" id="">


                                        </div>

                                        <!-- <div class="form-group">
                  <label for="on click url">Group Image <span class="text-danger">*</span></label> <br>
                  <input required type="file" accept="image/*" name="img" placeholder="Enter Segment Name" class="form-control"  value=""   id="">
                 
                
       </div> -->

                                        <div class="form-group">
                                            <label for="on click url">Select Sub Group <span class="text-danger">*</span></label> <br>
                                            <select required name="sub_group_id" class="form-control select2" id="">
                                                <?php
                                                foreach ($sub_group as $g) {
                                                ?>
                                                    <option value="<?php echo $g->id ?>"><?php echo $g->sub_group_name; ?></option>
                                                <?php
                                                }
                                                ?>
                                                <option value="" c></option>
                                            </select>


                                        </div>
                                        <div class="form-group">
                                            <label for="on click url">Select Type <span class="text-danger">*</span></label> <br>
                                            <select required name="type_id" class="form-control select2" id="">
                                                <?php
                                                foreach ($parts_type as $g) {
                                                ?>
                                                    <option value="<?php echo $g->id ?>"><?php echo $g->name; ?></option>
                                                <?php
                                                }
                                                ?>
                                                <option value="" c></option>
                                            </select>


                                        </div>

                                        <div class="form-group">
                                            <label for="on click url">Upload Part Drawing<span class="text-danger">*</span></label> <br>
                                            <input required type="file" name="part_drawing" placeholder="Enter Sub Group Name" class="form-control" value="" id="">
                                            <input required type="hidden" value="0" name="revision_number" placeholder="Enter Sub Group Name" class="form-control" value="" id="">
                                            <input required type="hidden" value="first created" name="revision_remark" placeholder="Enter Sub Group Name" class="form-control" value="" id="">


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
                            History
                            <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addPromo">
  Add Part
</button> -->
                        </div>


                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>

                                        <th>Sr No</th>
                                        <th>Part Number</th>
                                        <th>Description </th>
                                        <th>Internal Part Number </th>
                                        <th>Revision Number</th>
                                        <th>Revision Date</th>
                                        <th>Revision Remark</th>

                                        <th>Part Drawing</th>
                                        <th>3D Model</th>
                                        <th>PPAP Document</th>
                                        <th>Cad File</th>
                                        <th>Quality Document</th>
                                        <th>APQP Document</th>
                                        <th>Commercial Document</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>

                                        <th>Sr No</th>
                                        <th>Part Number</th>
                                        <th>Description </th>
                                        <th>Internal Part Number </th>
                                        <th>Revision Number</th>
                                        <th>Revision Date</th>
                                        <th>Revision Remark</th>

                                        <th>Part Drawing</th>
                                        <th>3D Model</th>
                                        <th>PPAP Document</th>

                                        <th>Cad File</th>
                                        <th>Quality Document</th>
                                        <th>APQP Document</th>
                                        <th>Commercial Document</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php

                                    $i = 1;
                                    foreach ($part_creation as $u) {

                                        //   $u = $this->Common_admin_model->get_data_by_id("part_creation",$p->part_number,"part_number");

                                        // $groups = $this->Common_admin_model->get_data_by_id("groups", $u->group_id, "id");
                                        // $sub_group = $this->Common_admin_model->get_data_by_id("sub_group", $u->sub_group_id, "id");
                                        // $operations = $this->Common_admin_model->get_data_by_id("operations", $u->group_id, "id");
                                        // $parts_type = $this->Common_admin_model->get_data_by_id("parts_type", $u->type_id, "id");
                                        //   $size = $this->Common_admin_model->get_data_by_id("size",$u[0]->group_id,"id");
                                    ?>


                                        <tr>


                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $u->part_number; ?></td>
                                            <td><?php echo $u->part_description; ?></td>
                                            <td><?php echo $u->internal_part_number; ?></td>
                                            <td><?php echo $u->revision_number; ?></td>
                                            <td><?php echo $u->revision_date; ?></td>
                                            <td><?php echo $u->revision_remark; ?></td>
                                            <!-- <td><?php echo $groups[0]->name; ?></td>
                                            <td><?php echo $sub_group[0]->sub_group_name; ?></td>
                                            <td><?php echo $parts_type[0]->name; ?></td> -->
                                            <td>
                                                <?php
                                                if ($drawing_download == "yes") {
                                                ?>
                                                    <a class="btn btn-primary" href="<?php echo base_url('documents/') . $u->part_drawing ?>">Download </a>
                                                <?php } ?>
                                            </td>


                                            <td>
                                                <?php
                                                if ($u->modal_document) {
                                                    if ($drawing_download == "yes") {
                                                        // echo $u->modal_document;
                                                ?>
                                                        <a class="btn btn-primary" download href="<?php echo base_url('documents/') . $u->modal_document ?>">Download </a>
                                                <?php
                                                    }
                                                } ?>
                                            </td>


                                            <td>
                                                <?php
                                                if ($u->ppap_document) {
                                                    if ($drawing_download == "yes") {
                                                        // echo $u->ppap_document;

                                                ?>
                                                        <a class="btn btn-primary" download href="<?php echo base_url('documents/') . $u->ppap_document ?>">Download </a>
                                                <?php
                                                    }
                                                } ?>
                                            </td>


                                            <td>
                                                <?php
                                                if ($u->cad_file) {
                                                    if ($drawing_download == "yes") {
                                                        // echo $u->cad_file;

                                                ?>
                                                        <a class="btn btn-primary" download href="<?php echo base_url('documents/') . $u->cad_file ?>">Download </a>
                                                <?php
                                                    }
                                                } ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($u->q_d) {
                                                    if ($drawing_download == "yes") {
                                                        // echo $u->cad_file;

                                                ?>
                                                        <a class="btn btn-primary" download href="<?php echo base_url('documents/') . $u->q_d ?>">Download </a>
                                                <?php
                                                    }
                                                } ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($u->a_d) {
                                                    if ($drawing_download == "yes") {
                                                        // echo $u->cad_file;

                                                ?>
                                                        <a class="btn btn-primary" download href="<?php echo base_url('documents/') . $u->a_d ?>">Download </a>
                                                <?php
                                                    }
                                                } ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($u->c_d) {
                                                    if ($drawing_download == "yes") {
                                                        // echo $u->cad_file;

                                                ?>
                                                        <a class="btn btn-primary" download href="<?php echo base_url('documents/') . $u->c_d ?>">Download </a>
                                                <?php
                                                    }
                                                } ?>
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