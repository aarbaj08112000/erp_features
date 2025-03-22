<?php
    $isMultiClient = $this->session->userdata['isMultipleClientUnits'];
?>

<div class="wrapper">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Material Request</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
                            <li class="breadcrumb-item active">Material Request</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div>
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <br>
                    <div class="col-lg-12">
                        <!-- Modal -->
                        <div class="modal fade" id="addPromo" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add Machine Request 
                                        <span style="font-style:normal;color:blue;">
                                        <?php if($isMultiClient == "true") { 
                                                 echo  " - ".$this->session->userdata['clientUnitName'];
                                         }
                                        ?></span>
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <form action="<?php echo base_url('add_machine_request') ?>" method="POST"
                                                enctype="multipart/form-data">
                                        </div>
                                        <div class="form-group">
                                            <label for="on click url">Select Operator<span
                                                    class="text-danger">*</span></label>
                                            <select name="operator_id" required id="" class="form-control select2">
                                                <?php
                                                if ($operator) {
                                                    foreach ($operator as $c) {
                                                ?>
                                                <option value="<?php echo $c->id; ?>"><?php echo $c->name; ?>
                                                </option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="on click url">Select Machine<span
                                                    class="text-danger">*</span></label>
                                            <select name="machine_id" required id="" class="form-control select2">
                                                <?php
                                                if ($machine) {
                                                    foreach ($machine as $c) {
                                                ?>
                                                <option value="<?php echo $c->id; ?>">
                                                    <?php echo $c->name; ?>
                                                </option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="on click url">Select Customer/Part Number/Part Description<span
                                                    class="text-danger">*</span></label>
                                                    <br><span style="font-style:italic;color:blue;">Note: This is list of parts which are defined in BOM</span>
                                            <select name="customer_part_id" required class="form-control select2">
                                                    <option value="">Select</option>
                                                <?php
                                                if ($customer_part) {
                                                    foreach ($customer_part as $c) {
                                                ?>
                                                    <option value="<?php echo $c->id; ?>">
                                                        <?php echo $c->customer_name."/".$c->part_number."/".$c->part_description; ?>
                                                    </option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                   </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <div class="row mb-2">
                                    <div class="col-sm-9" style="align:left;">
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#addPromo">
                                            Add
                                        </button>
                                    </div>
                                    <div class="col-sm-2">
                                        <?php if($showDocRequestDetails=="true") { ?>
                                            Format No: STR-F-02 <br>
                                            Rev.Date : 3/3/2017 <br>
                                            Rev.No.  : 00
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="word-wrap;">Request No</th>
                                            <th>Machine Mold </th>
                                            <th>Operator</th>
                                            <th>Customer Part</th>
                                            <th>Date & Time</th>
                                            <th>Status</th>
                                            <th>Details</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        if ($machine_request) {
                                            $i = 1;
                                            foreach ($machine_request as $c) {
                                                if ($c->req_parts) {
                                                    $delete = false;
                                                } else {
                                                    $delete = true;
                                                }
                                        ?>

                                        <tr>
                                            <td><?php echo "MR-".$c->id; ?></td>
                                            <td><?php echo $c->machine_name ?></td>
                                            <td><?php echo $c->operator_name ?></td>
                                            <td><?php echo $c->part_number . "/" . $c->part_description; ?></td>
                                            <td><?php echo $c->created_date . "/" . $c->created_time ?></td>
                                            <td><?php echo $c->status ?></td>
                                            <td>
                                                <a class="btn btn-info"
                                                    href="<?php echo base_url('machine_request_details/') . $c->id; ?>">View
                                                    Details</a>
                                            </td>
                                            <td>
                                                            <?php
                                                            if ($delete == true) {

                                                            ?>
                                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#addPromo<?php echo $i; ?>">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                            <?php
                                                            }
                                                            ?>

                                                            <div class="modal fade" id="addPromo<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form action="<?php echo base_url('delete') ?>" method="POST" enctype="multipart/form-data">
                                                                                <label for="">Are You Sure Want To Delete This ?</label>
                                                                                <input type="hidden" value="<?php echo $c->id ?>" name="id" class="form-control">
                                                                                <input type="hidden" value="machine_request" name="table_name" class="form-control">
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                            <button type="submit" class="btn btn-danger">Delete </button>
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
                        <!-- ./col -->
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>