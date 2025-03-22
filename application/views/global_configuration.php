<div class="wrapper">
<div class="content-wrapper" >
    <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Global Configurations</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
                            <li class="breadcrumb-item active">Configuration</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
  <!-- Main content -->
  <section class="content">
    <div>
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <br>
        <div class="col-lg">
          <!-- Modal -->
          <div class="modal fade" id="addConfig" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Add Configuation</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="form-group">
                    <form action="<?php echo base_url('add_new_config') ?>" method="POST">
                  </div>
                  <div class="form-group">
                    <label for="on click url">Display Name<span class="text-danger">*</span></label> <br>
                    <input required type="text" name="display_label" required maxlength="100" placeholder="Display Name" class="form-control" value="">
                  </div>
                  <div class="form-group">
                    <label for="on click url">Config Name<span class="text-danger">*</span></label> <br>
                    <input required type="text" name="config_name" required maxlength="100" placeholder="Config Name" class="form-control" value="">
                  </div>
                  <div class="form-group">
                    <label for="on click url">Config Value<span class="text-danger">*</span></label> <br>
                    <input required type="text" name="config_value" required placeholder="Config Value" class="form-control" value="">
                  </div>
                  <div class="form-group">
                    <label for="on click url">Note<span class="text-danger">*</span></label> <br>
                    <textarea required type="text" name="note" required maxlength="255" placeholder="Note" class="form-control"></textarea>
                  </div>
                  <div class="form-group">
                    <input type="checkbox" name="forAromOnly" checked>
                    <label for="original">For AROM ONLY ?</label><br>
                  </div>
                  <div class="form-group">    
                    <input type="checkbox" name="canCustomerModify">
                    <label for="original">Can User Modify ?</label><br>
                  </div>
                </div>
                   
               <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-primary">Save</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="card">
          <?php if($isAromAdmin=='true') { ?>
            <div class="card-header">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addConfig">
                Add New Config
              </button>
            </div>
            <?php } ?>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Config Name</th>
                    <?php if($isAromAdmin=='true') { ?>
                    <th>AROM Config Name</th>
                    <?php } ?>
                    <th>Config Value</th>
                    <th>Note/Comment</th>
                    <th>Updated time</th>
                    <th>Updated User</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  if (true) {
                    $i = 1;
                    foreach ($configurations as $config) {
                  ?>
                      <tr>
                        <td><?php echo $config->displayLabel; ?></td>
                        <?php if($isAromAdmin=='true') { ?>
                          <td><?php echo $config->config_name; ?></td>
                        <?php } ?>
                        <td><?php echo $config->config_value; ?></td>
                        <td><?php echo $config->note; ?></td>
                        <td><?php echo $config->updatedttm; ?></td>
                        <td><?php echo $config->updated_user; ?></td>
                        <td>
                          <?php if($config->canModify) { ?>
                          <button type="button" class="btn btn-primary " title="Update" data-toggle="modal" data-target="#exampleModa<?php echo $i; ?>l">
                             <i class="fa fa-edit"></i>
                          </button>
                         <?php }?>
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
                                        <form action="<?php echo base_url('edit_config') ?>" method="POST" enctype="multipart/form-data">
                                          <input type="hidden" name="old_val" value="<?php echo $config->config_value; ?>">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                      <div class="form-group">
                                                          <label for="on click url">Name<span class="text-danger">*</span></label> <br>
                                                          <input required type="text" name="display_label" maxlength="100" placeholder="Display Name" class="form-control" value="<?php echo $config->displayLabel; ?>">
                                                        </div>
                                                        <div class="form-group">
                                                          <label for="on click url">Config Name<span class="text-danger">*</span></label> <br>
                                                          <input required type="text" disabled name="config_name" maxlength="100" placeholder="Config Name" class="form-control" value="<?php echo $config->config_name; ?>">
                                                          <input type="hidden" name="config_name" value="<?php echo $config->config_name ?>" class="form-control">
                                                          <input type="hidden" name="configID" value="<?php echo $config->id ?>" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                          <label for="on click url">Config Value<span class="text-danger">*</span></label> <br>
                                                           <?php if($config->config_name == "companyLogo"){?>
                                                             <input required type="file" name="companyLogo" placeholder="Config Value" class="form-control" value="<?php echo $config->config_value; ?>">
                                                           <?php }else{?>
                                                          <input required type="text" name="config_value" placeholder="Config Value" class="form-control" value="<?php echo $config->config_value; ?>">
                                                        <?php }?>
                                                        </div>
                                                        <div class="form-group">
                                                          <label for="on click url">Note<span class="text-danger">*</span></label> <br>
                                                          <textarea required name="note" maxlength="255" placeholder="Note" class="form-control"><?php echo $config->note; ?></textarea>
                                                         </div>
                                                         <?php if($isAromAdmin=='true') { ?>
                                                         <div class="form-group">
                                                          <input type="checkbox" name="forAromOnly" <?php if($config->ARMUserOnly == '1') echo "checked"; ?> >
                                                          <label for="original">For AROM ONLY ?</label><br>
                                                        </div>
                                                        <div class="form-group">    
                                                          <input type="checkbox" name="canCustomerModify" <?php if($config->canModify == '1') echo "checked"; ?> >
                                                          <label for="original">Can User Modify ?</label><br>
                                                        </div>
                                                        <?php }else { ?>
                                                          <input type="hidden" name="canCustomerModify" value="<?php echo $config->canModify ?>" class="form-control">
                                                          <input type="hidden" name="forAromOnly" value="<?php echo $config->ARMUserOnly ?>" class="form-control">
                                                        </div>
                                                        <?php } ?>
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