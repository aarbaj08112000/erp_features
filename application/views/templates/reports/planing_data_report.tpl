<div class="wrapper" style="<%$wrapper_style%>">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Planning Data </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"></h3>
                                <div class="row">
                                    <div class="col-lg-2">
                                        <form action="<%$smarty.const.BASE_URL%>planing_data_report_view" method="post">
                                            <div class="form-group">
                                                <label for="">Select Customer</label>
                                                <select name="customer_id" id="" class="form-control select2">
                                                    <option value="0">All</option>
                                                    <%if $customer%>
                                                        <%foreach $customer as $c%>
                                                            <option <%if $c->id == $customer_id%>selected
                                                                <%/if%> value="
                                                                    <%$c->id%>">
                                                                        <%$c->customer_name%>
                                                            </option>
                                                            <%/foreach%>
                                                                <%/if%>
                                                </select>
                                            </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Select Financial Year</label>
                                            <select name="financial_year" id="" class="form-control select2">
                                                <%for $i=2020 to 2027%>
                                                    <%$year="FY-"|cat:$i%>
                                                        <option <%if $i==2024%>selected
                                                            <%/if%> value="
                                                                <%$year%>">
                                                                    <%$year%>
                                                        </option>
                                                        <%/for%>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Select Month</label>
                                            <select name="month_id" id="" class="form-control select2">
                                                <option value="MAR">MAR</option>
                                                <option value="APR">APR</option>
                                                <option value="MAY">MAY</option>
                                                <option value="JUN">JUN</option>
                                                <option value="JUL">JUL</option>
                                                <option value="AUG">AUG</option>
                                                <option value="SEP">SEP</option>
                                                <option value="OCT">OCT</option>
                                                <option value="NOV">NOV</option>
                                                <option value="DEC">DEC</option>
                                                <option value="JAN">JAN</option>
                                                <option selected value="FEB">FEB</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-danger mt-4">Search</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="modal fade" id="exampleModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add Planing</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="<%$smarty.const.BASE_URL%>add_planning_data" method="POST">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label for="contractorName">Select Customer Part Number / Description </label><span class="text-danger">*</span>
                                                                <select name="customer_part_id" id="" class="form-control select2">
                                                                    <%if $customer_part%>
                                                                        <%foreach $customer_part as $c%>
                                                                            <option value="<%$c->id%>">
                                                                                <%$c->part_number%> /
                                                                                    <%$c->part_description%>
                                                                            </option>
                                                                            <%/foreach%>
                                                                                <%/if%>
                                                                </select>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="form-group">
                                                                    <label for="contractorName">Select Month </label><span class="text-danger">*</span>
                                                                    <select name="month_id" id="" class="form-control select2">
                                                                        <option value="<%$month_id%>">
                                                                            <%$month_id%>
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="form-group">
                                                                    <label for="contractorName">Enter Schedule Qty </label><span class="text-danger">*</span>
                                                                    <input type="number" required name="schedule_qty" class="form-control">
                                                                    <input type="hidden" required name="financial_year" value="<%$financial_year%>" class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                        
                                            <th>Customer Part Number</th>
                                            <th>Customer Part Description</th>
                                            <th>Customer Name</th>
                                            <th>Month </th>
                                            <th>Schedule Qty 1</th>
                                            <th>Schedule Qty 2</th>
                                            <th>Job Card Qumulative Qty</th>
                                            <th>Job Card Balance Qty</th>
                                            <th>Job Card Issued</th>
                                            <th>Job Card Closed</th>
                                            <th>Customer Part Price</th>
                                            <th>Dispatch (sales qty) </th>
                                            <th> Balance Schedule qty </th>
                                            <th>Subtotal Schedule </th>
                                            <th>View Details </th>
                                        </tr>
                                    </thead>
                                    <tbody>
            <%$i=1%>
            <%$total1=0%>
            <%$total2=0%>
            <%if $planing_data%>
            <%foreach $planing_data as $t%>
            <%$planing_data|pr%>
            <tr>
                <td>
                    <%$i%>
                </td>
                <td>
                    <%$customer_part_data[$t->id][0]->part_number%>
                </td>
                <td>
                    <%$customer_part_data[$t->id][0]->part_description%>
                </td>
                <td>
                    <%$customers_data[$t->id][0]->customer_name%>
                </td>
                <td>
                    <%$t->month%>
                </td>
                <td>
                    <%$planing_data_new[$t->id][0]->schedule_qty%>
                </td>
                <td>
                    <%$planing_data_new[$t->id][0]->schedule_qty_2%>
                </td>
                <td>
                    <%if !empty($job_card_qty)%>
                        <%$job_card_qty%>
                            <%else%>
                                <%$job_card_qty=0%>
                                    <%/if%>
                </td>
                <td>
                    <%if empty($planing_data[0]->schedule_qty_2)%>
                        <%$planing_data[0]->schedule_qty-$job_card_qty%>
                            <%else%>
                                <%$planing_data[0]->schedule_qty_2-$job_card_qty%>
                                    <%/if%>
                </td>
                <td>
                    <%$issued%>
                </td>
                <td>
                    <%$closed%>
                </td>
                <td>
                    <%$rate%>
                </td>
                <td>
                    <%$dispatch_sales_qty%>
                </td>
                <td>
                    <%$balance_s_qty%>
                </td>
                <td>
                    <%if empty($planing_data[0]->schedule_qty_2)%>
                        <%$subtotal1%>
                            <%else%>
                                <%$subtotal2%>
                                    <%/if%>
                </td>
                <td><a class="btn btn-info"
                    href="<%$smarty.const.BASE_URL%>view_planing_data/<%$t->id%>">View Details</a></td>
            </tr>
            <%$i=$i+1%>
                <%else%>
                    <%if $customers_data[0]->id == $customer_id%>
                        <tr>
                            <td>
                                <%$i%>
                            </td>
                            <td>
                                <%$customer_part_data[0]->part_number%>
                            </td>
                            <td>
                                <%$customer_part_data[0]->part_description%>
                            </td>
                            <td>
                                <%$customers_data[0]->customer_name%>
                            </td>
                            <td>
                                <%$t->month%>
                            </td>
                            <td>
                                <a
                                class="btn btn-info"
                                href="<%$smarty.const.BASE_URL%>view_planing_data/<%$t->id%>">View
                                    Details</a>
                            </td>
                        </tr>
                        <%$i=$i+1%>
                            <%/if%>
                                <%/if%>
                                    <%/if%>
                                <%/foreach%>
                                    <%/if%>
                                </tbody>
                                <tfoot>
                                    <tr style="text-align:right;">
                                        <th colspan="11">Total Sales Value</th>
                                        <th><%$total1%></th>
                                        <th><%$total2%></th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
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
<!-- /.content-wrapper -->

