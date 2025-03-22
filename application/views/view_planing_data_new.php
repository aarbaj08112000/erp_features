<?php
// Get the CodeIgniter super object
$CI = &get_instance();

// Load the model
$CI->load->model('SupplierParts');
?>

<div class="wrapper">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>View Planning Data  </h1>
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
                                <!-- a class="btn btn-dark" href="<?php echo base_url('planing_data/').$financial_year.'/'.$month.'/'.$customer_id ; ?>">< Back </a> -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Item part Number</th>
                                            <th>Item part Description</th>
                                            <th>BOM Qty</th>
                                            <th>Schedule Qty </th>
                                            <!-- <th>Schedule 2 Qty </th> 
                                            <th>Change In Schedule Qty </th> -->
                                            <th>Required Qty </th>
                                            <th>Actual Stock </th>
                                            <th>Shortage Stock </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                            foreach ($planing_data as $t) {

                                                $child_part_data = $this->SupplierParts->getSupplierPartById($t->child_part_id);

                                                //$schedule_qty_2 = $t->schedule_qty_2;
                                                $schedule_qty = $t->schedule_qty;
                                                $net_schedule = 0;

                                                if ($schedule_qty_2  != 0) {
                                                    $net_schedule = $schedule_qty_2 - $schedule_qty;
                                                    $req_qty = $t->required_qty +($t->schedule_qty * $t->bom_qty)+ ($net_schedule * $t->bom_qty);
                                                } else {
                                                    $req_qty = ($t->schedule_qty * $t->bom_qty);
                                                }
                                                
                                                $shortage_qty = ($req_qty - $child_part_data[0]->stock);
                                                // $customers_data = $this->Crud->get_data_by_id("customer", $customer_part_data[0]->customer_id, "id");

                                        ?>

                                                <tr>
                                                    <td><?php echo $i ?></td>
                                                    <td><?php echo $child_part_data[0]->part_number ?></td>
                                                    <td><?php echo $child_part_data[0]->part_description ?></td>
                                                    <td><?php echo $t->bom_qty ?></td>
                                                    <td><?php echo $t->schedule_qty; ?></td>
                                                    <!-- 
                                                        schedule_qty_2 is not in use so far..
                                                    <td><?php echo $t->schedule_qty_2; ?></td>
                                                    <td><?php echo $net_schedule; ?></td> 
                                                    -->
                                                    <td><?php echo $req_qty ?></td>
                                                    <td><?php echo $child_part_data[0]->stock ?></td>
                                                    <td><?php echo $shortage_qty ?></td>


                                                </tr>
                                        <?php
                                                $i++;
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