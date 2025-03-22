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
                        <h1>PO Details</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">PO Details</li>
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
                                <h3 class="card-title">
                                    <form class="form-inline">
                                        <div class="form-group mb-2">
                                            <label for="" class="p-2">PO-Number</label>
                                            <input type="text" readonly name="PO" value="<?php echo $po_details[0]->po_number ?>" class="form-control" required id="exampleInputPassword1" placeholder="Operation Number">
                                        </div>
                                        <div class="form-group mx-sm-3 mb-2">
                                            <label for="inputPassword2" class="p-2">Customer Name</label>
                                            <input type="text" readonly name="custname" value="<?php echo $cust[0]->customer_name ?>" class="form-control" id="exampleInputEmail1" placeholder="Fixture Name" aria-describedby="emailHelp">
                                        </div>
                                    </form>

                                </h3>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal">
                                    Add SO Line </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg " role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add SO Line </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="<?php echo base_url('addSO') ?>" method="POST">
                                                    <div class="row">
                                                        <div class="col-lg-6">


                                                            <!-- <div class="form-group">
                                                                <label for="operation_number">Operation Number</label><span class="text-danger">*</span>
                                                                <input type="text" name="operationNumber" class="form-control" required id="exampleInputPassword1" placeholder="Operation Number">

                                                        </div>-->

                                                            <div class="form-group">
                                                                <label for="so_number">Enter SO number </label><span class="text-danger">*</span>
                                                                <input type="text" name="so_number" required class="form-control" id="exampleInputEmail1" placeholder="Enter SO Number" aria-describedby="emailHelp">
                                                                <input type="hidden" name="pid" value="<?php echo $po_details[0]->id ?>" class="form-control" id="exampleInputEmail1" placeholder="Fixture Name" aria-describedby="emailHelp">

                                                            </div>
                                                            <div class="form-group">
                                                                <label for="so_amt">Enter SO P.O amount </label><span class="text-danger">*</span>
                                                                <input type="text" name="so_amt" required class="form-control" id="exampleInputEmail1" placeholder="Enter SO P.O amount" aria-describedby="emailHelp">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="advance_amt">Enter Advance amount</label><span class="text-danger">*</span>
                                                                <input type="number" name="advance_amt" onkeyup="myFunction()" class="form-control" id="advance_amt" aria-describedby="emailHelp" placeholder="Enter Advance amount">
                                                            </div>

                                                            <div style="display: none;" id="chg">
                                                                <div class="form-group ">
                                                                    <label for="bank_name">Name of Bank </label><span class="text-danger">*</span>
                                                                    <input type="text" name="bank_name" class="form-control adv_amt" id="bank_name" placeholder="Name of Bank" aria-describedby="emailHelp">
                                                                </div>

                                                                <div class="form-group ">
                                                                    <label for="so_line">Date </label>
                                                                    <input type="date" name="cheque_date" class="form-control adv_amt" id="cheque_date" placeholder="Enter SO-Line" aria-describedby="emailHelp">
                                                                </div>

                                                            </div>



                                                        </div>


                                                        <div class="col-lg-6">

                                                            <div class="form-group">
                                                                <label for="so_desc">Enter SO description</label><span class="text-danger">*</span>
                                                                <input type="text" name="so_desc" class="form-control" required id="exampleInputPassword1" placeholder="Enter SO description ">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="so_line">Enter SO-Line </label><span class="text-danger">*</span>
                                                                <input type="text" name="so_line" required class="form-control" id="exampleInputEmail1" placeholder="Enter SO-Line" aria-describedby="emailHelp">
                                                            </div>
                                                            <div style="display: none;" id="chg1">
                                                                <div class="form-group ">
                                                                    <label for="advance_amt">Mode of Payment</label><span class="text-danger">*</span>
                                                                    <select class="form-control select2 adv_amt" name="payment_mode" style="width: 100%;">

                                                                        <option value="Cheque">Cheque</option>
                                                                        <option value="RTGS">RTGS</option>

                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="advance_amt">Enter Cheque/RTGS Number</label>
                                                                    <input type="text" name="rtgs_cheque_number" class="form-control adv_amt" id="rtgs_cheque_number" aria-describedby="emailHelp" placeholder="Enter Cheque/RTGS Number">
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
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>SO Line</th>
                                            <th>SO Number</th>
                                            <th>SO Description</th>
                                            <th>SO PO Amount</th>
                                            <th>Advance Amount</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        $s = $i + 1000;
                                        if ($list) {
                                            foreach ($list as $l) {
                                                $detail = $this->Crud->get_data_by_id("c_po_so", $po_details[0]->id, "id");
                                                // print_r($customer);

                                        ?>

                                                <tr>
                                                    <td><?php echo $i ?></td>
                                                    <td><?php echo $l->so_line ?></td>
                                                    <td><?php echo $l->so_number ?></td>
                                                    <td><?php echo $l->so_amt ?></td>
                                                    <td><?php echo $l->so_desc ?></td>
                                                    <td><?php echo $l->advance_amt; ?>
                                                        <button type="submit" data-toggle="modal" class="btn btn-sm btn-primary float-right adv_amt_details " data-target="#exampleModaledit2<?php echo $s ?>"> <i class="fa fa-eye"></i></button>
                                                        <div class="modal fade" id="exampleModaledit2<?php echo $s ?>"" tabindex=" -1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog " role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Details </h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">

                                                                        <form action="<?php echo base_url('updateBankDetails') ?>" method="POST">
                                                                            <div class="row">
                                                                                <div class="col-lg-6">

                                                                                    <div class="form-group">
                                                                                        <label for="advance_amt">Enter Advance amount</label><span class="text-danger">*</span>
                                                                                        <input type="number"  readonly value="<?php echo $l->advance_amt ?>" name="uadvance_amt" onkeyup="myFunction2()" class="form-control" id="advance_amt<?php echo $i ?>" aria-describedby="emailHelp" placeholder="Enter Advance amount">
                                                                                        <input type="hidden" value="<?php echo $l->id ?>" name="idd" onkeyup="myFunction2()" class="form-control" id="advance_amt<?php echo $i ?>" aria-describedby="emailHelp" placeholder="Enter Advance amount">
                                                                                    </div>

                                                                                    <!-- <div style="display: none;" id="<?php echo $i ?>"> -->
                                                                                    <div class="form-group ">
                                                                                        <label for="bank_name">Name of Bank </label><span class="text-danger">*</span>
                                                                                        <input type="text" required value="<?php echo $l->bank_name ?>" name="ubank_name" class="form-control adv_amt" id="bank_name" placeholder="Name of Bank" aria-describedby="emailHelp">
                                                                                    </div>

                                                                                    <div class="form-group ">
                                                                                        <label for="so_line">Date </label>
                                                                                        <input type="date" required value="<?php echo $l->date_of_cheque_rtgs ?>" name="ucheque_date" class="form-control adv_amt" id="cheque_date" placeholder="Enter SO-Line" aria-describedby="emailHelp">
                                                                                    </div>

                                                                                    <!-- </div> -->



                                                                                </div>


                                                                                <div class="col-lg-6">


                                                                                    <!-- <div style="display: none;" id="<?php echo $s ?>"> -->
                                                                                    <div class="form-group ">
                                                                                        <label for="advance_amt">Mode of Payment</label><span class="text-danger">*</span>
                                                                                        <select class="form-control select2 adv_amt" name="upayment_mode" style="width: 100%;">

                                                                                            <option value="Cheque">Cheque</option>
                                                                                            <option value="RTGS">RTGS</option>

                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="advance_amt">Enter Cheque/RTGS Number</label>
                                                                                        <input type="text" value="<?php echo $l->cheque_rtgs_number ?>" name="urtgs_cheque_number" class="form-control adv_amt" id="rtgs_cheque_number" aria-describedby="emailHelp" placeholder="Enter Cheque/RTGS Number">
                                                                                    </div>
                                                                                    <!-- </div> -->
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

                                                    </td>


                                                    <td>
                                                        <button type="submit" data-toggle="modal" class="btn btn-sm btn-primary" data-target="#exampleModaledit2<?php echo $i ?>"> <i class="fas fa-edit"></i></button>
                                                        <div class="modal fade" id="exampleModaledit2<?php echo $i ?>"" tabindex=" -1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Update Oeration</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">

                                                                        <form action="<?php echo base_url('updateSO') ?>" method="POST">
                                                                            <div class="row">
                                                                                <div class="col-lg-6">




                                                                                    <div class="form-group">
                                                                                        <label for="so_number">Enter SO number </label><span class="text-danger">*</span>
                                                                                        <input type="text" name="uso_number" value="<?php echo $l->so_number ?>" required class="form-control" id="exampleInputEmail1" placeholder="Enter SO Number" aria-describedby="emailHelp">
                                                                                        <input type="hidden" name="id" value="<?php echo $l->id ?>" required class="form-control" id="exampleInputEmail1" placeholder="Enter SO Number" aria-describedby="emailHelp">

                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="so_amt">Enter SO P.O amount </label><span class="text-danger">*</span>
                                                                                        <input type="text" name="uso_amt" value="<?php echo $l->so_amt ?>" required class="form-control" id="exampleInputEmail1" placeholder="Enter SO P.O amount" aria-describedby="emailHelp">
                                                                                    </div>

                                                                                    <div class="form-group">
                                                                                        <label for="advance_amt">Enter Advance amount</label><span class="text-danger">*</span>
                                                                                        <input type="number" value="<?php echo $l->advance_amt ?>" name="uadvance_amt" onkeyup="myFunction2()" class="form-control" id="advance_amt<?php echo $i ?>" aria-describedby="emailHelp" placeholder="Enter Advance amount">
                                                                                    </div>
                                                                                    <!-- 
                                                                                    <div style="display: none;" id="<?php echo $i ?>">
                                                                                        <div class="form-group ">
                                                                                            <label for="bank_name">Name of Bank </label><span class="text-danger">*</span>
                                                                                            <input type="text" value="<?php echo $l->bank_name ?>" name="ubank_name" class="form-control adv_amt" id="bank_name" placeholder="Name of Bank" aria-describedby="emailHelp">
                                                                                        </div>

                                                                                        <div class="form-group ">
                                                                                            <label for="so_line">Date </label>
                                                                                            <input type="date" value="<?php echo $l->date_of_cheque_rtgs ?>" name="ucheque_date" class="form-control adv_amt" id="cheque_date" placeholder="Enter SO-Line" aria-describedby="emailHelp">
                                                                                        </div>

                                                                                    </div> -->



                                                                                </div>


                                                                                <div class="col-lg-6">

                                                                                    <div class="form-group">
                                                                                        <label for="so_desc">Enter SO description</label><span class="text-danger">*</span>
                                                                                        <input type="text" value="<?php echo $l->so_desc ?>" name="uso_desc" class="form-control" required id="exampleInputPassword1" placeholder="Enter SO description ">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="so_line">Enter SO-Line </label><span class="text-danger">*</span>
                                                                                        <input type="text" value="<?php echo $l->so_line ?>" name="uso_line" required class="form-control" id="exampleInputEmail1" placeholder="Enter SO-Line" aria-describedby="emailHelp">
                                                                                    </div>
                                                                                    <!-- <div style="display: none;" id="<?php echo $s ?>">
                                                                                        <div class="form-group ">
                                                                                            <label for="advance_amt">Mode of Payment</label><span class="text-danger">*</span>
                                                                                            <select class="form-control select2 adv_amt" name="upayment_mode" style="width: 100%;">

                                                                                                <option value="Cheque">Cheque</option>
                                                                                                <option value="RTGS">RTGS</option>

                                                                                            </select>
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label for="advance_amt">Enter Cheque/RTGS Number</label>
                                                                                            <input type="text" value="<?php echo $l->cheque_rtgs_number ?>" name="urtgs_cheque_number" class="form-control adv_amt" id="rtgs_cheque_number" aria-describedby="emailHelp" placeholder="Enter Cheque/RTGS Number">
                                                                                        </div>
                                                                                    </div> -->
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
                                                                            <input value="c_po_so" name="table_name" type="hidden" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Machine Name">

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
                                                <script>
                                                    // function myFunction() {
                                                    //     var x = String(document.getElementById("advance_amt").value);
                                                    //     // alert(x.length);
                                                    //     if (x.length > 0) {
                                                    //         document.getElementById("chg").style.display = '';
                                                    //         document.getElementById("chg1").style.display = '';
                                                    //         // document.getElementById("bank_name").required = 'required';
                                                    //         // document.getElementsByClassName("adv_amt").required = true;
                                                    //     } else {
                                                    //         document.getElementById("chg").style.display = 'none';
                                                    //         document.getElementById("chg1").style.display = 'none';
                                                    //         // document.getElementsByClassName("adv_amt").required = false;

                                                    //     }
                                                    // }

                                                    // function myFunction2() {
                                                    //     var x = String(document.getElementById("advance_amt<?php echo $i ?>").value);
                                                    //     // alert(x.length);
                                                    //     if (x.length > 0) {
                                                    //         document.getElementById("<?php echo $i ?>").style.display = '';
                                                    //         document.getElementById("<?php echo $s ?>").style.display = '';
                                                    //         // document.getElementById("bank_name").required = 'required';
                                                    //         // document.getElementsByClassName("adv_amt").required = true;
                                                    //     } else {
                                                    //         document.getElementById("<?php echo $i ?>").style.display = 'none';
                                                    //         document.getElementById("<?php echo $s ?>").style.display = 'none';
                                                    //         // document.getElementsByClassName("adv_amt").required = false;

                                                    //     }
                                                    //}
                                                </script>
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
                                            <th>SO Line</th>
                                            <th>SO Number</th>
                                            <th>SO Description</th>
                                            <th>SO PO Amount</th>
                                            <th>Advance Amount</th>
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

    <!-- /.content-wrapper -->