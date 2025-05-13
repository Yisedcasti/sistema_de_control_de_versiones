<?php
include_once "Conexion.php";
$sentencia = $base_de_datos->prepare(" SELECT * FROM public_eventos 
INNER JOIN registro ON registro.num_doc = Public_eventos.registro_num_doc");
$sentencia->execute();
$publicacionesEventos = $sentencia->fetchAll(PDO::FETCH_OBJ);

$sentencia = $base_de_datos->prepare(" SELECT * FROM public_noticias 
INNER JOIN registro ON registro.num_doc = Public_noticias.registro_num_doc");
$sentencia->execute();
$publicacionesNoticias = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="principal.css">
    <link rel="stylesheet" href="style.css">
    <title>Index</title>
</head>
<body>
    <header class="containerNav navbar navbar-expand-lg shadow fixed-top" style="background-color:#252525;">
        <div class="container d-flex justify-content-between align-items-left">
            <!-- Logo -->
            <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="#" style="color: white; cursor: default;">
    <span style="color: white;">EDUFAST</span>
</a>

            <!-- Botón Responsive -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
    
            <!-- Menú -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="navbar-nav ms-auto fs-5">
                    <a href="#inicio" class="nav-link active" style="color: white;">Inicio</a>
                    <a href="#pagina" class="nav-link active" style="color: white;">Pagina</a>
                    <a href="#eventos" class="nav-link active" style="color: white;">Eventos</a>
                    <a href="#noticias" class="nav-link active" style="color: white;">Noticias</a>
                    <a href="#grupo" class="nav-link active" style="color: white;">Grupo</a>
                </div>
            </div>
        </div>
    </header>
    
    
    <main>
        <section class="ParteSuperior container-fluid" id="inicio">
            <!-- Fila para el título y el logo -->
            <div class="row align-items-center logo">
                <div class="col-lg-6 col-md-12 text-center text-lg-start">
                    <h1 class="text-dark"><b><i>BIENVENIDO A EDUFAST</i></b></h1>
                </div>
                <div class="col-lg-6 col-md-12 text-center">
                    <!-- Imagen responsiva -->
                    <img src="../edufast/imagenes/logo.png" class="rounded img-fluid" alt="logo" style="max-width: 420px; height: auto;">
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-6 text-center  mb-5">
                    <a href="jwt/public/inicio2.php" class="btn btn-dark btn-lg" role="button">Iniciar Sesión</a>

                    </div>
                </div>
            </div>
        </section>
        <section class="pagina" id="pagina">
            <section class="conteinerPagina">
                <figure class="imagenPage col-6 p-3">
                    <img src="imagenes\indexImg.png" alt="imagen" width="1900px"></img>
                </figure>
                <section class="informacionPage  p-3">
                    <h1 class="text-center">VISTA PREVIA</h1>
                    <p><i>Edufast es una plataforma diseñada para facilitar el acceso a información educativa, donde podrás encontrar cursos, grados actividades y los logros asociados a ellas. También podrás consultar la asistencia y las materias disponibles.Dependiendo de tu rol o profesión, tendrás acceso a diferentes funcionalidades y estilos personalizados en las páginas. Es un software intuitivo, fácil de usar y adaptado para cubrir diversas necesidades, asegurando una experiencia agradable para todos los usuarios.</i></p>
                </section>
            </section>
            </section>
            
        <section class="eventos" id="eventos">
            
        <div id="carrusel" class="carrusel">
    <div class="atras">
        <img id="atras" src="imagenes/atras.svg" alt="atras" loading="lazy">
    </div>

    <div class="imagenes">
        <div id="img">
        </div>

        <div id="texto" class="texto">
        </div>
    </div>

    <div class="adelante" id="adelante">
        <img src="imagenes/adelante.svg" alt="adelante" loading="lazy">
    </div>
</div>


<script>
    const imagenes = [
        <?php foreach ($publicacionesEventos as $publicacion): ?>
        {
            url: "imagenes/<?php echo htmlspecialchars($publicacion->img); ?>",
            nombre: "<?php echo htmlspecialchars($publicacion->evento); ?>",
            descripcion: "<?php echo htmlspecialchars($publicacion->fecha_evento); ?> <br> <?php echo htmlspecialchars($publicacion->nombres); ?>"
        },
        <?php endforeach; ?>
    ];
</script>

        </section>
        <section>
            <section class="noticias" id="noticias">
                <h3 class="text-center ">NOTICIAS ACADEMICAS</h3>
            <?php foreach ($publicacionesNoticias as $publicacion): ?>
                <article class="articulo">
                    <header>
                        <h2><?php echo $publicacion->titulo ?></h2>
                    </header>
                    <p>
                    <?php echo $publicacion->info ?>
                    </p>
                    <footer>
                        <p>Atentamente,</p>
                        <p><strong><?php echo $publicacion->nombres ?> <?php echo $publicacion->apellidos ?></strong></p>
                    </footer>
                </article>
                <?php endforeach; ?>
            </section>
        <section id="grupo"class="equipo col-md-12">
        <h2 class="text-center"><b>EQUIPO</b></h2>
                <section class="containerequipo">
                    <section class="cardequipo">
                        <figure class="imgequipo">
                            <img src="https://tse4.mm.bing.net/th?id=OIP.VxnfJYTfgX5SyH8LRiXtVgHaE8&pid=Api&P=0&h=180" alt="equipo">
                        </figure>
                        <section class="contentequipo">
                            <h2 class="text-center">COORDINADOR</h2>
                            <P>Juan Pablo Peña </P>
                            <p>314457654</p>
                            <P>JuanPeña@Cedidsanpablo.edu.co</P>
        
                        </section>
                    </section>
                    <section class="cardequipo">
                        <figure class="imgequipo">
                            <img src="https://tse3.mm.bing.net/th?id=OIP.mWTS6Gn1W3c2fHLvV3e9yQHaJ4&pid=Api&P=0&h=180" alt="equipo">
                        </figure>
                        <section class="contentequipo">
                            <h2 class="text-center">Rectora</h2>
                            <P>Lusia Fernanda Perez Castañeda</P>
                            <p>321908765</p>
                            <P>LuisaPerez@Cedidsanpablo.edu.co</P>
                        </section>
                    </section>
                    <section class="cardequipo">
                        <figure class="imgequipo">
                            <img src="https://tse3.mm.bing.net/th?id=OIP.RobrDmv-954D05PRx2UHsQHaEG&pid=Api&P=0&h=180" alt="equipo">
                        </figure>
                        <section class="contentequipo">
                            <h2 class="text-center">SECRETARIA</h2>
                            <P>Maria Rodrigez</P>
                            <p>3213675499</p>
                            <P>maria@Cedidsanpablo.edu.co</P>
                        </section>
                    </section>
                </section>    
               </section>  
        </section>
    </main>
    <footer class="footer">
        <div class="containerfooter">
            <div class="footer-row">
                <div class="footer-links">
                    <h4>SEDES</h4>
                    <ul>
                        <li>sede A</li>
                        <li>Cl. 66 Sur #78-2, Bogotá</li>
                        <li>sede B</li>
                        <li>Cl. 65j Sur, Bogotá</li>
                        <li>sede C </li>
                        <li>Cl. 70 Bis Sur, Bogotá</li>
                    </ul>
                </div>
                <div class="footer-links">
                    <h4>INFORMACION</h4>
                    <ul>
                        <li>telefono:<br>7757545</li>
                        <li>telefono:<br>7765276</li>
                        <li>telefono:<br>7750283</li>
                        <li>direccion:<br>CR 77 L # 65 J - 73 sur</li>
                    </ul>
                </div>
                <div class="footer-links">
                    <h4>ATENCIÒN</h4>
                    <ul>
                        <li>lunes a viernes </li>
                        <li>8am - 12pm</li>
                        <li>2pm - 4pm </li>
                    </ul>
                </div> 
                <div class="footer-links">
                    <h4>CONTACTANOS</h4>
                 <div class="social-link">
                    <a href="https://www.facebook.com/cedid.sanpablo.3?locale=es_LA" class="icon"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://www.instagram.com/plumapaulista/" class="icon"><i class="fab fa-instagram"></i></a>
                    <a href="https://x.com/Cedidsanpablo" class="icon"><i class="fab fa-twitter"></i></a>
                    <a href="mailto:cedidsanpablobosa7@educacionbogota.edu.co" class="icon"><i class="fab fa-google"></i></a>
                 </div>
                </div>
            </div>
            <p>Todos los derechos reservados <br>EDUFAST </p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> 
    <script>
        let atras = document.getElementById('atras');
let adelante = document.getElementById('adelante');
let imagen = document.getElementById('img');
let puntos = document.getElementById('puntos');
let texto = document.getElementById('texto');
let actual = 0;

function mostrarImagen() {
    imagen.innerHTML = `<img class="img" src="${imagenes[actual].url}" alt="Imagen carrusel" loading="lazy">`;
    texto.innerHTML = `
        <h3>${imagenes[actual].nombre}</h3>
        <p>${imagenes[actual].descripcion}</p>
    `;
    posicionCarrusel();
}

function posicionCarrusel() {
    puntos.innerHTML = "";
    imagenes.forEach((_, i) => {
        puntos.innerHTML += `<span class="${i === actual ? 'activo' : ''}">•</span>`;
    });
}

atras.addEventListener('click', () => {
    actual = (actual - 1 + imagenes.length) % imagenes.length;
    mostrarImagen();
});

adelante.addEventListener('click', () => {
    actual = (actual + 1) % imagenes.length;
    mostrarImagen();
});

mostrarImagen();

    </script>
</body>
</html>