<?php 
if ($cust_part_inspection_report) {
foreach ($cust_part_inspection_report as $u) {
?>

<form action="<?php echo base_url('update_inspection_report_observations') ?>" method="POST">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-">
                <div class="form-group">
                    <label>Parameter: <?php echo $u->parameter?></label>
                    <input type="hidden" value="<?php echo $u->id; ?>" required name="r_id">
                    <input type="hidden" value="<?php echo $sales_part_id ; ?>" required name="sales_part_id">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label>Specification </label></span>
                    <input type="text" readonly required name="specification" value="<?php echo $u->specification ?>" placeholder="Enter Specification" class="form-control">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Critical</label></span>
                    <input type="text" readonly name="critical_parm" value="<?php echo $u->critical_parm ?>" placeholder="Enter Upper Spec Limit" class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Lower Spec Limit</label></span>
                    <input type="text" readonly required name="lower_spec_limit" value="<?php echo $u->lower_spec_limit ?>" placeholder="Enter Lower Spec Limit" class="form-control">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Upper Spec Limit </label></span>
                    <input type="text" readonly required name="upper_spec_limit" value="<?php echo $u->upper_spec_limit ?>" placeholder="Enter Upper Spec Limit" class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
        </div>
        <div class="row">
           <div class="col-6">
                <div class="form-group">
                    <label>Observation 1 </label></span>
                    <input type="text" required name="observation1" value="<?php echo $u->observation1 ?>" class="form-control">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label>Observation 2</label></span>
                    <input type="text" required name="observation2" value="<?php echo $u->observation2 ?>" class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label>Observation 3</label></span>
                    <input type="text" required name="observation3" value="<?php echo $u->observation3 ?>" class="form-control">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label>Observation 4</label></span>
                    <input type="text" required name="observation4" value="<?php echo $u->observation4 ?>" class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label>Observation 5</label></span>
                    <input type="text" required name="observation5" value="<?php echo $u->observation5 ?>" class="form-control">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label>Remark</label></span>
                    <input type="text" name="remark" value="<?php echo $u->remark ?>" class="form-control">
                </div>
            </div>
        </div>
       
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>
    </div>
</form>
<?php }} ?>