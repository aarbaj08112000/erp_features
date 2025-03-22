
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
                  <select name="child_part_id" class="form-control select2" id="part_number_search">
                    <option value="">Select Part Number</option>
                    <%foreach from=$supplier_part_list item=parts%>
                    <option value="<%$parts->id%>"><%$parts->part_number %></option>
                    <%/foreach%>
                  </select>
                </div>
              </li>
            </div>
            <div class="filter-row">
              <li class="nav-small-cap">
                <span class="hide-menu">Part Description</span>
                <span class="search-show-hide float-right"><i class="ti ti-minus"></i></span>
              </li>
              <li class="sidebar-item">
                <div class="input-group">
                  <input type="text" id="part_description_search" class="form-control" placeholder="Name">
                </div>
              </li>
            </div>
            <div class="filter-row">
              <li class="nav-small-cap">
                <span class="hide-menu">Name</span>
                <span class="search-show-hide float-right"><i class="ti ti-minus"></i></span>
              </li>
              <li class="sidebar-item">
                <div class="input-group">
                  <input type="text" id="employee_name_search" class="form-control" placeholder="Name">
                </div>
              </li>
            </div>
            <div class="filter-row">
              <li class="nav-small-cap">
                <span class="hide-menu">Name</span>
                <span class="search-show-hide float-right"><i class="ti ti-minus"></i></span>
              </li>
              <li class="sidebar-item">
                <div class="input-group">
                  <input type="text" id="employee_name_search" class="form-control" placeholder="Name">
                </div>
              </li>
            </div>
            <div class="filter-row">
              <li class="nav-small-cap">
                <span class="hide-menu">Name</span>
                <span class="search-show-hide float-right"><i class="ti ti-minus"></i></span>
              </li>
              <li class="sidebar-item">
                <div class="input-group">
                  <input type="text" id="employee_name_search" class="form-control" placeholder="Name">
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
          <span >Operation Data Master</span>
        </div>
      </nav>

      <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5">
        <%if (checkGroupAccess("operations_data","add","No")) %>
        <button type="button" class="btn btn-seconday" data-bs-toggle="modal" data-bs-target="#addPromo" title="Add Operation Data">
         <i class="ti ti-plus"></i>
        </button>
        <%/if%>
        <%if (checkGroupAccess("operations_data","export","No")) %>
        <button class="btn btn-seconday" type="button" id="downloadCSVBtn" title="Download CSV"><i class="ti ti-file-type-csv"></i></button>
        <button class="btn btn-seconday" type="button" id="downloadPDFBtn" title="Download PDF"><i class="ti ti-file-type-pdf"></i></button>
        <%/if%>
      <%*  <button class="btn btn-seconday filter-icon" type="button"><i class="ti ti-filter" ></i></i></button>
        <button class="btn btn-seconday" type="button"><i class="ti ti-refresh reset-filter"></i></button> *%>
        

      </div>

      <div class="modal fade" id="addPromo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Add</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                  </button>
               </div>
               <div class="modal-body">
                  <form action="<%base_url('add_operations_data') %>" method="POST" enctype="multipart/form-data" id="add_operations_data">
                  <div class="row">
                     <div class="form-group col-6">
                        <label for="on click url">Product <span class="text-danger">*</span></label> <br>
                        <input  type="text" name="product" placeholder="Enter Oproduct" class="form-control" value="" id="">
                     </div>
                     <div class="form-group col-6">
                        <label for="on click url">Process <span class="text-danger">*</span></label> <br>
                        <input  type="text" name="process" placeholder="Enter Process" class="form-control" value="" id="">
                     </div>
                     <div class="form-group col-6">
                        <label for="on click url">Specification Tolerance <span class="text-danger">*</span></label> <br>
                        <input  type="text" name="specification_tolerance" placeholder="Enter" class="form-control" value="" id="">
                     </div>
                     <div class="form-group col-6">
                        <label for="on click url">Evalution <span class="text-danger">*</span></label> <br>
                        <input  type="text" name="evalution" placeholder="Enter" class="form-control" value="" id="">
                     </div>
                     <div class="form-group col-6">
                        <label for="on click url">Size <span class="text-danger">*</span></label> <br>
                        <input  type="text" name="size" placeholder="Enter" class="form-control" value="" id="">
                     </div>
                     <div class="form-group col-6">
                        <label for="on click url">Frequency <span class="text-danger">*</span></label> <br>
                        <input  type="text" name="frequency" placeholder="Enter" class="form-control" value="" id="">
                     </div>
                     </div>
               </div>
               <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary">Save changes</button>
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
            <table width="100%" border="1" cellspacing="0" cellpadding="0" class="table table-striped" style="border-collapse: collapse;" border-color="#e1e1e1" id="operations_data">
              <thead>
                 <tr>
                    <th>Sr No</th>
                    <!-- <th>Operation Name</th> -->
                    <th>Product</th>
                    <th>Process</th>
                    <th>Specification Tolerance</th>
                    <th>Evalution</th>
                    <th>Size</th>
                    <th>Frequency</th>
                 </tr>
              </thead>
              <tbody>
                  <%assign var='i' value=1 %>
                  <%foreach from=$operation_data item=u %>
                   <tr>
                      <td><%$i %></td>
                      <!-- <td><?php echo $u->operation_name ?></td> -->
                      <td><%$u->product %></td>
                      <td><%$u->process %></td>
                      <td><%$u->specification_tolerance %></td>
                      <td><%$u->evalution %></td>
                      <td><%$u->size %></td>
                      <td><%$u->frequency %></td>
                   </tr>
                  <%assign var='i' value=$i+1 %>
                  <%/foreach%>
              </tbody>
           </table>
          </div>

        <!--/ Responsive Table -->
      </div>
      <!-- /.col -->


      <div class="content-backdrop fade"></div>
    </div>


    <script type="text/javascript">
    var base_url = <%$base_url|@json_encode%>
    </script>

    <script src="<%$base_url%>public/js/admin/operations_data.js"></script>
