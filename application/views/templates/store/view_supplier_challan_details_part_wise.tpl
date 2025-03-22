
<div class="content-wrapper">
  <!-- Content -->

  <div class="container-xxl flex-grow-1 container-p-y">
    

    <nav aria-label="breadcrumb">
      <div class="sub-header-left pull-left breadcrumb">
        <h1>
        Supplier Challan Details
          <a hijacked="yes" href="javascript:void(0)" class="backlisting-link" >
            <i class="ti ti-chevrons-right" ></i>
            <em >Supplier Challan Details Part Wise</em></a>
            
          </h1>
          <br>
          <span >View Supplier Challan Details Part Wise</span>
        </div>
      </nav>
      <!-- <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Basic Tables</h4> -->

      <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5">
        <button class="btn btn-seconday" type="button" id="downloadCSVBtn" title="Download CSV"><i class="ti ti-file-type-csv"></i></button>
        <button class="btn btn-seconday" type="button" id="downloadPDFBtn" title="Download PDF"><i class="ti ti-file-type-pdf"></i></button>
       <!-- <button class="btn btn-seconday filter-icon" type="button"><i class="ti ti-filter" ></i></i></button>
        <button class="btn btn-seconday" type="button"><i class="ti ti-refresh reset-filter"></i></button> -->
        <!-- <a class="btn btn-seconday" href="<%base_url('view_supplier_challan')%>">
        <i class="ti ti-arrow-left" title="Back"></i></a> -->
      </div>



      <!-- Main content -->
      <div class="card p-0 mt-4">
        <div class="table-responsive text-nowrap">
          <table width="100%" border="1" cellspacing="0" cellpadding="0" class="table table-striped" style="border-collapse: collapse;" border-color="#e1e1e1" id="view_supplier_challan_details_part_wise">
            <thead>
              <tr>
                <!-- <th>Sr No</th> -->
                <th>Part Number</th>
                <th>Part Description</th>
                <th>Qty </th>
                <th>Process</th>
                <th>HSN</th>
                <th>Value</th>
                <th>Remaining Qty </th>
              </tr>
            </thead>
            <tbody>
              <%if ($challan_parts) %>
                    <%assign var='final_po_amount' value=0%>
                    <%assign var='i' value=1%>
                    <%foreach from=$challan_parts item=p %>
                  <tr>
                   <!-- <td><%$i %></td> -->
                    <td><%$p->part_number %></td>
                    <td><%$p->part_description %></td>
                    <td><%$p->qty %></td>
                    <td><%$p->process %></td>
                    <td><%$p->hsn %></td>
                    <td><%$p->value %></td>
                    <td><%$p->remaning_qty %></td>
                  </tr>
                  <%assign var='i' value=$i+1%>
                 <%/foreach%>
                <%/if%>
            </tbody>
            <tfoot>
              <%if ($po_parts) %>
                <tr>
                  <th colspan="11">Total</th>
                  <th><%$final_po_amount %></th>
                </tr>
              <%/if%>
            </tfoot>
          </table>

        </div>
      </div>
      <!--/ Responsive Table -->
    </div>
    <!-- /.col -->


    <div class="content-backdrop fade"></div>
  </div>




  <script src="<%$base_url%>public/js/store/view_supplier_challan_details_part_wise.js"></script>
