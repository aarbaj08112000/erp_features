<div class="wrapper">
    <div class="content-wrapper">
        

        <!-- Main content -->
        <section class="content">
            <div class="container-xxl flex-grow-1 container-p-y">  
               <nav aria-label="breadcrumb">
                  <div class="sub-header-left pull-left breadcrumb">
                     <h1>
                        Quality
                        <a hijacked="yes" href="javascript:void(0)" class="backlisting-link" title="">
                        <i class="ti ti-chevrons-right"></i>
                        <em>Credit Note</em></a>
                     </h1>
                     <br>
                     <span>Credit Note</span>
                  </div>
               </nav> 
                <%if ($new_sales->id > 0)%>
               <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5 listing-btn">
                    <a title="Back To View Sales Invoice" class="btn btn-seconday" href="<%base_url("sales_invoice_released/") %>" type="button"><i class="ti ti-arrow-left"></i></a>
                </div>
              
              <%/if%>
               
                
                <div class="row">
                    <div class="col-12">
                        <!-- /.card -->
                        <div class="card">
                            <div class="card-header">
                              <form action="javascript:void(0)" method="POST" id="creditNoteForm">
                                <div class="row">
                                 
                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            
                                                <input type="hidden"  name="sales_id" value="<%$new_sales->id %>" class="form-control">
                                                <%if ($new_sales->customer_id > 0) %>
                                                        <input type="hidden"  name="customer_id" value="<%$new_sales->customer_id %>" class="form-control">
                                                <%/if%>
                                                <label for="" class="form-label">Customer<span class="text-danger">*</span> </label>
                                                <select name="customer_id"  id="" class="form-control select2" <%if ($new_sales->customer_id > 0) %>disabled" <%/if%>>
                                                    <%if ($customer) %>
                                                      <%foreach from=$customer item=s %>
                                                            <option value="<%$s->id %>" <%if ($new_sales->customer_id == $s->id) %>selected <%/if%>>
                                                                <%$s->customer_name %></option>
                                                    <%/foreach%>
                                                   <%/if%>
                                                </select>
                                        </div>
                                    </div>

                                    
                                    <div class="col-lg-4 mb-3">
                                        <div class="form-group">
                                            <label for="" class="form-label">Customer Debit Note No</label><span class="text-danger"></span></label>
                                            <input type="text" placeholder="Customer Debit Note No" name="customer_debit_note_no" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 mb-3">
                                        <div class="form-group">
                                            <label  class="form-label" for="on click url">Customer Debit Note Date
                                                <span class="text-danger"></span></label>
                                            <input max="<%date('Y-m-d') %>" type="date"
                                                value="" name="customer_debit_note_date"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 mb-3">
                                        <div class="form-group">
                                            <label class="form-label" for="">Client Sales Invoice No</label></label>
                                            <input type="text" placeholder="Client Sales Invoice No" name="client_sales_invoice_no" class="form-control" value="<%$new_sales->sales_number %>" <%if ($new_sales->sales_number != "") %>readonly<%/if%>>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 mb-3">
                                        <div class="form-group">
                                                <label class="form-label" for="on click url">Client Invoice Date
                                                   </label>
                                                <input max="<%date("Y-m-d") %>" type="date"
                                                    value="<%$new_sales->created_date %>" name="client_invoice_date"
                                                    class="form-control">
                                        </div>
                                    </div>
                                     <div class="col-lg-4 mb-3">
                                        <div class="form-group">
                                            <label for="" class="form-label">Mode Of Transport<span class="text-danger"><%if ($new_sales->id > 0) %>*<%/if%></label>
                                            <select name="mode" id="mode" class="form-control select2" >
                                                <option value="">Select</option>
                                                <option value="1" <%if ($new_sales->mode == 1) %>selected <%/if%>>Road</option>
                                                <option value="2" <%if ($new_sales->mode == 2) %>selected <%/if%>>Rail</option>
                                                <option value="3" <%if ($new_sales->mode == 3) %>selected <%/if%>>Air</option>
                                                <option value="4" <%if ($new_sales->mode == 4) %>selected <%/if%>>Ship</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 mb-3">
                                        <div class="form-group">
                                            <label for="" class="form-label">Transporter<span class="text-danger"><%if ($new_sales->id > 0) %>* <%/if%></label>
                                            <select name="transporter"  id="transporter" class="form-control select2">
                                                <option value="">Select Transporter</option>
                                                    <%if ($transporter) %>
                                                      <%foreach from=$transporter item=tr %>
                                                            <option value="<%$tr->id %>" <%if ($new_sales->transporter_id == $tr->id)%>selected<%/if%>><%$tr->name%> - <%$tr->transporter_id %></option>
                                                    <%/foreach%>
                                                    <%/if%>
                                                </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 mb-3">
                                        <div class="form-group">
                                            <label for="" class="form-label">Vehicle No.<span class="text-danger"><%if ($new_sales->id > 0) %>*<%/if%></span></label>
                                            <input type="text" 
                                            placeholder="Enter Vehicle No" 
                                            value="<%$new_sales->vehicle_number %>" 
                                            name="vehicle_number" 
                                            pattern="^([A-Z|a-z|0-9]{4,20})$"
                                            oninvalid="this.setCustomValidity('Please enter a valid vehicle number in the format XX00XX0000')" 
                                            onchange="this.setCustomValidity('')"
                                             class="form-control"
                                            id="vehicle_number" >
                                        </div>
                                    </div>
                                    <div class="col-lg-4 mb-3">
                                        <div class="form-group">
                                            <label for="" class="form-label">L.R No </label>
                                            <input type="text" placeholder="Enter L.R No" value="<%$new_sales->lr_number %>" name="lr_number" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 mb-3">
                                        <div class="form-group">
                                            <label for="" class="form-label">P&F Charges</label>
                                            <input type="text" placeholder="Enter P&F Charges" value="" name="freight_charges" class="form-control">
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-4 hide mb-3">
                                        <div class="form-group" class="form-label">
                                            <label for="on click url">Debit Basic Amount<span
                                                    class="text-danger">*</span></label>
                                            <input type="number" step="any" min="0.00" value="0" name="debit_basic_amt"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 hide mb-3">
                                            <label for="on click url" class="form-label">GST Amount</label>
                                            <input type="number" step="any" min="0.00" name="debit_gst_amt"
                                                class="form-control">
                                    </div>
                                    <div class="col-lg-4 mb-3">
                                        <div class="form-group">
                                            <label for="" class="form-label"> Remark </label>
                                            <input type="text" placeholder="Enter Remark" value="" name="remark" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 hide mb-3">
                                        <div class="form-group">
                                            <label for="" class="form-label">Rejection Reason</label>
                                                <select name="rejection_reason" id="" class="form-control select2">
                                                   <%if ($reject_remark) %>
                                                      <%foreach from=$reject_remark item=r %>
                                                         <option value="<%$r->id %>">
                                                            <%$r->name %>
                                                         </option>
                                                      <%/foreach%>
                                                   <%/if%>
                                             </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 mb-3">
                                        <div class="form-group" >
                                            <label for="" class="form-label">Invoice Type</label>
                                             <%if ($new_sales->customer_id > 0) %>
                                                <input type="hidden"  name="form_type" value="CreditNote" class="form-control">
                                             <%/if%>
                                            <select name="form_type" id="form_type" class="form-control select2" <%if ($new_sales->id > 0) %>disabled<%/if%>>
                                                <option value="">Select Invoice Type</option>
                                                <option value="CreditNote"<%if ($new_sales->id > 0)%>selected<%/if%>>Credit Note</option>
                                                <option value="DebitNote">Debit Note</option>
                                                <option value="ProformaInvoice">Proforma Invoice</option>                     
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary mt-4">Generate Request</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                                
                                
                            </div>
                        </div>
                        <div class="card mt-4">
                            <div class="">
                                <table id="rejection_invoices_table" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <!-- <th>Sr No</th> -->
                                            <th>CN/DN/PI No</th>
                                            <th>CN/DN/PI Date</th>
                                            <th>Type</th>
                                            <th>Customer</th>
                                            <th>Customer Debit Note No</th>
                                            <th>Customer Debit Note Date</th>
                                            <th>Client Sales Invoice No</th>
                                            <th>Client Invoice Date</th>
                                            <th>Mode Of Transport</th>
                                            <th>Transporter</th>
                                            <th>Vehicle No.</th>
                                            <th>L.R No</th>
                                            <th>P&F Charges</th>
                                            <!-- <th>GST Amount</th> -->
                                            <th>View Details</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <%if ($rejection_sales_invoice) %>
                                          <%assign var=i value=1 %>
                                            
                                          <%foreach from=$rejection_sales_invoice item=u %>
                                        
                                                  <tr>
                                                    <!-- <td><%$i%></td> -->
                                                    <td><%$u->rejection_invoice_no%></td>
                                                    <td><%$u->created_date%></td>
                                                    <td>
                                                    <%if ($u->type == "DebitNote")%>
                                                        Debit Note
                                                    <%else if ($u->type == "CreditNote") %>
                                                        Credit Note
                                                    <%else%>
                                                        Proforma Invoice
                                                    <%/if%>
                                                    
                                                    
                                                    </td>
                                                    <td><%$customer_data[0]->customer_name%></td>
                                                    <td><%$u->document_number%></td>
                                                    <td><%$u->debit_note_date%></td>
                                                    <td><%$u->sales_invoice_number%></td>
                                                    <td><%$u->client_invoice_date%></td>
                                                    <td><%$mode[$u->mode]%></td>
                                                    <td><%$u->transporter%></td>
                                                    <td><%$u->vehicle_number%></td>
                                                    <td><%$u->lr_number%></td>
                                                    <td><%$u->freight_charges%></td>
                                                    
                                                    <td>
                                                        <a class="btn btn-info" href="<%base_url('view_rejection_sales_invoice_by_id/')%><%$u->id %>">
                                                            <i class="fa fa-history">
                                                            </i>
                                                        </a>
                                                    </td>

                                                </tr>

                                          <%assign var=i value=$i+1 %>
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
<style type="text/css">
    .hide {
        display: none;
    }
</style>
<script>
    var base_url = <%base_url()|json_encode%>;

</script>

<script src="<%$base_url%>/public/js/quality/reject_invoice.js"></script>
<!-- /.content-wrapper -->