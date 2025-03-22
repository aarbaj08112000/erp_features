<div  class="wrapper container-xxl flex-grow-1 container-p-y ">
   <!-- Navbar -->
   <!-- /.navbar -->
   <!-- Main Sidebar Container -->
   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="sub-header-left pull-left breadcrumb">
                <h1>
                    Planning &amp; Sales 
                    <a hijacked="yes" href="#stock/issue_request/index" class="backlisting-link" title="Back to Issue Request Listing">
                        <i class="ti ti-chevrons-right"></i>
                        <em>Customer item part</em></a>
                </h1>
                <br>
                <span> Customer Part Bom</span>
            </div>

        <div class="card">
		   <div class="card-header">
		      <div class="row">
		         <div class="tgdp-rgt-tp-sect">
		            <p class="tgdp-rgt-tp-ttl">Part Name</p>
		            <p class="tgdp-rgt-tp-txt">
		               <%$customer[0]->part_number%>
		            </p>
		         </div>
		         <div class="tgdp-rgt-tp-sect">
		            <p class="tgdp-rgt-tp-ttl">Part Description</p>
		            <p class="tgdp-rgt-tp-txt">
		               <%$customer[0]->part_description%>	
		            </p>
		         </div>
		         <div class="col-lg-1">
		            <br>
		         </div>
		         <!-- Button trigger modal -->
		      </div>
		      <!-- Modal -->
		   </div>
		</div>
	<div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5 listing-btn">
             <button type="button" class="btn btn-seconday " data-bs-toggle="modal"
                           data-bs-target="#exampleModal">
                        Add </button>
            <a title="Back To Customer item part" class="btn btn-seconday" href="<%base_url('bom/')%><%$customer[0]->customer_id %>" type="button"><i class="ti ti-arrow-left"></i></a>
        </div>
      <section class="content-header">
         
         <!-- /.container-fluid -->
      </section>
      <!-- Main content -->
      <section class="content">
         <div class="">
            <div class="row">
               <div class="col-12">
                  <!-- /.card -->
                  <div class="card">
                     <div class="">
                        <!-- Button trigger modal -->
                      
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                           aria-labelledby="exampleModalLabel" aria-hidden="true">
                           <div class="modal-dialog modal-dialog-centered" role="document">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                       aria-label="Close">
                                    </button>
                                 </div>
                                 <div class="modal-body">
                                    <form action="<%base_url('addbom') %>" method="POST" id="addbom" class="addbom custom-form">
                                       <div class="row">
                                          <div class="col-lg-12">
                                             <div class="form-group">
                                                <label> item part </label><span
                                                   class="text-danger">*</span>
                                                <select class="form-control select2 required-input"
                                                   name="child_part_id" style="width: 100%;">
                                                   <%foreach from=$child_part_list item=c1 %>
                                                   <option value="<%$c1->id %>">
                                                      <%$c1->part_number %>/<%$c1->part_description %>
                                                   </option>
                                                   <%/foreach%>
                                                </select>
                                             </div>
                                             <div class="form-group">
                                                <label for="po_num">Quantity</label><span
                                                   class="text-danger">*</span>
                                                <input type="text" step="any" name="quantity" 
                                                   class="form-control onlyNumericInput required-input" id="exampleInputEmail1"
                                                   placeholder="Enter Quantity"
                                                   aria-describedby="emailHelp">
                                                <input type="hidden" name="customer_part_id"
                                                   value="<%$customer[0]->id %>" required
                                                   class="form-control" id="exampleInputEmail1"
                                                   placeholder="Enter Quantity"
                                                   aria-describedby="emailHelp">
                                             </div>
                                          </div>
                                       </div>
                                       <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary"
                                             data-bs-dismiss="modal">Close</button>
                                          <button type="submit" class="btn btn-primary">Save
                                          changes</button>
                                       </div>
                                    </form>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                </div>
                <div class="card p-0 mt-4">
                     <!-- /.card-header -->
                     <div class="">
                        <table id="bom_part" class="table  table-striped w-100">
                           <thead>
                              <tr>
                                 <!--<th>Sr. No.</th>
                                  <th>Customer Part Number</th> -->
                                 <th>Item part Number</th>
                                 <th>Item part Description</th>
                                 <th>Quantity</th>
                                 <th>UOM</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              <%assign var=i value=1 %>
                              <%if ($bom_list) %>
                                <%foreach from=$bom_list item=po %>
                              <tr>
                                 <!--<td><%$i %></td>-->
                                 <td><%$po->part_number %></td>
                                 <td><%$po->part_description %></td>
                                 <td><%$po->quantity %></td>
                                 <td><%$po->uom_name %></td>
                                 <td>
                                    <a type="submit" data-bs-toggle="modal" class=""
                                       data-bs-target="#exampleModaledit2<%$i %>"> <i
                                       class="ti ti-edit"></i></a>
                                    <div class="modal fade"
                                       id="exampleModaledit2<%$i %>" tabindex=" -1" role="dialog"
                                       aria-labelledby="exampleModalLabel" aria-hidden="true">
                                       <div class="modal-dialog modal-dialog-centered" role="document">
                                          <div class="modal-content">
                                             <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Update
                                                   Oeration
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                   aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                             </div>
                                             <div class="modal-body">
                                                <form action="<%base_url('updatebom') %>"
                                                   method="POST" id="updatebom<%$i %>" class="updatebom updatebom<%$i %> custom-form">
                                                   <div class="row">
                                                      <div class="col-lg-12">
                                                         <div class="form-group">
                                                            <input value="<%$po->id %>"
                                                               type="hidden" name="id" required
                                                               class="form-control"
                                                               id="exampleInputEmail1"
                                                               aria-describedby="emailHelp"
                                                               placeholder="Customer Name">
                                                            <input
                                                               value="<%$customer[0]->id %>"
                                                               type="hidden" name="customer_id"
                                                               required class="form-control"
                                                               id="exampleInputEmail1"
                                                               aria-describedby="emailHelp"
                                                               placeholder="Customer Name">
                                                         </div>
                                                         <div class="form-group">
                                                            <label> item part </label><span
                                                               class="text-danger">*</span>
                                                            <select class="form-control select2 required-input"
                                                               name="child_part_id"
                                                               style="width: 100%;">
                                                               <%foreach from=$child_part_list item=c1 %>
                                                               <option <%if ($c1->id == $po->child_part_id) %>selected<%/if%> 
                                                                  value="<%$c1->id %>">
                                                                  <%$c1->part_number%>/<%$c1->part_description%>
                                                               </option>
                                                               <%/foreach%>
                                                            </select>
                                                         </div>
                                                         <div class="form-group">
                                                            <label
                                                               for="po_num">Quantity</label><span
                                                               class="text-danger">*</span>
                                                            <input type="text" step="any"
                                                               value="<%$po->quantity %>"
                                                               name="quantity" 
                                                               class="form-control required-input onlyNumericInput"
                                                               id="exampleInputEmail1"
                                                               placeholder="Enter Quantity"
                                                               aria-describedby="emailHelp">
                                                         </div>
                                                      </div>
                                                   </div>
                                             </div>
                                             <div class="modal-footer">
                                             <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                             <button type="submit" class="btn btn-primary">Save
                                             changes</button>
                                             </div>
                                             </form>
                                          </div>
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
<script src="<%$base_url%>/public/js/planning_and_sales/bom_by_id.js"></script>