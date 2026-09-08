let cartas = document.querySelectorAll(".contenedor-carta");

let imagenesReverso = {
    "yoFront": "imagenes/creditos/sebasBack.png",
    "caceresFront": "imagenes/creditos/caceresBack.png",
    "mariangelFront": "imagenes/creditos/mariangelBack.png",
};

cartas.forEach(carta => {
    let tarjetaInterna = carta.querySelector(".front-card");
    let etiquetaImg = tarjetaInterna.querySelector("img");
    let disco = tarjetaInterna.querySelector(".disco");
    let srcOriginal = etiquetaImg.src;
    let idImagen = etiquetaImg.id;

    carta.addEventListener("mouseenter", () => {

        tarjetaInterna.classList.remove("rotarInverso");
        tarjetaInterna.classList.add("rotar");

        setTimeout(() => {
            etiquetaImg.classList.add("cambiar-imagen");
            setTimeout(() => {
                disco.style.opacity = "1";
                etiquetaImg.src = imagenesReverso[idImagen];
                etiquetaImg.style.transform = "rotateY(180deg) translateX(-60px)";
                etiquetaImg.classList.remove("cambiar-imagen");
            }, 150);
        }, 600);
    });

    carta.addEventListener("mouseleave", () => {
        tarjetaInterna.classList.remove("rotar");
        tarjetaInterna.classList.add("rotarInverso");
        setTimeout(() => {
            etiquetaImg.classList.add("cambiar-imagen");
            setTimeout(() => {
                disco.style.opacity = "0";
                etiquetaImg.src = srcOriginal;
                etiquetaImg.style.transform = "rotateY(0deg)";
                etiquetaImg.classList.remove("cambiar-imagen");
            }, 150);
        }, 600);
    });
});
