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
                        <h1>Customer Part Operation</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                            <li class="breadcrumb-item active">Customer Part</li>
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
                                <?php
                                $selected_operation_data = $this->Crud->get_data_by_id("operations", $customer_part_operation[0]->operation_id, "id");
                                $selected_part_data = $this->Crud->get_data_by_id("customer_part", $customer_part_operation[0]->customer_master_id, "id");
                                ?>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <a href="<?php echo base_url('customer_part_operation/') . $this->uri->segment('4') . "/" .  $this->uri->segment('5'); ?>" class="btn btn-danger ">
                                            Back </a>
                                    </div>
                                    <div class="col-lg-6">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Part No./Part Description</th>
                                                    <th scope="col">Operation No./Operation Description</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><?php echo $selected_part_data[0]->part_number . ' / ' . $selected_part_data[0]->part_description; ?></td>
                                                    <td><?php echo $selected_operation_data[0]->name . ' / ' . $customer_part_operation[0]->name; ?> </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <hr>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary float-left" data-toggle="modal" data-target="#exampleModal">
                                    Add </button>
                                <button type="button" class="btn btn-success float-right">
                                    Download </button>
                            </div>
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
                                            <form action="<?php echo base_url('add_customer_operation_data') ?>" method="POST" enctype='multipart/form-data'>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label for="po_num">Product </label><span class="text-danger">*</span>
                                                            <input type="text" name="product" required class="form-control" id="exampleInputEmail1" placeholder="Enter Product" aria-describedby="emailHelp">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="po_num">Process </label><span class="text-danger">*</span>
                                                            <input type="text" name="process" required class="form-control" id="exampleInputEmail1" placeholder="Enter Process" aria-describedby="emailHelp">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="po_num">Product Specification / Tolerance </label><span class="text-danger">*</span>
                                                            <input type="text" name="specification_tolerance" required class="form-control" id="exampleInputEmail1" placeholder="Product Specification / Tolerance " aria-describedby="emailHelp">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="po_num">Evaluation / Measurement Techn</label><span class="text-danger">*</span>
                                                            <input type="text" name="evalution" required class="form-control" id="exampleInputEmail1" placeholder="Evaluation / Measurement Techn " aria-describedby="emailHelp">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="po_num">Size</label><span class="text-danger">*</span>
                                                            <input type="text" name="size" required class="form-control" id="exampleInputEmail1" placeholder="Size " aria-describedby="emailHelp">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="po_num">Freuency</label><span class="text-danger">*</span>
                                                            <input type="text" name="frequency" required class="form-control" id="exampleInputEmail1" placeholder="Freuency " aria-describedby="emailHelp">
                                                            <input type="hidden" name="customer_part_operation_id" value="<?php echo $customer_part_operation[0]->id ?>" required class="form-control" id="exampleInputEmail1" placeholder="Enter " aria-describedby="emailHelp">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">

                                                        <!-- <div class="form-group">
                                                            <label> Customer Part Type </label><span class="text-danger">*</span>
                                                            <select class="form-control select2" name="customer_part_id" style="width: 100%;">
                                                                <?php
                                                                foreach ($customers_part_type as $c1) {
                                                                ?>
                                                                    <option value="<?php echo $c1->id; ?>"><?php echo $c1->customer_type_name; ?></option>
                                                                <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div> -->
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


                            <!-- /.card-header -->

                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sr No</th>
                                            <th>Add</th>

                                            <!-- <th>Operation Name</th> -->
                                            <th>Product</th>
                                            <th>Process</th>
                                            <th>Specification Tolerance</th>
                                            <th>Evalution</th>
                                            <th>Size</th>
                                            <th>Frequency</th>

                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Sr No</th>
                                            <th>Add</th>

                                            <!-- <th>Operation Name</th> -->

                                            <th>Product</th>
                                            <th>Process</th>
                                            <th>Specification Tolerance</th>
                                            <th>Evalution</th>
                                            <th>Size</th>
                                            <th>Frequency</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php

                                        $i = 1;
                                        foreach ($operation_data as $u) {
                                            //$product_into = $this->Ojwebsitemodel->get_product_info_new($u->product_id);
                                            //    $segments = $this->Common_admin_model->delete_user_by_id("segments","id",$u->segment_id);
                                            // $segments = $this->Common_admin_model->get_data_by_id("segments",$u->segment_id,"id");
                                        ?>


                                            <tr>
                                                <td>
                                                    <?php echo $i; ?>
                                                </td>
                                                <td>
                                                    <form action="<?php echo base_url('add_customer_operation_data') ?>" method="POST" enctype='multipart/form-data'>

                                                        <button type="submit" class="btn btn-primary">Add</button>


                                                </td>

                                                <td>
                                                    <!-- <?php echo $u->product ?> -->
                                                    <!-- <?php //echo 
                                                            ?> -->
                                                    <input type="text" name="product" value=" <?php echo $u->product ?>" required class="form-control" id="exampleInputEmail1" placeholder="Enter Product" aria-describedby="emailHelp">

                                                </td>
                                                <td>
                                                    <!-- <?php echo $u->process ?> -->
                                                    <input type="text" name="process" value=" <?php echo $u->process ?>" required class="form-control" id="exampleInputEmail1" placeholder="Enter Product" aria-describedby="emailHelp">

                                                </td>
                                                <td>
                                                    <!-- <?php echo $u->specification_tolerance ?> -->

                                                    <input type="text" name="specification_tolerance" value=" <?php echo $u->specification_tolerance ?>" required class="form-control" id="exampleInputEmail1" placeholder="Enter Product" aria-describedby="emailHelp">

                                                </td>
                                                <td>
                                                    <!-- <?php echo $u->evalution ?> -->

                                                    <input type="text" name="evalution" value=" <?php echo $u->evalution ?>" required class="form-control" id="exampleInputEmail1" placeholder="Enter Product" aria-describedby="emailHelp">

                                                </td>
                                                <td>
                                                    <!-- <?php echo $u->size ?> -->

                                                    <input type="text" name="size" value=" <?php echo $u->size ?>" required class="form-control" id="exampleInputEmail1" placeholder="Enter Product" aria-describedby="emailHelp">

                                                </td>
                                                <td>
                                                    <!-- <?php echo $u->frequency ?> -->

                                                    <input type="text" name="frequency" value=" <?php echo $u->frequency ?>" required class="form-control" id="exampleInputEmail1" placeholder="Enter Product" aria-describedby="emailHelp">
                                                    <input type="hidden" name="customer_part_operation_id" value="<?php echo $customer_part_operation[0]->id ?>" required class="form-control" id="exampleInputEmail1" placeholder="Enter " aria-describedby="emailHelp">
                                                    </form>
                                                </td>






                                            </tr>

                                        <?php
                                            $i++;
                                        }

                                        ?>
                                    </tbody>

                                </table>
                            </div>




                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr class="text-center align-middle">
                                            <!-- <th>Operation Name</th> -->
                                            <th colspan="3">Characteristics</th>
                                            <th rowspan="2" class="align-middle">Product Specification / Tolerance</th>
                                            <th rowspan="2" class="align-middle">Evaluation / Measurement Techn</th>
                                            <th rowspan="2" class="align-middle">Size</th>
                                            <th rowspan="2" class="align-middle">Frequency</th>
                                        </tr>
                                        <tr>
                                            <!-- <th></th> -->
                                            <th>Sr. No.</th>
                                            <th>Product</th>
                                            <th>Process</th>
                                            <th>Delete</th>


                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $i = 1;
                                        if ($customer_part_operation_data) {
                                            foreach ($customer_part_operation_data as $c) {
                                                // // echo $poo->part_number;
                                                // $customer_part_rate_data = $this->Crud->get_data_by_id("customer_part_operation", $poo->customer_master_id, "customer_master_id");
                                                // $operations_data = $this->Crud->get_data_by_id("operations", $poo->operation_id, "id");
                                                // $po = $this->Crud->get_data_by_id("customer_part", $poo->customer_master_id, "id");
                                                // $customer_data = $this->Crud->get_data_by_id("customer", $po[0]->customer_id, "id");
                                                // $customer_part_data = $this->Crud->get_data_by_id("customer_part_type", $po[0]->customer_part_id, "id");
                                                // print_r($supplier_data);
                                                if (true) {
                                        ?>

                                                    <tr>
                                                        <!-- <td><?php echo $c->operation_name ?></td> -->

                                                        <td><?php echo $i ?></td>
                                                        <td><?php echo $c->product ?></td>
                                                        <td><?php echo $c->process ?></td>
                                                        <td><?php echo $c->specification_tolerance ?></td>
                                                        <td><?php echo $c->evalution ?></td>
                                                        <td><?php echo $c->size ?></td>
                                                        <td><?php echo $c->frequency ?></td>
                                                        <td>
                                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#addPromo<?php echo $i; ?>">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                            <div class="modal fade" id="addPromo<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form action="<?php echo base_url('delete') ?>" method="POST" enctype="multipart/form-data">

                                                                                <label for="">Are You Sure Want To Delete This ?</label>
                                                                                <input type="hidden" value="<?php echo $c->id ?>" name="id" class="form-control">
                                                                                <input type="hidden" value="customer_part_operation_data" name="table_name" class="form-control">



                                                                        </div>








                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                            <button type="submit" class="btn btn-danger">Delete </button>
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