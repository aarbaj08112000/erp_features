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
                        <h1>Reports : Parts Under Inspection Reports</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
                            <li class="breadcrumb-item active">Parts Under Inspection Reports</li>
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
                                    <div class="col-lg-2">
                                        <form action="<?php echo base_url('reports_inspection'); ?>" method="post">

                                        <div class="form-group">
                                            <label for="">Select Month  <span class="text-danger">*</span></label>
                                            <select required name="created_month" id="" class="form-control select2">
                                                <?php
                                                 for ($i = 1; $i <= 12; $i++) {

                                                    $month_data = $this->Common_admin_model->get_month($i);
                                                    $month_number = $this->Common_admin_model->get_month_number($month_data);
                                                    ?>
                                                    <option
                                                    <?php 
                                                    if($month_number == $created_month){echo "selected";}
                                                    ?>
                                                    value="<?php echo $month_number;?>"><?php echo $month_data?></option>
                                                    <?php
                                                 }
                                                ?>
                                            </select>
                                        </div>
                                        
                                       

                                    </div>
                                    <div class="col-lg-2">

                                    <div class="form-group">
                                            <label for="">Select Year  <span class="text-danger">*</span></label>
                                            <select required name="created_year" id="" class="form-control select2">
                                                <?php
                                                 for ($i = 2022; $i <= 2027; $i++) {

                                                    ?>
                                                    <option 
                                                    <?php 
                                                    if($i == $created_year){echo "selected";}
                                                    ?>
                                                    value="<?php echo $i;?>"><?php echo $i?></option>
                                                    <?php
                                                 }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">

                                        <input type="submit" class="btn btn-primary mt-4"value="Search">
                                       

                                        </form>
                                    </div>
                                </div>
                                
                            </div>
                            <!-- Modal -->
                           

                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>

                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Supplier name</th>
                                            <th>Part No</th>
                                            <th>Part Description</th>
                                            <th>GRN No</th>
                                            <th>GRN Date</th>
                                            
                                            <th>Received QTY</th>
                                            <th>Validation QTY</th>
                                        
                                        </tr>
                                    </thead>
                                        
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        if ($grn_details) {
                                            foreach ($grn_details as $g) {
                                                $new_po = $this->Crud->get_data_by_id("new_po", $g->po_number, "id");
                                                $inwarding = $this->Crud->get_data_by_id("inwarding", $g->inwarding_id, "id");
                                                $supplier_data = $this->Crud->get_data_by_id("supplier", $new_po[0]->supplier_id, "id");
                                                $child_part_data = $this->Crud->get_data_by_id("child_part", $g->part_id, "id");
                                                $data_old = array(
                                                    'po_id' => $new_po[0]->id,
                                                    'part_id' => $g->part_id,
                                        
                                                );
                                        
                                                $po_parts = $this->Common_admin_model->get_data_by_id_multiple_condition("po_parts", $data_old);
                                        ?>

                                                    <tr>
                                                        <td><?php echo $i;?></td>
                                                        <td><?php echo $supplier_data[0]->supplier_name ?></td>
                                                        <td><?php echo $child_part_data[0]->part_number ?></td>
                                                        <td><?php echo $child_part_data[0]->part_description ?></td>
                                                        <td><?php echo $inwarding[0]->grn_number; ?></td>
                                                        <td><?php echo $g->created_date; ?></td>
                                                        <td><?php echo $g->qty; ?></td>
                                                        <td><?php echo $g->verified_qty; ?></td>
                                                       



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