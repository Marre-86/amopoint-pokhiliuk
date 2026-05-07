document.addEventListener('DOMContentLoaded', function() {
    if (typeof ApexCharts === 'undefined') {
        console.error('ApexCharts library is not loaded. Please include it via CDN.');
        return;
    }

    // Line Chart - Hourly Visits (last 24 hours)
    let lineChartData = window.chartData?.lineChart?.data || [];
    let lineChartLabels = window.chartData?.lineChart?.labels || [];
    
    // If no data is available, show empty chart with message
    if (lineChartData.length === 0 || lineChartLabels.length === 0) {
        console.warn('No chart data available from backend');
        lineChartData = [0];
        lineChartLabels = ['Нет данных'];
    }
    
    const lineOptions = {
        series: [{
            name: "Посещения",
            data: lineChartData
        }],
        chart: {
            height: 300,
            type: 'line',
            zoom: {
                enabled: false
            },
            toolbar: {
                show: false
            }
        },
        colors: ['#3b82f6'],
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'smooth',
            width: 3
        },
        grid: {
            borderColor: '#e7e7e7',
            row: {
                colors: ['#f3f3f3', 'transparent'],
                opacity: 0.5
            }
        },
        xaxis: {
            type: 'category',
            categories: lineChartLabels,
            labels: {
                style: {
                    colors: '#6b7280'
                },
                formatter: function(value) {
                    return value;
                },
            },
        },
        yaxis: {
            title: {
                text: 'Количество посещений',
                style: {
                    color: '#6b7280',
                    fontSize: '12px'
                }
            },
            labels: {
                style: {
                    colors: '#6b7280'
                }
            },
            min: 0,
            forceNiceScale: true
        },
        tooltip: {
            x: {
                formatter: function(val) {
                    // val should be the category label, but if it's an index, get the label from categories array
                    let label = val;
                    if (typeof val === 'number' && lineChartLabels && lineChartLabels[val]) {
                        label = lineChartLabels[val];
                    }
                    return 'Час: ' + label;
                }
            },
            y: {
                formatter: function (val) {
                    return val + " посещений"
                }
            }
        }
    };

    // Pie Chart - City Distribution
    let pieChartData = window.chartData?.pieChart?.data || [];
    let pieChartLabels = window.chartData?.pieChart?.labels || [];
    
    // If no data is available, show empty chart with message
    if (pieChartData.length === 0 || pieChartLabels.length === 0) {
        console.warn('No pie chart data available from backend');
        pieChartData = [1];
        pieChartLabels = ['Нет данных'];
    }
    
    // Generate colors dynamically based on number of cities
    const generateColors = (count) => {
        const baseColors = ['#10b981', '#3b82f6', '#f59e0b', '#8b5cf6', '#ef4444', '#ec4899', '#14b8a6', '#f97316', '#8b5cf6', '#06b6d4'];
        if (count <= baseColors.length) {
            return baseColors.slice(0, count);
        }
        // Generate additional colors if needed
        const colors = [...baseColors];
        for (let i = baseColors.length; i < count; i++) {
            const hue = (i * 137.508) % 360; // Golden angle approximation
            colors.push(`hsl(${hue}, 70%, 60%)`);
        }
        return colors;
    };
    
    const pieOptions = {
        series: pieChartData,
        chart: {
            type: 'pie',
            height: 300
        },
        labels: pieChartLabels,
        colors: generateColors(pieChartData.length),
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                    width: 200
                },
                legend: {
                    position: 'bottom'
                }
            }
        }],
        legend: {
            position: 'bottom',
            labels: {
                colors: '#6b7280'
            }
        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return val + " посещений"
                }
            }
        }
    };

    // Initialize charts if containers exist
    let lineChart = null;
    let pieChart = null;

    const lineChartElement = document.querySelector("#chart-line");
    const pieChartElement = document.querySelector("#chart-pie");

    if (lineChartElement) {
        lineChart = new ApexCharts(lineChartElement, lineOptions);
        lineChart.render();
    }

    if (pieChartElement) {
        pieChart = new ApexCharts(pieChartElement, pieOptions);
        pieChart.render();
    }

});