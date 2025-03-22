<div class="wrapper">
   <!-- Navbar -->
   <!-- /.navbar -->
   <!-- Main Sidebar Container -->
   <!-- Content Wrapper. Contains page content -->
   <div class="container-xxl flex-grow-1 container-p-y">
      <!-- Content Header (Page header) -->
      <nav aria-label="breadcrumb">
      <div class="sub-header-left pull-left breadcrumb">
        <h1>
        Inwarding
          <a hijacked="yes" href="javascript:void(0)" class="backlisting-link" title="">
            <i class="ti ti-chevrons-right"></i>
            <em>Subcon View</em></a>
           
          </h1>
          <br>
          <span>History</span>
        </div>
      </nav>

      <!-- Main content -->
      <section class="">
         <div class="">
            <div class="row">
               <div class="col-12">
                  <!-- /.card -->
                  <div class="card">
                     <div class="">
                        <table class="table  table-striped w-100" id="history_table">
                           <thead>
                              <tr>
                                 <th>Sr No</th>
                                 <th>Challan Number</th>
                                 <th>Challan Inwarding Qty</th>
                                 <th>Date & Time </th>
                                 <th>Actions</th>
                              </tr>
                           </thead>
                           <tbody>
                              <%if ($subcon_po_inwarding_history) %>
                                    <%assign var=final_po_amount value=0 %>
                                    <%assign var=i value=1 %>

                                        <%foreach from=$subcon_po_inwarding_history item=p %>
                                          <tr>
                                             <td><%$i%></td>
                                             <td><%$p->challan_data->challan_number%></td>
                                             <td><%$p->new_qty%></td>
                                             <td><%$p->created_date%>/<%$p->created_time%></td>
                                             <td>
                                                <a href="" class="btn btn-danger btn-sm">Delete</a>
                                             </td>
                                          </tr>
                                          <%assign var=i value=$i+1 %>
                                        <%/foreach%>
                                <%/if%>
                           </tbody>
                           <tfoot>
                              <%if ($po_parts) %>
                              <tr>
                                 <th colspan="11">Total</th>
                                 <th><%$final_po_amount%></th>
                              </tr>
                              <%/if%>
                           </tfoot>
                        </table>
                     </div>
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
  <script type="text/javascript">
  var base_url = <%$base_url|@json_encode%>
</script>

  <script src="<%$base_url%>public/js/store/subcon_po_inwarding_history.js"></script>
<!-- /.content-wrapper -->