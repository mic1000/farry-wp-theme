(function($) {
    /**
     * Grid-light theme for Highcharts JS
     * @author Torstein Honsi
     */

    // Load the fonts
    Highcharts.createElement('link', {
        href: 'https://fonts.googleapis.com/css?family=Dosis:400,600',
        rel: 'stylesheet',
        type: 'text/css'
    }, null, document.getElementsByTagName('head')[0]);

    Highcharts.theme = {
        colors: ["#7cb5ec", "#f7a35c", "#90ee7e", "#7798BF", "#aaeeee", "#ff0066", "#eeaaee",
            "#55BF3B", "#DF5353", "#7798BF", "#aaeeee"
        ],
        chart: {
            backgroundColor: null,
            style: {
                fontFamily: "Dosis, sans-serif"
            }
        },
        title: {
            style: {
                fontSize: '16px',
                fontWeight: 'bold',
                textTransform: 'uppercase'
            }
        },
        tooltip: {
            borderWidth: 0,
            backgroundColor: 'rgba(219,219,216,0.8)',
            shadow: false
        },
        legend: {
            itemStyle: {
                fontWeight: 'bold',
                fontSize: '13px'
            }
        },
        xAxis: {
            gridLineWidth: 0,
            labels: {
                style: {
                    fontSize: '15px'
                }
            }
        },
        yAxis: {
            gridLineWidth: 0,
            minorTickInterval:0,
            title: {
                style: {
                    textTransform: 'uppercase'
                }
            },
            labels: {
                style: {
                    fontSize: '12px'
                }
            }
        },
        plotOptions: {
            candlestick: {
                lineColor: 'red'
            }
        },


        // General
        background2: '#F0F0EA'

    };

    // Apply the theme
    Highcharts.setOptions(Highcharts.theme);


    $('#container').highcharts({
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Tools I use'
        },
        xAxis: {
            categories: ['Adobe Photoshop cc', 'Adobe illustrator', 'Adobe After effect', 'InDesign', 'Office 360'],
            title: {
                text: false

            }
        },
        yAxis: {
            min: 0,
            labels: {
                overflow: 'justify',
            },
             title: {
                text: 'Skills in %'
            }
        },
        tooltip: {
            valueSuffix: '%'
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: false
                }
            }
        },
        credits: {
            enabled: false
        },
        series: [{
            data: [80, 80, 60, 80, 70],
            labels: {
                enabled: false
            }
        }]
    });






    $('#container2').highcharts({
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Tools I use'
        },
        xAxis: {
            categories: ['Adobe Photoshop cc', 'Adobe illustrator', 'Adobe After effect', 'InDesign', 'Office 360'],
            title: {
                text: false

            }
        },
        yAxis: {
            min: 0,
            labels: {
                overflow: 'justify',
            },
             title: {
                text: 'Skills in %'
            }
        },
        tooltip: {
            valueSuffix: '%'
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: false
                }
            }
        },
        credits: {
            enabled: false
        },
        series: [{
            data: [80, 80, 60, 80, 70],
            labels: {
                enabled: false
            }
        }]
    });


})(jQuery);
