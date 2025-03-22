<?php
// Get the CodeIgniter super object
$CI = &get_instance();
// Load the model
$CI->load->model('SupplierParts');
?>

<div class="wrapper" >
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Stock Up</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                            <li class="breadcrumb-item active">Stock Up</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                </h3>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary float-left" data-toggle="modal" data-target="#exampleModal">
                                    Add Stock </button>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="<?php echo base_url('add_stock_up') ?>" method="POST" enctype='multipart/form-data'>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label for="po_num">Select Part Number / Description / Stock </label><span class="text-danger">*</span>
                                                            <select name="part_id" id="" class="from-control select2">
                                                                <?php
                                                                if ($child_part) {
                                                                    foreach ($child_part as $c) {
                                                                        $stock = $c->stock;
                                                                        if(empty($stock)){
                                                                            $stock = "0.00";
                                                                        }
                                                                ?>
                                                                    <option value="<?php echo $c->id ?>"><?php echo $c->part_number . "/" . $c->part_description . "/" . $stock; ?></option>
                                                                <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="po_num">Enter Reason <span class="text-danger">*</span></label>
                                                            <input type="text" name="reason" required placeholder="Enter Reason" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                        <label for="po_num">Upload document</label>
                                                            <input type="file" name="uploading_document"  class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="po_num">Enter Qty <span class="text-danger">*</span></label>
                                                            <input type="number" name="qty" step="any" placeholder="Enter Qty" name="qty" required class="form-control">
                                                        </div>
                                                     </div>
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
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Part Number / Description</th>
                                            <th>Qty</th>
                                            <th>UOM</th>
                                            <th>Stock Qty</th>
                                            <th>Reason</th>
                                            <th>Document</th>
                                            <th>Request Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        if ($stock_changes) {
                                            foreach ($stock_changes as $c) {
                                                 if ($c->type == "addition") {
                                                        $child_part_data = $this->SupplierParts->getSupplierPartById($c->part_id);
                                                        $uom_data = $this->Crud->get_data_by_id("uom", $child_part_data[0]->uom_id, "id");
                                                 ?>
                                                    <tr>
                                                        <td><?php echo $i ?></td>
                                                        <td><?php echo $child_part_data[0]->part_number . '/' . $child_part_data[0]->part_description; ?></td>
                                                        <td><?php echo $c->qty; ?></td>
                                                        <td><?php echo $uom_data[0]->uom_name ?></td>
                                                        <td><?php echo $child_part_data[0]->stock; ?></td>
                                                        <td><?php echo $c->reason; ?></td>
                                                        <td>
                                                            <?php 
                                                                if(!empty($c->uploading_document)) {
                                                            ?>
                                                                <a class="btn btn-dark" download href="<?php echo base_url('documents/') . $c->uploading_document ?>">Download</a>
                                                            <?php
                                                                }
                                                            ?>
                                                        </td>                                                      
                                                        <td><?php echo $c->created_date; ?></td>
                                                        <td>
                                                            <?php
                                                                if ($c->status == "pending") {
                                                            ?>
                                                                <a class="btn btn-warning" href="<?php echo base_url('add_stock/') . $c->id ?>">Click To Transfer Stock</a>
                                                            <?php
                                                                } else {
                                                                    echo "stock transferred";
                                                                }
                                                            ?>
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
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>