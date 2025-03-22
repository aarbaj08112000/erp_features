<?php
// Get the CodeIgniter super object
$CI = &get_instance();

// Load the model
$CI->load->model('InhouseParts');
$CI->load->model('CustomerPart');
?>
<div style="width:100%" class="wrapper">
    <!-- Navbar -->
    <!-- done new fg stock -->
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
                                <form action="<?php echo base_url('customer_part_wip_stock_report') ?>" method="POST">
                                    <div class="row">
                                        <div class="col-lg-7">
                                            <label for="">Select Part Number / Description / Customer</label>
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
                                                                ?> value="<?php echo $c->part_number; ?>"><?php echo $c->part_number . " / " . $c->part_description . " / " . $c->customer_name; ?></option>
                                                <?php

                                                    }
                                                }
                                                ?>
                                            </select>

                                        </div>

                                        <div class="col-lg-2">
                                            <div class="form-group">
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
                                            <th>Sr. No.</th>
                                            <th>Customer Name</th>
                                            <th>Customer Part Number</th>
                                            <th>item part Number</th>
                                            <th>item part Description</th>
                                            <th>Inhouse Stock</th>
                                            <th>FG Stock</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $i = 1;
                                        if ($operations_bom) {
                                            foreach ($operations_bom as $po) {
                                                $current_stock = "";
                                                $type = "";

                                                $customer_data = $this->Crud->get_data_by_id("customer", $po->customer_id, "id");
                                                // $customer_part_data = $this->Crud->get_data_by_id("customer_part", $po->customer_part_number, "id");

                                                if ($po->output_part_table_name == "inhouse_parts") {
                                                    $type = "inhouse_parts";
                                                    $output_part_data = $this->InhouseParts->getInhousePartById($po->output_part_id);
                                                    $current_stock = $output_part_data[0]->production_qty;
                                                    $uom_data = $this->Crud->get_data_by_id("uom", $output_part_data[0]->uom_id, "id");
                                                    $uom = $uom_data[0]->uom_name;
                                                } else {
                                                    $type = "customer_stock";
                                                    // echo "s";
                                                    // echo $po->output_part_id;
                                                    $output_part_data = $this->Crud->get_data_by_id("customer_part", $po->output_part_id, "id");
                                                    $customer_parts_master_data = $this->CustomerPart->getCustomerPartByPartNumber($output_part_data[0]->part_number);
                                                    // print_r($customer_parts_master_data);
                                                    $current_stock = $customer_parts_master_data[0]->fg_stock;
                                                    // $uom_data = $this->Crud->get_data_by_id("uom", $output_part_data[0]->upm, "id");
                                                    $uom = $output_part_data[0]->uom;
                                                    // print_r($output_part_data);
                                                }
                                        ?>

                                                <tr>
                                                    <td><?php echo $i ?></td>
                                                    <td><?php echo $customer_data[0]->customer_name ?></td>
                                                    <td><?php echo $po->customer_part_number ?></td>
                                                    <td><?php echo $output_part_data[0]->part_number ?></td>
                                                    <td><?php echo $output_part_data[0]->part_description ?></td>
                                                    <td><?php if ($type == "inhouse_parts") {
                                                            echo $current_stock;
                                                        }; ?></td>
                                                    <td><?php if ($type == "customer_stock") {
                                                            echo $current_stock;
                                                        }; ?></td>
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