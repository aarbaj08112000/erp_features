<?php
if (!$this->session->userdata['user_id']) {
  redirect('login');
}
?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ERP-Management</title>
    <!-- <link rel="shortcut icon" href="<?php echo base_url('') ?>/dist/imgfavicon.ico" type="image/x-icon"> -->
    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo base_url('') ?>/dist/img/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?php echo base_url('') ?>/dist/img/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url('') ?>/dist/img/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url('') ?>/dist/img/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url('') ?>/dist/img/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url('') ?>/dist/img/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo base_url('') ?>/dist/img/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url('') ?>/dist/img/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url('') ?>/dist/img/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"
        href="<?php echo base_url('') ?>/dist/img/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url('') ?>/dist/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url('') ?>/dist/img/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url('') ?>/dist/img/favicon-16x16.png">
    <link rel="manifest" href="<?php echo base_url('') ?>/dist/img/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js"
        integrity="sha512-cLuyDTDg9CSseBSFWNd4wkEaZ0TBEpclX0zD3D6HjI19pO39M58AgJ1SjHp6c7ZOp0/OCRcC2BCvvySU9KJaGw=="
        crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- <meta name="viewport" content="width=device-width, initial-scale=1" /> -->
    <script src="html2pdf.bundle.min.js"></script>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url('') ?>plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="<?php echo base_url('') ?>plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url('') ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="<?php echo base_url('') ?>plugins/jqvmap/jqvmap.min.css">


    <link rel="stylesheet" href="<?php echo base_url('') ?>plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?php echo base_url('') ?>plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">


    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url('') ?>dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?php echo base_url('') ?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?php echo base_url('') ?>plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="<?php echo base_url('') ?>plugins/summernote/summernote-bs4.min.css">

    <link rel="stylesheet"
        href="<?php echo base_url('') ?>plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="jquery-3.5.1.min.js"></script>
</head>
<a href="#" class="d-block"><?php echo $user_role = trim($this->session->userdata['type']); ?>

    <body class="hold-transition sidebar-mini sidebar-collapse">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>

            </ul>


        </nav>
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <!-- <img src="<?php echo base_url('') ?>/dist/img/softech.jpeg" alt="" class="mx-auto d-block rounded-circle"> -->

                <img src="<?php echo base_url('') ?>/dist/img/softech.jpeg" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">ERP</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?php echo base_url('') ?>dist/img/user2-160x160.jpg" class="img-circle elevation-2"
                            alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">Name :<?php echo $this->session->userdata['user_name']; ?></a>
                        <a href="#" class="d-block">Role
                            :<?php echo $user_role =  $this->session->userdata['type']; ?></a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item menu-open">
                            <a href="<?php echo base_url('index') ?>" class="nav-link active">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                    <i class="right fas "></i>
                                </p>
                            </a>

                        </li>





                        <?php if (true) {
            ?>


                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-circle"></i>
                                <p>
                                    Master
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">


                                <?php if ($this->session->userdata['type'] == 'admin' || $this->session->userdata['type'] == 'Admin') {
                  ?>

                                <li class="nav-item">
                                    <a href="<?php echo base_url('erp_users') ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Users
                                            <i class="right fas"></i>
                                        </p>
                                    </a>

                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo base_url('operations') ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Operations
                                            <i class="right fas"></i>
                                        </p>
                                    </a>

                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo base_url('remarks') ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Reject Remarks
                                            <i class="right fas"></i>
                                        </p>
                                    </a>

                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo base_url('operations_data') ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Operation Data
                                            <i class="right fas"></i>
                                        </p>
                                    </a>

                                </li>

                                <?php }
                  ?>

                                <?php if ($this->session->userdata['type'] == 'admin' || $this->session->userdata['type'] == 'Admin') {
                  ?>
                                <li class="nav-item">
                                    <a href="<?php echo base_url('client') ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Client
                                            <i class="right fas"></i>
                                        </p>
                                    </a>

                                </li>

                                <?php }
                  ?>


                                <?php if ($this->session->userdata['type'] == 'admin' || $this->session->userdata['type'] == 'Admin') {
                  ?>
                                <li class="nav-item">
                                    <a href="<?php echo base_url('uom') ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            UOM
                                            <i class="right fas"></i>
                                        </p>
                                    </a>

                                </li>

                                <?php }
                  ?>

                                <?php if ($this->session->userdata['type'] == 'admin' || $this->session->userdata['type'] == 'Admin') {
                  ?>
                                <li class="nav-item">
                                    <a href="<?php echo base_url('gst') ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Tax Structure
                                            <i class="right fas"></i>
                                        </p>
                                    </a>

                                </li>

                                <?php }
                  ?>

                                <?php if ($this->session->userdata['type'] == 'admin' || $this->session->userdata['type'] == 'Admin') {
                  ?>
                                <li class="nav-item">
                                    <a href="<?php echo base_url('supplier') ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Supplier
                                            <i class="right fas"></i>
                                        </p>
                                    </a>

                                </li>

                                <?php }
                  ?>


                                <?php if ($this->session->userdata['type'] == 'admin' || $this->session->userdata['type'] == 'Admin') {
                  ?>
                                <li class="nav-item">
                                    <a href="<?php echo base_url('part_type') ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            item part Type

                                            <i class="right fas"></i>
                                        </p>
                                    </a>

                                </li>

                                <?php }
                  ?>
                                <?php
                  if ($user_role == "Purchase" || $user_role == "Admin" || $user_role == "admin") {
                  ?>
                                <li class="nav-item">
                                    <a href="<?php echo base_url('child_part') ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            item part Master
                                            <i class="right fas"></i>
                                        </p>
                                    </a>

                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo base_url('child_part_supplier') ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Supplier Parts
                                            <i class="right fas"></i>
                                        </p>
                                    </a>

                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo base_url('child_part_documents') ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            item part Document's
                                            <i class="right fas"></i>
                                        </p>
                                    </a>

                                </li>

                                <li class="nav-item">
                                    <a href="<?php echo base_url('new_po') ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Generate Purchase Order
                                            <i class="right fas"></i>
                                        </p>
                                    </a>

                                </li>
                                <?php }
                  ?>
                                <?php
                  if ($user_role == "Approver" || $user_role == "Admin" || $user_role == "admin") {
                  ?>
                                <li class="nav-item">
                                    <a href="<?php echo base_url('new_po_list_supplier') ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Purchase Order list
                                            <i class="right fas"></i>
                                        </p>
                                    </a>

                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo base_url('pending_po') ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Pending PO
                                            <i class="right fas"></i>
                                        </p>
                                    </a>

                                </li>
                                <?php }
                  ?>

                                <?php
                  if ($this->session->userdata['type'] == 'admin' || $this->session->userdata['type'] == 'Admin'  || $this->session->userdata['type'] == 'Marketing') {
                  ?>
                                <li class="nav-item">
                                    <a href="<?php echo base_url('customer') ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Customer
                                            <i class="right fas"></i>
                                        </p>
                                    </a>

                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo base_url('customer_part_type') ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Customer Part Type
                                            <i class="right fas"></i>
                                        </p>
                                    </a>

                                </li>

                                <li class="nav-item">
                                    <a href="<?php echo base_url('customer_master') ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Customer Master
                                            <i class="right fas"></i>
                                        </p>
                                    </a>

                                </li>






                                <!-- <li class="nav-item">
                      <a href="<?php echo base_url('customer_part') ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>
                          Customer Part
                          <i class="right fas"></i>
                        </p>
                      </a>

                    </li> -->
                                <!-- <li class="nav-item">
                      <a href="<?php echo base_url('customer_price') ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>
                          Customer Price
                          <i class="right fas"></i>
                        </p>
                      </a>

                    </li> -->
                                <!-- <li class="nav-item">
                      <a href="<?php echo base_url('customer_drawing') ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>
                          Customer Drawing
                          <i class="right fas"></i>
                        </p>
                      </a>

                    </li> -->
                                <!-- <li class="nav-item">
                      <a href="<?php echo base_url('customer_bom') ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>
                          Customer BOM
                          <i class="right fas"></i>
                        </p>
                      </a>

                    </li> -->
                                <!-- <li class="nav-item">
                      <a href="<?php echo base_url('customer_operation') ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>
                          Customer Operation
                          <i class="right fas"></i>
                        </p>
                      </a>

                    </li> -->
                                <?php }
                  ?>

                            </ul>
                        </li>
                        <?php   } ?>
                        <?php
            if ($this->session->userdata['type'] == 'admin' || $this->session->userdata['type'] == 'production') {
            ?>
                        <!-- <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-circle"></i>
                <p>
                  Project Management
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">

                <li class="nav-item">
                  <a href="<?php echo base_url('oc_number') ?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                      OC Number
                      <i class="right fas"></i>
                    </p>
                  </a>

                </li>
                <li class="nav-item">
                  <a href="<?php echo base_url('wbs_number') ?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                      WBS Number
                      <i class="right fas"></i>
                    </p>
                  </a>

                </li>
                <li class="nav-item">
                  <a href="<?php echo base_url('hus_number') ?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                      HUS Number
                      <i class="right fas"></i>
                    </p>
                  </a>

                </li>
                <li class="nav-item">
                  <a href="<?php echo base_url('po_details') ?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                      PO Details
                      <i class="right fas"></i>
                    </p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="<?php echo base_url('loading_user') ?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                      Loading Plan
                      <i class="right fas"></i>
                    </p>
                  </a>

                </li>
                <li class="nav-item">
                  <a href="<?php echo base_url('dispatch_tracking') ?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                      Dispatch Track
                      <i class="right fas"></i>
                    </p>
                  </a>

                </li>
                <li class="nav-item">
                  <a href="<?php echo base_url('billing_track') ?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                      Billing Track
                      <i class="right fas"></i>
                    </p>
                  </a>

                </li>
              </ul>
            </li> -->
                        <?php
            }
            ?>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-circle"></i>
                                <p>
                                    Store
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <?php
                if ($this->session->userdata['type'] == 'admin' || $this->session->userdata['type'] == 'Admin' || $this->session->userdata['type'] == 'inward_stores') {
                ?>
                                <li class="nav-item">
                                    <a href="<?php echo base_url('inwarding') ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            In warding
                                            <i class="right fas"></i>
                                        </p>
                                    </a>
                                </li>
                                <?php } ?>
                                <?php
                if ($this->session->userdata['type'] == 'admin' || $this->session->userdata['type'] == 'Admin' || $this->session->userdata['type'] == 'inward_stores' || $this->session->userdata['type'] == 'stores') {
                ?>
                                <li class="nav-item">
                                    <a href="<?php echo base_url('grn_validation') ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            GRN Validation
                                            <i class="right fas"></i>
                                        </p>
                                    </a>
                                </li>

                                <?php } ?>
                                <?php
                if ($this->session->userdata['type'] == 'admin' || $this->session->userdata['type'] == 'Admin' || $user_role == 'inward_quality ' || $user_role == 'inward_quality') {
                ?>
                                <li class="nav-item">
                                    <a href="<?php echo base_url('accept_reject_validation') ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Accept / Reject Validation
                                            <i class="right fas"></i>
                                        </p>
                                    </a>
                                </li>
                                <?php } ?>

                                <?php
                if ($this->session->userdata['type'] == 'admin' || $this->session->userdata['type'] == 'Admin' || $this->session->userdata['type'] == 'stores') {
                ?>
                                <li class="nav-item">
                                    <a href="<?php echo base_url('part_stocks') ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Part Stocks
                                            <i class="right fas"></i>
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo base_url('fw_stock') ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            FG Stock
                                            <i class="right fas"></i>
                                        </p>
                                    </a>
                                </li>
                                <?php } ?>

                                <!-- <li class="nav-item">
                  <a href="<?php echo base_url('supplier') ?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Supplier List</p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="<?php echo base_url('store') ?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                      In warding
                      <i class="right fas"></i>
                    </p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="<?php echo base_url('issue') ?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                      Issue
                      <i class="right fas"></i>
                    </p>
                  </a>

                </li>
                <li class="nav-item">
                  <a href="<?php echo base_url('store_stock') ?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                      Stock
                      <i class="right fas"></i>
                    </p>
                  </a>

                </li> -->

                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-circle"></i>
                                <p>
                                    Job Card
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <?php
                if ($this->session->userdata['type'] == 'admin' || $this->session->userdata['type'] == 'Admin' || $this->session->userdata['type'] == 'inward_stores') {
                ?>
                                <li class="nav-item">
                                    <a href="<?php echo base_url('job_card') ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Create Job Card
                                            <i class="right fas"></i>
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo base_url('job_card_released') ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Released Job Card
                                            <i class="right fas"></i>
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo base_url('job_card_issued') ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            WIP Job Card
                                            <i class="right fas"></i>
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo base_url('job_card_closed') ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Closed Job card
                                            <i class="right fas"></i>
                                        </p>
                                    </a>
                                </li>
                                <?php } ?>


                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-circle"></i>
                                <p>
                                    Sales Invoice
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <?php
                if ($this->session->userdata['type'] == 'admin' || $this->session->userdata['type'] == 'Admin' || $this->session->userdata['type'] == 'inward_stores') {
                ?>
                                <li class="nav-item">
                                    <a href="<?php echo base_url('new_sales') ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Create Sales Invoice
                                            <i class="right fas"></i>
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo base_url('sales_invoice_released') ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            View Sales Invoice
                                            <i class="right fas"></i>
                                        </p>
                                    </a>
                                </li>

                                <?php } ?>


                            </ul>
                        </li>


                        <!-- <li class="nav-item">
            <a href="<?php echo base_url('inwarding') ?>" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>
                Routing
                <i class="right fas"></i>
              </p>
            </a>
          </li> -->
                        <?php
            if ($this->session->userdata['type'] == 'admin' || $this->session->userdata['type'] == 'Admin' || $this->session->userdata['type'] == 'Marketing' || $this->session->userdata['type'] == 'Purchase') {
            ?>
                        <li class="nav-item">
                            <a href="<?php echo base_url('planning_year_page') ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Planning
                                    <i class="right fas"></i>
                                </p>
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                <a href="<?php echo base_url('fw_stock') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    FW Stock
                    <i class="right fas"></i>
                  </p>
                </a>
              </li> -->

                        <?php } ?>

                        <li class="nav-item">
                            <a href="<?php echo base_url('logout') ?>" class="nav-link">
                                <i class="nav-icon fas fa-table"></i>
                                <p>
                                    Logout
                                </p>
                            </a>

                        </li>
                    </ul>
                    </li>


                    </ul>
                </nav>
                <!-- Button trigger modal -->


                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>