const canvas = document.getElementById("chart");
const ctx = document.getElementById("chart").getContext("2d");

canvas.width = 400;
canvas.height = 200;

const chartData = window.chartData;
const months = Object.keys(chartData);
const values = Object.values(chartData);

const gradient = ctx.createLinearGradient(0, 0, 0, 300);
gradient.addColorStop(0, "rgba(255, 111, 15, 0.5)");
gradient.addColorStop(1, "rgba(255, 111, 15, 0)");

const verticalLinePlugin = {
    id: "verticalLine",
    afterDraw(chart, args) {
        const { ctx, chartArea } = chart;
        const event = chart._lastEvent;

        if (!event || event.type !== "mousemove" || !chartArea) return;

        const mouseX = event.x;
        const chartX = chartArea.left;
        const chartWidth = chartArea.right - chartArea.left;

        if (mouseX >= chartX && mouseX <= chartArea.right) {
            ctx.save();

            const relativeX = mouseX;

            ctx.beginPath();
            ctx.moveTo(relativeX, chartArea.top);
            ctx.lineTo(relativeX, chartArea.bottom);
            ctx.strokeStyle = "rgba(255, 111, 15, 0.7)";
            ctx.lineWidth = 1.5;
            ctx.setLineDash([5, 5]);
            ctx.stroke();

            ctx.restore();
        }
    },
};

const chart = new Chart(ctx, {
    type: "line",
    data: {
        labels: months.map((month) => month.split(" ")[0].slice(0, 3)),
        datasets: [
            {
                label: "Number of Jobs",
                data: values,
                borderColor: "#ff6f0f",
                borderWidth: 2,
                pointRadius: 0,
                pointHoverRadius: 6,
                pointBackgroundColor: "#ff6f0f",
                backgroundColor: gradient,
                fill: true,
                tension: 0.3,
            },
        ],
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        animation: {
            duration: 1000,
            easing: "easeInOutQuart",
        },
        plugins: {
            legend: {
                labels: {
                    color: "#ff6f0f",
                    font: {
                        size: 14,
                    },
                },
            },
            tooltip: {
                mode: "index",
                intersect: false,
                callbacks: {
                    title: (context) => months[context[0].dataIndex],
                    label: (context) => `Jobs: ${context.raw}`,
                },
                backgroundColor: "rgba(255, 111, 15, 0.9)",
                titleColor: "#fff",
                bodyColor: "#fff",
                borderColor: "#fff",
                borderWidth: 1,
                padding: 10,
            },
        },
        scales: {
            x: {
                grid: { display: false },
                ticks: { color: "#555", font: { size: 12 } },
            },
            y: {
                grid: { color: "rgba(200, 200, 200, 0.2)", dash: [5, 5] },
                ticks: { color: "#555", font: { size: 12 }, stepSize: 5 },
            },
        },
        hover: {
            mode: "nearest",
            intersect: false,
        },
    },
    plugins: [verticalLinePlugin],
});
