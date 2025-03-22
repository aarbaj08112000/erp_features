<div class="wrapper" style="width:2300px">
<?php 
 $role = trim($this->session->userdata['type']);

?>
    <!-- done new fg stock -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Inhouse Parts (Item) Stock</h1>
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
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <a href="<?php echo base_url('download_stock_variance'); ?>"
                                        class="btn btn-info">Download Stock Variance </a>
                                </h3>
                            </div>
                            <div class="card-body">
                                <form action="<?php echo base_url('view_part_stocks_inhouse') ?>" method="POST"
                                    enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div style="width: 400px;">
                                                <div class="form-group">
                                                    <label for="on click url">Select Part Number<span
                                                            class="text-danger">*</span></label> <br>
                                                    <select name="part_id" class="form-control select2" id="">
                                                        <option value="">Select Part</option>
                                                        <!-- <option <?php if ($filter_part_id === "All") ?> value="All">All</option> -->
                                                        <?php
                                                            foreach ($customer_part_list as $c) {
                                                                ?>
                                                                <option <?php if ($filter_part_id === $c->id) echo 'selected' ?>
                                                                    value="<?php echo $c->id ?>"><?php echo $c->part_number; ?>
                                                                </option>
                                                        <?php
                                                            }
                                                        ?>
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
                                            <!-- <th>store_scrap</th> -->
                                            <th>Store Rejection Stock</th>
                                            <th>Production Rejection Stock</th>
                                            <th>Under Inspection Stock</th>
                                            <th>GRN Rejection Stock</th>
                                            <th>Store Rack Location</th>
                                            <th>Store Stock Rate</th>
                                            <th>Store Stock Value</th>
                                            <th>Production Stock</th>
                                            <th>Production Scrap</th>
                                            <th>Production Rejection</th>
                                            <th>Transfer to Fg</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <th colspan="11"></th>
                                        <th colspan="2">Total Store Stock Value</th>
                                        <th colspan="2"> <input type="number" readonly name="total_value"
                                                id="total_value_id" class="form-control">
                                        </th>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        if($filter_part_id) {
                                            if ($filtered_cust_part) {
                                                foreach ($filtered_cust_part as $po) {
                                                   
                                                    $stock = 0;
                                                    $stockColName = $this->Unit->getStockColNmForClientUnit();
                                                    $prodQtyColName = $this->Unit->getProdColNmForClientUnit();
                                                    $stock = $stock + $po->$stockColName;
                                                    
                                                    $uom_data = $this->Crud->get_data_by_id("uom", $po->uom_id, "id");
                                                    $grn_details_data = $this->Crud->get_data_by_id("grn_details", $po->id, "part_id");
                                                    
                                                    /*
                                                    Are we really using this store_scrap ?
                                                    $job_card_details = $this->Crud->get_data_by_id("job_card_details", $po->part_number, "item_number");

                                                    $total_value += ($stock) * ($po->store_stock_rate);

                                                    $store_scrap = 0;
                                                    if ($job_card_details) {
                                                        foreach ($job_card_details  as $jd) {
                                                            $store_scrap = $store_scrap + $jd->store_reject_qty;
                                                        }
                                                    } */

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

                                                    $color = "";
                                                    $child_part_data = $this->Crud->get_data_by_id("child_part", $po->part_number, "part_number");
                                                    if (!empty($child_part_data)) {
                                                        $child_part_present = "yes";
                                                    } else {
                                                        $child_part_present = "no";
                                                    }
                                            ?>
                                            <tr>
                                                <td><?php echo $po->id;?></td>
                                                <td><?php echo $po->part_number ?></td>
                                                <td><?php echo $po->part_description ?></td>
                                                <td><?php echo $uom_data[0]->uom_name ?></td>
                                                <td><?php echo $po->safty_buffer_stk ?></td>
                                                <td class="<?php if ($po->safty_buffer_stk <= $stock) {
                                                                        echo "text-success";
                                                                    } else {
                                                                        echo "text-danger";
                                                                    } ?>"><?php echo $stock ?></td>
                                                <td><?php echo $po->sub_con_stock ?></td>
                                                <td><?php echo $po->onhold_stock ?></td>
                                                <!-- <td><?php echo $store_scrap ?></td> -->
                                                <td><?php echo $po->rejection_stock ?></td>
                                                <td><?php echo $po->rejection_prodcution_qty ?></td>
                                                <td><?php echo $underinspection_stock ?></td>
                                                <td><?php echo $scrap_stock ?></td>
                                                <td><?php echo  $po->store_rack_location ?></td>
                                                <td><?php echo  $po->store_stock_rate ?></td>
                                                <td><?php echo ($stock) * ($po->store_stock_rate) ?></td>
                                                <td>
                                                    <?php
                                                            if ($child_part_present == "yes") {
                                                                if ($po->$prodQtyColName > 0) {
                                                                        if($role == "Admin" || $role == "production" ) {
                                                                                ?>
                                                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                                                            data-target="#edit<?php echo $i; ?>">
                                                                            <?php echo $po->$prodQtyColName; ?>
                                                                        </button>
                                                                        <div class="modal fade" id="edit<?php echo $i; ?>" tabindex="-1"
                                                                            role="dialog" aria-labelledby="exampleModalLabel"
                                                                            aria-hidden="true">
                                                                            <div class="modal-dialog" role="document">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title" id="exampleModalLabel">Transfer
                                                                                            Production stock to store stock
                                                                                        </h5>
                                                                                        <button type="button" class="close" data-dismiss="modal"
                                                                                            aria-label="Close">
                                                                                            <span aria-hidden="true">&times;</span>
                                                                                        </button>
                                                                                    </div>

                                                                                    <div class="modal-body">
                                                                                        <div class="row">
                                                                                            <div class="col-lg-12">
                                                                                                <form
                                                                                                    action="<?php echo base_url('update_production_qty') ?>"
                                                                                                    method="POST" enctype="multipart/form-data">
                                                                                                    <label for="">Production Qty <span
                                                                                                            class="text-danger">*</span>
                                                                                                    </label>
                                                                                                    <input type="number" step="any" class="form-control"
                                                                                                        value=""
                                                                                                        max="<?php echo $po->$prodQtyColName; ?>"
                                                                                                        name="production_qty" min="1" required
                                                                                                        placeholder="Enter Transfer Qty">
                                                                                                    <input type="hidden" class="form-control"
                                                                                                        value="<?php echo $po->part_number; ?>"
                                                                                                        name="part_number" required
                                                                                                        placeholder="Enter Transfer Qty">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <button type="button" class="btn btn-secondary"
                                                                                                data-dismiss="modal">Close</button>
                                                                                            <button type="submit" class="btn btn-primary">Save
                                                                                                changes</button>
                                                                                            </form>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        <?php
                                                                        }
                                                                } else {
                                                                    echo $po->$prodQtyColName;
                                                                }
                                                            } else {
                                                                echo $po->$prodQtyColName;
                                                            }
                                                            ?>
                                                </td>
                                                <td><?php echo $po->production_rejection ?></td>
                                                <td><?php echo $po->production_scrap ?></td>
                                                <td>
                                                    <?php

                                                           if ($po->$prodQtyColName > 0) {
                                                                if($role == "Admin" || $role == "production"){

                                                            ?>
                                                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                                                    data-target="#fgtransfer<?php echo $i; ?>">
                                                                    Transfer to FG
                                                                </button>
                                                                <div class="modal fade" id="fgtransfer<?php echo $i; ?>" tabindex="-1"
                                                                        role="dialog" aria-labelledby="exampleModalLabel"
                                                                        aria-hidden="true">
                                                                        <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title" id="exampleModalLabel">Transfer
                                                                                        Production QTY to FG
                                                                                    </h5>
                                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                                        aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <div class="row">
                                                                                        <div class="col-lg-12">
                                                                                            <form
                                                                                                action="<?php echo base_url('transfer_child_part_to_fg_stock_inhouse') ?>"
                                                                                                method="POST" enctype="multipart/form-data">
                                                                                                <label for="">Enter Stock Qty <span
                                                                                                        class="text-danger">*</span>
                                                                                                </label>
                                                                                                <input type="number" step="any"
                                                                                                    class="form-control" value=""
                                                                                                    max="<?php echo $po->$prodQtyColName; ?>"
                                                                                                    name="stock" required
                                                                                                    placeholder="Enter Transfer Qty">
                                                                                                <input type="hidden" class="form-control"
                                                                                                    value="<?php echo $po->part_number; ?>"
                                                                                                    name="part_number" required
                                                                                                    placeholder="Enter Transfer Qty">
                                                                                                <input type="hidden" class="form-control"
                                                                                                    value="<?php echo $po->id; ?>"
                                                                                                    name="child_part_id" required
                                                                                                    placeholder="Enter Transfer Qty">
                                                                                        </div>
                                                                                        <div class="col-lg-12">
                                                                                            <label for=""><br>Select Customer Part Number /
                                                                                                Customer Name </label>
                                                                                            <select name="customer_part_number" required
                                                                                                id="" class="form-control select2">
                                                                                                <option value="">Select Part</option>
                                                                                                <?php
                                                                                                        if ($transfer_part_list) {
                                                                                                            foreach ($transfer_part_list as $t) {
                                                                                                        ?>
                                                                                                <option
                                                                                                    value="<?php echo $t->part_number ?>">
                                                                                                    <?php echo $t->part_number ?></option>
                                                                                                <?php
                                                                                                            }
                                                                                                        }
                                                                                                        ?>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="button"  class="btn btn-secondary" data-dismiss="modal"
                                                                                            aria-label="Close">Close</button>
                                                                                        <button type="submit" class="btn btn-primary">Save
                                                                                            changes</button>
                                                                                        </form>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                <?php
                                                                }
                                                            } else {
                                                                echo $po->$prodQtyColName;
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
    <script>
    $(function() {
        $("#total_value_id").val(<?php echo $total_value ?>);
    });
    </script>