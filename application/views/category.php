<div class="wrapper">

<div class="content-wrapper" >
  <!-- Content Header (Page header) -->
  <!-- <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Process Master</h1>
        </div>

        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
          </ol>
        </div>
      </div>
    </div>
  </div> -->
  <!-- /.content-header -->

  <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Category</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
                            <li class="breadcrumb-item active">category</li>
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
        <div class="col-lg-12">

          <!-- Modal -->
          <div class="modal fade" id="addPromo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="form-group">
                    <form action="<?php echo base_url('add_category') ?>" method="POST" enctype="multipart/form-data">

                  </div>
                  <div class="form-group">
                    <label for="on click url">Category Name<span class="text-danger">*</span></label> <br>
                    <input required type="text" name="name" placeholder="Enter Name" class="form-control" value="" id="">
                  </div>
                  <div class="form-group">
                    <label for="on click url">Parent Category<span class="text-danger">*</span></label> <br>
                    <select class="form-control select2" name="parent_id" style="width: 100%;">
						<option value="">Select Parent Category</option>
                        <?php
                            foreach ($category_list as $a) { 
                            	if(!($a->parent_id > 0)){
                            	?>
                            	<option value="<?php echo $a->category_id; ?>">
                                    <?php echo $a->category_name; ?></option>
						<?php
					}
                            }
                        ?>
					</select>
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

            <div class="card-header">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addPromo">
                Add Category
              </button>
            </div>


            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Sr No</th>
                    <th> Name</th>
              
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Sr No</th>
                    <th>Name</th>
                  </tr>
                </tfoot>
                <tbody>
                  <?php
                  if ($category_list) {
                    $i = 1;
                    foreach ($category_list as $u) {
                      //$product_into = $this->Ojwebsitemodel->get_product_info_new($u->product_id);

                  ?>

                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $u->category_name ?></td>
                     
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