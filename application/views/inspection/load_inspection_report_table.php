<div class="container-fluid ps-0">
        <div class="row">
            <div class="col-14">
                <!-- /.card -->
                <div class="card">
                    <!-- /.card-header -->
                    <div class="">
                    <form action="<?php echo base_url('update_inspection_report_observations') ?>" method="post" class="">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Parameter</th>
                                    <th>Specification</th>
                                    <th>Evalution Mesaurement Technique</th>
                                    <th>Lower Spec Limit</th>
                                    <th>Upper Spec Limit</th>
                                    <th>Critical</th>
                                    <th style="text-wrap:nowrap">Observation 1</th>
                                    <th style="text-wrap:nowrap">Observation 2</th>
                                    <th style="text-wrap:nowrap">Observation 3</th>
                                    <th style="text-wrap:nowrap">Observation 4</th>
                                    <th style="text-wrap:nowrap">Observation 5</th>
                                    <th style="text-wrap:nowrap">Remark</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
								    $i = 1;
                                    if ($cust_part_inspection_report) {
                                        foreach ($cust_part_inspection_report as $u) {

                                    ?>
                                   	<tr>
											<td><?php echo $i ?></td>
											<td><?php echo $u->parameter ?></td>
											<td><?php echo $u->specification ?></td>
											<td><?php echo $u->evalution_mesaurement_technique ?></td>
											<td><?php echo $u->lower_spec_limit ?></td>
											<td><?php echo $u->upper_spec_limit  ?></td>
											<td><?php echo $u->critical_parm  ?></td>
                                            <td>
                                             <input type="text" required class="form-control" name="observation1-<?= $i ?>" value="<?php echo $u->observation1 ?>">
                                             <input type="hidden" class="form-control" name="r_id-<?= $i ?>" value="<?php echo $u->id ?>">
                                             <input type="hidden" class="form-control" name="parameter-<?= $i ?>" value="<?php echo $u->parameter ?>">
                                             <input type="hidden" class="form-control" name="specification-<?= $i ?>" value="<?php echo $u->specification ?>">
                                             <input type="hidden" class="form-control" name="evalution_mesaurement_technique-<?= $i ?>" value="<?php echo $u->evalution_mesaurement_technique ?>">
                                             <input type="hidden" class="form-control" name="lower_spec_limit-<?= $i ?>" value="<?php echo $u->lower_spec_limit ?>">
                                             <input type="hidden" class="form-control" name="upper_spec_limit-<?= $i ?>" value="<?php echo $u->upper_spec_limit ?>">
                                             <input type="hidden" class="form-control" name="critical_parm-<?= $i ?>" value="<?php echo $u->critical_parm ?>">
                                            </td>
                                            <td>
                                             <input type="text" required class="form-control" name="observation2-<?= $i ?>" value="<?php echo $u->observation2 ?>">
                                            </td>
                                            <td>
                                             <input type="text" required class="form-control" name="observation3-<?= $i ?>" value="<?php echo $u->observation3 ?>">
                                            </td>
                                            <td>
                                             <input type="text" required class="form-control" name="observation4-<?= $i ?>" value="<?php echo $u->observation4 ?>">
                                            </td>
                                            <td>
                                             <input type="text" required class="form-control" name="observation5-<?= $i ?>" value="<?php echo $u->observation5 ?>">
                                            </td>
                                            <td>
                                             <input type="text" class="form-control" name="remark-<?= $i ?>" value="<?php echo $u->remark ?>">
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-primary submit-button" 
                                                    data-item-id="<?php echo  $i ?>"
                                                    data-item-sales-part-id="<?php echo $sales_part_id ?>">Submit</button>
                                            </td>
                                            <!--
                                            We don't need something like edit now     
                                            <td>
                                                <button type="button" class="btn btn-primary edit-button" 
                                                data-item-id="<?php echo  $u->id ?>" 
                                                data-item-sales-part-id="<?php echo $sales_part_id ?>"
                                                >
												Edit
											</button></td> -->
										</tr>										
                                    <?php 
                                        $i++;
									}
								} ?>
                            </tbody>
                            <!-- Reusable Edit Modal -->
                            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" 
                                aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel">Update</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                        <!-- Edit form content will be loaded here using JavaScript -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </table>
                        </form>
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