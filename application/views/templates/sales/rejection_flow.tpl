<div class="wrapper container-xxl flex-grow-1 container-p-y">
   <!-- Navbar -->
   <!-- /.navbar -->
   <!-- Main Sidebar Container -->
   <nav aria-label="breadcrumb">
      <div class="sub-header-left pull-left breadcrumb">
         <h1>
            Planning & Sales
            <a hijacked="yes" href="javascript:void(0)" class="backlisting-link" title="Back to Issue Request Listing">
            <i class="ti ti-chevrons-right"></i>
            <em>Sales Invoice</em>
            </a>
         </h1>
         <br>
         <span >Rejection Flow</span>
      </div>
   </nav>
   <!-- Content Wrapper. Contains page content -->
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
                         <form action="<%$base_url%>generate_rejection_flow" method="POST">
                        <div class="row">
                           <div class="col-lg-4">
                              <div class="form-group mb-3">
                                    <label for="" class="form-label">Select Customer<span class="text-danger">*</span> </label>
                                    <select name="customer_id" required id="" class="form-control select2">
                                       <%if $customer%>
                                       <%foreach from=$customer item=s%>
                                       <option value="<%$s->id%>"><%$s->customer_name%></option>
                                       <%/foreach%>
                                       <%/if%>
                                    </select>
                              </div>
                           </div>
                           <div class="col-lg-4">
                           <div class="form-group mb-3">
                           <label for="" class="form-label">Select Part<span class="text-danger">*</span> </label>
                           <select name="part_number" required id="" class="form-control select2">
                           <option value="production_rejection">Production Rejection</option>
                           <!-- <option value="production_scrap">Production Scrap</option> -->
                           </select>
                           </div>
                           </div>
                           <div class="col-lg-4">
                           <div class="form-group mb-3">
                           <label for="" class="form-label">Select Type<span class="text-danger">*</span> </label>
                           <select name="type" required id="" class="form-control select2">
                           <option value="store_stock">Store Stock</option>
                           <option value="FG">FG</option>
                           </select>
                           </div>
                           </div>
                           <div class="col-lg-4">
                           <div class="form-group mb-3">
                           <label for="" class="form-label">Enter Qty</label>
                           <input type="text" step="any" placeholder="Enter Qty" value="" name="qty" class="form-control onlyNumericInput">
                           </div>
                           </div>
                           <div class="col-lg-4">
                           <div class="form-group" mb-3>
                           <label for="" class="form-label">Enter Price</label>
                           <input type="text" step="any" placeholder="Enter Price" value="" name="price" class="form-control onlyNumericInput">
                           </div>
                           </div>
                           <!-- <div class="col-lg-2">
                              <div class="form-group">
                                  <label for="">Enter HSN Code</label>
                                  <input type="text" placeholder="Enter HSN" value="" name="hsn_code" class="form-control">
                              </div>
                              </div>
                              <div class="col-lg-2">
                              <div class="form-group">
                                  <label for="">Enter Mode Of Transport </label>
                                  <input type="text" placeholder="Enter Mode Of Transport" value="" name="mode" class="form-control">
                              </div>
                              </div>
                              <div class="col-lg-2">
                              <div class="form-group">
                                  <label for="">Enter Transporter </label>
                                  <input type="text" placeholder="Enter Transporter" value="" name="transporter" class="form-control">
                              </div>
                              </div>
                              <div class="col-lg-2">
                              <div class="form-group">
                                  <label for="">Enter Vehicle No. </label>
                                  <input type="text" placeholder="Enter Vehicle No" value="" name="vehicle_number" class="form-control">
                              </div>
                              </div>
                              <div class="col-lg-2">
                              <div class="form-group">
                                  <label for="">Enter L.R No </label>
                                  <input type="text" placeholder="Enter L.R No" value="" name="lr_number" class="form-control">
                              </div>
                              </div> -->
                           <div class="col-lg-4">
                           <div class="form-group mb-3">
                           <label for="" class="form-label">Enter Remark </label>
                           <input type="text" placeholder="Enter Remark" value="" name="remark" class="form-control">
                           </div>
                           </div>
                           <div class="col-lg-12">
                           <div class="form-group">
                           <button type="submit" class="btn btn-danger mt-4">Generate</button>
                           </div>
                           </form>
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