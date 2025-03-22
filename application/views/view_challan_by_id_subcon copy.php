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
                        <a href="<?php echo base_url('view_add_challan_subcon') ?>" class="btn btn-danger">
                            < Back </a>

                                <?php
                                $expired = "no";
                                if ($new_po[0]->expiry_po_date > date('Y-m-d')) {
                                    $expired =  "yes";
                                } else {
                                    // echo "no";
                                }
                                ?>



                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('generate_po') ?>">Home</a></li>
                            <li class="breadcrumb-item active"></li>
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

                                <!-- <div class="row">
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <button onclick="functionTest()" class="btn btn-danger mt-4">Download All
                                                Invoice </button>
                                        </div>

                                        <script>
                                            function functionTest() {
                                                setTimeout(function() {
                                                    document.getElementById("orignalInvoice").click();
                                                }, 1000);
                                                setTimeout(function() {
                                                    document.getElementById("duplicateInvoice").click();
                                                }, 2000);
                                                setTimeout(function() {
                                                    document.getElementById("triplicateInvoice").click();
                                                }, 3000);
                                                setTimeout(function() {
                                                    document.getElementById("ackInvoice").click();
                                                }, 4000);
                                                setTimeout(function() {
                                                    document.getElementById("extraaInvoice").click();
                                                }, 5000);

                                                // document.getElementById("triplicateInvoice").click();
                                                // document.getElementById("ackInvoice").click();
                                                // document.getElementById("extraaInvoice").click();
                                            }
                                        </script>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <a id="orignalInvoice" class="btn btn-success mt-4" href="<?php echo base_url('view_challan_pdf/') . $this->uri->segment('2') . "/ORIGINAL_FOR_RECIPIENT"; ?>">Original
                                                Invoice </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <a id="duplicateInvoice" class="btn btn-success mt-4" href="<?php echo base_url('view_challan_pdf/') . $this->uri->segment('2') . '/DUPLICATE_FOR_TRANSPORTER'; ?>">Duplicate
                                                Invoice </a>
                                        </div>
                                    </div>

                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <a id="triplicateInvoice" class="btn btn-success mt-4" href="<?php echo base_url('view_challan_pdf/') . $this->uri->segment('2') . "/TRIPLICATE_FOR_SUPPLIER"; ?>">Triplicate
                                                Invoice </a>
                                        </div>
                                    </div>


                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <a id="ackInvoice" class="btn btn-success mt-4" href="<?php echo base_url('view_challan_pdf/') . $this->uri->segment('2') . "/ACKNOWLEDGEMENT_COPY"; ?>">Acknowledge.
                                                Invoice </a>
                                        </div>
                                    </div>

                                    <div>
                                        &nbsp;
                                    </div>

                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <a id="extraaInvoice" class="btn btn-success mt-4" href="<?php echo base_url('view_challan_pdf/') . $this->uri->segment('2') . "/EXTRA_COPY"; ?>">Extra
                                                Invoice </a>
                                        </div>
                                    </div>

                                </div> -->
                            </div>
                            <div class="card-header">

                                <div class="row">
                                    <div class="col-lg-2">
                                        <div class="form-group">

                                            <label for="">Challan Number <span class="text-danger">*</span> </label>
                                            <input type="text" readonly value="<?php echo $challan_data[0]->challan_number ?>" class="form-control">


                                        </div>




                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">

                                            <label for="">Customer Name <span class="text-danger">*</span> </label>
                                            <input type="text" readonly value="<?php echo $customer[0]->customer_name; ?>" class="form-control">


                                        </div>




                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">

                                            <label for="">Challan Date & Time <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" readonly value="<?php echo $challan_data[0]->created_date . " / " . $challan_data[0]->created_time ?>" class="form-control">


                                        </div>




                                    </div>

                                    <div class="col-lg-2">

                                        <?php
                                        if ($challan_data[0]->status != "completed") {
                                        ?>
                                            <button type="submit" data-toggle="modal" class="btn btn-sm btn-dark mt-4" data-target="#challanCOmplete">
                                                Complete Challan
                                            </button>
                                        <?php
                                        }
                                        ?>


                                        <div class="modal fade" id="challanCOmplete" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Change Status Of
                                                            Challan </h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <form action="<?php echo base_url('change_challan_status_subcon') ?>" method="POST">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="form-group">
                                                                        <label for="payment_terms">Are You Sure Want To
                                                                            Complete This Challan ? </label><span class="text-danger">*</span>
                                                                        <input type="hidden" value="<?php echo $this->uri->segment('2') ?>" name="challan_id" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Bank Details">
                                                                    </div>
                                                                </div>

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

                                </div>

                            </div>
                            <div class="card-header">

                                <div class="row">
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <form action="<?php echo base_url('add_challan_parts_subcon'); ?>" method="post">
                                                <label for="">Select Part Number // Description // Current Stock<span class="text-danger">*</span> </label>

                                                <select name="part_id" id="" required class="form-control select2">
                                                    <?php
                                                    if ($challan_data[0]->status == "completed") {
                                                        echo "Challan Completed";
                                                    } else {
                                                    ?>
                                                        <?php

                                                        if ($child_part) {
                                                            foreach ($child_part as $c) {
                                                                if ($c->sub_type != "customer_bom") {
                                                                    $child_part_data = $this->Crud->get_data_by_id("child_part", $c->part_number, "part_number");


                                                        ?>
                                                                    <option value="<?php echo $c->id ?>">
                                                                        <?php echo  $c->part_number . " // " . $c->part_description . "/ " . $child_part_data[0]->stock ?>
                                                                    </option>
                                                        <?php
                                                                }
                                                            }
                                                        }

                                                        ?>

                                                    <?php
                                                    }
                                                    ?>



                                                </select>


                                        </div>


                                    </div>


                                    <div class="col-lg-2">
                                        <div class="form-group">

                                            <label for="">Enter input Qty <span class="text-danger">*</span> </label>
                                            <input type="number" step="any" name="qty" placeholder="Enter QTY " required class="form-control">
                                            <input type="hidden" name="challan_id" value="<?php echo $challan_data[0]->id ?>" required class="form-control">


                                        </div>


                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Select Process <span class="text-danger">*</span> </label>
                                            <select name="process" required id="" class="form-control select2">
                                                <?php
                                                if ($process) {
                                                    foreach ($process as $s) {
                                                ?>
                                                        <option value="<?php echo $s->name; ?>"><?php echo $s->name; ?></option>
                                                <?php

                                                    }
                                                }

                                                ?>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <?php
                                            if ($challan_data[0]->status == "completed") {
                                                echo "Challan Completed";
                                            } else {
                                            ?>
                                                <button type="submit" class="btn btn-info btn-lg mt-4">Add Part TO
                                                    challan</button>

                                            <?php
                                            }
                                            ?>

                                        </div>


                                    </div>

                                    </form>

                                </div>


                            </div>
                            <div class="card-header">
                                <?php if ($po_parts) {
                                    if ($new_po[0]->status == "pending") {

                                        if ($this->session->userdata['type'] == 'admin' || $this->session->userdata['type'] == 'Admin') {
                                ?>
                                            <button type="button" class="btn btn-danger ml-1" data-toggle="modal" data-target="#lock">
                                                Lock PO
                                            </button>
                                <?php }
                                    }
                                } ?>
                                <?php if ($new_po[0]->status == "lock") {
                                    if ($this->session->userdata['type'] == 'admin' || $this->session->userdata['type'] == 'Admin') {
                                ?>
                                        <button type="button" class="btn btn-success ml-1" data-toggle="modal" data-target="#accpet">
                                            Accept (Released) PO
                                        </button>
                                        <button type="button" class="btn btn-danger ml-1" data-toggle="modal" data-target="#delete">
                                            Reject (delete) PO
                                        </button>
                                    <?php
                                    }
                                } else {
                                    if ($new_po[0]->status != "pending") {
                                    ?>

                                        <!-- <button type="button" disabled class="btn btn-success ml-1" data-toggle="modal" data-target="#accpet">
                                                                                        PO Already Released
                                                                                </button> -->

                                        <!-- <a href="<?php echo base_url('download_my_pdf/') . $new_po[0]->id ?>" class="btn btn-primary" href="">Download</a> -->

                                <?php
                                    }
                                } ?>
                                <!-- Modal -->
                                <div class="modal fade" id="accpet" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Update</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                                <div class="row">
                                                    <form action="<?php echo base_url('accept_po_sub'); ?>" method="POST">

                                                        <div class="col-lg-12">
                                                            <div class="form-group">

                                                                <label for=""><b>Are You Sure Want To Released This
                                                                        PO?</b> </label>
                                                                <input type="hidden" name="id" value="<?php echo $new_po[0]->id ?>" required class="form-control">
                                                                <input type="hidden" name="status" value="accpet" required class="form-control">


                                                            </div>


                                                        </div>


                                                </div>






                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Update</button>

                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="modal fade" id="lock" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Update</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                                <div class="row">
                                                    <form action="<?php echo base_url('accept_po_sub'); ?>" method="POST">

                                                        <div class="col-lg-12">
                                                            <div class="form-group">

                                                                <label for=""><b>Are You Sure Want To Lock This PO?</b>
                                                                </label>
                                                                <input type="hidden" name="id" value="<?php echo $new_po[0]->id ?>" required class="form-control">
                                                                <input type="hidden" name="status" value="lock" required class="form-control">


                                                            </div>


                                                        </div>


                                                </div>






                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Update</button>

                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="modal fade" id="delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                                <div class="row">
                                                    <form action="<?php echo base_url('delete_po'); ?>" method="POST">

                                                        <div class="col-lg-12">
                                                            <div class="form-group">

                                                                <label for=""><b>Are You Sure Want To Delete This
                                                                        PO?</b> </label>
                                                                <input type="hidden" name="id" value="<?php echo $new_po[0]->id ?>" required class="form-control">
                                                                <input type="hidden" name="status" value="reject" required class="form-control">
                                                                <input type="hidden" name="table_name" value="new_po_sub" required class="form-control">


                                                            </div>


                                                        </div>


                                                </div>






                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Update</button>

                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>




                            </div>








                            <div class="card-body">
                                <table class="table table-bordered table-striped" id="example1">
                                    <thead>

                                        <tr>
                                            <th>Sr No</th>
                                            <th>Part Number</th>
                                            <th>Part Description</th>
                                            <th>Qty </th>
                                            <th>Process</th>
                                            <th>HSN</th>
                                            <th>Value</th>
                                            <th>Remaining Qty </th>
                                            <th>Edit / Delete</th>
                                            <th>Action</th>
                                            <th>History</th>
                                        </tr>

                                    </thead>


                                    <tbody>

                                        <?php
                                        if ($challan_parts) {
                                            $final_po_amount = 0;
                                            $i = 1;
                                            foreach ($challan_parts as $p) {
                                                $child_part_data = $this->Crud->get_data_by_id("child_part", $p->part_id, "id");

                                                $data2 = array(
                                                    'challan_id' => $this->uri->segment('2'),
                                                    'part_id' => $p->part_id,

                                                );
                                                // print_r($challan_parts_his`tory_data);


                                                $challan_parts_history_data = $this->Crud->get_data_by_id_multiple_condition("challan_parts_history", $data2);

                                        ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $child_part_data[0]->part_number; ?></td>
                                                    <td><?php echo $child_part_data[0]->part_description; ?></td>
                                                    <td><?php echo $p->qty; ?></td>
                                                    <td><?php echo $p->process; ?></td>
                                                    <td><?php echo $p->hsn; ?></td>
                                                    <td><?php echo $p->value; ?></td>
                                                    <td><?php echo $p->remaning_qty; ?></td>
                                                    <td>
                                                        <?php
                                                        if ($challan_data[0]->status != "completed") {
                                                        ?>
                                                            <!-- Button trigger modal -->
                                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModa123123123123l<?php echo $i; ?>">
                                                                Edit
                                                            </button>

                                                            <button type="button" class="btn btn-danger ml-1" data-toggle="modal" data-target="#exampleModaldelet213123e<?php echo $i; ?>">
                                                                Delete
                                                            </button>

                                                            <!-- Modal -->
                                                            <div class="modal fade" id="exampleModa123123123123l<?php echo $i; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">Update
                                                                            </h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">

                                                                            <div class="row">



                                                                                <div class="col-lg-12">
                                                                                    <div class="form-group">
                                                                                        <form action="<?php echo base_url('update_challan_parts_subcon'); ?>" method="POST">

                                                                                            <label for="">Enter Qty <span class="text-danger">*</span>
                                                                                            </label>
                                                                                            <input type="number" name="qty" value="<?php echo $p->qty ?>" placeholder="Enter QTY " required class="form-control">
                                                                                            <input type="hidden" name="id" value="<?php echo $p->id ?>" placeholder="Enter QTY " required class="form-control">


                                                                                    </div>


                                                                                </div>

                                                                            </div>






                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                            <button type="submit" class="btn btn-primary">Update</button>

                                                                        </div>
                                                                    </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                            <!-- Modal -->
                                                            <div class="modal fade" id="exampleModaldelet213123e<?php echo $i; ?>" tabindex="-1" aria-labelledby="" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">Delete
                                                                            </h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">

                                                                            <div class="row">
                                                                                <form action="<?php echo base_url('delete'); ?>" method="POST">

                                                                                    <div class="col-lg-12">
                                                                                        <div class="form-group">

                                                                                            <label for=""> <b>Are You Sure Want To
                                                                                                    Delete This ? </b> </label>
                                                                                            <input type="hidden" name="id" value="<?php echo $p->id ?>" required class="form-control">
                                                                                            <input type="hidden" name="table_name" value="challan_parts_subcon" required class="form-control">


                                                                                        </div>


                                                                                    </div>


                                                                            </div>






                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                            <button type="submit" class="btn btn-primary">Update</button>

                                                                        </div>
                                                                    </div>
                                                                    </form>
                                                                </div>
                                                            </div>


                                                        <?php } else {
                                                            echo "Can't Update , This  is " . $new_sales[0]->status;
                                                        }
                                                        ?>


                                                    </td>
                                                    <td>
                                                        <?php
                                                        if ($challan_parts_history_data) {
                                                            if ($challan_parts_history_data[0]->status == "completed") {
                                                                echo "Stock updated";
                                                            } else {
                                                        ?>
                                                                <button type="submit" data-toggle="modal" class="btn btn-sm btn-danger" data-target="#exampleModal2123<?php echo $i ?>">
                                                                    Accept Challan Qty
                                                                </button>
                                                            <?php
                                                            }
                                                        } else {
                                                            if ($p->remaning_qty > 1) {
                                                            ?>
                                                                <button type="submit" data-toggle="modal" class="btn btn-sm btn-primary" data-target="#exampleModal2<?php echo $i ?>">
                                                                    Challan Return Qty
                                                                </button>

                                                        <?php
                                                            }
                                                        }
                                                        ?>

                                                        <div class="modal fade" id="exampleModal2123<?php echo $i ?>" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Accept
                                                                            Qty </h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">

                                                                        <form action="<?php echo base_url('update_challan_parts_history_challan') ?>" method="POST">
                                                                            <div class="row">
                                                                                <div class="col-lg-12">
                                                                                    <div class="form-group">
                                                                                        <label for="payment_terms">Qty</label><span class="text-danger">*</span>
                                                                                        <input type="text" disabled value="<?php echo  $challan_parts_history_data[0]->qty  ?>" name="123" required class="form-control" placeholder="Supplier Challan Number">
                                                                                        <input type="hidden" value="<?php echo  $challan_parts_history_data[0]->qty  ?>" name="qty_main" required class="form-control" placeholder="Supplier Challan Number">
                                                                                        <input type="hidden" value="<?php echo  $challan_parts_history_data[0]->id  ?>" name="challan_parts_history_id" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Bank Details">
                                                                                        <input type="hidden" value="<?php echo $p->part_id;  ?>" name="part_id" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Bank Details">
                                                                                        <input type="hidden" value="<?php echo $p->challan_id;  ?>" name="challan_id" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Bank Details">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-12">
                                                                                    <div class="form-group">
                                                                                        <label for="payment_terms">Enter Accept
                                                                                            Qty</label><span class="text-danger">*</span>
                                                                                        <input type="number" max="<?php echo $challan_parts_history_data[0]->accepeted_qty; ?>" name="accepeted_qty" required class="form-control" placeholder="Enter Qty">
                                                                                    </div>
                                                                                </div>

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
                                                        <div class="modal fade" id="exampleModal2<?php echo $i ?>" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Return
                                                                            Qty </h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">

                                                                        <form action="<?php echo base_url('add_challan_parts_history_challan') ?>" method="POST">
                                                                            <div class="row">
                                                                                <div class="col-lg-12">
                                                                                    <div class="form-group">
                                                                                        <label for="payment_terms">Supplier
                                                                                            Challan Number</label><span class="text-danger">*</span>
                                                                                        <input type="text" name="supplier_challan_number" required class="form-control" placeholder="Supplier Challan Number">
                                                                                        <!-- <input type="text" value="<?php echo  $challan_parts[0]->challan_id  ?>" name="challan_id" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Bank Details"> -->
                                                                                        <input type="hidden" value="<?php echo $this->uri->segment('2') ?>" name="challan_id" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Bank Details">

                                                                                        <input type="hidden" value="<?php echo  $p->part_id  ?>" name="part_id" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Bank Details">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-12">
                                                                                    <div class="form-group">
                                                                                        <label for="payment_terms">Enter
                                                                                            Qty</label><span class="text-danger">*</span>
                                                                                        <input type="number" max="<?php echo $p->remaning_qty; ?>" min="1" name="qty" required class="form-control" placeholder="Enter Qty">
                                                                                    </div>
                                                                                </div>

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
                                                    </td>

                                                    <td>
                                                        <a class="btn btn-info" href="<?php echo base_url('view_challan_parts_history_subcon/') . $p->challan_id . "/" . $p->part_id; ?>">History</a>
                                                    </td>
                                                </tr>
                                        <?php

                                                $i++;
                                            }
                                        }

                                        ?>



                                    </tbody>

                                    <tfoot>
                                        <?php
                                        if ($po_parts) {
                                        ?>
                                            <tr>
                                                <th colspan="11">Total</th>
                                                <th><?php echo $final_po_amount; ?></th>

                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tfoot>

                                </table>

                            </div>



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