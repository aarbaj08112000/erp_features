

<div class="content-wrapper">
  <!-- Content -->

  <div class="container-xxl flex-grow-1 container-p-y">

    <nav aria-label="breadcrumb">
      <div class="sub-header-left pull-left breadcrumb">
        <h1>
          Quality
          <a hijacked="yes" href="javascript:void(0)" class="backlisting-link" title="Back to Issue Request Listing" >
            <i class="ti ti-chevrons-right" ></i>
            <em >Raw Material Inspection Inwarding</em></a>
          </h1>
          <br>
          <span >Raw Material Inspection Inwarding</span>
        </div>
      </nav>

      <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5">
        <a class="btn btn-seconday" href="<%base_url('inwarding_details_accept_reject/') %><%$inwarding_data[0]->id %>/<%$po_id %>">
          <i class="ti ti-arrow-left" title="Back"></i></a>
          <%if ($raw_material_inspection_master) %>
          <a class="btn btn-seconday" href="<%base_url('download_my_pdf_inspection_report/') %><%$child_part_id %>/<%$po_id %>/<%$supplier_id %>/<%$inwarding_id %>/<%$accepted_qty %>/<%$rejected_qty %>/<%$child_part_id_table %>" title="  Download Report">
            <i class="ti ti-download"></i></a>
            <%/if%>
          </div>


          <!-- Main content -->
          <div class="card p-0 mt-4">
            <div class="card-header">
              <div class="tgdp-rgt-tp-sect">
                  <p class="tgdp-rgt-tp-ttl">Part Number</p>
                  <p class="tgdp-rgt-tp-txt"><%$child_part_data[0]->part_number %></p>
               </div>
               <div class="tgdp-rgt-tp-sect">
                  <p class="tgdp-rgt-tp-ttl">Part Description</p>
                  <p class="tgdp-rgt-tp-txt"><%$child_part_data[0]->part_description %></p>
               </div>
            </div>
          </div>
          <div class="card p-0 mt-4">

            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog .modal-lg  " role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                    </button>
                  </div>
                  <div class="modal-body">
                    <form action="<%base_url('add_raw_material_inspection_master') %>" method="POST">
                      <div class="row">
                        <div class="col-lg-12">
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
                            <input type="hidden" value="<%$child_part_id %>" required name="child_part_id" placeholder="Enter Specification" class="form-control">
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>

            <div class="table-responsive text-nowrap">
              <table width="100%" border="1" cellspacing="0" cellpadding="0" class="table table-striped" style="border-collapse: collapse;" border-color="#e1e1e1" id="raw_material_inspection_inwarding">
                <thead>
                  <tr>
                    <!--<th>Sr. No.</th> -->
                    <th>Parameter</th>
                    <th>Specification</th>
                    <th>Evalution Mesaurement Technique</th>
                    <th>Observation 1</th>
                    <th>Observation 2</th>
                    <th>Observation 3</th>
                    <th>Observation 4</th>
                    <th>Observation 5</th>
                    <th>Remark</th>
                    <th class="text-center">Submit</th>
                    <th class="text-center" >Update</th>
                  </tr>
                </thead>
                <tbody>
                  <%assign var='i' value=1 %>
                  <%if ($raw_material_inspection_master) %>
                  <%foreach from=$raw_material_inspection_master item=u  %>
                  <%assign var='raw_material_inspection_report_data' value=$u->raw_material_inspection_report_data %>
                  <tr  id="add_raw_material_inspection_report_tr<%$u->id %> " class="custom-form add_raw_material_inspection_report_tr<%$u->id %> ">
                    <!-- <td><%$i %></td> -->
                    <td><%$u->parameter %></td>
                    <td><%$u->specification %></td>
                    <td><%$u->evalution_mesaurement_technique %></td>
                    <%if (empty($raw_material_inspection_report_data)) %>
                    <td >
                    <form action="<%base_url('add_raw_material_inspection_report') %>" class="add_raw_material_inspection_report add_raw_material_inspection_report<%$u->id %> custom-form" method="post" id="add_raw_material_inspection_report<%$u->id %>">
                        <div class="form-group">
                          <label class="form-label" style="display: none;">Observation 1</label>
                        <input type="text"  placeholder="Enter Observation" class="form-control required-input" name="observation" value="">
                        <input type="hidden"   class="form-control" name="raw_material_inspection_master_id" value="<%$u->id %>">
                        <input type="hidden"   class="form-control" name="child_part_id" value="<%$child_part_id %>">
                        <input type="hidden"   class="form-control" name="accepted_qty" value="<%$accepted_qty %>">
                        <input type="hidden"   class="form-control" name="rej_qty" value="<%$rejected_qty %>">
                        <input type="hidden"   class="form-control" name="invoice_number" value="<%$inwarding_data[0]->invoice_number %>">
                        </div>
                        <input type="hidden"   class="form-control" name="invoice_date" value="<%$inwarding_data[0]->invoice_date %>">
                      </td>
                      <td>
                        <div class="form-group">
                          <label class="form-label" style="display: none;">Observation 2</label>
                        <input type="text"  placeholder="Observation" class="form-control required-input" name="observation2" value="">
                      </div>
                      </td>
                      <td>
                        <div class="form-group">
                          <label class="form-label" style="display: none;">Observation 3</label>
                        <input type="text"  placeholder="Observation" class="form-control required-input" name="observation3" value="">
                      </div>
                      </td>
                      <td>
                        <div class="form-group">
                          <label class="form-label" style="display: none;">Observation 4</label>
                        <input type="text"  placeholder="Observation" class="form-control required-input" name="observation4" value="">
                      </div>
                      </td>
                      <td>
                        <div class="form-group">
                          <label class="form-label" style="display: none;">Observation 5</label>
                        <input type="text"  placeholder="Observation" class="form-control required-input" name="observation5" value="">
                      </div>
                      </td>
                      <td>
                        <div class="form-group">
                          <label class="form-label" style="display: none;">remark</label>
                        <input type="text"  placeholder="Enter Remark" class="form-control required-input" name="remark" value="">
                      </div>
                      </td>
                      <td class="text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </td>
                      </form>
                      <%else %>
                      <td>
                        <%$raw_material_inspection_report_data[0]->observation %>
                      </td>
                      <td>
                        <%$raw_material_inspection_report_data[0]->observation2 %>
                      </td>
                      <td>
                        <%$raw_material_inspection_report_data[0]->observation3 %>
                      </td>
                      <td>
                        <%$raw_material_inspection_report_data[0]->observation4 %>
                      </td>
                      <td>
                        <%$raw_material_inspection_report_data[0]->observation5 %>
                      </td>
                      <td>
                        <%$raw_material_inspection_report_data[0]->remark %>
                      </td>
                      <td class="text-center">
                        already added
                      </td>
                      <%/if%>
                    

                  </td>
                  <td class="text-center">
                    <%if (empty($raw_material_inspection_report_data)) %>
                    <%display_no_character()%>
                    <%else %>
                    <button type="button" class="no-btn" data-bs-toggle="modal" data-bs-target="#exampleModa<%$i %>l">
                      <i class="ti ti-edit"></i>
                    </button>
                    <div class="modal fade" id="exampleModa<%$i %>l" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Update Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                            </button>
                          </div>
                          <div class="modal-body">
                            <form action="javascript:void(0)" class="custom-form update_raw_material_inspection_master_new update_raw_material_inspection_master_new<%$u->id %>" method="POST" id="update_raw_material_inspection_master_new<%$u->id %>">
                              <div class="row">
                                <div class="col-lg-6">
                                  <div class="form-group">
                                    <label> Parameter </label><span class="text-danger">*</span>
                                    <input value="<%$u->parameter %>" readonly type="text"  name="parameter" placeholder="Enter Parameter" class="form-control required-input">
                                  </div>
                                </div>
                                <div class="col-lg-6">
                                  <div class="form-group">
                                    <label> Specification </label><span class="text-danger">*</span>
                                    <input value="<%$u->id %>" readonly type="text"  name="specification" placeholder="Enter Specification" class="form-control required-input">
                                  </div>
                                </div>
                                <div class="col-lg-6">
                                  <div class="form-group">
                                    <label> Evalution Mesaurement Technique </label><span class="text-danger">*</span>
                                    <input value="<%$u->evalution_mesaurement_technique %>" readonly type="text"  name="evalution_mesaurement_technique" placeholder="Enter Specification" class="form-control required-input">
                                    <input type="hidden" value="<%$raw_material_inspection_report_data[0]->id %>"  name="id" placeholder="Enter Specification" class="form-control required-input">
                                  </div>
                                </div>

                                <div class="col-lg-6">

                                  <div class="form-group">
                                    <label> Observation 1</label><span class="text-danger">*</span>
                                    <input type="text" value="<%$raw_material_inspection_report_data[0]->observation %>"  placeholder="Enter Observation" class="form-control required-input" name="observation">
                                  </div>

                                </div>
                                <div class="col-lg-6">
                                  <div class="form-group">
                                    <label> Observation 2</label>
                                    <input type="text" value="<%$raw_material_inspection_report_data[0]->observation2 %>" placeholder="Enter Observation" class="form-control required-input" name="observation2">
                                  </div>
                                </div>

                                <div class="col-lg-6">

                                  <div class="form-group">
                                    <label> Observation 3</label>
                                    <input type="text" value="<%$raw_material_inspection_report_data[0]->observation3 %>" placeholder="Enter Observation" class="form-control required-input" name="observation3">
                                  </div>

                                </div>
                                <div class="col-lg-6">
                                  <div class="form-group">
                                    <label> Observation 4</label>
                                    <input type="text" value="<%$raw_material_inspection_report_data[0]->observation4 %>" placeholder="Enter Observation" class="form-control required-input" name="observation4">
                                  </div>
                                </div>

                                <div class="col-lg-6">

                                  <div class="form-group">
                                    <label> Observation 5</label>
                                    <input type="text" value="<%$raw_material_inspection_report_data[0]->observation5 %>" placeholder="Enter Observation" class="form-control required-input" name="observation5">
                                  </div>
                                </div>
                                <div class="col-lg-6">
                                  <div class="form-group">
                                    <label> Remark</label><span class="text-danger">*</span>
                                    <input type="text" value="<%$raw_material_inspection_report_data[0]->remark %>"  placeholder="Enter Remark" class="form-control required-input" name="remark" value="">
                                  </div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>

                    <%/if%>
                  </form>
                </td>
              </tr>
              <%assign var='i' value=$i+1 %>
              <%/foreach %>
              <%/if%>
            </tbody>
          </table>
        </div>
      </div>
      <!--/ Responsive Table -->
    </div>
    <!-- /.col -->


    <div class="content-backdrop fade"></div>
  </div>

  <script type="text/javascript">
  var base_url = <%$base_url|@json_encode%>
  </script>


  <script src="<%$base_url%>public/js/quality/raw_material_inspection_inwarding.js"></script>
