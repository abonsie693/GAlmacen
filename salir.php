<?php
  // Carga el marco superior
	require_once('marcosup.php');
// Reanudar la sesión iniciada
session_start();
// Recoge el nombre del usuario de la sesión
$id=$_SESSION['usuarioreg'];
$nombre=$_SESSION['nombr'];

// Vaciar las variables de sesión
$_SESSION = [];

// Cerramos la sesión iniciada
//session_destroy();
if (session_destroy()) {
    //echo "<hr>Sesión destruida correctamente<hr>";
    $_SESSION["autent"]= "NO"; 
    // Evitar caché
    header("Cache-Control: no-store, no-cache, must-revalidate");
?>
 <div class="py-5 bg-info">

	  <div class="container">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-lg-12 text-center">
            <h2 class="text-primary">Esquema Almacén Comercial</h2>            
            <br>			
            <div class="bg-dark-opaque text-warning" style="	background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.9));	background-position: top right;	background-size: 100%;	background-repeat: repeat;">
              <h3>"<?php echo $id, " ", $nombre;?>" Ha abandonado la sesion. </h3>
            </div>
          </div>
        </div>
      </div>
  </div>
<?php
  } else {
      echo "<hr>Error al destruir la sesión<hr>";
  }
    //Carga el marco inferior
	require_once('marcoinf.php');
?>	
  
