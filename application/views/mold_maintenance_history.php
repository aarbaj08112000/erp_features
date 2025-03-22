<div style="" class="wrapper">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <a style="marign-right:" class="btn btn-danger" href="<?php echo base_url('mold_maintenance_report'); ?>">< Back</a>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home </a></li>
                            <li class="breadcrumb-item active"></li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <?php
                                $mold_maintenance_id = str_replace('_', ' ', $this->uri->segment('2'));
                                $mold_maintenance_data = $this->Crud->get_data_by_id("mold_maintenance", $mold_maintenance_id, "mold_name");
                                
                                $mld_data = $this->Crud->get_data_by_id("mold_maintenance", $mold_maintenance_data[0]->id, "id");
                                $customer_part_data = $this->Crud->get_data_by_id("customer_part", $mold_maintenance_data[0]->customer_part_id, "id");
                                $customer_data = $this->Crud->get_data_by_id("customer", $customer_part_data[0]->customer_id, "id");
                                
                                ?>
                                <div class="row">
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Customer Part<span class="text-danger">*</span> </label>
                                            <input type="text" readonly value="<?php echo $customer_part_data[0]->part_number . $customer_part_data[0]->part_description; ?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Customer Name<span class="text-danger">*</span> </label>
                                            <input type="text" readonly value="<?php echo $customer_data[0]->customer_name ?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Mold Name <span class="text-danger">*</span> </label>
                                            <input type="text" readonly value="<?php echo $mld_data[0]->mold_name ?>" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Cavities <span class="text-danger">*</span> </label>
                                            <input type="text" readonly value="<?php echo $mld_data[0]->no_of_cavity ?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Life Over Frequency<span class="text-danger">*</span> </label>
                                            <input type="text" readonly value="<?php echo $mld_data[0]->target_life ?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Total Molding Prod QTY <span class="text-danger">*</span> </label>
                                            <input type="text" readonly value="<?php echo $mld_data[0]->target_over_life ?>" class="form-control">
                                        </div>
                                    </div>
                                </div>

                            </div>


                            <div class="card-body">
                                <table class="table table-bordered table-striped" id="example1">
                                    <thead>
                                        <tr>
                                            <th>Sr No</th>
                                            <th>Mold PM Frequency</th>
                                            <th>Molding Prod QTY</th>
                                            <th>Last PM Date</th>
                                            <th>Doc</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($mold_maintenance_history) {
                                            $final_po_amount = 0;
                                            $i = 1;
                                            $totalQuantity = 0;
                                            foreach ($mold_maintenance_history as $p) 
                                            {
                                        //         $conditions_data = array(
                                        // 			'customer_part_id' => $p->customer_part_id,
                                        // 			'mold_id' => $p->mold_name,
                                        // 		);
                                        		
                                        		$conditions_data = array(
                                        			'customer_part_id' => $p->customer_part_id,
                                        			'mold_id' => $p->id,
                                        		);
                                               
                                        		$molding_production_quantity_data = $this->Common_admin_model->get_data_by_id_multiple_condition("molding_production", $conditions_data);
		                                      //  print_r($molding_production_quantity_data[0]->qty); exit;
                                                $totalQuantity = 0; 
                                                foreach ($molding_production_quantity_data as $molding_data) {
                                                    $totalQuantity += $molding_data->qty;
                                                }
                                                
                                                
                                                
                                                if(!empty($p->doc))
                                                {
                                        ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $p->target_life; ?></td>
                                                    <td><?php echo $p->current_molding_prod_qty; ?></td>
                                                    <!--<td><?php //echo $molding_production_quantity_data[0]->qty; ?></td>-->
                                                    <td><?php echo $p->pm_date; ?></td>
                                                    <td><?php if(!empty($p->doc)) { ?><a title="Download" class="btn btn-xs btn-success" download href="<?php echo base_url('documents/') . $p->doc; ?>"><i class="fas fa-download" aria-hidden="true"></i> </a><?php } ?></td>
                                                </tr>
                                        <?php
                                                }
                                                $i++;
                                            }
                                        }

                                        ?>



                                    </tbody>

                                    <tfoot>
                                        <?php
                                        if ($po_parts) {
                                        ?>
                                            <tr>
                                                <th colspan="11">Total</th>
                                                <th><?php echo $final_po_amount; ?></th>

                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tfoot>

                                </table>

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