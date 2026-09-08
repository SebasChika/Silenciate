<?php

$conexion = mysqli_connect("localhost", "root", "", "silenciatedb");

if (!$conexion) {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        header("Content-Type: application/json");
        echo json_encode([
            "success" => false,
            "mensaje" => "Error de conexión con la base de datos"
        ]);
        exit;
    }

    die("Error de conexión con la base de datos");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    header("Content-Type: application/json");

    $accion = $_POST["accion"] ?? "";

    if ($accion === "registro") {

        $nombre = $_POST["nombre"] ?? "";
        $usuario = $_POST["usuario"] ?? "";
        $correo = $_POST["correo"] ?? "";
        $password = $_POST["password"] ?? "";

        $stmt = mysqli_prepare(
            $conexion,
            "INSERT INTO registro (nombre, usuario, email, contrasena, rol) VALUES (?, ?, ?, ?, 'usuario')"
        );

        mysqli_stmt_bind_param(
            $stmt,
            "ssss",
            $nombre,
            $usuario,
            $correo,
            $password
        );

        if (mysqli_stmt_execute($stmt)) {
            echo json_encode([
                "success" => true
            ]);
        } else {
            echo json_encode([
                "success" => false,
                "mensaje" => "No se pudo registrar el usuario"
            ]);
        }

        exit;
    }

    if ($accion === "login") {

        $usuario = $_POST["usuario"] ?? "";
        $password = $_POST["password"] ?? "";

        $stmt = mysqli_prepare(
            $conexion,
            "SELECT * FROM registro WHERE usuario = ? AND contrasena = ?"
        );

        mysqli_stmt_bind_param(
            $stmt,
            "ss",
            $usuario,
            $password
        );

        mysqli_stmt_execute($stmt);

        $resultado = mysqli_stmt_get_result($stmt);

        echo json_encode([
            "success" => mysqli_num_rows($resultado) > 0
        ]);

        exit;
    }

    if ($accion === "google") {

        $credential = $_POST["credential"] ?? "";

        if ($credential === "") {
            echo json_encode([
                "success" => false,
                "mensaje" => "No se recibió el credential de Google"
            ]);
            exit;
        }

        $url = "https://oauth2.googleapis.com/tokeninfo?id_token=" . urlencode($credential);

        $respuesta = file_get_contents($url);

        if ($respuesta === false) {
            echo json_encode([
                "success" => false,
                "mensaje" => "No se pudo verificar el token con Google"
            ]);
            exit;
        }

        $datosGoogle = json_decode($respuesta, true);

        if (!isset($datosGoogle["email"])) {
            echo json_encode([
                "success" => false,
                "mensaje" => "El token de Google no es válido"
            ]);
            exit;
        }

        $client_id = "665062572842-3mk9914losuhkirlom1o249daqpr0p90.apps.googleusercontent.com";

        if (($datosGoogle["aud"] ?? "") !== $client_id) {
            echo json_encode([
                "success" => false,
                "mensaje" => "El token no pertenece a esta aplicación"
            ]);
            exit;
        }

        if (($datosGoogle["email_verified"] ?? "") !== "true") {
            echo json_encode([
                "success" => false,
                "mensaje" => "El correo de Google no está verificado"
            ]);
            exit;
        }

        $nombre = $datosGoogle["name"] ?? "Usuario Google";
        $correo = $datosGoogle["email"];

        $stmt = mysqli_prepare(
            $conexion,
            "SELECT id, nombre, usuario, email, rol FROM registro WHERE email = ?"
        );

        mysqli_stmt_bind_param($stmt, "s", $correo);
        mysqli_stmt_execute($stmt);

        $resultado = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($resultado) > 0) {

            $usuarioExistente = mysqli_fetch_assoc($resultado);

            echo json_encode([
                "success" => true,
                "nuevo" => false,
                "usuario" => $usuarioExistente
            ]);

            exit;
        }

        $baseUsuario = strtolower(explode("@", $correo)[0]);
        $usuario = $baseUsuario;
        $contadorUsuario = 1;

        while (true) {

            $stmt = mysqli_prepare(
                $conexion,
                "SELECT id FROM registro WHERE usuario = ?"
            );

            mysqli_stmt_bind_param($stmt, "s", $usuario);
            mysqli_stmt_execute($stmt);

            $resultadoUsuario = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($resultadoUsuario) === 0) {
                break;
            }

            $usuario = $baseUsuario . $contadorUsuario;
            $contadorUsuario++;
        }

        $passwordGoogle = password_hash(
            bin2hex(random_bytes(32)),
            PASSWORD_DEFAULT
        );

        $stmt = mysqli_prepare(
            $conexion,
            "INSERT INTO registro (nombre, usuario, email, contrasena, rol) VALUES (?, ?, ?, ?, 'usuario')"
        );

        mysqli_stmt_bind_param(
            $stmt,
            "ssss",
            $nombre,
            $usuario,
            $correo,
            $passwordGoogle
        );

        if (mysqli_stmt_execute($stmt)) {

            $id = mysqli_insert_id($conexion);

            echo json_encode([
                "success" => true,
                "nuevo" => true,
                "usuario" => [
                    "id" => $id,
                    "nombre" => $nombre,
                    "usuario" => $usuario,
                    "email" => $correo,
                    "rol" => "usuario"
                ]
            ]);

        } else {

            echo json_encode([
                "success" => false,
                "mensaje" => "No se pudo guardar el usuario"
            ]);
        }

        exit;
    }

    echo json_encode([
        "success" => false,
        "mensaje" => "Acción no válida"
    ]);

    exit;
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/registro.css">
    <link rel="shortcut icon" href="imagenes/silenciate.ico" type="image/x-icon">
    <title>Silenciate | Empezar</title>
</head>

<body>

    <div id="negro"></div>

    <main>

        <div id="center">

            <img id="vinilo" src="imagenes/registro/vinilo.png">

            <form id="formulario">

                <img id="texture1" src="imagenes/registro/texture1.png">
                <img id="texture2" src="imagenes/registro/texture2.jpg">
                <img id="reloj" src="imagenes/registro/decoback.jpg">

                <h1 id="titulo">REGISTRO</h1>

                <label id="nombreLabel" for="nombre">Nombre</label>
                <input autocomplete="off" required id="nombre" type="text" placeholder="nombre">

                <label for="usuario">Usuario</label>
                <input autocomplete="off" required id="usuario" type="text" placeholder="usuario">

                <label id="correoLabel" for="correo">Correo</label>
                <input autocomplete="off" required id="correo" type="email" placeholder="correo">

                <label for="password">Contraseña</label>
                <input autocomplete="off" required id="password" type="password" placeholder="contraseña">

                <div id="icons">

                    <button class="icon" type="button" id="google">

                        <svg viewBox="-3 0 262 262">

                            <path d="M255.878 133.451c0-10.734-.871-18.567-2.756-26.69H130.55v48.448h71.947c-1.45 12.04-9.283 30.172-26.69 42.356l-.244 1.622 38.755 30.023 2.685.268c24.659-22.774 38.875-56.282 38.875-96.027" />

                            <path d="M130.55 261.1c35.248 0 64.839-11.605 86.453-31.622l-41.196-31.913c-11.024 7.688-25.82 13.055-45.257 13.055-34.523 0-63.824-22.773-74.269-54.25l-1.531.13-40.298 31.187-.527 1.465C35.393 231.798 79.49 261.1 130.55 261.1" />

                            <path d="M56.281 156.37c-2.756-8.123-4.351-16.827-4.351-25.82 0-8.994 1.595-17.697 4.206-25.82l-.073-1.73L15.26 71.312l-1.335.635C5.077 89.644 0 109.517 0 130.55s5.077 40.905 13.925 58.602l42.356-32.782" />

                            <path d="M130.55 50.479c24.514 0 41.05 10.589 50.479 19.438l36.844-35.974C195.245 12.91 165.798 0 130.55 0 79.49 0 35.393 29.301 13.925 71.947l42.211 32.783c10.59-31.477 39.891-54.251 74.414-54.251" />

                        </svg>

                    </button>

                </div>

                <p id="pregunta">
                    ¿Ya tienes una cuenta?
                    <button id="yaTiene" type="button">CLICK AQUI</button>
                </p>

                <button id="enviar" type="submit">Registro</button>

            </form>

        </div>

    </main>

    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <script src="js/registro.js"></script>

</body>

</html>