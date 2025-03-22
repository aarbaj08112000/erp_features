<div style="width:1700px" class="wrapper">
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
                        <h1>View Sales Invoice</h1>
                    </div>
                    <div class="col-sm-6">
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
                            <?php 
                             if(empty($e_invoice_status) && ($new_sales[0]->status == "lock" || $new_sales[0]->status == "pending")) { ?>
                                <form action="<?Php echo base_url('generate_new_sales_update') ?>" method="POST">  
                                <div class="row">                     
                                </div>
                                <div id="loading-overlay">
                                        <div id="loading-spinner"></div>
                                </div>
                                <div class="row">
									<div class="col-md-1">
                                        <div class="form-group">
                                            <label for="">Transport Mode<span class="text-danger">*</label>
                                            <select name="mode" class="form-control" required>
                                                <option value="">Select</option>
                                                <option value="1" <?php if($new_sales[0]->mode == '1') { echo "selected"; } ?>>Road</option>
                                                <option value="2" <?php if($new_sales[0]->mode == '2') { echo "selected"; } ?>>Rail</option>
                                                <option value="3" <?php if($new_sales[0]->mode == '3') { echo "selected"; } ?>>Air</option>
                                                <option value="4" <?php if($new_sales[0]->mode == '4') { echo "selected"; } ?>>Ship</option>
                                            </select>
                                        </div>
									</div>
									<div class="col-md-2">
                                        <div class="form-group">
                                            <label for="">Transporter<span class="text-danger">*</label>
                                            <select name="transporter" required id="transporter" class="form-control select2">
											    <option value="">Select</option>
                                                    <?php
                                                    if ($transporter) {
                                                        foreach ($transporter as $tr) {
                                                    ?>
                                                            <option value="<?php echo $tr->id; ?>" <?php if($new_sales[0]->transporter_id == $tr->id) { echo "selected"; } ?>><?php echo $tr->name; ?> - <?php echo $tr->transporter_id; ?></option>
                                                    <?php
                                                    }
                                                    }
                                                    ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label for="">Vehicle No.<span class="text-danger">*</label>
                                            <input type="text" placeholder="Enter Vehicle No" name="vehicle_number" value="<?php echo $new_sales[0]->vehicle_number ?>" 
                                            pattern="^([A-Z|a-z|0-9]{4,20})$"
											oninvalid="this.setCustomValidity('Please enter a valid vehicle number in the format XX00XX0000')" 
											onchange="this.setCustomValidity('')" required class="form-control">
                                        </div>
                                    </div>
									<div class="col-md-1">
                                        <div class="form-group">
                                            <label for="">Distance<span class="text-danger">*</label>
                                            <input type="text" placeholder="Enter Distance of Transportation" value="<?php echo $new_sales[0]->distance ?>" required name="distance" class="form-control">
                                        </div>
                                    </div>
									<div class="col-md-1">
                                        <div class="form-group">
                                            <label for="">L.R No</label>
                                            <input type="text" placeholder="Enter L.R No" name="lr_number" value="<?php echo $new_sales[0]->lr_number ?>" class="form-control">
                                        </div>
                                    </div>
									 <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="">PO Remark </label>
                                            <input type="text" placeholder="Enter Remark" value="<?php echo $new_sales[0]->remark ?>" name="remark" class="form-control">
                                            <input type="hidden" value="<?php echo $this->uri->segment('2'); ?>" name="id" class="form-control">
                                        </div>
								    </div>
					                <div class="col-md-1">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-danger mt-4">Update</button>
                                        </div>
                                    </div>      
                                </div>
                                </form>
                                <?php } ?>
                                <div class="row">
									 <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="">Customer Name - Part Number</label>
                                            <input type="text" readonly value="<?php echo $customer[0]->customer_name." - ".$customer_part_details[0]->part_number ?>" class="form-control">
                                        </div>
                                    </div>
									<div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Sales Invoice Number</label>
                                            <input type="text" readonly value="<?php echo $new_sales[0]->sales_number ?>" id="sales_number" class="form-control">
                                            <input type="hidden" value="<?php echo $new_sales[0]->id ?>" id="sales_primary_id" class="form-control">
                                            <input type="hidden" value="<?php echo $new_sales[0]->created_date ?>" id="invoice_date" class="form-control">
                                            <input type="hidden" value="<?php echo $new_sales[0]->sales_number ?>" id="invoice_no" class="form-control">
                                        </div>
                                    </div>
                                 <div class="col-lg-1">
                                        <div class="form-group">
                                            <label for="">Current Status</label>
                                            <input type="text" readonly value="<?php if ($new_sales[0]->status == "accpet") {
                                                                                    echo "Released";
                                                                                } else {
                                                                                    echo $new_sales[0]->status;
                                                                                } ?>" class="form-control">

                                        </div>
                                </div>
								<div class="col-lg-1">
                                        <div class="form-group">
                                            <label for="">E Invoice Status</label>
                                           
                                            <input type="text" readonly value="<?php echo $e_invoice_status[0]->Status; ?>" class="form-control">
                                        </div>
                                    </div>
                                   <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">PO Remark</label>
                                            <input type="text" readonly value="<?php echo $new_sales[0]->remark ?>" class="form-control">
                                        </div>
                                    </div>
                             </div>
							 
                                <div class="row">
									 <div class="col-lg-1">
                                        <div class="form-group">
                                            <a class="btn btn-dark" href="<?php echo base_url('sales_invoice_released'); ?>">< Back </a>
                                        </div>
                                    </div>
									<?php if ($new_sales[0]->status == "lock" || $new_sales[0]->status == "pending" ) { ?>
                                    <div class="col-lg-1">
                                        <div class="form-group">
                                            <a class="btn btn-success" href="<?php echo base_url('view_generate_sales_invoice/') . $this->uri->segment('2'); ?>" target="_blank">View Original</a>
                                        </div>
                                    </div>
									<?php } 
									if ($new_sales[0]->status == "lock") { ?>
                                        
									<div class="col-lg-1">
                                        <div class="form-group">
                                            <a class="btn btn-success" href="<?php echo base_url('generate_sales_invoice/') . $this->uri->segment('2') . "/ORIGINAL_FOR_RECIPIENT"; ?>">Original </a>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-1">
                                        <div class="form-group">
                                            <a class="btn btn-success" href="<?php echo base_url('generate_sales_invoice/') . $this->uri->segment('2') . '/DUPLICATE_FOR_TRANSPORTER'; ?>">Duplicate </a>
                                        </div>
                                    </div>

                                    <div class="col-lg-1">
                                        <div class="form-group">
                                            <a class="btn btn-success" href="<?php echo base_url('generate_sales_invoice/') . $this->uri->segment('2') . "/TRIPLICATE_FOR_SUPPLIER"; ?>">Triplicate </a>
                                        </div>
                                    </div>

                                    <div class="col-lg-1">
                                        <div class="form-group">
                                            <a class="btn btn-success" href="<?php echo base_url('generate_sales_invoice/') . $this->uri->segment('2') . "/ACKNOWLEDGEMENT_COPY"; ?>">Acknowledge </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-1">
                                        <div class="form-group">
                                            <a class="btn btn-success" href="<?php echo base_url('generate_sales_invoice/') . $this->uri->segment('2') . "/EXTRA_COPY"; ?>">Extra Invoice</a>
                                        </div>
                                    </div>           
                                    <div class="col-lg-1">
                                        <div class="form-group">
                                        <button type="button" class="btn btn-info" data-toggle="modal"
                                                    data-target="#printForTally" id="printSticker">
                                                    Packaging Sticker
                                        </button>
                                            <!-- <a class="btn btn-info" href="<?php echo base_url('print_packing_sticker/'); ?>">Packaging Sticker</a> -->
                                        </div>

                                        <!-- Modal -->
                                    <div class="modal fade" id="printForTally" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Packaging Stickers</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <section class="content" id="observationTableData">
                                                </section>
                                        </div>
                                    </div>
                                    </div>
                     

                                    </div>                                        
                                    <div>
                                        &nbsp;
                                    </div>
                                    </div> 
                                    <!-- Print selection -->
                                    <form action="<?php echo base_url('print_sales_invoice/'). $this->uri->segment('2'); ?>" method="post">
                                        <div class="row">
                                            <div class="col-lg-1">
                                                <div class="form-group">    
                                                    <input type="checkbox" id="original" name="interests[]" value="ORIGINAL_FOR_RECIPIENT">
                                                    <label for="original">Original</label><br>
                                                </div>
                                            </div>
                                            <div class="col-lg-1">
                                                <div class="form-group">    
                                                    <input type="checkbox" id="duplicate" name="interests[]" value="DUPLICATE_FOR_TRANSPORTER">
                                                    <label for="duplicate">Duplicate</label><br>
                                                </div>
                                            </div>
                                            <div class="col-lg-1">
                                                <div class="form-group">   
                                                <!-- <div style="display: inline-block;"> -->
                                                    <input type="checkbox" id="triplicate" name="interests[]" value="TRIPLICATE_FOR_SUPPLIER">
                                                    <label for="triplicate">Triplicate</label><br>
                                                </div>
                                            </div>
                                            <div class="col-lg-1">
                                                <div class="form-group">   
                                                <!-- <div style="display: inline-block;"> -->
                                                    <input type="checkbox" id="acknowledge" name="interests[]" value="ACKNOWLEDGEMENT_COPY">
                                                    <label for="acknowledge">Acknowledge</label><br>
                                                </div>
                                            </div>
                                            <div class="col-lg-1">
                                                <div class="form-group">   
                                                <!-- <div style="display: inline-block;"> -->
                                                    <input type="checkbox" id="extraCopy" name="interests[]" value="EXTRA_COPY">
                                                    <label for="extraCopy">EXTRA COPY</label><br>
                                                </div>
                                            </div>
                                            <div class="col-lg-1">
                                                <div class="form-group">   
                                                <!-- <div style="display: inline-block;"> -->
                                                    <button type="submit" onclick="this.form.target='_blank';return true;" class="btn btn-info btn"> Print </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    
									<?php } ?>
								</div>
                           </div>
						   <?php if ($new_sales[0]->status == "pending") { ?>
						    <div class="card-header">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <form action="<?php echo base_url('add_sales_parts'); ?>" method="post">
                                                <label for="">Select PO no/ PO start date/ PO end date/ PO amedment no<span class="text-danger">*</span> </label>
                                                <select name="po_id" id="customer_tracking" required class="form-control select2">
                                                    <?php
                                                    if($po_parts)
                                                    {
                                                        if ($customer_tracking) {

                                                        foreach ($customer_tracking as $c) {
                                                        if ($po_parts[0]->po_number == $c->po_number) {
                                                        ?>
                                                        <option value="<?php echo $c->id ?>"><?php echo $c->po_number . " // " . $c->po_start_date . " // " . $c->po_end_date . "//" . $c->po_amedment_number ?></option>
                                                        <?php
                                                        }
                                                         }
                                                    }
                                                    }
                                                    else
                                                    {
                                                        if ($customer_tracking) {
                                                            foreach ($customer_tracking as $c) {
                                                        ?>
    
                                                                <option <?php
                                                                        if ($po_parts) {
                                                                            if ($po_parts[0]->po_id == $c->id) {
                                                                                echo "selected";
                                                                            }
                                                                        }
                                                                        ?> value="<?php echo $c->id ?>"><?php echo $c->po_number . " // " . $c->po_start_date . " // " . $c->po_end_date . "//" . $c->po_amedment_number ?></option>
    
                                                       <?php
                                                                }
															}
                                                        }                                                 
                                                    ?>
                                                </select>
                                        </div>
										 </div>
									 <div class="col-lg-3">
                                        <div class="form-group">
											<label for="">Select Part NO // Description // FG Stock // Rate // Packing QTY <span class="text-danger">*</span> </label>
                                            <input type="hidden" readonly id="customer_tracking_id" name="customer_tracking_id" class="form-control">
                                            <select name="part_id" id="part_id" required class="form-control select2">
                                                <option value=''>Please select</option>
                                            </select>
                                        </div>                            
									</div>
									<div class="col-lg-1">
                                        <div class="form-group">
                                            <label for=""><br>Enter Qty<span class="text-danger">*</span> </label>
                                            <input type="number" step="any" name="qty" placeholder="Enter QTY" required class="form-control">
                                            <input type="hidden" name="sales_number" value="<?php echo $new_sales[0]->sales_number; ?>" placeholder="Enter QTY " required class="form-control">
                                            <input type="hidden" name="sales_id" value="<?php echo $new_sales[0]->id; ?>" placeholder="Enter QTY " required class="form-control">
                                            <input type="hidden" name="customer_id" value="<?php echo $customer[0]->id; ?>" placeholder="Enter QTY " required class="form-control">
                                        </div>
                                    </div>
									<div class="col-lg-2">
                                        <div class="form-group mt-2">
                                            <?php if ($new_sales[0]->status == "pending") {  ?>
                                                <br><button type="submit" class="btn btn-info btn mt-3">Add</button>
                                            <?php } ?>
                                        </div>
                                    </div>
									</div>
									</form>
                                </div>
                            </div>
						   <?php } ?>
                            <div class="card-header">
                                <?php if ($po_parts) {
                                    if ($new_sales[0]->status == "pending") {
                                        if ($this->session->userdata['type'] == 'admin' || $this->session->userdata['type'] == 'Admin' || $this->session->userdata['type'] == 'Sales') {
                                            $flag=0;
                                            if ($po_parts) {
                                                $final_po_amount = 0;
                                                $i = 1;
                                                foreach ($po_parts as $p) {
                                                    if(empty($p->tax_id))
                                                    {
                                                        $flag =1;
                                                    }
                                                }
                                            }
                                            if($flag == 0)
                                            {
                                ?>
								<!-- <div class="row">
									<div class="card-header">
									<div class="col-2"> 
										<div class="col-md-1"> -->
												<button type="button" class="btn btn-danger ml-1" data-toggle="modal" data-target="#lock">
													Lock Invoice
												</button>
												
												<?php 
												if ($new_sales[0]->status == "pending") { ?>
												<button type="button" class="btn btn-danger ml-1" data-toggle="modal" data-target="#deleteInvoice">
													Delete Invoice
												</button>
												<?php } ?>
                                                
												<!-- delete model -->
															<div class="modal fade" id="deleteInvoice" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
																<div class="modal-dialog">
																	<div class="modal-content">
																		<div class="modal-header">
																			<h5 class="modal-title" id="exampleModalLabel">Delete Invoice</h5>
																			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																				<span aria-hidden="true">&times;</span>
																			</button>
																		</div>
																		<div class="modal-body">
																			<div class="row">
																				<form action="<?php echo base_url('delete_sale_invoice'); ?>" method="POST">
																					<div class="col-lg-12">
																						<div class="form-group">
																							<label for=""><b>Are you sure want to Delete this invoice ?</b> </label>
																							<input type="hidden" name="sales_id" value="<?php echo $new_sales[0]->id ?>" required class="form-control">
																							<input type="hidden" name="status" value="<?php echo $new_sales[0]->status ?>" required class="form-control">
																						</div>
																					</div>
																			</div>
																		</div>
																		<div class="modal-footer">
																			<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
																			<button type="submit" class="btn btn-primary">Delete</button>
																		</div>
																	</div>
																	</form>
																</div>
															</div>
										<!-- <div>
										<div class="col-md-1">
												<button type="button" class="btn btn-danger ml-1" data-toggle="modal" data-target="#lock">
													Lock Invoice --11
												</button>
										</div>
									</div>
									</div>
								</div> -->
								<?php }
                                else
                                {
                                    echo "<div class='alert alert-danger' style='width:400px'>Error : Check GST Of All Parts, to lock this invoice</div>";
                                }
                                        }

                                    }
                                } ?>
                                <?php if ($new_sales[0]->status == "lock") {
                                    if ($this->session->userdata['type'] == 'admin' || $this->session->userdata['type'] == 'Admin') {
                                ?>
                                      
                                    <?php
                                    }
                                } else {
                                    if ($new_sales[0]->status != "pending") {
										if ($new_sales[0]->status != "Cancelled") {
                                    ?>
                                        <button type="button" disabled class="btn btn-success ml-1" data-toggle="modal">
                                            Invoice already released
                                        </button>
                                <?php }else{ ?>
                                        <button type="button" disabled class="btn btn-success ml-1" data-toggle="modal">
                                            Invoice already Cancelled
                                        </button>
                                <?php
									   }
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

                                                                <label for=""><b>Are you sure want to released this invoice?</b> </label>
                                                                <input type="hidden" name="id" value="<?php echo $new_sales[0]->id ?>" required class="form-control">
                                                                <input type="hidden" name="status" value="accpet" required class="form-control">
                                                            </div>
                                                        </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>
								<!-- Lock Model -->
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
                                                    <form action="<?php echo base_url('lock_invoice'); ?>" method="POST">

                                                        <div class="col-lg-12">
                                                            <div class="form-group">

                                                                <label for=""><b>Are you sure want to Lock this invoice?</b> </label>
                                                                <input type="hidden" name="new_po_id" id="new_po_id" value="" required class="form-control">
                                                                <input type="hidden" name="id" value="<?php echo $new_sales[0]->id ?>" required class="form-control">
                                                                <input type="hidden" name="status" value="lock" required class="form-control">
                                                            </div>
                                                        </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
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
                                                                <label for=""><b>Are you sure want to delete this invoice?</b> </label>
                                                                <input type="hidden" name="id" value="<?php echo $new_sales[0]->id ?>" required class="form-control">
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
                                            <th>Tax Strucutre</th>
                                            <th>UOM</th>
                                            <th>QTY</th>
                                            <th>Price</th>
											<?php if($new_sales[0]->status == "pending") { ?>
											<th>Actions</th>
											<?php } ?>
                                            <th>CGST</th>
                                            <th>SGST</th>
                                            <th>IGST</th>
                                            <th>TCS</th>
                                            <th>Sub Total</th>
                                            <th>GST</th>
                                            <th>Total Price</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Sr No</th>
                                            <th>Part Number</th>
                                            <th>Part Description</th>
                                            <th>Tax Strucutre</th>
                                            <th>UOM</th>
                                            <th>QTY</th>
                                            <th>Price</th>
                                           <?php if($new_sales[0]->status == "pending") { ?>
                                            <th>Actions</th>
											<?php } ?>
                                            <th>CGST</th>
                                            <th>SGST</th>
                                            <th>IGST</th>
                                            <th>TCS</th>
                                            <th>Sub Total</th>
                                            <th>GST</th>
                                            <th>Total Price</th>
                                        </tr>
                                    </tfoot>

                                    <tbody>
                                        <?php
                                        if ($po_parts) {
                                            $final_po_amount = 0;
                                            $srNo = 1;
                                            foreach ($po_parts as $p) {
                                                $subtotal =  $p->total_rate - $p->gst_amount;
                                                $row_total =(float) $p->total_rate+(float)$p->tcs_amount;
                                               
                                                $final_po_amount = (float)$final_po_amount + (float)$row_total;                                          
                                                $rate = (float)$subtotal / (float)$p->qty;

                                                $db_part_price = $p->part_price;
                                                if($db_part_price > 0) {
                                                    $rate = $p->part_price;
                                                } 
                                               

                                        ?>
                                                <tr>
                                                    <td><?php echo $srNo; ?></td>
                                                    <td><?php echo $p->part_number; ?></td>
                                                    <td><?php echo $p->part_description; ?></td>
                                                    <td><?php echo $p->code; ?></td>
                                                    <td><?php echo $p->uom_id; ?></td>
                                                    <td><?php echo $p->qty; ?></td>
                                                    <td><?php echo number_format($rate,2); ?></td>
													 <?php
                                                        if ($new_sales[0]->status == "pending") {
                                                        ?>
                                                    <td>
                                                            <!-- Button trigger modal -->
                                                            <button type="button" class="btn btn-danger ml-1" data-toggle="modal" data-target="#exampleModaldelete<?php echo $srNo; ?>">
                                                                Delete
                                                            </button>
                                                            
                                                            <!-- Modal -->
                                                            <div class="modal fade" id="exampleModaldelete<?php echo $srNo; ?>" tabindex="-1" aria-labelledby="" aria-hidden="true">
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
                                                                                <form action="<?php echo base_url('delete'); ?>" method="POST">
                                                                                   <div class="col-lg-12">
                                                                                        <div class="form-group">
                                                                                            <label for=""> <b>Are You Sure Want To Delete This ? </b> </label>
                                                                                            <input type="hidden" name="id" value="<?php echo $p->id ?>" required class="form-control">
                                                                                            <input type="hidden" name="table_name" value="sales_parts" required class="form-control">
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
                                                    </td>
													 <?php }  ?>
                                                    <td><?php echo number_format($p->cgst_amount,2); ?></td>
                                                    <td><?php echo number_format($p->sgst_amount,2); ?></td>
                                                    <td><?php echo number_format($p->igst_amount,2); ?></td>
                                                    <td><?php echo number_format($p->tcs_amount,2); ?></td>
                                                    <td><?php echo number_format($subtotal,2); ?></td>
                                                    <td><?php echo $p->gst_amount; ?></td>
                                                    <td><?php echo number_format($row_total,2); ?></td>
                                                </tr>
                                        <?php
                                                $srNo++;
                                            }
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <?php  
										$noOfColumns = 13;
										if ($new_sales[0]->status == "pending")
											$noOfColumns = 14;
										
										if ($po_parts) { ?>
                                            <tr>
											    <th colspan='<?php echo $noOfColumns ?>'
												>Total</th>
                                                <th><?php echo number_format($final_po_amount,2); ?></th>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        var id = $("#customer_tracking").val();
        $('#new_po_id').val(id);
        var salesno = $('#sales_number').val();
        $.ajax({
            url: '<?php echo site_url("Newcontroller/get_po_sales_parts"); ?>',
            type: "POST",
            data: {
                id: id,
                salesno: salesno
            },
            cache: false,
            beforeSend: function() {
                // Show the loading icon
                $("#loading-overlay").show();
            },
            success: function(response) {
                if (response) {
                    $('#part_id').html(response);
                } else {
                    $('#part_id').html(response);
                }
            },complete: function() {
                    // Hide the loading overlay
                    $("#loading-overlay").hide();
            }
        });
        $("#customer_tracking").change(function() {
            var id = $("#customer_tracking").val();
            var salesno = $('#sales_number').val();
            $.ajax({
                url: '<?php echo site_url("Newcontroller/get_po_sales_parts"); ?>',
                type: "POST",
                data: {
                    id: id,
                    salesno: salesno
                },
                cache: false,
                beforeSend: function() {
                     // Show the loading icon
                    $("#loading-overlay").show();
                },
                success: function(response) {
                    if (response) {
                        $('#part_id').html(response);
                    } else {
                        $('#part_id').html(response);
                    }
                },complete: function() {
                    // Hide the loading overlay
                    $("#loading-overlay").hide();
            }
            });
        })


        $("#printSticker").click(function() {
            var salesId = $('#sales_primary_id').val();
            var invoice_no = $('#invoice_no').val();
            var invoice_date = $('#invoice_date').val();
            $.ajax({
                url: '<?php echo site_url("SalesController/getSalesPartPackaging_details"); ?>',
                type: "POST",
                data: {
                    salesId: salesId,
                    invoice_no:invoice_no,
                    invoice_date:invoice_date
                },
                cache: false,
                beforeSend: function() {},
                success: function(response) {
                    if (response) {
                        $('#observationTableData').html(response);
                    } else {
                       $('#observationTableData').html(response);
                    }
                }
            });
        })
    });
</script>