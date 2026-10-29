<?php
require "conexion.php";
#Aquí como ya voy a inyectar datos a mis tablas, requiero de mi conexión con SQL. 
#Que ya tengo previamente vinculada a un archivo para no tener que llamarla entera al utilizarla. 
if (isset($_SESSION["usuario_id"])) {
    header("Location: index.php");
    exit;
}
#Este primer IF indica que si la sesión del usuario con el ID que se indica conectado está en funcionamiento, en dicho caso se 
#va a redigirir al index principal para que pueda seguir comprando. 
$error = "";

#Este es el metodo POST con el que voy a mandar mis datos del formulario hasta la BD, directamente 
#con PHP, lo que hago es llamar a la funcion que voy a usar, en este caso post o mandar y voy a indicar que aspectos de dicho 
#formulario voy a mandar, que tienen que ser iguales a los de mi tabla en SQL. 
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = trim($_POST["nombre"] ?? "");
    $email  = trim($_POST["email"] ?? "");
    $pass   = $_POST["password"] ?? "";

    #En este if solamente le mando un mensaje al usuario en caso de que deje algun campo vacio para indicarle que son 
    #obligatorios. 
    if ($nombre === "" || $email === "" || $pass === "") {
        $error = "Llena todos los campos.";
    } else {
        #En caso de que PHP identifique un nombre de usuario ya registrado o un correo ya registrado, se le notificara para
        #que haga el cambio. 
        $stmt = $conexion->prepare("SELECT id FROM usuarios WHERE email = ? OR nombre = ?");
        $stmt->execute([$email, $nombre]);

        if ($stmt->fetch()) {
            $error = "Ese nombre o correo ya está registrado.";
        } else {
            #Ya simplemente al pasar por todas las evaluaciones, se recaudan los datos y se guardan en mi tabla de usuarios. 
            $stmt = $conexion->prepare("INSERT INTO usuarios (nombre, email, passwordh) VALUES (?, ?, ?)");
            $stmt->execute([$nombre, $email, $pass]);
            header("Location: login.php");
            exit;
        }
    }
}
?>

<!--Ya este es mi formulario de registro, donde voy a recaudar los datos -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ArinnSell | Registrarse</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <header class="encabezado">
        <a href="index.php" class="logo">
            <span class="estrella">★</span>
            <span>ArinnSell</span>
        </a>
    </header>

    <nav class="navegacion">
        <ul>
            <li><a href="index.php">Inicio</a></li>
            <li><a href="login.php">Iniciar sesión</a></li>
        </ul>
    </nav>

    <main>
        <section class="seccion-productos">
            <h2>Crear cuenta ★</h2>

            <form method="post" class="formulario-login">
                <label for="nombre">Nombre de usuario</label>
                <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($_POST["nombre"] ?? "") ?>" required>

                <label for="email">Correo</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($_POST["email"] ?? "") ?>" required>

                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" required>

                <button type="submit" class="boton">Registrarme</button>
                <!--En los input tengo pequeñas fracciones de código PHP que sirven para evaluar cada campo y extraer la informacion
                que el usuario haya escrito en ellas, o en cualquier caso, cualquier caracter especial que no pueda ser leido por
                navegadores comunes -->
                <?php if ($error !== ""): ?>
                    <p class="error"><?= htmlspecialchars($error) ?></p>
                <?php endif; ?>
            </form>
        </section>
    </main>

    <footer class="pie">
        <p>&copy; 2026 ArinnSell — Luna Arias Meredith Aranza ★</p>
    </footer>

</body>
</html>