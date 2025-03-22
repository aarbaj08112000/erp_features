
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
          Production
          <a hijacked="yes" href="javascript:void(0)" class="backlisting-link" title="Back to Issue Request Listing" >
            <i class="ti ti-chevrons-right" ></i>
            <em >Rejection Details
            </em></a>
          </h1>
          <br>
          <span >Rejection Details</span>
        </div>
      </nav>

      <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5">
        <button class="btn btn-seconday" type="button" id="downloadCSVBtn" title="Download CSV"><i class="ti ti-file-type-csv"></i></button>
        <button class="btn btn-seconday" type="button" id="downloadPDFBtn" title="Download PDF"><i class="ti ti-file-type-pdf"></i></button>
        <button class="btn btn-seconday filter-icon" type="button"><i class="ti ti-filter" ></i></i></button>
        <button class="btn btn-seconday" type="button"><i class="ti ti-refresh reset-filter"></i></button>

        <button type="button" title="Add Rejection" class="btn btn-seconday float-left" data-bs-toggle="modal" data-bs-target="#exampleModal">
          <i class="ti ti-plus"></i>
        </button>
        <%assign var='base_url' value='p_q_molding_production' %>
        <%if ($view_page != 'add' ) %>
        <%assign var='base_url' value='view_p_q_molding_production' %>
        <%/if%>
        <a class="btn btn-seconday" href="<%base_url($base_url) %>"><i class="ti ti-arrow-left"></i> </a>

      </div>

      <div
    class="modal fade"
    id="exampleModal"
    role="dialog"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role=" document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Rejection</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cancel">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<%base_url('add_rejection_details') %>" method="POST" id="add_rejection_details" class="add_rejection_details custom-form">
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        
                            <div class="form-group">
                                <label for="">Rejection Reason<span class="text-danger">*</span></label>
                                <select
                                    name="rejection_reason"
                                    id=""
                                    class="form-control select2 required-input"
                                    >
                                    <%foreach from=$reject_remark item=r    %>
                                    <option value="<%$r->id %>">
                                        <%$r->name %>
                                    </option>
                                    <%/foreach%>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="">Rejection Qty<span class="text-danger">*</span></label>
                                <input
                                    type="text"
                                    name="rejection_qty"
                                    
                                    value=""
                                    class="form-control required-input">
                                <input
                                    type="hidden"
                                    readonly="readonly"
                                    class="form-control"
                                    name="molding_production_id"
                                    value="<%$molding_production_id %>">
                            </div>
                            <div class="form-group">
                                <label for="">Cavity</label>
                                <input type="text" name="cavity" value="" class="form-control">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card p-0 mt-4">     
<div class="card-header">
<div class="row">
    <div class="tgdp-rgt-tp-sect">
        <p class="tgdp-rgt-tp-ttl">Customer Name</p>
        <p class="tgdp-rgt-tp-txt">
        <%$customer_part_details[0]->customer_name %>
        </p>
    </div>
    <div class="tgdp-rgt-tp-sect">
        <p class="tgdp-rgt-tp-ttl">Part Number</p>
        <p class="tgdp-rgt-tp-txt">
        <%$customer_part_details[0]->part_number %>
        </p>
    </div>
    <div class="tgdp-rgt-tp-sect">
        <p class="tgdp-rgt-tp-ttl">Part Description</p>
        <p class="tgdp-rgt-tp-txt" title="12">
        <%$customer_part_details[0]->part_description %>
        </p>
    </div>
    <div class="tgdp-rgt-tp-sect">
    <p class="tgdp-rgt-tp-ttl">Supplier Location</p>
    <p class="tgdp-rgt-tp-txt" title="12">
        12
    </p>
</div>
<div class="tgdp-rgt-tp-sect">
    <p class="tgdp-rgt-tp-ttl">Date</p>
    <p class="tgdp-rgt-tp-txt" title="12">
    <%$molding_prod_details[0]->date %>
    </p>
</div>
<div class="tgdp-rgt-tp-sect">
    <p class="tgdp-rgt-tp-ttl">Shift</p>
    <p class="tgdp-rgt-tp-txt" title="12">
    <%$molding_prod_details[0]->shift_type %>/<%$molding_prod_details[0]->shift_name %>
    </p>
</div>
<div class="tgdp-rgt-tp-sect">
    <p class="tgdp-rgt-tp-ttl">Machine</p>
    <p class="tgdp-rgt-tp-txt" title="12">
    <%$molding_prod_details[0]->name %>
    </p>
</div>

</div>
</div>
</div>

                              <!-- Main content -->
                              <div class="card p-0 mt-4">
                                
                                  <div class="table-responsive text-nowrap">
                                    <table width="100%" border="1" cellspacing="0" cellpadding="0" class="table table-striped" style="border-collapse: collapse;" border-color="#e1e1e1" id="rejection_details">
                                      <thead>
                                        <tr>
                                          <th>Sr. No.</th>
                                          <th>Rejection Reason</th>
                                          <th>Rejection Quantity</th>
                                          <th>Cavity</th>
                                          <th>Action</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <%assign var='i' value=1 %>
                                        <%if ($rejection_details) %>
                                        <%foreach from=$rejection_details item=r %>
                                        <tr>
                                          <td><%$i %></td>
                                          <td><%$r->name %></td>
                                          <td><%$r->rejection_qty %></td>
                                          <td><%$r->cavity %></td>
                                          <td>
                                            <a type="submit" data-bs-toggle="modal" class="" data-bs-target="#exampleModal2<%$i %>"> <i class="ti ti-edit"></i></a>
                                            <div class="modal fade" id="exampleModal2<%$i %>" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                              <div class="modal-dialog  modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Update Rejection</h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Cancel">
                                                      <span aria-hidden="true">&times;</span>
                                                    </button>
                                                  </div>
                                                  <form action="<%base_url('update_rejection_details') %>" id="update_rejection_details<%$i %>" class="update_rejection_details update_rejection_details<%$i %> custom-form" method="POST">
                                                  <div class="modal-body">
                                                   
                                                      <div class="form-group">
                                                        <label for="">Rejection Reason<span
                                                          class="text-danger">*</span></label>
                                                          <select name="rejection_reason" id=""
                                                          class="form-control select2 required-input" >
                                                          <%foreach from=$reject_remark item=rr %>
                                                          <option
                                                          value="<%$rr->id %>"
                                                          <%if ($r->rejection_reasonKy == $rr->id)
                                                          %>selected <%/if%> >
                                                          <%$rr->name %>
                                                        </option>
                                                        <%/foreach%>
                                                      </select>
                                                    </div>
                                                    <div class="form-group">
                                                      <label for="">Rejection Qty<span
                                                        class="text-danger">*</span></label>
                                                        <input type="text"
                                                        name="rejection_qty"
                                                        
                                                        value="<%$r->rejection_qty %>"
                                                        class="form-control  required-input">
                                                        <input type="hidden"
                                                        readonly class="form-control"
                                                        name="molding_production_id"
                                                        value="<%$molding_production_id %>">
                                                        <input type="hidden"
                                                        readonly class="form-control"
                                                        name="id"
                                                        value="<%$r->id %>">
                                                      </div>
                                                      <div class="form-group">
                                                        <label for="">Cavity</label>
                                                        <input type="text"
                                                        name="cavity"
                                                        value="<%$r->cavity %>"
                                                        class="form-control">
                                                      </div>
                                                      <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                                      </div>
                                                    </form>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                            <a type="submit" data-bs-toggle="modal" class=" ml-4" data-bs-target="#exampleModal3<%$i %>"> <i class="ti ti-trash"></i></a>
                                            <!-- Button trigger modal -->
                                            <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            Launch demo modal
                                          </button> -->
                                          <!-- Modal -->
                                          <div class="modal fade" id="exampleModal3<%$i %>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cancel">
                                                    <span aria-hidden="true">&times;</span>
                                                  </button>
                                                </div>
                                                <form action="<%base_url('delete') %>" id="delete_row<%$i %>" class="delete_row<%$i %> delete_row" method="POST">
                                                  <div class="modal-body">
                                                    <input value="<%$r->id %>" name="id" type="hidden" required class="form-control">
                                                    <input value="mold_production_rejection_details" name="table_name" type="hidden" required class="form-control">
                                                    Are you sure you want to delete
                                                  </div>
                                                  <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-danger">Delete </button>
                                                  </div>
                                                </form>
                                              </div>
                                            </div>
                                          </div>
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


                            <div class="content-backdrop fade"></div>
                          </div>

                          <script src="<%base_url()%>public/js/production/rejection_details.js"></script>
