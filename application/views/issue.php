<div class="wrapper">
    <!-- Navbar -->

    <!-- /.navbar -->

    <!-- Main Sidebar Container -->


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper ">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Issue</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Issue</li>
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
                            <div class="card-header">
                                <h3 class="card-title">
                                    <form class="form-inline">
                                        <div class="form-group mb-2">
                                            <label for="" class="p-2">Issue</label>
                                        </div>
                                        <div class="form-group mx-sm-3 mb-2">
                                        </div>
                                    </form>

                                </h3>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary float-right" onclick="wbsfunca()" data-toggle="modal" data-target="#exampleModal">
                                    Add Issue </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg " role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add Data </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="<?php echo base_url('addissue') ?>" method="POST">
                                                    <div class="row">
                                                        <div class="col-lg-4">

                                                            <div class="form-group">
                                                                <label> Contractor Name/Code </label><span class="text-danger">*</span>
                                                                <select class="form-control select2" name="contractor" style="width: 100%;">
                                                                    <?php
                                                                    foreach ($contractor_new as $c) {
                                                                    ?>
                                                                        <option value="<?php echo $c->id; ?>"><?php echo $c->contractor_name . " / " . $c->contractor_code ?></option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label> OC Number</label><span class="text-danger">*</span>
                                                                <select class="form-control select2" id="occ" name="oc" style="width: 100%;">
                                                                    <?php
                                                                    foreach ($oc1 as $c) {
                                                                    ?>
                                                                        <option value="<?php echo $c->id; ?>"><?php echo $c->number  ?></option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="issue_date">Issue Date</label><span class="text-danger">*</span>
                                                                <input type="date" name="issue_date" required class="form-control" id="exampleInputEmail1" placeholder="Enter Date" aria-describedby="emailHelp">
                                                            </div>

                                                        </div>


                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label> Part Number/ Item Number </label><span class="text-danger">*</span>
                                                                <select class="form-control select2" name="parttt" style="width: 100%;">
                                                                    <?php
                                                                    foreach ($part_list as $c) {
                                                                    ?>
                                                                        <option value="<?php echo $c->id; ?>"><?php echo $c->part_number . " / " . $c->part_description ?></option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="po_number">Enter details of slip </label><span class="text-danger">*</span>
                                                                <input type="text" name="slip_details" required class="form-control" id="exampleInputEmail1" placeholder="Enter details of slip(OC no. /.WBS No./Item number etc)" aria-describedby="emailHelp">
                                                            </div>


                                                            <div class="form-group">
                                                                <label>WBS Number</label><span class="text-danger">*</span>
                                                                <select class="form-control select2" id="wbss" name="wbs" style="width: 100%;">
                                                                    <?php
                                                                    foreach ($wbs1 as $c) {
                                                                    ?>
                                                                        <option value="<?php echo $c->id; ?>"><?php echo $c->number  ?></option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>





                                                        </div>
                                                        <div class="col-lg-4">

                                                            <div class="form-group">
                                                                <label> HUS Number</label><span class="text-danger">*</span>
                                                                <select class="form-control select2" id="huss" name="hus" style="width: 100%;">
                                                                    <?php
                                                                    foreach ($hus1 as $c) {
                                                                    ?>
                                                                        <option value="<?php echo $c->id; ?>"><?php echo $c->number  ?></option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="invoice_number">Item Quantity</label><span class="text-danger">*</span>
                                                                <input type="number" name="quantity" class="form-control" required id="exampleInputPassword1" placeholder="Item Quantity ">
                                                            </div>


                                                        </div>
                                                        <script>
                                                            function wbsfunca() {
                                                                // alert("a");
                                                                // var test = <?php //echo $wbs1 
                                                                                ?>;
                                                                // var test1 = <?php //echo $oc1 
                                                                                ?>;
                                                                // var test2 = <?php //echo $hus1 
                                                                                ?>;
                                                                // alert(test);
                                                                var aa = document.getElementById('occ').value;
                                                                var bb = document.getElementById('huss').value;
                                                                var cc = document.getElementById('wbss').value;
                                                                // alert(aa);
                                                                if (aa == '' || bb == '' || cc == '') {
                                                                    document.getElementById("disable_hus_obs").setAttribute("disabled", "true");
                                                                }
                                                            }
                                                        </script>


                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" id="disable_hus_obs" class="btn btn-primary">Save changes</button>
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
                                            <th>Slip Details</th>
                                            <th>Contractor Name</th>
                                            <th>Contractor Code</th>
                                            <th>Part Number/Part Description</th>
                                            <th>OC Number</th>
                                            <th>WBS Number</th>
                                            <th>HUS Number</th>
                                            <th>Issue Quantity</th>
                                            <th>Issue Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        if ($issue_list) {
                                            foreach ($issue_list as $l) {
                                                $contractor = $this->Crud->get_data_by_id("contractor", $l->contractor_id, "id");
                                                $part = $this->Crud->get_data_by_id("consumable_item", $l->part_id, "id");
                                                $oc = $this->Crud->get_data_by_id("other_data", $l->oc_id, "id");
                                                $wbs = $this->Crud->get_data_by_id("other_data", $l->wbs_id, "id");
                                                $hus = $this->Crud->get_data_by_id("other_data", $l->hus_id, "id");
                                                //  print_r($oc);
                                        ?>

                                                <tr>
                                                    <td><?php echo $i ?></td>
                                                    <td><?php echo $l->slip_details ?></td>
                                                    <td><?php echo $contractor[0]->contractor_name ?></td>
                                                    <td><?php echo $contractor[0]->contractor_code ?></td>
                                                    <td><?php echo $part[0]->part_number .' / '. $part[0]->part_description  ?></td>
                                                    <td><?php echo $oc[0]->number ?></td>
                                                    <td><?php echo $wbs[0]->number ?></td>
                                                    <td><?php echo $hus[0]->number  ?></td>
                                                    <td><?php echo $l->item_quantity ?></td>
                                                    <td><?php echo $l->issue_date ?></td>

                                                    <td style="width: 200px;">
                                                        <button type="submit" data-toggle="modal" class="btn btn-sm btn-primary" data-target="#exampleModaledit2<?php echo $i ?>"> <i class="fas fa-edit"></i></button>
                                                        <div class="modal fade" id="exampleModaledit2<?php echo $i ?>"" tabindex=" -1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg " role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Update Oeration</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form action="<?php echo base_url('updateissue') ?>" method="POST">
                                                                            <div class="row">
                                                                                <div class="col-lg-4">

                                                                                    <div class="form-group">
                                                                                        <label> Contractor Name/Code </label><span class="text-danger">*</span>
                                                                                        <select class="form-control select2" name="ucontractor" style="width: 100%;">
                                                                                            <?php
                                                                                            foreach ($contractor_new as $d) {

                                                                                            ?>

                                                                                                <option 
                                                                                                <?php if($d->id == $l->contractor_id){
                                                                                                    echo " selected ";
                                                                                                }
                                                                                                else 
                                                                                                {
                                                                                                    echo "  ";
                                                                                                } ?>

                                                                                                value="<?php echo $d->id; ?>"><?php echo $d->contractor_name . " / " . $d->contractor_code ?></option>
                                                                                            <?php
                                                                                            }
                                                                                            ?>
                                                                                        </select>
                                                                                    </div>

                                                                                    <div class="form-group">
                                                                                        <label> OC Number</label><span class="text-danger">*</span>
                                                                                        <select class="form-control select2" name="uoc" style="width: 100%;">
                                                                                            <?php
                                                                                            foreach ($oc1 as $c) {
                                                                                            ?>
                                                                                                <option
                                                                                                <?php if($c->id == $l->oc_id){
                                                                                                    echo " selected ";
                                                                                                }
                                                                                                else 
                                                                                                {
                                                                                                    echo "  ";
                                                                                                } ?>
                                                                                                 value="<?php echo $c->id; ?>"><?php echo $c->number  ?></option>
                                                                                            <?php
                                                                                            }
                                                                                            ?>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="issue_date">Issue Date</label><span class="text-danger">*</span>
                                                                                        <input type="date" value="<?php echo $l->issue_date ?>" name="uissue_date" required class="form-control" id="exampleInputEmail1" placeholder="Enter Date" aria-describedby="emailHelp">
                                                                                    </div>




                                                                                </div>


                                                                                <div class="col-lg-4">
                                                                                    <div class="form-group">
                                                                                        <label> Part Number/ Item Number </label><span class="text-danger">*</span>
                                                                                        <select class="form-control select2" name="upart" style="width: 100%;">
                                                                                            <?php
                                                                                            foreach ($part_list as $c) {
                                                                                            ?>
                                                                                                <option 
                                                                                                <?php if($c->id == $l->part_id){
                                                                                                    echo " selected ";
                                                                                                }
                                                                                                else 
                                                                                                {
                                                                                                    echo "  ";
                                                                                                } ?>
                                                                                                value="<?php echo $c->id; ?>"><?php echo $c->part_number . " / " . $c->part_description ?></option>
                                                                                            <?php
                                                                                            }
                                                                                            ?>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="po_number">Enter details of slip </label><span class="text-danger">*</span>
                                                                                        <input type="text" value="<?php echo $l->slip_details ?>" name="uslip_details" required class="form-control" id="exampleInputEmail1" placeholder="Enter details of slip(OC no. /.WBS No./Item number etc)" aria-describedby="emailHelp">
                                                                                    </div>


                                                                                    <div class="form-group">
                                                                                        <label>WBS Number</label><span class="text-danger">*</span>
                                                                                        <select class="form-control select2" name="uwbs" style="width: 100%;">
                                                                                            <?php
                                                                                            foreach ($wbs1 as $c) {
                                                                                            ?>
                                                                                                <option 
                                                                                                <?php if($c->id == $l->wbs_id){
                                                                                                    echo " selected ";
                                                                                                }
                                                                                                else 
                                                                                                {
                                                                                                    echo "  ";
                                                                                                } ?>
                                                                                                value="<?php echo $c->id; ?>"><?php echo $c->number  ?></option>
                                                                                            <?php
                                                                                            }
                                                                                            ?>
                                                                                        </select>
                                                                                    </div>





                                                                                </div>
                                                                                <div class="col-lg-4">

                                                                                    <div class="form-group">
                                                                                        <label> HUS Number</label><span class="text-danger">*</span>
                                                                                        <select class="form-control select2" name="uhus" style="width: 100%;">
                                                                                            <?php
                                                                                            foreach ($hus1 as $c) {
                                                                                            ?>
                                                                                                <option value="<?php echo $c->id; ?>"><?php echo $c->number  ?></option>
                                                                                            <?php
                                                                                            }
                                                                                            ?>
                                                                                        </select>
                                                                                    </div>

                                                                                    <div class="form-group">
                                                                                        <label for="invoice_number">Item Quantity</label><span class="text-danger">*</span>
                                                                                        <input type="number" value="<?php echo  $l->item_quantity ?>" name="uquantity" class="form-control" required id="exampleInputPassword1" placeholder="Item Quantity ">
                                                                                        <input type="hidden" value="<?php echo $l->id ?>" name="id" class="form-control" required id="exampleInputPassword1" placeholder="Item Quantity ">
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
                                                        <button type="submit" data-toggle="modal" class="btn btn-sm btn-danger ml-4" data-target="#exampleModal3"> <i class="far fa-trash-alt"></i></button>


                                                        <!-- Modal -->
                                                        <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form action="<?php echo base_url('delete') ?>" method="POST">

                                                                            <input value="<?php echo $l->id; ?>" name="id" type="hidden" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Machine Name">
                                                                            <input value="issue" name="table_name" type="hidden" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Machine Name">

                                                                            Are you sure you want to delete
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-danger">Delete </button>
                                                                    </div>
                                                                    </form>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- <a href="<?php echo base_url("po/" . $customer[0]->id) ?>" class="btn btn-sm btn-primary ml-4"> <i class="fa fa-eye"></i></a> -->

                                                    </td>
                                                </tr>
                                        <?php
                                                $i++;
                                            }
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Slip Details</th>
                                            <th>Contractor Name</th>
                                            <th>Contractor Code</th>
                                            <th>Part Number/Part Description</th>
                                            <th>OC Number</th>
                                            <th>WBS Number</th>
                                            <th>HUS Number</th>
                                            <th>Issue Quantity</th>
                                            <th>Issue Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
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