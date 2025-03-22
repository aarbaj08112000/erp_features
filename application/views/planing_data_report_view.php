<div class="wrapper" style="width:2000px">

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Planning Data </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
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
                                <h3 class="card-title"></h3>
                                
                                
                        
                            <!-- Button trigger modal -->
                            <div class="row">

                                <div class="col-lg-2">
                                    <form action="<?php echo base_url('planing_data_report_view'); ?>" method="post">
                                        <div class="form-group">
                                            <label for="">Select Customer</label>
                                            <select name="customer_id" id="" class="form-control select2">
                                                <option value="0">All</option>
                                                <?php
                                                if ($customer) {
                                                    foreach ($customer as $c) {
                                                ?>
                                                <option <?php if ($c->id == $customer_id) {
                                                                    echo "selected";
                                                                } ?> value="<?php echo $c->id ?>">
                                                    <?php echo $c->customer_name ?></option>
                                                <?php
                                                    }
                                                }

                                                ?>

                                            </select>
                                        </div>
                                </div>
                                <div class="col-lg-2">

                                    <div class="form-group">
                                        <label for="">Select Financial Year</label>
                                        <select name="financial_year" id="" class="form-control select2">
                                            <?php
                                            for ($i = 2020; $i <= 2027; $i++) {
                                                $year = "FY-" . $i;
                                            ?>
                                            <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                                            <?php
                                            }

                                            ?>



                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-2">

                                    <div class="form-group">
                                        <label for="">Select Month</label>
                                        <select name="month_id" id="" class="form-control select2">

                                            <option value="MAR">MAR</option>
                                            <option value="APR">APR</option>
                                            <option value="MAY">MAY</option>
                                            <option value="JUN">JUN</option>
                                            <option value="JUL">JUL</option>
                                            <option value="AUG">AUG</option>
                                            <option value="SEP">SEP</option>
                                            <option value="OCT">OCT</option>
                                            <option value="NOV">NOV</option>
                                            <option value="DEC">DEC</option>
                                            <option value="JAN">JAN</option>
                                            <option value="FEB">FEB</option>



                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">

                                        <button type="submit" class="btn btn-danger mt-4">Search</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                            <!-- Modal -->
                            

                        
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Sr. No..</th>
                                    <th>Customer Part Number</th>
                                    <th>Customer Part Description</th>
                                    <th>Customer Name</th>
                                    <th>Month </th>
                                    <th>Schedule Qty 1</th>
                                    <th>Schedule Qty 2</th>
                                    <th>Job Card Qumulative Qty</th>
                                    <th>Job Card Balance Qty</th>
                                    <th>Job Card Issued</th>
                                    <th>Job Card Closed</th>
                                    <th>Customer Part Price</th>
                                    <th>Dispatch (sales qty) </th>
                                    <th> Balance Schedule qty </th>
                                    <th>Subtotal Schedule </th>
                                    <!-- <th>Subtotal Schedule 2</th> -->

                                    <th>View Details </th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $i = 1;
                                $total1 = 0;
                                $total2 = 0;
                                if ($planing_data) {

                                    foreach ($planing_data as $t) {

                                        if ($month == $t->month) {

                                            $customer_part_data = $this->Crud->get_data_by_id("customer_part", $t->customer_part_id, "id");
                                            $customer_part_rate = $this->Crud->get_data_by_id("customer_part_rate", $t->customer_part_id, "customer_master_id");
                                            $customers_data = $this->Crud->get_data_by_id("customer", $customer_part_data[0]->customer_id, "id");

                                            if ($customer_id == 0) {

                                                $job_card_data = $this->Crud->get_data_by_id("job_card", $customer_part_data[0]->customer_id, "customer_part_id");
                                                $planing_data = $this->Crud->get_data_by_id("planing_data", $t->id, "planing_id");

                                                $issued = 0;
                                                $closed = 0;

                                                if ($job_card_data) {
                                                    $issued = count($job_card_data);
                                                }

                                                $main_qty = $planing_data[0]->schedule_qty;
                                                if ($planing_data[0]->schedule_qty_2) {
                                                    $main_qty = $planing_data[0]->schedule_qty_2;
                                                }

                                                $subtotal1 = 0;
                                                $subtotal2 = 0;
                                                $rate = 0;
                                                if ($customer_part_rate) {
                                                    // echo "hi";
                                                    $rate = $customer_part_rate[0]->rate;
                                                    $subtotal1 = $customer_part_rate[0]->rate * $planing_data[0]->schedule_qty;
                                                    $subtotal2 = $customer_part_rate[0]->rate * $planing_data[0]->schedule_qty_2;

                                                    $total1 = $total1 + $subtotal1;
                                                    $total2 = $total2 + $subtotal2;
                                                } else {;
                                                }
                                                // $job_card_list = $this->db->query('SELECT SUM(req_qty) as MAINSUM FROM `job_card` where customer_part_id = '.$customer_part_data[0].'  ');
                                                // $count_1 = $job_card_list->result();
                                                $month_number = $this->Common_admin_model->get_month_number($month);
                                                $year_number = substr($financial_year, 3, strlen($financial_year));
                                                $role_management_data = $this->db->query('SELECT SUM(req_qty) as MAINSUM FROM `job_card` WHERE customer_part_id = ' . $t->customer_part_id . ' AND status = "released"');
                                                $count_1 = $role_management_data->result();
                                                $count_1 = $count1[0]->COUNTOFID;

                                                $sales_invoice = $this->db->query('SELECT COUNT(id) as COUNTOFID FROM `new_sales` WHERE created_month = "' . $month_number . '" AND created_year = "' . $year_number . '"');
                                                $count_1_sales_invoice = $sales_invoice->result();
                                                // $sales_invoice = $this->db->query('SELECT COUNT(id) as COUNTOFID FROM `new_sales` WHERE created_month = "' . $month_number . '" AND created_year = "' . $year_number . '"');
                                                // $count_1_sales_invoice = $sales_invoice->result();
                                                // echo
                                                // print_r($count_1_sales_invoice);
                                                // $count_1_sales_invoice;
                                                $job_card_qty = 0;
                                                if ($count_1) {
                                                    echo $job_card_qty = $count_1[0]->MAINSUM;
                                                }

                                                if ($count_1_sales_invoice[0]->COUNTOFID) {
                                                    $dispatch_sales_qty = $count_1_sales_invoice[0]->COUNTOFID;
                                                } else {
                                                    $dispatch_sales_qty = 0;
                                                }

                                                $balance_s_qty = 0;


                                ?>

                                <tr>
                                    <td><?php echo $i ?></td>
                                    <td><?php echo $customer_part_data[0]->part_number ?></td>
                                    <td><?php echo $customer_part_data[0]->part_description ?></td>
                                    <td><?php echo $customers_data[0]->customer_name ?></td>
                                    <td><?php echo $t->month ?></td>
                                    <td><?php echo $planing_data[0]->schedule_qty ?></td>
                                    <td><?php echo $planing_data[0]->schedule_qty_2 ?></td>
                                    <td><?php
                                                        if (!empty($job_card_qty)) {
                                                            echo $job_card_qty;
                                                        } else {
                                                            echo $job_card_qty = 0;
                                                        }
                                                        ?></td>
                                    <td>

                                        <?php
                                                        if (empty($planing_data[0]->schedule_qty_2)) {
                                                            echo  $planing_data[0]->schedule_qty - $job_card_qty;
                                                        } else {
                                                            echo  $planing_data[0]->schedule_qty_2 - $job_card_qty;
                                                        }
                                                        ?>
                                    </td>

                                    <td><?php echo $issued ?></td>
                                    <td><?php echo $closed ?></td>

                                    <td><?php echo $rate; ?></td>
                                    <!-- <td><?php echo $subtotal1; ?> -->
                                    <td>
                                        <?php echo $dispatch_sales_qty; ?>
                                    </td>
                                    <td>
                                        <?php echo $balance_s_qty; ?>
                                    </td>
                                    <td>
                                        <?php
                                                        if (empty($planing_data[0]->schedule_qty_2)) {
                                                            echo   $subtotal1;
                                                        } else {
                                                            echo   $subtotal2;
                                                        }
                                                        ?>
                                    </td>

                                    <td>
                                        <a class="btn btn-info"
                                            href="<?php echo base_url('view_planing_data/') . $t->id ?>">View
                                            Details</a>
                                    </td>

                                </tr>
                                <?php
                                                $i++;
                                            } else {
                                                if ($customers_data[0]->id == $customer_id) {
                                                ?>
                                <tr>
                                    <td><?php echo $i ?></td>
                                    <td><?php echo $customer_part_data[0]->part_number ?></td>
                                    <td><?php echo $customer_part_data[0]->part_description ?></td>
                                    <td><?php echo $customers_data[0]->customer_name ?></td>
                                    <td><?php echo $t->month ?></td>
                                    <td>
                                        <a class="btn btn-info"
                                            href="<?php echo base_url('view_planing_data/') . $t->id ?>">View
                                            Details</a>
                                    </td>

                                </tr>
                                <?php
                                                    $i++;
                                                }
                                            }
                                        }
                                    }
                                }
                                ?>
                            </tbody>

                            <tfoot>
                                <tr style="text-align:right;">
                                    <th colspan="11">Total Sales Value</th>
                                    <th><?php echo $total1; ?></th>
                                    <th><?php echo $total2; ?></th>
                                    <th></th>
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