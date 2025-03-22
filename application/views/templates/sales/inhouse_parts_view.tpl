<div class="wrapper wrapper container-xxl flex-grow-1 container-p-y">
    <div class="content-wrapper">
        
        <nav aria-label="breadcrumb">
	      <div class="sub-header-left pull-left breadcrumb">
	        <h1>
	          Planning & Sales
	          <a hijacked="yes" href="javascript:void(0)" class="backlisting-link">
	            <i class="ti ti-chevrons-right"></i>
	            <em>Inhouse Parts</em></a>
	          </h1>
	          <br>
	          <span>Inhouse Parts</span>
	        </div>
	      </nav>
	      <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5 listing-btn">
            <%if checkGroupAccess("inhouse_parts_view","add","No") %>
              <button class="btn btn-seconday filter-icon add-part-data" type="button" title="Add Inhouse Parts"><i class="ti ti-plus"></i></button>
            <%/if%>
      		<%if checkGroupAccess("inhouse_parts_view","export","No") %>
		      <button class="btn btn-seconday" type="button" id="downloadCSVBtn" title="Download CSV"><i class="ti ti-file-type-csv"></i></button>
		      <button class="btn btn-seconday" type="button" id="downloadPDFBtn" title="Download PDF"><i class="ti ti-file-type-pdf"></i></button>
            <%/if%>
            
		    </div>
        <section class="content">
            <div class="">
                <div class="row">
                    <div class="col-12">
                        <div class="w-100">
                        <input type="text" name="reason" placeholder="Filter Search" class="form-control serarch-filter-input m-3 me-0" id="serarch-filter-input" fdprocessedid="bxkoib">
                        </div>
                        <div class="card w-100">
                           
                            <div class="">
                            
                                <table width="100%" border="1" cellspacing="0" cellpadding="0" class="table table-striped" style="border-collapse: collapse;" border-color="#e1e1e1" id="inhouse_parts_view">
						        <thead>
						            <tr>
						                <%foreach from=$data key=key item=val%>
						                <th><b>Search <%$val['title']%></b></th>
						                <%/foreach%>
						            </tr>
						        </thead>
						        <tbody></tbody>
						    </table>
                            </div>
                           </div>
                      </div>
                 </div>
            </div>
        </section>
        <div class="modal fade" id="edit_inhouse_part" role="dialog"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Update Details
                                                                </h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                    aria-label="Close">
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form
                                                                    action="<%base_url('update_child_part_view_inhouse') %>"
                                                                    method="POST" id="update_child_part_view_inhouse" class="update_child_part_view_inhouse custom-form">
                                                                    <div class="row">
                                                                        <div class="col-lg-6">
                                                                            <div class="form-group">
                                                                                <label for="part_number">Part
                                                                                    Number</label><span
                                                                                    class="text-danger">*</span>
                                                                                <input readonly type="text"
                                                                                    value=""
                                                                                    name="part_number" 
                                                                                    class="form-control required-input"
                                                                                    id="part_number_val"
                                                                                    placeholder="Part Number">
                                                                                <input type="hidden" name="part_id"
                                                                                    value="" id="part_id_val">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="form-group">
                                                                                <label for="Client_name">Part
                                                                                    Description</label><span
                                                                                    class="text-danger">*</span>
                                                                                <input type="text"
                                                                                    value=""
                                                                                    name="part_description" 
                                                                                    class="form-control required-input"
                                                                                    id="part_description_val"
                                                                                    placeholder="Part Description">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="form-group">
                                                                                <label for="safty_buffer_stk">Safety
                                                                                    Buffer Stock</label><span
                                                                                    class="text-danger">*</span>
                                                                                <input type="text"
                                                                                    value=""
                                                                                    name="saft_stk" 
                                                                                    class="form-control required-input onlyNumericInput"
                                                                                    id="saft_stk_val"
                                                                                    placeholder="Part Specification">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">

                                                                            <div class="form-group">
                                                                                <label for="hsn_code">HSN
                                                                                    Code</label><span
                                                                                    class="text-danger">*</span>
                                                                                <input type="text"
                                                                                    value=""
                                                                                    name="hsn_code" 
                                                                                    class="form-control required-input"
                                                                                    id="hsn_code_val"
                                                                                    placeholder="Part Specification">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="form-group">
                                                                                <label for="sub_type">Child Sub
                                                                                    Type</label>
                                                                                <input readonly type="text"
                                                                                    value=""
                                                                                    name="sub_type" 
                                                                                    class="form-control "
                                                                                     id="sub_type_val"
                                                                                    placeholder="Part Specification">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="form-group">
                                                                                <label for="store_rack_location">Store
                                                                                    Rack Location</label><span
                                                                                    class="text-danger">*</span>
                                                                                <input type="text"
                                                                                    value=""
                                                                                    name="store_rack_location" 
                                                                                    class="form-control required-input"
                                                                                    id="store_rack_location_val"
                                                                                    placeholder="Part Specification">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="form-group">
                                                                                <label for="UOM">UOM
                                                                                    Name</label><span
                                                                                    class="text-danger">*</span>
                                                                                <select class="form-control select2 required-input"
                                                                                    name="uom_id" id="uom_id_val" style="width: 100%;">
                                                                                    <%foreach from=$uom item=c %>
                                                                                    <option 
                                                                                        value="<%$c->id %>">
                                                                                        <%$c->uom_name %>
                                                                                    </option>
                                                                                    <%/foreach%>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="form-group">
                                                                                <label for="max_uom">Max
                                                                                    PO Quantity</label><span
                                                                                    class="text-danger">*</span>
                                                                                <input type="text"
                                                                                    value=""
                                                                                    name="max_uom" 
                                                                                    class="form-control required-input onlyNumericInput"
                                                                                    id="max_uom_val"
                                                                                    placeholder="Part Specification">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="form-group">
                                                                                <label for="max_uom">Store Stock
                                                                                    Rate</label><span
                                                                                    class="text-danger">*</span>
                                                                                <input type="text"
                                                                                    value=""
                                                                                    id="store_stock_rate_val"
                                                                                    name="store_stock_rate" 
                                                                                    class="form-control required-input onlyNumericInput"
                                                                                    placeholder="Part Specification">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="form-group">
                                                                                <label for="max_uom">Weight</label><span
                                                                                    class="text-danger">*</span>
                                                                                <input type="text"
                                                                                    value=""
                                                                                     id="weight_val"
                                                                                    name="weight" 
                                                                                    class="form-control required-input"
                                                                                    >
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="form-group">
                                                                                <label for="max_uom">Size</label>
                                                                                <input type="text"
                                                                                    value=""
                                                                                    id="size_val"
                                                                                    name="size" class="form-control "
                                                                                   >
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="form-group">
                                                                                <label
                                                                                    for="max_uom">Thickness</label>
                                                                                <input type="text"
                                                                                    value=""
                                                                                    name="thickness"
                                                                                    id="thickness_val"
                                                                                    class="form-control"
                                                                                    >
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Close</button>
                                                                        <button type="submit"
                                                                            class="btn btn-primary">Save
                                                                            changes</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
        <div class="modal fade" id="add_inhouse_part" role="dialog"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Add Inhouse Parts
                                                                </h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                    aria-label="Close">
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form
                                                                    action="<%base_url('add_inhouse_parts') %>"
                                                                    method="POST" id="add_inhouse_parts" class="add_inhouse_parts custom-form">
                                                                    <div class="row">
                                                                        <div class="col-lg-6">
                                                                            <div class="form-group">
                                                                                <label for="part_number">Part
                                                                                    Number</label><span
                                                                                    class="text-danger">*</span>
                                                                                <input  type="text"
                                                                                    value=""
                                                                                    name="part_number" 
                                                                                    class="form-control required-input"
                                                                                    placeholder="Part Number">
                                                                                
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="form-group">
                                                                                <label for="Client_name">Part
                                                                                    Description</label><span
                                                                                    class="text-danger">*</span>
                                                                                <input type="text"
                                                                                    value=""
                                                                                    name="part_desc" 
                                                                                    class="form-control required-input"
                                                                                    placeholder="Part Description">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="form-group">
                                                                                <label for="safty_buffer_stk">Safety
                                                                                    Buffer Stock</label><span
                                                                                    class="text-danger">*</span>
                                                                                <input type="text"
                                                                                    value=""
                                                                                    name="safty_buffer_stk" 
                                                                                    class="form-control required-input onlyNumericInput"
                                                                                    placeholder="Part Specification">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">

                                                                            <div class="form-group">
                                                                                <label for="hsn_code">HSN
                                                                                    Code</label><span
                                                                                    class="text-danger">*</span>
                                                                                <input type="text"
                                                                                    value=""
                                                                                    name="hsn_code" 
                                                                                    class="form-control required-input"
                                                                                    placeholder="Part Specification">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="form-group">
                                                                                <label for="store_rack_location">Store
                                                                                    Rack Location</label><span
                                                                                    class="text-danger">*</span>
                                                                                <input type="text"
                                                                                    value=""
                                                                                    name="store_rack_location" 
                                                                                    class="form-control required-input"
                                                                                    placeholder="Part Specification">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="form-group">
                                                                                <label for="UOM">UOM
                                                                                    Name</label><span
                                                                                    class="text-danger">*</span>
                                                                                <select class="form-control select2 required-input"
                                                                                    name="uom_id" id="uom_id_val" style="width: 100%;">
                                                                                    <%foreach from=$uom item=c %>
                                                                                    <option 
                                                                                        value="<%$c->id %>">
                                                                                        <%$c->uom_name %>
                                                                                    </option>
                                                                                    <%/foreach%>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="form-group">
                                                                                <label for="max_uom">Max
                                                                                    PO Quantity</label><span
                                                                                    class="text-danger">*</span>
                                                                                <input type="text"
                                                                                    value=""
                                                                                    name="max_uom" 
                                                                                    class="form-control required-input onlyNumericInput"
                                                                                    placeholder="Part Specification">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="form-group">
                                                                                <label for="max_uom">Store Stock
                                                                                    Rate</label><span
                                                                                    class="text-danger">*</span>
                                                                                <input type="text"
                                                                                    value=""
                                                                                    name="store_stock_rate" 
                                                                                    class="form-control required-input onlyNumericInput"
                                                                                    placeholder="Part Specification">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="form-group">
                                                                                <label for="max_uom">Weight</label><span
                                                                                    class="text-danger">*</span>
                                                                                <input type="text"
                                                                                    value=""
                                                                                    name="weight" 
                                                                                    class="form-control required-input"
                                                                                    >
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="form-group">
                                                                                <label for="max_uom">Size</label>
                                                                                <input type="text"
                                                                                    value=""
                                                                                    name="size" class="form-control "
                                                                                   >
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="form-group">
                                                                                <label
                                                                                    for="max_uom">Thickness</label>
                                                                                <input type="text"
                                                                                    value=""
                                                                                    name="thickness"
                                                                                    class="form-control"
                                                                                    >
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Close</button>
                                                                        <button type="submit"
                                                                            class="btn btn-primary">Save
                                                                            changes</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>  
    </div>
     <script>
    var column_details =  <%$data|json_encode%>;
    var page_length_arr = <%$page_length_arr|json_encode%>;
    var is_searching_enable = <%$is_searching_enable|json_encode%>;
    var is_top_searching_enable =  <%$is_top_searching_enable|json_encode%>;
    var is_paging_enable =  <%$is_paging_enable|json_encode%>;
    var is_serverSide =  <%$is_serverSide|json_encode%>;
    var no_data_message =  <%$no_data_message|json_encode%>;
    var is_ordering =  <%$is_ordering|json_encode%>;
    var sorting_column = <%$sorting_column%>;
    var api_name =  <%$api_name|json_encode%>;
    var base_url = <%$base_url|json_encode%>;
</script>
<script src="<%$base_url%>/public/js/planning_and_sales/inhouse_parts_view.js"></script>