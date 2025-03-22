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
                        <h1>Production Rejection Report</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
                            <li class="breadcrumb-item active">Report</li>
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
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for=""><span class="text-danger">Data Analysis </span>
                                            <div style="padding-left: 10px;padding-top:10px">
                                                <li>Total rejection across all the customers : <span class="text-danger"><?php echo $total_rejection[0]->total_rejection_qty; ?></span></li>
                                                <li>Maximum rejections are for reason <span class="text-danger"><?php echo $max_rejection_reason[0]->name ?></span> with Quantity: <span class="text-danger"><?php echo $max_rejection_reason[0]->total_rejection_qty ?></span></li>
                                                <li>Maximum rejection on machine : <span class="text-danger"><?php echo $machine_analysis[0]->machine_name; ?></span> for reason <span class="text-danger"><?php echo $machine_analysis[0]->name; ?></span> with Quantity: <span class="text-danger"><?php echo $machine_analysis[0]->total_rejection_qty ?></span></li>
                                            </div>
                                            </label>

                                        </div>
                                    </div>
                                </div>
                                <span class="text-info"> Display more details</span>
                                <i id="showIcon" class="fas fa-eye" style="cursor: pointer; display: none;"></i>
                                <i id="hideIcon" class="fas fa-eye-slash" style="cursor: pointer; display: inline;"></i>
                                <div id="dataAnalysis" style="display: none;">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="card-body" style="text-wrap:nowrap;">
                                            <table id="exa" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Top Rejection Reason</th>
                                                        <th>Total Rejection QTY</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $i = 1;
                                                    if ($max_rejection_reason) {
                                                        foreach ($max_rejection_reason as $r) {
                                                    ?>
                                                            <tr>
                                                                <td><?php echo $r->name ?></td>
                                                                <td><?php echo $r->total_rejection_qty ?></td>
                                                            </tr>
                                                    <?php
                                                            $i++;
                                                        }
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="card-body" style="text-wrap:nowrap;">
                                            <table id="exa" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Machine Name</th>
                                                        <th>Rejection Reason</th>
                                                        <th>Total Rejection QTY</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $i = 1;
                                                    if ($machine_analysis) {
                                                        foreach ($machine_analysis as $r) {
                                                    ?>
                                                            <tr>
                                                                <td><?php echo $r->machine_name ?></td>
                                                                <td><?php echo $r->name ?></td>
                                                                <td><?php echo $r->total_rejection_qty ?></td>
                                                            </tr>
                                                    <?php
                                                            $i++;
                                                        }
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                             <!-- <div class="card-header">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <form action="<?php echo base_url('report_prod_rejection'); ?>" method="post">
                                            <div class="form-group">
                                                <label for="">Select Month <span class="text-danger">*</span></label>
                                                <select required name="created_month" id="" class="form-control select2">
                                                    <?php
                                                    for ($i = 1; $i <= 12; $i++) {

                                                        $month_data = $this->Common_admin_model->get_month($i);
                                                        $month_number = $this->Common_admin_model->get_month_number($month_data);
                                                    ?>
                                                        <option <?php
                                                                if ($month_number == $created_month) {
                                                                    echo "selected";
                                                                }
                                                                ?> value="<?php echo $month_number; ?>"><?php echo $month_data ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Select Year <span class="text-danger">*</span></label>
                                            <select required name="created_year" id="" class="form-control select2">
                                                <?php
                                                for ($i = 2022; $i <= 2027; $i++) {

                                                ?>
                                                    <option <?php
                                                            if ($i == $created_year) {
                                                                echo "selected";
                                                            }
                                                            ?> value="<?php echo $i; ?>"><?php echo $i ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <input type="submit" class="btn btn-primary mt-4" value="Search">
                                        </form>
                                    </div>
                                </div>
                            </div> -->
                            <!-- Modal -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Rejection Reason</th>
                                            <th>Rejection QTY</th>
                                            <th>Customer</th>
                                            <th>Part Details</th>
                                            <th>Date/Shift</th>
                                            <th>Machine</th>
                                            <th>Operator</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $i = 1;
                                        if ($report_prod_rejection) {
                                            foreach ($report_prod_rejection as $r) {
                                        ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $r->rejection_reason ?></td>
                                                    <td><?php echo $r->rejection_qty ?></td>
                                                    <td><?php echo $r->customer_name ?></td>
                                                    <td><?php echo $r->part_number ?></td>
                                                    <td><?php echo $r->prod_date . "/ " . $r->shift_type ?></td>
                                                    <td><?php echo $r->machine_name; ?></td>
                                                    <td><?php echo $r->operator_name; ?></td>
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
        document.getElementById("showIcon").addEventListener("click", function() {
            document.getElementById("dataAnalysis").style.display = "none";
            document.getElementById("showIcon").style.display = "none";
            document.getElementById("hideIcon").style.display = "inline";
        });

        document.getElementById("hideIcon").addEventListener("click", function() {
            document.getElementById("dataAnalysis").style.display = "block";
            document.getElementById("showIcon").style.display = "inline";
            document.getElementById("hideIcon").style.display = "none";
        });
    </script>
</body>
</html>





