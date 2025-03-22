<?php
$entitlements = $this->session->userdata['entitlements'];

?>
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
                        <h1>Add Item</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Item part List</li>
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
                                <h3 class="card-title">

                                </h3>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary float-left" data-toggle="modal" data-target="#exampleModal">
                                    Add Direct Regular Item
                                </button>
                                <button type="button" class="btn btn-secondary float-left  ml-4" data-toggle="modal" data-target="#exampleModalsub">
                                    Add Direct Subcon Item
                                </button>
                                <button type="button" class="btn btn-dark float-left  ml-4" data-toggle="modal" data-target="#exampleModalsubregular">
                                    Add Direct Subcon Regular
                                </button>
                                <button type="button" class="btn btn-danger float-left ml-4" data-toggle="modal" data-target="#exampleModal2">
                                    Add Indirect Consumable Item</button>
                                <button type="button" class="btn btn-success float-left ml-4" data-toggle="modal" data-target="#exampleModal2Asset">
                                    Add Indirect Asset </button>
                                <button type="button" class="btn btn-warning float-left ml-4" data-toggle="modal" data-target="#exampleModal2Assetcustomerbom">
                                    Add Customer Bom Asset </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="<?php echo base_url('addchildpart') ?>" method="POST" enctype='multipart/form-data' s>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="po_num">Part Number</label><span class="text-danger">*</span>
                                                                <input type="text" name="part_number" required class="form-control" id="exampleInputEmail1" placeholder="Enter Part Number" aria-describedby="emailHelp">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="po_num">Part Description </label><span class="text-danger">*</span>
                                                                <input type="text" name="part_desc" required class="form-control" id="exampleInputEmail1" placeholder="Enter Part Description" aria-describedby="emailHelp">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="po_num">Safety/buffer stock </label><span class="text-danger">*</span>
                                                                <input type="text" name="safty_buffer_stk" required class="form-control" id="exampleInputEmail1" placeholder="Enter Saftey/buffer stock" aria-describedby="emailHelp">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="po_num">HSN Code</label>
                                                                <input type="text" name="hsn_code" class="form-control" id="hsn_code" placeholder="Enter HSN Code" aria-describedby="emailHelp">
                                                            </div>
                                                            <div class="form-group">
                                                                <label> Purchase Item Category </label><span class="text-danger">*</span>
                                                                <select class="form-control select2" name="sub_type" style="width: 100%;">
                                                                    <?php
                                                                    $type = $this->uri->segment('2');

                                                                    if ($type == "direct" || true) {
                                                                    ?>
                                                                        <option value="Regular grn">Regular grn</option>
                                                                        <option value="RM">RM</option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                            <?php
                                                            $type = $this->uri->segment('2');

                                                            if ($type != "direct") {
                                                            ?>
                                                                <div class="form-group">
                                                                    <label> Asset </label>
                                                                    <select class="form-control select2" name="asset" style="width: 100%;">
                                                                        <option value="NA">NA</option>
                                                                        <?php
                                                                        foreach ($asset as $a) {
                                                                        ?>
                                                                            <option value="<?php echo $a->id; ?>">
                                                                                <?php echo $a->name; ?></option>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            <?php } ?>


                                                            <div class="form-group">
                                                                <label for="po_num">Store Rack Location</label>
                                                                <input type="text" name="store_rack_location" class="form-control" id="exampleInputEmail1" placeholder="Enter Store Rack Location" aria-describedby="emailHelp">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="po_num">Store Stock Rate</label>
                                                                <input type="number" step="any" name="store_stock_rate" class="form-control" id="exampleInputEmail1" placeholder="Enter Store Stock Rate" aria-describedby="emailHelp">
                                                            </div>
                                                            <?php if($entitlements['isSheetMetal']!=null) { ?>
                                                                <div class="form-group">
                                                                    <label for="po_num">Weight</label>
                                                                    <input type="number" step="any" name="weight" class="form-control" id="exampleInputEmail1" placeholder="Enter Weight" aria-describedby="emailHelp">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="po_num">Size</label>
                                                                    <input type="text" step="any" name="size" class="form-control" id="exampleInputEmail1" placeholder="Enter Size" aria-describedby="emailHelp">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="po_num">Thickness</label>
                                                                    <input type="text" step="any" name="thickness" class="form-control" id="exampleInputEmail1" placeholder="Enter Thickness" aria-describedby="emailHelp">
                                                                </div>
                                                            <?php } ?>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label> UOM </label><span class="text-danger">*</span>
                                                                <select class="form-control select2" name="uom_id" style="width: 100%;">
                                                                    <?php
                                                                    foreach ($uom as $c1) {
                                                                    ?>
                                                                        <option value="<?php echo $c1->id; ?>">
                                                                            <?php echo $c1->uom_name; ?></option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="po_num">Max PO Quantity </label><span class="text-danger">*</span>
                                                                <input required type="number" step="any" name="max_uom" class="form-control" id="hsn_code" placeholder="Enter Max UOM" aria-describedby="emailHelp">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="po_num">Grade <span class="text-danger">*</span> </label>
                                                                <input type="text" name="grade" class="form-control" id="exampleInputEmail1" placeholder="Enter grade" aria-describedby="emailHelp">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save
                                                            changes</button>
                                                    </div>
                                            </div>
                                            </form>

                                        </div>

                                    </div>
                                </div>
                                <div class="modal fade" id="exampleModalsub" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="<?php echo base_url('addchildpart') ?>" method="POST" enctype='multipart/form-data' s>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="po_num">Part Number </label><span class="text-danger">*</span>
                                                                <input type="text" name="part_number" required class="form-control" id="exampleInputEmail1" placeholder="Enter Part Number" aria-describedby="emailHelp">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="po_num">Part Description </label><span class="text-danger">*</span>
                                                                <input type="text" name="part_desc" required class="form-control" id="exampleInputEmail1" placeholder="Enter Part Description" aria-describedby="emailHelp">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="po_num">Safety/buffer stock </label><span class="text-danger">*</span>
                                                                <input type="text" name="safty_buffer_stk" required class="form-control" id="exampleInputEmail1" placeholder="Enter Saftey/buffer stock" aria-describedby="emailHelp">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="po_num">HSN Code</label>
                                                                <input type="text" name="hsn_code" class="form-control" id="hsn_code" placeholder="Enter HSN Code" aria-describedby="emailHelp">
                                                            </div>
                                                            <div class="form-group">
                                                                <label> Purchase Item Category </label><span class="text-danger">*</span>
                                                                <select class="form-control select2" name="sub_type" style="width: 100%;">
                                                                    <?php
                                                                    $type = $this->uri->segment('2');
                                                                    if ($type == "direct" || true) { ?>
                                                                        <option value="Subcon grn">Subcon grn</option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                            <?php
                                                            $type = $this->uri->segment('2');

                                                            if ($type != "direct") {
                                                            ?>
                                                                <div class="form-group">
                                                                    <label> Asset </label>
                                                                    <select class="form-control select2" name="asset" style="width: 100%;">
                                                                        <option value="NA">NA</option>
                                                                        <?php
                                                                        foreach ($asset as $a) {
                                                                        ?>
                                                                            <option value="<?php echo $a->id; ?>">
                                                                                <?php echo $a->name; ?></option>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            <?php } ?>
                                                            <div class="form-group">
                                                                <label for="po_num">Store Rack Location</label>
                                                                <input type="text" name="store_rack_location" class="form-control" id="exampleInputEmail1" placeholder="Enter Store Rack Location" aria-describedby="emailHelp">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="po_num">Store Stock Rate</label>
                                                                <input type="number" step="any" name="store_stock_rate" class="form-control" id="exampleInputEmail1" placeholder="Enter Store Stock Rate" aria-describedby="emailHelp">
                                                            </div>
                                                            <?php if($entitlements['isSheetMetal']!=null) { ?>
                                                            <div class="form-group">
                                                                <label for="po_num">Weight</label>
                                                                <input type="number" step="any" name="weight" class="form-control" id="exampleInputEmail1" placeholder="Enter Weight" aria-describedby="emailHelp">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="po_num">Size</label>
                                                                <input type="text" step="any" name="size" class="form-control" id="exampleInputEmail1" placeholder="Enter Size" aria-describedby="emailHelp">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="po_num">Thickness</label>
                                                                <input type="text" step="any" name="thickness" class="form-control" id="exampleInputEmail1" placeholder="Enter Thickness" aria-describedby="emailHelp">
                                                            </div>
                                                            <?php } ?>
                                                        </div>
                                                        <div class="col-lg-6">
                                                             <div class="form-group">
                                                                <label> UOM </label><span class="text-danger">*</span>
                                                                <select class="form-control select2" name="uom_id" style="width: 100%;">
                                                                    <?php
                                                                    foreach ($uom as $c1) {
                                                                    ?>
                                                                        <option value="<?php echo $c1->id; ?>">
                                                                            <?php echo $c1->uom_name; ?></option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="po_num">Max Stock </label>
                                                                <input type="number" step="any" name="max_uom" class="form-control" id="hsn_code" placeholder="Enter Max UOM" aria-describedby="emailHelp">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="po_num">Grade <span class="text-danger">*</span> </label>
                                                                <input type="text" name="grade" class="form-control" id="exampleInputEmail1" placeholder="Enter grade" aria-describedby="emailHelp">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save
                                                            changes</button>
                                                    </div>
                                            </div>
                                            </form>

                                        </div>

                                    </div>
                                </div>
                                <div class="modal fade" id="exampleModalsubregular" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="<?php echo base_url('addchildpart') ?>" method="POST" enctype='multipart/form-data' s>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="po_num">Part Number </label><span class="text-danger">*</span>
                                                                <input type="text" name="part_number" required class="form-control" id="exampleInputEmail1" placeholder="Enter Part Number" aria-describedby="emailHelp">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="po_num">Part Description </label><span class="text-danger">*</span>
                                                                <input type="text" name="part_desc" required class="form-control" id="exampleInputEmail1" placeholder="Enter Part Description" aria-describedby="emailHelp">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="po_num">Safety/buffer stock </label><span class="text-danger">*</span>
                                                                <input type="text" name="safty_buffer_stk" required class="form-control" id="exampleInputEmail1" placeholder="Enter Saftey/buffer stock" aria-describedby="emailHelp">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="po_num">HSN Code</label>
                                                                <input type="text" name="hsn_code" class="form-control" id="hsn_code" placeholder="Enter HSN Code" aria-describedby="emailHelp">
                                                            </div>
                                                            <div class="form-group">
                                                                <label> Purchase Item Category </label><span class="text-danger">*</span>
                                                                <select class="form-control select2" name="sub_type" style="width: 100%;">
                                                                    <?php
                                                                    $type = $this->uri->segment('2');

                                                                    if ($type == "direct" || true) {
                                                                    ?>
                                                                        <option value="Subcon Regular">Subcon Regular</option>
                                                                    <?php } else {
                                                                    ?>

                                                                        <option value="consumable"><?php ?>consumable
                                                                        </option>
                                                                        <option value="asset"><?php ?>asset</option>

                                                                    <?php
                                                                    } ?>
                                                                </select>
                                                            </div>
                                                            <?php
                                                            $type = $this->uri->segment('2');

                                                            if ($type != "direct") {
                                                            ?>
                                                                <div class="form-group">
                                                                    <label> Asset </label>
                                                                    <select class="form-control select2" name="asset" style="width: 100%;">
                                                                        <option value="NA">NA</option>
                                                                        <?php
                                                                        foreach ($asset as $a) {
                                                                        ?>
                                                                            <option value="<?php echo $a->id; ?>">
                                                                                <?php echo $a->name; ?></option>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            <?php } ?>


                                                            <div class="form-group">
                                                                <label for="po_num">Store Rack Location</label>
                                                                <input type="text" name="store_rack_location" class="form-control" id="exampleInputEmail1" placeholder="Enter Store Rack Location" aria-describedby="emailHelp">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="po_num">Store Stock Rate</label>
                                                                <input type="number" step="any" name="store_stock_rate" class="form-control" id="exampleInputEmail1" placeholder="Enter Store Stock Rate" aria-describedby="emailHelp">
                                                            </div>
                                                            <?php if($entitlements['isSheetMetal']!=null) { ?>
                                                            <div class="form-group">
                                                                <label for="po_num">Weight</label>
                                                                <input type="number" step="any" name="weight" class="form-control" id="exampleInputEmail1" placeholder="Enter Weight" aria-describedby="emailHelp">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="po_num">Size</label>
                                                                <input type="text" step="any" name="size" class="form-control" id="exampleInputEmail1" placeholder="Enter Size" aria-describedby="emailHelp">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="po_num">Thickness</label>
                                                                <input type="text" step="any" name="thickness" class="form-control" id="exampleInputEmail1" placeholder="Enter Thickness" aria-describedby="emailHelp">
                                                            </div>
                                                            <?php } ?>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label> UOM </label><span class="text-danger">*</span>
                                                                <select class="form-control select2" name="uom_id" style="width: 100%;">
                                                                    <?php
                                                                    foreach ($uom as $c1) {
                                                                    ?>
                                                                        <option value="<?php echo $c1->id; ?>">
                                                                            <?php echo $c1->uom_name; ?></option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="po_num">Max Stock </label>
                                                                <input type="number" step="any" name="max_uom" class="form-control" id="hsn_code" placeholder="Enter Max UOM" aria-describedby="emailHelp">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="po_num">Grade <span class="text-danger">*</span> </label>
                                                                <input type="text" name="grade" class="form-control" id="exampleInputEmail1" placeholder="Enter grade" aria-describedby="emailHelp">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save
                                                            changes</button>
                                                    </div>
                                            </div>
                                            </form>

                                        </div>

                                    </div>
                                </div>
                                <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModal2" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="<?php echo base_url('addchildpart') ?>" method="POST" enctype='multipart/form-data' s>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                           <div class="form-group">
                                                                <label for="po_num">Part Number </label><span class="text-danger">*</span>
                                                                <input type="text" name="part_number" required class="form-control" id="exampleInputEmail1" placeholder="Enter Part Number" aria-describedby="emailHelp">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="po_num">Part Description </label><span class="text-danger">*</span>
                                                                <input type="text" name="part_desc" required class="form-control" id="exampleInputEmail1" placeholder="Enter Part Description" aria-describedby="emailHelp">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="po_num">Safety/buffer stock </label><span class="text-danger">*</span>
                                                                <input type="text" name="safty_buffer_stk" required class="form-control" id="exampleInputEmail1" placeholder="Enter Saftey/buffer stock" aria-describedby="emailHelp">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="po_num">HSN Code</label>
                                                                <input type="text" name="hsn_code" class="form-control" id="hsn_code" placeholder="Enter HSN Code" aria-describedby="emailHelp">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Purchase Item Category </label><span class="text-danger">*</span>
                                                                <select class="form-control select2" name="sub_type" style="width: 100%;">
                                                                    <?php
                                                                    $type = $this->uri->segment('2');
                                                                    ?>
                                                                        <option value="consumable"><?php ?>Consumable</option>

                                                                </select>
                                                            </div>
                                                            <?php
                                                            $type = $this->uri->segment('2');

                                                            if ($type != "direct" || true) {
                                                            ?>

                                                            <?php } ?>
                                                            <div class="form-group">
                                                                <label for="po_num">Store Rack Location</label>
                                                                <input type="text" name="store_rack_location" class="form-control" id="exampleInputEmail1" placeholder="Enter Store Rack Location" aria-describedby="emailHelp">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="po_num">Store Stock Rate</label>
                                                                <input type="number" step="any" name="store_stock_rate" class="form-control" id="exampleInputEmail1" placeholder="Enter Store Stock Rate" aria-describedby="emailHelp">
                                                            </div>
                                                            <?php if($entitlements['isSheetMetal']!=null) { ?>
                                                            <div class="form-group">
                                                                <label for="po_num">Weight</label>
                                                                <input type="number" step="any" name="weight" class="form-control" id="exampleInputEmail1" placeholder="Enter Weight" aria-describedby="emailHelp">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="po_num">Size</label>
                                                                <input type="text" step="any" name="size" class="form-control" id="exampleInputEmail1" placeholder="Enter Size" aria-describedby="emailHelp">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="po_num">Thickness</label>
                                                                <input type="text" step="any" name="thickness" class="form-control" id="exampleInputEmail1" placeholder="Enter Thickness" aria-describedby="emailHelp">
                                                            </div>
                                                            <?php } ?>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label> UOM </label><span class="text-danger">*</span>
                                                                <select class="form-control select2" name="uom_id" style="width: 100%;">
                                                                    <?php
                                                                    foreach ($uom as $c1) {
                                                                    ?>
                                                                        <option value="<?php echo $c1->id; ?>">
                                                                            <?php echo $c1->uom_name; ?></option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="po_num">Max Stock </label>
                                                                <input type="number" step="any" name="max_uom" class="form-control" id="hsn_code" placeholder="Enter Max UOM" aria-describedby="emailHelp">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="po_num">Grade <span class="text-danger">*</span> </label>
                                                                <input type="text" name="grade" class="form-control" id="exampleInputEmail1" placeholder="Enter grade" aria-describedby="emailHelp">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save
                                                            changes</button>
                                                    </div>
                                            </div>
                                            </form>

                                        </div>

                                    </div>
                                </div>
                                <div class="modal fade" id="exampleModal2Asset" tabindex="-1" role="dialog" aria-labelledby="exampleModal2" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="<?php echo base_url('addchildpart') ?>" method="POST" enctype='multipart/form-data' s>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="po_num">Part Number </label><span class="text-danger">*</span>
                                                                <input type="text" name="part_number" required class="form-control" id="exampleInputEmail1" placeholder="Enter Part Number" aria-describedby="emailHelp">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="po_num">Part Description </label><span class="text-danger">*</span>
                                                                <input type="text" name="part_desc" required class="form-control" id="exampleInputEmail1" placeholder="Enter Part Description" aria-describedby="emailHelp">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="po_num">Safety/buffer stock </label><span class="text-danger">*</span>
                                                                <input type="text" name="safty_buffer_stk" required class="form-control" id="exampleInputEmail1" placeholder="Enter Saftey/buffer stock" aria-describedby="emailHelp">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="po_num">HSN Code</label>
                                                                <input type="text" name="hsn_code" class="form-control" id="hsn_code" placeholder="Enter HSN Code" aria-describedby="emailHelp">
                                                            </div>
                                                            <div class="form-group">
                                                                <label> Purchase Item Category </label><span class="text-danger">*</span>

                                                                <select class="form-control select2" name="sub_type" style="width: 100%;">
                                                                    <?php
                                                                    $type = $this->uri->segment('2');

                                                                    if ($type == "direct" && false) {
                                                                    ?>
                                                                        <option value="Regular grn">Regular grn</option>
                                                                        <option value="Subcon grn">Subcon grn</option>
                                                                    <?php } else {
                                                                    ?>

                                                                        <option value="asset"><?php ?>asset</option>

                                                                    <?php
                                                                    } ?>
                                                                </select>
                                                            </div>
                                                            <?php
                                                            $type = $this->uri->segment('2');

                                                            if ($type != "direct" || true) {
                                                            ?>
                                                                <div class="form-group">
                                                                    <label> Asset </label>
                                                                    <select class="form-control select2" name="asset" style="width: 100%;">
                                                                        <option value="consumable">Consumable</option>
                                                                        <?php
                                                                        foreach ($asset as $a) {
                                                                        ?>
                                                                            <option value="<?php echo $a->id; ?>">
                                                                                <?php echo $a->name; ?></option>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>

                                                            <?php } ?>


                                                            <div class="form-group">
                                                                <label for="po_num">Store Rack Location</label>
                                                                <input type="text" name="store_rack_location" class="form-control" id="exampleInputEmail1" placeholder="Enter Store Rack Location" aria-describedby="emailHelp">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="po_num">Store Stock Rate</label>
                                                                <input type="number" step="any" name="store_stock_rate" class="form-control" id="exampleInputEmail1" placeholder="Enter Store Stock Rate" aria-describedby="emailHelp">
                                                            </div>

                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label> UOM </label><span class="text-danger">*</span>
                                                                <select class="form-control select2" name="uom_id" style="width: 100%;">
                                                                    <?php
                                                                    foreach ($uom as $c1) {
                                                                    ?>
                                                                        <option value="<?php echo $c1->id; ?>">
                                                                            <?php echo $c1->uom_name; ?></option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="po_num">Max Stock </label>
                                                                <input type="number" step="any" name="max_uom" class="form-control" id="hsn_code" placeholder="Enter Max UOM" aria-describedby="emailHelp">
                                                            </div>
                                                            <?php if($entitlements['isSheetMetal']!=null) { ?>
                                                            <div class="form-group">
                                                                <label for="po_num">Weight</label>
                                                                <input type="number" step="any" name="weight" class="form-control" id="exampleInputEmail1" placeholder="Enter Weight" aria-describedby="emailHelp">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="po_num">Size</label>
                                                                <input type="text" step="any" name="size" class="form-control" id="exampleInputEmail1" placeholder="Enter Size" aria-describedby="emailHelp">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="po_num">Thickness</label>
                                                                <input type="text" step="any" name="thickness" class="form-control" id="exampleInputEmail1" placeholder="Enter Thickness" aria-describedby="emailHelp">
                                                            </div>
                                                            <?php } ?>
                                                            <div class="form-group">
                                                                <label for="po_num">Grade <span class="text-danger">*</span> </label>
                                                                <input type="text" name="grade" class="form-control" id="exampleInputEmail1" placeholder="Enter grade" aria-describedby="emailHelp">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save
                                                            changes</button>
                                                    </div>
                                            </div>
                                            </form>

                                        </div>

                                    </div>
                                </div>
                                <div class="modal fade" id="exampleModal2Assetcustomerbom" tabindex="-1" role="dialog" aria-labelledby="exampleModal2" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="<?php echo base_url('addchildpart') ?>" method="POST" enctype='multipart/form-data' s>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="po_num">Part Number </label><span class="text-danger">*</span>
                                                                <input type="text" name="part_number" required class="form-control" id="exampleInputEmail1" placeholder="Enter Part Number" aria-describedby="emailHelp">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="po_num">Part Description </label><span class="text-danger">*</span>
                                                                <input type="text" name="part_desc" required class="form-control" id="exampleInputEmail1" placeholder="Enter Part Description" aria-describedby="emailHelp">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="po_num">Safety/buffer stock </label><span class="text-danger">*</span>
                                                                <input type="text" name="safty_buffer_stk" required class="form-control" id="exampleInputEmail1" placeholder="Enter Saftey/buffer stock" aria-describedby="emailHelp">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="po_num">HSN Code</label>
                                                                <input type="text" name="hsn_code" class="form-control" id="hsn_code" placeholder="Enter HSN Code" aria-describedby="emailHelp">
                                                            </div>
                                                            <div class="form-group">
                                                                <label> Purchase Item Category </label><span class="text-danger">*</span>

                                                                <select class="form-control select2" name="sub_type" style="width: 100%;">
                                                                    <?php
                                                                    $type = $this->uri->segment('2');

                                                                    if ($type == "direct" && false) {
                                                                    ?>
                                                                        <option value="Regular grn">Regular grn</option>
                                                                        <option value="Subcon grn">Subcon grn</option>
                                                                    <?php } else {
                                                                    ?>
                                                                        <option value="customer_bom"><?php ?>customer_bom</option>
                                                                    <?php
                                                                    } ?>
                                                                </select>
                                                            </div>
                                                            <?php
                                                            $type = $this->uri->segment('2');

                                                            if ($type != "direct" || true) {
                                                            ?>
                                                                <div class="form-group">
                                                                    <label> Asset </label>
                                                                    <select class="form-control select2" name="asset" style="width: 100%;">
                                                                        <option value="consumable">Consumable</option>

                                                                        <?php
                                                                        foreach ($asset as $a) {
                                                                        ?>
                                                                            <option value="<?php echo $a->id; ?>">
                                                                                <?php echo $a->name; ?></option>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>

                                                            <?php } ?>


                                                            <div class="form-group">
                                                                <label for="po_num">Store Rack Location</label>
                                                                <input type="text" name="store_rack_location" class="form-control" id="exampleInputEmail1" placeholder="Enter Store Rack Location" aria-describedby="emailHelp">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="po_num">Store Stock Rate</label>
                                                                <input type="number" step="any" name="store_stock_rate" class="form-control" id="exampleInputEmail1" placeholder="Enter Store Stock Rate" aria-describedby="emailHelp">
                                                            </div>

                                                        </div>
                                                        <div class="col-lg-6">
                                                              <div class="form-group">
                                                                <label> UOM </label><span class="text-danger">*</span>
                                                                <select class="form-control select2" name="uom_id" style="width: 100%;">
                                                                    <?php
                                                                    foreach ($uom as $c1) {
                                                                    ?>
                                                                        <option value="<?php echo $c1->id; ?>">
                                                                            <?php echo $c1->uom_name; ?></option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="po_num">Max Stock </label>
                                                                <input type="number" step="any" name="max_uom" class="form-control" id="hsn_code" placeholder="Enter Max UOM" aria-describedby="emailHelp">
                                                            </div>
                                                            <?php if($entitlements['isSheetMetal']!=null) { ?>
                                                            <div class="form-group">
                                                                <label for="po_num">Weight</label>
                                                                <input type="number" step="any" name="weight" class="form-control" id="exampleInputEmail1" placeholder="Enter Weight" aria-describedby="emailHelp">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="po_num">Size</label>
                                                                <input type="text" step="any" name="size" class="form-control" id="exampleInputEmail1" placeholder="Enter Size" aria-describedby="emailHelp">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="po_num">Thickness</label>
                                                                <input type="text" step="any" name="thickness" class="form-control" id="exampleInputEmail1" placeholder="Enter Thickness" aria-describedby="emailHelp">
                                                            </div>
                                                            <?php } ?>
                                                            <div class="form-group">
                                                                <label for="po_num">Grade <span class="text-danger">*</span> </label>
                                                                <input type="text" name="grade" class="form-control" id="exampleInputEmail1" placeholder="Enter grade" aria-describedby="emailHelp">
                                                            </div>
                                                    </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save
                                                            changes</button>
                                                    </div>
                                            </div>
                                            </form>

                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!-- /.card-header -->
                            <div class="card-body">

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