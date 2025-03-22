
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
            <em >Downtime Details</em></a>
          </h1>
          <br>
          <span >Downtime Details</span>
        </div>
      </nav>

      <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5">
        <button class="btn btn-seconday" type="button" id="downloadCSVBtn" title="Download CSV"><i class="ti ti-file-type-csv"></i></button>
        <button class="btn btn-seconday" type="button" id="downloadPDFBtn" title="Download PDF"><i class="ti ti-file-type-pdf"></i></button>
        <button class="btn btn-seconday filter-icon" type="button"><i class="ti ti-filter" ></i></i></button>
        <button class="btn btn-seconday" type="button"><i class="ti ti-refresh reset-filter"></i></button>

        <button type="button" class="btn btn-seconday float-left" data-bs-toggle="modal" data-bs-target="#exampleModal" title="Add Downtime">
          <i class="ti ti-plus"></i></button>
          <a class="btn btn-seconday" href="<%base_url('p_q_molding_production') %>"><i class="ti ti-arrow-left"></i> </a>
        </div>

        <div class="modal fade" id="exampleModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role=" document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Downtime</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Cancel">

                </button>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-12">
                    <form action="<%base_url('add_downtime_details') %>" method="POST">
                      <div class="form-group">
                        <label for="">Downtime Reason</label>
                        <select name="downtime_reason" id=""
                        class="form-control select2">
                        <option value="NA">NA</option>
                        ';
                        <%foreach from=$downtime_master item=d %>
                        <option
                        value="<%$d->id %>">
                        <%$d->name %>
                      </option>
                      <%/foreach%>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="">Downtime in Min</label>
                    <input type="text"
                    name="downtime"
                    value=""
                    class="form-control">
                    <input type="hidden"
                    readonly class="form-control"
                    name="molding_production_id"
                    value="<%$molding_production_id %>"
                    >
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


    <!-- Main content -->
    <div class="card p-0 mt-4">

      <div class="row p-4">
        <div class="col-lg-3">
          <div class="form-group">
            <label for="po_num">Customer Name</label>
            <input type="text" readonly value="<%$customer_part_details[0]->customer_name %>" required class="form-control">
          </div>
        </div>
        <div class="col-lg-2">
          <div class="form-group">
            <label for="po_num">Part Number</label>
            <input type="text" readonly value="<%$customer_part_details[0]->part_number %>" required class="form-control">
          </div>
        </div>
        <div class="col-lg-2">
          <div class="form-group">
            <label for="po_num">Part Description</label>
            <input type="text" readonly value="<%$customer_part_details[0]->part_description %>" required class="form-control">
          </div>
        </div>
        <div class="col-lg-2">
          <div class="form-group">
            <label for="date">Date</label>
            <input type="text" readonly value="<%$molding_prod_details[0]->date %>" required class="form-control">
          </div>
        </div>
        <div class="col-lg-1">
          <div class="form-group">
            <label for="po_num">Shift</label><br>
            <label for="po_num">

              <%$molding_prod_details[0]->shift_type%>/<%$molding_prod_details[0]->shift_name %></label>
              <!-- <input type="text" readonly value="<%$molding_prod_details[0]->shift_type%>/<%$molding_prod_details[0]->shift_name%>" class="form-control"> -->

            </div>
          </div>
          <div class="col-lg-2">
            <div class="form-group">
              <label for="po_num">Machine</label>
              <input type="text" readonly value="<%$molding_prod_details[0]->name %>" required class="form-control">
            </div>
          </div>
        </div>

        <div class="table-responsive text-nowrap">
          <table width="100%" border="1" cellspacing="0" cellpadding="0" class="table table-striped" style="border-collapse: collapse;" border-color="#e1e1e1" id="downtime_details">
            <thead>
              <tr>
                <th>Sr. No.</th>
                <th>Downtime Reason</th>
                <th>Downtime in Min</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <%assign var='i' value=1 %>
              <%if ($downtime_details) %>
              <%foreach from=$downtime_details item=r %>
              <tr>
                <td><%$i %></td>
                <td><%$r->name %></td>
                <td><%$r->downtime %></td>
                <td>
                  <button type="submit" data-bs-toggle="modal" class="btn no-btn" data-bs-target="#exampleModal2<%$i %>"> <i class="ti ti-edit"></i></button>
                  <div class="modal fade" id="exampleModal2<%$i %>" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Update Downtime</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cancel">

                          </button>
                        </div>
                        <div class="modal-body">
                          <form action="<%base_url('update_downtime_details') %>" method="POST">
                            <div class="form-group">
                              <label for="">Downtime Reason</label>
                              <select name="downtime_reason" id=""
                              class="form-control select2">
                              <option value="NA">NA</option>
                              ';
                              <%foreach from=$downtime_master item=dm %>
                              <option
                              value="<%$dm->id %>"
                              <%if ($r->downtime_reasonKy == $dm->id)
                              %>selected <%/if%> >
                              <%$dm->name %>
                            </option>
                            <%/foreach%>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="">Downtime in Min</label>
                          <input type="text"
                          name="downtime"
                          value="<%$r->downtime %>"
                          class="form-control">
                          <input type="hidden"
                          readonly class="form-control"
                          name="molding_production_id"
                          value="<%$molding_production_id %>">
                          <input type="hidden"
                          readonly class="form-control"
                          name="id"
                          value="<%$r->id %>">
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
              <button type="submit" data-bs-toggle="modal" class="btn no-btn" data-bs-target="#exampleModal3<%$i %>"> <i class="ti ti-trash"></i></button>
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

                    </button>
                  </div>
                  <form action="<%base_url('delete') %>" method="POST">
                    <div class="modal-body">
                      <input value="<%$r->id %>" name="id" type="hidden" required class="form-control">
                      <input value="mold_production_downtime_details" name="table_name" type="hidden" required class="form-control">
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




<script src="<%$base_url%>public/js/production/downtime_details.js"></script>
