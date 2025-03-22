<div class="wrapper">

<div class="content-wrapper" >
  
  <!-- Content Header (Page header) -->
  <!-- <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Part Family Master</h1>
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
                        <h1>Part Family</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
                            <li class="breadcrumb-item active">Part Family</li>
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
                  <h5 class="modal-title" id="exampleModalLabel">Add Family</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="form-group">
                    <form action="<?php echo base_url('add_part_family') ?>" method="POST" enctype="multipart/form-data">

                  </div>
                  <div class="form-group">
                    <label for="on click url">Part Family<span class="text-danger">*</span></label> <br>
                    <input required type="text" name="name" placeholder="Enter Name" class="form-control" value="" id="">


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
                Add Family
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
                  if ($part_family) {
                    $i = 1;
                    foreach ($part_family as $u) {
                      //$product_into = $this->Ojwebsitemodel->get_product_info_new($u->product_id);

                  ?>

                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $u->name ?></td>
                     
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