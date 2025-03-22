
<div class="content-wrapper">
  <!-- Content -->
  <%assign var='expired' value="no" %>
  <%if ($new_po[0]->expiry_po_date > date('Y-m-d')) %>
  <%assign var='expired' value="yes" %>
  <%else %>

  <%/if%>
  <div class="container-xxl flex-grow-1 container-p-y">
   

    <nav aria-label="breadcrumb">
      <div class="sub-header-left pull-left breadcrumb">
        <h1>
          Store
          <a hijacked="yes" href="" class="backlisting-link">
            <i class="ti ti-chevrons-right" ></i>
            <em >Challan</em></a>
          </h1>
          <br>
          <span >Challan Subcon</span>
        </div>
      </nav>
      <!-- <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Basic Tables</h4> -->

      <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5">
       
        <!-- <button type="button" class="btn btn-seconday" title="Add Challan Subcon" data-bs-toggle="modal" data-bs-target="#exampleModal">
        <i class="ti ti-plus"></i> </button> -->
        <a href="<%base_url('view_add_challan_subcon') %>" class="btn btn-seconday"><i class="ti ti-arrow-left" title="Back"></i></a>
          <!-- <button class="btn btn-seconday" type="button"><i class="ti ti-refresh reset-filter"></i></button> -->
        </div>


        <!-- Main content -->


        <div class="card p-0 mt-4">
          <div class="card-header">
            <div class="row">
              <div class="tgdp-rgt-tp-sect">
                <p class="tgdp-rgt-tp-ttl">Challan Number</p>
                <p class="tgdp-rgt-tp-txt"><%$challan_data[0]->challan_number %></p>
              </div>
              <div class="tgdp-rgt-tp-sect">
                <p class="tgdp-rgt-tp-ttl">Customer Name</p>
                <p class="tgdp-rgt-tp-txt"><%display_no_character($customer[0]->customer_name) %></p>
              </div>
              <div class="tgdp-rgt-tp-sect">
                <p class="tgdp-rgt-tp-ttl">Challan Date & Time</p>
                <p class="tgdp-rgt-tp-txt"><%$challan_data[0]->created_date %> / <%$challan_data[0]->created_time %></p>
              </div>
              <div class="tgdp-rgt-tp-sect">
                <p class="tgdp-rgt-tp-ttl">Status</p>
                <p class="tgdp-rgt-tp-txt"><%$challan_data[0]->status %></p>
              </div>
             
              
              <div class="col-lg-3">
              
                <%if ($challan_data[0]->status != "completed" && $challan_parts ) %>
                  <button type="submit" data-bs-toggle="modal" class="btn  btn-primary mt-4" data-bs-target="#challanCOmplete">
                  Complete Challan
                  </button>
                <%/if%>
                <div class="modal fade" id="challanCOmplete" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Change Status Of
                          Challan
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                        </button>
                      </div>
                      <div class="modal-body">
                        <form action="<%base_url('change_challan_status_subcon') %>" method="POST" class="change_challan_status_subcon_form">
                          <div class="row">
                            <div class="col-lg-12">
                              <div class="form-group">
                                <label for="payment_terms">Are You Sure Want To
                                Complete This Challan ? </label><span class="text-danger">*</span>
                                <input type="hidden" value="<%$challan_id %>" name="challan_id" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Bank Details">
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save
                            changes</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <%if ($challan_data[0]->status != "completed") %>
        <div class="card p-0 mt-4">
          <div class="card-header">
          <form action="javascript:void(0);" class=" custom-form add_challan_parts_subcon" method="post">
            <div class="row">
              <div class="col-lg-3">
                <div class="form-group">
                    <label for="">Select Part Number // Description // Current Stock<span class="text-danger">*</span> </label>
                    <select name="part_id" id="" required class="form-control select2">
                      <%if ($challan_data[0]->status == "completed" ) %>
                            Challan Completed
                      <%else %>
                        <%if ($child_part) %>
                            <%foreach from=$child_part item=c %>
                                    <%if ($c->sub_type == "customer_bom") %>
                                <option value="<%$c->id %>">
                                  <%$c->part_number %> // <%$c->part_description %>/ <%$c->child_part_data[0]->stock %>
                                </option>
                                <%/if%>
                            <%/foreach%>
                        <%/if%>

                     <%/if%>
                    </select>
                </div>
              </div>
              <div class="col-lg-3">
              <div class="form-group">
              <label for="">Enter Qty <span class="text-danger">*</span> </label>
              <input type="text" step="any" name="qty" placeholder="Enter QTY "  class="form-control required-input onlyNumericInput">
              <input type="hidden" name="challan_id" value="<%$challan_data[0]->id %>" required class="form-control">
              </div>
              </div>
              <div class="col-lg-3">
              <div class="form-group">
              <label for="">Select Process <span class="text-danger">*</span> </label>
              <select name="process" required id="" class="form-control select2">
              <%if ($process) %>
                    <%foreach from=$process item=s %>
                    <option value="<%$s->name %>"><%$s->name %></option>
                <%/foreach%>
               <%/if%>
              </select>
              </div>
              </div>
              <div class="col-lg-3">
              <div class="form-group">
              <%if ($challan_data[0]->status == "completed") %>
                  <!-- Challan Completed -->
              <%else %>
                <button type="submit" class="btn btn-primary mt-4">Add Part TO
                challan</button>
              <%/if%>
              </div>
              </div>
              </form>
            </div>
          </div>
          <div class="card-header hide">
            <%if ($po_parts) %>
                <%if ($new_po[0]->status == "pending") %>
                    <%if ($this->session->userdata['type'] == 'admin' || $this->session->userdata['type'] == 'Admin') %>
                  <button type="button" class="btn btn-danger ml-1" data-bs-toggle="modal" data-bs-target="#lock">
                  Lock PO
                  </button>
                <%/if%>
            <%/if%>
            <%/if%>
            <%if ($new_po[0]->status == "lock") %>
                <%if ($this->session->userdata['type'] == 'admin' || $this->session->userdata['type'] == 'Admin') %>
                  <button type="button" class="btn btn-success ml-1" data-bs-toggle="modal" data-bs-target="#accpet">
                Accept (Released) PO
                </button>
                <button type="button" class="btn btn-danger ml-1" data-bs-toggle="modal" data-bs-target="#delete">
                Reject (delete) PO
                </button>
              <%/if%>
            <%else %>
              <%if ($new_po[0]->status != "pending") %>
              <%* <!-- <button type="button" disabled class="btn btn-success ml-1" data-bs-toggle="modal" data-bs-target="#accpet">
                PO Already Released
                </button> -->
              <!-- <a href="<?php echo base_url('download_my_pdf/') . $new_po[0]->id ?>" class="btn btn-primary" href="">Download</a> --> *%>
             <%/if%>
            <%/if%>
            <!-- Modal -->
            <div class="modal fade" id="accpet" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <form action="<%base_url('accept_po_sub') %>" method="POST">
                        <div class="col-lg-12">
                          <div class="form-group">
                            <label for=""><b>Are You Sure Want To Released This
                            PO?</b> </label>
                            <input type="hidden" name="id" value="<%$new_po[0]->id %>" required class="form-control">
                            <input type="hidden" name="status" value="accpet" required class="form-control">
                          </div>
                        </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Update</button>
                  </div>
                </div>
                </form>
              </div>
            </div>
            <div class="modal fade" id="lock" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <form action="<%base_url('accept_po_sub') %>" method="POST">
                        <div class="col-lg-12">
                          <div class="form-group">
                            <label for=""><b>Are You Sure Want To Lock This PO?</b>
                            </label>
                            <input type="hidden" name="id" value="<%$new_po[0]->id %>" required class="form-control">
                            <input type="hidden" name="status" value="lock" required class="form-control">
                          </div>
                        </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Update</button>
                  </div>
                </div>
                </form>
              </div>
            </div>
            <div class="modal fade" id="delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <form action="<%base_url('delete_po') %>" method="POST">
                        <div class="col-lg-12">
                          <div class="form-group">
                            <label for=""><b>Are You Sure Want To Delete This
                            PO?</b> </label>
                            <input type="hidden" name="id" value="<%$new_po[0]->id %>" required class="form-control">
                            <input type="hidden" name="status" value="reject" required class="form-control">
                            <input type="hidden" name="table_name" value="new_po_sub" required class="form-control">
                          </div>
                        </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Update</button>
                  </div>
                </div>
                </form>
              </div>
            </div>
          </div>
        </div>

        <%/if%>
        <div class="card p-0 mt-4">
          <div class="table-responsive text-nowrap">
            <table width="100%" border="1" cellspacing="0" cellpadding="0" class="table table-striped scrollable" style="border-collapse: collapse;" border-color="#e1e1e1" id="view_add_challan_subcon">
              <thead>
                <tr>
                  <!-- <th>Sr No</th> -->
                  <th style="width: 15%;">Part Number</th>
                  <th style="width: 15%;">Part Description</th>
                  <th style="width: 15%;">Qty </th>
                  <th style="width: 15%;">Process</th>
                  <th style="width: 15%;">HSN</th>
                  <th style="width: 15%;">Value</th>
                  <th style="width: 15%;">Remaining Qty </th>
                  <th style="width: 20%;">Edit / Delete</th>
                  <th style="width: 15%;">Action</th>
                  <th style="width: 15%;">History</th>
                </tr>
              </thead>
              <tbody style="max-height: 20em;">
                <%if ($challan_parts) %>
                <%assign var='i' value=1%>
                <%assign var='final_po_amount' value=0%>
                <%foreach from=$challan_parts item=p %>
                <tr>
                  <!-- <td><%$i %></td> -->
                  <td style="width: 15%;"><%$p->part_number %></td>
                  <td style="width: 15%;"><%$p->part_description %></td>
                  <td style="width: 15%;"><%$p->qty %></td>
                  <td style="width: 15%;"><%$p->process %></td>
                  <td style="width: 15%;"><%$p->hsn %></td>
                  <td style="width: 15%;"><%$p->value %></td>
                  <td style="width: 15%;"><%$p->remaning_qty %></td>
                  <td style="width: 20%;">
                    <%if ($challan_data[0]->status != "completed") %>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModa123123123123l<%$i %>">
                      Edit
                    </button>
                    <button type="button" class="btn btn-danger ml-1" data-bs-toggle="modal" data-bs-target="#exampleModaldelet213123e<%$i %>">
                      Delete
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModa123123123123l<%$i %>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Update
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                            </button>
                          </div>
                          <form action="javascript:void(0);" class="update_challan_parts_subcon custom-form update_challan_parts_subcon_<%$p->id %>" method="POST" data-id="<%$p->id %>">
                          <div class="modal-body">
                            <div class="row">
                              <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="">Enter Qty <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="qty" value="<%$p->qty %>" placeholder="Enter QTY "  class="form-control required-input onlyNumericInput">
                                    <input type="hidden" name="id" value="<%$p->id %>" placeholder="Enter QTY " required class="form-control">
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModaldelet213123e<%$i %>" tabindex="-1" aria-labelledby="" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Delete
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                            </button>
                          </div>
                          <div class="modal-body">
                            <div class="row">
                              <form action="javascript:void(0)" method="POST" class="delete_item">
                                <div class="col-lg-12">
                                  <div class="form-group">
                                    <label for=""> <b>Are You Sure Want To
                                      Delete This ? </b> </label>
                                      <input type="hidden" name="id" value="<%$p->id %>" required class="form-control">
                                      <input type="hidden" name="table_name" value="challan_parts_subcon" required class="form-control">
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Delete</button>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                      <%else %>
                      Can't Update , This  is <%$new_sales[0]->status %>
                      <%/if%>
                    </td>
                    <td style="width: 15%;">
                      <%if ($p->challan_parts_history_id != '') %>
                      <%if ($p->challan_parts_history_status == "completed") %>
                      Stock updated
                      <%else %>
                      <button type="submit" data-bs-toggle="modal" class="btn  btn-primary" data-bs-target="#exampleModal2123<%$i %>">
                        Accept Challan Qty
                      </button>
                      <%/if%>
                      <%else %>
                      <%if ($p->remaning_qty > 1) %>
                      <button type="submit" data-bs-toggle="modal" class="btn  btn-primary" data-bs-target="#exampleModal2<%$i %>">
                        Challan Return Qty
                      </button>
                      <%/if%>
                      <%/if%>
                      <div class="modal fade" id="exampleModal2123<%$i %>" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Accept
                                Qty
                              </h5>
                              <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">

                              </button>
                            </div>
                            <div class="modal-body">
                              <form action="<%base_url('update_challan_parts_history_challan') %>" method="POST">
                                <div class="row">
                                  <div class="col-lg-12">
                                    <div class="form-group">
                                      <label for="payment_terms">Qty</label><span class="text-danger">*</span>
                                      <input type="text" disabled value="<%$p->challan_parts_history_qty %>" name="123" required class="form-control" placeholder="Supplier Challan Number">
                                      <input type="hidden" value="<%$p->challan_parts_history_qty  %>" name="qty_main" required class="form-control" placeholder="Supplier Challan Number">
                                      <input type="hidden" value="<%$p->challan_parts_history_id  %>" name="challan_parts_history_id" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Bank Details">
                                      <input type="hidden" value="<%$p->part_id %>" name="part_id" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Bank Details">
                                      <input type="hidden" value="<%$p->challan_id %>" name="challan_id" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Bank Details">
                                    </div>
                                  </div>
                                  <div class="col-lg-12">
                                    <div class="form-group">
                                      <label for="payment_terms">Enter Accept
                                        Qty</label><span class="text-danger">*</span>
                                        <input type="number" max="<%$p->challan_parts_history_accepeted_qty %>" name="accepeted_qty" required class="form-control" placeholder="Enter Qty">
                                      </div>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save
                                      changes</button>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="modal fade" id="exampleModal2<%$i %>" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Return
                                    Qty
                                  </h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                                  </button>
                                </div>
                                <div class="modal-body">
                                  <form action="<%base_url('add_challan_parts_history_challan') %>" method="POST">
                                    <div class="row">
                                      <div class="col-lg-12">
                                        <div class="form-group">
                                          <label for="payment_terms">Supplier
                                            Challan Number</label><span class="text-danger">*</span>
                                            <input type="text" name="supplier_challan_number" required class="form-control" placeholder="Supplier Challan Number">
                                            <input type="hidden" value="<%$challan_id %>" name="challan_id" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Bank Details">
                                            <input type="hidden" value="<%$p->part_id  %>" name="part_id" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Bank Details">
                                          </div>
                                        </div>
                                        <div class="col-lg-12">
                                          <div class="form-group">
                                            <label for="payment_terms">Enter
                                              Qty</label><span class="text-danger">*</span>
                                              <input type="number" max="<%$p->remaning_qty %>" min="1" name="qty" required class="form-control" placeholder="Enter Qty">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                          <button type="submit" class="btn btn-primary">Save
                                            changes</button>
                                          </div>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </td>
                              <td style="width: 15%;">
                                <a class="btn btn-primary" href="<%base_url('view_challan_parts_history_subcon/') %><%$p->challan_id %>/<%$p->part_id %>">History</a>
                              </td>
                            </tr>
                            <%assign var='i' value=$i+1%>
                            <%/foreach%>
                            <%/if%>
                          </tbody>
                          <tfoot>
                            <%if ($po_parts) %>
                            <tr>
                              <th colspan="11">Total</th>
                              <th><%$final_po_amount %></th>
                            </tr>
                            <%/if%>
                          </tfoot>
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
                <script src="<%$base_url%>public/js/store/view_challan_by_id_subcon.js"></script>
