<div class="wrapper">
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
                        <h1>Billing Track</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Billing Track</li>
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

                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary float-left" data-toggle="modal" data-target="#exampleModal">
                                    Add Billing Data </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg " role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add Billing Data </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="<?php echo base_url('addbilling_track') ?>" method="POST">
                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label> Select PO/SO </label><span class="text-danger">*</span>

                                                                <select class="form-control select2" required id="po_so_ajax" name="po_so_num" style="width: 100%;">
                                                                    <option>NA</option>

                                                                    <?php
                                                                    foreach ($c_po_so_details as $l) {
                                                                        $customer_i = $this->Crud->get_data_by_id("po_details", $l->po_id, "id");
                                                                        $customer_name = $this->Crud->get_data_by_id("customer", $customer_i[0]->customer_id, "id");
                                                                        $contractor_i = $this->Crud->get_data_by_id("loading_user", $l->po_id, "po_number");
                                                                    ?>
                                                                        <option <?php
                                                                                // if ($c->id == $l->so_number) {
                                                                                //     echo "selected";
                                                                                // } else {
                                                                                //     echo " ";    
                                                                                // }

                                                                                // 
                                                                                ?> value="<?php echo $l->id; ?>"><?php echo $customer_i[0]->po_number . " / " . $l->so_number ?></option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>






                                                            <div class="form-group">
                                                                <label for="invoice_amt">Enter Invoice amount</label><span class="text-danger">*</span>
                                                                <input type="number" name="invoice_amt" onkeyup="myFunction()" class="form-control" required id="Invoice_amt1" aria-describedby="emailHelp" placeholder="Enter Invoice amount">
                                                            </div>

                                                            <div class="form-group ">
                                                                <label for="tds_amount">Enter TDS Amount </label><span class="text-danger">*</span>
                                                                <input type="number" onkeyup="myFunction()" name="tds_amount" class="form-control " required id="tds_amount1" placeholder="Enter TDS Amount" aria-describedby="emailHelp">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="stv_amount">Enter STV amount</label><span class="text-danger">*</span>
                                                                <input type="number" onkeyup="statementBooking()" required name="stv_amount" class="form-control" id="stv_amount1" aria-describedby="emailHelp" placeholder="Enter STV amount">
                                                            </div>




                                                            <div class="form-group ">
                                                                <label for="date">Payment Terms</label><span class="text-danger">*</span>

                                                                <input type="number" readonly name="payment_terms" required class="form-control adv_amt" id="payment_terms1" placeholder="Payment Terms" aria-describedby="emailHelp">
                                                            </div>


                                                        </div>


                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label for="operation_number">Customer Name</label><span class="text-danger">*</span>
                                                                <input type="text" readonly name="customer_name" required class="form-control" id="customer_name_so" placeholder="Customer Name">

                                                            </div>
                                                            <div class="form-group">
                                                                <label for="invoice_date">Enter Invoice Date</label><span class="text-danger">*</span>
                                                                <input type="date" onchange="mkPayment()" required name="invoice_date" class="form-control" required id="invoice_date1" placeholder="Enter Invoice Date ">
                                                            </div>

                                                            <div class="form-group ">
                                                                <label for="tds_amount"> Less TDS Amount </label><span class="text-danger">*</span>
                                                                <input type="text" readonly name="less_tds_amount" required class="form-control " id="less_tds_amount1" placeholder=" Less TDS Amount" aria-describedby="emailHelp">
                                                            </div>




                                                            <div class="form-group ">
                                                                <label for="date">STV Select Date</label><span class="text-danger">*</span>
                                                                <input type="date" name="datee" class="form-control adv_amt" required id="datee" placeholder="Enter Date" aria-describedby="emailHelp">
                                                            </div>





                                                            <div class="form-group ">
                                                                <label for="date">Payment Due Date as per MK</label><span class="text-danger">*</span>
                                                                <input type="text" name="payment_due_date_mk" required readonly class="form-control adv_amt" id="payment_due_date_mk1" placeholder="Payment Due Date as per MK" aria-describedby="emailHelp">
                                                            </div>

                                                        </div>


                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label for="invoice_number">Enter Invoice Number </label><span class="text-danger">*</span>
                                                                <input type="text" name="invoice_number" required class="form-control" id="exampleInputEmail1" placeholder="Enter Invoice Number" aria-describedby="emailHelp">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="advance_amt">Enter Advance amount</label><span class="text-danger">*</span>
                                                                <input type="number" readonly name="advance_amt" class="form-control" id="advance_amountt1" aria-describedby="emailHelp" placeholder="Enter Advance amount">
                                                            </div>
                                                            <div class="form-group ">
                                                                <label for="stv_number">STV Number </label><span class="text-danger">*</span>
                                                                <input type="text" name="stv_number" required class="form-control adv_amt" id="stv_number" placeholder="Enter STV Number" aria-describedby="emailHelp">
                                                            </div>





                                                            <div class="form-group">
                                                                <label for="statement_of_booking">Statement Booking Amount </label><span class="text-danger">*</span>
                                                                <input type="text" required name="statement_of_booking" readonly required class="form-control" id="statement_of_booking1" placeholder="Statement Booking Amount" aria-describedby="emailHelp">
                                                            </div>

                                                            <div class="form-group ">
                                                                <label for="date" style="font-size: 15px;"> Payment Due Date as per Customer</label><span class="text-danger">*</span>
                                                                <input type="date" required name="payment_due_date_customer" class="form-control adv_amt" id="dateCa" placeholder="Payment Due Date as per Customer" aria-describedby="emailHelp">
                                                            </div>
                                                            <script>
                                                           

                                                            // $("#dateCa").datepicker({ minDate: -0, maxDate: new Date(2013, 1, 18) });

                                                            </script>
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
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>PO-SO</th>
                                            <th>Customer Name</th>
                                            <th>Invoice Amount</th>
                                            <th>Balance Amount</th>
                                            <th>Payment Details</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        $s = $i + 1000;
                                        if ($bill_tracking_details) {
                                            foreach ($bill_tracking_details as $l) {
                                                // $detail = $this->Crud->get_data_by_id("c_po_so", $po_details[0]->id, "id");
                                                $so_po_id = $this->Crud->get_data_by_id("c_po_so", $l->c_po_so_id, "id");
                                                // print_r(($so_po_id));
                                                $po_id = $this->Crud->get_data_by_id("po_details", $so_po_id[0]->po_id, "id");
                                                // print_r(($po_iddd));

                                                $customer = $this->Crud->get_data_by_id("customer", $po_id[0]->customer_id, "id");

                                                $result_name = array(
                                                    "customer_name" => $customer[0]->customer_name,
                                                    "payment_terms" => $customer[0]->payment_terms,
                                                    "advance_amount" => $so_po_id[0]->advance_amt,
                                                );
                                        ?>

                                                <tr>

                                                    <td><?php echo $i ?></td>
                                                    <td><?php echo $po_id[0]->po_number . " / " . $so_po_id[0]->so_number ?></td>
                                                    <td><?php echo $customer[0]->customer_name ?></td>
                                                    <td><?php echo $l->invoice_amount ?></td>
                                                    <td style="text-align: center;">
                                                        <span id="balance_amt<?php echo $i ?>"><?php echo $l->balance_amount ?></span>
                                                        <script>
                                                            $("#balance_amt<?php echo $i ?>").addClass("p-2");

                                                            var t = <?php echo $l->balance_amount ?>;
                                                            // alert(t);
                                                            if (t != 0) {
                                                                $("#balance_amt<?php echo $i ?>").css('background-color', '#FF9933');
                                                            } else {
                                                                $("#balance_amt<?php echo $i ?>").css('background-color', '#90EE90');

                                                            }
                                                        </script>
                                                    </td>
                                                    <td>
                                                        <button type="submit" data-toggle="modal" class="btn btn-sm btn-primary ml-4 payment_detailss" data-target="#adv<?php echo $s ?>"> <i class="fa fa-eye"></i></button>
                                                        <div class="modal fade" id="adv<?php echo $s ?>"" tabindex=" -1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog " role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Details </h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">

                                                                        <form action="<?php echo base_url('updateBankDetails2') ?>" method="POST">
                                                                            <div class="row">
                                                                                <div class="col-lg-6">

                                                                                    <div class="form-group">
                                                                                        <label for="advance_amt"> Amount </label><span class="text-danger">*</span>
                                                                                        <input type="number" value="<?php echo $so_po_id[0]->amount_paid ?>" name="balance_amount" class="form-control sarveshh" id="aasa<?php echo $i ?>" aria-describedby="emailHelp" placeholder="Enter amount">
                                                                                    </div>

                                                                                    <!-- <div style="display: none;" id="<?php echo $i ?>"> -->
                                                                                    <div class="form-group ">
                                                                                        <label for="bank_name">Name of Bank </label><span class="text-danger">*</span>
                                                                                        <input type="hidden" value="<?php echo $so_po_id[0]->id ?>" name="idd" onkeyup="myFunction2()" class="form-control" id="advance_amt<?php echo $i ?>" aria-describedby="emailHelp" placeholder="Enter Advance amount">
                                                                                        <input type="hidden" value="<?php echo $l->balance_amount ?>" name="balanceee_amountt" class="form-control" id="advancae_amt<?php echo $i ?>" aria-describedby="emailHelp" placeholder="Enter Advance amount">
                                                                                        <input type="hidden" value="<?php echo $l->id ?>" name="balance_idd" class="form-control" id="advancae_amt<?php echo $i ?>" aria-describedby="emailHelp" placeholder="Enter Advance amount">

                                                                                        <input type="text" value="<?php echo $so_po_id[0]->bank_name_final_payment ?>" name="ubank_name" class="form-control adv_amt sarveshh" id="bank_name" placeholder="Name of Bank" aria-describedby="emailHelp">
                                                                                    </div>

                                                                                    <div class="form-group ">
                                                                                        <label for="so_line">Date </label>
                                                                                        <input type="date" value="<?php echo $so_po_id[0]->date_of_cheque_rtgs_final_pay ?>" name="ucheque_date" class="form-control adv_amt sarveshh" id="cheque_date" placeholder="Enter SO-Line" aria-describedby="emailHelp">
                                                                                    </div>

                                                                                    <!-- </div> -->



                                                                                </div>


                                                                                <div class="col-lg-6">


                                                                                    <!-- <div style="display: none;" id="<?php echo $s ?>"> -->
                                                                                    <div class="form-group aass ">
                                                                                        <label for="advance_amt">Mode of Payment</label><span class="text-danger">*</span>
                                                                                        <select class="form-control select2 adv_amt" name="upayment_mode" style="width: 100%;">

                                                                                            <option value="Cheque">Cheque</option>
                                                                                            <option value="RTGS">RTGS</option>

                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="form-group ssaa">
                                                                                        <label for="advance_amt">Payment Type</label>
                                                                                        <input type="text" value="<?php echo $so_po_id[0]->mode_payment_final ?>" name="urtgs_cheque_number" class="form-control adv_amt sarveshh" id="rtgs_cheque_number" aria-describedby="emailHelp" placeholder="Enter Cheque/RTGS Number">
                                                                                    </div>


                                                                                    <div class="form-group">
                                                                                        <label for="advance_amt">Enter Cheque/RTGS Number</label>
                                                                                        <input type="text" value="<?php echo $so_po_id[0]->cheque_rtgs_number_final_pay ?>" name="urtgs_cheque_number" class="form-control adv_amt sarveshh" id="rtgs_cheque_number" aria-describedby="emailHelp" placeholder="Enter Cheque/RTGS Number">
                                                                                    </div>
                                                                                    <!-- </div> -->
                                                                                </div>

                                                                            </div>
                                                                            <script>
                                                                                var tale = <?php echo $l->balance_amount ?>;
                                                                                if (tale == 0) {
                                                                                    $('.sarveshh').prop('readonly', true);
                                                                                    $(".aass").hide();
                                                                                    $(".ssaa").show();

                                                                                } else {
                                                                                    $(".ssaa").hide();

                                                                                }
                                                                            </script>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>


                                                                </div>
                                                            </div>
                                                        </div>

                                                    </td>


                                                    <td>
                                                        <button type="submit" data-toggle="modal" class="btn btn-sm btn-primary view_billing_details" data-target="#updatee<?php echo $i ?>"> <i class="fa fa-eye"></i></button>
                                                        <div class="modal fade" id="updatee<?php echo $i ?>" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-xl" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel"> PO-SO:
                                                                            <?php echo $po_id[0]->po_number . " / " . $so_po_id[0]->so_number ?>
                                                                            <br> Customer Name:
                                                                            <?php echo $customer[0]->customer_name ?>

                                                                        </h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">

                                                                        <form action="<?php echo base_url('updateTransport') ?>" method="POST">
                                                                            <div class="row">
                                                                                <div class="col-lg-4">
                                                                                    <!-- <div class="form-group">
                                                                                        <label> Select PO/SO </label><span class="text-danger">*</span>

                                                                                        <select class="form-control select2" id="upo_so_ajax" name="po_so_num" style="width: 100%;">
                                                                                            <option>NA</option>

                                                                                            <?php
                                                                                            foreach ($c_po_so_details as $c_po) {
                                                                                                $customer_i = $this->Crud->get_data_by_id("po_details", $c_po->po_id, "id");
                                                                                                $customer_name = $this->Crud->get_data_by_id("customer", $customer_i[0]->customer_id, "id");
                                                                                                $contractor_i = $this->Crud->get_data_by_id("loading_user", $c_po->po_id, "po_number");
                                                                                            ?>
                                                                                                <option <?php
                                                                                                        // if ($l->c_po_so_id == $c_po->id) {
                                                                                                        //     echo "selected";
                                                                                                        // } else {
                                                                                                        //     echo " ";
                                                                                                        // }


                                                                                                        ?> value="<?php echo $l->id; ?>"><?php echo $customer_i[0]->po_number . " / " . $c_po->so_number ?></option>
                                                                                            <?php
                                                                                            }
                                                                                            ?>
                                                                                        </select>
                                                                                    </div> -->


                                                                                    <div class="form-group">
                                                                                        <label for="invoice_number">Enter Invoice Number </label><span class="text-danger">*</span>
                                                                                        <input type="text" readonly value="<?php echo $l->invoice_number; ?>" name="uinvoice_number12" required class="form-control" id="exampleInputEmail1" placeholder="Enter Invoice Number" aria-describedby="emailHelp">
                                                                                    </div>



                                                                                    <div class="form-group">
                                                                                        <label for="invoice_amt">Enter Invoice amount</label><span class="text-danger">*</span>
                                                                                        <input type="number" readonly value="<?php echo $l->invoice_amount; ?>" name="uinvoice_amt12" onkeyup="myFunction()" class="form-control" id="uInvoice_amt" aria-describedby="emailHelp" placeholder="Enter Invoice amount">
                                                                                    </div>

                                                                                    <div class="form-group ">
                                                                                        <label for="tds_amount">Enter TDS Amount </label><span class="text-danger">*</span>
                                                                                        <input type="number" readonly value="<?php echo $l->tds_amount; ?>" onkeyup="myFunction()" name="utds_amount12" class="form-control " id="utds_amount" placeholder="Enter TDS Amount" aria-describedby="emailHelp">
                                                                                    </div>

                                                                                    <div class="form-group">
                                                                                        <label for="stv_amount">Enter STV amount</label><span class="text-danger">*</span>
                                                                                        <input type="number" readonly value="<?php echo $l->stv_amount; ?>" onkeyup="statementBooking()" name="ustv_amoun12t" class="form-control" id="ustv_amount" aria-describedby="emailHelp" placeholder="Enter STV amount">
                                                                                    </div>




                                                                                    <div class="form-group ">
                                                                                        <label for="date">Payment Terms</label>

                                                                                        <input type="number" value="<?php echo $customer[0]->payment_terms ?>" readonly name="upayment_terms12" class="form-control adv_amt" id="upayment_terms" placeholder="Payment Terms" aria-describedby="emailHelp">
                                                                                    </div>


                                                                                </div>


                                                                                <div class="col-lg-4">

                                                                                    <div class="form-group">
                                                                                        <label for="invoice_date">Enter Invoice Date</label><span class="text-danger">*</span>
                                                                                        <input type="date" readonly  value="<?php echo $l->invoice_date; ?>" onchange="mkPayment()" name="uinvoice_date32" class="form-control" required id="uinvoice_date" placeholder="Enter Invoice Date ">
                                                                                    </div>

                                                                                    <div class="form-group ">
                                                                                        <label for="tds_amount"> Less TDS Amount </label><span class="text-danger">*</span>
                                                                                        <input type="text" value="<?php echo $l->less_tds_amount; ?>" readonly name="uless_tds_amount12" class="form-control " id="uless_tds_amount" placeholder=" Less TDS Amount" aria-describedby="emailHelp">
                                                                                    </div>




                                                                                    <div class="form-group ">
                                                                                        <label for="date">Select Date</label>
                                                                                        <input type="date" readonly value="<?php echo $l->date; ?>" name="udatee12" class="form-control adv_amt" id="udatee" placeholder="Enter Date" aria-describedby="emailHelp">
                                                                                    </div>





                                                                                    <div class="form-group ">
                                                                                        <label for="date">Payment Due Date as per MK</label>
                                                                                        <input type="text" value="<?php echo $l->payment_due_date_mk; ?>" name="upayment_due_date_mk23" readonly class="form-control adv_amt" id="upayment_due_date_mk" placeholder="Payment Due Date as per MK" aria-describedby="emailHelp">
                                                                                    </div>

                                                                                </div>


                                                                                <div class="col-lg-4">

                                                                                    <div class="form-group">
                                                                                        <label for="advance_amt">Enter Advance amount</label><span class="text-danger">*</span>
                                                                                        <input type="number" readonly value="<?php echo  $so_po_id[0]->advance_amt; ?>" readonly name="uadvance_amt32" class="form-control" id="uadvance_amountt" aria-describedby="emailHelp" placeholder="Enter Advance amount">
                                                                                    </div>
                                                                                    <div class="form-group ">
                                                                                        <label for="stv_number">STV Number </label>
                                                                                        <input type="text" readonly value="<?php echo $l->stv_number; ?>" name="ustv_number123" class="form-control adv_amt" id="ustv_number" placeholder="Enter STV Number" aria-describedby="emailHelp">
                                                                                    </div>





                                                                                    <div class="form-group">
                                                                                        <label for="statement_of_booking">Statement Booking Amount </label><span class="text-danger">*</span>
                                                                                        <input type="text" value="<?php echo $l->statement_booking_amount; ?>" name="ustatement_of_booking213" readonly required class="form-control" id="ustatement_of_booking" placeholder="Statement Booking Amount" aria-describedby="emailHelp">
                                                                                    </div>

                                                                                    <div class="form-group ">
                                                                                        <label for="date">Payment Due Date as per Customer</label>
                                                                                        <input type="date" value="<?php echo $l->payment_due_date_customer; ?>" name="upayment_due_date_customer213" readonly class="form-control adv_amt" id="udateC" placeholder="Payment Due Date as per Customer" aria-describedby="emailHelp">
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
                                                        </div>



                                                        <button type="submit" data-toggle="modal" class="btn btn-sm btn-primary ml-3" data-target="#edit<?php echo $i ?>"> <i class="fas fa-edit"></i></button>
                                                        <div class="modal fade" id="edit<?php echo $i ?>" tabindex=" -1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-xl" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Update </h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">

                                                                        <form action="<?php echo base_url('updatebilling_track') ?>" method="POST">
                                                                            <div class="row">
                                                                                <div class="col-lg-4">
                                                                                    <div class="form-group">
                                                                                        <label> Select PO/SO </label><span class="text-danger">*</span>

                                                                                        <!-- <input type="text" value="<?php echo $po_id[0]->po_number . " / " . $so_po_id[0]->so_number ?>" name="uinvoice_amt" onkeyup="myFunction1(<?php echo $i ?>)" class="form-control" id="uInvoice_amt1<?php echo $i ?>" aria-describedby="emailHelp" placeholder="Enter Invoice amount"> -->

                                                                                        <select class="form-control select2" readonly id="upo_so_ajax" name="upo_so_num" style="width: 100%;">
                                                                                            <!-- <option>NA</option> -->

                                                                                            <?php
                                                                                            foreach ($c_po_so_details as $c_po) {
                                                                                                $customer_i = $this->Crud->get_data_by_id("po_details", $c_po->po_id, "id");
                                                                                                $customer_name = $this->Crud->get_data_by_id("customer", $customer_i[0]->customer_id, "id");
                                                                                                $contractor_i = $this->Crud->get_data_by_id("loading_user", $c_po->po_id, "po_number");
                                                                                            ?>
                                                                                                <option <?php
                                                                                                        if ($l->c_po_so_id == $c_po->id) {
                                                                                                            echo "selected";
                                                                                                        } else {
                                                                                                            echo " ";
                                                                                                        }


                                                                                                        ?> value="
                                                                                                        <?php echo $c_po->id; ?>"><?php echo $customer_i[0]->po_number . " / " . $c_po->so_number ?>
                                                                                                </option>
                                                                                            <?php
                                                                                                break;
                                                                                            }
                                                                                            ?>
                                                                                        </select>
                                                                                    </div>






                                                                                    <div class="form-group">
                                                                                        <label for="invoice_amt">Enter Invoice amount</label><span class="text-danger">*</span>
                                                                                        <input type="number" value="<?php echo $l->invoice_amount; ?>" name="uinvoice_amt" onkeyup="myFunction1(<?php echo $i ?>)" class="form-control" id="uInvoice_amt1<?php echo $i ?>" aria-describedby="emailHelp" placeholder="Enter Invoice amount">
                                                                                        <input type="hidden" value="<?php echo $l->id; ?>" name="update_id" class="form-control" id="idd<?php echo $i ?>" aria-describedby="emailHelp" placeholder="Enter Invoice amount">
                                                                                    </div>

                                                                                    <div class="form-group ">
                                                                                        <label for="tds_amount">Enter TDS Amount </label><span class="text-danger">*</span>
                                                                                        <input type="number" value="<?php echo $l->tds_amount; ?>" onkeyup="myFunction1(<?php echo $i ?>)" name="utds_amount" class="form-control " id="utds_amount1<?php echo $i ?>" placeholder="Enter TDS Amount" aria-describedby="emailHelp">
                                                                                    </div>

                                                                                    <div class="form-group">
                                                                                        <label for="stv_amount">Enter STV amount</label><span class="text-danger">*</span>
                                                                                        <input type="number" value="<?php echo $l->stv_amount; ?>" onkeyup="statementBooking1(<?php echo $i ?>)" name="ustv_amount" class="form-control" id="ustv_amount1<?php echo $i ?>" aria-describedby="emailHelp" placeholder="Enter STV amount">
                                                                                    </div>




                                                                                    <div class="form-group ">
                                                                                        <label for="date">Payment Terms</label>

                                                                                        <input type="number" readonly value="<?php echo $customer[0]->payment_terms ?>" name="upayment_terms" class="form-control adv_amt" id="upayment_terms1<?php echo $i ?>" placeholder="Payment Terms" aria-describedby="emailHelp">
                                                                                    </div>


                                                                                </div>


                                                                                <div class="col-lg-4">
                                                                                    <div class="form-group">
                                                                                        <label for="operation_number">Customer Name</label><span class="text-danger">*</span>
                                                                                        <input type="text" readonly value="<?php echo $customer[0]->customer_name ?>" name="ucustomer_name" class="form-control" id="ucustomer_name_so" placeholder="Customer Name">

                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="invoice_date">Enter Invoice Date</label><span class="text-danger">*</span>
                                                                                        <input type="date" value="<?php echo $l->invoice_date; ?>" onchange="mkPayment1(<?php echo $i ?>)" name="uinvoice_date" class="form-control" required id="uinvoice_date1<?php echo $i ?>" placeholder="Enter Invoice Date ">
                                                                                    </div>

                                                                                    <div class="form-group ">
                                                                                        <label for="tds_amount"> Less TDS Amount </label><span class="text-danger">*</span>
                                                                                        <input type="text" value="<?php echo $l->less_tds_amount; ?>" readonly name="uless_tds_amount" class="form-control " id="uless_tds_amount1<?php echo $i ?>" placeholder=" Less TDS Amount" aria-describedby="emailHelp">
                                                                                    </div>




                                                                                    <div class="form-group ">
                                                                                        <label for="date">Select STV Date</label>
                                                                                        <input type="date" value="<?php echo $l->date; ?>" name="udatee" class="form-control adv_amt" id="udatee" placeholder="Enter Date" aria-describedby="emailHelp">
                                                                                    </div>





                                                                                    <div class="form-group ">
                                                                                        <label for="date">Payment Due Date as per MK</label>
                                                                                        <input type="text" value="<?php echo $l->payment_due_date_mk; ?>" name="upayment_due_date_mk" readonly class="form-control adv_amt" id="upayment_due_date_mk<?php echo $i ?>" placeholder="Payment Due Date as per MK" aria-describedby="emailHelp">
                                                                                    </div>

                                                                                </div>


                                                                                <div class="col-lg-4">
                                                                                    <div class="form-group">
                                                                                        <label for="invoice_number">Enter Invoice Number </label><span class="text-danger">*</span>
                                                                                        <input type="text" value="<?php echo $l->invoice_number; ?>" name="uinvoice_number" required class="form-control" id="exampleInputEmail1" placeholder="Enter Invoice Number" aria-describedby="emailHelp">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="advance_amt">Enter Advance amount</label><span class="text-danger">*</span>
                                                                                        <input type="number" value="<?php echo $so_po_id[0]->advance_amt ?>" readonly name="uadvance_amt" class="form-control" id="uadvance_amountt1<?php echo $i ?>" aria-describedby="emailHelp" placeholder="Enter Advance amount">
                                                                                    </div>
                                                                                    <div class="form-group ">
                                                                                        <label for="stv_number">STV Number </label>
                                                                                        <input type="text" value="<?php echo $l->stv_number; ?>" name="ustv_number" class="form-control adv_amt" id="ustv_number" placeholder="Enter STV Number" aria-describedby="emailHelp">
                                                                                    </div>





                                                                                    <div class="form-group">
                                                                                        <label for="statement_of_booking">Statement Booking Amount </label><span class="text-danger">*</span>
                                                                                        <input type="text" value="<?php echo $l->tds_amount; ?>" name="ustatement_of_booking" readonly required class="form-control" id="ustatement_of_booking1<?php echo $i ?>" placeholder="Statement Booking Amount" aria-describedby="emailHelp">
                                                                                    </div>

                                                                                    <div class="form-group ">
                                                                                        <label for="date">Payment Due Date as per Customer</label>
                                                                                        <input type="date" value="<?php echo $l->payment_due_date_customer; ?>" name="upayment_due_date_customer" class="form-control adv_amt" id="udateC" placeholder="Payment Due Date as per Customer" aria-describedby="emailHelp">
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
                                                        </div>
                                                        <script>
                                                            function myFunction1(my_new_id) {

                                                                var id = String(my_new_id);
                                                                // alert(id);

                                                                var invoice_amt = document.getElementById("uInvoice_amt1" + id).value;
                                                                // alert(invoice_amt);
                                                                var tds_amount = document.getElementById("utds_amount1" + id).value;
                                                                //  alert(tds_amount);
                                                                // invoice_amt = Int()
                                                                // alert(invoice_amt);
                                                                var less_tds = invoice_amt - tds_amount;
                                                                document.getElementById("uless_tds_amount1" + id).value = less_tds;
                                                            }

                                                            function statementBooking1(my_new_id) {
                                                                var id = String(my_new_id);
                                                                // alert(id);
                                                                var advance = document.getElementById("uadvance_amountt1" + id).value;
                                                                var less_tds = document.getElementById("uless_tds_amount1" + id).value;

                                                                var stv_amt = document.getElementById("ustv_amount1" + id).value;
                                                                // alert(stv_amt);

                                                                var amount = less_tds - advance - stv_amt;
                                                                document.getElementById("ustatement_of_booking1" + id).value = amount;

                                                            }


                                                            function mkPayment1(my_new_id) {
                                                                var id = String(my_new_id);
                                                               
                                                                //  alert("sda");
                                                                var invoice_date = document.getElementById("uinvoice_date1" + id).value;
                                                                var paymentTerms = parseInt(document.getElementById("upayment_terms1" + id).value);

                                                                // document.getElementById("dateCa").setAttribute("max", invoice_date); 
                                                                // alert(invoice_date);
                                                                var d = new Date(invoice_date);
                                                                // alert(d);
                                                                d.setDate(d.getDate() + paymentTerms);
                                                                // document.getElementById("demo").innerHTML = d;
                                                                // var convert = addDays(invoice_date, paymentTerms);
                                                                // var convert = date.addDays(paymentTerms);
                                                                // var my = d.split(' ')[0];
                                                                var x = String(d);
                                                                x = x.slice(4, 16)
                                                                document.getElementById("upayment_due_date_mk" + id).value = x;

                                                            }
                                                        </script>
                                                        <button type="submit" data-toggle="modal" class="btn btn-sm btn-danger ml-4" data-target="#exampleModal3"> <i class="far fa-trash-alt"></i></button>

                                                        <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form action="<?php echo base_url('delete') ?>" method="POST">

                                                                            <input value="<?php echo $l->id; ?>" name="id" type="hidden" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Machine Name">
                                                                            <input value="bill_tracking" name="table_name" type="hidden" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Machine Name">

                                                                            Are you sure you want to delete
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-danger">Delete </button>
                                                                    </div>
                                                                    </form>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- <a href="<?php echo base_url("po/" . $customer[0]->id) ?>" class="btn btn-sm btn-primary ml-4"> <i class="fa fa-eye"></i></a> -->

                                                    </td>
                                                </tr>

                                        <?php
                                                $i++;
                                                $s++;
                                            }
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>PO-SO</th>
                                            <th>Customer Name</th>
                                            <th>Invoice Amount</th>
                                            <th>Balance Amount</th>
                                            <th>Payment Details</th>

                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
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
    <script>
        $(document).ready(function() {

            $('#po_so_ajax').change(function() {

                // alert("changed");
                var so_po = $('#po_so_ajax').find(":selected").val();
                // alert(so_po);

                $.ajax({
                    url: "<?php echo base_url('') ?>get_id",
                    method: "POST",
                    data: {
                        iddd: so_po,
                    },
                    success: function(data) {
                        const obj = JSON.parse(data);
                        // alert(obj.customer_name);
                        $('#customer_name_so').val(obj.customer_name);
                        $('#payment_terms1').val(obj.payment_terms);
                        $('#advance_amountt1').val(obj.advance_amount);
                    }
                });

            });


            // $('#upo_so_ajax').change(function() {

            //     // alert("changed");
            //     var so_po = $('#upo_so_ajax').find(":selected").val();
            //      //alert(so_po);

            //     $.ajax({
            //         url: "<?php echo base_url('') ?>get_id",
            //         method: "POST",
            //         data: {
            //             iddd: so_po,
            //         },
            //         success: function(data) {
            //             const obj = JSON.parse(data);
            //              alert(obj.customer_name);
            //             $('#ucustomer_name_so').val(obj.customer_name);
            //             $('#upayment_terms').val(obj.payment_terms);
            //             $('#uadvance_amountt').val(obj.advance_amount);
            //         }
            //     });

            // });

        });



        function myFunction() {
            var invoice_amt = document.getElementById("Invoice_amt1").value;
            var tds_amount = document.getElementById("tds_amount1").value;

            var less_tds = invoice_amt - tds_amount;
            document.getElementById("less_tds_amount1").value = less_tds;
        }

        function statementBooking() {
            var advance = document.getElementById("advance_amountt1").value;
            var less_tds = document.getElementById("less_tds_amount1").value;
            var stv_amt = document.getElementById("stv_amount1").value;
            var amount = less_tds - advance - stv_amt;
            // alert(amount);
            document.getElementById("statement_of_booking1").value = amount;

        }

        function addDays(date, days) {
            var result = new Date(date);
            alert(result);
            result.setDate(result.getDate() + days);
            var datee = result.getDate();

            return result;
        }


        function mkPayment() {

            //  alert("sda");
            var invoice_date = document.getElementById("invoice_date1").value;
            var paymentTerms = parseInt(document.getElementById("payment_terms1").value);
            //alert(invoice_date);
            var d = new Date(invoice_date);
            // alert(d);
            d.setDate(d.getDate() + paymentTerms);
            // document.getElementById("demo").innerHTML = d;
            // var convert = addDays(invoice_date, paymentTerms);
            // var convert = date.addDays(paymentTerms);
            // var my = d.split(' ')[0];
            var x = String(d);
            x = x.slice(4, 16)
            document.getElementById("payment_due_date_mk1").value = x;

        }
    </script>

    <!-- /.content-wrapper -->