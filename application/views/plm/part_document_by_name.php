<?php if($entitlements['isPLMEnabled']) { ?>
    <div class="wrapper">
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
                        <h1>Customer Part Documents - <?php echo $customer_data[0]->customer_name; ?></h1>
                    </div>
                    <!-- <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                            <li class="breadcrumb-item active">Customer Part</li>
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
                        <!-- /.card -->
                        <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-lg-1">
                                <br><a href="<?php echo base_url('customer_part_documents/'.$customer_id); ?>" class="btn btn-danger ">< Back </a>
                                &nbsp;&nbsp;
                                </div>
                                <div class="col-lg-1">
                                <br><button type="button" class="btn btn-primary float-left" data-toggle="modal" data-target="#exampleModal">
                                                Add </button>
                                </div>
                                <!-- Button trigger modal -->
                                    <!--<div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Customer Name</label>
                                            <input type="text" readonly value="<?php echo $customer_data[0]->customer_name; ?>" name="customer_name" class="form-control">
                                        </div>

                                    </div> -->
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Part Name</label>
                                            <input type="text" readonly value="<?php echo $customer_part[0]->part_number; ?>" name="customer_name" class="form-control">
                                        </div>

                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Part Description</label>
                                            <input type="text" readonly value="<?php echo $customer_part[0]->part_description; ?>" name="customer_name" class="form-control">
                                        </div>

                                    </div>
                                </div>
                                <!-- Button trigger modal -->
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="<?php echo base_url('add_customer_document') ?>" method="POST" enctype='multipart/form-data'>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label for="po_num">Select Customer Name / Customer Code / Part Number / Description </label><span class="text-danger">*</span>
                                                            <select name="customer_master_id" id="" class="from-control select2">
                                                                <?php
                                                                if ($customer_part) {
                                                                    foreach ($customer_part as $c) {
                                                                        if ($customer_id == $c->customer_id) {                                                                        // $data['toolList'] = $this->Crud->get_data_by_id("tools", "insert", "type");
                                                                            $customer = $this->Crud->get_data_by_id("customer", $c->customer_id, "id");
                                                                            if ($part_id == $c->id) {


                                                                ?>
                                                                                <option value="<?php echo $c->id ?>"><?php echo $customer[0]->customer_name . "/" . $customer[0]->customer_code . "/" . $c->part_number . "/" . $c->part_description ?></option>
                                                                <?php
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                                ?>
                                                            </select>

                                                        </div>
                                                        <div class="form-group">
                                                            <label for="po_num">Document Type </label><span class="text-danger">*</span>
                                                            <select name="type" id="" class="form-control">
                                                                <option value="<?php echo $type ?>"><?php echo $type ?></option>
                                                                <!-- <option value="PPAP">PPAP</option>
                                                                <option value="QUALITY">QUALITY</option> -->
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="po_num">Document Name</label>
                                                            <input type="text" name="document_name" class="form-control" id="exampleInputEmail1" placeholder="Enter Document Name" aria-describedby="emailHelp">
                                                            <input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Document Name" aria-describedby="emailHelp">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="po_num">Document <span class="text-danger">*</span></label>
                                                            <input type="file" name="document" required class="form-control" id="exampleInputEmail1" placeholder="Enter Part Description" aria-describedby="emailHelp">
                                                        </div>
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

                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Document Type</th>
                                            <th>Document Name</th>
                                            <th>Download</th>
                                            <th>Update</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Document Type</th>
                                            <th>Document Name</th>
                                            <th>Download</th>
                                            <th>Update</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        if ($customer_part_doc) {
                                            foreach ($customer_part_doc as $poo) {
                                                if ($customer_data[0]->id == $customer_id) {
                                  
                                        ?>

                                                        <tr>
                                                            <td><?php echo $i ?></td>
                                                            <td><?php echo $type ?></td>
                                                            <td><?php echo $poo->document_name ?></td>
                                                            <td><?php
                                                                if ($poo->document != "") {
                                                                ?>
                                                                    <a download href="<?php echo base_url('documents/') . $poo->document ?>" id="" class="btn btn-sm btn-primary remove_hoverr "> Download</a>
                                                               <?php  }   ?>
                                                            </td>
                                                            <td>
                                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit<?php echo $i; ?>">
                                                                    <i class='far fa-edit'></i>
                                                                </button>

                                                                <!-- edit Modal -->
                                                                <div class="modal fade" id="edit<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="exampleModalLabel">Update</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <form action="<?php echo base_url('update_part_document_individual') ?>" method="POST" enctype="multipart/form-data">
                                                                                    <div class="form-group">
                                                                                        <label for="po_num">Document <span class="text-danger">*</span></label>
                                                                                        <input type="file" name="document" required class="form-control" id="exampleInputEmail1" placeholder="Enter Part Description" aria-describedby="emailHelp">
                                                                                        <input type="hidden" name="id" value="<?php echo $poo->id ?>">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="po_num">Document Name</label>
                                                                                        <input type="text" name="document_name" value="<?php echo $poo->document_name; ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Document Name" aria-describedby="emailHelp">
                                                                                        <input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Document Name" aria-describedby="emailHelp">
                                                                                    </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                                <button type="submit" class="btn btn-primary">Save changes</button>
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
    <?php } ?>
    <!-- /.content-wrapper -->