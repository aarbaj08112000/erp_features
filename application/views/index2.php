
<div class="wrapper">

    <!-- Navbar -->

    <!-- /.navbar -->

    <!-- Main Sidebar Container -->


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard v1</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h4><?php echo $total_sales_value_yesterday[0]->MAINSUM ? number_format($total_sales_value_yesterday[0]->MAINSUM,2) : 0; ?>
                                </h4>

                                <p>Total sales value yesterday</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="<?php echo base_url('pei_chart_sales_values_in_rs') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-info">
                              <div style="display: flex;justify-content: space-between;">
                                <div class="inner" style="padding-left: 1em;padding-top: 0.2em; flex-basis: 40%;;">
                                    <h4><?php 
                                    setlocale(LC_ALL,"en_IN");
                                    echo number_format($total_value,2);
                                    ?></h4>
                                    <p>Total RM Stock - <br>Unit 1</p>
                                </div>
                                <div class="inner" style="padding-left: 1em;padding-top: 0.2em; flex-basis: 45%;">
                                    <h4><?php 
                                    setlocale(LC_ALL,"en_IN");
                                    echo number_format($total_value_unit2,2);
                                    ?></h4>
                                    <p>Total RM Stock - <br>Unit 2</p>
                                </div>
                            </div>
                                <a href="<?php echo base_url('part_stocks') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h4>
                                    <?php
                                    echo number_format($grn_value_month[0]->MAINSUM,2);
                                    ?>
                                    <sup style="font-size: 20px"></sup>
                                </h4>

                                <p>GRN value current month</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="<?php echo base_url('reports_grn') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h4>
                                    <?php

                                    $current_date = date('d-m-Y');
                                    $d = date_parse_from_format("d-m-Y", $current_date);
                                    $date = $d["day"];
                                    $month = $d["month"];
                                    $year = $d["year"];
                                    if ($month == 1) {
                                        $last_month = 12;
                                        $year = $year - 1;
                                    } else {
                                        $last_month = $month - 1;
                                    }
                                    $current_year = $year;
                                    $child_part_list_month = $this->db->query('SELECT SUM(accepted_qty) as rejection_sum FROM `parts_rejection_sales_invoice` WHERE  created_month = ' . $last_month . '');
                                    $rejection_sum_qty_data_month  = $child_part_list_month->result();
                                    $rejection_qty = 0;
                                    if ($rejection_sum_qty) {
                                        $rejection_qty = $rejection_sum_qty[0]->rejection_sum;
                                    }
                                    $child_part_list_monthsales_sum = $this->db->query('SELECT SUM(qty) as sales_sum FROM `sales_parts` WHERE  created_month = ' . $last_month . '');
                                    $sales_sum_data  = $child_part_list_monthsales_sum->result();
                                    $sales_sum = 0;

                                    if ($sales_sum_data) {
                                        $sales_sum = $sales_sum_data[0]->sales_sum;
                                    }

                                    if ($sales_sum != 0) {
                                        $last_monnth_ppl = ($rejection_qty / $sales_sum) * 1000000;
                                    } else {
                                        $last_monnth_ppl = 0;
                                    }

                                        echo number_format($last_monnth_ppl, 2);

                                    ?>
                                </h4>

                                <p>Customer PPM Last Month</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="<?php echo base_url('rejection_invoices') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>


                    <!-- ./col -->

                    <!-- ./col -->

                    <!-- ./col -->

                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h4><?php echo $total_sales_value_month[0]->MAINSUM ? number_format($total_sales_value_month[0]->MAINSUM,2) :  0;  ?>
                                </h4>

                                <p>Total sales value current Month</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="<?php echo base_url('pei_chart_sales_values_in_rs') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>


                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-secondary">
                            <div class="inner">
                                <h4><?php echo number_format($total_value_fg,2); ?></h4>
                                <p>Total FG Stock Value</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="<?php echo base_url('fw_stock') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-primary">
                            <div class="inner">
                                <h4><?php

                                    $main_value_qty=0;
                                    $role_management_data = $this->db->query('SELECT * FROM challan_parts');
                                    $challan_parts = $role_management_data->result();
                                    if ($challan_parts) {
                                        foreach ($challan_parts as $c) {
                                            

                                            $challan_data = $this->Crud->get_data_by_id("challan", $c->challan_id, "id");                                    
                                            $supplier_id = $challan_data[0]->supplier_id;
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
                                            $main_value_qty = $main_value_qty + $value_qty;
                                        }
                                    }
                                    echo number_format($main_value_qty,2);

                                    ?>
                                </h4>

                                <p>Subcon challan stock value</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="<?php echo base_url('subcon_supplier_challan_part_report') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-secondary">
                            <div class="inner">
                                <h4><?php
                                    $current_date = date('d-m-Y');
                                    $d = date_parse_from_format("d-m-Y", $current_date);
                                    $date = $d["day"];
                                    $month = $d["month"];
                                    $year = $d["year"];
                                    if ($month == 1) {
                                        $last_month = 12;
                                        $year = $year - 1;
                                    } else {
                                        $last_month = $month - 1;
                                    }
                                    $current_year = $year;
                                    $child_part_list_month = $this->db->query('SELECT SUM(accepted_qty) as rejection_sum FROM `parts_rejection_sales_invoice` WHERE  created_year = ' . $year . '');
                                    // echo 'SELECT SUM(qty) as rejection_sum FROM `new_sales_rejection` WHERE  created_year = ' . $year . '';
                                    $rejection_sum_qty_data_month  = $child_part_list_month->result();
                                    $rejection_qty = 0;
                                    if ($rejection_sum_qty_data_month) {
                                        $rejection_qty = $rejection_sum_qty_data_month[0]->rejection_sum;
                                    }
                                    $child_part_list_monthsales_sum = $this->db->query('SELECT SUM(qty) as sales_sum FROM `sales_parts` WHERE  created_year = ' . $year . '');
                                    $sales_sum_data  = $child_part_list_monthsales_sum->result();
                                    $sales_sum = 0;

                                    if ($sales_sum_data) {
                                        $sales_sum = $sales_sum_data[0]->sales_sum;
                                    }

                                    if ($sales_sum != 0) {
                                        $last_monnth_ppl = ($rejection_qty / $sales_sum) * 1000000;
                                    } else {
                                        $last_monnth_ppl = 0;
                                    }

                                    echo number_format($last_monnth_ppl, 2);

                                    ?>
                                </h4>
                                <p>Customer PPM FY</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="<?php echo base_url('rejection_invoices') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h4>
                                </h4>

                                <p>Production OEE</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="<?php echo base_url('rejection_invoices') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h4>
                                </h4>

                                <p>Inhouse PPM</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="<?php echo base_url('rejection_invoices') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <?php
                                $role_management_data = $this->db->query('SELECT *, SUM(gst_amount) as gst, SUM(total_rate) as ttlrt, SUM(gst_amount) as gstamnt, SUM(tcs_amount) as tcsamnt FROM `sales_parts` GROUP BY sales_number ORDER BY id DESC');
                                $sales_parts = $role_management_data->result();
                                
                                // $total_subtotal = 0; // Initialize total subtotal variable
                                $total_amntreceivetotal = 0; // Initialize total subtotal variable
                                
                                foreach ($sales_parts as $po) {
                                    
                                    $customer_data = $this->Crud->get_data_by_id("customer", $po->customer_id, "id");
                                    $receivable_report_data = $this->Crud->get_data_by_id("receivable_report", $po->sales_number, "sales_number");
                                    $new_sale_data = $this->Crud->get_data_by_id("new_sales", $po->sales_id, "id");
                                                
                                    // Your existing code
                                    // $subtotal = round($po->ttlrt - $po->gstamnt, 2);
                                    // $subtotal = round($po->ttlrt - $po->gstamnt, 2);
                                    $subtotal = $row_total - $receivable_report_data[0]->amount_received;
                                    
                                    // Accumulate subtotals to get the total
                                    $total_amntreceivetotal += $subtotal;
                                }
                                
                                ?>
                                <h4><?php echo $total_amntreceivetotal ? intval($total_amntreceivetotal) :  0;  ?></h4>

                                <p>Receivable Due Amount</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="<?php echo base_url('receivable_report') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h4>
                                </h4>

                                <p>Payable Due Amount</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="<?php echo base_url('rejection_invoices') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-secondary">
                            <div class="inner">
                               <?php
                                $role_management_data = $this->db->query('SELECT *, SUM(gst_amount) as gst, SUM(total_rate) as ttlrt, SUM(gst_amount) as gstamnt, SUM(tcs_amount) as tcsamnt FROM `sales_parts` GROUP BY sales_number ORDER BY id DESC');
                                $sales_parts = $role_management_data->result();
                                
                                $total_gsttotal = 0; // Initialize total subtotal variable
                                
                                foreach ($sales_parts as $po) {
                                    // Your existing code
                                    $subgsttotal = round($po->ttlrt,2) + round($po->tcsamnt,2);
                                    
                                    // Accumulate subtotals to get the total
                                    $total_gsttotal += $subgsttotal;
                                }
                                ?>
                                <h4><?php echo $total_gsttotal ? intval($total_gsttotal) :  0;  ?></h4>

                                <p>Total Amount with GST</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="<?php echo base_url('receivable_report') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>



                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-white">
                            <table class="table table-bordered">
                                <thead class="text-center align-middle">
                                    <tr>
                                        <th rowspan="3" class="text-center align-middle">Total Production <br>on <?php echo $yesterday_date; ?>
                                        </th>
                                        <th colspan="2">YESTERDAY</th>
                                    </tr>
                                    <tr>
                                        <?php
                                        $shifts = $this->Crud->read_data_acc("shifts");

                                        if ($shifts) {
                                            foreach ($shifts as $s) {
                                        ?>
                                                <th><?php echo $s->shift_type ?></th>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </tr>
                                    <tr>
                                        <?php
                                        $shifts = $this->Crud->read_data_acc("shifts");

                                        if ($shifts) {
                                            foreach ($shifts as $s) {
                                                $p_q_data = $this->db->query('SELECT SUM(qty) as MAINSUM FROM `p_q` WHERE shift_id = ' . $s->id . ' AND date = "' . $yesterday_date . '" ');
                                                $p_q_data_show = $p_q_data->result();
                                        ?>
                                                <th><?php if ($p_q_data_show[0]->MAINSUM) {
                                                        echo $p_q_data_show[0]->MAINSUM;
                                                    } else {
                                                        echo "0";
                                                    } ?>
                                                </th>
                                        <?php
                                            }
                                        }
                                        ?>

                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
                <!-- /.row -->
                <!-- Main row -->
                <div class="row">
                    <!-- Left col -->

                    <!-- /.Left col -->
                    <!-- right col (We are only adding the ID to make the widgets sortable)-->

                    <!-- right col -->
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->