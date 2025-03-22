<%if !($session_data['user_id'] > 0) %>
<%redirect('login')%>
<%/if%>
<%assign var="role" value=trim($session_data['type'])%>
<%assign var="user_role" value=trim($session_data['role'])%>
<%assign var="Commodity" value=$session_data['Commodity']%>
<%assign var="entitlements" value=$session_data['entitlements']%>
<%assign var="base_url" value=base_url('')%>
<%if $title  == null %>
<%assign var="title" value="ERP-Management"%>
<%/if%>

<!DOCTYPE html>
<html
   lang="en"
   class="light-style layout-menu-fixed layout-menu-collapsed  layout-navbar-fixed layout-menu-hover"
   dir="ltr"
   data-theme="theme-default"
   data-assets-path="<%$base_url%>public/assets/"
   data-template="vertical-menu-template-free"
   >
   <head>
      <meta charset="utf-8" />
      <meta
         name="viewport"
         content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
         />
      <title>AROM</title>
      <meta name="description" content="" />
      <!-- Favicon -->
      <link rel="icon" type="image/x-icon" href="<%$base_url%>public/assets/img/favicon/favicon.png" />
      <!-- Fonts -->
      <link rel="preconnect" href="https://fonts.googleapis.com" />
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
      <link
         href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
         rel="stylesheet"
         />
      <!-- Icons. Uncomment required icon fonts -->
      <link rel="stylesheet" href="<%$base_url%>public/assets/vendor/fonts/boxicons.css" />
      <!-- tabler css -->

      <link rel="stylesheet" href="<%$base_url%>public/css/plugin/tabler_css/tabler_icons.css">

      <!-- Core CSS -->
      <link rel="stylesheet" href="<%$base_url%>public/assets/vendor/css/core.css" class="template-customizer-core-css" />
      <link rel="stylesheet" href="<%$base_url%>public/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
      <link rel="stylesheet" href="<%$base_url%>public/assets/css/theme.css" />
      <!-- Vendors CSS -->
      <link rel="stylesheet" href="<%$base_url%>public/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
      <link rel="stylesheet" href="<%$base_url%>public/assets/vendor/libs/apex-charts/apex-charts.css" />
      <link rel="stylesheet" href="<%$base_url%>public/css/common.css" />
      <!-- Page CSS -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />
      <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css"> -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
      <!-- <link rel="stylesheet" type="text/css" href="<%$base_url%>public/css/data_table/select.dataTables.min.css"> -->
      <!-- <link rel="stylesheet" type="text/css" href="<%$base_url%>public/css/data_table/jquery.dataTables.min.css"> -->
      <link rel="stylesheet" type="text/css" href="<%$base_url%>public/css/data_table/searchPanes.dataTables.min.css">
      <!-- Helpers -->


      <script src="<%$base_url%>public/assets/vendor/js/helpers.js"></script>
      <script src="<%$base_url%>public/assets/js/config.js"></script>
      <script src="<%$base_url%>public/assets/vendor/js/bootstrap.js"></script>
      <script src="<%$base_url%>public/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
      <script src="<%$base_url%>public/js/admin/plugin/jquery.min.js"></script>
      <script src="<%$base_url%>public/js/admin/plugin/jquery.validate.js"></script>
      <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
      <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
      <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
      <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/pdfmake.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/vfs_fonts.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
      <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/fixedcolumns/3.3.3/js/dataTables.fixedColumns.min.js"></script>
      <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedcolumns/3.3.3/css/fixedColumns.dataTables.min.css">
      <link rel="stylesheet" type="text/css" href="<%$base_url%>public/css/data_table/datatable.css">
      <!-- select2 -->
      <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
      <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

      <!-- toastr -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />
      <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
      <!-- toastr -->

      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
      <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>

      <!-- date picker  -->
      <!-- <script src="https://cdn.jsdelivr.net/npm/moment/min/moment.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
      <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"> -->

      <script type="text/javascript" src="<%base_url()%>public/plugin/datepicker/moment.min.js"></script>
      <script type="text/javascript" src="<%base_url()%>public/plugin/datepicker/daterangepicker.min.js"></script>
      <link rel="stylesheet" type="text/css" href="<%base_url()%>public/plugin/datepicker/daterangepicker.css" />
      <script type="text/javascript">
      var theme_color = "#ea1c31";
   </script>
      <!-- swal toaster 
      <link rel="stylesheet" href="<%$base_url%>public/plugin/sweetalert2/sweetalert2.min.css">
      <script src="<%$base_url%>public/plugin/sweetalert2/sweetalert2.all.min.js"></script>-->
  
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css">
         <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
   </head>
   <body>
      <!-- Layout wrapper -->
      <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container ">
      <!-- Menu -->
      <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme hide">
         <div class="app-brand demo">
            <a href="index.html" class="app-brand-link">
            <span class="app-brand-logo demo">
            <img src="<%$base_url%>public/img/logo.png" alt="" width="30">
            </span>
            <span class="app-brand-text demo menu-text fw-bolder ms-2">AROM</span>

            </a>
            <a href="javascript:void(0);" class="layout-menu-toggle layout-menu-toggle-popup menu-link text-large ms-auto d-block">
            <i class="bx bx-chevron-right bx-sm align-middle"></i>
            </a>
         </div>
         <div class="menu-inner-shadow"></div>
         <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <li class="menu-item active">
               <a href="home" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-home-circle"></i>
                  <div data-i18n="Analytics">Dashboard</div>
               </a>
            </li>
            <!-- Layouts -->
            <li class="menu-item">
               <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <i class="menu-icon tf-icons bx bx-layout"></i>
                  <div data-i18n="Layouts">Home</div>
               </a>
               <ul class="menu-sub">
                  <li class="menu-item">
                     <a href="sidemap" class="menu-link">
                        <div data-i18n="Without menu">Sitemap</div>
                     </a>
                  </li>
                  <li class="menu-item">
                     <a href="form" class="menu-link">
                        <div data-i18n="Without navbar">Form</div>
                     </a>
                  </li>
                  <li class="menu-item">
                     <a href="listing" class="menu-link">
                        <div data-i18n="Without navbar">Listing</div>
                     </a>
                  </li>
                  <li class="menu-item">
                     <a href="form" class="menu-link">
                        <div data-i18n="Without navbar">Shortcuts</div>
                     </a>
                  </li>
                  <li class="menu-item">
                     <a href="layouts-container.html" class="menu-link">
                        <div data-i18n="Container">Custom Dashboard</div>
                     </a>
                  </li>
                  <li class="menu-item">
                     <a href="layouts-fluid.html" class="menu-link">
                        <div data-i18n="Fluid">Watchlist</div>
                     </a>
                  </li>
                  <li class="menu-item">
                     <a href="layouts-blank.html" class="menu-link">
                        <div data-i18n="Blank">Smart Dashboard</div>
                     </a>
                  </li>
               </ul>
            </li>
            <li class="menu-header small text-uppercase">
               <span class="menu-header-text">Management</span>
            </li>
            <li class="menu-item">
               <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <i class="menu-icon tf-icons bx bx-dock-top"></i>
                  <div data-i18n="Account Settings">Item Category</div>
               </a>
               <ul class="menu-sub">
                  <li class="menu-item">
                     <a href="pages-account-settings-account.html" class="menu-link">
                        <div data-i18n="Account">Manufacture</div>
                     </a>
                  </li>
                  <li class="menu-item">
                     <a href="pages-account-settings-notifications.html" class="menu-link">
                        <div data-i18n="Notifications">Brand Master</div>
                     </a>
                  </li>
                  <li class="menu-item">
                     <a href="pages-account-settings-connections.html" class="menu-link">
                        <div data-i18n="Connections">Activity Master</div>
                     </a>
                  </li>
               </ul>
            </li>
            <li class="menu-item">
               <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
                  <div data-i18n="Authentications">Authentications</div>
               </a>
               <ul class="menu-sub">
                  <li class="menu-item">
                     <a href="login" class="menu-link" target="_blank">
                        <div data-i18n="Basic">Login</div>
                     </a>
                  </li>
                  <li class="menu-item">
                     <a href="register" class="menu-link" target="_blank">
                        <div data-i18n="Basic">Register</div>
                     </a>
                  </li>
                  <li class="menu-item">
                     <a href="forget-password" class="menu-link" target="_blank">
                        <div data-i18n="Basic">Forgot Password</div>
                     </a>
                  </li>
               </ul>
            </li>
            <li class="menu-item">
               <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <i class="menu-icon tf-icons bx bx-cube-alt"></i>
                  <div data-i18n="Misc">Finance</div>
               </a>
               <ul class="menu-sub">
                  <li class="menu-item">
                     <a href="pages-misc-error.html" class="menu-link">
                        <div data-i18n="Error">Finance Vouches</div>
                     </a>
                  </li>
                  <li class="menu-item">
                     <a href="pages-misc-under-maintenance.html" class="menu-link">
                        <div data-i18n="Under Maintenance">Asset Classification</div>
                     </a>
                  </li>
               </ul>
            </li>
            <!-- Components -->
            <li class="menu-header small text-uppercase"><span class="menu-header-text">Report</span></li>
            <!-- Cards -->
            <li class="menu-item">
               <a href="cards-basic.html" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-collection"></i>
                  <div data-i18n="Basic">Item Attribute Reports</div>
               </a>
            </li>
            <!-- User interface -->
            <li class="menu-item">
               <a href="javascript:void(0)" class="menu-link menu-toggle">
                  <i class="menu-icon tf-icons bx bx-box"></i>
                  <div data-i18n="User interface">Batch Report</div>
               </a>
               <ul class="menu-sub">
                  <li class="menu-item">
                     <a href="ui-accordion.html" class="menu-link">
                        <div data-i18n="Accordion">Stock Log Report</div>
                     </a>
                  </li>
                  <li class="menu-item">
                     <a href="ui-alerts.html" class="menu-link">
                        <div data-i18n="Alerts">Activity Log</div>
                     </a>
                  </li>
                  <li class="menu-item">
                     <a href="ui-badges.html" class="menu-link">
                        <div data-i18n="Badges">Big Transaction Report</div>
                     </a>
                  </li>
                  <li class="menu-item">
                     <a href="ui-buttons.html" class="menu-link">
                        <div data-i18n="Buttons">User Activity</div>
                     </a>
                  </li>
                  <li class="menu-item">
                     <a href="ui-carousel.html" class="menu-link">
                        <div data-i18n="Carousel">Import logs</div>
                     </a>
                  </li>
               </ul>
            </li>
            <!-- Extended components -->
            <li class="menu-item">
               <a href="javascript:void(0)" class="menu-link menu-toggle">
                  <i class="menu-icon tf-icons bx bx-copy"></i>
                  <div data-i18n="Extended UI">Currencies</div>
               </a>
               <ul class="menu-sub">
                  <li class="menu-item">
                     <a href="extended-ui-perfect-scrollbar.html" class="menu-link">
                        <div data-i18n="Perfect Scrollbar">Currency master</div>
                     </a>
                  </li>
                  <li class="menu-item">
                     <a href="extended-ui-text-divider.html" class="menu-link">
                        <div data-i18n="Text Divider">Currency Conversion Master</div>
                     </a>
                  </li>
               </ul>
            </li>
            <li class="menu-item">
               <a href="icons-boxicons.html" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-crown"></i>
                  <div data-i18n="Boxicons">Imports</div>
               </a>
            </li>
            <!-- Forms & Tables -->
            <li class="menu-header small text-uppercase"><span class="menu-header-text">Resourse & Deliveries</span></li>
            <!-- Forms -->
            <li class="menu-item">
               <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <i class="menu-icon tf-icons bx bx-detail"></i>
                  <div data-i18n="Form Elements">Resourse</div>
               </a>
               <ul class="menu-sub">
                  <li class="menu-item">
                     <a href="forms-basic-inputs.html" class="menu-link">
                        <div data-i18n="Basic Inputs">Sync API logs</div>
                     </a>
                  </li>
                  <li class="menu-item">
                     <a href="forms-input-groups.html" class="menu-link">
                        <div data-i18n="Input groups">System Emails</div>
                     </a>
                  </li>
               </ul>
            </li>
            <li class="menu-item">
               <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <i class="menu-icon tf-icons bx bx-detail"></i>
                  <div data-i18n="Form Layouts">Assign & Track Deliveries</div>
               </a>
               <ul class="menu-sub">
                  <li class="menu-item">
                     <a href="form-layouts-vertical.html" class="menu-link">
                        <div data-i18n="Vertical Form">Delivery Request</div>
                     </a>
                  </li>
                  <li class="menu-item">
                     <a href="form-layouts-horizontal.html" class="menu-link">
                        <div data-i18n="Horizontal Form">Delivery Status</div>
                     </a>
                  </li>
               </ul>
            </li>
            <!-- Tables -->
            <li class="menu-item">
               <a href="tables-basic.html" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-table"></i>
                  <div data-i18n="Tables">Reports</div>
               </a>
            </li>
            <!-- Misc -->
            <li class="menu-header small text-uppercase"><span class="menu-header-text">Misc</span></li>
            <li class="menu-item">
               <a
                  href="https://github.com/themeselection/AROM-html-admin-template-free/issues"
                  target="_blank"
                  class="menu-link"
                  >
                  <i class="menu-icon tf-icons bx bx-support"></i>
                  <div data-i18n="Support">Support</div>
               </a>
            </li>
            <li class="menu-item">
               <a
                  href="https://themeselection.com/demo/AROM-bootstrap-html-admin-template/documentation/"
                  target="_blank"
                  class="menu-link"
                  >
                  <i class="menu-icon tf-icons bx bx-file"></i>
                  <div data-i18n="Documentation">Documentation</div>
               </a>
            </li>
         </ul>
      </aside>

      <div class="main-wrap main-wrap--white main-loader-box" style="display: none;">
         <div class="loader-div"></div>
      </div>

      <!-- / Menu -->
      <!-- Layout container -->
      <div class="layout-page">
      <!-- Navbar -->
      <!-- / Navbar -->
      <nav class="navbar navbar-expand-lg bg-navbar-theme navbar-classic">
         <div class="container-fluid">
            <a href="dashboard" class="app-brand-link navbar-brand">
            <span class="app-brand-logo demo">
            <img src="<%$base_url%>public/img/logo.png" alt="" width="30">
            </span>
            <span class="stat-cards-info__num fw-bolder ms-2 pt-1">AROM</span>
            </a>
            <!-- <a class="navbar-brand" href="#">Navbar</a> -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span> <label>Menu</label>
            </button>
            <%if !(strpos($smarty.server.PATH_INFO, "/sitemap") !== false) %>
            <i class="ti ti-category quick-menu-bar login-nav-block-mobile" title="Quick Menu"></i>
            <%/if%>
            <div class="navbar-right-wrap ms-2 d-flex nav-top-wrap navbar-nav login-nav-block-mobile">
               <ul class="navbar-right-wrap ms-auto d-flex nav-top-wrap navbar-nav">
                  <li class="ms-2 dropdown">
                     <a class="rounded-circle  " id="dropdownUser" aria-expanded="false">
                        <div class="avatar avatar-md avatar-indicators avatar-online"><%$session_data['user_name'][0]%></div>
                     </a>
                     <div data-bs-popper="static" class="dropdown-menu dropdown-menu-end  dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUser" id="dropdownUserNav">
                        <div data-rr-ui-dropdown-item="" class="px-4 pb-0 pt-2  ">
                           <div class="lh-1 ">
                              <h5 class="mb-1">  <%$session_data['user_name']%></h5>
                              <a class="text-inherit fs-6" href="javascript:void(0)"><%$session_data['user_email']%></a>
                              <h6 class="mt-2">(<%$session_data['clientUnitName']%>)</h6>
                             
                           </div>
                           <div class=" dropdown-divider mt-3 mb-2"></div>
                        </div>
                        <a data-rr-ui-dropdown-item="" class="dropdown-item" role="button" tabindex="0" href="<%base_url('logout')%>"><i class="ti ti-power me-2" ti></i>Sign Out</a>
                     </div>
                  </li>
               </ul>
            </div>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
               <ul class="navbar-nav">
                  <%if checkGroupAccess("dashboard","list","No")%>
                  <li class="nav-item">
                     <a class="nav-link active" aria-current="page" href="<%base_url('dashboard')%>">Dashboard</a>
                  </li>
                  <%/if%>
                  <!-- <li class="nav-item">
                     <a class="nav-link" href="<%base_url('home_2')%>">Charts</a>
                  </li> -->
                  <%if checkGroupAccess("new_po","list","No") || checkGroupAccess("new_po_sub","list","No") || checkGroupAccess("new_po_list_supplier","list","No") || checkGroupAccess("child_part_view","list","No") || checkGroupAccess("child_part_supplier_view","list","No") || checkGroupAccess("approved_supplier","list","No") || checkGroupAccess("routing","list","No") || checkGroupAccess("routing_customer","list","No")%>
                  <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="navbarDropdownMenuLinkPurchase" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                     Purchase
                     </a>
                     <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLinkPurchaseSubmenu">
                        <%if checkGroupAccess("new_po","list","No")%>
                           <li >
                              <a href="<%base_url('new_po')%>" class="dropdown-item">Purchase PO</a>
                           </li>
                        <%/if%>
                        <%if checkGroupAccess("new_po_sub","list","No")%>
                        <li><a href="<%base_url('new_po_sub')%>" class="dropdown-item">Subcon PO</a></li>
                        <%/if%>
                        <%if checkGroupAccess("new_po_list_supplier","list","No")%>
                        <li><a href="<%base_url('new_po_list_supplier')%>" class="dropdown-item">Supplierwise PO List</a></li>
                        <%/if%>
                        <%if checkGroupAccess("child_part_view","list","No")%>
                        <li >
                           <a href="<%base_url('child_part_view')%>" class="dropdown-item">Item Master</a>
                        </li>
                        <%/if%>
                        <%if checkGroupAccess("child_part_supplier_view","list","No")%>
                        <li >
                           <a href="<%base_url('child_part_supplier_view')%>" class="dropdown-item">Purchase Parts Price</a>
                        </li>
                        <%/if%>
                        <%if checkGroupAccess("approved_supplier","list","No")%>
                        <li >
                           <a href="<%base_url('approved_supplier')%>" class="dropdown-item">Supplier</a>
                        </li>
                        <%/if%>
                        <%if checkGroupAccess("routing","list","No")%>
                        <li><a href="<%base_url('routing')%>" class="dropdown-item">Subcon routing</a></li>
                        <%/if%>
                        <%if checkGroupAccess("routing_customer","list","No")%>
                        <li><a href="<%base_url('routing_customer')%>" class="dropdown-item">customer subcon routing</a></li>
                        <%/if%>
                     </ul>
                  </li>
                  <%/if%>
                  <%if checkGroupAccess("inwarding","list","No") || checkGroupAccess("grn_validation","list","No") || checkGroupAccess("view_add_challan","list","No") || checkGroupAccess("view_supplier_challan","list","No") || checkGroupAccess("view_add_challan_subcon","list","No") || checkGroupAccess("view_supplier_challan_subcon","list","No") || checkGroupAccess("challan_inward","list","No") || checkGroupAccess("challan_part_return","list","No") || checkGroupAccess("part_stocks","list","No") || checkGroupAccess("part_stocks_inhouse","list","No") || checkGroupAccess("fw_stock","list","No") || checkGroupAccess("short_receipt","list","No") || ((checkGroupAccess("stock_down","list","No") || checkGroupAccess("stock_up","list","No") || checkGroupAccess("sharing_issue_request_store","list","No") || checkGroupAccess("sharing_issue_request_store_completed","list","No")) && $entitlements['isSheetMetal']!=null) || checkGroupAccess("stock_rejection","list","No")%>
                  <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="navbarDropdownMenuLinkStore" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                     Store
                     </a>
                     <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLinkStoreSubmenu">
                        <%if checkGroupAccess("inwarding","list","No")%>
                           <li><a href="<%base_url('inwarding')%>" class="dropdown-item">GRN Entry</a></li>
                        <%/if%>
                        <%if checkGroupAccess("grn_validation","list","No")%>
                           <li><a href="<%base_url('grn_validation')%>" class="dropdown-item">GRN Qty Validation</a></li>
                        <%/if%>
                        <%if checkGroupAccess("view_add_challan","list","No") || checkGroupAccess("view_supplier_challan","list","No") || checkGroupAccess("view_add_challan_subcon","list","No") || checkGroupAccess("view_supplier_challan_subcon","list","No") || checkGroupAccess("challan_inward","list","No") || checkGroupAccess("challan_part_return","list","No")  %>
                        <li class="dropdown-submenu">
                           <a href="javascript:void(0)" class="dropdown-toggle dropdown-item" data-toggle="dropdown" aria-expanded="false">Challan</a>
                           <ul class="dropdown-menu">
                              <%if checkGroupAccess("view_add_challan","list","No")%>
                                 <li><a href="<%base_url('view_add_challan')%>" class="dropdown-item">Create Challan</a></li>
                              <%/if%>
                              <%if checkGroupAccess("view_supplier_challan","list","No")%>
                                 <li><a href="<%base_url('view_supplier_challan')%>" class="dropdown-item">Supplierwise challan list</a></li>
                              <%/if%>
                              <%if checkGroupAccess("view_add_challan_subcon","list","No")%>
                                 <li><a href="<%base_url('view_add_challan_subcon')%>" class="dropdown-item">Create challan subcon</a></li>
                              <%/if%>
                              <%if checkGroupAccess("view_supplier_challan_subcon","list","No")%>
                                 <li><a href="<%base_url('view_supplier_challan_subcon')%>" class="dropdown-item">Customerwise Challan List</a></li>
                              <%/if%>
                              <%if checkGroupAccess("challan_inward","list","No")%>
                                 <li><a href="<%base_url('challan_inward')%>" class="dropdown-item">Customer Challan Inward</a></li>
                              <%/if%>
                              <%if checkGroupAccess("challan_part_return","list","No")%>
                              <li><a href="<%base_url('challan_part_return')%>" class="dropdown-item">Customer Parts Return</a></li>
                              <%/if%>
                           </ul>
                        </li>
                        <%/if%>
                        <%if checkGroupAccess("part_stocks","list","No")%>
                           <li><a href="<%base_url('part_stocks')%>" class="dropdown-item">Purchase Stock Transfer</a></li>
                        <%/if%>
                        <%if checkGroupAccess("part_stocks_inhouse","list","No")%>
                           <li><a href="<%base_url('part_stocks_inhouse')%>" class="dropdown-item">Inhouse Stock Transfer</a></li>
                        <%/if%>
                        <%if checkGroupAccess("fw_stock","list","No")%>
                        <li><a href="<%base_url('fw_stock')%>" class="dropdown-item">FG Stock Transfer</a></li>
                        <%/if%>
                        <%if ($entitlements['isSheetMetal']!=null && (checkGroupAccess("stock_down","list","No") || checkGroupAccess("stock_up","list","No") || checkGroupAccess("sharing_issue_request_store","list","No") || checkGroupAccess("sharing_issue_request_store_completed","list","No"))) %>
                           <li class="dropdown-submenu">
                              <a href="javascript:void(0)" class="dropdown-toggle dropdown-item" data-toggle="dropdown" aria-expanded="false">Material Requisition</a>
                              <ul class="dropdown-menu">
                                    <%if checkGroupAccess("stock_down","list","No")%>
                                       <li><a href="<%base_url('stock_down')%>" class="dropdown-item">Material issue</a></li>
                                    <%/if%>
                                    <%if checkGroupAccess("stock_up","list","No")%>
                                     <li><a href="<%base_url('stock_up')%>" class="dropdown-item">Stock Up/Return</a></li>
                                    <%/if%>
                                    <%if checkGroupAccess("sharing_issue_request_store","list","No")%>
                                       <li><a href="<%base_url('sharing_issue_request_store')%>" class="dropdown-item">Sharing Isuue Request - Pending</a></li>
                                    <%/if%>
                                    <%if checkGroupAccess("sharing_issue_request_store_completed","list","No")%>
                                       <li><a href="<%base_url('sharing_issue_request_store_completed')%>" class="dropdown-item">Sharing Isuue Request - Complete</a></li>
                                    <%/if%>
                              </ul>
                           </li>
                        <%/if%>
                        <%if ($entitlements['isJobRoot']!=null) %> 
                        <li><a class="dropdown-item" href="<%base_url('job_card_issued')%>">Issue Released Job Card</a></li>
                        <%/if%>
                        <%if checkGroupAccess("stock_rejection","list","No") %>
                        <li><a class="dropdown-item" href="<%base_url('stock_rejection')%>">Stock Rejection</a></li>
                        <%/if%>
                        <%if checkGroupAccess("short_receipt","list","No") %>
                        <li><a class="dropdown-item" href="<%base_url('short_receipt')%>">MDR Short Receipts</a></li>
                        <%/if%>
                     </ul>
                  </li>
                  <%/if%>
                  <%if checkGroupAccess("part_stocks","list","No") || checkGroupAccess("part_stocks_inhouse","list","No") || checkGroupAccess("fw_stock","list","No")  || ($entitlements['isPlastic']!=null && (checkGroupAccess("machine_request","list","No") || checkGroupAccess("view_p_q_molding_production","list","No") || checkGroupAccess("p_q_molding_production","list","No"))) || ($entitlements['isSheetMetal']!=null && (checkGroupAccess("view_p_q","list","No") || checkGroupAccess("stock_down","list","No") || checkGroupAccess("sharing_issue_request","list","No") || checkGroupAccess("sharing_p_q","list","No"))) %>
                  <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="navbarDropdownMenuLinkProduction" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                     Production
                     </a>
                     <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLinkProductionSubmenu">
                        <%if ($entitlements['isPlastic']!=null && checkGroupAccess("machine_request","list","No")) %>
                          <li><a href="<%base_url('machine_request')%>" class="dropdown-item">Material Request</a>
                           </li>
                        <%/if%>
                        <%if checkGroupAccess("part_stocks","list","No")%>
                           <li><a href="<%base_url('part_stocks')%>" class="dropdown-item">Purchase Stock Transfer</a></li>
                        <%/if%>
                        <%if checkGroupAccess("part_stocks_inhouse","list","No")%>
                           <li><a href="<%base_url('part_stocks_inhouse')%>" class="dropdown-item">Inhouse Stock Transfer</a></li>
                        <%/if%>
                        <%if checkGroupAccess("fw_stock","list","No")%>
                        <li><a href="<%base_url('fw_stock')%>" class="dropdown-item">FG Stock Transfer</a></li>
                        <%/if%>
                         <%if ($entitlements['isSheetMetal']!=null) %>
                           <%if checkGroupAccess("stock_down","list","No")%>
                              <li><a href="<%base_url('stock_down')%>"
                                 class="dropdown-item">Material
                                 Issue</a>
                              </li>
                           <%/if%>
                           <%if checkGroupAccess("sharing_issue_request","list","No")%>
                              <li><a href="<%base_url('sharing_issue_request')%>"
                                 class="dropdown-item">Create Sharing Request
                                 </a>
                              </li>
                           <%/if%>
                           <%if checkGroupAccess("sharing_p_q","list","No")%>
                              <li><a href="<%base_url('sharing_p_q')%>" class="dropdown-item">Sharing
                                 Production
                                 </a>
                              </li>
                           <%/if%>
                           <%if (checkGroupAccess("view_p_q","list","No")) %>
                              <li><a href="<%base_url('view_p_q')%>"
                                 class="dropdown-item">Production QTY
                                 </a>
                              
                           <%/if%>
                        <%/if%>
                        <%if ($entitlements['isPlastic']!=null ) %>
                           <%if checkGroupAccess("p_q_molding_production","list","No")%>
                           <li><a href="<%base_url('p_q_molding_production')%>" class="dropdown-item">Molding Production</a></li>
                           <%/if%>
                           <%if checkGroupAccess("view_p_q_molding_production","list","No")%>
                           <li><a href="<%base_url('view_p_q_molding_production')%>" class="dropdown-item">Molding Production Approval</a></li>
                           <%/if%>
                           
                      <%/if%>
                      <%if ($entitlements['isJobRoot']!=null) %> 
                        <li><a href="<%base_url('job_card_issued')%>" class="dropdown-item">WIP Job
                              Card</a>
                           </li>
                      <%/if%>
                     </ul>
                  </li>
                  <%/if%>
                  <%if checkGroupAccess("remarks","list","No") || checkGroupAccess("stock_rejection","list","No") || checkGroupAccess("accept_reject_validation","list","No") || ($entitlements['isPlastic']!=null && (checkGroupAccess("final_inspection","list","No"))) || checkGroupAccess("rejection_invoices","list","No") || ($entitlements['isSheetMetal']!=null && checkGroupAccess("final_inspection_qa","list","No"))%>
                  <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="navbarDropdownMenuLinkQuality" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                     Quality
                     </a>
                     <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLinkQualitySubmenu">
                        <%if checkGroupAccess("accept_reject_validation","list","No")%>
                        <li><a href="<%base_url('accept_reject_validation')%>" class="dropdown-item">Inward Inspection</a></li>
                        <%/if%>
                        <%if ($entitlements['isPlastic']!=null && checkGroupAccess("final_inspection","list","No")) %>
                           <li><a href="<%base_url('final_inspection')%>" class="dropdown-item">Final Inspection</a></li>
                        <%/if%>
                        <%if ($entitlements['isSheetMetal']!=null && checkGroupAccess("final_inspection_qa","list","No")) %>
                           <li><a href="<%base_url('final_inspection_qa')%>" class="dropdown-item">Final
                              Inspection Production
                              </a>
                           </li>
                        <%/if%>
                        <%if checkGroupAccess("remarks","list","No")%>
                           <li><a href="<%base_url('remarks')%>" class="dropdown-item">Rejection Reasons</a>
                           </li>
                        <%/if%>
                        <%if checkGroupAccess("stock_rejection","list","No") %>
                           <li><a href="<%base_url('stock_rejection')%>" class="dropdown-item">Stock
                              Rejection</a></li>
                        <%/if%>
                        <%if checkGroupAccess("rejection_invoices","list","No") %>
                           <li><a href="<%base_url('rejection_invoices')%>"
                              class="dropdown-item">CN-DN-PI</a>
                           </li>
                        <%/if%>
                     </ul>
                  </li>
                  <%/if%>
                  
                  
                   <%if checkGroupAccess("new_sales","list","No") || checkGroupAccess("sales_invoice_released","list","No") || checkGroupAccess("rejection_invoices","list","No") || checkGroupAccess("customer_parts_master","list","No") || checkGroupAccess("customer","list","No") || checkGroupAccess("customer_master","list","No") || checkGroupAccess("consignee","list","No") || checkGroupAccess("customer_po_tracking_all","list","No") || checkGroupAccess("planning_year_page","list","No") ||  ($entitlements['isSheetMetal']!=null && checkGroupAccess("inhouse_parts_view","list","No") || checkGroupAccess("export_invoice_released","list","No") && $config_data['exportSalesInvoive'] eq 'Yes') %>
                  <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="navbarDropdownMenuLinkPnS" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                     Planning & Sales
                     </a>
                     <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLinkPnSSubmenu">
                        <%if checkGroupAccess("new_sales","list","No") %>
                           <li><a href="<%base_url('new_sales')%>" class="dropdown-item">Create Sale Invoice</a></li>
                        <%/if%>
                        <%if checkGroupAccess("sales_invoice_released","list","No") %>
                        <li><a href="<%base_url('sales_invoice_released')%>" class="dropdown-item">View sale Invoice</a></li>
                        <%/if%>
                        <%if checkGroupAccess("export_invoice_released","list","No") && $config_data['exportSalesInvoive'] eq 'Yes' %>
                        <li><a href="<%base_url('export_invoice_released')%>" class="dropdown-item">View Export Invoice</a></li>
                        <%/if%>
                        <%if checkGroupAccess("rejection_invoices","list","No") %>
                        <li><a href="<%base_url('rejection_invoices')%>" class="dropdown-item">CN-DN-PI</a></li>
                        <%/if%>
                        <%if checkGroupAccess("customer_parts_master","list","No") || checkGroupAccess("customer","list","No") || checkGroupAccess("customer_master","list","No") || checkGroupAccess("consignee","list","No")%>
                        <li class="dropdown-submenu">
                           <a href="javascript:void(0)" class="dropdown-toggle dropdown-item" data-toggle="dropdown" aria-expanded="false">Customer</a>
                           <ul class="dropdown-menu">
                              <%if checkGroupAccess("customer_parts_master","list","No") %>
                              <li><a href="<%base_url('customer_parts_master')%>" class="dropdown-item">Part Master</a></li>
                              <%/if%>
                              <%if checkGroupAccess("customer","list","No") %>
                              <li><a href="<%base_url('customer')%>" class="dropdown-item">Customers</a></li>
                              <%/if%>
                              <%if checkGroupAccess("customer_master","list","No") %>
                              <li><a href="<%base_url('customer_master')%>" class="dropdown-item">Customer Master</a></li>
                              <%/if%>
                              <%if checkGroupAccess("consignee","list","No") %>
                              <li><a href="<%base_url('consignee')%>" class="dropdown-item">Consignee</a></li>
                              <%/if%>
                           </ul>
                        </li>
                        <%/if%>
                        <%if checkGroupAccess("customer_po_tracking_all","list","No") %>
                        <li><a href="<%base_url('customer_po_tracking_all')%>" class="dropdown-item">Sales Order</a></li>
                        <%/if%>
                        <%if checkGroupAccess("planning_year_page","list","No") %>
                        <li><a href="<%base_url('planning_year_page')%>" class="dropdown-item">Monthly Schedule</a></li>
                        <%/if%>
                        <%if checkGroupAccess("planning_shop_order_details","list","No") %>
                              <li><a href="<%base_url('planning_shop_order_details')%>" class="dropdown-item">Shop Order</a></li>
                        <%/if%>
                        <%if ($entitlements['isJobRoot']!=null) %> 
                                 <li><a href="<%base_url('job_card')%>" class="dropdown-item">Create
                                    JOB
                                    Card</a>
                                 </li>
                                 <li><a href="<%base_url('job_card_released')%>"
                                    class="dropdown-item">Released JOB Card</a></li>
                                 <li><a href="<%base_url('job_card_closed')%>" class="dropdown-item">Closed
                                    JOB Card</a>
                                 </li>
                              <%/if%>
                        
                        <%if ($entitlements['isSheetMetal']!=null && checkGroupAccess("inhouse_parts_view","list","No")) %>
                        <li><a href="<%base_url('inhouse_parts_view')%>" class="dropdown-item">Inhouse Parts</a></li>
                        <%/if%>
                     </ul>
                  </li>
                  <%/if%>
                  <%if checkGroupAccess("sales_report","list","No") || checkGroupAccess("hsn_report","list","No") || checkGroupAccess("sales_summary_report","list","No") || checkGroupAccess("receivable_report","list","No") || checkGroupAccess("payable_report","list","No") || ($entitlements['isSheetMetal']!=null && (checkGroupAccess("report_stock_transfer","list","No") || checkGroupAccess("customer_part_wip_stock_report","list","No"))) || checkGroupAccess("child_part_view","list","No") || checkGroupAccess("approved_supplier","list","No") || checkGroupAccess("child_part_supplier_report","list","No") || checkGroupAccess("supplier_parts_stock_report","list","No") || checkGroupAccess("reports_po_balance_qty","list","No") || checkGroupAccess("reports_grn","list","No") || checkGroupAccess("grn_summary_report","list","No") || ($entitlements['isPlastic']!=null && (checkGroupAccess("report_prod_rejection","list","No") || checkGroupAccess("machine_request_completed","list","No") || checkGroupAccess("molding_stock_transfer","list","No") )) || checkGroupAccess("reports_incoming_quality","list","No") || checkGroupAccess("reports_inspection","list","No") || checkGroupAccess("grn_rejection","list","No") || checkGroupAccess("part_stocks","list","No") || checkGroupAccess("planing_data_report","list","No") || checkGroupAccess("subcon_supplier_challan_part_report","list","No") || checkGroupAccess("mold_maintenance_report","list","No") || checkGroupAccess("pending_po","list","No") || checkGroupAccess("rejected_po","list","No") || checkGroupAccess("expired_po","list","No") || checkGroupAccess("closed_po","list","No") || checkGroupAccess("downtime_report","list","No") || checkGroupAccess("customer_challan_report","list","No")%>
                  <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="navbarDropdownMenuLinkReport" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                     Reports
                     </a>
                     <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLinkReportSubmenu">
                        <%if checkGroupAccess("sales_report","list","No") %>
                        <li><a href="<%base_url('sales_report')%>" class="dropdown-item">Sales Report </a></li>
                        <%/if%>
                        <%if checkGroupAccess("hsn_report","list","No") %>
                        <li><a href="<%base_url('hsn_report')%>" class="dropdown-item">HSN Report </a></li>
                        <%/if%>
                        <%if checkGroupAccess("sales_summary_report","list","No") %>
                        <li><a href="<%base_url('sales_summary_report')%>" class="dropdown-item">Sales Summary report </a></li>
                        <%/if%>
                        <%if checkGroupAccess("receivable_report","list","No") %>
                        <li><a href="<%base_url('receivable_report')%>" class="dropdown-item">Receivable Report </a></li>
                        <%/if%>
                        <%if checkGroupAccess("payable_report","list","No") %>
                        <li><a href="<%base_url('payable_report')%>" class="dropdown-item">Payable Report </a></li>
                        <%/if%>
                        <%if ($entitlements['isSheetMetal']!=null && checkGroupAccess("report_stock_transfer","list","No")) %>
                        <li><a href="<%base_url('report_stock_transfer')%>" class="dropdown-item">Stock Transfer</a></li>
                        <%/if%>
                        <%if checkGroupAccess("child_part_view","list","No") %>
                           <li><a href="<%base_url('child_part_view')%>" class="dropdown-item">Item
                              Master</a>
                           </li>
                        <%/if%>
                        <%if checkGroupAccess("approved_supplier","list","No") %>
                           <li><a href="<%base_url('approved_supplier')%>" class="dropdown-item">Approved Suppliers</a>
                           </li>
                        <%/if%>
                        <%if checkGroupAccess("child_part_supplier_report","list","No") %>
                           <li><a href="<%base_url('child_part_supplier_report')%>"
                              class="dropdown-item">Purchase Price Report</a></li>
                        <%/if%>
                        <%if checkGroupAccess("supplier_parts_stock_report","list","No") %>
                           <li><a href="<%base_url('supplier_parts_stock_report')%>"
                              class="dropdown-item">Purchase Stock</a></li>
                        <%/if%>
                        <%if checkGroupAccess("reports_po_balance_qty","list","No") %>
                           <li><a href="<%base_url('reports_po_balance_qty')%>" class="dropdown-item">PO Summary Report</a></li>
                        <%/if%>
                        <%if checkGroupAccess("reports_grn","list","No") %>
                           <li><a href="<%base_url('reports_grn')%>" class="dropdown-item">GRN Report</a><li>
                        <%/if%>
                        <%if checkGroupAccess("grn_summary_report","list","No") %>
                              <li><a href="<%base_url('grn_summary_report')%>" class="dropdown-item">GRN Summary Report</a>
                           </li>
                        <%/if%>
                        <%if ($entitlements['isPlastic']!=null && checkGroupAccess("report_prod_rejection","list","No")) %>
                           <li><a href="<%base_url('report_prod_rejection')%>" class="dropdown-item">Production Rejection Reason</a></li>
                        <%/if%>
                        <%if checkGroupAccess("reports_incoming_quality","list","No") %>
                           <li><a href="<%base_url('reports_incoming_quality')%>"
                              class="dropdown-item">Incoming Quality Report</a></li>
                        <%/if%>
                        <%if checkGroupAccess("reports_inspection","list","No") %>
                           <li><a href="<%base_url('reports_inspection')%>" class="dropdown-item">Under
                              Inspection Parts Report</a>
                           </li>
                        <%/if%>
                        <%if checkGroupAccess("grn_rejection","list","No") %>
                            <li><a href="<%base_url('grn_rejection')%>" class="dropdown-item">GRN
                              Rejection</a>
                           </li>
                        <%/if%>
                        <%if checkGroupAccess("part_stocks","list","No") %>
                           <li><a href="<%base_url('part_stocks')%>" class="dropdown-item">Current Supplier
                              Part(Item) Stock </a>
                           </li>
                        <%/if%>
                        <%if checkGroupAccess("planing_data_report","list","No") %>
                           <li><a href="<%base_url('planing_data_report')%>" class="dropdown-item">Monthly Schedule Report</a>
                           </li>
                        <%/if%>
                           <!-- <li><a href="<%base_url('pei_chart_sales_values_in_rs')%>"
                              class="dropdown-item">Sales Values In Rs</a></li> -->
                        <%if ($entitlements['isSheetMetal']!=null && checkGroupAccess("customer_part_wip_stock_report","list","No")) %>
                           <li><a href="<%base_url('customer_part_wip_stock_report')%>"
                              class="dropdown-item">CUSTOMER PART WIP STOCK REPORT </a></li>
                        <%/if%>
                        <%if checkGroupAccess("subcon_supplier_challan_part_report","list","No") %>
                           <li><a href="<%base_url('subcon_supplier_challan_part_report')%>"
                              class="dropdown-item">Subcon Report </a></li>
                        <%/if%>
                        <%if checkGroupAccess("mold_maintenance_report","list","No") %>
                           <li><a href="<%base_url('mold_maintenance_report')%>" 
                              class="dropdown-item">Mold Life report </a></li>
                        <%/if%>
                        <%if checkGroupAccess("pending_po","list","No") %>
                              <li><a href="<%base_url('pending_po')%>" class="dropdown-item">PO Under Approval</a></li>
                        <%/if%>
                        <%if checkGroupAccess("rejected_po","list","No") %>
                           <li><a href="<%base_url('rejected_po')%>" class="dropdown-item">Reject PO</a></li>
                        <%/if%>
                        <%if checkGroupAccess("expired_po","list","No") %>
                           <li><a href="<%base_url('expired_po')%>" class="dropdown-item">Expired PO</a></li>
                        <%/if%>
                        <%if checkGroupAccess("closed_po","list","No") %>
                           <li><a href="<%base_url('closed_po')%>" class="dropdown-item">Closed PO</a></li>
                        <%/if%>
                        <%if ($entitlements['isPlastic']!=null && checkGroupAccess("machine_request_completed","list","No")) %>
                              <li><a href="<%base_url('machine_request_completed')%>" class="dropdown-item">Material Request Report</a>
                              </li>
                        <%/if%>
                           <%if ($entitlements['isPlastic']!=null && checkGroupAccess("molding_stock_transfer","list","No")) %>
                              <li><a href="<%base_url('molding_stock_transfer ')%>" class="dropdown-item">Molding Stock Transfer </a></li>
                           <%/if%>
                        <%if checkGroupAccess("customer_challan_report","list","No") %>
                           <li><a href="<%base_url('customer_challan_report ')%>" class="dropdown-item">
Customer Challan Report</a></li>
                        <%/if%>
                     </ul>
                  </li>
                  <%/if%>
                  <%if (checkGroupAccess("supplier","list","No") || checkGroupAccess("child_part_supplier_admin","list","No") || checkGroupAccess("pending_po","list","No") || checkGroupAccess("child_parts","list","No") || checkGroupAccess("inhouse_parts_admin","list","No") || checkGroupAccess("customer_parts_admin","list","No")) || ($entitlements['isPlastic'] && (checkGroupAccess("grades","list","No")) || checkGroupAccess("mold_maintenance","list","No")) || checkGroupAccess("part_family","list","No") || checkGroupAccess("process","list","No") || checkGroupAccess("operations","list","No") || checkGroupAccess("operations_data","list","No") || checkGroupAccess("asset","list","No") || checkGroupAccess("shifts","list","No") || checkGroupAccess("operator","list","No") || checkGroupAccess("machine","list","No") || checkGroupAccess("downtime_master","list","No") || checkGroupAccess("client","list","No") || checkGroupAccess("uom","list","No") || checkGroupAccess("gst","list","No") || checkGroupAccess("transporter","list","No") || checkGroupAccess("category","list","No") || checkGroupAccess("erp_users","list","No") || checkGroupAccess("configs","list","No") || checkGroupAccess("group_master","list","No") || checkGroupAccess("global_formate_config","list","No")%>
                     <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="navbarDropdownMenuLinkAdmin" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                     Admin
                     </a>
                     <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLinkAdminSubmenu">
                        <%if (checkGroupAccess("supplier","list","No") || checkGroupAccess("child_part_supplier_admin","list","No") || checkGroupAccess("pending_po","list","No") || checkGroupAccess("child_parts","list","No") || checkGroupAccess("inhouse_parts_admin","list","No") || checkGroupAccess("customer_parts_admin","list","No")) %>
                        <li class="dropdown-submenu">
                           <a href="javascript:void(0)" class="dropdown-toggle dropdown-item" data-toggle="dropdown" aria-expanded="false">Approval</a>
                           <ul class="dropdown-menu">
                              <%if (checkGroupAccess("supplier","list","No")) %>
                              <li><a href="<%base_url('supplier')%>" class="dropdown-item">Supplier Approval</a></li>
                              <%/if%>
                              <%if (checkGroupAccess("child_part_supplier_admin","list","No")) %>
                              <li><a href="<%base_url('child_part_supplier_admin')%>" class="dropdown-item">Purchase Price Approval</a></li>
                              <%/if%>
                              <%if (checkGroupAccess("pending_po","list","No")) %>
                              <li><a href="<%base_url('pending_po')%>" class="dropdown-item">Po Approval</a></li>
                              <%/if%>
                              <%if (checkGroupAccess("child_parts","list","No")) %>
                              <li><a href="<%base_url('child_parts')%>" class="dropdown-item">Child Part Stock Update</a></li>
                              <%/if%>
                              <%if (checkGroupAccess("inhouse_parts_admin","list","No")) %>
                              <li><a href="<%base_url('inhouse_parts_admin')%>" class="dropdown-item">Inhouse Part Stock Update</a></li>
                              <%/if%>
                              <%if (checkGroupAccess("customer_parts_admin","list","No")) %>
                              <li><a href="<%base_url('customer_parts_admin')%>" class="dropdown-item">Customer Part Stock Update</a></li>
                              <%/if%>
                           </ul>
                        </li>
                        <%/if%>
                        <%if ($entitlements['isPlastic'] && (checkGroupAccess("grades","list","No") || checkGroupAccess("mold_maintenance","list","No"))) || checkGroupAccess("part_family","list","No") || checkGroupAccess("process","list","No") || checkGroupAccess("operations","list","No") || checkGroupAccess("operations_data","list","No") || checkGroupAccess("asset","list","No") || checkGroupAccess("shifts","list","No") || checkGroupAccess("operator","list","No") || checkGroupAccess("machine","list","No") || checkGroupAccess("downtime_master","list","No") || checkGroupAccess("client","list","No") || checkGroupAccess("uom","list","No") || checkGroupAccess("gst","list","No") || checkGroupAccess("transporter","list","No") || checkGroupAccess("category","list","No") || ($config_data['exportSalesInvoive'] eq 'Yes' && (checkGroupAccess("country","list","No") || checkGroupAccess("port","list","No") || checkGroupAccess("currency","list","No")))%>
                        <li class="dropdown-submenu">
                           <a href="javascript:void(0)" class="dropdown-toggle dropdown-item" data-toggle="dropdown" aria-expanded="false">Master</a>
                           <ul class="dropdown-menu">
                                 <%if ($entitlements['isPlastic'] && checkGroupAccess("grades","list","No")) %>
                                 <li><a href="<%base_url('grades')%>" class="dropdown-item">Grades
                                    Master</a>
                                 </li>
                                 <%/if%>
                                 <%if (checkGroupAccess("part_family","list","No")) %>
                                 <li><a href="<%base_url('part_family')%>" class="dropdown-item">Part
                                    Family</a>
                                 </li>
                                 <%/if%>
                                 <%if (checkGroupAccess("process","list","No")) %>
                                 <li><a href="<%base_url('process')%>" class="dropdown-item">Process</a></li>
                                 <%/if%>
                                 <%if (checkGroupAccess("operations","list","No")) %>
                                 <li><a href="<%base_url('operations')%>" class="dropdown-item">Operation
                                    No.</a>
                                 </li>
                                 <%/if%>
                                 <%if (checkGroupAccess("operations_data","list","No")) %>
                                 <li><a href="<%base_url('operations_data')%>"
                                    class="dropdown-item">Operations
                                    Data</a>
                                 </li>
                                 <%/if%>
                                 <%if (checkGroupAccess("asset","list","No")) %>
                                 <li><a href="<%base_url('asset')%>" class="dropdown-item">Asset</a></li>
                                 <%/if%>
                                 <%if (checkGroupAccess("shifts","list","No")) %>
                                 <li><a href="<%base_url('shifts')%>" class="dropdown-item">Shift</a></li>
                                 <%/if%>
                                 <%if (checkGroupAccess("operator","list","No")) %>
                                 <li><a href="<%base_url('operator')%>" class="dropdown-item">Operator</a>
                                 </li>
                                 <%/if%>
                                 <%if (checkGroupAccess("machine","list","No")) %>
                                 <li><a href="<%base_url('machine')%>" class="dropdown-item">Machine</a>
                                 </li>
                                 <%/if%>
                                 <%if (checkGroupAccess("downtime_master","list","No")) %>
                                 <li><a href="<%base_url('downtime_master')%>" class="dropdown-item">Down
                                    Time
                                    Reason</a>
                                 </li>
                                 <%/if%>
                                 <%if ($entitlements['isPlastic'] && checkGroupAccess("mold_maintenance","list","No")) %>
                                 <li><a href="<%base_url('mold_maintenance')%>" class="dropdown-item">Mold Master
                                    </a>
                                 </li>
                                 <%/if%>
                                 <%if (checkGroupAccess("client","list","No")) %>
                                 <li><a href="<%base_url('client')%>" class="dropdown-item">Client</a></li>
                                 <%/if%>
                                 <%if (checkGroupAccess("uom","list","No")) %>
                                 <li><a href="<%base_url('uom')%>" class="dropdown-item">UOM</a></li>
                                 <%/if%>
                                 <%if (checkGroupAccess("gst","list","No")) %>
                                 <li><a href="<%base_url('gst')%>" class="dropdown-item">Tax Structure</a>
                                 <%/if%>
                                 <%if (checkGroupAccess("transporter","list","No")) %>
                                 <li><a href="<%base_url('transporter')%>" class="dropdown-item">Transporter</a>
                                 </li>
                                 <%/if%>
                                 <%if (checkGroupAccess("category","list","No")) %>
                                        <li><a href="<%base_url('category') %>" class="dropdown-item">Category</a>
                                       </li>
                                 <%/if%>
                                 <%if (checkGroupAccess("country","list","No") && $config_data['exportSalesInvoive'] eq 'Yes') %>
                                        <li><a href="<%base_url('country') %>" class="dropdown-item">Country</a>
                                       </li>
                                 <%/if%>
                                 <%if (checkGroupAccess("port","list","No") && $config_data['exportSalesInvoive'] eq 'Yes') %>
                                        <li><a href="<%base_url('port') %>" class="dropdown-item">Port</a>
                                       </li>
                                 <%/if%>
                                 <%if (checkGroupAccess("currency","list","No") && $config_data['exportSalesInvoive'] eq 'Yes') %>
                                        <li><a href="<%base_url('currency') %>" class="dropdown-item">Currency</a>
                                       </li>
                                 <%/if%>
                           </ul>
                        </li>
                        <%/if%>
                        <!-- <li><a class="dropdown-item" href="#">Approval</a></li>
                           <li><a class="dropdown-item" href="#">Master</a></li> -->
                        <%if (checkGroupAccess("erp_users","list","No")) %>
                        <li><a class="dropdown-item" href="<%base_url('erp_users')%>">User</a></li>
                        <%/if%>
                        <%if (checkGroupAccess("configs","list","No")) %>
                        <li><a class="dropdown-item" href="<%base_url('configs')%>">Configurations</a></li>
                        <%/if%>
                        <%if (checkGroupAccess("group_master","list","No")) %>
                        <li><a class="dropdown-item" href="<%base_url('group_master')%>">Group Master</a></li>
                        <%/if%>
                        <%if (checkGroupAccess("global_formate_config","list","No")) %>
                                <li><a href="<%base_url('global_formate_config') %>" class="dropdown-item">Formate Configurations</a></li>
                        <%/if%>
                     </ul>
                           </li>
                           <%/if%>
                           
                  
                  <!-- <li class="nav-item">
                    <a href="<%base_url('logout')%>" class="nav-link">Logout</a>
                  </li> -->
               </ul>
            </div>
            <%if !(strpos($smarty.server.PATH_INFO, "/sitemap") !== false) %>
            <i class="ti ti-category quick-menu-bar login-nav-block" title="Quick Menu"></i>
            <%/if%>
            <div class="navbar-right-wrap ms-2 d-flex nav-top-wrap navbar-nav login-nav-block">
               <ul class="navbar-right-wrap ms-auto d-flex nav-top-wrap navbar-nav">
                  <li class="ms-2 dropdown">
                     <a class="rounded-circle  " id="dropdownUser" aria-expanded="false">
                        <div class="avatar avatar-md avatar-indicators avatar-online"><%$session_data['user_name'][0]%></div>
                     </a>
                     <div data-bs-popper="static" class="dropdown-menu dropdown-menu-end  dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUser" id="dropdownUserNav">
                        <div data-rr-ui-dropdown-item="" class="px-4 pb-0 pt-2  ">
                           <div class="lh-1 ">
                              <h5 class="mb-1">  <%$session_data['user_name']%></h5>
                              <a class="text-inherit fs-6" href="javascript:void(0)"><%$session_data['user_email']%></a>
                              <h6 class="mt-2">(<%$session_data['clientUnitName']%>)</h6>
                             
                           </div>
                           <div class=" dropdown-divider mt-3 mb-2"></div>
                        </div>
                        <a data-rr-ui-dropdown-item="" class="dropdown-item" role="button" tabindex="0" href="<%base_url('logout')%>"><i class="ti ti-power me-2" ti></i>Sign Out</a>
                     </div>
                  </li>
               </ul>
            </div>
         </div>
      </nav>
      <!-- Content wrapper -->
      <div class="content-wrapper">
      <!-- Content -->
