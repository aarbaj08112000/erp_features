<?php
// Get the CodeIgniter super object
$CI = &get_instance();

// Load the model
$CI->load->model('InhouseParts');

$entitlements = $this->session->userdata['entitlements'];
?>
<div class="wrapper" style="width:2500px">
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
                        <h1>Customer Part </h1>
                    </div>
                    <div class="col-sm-6">
                        <!-- <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                            <li class="breadcrumb-item active">Customer Part</li>
                        </ol> -->
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
                                    <div class="col-lg-1">
                                        <a href="<?php echo base_url('customer_master'); ?>" class="btn btn-dark ">
                                            < Back </a>
                                    </div>
                                    <div class="col-lg-1">
                                        <button type="button" class="btn btn-primary float-left" data-toggle="modal" data-target="#exampleAddModal">Add</button>
                                    </div>
                                </div>
                            </div>
                            <!-- Add Modal -->
                            <div class="modal fade" id="exampleAddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add Customer Part</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="<?php echo base_url('addcustomerpart') ?>" method="POST" enctype='multipart/form-data'>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label for="">Select Part <span class="text-danger">*</span></label>
                                                            <select name="customer_parts_master_id" required id="" class="form-control select2">
                                                                <?php
                                                                if ($customer_parts_master) {
                                                                    foreach ($customer_parts_master as $c) {
                                                                ?>
                                                                        <option value="<?php echo $c->id ?>"><?php echo $c->part_number . " / " . $c->part_description ?></option>
                                                                <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="po_num">HSN Code </label>
                                                            <input type="text" name="hsn_code" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                                        </div>
                                                        <div class="form-group">
                                                            <label> Part Family </label><span class="text-danger">*</span>
                                                            <select readonly class="form-control select2" name="part_family" style="width: 100%;">
                                                                <?php
                                                                if ($part_family) {
                                                                    foreach ($part_family as $p) {
                                                                ?>
                                                                        <option value="<?php echo $p->name ?>">
                                                                            <?php echo $p->name; ?></option>
                                                                <?php
                                                                    }
                                                                }
                                                                ?>
                                                                <!-- <option value="HOSE">HOSE Assembly</option>
                                                                <option value="NYLON">NYLON Assembly</option>
                                                                <option value="METAL">METAL Assembly</option>
                                                                <option value="HYBRID">HYBRID Assembly</option>
                                                                <option value="Bought Out Family">Bought Out Family </option> -->
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label> Select Tax Structure </label><span class="text-danger">*</span>
                                                            <select class="form-control select2" name="gst_id" style="width: 100%;">
                                                                <?php
                                                                foreach ($gst_structure as $c) {
                                                                ?>
                                                                    <option value="<?php echo $c->id; ?>">
                                                                        <?php echo $c->code; ?></option>
                                                                <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label> UOM </label><span class="text-danger">*</span>
                                                            <select readonly class="form-control select2" name="uom" style="width: 100%;">
                                                                <?php
                                                                foreach ($uom as $c) {
                                                                    if (true) {
                                                                ?>
                                                                        <option value="<?php echo $c->uom_name; ?>">
                                                                            <?php echo $c->uom_name; ?> - <?php echo $c->uom_description; ?></option>
                                                                <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="po_num">Packaging QTY </label><span class="text-danger">*</span>
                                                            <input type="number" min="0" step="1" name="packaging_qty" required class="form-control" id="packaging_quantity">
                                                        </div>
                                                        <!-- <div class="form-group">
                                                            <label for="po_num">UOM </label><span class="text-danger">*</span>
                                                            <input type="text" name="uom" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                                        </div> -->
                                                        <div class="form-group">
                                                            <label for="po_num">Safety Stock </label><span class="text-danger">*</span>
                                                            <input type="number" name="safety_stock" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                                        </div>

                                                        <!-- <div class="form-group">
                                                            <label for="po_num">Revision Number </label><span class="text-danger">*</span>
                                                            <input type="text" name="revision_no" required class="form-control" id="exampleInputEmail1" placeholder="Enter Safty/buffer stock" aria-describedby="emailHelp">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="po_num">Revision Date</label><span class="text-danger">*</span>
                                                            <input type="date" name="revision_date" required class="form-control" id="exampleInputEmail1" placeholder="Enter Part Rate" aria-describedby="emailHelp">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="po_num">Revision Remark</label><span class="text-danger">*</span>
                                                            <input type="date" name="revision_remark" required class="form-control" id="exampleInputEmail1" placeholder="Enter Part Rate" aria-describedby="emailHelp">
                                                        </div> -->
                                                        <div class="form-group">
                                                            <label> Customer List </label><span class="text-danger">*</span>
                                                            <select readonly class="form-control select2" name="customer_id" style="width: 100%;">
                                                                <?php
                                                                foreach ($customers as $c) {
                                                                    if ($customer_id == $c->id) {
                                                                ?>
                                                                        <option <?php if ($customer_id == $c->id) {
                                                                                    echo "selected";
                                                                                } ?> value="<?php echo $c->id; ?>">
                                                                            <?php echo $c->customer_name; ?></option>
                                                                <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <?php if ($entitlements['isPlastic'] != null) { ?>
                                                            <div class="form-group">
                                                                <label for="po_num">Gross weight (gram) <span class="text-danger">*</span></label>
                                                                <input type="number" required step="any" name="gross_weight" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="po_num">Finish weight (gram) <span class="text-danger">*</span></label>
                                                                <input type="number" required step="any" name="finish_weight" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="po_num">Runner weight (gram) <span class="text-danger">*</span></label>
                                                                <input type="number" required step="any" name="runner_weight" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="po_num">Cycle Time <span class="text-danger">*</span></label>
                                                                <input type="number" required step="any" name="cycyle_time" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="po_num">Production Target Per Shift <span class="text-danger">*</span></label>
                                                                <input type="number" required step="any" name="production_target_per_shift" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                                            </div>
                                                        <?php } ?>
                                                        <?php if ($entitlements['isSheetMetal'] != null) { ?>
                                                            <div class="form-group">
                                                                <label for="po_num">RM Grade<span class="text-danger">*</span></label>
                                                                <input type="text" required name="rm_grade" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                                            </div>
                                                            <!-- added for Tushar -->
                                                            <?php if ($TusharEngg) { ?>
                                                                <div class="form-group">
                                                                    <label for="thickness">Thickness<span class="text-danger">*</span></label>
                                                                    <input type="number" step="any" required name="thickness" class="form-control" id="thickness" aria-describedby="thicknessHelp">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="passivationType">Passivation Type<span class="text-danger">*</span></label>
                                                                    <input type="text" required name="passivationType" class="form-control" id="passivationType" aria-describedby="passivationTypeHelp">
                                                                </div>
                                                        <?php }
                                                        } ?>
                                                        <!-- end added for Tushar -->
                                                        <div class="form-group">
                                                            <label> Select Type </label><span class="text-danger">*</span>
                                                            <select class="form-control select2" name="type" style="width: 100%;">
                                                                <option value="standard_po">Standard PO</option>
                                                                <option value="subcon_po">Subcon Po</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Is Service </label><span class="text-danger">*</span>
                                                            <select class="form-control select2" required name="isservice" style="width: 100%;">
                                                                <option value="">Select</option>
                                                                <option value="Y">YES</option>
                                                                <option value="N">NO</option>
                                                            </select>
                                                        </div>
                                                        <%if ($entitlements['itemCode']!=null && $entitlements['itemCode']==true) %>
                                                            <div class="form-group">
                                                                    <label for="itemCode">Item Code</label>
                                                                    <input type="text" name="itemCd" class="form-control" id="itemCodeId" aria-describedby="itemCodeHelp">
                                                            </div>
                                                        <%/if%>


                                                    </div>
                                                    <div class="col-lg-6">
                                                    </div>
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
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Add Production</th>
                                            <!-- <th>Add Revision</th> -->
                                            <!-- <th>Revision Number</th>
                                            <th>Revision Date</th>
                                            <th>Revision Remark</th> -->
                                            <th>Customer Name</th>
                                            <th>Part Number</th>
                                            <th>Part Description</th>
                                            <th>PO Type</th>
                                            <th>Part Family</th>
                                            <th>Tax Structure</th>
                                            <th>UOM</th>
                                            <th>Packaging QTY</th>
                                            <th>HSN</th>
                                            <th>Safety Stock</th>
                                            <?php if ($entitlements['isPlastic'] != null) { ?>
                                                <th>Gross Weight (gram)</th>
                                                <th>Finish Weight(gram)</th>
                                                <th>Runner Weight(gram)</th>
                                                <th>Cycyle time(sec)</th>
                                                <th>Production target per shift</th>
                                            <?php } ?>
                                            <?php if ($entitlements['isSheetMetal'] != null) { ?>
                                                <th>RM Grade</th>
                                                <?php if ($TusharEngg) { ?>
                                                    <th>Thickness</th>
                                                    <th>Passivation Type</th>
                                            <?php }
                                            } ?>
                                            <th>Is Service</th>
                                            <%if ($entitlements['itemCode']!=null && $entitlements['itemCode']==true) %>
                                                <th>Item Code</th>
                                            <%/if%>

                                            <th>Update</th>
                                            <th>Drawing Parameters</th>
                                            <!-- <th>BOM</th>
                                            <th>Drawing</th>
                                            <th>Model</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        if ($customer_part_list) {
                                            $customer_data = $this->Crud->get_data_by_id("customer", $customer_part_list[0]->customer_id, "id");
                                            foreach ($customer_part_list as $poo) {
                                                $po = $this->Crud->get_data_by_id("customer_part", $poo->id, "id");
                                                $customer_part_data = $this->Crud->get_data_by_id("customer_part_type", $po[0]->customer_part_id, "id");
                                                $gst_structure2 = $this->Crud->get_data_by_id("gst_structure", $po[0]->gst_id, "id");
                                        ?>
                                                <tr>
                                                    <td><?php echo $i ?></td>
                                                    <td>
                                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addPromo">
                                                            Add Production Qty
                                                        </button>
                                                        <div class="modal fade" id="addPromo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Add</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="form-group">
                                                                            <form action="<?php echo base_url('add_production_qty') ?>" method="POST" enctype="multipart/form-data">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label required for="on click url">Select Shift Type
                                                                                / Name / Start Time /
                                                                                End Time<span class="text-danger">*</span></label>
                                                                            <select name="shift_id" name="" id="" class="form-control select2">
                                                                                <?php
                                                                                if ($shifts) {
                                                                                    foreach ($shifts as $s) {
                                                                                ?>
                                                                                        <option value="<?php echo $s->id ?>">
                                                                                            <?php echo $s->shift_type . " / " . $s->name . " / " . $s->start_time . " / " . $s->end_time; ?>
                                                                                        </option>
                                                                                <?php
                                                                                    }
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="on click url">Select Operator<span class="text-danger">*</span></label>
                                                                            <select required name="operator_id" id="" class="form-control select2">
                                                                                <?php
                                                                                if ($operator) {
                                                                                    foreach ($operator as $s) {
                                                                                ?>
                                                                                        <option value="<?php echo $s->id ?>">
                                                                                            <?php echo $s->name; ?></option>
                                                                                <?php
                                                                                    }
                                                                                }
                                                                                ?>
                                                                            </select>


                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="on click url">Select Machine<span class="text-danger">*</span></label>
                                                                            <select required name="machine_id" id="" class="form-control select2">
                                                                                <?php
                                                                                if ($machine) {
                                                                                    foreach ($machine as $s) {
                                                                                ?>
                                                                                        <option value="<?php echo $s->id ?>">
                                                                                            <?php echo $s->name; ?></option>
                                                                                <?php
                                                                                    }
                                                                                }
                                                                                ?>
                                                                            </select>


                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="on click url">Select Inhouse Part /
                                                                                Customer Part<span class="text-danger">*</span></label>
                                                                            <select required name="output_part_id" id="" class="form-control select2">
                                                                                <?php
                                                                                if ($operations_bom) {
                                                                                    foreach ($operations_bom as $s) {
                                                                                        if ($s->customer_part_number == $po[0]->part_number) {
                                                                                            if ($s->output_part_table_name == "inhouse_parts") {
                                                                                                $output_part_data = $this->InhouseParts->getInhousePartOnlyById($s->output_part_id);
                                                                                            } else {

                                                                                                $output_part_data = $this->Crud->get_data_by_id("customer_part", $s->output_part_id, "id");
                                                                                            }

                                                                                            // if (!empty($operations_bom_data)) {

                                                                                            $operations_bom_inputs_data = $this->Crud->get_data_by_id("operations_bom_inputs", $s->id, "operations_bom_id");

                                                                                            if (!empty($operations_bom_inputs_data)) {



                                                                                ?>
                                                                                                <option value="<?php echo $s->id ?>">
                                                                                                    <?php echo $s->customer_part_number . "/" . $output_part_data[0]->part_number . " / " . $output_part_data[0]->part_description . " / " . $s->customer_part_number . " / " . $s->id; ?>
                                                                                                </option>
                                                                                <?php
                                                                                            }
                                                                                            // }
                                                                                        }
                                                                                    }
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="on click url">Enter QTY<span class="text-danger">*</span></label>
                                                                            <input type="number" min="1" value="1" name="qty" required class="form-control">


                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="on click url">Enter Date
                                                                                <span class="text-danger">*</span></label>
                                                                            <input max="<?php echo date("Y-m-d"); ?>" type="date" value="<?php echo date('Y-m-d'); ?>" name="date" required class="form-control">
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

                                                    <td><?php echo $customer_data[0]->customer_name ?></td>
                                                    <td><?php echo $po[0]->part_number ?></td>
                                                    <td><?php echo $po[0]->part_description ?></td>
                                                    <td><?php echo $po[0]->type ?></td>

                                                    <td><?php echo $po[0]->part_family ?></td>
                                                    <td><?php echo $gst_structure2[0]->code ?></td>
                                                    <td><?php echo $po[0]->uom ?></td>
                                                    <td><?php echo $po[0]->packaging_qty ?></td>
                                                    <td><?php echo $po[0]->hsn_code ?></td>
                                                    <td><?php echo $po[0]->safety_stock ?></td>
                                                    <?php if ($entitlements['isPlastic'] != null) { ?>
                                                        <td><?php echo $po[0]->gross_weight ?></td>
                                                        <td><?php echo $po[0]->finish_weight ?></td>
                                                        <td><?php echo $po[0]->runner_weight ?></td>
                                                        <td><?php echo $po[0]->cycyle_time ?></td>
                                                        <td><?php echo $po[0]->production_target_per_shift ?></td>
                                                    <?php } ?>
                                                    <?php if ($entitlements['isSheetMetal'] != null) { ?>
                                                        <td><?php echo $po[0]->rm_grade ?></td>
                                                        <?php if ($TusharEngg) { ?>
                                                            <td><?php echo $po[0]->thickness ?></td>
                                                            <td><?php echo $po[0]->passivationType ?></td>
                                                    <?php }
                                                    } ?>
                                                    <td><?php if ($po[0]->isservice == 'Y') {
                                                            echo 'YES';
                                                        } else {
                                                            echo 'NO';
                                                        } ?></td>
                                                         <%if ($entitlements['itemCode']!=null && $entitlements['itemCode']==true) %>
                                                       <td><%$po[0]->itemCode %></td>
                                                    <%/if%>

                                                    <td>
                                                        <button type="submit" data-toggle="modal" class="btn btn-sm btn-primary" data-target="#exampleModaledit2333<?php echo $i ?>"> <i class="fas fa-edit"></i></button>
                                                        <!-- <a href="<?php echo base_url(); ?>" class="btn btn-sm btn-primary">
                                                            <i class="fas fa-history"></i>

                                                        </a> -->

                                                        <div class="modal fade" id="exampleModaledit2333<?php echo $i ?>" tabindex=" -1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog " role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Update Part Details
                                                                        </h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form action="<?php echo base_url('updatecustomerpart_new') ?>" method="POST" enctype='multipart/form-data'>
                                                                            <div class="row">
                                                                                <div class="col-lg-12">
                                                                                    <input value="<?php echo $po[0]->id ?>" type="hidden" name="id" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Customer Name">
                                                                                    <div class="form-group">
                                                                                        <label for="po_num">Part Description<span class="text-danger">*</span>
                                                                                        </label>
                                                                                        <input type="text" name="upart_description" required class="form-control" id="upart_description" value="<?php echo $po[0]->part_description  ?>" aria-describedby="partDescriptionHelp">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label>Select Type </label><span class="text-danger">*</span>
                                                                                        <select class="form-control select2" name="type" style="width: 100%;">
                                                                                            <option value="standard_po" <?php if ($po[0]->type == 'standard_po') {
                                                                                                                            echo "selected";
                                                                                                                        } ?>>Standard PO</option>
                                                                                            <option value="subcon_po" <?php if ($po[0]->type == 'subcon_po') {
                                                                                                                            echo "selected";
                                                                                                                        } ?>>Subcon Po</option>
                                                                                        </select>
                                                                                    </div>

                                                                                    <div class="form-group">
                                                                                        <label> Part Family </label><span class="text-danger">*</span>
                                                                                        <select readonly class="form-control select2" name="part_family" style="width: 100%;">
                                                                                            <?php
                                                                                            if ($part_family) {
                                                                                                foreach ($part_family as $p) {
                                                                                            ?>
                                                                                                    <option value="<?php echo $p->name ?>">
                                                                                                        <?php echo $p->name; ?></option>
                                                                                            <?php
                                                                                                }
                                                                                            }
                                                                                            ?>

                                                                                        </select>
                                                                                    </div>
                                                                                    <?php if ($entitlements['isPlastic'] != null) { ?>
                                                                                        <div class="form-group">
                                                                                            <label for="po_num">Gross weight (gram) <span class="text-danger">*</span></label>
                                                                                            <input type="number" required step="any" name="gross_weight" class="form-control" id="exampleInputEmail1" value="<?php echo $po[0]->gross_weight  ?>" aria-describedby="emailHelp">
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label for="po_num">Finish weight (gram) <span class="text-danger">*</span></label>
                                                                                            <input type="number" required step="any" name="finish_weight" class="form-control" id="exampleInputEmail1" value="<?php echo $po[0]->finish_weight  ?>" aria-describedby="emailHelp">
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label for="po_num">Runner weight (gram) <span class="text-danger">*</span></label>
                                                                                            <input type="number" required step="any" name="runner_weight" class="form-control" id="exampleInputEmail1" value="<?php echo $po[0]->runner_weight  ?>" aria-describedby="emailHelp">
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label for="po_num">Cycle Time <span class="text-danger">*</span></label>
                                                                                            <input type="number" required step="any" name="cycyle_time" class="form-control" id="exampleInputEmail1" value="<?php echo $po[0]->cycyle_time  ?>" aria-describedby="emailHelp">
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label for="po_num">Production Target Per Shift <span class="text-danger">*</span></label>
                                                                                            <input type="number" required step="any" name="production_target_per_shift" class="form-control" id="exampleInputEmail1" value="<?php echo $po[0]->production_target_per_shift  ?>" aria-describedby="emailHelp">
                                                                                        </div>
                                                                                    <?php } ?>
                                                                                    <div class="form-group">
                                                                                        <label for="po_num">RM Grade <span class="text-danger">*</span></label>
                                                                                        <input type="text" required name="rm_grade" class="form-control" id="exampleInputEmail1" value="<?php echo $po[0]->rm_grade  ?>" aria-describedby="emailHelp">
                                                                                    </div>
                                                                                    <!-- added for Tushar -->
                                                                                    <?php if ($TusharEngg) { ?>
                                                                                        <div class="form-group">
                                                                                            <label for="thickness">Thickness<span class="text-danger">*</span></label>
                                                                                            <input type="number" step="any" required name="thickness" class="form-control" id="thickness" value="<?php echo $po[0]->thickness  ?>" aria-describedby="thicknessHelp">
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label for="passivationType">Passivation Type<span class="text-danger">*</span></label>
                                                                                            <input type="text" required name="passivationType" class="form-control" id="passivationType" value="<?php echo $po[0]->passivationType  ?>" aria-describedby="passivationTypeHelp">
                                                                                        </div>
                                                                                    <?php } ?>
                                                                                    <!-- end added for Tushar -->
                                                                                    <div class="form-group">
                                                                                        <label for="safety_stock">Safety/buffer stock
                                                                                        </label><span class="text-danger">*</span>
                                                                                        <input type="text" value="<?php echo $po[0]->safety_stock  ?>" name="safety_stock" required class="form-control" id="exampleInputEmail1" placeholder="Enter Safety/buffer stock">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="hsn_code">HSN
                                                                                            Code</label><span class="text-danger">*</span>
                                                                                        <input type="text" value="<?php echo $po[0]->hsn_code  ?>" name="hsn_code" required class="form-control" id="exampleInputEmail1" placeholder="Enter Safety/buffer stock">
                                                                                        <input type="hidden" value="<?php echo $po[0]->id  ?>" name="id" required class="form-control" id="exampleInputEmail1" placeholder="Enter Safety/buffer stock">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label> Select Tax Structure
                                                                                        </label><span class="text-danger">*</span>
                                                                                        <select class="form-control select2" name="gst_id" style="width: 100%;">
                                                                                            <?php
                                                                                            foreach ($gst_structure as $c) {
                                                                                            ?>
                                                                                                <option <?php if ($c->id == $gst_structure2[0]->id) {
                                                                                                            echo "selected";
                                                                                                        } ?> value="<?php echo $c->id; ?>">
                                                                                                    <?php echo $c->code; ?></option>
                                                                                            <?php
                                                                                            }
                                                                                            ?>
                                                                                        </select>
                                                                                    </div>

                                                                                    <div class="form-group">
                                                                                        <label> UOM </label><span class="text-danger">*</span>
                                                                                        <select class="form-control select2" readonly name="uom" style="width: 100%;">
                                                                                            <?php
                                                                                            foreach ($uom as $c1) {
                                                                                            ?>
                                                                                                <option <?php
                                                                                                        if ($c1->uom_name == $po[0]->uom) {
                                                                                                            echo "selected";
                                                                                                        }
                                                                                                        ?> value="<?php echo $c1->uom_name; ?>">
                                                                                                    <?php echo $c1->uom_name; ?>
                                                                                                </option>
                                                                                            <?php
                                                                                            }
                                                                                            ?>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="po_num">Packaging QTY </label><span class="text-danger">*</span>
                                                                                        <input type="number" min="0" step="1" name="packaging_qty" value="<?php echo $po[0]->packaging_qty ?>" required class="form-control" id="packaging_quantity">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label>Is Service </label><span class="text-danger">*</span>
                                                                                        <select class="form-control select2" required name="isservice" style="width: 100%;">
                                                                                            <option value="">Select Is-Service</option>
                                                                                            <option value="Y" <?php if ($po[0]->isservice == 'Y') {
                                                                                                                    echo "selected";
                                                                                                                } ?>>YES</option>
                                                                                            <option value="N" <?php if ($po[0]->isservice == 'N') {
                                                                                                                    echo "selected";
                                                                                                                } ?>>NO</option>

                                                                                        </select>
                                                                                    </div>
                                                                                    <%if ($entitlements['itemCode']!=null && $entitlements['itemCode']==true) %>
                                                                                            <div class="form-group">
                                                                                                    <label for="itemCode">Item Code</label>
                                                                                                    <input type="text" name="itemCd" value="<%$po[0]->itemCode %>" class="form-control" id="itemCodeId" aria-describedby="itemCodeHelp">
                                                                                            </div>
                                                                                        <%/if%>

                                                                                </div>
                                                                                <div class="col-lg-6">
                                                                                </div>
                                                                            </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary">Save
                                                                            changes</button>
                                                                    </div>
                                                                    </form>
                                                                </div>

                                                            </div>
                                                        </div>
                            </div>

                            </td>
                            <td>
                                <a class="btn btn-primary" href="<?php echo base_url('view_inspection_parm_details/') . $customer_data[0]->id . '/' . $poo->id ?>">
                                    <i class='far fa-eye'></i>
                                </a>
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