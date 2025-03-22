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
            <h1>Generate Sales Invoice</h1>
         </div>
         <div class="col-sm-6">
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
                     <div id="loading-overlay">
                        <div id="loading-spinner"></div>
                     </div>
                     <div class="col-lg-4">
                        <form action="<?Php echo base_url('generate_new_sales') ?>" method="POST">
                           <div class="form-group">
                              <label for="">Customer <span class="text-danger">*</span></label>
                              <select name="customer_id" id="customer_tracking" required id="" class="form-control select2">
                                 <option value=''>Select</option>
                                 <?php
                                    if ($customer) {
                                        foreach ($customer as $s) {
                                    ?>
                                 <option value="<?php echo $s->id; ?>"><?php echo $s->customer_name; ?></option>
                                 <?php
                                    }
                                    }
                                    ?>
                              </select>
                           </div>
                     </div>
                     <div class="col-lg-6">
                     <div class="form-group">
                     <label for="">Select Part Number // Description // FG Stock // Rate // Tax Structure
                     <span class="text-danger">*</span> </label>
                     <select name="part_id" id="part_id" required class="form-control select2">
                     <option value=''>Please select</option>
                     </select>
                     </div>                            
                     </div>
                     <div>
                     &nbsp;</div>
                     <div class="col-lg-2">
                     <div class="form-group">
                     <label for="">Mode Of Transport<span class="text-danger">*</label>
                     <select name="mode" class="form-control" required>
                     <option value="">Select</option>
                     <option value="1">Road</option>
                     <option value="2">Rail</option>
                     <option value="3">Air</option>
                     <option value="4">Ship</option>
                     </select>
                     </div>
                     </div>
                     <div class="col-lg-2">
                     <div class="form-group">
                     <label for="">Transporter<span class="text-danger">*</label>
                     <select name="transporter" required id="" class="form-control select2">
                     <option value="">Select Transporter</option>
                     <?php
                        if ($transporter) {
                            foreach ($transporter as $tr) {
                        ?>
                     <option value="<?php echo $tr->id; ?>"><?php echo $tr->name; ?> - <?php echo $tr->transporter_id; ?></option>
                     <?php
                        }
                        }
                        ?>
                     </select>
                     </div>
                     </div>
                     <div class="col-lg-2">
                     <div class="form-group">
                     <label for="">Vehicle No.<span class="text-danger">*</span></label>
                     <input type="text" 
                        placeholder="Enter Vehicle No" 
                        value="" 
                        name="vehicle_number" 
                        pattern="^([A-Z|a-z|0-9]{4,20})$"
                        oninvalid="this.setCustomValidity('Please enter a valid vehicle number in the format XX00XX0000')" 
                        onchange="this.setCustomValidity('')"
                        required class="form-control">
                     </div>
                     </div>
                     <div class="col-lg-2">
                     <div class="form-group">
                     <label for="">L.R No </label>
                     <input type="text" placeholder="Enter L.R No" value="" name="lr_number" class="form-control">
                     </div>
                     </div>
                     <div class="col-lg-3">
                     <div class="form-group">
                     <label for="">Distance of Transportation<span class="text-danger">*</span></label>
                     <input type="text" placeholder="Enter Distance of Transportation" value="" name="distance" required class="form-control">
                     </div>
                     </div>
                     <div>
                     &nbsp;
                     </div>
                     <div class="col-lg-8">
                     <label>Shipping Address: </label><br>
                     <div class="row" style="border:1px;">
                     <div class="col-lg-2">
                     <div class="form-group">   
                     <input type="radio" name="ship_addressType" checked value="customer" onchange="toggleConsigneeSelection()">
                     <br><label>Same as Customer</label><br>
                     </div>
                     </div>
                     <div class="col-lg-5">
                     <div class="form-group">   
                     <input type="radio" name="ship_addressType" value="consignee" onchange="toggleConsigneeSelection()">
                     <br><label>Select Consignee Address</label><br>
                     </div>
                     <div class="form-group">
                     <select name="consignee" id="consigneeSelect" required disabled  class="form-control">
                     <option value="">Select</option>
                     <?php
                        foreach ($consignee_list as $c) {?>
                     <option value="<?php echo $c->id ?>">
                     <?php echo $c->consignee_name." - ".$c->location; ?>
                     </option>
                     <?php }?>
                     </select>
                     </div>
                     <div>
                     </div>
                     </div>
                     <div class="col-lg-2">
                     <div class="form-group">
                     <label for="">Remark</label>
                     <input type="text" placeholder="Enter Remark" value="" name="remark" class="form-control">
                     </div>
                     </div>
                     <div class="col-lg-2">
                     <div class="form-group">
                     <button type="submit" class="btn btn-danger mt-4">Generate</button>
                     </div>
                     </form>
                     </div>
                     </div>
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
<!-- /.content-wrapper -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script>
   function toggleConsigneeSelection() {
      var consigneeSelect = document.getElementById("consigneeSelect");
      var shipAddressType = document.querySelector('input[name="ship_addressType"]:checked').value;
   
      if (shipAddressType === "customer") {
           consigneeSelect.disabled = true;
           consigneeSelect.style.display = "none";
           consigneeSelect.value = ''; //change to default value as select.
      } else if (shipAddressType === "consignee") {
          consigneeSelect.disabled = false;
          consigneeSelect.style.display = "block";
      }
   }
   
   
   $(document).ready(function() {
      var consigneeSelect = document.getElementById("consigneeSelect");
      consigneeSelect.style.display = "none";
      var customer_id = $("#customer_tracking").val();
      // $('#new_po_id').val(id);
      // var salesno = $('#sales_number').val();
      $.ajax({
          url: '<?php echo site_url("SalesController/get_customer_parts_for_sale"); ?>',
          type: "POST",
          data: {
              id: customer_id
          },
          cache: false,
          beforeSend: function() {
              // Show the loading icon
              $("#loading-overlay").show();
          },
          success: function(response) {
               // Hide the loading icon
              if (response) {
                  $('#part_id').html(response);
              } else {
                  $('#part_id').html(response);
              }
          },complete: function() {
                  // Hide the loading overlay
                  $("#loading-overlay").hide();
          }
          
     });
      $("#customer_tracking").change(function() {
          var customer_id = $("#customer_tracking").val();
          // var salesno = $('#sales_number').val();
          $.ajax({
              url: '<?php echo site_url("SalesController/get_customer_parts_for_sale"); ?>',
              type: "POST",
              data: {
                  id: customer_id
                  //, salesno: salesno
              },
              cache: false,
              beforeSend: function() {
                   // Show the loading icon
                  $("#loading-overlay").show();
              },
              success: function(response) {
                  if (response) {
                      $('#part_id').html(response);
                  } else {
                      $('#part_id').html(response);
                  }
              },
              complete: function() {
                  // Hide the loading icon
                  $("#loading-overlay").hide();
              }        
          });
      })
   });
</script>