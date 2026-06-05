

<?php
// ============================================================
//  RutaPc – Barra de navegación
//  includes/auth.php
// ============================================================
require_once __DIR__ . '/includes/auth.php';


date_default_timezone_set('America/Mexico_City');
$usuarioNombre = sesion('usuario_nombre') ?? '';
$usuarioRol    = sesion('usuario_rol')    ?? '';
$currentFile   = basename($_SERVER['PHP_SELF']);
$baseUrl       = defined('APP_URL') ? APP_URL : '';

$hora   = (int) date('H');
$saludo = match(true) {
    $hora >= 5  && $hora < 12 => 'Buenos días',
    $hora >= 12 && $hora < 19 => 'Buenas tardes',
    default                   => 'Buenas noches',
};

?>


<?php
// ============================================================
// RutaPc – Dashboard principal
// Archivo: index.php
// Descripción:
// Página principal del sistema que muestra información general,
// saludo personalizado y datos de sesión para administradores.
// ============================================================


// ============================================================
// CARGA DE ARCHIVOS NECESARIOS
// Incluye las funciones de autenticación y manejo de sesión.
// ============================================================




// ============================================================
// OBTENCIÓN DE DATOS DE LA SESIÓN
// Recupera información básica del usuario autenticado.
// ============================================================




// ============================================================
// CARGA DE ARCHIVOS NECESARIOS
// Incluye las funciones de autenticación y manejo de sesión.
// ============================================================
?>
<?php require_once __DIR__ . '/includes/header.php'; ?>

  <link rel="stylesheet" href= "CSS/Styke.css">
</head>
<body> 

  <!-- Encabezado -->
  <header class="hero">

  <!-- Lado izquierdo con imagen -->
  <div class="hero-image">

    <div class="cerrarSesion-divider">
      <a href="<?= $baseUrl ?>/logout.php" class="cerrarSesion-link">
        <p>Cerrar sesión<p>
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
          <polyline points="16 17 21 12 16 7"/>
          <line x1="21" y1="12" x2="9" y2="12"/>
        </svg>
      </a>
    </div>

    <img src="img/panel.jpg" alt="Fondo tecnológico" class="fondo">
    <h1 class="logo">Ruta Pc</h1>
     <!-- Lado derecho con degradado y botones -->
    

      <div class="buttons">
<?php if (estaAutenticado() == false): ?>
  <button class="btn">
    <img src="img/imgPer.png" alt="Usuario">
    <a href="login.php"> Iniciar sesión
    </a>
  </button> 

  <?php else: ?>
<button class="btn" id="btnUsuario">
    <img src="img/imgPer.png" alt="Usuario">
    <a href="">
      <?= htmlspecialchars($usuarioNombre, ENT_QUOTES, 'UTF-8') ?>,
      <?= htmlspecialchars(' ', ENT_QUOTES, 'UTF-8') ?>
      <?= htmlspecialchars($saludo, ENT_QUOTES, 'UTF-8') ?>
    </a>
  </button> 

  <script>
document.getElementById('btnUsuario').addEventListener('click', function(e) {
    e.preventDefault(); // Evita que el enlace recargue la página
    alert('Ya has iniciado sesión');
});
</script>

<?php endif; ?>

        <button class="btn">
          <img src="img/imgMe.png" alt="Catálogo">
          <a href="catalogo.php">Cátalogo</a>
        </button>
      
        <button class="btn" id= "btn-nosotros">
          <img src= "img/imgNosotros.png" alt="Nosotros">
          <a href="#nosotros-container">Nosotros</a>
        </button>


<?php if ($usuarioRol === 'administrador'): ?>
  <button class="btn">
    <img src="img/imgMod.png" alt="Modificar">
    <a href="admin.php">
      Modificar
    </a>
  </button> 
<?php endif; ?>




</div> </div> </header>

<div class="nosotros-container" id="nosotros-container">
  <section id="about">
    <h2><h2>¿Quiénes somos?</h2>
<p>
Somos una empresa de desarrollo de software formada por dos estudiantes de CETI, apasionados por la tecnología y comprometidos con ofrecer soluciones digitales de calidad. Nos especializamos en el desarrollo de sistemas, aplicaciones web, soporte técnico y mantenimiento de equipos, adaptándonos a las necesidades de cada cliente.
</p>

<p>
Nuestro objetivo es brindar un servicio confiable, transparente y profesional, manteniendo una comunicación cercana durante todo el proceso. A pesar de ser un equipo pequeño, contamos con experiencia en proyectos académicos y particulares, así como referencias que respaldan la calidad de nuestro trabajo.
</p>

<p>
Creemos que la tecnología debe estar al alcance de todos, por lo que trabajamos para ofrecer soluciones eficientes, seguras y accesibles, ayudando a personas, estudiantes, emprendedores y negocios a aprovechar al máximo sus herramientas digitales.
</p>
  </section>
</div>

<footer>
    <small>2026 &copy; La Ruta PC</small>
  </footer>

</body>
</html>


<!-- ============================================================
// PIE DE PÁGINA
// Cierra la estructura HTML e incluye scripts globales.
// ============================================================-->
