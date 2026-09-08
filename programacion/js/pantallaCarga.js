let principal = document.getElementById("all");
let mensaje = document.getElementById("mensaje");
let cambiador = document.getElementById("xtra");
let porcentaje = document.getElementById("porcentaje");
let actual;
let contador = 0;
let i = 0;
const palabras = [
    "Sonidos",
    "Ruidos",
    "Ondas",
    "Audios",
    "Tonos",
    "Ecos",
    "Voces",
    "Datos",
    "Niveles"
];

function iniciar() {
    principal.classList.add("inAll");
    setTimeout(() => {
        principal.classList.remove("inAll");
        principal.classList.add("subirAll");
        mensaje.classList.add("subirMensaje");
        all.classList.add("rotando");
        cambiarMensajes();
        porcentaje.classList.add("subirPor");
        subirPorcentaje();
    }, 5500)
}

function subirPorcentaje() {
    if (contador <= 100) {
        porcentaje.innerHTML = (contador + "%");
        contador++;
        setTimeout(() => {
            subirPorcentaje();
        }, 100)
    } else {
        window.location.href = "registro.php";
    }


}

function cambiarMensajes() {
    cambiador.innerHTML = palabras[i];
    cambiador.classList.remove("salir")
    cambiador.classList.add("entrar")
    setTimeout(() => {
        cambiador.classList.remove("entrar")
        cambiador.classList.add("salir")
        setTimeout(() => {
            i++;
            cambiarMensajes();
        }, 1000)
    }, 1000)


}

window.addEventListener("load", iniciar);