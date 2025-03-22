<div class="wrapper">
    <!-- Navbar -->

    <!-- /.navbar -->

    <!-- Main Sidebar Container -->


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="width:2000px">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Purchase Order</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Purchase Order</li>
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
                                <button type="button" class="btn btn-primary float-left" data-toggle="modal" data-target="#exampleModal">
                                    Add </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg " role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="<?php echo base_url('addPurchaseOrder') ?>" method="POST">
                                                    <div class="row">
                                                        <div class="col-lg-4">


                                                            <!-- <div class="form-group">
                                                                <label for="po_num">PO Number </label><span class="text-danger">*</span>
                                                                <input type="text" name="po_number" required class="form-control" id="exampleInputEmail1" placeholder="Enter Part Number" aria-describedby="emailHelp">
                                                            </div> -->
                                                            <div class="form-group">
                                                                <label> Part Number </label><span class="text-danger">*</span>
                                                                <select class="form-control select2" name="part_number" id="po_so_ajax" style="width: 100%;">
                                                                    <option value="n/a">N/A</option>

                                                                    <?php
                                                                    foreach ($child_part_list as $c1) {
                                                                    ?>
                                                                        <option value="<?php echo $c1->id; ?>"><?php echo $c1->part_number; ?></option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="po_num">Part Name </label><span class="text-danger">*</span>
                                                                <input type="text" readonly name="part_name" required class="form-control" id="ajax_part_name" placeholder="Enter Part Rate" aria-describedby="emailHelp">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="po_num">Revision Number </label><span class="text-danger">*</span>
                                                                <input type="text" name="revision_no" readonly required class="form-control" id="ajax_part_rno" placeholder="Enter Safty/buffer stock" aria-describedby="emailHelp">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="po_num">Revision Date </label><span class="text-danger">*</span>
                                                                <input type="text" name="revision_date" readonly required class="form-control" id="ajax_part_rdate" placeholder="Enter Safty/buffer stock" aria-describedby="emailHelp">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="po_num">Part Price </label><span class="text-danger">*</span>
                                                                <input type="text" name="part_price" readonly required class="form-control" id="ajax_part_price" placeholder="Enter Safty/buffer stock" aria-describedby="emailHelp">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="po_num">Delivery Date </label><span class="text-danger">*</span>
                                                                <input type="date" name="delivery_date" required class="form-control" id="exampleInputEmail1" placeholder="Enter Safty/buffer stock" aria-describedby="emailHelp">
                                                            </div>
                                                            <div class="form-group">
                                                                <label> Supplier Code or Name </label><span class="text-danger">*</span>
                                                                <select class="form-control select2" name="supplier_name" id="po_supplier_ajax" style="width: 100%;">

                                                                    <option value="n/a">N/A
                                                                    </option>
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
                                                        <div class="col-lg-4">


                                                            <div class="form-group">
                                                                <label for="po_num">Supplier GSTIN</label><span class="text-danger">*</span>
                                                                <input type="text" readonly name="supplier_gstn" required class="form-control" id="ajax_supplier_gstn" placeholder="Enter Safty/buffer stock" aria-describedby="emailHelp">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="po_num">Payment Terms </label><span class="text-danger">*</span>
                                                                <input type="text" name="payment_term" readonly required class="form-control" id="ajax_payment_terms" placeholder="Enter Safty/buffer stock" aria-describedby="emailHelp">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="po_num">Remark </label><span class="text-danger">*</span>
                                                                <input type="text" name="remark" required class="form-control" id="exampleInputEmail1" placeholder="Enter Safty/buffer stock" aria-describedby="emailHelp">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="po_num">Contact Person</label><span class="text-danger">*</span>
                                                                <input type="text" readonly value="<?php echo $client_list[0]->contact_person ?>/<?php echo $client_list[0]->phone_no ?>" name="contact_person" required class="form-control" id="exampleInputEmail1" placeholder="Enter Safty/buffer stock" aria-describedby="emailHelp">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="po_num">Billing address </label><span class="text-danger">*</span>
                                                                <input type="text" name="b_address" readonly value="<?php echo $client_list[0]->billing_address ?>" required class=" form-control" id="exampleInputEmail1" placeholder="Enter Safty/buffer stock" aria-describedby="emailHelp">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="po_num">Shipping Address</label><span class="text-danger">*</span>
                                                                <input type="text" name="s_address" readonly value="<?php echo $client_list[0]->shifting_address ?>" required class="form-control" id="exampleInputEmail1" placeholder="Enter Safty/buffer stock" aria-describedby="emailHelp">
                                                            </div>


                                                            <div class="form-group">
                                                                <label for="po_num">Quantity</label><span class="text-danger">*</span>
                                                                <input type="text" name="quantity" required class="form-control" id="exampleInputEmail1" placeholder="Enter Safty/buffer stock" aria-describedby="emailHelp">
                                                            </div>


                                                        </div>
                                                        <div class="col-lg-4">

                                                            <div class="form-group">
                                                                <label for="po_num">PO Validity Date</label><span class="text-danger">*</span>
                                                                <input type="date" name="po_v_date" required class="form-control" id="exampleInputEmail1" placeholder="Enter Safty/buffer stock" aria-describedby="emailHelp">
                                                            </div>

                                                            <div class="form-group">
                                                                <label> UOM List </label><span class="text-danger">*</span>
                                                                <select class="form-control select2" name="uom_id" style="width: 100%;">
                                                                    <?php
                                                                    foreach ($uom as $c2) {
                                                                    ?>
                                                                        <option value="<?php echo $c2->id; ?>"><?php echo $c2->uom_name; ?></option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label> Part Type</label><span class="text-danger">*</span>
                                                                <select class="form-control select2" name="part_type" style="width: 100%;">

                                                                    <?php
                                                                    foreach ($part_type_list as $c3) {
                                                                    ?>
                                                                        <option value="<?php echo $c3->id; ?>"><?php echo $c3->part_type_name; ?></option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label>Shipping Method </label><span class="text-danger">*</span>
                                                                <select class="form-control select2" name="shipping" style="width: 100%;">

                                                                    <option value="road">Road</option>
                                                                    <option value="sea">sea</option>
                                                                    <option value="air">air</option>

                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label> Client GSTIN </label><span class="text-danger">*</span>
                                                                <!-- <select class="form-control select2" name="customer_id" style="width: 100%;">
                                                                    <option>N/A</option>

                                                                    <?php
                                                                    foreach ($customer_list as $c4) {
                                                                    ?>
                                                                        <option value="<?php echo $c4->id; ?>"><?php echo $c4->gst_number; ?></option>
                                                                    <?php
                                                                    }
                                                                    ?>

                                                                </select> -->
                                                                <input type="text" name="client_gst" readonly value="<?php echo $client_list[0]->gst_number ?>" required class="form-control" id="exampleInputEmail1" placeholder="Enter Safty/buffer stock" aria-describedby="emailHelp">

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
                                                        <button type="submit" id="disable_hus_obs1" class="btn btn-primary">Save changes</button>
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
                                            <th>PO Number</th>
                                            <th>Part Number</th>
                                            <th>Part Name</th>
                                            <th>Revision Date</th>
                                            <th>Revision Number</th>
                                            <th>Part Price</th>
                                            <th>Supplier Name</th>
                                            <!-- <th>Supplier GSTN</th> -->
                                            <!-- <th>Payment Terms</th> -->
                                            <!-- <th>Conatct Person/phone Number</th> -->
                                            <!-- <th>Client GSTN</th> -->
                                            <!-- <th>Billing Address</th> -->
                                            <!-- <th>Shipping Address</th> -->
                                            <th>UOM</th>
                                            <th>Quantity</th>
                                            <th>Remarks</th>
                                            <th>Delivery Date</th>
                                            <!-- <th>PO Validty Date</th> -->
                                            <th>Part Type</th>
                                            <!-- <th>Shipping method</th> -->
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        if ($purchase_order_list) {
                                            foreach ($purchase_order_list as $po) {
                                                $supplier_data = $this->Crud->get_data_by_id("supplier", $po->supplier_id, "id");
                                                $uom_data = $this->Crud->get_data_by_id("uom", $po->uom_id, "id");
                                                $child_part_data = $this->Crud->get_data_by_id("child_part", $po->part_id, "id");
                                                $part_type_data = $this->Crud->get_data_by_id("part_type", $po->part_type_id, "id");
                                                // print_r($supplier_data);
                                        ?>

                                                <tr>
                                                    <td><?php echo $i ?></td>
                                                    <td><?php echo $po->po_number ?></td>
                                                    <td><?php echo $child_part_data[0]->part_number ?></td>
                                                    <td><?php echo $child_part_data[0]->part_description ?></td>
                                                    <td><?php echo $child_part_data[0]->revision_date ?></td>
                                                    <td><?php echo $child_part_data[0]->revision_no ?></td>
                                                    <td><?php echo $child_part_data[0]->part_rate ?></td>
                                                    <td><?php echo $supplier_data[0]->supplier_name ?></td>
                                                    <!-- <td><?php echo $supplier_data[0]->gst_number ?></td>
                                                    <td><?php echo $supplier_data[0]->payment_terms ?></td>
                                                    <td><?php echo $client_list[0]->contact_person ?>/<?php echo $client_list[0]->phone_no ?></td>
                                                    <td><?php echo $client_list[0]->gst_number ?></td>
                                                    <td><?php echo $client_list[0]->billing_address ?></td>
                                                    <td><?php echo $client_list[0]->shifting_address ?></td> -->
                                                    <td><?php echo $uom_data[0]->uom_name ?></td>
                                                    <td><?php echo $po->quantity ?></td>
                                                    <td><?php echo $po->remark ?></td>
                                                    <td><?php echo $po->delivery_date ?></td>
                                                    <!-- <td><?php echo $po->po_validity_date ?></td> -->
                                                    <td><?php echo $part_type_data[0]->part_type_name ?></td>
                                                    <!-- <td><?php echo $po->shipping_method ?></td> -->



                                                    <td>
                                                        <button type="submit" data-toggle="modal" class="btn btn-sm btn-primary" data-target="#exampleModal2<?php echo $i ?>"> <i class="fas fa-edit"></i></button>

                                                        <div class="modal fade" id="exampleModal2<?php echo $i ?>" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Add Tool</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">



                                                                        <form action="<?php echo base_url('updatePurchaseOrder') ?>" method="POST">
                                                                            <div class="row">
                                                                                <div class="col-lg-4">



                                                                                    <div class="form-group">
                                                                                        <label> Part Number </label><span class="text-danger">*</span>
                                                                                        <select class="form-control select2" name="upart_number" id="upo_so_ajax<?php echo $i ?>" style="width: 100%;">
                                                                                            <option value="n/a">N/A</option>

                                                                                            <?php
                                                                                            foreach ($child_part_list as $c1) {
                                                                                            ?>
                                                                                                <option <?php
                                                                                                        if ($c1->id == $po->part_id) {
                                                                                                            echo " selected ";
                                                                                                        } else {
                                                                                                            echo " ";
                                                                                                        } ?> value="<?php echo $c1->id; ?>"><?php echo $c1->part_number; ?></option>
                                                                                            <?php
                                                                                            }
                                                                                            ?>
                                                                                        </select>
                                                                                    </div>

                                                                                    <div class="form-group">
                                                                                        <label for="po_num">Part Name </label><span class="text-danger">*</span>
                                                                                        <input type="text" value="<?php echo $child_part_data[0]->part_description ?>" readonly name="upart_name" required class="form-control" id="uajax_part_name<?php echo $i ?>" placeholder="Enter Part Rate" aria-describedby="emailHelp">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="po_num">Revision Number </label><span class="text-danger">*</span>
                                                                                        <input type="text" value="<?php echo $child_part_data[0]->revision_no ?>" name="urevision_no" readonly required class="form-control" id="uajax_part_rno<?php echo $i ?>" placeholder="Enter Safty/buffer stock" aria-describedby="emailHelp">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="po_num">Revision Date </label><span class="text-danger">*</span>
                                                                                        <input type="text" value="<?php echo $child_part_data[0]->revision_date ?>" name="urevision_date" readonly required class="form-control" id="uajax_part_rdate<?php echo $i ?>" placeholder="Enter Safty/buffer stock" aria-describedby="emailHelp">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="po_num">Part Price </label><span class="text-danger">*</span>
                                                                                        <input type="text" value="<?php echo $child_part_data[0]->part_rate ?>" name="upart_price" readonly required class="form-control" id="uajax_part_price<?php echo $i ?>" placeholder="Enter Safty/buffer stock" aria-describedby="emailHelp">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="po_num">Delivery Date </label><span class="text-danger">*</span>
                                                                                        <input type="text" value="<?php echo $po->delivery_date ?>" name="udelivery_date" required class="form-control" id="exampleInputEmail1" placeholder="Enter Safty/buffer stock" aria-describedby="emailHelp">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="po_num">Remark </label><span class="text-danger">*</span>
                                                                                        <input type="hidden" name="id" value="<?php echo $po->id ?>">
                                                                                        <input type="text" value="<?php echo $po->remark ?>" name="uremark" required class="form-control" id="exampleInputEmail1" placeholder="Enter Safty/buffer stock" aria-describedby="emailHelp">
                                                                                    </div>

                                                                                </div>
                                                                                <div class="col-lg-4">
                                                                                    <div class="form-group">
                                                                                        <label> Supplier Code or Name </label><span class="text-danger">*</span>
                                                                                        <select class="form-control select2" name="usupplier_name" id="upo_supplier_ajax" style="width: 100%;">

                                                                                            <option value="n/a">N/A
                                                                                            </option>
                                                                                            <?php
                                                                                            foreach ($supplier_list as $c) {
                                                                                            ?>
                                                                                                <option <?php
                                                                                                        if ($c->id == $po->supplier_id) {
                                                                                                            echo " selected ";
                                                                                                        } else {
                                                                                                            echo " ";
                                                                                                        } ?> value="<?php echo $c->id; ?>"><?php echo $c->supplier_name; ?></option>
                                                                                            <?php
                                                                                            }
                                                                                            ?>
                                                                                        </select>
                                                                                    </div>

                                                                                    <div class="form-group">
                                                                                        <label for="po_num">Supplier GSTIN</label><span class="text-danger">*</span>
                                                                                        <input type="text" value="<?php echo $supplier_data[0]->gst_number ?>" readonly name="usupplier_gstn" required class="form-control" id="uajax_supplier_gstn" placeholder="Enter Safty/buffer stock" aria-describedby="emailHelp">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="po_num">Payment Terms </label><span class="text-danger">*</span>
                                                                                        <input type="text" value="<?php echo $supplier_data[0]->payment_terms ?>" name="upayment_term" readonly required class="form-control" id="uajax_payment_terms" placeholder="Enter Safty/buffer stock" aria-describedby="emailHelp">
                                                                                    </div>


                                                                                    <div class="form-group">
                                                                                        <label for="po_num">Contact Person</label><span class="text-danger">*</span>
                                                                                        <input type="text" readonly value="<?php echo $client_list[0]->contact_person ?>/<?php echo $client_list[0]->phone_no ?>" name="ucontact_person" required class="form-control" id="exampleInputEmail1" placeholder="Enter Safty/buffer stock" aria-describedby="emailHelp">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="po_num">Billing address </label><span class="text-danger">*</span>
                                                                                        <input type="text" name="ub_address" readonly value="<?php echo $client_list[0]->billing_address ?>" required class=" form-control" id="exampleInputEmail1" placeholder="Enter Safty/buffer stock" aria-describedby="emailHelp">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="po_num">Shipping Address</label><span class="text-danger">*</span>
                                                                                        <input type="text" name="us_address" readonly value="<?php echo $client_list[0]->shifting_address ?>" required class="form-control" id="exampleInputEmail1" placeholder="Enter Safty/buffer stock" aria-describedby="emailHelp">
                                                                                    </div>


                                                                                    <div class="form-group">
                                                                                        <label for="po_num">Quantity</label><span class="text-danger">*</span>
                                                                                        <input type="text" value="<?php echo $po->quantity ?>" name="uquantity" required class="form-control" id="exampleInputEmail1" placeholder="Enter Safty/buffer stock" aria-describedby="emailHelp">
                                                                                    </div>


                                                                                </div>
                                                                                <div class="col-lg-4">

                                                                                    <div class="form-group">
                                                                                        <label for="po_num">PO Validity Date</label><span class="text-danger">*</span>
                                                                                        <input type="text" value="<?php echo $po->po_validity_date ?>" name="upo_v_date" required class="form-control" id="exampleInputEmail1" placeholder="Enter Safty/buffer stock" aria-describedby="emailHelp">
                                                                                    </div>

                                                                                    <div class="form-group">
                                                                                        <label> UOM List </label><span class="text-danger">*</span>
                                                                                        <select class="form-control select2" name="uuom_id" style="width: 100%;">
                                                                                            <?php
                                                                                            foreach ($uom as $c2) {
                                                                                            ?>
                                                                                                <option <?php
                                                                                                        if ($c2->id == $po->uom_id) {
                                                                                                            echo " selected ";
                                                                                                        } else {
                                                                                                            echo " ";
                                                                                                        } ?> value="<?php echo $c2->id; ?>"><?php echo $c2->uom_name; ?></option>
                                                                                            <?php
                                                                                            }
                                                                                            ?>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label> Part Type</label><span class="text-danger">*</span>
                                                                                        <select class="form-control select2" name="upart_type" style="width: 100%;">

                                                                                            <?php
                                                                                            foreach ($part_type_list as $c3) {
                                                                                            ?>
                                                                                                <option <?php
                                                                                                        if ($c3->id == $po->part_type_id) {
                                                                                                            echo " selected ";
                                                                                                        } else {
                                                                                                            echo " ";
                                                                                                        } ?> value="<?php echo $c3->id; ?>"><?php echo $c3->part_type_name; ?></option>
                                                                                            <?php
                                                                                            }
                                                                                            ?>
                                                                                        </select>
                                                                                    </div>

                                                                                    <div class="form-group">
                                                                                        <label>Shipping Method </label><span class="text-danger">*</span>
                                                                                        <select class="form-control select2" name="ushipping" style="width: 100%;">
                                                                                            <option>N/A</option>
                                                                                            <?php if ($po->shipping_method == "road") {
                                                                                            ?>
                                                                                                <option selected value="road">Road</option>
                                                                                                <option value="sea">sea</option>
                                                                                                <option value="air">air</option>

                                                                                            <?php
                                                                                            } elseif ($po->shipping_method == "sea") {
                                                                                            ?>
                                                                                                <option value="road">Road</option>
                                                                                                <option selected value="sea">sea</option>
                                                                                                <option value="air">air</option>
                                                                                            <?php
                                                                                            } else {
                                                                                            ?>
                                                                                                <option value="road">Road</option>
                                                                                                <option value="sea">sea</option>
                                                                                                <option selected value="air">air</option>
                                                                                            <?php } ?>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label> Client GSTIN </label><span class="text-danger">*</span>
                                                                                        <!-- <select class="form-control select2" name="customer_id" style="width: 100%;">
                                                                    <option>N/A</option>

                                                                    <?php
                                                                    foreach ($customer_list as $c4) {
                                                                    ?>
                                                                        <option value="<?php echo $c4->id; ?>"><?php echo $c4->gst_number; ?></option>
                                                                    <?php
                                                                    }
                                                                    ?>

                                                                </select> -->
                                                                                        <input type="text" name="uclient_gst" readonly value="<?php echo $client_list[0]->gst_number ?>" required class="form-control" id="exampleInputEmail1" placeholder="Enter Safty/buffer stock" aria-describedby="emailHelp">

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
                                                                                <button type="submit" id="disable_hus_obs" class="btn btn-primary">Save changes</button>
                                                                            </div>
                                                                        </form>
                                                                        <script>
                                                                            $(document).ready(function() {
                                                                                $('#upo_so_ajax<?php echo $i ?>').change(function() {

                                                                                    // alert("changed");
                                                                                    var so_po = $('#upo_so_ajax<?php echo $i ?>').find(":selected").val();
                                                                                    // alert(so_po);
                                                                                    var supplier_id = $('#upo_supplier_ajax').find(":selected").val();

                                                                                    if (so_po == 'n/a' ||
                                                                                        supplier_id == 'n/a') {
                                                                                        document.getElementById("disable_hus_obs").setAttribute("disabled", "true");

                                                                                    } else {
                                                                                        // document.getElementById("disable_hus_obs").setAttribute("disabled", false);
                                                                                        $('#disable_hus_obs').prop("disabled", false)

                                                                                    }
                                                                                    $.ajax({
                                                                                        url: "<?php echo base_url('') ?>get_id",
                                                                                        method: "POST",
                                                                                        data: {
                                                                                            iddd: so_po,
                                                                                        },
                                                                                        success: function(data) {
                                                                                            const obj = JSON.parse(data);
                                                                                            // alert(obj.customer_name);
                                                                                            $('#uajax_part_name<?php echo $i ?>').val(obj.part_name);
                                                                                            $('#uajax_part_rno<?php echo $i ?>').val(obj.revision_date);
                                                                                            $('#uajax_part_rdate<?php echo $i ?>').val(obj.revision_no);
                                                                                            $('#uajax_part_price<?php echo $i ?>').val(obj.price);
                                                                                        }
                                                                                    });


                                                                                });

                                                                                $('#upo_supplier_ajax').change(function() {

                                                                                    // alert("changed");
                                                                                    var so_po = $('#upo_so_ajax<?php echo $i ?>').find(":selected").val();

                                                                                    var supplier_id = $('#upo_supplier_ajax').find(":selected").val();
                                                                                    // alert(supplier_id);

                                                                                    if (so_po == 'n/a' ||
                                                                                        supplier_id == 'n/a') {
                                                                                        document.getElementById("disable_hus_obs").setAttribute("disabled", "true");

                                                                                    } else {
                                                                                        // document.getElementById("disable_hus_obs").setAttribute("disabled", false);
                                                                                        $('#disable_hus_obs').prop("disabled", false)

                                                                                    }

                                                                                    $.ajax({
                                                                                        url: "<?php echo base_url('') ?>get_id_supplier",
                                                                                        method: "POST",
                                                                                        data: {
                                                                                            idd1: supplier_id,
                                                                                        },
                                                                                        success: function(data) {
                                                                                            const obj = JSON.parse(data);
                                                                                            // alert(obj.customer_name);
                                                                                            $('#uajax_payment_terms').val(obj.payment_terms);
                                                                                            $('#uajax_supplier_gstn').val(obj.gstn);
                                                                                            // $('#ajax_part_rdate').val(obj.revision_no);
                                                                                            // $('#ajax_part_price').val(obj.price);
                                                                                        }
                                                                                    });

                                                                                });
                                                                            });
                                                                        </script>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>

                                                        <button class="btn btn-sm btn-primary ml-2 mr-0" onclick="generatePDF<?php echo $i ?>()"> <i class="far fa-file-pdf"></i></button>
                                                        <!-- <button onclick="generatePDF()">Download as PDF</button> -->

                                                        <script>
                                                            function generatePDF<?php echo $i ?>() {
                                                                // Choose the element that our invoice is rendered in.
                                                                // const element = document.getElementById("invoice");
                                                                const element = `<div id="invoice" style="padding: 20px">
      <!-- <h2>Styling Tables</h2> -->

      <table  style="width: 100%;border: 1px solid black;
        border-collapse: collapse;
        vertical-align: top; " class="fixed">
        <tr >
          <th style="text-align: center; font-size: xx-large" colspan="9">
            Purchase Order 
          </th>
          <!-- <th>Lastname</th>
          <th style="border: 1px solid black;
        border-collapse: collapse;
        vertical-align: top;"></th>
          <th style="border: 1px solid black;
        border-collapse: collapse;
        vertical-align: top;">Age</th>
          <th style="border: 1px solid black;
        border-collapse: collapse;
        vertical-align: top;">Age</th>
          <th style="border: 1px solid black;
        border-collapse: collapse;
        vertical-align: top;">Age</th>
          <th style="border: 1px solid black;
        border-collapse: collapse;
        vertical-align: top;">Age</th>
          <th style="border: 1px solid black;
        border-collapse: collapse;
        vertical-align: top;">Age</th>
          <th style="border: 1px solid black;
        border-collapse: collapse;
        vertical-align: top;">Age</th> -->
        </tr>
        <tr>
          <th style="border: 1px solid black;
        border-collapse: collapse;
        vertical-align: top;" colspan="4">To,</th>

          <th style="border: 1px solid black;
        border-collapse: collapse;
        vertical-align: top;" colspan="5">PO NO.:-:<?php echo $po->po_number ?></th>
        </tr>
        <tr>
          <col width="50px" />
          <col width="50px" />
          <col width="50px" />
          <col width="50px" />
          <col width="50px" />
          <col width="50px" />
          <col width="50px" />
          <col width="50px" />
          <col width="50px" />
          <th colspan="4">
            M/s:
            <br />
            <br />
            <br />
            TELEPHONE No:<br />
            Email:<br />
            GSTIN:
          </th>

          <td colspan="5">Date:<?php echo date('Y-m-d'); ?></td>
        </tr>
        <tr>
          <th style="border: 1px solid black;
        border-collapse: collapse;
        vertical-align: top;" colspan="4">
            Billing Address: <?php echo $client_list[0]->billing_address ?>
            <br />
            <br />
            <br />
            <br />
            <br />
            <br />
            Mob No:<?php echo $supplier_data[0]->mobile_no ?><br />
            Email:<?php echo $supplier_data[0]->email ?><br />
            GSTIN:<?php echo $supplier_data[0]->gst_number ?>
          </th>
          <th style="border: 1px solid black;
        border-collapse: collapse;
        vertical-align: top;" colspan="5">
            Shipping Address:<?php echo $client_list[0]->shipping_address ?>
            <br />
            <br />
            <br />
            <br />
            <br />
            <br />
            Mob No:<?php echo $supplier_data[0]->mobile_no ?><br />
            Email:<?php echo $supplier_data[0]->email ?><br />
            GSTIN:<?php echo $supplier_data[0]->gst_number ?>
          </th>

          <!-- <td colspan="4">Date:</td> -->
        </tr>
        <tr>
          <th style="padding:5px;border: 1px solid black;
        border-collapse: collapse;
        vertical-align: top;">Sr.no</th>
          <th style="padding:5px;border: 1px solid black;
        border-collapse: collapse;
        vertical-align: top;" colspan="3">Description Of Goods</th>

          <th style="padding:5px;border: 1px solid black;
        border-collapse: collapse;
        vertical-align: top;">HSN CODE</th>
          <th style="padding:5px;border: 1px solid black;
        border-collapse: collapse;
        vertical-align: top;">GST IN %</th>
          <th style="padding:5px;border: 1px solid black;
        border-collapse: collapse;
        vertical-align: top;">QTY In Nos</th>
          <th style="padding:5px;border: 1px solid black;
        border-collapse: collapse;
        vertical-align: top;">Rate/Unit</th>
          <th style="padding:5px;border: 1px solid black;
        border-collapse: collapse;
        vertical-align: top;">Amount In Rs</th>
        </tr>
        <tr>
          <th style="padding:5px;border: 1px solid black;
        border-collapse: collapse;
        vertical-align: top;">1</th>
          <th style="padding:5px;border: 1px solid black;
        border-collapse: collapse;
        vertical-align: top;" colspan="3"></th>

          <th style="padding:5px;border: 1px solid black;
        border-collapse: collapse;
        vertical-align: top;"></th>
          <th style="padding:5px;border: 1px solid black;
        border-collapse: collapse;
        vertical-align: top;"></th>
          <th style="padding:5px;border: 1px solid black;
        border-collapse: collapse;
        vertical-align: top;"></th>
          <th style="padding:5px;border: 1px solid black;
        border-collapse: collapse;
        vertical-align: top;"></th>
          <th style="padding:5px;border: 1px solid black;
        border-collapse: collapse;
        vertical-align: top;"></th>
        </tr>
        <tr>
          <th style="padding:5px;border: 1px solid black;
        border-collapse: collapse;
        vertical-align: top;">2</th>
          <th style="padding:5px;border: 1px solid black;
        border-collapse: collapse;
        vertical-align: top;" colspan="3"></th>

          <th style="padding:5px;border: 1px solid black;
        border-collapse: collapse;
        vertical-align: top;"></th>
          <th style="padding:5px;border: 1px solid black;
        border-collapse: collapse;
        vertical-align: top;"></th>
          <th style="padding:5px;border: 1px solid black;
        border-collapse: collapse;
        vertical-align: top;"></th>
          <th style="padding:5px;border: 1px solid black;
        border-collapse: collapse;
        vertical-align: top;"></th>
          <th style="padding:5px;border: 1px solid black;
        border-collapse: collapse;
        vertical-align: top;"></th>
        </tr>
        <tr>
          <th style="padding:5px;border: 1px solid black;
        border-collapse: collapse;
        vertical-align: top;">3</th>
          <th style="padding:5px;border: 1px solid black;
        border-collapse: collapse;
        vertical-align: top;" colspan="3"></th>

          <th style="padding:5px;border: 1px solid black;
        border-collapse: collapse;
        vertical-align: top;"></th>
          <th style="padding:5px;border: 1px solid black;
        border-collapse: collapse;
        vertical-align: top;"></th>
          <th style="padding:5px;border: 1px solid black;
        border-collapse: collapse;
        vertical-align: top;"></th>
          <th style="padding:5px;border: 1px solid black;
        border-collapse: collapse;
        vertical-align: top;"></th>
          <th style="padding:5px;border: 1px solid black;
        border-collapse: collapse;
        vertical-align: top;"></th>
        </tr>
        <tr>
          <th style="padding:5px;border: 1px solid black;
        border-collapse: collapse;
        vertical-align: top;">4</th>
          <th style="padding:5px;border: 1px solid black;
        border-collapse: collapse;
        vertical-align: top;" colspan="3"></th>

          <th style="padding:5px;border: 1px solid black;
        border-collapse: collapse;
        vertical-align: top;"></th>
          <th style="padding:5px;border: 1px solid black;
        border-collapse: collapse;
        vertical-align: top;"></th>
          <th style="padding:5px;border: 1px solid black;
        border-collapse: collapse;
        vertical-align: top;"></th>
          <th style="padding:5px;border: 1px solid black;
        border-collapse: collapse;
        vertical-align: top;"></th>
          <th style="padding:5px;border: 1px solid black;
        border-collapse: collapse;
        vertical-align: top;"></th>
        </tr>
        <tr>
          <th style="padding:5px;border: 1px solid black;
        border-collapse: collapse;
        vertical-align: top;">5</th>
          <th style="padding:5px;border: 1px solid black;
        border-collapse: collapse;
        vertical-align: top;" colspan="3"></th>

          <th style="padding:5px;border: 1px solid black;
        border-collapse: collapse;
        vertical-align: top;"></th>
          <th style="padding:5px;border: 1px solid black;
        border-collapse: collapse;
        vertical-align: top;"></th>
          <th style="padding:5px;border: 1px solid black;
        border-collapse: collapse;
        vertical-align: top;"></th>
          <th style="padding:5px;border: 1px solid black;
        border-collapse: collapse;
        vertical-align: top;"></th>
          <th style="padding:5px;border: 1px solid black;
        border-collapse: collapse;
        vertical-align: top;"></th>
        </tr>

        <tr>
          <th style="padding:5px;text-align: right;border: 1px solid black;
        border-collapse: collapse;
        vertical-align: top;" colspan="8">Total</th>
          <th style="padding:5px;border: 1px solid black;
        border-collapse: collapse;
        vertical-align: top;">0.0</th>
        </tr>
        <tr>
          <th colspan="9">
            <br />
            Note: &nbsp &nbsp &nbsp&nbsp&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
            &nbsp PDIR & MTC Required with each lot. Pls mention PO No. on
            Invoice.<br />
            G.S.T: &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
            GST @ 18% Extra. <br />
            Delivery: &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp&nbsp Door
            Delivery. <br />
            Validity: &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp 30 Days
            from date of quotation<br />
            Payment Terms : &nbsp 30 Days<br />
          </th>

          <!-- <th>Purchase Order</th> -->
        </tr>
        <tr>
          <th style="text-align: right" colspan="9">
            <br />
            <br />
            For Tulsi Hydraulics<br />
            <br />
            Sanjay Srivastava<br />
            <br />
          </th>

          <!-- <th>Purchase Order</th> -->
        </tr>
      </table>
    </div>`;
                                                                var opt = {
                                                                    margin: 1,
                                                                    filename: "myfile.pdf",
                                                                    image: {
                                                                        type: "png",
                                                                        quality: 0.9
                                                                    },
                                                                    html2canvas: {
                                                                        scale: 1
                                                                    },
                                                                    // jsPDF: { unit: "in", format: "letter", orientation: "portrait" },
                                                                };
                                                                // Choose the element and save the PDF for our user.
                                                                html2pdf().set(opt).from(element).save();
                                                            }
                                                        </script> <button type="submit" data-toggle="modal" class="btn btn-sm btn-primary ml-2 mr-0" data-target="#exampleModal4<?php echo $i ?>"> <i class="fas fa-eye"></i></button>

                                                        <div class="modal fade" id="exampleModal4<?php echo $i ?>" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Add Tool</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">



                                                                        <form action="<?php echo base_url('updatePurchaseOrder') ?>" method="POST">
                                                                            <div class="row">
                                                                                <div class="col-lg-4">

                                                                                    <div class="form-group">
                                                                                        <label for="po_num">Supplier GSTIN</label><span class="text-danger">*</span>
                                                                                        <input type="text" readonly value="<?php echo $supplier_data[0]->gst_number ?>" readonly name="usupplier_gstn" required class="form-control" id="uajax_supplier_gstn" placeholder="Enter Safty/buffer stock" aria-describedby="emailHelp">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="po_num">Payment Terms </label><span class="text-danger">*</span>
                                                                                        <input type="text" readonly value="<?php echo $supplier_data[0]->payment_terms ?>" name="upayment_term" readonly required class="form-control" id="uajax_payment_terms" placeholder="Enter Safty/buffer stock" aria-describedby="emailHelp">
                                                                                    </div>


                                                                                    <div class="form-group">
                                                                                        <label for="po_num">Contact Person</label><span class="text-danger">*</span>
                                                                                        <input type="text" readonly readonly value="<?php echo $client_list[0]->contact_person ?>/<?php echo $client_list[0]->phone_no ?>" name="ucontact_person" required class="form-control" id="exampleInputEmail1" placeholder="Enter Safty/buffer stock" aria-describedby="emailHelp">
                                                                                    </div>






                                                                                </div>
                                                                                <div class="col-lg-4">



                                                                                    <div class="form-group">
                                                                                        <label for="po_num">Billing address </label><span class="text-danger">*</span>
                                                                                        <input type="text" readonly name="ub_address" readonly value="<?php echo $client_list[0]->billing_address ?>" required class=" form-control" id="exampleInputEmail1" placeholder="Enter Safty/buffer stock" aria-describedby="emailHelp">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="po_num">Shipping Address</label><span class="text-danger">*</span>
                                                                                        <input type="text" readonly name="us_address" readonly value="<?php echo $client_list[0]->shifting_address ?>" required class="form-control" id="exampleInputEmail1" placeholder="Enter Safty/buffer stock" aria-describedby="emailHelp">
                                                                                    </div>


                                                                                    <div class="form-group">
                                                                                        <label for="po_num">PO Validity Date</label><span class="text-danger">*</span>
                                                                                        <input type="date" readonly value="<?php echo $po->po_validity_date ?>" name="upo_v_date" required class="form-control" id="exampleInputEmail1" placeholder="Enter Safty/buffer stock" aria-describedby="emailHelp">
                                                                                    </div>


                                                                                </div>
                                                                                <div class="col-lg-4">






                                                                                    <div class="form-group">
                                                                                        <label>Shipping Method </label><span class="text-danger">*</span>
                                                                                        <select class="form-control select2" readonly name="ushipping" style="width: 100%;">
                                                                                            <!-- <option>N/A</option> -->
                                                                                            <?php if ($po->shipping_method == "road") {
                                                                                            ?>
                                                                                                <option selected value="road">Road</option>


                                                                                            <?php
                                                                                            } elseif ($po->shipping_method == "sea") {
                                                                                            ?>
                                                                                                <option selected value="sea">sea</option>

                                                                                            <?php
                                                                                            } else {
                                                                                            ?>

                                                                                                <option selected value="air">air</option>
                                                                                            <?php } ?>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label> Client GSTIN </label><span class="text-danger">*</span>
                                                                                        <!-- <select class="form-control select2" name="customer_id" style="width: 100%;">
                                                                    <option>N/A</option>

                                                                    <?php
                                                                    foreach ($customer_list as $c4) {
                                                                    ?>
                                                                        <option value="<?php echo $c4->id; ?>"><?php echo $c4->gst_number; ?></option>
                                                                    <?php
                                                                    }
                                                                    ?>

                                                                </select> -->
                                                                                        <input type="text" readonly name="uclient_gst" readonly value="<?php echo $client_list[0]->gst_number ?>" required class="form-control" id="exampleInputEmail1" placeholder="Enter Safty/buffer stock" aria-describedby="emailHelp">

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
                                                                                <!-- <button type="submit" id="disable_hus_obs" class="btn btn-primary">Save changes</button> -->
                                                                            </div>
                                                                        </form>

                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <button type="submit" data-toggle="modal" class="btn btn-sm btn-danger ml-2" data-target="#exampleModal3<?php echo $i ?>"> <i class="far fa-trash-alt"></i></button>


                                                        <div class="modal fade" id="exampleModal3<?php echo $i ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <form action="<?php echo base_url('delete') ?>" method="POST">

                                                                        <div class="modal-body">

                                                                            <input value="<?php echo $po->id; ?>" name="id" type="hidden" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Machine Name">
                                                                            <input value="purchase_order" name="table_name" type="hidden" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Machine Name">

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

                                                    </td>
                                                </tr>
                                        <?php
                                                $i++;
                                            }
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <th>Sr. No.</th>
                                        <th>PO Number</th>
                                        <th>Part Number</th>
                                        <th>Part Name</th>
                                        <th>Revision Date</th>
                                        <th>Revision Number</th>
                                        <th>Part Price</th>
                                        <th>Supplier Name</th>
                                        <!-- <th>Supplier GSTN</th> -->
                                        <!-- <th>Payment Terms</th> -->
                                        <!-- <th>Conatct Person/phone Number</th> -->
                                        <!-- <th>Client GSTN</th> -->
                                        <!-- <th>Billing Address</th> -->
                                        <!-- <th>Shipping Address</th> -->
                                        <th>UOM</th>
                                        <th>Quantity</th>
                                        <th>Remarks</th>
                                        <th>Delivery Date</th>
                                        <!-- <th>PO Validty Date</th> -->
                                        <th>Part Type</th>
                                        <!-- <th>Shipping method</th> -->
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
    <!-- <script>
        function wbsfunca() {
            // alert("a");
            // var test = <?php //echo $wbs1 
                            ?>;
            // var test1 = <?php //echo $oc1 
                            ?>;
            // var test2 = <?php //echo $hus1 
                            ?>;
            // alert(test);
            var aa = document.getElementById('occ').value;
            var bb = document.getElementById('huss').value;
            var cc = document.getElementById('wbss').value;
            // alert(aa);
            if (aa == '' || bb == '' || cc == '') {
                document.getElementById("disable_hus_obs").setAttribute("disabled", "true");
            }
        }
    </script> -->
    <script>
        $(document).ready(function() {

            $('#po_so_ajax').change(function() {

                // alert("changed");

                var so_po = $('#po_so_ajax').find(":selected").val();



                $.ajax({
                    url: "<?php echo base_url('') ?>get_id",
                    method: "POST",
                    data: {
                        iddd: so_po,
                    },
                    success: function(data) {
                        const obj = JSON.parse(data);
                        // alert(obj.customer_name);
                        $('#ajax_part_name').val(obj.part_name);
                        $('#ajax_part_rno').val(obj.revision_date);
                        $('#ajax_part_rdate').val(obj.revision_no);
                        $('#ajax_part_price').val(obj.price);
                    }
                });


            });

            $('#po_supplier_ajax').change(function() {

                // alert("changed");
                var supplier_id = $('#po_supplier_ajax').find(":selected").val();
                // alert(supplier_id);

                $.ajax({
                    url: "<?php echo base_url('') ?>get_id_supplier",
                    method: "POST",
                    data: {
                        idd1: supplier_id,
                    },
                    success: function(data) {
                        const obj = JSON.parse(data);
                        // alert(obj.customer_name);
                        $('#ajax_payment_terms').val(obj.payment_terms);
                        $('#ajax_supplier_gstn').val(obj.gstn);
                        // $('#ajax_part_rdate').val(obj.revision_no);
                        // $('#ajax_part_price').val(obj.price);
                    }
                });

            });


            // $('#upo_so_ajax').change(function() {

            //     // alert("changed");
            //     var so_po = $('#upo_so_ajax').find(":selected").val();
            //      //alert(so_po);

            //     $.ajax({
            //         url: "<?php echo base_url('') ?>get_id",
            //         method: "POST",
            //         data: {
            //             iddd: so_po,
            //         },
            //         success: function(data) {
            //             const obj = JSON.parse(data);
            //              alert(obj.customer_name);
            //             $('#ucustomer_name_so').val(obj.customer_name);
            //             $('#upayment_terms').val(obj.payment_terms);
            //             $('#uadvance_amountt').val(obj.advance_amount);
            //         }
            //     });

            // });

        });



        // function myFunction() {
        //     var invoice_amt = document.getElementById("Invoice_amt1").value;
        //     var tds_amount = document.getElementById("tds_amount1").value;

        //     var less_tds = invoice_amt - tds_amount;
        //     document.getElementById("less_tds_amount1").value = less_tds;
        // }

        // function statementBooking() {
        //     var advance = document.getElementById("advance_amountt1").value;
        //     var less_tds = document.getElementById("less_tds_amount1").value;
        //     var stv_amt = document.getElementById("stv_amount1").value;
        //     var amount = less_tds - advance - stv_amt;
        //     // alert(amount);
        //     document.getElementById("statement_of_booking1").value = amount;

        // }

        // function addDays(date, days) {
        //     var result = new Date(date);
        //     alert(result);
        //     result.setDate(result.getDate() + days);
        //     var datee = result.getDate();

        //     return result;
        // }


        // function mkPayment() {

        //     //  alert("sda");
        //     var invoice_date = document.getElementById("invoice_date1").value;
        //     var paymentTerms = parseInt(document.getElementById("payment_terms1").value);
        //     //alert(invoice_date);
        //     var d = new Date(invoice_date);
        //     // alert(d);
        //     d.setDate(d.getDate() + paymentTerms);
        //     // document.getElementById("demo").innerHTML = d;
        //     // var convert = addDays(invoice_date, paymentTerms);
        //     // var convert = date.addDays(paymentTerms);
        //     // var my = d.split(' ')[0];
        //     var x = String(d);
        //     x = x.slice(4, 16)
        //     document.getElementById("payment_due_date_mk1").value = x;

        // }
    </script>