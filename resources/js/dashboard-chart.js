import ApexCharts from "apexcharts";

var options = {
    series: [
        {
            data: [34, 44, 54, 21, 12, 43, 33, 23, 66, 66, 58],
        },
    ],
    chart: {
        type: "line",
        height: 350,
    },
    xaxis: {
        categories: ["seg", "ter", "qua", "qui", "sex", "sáb", "dom"],

        min: 1,
        max: 7,

        labels: {
            style: {
                fontSize: "12px",
                colors: "#ffffff", // Cor dos rótulos do eixo X
            },
        },
    },
    yaxis: {
        categories: [
            "0%",
            "10%",
            "20%",
            "30%",
            "40%",
            "50%",
            "60%",
            "70%",
            "80%",
            "90%",
            "100%",
        ],

        min: 0,
        max: 100,
        tickAmount: 10, // Define que o eixo Y será dividido em 10 partes iguais

        labels: {
            style: {
                fontSize: "12px",
                colors: "#ffffff", // Cor dos rótulos do eixo X
            },
            formatter: function (value) {
                return value + "%"; // Adiciona o símbolo de porcentagem aos valores
            },
        },
    },
    stroke: {
        curve: "stepline",
    },
    dataLabels: {
        enabled: false,
    },
    title: {
        text: "Níveis dos sensores",
        align: "left",
        style: {
            color: "#fafafa",
            fontSize: "12px",
        },
    },
    tooltip: {
        theme: "dark",
    },
    markers: {
        hover: {
            sizeOffset: 4,
        },
    },
};

var chart = new ApexCharts(document.querySelector("#chart"), options);
chart.render();
