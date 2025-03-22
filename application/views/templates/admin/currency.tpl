<style>
.modal-body {
    max-height: 600px; /* Adjust the height as needed */
    overflow-y: auto;
}
</style>
<div class="content-wrapper">
  <!-- Content -->

  <div class="container-xxl flex-grow-1 container-p-y">
    <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme filter-popup-block" style="width: 0px;">
      <div class="app-brand demo justify-content-between">
        <a href="javascript:void(0)" class="app-brand-link">
          <span class="app-brand-text demo menu-text fw-bolder ms-2">Filter</span>
        </a>
        <div class="close-filter-btn d-block filter-popup cursor-pointer">
          <i class="ti ti-x fs-8"></i>
        </div>
      </div>
      <nav class="sidebar-nav scroll-sidebar filter-block" data-simplebar="init">
        <div class="simplebar-content" >
          <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <div class="filter-row">
              <li class="nav-small-cap">
                <span class="hide-menu">Part Number</span>
                <span class="search-show-hide float-right"><i class="ti ti-minus"></i></span>
              </li>
              <li class="sidebar-item">
                <div class="input-group">
                <select name="clientUnit" id="clientId" class="form-control select2" id="">
                <%foreach from=$client_list item=cl %>
                <option <%if ($filter_client === $cl->id) %>selected<%/if%>
                  value="<%$cl->client_unit %>"><%$cl->client_unit %>
                </option>
                <%/foreach%>
              </select>
                </div>
              </li>
            </div>
          </ul>
        </div>
      </nav>
      <div class="filter-popup-btn">
        <button class="btn btn-outline-danger reset-filter">Reset</button>
        <button class="btn btn-primary search-filter">Search</button>
      </div>
    </aside>

    <nav aria-label="breadcrumb">
      <div class="sub-header-left pull-left breadcrumb">
        <h1>
          Admin
          <a hijacked="yes" href="javascript:void(0)" class="backlisting-link" title="Back to Issue Request Listing" >
            <i class="ti ti-chevrons-right" ></i>
            <em >Master</em></a>
          </h1>
          <br>
          <span >Currency</span>
        </div>
      </nav>

      <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5">
          <%if (checkGroupAccess("currency","add","No")) %>
          <button type="button" class="btn btn-seconday float-left" title="Add Country" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="ti ti-plus"></i></button>
         
          <%/if%>
        
        <%if (checkGroupAccess("currency","export","No")) %>
        <button class="btn btn-seconday" type="button" id="downloadCSVBtn" title="Download CSV"><i class="ti ti-file-type-csv"></i></button>
        <button class="btn btn-seconday" type="button" id="downloadPDFBtn" title="Download PDF"><i class="ti ti-file-type-pdf"></i></button>
        <%/if%>
        
      </div>

      <div class="modal fade" id="exampleModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered"  role=" document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add Currency</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

              </button>
            </div>
            <div class="modal-body">
              <form action="<%base_url('addCurrency') %>" method="POST" id="addCountry">
                <div class="row">
                 <!-- <div class="col-lg-12"> -->
                    <div class="form-group">
                      <label for="Client_name">Currency Name</label><span class="text-danger">*</span>
                      <input type="text" required name="name"  class="form-control" id="name" aria-describedby="unitHelp" placeholder="Currency Name">
                    </div>
                   

               <!-- </div> -->
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
        <table width="100%" border="1" cellspacing="0" cellpadding="0" class="table table-striped" style="border-collapse: collapse;" border-color="#e1e1e1" id="client">
          <thead>
            <tr>
              <th>Sr. No.</th>
              <th>Currency Name</th>
              
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <%assign var='i' value=1 %>
            <%if ($currency_list) %>
            <%foreach from=$currency_list item=t %>
            <tr>
              <td><%$i %></td>
              <td><%$t->name %></td>
              
              <td>
                <%if (checkGroupAccess("currency","update","No")) %>
                <button type="submit" data-bs-toggle="modal" class="btn no-btn btn-primary edit-part" data-bs-target="#exampleModal2" data-value="<%base64_encode(json_encode($t))%>"> <i class="ti ti-edit"></i></button>
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
                  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Currency</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                        </button>
                      </div>
                      <form action="<%base_url('updateCurrency') %>" method="POST" id="updateCountry">
                      <div class="modal-body">
                          <div class="row">
                            
                          <div class="form-group">
                          <label for="Client_name">Currency Name</label><span class="text-danger">*</span>
                          <input type="text" required name="name"  class="form-control" id="u_name" aria-describedby="unitHelp" placeholder="Currency Name">
                          <input type="hidden"  name="id"  class="form-control" id="u_id" >
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

<script src="<%$base_url%>public/js/admin/currency.js"></script>
