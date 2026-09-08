let logo = document.getElementById("logo");
let personaje = document.getElementById("personaje");
let cuento = document.getElementById("cuento");
let yoBeep = document.getElementById("yoBeep");
let titulo = document.getElementById("titulo");
let realBad = document.getElementById("realBad");
let bad = document.getElementById("bad");
let good = document.getElementById("good");
let medium = document.getElementById("medium");
let negro = document.getElementById("negro");
let texto = document.getElementById("texto");
let empezarAnalisis = document.getElementById("empezarAnalisis");

let dBactual = 0;
let numeroo = 0;

yoBeep.volume = 0.8;
realBad.volume = 0.3;
bad.volume = 0.3;
good.volume = 0.3;
medium.volume = 0.3;

fetch("obtenerPromedio.php")
    .then(response => response.text())
    .then(promedio => {
        promedio = Number(promedio);

        document.getElementById("actualDb").textContent = promedio;

        dBactual = promedio;
        numeroo = promedio;
    });

empezarAnalisis.addEventListener("click", empezar);

const posiciones = [
    "0% 0%",
    "100% 0%",
    "0% 100%",
    "100% 100%"
];

let frame = 0;
let ultimoCambio = 0;

logo.addEventListener("click", irMenu);

requestAnimationFrame(animar);

function irMenu() {
    window.location.href = "menu.html";
}

function empezar() {
    empezarAnalisis.style.pointerEvents = "none";

    const array1 = [
        "Veo que tuviste un nivel de " + numeroo + " dB.",
        "Tus oidos estuvieron en un entorno muy tranquilo y agradable para escuchar.",
        "Este nivel de ruido suele encontrarse en lugares calmados donde es facil relajarse.",
        "El silencio ayuda a descansar, concentrarse y reducir el estres diario.",
        "Mantener espacios asi beneficia tu bienestar y tu salud auditiva.",
        "¡Bien hecho!"
    ];

    const array2 = [
        "Veo que tuviste un nivel de " + numeroo + " dB.",
        "Se trata de un nivel moderado de ruido bastante comun en la vida cotidiana.",
        "No representa un gran riesgo para tus oidos si no estas expuesto durante demasiado tiempo.",
        "Aun asi, es recomendable buscar momentos de tranquilidad a lo largo del dia.",
        "Dar pequeños descansos a tu audicion puede ayudarte a sentirte mas comodo.",
        "Tu salud auditiva te lo agradecera."
    ];

    const array3 = [
        "Veo que tuviste un nivel de " + numeroo + " dB.",
        "Estuviste expuesto a una cantidad considerable de ruido durante la medicion.",
        "Tus oidos pueden fatigarse si este tipo de ambiente es frecuente en tu rutina.",
        "La exposicion prolongada puede dificultar la concentracion y generar molestias.",
        "Intenta alejarte un poco de las fuentes de sonido o tomar descansos en lugares tranquilos.",
        "Un descanso puede ayudar mucho."
    ];

    const array4 = [
        "Veo que tuviste un nivel de " + numeroo + " dB.",
        "Este es un nivel alto de ruido que merece especial atencion.",
        "La exposicion frecuente a sonidos intensos puede afectar tu audicion con el tiempo.",
        "Reducir el volumen o limitar el tiempo de exposicion puede marcar una gran diferencia.",
        "Tambien puedes considerar el uso de proteccion auditiva en ambientes muy ruidosos.",
        "¡Cuida tus oidos!"
    ];

    setTimeout(() => {
        texto.classList.add("aparecerRecuadro");
    }, 1200);

    if (dBactual < 30) {
        good.play();

        setTimeout(() => {
            dialogo(array1);
            personaje.classList.add("hablar");
        }, 3200);
    }
    else if (dBactual < 60) {
        medium.play();

        setTimeout(() => {
            dialogo(array2);
            personaje.classList.add("hablar");
        }, 3200);
    }
    else if (dBactual < 85) {
        bad.play();

        setTimeout(() => {
            dialogo(array3);
            personaje.classList.add("hablar");
        }, 3200);
    }
    else {
        realBad.play();

        setTimeout(() => {
            dialogo(array4);
            personaje.classList.add("hablar");
        }, 3200);
    }

    titulo.classList.add("aparecerTexto");
    negro.classList.add("quitarNegro");
}

function animar(tiempo) {
    if (tiempo - ultimoCambio > 200) {
        personaje.style.backgroundPosition = posiciones[frame];
        frame = (frame + 1) % 4;
        ultimoCambio = tiempo;
    }

    requestAnimationFrame(animar);
}

function dialogo(textos) {
    let indice = 0;

    function siguiente() {
        escribir(textos[indice], () => {
            indice++;

            if (indice < textos.length) {
                setTimeout(siguiente, 1000);
            } else {
                end();
            }
        });
    }

    siguiente();
}

function end() {
    personaje.classList.remove("hablar");
}

function escribir(texto, alTerminar) {
    cuento.innerHTML = "";

    let i = 0;

    let intervalo = setInterval(() => {
        cuento.innerHTML += texto[i];

        if (texto[i] !== " ") {
            yoBeep.currentTime = 0;
            yoBeep.play();
        }

        i++;

        if (i >= texto.length) {
            clearInterval(intervalo);

            if (alTerminar) {
                alTerminar();
            }
        }
    }, 65);
}

function irMenu() {
    window.location.href = "menu.php";
}