<?php
    $isMultiClient = $this->session->userdata['isMultipleClientUnits'];
    $clintUnitId = $this->Unit->getSessionClientId();

    // Get the CodeIgniter super object
    $CI =& get_instance();
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
                        <h1>Material Transfer Requests</h1>
                        <?php 
                         $role = trim($this->session->userdata['type']);
                        ?>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                            <li class="breadcrumb-item active">Material Transfer Requests</li>
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
                                    New Request</button>
                                <?php }?>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Material Transfer Request</h5>
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
                                                            <label for="po_num">Select Part Number / Description
                                                                <?php if($isMultiClient == "true") { 
                                                                    ?>/ Stock 
                                                                <?php } ?>
                                                            </label><span class="text-danger">*</span>
                                                            <select name="part_id" required class="from-control select2">
                                                                <option value="">Select</option>
                                                                <?php
                                                                if ($child_part) {
                                                                    foreach ($child_part as $c) {
                                                                        if ($c->stock > 0 ) {
                                                                ?>
                                                                <option value="<?php echo $c->id ?>">
                                                                    <?php 
                                                                            echo $c->part_number . "/" . $c->part_description . "/" . $c->stock ; 
                                                                    ?>
                                                                </option>
                                                                <?php
                                                                        }
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <?php if($isMultiClient == "true") {  ?>
                                                            <div class="form-group">
                                                                    <label>Transfer From Unit</label><span class="text-danger">*</span><br>
                                                                    <select name="clientUnitFrom" id="clientIdFrom" required disabled class="form-control select2">
                                                                        <option value="">Select</option>
                                                                            <?php
                                                                            foreach ($client_list as $cl) {
                                                                            ?>
                                                                                <option value="<?php echo $cl->id."/".$cl->client_unit ?>"
                                                                                <?php if($clintUnitId == $cl->id ) { echo "selected"; }?>
                                                                                ><?php echo $cl->client_unit; ?>
                                                                                </option>
                                                                            <?php
                                                                            }
                                                                            ?>
                                                                    </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="po_num">Transfer To Unit<span
                                                                        class="text-danger">*</span></label>
                                                                <select name="clientUnitTo" id="clientIdTo" class="form-control select2">
                                                                </select>
                                                            </div>
                                                        <?php } else { ?>
                                                            <input type="hidden" name="type" value="stock" placeholder="Unit from" name="clientUnitFrom" required
                                                                class="form-control">
                                                            <input type="hidden" name="type" value="production_qty" placeholder="Unit to" name="clientUnitTo" required
                                                                class="form-control">
                                                        <?php } ?>
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
                                                     </div>
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save</button>
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
                                                $child_part_data = $this->SupplierParts->getSupplierPartOnlyById($c->part_id);
                                                $uom_data = $this->Crud->get_data_by_id("uom", $child_part_data[0]->uom_id, "id");
                                                if ($c->type == "minus") {
                                        ?>
                                        <tr>
                                            <td><?php echo $i ?></td>
                                            <td><?php echo $c->id ?></td>
                                            <td><?php echo $child_part_data[0]->part_number . '/' . $child_part_data[0]->part_description; ?></td>
                                            <td><?php echo $c->qty; ?></td>
                                            <td><?php echo $uom_data[0]->uom_name ?></td>
                                            <td><?php echo $c->reason; ?></td>
                                            <td>
                                                <?php
                                                    if (empty($c->uploading_document)) {
    
                                                    } else { ?>
                                                        <a class="btn btn-dark" download
                                                           href="<?php echo base_url('documents/') . $c->uploading_document ?>">Download</a>
                                                   <?php
                                                            }
                                                   ?>

                                            </td>
                                            <td><?php echo $c->created_date; ?></td>
                                            <td>
                                                <?php
                                                            if ($c->status == "pending") {
                                                            ?>
                                                                <a class="btn btn-warning"
                                                                    href="<?php echo base_url('remove_stock/') . $c->id ?>">Click To Transfer Stock</a>
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
    <script>
    $(document).ready(function() {
       // $("#clientIdFrom").change(function() {
        var client_id = $("#clientIdFrom").val();
        $.ajax({
            url: '<?php echo site_url("P_Molding/get_filtered_clientUnit"); ?>',
            type: "POST",
            data: {
                clientUnitFrom: client_id
            },
            cache: false,
            beforeSend: function() {},
            success: function(response) {
                if (response) {
                    $('#clientIdTo').html(response);
                } else {
                    $('#clientIdTo').html(response);
                }

            }
        });
   
    });
</script>