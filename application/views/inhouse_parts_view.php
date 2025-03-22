<div class="wrapper">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Item Master Inhouse Parts</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Item part List</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                </h3>
                            </div>
                            <div class="card-body">
                                <!-- <form action="<?php echo base_url('view_child_part_view_by_filter') ?>" method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div style="width: 400px;">
                                                <div class="form-group">
                                                    <label for="on click url">Select Part Number <span class="text-danger">*</span></label> <br>
                                                    <select name="child_part_id" class="form-control" id="">
                                                        <option <?php if ($filter_child_part_id === "All") ?> value="All">All</option>
                                                        <?php
                                                        foreach ($child_part_master as $c) {
                                                        ?>
                                                            <option <?php if ($filter_child_part_id === $c->id) echo 'selected' ?> value="<?php echo $c->id ?>"><?php echo $c->part_number; ?></option>
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
                                </form> -->
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Part Number</th>
                                            <th>Part Description</th>
                                            <th>Safety/buffer Stock</th>
                                            <th>HSN Code</th>
                                            <th>Store Rack Location</th>
                                            <th>UOM</th>
                                            <th>Update UOM</th>
                                            <th>Max PO QTY </th>
                                            <th>Stock Rate </th>
                                            <th>Weight</th>
                                            <th>Size</th>
                                            <th>Thickness</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        if ($child_part_master) {
                                            foreach ($child_part_master as $po) {
                                                /*
                                                TO-DO NOT SURE WHETHER WE NEED THIS OR NOT
                                                $child_part_data = $this->Crud->get_data_by_id("child_part", $po->part_number, "part_number");
                                                if (!empty($child_part_data)) {
                                                    $child_part_present = "yes";
                                                } else {
                                                    $child_part_present = "no";
                                                }*/
                                        ?>

                                        <tr>
                                            <td><?php echo $i ?></td>
                                            <td><?php echo $po->part_number ?></td>
                                            <td><?php echo $po->part_description ?></td>
                                            <td><?php echo $po->safty_buffer_stk ?></td>
                                            <td><?php echo $po->hsn_code ?></td>
                                            <td><?php echo $po->store_rack_location ?></td>
                                            <td><?php echo $po->uom_name ?></td>
                                            <td>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#edit<?php echo $i; ?>">
                                                    <i class='far fa-edit'></i>
                                                </button>
                                                <!-- edit Modal -->
                                                <div class="modal fade" id="edit<?php echo $i; ?>" tabindex="-1"
                                                    role="dialog" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Update
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <form
                                                                            action="<?php echo base_url('update_uom_report') ?>"
                                                                            method="POST" enctype="multipart/form-data">
                                                                            <div class="form-group">
                                                                                <label>Select UOM</label><span
                                                                                    class="text-danger">*</span>
                                                                                <input type="hidden" readonly
                                                                                    value="<?php echo $po->id ?>"
                                                                                    name="id" required
                                                                                    class="form-control"
                                                                                    id="exampleInputEmail1"
                                                                                    placeholder="Enter Safty/buffer stock"
                                                                                    aria-describedby="emailHelp">
                                                                                <input type="hidden" readonly
                                                                                    value="inhouse_parts"
                                                                                    name="table_id" required
                                                                                    class="form-control"
                                                                                    id="exampleInputEmail1"
                                                                                    placeholder="Enter Safty/buffer stock"
                                                                                    aria-describedby="emailHelp">
                                                                                <select class="form-control select2"
                                                                                    name="uom_id" style="width: 100%;">
                                                                                    <?php
                                                                                            foreach ($uom as $c) {
                                                                                            ?>
                                                                                    <option <?php if ($c->id == $po->uom_id) {
                                                                                                            echo "selected";
                                                                                                        } ?>
                                                                                        value="<?php echo $c->id; ?>">
                                                                                        <?php echo $c->uom_name; ?>
                                                                                    </option>
                                                                                    <?php
                                                                                            }
                                                                                            ?>
                                                                                </select>
                                                                            </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                    </div>
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
                                            </td>
                                            <td><?php echo $po->max_uom ?></td>
                                            <td><?php echo $po->store_stock_rate ?></td>
                                            <td><?php echo $po->weight ?></td>
                                            <td><?php echo $po->size ?></td>
                                            <td><?php echo $po->thickness ?></td>
                                            <td>
                                                <button type="submit" data-toggle="modal" class="btn btn-sm btn-primary"
                                                    data-target="#exampleModal2<?php echo $i ?>"> <i class="fas fa-edit"></i></button>
                                                <div class="modal fade" id="exampleModal2<?php echo $i ?>" role="dialog"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Update Details
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form
                                                                    action="<?php echo base_url('update_child_part_view_inhouse') ?>"
                                                                    method="POST">
                                                                    <div class="row">
                                                                        <div class="col-lg-12">
                                                                            <div class="form-group">
                                                                                <label for="part_number">Part
                                                                                    Number</label><span
                                                                                    class="text-danger">*</span>
                                                                                <input readonly type="text"
                                                                                    value="<?php echo  $po->part_number ?>"
                                                                                    name="part_number" required
                                                                                    class="form-control"
                                                                                    id="exampleInputEmail1"
                                                                                    aria-describedby="emailHelp"
                                                                                    placeholder="Part Number">
                                                                                <input type="hidden" name="id"
                                                                                    value="<?php echo  $po->id ?>">
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label for="Client_name">Part
                                                                                    Description</label><span
                                                                                    class="text-danger">*</span>
                                                                                <input type="text"
                                                                                    value="<?php echo   $po->part_description  ?>"
                                                                                    name="part_description" required
                                                                                    class="form-control"
                                                                                    id="exampleInputEmail1"
                                                                                    aria-describedby="emailHelp"
                                                                                    placeholder="Part Description">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="safty_buffer_stk">Safety
                                                                                    Buffer Stock</label><span
                                                                                    class="text-danger">*</span>
                                                                                <input type="text"
                                                                                    value="<?php echo   $po->safty_buffer_stk  ?>"
                                                                                    name="saft__stk" required
                                                                                    class="form-control"
                                                                                    id="exampleInputEmail1"
                                                                                    aria-describedby="emailHelp"
                                                                                    placeholder="Part Specification">
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label for="hsn_code">HSN
                                                                                    Code</label><span
                                                                                    class="text-danger">*</span>
                                                                                <input type="text"
                                                                                    value="<?php echo   $po->hsn_code  ?>"
                                                                                    name="hsn_code" required
                                                                                    class="form-control"
                                                                                    id="exampleInputEmail1"
                                                                                    aria-describedby="emailHelp"
                                                                                    placeholder="Part Specification">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="sub_type">Child Sub
                                                                                    Type</label><span
                                                                                    class="text-danger">*</span>
                                                                                <input readonly type="text"
                                                                                    value="<?php echo   $po->sub_type  ?>"
                                                                                    name="sub_type" required
                                                                                    class="form-control"
                                                                                    id="exampleInputEmail1"
                                                                                    aria-describedby="emailHelp"
                                                                                    placeholder="Part Specification">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="store_rack_location">Store
                                                                                    Rack Location</label><span
                                                                                    class="text-danger">*</span>
                                                                                <input type="text"
                                                                                    value="<?php echo   $po->store_rack_location  ?>"
                                                                                    name="store_rack_location" required
                                                                                    class="form-control"
                                                                                    id="exampleInputEmail1"
                                                                                    aria-describedby="emailHelp"
                                                                                    placeholder="Part Specification">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="UOM">UOM
                                                                                    Name</label><span
                                                                                    class="text-danger">*</span>
                                                                                <input readonly type="text"
                                                                                    value="<?php echo   $uom_data[0]->uom_name  ?>"
                                                                                    name="uom_name" required
                                                                                    class="form-control"
                                                                                    id="exampleInputEmail1"
                                                                                    aria-describedby="emailHelp"
                                                                                    placeholder="Part Specification">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="max_uom">Max
                                                                                    UOM</label><span
                                                                                    class="text-danger">*</span>
                                                                                <input type="text"
                                                                                    value="<?php echo   $po->max_uom  ?>"
                                                                                    name="max_uom" required
                                                                                    class="form-control"
                                                                                    id="exampleInputEmail1"
                                                                                    aria-describedby="emailHelp"
                                                                                    placeholder="Part Specification">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="max_uom">Store Stock
                                                                                    Rate</label><span
                                                                                    class="text-danger">*</span>
                                                                                <input type="text"
                                                                                    value="<?php echo   $po->store_stock_rate  ?>"
                                                                                    name="store_stock_rate" required
                                                                                    class="form-control"
                                                                                    id="exampleInputEmail1"
                                                                                    aria-describedby="emailHelp"
                                                                                    placeholder="Part Specification">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="max_uom">Weight</label><span
                                                                                    class="text-danger">*</span>
                                                                                <input type="text"
                                                                                    value="<?php echo   $po->weight  ?>"
                                                                                    name="weight" required
                                                                                    class="form-control"
                                                                                    id="exampleInputEmail1"
                                                                                    aria-describedby="emailHelp">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="max_uom">Size</label><span
                                                                                    class="text-danger">*</span>
                                                                                <input type="text"
                                                                                    value="<?php echo   $po->size  ?>"
                                                                                    name="size" class="form-control"
                                                                                    id="exampleInputEmail1"
                                                                                    aria-describedby="emailHelp">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label
                                                                                    for="max_uom">Thickness</label><span
                                                                                    class="text-danger">*</span>
                                                                                <input type="text"
                                                                                    value="<?php echo   $po->thickness  ?>"
                                                                                    name="thickness"
                                                                                    class="form-control"
                                                                                    id="exampleInputEmail1"
                                                                                    aria-describedby="emailHelp">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">Close</button>
                                                                        <button type="submit"
                                                                            class="btn btn-primary">Save
                                                                            changes</button>
                                                                    </div>
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
                      </div>
                 </div>
            </div>
        </section>
    </div>