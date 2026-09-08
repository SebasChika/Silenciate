function irMenu() {
    window.location.href = "menu.php";
}

let primero;
let segundo;
let tercero;
let cuarto;
let quinto;
let sexto;
let septimo;
let octavo;
let noveno;
let decimo;
let once;

primero = parseFloat(promediosGrado[1]);
segundo = parseFloat(promediosGrado[2]);
tercero = parseFloat(promediosGrado[3]);
cuarto = parseFloat(promediosGrado[4]);
quinto = parseFloat(promediosGrado[5]);
sexto = parseFloat(promediosGrado[6]);
septimo = parseFloat(promediosGrado[7]);
octavo = parseFloat(promediosGrado[8]);
noveno = parseFloat(promediosGrado[9]);
decimo = parseFloat(promediosGrado[10]);
once = parseFloat(promediosGrado[11]);

const canvas = document.getElementById("miPieChart");
const canvas2 = document.getElementById("miPieChart2");
const ctx = canvas.getContext("2d");

const gradiente1 = ctx.createLinearGradient(0, 0, 400, 400);
gradiente1.addColorStop(0, "#b8cce4");
gradiente1.addColorStop(1, "#335e7a");

const gradiente2 = ctx.createLinearGradient(0, 0, 400, 400);
gradiente2.addColorStop(0, "#6887bd");
gradiente2.addColorStop(1, "#345080");

const gradiente3 = ctx.createLinearGradient(0, 0, 400, 400);
gradiente3.addColorStop(0, "#b8cce4");
gradiente3.addColorStop(1, "#6887bd");

const gradiente4 = ctx.createLinearGradient(0, 0, 400, 400);
gradiente4.addColorStop(0, "#335e7a");
gradiente4.addColorStop(1, "#345080");

const gradiente5 = ctx.createLinearGradient(0, 0, 400, 400);
gradiente5.addColorStop(0, "#d1ddeb");
gradiente5.addColorStop(1, "#527c9c");

const gradiente6 = ctx.createLinearGradient(0, 0, 400, 400);
gradiente6.addColorStop(0, "#829dcc");
gradiente6.addColorStop(1, "#42658f");

const gradiente7 = ctx.createLinearGradient(0, 0, 400, 400);
gradiente7.addColorStop(0, "#9fb9d5");
gradiente7.addColorStop(1, "#3d6a8a");

const data = {
    labels: [
        "Octavo",
        "Noveno",
        "Decimo",
        "Once"
    ],

    datasets: [{
        data: [octavo, noveno, decimo, once],

        backgroundColor: [
            gradiente1,
            gradiente2,
            gradiente3,
            gradiente4
        ],

        borderWidth: 0,
        hoverOffset: 8
    }]
};

Chart.defaults.font.family = "normali";
Chart.defaults.color = "#F5F5F5";

const config = {
    type: "doughnut",

    data: data,

    options: {
        responsive: true,
        maintainAspectRatio: false,

        plugins: {
            legend: {
                position: "bottom",

                labels: {
                    color: "#F5F5F5",

                    font: {
                        family: "normali",
                        size: 14
                    },

                    padding: 20,
                    usePointStyle: true
                }
            },

            tooltip: {
                titleFont: {
                    family: "Arial"
                },

                bodyFont: {
                    family: "Arial"
                },

                callbacks: {
                    label: function (context) {
                        return context.label + ": " + context.raw + " dB";
                    }
                }
            }
        }
    }
};

const data2 = {
    labels: [
        "Primero",
        "Segundo",
        "Tercero",
        "Cuarto",
        "Quinto",
        "Sexto",
        "Septimo"
    ],

    datasets: [{
        data: [
            primero,
            segundo,
            tercero,
            cuarto,
            quinto,
            sexto,
            septimo
        ],

        backgroundColor: [
            gradiente1,
            gradiente2,
            gradiente3,
            gradiente4,
            gradiente5,
            gradiente6,
            gradiente7
        ],

        borderWidth: 0,
        hoverOffset: 8
    }]
};

const config2 = {
    type: "doughnut",

    data: data2,

    options: {
        responsive: true,
        maintainAspectRatio: false,

        plugins: {
            legend: {
                position: "bottom",

                labels: {
                    color: "#F5F5F5",

                    font: {
                        family: "normali",
                        size: 14
                    },

                    padding: 20,
                    usePointStyle: true
                }
            },

            tooltip: {
                titleFont: {
                    family: "Arial"
                },

                bodyFont: {
                    family: "Arial"
                },

                callbacks: {
                    label: function (context) {
                        return context.label + ": " + context.raw + " dB";
                    }
                }
            }
        }
    }
};

const dataLine = {
    labels: [
        "Primero",
        "Segundo",
        "Tercero",
        "Cuarto",
        "Quinto",
        "Sexto",
        "Séptimo",
        "Octavo",
        "Noveno",
        "Décimo",
        "Once"
    ],

    datasets: [{
        label: "Promedio de ruido",

        data: [
            primero,
            segundo,
            tercero,
            cuarto,
            quinto,
            sexto,
            septimo,
            octavo,
            noveno,
            decimo,
            once
        ],

        borderColor: "#6887bd",
        backgroundColor: "rgba(104, 135, 189, 0.2)",

        borderWidth: 3,

        pointRadius: 5,
        pointHoverRadius: 8,

        tension: 0.4,

        fill: true
    }]
};

const configLine = {
    type: "line",

    data: dataLine,

    options: {
        responsive: true,
        maintainAspectRatio: false,

        plugins: {
            legend: {
                labels: {
                    color: "#F5F5F5",

                    font: {
                        family: "normali",
                        size: 14
                    }
                }
            },

            tooltip: {
                titleFont: {
                    family: "Arial"
                },

                bodyFont: {
                    family: "Arial"
                },

                callbacks: {
                    label: function (context) {
                        return context.raw + " dB";
                    }
                }
            }
        },

        scales: {
            x: {
                ticks: {
                    color: "#F5F5F5",

                    font: {
                        family: "normali"
                    }
                },

                grid: {
                    color: "rgba(255, 255, 255, 0.08)"
                }
            },

            y: {
                beginAtZero: true,

                ticks: {
                    color: "#F5F5F5",

                    font: {
                        family: "Arial"
                    }
                },

                grid: {
                    color: "rgba(255, 255, 255, 0.08)"
                }
            }
        }
    }
};

const miLineChart = new Chart(
    document.getElementById("miLineChart"),
    configLine
);

const miPieChart = new Chart(
    document.getElementById("miPieChart"),
    config
);

const miPieChart2 = new Chart(
    document.getElementById("miPieChart2"),
    config2
);

function iniciar() {
    console.log(promediosGrado);
}

window.addEventListener("load", iniciar);
