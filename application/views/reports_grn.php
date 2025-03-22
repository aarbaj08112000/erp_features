<div class="wrapper">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <!-- <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Reports : GRN Reports</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
                            <li class="breadcrumb-item active">GRN Reports</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section> -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <form action="<?php echo base_url('reports_grn'); ?>" method="post">
                                        <div class="form-group">
                                            <label for="">Select Month  <span class="text-danger">*</span></label>
                                            <select required name="created_month" id="" class="form-control select2">
                                                <?php
                                                 for ($i = 1; $i <= 12; $i++) {

                                                    $month_data = $this->Common_admin_model->get_month($i);
                                                    $month_number = $this->Common_admin_model->get_month_number($month_data);
                                                    ?>
                                                    <option
                                                    <?php 
                                                    if($month_number == $created_month){echo "selected";}
                                                    ?>
                                                    value="<?php echo $month_number;?>"><?php echo $month_data?></option>
                                                    <?php
                                                 }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-1">
                                    <div class="form-group">
                                            <label for="">Select Year  <span class="text-danger">*</span></label>
                                            <select required name="created_year" id="" class="form-control select2">
                                                <?php
                                                 for ($i = 2022; $i <= 2027; $i++) {

                                                    ?>
                                                    <option 
                                                    <?php 
                                                    if($i == $created_year){echo "selected";}
                                                    ?>
                                                    value="<?php echo $i;?>"><?php echo $i?></option>
                                                    <?php
                                                 }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <input type="submit" class="btn btn-primary mt-4"value="Search">
                                        </form>
                                    </div>
                                    <div class="col-lg-3">
                                        <button type="button" class="btn btn-dark mt-4" data-toggle="modal"
                                                    data-target="#exportForTally">
                                                    Export For Tally
                                        </button>
                                    </div>
                                    <div class="col-lg-1">
                                    </div>
                                    <div class="col-sm-2">
                                        <?php if($showDocRequestDetails=="true") { //Inward Register Document details?>
                                            Format No: STR-F-03 <br>
                                            Rev.Date : 11/10/2017 <br>
                                            Rev.No.  : 00
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>

                         
                        <div class="modal fade" id="exportForTally" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Export Criteria</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="">Only Accepted Status GRN will be exported.</label>
                                        </div>
                                        <div class="form-group">
                                        <form action="<?php echo base_url('grn_excel_export') ?>" method="POST"> <!-- old url grn_export -->
                                        </div>
                                        <div class="form-group">
                                        <label for="">Year:</label>
                                            <select required name="search_year" id="" class="form-control select2">
                                                <?php
                                                 $fincYears = $this->Common_admin_model->getFinancialYears();
                                                 foreach($fincYears as $fyear ) {
                                                    ?>
                                                    <option 
                                                    <?php 
                                                    if($fyear->startYear == $created_year) {
                                                        echo "selected";
                                                    }
                                                    ?>
                                                    value="<?php echo $fyear->startYear;?>"><?php echo $fyear->displayName?></option>
                                                    <?php
                                                 }
                                                ?>
                                            </select> 
                                        </div>
                                        <div class="form-group">
                                            <label for="">Month:
                                                <span class="small"><br>Month will be ignored if GRN Number field is provided.</span>
                                            </label>
                                            <select required name="search_month" id="" class="form-control select2">
                                                <?php
                                                for ($i = 1; $i <= 12; $i++) {

                                                    $month_data = $this->Common_admin_model->get_month($i);
                                                    $month_number = $this->Common_admin_model->get_month_number($month_data);
                                                    ?>
                                                    <option
                                                    <?php 
                                                    if($month_number == $created_month){echo "selected";}
                                                    ?>
                                                    value="<?php echo $month_number;?>"><?php echo $month_data?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>GRN Number/Range:</label>
                                            <span class="small">
                                                <br>For Individual GRN: Use only <b>number</b>, example: <b>21</b>
                                                <br>For GRN number range : Use <b>hypen</b>, example: <b>23-27</b>
                                                <br>For Specific GRN : Use <b>comma</b>, example: <b>11,15,17,18</b>
                                                <br>&nbsp;
                                            </span>&nbsp;<br>
                                            <input type="text" value="" name="grn_numbers" class="form-control" id="grn_id" aria-describedby="emailHelp">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                            <button type="submit" name="export" class="btn btn-primary" value="XML Export">Export</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        </div>

                           
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
                                            <form action="<?php echo base_url('add_job_card') ?>" method="POST" enctype='multipart/form-data'>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label for="po_num">Select Customer Name / Customer Code / Part Number / Description </label><span class="text-danger">*</span>
                                                            <select name="customer_part_id" id="" class="from-control select2">
                                                                <?php
                                                                if ($customer_part) {
                                                                    foreach ($customer_part as $c) {
                                                                        if (true) {                                                                        // $data['toolList'] = $this->Crud->get_data_by_id("tools", "insert", "type");
                                                                            $customer = $this->Crud->get_data_by_id("customer", $c->customer_id, "id");

                                                                ?>
                                                                            <option value="<?php echo $c->id ?>"><?php echo $customer[0]->customer_name . "/" . $customer[0]->customer_code . "/" . $c->part_number . "/" . $c->part_description ?></option>
                                                                <?php
                                                                        }
                                                                    }
                                                                }
                                                                ?>
                                                            </select>

                                                        </div>
                                                        <div class="form-group">
                                                            <label for="po_num">Required Quantity </label><span class="text-danger">*</span>
                                                            <input type="number" name="req_qty" placeholder="Enter Quantity" min="1" value="" class="form-control">

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
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Supplier name</th>
                                            <th>Part No</th>
                                            <th>Part Description</th>
                                            <th>Part Rate</th>
                                            <th>HSN</th>
                                            <th>UOM</th>
                                            <th>PO No</th>
                                            <th>PO Date</th>
                                            <th>GRN No</th>
                                            <th>GRN Date</th>
                                            <th>Invoice Number</th>
                                            <th>Invoice Date</th>
                                            <th>PO Qty</th>
                                            <th>Accepted QTY</th>
                                            <th>Basic Amount</th>
                                            <th>SGST</th>
                                            <th>CGST</th>
                                            <th>IGST</th>
                                            <th>TCS</th>
                                            <th>GST Total</th>
                                            <th>Total Amount With GST</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        if ($grn_details) {
                                            foreach ($grn_details as $g) {

                                                $gst_amount = (float)($g->sgst_amount + $g->cgst_amount + $g->igst_amount + $g->tcs_amount);
                                                $total_with_gst = $gst_amount + $g->base_amount;
                                                $tcs_amount = 0;
                                                if(!empty($g->tcs_amount)){
                                                    $tcs_amount = $g->tcs_amount;
                                                }
                                        ?>

                                                    <tr>
                                                        <td><?php echo $i;?></td>
                                                        <td><?php echo $g->supplier_name ?></td>
                                                        <td><?php echo $g->part_number ?></td>
                                                        <td><?php echo $g->part_description ?></td>
                                                        <td><?php echo $g->rate ?></td>
                                                        <td><?php echo $g->hsn_code; ?></td>
                                                        <td><?php echo $g->uom_name; ?></td>
                                                        <td style="white-space: nowrap;"><?php echo $g->poNumber; ?></td>
                                                        <td style="white-space: nowrap;"><?php echo $this->Crud->getDateByFormat($g->po_date); ?></td>
                                                        <td style="white-space: nowrap;"><?php echo $g->grn_number; ?></td>
                                                        <td style="white-space: nowrap;"><?php echo $g->grn_created_date; ?></td>
                                                        <td><?php echo $g->invoice_number; ?></td>
                                                        <td style="white-space: nowrap;"><?php echo $this->Crud->getDateByFormat($g->invoice_date); ?></td>
                                                        <td><?php echo $g->po_qty; ?></td>
                                                        <td><?php echo $g->accept_qty; ?></td>
                                                        <td><?php echo $g->base_amount; ?></td>
                                                        <td><?php echo $g->sgst_amount; ?></td>
                                                        <td><?php echo $g->cgst_amount; ?></td>
                                                        <td><?php echo $g->igst_amount; ?></td>
                                                        <td><?php echo $tcs_amount; ?></td>
                                                        <td><?php echo $gst_amount; ?></td>
                                                        <td><?php echo $total_with_gst; ?></td>
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