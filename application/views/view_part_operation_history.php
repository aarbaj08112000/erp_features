<div style="width:2000px" class="wrapper">
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
                        <h1>Customer Part Operation History</h1>
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
                                <!-- <button type="button" class="btn btn-primary float-left" data-toggle="modal" data-target="#exampleModal">
                                    Add </button> -->
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
                                            <form action="<?php echo base_url('add_customer_operation') ?>" method="POST" enctype='multipart/form-data'>
                                                <div class="row">
                                                    <div class="col-lg-12">


                                                        <!-- <div class="form-group">
                                                                <label for="operation_number">Operation Number</label><span class="text-danger">*</span>
                                                                <input type="text" name="operationNumber" class="form-control" required id="exampleInputPassword1" placeholder="Operation Number">

                                                        </div>-->
                                                        <div class="form-group">
                                                            <label for="po_num">Select Customer Name / Customer Code / Part Number / Description </label><span class="text-danger">*</span>
                                                            <select name="customer_master_id" id="" class="from-control select2">
                                                                <?php
                                                                if ($customer_part) {
                                                                    foreach ($customer_part as $c) {
                                                                        if ($customer_id == $c->customer_id) {                                                                        // $data['toolList'] = $this->Crud->get_data_by_id("tools", "insert", "type");
                                                                            $customer = $this->Crud->get_data_by_id("customer", $c->customer_id, "id");

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
                                                            <label for="po_num">Select Operations </label><span class="text-danger">*</span>
                                                            <select name="operation_id" id="" class="form-control">
                                                                <?php
                                                                if ($operations) {
                                                                    foreach ($operations as $o) {
                                                                ?>
                                                                        <option value="<?php echo $o->id ?>"><?php echo $o->name; ?></option>
                                                                <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>


                                                        <div class="form-group">
                                                            <label for="po_num">Operation Name </label><span class="text-danger">*</span>
                                                            <input type="text" name="name" required class="form-control" id="exampleInputEmail1" placeholder="Enter name" aria-describedby="emailHelp">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="po_num">Revision Number </label><span class="text-danger">*</span>
                                                            <input type="text" name="revision_no" required class="form-control" id="exampleInputEmail1" placeholder="Enter " aria-describedby="emailHelp">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="po_num">Revision Date</label><span class="text-danger">*</span>
                                                            <input type="date" name="revision_date" required class="form-control" id="exampleInputEmail1" placeholder="Enter " aria-describedby="emailHelp">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="po_num">Revision Remark</label><span class="text-danger">*</span>
                                                            <input type="text" name="revision_remark" required class="form-control" id="exampleInputEmail1" placeholder="Enter " aria-describedby="emailHelp">
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
                                            <th>Sr. No.</th>
                                            <th>Revision Number</th>
                                            <th>Revision Date</th>
                                            <th>Revision Remark</th>
                                            <th>Customer Name</th>
                                            <th>Part Number</th>
                                            <th>Part Description</th>
                                            <th>Opration Number </th>
                                            <th>Opration Name </th>
                                            <th> Details</th>

                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Sr. No.</th>

                                            <th>Revision Number</th>
                                            <th>Revision Date</th>
                                            <th>Revision Remark</th>
                                            <th>Customer Name</th>
                                            <th>Part Number</th>
                                            <th>Part Description</th>
                                            <th>Opration Number </th>
                                            <th>Opration Name </th>
                                            <th> Details</th>

                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        if ($customer_part_rate) {
                                            // print_r($customer_part_rate);

                                            foreach ($customer_part_rate as $poo) {
                                                // echo $poo->part_number;
                                                $customer_part_rate_data = $this->Crud->get_data_by_id("customer_part_operation", $poo->customer_master_id, "customer_master_id");
                                                $operations_data = $this->Crud->get_data_by_id("operations", $poo->operation_id, "id");
                                                $po = $this->Crud->get_data_by_id("customer_part", $poo->customer_master_id, "id");
                                                $customer_data = $this->Crud->get_data_by_id("customer", $po[0]->customer_id, "id");
                                                $customer_part_data = $this->Crud->get_data_by_id("customer_part_type", $po[0]->customer_part_id, "id");
                                                // print_r($supplier_data);
                                                if ($operation_id == $poo->operation_id) {
                                        ?>

                                                    <tr>
                                                        <td><?php echo $i ?></td>
                                                        <td><?php echo $poo->revision_no ?></td>
                                                        <td><?php echo $poo->revision_date ?></td>
                                                        <td><?php echo $poo->revision_remark ?></td>

                                                        <td><?php echo $customer_data[0]->customer_name ?></td>
                                                        <td><?php echo $po[0]->part_number ?></td>
                                                        <td><?php echo $po[0]->part_description ?></td>
                                                        <td><?php echo $operations_data[0]->name ?></td>
                                                        <td><?php echo $poo->name ?></td>
                                                        <td>
                                                            <a class="btn btn-info" href="<?php echo base_url('add_operation_details/') . $poo->id; ?>">Add Details</a>
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