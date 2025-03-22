<!-- DONE AROUND UNIT -->
<%assign var="entitlements" value=$session_data['entitlements']%>
<div class="wrapper" >
<div class="content-wrapper">
   <section class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1>Item Master</h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">item part List</li>
               </ol>
            </div>
         </div>
      </div>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-12">
               <!-- /.card -->
               <div class="card">
                  <div class="card-header">
                     <h3 class="card-title">
                     </h3>
                  </div>
                  <div class="card-body">
                     <form action="<%base_url('view_child_part_view_by_filter')%>" method="POST"
                        enctype="multipart/form-data">
                        <div class="row">
                           <div class="col-lg-4">
                              <div style="width: 400px;">
                                 <div class="form-group">
                                    <label for="on click url">Select Part Number <span
                                       class="text-danger">*</span></label> <br>
                                    <select name="child_part_id" class="form-control select2" required>
                                       <option value="ALL">All</option>
                                       <%foreach from=$supplier_part_list item=supplier_part%>
                                       <option <%if ($filter_child_part_id === $supplier_part->id) %>selected<%/if%> value="<%$supplier_part->id %>"><%$supplier_part->part_number%>/<%$supplier_part->part_description %>
                                       </option>
                                       <%/foreach%>
                                    </select>
                                 </div>
                              </div>
                           </div>
                           <div class="col-lg-4">
                              <label for="">&nbsp;</label> <br>
                              <button class="btn btn-secondary">Search </button>
                           </div>
                        </div>
                     </form>
                     <table id="example1" class="table table-bordered table-striped">
                        <thead>
                           <tr>
                              <th>Sr. No.</th>
                              <th>Part Number</th>
                              <th>Part Description</th>
                              <th>Safety/buffer Stock</th>
                              <th>HSN Code</th>
                              <th>Purchase Item Category </th>
                              <th>Store Rack Location</th>
                              <th>UOM</th>
                              <th>Update UOM</th>
                              <th>Max PO QTY </th>
                              <th>Stock Rate </th>
                              <%if ($entitlements['isSheetMetal']!=null) %>
                              <th>Weight</th>
                              <th>Size</th>
                              <th>Thickness</th>
                              <%/if%>
                              <th>Grade</th>
                              <th>Inward Inspection</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           <%assign var="i" value=1%>
                           <%if count($child_part_master) > 0 %>
                           <%foreach from=$child_part_master item=po%>
                           <tr>
                              <td><%$i%></td>
                              <td><%$po->part_number %></td>
                              <td><%$po->part_description%></td>
                              <td><%$po->safty_buffer_stk %></td>
                              <td><%$po->hsn_code %></td>
                              <td><%$po->sub_type %></td>
                              <td><%$po->store_rack_location %></td>
                              <td><%$po->uom_name %></td>
                              <td>
                                 <!-- Button trigger modal -->
                                 <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#edit<%$i%>">
                                 <i class='far fa-edit'></i>
                                 </button>
                                 <!-- edit Modal -->
                                 <div class="modal fade" id="edit<%$i%>" tabindex="-1"
                                    role="dialog" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                       <div class="modal-content">
                                          <div class="modal-header">
                                             <h5 class="modal-title" id="exampleModalLabel">Update
                                             </h5>
                                             <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                             <span aria-hidden="true">&times;</span>
                                             </button>
                                          </div>
                                          <div class="modal-body">
                                             <div class="row">
                                                <div class="col-lg-6">
                                                   <form
                                                      action="<%base_url('update_uom_report') %>"
                                                      method="POST" enctype="multipart/form-data">
                                                      <div class="form-group">
                                                         <label> Select UOM</label><span
                                                            class="text-danger">*</span>
                                                         <input type="hidden" readonly
                                                            value="<%$po->childPartId %>"
                                                            name="id" required
                                                            class="form-control"
                                                            id="exampleInputEmail1"
                                                            placeholder="Enter Safty/buffer stock"
                                                            aria-describedby="emailHelp">
                                                         <select class="form-control select2"
                                                            name="uom_id" style="width: 100%;">
                                                            <%foreach from=$uom item=c%>
                                                            <option <%if ($c->id == $po->uom_id)%>selected <%/if%> value="<%$c->id%>">
                                                               <%$c->uom_name%>
                                                            </option>
                                                            <%/foreach%>
                                                         </select>
                                                      </div>
                                                </div>
                                                <div class="col-lg-6">
                                                </div>
                                             </div>
                                          </div>
                                          <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary"
                                             data-dismiss="modal">Close</button>
                                          <button type="submit" class="btn btn-primary">Save
                                          changes</button>
                                          </form>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <!-- edit Modal -->
                              </td>
                              <td><%$po->max_uom %></td>
                              <td><%$po->store_stock_rate %></td>
                              <%if ($entitlements['isSheetMetal']!=null) %>                                                    
                              <td><%$po->weight %></td>
                              <td><%$po->size %></td>
                              <td><%$po->thickness %></td>
                              <%/if%>
                              <td><%$po->grade %></td>
                              <td>
                                 <a class="btn btn-info"
                                    href="<%base_url('raw_material_inspection/')%><%$po->childPartId%>">
                                 View Inward Inspection
                                 </a>
                              </td>
                              <td>
                                 <button type="submit" data-toggle="modal" class="btn btn-sm btn-primary"
                                    data-target="#exampleModal2<%$i%>"> <i
                                    class="fas fa-edit"></i></button>
                                 <div class="modal fade" id="exampleModal2<%$i%>" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                       <div class="modal-content">
                                          <div class="modal-header">
                                             <h5 class="modal-title" id="exampleModalLabel">Update
                                             </h5>
                                             <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                             <span aria-hidden="true">&times;</span>
                                             </button>
                                          </div>
                                          <div class="modal-body">
                                             <form
                                                action="<%base_url('update_child_part_view')%>"
                                                method="POST">
                                                <div class="row">
                                                   <div class="col-lg-12">
                                                      <div class="form-group">
                                                         <label for="part_number">Part
                                                         Number</label><span
                                                            class="text-danger">*</span>
                                                         <input readonly type="text"
                                                            value="<%$po->part_number%>"
                                                            name="part_number" required
                                                            class="form-control"
                                                            id="exampleInputEmail1"
                                                            aria-describedby="emailHelp"
                                                            placeholder="Part Number">
                                                         <input type="hidden" name="id"
                                                            value="<%$po->childPartId %>">
                                                         <input type="hidden" name="filter_child_part_id"
                                                            value="<%$filter_child_part_id %>">
                                                      </div>
                                                      <div class="form-group">
                                                         <label for="Client_name">Part
                                                         Description</label><span
                                                            class="text-danger">*</span>
                                                         <input type="text"
                                                            value="<%$po->part_description  %>"
                                                            name="part_description" required
                                                            class="form-control"
                                                            id="exampleInputEmail1"
                                                            aria-describedby="emailHelp"
                                                            placeholder="Part Description">
                                                      </div>
                                                      <div class="form-group">
                                                         <label for="safty_buffer_stk">Safety
                                                         Buffer Stock</label><span
                                                            class="text-danger">*</span>
                                                         <input type="text"
                                                            value="<%$po->safty_buffer_stk  %>"
                                                            name="saft__stk" required
                                                            class="form-control"
                                                            id="exampleInputEmail1"
                                                            aria-describedby="emailHelp"
                                                            placeholder="Part Specification">
                                                      </div>
                                                      <div class="form-group">
                                                         <label for="hsn_code">HSN
                                                         Code</label><span
                                                            class="text-danger">*</span>
                                                         <input type="text"
                                                            value="<%$po->hsn_code  %>"
                                                            name="hsn_code" required
                                                            class="form-control"
                                                            id="exampleInputEmail1"
                                                            aria-describedby="emailHelp"
                                                            placeholder="Part Specification">
                                                      </div>
                                                      <div class="form-group">
                                                         <label>Purchase Item Category</label><span class="text-danger">*</span>
                                                         <select class="form-control select2" name="sub_type" style="width: 100%;">
                                                            <%if ($po->sub_type == "Regular grn" || $po->sub_type == "RM") %>
                                                            <option value="Regular grn" <%if ($po->sub_type == "Regular grn")%>selected<%/if%> >Regular GRN</option>
                                                            <option value="RM" <%if ($po->sub_type == "RM")%>selected<%/if%> >RM</option>
                                                            <%else if ($po->sub_type == "Subcon grn" || $po->sub_type == "Subcon Regular")%>
                                                            <option value="Subcon grn" <%if ($po->sub_type == "Subcon grn") %>selected<%/if%>>Subcon GRN</option>
                                                            <option value="Subcon Regular" <%if ($po->sub_type == "Subcon Regular") %> selected<%/if%> >Subcon Regular</option>
                                                            <%else if ($po->sub_type == "consumable")%>
                                                            <option value="consumable" <%if ($po->sub_type == "consumable")%> selected<%/if%> >Consumable</option>
                                                            <%else if ($po->sub_type == "customer_bom")%>
                                                            <option value="customer_bom" <%if ($po->sub_type == "customer_bom")%> selected<%/if%> >Customer BOM</option>
                                                            <%else if ($po->sub_type == "asset")%>
                                                            <option value="asset" <%if ($po->sub_type == "asset") %>selected<%/if%> >Asset</option>
                                                            <%/if%>
                                                         </select>
                                                      </div>
                                                      <div class="form-group">
                                                         <label for="store_rack_location">Store
                                                         Rack Location</label><span
                                                            class="text-danger">*</span>
                                                         <input type="text"
                                                            value="<%$po->store_rack_location  %>"
                                                            name="store_rack_location" required
                                                            class="form-control"
                                                            id="exampleInputEmail1"
                                                            aria-describedby="emailHelp"
                                                            placeholder="Part Specification">
                                                      </div>
                                                      <div class="form-group">
                                                         <label for="safty_buffer_stk">UOM
                                                         Name</label><span
                                                            class="text-danger">*</span>
                                                         <input readonly type="text"
                                                            value="<%$c->uom_name%>"
                                                            name="uom_name" required
                                                            class="form-control"
                                                            id="exampleInputEmail1"
                                                            aria-describedby="emailHelp"
                                                            placeholder="Part Specification">
                                                      </div>
                                                      <div class="form-group">
                                                         <label for="max_uom">Max
                                                         UOM</label><span
                                                            class="text-danger">*</span>
                                                         <input type="text"
                                                            value="<%$po->max_uom  %>"
                                                            name="max_uom" required
                                                            class="form-control"
                                                            id="exampleInputEmail1"
                                                            aria-describedby="emailHelp"
                                                            placeholder="Part Specification">
                                                      </div>
                                                      <div class="form-group">
                                                         <label for="max_uom">Store Stock
                                                         Rate</label><span
                                                            class="text-danger">*</span>
                                                         <input type="text"
                                                            value="<%$po->store_stock_rate  %>"
                                                            name="store_stock_rate" required
                                                            class="form-control"
                                                            id="exampleInputEmail1"
                                                            aria-describedby="emailHelp"
                                                            placeholder="Part Specification">
                                                      </div>
                                                      <div class="form-group">
                                                         <label for="max_uom">Weight</label><span
                                                            class="text-danger">*</span>
                                                         <input type="text"
                                                            value="<%$po->weight  %>"
                                                            name="weight" required
                                                            class="form-control"
                                                            id="exampleInputEmail1"
                                                            aria-describedby="emailHelp">
                                                      </div>
                                                      <div class="form-group">
                                                         <label for="max_uom">Size</label><span
                                                            class="text-danger">*</span>
                                                         <input type="text"
                                                            value="<%$po->size  %>"
                                                            name="size" required
                                                            class="form-control"
                                                            id="exampleInputEmail1"
                                                            aria-describedby="emailHelp">
                                                      </div>
                                                      <div class="form-group">
                                                         <label
                                                            for="max_uom">Thickness</label><span
                                                            class="text-danger">*</span>
                                                         <input type="text"
                                                            value="<%$po->thickness  %>"
                                                            name="thickness" required
                                                            class="form-control"
                                                            id="exampleInputEmail1"
                                                            aria-describedby="emailHelp">
                                                      </div>
                                                      <div class="form-group">
                                                         <label for="max_uom">Grade</label><span
                                                            class="text-danger">*</span>
                                                         <input type="text"
                                                            value="<%$po->grade  %>"
                                                            name="grade" required
                                                            class="form-control"
                                                            id="exampleInputEmail1"
                                                            aria-describedby="emailHelp">
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
                                             </form>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </td>
                           </tr>
                           <%assign var="i" value=$i++%>
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