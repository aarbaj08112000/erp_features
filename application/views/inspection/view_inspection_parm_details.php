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
                    <h1>Drawing Parameters<br></h1><br>
                </div>
                <div class="row mb-2">
                    <h1><br></h1><br>
                </div>
                <div class="row mb-2">
                    <div class="col-sm-1">
                        <a style="marign-right:" class="btn btn-danger" href="<?php echo base_url('customer_part') . '/' . $customer_id; ?>">
                            < Back</a>
                    </div>
                    <div class="col-sm-1">
                        <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#exampleModal">
                            Add </button>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <!-- <h1></h1> -->
                        <form action="<?php echo base_url('') ?>" method="POST">
                            <!-- Button trigger modal -->
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="po_num">Part Number </label><span class="text-danger">*</span>
                                        <input type="text" readonly value="<?php echo $customer_part[0]->part_number ?>" name="part_number" required class="form-control" id="exampleInputEmail1" placeholder="Enter Part Number" aria-describedby="emailHelp">
                                    </div>

                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="po_num">Part Description </label><span class="text-danger">*</span>
                                        <input type="text" readonly value="<?php echo $customer_part[0]->part_description ?>" name="part_desc" required class="form-control" id="exampleInputEmail1" placeholder="Enter Part Description" aria-describedby="emailHelp">
                                    </div>
                                </div>
                            </div>
                        </form>

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

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Cancel">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="<?php echo base_url('add_inspection_parm_details') ?>" method="POST">
                                                    <div class="col-lg-12">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label> Parameter </label><span class="text-danger">*</span>
                                                                    <input type="text" required name="parameter" placeholder="Enter Parameter" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label> Evalution Mesaurement Technique </label><span class="text-danger">*</span>
                                                                    <input type="text" required name="evalution_mesaurement_technique" placeholder="Enter Specification" class="form-control">
                                                                    <input type="hidden" value="<?php echo $customer_part_id; ?>" required name="customer_part_id">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label> Specification </label><span class="text-danger">*</span>
                                                                    <input type="text" required name="specification" placeholder="Enter Specification" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label>Critical</label>
                                                                    <input type="text" name="critical_parm" placeholder="Enter Upper Spec Limit" class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label>Lower Spec Limit</label>
                                                                    <input type="text" name="lower_spec_limit" placeholder="Enter Lower Spec Limit" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label>Upper Spec Limit </label>
                                                                    <input type="text" name="upper_spec_limit" placeholder="Enter Upper Spec Limit" class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">

                                                        </div>
                                                        <div class="row">
                                                            <div class="col-2">
                                                                <div class="form-group">
                                                                    <label>PDI &nbsp;</label>
                                                                    <input type="checkbox" name="is_PDI" id="is_PDI">
                                                                </div>
                                                            </div>
                                                            <!-- <div class="col-2">
                                                                <div class="form-group">
                                                                    <label>Setup &nbsp;</label>
                                                                    <input type="checkbox" name="is_setup" id="is_setup">
                                                                </div>
                                                            </div>
                                                            <div class="col-2">
                                                                <div class="form-group">
                                                                    <label>Layout &nbsp;</label>
                                                                    <input type="checkbox" name="is_layout" id="is_layout">
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label>In Process Inspection &nbsp;</label>
                                                                    <input type="checkbox" name="is_inprocess_inspection" id="is_inprocess_inspection">
                                                                </div>
                                                            </div> -->
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                                        </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Parameter</th>
                                            <th>Specification</th>
                                            <th>Evalution Mesaurement Technique</th>
                                            <th>Lower Spec Limit</th>
                                            <th>Upper Spec Limit</th>
                                            <th>Critical</th>
                                            <th>PDI</th>
                                            <th>Setup</th>
                                            <th>Layout</th>
                                            <th>In Process Inspection</th>
                                            <th colspan="2">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        if ($cust_part_inspection_master) {
                                            foreach ($cust_part_inspection_master as $u) {
                                        ?>
                                                <tr>
                                                    <td><?php echo $i ?></td>
                                                    <td><?php echo $u->parameter ?></td>
                                                    <td><?php echo $u->specification ?></td>
                                                    <td><?php echo $u->evalution_mesaurement_technique ?></td>
                                                    <td><?php echo $u->lower_spec_limit ?></td>
                                                    <td><?php echo $u->upper_spec_limit  ?></td>
                                                    <td><?php echo $u->critical_parm ?></td>
                                                    <td><?php echo $u->is_PDI === "1" ? "Yes" : "No" ?></td>
                                                    <td><?php echo $u->is_setup === "1" ? "Yes" : "No" ?></td>
                                                    <td><?php echo $u->is_layout === "1" ? "Yes" : "No" ?></td>
                                                    <td><?php echo $u->is_inprocess_inspection === "1" ? "Yes" : "No" ?></td>
                                                    <td>
                                                        <div class="form-group">
                                                            <button type="button" data-toggle="modal" class="btn btn-sm btn-primary" data-target="#exampleModal2<?php echo $i ?>"><i class="fas fa-edit"></i></button>
                                                        </div>
                                                        <!-- edit modal -->
                                                        <div class="modal fade" id="exampleModal2<?php echo $i ?>" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Update</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form action="<?php echo base_url('update_inspection_parm_details') ?>" method="POST">
                                                                            <div class="col-lg-12">
                                                                                <div class="row">
                                                                                    <div class="col-lg-6">
                                                                                        <div class="form-group">
                                                                                            <label> Parameter </label><span class="text-danger">*</span>
                                                                                            <input type="text" required name="parameter" value="<?php echo $u->parameter ?>" class="form-control">
                                                                                            <input type="hidden" value="<?php echo $u->customer_partKy; ?>" required name="customer_part_id">
                                                                                            <input type="hidden" value="<?php echo $u->id; ?>" required name="id">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-6">
                                                                                        <div class="form-group">
                                                                                            <label> Evalution Mesaurement Technique </label><span class="text-danger">*</span>
                                                                                            <input type="text" required name="evalution_mesaurement_technique" value="<?php echo $u->evalution_mesaurement_technique ?>" class="form-control">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-6">
                                                                                        <div class="form-group">
                                                                                            <label> Specification </label><span class="text-danger">*</span>
                                                                                            <input type="text" required name="specification" value="<?php echo $u->specification ?>" placeholder="Enter Specification" class="form-control">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-6">
                                                                                        <div class="form-group">
                                                                                            <label>Critical</label>
                                                                                            <input type="text" name="critical_parm" value="<?php echo $u->critical_parm ?>" placeholder="Enter Upper Spec Limit" class="form-control">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-lg-6">
                                                                                        <div class="form-group">
                                                                                            <label>Lower Spec Limit</label>
                                                                                            <input type="text" name="lower_spec_limit" value="<?php echo $u->lower_spec_limit ?>" placeholder="Enter Lower Spec Limit" class="form-control">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-6">
                                                                                        <div class="form-group">
                                                                                            <label>Upper Spec Limit </label>
                                                                                            <input type="text" name="upper_spec_limit" value="<?php echo $u->upper_spec_limit ?>" placeholder="Enter Upper Spec Limit" class="form-control">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-2">
                                                                                        <div class="form-group">
                                                                                            <label>PDI &nbsp;</label>
                                                                                            <input type="checkbox" name="is_PDI" <?php if ($u->is_PDI == 1) {
                                                                                                                                        echo "checked";
                                                                                                                                    } ?> id="is_PDI">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-2">
                                                                                        <div class="form-group">
                                                                                            <label>Setup &nbsp;</label>
                                                                                            <input type="checkbox" name="is_setup" <?php if ($u->is_setup == 1) {
                                                                                                                                        echo "checked";
                                                                                                                                    } ?> id="is_setup">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-2">
                                                                                        <div class="form-group">
                                                                                            <label>Layout &nbsp;</label>
                                                                                            <input type="checkbox" name="is_layout" <?php if ($u->is_layout == 1) {
                                                                                                                                        echo "checked";
                                                                                                                                    } ?> id="is_layout1">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-6">
                                                                                        <div class="form-group">
                                                                                            <label>In Process Inspection &nbsp;</label>
                                                                                            <input type="checkbox" name="is_inprocess_inspection" <?php if ($u->is_inprocess_inspection == 1) {
                                                                                                                                                        echo "checked";
                                                                                                                                                    } ?> id="is_inprocess_inspection">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <button type="button" data-toggle="modal" class="btn btn-sm btn-danger" data-target="#exampleModal3<?php echo $i ?>"><i class="far fa-trash-alt"></i></button>
                                                        </div>
                                                        <!-- delete Modal -->
                                                        <div class="modal fade" id="exampleModal3<?php echo $i ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Cancel">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <form action="<?php echo base_url('delete') ?>" method="POST">
                                                                        <div class="modal-body">
                                                                            <input value="<?php echo $u->id; ?>" name="id" type="hidden" required class="form-control">
                                                                            <input value="cust_part_inspection_master" name="table_name" type="hidden" required class="form-control">
                                                                            Are you sure you want to delete
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                                            <button type="submit" class="btn btn-danger">Delete </button>
                                                                        </div>
                                                                    </form>
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