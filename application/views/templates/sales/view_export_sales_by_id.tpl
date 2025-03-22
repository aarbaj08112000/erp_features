<div  class="wrapper container-xxl flex-grow-1 container-p-y">
<!-- Navbar -->
<!-- /.navbar -->
<!-- Main Sidebar Container -->
<nav aria-label="breadcrumb">
   <div class="sub-header-left pull-left breadcrumb">
      <h1>
         Planning & Sales
         <a hijacked="yes" href="#stock/issue_request/index" class="backlisting-link" title="Back to Issue Request Listing" >
         <i class="ti ti-chevrons-right" ></i>
         <em >Export Invoice</em></a>
      </h1>
      <br>
      <span >Export Invoice Details</span>
   </div>
</nav>
<div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5 listing-btn">
            <a title="Back To View Sales Invoice" class="btn btn-seconday" href="<%$base_url%>export_invoice_released" type="button"><i class="ti ti-arrow-left"></i></a>
        </div>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<!-- Main content -->
<section class="content">
   <div class="">
      <div class="row">
         <div class="col-12">
          <input type="hidden" value="<%$new_sales[0]->id %>" id="sales_primary_id" class="form-control">
          <input type="hidden" value="<%$new_sales[0]->created_date %>" id="invoice_date" class="form-control">
          <input type="hidden" value="<%$new_sales[0]->sales_number %>" id="invoice_no" class="form-control">
          <input type="hidden" value="<%$new_sales[0]->sales_number %>" id="sales_number" class="form-control">
            <!-- /.card -->
            <%if ($new_sales[0]->status == "Pending" )%>
            <div class="card p-0 mt-4">
               <div class="card-header">
                  <form action="<%$base_url%>update_export_invoice_update" method="POST" id="update_export_invoice_update">
                     <input type="hidden" name="sales_id" value="<%$uri_segment_2%>">
                     <div class="row">
                        
                                    <div class="col-lg-4">
                                       
                                            <div class="form-group mb-3">
                                                <label for="" class="form-label">Currency <span class="text-danger">*</span></label>
                                                <select name="currency" id="currency"  class="form-control select2">
                                                    <option value=''>Select Country</option>
                                                    <%if !empty($currency_master)%>
                                                        <%foreach from=$currency_master item=s%>
                                                            <option value="<%$s->id%>" <%if $new_sales[0]->currency == $s->id%>selected<%/if%>><%$s->name%></option>
                                                        <%/foreach%>
                                                    <%/if%>
                                                </select>
                                            </div>
                                    </div>
                                     <div class="col-lg-4">
                                       
                                     </div>
                                     <div class="col-lg-4">
                                       
                                     </div>

                                    <div class="col-lg-4">
                                       
                                            <div class="form-group mb-3">
                                                <label for="" class="form-label">Country Of Origin <span class="text-danger">*</span></label>
                                                <select name="country_of_origin" id="country_of_origin"  class="form-control select2">
                                                    <option value=''>Select Country Of Origin</option>
                                                    <%if !empty($country_master)%>
                                                        <%foreach from=$country_master item=s%>
                                                            <option value="<%$s->id%>" <%if $new_sales[0]->country_of_origin == $s->id%>selected<%/if%>><%$s->name%></option>
                                                        <%/foreach%>
                                                    <%/if%>
                                                </select>
                                            </div>
                                    </div>
                                    <div class="col-lg-4">
                                       
                                            <div class="form-group mb-3">
                                                <label for="" class="form-label">Port Of Loading <span class="text-danger">*</span></label>
                                                <select name="port_of_loadinga" id="port_of_loadinga"  class="form-control select2">
                                                    <option value=''>Select Port Of Loading</option>
                                                    <%if !empty($port_master)%>
                                                        <%foreach from=$port_master item=s%>
                                                            <option value="<%$s->id%>" <%if $new_sales[0]->port_of_loading == $s->id%>selected<%/if%>><%$s->name%></option>
                                                        <%/foreach%>
                                                    <%/if%>
                                                </select>
                                            </div>
                                    </div>
                                    <div class="col-lg-4">
                                       
                                            <div class="form-group mb-3">
                                                <label for="" class="form-label">Country Of Discharge <span class="text-danger">*</span></label>
                                                <select name="country_of_discharge" id="country_of_discharge"  class="form-control select2">
                                                    <option value=''>Select Country Of Discharge</option>
                                                    <%if !empty($country_master)%>
                                                        <%foreach from=$country_master item=s%>
                                                            <option value="<%$s->id%>" <%if $new_sales[0]->country_of_discharge == $s->id%>selected<%/if%> ><%$s->name%></option>
                                                        <%/foreach%>
                                                    <%/if%>
                                                </select>
                                            </div>
                                    </div>
                                    <div class="col-lg-4">
                                       
                                            <div class="form-group mb-3">
                                                <label for="" class="form-label">Port Of Discharge <span class="text-danger">*</span></label>
                                                <select name="port_of_discharge" id="port_of_discharge"  class="form-control select2">
                                                    <option value=''>Select Port Of Discharge</option>
                                                    <%if !empty($port_master)%>
                                                        <%foreach from=$port_master item=s%>
                                                            <option value="<%$s->id%>" <%if $new_sales[0]->port_of_discharge == $s->id%>selected<%/if%>><%$s->name%></option>
                                                        <%/foreach%>
                                                    <%/if%>
                                                </select>
                                            </div>
                                    </div>
                                    <div class="col-lg-4">
                                       
                                            <div class="form-group mb-3">
                                                <label for="" class="form-label">Country Of Destination <span class="text-danger">*</span></label>
                                                <select name="country_of_destination" id="country_of_destination"  class="form-control select2">
                                                    <option value=''>Select Country Of Destination</option>
                                                    <%if !empty($country_master)%>
                                                        <%foreach from=$country_master item=s%>
                                                            <option value="<%$s->id%>" <%if $new_sales[0]->country_of_destination == $s->id%>selected<%/if%>><%$s->name%></option>
                                                        <%/foreach%>
                                                    <%/if%>
                                                </select>
                                            </div>
                                    </div>
                                    <div class="col-lg-4">
                                       
                                            <div class="form-group mb-3">
                                                <label for="" class="form-label">Final Destination <span class="text-danger">*</span></label>
                                                <select name="final_destination" id="final_destination"  class="form-control select2">
                                                    <option value=''>Select Final Destination</option>
                                                    <%if !empty($port_master)%>
                                                        <%foreach from=$port_master item=s%>
                                                            <option value="<%$s->id%>" <%if $new_sales[0]->final_destination == $s->id%>selected<%/if%>><%$s->name%></option>
                                                        <%/foreach%>
                                                    <%/if%>
                                                </select>
                                            </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="" class="form-label">Precarriage By<span class="text-danger">*</span></label>
                                            <input type="text" placeholder="Enter Remark" value="<%$new_sales[0]->precarriage_by%>" name="precarriage_by" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="" class="form-label">Container No<span class="text-danger">*</span></label>
                                            <input type="text" placeholder="Enter Remark" value="<%$new_sales[0]->container_no%>" name="container_no" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="" class="form-label">Checked In<span class="text-danger">*</span></label>
                                            <input type="text" placeholder="Enter Remark" value="<%$new_sales[0]->checked_in%>" name="checked_in" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="" class="form-label">Packed In<span class="text-danger">*</span></label>
                                            <input type="text" placeholder="Enter Remark" value="<%$new_sales[0]->packed_in%>" name="packed_in" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="" class="form-label">Total Boxes<span class="text-danger">*</span></label>
                                            <input type="text" placeholder="Enter Remark" value="<%$new_sales[0]->total_boxes%>" name="total_boxes" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="" class="form-label">Transporter</label>
                                            <select name="transporter"  class="form-control select2">
                                                <option value="">Select Transporter</option>
                                                <%if !empty($transporter)%>
                                                    <%foreach from=$transporter item=tr%>
                                                        <option value="<%$tr->id%>" <%if $new_sales[0]->transporter == $tr->id%>selected<%/if%>><%$tr->name%> - <%$tr->transporter_id%></option>
                                                    <%/foreach%>
                                                <%/if%>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="" class="form-label">NET WEIGHT (Kg)<span class="text-danger">*</span></label>
                                            <input type="text" placeholder="Enter Remark" value="<%$new_sales[0]->net_weight%>" name="net_weight" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="" class="form-label">GROSS WEIGHT (Kg)<span class="text-danger">*</span></label>
                                            <input type="text" placeholder="Enter Remark" value="<%$new_sales[0]->gross_weight%>" name="gross_weight" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="" class="form-label">Remark</label>
                                            <input type="text" placeholder="Enter Remark" value="<%$new_sales[0]->remark%>" name="remark" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="" class="form-label">Note</label>
                                            <textarea placeholder="Enter Remark" value="" name="note" class="form-control"><%$new_sales[0]->note%>
                                            </textarea>

                                        </div>
                                    </div>
                                    
                     </div>
                     <div class="col-lg-5">
                                        <div class="form-group">

                                            <button type="submit" class="btn btn-danger mt-4">Update</button>
                                        </div>
                                    </div>
                    </form>
                  
               </div>
            </div>
            <div class="card p-0 mt-4">
               <div class="card-header">
                <div class="row">
                    <div class="tgdp-rgt-tp-sect">
                        <p class="tgdp-rgt-tp-ttl">Customer Name</p>
                        <p class="tgdp-rgt-tp-txt" title="<%$customer[0]->customer_name%>">
                        <%$customer[0]->customer_name%>
                        </p>
                    </div>
                    <div class="tgdp-rgt-tp-sect">
                        <p class="tgdp-rgt-tp-ttl">Sales Invoice Number</p>
                        <p class="tgdp-rgt-tp-txt" title="<%$customer[0]->customer_name%>">
                        <%$new_sales[0]->sales_number%>
                        </p>
                    </div>
                </div>
                </div>
            </div>
            <%else%>
            <div class="card p-0 mt-4">
               <div class="card-header">
                <div class="row">
                    <div class="tgdp-rgt-tp-sect">
                        <p class="tgdp-rgt-tp-ttl">Customer Name</p>
                        <p class="tgdp-rgt-tp-txt" title="<%$customer[0]->customer_name%>">
                        <%$customer[0]->customer_name%>
                        </p>
                    </div>
                    <div class="tgdp-rgt-tp-sect">
                        <p class="tgdp-rgt-tp-ttl">Sales Invoice Number</p>
                        <p class="tgdp-rgt-tp-txt" title="<%$customer[0]->customer_name%>">
                        <%$new_sales[0]->sales_number%>
                        </p>
                    </div>
                    <div class="tgdp-rgt-tp-sect">
                        <p class="tgdp-rgt-tp-ttl">Currency</p>
                        <p class="tgdp-rgt-tp-txt" title="<%$currency_key_wise[$new_sales[0]->currency]%>">
                        <%$currency_key_wise[$new_sales[0]->currency]%>
                        </p>
                    </div>
                    <div class="tgdp-rgt-tp-sect">
                        <p class="tgdp-rgt-tp-ttl">Country Of Origin</p>
                        <p class="tgdp-rgt-tp-txt" title="<%$country_key_wise[$new_sales[0]->country_of_origin]%>">
                        <%$country_key_wise[$new_sales[0]->country_of_origin]%>
                        </p>
                    </div>
                    <div class="tgdp-rgt-tp-sect">
                        <p class="tgdp-rgt-tp-ttl">Port Of Loading</p>
                        <p class="tgdp-rgt-tp-txt" title="<%$port_key_wise[$new_sales[0]->port_of_loading]%>">
                        <%$port_key_wise[$new_sales[0]->port_of_loading]%>
                        </p>
                    </div>
                    <div class="tgdp-rgt-tp-sect">
                        <p class="tgdp-rgt-tp-ttl">Country Of Discharge</p>
                        <p class="tgdp-rgt-tp-txt" title="<%$country_key_wise[$new_sales[0]->country_of_discharge]%>">
                        <%$country_key_wise[$new_sales[0]->country_of_discharge]%>
                        </p>
                    </div>
                    <div class="tgdp-rgt-tp-sect">
                        <p class="tgdp-rgt-tp-ttl">Port Of Discharge</p>
                        <p class="tgdp-rgt-tp-txt" title="<%$port_key_wise[$new_sales[0]->port_of_discharge]%>">
                        <%$port_key_wise[$new_sales[0]->port_of_discharge]%>
                        </p>
                    </div>
                    <div class="tgdp-rgt-tp-sect">
                        <p class="tgdp-rgt-tp-ttl">Country Of Destination</p>
                        <p class="tgdp-rgt-tp-txt" title="<%$country_key_wise[$new_sales[0]->country_of_destination]%>">
                        <%$country_key_wise[$new_sales[0]->country_of_destination]%>
                        </p>
                    </div>
                    <div class="tgdp-rgt-tp-sect">
                        <p class="tgdp-rgt-tp-ttl">Final Destination</p>
                        <p class="tgdp-rgt-tp-txt" title="<%$port_key_wise[$new_sales[0]->final_destination]%>">
                        <%$port_key_wise[$new_sales[0]->final_destination]%>
                        </p>
                    </div>
                    <div class="tgdp-rgt-tp-sect">
                        <p class="tgdp-rgt-tp-ttl">Precarriage By</p>
                        <p class="tgdp-rgt-tp-txt" title="<%$new_sales[0]->precarriage_by%>">
                        <%$new_sales[0]->precarriage_by%>
                        </p>
                    </div>
                    <div class="tgdp-rgt-tp-sect">
                        <p class="tgdp-rgt-tp-ttl">Container No</p>
                        <p class="tgdp-rgt-tp-txt" title="<%$new_sales[0]->container_no%>">
                        <%$new_sales[0]->container_no%>
                        </p>
                    </div>
                    <div class="tgdp-rgt-tp-sect">
                        <p class="tgdp-rgt-tp-ttl">Checked In</p>
                        <p class="tgdp-rgt-tp-txt" title="<%$new_sales[0]->checked_in%>">
                        <%$new_sales[0]->checked_in%>
                        </p>
                    </div>
                    <div class="tgdp-rgt-tp-sect">
                        <p class="tgdp-rgt-tp-ttl">Packed In</p>
                        <p class="tgdp-rgt-tp-txt" title="<%$new_sales[0]->packed_in%>">
                        <%$new_sales[0]->packed_in%>
                        </p>
                    </div>
                    <div class="tgdp-rgt-tp-sect">
                        <p class="tgdp-rgt-tp-ttl">Total Boxes</p>
                        <p class="tgdp-rgt-tp-txt" title="<%$new_sales[0]->total_boxes%>">
                        <%$new_sales[0]->total_boxes%>
                        </p>
                    </div>
                    <div class="tgdp-rgt-tp-sect">
                        <p class="tgdp-rgt-tp-ttl">Transporter</p>
                        <p class="tgdp-rgt-tp-txt" title="<%$transporter_key_wise[$new_sales[0]->transporter]%>">
                        <%$transporter_key_wise[$new_sales[0]->transporter]%>
                        </p>
                    </div>
                    <div class="tgdp-rgt-tp-sect">
                        <p class="tgdp-rgt-tp-ttl">NET WEIGHT (Kg)</p>
                        <p class="tgdp-rgt-tp-txt" title="<%$new_sales[0]->net_weight%>">
                        <%$new_sales[0]->net_weight%>
                        </p>
                    </div>
                    <div class="tgdp-rgt-tp-sect">
                        <p class="tgdp-rgt-tp-ttl">GROSS WEIGHT (Kg)</p>
                        <p class="tgdp-rgt-tp-txt" title="<%$new_sales[0]->packed_in%>">
                        <%$new_sales[0]->gross_weight%>
                        </p>
                    </div>
                                    
                </div>
               </div>
            </div>
            <%/if%>
            <%if $new_sales[0]->status == "Lock" || $new_sales[0]->status == "Pending" %>
            <div class="card mt-3">
               <div class="card-header pdf-btn-block">
                    <div class="row">
                    <%if $new_sales[0]->status == "Lock" || $new_sales[0]->status == "Pending" %>
                    <div class="col-lg-1 view-original" >
                        <div class="form-group ">
                            <a class="btn btn-success" href="<%$base_url%>view_original_export_invoice/<%$uri_segment_2%>" target="_blank">View Original</a>
                        </div>
                    </div>
                    <%/if%>
                    <%if $new_sales[0]->status == "Pending"%>
                      <%if $po_parts%>
                            <%if $session_type == 'admin' || $session_type == 'Admin' || $session_type == 'Sales'%>
                                    <%assign var="flag" value=0%>
                                    <%assign var="final_po_amount" value=0%>
                                    <%assign var="i" value=1%>
                                    <%foreach from=$po_parts item=p%>
                                    <%if empty($p->tax_id)%>
                                    <%assign var="flag" value=1%>
                                    <%/if%>
                                    <%/foreach%>
                                    <%if $flag == 0%>
                                    <div class="col-lg-1 view-original" >
                                    <button type="button" class="btn btn-info ml-1 " data-bs-toggle="modal" data-bs-target="#lock">
                                    Lock Invoice
                                    </button>
                                    </div>
                                        <%if $new_sales[0]->status == "Pending" %>
                                        <div class="col-lg-1 view-original" >
                                        <button type="button" class="btn btn-danger ml-1" data-bs-toggle="modal" data-bs-target="#deleteInvoice">
                                        Delete Invoice
                                        </button>
                                      </div>
                                        <%/if%>
                                  <%/if%>
                            <%/if%>
                      <%/if%>
                  <%/if%>
                    <%if $po_parts%>
                    <div class="col-lg-1 view-original" >
                        <a href="<%$base_url%>export_packing_slip/<%$uri_segment_2%>" class="btn btn-info ml-1 ">
                            Packing Slip
                        </a>
                       
                    </div>
                    <%if $export_packing_slip['packing_number'] neq ''%>
                    <div class="col-lg-1 view-original" >
                        <a href="<%$base_url%>export_packing_slip_download/<%$uri_segment_2%>" class="btn btn-info ml-1 ">
                            Packing Download
                        </a>
                    </div>
                    <%/if%>
                    <%/if%>
                  
                    <%if $new_sales[0]->status == "Lock" %>
                    

                    <!-- Print selection -->
                    <form action="<%$base_url%>export_print_sales_invoice/<%$uri_segment_2%>" method="post" class="mt-0 w-50">
                       <div class="row">
                          <div class="col-lg-1 mt-2 original-check hide">
                             <div class="form-group">    
                                <input type="checkbox" id="original" checked name="interests[]" value="ORIGINAL_FOR_RECIPIENT">
                                <label for="original">Original</label><br>
                             </div>
                          </div>
                          <div class="col-lg-1  mt-2 duplicate-check hide">
                             <div class="form-group">    
                                <input type="checkbox" id="duplicate" name="interests[]" value="DUPLICATE_FOR_TRANSPORTER">
                                <label for="duplicate">Duplicate</label><br>
                             </div>
                          </div>
                          <div class="col-lg-1 mt-2 triplicate-check hide">
                             <div class="form-group">
                                <input type="checkbox" id="triplicate" name="interests[]" value="TRIPLICATE_FOR_SUPPLIER">
                                <label for="triplicate">Triplicate</label><br>
                             </div>
                          </div>
                          <div class="col-lg-1 mt-2 acknowledge-check hide">
                             <div class="form-group" >   
                                <input type="checkbox" id="acknowledge" name="interests[]" value="ACKNOWLEDGEMENT_COPY">
                                <label for="acknowledge">Acknowledge</label><br>
                             </div>
                          </div>
                          <div class="col-lg-1 mt-2 extra-copy-check hide">
                             <div class="form-group">   
                                <input type="checkbox" id="extraCopy" name="interests[]" value="EXTRA_COPY">
                                <label for="extraCopy">Extra Copy</label><br>
                             </div>
                          </div>        
                          <div class="col-lg-1 print-btn me-5">
                             <div class="form-group">
                                <button type="submit" onclick="this.form.target='_blank';return true;" class="btn btn-info btn"> Print </button>
                             </div>
                          </div>
                          <div class="col-lg-2 print-btn">
                             <div class="form-group">
                                <button type="submit" name="action" value="download" class="btn btn-info btn"> Download </button>
                             </div>
                          </div>
                       </div>
                    </form>
            <%/if%>
            
               </div>
            </div>
            </div>
            <%/if%>
          
            <div class="card mt-3">
               <div class="card-header">

               <%if $new_sales[0]->status == "Pending" %>
                     <form action="<%$base_url%>add_export_sales_parts" method="post" id="salesForm">
                        <div class="row">
                           <div class="col-lg-3">
                              <div class="form-group">
                                 <label for="" class="mb-2">PO no / PO start date / PO end date / PO amendment no<span class="text-danger">*</span></label>
                                 <select name="po_id" id="customer_tracking"  class="form-control select2">
                                    <%if $po_parts%>
                                    <%foreach from=$customer_tracking item=c%>
                                    <%if $po_parts[0]->po_number == $c->po_number%>
                                    <option value="<%$c->id%>"><%$c->po_number%> // <%$c->po_start_date%> // <%$c->po_end_date%> //<%$c->po_amendment_number%></option>
                                    <%/if%>
                                    <%/foreach%>
                                    <%else%>
                                    <%foreach from=$customer_tracking item=c%>
                                    <option <%if $po_parts && $po_parts[0]->po_id == $c->id%>selected<%/if%> value="<%$c->id%>"><%$c->po_number%> // <%$c->po_start_date%> // <%$c->po_end_date%> // <%$c->po_amendment_number%></option>
                                    <%/foreach%>
                                    <%/if%>
                                 </select>
                              </div>
                           </div>
                           <div class="col-lg-3">
                              <div class="form-group">
                                 <label for="" class="mb-2">Part NO / Description / FG Stock / Rate / Packing QTY <span class="text-danger">*</span> </label>
                                 <input type="hidden" readonly id="customer_tracking_id" name="customer_tracking_id" class="form-control">
                                 <select name="part_id" id="part_id"  class="form-control select2">
                                    <option value=''>Please select</option>
                                 </select>
                              </div>
                           </div>
                           <!-- <div class="col-lg-3">
                              <div class="form-group">
                                 <label for="" class="mb-2">Heat No<span class="text-danger">*</span> </label>
                                 <input type="text" step="any" name="heat_no" placeholder="Enter Heat No"  class="form-control">
                              </div>
                           </div> -->
                           
                           <div class="col-lg-3">
                              <div class="form-group">
                                 <label for="" class="mb-2">Enter Qty<span class="text-danger">*</span> </label>
                                 <input type="text" step="any" name="qty" placeholder="Enter QTY"  class="form-control onlyNumericInput">
                                 <input type="hidden" name="sales_number" value="<%$new_sales[0]->sales_number%>" placeholder="Enter QTY " required class="form-control">
                                 <input type="hidden" name="sales_id" value="<%$new_sales[0]->id%>" placeholder="Enter QTY " required class="form-control">
                                 <input type="hidden" name="customer_id" value="<%$customer[0]->id%>" placeholder="Enter QTY " required class="form-control">
                                 <input type="hidden" name="discountType" value="<%$new_sales[0]->discountType %>" />
                           <input type="hidden" name="discount" value="<%$new_sales[0]->discount %>" />
                              </div>
                           </div>
                           <div class="col-lg-2">
                              <div class="form-group mt-2">
                                 <%if $new_sales[0]->status == "Pending" %>
                                 <button type="submit" class="btn btn-info btn mt-3">Add</button>
                                 <%/if%>
                              </div>
                           </div>
                        </div>
                     </form>
                <%/if%>
                 <div class="row pdf-btn-block">
                <%if $new_sales[0]->status == "Lock"%>
                    <%if $session_type == 'admin' || $session_type == 'Admin'%>
                    <div class="col-lg-2 packaging-sticker">
                    <button type="button" disabled class="btn btn-success ml-1" data-bs-toggle="modal">
                    Invoice already released
                    </button>
                  </div>
                    <%/if%>
                  <%else%>
                    <%if ($new_sales[0]->status != "Pending" && $new_sales[0]->status != "Cancelled") && $new_sales[0]->status != "unlocked"%>
                    <button type="button" disabled class="btn btn-success ml-1 col-lg-2 " data-bs-toggle="modal">
                    Invoice already released
                    </button>
                    <%elseif $new_sales[0]->status == "Cancelled"%>
                    <button type="button" disabled class="btn btn-success ml-1 col-lg-2 " data-bs-toggle="modal">
                    Invoice already Cancelled
                    </button>
                    <%/if%>
                  <%/if%>
                   
                
                  
                  <!-- Lock Model -->
                  <div class="modal fade" id="lock" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                     <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                           <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Update</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                              </button>
                           </div>
                           <div class="modal-body">
                              <div class="row">
                                 <form action="<%$base_url%>lock_export_invoice" method="POST" id="lock_invoice" class="lock_invoice">
                                    <div class="col-lg-12">
                                       <div class="form-group">
                                          <label for=""><b>Are you sure you want to Lock this invoice?</b> </label>
                                          <input type="hidden" name="new_po_id" id="new_po_id" value="" required class="form-control">
                                          <input type="hidden" name="id" value="<%$new_sales[0]->id%>" required class="form-control">
                                          <input type="hidden" name="status" value="lock" required class="form-control">
                                          <input type="hidden" name="sales_amount" id="sales_amount" value="<%$final_po_amount_value %>" />
                                          <input type="hidden" name="sales_gst_amount" id="sales_gst_amount" value="<%$sales_gst_amount_vlue %>" />
                                       </div>
                                    </div>
                              </div>
                           </div>
                           <div class="modal-footer">
                           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                           <button type="submit" class="btn btn-primary">Update</button>
                           </div>
                        </div>
                        </form>
                     </div>
                  </div>
                  
                  <div class="modal fade" id="deleteInvoice" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                     <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                           <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                              </button>
                           </div>
                           <div class="modal-body">
                              <div class="row">
                                 <form action="<%$base_url%>delete_sale_invoice" method="POST" class="delete_sales_invoice" id="delete_sales_invoice">
                                    <div class="col-lg-12">
                                       <div class="form-group">
                                          <label for=""><b>Are you sure you want to delete this invoice?</b> </label>
                                          <input type="hidden" name="sales_id" value="<%$new_sales[0]->id%>" required class="form-control">
                                          <input type="hidden" name="status" value="pending" required class="form-control">
                                       </div>
                                    </div>
                              </div>
                           </div>
                           <div class="modal-footer">
                           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                           <button type="submit" class="btn btn-primary">Update</button>
                           </div>
                        </div>
                        </form>
                     </div>
                  </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
            <div class="card mt-3">
            
                  <div class="table-responsive text-nowrap ">
                     <table  width="100%" border="1" cellspacing="0" cellpadding="0" class="table table-striped scrollable w-100" style="border-collapse: collapse;" border-color="#e1e1e1" id="part_data">
                        <thead>
                           <tr>
                              <!-- <th>Sr No</th> -->
                              <th width="15%">Part Number</th>
                              <th  width="20%">Part Description</th>
                              <!--<th  width="10%">Heat No</th>-->
                              <th  width="10%">UOM</th>
                              <th  width="10%">QTY</th>
                              <th  width="10%">Price</th>
                              <%if $new_sales[0]->status == "Pending" %>
                              <th  width="10%">Actions</th>
                              <%/if%>
                              <th  width="10%" style="width: 100px !important;">Total Price</th>
                           </tr>
                        </thead>
                        <tbody>
                            <%assign var="final_po_amount_value" value=0%>
                           <%if $po_parts%>
                           <%foreach from=$po_parts item=p key=srNo%>
                          
                           <%if $p->part_price > 0%>
                           <%assign var="rate" value=$p->part_price%>
                           <%/if%>
                           <%assign var="final_po_amount_value" value=$final_po_amount_value+$p->basic_total%>
                           <tr>
                              <!-- <td><%$srNo + 1%></td> -->
                              <td><%$child_part_data[$p->part_id][0]->part_number%></td>
                              <td><%$child_part_data[$p->part_id][0]->part_description%></td>
                              <!--<td><%$p->heat_no%></td>-->
                              <td><%$p->uom_id%></td>
                              <td><%$p->qty%></td>
                              <td><%number_format($rate, 2)%></td>
                              <%if $new_sales[0]->status == "Pending" %>
                              <td>
                                 <button type="button" class="btn btn-danger ml-1" data-bs-toggle="modal" data-bs-target="#exampleModaldelete<%$srNo%>">
                                 Delete
                                 </button>
                                 <!-- Modal -->
                                 <div class="modal fade" id="exampleModaldelete<%$srNo%>" tabindex="-1" aria-labelledby="" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                       <div class="modal-content">
                                          <div class="modal-header">
                                             <h5 class="modal-title" id="exampleModalLabel">Update</h5>
                                             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                             <span aria-hidden="true">&times;</span>
                                             </button>
                                          </div>
                                          <div class="modal-body">
                                             <form action="<%$base_url%>delete" method="POST" class="delete_form">
                                                <div class="row">
                                                   <div class="col-lg-12">
                                                      <div class="form-group">
                                                         <label for=""><b>Are You Sure Want To Delete This Invoice?</b> </label>
                                                         <input type="hidden" name="id" value="<%$p->id%>" required class="form-control">
                                                         <input type="hidden" name="table_name" value="export_sales_parts" required class="form-control">
                                                      </div>
                                                   </div>
                                                </div>
                                          </div>
                                          <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                          <button type="submit" class="btn btn-primary">Update</button>
                                          </div>
                                       </div>
                                    </div>
                                    </form>
                                 </div>
                              </td>
                              <%/if%>
                              <td><%number_format($p->basic_total, 2)%></td>
                           </tr>
                           <%/foreach%>
                           <%/if%>
                        </tbody>
                        <tfoot>
                          <%if ($new_sales[0]->status == "Pending") %>
                           <%assign var="noOfColumns" value=6%>
                          <%else%>
                            <%assign var="noOfColumns" value=5%>
                          <%/if%>
                           <%if $po_parts%>
                           <tr >
                              <th colspan='<%$noOfColumns%>' style="width: 100%;" class="text-right ">Total
                              </th>
                              <th style="width: 7.5%;"><%number_format($final_po_amount_value, 2)%></th>
                           </tr>
                           <%/if%>
                        </tfoot>
                     </table>
                  </div>
                  <!-- /.card-body -->
              
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
<style type="text/css">
  .form-check-input{
    border: 1px solid #e1d5d5 !important;
    border-radius: 50%;
    border: 0px solid #d9dee3;
  }
</style>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script>
   $(document).ready(function() {
       var id = $("#customer_tracking").val();
       $('#new_po_id').val(id);
       var salesno = $('#sales_number').val();
       $.ajax({
           url: '<%$base_url%>Newcontroller/get_po_sales_parts',
           type: "POST",
           data: {
               id: id,
               salesno: salesno
           },
           cache: false,
           beforeSend: function() {
               // Show the loading icon
               $("#loading-overlay").show();
           },
           success: function(response) {
               if (response) {
                   $('#part_id').html(response);
               } else {
                   $('#part_id').html(response);
               }
           },
           complete: function() {
               // Hide the loading overlay
               $("#loading-overlay").hide();
           }
       });
   
       $("#customer_tracking").change(function() {
           var id = $("#customer_tracking").val();
           var salesno = $('#sales_number').val();
           $.ajax({
               url: '<%$base_url%>Newcontroller/get_po_sales_parts',
               type: "POST",
               data: {
                   id: id,
                   salesno: salesno
               },
               cache: false,
               beforeSend: function() {
                   // Show the loading icon
                   $("#loading-overlay").show();
               },
               success: function(response) {
                   if (response) {
                       $('#part_id').html(response).trigger("change");
                   } else {
                       $('#part_id').html(response).trigger("change");
                   }
               },
               complete: function() {
                   // Hide the loading overlay
                   $("#loading-overlay").hide();
               }
           });
       });
   
       $("#printSticker").click(function() {
           var salesId = $('#sales_primary_id').val();
           var invoice_no = $('#invoice_no').val();
           var invoice_date = $('#invoice_date').val();
           $.ajax({
               url: '<%$base_url%>SalesController/getSalesPartPackaging_details',
               type: "POST",
               data: {
                   salesId: salesId,
                   invoice_no: invoice_no,
                   invoice_date: invoice_date
               },
               cache: false,
               beforeSend: function() {},
               success: function(response) {
                let res = JSON.parse(response);
                   if (res.html) {
                       $('#observationTableData').html(res.html);
                   } else {
                      $('#observationTableData').html(res.html);
                   }
               }
           });
       });
   
       $("#salesForm").validate({
           ignore: [],
           rules: {
               po_id: {
                   required: true
               },
               part_id: {
                   required: true
               },
               qty: {
                   required: true,
                   number: true
               },
               heat_no: {
                   required: true
               }
           },
           messages: {
               po_id: {
                   required: "Please select a PO."
               },
               part_id: {
                   required: "Please select a part."
               },
               qty: {
                   required: "Please enter quantity.",
                   number: "Please enter a valid quantity."
               },
               heat_no: {
                   required: "Please enter heat no.",
               }
           },
           errorPlacement: function(error, element) {
               error.addClass('error');
               element.closest('.form-group').append(error);
           },
           onkeyup: function(element) {
               $(element).valid();
           },
           onchange: function(element) {
               $(element).valid();
           },
           submitHandler: function(form) {
               event.preventDefault(); // Prevent default form submission
   
               $.ajax({
                   url: form.action,
                   type: form.method,
                   data: $(form).serialize(),
                   success: function(response) {
                       // Handle the successful response here
                      if(response != '' && response != null && typeof response != 'undefined'){
                           let res = JSON.parse(response);
                           console.log(res);
                           if(res['sucess'] == 1){
                               toastr.success(res['msg']);
                               setTimeout(() => {
                                   window.location.reload();
                               }, 1000);
                           }else{
                               toastr.error(res['msg']);
                           }
                      }
                   },
                   error: function(xhr, status, error) {
                       // Handle the error response here
                       alert("An error occurred: " + xhr.responseText);
                   }
               });
           }
       });
        $("#generate_EwayBill").validate({
           ignore: [],
           rules: {
               transMode: {
                   required: true
               },
               transporterId: {
                   required: true
               },
               vehicleNo: {
                   required: true,
                   // pattern: /^[A-Za-z0-9]{4,20}$/,
               },
               distance:{
                  required: true,
               }
           },
           messages: {
               transMode: {
                   required: "Please enter mode of transporter."
               },
               transporterId: {
                   required: "Please enter Transporter."
               },
               vehicleNo: {
                   required: "Please enter vehicle no.",
                   pattern: "Please enter a valid vehicle number in the format XX00XX0000"
               },
               distance:{
                  required: "Please enter distance of transportation",
               }
           },
           errorPlacement: function(error, element) {
               error.addClass('error');
               element.closest('.form-group').append(error);
           },
           submitHandler: function(form) {
               event.preventDefault(); // Prevent default form submission
                
               $.ajax({
                   url: form.action,
                   type: form.method,
                   data: $(form).serialize(),
                   success: function(response) {
                       // Handle the successful response here
                      if(response != '' && response != null && typeof response != 'undefined'){
                           let res = JSON.parse(response);
                           if(res['success'] == 1){
                               toastr.success(res['messages']);
                               setTimeout(() => {
                                   window.location.reload();
                               }, 1000);
                           }else{
                               toastr.error(res['messages']);
                           }
                      }
                   },
                   error: function(xhr, status, error) {
                       // Handle the error response here
                       alert("An error occurred: " + xhr.responseText);
                   }
               });
           }
       });
   
       // Manually trigger validation on select2 elements change
       $('.select2').on('change', function() {
           $(this).valid();
       });
   
       $('.delete_form').on('submit', function(event) {
       event.preventDefault(); // Prevent the form from submitting via the browser
       var form = $(this);
       var formData = form.serialize();
   
       $.ajax({
           type: 'POST',
           url: form.attr('action'),
           data: formData,
           success: function(response) {
               // Handle success
               toastr.success('part deleted sucessfully.')
               // Optionally, you can close the modal or refresh the page or element
               setTimeout(() => {
                   window.location.reload();
               }, 1000);
           },
           error: function(xhr, status, error) {
               // Handle error
               toastr.success('unable to delete part.')
           }
       });
   });
       $(".lock_invoice,.delete_sales_invoice,.invoice_unlock,.reuse_invoice").submit(function(e){
        e.preventDefault();
       
        var href = $(this).attr("action");
        var id = $(this).attr("id");
        var formData = new FormData($('.'+id)[0]);
        $.ajax({
          type: "POST",
          url: href,
          data: formData,
          processData: false,
          contentType: false,
          success: function (response) {
            var responseObject = JSON.parse(response);
            var msg = responseObject.messages;
            var success = responseObject.success;
            if (success == 1) {
              toastr.success(msg);
              $(this).parents(".modal").modal("hide")
              setTimeout(function(){
                if(responseObject.redirect_url != undefined){
                  window.location.href = responseObject.redirect_url;
                }else{
                  window.location.reload();
                }
              },1000);

            } else {
              toastr.error(msg);
            }
          },
          error: function (error) {
            console.error("Error:", error);
          },
        });
      });


   
   });
$("#update_export_invoice_update").validate({
                rules: {
                    customer_id: {
                        required: true
                    },
                    currency: {
                        required: true
                    },
                    country_of_origin: {
                        required: true
                    },
                    port_of_loadinga: {
                        required: true
                    },
                    country_of_discharge: {
                        required: true
                    },
                    port_of_discharge: {
                        required: true
                    },
                    country_of_destination: {
                        required: true
                    },
                    final_destination: {
                        required: true
                    },
                    precarriage_by: {
                        required: true
                    },
                    container_no: {
                        required: true
                    },
                    checked_in: {
                        required: true
                    },
                    packed_in: {
                        required: true
                    },
                    total_boxes: {
                        required: true
                    },
                    // transporter: {
                    //     required: true
                    // },
                    net_weight: {
                        required: true
                    },
                    gross_weight: {
                        required: true
                    },
                    customer: {
                        required: true
                    },
                    consignee: {
                        required: true
                    }
                },
                messages: {
                    customer_id: {
                        required: "Please select customer."
                    },
                    currency: {
                        required: "Please select currency."
                    },
                    country_of_origin: {
                        required: "Please select country of origin."
                    },
                    port_of_loadinga: {
                        required: "Please select port of loading."
                    },
                    country_of_discharge: {
                        required: "Please select country of discharge."
                    },
                    port_of_discharge: {
                        required: "Please select port of discharge."
                    },
                    country_of_destination: {
                        required: "Please select country of destination."
                    },
                    final_destination: {
                        required: "Please select final destination."
                    },
                    precarriage_by: {
                        required: "Please enter precarriage."
                    },
                    container_no: {
                        required: "Please select consignee."
                    },
                    checked_in: {
                        required: "Please enter checked in."
                    },
                    packed_in: {
                        required: "Please enter packaging in."
                    },
                    total_boxes: {
                        required: "Please enter total boxes."
                    },
                    transporter: {
                        required: "Please select transporter."
                    },
                    net_weight: {
                        required: "Please enter net weight."
                    },
                    gross_weight: {
                        required: "Please enter gross weight."
                    },
                    consignee: {
                        required: "Please select consignee."
                    }
                },
                errorPlacement: function(error, element) {
                // error.addClass('error');
                element.closest('.form-group').append(error);
            },
            onkeyup: function(element) {
                $(element).valid();
            },
            onchange: function(element) {
                $(element).valid();
            },
                submitHandler: function(form) {
                    // Prevent the default form submission
                    event.preventDefault();

                    // Perform your AJAX form submission here
                    $.ajax({
                        url: form.action,
                        type: form.method,
                        data: $(form).serialize(),
                        success: function(response) {
                            // Handle the successful form submission here
                            if(response != '' && response != null && typeof response != 'undefined'){
                                let res = JSON.parse(response);
                                if(res['success'] == 1){
                                    toastr.success(res.messages)
                                    
                                    setTimeout(function() {
                                        window.location.reload();
                                    }, 1000);
                                    
                                }else{
                                    toastr.error(res.messages)
                                }
                                
                            }
                            
                            
                        },
                        error: function() {
                            // Handle the error response here
                            toastr.error("An error occurred while creating the sales invoice.");
                        }
                    });
                }
            });

// function toggleDiscountSelection() {
//          var isDiscountChecked = document.querySelector('input[name="isDiscount"]:checked').value;
//          //var defaultDiscount = $('#discountId').val();
//          // Show/Hide discount type and value based on the selection
//          if (isDiscountChecked === "Yes") {
//             document.getElementById('discountTypeSection').style.display = 'block';
//             document.getElementById('discountValueSection').style.display = 'block';
//          } else {
//             document.getElementById('discountTypeSection').style.display = 'none';
//             document.getElementById('discountValueSection').style.display = 'none';
//          }
//       }

      // Initial check to show or hide on page load (if Yes/No is pre-selected)
          // document.addEventListener('DOMContentLoaded', function() {
          //    toggleDiscountSelection();
          // });
      // assign calcualted or provided discount value
     
</script>
<style type="text/css">
    @media (max-width: 500px) {
        .pdf-btn-block .print-btn {
            margin-top: 0px !important;
             margin-right:  0px !important;
            padding: 0px;
            padding-left: 0px !important;
            width: 10%;
        }
    }
</style>