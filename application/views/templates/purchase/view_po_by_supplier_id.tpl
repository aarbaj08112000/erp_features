<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <nav aria-label="breadcrumb">
            <div class="sub-header-left pull-left breadcrumb">
                <h1>
                    Purchase
                    <a hijacked="yes" href="#stock/issue_request/index" class="backlisting-link"
                        title="Back to Issue Request Listing">
                        <i class="ti ti-chevrons-right"></i>
                        <em>Supplier PO</em></a>
                </h1>
                <br>
                <span>Generate PO</span>
            </div>
        </nav>
        <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5 listing-btn">
            <a title="Back To Supplier Po List" class="btn btn-seconday" href="<%base_url('new_po_list_supplier')%>" type="button"><i class="ti ti-arrow-left" ></i></i></a>
        </div>
        <div class="card p-0 mt-4">
            <div class="card-header">
                <div class="row">
                    <div class="tgdp-rgt-tp-sect">
                        <p class="tgdp-rgt-tp-ttl">Supplier Name</p>
                        <p class="tgdp-rgt-tp-txt">
                            <%$supplier_data[0]->supplier_name %>
                        </p>
                    </div>
                    <div class="tgdp-rgt-tp-sect">
                        <p class="tgdp-rgt-tp-ttl">Supplier Number</p>
                        <p class="tgdp-rgt-tp-txt">
                            <%$supplier_data[0]->supplier_number %>
                        </p>
                    </div>
                    <div class="tgdp-rgt-tp-sect">
                        <p class="tgdp-rgt-tp-ttl">Supplier Location</p>
                        <p class="tgdp-rgt-tp-txt" title="<%$supplier_data[0]->location %>">
                            <%$supplier_data[0]->location %>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card p-0 mt-4">
            <div class="tabTitle position-relative">
                <h2 id="cc_sh_sys_static_field_3">
                    <span>Parts</span>
                </h2>
                 
                <div class="input-wrapper ">
                  <input type="text" name="datetimes" class="dates form-control" id="date_range_filter" style="display: none;"/>
                  <input type="text" name="reason" placeholder="Filter Search" class="form-control serarch-filter-input m-3 me-0" id="serarch-filter-input" fdprocessedid="bxkoib" >
                </div>
               
                
            </div>
            <div class="card-body p-0 w-100">
                <table class="table table-striped " id="view_po_by_supplier_id_table">
                    <thead>
                        <tr>
                            <!-- <th>Sr. No.</th> -->
                            <th>Type</th>
                            <th>PO Number</th>
                            <th>PO Date</th>
                            <th>Created Date</th>
                            <th>Download PDF PO</th>
                            <th>View PO Details</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <%assign var='i' value=1%>
                            <%if count($new_po)> 0 %>
                                <%foreach from=$new_po item=s %>
                                    <tr>
                                        <!-- <td>
                                            <%$i %>
                                        </td> -->
                                        <td>
                                            <%if (empty($s->process_id)) %>
                                                Normal PO
                                                <%else%>
                                                    Subcon PO
                                                    <%/if%>

                                        </td>
                                        <td>
                                            <%$s->po_number %>
                                        </td>
                                        <td>
                                            <%defaultDateFormat($s->po_date) %>
                                        </td>
                                        <td>
                                            <%defaultDateFormat($s->created_date) %>
                                        </td>
                                        <td>
                                            <%if ($s->status == "accpet") %>
                                                <a href="<%base_url('download_my_pdf/') %><%$s->id %>"
                                                    class="btn btn-primary" href="">Download</a>
                                            <%else%>
                                                <%display_no_character("")%>
                                            <%/if%>
                                        </td>
                                        <td><a href="<%base_url('view_new_po_by_id/') %><%$s->id %>"
                                                class="btn btn-primary" href="">PO Details</a></td>
                                        <td>
                                                                                                                                    

                                            <%if ($s->expired=="yes" ) %>
                                                <%assign var='statusNew' value='Expired' %>
                                            <%else if ($s->status == "accpet") %>
                                                <%assign var='statusNew' value='Released' %>
                                            <%else %>
                                                <%assign var='statusNew' value=$s->status%>
                                            <%/if%>
                                            <%$statusNew %>
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
<!-- / Content -->
<div class="content-backdrop fade"></div>
<script type="text/javascript">
   var current_date = <%$current_date|@json_encode%>;
   var base_url = <%base_url()|@json_encode%>
</script>
<script src="<%$base_url%>public/js/purchase/view_po_by_supplier_id.js"></script>
<style type="text/css">
    #date_range_filter,#serarch-filter-input {
    float: right;
    width: 12%;
    margin: 11px;
}
#serarch-filter-input{
        margin-top: 10px !important;
    margin-right: 10px !important;

}
/* Wrapper for the input to allow positioning of the icon */
.input-wrapper {
      position: absolute;
    display: inline-block;
    
    width: calc(100% - 121px);
}

/* Style for the input itself */
.dates {
  padding-right: 30px; /* Add space for the icon on the right */
  width: 100%; /* Optional: make sure the input takes full width of its parent */
  padding-left: 10px; /* Optional: padding for input text */
  font-size: 16px; /* Input font size */
  border: 1px solid #ccc; /* Optional: border styling */
  border-radius: 4px; /* Optional: rounded corners */
}

/* Adding the icon using ::after on the wrapper */
.input-wrapper::after {
    /* content: '\f073'; */
    font-family: 'Font Awesome 5 Free';
    font-weight: 900;
    position: absolute;
    right: 21px;
    top: 44%;
    transform: translateY(-50%);
    pointer-events: none;
    content: "\fd2f";
    unicode-bidi: isolate;
    font-variant-numeric: tabular-nums;
    text-transform: none;
    text-indent: 0px !important;
    text-align: start !important;
    text-align-last: start !important;
    /* content: "\ea65"; */
    font-family: "tabler-icons" !important;
    speak: none;
    font-style: normal;
    font-weight: normal;
    font-variant: normal;
    text-transform: none;
    line-height: 1;
    -webkit-font-smoothing: antialiased;
    font-size: 21px;
}

</style>
<!-- Content wrapper -->
