<div class="wrapper container-xxl flex-grow-1 container-p-y">
<nav aria-label="breadcrumb">
<div class="sub-header-left pull-left breadcrumb">
  <h1>
	Purchase
	<a hijacked="yes" href="javascript:void(0)" class="backlisting-link" title="">
	  <i class="ti ti-chevrons-right"></i>
	  <em>Item Matser</em></a>
  </h1>
  <br>
  <span>Inward Inspection</span>
</div>
</nav>
<div class="dt-top-btn d-grid gap-2 d-md-flex  mb-5 listing-btn">
        <button type="button" class="btn btn-seconday " data-bs-toggle="modal" data-bs-target="#exampleModal">
            Add </button>
            <a title="Back To Item Master" class="btn btn-seconday" href="<%base_url('child_part_view') %>" type="button"><i class="ti ti-arrow-left"></i></a>
     
</div>
<div class="card p-0 mt-4">
            <div class="card-header">
                <div class="row">
                    <div class="tgdp-rgt-tp-sect">
                        <p class="tgdp-rgt-tp-ttl">Part Number</p>
                        <p class="tgdp-rgt-tp-txt">
                        <%$child_part[0]->part_number %>
                        </p>
                    </div>
                    <div class="tgdp-rgt-tp-sect">
                        <p class="tgdp-rgt-tp-ttl">Part Description </p>
                        <p class="tgdp-rgt-tp-txt">
                        <%$child_part[0]->part_description %>
                        </p>
                    </div>
                </div>
            </div>
        </div>
<div class="content-wrapper">
  
   <!-- Main content -->
   <section class="content">
      <div class="">
         <div class="row">
            <div class="col-12">
               <!-- /.card -->
               <div class="card p-0 mt-4">
                  <div class="">
                    
                    
                     <!-- Modal -->
                     <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title" id="exampleModalLabel">Add </h5>
                                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                 </button>
                              </div>
                              <div class="modal-body">
                                 <form action="<%base_url('add_raw_material_inspection_master') %>" method="POST" class="add_raw_material_inspection_master custom-form" id="add_raw_material_inspection_master">
                                    <div class="row">
                                       <div class="col-lg-12">
                                          <div class="form-group">
                                             <label> Parameter </label><span class="text-danger">*</span>
                                             <input type="text"  name="parameter" placeholder="Enter Parameter" class="form-control required-input">
                                          </div>
                                          <div class="form-group">
                                             <label> Specification </label><span class="text-danger">*</span>
                                             <input type="text"  name="specification" placeholder="Enter Specification" class="form-control required-input">
                                          </div>
                                          <div class="form-group">
                                             <label> Evalution Mesaurement Technique </label><span class="text-danger">*</span>
                                             <input type="text"  name="evalution_mesaurement_technique" placeholder="Enter Specification" class="form-control required-input">
                                             <input type="hidden" value="<%$child_part_id %>" required name="child_part_id" placeholder="Enter Specification" class="form-control">
                                          </div>
                                       </div>
                                    </div>
                                    <div class="modal-footer">
                                       <button type="button" class="btn btn-secondary" data-bs  -dismiss="modal">Close</button>
                                       <button type="submit" class="btn btn-primary">Save
                                       changes</button>
                                    </div>
                                 </form>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="">
                     <table id="inward_inspection" class="table table-striped w-100">
                        <thead>
                           <tr>
                              <th>Sr. No.</th>
                              <th>Parameter</th>
                              <th>Specification</th>
                              <th>Evalution Mesaurement Technique</th>
                              <th>Actions</th>
                           </tr>
                        </thead>
                        <tbody>
                           <%assign var='i'  value=1 %>
                            <%if ($raw_material_inspection_master) %>
                            <%foreach from=$raw_material_inspection_master item=u %>
                           <tr>
                              <td><%$i %></td>
                              <td><%$u->parameter %></td>
                              <td><%$u->specification %></td>
                              <td><%$u->evalution_mesaurement_technique %></td>
                              <td>
                                 <a type="submit" data-bs-toggle="modal" class="" data-bs-target="#exampleModal2<%$i %>"> <i class="ti ti-edit"></i></a>
                                 <div class="modal fade" id="exampleModal2<%$i %>" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                       <div class="modal-content">
                                          <div class="modal-header">
                                             <h5 class="modal-title" id="exampleModalLabel">Update</h5>
                                             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                             <span aria-hidden="true">&times;</span>
                                             </button>
                                          </div>
                                          <div class="modal-body">
                                             <form action="<%base_url('update_raw_material_inspection_master') %>" method="POST" class="update_raw_material_inspection_master custom-form update_raw_material_inspection_master<%$i %>"" id="update_raw_material_inspection_master<%$i %>"">
                                                <div class="row">
                                                   <div class="col-lg-12">
                                                      <div class="form-group">
                                                         <label> Parameter </label><span class="text-danger">*</span>
                                                         <input type="text" value="<%$u->parameter %>"  name="parameter" placeholder="Enter Parameter" class="form-control required-input">
                                                      </div>
                                                      <div class="form-group">
                                                         <label> Specification </label><span class="text-danger">*</span>
                                                         <input type="text" value="<%$u->specification %>"  name="specification" placeholder="Enter Specification" class="form-control required-input">
                                                      </div>
                                                      <div class="form-group">
                                                         <label> Evalution Mesaurement Technique </label><span class="text-danger">*</span>
                                                         <input type="text"  value="<%$u->evalution_mesaurement_technique %>" name="evalution_mesaurement_technique" placeholder="Enter Specification" class="form-control required-input">
                                                         <input type="hidden" value="<%$child_part_id %>" required name="child_part_id" placeholder="Enter Specification" class="form-control">
                                                         <input type="hidden" value="<%$u->id %>" required name="id" placeholder="Enter Specification" class="form-control">
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="modal-footer">
                                                   <button type="button" class="btn btn-secondary" data-btn-dismiss="modal">Close</button>
                                                   <button type="submit" class="btn btn-primary">Save
                                                   changes</button>
                                                </div>
                                             </form>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </td>
                           </tr>
                           <%assign var='i'  value=$i+1 %>
                           <%/foreach%>
                            <%/if%>
                        </tbody>
                     </table>
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
<!-- /.content-wrapper -->
<script src="<%$base_url%>public/js/purchase/raw_material_inspection.js"></script>