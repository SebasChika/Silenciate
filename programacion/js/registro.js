let submitBtn = document.getElementById("enviar");
let pregunta = document.getElementById("pregunta");
let yaTiene = document.getElementById("yaTiene");
let negro = document.getElementById("negro");
let icons = document.getElementById("icons");
let titulo = document.getElementById("titulo");
let vinilo = document.getElementById("vinilo");
let form = document.getElementById("formulario");
let usuario = document.getElementById("usuario");
let contraseña = document.getElementById("password");
let nombre = document.getElementById("nombre");
let nombreLabel = document.getElementById("nombreLabel");
let correo = document.getElementById("correo");
let correoLabel = document.getElementById("correoLabel");
let contador = 0;
let botonGoogle = document.getElementById("google");
botonGoogle.addEventListener("click", ingresoGoogle);

yaTiene.addEventListener("click", tiene);
submitBtn.addEventListener("click", submit);

function submit(e) {
    if (!form.checkValidity()) {
        return;
    }

    e.preventDefault();

    if (contador == 0) {

        fetch("registro.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: new URLSearchParams({
                accion: "registro",
                nombre: nombre.value,
                usuario: usuario.value,
                correo: correo.value,
                password: contraseña.value
            })
        })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    irInicioSesion();
                    contador++;
                } else {
                    alert("Coloco algo ya existente");
                }
            });

    } else {
        ingresar();
    }
}

window.addEventListener("load", () => {
    if (window.google && google.accounts && google.accounts.id) {
        google.accounts.id.initialize({
            client_id: "665062572842-3mk9914losuhkirlom1o249daqpr0p90.apps.googleusercontent.com",
            callback: manejarGoogle
        });
    } else {
        console.error("Google Identity Services no se cargó");
    }
});

function ingresoGoogle() {
    google.accounts.id.renderButton(
        document.getElementById("google"),
        {
            theme: "outline",
            size: "large",
            type: "standard",
            text: "signin_with",
            shape: "rectangular"
        }
    );
}

function manejarGoogle(respuesta) {

    fetch("registro.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: new URLSearchParams({
            accion: "google",
            credential: respuesta.credential
        })
    })
    .then(res => res.json())
    .then(data => {

        console.log("RESPUESTA DEL PHP:", data);

        if (data.success) {

            negro.classList.remove("fadeIn");
            negro.classList.add("fadeOut");

            setTimeout(() => {
                window.location.href = "menu.php";
            }, 1200);

        } else {

            alert(data.mensaje || "No se pudo iniciar sesión con Google");

        }

    })
    .catch(error => {

        console.error("Error:", error);
        alert("Error al comunicarse con el servidor");

    });
}
function ingresar() {

    fetch("registro.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: new URLSearchParams({
            accion: "login",
            usuario: usuario.value,
            password: contraseña.value
        })
    })
        .then(res => res.json())
        .then(data => {

            if (data.success) {

                negro.classList.remove("fadeIn");
                negro.classList.add("fadeOut");

                setTimeout(() => {
                    window.location.href = "menu.php";
                }, 1200);

            } else {
                alert("Contraseña o usuario incorrecto");
            }

        });
}

function tiene() {
    if (contador == 0) {
        irInicioSesion();
        contador++;
    } else {
        irRegistro();
        contador = 0;
    }
}

function irRegistro() {
    nombre.required = true;
    correo.required = true;
    titulo.innerHTML = "REGISTRO";
    titulo.style.fontSize = "3.4em";
    submitBtn.innerHTML = "Registro";
    correo.style.display = "block";
    nombre.style.display = "block";
    nombreLabel.style.display = "block";
    correoLabel.style.display = "block";
    icons.style.marginTop = "0px";
    contraseña.style.fontSize = "1em";
    usuario.style.fontSize = "1em";

    pregunta.innerHTML = "¿Ya tienes una cuenta? <button id='yaTiene' type='button'>CLICK AQUI</button>";

    const nuevoBtn = document.getElementById("yaTiene");
    nuevoBtn.onclick = tiene;

    vinilo.classList.remove("girarViniloIzquierda", "irIzquierdaVinilo");
    vinilo.classList.add("volverViniloDerecha");

    form.classList.remove("formularioDerecha", "formularioIzquierda", "entrarForm");
    form.classList.add("formularioIzquierda");

    setTimeout(() => {
        vinilo.classList.remove("volverViniloDerecha");
        vinilo.classList.add("girarVinilo");
    }, 2000);
}

function irInicioSesion() {
    nombre.required = false;
    correo.required = false;
    titulo.innerHTML = "INICIO SESIÓN";
    titulo.style.fontSize = "3em";
    submitBtn.innerHTML = "Empezar";
    correo.style.display = "none";
    nombre.style.display = "none";
    nombreLabel.style.display = "none";
    correoLabel.style.display = "none";
    icons.style.marginTop = "120px";
    contraseña.style.fontSize = "1.6em";
    usuario.style.fontSize = "1.6em";

    pregunta.innerHTML = "¿No tienes una cuenta? <button id='yaTiene' type='button'>CLICK AQUI</button>";

    const nuevoBtn = document.getElementById("yaTiene");
    nuevoBtn.onclick = tiene;

    vinilo.classList.remove("girarVinilo", "volverViniloDerecha");
    vinilo.classList.add("irIzquierdaVinilo");

    form.classList.remove("formularioIzquierda", "formularioDerecha", "entrarForm");
    form.classList.add("formularioDerecha");

    setTimeout(() => {
        vinilo.classList.remove("irIzquierdaVinilo");
        vinilo.classList.add("girarViniloIzquierda");
    }, 2000);
}

function inicio() {
    negro.classList.add("fadeIn");
    vinilo.classList.add("entrarVinilo");
    form.classList.add("entrarForm");

    setTimeout(() => {
        vinilo.classList.remove("entrarVinilo");
        vinilo.classList.add("girarVinilo");
    }, 2000);
}

window.addEventListener("load", inicio);