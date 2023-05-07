<script type="text/javascript">
    $(document).ready(function () {
        getDashboardData();

    });

    function getDashboardData() {
        $.ajax({
            type: "get",
            url: '<?= ADMINPATH ?>get-dashboard-data',
            success: function (data)
            {
                var obj = JSON.parse(data);                
                var chart2data = obj.chart2data;
                var chart3data = obj.chart3data;
                renderMixChart(chart3data.payoutdata, chart3data.businessdata, chart3data.monthdata);
                renderBarChart(chart2data.series, chart2data.lables);
            }
        });
    }
    function getChartColorsArray(r) {
        r = $(r).attr("data-colors");
        return (r = JSON.parse(r)).map(function (r) {
            r = r.replace(" ", "");
            if (-1 == r.indexOf("--"))
                return r;
            r = getComputedStyle(document.documentElement).getPropertyValue(r);
            return r || void 0;
        });
    }
    function renderBarChart(seriesdata, categories) {
        var barColors = getChartColorsArray("#bar_chart"),
                options = {
                    chart: {height: 350, type: "bar", toolbar: {show: !1}},
                    plotOptions: {bar: {horizontal: !0}},
                    dataLabels: {enabled: !1},
                    series: [{data: seriesdata}],
                    colors: barColors,
                    grid: {borderColor: "#f1f1f1"},
                    xaxis: {categories: categories},
                };
        (chart = new ApexCharts(document.querySelector("#bar_chart"), options)).render();
    }

    function renderMixChart(payoutdata, businessdata, monthdata) {
        var mixedColors = getChartColorsArray("#mixed_chart"),
                options = {
                    chart: {height: 350, type: "line", stacked: !1, toolbar: {show: !1}},
                    stroke: {width: [0, 2], curve: "smooth"},
                    plotOptions: {bar: {columnWidth: "50%"}},
                    colors: mixedColors,
                    series: [
                        {name: "Payout", type: "column", data: payoutdata},
                        {name: "Business", type: "area", data: businessdata}
                    ],
                    fill: {opacity: [0.85, 0.25], gradient: {inverseColors: !1, shade: "light", type: "vertical", opacityFrom: 0.85, opacityTo: 0.55, stops: [0, 100, 100, 100]}},
                    labels: monthdata,
                    markers: {size: 0},
                    xaxis: {type: "datetime"},
                    yaxis: {title: {text: "Rupees"}},
                    tooltip: {
                        shared: !0,
                        intersect: !1,
                        y: {
                            formatter: function (e) {
                                return void 0 !== e ? "INR " + e.toFixed(0) : e;
                            }
                        }
                    },
                    grid: {borderColor: "#f1f1f1"},
                };
        (chart = new ApexCharts(document.querySelector("#mixed_chart"), options)).render();
    }

    function renderLineChartDataLabel(fodata, rodata, lable) {
        var lineDatalabelColors = getChartColorsArray("#line_chart_datalabel"),
                options = {
                    chart: {height: 350, type: "line", zoom: {enabled: !1}, toolbar: {show: !1}},
                    colors: lineDatalabelColors,
                    dataLabels: {enabled: !1},
                    stroke: {width: [3, 3], curve: "straight"},
                    series: [
                        {name: "FO - 2023", data: fodata},
                        {name: "RO - 2023", data: rodata}
                    ],
                    title: {text: "Monthly FO Vs RO Business", align: "left", style: {fontWeight: "500"}},
                    grid: {row: {colors: ["transparent", "transparent"], opacity: 0.2}, borderColor: "#f1f1f1"},
                    markers: {style: "inverted", size: 0},
                    xaxis: {categories: lable, title: {text: "Month"}},
                    yaxis: {title: {text: "Rupees"}},
                    legend: {position: "top", horizontalAlign: "right", floating: !0, offsetY: -25, offsetX: -5},
                    responsive: [{breakpoint: 600, options: {chart: {toolbar: {show: !1}}, legend: {show: !1}}}],
                };
        (chart = new ApexCharts(document.querySelector("#line_chart_datalabel"), options)).render();
    }
    function renderPaichart(series, lables) {
        var pieColors = getChartColorsArray("#pie_chart"),
                options = {
                    chart: {height: 320, type: "pie"},
                    series: series,
                    labels: lables,
                    colors: pieColors,
                    legend: {show: 0, position: "bottom", horizontalAlign: "center", verticalAlign: "middle", floating: !1, fontSize: "14px", offsetX: 0},
                    responsive: [{breakpoint: 600, options: {chart: {height: 240}, legend: {show: !1}}}],
                };
        (chart = new ApexCharts(document.querySelector("#pie_chart"), options)).render();
    }
</script>