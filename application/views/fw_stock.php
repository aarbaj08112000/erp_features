<div class="wrapper">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>FG Stocks</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">FW Stocks</li>
                        </ol>
                    </div>
                </div>
            </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                </h3>
                            </div>
                            <div class="card-header">
                                    <div class="row">
                                            <div class="col-lg-3">
                                                <form action="<?php echo base_url('fw_stock');?>" method="post">
                                                                    <div class="form-group">
                                                                        <label for="">Select Part <span class="text-danger">*</span></label>
                                                                <select class="form-control select2" name="part_id">
                                                                            <?php 
                                                                            if($customer_parts)
                                                                            {
                                                                                foreach($customer_parts as $c)
                                                                                {
                                                                                    ?>
                                                                                    <option value="<?php echo $c->id?>"><?php echo $c->part_number;?></option>
                                                                                    <?Php
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                            </div>
                                            <div class="form-group mt-4">
                                                <button type="submit" class="btn btn-danger mt-1">
                                                    Search
                                                </button>
                                            </form>  
                                        </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Part Number</th>
                                            <th>Part Description</th>
                                            <th>Stock</th>
                                            <th>Molding Production Qty</th>
                                            <th>Production Rejection</th>
                                            <th>Production Scrap</th>
                                            <!--<th>Semi Finished Location</th>
                                             <th>Deflashing Assembly</th> -->
                                            <th>Final Inspection Location</th>
                                            <th>Transfer To Inhouse Part</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        if ($customer_parts_master) {
                                            foreach ($customer_parts_master as $po) {
                                        ?>

                                                <tr>
                                                    <td><?php echo $i ?></td>
                                                    <td><?php echo $po->part_number ?></td>
                                                    <td><?php echo $po->part_description ?></td>
                                                    <td><?php echo $po->fg_stock; ?></td>
                                                    <td><?php echo $po->molding_production_qty; ?></td>
                                                    <td><?php echo $po->production_rejection; ?></td>
                                                    <td><?php echo $po->production_scrap; ?></td>
                                                    <!-- <td><?php echo $po->semi_finished_location; ?></td> -->
                                                    <!-- <td><?php echo $po->deflashing_assembly_location; ?></td>-->
                                                    <td><?php echo $po->final_inspection_location; ?></td>
                                                    <td>
                                                        <?php
                                                        if ($po->fg_stock > 0) {

                                                        ?>
                                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#fgtransfer222<?php echo $i; ?>">
                                                                Transfer To Inhouse
                                                            </button>
                                                        <?php
                                                        } else {
                                                            echo $po->fg_stock;
                                                        }
                                                        ?>
                                                        <div class="modal fade" id="fgtransfer222<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Transfer
                                                                            FG Stock to Inhouse Production Stock
                                                                        </h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div class="col-lg-12">
                                                                                <form action="<?php echo base_url('transfer_fg_stock_to_inhouse_stock') ?>" method="POST" enctype="multipart/form-data">
                                                                                    <label for="">Enter Stock Qty <span class="text-danger">*</span>
                                                                                    </label>
                                                                                    <input type="number" step="any" class="form-control" value="" max="<?php echo $po->stock; ?>" name="stock" required placeholder="Enter Transfer Qty">
                                                                                    <input type="hidden" class="form-control" value="<?php echo $po->part_number; ?>" name="part_number" required placeholder="Enter Transfer Qty">
                                                                                    <input type="hidden" class="form-control" value="<?php echo $po->id; ?>" name="customer_parts_master_id" required placeholder="Enter Transfer Qty">
                                                                            </div>
                                                                            <div class="col-lg-12">
                                                                                <label for="">Select Inhouse Part Number
                                                                                </label>
                                                                                <select name="inhouse_part_number" required id="" class="form-control select2">
                                                                                    <?php
                                                                                    if ($inhouse_parts) {
                                                                                        foreach ($inhouse_parts as $tt) {
                                                                                    ?>
                                                                                            <option value="<?php echo $tt->part_number ?>">
                                                                                                <?php echo $tt->part_number ?></option>
                                                                                    <?php
                                                                                        }
                                                                                    }
                                                                                    ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-second     data-dismiss=" modal">Close</button>
                                                                            <button type="submit" class="btn btn-primary">Save
                                                                                changes</button>
                                                                            </form>
                                                                        </div>
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