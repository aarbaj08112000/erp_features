<div class="wrapper">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <a class="btn btn-dark" href="<%$base_url%>rejection_invoices">
                            < Back </a>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<%$base_url%>dashboard">Home</a></li>
                            <li class="breadcrumb-item active"></li>
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
                            <form action="<%$base_url%>update_rejection_sales_invoice" method="POST">  
                                <div class="row">
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Rejection Invoice No</label>
                                            <input type="text" readonly value="<%$new_sales[0]->rejection_invoice_no%>" class="form-control">
                                            <input type="hidden" name="id" value="<%$new_sales[0]->id%>" required class="form-control">
                                            <input type="hidden" name="rejection_invoice_no" value="<%$new_sales[0]->rejection_invoice_no%>">

                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Customer Name</label>
                                            <input type="text" readonly value="<%$customer[0]->customer_name%>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Customer Debit Note Date</label>
                                            <input max="<%$smarty.now|date_format:'%Y-%m-%d'%>" type="date"
                                                value="<%$new_sales[0]->debit_note_date%>" name="customer_debit_note_date" 
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Customer Debit Note No</label>
                                            <input type="text" name="customer_debit_note_no" value="<%$new_sales[0]->document_number%>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Client Sales Invoice No</label>
                                            <input type="text" name="client_sales_invoice_no" value="<%$new_sales[0]->sales_invoice_number%>" placeholder="Client Sales Invoice No" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Client Invoice Date</label>
                                            <input max="<%$smarty.now|date_format:'%Y-%m-%d'%>" type="date"
                                                value="<%$new_sales[0]->client_invoice_date%>" name="client_invoice_date" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Basic Amount</label>
                                            <input type="number" step="any" min="0.00" value="<%$new_sales[0]->debit_basic_amt%>" required name="debit_basic_amt" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">GST Amount</label>
                                            <input type="number" step="any" value="<%$new_sales[0]->debit_gst_amt%>" required min="0.00" name="debit_gst_amt" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Remark</label>
                                            <input type="text" value="<%$new_sales[0]->remark%>" name="remark" placeholder="Enter Remark" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Rejection Reason</label>
                                            <select name="rejection_reason" id="" class="form-control select2">
                                                <option value="NA">NA</option>
                                                <%if $reject_remark%>
                                                    <%foreach from=$reject_remark item=r%>
                                                        <option value="<%$r->id%>" <%if $new_sales[0]->rejection_reasonky == $r->id%>selected<%/if%>><%$r->name%></option>
                                                    <%/foreach%>
                                                <%/if%>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Current Status</label>
                                            <input type="text" disabled value="<%if $new_sales[0]->status == 'accpet'%>Released<%else%><%$new_sales[0]->status%><%/if%>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary mt-4">Update</button>
                                        </div>
                                    </div>    
                                </div>
                            </div>
                            </form>
                            
                            <div class="card-header">
                                <!-- Modal -->
                                <div class="modal fade" id="accpet" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Update</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <form action="<%$base_url%>accept_po" method="POST">
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label for=""><b>Are You Sure Want To Released This PO?</b></label>
                                                                <input type="hidden" name="id" value="<%$new_sales[0]->id%>" required class="form-control">
                                                                <input type="hidden" name="status" value="accpet" required class="form-control">
                                                            </div>
                                                        </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="modal fade" id="lock" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Update</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <form action="<%$base_url%>lock_parts_rejection_sales_invoice" method="POST">
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label for=""><b>Are You Sure Want To Lock This Invoice?</b></label>
                                                                <input type="hidden" name="id" value="<%$new_sales[0]->id%>" required class="form-control">
                                                                <input type="hidden" name="status" value="lock" required class="form-control">
                                                            </div>
                                                       </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="modal fade" id="delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <form action="<%$base_url%>delete_po" method="POST">
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label for=""><b>Are You Sure Want To Delete This PO?</b></label>
                                                                <input type="hidden" name="id" value="<%$new_sales[0]->id%>" required class="form-control">
                                                                <input type="hidden" name="status" value="reject" required class="form-control">
                                                                <input type="hidden" name="table_name" value="new_po" required class="form-control">
                                                            </div>
                                                        </div>
                                               </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                           
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <form action="<%$base_url%>add_parts_rejection_sales_invoice" method="post">
                                                <label for="">Select Part Number / Description Tax Structure <span class="text-danger">*</span></label>
                                                <select name="part_id" id="" class="form-control select2">
                                                    <%if $customer_part%>
                                                        <%foreach from=$customer_part item=c%>
                                                            <option value="<%$c->id%>"><%$c->part_number%> / <%$c->part_description%></option>
                                                        <%/foreach%>
                                                    <%/if%>
                                                </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Enter Qty <span class="text-danger">*</span></label>
                                            <input type="number" name="qty" placeholder="Enter QTY" required class="form-control">
                                            <input type="hidden" name="sales_id" value="<%$new_sales[0]->id%>" required class="form-control">
                                            <input type="hidden" name="customer_id" value="<%$customer[0]->id%>" required class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Enter Remark</label>
                                            <input type="text" name="remark" placeholder="Enter Remark" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <%if $new_sales[0]->status == "pending"%>
                                                <button type="submit" class="btn btn-info btn-lg mt-4">Add</button>
                                            <%/if%>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                         
                          
                                <div class="card-header">
                                    <%if $parts_rejection_sales_invoice%>
                                        <%if $new_sales[0]->status == "pending" && ($session_type == 'admin' || $session_type == 'Admin')%>
                                            <button type="button" class="btn btn-danger ml-1" data-toggle="modal" data-target="#lock">Lock Invoice</button>
                                        <%/if%>
                                        <%if $new_sales[0]->status == "lock" && ($session_type == 'admin' || $session_type== 'Admin')%>
                                            <!-- <button type="button" class="btn btn-success ml-1" data-toggle="modal" data-target="#accpet">
                                                Accept (Released) Invoice
                                            </button>
                                            <button type="button" class="btn btn-danger ml-1" data-toggle="modal" data-target="#delete">
                                                Reject (delete) Invoice
                                            </button> -->
                                        <%else%>
                                            <%if $new_sales[0]->status != "pending"%>
                                                <button type="button" disabled class="btn btn-success ml-1" data-toggle="modal" data-target="#accpet">
                                                    Rejection Invoice Already Locked
                                                </button>
                                            <%/if%>
                                        <%/if%>
                                    <%/if%>
                                    <!-- Modal -->
                                    <div class="modal fade" id="accpet" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Update</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <form action="<%$base_url%>accept_po" method="POST">
                                                            <div class="col-lg-12">
                                                                <div class="form-group">
                                                                    <label for=""><b>Are You Sure Want To Released This PO?</b></label>
                                                                    <input type="hidden" name="id" value="<%$new_sales[0]->id%>" required class="form-control">
                                                                    <input type="hidden" name="status" value="accpet" required class="form-control">
                                                                </div>
                                                            </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </div>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="lock" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Update</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <form action="<%$base_url%>lock_invoice" method="POST">
                                                            <div class="col-lg-12">
                                                                <div class="form-group">
                                                                    <label for=""><b>Are You Sure Want To Lock This Invoice?</b></label>
                                                                    <input type="hidden" name="id" value="<%$new_sales[0]->id%>" required class="form-control">
                                                                    <input type="hidden" name="status" value="lock" required class="form-control">
                                                                </div>
                                                           </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </div>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <form action="<%$base_url%>delete_po" method="POST">
                                                            <div class="col-lg-12">
                                                                <div class="form-group">
                                                                    <label for=""><b>Are You Sure Want To Delete This PO?</b></label>
                                                                    <input type="hidden" name="id" value="<%$new_sales[0]->id%>" required class="form-control">
                                                                    <input type="hidden" name="status" value="reject" required class="form-control">
                                                                    <input type="hidden" name="table_name" value="new_po" required class="form-control">
                                                                </div>
                                                            </div>
                                                   </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </div>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered table-striped" id="example1">
                                        <thead>
                                            <tr>
                                                <th>Sr No</th>
                                                <th>Part Number</th>
                                                <th>Part Description</th>
                                                <th>QTY</th>
                                                <th>Accepted QTY</th>
                                                <th>Rejected QTY</th>
                                                <th>Created Date</th>
                                                <th>Actions</th>
                                                <th>Accept/Reject</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <%if $parts_rejection_sales_invoice%>
                                                <%foreach from=$parts_rejection_sales_invoice item=p key=i%>
                                                    
                                                    <tr>
                                                        <td><%$i+1%></td>
                                                        <td><%$child_part_data[$p->part_id][0]->part_number%></td>
                                                        <td><%$child_part_data[$p->part_id][0]->part_description%></td>
                                                        <td><%$p->qty%></td>
                                                        <td><%$p->accepted_qty%></td>
                                                        <td><%$p->rejected_qty%></td>
                                                        <td><%$p->created_date%></td>
                                                        <td>
                                                            <%if $new_sales[0]->status == "pending"%>
                                                                <!-- Button trigger modal -->
                                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal<%$i+1%>">Edit</button>
                                                                <button type="button" class="btn btn-danger ml-1" data-toggle="modal" data-target="#exampleModaldelete<%$i+1%>">Delete</button>
                                                                <!-- Modal -->
                                                                <div class="modal fade" id="exampleModal<%$i+1%>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="exampleModalLabel">Update</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="row">
                                                                                    <div class="col-lg-12">
                                                                                        <div class="form-group">
                                                                                            <form action="<%$base_url%>update_parts_rejection_sales_invoice" method="POST">
                                                                                                <label for="">Enter Qty <span class="text-danger">*</span></label>
                                                                                                <input type="number" name="qty" value="<%$p->qty%>" placeholder="Enter QTY" required class="form-control">
                                                                                                <input type="hidden" name="id" value="<%$p->id%>" required class="form-control">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                                <button type="submit" class="btn btn-primary">Update</button>
                                                                            </div>
                                                                        </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                                <!-- Modal -->
                                                                <div class="modal fade" id="exampleModaldelete<%$i+1%>" tabindex="-1" aria-labelledby="" aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="exampleModalLabel">Update</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="row">
                                                                                    <form action="<%$base_url%>delete" method="POST">
                                                                                        <div class="col-lg-12">
                                                                                            <div class="form-group">
                                                                                                <label for=""><b>Are You Sure Want To Delete This?</b></label>
                                                                                                <input type="hidden" name="id" value="<%$p->id%>" required class="form-control">
                                                                                                <input type="hidden" name="table_name" value="parts_rejection_sales_invoice" required class="form-control">
                                                                                            </div>
                                                                                        </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                                <button type="submit" class="btn btn-primary">Update</button>
                                                                            </div>
                                                                        </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            <%else%>
                                                                Can't Update, This is <%$new_sales[0]->status%>
                                                            <%/if%>
                                                        </td>
                                                        <td>
                                                            <%if $new_sales[0]->status == "completed" && $p->status == "pending"%>
                                                                <button type="button" class="btn btn-danger float-left" data-toggle="modal" data-target="#acceptReject<%$i+1%>">Accept/Reject</button>
                                                                <div class="modal fade" id="acceptReject<%$i+1%>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog modal-lg" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="exampleModalLabel">Add</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <form action="<%$base_url%>update_parts_rejection_sales_invoice" method="POST" enctype='multipart/form-data'>
                                                                                    <div class="row">
                                                                                        <div class="col-lg-12">
                                                                                            <div class="form-group">
                                                                                                <label for="">Qty</label>
                                                                                                <input type="text" value="<%$p->qty%>" readonly class="form-control">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-lg-12">
                                                                                            <div class="form-group">
                                                                                                <label for="">Accept Qty <span class="text-danger">*</span></label>
                                                                                                <input type="number" step="any" value="" max="<%$p->qty%>" min="0" class="form-control" name="accepted_qty" placeholder="Enter Accepted Quantity" required>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-lg-12">
                                                                                            <div class="form-group">
                                                                                                <label for="">Rejection Reason</label>
                                                                                                <select name="rejection_reason" id="" class="form-control select2">
                                                                                                    <option value="NA">NA</option>
                                                                                                    <%if $reject_remark%>
                                                                                                        <%foreach from=$reject_remark item=r%>
                                                                                                            <option value="<%$r->name%>"><%$r->name%></option>
                                                                                                        <%/foreach%>
                                                                                                    <%/if%>
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-lg-12">
                                                                                            <div class="form-group">
                                                                                                <label for="">Reject Remark</label>
                                                                                                <input type="text" placeholder="Enter Rejection Remark If any" class="form-control" name="rejection_remark">
                                                                                                <input type="hidden" readonly class="form-control" name="id" value="<%$p->id%>">
                                                                                                <input type="hidden" readonly class="form-control" name="qty" value="<%$p->qty%>">
                                                                                                <input type="hidden" readonly class="form-control" name="customer_part_id" value="<%$child_part_data[0]->id%>">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                                                                    </div>
                                                                            </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <%/if%>
                                                        </td>
                                                    </tr>
                                                <%/foreach%>
                                            <%/if%>
                                        </tbody>
                                        <tfoot>
                                            <%if $po_parts%>
                                                <tr>
                                                    <th colspan="11">Total</th>
                                                    <th><%$final_po_amount%></th>
                                                </tr>
                                            <%/if%>
                                        </tfoot>
                                    </table>
                                </div>
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
    
