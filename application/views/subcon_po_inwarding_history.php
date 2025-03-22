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
                  <!-- <h1></h1> -->
                  <?php
                     $expired = "no";
                     if ($new_po[0]->expiry_po_date > date('Y-m-d')) {
                             $expired =  "yes";
                     } else {
                             // echo "no";
                     }
                     ?>
               </div>
               <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="<?php echo base_url('generate_po') ?>">Home</a></li>
                     <li class="breadcrumb-item active"></li>
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
                        <h1>History</h1>
                     </div>
                     <div class="card-body">
                        <table class="table table-bordered table-striped" id="example1">
                           <thead>
                              <tr>
                                 <th>Sr No</th>
                                 <th>Challan Number</th>
                                 <th>Challan Inwarding Qty</th>
                                 <th>Date & Time </th>
                                 <th>Actions</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php
                                 // print_r($subcon_po_inwarding_history);
                                 if ($subcon_po_inwarding_history) {
                                         $final_po_amount = 0;
                                         $i = 1;
                                         foreach ($subcon_po_inwarding_history as $p) {
                                                 $challan_data = $this->Crud->get_data_by_id("challan", $p->challan_id, "id");
                                 
                                 
                                             ?>
                                          <tr>
                                             <td><?php echo $i;?></td>
                                             <td><?php echo $challan_data[0]->challan_number; ?></td>
                                             <td><?php echo $p->new_qty; ?></td>
                                             <td><?php echo $p->created_date."/".$p->created_time; ?></td>
                                             <td>
                                                <a href="" class="btn btn-danger btn-sm">Delete</a>
                                             </td>
                                          </tr>
                                          <?php
                                             $i++;
                                             }
                                 }
                                 
                                 ?>
                           </tbody>
                           <tfoot>
                              <?php
                                 if ($po_parts) {
                                 ?>
                              <tr>
                                 <th colspan="11">Total</th>
                                 <th><?php echo $final_po_amount; ?></th>
                              </tr>
                              <?php
                                 }
                                 ?>
                           </tfoot>
                        </table>
                     </div>
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