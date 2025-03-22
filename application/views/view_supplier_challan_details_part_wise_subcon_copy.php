<div class="wrapper">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Customer Challan</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo base_url(''); ?>">Home</a></li>
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
                                    Add Challan </button> -->

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
                                                <form action="<?php echo base_url('generate_challan'); ?>" method="post">


                                                    <div class="form-group">
                                                        <label for="Enter Challan Number">Challan Number <span class="text-danger">*</span> </label>
                                                        <input type="text" name="challan_number" placeholder="Challan Number " required class="form-control">
                                                    </div>
                                                    <label for="Enter Challan Number">Select Supplier <span class="text-danger">*</span> </label>

                                                    <select class="form-control select2" name="supplier_id" style="width: 100%;">

                                                        <?php
                                                        foreach ($supplier as $c) {
                                                        ?>
                                                            <option value="<?php echo $c->id; ?>"><?php echo $c->supplier_name; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>





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
                                            <th>Part Number</th>
                                            <th>UOM</th>
                                            <th>GRN Number</th>
                                            <th>Invoice Number</th>
                                            <th>Qty</th>
                                            <th>Pending Qty</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $i = 1;
                                        if ($subcon_po_inwarding_history) {
                                            foreach ($subcon_po_inwarding_history as $c) {

                                                $child_part_data = $this->Crud->get_data_by_id("child_part", $c->subcon_po_inwarding_parts_id, "id");
                                                $uom_data = $this->Crud->get_data_by_id("uom", $child_part_data[0]->uom_id, "id");
                                                $subcon_po_inwarding_parts_data = $this->Crud->get_data_by_id("subcon_po_inwarding_parts", $c->subcon_po_inwarding_parts_id, "id");
                                                $subcon_po_inwarding_data = $this->Crud->get_data_by_id("subcon_po_inwarding", $subcon_po_inwarding_parts_data[0]->main_sub_con_part_id, "id");
                                                $new_po_data = $this->Crud->get_data_by_id("new_po", $subcon_po_inwarding_data[0]->po_id, "id");

                                        ?>

                                                <tr>

                                                    <td><?php echo $i ?></td>


                                                    <td><?php echo $child_part_data[0]->part_number . " / " . $child_part_data[0]->part_description;; ?></td>
                                                    <td><?php echo $uom_data[0]->uom_name; ?></td>
                                                    <td><?php echo $c->grn_number; ?></td>
                                                    <td><?php echo $c->invoice_number ?></td>
                                                    <td><?php echo $c->new_qty ?></td>
                                                    <td><?php echo $c->previous_qty  ?></td>




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