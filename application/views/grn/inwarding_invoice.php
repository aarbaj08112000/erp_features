<?php
    $isMultiClient = $this->session->userdata['isMultipleClientUnits'];
?>
<div class="wrapper">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Inwarding PO Invoice Numbers</h1>
                    </div>
                    <!--<div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Inwarding</li>
                        </ol>
                    </div>-->
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
                                        <!-- Button trigger modal -->
                                        <?php
                                                $flag = 0;
                                                if ($po_parts) {
                                                    $final_po_amount = 0;
                                                    $i = 1;
                                                    foreach ($po_parts as $p) {
                                                        $child_part_data = $this->Crud->get_data_by_id("child_part_master", $p->part_id, "child_part_id");
                                                        $qty = 0;
                                                        $qty = $p->pending_qty;;
                                                        if (true) {
                                                            $flag = $flag + $qty;}
                                                        }
                                                    }
                                        if ($flag == 0) {
                                        ?>
                                            <hr><div class="alert-warning">
                                                <div class="alert">
                                                    Note: Can not add invoice number as all parts balance qty is zero.
                                                </div>
                                            </div>
                                            <a class="btn btn-dark" href="<?php echo base_url('inwarding'); ?>">
                                        < Back</a>

                                        <?php } else { ?>
                                        <a class="btn btn-dark" href="<?php echo base_url('inwarding'); ?>">
                                        < Back</a>
                                        <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#exampleModal">
                                                Add Invoice Number</button>
                                        <?php
                                        } ?>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog " role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Add Invoice Number</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="<?php echo base_url('add_invoice_number') ?>" method="POST">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="form-group">
                                                                        <label for="tool_number">Invoice Number </label><span class="text-danger">*</span>
                                                                        <input type="text" name="invoice_number" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Invoice Number">
                                                                        <input type="hidden" name="new_po_id" value="<?php echo $new_po_id ?>" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Invoice Number">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="tool_number">Invoice Date </label><span class="text-danger">*</span>
                                                                        <input type="date" name="invoice_date" max="<?php echo date("Y-m-d"); ?>" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Invoice Number">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="tool_number">GRN Date </label><span class="text-danger">*</span>
                                                                        <input type="date" name="grn_date" readonly value="<?php echo date("Y-m-d"); ?>" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Invoice Number">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="">Vehicle No.</label>
                                                                        <input type="text" 
                                                                        placeholder="Enter Vehicle No" 
                                                                        value="" 
                                                                        name="vehicle_number" 
                                                                        pattern="^([A-Z|a-z|0-9]{4,20})$"
                                                                        oninvalid="this.setCustomValidity('Please enter a valid vehicle number in the format XX00XX0000')" 
                                                                        onchange="this.setCustomValidity('')"
                                                                        class="form-control">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="tool_number">Transporter ID </label><span class="text-danger">*</span>
                                                                        <input type="text" name="transporter" value="" class="form-control" id="transporter" aria-describedby="emailHelp" placeholder="Enter transporter">
                                                                    </div>
                                                                    <!-- <php if($isMultiClient == "true") { ?>
                                                                        <div class="form-group">
                                                                                <label>Delivery Location</label><span class="text-danger">*</span><br>
                                                                                <select name="deliveryUnit" required class="form-control select2" id="">
                                                                                    <option value="">Select</option> 
                                                                                    <?php
                                                                                    foreach ($client_list as $cl) {
                                                                                    ?>
                                                                                        <option value="<?php echo $cl->client_unit ?>">
                                                                                                <?php echo $cl->client_unit; ?>
                                                                                        </option>
                                                                                    <?php
                                                                                    }
                                                                                    ?>
                                                                                </select>
                                                                        </div>
                                                                    <php } ?> -->
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
                                        </div>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <table id="example1" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Sr No</th>
                                                    <th>Invoice Number</th>
                                                    <th>Invoice Date</th>
                                                    <th>GRN Date</th>
                                                    <th>GRN Time</th>
                                                    <th>GRN Number </th>
                                                    <th>Vehicle No</th>
                                                    <th>Transporter</th>
                                                    <?php if($isMultiClient == "true") { ?>
                                                    <th>Delivery Location</th>
                                                    <?php } ?>
                                                    <th>View Details</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>Sr No</th>
                                                    <th>Invoice Number</th>
                                                    <th>Invoice Date</th>
                                                    <th>GRN Date</th>
                                                    <th>GRN Time</th>
                                                    <th>GRN Number </th>
                                                    <th>Vehicle No</th>
                                                    <th>Transporter</th>
                                                    <?php if($isMultiClient == "true") { ?>
                                                    <th>Delivery Location</th>
                                                    <?php } ?>
                                                    <th>View Details</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <?php
                                                $i = 1;
                                                if ($inwarding_data) {
                                                    foreach ($inwarding_data as $t) {
                                                        $grn_number = $t->grn_number;
                                                ?>

                                                        <tr>
                                                            <td><?php echo $i ?></td>
                                                            <td><?php echo $t->invoice_number ?></td>
                                                            <td><?php echo $t->invoice_date ?></td>
                                                            <td><?php echo $t->grn_date ?></td>
                                                            <?php
                                                                
                                                                if($t->created_dttm!=null){
                                                                    $dateTime = new DateTime($t->created_dttm);
                                                                    $time = $dateTime->format('H:i:s');
                                                                }else{
                                                                    $time = "Not available";
                                                                }
                                                            ?>
                                                            <td><?php echo $time ?></td>
                                                            <td><?php echo $grn_number ?></td>
                                                            <td><?php echo $t->vehicle_number ?></td>
                                                            <td><?php echo $t->transporter ?></td>
                                                            <?php if($isMultiClient == "true") { ?>
                                                                <td><?php echo $t->delivery_unit ?></td>
                                                            <?php } ?>
                                                            <td><a href="<?php echo base_url('inwarding_details/') . $t->id . "/" . $new_po_id ?>" class="btn btn-primary" href="">Inwarding Details</a></td>
                                                        </tr>
                                                <?php
                                                        $i++;
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="card-body">
                                        <table id="example1" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Sr No</th>
                                                    <th>Part Number</th>
                                                    <th>Part Description</th>
                                                    <th>Balance QTY </th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>Sr No</th>
                                                    <th>Part Number</th>
                                                    <th>Part Description</th>
                                                    <th>Balance QTY </th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <?php
                                                $flag = 0;
                                                if ($po_parts) {
                                                    $final_po_amount = 0;
                                                    $i = 1;
                                                    foreach ($po_parts as $p) {
                                                        $child_part_data = $this->Crud->get_data_by_id("child_part_master", $p->part_id, "child_part_id");
                                                        $qty = 0;
                                                        $qty = $p->pending_qty;;
                                                        if (true) {
                                                            $flag = $flag + $qty;
                                                ?>
                                                            <tr>
                                                                <td><?php echo $i; ?></td>
                                                                <td><?php echo $child_part_data[0]->part_number; ?></td>
                                                                <td><?php echo $child_part_data[0]->part_description; ?></td>
                                                                <td><?php echo $qty; ?></td>

                                                    <?php
                                                            $i++;
                                                        }
                                                    }
                                                } else ?>
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