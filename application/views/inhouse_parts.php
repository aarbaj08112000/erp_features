<!-- Reviewed Manoj-->
<div class="wrapper">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add Inhouse Parts</h1>
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
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                </h3>
                                <button type="button" class="btn btn-primary float-left" data-toggle="modal"
                                    data-target="#exampleModal">
                                    Add Item
                                </button>
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="<?php echo base_url('add_inhouse_parts') ?>" method="POST"
                                                    enctype='multipart/form-data' s>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="po_num">Part Number</label><span
                                                                    class="text-danger">*</span>
                                                                <input type="text" name="part_number" required
                                                                    class="form-control" id="exampleInputEmail1"
                                                                    placeholder="Enter Part Number"
                                                                    aria-describedby="emailHelp">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="po_num">Part Description </label><span
                                                                    class="text-danger">*</span>
                                                                <input type="text" name="part_desc" required
                                                                    class="form-control" id="exampleInputEmail1"
                                                                    placeholder="Enter Part Description"
                                                                    aria-describedby="emailHelp">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="po_num">Safety/buffer stock </label><span
                                                                    class="text-danger">*</span>
                                                                <input type="text" name="safty_buffer_stk" required
                                                                    class="form-control" id="exampleInputEmail1"
                                                                    placeholder="Enter Saftey/buffer stock"
                                                                    aria-describedby="emailHelp">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="po_num">HSN Code</label>
                                                                <input type="text" name="hsn_code" class="form-control"
                                                                    id="hsn_code" placeholder="Enter HSN Code"
                                                                    aria-describedby="emailHelp">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="po_num">Store Rack Location</label>
                                                                <input type="text" name="store_rack_location"
                                                                    class="form-control" id="exampleInputEmail1"
                                                                    placeholder="Enter Store Rack Location"
                                                                    aria-describedby="emailHelp">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="po_num">Store Stock Rate</label>
                                                                <input type="number" step="any" name="store_stock_rate"
                                                                    class="form-control" id="exampleInputEmail1"
                                                                    placeholder="Enter Store Stock Rate"
                                                                    aria-describedby="emailHelp">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="po_num">Weight</label>
                                                                <input type="number" step="any" name="weight"
                                                                    class="form-control" id="exampleInputEmail1"
                                                                    placeholder="Enter Weight"
                                                                    aria-describedby="emailHelp">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="po_num">Size</label>
                                                                <input type="text" step="any" name="size"
                                                                    class="form-control" id="exampleInputEmail1"
                                                                    placeholder="Enter Size"
                                                                    aria-describedby="emailHelp">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="po_num">Thickness</label>
                                                                <input type="text" step="any" name="thickness"
                                                                    class="form-control" id="exampleInputEmail1"
                                                                    placeholder="Enter Thickness"
                                                                    aria-describedby="emailHelp">
                                                            </div>

                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label> UOM </label><span class="text-danger">*</span>
                                                                <select class="form-control select2" name="uom_id"
                                                                    style="width: 100%;">
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
                                                                <label for="po_num">Max PO Quantity </label><span
                                                                    class="text-danger">*</span>
                                                                <input required type="number" step="any" name="max_uom"
                                                                    class="form-control" id="hsn_code"
                                                                    placeholder="Enter Max UOM"
                                                                    aria-describedby="emailHelp">
                                                            </div>
                                                    </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save
                                                            changes</button>
                                                    </div>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
