<?php
    $isMultiClient = $this->session->userdata['isMultipleClientUnits'];
    $noOfClients = $this->session->userdata['noOfClients'];
?>

<div style="width:2000px" class="wrapper">
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
                        <h1>Client</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Client</li>
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
                        <?php if($isMultiClient == "true") { ?><!-- UPDATE CLIENT FOR SESSION -->
                        <div class="card-header">
                                <form action="<?php echo base_url('update_session_unit') ?>" method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <div style="">
                                                <div class="form-group">
                                                    <label>Select Client Unit For Current User Session: </label>
                                                    <select name="clientUnit" id="clientId" class="form-control select2" id="">
                                                        <?php
                                                        foreach ($client_list as $cl) {
                                                        ?>
                                                            <option <?php if ($filter_client === $cl->id) echo 'selected' ?> 
                                                                    value="<?php echo $cl->id ?>"><?php echo $cl->client_unit; ?>
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
                                            <button class="btn btn-primary">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <?php } ?>
                            <?php if( $noOfClients == 0 || ($noOfClients == 1 && $isMultiClient == "true")) {?>
                            <div class="card-header">
                                <!-- <h3 class="card-title">Client </h3> -->
                                <!-- Button trigger modal -->
                                <div><button type="button" class="btn btn-primary float-left" data-toggle="modal" data-target="#exampleModal">
                                    Add Client</button>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog"  role=" document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add Client</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="<?php echo base_url('addClient') ?>" method="POST">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label for="Client_name">Client Unit</label><span class="text-danger">*</span>
                                                                <input type="text" maxlength="30" name="clientUnit" required class="form-control" id="exampleInputUnit" aria-describedby="unitHelp" placeholder="Client Unit">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="Client_name">Client Name</label><span class="text-danger">*</span>
                                                                <input type="text" name="clientName" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Client Name">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="contactPerson">Contact Person</label><span class="text-danger">*</span>
                                                                <input type="text" name="contactPerson" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Contact Person">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="Client_location">Client billing address</label><span class="text-danger">*</span>
                                                                <input type="text" name="clientBaddress" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Client Billing Address">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="Client_location">Client Shipping address</label><span class="text-danger">*</span>
                                                                <input type="text" name="clientSaddress" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Client Shipping Address">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="Client_location">Add GST Number</label><span class="text-danger">*</span>
                                                                <input type="text" name="gst_no" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Add GST Number">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="Client_location">Add PAN</label><span class="text-danger">*</span>
                                                                <input type="text" name="pan_no" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Add GST Number">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="Client_location">State</label><span class="text-danger">*</span>
                                                                <input type="text" name="state" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Add GST Number">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="Client_location">State Code</label><span class="text-danger">*</span>
                                                                <input type="text" name="state_no" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Add GST Number">
                                                            </div>


                                                            <!-- Example single danger button -->
                                                            <!-- <div class="form-group">
                                                                <label for="payment_terms">Payment Terms</label><span class="text-danger">*</span>
                                                                <input type="text" name="paymentTerms" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Payment Terms">
                                                            </div> -->

                                                            <div class="form-group">
                                                                <label for="payment_terms">Phone Number</label><span class="text-danger">*</span>
                                                                <input type="number" min="0" name="phone_no" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Payment Terms">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="payment_terms">Bank Details</label><span class="text-danger">*</span>
                                                                <input type="text" name="bank_details" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Bank Details">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="payment_terms">Address 1</label><span class="text-danger">*</span>
                                                                <input type="text" name="address1" required class="form-control" aria-describedby="emailHelp" placeholder="Address 1">
                                                            </div>
                                                            
                                                            <div class="form-group">
                                                                <label for="payment_terms">Location</label><span class="text-danger">*</span>
                                                                <input type="text" name="location" required class="form-control" aria-describedby="emailHelp" placeholder="Location">
                                                            </div>
                                                            
                                                            <div class="form-group">
                                                                <label for="payment_terms">Pin</label><span class="text-danger">*</span>
                                                                <input type="text" name="pin" required class="form-control" aria-describedby="emailHelp" placeholder="Pin">
                                                            </div>
                                                        </div>


                                                        <!-- <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="max_reshaping_revision">Max Resharpening Revision</label><span class="text-danger">*</span>
                                                                <input type="text" class="form-control" name="maxResharpeningRevision" required id="exampleInputPassword1" placeholder="Max Resharpening Revision">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="fixture_number">
                                                                    Safety Stock
                                                                </label><span class="text-danger">*</span>
                                                                <input type="text" name="safetyStock" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Fixture Number">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="fixture_number">
                                                                    Defined Tool Life </label><span class="text-danger">*</span>
                                                                <input type="text" name="definedToolLife" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Fixture Number">
                                                                <input type="hidden" value="tool_without_insert" name="type" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Fixture Number">
                                                            </div>
                                                        </div> -->

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                </form>
                                             </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Client Unit</th>
                                            <th>Client Name</th>
                                            <th>Contact Person</th>
                                            <th>Client Billing Address</th>
                                            <th>Client Shipping Address</th>
                                            <th>GST Number</th>
                                            <th>Phone Number</th>
                                            <th>PAN NO</th>
                                            <th>State</th>
                                            <th>State Code</th>
                                            <th>Bank Details</th>
                                            <th>Address 1</th>
                                            <th>Location</th>
                                            <th>Pin</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        if ($client_list) {
                                            foreach ($client_list as $t) {
                                        ?>
                                                <tr>
                                                    <td><?php echo $i ?></td>
                                                    <td><?php echo $t->client_unit ?></td>
                                                    <td><?php echo $t->client_name ?></td>
                                                    <td><?php echo $t->contact_person ?></td>
                                                    <td><?php echo $t->billing_address ?></td>
                                                    <td><?php echo $t->shifting_address ?></td>
                                                    <td><?php echo $t->gst_number ?></td>
                                                    <td><?php echo $t->phone_no ?></td>
                                                    <td><?php echo $t->pan_no ?></td>
                                                    <td><?php echo $t->state ?></td>
                                                    <td><?php echo $t->state_no ?></td>
                                                    <td><?php echo $t->bank_details ?></td>
                                                    <td><?php echo $t->address1 ?></td>
                                                    <td><?php echo $t->location ?></td>
                                                    <td><?php echo $t->pin ?></td>

                                                    <td>
                                                        <button type="submit" data-toggle="modal" class="btn btn-sm btn-primary" data-target="#exampleModal2<?php echo $i ?>"> <i class="fas fa-edit"></i></button>

                                                        <div class="modal fade" id="exampleModal2<?php echo $i ?>" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Add Tool</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">

                                                                        <form action="<?php echo base_url('updateClient') ?>" method="POST">
                                                                            <div class="row">
                                                                                <div class="col-lg-12">
                                                                                     <div class="form-group">
                                                                                        <label>Contact Unit</label><span class="text-danger">*</span>
                                                                                        <input type="label" readonly value="<?php echo  $t->client_unit  ?>" name="uclientUnit" required class="form-control" id="exampleInputUnit" aria-describedby="unitHelp" placeholder="Client Unit">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="Client_name">Client Name</label><span class="text-danger">*</span>
                                                                                        <input type="text" value="<?php echo  $t->client_name  ?>" name="uclientName" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Client Name">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="contact_person">Contact Person</label><span class="text-danger">*</span>
                                                                                        <input type="text" value="<?php echo  $t->contact_person  ?>" name="ucontactPerson" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Client Code">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="Client_location">Client billing address</label><span class="text-danger">*</span>
                                                                                        <input type="text" value="<?php echo  $t->billing_address  ?>" name="uclientBaddress" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Client Billing Address">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="Client_location">Client Shipping address</label><span class="text-danger">*</span>
                                                                                        <input type="text" value="<?php echo  $t->shifting_address  ?>" name="uclientSaddress" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Client Shipping Address">
                                                                                    </div>

                                                                                    <div class="form-group">
                                                                                        <label for="Client_location">Add GST Number</label><span class="text-danger">*</span>
                                                                                        <input type="text" value="<?php echo  $t->gst_number  ?>" name="ugst_no" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Add GST Number">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="Client_location">Add PAN No</label><span class="text-danger">*</span>
                                                                                        <input type="text" value="<?php echo  $t->pan_no  ?>" name="pan_no" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Add GST Number">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="Client_location">State</label><span class="text-danger">*</span>
                                                                                        <input type="text" value="<?php echo  $t->state  ?>" name="state" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Add GST Number">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="Client_location">State Code</label><span class="text-danger">*</span>
                                                                                        <input type="text" value="<?php echo  $t->state_no  ?>" name="state_no" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Add GST Number">
                                                                                    </div>

                                                                                    <div class="form-group">
                                                                                        <label for="payment_terms">Phone Number</label><span class="text-danger">*</span>
                                                                                        <input type="number" value="<?php echo  $t->phone_no  ?>" min="0" name="uphone_no" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Payment Terms">
                                                                                        <input type="hidden" name="id" value="<?php echo $t->id ?>">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="payment_terms">Bank Details</label><span class="text-danger">*</span>
                                                                                        <input type="text" value="<?php echo  $t->bank_details  ?>" name="bank_details" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Bank Details">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="payment_terms">Address 1</label><span class="text-danger">*</span>
                                                                                        <input type="text" value="<?php echo  $t->address1  ?>" name="address1" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Address 1">
                                                                                    </div>
                                                                                    
                                                                                    <div class="form-group">
                                                                                        <label for="payment_terms">Location</label><span class="text-danger">*</span>
                                                                                        <input type="text" value="<?php echo  $t->location  ?>" name="location" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Location">
                                                                                    </div>
                                                                                    
                                                                                    <div class="form-group">
                                                                                        <label for="payment_terms">Pin</label><span class="text-danger">*</span>
                                                                                        <input type="text" value="<?php echo  $t->pin  ?>" name="pin" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Pin">
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