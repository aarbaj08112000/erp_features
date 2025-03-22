
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
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

                <span class="hide-menu">Date</span>
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
        <nav aria-label="breadcrumb">
            <div class="sub-header-left pull-left breadcrumb">
                <h1>
                    Report
                    <a hijacked="yes" href="#stock/issue_request/index" class="backlisting-link"
                        title="Back to Issue Request Listing">
                        <i class="ti ti-chevrons-right"></i>
                        <em>Downtime</em></a>
                </h1>
                <br>
                <span>Downtime Report</span>
            </div>
        </nav>
        <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5 listing-btn">
             <button class="btn btn-seconday filter-icon" type="button"><i class="ti ti-filter" ></i></i></button>
      <button class="btn btn-seconday" type="button"><i class="ti ti-refresh reset-filter"></i></button>
        </div>
        <div class="card p-0 mt-4">
            <div class="card-header">
                <div class="row">
                    <div class="tgdp-rgt-tp-sect">
                        <p class="tgdp-rgt-tp-ttl">Total Downtime In Min</p>
                        <p class="tgdp-rgt-tp-txt text-danger">
                            <%$total_down_time %>
                        </p>
                    </div>
                    <div class="tgdp-rgt-tp-sect">
                        <p class="tgdp-rgt-tp-ttl">Maximum downtime on machine</p>
                        <p class="tgdp-rgt-tp-txt">
                            <%$max_down_time_machine %>
                        </p>
                    </div>
                    <div class="tgdp-rgt-tp-sect">
                        <p class="tgdp-rgt-tp-ttl">Maximum Down Time for reason</p>
                        <p class="tgdp-rgt-tp-txt" title="<%$supplier_data[0]->location %>">
                            <%$max_down_time_reason %>
                        </p>
                    </div>
                    <div class="tgdp-rgt-tp-sect">
                    </div>
                    <div class="tgdp-rgt-tp-sect">
                        
                        

                    </div>

                </div>
            </div>
        </div>
         <div class="card p-0 mt-4">
            <div class="tabTitle position-relative">
                <h2 id="cc_sh_sys_static_field_3" class="w-100 " style="margin: 0px !important;">
                    <span class="w-50 float-start p-4">Display more details</span>
                    <div class="w-50 float-start p-3 icon-block">
                		<i id="showIcon" class="ti ti-circle-minus float-end fs-2" style="cursor: pointer; display: none;"></i>
                    	<i id="hideIcon" class="ti ti-circle-plus float-end fs-2" style="cursor: pointer; display: inline;"></i>
                	</div>
                </h2>

                <div id="dataAnalysis" style="display: none;">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="card-body" style="text-wrap:nowrap;">
                                            <table id="down_time_table_compair" class="table table-striped w-100">
                                                <thead>
                                                    <tr>
                                                        <th>Downtime Reason </th>
                                                        <th> Downtime In Min </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <%assign var='i' value=1 %>
                                                    <%if ($top_5_down_time) %>
                                                        <%foreach from=$top_5_down_time item='downtime' %>
                                                            <tr>
                                                                <td><%$downtime['reason'] %></td>
                                                                <td><%$downtime['down_time'] %></td>
                                                            </tr>
                                                        	<%assign var='i' value=$i+1%>
                                                       	<%/foreach%>
                                                    <%/if%>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    
                                </div>
                        </div>
                
            </div>
        </div>
        <div class="card p-0 mt-4">
            <div class="card-body p-0">
                <table id="down_time_report" class="table table-striped  w-100">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Date</th>
                                            <th class="text-center">Shift</th>
                                            <th>Machine</th>
                                            <th class="text-center">Downtime(Min)</th>
                                            <th>Downtime Reason</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <%assign var='i' value=1 %>
                                        <%if ($down_time_data) %>
                                            <%foreach from=$down_time_data item='value' %>
                                                <tr>
                                                   
                                                    <td class="text-center"><%$value['date'] %></td>
                                                    <td class="text-center"><%$value['shift_type']%>/<%$value['name'] %></td>
                                                    <td><%$value['machine_name'] %></td>
                                                    <td class="text-center"><%$value['downtime'] %></td>
                                                    <td>
                                                        <%if $value['reason'] != ''%>
                                                            <%$value['reason']%>
                                                        <%else%>
                                                            N/A
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
    </div>
</div>

    <!-- /.content-wrapper -->
    <style type="text/css">
        .filter-row  {
                padding: 20px 20px 0px 20px;
        }
        .filter-row input{
            margin-top: 14px;
            height: 37px;
            padding: 11px;
        }
        .icon-block .ti {
		    font-size: 30px;
		    color: var(--bs-theme-color);
		    cursor: pointer;
		}
    </style>
    <script type="text/javascript">
        var start_date = <%$date_filter['start_date']|@json_encode%>;
        var end_date = <%$date_filter['end_date']|@json_encode%>
    </script>
    
    <script>
       
        document.getElementById("showIcon").addEventListener("click", function() {
            document.getElementById("dataAnalysis").style.display = "none";
            document.getElementById("showIcon").style.display = "none";
            document.getElementById("hideIcon").style.display = "inline";
        });

        document.getElementById("hideIcon").addEventListener("click", function() {
            document.getElementById("dataAnalysis").style.display = "block";
            document.getElementById("showIcon").style.display = "inline";
            document.getElementById("hideIcon").style.display = "none";
        });
    </script>
    <script src="<%$base_url%>public/js/reports/down_time_report.js"></script>
</body>
</html>





	