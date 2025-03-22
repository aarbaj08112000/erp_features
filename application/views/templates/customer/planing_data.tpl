<style>
.select2-container--default{
    width: 100%!important;
}
</style>
<div class="wrapper container-xxl flex-grow-1 container-p-y">

<nav aria-label="breadcrumb">
      <div class="sub-header-left pull-left breadcrumb">
        <h1>
          Planning & Sales
          <a hijacked="yes"  class="backlisting-link" title="Back to Issue Request Listing" >
            <i class="ti ti-chevrons-right" ></i>
            <em >Planning data</em></a>
        </h1>
        <br>
        <span >Planning data</span>
      </div>
    </nav>
    <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5 listing-btn">
            <a type="button" class="btn btn-seconday" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    Add Planing</a>
            <a type="button" class="btn btn-seconday" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal1212">
                                    Add FG Stock</a>
            <a href="<%$base_url%>view_all_child_parts_schedule/<%$financial_year%>/<%$month%>"
                                    class="btn btn-seconday">
                                    Monthly MRP Req</a>
            <a type="button" class="btn  btn-seconday" data-bs-toggle="modal"
                                    data-bs-target="#exportCustomerPartsOnly">
                                    Export Format</a>
            <a type="button" class="btn btn-seconday" data-bs-toggle="modal"
                                    data-bs-target="#importCustomerPartsOnly">
                                    Import Data</a>
        </div>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        

        <!-- Main content -->
        <section class="content">
            <div class="">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header1">
                                <!-- <div class="col-6"> -->
                                
                                <!-- Button trigger modal -->
                                
                                <!-- Button trigger modal -->
                                
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal1212" role="dialog"
                                    aria-labelledby="exampleModal1212Label" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role=" document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModal1212Label">Add FG Stock</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="<%$base_url%>add_planning_fg_stock" method="POST" id="planningFgStockForm">
                                            <div class="modal-body">
                                                    <div class="row">
                                                    <div class="col-lg-12">
                                                            <div class="form-group">
                                                            <label for="">Customer <span class="text-danger">*</span></label>
                                                            <select name="customer_id" id="customer_tracking1" required id="" class="form-control select2">
                                                                <option value=''>Select</option>
                                                                <%if $customer%>
                                                                    <%foreach from=$customer item=s%>
                                                                   <option value="<%$s->id%>"><%$s->customer_name%></option>
                                                                    <%/foreach%>
                                                                <%/if%>
                                                            </select> 
                                                            </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="form-group">
                                                                <label for="">Select Customer Part Number / Description
                                                                <span class="text-danger">*</span> </label>
                                                                <select name="customer_part_id1" id="customer_part_id1" required class="form-control select2">
                                                                    <option value=''>Please select</option>
                                                                </select>
                                                            </div>

                                                        <div class="col-lg-12">
                                                                <div class="form-group">
                                                                    <label for="contractorName">Select Month
                                                                    </label><span class="text-danger">*</span>
                                                                    <select name="month_id" id=""
                                                                        class="form-control select2">
                                                                        <option value="<%$month%>">
                                                                            <%$month%></option>
                                                                    </select>
                                                                </div>

                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="form-group">
                                                                    <label for="contractorName">Production
                                                                        Quantity</label><span
                                                                        class="text-danger">*</span>
                                                                    <input type="text"  name="fg_stock"
                                                                        class="form-control onlyNumericInput">
                                                                    <input type="hidden" required name="financial_year"
                                                                        value="<%$financial_year%>"
                                                                        class="form-control">
                                                                </div>

                                                            </div>


                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save
                                                                changes</button>
                                                        </div>
                                                    </div>
                                                    </form> 
                                                    </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- Modal End-->

                                
                                <!-- </div>
                                <div class="col-6" style="align:right;"> -->
                                

                                <!-- Export Modal -->
                                <div class="modal fade" id="exportCustomerPartsOnly" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Export Customer Data for Planning Data</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                             <form action="<%$base_url%>planning_export_customer_part"
                                                    method="POST" id="planning_export_customer_part" class="custom-form">
                                            <div class="modal-body">
                                               
                                                    <div class="row">
                                                        <div class="col-lg-10 form-group">
                                                            <label for="contractorName">Customer</label><span
                                                                class="text-danger">*</span>
                                                            <select name="customer_id" id=""
                                                                class="form-control select2 required-input" >
                                                                <option value="">Select</option>
                                                                <%if $customer%>
                                                                    <%foreach from=$customer item=c%>
                                                                <option value="<%$c->id%>">
                                                                    <%$c->customer_name%></option>
                                                                <%/foreach%>
                                                                <%/if%>
                                                            </select>
                                                        </div>
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <input type="hidden" value="<%$financial_year%>"
                                                    class="hidden" name="financial_year">
                                                <input type="hidden" value="<%$month%>"
                                                    class="hidden" name="month">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary">Export</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                
                                
                                 <!-- Import Modal -->
                                 <div class="modal fade" id="importCustomerPartsOnly" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Import Planning Data</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="<%$base_url%>import_customer_planning" 
                                                method="POST" enctype='multipart/form-data' id="import_customer_planning" class="custom-form">
                                                    <div class="row">
                                                        <div class="col-lg-10">
                                                            <div class="form-group">
                                                            <label>Customer</label><span
                                                                class="text-danger">*</span>
                                                            <select name="customer_id" id=""
                                                                class="form-control select2 required-input" >
                                                                <option value="">Select</option>
                                                                <%if $customer%>
                                                                    <%foreach from=$customer item=c%>
                                                                <option value="<%$c->id%>">
                                                                    <%$c->customer_name%></option>
                                                                <%/foreach%>
                                                                <%/if%>
                                                            </select>
                                                        </div>
                                                            <div class="form-group">
                                                                <label for="po_num">Upload Plan</label><span
                                                                class="text-danger">*</span>
                                                                <input type="file" name="uploadedDoc"  class="required-input form-control" id="exampleuploadedDoc" placeholder="Upload Plan" aria-describedby="uploadDocHelp">
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <input type="hidden" value="<%$segment_2%>"
                                                    class="hidden">
                                                <input type="hidden" value="<%$segment_3%>"
                                                    class="hidden">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary">Import</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                   
                                <!-- Add Planning Modal -->
                                <div class="modal fade" id="exampleModal" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role=" document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add Planing</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="<%$base_url%>add_planning_data" method="POST" id="planningForm">
                                            <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                            <label for="">Customer <span class="text-danger">*</span></label>
                                                            <select name="customer_id" id="customer_tracking" required id="" class="form-control select2">
                                                                <option value=''>Select</option>
                                                                <%if $customer%>
                                                                    <%foreach from=$customer item=s%>
                                                                   <option value="<%$s->id%>"><%$s->customer_name%></option>
                                                                    <%/foreach%>
                                                                <%/if%>
                                                            </select> 
                                                            </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="form-group">
                                                                <label for="">Select Customer Part Number / Description
                                                                <span class="text-danger">*</span> </label>
                                                                <select name="customer_part_id" id="customer_part_id" required class="form-control select2">
                                                                    <option value=''>Please select</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="form-group">
                                                                    <label for="contractorName">Select Month
                                                                    </label><span class="text-danger">*</span>
                                                                    <select name="month_id" id=""
                                                                        class="form-control select2">
                                                                        <option value="<%$month%>">
                                                                            <%$month%></option>

                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">

                                                                <div class="form-group">
                                                                    <label for="contractorName">Enter Schedule Qty
                                                                    </label><span class="text-danger">*</span>
                                                                    <input type="text"  name="schedule_qty"
                                                                        class="form-control onlyNumericInput">
                                                                    <input type="hidden" required name="financial_year"
                                                                        value="<%$financial_year%>"
                                                                        class="form-control">
                                                                </div>

                                                            </div>


                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save
                                                                changes</button>
                                                        </div>
                                                        </div>
                                                        </form>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>


                        <div class="card-header">
                            
                            <!-- Button trigger modal -->
                            <div class="row">
                                <div class="col-lg-2">
                                    <form
                                        action="<%$base_url%>planing_data/<%$financial_year%>/<%$month%>/0"
                                        method="post">
                                        <div class="form-group">
                                            <label for="">Select Customer</label>
                                            <select name="customer_id" id="customer_id" class="form-control select2" required>
                                                 <option value="">Select</option>
                                                <%if $customer%>
                                                    <%foreach from=$customer item=c%>
                                                <option <%if $c->id == $customer_id%> selected <%/if%> value="<%$c->id%>">
                                                    <%$c->customer_name%></option>
                                                <%/foreach%>
                                                <%/if%>
                                                <option value="ALL">ALL</option>
                                            </select>
                                        </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <input type="hidden" name="financial_year"
                                            value="<%$financial_year%>">
                                        <input type="hidden" name="month" value="<%$month%>">
                                        <button type="submit" class="btn btn-primary mt-4">Search</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                
                <div class="card p-0 mt-4">
                    <!-- /.card-header -->
                    <div class="">
                        <table id="example1" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Sr. No..</th>
                                    <th>Customer Part Number</th>
                                    <th>Customer Part Description</th>
                                    <th>Customer Name</th>
                                    <th>Month </th>
                                    <th>Schedule Qty</th>
                                    <!--<th>Schedule Qty 2</th> -->
                                    <%if $entitlements.isJobCard != null%>
                                    <th>Job Card Qumulative Qty</th>
                                    <th>Job Card Balance Qty</th>
                                    <th>Job Card Issued</th>
                                    <th>Job Card Closed</th>
                                    <%/if%>
                                    <!-- <th>Customer Part Price</th>-->
                                    <th>Dispatch (sales qty) </th>
                                    <th>Balance Schedule qty </th>
                                    <th>Subtotal Schedule </th>
                                    <!-- <th>Subtotal Schedule 2</th> -->
                                    <th class="noExport">View</th>
                                    <th class="noExport">Edit</th>
                                </tr>
                            </thead>
                                       
                            <tbody>
                                <%assign var="i" value=1%>
                                <%assign var="total1" value=0%>
                                <%assign var="total2" value=0%>
                                
                                <%if $planing_data%>
                                    <%foreach from=$planing_data item=t%>
                                        <%if $month == $t->month%>
                                            <%assign var="planing_data_val" value=$t->planing_data%>
                                            
                                            <%assign var="issued" value=0%>
                                            <%assign var="closed" value=0%>
                                            <%assign var="main_qty" value=$planing_data_val[0]->schedule_qty%>
                                            <%assign var="subtotal1" value=0%>
                                            <%assign var="rate" value=0%>
                                            <%if $customer_part_rate[$t->customer_part_id]%>
                                                <%assign var="rate" value=$customer_part_rate[$t->customer_part_id][0]->rate%>
                                                <%assign var="subtotal1" value=$customer_part_rate[$t->customer_part_id][0]->rate * $planing_data_val[0]->schedule_qty%>

                                                <%assign var="total1" value=$total1 + $subtotal1%>
                                            <%/if%>
                                            <%assign var="total_dispatched_qty" value=0%>
                                            <%if $sales_invoice[$t->customer_part_id]%>
                                                <%foreach from=$sales_invoice[$t->customer_part_id] item=sale%>
                                                    <%if $sale->dispatched_qty > 0%>
                                                        <%assign var="dispatch_sales_qty" value=$sale->dispatched_qty%>
                                                    <%else%>
                                                        <%assign var="dispatch_sales_qty" value=0%>
                                                    <%/if%>
                                                    <%assign var="total_dispatched_qty" value=$total_dispatched_qty + $dispatch_sales_qty%>
                                                <%/foreach%>
                                            <%/if%>
                                            <%assign var="balance_s_qty" value= $planing_data_val[0]->schedule_qty - $total_dispatched_qty%>
                                <tr>


                                    <td><%$i%></td>
                                    <td><%$customer_part_data[$t->customer_part_id][0]->part_number%></td>
                                    <td><%$customer_part_data[$t->customer_part_id][0]->part_description%></td>
                                    <td><%$customers_data[$t->customer_part_id][0]->customer_name%></td>
                                    <td><%$t->month%></td>
                                    <td><%$planing_data_val[0]->schedule_qty%></td>
                                    <!-- <td><%$planing_data[0]->schedule_qty_2%></td> -->
                                    <%if $entitlements.isJobCard != null%>
                                    <td></td>
                                    <td>
                                        <%$planing_data_val[0]->schedule_qty - $job_card_qty%>
                                    </td>

                                    <td><%$issued%></td>
                                    <td><%$closed%></td>
                                    <%/if%>
                                    <!-- <td><%$rate%></td> -->
                                    <!-- <td><%$subtotal1%>-->
                                    <td>
                                        <%$total_dispatched_qty%>
                                    </td>
                                    <td>
                                        <%$balance_s_qty%>
                                    </td>
                                    <td>
                                        Rs. <%$subtotal1%> 
                                    </td>
                                    <td class="noExport">
                                        <a class=""
                                            href="<%$base_url%>view_planing_data/<%$t->id%>/<%$customer_part_data[$t->customer_part_id][0]->customer_id%>"><i class="ti ti-eye"></i></a>
                                            <!-- Edit Modal -->
                                    </td>
                                    <td>
                                        <a title="Edit" type="button" class="" data-bs-toggle="modal"
                                            data-bs-target="#editenew<%$i%>">
                                            <i class="ti ti-edit"></i>
                                        </a>
                                                                               <div class="modal fade" id="editenew<%$i%>" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Update</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="<%$base_url%>update_planning_data"
                                                            method="POST" enctype="multipart/form-data" id="update_planning_data<%$i%>" class="update_planning_data<%$i%> update_planning_data custom-form">
                                                    <div class="modal-body">
                                                        
                                                            <div class="form-group">
                                                                <label for="contractorName">Enter Schedule Qty</label>
                                                                <span class="text-danger">*</span>
                                                                <input type="text" value="<%$planing_data_val[0]->schedule_qty%>"  name="schedule_qty"
                                                                    class="form-control onlyNumericInput required-input">
                                                                <input required value="<%$t->id%>"
                                                                    type="hidden" class="form-control"
                                                                    name="planning_id">
                                                                <input required value="<%$t->customer_part_id%>"
                                                                    type="hidden" class="form-control"
                                                                    name="cust_part_id">
                                                                <input required value="<%$t->month%>"
                                                                    type="hidden" class="form-control"
                                                                    name="month_id">
                                                                <input required value="<%$t->financial_year%>"
                                                                    type="hidden" class="form-control"
                                                                    name="financial_year">
                                                                <input required value="<%$customer_part_data[$t->customer_part_id][0]->customer_id%>"
                                                                    type="hidden" class="form-control"
                                                                    name="customer_id">
                                                                    <input required value="<%$planing_data_val[0]->id%>"
                                                                    type="hidden" class="form-control"
                                                                    name="planing_id">
                                                            </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save
                                                            changes</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Edit Modal Ends -->
                                    </td>
                                </tr>
                                <%assign var="i" value=$i+1%>
                                <%/if%>
                                <%/foreach%>
                                <%/if%>
                            </tbody>
                        </table>
                        <div class="card-header">
                            <div class="row">
                                <div class="col-sm-12 col-md-6"></div>
                                <div class="col-lg-2" style="color: crimson;">
                                    <b>Total Sales Value: Rs. <%$total1%></b>
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


<script>
    $(document).ready(function() {

    $('#planningForm').validate({
        // Define validation rules
        rules: {
            customer_id: {
                required: true
            },
            customer_part_id: {
                required: true
            },
            month_id: {
                required: true
            },
            schedule_qty: {
                required: true
            }
        },
        // Define validation messages
        messages: {
            customer_id: {
                required: "Please select a customer."
            },
            customer_part_id: {
                required: "Please select a customer part number."
            },
            month_id: {
                required: "Please select a month."
            },
            schedule_qty: {
                required: "Please enter the schedule quantity.",
                number: "Please enter a valid number."
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
        // Handle form submission
        submitHandler: function (form) {
            $.ajax({
                url: $(form).attr('action'), // Get the form action URL
                type: 'POST',                // Set the request type
                data: $(form).serialize(),   // Serialize the form data
                success: function (response) {
                        var responseObject = JSON.parse(response);
                      var msg = responseObject.message;
                      var success = responseObject.success;
                      if (success == 1) {
                        toastr.success(msg);
                        $(this).parents(".modal").modal("hide")
                        setTimeout(function(){
                          // window.location.reload();
                        },1000);

                      } else {
                        toastr.error(msg);
                      }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    // Handle error response
                    toastr.error('Error adding planning data: ' + textStatus);
                }
            });
        }
    });


    $('#planningFgStockForm').validate({
        // Define validation rules
        rules: {
            customer_id: {
                required: true
            },
            customer_part_id1: {
                required: true
            },
            month_id: {
                required: true
            },
            fg_stock: {
                required: true,
                number: true
            }
        },
        // Define validation messages
        messages: {
            customer_id: {
                required: "Please select a customer."
            },
            customer_part_id1: {
                required: "Please select a customer part number."
            },
            month_id: {
                required: "Please select a month."
            },
            fg_stock: {
                required: "Please enter the production quantity.",
                number: "Please enter a valid number."
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
        // Handle form submission
        submitHandler: function (form) {
            $.ajax({
                url: $(form).attr('action'), // Get the form action URL
                type: 'POST',                // Set the request type
                data: $(form).serialize(),   // Serialize the form data
                success: function (response) {
                    // Handle success response
                    toastr.success('Planning fg stock added successfully!');
                    // Optionally, close the modal or perform other actions
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                    // Optionally, close the modal or perform other actions
                    $('.modal').modal('hide');
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    // Handle error response
                    toastr.error('Error adding planning FG Stock data: ' + textStatus);
                }
            });
        }
    });

        var customer_id = $("#customer_tracking").val();
        $.ajax({
            url: '<%$base_url%>PlanningController/get_customer_parts_for_planning',
            type: "POST",
            data: {
                id: customer_id
            },
            cache: false,
            beforeSend: function() {},
            success: function(response) {
                if (response) {
                    $('#customer_part_id').html(response);
                } else {
                    $('#customer_part_id').html(response);
                }
            }
        });

        $("#customer_tracking").change(function() {
            var customer_id = $("#customer_tracking").val();
            $.ajax({
                url: '<%$base_url%>PlanningController/get_customer_parts_for_planning',
                type: "POST",
                data: {
                    id: customer_id
                },
                cache: false,
                beforeSend: function() {},
                success: function(response) {
                    if (response) {
                        $('#customer_part_id').html(response);
                    } else {
                        $('#customer_part_id').html(response);
                    }
                }
            });
        });

        var customer_id = $("#customer_tracking1").val();
        $.ajax({
            url: '<%$base_url%>PlanningController/get_customer_parts_for_planning',
            type: "POST",
            data: {
                id: customer_id
            },
            cache: false,
            beforeSend: function() {},
            success: function(response) {
                if (response) {
                    $('#customer_part_id1').html(response);
                } else {
                    $('#customer_part_id1').html(response);
                }
            }
        });

        $("#customer_tracking1").change(function() {
            var customer_id = $("#customer_tracking1").val();
            $.ajax({
                url: '<%$base_url%>PlanningController/get_customer_parts_for_planning',
                type: "POST",
                data: {
                    id: customer_id
                },
                cache: false,
                beforeSend: function() {},
                success: function(response) {
                    if (response) {
                        $('#customer_part_id1').html(response);
                    } else {
                        $('#customer_part_id1').html(response);
                    }
                }
            });
        });

        $("#customerTracking").change(function() {
            var customer_id = $("#customerTracking").val();
            $.ajax({
                url: '<%$base_url%>PlanningController/get_customer_parts_for_planning',
                type: "POST",
                data: {
                    id: customer_id
                },
                cache: false,
                beforeSend: function() {},
                success: function(response) {
                    if (response) {
                        $('#customerPartId').html(response);
                    } else {
                        $('#customerPartId').html(response);
                    }
                }
            });
        });
        $('#planning_export_customer_part').on('submit', function(event) {
            // Prevent the form from submitting via the browser
           var form = $(this);
           var formData = form.serialize();
           let flag = formValidate("planning_export_customer_part");
            if(flag){
                event.preventDefault();
                    return;
            }else{
               
            }
        });
        $(".update_planning_data").submit(function(e){
          e.preventDefault();
          let id = $(this).attr("id");
          let flag = formValidate(id);
          let href = $(this).attr("action");
          if(flag){
            return;
          }

          var formData = new FormData($('#'+id)[0]);
          $.ajax({
            type: "POST",
            url: href,
            // url: "add_invoice_number",
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
        $('#import_customer_planning').on('submit', function(event) {
            // Prevent the form from submitting via the browser
           var form = $(this);
           var formData = form.serialize();
           let flag = formValidate("import_customer_planning");
            if(flag){
                event.preventDefault();
                    return;
            }else{
               event.preventDefault(); // Prevent the form from submitting via the browser
               // var form = $(this);
               var formData = new FormData(this);
           
               $.ajax({
                   type: 'POST',
                   url: form.attr('action'),
                   data: formData,
                   processData: false, // Important! Prevent jQuery from processing the data
                   contentType: false,
                   success: function(response) {
                       var responseObject = JSON.parse(response);
                        var msg = responseObject.message;
                        var success = responseObject.success;
                        if (success == 1) {
                            toastr.success(msg);
                            setTimeout(function(){
                                window.location.reload();
                            },1000);

                        } else {
                            toastr.error(msg);
                        }
                   },
                   error: function(xhr, status, error) {
                       // Handle error
                       toastr.success('unable to delete part.')
                   }
               });
            }
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
    });
</script>