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
            <em >Export Invoice</em></a>
        </h1>
        <br>
        <span >Generate Export Invoice</span>
      </div>
    </nav>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
       
        <!-- Main content -->
        <section class="content">
            <div class="">
            <form action="<%$base_url%>generate_new_export_sales" method="POST">
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
                                                    <option value=''>Select Customer</option>
                                                    <%if !empty($customer)%>
                                                        <%foreach from=$customer item=s%>
                                                            <option value="<%$s->id%>" ><%$s->customer_name%></option>
                                                        <%/foreach%>
                                                    <%/if%>
                                                </select>
                                            </div>
                                    </div>
                                    <div class="col-lg-4">
                                       
                                            <div class="form-group mb-3">
                                                <label for="" class="form-label">Currency <span class="text-danger">*</span></label>
                                                <select name="currency" id="currency"  class="form-control select2">
                                                    <option value=''>Select Country</option>
                                                    <%if !empty($currency_master)%>
                                                        <%foreach from=$currency_master item=s%>
                                                            <option value="<%$s->id%>" ><%$s->name%></option>
                                                        <%/foreach%>
                                                    <%/if%>
                                                </select>
                                            </div>
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
                                                            <option value="<%$s->id%>" ><%$s->name%></option>
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
                                                            <option value="<%$s->id%>" data-distance="<%$s->name%>"><%$s->name%></option>
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
                                                            <option value="<%$s->id%>" ><%$s->name%></option>
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
                                                            <option value="<%$s->id%>" data-distance="<%$s->name%>"><%$s->name%></option>
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
                                                            <option value="<%$s->id%>" ><%$s->name%></option>
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
                                                            <option value="<%$s->id%>" data-distance="<%$s->name%>"><%$s->name%></option>
                                                        <%/foreach%>
                                                    <%/if%>
                                                </select>
                                            </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="" class="form-label">Mode Of Shipment<span class="text-danger">*</span></label>
                                            <select name="mode_of_shipment" class="form-control select2" >
                                                <option value="">Select Mode Of Shipment</option>
                                                <option value="Road">Road</option>
                                                <option value="Rail">Rail</option>
                                                <option value="Air">Air</option>
                                                <option value="Ship">Ship</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="" class="form-label">Place of receipt by precarrier<span class="text-danger">*</span></label>
                                            <input type="text" placeholder="Enter Remark" value="" name="place_receipt_by_precarrier" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="" class="form-label">Precarriage By<span class="text-danger">*</span></label>
                                            <input type="text" placeholder="Enter Remark" value="" name="precarriage_by" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="" class="form-label">Container No<span class="text-danger">*</span></label>
                                            <input type="text" placeholder="Enter Remark" value="" name="container_no" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="" class="form-label">Checked In<span class="text-danger">*</span></label>
                                            <input type="text" placeholder="Enter Remark" value="" name="checked_in" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="" class="form-label">Packed In<span class="text-danger">*</span></label>
                                            <input type="text" placeholder="Enter Remark" value="" name="packed_in" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="" class="form-label">Total Boxes<span class="text-danger">*</span></label>
                                            <input type="text" placeholder="Enter Remark" value="" name="total_boxes" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="" class="form-label">Transporter</label>
                                            <select name="transporter"  class="form-control select2">
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
                                            <label for="" class="form-label">NET WEIGHT (Kg)<span class="text-danger">*</span></label>
                                            <input type="text" placeholder="Enter Remark" value="" name="net_weight" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="" class="form-label">GROSS WEIGHT (Kg)<span class="text-danger">*</span></label>
                                            <input type="text" placeholder="Enter Remark" value="" name="gross_weight" class="form-control">
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
                                            <div class="col-lg-6">
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
                                    
                                    
                                    <div class="col-lg-8">
                                        <div class="form-group">
                                            <label for="" class="form-label">Note</label>
                                            <textarea placeholder="Enter Note" value="" name="note" class="form-control" rows="4">Exchange rate notification no. 84/2023-Cus (NT) dated 16.11.2023-reg (Effective from 16th November 2023)</textarea>

                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="" class="form-label">Remark</label>
                                            <textarea placeholder="Enter Remark" value="" name="remark" class="form-control" rows="4">We intend to claim export scheme under RoDTEP-DBK/LUT BOND # AD2709230022601</textarea>
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
    // jqeuery form validation.
        $("form").validate({
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
                    mode_of_shipment:{
                        required: true
                    },
                    place_receipt_by_precarrier:{
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
                    mode_of_shipment:{
                        required: "Please select mode of shipment."
                    },
                    place_receipt_by_precarrier:{
                        required: "Please enter place receipt by precarrier."
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
                                if(res['sucess'] == 1){
                                    toastr.success('Export sales invoice generated successfully.')
                                    
                                    setTimeout(function() {
                                        window.location.href = "<%$base_url%>" + res['url'];
                                    }, 1000);
                                    
                                }else{
                                    toastr.error('Unable to generate export sales invoice.')
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


    });
</script>
