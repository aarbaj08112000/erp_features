<div  class="wrapper container-xxl flex-grow-1 container-p-y">

<nav aria-label="breadcrumb">
<div class="sub-header-left pull-left breadcrumb">
  <h1>
    Planning & Sales
    <a hijacked="yes"  class="backlisting-link" title="Back to Issue Request Listing" >
      <i class="ti ti-chevrons-right" ></i>
      <em >Customer Po Tracking</em></a>
  </h1>
  <br>
  <span >Customer Po Tracking</span>
</div>
</nav>
<div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5 listing-btn">
            <a title="Back To View Pending List" class="btn btn-seconday" href="<%$base_url%>customer_po_tracking_all" type="button"><i class="ti ti-arrow-left"></i></a>
             
        </div>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
      
        <section class="content">
            <div class="">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="tgdp-rgt-tp-sect">
                                        <p class="tgdp-rgt-tp-ttl">Customer Name</p>
                                        <p class="tgdp-rgt-tp-txt">
                                            <%$customer[0]->customer_name%>
                                        </p>
                                    </div>
                                    <div class="tgdp-rgt-tp-sect">
                                        <p class="tgdp-rgt-tp-ttl">PO Number</p>
                                        <p class="tgdp-rgt-tp-txt">
                                            <%$customer_po_tracking[0]->po_number%>
                                        </p>
                                    </div>
                                    <div class="tgdp-rgt-tp-sect">
                                        <p class="tgdp-rgt-tp-ttl">PO Number</p>
                                        <p class="tgdp-rgt-tp-txt">
                                            <%display_no_character($customer_po_tracking[0]->po_number)%>
                                        </p>
                                    </div>
                                    <div class="tgdp-rgt-tp-sect">
                                        <p class="tgdp-rgt-tp-ttl">PO Start Date</p>
                                        <p class="tgdp-rgt-tp-txt">
                                            <%display_no_character($customer_po_tracking[0]->po_start_date)%>
                                        </p>
                                    </div>
                                    <div class="tgdp-rgt-tp-sect">
                                        <p class="tgdp-rgt-tp-ttl">PO End Date</p>
                                        <p class="tgdp-rgt-tp-txt">
                                            <%display_no_character($customer_po_tracking[0]->po_end_date)%>
                                        </p>
                                    </div>
                                    <div class="tgdp-rgt-tp-sect">
                                        <p class="tgdp-rgt-tp-ttl">PO Amendment No</p>
                                        <p class="tgdp-rgt-tp-txt">
                                            <%display_no_character($customer_po_tracking[0]->po_amedment_number)%>
                                        </p>
                                    </div>
                                    <div class="tgdp-rgt-tp-sect">
                                        <p class="tgdp-rgt-tp-ttl">Status</p>
                                        <p class="tgdp-rgt-tp-txt">
                                            <%display_no_character($customer_po_tracking[0]->status)%>
                                        </p>
                                    </div>
                                    <div class="tgdp-rgt-tp-sect">
                                        <p class="tgdp-rgt-tp-ttl">Created Date</p>
                                        <p class="tgdp-rgt-tp-txt">
                                            <%display_no_character($customer_po_tracking[0]->created_date)%>
                                        </p>
                                    </div>
                                    
                                    
                                    <%if $customer_po_tracking[0]->status == 'closed'%>
                                        <div class="tgdp-rgt-tp-sect">
                                            <p class="tgdp-rgt-tp-ttl">Remark</p>
                                            <p class="tgdp-rgt-tp-txt">
                                                <%display_no_character($customer_po_tracking[0]->remark)%>
                                            </p>
                                        </div>
                                        <div class="tgdp-rgt-tp-sect">
                                            <p class="tgdp-rgt-tp-ttl">Reason</p>
                                            <p class="tgdp-rgt-tp-txt">
                                                <%display_no_character($customer_po_tracking[0]->reason)%>
                                            </p>
                                        </div>
                                    
                                    <%/if%>
                                    
                                    <!--<div class="col-lg-2">
                                            <div class="form-group">
                                                <label for="">Expiry Date <span class="text-danger">*</span> </label>
                                                    <input type="text" readonly value="<%$new_po[0]->expiry_po_date%>" class="form-control">
                                            </div>
                                        </div> -->
                                </div>
                            </div>
                        </div>
                        <div class="card p-0 mt-4">
                            <div class="card-header">
                                <%if true || $new_po[0]->expiry_po_date <= date('Y-m-d') || true%>
                                <form action="<%$base_url%>add_parts_customer_trackings" method="post" id='myForm'>
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <div class="form-group">
                                                    <label for="" class="form-label">Select Part Number // Description <span class="text-danger">*</span> </label>
                                                    <select name="part_id" id="" required class="form-control select2">
                                                        <%if $customer_part_data%>
                                                            <%foreach from=$customer_part_data item=c%>
                                                                <option value="<%$c->id%>">
                                                                    <%$c->part_number%> // <%$c->part_description%>
                                                                </option>
                                                            <%/foreach%>
                                                        <%/if%>
                                                    </select>
                                            </div>
                                        </div>
                                        <%if $exportSalesInvoive eq 'Yes' && $customer[0]->customerType eq 'Expoter'%>
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <label for="" class="form-label">Item No <span class="text-danger">*</span> </label>
                                                <input type="text" step="any" name="item_no" placeholder="Enter Item No "  class="form-control onlyNumericInput">
                                            </div>
                                        </div>
                                        <%/if%>
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <label for="" class="form-label">Enter Qty <span class="text-danger">*</span> </label>
                                                <input type="text" step="any" name="qty" placeholder="Enter QTY "  class="form-control onlyNumericInput">
                                                <input type="hidden" name="customer_po_tracking_id" value="<%$customer_po_tracking[0]->id%>" required class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="" class="form-label"> &nbsp; &nbsp; </label><br>
                                                <button type="submit" class="btn btn-info  ">Add Part to Tracking
                                                </button>
                                               
                                            </div>
                                        </div>
                                        </div>
                                        </form>
                                <%else%>
                                    Po  Expired!!
                                <%/if%>
                            </div>

                            <div class="card-header pt-0">
                                <%if $parts_customer_trackings && false%>
                                    <%if $new_po[0]->status == "pending"%>

                                        <%if $smarty.session.type == 'admin' || $smarty.session.type == 'Admin'%>
                                            <button type="button" class="btn btn-danger ml-1" data-bs-toggle="modal" data-bs-target="#lock">
                                                Lock PO
                                            </button>
                                        <%/if%>
                                    <%/if%>
                                <%/if%>
                                <%if $new_po[0]->status == "lock"%>
                                    <%if $smarty.session.type == 'admin' || $smarty.session.type == 'Admin'%>
                                        <button type="button" class="btn btn-success ml-1" data-bs-toggle="modal" data-bs-target="#accpet">
                                            Accept (Released) PO
                                        </button>
                                        <button type="button" class="btn btn-danger ml-1" data-bs-toggle="modal" data-bs-target="#delete">
                                            Reject (delete) PO
                                        </button>
                                    <%/if%>
                                <%else%>
                                    <%if $new_po[0]->status != "pending"%>
                                        <button type="button" disabled class="btn btn-success ml-1" data-bs-toggle="modal" data-bs-target="#accpet">
                                            PO Already Released
                                        </button>
                                        <a href="<%$base_url%>download_my_pdf/<%$new_po[0]->id%>" class="btn btn-primary" href="">Download</a>
                                    <%/if%>
                                <%/if%>
                                <!-- Modal -->
                                <div class="modal fade" id="accpet" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Update</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="<%$base_url%>accept_customer_po_tracking" class="accept_po" method="POST">
                                                <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label for=""><b>Are You Sure Want To Released This PO?</b> </label>
                                                                <input type="hidden" name="id" value="<%$new_po[0]->id%>" required class="form-control">
                                                                <input type="hidden" name="status" value="accpet" required class="form-control">
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
                                                    <form action="<%$base_url%>accept_customer_po_tracking" class="accept_po" method="POST">
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label for=""><b>Are You Sure Want To Lock This PO?</b></label>
                                                                <input type="hidden" name="id" value="<%$new_po[0]->id%>" required class="form-control">
                                                                <input type="hidden" name="status" value="lock" required class="form-control">
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
                                <div class="modal fade" id="delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="<%$base_url%>delete_po" class="delete_po" method="POST">
                                            <div class="modal-body">
                                                <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label for=""><b>Are You Sure Want To Delete This PO?</b> </label>
                                                                <input type="hidden" name="id" value="<%$new_po[0]->id%>" required class="form-control">
                                                                <input type="hidden" name="status" value="reject" required class="form-control">
                                                                <input type="hidden" name="table_name" value="new_po" required class="form-control">
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
                        <div class="card p-0 mt-4">
                            <div class="">
                                <table class="table table-striped scrollable" >
                                    <thead>
                                        <tr>
                                            <th>Sr No</th>
                                            <th>Part Number</th>
                                            <th>Part Description</th>
                                            <%if $exportSalesInvoive eq 'Yes' && $customer[0]->customerType eq 'Expoter'%>
                                            <th>Item No</th>
                                            <th>DRG No</th>
                                            <th>Rev No</th>
                                            <th>MOC</th>
                                            <%/if%>
                                            <th>Part Price</th>
                                            <th>QTY</th>
                                            <th>Cumulative Sales Qty</th>
                                            <th>Balance QTY</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <%if $parts_customer_trackings%>
                                            <%assign var="final_po_amount" value=0%>
                                            <%assign var="i" value=1%>
                                            <%foreach from=$parts_customer_trackings item=p%>

                                                <%assign var="editable_export_part_params" value='No'%>
                                                <%assign var="start_date" value=$new_po[0]->po_start_date|date_format:"%d-%m-%Y"%>
                                                <%assign var="end_date" value=$new_po[0]->po_end_date|date_format:"%d-%m-%Y"%>

                                                <%if $sales_qty_data%>
                                                    <%if $sales_qty_data[$p->part_id][0]->MAINSUM gt 0%>
                                                        <%assign var='sales_qty' value="<%$sales_qty_data[$p->part_id][0]->MAINSUM%>"%>
                                                        <%assign var="editable_export_part_params" value='Yes'%>
                                                        <%else%>
                                                        <%assign var='sales_qty' value="0"%>
                                                    <%/if%>
                                                    <%assign var="balance_qty" value=$p->qty - $sales_qty%>
                                                <%/if%>
                                                 <%if $exportSalesInvoive eq 'Yes'%>
                                                    <%if $export_sales_qty_data[$p->part_id][0]->MAINSUM gt 0%>
                                                        <%assign var='export_sales_qty' value="<%$export_sales_qty_data[$p->part_id][0]->MAINSUM%>"%>
                                                        <%assign var="editable_export_part_params" value='Yes'%>
                                                    <%else%>
                                                        <%assign var='export_sales_qty' value="0"%>
                                                    <%/if%>
                                                    <%assign var="balance_qty" value=$balance_qty - $export_sales_qty%>
                                                 <%/if%>
                                                
                                                <tr>
                                                    
                                                    <td><%$i%></td>
                                                    <td><%$child_part_data[$p->part_id][0]->part_number%></td>
                                                    <td><%$child_part_data[$p->part_id][0]->part_description%></td>
                                                    <%if $exportSalesInvoive eq 'Yes' && $customer[0]->customerType eq 'Expoter'%>
                                                    <td><%display_no_character($p->item_no)%></td>
                                                    <td><%display_no_character($p->drg_no)%></td>
                                                    <td><%display_no_character($p->rev_no)%></td>
                                                    <td><%display_no_character($p->moc)%></td>
                                                    <%/if%>
                                                    <td><%$child_part_rate[$child_part_data[$p->part_id][0]->id][0]->rate%></td>
                                                    <td><%$p->qty%></td>
                                                    <td><%$sales_qty%></td>
                                                    <td><%$balance_qty%></td>
                                                    <td>
                                                        <%if $new_po[0]->status == "pending"%>
                                                            <!-- Button trigger modal -->
                                                            <a type="button" class="" data-bs-toggle="modal" data-bs-target="#exampleModal<%$i%>">
                                                                <i class="ti ti-edit"></i>
                                                            </a>
                                                            <a type="button" class=" ml-1" data-bs-toggle="modal" data-bs-target="#exampleModaldelete<%$i%>">
                                                                <i class="ti ti-trash"></i>
                                                            </a>

                                                            <!-- Modal -->
                                                            <div class="modal fade" id="exampleModal<%$i%>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog <%if $exportSalesInvoive eq 'Yes' && $editable_export_part_params eq 'No'%>modal-lg<%/if%> modal-dialog-centered">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">Update</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <form action="<%$base_url%>update_parts_customer_trackings" method="POST" class="update_qty custom-form update_parts_customer_trackings<%$i%>" id="update_parts_customer_trackings<%$i%>">
                                                                            <input type="hidden" name="customerType" value="<%$customer[0]->customerType%>">
                                                                        <div class="modal-body row">
                                                                            <div class="<%if $exportSalesInvoive eq 'Yes' && $editable_export_part_params eq 'No' %>col-lg-6<%else%>col-lg-12<%/if%>">
                                                                                <div class="form-group">
                                                                                        <label for="">Enter Qty <span class="text-danger">*</span></label>
                                                                                        <input type="text" name="qty" value="<%$p->qty%>" placeholder="Enter QTY "  class="form-control onlyNumericInput required-input">
                                                                                        <input type="hidden" name="id" value="<%$p->id%>" required class="form-control">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-6">
                                                                            </div>
                                                                            <%if $exportSalesInvoive eq 'Yes' && $editable_export_part_params eq 'No' && $customer[0]->customerType eq 'Expoter'%>
                                                                            <div class="col-lg-6">
                                                                                            <div class="form-group">
                                                                                                    <label for="itemCode">Item No</label>
                                                                                                    <input type="text" name="item_no" class="form-control required-input"  aria-describedby="itemCodeHelp" value="<%$p->item_no%>">
                                                                                            </div>
                                                                                    </div>
                                                                            <div class="col-lg-6">
                                                                                            <div class="form-group">
                                                                                                    <label for="itemCode">DRG No</label>
                                                                                                    <input type="text" name="drg_no" class="form-control"  aria-describedby="itemCodeHelp" value="<%$p->drg_no%>">
                                                                                            </div>
                                                                                    </div>
                                                                                    <div class="col-lg-6">
                                                                                            <div class="form-group">
                                                                                                    <label for="itemCode">Rev No</label>
                                                                                                    <input type="text" name="rev_no" class="form-control"  aria-describedby="itemCodeHelp" value="<%$p->rev_no%>">
                                                                                            </div>
                                                                                    </div>
                                                                                    <div class="col-lg-6">
                                                                                            <div class="form-group">
                                                                                                    <label for="itemCode">MOC</label>
                                                                                                    <input type="text" name="moc" class="form-control"  aria-describedby="itemCodeHelp" value="<%$p->moc%>">
                                                                                            </div>
                                                                                    </div>
                                                                            <%/if%>

                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                            <button type="submit" class="btn btn-primary">Update</button>
                                                                        </div>
                                                                    </div>
                                                                    </div>
                                                                    </form>
                                                            </div>
                                                            <div class="modal fade" id="exampleModaldelete<%$i%>" tabindex="-1" aria-labelledby="" aria-hidden="true">
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
                                                                                <form action="<%$base_url%>delete" method="POST" class="delete_form">
                                                                                    <div class="col-lg-12">
                                                                                        <div class="form-group">
                                                                                            <label for=""> <b>Are You Sure Want To Delete This ? </b> </label>
                                                                                            <input type="hidden" name="id" value="<%$p->id%>" required class="form-control">
                                                                                            <input type="hidden" name="table_name" value="parts_customer_trackings" required class="form-control">
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
                                                        <%/if%>
                                                    </td>
                                                </tr>
                                                <%assign var="i" value=$i+1%>
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
   
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>

$("#myForm").validate({
    rules: {
        part_id: "required",
        qty: {
            required: true,
            number: true
        },
        item_no: {
            required: true
        }
    },
    messages: {
        part_id: "Please select a part number",
        qty: {
            required: "Please enter a quantity",
            number: "Please enter a valid number"
        },
        item_no: {
            required: "Please enter a item no",
        }
    },
    submitHandler: function(form) {
        // Handle form submission
        $.ajax({
            url: form.action,
            type: form.method,
            data: $(form).serialize(),
            success: function(response) {
                // alert('Form submitted successfully!');
                if(response != '' && response != null && typeof response != 'undefined'){
                    let res = JSON.parse(response);
                    if(res['sucess'] == 1){
                        toastr.success(res['msg']);
                        setTimeout(() => {
                            window.location.reload();
                        }, 1000);
                    }else{
                        toastr.error(res['msg']);
                    }
                }
                // Handle success response here
            },
            error: function(xhr, status, error) {
                toastr.error('Form submission failed');
                // Handle error response here
            }
        });
    }

    
});
$(".update_qty").submit(function(e){
        e.preventDefault();
       
        var href = $(this).attr("action");
        var id = $(this).attr("id");
        let flag = formValidate(id);

        if(flag){
          return;
        }
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
                window.location.reload();
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

function formValidate(form_class = ''){
        let flag = false;
        $(".custom-form."+form_class+" .required-input").each(function( index ) {
          var value = $(this).val();
          var dataMax = parseFloat($(this).attr('data-max'));
          var dataMin = parseFloat($(this).attr('data-min'));
          if(value == ''){
            flag = true;
            var label = $(this).parents(".form-group").find("label").contents().filter(function() {
              return this.nodeType === 3; // Filter out non-text nodes (nodeType 3 is Text node)
            }).text().trim();
            var exit_ele = $(this).parents(".form-group").find("label.error");
            if(exit_ele.length == 0){
              var start ="Please enter ";
              if($(this).prop("localName") == "select"){
                var start ="Please select ";
              }
              label = ((label.toLowerCase()).replace("enter", "")).replace("select", "");
              var validation_message = start+(label.toLowerCase()).replace(/[^\w\s*]/gi, '');
              var label_html = "<label class='error'>"+validation_message+"</label>";
              $(this).parents(".form-group").append(label_html)
            }
          }
          else if(dataMin !== undefined && dataMin > value){
            flag = true;
            var label = $(this).parents(".form-group").find("label").contents().filter(function() {
              return this.nodeType === 3; // Filter out non-text nodes (nodeType 3 is Text node)
            }).text().trim();
            var exit_ele = $(this).parents(".form-group").find("label.error");
            if(exit_ele.length == 0){
              var end =" must be greater than or equal to "+dataMin;
              label = ((label.toLowerCase()).replace("enter", "")).replace("select", "");
              label = (label.toLowerCase()).replace(/[^\w\s*]/gi, '');
              label = label.charAt(0).toUpperCase() + label.slice(1);
              var validation_message =label +end;
              var label_html = "<label class='error'>"+validation_message+"</label>";
              $(this).parents(".form-group").append(label_html)
            }
            }else if(dataMax !== undefined && dataMax < value){
              flag = true;
              var label = $(this).parents(".form-group").find("label").contents().filter(function() {
                return this.nodeType === 3; // Filter out non-text nodes (nodeType 3 is Text node)
              }).text().trim();
              var exit_ele = $(this).parents(".form-group").find("label.error");
              if(exit_ele.length == 0){
                var end =" must be less than or equal to "+dataMax;
                label = ((label.toLowerCase()).replace("enter", "")).replace("select", "");
                label = (label.toLowerCase()).replace(/[^\w\s*]/gi, '');
                label = label.charAt(0).toUpperCase() + label.slice(1)
                var validation_message =label +end;
                var label_html = "<label class='error'>"+validation_message+"</label>";
                $(this).parents(".form-group").append(label_html)
              }
          }
        });
       
        return flag;
    }


    $(".delete_form").on("submit", function(event) {
        event.preventDefault(); // Prevent the default form submission
        // Perform AJAX request
        $.ajax({
            url: $(this).attr("action"),
            type: $(this).attr("method"),
            data: $(this).serialize(),
            success: function(response) {
                // Handle the success response here
                
                
                let res = JSON.parse(response);
                        if(res['success'] == 1){
                            toastr.success(res['message']);
                            setTimeout(() => {
                                window.location.reload();
                            }, 1000);
                        }else{
                            toastr.error(res['message']);
                        }
                
                
            },
            error: function(xhr, status, error) {
                // Handle the error response here
                console.error('Form submission failed:', error);
            }
        });
    });
    $(".delete_po").on("submit", function(event) {
        event.preventDefault(); // Prevent the default form submission
        // Perform AJAX request
        $.ajax({
            url: $(this).attr("action"),
            type: $(this).attr("method"),
            data: $(this).serialize(),
            success: function(response) {
                // Handle the success response here
                let res = JSON.parse(response);
                        if(res['success'] == 1){
                            toastr.success(res['messages']);
                            setTimeout(() => {
                                window.location.reload();
                            }, 1000);
                        }else{
                            toastr.error(res['message']);
                        }
                
                
            },
            error: function(xhr, status, error) {
                // Handle the error response here
                console.error('Form submission failed:', error);
            }
        });
    });

    $(".accept_po").on("submit", function(event) {
        event.preventDefault(); // Prevent the default form submission

        // Perform AJAX request
        $.ajax({
            url: $(this).attr("action"),
            type: $(this).attr("method"),
            data: $(this).serialize(),
            success: function(response) {
                let res = JSON.parse(response);
                        if(res['success'] == 1){
                            toastr.success(res['message']);
                            setTimeout(() => {
                                window.location.reload();
                            }, 1000);
                        }else{
                            toastr.error(res['message']);
                        }
                
            },
            error: function(xhr, status, error) {
                // Handle the error response here
                console.error('Form submission failed:', error);
            }
        });
    });
</script>