window.AppDashboardAdmin = {
    init: function (args) {
        new Vue({
            el: '#AppDashboardAdmin',
            data() {
                return {
                    graph: args.graph != undefined ? args.graph : [],
                }
            },
            created: function() {
            },
            mounted: function () {
                this.onLoad();
            },
            watch: {
            },
            computed: {
            },
            methods: {
                onLoad: function () {
                    this.onPie(this.graph.general);
                    this.onLine(this.graph.history);
                    // this.onDataTable();
                },
                onPie: function (data) {

                    am4core.ready(function() {

                        // Themes begin
                        am4core.useTheme(am4themes_animated);
                        // Themes end
                        
                        // Create chart instance
                        var chart = am4core.create("chartdivPie", am4charts.PieChart);
                        
                        // Add data
                        chart.data = data;
                        
                        // Add and configure Series
                        var pieSeries = chart.series.push(new am4charts.PieSeries());
                        pieSeries.dataFields.value = "value";
                        pieSeries.dataFields.category = "label";
                        pieSeries.slices.template.stroke = am4core.color("#fff");
                        pieSeries.slices.template.strokeOpacity = 1;
                        
                        // This creates initial animation
                        pieSeries.hiddenState.properties.opacity = 1;
                        pieSeries.hiddenState.properties.endAngle = -90;
                        pieSeries.hiddenState.properties.startAngle = -90;
                        
                        chart.hiddenState.properties.radius = am4core.percent(0);
                        chart.responsive.enabled = true;    
                    }); // end am4core.ready()
                },
                onLine: function (data) {

                    am4core.ready(function() {
                        // Use themes
                        am4core.useTheme(am4themes_animated);

                        // Create chart instance
                        var chart = am4core.create("chartdivBar", am4charts.XYChart);
                        chart.paddingRight = 20;
                        var tdata = [];

                        for (let i = 0; i < data.length; i++) {
                            let item = data[i];
                            let arr = item.label.split('-');
                            tdata.push({
                                "date": new Date(arr[0], arr[1] - 1, arr[2]),
                                "value": item.value
                            });
                        }

                        chart.data = tdata;

                        // Create axes
                        var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
                        dateAxis.renderer.minGridDistance = 50;
                        dateAxis.renderer.grid.template.location = 0.5;
                        dateAxis.startLocation = 0.5;
                        dateAxis.endLocation = 0.5;
                        // dateAxis.renderer.grid.template.disabled = true;

                        // Create value axis
                        var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                        valueAxis.min = 0;
                        // valueAxis.renderer.grid.template.disabled = true;
                        valueAxis.renderer.minGridDistance = 100;

                        // Create series
                        var series1 = chart.series.push(new am4charts.LineSeries());
                        series1.dataFields.valueY = "value";
                        series1.dataFields.dateX = "date";
                        series1.strokeWidth = 3;
                        series1.tensionX = 0.8;
                        series1.fillOpacity = 0.3;

                        var bullet = series1.bullets.push(new am4charts.Bullet());
                        bullet.fill = am4core.color("#02abde"); // tooltips grab fill from parent by default
                        bullet.tooltipText = "Convenios: [bold][/]{value}";

                        var circle = bullet.createChild(am4core.Circle);
                        circle.radius = 4;
                        circle.fill = am4core.color("#fff");
                        circle.strokeWidth = 5;

                        chart.cursor = new am4charts.XYCursor();
                        chart.cursor.xAxis = dateAxis;
                        chart.scrollbarX = new am4core.Scrollbar();
                        chart.responsive.enabled = true;    

                    }); // end am5.ready()
                },
                onDataTable: function () {
                    $('#table-convenios').DataTable({
                        language: help.dataTable.language,
                        responsive: true,
                        aLengthMenu: [
                            [10, 50, 100, 200, -1],
                            [10, 50, 100, 200, "All"]
                        ],
                        /*columnDefs: [
                            { targets: 11, className: 'all' },
                            { targets: 12, className: 'all' }
                        ],*/
                    });
                },
            }
        });
    },
}