<div class="container-fluid">
    <form action="<?php echo base_url('print_packing_sticker') ?>" method="post">
        <input type="hidden" value="<?php echo $sales_id; ?>" id="sales_id" name="sales_id" class="form-control">
        <div class="row">
            <div class="col-12 p-0">
                <!-- /.card -->
                    <!-- /.card-header -->
                    <div class=" scrollable">
                <div class="card m-2 mt-3">
                    
                        <table id="example1" class="table table-bordered table-striped scrollable">
                            <thead>
                                <tr>
                                    <th style="text-wrap:nowrap">Part Number</th>
                                    <th>Quantiy/Package</th>
                                    <th style="text-wrap:nowrap">Required Qty</th>
                                    <th>Stickers</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
								    $i = 1;
                                    if ($sales_parts) {
                                        foreach ($sales_parts as $p) {
                                    ?>
                                   	<tr>
											<td><?php echo $p->part_number ?></td>
											<td><?php echo $p->packaging_qty ?></td>
										    <td>
                                             <input type="text" required class="form-control" name="requiredQty<?= $i ?>" value="<?php echo $p->requiredQty ?>" onchange="calculatePackgeFactors(this,<?php echo $p->packaging_qty ?>)">
                                             <input type="hidden" required class="form-control" name="part_no<?= $i ?>" value="<?php echo $p->part_number ?>">
                                             <input type="hidden" required class="form-control" name="part_name<?= $i ?>" value="<?php echo $p->part_description ?>">
                                             <input type="hidden" required class="form-control" name="default_pack_qty<?= $i ?>" value="<?php echo $p->packaging_qty ?>">
                                             <input type="hidden" class="form-control" name="totalItems" value="<?php echo $i ?>">
                                            </td>
                                            <td id="factorsColumn<?= $i ?>"> 
                                               <?php 
                                                    $factorSet = $this->Common_admin_model->calculateAllFactorsForSticker($p->requiredQty, $p->packaging_qty); 
                                                ?>
                                                 <?php
                                                  foreach ($factorSet as $factor) {
                                                    echo $factor['factor']." X ".$factor['count']."<br>";
                                                 } 
                                                 ?>
                                        </td>
                                       </tr>										
                                    <?php 
                                        $i++;
									}
								} ?>
                            </tbody>
                        </table>
                 </div>
                 <div class="card m-2 mt-3">
                        <div class="row p-3">
                            <div class="col-lg-5">
                            <div class="form-group">
                                            <label class="form-label">Sticker From<span class="text-danger">*</label>
                                            <input type="text" placeholder="" name="stickerFrom" required class="form-control onlyNumericInput">
                                            <input type="hidden" required class="form-control" name="invoice_no" value="<?php echo $invoice_no ?>">
                                            <input type="hidden" required class="form-control" name="invoice_date" value="<?php echo $invoice_date ?>">
                            </div>
                            </div>
                            <div class="col-lg-1">
                                    <div class="form-group mt-4 pt-2">   
                                        <button type="submit" onclick="this.form.target='_blank';return true;" class="btn btn-info btn"> Print </button>
                                    </div>
                            </div>
                        </div>
                    </div>

                        
                   
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        </form>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
    <script>

   function calculateAllFactorsForSticker(requiredQty,defaultQty) {
            var factors = [defaultQty];
            var dataSets = [];

            factors.forEach(function (factor) {
            var count = Math.floor(requiredQty / factor);
            dataSets.push({
                'factor': defaultQty,
                'count': count
            });

            requiredQty -= count * factor;

            if (requiredQty > 0) {
                dataSets.push({
                    'factor': requiredQty,
                    'count': 1
                });
            }
        });

    // console.log(dataSets);
     return dataSets;
    }

    function displayFactorsInUI(rowIndex, dataSets) {
        var result = "";
        dataSets.forEach(function (set) {
            var factor = set.factor;
            var count = set.count;
            result += `${factor} X ${count} <br>`;
            console.log('Factor:', factor, 'Count:', count);
        });

        $('#factorsColumn' + rowIndex).html(result);

       /* var result = "";
        for (const factor in factorsResult) {
            const count = factorsResult[factor];
            result += `${factor} X ${count} <br>`;
        }
        $('#factorsColumn' + rowIndex).html(result);*/
    }
    

   function calculatePackgeFactors(inputField,defaultPackQty) {
        var rowIndex = inputField.name.match(/\d+/)[0]; // Extract the row index from the input field name
        var inputValue = inputField.value;
        const factorsResult = calculateAllFactorsForSticker(inputValue,defaultPackQty);
        displayFactorsInUI(rowIndex, factorsResult);
    }

</script>