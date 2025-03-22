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
      <span >Export Packing Slip</span>
   </div>
</nav>
<div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5 listing-btn">
            <a title="Back To View Sales Invoice" class="btn btn-seconday" href="<%$base_url%>view_export_sales_by_id/<%$sales_id%>" type="button"><i class="ti ti-arrow-left"></i></a>
        </div>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<!-- Main content -->
<section class="content">
   <div class="">
      <div class="row">
         <div class="col-12">
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
                        <p class="tgdp-rgt-tp-ttl">Invoice Number</p>
                        <p class="tgdp-rgt-tp-txt" title="<%$customer[0]->customer_name%>">
                        <%$new_sales[0]->sales_number%>
                        </p>
                    </div>
                    <div class="tgdp-rgt-tp-sect">
                        <p class="tgdp-rgt-tp-ttl">Invoice Date</p>
                        <p class="tgdp-rgt-tp-txt" title="<%$new_sales[0]->created_date%>">
                        <%$new_sales[0]->created_date%>
                        </p>
                    </div>
                    <div class="tgdp-rgt-tp-sect">
                        <p class="tgdp-rgt-tp-ttl">Packing List No.</p>
                        <p class="tgdp-rgt-tp-txt" title="<%display_no_character($export_packing_slip['packing_number'])%>">
                            <%display_no_character($export_packing_slip['packing_number'])%>
                        </p>
                    </div>
                    <div class="tgdp-rgt-tp-sect">
                        <p class="tgdp-rgt-tp-ttl">Packing List Date</p>
                        <p class="tgdp-rgt-tp-txt" title="<%display_no_character($export_packing_slip['packing_date'])%>">
                            <%display_no_character($export_packing_slip['packing_date'])%>
                        </p>
                    </div>
                    <div class="tgdp-rgt-tp-sect">
                        <p class="tgdp-rgt-tp-ttl">Package Type </p>
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
          
            <div class="card mt-3">
               <div class="card-header">
               <form action="<%$base_url%>add_export_packing_slip" method="POST" id="add_export_packing_slip" class="add_export_packing_slip custom-form">
                    <input type="hidden" value="<%$export_packing_slip['export_packing_slip_id']%>" id="export_packing_slip_id" />
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group mb-3">
                                <label for="" class="form-label">Contents<span class="text-danger">*</span></label>
                                <input type="text" placeholder="Enter Contents" value="<%$export_packing_slip['contents']%>" name="content" class="form-control required-input content_value">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-3">
                                <label for="" class="form-label">Material Used<span class="text-danger">*</span></label>
                                <input type="text" placeholder="Enter Material Used" value="<%$export_packing_slip['material_used']%>" name="material_used" class="form-control required-input material_used_value">
                            </div>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <div>
                                <span class="fs-4 ">Packing Details</span>
                                <button type="button" class="btn btn-primary float-md-end add-package">Add package</button>
                            </div>
                        </div>
                        <div class="col-lg-12 packing-box">
                            <div class="border row border-dark m-1 mb-0 border">
                                <div class="w-25 border form-group border-dark  text-center p-1">
                                <label for="" class="form-label"> Package No</label>
                                </div>
                                <div class="w-25 border form-group border-dark  text-center p-1">
                                <label for="" class="form-label">Package Size</label>
                                </div>
                                <div class=" border form-group border-dark  text-center p-1" style="width: 45%;">
                                <label for="" class="form-label">Part</label>
                                </div>
                                <div class=" border form-group border-dark  text-center p-1" style="width: 5%;">
                                <label for="" class="form-label">Action</label>
                                </div>
                            </div>
                            <%foreach from=$export_packing_slip_parts key=key item='parts_row'%>
                            <div class="border row border-dark m-1 mt-0 border-top-0 mb-0 packing-box-row">
                                <div class="w-25 border  border-dark  text-center p-1 border-top-0 d-flex">
                                    <div class="form-group justify-content-center d-flex w-100 align-items-center flex-column">
                                        <label class="hide">Package No</label>
                                        <input type="text" placeholder="Enter Package No" value="<%$key%>" name="material_used" class="form-control w-75 required-input packing_no onlyNumericInput">
                                    </div>
                                </div>
                                <div class="w-25 border  border-dark  text-center p-1 border-top-0 d-flex">
                                <div class="form-group justify-content-center d-flex w-100 align-items-center flex-column">
                                        <label class="hide">Package Size</label>
                                    <input type="text" placeholder="Enter Package Size" value="<%$packing_details_data[$key]%>" name="material_used" class="form-control w-75  justify-content-center required-input packing_size">
                                </div>
                                </div>
                                <div class=" border border-dark p-1 border-top-0" style="width: 45%;">
                                    <table class="table table-bordered border-primary part-box part-box-rows ">
                                        <thead>
                                            <tr>
                                            <th scope="col" width="35%" class="text-center">Part </th>
                                            <th scope="col" class="text-center">Quantity</th>
                                            <th scope="col" class="text-center">Net Weight in Kg</th>
                                            <th scope="col" width="10%" class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <%foreach from=$parts_row key=k item='part'%>
                                            <tr>
                                            <td width="35%">
                                                <div class="form-group">
                                                    <label class="hide">Part</label>
                                                    <select name="parts"  class="form-control select2 required-input w-25 part_id">
                                                    <option value=''>Select Part</option>
                                                    <%foreach from=$export_sales_parts key=kp item='part_val'%>
                                                        <option value="<%$part_val->part_id%>" <%if $part_val->part_id eq $part['part_id']%>selected<%/if%>><%$part_val->part_number%>/<%$part_val->part_description%></option>
                                                    <%/foreach%>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <label class="hide">Quantity</label>
                                                    <input type="text" placeholder="Enter Quantity" value="<%$part['qty']%>" name="material_used" class="form-control required-input part_qty onlyNumericInput" data-min="1">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <label class="hide">Net Weight</label>
                                                    <input type="text" placeholder="Enter Net Weight" value="<%$part['net_weight']%>" name="material_used" class="form-control required-input part_net_weight onlyNumericInput" data-min="1">
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <i class="ti ti-square-rounded-plus add-part"></i>
                                                <%if $k neq 0%>
                                                <i class="ti ti-circle-minus remove-part"></i>
                                                <%/if%>
                                            </td>
                                            </tr>
                                            <%/foreach%>
                                        </tbody>
                                    </table>
                                </div>
                                <div class=" border  border-dark  text-center p-1 border-top-0 d-flex" style="width: 5%;">
                                <div class="form-group justify-content-center d-flex w-100 align-items-center flex-column">
                                <i class="ti ti-circle-minus remove-packing fs-2"></i>
                                </div>
                                </div>
                            </div>
                            <%/foreach%>
                        </div>
                        <div class="col-lg-12 mt-3">
                        <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </div>
               </form>
               </div>
            </div>
         </div>
      </div>
          
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
  .border-dark {
    border-color: #bababa !important;
}
thead, tbody, tfoot, tr, td, th {
    border-color: #e5d7d7 !important;
}
.table thead tr th {
    border: 1px solid #e5d7d7 !important;
}
.select2 {
    width: 343px !important;
}
.remove-packing {
    cursor: pointer;
    color: var(--bs-theme-color);
}
</style>
<script>
    var export_sales_parts_html = <%json_encode($export_sales_parts_html)%>;
    var total_qty_val = <%json_encode($total_qty)%>;
    var total_box = <%json_encode($new_sales[0]->total_boxes)%>;
    var total_net_weight_val = <%json_encode($new_sales[0]->net_weight)%>;
    var sales_id = <%json_encode($sales_id)%>;
    var base_url = <%json_encode(base_url())%>;
</script>
<script src="<%$base_url%>/public/js/planning_and_sales/export_sales_packing_slip.js"></script>
