<?php
 // Get the CodeIgniter super object
$CI =& get_instance();
        
// Load the model
$CI->load->model('InhouseParts');
?>

<div class="wrapper">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Production Qty</h1>
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
                        <!-- Modal -->
                        <div class="modal fade" id="addPromo" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <!-- Modal content will be populated here by AJAX -->
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <button type="button" class="btn btn-primary" id="AddProdButton" data-toggle="modal"
                                    data-target="#addPromo">
                                    Add Production Qty
                                </button>
                            </div>
                            <div class="card-body">
                                <label style="color:red">Latest 10 records. For past records use </label> <a href="<?php echo base_url('view_p_q') ?>" > Production QTY: View </a>
                                <table id="example" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sr No</th>
                                            <th>Output Part Number / Descriptions </th>
                                            <th>Date</th>
                                            <th>Shift</th>
                                            <th>Machine</th>
                                            <th>Operator</th>
                                            <th>Qty</th>
                                            <th>Scrap</th>
                                            <th>Accepted Qty</th>
                                            <th>Rejected Qty</th>
                                            <th>Onhold Qty</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                            <th>View Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($p_q) {
                                            $i = 1;
                                            foreach ($p_q as $u) {
                                                if ($u->output_part_table_name == "inhouse_parts") {
                                                    $output_part_data = $this->InhouseParts->getInhousePartOnlyById($u->output_part_id);
                                                } else {
                                                    $output_part_data = $this->Crud->get_data_by_id("customer_part", $u->output_part_id, "id");
                                                }
                                        ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $output_part_data[0]->part_number ?> /
                                                <?php echo $output_part_data[0]->part_description ?></td>
                                            <td><?php echo $u->date ?></td>
                                            <td><?php echo $u->shift_type . "/" . $u->shift_name; ?>
                                            </td>
                                            <td><?php echo $u->machine_name; ?></td>
                                            <td><?php echo $u->op_name; ?></td>
                                            <td><?php echo $u->qty ?></td>
                                            <td><?php echo $u->scrap_factor ?></td>
                                            <td><?php echo $u->accepted_qty ?></td>
                                            <td><?php echo $u->rejected_qty ?></td>
                                            <td><?php
                                                        if (!empty($u->onhold_qty)) {
                                                        ?>
                                                <button type="button" class="btn btn-warning float-left "
                                                    data-toggle="modal" data-target="#onhold<?php echo $i; ?>">
                                                    <?php echo $u->onhold_qty; ?> </button>
                                                <?php } else {
                                                            echo 0;
                                                        } ?>
                                                <div class="modal fade" id="onhold<?php echo $i; ?>" tabindex="-1"
                                                    role="dialog" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">
                                                                    Onhold
                                                                    Update </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form
                                                                    action="<?php echo base_url('update_p_q_onhold') ?>"
                                                                    method="POST" enctype='multipart/form-data' s>
                                                                    <div class="row">
                                                                        <div class="col-lg-12">
                                                                            <div class="form-group">
                                                                                <label for="">Qty</label>
                                                                                <input type="number" step="any"
                                                                                    value="<?php echo $u->onhold_qty ?>"
                                                                                    readonly class="form-control">

                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-12">
                                                                            <div class="form-group">
                                                                                <label for="">Accept Qty <span
                                                                                        class="text-danger">*</span>
                                                                                </label>
                                                                                <input type="number" step="any" value=""
                                                                                    max="<?php echo $u->onhold_qty ?>"
                                                                                    min="0" class="form-control"
                                                                                    name="accepted_qty"
                                                                                    placeholder="Enter Accepted Quantity"
                                                                                    required>

                                                                            </div>
                                                                        </div>

                                                                        <div class="col-lg-12">
                                                                            <div class="form-group">
                                                                                <label for="">Rejection
                                                                                    Reason</label>
                                                                                <select name="rejection_reason" id=""
                                                                                    class="form-control select2">
                                                                                    <option value="NA">NA</option>
                                                                                    <?php
                                                                                            if ($reject_remark) {

                                                                                                foreach ($reject_remark as $r) {
                                                                                            ?>
                                                                                    <option
                                                                                        value="<?Php echo $r->name ?>">
                                                                                        <?Php echo $r->name ?>
                                                                                    </option>
                                                                                    <?php
                                                                                                }
                                                                                            }
                                                                                            ?>
                                                                                </select>

                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-12">
                                                                            <div class="form-group">
                                                                                <label for="">Reject Remark</label>
                                                                                <input type="text"
                                                                                    placeholder="Enter Rejection Remark If any"
                                                                                    class="form-control"
                                                                                    name="rejection_remark">
                                                                                <input type="hidden"
                                                                                    placeholder="Enter Rejection Remark If any"
                                                                                    readonly class="form-control"
                                                                                    name="id"
                                                                                    value="<?php echo $u->id ?>">
                                                                                <input type="hidden"
                                                                                    placeholder="Enter Rejection Remark If any"
                                                                                    readonly class="form-control"
                                                                                    name="qty"
                                                                                    value="<?php echo $u->onhold_qty ?>">
                                                                                <input type="hidden"
                                                                                    placeholder="Enter Rejection Remark If any"
                                                                                    readonly class="form-control"
                                                                                    name="output_part_id"
                                                                                    value="<?php echo $u->output_part_id ?>">
                                                                                <input type="hidden"
                                                                                    placeholder="Enter Rejection Remark If any"
                                                                                    readonly class="form-control"
                                                                                    name="accepted_qty_old"
                                                                                    value="<?php echo $u->accepted_qty ?>">
                                                                                <input type="hidden"
                                                                                    placeholder="Enter Rejection Remark If any"
                                                                                    readonly class="form-control"
                                                                                    name="rejected_qty_old"
                                                                                    value="<?php echo $u->rejected_qty ?>">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">Close</button>
                                                                        <button type="submit"
                                                                            class="btn btn-primary">Save
                                                                            changes</button>
                                                                    </div>
                                                            </div>
                                                            </form>

                                                        </div>

                                                    </div>
                                                </div>
                                            </td>
                                            <td><?php echo $u->status ?></td>

                                            <td>
                                                <?php
                                                        if ($u->status == "pending") {
                                                        ?>
                                                <button type="button" class="btn btn-danger float-left "
                                                    data-toggle="modal" data-target="#acceptReject<?php echo $i; ?>">
                                                    Accept/Reject </button>

                                                <?php
                                                        } else {
                                                            echo "Completed";
                                                        }
                                                        ?>
                                                <div class="modal fade" id="acceptReject<?php echo $i; ?>" tabindex="-1"
                                                    role="dialog" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Add </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="<?php echo base_url('update_p_q') ?>"
                                                                    method="POST" enctype='multipart/form-data' s>
                                                                    <div class="row">
                                                                        <div class="col-lg-12">
                                                                            <div class="form-group">
                                                                                <label for="">Qty</label>
                                                                                <input type="text"
                                                                                    value="<?php echo $u->qty ?>"
                                                                                    readonly class="form-control">

                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-12">
                                                                            <div class="form-group">
                                                                                <label for="">Accept Qty <span
                                                                                        class="text-danger">*</span>
                                                                                </label>
                                                                                <input type="number" step="any" value=""
                                                                                    max="<?php echo $u->qty ?>" min="0"
                                                                                    class="form-control"
                                                                                    name="accepted_qty"
                                                                                    placeholder="Enter Accepted Quantity"
                                                                                    required>

                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-12">
                                                                            <div class="form-group">
                                                                                <label for="">Onhold Qty <span
                                                                                        class="text-danger">*</span>
                                                                                </label>
                                                                                <input type="number" step="any" value=""
                                                                                    max="<?php echo $u->qty ?>" min="0"
                                                                                    class="form-control"
                                                                                    name="onhold_qty"
                                                                                    placeholder="Enter onhold" required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-12">
                                                                            <div class="form-group">
                                                                                <label for="">Rejection Reason</label>
                                                                                <select name="rejection_reason" id=""
                                                                                    class="form-control select2">
                                                                                    <option value="NA">NA</option>
                                                                                    <?php
                                                                                            if ($reject_remark) {

                                                                                                foreach ($reject_remark as $r) {
                                                                                            ?>
                                                                                    <option
                                                                                        value="<?Php echo $r->name ?>">
                                                                                        <?Php echo $r->name ?>
                                                                                    </option>
                                                                                    <?php
                                                                                                }
                                                                                            }
                                                                                            ?>
                                                                                </select>

                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-12">
                                                                            <div class="form-group">
                                                                                <label for="">Reject Remark</label>
                                                                                <input type="text"
                                                                                    placeholder="Enter Rejection Remark If any"
                                                                                    class="form-control"
                                                                                    name="rejection_remark">
                                                                                <input type="hidden"
                                                                                    placeholder="Enter Rejection Remark If any"
                                                                                    readonly class="form-control"
                                                                                    name="id"
                                                                                    value="<?php echo $u->id ?>">
                                                                                <input type="hidden"
                                                                                    placeholder="Enter Rejection Remark If any"
                                                                                    readonly class="form-control"
                                                                                    name="qty"
                                                                                    value="<?php echo $u->qty ?>">
                                                                                <input type="hidden"
                                                                                    placeholder="Enter Rejection Remark If any"
                                                                                    readonly class="form-control"
                                                                                    name="output_part_id"
                                                                                    value="<?php echo $u->output_part_id ?>">
                                                                                <input type="hidden"
                                                                                    placeholder="Enter Rejection Remark If any"
                                                                                    readonly class="form-control"
                                                                                    name="scrap_factor"
                                                                                    value="<?php echo $u->scrap_factor ?>">

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">Close</button>
                                                                        <button type="submit"
                                                                            class="btn btn-primary">Save
                                                                            changes</button>
                                                                    </div>
                                                            </div>
                                                            </form>

                                                        </div>

                                                    </div>
                                                </div>

                                            </td>

                                            <td>
                                                <a class="btn btn-info"
                                                    href="<?php echo base_url('details_production_qty/') . $u->id ?>">
                                                    View Details</a>
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
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
     $(document).ready(function() {
       $("#AddProdButton").click(function() {
            $.ajax({
                url: '<?php echo site_url("SheetProdController/production_qty_add"); ?>',
                type: "POST",
                data: {},
                cache: false,
                beforeSend: function() {},
                success: function(response) {
                   if (response) {
                            $('#addPromo .modal-content').html(response);
                            $('#addPromo').modal('show');
                        } else {
                            $('#addPromo .modal-content').html('<p>No data found.</p>');
                            $('#addPromo').modal('show');
                        }
                }
            });
        });
    });
  
</script>