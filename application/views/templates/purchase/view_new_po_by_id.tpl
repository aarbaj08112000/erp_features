<div style="width:100%" class="wrapper">
   <div class="container-xxl flex-grow-1 container-p-y">
      <!-- Content Header (Page header) -->
      <nav aria-label="breadcrumb">
         <div class="sub-header-left pull-left breadcrumb">
            <h1>
               Purchase
               <a hijacked="yes" href="javascript:void(0)" class="backlisting-link" title="">
               <i class="ti ti-chevrons-right"></i>
               <em>Subcon</em></a>
            </h1>
            <br>
            <span>PO Details</span>
         </div>
      </nav>
      <section class="content">
         <div class="">
            <div class="row">
               <div class="col-12">
                  <div class="card">
                     <div class="card-header">
                        <%if (count($grn_part_arr) == 0 && $status_value != "Expired" && $status_value != "Released") %>
                        <form action="<%base_url('update_po')%>" method="post" id="update_po" class="update_po custom-form">
                           <div class="row">
                              <div class="col-lg-4">
                                 <div class="form-group mb-3">
                                    <label for="" class="form-label">PO Number <span class="text-danger">*</span> </label>
                                    <input type="text" readonly value="<%$new_po[0]->po_number %>" class="form-control">
                                 </div>
                              </div>
                              <div class="col-lg-4">
                                 <div class="form-group mb-3">
                                    <label for="" class="form-label">PO Date <span class="text-danger">*</span> </label>
                                    <input type="text" readonly value="<%$new_po[0]->po_date %>" class="form-control">
                                 </div>
                              </div>
                              <div class="col-lg-4">
                                 <div class="form-group mb-3">
                                    <label for="" class="form-label">PO Expiry Date <span class="text-danger">*</span> </label>
                                    <input type="text" readonly value="<%$new_po[0]->expiry_po_date %>" class="form-control">
                                 </div>
                              </div>
                              <div class="col-lg-4">
                                 <div class="form-group mb-3">
                                    <label for="" class="form-label">PO Remark <span class="text-danger">*</span> </label>
                                    <input type="text" readonly value="<%$new_po[0]->remark %>" class="form-control">
                                 </div>
                              </div>
                              <div class="col-lg-4">
                                 <div class="form-group mb-3">
                                    <label for="" class="form-label">Current Status <span class="text-danger">*</span> </label>
                                    <input type="text" readonly value="<%$status_value%>" class="form-control">
                                 </div>
                              </div>
                              <div class="col-lg-4">
                                 <div class="form-group mb-3">
                                    <label for="" class="form-label">Supplier Name <span class="text-danger">*</span> </label>
                                    <input type="text" readonly value="<%$supplier[0]->supplier_name %>" class="form-control">
                                 </div>
                              </div>
                              <div class="col-lg-4">
                                 <div class="form-group mb-3">
                                    <label for="" class="form-label">Supplier Number <span class="text-danger">*</span> </label>
                                    <input type="text" readonly value="<%$supplier[0]->supplier_number %>" class="form-control">
                                 </div>
                              </div>
                              <div class="col-lg-4">
                                 <div class="form-group mb-3">
                                    <label for="" class="form-label">Supplier GST <span class="text-danger">*</span> </label>
                                    <input type="text" readonly value="<%$supplier[0]->gst_number %>" class="form-control">
                                 </div>
                              </div>
                              <%if ($new_po[0]->po_discount_type == "PO Level") %>
                              <div class="col-lg-4">
                                 <div class="form-group mb-3">
                                    <label for="" class="form-label">Discount Type<span class="text-danger">*</span> </label>
                                    <input type="text" readonly value="<%$new_po[0]->discount_type %>" class="form-control">
                                 </div>
                              </div>
                              <div class="col-lg-4">
                                 <div class="form-group mb-3">
                                    <label for="" class="form-label">Discount <span class="text-danger">*</span> </label>
                                    <input type="text"  value="<%$new_po[0]->discount %>" class="form-control required-input onlyNumericInput"  <%if (count($grn_part_arr) > 0) %>readonly<%/if%> name="discount_value" >
                                 </div>
                              </div>
                              <%/if%>
                              <%if (!$isSubPO) %>
                                  <div class="col-lg-4">
                                     <div class="form-group mb-3">
                                        <label for="" class="form-label">Loading Unloading Amount <span class="text-danger">*</span> </label>
                                        <input type="text"  value="<%$new_po[0]->loading_unloading %>" step="any" placeholder="Enter Loading Unloading" value="" name="loading_unloading" class="form-control onlyNumericInput required-input" <%if (count($grn_part_arr) > 0) %>readonly<%/if%>>
                                     </div>
                                  </div>
                                  <div class="col-lg-4">
                                     <div class="form-group mb-3">
                                        <label for="" class="form-label">Supplier GST <span class="text-danger">*</span> </label>
                                        <input type="text" readonly value="<%$supplier[0]->gst_number %>" class="form-control">
                                     </div>
                                  </div>
                                  <div class="col-lg-4">
                                     <div class="form-group mb-3">
                                        <label for="" class="form-label">Loading Unloading Tax Strucutre <span class="text-danger">*</span> </label>
                                        <select name="loading_unloading_gst"  id="" class="form-control select2 required-input" <%if (count($grn_part_arr) > 0) %>readonly<%/if%>>
                                           <option value="0">NA</option>
                                           <%if ($gst_structure) %>
                                                <%foreach from=$gst_structure item=s %>
                                                   <option value="<%$s->id %>" <%if ($s->id == $new_po[0]->loading_unloading_gst) %>selected<%/if%>><%$s->code %>
                                                   </option>
                                                <%/foreach  %>
                                           <%/if%>
                                        </select>
                                     </div>
                                  </div>
                                  <div class="col-lg-4">
                                     <div class="form-group mb-3">
                                        <label for="" class="form-label">Freight Amount <span class="text-danger">*</span> </label>
                                        <input type="text"  value="<%$new_po[0]->freight_amount %>" class="form-control onlyNumericInput required-input" name="freight_amount" <%if (count($grn_part_arr) > 0) %>readonly<%/if%>>
                                        <input type="hidden" required value="<%$new_po[0]->id %>" class="form-control" name="po_id">
                                     </div>
                                  </div>
                                  <div class="col-lg-4">
                                     <div class="form-group mb-3">
                                        <label for="" class="form-label">Freight Tax Strucutre <span class="text-danger">*</span> </label>
                                        <select name="freight_amount_gst"  id="" class="form-control select2 required-input " <%if (count($grn_part_arr) > 0) %>readonly<%/if%>>
                                           <option value="0">NA</option>
                                           <%if ($gst_structure) %>
                                                <%foreach from=$gst_structure item=s %>
                                                 <option value="<%$s->id %>" <%if ($s->id == $new_po[0]->freight_amount_gst)%>selected<%/if%>><%$s->code %>
                                                 </option>
                                                 <%/foreach%>
                                           <%/if%>
                                        </select>
                                     </div>
                                  </div>
                              <%/if%>
                           </div>
                           <div class="col-lg-12">
                              <button type="submit" class="btn btn-info btn mt-4">Update</button>
                           </div>
                          
                        </form>
                        <%else%>
                           <div class="row">
                              <div class="tgdp-rgt-tp-sect">
                                 <p class="tgdp-rgt-tp-ttl">PO Number</p>
                                 <p class="tgdp-rgt-tp-txt">
                                     <%$new_po[0]->po_number %>
                                 </p>
                             </div>
                             <div class="tgdp-rgt-tp-sect">
                                 <p class="tgdp-rgt-tp-ttl">PO Date</p>
                                 <p class="tgdp-rgt-tp-txt">
                                     <%$new_po[0]->po_date %>
                                 </p>
                             </div>
                             <div class="tgdp-rgt-tp-sect">
                                 <p class="tgdp-rgt-tp-ttl">PO Expiry Date</p>
                                 <p class="tgdp-rgt-tp-txt">
                                     <%$new_po[0]->expiry_po_date %>
                                 </p>
                             </div>
                             <div class="tgdp-rgt-tp-sect">
                                 <p class="tgdp-rgt-tp-ttl">PO Remark</p>
                                 <p class="tgdp-rgt-tp-txt">
                                     <%$new_po[0]->remark %>
                                 </p>
                             </div>
                             <div class="tgdp-rgt-tp-sect">
                                 <p class="tgdp-rgt-tp-ttl">Current Status</p>
                                 <p class="tgdp-rgt-tp-txt">
                                     <%$status_value%>
                                 </p>
                             </div>
                             <div class="tgdp-rgt-tp-sect">
                                 <p class="tgdp-rgt-tp-ttl">Supplier Name</p>
                                 <p class="tgdp-rgt-tp-txt">
                                     <%$supplier[0]->supplier_name %>
                                 </p>
                             </div>
                             <div class="tgdp-rgt-tp-sect">
                                 <p class="tgdp-rgt-tp-ttl">Supplier Number</p>
                                 <p class="tgdp-rgt-tp-txt">
                                    <%$supplier[0]->supplier_number %>
                                 </p>
                             </div>
                             <div class="tgdp-rgt-tp-sect">
                                 <p class="tgdp-rgt-tp-ttl">Supplier GST</p>
                                 <p class="tgdp-rgt-tp-txt">
                                    <%$supplier[0]->gst_number %>
                                 </p>
                             </div>
                             <%if ($new_po[0]->po_discount_type == "PO Level") %>
                             <div class="tgdp-rgt-tp-sect">
                                 <p class="tgdp-rgt-tp-ttl">Discount Type</p>
                                 <p class="tgdp-rgt-tp-txt">
                                    <%$new_po[0]->discount_type %>
                                 </p>
                             </div>
                             <div class="tgdp-rgt-tp-sect">
                                 <p class="tgdp-rgt-tp-ttl">Discount</p>
                                 <p class="tgdp-rgt-tp-txt">
                                    <%$new_po[0]->discount %>
                                 </p>
                             </div>
                             <%/if%>
                             <%if (!$isSubPO) %>
                              <div class="tgdp-rgt-tp-sect">
                                 <p class="tgdp-rgt-tp-ttl">Loading Unloading Amount</p>
                                 <p class="tgdp-rgt-tp-txt">
                                    <%$new_po[0]->loading_unloading %>
                                 </p>
                             </div>
                             <div class="tgdp-rgt-tp-sect">
                                 <p class="tgdp-rgt-tp-ttl">Loading Unloading Tax Strucutre</p>
                                 <p class="tgdp-rgt-tp-txt">
                                    <%if ($gst_structure) %>
                                       <%assign var='code_val' value=display_no_character()%>
                                       <%foreach from=$gst_structure item=s %>
                                          <%if ($s->id == $new_po[0]->loading_unloading_gst) %>
                                             <%assign var='code_val' value=$s->code%>
                                          <%/if%>
                                       <%/foreach  %>
                                       <%$code_val%>
                                    <%/if%>
                                 </p>
                             </div>
                             <div class="tgdp-rgt-tp-sect">
                                 <p class="tgdp-rgt-tp-ttl">Freight Amount</p>
                                 <p class="tgdp-rgt-tp-txt">
                                    <%$new_po[0]->freight_amount %>
                                 </p>
                             </div>
                             <div class="tgdp-rgt-tp-sect">
                                 <p class="tgdp-rgt-tp-ttl">Freight Tax Strucutre</p>
                                 <p class="tgdp-rgt-tp-txt">
                                    <%if ($gst_structure) %>
                                       <%assign var='code_val' value=display_no_character()%>
                                       <%foreach from=$gst_structure item=s %>
                                          <%if ($s->id == $new_po[0]->freight_amount_gst)%>
                                             <%assign var='code_val' value=$s->code%>
                                          <%/if%>
                                       <%/foreach%>
                                       <%$code_val%>
                                    <%/if%>
                                 </p>
                             </div>
                              <%/if%>
                           </div>
                           

                        <%/if%>
                     </div>
                  </div>
                  <div class="card mt-4">
                     <%if ($new_po[0]->status == "pending") %>
                     <div class="card-header">
                        <%if ($expired == "yes") %>
                               <form action="<%base_url('add_po_parts')%>" method="post" id="add_po_parts" class="add_po_parts custom-form">
                              <div class="row">
                                 <div class="col-lg-6">
                                    <div class="form-group">
                                      
                                          <label for="">Select Part Number // Description // Supplier // Rate //
                                          Tax Structure // Max Qty<span class="text-danger">*</span> </label>
                                          <select name="part_id" id=""  class="form-control select2">
                                             <%if ($child_part) %>
                                                  <%$po_parts_opt%>
                                             <%/if%>
                                          </select>
                                    </div>
                                 </div>
                                 <%if ($new_po[0]->po_discount_type == "Part Level") %>
                                       <div class="col-lg-2">
                                       <div class="form-group">
                                       <label for="">Discount(%) <span class="text-danger">*</span> </label>
                                       <input type="text"  value="" data-min="0" data-max="100" class="form-control onlyNumericInput required-input"  name="discount_value" >
                                       </div>
                                       </div>
                                 <%/if%>
                                 <%if ($type != "normal") %>
                                       <div class="col-lg-2">
                                       <div class="form-group">
                                       <label for="">Select Process <span class="text-danger">*</span> </label>
                                       <select name="process" id="" class="form-control select2 required-input">
                                       <%if ($process) %>
                                          <%foreach from=$process item=s %>
                                             <option value="<%$s->name %>"><%$s->name %></option>
                                          <%/foreach%>
                                       <%/if%>
                                       </select>
                                       </div>
                                       </div>
                                 <%/if%>
                                 <div class="col-lg-2">
                                 <div class="form-group">
                                 <label for="">Enter Qty <span class="text-danger">*</span> </label>
                                 <input type="text" step="any" name="qty" placeholder="Enter QTY " data-min="1" class="form-control onlyNumericInput required-input">
                                 <input type="hidden" name="po_number" value="<%$new_po[0]->po_number %>" required class="form-control">
                                 <input type="hidden" name="po_id" value="<%$new_po[0]->id %>" required class="form-control">
                                 <input type="hidden" name="supplier_id" value="<%$supplier[0]->id %>" placeholder=" " required class="form-control">
                                 <input type="hidden" name="type" value="<%$type %>" placeholder="" required class="form-control">
                                 </div>
                                 </div>
                                 <input type="hidden" name="po_discount_type"  required class="form-control" value="<%$new_po[0]->po_discount_type%>">
                                 <div class="col-lg-2">
                                 <div class="form-group">
                                 <button type="submit" class="btn btn-info btn mt-4">Add Child Part</button>
                                 </div>
                                 </div>
                                 </form>
                              </div>
                        <%/if%>
                     </div>
                     <%/if%>
                     <div class="card-header">
                        <%if ($po_parts) %>
                           <%if ($new_po[0]->status == "accept" && $status_value != "Expired") %>
                                 <button type="button" class="btn btn-danger ml-1" data-bs-toggle="modal" data-bs-target="#lock">
                                 UnLock PO
                                 </button>
                           <%/if%>
                        <%/if%>
                        <%if ($new_po[0]->status == "pending" && $status_value != "Expired") %>
                           <%if ($user_type == 'admin' || $user_type == 'Admin') %>
                                 <button type="button" class="btn btn-success ml-1" data-bs-toggle="modal" data-bs-target="#accept">
                                 Approve & Release PO
                                 </button>
                           <%/if%>
                        <%else %>
                           <%if ($new_po[0]->status != "pending" ) %>
                              <a href="<%base_url('download_my_pdf/') %><%$new_po[0]->id %>" class="btn btn-primary" href="">Download</a>
                           <%/if%>
                        <%/if%>
                        <!-- Modal -->
                        <div class="modal fade" id="accept" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                           <div class="modal-dialog modal-dialog-centered">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Update</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    </button>
                                 </div>
                                 <div class="modal-body">
                                    <div class="row">
                                       <form action="<%base_url('accept_po') %>" method="POST" class="accept_po" id="accept_po">
                                          <div class="col-lg-12">
                                             <div class="form-group">
                                                <label for=""><b>Are You Sure Want To Released This
                                                PO?</b> </label>
                                                <input type="hidden" name="id" value="<%$new_po[0]->id %>" required class="form-control">
                                                <input type="hidden" name="status" value="accept" required class="form-control">
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
                                    </button>
                                 </div>
                                 <div class="modal-body">
                                    <div class="row">
                                       <form action="<%base_url('unlock_po') %>" method="POST" id="unlock_po" class="unlock_po">
                                          <div class="col-lg-12">
                                             <div class="form-group">
                                                <label for=""><b>Are You Sure Want To Unlock This PO?</b>
                                                </label>
                                                <input type="hidden" name="id" value="<%$new_po[0]->id %>" required class="form-control">
                                                <input type="hidden" name="status" value="pending" required class="form-control">
                                             </div>
                                          </div>
                                    </div>
                                 </div>
                                 <div class="modal-footer">
                                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                 <button type="submit" class="btn btn-primary">Update</button>
                                 </div>
                              </div>
                              </form>
                           </div>
                        </div>
                        <div class="modal fade" id="delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                           <div class="modal-dialog">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                 </div>
                                 <div class="modal-body">
                                    <div class="row">
                                       <form action="<%base_url('delete_po') %>" method="POST">
                                          <div class="col-lg-12">
                                             <div class="form-group">
                                                <label for=""><b>Are You Sure Want To Delete This
                                                PO?</b> </label>
                                                <input type="hidden" name="id" value="<%$new_po[0]->id %>" required class="form-control">
                                                <input type="hidden" name="status" value="reject" required class="form-control">
                                                <input type="hidden" name="table_name" value="new_po" required class="form-control">
                                             </div>
                                          </div>
                                    </div>
                                 </div>
                                 <div class="modal-footer">
                                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                 <button type="submit" class="btn btn-primary">Update</button>
                                 </div>
                              </div>
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="card mt-4">
                     <div class="">
                     <div class="tabTitle">
                           <h2 id="cc_sh_sys_static_field_3">
                              <span>Parts</span>

                           </h2>
                           <input type="text" name="reason" placeholder="Filter Search" class="form-control parts-global-seacrh" id="serarch-filter-input" fdprocessedid="bxkoib">
                           
                           
                        </div>
                        <table class="table  table-striped w-100" id="example1">
                           <thead>
                              <tr>
                                 <!-- <th>Sr No</th> -->
                                 <th width="10%">Part Number</th>
                                 <th>Part Description</th>
                                 <th>Tax Code</th>
                                 <th>UOM</th>
                                 <th>QTY</th>
                                 <%if ($new_po[0]->po_discount_type == "Part Level") %>
                                 <th>Discount(%)</th>
                                 <%/if%>
                                 <%if ($type != "normal") %>
                                 <th>Process</th>
                                 <%/if%>
                                 <th>Price</th>
                                 <%if ($new_po[0]->po_discount_type == "Part Level") %>
                                   <th width="8%">Price After Discount</th>
                                 <%/if%>
                                 <!-- <th>Created Date</th> -->
                                 <th width="15%">Actions</th>
                                 <th>Sub Total</th>
                                 <th>GST</th>
                                 <th width="8%">Total Price</th>
                              </tr>
                           </thead>
                           <tbody>
                              <%if ($po_parts) %>
                              <%assign var='final_po_amount' value=0%>
                                 <%assign var=i value=1%>
                                 <%foreach from=$po_parts item=p %>
                                    <%assign var='child_part_data' value=$p->child_part_data%>
                                    <%assign var='uom_data' value=$p->uom_data%>
                                    <%assign var='total_rate_old' value=$p->total_rate_old%>
                                    <%assign var='gst_structure' value=$p->gst_structure%>
                                    <%assign var='cgst_amount' value=$p->cgst_amount%>
                                    <%assign var='sgst_amount' value=$p->sgst_amount%>
                                    <%assign var='igst_amount' value=$p->igst_amount%>
                                    <%assign var='gst_amount' value=$p->gst_amount%>
                                    <%assign var='total_rate' value=$p->total_rate%>
                                    <%assign var='part_rate_new' value=$p->part_rate_new%>
                                    <%if ($new_po[0]->po_discount_type == "Part Level") %>
                                       <%assign var='part_rate_discount_amount' value=($part_rate_new*$p->discount)/100%>
                                       <%assign var='after_dicount_part_rate' value=$part_rate_new-$part_rate_discount_amount%>
                                       <%assign var='total_rate_old' value=$after_dicount_part_rate*$p->qty%>
                                       <%assign var='total_rate' value=($after_dicount_part_rate*$p->qty)+$gst_amount%>
                                    <%/if%>
                                    <%assign var='final_po_amount' value=$final_po_amount+$total_rate%>
                                 
                                       <tr>
                                          <!-- <td><%$i%></td> -->
                                          <td width="10%"><%$child_part_data[0]->part_number%></td>
                                          <td><%$child_part_data[0]->part_description%></td>
                                          <td><%$gst_structure[0]->code %></td>
                                          <td><%$uom_data[0]->uom_name %></td>
                                          <td><%$p->qty %></td>
                                          <%if ($new_po[0]->po_discount_type == "Part Level")%>
                                          <td> <%$p->discount%> </td>
                                          <%/if%>
                                          <%if ($type != "normal") %>
                                          <td><%$p->process %></td>
                                          <%/if%>
                                          <td><%$part_rate_new%></td>
                                          <%if ($new_po[0]->po_discount_type == "Part Level") %>
                                             <td><%$after_dicount_part_rate%></td>
                                           <%/if%>
                                          <!-- <td><?php echo $p->created_date; ?></td> -->
                                          <td>
                                             <%if ($new_po[0]->status == "pending") %>
                                             <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal<%$i %>">
                                                Edit
                                                </button>
                                                <%if ($new_po[0]->is_unlock != "Yes") %>
                                                <button type="button" class="btn btn-danger ml-1" data-bs-toggle="modal" data-bs-target="#exampleModaldelete<%$i%>">
                                                Delete
                                                </button>
                                                <%else if (!in_array($p->id, $grn_part_arr)) %>
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ammendQty<%$i%>">
                                                Amend Price/tax
                                                </button>
                                                <div class="modal fade" id="ammendQty<%$i %>" tabindex="-1" aria-labelledby="" aria-hidden="true">
                                                   <div class="modal-dialog modal-dialog-centered">
                                                      <div class="modal-content">
                                                         <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Update
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                            </button>
                                                         </div>
                                                         <div class="modal-body">
                                                            <div class="row">
                                                               <form action="<%base_url('AmendQty') %>" method="POST" id="AmendQty<%$i%>" class="AmendQty<%$i%> AmendQty">
                                                                  <div class="col-lg-12">
                                                                     <div class="form-group">
                                                                        <label for=""> <b>Are You Sure Want To
                                                                        Amend Price/tax for This part? </b> </label>
                                                                        <input type="hidden" name="id" value="<%$p->id %>" required class="form-control">
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
                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal<%$i%>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                   <div class="modal-dialog modal-dialog-centered">
                                                      <div class="modal-content">
                                                         <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Update
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                            </button>
                                                         </div>
                                                         <div class="modal-body">
                                                            <div class="row" style="    display: block;">
                                                               <form action="<%base_url('update_po_parts') %>" method="POST" id="update_po_parts<%$i%>" class="update_po_parts<%$i%> update_po_parts custom-form ">
                                                                  <div class="col-lg-12">
                                                                     <div class="form-group">
                                                                        <label for="">Enter Qty <span class="text-danger">*</span>
                                                                        </label>
                                                                        <input type="text" name="qty" value="<%$p->qty %>" placeholder="Enter QTY "  class="form-control onlyNumericInput required-input">
                                                                        <input type="hidden" name="part_number" value="<%$child_part_data[0]->part_number%>" placeholder="Enter part_number " required class="form-control">
                                                                        <input type="hidden" name="id" value="<%$p->id %>" required class="form-control">
                                                                     </div>
                                                                  </div>
                                                                  <%if ($new_po[0]->po_discount_type == "Part Level") %>
                                                                  <div class="col-lg-12">
                                                                     <div class="form-group">
                                                                        <label for="">Discount(%) <span class="text-danger">*</span> </label>
                                                                        <input type="text"  value="<%$p->discount %>" data-min="0" data-max="100" class="form-control onlyNumericInput required-input"  name="discount_value" >
                                                                     </div>
                                                                  </div>
                                                                  <%/if%>
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
                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModaldelete<%$i%>" tabindex="-1" aria-labelledby="" aria-hidden="true">
                                                   <div class="modal-dialog modal-dialog-centered">
                                                      <div class="modal-content">
                                                         <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Update
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                            </button>
                                                         </div>
                                                         <div class="modal-body">
                                                            <div class="row">
                                                               <form action="<%base_url('delete') %>" method="POST" id="delete<%$i%>" class="delete delete<%$i%>">
                                                                  <div class="col-lg-12">
                                                                     <div class="form-group">
                                                                        <label for=""> <b>Are You Sure Want To
                                                                        Delete This ? </b> </label>
                                                                        <input type="hidden" name="id" value="<%$p->id %>" required class="form-control">
                                                                        <input type="hidden" name="table_name" value="po_parts" required class="form-control">
                                                                     </div>
                                                                  </div>
                                                            </div>
                                                         </div>
                                                         <div class="modal-footer">
                                                         <button type="button" class="btn btn-secondary" data,bs-dismiss="modal">Close</button>
                                                         <button type="submit" class="btn btn-primary">Update</button>
                                                         </div>
                                                      </div>
                                                      </form>
                                                   </div>
                                                </div>
                                             <%else %>
                                                      <%if ($user_type == 'admin' || $user_type == 'Admin') %>
                                                         <%if ($statusNew) %>
                                                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal123123123<%$i%>">
                                                                        Amend QTY
                                                                        </button>
                                                                        <div class="modal fade" id="exampleModal123123123<%$i%>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                           <div class="modal-dialog modal-dialog-centered">
                                                                              <div class="modal-content">
                                                                                 <div class="modal-header">
                                                                                    <h5 class="modal-title" id="exampleModalLabel">PO
                                                                                       Amendment
                                                                                    </h5>
                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                                    </button>
                                                                                 </div>
                                                                                 <div class="modal-body">
                                                                                    <div class="row">
                                                                                       <div class="col-lg-12">
                                                                                          <div class="form-group">
                                                                                             <form action="<%base_url('update_po_parts_amendment') %>" method="POST" id="update_po_parts_amendment<%$i%>" class="update_po_parts_amendment<%$i%> update_po_parts_amendment custom-form">
                                                                                                <label for="">Enter Qty <span class="text-danger">*</span>
                                                                                                </label>
                                                                                                <input type="text" name="qty" value="<%$p->new_po_qty %>" placeholder="Enter QTY "  class="form-control onlyNumericInput required-input" data-min="1">
                                                                                                <input type="hidden" name="id" value="<%$p->id %>" required class="form-control">
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
                                                                     <%if ($p->po_approved_updated == "pending") %>
                                                                           <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModalapproved<%$i %>">
                                                                           Approve Amendment
                                                                           </button>
                                                                           <div class="modal fade" id="exampleModalapproved<%$i %>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                              <div class="modal-dialog modal-dialog-centered">
                                                                                 <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                       <h5 class="modal-title" id="exampleModalLabel">PO
                                                                                          Amendment Approval 
                                                                                       </h5>
                                                                                       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                                       </button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <form action="<%base_url('update_po_parts_amendment_approve')%>" method="POST" id="update_po_parts_amendment_approve<%$i %>" class="update_po_parts_amendment_approve update_po_parts_amendment_approve<%$i %> custom-form">
                                                                                       <div class="row">
                                                                                          <div class="col-lg-12">
                                                                                             <div class="form-group">
                                                                                               
                                                                                                   <label for="">Are You Sure Want To
                                                                                                   Approve this Amendment ? <span class="text-danger">*</span>
                                                                                                   </label>
                                                                                                   <input type="text" name="qty" value="<%$p->new_po_qty %>" placeholder="Enter QTY " data-min='1'  class="form-control required-input onlyNumericInput">
                                                                                                   <input type="hidden" name="id" value="<%$p->id %>" required class="form-control">
                                                                                                   <input type="hidden" name="new_po_id" value="<%$new_po[0]->id%>" required class="form-control">
                                                                                             </div>
                                                                                             <div class="form-group">
                                                                                             <label for="">Enter PO Amendment Number
                                                                                             <span class="text-danger">*</span>
                                                                                             </label>
                                                                                             <input type="text" name="po_a_number" placeholder="Enter Po Amendment Number "  class="form-control required-input" >
                                                                                             </div>
                                                                                             <div class="form-group">
                                                                                             <label for="">Privious Qty <span class="text-danger">*</span>
                                                                                             </label>
                                                                                             <input type="text" name="qty" readonly value="<%$p->qty %>" placeholder="Enter QTY "  class="form-control  required-input onlyNumericInput">
                                                                                             </div>
                                                                                             <div class="form-group">
                                                                                             <label for="">New Qty <span class="text-danger">*</span>
                                                                                             </label>
                                                                                             <input type="text" name="new_qty" readonly value="<%$p->new_po_qty %>" placeholder="Enter QTY "  class="form-control required-input">
                                                                                             <input type="hidden" name="id" value="<%$p->id %>" required class="form-control">
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
                                                                     <%if ($p->po_a_number != "") %>
                                                                        <br>
                                                                        Amendment No :<%$p->po_a_number%>
                                                                        <br>
                                                                        Amendment Date :<%$p->date%>
                                                                     <%/if%>
                                                         <%/if%>
                                                      <%/if%>
                                             <%/if%>
                                          </td>
                                          <td><%$total_rate_old%></td>
                                          <td><%$gst_amount%></td>
                                          <td width="8%"><%$total_rate%></td>
                                       </tr>
                                      <%assign var=i value=$i+1%>
                                 <%/foreach%>
                              <%/if%>
                           </tbody>
                           <tfoot>
                              <%if ($po_parts) %>
                              <tr>
                                <%if ($new_po[0]->po_discount_type == "Part Level") %>
                                 <th colspan="10" class="text-right">Total</th>
                                <%else%>
                                  <th colspan="9" class="text-right">Total</th>
                                <%/if%>
                                 <th class="text-left" width="8%"><%$final_po_amount%></th>
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
   <!-- /.container-fluid -->
   </section>
   <!-- /.content -->
</div>
<!-- /.content-wrapper -->

    <script type="text/javascript">
    var base_url = <%$base_url|@json_encode%>
    </script>

    <script src="<%$base_url%>public/js/purchase/view_new_po_by_id.js"></script>