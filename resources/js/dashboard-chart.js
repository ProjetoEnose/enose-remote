import ApexCharts from "apexcharts";

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
            opacity: 1,
        },
        zoom: {
            enabled: false,
        },
        toolbar: {
            show: false,
        },
    },
    colors: ["#77B6EA", "#00FF00"], // Azul e verde
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
        offsetY: 0, // Ajuste para verificar se a legenda aparece
        offsetX: -5,
        labels: {
            colors: "#fff",
        },
    },
};

var chart = new ApexCharts(document.querySelector("#chart"), options);
chart.render();
