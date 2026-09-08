<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/menu.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="imagenes/silenciate.ico" type="image/x-icon">
    <title>Silenciate | Menú</title>
</head>

<body>
    <div id="negro"></div>


    <header>
        <button id="navBar" type="button">
            <svg viewBox="0 0 24 24">
                <path id="path1" d="M5 17H20" stroke-width="2" />
                <path id="path2" d="M5 12H25" stroke-width="2" />
                <path id="path3" d="M5 7H20" stroke-width="2" />
            </svg>
        </button>

        <div id="right">
            <img id="logo" onclick="reset()" src="imagenes/logo.png">
        </div>
    </header>

    <main>
        <div id="menúDesplegable">
            <img id="logo2" src="imagenes/logo.png">

            <div id="buttons">

                <button id="acercaDe" class="me">
                    <svg version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <style type="text/css"> </style>
                            <g>
                                <path class="st0"
                                    d="M255.992,0.008C114.626,0.008,0,114.626,0,256s114.626,255.992,255.992,255.992 C397.391,511.992,512,397.375,512,256S397.391,0.008,255.992,0.008z M300.942,373.528c-10.355,11.492-16.29,18.322-27.467,29.007 c-16.918,16.177-36.128,20.484-51.063,4.516c-21.467-22.959,1.048-92.804,1.597-95.449c4.032-18.564,12.08-55.667,12.08-55.667 s-17.387,10.644-27.709,14.419c-7.613,2.782-16.225-0.871-18.354-8.234c-1.984-6.822-0.404-11.161,3.774-15.822 c10.354-11.484,16.289-18.314,27.467-28.999c16.934-16.185,36.128-20.483,51.063-4.524c21.467,22.959,5.628,60.732,0.064,87.497 c-0.548,2.653-13.742,63.627-13.742,63.627s17.387-10.645,27.709-14.427c7.628-2.774,16.241,0.887,18.37,8.242 C306.716,364.537,305.12,368.875,300.942,373.528z M273.169,176.123c-23.886,2.096-44.934-15.564-47.031-39.467 c-2.08-23.878,15.58-44.934,39.467-47.014c23.87-2.097,44.934,15.58,47.015,39.458 C314.716,152.979,297.039,174.043,273.169,176.123z">
                                </path>
                            </g>
                        </g>
                    </svg>
                    ACERCA DE
                </button>

                <button id="Creditos" class="me">
                    <svg viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path d="M13 0H3V2H13V0Z" fill="#000000"></path>
                            <path d="M2 4H14V6H2V4Z"></path>
                            <path d="M1 8H15V15H1V8Z"></path>
                        </g>
                    </svg>
                    CREDITOS
                </button>

                <button id="AgendaSonora" class="me">
                    <svg viewBox="0 0 24 24">
                        <path
                            d="M12 8H4a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h1v4a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-4h3l5 4V4l-5 4zm9.5 4c0 1.71-.96 3.26-2.5 4V8c1.53.75 2.5 2.3 2.5 4z" />
                    </svg>
                    AGENDA
                </button>

                <button id="historialSemanal" class="me">
                    <svg viewBox="0 0 525.153 525.153">
                        <path
                            d="M139.165 51.421 103.389 15.557C43.413 61.202 3.742 132.185 0 212.402h50.174C53.916 145.992 88.051 87.766 139.165 51.421zm335.814 160.981h50.174c-3.742-80.217-43.413-151.2-103.586-196.845l-35.863 35.864c51.398 36.365 85.533 94.591 89.275 160.981zM425.592 224.984c0-77-53.391-141.463-125.424-158.487V49.408c0-20.787-16.761-37.614-37.592-37.614s-37.592 16.827-37.592 37.614v17.089C152.951 83.521 99.56 148.005 99.56 224.984v137.918l-50.152 50.108v25.076h426.336v-25.076l-50.152-50.108V224.984zM262.576 513.358c3.523 0 6.761-.219 10.065-1.007 16.236-3.238 29.824-14.529 36.06-29.627 2.516-5.952 4.048-12.494 4.048-19.54H212.402c0 27.593 22.582 50.174 50.174 50.174z" />
                    </svg>
                    HISTORIAL
                </button>

                <button id="analisis" class="me">
                    <svg viewBox="0 0 16 16">
                        <path
                            d="M3 9.5a1.5 1.5 0 110-3 1.5 1.5 0 010 3zm5 0a1.5 1.5 0 110-3 1.5 1.5 0 010 3zm5 0a1.5 1.5 0 110-3 1.5 1.5 0 010 3z" />
                    </svg>
                    ANÁLISIS
                </button>

                <button id="estadisticas" class="me">
                    <svg viewBox="0 0 1024 1024" fill="#000000" class="icon" version="1.1"
                        xmlns="http://www.w3.org/2000/svg">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path
                                d="M521.58 516.763v-472.816c250.725 22.642 450.175 222.092 472.817 472.817h-472.816zM918.229 593.091h-435.436c-21.963 0-39.769-17.805-39.769-39.769 0 0 0 0 0 0v-435.463c-222.914 20.121-397.682 207.273-397.682 435.436 0 241.605 195.898 437.452 437.451 437.451 228.163 0 415.339-174.715 435.436-397.657z">
                            </path>
                        </g>
                    </svg>
                    ESTADISTICAS
                </button>

                <button id="perfil" class="me">
                    <svg viewBox="0 0 24 24">
                        <path fill="rgba(108, 132, 182, 0.753);"
                            d="M8 13.17c4.34 0 8 .71 8 3.43C16 19.32 12.31 20 8 20S0 19.29 0 16.57c0-2.72 3.69-3.4 8-3.4zM8 0c2.94 0 5.29 2.35 5.29 5.29S10.94 10.58 8 10.58 2.71 8.23 2.71 5.29 5.06 0 8 0z" />
                    </svg>
                    PERFIL
                </button>

            </div>
        </div>

        <div id="semiCiculo">
            <h1 id="silenciate">silénciate</h1>
            <img id="imagen" src="imagenes/menu/woman.png">
            <img id="texture1" src="imagenes/registro/texture1.png">
            <h1 id="ncia">ncia</h1>
            <button id="empieza" type="button">EMPIEZA AHORA</button>
        </div>
    </main>
    <footer class="item">
        <div id="complete">
            <div id="leftt">
                <div id="enlaces">
                    <p>Navegacion</p>
                    <a href="acercaDe.php">Acerca De</a>
                    <a href="creditos.php">Creditos</a>
                    <a href="agendasonora.php">Agenda</a>
                    <a href="historialSemanal.php">Historial</a>
                    <a href="analisis.php">Analisis</a>
                    <a href="estadisticas.php">Estadisticas</a>
                    <a href="perfil.php">Perfil</a>
                </div>
            </div>
            <div id="centerrr">
                <img id="logoFooter" src="imagenes/logo.png">
                <img id="monograma" src="imagenes/monoGrama.png">
            </div>
            <div id="rightt">
                <p>Comunicate con nosotros!</p>
                <p class="thinl">3009868398</p>
                <p style="margin-bottom: 10px" class="thinl">soporte@silenciate.com</p>
                <div id="redes">
                    <svg id="linkedIn" fill="#030c1c" height="200px" width="200px" version="1.1" id="Layer_1"
                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                        viewBox="-143 145 512 512" xml:space="preserve">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path
                                d="M329,145h-432c-22.1,0-40,17.9-40,40v432c0,22.1,17.9,40,40,40h432c22.1,0,40-17.9,40-40V185C369,162.9,351.1,145,329,145z M41.4,508.1H-8.5V348.4h49.9V508.1z M15.1,328.4h-0.4c-18.1,0-29.8-12.2-29.8-27.7c0-15.8,12.1-27.7,30.5-27.7 c18.4,0,29.7,11.9,30.1,27.7C45.6,316.1,33.9,328.4,15.1,328.4z M241,508.1h-56.6v-82.6c0-21.6-8.8-36.4-28.3-36.4 c-14.9,0-23.2,10-27,19.6c-1.4,3.4-1.2,8.2-1.2,13.1v86.3H71.8c0,0,0.7-146.4,0-159.7h56.1v25.1c3.3-11,21.2-26.6,49.8-26.6 c35.5,0,63.3,23,63.3,72.4V508.1z">
                            </path>
                        </g>
                    </svg>
                    <svg id="Instagram" fill="#030c1c" height="200px" width="200px" version="1.1" id="Layer_1"
                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                        viewBox="-143 145 512 512" xml:space="preserve" stroke="#030c1c">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <g>
                                <path
                                    d="M113,446c24.8,0,45.1-20.2,45.1-45.1c0-9.8-3.2-18.9-8.5-26.3c-8.2-11.3-21.5-18.8-36.5-18.8s-28.3,7.4-36.5,18.8 c-5.3,7.4-8.5,16.5-8.5,26.3C68,425.8,88.2,446,113,446z">
                                </path>
                                <polygon points="211.4,345.9 211.4,308.1 211.4,302.5 205.8,302.5 168,302.6 168.2,346 ">
                                </polygon>
                                <path
                                    d="M329,145h-432c-22.1,0-40,17.9-40,40v432c0,22.1,17.9,40,40,40h432c22.1,0,40-17.9,40-40V185C369,162.9,351.1,145,329,145z M241,374.7v104.8c0,27.3-22.2,49.5-49.5,49.5h-157C7.2,529-15,506.8-15,479.5V374.7v-52.3c0-27.3,22.2-49.5,49.5-49.5h157 c27.3,0,49.5,22.2,49.5,49.5V374.7z">
                                </path>
                                <path
                                    d="M183,401c0,38.6-31.4,70-70,70c-38.6,0-70-31.4-70-70c0-9.3,1.9-18.2,5.2-26.3H10v104.8C10,493,21,504,34.5,504h157 c13.5,0,24.5-11,24.5-24.5V374.7h-38.2C181.2,382.8,183,391.7,183,401z">
                                </path>
                            </g>
                        </g>
                    </svg>
                </div>
            </div>
        </div>
        <p>&copy; 2026 Silenciate. Todos los derechos reservados.</p>
    </footer>
    
    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="https://unpkg.com/lenis@1.3.15/dist/lenis.min.js"></script>
    <script src="js/menu.js"></script>
</body>

</html>