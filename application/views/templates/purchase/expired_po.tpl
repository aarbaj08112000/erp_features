
<div class="wrapper">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <nav aria-label="breadcrumb">
                <div class="sub-header-left pull-left breadcrumb">
                    <h1>
                        Purchase
                        <a hijacked="yes" href="#stock/issue_request/index" class="backlisting-link"
                            title="Back to Issue Request Listing">
                            <i class="ti ti-chevrons-right"></i>
                            <em>Regular PO</em></a>
                    </h1>
                    <br>
                    <span>Expired PO</span>
                </div>
            </nav>
            <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5 listing-btn">
          <%if checkGroupAccess("expired_po","export","No")%>
          <button class="btn btn-seconday" type="button" id="downloadCSVBtn" title="Download CSV"><i class="ti ti-file-type-csv"></i></button>
          <button class="btn btn-seconday" type="button" id="downloadPDFBtn" title="Download PDF"><i class="ti ti-file-type-pdf"></i></button>
          <%/if%>
          
          
        </div>
            <div class="w-100">
                <input type="text" name="reason" placeholder="Filter Search" class="form-control serarch-filter-input m-3 me-0" id="serarch-filter-input" fdprocessedid="bxkoib">
            </div>
            <div class="card p-0 mt-4 w-100">

                <!-- /.card-header -->
                <div class="">
                    <table class="table table-striped" style="border-collapse: collapse;" id="expire_po_view">
                        <thead>
                            <tr>
                                <!-- <th>Sr. No.</th> -->
                                <th>PO Number</th>
                                <th>PO Date</th>
                                <th>Created Date</th>
                                <th>Download PDF PO</th>
                                <th>View PO Details</th>
                            </tr>
                        </thead>

                        <tbody>
                            <%assign var='i' value=1%>
                            <%if ($new_po) %>
                                <%foreach from=$new_po item=s %>
                                    <%if ($s->status=='expired' || $s->expiry_po_date < date('Y-m-d')) %>  
                                        <tr>
                                           <!-- <td><%$i %></td>-->
                                            <td><%$s->po_number %></td>
                                            <td><%defaultDateFormat($s->po_date) %></td>
                                            <td><%defaultDateFormat($s->created_date) %></td>
                                            <td>
                                                <%if ($s->status == "accept") %>
                                                    <a href="<%base_url('download_my_pdf/') %><%$s->id %>" class="btn btn-primary" href="">Download</a>
                                                <%else%>
                                                <%display_no_character("")%>
                                                <%/if%>
                                            </td>
                                            <td><a href="<%base_url('view_new_po_by_id/') %><%$s->id %>" class="btn btn-primary" href="">PO Details</a></td>
                                        </tr>
                                    <%assign var='i' value=$i+1%>                                                 
                                    <%/if%>
                                <%/foreach%>
                            <%/if%>

                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>


        <!-- Main content -->

    </div>
    <script>
        var base_url = <%$base_url|json_encode %> ;
    </script>
    <script src="<%$base_url%>public/js/purchase/expire_po_view.js"></script>