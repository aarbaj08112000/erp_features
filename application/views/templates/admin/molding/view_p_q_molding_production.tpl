   <div class="content-wrapper" >
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
                  <span class="hide-menu">Date</span>
                  <span class="search-show-hide float-right"><i class="ti ti-minus"></i></span>
               </li>
               <li class="sidebar-item">
                  <div class="input-group">
                     <input type="text" id="date_range_filter" class="form-control" placeholder="Name">
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
            <em >Molding Production
            </em></a>
         </h1>
         <br>
         <span >Molding Production View</span>
      </div>
   </nav>
   <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5">
      <%if checkGroupAccess("view_p_q_molding_production","export","No")%>
         <button class="btn btn-seconday" type="button" id="downloadCSVBtn" title="Download CSV"><i class="ti ti-file-type-csv"></i></button>
         <button class="btn btn-seconday" type="button" id="downloadPDFBtn" title="Download PDF"><i class="ti ti-file-type-pdf"></i></button>
      <%/if%>
   <button class="btn btn-seconday filter-icon" type="button"><i class="ti ti-filter" ></i></i></button>
   <button class="btn btn-seconday reset-filter" type="button"><i class="ti ti-refresh "></i></button>
   
   
</div>
<div class="w-100">
<input type="text" name="reason" placeholder="Filter Search" class="form-control serarch-filter-input m-3 me-0" id="serarch-filter-input" fdprocessedid="bxkoib">
</div>
      <div class="card p-0 mt-4 w-100">
         <div class="table-responsive text-nowrap">
         <table id="p_q_molding_production_view" width="100%" border="1" cellspacing="0" cellpadding="0" class="table table-striped" style="border-collapse: collapse;" border-color="#e1e1e1">
         <thead>
            <tr>
               <th>Job Order No</th>
               <th>Part Number / Descriptions </th>
               <th>Date</th>
               <th>Shift</th>
               <th>Machine</th>
               <th>Operator</th>
               <th>Target Production Qty</th>
               <th>Production Ok Qty</th>
               <th>Production Rejection Qty</th>
               <th>Accepted Qty by Quality</th>
               <th>Rejected Qty by Quality</th>
               <th>Onhold Qty</th>
               <th style="word-wrap: break-word;">Wastage / Gattha / Lumps (Kg)</th>
               <th>Status</th>
               <th>Production Minutes</th>
               <th>Downtime In Min</th>
               <!-- <th>Downtime Reason</th> -->
               <th>Setup Time In Min</th>
               <th>Cycle Time In Sec</th>
               <th>Target Prod WT</th>
               <th>Target Runner WT</th>
               <th>Finish Part Weight (gram)</th>
               <th>Runner Weight (gram)</th>
               <!-- <th>Shift Target Qty</th> AROM-105 -->
               <th>Production Efficiency</th>
               <th>Quality Efficiency</th>
               <th>PPM</th>
               <th>OEE</th>
               <!-- <th>Remark</th> -->
               <!-- <th>Accept Reject</th> -->
               <th>Rejection Details</th>
               <th>Downtime Details</th>
               <th>Actions</th>
            </tr>
         </thead>
         <tbody>
            <%include file="molding/molding_production_view.tpl"%>
         </tbody>
      </table>
         </div>
      </div>
   </div>
   <!-- /.row -->
   <!-- Main row -->
   <!-- /.row (main row) -->
</div>
<!-- /.container-fluid -->

<!-- /.content -->
</div>
<script type="text/javascript">
    var base_url = <%$base_url|@json_encode%>;
    var start_date = <%$start_date|@json_encode%>;
    var end_date = <%$end_date|@json_encode%>;
  </script>
<script src="<%$base_url%>public/js/production/p_q_molding_production_view.js"></script>