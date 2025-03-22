<div style="width:100%" class="wrapper">
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
                            <li class="breadcrumb-item active">subcon supplier-challan part stock report</li>
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
                       <div class="card">
                            <div class="card-header">
                                <form action="<?php echo base_url('subcon_supplier_challan_part_report') ?>" method="POST">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label for="">Select Part Number / Description</label>
                                            <select name="selected_customer_part_number" required id="" class="form-control select2">
                                                <option <?php
                                                        if ($selected_customer_part_number ==  0) {
                                                            echo "selected";
                                                        }
                                                        ?> value="0">NA</option>
                                                <?php
                                                if ($customer_parts_data) {
                                                    foreach ($customer_parts_data as $c) {

                                                ?>
                                                        <option <?php
                                                                if ($selected_customer_part_number ==  $c->part_number) {
                                                                    echo "selected";
                                                                }
                                                                ?> value="<?php echo $c->part_number; ?>"><?php echo $c->part_number . " / " . $c->part_description; ?></option>
                                                <?php

                                                    }
                                                }
                                                ?>
                                            </select>

                                        </div>
                                        <div class="col-lg-4">
                                            <label for="">Select Supplier</label>
                                            <select name="selected_supplier_id" required class="form-control select2">
                                                <option <?php
                                                        if ($selected_supplier_id ==  0) {
                                                            echo "selected";
                                                        }
                                                        ?> value="0">NA</option>
                                                <?php
                                                if ($supplier) {
                                                    foreach ($supplier as $c) {
                                                ?>
                                                        <option <?php
                                                                if ($selected_supplier_id ==  $c->id) {
                                                                    echo "selected";
                                                                }
                                                                ?> value="<?php echo $c->id; ?>"><?php echo $c->supplier_name; ?></option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-group mt-1">
                                                <button class="btn btn-danger mt-4">
                                                    Search
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                                </form>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sr.No.</th>
                                            <th>Supplier</th>
                                            <th>Child Part</th>
                                            <th>Challan No</th>
                                            <th>Challan Date</th>
                                            <th>Aging Date</th>
                                            <th>Challan Qty</th>
                                            <th>Remaning qty</th>
                                            <th>Process</th>
                                            <th>Value (Challan Qty)</th>
                                            <th>Value (Remaining Qty)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $main_total = 0;
                                        $main_total_2 = 0;
                                        $i = 1;
                                        if ($challan_parts) {
                                            foreach ($challan_parts as $c) {
                                                $current_stock = "";
                                                $type = "";

                                                $child_part_data = $this->Crud->get_data_by_id("child_part", $c->part_id, "id");
                                                $customer_data = $this->Crud->get_data_by_id("customer", $c->customer_id, "id");
                                                $challan_data = $this->Crud->get_data_by_id("challan", $c->challan_id, "id");
                                                $challan_number = $challan_data[0]->challan_number;
                                                $created_date = $challan_data[0]->created_date;
                                                $supplier_id = $challan_data[0]->supplier_id;
                                                $supplier_data = $this->Crud->get_data_by_id("supplier", $supplier_id, "id");

                                                $date1 = date_create(date('Y-m-d'));
                                                $date2 = date_create($challan_data[0]->created_date);
                                                $diff = date_diff($date1, $date2);
                                                $aging = $diff->format("%R%a");
                                                $array_main = array(
                                                    "supplier_id" => $supplier_id,
                                                    "child_part_id" => $c->part_id,
                                                );
                                                $value_qty = 0;
                                                $value_qty_remaning = 0;
                                                $child_part_master_data = $this->Crud->get_data_by_id_multiple_condition("child_part_master", $array_main);
                                                if ($child_part_master_data) {
                                                    $value_qty = $c->qty * $child_part_master_data[0]->part_rate;
                                                    $value_qty_remaning = $c->remaning_qty * $child_part_master_data[0]->part_rate;
                                                }
                                                $main_total = $main_total + $value_qty;
                                                $main_total_2 = $main_total_2 + $value_qty_remaning;
                                                $show="no";
                                                if(!empty($selected_customer_part_number))
                                                {
                                                    if($child_part_data[0]->part_number == $selected_customer_part_number)
                                                    {
                                                        $show="yes";
                                                    }
                                                }
                                                else if(!empty($selected_supplier_id))
                                                {
                                                    if($supplier_data[0]->id == $selected_supplier_id)
                                                    {
                                                        $show="yes";
                                                    }
                                                }
                                                else
                                                {
                                                    $show="yes";
                                                }
                                                // echo $show;
                                                if( $show == "yes")
                                                {

                                        ?>

                                                <tr>
                                                    <td><?php echo $i ?></td>
                                                    <td><?php echo $supplier_data[0]->supplier_name; ?></td>
                                                    <td><?php echo $child_part_data[0]->part_number . " " . $child_part_data[0]->part_description ?></td>
                                                    <td><?php echo $challan_number ?></td>
                                                    <td><?php echo $created_date ?></td>
                                                    <td><?php echo $aging ?></td>
                                                    <td><?php echo $c->qty ?></td>
                                                    <td><?php echo $c->remaning_qty ?></td>
                                                    <td><?php echo $c->process ?></td>
                                                    <td><?php echo $value_qty ?></td>
                                                    <td><?php echo $value_qty_remaning ?></td>
                                                </tr>
                                        <?php
                                                $i++;
                                                }
                                            }
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="9">Total</td>
                                            <td colspan=""><?php echo $main_total; ?></td>
                                            <td colspan=""><?php echo $main_total_2; ?></td>
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