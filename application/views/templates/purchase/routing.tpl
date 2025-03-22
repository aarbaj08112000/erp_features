
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
                        <em>Sub Con</em></a>
                </h1>
                <br>
                <span>Subcon Routing</span>
            </div>
        </nav>
        <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5 listing-btn">
            <%if checkGroupAccess("routing","export","No")%>
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
                <table class="table table-striped" style="border-collapse: collapse;" id="routing_view">
                <thead>
                <tr>
                    <!-- <th>Sr. No.</th> -->
                    <th>Part Number</th>
                    <th>Part Description</th>
                    <th>Weight</th>
                    <th>Size</th>
                    <th>Thickness</th>
                    <th>Add Routing</th>
                </tr>
            </thead>
            <tbody>
                <%assign var="i" value=1%>
                <%if count($child_part_master) > 0 %>
                    <%foreach from=$child_part_master item=poo %>
                        <%if ($poo->sub_type == "Subcon grn" || $poo->sub_type == "Subcon Regular") %>
                            <tr>
                                <!-- <td><%$i %></td> -->   
                                <td><%$poo->part_number %></td>
                                <td><%$poo->part_description %></td>
                                <td><%$poo->weight %></td>
                                <td><%$poo->size %></td>
                                <td><%$poo->thickness %></td>
                                <td>
                                    <%if checkGroupAccess("routing","add","No")%>
                                        <a class="btn btn-primary"
                                            href="<%base_url('addrouting/') %><%$poo->id %>">Add
                                            Routing</a>
                                    <%else%>
                                        <%display_no_character()%>
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
    </div>


    <!-- Main content -->

</div>
<script>
    var base_url = <%$base_url|json_encode %> ;
</script>
<script src="<%$base_url%>public/js/purchase/routing_view.js"></script>
