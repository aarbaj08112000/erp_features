<div class="wrapper container-xxl flex-grow-1 container-p-y">


<nav aria-label="breadcrumb">
<div class="sub-header-left pull-left breadcrumb">
  <h1>
    Reports
    <a hijacked="yes" href="#stock/issue_request/index" class="backlisting-link" title="Back to Issue Request Listing" >
      <i class="ti ti-chevrons-right" ></i>
      <em >SALES VALUE IN RS</em></a>
  </h1>
  <br>
  <span> SALES VALUE IN RS</span>
</div>
</nav>

    <div class="content-wrapper">
        <section class="content">
            <div class="">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h1>SALES VALUE IN RS</h1>
                            </div>
                            <div class="card-body">
                                <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                                <script type="text/javascript">
                                    google.charts.load('current', {'packages': ['bar']});
                                    google.charts.setOnLoadCallback(drawStuff);

                                    function drawStuff() {
                                        let series = <%$series%>;
                                        series = series.map(item => [item[0], parseFloat(item[1])]);
                                        var data = new google.visualization.arrayToDataTable([
                                            ['Move', 'Sales Value'],
                                            ...series  // Spread the series array into the data table
                                        ]);

                                        var options = {
                                            width: 800,
                                            legend: { position: 'none' },
                                            chart: { title: 'Sales Value' },
                                            axes: { x: { 0: { side: ' Rs', label: 'Sales Values In Rs' } } },
                                            bar: { groupWidth: "90%" }
                                        };

                                        var chart = new google.charts.Bar(document.getElementById('top_x_div'));
                                        chart.draw(data, google.charts.Bar.convertOptions(options));
                                    }
                                </script>
                                <div id="top_x_div" style="width: 800px; height: 600px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
