<div class="wrapper">
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
                        <h1>Generate Customer Subcon Sales Invoice</h1>



                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('generate_po') ?>">Home</a></li>
                            <li class="breadcrumb-item active">New PO</li>
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
                                            <form action="<?Php echo base_url('generate_new_sales_subcon') ?>" method="POST">
                                                <label for="">Select Customer<span class="text-danger">*</span> </label>
                                                <select name="customer_id" required id="" class="form-control select2">
                                                    <?php
                                                    if ($customer) {
                                                        foreach ($customer as $s) {
                                                    ?>
                                                            <option value="<?php echo $s->id; ?>"><?php echo $s->customer_name; ?></option>
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
                                            <input type="date" value="<?php echo date('Y-m-d'); ?>" required name="po_date" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="">Select PO Number & Expired Date </label>
                                            <select name="expiry_po_date" id="" required class="select2 form-control">
                                                <?php
                                                if ($new_po) {
                                                    foreach ($new_po as $p) {
                                                ?>
                                                        <option value="<?php echo $p->po_number; ?>"><?php echo $p->po_number . " / " . $p->po_end_date; ?></option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Enter Remark </label>
                                            <input type="text" placeholder="Enter Remark" value="" name="remark" class="form-control">
                                        </div>
                                    </div>
                                    <div>
                                        &nbsp;
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Enter Mode Of Transport </label>
                                            <input type="text" placeholder="Enter Mode Of Transport" value="" name="mode" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Enter Transporter </label>
                                            <input type="text" placeholder="Enter Transporter" value="" name="transporter" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Enter Vehicle No. </label>
                                            <input type="text" placeholder="Enter Vehicle No" value="" name="vehicle_number" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Enter L.R No </label>
                                            <input type="text" placeholder="Enter L.R No" value="" name="lr_number" class="form-control">
                                        </div>
                                    </div>



                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-danger mt-4">Generate Sales Invoice</button>
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