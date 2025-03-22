
<div class="content-wrapper">
  <!-- Content -->

  <div class="container-xxl flex-grow-1 container-p-y">
   

    <nav aria-label="breadcrumb">
      <div class="sub-header-left pull-left breadcrumb">
        <h1>
          Store
          <a hijacked="yes" href="" class="backlisting-link">
            <i class="ti ti-chevrons-right" ></i>
            <em >Challan</em></a>
          </h1>
          <br>
          <span >Challan Subcon</span>
        </div>
      </nav>
      <!-- <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Basic Tables</h4> -->

      <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5">
        <%if checkGroupAccess("view_add_challan_subcon","export","No")%>
          <button class="btn btn-seconday" type="button" id="downloadCSVBtn" title="Download CSV"><i class="ti ti-file-type-csv"></i></button>
          <button class="btn btn-seconday" type="button" id="downloadPDFBtn" title="Download PDF"><i class="ti ti-file-type-pdf"></i></button>
         <%/if%>
         <%if checkGroupAccess("view_add_challan_subcon","add","No")%>
          <button type="button" class="btn btn-seconday" title="Add Challan Subcon" data-bs-toggle="modal" data-bs-target="#exampleModal">
          <i class="ti ti-plus"></i> </button>
        <%/if%>
        <!-- <button class="btn btn-seconday" type="button"><i class="ti ti-refresh reset-filter"></i></button> -->
      </div>

      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add Challan Subcon</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

              </button>
            </div>
            <div class="modal-body">
              <form action="javascript:void(0)" class="custom-form add_challan_subcon" method="post">
                <!-- <div class="form-group">
                  <label for="Enter Challan Number">Challan Number <span class="text-danger">*</span> </label>
                  <input type="text" name="challan_number" placeholder="Challan Number " required class="form-control">
                  </div> -->
                <div class="row">
                  <div class="col-lg-12">
                    <div class="form-group">
                      <label for="Enter Challan Number">Select Customer <span class="text-danger">*</span> </label>
                      <select class="form-control select2 required-input" name="customer_id" style="width: 100%;">
                        <%if ($customer) %>
                            <%foreach from=$customer item=c %>
                            <option value="<%$c->id %>">
                              <%$c->customer_name %>
                            </option>
                        <%/foreach%>
                        <%/if%>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="form-group">
                      <label for="">Enter Customer Challan Number <span class="text-danger">*</span></label>
                      <input type="text" placeholder="Enter Remark" value="" name="customer_challan_number" class="form-control required-input">
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="form-group">
                      <label for="">Enter Remark <span class="text-danger">*</span></label>
                      <input type="text" placeholder="Enter Remark" value="" name="remark" class="form-control required-input">
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="form-group">
                      <label for="">Enter Mode Of Transport <span class="text-danger">*</span></label>
                      <input type="text" placeholder="Enter Mode Of Transport" value="" name="mode" class="form-control required-input">
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="form-group">
                      <label for="">Enter Transporter <span class="text-danger">*</span></label>
                      <input type="text" placeholder="Enter Transporter" value="" name="transpoter" class="form-control required-input">
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="form-group">
                      <label for="">Enter Vehicle No. <span class="text-danger">*</span></label>
                      <input type="text" placeholder="Enter Vehicle No" value="" name="vechical_number" class="form-control required-input">
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="form-group">
                      <label for="">Enter L.R No <span class="text-danger">*</span> </label>
                      <input type="text" placeholder="Enter L.R No" value="" name="l_r_number" class="form-control required-input">
                    </div>
                  </div>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save
            changes</button>
            </div>
          </div>
          </form>
        </div>
      </div>
      <div class="w-100">
            <input type="text" name="reason" placeholder="Filter Search" class="form-control serarch-filter-input m-3 me-0" id="serarch-filter-input" fdprocessedid="bxkoib">
        </div>
      <!-- Main content -->
      <div class="card p-0 mt-4 w-100">
        <div class="table-responsive text-nowrap">
          <table width="100%" border="1" cellspacing="0" cellpadding="0" class="table table-striped" style="border-collapse: collapse;" border-color="#e1e1e1" id="view_add_challan_subcon">
            <thead>
              <tr>
                <!--<th>Sr. No.</th> -->
                <!-- <th>Action</th> -->
                <th>Challan Number</th>
                <th>Remark</th>
                <th>Vehicle Number</th>
                <th>Mode Of Transport</th>
                <th>Transporter</th>
                <th>L.R number</th>
                <th>View Details</th>
              </tr>
            </thead>
            <tbody>
                <%assign var='i' value=1%>
                <%if ($challan) %>
                    <%foreach from=$challan item=c %>
                      <tr>
                     <!-- <td><%$i %></td> -->  
                      <td><%$c->challan_number %></td>
                      <td><%$c->remark %></td>
                      <td><%$c->vechical_number %></td>
                      <td><%$c->mode %></td>
                      <td><%$c->transpoter %></td>
                      <td><%$c->l_r_number %></td>
                      <td>
                        <a class="btn btn-primary" href="<%base_url('view_challan_by_id_subcon/') %><%$c->id %>">View
                        Details</a>
                      </td>
                    </tr>
                    <%assign var='i' value=$i+1%>
                  <%/foreach%>
                <%/if%>
            </tbody>
          </table>
        </div>
      </div>
      <!--/ Responsive Table -->
    </div>
    <!-- /.col -->


    <div class="content-backdrop fade"></div>
  </div>



  <script type="text/javascript">
  var base_url = <%$base_url|@json_encode%>
  </script>
  <script src="<%$base_url%>public/js/store/view_add_challan_subcon.js"></script>
