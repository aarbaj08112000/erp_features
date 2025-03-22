<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

<div style="width:2700px;" class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">item part Documents </h1>

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
                                <form action="<?php echo base_url('add_part_creation') ?>" method="POST" enctype="multipart/form-data">

                                    <div class="modal-body">
                                        <div class="row">





                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="on click url">Select Part <span class="text-danger">*</span></label> <br>
                                                    <select required name="part_id" class="form-control select2" id="">
                                                        <?php
                                                        if ($child_part_list) {


                                                            foreach ($child_part_list as $gg) {
                                                                $array = array(
                                                                    "part_number" => $gg->part_number,

                                                                );

                                                                $g = $this->Crud->get_data_by_id_multiple_condition("child_part", $array);
                                                        ?>
                                                                <option value="<?php echo $g[0]->id ?>"><?php echo $g[0]->part_number . " " . $g[0]->part_description; ?></option>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                        <option value="" c></option>
                                                    </select>


                                                </div>

                                            </div>





                                            <!-- <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="on click url">Upload Part Drawing<span class="text-danger">*</span></label> <br>
                                                    <input required type="file" name="part_drawing" placeholder="Enter Sub Group Name" class="form-control" value="" id="">


                                                </div>


                                            </div> -->

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="on click url">PPAP Document</label> <br>
                                                    <input type="file" name="ppap_document" placeholder="Enter Sub Group Name" class="form-control" value="" id="">


                                                </div>


                                            </div>
                                            <!-- <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="on click url">3D Model </label> <br>
                                                    <input type="file" name="modal_document" placeholder="Enter Sub Group Name" class="form-control" value="" id="">


                                                </div>


                                            </div> -->
                                            <!-- <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="on click url">Cad File</label> <br>
                                                    <input type="file" name="cad_file" placeholder="cad_file" class="form-control" value="" id="">


                                                </div>


                                            </div> -->
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="on click url">Quality Documents</label> <br>
                                                    <input type="file" name="q_d" placeholder="cad_file" class="form-control" value="" id="">


                                                </div>


                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="on click url">APQP Documents</label> <br>
                                                    <input type="file" name="a_d" placeholder="cad_file" class="form-control" value="" id="">


                                                </div>


                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="on click url">Other Documents</label> <br>
                                                    <input type="file" name="c_d" placeholder="cad_file" class="form-control" value="" id="">


                                                </div>


                                            </div>


                                            <!-- <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="on click url">Revision Number<span class="text-danger">*</span></label> <br>
                                                    <input required type="text" name="revision_number" placeholder="Enter Revision Number" class="form-control" value="" id="">


                                                </div>

                                            </div>


                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="on click url">Revision Remark<span class="text-danger">*</span></label> <br>
                                                    <input required type="text" name="revision_remark" placeholder="Enter Revision Remark" class="form-control" value="" id="">


                                                </div>

                                            </div>


                                            <div class="col-lg-6">

                                                <div class="form-group">
                                                    <label for="on click url">Revision Date<span class="text-danger">*</span></label> <br>
                                                    <input required type="date" name="revision_date" placeholder="Enter Revision Remark" class="form-control" value="" id="">


                                                </div>

                                            </div> -->
                                            <div class="col-lg-6">

                                                <div class="form-group">
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
                                                </div>



                                            </div>




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

                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addPromo">
                            Add Part
                        </button>

                        <!-- <a type="button" href="<?php echo base_url('export_all_parts') ?>" class="btn btn-success ">
                            Export Data
                        </a> -->
                    </div>


                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Actions</th>

                                    <th>Sr No</th>
                                    <th>Part Number</th>
                                    <th>Description </th>
                                    <th>Supplier </th>
                                    <!-- <th>Part Drawing</th>
                                    <th>Cad File</th>

                                    <th>3D Model</th> -->
                                    <th>PPAP Document</th>
                                    <th>Quality Document</th>
                                    <th>APQP Document</th>
                                    <th>Commercial Document</th>
                                    <!-- <th>Actions</th> -->

                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Actions</th>

                                    <th>Sr No</th>
                                    <th>Part Number</th>

                                    <th>Description </th>
                                    <th>Supplier </th>

                                    <!-- <th>Part Drawing</th>
                                    <th>Cad File</th>

                                    <th>3D Model</th> -->
                                    <th>PPAP Document</th>
                                    <th>Quality Document</th>
                                    <th>APQP Document</th>
                                    <th>Commercial Document</th>
                                    <!-- <th>Actions</th> -->
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php
                                $user_id =  $this->session->userdata('user_id');
                                $user_info = $this->Common_admin_model->get_data_by_id("userinfo", $user_id, "id");


                                $i = 1;
                                if ($part_creation_revision) {
                                    $drawing_download =  "yes";
                                    $drawing_upload =  "yes";
                                    foreach ($part_creation_revision as $p) {

                                        $u = $this->Common_admin_model->get_data_by_id("part_creation", $p->part_number, "part_number");
                                        $supplier_data = $this->Crud->get_data_by_id("supplier", $u[0]->supplier_id, "id");

                                        // $groups = $this->Common_admin_model->get_data_by_id("groups", $u[0]->group_id, "id");
                                        // $sub_group = $this->Common_admin_model->get_data_by_id("sub_group", $u[0]->sub_group_id, "id");
                                        // $operations = $this->Common_admin_model->get_data_by_id("operations", $u[0]->group_id, "id");
                                        // $parts_type = $this->Common_admin_model->get_data_by_id("parts_type", $u[0]->type_id, "id");
                                        // $size_data = $this->Common_admin_model->get_data_by_id("size", $u[0]->size_id, "id");
                                        //   $size = $this->Common_admin_model->get_data_by_id("size",$u[0]->group_id,"id");
                                ?>


                                        <tr>
                                            <td>

                                                <!-- Button trigger modal -->
                                                <?php
                                                if ($drawing_upload == "yes") {
                                                ?>
                                                    <!-- <button title="Revision" type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit<?php echo $i; ?>">
                                                        <i class='far fa-edit'></i>

                                                    </button> -->
                                                <?php } ?>


                                                <!-- <a title="History" href="<?php echo base_url('view_history_part/') . $p->part_number ?>" class="btn btn-primary"><i class="fa fa-history" aria-hidden="true"></i></a> -->

                                                <a title="Operation" href="<?php echo base_url('part_operations/') . $u[0]->type_id . '/' . $u[0]->id ?>" class="btn btn-primary"><i class="fas fa-tasks"></i></a>

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
                                                                <form action="<?php echo base_url('add_part_creation2') ?>" method="POST" enctype="multipart/form-data">
                                                                    <div class="form-group">
                                                                        <label for="on click url">Upload Part Drawing<span class="text-danger">*</span></label> <br>
                                                                        <input required type="file" name="part_drawing" class="form-control" value="" id="">
                                                                        <input required type="hidden" value="<?php echo $u[0]->id ?>" name="part_id" placeholder="Enter Sub Group Name" class="form-control" id="">
                                                                        <input required type="hidden" value="<?php echo $u[0]->part_number ?>" name="part_number" placeholder="Enter Sub Group Name" class="form-control" value="" id="">
                                                                        <input required type="hidden" value="<?php echo $u[0]->part_description ?>" name="part_description" placeholder="Enter Sub Group Name" class="form-control" value="" id="">
                                                                        <input required type="hidden" value="<?php echo $u[0]->internal_part_number ?>" name="internal_part_number" placeholder="Enter Sub Group Name" class="form-control" value="" id="">
                                                                        <!-- <input required type="hidden" value="<?php echo $u[0]->revision_number  ?>" name="revision_number" placeholder="Enter Sub Group Name" class="form-control" value="" id=""> -->
                                                                        <input required type="hidden" value="<?php echo $u[0]->group_id ?>" name="group_id" placeholder="Enter Sub Group Name" class="form-control" value="" id="">
                                                                        <input required type="hidden" value="<?php echo $u[0]->sub_group_id ?>" name="sub_group_id" placeholder="Enter Sub Group Name" class="form-control" value="" id="">
                                                                        <input required type="hidden" value="<?php echo $u[0]->type_id ?>" name="type_id" placeholder="Enter Sub Group Name" class="form-control" value="" id="">
                                                                        <input required type="hidden" value="<?php echo $u[0]->size_id ?>" name="size_id" placeholder="Enter Sub Group Name" class="form-control" value="" id="">


                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="on click url">Revision Number<span class="text-danger">*</span></label> <br>
                                                                        <input required type="text" name="revision_number" placeholder="Enter Revision Number" class="form-control" value="" id="">

                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="on click url">Revision Date<span class="text-danger">*</span></label> <br>
                                                                        <input required type="date" name="revision_date" class="form-control" value="" id="">

                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="on click url">Revision Remark<span class="text-danger">*</span></label> <br>
                                                                        <input required placeholder="<?php echo $u[0]->revision_remark ?>" type="text" name="revision_remark" class="form-control" value="" id="">

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
                                            <td><?php echo $u[0]->part_number; ?></td>
                                            <td><?php echo $u[0]->part_description; ?></td>
                                            <td><?php echo $supplier_data[0]->supplier_name ?></td>

                                            <!-- <td><?php echo $groups[0]->name; ?></td> -->
                                            <!-- <td><?php echo $size_data[0]->name; ?></td>

                                            <td><?php echo $sub_group[0]->sub_group_name; ?></td>

                                            <td><?php echo $parts_type[0]->name; ?></td> -->
                                            <!-- <td>
                                                <?php if ($drawing_download == "yes") { ?>
                                                <?php } ?>
                                                <?php if (!empty($u[0]->ppap_document)) { ?>
                                                    <a title="Revision" class="btn btn-primary" href="<?php echo base_url('documents/') . $u[0]->ppap_document ?>"><i class="fas fa-download" aria-hidden="true"></i> </a>

                                                <?php }
                                                ?>
                                            </td> -->

                                            <td class="">
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ppap_document<?php echo $i; ?>">
                                                    <i class="fas fa-upload" aria-hidden="true"></i>
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="ppap_document<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">

                                                                <h5 class="modal-title" id="exampleModalLabel">Update PPAP Document</h5>
                                                                <form action="<?php echo base_url('update_part_drawings') ?>" method="POST" enctype="multipart/form-data">

                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="">Update</label>
                                                                    <input required type="file" name="document" class="form-control" id="">
                                                                    <input required type="hidden" value="ppap_document" name="document_name" class="form-control" id="">
                                                                    <input required type="hidden" value="<?php echo $u[0]->id; ?>" name="id" class="form-control" id="">
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
                                                <?php
                                                if ($u[0]->ppap_document) {
                                                ?>
                                                    <a class="btn btn-<?php if ($u[0]->ppap_document != "") {
                                                                            echo "success";
                                                                        } else {
                                                                            echo "danger";
                                                                        } ?>" download href="<?php echo base_url('documents/') . $u[0]->ppap_document ?>"><i class="fa fa-download" aria-hidden="true"></i> </a>
                                                <?php

                                                } ?>
                                            </td>
                                            <td class="">
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleMosssdalpp<?php echo $i; ?>">
                                                    <i class="fas fa-upload" aria-hidden="true"></i>
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleMosssdalpp<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">

                                                                <h5 class="modal-title" id="exampleModalLabel">Update Quality Document</h5>
                                                                <form action="<?php echo base_url('update_part_drawings') ?>" method="POST" enctype="multipart/form-data">

                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="">Update</label>
                                                                    <input required type="file" name="document" class="form-control" id="">
                                                                    <input required type="hidden" value="q_d" name="document_name" class="form-control" id="">
                                                                    <input required type="hidden" value="<?php echo $u[0]->id; ?>" name="id" class="form-control" id="">
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
                                                <?php
                                                if ($u[0]->q_d) {
                                                ?>
                                                    <a class="btn btn-<?php if ($u[0]->q_d != "") {
                                                                            echo "success";
                                                                        } else {
                                                                            echo "danger";
                                                                        } ?>" download href="<?php echo base_url('documents/') . $u[0]->q_d ?>"><i class="fa fa-download" aria-hidden="true"></i> </a>
                                                <?php

                                                } ?>
                                            </td>
                                            <td class="">
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ssssaddd<?php echo $i; ?>">
                                                    <i class="fas fa-upload" aria-hidden="true"></i>
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="ssssaddd<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">

                                                                <h5 class="modal-title" id="exampleModalLabel">Update APQP Document</h5>
                                                                <form action="<?php echo base_url('update_part_drawings') ?>" method="POST" enctype="multipart/form-data">

                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="">Update</label>
                                                                    <input required type="file" name="document" class="form-control" id="">
                                                                    <input required type="hidden" value="a_d" name="document_name" class="form-control" id="">
                                                                    <input required type="hidden" value="<?php echo $u[0]->id; ?>" name="id" class="form-control" id="">
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
                                                <?php
                                                if ($u[0]->a_d) {
                                                ?>
                                                    <a class="btn btn-<?php if ($u[0]->a_d != "") {
                                                                            echo "success";
                                                                        } else {
                                                                            echo "danger";
                                                                        } ?>" download href="<?php echo base_url('documents/') . $u[0]->a_d ?>"><i class="fa fa-download" aria-hidden="true"></i> </a>
                                                <?php

                                                } ?>
                                            </td>
                                            <td class="">
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#asnuj<?php echo $i; ?>">
                                                    <i class="fas fa-upload" aria-hidden="true"></i>
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="asnuj<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">

                                                                <h5 class="modal-title" id="exampleModalLabel">Update Commercial Document</h5>
                                                                <form action="<?php echo base_url('update_part_drawings') ?>" method="POST" enctype="multipart/form-data">

                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="">Update</label>
                                                                    <input required type="file" name="document" class="form-control" id="">
                                                                    <input required type="hidden" value="c_d" name="document_name" class="form-control" id="">
                                                                    <input required type="hidden" value="<?php echo $u[0]->id; ?>" name="id" class="form-control" id="">
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
                                                <?php
                                                if ($u[0]->c_d) {
                                                ?>
                                                    <a class="btn btn-<?php if ($u[0]->c_d != "") {
                                                                            echo "success";
                                                                        } else {
                                                                            echo "danger";
                                                                        } ?>" download href="<?php echo base_url('documents/') . $u[0]->c_d ?>"><i class="fa fa-download" aria-hidden="true"></i> </a>
                                                <?php

                                                } ?>
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
<script>
    $(document).ready(function() {


        // $("#type_id").change(function()
        // {
        //   var type2 =  parseFloat($('#type_id').find(":selected").val());

        //   if(type2 != 1)
        //   {
        //     $('#size_id').prop('disabled', true);

        //   }
        //   else
        //   {
        //     $('#size_id').prop('disabled', false);

        //   }
        // }); 
    });
</script>