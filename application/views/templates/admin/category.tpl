<div class="content-wrapper">
<div class="container-xxl flex-grow-1 container-p-y" >
   <!-- Content Header (Page header) -->
   <!-- /.content-header -->
   <nav aria-label="breadcrumb">
      <div class="sub-header-left pull-left breadcrumb">
         <h1>
            Admin
            <a hijacked="yes" href="javascript:void(0)" class="backlisting-link" title="">
            <i class="ti ti-chevrons-right"></i>
            <em>Master</em></a>
         </h1>
         <br>
         <span>Category</span>
      </div>
   </nav>
   <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5">
      <%if (checkGroupAccess("category","add","No")) %>
        <button type="button" class="btn btn-seconday" data-bs-toggle="modal" data-bs-target="#addPromo" title="Add Category">
      		Add Category
      	</button>
      <%/if%>
   </div>
   <!-- Main content -->
   <section class="content">
      <div>
         <!-- Small boxes (Stat box) -->
         <div class="row">
            <br>
            <div class="col-lg-12">
               <!-- Modal -->
               <div class="modal fade" id="addPromo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered " role="document">
                     <div class="modal-content">
                        <div class="modal-header">
                           <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                           </button>
                        </div>
                        <div class="modal-body">
                           
                              <form action="<%base_url('add_category') %>" method="POST" enctype="multipart/form-data" id="add_category">
                           <div class="form-group">
                           <label for="on click url">Category Name<span class="text-danger">*</span></label> <br>
                           <input  type="text" name="category_name" placeholder="Enter Category Name" class="form-control" value="" id="">
                           </div>
                           <div class="form-group">
                           <label for="on click url">Parent Category<span class="text-danger">*</span></label> <br>
                           <select class="form-control select2" name="parent_id" style="width: 100%;">
                           <option value="">Select Parent Category</option>
                           <%foreach from=$category_list item=a %>
                              	<%if (!($a->parent_id > 0)) %>
                           			<option value="<%$a->category_id %>"><%$a->category_name%></option>
                           		<%/if%>
                            <%/foreach%>
                           </select>
                           </div>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                        </form>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="card">
                  <!-- /.card-header -->
                  <div class="">
                     <table id="categor_table" class="table table-striped">
                        <thead>
                           <tr>
                              <th>Sr No</th>
                              <th> Category Name</th>
                              <th> Parent Category Name</th>
                              <th> Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           <%if ($category_list) %>
                                <%assign var=i value=1%>
                                <%foreach from=$category_list item=u %>
		                           <tr>
		                              <td><%$i %></td>
		                              <td><%$u->category_name %></td>
                                    <td><%$u->parent_category %></td>
                                    <td>
                                       <%if (checkGroupAccess("gst","update","No")) %>
                                          <!-- Button trigger modal -->
                                          <button type="button" class="btn no-btn btn-primary edit-part" data-bs-toggle="modal" data-bs-target="#edit<%$i %>" data-value="<%base64_encode(json_encode($t))%>">
                                          <i class="ti ti-edit"></i>
                                          </button>
                                          <!-- delete Modal -->
                                          <div class="modal fade" id="edit<%$i %>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                             <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                   <div class="modal-header">
                                                      <h5 class="modal-title" id="exampleModalLabel">Update Category</h5>
                                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                      </button>
                                                   </div>
                                                   <div class="modal-body">
                                                      <form action="<%base_url('update_category')%>" method="POST" id="updateuom<%$i%>" class="updateuom updateuom<%$i%> custom-form">
                                                         <div class="row">
                                                            <div class="col-lg-12">
                                                               <div class="form-group" >
                                                                   <label for="on click url" class="w-100">Category Name<span class="text-danger">*</span></label>
                                                                  <input value="<%$u->category_name %>" type="text" name="category_name"  class="form-control required-input" id="category_name" aria-describedby="emailHelp" placeholder="Category Name">
                                                                  <input type="hidden" name="category_id" value="<%$u->category_id%>">
                                                                 </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                               <div class="form-group" >
                                                                   <label for="on click url" class="w-100">Parent Category<span class="text-danger">*</span></label>
                                                                        <select name="parent_category_id" class="form-control select2 select2-multiple "  >
                                                                        <option value="">Select Parent Category</option>
                                                                          <%foreach from=$category_list item=a %>
                                                                              <%if (!($a->parent_id > 0)) %>
                                                                                 <option value="<%$a->category_id %>" <%if $u->parent_id eq $a->category_id%>selected<%/if%>><%$a->category_name%></option>
                                                                              <%/if%>
                                                                         <%/foreach%>
                                                                        </select>
                                                                 
                                                                 </div>
                                                            </div>
                                                         </div>
                                                         <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                                         </div>
                                                      </form>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                           <!-- delete Modal -->
                          <%else%>
                            <%display_no_character("")%>
                           <%/if%>
                                    </td>
		                           </tr>
                              	<%assign var=i value=$i+1%>
                             	<%/foreach%>
                            <%/if%>
                        </tbody>
                     </table>
                  </div>
                  <!-- /.card-body -->
               </div>
               <!-- ./col -->
            </div>
         </div>
         <!-- /.row -->
         <!-- Main row -->
         <!-- /.row (main row) -->
      </div>
      <!-- /.container-fluid -->
   </section>
   <!-- /.content -->
</div>
<script type="text/javascript">
   var base_url = <%$base_url|@json_encode%>
</script>
<script src="<%$base_url%>public/js/admin/category.js"></script>