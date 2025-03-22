<div class="wrapper">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('generate_po') ?>">Home</a></li>
                            <li class="breadcrumb-item active"></li>
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
                            <div class="card-body">
                                <table class="table table-bordered table-striped" id="example1">
                                    <thead>
                                        <tr>
                                            <th>Sr No</th>
                                            <th>Part Number</th>
                                            <th>Part Description</th>
                                            <th>Qty </th>
                                            <th>Process</th>
                                            <th>HSN</th>
                                            <th>Value</th>
                                            <th>Remaining Qty </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        if ($challan_parts) {
                                            $final_po_amount = 0;
                                            $i = 1;
                                            foreach ($challan_parts as $p) {
                                                $child_part_data = $this->Crud->get_data_by_id("child_part", $p->part_id, "id");

                                                /* 
                                                    $data2 = array(
                                                    'challan_id' => $this->uri->segment('2'),
                                                    'part_id' => $p->part_id,
                                                    );
                                                    $challan_parts_history_data = $this->Crud->get_data_by_id_multiple_condition("challan_parts_history", $data2);
                                                */
                                        ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $child_part_data[0]->part_number; ?></td>
                                                    <td><?php echo $child_part_data[0]->part_description; ?></td>
                                                    <td><?php echo $p->qty; ?></td>
                                                    <td><?php echo $p->process; ?></td>
                                                    <td><?php echo $p->hsn; ?></td>
                                                    <td><?php echo $p->value; ?></td>
                                                    <td><?php echo $p->remaning_qty; ?></td>

                                                </tr>
                                        <?php

                                                $i++;
                                            }
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <?php
                                        if ($po_parts) {
                                        ?>
                                            <tr>
                                                <th colspan="11">Total</th>
                                                <th><?php echo $final_po_amount; ?></th>
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