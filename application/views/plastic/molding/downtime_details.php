<div class="wrapper">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Downtime Details</h1>
                    </div>
                    <!--<div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Customer part type</li>
                        </ol>
                    </div>-->
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
                                <h3 class="card-title"> </h3>
                                <div class="row">
						    		<div class="col-lg-1">
                                        <div class="form-group">
                                            <?php 
                                                $base_url = 'p_q_molding_production';
                                                if($view_page != 'add' ){
                                                    $base_url = 'view_p_q_molding_production';
                                                } 
                                            ?>
                                            <a class="btn btn-dark" href="<?php echo base_url($base_url); ?>">< Back </a>
                                            
                                        </div>  
                                    </div>
                                    <div class="col-lg-2">
                                            <div class="form-group">
                                                <button type="button" class="btn btn-primary float-left" data-toggle="modal" data-target="#exampleModal">
                                                    Add Downtime</button>
                                            </div>
                                    </div>
                                </div>
                                <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="po_num">Customer Name</label>
                                        <input type="text" readonly value="<?php echo $customer_part_details[0]->customer_name ?>" required class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="po_num">Part Number</label>
                                        <input type="text" readonly value="<?php echo $customer_part_details[0]->part_number ?>" required class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="po_num">Part Description</label>
                                        <input type="text" readonly value="<?php echo $customer_part_details[0]->part_description ?>" required class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="date">Date</label>
                                        <input type="text" readonly value="<?php echo $molding_prod_details[0]->date ?>" required class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-1">
                                    <div class="form-group">
                                        <label for="po_num">Shift</label><br>
                                        <label for="po_num"><?php echo $molding_prod_details[0]->shift_type."/".$molding_prod_details[0]->shift_name ?>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="po_num">Machine</label>
                                        <input type="text" readonly value="<?php echo $molding_prod_details[0]->name ?>" required class="form-control">
                                    </div>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role=" document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add Downtime</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Cancel">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                <div class="col-12">
                                                <form action="<?php echo base_url('add_downtime_details') ?>" method="POST">
                                                    <div class="form-group">
                                                        <label for="">Downtime Reason</label>
                                                        <select name="downtime_reason" id=""
                                                            class="form-control select2">
                                                            <option value="NA">NA</option>';
                                                                <?php
                                                                    foreach ($downtime_master as $d) { ?>
                                                                        <option 
                                                                            value="<?php echo $d->id; ?>">
                                                                            <?php echo $d->name; ?>
                                                                        </option>
                                                                        <?php } ?>
                                                        </select>
                                                      </div>
                                                    
                                                    <div class="form-group">
                                                        <label for="">Downtime in Min</label>
                                                        <input type="text"
                                                            name="downtime"
                                                            value=""
                                                            class="form-control">
                                                        <input type="hidden"
                                                            readonly class="form-control"
                                                            name="molding_production_id"
                                                            value="<?php echo $molding_production_id; ?>"
                                                        >
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
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
                                            <th>Downtime Reason</th>
                                            <th>Downtime in Min</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        if ($downtime_details) {
                                            foreach ($downtime_details as $r) {
                                        ?>

                                                <tr>
                                                    <td><?php echo $i ?></td>
                                                    <td><?php echo $r->name ?></td>
                                                    <td><?php echo $r->downtime ?></td>
                                                    <td>
                                                        <button type="submit" data-toggle="modal" class="btn btn-sm btn-primary" data-target="#exampleModal2<?php echo $i ?>"> <i class="fas fa-edit"></i></button>
                                                        <div class="modal fade" id="exampleModal2<?php echo $i ?>" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Update Downtime</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Cancel">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                    <form action="<?php echo base_url('update_downtime_details') ?>" method="POST">
                                                                        <div class="form-group">
                                                                            <label for="">Downtime Reason</label>
                                                                            <select name="downtime_reason" id=""
                                                                                        class="form-control select2">
                                                                                <option value="NA">NA</option>';
                                                                                <?php
                                                                                    foreach ($downtime_master as $dm) { ?>
                                                                                    <option 
                                                                                        value="<?php echo $dm->id; ?>" 
                                                                                            <?php if($r->downtime_reasonKy == $dm->id)
                                                                                                echo "selected" ;
                                                                                            ?> >
                                                                                        <?php echo $dm->name; ?>
                                                                                    </option>
                                                                                <?php } ?>
                                                                            </select>
                                                                        </div>
                                                                                
                                                                                <div class="form-group">
                                                                                    <label for="">Downtime in Min</label>
                                                                                    <input type="text"
                                                                                        name="downtime"
                                                                                        value="<?php echo $r->downtime?>"
                                                                                        class="form-control">
                                                                                    <input type="hidden"
                                                                                        readonly class="form-control"
                                                                                        name="molding_production_id"
                                                                                        value="<?php echo $molding_production_id; ?>">
                                                                                    <input type="hidden"
                                                                                        readonly class="form-control"
                                                                                        name="id"
                                                                                        value="<?php echo $r->id; ?>">
                                                                                </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                                                            </div>
                                                                        </form>

                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>  
                                                        <button type="submit" data-toggle="modal" class="btn btn-sm btn-danger ml-4" data-target="#exampleModal3<?php echo $i ?>"> <i class="far fa-trash-alt"></i></button>
                                                        <!-- Button trigger modal -->
                                                        <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                                    Launch demo modal
                                                </button> -->

                                                        <!-- Modal -->
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

                                                                            <input value="<?php echo $r->id; ?>" name="id" type="hidden" required class="form-control">
                                                                            <input value="mold_production_downtime_details" name="table_name" type="hidden" required class="form-control">
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