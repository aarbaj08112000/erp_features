<div class="wrapper">
    <!-- Navbar -->

    <!-- /.navbar -->

    <!-- Main Sidebar Container -->


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="width: 1300px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>In Warding</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">In Warding</li>
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
                                    <form class="form-inline">
                                        <div class="form-group mb-2">
                                            <label for="" class="p-2">In Warding</label>
                                        </div>
                                        <div class="form-group mx-sm-3 mb-2">
                                        </div>
                                    </form>

                                </h3>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#exampleModal">
                                    Add Data </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg " role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add Data </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="<?php echo base_url('addStore') ?>" method="POST">
                                                    <div class="row">
                                                        <div class="col-lg-4">

                                                            <div class="form-group">
                                                                <label> Supplier Name/Number </label><span class="text-danger">*</span>
                                                                <select class="form-control select2" name="supplier_name" style="width: 100%;">
                                                                    <?php
                                                                    foreach ($supplier_list as $c) {
                                                                    ?>
                                                                        <option value="<?php echo $c->id; ?>"><?php echo $c->supplier_name . " / " . $c->supplier_number ?></option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label> Part Number/ Part Description </label><span class="text-danger">*</span>
                                                                <select class="form-control select2" name="part" style="width: 100%;">
                                                                    <?php
                                                                    foreach ($part_list as $c) {
                                                                    ?>
                                                                        <option value="<?php echo $c->id; ?>"><?php echo $c->part_number . " / " . $c->part_description ?></option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>


                                                            <div class="form-group">
                                                                <label for="po_number">Enter invoice amount </label><span class="text-danger">*</span>
                                                                <input type="number" name="invoice_amount" required class="form-control" id="exampleInputEmail1" placeholder="Enter invoice amount" aria-describedby="emailHelp">
                                                            </div>

                                                        </div>


                                                        <div class="col-lg-4">

                                                            <div class="form-group">
                                                                <label for="po_number">Enter P.O number </label><span class="text-danger">*</span>
                                                                <input type="text" name="po_number" required class="form-control" id="exampleInputEmail1" placeholder="Enter P.O number" aria-describedby="emailHelp">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="advance_amt">Enter Quantity</label><span class="text-danger">*</span>
                                                                <input type="number" min="0" name="quantity" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Quantity">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="date">Enter Date</label><span class="text-danger">*</span>
                                                                <input type="date" name="dateee" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Date">
                                                            </div>


                                                        </div>
                                                        <div class="col-lg-4">

                                                            <div class="form-group">
                                                                <label for="invoice_number">Enter Supplier Invoice Number</label><span class="text-danger">*</span>
                                                                <input type="text" name="invoice_number" class="form-control" required id="exampleInputPassword1" placeholder="Enter Supplier Invoice Number ">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="advance_amt">Enter Rate in Rs</label><span class="text-danger">*</span>
                                                                <input type="number" name="rate" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Rate in Rs">
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
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Part Number</th>
                                            <th>Part Description</th>
                                            <th>Quantity</th>
                                            <th>Rate</th>
                                            <th>Invoice Amount</th>
                                            <th>GRN Number</th>
                                            <th>Date </th>
                                            <th>Supplier Name</th>
                                            <th>Supplier Number</th>
                                            <th>PO Number</th>
                                            <th>Supplier Invoice Number</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        if ($store_list) {
                                            foreach ($store_list as $l) {
                                                $part = $this->Crud->get_data_by_id("consumable_item", $l->part_id, "id");
                                                $supplier = $this->Crud->get_data_by_id("supplier", $l->supplier_id, "id");
                                                // print_r($customer);
                                        ?>

                                                <tr>
                                                    <td><?php echo $i ?></td>
                                                    <td><?php echo $part[0]->part_number ?></td>
                                                    <td><?php echo $part[0]->part_description ?></td>
                                                    <td><?php echo $l->quantity  ?></td>
                                                    <td><?php echo $l->rate ?></td>
                                                    <td><?php echo $l->invoice_amount ?></td>
                                                    <td><?php echo $l->grn_number ?></td>
                                                    <td><?php echo $l->entered_date ?></td>
                                                    <td><?php echo $supplier[0]->supplier_name ?></td>
                                                    <td><?php echo $supplier[0]->supplier_number ?></td>
                                                    <td><?php echo $l->po_number ?></td>
                                                    <td><?php echo $l->supplier_invoice_number ?></td>


                                                    <td style="width: 200px;">
                                                        <button type="submit" data-toggle="modal" class="btn btn-sm btn-primary" data-target="#exampleModaledit2<?php echo $i ?>"> <i class="fas fa-edit"></i></button>
                                                        <div class="modal fade" id="exampleModaledit2<?php echo $i ?>"" tabindex=" -1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg " role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Update </h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form action="<?php echo base_url('updateStore') ?>" method="POST">
                                                                            <div class="row">
                                                                                <div class="col-lg-4">

                                                                                    <div class="form-group">
                                                                                        <label> Supplier Name/Number </label><span class="text-danger">*</span>
                                                                                        <select class="form-control select2" name="usupplier_name" style="width: 100%;">
                                                                                            <?php
                                                                                            foreach ($supplier_list as $c) {
                                                                                            ?>
                                                                                                <option value="<?php echo $c->id; ?>"><?php echo $c->supplier_name . " / " . $c->supplier_number ?></option>
                                                                                            <?php
                                                                                            }
                                                                                            ?>
                                                                                        </select>
                                                                                    </div>

                                                                                    <div class="form-group">
                                                                                        <label> Part Number/ Item Number </label><span class="text-danger">*</span>
                                                                                        <select class="form-control select2" name="upart" style="width: 100%;">
                                                                                            <?php
                                                                                            foreach ($part_list as $c) {
                                                                                            ?>
                                                                                                <option value="<?php echo $c->id; ?>"><?php echo $c->part_number . " / " . $c->part_description ?></option>
                                                                                            <?php
                                                                                            }
                                                                                            ?>
                                                                                        </select>
                                                                                    </div>


                                                                                    <div class="form-group">
                                                                                        <label for="po_number">Enter invoice amount </label><span class="text-danger">*</span>
                                                                                        <input type="number" value="<?php echo $l->invoice_amount ?>" name="uinvoice_amount" required class="form-control" id="exampleInputEmail1" placeholder="Enter invoice amount" aria-describedby="emailHelp">
                                                                                    </div>

                                                                                </div>


                                                                                <div class="col-lg-4">

                                                                                    <div class="form-group">
                                                                                        <label for="po_number">Enter P.O number </label><span class="text-danger">*</span>
                                                                                        <input type="text" value="<?php echo $l->po_number ?>" name="upo_number" required class="form-control" id="exampleInputEmail1" placeholder="Enter P.O number" aria-describedby="emailHelp">
                                                                                        <input type="hidden" value="<?php echo $l->id ?>" name="id" required class="form-control" id="exampleInputEmail1" placeholder="Enter P.O number" aria-describedby="emailHelp">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="advance_amt">Enter Quantity</label><span class="text-danger">*</span>
                                                                                        <input type="number" value="<?php echo $l->quantity ?>" name="uquantity" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Quantity">
                                                                                    </div>

                                                                                    <div class="form-group">
                                                                                        <label for="date">Enter Date</label><span class="text-danger">*</span>
                                                                                        <input type="date" name="udateee" value="<?php echo $l->entered_date ?>"  required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Date">
                                                                                    </div>

                                                                                </div>
                                                                                <div class="col-lg-4">

                                                                                    <div class="form-group">
                                                                                        <label for="invoice_number">Enter Supplier Invoice Number</label><span class="text-danger">*</span>
                                                                                        <input type="text" value="<?php echo $l->supplier_invoice_number ?>" name="uinvoice_number" class="form-control" required id="exampleInputPassword1" placeholder="Enter Supplier Invoice Number ">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="advance_amt">Enter Rate in Rs</label><span class="text-danger">*</span>
                                                                                        <input type="number" value="<?php echo $l->rate ?>" name="urate" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Rate in Rs">
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
                                                        <button type="submit" data-toggle="modal" class="btn btn-sm btn-danger ml-4" data-target="#exampleModal3"> <i class="far fa-trash-alt"></i></button>
                                                        <!-- Button trigger modal -->
                                                        <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                                    Launch demo modal
                                                </button> -->

                                                        <!-- Modal -->
                                                        <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

                                                                            <input value="<?php echo $l->id; ?>" name="id" type="hidden" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Machine Name">
                                                                            <input value="store" name="table_name" type="hidden" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Machine Name">

                                                                            Are you sure you want to delete
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-danger">Delete </button>
                                                                    </div>
                                                                    </form>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- <a href="<?php echo base_url("po/" . $customer[0]->id) ?>" class="btn btn-sm btn-primary ml-4"> <i class="fa fa-eye"></i></a> -->

                                                    </td>
                                                </tr>
                                        <?php
                                                $i++;
                                            }
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Part Number</th>
                                            <th>Part Description</th>
                                            <th>Quantity</th>
                                            <th>Rate</th>
                                            <th>Invoice Amount</th>
                                            <th>GRN Number</th>
                                            <th>Date </th>
                                            <th>Supplier Name</th>
                                            <th>Supplier Number</th>
                                            <th>PO Number</th>
                                            <th>Supplier Invoice Number</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
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