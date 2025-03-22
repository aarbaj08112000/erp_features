
<div class="content-wrapper">
  <!-- Content -->

  <div class="container-xxl flex-grow-1 container-p-y">
 

    <nav aria-label="breadcrumb">
      <div class="sub-header-left pull-left breadcrumb">
        <h1>
          Admin
          <a hijacked="yes" href="javascript:void(0)" class="backlisting-link" title="Back to Issue Request Listing" >
            <i class="ti ti-chevrons-right" ></i>
            <em >Master</em></a>
          </h1>
          <br>
          <span >Group Master Rights</span>
        </div>
      </nav>

      <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5">
        <a type='button' class="btn btn-seconday" href="<%base_url('group_master')%>" title="Back To Group Master"><i class="ti ti-arrow-left"></i></a>
         <%*<button class="btn btn-seconday" type="button" id="downloadPDFBtn" title="Download PDF"><i class="ti ti-file-type-pdf"></i></button>
        <button class="btn btn-seconday filter-icon" type="button"><i class="ti ti-filter" ></i></i></button>
        <button class="btn btn-seconday" type="button"><i class="ti ti-refresh reset-filter"></i></button> *%>
       

      </div>
      
      <div class="card p-0 mt-4">
            <div class="card-header">
                <div class="row">
                    <div class="tgdp-rgt-tp-sect">
                        <p class="tgdp-rgt-tp-ttl">Group Name</p>
                        <p class="tgdp-rgt-tp-txt">
                            <%$group_details['group_name']%>
                        </p>
                    </div>
                    <div class="tgdp-rgt-tp-sect">
                        <p class="tgdp-rgt-tp-ttl">Group Code</p>
                        <p class="tgdp-rgt-tp-txt">
                            <%$group_details['group_code']%>
                        </p>
                    </div>
                    <div class="tgdp-rgt-tp-sect">
                        <p class="tgdp-rgt-tp-ttl">Status</p>
                        <p class="tgdp-rgt-tp-txt">
                            <%$group_details['status']%>
                        </p>
                    </div>
                </div>
            </div>
        </div>
      <!-- Main content -->
      <div class="row mt-4">
		   <div class="col-xl">
		      <div class="card mb-4 ">
		         <div class="card-body menu-list-block">
		            <form id="updateGroupMenuRight" class="mb-3" action="javascript:void(0)" method="POST" enctype="multipart/form-data" novalidate="novalidate">
		               <div class="row edit-block-contain">
		               	<input type="hidden" name="group_id" value="<%$group_id%>">
		               	<%assign var='key' value=0%>
		               	<%foreach from=$groups_menu key='key_val' item='menu_category'%>
		               		<div class="menu-form-row category-row-block">
							   <div class="w-50 float-start">
							      <label class="form-label ">
							         <lable for="iAdminMenuId_" class="right-label-inline">
							            <input type="checkbox" class="regular-checkbox common-check-category-box" value="Yes" >
							            <%$menu_category[0]['category_name']%>
							         </lable>
							      </label>
							   </div>
							   <div class="w-50 float-start">
							      <i class="ti ti-circle-arrow-up expand-category-icon active"></i>
							   </div>
							   <div class="menu-form-row row m-2 category-wise-menu" style="display: none;">
				               	<%foreach from=$menu_category key='key_value' item='menu'%>
				                  <div class="col-lg-12 ">
				                    <div class="menu-form-row sub-menu-block" >
				                    	<input type="hidden" name="menu[access<%$key%>][group_master_id]" value="<%$menu['group_master_id']%>">
				                    	<input type="hidden" name="menu[access<%$key%>][menu_master_id]" value="<%$menu['menu_master_id']%>">

					            			<div class="w-75 float-start"><label class="form-label ">
					                        <lable for="iAdminMenuId_" class="right-label-inline"> 
					                        	<input type="checkbox"  class="regular-checkbox common-check-box" value="Yes"  
					                        	 <%if $menu['list'] eq 'Yes' && $menu['add'] eq 'Yes' && $menu['update'] eq 'Yes' && $menu['delete'] eq 'Yes' && $menu['export'] eq 'Yes' && $menu['import'] eq 'Yes'%>checked="true"<%/if%>>
					                        	 <%$menu['diaplay_name']%>

					                        </lable>
					                        </div>
					                        <div class="w-25 float-start">
					                        	<i class="ti ti-circle-arrow-up expand-icon active"></i>
					                        </div>
					                        
					            		</label> 
							            <div class="form-right-div m-4 mb-2 mt-2" style="display: none;">
							                <div class="margin-equilize">
							                	<input type="checkbox" name="menu[access<%$key%>][access][list]" class="regular-checkbox main-item-check-box" value="Yes" <%if $menu['list'] eq 'Yes'%>checked="true"<%/if%> >
							                    <label class="right-label-inline" for="eList_1">List</label>
							                </div>
							                <div class="margin-equilize">
							                	<input type="checkbox" name="menu[access<%$key%>][access][add]" class="regular-checkbox main-item-check-box" value="Yes" <%if $menu['add'] eq 'Yes'%>checked="true"<%/if%> >
							                    <label class="right-label-inline" for="eList_1">Add</label>
							                </div>
							                <div class="margin-equilize">
							                	<input type="checkbox" name="menu[access<%$key%>][access][update]" class="regular-checkbox main-item-check-box" value="Yes" <%if $menu['update'] eq 'Yes'%>checked="true"<%/if%> >
							                    <label class="right-label-inline" for="eList_1">Update</label>
							                </div>
							                <div class="margin-equilize">
							                	<input type="checkbox" name="menu[access<%$key%>][access][delete]" class="regular-checkbox main-item-check-box" value="Yes" <%if $menu['delete'] eq 'Yes'%>checked="true"<%/if%> >
							                    <label class="right-label-inline" for="eList_1">Delete</label>
							                </div>
							                <div class="margin-equilize">
							                	<input type="checkbox" name="menu[access<%$key%>][access][export]" class="regular-checkbox main-item-check-box"  value="Yes" <%if $menu['export'] eq 'Yes'%>checked="true"<%/if%> >
							                    <label class="right-label-inline" for="eList_1">Export</label>
							                </div>
							                 <div class="margin-equilize">
							                	<input type="checkbox" name="menu[access<%$key%>][access][import]" class="regular-checkbox main-item-check-box"  value="Yes" <%if $menu['import'] eq 'Yes'%>checked="true"<%/if%> >
							                    <label class="right-label-inline" for="eList_1">Import</label>
							                </div>
							            </div>
							        </div>
							       </div>
							       <%assign var='key' value=$key+1%>
							    <%/foreach%>
							</div>

							</div>
		               		
					    <%/foreach%>
					    </div>
					    <div class="mt-5 m-auto text-center">
					    	<a type="button" href="<%base_url('group_master')%>" class="btn btn-info me-2">Cancel</a>
					    	<button type="submit" class="btn btn-primary">Submit</button>
					    </div>
						
					</form>
				 </div>
				</div>
			</div>
		</div>
      <!-- /.col -->


      <div class="content-backdrop fade"></div>
    </div>

<style type="text/css">
	.menu-form-row {
		margin-top: 5px;
	    padding-top: 5px;
	    padding-bottom: 5px;
	    width: 100%;
	    position: relative;
	}
	.menu-form-row .form-label{
		float: left;
   		width: 100% !important;
	}
	.menu-form-row .form-label lable{
		 font-style: normal !important;
	    display: block;
	    margin-top: 3px;
	    font-size: 17px;
	    color: #919396;
	    font-family: 'GilroySemibold', sans-serif !important;
	    width: 100%;
    float: left;
	}
	.menu-form-row .form-right-div {
		    margin: 10px 6px 10px 13px;
		float: left;
    	width: 100% !important;
	}
	.menu-form-row .margin-equilize {
		float: left;
    	width: 31.65%;
	}
	.menu-form-row .margin-equilize label{
    	font-size: 17px;
    	color: #000;
    	margin: 0px 0px 2px 8px;
	}
	.menu-form-row .margin-equilize input{
		width: 17px;
    	height: 15px;
    	cursor: pointer;
	}
	.form-label {
    margin-bottom: 0px;
    font-size: 0.75rem;
    font-weight: 500;
    color: #566a7f;
}
	.menu-list-block .edit-block-contain{
		overflow-y: auto;
	    padding: 0 17px;
	    height: auto;
	    border-radius: 0px;
	    max-height: calc(100vh - 485px);
	}
	.expand-icon{
		    float: right;
    font-size: 29px;
    cursor: pointer;
	}
	.expand-icon.active {
		transition: 0.9s;
		    transform: rotate(180deg);
	}
	.expand-icon {
		transition: 0.9s;
		    transform: rotate(0deg);
	}
	.expand-category-icon{
		    float: right;
    font-size: 29px;
    cursor: pointer;
	}
	.expand-category-icon.active {
		transition: 0.9s;
		    transform: rotate(180deg);
	}
	.expand-category-icon {
		transition: 0.9s;
		    transform: rotate(0deg);
	}
	.common-check-box,.common-check-category-box{
		    width: 17px;
    height: 15px;
    cursor: pointer;
    margin-left: 8px;
    margin-right: 6px;
    /* padding-top: 2606px !important; */
    /*position: absolute;*/
    top: 12px;
	}
	.menu-form-row.category-row-block {
    width: 24%;
    border: 1px solid var(--bs-theme-color);
    margin: 5px;
    border-radius: 7px;
}
</style>
    <script type="text/javascript">
    var base_url = <%$base_url|@json_encode%>
    </script>

    <script src="<%$base_url%>public/js/admin/group_master_menu.js"></script>

.active {
	    transform: rotate(180deg);
}