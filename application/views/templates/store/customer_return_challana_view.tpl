<div class="content-wrapper">
   <div class="container-xxl flex-grow-1 container-p-y">
     
      <nav aria-label="breadcrumb">
            <div class="sub-header-left pull-left breadcrumb">
                <h1>
                    Store
                    <a hijacked="yes" href="javascript:void(0)" class="backlisting-link" title="">
                        <i class="ti ti-chevrons-right"></i>
                        <em>Challan</em></a>
                </h1>
                <br>
                <span>Customer Challan Inward</span>
            </div>
       </nav>
       <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5 listing-btn">
            <a title="Back To Customer Challan Inward" class="btn btn-seconday" href="<%base_url('challan_inward') %>" type="button"><i class="ti ti-arrow-left"></i></a>
        </div>
      <!-- Main content -->
      <section class="content">
         <div class="">
            <div class="row">
               <div class="col-12">
                  <!-- /.card -->
                  <div class="card mt-4">
                     <div class="card-header">
                     	<%if ($customer_challan_return_details[0]->status == "Pending")%>
                        <form action="<%base_url('update_customer_challan_return') %>" method="POST" class="update_customer_challan_return custom-form" id="update_customer_challan_return"> 
                           <div class="row">
                              <div class="col-lg-3">
                                 <div class="form-group mb-3">
                                    <label class="form-label" for="">CCN No</label><span class="text-danger">*</span></label>
                                    <input type="text" placeholder="Customer Challan No" name="" class="form-control" value="<%$customer_challan_return_details[0]->grn_code%>" disabled>
                                 </div>
                              </div>
                              <div class="col-lg-3">
                                 <div class="form-group mb-3">
                                    <input type="hidden"  name="customer_challan_return_id" value="<%$customer_challan_return_details[0]->customer_challan_return_id %>" class="form-control">
                                    <label class="form-label" for="">Customer<span class="text-danger">*</span> </label>
                                    <select name="customer_id"  id="" class="form-control select2 required-input" disabled>
                                       <%foreach from=$customer item=s %>
	                                       <option value="<%$s->id %>" <%if ($customer_challan_return_details[0]->customer_id == $s->id)%>selected<%/if%>>
	                                          <%$s->customer_name %>
	                                       </option>
                                       <%/foreach%>
                                          
                                    </select>
                                 </div>
                              </div>
                              <div class="col-lg-3">
                                 <div class="form-group mb-3">
                                    <label class="form-label" for="">Customer Challan No</label><span class="text-danger">*</span></label>
                                    <input type="text" placeholder="Customer Challan No" name="customer_challan_no" class="form-control required-input" value="<%$customer_challan_return_details[0]->customer_challan_no %>" >
                                 </div>
                              </div>
                              <div class="col-lg-3">
                                 <div class="form-group mb-3">
                                    <label class="form-label" for="on click url">Date
                                    <span class="text-danger">*</span></label>
                                    <!-- max="<?php echo date("Y-m-d"); ?>" -->
                                    <input  type="date"
                                       value="<%$customer_challan_return_details[0]->customer_challan_data %>"  name="customer_date"
                                       class="form-control required-input" >
                                 </div>
                              </div>
                              <div class="col-lg-3">
                                 <div class="form-group mb-3">
                                    <label class="form-label" for="">Type<span class="text-danger">*</label>
                                    <select name="type" id="type" class="form-control select2 required-input" >
                                       <option value="">Select</option>
                                       <option value="returnable" <%if ($customer_challan_return_details[0]->type == "returnable")%>selected<%/if%>>Returnable</option>
                                       <option value="non_returnable" <%if ($customer_challan_return_details[0]->type == "non_returnable")%>selected<%/if%>>Non Returnable</option>
                                    </select>
                                 </div>
                              </div>
                              
                              	<div class="col-lg-12">
                                 <div class="form-group">
                                    <button type="submit" class="btn btn-primary mt-4">Update </button>
                                 </div>
                               </div>
                        </form>
                     </div>
                        <%else%>
                        <div class="row">
                        	<%assign var='type' value=''%>
                        	<%if ($customer_challan_return_details[0]->type == "returnable")%>
                        		<%assign var='type' value='Returnable'%>
                        	<%else if ($customer_challan_return_details[0]->type == "non_returnable")%>
                        		<%assign var='type' value='Non Returnable'%>
                        	<%/if%>
						   <div class="tgdp-rgt-tp-sect">
						      <p class="tgdp-rgt-tp-ttl">CCN No</p>
						      <p class="tgdp-rgt-tp-txt">
						         <%$customer_challan_return_details[0]->grn_code%>
						      </p>
						   </div>
						   <div class="tgdp-rgt-tp-sect">
						      <p class="tgdp-rgt-tp-ttl">Customer</p>
						      <p class="tgdp-rgt-tp-txt">
						         <%$customer_challan_return_details[0]->customer_name%>                 
						      </p>
						   </div>
						   <div class="tgdp-rgt-tp-sect">
						      <p class="tgdp-rgt-tp-ttl">Customer Challan No</p>
						      <p class="tgdp-rgt-tp-txt">
						         <%$customer_challan_return_details[0]->customer_challan_no %>                 
						      </p>
						   </div>
						   <div class="tgdp-rgt-tp-sect">
						      <p class="tgdp-rgt-tp-ttl">Date</p>
						      <p class="tgdp-rgt-tp-txt">
						         <%defaultDateFormat($customer_challan_return_details[0]->customer_challan_data) %>                  
						      </p>
						   </div>
						   <div class="tgdp-rgt-tp-sect">
						      <p class="tgdp-rgt-tp-ttl">Type</p>
						      <p class="tgdp-rgt-tp-txt">
						         <%$type %>                   
						      </p>
						   </div>
						</div>
                        <%/if%>
                        </div>
                        
                        
                        
                     </div>
                  
                  <div class="card p-0 mt-4">
                  	<%if ($customer_challan_return_details[0]->status == "Pending") %>
                     <div class="card-header">
                     	<form action="<%base_url('add_parts_customer_challan_return') %>" method="post" id="add_parts_customer_challan_return" class="add_parts_customer_challan_return custom-form">
                        <div class="row">
                           <div class="col-lg-5">
                              <div class="form-group">
                                    <input type="hidden"  name="customer_challan_return_id" value="<%$customer_challan_return_details[0]->customer_challan_return_id %>" class="form-control">
                                    <label for="">Select Part Number / Description
                                    Tax Structure <span class="text-danger">*</span> </label>
                                    <select name="part_id" id="" class="form-control select2 required-input">
                                       	<%foreach from=$customer_part item=c %>
                                       <option value="<%$c->id %>">
                                          <%$c->part_number %>/ <%$c->part_description%>
                                       </option>
                                       <%/foreach%>
                                    </select>
                              </div>
                           </div>
                           <div class="col-lg-3">
                           <div class="form-group">
                           <label for="">Enter Qty <span class="text-danger">*</span> </label>
                           <input type="text" name="qty" placeholder="Enter QTY"  class="onlyNumericInput required-input form-control" data-min='1'>
                           <input type="hidden" name="customer_id" value="<%$customer_challan_return_details[0]->customer_id %>" placeholder="Enter QTY " required class="form-control">
                           </div>
                           </div>
                           <div class="col-lg-2">
                           <div class="form-group mt-2">
                           
                           <button type="submit" class="btn btn-info btn mt-3">Add</button>
                           
                           </div>
                           </div>
                           </form>
                        </div>

                     </div>
                     <%/if%>
                     <%if ($customer_challan_return_part_details) %>
                     <div class="card-header">
                        <%if ($customer_challan_return_details) %>
	                        <%if ($customer_challan_return_details[0]->status == "Pending") %>
	                           <%if ($this->session->userdata['type'] == 'admin' || $this->session->userdata['type'] == 'Admin' || true) %>
			                        <button type="button" class="btn btn-danger ml-1" data-bs-toggle="modal" data-bs-target="#lock" >
			                        Lock Customer Challan Inward
			                        </button>
			                    <%/if%>
	                        <%/if%>
                        <%/if%>
                        <%if ($new_sales[0]->status == "lock") %>
                           	<%if ($this->session->userdata['type'] == 'admin' || $this->session->userdata['type'] == 'Admin') %>
	                        <!-- <button type="button" class="btn btn-success ml-1" data-toggle="modal" data-target="#accpet">
	                           Accept (Released) Invoice
	                           </button>
	                           <button type="button" class="btn btn-danger ml-1" data-toggle="modal" data-target="#delete">
	                           Reject (delete) Invoice
	                           </button> -->
	                        <%/if%>
                        <%else %>
	                        <%if ($customer_challan_return_details[0]->status != "Pending") %>
		                        <button type="button" disabled class="btn btn-success ml-1" data-toggle="modal" data-target="#accpet">
		                        Customer Challan Inward Locked
		                        </button>
	                        <%/if%>
	                    <%/if%>

                        <!-- Modal -->
                        <div class="modal fade" id="lock" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                           <div class="modal-dialog modal-dialog-centered">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Lock</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    </button>
                                 </div>
                                 <div class="modal-body">
                                    <div class="row">
                                       <form action="<%base_url('lock_challan_return') %>" method="POST" id="lock_challan_return" class="lock_challan_return">
                                          <div class="col-lg-12">
                                             <div class="form-group">
                                                <label for=""><b>Are You Sure Want To Lock This
                                                Customer Challan Inward?</b> </label>
                                                <input type="hidden" name="id" value="<%$customer_challan_return_details[0]->customer_challan_return_id %>" required class="form-control">
                                                <input type="hidden" name="status" value="Lock" required class="form-control">
                                             </div>
                                          </div>
                                    </div>
                                 </div>
                                 <div class="modal-footer">
                                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                 <button type="submit" class="btn btn-primary">Lock</button>
                                 </div>
                              </div>
                              </form>
                           </div>
                        </div>
                     </div>
                     <%/if%>
                    </div>
                    <div class="card p-0 mt-4">
                     <div class="">
                        <table class="table table-striped scrollable" >
                           <thead>
                              <tr>
                                 <!-- <th>Sr No</th> -->
                                 <th>Part Number</th>
                                 <th>Part Description</th>
                                 <th>Tax Strucutre</th>
                                 <th>UOM</th>
                                 <th>QTY</th>
                                 <th>Price</th>
                                 <!--  <th>Accepted QTY</th>
                                    <th>Rejected QTY</th> -->
                                 <!-- <th width="30%">Remark</th> -->
                                 <!-- <th>Created Date</th> -->
                                 <th>CGST</th>
                                 <th>SGST</th>
                                 <th>IGST</th>
                                 <th>TCS</th>
                                 <th>Sub Total</th>
                                 <th>GST</th>
                                 <th>Total Price</th>
                                 <th>Actions</th>
                                 <!-- <th>Accept/Reject</th> -->
                              </tr>
                           </thead>
                           <tbody>
                                    <%assign var='i' value=1%>
                                    <%assign var='total_final_amount' value=0%>
                                    <%if ($customer_challan_return_part_details) %>
                                    <%foreach from=$customer_challan_return_part_details item=p %>
                                        <%assign var='total_final_amount' value=$total_final_amount+$p->total_rate%>
			                              <tr>
			                                 <!-- <td><%$i%></td> -->
			                                 <td><%$p->part_number %></td>
			                                 <td><%$p->part_description %></td>
			                                 <td><%$p->gst_code %></td>
			                                 <td><%$p->uom %></td>
			                                 <td><%$p->qty %></td>
			                                 <td><%number_format($p->part_price,2) %></td>
			                                 <td><%number_format($p->cgst_amount,2) %></td>
			                                 <td><%number_format($p->sgst_amount,2) %></td>
			                                 <td><%number_format($p->igst_amount,2) %></td>
			                                 <td><%number_format($p->tcs_amount,2) %></td>
			                                 <td><%number_format($p->basic_total,2) %></td>
			                                 <td><%number_format($p->gst_amount,2) %></td>
			                                 <td><%number_format($p->total_rate,2) %></td>
			                                 <!-- <td><?php echo $p->accepted_qty; ?></td>
			                                    <td><?php echo $p->rejected_qty; ?></td> -->
			                                 <!-- <td><?php echo $p->remark; ?></td> -->
			                                 <!-- <td><?php echo $p->created_date; ?></td> -->
			                                 <td>
			                                    <%if ($customer_challan_return_details[0]->status == "Pending") %>
			                                    <!-- Button trigger modal -->
			                                    <a type="button" class="" data-bs-toggle="modal" data-bs-target="#exampleModal<%$i%>">
			                                    <i class="ti ti-edit"></i>
			                                    </a>
			                                    <a type="button" class="" data-bs-toggle="modal" data-bs-target="#exampleModaldelete<%$i %>">
			                                     <i class="ti ti-trash"></i>
			                                    </a>
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
			                                                <div class="row">
			                                                   <div class="col-lg-12">
			                                                      <div class="form-group">
			                                                         <form action="<%base_url('update_parts_customer_challan_return')%>" method="POST" class="update_parts_customer_challan_return update_parts_customer_challan_return<%$i%> custom-form" id="update_parts_customer_challan_return<%$i%>">
			                                                            <label for="">Enter Qty <span class="text-danger">*</span>
                                           </label>
			                                                            <input type="text" name="qty" value="<%$p->qty %>" placeholder="Enter QTY "  class="form-control onlyNumericInput required-input" data-min="1">
			                                                            <input type="hidden" name="customer_challan_return_part_id" value="<%$p->customer_challan_return_part_id %>" 
			                                                               placeholder="Enter QTY " required class="form-control">
			                                                            <input type="hidden" name="part_id" value="<%$p->part_id %>" 
			                                                               placeholder="Enter QTY " required class="form-control">
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
			                                    <!-- Modal -->
			                                    <div class="modal fade" id="exampleModaldelete<%$i %>" tabindex="-1" aria-labelledby="" aria-hidden="true">
			                                       <div class="modal-dialog modal-dialog-centered">
			                                          <div class="modal-content">
			                                             <div class="modal-header">
			                                                <h5 class="modal-title" id="exampleModalLabel">Delete Part
			                                                </h5>
			                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
			                                                
			                                                </button>
			                                             </div>
			                                             <div class="modal-body">
			                                                <div class="row">
			                                                   <form action="<%base_url('delete_customer_challan_inward')%>" method="POST" id="delete_customer_challan_inward" class="delete_customer_challan_inward delete_customer_challan_inward<%$i %>">
			                                                      <div class="col-lg-12">
			                                                         <div class="form-group">
			                                                            <label for=""> <b>Are You Sure Want To
			                                                            Delete This ? </b> </label>
			                                                            <input type="hidden" name="customer_challan_return_part_id" value="<%$p->customer_challan_return_part_id %>" 
			                                                         </div>
			                                                      </div>
			                                                </div>
			                                             </div>
			                                             <div class="modal-footer">
			                                             <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
			                                             <button type="submit" class="btn btn-primary">Delete</button>
			                                             </div>
			                                          </div>
			                                          </form>
			                                       </div>
			                                    </div>
			                                    <%else %>
			                                       <%display_no_character("")%>
			                                    <%/if%>
			                                 </td>
			                              </tr>
			                              <%assign var='i' value=$i+1%>
		                              <%/foreach%>
		                            <%/if%>
                           </tbody>
                           <%if ($customer_challan_return_part_details) %>
                           <tfoot>
                              <tr>
                              	<th>Total</th>
                                 <th></th>
                                 <th></th>
                                 <th></th>
                                 <th></th>
                                 <th></th>
                                 <th></th>
                                 <th></th>
                                 <th></th>
                                 <th></th>
                                 <th></th>
                                 <th></th>
                                 <th><%number_format($total_final_amount,2)%></th>
                                 <th></th>
                              </tr>
                           </tfoot>
                           <%/if%>
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
<style type="text/css">
   .hide {
   display: none;
   }
</style>
<script src="<%$base_url%>/public/js/store/view_challan_return.js"></script>