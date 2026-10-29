<?php
require "conexion.php";
#Al igual que al anterior, requiero de una conexion para acceder. 
if (isset($_SESSION["usuario_id"])) {
    header("Location: index.php");
    exit;
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = trim($_POST["nombre"] ?? "");
    $email  = trim($_POST["email"] ?? "");
    $pass   = $_POST["password"] ?? "";
#Aqui ya simplemente comprado datos, para que contraseñas, ids, nombres y demas sean iguales, para que sean comparados, tienen que 
#existir dentro de la BD, sino, se muestra como un error de datos incorrectos.
    $stmt = $conexion->prepare("SELECT id, nombre, passwordh FROM usuarios WHERE nombre = ? AND email = ?");
    $stmt->execute([$nombre, $email]);
    $usuario = $stmt->fetch();

    if ($usuario && $pass === $usuario["passwordh"]) {
        session_regenerate_id(true);
        $_SESSION["usuario_id"] = $usuario["id"];
        $_SESSION["nombre"]     = $usuario["nombre"];
        header("Location: index.php");
        exit;
    }

    $error = "Los datos son incorrectos.";
}
?>

<!--Ya este es el HTML simple donde almaceno el inicio de sesion, que es como una serie de rubros a comparar entre si
para comprobar alguna cuenta -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ArinnSell | Iniciar sesión</title>
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
            <li><a href="registro.php">Registrarse</a></li>
        </ul>
    </nav>

    <main>
        <section class="seccion-productos">
            <h2>Iniciar sesión ★</h2>

            <form method="post" class="formulario-login">
                <label for="nombre">Nombre de usuario</label>
                <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($_POST["nombre"] ?? "") ?>" required>

                <label for="email">Correo</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($_POST["email"] ?? "") ?>" required>

                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" required>

                <button type="submit" class="boton">Entrar</button>

                <?php if ($error !== ""): ?>
                    <p class="error"><?= htmlspecialchars($error) ?></p>
                <?php endif; ?>
            </form>
        </section>
    </main>

    <footer class="pie">
        <p>&copy; 2026 ArinnSell | Luna Arias Meredith Aranza 5-I ★</p>
    </footer>

</body>
</html>