<?php
 // Get the CodeIgniter super object
$CI =& get_instance();
        
// Load the model
$CI->load->model('InhouseParts');
$CI->load->model('CustomerPart');

?>

<div style="width:100%" class="wrapper">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <!-- <h1></h1> -->
                        <form action="<?php echo base_url('') ?>" method="POST">
                            <div class="row">
                                <div class="col-lg-6">


                                    <div class="form-group">
                                        <label for="po_num">Part Number </label><span class="text-danger">*</span>
                                        <input type="text" readonly value="<?php echo $customer[0]->part_number ?>" name="part_number" required class="form-control" id="exampleInputEmail1" placeholder="Enter Part Number" aria-describedby="emailHelp">
                                    </div>

                                </div>
                                <div class="col-lg-6">


                                    <div class="form-group">
                                        <label for="po_num">Part Description </label><span class="text-danger">*</span>
                                        <input type="text" readonly value="<?php echo $customer[0]->part_description ?>" name="part_desc" required class="form-control" id="exampleInputEmail1" placeholder="Enter Part Description" aria-describedby="emailHelp">
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Customer item part</li>
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
                                <div class="col-lg-1">
                                       <!-- Button trigger modal -->
                                    <a class="btn btn-danger" href="<?php echo base_url('bom/') . $customer[0]->customer_id; ?>">
                                        Back </a>
                                </div>
                                <div class="col-lg-2">
                                    <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#exampleModal">
                                        Add Inhouse Output Part </button>
                                </div>
                                <div class="col-lg-2">
                                     <button type="button" class="btn btn-success " data-toggle="modal" data-target="#exampleModalCustomerPart">
                                    Add Customer Output Part </button>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog " role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="<?php echo base_url('add_operations_bom') ?>" method="POST">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label> Item part </label><span class="text-danger">*</span>
                                                                <select class="form-control select2" name="output_part_id" style="width: 100%;">
                                                                    <?php
                                                                    foreach ($child_part_list as $c1) {
                                                                    ?>
                                                                        <option value="<?php echo $c1->id; ?>">
                                                                            <?php echo $c1->part_number; ?>/<?php echo $c1->part_description; ?>
                                                                        </option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                                <input type="hidden" name="customer_id" value="<?php echo $customer[0]->customer_id; ?>" required class="form-control" id="exampleInputEmail1" placeholder="Enter Quantity" aria-describedby="emailHelp">
                                                                <input type="hidden" name="customer_part_number" value="<?php echo $customer[0]->part_number; ?>" required class="form-control" id="exampleInputEmail1" placeholder="Enter Quantity" aria-describedby="emailHelp">
                                                                <input type="hidden" name="output_part_table_name" value="inhouse_parts" required class="form-control" id="exampleInputEmail1" placeholder="Enter Quantity" aria-describedby="emailHelp">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label for="operation_name">Scrap Quantity (kg)
                                                                </label><span class="text-danger">*</span>
                                                                <input type="number" step="any" min="0" value="0" name="scrap_factor" class="form-control" required id="exampleInputPassword1" placeholder="Operation Name ">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save
                                                            changes</button>
                                                    </div>
                                                </form>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="exampleModalCustomerPart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog " role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add Customer part</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="<?php echo base_url('add_operations_bom') ?>" method="POST">
                                                    <div class="row">
                                                        <div class="col-lg-12">


                                                            <div class="form-group">
                                                                <label> Select Customer Part </label><span class="text-danger">*</span>
                                                                <select class="form-control select2" name="output_part_id" style="width: 100%;">
                                                                    <?php
                                                                    foreach ($customer_part_list as $c1) {
                                                                    ?>
                                                                        <option value="<?php echo $c1->id; ?>">
                                                                            <?php echo $c1->part_number; ?>/<?php echo $c1->part_description; ?>
                                                                        </option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                                <input type="hidden" name="customer_id" value="<?php echo $customer[0]->customer_id; ?>" required class="form-control" id="exampleInputEmail1" placeholder="Enter Quantity" aria-describedby="emailHelp">
                                                                <input type="hidden" name="customer_part_number" value="<?php echo $customer[0]->part_number; ?>" required class="form-control" id="exampleInputEmail1" placeholder="Enter Quantity" aria-describedby="emailHelp">
                                                                <input type="hidden" name="output_part_table_name" value="customer_part" required class="form-control" id="exampleInputEmail1" placeholder="Enter Quantity" aria-describedby="emailHelp">
                                                            </div>


                                                        </div>

                                                        <div class="col-lg-12">

                                                            <div class="form-group">
                                                                <label for="operation_name">Scrap Quantity (kg)
                                                                </label><span class="text-danger">*</span>
                                                                <input type="number" step="any" min="0" value="0" name="scrap_factor" class="form-control" required id="exampleInputPassword1" placeholder="Operation Name ">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save
                                                            changes</button>
                                                    </div>
                                                </form>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Item part Number</th>
                                            <th>Item part Description</th>
                                            <th>Current Stock</th>
                                            <th>UOM</th>
                                            <th>Scrap(kg) </th>
                                            <th>Part Type</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $i = 1;
                                        if ($operations_bom) {
                                            $part_type;
                                            foreach ($operations_bom as $po) {
                                                $current_stock = "";
                                                if ($po->output_part_table_name == "inhouse_parts") {
                                                    $output_part_data = $this->InhouseParts->getInhousePartById($po->output_part_id);
                                                    $current_stock = $output_part_data[0]->stock;
                                                    $uom_data = $this->Crud->get_data_by_id("uom", $output_part_data[0]->uom_id, "id");
                                                    $uom = $uom_data[0]->uom_name;
                                                    $part_type = "Inhouse Part";
                                                } else {
                                                    $output_part_data = $this->Crud->get_data_by_id("customer_part", $po->output_part_id, "id");
                                                    $customer_parts_master_data = $this->CustomerPart->getCustomerPartByPartNumber($output_part_data[0]->part_number);
                                                    $current_stock = $customer_parts_master_data[0]->fg_stock;
                                                    $uom = $output_part_data[0]->uom;
                                                    $part_type = "Customer Part";
                                                }
                                        ?>

                                                <tr>
                                                    <td><?php echo $output_part_data[0]->id ?></td>
                                                    <td><?php echo $output_part_data[0]->part_number ?></td>
                                                    <td><?php echo $output_part_data[0]->part_description ?></td>
                                                    <td><?php echo $current_stock; ?></td>
                                                    <td><?php echo $uom; ?></td>
                                                    <td><?php echo $po->scrap_factor; ?></td>
                                                    <td><?php echo $part_type; ?></td>
                                                    <td>
                                                        <a class="btn btn-info" href="<?php echo base_url('operations_bom_inputs/') . $po->id . "/" . $po->output_part_id."/".$this->uri->segment('2'); ?>">
                                                            Add Input Parts</a>
                                                        
                                                        <?php if($part_type == "Inhouse Part") { ?>
                                                            <button type="submit" data-toggle="modal" class="btn btn-sm btn-primary" data-target="#editModal<?php echo $i ?>"> <i class="fas fa-edit"></i></button>
                                                            
                                                            <!-- modal starts -->
                                                            <div class="modal fade" id="editModal<?php echo $i ?>" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                                    <div class="modal-dialog modal-lg" role="document">
                                                                                        <div class="modal-content">
                                                                                            <div class="modal-header">
                                                                                                <h5 class="modal-title" id="exampleModalLabel">Update Operation Bom</h5>
                                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                    <span aria-hidden="true">&times;</span>
                                                                                                </button>
                                                                                            </div>
                                                                                            <div class="modal-body">
                                                                                                <form action="<?php echo base_url('update_operations_bom_output') ?>" method="POST">
                                                                                                <div class="row">
                                                                                                    <div class="col-lg-12">
                                                                                                        <div class="form-group">
                                                                                                            <label> Item part
                                                                                                            </label><span class="text-danger">*</span>
                                                                                                            <select class="form-control select2" name="output_part_id" style="width: 100%;">
                                                                                                                <?php
                                                                                                                foreach ($child_part_list as $c1) {
                                                                                                                ?>
                                                                                                                    <option value="<?php echo $c1->id; ?>"
                                                                                                                        <?php if($c1->id == $output_part_data[0]->id)  echo "selected"; ?> >
                                                                                                                        <?php echo $c1->part_number; ?>/<?php echo $c1->part_description; ?>
                                                                                                                    </option>
                                                                                                                <?php
                                                                                                                }
                                                                                                                ?>
                                                                                                            </select>
                                                                                                            <input type="hidden" name="record_id" value="<?php echo $po->id; ?>" required class="form-control">
                                                                                                            <input type="hidden" name="orig_output_part_id" value="<?php echo $output_part_data[0]->id; ?>" required class="form-control">
                                                                                                            <input type="hidden" name="customer_id" value="<?php echo $customer[0]->customer_id; ?>" required class="form-control">
                                                                                                            <input type="hidden" name="customer_part_number" value="<?php echo $customer[0]->part_number; ?>" required class="form-control">
                                                                                                            <input type="hidden" name="output_part_table_name" value="inhouse_parts" required class="form-control">
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col-lg-12">
                                                                                                        <div class="form-group">
                                                                                                            <label for="operation_name">Scrap Quantity (kg)
                                                                                                            </label><span class="text-danger">*</span>
                                                                                                            <input type="number" step="any" min="0" value="<?php echo $po->scrap_factor; ?>" name="scrap_factor" class="form-control" required id="exampleInputPassword1">
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="modal-footer">
                                                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                                                                </div>
                                                                                                </form>
                                                                                          </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            <!-- modal ends -->
                                                            <?php } ?>
                                                        </td>




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