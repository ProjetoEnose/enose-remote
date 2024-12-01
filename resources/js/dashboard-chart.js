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
    xaxis: {
        title: {
            text: "Horários",
            style: {
                color: "#ffffff", // Título do eixo X em branco
            },
        },
        labels: {
            style: {
                fontSize: "8px",
                colors: "#ffffff", // Rótulos do eixo X em branco
            },
            step: 24, // Pula a exibição de labels a cada 4 valores
            rotate: -90, // Inclinação em graus (negativo inclina para a esquerda)
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
