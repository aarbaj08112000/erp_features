<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Part Operation Single </h1>
          
          </div><!-- /.col -->

          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
    
      <div >
        <!-- Small boxes (Stat box) -->
        <div class="row">
        

                <br>
            <div class="col-lg-12">                      

<!-- Modal -->
<div class="modal fade" id="addPromo"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
        <form action="<?php echo base_url('add_part_operations') ?>" method="POST"   enctype="multipart/form-data" >

       
        <div class="form-group">
                  <label for="on click url">Select Part  <span class="text-danger">*</span></label> <br>
                  <select required name="part_id" class="form-control select2" id="">
                    <?php 
                    foreach($new_part as $p)
                    {
                        $g = $this->Common_admin_model->get_data_by_id("part_creation",$p->part_number,"part_number");
                      ?>
                      <option value="<?php echo $g[0]->id ?>"><?php echo $g[0]->part_number ; ?></option>
                      <?php
                    }
                    ?>
                    <option value="" c></option>
                  </select>
                 
                
       </div>
        <div class="form-group">
                  <label for="on click url">Select Operations  <span class="text-danger">*</span></label> <br>
                  <select required name="operation_id" class="form-control select2" id="">
                    <?php 
                    foreach($operations as $g)
                    {
                      ?>
                      <option value="<?php echo $g->id ?>"><?php echo $g->name ; ?></option>
                      <?php
                    }
                    ?>
                    <option value="" c></option>
                  </select>
                 
                
       </div>
        <div class="form-group">
                  <label for="on click url">Operations Descriptions <span class="text-danger">*</span></label> <br>
                  <input required type="text" name="operation_description" placeholder="Enter operation_description" class="form-control"  value=""   id="">
                 
                
       </div>
  
       <div class="form-group">
                  <label for="on click url">Upload Operation Drawing<span class="text-danger">*</span></label> <br>
                  <input required type="file" name="drawing" placeholder="Enter Sub Group Name" class="form-control"  value=""   id="">
                  <input required type="hidden" value="0" name="revision_number" placeholder="Enter Sub Group Name" class="form-control"  value=""   id="">
                  <input required type="hidden" value="first created" name="revision_remark" placeholder="Enter Sub Group Name" class="form-control"  value=""   id="">
                 
                
       </div>
       
       
    </div>
         
          
        
 
        
       
        
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
        </form>  
    </div>
    </div>
  </div>
</div>
        <div class="card">
            <?php 
           
            ?>
                <div class="card-header">
                    History
                <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addPromo">
  Add Oprtation Part
</button> -->
                </div>
           
              
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Sr No</th>
                    <th>Part</th>
                    <th>Operation Number </th>
                    <th>Operation Description </th>
                    <th>Revision Number</th>
                    <th>Revision Date</th>
                    <th>Revision Remark</th>
                    <th>Drawing</th>
                   
                  </tr>
                  </thead>
                  <tfoot>
                  <tr>
                  <th>Sr No</th>
                    <th>Part</th>
                    <th>Operation Number </th>
                    <th>Operation Description </th>
                    <th>Revision Number</th>
                    <th>Revision Date</th>
                    <th>Revision Remark</th>
                    <th>Drawing</th>
                   
                  </tr>
                  </tfoot>
                  <tbody>
                  <?php 
                  
                   $i=1;
                   foreach($part_operations as $u)
                   {
                     
                    //   $u = $this->Common_admin_model->get_data_by_id("part_operations",$u->part_id,"part_id");
                     
                    //   $groups = $this->Common_admin_model->get_data_by_id("groups",$u[0]->group_id,"id");
                    //   $sub_group = $this->Common_admin_model->get_data_by_id("sub_group",$u[0]->sub_group_id,"id");
                    //   $operations = $this->Common_admin_model->get_data_by_id("operations",$u[0]->group_id,"id");
                    //   $parts_type = $this->Common_admin_model->get_data_by_id("parts_type",$u[0]->type_id,"id");
                      $part_creation = $this->Common_admin_model->get_data_by_id("part_creation",$u->part_id,"id");
                      $operations = $this->Common_admin_model->get_data_by_id("operations",$u->operation_id,"id");
                   ?>
                  
                
                    <tr>
                   
                    
                        <td><?php echo $i; ?></td>
                        <td><?php echo $part_creation[0]->part_number; ?></td>
                        <td><?php echo $operations[0]->name; ?></td>
                        <td><?php echo $u->operation_description; ?></td>
                        <td><?php echo $u->revision_number; ?></td>
                        <td><?php echo $u->revision_date; ?></td>
                        <td><?php echo $u->revision_remark; ?></td>
                        <td>
                            <a class="btn btn-primary" download  href="<?php echo base_url('documents/').$u->drawing?>">Download </a>
                       </td>
                        
                       
                    </tr>

                  <?php 
                  $i++;
                   }
                
                  ?>
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
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>