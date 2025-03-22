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
                        <h1>Loading Plan</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Loading Plan</li>
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
                                    Loading Plan

                                </h3>
                                <!-- Button trigger modal -->
                                <!-- <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal">
                                    Add </button> -->

                                <!-- Modal -->

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>PO-Number</th>
                                            <th>Customer Name/Code</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        if ($po_details) {
                                            foreach ($po_details as $po) {
                                                $so = $this->Crud->get_data_by_id("customer", $po->customer_id, "id");
                                                $data = array(
                                                    'customer_id' => $po->customer_id,
                                                    'po_number' => $po->po_number
                                                );
                                                $toggle = $this->Crud->read_data_where_result('po_details', $data);
                                                if ($toggle->num_rows() != 0) {
                                                    $w = $toggle->result()[0]->id;
                                                    $dataa = array(
                                                        'po_id' => $w,
                                                    );
                                                    $query = $this->Crud->read_data_where('c_po_so', $dataa);
                                                }

                                                // $poid = $this->Crud->get_data_by_id("c_po_so", $po->customer_id, "id");
                                                // print_r($so);
                                        ?>

                                                <tr>
                                                    <td><?php echo $i ?></td>
                                                    <td><?php echo $po->po_number ?></td>
                                                    <td><?php echo $so[0]->customer_name . " / " . $so[0]->customer_code ?></td>


                                                    <td>
                                                        <?php
                                                        if ($query != 0) {
                                                        ?>
                                                            <a href="<?php echo base_url("loading/" . $po->id) ?>" class="btn btn-sm btn-primary ml-4 view_loading"> <i class="fa fa-eye"></i></a>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <span>Add SO Line First</span>
                                                        <?php
                                                        } ?>



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
                                            <th>PO-Number</th>
                                            <th>Customer Name/Code</th>
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