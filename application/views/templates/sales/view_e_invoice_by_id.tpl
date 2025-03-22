<div class="wrapper container-xxl flex-grow-1 container-p-y">
   <!-- Navbar -->
   <!-- /.navbar -->
   <!-- Main Sidebar Container -->
   <!-- Content Wrapper. Contains page content -->

   <nav aria-label="breadcrumb">
      <div class="sub-header-left pull-left breadcrumb">
        <h1>
          Planning & Sales
          <a hijacked="yes" href="#stock/issue_request/index" class="backlisting-link" title="Back to Issue Request Listing" >
            <i class="ti ti-chevrons-right" ></i>
            <em >Sales Invoice</em></a>
        </h1>
        <br>
        <span >E-Invoics</span>
      </div>
    </nav>
     <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5 listing-btn">
            <a title="View Invoice" class="btn btn-primary" href="<%$base_url%>view_new_sales_by_id/<%$sales_id%>" type="button">View Invoice</a>
            <a title="Back To View Sales Invoice" class="btn btn-seconday" href="<%$base_url%>sales_invoice_released" type="button"><i class="ti ti-arrow-left"></i></a>

        </div>

   <div class="content-wrapper">
      <!-- Content Header (Page header) -->
     
      </section>
      <!-- Main content -->
      <section class="content">
         <div class="">
            <div class="row">
               <div class="col-12">
                  <!-- /.card -->
                  <div class="card">
                     <div class="card-header">
                        <div class="row">
                        
                        <div class="row">
                              <div class="tgdp-rgt-tp-sect">
                                 <p class="tgdp-rgt-tp-ttl">Customer Name </p>
                                 <p class="tgdp-rgt-tp-txt"><%$customer[0]->customer_name%></p>
                              </div>
                              <div class="tgdp-rgt-tp-sect">
                                 <p class="tgdp-rgt-tp-ttl">Sales Invoice Number </p>
                                 <p class="tgdp-rgt-tp-txt"><%$new_sales[0]->sales_number%></p>
                              </div>
                              <div class="tgdp-rgt-tp-sect">
                                 <p class="tgdp-rgt-tp-ttl">Invoice Date </p>
                                 <p class="tgdp-rgt-tp-txt"><%$new_sales[0]->created_date%></p>
                              </div>
                              <div class="tgdp-rgt-tp-sect">
                                 <p class="tgdp-rgt-tp-ttl">E Invoice Status</p>
                                 <p class="tgdp-rgt-tp-txt"><%$einvoice_res_data[0]->Status%></p>
                              </div>
                          
                           <div class="tgdp-rgt-tp-sect">
                                 <p class="tgdp-rgt-tp-ttl">EWay-Bill Status</p>
                                 <p class="tgdp-rgt-tp-txt"><%display_no_character($einvoice_res_data[0]->EwbStatus)%></p>
                              </div>
                           
                        </div>
                       
                        <div class="row">
                           <%if empty($einvoice_res_data[0]->Status)%>
                              <%if empty($einvoice_res_data[0]->Irn)%>
                                 <div class="col-lg-2" style="    width: 11%;">
                                    <div class="form-group">
                                       <a class="btn btn-success mt-4" href="<%$base_url%>generate_E_invoice/<%$sales_id%>/EINVOICE" target="_blank">Create E-Invoice </a>
                                    </div>
                                 </div>
                              <%else%>
                                 <div class="col-lg-2" style="    width: 11%;">
                                    <div class="form-group">
                                       <a class="btn btn-success mt-4" href="<%$base_url%>get_E_invoice/<%$sales_id%>">Get E-Invoice Details</a>
                                    </div>
                                 </div>
                              <%/if%>
                           <%/if%>
                           <%if isset($einvoice_res_data[0]->Status) && $einvoice_res_data[0]->Status == "ACT"%>
                              <div class="col-lg-2" style="    width: 11%;">
                                 <div class="form-group">
                                    <a class="btn btn-success mt-4" href="<%$base_url%>view_E_invoice/<%$sales_id%>" target="_blank">View E-Invoice </a>
                                 </div>
                              </div>
                              <div class="col-lg-2" style="    width: 11%;">
                                 <div class="form-group">
                                    <button data-bs-toggle="modal" class="btn btn-success mt-4" data-bs-target="#cancelEInvoiceModel">Cancel E-Invoice</i></button>
                                 </div>
                              </div>
                              <!-- Cancel E-Invoice Model -->
                              <div class="modal fade" id="cancelEInvoiceModel" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                 <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content">
                                       <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLabel">Cancel E - Invoice</h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                          </button>
                                       </div>
                                       <div class="modal-body">
                                          <form action="<%$base_url%>cancel_E_invoice_update" method="POST" id="cancel_E_invoice_update">
                                             <div class="row">
                                                <div class="col-lg-12">
                                                   <div class="form-group">
                                                      <label for="customer_name">Reason</label><span class="text-danger">*</span>
                                                      <select name="CancelReason"  class="form-control select2" >
                                                         <option value="">Select Reason</option>
                                                         <option value="1">Duplicate</option>
                                                         <option value="2">Data Entry Mistake</option>
                                                         <option value="3">Order Cancelled</option>
                                                         <option value="4">Others</option>
                                                      </select>
                                                      <input value="<%$sales_id%>" type="hidden" name="new_sales_id" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Customer Name">
                                                   </div>
                                                </div>
                                                <div class="col-lg-12">
                                                   <div class="form-group">
                                                      <label for="customer_name">Remark</label><span class="text-danger">*</span>
                                                      <input type="text" name="CancelRemark"  class="form-control" aria-describedby="emailHelp" placeholder="Remark">
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                             </div>
                                          </form>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           <%/if%>
                        
                           <%if empty($einvoice_res_data[0]->EwbStatus) || $einvoice_res_data[0]->EwbStatus == "CANCELLED"%>
                              <div class="col-lg-2" style="    width: 11%;">
                                 <div class="form-group">
                                    <button type="button" class="btn btn-success mt-4" data-bs-toggle="modal" data-bs-target="#createEBill<%$sales_id%>" target="_blank">Create Eway Bill</button>
                                 </div>
                              </div>
                           <%/if%>
                           <%if isset($einvoice_res_data[0]->EwbStatus) && $einvoice_res_data[0]->EwbStatus == "ACTIVE"%>
                              <div class="col-lg-2" style="    width: 11%;">
                                 <div class="form-group">
                                    <a class="btn btn-success mt-4" href="<%$base_url%>view_EwayBill/<%$sales_id%>" target="_blank">View EWay-Bill</a>
                                 </div>
                              </div>
                              <div class="col-lg-2 " style="    width: 11%;">
                                 <div class="form-group">
                                    <button type="button" class="btn btn-success mt-4" data-bs-toggle="modal" data-bs-target="#updateEBill<%$sales_id%>">Update Eway Bill</button>
                                 </div>
                              </div>
                              <div class="col-lg-2" style="    width: 11%;">
                                 <div class="form-group">
                                    <button type="button" class="btn btn-success mt-4" data-bs-toggle="modal" data-bs-target="#updateTrans<%$sales_id%>">Update Transporter</button>
                                 </div>
                              </div>
                              <div class="col-lg-2" style="    width: 11%;">
                                 <div class="form-group">
                                    <button type="button" class="btn btn-success mt-4" data-bs-toggle="modal" data-bs-target="#cancelEBill<%$sales_id%>">Cancel Eway-Bill</button>
                                 </div>
                              </div>
                           <%/if%>
                           <!-- edit Modal -->
                           <div class="modal fade" id="createEBill<%$sales_id%>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered" role="document">
                                 <div class="modal-content">
                                    <div class="modal-header">
                                       <h5 class="modal-title" id="exampleModalLabel">Create Eway Bill</h5>
                                       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                       <span aria-hidden="true">&times;</span>
                                       </button>
                                    </div>
                                    <div class="modal-body">
                                       <form action="<%$base_url%>generate_EwayBill" method="POST" enctype="multipart/form-data">
                                          <input value="<%$sales_id%>" type="hidden" name="new_sales_id" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Customer Name">
                                          <div class="form-group">
                                             <label for="">Mode Of Transport<span class="text-danger">*</label>
                                             <select name="transMode" class="form-control" required>
                                                <!--<option value="">Select</option>-->
                                                <option value="1" <%if $new_sales[0]->mode == '1'%>selected<%/if%>>Road</option>
                                                <option value="2" <%if $new_sales[0]->mode == '2'%>selected<%/if%>>Rail</option>
                                                <option value="3" <%if $new_sales[0]->mode == '3'%>selected<%/if%>>Air</option>
                                                <option value="4" <%if $new_sales[0]->mode == '4'%>selected<%/if%>>Ship</option>
                                             </select>
                                          </div>
                                          <div class="form-group">
                                             <label for="">Transporter<span class="text-danger">*</label>
                                             <select name="transporterId" required id="transporter" class="form-control select2" style="width:100%;">
                                                <option value="">Select Transporter</option>
                                                <%foreach from=$transporter item=tr%>
                                                   <option value="<%$tr->id%>" <%if $new_sales[0]->transporter_id == $tr->id%>selected<%/if%>><%$tr->name%> - <%$tr->transporter_id%></option>
                                                <%/foreach%>
                                             </select>
                                          </div>
                                          <div class="form-group">
                                             <label for="">Enter Vehicle No. <span class="text-danger">*</label>
                                             <input type="text" placeholder="Enter Vehicle No" name="vehicleNo" value="<%$new_sales[0]->vehicle_number%>" 
                                                pattern="^([A-Z|a-z|0-9]{4,20})$"
                                                oninvalid="this.setCustomValidity('Please enter a valid vehicle number in the format XX00XX0000')" 
                                                onchange="this.setCustomValidity('')" required class="form-control">
                                          </div>
                                          <div class="form-group">
                                             <label for="">Distance of Transportation<span class="text-danger">*</label>
                                             <input type="text" placeholder="Enter Distance of Transportation" name="distance" value="<%$new_sales[0]->distance%>" required  class="form-control">
                                          </div>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Create Eway-Bill</button>
                                    </form>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- Update Modal -->
                        <div class="modal fade" id="updateEBill<%$sales_id%>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                           <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Update Eway Bill</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                 </div>
                                 <div class="modal-body">
                                    <form action="<%$base_url%>update_e_way_bill" method="POST" enctype="multipart/form-data" id="update_e_way_bill">
                                       <input value="<%$sales_id%>" type="hidden" name="new_sales_id" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Customer Name">
                                       <div class="form-group">
                                          <label for="on click url">e-Way Bill No</label>
                                          <input readonly type="text" name="eWayBillNo" class="form-control" value="<%$einvoice_res_data[0]->EwbNo%>" id="">
                                       </div>
                                       <div class="form-group">
                                          <label for="customer_name">Reason</label><span class="text-danger">*</span>
                                          <select name="reasonCode" required class="form-control select2">
                                             <option value="">Select Reason</option>
                                             <option value="1">Due to Break Down</option>
                                             <option value="2">Due to Transhipment</option>
                                             <option value="3">Others (Pls. Specify)</option>
                                             <option value="4">First Time</option>
                                          </select>
                                       </div>
                                       <div class="form-group">
                                          <label for="on click url">Reason Remark</label><span class="text-danger">*</span>
                                          <input type="text" id="reasonRem" required maxlength="50" name="reasonRem" placeholder="Reason Remark" 
                                             class="form-control"  value="">
                                       </div>
                                       <div class="form-group">
                                          <label for="">Mode Of Transport<span class="text-danger">*</label>
                                          <select name="transMode" class="form-control select2" required>
                                             <option value="1" <%if $new_sales[0]->mode == '1'%>selected<%/if%>>Road</option>
                                             <option value="2" <%if $new_sales[0]->mode == '2'%>selected<%/if%>>Rail</option>
                                             <option value="3" <%if $new_sales[0]->mode == '3'%>selected<%/if%>>Air</option>
                                             <option value="4" <%if $new_sales[0]->mode == '4'%>selected<%/if%>>Ship</option>
                                          </select>
                                       </div>
                                       <div class="form-group">
                                          <label for="on click url">Vehicle No<span class="text-danger">*</span></label>
                                          <input type="text" id="vehicleNo" placeholder="Enter Vehicle No" name="vehicleNo" value="<%$new_sales[0]->vehicle_number%>" 
                                             pattern="^([A-Z|a-z|0-9]{4,20})$"
                                             oninvalid="this.setCustomValidity('Please enter a valid vehicle number in the format XX00XX0000')" 
                                             onchange="this.setCustomValidity('')" required class="form-control">
                                       </div>
                                 </div>
                                 <div class="modal-footer">
                                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                 <button type="submit" class="btn btn-primary">Update</button>
                                 </form>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- DONE:  Update Transporter Modal  -->
                        <div class="modal fade" id="updateTrans<%$sales_id%>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                           <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Update Transporter ID</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                 </div>
                                 <div class="modal-body">
                                    <form action="<%$base_url%>update_EWayBill_transporter" method="POST" enctype="multipart/form-data" id="update_EWayBill_transporter">
                                       <input type="hidden" name="new_sales_id" value="<%$new_sales[0]->id%>"  class="form-control">
                                       <div class="form-group">
                                          <label for="on click url">e-Way Bill No </label> <br>
                                          <input readonly type="text" name="eWayBillNo" class="form-control" value="<%$einvoice_res_data[0]->EwbNo%>" id="">
                                       </div>
                                       <div class="form-group">
                                          <label for="">Transporter<span class="text-danger">*</label>
                                          <select name="transporterId"  id="transporterId" class="form-control select2">
                                             <option value="">Select Transporter</option>
                                             <%foreach from=$transporter item=tr%>
                                                <option value="<%$tr->id%>" <%if $new_sales[0]->transporter_id == $tr->id%>selected<%/if%>><%$tr->name%> - <%$tr->transporter_id%></option>
                                             <%/foreach%>
                                          </select>
                                       </div>
                                 </div>
                                 <div class="modal-footer">
                                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                 <button type="submit" class="btn btn-primary">Save changes</button>
                                 </form>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- cancel eway bill -->
                        <div class="modal fade" id="cancelEBill<%$sales_id%>" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                       
                        <div class="modal-dialog modal-lg" role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title" id="exampleModalLabel">Cancel EWay-Bill</h5>
                                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                                 </button>
                              </div>
                              <div class="modal-body">
                                 <form action="<%$base_url%>cancel_eWayBill" method="POST" id="cancel_eWayBill">
                                    <input type="hidden" name="new_sales_id" value="<%$sales_id%>"  class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Customer Name">
                                    <input type="hidden" name="eWayBillNo" value="<%$einvoice_res_data[0]->EwbNo%>" class="form-control" id="ewayBillNo1">
                                    <div class="form-group">
                                       <label for="customer_name">Reason</label><span class="text-danger">*</span>
                                       <select name="cancelReason"  class="form-control select2">
                                          <option value="">Select Reason</option>
                                          <option value="1">Duplicate</option>
                                          <option value="2">Data Entry Mistake</option>
                                          <option value="3">Order Cancelled</option>
                                          <option value="4">Others</option>
                                       </select>
                                    </div>
                                    <div class="form-group">
                                       <label for="customer_name">Remark</label><span class="text-danger">*</span>
                                       <input type="text" name="cancelRemark"  class="form-control" aria-describedby="emailHelp" placeholder="Remark">
                                    </div>
                                    <div class="modal-footer">
                                       <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                       <button type="submit" class="btn btn-primary">Cancel E-Way Bill</button>
                                    </div>
                                 </form>
                              </div>
                           </div>
                        </div>
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
   <!-- /.row -->
</div>
<!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script>
   $(document).ready(function() {
   
       var id = $("#customer_tracking").val();
       $('#new_po_id').val(id);
       var salesno = $('#sales_number').val();
       $.ajax({
           url: '<?php echo site_url("Newcontroller/get_po_sales_parts"); ?>',
           type: "POST",
           data: {
               id: id,
               salesno: salesno
           },
           cache: false,
           beforeSend: function() {},
           success: function(response) {
               if (response) {
                   $('#part_id').html(response);
               } else {
   
                   $('#part_id').html(response);
               }
   
           }
       });
       $("#customer_tracking").change(function() {
   
           var id = $("#customer_tracking").val();
           var salesno = $('#sales_number').val();
           $.ajax({
               url: '<?php echo site_url("Newcontroller/get_po_sales_parts"); ?>',
               type: "POST",
               data: {
                   id: id,
                   salesno: salesno
               },
               cache: false,
               beforeSend: function() {},
               success: function(response) {
                   if (response) {
                       $('#part_id').html(response);
                   } else {
   
                       $('#part_id').html(response);
                   }
   
               }
           });
   
       })
       $("#cancel_E_invoice_update").validate({
           rules: {
             CancelReason: {
               required: true,
             },
             CancelRemark: {
               required: true
             }
           },
           messages: {
             CancelReason: {
               required: "Please enter reason",
             },
             CancelRemark: {
               required: "Please enter remark"
             }
           },
           errorPlacement: function (error, element) {
            
            if (element[0].localName == "select") {
                element.parents(".form-group").append(error)
                // error.insertAfter($(element).parents('div').prev($('.question')));
            } else {
                error.insertAfter(element);
                // something else if it's not a checkbox
            }
        },
           submitHandler: function (form) {
             $.ajax({
                url: $(form).attr('action'), // Get the form action URL
                type: 'POST',                // Set the request type
                data: $(form).serialize(),   // Serialize the form data
                success: function (response) {
                  var data = JSON.parse(response);
                  if (data.success == 1) {
                     toastr.success(data.messages);
                      setTimeout(function () {
                        window.location.reload();
                    }, 2000);
                  }else{
                    toastr.error(data.messages);
                  }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    // Handle error response
                    toastr.error('Error adding planning FG Stock data: ' + textStatus);
                }
            });
           }
      });
       $("#update_EWayBill_transporter").validate({
           rules: {
             eWayBillNo: {
               required: true,
             },
             transporterId: {
               required: true
             }
           },
           messages: {
             eWayBillNo: {
               required: "Please enter e-Way bill no",
             },
             transporterId: {
               required: "Please select transporter"
             }
           },
           errorPlacement: function (error, element) {
            
            if (element[0].localName == "select") {
                element.parents(".form-group").append(error)
                // error.insertAfter($(element).parents('div').prev($('.question')));
            } else {
                error.insertAfter(element);
                // something else if it's not a checkbox
            }
        },
           submitHandler: function (form) {
             $.ajax({
                url: $(form).attr('action'), // Get the form action URL
                type: 'POST',                // Set the request type
                data: $(form).serialize(),   // Serialize the form data
                success: function (response) {
                  var data = JSON.parse(response);
                  if (data.success == 1) {
                     toastr.success(data.messages);
                      setTimeout(function () {
                        window.location.reload();
                    }, 2000);
                  }else{
                    toastr.error(data.messages);
                  }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    // Handle error response
                    toastr.error('Error adding planning FG Stock data: ' + textStatus);
                }
            });
           }
      });
       $("#update_e_way_bill").validate({
           rules: {
             reasonCode: {
               required: true,
             },
             reasonRem: {
               required: true
             },
             transMode: {
               required: true
             },
             vehicleNo: {
               required: true
             }
           },
           messages: {
             reasonCode: {
               required: "Please enter reason",
             },
             reasonRem: {
               required: "Please enter reason remark"
             },
             transMode: {
               required: "Please select mode Of transport"
             },
             vehicleNo: {
               required: "Please enter vehicle no"
             }
           },
           errorPlacement: function (error, element) {
            
            if (element[0].localName == "select") {
                element.parents(".form-group").append(error)
                // error.insertAfter($(element).parents('div').prev($('.question')));
            } else {
                error.insertAfter(element);
                // something else if it's not a checkbox
            }
        },
           submitHandler: function (form) {
             $.ajax({
                url: $(form).attr('action'), // Get the form action URL
                type: 'POST',                // Set the request type
                data: $(form).serialize(),   // Serialize the form data
                success: function (response) {
                  var data = JSON.parse(response);
                  if (data.success == 1) {
                     toastr.success(data.messages);
                      setTimeout(function () {
                        window.location.reload();
                    }, 2000);
                  }else{
                    toastr.error(data.messages);
                  }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    // Handle error response
                    toastr.error('Error adding planning FG Stock data: ' + textStatus);
                }
            });
           }
      });
       $("#cancel_eWayBill").validate({
           rules: {
             cancelReason: {
               required: true,
             },
             cancelRemark: {
               required: true
             }
           },
           messages: {
             cancelReason: {
               required: "Please enter reason",
             },
             cancelRemark: {
               required: "Please enter remark"
             }
           },
           errorPlacement: function (error, element) {
            
            if (element[0].localName == "select") {
                element.parents(".form-group").append(error)
                // error.insertAfter($(element).parents('div').prev($('.question')));
            } else {
                error.insertAfter(element);
                // something else if it's not a checkbox
            }
        },
           submitHandler: function (form) {
             $.ajax({
                url: $(form).attr('action'), // Get the form action URL
                type: 'POST',                // Set the request type
                data: $(form).serialize(),   // Serialize the form data
                success: function (response) {
                  var data = JSON.parse(response);
                  if (data.success == 1) {
                     toastr.success(data.messages);
                      setTimeout(function () {
                        window.location.reload();
                    }, 2000);
                  }else{
                    toastr.error(data.messages);
                  }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    // Handle error response
                    toastr.error('Error adding planning FG Stock data: ' + textStatus);
                }
            });
           }
      });
   });
</script>
