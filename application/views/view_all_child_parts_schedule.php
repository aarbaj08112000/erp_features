<?php
// Get the CodeIgniter super object
$CI = &get_instance();

// Load the model
$CI->load->model('SupplierParts');

?>

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
                        <h1>Monthly MRP Req</h1>
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
                                <a class="btn btn-dark" href="<?php echo base_url('planing_data/').$financial_year.'/'.$month.'/0' ; ?>">< Back </a>
                                <!-- <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#exampleModal">
                                    Update Schedule Qty 2 </button> -->
                                <!-- Button trigger modal -->
                                <!-- <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#exampleModal">
                                    Add Planing</button> -->
                                <!-- Modal -->
                              
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                   <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Item part Number</th>
                                            <th>Item part Description</th>                                         
                                            <th>Actual Stock</th>
                                            <th>Net MRP Req</th>
                                            <th>Required Qty </th>
                                            <th>Part Rate</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        $total=0;
                                      
                                        if ($child_part_master) {
                                            foreach ($child_part_master_main as $t) {
                                                $subtotal=0;
                                                $shortage_qty=0;
                                                $actual_stock=0;                                                
                                                $child_part_master = $this->Crud->get_data_by_id("child_part_master", $t->part_number, "part_number");
                                                if($child_part_master) {
                                                $child_part_data = $this->SupplierParts->getSupplierPartByPartNumber($t->part_number);
                                                $array = array(
                                                    "child_part_id" => $child_part_master[0]->child_part_id,
                                                    "financial_year" => $financial_year,
                                                    "month" => $month,
                                                );
                                                $planing_data = $this->Crud->get_data_by_id_multiple_condition("planing_data", $array);
                                                $req_qty = 0;
                                                if ($planing_data) {
                                                    foreach ($planing_data as $t) {
                                                        $schedule_qty_2 = $t->schedule_qty_2;
                                                        $schedule_qty = $t->schedule_qty;
                                                        $net_schedule = 0;

                                                        if ($schedule_qty_2  != 0) {
                                                            $net_schedule = $schedule_qty_2 - $schedule_qty;
                                                            $req_qty = $req_qty + $t->required_qty + ($net_schedule * $t->bom_qty);
                                                        } else {
                                                            $req_qty = $req_qty + ($t->schedule_qty * $t->bom_qty);
                                                        }
                                                        $actual_stock = $actual_stock+$t->actual_stock;
                                                        $shortage_qty = $shortage_qty+($req_qty - $child_part_data[0]->stock);
                                                    }
                                                }
                                                else
                                                {
                                                    // echo "no plan found";
                                                }

                                                // $shortage_qty = $req_qty - $t->actual_stock;
                                                // $customers_data = $this->Crud->get_data_by_id("customer", $customer_part_data[0]->customer_id, "id");
                                                $subtotal = $child_part_master[0]->part_rate*$req_qty;
                                                $total = $total + $subtotal;
                                                $net_mrp_req = $req_qty - $child_part_data[0]->stock;
                                               
                                            }
                                        ?>

                                                <tr>
                                                    <td><?php echo $i ?></td>
                                                    <td><?php echo $child_part_data[0]->part_number ?></td>
                                                    <td><?php echo $child_part_data[0]->part_description ?></td>
                                                    <td><?php echo $child_part_data[0]->stock ?></td>
                                                    <td class="<?php if($net_mrp_req > 0){echo "text-danger";}else{echo "text-success";}?>"><?php echo $net_mrp_req  ?></td>
                                                    <td><?php echo $req_qty ?></td>

                                                    <td><?php
                                                    if($child_part_master)
                                                    {
                                                        echo $child_part_master[0]->part_rate;
                                                    } ?></td>
                                                        <td><?php echo $subtotal ?></td>
                                                </tr>
                                        <?php
                                                $i++;
                                            }
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr style="text-align:right"><th colspan="7">
                                            Total Purchase Value
                                        </th>
                                    <th>
                                        <?php echo $total;?>
                                    </th></tr>
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