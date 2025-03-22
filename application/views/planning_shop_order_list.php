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
                        <h1>Shop Order Details</h1>
                    </div>
                    <!-- <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                        </ol>
                    </div> -->
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
                                
                                <div class="row">
                                <div class="form-group">
                                    <br>
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#exampleModalShop">
                                        Add Order</button>
                                        
                                        <div class="modal fade" id="exampleModalShop" role="dialog"
                                        aria-labelledby="exampleModalShop" aria-hidden="true">
                                        <div class="modal-dialog" role=" document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalShop">Shop Order</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="<?php echo base_url('add_planning_shop_order') ?>"
                                                        method="POST">
                                                        <div class="row">
                                                        <div class="col-lg-12">
                                                                <div class="form-group">
                                                                <label for="">Customer <span class="text-danger">*</span></label>
                                                                <select name="customer_id" id="customerTracking" required id="customerTracking" class="form-control select2">
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
                                                                    <select name="customerPartId" id="customerPartId" required class="form-control select2">
                                                                        <option value=''>Please select</option>
                                                                    </select>
                                                                </div>

                                                            <div class="col-lg-12">
                                                                <div class="form-group">
                                                                        <label for="Date">Date
                                                                        </label><span class="text-danger">*</span>
                                                                        <input type="date" min="<?php echo date("Y-m-d", strtotime("+ 1 day")); ?>" max="<?php echo date("Y-m-d", strtotime("+ 3 day")); ?>" required name="shop_date" class="form-control">
                                                                </div>
                                                            </div>
                                                                <div class="col-lg-12">
                                                                    <div class="form-group">
                                                                        <label for="contractorName">SO Qty</label><span class="text-danger">*</span>
                                                                        <input type="number" required name="scheduleQty"
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
                                </div>
                                <!-- <div class="row"> -->
                                    <div class="col-lg-3">
                                        <form action="<?php echo base_url('planning_shop_order_details'); ?>" method="post">
                                        <div class="form-group">
                                                            <label for="">Customer <span class="text-danger">*</span></label>
                                                            <select name="selected_customer" class="form-control select2">
                                                            <option value="">Select</option>
												            <option value="ALL">ALL</option>
                                                            <?php
                                                                    if ($customer) {
                                                                        foreach ($customer as $c) {
                                                                    ?>
                                                                   <option <?php if ($c->id == $selected_customer) {
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
                                    <div class="col-lg-1">
                                        <div class="form-group">
                                            <label for="">Month<span class="text-danger"></label>
                                            <select required name="filter_month" class="form-control select2">
                                                <?php
                                                 for ($i = 1; $i <= 12; $i++) {
                                                    $month_data = $this->Common_admin_model->get_month($i);
                                                    $month_number = $this->Common_admin_model->get_month_number($month_data);
                                                    ?>
                                                    <option <?php  if($month_number == $filter_month){echo "selected";} ?>
															value="<?php echo $month_number;?>"><?php echo $month_data?></option>
                                                    <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-1">
										<div class="form-group">
                                            <label for="">Year<span class="text-danger"></label>
                                            <select required name="filter_year" class="form-control select2">
                                                <?php
                                                 for ($i = 2022; $i <= 2027; $i++) {
                                                    ?>
                                                    <option  <?php  if($i == $filter_year){echo "selected";} ?>
															value="<?php echo $i;?>"><?php echo $i?></option>
                                                    <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <br><input type="submit" class="btn btn-primary mt-2"value="Search">
                                     </form>
                                    </div>
                                <!-- </div> -->
                                </div>
								</div>
								</div>

                                
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                   <thead>
                                        <tr>
                                            <th>Sr.No.</th>
                                            <th>Shop Order No</th>
                                            <th>Customer</th>
                                            <th>Part Number</th>
                                            <th>Part Description</th>                                         
                                            <th>SO Date</th>
                                            <th>SO Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        $total=0;
                                        if ($planing_data) {
                                            foreach ($planing_data as $p) {
                                         ?>
                                                <tr>
                                                    <td><?php echo $i ?></td>
                                                    <td><?php echo $p->shop_no ?></td>
                                                    <td><?php echo $p->customer_name ?></td>
                                                    <td><?php echo $p->part_number ?></td>
                                                    <td><?php echo $p->part_description ?></td>
                                                    <td><?php echo date('d/m/Y', strtotime($p->shop_date));  ?></td>
                                                    <td><?php echo $p->scheduleQty ?></td>
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
    <script>
    $(document).ready(function() {
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