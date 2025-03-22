<div class="wrapper container-xxl flex-grow-1 container-p-y">
<div class="content-wrapper">
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
                <span class="hide-menu">Year</span>
                <span class="search-show-hide float-right"><i class="ti ti-minus"></i></span>
              </li>
              <li class="sidebar-item">
                <div class="input-group">
                  <select required name="created_year" id="created_year_search" class="form-control select2">
                     <option value="">Select Year</option>
                     <%for $foo=2022 to 2027%>
                        <option <%if ($foo == $created_year)%>selected <%/if%> value="<%$foo %>"><%$foo %></option>
                     <%/for%>
                  </select>
                </div>
              </li>
              <li class="nav-small-cap">
                <span class="hide-menu">Month</span>
                <span class="search-show-hide float-right"><i class="ti ti-minus"></i></span>
              </li>
              <li class="sidebar-item">
                <div class="input-group">
                  <select required name="created_month" id="created_month_search"
                           class="form-control select2">
                        <option value="">Select Month</option>
                        <%foreach from=$month_arr item=month%>
                            <option <%if ($month['month_number'] == $created_month) %>selected<%/if%> value="<%$month['month_number'] %>"><%$month['month_data'] %>
                        </option>
                        <%/foreach%>
                  </select>
                </div>
              </li>
            </div>
            <div class="filter-row">
              <li class="nav-small-cap">
                <span class="hide-menu">Sales Invoice Date</span>
                <span class="search-show-hide float-right"><i class="ti ti-minus"></i></span>
              </li>
              <li class="sidebar-item">
                <div class="input-group">
                <input type="text" name="datetimes" class="dates form-control" id="date_range_filter" />
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
   <div class="sub-header-left pull-left breadcrumb">
        <h1>
          Production
          <a hijacked="yes" href="javascript:void(0)" class="backlisting-link" title="Back to Issue Request Listing">
            <i class="ti ti-chevrons-right"></i>
            <em>Sharing Issue Request</em></a>
        </h1>
        <br>
        <span>Sharing Issue Request
</span>
      </div>
      <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5">
        <%if checkGroupAccess("sharing_issue_request","add","No")%>
          <button type="button" class="btn btn-seconday" data-bs-toggle="modal"
                              data-bs-target="#addPromo">Add Request</button>
        <%/if%>
        <%if checkGroupAccess("sharing_issue_request","export","No")%>
          <button class="btn btn-seconday" type="button" id="downloadCSVBtn" title="Download CSV"><i class="ti ti-file-type-csv"></i></button>
          <button class="btn btn-seconday" type="button" id="downloadPDFBtn" title="Download PDF"><i class="ti ti-file-type-pdf"></i></button>
        <%/if%>
        <button class="btn btn-seconday filter-icon" type="button"><i class="ti ti-filter" ></i></i></button>
        <button class="btn btn-seconday" type="button"><i class="ti ti-refresh reset-filter"></i></button>
    </div>
   <section class="content">
      <div>
         <div class="row">
            <br>
            <div class="col-lg-12">
               <div class="modal fade" id="addPromo" tabindex="-1" role="dialog"
                  aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog  modal-dialog-centered" role="document">
                     <div class="modal-content">
                        <div class="modal-header">
                           <h5 class="modal-title" id="exampleModalLabel">Add</h5>
                           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                           
                           </button>
                        </div>
                        <form action="<%base_url('add_sharing_issue_request') %>"
                                 method="POST" enctype="multipart/form-data" id="add_sharing_issue_request" class="custom-form">
                        <div class="modal-body">
                           <div class="form-group">
                              
                           </div>
                           <div class="form-group">
                           <label for="on click url"> Part
                           Number/Description/Thickness/Weight<span
                              class="text-danger">*</span></label>
                           <select  name="child_part_id" id="" class="form-control select2 required-input" style="width: 100%;">
                           <%if ($child_part) %>
                                <%foreach from=$child_part item=c %>
                                    <%if ($c->sub_type == "RM") %>
			                           <option value="<%$c->id %>">
			                           <%$c->part_number %> / <%$c->part_description %> / <%$c->thickness %> / <%$c->weight %>
			                           </option>
		                           <%/if%>
	                            <%/foreach%>
                           <%/if%>
                           </select>
                           </div>
                           <div class="form-group">
                           <label for="on click url">QTY<span
                              class="text-danger">*</span></label>
                           <input type="text" min="1" step="any" value="1" name="qty" 
                              class="form-control onlyNumericInput required-input">
                           </div>
                           <div class="form-group">
                           <label for="on click url">Sharing Strip</label>
                           <textarea name="sharing_strip" class="form-control " id="" rows="2"
                              placeholder="Enter Sharing Strip"></textarea>
                           </div>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                           data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                        </form>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="card">
                  
                  <div class="">
                     <table width="100%" border="1" cellspacing="0" cellpadding="0" class="table table-striped" style="border-collapse: collapse;" border-color="#e1e1e1" id="inwarding_grn">
                       <thead>
                           <tr>
                               <%foreach from=$data key=key item=val%>
                               <th><b>Search <%$val['title']%></b></th>
                               <%/foreach%>
                           </tr>
                       </thead>
                       <tbody></tbody>
                   </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- /.container-fluid -->
   </section>
</div>
  <script>
    var column_details =  <%$data|json_encode%>;
    var page_length_arr = <%$page_length_arr|json_encode%>;
    var is_searching_enable = <%$is_searching_enable|json_encode%>;
    var is_top_searching_enable =  <%$is_top_searching_enable|json_encode%>;
    var is_paging_enable =  <%$is_paging_enable|json_encode%>;
    var is_serverSide =  <%$is_serverSide|json_encode%>;
    var no_data_message =  <%$no_data_message|json_encode%>;
    var is_ordering =  <%$is_ordering|json_encode%>;
    var sorting_column = <%$sorting_column%>;
    var api_name =  <%$api_name|json_encode%>;
    var base_url = <%$base_url|json_encode%>;
    var start_date = <%$start_date|json_encode%>;
    var end_date = <%$end_date|json_encode%>;
</script>

  <script src="<%$base_url%>public/js/production/sharing_issue_request.js"></script>
