<!--Aquí inicio con mi html regular, tengo todo una estructura ya basado en mi diseño -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ArinnSell | Figuras y ofertas</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <header class="encabezado">
        <a href="index.php" class="logo">
            <span class="estrella">★</span>
            <span>ArinnSell</span>
        </a>

        <form action="index.php" method="get" class="buscador">
            <input
                type="search"
                name="buscar"
                placeholder="Busca tus figuras favoritas..."
                aria-label="Buscar productos"
            >
            <button type="submit">Buscar</button>
        </form>
    </header>

    <nav class="navegacion">
        <ul>
            <li><a href="index.php">Inicio</a></li>
            <li><a href="#ofertas">Ofertas</a></li>
            <li><a href="#destacados">Destacados</a></li>
            <!--Aquí tengo un pequeño mensaje de bienvenida en caso de que la sesión haya sido
            iniciada, le manda al usuario un mensaje con su nombre y si no hay una sesión activa, 
            la página le da la recomendación de iniciar sesión o de registrarse -->
            <?php if (isset($_SESSION["usuario_id"])): ?>
                <li><span class="saludo">Hola, <?= htmlspecialchars($_SESSION["nombre"]) ?></span></li>
            <?php else: ?>
                <li><a href="login.php">Iniciar sesión</a></li>
                <li><a href="registro.php">Registrarse</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <main>
<!--Ya esta es la arquitectura regular del diseño, no uso más funciones de PHP -->
        <section id="inicio" class="presentacion">
            <h1>Grandes ofertas (˶ᵔ ᵕ ᵔ˶)</h1>
            <p>Consigue tus figuras favoritas a mitad de precio.</p>
            <a href="#ofertas" class="boton">Ver ofertas</a>
        </section>

        <section id="ofertas" class="seccion-productos">
            <h2>Ofertas especiales ★</h2>
            <p class="descripcion">¡Tus personajes favoritos a precios increíbles!</p>

            <div class="productos">

                <article class="producto">
                    <img src="johnny.jpg" alt="Figura de Johnny Joestar">
                    <h3>Johnny Joestar</h3>
                    <p class="precio">
                        <span class="precio-anterior">$1,200</span>
                        <strong>$840 MXN</strong>
                    </p>
                    <button type="button" class="boton">Agregar al carrito</button>
                </article>

                <article class="producto">
                    <img src="gyro.jpg" alt="Figura de Gyro Zeppeli">
                    <h3>Gyro Zeppeli</h3>
                    <p class="precio">
                        <span class="precio-anterior">$1,600</span>
                        <strong>$670 MXN</strong>
                    </p>
                    <button type="button" class="boton">Agregar al carrito</button>
                </article>

            </div>
        </section>

        <section id="destacados" class="seccion-productos">
            <h2>Productos destacados (˶ᵔ ᵕ ᵔ˶)</h2>
            <p class="descripcion">Nuestros productos más vendidos.</p>

            <div class="productos">

                <article class="producto">
                    <img src="dio.jpg" alt="Figura de Dio">
                    <h3>Dio (que aunque no sea su parte igual lo vendemos)</h3>
                    <p class="precio">
                        <span class="precio-anterior">$1,450</span>
                        <strong>$500 MXN</strong>
                    </p>
                    <button type="button" class="boton">Agregar al carrito</button>
                </article>

                <article class="producto">
                    <img src="diego.jpg" alt="Figura de Diego Brando">
                    <h3>Diego Brando</h3>
                    <p class="precio">
                        <span class="precio-anterior">$1,290</span>
                        <strong>$789 MXN</strong>
                    </p>
                    <button type="button" class="boton">Agregar al carrito</button>
                </article>

            </div>
        </section>

    </main>

    <footer class="pie">
        <p>&copy; 2026 ArinnSell | Tienda de figuras y coleccionables ★</p>
    </footer>

</body>
</html>