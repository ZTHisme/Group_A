$(function () {
    //get the pie chart canvas
    var cData = JSON.parse(chartdata);
    var ctx = $("#pie-chart");

    //pie chart data
    var data = {
        labels: cData.label,
        datasets: [{
            label: "Users Count",
            data: cData.data,
            backgroundColor: [
                "#FF851B",
                "#0074D9",
                "#3D9970",
                "#5C40C0",
                "#DC143C",
                "#F4A460",
                "#2E8B57",
                "#BE4ABA",
                "#001f3f",
                "#FD8083"
            ],
            borderColor: [
                "#FF851B",
                "#0074D9",
                "#3D9970",
                "#5C40C0",
                "#DC143C",
                "#F4A460",
                "#2E8B57",
                "#BE4ABA",
                "#001f3f",
                "#FD8083"
            ],
            borderWidth: [1, 1, 1, 1, 1, 1, 1]
        }]
    };

    //create Pie Chart class object
    var chart1 = new Chart(ctx, {
        type: "pie",
        data: data,
        options: {
            responsive: true
        }
    });

    //get the bar chart canvas
    var cBarData = JSON.parse(barchartdata);
    var barctx = $("#bar-chart");

    //bar chart data
    var data = {
        labels: cBarData.label,
        datasets: [{
            label: "Total Leave Person",
            data: cBarData.data,
            backgroundColor: "#0074D9",
            borderColor: "#0074D9",
            borderWidth: 1
        }]
    };
    //create bar Chart class object
    var chart2 = new Chart(barctx, {
        type: "bar",
        data: data,
        options: {
            responsive: true,
            scales: {
                yAxes: [{
                    ticks: {
                        min: 0,
                        maxTicksLimit: 10
                    },
                    gridLines: {
                        display: true
                    },
                    stacked: true,
                }]
            }
        }
    });
});
