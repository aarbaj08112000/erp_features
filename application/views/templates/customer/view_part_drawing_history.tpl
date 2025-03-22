    <%if $entitlements.isPLMEnabled%>
    <div class="wrapper">
        <!-- Navbar -->

        <!-- /.navbar -->

        <!-- Main Sidebar Container -->


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper wrapper container-xxl flex-grow-1 container-p-y">
            
            <nav aria-label="breadcrumb">
                <div class="sub-header-left pull-left breadcrumb">
                  <h1>
                    Planning &amp; Sales
                    <a hijacked="yes" href="#stock/issue_request/index" class="backlisting-link" title="Back to Issue Request Listing">
                      <i class="ti ti-chevrons-right"></i>
                      <em>Customer Master</em></a>
                  </h1>
                  <br>
                  <span>Customer Part Drawing</span>
                </div>
                </nav>
            <!-- Main content -->
            <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5 listing-btn">
            <a title="Back To Customer Part" class="btn btn-seconday" href="<%$base_url%>customer_part_drawing/<%$customerid%>" type="button"><i class="ti ti-arrow-left"></i></a>
        </div>

            <section class="">
                <div class="">
                            <!-- /.card -->
                            <div class="card p-0 mt-4">
                                <div class="card-header">
                                <div class="row">
                                    <div class="tgdp-rgt-tp-sect">
                                        <p class="tgdp-rgt-tp-ttl">Customer Name</p>
                                        <p class="tgdp-rgt-tp-txt">
                                            <%$customer_data[0]->customer_name%>
                                        </p>
                                    </div>
                                    <div class="tgdp-rgt-tp-sect">
                                        <p class="tgdp-rgt-tp-ttl">Part Name</p>
                                        <p class="tgdp-rgt-tp-txt">
                                            <%$customer_part[0]->part_number%>
                                        </p>
                                    </div>
                                    <div class="tgdp-rgt-tp-sect">
                                        <p class="tgdp-rgt-tp-ttl">Part Description</p>
                                        <p class="tgdp-rgt-tp-txt">
                                            <%$customer_part[0]->part_description%>
                                        </p>
                                    </div>
                                
                                 
                                </div>
                        </div>
                    </div>
                        <div class="card p-0 mt-4">
                                <!-- /.card-header -->
                                <div class="">
                                    <table  class="table scrollable table-striped w-100">
                                        <thead>
                                            <tr>
                                                <th>Sr. No.</th>
                                                <th>Revision Number</th>
                                                <th>Revision Date</th>
                                                <th>Revision Remark</th>
                                                <th>Drawing</th>
                                                <th>Cad File</th>
                                                <th>3D Model</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                            <%assign var="i" value=1%>
                                            <%if $customer_part_rate%>
                                                <%foreach from=$customer_part_rate item=poo%>
                                                    <%if true%>
                                                        <tr>
                                                            <td><%$i%></td>
                                                            <td><%$poo->revision_no%></td>
                                                            <td><%$poo->revision_date%></td>
                                                            <td><%$poo->revision_remark%></td>
                                                            <td>
                                                                <%if $poo->drawing != ""%>
                                                                    <a download href="<%$base_url%>documents/<%$poo->drawing%>" id="" class=" remove_hoverr "><i class="ti ti-download"></i></a>
                                                                <%/if%>
                                                            </td>
                                                            <td>
                                                                <%if $poo->cad != ""%>
                                                                    <a download href="<%$base_url%>documents/<%$poo->cad%>" id="" class=" "><i class="ti ti-download"></i></a>
                                                                <%/if%>
                                                            </td>
                                                            <td>
                                                                <%if $poo->model != ""%>
                                                                    <a download href="<%$base_url%>documents/<%$poo->model%>" id="" class=" "><i class="ti ti-download"></i></a>
                                                                <%/if%>
                                                                
                                                            </td>
                                                        </tr>
                                                        <%assign var="i" value=$i+1%>
                                                    <%/if%>
                                                <%/foreach%>
                                            <%/if%>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
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
    <%/if%>
    <!-- /.content-wrapper -->
