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
                        <h1>Challan History</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <!-- <li class="breadcrumb-item active">Store Stock</li> -->
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
                                <h3 class="card-title">History</h3>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Supplier Challan Number</th>
                                            <th>Qty</th>
                                            <th>Accepted Qty</th>
                                            <th>Rejected Qty</th>
                                            <th>Status</th>
                                            <th>Date & Time </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $i = 1;
                                        if ($challan_parts_data) {
                                            foreach ($challan_parts_data as $s) {
                                                // print_r($m);
                                        // $inward = $this->Crud->get_data_by_id("store", $s->id, "part_id");
                                        // $inwardc = $this->db->query("SELECT SUM(quantity) as store_count from store where part_id = $s->id")->result();
                                        // $issue_sum = $this->db->query("SELECT SUM(item_quantity) as issue_count from issue where part_id = $s->id")->result();
                                        // // $issue = $this->Crud->get_data_by_id("issue", $s->id, "part_id");
                                                // print_r($inwardc);

                                                
                                        ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $s->supplier_challan_number; ?></td>
                                                    <td><?php echo $s->qty; ?></td>
                                                    <td><?php echo $s->accepeted_qty; ?></td>
                                                    <td><?php echo $s->reject_qty; ?></td>
                                                    <td><?php echo $s->status; ?></td>
                                                    <td><?php echo $s->created_date . "/". $s->created_time; ?></td>
                                                

                                                 

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