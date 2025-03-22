<div class="wrapper">

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-5">
                        <h1>Planning Data</h1>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <!-- <div class="col-6"> -->
                                <h3 class="card-title"></h3>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#exampleModal">
                                    Add Planing</button>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#exampleModal1212">
                                    Add FG Stock</button>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal1212" role="dialog"
                                    aria-labelledby="exampleModal1212Label" aria-hidden="true">
                                    <div class="modal-dialog" role=" document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModal1212Label">Add FG Stock</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="<?php echo base_url('add_planning_fg_stock') ?>"
                                                    method="POST">
                                                    <div class="row">
                                                    <div class="col-lg-12">
                                                            <div class="form-group">
                                                            <label for="">Customer <span class="text-danger">*</span></label>
                                                            <select name="customer_id" id="customer_tracking1" required id="" class="form-control select2">
                                                                <option value=''>Select</option>
                                                                <?php
                                                                    if ($customer) {
                                                                        foreach ($customer as $s) {
                                                                    ?>
                                                                   <option value="<?php echo $s->id; ?>"><?php echo $s->customer_name; ?></option>
                                                                    <?php
                                                                        }
                                                                    }
                                                                ?>
                                                            </select> 
                                                            </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="form-group">
                                                                <label for="">Select Customer Part Number / Description
                                                                <span class="text-danger">*</span> </label>
                                                                <select name="customer_part_id1" id="customer_part_id1" required class="form-control select2">
                                                                    <option value=''>Please select</option>
                                                                </select>
                                                            </div>

                                                        <div class="col-lg-12">
                                                                <div class="form-group">
                                                                    <label for="contractorName">Select Month
                                                                    </label><span class="text-danger">*</span>
                                                                    <select name="month_id" id=""
                                                                        class="form-control select2">
                                                                        <option value="<?php echo $month; ?>">
                                                                            <?php echo $month; ?></option>
                                                                    </select>
                                                                </div>

                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="form-group">
                                                                    <label for="contractorName">Production
                                                                        Quantity</label><span
                                                                        class="text-danger">*</span>
                                                                    <input type="number" required name="fg_stock"
                                                                        class="form-control">
                                                                    <input type="hidden" required name="financial_year"
                                                                        value="<?php echo $financial_year; ?>"
                                                                        class="form-control">
                                                                </div>

                                                            </div>


                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save
                                                                changes</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- Modal End-->

                                <a href="<?php echo base_url('view_all_child_parts_schedule/') . $financial_year . "/" . $month; ?>"
                                    class="btn btn-primary">
                                    Monthly MRP Req</a>
                                <!-- </div>
                                <div class="col-6" style="align:right;"> -->
                                <button type="button" class="btn btn-info" data-toggle="modal"
                                    data-target="#exportCustomerPartsOnly">
                                    Export Format</button>

                                <!-- Export Modal -->
                                <div class="modal fade" id="exportCustomerPartsOnly" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Export Customer Data for Planning Data</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="<?php echo base_url('planning_export_customer_part') ?>"
                                                    method="POST">
                                                    <div class="row">
                                                        <div class="col-lg-10">
                                                            <label for="contractorName">Customer</label><span
                                                                class="text-danger">*</span>
                                                            <select name="customer_id" id=""
                                                                class="form-control select2" required>
                                                                <option value="">Select</option>
                                                                <?php
                                                                if ($customer) {
                                                                    foreach ($customer as $c) {
                                                                ?>
                                                                <option value="<?php echo $c->id; ?>">
                                                                    <?php echo $c->customer_name; ?></option>
                                                                <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <input type="hidden" value="<?php echo $financial_year ?>"
                                                    class="hidden" name="financial_year">
                                                <input type="hidden" value="<?php echo $month ?>"
                                                    class="hidden" name="month">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary">Export</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <button type="button" class="btn btn-info" data-toggle="modal"
                                    data-target="#importCustomerPartsOnly">
                                    Import Data</button>
                                
                                 <!-- Import Modal -->
                                 <div class="modal fade" id="importCustomerPartsOnly" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Import Planning Data</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="<?php echo base_url('import_customer_planning') ?>" 
                                                method="POST" enctype='multipart/form-data'>
                                                    <div class="row">
                                                        <div class="col-lg-10">
                                                            <label>Customer</label><span
                                                                class="text-danger">*</span>
                                                            <select name="customer_id" id=""
                                                                class="form-control select2" required>
                                                                <option value="">Select</option>
                                                                <?php
                                                                if ($customer) {
                                                                    foreach ($customer as $c) {
                                                                ?>
                                                                <option value="<?php echo $c->id; ?>">
                                                                    <?php echo $c->customer_name; ?></option>
                                                                <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                            <div class="form-group">
                                                                <br><label for="po_num">Upload Plan</label><span
                                                                class="text-danger">*</span>
                                                                <input type="file" name="uploadedDoc" required class="form-control" id="exampleuploadedDoc" placeholder="Upload Plan" aria-describedby="uploadDocHelp">
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <input type="hidden" value="<?php echo $this->uri->segment('2') ?>"
                                                    class="hidden">
                                                <input type="hidden" value="<?php echo $this->uri->segment('3') ?>"
                                                    class="hidden">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary">Import</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                   
                                <!-- Add Planning Modal -->
                                <div class="modal fade" id="exampleModal" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role=" document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add Planing</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="<?php echo base_url('add_planning_data') ?>"
                                                    method="POST">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                            <label for="">Customer <span class="text-danger">*</span></label>
                                                            <select name="customer_id" id="customer_tracking" required id="" class="form-control select2">
                                                                <option value=''>Select</option>
                                                                <?php
                                                                    if ($customer) {
                                                                        foreach ($customer as $s) {
                                                                    ?>
                                                                   <option value="<?php echo $s->id; ?>"><?php echo $s->customer_name; ?></option>
                                                                    <?php
                                                                        }
                                                                    }
                                                                ?>
                                                            </select> 
                                                            </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="form-group">
                                                                <label for="">Select Customer Part Number / Description
                                                                <span class="text-danger">*</span> </label>
                                                                <select name="customer_part_id" id="customer_part_id" required class="form-control select2">
                                                                    <option value=''>Please select</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="form-group">
                                                                    <label for="contractorName">Select Month
                                                                    </label><span class="text-danger">*</span>
                                                                    <select name="month_id" id=""
                                                                        class="form-control select2">
                                                                        <option value="<?php echo $month; ?>">
                                                                            <?php echo $month; ?></option>

                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">

                                                                <div class="form-group">
                                                                    <label for="contractorName">Enter Schedule Qty
                                                                    </label><span class="text-danger">*</span>
                                                                    <input type="number" required name="schedule_qty"
                                                                        class="form-control">
                                                                    <input type="hidden" required name="financial_year"
                                                                        value="<?php echo $financial_year; ?>"
                                                                        class="form-control">
                                                                </div>

                                                            </div>


                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close</button>
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


                        <div class="card-header">
                            <h3 class="card-title"></h3>
                            <!-- Button trigger modal -->
                            <div class="row">
                                <div class="col-lg-2">
                                    <form
                                        action="<?php echo base_url('planing_data/' . $financial_year . "/" . $month . "/0"); ?>"
                                        method="post">
                                        <div class="form-group">
                                            <label for="">Select Customer</label>
                                            <select name="customer_id" id="customer_id" class="form-control select2" required>
                                                 <option value="">Select</option>
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
                                                <option value="ALL">ALL</option>
                                            </select>
                                        </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <input type="hidden" name="financial_year"
                                            value="<?php echo $financial_year; ?>">
                                        <input type="hidden" name="month" value="<?php echo $month; ?>">
                                        <button type="submit" class="btn btn-primary mt-4">Search</button>
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
                                    <th>Sr. No..</th>
                                    <th>Customer Part Number</th>
                                    <th>Customer Part Description</th>
                                    <th>Customer Name</th>
                                    <th>Month </th>
                                    <th>Schedule Qty</th>
                                    <!--<th>Schedule Qty 2</th> -->
                                    <?php if($entitlements['isJobCard']!=null) { ?>
                                    <th>Job Card Qumulative Qty</th>
                                    <th>Job Card Balance Qty</th>
                                    <th>Job Card Issued</th>
                                    <th>Job Card Closed</th>
                                    <?php } ?>
                                    <!-- <th>Customer Part Price</th>-->
                                    <th>Dispatch (sales qty) </th>
                                    <th>Balance Schedule qty </th>
                                    <th>Subtotal Schedule </th>
                                    <!-- <th>Subtotal Schedule 2</th> -->
                                    <th class="noExport">View</th>
                                    <th class="noExport">Edit</th>
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

                                                //$job_card_data = $this->Crud->get_data_by_id("job_card", $customer_part_data[0]->customer_id, "customer_part_id");
                                                $planing_data = $this->Crud->get_data_by_id("planing_data", $t->id, "planing_id");

                                                $issued = 0;
                                                $closed = 0;

                                                /*if ($job_card_data) {
                                                    $issued = count($job_card_data);
                                                }*/

                                                $main_qty = $planing_data[0]->schedule_qty;
                                                /*if ($planing_data[0]->schedule_qty_2) {
                                                    $main_qty = $planing_data[0]->schedule_qty_2;
                                                }*/

                                                $subtotal1 = 0;
                                                //$subtotal2 = 0;
                                                $rate = 0;
                                                if ($customer_part_rate) {
                                                    // echo "hi";
                                                    $rate = $customer_part_rate[0]->rate;
                                                    $subtotal1 = $customer_part_rate[0]->rate * $planing_data[0]->schedule_qty;
                                                   // $subtotal2 = $customer_part_rate[0]->rate * $planing_data[0]->schedule_qty_2;

                                                    $total1 = $total1 + $subtotal1;
                                                    //$total2 = $total2 + $subtotal2;
                                                } else {;
                                                }
                                                // $job_card_list = $this->db->query('SELECT SUM(req_qty) as MAINSUM FROM `job_card` where customer_part_id = '.$customer_part_data[0].'  ');
                                                // $count_1 = $job_card_list->result();
                                                $month_number = $this->Common_admin_model->get_month_number($month);
                                                $year_number = substr($financial_year, 3, strlen($financial_year));
                                                /* $role_management_data = $this->db->query('SELECT SUM(req_qty) as MAINSUM FROM `job_card` WHERE customer_part_id = ' . $t->customer_part_id . ' AND status = "released"');
                                                $count_1 = $role_management_data->result();
                                                $count_1 = $count1[0]->COUNTOFID; */

                                                $sales_invoice = $this->Crud->customQuery('SELECT sum(p.qty) as dispatched_qty FROM new_sales s, sales_parts p
                                                        WHERE s.created_year = "' . $year_number . '"
                                                        AND s.created_month = "'.$month_number.'" 
                                                        AND s.status = "lock"
                                                        AND p.part_id = '.$t->customer_part_id.'
                                                        AND s.id = p.sales_id
                                                        GROUP BY s.customer_part_id');
                                                
                                                $total_dispatched_qty = 0;
                                                if($sales_invoice) {
                                                    foreach ($sales_invoice as $sale) {
                                                           if ($sale->dispatched_qty > 0) {
                                                                $dispatch_sales_qty = $sale->dispatched_qty;
                                                            } else {
                                                                $dispatch_sales_qty = 0;
                                                            }
                                                            $total_dispatched_qty = $total_dispatched_qty + $dispatch_sales_qty;
                                                    }
                                                }
                                             $balance_s_qty = ( $planing_data[0]->schedule_qty - $total_dispatched_qty);
                                ?>

                                <tr>
                                    <td><?php echo $i ?></td>
                                    <td><?php echo $customer_part_data[0]->part_number ?></td>
                                    <td><?php echo $customer_part_data[0]->part_description ?></td>
                                    <td><?php echo $customers_data[0]->customer_name ?></td>
                                    <td><?php echo $t->month ?></td>
                                    <td><?php echo $planing_data[0]->schedule_qty ?></td>
                                    <!-- <td><?php // echo $planing_data[0]->schedule_qty_2 ?></td> -->
                                    <!-- <?php if($entitlements['isJobCard']!=null) { ?>
                                    <td><?php
                                                        /* if (!empty($job_card_qty)) {
                                                            echo $job_card_qty;
                                                        } else {
                                                            echo $job_card_qty = 0;
                                                        } */
                                                        ?></td> -->
                                    <td>
                                        <?php
                                                        //if (empty($planing_data[0]->schedule_qty_2)) {
                                                            echo  $planing_data[0]->schedule_qty - $job_card_qty;
                                                        //} else {
                                                          //  echo  $planing_data[0]->schedule_qty_2 - $job_card_qty;
                                                        //}
                                                        ?>
                                    </td>

                                    <td><?php echo $issued ?></td>
                                    <td><?php echo $closed ?></td>
                                    <?php }  ?>
                                    <!-- <td><?php echo $rate; ?></td> -->
                                    <!-- <td><?php echo $subtotal1; ?> -->
                                    <td>
                                        <?php echo $total_dispatched_qty; ?>
                                    </td>
                                    <td>
                                        <?php echo $balance_s_qty; ?>
                                    </td>
                                    <td>
                                        <?php
                                                        //if (empty($planing_data[0]->schedule_qty_2)) {
                                                            echo "Rs.".$subtotal1; 
                                                        /* } else {
                                                            echo   $subtotal2;
                                                        }*/
                                                        ?>
                                    </td>
                                    <td class="noExport">
                                    <a class="btn btn-info"
                                            href="<?php echo base_url('view_planing_data/') . $t->id .'/'.$customer_part_data[0]->customer_id; ?>"><i class="fas fa-eye"></i></a>
                                            <!-- Edit Modal -->
                                                    </td>
                                                    <td>
                                            <button title="Edit" type="button" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#editenew<?php echo $i; ?>">
                                                  <i class="fa fa-edit"></i>
                                                </button>
                                                <div class="modal fade" id="editenew<?php echo $i; ?>" tabindex="-1"
                                                    role="dialog" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Update
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form
                                                                    action="<?php echo base_url('update_planning_data') ?>"
                                                                    method="POST" enctype="multipart/form-data">
                                                                    <div class="form-group">
                                                                    <label for="contractorName">Enter Schedule Qty
                                                                    </label><span class="text-danger">*</span>
                                                                    <input type="number" value="<?php echo $planing_data[0]->schedule_qty; ?>" equired name="schedule_qty"
                                                                        class="form-control">
                                                                    <input required value="<?php echo $t->id; ?>"
                                                                            type="hidden" class="form-control"
                                                                            name="planning_id">
                                                                            <input required value="<?php echo $t->customer_part_id; ?>"
                                                                            type="hidden" class="form-control"
                                                                            name="cust_part_id">
                                                                            <input required value="<?php echo $t->month; ?>"
                                                                            type="hidden" class="form-control"
                                                                            name="month_id">
                                                                            <input required value="<?php echo $t->financial_year; ?>"
                                                                            type="hidden" class="form-control"
                                                                            name="financial_year">
                                                                            <input required value="<?php echo $customer_part_data[0]->customer_id; ?>"
                                                                            type="hidden" class="form-control"
                                                                            name="customer_id">
                                                                    </div>

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Save
                                                                    changes</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                              <!-- Edit Modal Ends -->               
                                    </td>
                                </tr>
                                <?php
                                                $i++;
                                        }
                                    }
                                } ?>
                            </tbody>
                        </table>
                       <div class="card-header">
                            <div class="row">
                                <div class="col-sm-12 col-md-6"></div>
                                <div class="col-lg-2;" style="color: crimson;">
                                    <b>Total Sales Value : <?php echo "Rs.".$total1; ?></b>
                                </div>
                            </div>
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
<script>
    $(document).ready(function() {
        var customer_id = $("#customer_tracking").val();
        $.ajax({
            url: '<?php echo site_url("PlanningController/get_customer_parts_for_planning"); ?>',
            type: "POST",
            data: {
                id: customer_id
          //      ,salesno: salesno
            },
            cache: false,
            beforeSend: function() {},
            success: function(response) {
                if (response) {
                    $('#customer_part_id').html(response);
                } else {
                    $('#customer_part_id').html(response);
                }

            }
        });

        $("#customer_tracking").change(function() {
            var customer_id = $("#customer_tracking").val();
            // var salesno = $('#sales_number').val();
            $.ajax({
                url: '<?php echo site_url("PlanningController/get_customer_parts_for_planning"); ?>',
                type: "POST",
                data: {
                    id: customer_id
                    //, salesno: salesno
                },
                cache: false,
                beforeSend: function() {},
                success: function(response) {
                    if (response) {
                        $('#customer_part_id').html(response);
                    } else {
                        $('#customer_part_id').html(response);
                    }

                }
            });
        })


        var customer_id = $("#customer_tracking1").val();
        // $('#new_po_id').val(id);
        // var salesno = $('#sales_number').val();
        $.ajax({
            url: '<?php echo site_url("PlanningController/get_customer_parts_for_planning"); ?>',
            type: "POST",
            data: {
                id: customer_id
          //      ,salesno: salesno
            },
            cache: false,
            beforeSend: function() {},
            success: function(response) {
                if (response) {
                    $('#customer_part_id1').html(response);
                } else {
                    $('#customer_part_id1').html(response);
                }

            }
        });

        $("#customer_tracking1").change(function() {
            var customer_id = $("#customer_tracking1").val();
            // var salesno = $('#sales_number').val();
            $.ajax({
                url: '<?php echo site_url("PlanningController/get_customer_parts_for_planning"); ?>',
                type: "POST",
                data: {
                    id: customer_id
                    //, salesno: salesno
                },
                cache: false,
                beforeSend: function() {},
                success: function(response) {
                    if (response) {
                        $('#customer_part_id1').html(response);
                    } else {
                        $('#customer_part_id1').html(response);
                    }

                }
            });
        })

        $("#customerTracking").change(function() {
            var customer_id = $("#customerTracking").val();
            // var salesno = $('#sales_number').val();
            $.ajax({
                url: '<?php echo site_url("PlanningController/get_customer_parts_for_planning"); ?>',
                type: "POST",
                data: {
                    id: customer_id
                    //, salesno: salesno
                },
                cache: false,
                beforeSend: function() {},
                success: function(response) {
                    if (response) {
                        $('#customerPartId').html(response);
                    } else {
                        $('#customerPartId').html(response);
                    }

                }
            });
        })
    });
</script>