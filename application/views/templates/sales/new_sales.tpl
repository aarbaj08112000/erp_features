<div class="wrapper container-xxl flex-grow-1 container-p-y">
    <!-- Navbar -->
    <!-- /.navbar -->
    <!-- Main Sidebar Container -->
    <!-- Content Wrapper. Contains page content -->

    <nav aria-label="breadcrumb">
      <div class="sub-header-left pull-left breadcrumb">
        <h1>
          Planning & Sales
          <a hijacked="yes"  class="backlisting-link" title="Back to Issue Request Listing" >
            <i class="ti ti-chevrons-right" ></i>
            <em >Sales Invoice</em></a>
        </h1>
        <br>
        <span >Generate Sales Invoics <%if !empty($reused_sales_no)%>(<%$reused_sales_no%>) <%/if%></span>
      </div>
    </nav>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
       
        <!-- Main content -->
        <section class="content">
            <div class="">
            <form action="<%$base_url%>generate_new_sales" method="POST">
                <div class="row">
                    <div class="col-12">
                        <!-- /.card -->
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div id="loading-overlay">
                                        <div id="loading-spinner"></div>
                                    </div>
                                    <div class="col-lg-4">
                                       
                                            <div class="form-group mb-3">
                                                <label for="" class="form-label">Customer <span class="text-danger">*</span></label>
                                                <select name="customer_id" id="customer_tracking"  class="form-control select2">
                                                    <option value=''>Select</option>
                                                    <%if !empty($customer)%>
                                                        <%foreach from=$customer item=s%>
                                                            <option value="<%$s->id%>" data-distance="<%$s->$distanceCol%>"><%$s->customer_name%></option>
                                                        <%/foreach%>
                                                    <%/if%>
                                                </select>
                                            </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="" class="form-label">Part Number // Description // FG Stock // Rate // Tax Structure
                                            <span class="text-danger">*</span> </label>
                                            <select name="part_id" id="part_id"  class="form-control select2">
                                                <option value=''>Please select</option>
                                            </select>
                                        </div>                            
                                    </div>
                                    
                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="" class="form-label">Mode Of Transport<span class="text-danger">*</span></label>
                                            <select name="mode" class="form-control select2" >
                                                <option value="">Select</option>
                                                <option value="1">Road</option>
                                                <option value="2">Rail</option>
                                                <option value="3">Air</option>
                                                <option value="4">Ship</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="" class="form-label">Transporter<span class="text-danger">*</span></label>
                                            <select name="transporter"  class="form-control select2" id="transporter_drop">
                                                <option value="">Select Transporter</option>
                                                <%if !empty($transporter)%>
                                                    <%foreach from=$transporter item=tr%>
                                                        <option value="<%$tr->id%>"><%$tr->name%> - <%$tr->transporter_id%></option>
                                                    <%/foreach%>
                                                <%/if%>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="" class="form-label">Vehicle No.<span class="text-danger">*</span></label>
                                            <input type="text" 
                                                   placeholder="Enter Vehicle No" 
                                                   value="" 
                                                   name="vehicle_number" 
                                                    class="form-control" id="vehicle_number" />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="" class="form-label">L.R No </label>
                                            <input type="text" placeholder="Enter L.R No" value="" name="lr_number" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 ">
                                        <div class="form-group mb-3">
                                            <label for="" class="form-label">Distance of Transportation<span class="text-danger">*</span></label>
                                            <input type="text" placeholder="Enter Distance of Transportation" value="" name="distance"  class="form-control" id="distance">
                                        </div>
                                    </div>
                                   
                                    <div class="col-lg-4 form-group">
                                        <label class="form-label"   >Shipping Address: </label><br>
                                        <div class="row" style="border:1px;">
                                            <div class="col-lg-5">
                                                <div class="form-group mb-3 mt-2">   
                                                    <input type="radio" name="ship_addressType" checked value="customer" onchange="toggleConsigneeSelection()">
                                                    &nbsp;<label>Same as Customer</label><br>
                                                </div>
                                            </div>
                                            <div class="col-lg-5">
                                                <div class="form-group mb-3 mt-2">   
                                                    <input type="radio" name="ship_addressType" value="consignee" onchange="toggleConsigneeSelection()" id="customerAddress">
                                                    &nbsp;<label >Select Consignee Address</label><br>
                                                </div>
                                                <div class="form-group" id="consigneeSelect">
                                                    <select name="consignee"   disabled class="form-control select2" id="consigneeSelectInput">
                                                        <option value="">Select</option>
                                                        <%foreach from=$consignee_list item=c%>
                                                            <option value="<%$c->id%>" data-distance="<%$c->$distanceCol %>">
                                                                <%$c->consignee_name%> - <%$c->location%>
                                                            </option>
                                                        <%/foreach%>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="" class="form-label">Remark</label>
                                            <input type="text" placeholder="Enter Remark" value="" name="remark" class="form-control">
                                        </div>
                                    </div>
                                    <br>
                                    <input type="hidden" name="reused_sales_no" id="reused_sales_no" value="<%$reused_sales_no %>" required class="form-control"/>   
                                    <div class="col-lg-5">
                                        <div class="form-group">

                                            <button type="submit" class="btn btn-danger mt-4">Generate</button>
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
            </form>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- /.content-wrapper -->

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<script>
    function toggleConsigneeSelection() {
        var consigneeSelect = document.getElementById("consigneeSelect");
        var shipAddressType = document.querySelector('input[name="ship_addressType"]:checked').value;

        if (shipAddressType === "customer") {
             consigneeSelect.disabled = true;
             consigneeSelect.style.display = "none";
             consigneeSelect.value = ''; //change to default value as select.
             // $("[name='consignee']").prop("disabled",true).trigger("update");
        } else if (shipAddressType === "consignee") {
            consigneeSelect.disabled = false;
            consigneeSelect.style.display = "block";
            // $("[name='consignee']").prop("disabled",false).trigger("update");
        }
    }

    $(document).ready(function() {
        var consigneeSelect = document.getElementById("consigneeSelect");
        consigneeSelect.style.display = "none";
        var customer_id = $("#customer_tracking").val();
        // $('#new_po_id').val(id);
        // var salesno = $('#sales_number').val();
        $.ajax({
            url: '<%$site_url%>SalesController/get_customer_parts_for_sale',
            type: "POST",
            data: {
                id: customer_id
            },
            cache: false,
            beforeSend: function() {
                // Show the loading icon
                $("#loading-overlay").show();
            },
            success: function(response) {
                 // Hide the loading icon
                if (response) {
                    $('#part_id').html(response);
                } else {
                    $('#part_id').html(response);
                }
            },complete: function() {
                    // Hide the loading overlay
                    $("#loading-overlay").hide();
            }
       });
        $("#customer_tracking").change(function() {
            var customer_id = $("#customer_tracking").val();
            $.ajax({
                url: '<%$site_url%>SalesController/get_customer_parts_for_sale',
                type: "POST",
                data: {
                    id: customer_id
                    //, salesno: salesno
                },
                cache: false,
                beforeSend: function() {
                     // Show the loading icon
                    // $("#loading-overlay").show();
                },
                success: function(response) {
                    
                    if (response) {
                        $('#part_id').html(response);
                        $('#part_id').trigger("change");
                    } else {
                        $('#part_id').html(response);
                    }
                },
                complete: function() {
                    // Hide the loading icon
                    // $("#loading-overlay").hide();
                }        
            });
            //var customers = <php echo json_encode($customer); ?>;
            //alert(JSON . stringify(customers, null, 2)); // Pretty-print with indentation
            var selectedCustomer = $(this).find('option:selected');
            var distance = selectedCustomer.data('distance'); // Get the distance from the data attribute
            // if (distance) {
               $('#distance').val(distance);
            // }

        })
    // jqeuery form validation.
        $("form").validate({
                rules: {
                    customer_id: {
                        required: true
                    },
                    part_id: {
                        required: true
                    },
                    mode: {
                        required: true
                    },
                    transporter: {
                        required: true
                    },
                    vehicle_number: {
                        required: true
                    },
                    distance: {
                        required: true
                    },
                    consignee: {
                        required: function() {
                            return $("input[name='ship_addressType']:checked").val() === "consignee";
                        }
                    },
                    remark: {
                        maxlength :100
                    }
                },
                messages: {
                    customer_id: {
                        required: "Please select a customer."
                    },
                    part_id: {
                        required: "Please select a part."
                    },
                    mode: {
                        required: "Please select a mode of transport."
                    },
                    transporter: {
                        required: "Please select a transporter."
                    },
                    vehicle_number: {
                        required: "Please enter a vehicle number."
                    },
                    distance: {
                        required: "Please enter the distance of transportation."
                    },
                    consignee: {
                        required: "Please select a consignee address."
                    },
                    remark: {
                        maxlength :"Enter remark is less than 100 characters."
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
                                if(res['sucess'] == 1){
                                    toastr.success('Sales Invoice generated successfully.')
                                    
                                    setTimeout(function() {
                                        window.location.href = "<%$base_url%>" + res['url'];
                                    }, 1000);
                                    
                                }else{
                                    toastr.error('Unable to generate invooice.')
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
            $('.select2').on('change', function() {
            $(this).valid();
        });


            $("input[name='ship_addressType']").change(function() {
                if ($(this).val() === "consignee") {
                   $("[name='consignee']").prop("disabled",false).trigger("update");
                } else {
                    $("[name='consignee']").prop("disabled",true).trigger("update");
                }
            });
            //set the distance to consinee one
        $('#consigneeSelectInput').change(function () {
            var selectedCustomer = $(this).find('option:selected');
            var distance = selectedCustomer.data('distance'); // Get the distance from the data attribute
               $('#distance').val(distance);
            
        });

        //set the distance to customer one
        $('input[name="ship_addressType"]').change(function() {
            const selectedValue = $(this).val();
           if (selectedValue === "customer") {
              var selectedCustomer = $('#customer_tracking').find('option:selected');
              var distance = selectedCustomer.data('distance'); // Get the distance from the data attribute
              if (distance) {
               $('#distance').val(distance);
            }
          } 
        });
        $('#transporter_drop').change(function() {
            var transporter_id  = $(this).val();
            if(transporter_id > 0){
                $.ajax({
                    url: '<%$site_url%>Welcome/get_transportor_data',
                    type: "POST",
                    data: {
                        id: transporter_id
                    },
                    success: function(response) {
                         let res = JSON.parse(response);
                         $("#vehicle_number").val(res.vehicle_number)
                    },
                    complete: function() {
                        // Hide the loading icon
                        // $("#loading-overlay").hide();
                    }        
                });
            }else{
                $("#vehicle_number").val("")
            }
        });
        transporter_drop


    });
</script>
