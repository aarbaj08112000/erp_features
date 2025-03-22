<div class="wrapper" style="width:2400px">
   <div class="header">

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Supplier Parts (Item) Stock.</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Part Stocks</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div>
                <div class="row">
                    <div class="col-12">
                        <!-- /.card -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <a href="<%base_url('download_stock_variance')%>" class="btn btn-info">Download Stock Variance </a>
                                </h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form action="<%$base_url%>view_part_stocks" method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <div style="">
                                                <div class="form-group">
                                                    <label for="on click url">Select Part Number<span class="text-danger">*</span></label> <br>
                                                    <select name="part_id" id="selectPart" class="form-control select2" required>
                                                        <option value="">Select Part ID</option>
                                                        <%foreach from=$supplier_part_select_list item=c%>
                                                            <option <%if $filter_part_id eq $c->id%>selected<%/if%> value="<%$c->id%>"><%$c->part_number%>
                                                        <%/foreach%>
                                                         <!-- <option value="ALL">ALL</option> -->
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <label for="">&nbsp;</label> <br>
                                            <button class="btn btn-secondary">Search </button>
                                        </div>
                                    </div>
                                </form>

                                <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Part Number</th>
                                            <th>Part Description</th>
                                            <th>UOM</th>
                                            <th>Safety Buffer Stock</th>
                                            <th>Store Stock</th>
                                            <th>Subcon Stock</th>
                                            <th>Stock Reserve against Job order</th>
                                            <th>Production Rejection Stock</th>
                                            <th>Store Rejection Stock</th>
                                            <th>Production Stock</th>
                                            <th> Under Inspection Stock</th>
                                            <th>GRN Rejection Stock</th>
                                            <th>Store Rack Location</th>
                                            <th>Store Stock Rate</th>
                                            <th>Store Stock Value</th>
                                            <th>Production Stock</th>
                                            <th>Sharing Stock</th>
                                            <th>Machine Mold Stock</th>
                                            <th>Production Scrap</th>
                                            <th>Production Rejection</th>
                                            <th>Deflashing Location</th>
                                            <th>Transfer To FG</th>
                                        </tr>
                                    </thead>
                                    <!-- <tfoot>
                                        <th colspan="11"></th>
                                        <th colspan="2">Total Store Stock Value</th>
                                        <th colspan="2"><input type="number" readonly name="total_value" id="total_value_id" class="form-control">
                                        </th>
                                    </tfoot> -->
                                    <tbody>
                                        <%foreach from=$child_part_list item=po%>
                                            <tr>
                                                <td><%$po->id%></td>
                                                <td><%$po->part_number%></td>
                                                <td><%$po->part_description%></td>
                                                <td><%$uom_data[$po->id][0]->uom_name%></td>
                                                <td class="<%if $po->safty_buffer_stk <= $po->$stock_column_name%>text-success<%else%>text-danger<%/if%>">
                                                    <%$po->safty_buffer_stk%>
                                                </td>
                                                <td>
    <%if $po->$stock_column_name > 0%>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#storeToStore<%$i%>">
            <%$po->$stock_column_name%>
        </button>
        <div class="modal fade" id="storeToStore<%$i%>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Transfer Stock Store to Store
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form action="<%base_url('transfer_child_store_to_store_stock')%>" method="POST" enctype="multipart/form-data">
                                    <label for="">Stock Qty <span class="text-danger">*</span>
                                    </label>
                                    <input type="number" step="any" class="form-control" value="" max="<%$po->$stock_column_name%>" name="stock" required placeholder="Transfer Qty">
                                    <input type="hidden" class="form-control" value="<%$po->part_number%>" name="part_number" required>
                                    <input type="hidden" class="form-control" value="<%$po->id%>" name="child_part_id" required>
                            </div>
                            <div class="col-lg-12">
                                <br>
                                <label for="">Supplier Part no / Description </label>
                                <select name="customer_part_number" required id="" class="form-control select2">
                                    <option value="">Select Part</option>
                                    <%foreach from=$supplier_part_select_list item=ccc%>
                                        <%if $filter_part_id!= $ccc->id%>
                                            <option value="<%$ccc->id%>">
                                                <%$ccc->part_number%>/<%$ccc->part_description%>
                                            </option>
                                        <%/if%>
                                    <%/foreach%>
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
        </div>
    <%else%>
        <%$po->$stock_column_name%>
    <%/if%>
</td>
<td><%$po->sub_con_stock%></td>
<td><%$po->onhold_stock%></td>
<td><%$store_scrap[$po->id]%></td>
<td><%$po->rejection_stock%></td>
<td><%$po->rejection_prodcution_qty%></td>

<td><%$underinspection_stock[$po->id]%></td>
<td><%$scrap_stock[$po->id]%></td>

<td><%$po->store_rack_location%></td>
<td><%$po->store_stock_rate%></td>

<td><%($po->$stock_column_name) * ($po->store_stock_rate)%></td>
<td>
    <%if $po->$sheet_prod_column_name > 0%>
        <%if $role == "Admin"%>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#prodToStore<%$i%>">
                <%$po->$sheet_prod_column_name%>
            </button>
        <%/if%>
    <%else%>
        <%$po->$sheet_prod_column_name%>
    <%/if%>
    <!-- edit Production Modal -->
    <div class="modal fade" id="prodToStore<%$i%>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Transfer Production Stock to Store Stock
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="<%base_url('update_production_qty_child_part_production_qty')%>" method="POST" enctype="multipart/form-data">
                                <label for="">Production Qty <span class="text-danger">*</span>
                                </label>
                                <input type="number" step="any" class="form-control" value="" max="<%$po->$sheet_prod_column_name%>" name="production_qty" min="1" required placeholder="Enter Transfer Qty">
                                <input type="hidden" class="form-control" value="<%$po->part_number%>" name="part_number" required>
                                <input type="hidden" class="form-control" value="<%$po->id%>" name="child_part_id" required>
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
                                    </td>
                                    <td><%$po->$sharingQtyColName%></td>
                                    <td>
                                        <%if $po->$plastic_prod_column_name > 0%>
                                            <%if $role == "Admin"%>
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#prodToStorePlastic<%$i%>">
                                                    <%$po->$plastic_prod_column_name%>
                                                </button>
                                            <%/if%>
                                        <%else%>
                                            <%$po->$plastic_prod_column_name%>
                                        <%/if%>
                                        <!-- edit Plastic Modal -->
                                        <div class="modal fade" id="prodToStorePlastic<%$i%>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Transfer Production Qty to Store Stock
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <form action="<%base_url('update_production_qty_child_part')%>" method="POST" enctype="multipart/form-data">
                                                                    <label for="">Machine Mold Stock Qty <span class="text-danger">*</span>
                                                                    </label>
                                                                    <input type="number" step="any" class="form-control" value="" max="<%$po->$plastic_prod_column_name%>" name="machine_mold_issue_stock" min="1" required placeholder="Enter Transfer Qty">
                                                                    <input type="hidden" class="form-control" value="<%$po->part_number%>" name="part_number" required>
                                                                    <input type="hidden" class="form-control" value="<%$po->id%>" name="child_part_id" required>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <label for="">Select Customer Part Number /
                                                                    Customer Name </label>
                                                                <select name="customer_part_number" required id="" class="form-control select2">
                                                                    <option value="">Select Part</option>
                                                                    <%foreach from=$customer_part_data_new_updated item=ccc%>
                                                                        <option value="<%$ccc->part_number%>">
                                                                            <%$ccc->part_number%>
                                                                        </option>
                                                                    <%/foreach%>
                                                                </select>
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
                                        </div>
                                    </td>
                                    <td><%$po->production_rejection%></td>
                                    <td><%$po->production_scrap%></td>
                                    <td><%$po->deflashing_stock%></td>
                                    <td>
                                    
                                        
                                        <%if $po->$stock_column_name > 0%>
                                        
                                            <%if $role == "Admin" || $role == "stores"%>
                                            
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#fgtransfer<%$i%>">
                                                    Transfer FG Stock
                                                </button>
                                            <%/if%>
                                        <%else%>
                                            <%$po->$stock_column_name%>
                                        <%/if%>
                                        <!-- FG Transfer Modal -->
                                        <div class="modal fade" id="fgtransfer<%$i%>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel"> Transfer Store Stock to FG Stock
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <form action="<%base_url('transfer_fg_stock')%>" method="POST" enctype="multipart/form-data">
                                                                <label for="">FG Stock Qty <span class="text-danger">*</span>
                                                                </label>
                                                                <input type="number" step="any" class="form-control" value="" max="<%$po->$stock_column_name%>" name="fg_stock" min="1" required placeholder="Enter Transfer Qty">
                                                                <input type="hidden" class="form-control" value="<%$po->part_number%>" name="part_number" required>
                                                                <input type="hidden" class="form-control" value="<%$po->id%>" name="child_part_id" required>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <label for="">Select FG Part Number /
                                                                FG Description </label>
                                                            <select name="fg_part_number" required id="" class="form-control select2">
                                                                <option value="">Select Part</option>
                                                                <%foreach from=$fg_part_data item=ccc%>
                                                                    <option value="<%$ccc->part_number%>">
                                                                        <%$ccc->part_number%>/<%$ccc->part_description%>
                                                                    </option>
                                                                <%/foreach%>
                                                            </select>
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
                                    </div>
                                </td>
                                
                            </tr>
                            <%/foreach%>

                            </tbody>

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
</div>