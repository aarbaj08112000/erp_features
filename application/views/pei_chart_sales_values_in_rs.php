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
                        <h1>Reports : SALES VALUE IN RS</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
                            <li class="breadcrumb-item active">SALES VALUE IN RS</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <!-- /.card -->

                        <div class="card">
                            <div class="card-header">
                                <h1>
                                    SALES VALUE IN RS
                                   
                                </h1>

                            </div>


                            <!-- /.card-header -->
                            <div class="card-body">

                                <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js">
                                </script>
                                <script type="text/javascript">
                                google.charts.load('current', {
                                    'packages': ['bar']
                                });
                                google.charts.setOnLoadCallback(drawStuff);

                                function drawStuff() {
                                    var data = new google.visualization.arrayToDataTable([
                                        ['Move', 'Sales Value'],
                                        <?php
                                            for ($i = 1; $i <= 12; $i++) {

                                                $month_data = $this->Common_admin_model->get_month($i);
                                                $month_number = $this->Common_admin_model->get_month_number($month_data);

                                                /* $main_sum = $this->db->query(
                                                    'SELECT SUM(total_rate) as MAINSUM FROM `sales_parts` WHERE created_month = ' . $month_number . ' AND created_year = ' . $selected_year . ''
												);
												*/
												
												
												$main_sum = $this->db->query('SELECT SUM(parts.total_rate) as MAINSUM FROM `sales_parts` as parts,`new_sales` as sales WHERE sales.id = parts.sales_id AND sales.status = \'lock\' AND parts.created_month = ' . $month_number . ' AND parts.created_year = "' . $selected_year . '" ');
												
												
                                                $main_sum_result = $main_sum->result();
                                                $month_value = 0;
                                                $month_value = $main_sum_result[0]->MAINSUM ? $main_sum_result[0]->MAINSUM : 0;
                                                // echo $month_data . "<br>";
                                                echo "['" . $month_data . "'," . $month_value . "],";
                                            }
                                            ?>
                                    ]);

                                    var options = {
                                        width: 800,
                                        legend: {
                                            position: 'none'
                                        },
                                        chart: {
                                            title: 'Sales Value',
                                            // subtitle: 'popularity by percentage'
                                        },
                                        axes: {
                                            x: {
                                                0: {
                                                    side: ' Rs',
                                                    label: 'Sales Values In Rs'
                                                } // Top x-axis.
                                            }
                                        },
                                        bar: {
                                            groupWidth: "90%"
                                        }
                                    };

                                    var chart = new google.charts.Bar(document.getElementById('top_x_div'));
                                    // Convert the Classic options to Material options.
                                    chart.draw(data, google.charts.Bar.convertOptions(options));
                                };
                                </script>


                                <div id="top_x_div" style="width: 800px; height: 600px;"></div>




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