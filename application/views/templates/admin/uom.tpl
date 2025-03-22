
<div class="content-wrapper">
  <!-- Content -->

  <div class="container-xxl flex-grow-1 container-p-y">
    

    <nav aria-label="breadcrumb">
      <div class="sub-header-left pull-left breadcrumb">
        <h1>
          Admin
          <a hijacked="yes" href="javascript:void(0)" class="backlisting-link" title="Back to Issue Request Listing" >
            <i class="ti ti-chevrons-right" ></i>
            <em >Master</em></a>
          </h1>
          <br>
          <span >UOM</span>
        </div>
      </nav>

      <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5">
      <%if (checkGroupAccess("uom","add","No")) %>
        <button type="button" class="btn btn-seconday float-left" data-bs-toggle="modal" data-bs-target="#exampleModal" title="Add UOM">
         <i class="ti ti-plus"></i></button>
      <%/if%>
      <%if (checkGroupAccess("uom","export","No")) %>
        <button class="btn btn-seconday" type="button" id="downloadCSVBtn" title="Download CSV"><i class="ti ti-file-type-csv"></i></button>
        <button class="btn btn-seconday" type="button" id="downloadPDFBtn" title="Download PDF"><i class="ti ti-file-type-pdf"></i></button>
      <%/if%>
      <%*  <button class="btn btn-seconday filter-icon" type="button"><i class="ti ti-filter" ></i></i></button>
        <button class="btn btn-seconday" type="button"><i class="ti ti-refresh reset-filter"></i></button> *%>
      
      </div>

      <div class="modal fade" id="exampleModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered" role=" document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Add UOM</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                  </button>
               </div>
               <form action="<%base_url('adduom') %>" method="POST" id="add_uom">
               <div class="modal-body">
                     <div class="row">
                        <div class="col-lg-12">
                           <div class="form-group">
                              <label for="contractorName">UOM Name</label><span class="text-danger">*</span>
                              <input type="text" name="uomName" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="UOM Name">
                           </div>
                        </div>
                        <div class="col-lg-12">
                           <div class="form-group">
                              <label for="contractorName">UOM Description</label><span class="text-danger">*</span>
                              <textarea name="uomDescription" required class="form-control" placeholder="UOM Description"></textarea>
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
      </div>

        <div class="w-100">
            <input type="text" name="reason" placeholder="Filter Search" class="form-control serarch-filter-input m-3 me-0" id="serarch-filter-input" fdprocessedid="bxkoib">
        </div>        
      <!-- Main content -->
      <div class="card p-0 mt-4 w-100">


          <div class="table-responsive text-nowrap">
            <table width="100%" border="1" cellspacing="0" cellpadding="0" class="table table-striped" style="border-collapse: collapse;" border-color="#e1e1e1" id="uom">
              <thead>
                 <tr>
                    <th>Sr. No.</th>
                    <th>UOM Name</th>
                    <th>UOM Description</th>
                    <th>Action</th>
                 </tr>
              </thead>
              <tbody>
                  <%assign var='i' value=1 %>
                  <%if ($uom)  %>
                      <%foreach from=$uom item=t %>
                     <tr>
                        <td><%$i %></td>
                        <td><%$t->uom_name %></td>
                        <td><%$t->uom_description %></td>
                        <td>
                        <%if (checkGroupAccess("uom","update","No")) %>
                           <button type="submit" data-bs-toggle="modal" class="btn no-btn btn-primary edit-part" data-value="<%base64_encode(json_encode($t))%>" data-bs-target="#exampleModal2"> <i class="ti ti-edit"></i></button>

                           <div class="modal fade" id="exampleModal3<%$i %>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered" role="document">
                                 <div class="modal-content">
                                    <div class="modal-header">
                                       <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                                       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                                       </button>
                                    </div>
                                    <form action="<%base_url('delete') %>" method="POST">
                                       <div class="modal-body">
                                          <input value="<%$t->id %>" name="id" type="hidden" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Machine Name">
                                          <input value="uom" name="table_name" type="hidden" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Machine Name">
                                          Are you sure you want to delete
                                       </div>
                                       <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                          <button type="submit" class="btn btn-danger">Delete </button>
                                       </div>
                                    </form>
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
        </div>
        <!--/ Responsive Table -->
      </div>
      <!-- /.col -->


      <div class="modal fade" id="exampleModal2" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog  modal-dialog-centered" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Update UOM</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

               </button>
            </div>
            <div class="modal-body">
               <form action="<%base_url('updateuom')%>" method="POST" id="update_uom">
                  <div class="row">
                     <div class="col-lg-12">
                        <div class="form-group">
                           <label for="customer_name">UOM Name</label><span class="text-danger">*</span>
                           <input value="<%$t->uom_name %>" type="text" name="uuomName" required class="form-control" id="uom_name" aria-describedby="emailHelp" placeholder="UOM Name">
                           <input value="<%$t->id %>" type="hidden" name="id" required class="form-control" id="id" aria-describedby="emailHelp" placeholder="Customer Name">
                        </div>
                     </div>
                     <div class="col-lg-12">
                        <div class="form-group">
                           <label for="contractorName">UOM Description</label><span class="text-danger">*</span>
                           <textarea name="uomDescription" value="<%$t->uom_description %>" id="uom_description" required class="form-control" placeholder="UOM Description"><%$t->uom_description %></textarea>
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
   </div>

      <div class="content-backdrop fade"></div>
    </div>


    <script type="text/javascript">
    var base_url = <%$base_url|@json_encode%>
    </script>

    <script src="<%$base_url%>public/js/admin/uom.js"></script>
