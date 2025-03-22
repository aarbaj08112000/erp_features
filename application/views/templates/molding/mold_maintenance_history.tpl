<div style="" class="wrapper container-xxl flex-grow-1 container-p-y">
    <div class="content-wrapper">
        
        <nav aria-label="breadcrumb">
      <div class="sub-header-left pull-left breadcrumb">
        <h1>
          Reports
          <a hijacked="yes" href="#stock/issue_request/index" class="backlisting-link" title="Back to Issue Request Listing">
            <i class="ti ti-chevrons-right"></i>
            <em>Mold Life Report</em></a>
        </h1>
        <br>
        <span>Mold History</span>
      </div>
    </nav>
    <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5 listing-btn">
            <a title="Back To Mold Life Report" class="btn btn-seconday" href="<%base_url('mold_maintenance_report')%>" type="button"><i class="ti ti-arrow-left"></i></a>

        </div>
        <section class="content">
        <div class="">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            
                            <div class="row">
                                <div class="tgdp-rgt-tp-sect">
                                    <p class="tgdp-rgt-tp-ttl">Customer Part</p>
                                    <p class="tgdp-rgt-tp-txt" title="<%$customer_part_data[0]->part_number%><%$customer_part_data[0]->part_description%>">
                                    <%$customer_part_data[0]->part_number%><%$customer_part_data[0]->part_description%>
                                    </p>
                                </div>
                                <div class="tgdp-rgt-tp-sect">
                                    <p class="tgdp-rgt-tp-ttl">Customer Name</p>
                                    <p class="tgdp-rgt-tp-txt" title="<%$customer_data[0]->customer_name%>">
                                    <%$customer_data[0]->customer_name%>
                                    </p>
                                </div>
                                <div class="tgdp-rgt-tp-sect">
                                    <p class="tgdp-rgt-tp-ttl">Mold Name</p>
                                    <p class="tgdp-rgt-tp-txt" title="<%$mld_data[0]->mold_name%>">
                                    <%$mld_data[0]->mold_name%>
                                    </p>
                                </div>
                                <div class="tgdp-rgt-tp-sect">
                                    <p class="tgdp-rgt-tp-ttl">Cavities</p>
                                    <p class="tgdp-rgt-tp-txt" title="<%$mld_data[0]->no_of_cavity%>">
                                    <%$mld_data[0]->no_of_cavity%>
                                    </p>
                                </div>
                                <div class="tgdp-rgt-tp-sect">
                                    <p class="tgdp-rgt-tp-ttl">Life Over Frequency</p>
                                    <p class="tgdp-rgt-tp-txt" title="<%$mld_data[0]->target_life%>">
                                    <%$mld_data[0]->target_life%>
                                    </p>
                                </div>
                                <div class="tgdp-rgt-tp-sect">
                                    <p class="tgdp-rgt-tp-ttl">Total Molding Prod QTY</p>
                                    <p class="tgdp-rgt-tp-txt" title="<%$mld_data[0]->target_over_life%>">
                                    <%$mld_data[0]->target_over_life%>
                                    </p>
                                </div>
                               
                               
                                
                            </div>

                        </div>

                    </div>
                    <div class="card p-0 mt-4">
                        <div class="">
                            <table class="table scrollable table-striped" id="example1">
                                <thead>
                                    <tr>
                                        <th>Sr No</th>
                                        <th>Mold PM Frequency</th>
                                        <th>Molding Prod QTY</th>
                                        <th>Last PM Date</th>
                                        <th>Doc</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <%if $mold_maintenance_history%>
                                        <%assign var=final_po_amount value=0%>
                                        <%assign var=i value=1%>
                                        <%assign var=totalQuantity value=0%>
                                        <%foreach from=$mold_maintenance_history item=p%>
                                           
                                            <%assign var=totalQuantity value=0%>
                                            <%foreach from=$molding_production_quantity_data item=molding_data%>
                                                <%assign var=totalQuantity value=$totalQuantity+$molding_data->qty%>
                                            <%/foreach%>
                                            
                                            <%if !empty($p->doc)%>
                                                <tr>
                                                    <td><%$i%></td>
                                                    <td><%$p->target_life%></td>
                                                    <td><%$p->current_molding_prod_qty%></td>
                                                    <td><%$p->pm_date%></td>
                                                    <td>
                                                        <%if !empty($p->doc)%>
                                                            <a title="Download" class="" download href="<%base_url('documents/')%><%$p->doc%>"><i class="ti ti-download" aria-hidden="true"></i> </a>
                                                        <%/if%>
                                                    </td>
                                                </tr>
                                            <%/if%>
                                            <%assign var=i value=$i+1%>
                                        <%/foreach%>
                                    <%/if%>
                                </tbody>

                                <tfoot>
                                    <%if $po_parts%>
                                        <tr>
                                            <th colspan="11">Total</th>
                                            <th><%$final_po_amount%></th>
                                        </tr>
                                    <%/if%>
                                </tfoot>

                            </table>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
</div>
