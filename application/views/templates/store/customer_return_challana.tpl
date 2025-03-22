<div class="content-wrapper">
   <!-- Navbar -->
   <!-- /.navbar -->
   <!-- Main Sidebar Container -->
   <!-- Content Wrapper. Contains page content -->
   <div class="container-xxl flex-grow-1 container-p-y">
      <!-- Content Header (Page header) -->
      <nav aria-label="breadcrumb">
         <div class="sub-header-left pull-left breadcrumb">
            <h1>
               Store
               <a hijacked="yes" href="javascript:void(0)" class="backlisting-link" title="">
               <i class="ti ti-chevrons-right"></i>
               <em>Challan</em></a>
            </h1>
            <br>
            <span>Customer Challan Inward</span>
         </div>
      </nav>
      <!-- Main content -->
      <section class="content">
         <div class="">
            <div class="row">
               <div class="col-12">
                  <!-- /.card -->
                  <%if checkGroupAccess("challan_inward","add","No")%>
                  <div class="card p-0 mt-4">
                     <div class="card-header">
                        <form action="<%base_url('generate_customer_challan_return') %>" method="POST" id="generate_customer_challan_return" class="generate_customer_challan_return custom-form">
                           <div class="row">
                              <div class="col-lg-3">
                                 <div class="form-group mb-3">
                                    <label class="form-label" for="">Customer<span class="text-danger">*</span> </label>
                                    <select name="customer_id"  id="customer_id" class="form-control select2 required-input" <%if ($new_sales->customer_id > 0) %>disabled<%/if%>>
                                       <%foreach from=$customer item=s %>
                                       <option value="<%$s->id %>" <%if ($new_sales->customer_id == $s->id)%>selected<%/if%>>
                                          <%$s->customer_name %>
                                       </option>
                                       <%/foreach%>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-lg-3">
                                 <div class="form-group mb-3">
                                    <label class="form-label" for="">Customer Challan No</label><span class="text-danger">*</span></label>
                                    <input type="text" placeholder="Customer Challan No" name="customer_challan_no" class="form-control required-input" >
                                 </div>
                              </div>
                              <div class="col-lg-3">
                                 <div class="form-group mb-3">
                                    <label class="form-label" for="on click url">Date
                                    <span class="text-danger">*</span></label>
                                    <input type="date"
                                       value="" name="customer_date"
                                       class="form-control required-input" >
                                 </div>
                              </div>
                              <div class="col-lg-3">
                                 <div class="form-group mb-3">
                                    <label class="form-label" for="">Type<span class="text-danger">*</label>
                                    <select name="type" id="type" class="form-control select2 required-input" >
                                       <option value="">Select</option>
                                       <option value="returnable" >Returnable</option>
                                       <option value="non_returnable">Non Returnable</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-lg-3">
                                 <div class="form-group">
                                    <button type="submit" class="btn btn-primary mt-4">Generate Request</button>
                                 </div>
                        </form>
                        </div>
                        </div>
                     </div>
                  </div>
                  <%/if%>
                  <div class="w-100 mt-3">
            <input type="text" name="reason" placeholder="Filter Search" class="form-control serarch-filter-input m-3 me-0" id="serarch-filter-input" fdprocessedid="bxkoib">
        </div>
                  <div class="card mt-4 w-100">
                     <div class="">
                        <table id="challan_inward" class="table  table-striped">
                           <thead>
                              <tr>
                                 <!-- <th>Sr No</th> -->
                                 <th>CCN NO</th>
                                 <th>Customer</th>
                                 <th>Type</th>
                                 <th>Customer Challan No</th>
                                 <th>Customer Challan Date</th>
                                 <th>View Details</th>
                              </tr>
                           </thead>
                           <tbody>
                              <%if ($customer_challan_return) %>
                              <%assign var='i' value=0%>
                              <%foreach from=$customer_challan_return item=u %>
                              <%if ($u->type != "returnable") %>
                              <%assign var='type' value="Non Returnable"%>
                              <%else %>
                              <%assign var='type' value="Returnable"%>
                              <%/if%>
                              <tr>
                                 <!-- <td><%$i%></td> -->
                                 <td><%$u->grn_code%></td>
                                 <td><%$u->customer_name%></td>
                                 <td><%$type%></td>
                                 <td><%$u->customer_challan_no%></td>
                                 <td><%$u->customer_challan_data%></td>
                                 <td>
                                    <a class="" href="<%base_url('view_challan_return/')%><%$u->customer_challan_return_id %>">
                                    <i class="ti ti-history">
                                    </i>
                                    </a>
                                 </td>
                              </tr>
                              <%assign var='i' value=$i+1%>
                              <%/foreach%>
                              <%/if%>
                           </tbody>
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
<style type="text/css">
   .hide {
   display: none;
   }
</style>
<script src="<%$base_url%>/public/js/store/challan_inward.js"></script>
<!-- /.content-wrapper -->