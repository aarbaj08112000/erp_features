<div style="width:1800px" class="wrapper">
    <!-- Navbar -->

    <!-- /.navbar -->

    <!-- Main Sidebar Container -->

    <?php

    $arr = array(
        'inwarding_id' => $inwarding_data[0]->id,
        'invoice_number' => $inwarding_data[0]->invoice_number,

    );

    $invoice_amount = $inwarding_data[0]->invoice_amount;
    // $inwarding_data = $this->Crud->get_data_by_id_multiple("inwarding", $arr);
    $grn_details_data_main = $this->Crud->get_data_by_id_multiple("grn_details", $arr);

    $actual_price = 0;
    foreach ($grn_details_data_main as $g) {
        $actual_price = $actual_price + $g->inwarding_price;
    }



    // $cgst_amount = ($actual_price*$gst_structure[0]->cgst)/100;
    // $sgst_amount = ($actual_price*$gst_structure[0]->sgst)/100;
    // $igst_amount = ($actual_price*$gst_structure[0]->igst)/100;

    // $actual_price = $actual_price + $cgst_amount +$sgst_amount+$igst_amount;
    $minus_price = $actual_price - 1;
    $plus_price = $actual_price + 1;

    if ($actual_price != 0) {

        if ($invoice_amount >= $minus_price) {
            if ($invoice_amount <= $plus_price) {
                $status = "verifed";
            } else {
                $status = "not-verifed";
            }
        } else {
            $status = "not-verifed";
        }
    } else {
        $status = "not-verifed";
    }
    ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Select Challan Number</h1>


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

                                <a class="btn btn-danger" href="<?php echo base_url('view_new_sales_by_id_subcon/') . $this->uri->segment('3'); ?>">
                                    < Back</a>


                            </div>










                            <div class="card-body">
                                <table class="table table-bordered table-striped" id="example1">
                                    <thead>

                                        <tr>
                                            <th>Sr No</th>
                                            <th>Part Number</th>
                                            <th>Part Description</th>
                                            <th>UOM</th>
                                            <th>QTY</th>
                                            <th>Balance QTY</th>
                                            <th>Input / Challan Part Details</th>




                                        </tr>

                                    </thead>


                                    <tbody>

                                        <?php
                                        if ($sales_parts_subcon_data) {
                                            $final_po_amount = 0;
                                            $i = 1;
                                            foreach ($sales_parts_subcon_data as $p) {

                                                $child_part_data = $this->Crud->get_data_by_id("customer_part", $p->part_id, "id");
                                                $gst_structure_data = $this->Crud->get_data_by_id("gst_structure", $p->tax_id, "id");
                                                $routing = $this->Crud->get_data_by_id("routing_subcon", $p->part_id, "part_id");
                                                $uom_data = $this->Crud->get_data_by_id("uom", $child_part_data[0]->uom_id, "id");
                                                $subcon_bom = $this->Crud->get_data_by_id("subcon_bom", $p->part_id, "customer_part_id");

                                                // echo $p->part_id;
                                                $total_rate = $child_part_data[0]->part_rate * $p->qty;
                                                $final_po_amount = $final_po_amount + $total_rate;

                                                // print_r($subcon_bom);



                                        ?>

                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $child_part_data[0]->part_number; ?></td>
                                                    <td><?php echo $child_part_data[0]->part_description; ?></td>
                                                    <td><?php echo $child_part_data[0]->uom; ?></td>
                                                    <td><?php echo $p->qty; ?></td>
                                                    <td><?php echo $p->pending_qty; ?></td>
                                                    <td>
                                                        <table>
                                                            <tr>
                                                                <th>Sr No</th>
                                                                <th>Name / Description</th>
                                                                <th>Required Qty</th>
                                                                <th>Received Qty</th>
                                                                <th>Select Challan / Available Qty</th>
                                                                <th>Submit</th>
                                                                <!-- <th>History</th> -->
                                                            </tr>

                                                            <?php
                                                            $ro = 1;
                                                            $completed = 0;
                                                            if ($subcon_bom) {
                                                                // $subcon_po_inwarding_parts = $this->Crud->get_data_by_id("subcon_po_inwarding_parts", $subcon_po_inwarding_master[0]->id, "subcon_po_inwarding_id");

                                                                foreach ($subcon_bom as $r) {
                                                                    $child_part_new_new = $this->Crud->get_data_by_id("child_part", $r->child_part_id, "id");
                                                                    if ($child_part_new_new) {
                                                                        // $subcon_po_inwarding_parts = $this->Crud->get_data_by_id("challan_parts", $subcon_po_inwarding_master[0]->id, "subcon_po_inwarding_id");
                                                                        $challan_parts_array = array(
                                                                            'part_id' => $child_part_new_new[0]->id,
                                                                            'qty' => 1,

                                                                        );
                                                                        $role_management_data2 = $this->db->query('SELECT * FROM `challan_parts_subcon` WHERE part_id = ' . $child_part_new_new[0]->id . ' AND remaning_qty > 0 ');
                                                                        $challan_parts_data = $role_management_data2->result();
                                                                        // print_r($challan_parts_data);
                                                                        // print_r($challan_parts_data2);
                                                                        // echo "<br>";
                                                                        // echo "<br>";
                                                                        // // echo 'SELECT * FROM `challan_parts` WHERE part_id='.$child_part_new_new[0]->id.' AND qty > "0"';
                                                                        // $challan_parts_data = $this->Crud->get_data_by_id_multiple("challan_parts", $challan_parts_array);
                                                                        // print_r($challan_parts_data);
                                                                        // echo "<br>";
                                                                        // echo "<br>";
                                                                        $required_qty =
                                                                        $p->qty* $r->quantity;
                                                                        $received_qty = 0;

                                                            ?>
                                                                        <tr>
                                                                            <form method="post" action="<?php echo base_url('add_challan_parts_history_subcon'); ?>">
                                                                                <td><?php echo $child_part_new_new[0]->id; ?></td>
                                                                                <td><?php echo $child_part_new_new[0]->part_number . " / " . $child_part_new_new[0]->part_description; ?></td>
                                                                                <td><?php echo $required_qty; ?>
                                                                                    <input type="hidden" name="required_qty" value="<?php echo $required_qty; ?>">
                                                                                </td>
                                                                                <td><?php echo $received_qty; ?></td>
                                                                                <td>
                                                                                    <select name="challan_id" id="" class="select2 form-control">
                                                                                        <?php
                                                                                        if ($challan_parts_data) {
                                                                                            foreach ($challan_parts_data as $ch_parts) {
                                                                                                $challan_data = $this->Crud->get_data_by_id("challan_subcon", $ch_parts->challan_id, "id");
                                                                                                $arr = array(
                                                                                                    'id' => $ch_parts->challan_id,
                                                                                                    'customer_id' => $p->customer_id,

                                                                                                );

                                                                                                $invoice_amount = $inwarding_data[0]->invoice_amount;
                                                                                                // $inwarding_data = $this->Crud->get_data_by_id_multiple("inwarding", $arr);
                                                                                                $grn_details_data = $this->Crud->get_data_by_id_multiple("challan_subcon", $arr);



                                                                                                if ($challan_data) {
                                                                                                    foreach ($challan_data as $c_d) {
                                                                                        ?>
                                                                                                        <option value="<?php echo $c_d->id ?>"><?php echo $c_d->challan_number . " / " . $ch_parts->remaning_qty; ?></option>

                                                                                        <?php
                                                                                                    }
                                                                                                }
                                                                                            }
                                                                                        }
                                                                                        ?>
                                                                                    </select>
                                                                                </td>
                                                                                <td>

                                                                                    <input type="hidden" name="part_id" value="<?php echo $child_part_new_new[0]->id; ?>">
                                                                                    <input type="hidden" name="subcon_po_inwarding_parts_id" value="<?php echo $r->id; ?>">
                                                                                    <input type="hidden" name="req_qty" value="<?php echo $r->input_part_req_qty ?>">
                                                                                    <input type="hidden" name="rec_qty" value="<?php echo $r->recevied_req_qty ?>">
                                                                                    <input type="hidden" name="grn_number" value="<?php echo $inwarding_data[0]->grn_number; ?>">
                                                                                    <input type="hidden" name="invoice_number" value="<?php echo $inwarding_data[0]->invoice_number ?>">
                                                                                    <input type="hidden" name="po_id" value="<?php echo $new_po[0]->id; ?>">

                                                                                    <?php
                                                                                    if (false && $r->recevied_req_qty == $r->input_part_req_qty) {
                                                                                        $completed++;
                                                                                        echo "inwarding added";
                                                                                    } else {
                                                                                    ?>

                                                                                        <button type="submit" class="btn btn-info">Submit</button>

                                                                                    <?php

                                                                                    }
                                                                                    ?>

                                                                                </td>
                                                                                <th>
                                                                                    <!-- <a class="btn btn-danger" href="<?php echo base_url('subcon_po_inwarding_history/') . $r->id ?>">History</a> -->
                                                                                </th>
                                                                            </form>

                                                                        </tr>
                                                            <?php
                                                                        $ro++;
                                                                    } else {
                                                                        echo "Part Not Found";
                                                                    }
                                                                }
                                                            }
                                                            ?>



                                                        </table>
                                                    </td>






                                                </tr>
                                                <?php

                                                ?>


                                        <?php
                                                $i++;
                                            }
                                        }

                                        ?>



                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="6"></th>
                                            <th colspan="" class="text-right">
                                                <!-- <form action="<?php echo base_url('') ?>"> -->
                                                <form action="<?php echo base_url('add_grn_qty') ?>" method="post">

                                                    <!-- <button type="submit" class="btn btn-primary">
                                                            Complete Challan Process
                                                        </button> -->
                                                    <?php
                                                    // print_r($inwarding_data);
                                                    $part_rate_new = 0;
                                                    if (empty($po_parts[0]->rate)) {
                                                        $part_rate_new = $child_part_data[0]->part_rate;
                                                    } else {
                                                        $part_rate_new = $p->rate;
                                                    }
                                                    ?>
                                                    <input type="hidden" required step="any" value="<?php echo $subcon_po_inwarding_master[0]->inwarding_qty ?>" placeholder="$po_parts[0]->qty;" name="qty" class="form-control">
                                                    <input type="hidden" name="inwarding_id" value="<?php echo $inwarding_data[0]->id ?>" placeholder="98771231236" class="form-control">
                                                    <input type="hidden" placeholder="Enter Inwarding Qty" name="new_po_id" value="<?php echo $new_po_id ?>" class="form-control">
                                                    <input type="hidden" placeholder="Enter Inwarding Qty" name="part_id" value="<?php echo $po_parts[0]->part_id ?>" class="form-control">
                                                    <input type="hidden" placeholder="Enter Inwarding Qty" name="invoice_number" value="<?php echo $inwarding_data[0]->invoice_number ?>" class="form-control">
                                                    <input type="hidden" placeholder="Enter Inwarding Qty" name="grn_number" value="<?php echo $inwarding_data[0]->grn_number ?>" class="form-control">
                                                    <input type="hidden" placeholder="Enter Inwarding Qty" name="po_part_id" value="<?php echo $po_parts[0]->id ?>" class="form-control">
                                                    <input type="hidden" placeholder="Enter Inwarding Qty" name="pending_qty" value="<?php echo $po_parts[0]->pending_qty ?>" class="form-control">
                                                    <input type="hidden" placeholder="Enter Inwarding Qty342" name="part_rate" value="<?php echo $part_rate_new ?>" class="form-control">
                                                    <input type="hidden" placeholder="Enter Inwarding Qty" name="tax_id" value="<?php echo $po_parts[0]->tax_id ?>" class="form-control">
                                                    <?php
                                                    // echo $ro-1;
                                                    // echo "<br>";
                                                    // echo $completed;
                                                    if (($ro - 1) == $completed) {
                                                    ?>
                                                        <button type="submit" class="btn btn-primary">
                                                        Complete Challan Process
                                                        </button>
                                                    <?php

                                                    }
                                                    ?>

                                                </form>
                                            </th>
                                        </tr>
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