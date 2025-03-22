<div class="wrapper">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Sharing Issue Request</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
                            <li class="breadcrumb-item active">Assets</li>
                        </ol>
                    </div>

                </div>
            </div>
        </section>
        <section class="content">
            <div>
                <div class="row"><br>
                    <div class="col-lg-12">
                        <div class="modal fade" id="addPromo" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <form action="<?php echo base_url('add_sharing_issue_request') ?>"
                                                method="POST" enctype="multipart/form-data">
                                        </div>
                                        <div class="form-group">
                                            <label for="on click url">Select Part
                                                Number/Description/Thickness/Weight<span
                                                    class="text-danger">*</span></label>
                                            <select required name="child_part_id" id="" class="form-control select2">
                                                <?php
                                                if ($child_part) {
                                                    foreach ($child_part as $c) {
                                                        if ($c->sub_type == "RM") {
                                                ?>
                                                <option value="<?php echo $c->id ?>">
                                                    <?php echo $c->part_number . " / " . $c->part_description . " / " . $c->thickness . " / " . $c->weight; ?>
                                                </option>
                                                <?php
                                                        }
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="on click url">Enter QTY<span
                                                    class="text-danger">*</span></label>
                                            <input type="number" min="1" step="any" value="1" name="qty" required
                                                class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="on click url">Sharing Strip</label>
                                            <textarea name="sharing_strip" class="form-control" id="" rows="2"
                                                placeholder="Enter Sharing Strip"></textarea>
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
                                  <div class="col-lg-2">
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#addPromo">Add Request</button>
                                  </div>
                                    <div class="col-lg-2">
                                        <form action="<?php echo base_url('sharing_issue_request'); ?>" method="post">
                                        <div class="form-group">
                                            <label for="">Select Year <span class="text-danger">*</span></label>
                                            <select required name="created_year" id="" class="form-control select2">
                                                <?php
                                                 for ($i = 2022; $i <= 2027; $i++) {
                                                    ?>
                                                <option <?php 
                                                    if($i == $created_year){echo "selected";}   
                                                    ?> value="<?php echo $i;?>"><?php echo $i?></option>
                                                <?php
                                                 }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                                <label for="">Select Month <span class="text-danger">*</span></label>
                                                <select required name="created_month" id=""
                                                    class="form-control select2">
                                                     <option value="ALL">ALL</option>
                                                    <?php
                                                        for ($i = 1; $i <= 12; $i++) {

                                                            $month_data = $this->Common_admin_model->get_month($i);
                                                            $month_number = $this->Common_admin_model->get_month_number($month_data);
                                                            ?>
                                                            <option <?php 
                                                            if($month_number == $created_month){echo "selected";}
                                                            ?> value="<?php echo $month_number;?>"><?php echo $month_data?>
                                                            </option>
                                                            <?php
                                                        }
                                                ?>
                                                </select>
                                            </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <input type="submit" name="submit" class="btn btn-primary mt-4" value="Search">
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sr No</th>
                                            <th>Part Number / Description / Thickness / Weight</th>
                                            <th>Qty(Kg)</th>
                                            <th>Status</th>
                                            <th>Date & Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($sharing_issue_request) {
                                            $i = 1;
                                            foreach ($sharing_issue_request as $u) {
                                        ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $u->part_number ?> /
                                                <?php echo $u->part_description ?>/
                                                <?php echo $u->thickness ?>/
                                                <?php echo $u->weight ?>
                                            </td>
                                            <td><?php echo $u->qty ?></td>
                                            <td><?php echo $u->status ?></td>
                                            <td><?php echo $u->created_date . " / " . $u->created_time ?></td>
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
            </div><!-- /.container-fluid -->
        </section>
   </div>