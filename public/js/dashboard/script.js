
$( document ).ready(function() {
    
     dashbord.init();
});



var dashbord = {
  init: function(){
    this.initiatePluggin()
  },
  initiatePluggin: function(){
    this.PieChart();
    this.barChart();
    this.semiCircleDonut();
    this.singleBarChart()
  },
  PieChart:function(){
     Highcharts.chart('sale-pie-chart', {
          chart: {
              type: 'pie'
          },
          title: {
              text: '',
              align: 'left'
          },
          subtitle: {
              text: '',
              align: 'left'
          },

          accessibility: {
              announceNewData: {
                  enabled: true
              },
              point: {
                  valueSuffix: '%'
              }
          },

          plotOptions: {
              series: {
                  borderRadius: 5,
                  dataLabels: [{
                      enabled: true,
                      distance: 15,
                      format: '{point.name}'
                  }, {
                      enabled: true,
                      distance: '-30%',
                      filter: {
                          property: 'percentage',
                          operator: '>',
                          value: 5
                      },
                      format: '{point.y:.1f}%',
                      style: {
                          fontSize: '0.9em',
                          textOutline: 'none'
                      }
                  }]
              }
          },

          tooltip: {
              headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
              pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
          },

          series: [
              {
                  name: 'Browsers',
                  colorByPoint: true,
                  data: [
                      {
                          name: 'Chrome',
                          y: 61.04,
                          drilldown: 'Chrome'
                      },
                      {
                          name: 'Safari',
                          y: 9.47,
                          drilldown: 'Safari'
                      },
                      {
                          name: 'Edge',
                          y: 9.32,
                          drilldown: 'Edge'
                      },
                      {
                          name: 'Firefox',
                          y: 8.15,
                          drilldown: 'Firefox'
                      },
                      {
                          name: 'Other',
                          y: 11.02,
                          drilldown: null
                      }
                  ],
                  showInLegend: true
              },
          ],
          drilldown: {
              series: [
                  {
                      name: 'Chrome',
                      id: 'Chrome',
                      data: [
                          [
                              'v97.0',
                              36.89
                          ],
                          [
                              'v96.0',
                              18.16
                          ],
                          [
                              'v95.0',
                              0.54
                          ],
                          [
                              'v94.0',
                              0.7
                          ],
                          [
                              'v93.0',
                              0.8
                          ],
                          [
                              'v92.0',
                              0.41
                          ],
                          [
                              'v91.0',
                              0.31
                          ],
                          [
                              'v90.0',
                              0.13
                          ],
                          [
                              'v89.0',
                              0.14
                          ],
                          [
                              'v88.0',
                              0.1
                          ],
                          [
                              'v87.0',
                              0.35
                          ],
                          [
                              'v86.0',
                              0.17
                          ],
                          [
                              'v85.0',
                              0.18
                          ],
                          [
                              'v84.0',
                              0.17
                          ],
                          [
                              'v83.0',
                              0.21
                          ],
                          [
                              'v81.0',
                              0.1
                          ],
                          [
                              'v80.0',
                              0.16
                          ],
                          [
                              'v79.0',
                              0.43
                          ],
                          [
                              'v78.0',
                              0.11
                          ],
                          [
                              'v76.0',
                              0.16
                          ],
                          [
                              'v75.0',
                              0.15
                          ],
                          [
                              'v72.0',
                              0.14
                          ],
                          [
                              'v70.0',
                              0.11
                          ],
                          [
                              'v69.0',
                              0.13
                          ],
                          [
                              'v56.0',
                              0.12
                          ],
                          [
                              'v49.0',
                              0.17
                          ]
                      ]
                  },
                  {
                      name: 'Safari',
                      id: 'Safari',
                      data: [
                          [
                              'v15.3',
                              0.1
                          ],
                          [
                              'v15.2',
                              2.01
                          ],
                          [
                              'v15.1',
                              2.29
                          ],
                          [
                              'v15.0',
                              0.49
                          ],
                          [
                              'v14.1',
                              2.48
                          ],
                          [
                              'v14.0',
                              0.64
                          ],
                          [
                              'v13.1',
                              1.17
                          ],
                          [
                              'v13.0',
                              0.13
                          ],
                          [
                              'v12.1',
                              0.16
                          ]
                      ]
                  },
                  {
                      name: 'Edge',
                      id: 'Edge',
                      data: [
                          [
                              'v97',
                              6.62
                          ],
                          [
                              'v96',
                              2.55
                          ],
                          [
                              'v95',
                              0.15
                          ]
                      ]
                  },
                  {
                      name: 'Firefox',
                      id: 'Firefox',
                      data: [
                          [
                              'v96.0',
                              4.17
                          ],
                          [
                              'v95.0',
                              3.33
                          ],
                          [
                              'v94.0',
                              0.11
                          ],
                          [
                              'v91.0',
                              0.23
                          ],
                          [
                              'v78.0',
                              0.16
                          ],
                          [
                              'v52.0',
                              0.15
                          ]
                      ]
                  }
              ]
          }
      });
  },
  barChart: function(){
    Highcharts.chart('bar-chart', {
        chart: {
            type: 'column'
        },
        title: {
            align: 'left',
            text: ''
        },
        subtitle: {
            align: 'left',
            text: ''
        },
        accessibility: {
            announceNewData: {
                enabled: true
            }
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            title: {
                text: 'Total percent market share'
            }

        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.1f}%'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
        },

        series: [
            {
                name: 'Browsers',
                colorByPoint: true,
                data: [
                    {
                        name: 'Chrome',
                        y: 63.06,
                        drilldown: 'Chrome'
                    },
                    {
                        name: 'Safari',
                        y: 19.84,
                        drilldown: 'Safari'
                    },
                    {
                        name: 'Firefox',
                        y: 4.18,
                        drilldown: 'Firefox'
                    },
                    {
                        name: 'Edge',
                        y: 4.12,
                        drilldown: 'Edge'
                    },
                    {
                        name: 'Opera',
                        y: 2.33,
                        drilldown: 'Opera'
                    },
                    {
                        name: 'Internet Explorer',
                        y: 0.45,
                        drilldown: 'Internet Explorer'
                    },
                    {
                        name: 'Other',
                        y: 1.582,
                        drilldown: null
                    }
                ]
            }
        ],
        drilldown: {
            breadcrumbs: {
                position: {
                    align: 'right'
                }
            },
            series: [
                {
                    name: 'Chrome',
                    id: 'Chrome',
                    data: [
                        [
                            'v65.0',
                            0.1
                        ],
                        [
                            'v64.0',
                            1.3
                        ],
                        [
                            'v63.0',
                            53.02
                        ],
                        [
                            'v62.0',
                            1.4
                        ],
                        [
                            'v61.0',
                            0.88
                        ],
                        [
                            'v60.0',
                            0.56
                        ],
                        [
                            'v59.0',
                            0.45
                        ],
                        [
                            'v58.0',
                            0.49
                        ],
                        [
                            'v57.0',
                            0.32
                        ],
                        [
                            'v56.0',
                            0.29
                        ],
                        [
                            'v55.0',
                            0.79
                        ],
                        [
                            'v54.0',
                            0.18
                        ],
                        [
                            'v51.0',
                            0.13
                        ],
                        [
                            'v49.0',
                            2.16
                        ],
                        [
                            'v48.0',
                            0.13
                        ],
                        [
                            'v47.0',
                            0.11
                        ],
                        [
                            'v43.0',
                            0.17
                        ],
                        [
                            'v29.0',
                            0.26
                        ]
                    ]
                },
                {
                    name: 'Firefox',
                    id: 'Firefox',
                    data: [
                        [
                            'v58.0',
                            1.02
                        ],
                        [
                            'v57.0',
                            7.36
                        ],
                        [
                            'v56.0',
                            0.35
                        ],
                        [
                            'v55.0',
                            0.11
                        ],
                        [
                            'v54.0',
                            0.1
                        ],
                        [
                            'v52.0',
                            0.95
                        ],
                        [
                            'v51.0',
                            0.15
                        ],
                        [
                            'v50.0',
                            0.1
                        ],
                        [
                            'v48.0',
                            0.31
                        ],
                        [
                            'v47.0',
                            0.12
                        ]
                    ]
                },
                {
                    name: 'Internet Explorer',
                    id: 'Internet Explorer',
                    data: [
                        [
                            'v11.0',
                            6.2
                        ],
                        [
                            'v10.0',
                            0.29
                        ],
                        [
                            'v9.0',
                            0.27
                        ],
                        [
                            'v8.0',
                            0.47
                        ]
                    ]
                },
                {
                    name: 'Safari',
                    id: 'Safari',
                    data: [
                        [
                            'v11.0',
                            3.39
                        ],
                        [
                            'v10.1',
                            0.96
                        ],
                        [
                            'v10.0',
                            0.36
                        ],
                        [
                            'v9.1',
                            0.54
                        ],
                        [
                            'v9.0',
                            0.13
                        ],
                        [
                            'v5.1',
                            0.2
                        ]
                    ]
                },
                {
                    name: 'Edge',
                    id: 'Edge',
                    data: [
                        [
                            'v16',
                            2.6
                        ],
                        [
                            'v15',
                            0.92
                        ],
                        [
                            'v14',
                            0.4
                        ],
                        [
                            'v13',
                            0.1
                        ]
                    ]
                },
                {
                    name: 'Opera',
                    id: 'Opera',
                    data: [
                        [
                            'v50.0',
                            0.96
                        ],
                        [
                            'v49.0',
                            0.82
                        ],
                        [
                            'v12.1',
                            0.14
                        ]
                    ]
                }
            ]
        }
    });
  },
  semiCircleDonut: function(){
      Highcharts.chart('semi-circle-donut', {
          chart: {
              plotBackgroundColor: null,
              plotBorderWidth: 0,
              plotShadow: false
          },
          title: {
              text: '',
              align: 'center',
              verticalAlign: 'middle',
              y: 60,
              style: {
                  fontSize: ''
              }
          },
          tooltip: {
              pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
          },
          tooltip: { enabled: false },
          accessibility: {
              point: {
                  valueSuffix: '%'
              }
          },
          plotOptions: {
              pie: {
                  dataLabels: {
                      enabled: false,
                      distance:   0,
                      style: {
                          fontWeight: 'bold',
                          color: 'white'
                      }
                  },
                  startAngle: -90,
                  endAngle: 90,
                  center: ['50%', '75%'],
                  size: '110%',
                  innerSize: '70%',
                   colors: ['#e4ad16', '#3F4957']
              }
          },
          series: [{
              enableMouseTracking: false,
              type: 'pie',
              name: 'Browser share',
              
              data: [
                  ['Chrome', 73.86],
                  ['Edge', 11.97]
              ]
          }]
      });
  },
  singleBarChart: function(){
    Highcharts.chart("single-bar-chart", {
          chart: {
              type: "column",
          },
          title: {
              text: "",
              align: "left",
          },
          tooltip: {
             formatter: function () {
              let number = this.y;
            return '<b>' + this.series.name + '</b>: ' + number.toLocaleString('en-US'); // Format the number to two decimal places
        }
          },
          xAxis: {
              categories: [""],
              gridLineColor: "transparent",
          },
          yAxis: {
              min: 0,
              title: {
                  text: "",
              },
              stackLabels: {
                  enabled: false,
              },
              labels: {
                  enabled: false,
              },
              gridLineColor: "transparent",
          },
          legend: {
              enabled: false,
          },

          plotOptions: {
              column: {
                  stacking: "normal",
                  dataLabels: {
                      enabled: false
                  },

              },

          },
          series: [
              
              {
                  name: "Completed",
                  data: [12000],
                  color: '#e4ad16'
              },
              {
                  name: "Pending",
                  data: [2000],
                  color: '#3F4957'
              },
          ],
      });

  }
}



