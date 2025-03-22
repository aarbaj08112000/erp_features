<div class="wrapper">

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <!-- <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Process Master</h1>
        </div>

        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php //echo base_url('dashboard') ?>">Home</a></li>
          </ol>
        </div>
      </div>
    </div>
  </div> -->
        <!-- /.content-header -->

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Mold Life Report</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
                            <li class="breadcrumb-item active">Mold Life Report</li>
                        </ol>
                    </div>

                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div>
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <br>
                    <div class="col-lg-12">
                        <div class="card">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form action="<?php echo base_url('view_mold_by_filter_report') ?>" method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div style="width: 400px;">
                                                <div class="form-group">
                                                    <label for="on click url">Select Part Number <span class="text-danger">*</span></label> <br>
                                                    <select name="child_part_id" class="form-control select2" id="">
                                                        <option <?php if ($filter_child_part_id === "All") ?> value="All">All</option>
                                                        <?php
                                                        if ($mold_maintenance) {
                                                            foreach ($mold_maintenance as $u) {
                                                                $customer_part_data = $this->Crud->get_data_by_id("customer_part", $u->customer_part_id, "id");
                                                                $customer_data = $this->Crud->get_data_by_id("customer", $customer_part_data[0]->customer_id, "id");

                                                        ?>
                                                                <option <?php if ($filter_child_part_id === $u->customer_part_id) echo 'selected' ?> value="<?php echo $u->customer_part_id ?>"><?php echo $customer_data[0]->customer_name . "/" . $customer_part_data[0]->part_number . "/" . $customer_part_data[0]->part_description; ?>
                                                                </option>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <label for="">&nbsp;</label> <br>
                                            <button class="btn btn-secondary">Search </button>
                                        </div>
                                    </div>
                                </form>
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sr No</th>
                                            <th>Customer Part</th>
                                            <th>Mold Name</th>
                                            <th>No Of Cavity</th>
                                            <th>Mold Life Over Frequency</th>
                                            <th>Mold PM Frequency</th>
                                            <th>Molding Prod QTY</th>    
                                            <th style="width:100px">Last PM Date</th>    
                                            <th>PM Report</th>
                                            <th>Mold History</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                       
                                        if ($mold_maintenance) {
                                            $i = 1;
                                             $totalQuantity = 0;
                                            foreach ($mold_maintenance as $u) {
                                                
                                                if (isset($filter_child_part_id) && $filter_child_part_id != "All" && $filter_child_part_id != $u->customer_part_id)
                                                    continue;
                                                $customer_part_data = $this->Crud->get_data_by_id("customer_part", $u->customer_part_id, "id");
                                                $customer_data = $this->Crud->get_data_by_id("customer", $customer_part_data[0]->customer_id, "id");
                                                
                                                $conditions_data = array(
                                        			'customer_part_id' => $u->customer_part_id,
                                        			'mold_id' => $u->id,
                                        		);
                                                
                                        		$molding_production_quantity_data = $this->Common_admin_model->get_data_by_id_multiple_condition("molding_production", $conditions_data);
		
		                                      //  print_r($molding_production_quantity_data); exit;
                                                $totalQuantity = 0; 
                                                foreach ($molding_production_quantity_data as $molding_data) {
                                                    $totalQuantity += $molding_data->qty;
                                                }
                                                $mold_maintenance_docs = $this->Crud->get_data_by_id("mold_maintenance", $u->mold_name, "mold_name");
                                                // print_r($mold_maintenance_docs); exit;
                                                //if($totalQuantity > $u->target_life) {
                                        ?>

                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $customer_data[0]->customer_name . "/" . $customer_part_data[0]->part_number . "/" . $customer_part_data[0]->part_description; ?>
                                                    </td>
                                                    <td><?php echo $u->mold_name ?></td>
                                                    <td><?php echo $u->no_of_cavity ?></td>
                                                    <td><?php echo $u->target_over_life ?></td>
                                                    <td><?php echo $u->target_life ?></td>
                                                    <?php if($totalQuantity > $u->target_life) { ?>
                                                    <td style="background-color:red;color:white"><?php echo $totalQuantity; ?></td>
                                                    <?php } else { ?>
                                                    <td><?php echo $totalQuantity; ?></td>
                                                    <?php } ?>
                                                    <td><?php echo $mold_maintenance_docs[0]->pm_date ?></td>
                                                    
                                                    <td>
                                                        <button type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#uplddoc<?php echo $i; ?>">
                                                          <i class="fas fa-upload" aria-hidden="true"></i>
                                                        </button>
                        
                                                        <?php if(!empty($mold_maintenance_docs[0]->doc)) { ?>
                                                            <a title="Download" class="btn btn-xs btn-success" download href="<?php echo base_url('documents/') . $mold_maintenance_docs[0]->doc; ?>"><i class="fas fa-download" aria-hidden="true"></i> </a>
                                                          <?php }
                                                          ?>
                      
                                                        <div class="modal fade" id="uplddoc<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Upload Document</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                <form  id="form111" action="<?php echo base_url('upload_mold_maintenance_doc') ?>" method="POST" id="form111" enctype="multipart/form-data">
                                                                    <div class="modal-body">
                                                                        <div class="form-group">
                                                                            <label for="on click url">PM Date<span class="text-danger">*</span></label>
                                                                            <br>
                                                                            <input required type="date" name="pm_date" class="form-control" max="<?php echo date('Y-m-d'); ?>">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="on click url">Document<span class="text-danger">*</span></label>
                                                                            <br>
                                                                            <input required type="file" name="doc" class="form-control" value="" id="fileInput111" onchange="checkFileSize(111)">
                                                                            <input type="hidden" name="no_of_cavity" value="<?php echo $u->no_of_cavity; ?>" class="form-control">
                                                                            <input type="hidden" name="mold_name" value="<?php echo $u->mold_name; ?>" class="form-control">
                                                                            <input type="hidden" name="customer_part_id" value="<?php echo $u->customer_part_id; ?>" class="form-control">
                                                                            <input type="hidden" name="target_life" value="<?php echo $u->target_life; ?>" class="form-control">
                                                                            <input type="hidden" name="target_over_life" value="<?php echo $u->target_over_life; ?>" class="form-control">
                                                                            <input type="hidden" name="current_molding_prod_qty" value="<?php echo $totalQuantity; ?>" class="form-control">
                                                                            <input required type="hidden" value="<?php echo $u->id ?>" name="id" placeholder="Enter Mold Life Over Frequency" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                                                    </div>
                                                                </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <?php if(!empty($mold_maintenance_docs[0]->doc)) { ?>
                                                        <a href="<?php echo base_url('mold_maintenance_history/') . str_replace(' ', '_', $u->mold_name) . '/' . $u->customer_part_id ?>" class="btn btn-primary" href=""><i class="fa fa-history" aria-hidden="true"></i></a>
                                                        <?php } ?>
                                                    </td>
                                                    
                                                </tr>
                                        <?php
                                                //}
                                                $i++;
                                            }
                                        }
                                        ?>
                                    </tbody>

                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- ./col -->
                    </div>

                </div>
                <!-- /.row -->
                <!-- Main row -->

                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>