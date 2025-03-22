<div class="container-xxl flex-grow-1 container-p-y">
<div class="content-wrapper">
   
   <nav aria-label="breadcrumb">
      <div class="sub-header-left pull-left breadcrumb">
        <h1>
          Quality
          <a hijacked="yes" href="javascript:void(0)" class="backlisting-link" title="Back to Issue Request Listing">
            <i class="ti ti-chevrons-right"></i>
            <em>Production Details</em></a>
          </h1>
          <br>
          <span>Production Details</span>
        </div>
      </nav>
      <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5">
         <a class="btn  btn-seconday"
            href="<%base_url('view_p_q') %>" title="Back To Production Qty">
         <i class="ti ti-arrow-left" ></i></a>
      </div>
   <section class="content">
      <div>
         <div class="row">
            <br>
            <div class="col-lg-12">
               <div class="card">
                  <div class="card-header">
                     <div class="row">
                        <div class="tgdp-rgt-tp-sect">
                           <p class="tgdp-rgt-tp-ttl">Status</p>
                           <p class="tgdp-rgt-tp-txt"><%$p_q_data[0]->status %></p>
                        </div>
                        <div class="tgdp-rgt-tp-sect">
                           <p class="tgdp-rgt-tp-ttl">Accepted Qty</p>
                           <p class="tgdp-rgt-tp-txt"><%$p_q_data[0]->accepted_qty %></p>
                        </div>
                        <div class="tgdp-rgt-tp-sect">
                           <p class="tgdp-rgt-tp-ttl">Rejection Qty</p>
                           <p class="tgdp-rgt-tp-txt"><%$p_q_data[0]->rejected_qty %></p>
                        </div>

                        <%if (!empty($p_q_data[0]->rejected_qty)) %>
                           <div class="tgdp-rgt-tp-sect">
                              <p class="tgdp-rgt-tp-ttl">Rejection Remark</p>
                              <p class="tgdp-rgt-tp-txt"><%$p_q_data[0]->rejection_remark %></p>
                           </div>
                           <div class="tgdp-rgt-tp-sect">
                              <p class="tgdp-rgt-tp-ttl">Rejection Reason</p>
                              <p class="tgdp-rgt-tp-txt"><%$p_q_data[0]->rejection_reason %></p>
                           </div>
                      <%/if%>
                     </div>
                  </div>
               </div>
               <div class="card p-0 mt-4">
                 
                  <!-- /.card-header -->
                  <div class="table-container">
                     <table id="example1" class="table scrollable table-striped">
                        <thead>
                           <tr>
                              <!-- <th>Sr No</th> -->
                              <th>Input Part Number / Description</th>
                              <th>Total Req Qty</th>
                              <th>Date & Time</th>
                           </tr>
                        </thead>
                        <tbody>
                           <%if ($p_q_history) %>
                                <%assign var='i' value=1 %>
                                <%foreach from=$p_q_history item=u %>
                               <tr>
                                  <!-- <td><%$u->input_part_number %></td> -->
                                  <td><%$u->output_part_data[0]->part_number %> /
                                     <%$u->output_part_data[0]->part_description %>
                                  </td>
                                  <td><%$u->req_qty %></td>
                                  <td><%$u->created_date %>/ <%$u->created_time %></td>
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
      </div>
      <!-- /.container-fluid -->
   </section>
   <!-- /.content -->
</div>
