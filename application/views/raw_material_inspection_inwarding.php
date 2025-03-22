<div style="width:100%" class="wrapper">
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
               <!-- <h1></h1> -->
               <form action="<?php echo base_url('') ?>" method="POST">
                  <div class="row">
                     <div class="col-lg-6">
                        <!-- <div class="form-group">
                           <label for="operation_number">Operation Number</label><span class="text-danger">*</span>
                           <input type="text" name="operationNumber" class="form-control" required id="exampleInputPassword1" placeholder="Operation Number">
                           
                           </div>-->
                        <div class="form-group">
                           <label for="po_num">Part Number </label><span class="text-danger">*</span>
                           <input type="text" readonly value="<?php echo $child_part_data[0]->part_number ?>" name="part_number" required class="form-control" id="exampleInputEmail1" placeholder="Enter Part Number" aria-describedby="emailHelp">
                        </div>
                     </div>
                     <div class="col-lg-6">
                        <!-- <div class="form-group">
                           <label for="operation_number">Operation Number</label><span class="text-danger">*</span>
                           <input type="text" name="operationNumber" class="form-control" required id="exampleInputPassword1" placeholder="Operation Number">
                           
                           </div>-->
                        <div class="form-group">
                           <label for="po_num">Part Description </label><span class="text-danger">*</span>
                           <input type="text" readonly value="<?php echo $child_part_data[0]->part_description ?>" name="part_desc" required class="form-control" id="exampleInputEmail1" placeholder="Enter Part Description" aria-describedby="emailHelp">
                        </div>
                     </div>
                  </div>
               </form>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
                  <li class="breadcrumb-item active">Inward Inspection</li>
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
                     <!-- Button trigger modal -->
                     <a class="btn btn-dark" href="<?php echo base_url('inwarding_details_accept_reject/') . $inwarding_data[0]->id . "/" . $this->uri->segment('3') ?>">
                     < Back </a>
                     <?php
                        if ($raw_material_inspection_master) {
                        ?>
                     <a class="btn btn-danger" href="<?php echo base_url('download_my_pdf_inspection_report/') .  $this->uri->segment('2') . "/" . $this->uri->segment('3') . "/" . $this->uri->segment('4') . "/" . $this->uri->segment('5') . "/" . $this->uri->segment('6') . "/" . $this->uri->segment('7') . "/" . $this->uri->segment('8') ?>">
                     Download Report </a>
                     <?php
                        }
                        ?>
                     <!-- Modal -->
                     <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog " role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title" id="exampleModalLabel">Add </h5>
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                                 </button>
                              </div>
                              <div class="modal-body">
                                 <form action="<?php echo base_url('add_raw_material_inspection_master') ?>" method="POST">
                                    <div class="row">
                                       <div class="col-lg-12">
                                          <!-- <div class="form-group">
                                             <label for="operation_number">Operation Number</label><span class="text-danger">*</span>
                                             <input type="text" name="operationNumber" class="form-control" required id="exampleInputPassword1" placeholder="Operation Number">
                                             </div>-->
                                          <!-- <div class="form-group">
                                             <label> Customer Part </label><span class="text-danger">*</span>
                                             <select class="form-control select2" name="customer_part_id" style="width: 100%;">
                                                 <?php
                                                foreach ($customer_part_list as $c) {
                                                ?>
                                                     <option value="<?php echo $c->id; ?>"><?php echo $c->part_number; ?>/<?php echo $c->part_description; ?></option>
                                                 <?php
                                                }
                                                ?>
                                             </select>
                                             </div> -->
                                          <div class="form-group">
                                             <label> Parameter </label><span class="text-danger">*</span>
                                             <input type="text" required name="parameter" placeholder="Enter Parameter" class="form-control">
                                          </div>
                                          <div class="form-group">
                                             <label> Specification </label><span class="text-danger">*</span>
                                             <input type="text" required name="specification" placeholder="Enter Specification" class="form-control">
                                          </div>
                                          <div class="form-group">
                                             <label> Evalution Mesaurement Technique </label><span class="text-danger">*</span>
                                             <input type="text" required name="evalution_mesaurement_technique" placeholder="Enter Specification" class="form-control">
                                             <input type="hidden" value="<?php echo $child_part_id; ?>" required name="child_part_id" placeholder="Enter Specification" class="form-control">
                                          </div>
                                       </div>
                                       <!-- <div class="col-lg-6">
                                          <div class="form-group">
                                              <label for="operation_name">Operation Name</label><span class="text-danger">*</span>
                                              <input type="text" name="operataionName" class="form-control" required id="exampleInputPassword1" placeholder="Operation Name ">
                                          </div>
                                          <div class="form-group">
                                              <label for="fixture_number">Fixture Number</label><span class="text-danger">*</span>
                                              <input type="text" name="fixtureNumber" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Fixture Number">
                                          </div>
                                          </div> -->
                                    </div>
                                    <div class="modal-footer">
                                       <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                       <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                 </form>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                     <table id="example1" class="table table-bordered table-striped">
                        <thead>
                           <tr>
                              <th>Sr. No.</th>
                              <th>Parameter</th>
                              <th>Specification</th>
                              <th>Evalution Mesaurement Technique</th>
                              <th>Observation 1</th>
                              <th>Observation 2</th>
                              <th>Observation 3</th>
                              <th>Observation 4</th>
                              <th>Observation 5</th>
                              <th>Remark</th>
                              <th>Submit</th>
                              <th>Update</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php
                              $i = 1;
                              if ($raw_material_inspection_master) {
                                  foreach ($raw_material_inspection_master as $u) {
                                      $raw_material_inspection_report_data = $u->raw_material_inspection_report_data;
                                      
                              ?>
                           <tr>
                              <td><?php echo $i ?></td>
                              <td><?php echo $u->parameter ?></td>
                              <td><?php echo $u->specification ?></td>
                              <td><?php echo $u->evalution_mesaurement_technique ?></td>
                              <?php if (empty($raw_material_inspection_report_data)) { ?>
                              <form action="<?php echo base_url('add_raw_material_inspection_report') ?>" method="post">
                                 <td>
                                    <input type="text" required placeholder="Enter Observation" class="form-control" name="observation" value="">
                                    <input type="hidden" required  class="form-control" name="raw_material_inspection_master_id" value="<?php echo $u->id ?>">
                                    <input type="hidden" required  class="form-control" name="child_part_id" value="<?php echo $child_part_id ?>">
                                    <input type="hidden" required  class="form-control" name="accepted_qty" value="<?php echo $accepted_qty ?>">
                                    <input type="hidden" required  class="form-control" name="rej_qty" value="<?php echo $rejected_qty ?>">
                                    <input type="hidden" required  class="form-control" name="invoice_number" value="<?php echo $inwarding_data[0]->invoice_number ?>">
                                    <input type="hidden" required  class="form-control" name="invoice_date" value="<?php echo $inwarding_data[0]->invoice_date ?>">
                                 </td>
                                 <td>
                                    <input type="text" required placeholder="Observation" class="form-control" name="observation2" value="">
                                 </td>
                                 <td>
                                    <input type="text" required placeholder="Observation" class="form-control" name="observation3" value="">
                                 </td>
                                 <td>        
                                    <input type="text" required placeholder="Observation" class="form-control" name="observation4" value="">
                                 </td>
                                 <td>        
                                    <input type="text" required placeholder="Observation" class="form-control" name="observation5" value="">
                                 </td>
                                 <td>
                                    <input type="text" required placeholder="Enter Remark" class="form-control" name="remark" value="">
                                 </td>
                                 <td>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                 </td>
                                 <?php } else { ?>   
                                 <td>
                                    <?php 
                                       echo $raw_material_inspection_report_data[0]->observation;
                                       ?>
                                 </td>
                                 <td>
                                    <?php 
                                       echo $raw_material_inspection_report_data[0]->observation2;
                                       ?>
                                 </td>
                                 <td>
                                    <?php 
                                       echo $raw_material_inspection_report_data[0]->observation3;
                                       ?>
                                 </td>
                                 <td>
                                    <?php 
                                       echo $raw_material_inspection_report_data[0]->observation4;
                                       ?>
                                 </td>
                                 <td>
                                    <?php 
                                       echo $raw_material_inspection_report_data[0]->observation5;
                                       ?>
                                 </td>
                                 <td>
                                    <?php
                                       echo $raw_material_inspection_report_data[0]->remark;
                                       ?>
                                 </td>
                                 <td>
                                    <?php
                                       echo "already added";
                                       ?>
                                 </td>
                                 <?php } ?>
                              </form>
                              </td>
                              <td>
                                 <?php
                                    if (empty($raw_material_inspection_report_data)) {
                                    ?>
                                 <?php } else {
                                    ?>
                                 <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#exampleModa<?php echo $i; ?>l">
                                 <i class="fa fa-edit"></i>
                                 </button>
                                 <div class="modal fade" id="exampleModa<?php echo $i; ?>l" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog " role="document">
                                       <div class="modal-content">
                                          <div class="modal-header">
                                             <h5 class="modal-title" id="exampleModalLabel">Update Details</h5>
                                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                             <span aria-hidden="true">&times;</span>
                                             </button>
                                          </div>
                                          <div class="modal-body">
                                             <form action="<?php echo base_url('update_raw_material_inspection_master_new') ?>" method="POST">
                                                <div class="row">
                                                   <div class="col-lg-12">
                                                      <div class="form-group">
                                                         <label> Parameter </label><span class="text-danger">*</span>
                                                         <input value="<?php echo  $u->parameter ?>" readonly type="text" required name="parameter" placeholder="Enter Parameter" class="form-control">
                                                      </div>
                                                      <div class="form-group">
                                                         <label> Specification </label><span class="text-danger">*</span>
                                                         <input value="<?php echo  $u->specification ?>" readonly type="text" required name="specification" placeholder="Enter Specification" class="form-control">
                                                      </div>
                                                      <div class="form-group">
                                                         <label> Evalution Mesaurement Technique </label><span class="text-danger">*</span>
                                                         <input value="<?php echo $u->evalution_mesaurement_technique ?>" readonly type="text" required name="evalution_mesaurement_technique" placeholder="Enter Specification" class="form-control">
                                                         <input type="hidden" value="<?php echo $raw_material_inspection_report_data[0]->id; ?>" required name="id" placeholder="Enter Specification" class="form-control">
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="col-lg-12">
                                                   <div class="row">
                                                      <div class="form-group">
                                                         <label> Observation 1</label><span class="text-danger">*</span>
                                                         <input type="text" value="<?php echo $raw_material_inspection_report_data[0]->observation; ?>" required placeholder="Enter Observation" class="form-control" name="observation">
                                                      </div>
                                                      &nbsp;&nbsp;&nbsp;&nbsp;
                                                      <div class="form-group">
                                                         <label> Observation 2</label>
                                                         <input type="text" value="<?php echo $raw_material_inspection_report_data[0]->observation2; ?>" placeholder="Enter Observation" class="form-control" name="observation2">
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="col-lg-12">
                                                   <div class="row">
                                                      <div class="form-group">
                                                         <label> Observation 3</label>
                                                         <input type="text" value="<?php echo $raw_material_inspection_report_data[0]->observation3; ?>" placeholder="Enter Observation" class="form-control" name="observation3">
                                                      </div>
                                                      &nbsp;&nbsp;&nbsp;&nbsp;
                                                      <div class="form-group">
                                                         <label> Observation 4</label>
                                                         <input type="text" value="<?php echo $raw_material_inspection_report_data[0]->observation4; ?>" placeholder="Enter Observation" class="form-control" name="observation4">
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="col-lg-12">
                                                   <div class="row">
                                                      <div class="form-group">
                                                         <label> Observation 5</label>
                                                         <input type="text" value="<?php echo $raw_material_inspection_report_data[0]->observation5; ?>" placeholder="Enter Observation" class="form-control" name="observation5">
                                                      </div>
                                                      &nbsp;&nbsp;&nbsp;&nbsp;
                                                      <div class="form-group">
                                                         <label> Remark</label><span class="text-danger">*</span>
                                                         <input type="text" value="<?php echo $raw_material_inspection_report_data[0]->remark; ?>" required placeholder="Enter Remark" class="form-control" name="remark" value="">
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="modal-footer">
                                                   <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                   <button type="submit" class="btn btn-primary">Save</button>
                                                </div>
                                             </form>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <?php
                                    } ?>
                                 </form>
                              </td>
                           </tr>
                           <?php
                              $i++;
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