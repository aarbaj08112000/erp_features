<div style="width:100%" class="wrapper">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('generate_po') ?>">Home</a></li>
                            <li class="breadcrumb-item active">New PO</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">

                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <form action="<?Php echo base_url('generate_new_po') ?>" method="POST">
                                                <label for="">Select Supplier / Number / GST <span class="text-danger">*</span> </label>
                                                <select name="supplier_id" required id="" class="form-control select2">
                                                    <?php
                                                    if ($supplier) {
                                                        foreach ($supplier as $s) {
                                                    ?>
                                                            <option value="<?php echo $s->id; ?>"><?php echo $s->supplier_name . ' / ' . $s->gst_number . ' / ' . $s->supplier_number; ?></option>
                                                    <?php

                                                        }
                                                    }

                                                    ?>
                                                </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Select PO Date <span class="text-danger">*</span> </label>
                                            <input type="date" readonly value="<?php echo date('Y-m-d'); ?>" required name="po_date" class="form-control">
                                            <input type="hidden" readonly value="1" required name="process_id" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Select Expiry Date </label>
                                            <input type="date" min="<?php echo date("Y-m-d", strtotime("+ 1 day")); ?>" required name="expiry_po_date" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Enter Remark </label>
                                            <input type="text" placeholder="Enter Remark" value="" name="remark" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label for="">Billing Address <span class="text-danger">*</span> </label>
                                            <select name="billing_address" required id="" class="form-control select2">
                                            <option value="">Select</option>
                                                <?php foreach($client as $cli) { ?>
                                                    <option value="<?php echo $cli->billing_address; ?>">
                                                        <?php echo $cli->client_unit." / ".$cli->billing_address; ?></option>
                                                <?php }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label for="">Shipping Address <span class="text-danger">*</span></label>
                                            <select name="shipping_address" required class="form-control select2">
                                            <option value="">Select</option>
                                                <?php foreach($client as $cli) { ?>
                                                    <option value="<?php echo $cli->shifting_address; ?>">
                                                        <?php echo $cli->client_unit." / ".$cli->shifting_address; ?>
                                                    </option>
                                                <?php }
                                                if ($supplier) {
                                                    foreach ($supplier as $s) {
                                                ?>
                                                    <option value="<?php echo $s->location; ?>">
                                                        <?php echo $s->supplier_name." / ".$s->location; ?>
                                                    </option>
                                                <?php

                                                    }
                                                }

                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-danger mt-4">Generate PO</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
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