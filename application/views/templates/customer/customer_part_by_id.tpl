<div class="wrapper container-xxl flex-grow-1 container-p-y">
    <!-- Navbar -->
    <!-- /.navbar -->
    <!-- Main Sidebar Container -->
    <!-- Content Wrapper. Contains page content -->

    <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme filter-popup-block" style="width: 0px;">
<div class="app-brand demo justify-content-between">
    <a href="javascript:void(0)" class="app-brand-link">
        <span class="app-brand-text demo menu-text fw-bolder ms-2">Filter</span>
    </a>
    <div class="close-filter-btn d-block filter-popup cursor-pointer">
            <i class="ti ti-x fs-8"></i>
        </div>
</div>
<nav class="sidebar-nav scroll-sidebar filter-block" data-simplebar="init">
  <div class="simplebar-content" >
    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <div class="filter-row">
          <li class="nav-small-cap">
            <span class="hide-menu">Customer Part</span>
            <span class="search-show-hide float-right"><i class="ti ti-minus"></i></span>
          </li>
          <li class="sidebar-item">
            <div class="input-group">
              <select name="customer_name" class="form-control select2" id="customer_name">
                <option value="">Select Customer Part</option>
              <%foreach $customer_part_list as $val%>
              <option 
                  value="<%trim($val->part_number)%>"><%$val->part_number%></option>
                <%/foreach%>
              </select>
            </div>
          </li>
        </div>
          
        

    </ul>
  </div>
</nav>

<div class="filter-popup-btn">
        <button class="btn btn-outline-danger reset-filter">Reset</button>
        <button class="btn btn-primary search-filter">Search</button>
    </div>
</aside>

<nav aria-label="breadcrumb">
<div class="sub-header-left pull-left breadcrumb">
  <h1>
    Planning & Sales
    <a hijacked="yes" href="<%$base_url%>customer_master" class="backlisting-link" title="Back to Issue Request Listing" >
      <i class="ti ti-chevrons-right" ></i>
      <em >Customer Master</em></a>
  </h1>
  <br>
  <span >Customer Part</span>
</div>
</nav>
<div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5">
     <button type="submit" data-bs-toggle="modal" class="btn btn-seconday" data-bs-target="#exampleAddModal"> Customer Part
</button>
<button class="btn btn-seconday" type="button" id="downloadCSVBtn" title="Download CSV"><i class="ti ti-file-type-csv"></i></button>
<button class="btn btn-seconday" type="button" id="downloadPDFBtn" title="Download PDF"><i class="ti ti-file-type-pdf"></i></button>
<button class="btn btn-seconday filter-icon" type="button"><i class="ti ti-filter" ></i></i></button>
<button class="btn btn-seconday" type="button"><i class="ti ti-refresh reset-filter"></i></button>
<a class="btn btn-seconday" href="<%base_url()%>customer_master" id="downloadPDFBtn" title="Back To 
Customer Master"><i class="ti ti-arrow-left"></i></a>
</div>
<div class="w-100">
    <input type="text" name="reason" placeholder="Filter Search" class="form-control serarch-filter-input m-3 me-0" id="serarch-filter-input" fdprocessedid="bxkoib">
  </div>
    <div class="content-wrapper w-100">
        <!-- Content Header (Page header) -->
      
        <!-- Main content -->
        <section class="content">
            <div class="">
                <div class="row">
                    <div class="col-12">
                        <!-- /.card -->
                        <div class="card">
                           
                            <!-- Add Modal -->
                            <div class="modal fade" id="exampleAddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add Customer Part</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="<%$base_url%>addcustomerpart" id="addcustomerpart" class="custom-form addcustomerpart" method="POST" enctype='multipart/form-data'>
                                                <div class="row" >
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="">Part <span class="text-danger">*</span></label>
                                                            <select name="customer_parts_master_id" class="required-input form-control select2" style="width: 100%;">
                                                                <%if $customer_parts_master%>
                                                                    <%foreach from=$customer_parts_master item=c%>
                                                                        <option value="<%$c->id%>"><%$c->part_number%> / <%$c->part_description%></option>
                                                                    <%/foreach%>
                                                                <%/if%>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="po_num">HSN Code </label>
                                                            <input type="text" name="hsn_code" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 hide">
                                                        <div class="form-group">
                                                            <label> Part Family </label><span class="text-danger">*</span>
                                                            <select readonly class="form-control select2 required-input" name="part_family" style="width: 100%;">
                                                                <option value="NA" selected>NA</option>
                                                                <%if $part_family%>
                                                                    <%foreach from=$part_family item=p%>
                                                                        <option value="<%$p->name%>"><%$p->name%></option>
                                                                    <%/foreach%>
                                                                <%/if%>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label> Tax Structure </label><span class="text-danger">*</span>
                                                            <select class="form-control select2" name="gst_id" style="width: 100%;">
                                                                <%foreach from=$gst_structure item=c%>
                                                                    <option value="<%$c->id%>"><%$c->code%></option>
                                                                <%/foreach%>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label> UOM </label><span class="text-danger">*</span>
                                                            <select  class="form-control select2 required-input" name="uom" style="width: 100%;">
                                                                <%foreach from=$uom item=c%>
                                                                    <option value="<%$c->uom_name%>"><%$c->uom_name%> - <%$c->uom_description%></option>
                                                                <%/foreach%>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="po_num">Packaging QTY </label><span class="text-danger">*</span>
                                                            <input type="text" data-min="0" step="1" name="packaging_qty"  class="form-control required-input onlyNumericInput"  id="packaging_quantity">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="po_num">Safety Stock </label><span class="text-danger">*</span>
                                                            <input type="text" name="safety_stock"  class="onlyNumericInput required-input form-control"  aria-describedby="emailHelp">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label> Customer List </label><span class="text-danger">*</span>
                                                            <select readonly class="form-control select2 required-input" name="customer_id" style="width: 100%;">
                                                                <%foreach from=$customers item=c%>
                                                                    <%if $customer_id == $c->id%>
                                                                        <option <%if $customer_id == $c->id%>selected<%/if%> value="<%$c->id%>"><%$c->customer_name%></option>
                                                                    <%/if%>
                                                                <%/foreach%>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    
                                                        <%if $entitlements.isPlastic%>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="po_num">Gross weight (gram) <span class="text-danger">*</span></label>
                                                                <input type="text"  step="any" name="gross_weight" class="form-control onlyNumericInput required-input" id="exampleInputEmail1" aria-describedby="emailHelp">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="po_num">Finish weight (gram) <span class="text-danger">*</span></label>
                                                                <input type="text"  step="any" name="finish_weight" class="form-control onlyNumericInput required-input" id="exampleInputEmail1" aria-describedby="emailHelp">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="po_num">Runner weight (gram) <span class="text-danger">*</span></label>
                                                                <input type="text"  step="any" name="runner_weight" class="form-control onlyNumericInput required-input" id="exampleInputEmail1" aria-describedby="emailHelp">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="po_num">Cycle Time <span class="text-danger">*</span></label>
                                                                <input type="text"  step="any" name="cycyle_time" class="form-control onlyNumericInput required-input" id="exampleInputEmail1" aria-describedby="emailHelp">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="po_num">Production Target Per Shift <span class="text-danger">*</span></label>
                                                                <input type="text"  step="any" name="production_target_per_shift" class="form-control onlyNumericInput required-input" id="exampleInputEmail1" aria-describedby="emailHelp">
                                                            </div>
                                                        </div>
                                                        <%/if%>
                                                        <%if $entitlements.isSheetMetal%>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="po_num">RM Grade<span class="text-danger">*</span></label>
                                                                <input type="text"  name="rm_grade" class="form-control  required-input" id="exampleInputEmail1" aria-describedby="emailHelp">
                                                            </div>
                                                        </div>
                                                            <%if $TusharEngg%>
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label for="thickness">Thickness<span class="text-danger">*</span></label>
                                                                    <input type="text" step="any"  name="thickness" class="form-control onlyNumericInput required-input" id="thickness" aria-describedby="thicknessHelp">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label for="passivationType">Passivation Type<span class="text-danger">*</span></label>
                                                                    <input type="text"  name="passivationType" class="form-control  required-input" id="passivationType" aria-describedby="passivationTypeHelp">
                                                                </div>
                                                            </div>
                                                            <%/if%>
                                                        <%/if%>
                                                        <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label> Customer Po Type </label><span class="text-danger">*</span>
                                                            <select class="form-control select2 required-input" name="type" style="width: 100%;">
                                                                <option value="">Select Customer Po Type</option>
                                                                <option value="standard_po">Standard PO</option>
                                                                <option value="subcon_po">Subcon Po</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Is Service </label><span class="text-danger">*</span>
                                                            <select class="form-control select2  required-input"  name="isservice" style="width: 100%;">
                                                                <option value="">Select</option>
                                                                <option value="Y">YES</option>
                                                                <option value="N">NO</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <%if ($entitlements['itemCode']!=null && $entitlements['itemCode']==true) %>
                                                     <div class="col-lg-6">
                                                            <div class="form-group">
                                                                    <label for="itemCode">Item Code</label>
                                                                    <input type="text" name="itemCd" class="form-control" id="itemCodeId" aria-describedby="itemCodeHelp">
                                                            </div>
                                                    </div>
                                                        <%/if%>
                                                    <%if $exportSalesInvoive eq 'Yes' && $customer_data[0]->customerType eq 'Expoter'%>
                                                    <div class="col-lg-6">
                                                            <div class="form-group">
                                                                    <label for="itemCode">DRG No</label>
                                                                    <input type="text" name="drg_no" class="form-control"  aria-describedby="itemCodeHelp">
                                                            </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                            <div class="form-group">
                                                                    <label for="itemCode">Rev No</label>
                                                                    <input type="text" name="rev_no" class="form-control"  aria-describedby="itemCodeHelp">
                                                            </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                            <div class="form-group">
                                                                    <label for="itemCode">MOC</label>
                                                                    <input type="text" name="moc" class="form-control"  aria-describedby="itemCodeHelp">
                                                            </div>
                                                    </div>
                                                    <%/if%>
                                                    <div class="col-lg-6">
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
                            <!-- /.card-header -->
                            <div class="">
                            <div class="table-responsive text-nowrap">
                                <table id="example1" class="table table-striped w-100">
                                    <thead>
                                        <tr>
                                            <!-- <th>Sr. No.</th> -->
                                            <!-- <th>Add Production</th> -->
                                            <th style="display: none;">Id</th>
                                            <th>Customer Name</th>
                                            <th>Part Number</th>
                                            <th>Part Description</th>
                                            <th>PO Type</th>
                                            <!-- <th>Part Family</th> -->
                                            <th>Tax Structure</th>
                                            <th>UOM</th>
                                            <th>Packaging QTY</th>
                                            <th>HSN</th>
                                            <th>Safety Stock</th>
                                            <%if $entitlements.isPlastic%>
                                                <th>Gross Weight (gram)</th>
                                                <th>Finish Weight(gram)</th>
                                                <th>Runner Weight(gram)</th>
                                                <th>Cycyle time(sec)</th>
                                                <th>Production target per shift</th>
                                            <%/if%>
                                            <%if $entitlements.isSheetMetal%>
                                                <th>RM Grade</th>
                                                <%if $TusharEngg%>
                                                    <th>Thickness</th>
                                                    <th>Passivation Type</th>
                                                <%/if%>
                                            <%/if%>
                                            <th>Is Service</th>
                                            <%if ($entitlements['itemCode']!=null && $entitlements['itemCode']==true) %>
                                                <th>Item Code</th>
                                            <%/if%>
                                            <th class="text-center">Update</th>
                                            <th class="text-center">Drawing Parameters</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <%assign var="i" value=1%>
                                        <%if $customer_part_list%>
                                            
                                            <%foreach from=$customer_part_list item=poo%>
                                               
                                                <tr>
                                                    <!--<td><%$i%></td> -->
                                                    <%*<td>
                                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPromo">
                                                            Add Production Qty
                                                        </button>
                                                        <div class="modal fade" id="addPromo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Add Production Qty</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <form action="<%$base_url%>add_production_qty" method="POST" enctype="multipart/form-data" class="add_production_qty add_production_qty<%$i%> custom-form" id="add_production_qty<%$i%>">
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                        <div class="col-lg-6">
                                                                        <div class="form-group">
                                                                            <label  for="on click url">Select Shift Type
                                                                                / Name / Start Time /
                                                                                End Time<span class="text-danger">*</span></label>
                                                                            <select name="shift_id" name="" id="" class="form-control select2 required-input" style="width: 100%;">
                                                                                <%if $shifts%>
                                                                                    <%foreach from=$shifts item=s%>
                                                                                        <option value="<%$s->id%>"><%$s->shift_type%> / <%$s->name%> / <%$s->start_time%> / <%$s->end_time%></option>
                                                                                    <%/foreach%>
                                                                                <%/if%>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="form-group">
                                                                            <label for="on click url">Select Operator<span class="text-danger">*</span></label>
                                                                            <select  name="operator_id" id="" class="form-control select2 required-input" style="width: 100%;">
                                                                                <%if $operator%>
                                                                                    <%foreach from=$operator item=s%>
                                                                                        <option value="<%$s->id%>"><%$s->name%></option>
                                                                                    <%/foreach%>
                                                                                <%/if%>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="form-group">
                                                                            <label for="on click url">Select Machine<span class="text-danger">*</span></label>
                                                                            <select  name="machine_id" id="" class="form-control select2 required-input" style="width: 100%;">
                                                                                <%if $machine%>
                                                                                    <%foreach from=$machine item=s%>
                                                                                        <option value="<%$s->id%>"><%$s->name%></option>
                                                                                    <%/foreach%>
                                                                                <%/if%>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="form-group">
                                                                            <label for="on click url">Select Inhouse Part /
                                                                                Customer Part<span class="text-danger">*</span></label>
                                                                            <select  name="output_part_id" id="" class="form-control select2 required-input" style="width: 100%;">
                                                                                <%if $operations_bom%>
                                                                                    <%foreach from=$operations_bom item=s%>
                                                                                    <%pr($s->customer_part_number)%>
                                                                                        <%if $s->customer_part_number == $po[$poo->id][0]->part_number%>
                                                                                            <%if $operations_bom_inputs_data[$s->id]%>
                                                                                                <option value="<%$s->id%>"><%$s->customer_part_number%> / <%$output_part_data[$s->output_part_id][0]->part_number%> / <%$output_part_data[$s->output_part_id][0]->part_description%> / <%$s->customer_part_number%> / <%$s->id%></option>
                                                                                            <%/if%>
                                                                                        <%/if%>
                                                                                    <%/foreach%>
                                                                                <%/if%>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="form-group">
                                                                            <label for="on click url">Enter QTY<span class="text-danger">*</span></label>
                                                                            <input type="text" data-min="1" value="1" name="qty"  class="onlyNumericInput form-control required-input">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="form-group">
                                                                            <label for="on click url">Enter Date
                                                                                <span class="text-danger">*</span></label>
                                                                            <input max="<%$smarty.now|date_format:'%Y-%m-%d'%>" type="date" value="<%$smarty.now|date_format:'%Y-%m-%d'%>" name="date" required class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary">Save
                                                                            changes</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td> *%>
                                                    <td style="display: none"><%$poo->id%></td>
                                                    <td><%$customer_data[0]->customer_name%></td>
                                                    <td><%$po[$poo->id][0]->part_number%></td>
                                                    <td><%$po[$poo->id][0]->part_description%></td>
                                                    <td><%$po[$poo->id][0]->type%></td>
                                                    <!-- <td><%$po[$poo->id][0]->part_family%></td> -->
                                                    <td><%$gst_structure2[$po[$poo->id][0]->gst_id][0]->code%></td>
                                                    <td><%$po[$poo->id][0]->uom%></td>
                                                    <td><%$po[$poo->id][0]->packaging_qty%></td>
                                                    <td><%$po[$poo->id][0]->hsn_code%></td>
                                                    <td><%$po[$poo->id][0]->safety_stock%></td>
                                                    <%if $entitlements.isPlastic%>
                                                        <td><%$po[$poo->id][0]->gross_weight%></td>
                                                        <td><%$po[$poo->id][0]->finish_weight%></td>
                                                        <td><%$po[$poo->id][0]->runner_weight%></td>
                                                        <td><%$po[$poo->id][0]->cycyle_time%></td>
                                                        <td><%$po[$poo->id][0]->production_target_per_shift%></td>
                                                    <%/if%>
                                                    <%if $entitlements.isSheetMetal%>
                                                        <td><%$po[$poo->id][0]->rm_grade%></td>
                                                        <%if $TusharEngg%>
                                                            <td><%$po[$poo->id][0]->thickness%></td>
                                                            <td><%$po[$poo->id][0]->passivationType%></td>
                                                        <%/if%>
                                                    <%/if%>
                                                    <td><%if $po[$poo->id][0]->isservice == 'Y'%>YES<%else%>NO<%/if%></td>
                                                    <%if ($entitlements['itemCode']!=null && $entitlements['itemCode']==true) %>
                                                       <td><%$po[$poo->id][0]->itemCode %></td>
                                                    <%/if%>
                                                    <td class="text-center">
                                                        <a type="button" data-bs-toggle="modal" class="" data-bs-target="#exampleModaledit2333<%$i%>"> <i class="ti ti-edit"></i></a>
                                                        <div class="modal fade" id="exampleModaledit2333<%$i%>" tabindex=" -1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Update Part Details</h5>
                                                                      
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form action="<%$base_url%>updatecustomerpart_new" method="POST" enctype='multipart/form-data' id="updatecustomerpart_new<%$i%>" class="updatecustomerpart_new custom-form updatecustomerpart_new<%$i%>">
                                                                            <div class="row">
                                                                                <div class="col-lg-6">
                                                                                    <input value="<%$po[$poo->id][0]->id%>" type="hidden" name="id" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Customer Name">
                                                                                    <div class="form-group">
                                                                                        <label for="po_num">Part Description<span class="text-danger">*</span></label>
                                                                                        <input type="text" name="upart_description"  class="form-control required-input" id="upart_description" value="<%$po[$poo->id][0]->part_description%>" aria-describedby="partDescriptionHelp">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-6">
                                                                                    <div class="form-group">
                                                                                        <label>Customer Po Type </label><span class="text-danger">*</span>
                                                                                        <select class="form-control select2 required-input" name="type" style="width: 100%;">
                                                                                            <option value="standard_po" <%if $po[$poo->id][0]->type == 'standard_po'%>selected<%/if%>>Standard PO</option>
                                                                                            <option value="subcon_po" <%if $po[$poo->id][0]->type == 'subcon_po'%>selected<%/if%>>Subcon Po</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-6 hide">
                                                                                    <div class="form-group">
                                                                                        <label> Part Family </label><span class="text-danger">*</span>
                                                                                        <select readonly class="form-control select2" name="part_family required-input" style="width: 100%;">
                                                                                            <option value="NA" selected>NA</option>
                                                                                            <%if $part_family%>
                                                                                                <%foreach from=$part_family item=p%>
                                                                                                
                                                                                                    <option value="<%$p->name%>" <%if ($p->name == $po[$poo->id][0]->part_family)%> selected<%/if%>><%$p->name%></option>
                                                                                                <%/foreach%>
                                                                                            <%/if%>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                
                                                                                    <%if $entitlements.isPlastic%>
                                                                                        <div class="col-lg-6">
                                                                                        <div class="form-group">
                                                                                            <label for="po_num">Gross weight (gram) <span class="text-danger">*</span></label>
                                                                                            <input type="text"  step="any" name="gross_weight" class="form-control onlyNumericInput required-input" id="exampleInputEmail1" value="<%$po[$poo->id][0]->gross_weight%>" aria-describedby="emailHelp">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-6">
                                                                                        <div class="form-group">
                                                                                            <label for="po_num">Finish weight (gram) <span class="text-danger">*</span></label>
                                                                                            <input type="text"  step="any" name="finish_weight" class="form-control required-input onlyNumericInput" value="<%$po[$poo->id][0]->finish_weight%>" aria-describedby="emailHelp">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-6">
                                                                                        <div class="form-group">
                                                                                            <label for="po_num">Runner weight (gram) <span class="text-danger">*</span></label>
                                                                                            <input type="text"  step="any" name="runner_weight" class="form-control required-input onlyNumericInput" id="exampleInputEmail1" value="<%$po[$poo->id][0]->runner_weight%>" aria-describedby="emailHelp">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-6">
                                                                                        <div class="form-group">
                                                                                            <label for="po_num">Cycle Time <span class="text-danger">*</span></label>
                                                                                            <input type="text"  step="any" name="cycyle_time" class="form-control required-input onlyNumericInput" id="exampleInputEmail1" value="<%$po[$poo->id][0]->cycyle_time%>" aria-describedby="emailHelp">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-6">
                                                                                        <div class="form-group">
                                                                                            <label for="po_num">Production Target Per Shift <span class="text-danger">*</span></label>
                                                                                            <input type="text" required step="any" name="production_target_per_shift" class="required-input form-control onlyNumericInput" id="exampleInputEmail1" value="<%$po[$poo->id][0]->production_target_per_shift%>" aria-describedby="emailHelp">
                                                                                        </div>
                                                                                    </div>
                                                                                    <%/if%>
                                                                                    <div class="col-lg-6">
                                                                                    <div class="form-group">
                                                                                        <label for="po_num">RM Grade <span class="text-danger">*</span></label>
                                                                                        <input type="text"  name="rm_grade" class="form-control required-input" id="exampleInputEmail1" value="<%$po[$poo->id][0]->rm_grade%>" aria-describedby="emailHelp">
                                                                                    </div>
                                                                                </div>

                                                                                    <%if $TusharEngg%>
                                                                                    <div class="col-lg-6">
                                                                                        <div class="form-group">
                                                                                            <label for="thickness">Thickness<span class="text-danger">*</span></label>
                                                                                            <input type="text" step="any"  name="thickness" class="form-control required-input" id="thickness" value="<%$po[$poo->id][0]->thickness%>" aria-describedby="thicknessHelp">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-6">
                                                                                        <div class="form-group">
                                                                                            <label for="passivationType">Passivation Type<span class="text-danger">*</span></label>
                                                                                            <input type="text"  name="passivationType" class="form-control required-input" id="passivationType" value="<%$po[$poo->id][0]->passivationType%>" aria-describedby="passivationTypeHelp">
                                                                                        </div>
                                                                                    </div>
                                                                                    <%/if%>
                                                                                    <div class="col-lg-6">
                                                                                    <div class="form-group">
                                                                                        <label for="safety_stock">Safety/buffer stock <span class="text-danger">*</span></label>
                                                                                        <input type="text" value="<%$po[$poo->id][0]->safety_stock%>" name="safety_stock"  class="form-control required-input onlyNumericInput" id="exampleInputEmail1" placeholder="Enter Safety/buffer stock">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-6">
                                                                                    <div class="form-group">
                                                                                        <label for="hsn_code">HSN Code<span class="text-danger">*</span></label>
                                                                                        <input type="text" value="<%$po[$poo->id][0]->hsn_code%>" name="hsn_code"  class="form-control required-input" id="exampleInputEmail1" placeholder="Enter HSN Code">
                                                                                        <input type="hidden" value="<%$po[$poo->id][0]->id%>" name="id" required class="form-control" id="exampleInputEmail1">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-6">
                                                                                    <div class="form-group">
                                                                                        <label> Select Tax Structure</label><span class="text-danger">*</span>
                                                                                        <select class="form-control select2 required-input" name="gst_id" style="width: 100%;">
                                                                                            <%foreach from=$gst_structure item=c%>
                                                                                                <option <%if $c->id == $po[$poo->id][0]->gst_id%>selected<%/if%> value="<%$c->id%>"><%$c->code%></option>
                                                                                            <%/foreach%>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-6">
                                                                                    <div class="form-group">
                                                                                        <label> UOM </label><span class="text-danger">*</span>
                                                                                        <select class="form-control select2 required-input" readonly name="uom" style="width: 100%;">
                                                                                            <%foreach from=$uom item=c1%>
                                                                                                <option <%if $c1->uom_name == $po[$poo->id][0]->uom%>selected<%/if%> value="<%$c1->uom_name%>"><%$c1->uom_name%></option>
                                                                                            <%/foreach%>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-6">
                                                                                    <div class="form-group">
                                                                                        <label for="po_num">Packaging QTY </label><span class="text-danger">*</span>
                                                                                        <input type="text" min="0" step="1" name="packaging_qty" value="<%$po[$poo->id][0]->packaging_qty%>"  class="form-control required-input onlyNumericInput" id="packaging_quantity">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-6">
                                                                                    <div class="form-group">
                                                                                        <label> Select Is Service </label><span class="text-danger">*</span>
                                                                                        <select class="form-control select2 required-input "  name="isservice" style="width: 100%;">

                                                                                            <option value="">Select Is-Service</option>
                                                                                            <option value="Y" <%if $po[$poo->id][0]->isservice == 'Y'%>selected<%/if%>>YES</option>
                                                                                            <option value="N" <%if $po[$poo->id][0]->isservice != 'Y' %>selected<%/if%>>NO</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <%if ($entitlements['itemCode']!=null && $entitlements['itemCode']==true) %>
                                                                                 <div class="col-lg-6">
                                                                                            <div class="form-group">
                                                                                                    <label for="itemCode">Item Code</label>
                                                                                                    <input type="text" name="itemCd" value="<%$po[$poo->id][0]->itemCode %>" class="form-control" id="itemCodeId" aria-describedby="itemCodeHelp">
                                                                                            </div>
                                                                                    </div>
                                                                                        <%/if%>
                                                                                    <%if $exportSalesInvoive eq 'Yes' && $customer_data[0]->customerType eq 'Expoter'%>
                                                                                    <div class="col-lg-6">
                                                                                            <div class="form-group">
                                                                                                    <label for="itemCode">DRG No</label>
                                                                                                    <input type="text" name="drg_no" class="form-control"  aria-describedby="itemCodeHelp" value="<%$po[$poo->id][0]->drg_no%>">
                                                                                            </div>
                                                                                    </div>
                                                                                    <div class="col-lg-6">
                                                                                            <div class="form-group">
                                                                                                    <label for="itemCode">Rev No</label>
                                                                                                    <input type="text" name="rev_no" class="form-control"  aria-describedby="itemCodeHelp" value="<%$po[$poo->id][0]->rev_no%>">
                                                                                            </div>
                                                                                    </div>
                                                                                    <div class="col-lg-6">
                                                                                            <div class="form-group">
                                                                                                    <label for="itemCode">MOC</label>
                                                                                                    <input type="text" name="moc" class="form-control"  aria-describedby="itemCodeHelp" value="<%$po[$poo->id][0]->moc%>">
                                                                                            </div>
                                                                                    </div>
                                                                                    
                                                                                    <%/if%>
                                                                               
                                                                            </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                                                    </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                            </div>
                                                      
                                                    </td>
                                                    <td class="text-center">
                                                        <a class="" href="<%$base_url%>view_inspection_parm_details/<%$customer_data[0]->id%>/<%$poo->id%>">
                                                            <i class='ti ti-eye'></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <%assign var="i" value=$i+1%>
                                            <%/foreach%>
                                        <%/if%>
                                    </tbody>
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
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
</div>

<script type="text/javascript">
    var isSheetMetal = <%$entitlements.isSheetMetal|@json_encode%>;
    var isPlastic = <%$entitlements.isPlastic|@json_encode%>;
    var TusharEngg = <%$TusharEngg|@json_encode%>;
</script>

<script src="<%$base_url%>/public/js/planning_and_sales/customer_part.js"></script>
