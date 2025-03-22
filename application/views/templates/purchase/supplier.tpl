<%assign var="entitlements" value=$session_data['entitlements']%>
<!-- Content wrapper -->
<div class="container-xxl flex-grow-1 container-p-y">
   <nav aria-label="breadcrumb">
      <div class="sub-header-left pull-left breadcrumb">
         <h1>
            Purchase
            <a hijacked="yes" href="#stock/issue_request/index" class="backlisting-link" title="Back to Issue Request Listing" >
            <i class="ti ti-chevrons-right" ></i>
            <em >Supplier</em></a>
         </h1>
         <br>
         <span >Supplier List</span>
      </div>
   </nav>
   <div class="dt-top-btn d-grid gap-2 d-md-flex  mb-5 listing-btn">
      <a class="btn btn-seconday" type="button" href="<%base_url('approved_supplier')%>" title="Back To Supplier List"><i class="ti ti-arrow-left" ></i></a>
   </div>
   <!-- <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms/</span> Vertical Layouts</h4> -->
   <div class="row">
      <div class="col-xl-12">
      </div>
   </div>
   <!-- Basic Layout -->
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
                              <th>Supplier Name</th>
                              <th>Supplier Address</th>
                              <th>PAN</th>
                              <th>GST Number</th>
                              <th>State</th>
                              <th>Payment Terms</th>
                              <th>NDA Documents</th>
                              <th>Registration Documents</th>
                              <th>Other Document 1</th>
                              <th>Other Document 2</th>
                              <th>Admin Approval</th>
                              <th>With In State</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                          <tbody>
                           <%assign var='i' value=1 %>
                           <%if ($supplier_list)  %>
                              <%foreach from=$supplier_list item=s %>
                           <tr>
                              <!-- <td><%$i %></td> -->
                              <td><%$s->supplier_name %></td>
                              <!-- <td><?php echo $s->supplier_number; ?></td> -->
                              <td><%$s->location %></td>
                              <!-- <td><php echo $s->email; ?></td>
                                 <td><php echo $s->mobile_no; ?></td> -->
                              <td><%$s->pan_card  %></td>
                              <td><%$s->gst_number  %></td>
                              <td><%$s->state %></td>
                              <td><%$s->payment_terms %></td>
                              <td>
                                 <%if (!empty($s->nda_document)) %>
                                 <a href="<%base_url('documents/') %><%$s->nda_document %>"
                                    download>Download</a>
                                 <%/if%>
                              </td>
                              <td>
                                 <%if (!empty($s->registration_document)) %>
                                 <a href="<%base_url('documents/') %><%$s->registration_document %>"
                                    download>Download</a>
                                 <%/if%>
                              </td>
                              <td>
                                 <%if (!empty($s->other_document_1)) %>
                                 <a href="<%base_url('documents/') %><%$s->other_document_1 %>"
                                    download>Download</a>
                                 <%/if%>
                              </td>
                              <td>
                                 <%if (!empty($s->other_document_2))  %>
                                 <a href="<%base_url('documents/') %><%$s->other_document_2 %>"
                                    download>Download</a>
                                 <%/if%>
                              </td>
                              <td>
                                 <%$s->admin_approve %>
                              </td>
                              <td><%$s->with_in_state %></td>
                              <td>
                                 <%if (checkGroupAccess("supplier","update","No")) %>
                                 <a type="button" data-bs-toggle="modal" class=""
                                    data-bs-target="#exampleModal2<%$i %>"> <i
                                    class="ti ti-edit"></i></a>
                                 <div class="modal fade" id="exampleModal2<%$i %>"
                                    tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                                       <div class="modal-content">
                                          <div class="modal-header">
                                             <h5 class="modal-title" id="exampleModalLabel">Update
                                                Supplier Number
                                             </h5>
                                             <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                             </button>
                                          </div>
                                           <form
                                             action="<%base_url('updateSupplier') %>" method="POST" enctype="multipart/form-data" class="custom-form updateSupplier updateSupplier<%$i %>" id="updateSupplier<%$i %>">
                                          <div class="modal-body">
                                             <div class="row">
                                                <div class="col-lg-6">
                                                  
                                                      <div class="form-group">
                                                         <label for="machine_name">Supplier
                                                         Name</label><span
                                                            class="text-danger">*</span>
                                                         <input value="<%$s->id %>"
                                                            name="id" type="hidden" 
                                                            class="form-control required-input" id="updateName"
                                                            aria-describedby="emailHelp"
                                                            placeholder="Enter Supplier Name">
                                                         <input
                                                            value="<%$s->supplier_name %>"
                                                            readonly name="updateName"
                                                            type="text" required
                                                            class="form-control" id="updateName"
                                                            aria-describedby="emailHelp"
                                                            placeholder="Enter Supplier Name">
                                                      </div>
                                                      <div class="form-group">
                                                         <label for="machine_name">Approve
                                                         Supplier</label><span
                                                            class="text-danger">*</span>
                                                         <select name="admin_approve" 
                                                            id="" class="form-control required-input">
                                                            <option value="accept">accept
                                                            </option>
                                                            <option value="pending">pending
                                                            </option>
                                                         </select>
                                                      </div>
                                                      <div class="form-group">
                                                         <label for="machine_name">Supplier
                                                         Number</label><span
                                                            class="text-danger">*</span>
                                                         <input
                                                            value="<%$s->supplier_number %>"
                                                            readonly name="updateNumber"
                                                            type="text" required
                                                            class="form-control" id="updateName"
                                                            aria-describedby="emailHelp"
                                                            placeholder="Enter Supplier Number">
                                                      </div>
                                                      <div class="form-group">
                                                         <label for="machine_name">Supplier
                                                         Address</label><span
                                                            class="text-danger">*</span>
                                                         <input type="text"
                                                            value="<%$s->location %>"
                                                            name="updatesupplierlocation"
                                                             class="form-control required-input"
                                                            id="exampleInputEmail1"
                                                            aria-describedby="emailHelp"
                                                            placeholder="Enter Supplier Number">
                                                      </div>
                                                      <div class="form-group">
                                                         <label for="machine_name">Supplier
                                                         Mobile Number</label><span
                                                            class="text-danger">*</span>
                                                         <input type="text"
                                                            value="<%$s->mobile_no %>"
                                                            name="updatesupplierMnumber"
                                                             class="form-control required-input onlyNumericInput"
                                                            id="exampleInputEmail1"
                                                            aria-describedby="emailHelp"
                                                            placeholder="Enter Supplier Number">
                                                      </div>
                                                      <div class="form-group">
                                                         <label for="machine_name">Other Document
                                                         2</label>
                                                         <input type="file"
                                                            name="other_document_2"
                                                            class="form-control"
                                                            id="exampleInputEmail1"
                                                            aria-describedby="emailHelp"
                                                            placeholder="Enter Supplier Mobile Number">
                                                         <input type="hidden"
                                                            name="other_document_2_old"
                                                            value="<%$s->other_document_2 %>"
                                                            class="form-control"
                                                            id="exampleInputEmail1"
                                                            aria-describedby="emailHelp"
                                                            placeholder="Enter Supplier Mobile Number">
                                                      </div>
                                                      <div class="form-group">
                                                         <label for="machine_name">Other Document
                                                         3</label>
                                                         <input type="file"
                                                            name="other_document_3"
                                                            class="form-control"
                                                            id="exampleInputEmail1"
                                                            aria-describedby="emailHelp"
                                                            placeholder="Enter Supplier Mobile Number">
                                                         <input type="hidden"
                                                            name="other_document_3_old"
                                                            value="<%$s->other_document_3 %>"
                                                            class="form-control"
                                                            id="exampleInputEmail1"
                                                            aria-describedby="emailHelp"
                                                            placeholder="Enter Supplier Mobile Number">
                                                      </div>
                                                      
                                                      <div class="form-group">
                                                         <label>With in State </label><span
                                                            class="text-danger">*</span>
                                                         <select class="form-control select2 required-input"
                                                            name="with_in_state"
                                                            style="width: 100%;">
                                                            <option <%if ($s->with_in_state == "yes") %>
                                                               selected <%/if%> value="yes">
                                                               Yes
                                                            </option>
                                                            <option <%if ($s->with_in_state == "no") %>selected <%/if%> value="no">No
                                                            </option>
                                                         </select>
                                                      </div>
                                                </div>
                                                <div class="col-lg-6">
                                                <div class="form-group">
                                                <label for="machine_name">Supplier
                                                Email</label>
                                                <input type="email"
                                                   value="<%$s->email %>"
                                                   name="updatesupplierEmail" 
                                                   class="form-control "
                                                   id="exampleInputEmail1"
                                                   aria-describedby="emailHelp"
                                                   placeholder="Enter Supplier Email">
                                                </div>
                                                <div class="form-group">
                                                <label for="customer_location">Add
                                                State</label><span
                                                   class="text-danger">*</span>
                                                <input type="text" name="ustate" 
                                                   value="<%$s->state  %>"
                                                   class="form-control required-input"
                                                   id="exampleInputEmail1"
                                                   aria-describedby="emailHelp"
                                                   placeholder="Add State">
                                                </div>
                                                <div class="form-group">
                                                <label for="customer_location">Add GST
                                                Number</label><span
                                                   class="text-danger">*</span>
                                                <input type="text" name="ugst_no" 
                                                   value="<%$s->gst_number %>"
                                                   class="form-control required-input"
                                                   id="exampleInputEmail1"
                                                   aria-describedby="emailHelp"
                                                   placeholder="Add GST Number">
                                                </div>
                                                <div class="form-group">
                                                <label for="machine_name">Other Document
                                                1</label>
                                                <input type="file" name="other_document_1"
                                                   class="form-control"
                                                   id="exampleInputEmail1"
                                                   aria-describedby="emailHelp"
                                                   placeholder="Enter Supplier Mobile Number">
                                                <input type="hidden"
                                                   name="other_document_1_old"
                                                   value="<%$s->other_document_1 %>"
                                                   class="form-control"
                                                   id="exampleInputEmail1"
                                                   aria-describedby="emailHelp"
                                                   placeholder="Enter Supplier Mobile Number">
                                                </div>
                                                <div class="form-group">
                                                <label for="payment_terms">Payment
                                                Terms</label><span
                                                   class="text-danger">*</span>
                                                <input type="text"
                                                   value="<%$s->payment_terms %>"
                                                   name="upaymentTerms" 
                                                   class="form-control required-input"
                                                   id="exampleInputEmail1"
                                                   aria-describedby="emailHelp"
                                                   placeholder="Payment Terms">
                                                </div>
                                                <div class="form-group">
                                                <label for="machine_name">Upload
                                                Registration Document</label>
                                                <input type="file"
                                                   name="registration_document"
                                                   class="form-control"
                                                   id="exampleInputEmail1"
                                                   aria-describedby="emailHelp"
                                                   placeholder="Enter Supplier Mobile Number">
                                                <input type="hidden"
                                                   name="registration_document_old"
                                                   value="<%$s->registration_document %>"
                                                   class="form-control"
                                                   id="exampleInputEmail1"
                                                   aria-describedby="emailHelp"
                                                   placeholder="Enter Supplier Mobile Number">
                                                </div>
                                                <div class="form-group">
                                                         <label for="machine_name">Upload NDA
                                                         Document</label>
                                                         <input type="file" name="nda_document"
                                                            class="form-control"
                                                            id="exampleInputEmail1"
                                                            aria-describedby="emailHelp"
                                                            placeholder="Enter Supplier Mobile Number">
                                                         <input type="hidden"
                                                            name="nda_document_old"
                                                            class="form-control"
                                                            value="<%$s->nda_document %>"
                                                            id="exampleInputEmail1"
                                                            aria-describedby="emailHelp"
                                                            placeholder="Enter Supplier Mobile Number">
                                                      </div>
                                                </div>
                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                   data-bs-dismiss="modal">Close</button>
                                                <button type="submit"
                                                   class="btn btn-primary">Save
                                                changes</button>
                                                </div>
                                                </form>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <%else%>
                                    <%display_no_character("")%>
                                 <%/if%>
                                 
                              </td>
                           </tr>
                           <%assign var='i' value=$i+1 %>
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
</div>
</div>
</div>
<!-- / Content -->
<div class="content-backdrop fade"></div>
<script type="text/javascript">
   var base_url = <%$base_url|@json_encode%>
</script>
<script src="<%$base_url%>public/js/purchase/supplier_admin.js"></script>
<!-- Content wrapper -->