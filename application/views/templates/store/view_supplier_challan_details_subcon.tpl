
<div class="content-wrapper">
  <!-- Content -->

  <div class="container-xxl flex-grow-1 container-p-y">
   
    <nav aria-label="breadcrumb">
      <div class="sub-header-left pull-left breadcrumb">
        <h1>
        Challan
          <a hijacked="yes" href="javascript:void(0)" class="backlisting-link" >
            <i class="ti ti-chevrons-right" ></i>
            <em >Supplier Challan Subcon</em></a>
          </h1>
          <br>
          <span >View Supplier Challan Details Subcon</span>
        </div>
      </nav>
      <!-- <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Basic Tables</h4> -->

      <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5">
       <!--  <button class="btn btn-seconday" type="button" id="downloadCSVBtn" title="Download CSV"><i class="ti ti-file-type-csv"></i></button>
        <button class="btn btn-seconday" type="button" id="downloadPDFBtn" title="Download PDF"><i class="ti ti-file-type-pdf"></i></button>
        <button class="btn btn-seconday filter-icon" type="button"><i class="ti ti-filter" ></i></i></button>
        <button class="btn btn-seconday" type="button"><i class="ti ti-refresh reset-filter"></i></button> -->
        <a class="btn btn-seconday" href="<%base_url('view_supplier_challan_subcon')%>">
              <i class="ti ti-arrow-left" title="Back"></i></a>
      </div>



      <!-- Main content -->
      <div class="card p-0 mt-4">
        <div class="table-responsive text-nowrap">
          <table width="100%" border="1" cellspacing="0" cellpadding="0" class="table table-striped" style="border-collapse: collapse;" border-color="#e1e1e1" id="view_supplier_challan_details_subcon">
            <thead>
              <tr>
                <th>Sr. No.</th>
                <th>Challan Number</th>
                <th>Challan Details</th>
              </tr>
            </thead>
            <tbody>
              <%assign var='i' value= 1 %>
                <%if ($challan_data) %>
                    <%foreach from=$challan_data item=c %>
                  <tr>
                    <td><%$i %></td>
                    <td><%$c->challan_number %></td>
                    <td>
                      <a class="btn btn-primary" href="<%base_url('view_supplier_challan_details_part_wise_subcon/') %><%$c->id %>">View Challan Details</a>
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




  <script src="<%$base_url%>public/js/store/view_supplier_challan_details_subcon.js"></script>
