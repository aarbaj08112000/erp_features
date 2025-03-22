<?php
// Get the CodeIgniter super object
$CI = &get_instance();

// Load the model
$CI->load->model('InhouseParts');

?>
<div class="wrapper">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Production Details</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
                            <li class="breadcrumb-item active">Production</li>
                        </ol>
                    </div>

                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div>
                <div class="row"><br>
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <label for="">status</label>
                                        <input type="text" readonly value="<?php echo $p_q_data[0]->status; ?>"
                                            class="form-control">
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="">Accepted Qty</label>
                                        <input type="text" readonly value="<?php echo $p_q_data[0]->accepted_qty; ?>"
                                            class="form-control">
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="">Rejection Qty</label>
                                        <input type="text" readonly value="<?php echo $p_q_data[0]->rejected_qty; ?>"
                                            class="form-control">
                                    </div>
                                    <?php
                                    if (!empty($p_q_data[0]->rejected_qty)) {
                                        ?>
                                        <div class="col-lg-3">
                                            <label for="">Rejection Remark</label>
                                            <input type="text" readonly
                                                value="<?php echo $p_q_data[0]->rejection_remark; ?>" class="form-control">
                                        </div>
                                        <div class="col-lg-3">
                                            <label for="">Rejection Reason</label>
                                            <input type="text" readonly
                                                value="<?php echo $p_q_data[0]->rejection_reason; ?>" class="form-control">
                                        </div>
                                        <?php
                                    }
                                    ?>

                                </div>
                            </div>


                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sr No</th>
                                            <th>Input Part Number / Description</th>
                                            <th>Total Req Qty</th>
                                            <th>Date & Time</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        if ($p_q_history) {
                                            $i = 1;
                                            foreach ($p_q_history as $u) {
                                                if ($u->input_part_number_table_name == "inhouse_parts") {
                                                      $output_part_data = $this->InhouseParts->getInhousePartOnlyById($u->input_part_number);
                                                } else {
                                                      $output_part_data = $this->Crud->get_data_by_id("child_part", $u->input_part_number, "id");
                                                }
                                        ?>

                                        <tr>
                                            <td><?php echo $u->input_part_number; ?></td>
                                            <td><?php echo $output_part_data[0]->part_number ?> /
                                                <?php echo $output_part_data[0]->part_description ?></td>
                                            <td><?php echo $u->req_qty ?></td>
                                            <td><?php echo $u->created_date . "/ " . $u->created_time ?></td>
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
        <!-- /.content -->
    </div>