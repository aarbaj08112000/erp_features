
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
          <span >Scarp Category</span>
        </div>
      </nav>

      <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5">
      	<%if (checkGroupAccess("scrap_category","add","No")) %>
      	<button type="button" class="btn btn-seconday" data-bs-toggle="modal" data-bs-target="#addPromo" title="Add Asset">
         <i class="ti ti-plus"></i>
        </button>
        <%/if%>
      <%if (checkGroupAccess("scrap_category","export","No")) %>
        <button class="btn btn-seconday" type="button" id="downloadCSVBtn" title="Download CSV"><i class="ti ti-file-type-csv"></i></button>
        <button class="btn btn-seconday" type="button" id="downloadPDFBtn" title="Download PDF"><i class="ti ti-file-type-pdf"></i></button>
      <%/if%>
      <%*  <button class="btn btn-seconday filter-icon" type="button"><i class="ti ti-filter" ></i></i></button>
        <button class="btn btn-seconday" type="button"><i class="ti ti-refresh reset-filter"></i></button> *%>
      
      </div>

     
        <div class="w-100">
            <input type="text" name="reason" placeholder="Filter Search" class="form-control serarch-filter-input m-3 me-0" id="serarch-filter-input" fdprocessedid="bxkoib">
        </div>        
      <!-- Main content -->
      <div class="card p-0 mt-4 w-100">
      	<div class="modal fade" id="addPromo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered" role="document">
                                 <div class="modal-content">
                                    <div class="modal-header">
                                       <h5 class="modal-title" id="exampleModalLabel">Add </h5>
                                       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                       </button>
                                    </div>
                                    <form action="<%base_url('add_update_scrap_category') %>" method="POST" id="transfer_scrap_stock<%$i %>" class="transfer_scrap_stock transfer_scrap_stock<%$i %> custom-form">
                                       <div class="modal-body">
                                            <div class="form-group">
												<label>Scrap Category<span class="text-danger">*</span></label> <br>
                                                <input  type="text" step="any" name="scrap_category" placeholder="Enter scarp category" class="form-control  required-input" value="" >
                                            </div>
                                       </div>
                                       <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                          <button type="submit" class="btn btn-danger">Save </button>
                                       </div>
                                    </form>
                                 </div>
                              </div>
                           </div>

          <div class="table-responsive text-nowrap">
        <table width="100%" border="1" cellspacing="0" cellpadding="0" class="table table-striped" style="border-collapse: collapse;" border-color="#e1e1e1" id="scrap_category">
              <thead>
                 <tr>
                    <th>Scrap Category</th>
                    <th class="text-center">Action</th>
                 </tr>
              </thead>
              <tbody>
                  <%assign var='i' value=1 %>
                  <%if ($scrap_category)  %>
                      <%foreach from=$scrap_category item=t %>
                     <tr>
                        <td><%$t->scrap_category %></td>
                        <td class="text-center">
                        <%if (checkGroupAccess("scrap_category","update","No")) %>
                           <button type="submit" data-bs-toggle="modal" class="btn no-btn btn-primary edit-part" data-value="<%base64_encode(json_encode($t))%>" data-bs-target="#exampleModal3<%$i %>" title="Edit"> <i class="ti ti-edit"></i></button>

                           <div class="modal fade" id="exampleModal3<%$i %>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered" role="document">
                                 <div class="modal-content">
                                    <div class="modal-header">
                                       <h5 class="modal-title" id="exampleModalLabel">Edit </h5>
                                       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                       </button>
                                    </div>
                                    <form action="<%base_url('add_update_scrap_category') %>" method="POST" id="transfer_scrap_stock<%$i %>" class="transfer_scrap_stock transfer_scrap_stock<%$i %> custom-form">
                                       <div class="modal-body">
                                          <input value="<%$t->scrap_category_master_id %>" name="scrap_category_id" type="hidden" required class="form-control" aria-describedby="emailHelp" placeholder="">
                                            <div class="form-group">
												<label>Scrap Category<span class="text-danger">*</span></label> <br>
                                                <input  type="text" step="any" name="scrap_category" placeholder="Enter scarp category" class="form-control  required-input" value="<%$t->scrap_category %>" >
                                            </div>
                                       </div>
                                       <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                          <button type="submit" class="btn btn-danger">Save </button>
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
   </div>

      <div class="content-backdrop fade"></div>
    </div>


    <script type="text/javascript">
    var base_url = <%$base_url|@json_encode%>
    </script>

    <script src="<%$base_url%>public/js/admin/scrap_category.js"></script>
