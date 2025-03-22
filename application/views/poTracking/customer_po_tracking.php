<div style="width:100%" class="wrapper">
    <!-- Navbar -->

    <!-- /.navbar -->

    <!-- Main Sidebar Container -->


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Customer PO QTY Tracking</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('generate_po') ?>">Home</a></li>
                            <li class="breadcrumb-item active">Customer PO QTY Tracking</li>
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
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <form action="<?Php echo base_url('generate_customer_po_tracking') ?>" method="POST" enctype='multipart/form-data'>
                                                <label for="">Select Customer <span class="text-danger">*</span> </label>
                                                <select name="customer_id" required id="" class="form-control select2">
                                                    <?php
                                                    if ($customer_data) {
                                                        foreach ($customer_data as $p) {
                                                    ?>
                                                            <option value="<?php echo $p->id; ?>">
                                                                <?php echo $p->customer_name; ?>
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
                                            <label for="">Select Start PO Date <span class="text-danger">*</span> </label>
                                            <input type="date" value="<?php echo date('Y-m-d'); ?>" required name="po_start_date" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Select End Date </label>
                                            <input type="date" value="<?php echo date('Y-m-d'); ?>" required name="po_end_date" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Enter PO Number <span class="text-danger">*</span> </label>
                                            <input type="text" placeholder="Enter PO Number" required value="" name="po_number" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Enter PO Amendment No </label>
                                            <input type="number" step="any" placeholder="Enter Amendment PO number" value="" name="po_amedment_number" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Select PO Amendment Date </label>
                                            <input type="date" value="" name="po_amendment_date" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
										<div class="form-group">
                                            <label for="po_num">Upload PO</label>
                                            <input type="file" name="uploadedDoc" class="form-control" id="exampleuploadedDoc" placeholder="Upload PO" aria-describedby="uploadDocHelp">
											<?php echo form_error('uploadedDoc','<p class="help-block">','</p>'); ?>
										</div>
                                    </div>
                                </div>
								<div class="col-lg-2">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-danger mt-4">Generate</button>
                                        </div>
                                      </form>
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