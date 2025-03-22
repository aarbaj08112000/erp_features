
<div class="wrapper container-xxl flex-grow-1 container-p-y">

<nav aria-label="breadcrumb">
<div class="sub-header-left pull-left breadcrumb">
  <h1>
	Admin
	<a hijacked="yes" href="#stock/issue_request/index" class="backlisting-link" title="Back to Issue Request Listing" >
	  <i class="ti ti-chevrons-right" ></i>
	  <em >Approval</em></a>
  </h1>
  <br>
  <span >Supplier Part Price</span>
</div>
</nav>
<div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5">
	<%if (checkGroupAccess("child_part_supplier_admin","export","No")) %>
<button class="btn btn-seconday" type="button" id="downloadCSVBtn" title="Download CSV"><i class="ti ti-file-type-csv"></i></button>
<button class="btn btn-seconday" type="button" id="downloadPDFBtn" title="Download PDF"><i class="ti ti-file-type-pdf"></i></button>
<%/if%>

</div>

   <div class="content-wrapper" >
      <!-- Content Header (Page header) -->
      <div class="w-100">
            <input type="text" name="reason" placeholder="Filter Search" class="form-control serarch-filter-input m-3 me-0" id="serarch-filter-input" fdprocessedid="bxkoib">
        </div>
      <!-- Main content -->
      <section class="content">
         <div class="">
            <div class="row">
               <div class="col-12">
                  <div class="card">
                     <!-- /.card-header -->
                     <div class="">
                        <table id="example1" class="table table-striped">
                           <thead>
                              <tr>
                                 <!-- <th>Sr. No.</th> -->
                                 <th>Action</th>
                                 <th>Revision Number</th>
                                 <th>Revision Remark</th>
                                 <th>Revision Date</th>
                                 <th>Part Number</th>
                                 <th>Part Description</th>
                                 <th>Tax Structure</th>
                                 <th>With In State</th>
                                 <th>Supplier</th>
                                 <th>Part Price</th>
                                 <th>Quotation Document </th>
                              </tr>
                           </thead>
                           <tbody>
                              <%assign var='i' value=1 %>
							  
                                <%if ($child_part_list)  %>
                                    <%foreach from=$child_part_list item=poo %>
                                 		<%assign var='po' value=$poo->po %>
										 
                                        <%if ($po[0]->admin_approve == "no") %>
                                         	<%assign var='supplier_data' value=$poo->supplier_data %>
                                         	<%assign var='uom_data' value=$poo->uom_data %>
                                            <%assign var='gst_structure2' value=$poo->gst_structure2 %>
				                            <tr>
				                                <!--<td><%$i %></td>-->
				                                <td>
				                                	<%if (checkGroupAccess("child_part_supplier_admin","update","No")) %>
				                                    <button type="submit" data-bs-toggle="modal" class="btn btn-sm " data-bs-target="#exampleModaledit2<%$i %>"> <i class="ti ti-edit"></i></button>
				                                    <div class="modal fade" id="exampleModaledit2<%$i %>" tabindex=" -1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				                                       <div class="modal-dialog " role="document">
				                                          <div class="modal-content">
				                                             <div class="modal-header">
				                                                <h5 class="modal-title" id="exampleModalLabel">Approve Price </h5>
				                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
				                                                <span aria-hidden="true">&times;</span>
				                                                </button>
				                                             </div>
															 <form action="<%base_url('updatechildpart_supplier_admin') %>" method="POST" enctype='multipart/form-data' class="approve-price approve-price<%$i%> custom-form" id="approve-price<%$i%>">
				                                             <div class="modal-body">
															
				                                                   <div class="row">
				                                                      <div class="col-lg-12">
				                                                         <input value="<%$po[0]->id %>" type="hidden" name="id" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Customer Name">
				                                                         <div class="form-group">
				                                                            <label for="po_num">Are You Sure Want to Approve this Price ? </label><span class="text-danger">*</span>
				                                                         </div>
				                                                         <div class="form-group">
				                                                            <label for="po_num">Part Number </label><span class="text-danger">*</span>
				                                                            <input type="text" value="<%$po[0]->part_number  %>" name="upart_number" readonly class="form-control required-input" placeholder="Enter Part Number.">
				                                                         </div>
				                                                         <div class="form-group">
				                                                            <label for="po_num">Part Price </label><span class="text-danger">*</span>
				                                                            <input type="text" value="<%$po[0]->part_rate  %>" name="upart_desc"   class="form-control onlyNumericInput required-input" id="exampleInputEmail1" data-min="0">
				                                                            
				                                                         </div>
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
				                                    <%else%>
				                                    	<%display_no_character("")%>
				                                    <%/if%>
							                     </div>
							                     </td>
							                     <td><%$po[0]->revision_no %></td>
							                     <td><%$po[0]->revision_remark %></td>
							                     <td><%defaultDateFormat($po[0]->revision_date) %></td>
							                     <td><%$po[0]->part_number %></td>
							                     <td><%$po[0]->part_description %></td>
							                     <td><%$gst_structure2[0]->code %></td>
							                     <td><%$supplier_data[0]->with_in_state %></td>
							                     <td><%$supplier_data[0]->supplier_name %></td>
							                     <td><%$po[0]->part_rate %></td>
							                     <td>
							                     <%if (!empty($po[0]->quotation_document)) %>
							                     	<a href="<%base_url('documents/') %><%$po[0]->quotation_document %>" download>Download </a>
							                     <%/if%>
							                     </td>
							                </tr>
				                        <%assign var='i' value=$i+1 %>
				                        <%/if%>
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

  <script type="text/javascript">
  var base_url = <%$base_url|@json_encode%>
  </script>

  <script src="<%$base_url%>public/js/admin/child_part_supplier_admin.js"></script>
