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
                        <h1>Rejection Invoice</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<%$base_url%>index">Home</a></li>
                            <li class="breadcrumb-item active">Rejection Invoice</li>
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
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <form action="<%$base_url%>generate_rejection_sales_invoice" method="POST">
                                                <label for="">Select Customer<span class="text-danger">*</span> </label>
                                                <select name="customer_id" required id="" class="form-control select2">
                                                    <%if $customer%>
                                                        <%foreach from=$customer item=s%>
                                                            <option value="<%$s->id%>">
                                                                <%$s->customer_name%></option>
                                                        <%/foreach%>
                                                    <%/if%>
                                                </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Customer Debit Note No</label><span class="text-danger">*</span></label>
                                            <input type="text" placeholder="Customer Debit Note No" name="customer_debit_note_no" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="on click url">Customer Debit Note Date
                                                <span class="text-danger">*</span></label>
                                            <input max="<%$smarty.now|date_format:'%Y-%m-%d'%>" type="date"
                                                value="" name="customer_debit_note_date"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Client Sales Invoice No</label></label>
                                            <input type="text" placeholder="Client Sales Invoice No" name="client_sales_invoice_no" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="on click url">Client Invoice Date
                                                   </label>
                                                <input max="<%$smarty.now|date_format:'%Y-%m-%d'%>" type="date"
                                                    value="" name="client_invoice_date"
                                                    class="form-control">
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="on click url">Debit Basic Amount<span
                                                    class="text-danger">*</span></label>
                                            <input type="number" step="any" min="0.00" value="0" name="debit_basic_amt"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                            <label for="on click url">GST Amount</label>
                                            <input type="number" step="any" min="0.00" name="debit_gst_amt"
                                                class="form-control">
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Enter Remark </label>
                                            <input type="text" placeholder="Enter Remark" value="" name="remark" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Rejection Reason</label>
                                                <select name="rejection_reason" id="" class="form-control select2">
                                                    <%if $reject_remark%>
                                                        <%foreach from=$reject_remark item=r%>
                                                            <option value="<%$r->id%>">
                                                                <%$r->name%>
                                                            </option>
                                                        <%/foreach%>
                                                    <%/if%>
                                             </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary mt-4">Generate Request</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sr No</th>
                                            <th>Rejection Invoice No</th>
                                            <th>Customer</th>
                                            <th>Customer Debit Note No</th>
                                            <th>Customer Debit Note Date</th>
                                            <th>Client Sales Invoice No</th>
                                            <th>Client Invoice Date</th>
                                            <th>Basic Amount</th>
                                            <th>GST Amount</th>
                                            <th>View Details</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <%if $rejection_sales_invoice%>
                                            <%assign var="i" value=1%>
                                            <%foreach from=$rejection_sales_invoice item=u%>
                                                
                                                  <tr>
                                                    <td><%$i%></td>
                                                    <td><%$u->rejection_invoice_no%></td>
                                                    <td><%$customer_data[$u->customer_id][0]->customer_name%></td>
                                                    <td><%$u->document_number%></td>
                                                    <td><%defaultDateFormat($u->debit_note_date)%></td>
                                                    <td><%$u->sales_invoice_number%></td>
                                                    <td><%defaultDateFormat($u->client_invoice_date)%></td>
                                                    <td><%$u->debit_basic_amt%></td>
                                                    <td><%$u->debit_gst_amt%></td>
                                                    <td>
                                                        <a class="btn btn-info" href="<%$base_url%>view_rejection_sales_invoice_by_id/<%$u->id%>">
                                                            <i class="fa fa-history">
                                                            </i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <%assign var="i" value=$i+1%>
                                            <%/foreach%>
                                        <%/if%>
                                    </tbody>
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
