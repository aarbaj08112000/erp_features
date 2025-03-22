<?php

$entitlements = $this->session->userdata['entitlements'];


?>
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
                                <a class="btn btn-danger" href="<?php echo base_url('customer_master'); ?>">
                                    Back </a>

                                <!-- <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#exampleModal">
                                    Add </button> -->

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog " role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                                                                <label> item part </label><span class="text-danger">*</span>
                                                                <select class="form-control select2" name="child_part_id" style="width: 100%;">
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
                                                                <label for="po_num">Quantity</label><span class="text-danger">*</span>
                                                                <input type="number" name="quantity" required class="form-control" id="exampleInputEmail1" placeholder="Enter Quantity" aria-describedby="emailHelp">
                                                                <input type="hidden" name="customer_part_id" value="<?php echo $customer[0]->id; ?>" required class="form-control" id="exampleInputEmail1" placeholder="Enter Quantity" aria-describedby="emailHelp">
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
                                            <th> Part Number</th>
                                            <th>Part Description</th>
                                            <th>Details</th>
                                            <?php if($entitlements['isSheetMetal']!=null) { ?>
                                             <th>Operations BOM</th>
                                             <?php } if($entitlements['isPlastic']!=null) { ?>
                                            <!-- <th>Deflashing BOM</th> -->
                                            <?php } ?>
                                            <th>Customer Subcon bom </th>


                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <!-- <th>Customer Part Number</th> -->
                                            <th> Part Number</th>
                                            <th>Part Description</th>
                                            <th>Details</th>
                                            <?php if($entitlements['isSheetMetal']!=null) { ?>
                                             <th>Operations BOM</th>
                                             <?php } if($entitlements['isPlastic']!=null) { ?>
                                            <!--<th>Deflashing BOM</th> -->
                                            <?php } ?>
                                            <th>Customer Subcon bom </th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        if ($customer_part) {
                                            $i = 1;
                                            foreach ($customer_part as $c) {
                                                if ($customer_id == $c->customer_id) {                                                                        // $data['toolList'] = $this->Crud->get_data_by_id("tools", "insert", "type");
                                                    $customer = $this->Crud->get_data_by_id("customer", $c->customer_id, "id");
                                        ?>
                                                    <tr>
                                                        <td><?php echo $i ?></td>
                                                        <td><?php echo $c->part_number ?></td>
                                                        <td><?php echo $c->part_description ?></td>
                                                        <td><a href="<?php echo base_url('bom_by_id/') . $c->id  ?>" class="btn btn-info">RM BOM</a></td>
                                                        <?php if($entitlements['isSheetMetal']!=null){ ?>
                                                            <td><a href="<?php echo base_url('operations_bom/') . $c->id  ?>" class="btn btn-danger">Operations BOM</a></td>
                                                        <?php } if($entitlements['isPlastic']!=null){ ?>
                                                        <!-- <td><a href="<?php echo base_url('deflashing_bom/') . $c->id  ?>" class="btn btn-success">Operations BOM</a></td> -->
                                                        <?php } ?>
                                                        <td><a href="<?php echo base_url('subcon_bom/') . $c->id  ?>" class="btn btn-warning">Subcon BOM</a></td>
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