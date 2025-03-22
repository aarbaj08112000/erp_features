<head>
    <link rel="stylesheet" href="<?php echo base_url('') ?>plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?php echo base_url('') ?>plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
</head>
<body>
    <div class="modal-header">
     <h5 class="modal-title" id="exampleModalLabel">Add</h5>
     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
        
     </button>
 </div>
 <form action="<?php echo base_url('SheetProdController/add_production_qty') ?>" method="POST" enctype="multipart/form-data" id="add_production_qty" class="add_production_qty custom-form">
        <div class="modal-body">
            <div class="form-group">
                <label for="on click url">Enter Date <span class="text-danger">*</span></label>
                <input max="<?php echo date("Y-m-d"); ?>" type="date"
                    value="<?php echo date('Y-m-d'); ?>" name="date" 
                    class="form-control required-input">
            </div>
            <div class="form-group">
                <label required for="on click url">Select Shift Type / Name / Start Time /
                    End Time<span class="text-danger">*</span></label>
                <select name="shift_id" name="" id="" class="form-control select2  required-input" >
                <option value="">Select</option>
                    <?php
                    if ($shifts) {
                        foreach ($shifts as $s) {
                    ?>
                    <option value="<?php echo $s->id ?>">
                        <?php echo $s->shift_type . " / " . $s->name . " / " . $s->start_time . " / " . $s->end_time; ?>
                    </option>
                    <?php
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="on click url">Select Operator<span
                        class="text-danger">*</span></label>
                <select  name="operator_id" id="" class="form-control select2 required-input">
                <option value="">Select</option>

                    <?php
                    if ($operator) {
                        foreach ($operator as $s) {
                    ?>
                    <option value="<?php echo $s->id ?>"><?php echo $s->name; ?></option>
                    <?php
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="on click url">Select Machine<span
                        class="text-danger">*</span></label>
                <select  name="machine_id" id="" class="form-control select2 required-input">
                <option value="">Select</option>
                    <?php
                    if ($machine) {
                        foreach ($machine as $s) {
                    ?>
                    <option value="<?php echo $s->id ?>"><?php echo $s->name; ?></option>
                    <?php
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="on click url">Select Inhouse Part / Customer Part<span
                        class="text-danger">*</span></label>
                <select  name="output_part_id" id="" class="form-control select2 required-input">
                        <option value="">Select</option>
                    <?php
                    if ($operations_bom) {
                            foreach ($operations_bom as $s) {
                                        ?>
                                        <option value="<?php echo $s->id ?>">
                                            <?php echo $s->part_number . " / " . $s->part_description ?>
                                        </option>
                                        <?php
                            }
                        }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="on click url">Enter QTY<span
                        class="text-danger">*</span></label>
                <input type="text" data-min="1" value="1" name="qty" 
                    class="form-control required-input onlyNumericInput">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button"  class="btn btn-secondary"
                data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="submitChange">Save changes</button>
        </div>
  </form>
    <script>
    $(document).ready(function() {
        $('.select2').select2();
    });
    </script>
 </body>
 