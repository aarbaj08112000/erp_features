<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Job Card Production Qty History </h1>

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

                    // $drawing_download =  $user_info[0]->drawing_download;
                    // $drawing_upload =  $user_info[0]->drawing_upload;

                    // if ($drawing_download == "yes") {
                    // }

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
                            <div class="row">
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="">Job Card Number <span class="text-danger">*</span></label>
                                        <input type="text" readonly value="<?php echo "TH/" . $customer_part_data[0]->part_family . "/0000" . $job_card[0]->id; ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="">Customer <span class="text-danger">*</span></label>
                                        <input type="text" readonly value="<?php echo $customer_data[0]->customer_name; ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="">Part No <span class="text-danger">*</span></label>
                                        <input type="text" readonly value="<?php echo $customer_part_data[0]->part_number; ?>" class="form-control">
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="">Part Description <span class="text-danger">*</span></label>
                                        <input type="text" readonly value="<?php echo $customer_part_data[0]->part_number; ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="">Lot Qty <span class="text-danger">*</span></label>
                                        <input type="text" readonly value="<?php echo $job_card[0]->req_qty; ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="">Job Card Status <span class="text-danger">*</span></label>
                                        <input type="text" readonly value="<?php echo $job_card[0]->status; ?>" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>

                                        <th>Sr No</th>
                                        <th>Production QTY</th>
                                        <th>Operation Number</th>
                                        <th>Date </th>
                                        <th>Time</th>


                                    </tr>
                                </thead>

                                <tbody>
                                    <?php

                                    $total = 0;
                                    if ($job_card_prod_qty) {
                                        $i = 1;

                                        foreach ($job_card_prod_qty as $u) {

                                            $total = $total + $u->production_qty;
                                            $operations_data = $this->Crud->get_data_by_id("operations", $u->operation_id, "id");

                                    ?>


                                            <tr>


                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $u->production_qty; ?></td>
                                                <td><?php echo $operations_data[0]->name; ?></td>
                                                <td><?php echo $u->created_date; ?></td>
                                                <td><?php echo $u->created_time; ?></td>

                                            </tr>

                                    <?php
                                            $i++;
                                        }
                                    }

                                    ?>
                                </tbody>


                                <tfoot>
                                    <tr>
                                        <th>Total</th>
                                        <th><?php echo $total; ?></th>
                                        <th></th>
                                        <th></th>
                                    </tr>

                                </tfoot>

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