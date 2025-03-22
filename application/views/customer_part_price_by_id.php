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
                        <h1>Customer Part Price</h1>
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
                                <!-- Button trigger modal -->
                                <a href="<?php echo base_url('customer_master'); ?>" class="btn btn-danger ">
                                    Back </a>
                                <br>
                                <br>
                                <button type="button" class="btn btn-primary float-left" data-toggle="modal" data-target="#exampleModal">
                                    Add </button>
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
                                            <form action="<?php echo base_url('add_customer_price') ?>" method="POST" enctype='multipart/form-data'>
                                                <div class="row">
                                                    <div class="col-lg-12">


                                                        <!-- <div class="form-group">
                                                                <label for="operation_number">Operation Number</label><span class="text-danger">*</span>
                                                                <input type="text" name="operationNumber" class="form-control" required id="exampleInputPassword1" placeholder="Operation Number">

                                                        </div>-->
                                                        <div class="form-group">
                                                            <label for="po_num">Select Customer Name / Customer Code / Part Number / Description  </label><span class="text-danger">*</span>
                                                            <select name="customer_master_id" id="" class="from-control select2">
                                                                <?php
                                                                if ($customer_part) {
                                                                    foreach ($customer_part as $c) {
                                                                        if ($customer_id == $c->customer_id) {                                                                        // $data['toolList'] = $this->Crud->get_data_by_id("tools", "insert", "type");
                                                                            $customer = $this->Crud->get_data_by_id("customer", $c->customer_id, "id");
                                                                            $customer_part_type = $this->Crud->get_data_by_id("customer_part_type", $c->customer_part_id, "id");

                                                                ?>
                                                                            <option value="<?php echo $c->id ?>"><?php echo $customer[0]->customer_name . "/" . $customer[0]->customer_code . "/" . $c->part_number . "/" . $c->part_description ?></option>
                                                                <?php
                                                                        }
                                                                    }
                                                                }
                                                                ?>
                                                            </select>

                                                        </div>
                                                        <div class="form-group">
                                                            <label for="po_num">Part Rate </label><span class="text-danger">*</span>
                                                            <input type="number" step="any" name="rate" required class="form-control" id="exampleInputEmail1" placeholder="Enter Part Rate" aria-describedby="emailHelp">
                                                        </div>


                                                        <div class="form-group">
                                                            <label for="po_num">Revision Number </label><span class="text-danger">*</span>
                                                            <input type="text" name="revision_no" required class="form-control" id="exampleInputEmail1" placeholder="Enter Revision Number" aria-describedby="emailHelp">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="po_num">Revision Date</label><span class="text-danger">*</span>
                                                            <input type="date" name="revision_date" required class="form-control" id="exampleInputEmail1" placeholder="Enter Revision Date" aria-describedby="emailHelp">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="po_num">Revision Remark</label><span class="text-danger">*</span>
                                                            <input type="text" name="revision_remark" required class="form-control" id="exampleInputEmail1" placeholder="Enter Revision Remark" aria-describedby="emailHelp">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label for="po_num">Price Uploading Document</label>
                                                            <input type="file" name="uploading_document" class="form-control" id="exampleInputEmail1" placeholder="Enter Price Uploading Document" aria-describedby="emailHelp">
                                                        </div>




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
                                            <th>Sr. No.</th>
                                            <th>Add Revision</th>
                                            <th>Revision Number</th>
                                            <th>Revision Date</th>
                                            <th>Revision Remark</th>
                                            <th>Customer Name</th>
                                            <th>Part Number</th>
                                            <th>Part Description</th>
                                            <th>Part Rate</th>

                                            <!-- <th>Customer Part Type</th> -->
                                            <th>Price Supporting Document </th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Add Revision</th>

                                            <th>Revision Number</th>
                                            <th>Revision Date</th>
                                            <th>Revision Remark</th>
                                            <th>Customer Name</th>
                                            <th>Part Number</th>
                                            <th>Part Description</th>
                                            <th>Part Rate</th>
                                            <!-- <th>Customer Part Type</th> -->
                                            <th>Price Supporting Document </th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        
                                        if ($customer_part_rate) {
                                            foreach ($customer_part_rate as $poo) {
                                                // echo $poo->part_number;
                                                $customer_part_rate_data = $this->Crud->get_data_by_id("customer_part_rate", $poo->customer_master_id, "customer_master_id");
                                                $po = $this->Crud->get_data_by_id("customer_part", $poo->customer_master_id, "id");
                                                $customer_data = $this->Crud->get_data_by_id("customer", $po[0]->customer_id, "id");
                                                $customer_part_data = $this->Crud->get_data_by_id("customer_part_type", $po[0]->customer_part_id, "id");
                                               
                                                if ($customer_data[0]->id == $customer_id) {
                                        ?>

                                                    <tr>
                                                        <td><?php echo $i ?></td>
                                                        <td>
                                                            <button type="submit" data-toggle="modal" class="btn btn-sm btn-primary" data-target="#exampleModaledit2<?php echo $i ?>">Add Revision</button>

                                                            <a href="<?php echo base_url('view_part_rate_history/') . $poo->customer_master_id; ?>" class="btn btn-primary btn-sm">history</a>
                                                            <div class="modal fade" id="exampleModaledit2<?php echo $i ?>" tabindex=" -1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog " role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">Update Oeration</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form action="<?php echo base_url('updatecustomerpartprice') ?>" method="POST" enctype='multipart/form-data'>
                                                                                <div class="row">
                                                                                    <div class="col-lg-6">


                                                                                        <input value="<?php echo $po[0]->id ?>" type="hidden" name="id" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Customer Name">

                                                                                        <div class="form-group">
                                                                                            <label for="po_num">Part Number </label><span class="text-danger">*</span>
                                                                                            <input type="text" readonly value="<?php echo $po[0]->part_number  ?>" name="upart_number" required class="form-control" id="exampleInputEmail1" placeholder="Enter Part Number" aria-describedby="emailHelp">
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label for="po_num">Part Description </label><span class="text-danger">*</span>
                                                                                            <input type="text" readonly value="<?php echo $po[0]->part_description  ?>" name="upart_desc" required class="form-control" id="exampleInputEmail1" placeholder="Enter Part Description" aria-describedby="emailHelp">
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label for="po_num">Part Rate </label><span class="text-danger">*</span>
                                                                                            <input type="number" name="rate" step="any" required class="form-control" id="exampleInputEmail1" placeholder="Enter Part Rate" aria-describedby="emailHelp">
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label for="po_num">Revision Date </label><span class="text-danger">*</span>
                                                                                            <input type="date" value="<?php echo $po[0]->revision_date ?>" name="revision_date" required class="form-control" id="exampleInputEmail1" placeholder="Enter Revision Date" aria-describedby="emailHelp">
                                                                                            <input type="hidden" value="<?php echo $customer_part_rate_data[0]->customer_master_id ?>" name="customer_master_id" required class="form-control" id="exampleInputEmail1" placeholder="Enter Part Rate" aria-describedby="emailHelp">
                                                                                            <input type="hidden" value="<?php echo $customer_part_rate_data[0]->uploading_document ?>" name="uploading_document" required class="form-control" id="exampleInputEmail1" placeholder="Enter Part Rate" aria-describedby="emailHelp">
                                                                                            <input type="hidden" value="<?php echo $customer_part_rate_data[0]->customer_part_id ?>" name="customer_part_id" required class="form-control" id="exampleInputEmail1" placeholder="Enter Part Rate" aria-describedby="emailHelp">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-6">
                                                                                        <div class="form-group">
                                                                                            <label for="po_num">Revision Number </label><span class="text-danger">*</span>
                                                                                            <input type="text" value="<?php echo $po[0]->revision_no  ?>" name="revision_no" required class="form-control" id="exampleInputEmail1" placeholder="Enter Revision Number" aria-describedby="emailHelp">
                                                                                            <input type="hidden" value="<?php echo $po[0]->customer_id  ?>" name="customer_id" required class="form-control" id="exampleInputEmail1"  aria-describedby="emailHelp">
                                                                                            <input type="hidden" value="<?php echo $po[0]->customer_part_id  ?>" name="customer_part_id" required class="form-control" id="exampleInputEmail1"  aria-describedby="emailHelp">
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label for="po_num">Revision Remark </label><span class="text-danger">*</span>
                                                                                            <input type="text" value="" name="revision_remark" required class="form-control" id="exampleInputEmail1" placeholder="Enter Revision Remark" aria-describedby="emailHelp">
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

                            <!-- <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

                                                <input value="<?php echo $po[0]->id; ?>" name="id" type="hidden" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Machine Name">
                                                <input value="customer_part" name="table_name" type="hidden" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Machine Name">

                                                Are you sure you want to delete
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-danger">Delete </button>
                                        </div>
                                        </form>

                                    </div>
                                </div>
                            </div> -->

                            </td>
                            <td><?php echo $customer_part_rate_data[0]->revision_no ?></td>
                            <td><?php echo $customer_part_rate_data[0]->revision_date ?></td>
                            <td><?php echo $customer_part_rate_data[0]->revision_remark ?></td>

                            <td><?php echo $customer_data[0]->customer_name ?></td>
                            <td><?php echo $po[0]->part_number ?></td>
                            <td><?php echo $po[0]->part_description ?></td>
                            <td><?php echo $customer_part_rate_data[0]->rate ?></td>
                            <!-- <td><?php echo $customer_part_data[0]->customer_type_name ?></td> -->
                            <td>
                                <?php
                                                    if ($customer_part_rate_data[0]->uploading_document != "") {


                                ?>
                                    <a download href="<?php echo base_url('documents/') . $customer_part_rate_data[0]->uploading_document ?>" id="" class="btn btn-sm btn-primary remove_hoverr ">Download</a>
                                <?php
                                                    } ?>
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