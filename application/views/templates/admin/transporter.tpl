
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
          <span >Transporter</span>
        </div>
      </nav>

      <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5">
         <%if (checkGroupAccess("transporter","add","No")) %>
        <button type="button" class="btn btn-seconday" data-bs-toggle="modal" data-bs-target="#addPromo" title="Add Transporter">
         <i class="ti ti-plus"></i>
        </button>
        <%/if%>
        <%if (checkGroupAccess("transporter","export","No")) %>
        <button class="btn btn-seconday" type="button" id="downloadCSVBtn" title="Download CSV"><i class="ti ti-file-type-csv"></i></button>
        <button class="btn btn-seconday" type="button" id="downloadPDFBtn" title="Download PDF"><i class="ti ti-file-type-pdf"></i></button>
        <%/if%>
    <%*  <button class="btn btn-seconday filter-icon" type="button"><i class="ti ti-filter" ></i></i></button>
        <button class="btn btn-seconday" type="button"><i class="ti ti-refresh reset-filter"></i></button> *%>


      </div>
      <div class="modal fade" id="addPromo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <form id="addTransporterForm" action="<%base_url('add_transporter')%>" method="POST" enctype="multipart/form-data">
      <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Add</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                      <div class="form-group">
                          <label for="name">Transporter Name <span class="text-danger">*</span></label> <br>
                          <input  type="text" name="namess" placeholder="Enter Transporter" class="form-control" id="nameda">
                      </div>
                      <div class="form-group">
                          <label for="transporter_id">Transporter ID <span class="text-danger">*</span></label> <br>
                          <input  type="text" name="transporter_id" placeholder="Enter Transporter ID" class="form-control" pattern="^([0-9]{2}[0-9A-Z]{13})$" oninvalid="this.setCustomValidity('Please enter a valid Transporter no')" onchange="this.setCustomValidity('')" id="transporter_id">
                      </div>
                      <div class="form-group">
                        <label for="transporter_id">Vehicle Number  <span class="text-danger">*</span></label> <br>
                        <input  type="text" name="vehicle_number" placeholder="Enter Vehicle Number" class="form-control" >
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Save changes</button>
                  </div>
              </div>
              </div>
              </form>
  </div>
  

      <div class="w-100">
            <input type="text" name="reason" placeholder="Filter Search" class="form-control serarch-filter-input m-3 me-0" id="serarch-filter-input" fdprocessedid="bxkoib">
        </div>
      <!-- Main content -->
      <div class="card p-0 mt-4 w-100">
        <div class="">

          <div class="table-responsive text-nowrap">
            <table width="100%" border="1" cellspacing="0" cellpadding="0" class="table table-striped" style="border-collapse: collapse;" border-color="#e1e1e1" id="transporter">
              <thead>
                 <tr>
                    <!-- <th>Sr No</th> -->
                    <th>Transporter Name</th>
                    <th>Transporter ID</th>
                    <th>Vehicle Number</th>
                    <th class="text-center">Action</th>
                 </tr>
              </thead>
              <tbody>
                    <%assign var='i' value=1 %>
                    <%foreach from=$transporter item=u %>
                     <tr>
                        <!-- <td><%$i %></td> -->
                        <td><%$u->name %></td>
                        <td><%$u->transporter_id %></td>
                        <td><%display_no_character($u->vehicle_number) %></td>
                        <td class="text-center">
                          <%if (checkGroupAccess("transporter","export","No")) %>
                           <a data-bs-toggle="modal" data-bs-target="#updateTranspotor" class="edit-trasportor " data-id="<%$u->id %>" data-name="<%$u->name %>" data-transporter-id="<%$u->transporter_id %>" data-vehicle-number="<%$u->vehicle_number %>"><i class="ti ti-edit"></i></a>
                           <%else%>
                              <%display_no_character() %>
                           <%/if%>

                           
                        </td>
                     </tr>
                    <%assign var='i' value=$i+1 %>
                    <%/foreach%>
              </tbody>
           </table>
          </div>
        </div>
        <!--/ Responsive Table -->
      </div>
       <div class="modal fade" id="updateTranspotor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog  modal-dialog-centered" role="document">
                                         <div class="modal-content">
                                            <div class="modal-header">
                                               <h5 class="modal-title" id="exampleModalLabel">Update EPR Users</h5>
                                               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                               </button>
                                            </div>
                                            <form id="updateTransporterForm" action="<%base_url('update_transporter')%>" method="POST" enctype="multipart/form-data"> 
                                            <div class="modal-body">
                                              <input type="hidden" name="id" id="uid">
                                               <div class="form-group">
                                                  <label for="name">Transporter Name <span class="text-danger">*</span></label> <br>
                                                  <input required type="text" name="namess" placeholder="Enter Transporter" class="form-control" id="uname">
                                                </div>
                                                <div class="form-group">
                                                    <label for="transporter_id">Transporter ID <span class="text-danger">*</span></label> <br>
                                                    <input required type="text" name="transporter_id" placeholder="Enter Transporter ID" id="utransporter_id" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="transporter_id">Vehicle Number  <span class="text-danger">*</span></label> <br>
                                                    <input required type="text" name="vehicle_number" placeholder="Enter Vehicle Number" class="form-control" id="uvehicle_number">
                                                </div>
                                               
                                               <div class="modal-footer">
                                               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                               <button type="submit" class="btn btn-primary">Save changes</button>
                                               </form>
                                               </div>
                                            </div>
                                         </div>
                                      </div>
      <!-- /.col -->


      <div class="content-backdrop fade"></div>
    </div>


    <script type="text/javascript">
    var base_url = <%$base_url|@json_encode%>
    </script>

    <script src="<%$base_url%>public/js/admin/transporter.js"></script>
