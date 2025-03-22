<div class="wrapper" style="width:2400px">
    <?php  $role = trim($this->session->userdata['type']);
?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Supplier Parts (Item) Stock.</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Part Stocks</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div>
                <div class="row">
                    <div class="col-12">
                        <!-- /.card -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <a href="<?php echo base_url('download_stock_variance'); ?>" class="btn btn-info">Download Stock Variance </a>
                                </h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form action="<?php echo base_url('view_part_stocks') ?>" method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <div style="">
                                                <div class="form-group">
                                                    <label for="on click url">Select Part Number<span class="text-danger">*</span></label> <br>
                                                    <select name="part_id" id="selectPart" class="form-control select2" required id="">
                                                        <option value="">Select Part ID</option>
                                                        <?php
                                                        foreach ($supplier_part_select_list as $c) {
                                                        ?>
                                                            <option <?php if ($filter_part_id === $c->id) echo 'selected' ?> value="<?php echo $c->id ?>"><?php echo $c->part_number; ?>
                                                            </option>
                                                        <?php
                                                        }
                                                        ?>
                                                         <!-- <option value="ALL">ALL</option> -->
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

                                <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Part Number</th>
                                            <th>Part Description</th>
                                            <th>UOM</th>
                                            <th>Safety Buffer Stock</th>
                                            <th>Store Stock</th>
                                            <th>Subcon Stock</th>
                                            <th>Stock Reserve against Job order</th>
                                            <th>Production Rejection Stock</th>
                                            <th>Store Rejection Stock</th>
                                            <th>Production Stock</th>
                                            <th> Under Inspection Stock</th>
                                            <th>GRN Rejection Stock</th>
                                            <th>Store Rack Location</th>
                                            <th>Store Stock Rate</th>
                                            <th>Store Stock Value</th>
                                            <th>Production Stock</th>
                                            <th>Sharing Stock</th>
                                            <th>Machine Mold Stock</th>
                                            <th>Production Scrap</th>
                                            <th>Production Rejection</th>
                                            <th>Deflashing Location</th>
                                            <th>Transfer To FG</th>
                                        </tr>
                                    </thead>
                                    <!-- <tfoot>
                                        <th colspan="11"></th>
                                        <th colspan="2">Total Store Stock Value</th>
                                        <th colspan="2"><input type="number" readonly name="total_value" id="total_value_id" class="form-control">
                                        </th>
                                    </tfoot> -->
                                    <tbody>
                                        <?php

                                        $stock_column_name = $this->Unit->getStockColNmForClientUnit();
                                        
                                        //FOR SHEET ONLY
                                        $sheet_prod_column_name = $this->Unit->getProdColNmForClientUnit();

                                        //FOR PLASTIC ONLY
                                        $plastic_prod_column_name = $this->Unit->getPlasticProdColNmForClientUnit();

                                        //Sharing_qty
                                        $sharingQtyColName = $this->Unit->getSharingQtyColNmForClientUnit();

                                        $i = 1;
                                        if ($child_part_list) {
                                            foreach ($child_part_list as $po) {

                                                $stock = 0;
                                                $stock = $stock + $po->$stock_column_name;
                                                
                                                $uom_data = $this->Crud->get_data_by_id("uom", $po->uom_id, "id");
                                                $child_part_id = $this->Crud->get_data_by_id("part_type", $po->child_part_id, "id");
                                                $grn_details_data = $this->Crud->get_data_by_id("grn_details", $po->id, "part_id");
                                                $job_card_details = $this->Crud->get_data_by_id("job_card_details", $po->part_number, "item_number");

                                                $total_value += ($stock) * ($po->store_stock_rate);

                                                $store_scrap = 0;
                                                if ($job_card_details) {
                                                    foreach ($job_card_details  as $jd) {
                                                        $store_scrap = $store_scrap + $jd->store_reject_qty;
                                                    }
                                                }

                                                $store_stock = 0;
                                                $underinspection_stock = 0;
                                                $scrap_stock = 0;

                                                if ($grn_details_data) {
                                                    foreach ($grn_details_data as $d) {
                                                        $scrap_stock = $scrap_stock + $d->reject_qty;

                                                        if ($d->accept_qty == 0) {
                                                            $underinspection_stock = $underinspection_stock + $d->verified_qty;
                                                        } else {
                                                        }
                                                    }
                                                }
                                        ?>

                                                <tr>
                                                    <td><?php echo $po->id; ?></td>
                                                    <td><?php echo $po->part_number ?></td>
                                                    <td><?php echo $po->part_description ?></td>
                                                    <td><?php echo $uom_data[0]->uom_name ?></td>
                                                    <td class="<?php if ($po->safty_buffer_stk <= $stock) {
                                                                    echo "text-success";
                                                                } else {
                                                                    echo "text-danger";
                                                                } ?>">
                                                        <?php echo $po->safty_buffer_stk ?></td>
                                                        <td>
                                                        <?php if ($stock > 0) { ?>
                                                         <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#storeToStore<?php echo $i; ?>">
                                                         <?php echo $stock; ?>
                                                        </button>
                                                        <div class="modal fade" id="storeToStore<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Transfer Stock Store to Store
                                                                        </h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div class="col-lg-12">
                                                                                <form action="<?php echo base_url('transfer_child_store_to_store_stock') ?>" method="POST" enctype="multipart/form-data">
                                                                                    <label for="">Stock Qty <span class="text-danger">*</span>
                                                                                    </label>
                                                                                    <input type="number" step="any" class="form-control" value="" max="<?php echo $po->$stock_column_name; ?>" name="stock" required placeholder="Transfer Qty">
                                                                                    <input type="hidden" class="form-control" value="<?php echo $po->part_number; ?>" name="part_number" required>
                                                                                    <input type="hidden" class="form-control" value="<?php echo $po->id; ?>" name="child_part_id" required>
                                                                            </div>
                                                                            <div class="col-lg-12">
                                                                                <br>
                                                                                <label for="">Supplier Part no / Description </label>
                                                                                <select name="customer_part_number" required id="" class="form-control select2">
                                                                                 <option value="">Select Part</option>

                                                                                    <?php
                                                                                    if ($supplier_part_select_list) {
                                                                                        foreach ($supplier_part_select_list as $ccc) {
                                                                                            if ($filter_part_id!= $ccc->id) { //don't want to show same part in list..
                                                                                    ?>
                                                                                            <option value="<?php echo $ccc->id ?>">
                                                                                                 <?php echo $ccc->part_number."/".$ccc->part_description;  ?>
                                                                                            </option>
                                                                                    <?php
                                                                                           }
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
                                                    <?php } 
                                                        else echo $stock; 
                                                    ?>
                                                    </td>
                                                    <td><?php echo $po->sub_con_stock ?></td>
                                                    <td><?php echo $po->onhold_stock ?></td>
                                                    <td><?php echo $store_scrap ?></td>
                                                    <td><?php echo $po->rejection_stock ?></td>
                                                    <td><?php echo $po->rejection_prodcution_qty ?></td>

                                                    <td><?php echo $underinspection_stock ?></td>
                                                    <td><?php echo $scrap_stock ?></td>


                                                    <td><?php echo  $po->store_rack_location ?></td>
                                                    <td><?php echo  $po->store_stock_rate ?></td>

                                                    <td> <?php echo ($stock) * ($po->store_stock_rate) ?></td>
                                                    <td>
                                                        <?php
                                                        if ($po->$sheet_prod_column_name > 0) {
                                                        if($role == "Admin"){
                                                        ?>
                                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#prodToStore<?php echo $i; ?>">
                                                                <?php echo $po->$sheet_prod_column_name; ?>
                                                            </button>
                                                        <?php

                                                        } 
                                                    }else {
                                                            echo $po->$sheet_prod_column_name;
                                                        }
                                                        ?>
                                                        <div class="modal fade" id="prodToStore<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Transfer Production Stock to Store Stock
                                                                        </h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div class="col-lg-12">
                                                                                <form action="<?php echo base_url('update_production_qty_child_part_production_qty') ?>" method="POST" enctype="multipart/form-data">
                                                                                    <label for="">Production Qty <span class="text-danger">*</span>
                                                                                    </label>
                                                                                    <input type="number" step="any" class="form-control" value="" max="<?php echo $po->$sheet_prod_column_name; ?>" name="production_qty" min="1" required placeholder="Enter Transfer Qty">
                                                                                    <input type="hidden" class="form-control" value="<?php echo $po->part_number; ?>" name="part_number" required>
                                                                                    <input type="hidden" class="form-control" value="<?php echo $po->id; ?>" name="child_part_id" required>
                                                                            </div>
                                                                        </div>
                                                                       <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                            <button type="submit" class="btn btn-primary">Save
                                                                                changes</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    </td>
                                                    <td><?php echo $po->$sharingQtyColName ?></td>
                                                    <td>
                                                        <?php
                                                        if ($po->$plastic_prod_column_name > 0) {
                                                           if($role == "Admin"){
                                                        ?>
                                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#prodToStorePlastic<?php echo $i; ?>">
                                                                <?php echo $po->$plastic_prod_column_name; ?>
                                                            </button>
                                                        <?php
                                                            }
                                                        } else {
                                                            echo $po->$plastic_prod_column_name;
                                                        }
                                                        ?>
                                                        <!-- edit Plastic Modal -->
                                                        <div class="modal fade" id="prodToStorePlastic<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Transfer Production Qty to Store Stock
                                                                        </h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div class="col-lg-12">
                                                                                <form action="<?php echo base_url('update_production_qty_child_part') ?>" method="POST" enctype="multipart/form-data">
                                                                                    <label for="">Machine Mold Stock Qty <span class="text-danger">*</span>
                                                                                    </label>
                                                                                    <input type="number" step="any" class="form-control" value="" max="<?php echo $po->$plastic_prod_column_name; ?>" name="machine_mold_issue_stock" min="1" required placeholder="Enter Transfer Qty">
                                                                                    <input type="hidden" class="form-control" value="<?php echo $po->part_number; ?>" name="part_number" required >
                                                                                    <input type="hidden" class="form-control" value="<?php echo $po->id; ?>" name="child_part_id" required >
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                                            <button type="submit" class="btn btn-primary">Save</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    </td>
                                                    <td><?php echo $po->production_rejection ?></td>
                                                    <td><?php echo $po->production_scrap ?></td>
                                                    <td><?php echo $po->deflashing_stock ?></td>
                                                    <td>
                                                        <?php
                                                        $role = $this->session->userdata['type'];

                                                        if ($po->$stock_column_name > 0) {
                                                            if($role == "Admin" || $role="stores")
                                                            {

                                                        ?>
                                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#fgtransfer<?php echo $i; ?>">
                                                                Transfer FG Stock
                                                            </button>
                                                        <?php
                                                            }
                                                        } else {
                                                            echo $po->$stock_column_name;
                                                        }
                                                        ?>

                                                        <!-- FG Transfer Modal -->
                                                        <div class="modal fade" id="fgtransfer<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel"> Transfer Store Stock to FG Stock
                                                                        </h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>

                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div class="col-lg-12">

                                                                                <form action="<?php echo base_url('transfer_child_part_to_fg_stock') ?>" method="POST" enctype="multipart/form-data">
                                                                                    <label for="">Enter Stock Qty <span class="text-danger">*</span>
                                                                                    </label>
                                                                                    <input type="number" step="any" class="form-control" value="" max="<?php echo $po->$stock_column_name; ?>" name="stock" required placeholder="Enter Transfer Qty">
                                                                                    <input type="hidden" class="form-control" value="<?php echo $po->part_number; ?>" name="part_number" required>
                                                                                    <input type="hidden" class="form-control" value="<?php echo $po->id; ?>" name="child_part_id" required>
                                                                            </div>
                                                                            <div class="col-lg-12">
                                                                                <label for="">Select Customer Part Number /
                                                                                    Customer Name </label>
                                                                                <select name="customer_part_number" required id="" class="form-control select2">
                                                                                    <option value="">Select Part</option>
                                                                                    <?php
                                                                                    if ($customer_part_data_new_updated) {
                                                                                        foreach ($customer_part_data_new_updated as $ccc) {
                                                                                    ?>
                                                                                            <option value="<?php echo $ccc->part_number ?>">
                                                                                                <?php echo $ccc->part_number; ?>
                                                                                            </option>
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

    <!-- script>
        $(function() {
        //$("#total_value_id").val(<?php echo $total_value ?>);
        });
    </script -->