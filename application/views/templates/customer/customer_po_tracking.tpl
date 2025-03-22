<div  class="wrapper container-xxl flex-grow-1 container-p-y">
    <!-- Navbar -->
    <!-- /.navbar -->
    <!-- Main Sidebar Container -->
    <!-- Content Wrapper. Contains page content -->

    <nav aria-label="breadcrumb">
    <div class="sub-header-left pull-left breadcrumb">
      <h1>
        Planning & Sales
        <a hijacked="yes" class="backlisting-link" title="Back to Issue Request Listing" >
          <i class="ti ti-chevrons-right" ></i>
          <em >Add Sales Order</em></a>
      </h1>
      <br>
      <span >Add Sales Order</span>
    </div>
  </nav>
  <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5">
      <a class="btn btn-seconday" href="<%base_url('customer_po_tracking_all')%>" title="Back To Sales Order"><i class="ti ti-arrow-left"></i></a>
    </div>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        

        <!-- Main content -->
        <section class="content">
            <div class="">
                <div class="row">
                    <div class="col-12">

                        <!-- /.card -->

                        <div class="card">
                            <div class="card-header">

                            <form action="<%$base_url%>generate_customer_po_tracking" method="POST" id="generate_tracking" enctype='multipart/form-data'>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                                <label for="" class="form-label">Select Customer <span class="text-danger">*</span> </label>
                                                <select name="customer_id" required id="" class="form-control select2">
                                                    <%if $customer_data%>
                                                        <%foreach from=$customer_data item=p%>
                                                            <option value="<%$p->id%>">
                                                                <%$p->customer_name%>
                                                            </option>
                                                        <%/foreach%>
                                                    <%/if%>
                                                </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for=""  class="form-label">Select Start PO Date <span class="text-danger">*</span> </label>
                                            <input type="date" value="<%$smarty.now|date_format:'%Y-%m-%d'%>" required name="po_start_date" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for=""  class="form-label">Select End Date </label>
                                            <input type="date" value="<%$smarty.now|date_format:'%Y-%m-%d'%>" required name="po_end_date" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for=""  class="form-label">Enter PO Number <span class="text-danger">*</span> </label>
                                            <input type="text" placeholder="Enter PO Number" required value="" name="po_number" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for=""  class="form-label">Enter PO Amendment No </label>
                                            <input type="text" step="any" placeholder="Enter Amendment PO number" value="" name="po_amedment_number" class="form-control onlyNumericInput">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for=""  class="form-label">Select PO Amendment Date </label>
                                            <input type="date" value="" name="po_amendment_date" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="po_num"  class="form-label">Upload PO</label>
                                            <input type="file" name="uploadedDoc" class="form-control" id="exampleuploadedDoc" placeholder="Upload PO" aria-describedby="uploadDocHelp">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-danger mt-4">Generate</button>
                                        </div>
                                        </div>
                                        </div>
                                        </div>
                                        </form>
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
$("#generate_tracking").validate({
    rules: {
            customer_id: "required",
            po_start_date: "required",
            po_end_date: "required",
            po_number: "required"
        },
        messages: {
            customer_id: "Please select a customer",
            po_start_date: "Please select a start PO date",
            po_end_date: "Please select an end PO date",
            po_number: "Please enter the PO number"
        },
        submitHandler: function(form) {
            // Create a new FormData object to handle the file upload
            var formData = new FormData(form);

            // Custom submit handler
            $.ajax({
                url: form.action,
                type: form.method,
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    // Handle the success response here
                    if(response != '' && response != null && typeof response != 'undefined'){
                        let res = JSON.parse(response);
                        if(res['sucess'] == 1){
                            toastr.success(res['msg'])
                            setTimeout(() => {
                                window.location.href = '<%$base_url%>' + res['url'];
                            }, 1000);
                        }else{
                            toastr.error(res['msg']);
                        }
                       
                    }
                },
                error: function(xhr, status, error) {
                    // Handle the error response here
                    console.error('Form submission failed:', error);
                }
            });
        }
    });

</script>