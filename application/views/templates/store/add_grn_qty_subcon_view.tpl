<div class="content-wrapper">
   <!-- Content Wrapper. Contains page content -->
   <div class="container-xxl flex-grow-1 container-p-y">
      <!-- Content Header (Page header) --><!-- Main content -->
      <nav aria-label="breadcrumb">
         <div class="sub-header-left pull-left breadcrumb">
            <h1>
               Store
               <a hijacked="yes" href="javascript:void(0)" class="backlisting-link" title="">
               <i class="ti ti-chevrons-right"></i>
               <em>Part GRN</em></a>
            </h1>
            <br>
            <span>Subcon View</span>
         </div>
      </nav>
      <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5">
         <a class="btn btn-seconday" href="<%base_url('inwarding_details/')%><%$inwarding_id%>/<%$new_po_id%>" title="Back To Inwarding PO Invoice Details">
         <i class="ti ti-arrow-left"></i> </a>
      </div>
      <section class="content">
         <div class="">
                  <div class="card">
                     <div class="card-header">
                        <div class="row">
                            <div class="tgdp-rgt-tp-sect">
                                 <p class="tgdp-rgt-tp-ttl">PO Number</p>
                                 <p class="tgdp-rgt-tp-txt"><%$new_po[0]->po_number %></p>
                            </div>
                            <div class="tgdp-rgt-tp-sect">
                                 <p class="tgdp-rgt-tp-ttl">PO Date</p>
                                 <p class="tgdp-rgt-tp-txt"><%$new_po[0]->po_date %></p>
                            </div>
                            <div class="tgdp-rgt-tp-sect">
                                 <p class="tgdp-rgt-tp-ttl">Status</p>
                                 <p class="tgdp-rgt-tp-txt">
                                    <%if ($new_po[0]->status == "accpet") %>
                                        Released 
                                    <%else %>
                                        <%$new_po[0]->status %>
                                    <%/if%>
                                 </p>
                            </div>
                            <div class="tgdp-rgt-tp-sect">
                                 <p class="tgdp-rgt-tp-ttl">Supplier Name</p>
                                 <p class="tgdp-rgt-tp-txt"><%$supplier[0]->supplier_name %></p>
                            </div>
                            <div class="tgdp-rgt-tp-sect">
                                 <p class="tgdp-rgt-tp-ttl">Supplier GST</p>
                                 <p class="tgdp-rgt-tp-txt"><%$supplier[0]->gst_number %></p>
                            </div>
                            <div class="tgdp-rgt-tp-sect">
                                 <p class="tgdp-rgt-tp-ttl">Software Calculated Amount</p>
                                 <p class="tgdp-rgt-tp-txt"><%$actual_price %></p>
                            </div>
                            <div class="tgdp-rgt-tp-sect">
                                 <p class="tgdp-rgt-tp-ttl">Invoice Amount Validation Status </p>
                                 <p class="tgdp-rgt-tp-txt"><%$status %></p>
                            </div>
                           <div class="col-lg-2">
                              <div class="form-group">
                                 <%if ($inwarding_data[0]->status == "accepted") %>
                                 <button class='btn btn-primary mt-4' disabled>Inwarding Already Accepted</button>
                                 <%else if ($status == "verifed") %>
                                 <%if ($inwarding_data[0]->status == "pending" || $inwarding_data[0]->status == "") %>
                                 <%else if ($inwarding_data[0]->status == "generate_grn") %>
                                 <%/if%>
                                 <%/if%>
                                 <!-- Modal -->
                                 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg " role="document">
                                       <div class="modal-content">
                                          <div class="modal-header">
                                             <h5 class="modal-title" id="exampleModalLabel">Add Billing Data </h5>
                                             <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                          </div>
                                          <div class="modal-body">
                                             <%if ($challan) %>
                                             <form action="<%base_url('accept_inwarding_data') %>" method="POST">
                                                <%else %>
                                             <form action="<%base_url('accept_inwarding_data') %>" method="POST">
                                                <%/if%> 
                                                <div class="row">
                                                   <div class="col-lg-12">
                                                      <div class="form-group"> <label> Are You Sure Want To Accept This Inwarding ? This Data can't be changed once it's Submit</label><span class="text-danger">*</span> <input type="hidden" name="inwarding_id" value="<%$inwarding_id%>" class="form-control"> <input type="hidden" name="invoice_number" value="<%$invoice_number%>" class="form-control"> </div>
                                                   </div>
                                                </div>
                                                <div class="modal-footer"> <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> <button type="submit" class="btn btn-primary">Save changes</button> </div>
                                             </form>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="modal fade" id="exampleModalgenerate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog " role="document">
                                       <div class="modal-content">
                                          <div class="modal-header">
                                             <h5 class="modal-title" id="exampleModalLabel">Change Status </h5>
                                             <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                          </div>
                                          <div class="modal-body">
                                             <form action="<%base_url('update_status_grn_inwarding') %>" method="POST">
                                                <div class="row">
                                                   <div class="col-lg-12">
                                                      <div class="form-group"> <label> Are You Sure Want To Generate GRN ? </label> <input type="hidden" name="status" placeholder="" value="generate_grn" class="form-control"> <input type="hidden" name="inwarding_id" value="<%$inwarding_id%>" class="form-control"> </div>
                                                   </div>
                                                </div>
                                                <div class="modal-footer"> <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> <button type="submit" class="btn btn-primary">Save changes</button> </div>
                                             </form>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="card mt-4">


                     <div class="">
                        <table class="table  scrollable table-striped" id="example1">
                           <thead>
                              <tr>
                                 <th>Part Number</th>
                                 <th>Part Description</th>
                                 <th>UOM</th>
                                 <th>PO QTY</th>
                                 <th>Balance QTY</th>
                              </tr>
                           </thead>
                           <tbody>
                              <%assign var="inwardCompleted" value=false%>
                              <%if ($po_parts) %>
                              <%assign var="i" value=1%>
                              <%foreach from=$po_parts item=p %> 
                              <tr>
                                 <td><%$p->child_part_data[0]->part_number%></td>
                                 <td><%$p->child_part_data[0]->part_description%></td>
                                 <td><%$p->uom_data[0]->uom_name%></td>
                                 <td><%$p->qty%></td>
                                 <td><%$p->pending_qty%></td>
                              </tr>
                              <tr>
                                 <table class="table  table-striped scrollable" id="example1">
                                    <thead>
                                    <tr>
                                       <th>Name / Description</th>
                                       <th>Inwarding Qty</th>
                                       <th>Required Qty</th>
                                       <th>Received Qty</th>
                                       <th>Challan / Available Qty / Date</th>
                                       <th style="text-align: center;">Submit</th>
                                       <th>History</th>
                                    </tr>
                                </thead>
                                    <%assign var="ro" value=1%>
                                    <%assign var="completed" value=0%>
                                    <%if ($subcon_po_inwarding_master)  %>
                                    <br>
                                    <b><span class="span-text">Input / Challan Part Details</span></b>
                                    <br>
                                    <%foreach from=$p->subcon_po_inwarding_parts item=r %>
                                    
                                    <%if ($r->child_part_new_new) %>
                                    <tr>
                                          <%assign var="inwardCompleted" value=false%>
                                          <%if ($r->recevied_req_qty == $r->input_part_req_qty) %>
                                          <%assign var="completed" value=$completed+1%>
                                          <%assign var="inwardCompleted" value=true%>
                                          <%assign var="disabled" value=true%>
                                          <%/if%> 
                                       <%if ($inwardCompleted != true) %>
                                       <form method="post" action="<%base_url('add_challan_parts_history') %>" id="add_challan_parts_history<%$i%>" class="add_challan_parts_history<%$i%> add_challan_parts_history">
                                       <%/if%>
                                          <td><%$r->child_part_new_new[0]->part_number %>/ <%$r->child_part_new_new[0]->part_description%></td>
                                          <td><%$r->inwarding_qty %></td>
                                          <td><%$r->input_part_req_qty %> <input type="hidden" name="required_qty" value="<%$qty * $r->qty%>"> </td>
                                          <td><%$r->recevied_req_qty%>
                                          </td>
                                         
                                          <td >
                                             <%if $r->recevied_req_qty == $r->input_part_req_qty%>
                                                <%assign var='inwardCompleted' value=true%>
                                                <%assign var='disabled' value=true%>
                                             <%/if%>
                                            
                                             <select name="challan_id" style="width:400px" class="select2 form-control" <%if ($inwardCompleted == true) %><%/if%>  <%if $inwardCompleted == true %>disabled<%/if%>>
                                               
                                                <option value="0">NA</option>
                                                <%if ($r->challan_parts_data) %>
                                                <%foreach from=$r->challan_parts_data item=ch_parts %>
                                                   <%if ($ch_parts->challan_data) %>
                                                      <%if ($ch_parts->challan_data[0]->supplier_id == $supplier[0]->id) %>
                                                         <%if ($ch_parts->challan_data[0]->status == "completed")%>
                                                            <%foreach from=$ch_parts->challan_data item=c_d %>
                                                            <option value="<%$c_d->id %>" <%if $r->selected_challan eq $c_d->id %>selected<%/if%>><%$c_d->challan_number %>/ <%$ch_parts->remaning_qty%>/ <%$c_d->created_date%></option>
                                                            <%/foreach%>
                                                         <%/if%>
                                                      <%/if%>
                                                   <%/if%>
                                                <%/foreach%>
                                                <%/if%>
                                                 
                                             </select>
                                             
                                          </td>
                                          <td style="text-align: center;"> 
                                             <input type="hidden" name="part_id" value="<%$r->child_part_new_new[0]->id%>"> 
                                             <input type="hidden" name="subcon_po_inwarding_parts_id" value="<%$r->id%>"> 
                                             <input type="hidden" name="req_qty" value="<%$r->input_part_req_qty %>"> 
                                             <input type="hidden" name="rec_qty" value="<%$r->recevied_req_qty %>"> 
                                             <input type="hidden" name="grn_number" value="<%$inwarding_data[0]->grn_number %>"> 
                                             <input type="hidden" name="invoice_number" value="<%$inwarding_data[0]->invoice_number %>"> 
                                             <input type="hidden" name="po_id" value="<%$new_po[0]->id %>"> 
                                             <input type="hidden" name="inwarding_id" value="<%$inwarding_id%>" class="form-control"> 
                                             <input type="hidden" name="new_po_id" value="<%$new_po_id %>" class="form-control"> 
                                             <input type="hidden" name="child_part_id" value="<%$p->part_id %>" class="form-control"> 
                                             <input type="hidden" name="invoice_number" placeholder="invoice_number" value="<%$inwarding_data[0]->invoice_number%>" class="form-control"> 
                                             <%if ($inwardCompleted == true) %>
                                             inwarding added
                                             <%else %> 
                                             <button type="submit" class="btn btn-info">Submit</button>
                                             </form>
                                             <%/if%> 
                                          </td>
                                          <td> <a class="btn btn-danger" href="<%base_url('subcon_po_inwarding_history/')%><%$r->id %>">History</a> </td>
                                       <!-- </form> -->
                                       
                                    </tr>

                                    <%assign var="ro" value=$ro+1%>
                                    <%else %>
                                    Part Not Found
                                    <%/if%>
                                    <%/foreach%>
                                    <%/if%> 
                                    <%if ($p->data_present =='no') %> 
                                    <tr class="text-right">
                                       <td colspan="7">
                                          <form action="<%base_url('grn_complete_challan_process') %>" method="post" id="grn_complete_challan_process<%$i%>" class="grn_complete_challan_process grn_complete_challan_process<%$i%>"> 
                                             <%assign var=part_rate_new value=0 %>
                                             <%if (empty($po_parts[0]->rate)) %>
                                             <%assign var=part_rate_new value=$child_part_data[0]->part_rate %>
                                             <%else %>
                                             <%assign var=part_rate_new value=$p->rate %>
                                             <%/if%>

                                             <input type="hidden" required step="any" value="<%$subcon_po_inwarding_master[0]->inwarding_qty %>" placeholder="$po_parts[0]->qty;" name="qty" class="form-control"> 
                                             <input type="hidden" name="inwarding_id" value="<%$inwarding_data[0]->id %>" placeholder="98771231236" class="form-control"> 
                                             <input type="hidden" name="new_po_id" value="<%$new_po_id %>" class="form-control"> 
                                             <input type="hidden" name="part_id" value="<%$po_parts[0]->part_id %>" class="form-control"> 
                                             <input type="hidden" name="invoice_number" value="<%$inwarding_data[0]->invoice_number %>" class="form-control"> 
                                             <input type="hidden" name="grn_number" value="<%$inwarding_data[0]->grn_number %>" class="form-control"> 
                                             <input type="hidden" name="po_part_id" value="<%$po_parts[0]->id %>" class="form-control"> 
                                             <input type="hidden" name="pending_qty" value="<%$po_parts[0]->pending_qty %>" class="form-control"> 
                                             <input type="hidden" name="part_rate" value="<%$part_rate_new %>" class="form-control"> 
                                             <input type="hidden" name="tax_id" value="<%$po_parts[0]->tax_id %>" class="form-control"> 
                                             
                                             <button type="submit" class="btn btn-primary"> Complete Challan Process </button>
                                          </form>
                                       </td>

                                       </td>
                                    </tr>
                                     <%/if%> 
                                 </table>
                              </tr>
                              <%assign var="i" value=$i+1%>
                              <%/foreach%>
                              <%/if%>
                           </tbody>
                           <tfoot> </tfoot>
                        </table>
                     </div>
                  </div>
                  <!-- /.card-body -->
            <!-- /.col -->
         </div>
         <!-- /.row -->
   </div>
   <!-- /.container-fluid -->
   </section> <!-- /.content -->
</div>
<style type="text/css">
    .span-text{
    font-style: normal !important;
    /* display: block; */
    margin-top: 3px;
    font-size: 22px;
    color: #000;
    font-family: 'GilroySemibold', sans-serif !important;
}
</style>
<script type="text/javascript">
  var base_url = <%$base_url|@json_encode%>
</script>
<script src="<%$base_url%>public/js/store/add_grn_qty_subcon_view.js"></script>
<!-- /.content-wrapper -->