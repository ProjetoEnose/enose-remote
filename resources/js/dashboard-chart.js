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

var options = {
    series: [
        {
            name: "MQ3",
            data: mq3Percents,
        },
        {
            name: "MQ5",
            data: mq5Percents,
        },
    ],
    chart: {
        height: 400,
        type: "line",
        background: "transparent", // Removendo qualquer background
        dropShadow: {
            enabled: true,
            color: "#000",
            top: 18,
            left: 7,
            blur: 4,
            opacity: 0.2,
        },
        zoom: {
            enabled: false,
        },
        toolbar: {
            show: false,
        },
    },
    colors: ["#77B6EA", "#00FF00"], // Azul e verde
    stroke: {
        curve: "smooth",
    },
    title: {
        text: "Levantamento diário dos sensores",
        align: "left",
        style: {
            color: "#ffffff", // Título em branco
        },
    },
    grid: {
        borderColor: "#ffffff", // Cor da grade em branco
        row: {
            colors: ["transparent", "transparent"], // Sem cor de fundo para as linhas
            opacity: 0.5,
        },
    },
    markers: {
        size: 1,
    },
    xaxis: {
        categories: readingInterval, // Usando o intervalo como rótulos no eixo X
        title: {
            text: "Horários",
            style: {
                color: "#ffffff", // Título do eixo X em branco
            },
        },
        labels: {
            style: {
                fontSize: "12px",
                colors: "#ffffff", // Rótulos do eixo X em branco
            },
        },
    },
    yaxis: {
        title: {
            text: "Níveis (%)",
            style: {
                fontSize: "12px",
                color: "#ffffff", // Título do eixo Y em branco
            },
        },
        min: 0, // Definindo o valor mínimo
        max: 100, // Definindo o valor máximo
        labels: {
            style: {
                fontSize: "12px",
                colors: "#ffffff", // Rótulos do eixo Y em branco
            },
            formatter: function (value) {
                return value + "%"; // Adiciona '%' aos valores do eixo Y
            },
        },
    },
    tooltip: {
        theme: "dark",
    },
    legend: {
        position: "top",
        horizontalAlign: "right",
        floating: true,
        offsetY: -25,
        offsetX: -5,
        labels: {
            colors: "#ffffff", // Texto da legenda em branco
        },
    },
};

var chart = new ApexCharts(document.querySelector("#chart2"), options);
chart.render();
