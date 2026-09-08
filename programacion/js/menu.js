let navBarBtn = document.getElementById("navBar");
navBarBtn.addEventListener("click", abrirMenú);
let logo = document.getElementById("logo");
let empieza = document.getElementById("empieza");
let semiCiculo = document.getElementById("semiCiculo");
let buttons = document.getElementById("buttons");
let ncia = document.getElementById("ncia");
let perfil = document.getElementById("perfil");
perfil.addEventListener("click", irPerfil);
let creditos = document.getElementById("Creditos");
creditos.addEventListener("click", irCreditos);
let historial = document.getElementById("historialSemanal");
historial.addEventListener("click", irHistorial);
let analisis = document.getElementById("analisis");
analisis.addEventListener("click", irAnalisis);
let silenciate = document.getElementById("silenciate");
empieza.addEventListener("click", tabla);
let estadisticas = document.getElementById("estadisticas");
estadisticas.addEventListener("click", irEstadisticas);
let dos = document.getElementById("dos");
let path2 = document.getElementById("path2");
let tres = document.getElementById("tres");
let uno = document.getElementById("all");
let navBar = document.getElementById("navBar");
let btnAcercaDe = document.getElementById("acercaDe");
btnAcercaDe.addEventListener("click", irAcerca);
let linea1 = document.getElementById("path3");
let linea3 = document.getElementById("path1");
let btnAgendaSonora = document.getElementById("AgendaSonora");
btnAgendaSonora.addEventListener("click", irAgendaSonora)
let negro = document.getElementById("negro");
let menuDesplegable = document.getElementById("menúDesplegable");
let contador = 0;

function tabla() {
    window.location.href = "analisis.php";
}

function irEstadisticas() {
    window.location.href = "estadisticas.php";
}

function irHistorial() {
    window.location.href = "historialSemanal.php";
}

function irCreditos() {
    window.location.href = "creditos.php";
}

function irAnalisis() {
    window.location.href = "analisis.php";

}

function irAcerca() {
    window.location.href = "acercaDe.php"
}

function irPerfil() {
    window.location.href = "perfil.php"
}

function irAgendaSonora() {
    linea1.style.transform = "rotate(0deg) translateY(0px) translateX(0px) scaleX(1)";
    linea3.style.transform = "rotate(0deg) translateY(0px) translateX(0px) scaleX(1)";
    negro.style.opacity = 0;
    negro.style.transition = "all 1s cubic-bezier(0.215, 0.610, 0.355, 1);"
    negro.style.zIndex = "9999";
    menuDesplegable.style.opacity = "0";
    menuDesplegable.style.pointerEvents = "all";
    menuDesplegable.style.left = "-60px";
    logo.style.opacity = "1";
    setTimeout(() => {
        window.location.href = "agendasonora.php";
    }, 500);
}

function abrirMenú() {
    if (contador == 0) {
        linea1.style.transform = "rotate(-45deg) translateY(5px) translateX(-2px) scaleX(1.3)";
        linea3.style.transform = "rotate(45deg) translateY(-6px) translateX(-2px) scaleX(1.3)";
        path2.style.opacity = "0";
        negro.style.opacity = 0.5;
        menuDesplegable.style.opacity = "1";
        menuDesplegable.style.pointerEvents = "all";
        menuDesplegable.style.transform = "translateX(0px)";
        logo.style.opacity = "0";
        setTimeout(() => {
            contador++;
        }, 100);
        contador++;
    } else {
        linea1.style.transform = "rotate(0deg) translateY(0px) translateX(0px) scaleX(1)";
        linea3.style.transform = "rotate(0deg) translateY(0px) translateX(0px) scaleX(1)";
        path2.style.opacity = "1";
        negro.style.opacity = 0;
        menuDesplegable.style.opacity = "0";
        menuDesplegable.style.pointerEvents = "all";
        menuDesplegable.style.transform = "translateX(-150px)";
        logo.style.opacity = "1";
        setTimeout(() => {
            contador = 0;
        }, 100);
    }
}

function reset() {
    window.location.href = "menu.php";
}

ScrollReveal().reveal('.item', {
    delay: 305,
    duration: 500,
    reset: true
});

const lenis = new Lenis({
    lerp: 0.07,
    smoothWheel: true
});

function raf(time) {
    lenis.raf(time);
    requestAnimationFrame(raf);
}

requestAnimationFrame(raf);

function subirArriba() {
    lenis.scrollTo(0, { immediate: true });
    requestAnimationFrame(() => {
        lenis.scrollTo(0, { immediate: true });
    });
}

function iniciar() {
    subirArriba();
    negro.style.opacity = "0";
    setTimeout(() => {
        menuDesplegable.style.zIndex = "101";
        navBar.style.zIndex = "102";
        semiCiculo.classList.add("aparecer");
        silenciate.classList.add("unir");
        ncia.classList.add("unirr");
    }, 100);
}



window.addEventListener("load", iniciar);