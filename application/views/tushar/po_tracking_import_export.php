<div style="width: 2100px" class="wrapper">
    <!-- Navbar -->

    <!-- /.navbar -->

    <!-- Main Sidebar Container -->


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-8">
                        <h1>Import/Export Customer PO</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-10">
                        <!-- /.card -->
                        <div class="card">
                            <div class="card-header">
								<h3 class="card-title"></h3>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary " data-toggle="modal"
                                    data-target="#exportCustomerPartsOnly">
                                    Export Customer Parts</button>

                                <button type="button" class="btn btn-primary " data-toggle="modal"
                                    data-target="#importCustomerPartsOnly">
                                    Import PO Data</button>
									
								<!-- Export Modal -->
                                <div class="modal fade" id="exportCustomerPartsOnly" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Export Customer Parts </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="<?php echo base_url('po_export_customer_part') ?>"
                                                    method="POST">
                                                    <div class="row">
                                                        <div class="col-lg-10">
                                                            <label for="contractorName">Customer</label><span
                                                                class="text-danger">*</span>
                                                            <select name="customer_id" id=""
                                                                class="form-control select2" required>
                                                                <option value="">Select</option>
                                                                <?php
                                                                if ($customer_data) {
                                                                    foreach ($customer_data as $c) {
                                                                ?>
                                                                <option value="<?php echo $c->id; ?>">
                                                                    <?php echo $c->customer_name; ?></option>
                                                                <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <input type="hidden" value="<?php echo $this->uri->segment('2') ?>"
                                                    class="hidden">
                                                <input type="hidden" value="<?php echo $this->uri->segment('3') ?>"
                                                    class="hidden">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary">Export</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Import Modal -->
                                <div class="modal fade" id="importCustomerPartsOnly" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Import PO Data</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="<?php echo base_url('import_customer_po_tracking') ?>" 
                                                method="POST" enctype='multipart/form-data'>
                                                    <div class="row">
                                                        <div class="col-lg-10">
                                                            <label for="contractorName">Customer</label><span
                                                                class="text-danger">*</span>
                                                            <select name="customer_id" id=""
                                                                class="form-control select2" required>
                                                                <option value="">Select</option>
                                                                <?php
                                                                if ($customer_data) {
                                                                    foreach ($customer_data as $c) {
                                                                ?>
                                                                <option value="<?php echo $c->id; ?>">
                                                                    <?php echo $c->customer_name; ?></option>
                                                                <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row">            
                                                        <div class="col-lg-10">
                                                            <div class="form-group">
                                                                <label for="po_num">Upload PO</label><span
                                                                class="text-danger">*</span>
                                                                <input type="file" name="uploadedDoc" required class="form-control" id="exampleuploadedDoc" placeholder="Upload PO" aria-describedby="uploadDocHelp">
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <input type="hidden" value="<?php echo $this->uri->segment('2') ?>"
                                                    class="hidden">
                                                <input type="hidden" value="<?php echo $this->uri->segment('3') ?>"
                                                    class="hidden">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary">Import</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- Import end -->
							</div>
                            <div class="card">
							<div class="card-header">
							<div class="row">
									<div class="col-lg-2">
									<form action="<?php echo base_url('customer_po_tracking_importExport'); ?>" method="post">
                                       <div class="form-group">
                                             <label for="Customer">Search by Customer</label>
											 <select class="form-control select2" name="customer_id" style="width: 100%;">
													<option value="">Select</option>
													<option value="ALL">ALL</option>
                                                    <?php
                                                                if ($customer_data) {
                                                                    foreach ($customer_data as $c) {
                                                                ?>
                                                                <option 
                                                                <?php  if($customer_id == $c->id){echo "selected";} ?>
                                                                value="<?php echo $c->id; ?>">
                                                                    <?php echo $c->customer_name; ?></option>
                                                                <?php
                                                                    }
                                                    }
                                                    ?>
											</select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <br><input type="submit" class="btn btn-primary mt-2"value="Search">
									</form>
									</div>
                                </div>
								</div>
								</div>
                            
							<!-- Grid --->
							<div class="card-body">
					            <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sr.No.</th>
                                            <th>Item</th>
                                            <th>Item description</th>
                                            <th>PO Number</th>
                                            <th>PO Quantity</th>
                                            <!-- <th>UOM</th> -->
                                            <th>Passivation</th>
                                            <th>Thickness</th>
                                            <th>Grade</th>
											<th>Warehouse</th>
                                            <th>Due date</th>
											<th>Status</th>
										    <th>Remark</th>
                                            <th>PO Unit Price</th>
                                            <th>Part Rate</th>
                                            <th>Price Change</th>
                                      </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $srNo=1;
                                      	if ($export_data) {
                                            foreach ($export_data as $exp) {
							            ?>
                                                        <tr>
                                                            <td><?php echo $srNo; ?></td>    
                                                            <td><?php echo $exp->part_number ?></td>
                                                            <td><?php echo $exp->part_description; ?></td>
                                                            <td><?php echo $exp->po_number; ?></td>
                                                            <td><?php echo $exp->qty; ?></td>
                                                            <!-- <td><php echo $exp->uom; ?></td> -->
                                                            <td><?php echo $exp->passivationType; ?></td>
                                                            <td><?php echo $exp->thickness; ?></td>
                                                            <td><?php echo $exp->rm_grade; ?></td>
                                                            <td><?php echo $exp->warehouse; ?></td>
                                                            <td style="word-wrap:normal"><?php echo $exp->due_date; ?></td>
															<td><?php echo $exp->status; ?></td>
															<td><?php echo $exp->remark; ?></td>
                                                            <?php 
                                                                $isMatchstyle = "color:black";
                                                                if($exp->imported_price != $exp->rate){
                                                                    $isMatchstyle = "color: red; font-weight: bold;";
                                                                    $priceDifferent = "Yes";
                                                                }else{
                                                                    $priceDifferent = null;
                                                                }
                                                            ?>
                                                            <td style="<?php echo $isMatchstyle; ?>"><?php echo $exp->imported_price; ?></td>
                                                            <td><?php echo $exp->rate; ?></td>
                                                            <td style="<?php echo $isMatchstyle; ?>"><?php echo $priceDifferent; ?></td>
                                                        </tr>
											<?php
                                                       $srNo++;
                                                    }
                                                }                     
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-header -->

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