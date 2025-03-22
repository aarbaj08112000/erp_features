<div style="width:100%" class="wrapper">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Report: Supplier Parts Stock</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Report</li>
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
                            <div class="card-body">
                            <form action="<?php echo base_url('parts_stock_report') ?>" method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <div style="">
                                                <div class="form-group">
                                                    <label for="on click url">Select Part Number<span class="text-danger">*</span></label> <br>
                                                    <select name="part_id" id="selectPart" class="form-control select2" required id="">
                                                        <option value="">Select Part ID</option>
                                                        <?php
                                                        foreach ($customer_part_data_new_updated2 as $c) {
                                                        ?>
                                                            <option <?php if ($filter_part_id === $c->id) echo 'selected' ?> value="<?php echo $c->id ?>"><?php echo $c->part_number; ?>
                                                            </option>
                                                        <?php
                                                        }
                                                        ?>
                                                         <option value="ALL">ALL</option> 
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <label for="">&nbsp;</label> <br>
                                            <button class="btn btn-secondary">Search </button>
                                        </div>
                                    </div>
                                </form>
                            </div>    
                            <div class="card-body">
                                
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Part Number</th>
                                            <th>Part Description</th>
                                            <th>UOM</th>
                                            <th>Store Stock</th>
                                            <th>Stock Rate</th>
                                            <th>Stock Value</th>
                                            <th>Inward Inspection QTY</th>
                                            <th>Prod QTY</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                                                               
                                        $i = 1;
                                        if ($customer_part_list) {
                                            foreach ($customer_part_list as $po) {
                                                $grn_details_data = $this->Crud->get_data_by_id("grn_details", $po->id, "part_id");
                                                $underinspection_stock = 0;
                                              

                                                if ($grn_details_data) {
                                                    foreach ($grn_details_data as $d) {
                                                        if ($d->accept_qty == 0) {
                                                            $underinspection_stock = $underinspection_stock + $d->verified_qty;
                                                        } else {
                                                        }
                                                    }
                                                }
                                                $uom_data = $this->Crud->get_data_by_id("uom", $po->uom_id, "id");
                                                ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $po->part_number ?></td>
                                                    <td><?php echo $po->part_description ?></td>
                                                    <td><?php echo $uom_data[0]->uom_name ?></td>
                                                    <td><?php echo $po->stock; ?></td>
                                                    <td><?php echo $po->store_stock_rate ?></td>
                                                    <td><?php echo ($po->stock) * ($po->store_stock_rate) ?></td>
                                                    <td><?php echo $underinspection_stock ?></td>
                                                    <td><?php echo $po->production_qty; ?></td>
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