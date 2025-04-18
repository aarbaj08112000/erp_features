<div  class="wrapper container-xxl flex-grow-1 container-p-y">
    <!-- Navbar -->
    <!-- /.navbar -->
    <!-- Main Sidebar Container -->
    <!-- Content Wrapper. Contains page content -->

    <div class="sub-header-left pull-left breadcrumb">
      <h1>
        Planning & Sales
        <a hijacked="yes" href="#stock/issue_request/index" class="backlisting-link" title="Back to Issue Request Listing" >
          <i class="ti ti-chevrons-right" ></i>
          <em >Sales Invoice</em></a>
      </h1>
      <br>
      <span >PDI Details</span>
    </div>

    <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5 listing-btn">
            <a title="Back To Supplier Po List" class="btn btn-seconday" href="<%$base_url%>sales_invoice_released" type="button"><i class="ti ti-arrow-left"></i></a>
        </div>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="">
               
                
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <div class="card p-0 mt-4">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="po_num" class="form-label">Customer </label><span class="text-danger">*</span>
                                            <input type="text" readonly value="<%$sales_parts_for_PDI[0]->customer_name%>" name="part_desc" required class="form-control" id="exampleInputEmail1" placeholder="Enter Part Description" aria-describedby="emailHelp">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="po_num" class="form-label">Sales Invoice Number </label><span class="text-danger">*</span>
                                            <input type="text" readonly value="<%$sales_parts_for_PDI[0]->sales_number%>" name="part_number" required class="form-control" id="exampleInputEmail1" placeholder="Enter Part Number" aria-describedby="emailHelp">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group mb-3" >
                                            <label for="po_num" class="form-label">Sales Invoice Date</label><span class="text-danger">*</span>
                                            <input type="text" readonly value="<%$sales_parts_for_PDI[0]->created_date%>" name="part_desc" required class="form-control" id="exampleInputEmail1" placeholder="Enter Part Description" aria-describedby="emailHelp">
                                        </div>
                                    </div>
                                </div>
                                <form action="javascript:void(0)" method="post" id="submitByPartId">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group mb-3">
                                                <label  class="form-label" for="">Select Part NO // Description<span class="text-danger">*</span> </label>
                                                <select name="sales_part_id" id="sales_part_id" required class="form-control select2">
                                                    <option value=''>Please select</option>
                                                    <%if $sales_parts_for_PDI%>
                                                        <%foreach from=$sales_parts_for_PDI item=s%>
                                                            <%if $s->sales_part_id != null%>
                                                                <option value="<%$s->sales_part_id%>,<%$s->customer_part_id%>"><%$s->part_number%>//<%$s->part_description%></option>
                                                            <%/if%>
                                                        <%/foreach%>
                                                    <%/if%>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-8 mt-3">
                                        </div>

                                        <div class="col-sm-1 mt-3">
                                            <div class="form-group">
                                            <button type="submit"  class="btn btn-primary" >Submit</button>
                                              <%*  <input type="button" id="submitByPartId" class="btn btn-primary mt-2" value="Submit"> *%>
                                            </div>
                                        </div>
                                        <div class="col-sm-1 mt-3">
                                            <div class="form-group">
                                            <button type="submit" id="addNewPartParms" class="btn btn-primary" style="width: max-content;" title="This will add any new parameters defined in drawing master." >Add New Parm</button>
                                              <%*  <input type="button" id="addNewPartParms" title="This will add any new parameters defined in drawing master." class="btn btn-primary mt-2" value="Add New Parm"> *%>
                                            </div>
                                        </div>
                                        <div class="col-sm-1 mt-3">
                                            <div class="form-group">
                                            
                                                <a class="btn btn-success" id="getPDILink" target="_blank" style="width: max-content;margin-left: 52px;">View PDI</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content" id="observationTableData">
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script>
    //on click of submit : to auto submit observation values
    $("#submitByPartId").submit(function(e){
        e.preventDefault();
        var sales_part_id_customer_id = $("#sales_part_id").val();
        if (sales_part_id_customer_id == '') {
            toastr.error("Please select Part Number.");
        } else {
            $.ajax({
                url: '<%$base_url%>PartInspectionController/auto_submit_inspection_report_observations',
                type: "POST",
                data: {
                    sales_part_id_customer_id: sales_part_id_customer_id,
                    addNewPartParms: "false"
                },
                cache: false,
                beforeSend: function() {},
                success: function(response) {
                    $('#observationTableData').html(response);
                }
            });
        }

    })
   

    //on click of add : show this modal change
    $(document).on("click", "#addNewPartParms", function() {
        var sales_part_id_customer_id = $("#sales_part_id").val();
        if (sales_part_id_customer_id == '') {
            // alert('Please select Part Number.');
            toastr.error("Please select Part Number.");
        } else {
            $.ajax({
                url: '<%$base_url%>PartInspectionController/auto_submit_inspection_report_observations',
                type: "POST",
                data: {
                    sales_part_id_customer_id: sales_part_id_customer_id,
                    addNewPartParms: "true"
                },
                cache: false,
                beforeSend: function() {},
                success: function(response) {
                    $('#observationTableData').html(response);
                }
            });
        }
    });

    // JavaScript to handle the Edit button clicks
    $(document).on("click", ".edit-button", function() {
        var itemId = $(this).data("item-id");
        var r_id = $(this).data("item-r-id");
        var sales_part_id = $(this).data("item-sales-part-id");
        // Use AJAX to load the edit form content based on the item ID
        $.ajax({
            url: '<%$base_url%>PartInspectionController/edit_inspection_parm_report_form',
            method: "post",
            data: {
                id: itemId,
                sales_part_id: sales_part_id
            },
            success: function(response) {
                $("#editModal .modal-body").html(response);
                $("#editModal").modal("show");
            }
        });
    });

    // Get a reference to the link and input field
    var getPDILink = document.getElementById('getPDILink');

    // Add a click event listener to the link
    getPDILink.addEventListener('click', function(e) {
        var sales_part_id_customer_id = $("#sales_part_id").val();
        var valuesArray = sales_part_id_customer_id.split(",");
        var sales_part_id = valuesArray[0];
        getPDILink.href = '<%$base_url%>view_PDI/' + sales_part_id;
        if (sales_part_id == '') {
            // alert('Please select Part Number.'); 
            toastr.error("Please select Part Number.");
            e.preventDefault(); // Prevent the link from navigating
        }
    });

    // JavaScript to handle the Edit button clicks
    $(document).on("click", ".submit-button", function() {
        var itemId = $(this).data("item-id");
        var sales_part_id = $(this).data("item-sales-part-id");
        
        const r_id = document.querySelector(`[name="r_id-${itemId}"]`).value;
        const inputValue1 = document.querySelector(`[name="observation1-${itemId}"]`).value;
        const inputValue2 = document.querySelector(`[name="observation2-${itemId}"]`).value;
        const inputValue3 = document.querySelector(`[name="observation3-${itemId}"]`).value;
        const inputValue4 = document.querySelector(`[name="observation4-${itemId}"]`).value;
        const inputValue5 = document.querySelector(`[name="observation5-${itemId}"]`).value;
        const remark = document.querySelector(`[name="remark-${itemId}"]`).value;
        const parameter = document.querySelector(`[name="parameter-${itemId}"]`).value;
        const specification = document.querySelector(`[name="specification-${itemId}"]`).value;
        const evalution_mesaurement_technique = document.querySelector(`[name="evalution_mesaurement_technique-${itemId}"]`).value;
        const lower_spec_limit = document.querySelector(`[name="lower_spec_limit-${itemId}"]`).value;
        const upper_spec_limit = document.querySelector(`[name="upper_spec_limit-${itemId}"]`).value;
        const critical_parm = document.querySelector(`[name="critical_parm-${itemId}"]`).value;

        // Use AJAX to load the update content based on the item ID
        $.ajax({
            url: '<%$base_url%>PartInspectionController/update_inspection_report_observations',
            method: "post",
            data: {
                r_id: r_id,
                sales_part_id: sales_part_id,
                observation1: inputValue1,
                observation2: inputValue2,
                observation3: inputValue3,
                observation4: inputValue4,
                observation5: inputValue5,
                remark: remark,
                parameter: parameter,
                specification: specification,
                evalution_mesaurement_technique: evalution_mesaurement_technique,
                lower_spec_limit: lower_spec_limit,
                upper_spec_limit: upper_spec_limit,
                critical_parm: critical_parm
            },
            success: function(response) {
                var responseObject = JSON.parse(response);
                var msg = responseObject.message;
                var success = responseObject.success;
                if (success == 1) {
                  toastr.success(msg);
                } else {
                  toastr.error(msg);
                }
            }
        });
    });
</script>
