<?php  
$machine_request_id = $this->uri->segment('2');  
?>
<div class="wrapper">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>View Material Request 
                         <span style="font-style:normal;color:blue;">
                            <?php echo  "MR-".$machine_request_id;?>
                        </span>
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
                            <li class="breadcrumb-item active">View Material Request</li>
                        </ol>
                    </div>

                </div>
            </div>
        </section>
        <section class="content">
            <div>
                <div class="row">
                    <br>
                    <div class="col-lg-12">
                        <div class="modal fade" id="addChildPart" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add Child Part</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <form action="<?php echo base_url('add_machine_request_details') ?>"
                                                method="POST" enctype="multipart/form-data">
                                        </div>
                                        <div class="form-group">
                                            <label for="on click url">Select Child Part<span
                                                    class="text-danger">*</span></label>
                                            <select name="child_part_id" required id="" class="form-control select2">
                                                <option value="">Select</option>
                                                <?php
                                                if ($child_part) {
                                                    foreach ($child_part as $c) {
                                                ?>
                                                <option value="<?php echo $c->id; ?>">
                                                    <?php echo $c->part_number . "/" . $c->part_description; ?>
                                                </option>
                                                <?php
                                                    }
                                                }
                                                ?>

                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="on click url">Enter Qty <span
                                                    class="text-danger">*</span></label>
                                            <input type="number" step="any" required placeholder="Enter Qty"
                                                class="form-control" name="qty">
                                            <input type="hidden" value="<?php echo $this->uri->segment('2'); ?>"
                                                step="any" name="machine_request_id" required placeholder="Enter Qty"
                                                class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="on click url">Enter Remark</label>
                                            <input type="text" step="any" placeholder="Enter Remark"
                                                class="form-control" name="remark">                      
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
                            <div class="row">
                                <div class="form-group">
                                    <a class="btn btn-dark" href="<?php echo base_url('machine_request'); ?>">< Back </a>
                                </div>
                                <?php 
                                if($machine_request_parts==null || $machine_request_parts[0]->request_status == 'pending') { ?>
                                <div class="form-group">&nbsp;
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#addChildPart">
                                        Add
                                    </button>
                                </div>
                               <?php } ?>
                            </div>
                        </div>
                        </div>
                       <div class="card">
                           <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sr No</th>
                                            <th>Child Part </th>
                                            <th>UOM</th>
                                            <th>Requsted Qty</th>
                                            <th>Issued Qty</th>
                                            <th>Status</th>
                                            <th>Remark</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($machine_request_parts) {
                                            $i = 1;
                                            foreach ($machine_request_parts as $req) {
                                        ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $req->part_number . "/" . $req->part_description ?></td>
                                            <td><?php echo $req->uom_name ?></td>
                                            <td><?php echo $req->qty ?></td>
                                            <td>
                                                <?php if ($req->status == "pending") { ?>
                                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#addPromo<?php echo $i; ?>">
                                                    Issue Qty
                                                </button>
                                                <?php
                                                        } else {
                                                            echo $req->accepted_qty;
                                                        }
                                                        ?>
                                                <div class="modal fade" id="addPromo<?php echo $i; ?>" tabindex="-1"
                                                    role="dialog" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Issue Qty</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <form
                                                                        action="<?php echo base_url('issue_material_request_qty') ?>"
                                                                        method="POST" enctype="multipart/form-data">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="on click url">Enter Accept Qty
                                                                        (Current Stock:<?php echo $req->stock; ?>)<span
                                                                            class="text-danger">*</span></label>
                                                                    <br>
                                                                    <?php
                                                                            if ($req->stock > 0 && $req->qty <= $req->stock) {
                                                                    ?>
                                                                    <input required type="number" name="accepted_qty"
                                                                        placeholder="Enter Accept Qty"
                                                                        class="form-control" min="1"
                                                                        max="<?php echo $req->qty; ?>" value="" id="">
                                                                    
                                                                        <input type="hidden" value="<?php echo $machine_request_id; ?>"
                                                                        name="machine_request_id" required
                                                                        class="form-control">
                                                                    <input required type="hidden" name="qty"
                                                                        placeholder="Enter Accept Qty"
                                                                        class="form-control" min="1"
                                                                        value="<?php echo $req->qty; ?>">
                                                                    <input required type="hidden" name="id"
                                                                        placeholder="Enter Accept Qty"
                                                                        class="form-control"
                                                                        value="<?php echo $req->id; ?>" id="">
                                                                    <input required type="hidden" name="part_number"
                                                                        placeholder="Enter Accept Qty"
                                                                        class="form-control"
                                                                        value="<?php echo $req->part_number; ?>"
                                                                        id="">
                                                                    <?php
                                                                              $disableSave = "";
                                                                            } else {
                                                                                echo "Please Add Store Stock ";
                                                                                $disableSave = 'disabled';
                                                                            }
                                                                            ?>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Close</button>
                                                                <button type="submit" <?php echo $disableSave; ?> class="btn btn-primary">Save</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><?php echo $req->status ?></td>
                                            <td><?php echo $req->remark ?></td>
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
                <!-- /.row -->
                <!-- Main row -->

                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>