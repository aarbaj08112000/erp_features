<div class="wrapper container-xxl flex-grow-1 container-p-y">
<div class="content-wrapper">
   <section class="content-header">
      
       <div class="sub-header-left pull-left breadcrumb">
        <h1>
          Production
          <a hijacked="yes" href="javascript:void(0)" class="backlisting-link" title="Back to Issue Request Listing">
            <i class="ti ti-chevrons-right"></i>
            <em>Sharing Production</em></a>
        </h1>
        <br>
        <span>Production Details - Sharing</span>
      </div>
      <!-- /.container-fluid -->
   </section>
   <div class="dt-top-btn d-grid gap-2 d-md-flex  mb-5 listing-btn">
      <a class="btn btn-seconday" type="button" href="<%base_url('sharing_p_q')%>"><i class="ti ti-arrow-left" title="Back To Sharing Production"></i></a>
    </div>
   <section class="content">
      <div>
         <div class="row">
            <br>
            <div class="col-lg-12">
               <div class="">
               	<div class="card p-0 mt-4">
				         <div class="card-header">
				            <div class="row">
				               <div class="tgdp-rgt-tp-sect">
				                  <p class="tgdp-rgt-tp-ttl">Status</p>
				                  <p class="tgdp-rgt-tp-txt"><%$sharing_p_q[0]->status %></p>
				               </div>
				               <div class="tgdp-rgt-tp-sect">
				                  <p class="tgdp-rgt-tp-ttl">Shifts Data</p>
				                  <p class="tgdp-rgt-tp-txt"><%$sharing_p_q[0]->shift_name %></p>
				               </div>
				               <div class="tgdp-rgt-tp-sect">
				                  <p class="tgdp-rgt-tp-ttl">Machine Data</p>
				                  <p class="tgdp-rgt-tp-txt"><%$sharing_p_q[0]->machine_name %></p>
				               </div>
				               <div class="tgdp-rgt-tp-sect">
				                  <p class="tgdp-rgt-tp-ttl">Operator Data</p>
				                  <p class="tgdp-rgt-tp-txt"><%$sharing_p_q[0]->op_name %></p>
				               </div>
				                                                           
				            </div>
				         </div>
				      </div>
                </div>
                <div class="card p-0 mt-4">
                  <div class="card-header">
                     <form action="<%base_url('add_sharing_p_q_history') %>" method="POST" id="add_sharing_p_q_history" class="custom-form add_sharing_p_q_history">
                        <div class="row">
                           <div class="col-lg-4">
                              <div class="form-group mb-3">
                                 <label class="form-label"> Output Part
                                 </label ><span class="text-danger">*</span>
                                 <select class="form-control select2 required-input" name="output_part_id"
                                    style="width: 100%;">
                                    <%foreach from=$child_part_list item=c1 %>
                                           <%if ($c1->sub_type != "RM") && $c1->childPartId != ''%>
		                                    <option value="<%$c1->childPartId %>">
		                                       <%$c1->part_number %>/<%$c1->part_description %>
		                                    </option>
		                                   <%/if%>
                                    <%/foreach%>
                                 </select>
                              </div>
                           </div>
                           <div class="col-lg-3">
                              <div class="form-group mb-3">
                                 <label for="operation_name" class="form-label">Qty</label><span class="text-danger">*</span>
                                 <input type="text" step="any" data-min="1" value="1" name="qty"
                                    class="form-control required-input onlyNumericInput"  id="exampleInputPassword1"
                                    placeholder="Enter Qty ">
                              </div>
                           </div>
                           <div class="col-lg-2">
                              <div class="form-group mb-3">
                                 <label for="operation_name" class="form-label">Scrap
                                 Quantity (kg)
                                 </label class="form-label"><span class="text-danger">*</span>
                                 <input type="text" step="any" data-min="0" value="0" data-name="scrap_factor"
                                    class="form-control required-input onlyNumericInput"  id="exampleInputPassword1"
                                    placeholder="Operation Name ">
                                 <input type="hidden" name="sharing_p_q_id"
                                    value="<%$sharing_p_q_id %>" class="form-control" required
                                    id="exampleInputPassword1" placeholder="Operation Name ">
                              </div>
                           </div>
                           <div class="col-lg-4">
                              <div class="form-group">
                                 <label class="form-label">Input Part / sharing qty
                                 </label><span class="text-danger">*</span>
                                 <select class="form-control select2 required-input" name="input_part_id"
                                    style="width: 100%;">
                                        <%foreach from=$child_part_list item=c1 %>
                                           	<%if ($c1->sub_type == "RM") %>
		                                    <option value="<%$c1->childPartId %>">
		                                       <%$c1->part_number %>/<%$c1->part_description %> / <%$c1->$sharingQtyColName %>
		                                    </option>
		                                    <%/if%>
                                       	<%/foreach%>
                                 </select>
                              </div>
                           </div>
                           <div class="col-lg-2">
                              <div class="form-group ml-2 mt-4 pt-2">
                                 <button type="submit" class="btn btn-info" data-dismiss="modal">Add
                                 </button>
                     </form>
                     </div>
                     </div>
                     </div>
                  </div>

                </div>
                <div class="card p-0 mt-4">
                  <!-- /.card-header -->
                  <div class="">
                     <table id="example1" class="table scrollable table-striped">
                        <thead>
                           <tr>
                              <!-- <th>Sr No</th> -->
                              <th style='width:20%;'>Output Part Number / Description</th>
                              <th style='width:20%;'>Input Part Number / Description</th>
                              <th style='width:7.5%;'>Scrap</th>
                              <th style='width:7.5%;'>Qty</th>
                              <th style='width:7.5%;'>Qty In Kg</th>
                              <th style='width:7.5%;'>Accepted Qty</th>
                              <th style='width:7.5%;'>Rejected Qty</th>
                              <th style='width:7.5%;' class="text-center">Onhold Qty</th>
                              <th style='width:7.5%;'>Status</th>
                              <th style='width:7.5%;'>Actions</th>
                           </tr>
                        </thead>
                        <tbody>
						    <%if ($sharing_p_q_history) %>
						        <%assign var=i value=1 %>
						          <%foreach from=$sharing_p_q_history item=u %>
									<tr>
									      <!--<td><%$i %></td> -->
									      <td style='width:20%;'><%$u->output_part_no %> /
									         <%$u->output_part_desc %>
									      </td>
									      <td style='width:20%;'><%$u->input_part_no %> /
									         <%$u->input_part_desc %>
									      </td>
									      <td style='width:7.5%;'><%$u->scrap_factor %></td>
									      <td style='width:7.5%;'><%$u->qty %></td>
									      <td style='width:7.5%;'><%$u->qty_in_kg %></td>
									      <td style='width:7.5%;'><%$u->accepted_qty %></td>
									      <td style='width:7.5%;'><%$u->rejected_qty %></td>
									      <td style='width:7.5%;' class="text-center">
									         <%if (!empty($u->onhold_qty)) %>
										         <button type="button" class="btn btn-warning float-left " data-bs-toggle="modal"
										            data-bs-target="#onhold<%$i %>">
										        	 <%$u->onhold_qty %>
										       	 </button>
									         <%else %>
									            0
									         <%/if%>
									         <div class="modal fade" id="onhold<%$i %>" tabindex="-1" role="dialog"
									            aria-labelledby="exampleModalLabel" aria-hidden="true">
									            <div class="modal-dialog modal-dialog-centered" role="document">
									               <div class="modal-content">
									                  <div class="modal-header">
									                     <h5 class="modal-title" id="exampleModalLabel">
									                        Onhold
									                        Update
									                     </h5>
									                     <button type="button" class="btn-close" data-bs-dismiss="modal"
									                        aria-label="Close">
									                     </button>
									                  </div>
									                  <div class="modal-body">
									                     <form action="<%base_url('update_p_q_onhold_sharing') %>"
									                        method="POST" enctype='multipart/form-data' style="text-align: left;" class="update_p_q_onhold_sharing update_p_q_onhold_sharing<%$u->id %>  custom-form" id="update_p_q_onhold_sharing<%$u->id %>">
									                        <div class="row">
									                           <div class="col-lg-12">
									                              <div class="form-group">
									                                 <label for="">Qty</label>
									                                 <input type="number" step="any"
									                                    value="<%$u->onhold_qty %>" readonly
									                                    class="form-control">
									                              </div>
									                           </div>
									                           <div class="col-lg-12">
									                              <div class="form-group">
									                                 <label for="">Accept Qty <span
									                                    class="text-danger">*</span>
									                                 </label>
									                                 <input type="text" step="any" value=""
									                                    data-max="<%$u->onhold_qty %>" data-min="0"
									                                    class="form-control required-input onlyNumericInput" name="accepted_qty"
									                                    placeholder="Enter Accepted Quantity" >
									                              </div>
									                           </div>
									                           <div class="col-lg-12">
									                              <div class="form-group">
									                                 <label for="">Rejection
									                                 Reason</label>
									                                 <select name="rejection_reason" id=""
									                                    class="form-control select2" style="width: 100%;">
									                                    <option value="NA">NA</option>
									                                    <%if ($reject_remark) %>
									                                       	<%foreach from=$reject_remark item=r %>
											                                    <option value="<%$r->name %>">
											                                       <%$r->name %>
											                                    </option>
											                                <%/foreach%>
									                                    <%/if%>
									                                 </select>
									                              </div>
									                           </div>
									                           <div class="col-lg-12">
									                              <div class="form-group">
									                                 <label for="">Reject Remark</label>
									                                 <input type="text"
									                                    placeholder="Enter Rejection Remark If any"
									                                    class="form-control" name="rejection_remark">
									                                 <input type="hidden"
									                                    placeholder="Enter Rejection Remark If any"
									                                    readonly class="form-control" name="id"
									                                    value="<%$u->id %>">
									                                 <input type="hidden"
									                                    placeholder="Enter Rejection Remark If any"
									                                    readonly class="form-control" name="qty"
									                                    value="<%$u->onhold_qty %>">
									                                 <input type="hidden"
									                                    placeholder="Enter Rejection Remark If any"
									                                    readonly class="form-control"
									                                    name="output_part_id"
									                                    value="<%$u->output_part_id %>">
									                                 <input type="hidden"
									                                    placeholder="Enter Rejection Remark If any"
									                                    readonly class="form-control"
									                                    name="accepted_qty_old"
									                                    value="<%$u->accepted_qty %>">
									                                 <input type="hidden"
									                                    placeholder="Enter Rejection Remark If any"
									                                    readonly class="form-control"
									                                    name="rejected_qty_old"
									                                    value="<%$u->rejected_qty %>">
									                              </div>
									                           </div>
									                        </div>
									                        <div class="modal-footer">
									                           <button type="button" class="btn btn-secondary"
									                              data-bs-dismiss="modal">Close</button>
									                           <button type="submit" class="btn btn-primary">Save
									                           changes</button>
									                        </div>
									                  </div>
									                  </form>
									               </div>
									            </div>
									         </div>
									      </td>
									      <td style='width:7.5%;'><%$u->status %></td>
									      <td style='width:7.5%;'>
									         <%if ($u->status == "pending") %>
										         <button type="button" class="btn btn-danger float-left" data-bs-toggle="modal"
										            data-bs-target="#acceptReject<%$i %>">
										         Accept/Reject </button>
										     <%else %>
									             Completed
									          <%/if%>
									         <div class="modal fade" id="acceptReject<%$i %>" tabindex="-1"
									            role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									            <div class="modal-dialog  modal-dialog-centered" role="document">
									               <div class="modal-content">
									                  <div class="modal-header">
									                     <h5 class="modal-title" id="exampleModalLabel">Accept/Reject</h5>
									                     <button type="button" class="btn-close" data-bs-dismiss="modal"
									                        aria-label="Close">
									                     </button>
									                  </div>
									                  <form action="<%base_url('update_p_q_sharing') %>"
									                        method="POST" enctype='multipart/form-data' id="update_p_q_sharing<%$u->id %>" class="update_p_q_sharing update_p_q_sharing<%$u->id %> custom-form">
									                  <div class="modal-body">
									                     
									                        <div class="row">
									                           <div class="col-lg-12">
									                              <div class="form-group">
									                                 <label for="">Qty</label>
									                                 <input type="text" value="<%$u->qty %>"
									                                    readonly class="form-control">
									                              </div>
									                           </div>
									                           <div class="col-lg-12">
									                              <div class="form-group">
									                                 <label for="">Accept Qty <span
									                                    class="text-danger">*</span>
									                                 </label>
									                                 <input type="text" value=""
									                                    data-max=" <%$u->qty %>" data-min="0"
									                                    class="form-control required-input onlyNumericInput" name="accepted_qty"
									                                    placeholder="Enter Accepted Quantity" >
									                              </div>
									                           </div>
									                           <div class="col-lg-12">
									                              <div class="form-group">
									                                 <label for="">Onhold Qty <span
									                                    class="text-danger">*</span>
									                                 </label>
									                                 <input type="text" value=""
									                                    data-max=" <%$u->qty %>" data-min="0"
									                                    class="form-control required-input onlyNumericInput" name="onhold_qty"
									                                    placeholder="Enter onhold" >
									                              </div>
									                           </div>
									                           <div class="col-lg-12">
									                              <div class="form-group">
									                                 <label for="">Rejection Reason</label>
									                                 <select name="rejection_reason" id=""
									                                    class="form-control select2 " style="width:100%;">
									                                    <option value="NA">NA</option>
									                                    <%if ($reject_remark) %>
										                                    <%foreach from=$reject_remark item=r %>
										                                    <option value="<%$r->name %>">
										                                       <%$r->name %>
										                                    </option>
										                                    <%/foreach%>
									                                    <%/if%>
									                                 </select>
									                              </div>
									                           </div>
									                           <div class="col-lg-12">
									                              <div class="form-group">
									                                 <label for="">Reject Remark</label>
									                                 <input type="text"
									                                    placeholder="Enter Rejection Remark If any"
									                                    class="form-control" name="rejection_remark">
									                                 <input type="hidden"
									                                    placeholder="Enter Rejection Remark If any"
									                                    readonly class="form-control" name="id"
									                                    value="<%$u->id %>">
									                                 <input type="hidden"
									                                    placeholder="Enter Rejection Remark If any"
									                                    readonly class="form-control" name="qty"
									                                    value="<%$u->qty %>">
									                                 <input type="hidden"
									                                    placeholder="Enter Rejection Remark If any"
									                                    readonly class="form-control"
									                                    name="output_part_id"
									                                    value="<%$u->output_part_id %>">
									                                 <input type="hidden"
									                                    placeholder="Enter Rejection Remark If any"
									                                    readonly class="form-control"
									                                    name="input_part_id"
									                                    value="<%$u->input_part_id %>">
									                                 <input type="hidden"
									                                    placeholder="Enter Rejection Remark If any"
									                                    readonly class="form-control" name="    "
									                                    value="<%$u->qty_in_kg %>">
									                              </div>
									                           </div>
									                        </div>
									                        <div class="modal-footer">
									                           <button type="button" class="btn btn-secondary"
									                              data-bsbtn--dismiss="modal">Close</button>
									                           <button type="submit" class="btn btn-primary">Save
									                           changes</button>
									                        </div>
									                  </div>
									                  </form>
									               </div>
									            </div>
									         </div>
									      </td>
									   </tr>
									<%assign var=i value=$i+1 %>
						      	<%/foreach%>
						    <%/if%>
						</tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
</div>
<script src="<%$base_url%>public/js/production/details_production_qty_sharing.js"></script>
