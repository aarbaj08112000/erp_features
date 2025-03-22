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
                        <h1> Issue Material</h1>
                        <?php 
                         $role = trim($this->session->userdata['type']);

                        ?>
                    </div>

                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                            <li class="breadcrumb-item active"> Issue Material</li>
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
                                <h3 class="card-title">

                                </h3>
                                <!-- Button trigger modal -->
                                <?php if($role == "Admin" || $role=="production"){?>

                                <button type="button" class="btn btn-primary float-left" data-toggle="modal"
                                    data-target="#exampleModal">
                                    Issue Material </button>
                                   
                                    <?php }?>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel"> Issue Material </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="<?php echo base_url('add_stock_up') ?>" method="POST"
                                                enctype='multipart/form-data'>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label for="po_num">Select Part Number / Description / Stock
                                                            </label><span class="text-danger">*</span>
                                                            <select name="part_id" id="" class="from-control select2">
                                                                <?php
                                                                if ($child_part) {
                                                                    foreach ($child_part as $c) {

                                                                        if ($c->stock > 0) {
                                                                ?>
                                                                <option value="<?php echo $c->id ?>">
                                                                    <?php echo $c->part_number . "/" . $c->part_description . "/" . $c->stock; ?>
                                                                </option>
                                                                <?php
                                                                        }
                                                                    }
                                                                }
                                                                ?>
                                                            </select>

                                                        </div>
                                                        <div class="form-group">
                                                            <label for="po_num">Enter Reason <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" name="reason" required
                                                                placeholder="Enter Reason" class="form-control">

                                                        </div>

                                                        <div class="form-group">
                                                            <label for="po_num">Upload document</label>
                                                            <input type="file" name="uploading_document"
                                                                class="form-control">

                                                        </div>
                                                        <div class="form-group">
                                                            <label for="po_num">Enter Qty <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="number" name="qty" step="any"
                                                                placeholder="Enter Qty" name="qty" required
                                                                class="form-control">
                                                            <input type="hidden" name="type" value="minus" step="any"
                                                                placeholder="Enter Qty" name="qty" required
                                                                class="form-control">

                                                        </div>
                                                        <!-- <div class="form-group">
                                                            <label for="po_num">Enter Remark </label>
                                                            <input type="text" name="remark" required placeholder="Enter Remark" class="form-control">

                                                        </div> -->

                                                    </div>


                                                </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                        </form>

                                    </div>

                                </div>
                            </div>

                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>

                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Request Number</th>
                                            <th>Part Number / Description</th>
                                            <th>Request Qty</th>
                                            <th>UOM</th>
                                            <!-- <th>Stock Qty</th> -->

                                            <th>Reason</th>
                                            <th>Document</th>
                                            <th>Request Date</th>
                                            <th>Qty To Removed</th>

                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        if ($stock_changes) {
                                            foreach ($stock_changes as $c) {
                                                $child_part_data = $this->SupplierParts->getSupplierPartById($c->part_id);
                                                $uom_data = $this->Crud->get_data_by_id("uom", $child_part_data[0]->uom_id, "id");
                                                if ($c->type == "minus") {
                                        ?>

                                        <tr>
                                            <td><?php echo $i ?></td>
                                            <td><?php echo $c->id ?></td>
                                            <td><?php echo $child_part_data[0]->part_number . '/' . $child_part_data[0]->part_description; ?>
                                            </td>
                                            <td><?php echo $c->qty; ?></td>
                                            <td><?php echo $uom_data[0]->uom_name ?></td>

                                            <!-- <td><?php echo $child_part_data[0]->stock; ?></td> -->
                                            <td><?php echo $c->reason; ?></td>
                                            <td>
                                                <?php
                                                            if (empty($c->uploading_document)) {
                                                            } else {
                                                            ?>
                                                <a class="btn btn-dark" download
                                                    href="<?php echo base_url('documents/') . $c->uploading_document ?>">Download</a>

                                                <?php
                                                            }
                                                            ?>

                                            </td>
                                          
                                            <td><?php echo $c->created_date; ?></td>
                                            
                                            <td>
                                            <form action="<?php echo base_url('remove_stock')?>" method="post">

                                            <?php
                                                            if ($c->status == "pending") {
                                                            ?>
                                                <input type="text" required name="qty" max="<?php echo $c->qty;?>" min="1" placeholder="Enter Qty" value="<?php echo $c->qty;?>" class="form-control">
                                                <input type="hidden" required name="id"  placeholder="Enter Qty" value="<?php echo $c->id;?>" class="form-control">
                                                <?php 
                                                            }
                                                            else
                                                            {

                                                                if(!empty($c->accepted_qty)){
                                                                    echo $c->accepted_qty;
                                                                }
                                                                else
                                                                {
                                                                    echo $c->qty;
                                                                }
                                                            }
                                                ?>
                                            </td>

                                            <td>
                                                <?php
                                                            if ($c->status == "pending") {
                                                            ?>
                                                <button type="submit" class="btn btn-warning"
                                                   >Click To
                                                    Transfer Stock</button>
                                                  
                                                <?php
                                                            } else {
                                                                echo "stock transferred";
                                                            }
                                                            ?>
  </form>
                                            </td>






                                        </tr>
                                        <?php
                                                    $i++;
                                                }
                                            }
                                        }
                                        ?>
                                    </tbody>

                                </table>
                            </div>



                            <!-- /.card-header -->

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