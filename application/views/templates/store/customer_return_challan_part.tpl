<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <nav aria-label="breadcrumb">
         <div class="sub-header-left pull-left breadcrumb">
            <h1>
               Store
               <a hijacked="yes" href="javascript:void(0)" class="backlisting-link" title="">
               <i class="ti ti-chevrons-right"></i>
               <em>Customer Parts Return</em></a>
            </h1>
            <br>
            <span>Customer Parts Return</span>
         </div>
      	</nav>

        <!-- Main content -->
        <section class="content">
            <div class="">
                <div class="row">
                    <div class="col-12">
                        <!-- /.card -->
                        <%if checkGroupAccess("challan_part_return","add","No")%>
                        <div class="card mt-4">
                            <div class="card-header">
                            	 <form action="<%base_url('generate_customer_challan_return_part') %>" method="POST"  class="generate_customer_challan_return_part custom-form" id="generate_customer_challan_return_part">
                                <div class="row">
                                	
                                <div class="row">
                                    <div class="col-lg-3 ">
                                        <div class="form-group mb-3">
                                                <label class="form-label" for="">Select Customer<span class="text-danger">*</span> </label>
                                                <select name="customer_id"  id="customer_id_box" class="form-control select2 required-input" <%if ($new_sales->customer_id > 0) %>disabled<%/if%> >
                                                	<option value="">Select Customer</option>
                                                    <%foreach from=$customer item=s %>
                                                            <option value="<%$s->id %>" <%if ($new_sales->customer_id == $s->id)%>selected<%/if%>>
                                                                <%$s->customer_name %></option>
                                                    <%/foreach%>
                                                </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 mb-3">
                                        <div class="form-group">
                                            <label class="form-label" for="">Reference Challan Number</label></label>
                                            <input type="text" placeholder="Reference Challan Number" name="customer_challan_no" class="form-control" value="" >
                                        </div>
                                    </div>
                                    <div class="col-lg-3 mb-3">
                                        <div class="form-group">
                                                <label class="form-label" for="">Transporter </label>
                                                <select name="transportor_id"  id="transportor_id_box" class="form-control select2 " >
                                                    <option value="">Select Transporter</option>
                                                    <%foreach from=$transporter item=s %>
                                                       	<option value="<%$s->id %>"><%$s->name%>-<%$s->transporter_id%></option>
                                                    <%/foreach%>
                                                    
                                                </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 mb-3">
                                        <div class="form-group">
                                            <label class="form-label" for="">Vehicle No.</label></label>
                                            <input type="text" placeholder="Vehicle No." name="vehicle_number" class="form-control" value="" >
                                        </div>
                                    </div>

                                </div>

                                    <div class="col-lg-12 mt-3">
                                    	<label for="">Customer Part<span class="text-danger">*</span> </label>
                                    	<div class="mt-3" style="border: 1px solid #eee3e3;">
                                    	<table class="table table-striped   " id="part_data">
										  <thead>
										    <tr>
										      <th scope="col">Part Name/Part Description</th>
										      <th scope="col" class="text-center">Available Qty</th>
										      <th scope="col" class="text-center">Requested Qty</th>
										    </tr>
										  </thead>
										  <tbody>
										  	<tr class="text-center">
										  		<td colspan="3">No part data found.</td>
										  	</tr>
										    
										  </tbody>
										</table>
									</div>
                                    </div>
                                   
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary mt-4">Generate Request</button>
                                        </div>
                                        
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <%/if%>
                        <div class="w-100 mt-3">
            <input type="text" name="reason" placeholder="Filter Search" class="form-control serarch-filter-input m-3 me-0" id="serarch-filter-input" fdprocessedid="bxkoib">
        </div>
                        <div class="card mt-4 w-100">

                            <div class="">
                                <table id="challan_inward" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th style="display: none;">Sr No</th>
                                            <th>CR NO</th>
                                            <th>Customer</th>
                                            <th>Reference Challan Number</th>
                                            <th>Created Date</th>
                                            <th>Status</th>
                                            <th>View Details</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <%assign var='i' value=1 %>
                                        <%foreach from=$customer_challan_part_return item=u %>
                                                  <tr>
                                                    <td style="display: none;"><%$u->customer_challan_part_return_id%></td>
                                                    <td><%$u->grn_code %></td>
                                                    <td><%$u->customer_name %></td>
                                                    <td><%display_no_character($u->customer_challan_no)%></td>
                                                    <td><%defaultDateFormat($u->created_date)%></td>
                                                    <td><%$u->status%></td>
                                                    <td>
                                                        <a class="" href="<%base_url('challan_part_return_details/')%><%$u->customer_challan_part_return_id %>">
                                                            <i class="ti ti-history">
                                                            </i>
                                                        </a>
                                                    </td>

                                                </tr>
                                           	<%assign var='i' value=$i+1 %>
                                        <%/foreach%>
                                        
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
<script type="text/javascript">
	var base_url = <%base_url()|@json_encode%>
</script>
<script src="<%$base_url%>/public/js/store/challan_part_return.js"></script>

<!-- /.content-wrapper -->