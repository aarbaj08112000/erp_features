<div  class="wrapper">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
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
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <form action="<?Php echo base_url('generate_new_po') ?>" method="POST">
                                                <label for="">Supplier / Number / GST <span class="text-danger">*</span> </label>
                                                <select name="supplier_id" required id="" class="form-control select2">
                                                    <?php
                                                    if ($supplier) {
                                                        foreach ($supplier as $s) {
                                                    ?>
                                                            <option value="<?php echo $s->id; ?>">
                                                                <?php echo $s->supplier_name . ' / ' . $s->gst_number . ' / ' . $s->supplier_number; ?>
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
                                            <label for="">PO Date</label>
                                            <input type="date" readonly value="<?php echo date('Y-m-d'); ?>" required name="po_date" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Expiry Date <span class="text-danger">*</span> </label>
                                            <input type="date" min="<?php echo date("Y-m-d", strtotime("+ 1 day")); ?>" required name="expiry_po_date" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Remark </label>
                                            <input type="text" placeholder="Enter Remark" value="" name="remark" class="form-control">
                                        </div>
                                    </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="">Loading Unloading Amount <span class="text-danger">*</span> </label>
                                            <input type="number" required step="any" placeholder="Enter Loading Unloading" value="" name="loading_unloading" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                                <label for="">Loading Unloading Tax Strucutre <span class="text-danger">*</span> </label>
                                                <select name="loading_unloading_gst" required id="" class="form-control select2">
                                                    <option value="0">NA</option>
                                                    <?php
                                                    if ($gst_structure) {
                                                        foreach ($gst_structure as $s) {
                                                    ?>
                                                            <option value="<?php echo $s->id; ?>"><?php echo $s->code; ?>
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
                                            <label for="">Freight Amount <span class="text-danger">*</span> </label>
                                            <input type="number" step="any" required placeholder="Enter Loading Unloading" value="" name="freight_amount" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                                <label for="">Freight Tax Strucutre <span class="text-danger">*</span> </label>
                                                <select name="freight_amount_gst" required id="" class="form-control select2">
                                                    <option value="0">NA</option>

                                                    <?php
                                                    if ($gst_structure) {
                                                        foreach ($gst_structure as $s) {
                                                    ?>
                                                            <option value="<?php echo $s->id; ?>"><?php echo $s->code; ?>
                                                            </option>
                                                    <?php

                                                        }
                                                    }

                                                    ?>
                                                </select>
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
                                    <div class="col-lg-8">
                                        <div class="form-group">
                                            <label for="">Notes </label>
                                            <textarea height="5em" name="notes" class="form-control">1.PDIR & MTC Required with each lot. Pls mention PO No. on Invoice.<br>
2.Rejection if any will be debited to suppliers account<br>
3. Inspection & Testing Requirements as per Customer drawing/ standard/ quality plan will be done at your end and reports will share to us.<br>
<b> G. S. T.: </b> GST Extra. <br>
<b> Delivery :</b>   Door Delivery. <br>
<b> Validity :</b>  30 Days from date of purchase order
                                            </textarea>
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