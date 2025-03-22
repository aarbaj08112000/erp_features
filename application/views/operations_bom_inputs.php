<?php
 // Get the CodeIgniter super object
$CI =& get_instance();
        
// Load the model
$CI->load->model('InhouseParts');
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
                                <div class="col-lg-4">


                                    <div class="form-group">
                                        <label for="po_num">Part Number </label><span class="text-danger">*</span>
                                        <input type="text" readonly
                                            value="<?php echo $operations_bom[0]->customer_part_number ?>"
                                            name="part_number" required class="form-control" id="exampleInputEmail1"
                                            placeholder="Enter Part Number" aria-describedby="emailHelp">
                                    </div>

                                </div>
                                <?php 
                                // echo (int)$output_part_id_new."/".(int)$output_part_id;

                                if((int)$output_part_id_new != (int)$output_part_id)
                                {

                                    ?>
 <div class="col-lg-5">


<div class="form-group">
    <label for="po_num">Inhouse Part Number / Description </label><span class="text-danger">*</span>
    <input type="text" readonly
        value="<?php echo $output_part_data[0]->part_number." / " .$output_part_data[0]->part_description; ?>"
        name="part_number" required class="form-control" id="exampleInputEmail1"
        placeholder="Enter Part Number" aria-describedby="emailHelp">
</div>

</div>
                             
                               <?php }
                               else
                               {
                                // echo (int)$operations_bom_id."/".(int)$output_part_id;
                               }?>
                                

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
                                    <a class="btn btn-danger"
                                        href="<?php echo base_url('operations_bom/') . $this->uri->segment('4'); ?>">
                                        Back </a>
                                </div>
                                <div class="col-lg-2">
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#exampleModal">
                                        Add Inhouse Input Part </button>
                                </div>
                                <div class="col-lg-2">
                                    <button type="button" class="btn btn-success " data-toggle="modal"
                                        data-target="#exampleModalCustomerPart">
                                        Add Input Part From Child Parts Parts </button>
                                </div>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog " role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="<?php echo base_url('add_operations_bom_inputs') ?>"
                                                    method="POST">
                                                    <div class="row">
                                                        <div class="col-lg-12">


                                                            <div class="form-group">
                                                                <label> item part </label><span
                                                                    class="text-danger">*</span>
                                                                <select class="form-control select2"
                                                                    name="input_part_id" style="width: 100%;">
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
                                                                <input type="hidden" name="operations_bom_id"
                                                                    value="<?php echo $this->uri->segment('2'); ?>"
                                                                    required class="form-control"
                                                                    id="exampleInputEmail1" placeholder="Enter Quantity"
                                                                    aria-describedby="emailHelp">
                                                                <input type="hidden" name="input_part_table_name"
                                                                    value="inhouse_parts" required class="form-control"
                                                                    id="exampleInputEmail1" placeholder="Enter Quantity"
                                                                    aria-describedby="emailHelp">



                                                            </div>



                                                            <div class="col-lg-12">

                                                                <div class="form-group">
                                                                    <label for="operation_name">Qty</label><span
                                                                        class="text-danger">*</span>
                                                                    <input type="number" step="any" name="qty"
                                                                        class="form-control" required id="" value="0"
                                                                        placeholder="">
                                                                </div>

                                                            </div>
                                                            <div class="col-lg-12">

                                                                <div class="form-group">
                                                                    <label for="operation_name">Operation
                                                                        Number</label>
                                                                    <input type="text" step="any"
                                                                        name="operation_number" class="form-control"
                                                                        id="" placeholder="Operation Number">
                                                                </div>

                                                            </div>
                                                            <div class="col-lg-12">

                                                                <div class="form-group">
                                                                    <label for="operation_name">Operation
                                                                        Description</label><span
                                                                        class="text-danger">*</span>
                                                                    <input type="text" name="operation_description"
                                                                        class="form-control" required id=""
                                                                        placeholder="Operation Description">
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
                                <div class="modal fade" id="exampleModalCustomerPart" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog " role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add Child Part</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="<?php echo base_url('add_operations_bom_inputs') ?>"
                                                    method="POST">
                                                    <div class="row">
                                                        <div class="col-lg-12">


                                                            <div class="form-group">
                                                                <label> Select Child Part </label><span
                                                                    class="text-danger">*</span>
                                                                <select class="form-control select2"
                                                                    name="input_part_id" style="width: 100%;">
                                                                    <?php
                                                                    foreach ($child_parts_data as $c1) {
                                                                    ?>
                                                                    <option value="<?php echo $c1->id; ?>">
                                                                        <?php echo $c1->part_number; ?>/<?php echo $c1->part_description; ?>
                                                                    </option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                                <input type="hidden" name="operations_bom_id"
                                                                    value="<?php echo $this->uri->segment('2'); ?>"
                                                                    required class="form-control"
                                                                    id="exampleInputEmail1" placeholder="Enter Quantity"
                                                                    aria-describedby="emailHelp">
                                                                <input type="hidden" name="input_part_table_name"
                                                                    value="child_part" required class="form-control"
                                                                    id="exampleInputEmail1" placeholder="Enter Quantity"
                                                                    aria-describedby="emailHelp">



                                                            </div>



                                                            <div class="col-lg-12">

                                                                <div class="form-group">
                                                                    <label for="operation_name">Qty</label><span
                                                                        class="text-danger">*</span>
                                                                    <input type="number" step="any" name="qty"
                                                                        class="form-control" required id="" value="0"
                                                                        placeholder="">
                                                                </div>

                                                            </div>
                                                            <div class="col-lg-12">

                                                                <div class="form-group">
                                                                    <label for="operation_name">Operation
                                                                        Number</label>
                                                                    <input type="text" step="any"
                                                                        name="operation_number" class="form-control"
                                                                        id="" placeholder="Operation Number">
                                                                </div>

                                                            </div>
                                                            <div class="col-lg-12">

                                                                <div class="form-group">
                                                                    <label for="operation_name">Operation
                                                                        Description</label><span
                                                                        class="text-danger">*</span>
                                                                    <input type="text" name="operation_description"
                                                                        class="form-control" required id=""
                                                                        placeholder="Operation Description">
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


                                <!-- </div> -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <!-- <th>Customer Part Number</th> -->
                                            <th>Item part Number</th>
                                            <th>Item part Description</th>
                                            <th>Qty</th>
                                            <th>UOM</th>

                                            <th>Operation Number</th>
                                            <th>Operation Description</th>
                                            <th>Actions</th>


                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $i = 1;
                                        if ($operations_bom_inputs) {
                                            foreach ($operations_bom_inputs as $po) {

                                                if ($po->input_part_table_name == "inhouse_parts") {
                                                    $output_part_data = $this->InhouseParts->getInhousePartOnlyById($po->input_part_id);
                                                    $uom_data = $this->Crud->get_data_by_id("uom", $output_part_data[0]->uom_id, "id");
                                                    $uom = $uom_data[0]->uom_name;
                                                } else {
                                                    // echo "s";
                                                    // echo $po->output_part_id;
                                                    $output_part_data = $this->Crud->get_data_by_id("child_part", $po->input_part_id, "id");
                                                    // $uom_data = $this->Crud->get_data_by_id("uom", $output_part_data[0]->upm, "id");
                                                    $uom_data = $this->Crud->get_data_by_id("uom", $output_part_data[0]->uom_id, "id");
                                                    $uom = $uom_data[0]->uom_name;
                                                }
                                        ?>

                                        <tr>
                                            <td><?php echo $i;?></td>
                                            <td><?php echo $output_part_data[0]->part_number ?></td>
                                            <td><?php echo $output_part_data[0]->part_description ?></td>
                                            <td><?php echo $po->qty ?></td>
                                            <td><?php echo $uom; ?></td>
                                            <td><?php echo $po->operation_number; ?></td>
                                            <td><?php echo $po->operation_description; ?></td>
                                            <td>
                                                        <button type="submit" data-toggle="modal" class="btn btn-sm btn-primary" data-target="#exampleModal2<?php echo $i ?>"> <i class="fas fa-edit"></i></button>

                                                        <div class="modal fade" id="exampleModal2<?php echo $i ?>" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Update</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                <form action="<?php echo base_url('update_operations_bom_inputs') ?>"
                                                    method="POST">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="col-lg-12">
                                                               <div class="form-group">
                                                                    <label for="operation_name">Qty</label><span
                                                                        class="text-danger">*</span>
                                                                    <input value="<?php echo $po->qty ?>" type="number" step="any" name="qty"
                                                                        class="form-control" required id="" value="0"
                                                                        placeholder="">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="form-group">
                                                                    <label for="operation_name">Operation
                                                                        Number</label>
                                                                    <input value="<?php echo $po->operation_number; ?>" type="text" step="any"
                                                                        name="operation_number" class="form-control"
                                                                        id="" placeholder="Operation Number">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="form-group">
                                                                    <label for="operation_name">Operation
                                                                        Description</label><span
                                                                        class="text-danger">*</span>
                                                                    <input value="<?php echo $po->operation_description; ?>" type="text" name="operation_description"
                                                                        class="form-control" required id=""
                                                                        placeholder="Operation Description">
                                                                    <input value="<?php echo $po->id; ?>" type="hidden" name="id"
                                                                        class="form-control" required id=""
                                                                        placeholder="Operation Description">
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
                                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#addPromo<?php echo $i; ?>">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                            <div class="modal fade" id="addPromo<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form action="<?php echo base_url('delete') ?>" method="POST" enctype="multipart/form-data">

                                                                                <label for="">Are You Sure Want To Delete This ?</label>
                                                                                <input type="hidden" value="<?php echo $po->id ?>" name="id" class="form-control">
                                                                                <input type="hidden" value="operations_bom_inputs" name="table_name" class="form-control">



                                                                        </div>








                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                            <button type="submit" class="btn btn-danger">Delete </button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

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