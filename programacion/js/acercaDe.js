const tarjetas = document.querySelectorAll(".tarjeta");

let posiciones = [];
let total = tarjetas.length;

tarjetas.forEach((_, i) => {
    posiciones[i] = i;
});

let velocidad = 0.5;
let targetVelocidad = 0.002;

function animar() {

    velocidad += (targetVelocidad - velocidad) * 0.03;

    tarjetas.forEach((tarjeta, i) => {

        posiciones[i] -= velocidad;

        if (posiciones[i] < -total / 2) {
            posiciones[i] += total;
        }

        let p = posiciones[i];
        let angle = (p / total) * Math.PI * 2;
        let radius = 300;
        let x = Math.sin(angle) * radius;
        let zPos = Math.cos(angle) * radius;
        let scale = 0.55 + ((zPos + radius) / (radius * 2)) * 0.9;
        let opacity = 0.15 + ((zPos + radius) / (radius * 2)) * 0.85;
        let rotateY = -x * 0.04;
        let z = Math.floor(zPos + radius);

        tarjeta.style.transform = `
            translateX(${x}px)
            translateZ(${zPos}px)
            scale(${scale})
            rotateY(${rotateY}deg)
        `;

        tarjeta.style.opacity = opacity;
        tarjeta.style.zIndex = z;

        if (zPos > radius * 0.7) {

            tarjeta.style.filter = `
                brightness(1.1)
                saturate(1.15)
            `;
        } else {

            tarjeta.style.filter = `
                brightness(0.9)
            `;
        }
    });

    requestAnimationFrame(animar);
}

animar();

function irMenu(){
    window.location.href ="menu.php";
}