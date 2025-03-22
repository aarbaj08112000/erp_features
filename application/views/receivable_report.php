<div class="wrapper" style="width:2500px">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Receivable Reports</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
                            <li class="breadcrumb-item active">Receivable Reports</li>
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
                                    <div class="col-lg-2">
                                        <form action="<?php echo base_url('receivable_report'); ?>" method="post">

                                        <div class="form-group">
                                            <label for="">Select Customer  <span class="text-danger">*</span></label>
                                            <select name="customer_part_id" id="" class="from-control select2" required>
                                                <option value="">Select Customer</option>
                                                                <?php
                                                                if ($customers) {
                                                                    foreach ($customers as $c) 
                                                                    {
                                                                ?>
                                                                    <option value="<?php echo $c->id?>"
                                                                        <?php if($selected_customer_part_id === $c->id)
                                                                            echo "selected";?>
                                                                    ><?php echo $c->customer_name; ?></option>
                                                                <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-1">
                                    </div>
                                    <div class="col-lg-2">
                                        <input type="submit" class="btn btn-primary mt-4"value="Search">
                                     </form>
                                    </div>
                                </div>
                                <!-- Button trigger modal -->
                                <!-- <button type="button" class="btn btn-primary float-left" data-toggle="modal" data-target="#exampleModal">
                                    Add </button> -->
                            </div>
                            <!-- Modal -->

                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>

                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Customer Name</th>
                                            <th>Sales Inv No</th>
                                            <th>Sales Inv Date</th>
                                            <th>Basic Amount Total</th>
                                            <th>GST Total Amount</th>
                                            <th>Total Amount With GST</th>
                                            <th>Payment Terms in Days</th>
                                            <th>Due Date</th>
                                            <th>Due Days</th>
                                            <th>Payment Receipt Date</th>
                                            <th>Amount Received</th>
                                            <th>Transaction Details</th>
                                            <th>Balance Amount to Receive</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        $sales_number_group = [];
                                        // echo  $from_date;
                                        if ($sales_parts) {
                                            foreach ($sales_parts as $po) {
                                                $customer_data = $this->Crud->get_data_by_id("customer", $po->customer_id, "id");
                                                $receivable_report_data = $this->Crud->get_data_by_id("receivable_report", $po->sales_number, "sales_number");
                                                $new_sale_data = $this->Crud->get_data_by_id("new_sales", $po->sales_id, "id");
                                                $subtotal =  round($po->ttlrt - $po->gstamnt,2);
                                                $row_total = round($po->ttlrt,2) + round($po->tcsamnt,2);
                                        ?>
                                        <tr>
                                            <td><?php echo $i;?></td>
                                            <td><?php echo $customer_data[0]->customer_name ?></td>
                                            <td><?php echo $po->sales_number ?></td>
                                            <td><?php echo $new_sale_data[0]->created_date ?></td>
                                            <td><?php echo $subtotal; ?></td>
                                            <td><?php echo round($po->gst,2); ?></td>
                                            <td><?php echo round($row_total,2); ?></td>
                                            <td><?php echo $customer_data[0]->payment_terms ?></td>
                                            
                                            <td>
                                                <?php
                                                    // Get the created date from $new_sale_data[0]->created_date
                                                    $created_date_str = $new_sale_data[0]->created_date;
                                                
                                                    // Create a DateTime object by specifying the format
                                                    $dateTime = DateTime::createFromFormat('d/m/Y', $created_date_str);
                                                
                                                    if ($dateTime && is_numeric($customer_data[0]->payment_terms)) {
                                                        // Convert payment_terms to an integer for days
                                                        $payment_terms_days = (int)$customer_data[0]->payment_terms;
                                                
                                                        // Add payment_terms (in days) to the created date
                                                        $dateTime->add(new DateInterval('P' . $payment_terms_days . 'D'));
                                                
                                                        // Get the formatted due date
                                                        $due_date = $dateTime->format('d/m/Y');
                                                
                                                        echo $due_date;
                                                    } else {
                                                        echo "";
                                                    }
                                                    ?>
                                            </td>
                                            <?php 
                                            $today = new DateTime();
        
                                            // Convert due date string to a DateTime object
                                            $dueDateObject = DateTime::createFromFormat('d/m/Y', $due_date);
                                            
                                            // Calculate the interval between the due date and today's date
                                            $interval = $today->diff($dueDateObject);
                                            
                                            // Get the difference in days
                                            $due_days = $interval->format('%r%a'); // This will give the difference in days with respect to today's date
                                            
                                             ?>
                                            <?php
                                            if($due_days <= 0 && empty($receivable_report_data[0]->payment_receipt_date))
                                            {
                                            ?>
                                            <td style="background-color: red; ?>"><?php echo $due_days; ?></td>
                                            <?php } else { ?>
                                            <td><?php echo $due_days; ?></td>
                                            <?php } ?>
                                            <td><?php if(!empty($receivable_report_data[0]->payment_receipt_date)) { echo date("d/m/Y",strtotime($receivable_report_data[0]->payment_receipt_date)); } ?></td>
                                            <td><?php echo $receivable_report_data[0]->amount_received ?></td>
                                            <td><?php echo $receivable_report_data[0]->transaction_details ?></td>
                                            <td>
                                                <?php $bal_amnt = $row_total - $receivable_report_data[0]->amount_received; echo round($bal_amnt,2); ?>
                                            </td>
                                            <td>
                                                <button type="submit" data-toggle="modal" class="btn btn-sm btn-primary"
                                                    data-target="#exampleModal2<?php echo $i ?>"> <i class="fas fa-edit"></i></button>

                                                <div class="modal fade" id="exampleModal2<?php echo $i ?>" role="dialog"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Update
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">

                                                                <form action="<?php echo base_url('update_receivable_report') ?>" method="POST">
                                                                    <input type="hidden" name="sales_number" required value="<?php echo $po->sales_number ?>">
                                                                    <div class="row">
                                                                        <div class="col-lg-12">
                                                                            <div class="form-group">
                                                                                <label for="payment_receipt_date">Payment Receipt Date</label><span
                                                                                    class="text-danger">*</span>
                                                                                <input type="date" name="payment_receipt_date" required
                                                                                    class="form-control"
                                                                                    id="exampleInputEmail1"
                                                                                    aria-describedby="emailHelp"
                                                                                    placeholder="Payment Receipt Date" value="<?php echo $receivable_report_data[0]->payment_receipt_date; ?>">
                                                                            </div>

                                                                           

                                                                            <div class="form-group">
                                                                                <label for="amount_received">Amount Received</label><span
                                                                                    class="text-danger">*</span>
                                                                                <input type="text"
                                                                                    name="amount_received" required
                                                                                    class="form-control"
                                                                                    id="exampleInputEmail1"
                                                                                    aria-describedby="emailHelp"
                                                                                    placeholder="Amount Received" value="<?php echo $receivable_report_data[0]->amount_received; ?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label for="transaction_details">Trans. Details</label><span
                                                                                    class="text-danger"></span>
                                                                                <input type="text"
                                                                                    name="transaction_details"
                                                                                    class="form-control"
                                                                                    id="exampleInputEmail1"
                                                                                    aria-describedby="emailHelp"
                                                                                    placeholder="Transaction Details" value="<?php echo $receivable_report_data[0]->transaction_details; ?>">
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
                                                                </form>

                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
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