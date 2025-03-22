
<div class="wrapper">
<!-- Navbar -->
<!-- /.navbar -->
<!-- Main Sidebar Container -->
<!-- Content Wrapper. Contains page content -->
<div class="container-xxl flex-grow-1 container-p-y">
   <!-- Content Header (Page header) -->
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
                  <span class="hide-menu">Filter Date</span>
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
               <a hijacked="yes" href="javascript:void(0)" class="backlisting-link" title="">
               <i class="ti ti-chevrons-right"></i>
               <em>Opening Stock Date Wise</em></a>
            </h1>
            <br>
            <span>Opening Stock Date Wise</span>
         </div>
      </nav>
      <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5">
     <!--  <button class="btn btn-seconday" type="button" id="downloadCSVBtn" title="Download CSV"><i class="ti ti-file-type-csv"></i></button>
      <button class="btn btn-seconday" type="button" id="downloadPDFBtn" title="Download PDF"><i class="ti ti-file-type-pdf"></i></button> -->
      <button class="btn btn-seconday filter-icon" type="button"><i class="ti ti-filter" ></i></i></button>
      <button class="btn btn-seconday" type="button"><i class="ti ti-refresh reset-filter"></i></button>
    </div>
   <!-- Main content -->
   <section class="content">
      <div class="">
         <div class="row">
            <div class="col-12">
               <!-- /.card -->
               <div class="w-100">
			    <input type="text" name="reason" placeholder="Filter Search" class="form-control serarch-filter-input m-3 me-0" id="serarch-filter-input" fdprocessedid="bxkoib">
			  </div>
			  <div class="content-wrapper">
               <div class=" p-0 ms-1">
				   <div class="card-header">
				   	<%assign var='total_store_stock' value=0 %>
				   	<%assign var='total_production_store_stock' value=0 %>
                    <%foreach from=$daily_stock item=value %>
                    	<%assign var='total_store_stock' value=$total_store_stock + $value['stock']*$value['store_stock_rate'] %>
                    	<%assign var='total_production_store_stock' value=$total_production_store_stock + $value['production_stock']*$value['store_stock_rate'] %>
                                 
                    <%/foreach%>
				      <div class="row">
				         <div class="tgdp-rgt-tp-sect ms-2">
				            <p class="tgdp-rgt-tp-ttl">Total Store Stock Value</p>
				            <p class="tgdp-rgt-tp-txt " id="total_store_stock"><%number_format($total_store_stock,2) %></p>
				         </div>
				         <div class="tgdp-rgt-tp-sect">
				            <p class="tgdp-rgt-tp-ttl">Total Production Stock Value</p>
				            <p class="tgdp-rgt-tp-txt " id="total_production_store_stock"><%number_format($total_production_store_stock,2) %></p>
				         </div>
				      </div>
				   </div>
				</div>
				
               <div class="card mt-4 w-100">
                  <!-- Modal -->
                  <div class="">
                     <table id="dailyStock" class="table table-striped">
                        <thead>
                           <tr>
                              <th class="text-left">Part NO</th>
                              <th class="text-left">Part Description</th>
                              <%if ($client_id == "")%>
                              <th class="text-center">Client</th>
                              <%/if%>
                              <th class="text-left">UOM</th>
                              <th class="text-center">Store Stock</th>
                              <th class="text-center">Stock Rate</th>
                              <th class="text-center">Store Stock Value</th>
                              <th class="text-center">Production Stock</th>
                              <th class="text-center">Production Stock Value</th>
                           </tr>
                        </thead>
                        <tbody>
                            <%assign var='i' value=1 %>
                            <%if ($daily_stock) %>
                                <%foreach from=$daily_stock item=value %>
		                           <%if ($client_id == "" || $client_id == $value['clientId']) %>
				                           <tr>
				                              <td class="text-left"><%$value['part_number'] %></td>
				                              <td class="text-left"><%$value['part_description'] %></td>
				                              <%if ($client_id == "") %>
				                              <td class="text-center"><%$client_data[$value['clientId']] %></td>
				                              <%/if%>
				                              <td class="text-left"><%$value['uom_name'] %></td>
				                              <td class="text-center"><%number_format($value['stock'],2) %></td>
				                              <td class="text-center"><%number_format($value['store_stock_rate'],2) %></td>
				                              <td class="text-center"><%number_format($value['stock']*$value['store_stock_rate'],2) %></td>
				                              <td class="text-center"><%number_format($value['production_stock'],2) %></td>
				                              <td class="text-center"><%number_format($value['production_stock']*$value['store_stock_rate'],2) %></td>
				                           </tr> 
                              	<%assign var='i' value=$i+1 %>   
                              	<%/if%>
                                  
                            	<%/foreach%>
                            <%/if%>
                        </tbody>
                     </table>
                  </div>
                  <!-- /.card-body -->
               </div>
               </div>
               <!-- /.card -->
            </div>
            <!-- /.col -->
         </div>
         <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
   </section>
   <!-- /.content -->
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
</style>
<style type="text/css">
    tr.danger-row .due_days_block {
    color: #000 !important;
    background-color: red !important;
    box-shadow: inset 0 0 0 9999px #e84343 !important;
}
.tgdp-rgt-tp-sect {
    float: left;
    width: 25%;
    width: calc(25% - 19px);
    border-radius: 10px;
    background: #fff;
    height: 105px;
    margin-right: 17px;
    padding: 20px;
    display: inline-block;
}
.tgdp-rgt-tp-sect .tgdp-rgt-tp-ttl {

    font-size: 16px !important;
    margin-bottom: 0px;
    color: #000;
    font-size: 18px;
    font-family: "gilroymedium" !important;
    margin: 0;
}
.tgdp-rgt-tp-sect .tgdp-rgt-tp-txt {
    font-weight: 500;
    
    color: #000 !important;
    max-width: 95%;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    color: #000;
    font-size: 26px !important;
    font-family: 'gilroymedium';
    margin: 0;
    display: inline-block;
    line-height: 48px;
    cursor: pointer;
}
</style>
<script>
           var current_date = <%$current_date|@json_encode%>;


	dataTable();       // table = $('#example1').DataTable();
    filter();
   
   
   function dataTable(){
        var data = {};
        table = $("#dailyStock").DataTable({
        dom: "Bfrtilp",
        searching: true,
        // scrollX: true,
        scrollY: true,
        bScrollCollapse: true,
        columnDefs: [{ sortable: false, targets: 7 }],
        pagingType: "full_numbers",
       
        
        });
        $('#serarch-filter-input').on('keyup', function() {
            table.search(this.value).draw();
        });
        $('.dataTables_length').find('label').contents().filter(function() {
                return this.nodeType === 3; // Filter out text nodes
        }).remove();
        setTimeout(function(){
            $(".dataTables_length select").select2({
                minimumResultsForSearch: Infinity
            });
        },1000)

        // global searching for datable 
        $('#serarch-filter-input').on('keyup', function() {
            table.search(this.value).draw();
        });
    } 
   function filter(){
        let that = this;
        $(".search-filter").on("click",function(){
        	serachParams();
        })
        $(".reset-filter").on("click",function(){
            resetFilter();
        })
        $('#date_range_filter').daterangepicker({
    	       singleDatePicker: true,
    	       showDropdowns: true,
    	       autoApply: true,
    	       locale: {
    	           format: 'YYYY-MM-DD' // Change this format as per your requirement
    	       }
    	   });
    }
    function serachParams(){
       var date = $("#date_range_filter").val();
       $.ajax({
             type: "POST",
             url: "ReportsController/get_daily_stock_filter_data",
             data: {
                 filter_date: date,
             },
             success: function (response) {
                 var response = JSON.parse(response);
                 $("#total_production_store_stock").html(response.total_production_store_stock);
                 $("#total_store_stock").html(response.total_store_stock);
                 $('#dailyStock').DataTable().destroy();
                 $("#dailyStock tbody").html(response.html);
                 
            	 dataTable();
                 
             },
             error: function (error) {}
       });
    }
    function resetFilter(){
       $('#date_range_filter').data('daterangepicker').setStartDate(moment().format('YYYY-MM-DD'));
        serachParams()
    }

</script>
</body>
</html>