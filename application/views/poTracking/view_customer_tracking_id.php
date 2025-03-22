<div style="" class="wrapper">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <?php
                        $expired = "no";
                        if (empty($new_po[0]->process_id)) {
                            $type = "normal";
                        } else {
                            $type = "Subcon grn";
                        }
                        ?>
                        <a style="marign-right:" class="btn btn-danger" href="<?php echo base_url('customer_po_tracking_all'); ?>">
                            < Back</a>
                    </div>
                    <div class="col-sm-6">
                        <!-- <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('generate_po') ?>">Home </a></li>
                            <li class="breadcrumb-item active"></li>
                        </ol> -->
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
                                <div class="row">
                                    <div class="col-lg-2">
                                        <div class="form-group">
										     <label for="">Customer Name <span class="text-danger"></span></label>
                                            <br><span class="text-info"><label><?php echo $customer[0]->customer_name ?></label></span>
										</div>
									</div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">PO Number<span class="text-danger"></span> </label>
											<br><span class="text-info"><label><?php echo $customer_po_tracking[0]->po_number ?></label></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">PO Start Date <span class="text-danger"></span> </label>
											<br><span class="text-info"><label><?php echo $customer_po_tracking[0]->po_start_date ?></label></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
											<label for="">PO End Date <span class="text-danger"></span> </label>
											<br><span class="text-info"><label><?php echo $customer_po_tracking[0]->po_end_date ?></label></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">PO Amendment No</span> </label>
											<br><span class="text-info"><label><?php echo $customer_po_tracking[0]->po_amedment_number ?></label></span>
                                        </div>
									</div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Status <span class="text-danger"></span> </label>
											<br><span class="text-info"><label><?php echo $customer_po_tracking[0]->status ?></label></span>
                                        </div>
                                    </div>
									<div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Created Date <span class="text-danger"></span> </label>
											<br><span class="text-info"><label><?php echo $customer_po_tracking[0]->created_date ?></label></span>
                                        </div>
                                    </div>
									<?php
										if($customer_po_tracking[0]->status == 'closed'){
									?>
									 <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Remark<span class="text-danger"></span> </label>
											<br><span class="text-info"><label><?php echo $customer_po_tracking[0]->remark ?></label></span>
                                        </div>
                                    </div>
									<div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Reason<span class="text-danger"></span> </label>
											<br><span class="text-info"><label><?php echo $customer_po_tracking[0]->reason ?></label></span>
                                        </div>
                                    </div>
									<?php } ?>
									
                                    <!--<div class="col-lg-2">
                                            <div class="form-group">
                                                <label for="">Expiry Date <span class="text-danger">*</span> </label>
                                                    <input type="text" readonly value="<?php echo $new_po[0]->expiry_po_date ?>" class="form-control">
											</div>
                                        </div> -->
                                </div>
                            </div>
                            <div class="card-header">
                                <?php
                                if (true || $new_po[0]->expiry_po_date <=  date('Y-m-d') || true) {
                                ?>
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <div class="form-group">
                                                <form action="<?php echo base_url('add_parts_customer_trackings'); ?>" method="post">
                                                    <label for="">Select Part Number // Description <span class="text-danger">*</span> </label>
                                                    <select name="part_id" id="" required class="form-control select2">
                                                        <?php
                                                        if ($customer_part_data) {
                                                            foreach ($customer_part_data as $c) {
                                                        ?>
																<option value="<?php echo $c->id ?>">
                                                                    <?php echo $c->part_number . " // " . $c->part_description; ?>
                                                                </option>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <label for="">Enter Qty <span class="text-danger">*</span> </label>
                                                <input type="number" step="any" name="qty" placeholder="Enter QTY " required class="form-control">
                                                <input type="hidden" name="customer_po_tracking_id" value="<?php echo $customer_po_tracking[0]->id ?>" required class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-info btn-lg mt-4">Add Part to Tracking
                                                </button>
                                            </div>
                                        </div>
                                       </form>
                                    </div>
                                <?php } else {
                                    echo "Po  Expired!!";
                                } ?>
                            </div>
                            <div class="card-header">
                                <?php if ($po_parts) {
                                    if ($new_po[0]->status == "pending") {
                                        if ($this->session->userdata['type'] == 'admin' || $this->session->userdata['type'] == 'Admin') {
                                ?>
                                            <button type="button" class="btn btn-danger ml-1" data-toggle="modal" data-target="#lock">
                                                Lock PO
                                            </button>
                                <?php }
                                    }
                                } ?>
                                <?php if ($new_po[0]->status == "lock") {
                                    if ($this->session->userdata['type'] == 'admin' || $this->session->userdata['type'] == 'Admin') {
                                ?>
                                        <button type="button" class="btn btn-success ml-1" data-toggle="modal" data-target="#accpet">
                                            Accept (Released) PO
                                        </button>
                                        <button type="button" class="btn btn-danger ml-1" data-toggle="modal" data-target="#delete">
                                            Reject (delete) PO
                                        </button>
                                    <?php
                                    }
                                } else {
                                    if ($new_po[0]->status != "pending") {
                                    ?>
                                        <button type="button" disabled class="btn btn-success ml-1" data-toggle="modal" data-target="#accpet">
                                            PO Already Released
                                        </button>
                                        <a href="<?php echo base_url('download_my_pdf/') . $new_po[0]->id ?>" class="btn btn-primary" href="">Download</a>
                                <?php
                                    }
                                } ?>
                                <!-- Modal -->
                                <div class="modal fade" id="accpet" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Update</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <form action="<?php echo base_url('accept_po'); ?>" method="POST">
                                                        <div class="col-lg-12">
                                                            <div class="form-group">

                                                                <label for=""><b>Are You Sure Want To Released This
                                                                        PO?</b> </label>
                                                                <input type="hidden" name="id" value="<?php echo $new_po[0]->id ?>" required class="form-control">
                                                                <input type="hidden" name="status" value="accpet" required class="form-control">
                                                            </div>
                                                        </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="modal fade" id="lock" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Update</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <form action="<?php echo base_url('accept_po'); ?>" method="POST">
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label for=""><b>Are You Sure Want To Lock This PO?</b>
                                                                </label>
                                                                <input type="hidden" name="id" value="<?php echo $new_po[0]->id ?>" required class="form-control">
                                                                <input type="hidden" name="status" value="lock" required class="form-control">
                                                            </div>
                                                        </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="modal fade" id="delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <form action="<?php echo base_url('delete_po'); ?>" method="POST">
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label for=""><b>Are You Sure Want To Delete This
                                                                        PO?</b> </label>
                                                                <input type="hidden" name="id" value="<?php echo $new_po[0]->id ?>" required class="form-control">
                                                                <input type="hidden" name="status" value="reject" required class="form-control">
                                                                <input type="hidden" name="table_name" value="new_po" required class="form-control">
                                                            </div>
                                                        </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-striped" id="example1">
                                    <thead>
                                        <tr>
                                            <th>Sr No</th>
                                            <th>Part Number</th>
                                            <th>Part Description</th>
                                            <th>Part Price</th>
                                            <th>QTY</th>
                                            <th>Cumulative Sales Qty</th>
                                            <th>Balance QTY</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($parts_customer_trackings) {
                                            $final_po_amount = 0;
                                            $i = 1;
                                            foreach ($parts_customer_trackings as $p) {
                                                $data = array(
                                                    'id' => $p->part_id,
                                                );

                                                //$child_part_data = $this->Crud->get_data_by_id("child_part_master",);
                                                $child_part_data = $this->Crud->get_data_by_id_multiple_condition("customer_part", $data);
                                                /* $data1 = array(
                                                    'id' => $p->part_id,
                                                );
												$sales_data = $this->Crud->get_data_by_id_multiple_condition("new_sales", $data1);
												*/
												
												$child_part_rate_criteria = array(
                                                    'customer_master_id' => $child_part_data[0]->id
                                                );
												$child_part_rate = $this->Crud->get_data_by_id_multiple_condition("customer_part_rate", $child_part_rate_criteria);
												
												$start_date = date("d-m-Y", strtotime($new_po[0]->po_start_date));
                                                $end_date = date("d-m-Y", strtotime($new_po[0]->po_end_date));

												//get the parts from sales parts whose sales invoice is locked only
                                                $role_management_data = $this->db->query('SELECT SUM(parts.qty) AS MAINSUM from `sales_parts`as parts , 
                                                new_sales as sales WHERE  parts.part_id = ' . $p->part_id . ' 
                                                AND parts.po_number = \''.$customer_po_tracking[0]->po_number.'\' 
                                                AND parts.sales_id = sales.id AND sales.status =\'lock\'');
												

												$sales_qty_data = $role_management_data->result();
                                                if ($sales_qty_data) {
                                                    $sales_qty = $sales_qty_data[0]->MAINSUM > 0 ? $sales_qty_data[0]->MAINSUM : 0 ;
                                                    $balance_qty = $p->qty - $sales_qty;
                                                }
												
                                                // }else{
                                                //     $balance_qty = $p->qty ;
                                                // }

                                        ?>
                                                <tr>
                                                    <!-- <td><?php //echo $i; 
                                                                echo  $p->part_id;
                                                                echo "<br>";
                                                                ?></td> -->

                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $child_part_data[0]->part_number; ?></td>
                                                    <td><?php echo $child_part_data[0]->part_description; ?></td>
                                                    <td><?php echo $child_part_rate[0]->rate; ?></td>
                                                    <td><?php echo $p->qty; ?></td>
                                                    <td><?php echo $sales_qty; ?></td>
													<td><?php echo $balance_qty; ?></td>												
                                                    <td>
                                                        <?php
                                                        if ($new_po[0]->status == "pending") {
                                                        ?>
                                                            <!-- Button trigger modal -->
                                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal<?php echo $i; ?>">
                                                                Edit
                                                            </button>
															<button type="button" class="btn btn-danger ml-1" data-toggle="modal" data-target="#exampleModaldelete<?php echo $i; ?>">
                                                                Delete
                                                            </button>

                                                            <!-- Modal -->
                                                            <div class="modal fade" id="exampleModal<?php echo $i; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">Update
                                                                            </h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="col-lg-12">
                                                                                <div class="form-group">
                                                                                    <form action="<?php echo base_url('update_parts_customer_trackings'); ?>" method="POST">
                                                                                        <label for="">Enter Qty <span class="text-danger">*</span>
                                                                                        </label>
                                                                                        <input type="number" name="qty" value="<?php echo $p->qty ?>" placeholder="Enter QTY " required class="form-control">
                                                                                        <input type="hidden" name="id" value="<?php echo $p->id ?>" required class="form-control">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                            <button type="submit" class="btn btn-primary">Update</button>
                                                                        </div>
                                                                    </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                            <div class="modal fade" id="exampleModaldelete<?php echo $i; ?>" tabindex="-1" aria-labelledby="" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">Update
                                                                            </h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="row">
                                                                                <form action="<?php echo base_url('delete'); ?>" method="POST">
                                                                                    <div class="col-lg-12">
                                                                                        <div class="form-group">
                                                                                            <label for=""> <b>Are You Sure Want To
                                                                                                    Delete This ? </b> </label>
                                                                                            <input type="hidden" name="id" value="<?php echo $p->id ?>" required class="form-control">
                                                                                            <input type="hidden" name="table_name" value="parts_customer_trackings" required class="form-control">
                                                                                        </div>
                                                                                    </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                            <button type="submit" class="btn btn-primary">Update</button>
                                                                        </div>
                                                                    </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        <?php
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                                        <?php
                                                $i++;
                                            }
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <?php
                                        if ($po_parts) {
                                        ?>
                                            <tr>
                                                <th colspan="11">Total</th>
                                                <th><?php echo $final_po_amount; ?></th>

                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tfoot>
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