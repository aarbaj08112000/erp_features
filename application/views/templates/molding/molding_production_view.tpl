 <%if ($molding_production) %>
               <%assign var='i' value=1 %>
                  <%foreach from=$molding_production item=u %>
                     <%assign var='total_pde' value="0" %>
                     <%if $u->production_target_per_shift > 0 %>
                     <%assign var='total_pde' value= (
                        ($u->accepted_qty / $u->production_hours * $u->name) 
                        / $u->production_target_per_shift * 100) * 100 %>
                     <%/if%>
                     
                     <%assign var='total_qe' value=($u->accepted_qty / $u->qty) * 100 %>
                     <%assign var='total_ppm' value=(($u->rejection_qty+$u->rejected_qty)/ $u->qty) * 1000000 %>
                       
                     <%assign var='planned_pt'  value=($u->production_hours - $u->ppt) %>
                     <%assign var='runtime' value=$planned_pt - ($downtime_in_min  + $setup_time_in_min) %>
                     <%assign var='availbility' value=$runtime / $planned_pt %>
                     <%assign var='total_prod_qty' value=$u->rejection_qty + $u->qty %>
                     <%assign var='performance' value= ($u->cycle_time * $total_prod_qty ) / ($runtime * 60) %>
                     <%assign var='quality' value=$u->accepted_qty / $total_prod_qty %>
               
                     <%assign var='total_oee' value=$availbility * $performance * $quality * 100 %>
                     <%assign var='target_production_qty' value=0 %>
                     <%if $u->cycle_time > 0 %>
                     <%assign var='target_production_qty' value= ($u->production_hours * 60)/$u->cycle_time %>
                     <%/if%>
                     <%assign var='target_prod_wt' value=$u->finish_part_weight  * $u->qty %>
                     <%assign var='target_runner_wt' value=$u->runner_weight * $u->qty %>
                  <tr>
                     <td>JO-<%$u->id %></td>
                     <td><%$u->part_number %> /
                        <%$u->part_description %>
                     </td>
                     <td><%$u->date %></td>
                     <td><%$u->shift_type %>/<%$u->name %></td>
                     <td><%$u->machine_name %></td>
                     <td><%$u->operator_name %></td>
                     <td><%round($target_production_qty,2) %></td>
                     <td><%$u->qty %></td>
                     <td><%$u->rejection_qty %></td>
                     <td><%$u->accepted_qty %></td>
                     <td><%$u->rejected_qty %></td>
                     <td>
                        <%if (!empty($u->onhold_qty)) %>
                           <%if checkGroupAccess("view_p_q_molding_production","update","No")%>
                              <button type="button" class="btn btn-warning float-left "
                                 data-toggle="modal" data-target="#onhold<%$i %>">
                              <%$u->onhold_qty %> </button>
                           <%else%>
                              <%$u->onhold_qty %>
                           <%/if%>
                        <%else %>
                           0
                        <%/if%>
                        <div class="modal fade" id="onhold<%$i %>" tabindex="-1"
                           role="dialog" aria-labelledby="exampleModalLabel"
                           aria-hidden="true">
                           <div class="modal-dialog modal-lg" role="document">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">
                                       Onhold
                                       Update 
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal"
                                       aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                 </div>
                                 <div class="modal-body">
                                    <form
                                       action="<%base_url('update_p_q_onhold_molding') %>"
                                       method="POST" enctype='multipart/form-data' >
                                       <div class="row">
                                          <div class="col-lg-12">
                                             <div class="form-group">
                                                <label for="">Qty</label>
                                                <input type="text"
                                                   value="<%$u->onhold_qty %>"
                                                   readonly class="form-control">
                                             </div>
                                          </div>
                                          <div class="col-lg-12">
                                             <div class="form-group">
                                                <label for="">Accept Qty <span
                                                   class="text-danger">*</span>
                                                </label>
                                                <input type="number" step="any" value=""
                                                   max="<%$u->onhold_qty %>"
                                                   min="0" class="form-control"
                                                   name="accepted_qty"
                                                   placeholder="Enter Accepted Quantity"
                                                   required>
                                             </div>
                                          </div>
                                          <div class="col-lg-12">
                                             <div class="form-group">
                                                <label for="">Rejection
                                                Reason</label>
                                                <select name="rejection_reason" id=""
                                                   class="form-control select2">
                                                   <option value="NA">NA</option>
                                                   <%if ($reject_remark) %>
                                                      <%foreach from=$reject_remark item=r %>
                                                         <option
                                                            value="<%$r->name %>">
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
                                                   class="form-control"
                                                   name="rejection_remark">
                                                <input type="hidden"
                                                   placeholder="Enter Rejection Remark If any"
                                                   readonly class="form-control"
                                                   name="id"
                                                   value="<%$u->id %>">
                                                <input type="hidden"
                                                   placeholder="Enter Rejection Remark If any"
                                                   readonly class="form-control"
                                                   name="qty"
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
                                                <input type="text"
                                                   placeholder="Enter Rejection Remark If any"
                                                   readonly class="form-control"
                                                   name="customer_part_id"
                                                   value="<%$u->customer_part_id %>">
                                             </div>
                                          </div>
                                       </div>
                                       <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary"
                                             data-dismiss="modal">Close</button>
                                          <button type="submit"
                                             class="btn btn-primary">Save
                                          changes</button>
                                       </div>
                                 </div>
                                 </form>
                              </div>
                           </div>
                        </div>
                     </td>
                     <td><%$u->wastage %></td>
                     <td><%$u->status %></td>
                     <td><%$u->production_hours %></td>
                     <td><%$u->downtime_in_min %></td>
                     <td><%$u->setup_time_in_min %></td>
                     <td><%$u->cycle_time %></td>
                     <td><%$target_prod_wt %></td>
                     <td><%$target_runner_wt %></td>
                     <td><%$u->finish_part_weight %></td>
                     <td><%$u->runner_weight %></td>
                     <td><%round($total_pde,2) %></td>
                     <td><%round($total_qe,2) %></td>
                     <td><%round($total_ppm,2) %></td>
                     <td><%round($total_oee,2) %></td>
                     <td>
                        <%if checkGroupAccess("view_p_q_molding_production","update","No")%>
                           <a class="" href="<%base_url('view_rejection_details/')%><%$u->id %>/<%$u->customer_part_id %>/view">
                           <i class='ti ti-edit'></i>
                           </a>
                        <%else%>
                           <%display_no_character()%>
                        <%/if%>
                     </td>
                     <td>
                        <%if checkGroupAccess("view_p_q_molding_production","update","No")%>
                           <a class="" href="<%base_url('view_downtime_details/')%><%$u->id%>/<%$u->customer_part_id %>/view">
                           <i class='ti ti-edit'></i>
                           </a>
                        <%else%>
                           <%display_no_character()%>
                        <%/if%>
                     </td>
                     <td>
                        <%if ($u->status != "pending") %>
                           <%if checkGroupAccess("view_p_q_molding_production","update","No")%>
                              <button type="button" class="btn btn-danger float-left "
                                 data-bs-toggle="modal" data-bs-target="#acceptReject<%$i %>">
                              Accept/Reject </button>
                           <%else%>
                              <%display_no_character()%>
                           <%/if%>
                        <%else %>
                           Completed
                        <%/if%>
                        <div class="modal fade" id="acceptReject<%$i %>" tabindex="-1"
                           role="dialog" aria-labelledby="exampleModalLabel"
                           aria-hidden="true">
                           <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                       aria-label="Close">>
                                    </button>
                                 </div>
                                 <form
                                       action="<%base_url('update_p_q_molding_production') %>"
                                       method="POST" enctype='multipart/form-data' id="update_p_q_molding_production" class="update_p_q_molding_production<%$i %> update_p_q_molding_production custom-form">
                                 <div class="modal-body">
                                    
                                       <div class="row">
                                          <div class="col-lg-6">
                                             <div class="form-group">
                                                <label for="">Date</label>
                                                <input type="text"
                                                   value="<%$u->date %>"
                                                   readonly class="form-control">
                                             </div>
                                          </div>
                                          <div class="col-lg-6">
                                             <div class="form-group">
                                                <label for="">Shift</label>
                                                <br>
                                                <span><%$u->shift_type %>/<%$u->name %></span>
                                             </div>
                                          </div>
                                          <div class="col-lg-6">
                                             <div class="form-group">
                                                <label for="">Qty</label>
                                                <input type="text"
                                                   value="<%$u->qty %>"
                                                   readonly class="form-control">
                                             </div>
                                          </div>
                                          <div class="col-lg-6">
                                             <div class="form-group">
                                                <label for="on click url">Enter Semi
                                                Finished location QTY<span
                                                   class="text-danger">*</span></label>
                                                <input type="text" data-min="0" value="0"
                                                   max="" name="semi_finished_location"
                                                    class="form-control onlyNumericInput required-input">
                                             </div>
                                          </div>
                                          <div class="col-lg-6">
                                             <div class="form-group">
                                                <label for="on click url">Enter Final
                                                Inspection Qty<span
                                                   class="text-danger">*</span></label>
                                                <input type="text" data-min="0" value="0"
                                                   max=""
                                                   name="final_inspection_location"
                                                    class="form-control onlyNumericInput required-input">
                                             </div>
                                          </div>
                                          <div class="col-lg-6">
                                             <div class="form-group">
                                                <label for="">Onhold Qty <span
                                                   class="text-danger">*</span>
                                                </label>
                                                <input type="text" step="any" value=""
                                                   data-max="<%$u->qty %>" data-min="0"
                                                   class="form-control onlyNumericInput required-input"
                                                   name="onhold_qty"
                                                   placeholder="Enter onhold" >
                                             </div>
                                          </div>
                                          <div class="col-lg-6">
                                             <div class="form-group">
                                                <label for="">Rejection Reason</label>
                                                <select name="rejection_reason" id=""
                                                   class="form-control select2">
                                                   <option value="NA">NA</option>
                                                   <%if ($reject_remark) %>
                                                      
                                                      <%foreach from=$reject_remark item=r %>
                                                      <option
                                                         value="<%$r->name %>">
                                                         <%$r->name %>
                                                      </option>
                                                      <%/foreach%>
                                                   <%/if%>
                                                </select>
                                             </div>
                                          </div>
                                          <div class="col-lg-6">
                                             <div class="form-group">
                                                <label for="">Reject Remark</label>
                                                <input type="text"
                                                   placeholder="Enter Rejection Remark If any"
                                                   class="form-control"
                                                   name="rejection_remark">
                                                <input type="hidden"
                                                   placeholder="Enter Rejection Remark If any"
                                                   readonly class="form-control"
                                                   name="id"
                                                   value="<%$u->id %>">
                                                <input type="hidden"
                                                   placeholder="Enter Rejection Remark If any"
                                                   readonly class="form-control"
                                                   name="qty"
                                                   value="<%$u->qty %>">
                                                <input type="hidden"
                                                   placeholder="Enter Rejection Remark If any"
                                                   readonly class="form-control"
                                                   name="customer_part_id"
                                                   value="<%$u->customer_part_id %>">
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
                                          <button type="submit"
                                             class="btn btn-primary">Save
                                          changes</button>
                                       </div>
                                 </div>
                                 </form>
                              </div>
                           </div>
                        </div>
                     </td>
                     <!-- <td></td> -->
                  </tr>
                  <%assign var='i' value=$i+1 %>
                  <%/foreach%>
            <%/if%>