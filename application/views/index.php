<div class="wrapper">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Welcome <?php echo $this->session->userdata['user_name']; ?></h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
       <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h4><?php echo $total_sales_value_month[0]->MAINSUM ? number_format($total_sales_value_month[0]->MAINSUM,2) :  0;  ?>
                                </h4>
                                <p>Total Sales Value Current Month</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="<?php echo base_url('pei_chart_sales_values_in_rs') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h4><?php echo $total_sales_value_yesterday[0]->MAINSUM ? number_format($total_sales_value_yesterday[0]->MAINSUM,2) : 0; ?>
                                </h4>
                                <p>Total Sales Value YESTERDAY</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="<?php echo base_url('pei_chart_sales_values_in_rs') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                     <div class="col-lg-3 col-6">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h4><?php echo $total_sales_value_today[0]->MAINSUM ? number_format($total_sales_value_today[0]->MAINSUM,2) : 0; ?>
                                </h4>
                                <p>Total Sales Value TODAY</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="<?php echo base_url('pei_chart_sales_values_in_rs') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
               </div>
                <div class="row">
                    Use &nbsp; <a href="<?php echo base_url('dashboard') ?>" class="small-box-footer"> DASHBOARD Menu</i></a> &nbsp; for all other details.
                </div>
            </div>
        </section>
    </div>