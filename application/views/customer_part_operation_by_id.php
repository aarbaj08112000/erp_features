<div class="wrapper">
   <!-- Navbar -->
   <!-- /.navbar -->
   <!-- Main Sidebar Container -->
   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
         <div class="container-fluid">
            <div class="row mb-2">
               <div class="col-sm-6">
                  <h1>Customer Part Operation </h1>
               </div>
               <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                     <li class="breadcrumb-item active">Customer Part</li>
                  </ol>
               </div>
            </div>
         </div>
         <!-- /.container-fluid -->
      </section>
      <!-- Main content -->
      <section class="content">
         <div class="container-fluid">
            <div class="row">
               <div class="col-12">
                  <!-- /.card -->
                  <div class="card">
                     <div class="card-header">
                        <div class="row">
                           <div class="col-lg-6">
                              <div class="form-group">
                                 <label for="po_num">Part Number </label><span class="text-danger">*</span>
                                 <input type="text" readonly value="<?php echo $customer[0]->part_number ?>" name="part_number" required class="form-control" id="exampleInputEmail1" placeholder="Enter Part Number" aria-describedby="emailHelp">
                              </div>
                           </div>
                           <div class="col-lg-6">
                              <div class="form-group">
                                 <label for="po_num">Part Description </label><span class="text-danger">*</span>
                                 <input type="text" readonly value="<?php echo $customer[0]->part_description ?>" name="part_desc" required class="form-control" id="exampleInputEmail1" placeholder="Enter Part Description" aria-describedby="emailHelp">
                              </div>
                           </div>
                        </div>
                        <h3 class="card-title">
                        </h3>
                        <a href="<?php echo base_url('customer_part_main/') . $this->uri->segment('2'); ?>" class="btn btn-danger ">
                        Back </a>
                        <br>
                        <br>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary float-left" data-toggle="modal" data-target="#exampleModal">
                        Add </button>
                     </div>
                     <!-- Modal -->
                     <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title" id="exampleModalLabel">Add </h5>
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                                 </button>
                              </div>
                              <div class="modal-body">
                                 <form action="<?php echo base_url('add_customer_operation') ?>" method="POST" enctype='multipart/form-data'>
                                    <div class="row">
                                       <div class="col-lg-12">
                                          <div class="form-group">
                                             <label for="operation_number">Part Number</label><span class="text-danger">*</span>
                                             <input type="text" name="" readonly value="<?php echo $part_number ?>" class="form-control" required id="exampleInputPassword1" placeholder="Operation Number">
                                          </div>
                                          <div class="form-group">
                                             <label for="po_num">Select Operations </label><span class="text-danger">*</span>
                                             <select name="operation_id" id="" class="form-control">
                                                <?php
                                                   if ($operations) {
                                                       foreach ($operations as $o) {
                                                   ?>
                                                <option value="<?php echo $o->id ?>"><?php echo $o->name; ?></option>
                                                <?php
                                                   }
                                                   }
                                                   ?>
                                             </select>
                                          </div>
                                          <div class="form-group">
                                             <label for="po_num">Process / Operation Name </label><span class="text-danger">*</span>
                                             <input type="text" name="name" required class="form-control" id="exampleInputEmail1" placeholder="Enter name" aria-describedby="emailHelp">
                                          </div>
                                          <div class="form-group">
                                             <label for="po_num">M/C Device Jigs, Tools for Mfg </label><span class="text-danger">*</span>
                                             <input type="text" name="mfg" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                          </div>
                                          <div class="form-group">
                                             <label for="po_num">Revision Number </label><span class="text-danger">*</span>
                                             <input type="text" name="revision_no" required class="form-control" id="exampleInputEmail1" placeholder="Enter " aria-describedby="emailHelp">
                                          </div>
                                          <div class="form-group">
                                             <label for="po_num">Revision Date</label><span class="text-danger">*</span>
                                             <input type="date" name="revision_date" required class="form-control" id="exampleInputEmail1" placeholder="Enter " aria-describedby="emailHelp">
                                          </div>
                                          <div class="form-group">
                                             <label for="po_num">Revision Remark</label><span class="text-danger">*</span>
                                             <input type="text" name="revision_remark" required class="form-control" id="exampleInputEmail1" placeholder="Enter " aria-describedby="emailHelp">
                                             <input hidden type="text" name="customer_master_id" value="<?php echo $part_id ?>" required class="form-control" id="exampleInputEmail1" placeholder="Enter " aria-describedby="emailHelp">
                                          </div>
                                       </div>
                                       <div class="col-lg-12">
                                          <!-- <div class="form-group">
                                             <label> Customer Part Type </label><span class="text-danger">*</span>
                                             <select class="form-control select2" name="customer_part_id" style="width: 100%;">
                                                 <?php
                                                foreach ($customers_part_type as $c1) {
                                                ?>
                                                     <option value="<?php echo $c1->id; ?>"><?php echo $c1->customer_type_name; ?></option>
                                                 <?php
                                                }
                                                ?>
                                             </select>
                                             </div> -->
                                       </div>
                                    </div>
                              </div>
                              <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-primary">Save changes</button>
                              </div>
                              </form>
                           </div>
                        </div>
                     </div>
                     <!-- /.card-header -->
                     <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                           <thead>
                              <tr>
                                 <th>Sr. No.</th>
                                 <th>Add Revision</th>
                                 <th>Revision Number</th>
                                 <th>Revision Date</th>
                                 <th>Revision Remark</th>
                                 <th>Customer Name</th>
                                 <th>Part Number</th>
                                 <th>Part Description</th>
                                 <th>Opration Number </th>
                                 <th>Opration Name </th>
                                 <th>M/C Device Jigs, Tools for Mfg </th>
                                 <th>Add Details</th>
                              </tr>
                           </thead>
                           <tfoot>
                              <tr>
                                 <th>Sr. No.</th>
                                 <th>Add Revision</th>
                                 <th>Revision Number</th>
                                 <th>Revision Date</th>
                                 <th>Revision Remark</th>
                                 <th>Customer Name</th>
                                 <th>Part Number</th>
                                 <th>Part Description</th>
                                 <th>Opration Number </th>
                                 <th>Opration Name </th>
                                 <th>M/C Device Jigs, Tools for Mfg</th>
                                 <th>Add Details</th>
                              </tr>
                           </tfoot>
                           <tbody>
                              <?php
                                 $i = 1;
                                 if ($customer_part_rate) {
                                     foreach ($customer_part_rate as $poo) {
                                         if ($poo->customer_id == $customer_id) {
                                             if ($part_id == $poo->customer_master_id) {
                                 ?>
                              <tr>
                                 <td><?php echo $i ?></td>
                                 <td>
                                    <button type="submit" data-toggle="modal" class="btn btn-sm btn-primary" data-target="#exampleModaledit2<?php echo $i ?>">Add Revision</button>
                                    <a href="<?php echo base_url('view_part_operation_history/') . $poo->customer_master_id . '/' . $poo->operation_id; ?>" class="btn btn-primary btn-sm">history</a>
                                    <div class="modal fade" id="exampleModaledit2<?php echo $i ?>" tabindex=" -1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                       <div class="modal-dialog " role="document">
                                          <div class="modal-content">
                                             <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Update Oeration</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                             </div>
                                             <div class="modal-body">
                                                <form action="<?php echo base_url('add_customer_operation') ?>" method="POST" enctype='multipart/form-data'>
                                                   <div class="row">
                                                      <div class="col-lg-6">
                                                         <input value="<?php echo $poo->customer_part_id ?>" type="hidden" name="id" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Customer Name">
                                                         <div class="form-group">
                                                            <label for="po_num">Part Number </label><span class="text-danger">*</span>
                                                            <input type="text" readonly value="<?php echo $poo->part_number  ?>" name="upart_number" required class="form-control" id="exampleInputEmail1" placeholder="Enter Part Number" aria-describedby="emailHelp">
                                                         </div>
                                                         <div class="form-group">
                                                            <label for="po_num">Part Description </label><span class="text-danger">*</span>
                                                            <input type="text" readonly value="<?php echo $poo->part_description  ?>" name="upart_desc" required class="form-control" id="exampleInputEmail1" placeholder="Enter Part Description" aria-describedby="emailHelp">
                                                         </div>
                                                         <div class="form-group">
                                                            <label for="po_num">Operation Name </label><span class="text-danger">*</span>
                                                            <input type="text" name="name" required class="form-control" id="exampleInputEmail1" placeholder="Enter name" aria-describedby="emailHelp">
                                                         </div>
                                                         <div class="form-group">
                                                            <label for="po_num">Revision Date </label><span class="text-danger">*</span>
                                                            <input type="date" value="<?php echo $poo->revision_date ?>" name="revision_date" required class="form-control" id="exampleInputEmail1" placeholder="Enter Part Rate" aria-describedby="emailHelp">
                                                            <input type="hidden" value="<?php echo $poo->customer_master_id ?>" name="customer_master_id" required class="form-control" id="exampleInputEmail1" placeholder="Enter Part Rate" aria-describedby="emailHelp">
                                                            <input type="hidden" value="<?php echo $poo->operation_id ?>" name="operation_id" required class="form-control" id="exampleInputEmail1" placeholder="Enter Part Rate" aria-describedby="emailHelp">
                                                         </div>
                                                      </div>
                                                      <div class="col-lg-6">
                                                         <div class="form-group">
                                                            <label for="po_num">Revision Number </label><span class="text-danger">*</span>
                                                            <input type="text" value="<?php echo $poo->revision_no  ?>" name="revision_no" required class="form-control" id="exampleInputEmail1" placeholder="Enter Safty/buffer stock" aria-describedby="emailHelp">
                                                            <input type="hidden" value="<?php echo $poo->customer_id  ?>" name="customer_id" required class="form-control" id="exampleInputEmail1" placeholder="Enter Safty/buffer stock" aria-describedby="emailHelp">
                                                         </div>
                                                         <div class="form-group">
                                                            <label for="po_num">Revision Remark </label><span class="text-danger">*</span>
                                                            <input type="text" value="" name="revision_remark" required class="form-control" id="exampleInputEmail1" placeholder="Enter Safty/buffer stock" aria-describedby="emailHelp">
                                                         </div>
                                                      </div>
                                                   </div>
                                             </div>
                                             <div class="modal-footer">
                                             <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                             <button type="submit" class="btn btn-primary">Save changes</button>
                                             </div>
                                             </form>
                                          </div>
                                       </div>
                                    </div>
                     </div>
                     </td>
                     <td><?php echo $poo->revision_no ?></td>
                     <td><?php echo $poo->revision_date ?></td>
                     <td><?php echo $poo->revision_remark ?></td>
                     <td><?php echo $poo->customer_name ?></td>
                     <td><?php echo $poo->part_number ?></td>
                     <td><?php echo $poo->part_description ?></td>
                     <td><?php echo $poo->name ?></td>
                     <td><?php echo $poo->name_val ?></td>
                     <td><?php echo $poo->mfg ?></td>
                     <td>
                     <a class="btn btn-info" href="<?php echo base_url('add_operation_details/') . $poo->id . "/" . $customer_id . "/" . $this->uri->segment('2') . "/" .  $part_id;; ?>">Add Details</a>
                     </td>
                     </tr>
                     <?php
                        $i++;
                        }
                        }
                        }
                        }
                        ?>
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