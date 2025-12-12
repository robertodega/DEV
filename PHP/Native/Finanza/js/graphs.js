// Pie Chart
if (graphType == "Pie") {
    var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: labelsContent,
            datasets: [{
                data: dataGraph,
                backgroundColor: ['#007bff', '#dc3545', '#ffc107', '#28a745', '#7768AE', '#EFCFE3', '#E27396', '#B3DEE2', '#93FF96', '#5C2751'],
            }],
        },
    });
}

// Bar Chart
else if (graphType == "Bar") {
    var myLineChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labelsContent,
            datasets: [{
                backgroundColor: ['#007bff', '#dc3545', '#ffc107', '#28a745', '#7768AE', '#EFCFE3', '#E27396', '#B3DEE2', '#93FF96', '#5C2751'],
                data: dataGraph,
            }],
        },
        options: {
            scales: {
                xAxes: [{
                    time: {
                        unit: 'month'
                    },
                    gridLines: {
                        display: false
                    },
                    ticks: {
                        maxTicksLimit: 6
                    }
                }],
                yAxes: [{
                    ticks: {
                        min: 0,
                        max: maxDataValue,
                        maxTicksLimit: 5
                    },
                    gridLines: {
                        display: true
                    }
                }],
            },
            legend: {
                display: false
            }
        }
    });
}

// Area Chart
else if (graphType == "Area") {
    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labelsContent,
            datasets: [{
                lineTension: 0.3,
                backgroundColor: "rgba(2,117,216,0.2)",
                borderColor: "rgba(2,117,216,1)",
                pointRadius: 5,
                pointBackgroundColor: "rgba(2,117,216,1)",
                pointBorderColor: "rgba(255,255,255,0.8)",
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(2,117,216,1)",
                pointHitRadius: 50,
                pointBorderWidth: 2,
                data: dataGraph,
            }],
        },
        options: {
            scales: {
                xAxes: [{
                    time: {
                        unit: 'date'
                    },
                    gridLines: {
                        display: false
                    },
                    ticks: {
                        maxTicksLimit: 7
                    }
                }],
                yAxes: [{
                    ticks: {
                        min: 0,
                        max: maxDataValue,
                        maxTicksLimit: 5
                    },
                    gridLines: {
                        color: "rgba(0, 0, 0, .125)",
                    }
                }],
            },
            legend: {
                display: false
            }
        }
    });
}
