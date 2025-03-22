<div class="wrapper" style="width:2500px">
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
                        <h1>Sales Reports</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
                            <li class="breadcrumb-item active">Po Balance Qty</li>
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
                                <div class="row">
                                    <div class="col-lg-12">
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#exportForTally">
                                            Sales Export For Tally
                                        </button>
                                        <hr>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-2">
                                        <form action="<?php echo base_url('sales_report'); ?>" method="post">
                                            <div class="form-group">
                                                <label for="">Select Month <span class="text-danger">*</span></label>
                                                <select required name="created_month" id=""
                                                    class="form-control select2">
                                                    <?php
                                                 for ($i = 1; $i <= 12; $i++) {

                                                    $month_data = $this->Common_admin_model->get_month($i);
                                                    $month_number = $this->Common_admin_model->get_month_number($month_data);
                                                    ?>
                                                    <option <?php 
                                                    if($month_number == $created_month){echo "selected";}
                                                    ?> value="<?php echo $month_number;?>"><?php echo $month_data?>
                                                    </option>
                                                    <?php
                                                 }
                                                ?>
                                                </select>
                                            </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Select Year <span class="text-danger">*</span></label>
                                            <select required name="created_year" id="" class="form-control select2">
                                                <?php
                                                 for ($i = 2022; $i <= 2027; $i++) {
                                                    ?>
                                                <option <?php 
                                                    if($i == $created_year){echo "selected";}   
                                                    ?> value="<?php echo $i;?>"><?php echo $i?></option>
                                                <?php
                                                 }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <input type="submit" name="submit" class="btn btn-primary mt-4" value="Search">
                                        </form>
                                        <!-- Modal -->
                                        <div class="modal fade" id="exportForTally" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Sales Export
                                                            Criteria</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <form action="<?php echo base_url('sales_report') ?>"
                                                                method="POST">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Year:</label>
                                                            <select required name="search_year" id=""
                                                                class="form-control select2">
                                                                <?php
                                                 $fincYears = $this->Common_admin_model->getFinancialYears();
                                                 if($created_month < 4 ) { //if the month is below April so it is earlier financial year.
                                                    $year_sel = $created_year-1;
                                                 }
                                                 foreach($fincYears as $fyear ) {
                                                    ?>
                                                                <option <?php 
                                                    if($fyear->startYear == $year_sel){echo "selected";}
                                                    ?> value="<?php echo $fyear->startYear;?>">
                                                                    <?php echo $fyear->displayName?></option>
                                                                <?php
                                                 }
                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Month:
                                                                <span class="small"><br>Month will be ignored if Sale
                                                                    Number field is provided.</span>
                                                            </label>
                                                            <select required name="search_month" id=""
                                                                class="form-control select2">
                                                                <?php
                                                for ($i = 1; $i <= 12; $i++) {

                                                    $month_data = $this->Common_admin_model->get_month($i);
                                                    $month_number = $this->Common_admin_model->get_month_number($month_data);
                                                    ?>
                                                                <option <?php 
                                                    if($month_number == $created_month){echo "selected";}
                                                    ?> value="<?php echo $month_number;?>"><?php echo $month_data?>
                                                                </option>
                                                                <?php
                                                }
                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Sale Number/Range:</label>
                                                            <span class="small">
                                                                <br>For Individual Sale: Use only <b>number</b>,
                                                                example: <b>21</b>
                                                                <br>For Sales number range : Use <b>hypen</b>, example:
                                                                <b>23-27</b>
                                                                <br>For Specific sales : Use <b>comma</b>, example:
                                                                <b>11,15,17,18</b>
                                                                <br>&nbsp;
                                                            </span>&nbsp;<br>
                                                            <input type="text" value="" name="sale_numbers"
                                                                class="form-control" id="sale_id"
                                                                aria-describedby="emailHelp">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="submit" name="export" class="btn btn-primary"
                                                            value="XML Export">Export</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                <form action="<?php echo base_url('add_job_card') ?>" method="POST"
                                                    enctype='multipart/form-data'>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label for="po_num">Select Customer Name / Customer Code
                                                                    / Part Number / Description </label><span
                                                                    class="text-danger">*</span>
                                                                <select name="customer_part_id" id=""
                                                                    class="from-control select2">
                                                                    <?php
                                                                if ($customer_part) {
                                                                    foreach ($customer_part as $c) {
                                                                        if (true) {                                                                        // $data['toolList'] = $this->Crud->get_data_by_id("tools", "insert", "type");
                                                                            $customer = $this->Crud->get_data_by_id("customer", $c->customer_id, "id");

                                                                ?>
                                                                    <option value="<?php echo $c->id ?>">
                                                                        <?php echo $customer[0]->customer_name . "/" . $customer[0]->customer_code . "/" . $c->part_number . "/" . $c->part_description ?>
                                                                    </option>
                                                                    <?php
                                                                        }
                                                                    }
                                                                }
                                                                ?>
                                                                </select>

                                                            </div>
                                                            <div class="form-group">
                                                                <label for="po_num">Required Quantity </label><span
                                                                    class="text-danger">*</span>
                                                                <input type="number" name="req_qty"
                                                                    placeholder="Enter Quantity" min="1" value=""
                                                                    class="form-control">

                                                            </div>
                                                        </div>


                                                    </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
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
                                                <th>CUSTOMER NAME</th>
                                                <th>Customer PO No</th>
                                                <th>SALES INV NO</th>
                                                <th>SALES INV DATE</th>
                                                <th>SALES STATUS</th>
                                                <th>PART NO</th>
                                                <th>PART NAME</th>
                                                <th>HSN</th>
                                                <th>QTY</th>
                                                <th>UOM</th>
                                                <th>Part Price</th>
                                                <th>BASIC AMOUNT TOTAL</th>
                                                <th>SGST</th>
                                                <th>CGST</th>
                                                <th>IGST</th>
                                                <th>TCS</th>
                                                <th>GST TOTAL AMOUNT</th>
                                                <th>TOTAL AMOUNT WITH GST</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                        $i = 1;
                                        if ($sales_parts) {
                                            foreach ($sales_parts as $po) {
                                                if($po->basic_total > 0 ){
                                                    $subtotal = $po->basic_total;
                                                }else{
                                                    $subtotal =  round($po->total_rate - $po->gst_amount,2);
                                                }

                                                if ($po->part_price > 0) {
                                                    $rate = $po->part_price;
                                                }else{
                                                    $rate = round((float) $subtotal / (float) $po->qty, 2);
                                                }

                                                $row_total = round($po->total_rate,2) + round($po->tcs_amount,2);
                                        ?>
                                            <tr>
                                                <td><?php echo $i;?></td>
                                                <td><?php echo $po->customer_name ?></td>
                                                <td><?php echo $po->po_number ?></td>
                                                <td><?php echo $po->salesNumber ?></td>
                                                <td><?php echo $po->sales_date ?></td>
                                                <td><?php echo $po->status ?></td>
                                                <td><?php echo $po->part_number ?></td>
                                                <td><?php echo $po->part_description ?></td>
                                                <td><?php echo $po->hsn_code ?></td>
                                                <td><?php echo $po->qty; ?></td>
                                                <td><?php echo $po->uom_id; ?></td>
                                                 <td><?php echo $rate; ?></td>
                                                <td><?php echo $subtotal ?></td>
                                                <td><?php echo round($po->sgst_amount,2); ?></td>
                                                <td><?php echo round($po->cgst_amount,2); ?></td>
                                                <td><?php echo round($po->igst_amount,2); ?></td>
                                                <td><?php echo round($po->tcs_amount,2); ?></td>
                                                <td><?php echo round($po->gst_amount,2); ?></td>
                                                <td><?php echo round($row_total,2); ?></td>
                                            </tr>
                                            <?php
                                                    $i++;
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
    <!-- /.content-wrapper -->