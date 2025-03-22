<%assign var="role" value=trim($session_data['type'])%>
<%assign var="Commodity" value=$session_data['Commodity']%>
<%assign var="entitlements" value=$session_data['entitlements']%>
<%assign var="base_url" value=base_url('')%>
<div id="menu_overlay" class="menu_overlay home-page-boxes <%if $sitemap%>open site-map-contain<%/if%>">
   <div class="new_sitemap_items">
      <div class="headingfix">
         <div class="heading" id="top_heading_fix" style="width: 1666px;">
            <h3 style="padding-left: 40px; width: 97%;">
               <%if $sitemap%>
                  Welcome To ERP System
               <%else%>
                  Quick Menu
               <%/if%>
               
               <div class="color-legend-block" >
                  <span class="quick-menu">Quick</span>
                  <span class="report-menu">Report</span>
                  <span class="master-menu">Master</span>
               </div>
            </h3>
         </div>
      </div>
      <div id="scrollable_content" class="scrollable-content">
         <div class="sitemap-blocks pad-calc-container">
            <div class="sitemap-items" style="position: relative; height: 1597px;">
               <%if checkGroupAccess("pending_po","list","No") || checkGroupAccess("child_parts","list","No") || checkGroupAccess("customer_parts_admin","list","No") || checkGroupAccess("inhouse_parts_admin","list","No") || checkGroupAccess("child_part_supplier_admin","list","No") || checkGroupAccess("supplier","list","No") || checkGroupAccess("client","list","No") || checkGroupAccess("uom","list","No") || checkGroupAccess("gst","list","No") || checkGroupAccess("grades","list","No") || checkGroupAccess("part_family","list","No") || checkGroupAccess("process","list","No") || checkGroupAccess("operations","list","No") || checkGroupAccess("operations_data","list","No") || checkGroupAccess("asset","list","No")%>
               <div class="span3 box ag-col-1" style="width: 25%;">
                  <div class="title">
                     <h4><span class="icon14 "></span>Admin</h4>
                  </div>
                  <div class="content ">
                     <ul class="sitemap">
                        <%if checkGroupAccess("pending_po","list","No")%>
                        <li>
                           <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('pending_po')%>" target="_self" title="Po Approval" class="nav-active-link">
                           Po Approval
                           </a>
                        </li>
                        <%/if%>
                        <%if checkGroupAccess("child_parts","list","No")%>
                        <li>
                           <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('child_parts')%>" target="_self" title="Purchase Stock Update" class="nav-active-link">
                           Purchase Stock Update
                           </a>
                        </li>
                        <%/if%>
                        <%if checkGroupAccess("customer_parts_admin","list","No")%>
                        <li>
                           <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('customer_parts_admin')%>" target="_self" title="Sales Stock Update" class="nav-active-link">
                           Sales Stock Update
                           </a>
                        </li>
                        <%/if%>
                        <%if checkGroupAccess("inhouse_parts_admin","list","No")%>
                        <li>
                           <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('inhouse_parts_admin')%>" target="_self" title="Inhouse Stock Update" class="nav-active-link">
                           Inhouse Stock Update
                           </a>
                        </li>
                        <%/if%>
                        <%if checkGroupAccess("child_part_supplier_admin","list","No")%>
                        <li>
                           <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('child_part_supplier_admin')%>" target="_self" title="Purchase Price Approval" class="nav-active-link">
                          Purchase Price Approval
                           </a>
                        </li>
                        <%/if%>
                        <%if checkGroupAccess("supplier","list","No")%>
                        <li>
                           <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('supplier')%>" target="_self" title="Supplier Approval" class="nav-active-link">
                          Supplier Approval
                           </a>
                        </li>
                        <%/if%>
                        <!-- <%if checkGroupAccess("client","list","No")%>
                        <li>
                           <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('client')%>" target="_self" title="Client Master" class="nav-active-link master-menu">
                          Client Master
                           </a>
                        </li>
                        <%/if%>
                        <%if checkGroupAccess("uom","list","No")%>
                        <li>
                           <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('uom')%>" target="_self" title="UOM Master" class="nav-active-link master-menu">
                          UOM Master
                           </a>
                        </li>
                        <%/if%>
                        <%if checkGroupAccess("gst","list","No")%>
                        <li>
                           <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('gst')%>" target="_self" title="Tax Structure Master" class="nav-active-link master-menu">
                          Tax Structure Master
                           </a>
                        </li>
                        <%/if%>
                        <%if checkGroupAccess("grades","list","No")%>
                        <li>
                           <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('grades')%>" target="_self" title="Grades Master" class="nav-active-link master-menu">
                          Grades Master
                           </a>
                        </li>
                        <%/if%>
                        <%if checkGroupAccess("part_family","list","No")%>
                        <li>
                           <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('part_family')%>" target="_self" title="Part Family" class="nav-active-link master-menu">
                          Part Family
                           </a>
                        </li>
                        <%/if%>
                        <%if checkGroupAccess("process","list","No")%>
                        <li>
                           <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('process')%>" target="_self" title="Process" class="nav-active-link master-menu">
                          Process
                           </a>
                        </li>
                        <%/if%>
                        <%if checkGroupAccess("operations","list","No")%>
                        <li>
                           <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('operations')%>" target="_self" title="Operation No." class="nav-active-link master-menu">
                          Operation No.
                           </a>
                        </li>
                        <%/if%>
                        <%if checkGroupAccess("operations_data","list","No")%>
                        <li>
                           <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('operations_data')%>" target="_self" title="Operations Data" class="nav-active-link master-menu">
                          Operations Data
                           </a>
                        </li>
                        <%/if%>
                        <%if checkGroupAccess("asset","list","No")%>
                        <li>
                           <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('asset')%>" target="_self" title="Operations Data" class="nav-active-link master-menu">
                          Asset
                           </a>
                        </li>
                        <%/if%> -->
                     </ul>
                  </div>
               </div>
               <%/if%>
               <%if checkGroupAccess("new_sales","list","No") || checkGroupAccess("sales_invoice_released","list","No") || checkGroupAccess("customer_po_tracking_all","list","No") || checkGroupAccess("planning_year_page","list","No")  || checkGroupAccess("rejection_invoices","list","No") || checkGroupAccess("customer","list","No") || checkGroupAccess("customer_parts_master","list","No") || checkGroupAccess("customer_master","list","No") ||  checkGroupAccess("consignee","list","No") || checkGroupAccess("sales_report","list","No") || checkGroupAccess("sales_summary_report","list","No") || checkGroupAccess("planing_data_report","list","No") || checkGroupAccess("transporter","list","No") || checkGroupAccess("hsn_report","list","No")%>
               <div class="span3 box ag-col-2" style="width: 25%;">
                  <div class="title">
                     <h4><span class="icon14 "></span>Planning & Sales</h4>
                  </div>
                  <div class="content ">
                     <ul class="sitemap">
                        <%if checkGroupAccess("new_sales","list","No") %>
                        <li>
                           <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('new_sales')%>" target="_self" title="Create Sale Invoice" class="nav-active-link">
                           Create Sale Invoice
                           </a>
                        </li>
                        <%/if%>
                        <%if checkGroupAccess("sales_invoice_released","list","No") %>
                        <li>
                           <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('sales_invoice_released')%>" target="_self" title="E-INVOICE & PDI" class="nav-active-link">
                           E-INVOICE & PDI 
                           </a>
                        </li>
                        <%/if%>
                        <%if checkGroupAccess("customer_po_tracking_all","list","No") %>
                        <li>
                           <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('customer_po_tracking_all')%>" target="_self" title="Sales Order" class="nav-active-link">
                           Sales Order
                           </a>
                        </li>
                        <%/if%>
                        <%if checkGroupAccess("planning_year_page","list","No") %>
                        <li>
                           <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('planning_year_page')%>" target="_self" title="Monthly Schedule" class="nav-active-link">
                           Monthly Schedule
                           </a>
                        </li>
                        <%/if%>
                        <%if checkGroupAccess("planning_shop_order_details","list","No") %>
                        <li>
                           <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('planning_shop_order_details')%>" target="_self" title="Shop Order" class="nav-active-link">
                           Shop Order
                           </a>
                        </li>
                        <%/if%>
                        <!-- <%if checkGroupAccess("rejection_invoices","list","No") %>
                        <li>
                           <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('rejection_invoices')%>" target="_self" title="CN-DN-PI" class="nav-active-link">
                           CN-DN-PI
                           </a>
                        </li>
                        <%/if%> -->
                        <%if checkGroupAccess("sales_report","list","No") %>
                        <li>
                           <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('sales_report')%>" target="_self" title="Sales Report" class="nav-active-link report-menu">
                           Sales Report
                           </a>
                        </li>
                        <%/if%>
                        <%if checkGroupAccess("sales_summary_report","list","No") %>
                        <li>
                           <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('sales_summary_report')%>" target="_self" title="Sales Summary Report" class="nav-active-link report-menu">
                           Sales Summary Report</a>
                        </li>
                        <%/if%>
                        <%if checkGroupAccess("hsn_report","list","No") %>
                        <li>
                           <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('hsn_report')%>" target="_self" title="Hsn Report" class="nav-active-link report-menu">
                           HSN Report 
                           </a>
                        </li>
                        <%/if%>
                        <%if checkGroupAccess("planing_data_report","list","No") %>
                        <li>
                           <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('planing_data_report')%>" target="_self" title="Monthly Schedule Report" class="nav-active-link report-menu">
                           Monthly Schedule Report 
                           </a>
                        </li>
                        <%/if%>
                        <%if checkGroupAccess("customer","list","No") %>
                        <li>
                           <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('customer')%>" target="_self" title="Customers" class="nav-active-link master-menu">
                           Customers
                           </a>
                        </li>
                        <%/if%>
                        <%if checkGroupAccess("customer_parts_master","list","No") %>
                        <li>
                           <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('customer_parts_master')%>" target="_self" title="Part Master" class="nav-active-link master-menu">
                           Part Master
                           </a>
                        </li>
                        <%/if%>
                        <%if checkGroupAccess("customer_master","list","No") %>
                        <li>
                           <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('customer_master')%>" target="_self" title="Customer Master" class="nav-active-link master-menu">
                           Sales Master
                           </a>
                        </li>
                        <%/if%>
                        <!-- <%if checkGroupAccess("consignee","list","No") %>
                        <li>
                           <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('consignee')%>" target="_self" title="Consignee" class="nav-active-link master-menu">
                           Consignee
                           </a>
                        </li>
                        <%/if%> -->
                        <!-- <%if checkGroupAccess("transporter","list","No") %>
                        <li>
                           <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('transporter')%>" target="_self" title="Transporter List" class="nav-active-link master-menu">
                           Transporter List
                           </a>
                        </li>
                        <%/IF%> -->
                     </ul>
                  </div>
               </div>
               <%/if%>
               <%if checkGroupAccess("receivable_report","list","No") || checkGroupAccess("payable_report","list","No")%>
               <div class="span3 box ag-col-1" style="width: 25%;">
                  <div class="title">
                     <h4><span class="icon14 "></span>Accounts</h4>
                  </div>
                  <div class="content ">
                     <ul class="sitemap">
                        <%if checkGroupAccess("receivable_report","list","No")%>
                        <li>
                           <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('receivable_report')%>" target="_self" title="Receivable" class="nav-active-link report-menu">
                           Receivable 
                           </a>
                        </li>
                        <%/if%>
                        <%if checkGroupAccess("payable_report","list","No")%>
                        <li>
                           <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('payable_report')%>" target="_self" title="Payable" class="nav-active-link report-menu">
                           Payable
                           </a>
                        </li>
                        <%/if%>
                        <li>
                           <a hijacked="yes" aria-nav-code="shortcuts" href="javascript:void(0);" target="_self" title="Cash Purchase" class="nav-active-link report-menu">
                           Cash Purchase
                           </a>
                        </li>
                        <li>
                           <a hijacked="yes" aria-nav-code="shortcuts" href="javascript:void(0);" target="_self" title="GST Report" class="nav-active-link">
                           GST Report
                           </a>
                        </li>
                     </ul>
                  </div>
               </div>
               <%/if%>
               <%if checkGroupAccess("new_po_sub","list","No") || checkGroupAccess("new_po_sub","list","No") || checkGroupAccess("new_po_list_supplier","list","No") || checkGroupAccess("approved_supplier","list","No") || checkGroupAccess("child_part_view","list","No") || checkGroupAccess("child_part_supplier_view","list","No") || checkGroupAccess("routing","list","No") || checkGroupAccess("reports_po_balance_qty","list","No") || checkGroupAccess("child_part_supplier_report","list","No") || checkGroupAccess("pending_po","list","No") || checkGroupAccess("expired_po","list","No") || checkGroupAccess("closed_po","list","No") || checkGroupAccess("rejected_po","list","No") %>
               <div class="span3 box ag-col-1" style="width: 25%;">
                  <div class="title">
                     <h4><span class="icon14 "></span>Purchase</h4>
                  </div>
                  <div class="content ">
                     <ul class="sitemap">
                        <%if checkGroupAccess("new_po","list","No")%>
                        <li>
                           <a hijacked="yes"  href="<%base_url('new_po')%>"  class="nav-active-link" title="Purchase PO">
                           Purchase PO
                           </a>
                        </li>
                        <%/if%>
                        <%if checkGroupAccess("new_po_sub","list","No")%>
                        <li>
                           <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('new_po_sub')%>" target="_self" title="Subcon PO" class="nav-active-link">
                           Subcon PO
                           </a>
                        </li>
                        <%/if%>
                        <%if checkGroupAccess("new_po_list_supplier","list","No")%>
                         <li>
                           <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('new_po_list_supplier')%>" target="_self" title="Supplierwise PO List" class="nav-active-link">
                           Supplierwise PO List
                           </a>
                        </li>
                        <%/if%>
                        <%if checkGroupAccess("reports_po_balance_qty","list","No") %>
                         <li >
                           <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('reports_po_balance_qty')%>" target="_self" title="PO Summary Report" class="nav-active-link report-menu">
                           PO Summary Report
                           </a>
                        </li>
                        <%/if%>
                        <%if checkGroupAccess("approved_supplier","list","No")%>
                         <li>
                           <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('approved_supplier')%>" target="_self" title="Approved Suppliers" class="nav-active-link report-menu">
                           Approved Suppliers
                           </a>
                        </li>
                        <%/if%>
                        <%if checkGroupAccess("child_part_supplier_report","list","No")%>
                        <li>
                           <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('child_part_supplier_report')%>" target="_self" title="Approved Suppliers" class="nav-active-link report-menu">
                           Purchase Price Report
                           </a>
                        </li>
                        <%/if%>
                        <%if checkGroupAccess("child_part_view","list","No")%>
                        <li>
                           <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('child_part_view')%>" target="_self" title="Item Master" class="nav-active-link report-menu">
                           Item Master
                           </a>
                        </li>
                        <%/if%>
                        <%if checkGroupAccess("pending_po","list","No")%>
                        <li>
                           <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('pending_po')%>" target="_self" title="PO Under Approval" class="nav-active-link report-menu">
                           PO Under Approval
                           </a>
                        </li>
                        <%/if%>
                        <!-- <%if checkGroupAccess("expired_po","list","No")%>
                        <li>
                           <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('expired_po')%>" target="_self" title="Expired PO" class="nav-active-link report-menu">
                           Expired PO
                           </a>
                        </li>
                        <%/if%>
                        <%if checkGroupAccess("closed_po","list","No")%>
                        <li>
                           <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('closed_po')%>" target="_self" title="PO Under Approval" class="nav-active-link report-menu">
                           Closed PO
                           </a>
                        </li>
                        <%/if%>
                        <%if checkGroupAccess("rejected_po","list","No")%>
                        <li>
                           <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('rejected_po')%>" target="_self" title="Reject PO" class="nav-active-link report-menu">
                           Reject PO
                           </a>
                        </li>
                        <%/if%> -->
                        <%if checkGroupAccess("child_part_view","list","No")%>
                        <li>
                           <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('child_part_view')%>" target="_self" title="Item Master" class="nav-active-link master-menu">
                           Item Master
                           </a>
                        </li>
                        <%/if%>
                        <%if checkGroupAccess("approved_supplier","list","No")%>
                        <li>
                           <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('approved_supplier')%>" target="_self" title="Supplier" class="nav-active-link master-menu">
                           Supplier
                           </a>
                        </li>
                        <%/if%>
                        <%if checkGroupAccess("child_part_supplier_view","list","No")%>
                        <li>
                           <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('child_part_supplier_view')%>" target="_self" title="Purchase Parts Price" class="nav-active-link master-menu">
                           Purchase Parts Price
                           </a>
                        </li>
                        <%/if%>
                        <!-- <%if checkGroupAccess("routing","list","No")%>
                        <li>
                           <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('routing')%>" target="_self" title="Subcon routing" class="nav-active-link master-menu">
                           Subcon routing
                           </a>
                        </li>
                        <%/if%> -->
                     </ul>
                  </div>
               </div>
               <%/if%>
               <%if checkGroupAccess("inwarding","list","No") || checkGroupAccess("grn_validation","list","No") || checkGroupAccess("part_stocks","list","No") || checkGroupAccess("part_stocks_inhouse","list","No") || checkGroupAccess("fw_stock","list","No") || checkGroupAccess("view_add_challan_subcon","list","No") || checkGroupAccess("challan_inward","list","No") || checkGroupAccess("challan_part_return","list","No") || checkGroupAccess("stock_rejection","list","No") || checkGroupAccess("reports_grn","list","No") || checkGroupAccess("supplier_parts_stock_report","list","No") || checkGroupAccess("subcon_supplier_challan_part_report","list","No") || checkGroupAccess("grn_validation","list","No")%>
               <div class="span3 box ag-col-2" style="width: 25%;">
                  <div class="title">
                     <h4><span class="icon14 "></span>Store</h4>
                  </div>
                  <div class="content ">
                     <ul class="sitemap">
                        <%if checkGroupAccess("inwarding","list","No")%>
                        <li>
                           <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('inwarding')%>" target="_self" title="GRN Entry" class="nav-active-link">
                           GRN Entry
                           </a>
                        </li>
                        <%/if%>
                        <%if checkGroupAccess("grn_validation","list","No")%>
                        <li>
                           <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('grn_validation')%>" target="_self" title="GRN Qty Validation" class="nav-active-link">
                           GRN Qty Validation
                           </a>
                        </li>
                        <%/if%>
                        <%if checkGroupAccess("grn_validation","list","No")%>
                        <li>
                           <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('view_add_challan')%>" target="_self" title="Create Challan" class="nav-active-link">
                           Create Challan
                           </a>
                        </li>
                        <%/if%>
                        <%if checkGroupAccess("part_stocks","list","No")%>
                        <li>
                           <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('part_stocks')%>" target="_self" title="Purchase Stock Transfer" class="nav-active-link">
                           Purchase Stock Transfer
                           </a>
                        </li>
                        <%/if%>
                        <%if checkGroupAccess("part_stocks_inhouse","list","No")%>
                        <li>
                           <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('part_stocks_inhouse')%>" target="_self" title="Inhouse Stock Transfer" class="nav-active-link">
                           Inhouse Stock Transfer
                           </a>
                        </li>
                        <%/if%>
                        <%if checkGroupAccess("fw_stock","list","No")%>
                        <li>
                           <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('fw_stock')%>" target="_self" title="FG Stock Transfer" class="nav-active-link">
                           FG Stock Transfer
                           </a>
                        </li>
                        <%/if%>
                        <!-- <%if checkGroupAccess("view_add_challan_subcon","list","No")%>
                        <li>
                           <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('view_add_challan_subcon')%>" target="_self" title="Subcon Challan" class="nav-active-link">
                           Subcon Challan 
                           </a>
                        </li>
                        <%/if%>
                        <%if checkGroupAccess("challan_inward","list","No")%>
                        <li>
                           <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('challan_inward')%>" target="_self" title="Customer Challan Inward" class="nav-active-link">
                           Customer Challan Inward
                           </a>
                        </li>
                        <%/if%> -->
                        <!-- <%if checkGroupAccess("challan_part_return","list","No")%>
                        <li>
                           <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('challan_part_return')%>" target="_self" title="Customer Challan Inward" class="nav-active-link">
                           Customer Challan Outward
                           </a>
                        </li>
                        <%/if%> -->
                        <!-- <%if checkGroupAccess("stock_rejection","list","No") %>
                        <li>
                           <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('stock_rejection')%>" target="_self" title="Stock Rejection" class="nav-active-link">
                           Stock Rejection
                           </a>
                        </li>
                        <%/if%> -->
                        <%if checkGroupAccess("stock_down","list","No")%>
                           <li>
                              <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('stock_down')%>" target="_self" title="Material issue" class="nav-active-link">
                                 MATERIAL REQUISION  
                              </a>
                           </li>
                        <%/if%>
                        <%if checkGroupAccess("stock_up","list","No")%>
                           <li>
                              <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('stock_up')%>" target="_self" title="Stock Up/Return" class="nav-active-link">
                                 Stock Up/Return 
                              </a>
                           </li>
                        <%/if%>
                        <%if checkGroupAccess("sharing_issue_request_store","list","No")%>
                           <li>
                              <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('sharing_issue_request_store')%>" target="_self" title="Sharing Isuue Request - Pending" class="nav-active-link">
                                 Sharing Isuue Request - Pending
                              </a>
                           </li>
                        <%/if%>
                        <%if checkGroupAccess("sharing_issue_request_store_completed","list","No")%>
                           <li>
                              <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('sharing_issue_request_store_completed')%>" target="_self" title="Sharing Isuue Request - Complete" class="nav-active-link">
                                 Sharing Isuue Request - Complete
                              </a>
                           </li>
                        <%/if%>
                        <%if checkGroupAccess("reports_grn","list","No") %>
                        <li>
                           <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('reports_grn')%>" target="_self" title="GRN Report" class="nav-active-link report-menu">
                           GRN Report
                           </a>
                        </li>
                        <%/if%>
                        <%if checkGroupAccess("supplier_parts_stock_report","list","No") %>
                        <li>
                           <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('supplier_parts_stock_report')%>" target="_self" title="Purchase Stock" class="nav-active-link report-menu">
                           Purchase Stock
                           </a>
                        </li>
                        <%/if%>
                        <%if checkGroupAccess("subcon_supplier_challan_part_report","list","No") %>
                        <li>
                           <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('subcon_supplier_challan_part_report')%>" target="_self" title="Subcon Report" class="nav-active-link report-menu">
                           Subcon Report
                           </a>
                        </li>
                        <%/if%>

                     </ul>
                  </div>
               </div>
               <%/if%>
               
               <%if ($entitlements['isPlastic']!=null && (checkGroupAccess("machine_request","list","No") || checkGroupAccess("p_q_molding_production","list","No") || checkGroupAccess("view_p_q_molding_production","list","No") || checkGroupAccess("report_prod_rejection","list","No") || checkGroupAccess("mold_maintenance_report","list","No") || checkGroupAccess("downtime_report","list","No") || checkGroupAccess("machine_request_completed","list","No") || checkGroupAccess("molding_stock_transfer","list","No") || checkGroupAccess("mold_maintenance","list","No")) ) || ($entitlements['isSheetMetal']!=null && (checkGroupAccess("downtime_report","list","No"))) || checkGroupAccess("operator","list","No") || checkGroupAccess("machine","list","No") || checkGroupAccess("downtime_master","list","No") || checkGroupAccess("shifts","list","No") || checkGroupAccess("stock_down","list","No") || (checkGroupAccess("sharing_issue_request","list","No")) || (checkGroupAccess("customer_part_wip_stock_report","list","No")) %>
               <div class="span3 box ag-col-3" style="width: 25%;">
                  <div class="title">
                     <h4><span class="icon14 "></span>Production</h4>
                  </div>
                  <div class="content ">
                     <ul class="sitemap">
                        <%if ($entitlements['isPlastic']!=null) %>
                        <%if checkGroupAccess("machine_request","list","No")%>
                        <li>
                           <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('machine_request')%>" target="_self" title="Material Request" class="nav-active-link">
                           Material Request
                           </a>
                        </li>
                        <%/if%>
                        <%if ( checkGroupAccess("p_q_molding_production","list","No")) %>
                        <li>
                           <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('p_q_molding_production')%>" target="_self" title="Molding Production" class="nav-active-link">
                           Molding Production
                           </a>
                        </li>
                        <%/if%>
                        <%if (checkGroupAccess("view_p_q_molding_production","list","No")) %>
                        <li>
                           <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('view_p_q_molding_production')%>" target="_self" title="Molding Production Approval" class="nav-active-link report-menu">
                           Molding Production Approval
                           </a>
                        </li>
                        <%/if%>
                        <%if (checkGroupAccess("report_prod_rejection","list","No")) %>
                        <li>
                           <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('report_prod_rejection')%>" target="_self" title="Production Rejection Reason" class="nav-active-link report-menu">
                           Production Rejection Reason
                           </a>
                        </li>
                        <%/if%>
                        <%if (checkGroupAccess("mold_maintenance_report","list","No")) %>
                        <li>
                           <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('mold_maintenance_report')%>" target="_self" title="Mold Life Report" class="nav-active-link report-menu">
                           Mold Life Report
                           </a>
                        </li>
                        <%/if%>
                        <%if (checkGroupAccess("downtime_report","list","No")) %>
                        <li>
                           <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('downtime_report ')%>" target="_self" title="Downtime Rport" class="nav-active-link report-menu" >
                           Downtime Report
                           </a>
                        </li>
                        <%/if%>
                        <%if (checkGroupAccess("machine_request_completed","list","No")) %>
                        <li>
                           <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('machine_request_completed')%>" target="_self" title="Material Request Report" class="nav-active-link report-menu">
                           Material Request Report
                           </a>
                        </li>
                        <%/if%>
                        <%if (checkGroupAccess("molding_stock_transfer","list","No")) %>
                        <li>
                           <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('molding_stock_transfer')%>" target="_self" title="Molding Stock Transfer" class="nav-active-link report-menu">
                          Molding Stock Transfer
                           </a>
                        </li>
                        <%/if%>
                        <%/if%>
                        <%if ($entitlements['isSheetMetal']!=null) %>

                           <li>
                              <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('view_p_q')%>" target="_self" title="Production Rport" class="nav-active-link report-menu">
                           Production Report
                              </a> 
                           </li>
                           <li>
                              <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('stock_down')%>" target="_self" title="Shearing Production Rport" class="nav-active-link report-menu">
                           Shearing Production Report
                              </a> 
                           </li>
                           <%if (checkGroupAccess("stock_down","list","No")) %>
                           <li>
                              <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('stock_down')%>" target="_self" title="Material Issue" class="nav-active-link report-menu">
                           Material Issue
                              </a> 
                           </li>
                           <%/if%>
                           <%if (checkGroupAccess("sharing_issue_request","list","No")) %>
                           <li>
                              <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('sharing_issue_request')%>" target="_self" title="Create Sharing Request" class="nav-active-link report-menu">
                           Create Sharing Request
                              </a> 
                           </li>
                           <%/if%>
                           <%if (checkGroupAccess("customer_part_wip_stock_report","list","No")) %>
                           <li>
                              <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('customer_part_wip_stock_report')%>" target="_self" title="Create Sharing Request" class="nav-active-link report-menu">
                           CUSTOMER PART WIP STOCK REPORT
                              </a> 
                           </li>
                           <%/if%>
                           <%if (checkGroupAccess("downtime_report","list","No")) %>
                           <li>
                              <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('downtime_report ')%>" target="_self" title="Downtime Rport" class="nav-active-link report-menu">
                              Downtime Report
                              </a>
                           </li>
                           <%/if%>
                           <li>
                              <a hijacked="yes" aria-nav-code="shortcuts" href="javascript:void(0)" target="_self" title="OEE Rport" class="nav-active-link report-menu">
                              OEE Report
                              </a>
                           </li>
                        <%/if%>
                        <%if ($entitlements['isPlastic']!=null && checkGroupAccess("report_prod_rejection","list","No")) %>
                              <li>
                                 <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('report_prod_rejection')%>" target="_self" title="Production Rejection Report" class="nav-active-link report-menu">
                                    Production Rejection Report
                                 </a>
                           <%/if%>
                        <!-- <%if (checkGroupAccess("operator","list","No")) %>
                        <li>
                           <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('operator')%>" target="_self" title="Operator List" class="nav-active-link master-menu">
                          Operator List
                           </a>
                        </li>
                        <%/if%>
                        <%if (checkGroupAccess("machine","list","No")) %>
                        <li>
                           <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('machine')%>" target="_self" title="Machine List" class="nav-active-link master-menu">
                          Machine List
                           </a>
                        </li>
                        <%/if%> -->
                        <%if ($entitlements['isPlastic'] && checkGroupAccess("mold_maintenance","list","No")) %>
                           <li>
                              <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('mold_maintenance')%>" target="_self" title="Mold Master" class="nav-active-link master-menu">
                             Mold Master
                              </a>
                           </li>
                        <%/if%>
                        <!-- <%if (checkGroupAccess("downtime_master","list","No")) %>
                        <li>
                              <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('downtime_master')%>" target="_self" title="Down Time Reason" class="nav-active-link master-menu">
                             Down Time Reason
                              </a>
                        </li>
                        <%/if%>
                        <%if (checkGroupAccess("shifts","list","No")) %>
                        <li>
                              <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('shifts')%>" target="_self" title="Shift Master" class="nav-active-link master-menu">
                             Shift Master
                              </a>
                        </li>
                        <%/if%> -->
                        
                     </ul>
                  </div>
               </div>
               <%/if%>
               <%if checkGroupAccess("accept_reject_validation","list","No") || ($entitlements['isPlastic']!=null && checkGroupAccess("final_inspection","list","No")) || ($entitlements['isSheetMetal']!=null && checkGroupAccess("final_inspection_qa","list","No")) || checkGroupAccess("remarks","list","No") || checkGroupAccess("stock_rejection","list","No") || checkGroupAccess("reports_incoming_quality","list","No") || checkGroupAccess("reports_inspection","list","No") || checkGroupAccess("grn_rejection","list","No")%>
               <div class="span3 box ag-col-4" style="width: 25%;">
                  <div class="title">
                     <h4><span class="icon14 "></span>Quality</h4>
                  </div>
                  <div class="content ">
                     <ul class="sitemap">
                        <%if checkGroupAccess("accept_reject_validation","list","No")%>
                        <li>
                           <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('accept_reject_validation')%>" target="_self" title="Inward Inspection" class="nav-active-link">
                           Inward Inspection
                           </a>
                        </li>
                        <%/if%>
                        <%if ($entitlements['isPlastic']!=null && checkGroupAccess("final_inspection","list","No")) %>
                           <li>
                              <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('final_inspection')%>" target="_self" title="Final Inspection" class="nav-active-link">
                              Final Inspection
                              </a>
                           </li>
                        <%/if%>
                        <%if ($entitlements['isSheetMetal']!=null && checkGroupAccess("final_inspection_qa","list","No")) %>
                           <li>
                              <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('final_inspection_qa')%>" target="_self" title="FINAL INSPECTION SMF" class="nav-active-link">
                              FINAL INSPECTION SMF
                              </a>
                           </li>
                        <%/if%>
                        <!-- <%if checkGroupAccess("remarks","list","No")%>
                        <li>
                           <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('remarks')%>" target="_self" title="Rejection Reasons" class="nav-active-link">
                           Rejection Reasons
                           </a>
                        </li>
                        <%/if%> -->
                        <!-- <%if checkGroupAccess("stock_rejection","list","No") %>
                        <li>
                           <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('stock_rejection')%>" target="_self" title="Stock Rejection" class="nav-active-link">
                           Stock Rejection
                           </a>
                        </li>
                        <%/if%> -->
                        <%if checkGroupAccess("reports_incoming_quality","list","No")%>
                        <li>
                           <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('reports_incoming_quality')%>" target="_self" title="Incoming Quality Report" class="nav-active-link report-menu">
                           Incoming Quality Report
                           </a>
                        </li>
                        <%/if%>
                        <%if checkGroupAccess("reports_inspection","list","No")%>
                        <li>
                           <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('reports_inspection')%>" target="_self" title="Under Inspection Parts" class="nav-active-link report-menu">
                           Under Inspection Parts Report
                           </a>
                        </li>
                        <%/if%>
                        <%if checkGroupAccess("grn_rejection","list","No")%>
                        <li>
                           <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('grn_rejection')%>" target="_self" title="GRN Rejection" class="nav-active-link report-menu">
                           GRN Rejection
                           </a>
                        </li>
                        <%/if%>

                        <li>
                           <a hijacked="yes" aria-nav-code="shortcuts" href="javascript:void(0)" target="_self" title="PPM REPORT" class="nav-active-link report-menu">
                           PPM REPORT
                           </a>
                        </li>
                        <%if checkGroupAccess("remarks","list","No")%>
                        <li>
                           <a hijacked="yes" aria-nav-code="shortcuts" href="<%base_url('remarks')%>" target="_self" title="Rejection Reasons" class="nav-active-link master-menu">
                           Rejection Reasons
                           </a>
                        </li>
                        <%/if%>
                     </ul>
                  </div>
               </div>
               <%/if%>
               
               
               
              
              
            </div>
            <div class="clear"></div>
         </div>
      </div>
   </div>
</div>