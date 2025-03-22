
const datatable = {
    init:function(){
        let that = this;
        $(document).on("click",".add-part",function(){
            var part_html = that.itemRow();
            console.log(part_html)
            $(this).parents(".part-box").find("tbody").append(part_html);
            $(".select2select").select2();
        })
        $(document).on("click",".remove-part",function(){
            $(this).parents("tr").remove();
        })
        $(document).on("click",".remove-packing",function(){
            $(this).parents(".packing-box-row").remove();
        })
        $(document).on("click",".add-package",function(){
            var part_html = that.packingRow();
            console.log(part_html)
            $(".packing-box").append(part_html);
            $(".select2select").select2();
        })
        this.initFormValidate();
        
    },
    itemRow:function(){
        var html = `
            <tr>
                            <td width="35%">
                                <div class="form-group">
                                    <label class="hide">Part</label>
                                    <select name="parts"  class="form-control select2select required-input w-25 part_id">
                                        ${export_sales_parts_html}
                                    </select>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <label class="hide">Quantity</label>
                                    <input type="text" placeholder="Enter Quantity" value="" name="material_used" class="form-control required-input part_qty onlyNumericInput" data-min="1">
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <label class="hide">Net Weight</label>
                                    <input type="text" placeholder="Enter Net Weight value="" name="material_used" class="form-control required-input part_net_weight onlyNumericInput" data-min="1">
                                </div>
                            </td>
                            <td class="text-center">
                                <i class="ti ti-square-rounded-plus add-part"></i>
                                <i class="ti ti-circle-minus remove-part"></i>
                            </td>
                            </tr>`;
        return html;
    },
    packingRow:function(){
        var packing = `
            <div class="border row border-dark m-1 mt-0 border-top-0 mb-0 packing-box-row">
                <div class="w-25 border  border-dark  text-center p-1 border-top-0 d-flex">
                    <div class="form-group justify-content-center d-flex w-100 align-items-center flex-column">
                        <label class="hide">Package No</label>
                        <input type="text" placeholder="Enter Package No" value="" name="material_used" class="form-control w-75 required-input packing_no onlyNumericInput">
                    </div>
                </div>
                <div class="w-25 border  border-dark  text-center p-1 border-top-0 d-flex">
                <div class="form-group justify-content-center d-flex w-100 align-items-center flex-column">
                        <label class="hide">Package Size</label>
                    <input type="text" placeholder="Enter Package Size" value="" name="material_used" class="form-control w-75  justify-content-center required-input packing_size">
                </div>
                </div>
                <div class=" border border-dark p-1 border-top-0" style="width: 45%;">
                    <table class="table table-bordered border-primary part-box part-box-rows ">
                        <thead>
                            <tr>
                            <th scope="col" width="35%" class="text-center">Part </th>
                            <th scope="col"  class="text-center">Quantity</th>
                            <th scope="col"  class="text-center">Net Weight in Kg</th>
                            <th scope="col" width="10%" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                             <tr>
                            <td width="35%">
                                <div class="form-group">
                                    <label class="hide">Part</label>
                                    <select name="parts"  class="form-control select2select required-input w-25 part_id">
                                        ${export_sales_parts_html}
                                    </select>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <label class="hide">Quantity</label>
                                    <input type="text" placeholder="Enter Quantity" value="" name="material_used" class="form-control required-input part_qty onlyNumericInput" data-min="1">
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <label class="hide">Net Weight</label>
                                    <input type="text" placeholder="Enter Net Weight" value="" name="material_used" class="form-control required-input part_net_weight onlyNumericInput" data-min="1">
                                </div>
                            </td>
                            <td class="text-center">
                                <i class="ti ti-square-rounded-plus add-part"></i>
                            </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class=" border  border-dark  text-center p-1 border-top-0 d-flex" style="width: 5%;">
                                <div class="form-group justify-content-center d-flex w-100 align-items-center flex-column">
                                <i class="ti ti-circle-minus remove-packing fs-2"></i>
                                </div>
                </div>
        `;
        return packing;
    },
    initFormValidate: function(){
        let that = this;
        $(".add_export_packing_slip").submit(function(e){
            e.preventDefault();
            var href = $(this).attr("action");
            var id = $(this).attr("id");
            let flag = that.formValidate(id);
            console.log(flag);

            if(flag){
              return;
            }
            var packing_parts = [];
            var box_count = 0;
            var total_qty = 0;
            var total_net_weight = 0;
            $( ".packing-box-row" ).each(function( index ) {
                box_count++;
                var packing_no = $(this).find(".packing_no").val();
                var packing_size = $(this).find(".packing_size").val();
                $(this).find(".part-box-rows tbody tr").each(function( index ) {
                var part_id = $(this).find(".part_id").val();
                var part_qty = $(this).find(".part_qty").val();
                var part_net_weight = $(this).find(".part_net_weight").val();
                total_qty+=parseFloat(part_qty);
                total_net_weight+=parseFloat(part_net_weight);
                packing_parts.push({
                    "packing_no":packing_no,
                    "packing_size":packing_size,
                    "part_id":part_id,
                    "part_qty":part_qty,
                    "part_net_weight":part_net_weight,
                })
                });
            
            });

            if(box_count != parseFloat(total_box)){
                toastr.error("Total Box miss match");
            }else if(total_qty != parseFloat(total_qty_val)){
                toastr.error("Total part qty miss match");
            }else if(total_net_weight != parseFloat(total_net_weight_val)){
                toastr.error("Total net weight miss match");
            }else{
                var material_used_value = $(".material_used_value").val();
                var content_value = $(".content_value").val();
                var mode = $("#export_packing_slip_id").val() > 0 ? "Update" : "Add";
                $.ajax({
                    type: "POST",
                    url: base_url+"add_export_packing_slip",
                    data: {
                        packing_parts:packing_parts,
                        sales_id:sales_id,
                        material_used:material_used_value,
                        content:content_value,
                        mode:mode,
                        export_packing_slip_id: $("#export_packing_slip_id").val()
                    },
                    success: function (response) {
                      var responseObject = JSON.parse(response);
                      var msg = responseObject.messages;
                      var success = responseObject.success;
                      if (success == 1) {
                        toastr.success(msg);
                        $(this).parents(".modal").modal("hide")
                        setTimeout(function(){
                          window.location.reload();
                        },1000);
      
                      } else {
                        toastr.error(msg);
                      }
                    },
                    error: function (error) {
                      console.error("Error:", error);
                    },
                  });
            }
            console.log(packing_parts,box_count,total_qty,total_net_weight)
            return;

            var formData = new FormData($('.'+id)[0]);

            
          });
    },
    formValidate: function(form_class = ''){
        let flag = false;
        $(".custom-form."+form_class+" .required-input").each(function( index ) {
          var value = $(this).val();
          var dataMax = parseFloat($(this).attr('data-max'));
          var dataMin = parseFloat($(this).attr('data-min'));
          if(value == ''){
            flag = true;
            console.log($(this).parents(".form-group"))
            var label = $(this).parents(".form-group").find("label").contents().filter(function() {
              return this.nodeType === 3; // Filter out non-text nodes (nodeType 3 is Text node)
            }).text().trim();
            var exit_ele = $(this).parents(".form-group").find("label.error");
            if(exit_ele.length == 0){
              var start ="Please enter ";
              if($(this).prop("localName") == "select"){
                var start ="Please select ";
              }
              label = ((label.toLowerCase()).replace("enter", "")).replace("select", "");
              var validation_message = start+(label.toLowerCase()).replace(/[^\w\s*]/gi, '');
              var label_html = "<label class='error'>"+validation_message+"</label>";
              $(this).parents(".form-group").append(label_html)
            }
          }
          else if(dataMin !== undefined && dataMin > value){
            flag = true;
            var label = $(this).parents(".form-group").find("label").contents().filter(function() {
              return this.nodeType === 3; // Filter out non-text nodes (nodeType 3 is Text node)
            }).text().trim();
            var exit_ele = $(this).parents(".form-group").find("label.error");
            if(exit_ele.length == 0){
              var end =" must be greater than or equal "+dataMin;
              label = ((label.toLowerCase()).replace("enter", "")).replace("select", "");
              label = (label.toLowerCase()).replace(/[^\w\s*]/gi, '');
              label = label.charAt(0).toUpperCase() + label.slice(1);
              var validation_message =label +end;
              var label_html = "<label class='error'>"+validation_message+"</label>";
              $(this).parents(".form-group").append(label_html)
            }
            }else if(dataMax !== undefined && dataMax < value){
              flag = true;
              var label = $(this).parents(".form-group").find("label").contents().filter(function() {
                return this.nodeType === 3; // Filter out non-text nodes (nodeType 3 is Text node)
              }).text().trim();
              var exit_ele = $(this).parents(".form-group").find("label.error");
              if(exit_ele.length == 0){
                var end =" must be less than or equal "+dataMax;
                label = ((label.toLowerCase()).replace("enter", "")).replace("select", "");
                label = (label.toLowerCase()).replace(/[^\w\s*]/gi, '');
                label = label.charAt(0).toUpperCase() + label.slice(1)
                var validation_message =label +end;
                var label_html = "<label class='error'>"+validation_message+"</label>";
                $(this).parents(".form-group").append(label_html)
              }
          }
        });
       
        return flag;
    }


}

$(document).ready(function () {
    datatable.init();    
})
